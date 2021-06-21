var oTable;
var iTableCounter = 1;
var oInnerTable;
var detailsTableHtml;
var siteurl;
jQuery(document).ready(function(e) {
    //transacData();
    itrData();
    // form16Data();
    $('#transaction_list').DataTable().destroy();
    oTable = $('#transaction_list').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
        "columns" : [
            { width : '50px' },
            { width : '50px' },
            { width : '50px' },
            { width : '50px' },        
            { width : '50px' },
            { width : '50px' },
            { width : '50px' },
            { width : '50px' }        
        ] 
    });
    detailsTableHtml = $("#detailsMFTable").html();
    $(document).on("click", ".transacData", function (e) {
        e.preventDefault();
        $(".transacData").each(function() {
            var tr = $(this).parents('tr');
            tr.removeClass('shown');
        });
        siteurl = $('#siteurl').text();
        var nTr = $(this).parents('tr')[0];
        var rowIndex = nTr.rowIndex; 
        var objData = {};
        objData["id"] = $(this).attr("data-id");
        objData["val"] = $(this).attr("data-val");
        objData["view_tran_history"] = "yes";
        var tr = $(this).parents('tr');
        $(this).parents('tr').css("background-color", "#EEEEEE");
        var row = oTable.row(tr);
        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
            $(this).parents('tr').css("background-color", "#FFF");
        }
        else {
            sout = fnFormatDetails(iTableCounter, detailsTableHtml);
            // Open this row (the format() function would return the data to be shown)
            row.child(sout).show();
            tr.addClass('shown');
            $.ajax({
                url: siteurl,
                type: "POST",
                data: objData,
                aynsc: false,
                success: function(response) {
                detailsRowData = JSON.parse(response);
                oInnerTable = $('#viewTrans_' + iTableCounter).DataTable({
                    data: detailsRowData, 
                    autoWidth: true, 
                    deferRender: true, 
                    info: false, 
                    lengthChange: false, 
                    ordering: true, 
                    paging: true, 
                    scrollX: false, 
                    scrollY: false, 
                    searching: true, 
                    autoWidth: false,
                    responsive: true,
                    columns:[ 
                        { data:'purchase_date', width : '50px' },
                        {   data : null,
                            render: function ( data, type, row ) {
                                if(row.tran_type.indexOf('P') > -1) {
                                    return "Purchase";
                                } else if(row.tran_type.indexOf('R') > -1) {
                                    return "Redemption";
                                } else {
                                    return "";
                                }
                            }, width : '50px'
                        },
                        { data:'unit', width : '50px' }, 
                        {   data : null,
                            render: function ( data, type, row ) {
                                return formatter.format(parseInt(row.purchase_price.replace(/\,/g, '')))
                            }, width : '50px'
                        },
                        {   data : null,
                            render: function ( data, type, row ) {
                                return formatter.format(parseInt(row.amount.replace(/\,/g, '')))
                            }, width : '50px'
                        }
                    ]
                });
                iTableCounter = iTableCounter + 1;
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                alert("Status: " + textStatus); alert("Error: " + errorThrown); 
                } 
            });
        }
    });
    $('#redeem_amnt').change(function(){
        var enteredamt = parseFloat($('#redeem_amnt').val());
        var tempamt = parseFloat($('#all_units').text());
        if(enteredamt<tempamt) {
            $('#redeem_all_amount').val('N');
            $('#redeem_all_amount').attr('value','N');
        } else {
            if(enteredamt==tempamt) {
                $('#redeem_all_amount').val('Y');
                $('#redeem_all_amount').attr('value','Y');
            } else {
                if(enteredamt>tempamt) {
                    $('#redeem_all_amount').val('');
                    $('#redeem_all_amount').attr('value','');
                    $('#redeem_amnt').val('');
                    $('#redeem_amnt').attr('value','');
                }   
            }
        }
    });
    $(".redeem").click(function(){
        $('#redemption_error').text('');
        var sch_name = $(this).attr('data-sch');
        var amnt    = $(this).attr('data-amnt');
        $("#sch_n").text(sch_name);
        $("#redeem_folio").val($(this).attr('data-folio'));
        $("#redeem_scheme_id").val($(this).attr('data-schemecode'));
        $(".all_units").text(amnt);
        $('#redeem_val').modal('show');
        $( ".first-show" ).show();
        $( ".second-show" ).hide();
        $( ".third-show" ).hide();
    });
    $( "#first-con" ).click(function() {
        $('#redeemAmt').text(formatter.format(parseInt($("#redeem_amnt").val())));
        $('#redeemAmt_third').text(formatter.format(parseInt($("#redeem_amnt").val())));
        $( ".first-show" ).hide();
        $( ".second-show" ).show();
        $( ".third-show" ).hide();
    });
    $( "#second-con" ).click(function() {
        $( ".first-show" ).hide();
        $( ".second-show" ).hide();
        $( ".third-show" ).show();
    });
    $( "#confirm" ).click(function(e) {
        e.preventDefault();
        var form = $('#redeemForm');
        var url = form.attr('action');
        $.ajax({
            type: "POST",
            url: url,
            data: form.serialize(), // serializes the form's elements.
            beforeSend: function(){
                $('.ajax-loader').css("visibility", "visible");
            },
            complete: function(){
                $('.ajax-loader').css("visibility", "hidden");
            },
            success: function(response) {
                console.log(response);
                data = JSON.parse(response);
                if(data['status']=="failure") {
                    $('#redemption_error').text("Failure : "+data['order_id']);
                } else {
                    if(data['status']=="success") {
                        alert("Redeemed Successfully.<br>Your Redemption Id : "+data['order_id']);
                        $( ".third-show" ).hide();
                    }
                }
            }
        });
    });
    $("#myCheckbox2").click(function(){
        if($(this).prop("checked") == true){
            var amnt = $("#all_units").text();
            $("#redeem_amnt").val(amnt);
            $("#redeem_amnt").attr('value',amnt);
            //$("#redeem_amnt").attr('disabled','disabled');
            $("#redeem_all_amount").attr('value','Y');
            $("#redeem_all_amount").val('Y');
        } else {
            $("#redeem_amnt").removeAttr('value');  
            //$("#redeem_amnt").removeAttr('disabled','disabled');
            $("#redeem_amnt").attr('placeholder','Enter the amount for redeem'); 
            $("#redeem_all_amount").attr('value','N');
            $("#redeem_all_amount").val('N');
        }
    });
    $('#fundsList').empty();
    var dynamicColors = function() {
        var r = Math.floor(Math.random() * 255);
        var g = Math.floor(Math.random() * 255);
        var b = Math.floor(Math.random() * 255);
        return "rgb(" + r + "," + g + "," + b + ")";
    };
    var obj = jQuery.parseJSON($("#invest_funds").text());
    var fundLabels = [];
    var fundval = [];
    var fundColor = ['#9BBFE0', '#E8A09A', '#FBE29F', '#C6D68F'];
    var i=0;
    if(obj.length!=0) {
        $('#fundsList').append("<table>");
        $.each(obj, function(key,value) {
            fundLabels[i] = key;
            fundval[i] = value.toFixed(2);
            //fundColor[i] = dynamicColors();
            i++;
            $('#fundsList').append("<tr><td><b>"+key+" Funds </b></td><td><b>&nbsp;&nbsp;&nbsp;: &nbsp;&nbsp;&nbsp;<span id='debtPercent' class='info-box-text'> "+formatter.format(value.toFixed(2))+"</span></b></td></tr>");
            //console.log(value);
        }); 
        $('#fundsList').append("</table>");
        //console.log("Fund color : "+fundColor);
        var chartDiv = $("#barChart");
        var myChart = new Chart(chartDiv, {
            type: 'pie',
            data: {
                labels: fundLabels,
                datasets: [
                {
                    data: fundval,
                    backgroundColor: fundColor
                }]
            },
            options: {
                title: {
                    display: true,
                    text: 'Statistics'
                },
                responsive: true,
                maintainAspectRatio: false,
            }
        });
    } else {
        obj = {DEBT: 0, LIQUID: 0, EQUITY: 0, Balance: 100 };
        $('#fundsList').append("<table>");
        $.each(obj, function(key,value) {
            fundLabels[i] = key;
            fundval[i] = value.toFixed(2);
            //fundColor[i] = dynamicColors();
            i++; 
            if(key!="Balance") {
                $('#fundsList').append("<tr><td><b>"+key+" Funds </b></td><td><b>&nbsp;&nbsp;&nbsp;: &nbsp;&nbsp;&nbsp;<span id='debtPercent' class='info-box-text'> "+formatter.format(value.toFixed(2))+"</span></b></td></tr>");
            }
            //console.log(value);
        }); 
        $('#fundsList').append("</table>");
        //console.log("Fund color : "+fundColor);
        var chartDiv = $("#barChart");
        var myChart = new Chart(chartDiv, {
            type: 'pie',
            data: {
                labels: fundLabels,
                datasets: [
                {
                    data: fundval,
                    backgroundColor: fundColor
                }]
            },
            options: {
                title: {
                    display: true,
                    text: 'Statistics'
                },
                responsive: true,
                maintainAspectRatio: false,
            }
        });
        //$('#chartInfo').text("No Data Available");
    }
    //Current Value
    var sum = '';
    var sum1 = 0;
    var sum2 ='';
    $(".profit_amt").each(function(){
        sum = $(this).text().split(",").join("");
        sum1 += parseFloat(sum); 
        //alert(sum1);
        sum2 = sum1.toLocaleString();//addCommas(sum1);
        $("#all_amt").text("₹"+sum2);
    });

    // Total amount Invested 
    var invest_amt = $("#invest_amt").val();
    //alert(invest_amt);
    $("#invstd_val").text(formatter.format(parseInt(invest_amt.replace(/\,/g, ''))));
    if(sum2==0) {
        $("#total_rtn").text(formatter.format(0));
    } else {
        $("#total_rtn").text(formatter.format(parseInt(sum2.replace(/\,/g, ''))));
    }
    
    var pf = parseInt(invest_amt.replace(/\,/g, ''))-parseInt(sum1);
    var pf = $('#tot_profit').val().replace(/\,/g, '');
    if(pf>0) {
        $("#profit_loss_rtn").html('<i style="color: GREEN;" class="fa fa-arrow-up"></i>&nbsp;&nbsp;'+formatter.format(pf));
    } else {
        if(pf<0) {
            $("#profit_loss_rtn").html('<i style="color: RED;" class="fa fa-arrow-down"></i>&nbsp;&nbsp;'+formatter.format(pf));
        } else {
            if (pf==0) {
                $("#profit_loss_rtn").html(formatter.format(pf));
            }
        }
    }
    $("#total_rtn").text(formatter.format(parseInt($('#tot_c_amnt').val().replace(/\,/g, ''))));
    
});
$(document).on("click", ".viewDocModel", function (e) {
    e.preventDefault();
    console.log($(this).attr('data-link'));
    $('#docDetail').attr('src', $(this).attr('data-link'));
    $('#docViewModal').modal('show');
    
});
function transacData() {
    $.ajax({
        url: "<?php echo $CONFIG->siteurl;?>__lib.ajax/mutual_fund.php",
        type: "POST",
        data: {"tran_history" : "yes"},
        beforeSend: function(){
            $('.ajax-loader').css("visibility", "visible");
        },
        complete: function(){
            $('.ajax-loader').css("visibility", "hidden");
        },
        success: function(response) {
            console.log(JSON.parse(response));
            $("#transaction_list").dataTable().fnDestroy();
            $('#transaction_list').DataTable({
                "paging": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "data" : JSON.parse(response),
                "columns" : [{
                    data : null,
                    render: function ( data, type, row ) {
                    return row.ben_fname;
                    }
                }, {
                    data : null,
                    render: function (data, type,row) {
                    return relationName(row.ben_rel_with_testator)
                    }
                }, {
                    data : null,
                    render: function (data, type,row) {
                    return row.ben_perm_addr1 +', '+ row.ben_perm_addr2 +', '+ row.ben_perm_city +', '+ stateName(row.ben_perm_state) +', '+ countryName(row.ben_perm_country) +' - '+ row.ben_perm_zip
                    }
                }, {
                    data : null,
                    render: function (data, type, row) {
                    return '<button type="button" id="'+row.pk_bk_id+'" class="btn btn-primary-rect willView" data-id="'+row.pk_bk_id+'" data-key="pk_bk_id" data-table="will_bank_accounts" data-form="addBankAccount" data-modal="bankAccountModal"><i class="fa fa-eye"></i></button>'+
                    '<button type="button" id="willEdit" class="btn btn-warning-rect willEdit" data-id="'+row.pk_bk_id+'" data-key="pk_bk_id" data-table="will_bank_accounts" data-form="addBankAccount" data-modal="bankAccountModal"><i class="fa fa-edit"></i></button>'+
                    '<button type="button" id="willDelete" class="btn btn-danger-rect active willDelete" data-id="'+row.pk_bk_id+'" data-key="pk_bk_id" data-table="will_bank_accounts" data-form="addBankAccount"><i class="fa fa-trash-o"></i> </button>'+
                    '<button type="button" class="btn btn-info-rect active assignBen" data-id="'+row.pk_bk_id+'" data-key="pk_bk_id" data-form="addBankAccount" data-modal="beniBankModal" data-dbtable="will_bank_accounts" data-table="will_bank_accounts"><i class="fa fa-user-plus"></i> </button>';
                    }
                } ],
                "fnInitComplete": function() {
                    $("#beneficiary").css("width","100%");
                }
            });
            
        }
    });
}
function fnFormatDetails(table_id, html) {
    var sOut = "<table class='table table-bordered'  id='viewTrans_"+table_id+"'>";
    sOut += html;
    sOut += "</table>";
    return sOut;
}
function itrData() {
    var docData = [];
    var sitehost = window.location.origin;
    $.ajax({
        url: sitehost+"/__lib.ajax/ajax_response.php",
        type: "POST",
        data: {"action" : "itrv", "uid" : sessionStorage.getItem("uid")},
        beforeSend: function(){
            $('.ajax-loader').css("visibility", "visible");
        },
        complete: function(){
            $('.ajax-loader').css("visibility", "hidden");
        },
        success: function(response) {
            console.log(response);
            $.each(JSON.parse(response),function(key,val) {
                item = {};
                if(key=="itr") {
                    $.each(val,function(key1, val1){
                        item ["name"] = val1.itr_pan;
                        item ["link"] = 'https://admin.optymoney.com/__uploadeditrv.files/'+sessionStorage.getItem("uid")+'/'+val1.itr_v;
                        docData.push(item);
                    });
                } else {
                    if(key=="docs") {
                        $.each(val,function(key2, val2){
                            res2 = val2.file.split("|");
                            $.each(res2,function(i){
                                item1 = {};
                                item1 ["name"] = res2[i];
                                item1 ["link"] = 'https://optymoney.com/__uploaded.files/helpdesk/'+sessionStorage.getItem("uid")+'/'+res2[i];
                                //item1 ["link"] = 'https://optymoney.com/__uploadeditrv.files/'+sessionStorage.getItem("uid")+'/'+res2[i];
                                docData.push(item1);
                            });
                        });
                    }
                }
            });
            $("#doc_list").dataTable().fnDestroy();
            $('#doc_list').DataTable({
                "paging": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "data" : docData,
                "columns" : [
                    {
                        data : null,
                        render: function ( data, type, row ) {
                            return row.name;
                        }
                    }, {
                        data : null,
                        render: function (data, type,row) {
                            return row.name;
                        }
                    }, {
                        data : null,
                        render: function (data, type, row) {
                            return '<a class="viewDocModel" href="#" data-link="'+row.link+'"><i class="fa fa-eye" aria-hidden="true"></i></a>';
                        }
                    }, {
                        data : null,
                        render: function (data, type, row) {
                            return '<a href="'+row.link+'"><i class="fa fa-download" aria-hidden="true"></i></a>';
                        }
                    } ],
                "fnInitComplete": function() {
                    $("#doc_list").css("width","100%");
                }
            });
        }
    });
}

