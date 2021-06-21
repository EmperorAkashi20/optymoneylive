var oTable;
var iTableCounter = 1;
var oInnerTable;
var detailsTableHtml;
var pid = "";
var tempPercent = 100;
var dt = new Date();
var temp = 0;
var time = dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds();
var dateToday = dt.getDate() + ":" + (dt.getMonth() + 1) + ":" + dt.getFullYear();
const alphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ".split("");
$(document).ready(function () {
   $('[data-toggle="popover"]').popover({
      placement: 'bottom',
      trigger: 'hover',
      html: true
   });
   $('#guardiant_main').hide();
   $('.btnNext').on('click', function () {
      $('.nav-tabs .active').parent().next('li').find('a').trigger('click');
   });
   $('.btnPrevious').on('click', function () {
      $('.nav-tabs .active').parent().prev('li').find('a').trigger('click');
   });
   personalInfo();

   $('#custtab').tabs({
      select: function (event, ui) {
         var tabNumber = ui.index;
         var tabName = $(ui.tab).text();
         if (tabName == "Personal Information") { personalInfo(); }
         if (tabName == "Beneficiaries") { benificiary(); }
         if (tabName == "Assets") {
            var selectedList = $("#v-pills-tab a.active").attr("id");
            if (selectedList == "v-pills-ba-tab") {
               var selectedTabInAssets = $("#v-pills-ba_list li a.active").attr("href");
               var itemId = selectedTabInAssets.substring(1, selectedTabInAssets.length);
               if (itemId == "bankAccounts") {
                  bankAccounts();
               }
            }
         }
         if (tabName == "Executor") { executor(); }
         if (tabName == "Custodian") { custodian(); }
         if (tabName == "Witness") { witness(); }
         if (tabName == "Preview") { previewData(); }
      }
   });

   $('#balist').tabs({
      select: function (event, ui) {
         var tabNumber = ui.index;
         var tabName = $(ui.tab).text();
         if (tabName == "Bank Accounts") {
            bankAccounts();
         }
         if (tabName == "Lockers") {
            lockers();
         }
         if (tabName == "Fixed Deposits") {
            fixedDeposits();
         }
      }
   });

   $('#smfblist').tabs({
      select: function (event, ui) {
         var tabNumber = ui.index;
         var tabName = $(ui.tab).text();
         if (tabName == "Mutual Funds") {
            mutualFunds();
         }
         if (tabName == "Shares") {
            shares();
         }
         if (tabName == "Bonds") {
            bonds();
         }
      }
   });

   $('#rflist').tabs({
      select: function (event, ui) {
         var tabNumber = ui.index;
         var tabName = $(ui.tab).text();
         if (tabName == "Provident Funds") {
            providentFund();
         }
         if (tabName == "Pension Fund") {
            pensionFunds();
         }
         if (tabName == "Gratuity") {
            gratuity();
         }
      }
   });

   $('#oalist').tabs({
      select: function (event, ui) {
         var tabNumber = ui.index;
         var tabName = $(ui.tab).text();
         if (tabName == "OtherAssets") { otherAssets(); }
         if (tabName == "IPR") { ipr(); }
         if (tabName == "Vehicle") { vehicle(); }
      }
   });

   /* Bank Accounts Pill */
   $('#v-pills-ba-tab').click(function () { bankAccounts(); });
   /* Shares, Mutual Fund, Bonds pill */
   $('#v-pills-smfb-tab').click(function () { mutualFunds(); });
   /* Immovable Properties */
   $('#v-pills-ip-tab').click(function () { immovableProperties(); });
   /* Business */
   $('#v-pills-b-tab').click(function () { business(); });
   /* Retirement Funds */
   $('#v-pills-rf-tab').click(function () { providentFund(); });
   /* General Insurance */
   $('#v-pills-gi-tab').click(function () { generalInsurance(); });
   /* Life Insurance */
   $('#v-pills-lip-tab').click(function () { lifeInsurance(); });
   /* Jewel */
   $('#v-pills-j-tab').click(function () { jewels(); });
   /* body Organs */
   $('#v-pills-bo-tab').click(function () { bodyOrgans(); });
   /* Pet Animals */
   $('#v-pills-pa-tab').click(function () { petAnimals(); });
   /* Other Assets */
   $('#v-pills-oa-tab').click(function () { otherAssets() });
   /* Liabilities */
   $('#v-pills-l-tab').click(function () { liabilities(); });
   $(".add").on("click", function (e) {
      e.preventDefault();
      var temp = $(this).attr("href");
      $(temp).find("button.save").attr("data-role", "insert");
      if (temp == "#petAnimalModal") {
         updatebenList(temp, $(this));
      } else {
         if (temp == "#vehicleModal") {
            updatebenList(temp, $(this));
         }
      }
   });

   $(document).on("click", ".assignBen", function (e) {
      e.preventDefault();
      var temp = $(this).attr("data-modal");
      var nTr = $(this).parents('tr')[0];
      $('#btn_assign').attr("data-id", "");
      tempPercent = nTr.children[nTr.cells.length - 2].innerText;
      if (tempPercent == "") {
         tempPercent = 100;
      }
      updatebenList(temp, $(this));
      //var nTds = this;
      var rowIndex = nTr.rowIndex;
      var objData = {};
      var for_table = $(this).attr("data-table");
      var row_id = $(this).attr("data-id");
      var row_key = $(this).attr("data-key");
      var datatable = $(this).attr("data-datatable");
      var detailsRowData = "";//newRowData[rowIndex].details;
      objData["formName"] = "frmBeneficiary";
      objData["act"] = "getBen";
      objData["id"] = ""
      objData["data"] = "";
      objData["table"] = "will_assign_beneficiary";
      objData["for_table"] = $(this).attr("data-table");
      objData["for_form"] = $(this).attr("data-form");
      objData["row_id"] = $(this).attr("data-id");
      var tr = $(this).parents('tr');
      var row = oTable.row(tr);
      if (row.child.isShown()) {
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
            url: $("#frmBeneficiary")[0].action,
            type: "POST",
            data: objData,
            aynsc: false,
            beforeSend: function () {
               $('.ajax-loader').css("visibility", "visible");
            },
            complete: function () {
               $('.ajax-loader').css("visibility", "hidden");
            },
            success: function (response) {
               detailsRowData = JSON.parse(response);
               oInnerTable = $('#benTable_' + iTableCounter).DataTable({
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
                  columns: [
                     {
                        data: null,
                        render: function (data, type, row) {
                           return row.ben_fname + ' ' + row.ben_mname + ' ' + row.ben_lname
                        }
                     },
                     { data: 'txt_beneficiary_share' },
                     {
                        //objData["dbtable"] = $(this).attr("data-dbtable");
                        //objData["key_parent"] = $(this).attr("data-key_parent");
                        //objData["formType"] = formtype;
                        //objData["parent_row_id"] = $(this).attr("data-row_id");
                        data: null,
                        render: function (data, type, row) {
                           return '<button type="button" id="willEdit" class="btn btn-warning-rect willEdit" data-form="benAssign" data-id="' + row.pk_percent_id + '" data-key="pk_percent_id" data-table="will_assign_beneficiary" data-modal="beniBankModal" data-dbtable="' + for_table + '" data-row_id="' + row_id + '" data-key_parent="' + row_key + '"><i class="fa fa-edit"></i> Edit</button>' +
                              '<button type="button" id="willDelete" class="btn btn-danger-rect active willDelete" data-form="benAssign" data-for_table="' + datatable + '" data-for_table1="' + 'benTable_' + iTableCounter + '" data-id="' + row.pk_percent_id + '" data-key="pk_percent_id" data-table="will_assign_beneficiary" data-dbtable="' + for_table + '" data-row_id="' + row_id + '" data-key_parent="' + row_key + '"><i class="fa fa-trash-o"></i> Delete </button>';
                        }
                     }
                  ]
               });
               iTableCounter = iTableCounter + 1;
            }
         });
      }
      //$(temp).find("button.save").attr("data-role", "insert");
   });

   $(".save").on("click", function (e) {
      e.preventDefault();
      var form = $(this).parents('form:first');
      console.log("form Id : " + form.attr('id'));
      if ($('#' + form.attr('id')).valid()) {
         console.log(form.attr('id') + " is valid");
         var objData = {};
         var formtype = form[0].dataset.formtype;
         var tableId = $(this).attr("data-table");
         var data = $('#' + form[0].id).serializeFormJSON();
         data["for_table"] = $(this).attr("data-dbtable");
         data["row_id"] = $(this).attr("data-row_id");
         data["for_form"] = $(this).attr("data-form");
         objData["act"] = $(this).attr("data-role");
         objData["id"] = $(this).attr("data-id");
         objData["data"] = data;
         objData["table"] = $(this).attr("data-table");
         objData["dbtable"] = $(this).attr("data-dbtable");
         objData["key"] = $(this).attr("data-key");
         objData["key_parent"] = $(this).attr("data-key_parent");
         objData["formType"] = formtype;
         objData["parent_row_id"] = $(this).attr("data-row_id");
         var res = formSubmit(objData, form[0].action);
         if (res == 1) {
            if (formtype == 0) {
               alert("Successfully Updated");
            } else {
               alert("Successfully Updated");
               $('#' + form[0].id)[0].reset();
               var modalId = $(this).parents('div:first').parents('div:first').parents('div:first').parents('div:first').attr('id');
               $("#" + modalId).modal('hide');
               $('body').removeClass('modal-open')
               $('.modal-backdrop').remove();
            }
            if (tableId == "will_assign_beneficiary") {
               refreshTable($(this).attr("data-dbtable"));
            } else {
               refreshTable(tableId);
            }
         }
      } else {
         console.log("Form is not valid");
      }
   });

   $(document).on("click", ".willDelete", function (e) {
      e.preventDefault();
      var formId = $(this).attr("data-form");
      var form = $('#' + formId);
      var rowId = $(this).attr("data-id");
      var objData = {};
      var tableId = $(this).attr("data-table");
      objData["formName"] = formId;
      objData["act"] = "delete";
      objData["id"] = rowId;
      objData["data"] = "";
      objData["table"] = $(this).attr("data-table");
      objData["key"] = $(this).attr("data-key");

      objData["dbtable"] = $(this).attr("data-dbtable");
      objData["key_parent"] = $(this).attr("data-key_parent");
      objData["parent_row_id"] = $(this).attr("data-row_id");

      var res = formSubmit(objData, form[0].action);
      if (res == 1) {
         alert("Deleted Successfully");
         if (tableId == "will_assign_beneficiary") {
            refreshTable($(this).attr("data-dbtable"));
         } else {
            refreshTable(tableId);
         }
      }
   });

   $(document).on("click", ".willEdit", function (e) {
      e.preventDefault();
      var modalId = $(this).attr("data-modal");
      if (modalId == "beniBankModal") {
         updatebenList(modalId, $(this));
      }
      var formId = $(this).attr("data-form");
      var form = $('#' + formId);
      var rowId = $(this).attr("data-id");
      var objData = {};
      objData["formName"] = formId;
      objData["act"] = "getSingle";
      objData["id"] = rowId;
      objData["data"] = "";
      objData["table"] = $(this).attr("data-table");
      objData["key"] = $(this).attr("data-key");
      var res = formSubmit(objData, form[0].action);
      $('#' + modalId).modal('show');
      $('.save').attr('data-id', rowId);
      $('.save').attr('data-role', "update");
      $('#btn_assign').attr("data-row_id", $(this).attr("data-row_id"));
      //$('#btn_assign').attr("data-form", button[0].dataset.form);
      //$('#btn_assign').attr("data-for_table", button[0].dataset.table);
      //$('#btn_assign').attr("data-dbtable", button[0].dataset.dbtable);
      $('#btn_assign').attr("data-key_parent", $(this).attr("data-key_parent"));
      $.each(JSON.parse(res), function (key, val) {
         $('#' + key).val(val);
      });
   });

   ////////////////////////////////////////////////////////////
   detailsTableHtml = $("#detailsTable").html();
   $(document).on("click", ".willView", function () {
      var nTr = $(this).parents('tr')[0];
      tempPercent = nTr.children[nTr.cells.length - 2].innerText;
      if (tempPercent == "") {
         tempPercent = 100;
      }
      //var nTds = this;
      var rowIndex = nTr.rowIndex;
      var objData = {};
      var for_table = $(this).attr("data-table");
      var row_id = $(this).attr("data-id");
      var row_key = $(this).attr("data-key");
      var datatable = $(this).attr("data-datatable");
      var detailsRowData = "";//newRowData[rowIndex].details;
      objData["formName"] = "frmBeneficiary";
      objData["act"] = "getBen";
      objData["id"] = ""
      objData["data"] = "";
      objData["table"] = "will_assign_beneficiary";
      objData["for_table"] = $(this).attr("data-table");
      objData["for_form"] = $(this).attr("data-form");
      objData["row_id"] = $(this).attr("data-id");
      var tr = $(this).parents('tr');
      var row = oTable.row(tr);
      if (row.child.isShown()) {
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
            url: $("#frmBeneficiary")[0].action,
            type: "POST",
            data: objData,
            aynsc: false,
            beforeSend: function () {
               $('.ajax-loader').css("visibility", "visible");
            },
            complete: function () {
               $('.ajax-loader').css("visibility", "hidden");
            },
            success: function (response) {
               detailsRowData = JSON.parse(response);
               oInnerTable = $('#benTable_' + iTableCounter).DataTable({
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
                  columns: [
                     {
                        data: null,
                        render: function (data, type, row) {
                           return row.ben_fname + ' ' + row.ben_mname + ' ' + row.ben_lname
                        }
                     },
                     { data: 'txt_beneficiary_share' },
                     {
                        //objData["dbtable"] = $(this).attr("data-dbtable");
                        //objData["key_parent"] = $(this).attr("data-key_parent");
                        //objData["formType"] = formtype;
                        //objData["parent_row_id"] = $(this).attr("data-row_id");
                        data: null,
                        render: function (data, type, row) {
                           return '<button type="button" id="willEdit" class="btn btn-warning-rect willEdit" data-form="benAssign" data-id="' + row.pk_percent_id + '" data-key="pk_percent_id" data-table="will_assign_beneficiary" data-modal="beniBankModal" data-dbtable="' + for_table + '" data-row_id="' + row_id + '" data-key_parent="' + row_key + '"><i class="fa fa-edit"></i> Edit</button>' +
                              '<button type="button" id="willDelete" class="btn btn-danger-rect active willDelete" data-form="benAssign" data-for_table="' + datatable + '" data-for_table1="' + 'benTable_' + iTableCounter + '" data-id="' + row.pk_percent_id + '" data-key="pk_percent_id" data-table="will_assign_beneficiary" data-dbtable="' + for_table + '" data-row_id="' + row_id + '" data-key_parent="' + row_key + '"><i class="fa fa-trash-o"></i> Delete </button>';
                        }
                     }
                  ]
               });
               iTableCounter = iTableCounter + 1;
            }
         });
      }
   });

   $("#ba_ac_number").focusout(function () {
      duplicateCheck($(this).val(), 1);
   });
   $('#loc_number').focusout(function () {
      duplicateCheck($(this).val(), 1);
   });
   $('#fd_ac_number').focusout(function () {
      duplicateCheck($(this).val(), 1);
   });
   $('#mf_folio_number').focusout(function () {
      duplicateCheck($(this).val(), 2);
   });
   $('#pf_ac_number').focusout(function () {
      duplicateCheck($(this).val(), 0);
   });
   $('#pension_ac_number').focusout(function () {
      duplicateCheck($(this).val(), 0);
   });
   $('#gratuity_ac_number').focusout(function () {
      duplicateCheck($(this).val(), 0);
   });
   $('#gi_policy_number').focusout(function () {
      duplicateCheck($(this).val(), 0);
   });
   $('#li_policy_number').focusout(function () {
      duplicateCheck($(this).val(), 0);
   });
   $('#vehicle_reg_num').focusout(function () {
      duplicateCheck($(this).val(), 1);
   });
   $('#fk_ben_id').change(function () {
      duplicateBenCheck($(this).val(), 0);
   });

   $(".incap").change(function () {
      if ($(this).val() == '1') {
         $('#guardiant_main').show();
      }
      else if ($(this).val() == '0') {
         $('#guardiant_main').hide();
      }
   });
});

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

