<?php
include '../../../__lib.includes/config.inc.php';
//global $CONFIG;
$profileInfo = $customerProfile->getCustomerInfo($CONFIG->loggedUserId);

$uname = $profileInfo['cust_name'];
$email = $profileInfo['login_id'];
$mobno = $profileInfo['contact_no'];
$custid = $profileInfo['fr_customer_id'];
$userid = $profileInfo['pk_user_id'];

?>

<div id="paymentpage">
        <section id="page_content" class="">
		<div class="container"> 
            <center>
        <div class="row">
			<div class="col-xs-12 col-sm-6 col-md-10 col-md-offset-1">
				<h1><center>Payment</center><br> <center><span class="span-end"></span></center></h1>
			</div>
			
		</div>
        <div class="row">
            <div class="col-xs-12">
				<h4><center>Pay INR <?php echo $_POST['amount']; ?> only</center></h4>   
			</div>
        </div>
			<div class="row">
				<div class="col-xs-3">
                </div>
                <div class="col-xs-6">
					<div id="login-box" class="login-box visible widget-box no-border">
						<div class="widget-body">
							<div class="widget-main">
								<h4 class="header blue lighter bigger">
									<i class="ace-icon fa fa-info green"></i> Please fill all the details to make the payment
								</h4>
								<div class="space-6"></div>
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
                                            $actual_link1 = $actual_link1.$commonFunction->setPage('itr_forms');

                                            $_SESSION['return_page'] = $_POST['return_page'];
                                        ?>
                                        
                                        <input type="hidden" name="return_url"    value="<?php echo $actual_link1; ?>" />
                                        
										
                                        <input type="hidden" name="mode"          value="TEST" />
                                        
                                        
                                        <input type="hidden" name="order_id"        value="<?php echo (int) rand(5000, 90000); ?>" />
                                        <input type="hidden" name="amount"    value="<?php  echo $_POST['amount'].'.00'; ?>" /> 
                                        <input type="hidden" name="currency"        value="INR" />
                                        <input type="hidden" name="description" value="<?php echo $_POST['description']; ?>" /> 
                                        <input type="hidden" name="country"        value="IND" />
                                        <input type="hidden" name="address_line_1"          value="dummy" />
                                        <input type="hidden" name="address_line_2"          value="dummy" />
                                        <input type="hidden" name="state"          value="dummy" />
                                        <input type="hidden" name="udf1"          value="<?php echo $_POST['return_page']; ?>" />
                                        <input type="hidden" name="udf2"          value="<?php echo $custid; ?>" />
                                        <input type="hidden" name="udf3"          value="<?php echo $userid; ?>" />
                                        <input type="hidden" name="udf4"          value="dummy" />
                                        <input type="hidden" name="udf5"          value="dummy" />
                                        
										<div class="clearfix">
											<button id="paymentFrm" name="loginFrm" type="submit"
												class="width-35 pull-center btn btn-sm btn-primary">
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

								<div class="space-24"></div>
							</div>
							
						</div>
						<!-- /.widget-body -->
					</div>
				</div>
				
			</div>
                </center>
		</div>
	</section>
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