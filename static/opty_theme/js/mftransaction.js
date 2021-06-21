var oTable;
var iTableCounter = 1;
var oInnerTable;
var detailsTableHtml;
$(document).ready(function() {
   //transacData();
   $('#transaction_list').DataTable().destroy();
   oTable = $('#transaction_list').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
   });
   detailsTableHtml = $("#detailsMFTable").html();
   $(document).on("click", ".transacData", function (e) {
      e.preventDefault();
      var siteurl = $('#siteurl').text();
      var nTr = $(this).parents('tr')[0];
      var rowIndex = nTr.rowIndex; 
      var objData = {};
      objData["id"] = $(this).attr("data-id");
      objData["val"] = $(this).attr("data-val");
      objData["view_tran_history"] = "yes";
      var tr = $(this).parents('tr');
      var row = oTable.row(tr);
      if ( row.child.isShown() ) {
         // This row is already open - close it
         row.child.hide();
         tr.removeClass('shown');
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
                  ordering: false, 
                  paging: true, 
                  scrollX: false, 
                  scrollY: false, 
                  searching: true, 
                  columns:[ 
                     { data:'purchase_date' },
                     {
                        data : null,
                        render: function ( data, type, row ) {
                           return "REDEEM";
                        }
                     },
                     { data:'unit' }, 
                     { data:'purchase_price' }, 
                     { data:'amount' }, 
                     { data:'trnx_id' }
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
    $("#invstd_val").text("₹"+invest_amt);
    $("#total_rtn").text("₹"+sum2);
    var pf = parseInt(sum1)-parseInt(invest_amt.replace(',', ''));
   if(pf>0) {
      $("#profit_loss_rtn").html('<i style="color: GREEN;" class="fa fa-arrow-up"></i>&nbsp;&nbsp;₹'+pf);
   } else {
      if(pf<0) {
            $("#profit_loss_rtn").html('<i style="color: RED;" class="fa fa-arrow-down"></i>&nbsp;&nbsp;₹'+pf);
      }
   }
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
   var sOut = "<table class='table table-bordered'  id='viewTrans_"+table_id+"' >";
    sOut += html;
    sOut += "</table>";
    return sOut;
}