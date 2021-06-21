<?php
$fetch_cart_cnt = $mutualFund->fetch_cart_count();
$check_ucc = $customerProfile->ucc_check();
//if($fetch_cart_cnt)
//echo "<br>count:-".$fetch_cart_cnt."<br>";
//die();
?>
<body data-layout="horizontal" data-layout-size="boxed">
   <!-- Begin page -->
   <div id="layout-wrapper">
      <?php //echo "UCC"; print_r($check_ucc); ?>
      <!-- ============================================================== -->
      <!-- Start right Content here -->
      <!-- ============================================================== -->
      <div class="container">
         <?php if ($fetch_cart_cnt == "") { ?>
            <div class="page-content emptycart_page">
               <h3 class="text-center">Uh-oh! Your cart is empty</h3>
               <img src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>img/cart-empty.svg" alt="empty cart" class="empty_cart_img">
               <div class="mt-4">
                  <a href="?module_interface=<?php echo $commonFunction->setPage('all_product');?>" class="btn btn-primary btn-sm add_funds_btn"><i class="mdi mdi-plus mr-2"></i>ADD FUNDS TO CART </a>
               </div>
            </div>
        <?php } else { ?>
        <div class="page-content">
            <!-- Page-Title -->
            <div class="page-title-box">
               <div class="container-fluid">
                  <div class="row align-items-center">
                     <div class="col-md-8">
                        <h4 class="page-title mb-1"> My Cart (<?= $fetch_cart_cnt; ?>)</h4>
                     </div>
                  </div>
               </div>
            </div>
            <br>
            <div class="page-title-box-error" id="errorDisplay" style="display: none">
               <div class="container-fluid">
                  <div class="row align-items-center">
                     <div class="col-md-12 text-center">
                        <h4 class="page-title mb-1"  style="color: #D33633"> <?php echo $_GET[err]; ?></h4>
                     </div>
                  </div>
               </div>
            </div>
            <!-- end page title end breadcrumb -->
            <div class="page-content-wrapper">
               <div class="container-fluid">
                  <div class="row">
                     <div class="col-xl-8 col-12">
                        <div class="card product_left">
                           <?php
                           $total_amt = 0;
                           $fetch_cart = $mutualFund->fetch_cart($action);
                           //print_r($fetch_cart);
                           while (list($key,$val) = each($fetch_cart)) {
                           ?>
                           <div class="card-body">
                              <div class="row">
                                 <div class="col-xl-10 col-12">
                                    <!-- <div class="media icon_logos">
                                       <img src="img/axis_opty.svg" alt="" height="60">
                                    </div> -->
                                    <div class="media-body">
                                       <h5><?= $val[scheme_name]; ?></h5>
                                    </div>
                                 </div>
                                 <div class="col-xl-2 col-12">
                                    <button data-toggle="modal" class="dlt_sch" data-target="#delete_popup" value="<?php echo $val[mf_cart_id];  ?>">
                                    	<i class="fa fa-trash" ></i>
                                    </button>
                                 </div>
                              </div>
                              <br><br>
                              <div class="row">
                                 <div class="col-xl-6 col-12 ml-auto">
                                    <?php if ($val[p_method] == 2) { ?>
                                       <p class="price_bottom sip_date">SIP date
                                          <?= $val[date_sip]; ?>
                                          <?php 
                                             if($val[date_sip]== "1" || $val[date_sip]== "21") { 
                                                echo "st"; 
                                             } else if($val[date_sip]== "2" || $val[date_sip]== "22") {
                                                echo "nd"; 
                                             } else if($val[date_sip]== "3" || $val[date_sip]== "23") {
                                                echo "rd"; 
                                             } else {
                                                echo "th"; 
                                             } 
                                          ?>
                                          <!-- <i class="fa fa-pencil" aria-hidden="true"></i>  -->
                                          </p>
                                    <?php } else { ?>
                                       <p class="text-muted">Lumpsum Investment </p>
                                    <?php } ?>
                                 </div>
                                 <div class="col-xl-6 col-12 ml-auto">
                                    <h3 class="price_bottom"><span>Amount</span> <input id="amout_edit" type="number" disabled="disabled" class="edit_rupess amnt_val" name="amnt_val" placeholder="₹0" value="<?= $val[amnt]; ?>" autocomplete="off"><!-- <i class="fa fa-pencil" aria-hidden="true"></i> --></h3>
                                 </div>
                              </div>
                           </div>
                           <?php
                           $total_amt += $val[amnt]; 
                           }
                           ?>
                           <div class="mb-4 text-center">
                              <a href="?module_interface=<?php echo $commonFunction->setPage('all_product');?>" class="btn btn-success"><i class="mdi mdi-plus mr-2"></i>ADD MORE FUNDS </a>
                           </div>
                        </div>
                     </div>
                    <div class="col-xl-4">
                      <div class="card product_right">
                        <div class="card-body">
                          <h3 class="header-title mb-4 text-center">Amount payable now</h3>
                          <h3 class="text-center"><span id="total_amt">₹ <?= $total_amt; ?></span></h3>
                          <img src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>img/payment_secure.JPG" alt="" class="secure_pay_img" >
                          <!-- <div>
                            <select>
                              <option>HDFC Bank</option>
                              <option>Citi Bank</option>
                              <option>bank of baroda</option>
                            </select>
                          </div> -->
                          <div class="custom-control custom-checkbox text-center">
                            <input type="checkbox" class="custom-control-input" id="term-conditionCheck">
                            <label class="custom-control-label font-weight-normal" for="term-conditionCheck">By Continuing, you agree to <br><a href='<?php if($_SESSION[$CONFIG->sessionPrefix.'loginstatus']){ echo "?module_interface=".$commonFunction->setPage("termsofuse");  }else{ echo "termsofuse.html"; } ?>' class="text-primary" target="_blank">Terms & Conditions</a></label>
                          </div>
                          <form method="POST" action="<?= $CONFIG->siteurl ?>ajax-request/mutual_fund.php"> 
                          <input type="hidden" name="test" value="xyz">
                          <div class="mt-4">
                              <input type="submit" class="btn btn-success" id="pay_bt" disabled="disabled"  name="p_to_pay" value="PROCEED TO PAY">
                          </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  <!-- end row -->
               </div>
               
               <!-- end container-fluid -->
            </div>
            <!-- end page-content-wrapper -->
         </div>
        <?php   
        }

        ?>
      <!-- End Page-content -->
      <!-- footer_start -->

      <!-- end slimscroll-menu-->
   </div>
   <!-- /Right-bar -->
   <!-- Right bar overlay-->
   <div class="rightbar-overlay"></div>

   <div id="delete_popup" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
               <div class="modal-content">
                  <div class="modal-header">
                     <h5 class="modal-title mt-0" id="myModalLabel"><i class="fa fa-trash confirm_del_icon"></i></h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                     </button>
                  </div>
                  <div class="modal-body">
                     <h3 class="font-size-16">Are you sure you want to remove this fund from your cart?</h3>
                  </div>
                  <form method="POST" action="<?= $CONFIG->siteurl ?>ajax-request/mutual_fund.php">
                  <input type="hidden" name="cart_id" id="cart_id" value="">

                  <div class="modal-footer">
                     <button type="button" class="btn btn-secondary waves-effect modal_cancel" data-dismiss="modal">Cancel</button>
                     <input type="submit" class="btn btn-primary waves-effect waves-light modal_remove" name="rmv_sch" value="Remove">
                  </div>
                  </form>
               </div>
               <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
         </div>
       