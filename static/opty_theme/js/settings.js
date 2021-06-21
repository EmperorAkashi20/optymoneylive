(function ($) {
    $.fn.serializeFormJSON = function () {
        var o = {};
        var a = this.serializeArray();
        $.each(a, function () {
            if (o[this.name]) {
                if (!o[this.name].push) {
                    o[this.name] = [o[this.name]];
                }
                o[this.name].push(this.value || '');
            } else {
                o[this.name] = this.value || '';
            }
        });
        return o;
    };
})(jQuery);

$(document).ready(function() {
    bankAccounts();
    $(".save").on("click", function (e) {
        e.preventDefault();
        var objData = {};
        var data = $('#addBankAccount').serializeFormJSON();
        //data["row_id"] = $(this).attr("data-row_id");
        console.log(data);
        objData["act"] = $(this).attr("data-role");
        objData["id"] = $(this).attr("data-id");
        objData["data"] = data;
        objData["action"] = "insertbank";
        $.ajax({
            url: $("#addBankAccount")[0].action,
            type: "POST",
            data: objData,
            async: false,
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
                    alert("Update Failed.\n"+response);
                } else {
                    if(data['status']=="success") {
                        alert("Updated Successfully");
                        bankAccounts();
                        $('#bankAccountModal').modal('hide');
                    }
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    });
    $(document).on("click", ".willEdit", function(e){
        e.preventDefault();
        var nTr = $(this).parents('tr')[0];
        $('#bankAccountModal').modal('show');
        $('#bank_name').val(nTr.children[0].innerText);
        $('#acc_no').val(nTr.children[1].innerText);
        $('#ifsc_code').val(nTr.children[2].innerText);
        $('#default_bank').val(nTr.children[3].innerText);
        $('.save').attr('data-id', $(this).attr("data-id"));
    });
    $(document).on("click", "#bankDelete", function(e){
        e.preventDefault();
        var objData = {};
        objData["id"] = $(this).attr("data-id");
        objData["action"] = "deletebank";
        $.ajax({
            url: $("#addBankAccount")[0].action,
            type: "POST",
            data: objData,
            async: false,
            beforeSend: function(){
               $('.ajax-loader').css("visibility", "visible");
            },
            complete: function(){
               $('.ajax-loader').css("visibility", "hidden");
            },
            success: function(response) {
                console.log(response);
                if(response==1) {
                    alert("Deleted Successfully");
                    bankAccounts();
                } else {
                    alert("Deletion Failed");
                }
            }
        });
    });
    $(document).on("click", "#updateBasic", function(e){

    });

    $(document).on("click", "#updateBasicbank", function(e){
        var form = $('#userBankDetails')
    });
});

function submitinfo(form) {           
    $.ajax({
        cache:false,
        url: form.action,
        type: form.method,
        data: $(form).serialize(),
        success: function(response) {
            console.log(response);
            if(response==1) {
                alert("Information updated");
            } else {
                alert("Please try again...");
            }
        }
    });
    return false;
}

function submitbankinfo(form) {           
    $.ajax({
        cache:false,
        url: form.action,
        type: form.method,
        data: $(form).serialize(),
        success: function(response) {
            console.log(response);
            var res = $.trim(response);
            if(res.indexOf('update_info')==0 || res.indexOf('update_info')>0) {
                alert("Information updated");
            }
        }            
    });
    return false;
}

function bankAccounts() {
    var objData = {};
    objData["act"] = "get";
    objData["action"] = "getBankDetails";
 
    $.ajax({
       url: $("#addBankAccount")[0].action,
       type: "POST",
       data: objData,
       beforeSend: function(){
          $('.ajax-loader').css("visibility", "visible");
       },
       complete: function(){
          $('.ajax-loader').css("visibility", "hidden");
       },
       success: function(response) {
          console.log(JSON.parse(response));
          $("#bankAccountsTable").DataTable().destroy();
          oTable = $('#bankAccountsTable').DataTable({
             "paging": true,
             "searching": true,
             "ordering": true,
             "info": true,
             "autoWidth": false,
             "data" : JSON.parse(response),
             "columns" : [{
                "data" : "bank_name"
             }, {
                "data" : "acc_no"
             }, {
                "data" : "ifsc_code"
             }, {
                "data" : "mandate_id"
             }, {
                data : null,
                render: function (data, type, row) {
                   return '<button type="button" id="bankEdit" class="btn btn-warning-rect willEdit" data-id="'+row.pk_bank_detail_id+'" data-modal="bankAccountModal"><i class="fa fa-edit"></i></button>'+
                   '<button type="button" id="bankDelete" class="btn btn-danger-rect active willDelete" data-id="'+row.pk_bank_detail_id+'"><i class="fa fa-trash-o"></i> </button>';
                }
             } ],
             "fnInitComplete": function() {
                $("#bankAccountsTable").css("width","100%");
             }
          });
       }
    });
 }