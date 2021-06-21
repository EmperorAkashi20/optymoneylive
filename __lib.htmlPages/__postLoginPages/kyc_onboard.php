<?php 
   echo "data: <pre>";
   print_r($_POST);
   echo "</pre>";
//   if($_POST) {
      $id = $_GET['_id'];
      if($id==null) {
         ?>
         <div class="main-content" style="background-color: #fff;">
            <div class="page-content">
               <!-- end page title end breadcrumb -->
               <div class="row"><br></div>
               <div class="container" style="background-color: #fff;">
                  <div class="row"><br></div>
                  <!-- <div class="text-center"><i class="fa fa-check-circle fa-5" aria-hidden="true"></i></div> -->
                  <div class="row justify-content-center">
                     <h2><b>Sorry You are not KYC compliant</b></h2>
                  </div>
                  <div class="row justify-content-center">
                     <p><b>We will contact you for make you KYC compliant</b></p>
                  </div>
                  <div class="row justify-content-center">
                     <a href="?module_interface=<?php echo $commonFunction->setPage('mutual_fund'); ?>" class="btn btn-primary" style="width: 12%;">MY DASHBOARD</a>
                  </div>
               </div>
            </div>
         </div>
<?php } else { ?>
         <div class="main-content" style="background-color: #fff;">
            <div class="page-content">
               <!-- end page title end breadcrumb -->
               <div class="row"><br></div>
               <div class="container" style="background-color: #fff;">
                  <div class="row"><br></div>
                  <!-- <div class="text-center"><i class="fa fa-check-circle fa-5" aria-hidden="true"></i></div> -->
                  <div class="row justify-content-center">
                     <h2><b>Your KYC compliant Submitted Successfully</b></h2>
                  </div>
                  <div class="row justify-content-center">
                     <a href="?module_interface=<?php echo $commonFunction->setPage('all_products'); ?>&offer_id=21" class="btn btn-primary" style="width: 12%;">KYC New Schemes</a>
                  </div>
               </div>
            </div>
         </div>
       <?php 
      }
//} ?>