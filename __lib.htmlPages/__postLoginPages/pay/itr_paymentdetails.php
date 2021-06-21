<?php
include '../../../__lib.includes/config.inc.php';
//global $CONFIG;
$profileInfo = $customerProfile->getCustomerInfo($CONFIG->loggedUserId);
$itr_id = $_SESSION[$CONFIG->sessionPrefix.'_ITR_ID'];
$itr_pay_amount = $itrFill->calculatePaySelection('itr_sou_salary', $itr_id)[0];
$itr_pay_selection = $itrFill->calculatePaySelection('itr_sou_salary', $itr_id)[1];
$total_section = $itrFill->calculatePaySelection('itr_sou_salary', $itr_id)[2];
if (isset($_POST['taxreconcil_btn'])) {
    if ($itr_pay_amount == 0) {
        $commonFunction->jsRedirect($CONFIG->siteurl.'mySaveTax/?activeTab=tabTAXFilling&module_interface='.$commonFunction->setPage('itr_forms'));
    }
}
$uname = $profileInfo['cust_name'];
$email = $profileInfo['login_id'];
$mobno = $profileInfo['contact_no'];
$custid = $profileInfo['fr_customer_id'];
$userid = $profileInfo['pk_user_id'];
$product_desc = 'Payment for ITR';

