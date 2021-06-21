

<body class="">
    <!-- bradcam_area  -->
    <div class="bradcam_area bradcam_bg_5">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="bradcam_text text-center">
                        <h3 class="wow fadeInUp" data-wow-duration="1s" data-wow-delay=".1s">Reset password</h3>
                        <p class="wow fadeInUp" data-wow-duration="1s" data-wow-delay=".1s"><a href="index.html">Home</a> / Reset password</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ bradcam_area -->
    <div class="reset_password">
        <div class="container">
    <h3>Reset Password</h3>
 <form class="loginForm" role="form" method="post" action="ajax-request/ajax_response.php?action=doChangePassword&amp;subaction=loginSubmit" onsubmit="resetpasswordJS(this);return false;" name="login_frm" accept-charset="UTF-8" id="login-nav">
									<fieldset>
										
											<div class="single_input">
												<input type="email" name="resetemail" class="form-control form-control-lg" id="resetemail" placeholder="Email address" required=""> 
											</div>
									
									<div class="single_input">
										<input type="password" id="reset_passwd" name="reset_passwd" class="form-control form-control-lg required" placeholder="New Password" required=""> 
									</div>
								
							
								<div class="single_input">
										<input type="password" id="resrepasswd" name="resrepasswd" class="form-control form-control-lg  required" placeholder="Confirm Password" required=""> 
									
									</div> 
                                        
                                        <input type="hidden" id="resetcode" name="resetcode" class="form-control form-control-lg " placeholder="Code" required="">
									

										<div class="clearfix">
											<button id="loginFrm" name="loginFrm" type="submit" class="boxed_btn3 w-100">
												<i class="ace-icon fa fa-key"></i> <span class="bigger-110">Reset Password</span>
											</button>
											<div style="height: 30px;">
												<div style="display: none;" id="signup_loader">
													<img src="static/img/formsubmitpreloader.gif">
												</div>
												<div style="display: none;" id="resetfailed" class="orange">
													<strong>Could not reset password. Please ensure you use the link from the received e-mail.</strong>
												</div>
											</div>

										</div>


									</fieldset>
								</form>
   </div>
</div>

