<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->

<?php 
$ucc_data = $customerProfile->UCC_Mandate();
// echo "string";
// print_r($ucc_data);
?>
<div class="main-content" style="background-color: #fff;">
<div class="page-content">
   <!-- end page title end breadcrumb -->
   <div class="row"><br></div>
   <div class="container" style="background-color: #fff;">
      <div class="row"><br></div>
      <!-- <div class="text-center"><i class="fa fa-check-circle fa-5" aria-hidden="true"></i></div> -->
      <div class="row justify-content-center">
         <!-- <h2><b>Sorry You are not KYC compliant</b></h2> -->
      </div>
      <div class="row justify-content-md-center">
                            <div class="col-md-10">
                                <iframe class="col-md-12" src="" title="Iframe Example" id="kycFrame" height="1300px" style="padding: 0px; border: none;"></iframe>
                            </div>
                            <!-- /.col-md-8 -->
                        </div>
      <div class="row"><br></div>
      <div class="row"><br></div>
      <!-- <div class="row justify-content-md-center">
         <div class="col-6">
            <b>Your Orders</b>
         </div>
         <div class="col-md-auto">
            <b>Purchase Date: <?php //echo date("d M Y"); ?></b>
         </div>
      </div>
      <br/> -->
      <!-- <div class="row justify-content-md-center">
         <table class="table tblwidth">
            <thead>
               <tr>
                  <td>FUND NAME</td>
                  <td>AMOUNT</td>
                  <td>STATUS</td>
               </tr>
            </thead>
            <tbody>
               <tr>
                  <th>HDFC Balanced Advantage Fund Direct Plan Growth</th>
                  <th>₹500 </th>
                  <th><i class="fa fa-check-circle iconbackclr fasice" aria-hidden="true"></i></th>
               </tr>
            </tbody>
         </table>
      </div>-->
      <!-- <div class="row justify-content-center">
         <a href="?module_interface=<?php //echo $commonFunction->setPage('mutual_fund'); ?>" class="btn btn-primary" style="width: 12%;">MY DASHBOARD</a>
      </div> -->
   </div>
   <!-- end container-fluid -->
   <!-- end page-content-wrapper -->
</div>
<!-- End Page-content -->
<!-- footer_start -->
<!-- footer_end -->
<!-- end main content-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


<script>
        $(document).ready(function() {
            var kycname   = "<?= $ucc_data['cust_name']; ?>";
            var kycpan    = "<?= $ucc_data['pan_number']; ?>";
            var kycmob    = "<?= $ucc_data['contact_no']; ?>";
            var kycemail  = "<?= $ucc_data['login_id']; ?>";
            var url = "<?= $CONFIG->siteurl ?>mySaveTax/?module_interface=a3ljX29uYm9hcmQ=";
            //alert(url);
            onboardingProcess(kycname, kycpan, kycmob, kycemail, url);
            function basicAuth() {
                $.ajax('https://multi-channel.signzy.tech/api/channels/login', {
                    type: 'POST', // http method
                    data: JSON.stringify({
                        "username": "icici_OPTYmoney_prod",
                        "password": "Ld38M*9HS@rZs9nc#eK$2OcQ6%D"
                    }), // data to submit
                    contentType: 'application/json',
                    async: false,
                    success: function(data, status, xhr) {
                        console.log('status: ' + status + ', data: ' + data.userId);
                        console.log('status: ' + status + ', data: ' + data.id);
                        sessionStorage.setItem("uidAccess", data.userId);
                        sessionStorage.setItem("accessToken", data.id);
                    },
                    error: function(jqXhr, textStatus, errorMessage) {
                        console.log('Error: ' + errorMessage);
                    }
                });
            }

            function getCaptcha() {
                $.ajax('https://multi-channel.signzy.tech/organs/captchax/captchas', {
                    type: 'POST', // http method
                    data: JSON.stringify({
                        "username": "icici_OPTYmoney_prod",
                        "password": "Ld38M*9HS@rZs9nc#eK$2OcQ6%D"
                    }), // data to submit
                    contentType: 'application/json',
                    success: function(data, status, xhr) {
                        console.log('status: ' + status + ', data: ' + data.text);
                        $('#captchaImg').attr("src", data.fileURL);
                        //sessionStorage.setItem("captchaid", data.id);
                    },
                    error: function(jqXhr, textStatus, errorMessage) {
                        console.log('Error: ' + errorMessage);
                    }
                });
            }

            function onboardingProcess(kycname, kycpan, kycmob, kycemail) {
              console.log("onboarding Started");
              if(sessionStorage.getItem("uidAccess") == null) {
                basicAuth();
              }
                
                var currentdate = new Date(); 
                var datetime = currentdate.getDate().toString() + (currentdate.getMonth()+1).toString() + currentdate.getFullYear().toString() + "_" + currentdate.getHours() + currentdate.getMinutes() + currentdate.getSeconds();
                var un = "opty_" + kycname.replace(/\s/g, '').toLowerCase() + "_" + datetime;
                var data = JSON.stringify({
                    "email": kycemail,
                    "username": un,
                    "phone": kycmob,
                    "name": kycname,
                    "redirectUrl": url,
                    "channelEmail": "support@optymoney.com"
                });
                console.log(data);
                console.log('https://multi-channel.signzy.tech/api/channels/' + sessionStorage.getItem("uidAccess") + '/onboardings');
                $.ajax('https://multi-channel.signzy.tech/api/channels/' + sessionStorage.getItem("uidAccess") + '/onboardings', {
                    type: 'POST', // http method
                    crossDomain: true,
                    data: data,
                    headers: {
                        "Content-Type": 'application/json',
                        "Access-Control-Allow-Origin": "*",
                        "Authorization": sessionStorage.getItem("accessToken")
                    },
                    async: true,
                    success: function(data, status, xhr) {
                        console.log('status: ' + status + ', data: ' + data);
                        console.log(data.createdObj.autoLoginUrL)
                        //sessionStorage.setItem("uidAccess", data.userId);
                        $('#myTabContent').hide();
                        $('#kycFrame').show();
                        //$('#kycFrame').attr("src", data.createdObj.autoLoginUrL)
                        window.location.href = data.createdObj.autoLoginUrL;
                    },
                    error: function(jqXhr, textStatus, errorMessage) {
                        console.log('Error: ' + errorMessage);
                    }
                });
            }
            $('#kycFrame').hide();
            //getCaptcha();
            
            
            /*$("#kycSubmit").click(function() {
                var kycname = $('#kycname').val();
                var kycpan = $('#kycpan').val();
                var kycmob = $('#kycmob').val();
                var kycemail = $('#kycemail').val();
                $('#kycFrame').show();
                console.log(kycname + " / " + kycpan + " / " + kycmob + " / " + kycemail);
                onboardingProcess(kycname, kycpan, kycmob, kycemail);
            });*/
        });
    </script>  
