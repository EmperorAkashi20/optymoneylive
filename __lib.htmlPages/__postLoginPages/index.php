<?php
   header('Access-Control-Allow-Origin: *');
   include '../../__lib.includes/config.inc.php';          //$pagename = $_GET[page] || $_GET[module_interface];
   //print_r($CONFIG);
   //print_r($_SESSION);

   $_SESSION['oPageAccess'] = 2;
   if (!($_SESSION[$CONFIG->sessionPrefix.'loginstatus'])) {
      header('HTTP/1.1 401 Unauthorized');
      header("Location: $CONFIG->siteurl");
      exit;
   }

   $prelogin_page_n = ['tax','createwill','all_product','single_product'];
   $postlogin_page_n = ['wealth','create_will','all_product','cart_sys'];
   //echo "PAGE1:-".$_SESSION[$CONFIG->sessionPrefix.'c_page']. "<br>";
   $c_page = $_SESSION[$CONFIG->sessionPrefix.'c_page'];
   $interface = $_GET[module_interface];
   $interface = explode("?", $interface);
   //print_r($interface);
   $pagename = $commonFunction->getPage($_GET[module_interface]);
   $pagename = $commonFunction->getPage($interface[0]);
   //echo "Page:-".$_SESSION[$CONFIG->sessionPrefix.'c_page'];
   if($c_page!= "") {
      foreach ($prelogin_page_n as $value) {
         //echo "array:-".$value. "<br>";
         //echo "cPAGE1:-".$c_page. "<br>";
         if($c_page == $value) {
            $key_val = array_search($value,$prelogin_page_n);
            $pagename = $postlogin_page_n[$key_val]; 
            //echo "key".$key_val."<br>pagename : ".$pagename;
            //echo "PageName:-".$pagename;
            unset($_SESSION[$CONFIG->sessionPrefix.'c_page']);
         } else {
            //echo "false". "<br>";
         }
      }  
   }
   //echo "Interface:-".$_GET[module_interface]."<br>";
   $sch = $_GET[sch];
   //echo "string:-".$sch;
   //die();
    //$single_p = $interface[1];
    //echo "P:-".$single_p;

    //die();
    //echo "<br>Page Name:-".$pagename;
    if ($pagename == '') {
        //$pagename = 'home';
        $pagename = 'dashboard';
    }
    //print_r($_REQUEST); exit;
    $CONFIG->pageName = $pagename;
    $CONFIG->sch_id = base64_decode($_GET[id]);//$single_p;
    //echo "sch_id".$CONFIG->sch_id;
    /*------------------------------------------*/
    //$_SESSION['itr_status'] = "";
    // echo isset($_REQUEST['itrStatus']);
    // exit;
        //$_SESSION['itr_status'] = '';
     if (isset($_REQUEST['itrStatus'])) {
         $itr_status = $_REQUEST['itrStatus'];

         //echo "STATUS:-".$itr_status;
         $_SESSION['itr_status'] = $_REQUEST['itrStatus'];
          //echo "STATUS:-".$_SESSION['itr_status'];
       //die();
     }
     else
     {
        //$_SESSION['itr_status'] = '';
     }

      if($_REQUEST['salary_id']){
        $_SESSION['getformsDataID'] = $_REQUEST['salary_id'];
        //echo "getformsDataID:-".$_SESSION['getformsDataID'];
      }
    /*------------------------------------------*/
    $profileInfo = $customerProfile->getCustomerInfo($CONFIG->loggedUserId);
    if ($profileInfo['profile_image'] == '') {
        $loggedUserImage = $CONFIG->siteurl.'__UI.assets/postloginAssets/avatars/avatar2.png';
    } else {
        $loggedUserImage = $CONFIG->customerProfileImgURL.$profileInfo['profile_image'];
    }
    //$_SESSION['user_pan_number'] = '';
    if (isset($_REQUEST['pan'])) {
        $_SESSION['user_pan_number'] = $_REQUEST['pan'];
    }
    $page = $pagename.'.php';
    if (strpos($pagename, 'modal') !== false) {
        include $page;
        exit;
    }
    $_SESSION[$CONFIG->sessionPrefix.'page_name'] = $pagename;
