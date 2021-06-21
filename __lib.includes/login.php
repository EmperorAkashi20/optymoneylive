        
 <!-- Login Form -->
    <div class="modal fade custom_login_from" id="login_form" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body ">
                    <div class="login_form">
                        <div class="login_heading">
                             <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h3>Login</h3>
                        </div>
                        <div class="main_content">
                           
                            <form class="login" role="form" method="post"
									action="ajax-request/ajax_response.php?action=doLogin&subaction=loginSubmit"
									onSubmit="loginJS(this);return false;" name="login_frm"
									accept-charset="UTF-8" id="login-nav">
                                
                                <div class="single_input">
                                    <input type="email" name="email" placeholder="Email Address" >
                                </div>
                                <div class="single_input">
                                    <input type="password" name="passwd" placeholder="Password" >
                                </div>
                                <div class="login_button">
                                    <button class="boxed_btn3 w-100" type="submit">Login</button>
                                </div>
                                <div class="forgot_pass">
                                    <p><a href="#" class="sign_in" data-toggle="modal" data-target="#forgot_password" data-dismiss="modal">Forget Password?</a></p>
                                    <p>Don't have an account? <a class="sign_in" data-toggle="modal" data-target="#signupp" href="#" data-dismiss="modal">Sign Up</a></p>
                                </div>
                            </form>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!--/ Login Form -->

 <!-- Forgot Password -->
    <div class="modal fade custom_login_from" id="forgot_password" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body ">
                    <div class="login_form">
                        <div class="login_heading">
                             <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h3>Reset Password</h3>
                        </div>
                        <div class="main_content">
                           
                            <form class="login" action="ajax-request/ajax_response.php?action=doResetPassword&subaction=submit"
							method="post" name="reset_frm" id="reset_frm" onSubmit="doResetPasswordJS(this);return false;">

                                
                                <div class="single_input">
                                    <input type="email" name="reset_email" placeholder="Email Address" >
                                </div>
                                <div class="input-group input-group-unstyled">
                                    <input type="text" id="reset_sec_code" name="reset_sec_code" class="form-control required" placeholder="Security Code"
                                            required /> 
                                </div>
                                <br>
                                <img src="__lib.apis/captcha/securimage_show.php?tt=" style="border: 1px dotted #FFBF00" id="resetverifyCaptcha" />
                                <br>
                                <!-- <br><a id="reloadcaptcharessetpassword">Reload Security Code</a><br> -->
                                
                                <div class="login_button">
                                    <button class="boxed_btn3 w-100" type="submit">Reset Password</button>
                                </div>
                                <div style="display: none;" id="reset_invalid_email"
                                            class="orange">
                                            <strong>Invalid email.</strong>
                                        </div>
                                <div class="forgot_pass">
                                    <p><a class="sign_in" data-toggle="modal" data-target="#login_form" href="#" data-dismiss="modal">Click here to login</a></p>
                                    <p>Don't have an account? <a class="sign_in" data-toggle="modal" data-target="#signupp" href="#" data-dismiss="modal">Sign Up</a></p>
                                </div>
                            </form>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!--/ Forgot Password -->

 <!-- signup -->
    <div class="modal fade custom_login_from" id="signupp" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body ">
                    <div class="login_form">
                        <div class="login_heading">
                             <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h3>Sign Up</h3>
                        </div>
                        <div class="main_content">
                            <div style="display: none;" id="signup_invalid_mob" class="orange text-center"> <strong>Please enter a valid mobile number to request OTP.</strong> </div>
                            <div style="display: block;" id="signup_invalid_mob" class="orange"></div>
                            <form class="login"	action="ajax-request/ajax_response.php?action=doSignup&subaction=submit"
										method="post" name="signup_frm" id="signup_frm"
										onSubmit="signupJSnew(this);return false;">
                                <div class="single_input">
                                    <input type="text" id="name" name="name" placeholder="Name" >
                                </div>
                                <div class="single_input">
                                    <input type="email" id="email" name="email" placeholder="Enter your email" >
                                </div>
                                <div class="single_input">
                                    <input type="tel" id="mobile" name="mobile" placeholder="Phone Number" >
                                </div>
                                <div class="single_input">
                                    <input type="text" id="otp" name="otp" placeholder="Enter OTP" >
                                </div>
                                <div class="login_button">
                                    <button class="boxed_btn3 w-100" id="otpFrm" name="otpFrm" onclick="sendOTPJS(this)" type="submit">Request OTP</button>
                                </div>
                                <div class="single_input">
                                    <input type="password" id="reg_passwd" name="reg_passwd" placeholder="Password" >
                                </div>
                                 <div class="single_input">
                                    <input type="password" id="repasswd" name="repasswd" placeholder="Confirm Password" >
                                </div>
                                <div class="login_button">
                                    <button class="boxed_btn3 w-100" type="submit">Submit</button>
                                </div>
                                 <div class="forgot_pass">
                                    <p><a class="sign_in" data-toggle="modal" data-target="#login_form" href="#" data-dismiss="modal">Click here to login</a></p>
                                </div>
                            </form>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

