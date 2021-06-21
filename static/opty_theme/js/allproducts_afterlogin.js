
var ajax_url = "https://optymoney.com/__lib.ajax/ajax_response.php";
var offer_id = "";
var url = window.location.href;
var arr = url.split('?');

$(document).ready(function () {
   $("#treeview").hummingbird();
   $("#uncheckAll").click(function () {
      $("#treeview").hummingbird("uncheckAll");
   });
   if (arr.length > 1 && arr[1] !== '') {
      console.log('params found' + arr[1]);
      var arr1 = arr[1].split('&');
      if (arr1.length > 1 && arr1[1] !== '') {
         var arr2 = arr1[1].split('=');
         offer_id = arr2[1];
         $('.offer_id').removeClass("activeBtn");
      } else {
         $('button[data-val="32"]').addClass("activeBtn");
         offer_id = 32;
      }
   } else {
      $('button[data-val="32"]').addClass("activeBtn");
      offer_id = 32;
   }
   $.ajax({
      cache: false,
      url: ajax_url,
      type: 'POST',
      //contentType: "application/json; charset=utf-8",
      //dataType: "json",
      data: { "filter_offer_search": "yes", "offer_id": offer_id },
      beforeSend: function () {
         $('.ajax-loader').css("visibility", "visible");
      },
      complete: function () {
         $('.ajax-loader').css("visibility", "hidden");
      },
      success: function (response) {
         //console.log(response);
         if (response) {
            const obj = JSON.parse(response);
            var originalData = JSON.parse(response);
            var parsedData = {};
            if (originalData.length == 0) {
               $("#all_pr_fetch").prepend("<div class='card'><div class='col-sm-12 text-center'><p> No schemes are available</p></div></div>");
            }
            for (var i = originalData.length - 1; i >= 0; i--) {
               var tempDisplay = "";
               var nav1Y = "";
               var j = 0;
               var borderLine = "border-right";
               tempDisplay = tempDisplay + "<div class='col-md-5 ml-3'><div class='row'>";
               $.each(originalData[i].nav_price, function (index, data) {
                  if (index == 1) {
                     nav1Y = data;
                  }
                  if (j >= 2) {
                     borderLine = "";
                  }
                  tempDisplay = tempDisplay + "<div class='col-4 " + borderLine + "'><div class='description-block'><h6 class='description-header'>" + data + "%</h6><span class='description-text'>" + index + "Y</span></div></div>";
                  j++;
               });
               tempDisplay = tempDisplay + "</div></div>";
               //console.log("NAV"+nav);
               $("#all_pr_fetch").prepend("<a class='col-md-12' href='?module_interface="+$.base64.encode('single_product')+"&id="+window.btoa(originalData[i].pk_nav_id)+"&nav="+window.btoa(nav1Y)+"' style='color: #000000; padding-bottom: 5px;'> <div class='card'> " +
                                "<div class='card-body'><div class='row'><div class='col-md-6 ml-4'><h6>"+originalData[i].scheme_name+"</h6><div class='badge btn-primary'>"+ucfirst(originalData[i].scheme_type)+" <i class='fas fa-star' style='font-weight: 510; font-size: 10px;'></i></div></div>"+tempDisplay+"</div></div></div></a>");
            }
         }
      }
   });
   /*-- ---------------------------------------------- Filter Call AMC ------------------------------------------------------------------ -- */
   $(".amc_code").click(function () {
      var val = $(this).val();
      $("#all_pr_fetch").empty();
      create_filter();
   });
   /*-- ---------------------------------------------- Filter Call Scheme Type ----------------------------------------------------------- --*/
   $(".schm_type").click(function () {
      var val = $(this).val();
      $("#all_pr_fetch").empty();
      create_filter();
   });
   /* -- ---------------------------------------------- Filter Call Scheme Risk ----------------------------------------------------------- --*/
   $(".sch_risk").click(function () {
      var val = $(this).val();
      $("#all_pr_fetch").empty();
         create_filter();
   });
   /* -- ---------------------------------------------- Filter Call Fund Size ------------------------------------------------------------- --*/
   $(".sch_fund_size").click(function () {
      var val = $(this).val();
      $("#all_pr_fetch").empty();
      create_filter();
   });
   /* ---------------------------------------------- Function for Filtering  ----------------------------------------------------------- */
   function create_filter() {
      var data = "";
      var amc_code = $(".amc_code").val();
      var schm_type = $(".schm_type").val();
      var sch_risk = $(".sch_risk").val();
      var sch_fund_size = $(".sch_fund_size").val();
      //filtering value of AMC
      var amc_code = [];
      $.each($("input[name='amc_code']:checked"), function () {
         amc_code.push($(this).val());
      });
      //filtering value for Scheme Type
      var schm_type = [];
      $.each($(".schm_type:checked"), function () {
         schm_type.push($(this).val());
         console.log(JSON.stringify(schm_type));
      });
      //filtering value for scheme Risk
      var sch_risk = [];
      $.each($("input[name='sch_risk']:checked"), function () {
         sch_risk.push($(this).val());
      });
      //filtering value for Fund Size
      var sch_fund_size = [];
      $.each($("input[name='sch_fund_size']:checked"), function () {
         sch_fund_size.push($(this).val());
      });
      if (amc_code.length == 0 && schm_type.length == 0 && sch_risk.length == 0 && sch_fund_size.length == 0) {
         data = { "filter_offer_search_app_test": "yes", "amc_code": amc_code, "schm_type": schm_type, "sch_risk": sch_risk, "sch_fund_size": sch_fund_size, "offer_id": "32" };
      } else {
         data = { "filter_offer_search_app_test": "yes", "amc_code": amc_code, "schm_type": schm_type, "sch_risk": sch_risk, "sch_fund_size": sch_fund_size };
      }
      //calling ajax to getting filtering data.
      $.ajax({
         cache: false,
         url: ajax_url,
         type: 'POST',
         beforeSend: function () {
            $('.ajax-loader').css("visibility", "visible");
         },
         complete: function () {
            $('.ajax-loader').css("visibility", "hidden");
         },
         data: data,
         success: function (response) {
            console.log(response);
            if (response) {
               const obj = JSON.parse(response);
               var originalData = JSON.parse(response);
               var parsedData = {};
               if (originalData.length == 0) {
                  $("#all_pr_fetch").prepend("<div class='card'><div class='col-sm-12 text-center'><p> No schemes are available</p></div></div>");
               }
               console.log(originalData.length);
               for (var i = originalData.length - 1; i >= 0; i--) {

                  var tempDisplay = "";
                  var nav1Y = "";
                  var j = 0;
                  var borderLine = "border-right";
                  tempDisplay = tempDisplay + "<div class='col-md-5 ml-3'><div class='row'>";
                  $.each(originalData[i].nav_price, function (index, data) {
                     if (index == 1) {
                        nav1Y = data;
                     }
                     if (j >= 2) {
                        borderLine = "";
                     }
                     tempDisplay = tempDisplay + "<div class='col-4 " + borderLine + "'><div class='description-block'><h6 class='description-header'>" + data + "%</h6><span class='description-text'>" + index + "Y</span></div></div>";
                     j++;
                  });
                  tempDisplay = tempDisplay + "</div></div>";
                  //console.log("NAV"+nav);
                  $("#all_pr_fetch").prepend("<a class='col-md-12' href='?module_interface="+$.base64.encode('single_product')+"&id="+window.btoa(originalData[i].pk_nav_id)+"&nav="+window.btoa(nav1Y)+"' style='color: #000000; padding-bottom: 5px;'> <div class='card'> " +
                                "<div class='card-body'><div class='row'><div class='col-md-6 ml-4'><h6>"+originalData[i].scheme_name+"</h6><div class='badge btn-primary'>"+ucfirst(originalData[i].scheme_type)+" <i class='fas fa-star' style='font-weight: 510; font-size: 10px;'></i></div></div>"+tempDisplay+"</div></div></div></a>");
               }
            }
         }
      });
   }

   $("#view_more").click(function () {
      //var view_more = $(this).attr('data-val');
      $("#all_pr_fetch").empty();
      //alert(offer_id);
      var nav = 0.0;
      $.ajax({
         cache: false,
         url: ajax_url,
         type: 'POST',
         data: { "view_more": "yes" },
         beforeSend: function () {
            $('.ajax-loader').css("visibility", "visible");
         },
         complete: function () {
            $('.ajax-loader').css("visibility", "hidden");
         },
         success: function (response) {
            if (response) {
               const obj = JSON.parse(response);
               var originalData = JSON.parse(response);
               var parsedData = {};
               if (originalData.length == 0) {
                  $("#all_pr_fetch").prepend("<div class='card'><div class='col-sm-12 text-center'><p> No schemes are available</p></div></div>");
               }
               for (var i = originalData.length - 1; i >= 0; i--) {
                  var tempDisplay = "";
                  var nav1Y = "";
                  $.ajax({
                     cache: false,
                     url: ajax_url,
                     type: 'POST',
                     async: false,
                     data: { "get_nav_per": "yes", "ISIN": originalData[i].isin, "year": "1-3-5" },
                     success: function (res) {
                        //console.log("res"+res);
                        if (res != "") {
                           nav = JSON.parse(res);
                           var i = 0;
                           var borderLine = "border-right";
                           tempDisplay = tempDisplay + "<div class='col-md-5 ml-3'><div class='row'>";
                           $.each(nav, function (index, data) {
                              if (index == 1) {
                                 nav1Y = data;
                              }
                              if (i >= 2) {
                                 borderLine = "";
                              }
                              tempDisplay = tempDisplay + "<div class='col-4 " + borderLine + "'><div class='description-block'><h6 class='description-header'>" + data + "%</h6><span class='description-text'>" + index + "Y</span></div></div>";
                              i++;
                           });
                           tempDisplay = tempDisplay + "</div></div>";
                        }
                     }
                  });
                  //console.log("NAV"+nav);
                  $("#all_pr_fetch").prepend("<a class='col-md-12' href='?module_interface="+$.base64.encode('single_product')+"&id=" + window.btoa(originalData[i].pk_nav_id) + "&nav=" + window.btoa(nav1Y) + "' style='color: #000000; padding-bottom: 5px;'> <div class='card'> " +
                     "<div class='card-body'><div class='row'><div class='col-md-6 ml-4'><h6>" + originalData[i].scheme_name + "</h6><div class='badge btn-primary'>" + ucfirst(originalData[i].scheme_type) + " <i class='fas fa-star' style='font-weight: 510; font-size: 10px;'></i></div></div>" + tempDisplay + "</div></div></div></a>");
               }
            }
         }
      });
   });

   $(".offer_id").click(function (e) {
      e.preventDefault();
      $('.offer_id').removeClass("activeBtn");
      $(this).addClass("activeBtn");
      var offer_id = $(this).attr('data-val');
      $("#all_pr_fetch").empty();
      var nav = 0.0;
      $.ajax({
         cache: false,
         url: ajax_url,
         type: 'POST',
         /*beforeSend: function(){
             $('.ajax-loader').css("visibility", "visible");
         },
         complete: function(){
             $('.ajax-loader').css("visibility", "hidden");
         },*/
         data: { "offer_select": "yes", "offer_id": offer_id },
         async: false,
         success: function (response) {
            console.log("response offer_id" + response);
            if (response) {
               const obj = JSON.parse(response);
               var originalData = JSON.parse(response);
               var parsedData = {};
               if (originalData.length == 0) {
                  $("#all_pr_fetch").prepend("<div class='card'><div class='col-sm-12 text-center'><p> No schemes are available</p></div></div>");
               }
               console.log("original data length : " + originalData.length);
               for (var i = originalData.length - 1; i >= 0; i--) {
                  var tempDisplay = "";
                  var nav1Y = "";
                  $.ajax({
                     cache: false,
                     url: ajax_url,
                     type: 'POST',
                     async: false,
                     data: { "get_nav_per": "yes", "ISIN": originalData[i].isin, "year": "1-3-5" },
                     success: function (res) {
                        //console.log("res"+res);
                        if (res != "") {
                           nav = JSON.parse(res);
                           var i = 0;
                           var borderLine = "border-right";
                           tempDisplay = tempDisplay + "<div class='col-md-5 ml-3'><div class='row'>";
                           $.each(nav, function (index, data) {
                              if (index == 1) {
                                 nav1Y = data;
                              }
                              if (i >= 2) {
                                 borderLine = "";
                              }
                              tempDisplay = tempDisplay + "<div class='col-4 " + borderLine + "'><div class='description-block'><h6 class='description-header'>" + data + "%</h6><span class='description-text'>" + index + "Y</span></div></div>";
                              i++;
                           });
                           tempDisplay = tempDisplay + "</div></div>";
                        }
                     }
                  });
                  //console.log("NAV"+nav);
                  $("#all_pr_fetch").prepend("<a class='col-md-12' href='?module_interface="+$.base64.encode('single_product')+"&id=" + window.btoa(originalData[i].pk_nav_id) + "&nav=" + window.btoa(nav1Y) + "' style='color: #000000; padding-bottom: 5px;'> <div class='card'> " +
                     "<div class='card-body'><div class='row'><div class='col-md-6 ml-4'><h6>" + originalData[i].scheme_name + "</h6><div class='badge btn-primary'>" + ucfirst(originalData[i].scheme_type) + " <i class='fas fa-star' style='font-weight: 510; font-size: 10px;'></i></div></div>" + tempDisplay + "</div></div></div></a>");
               }
            }
         }
      });
   });
});