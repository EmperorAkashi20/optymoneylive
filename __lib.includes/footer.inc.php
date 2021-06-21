<!--Bootstrap 4.6.0-->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
<!---END---->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.sticky/1.0.4/jquery.sticky.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>




<script src="<?php echo $CONFIG->staticURL; ?><?php echo $CONFIG->theme_new; ?>js/wow.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/owl.carousel.js"></script>

<script type="text/javascript">
    /*$.validator.addMethod('filesize', function (value, element, param) {
        return this.optional(element) || (element.files[0].size <= param)
    }, 'File size must be less than {0}');*/
    const formatter = new Intl.NumberFormat('en-US', {
        style: 'currency',
        currency: 'INR',
        minimumFractionDigits: 2
    });
    function ucfirst(string) {
        return string.charAt(0).toUpperCase() + string.slice(1).toLowerCase();
    }
    document.onreadystatechange = function() {
        if (document.readyState !== "complete") {
            document.querySelector("body").style.visibility = "hidden";
            document.querySelector(".ajax-loader").style.visibility = "visible";
        } else {
            document.querySelector(".ajax-loader").style.display = "none";
            document.querySelector("body").style.visibility = "visible";
        }
    };
</script>
<?php if($_SESSION[$CONFIG->sessionPrefix.'loginstatus']) { ?>
    <script src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>js/main.js"></script>
    <script src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>js/main1.js"></script>
    <script type="text/javascript">
        var logStat = "loggedin";
        sessionStorage.setItem("uid", <?php echo $CONFIG->loggedUserId;?>);
    </script>
    <?php  if ($CONFIG->pageName == "sip_details") {  ?>
        <script src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>js/MyWealth.js"></script>
    <?php } ?>
    <?php  if ($CONFIG->pageName == "calculators") {  ?>
        <script src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>js/MyWealth.js"></script>
        <script src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>js/blogs.js"></script>
    <?php } ?>
    <!-- <script src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>js/app.js"></script>-->
    <!-- <script src="<?php //echo $CONFIG->staticURL;?><?php //echo $CONFIG->theme_new; ?>js/empanel/common_scripts.min.js"></script> -->
    <?php if($CONFIG->pageName=="mutual_fund") { ?>
        <script src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>js/mftransaction.js"></script>
        <!-- DataTables -->
        <script src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>vendors/datatables/jquery.dataTables.min.js"></script>
        <script src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>vendors/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
        <script src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>vendors/datatables-responsive/js/dataTables.responsive.min.js"></script>
        <script src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>vendors/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <?php } ?>
    <?php if($CONFIG->pageName=="wealth" || $CONFIG->pageName=="dashboard") { ?>
        <!-- DataTables -->
        <script src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>vendors/datatables/jquery.dataTables.min.js"></script>
        <script src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>vendors/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
        <script src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>vendors/datatables-responsive/js/dataTables.responsive.min.js"></script>
        <script src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>vendors/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.2.1/Chart.js"></script>
        <script src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>js/dashboard.js"></script>
    <?php } ?>
    <?php if($CONFIG->pageName=="orders_details") { ?>
        <!-- DataTables -->
        <script src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>vendors/datatables/jquery.dataTables.min.js"></script>
        <script src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>vendors/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
        <script src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>vendors/datatables-responsive/js/dataTables.responsive.min.js"></script>
        <script src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>vendors/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
        <script type="text/javascript">
            $("#sip_order_details").dataTable();
            $("#will_order_details").dataTable();
        </script>
    <?php } ?>
    <?php if($CONFIG->pageName=="single_product") { ?>
        <script src="https://www.amcharts.com/lib/4/core.js"></script>
        <script src="https://www.amcharts.com/lib/4/charts.js"></script>
        <script src="https://www.amcharts.com/lib/4/themes/material.js"></script>
        <script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>
        <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
        <script type="text/javascript">
            $("#singleProd_tabs").tabs({
                activate: function(event, ui) {
                    $("#sip_date").val("0").change();
                }
            });
        </script>
    <?php } ?>
    <?php if($CONFIG->pageName=="settings") { ?>
        <script src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>vendors/datatables/jquery.dataTables.min.js"></script>
        <script src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>vendors/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
        <script src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>vendors/datatables-responsive/js/dataTables.responsive.min.js"></script>
        <script src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>vendors/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
        <script src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>js/settings.js"></script>
    <?php } ?>
    <!-- Wizard script -->
    <!-- <script src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>js/empanel/registration_func.js"></script> -->
    <?php if($CONFIG->pageName=="create_will") { ?>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.3/jspdf.min.js"></script>
        <script src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>
        <script src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>vendors/datatables/jquery.dataTables.min.js"></script>
        <script src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>vendors/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
        <script src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>vendors/datatables-responsive/js/dataTables.responsive.min.js"></script>
        <script src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>vendors/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
        <script src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>js/will_validation.js"></script>
        <script src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>js/will_new.js"></script>
        <script src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>js/empanel/common_scripts.min.js"></script>
    <?php } ?>
    <?php  if ($CONFIG->pageName == "blogs") {  ?>
        <script src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>js/mauGallery.min.js"></script>
        <script src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>js/blogs.js"></script>
    <?php } ?>
    <?php  if ($CONFIG->pageName == "ucc_from") {  ?>
        <script src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>js/uccform.js"></script>
    <?php } ?>
    <?php  if ($CONFIG->pageName == "cart_sys" || $CONFIG->pageName == "ucc_from") { 
    if($_GET['err']) { ?>
        <script>$("#errorDisplay").show();$("#errorDisplay").delay(5000).fadeOut("slow");</script>
    <?php } } ?>
    <?php if($CONFIG->pageName=="all_product") { ?>
        <script src="https://rawgit.com/carlo/jquery-base64/master/jquery.base64.min.js"></script>
        <script src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>js/hummingbird-treeview.min.js"></script>
        <script src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>js/allproducts_afterlogin.js"></script>
    <?php } ?>
    <?php if($_GET['offer_id']==21) { ?>
        <script>
            $('.offer_id').removeClass("activeBtn");
            $('.offer_id[data-val="21"]').addClass("activeBtn");
            $("#all_pr_fetch").empty();
            var nav = 0.0;
            $.ajax({
                cache:false,
                url: "<?php echo $CONFIG->siteurl;?>__lib.ajax/ajax_response.php",
                type: 'POST',
                beforeSend: function(){
                    $('.ajax-loader').css("visibility", "visible");
                },
                complete: function(){
                    $('.ajax-loader').css("visibility", "hidden");
                },
                data: { "offer_select": "yes","offer_id": 21},
                success: function(response) {
                    $("#all_pr_fetch").empty();
                    if (response) {
                        const obj = JSON.parse(response);
                        var originalData = JSON.parse(response);
                        var parsedData = {};
                        if(originalData.length == 0) {
                            $("#all_pr_fetch").prepend("<div class='card'><div class='col-sm-12 text-center'><p> No schemes are available</p></div></div>");
                        }
                        for (var i = originalData.length-1; i >= 0; i--) {
                            var tempDisplay = "";
                            var nav1Y = "";
                            $.ajax({
                                cache:false,
                                url: "<?php echo $CONFIG->siteurl;?>__lib.ajax/ajax_response.php",
                                type: 'POST',
                                async:false,
                                data: { "get_nav_per": "yes", "ISIN":originalData[i].isin,"year":"1-3-5" },
                                success: function(res) {
                                    if(res!="") {
                                        nav = JSON.parse(res);
                                        var i=0;
                                        var borderLine = "border-right";
                                        tempDisplay = tempDisplay + "<div class='col-md-5 ml-3'><div class='row'>";
                                        $.each(nav, function (index, data) {
                                            if(index == 1) {
                                                nav1Y = data;
                                            }
                                            if(i>=2) {
                                                borderLine = "";
                                            }
                                            tempDisplay = tempDisplay + "<div class='col-4 "+borderLine+"'><div class='description-block'><h6 class='description-header'>"+data+"%</h6><span class='description-text'>"+index+"Y</span></div></div>";
                                            i++;
                                        });
                                        tempDisplay = tempDisplay + "</div></div>";
                                    }
                                }
                            });
                            $("#all_pr_fetch").prepend("<a class='col-md-12' href='?module_interface=<?php echo $commonFunction->setPage('single_product'); ?>&id="+window.btoa(originalData[i].pk_nav_id)+"&nav="+window.btoa(nav1Y)+"' style='color: #000000; padding-bottom: 5px;'> <div class='card'> " +
                                "<div class='card-body'><div class='row'><div class='col-md-6 ml-4'><h6>"+originalData[i].scheme_name+"</h6><div class='badge btn-primary'>"+ucfirst(originalData[i].scheme_type)+" <i class='fas fa-star' style='font-weight: 510; font-size: 10px;'></i></div></div>"+tempDisplay+"</div></div></div></a>");
                        }
                    }   
                }         
            });
        </script>
    <?php } ?>
    <!-- ------------------------------------ for add more bank in settings----------------------------------------------------- -->
    <script type="text/javascript">
        // auto popup image code
        window.onload = function (){
            $(".bts-popup").delay(1000).addClass('is-visible');
        }
        //open popup
        $('.bts-popup-trigger').on('click', function(event){
            event.preventDefault();
            $('.bts-popup').addClass('is-visible');
        });
        //close popup
        $('.bts-popup').on('click', function(event){
            if( $(event.target).is('.bts-popup-close') || $(event.target).is('.bts-popup') ) {
                event.preventDefault();
                $(this).removeClass('is-visible');
            }
        });
        //close popup when clicking the esc keyboard button
        $(document).keyup(function(event) {
            if (event.which == '27') {
                $('.bts-popup').removeClass('is-visible');
            }
        });
        $("#add_more_bank").click(function(){
            $("#ex_bank").prepend('<div class="row align-items-center mt-4"> <div class="col"> <label>BANK NAME</label> <input type="text" class="form-control" placeholder="Bank Name"> </div><div class="col"> <label>BANK ACCOUNT NUMBER</label> <input type="text" class="form-control" placeholder="Bank Account Number"> </div></div><div class="row align-items-center mt-4"> <div class="col"> <label>BRANCH</label> <input type="text" class="form-control" placeholder="Branch"> </div><div class="col"> <label>IFSC CODE</label> <input type="text" class="form-control" placeholder="IFSC Code"> </div></div>');
        });
        /* -- fetch all schemes -- */
        $(document).ready(function() {
            $("html,body").animate({scrollTop: 0}, 100)
            /*---------------- Helpdesk section ----------------*/
            $("#c_acnt").hide();
            $("#f_travel").hide();
            $("#e_bill").hide();
            /*---------------- Helpdesk section ----------------*/
            //$('#sip_details').DataTable();
            /*--------------- Transaction History ---------------*/
            var nav = 0.0;
            
            /*------------------------------------------------------------- Fetch graph data for Single page ----------------------------------------------------------------*/
            var sch_code = $("#sch_code").val();
            if( $('#sch_code').val() == '0' || $('#sch_code').val() == '' || $('#sch_code').val() == 'undefined' || $('#sch_code').val() == null ) {
                //alert(sch_code); 
            } else {
                var nav_val = "";
                var price_date = "HI";
                var net_asset_value = "";
                $.ajax({
                    cache:false,
                    url: "<?php echo $CONFIG->siteurl;?>__lib.ajax/ajax_response.php",
                    type: 'POST',
                    beforeSend: function(){
                        $('.ajax-loader').css("visibility", "visible");
                    },
                    complete: function(){
                        $('.ajax-loader').css("visibility", "hidden");
                    },
                    data: { "get_nav": "yes", "sch_code": sch_code},
                    success: function(response) {
                        if(response) {
                            nav_val = response;
                            nav_val = JSON.parse(response);
                            am4core.ready(function() {
                                // Themes begin
                                am4core.useTheme(am4themes_material);
                                am4core.useTheme(am4themes_animated);
                                // Themes end
                                var chart = am4core.create("chartdiv", am4charts.XYChart);
                                chart.data = nav_val;
                                // Create axes
                                var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
                                dateAxis.renderer.minGridDistance = 60;
                                var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
                                // Create series
                                var series = chart.series.push(new am4charts.LineSeries());
                                series.dataFields.valueY = "net_asset_value";
                                series.dataFields.dateX = "price_date";
                                series.tooltipText = "NAV: {net_asset_value}, DATE: {price_date}"
                                //series.tooltip.pointerOrientation = "vertical";
                                chart.cursor = new am4charts.XYCursor();
                                chart.cursor.snapToSeries = series;
                                chart.cursor.xAxis = dateAxis;
                                // chart.scrollbarY = new am4core.Scrollbar();
                                chart.scrollbarX = new am4core.Scrollbar();
                            });
                        }
                    }
                });
            }
        });
        /* -- ------------------------------------------ Helpdesk section ------------------------------------------------- --*/
        $(".c_acnt_c").click(function() {
            if ($("#c_acnt_y").prop("checked")) {
                $("#c_acnt").show();
            } else if ($("#c_acnt_n").prop("checked")) {
                $("#c_acnt").hide();
            }
        });
        $(".f_travel_c").click(function() {
            if ($("#f_travel_y").prop("checked")) {
                $("#f_travel").show();
            } else if ($("#f_travel_n").prop("checked")) {
                $("#f_travel").hide();
            }
        });
        $(".e_bill_c").click(function() {
            if ($("#e_bill_y").prop("checked")) {
                $("#e_bill").show();
            } else if ($("#e_bill_n").prop("checked")) {
                $("#e_bill").hide();
            }
        });
        /*-- ------------------------- SIP date validation in single page of wealth -------------------------------  -*/
        $("#sip").click(function() {
            var val = $("#sip_date").val();
            if (parseInt(val) == 0) {
                event.preventDefault();
                alert("Please choose the date for SIP");
                $('#sip_date').focus();
            }
        });
        /* -- ----------------------------------Delete value sending in cart page -------------------------------------- */
        $(".dlt_sch").click(function(){
            var val = $(this).val();
            //var cart_id = $("input[name=cart_id]").val();
            $("#cart_id").val(val);
            //alert(val);
        });
        /* -- ---------------------------------------- ADD AMOUNT IN CART PAGE ---------------------------------- --*/
        $(".edit_rupess").keyup(function(){
            var update_val = $(this).val();
            var sum = 0;
            $('.edit_rupess').each(function(){
                sum += parseFloat($(this).val());  // Or this.innerHTML, this.innerText
            });
            $("#total_amt").text("₹"+sum);
        });
        /* --------------------------------- Check terms and condition validation-------------------------------- -- */
        $("#term-conditionCheck").change(function(){
            if($(this).prop("checked") == true) {
                $("#pay_bt").prop('disabled', false);
            } else if($(this).prop("checked") == false) {
                $("#pay_bt").prop('disabled', true);
            }
        });
        /*-- ------------------------------------- SIP date validation in single page ---------------------------------------- --*/
        $(".rmv_sip").click(function(){
            $("#sip_date").remove("required");
        });
        $(".add_sip").click(function(){
            $("#sip_date").append("required");
        });
        $("#sip_date").change(function(){
            var val = $(this).val();
            if(val== "1" || val== "21") { 
                $("#dt_typ").text("st");
            } else if(val == "2" || val == "22") { 
                $("#dt_typ").text("nd");
            } else if(val == "3" || val == "23") {
                $("#dt_typ").text("rd");
            } else {
                $("#dt_typ").text("th");
            }
        });
        /*-- ----------------------------------------------- Reset All in ALL product ----------------------------------------- --*/
        $("#clear_all").click(function(){
            //$('input:checkbox').removeAttr('checked');
            $('input[type=checkbox]').prop('checked',false);
        });
        $("#multi3").click(function(){
            var val = $(this).val();
            $("#inv_amt").text(val);
        });
        /* -- ----------------------------------------------- Search AMC ---------------------------------------------------------- --*/
        $("#srch_amc").keyup(function(){
            event.preventDefault();
            var val = $(this).val();
            if(val!="") {
                $("#all_amc").empty();
                if (val != "") {
                    $.ajax({
                        cache:false,
                        url: "<?php echo $CONFIG->siteurl;?>__lib.ajax/ajax_response.php",
                        type: 'POST',
                        data: { "amc_search": "yes", "amc_val": val},
                        success: function(response) {
                            if(response) {
                                var listamc = JSON.parse(response);
                                var parsedData = {};
                                for (var i = 0, l = listamc.length; i < l; i++) {
                                    var amc_n = listamc[i].amc_name_act;
                                    var amc_id = listamc[i].mf_schema_id;
                                    var amc_n = amc_n.replace(/[0-9`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi, " ");
                                    $("#all_amc").prepend("<label class='form-check'> <input class='form-check-input amc_code' type='checkbox' name='amc_code' value='"+listamc[i].mf_schema_id+"'> <span class='form-check-label' style='font-size: 15px; font-weight: 100;'>"+amc_n+"</span> </label>");
                                }
                            } else {
                                //$('#all_pr_fetch').find('div').remove();   
                            }
                        }            
                    });
                }  
            }
        });
        /* -- ----------------------------------- In single Page clickebale amount ------------------------------------------------------------- */
        $(".w_amnt").click(function(){
            var val = $(this).val();
            var f_val = $(".f_amount").val();
            if (f_val == "") {
                f_val = 0;
            }
            f_val = parseInt(f_val) + parseInt(val);
            $(".f_amount").val(f_val);
        });
    </script>
    <!-- ----------------------------------------------------------------------------- -->
    </body>
    </html>
<?php } else { ?>
    <!--<script src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>js/app.js"></script>-->
    <script src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>js/customizer.min.js"></script>
    <script src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>js/main.js"></script>
    <script src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>js/main1.js"></script>
    <script src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>js/blogs.js"></script>
    <?php  if ($CONFIG->pageName == "calculators") {  ?>
        <script src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>js/MyWealth.js"></script>
        <script src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>js/blogs.js"></script>
    <?php } ?>
    <?php  if ($CONFIG->pageName == "blogs" || $CONFIG->pageName == "home" || $CONFIG->pageName == "") {  ?>
        <script src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>js/mauGallery.min.js"></script>
        <script src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>js/blogs.js"></script>
    <?php } ?>
    <?php if($CONFIG->pageName=="all_product") { ?>
        <script src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>js/hummingbird-treeview.min.js"></script>
        <script src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>js/allproducts.js"></script>
    <?php } ?>
    <?php if($CONFIG->pageName=="single_product") { ?>
        <script src="https://www.amcharts.com/lib/4/core.js"></script>
        <script src="https://www.amcharts.com/lib/4/charts.js"></script>
        <script src="https://www.amcharts.com/lib/4/themes/material.js"></script>
        <script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>
        <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
        <script type="text/javascript">
            $("#singleProd_tabs").tabs({
                activate: function(event, ui) {
                    $("#sip_date").val("0").change();
                }
            });
            
            $(".hide_sip_dt").hide();
            /*------------------------------------------------------------- Fetch grpah data for Single page ----------------------------------------------------------------*/
            var sch_code = $("#sch_code").val();
            if( $('#sch_code').val() == '0' || $('#sch_code').val() == '' || $('#sch_code').val() == 'undefined' || $('#sch_code').val() == null ) {
                alert(sch_code);
            } else {
                var nav_val = "";
                var price_date = "HI";
                var net_asset_value = "";
                $.ajax({
                    cache:false,
                    url: "<?php echo $CONFIG->siteurl;?>__lib.ajax/ajax_response.php",
                    type: 'POST',
                    //contentType: "application/json; charset=utf-8",
                    //dataType: "json",
                    beforeSend: function(){
                        $('.ajax-loader').css("visibility", "visible");
                    },
                    complete: function(){
                        $('.ajax-loader').css("visibility", "hidden");
                    },
                    data: { "get_nav": "yes", "sch_code": sch_code},
                    success: function(response) {
                        if(response) {
                            nav_val = response;
                            nav_val = JSON.parse(response);
                            am4core.ready(function() {
                                // Themes begin
                                am4core.useTheme(am4themes_material);
                                am4core.useTheme(am4themes_animated);
                                // Themes end
                                var chart = am4core.create("chartdiv", am4charts.XYChart);
                                chart.data = nav_val;
                                // Create axes
                                var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
                                dateAxis.renderer.minGridDistance = 60;
                                var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
                                // Create series
                                var series = chart.series.push(new am4charts.LineSeries());
                                series.dataFields.valueY = "net_asset_value";
                                series.dataFields.dateX = "price_date";
                                series.tooltipText = "NAV: {net_asset_value}, DATE: {price_date}"
                                //series.tooltip.pointerOrientation = "vertical";
                                chart.cursor = new am4charts.XYCursor();
                                chart.cursor.snapToSeries = series;
                                chart.cursor.xAxis = dateAxis;
                                //chart.scrollbarY = new am4core.Scrollbar();
                                chart.scrollbarX = new am4core.Scrollbar();
                            });
                        }
                    }            
                }); 
            /*------------------------------------------------------------- Graph value --------------------------------------------------------------------------------*/
            }
        </script>
    <?php } ?>
    <?php if ($CONFIG->pageName == "external_reg") { ?>
        <script src="<?php echo $CONFIG->staticURL; ?><?php echo $CONFIG->theme_new; ?>js/empanel/common_scripts.min.js"></script>
        <script src="<?php echo $CONFIG->staticURL; ?><?php echo $CONFIG->theme_new; ?>js/empanel/velocity.min.js"></script>
        <script src="<?php echo $CONFIG->staticURL; ?><?php echo $CONFIG->theme_new; ?>js/empanel/functions.js"></script>
        <script src="<?php echo $CONFIG->staticURL; ?><?php echo $CONFIG->theme_new; ?>js/empanel/pw_strenght.js"></script>-->
        <!-- Wizard script -->
        <script src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>js/empanel/registration_func.js"></script>
    <?php } ?>
    <!-- main js  -->
    <!-- <script src="https://www.google.com/recaptcha/api.js" async defer></script>-->
    <script type="text/javascript">
        $("#multi3").click(function(){
            var val = $(this).val();
            //alert(val);
            $("#inv_amt").text(val);
        });
        $("#edu").change(function(){
            var val = $(this).val();
            if (val == "other") {
                //alert(val);
                $("#other_q").css("display", "block");
            } else {
                $("#other_q").css("display", "none");
            }
        });  
        function looksLikeMail(str) {
            var lastAtPos = str.lastIndexOf('@');
            var lastDotPos = str.lastIndexOf('.');
            return (lastAtPos < lastDotPos && lastAtPos > 0 && str.indexOf('@@') == -1 && lastDotPos > 2 && (str.length - lastDotPos) > 2);
        }
        /*----------------------------------------------- Forget Password ---------------------------------------------------------*/
        function doResetPasswordJS(form) {       
            $("#reset_invalid_email").html('');     
            $("#reset_loader").css("display", "block"); 
            $("#reset_invalid_email").css("display", "none");
            $.ajax({
                url: form.action,
                type: form.method,
                data: $(form).serialize(),
                success: function(response) {
                    response = response.trim();
                    if(response.indexOf('RESET_DONE')==0|| response.indexOf('RESET_DONE')>0)
                    {           
                        $("#reset_email").val('');      
                        $("#reset_sec_code").val('');   
                        $("#resetverifyCaptcha").attr('src', "captcha/securimage_show.php?"+$.now());
                        $("#reset_loader").css("display", "none");
                        $("#reset_invalid_email").html('Please check your mail, to change password.');
                        $("#reset_invalid_email").css("display", "block");
                    }
                    else if(response.indexOf('WRONG_PASSCODE')==0 || response.indexOf('WRONG_PASSCODE')>0)
                    {
                        $("#resetverifyCaptcha").attr('src', "captcha/securimage_show.php?"+$.now());
                        $("#reset_loader").css("display", "none");
                        $("#reset_invalid_email").html('Wrong security code.');
                        $("#reset_invalid_email").css("display", "block");
                        $("#reset_sec_code").focus();
                    } else {
                        $("#resetverifyCaptcha").attr('src', "captcha/securimage_show.php?" + $.now());
                        $("#reset_loader").css("display", "none");
                        $("#reset_invalid_email").html('Email Not Found.');
                        $("#reset_invalid_email").css("display", "block");
                        $("#reset_email").focus();
                    }
                }
            });
            return false;
        }
        /*---------------------------------------------------------- Contact Us -----------------------------------------------------------------*/
        function contactusJS(form) {
            var letters = /^[A-Za-z]+$/;
            var EmailAddress = /^([\.a-zA-Z0-9_\-])+@([a-zA-Z0-9_\-])+(([a-zA-Z0-9_\-])*\.([a-zA-Z0-9_\-])+)+$/;
            var Num = /^[1-9]{1}[0-9]*$/;
            $("#contactresponse").html('');
            $("#contactresponse").css("display", "none");
            //alert("hi");
            if(!(looksLikeMail($("#formemail").val()))) {
                //alert("test");
                $("#contactresponse").html('Please enter valid email address.');
                $("#contactresponse").css("display", "block");
                return false;
            }
            var recaptcha = $("#g-recaptcha-response").val();
            if (recaptcha == "") {
                event.preventDefault();
                alert("Please check the recaptcha");
                return false;
            }
            $.ajax({
                cache:false,
                url: form.action,
                type: form.method,
                data: $(form).serialize(),
                success: function(response) {
                    //alert(response);
                    var res = $.trim(response);
                    //alert(res);
                    if (res.indexOf('CONTACT_SENT') == 0 || res.indexOf('CONTACT_SENT') > 0)

                    {

                        $("#contactresponse").html("Thank you for contacting us. We will get back to you at the earliest, usually within 24 hours. If it is urgent, please reach us on the phone numbers provided.");
                        $("#contactresponse").css("display", "block");

                        $("#formemail").val("");
                        $("#formname").val("");
                        $("#formnumber").val("");
                        $("#formmessage").val("");
                    }
                }
            });
            return false;
        }

        function signupJSnew(form) {
            //var re = "[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?";
            if (!(looksLikeMail($("#email").val()))) {
                $("#signup_invalid_email").html('Please enter valid email address.');
                $("#signup_invalid_email").css("display", "block");
                return false;
            }
            if (!(/^[0-9\-]+$/.test($("#mobile").val()))) {
                $("#signup_invalid_email").html('Please enter valid mobile no.');
                $("#signup_invalid_email").css("display", "block");
                return false;
            }
            if ($("#mobile").val().length != 10) {
                $("#signup_invalid_email").html('Please enter valid mobile no.');
                $("#signup_invalid_email").css("display", "block");
                return false;
            }
            $("#signup_invalid_email").html('');
            $("#signup_loader").css("display", "block");
            $("#signup_invalid_email").css("display", "none");
            $.ajax({
                cache:false,
                url: form.action,
                type: form.method,
                data: $(form).serialize(),
                success: function(response) {
                    if (response.indexOf("REGISTER_DONE") >= 0) {
                        location.href = '<?php echo $CONFIG->siteurl; ?>mySaveTax/';
                    }
                }
            });
            return false;
        }
        function ecaJS(form) {       
            if(!(looksLikeMail($("#formemail").val()))) {
                alert("Please enter proper email id");
                return false;
            }
            $.ajax({
                cache:false,
                url: form.action,
                type: form.method,
                data: $(form).serialize(),
                success: function(response) {
                    var res = $.trim(response);
                    if(res.indexOf('CONTACT_SENT')==0 || res.indexOf('CONTACT_SENT')>0) {
                        $("#eca_name1").val("");
                        $("#formemail").val("");
                        $("#eca_mob1").val("");
                        alert("Thank you for contacting us.We will contact with you shortly.");
                    }
                }
            });
            return false;
        }
        function loginJS(form) {
            // https://sbox.optymoney.com/mySaveTax/?module_interface=Y2FydF9zeXM=
            var pathname = $(location).attr('pathname');
            sessionStorage.setItem("pagename", pathname.substring(1, pathname.length));
            $("#login_loader").css("display", "block");
            $("#login_invalid_email").css("display", "none");
            $.ajax({
                url: form.action,
                type: form.method,
                data: $(form).serialize(),
                success: function(response) {
                    if (response.indexOf('PASS') == 0 || response.indexOf('PASS') > 0) {
                        if (sessionStorage.getItem("pagename") == "single_product.html") {
                            location.href = '<?php echo $CONFIG->siteurl; ?>/single_product.html';
                        } else {
                            location.href = '<?php echo $CONFIG->siteurl; ?>';
                        }
                    } else {
                        alert("Login failed. Please ensure username and password are correct.");
                        $("#login_loader").css("display", "none");
                        $("#login_invalid_email").css("display", "block");
                        $("#email").focus();
                    }
                }
            });
            return false;
        }
        /*-- ---------------------------------------------------------- Sign-up ----------------------------------------------------------------- --*/
        function signupJSnew(form) {
            //var re = "[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?";
            if (!(looksLikeMail($("#email").val()))) {
                $("#signup_invalid_email").html('Please enter valid email address.');
                $("#signup_invalid_email").css("display", "block");
                return false;
            }
            if (!(/^[0-9\-]+$/.test($("#mobile").val()))) {
                $("#signup_invalid_email").html('Please enter valid mobile no.');
                $("#signup_invalid_email").css("display", "block");
                return false;
            }
            if ($("#mobile").val().length != 10) {
                $("#signup_invalid_email").html('Please enter valid mobile no.');
                $("#signup_invalid_email").css("display", "block");
                return false;
            }
            if ($("#reg_passwd").val().length < 6) {
                $("#signup_invalid_email").html('Password must be 6 character long.');
                $("#signup_invalid_email").css("display", "block");
                return false;
            }
            if ($("#reg_passwd").val() != $("#repasswd").val()) {
                $("#signup_invalid_email").html('Password Mismatch.');
                $("#signup_invalid_email").css("display", "block");
                return false;
            }
            if($("#otp").val().length != 5) {
                $("#signup_invalid_email").html('Please enter OTP.');
                $("#signup_invalid_email").css("display", "block");
                return false;
            }
            $("#signup_invalid_email").html('');
            $("#signup_loader").css("display", "block");
            $("#signup_invalid_email").css("display", "none");
            //alert("inside js");
            $.ajax({
                cache: false,
                url: form.action,
                type: form.method,
                data: $(form).serialize(),
                success: function(response) {
                    if (response.indexOf("WRONG_PASSCODE") >= 0) {
                        $("#verifyCaptcha").attr('src', "captcha/securimage_show.php?" + $.now());
                        $("#signup_loader").css("display", "none");
                        $("#signup_invalid_email").html('Invalid security code.');
                        $("#signup_invalid_email").css("display", "block");
                        $("#email").focus();
                    } else if (response.indexOf("WRONG_OTP") >= 0) {
                        $("#signup_invalid_email").html('Invalid OTP.');
                        $("#signup_invalid_email").css("display", "block");
                        $("#otp").focus();
                    } else if (response.indexOf("REGISTER_DONE") >= 0) {
                        location.href = '<?php echo $CONFIG->siteurl; ?>mySaveTax/';
                    } else {
                        $("#verifyCaptcha").attr('src', "captcha/securimage_show.php?" + $.now());
                        $("#signup_loader").css("display", "none");
                        $("#signup_invalid_email").html('Email Already Exists.');
                        $("#signup_invalid_email").css("display", "block");
                        $("#email").focus();
                        //html('Email Already Exists.');
                    }
                }
            });
            return false;
        }
        /*---------------------------------------------------------- SEND OTP -----------------------------------------------------------------*/
        function sendOTPJS(form) {
            $("#signup_invalid_mob").css("display", "none");
            //alert("test");
            if (!(looksLikeMail($("#email").val()))) {
                $("#signup_invalid_mob").html('Please enter valid email address.');
                $("#signup_invalid_mob").css("display", "block");
                return false;
            }
            if ((!(/^[0-9\-]+$/.test($("#mobile").val()))) || ($("#mobile").val().length != 10)) {
                $("#signup_invalid_mob").html('Please enter valid mobile no.');
                $("#signup_invalid_mob").css("display", "block");
                return false;
            }
            $mobileno = $("#mobile").val();
            $("#signup_invalid_mob").html('OTP is being sent... please wait...');
            $("#signup_invalid_mob").css("display", "block");
            var mobileno = $("#mobile").val();
            var email = $("#email").val();
            $.ajax({
                url: 'ajax-request/ajax_response.php?action=doSendOTP',
                type: 'POST',
                data: 'mobile=' + mobileno + '&email=' + email,
                success: function(response) {
                    //alert(response);
                    if (response.includes('OTP_SENT')) {
                        $("#signup_invalid_mob").html('OTP is sent.');
                        $("#signup_invalid_mob").css("display", "block");
                    } else if (response.includes('EMAIL_EXISTS')) {
                        $("#signup_invalid_mob").html('The email already exists.');
                        $("#signup_invalid_mob").css("display", "block");
                    } else {
                        $("#signup_invalid_mob").html(response);
                        $("#signup_invalid_mob").css("display", "block");
                    }
                }
            });
            return false;
        }
        /*-- ----------------------------------------------- For chat API -------------------------------------------------------- --*/
        /*--Start of Tawk.to Script--*/
        // var Tawk_API = Tawk_API || {},
        //     Tawk_LoadStart = new Date();
        // (function() {
        //     var s1 = document.createElement("script"),
        //         s0 = document.getElementsByTagName("script")[0];
        //     s1.async = true;
        //     s1.src = 'https://embed.tawk.to/5ed75b7d9e5f6944228fc6bd/default';
        //     s1.charset = 'UTF-8';
        //     s1.setAttribute('crossorigin', '*');
        //     s0.parentNode.insertBefore(s1, s0);
        // })();
        /*--End of Tawk.to Script--*/
        /*-- ----------------------------------------------- Contact Us & Subscribe Form ---------------------------------------------------------- --*/
        function looksLikeMail(str) {
            var lastAtPos = str.lastIndexOf('@');
            var lastDotPos = str.lastIndexOf('.');
            return (lastAtPos < lastDotPos && lastAtPos > 0 && str.indexOf('@@') == -1 && lastDotPos > 2 && (str.length - lastDotPos) > 2);
        }
        function contactusJSHome(form) {
            event.preventDefault();
            var temp = 0;
            if (temp == 0) {
                var letters = /^[A-Za-z '.-]+$/;
                var val = $("#formname").val();
                if (val != "") {
                    if (!val.match(letters)) {
                        $("#formname_error").text("Name must contain only letters, space");
                        temp = 1;
                    } else {
                        temp = 0;
                        $("#formname_error").text("");
                    }
                } else {
                    $("#formname_error").text("Name is required");
                    temp = 1;
                }
            }
            if (temp == 0) {
                var letters = /^([\.a-zA-Z0-9_\-])+@([a-zA-Z0-9_\-])+(([a-zA-Z0-9_\-])*\.([a-zA-Z0-9_\-])+)+$/;
                var val = $("#formemail").val();
                if (val != "") {
                    if (!val.match(letters)) {
                        $("#formemail_error").text("Email Address not valid");
                        temp = 1;
                    } else {
                        temp = 0;
                        $("#formemail_error").text("");
                    }
                } else {
                    $("#formemail_error").text("Email is required");
                    temp = 1;
                }
            }
            if (temp == 0) {
                var letters = /^(?:(?:\+|0{0,2})91(\s*[\-]\s*)?|[0]?)?[6789]\d{9}$/;
                var val = $("#formnumber").val();
                if (val != "") {
                    if (!val.match(letters)) {
                        $("#formnumber_error").text("Enter Valid Phone Number");
                        temp = 1;
                    } else {
                        temp = 0;
                        $("#formnumber_error").text("");
                    }
                } else {
                    $("#formnumber_error").text("Phone number is required");
                    temp = 1;
                }
            }
            if (temp == 0) {
                $.ajax({
                    cache:false,
                    url: form.action,
                    type: form.method,
                    data: $(form).serialize(),
                    success: function(response) {
                    //alert("success");
                        if(response.indexOf("CONTACT_SENT")>=0) {
                            // $("#contactresponsehome").html("Thank you for contacting us. We will get back to you at the earliest, usually within 24 hours. If it is urgent, please reach us on the phone numbers provided.");
                            // $("#contactresponsehome").css("display", "block");
                            $("#formemail").val("");
                            $("#formnumber").val("");
                            $("#formname").val("");
                            $("#formmessage").val("");
                            alert("Thanks for subcribe");
                        }
                    }
                });
                return false;
            } else {
                //alert("Thanks for subcribe");
            }
        }
        /* -------------------------------------------- Forget password  ------------------------------------------------------- */
        var url_string = window.location.href;
        var url = new URL(url_string);
        var email = url.searchParams.get("a");
        var seccode = url.searchParams.get("forget_password");
        //        alert(email + seccode);
        $("#resetemail").val(email);
        $("#resetcode").val(seccode);

        function looksLikeMail(str) {
            var lastAtPos = str.lastIndexOf('@');
            var lastDotPos = str.lastIndexOf('.');
            return (lastAtPos < lastDotPos && lastAtPos > 0 && str.indexOf('@@') == -1 && lastDotPos > 2 && (str.length - lastDotPos) > 2);
        }
        function resetpasswordJS(form) {       
            if(!(looksLikeMail($("#resetemail").val()))) {
                $("#resetfailed").html('Please enter valid email address.');
                $("#resetfailed").css("display", "block");
                return false;
            }
            if ($("#resetcode").val() == "") {
                $("#resetfailed").html('Please reset the password from forgot password in login.');
                $("#resetfailed").css("display", "block");
                return false;
            }
            if($("#reset_passwd").val().length < 6) {
                $("#resetfailed").html('Password must be 6 character long.');
                $("#resetfailed").css("display", "block");
                return false;
            }
            if ($("#reset_passwd").val() != $("#resrepasswd").val()) {
                $("#resetfailed").html('Password Mismatch.');
                $("#resetfailed").css("display", "block");
                return false;
            }
            $("#resetfailed").html('');
            $("#signup_loader").css("display", "block");
            $("#resetfailed").css("display", "none");
            $.ajax({
                cache: false,
                url: form.action,
                type: form.method,
                data: $(form).serialize(),
                success: function(response) {
                    if (response.indexOf("CODE_MISMATCH") >= 0) {
                        $("#signup_loader").css("display", "none");
                        $("#resetfailed").html('Please reset the password from forgot password in login.');
                        $("#resetfailed").css("display", "block");
                        $("#email").focus();
                    } else if (response.indexOf("PASSWORD_CHANGED") >= 0) {
                        alert("Password is reset. Please login with the new password.");
                        location.href='<?php echo $CONFIG->siteurl;?>login.html';               
                    }
                }
            });
            return false;
        }
        /* Reset option in invesment */
        $("#clear_all_filter").click(function(){
            alert("Hi");
        });
        /* ----------------------------------------------- Fetch category ------------------------------------------------------ */
        
        /* ----------------------------------------------- Search AMC ---------------------------------------------------------- */
        $("#srch_amc").keyup(function(){
            event.preventDefault();
            var val = $(this).val();
            $("#all_amc").empty();
            if (val != "") {
                $.ajax({
                    cache:false,
                    url: "<?php echo $CONFIG->siteurl;?>__lib.ajax/ajax_response.php",
                    type: 'POST',
                    data: { "amc_search": "yes", "amc_val": val},
                    beforeSend: function(){
                        $('.ajax-loader').css("visibility", "visible");
                    },
                    complete: function(){
                        $('.ajax-loader').css("visibility", "hidden");
                    },
                    success: function(response) {
                        if(response) {
                            // const obj = JSON.parse(response);
                            // //var  count = response.length;
                            //$('#all_amc').find('label').remove();   
                            var listamc = JSON.parse(response);
                            var parsedData = {};
                            for (var i = 0, l = listamc.length; i < l; i++) {
                                //parsedData[listamc[i].pk_recomend_id] = listamc[i].scheme_name;
                                var amc_n = listamc[i].amc_name_act;
                                var amc_id = listamc[i].mf_schema_id;
                                var amc_n = amc_n.replace(/[0-9`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi, " ");
                                $("#all_amc").prepend("<label class='form-check'> <input class='form-check-input amc_code' type='checkbox' name='amc_code' value='"+listamc[i].mf_schema_id+"'> <span class='form-check-label' style='font-size: 15px; font-weight: 100;'>"+amc_n+"</span> </label>");
                                //$(":checkbox[value="+listamc[i].mf_schema_id+"]").prop("checked","true");
                            }
                        } else {
                            //$('#all_pr_fetch').find('div').remove();   
                        }
                    }
                });
            }
        });
        /* ----------------------------------- In single Page clickebale amount ------------------------------------------------------------- */
        $(".w_amnt").click(function(){
            var val = $(this).val();
            var f_val = $(".f_amount").val();
            if (f_val == "") {
                f_val = 0;
            }
            f_val = parseInt(f_val) + parseInt(val);
            $(".f_amount").val(f_val);
        });
        /* ------------------------- SIP date validation in single page of wealth -------------------------------  */
        /*$("#sip").click(function(){
            var val =$("#sip_date").val();
            if (parseInt(val) == 0) {
                event.preventDefault();
                alert("Please choose the date for SIP");
                $('#sip_date').focus();
            }   
        });*/
    </script>
<!-- ----------------------------------------------------------------------------- -->
<script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Organization",
        "name": "optymoney",
        "url": "https://optymoney.com/",
        "logo": "https://optymoney.com/static/th_4/assets/images/logo.png",
        "contactPoint": {
            "@type": "ContactPoint",
            "telephone": "+91 080 42061247",
            "contactType": "customer service",
            "areaServed": "IN",
            "availableLanguage": "en"
        }
    }
</script>
<script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Organization",
        "name": "optymoney",
        "image": "https://optymoney.com/static/th_4/assets/images/logo.png",
        "@id": "",
        "url": "https://optymoney.com/",
        "sameAs" :["https://www.facebook.com/optymoney",
        "https://www.instagram.com/optymoneydotcom",
        "https://www.youtube.com/optymoney",
        "https://www.linkedin.com/company/optymoney",
        "https://twitter.com/optymoney"]
        "telephone": "+91 080 42061247",
        "address": {
            "@type": "PostalAddress",
            "streetAddress": "85/1, CBI Road, Opp: Bank of Baroda, Lakshmayya Layout, Vishveshvaraiah Nagar, Ganganagar,",
            "addressLocality": "Bengaluru",
            "postalCode": "560024",
            "addressCountry": "IN"
        } 
   }
</script>
</footer>
<?php } /* prelogin end */ ?>
<?php
    if($_POST['response_code'] === 0) {
        echo "<script>alert('responsecode".$_POST['response_code']."');$('#oldnewCal').modal('show'); oldNewRegime();</script>";
    }
