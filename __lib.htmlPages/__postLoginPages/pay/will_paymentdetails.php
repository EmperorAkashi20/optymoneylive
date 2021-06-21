<?php
include '../../../__lib.includes/config.inc.php';
//global $CONFIG;
$profileInfo = $customerProfile->getCustomerInfo($CONFIG->loggedUserId);

$uname = $profileInfo['cust_name'];
$email = $profileInfo['login_id'];
$mobno = $profileInfo['contact_no'];
$custid = $profileInfo['fr_customer_id'];
$userid = $profileInfo['pk_user_id'];
$amount = 4000;
$_POST['amount'] = $amount;
$_POST['description'] = 'Making payment for will';
$_POST['return_page'] = 'create_will';
?>

<div class="card">
  <div class="card-body">
	<div id="paymentpage">
        <section id="page_content" class="">
			<div class="container"> 
				<div class="row">
					<div class="col-xs-12 col-sm-6 col-md-12 col-md-offset-1 text-center">
						<h1>Payment</h1><br>
						<h4 id="updatedPrice">Pay INR <?php echo $_POST['amount']; ?> only</h4>  
						<h4 id="couponStatus" style="color: red"></h4>  
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div id="login-box" class="login-box visible widget-box no-border text-center">
							<div class="widget-body">
								<h4 class="header blue lighter bigger"><i class="ace-icon fa fa-info green"></i> Please check all the details to make the payment</h4>
								<div class="widget-main widget-main d-flex justify-content-center">
									<form class="loginForm" role="form" method="post" action="pay/paymentrequest.php" name="payment_frm" accept-charset="UTF-8" id="login-nav">
										<div class="row">
											<div class="col-md-6 my-1">
												<div class="input-group">
													<div class="input-group-prepend">
														<div class="input-group-text"><i class="ace-icon fa fa-user"></i></div>
													</div>
													<input type="text" name="name" class="form-control" value="<?php echo $uname; ?>" id="paymentname" placeholder="Name" required>
												</div>
											</div>
											<div class="col-md-6 my-1">
												<div class="input-group">
													<div class="input-group-prepend">
														<div class="input-group-text"><i class="ace-icon fa fa-envelope"></i></div>
													</div>
													<input type="email" name="email" class="form-control" value="<?php echo $email; ?>" id="paymentemail" placeholder="Email address" required>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6 my-1">
												<div class="input-group">
													<div class="input-group-prepend">
														<div class="input-group-text"><i class="ace-icon fa fa-mobile"></i></div>
													</div>
													<input type="phone" name="mobile" class="form-control" value="<?php echo $mobno; ?>" id="paymentphone" placeholder="Phone number" required>
												</div>
											</div>
											<div class="col-md-6 my-1">
												<div class="input-group">
													<div class="input-group-prepend">
														<div class="input-group-text"><i class="ace-icon fa fa-map-marker"></i></div>
													</div>
													<input type="city" name="city" class="form-control" value="Bangalore" id="paymentcity" placeholder="City" required>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6 my-1">
												<div class="input-group">
													<div class="input-group-prepend">
														<div class="input-group-text"><i class="ace-icon fa fa-globe"></i></div>
													</div>
													<input type="zipcode" name="zip_code" class="form-control" value="560001" id="paymentzipcode" placeholder="Zip Code" required>
												</div>
											</div>
											<div class="col-md-6 my-1">
												<div class="input-group">
													<div class="input-group-prepend">
														<div class="input-group-text"><i class="ace-icon fa fa-globe"></i></div>
													</div>
													<input type="text" class="form-control" name="coupon" id="coupon" value="" placeholder="Coupon Code" maxlength="60" title="Coupon Code" alt="Coupon Code" >
													<button id="couponApply" name="couponApply" type="button" class=""><span class="bigger-110">Apply</span>
											</button>
												</div>
											</div>
										</div>
										<input type="hidden" name="api_key" value="fb7c78ca-18c7-434f-b4a0-29fd9e66274a" />
										<?php
											$actual_link1 = $CONFIG->siteurl;
											$actual_link1 = $actual_link1.'mySaveTax/?module_interface=';
											//$actual_link1 = $actual_link1.$commonFunction->setPage('pay/will_payment_success');
											$actual_link1 = $actual_link1.$commonFunction->setPage('pay/paymentresponse_Will');
											$actual_link1 = $CONFIG->siteurl.'__lib.htmlPages/__preLoginPages/redirectTest.php';
											$_SESSION['return_page'] = $_POST['return_page'];
											//$failed_url = $CONFIG->siteurl.'mySaveTax/?module_interface='.$commonFunction->setPage('pay/will_payment_failure');
										?>
										<input type="hidden" name="return_url"    value="<?php echo $actual_link1; ?>" />
										<!-- <input type="hidden" name="return_url_failure"    value="<?php //echo $failed_url;?>" /> -->
										<input type="hidden" name="mode"          value="LIVE" />
										<input type="hidden" name="order_id"        value="<?php echo (int) rand(5000, 90000); ?>" />
										<input type="hidden" name="amount"    id="amount" value="<?php  echo $_POST['amount'].'.00'; ?>" /> 
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
										<br>
										<div class="clearfix">
											<button id="will_payment" name="will_payment" type="submit"
												class="width-35 pull-center btn btn-sm btn-success">
												<i class="ace-icon fa fa-key"></i> <span class="bigger-110">Proceed to Pay</span>
											</button>
											<button id="will_download_btn" name="will_download_btn" type="button"
												class="width-35 pull-center btn btn-sm btn-success" style="display: none">
												<i class="ace-icon fa fa-key"></i> <span class="bigger-110">Proceed to Download</span>
											</button>
											<div style="height: 20px;">
												<div style="display: none;" id="invalidpaymentdetails"
													class="orange">
													<strong>Invalid email found</strong>
												</div>
											</div>
										</div>
									</form>
								</div>
							</div>
							<!-- /.widget-body -->
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
	</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
		$('#couponApply').click(function(){
			$.ajax({
				url: "https://optymoney.com/__lib.ajax/ajax_response.php?action=couponcheck",
				type: "POST",
				data : JSON.stringify({"cou_code" : $('#coupon').val()}),
				success: function(response) {
					console.log(response);
					var res = JSON.parse(response);
					if(res.status==1) {
						var val = 4000-((4000*res.percent)/100);
						$('#amount').val(val);
						$('#updatedPrice').text("Pay INR "+val+".00 only");
						$('#couponStatus').text(res.msg);
						if(val==0) {
							$('#will_download_btn').show();
							$('#will_payment').hide();
						} else {
							$('#will_download_btn').hide();
							$('#will_payment').show();
						}
					} else {
						$('#couponStatus').text(res.msg);
					}
					
				}            
			});
		});

		$('#will_download_btn').click(function(e){
			e.preventDefault();
			$.ajax({
				url: "https://optymoney.com/__lib.ajax/ajax_response.php?action=proceed_to_download",
				type: "POST",
				data: JSON.stringify({"pay_status": "1","txn_id":$('#coupon').val(),"response_msg":"Transaction successful","paid_amount": "0" }),
				success: function(response) {
					console.log(response);
					window.location.href = "https://optymoney.com/mySaveTax/?module_interface=Y3JlYXRlX3dpbGw=";
				}
			});
			
			//window.location.href = "https://optymoney.com/mySaveTax/?module_interface=Y3JlYXRlX3dpbGw=";
		});
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