function form16Data() {
    var sitehost = window.location.origin;
    $.ajax({
        url: sitehost+"/__lib.ajax/ajax_response.php",
        type: "POST",
        data: {"action" : "form16", "uid" : sessionStorage.getItem("uid")},
        beforeSend: function(){
            $('.ajax-loader').css("visibility", "visible");
        },
        complete: function(){
            $('.ajax-loader').css("visibility", "hidden");
        },
        success: function(response) {
            if(response) {
                $('#form16Docs').empty();
                console.log(JSON.parse(response));
                $.each(JSON.parse(response),function(key,val) {
                    if(val.itr_e=="itr") {
                        res = val.file.split("|");
                        $.each(res,function(i){
                            console.log(res[i]);
                            $('#form16Docs').append('<br><a href="https://admin.optymoney.com/__uploaded.files/helpdesk/'+sessionStorage.getItem("uid")+'/'+res[i]+'">'+res[i]+'</a>');
                        });
                    } else {
                        if(val.itr_e=="eassess") {
                            res = val.file.split("|");
                            $.each(res,function(i){
                                console.log(res[i]);
                                $('#eAssessDocs').append('<br><a href="https://optymoney.com/__uploaded.files/helpdesk/'+sessionStorage.getItem("uid")+'/'+res[i]+'">'+res[i]+'</a>');
                            });
                        } else {
                            
                        }
                    }
                });
            } else {
                $('#itrvDocs').append('<p class="text-center">No Data Available</p>');
            }
        }
    });
}