function previewData() {
   if ($('#frmProfiles').valid()) {
      if ($('#frmexecutordetails').valid()) {
         if ($('#frmCustodian').valid()) {
            if ($('#frmWitness').valid()) {
               temp1 = 0;
               var objData = {};
               objData["formName"] = "preview";
               objData["act"] = "getPreview";
               objData["id"] = ""
               objData["data"] = "";
               objData["table"] = "";
               temp = $.ajax({
                  url: $("#frmWitness")[0].action,
                  type: "POST",
                  data: objData,
                  async: false,
                  beforeSend: function () {
                     $('.ajax-loader').css("visibility", "visible");
                  },
                  success: function (response) {
                     var alphabetCount = 0;
                     var data = JSON.parse(response);
                     var willPersonalInfo = JSON.parse(data.bfsi_users_details);
                     userplace = willPersonalInfo[0].pi_place;
                     $('#willPreviewHTML tbody').empty();
                     $('#willPreviewHTML tbody').append('<tr><td><p align="center"><strong>LAST WILL AND TESTAMENT of ' + $('.dropdown-item.user_name span').text().trim() + '</strong></p></td></tr>');
                     $.each(willPersonalInfo, function (index, obj) {
                        $gender = "";
                        if (obj.sex == "Male") {
                           $gender = "Son";
                        } else {
                           if (obj.sex == "Female") {
                              $gender = "Daughter";
                           }
                        }
                        $('#willPreviewHTML tbody').append('<tr><td>' +
                           '<p><b>' + alphabet[alphabetCount] + '. PERSONAL PROFILE</b></p>' +
                           '<p style="margin-top: 20px;">I, <strong>'+$('.dropdown-item.user_name span').text().trim()+'</strong><strong> '+$gender+' </strong> of <strong>'+obj.father_name+'</strong>, currently residing at <strong>'+obj.address1+'&nbsp;'+obj.address2+','+obj.city+','+stateName(obj.state)+','+countryName(obj.country)+','+obj.pincode+'</strong>, <strong>'+obj.religion+'</strong> by religion, <strong>'+obj.nationality+'</strong> by nationality, aged about <strong>'+obj.age+'</strong>, having <strong>PAN No.</strong>, <strong>Aadhar No. '+obj.pan_number+'/'+obj.aadhaar_no+'</strong> do hereby revoke all my previous Wills and declare that this is my last Will. </strong></p>'+
                           '<p style="margin-top: 20px;">I declare that I am writing this Will out of my free volition and am solely making this independent decision without any coercion or under any undue influence whatsoever and I maintain good health & possess a sound mind.</p>' +
                           '</td></tr>');
                     });
                     alphabetCount++;

                     var willBeneficiaries = JSON.parse(data.will_beneficiary);
                     if (willBeneficiaries.length != 0) {
                        var i = 1;
                        $('#willPreviewHTML tbody').append('<tr><td><p><b>' + alphabet[alphabetCount] + '. FAMILY DESCRIPTION/BENEFICIARIES</b></p></td></tr>');
                        $.each(willBeneficiaries, function (index, obj) {
                           $('#willPreviewHTML tbody').append('<tr><td><p>' + i + ") <b>" + obj.ben_fname + '&nbsp;' + obj.ben_mname + '&nbsp;' + obj.ben_lname + '</b> my <b>' + relationName(obj.ben_rel_with_testator) + '</b> aged <b>' + obj.ben_age + '</b> years residing at ' + obj.ben_perm_addr1 + ',' + obj.ben_perm_addr2 + ',' + obj.ben_perm_city + ',' + stateName(obj.ben_perm_state) + ',' + countryName(obj.ben_perm_country) + '-' + obj.ben_perm_zip + '.</p></td></tr>');
                           var rel = "";
                           if (jQuery.inArray(obj.exe_title, [1, 10, 23]) != -1) {
                              rel = "Son";
                           } else {
                              rel = "Daughter";
                           }
                           if (obj.ben_age <= 18) {
                              $('#willPreviewHTML tbody').append('<tr><td><b>D. GUARDIAN DETAILS</b><p>I hereby appoint <b>' + obj.ben_gard_fname + '&nbsp;' + obj.ben_gard_mname + '&nbsp;' + obj.ben_gard_lname + '</b> ' + rel + ' of ' + obj.ben_gard_father_fname + '&nbsp;' + obj.ben_gard_father_mname + '&nbsp;' + obj.ben_gard_father_lname + ' by religion ' + obj.ben_gard_religious + ', ' + obj.ben_gard_nationality + ' by nationality, aged about ' + obj.ben_gard_age + ' having occupation ' + occupationName(obj.ben_gard_occupation) + ' currently residing at ' + obj.ben_gard_perm_addr1 + ', ' + obj.ben_gard_perm_addr2 + ', ' + obj.ben_gard_perm_city + ', ' + stateName(obj.ben_gard_perm_state) + ', ' + countryName(obj.ben_gard_perm_country) + ' - ' + obj.ben_gard_perm_zip + ' as Guardian of my minor ' + rel + ' <b>' + obj.ben_fname + '&nbsp;' + obj.ben_mname + '&nbsp;' + obj.ben_lname + '</b> for the personal care and his/her property till he/she attains age of 18 years</p>' +
                                 '<p>Relationship of the Guardian with the minor ' + relationName(obj.ben_rel_with_testator) + '</p></td></tr>');
                           }
                           i++;
                        });
                        alphabetCount++;
                     }

                     var willExecutor = JSON.parse(data.will_executor);
                     if (willExecutor.length != 0) {
                        $('#willPreviewHTML tbody').append('<tr><td><p><b>' + alphabet[alphabetCount] + '. APPOINTMENT OF EXECUTOR</b></p></td></tr>');
                        $.each(willExecutor, function (index, obj) {
                           var rel = "";
                           if (jQuery.inArray(obj.exe_title, [1, 10, 23]) != -1) {
                              rel = "Son";
                           } else {
                              rel = "Daughter";
                           }
                           $('#willPreviewHTML tbody').append('<tr><td><p>I hereby appoint <b>' + obj.exe_fname + '&nbsp;' + obj.exe_mname + '&nbsp;' + obj.exe_lname + '</b> ' + rel + ' of ' + obj.exe_father_fname + '&nbsp;' + obj.exe_father_mname + '&nbsp;' + obj.exe_father_lname + '&nbsp;' + religionName(obj.exe_religious) + ' by religion, ' + obj.exe_nationality + ' by nationality, aged about ' + obj.exe_age + ' having occupation ' + obj.exe_occupation + ' currently residing at ' + obj.exe_perm_addr1 + ', ' + obj.exe_perm_addr2 + ', ' + obj.exe_perm_city + ', ' + stateName(obj.exe_perm_state) + ', ' + countryName(obj.exe_perm_country) + ' - ' + obj.exe_perm_zip + ' to be the Sole Executor of this Will.</p></td></tr>');
                        });
                        alphabetCount++;
                     }

                     $.each(willBeneficiaries, function (index, obj) {
                        var rel = "";
                        if (jQuery.inArray(obj.exe_title, [1, 10, 23]) != -1) {
                           rel = "Son";
                        } else {
                           rel = "Daughter";
                        }
                        if (obj.ben_age <= 18) {
                           $('#willPreviewHTML tbody').append('<tr><td><p><b>' + alphabet[alphabetCount] + '. GUARDIAN DETAILS</b></p><p>I hereby appoint <b>' + obj.ben_gard_fname + '&nbsp;' + obj.ben_gard_mname + '&nbsp;' + obj.ben_gard_lname + '</b> ' + rel + ' of ' + obj.ben_gard_father_fname + '&nbsp;' + obj.ben_gard_father_mname + '&nbsp;' + obj.ben_gard_father_lname + ' by religion ' + obj.ben_gard_religious + ', ' + obj.ben_gard_nationality + ' by nationality, aged about ' + obj.ben_gard_age + ' having occupation ' + occupationName(obj.ben_gard_occupation) + ' currently residing at ' + obj.ben_gard_perm_addr1 + ', ' + obj.ben_gard_perm_addr2 + ', ' + obj.ben_gard_perm_city + ', ' + stateName(obj.ben_gard_perm_state) + ', ' + countryName(obj.ben_gard_perm_country) + ' - ' + obj.ben_gard_perm_zip + ' as Guardian of my minor ' + rel + ' <b>' + obj.ben_fname + '&nbsp;' + obj.ben_mname + '&nbsp;' + obj.ben_lname + '</b> for the personal care and his/her property till he/she attains age of 18 years</p>' +
                              '<p>Relationship of the Guardian with the minor ' + relationName(obj.ben_rel_with_testator) + '</p></td></tr>');
                        }
                        alphabetCount++;
                     });

                     var willImmovableProperties = JSON.parse(data.will_immovable_properties);
                     if (willImmovableProperties.length != 0) {
                        var i = 1;
                        $('#willPreviewHTML tbody').append('<tr><td><p><b>' + alphabet[alphabetCount] + '. DISTRIBUTION OF ASSETS</b></p><p>Presently, I have the following estates consisting of both immovable and movable properties, and I hereby give, leave and bequeath the following legacies to be effected out of my estates after the event of my death, viz;</p></td></tr>');
                        $.each(willImmovableProperties, function (index, obj) {
                           if (obj.property_ownership_status == "single") {
                              if (obj.property_type == "Ag land") {
                                 $('#willPreviewHTML tbody').append('<tr><td><p>' + i + ') &nbsp;a. My agricultural land measuring ' + obj.property_measurement + '&nbsp; located at ' + obj.property_addr1 + ',' + obj.property_addr2 + ',' + obj.property_city + ',' + stateName(obj.property_state) + ',' + countryName(obj.property_country) + '-' + obj.property_zip + ' having ' + obj.property_ownership_status + ' ownership to be given in favour of below beneficiaries</p></td></tr>');
                              } else {
                                 if (obj.property_type == "Non Ag. Land") {
                                    $('#willPreviewHTML tbody').append('<tr><td><p>' + i + ') &nbsp;a. My non-agricultural land measuring ' + obj.property_measurement + '&nbsp; located at ' + obj.property_addr1 + ',' + obj.property_addr2 + ',' + obj.property_city + ',' + stateName(obj.property_state) + ',' + countryName(obj.property_country) + '-' + obj.property_zip + ' having ' + obj.property_ownership_status + ' ownership to be given in favour of below beneficiaries</p></td></tr>');
                                 } else {
                                    if (obj.property_type == "C. Building") {
                                       $('#willPreviewHTML tbody').append('<tr><td><p>' + i + ') &nbsp;a. My commercial building of ' + obj.property_measurement + '&nbsp; located at ' + obj.property_addr1 + ',' + obj.property_addr2 + ',' + obj.property_city + ',' + stateName(obj.property_state) + ',' + countryName(obj.property_country) + '-' + obj.property_zip + ' having ' + obj.property_ownership_status + ' ownership to be given in favour of below beneficiaries</p></td></tr>');
                                    } else {
                                       if (obj.property_type == "R. building") {
                                          $('#willPreviewHTML tbody').append('<tr><td><p>' + i + ') &nbsp;a. My residential building of ' + obj.property_measurement + '&nbsp; located at ' + obj.property_addr1 + ',' + obj.property_addr2 + ',' + obj.property_city + ',' + stateName(obj.property_state) + ',' + countryName(obj.property_country) + '-' + obj.property_zip + ' having ' + obj.property_ownership_status + ' ownership to be given in favour of below beneficiaries</p></td></tr>');
                                       } else {
                                          if (obj.property_type == "Factory") {
                                             $('#willPreviewHTML tbody').append('<tr><td><p>' + i + ') &nbsp;a. I holding Factory including/or Plant and Machinery located at ' + obj.property_addr1 + ',' + obj.property_addr2 + ',' + obj.property_city + ',' + stateName(obj.property_state) + ',' + countryName(obj.property_country) + '-' + obj.property_zip + ' having ' + obj.property_ownership_status + ' ownership to be given in favour of below beneficiaries</p></td></tr>');
                                          } else {
                                             $('#willPreviewHTML tbody').append('');
                                          }
                                       }
                                    }
                                 }
                              }
                           } else {
                              if (obj.property_type == "Ag land") {
                                 $('#willPreviewHTML tbody').append('<tr><td><p>b. <b>' + obj.property_ownership_perc + '%</b> of my agricultural land measuring ' + obj.property_measurement + ' located at ' + obj.property_addr1 + ',' + obj.property_addr2 + ',' + obj.property_city + ',' + stateName(obj.property_state) + ',' + countryName(obj.property_country) + '-' + obj.property_zip + ' having ' + obj.property_ownership_status + ' ownership to be given in favour of below beneficiaries</p></td></tr>');
                              } else {
                                 if (obj.property_type == "Non Ag. Land") {
                                    $('#willPreviewHTML tbody').append('<tr><td><p>b. <b>' + obj.property_ownership_perc + '%</b> of my non-agricultural land measuring ' + obj.property_measurement + ' located at ' + obj.property_addr1 + ',' + obj.property_addr2 + ',' + obj.property_city + ',' + stateName(obj.property_state) + ',' + countryName(obj.property_country) + '-' + obj.property_zip + ' having ' + obj.property_ownership_status + ' ownership to be given in favour of below beneficiaries</p></td></tr>');
                                 } else {
                                    if (obj.property_type == "C. Building") {
                                       $('#willPreviewHTML tbody').append('<tr><td><p>b. <b>' + obj.property_ownership_perc + '%</b> of my commercial building ' + obj.property_measurement + ' located at ' + obj.property_addr1 + ',' + obj.property_addr2 + ',' + obj.property_city + ',' + stateName(obj.property_state) + ',' + countryName(obj.property_country) + '-' + obj.property_zip + ' having ' + obj.property_ownership_status + ' ownership to be given in favour of below beneficiaries</p></td></tr>');
                                    } else {
                                       if (obj.property_type == "R. building") {
                                          $('#willPreviewHTML tbody').append('<tr><td><p>b. <b>' + obj.property_ownership_perc + '%</b> of my residential building ' + obj.property_measurement + ' located at ' + obj.property_addr1 + ',' + obj.property_addr2 + ',' + obj.property_city + ',' + stateName(obj.property_state) + ',' + countryName(obj.property_country) + '-' + obj.property_zip + ' having ' + obj.property_ownership_status + ' ownership to be given in favour of below beneficiaries</p></td></tr>');
                                       } else {
                                          if (obj.property_type == "Factory") {
                                             $('#willPreviewHTML tbody').append('<tr><td><p>b. <b>' + obj.property_ownership_perc + '%</b> of my Factory including/or Plant and Machinery located at ' + obj.property_addr1 + ',' + obj.property_addr2 + ',' + obj.property_city + ',' + stateName(obj.property_state) + ',' + countryName(obj.property_country) + '-' + obj.property_zip + ' having ' + obj.property_ownership_status + ' ownership to be given in favour of below beneficiaries</p></td></tr>');
                                          } else {
                                             $('#willPreviewHTML tbody').append('');
                                          }
                                       }
                                    }
                                 }
                              }
                           }
                           $.each(JSON.parse(obj.ben), function (index1, obj1) {
                              $('#willPreviewHTML tbody').append('<tr><td><p>' + obj1.txt_beneficiary_share + '% to my <b>' + relationName(obj1.ben_rel_with_testator) + '</b> named <b>' + titleList(obj1.ben_title) + '. ' + obj1.ben_fname + ' ' + obj1.ben_mname + ' ' + obj1.ben_lname + '</b></p></td></tr>');
                           });
                           i++;
                        });
                        alphabetCount++;
                     }
                     /* Movable Properties */
                     /* Bank Accounts */
                     $('#willPreviewHTML tbody').append('<tr><td><p><b>' + alphabet[alphabetCount] + '. MOVABLE PROPERTY</b></p></td></tr>');
                     var will_bank_accounts = JSON.parse(data.will_bank_accounts);
                     if (will_bank_accounts.length != 0) {
                        var i = 1;
                        $('#willPreviewHTML tbody').append('<tr><td><p><b>BANK ACCOUNT DETAILS</b></p></td></tr>');
                        $('#willPreviewHTML tbody').append('<tr><td>');
                        $.each(will_bank_accounts, function (index, obj) {
                           if (obj.ba_ownership_perc == "100") {
                              $('#willPreviewHTML tbody').append('<tr><td><p>' + i + ') &nbsp;My ' + accountType(obj.ba_account_type) + ' bank account having account number ' + obj.ba_ac_number + '&nbsp; maintained with ' + obj.ba_bank_name + ' bank ' + obj.ba_branch_name + ' branch located at ' + obj.ba_addr1 + ',' + obj.ba_addr2 + ',' + obj.ba_city + ',' + stateName(obj.ba_state) + ',' + countryName(obj.ba_country) + '-' + obj.ba_zip + ' to be given in favour of my below beneficiaries</p></td></tr>');
                              $.each(JSON.parse(obj.ben), function (index1, obj1) {
                                 $('#willPreviewHTML tbody').append('<tr><td><p>' + obj1.txt_beneficiary_share + '% to my <b>' + relationName(obj1.ben_rel_with_testator) + '</b> named <b>' + titleList(obj1.ben_title) + '. ' + obj1.ben_fname + ' ' + obj1.ben_mname + ' ' + obj1.ben_lname + '</b></p></td></tr>');
                              });
                           } else {
                              $('#willPreviewHTML tbody').append('<tr><td><p><b>' + obj.ba_ownership_perc + '%</b> of my ' + accountType(obj.ba_account_type) + ' bank account having account number ' + obj.ba_ac_number + ' maintained with ' + obj.ba_bank_name + ' ' + obj.ba_branch_name + ' branch located at ' + obj.ba_addr1 + ', ' + obj.ba_addr2 + ', ' + obj.ba_city + ',' + stateName(obj.ba_state) + ',' + countryName(obj.ba_country) + '-' + obj.ba_zip + ' to be given in favour of my below beneficiaries</p></td></tr>');
                              $.each(JSON.parse(obj.ben), function (index1, obj1) {
                                 $('#willPreviewHTML tbody').append('<tr><td><p>' + obj1.txt_beneficiary_share + '% to my <b>' + relationName(obj1.ben_rel_with_testator) + '</b> named <b>' + titleList(obj1.ben_title) + '. ' + obj1.ben_fname + ' ' + obj1.ben_mname + ' ' + obj1.ben_lname + '</b></p></td></tr>');
                              });
                           }
                           i++;
                        });
                     }
                     /* Bank Lockers */
                     var will_locker_info = JSON.parse(data.will_locker_info);
                     if (will_locker_info.length != 0) {
                        var i = 1;
                        $('#willPreviewHTML tbody').append('<tr><td><p><b>BANK LOCKER DETAILS</b></p></td></tr>');
                        $.each(will_locker_info, function (index, obj) {
                           if (obj.loc_ownership_perc == "100") {
                              $('#willPreviewHTML tbody').append('<tr><td><p>' + i + ') &nbsp;The contents of Bank Locker number ' + obj.loc_number + '&nbsp; maintained with ' + obj.loc_bank_name + ' bank ' + obj.loc_branch_name + ' branch, located at ' + obj.loc_addr1 + ', ' + obj.loc_addr2 + ', ' + obj.loc_city + ', ' + stateName(obj.loc_state) + ', ' + countryName(obj.loc_country) + '-' + obj.loc_zip + ' to be given in favour of </p></td></tr>');
                              $.each(JSON.parse(obj.ben), function (index1, obj1) {
                                 $('#willPreviewHTML tbody').append('<tr><td><p>' + obj1.txt_beneficiary_share + '% to my <b>' + relationName(obj1.ben_rel_with_testator) + '</b> named <b>' + titleList(obj1.ben_title) + '. ' + obj1.ben_fname + ' ' + obj1.ben_mname + ' ' + obj1.ben_lname + '</b></p></td></tr>');
                              });
                           } else {
                              $('#willPreviewHTML tbody').append('<tr><td><p>' + i + ') &nbsp;<b>' + obj.loc_ownership_perc + '%</b> of the contents of Bank Locker number ' + obj.loc_number + ' maintained with ' + obj.loc_bank_name + ' ' + obj.loc_branch_name + ' branch, located at ' + obj.loc_addr1 + ', ' + obj.loc_addr2 + ', ' + obj.loc_city + ',' + stateName(obj.loc_state) + ',' + countryName(obj.loc_country) + '-' + obj.loc_zip + ' to be given in favour of </p></td></tr>');
                              $.each(JSON.parse(obj.ben), function (index1, obj1) {
                                 $('#willPreviewHTML tbody').append('<tr><td><p>' + obj1.txt_beneficiary_share + '% to my <b>' + relationName(obj1.ben_rel_with_testator) + '</b> named <b>' + titleList(obj1.ben_title) + '. ' + obj1.ben_fname + ' ' + obj1.ben_mname + ' ' + obj1.ben_lname + '</b></p></td></tr>');
                              });
                           }
                           i++;
                        });
                     }
                     /* Fixed Deposits */
                     var will_fixed_deposit = JSON.parse(data.will_fixed_deposit);
                     if (will_fixed_deposit.length != 0) {
                        var i = 1;
                        $('#willPreviewHTML tbody').append('<tr><td><p><b>FIXED DEPOSIT DETAILS</b></p></td></tr>');
                        $.each(will_fixed_deposit, function (index, obj) {
                           if (obj.fd_ownership_perc == "100") {
                              $('#willPreviewHTML tbody').append('<tr><td><p>' + i + ') &nbsp;My Fixed Deposits maintained with ' + obj.fd_bank_name + ' bank ' + obj.fd_branch_name + ' branch, situated at ' + obj.fd_addr1 + ', ' + obj.fd_addr2 + ', ' + obj.fd_city + ', ' + stateName(obj.fd_state) + ', ' + countryName(obj.fd_country) + '-' + obj.fd_zip + ' bearing FD Account Number ' + obj.fd_ac_number + ' to be given in favour of </p></td></tr>');
                              $.each(JSON.parse(obj.ben), function (index1, obj1) {
                                 $('#willPreviewHTML tbody').append('<tr><td><p>' + obj1.txt_beneficiary_share + '% to my <b>' + relationName(obj1.ben_rel_with_testator) + '</b> named <b>' + titleList(obj1.ben_title) + '. ' + obj1.ben_fname + ' ' + obj1.ben_mname + ' ' + obj1.ben_lname + '</b></p></td></tr>');
                              });
                           } else {
                              $('#willPreviewHTML tbody').append('<tr><td><p>' + i + ') &nbsp;<b>' + obj.fd_ownership_perc + '%</b> of My Fixed Deposits maintained with ' + obj.fd_bank_name + ' bank ' + obj.fd_branch_name + ' branch, situated at ' + obj.fd_addr1 + ', ' + obj.fd_addr2 + ', ' + obj.fd_city + ', ' + stateName(obj.fd_state) + ', ' + countryName(obj.fd_country) + '-' + obj.fd_zip + ' bearing FD Account Number ' + obj.fd_ac_number + ' to be given in favour of </p></td></tr>');
                              $.each(JSON.parse(obj.ben), function (index1, obj1) {
                                 $('#willPreviewHTML tbody').append('<tr><td><p>' + obj1.txt_beneficiary_share + '% to my <b>' + relationName(obj1.ben_rel_with_testator) + '</b> named <b>' + titleList(obj1.ben_title) + '. ' + obj1.ben_fname + ' ' + obj1.ben_mname + ' ' + obj1.ben_lname + '</b></p></td></tr>');
                              });
                           }

                           i++;
                        });
                        $('#willPreviewHTML tbody').append('</td></tr>');
                     }
                     /* Mutual Fund */
                     var will_mutual_fund = JSON.parse(data.will_mutual_fund);
                     if (will_mutual_fund.length != 0) {
                        var i = 1;
                        $('#willPreviewHTML tbody').append('<tr><td><p><b>MUTUAL FUND DETAILS</b></p></td></tr>');
                        $.each(will_mutual_fund, function (index, obj) {
                           $('#willPreviewHTML tbody').append('<tr><td><p>' + i + ') &nbsp;<b>' + obj.mf_share_count + '</b> units of My Mutual Fund investments amounting to Rs. ' + obj.mf_amount + ' (Rupees ) of various fund houses ' + obj.mf_name + ' to be given in favour of </p></td></tr>');
                           $.each(JSON.parse(obj.ben), function (index1, obj1) {
                              $('#willPreviewHTML tbody').append('<tr><td><p>' + obj1.txt_beneficiary_share + '% to my <b>' + relationName(obj1.ben_rel_with_testator) + '</b> named <b>' + titleList(obj1.ben_title) + '. ' + obj1.ben_fname + ' ' + obj1.ben_mname + ' ' + obj1.ben_lname + '</b></p></td></tr>');
                           });
                           i++;
                        });
                        $('#willPreviewHTML tbody').append('</td></tr>');
                     }
                     /* General Insurance */
                     var will_general_insurance = JSON.parse(data.will_general_insurance);
                     if (will_general_insurance.length != 0) {
                        var i = 1;
                        $('#willPreviewHTML tbody').append('<tr><td><p><b>GENERAL INSURANCE DETAILS</b></p></td></tr>');
                        $('#willPreviewHTML tbody').append('<tr><td>');
                        $.each(will_general_insurance, function (index, obj) {
                           $('#willPreviewHTML tbody').append('<tr><td><p>' + i + ') &nbsp;The proceeds of my ' + obj.gi_policy_type + ' insurance policy of ' + obj.gi_com_name + ' having policy number ' + obj.gi_policy_number + ' from ' + obj.gi_policy_start_date + ' to ' + obj.gi_maturity_date + ' Rs. ' + obj.gi_amount + ' to be given in favour of </p></td></tr>');
                           $.each(JSON.parse(obj.ben), function (index1, obj1) {
                              $('#willPreviewHTML tbody').append('<tr><td><p>' + obj1.txt_beneficiary_share + '% to my <b>' + relationName(obj1.ben_rel_with_testator) + '</b> named <b>' + titleList(obj1.ben_title) + '. ' + obj1.ben_fname + ' ' + obj1.ben_mname + ' ' + obj1.ben_lname + '</b></p></td></tr>');
                           });
                           i++;
                        });
                        $('#willPreviewHTML tbody').append('</td></tr>');
                     }
                     /* Shares */
                     var will_share = JSON.parse(data.will_share);
                     if (will_share.length != 0) {
                        var i = 1;
                        $('#willPreviewHTML tbody').append('<tr><td><p><b>SHARES DETAILS</b></p></td></tr>');
                        $('#willPreviewHTML tbody').append('<tr><td>');
                        $.each(will_share, function (index, obj) {
                           $('#willPreviewHTML tbody').append('<tr><td><p>' + i + ') &nbsp;My investments in shares amounting to Rs. ' + obj.share_amount + ' (Rupees ) of various entities held in Demat form having Account number ' + obj.share_demat_number + ' with ' + obj.share_company_name + ' to be given in favour of </p></td></tr>');
                           $.each(JSON.parse(obj.ben), function (index1, obj1) {
                              $('#willPreviewHTML tbody').append('<tr><td><p>' + obj1.txt_beneficiary_share + '% to my <b>' + relationName(obj1.ben_rel_with_testator) + '</b> named <b>' + titleList(obj1.ben_title) + '. ' + obj1.ben_fname + ' ' + obj1.ben_mname + ' ' + obj1.ben_lname + '</b></p></td></tr>');
                           });
                           i++;
                        });
                        $('#willPreviewHTML tbody').append('</td></tr>');
                     }
                     /* Bonds */
                     var will_bond_details = JSON.parse(data.will_bond_details);
                     if (will_bond_details.length != 0) {
                        var i = 1;
                        $('#willPreviewHTML tbody').append('<tr><td><p><b>BOND DETAILS</b></p></td></tr>');
                        $('#willPreviewHTML tbody').append('<tr><td>');
                        $.each(will_bond_details, function (index, obj) {
                           $('#willPreviewHTML tbody').append('<tr><td><p>' + i + ') &nbsp;My investments in bonds amounting to Rs. ' + obj.bond_amount + ' (Rupees ) of various entities held in Demat form having Account number ' + obj.bond_dmat_number + ' under ' + obj.bond_scheme_details + ' scheme with ' + obj.bond_bank_name + ' to be given in favour of </p></td></tr>');
                           $.each(JSON.parse(obj.ben), function (index1, obj1) {
                              $('#willPreviewHTML tbody').append('<tr><td><p>' + obj1.txt_beneficiary_share + '% to my <b>' + relationName(obj1.ben_rel_with_testator) + '</b> named <b>' + titleList(obj1.ben_title) + '. ' + obj1.ben_fname + ' ' + obj1.ben_mname + ' ' + obj1.ben_lname + '</b></p></td></tr>');
                           });
                           i++;
                        });
                        $('#willPreviewHTML tbody').append('</td></tr>');
                     }
                     /* Provident Fund */
                     var will_ppf_info = JSON.parse(data.will_ppf_info);
                     if (will_ppf_info.length != 0) {
                        var i = 1;
                        $('#willPreviewHTML tbody').append('<tr><td><p><b>PUBLIC PROVIDENT FUND DETAILS</b></p></td></tr>');
                        $('#willPreviewHTML tbody').append('<tr><td>');
                        $.each(will_ppf_info, function (index, obj) {
                           $('#willPreviewHTML tbody').append('<tr><td><p>' + i + ') &nbsp;My investments in bonds amounting to Rs. ' + obj.bond_amount + ' (Rupees ) of various entities held in Demat form having Account number ' + obj.bond_dmat_number + ' under ' + obj.bond_scheme_details + ' scheme with ' + obj.bond_bank_name + ' to be given in favour of </p></td></tr>');
                           $.each(JSON.parse(obj.ben), function (index1, obj1) {
                              $('#willPreviewHTML tbody').append('<tr><td><p>' + obj1.txt_beneficiary_share + '% to my <b>' + relationName(obj1.ben_rel_with_testator) + '</b> named <b>' + titleList(obj1.ben_title) + '. ' + obj1.ben_fname + ' ' + obj1.ben_mname + ' ' + obj1.ben_lname + '</b></p></td></tr>');
                           });
                           i++;
                        });
                        $('#willPreviewHTML tbody').append('</td></tr>');
                     }
                     /* Pension Fund */
                     var will_pension_funds = JSON.parse(data.will_pension_funds);
                     if (will_pension_funds.length != 0) {
                        var i = 1;
                        $('#willPreviewHTML tbody').append('<tr><td><p><b>PENSION DETAILS</b></p></td></tr>');
                        $('#willPreviewHTML tbody').append('<tr><td>');
                        $.each(will_pension_funds, function (index, obj) {
                           $('#willPreviewHTML tbody').append('<tr><td><p>' + i + ') &nbsp;I holding Pension Fund under account number ' + obj.pension_ac_number + ' with ' + obj.pension_company_name + ' having registered office at ' + obj.pension_addr1 + ',' + obj.pension_addr2 + ',' + obj.pension_city + ',' + stateName(obj.pension_state) + ',' + countryName(obj.pension_country) + '-' + obj.pension_zip + ' to be given in favour of </p></td></tr>');
                           $.each(JSON.parse(obj.ben), function (index1, obj1) {
                              $('#willPreviewHTML tbody').append('<tr><td><p>' + obj1.txt_beneficiary_share + '% to my <b>' + relationName(obj1.ben_rel_with_testator) + '</b> named <b>' + titleList(obj1.ben_title) + '. ' + obj1.ben_fname + ' ' + obj1.ben_mname + ' ' + obj1.ben_lname + '</b></p></td></tr>');
                           });
                           i++;
                        });
                        $('#willPreviewHTML tbody').append('</td></tr>');
                     }
                     /* Gratuity */
                     var will_gratuity = JSON.parse(data.will_gratuity);
                     if (will_gratuity.length != 0) {
                        var i = 1;
                        $('#willPreviewHTML tbody').append('<tr><td><p><b>GRATUITY DETAILS</b></p></td></tr>');
                        $('#willPreviewHTML tbody').append('<tr><td>');
                        $.each(will_gratuity, function (index, obj) {
                           $('#willPreviewHTML tbody').append('<tr><td><p>' + i + ') &nbsp;I holding Gratuity under account number ' + obj.gratuity_ac_number + ' with ' + obj.gratuity_company_name + ' having registered office at ' + obj.gratuity_addr1 + ',' + obj.v_addr2 + ',' + obj.gratuity_city + ',' + stateName(obj.gratuity_state) + ',' + countryName(obj.gratuity_country) + '-' + obj.gratuity_zip + ' to be given in favour of </p></td></tr>');
                           $.each(JSON.parse(obj.ben), function (index1, obj1) {
                              $('#willPreviewHTML tbody').append('<tr><td><p>' + obj1.txt_beneficiary_share + '% to my <b>' + relationName(obj1.ben_rel_with_testator) + '</b> named <b>' + titleList(obj1.ben_title) + '. ' + obj1.ben_fname + ' ' + obj1.ben_mname + ' ' + obj1.ben_lname + '</b></p></td></tr>');
                           });
                           i++;
                        });
                        $('#willPreviewHTML tbody').append('</td></tr>');
                     }
                     /* Life Insurance Policy */
                     var will_lic = JSON.parse(data.will_lic);
                     if (will_lic.length != 0) {
                        var i = 1;
                        $('#willPreviewHTML tbody').append('<tr><td><p><b>LIFE INSURANCE DETAILS</b></p></td></tr>');
                        $('#willPreviewHTML tbody').append('<tr><td>');
                        $.each(will_lic, function (index, obj) {
                           $('#willPreviewHTML tbody').append('<tr><td><p>' + i + ') &nbsp;I holding Life Insurance Policy having policy number ' + obj.li_policy_number + ' of Rs. ' + obj.li_sum_assured + ' (Rupees ) issued by ' + obj.li_issuer_name + ' ' + obj.li_branch_name + ' from ' + obj.li_start_date + ' to ' + obj.li_maturity_date + ' to be given in favour of </p></td></tr>');
                           $.each(JSON.parse(obj.ben), function (index1, obj1) {
                              $('#willPreviewHTML tbody').append('<tr><td><p>' + obj1.txt_beneficiary_share + '% to my <b>' + relationName(obj1.ben_rel_with_testator) + '</b> named <b>' + titleList(obj1.ben_title) + '. ' + obj1.ben_fname + ' ' + obj1.ben_mname + ' ' + obj1.ben_lname + '</b></p></td></tr>');
                           });
                           i++;
                        });
                        $('#willPreviewHTML tbody').append('</td></tr>');
                     }
                     /* Vehicle */
                     var will_vehicle = JSON.parse(data.will_vehicle);
                     if (will_vehicle.length != 0) {
                        var i = 1;
                        $('#willPreviewHTML tbody').append('<tr><td><p><b>VEHICLE DETAILS</b></p></td></tr>');
                        $('#willPreviewHTML tbody').append('<tr><td>');
                        $.each(will_vehicle, function (index, obj) {
                           $('#willPreviewHTML tbody').append('<tr><td><p>' + i + ') &nbsp;' + obj.vehicle_name + ' having registration number ' + obj.vehicle_reg_num + ' in ' + obj.vehicle_color + ' registered under my name to be given in favour of my <b>relation</b> named <b>' + obj.vehicle_beneficiary + '</b></p></td></tr>');
                           i++;
                        });
                        $('#willPreviewHTML tbody').append('</td></tr>');
                     }

                     $('#willPreviewHTML tbody').append('<tr><td><p><b>ANY OTHER MOVABLE PROPERTIES NOT MENTIONED ABOVE</b></p></td></tr>');

                     /* Business */
                     var will_business = JSON.parse(data.will_business);
                     if (will_business.length != 0) {
                        var i = 1;
                        $('#willPreviewHTML tbody').append('<tr><td>');
                        $.each(will_business, function (index, obj) {
                           $('#willPreviewHTML tbody').append('<tr><td><p>' + i + ') &nbsp;I carrying on business of ' + obj.business_type + ' having ' + obj.business_owner_type + ' ownership under the name and style of ' + obj.business_company_name + ' located at ' + obj.business_addr1 + ', ' + obj.business_addr2 + ', ' + obj.business_city + ',' + stateName(obj.business_state) + ',' + countryName(obj.business_country) + '-' + obj.business_zip + ' to be given in favour of the below beneficiaries</p></td></tr>');
                           $.each(JSON.parse(obj.ben), function (index1, obj1) {
                              $('#willPreviewHTML tbody').append('<tr><td><p>' + obj1.txt_beneficiary_share + ' to my <b>' + relationName(obj1.ben_rel_with_testator) + '</b> named <b>' + titleList(obj1.ben_title) + '. ' + obj1.ben_fname + ' ' + obj1.ben_mname + ' ' + obj1.ben_lname + '</b></p></td></tr>');
                           });
                           i++;
                        });
                        $('#willPreviewHTML tbody').append('</td></tr>');
                     }
                     /* Pet Animals */
                     var will_pet_animal = JSON.parse(data.will_pet_animal);
                     if (will_pet_animal.length != 0) {
                        $('#willPreviewHTML tbody').append('<tr><td><p><b>PET ANIMALS</b></p></td></tr>');
                        var i = 1;
                        $('#willPreviewHTML tbody').append('<tr><td>');
                        $.each(will_pet_animal, function (index, obj) {
                           $('#willPreviewHTML tbody').append('<tr><td><p>' + i + ') &nbsp;I having ' + obj.pet_animal_type + ' named ' + obj.pet_animal_name + ' currently residing with me which I wish to give to my </p></td></tr>');
                           $.each(willBeneficiaries, function (index1, obj1) {
                              if (obj1.ben_id == obj.pet_animal_beneficiary) {
                                 $('#willPreviewHTML tbody').append('<tr><td><p><b>' + relationName(obj1.ben_rel_with_testator) + '</b> named <b>' + obj1.ben_fname + ' ' + obj1.ben_mname + ' ' + obj1.ben_lname + '</b> for taking its proper care after the event of my death.</p></td></tr>');
                              }
                           });
                           i++;
                        });
                        $('#willPreviewHTML tbody').append('</td></tr>');
                     }
                     /* Rest and residual properties*/
                     /*$('#willPreviewHTML tbody').append('<tr><td><b>F. DISTRIBUTION OF ESTATE (REST AND RESIDUAL PROPERTIES</b>');
                     var will_other_assets = JSON.parse(data.will_other_assets);
                     var i=1;
                     $.each(will_other_assets, function(index,obj){
                        if(obj.property_type=="Ag land") {
                           $('#willPreviewHTML tbody').append('<tr><td><p>'+i+') &nbsp;a. My agricultural land measuring '+obj.property_measurement+'&nbsp; located at '+obj.property_addr1+','+obj.property_addr2+','+obj.property_city+','+stateName(obj.property_state)+','+countryName(obj.property_country)+'-'+obj.property_zip+' having '+obj.property_ownership_status+' ownership to be given in favour of </p></td></tr>');
                        } else {
                           if(obj.property_type=="Non Ag. Land") {
                              $('#willPreviewHTML tbody').append('<tr><td><p>'+i+') &nbsp;a. My non-agricultural land measuring '+obj.property_measurement+'&nbsp; located at '+obj.property_addr1+','+obj.property_addr2+','+obj.property_city+','+stateName(obj.property_state)+','+countryName(obj.property_country)+'-'+obj.property_zip+' having '+obj.property_ownership_status+' ownership to be given in favour of </p></td></tr>');
                           } else {
                              if(obj.property_type=="C. building") {
                                 $('#willPreviewHTML tbody').append('<tr><td><p>'+i+') &nbsp;a. My commercial building of '+obj.property_measurement+'&nbsp; located at '+obj.property_addr1+','+obj.property_addr2+','+obj.property_city+','+stateName(obj.property_state)+','+countryName(obj.property_country)+'-'+obj.property_zip+' having '+obj.property_ownership_status+' ownership to be given in favour of </p></td></tr><tr><td><p>b. <b>share</b> of my commercial building '+obj.property_measurement+' located at '+obj.property_addr1+','+obj.property_addr2+','+obj.property_city+','+stateName(obj.property_state)+','+countryName(obj.property_country)+'-'+obj.property_zip+' having '+obj.property_ownership_status+' ownership to be given in favour of ');
                              } else {
                                 if(obj.property_type=="R. building") {
                                    $('#willPreviewHTML tbody').append('<tr><td><p>'+i+') &nbsp;a. My residential building of '+obj.property_measurement+'&nbsp; located at '+obj.property_addr1+','+obj.property_addr2+','+obj.property_city+','+stateName(obj.property_state)+','+countryName(obj.property_country)+'-'+obj.property_zip+' having '+obj.property_ownership_status+' ownership to be given in favour of </p></td></tr><tr><td><p>b. <b>share</b> of my residential building '+obj.property_measurement+' located at '+obj.property_addr1+','+obj.property_addr2+','+obj.property_city+','+stateName(obj.property_state)+','+countryName(obj.property_country)+'-'+obj.property_zip+' having '+obj.property_ownership_status+' ownership to be given in favour of ');
                                 } else {
                                    if(obj.property_type=="Factory") {
                                       $('#willPreviewHTML tbody').append('<tr><td><p>'+i+') &nbsp;a. I holding Factory including/or Plant and Machinery located at '+obj.property_addr1+','+obj.property_addr2+','+obj.property_city+','+stateName(obj.property_state)+','+countryName(obj.property_country)+'-'+obj.property_zip+' having '+obj.property_ownership_status+' ownership to be given in favour of </p></td></tr><tr><td><p>b. <b>share</b> of my Factory including/or Plant and Machinery located at '+obj.property_addr1+','+obj.property_addr2+','+obj.property_city+','+stateName(obj.property_state)+','+countryName(obj.property_country)+'-'+obj.property_zip+' having '+obj.property_ownership_status+' ownership to be given in favour of ');
                                    } else {
                                       $('#willPreviewHTML tbody').append('');
                                    }
                                 }
                              }   
                           }  
                        }
                        i++;
                     });
                     $('#willPreviewHTML tbody').append('</td></tr>');*/
                     /* Intellectual property rights */
                     var will_ipr = JSON.parse(data.will_ipr);
                     if (will_ipr.length != 0) {
                        var i = 1;
                        $('#willPreviewHTML tbody').append('<tr><td><p><b>G. INTELLECTUAL PROPERTY RIGHTS</b></p>');
                        $.each(will_ipr, function (index, obj) {
                           $('#willPreviewHTML tbody').append('<tr><td><p>' + i + ') &nbsp;The proceeds of Copyrights/Trademark/Patent/Royalty of ' + obj.ipr_type + ' which is held under my name, I wish to give in favour of </p></td></tr>');
                           $.each(JSON.parse(obj.ben), function (index1, obj1) {
                              $('#willPreviewHTML tbody').append('<tr><td><p>' + obj1.txt_beneficiary_share + ' to my <b>' + relationName(obj1.ben_rel_with_testator) + '</b> named <b>' + titleList(obj1.ben_title) + '. ' + obj1.ben_fname + ' ' + obj1.ben_mname + ' ' + obj1.ben_lname + '</b></p></td></tr>');
                           });
                           i++;
                        });
                        $('#willPreviewHTML tbody').append('</td></tr>');
                     }

                     /* Donation of body organs */
                     var will_body_organ = JSON.parse(data.will_body_organ);
                     if (will_body_organ.length != 0) {
                        $('#willPreviewHTML tbody').append('<tr><td><p><b>H. DONATION OF BODY ORGANS</b></p>');
                        var i = 1;
                        $.each(will_body_organ, function (index, obj) {
                           $('#willPreviewHTML tbody').append('<tr><td><p>' + i + ') &nbsp;I <name> out of my free volition and without any coercion or under any undue influence whatsoever wish to donate my body organ ' + obj.body_organ_name + ' to ' + obj.body_organ_hospital_name + ' located at ' + obj.body_organ_addr1 + ',' + obj.body_organ_addr2 + ',' + obj.body_organ_city + ',' + stateName(obj.body_organ_state) + ',' + countryName(obj.body_organ_country) + '-' + obj.body_organ_zip + '</p></td></tr><tr><td><p>I hereby declare that this is solely my independent decision</p></td></tr>');
                           i++;
                        });
                        $('#willPreviewHTML tbody').append('</td></tr>');
                     }
                     /* distribution of liabilities */
                     var will_liabilities = JSON.parse(data.will_liabilities);
                     if (will_liabilities.length != 0) {
                        $('#willPreviewHTML tbody').append('<tr><td><p><b>I. DISTRIBUTION OF LIABILITIES</b></p>');
                        var i = 1;
                        $.each(will_liabilities, function (index, obj) {
                           $('#willPreviewHTML tbody').append('<tr><td><p>' + i + ') &nbsp;Loan amount of Rs. ' + obj.liability_amount + ' (Rupees ) outstanding as on date against my Immovable/Movable property ' + obj.liability_type + ' measuring of ' + obj.liability_prop_mes + ' sq ft located at ' + obj.liability_addr1 + ',' + obj.liability_addr2 + ',' + obj.liability_city + ',' + stateName(obj.liability_state) + ',' + countryName(obj.liability_country) + '-' + obj.liability_zip + ' availed from ' + obj.liability_start_date + ' to ' + obj.liability_closing_date + ' maturity date at the rate of interest ' + obj.liability_interest_rate + ' to be paid by </p></td></tr>');
                           $.each(JSON.parse(obj.ben), function (index1, obj1) {
                              $('#willPreviewHTML tbody').append('<tr><td><p>' + obj1.txt_beneficiary_share + ' to my <b>' + relationName(obj1.ben_rel_with_testator) + '</b> named <b>' + titleList(obj1.ben_title) + '. ' + obj1.ben_fname + ' ' + obj1.ben_mname + ' ' + obj1.ben_lname + '</b></p></td></tr>');
                           });
                           i++;
                        });
                        $('#willPreviewHTML tbody').append('</td></tr>');
                     }
                     alphabetCount++;
                     $('#willPreviewHTML tbody').append('<tr><td><tr><td><p>However, if any part of any estate is spent during my life time, the same will be deemed to be reduction in the respective estate and only the residue of that estate will be accepted by the respective legatee.</p></td></tr>');
                     $('#willPreviewHTML tbody').append('<tr><td><b>' + alphabet[alphabetCount] + '. NO CONTEST CLAUSE</b><p>It is my wish that my beneficiaries shall respect this Will in letter and spirit. Wherever there is a disproportionate distribution of any property, it has been done thoughtfully and considering the circumstances prevailing during my lifetime. Hence, no part of the Will can be challenged in any proceeding in any court on such grounds. I further declare that I have full knowledge and understanding of all the contents in this WILL and that the contents are true and correct as per my knowledge, belief and information.</p></td></tr>');
                     alphabetCount++;
                     /* Custodians */
                     var will_custodian = JSON.parse(data.will_custodian);
                     if (will_custodian.length != 0) {
                        $.each(will_custodian, function (index, obj) {
                           $('#willPreviewHTML tbody').append('<tr><td><p><b>' + alphabet[alphabetCount] + '. CUSTODIAN</b></p><p>I ' + $('.dropdown-item.user_name span').text().trim() + ' hereby appoint ' + obj.cust_name + ' son/daughter/wife of Shri ' + obj.cust_father_name + 'currently residing at ' + obj.cust_addr1 + ',' + obj.cust_addr2 + ',' + obj.cust_city + ',' + stateName(obj.cust_state) + ',' + countryName(obj.cust_country) + '-' + obj.cust_zip + ' by religion ' + religionName(obj.cust_religion) + ', ' + obj.cust_nationality + ' by nationality, aged about ' + obj.cust_age + ' as my custodian, and will hold my Will until my death and thereafter shall handover the Will in proper condition to my executor after my death.</p></td></tr>');
                        });
                        alphabetCount++;
                     }
                     /* signature of testator */
                     $('#willPreviewHTML tbody').append('<tr><td><br><p>I/ We  am executing this will in the presence of the witness hereafter who have attested this will confirming the execution of the will on this .......... day of ..... month........... year, my/our with free will, consciousness, clear mind and understanding, consent after carefully evaluating, understanding the dispositions, bequeaths, grants made in this will</p></td></tr>');
                     $('#willPreviewHTML tbody').append('<tr><td><br><br><p><b>Signature of Testator</b></p><br><br></td></tr>');
                     /* Witness */
                     var will_witness = JSON.parse(data.will_witness);
                     if (will_witness.length != 0) {
                        $('#willPreviewHTML tbody').append('<tr><td><p><b>' + alphabet[alphabetCount] + '. WITNESS</b></p></td></tr>');
                        if (willPersonalInfo[0].pi_gender == 1) {
                           keyword1 = "his";
                        } else {
                           keyword1 = "her";
                        }
                        $.each(will_witness, function (index, obj) {
                           $('#willPreviewHTML tbody').append('<tr><td><p>We hereby attest that this Will has been signed by ' + $('.dropdown-item.user_name span').text().trim() + ' as ' + keyword1 + ' last Will at .... .... in the joint presence of himself and us. The testator is sound mind and has made this Will out of his/her free will without any coercion or under any undue influence.</p></td></tr>');
                           $('#willPreviewHTML tbody').append('<tr><td>' +
                              '<table><tr><td><p><b>Signature of Witness1</b></p><p><b>Name:</b> ' + obj.witness1_name + '</p><p><b>Address: </b>' + obj.witness1_addr_line1 + ',' + obj.witness1_addr_line2 + ',' + obj.witness1_city + ',' + stateName(obj.witness1_state) + ',' + countryName(obj.witness1_country) + '-' + obj.witness1_zipcode + ' </p><p><b>Phone: </b>' + obj.witness1_phone + '</p></td><td><p><b>Signature of Witness2</b></p><p><b>Name: </b>' + obj.witness2_name + '</p><p><b>Address: </b>' + obj.witness2_addr_line1 + ',' + obj.witness2_addr_line2 + ',' + obj.witness2_city + ',' + stateName(obj.witness2_state) + ',' + countryName(obj.witness2_country) + '-' + obj.witness2_zipcode + ' </p><p><b>Phone: </b>' + obj.witness2_phone + '</p></td></tr></table>' +
                              '</td></tr><tr><td class="float-right"><p align="center"><strong>DRAFTED BY: <br>WWW.OPTYMONEY.COM</strong></p></td></tr>');
                        });
                     }
                     temp1 = 1;
                  },
                  complete: function () {
                     $('.ajax-loader').css("visibility", "hidden");
                  }
               });
               return temp1;
            } else {
               console.log("not valid");
            }
         } else {
            console.log("not valid");
         }
      } else {
         console.log("not valid");
      }
   } else {
      console.log("not valid");
   }

}
function currentDate() {
   var dNow = new Date();
   var amOrPm = (dNow.getHours() < 12) ? "AM" : "PM";
   var hour = (dNow.getHours() <= 12) ? dNow.getHours() : dNow.getHours() - 12;
   var localdate = (dNow.getMonth() + 1) + '/' + dNow.getDate() + '/' + dNow.getFullYear();
   return localdate;
}
function getPlace() {
   $.ajax({
      url: "https://geolocation-db.com/jsonp",
      jsonpCallback: "callback",
      dataType: "jsonp",
      success: function (location) {
         $('#pi_place').val(location.city);
         // $('#country').html(location.country_name);
         // $('#state').html(location.state);
         // $('#city').html(location.city);
         // $('#latitude').html(location.latitude);
         // $('#longitude').html(location.longitude);
         // $('#ip').html(location.IPv4);
         //alert(location.city);
      }
   });
}
function updatebenList(modalId, button) {
   var objData = {};
   objData["formName"] = "frmBeneficiary";
   objData["act"] = "get";
   objData["id"] = ""
   objData["data"] = "";
   objData["table"] = "will_beneficiary";
   $.ajax({
      url: $("#frmBeneficiary")[0].action,
      type: "POST",
      data: objData,
      async: false,
      beforeSend: function () {
         $('.ajax-loader').css("visibility", "visible");
      },
      complete: function () {
         $('.ajax-loader').css("visibility", "hidden");
      },
      success: function (response) {
         if (modalId == "#petAnimalModal") {
            $(modalId).modal('show');
            $('#pet_animal_beneficiary')
               .find('option')
               .remove()
               .end()
               .append('<option value="">Select Beneficiary</option>');
            $.each(JSON.parse(response), function (key, val) {
               $('#pet_animal_beneficiary').append('<option value="' + val.ben_id + '">' + val.ben_fname + ' ' + val.ben_lname + '</option>');
            });
         } else {
            if (modalId == "#vehicleModal") {
               $(modalId).modal('show');
               $('#vehicle_beneficiary')
                  .find('option')
                  .remove()
                  .end()
                  .append('<option value="">Select Beneficiary</option>');
               $.each(JSON.parse(response), function (key, val) {
                  $('#vehicle_beneficiary').append('<option value="' + val.ben_id + '">' + val.ben_fname + ' ' + val.ben_lname + '</option>');
               });
            } else {
               $('#' + modalId).modal('show');
               $('#fk_ben_id')
                  .find('option')
                  .remove()
                  .end()
                  .append('<option value="">Select Beneficiary</option>');
               $.each(JSON.parse(response), function (key, val) {
                  $('#fk_ben_id').append('<option value="' + val.ben_id + '">' + val.ben_fname + ' ' + val.ben_lname + '</option>');
               });
               $('#btn_assign').attr("data-row_id", button[0].dataset.id);
               $('#btn_assign').attr("data-form", button[0].dataset.form);
               $('#btn_assign').attr("data-for_table", button[0].dataset.table);
               $('#btn_assign').attr("data-dbtable", button[0].dataset.dbtable);
               $('#btn_assign').attr("data-key_parent", button[0].dataset.key);
               $('#btn_assign').attr("data-role", "insert");
            }
         }
      }
   });
}
function personalInfo() {
   var objData = {};
   objData["formName"] = "frmProfiles";
   objData["act"] = "get";
   objData["id"] = "";
   objData["data"] = "";
   objData["table"] = "bfsi_users_details";
   $.ajax({
      url: $("#frmProfiles")[0].action,
      type: "POST",
      data: objData,
      beforeSend: function () {
         $('.ajax-loader').css("visibility", "visible");
      },
      complete: function () {
         $('.ajax-loader').css("visibility", "hidden");
      },
      success: function (response) {
         var data = JSON.parse(response);
         if (data.length != 0) {
            $(".save").attr("data-id", data[0].pk_user_detail_id);
            $.each(data[0], function (key, item) {
               $('#' + key).val(item);
            });
         }
         getPlace();
         $("#pi_date").val(currentDate());
      }
   });
}
function executor() {
   var objData = {};
   objData["formName"] = "frmexecutordetails";
   objData["act"] = "get";
   objData["id"] = ""
   objData["data"] = "";
   objData["table"] = "will_executor";
   $.ajax({
      url: $("#frmexecutordetails")[0].action,
      type: "POST",
      data: objData,
      beforeSend: function () {
         $('.ajax-loader').css("visibility", "visible");
      },
      complete: function () {
         $('.ajax-loader').css("visibility", "hidden");
      },
      success: function (response) {
         var data = JSON.parse(response);
         if (data.length != 0) {
            $(".save").attr("data-id", data[0].exe_id);
            $.each(data[0], function (key, item) {
               $('#' + key).val(item);
            });
         }
      }
   });
}
function custodian() {
   var objData = {};
   objData["formName"] = "frmCustodian";
   objData["act"] = "get";
   objData["id"] = ""
   objData["data"] = "";
   objData["table"] = "will_custodian";
   $.ajax({
      url: $("#frmCustodian")[0].action,
      type: "POST",
      data: objData,
      beforeSend: function () {
         $('.ajax-loader').css("visibility", "visible");
      },
      complete: function () {
         $('.ajax-loader').css("visibility", "hidden");
      },
      success: function (response) {
         var data = JSON.parse(response);
         if (data.length != 0) {
            $(".save").attr("data-id", data[0].pk_custodian_id);
            $.each(data[0], function (key, item) {
               $('#' + key).val(item);
            });
         }
      }
   });
}
function witness() {
   var objData = {};
   objData["formName"] = "frmWitness";
   objData["act"] = "get";
   objData["id"] = ""
   objData["data"] = "";
   objData["table"] = "will_witness";
   $.ajax({
      url: $("#frmWitness")[0].action,
      type: "POST",
      data: objData,
      beforeSend: function () {
         $('.ajax-loader').css("visibility", "visible");
      },
      complete: function () {
         $('.ajax-loader').css("visibility", "hidden");
      },
      success: function (response) {
         var data = JSON.parse(response);
         if (data.length != 0) {
            $(".save").attr("data-id", data[0].pk_witness_id);
            $.each(data[0], function (key, item) {
               $('#' + key).val(item);
            });
         }
      }
   });
}
function benificiary() {
   var objData = {};
   objData["formName"] = "frmBeneficiary";
   objData["act"] = "get";
   objData["id"] = ""
   objData["data"] = "";
   objData["table"] = "will_beneficiary";
   $.ajax({
      url: $("#frmBeneficiary")[0].action,
      type: "POST",
      data: objData,
      beforeSend: function () { $('.ajax-loader').css("visibility", "visible"); },
      complete: function () { $('.ajax-loader').css("visibility", "hidden"); },
      success: function (response) {
         $("#beneficiary").dataTable().fnDestroy();
         $('#beneficiary').DataTable({
            "paging": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "data": JSON.parse(response),
            "columns": [
               { data: null, render: function (data, type, row) { return row.ben_fname + ' ' + row.ben_lname; } },
               { data: null, render: function (data, type, row) { return relationName(row.ben_rel_with_testator) } },
               {
                  data: null, render: function (data, type, row) {
                     return row.ben_perm_addr1 + ', ' + row.ben_perm_addr2 + ', ' + row.ben_perm_city + ', ' + stateName(row.ben_perm_state) + ', ' + countryName(row.ben_perm_country) + ' - ' + row.ben_perm_zip
                  }
               },
               {
                  data: null, render: function (data, type, row) {
                     return '<button type="button" id="willEdit" class="btn btn-warning-rect willEdit" data-id="' + row.ben_id + '" data-key="ben_id" data-table="will_beneficiary" data-form="frmBeneficiary" data-modal="beneficiaryModal"><i class="fa fa-edit"></i> Edit</a>' +
                        '<button type="button" id="willDelete" class="btn btn-danger-rect active willDelete" data-id="' + row.ben_id + '" data-key="ben_id" data-table="will_beneficiary" data-form="frmBeneficiary" data-uitable="beneficiary"><i class="fa fa-trash-o"></i> Delete</button>';
                  }
               }],
            "fnInitComplete": function () { $("#beneficiary").css("width", "100%"); }
         });
      }
   });
}
function bankAccounts() {
   var objData = {};
   objData["formName"] = "addBankAccount";
   objData["act"] = "get";
   objData["id"] = ""
   objData["data"] = "";
   objData["table"] = "will_bank_accounts";
   $.ajax({
      url: $("#addBankAccount")[0].action,
      type: "POST",
      data: objData,
      beforeSend: function () { $('.ajax-loader').css("visibility", "visible"); },
      complete: function () { $('.ajax-loader').css("visibility", "hidden"); },
      success: function (response) {
         $("#bankAccountsTable").DataTable().destroy();
         oTable = $('#bankAccountsTable').DataTable({
            "ordering": true,
            "data": JSON.parse(response),
            columnDefs: [{ width: '272px', targets: 5 }],
            "columns": [
               { "data": "ba_bank_name" }, { "data": "ba_ac_number" },
               { data: null, render: function (data, type, row) { return accountType(row.ba_account_type) } },
               { "data": "ba_usedperc" },
               { "data": "ba_balperc" },
               {
                  data: null, render: function (data, type, row) {
                     return '<button type="button" style="width: 272px;" class="btn btn-info-rect active assignBen" data-id="' + row.pk_bk_id + '" data-key="pk_bk_id" data-form="addBankAccount" data-modal="beniBankModal" data-dbtable="will_bank_accounts" data-table="will_bank_accounts"><i class="fa fa-user-plus"></i> Assign Beneficiary</button>' +
                        '<button type="button" id="' + row.pk_bk_id + '" class="btn btn-primary-rect willView" data-id="' + row.pk_bk_id + '" data-key="pk_bk_id" data-table="will_bank_accounts" data-form="addBankAccount" data-modal="bankAccountModal"><i class="fa fa-eye"></i> View</button>' +
                        '<button type="button" id="willEdit" class="btn btn-warning-rect willEdit" data-id="' + row.pk_bk_id + '" data-key="pk_bk_id" data-table="will_bank_accounts" data-form="addBankAccount" data-modal="bankAccountModal"><i class="fa fa-edit"></i> Edit</button>' +
                        '<button type="button" id="willDelete" class="btn btn-danger-rect active willDelete" data-id="' + row.pk_bk_id + '" data-key="pk_bk_id" data-table="will_bank_accounts" data-form="addBankAccount"><i class="fa fa-trash-o"></i> Delete</button>';
                  }
               }],
            "fnInitComplete": function () { $("#bankAccountsTable").css("width", "100%"); }
         });
      }
   });
}
function lockers() {
   var objData = {};
   objData["formName"] = "addLockerAccount";
   objData["act"] = "get";
   objData["id"] = ""
   objData["data"] = "";
   objData["table"] = "will_locker_info";
   $.ajax({
      url: $("#addLockerAccount")[0].action,
      type: "POST",
      data: objData,
      beforeSend: function () {
         $('.ajax-loader').css("visibility", "visible");
      },
      complete: function () {
         $('.ajax-loader').css("visibility", "hidden");
      },
      success: function (response) {
         $("#bankLockerTable").dataTable().fnDestroy();
         oTable = $('#bankLockerTable').DataTable({
            "paging": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "data": JSON.parse(response),
            columnDefs: [
               { width: '272px', targets: 4 }
            ],
            "columns": [{
               "data": "loc_bank_name"
            }, {
               "data": "loc_number"
            }, {
               "data": "ba_usedperc"
            }, {
               "data": "ba_balperc"
            }, {
               data: null,
               render: function (data, type, row) {
                  return '<button type="button" style="width:272px;" class="btn btn-info-rect active assignBen" data-id="' + row.pk_locker_id + '" data-key="pk_locker_id" data-form="addLockerAccount" data-modal="beniBankModal" data-dbtable="will_locker_info" data-table="will_locker_info"><i class="fa fa-user-plus"></i> Assign Beneficiary</button>' +
                     '<button type="button" id="' + row.pk_locker_id + '" class="btn btn-primary-rect willView" data-id="' + row.pk_locker_id + '" data-key="pk_locker_id" data-table="will_locker_info" data-form="addLockerAccount" data-modal="bankLockerModal"><i class="fa fa-eye"></i> View</button>' +
                     '<button type="button" id="willEdit" class="btn btn-warning-rect willEdit" data-id="' + row.pk_locker_id + '" data-key="pk_locker_id" data-table="will_locker_info" data-form="addLockerAccount" data-modal="bankLockerModal"><i class="fa fa-edit"></i> Edit</a>' +
                     '<button type="button" id="willDelete" class="btn btn-danger-rect active willDelete" data-id="' + row.pk_locker_id + '" data-key="pk_locker_id" data-table="will_locker_info" data-form="addLockerAccount"><i class="fa fa-trash-o"></i> Delete </button>';
               }
            }],
            "fnInitComplete": function () {
               $("#bankLockerTable").css("width", "100%");
            }
         });

      }
   });
}
function fixedDeposits() {
   var objData = {};
   objData["formName"] = "addFixedDeposit";
   objData["act"] = "get";
   objData["id"] = ""
   objData["data"] = "";
   objData["table"] = "will_fixed_deposit";
   $.ajax({
      url: $("#addFixedDeposit")[0].action,
      type: "POST",
      data: objData,
      beforeSend: function () { $('.ajax-loader').css("visibility", "visible"); },
      complete: function () { $('.ajax-loader').css("visibility", "hidden"); },
      success: function (response) {
         $("#bankFDTable").dataTable().fnDestroy();
         oTable = $('#bankFDTable').DataTable({
            "paging": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "data": JSON.parse(response),
            columnDefs: [{ width: '272px', targets: 4 }],
            "columns": [
               { "data": "fd_bank_name" }, { "data": "fd_ac_number" }, { "data": "ba_usedperc" }, { "data": "ba_balperc" },
               {
                  data: null, render: function (data, type, row) {
                     return '<button type="button" style="width:272px;" class="btn btn-info-rect active assignBen" data-id="' + row.pk_fd_id + '" data-key="pk_fd_id" data-form="addFixedDeposit" data-modal="beniBankModal" data-dbtable="will_fixed_deposit" data-table="will_fixed_deposit"><i class="fa fa-user-plus"></i> Assign Beneficiary</button>' +
                        '<button type="button" id="' + row.pk_fd_id + '" class="btn btn-primary-rect willView" data-id="' + row.pk_fd_id + '" data-key="pk_fd_id" data-table="will_fixed_deposit" data-form="addFixedDeposit" data-modal="bankFDModal"><i class="fa fa-eye"></i> View</button>' +
                        '<button type="button" id="willEdit" class="btn btn-warning-rect willEdit" data-id="' + row.pk_fd_id + '" data-key="pk_fd_id" data-table="will_fixed_deposit" data-form="addFixedDeposit" data-modal="bankFDModal"><i class="fa fa-edit"></i> Edit</button>' +
                        '<button type="button" id="willDelete" class="btn btn-danger-rect active willDelete" data-id="' + row.pk_fd_id + '" data-key="pk_fd_id" data-table="will_fixed_deposit" data-form="addFixedDeposit"><i class="fa fa-trash-o"></i> Delete </button>';
                  }
               }],
            "fnInitComplete": function () { $("#bankFDTable").css("width", "100%"); }
         });
      }
   });
}
function mutualFunds() {
   var objData = {};
   objData["formName"] = "addMF";
   objData["act"] = "get";
   objData["id"] = ""
   objData["data"] = "";
   objData["table"] = "will_mutual_fund";
   $.ajax({
      url: $("#addMF")[0].action,
      type: "POST",
      data: objData,
      beforeSend: function () { $('.ajax-loader').css("visibility", "visible"); },
      complete: function () { $('.ajax-loader').css("visibility", "hidden"); },
      success: function (response) {
         $("#shareMFTable").dataTable().fnDestroy();
         oTable = $('#shareMFTable').DataTable({
            "paging": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "data": JSON.parse(response),
            columnDefs: [{ width: '272px', targets: 5 }],
            "columns": [
               { "data": "mf_name" }, { "data": "mf_scheme" }, { "data": "mf_folio_number" }, { "data": "ba_usedperc" }, { "data": "ba_balperc" },
               {
                  data: null, render: function (data, type, row) {
                     return '<button type="button" style="width:272px;" class="btn btn-info-rect active assignBen" data-id="' + row.pk_mf_id + '" data-key="pk_mf_id" data-form="addMF" data-modal="beniBankModal" data-dbtable="will_mutual_fund" data-table="will_mutual_fund"><i class="fa fa-user-plus"></i> Assign Beneficiary</button>' +
                        '<button type="button" id="' + row.pk_mf_id + '" class="btn btn-primary-rect willView" data-id="' + row.pk_mf_id + '" data-key="pk_mf_id" data-table="will_mutual_fund" data-form="addMF" data-modal="shareMFModal"><i class="fa fa-eye"></i> View</button>' +
                        '<button type="button" id="willEdit" class="btn btn-warning-rect willEdit" data-id="' + row.pk_mf_id + '" data-key="pk_mf_id" data-table="will_mutual_fund" data-form="addMF" data-modal="shareMFModal"><i class="fa fa-edit"></i> Edit</button>' +
                        '<button type="button" id="willDelete" class="btn btn-danger-rect active willDelete" data-id="' + row.pk_mf_id + '" data-key="pk_mf_id" data-table="will_mutual_fund" data-form="addMF"><i class="fa fa-trash-o"></i> Delete </button>';
                  }
               }],
            "fnInitComplete": function () { $("#shareMFTable").css("width", "100%"); }
         });
      }
   });
}
function shares() {
   var objData = {};
   objData["formName"] = "addShare";
   objData["act"] = "get";
   objData["id"] = ""
   objData["data"] = "";
   objData["table"] = "will_share";
   $.ajax({
      url: $("#addShare")[0].action,
      type: "POST",
      data: objData,
      beforeSend: function () { $('.ajax-loader').css("visibility", "visible"); },
      complete: function () { $('.ajax-loader').css("visibility", "hidden"); },
      success: function (response) {
         $("#sharesTable").dataTable().fnDestroy();
         oTable = $('#sharesTable').DataTable({
            "paging": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "data": JSON.parse(response),
            columnDefs: [{ width: '272px', targets: 5 }],
            "columns": [
               { "data": "share_type" }, { "data": "share_company_name" }, { "data": "share_amount" }, { "data": "ba_usedperc" }, { "data": "ba_balperc" },
               {
                  data: null, render: function (data, type, row) {
                     return '<button type="button" style="width:272px;" class="btn btn-info-rect active assignBen" data-id="' + row.pk_share_id + '" data-key="pk_share_id" data-form="addShare" data-modal="beniBankModal" data-dbtable="will_share" data-table="will_share"><i class="fa fa-user-plus"></i> Assign Beneficiary</button>' +
                        '<button type="button" id="' + row.pk_share_id + '" class="btn btn-primary-rect willView" data-id="' + row.pk_share_id + '" data-key="pk_share_id" data-table="will_share" data-form="addShare" data-modal="sharesModal"><i class="fa fa-eye"></i> View</button>' +
                        '<button type="button" id="willEdit" class="btn btn-warning-rect willEdit" data-id="' + row.pk_share_id + '" data-key="pk_share_id" data-table="will_share" data-form="addShare" data-modal="sharesModal"><i class="fa fa-edit"></i> Edit</button>' +
                        '<button type="button" id="willDelete" class="btn btn-danger-rect active willDelete" data-id="' + row.pk_share_id + '" data-key="pk_share_id" data-table="will_share" data-form="addShare"><i class="fa fa-trash-o"></i> Delete </button>';
                  }
               }],
            "fnInitComplete": function () { $("#sharesTable").css("width", "100%"); }
         });
      }
   });
}
function bonds() {
   var objData = {};
   objData["act"] = "get";
   objData["id"] = ""
   objData["data"] = "";
   objData["table"] = "will_bond_details";
   $.ajax({
      url: $("#addBond")[0].action,
      type: "POST",
      data: objData,
      beforeSend: function () { $('.ajax-loader').css("visibility", "visible"); },
      complete: function () { $('.ajax-loader').css("visibility", "hidden"); },
      success: function (response) {
         $("#bondsTable").dataTable().fnDestroy();
         oTable = $('#bondsTable').DataTable({
            "paging": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "data": JSON.parse(response),
            columnDefs: [{ width: '272px', targets: 5 }],
            "columns": [
               { "data": "bond_company_name" }, { "data": "bond_scheme_details" }, { "data": "bond_amount" }, { "data": "ba_usedperc" }, { "data": "ba_balperc" },
               {
                  data: null, render: function (data, type, row) {
                     return '<button type="button" style="width:272px;" class="btn btn-info-rect active assignBen" data-id="' + row.pk_bond_id + '" data-key="pk_bond_id" data-form="addBond" data-modal="beniBankModal" data-dbtable="will_bond_details" data-table="will_bond_details"><i class="fa fa-user-plus"></i> Assign Beneficiary</button>' +
                        '<button type="button" id="' + row.pk_bond_id + '" class="btn btn-primary-rect willView" data-id="' + row.pk_bond_id + '" data-key="pk_bond_id" data-table="will_bond_details" data-form="addBond" data-modal="bondsModal"><i class="fa fa-eye"></i> View</button>' +
                        '<button type="button" id="willEdit" class="btn btn-warning-rect willEdit" data-id="' + row.pk_bond_id + '" data-key="pk_bond_id" data-table="will_bond_details" data-form="addBond" data-modal="bondsModal"><i class="fa fa-edit"></i> Edit</button>' +
                        '<button type="button" id="willDelete" class="btn btn-danger-rect active willDelete" data-id="' + row.pk_bond_id + '" data-key="pk_bond_id" data-table="will_bond_details" data-form="addBond"><i class="fa fa-trash-o"></i> Delete </button>';
                  }
               }],
            "fnInitComplete": function () { $("#bondsTable").css("width", "100%"); }
         });
      }
   });
}
function immovableProperties() {
   var objData = {};
   objData["formName"] = "addProperty";
   objData["act"] = "get";
   objData["id"] = ""
   objData["data"] = "";
   objData["table"] = "will_immovable_properties";
   $.ajax({
      url: $("#addProperty")[0].action,
      type: "POST",
      data: objData,
      beforeSend: function () { $('.ajax-loader').css("visibility", "visible"); },
      complete: function () { $('.ajax-loader').css("visibility", "hidden"); },
      success: function (response) {
         $("#propertytable").dataTable().fnDestroy();
         oTable = $('#propertytable').DataTable({
            "paging": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "data": JSON.parse(response),
            "columnDefs": [{ width: '272px', targets: 1 }],
            "columns": [
               { "data": "property_type" },
               {
                  data: null, render: function (data, type, row) {
                     return row.property_addr1 + ', ' + row.property_addr2 + ', ' + row.property_city + ', ' + row.property_state + ', ' + row.property_country + ', ' + row.property_zip
                  }
               },
               { "data": "property_measurement" },
               { "data": "ba_usedperc" },
               { "data": "ba_balperc" },
               {
                  data: null, render: function (data, type, row) {
                     return '<button type="button" style="width:272px;" class="btn btn-info-rect active assignBen" data-id="' + row.pk_prop_id + '" data-form="addProperty" data-key="pk_prop_id" data-modal="beniBankModal" data-dbtable="will_immovable_properties" data-table="will_immovable_properties"><i class="fa fa-user-plus"></i> Assign Beneficiary</button>' +
                        '<button type="button" id="' + row.pk_prop_id + '" class="btn btn-primary-rect willView" data-id="' + row.pk_prop_id + '" data-key="pk_prop_id" data-table="will_immovable_properties" data-form="addProperty" data-datatable="propertytable" data-modal="propertyModal"><i class="fa fa-eye"></i> View</button>' +
                        '<button type="button" id="willEdit" class="btn btn-warning-rect willEdit" data-id="' + row.pk_prop_id + '" data-key="pk_prop_id" data-table="will_immovable_properties" data-form="addProperty" data-modal="propertyModal"><i class="fa fa-edit"></i> Edit</a>' +
                        '<button type="button" id="willDelete" class="btn btn-danger-rect active willDelete" data-id="' + row.pk_prop_id + '" data-key="pk_prop_id" data-table="will_immovable_properties" data-form="addProperty"><i class="fa fa-trash-o"></i> Delete </button>';
                  }
               }],
            "fnInitComplete": function () { $("#propertytable").css("width", "100%"); }
         });
      }
   });
}
function business() {
   var objData = {};
   objData["formName"] = "addBusiness";
   objData["act"] = "get";
   objData["id"] = ""
   objData["data"] = "";
   objData["table"] = "will_business";
   $.ajax({
      url: $("#addBusiness")[0].action,
      type: "POST",
      data: objData,
      beforeSend: function () {
         $('.ajax-loader').css("visibility", "visible");
      },
      complete: function () {
         $('.ajax-loader').css("visibility", "hidden");
      },
      success: function (response) {
         $("#businessTable").dataTable().fnDestroy();
         oTable = $('#businessTable').DataTable({
            "paging": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "data": JSON.parse(response),
            "columnDefs": [{ width: '272px', targets: 5 }],
            "columns": [
               { "data": "business_type" },
               { "data": "business_company_name" },
               {
                  data: null, render: function (data, type, row) {
                     return row.business_addr1 + ', ' + row.business_addr2 + ', ' + row.business_city + ', ' + row.business_state + ', ' + row.business_country + ', ' + row.business_zip
                  }
               },
               { "data": "ba_usedperc" },
               { "data": "ba_balperc" },
               {
                  data: null, render: function (data, type, row) {
                     return '<button type="button" style="width:272px;" class="btn btn-info-rect active assignBen" data-id="' + row.pk_business_id + '" data-key="pk_business_id" data-form="addBusiness" data-modal="beniBankModal" data-dbtable="will_business" data-table="will_business"><i class="fa fa-user-plus"></i> Assign Beneficiary</button>' +
                        '<button type="button" id="' + row.pk_business_id + '" class="btn btn-primary-rect willView" data-id="' + row.pk_business_id + '" data-key="pk_business_id" data-table="will_business" data-form="addBusiness" data-modal="businessModal"><i class="fa fa-eye"></i> View</button>' +
                        '<button type="button" id="willEdit" class="btn btn-warning-rect willEdit" data-id="' + row.pk_business_id + '" data-key="pk_business_id" data-table="will_business" data-form="addBusiness" data-modal="businessModal"><i class="fa fa-edit"></i> Edit</a>' +
                        '<button type="button" id="willDelete" class="btn btn-danger-rect active willDelete" data-id="' + row.pk_business_id + '" data-key="pk_business_id" data-table="will_business" data-form="addBusiness"><i class="fa fa-trash-o"></i> Delete </button>';
                  }
               }],
            "fnInitComplete": function () { $("#businessTable").css("width", "100%"); }
         });
      }
   });
}
function providentFund() {
   var objData = {};
   objData["formName"] = "addPF";
   objData["act"] = "get";
   objData["id"] = ""
   objData["data"] = "";
   objData["table"] = "will_ppf_info";
   $.ajax({
      url: $("#addPF")[0].action,
      type: "POST",
      data: objData,
      beforeSend: function () {
         $('.ajax-loader').css("visibility", "visible");
      },
      complete: function () {
         $('.ajax-loader').css("visibility", "hidden");
      },
      success: function (response) {
         $("#pfTable").dataTable().fnDestroy();
         oTable = $('#pfTable').DataTable({
            "paging": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "data": JSON.parse(response),
            "columnDefs": [{ width: '272px', targets: 5 }],
            "columns": [
               { "data": "pf_ac_number" },
               { "data": "pf_company_name" },
               {
                  data: null, render: function (data, type, row) {
                     return row.pf_addr1 + ', ' + row.pf_addr2 + ', ' + row.pf_city + ', ' + row.pf_state + ', ' + row.pf_country + ', ' + row.pf_zip
                  }
               },
               { "data": "ba_usedperc" },
               { "data": "ba_balperc" },
               {
                  data: null, render: function (data, type, row) {
                     return '<button type="button" style="width:272px;" class="btn btn-info-rect active assignBen" data-id="' + row.pk_ppf_id + '" data-key="pk_ppf_id" data-form="addPF" data-modal="beniBankModal" data-dbtable="will_ppf_info" data-table="will_ppf_info"><i class="fa fa-user-plus"></i> Assign Beneficiary</button>' +
                        '<button type="button" id="' + row.pk_ppf_id + '" class="btn btn-primary-rect willView" data-id="' + row.pk_ppf_id + '" data-key="pk_ppf_id" data-table="will_ppf_info" data-form="addPF" data-modal="pfModal"><i class="fa fa-eye"></i> View</button>' +
                        '<button type="button" id="willEdit" class="btn btn-warning-rect willEdit" data-id="' + row.pk_ppf_id + '" data-key="pk_ppf_id" data-table="will_ppf_info" data-form="addPF" data-modal="pfModal"><i class="fa fa-edit"></i> Edit</a>' +
                        '<button type="button" id="willDelete" class="btn btn-danger-rect active willDelete" data-id="' + row.pk_ppf_id + '" data-key="pk_ppf_id" data-table="will_ppf_info" data-form="addPF"><i class="fa fa-trash-o"></i> Delete </button>';
                  }
               }],
            "fnInitComplete": function () { $("#pfTable").css("width", "100%"); }
         });
      }
   });
}
function pensionFunds() {
   var objData = {};
   objData["formName"] = "addPension";
   objData["act"] = "get";
   objData["id"] = ""
   objData["data"] = "";
   objData["table"] = "will_pension_funds";
   $.ajax({
      url: $("#addPension")[0].action,
      type: "POST",
      data: objData,
      beforeSend: function () {
         $('.ajax-loader').css("visibility", "visible");
      },
      complete: function () {
         $('.ajax-loader').css("visibility", "hidden");
      },
      success: function (response) {
         $("#pensionTable").dataTable().fnDestroy();
         oTable = $('#pensionTable').DataTable({
            "paging": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "data": JSON.parse(response),
            "columnDefs": [{ width: '272px', targets: 5 }],
            "columns": [
               { "data": "pension_ac_number" },
               { "data": "pension_company_name" },
               {
                  data: null, render: function (data, type, row) {
                     return row.pension_addr1 + ', ' + row.pension_addr2 + ', ' + row.pension_city + ', ' + row.pension_state + ', ' + row.pension_country + ', ' + row.pension_zip
                  }
               },
               { "data": "ba_usedperc" },
               { "data": "ba_balperc" },
               {
                  data: null, render: function (data, type, row) {
                     return '<button type="button" style="width:272px;" class="btn btn-info-rect active assignBen" data-id="' + row.pen_id + '" data-key="pen_id" data-form="addPension" data-modal="beniBankModal" data-dbtable="will_pension_funds" data-table="will_pension_funds"><i class="fa fa-user-plus"></i> Assign Beneficiary</button>' +
                        '<button type="button" id="' + row.pen_id + '" class="btn btn-primary-rect willView" data-id="' + row.pen_id + '" data-key="pen_id" data-table="will_pension_funds" data-form="addPension" data-modal="pensionModal"><i class="fa fa-eye"></i> View</button>' +
                        '<button type="button" id="willEdit" class="btn btn-warning-rect willEdit" data-id="' + row.pen_id + '" data-key="pen_id" data-table="will_pension_funds" data-form="addPension" data-modal="pensionModal"><i class="fa fa-edit"></i> Edit</a>' +
                        '<button type="button" id="willDelete" class="btn btn-danger-rect active willDelete" data-id="' + row.pen_id + '" data-key="pen_id" data-table="will_pension_funds" data-form="addPension"><i class="fa fa-trash-o"></i> Delete </button>';
                  }
               }],
            "fnInitComplete": function () { $("#pensionTable").css("width", "100%"); }
         });
      }
   });
}
function gratuity() {
   var objData = {};
   objData["formName"] = "addGratuity";
   objData["act"] = "get";
   objData["id"] = ""
   objData["data"] = "";
   objData["table"] = "will_gratuity";
   $.ajax({
      url: $("#addGratuity")[0].action,
      type: "POST",
      data: objData,
      beforeSend: function () {
         $('.ajax-loader').css("visibility", "visible");
      },
      complete: function () {
         $('.ajax-loader').css("visibility", "hidden");
      },
      success: function (response) {
         $("#gratuityTable").dataTable().fnDestroy();
         oTable = $('#gratuityTable').DataTable({
            "paging": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "data": JSON.parse(response),
            "columnDefs": [{ width: '272px', targets: 5 }],
            "columns": [
               { "data": "gratuity_ac_number" },
               { "data": "gratuity_company_name" },
               {
                  data: null, render: function (data, type, row) {
                     return row.gratuity_addr1 + ', ' + row.gratuity_addr2 + ', ' + row.gratuity_city + ', ' + row.gratuity_state + ', ' + row.gratuity_country + ', ' + row.gratuity_zip
                  }
               },
               { "data": "ba_usedperc" },
               { "data": "ba_balperc" },
               {
                  data: null, render: function (data, type, row) {
                     return '<button type="button" style="width:272px;" class="btn btn-info-rect active assignBen" data-id="' + row.gra_id + '" data-key="gra_id" data-form="addGratuity" data-modal="beniBankModal" data-dbtable="will_gratuity" data-table="will_gratuity"><i class="fa fa-user-plus"></i> Assign Beneficiary</button>' +
                        '<button type="button" id="' + row.gra_id + '" class="btn btn-primary-rect willView" data-id="' + row.gra_id + '" data-key="gra_id" data-table="will_gratuity" data-form="addGratuity" data-modal="gratuityModal"><i class="fa fa-eye"></i> View</button>' +
                        '<button type="button" id="willEdit" class="btn btn-warning-rect willEdit" data-id="' + row.gra_id + '" data-key="gra_id" data-table="will_gratuity" data-form="addGratuity" data-modal="gratuityModal"><i class="fa fa-edit"></i> Edit</a>' +
                        '<button type="button" id="willDelete" class="btn btn-danger-rect active willDelete" data-id="' + row.gra_id + '" data-key="gra_id" data-table="will_gratuity" data-form="addGratuity"><i class="fa fa-trash-o"></i> Delete </button>';
                  }
               }],
            "fnInitComplete": function () { $("#gratuityTable").css("width", "100%"); }
         });
      }
   });
}
function generalInsurance() {
   var objData = {};
   objData["formName"] = "addGeneralInsurance";
   objData["act"] = "get";
   objData["id"] = ""
   objData["data"] = "";
   objData["table"] = "will_general_insurance";
   $.ajax({
      url: $("#addGeneralInsurance")[0].action,
      type: "POST",
      data: objData,
      beforeSend: function () {
         $('.ajax-loader').css("visibility", "visible");
      },
      complete: function () {
         $('.ajax-loader').css("visibility", "hidden");
      },
      success: function (response) {
         $("#generalInsuranceTable").dataTable().fnDestroy();
         oTable = $('#generalInsuranceTable').DataTable({
            "paging": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "data": JSON.parse(response),
            "columnDefs": [{ width: '272px', targets: 7 }],
            "columns": [
               { "data": "gi_policy_number" },
               { "data": "gi_com_name" },
               { "data": "gi_policy_start_date" },
               { "data": "gi_maturity_date" },
               { "data": "gi_amount" },
               { "data": "ba_usedperc" },
               { "data": "ba_balperc" },
               {
                  data: null, render: function (data, type, row) {
                     return '<button type="button" style="width: 272px;" class="btn btn-info-rect active assignBen" data-id="' + row.pk_gi_id + '" data-key="pk_gi_id" data-form="addGeneralInsurance" data-modal="beniBankModal" data-dbtable="will_general_insurance" data-table="will_general_insurance"><i class="fa fa-user-plus"></i> Assign Beneficiary</button>' +
                        '<button type="button" id="' + row.pk_gi_id + '" class="btn btn-primary-rect willView" data-id="' + row.pk_gi_id + '" data-key="pk_gi_id" data-table="will_general_insurance" data-form="addGeneralInsurance" data-modal="generalInsuranceModal"><i class="fa fa-eye"></i> View</button>' +
                        '<button type="button" id="willEdit" class="btn btn-warning-rect willEdit" data-id="' + row.pk_gi_id + '" data-key="pk_gi_id" data-table="will_general_insurance" data-form="addGeneralInsurance" data-modal="generalInsuranceModal"><i class="fa fa-edit"></i> Edit</a>' +
                        '<button type="button" id="willDelete" class="btn btn-danger-rect active willDelete" data-id="' + row.pk_gi_id + '" data-key="pk_gi_id" data-table="will_general_insurance" data-form="addGeneralInsurance"><i class="fa fa-trash-o"></i> Delete </button>';
                  }
               }],
            "fnInitComplete": function () { $("#generalInsuranceTable").css("width", "100%"); }
         });
      }
   });
}
function lifeInsurance() {
   var objData = {};
   objData["formName"] = "addLifeInsurance";
   objData["act"] = "get";
   objData["id"] = ""
   objData["data"] = "";
   objData["table"] = "will_lic";
   $.ajax({
      url: $("#addLifeInsurance")[0].action,
      type: "POST",
      data: objData,
      beforeSend: function () {
         $('.ajax-loader').css("visibility", "visible");
      },
      complete: function () {
         $('.ajax-loader').css("visibility", "hidden");
      },
      success: function (response) {
         $("#lifeInsuranceTable").dataTable().fnDestroy();
         oTable = $('#lifeInsuranceTable').DataTable({
            "paging": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "data": JSON.parse(response),
            "columnDefs": [{ width: '272px', targets: 7 }],
            "columns": [
               { "data": "li_policy_number" },
               { "data": "li_issuer_name" },
               { "data": "li_start_date" },
               { "data": "li_maturity_date" },
               { "data": "li_sum_assured" },
               { "data": "ba_usedperc" },
               { "data": "ba_balperc" },
               {
                  data: null, render: function (data, type, row) {
                     return '<button type="button" style="width: 272px;" class="btn btn-info-rect active assignBen" data-id="' + row.pk_lic_id + '" data-key="pk_lic_id" data-form="addLifeInsurance" data-modal="beniBankModal" data-dbtable="will_lic" data-table="will_lic"><i class="fa fa-user-plus"></i> Assign Beneficiary</button>' +
                        '<button type="button" id="' + row.pk_lic_id + '" class="btn btn-primary-rect willView" data-id="' + row.pk_lic_id + '" data-key="pk_lic_id" data-table="will_lic" data-form="addLifeInsurance" data-modal="lifeInsuranceModal"><i class="fa fa-eye"></i> View</button>' +
                        '<button type="button" id="willEdit" class="btn btn-warning-rect willEdit" data-id="' + row.pk_lic_id + '" data-key="pk_lic_id" data-table="will_lic" data-form="addLifeInsurance" data-modal="lifeInsuranceModal"><i class="fa fa-edit"></i> Edit</a>' +
                        '<button type="button" id="willDelete" class="btn btn-danger-rect active willDelete" data-id="' + row.pk_lic_id + '" data-key="pk_lic_id" data-table="will_lic" data-form="addLifeInsurance"><i class="fa fa-trash-o"></i> Delete </button>';
                  }
               }],
            "fnInitComplete": function () { $("#lifeInsuranceTable").css("width", "100%"); }
         });
      }
   });
}
function jewels() {
   var objData = {};
   objData["formName"] = "addJewel";
   objData["act"] = "get";
   objData["id"] = ""
   objData["data"] = "";
   objData["table"] = "will_jewellery";
   $.ajax({
      url: $("#addJewel")[0].action,
      type: "POST",
      data: objData,
      beforeSend: function () {
         $('.ajax-loader').css("visibility", "visible");
      },
      complete: function () {
         $('.ajax-loader').css("visibility", "hidden");
      },
      success: function (response) {
         $("#jewelTable").dataTable().fnDestroy();
         oTable = $('#jewelTable').DataTable({
            "paging": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "data": JSON.parse(response),
            "columnDefs": [{ width: '272px', targets: 5 }],
            "columns": [
               { "data": "jwl_type" },
               { "data": "jwl_amount" },
               { "data": "jwl_description" },
               { "data": "ba_usedperc" },
               { "data": "ba_balperc" },
               {
                  data: null, render: function (data, type, row) {
                     return '<button type="button" style="width:272px;" class="btn btn-info-rect active assignBen" data-id="' + row.pk_jwl_id + '" data-key="pk_jwl_id" data-form="addJewel" data-modal="beniBankModal" data-dbtable="will_jewellery" data-table="will_jewellery"><i class="fa fa-user-plus"></i> Assign Beneficiary</button>' +
                        '<button type="button" id="' + row.pk_jwl_id + '" class="btn btn-primary-rect willView" data-id="' + row.pk_jwl_id + '" data-key="pk_jwl_id" data-table="will_jewellery" data-form="addJewel" data-modal="jewelModal"><i class="fa fa-eye"></i> View</button>' +
                        '<button type="button" id="willEdit" class="btn btn-warning-rect willEdit" data-id="' + row.pk_jwl_id + '" data-key="pk_jwl_id" data-table="will_jewellery" data-form="addJewel" data-modal="jewelModal"><i class="fa fa-edit"></i> Edit</a>' +
                        '<button type="button" id="willDelete" class="btn btn-danger-rect active willDelete" data-id="' + row.pk_jwl_id + '" data-key="pk_jwl_id" data-table="will_jewellery" data-form="addJewel"><i class="fa fa-trash-o"></i> Delete </button>';
                  }
               }],
            "fnInitComplete": function () { $("#jewelTable").css("width", "100%"); }
         });
      }
   });
}
function bodyOrgans() {
   var objData = {};
   objData["formName"] = "addBodyOrgans";
   objData["act"] = "get";
   objData["id"] = ""
   objData["data"] = "";
   objData["table"] = "will_body_organ";
   $.ajax({
      url: $("#addBodyOrgans")[0].action,
      type: "POST",
      data: objData,
      beforeSend: function () {
         $('.ajax-loader').css("visibility", "visible");
      },
      complete: function () {
         $('.ajax-loader').css("visibility", "hidden");
      },
      success: function (response) {
         $("#bodyorganTable").dataTable().fnDestroy();
         oTable = $('#bodyorganTable').DataTable({
            "paging": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "data": JSON.parse(response),
            "columnDefs": [{ width: '272px', targets: 3 }],
            "columns": [
               { "data": "body_organ_name" },
               { "data": "body_organ_hospital_name" },
               {
                  data: null, render: function (data, type, row) {
                     return row.body_organ_addr1 + ', ' + row.body_organ_addr2 + ', ' + row.body_organ_city + ', ' + row.body_organ_state + ', ' + row.body_organ_country + ', ' + row.body_organ_zip
                  }
               },
               {
                  data: null, render: function (data, type, row) {
                     return '<button type="button" id="willEdit" class="btn btn-warning-rect willEdit" data-id="' + row.pk_borgan_id + '" data-key="pk_borgan_id" data-table="will_body_organ" data-form="addBodyOrgans" data-modal="bodyOrganModal"><i class="fa fa-edit"></i> Edit</a>' +
                        '<button type="button" id="willDelete" class="btn btn-danger-rect active willDelete" data-id="' + row.pk_borgan_id + '" data-key="pk_borgan_id" data-table="will_body_organ" data-form="addBodyOrgans"><i class="fa fa-trash-o"></i> Delete </button>';
                  }
               }],
            "fnInitComplete": function () { $("#bodyorganTable").css("width", "100%"); }
         });
      }
   });
}
function petAnimals() {
   var objData = {};
   objData["formName"] = "addPetAnimal";
   objData["act"] = "get";
   objData["id"] = ""
   objData["data"] = "";
   objData["table"] = "will_pet_animal";
   $.ajax({
      url: $("#addPetAnimal")[0].action,
      type: "POST",
      data: objData,
      beforeSend: function () {
         $('.ajax-loader').css("visibility", "visible");
      },
      complete: function () {
         $('.ajax-loader').css("visibility", "hidden");
      },
      success: function (response) {
         $("#petAnimalTable").dataTable().fnDestroy();
         oTable = $('#petAnimalTable').DataTable({
            "paging": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "data": JSON.parse(response),
            "columnDefs": [{ width: '272px', targets: 3 }],
            "columns": [
               { "data": "pet_animal_name" },
               { "data": "pet_animal_type" },
               { data: null, render: function (data, type, row) { return row.ben_fname + ' ' + row.ben_mname + ' ' + row.ben_lname } },
               {
                  data: null, render: function (data, type, row) {
                     return '<button type="button" id="willEdit" class="btn btn-warning-rect willEdit" data-id="' + row.pk_pa_id + '" data-key="pk_pa_id" data-table="will_pet_animal" data-form="addPetAnimal" data-modal="petAnimalModal"><i class="fa fa-edit"></i> Edit</a>' +
                        '<button type="button" id="willDelete" class="btn btn-danger-rect active willDelete" data-id="' + row.pk_pa_id + '" data-key="pk_pa_id" data-table="will_pet_animal" data-form="addPetAnimal"><i class="fa fa-trash-o"></i> Delete </button>';
                  }
               }],
            "fnInitComplete": function () { $("#petAnimalTable").css("width", "100%"); }
         });
      }
   });
}
function otherAssets() {
   var objData = {};
   objData["formName"] = "addOtherAsset";
   objData["act"] = "get";
   objData["id"] = ""
   objData["data"] = "";
   objData["table"] = "will_other_assets";
   $.ajax({
      url: $("#addOtherAsset")[0].action,
      type: "POST",
      data: objData,
      beforeSend: function () {
         $('.ajax-loader').css("visibility", "visible");
      },
      complete: function () {
         $('.ajax-loader').css("visibility", "hidden");
      },
      success: function (response) {
         $("#otherAssetsTable").dataTable().fnDestroy();
         oTable = $('#otherAssetsTable').DataTable({
            "paging": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "data": JSON.parse(response),
            "columnDefs": [{ width: '272px', targets: 5 }],
            "columns": [
               { "data": "oa_name" },
               {
                  data: null, render: function (data, type, row) {
                     return row.oa_addr1 + ', ' + row.oa_addr2 + ', ' + row.oa_city + ', ' + row.oa_state + ', ' + row.oa_country + ', ' + row.oa_zip
                  }
               },
               { "data": "oa_own_perc" },
               { "data": "ba_usedperc" },
               { "data": "ba_balperc" },
               {
                  data: null, render: function (data, type, row) {
                     return '<button type="button" style="width: 272px;" class="btn btn-info-rect active assignBen" data-id="' + row.pk_oasset_id + '" data-key="pk_oasset_id" data-form="addOtherAsset" data-modal="beniBankModal" data-dbtable="will_other_assets" data-table="will_other_assets"><i class="fa fa-user-plus"></i> Assign Beneficiary</button>' +
                        '<button type="button" id="' + row.pk_oasset_id + '" class="btn btn-primary-rect willView" data-id="' + row.pk_oasset_id + '" data-key="pk_oasset_id" data-table="will_other_assets" data-form="addOtherAsset" data-modal="otherAssetsModal"><i class="fa fa-eye"></i> View</button>' +
                        '<button type="button" id="willEdit" class="btn btn-warning-rect willEdit" data-id="' + row.pk_oasset_id + '" data-key="pk_oasset_id" data-table="will_other_assets" data-form="addOtherAsset" data-modal="otherAssetsModal"><i class="fa fa-edit"></i> Edit</a>' +
                        '<button type="button" id="willDelete" class="btn btn-danger-rect active willDelete" data-id="' + row.pk_oasset_id + '" data-key="pk_oasset_id" data-table="will_other_assets" data-form="addOtherAsset"><i class="fa fa-trash-o"></i> Delete </button>';
                  }
               }],
            "fnInitComplete": function () { $("#otherAssetsTable").css("width", "100%"); }
         });

      }
   });
}
function ipr() {
   var objData = {};
   objData["formName"] = "addIPR";
   objData["act"] = "get";
   objData["id"] = ""
   objData["data"] = "";
   objData["table"] = "will_ipr";
   $.ajax({
      url: $("#addIPR")[0].action,
      type: "POST",
      data: objData,
      beforeSend: function () {
         $('.ajax-loader').css("visibility", "visible");
      },
      complete: function () {
         $('.ajax-loader').css("visibility", "hidden");
      },
      success: function (response) {
         $("#iprTable").dataTable().fnDestroy();
         oTable = $('#iprTable').DataTable({
            "paging": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "data": JSON.parse(response),
            "columnDefs": [{ width: '272px', targets: 4 }],
            "columns": [
               { data: null, render: function (data, type, row) { return iprType(row.ipr_type) } },
               { "data": "ipr_amount" },
               { "data": "ba_usedperc" },
               { "data": "ba_balperc" },
               {
                  data: null, render: function (data, type, row) {
                     return '<button type="button" style="width:272px;" class="btn btn-info-rect active assignBen" data-id="' + row.pk_digi_id + '" data-key="pk_digi_id" data-form="addIPR" data-modal="beniBankModal" data-dbtable="will_ipr" data-table="will_ipr"><i class="fa fa-user-plus"></i> Assign Beneficiary</button>' +
                        '<button type="button" id="' + row.pk_digi_id + '" class="btn btn-primary-rect willView" data-id="' + row.pk_digi_id + '" data-key="pk_digi_id" data-table="will_ipr" data-form="addIPR" data-modal="iprModal"><i class="fa fa-eye"></i> View</button>' +
                        '<button type="button" id="willEdit" class="btn btn-warning-rect willEdit" data-id="' + row.pk_digi_id + '" data-key="pk_digi_id" data-table="will_ipr" data-form="addIPR" data-modal="iprModal"><i class="fa fa-edit"></i> Edit</a>' +
                        '<button type="button" id="willDelete" class="btn btn-danger-rect active willDelete" data-id="' + row.pk_digi_id + '" data-key="pk_digi_id" data-table="will_ipr" data-form="addIPR"><i class="fa fa-trash-o"></i> Delete </button>';
                  }
               }],
            "fnInitComplete": function () { $("#iprTable").css("width", "100%"); }
         });

      }
   });
}
function vehicle() {
   var objData = {};
   objData["formName"] = "addVehicle";
   objData["act"] = "get";
   objData["id"] = ""
   objData["data"] = "";
   objData["table"] = "will_vehicle";
   $.ajax({
      url: $("#addVehicle")[0].action,
      type: "POST",
      data: objData,
      beforeSend: function () {
         $('.ajax-loader').css("visibility", "visible");
      },
      complete: function () {
         $('.ajax-loader').css("visibility", "hidden");
      },
      success: function (response) {
         $("#vehicletable").dataTable().fnDestroy();
         oTable = $('#vehicletable').DataTable({
            "paging": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "data": JSON.parse(response),
            "columnDefs": [{ width: '272px', targets: 3 }],
            "columns": [{ "data": "vehicle_name" }, { "data": "vehicle_reg_num" }, { "data": "vehicle_beneficiary" },
            {
               data: null, render: function (data, type, row) {
                  return '<button type="button" id="willEdit" class="btn btn-warning-rect willEdit" data-id="' + row.pk_vehicle_id + '" data-key="pk_vehicle_id" data-table="will_vehicle" data-form="addVehicle" data-modal="vehicleModal"><i class="fa fa-edit"></i> Edit</a>' +
                     '<button type="button" id="willDelete" class="btn btn-danger-rect active willDelete" data-id="' + row.pk_vehicle_id + '" data-key="pk_vehicle_id" data-table="will_vehicle" data-form="addVehicle"><i class="fa fa-trash-o"></i> Delete </button>';
               }
            }],
            "fnInitComplete": function () { $("#vehicletable").css("width", "100%"); }
         });
      }
   });
}
function liabilities() {
   var objData = {};
   objData["formName"] = "addLiability";
   objData["act"] = "get";
   objData["id"] = ""
   objData["data"] = "";
   objData["table"] = "will_liabilities";
   $.ajax({
      url: $("#addLiability")[0].action,
      type: "POST",
      data: objData,
      beforeSend: function () {
         $('.ajax-loader').css("visibility", "visible");
      },
      complete: function () {
         $('.ajax-loader').css("visibility", "hidden");
      },
      success: function (response) {
         $("#liabilityTable").dataTable().fnDestroy();
         oTable = $('#liabilityTable').DataTable({
            "paging": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "data": JSON.parse(response),
            "columnDefs": [{ width: '272px', targets: 7 }],
            "columns": [
               { data: null, render: function (data, type, row) { return liabilityType(row.liability_type) } },
               { "data": "liability_institution_name" },
               { "data": "liability_amount" },
               {
                  data: null, render: function (data, type, row) {
                     return row.liability_addr1 + ', ' + row.liability_addr2 + ', ' + row.liability_city + ', ' + row.liability_state + ', ' + row.liability_country + ', ' + row.liability_zip
                  }
               },
               {
                  data: null, render: function (data, type, row) {
                     return row.liability_ind_addr1 + ', ' + row.liability_ind_addr2 + ', ' + row.liability_ind_city + ', ' + row.liability_ind_state + ', ' + row.liability_ind_country + ', ' + row.liability_ind_zip
                  }
               },
               { "data": "ba_usedperc" },
               { "data": "ba_balperc" },
               {
                  data: null, render: function (data, type, row) {
                     return '<button type="button" style="width: 272px;" class="btn btn-info-rect active assignBen" data-id="' + row.pk_liabi_id + '" data-key="pk_liabi_id" data-form="addLiability" data-modal="beniBankModal" data-dbtable="will_liabilities" data-table="will_liabilities"><i class="fa fa-user-plus"></i> Assign Beneficiary</button>' +
                        '<button type="button" id="' + row.pk_liabi_id + '" class="btn btn-primary-rect willView" data-id="' + row.pk_liabi_id + '" data-key="pk_liabi_id" data-table="will_liabilities" data-form="addLiability" data-modal="liabilityModal"><i class="fa fa-eye"></i> View</button>' +
                        '<button type="button" id="willEdit" class="btn btn-warning-rect willEdit" data-id="' + row.pk_liabi_id + '" data-key="pk_liabi_id" data-table="will_liabilities" data-form="addLiability" data-modal="liabilityModal"><i class="fa fa-edit"></i> Edit</a>' +
                        '<button type="button" id="willDelete" class="btn btn-danger-rect active willDelete" data-id="' + row.pk_liabi_id + '" data-key="pk_liabi_id" data-table="will_liabilities" data-form="addLiability"><i class="fa fa-trash-o"></i> Delete </button>';
                  }
               }
            ],
            "fnInitComplete": function () { $("#liabilityTable").css("width", "100%"); }
         });
      }
   });
}
function formSubmit(objData, action) {
   var res = ""
   $.ajax({
      url: action,
      type: "POST",
      data: objData,
      async: false,
      beforeSend: function () {
         $('.ajax-loader').css("visibility", "visible");
      },
      complete: function () {
         $('.ajax-loader').css("visibility", "hidden");
      },
      success: function (response) {
         res = response;
      }
   });
   return res;
}
function fnFormatDetails(table_id, html) {
   var sOut = "<table class='table table-bordered'  id='benTable_" + table_id + "' >";
   sOut += html;
   sOut += "</table>";
   return sOut;
}
function refreshTable(tableName) {
   switch (tableName) {
      case "will_beneficiary": benificiary(); break;
      case "will_bank_accounts": bankAccounts(); break;
      case "will_locker_info": lockers(); break;
      case "will_fixed_deposit": fixedDeposits(); break;
      case "will_mutual_fund": mutualFunds(); break;
      case "will_share": shares(); break;
      case "will_bond_details": bonds(); break;
      case "will_immovable_properties": immovableProperties(); break;
      case "will_business": business(); break;
      case "will_ppf_info": providentFund(); break;
      case "will_pension_funds": pensionFunds(); break;
      case "will_gratuity": gratuity(); break;
      case "will_general_insurance": generalInsurance(); break;
      case "will_lic": lifeInsurance(); break;
      case "will_jewellery": jewels(); break;
      case "will_body_organ": bodyOrgans(); break;
      case "will_pet_animal": petAnimals(); break;
      case "will_other_assets": otherAssets(); break;
      case "will_ipr": ipr(); break;
      case "will_vehicle": vehicle(); break;
      case "will_liabilities": liabilities(); break;
   }
}
function stateName(id) {
   var state = ""
   let states = [{ "id": 35, "state": "Andaman and Nicobar islands", "itrcode": "01", "bsecode": "AN" }, { "id": 28, "state": "Andhra Pradesh", "itrcode": "02", "bsecode": "AP" }, { "id": 12, "state": "Arunachal Pradesh", "itrcode": "03", "bsecode": "AR" }, { "id": 18, "state": "Assam", "itrcode": "04", "bsecode": "AS" }, { "id": 10, "state": "Bihar", "itrcode": "05", "bsecode": "BR" }, { "id": 4, "state": "Chandigarh", "itrcode": "06", "bsecode": "CH" }, { "id": 22, "state": "Chattisgarh", "itrcode": "33", "bsecode": "CG" }, { "id": 26, "state": "Dadra Nagara and haveli", "itrcode": "07", "bsecode": "DN" }, { "id": 25, "state": "Daman and Diu ", "itrcode": "08", "bsecode": "DD" }, { "id": 7, "state": "Delhi", "itrcode": "09", "bsecode": "DL" }, { "id": 30, "state": "Goa", "itrcode": "10", "bsecode": "GA" }, { "id": 24, "state": "Gujarat", "itrcode": "11", "bsecode": "GJ" }, { "id": 6, "state": "Haryana", "itrcode": "12", "bsecode": "HR" }, { "id": 2, "state": "Himachal Pradesh", "itrcode": "13", "bsecode": "HP" }, { "id": 1, "state": "Jammu and Kashmir", "itrcode": "14", "bsecode": "JK" }, { "id": 20, "state": "Jharkhand", "itrcode": "35", "bsecode": "JH" }, { "id": 29, "state": "Karnataka", "itrcode": "15", "bsecode": "KA" }, { "id": 32, "state": "Kerala", "itrcode": "16", "bsecode": "KL" }, { "id": 31, "state": "Lakshadweep", "itrcode": "17", "bsecode": "LD" }, { "id": 23, "state": "Madhya Pradesh", "itrcode": "18", "bsecode": "MP" }, { "id": 27, "state": "Maharashtra", "itrcode": "19", "bsecode": "MH" }, { "id": 14, "state": "Manipur", "itrcode": "20", "bsecode": "MN" }, { "id": 17, "state": "Meghalaya", "itrcode": "21", "bsecode": "ML" }, { "id": 15, "state": "Mizoram", "itrcode": "22", "bsecode": "MZ" }, { "id": 13, "state": "Nagaland", "itrcode": "23", "bsecode": "NL" }, { "id": 21, "state": "Orissa", "itrcode": "24", "bsecode": "OR" }, { "id": 34, "state": "Pondicherry", "itrcode": "25", "bsecode": "PY" }, { "id": 3, "state": "Punjab", "itrcode": "26", "bsecode": "PB" }, { "id": 8, "state": "Rajasthan", "itrcode": "27", "bsecode": "RJ" }, { "id": 11, "state": "Sikkim", "itrcode": "28", "bsecode": "SK" }, { "id": 33, "state": "Tamil Nadu", "itrcode": "29", "bsecode": "TN" }, { "id": 16, "state": "Tripura", "itrcode": "30", "bsecode": "TR" }, { "id": 9, "state": "Uttar Pradesh", "itrcode": "31", "bsecode": "UP" }, { "id": 5, "state": "Uttarakhand", "itrcode": "34", "bsecode": "UA" }, { "id": 19, "state": "West Bengal", "itrcode": "32", "bsecode": "WB" }, { "id": 36, "state": "Telangana", "itrcode": "36", "bsecode": "XX" }, { "id": 37, "state": "Ladakh", "itrcode": "37", "bsecode": "" }, { "id": 38, "state": "Foreign", "itrcode": "99", "bsecode": "" }];
   $.each(states, function (key, value) {
      if (value.id == id) {
         state = value.state;
      }
   });
   return state;
}
function countryName(id) {
   var country = ""
   let countries = [{ "id": 102, "country": "INDIA" }];
   $.each(countries, function (key, value) {
      if (value.id == id) {
         country = value.country;
      }
   });
   return country;
}
function occupationName(id) {
   var occupation = ""
   let occupations = [{ "id": 1, "value": "service", "occupation": "service" }, { "id": 2, "value": "Business", "occupation": "Business" }, { "id": 3, "value": "Others", "occupation": "Others" }];
   $.each(occupations, function (key, value) {
      if (value.id == id) {
         occupation = value.occupation;
      }
   });
   return occupation;
}
function religionName(id) {
   var religion = ""
   let religions = [{ "id": 3, "value": "Hindu", "religion": "Hindu" }, { "id": 1, "value": "Buddhist", "religion": "Buddhist" }, { "id": 2, "value": "Christian", "religion": "Christian" }, { "id": 5, "value": "Jain", "religion": "Jain" }, { "id": 6, "value": "Judaism", "religion": "Judaism" }, { "id": 7, "value": "Parsi", "religion": "Parsi" }, { "id": 8, "value": "Sikh", "religion": "Sikh" }, { "id": 10, "value": "Others", "religion": "Others" }, { "id": 4, "value": "Islam", "religion": "Islam" }];
   $.each(religions, function (key, value) {
      if (value.id == id) {
         religion = value.religion;
      }
   });
   return religion;
}
function relationName(id) {
   var relation = ""
   let relations = [{ "id": 2, "relation": "Spouse" }, { "id": 3, "relation": "Son" }, { "id": 4, "relation": "Daughter" }, { "id": 5, "relation": "Mother" }, { "id": 6, "relation": "Father" }, { "id": 7, "relation": "Brother" }, { "id": 8, "relation": "Sister" }, { "id": 19, "relation": "Grand Daughter" }, { "id": 20, "relation": "Grand Son" }, { "id": 21, "relation": "Grand Father" }, { "id": 22, "relation": "Grand Mother" }, { "id": 23, "relation": "Son-in-law" }, { "id": 24, "relation": "Daughter-in-law" }, { "id": 99, "relation": "Others" }];
   $.each(relations, function (key, value) {
      if (value.id == id) {
         relation = value.relation;
      }
   });
   return relation;
}
function accountType(id) {
   var actype = ""
   let actypes = [{ "id": 1, "actype": "Current" }, { "id": 2, "actype": "Savings" }, { "id": 3, "actype": "ESCROW" }];
   $.each(actypes, function (key, value) {
      if (value.id == id) {
         actype = value.actype;
      }
   });
   return actype;
}
function titleList(id) {
   var actype = ""
   let actypes = [{ "id": 1, "actype": "Mr" }, { "id": 2, "actype": "Mrs" }, { "id": 3, "actype": "Ms" }, { "id": 10, "actype": "master" }, { "id": 23, "actype": "Kumar" }, { "id": 24, "actype": "Kumari" }];
   $.each(actypes, function (key, value) {
      if (value.id == id) {
         actype = value.actype;
      }
   });
   return actype;
}
function liabilityType(id) {
   var actype = ""
   let actypes = [{ "id": 1, "actype": "Loan" }, { "id": 2, "actype": "Hypothecation" }, { "id": 3, "actype": "Mortgage" }, { "id": 4, "actype": "Guarantor" }, { "id": 5, "actype": "Other" }];
   $.each(actypes, function (key, value) {
      if (value.id == id) {
         actype = value.actype;
      }
   });
   return actype;
}
function iprType(id) {
   var actype = ""
   let actypes = [{ "id": 1, "actype": "Digital Photograph" }, { "id": 2, "actype": "Software Code" }, { "id": 3, "actype": "Software Patent" }, { "id": 4, "actype": "Others" }];
   $.each(actypes, function (key, value) {
      if (value.id == id) {
         actype = value.actype;
      }
   });
   return actype;
}
function filladd() {
   if (cor_as_perm.checked == true) {
      $('#cor_addr1').val($('#address1').val());
      $('#cor_addr2').val($('#address2').val());
      $('#cor_addr3').val($('#address3').val());
      $('#cor_city').val($('#city').val());
      $('#cor_state').val($('#state').val());
      $('#cor_zip').val($('#zip').val());
      $('#cor_country').val($('#country').val());
   }
   else if (cor_as_perm.checked == false) {
      $('#cor_addr1').val("");
      $('#cor_addr2').val("");
      $('#cor_addr3').val("");
      $('#cor_city').val("");
      $('#cor_state').val("");
      $('#cor_zip').val("");
      $('#cor_country').val("");
   }
}
function filladdBen() {
   if (ben_cor_as_perm.checked == true) {
      $('#ben_cor_addr1').val($('#ben_perm_addr1').val());
      $('#ben_cor_addr2').val($('#ben_perm_addr2').val());
      $('#ben_cor_addr3').val($('#ben_perm_addr3').val());
      $('#ben_cor_city').val($('#ben_perm_city').val());
      $('#ben_cor_state').val($('#ben_perm_state').val());
      $('#ben_cor_zip').val($('#ben_perm_zip').val());
      $('#ben_cor_country').val($('#ben_perm_country').val());
   }
   else if (ben_cor_as_perm.checked == false) {
      $('#ben_cor_addr1').val("");
      $('#ben_cor_addr2').val("");
      $('#ben_cor_addr3').val("");
      $('#ben_cor_city').val("");
      $('#ben_cor_state').val("");
      $('#ben_cor_zip').val("");
      $('#ben_cor_country').val("");
   }
}
function filladdBenGard() {
   if (ben_gard_cor_as_ben_perm.checked == true) {
      $('#ben_gard_cor_addr1').val($('#ben_perm_addr1').val());
      $('#ben_gard_cor_addr2').val($('#ben_perm_addr2').val());
      $('#ben_gard_cor_addr3').val($('#ben_perm_addr3').val());
      $('#ben_gard_cor_city').val($('#ben_perm_city').val());
      $('#ben_gard_cor_state').val($('#ben_perm_state').val());
      $('#ben_gard_cor_zip').val($('#ben_perm_zip').val());
      $('#ben_gard_cor_country').val($('#ben_perm_country').val());
   }
   else if (ben_gard_cor_as_ben_perm.checked == false) {
      $('#ben_gard_cor_addr1').val("");
      $('#ben_gard_cor_addr2').val("");
      $('#ben_gard_cor_addr3').val("");
      $('#ben_gard_cor_city').val("");
      $('#ben_gard_cor_state').val("");
      $('#ben_gard_cor_zip').val("");
      $('#ben_gard_cor_country').val("");
   }
}
function filladdBenGardPerm() {
   if (ben_gard_cor_as_perm.checked == true) {
      $('#ben_gard_perm_addr1').val($('#ben_perm_addr1').val());
      $('#ben_gard_perm_addr2').val($('#ben_perm_addr2').val());
      $('#ben_gard_perm_addr3').val($('#ben_perm_addr3').val());
      $('#ben_gard_perm_city').val($('#ben_perm_city').val());
      $('#ben_gard_perm_state').val($('#ben_perm_state').val());
      $('#ben_gard_perm_zip').val($('#ben_perm_zip').val());
      $('#ben_gard_perm_country').val($('#ben_perm_country').val());
   }
   else if (ben_gard_cor_as_perm.checked == false) {
      $('#ben_gard_perm_addr1').val("");
      $('#ben_gard_perm_addr2').val("");
      $('#ben_gard_perm_addr3').val("");
      $('#ben_gard_perm_city').val("");
      $('#ben_gard_perm_state').val("");
      $('#ben_gard_perm_zip').val("");
      $('#ben_gard_perm_country').val("");
   }
}
function GardcorAddrGardPermAddr() {
   if (ben_gard_cor_as_gard_perm.checked == true) {
      $('#ben_gard_cor_addr1').val($('#ben_gard_perm_addr1').val());
      $('#ben_gard_cor_addr2').val($('#ben_gard_perm_addr2').val());
      $('#ben_gard_cor_addr3').val($('#ben_gard_perm_addr3').val());
      $('#ben_gard_cor_city').val($('#ben_gard_perm_city').val());
      $('#ben_gard_cor_state').val($('#ben_gard_perm_state').val());
      $('#ben_gard_cor_zip').val($('#ben_gard_perm_zip').val());
      $('#ben_gard_cor_country').val($('#ben_gard_perm_country').val());
   }
   else if (ben_gard_cor_as_gard_perm.checked == false) {
      $('#ben_gard_cor_addr1').val("");
      $('#ben_gard_cor_addr2').val("");
      $('#ben_gard_cor_addr3').val("");
      $('#ben_gard_cor_city').val("");
      $('#ben_gard_cor_state').val("");
      $('#ben_gard_cor_zip').val("");
      $('#ben_gard_cor_country').val("");
   }
}
function GardcorAddrBenCorAddr() {
   if (ben_gard_cor_as_ben_cor.checked == true) {
      $('#ben_gard_cor_addr1').val($('#ben_cor_addr1').val());
      $('#ben_gard_cor_addr2').val($('#ben_cor_addr2').val());
      $('#ben_gard_cor_addr3').val($('#ben_cor_addr3').val());
      $('#ben_gard_cor_city').val($('#ben_cor_city').val());
      $('#ben_gard_cor_state').val($('#ben_cor_state').val());
      $('#ben_gard_cor_zip').val($('#ben_cor_zip').val());
      $('#ben_gard_cor_country').val($('#ben_cor_country').val());
   }
   else if (ben_gard_cor_as_ben_cor.checked == false) {
      $('#ben_gard_cor_addr1').val("");
      $('#ben_gard_cor_addr2').val("");
      $('#ben_gard_cor_addr3').val("");
      $('#ben_gard_cor_city').val("");
      $('#ben_gard_cor_state').val("");
      $('#ben_gard_cor_zip').val("");
      $('#ben_gard_cor_country').val("");
   }
}
function duplicateCheck(y, col) {
   var x = oTable.column(col).data();
   if (jQuery.inArray(y, x) != -1) {
      alert("Account Number already exist");
      $('.save').prop('disabled', true)
   } else {
      $('.save').prop('disabled', false)
   }
}
function duplicateBenCheck(y, col) {
   $.each(oInnerTable.data(), function (index, obj) {
      if (y == obj.fk_ben_id) {
         alert("Beneficiary already added");
         $('#btn_assign').prop('disabled', true);
         return false;
      } else {
         $('#btn_assign').prop('disabled', false)
      }
   });
}
$("#txt_beneficiary_share").change(function () {
   var val = parseInt($(this).val());
   if (val != "" || val != 0) {
      if (val > 0 && val <= parseInt(tempPercent)) {
         $('#btn_assign').removeAttr('disabled');
      } else {
         $("#btn_assign").attr('disabled', 'disabled');
         alert("Percentage must be lessthan " + tempPercent);
      }
   }
});
$("#dob").focusout(function () {
   $("#age").val(getAge($(this).val()));
});
$("#ben_dob").focusout(function () {
   var benage = getAge($(this).val());
   $("#ben_age").val(benage);
   if (benage < 18) {
      $('#guardiant_main').show();
   } else {
      $('#guardiant_main').hide();
   }
});
$("#ben_gard_dob").focusout(function () {
   $("#ben_gard_age").val(getAge($(this).val()));
});
/*---------------------------------- 20190319-BSEN ------------------------------------------*/
/*-------------------------------- Age-Calculation-START -------------------------------------*/
function getAge(getDOB) {
   var mdate = getDOB.toString();
   //alert("mDate" + mdate);
   var yearThen = parseInt(mdate.substring(0, 4), 10);   // getting year from b Date
   //alert("yearThen" + yearThen);
   var monthThen = parseInt(mdate.substring(5, 7), 10);  // getting month from b Date
   //alert("monthThen"+monthThen);
   var dayThen = parseInt(mdate.substring(8, 10), 10);   // getting date from b Date
   //alert("dayThen"+dayThen);
   var today = new Date();                              // getting today Date
   //alert("today"+today);
   var birthday = new Date(yearThen, monthThen - 1, dayThen);
   var differenceInMilisecond = today.valueOf() - birthday.valueOf();
   var year_age = Math.floor(differenceInMilisecond / 31536000000);
   var day_age = Math.floor((differenceInMilisecond % 31536000000) / 86400000);
   var month_age = Math.floor(day_age / 30);
   day_age = day_age % 30;
   return year_age;
}
/*-------------------------------- Age-Calculation-END -------------------------------------*/
account_count = 1;
actual_account_count = 1;
beneficiary_count = 1;
actual_beneficiary_count = 1;
$("#maturity_date").focusout(function () {
   var val1 = $(this).val();
   var val2 = $("#policy_start_date").val();
   var maturity_date = Date.parse(val1);
   var start_date = Date.parse(val2);
   var d = new Date();
   var strDate = d.getFullYear() + "/" + (d.getMonth() + 1) + "/" + d.getDate();
   var current_date = Date.parse(strDate);
   if (maturity_date == start_date) {
      $(".dis_button").attr("disabled", "disabled");
      alert("start date and maturity date can't be same.");
   } else if (start_date > maturity_date) {
      $(".dis_button").attr("disabled", "disabled");
      alert(" Maturity date is past date of Start date.");
   } else if (maturity_date > current_date) {
      alert(" future date provided!!!");
      $(".dis_button").attr("disabled", "disabled");
   } else {
      $(".dis_button").removeAttr("disabled", "disabled");
   }
   return;
});
$("#maturity_date").focusout(function () {
   var val1 = $(this).val();
   var val2 = $("#start_date").val();
   var maturity_date = Date.parse(val1);
   var start_date = Date.parse(val2);
   var d = new Date();
   var strDate = d.getFullYear() + "/" + (d.getMonth() + 1) + "/" + d.getDate();
   var current_date = Date.parse(strDate);
   if (maturity_date == start_date) {
      $(".dis_button").attr("disabled", "disabled");
      alert("start date and maturity date can't be same.");
   } else if (start_date > maturity_date) {
      $(".dis_button").attr("disabled", "disabled");
      alert(" Maturity date is past date of Start date.");
   } else if (maturity_date > current_date) {
      alert(" future date provided!!!");
      $(".dis_button").attr("disabled", "disabled");
   } else {
      $(".dis_button").removeAttr("disabled", "disabled");
   }
   return;
});
$("#closing_date ").focusout(function () {
   var val1 = $(this).val();
   var val2 = $("#start_date ").val();
   var maturity_date = Date.parse(val1);
   var start_date = Date.parse(val2);
   var d = new Date();
   var strDate = d.getFullYear() + "/ " + (d.getMonth() + 1) + "/ " + d.getDate();
   var current_date = Date.parse(strDate);
   if (maturity_date == start_date) {
      $(".dis_button ").attr("disabled ", "disabled ");
      alert("start date and close date can 't be same.");
   }
   else if (start_date > maturity_date) {
      $(".dis_button").attr("disabled", "disabled");
      alert(" close date is past date of Start date.");
   }
   else if (maturity_date > current_date) {
      alert(" future date provided!!!");
      $(".dis_button").attr("disabled", "disabled");
   } else {
      $(".dis_button").removeAttr("disabled", "disabled");
   }
   return;
});
$('#downloadWillPDF').click(function (e) {
   e.preventDefault();
   var temp1 = previewData();
   $('.nav-tabs a[href="#preview"]').tab('show');
   var delayInMilliseconds = 1000; //10 second
   setTimeout(function () {
      //getPDF();
      if (temp.status == 200) {
         var sTable = document.getElementById('willCodeHTML').innerHTML;
         var sTable_temp = document.getElementById('willCodeHTML');
         var dt = new Date();
         var time = dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds();
         var date = dt.getDate() + "/" + (dt.getMonth() + 1) + "/" + dt.getFullYear();
         var name = $('.user_name').text().trim();
         var data = { "pdfgen": "true", "name": name, "place": userplace, "date": date, "uid": "2052", "htmlcode": sTable, "willid": $('#will_id').text() };
         var settings = {
            "async": true,
            "crossDomain": true,
            "url": "https://optymoney.com/__lib.htmlPages/__postLoginPages/create_will_pdf.php",
            "method": "POST",
            "headers": {
               "content-type": "application/json",
               "cache-control": "no-cache"
            },
            "processData": false,
            "data": JSON.stringify(data),
         }

         $.ajax(settings).done(function (response) {
            window.open(response, '_blank');
            console.log(response);
         });
      }
   }, delayInMilliseconds);
});