?>
<?php
if($pagename == 'blogs_single_page' || $pagename == 'mygoal' || $pagename == 'privacypolicy' || $pagename == 'kyc_onboard' || $pagename == 'downloads' || $pagename == 'blogs' || $pagename == 'mfcategories' || $pagename == 'wealth' || $pagename == 'dashboard' || $pagename == 'all_product' || $pagename == 'single_product' || $pagename == 'cart_sys' || $pagename == 'mutual_fund' || $pagename == 'view_transaction' || $pagename == 'tran_status' || $pagename == 'sip_details' || $pagename == 'ucc_from' || $pagename == 'helpdesk' || $pagename == 'create_will' || $pagename == 'kyc' || $pagename == 'pay/bill_paymentdetails' || $pagename == 'faq' || $pagename == 'comming_soon' || $pagename == 'about' || $pagename == 'calculators' || $pagename == 'contact' || $pagename == 'partners' || $pagename == 'termsofuse' || $pagename == 'testimonial' || $pagename == 'settings' || $pagename == 'orders_details' || $pagename == 'pay/paymentresponse_Will' || $pagename == 'pay/will_paymentdetails')
{
?>
<!doctype html>
<html class="no-js" lang="zxx">
    <?php 
        include("../../__lib.includes/header_includes.inc.php"); 
    ?>
    <body class="">
      <?php         
          include("../../__lib.includes/leftbar.inc.php");       
      ?>
        <div id="wrapper" class="home-page">
<?php
include $page;
}
else {
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">      
        <?php include_once 'inc.header_includes.php'; ?>    
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
        <title>Optymoney | Complex options simple solutions</title>
    </head>
    <body class="sidebar-fixed">
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <?php  include 'inc.header.php'; ?> 
<?php 
    
}
if($pagename == 'blogs_single_page' || $pagename == 'mygoal' || $pagename == 'mfcategories' || $pagename == 'privacypolicy' || $pagename == 'kyc_onboard' || $pagename == 'downloads' || $pagename == 'blogs' || $pagename == 'wealth' || $pagename == 'all_product'  || $pagename == 'dashboard' || $pagename == 'single_product' || $pagename == 'cart_sys' || $pagename == 'mutual_fund' || $pagename == 'view_transaction' || $pagename == 'tran_status' || $pagename == 'sip_details' || $pagename == 'ucc_from' || $pagename == 'helpdesk' || $pagename == 'create_will' || $pagename == 'kyc' || $pagename == 'pay/bill_paymentdetails' || $pagename == 'faq' || $pagename == 'comming_soon' || $pagename == 'about' || $pagename == 'calculators' || $pagename == 'contact' || $pagename == 'partners' || $pagename == 'termsofuse' || $pagename == 'testimonial' || $pagename == 'settings' || $pagename == 'orders_details' || $pagename == 'pay/paymentresponse_Will' || $pagename == 'pay/will_paymentdetails')
 {
    //echo "string";
    include("../../__lib.includes/footerlink.inc.php");
 	include("../../__lib.includes/footer.inc.php"); 
 	//include("../../__lib.includes/login.php"); 
?>
        </div>
    </body>
</html>

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
<?php } else { ?>
  <div class="container-fluid page-body-wrapper">
            <?php include 'inc.left.php'; ?>
            <div class="main-panel">
                <div class="content-wrapper" style="margin-top: 0px;">
                    <?php include $page; ?> 
                    <?php echo "Page : ".$pagename; ?>
                </div>
                <?php include 'inc.footer.php'; ?> 
            </div> 
        </div>
    </div>
    <?php include 'inc.footer.js.php'; ?>
    <div class="modal fade" id="myModal">
            <div class="modal-dialog modal-lg">
               <div class="modal-content" style="width: 90% !important;">
                  <div class="col-12">
                     <div class="row">
                        <div class="col-md-4 login-form-2">
                           <!-- <div class="row justify-content-center align-items-center">tyttt</div> -->
                           <div class="row h-50">
                              <div class="col-sm-12 h-100 d-table" style="height: 150% !important;">
                                 <div class="card card-block d-table-cell align-middle">
                                    <h4 class="ml-3" style="color: #fff;">Redeem</h4>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-8 login-form-1">
                           <div class="row">
                              <div class="col-12 pull-right">
                                 <button type="button" class="close" data-dismiss="modal" style="position: relative; top: 50%; right: 1%;">&times;</button>
                              </div>
                           </div>
                           <div class="full-focus">
                              <h6>
                                 <img class="" src="https://groww.in/images/partners/mirae_groww.svg" width="30" height="30" alt="Mirae Asset Mutual Fund">
                                 <span class="ml-2"> HDFC Balanced Advantage Fund Plan Growth</span>
                              </h6>
                              <div class="row"><br/></div>
                              <div class="first-show">
                                 <div class="row">
                                    <p>Total Redeemable Amount (as per latest NAV)<BR/>₹</p>
                                 </div>
                                 <form>
                                    <div class="form-group">
                                       <!-- <input type="text" class="form-control" placeholder="Your Email *" value="" /> -->
                                       <input type="text" name="name" class="form-control" id="name" value="">
                                    </div>
                                    <br/>
                                    <div class="chiller_cb">
                                       <input id="myCheckbox2" type="checkbox" style="width: 1.25rem; height: 1.25rem;">
                                       <label for="myCheckbox2">&nbsp;Tick this to redeem Full Amount (All Units)</label>
                                    </div>
                                    <br/>
                                    <div class="row ml-1">
                                       <p>Applicable exit load&nbsp;<i class="fa fa-question-circle-o iconbackclr" aria-hidden="true"></i></p>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                       <a href="#" class="btn btn-primary" id="first-con" style="width: 100%;">CONTINUE</a>
                                    </div>
                                    <div class="modal-footer">
                                       <a href="#" class="ForgetPwd">Safe And Secure</a>
                                    </div>
                                 </form>
                              </div>
                              <div class="second-show" style="display: none;">
                                 <div class="row">
                                    <p>Total Redeemable Amount (as per latest NAV)<BR/>₹587</p>
                                 </div>
                                 <form>
                                    <div class="form-group">
                                       500 <a href="#" class="anchclrs"> CHANGE AMOUNT</a>
                                    </div>
                                    <br/>
                                    <!--    <div class="chiller_cb">
                                       <input id="myCheckbox2" type="checkbox" style="width: 1.25rem; height: 1.25rem;">
                                       <label for="myCheckbox2">&nbsp;Tick this to redeem Full Amount (All Units)</label>
                                       
                                       </div><br/> -->
                                    <div class="form-group">
                                       ₹10 Estimated Exit Load&nbsp;<i class="fa fa-question-circle-o iconbackclr" aria-hidden="true"></i>
                                    </div>
                                    <br/>
                                    <div class="form-group">
                                       <h6>By continuing, you agree to <a href="#" class="ForgetPwd">Terms & Conditions</a></h6>
                                       <a href="#" class="btn btn-primary" id="second-con" style="width: 100%;">CONTINUE</a>
                                    </div>
                                    <div class="modal-footer">
                                       <a href="#" class="ForgetPwd">Safe And Secure</a>
                                    </div>
                                 </form>
                              </div>
                              <div class="third-show" style="display: none;">
                                 <div class="row ml-1">
                                    <p>Redemption of ₹500</p>
                                 </div>
                                 <form>
                                    <div class="form-group">
                                       <div class="row ml-1">
                                          <p><b>Choose mode of Redeem</b></p>
                                       </div>
                                    </div>
                                    <div class="row">
                                       <div class="col-auto ml-3">
                                          <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>                    
                                       </div>
                                       <div class="col-auto">
                                          <i class="fa fa-id-card iconbackclr" aria-hidden="true"></i>
                                       </div>
                                       <div class="col-auto">
                                          <b>Groww Balance</b><br/>
                                          <h6>You can re-invest this money in just a single click</h6>
                                       </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                       <div class="col-auto ml-3">
                                          <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>                    
                                       </div>
                                       <div class="col-auto">
                                          <i class="fa fa-university iconbackclr" aria-hidden="true"></i>
                                       </div>
                                       <div class="col-auto">
                                          <b>Transfer to Bank</b><br/>
                                          <h6>In your bank account within 4-5 working days</h6>
                                       </div>
                                    </div>
                                    <br>
                                    <div class="form-group text-center">
                                       <a href="transatn_sucs.html" class="btn btn-primary" id="confirm" style="width: 65%;">CONFIRM</a>
                                    </div>
                                    <div class="modal-footer">
                                       <a href="#" class="ForgetPwd">Safe And Secure</a>
                                    </div>
                                 </form>
                              </div>
                           </div>
                        </div>
                     </div>
                     <!-- <div class="row">
                        <div class="col-3 bg-success">
                          <p>Lorem ipsum...</p>
                        </div>
                        <div class="col-9">
                             <div class="row">
                                <div class="col-12 pull-right">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                             </div>
                             <div class="row">
                          <h4 class="modal-title">Modal Heading</h4>
                        </div>
                        </div>
                        </div> -->
                  </div>
               </div>
            </div>
         </div>
         <!-- modal end -->
</body>
</html>
 <?php
}
 ?> 