?>
<div class="card">
  <div class="card-body">
			<div class="col-md-6 col-lg-5 grid-margin stretch-card top-selling-card">
        <form method="post" action="?module_interface=<?php echo $commonFunction->setPage('itr_forms'); ?>">  
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Your ITR filing charges...</h4>
                    <canvas id="topSellingProducts" height="15"></canvas>
                    <div class="column-wrapper">
                      <div class="column">
                        <div class="d-flex flex-column flex-md-row">
                          <i class="mdi mdi-shield-half-full text-primary"></i>
                          <div class="d-flex flex-column mr-md-2">
                            <p class="text-muted mb-0 font-weight-medium">Sections</p>
                            <h4 class="font-weight-bold">#&nbsp;<?php echo $total_section; ?></h4>
                          </div>
                        </div>
                      </div>
                      <div class="column">
                        <div class="d-flex flex-column flex-md-row">
                          <i class="mdi mdi-cart-outline text-success"></i>
                          <div class="d-flex flex-column mr-md-2">
                            <p class="text-muted mb-0 font-weight-medium">Total pay</p>
                            <h4 class="font-weight-bold">Rs.<?php echo $itr_pay_amount; ?></h4>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="table-responsive item-wrapper">
                      <table class="table table-striped">
                        <thead>
                          <tr>
                            <th>ITR Section</th>
                            <th>Amount</th>
                          </tr>
                          </thead>
                          <?php
                                if (!empty($itr_pay_selection)) {
                                    foreach ($itr_pay_selection as $itr_pay_desc) {
                                        ?>
                        <tbody>
                          <tr>
                            <td><?php echo $itr_pay_desc['fee_desc']; ?></td>
                            <td><?php echo $itr_pay_desc['fee_amount']; ?></td>
                          </tr>
                      </tbody>
                      <?php
                                    }
                                }
                                    ?>
                        <tr>
                          <td>Total :</td>
                          <td><strong><?php echo $itr_pay_amount; ?></strong></td>
                        </tr>
                      </table>
                    </div>
                    <div class="clearfix"></div><br>
                    <div>
                        <button id="itr_payment" name="itr_payment" type="submit"
                          class="width-35 pull-center btn btn-sm btn-success">
                          <i class="ace-icon fa fa-key"></i> <span class="bigger-110">Back</span>
                        </button>
                      </div>
                  </div>
                  <div>
                  
                      </div>
                </div>
              </form>
            </div>

			  <div class="col-md-6 col-lg-7 grid-margin stretch-card">
                <div class="card">
                  <div class="card-header header-sm d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Please check all the details to make the payment</h4>
                  </div>
                  <div class="card-body">
                      <div class="wrapper">
                        <p class="mb-0 font-weight-medium"> </p>
                      </div>
					  <form class="loginForm" role="form" method="post"
									action="pay/paymentrequest.php"
									name="payment_frm"
									accept-charset="UTF-8" id="login-nav">
									<fieldset>
										<label class="block clearfix"> <span
											class="block input-icon input-icon-right"> 
                                            <input
												type="name" name="name" class="form-control" value="<?php echo $uname; ?>"
												id="paymentname" placeholder="Name" required>
												<i class="ace-icon fa fa-user"></i>
										</span>
										</label>
                                        <label class="block clearfix"> <span
											class="block input-icon input-icon-right"> 
                                            <input
												type="email" name="email" class="form-control" value="<?php echo $email; ?>"
												id="paymentemail" placeholder="Email address" required>
												<i class="ace-icon fa fa-envelope"></i>
										</span>
										</label>
                                        <label class="block clearfix"> <span
											class="block input-icon input-icon-right"> 
                                            <input
												type="phone" name="phone" class="form-control" value="<?php echo $mobno; ?>"
												id="paymentphone" placeholder="Phone number" required>
												<i class="ace-icon fa fa-mobile"></i>
										</span>
										</label>
                                        <label class="block clearfix"> <span
											class="block input-icon input-icon-right"> 
                                            <input
												type="city" name="city" class="form-control" value="Bangalore"
												id="paymentcity" placeholder="City" required>
												<i class="ace-icon fa fa-map-marker"></i>
										</span>
										</label>
                                        <label class="block clearfix"> <span
											class="block input-icon input-icon-right"> 
                                            <input
												type="zipcode" name="zip_code" class="form-control" value="560001"
												id="paymentzipcode" placeholder="Zip Code" required>
												<i class="ace-icon fa fa-globe"></i>
										</span>
										</label>
                                        
										<div class="space-6"></div>
										<input type="hidden" name="api_key" value="fb7c78ca-18c7-434f-b4a0-29fd9e66274a" />
                                        
                                        <?php

                                            $actual_link1 = $CONFIG->siteurl;
                                            $actual_link1 = $actual_link1.'mySaveTax/?module_interface=';
                                            //$actual_link1 = $actual_link1 . $commonFunction->setPage('zohoform');
                                            $actual_link1 = $actual_link1.$commonFunction->setPage('pay/paymentresponse');

                                            $_SESSION['return_page'] = $_POST['return_page'];

                                            $failed_url = $CONFIG->siteurl.'mySaveTax/?module_interface='.$commonFunction->setPage('pay/itr_payment_failure');
                                            $cancel_url = $CONFIG->siteurl.'mySaveTax/?module_interface='.$commonFunction->setPage('pay/itr_payment_cancel');
                                        ?>
                                        
                                        <input type="hidden" name="return_url"    value="<?php echo $actual_link1; ?>" />
                                        <!-- <input type="hidden" name="return_url_failure"    value="<?php echo $failed_url; ?>" /> -->
										<!-- <input type="hidden" name="return_url_cancel"    value="<?php echo $cancel_url; ?>" /> -->
                                        <input type="hidden" name="mode"          value="LIVE" />
                                        
                                        
                                        <input type="hidden" name="order_id"        value="<?php echo (int) rand(5000, 90000); ?>" />
                                        <input type="hidden" name="amount"    value="<?php  echo $itr_pay_amount.'.00'; ?>" /> 
                                        <!-- <input type="hidden" name="amount"    value="<?php  //echo $_SESSION['itr_amount'].'.00';?>" />  -->
                                        <input type="hidden" name="currency"        value="INR" />
                                        <input type="hidden" name="description" value="<?php echo $product_desc; ?>" /> 
                                        <input type="hidden" name="country"        value="IND" />
                                        <input type="hidden" name="address_line_1"          value="dummy1" />
                                        <input type="hidden" name="address_line_2"          value="dummy2" />
                                        <input type="hidden" name="state"          value="dummy3" />
                                        <input type="hidden" name="udf1"          value="<?php echo $_POST['return_page']; ?>" />
                                        <input type="hidden" name="udf2"          value="<?php echo $custid; ?>" />
                                        <input type="hidden" name="udf3"          value="<?php echo $userid; ?>" />
                                        <input type="hidden" name="udf4"          value="dummy4" />
                                        <input type="hidden" name="udf5"          value="dummy5" />

										<div class="clearfix">
											<button id="itr_payment" name="itr_payment" type="submit"
												class="width-35 pull-center btn btn-sm btn-success">
												<i class="ace-icon fa fa-key"></i> <span class="bigger-110">Proceed to Pay</span>
											</button>
                                            <div style="height: 20px;">
													<div style="display: none;" id="invalidpaymentdetails"
														class="orange">
														<strong>Invalid email found</strong>
													</div>
												</div>
										</div>
                                        
									</fieldset>
								</form>
                  </div>
                </div>
              </div>
  </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
    
});
    
    function validatepayment(form)     {
        if(!(/^[0-9\-]+$/.test($("#paymentphone").val())))
    {
        $("#invalidpaymentdetails").html('Please enter valid mobile no.');
        $("#invalidpaymentdetails").css("display", "block");
        return false;
    }
    if($("#paymentphone").val().length != 10)
    {
        $("#invalidpaymentdetails").html('Please enter valid mobile no.');
        $("#invalidpaymentdetails").css("display", "block");
        return false;
    }    
        
        $.ajax({
        url: form.action,
        type: form.method,
        data: $(form).serialize(),
        success: function(response) {
            alert("resp");
            $("#paymentpage").html(response);
        }            
    });
    return false;
    }
</script>