$('#genpdf').click(function (e) {
   e.preventDefault();
   var temp1 = previewData();
   $('.nav-tabs a[href="#preview"]').tab('show');
   var delayInMilliseconds = 1000; //10 second
   setTimeout(function () {
      //getPDF();
      if (temp.status == 200) {
         var sTable = document.getElementById('willCodeHTML').innerHTML;
         var sTable_temp = document.getElementById('willCodeHTML');
         var dt = new Date();
         var time = dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds();
         var date = dt.getDate() + "/" + (dt.getMonth() + 1) + "/" + dt.getFullYear();
         var name = $('.user_name').text().trim();
         var data = { "pdfgen": "true", "name": name, "place": userplace, "date": date, "uid": "", "htmlcode": sTable, "willid": $('#will_id').text() };
         var settings = {
            "async": true,
            "crossDomain": true,
            "url": "https://optymoney.com/__lib.htmlPages/__postLoginPages/create_will_pdf.php",
            "method": "POST",
            "headers": {
               "content-type": "application/json",
               "cache-control": "no-cache"
            },
            "processData": false,
            "data": JSON.stringify(data),
         }

         $.ajax(settings).done(function (response) {
            window.open(response, '_blank');
            console.log(response);
         });
      }
   }, delayInMilliseconds);
});