?>
<script type="text/javascript">
    
    function allLetter(inputtxt,chk) { 
        var letters       = /^[A-Za-z]+$/;
        var PAN           = /^[A-Za-z]{3}[pP]{1}[A-Za-z]{1}[0-9]{4}[A-Za-z]{1}$/; 
        var AadhaarCardNo = /^[0-9]{12}$/;
        var EmailAddress = /^([\.a-zA-Z0-9_\-])+@([a-zA-Z0-9_\-])+(([a-zA-Z0-9_\-])*\.([a-zA-Z0-9_\-])+)+$/;
        var Num = /^[1-9]{1}[0-9]*$/;
        if (inputtxt.value.match(chk)) {
            alert('Your name have accepted : you can try another');
            return true;
        } else {
            alert('Please input alphabet characters only');
            return false;
        }
    }
    /* Login Popup from File ITR Now Button */
    function fileITRNow_Submit(data) {
        $('#file_itr_popup').modal('hide');
        $('#login_form').modal('show');
    }
    /* ***************************************************** Validation Start *************************************************************** */
    // Diwali POpup poster
    $(document).ready(function() {
        var id = '#dialog';
        //Get the screen height and width
        var maskHeight = $(document).height();
        var maskWidth = $(window).width();

        //Set heigth and width to mask to fill up the whole screen
        $('#mask').css({'width':maskWidth,'height':maskHeight});

        //transition effect   
        $('#mask').fadeIn(500); 
        $('#mask').fadeTo("slow",0.9);  

        //Get the window height and width
        var winH = $(window).height();
        var winW = $(window).width();
        
        //Set the popup window to center
        $(id).css('top',  winH/2-$(id).height()/2);
        $(id).css('left', winW/2-$(id).width()/2);

        //transition effect
        $(id).fadeIn(2000);

        //if close button is clicked
        $('.window .close').click(function(e) {
            //Cancel the link behavior
            e.preventDefault();

            $('#mask').hide();
            $('.window').hide();
        });

        //if mask is clicked
        $('#mask').click(function () {
            $(this).hide();
            $('.window').hide();
        });
    });
    /* ***************************************************** Validation End **************************************************************** */
    function prelogin_cart(form) {
        //e,preventDefault();
        $.ajax({
            url: form.action,
            type: form.method,
            data: $(form).serialize(),
            success: function(response) {
                if(response.indexOf('PASS')==0 || response.indexOf('PASS')>0) {
                    $('#login_form').modal('show');
                } else {

                }
            }
        });
        return false;
    }
    // $('[data-toggle="popover"]').popover({
    //     placement : 'bottom',
    //     trigger : 'click',
    //     html : true,
    // });
    $("#selectallsch").click(function(){
        if($(this).prop('checked') == true) {
            //alert("selectall"); 
            $(".check_schm").attr('checked', true);
        } else {
            //alert("unselectall");       
            $(".check_schm").attr('checked', false);
        }
    });
    $(".invest_type").change(function(){
        var val = $(this).val();
        alert(val);
        if(val == 1) {
            $(".hide_sip_dt").hide();
        } else {
            $(".hide_sip_dt").show();
        }
    });
    //openneededaccordion();
    function doalert(obj) {
        //alert(obj.getAttribute("href"));
        openneededaccordionforthis(obj.getAttribute("href"));
        return false;
    }
    function openneededaccordionforthis(urlstring) {
        //alert(val);
        if(urlstring.indexOf("#")>=0) {
            //var val = window.location.href;
            urlstring=urlstring.substring(urlstring.indexOf("#")+1);
            urlstring = urlstring + 'contentsblock';
            //alert(urlstring);
            var x = document.getElementById(urlstring);
            x.style.display = "block";
        }
    }
    function openneededaccordion() {
        var urlstring = window.location.href;
        //alert(val);
        if(urlstring.indexOf("#")>=0) {
            //var val = window.location.href;
            urlstring=urlstring.substring(urlstring.indexOf("#")+1);
            urlstring = urlstring + 'contentsblock';
            //alert(urlstring);
            var x = document.getElementById(urlstring);
            x.style.display = "block";
        }
    }
    var acc = document.getElementsByClassName("accordion");
    var i;
    for (i = 0; i < acc.length; i++) {
        acc[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var panel = this.nextElementSibling;
            if (panel.style.display === "block") {
                panel.style.display = "none";
            } else {
                panel.style.display = "block";
            }
        });
    }
    window.onscroll = function() {
        //scrollFunction();
    };
    function scrollFunction() {
        if (document.body.scrollTop > 400 || document.documentElement.scrollTop > 400) {
            document.getElementById("myBtn").style.display = "block";
        } else {
            document.getElementById("myBtn").style.display = "none";
        }
    }
    // When the user clicks on the button, scroll to the top of the document
    function topFunction() {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    }
    $('#myCarousel').carousel({
        interval: 5000
    });
    $('input[id="taxCheck"]').click(function(){
        if($(this).prop("checked") == true){
            $('#taxsub').show();
        }
        else if($(this).prop("checked") == false){
            $('#taxsub').hide();
        }
    });
    $('input[type=radio][name=itr_e]').change(function() {
        if (this.value == "itr") {
            $('#itrfilling').show();
            $('#eassest').hide();
        } else if (this.value == "eassess") {
            $('#eassest').show();
            $('#itrfilling').hide();
        }
    });
    $('#multi3').css("height","");
    $('#multi3').css("overflow","");
    $('#multi3').css("opacity",1);
    $('#multi3').css("width","");
    $('#multi3').css("position","relative");
    $('#subscriptionForm').submit(function (e) {
        e.preventDefault();
        if($('#subscriptionForm').valid()) {
            $.ajax({
                type: "POST",
                url: $('#subscriptionForm')[0].action,
                data: $('#subscriptionForm').serialize(), // serializes the form's elements.
                beforeSend: function(){
                    $('.ajax-loader').css("visibility", "visible");
                },
                complete: function(){
                    $('.ajax-loader').css("visibility", "hidden");
                },
                success: function(data) {
                    if(data==1) {
                        $('#subscriptionForm')[0].reset();
                        $('#contactresponsehome').text("Subscription submitted successfully");
                        $('#contactresponsehome').css("color", "green");
                    } else {
                        $('#contactresponsehome').text("Subscription submission failed");
                        $('#contactresponsehome').css("color", "red");
                    }
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                    alert("Status: " + textStatus); alert("Error: " + errorThrown); 
                }  
            });
        }
    });
    $('#e_assist').submit(function (e) {
        e.preventDefault();
        if($('#e_assist').valid()) {
            $.ajax({
                cache:false,
                url: $('#e_assist')[0].action,
                type: "POST",
                data: $('#e_assist').serialize(),
                success: function(response) {
                    //alert(response);
                    var res = $.trim(response);
                    //alert(res);
                    if(res) {
                        $("#ea_name").val("");
                        $("#ea_email").val("");
                        $("#ea_mob").val("");
                        $("#taxCheck").prop("checked", false);
                        $("#investmentCheck").prop("checked", false);
                        $("#willCheck").prop("checked", false);
                        $("#taxFileCheck").prop("checked", false);
                        $("#taxAssessmentCheck").prop("checked", false);
                        // alert("Thank you for contacting us.We will contact with you shortly."); 
                        $("#eca_success").text("Thank you for contacting us. We will get back to you at the earliest, usually within 24 hours.");
                        $('#eca_success').css("color", "green");
                    } else {
                        $("#eca_success").text("Please Try Again...");
                        $('#eca_success').css("color", "red");
                    }
                }
            });
        }
        return false;
    });
    $("#e_assist").validate({
        rules: {
            ea_name: "required",
            ea_email: {
                required: true,
                email: true
            },
            ea_mob: {
                required: true,
                number: true,
                minlength: 10,
                maxlength: 11
            }
        },
        messages: {
            ea_name: "Please enter your name",
            ea_mob: {
                required: "Please enter a mobile number",
                number: "Please enter only digits",
                minlength: "Mobile number must be 10 digits",
                maxlength: "Please enter valid mobile number"
            },
            ea_email: "Please enter a valid email address"
        },
        errorPlacement: function(label, element) {
            label.addClass('mt-2 text-danger');
            label.insertAfter(element);
        },
        highlight: function(element, errorClass) {
            $(element).parent().addClass('has-danger');
            $(element).addClass('form-control-danger');
        }
    });
    $("#subscriptionForm").validate({
        rules: {
            formname: "required",
            formemail: {
                required: true,
                email: true
            },
            formnumber: {
                required: true,
                number: true,
                minlength: 10,
                maxlength: 11
            },
            formmessage: {
                required: true,
                minlength: 50
            }
        },
        messages: {
            formname: "Please enter your name",
            formnumber: {
                required: "Please enter a mobile number",
                number: "Please enter only digits",
                minlength: "Mobile number must be 10 digits",
                maxlength: "Please enter valid mobile number"
            },
            formemail: "Please enter a valid email address",
            formmessage: {
                required: "Please enter the message",
                minlength: "Please enter atleast 50 characters"
            }
        },
        errorPlacement: function(label, element) {
            label.addClass('mt-2 text-danger');
            label.insertAfter(element);
        },
        highlight: function(element, errorClass) {
            $(element).parent().addClass('has-danger');
            $(element).addClass('form-control-danger');
        }
    });
    $('#contact-form1').submit(function (e) {
        e.preventDefault();
        if($('#contact-form1').valid()) {
            $.ajax({
                type: "POST",
                url: $('#contact-form1')[0].action,
                data: $('#contact-form1').serialize(), // serializes the form's elements.
                beforeSend: function(){
                    $('.ajax-loader').css("visibility", "visible");
                },
                complete: function(){
                    $('.ajax-loader').css("visibility", "hidden");
                },
                success: function(data) {
                    if(data==1) {
                        $('#contact-form1')[0].reset();
                        $('#contactresponsehome1').text("Expert CA request submitted successfully");
                        $('#contactresponsehome1').css("color", "green");
                    } else {
                        $('#contactresponsehome1').text("Expert CA request submission failed");
                        $('#contactresponsehome1').css("color", "red");
                    }
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                    alert("Status: " + textStatus); alert("Error: " + errorThrown); 
                }  
            });
        }
    });
    $("#contact-form1").validate({
        rules: {
            formname: "required",
            formemail: {
                required: true,
                email: true
            },
            formnumber: {
                required: true,
                number: true,
                minlength: 10,
                maxlength: 11
            }
        },
        messages: {
            formname: "Please enter your name",
            formnumber: {
                required: "Please enter a mobile number",
                number: "Please enter only digits",
                minlength: "Mobile number must be 10 digits",
                maxlength: "Please enter valid mobile number"
            },
            formemail: "Please enter a valid email address"
        },
        errorPlacement: function(label, element) {
            label.addClass('mt-2 text-danger');
            label.insertAfter(element);
        },
        highlight: function(element, errorClass) {
            $(element).parent().addClass('has-danger');
            $(element).addClass('form-control-danger');
        }
    });
    $("#eventForm").validate({
        rules: {
            par_name: "required",
            par_email: {
                required: true,
                email: true
            },
            par_mob: {
                required: true,
                number: true,
                minlength: 10,
                maxlength: 11
            },
            par_myphoto: {
                required: false
            }
        },
        messages: {
            par_name: "Please enter your name",
            par_mob: {
                required: "Please enter a mobile number",
                number: "Please enter only digits",
                minlength: "Mobile number must be 10 digits",
                maxlength: "Please enter valid mobile number"
            },
            par_email: "Please enter a valid email address",
            par_myphoto: {
                required: "Please upload the selfie"
            }
        },
        errorPlacement: function(label, element) {
            label.addClass('mt-2 text-white');
            label.insertAfter(element);
        },
        highlight: function(element, errorClass) {
            $(element).parent().addClass('has-danger');
            $(element).addClass('form-control-danger');
        }
    });
    $("#par_myphoto").change(function() {
        $('#uploadBtnText').text($("#par_myphoto").val().split('\\').pop());
        //alert('changed!');
    });
    $('#eventForm').submit(function(e) {
        e.preventDefault();
        let data = new FormData($("#eventForm")[0]);
        if ($('#eventForm').valid()) {
            $.ajax({
                cache: false,
                url: "https://optymoney.com/ajax-request/ajax_response.php?action=par_reg&subaction=submit",
                type: "POST",
                data: data,
                enctype: 'multipart/form-data',
                processData: false, // Important!
                contentType: false,
                cache: false,
                beforeSend: function(){
                    $('.ajax-loader').css("visibility", "visible");
                },
                complete: function(){
                    $('.ajax-loader').css("visibility", "hidden");
                },
                success: function(response) {
                    var res = JSON.parse(response);
                    if (res.status == 1) {
                        $('#eventForm')[0].reset();
                        $('#uploadBtnText').text("PHOTO UPLOAD (JPG/PNG)");
                        $("#evf_success").text(res.msg);
                    } else {
                        $("#evf_success").text(res.msg+" Please Try Again...");
                    }
                }
            });
        }
    });
    $("#selfieForm").validate({
        rules: {
            par_myphoto: {
                required: false
            }
        },
        messages: {
            par_myphoto: {
                required: "Please upload the selfie"
            }
        },
        errorPlacement: function (label, element) {
            label.addClass('mt-2 text-white');
            label.insertAfter(element);
        },
        highlight: function (element, errorClass) {
            $(element).parent().addClass('has-danger');
            $(element).addClass('form-control-danger');
        }
    });
    $('#selfieForm').submit(function (e) {
        e.preventDefault();
        let data = new FormData($("#selfieForm")[0]);
        if ($('#selfieForm').valid()) {
            $.ajax({
                cache: false,
                url: "https://optymoney.com/ajax-request/ajax_response.php?action=upload_my_selfie&subaction=submit",
                type: "POST",
                data: data,
                enctype: 'multipart/form-data',
                processData: false,  // Important!
                contentType: false,
                cache: false,
                beforeSend: function(){
                    $('.ajax-loader').css("visibility", "visible");
                },
                complete: function(){
                    $('.ajax-loader').css("visibility", "hidden");
                },
                success: function(response) {
                    var res = JSON.parse(response);
                    if (res.status == 1) {
                        $('#selfieForm')[0].reset();
                        $('#uploadBtnText').text("PHOTO UPLOAD (JPG/PNG)");
                        $("#evf_success").text(res.msg);
                    } else {
                        $("#evf_success").text(res.msg+" Please Try Again...");
                    }
                }
            });
        }
    });
</script>