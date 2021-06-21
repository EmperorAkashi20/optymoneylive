<?php
if($_SESSION[$CONFIG->sessionPrefix.'empanel'])
 {
 ?>
 	<script>
 	alert('Thank you very much for your submission. Our team will look into the same will get back to you.');
 	</script>
 <?php
 }
 unset($_SESSION[$CONFIG->sessionPrefix.'empanel']);
?>
    <!-- banner_area_start -->
    <div class="banner_area banner_area3 business_image empanel_banner">
        <div class="anim_icon_1 amination_custom4">
            <img src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>img/icon/1.png" alt="">
        </div>
        <div class="anim_icon_2 amination_custom3">
            <img src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>img/icon/2.png" alt="">
        </div>
        <div class="anim_icon_3 amination_custom11">
            <img src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>img/icon/3.png" alt="">
        </div>
        <!-- container -->
        <div class="container">
            <div class="row">
                <div class="col-xl-8  col-lg-8">
                    <div class="banner_text">
                       <span class="wow fadeInLeft" data-wow-duration="1s" data-wow-delay=".1s" style="visibility: visible; animation-duration: 1s; animation-delay: 0.1s; animation-name: fadeInLeft;">UNLOCK the opportunities</span>
                        <h3 class="wow fadeInLeft" data-wow-duration="1s" data-wow-delay=".2s">FUEL YOURSELF &<br>
                        EMPANEL WITH OPTYMONEY</h3>
                        <div class="site_link_form slider_btn">
                         
                         <button type="submit" data-toggle="modal" data-target="#emapanel_popup" class="sign_in">Start Now</button>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- banner_Right_wrapper -->
        <div class="banner_Right_wrapper d-none d-lg-block">
            <div class="left_circle wow zoomIn" data-wow-duration="1.7s" data-wow-delay=".2s"></div>
            <div class="blue__circle_wrapper wow zoomIn" data-wow-duration="1.7s" data-wow-delay=".2s"></div>
            <div class="lite_blue_circle layer wow zoomIn" data-wow-duration="1.4s" data-wow-delay=".2s" data-depth="0.5"></div>
            <div class=" circle___img layer wow zoomIn" data-depth="0.4" data-wow-duration="1.5s" data-wow-delay="1s">
                    <img src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>img/Main-Banner-Image_1.jpg" alt="">
            </div>
            <div class="circle___wrapper layer wow zoomIn spin_circle "  data-depth="0.1"></div>
        </div>

    </div>
    <!-- banner_area_end -->
	
	
	 <!-- custom_login_from -->
    <div class="modal fade custom_login_from" id="emapanel_popup" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body ">
                    <div class="login_form">
                        <div class="login_heading">
                            <h3>EMPANEL NOW</h3>
                        </div>
                        <div class="main_content">
                      	<div class="col-lg-12 content-right" id="start">
				
				<div id="wizard_container">
				
		
						<form id="wrapped" method="POST" action="../ajax-request/ajax_response.php?action=panel" 
						onSubmit="empaneljs(this);return false;" enctype="multipart/form-data">
							<input id="website" name="website" type="text" value="">
							<!-- Leave for security protection, read docs for details -->
							<div id="middle-wizard">
								<div class="step">
									<h3 class="main_question"><strong>Step 1</strong></h3>
									<div class="form-group">
										<input type="text" name="name" class="form-control required" placeholder="Your Name" onchange="getVals(this, 'first_name');">
									</div>
									
									<div class="form-group">
										<input type="email" name="email" class="form-control required" placeholder="Your Email" onchange="getVals(this, 'email');">
									</div>
									<div class="form-group">
										<input type="tel" name="mobile_no" class="form-control required" placeholder="Mobile Number" pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}" onchange="getVals(this, 'mobile');">
									</div>
									<div class="form-group">
										<input type="text" name="city" class="form-control required" placeholder="City of Residence" onchange="getVals(this, 'residence');">
									</div>
									
									<div class="form-group">
										<div class="styled-select clearfix">
											<select class="wide required" name="gender" onchange="getVals(this, 'gender');">
												<option value="">Gender</option>
												<option value="Male">Male</option>
												<option value="Female">Female</option>
												<option value="Other">Other</option>
												                            
											</select>
										</div>
									</div>
									
									
								</div>
								<!-- /step-->
								
								<div class="step">
									<h3 class="main_question"><strong>Step 2</strong></h3>
									
									<div class="form-group">
										<div class="styled-select clearfix">
											<select class="wide required" name="education" id="edu">
												<option value="">Highest Education</option>
												<option value="ca">Chartered Accountancy</option>
												<option value="bcom">B.Com</option>
												<option value="mcom">M.Com</option>
												<option value="other">Other</option>   
											</select>
										</div>
									</div>
									<div class="form-group" id="other_q" style="display: none">
										<input type="text" name="other_q"  class="form-control" placeholder="Enter Your Qualification">
									</div>
								
									<div class="form-group  add_top_30">
										<label>Year of Highest Qualification </label>
										<input type="number" name="high_q_r" class="form-control" min="1999" max="2099" step="1" value="2020" placeholder="Year of Highest Qualification" />
									</div>
									<div class="form-group">
										<div class="styled-select clearfix">
											<select class="wide required" name="interest" onchange="getVals(this, 'Expertise');">
												<option value="">Expertise/Interest </option>
												<option value="Direct Taxation">Direct Taxation</option>
												<option value="Indirect Taxation">Indirect Taxation</option>
												<option value="Stock, Mutual Funds and Portfolio Management">Stock, Mutual Funds and Portfolio Management</option>
												<option value="Other">Other</option>
												                            
											</select>
										</div>
									</div>
									
									<div class="form-group">
										<div class="styled-select clearfix">
											<select class="wide required" name="training" onchange="getVals(this, 'training');">
												<option value="">Have you ever conducted any training </option>
												<option value="Yes">Yes</option>
												<option value="No">No</option>
												
												                            
											</select>
										</div>
									</div>
								</div>
								<!-- /step-->
								<div class="submit step">
									<h3 class="main_question"><strong>Step 3</strong></h3>
									
									
								
									
									<div class="form-group add_top_30">
										<label>Tell about yourself (Optional)</label>
										<textarea name="about_yourself" class="form-control" style="height:150px;" placeholder="Tell about yourself..." onkeyup="getVals(this, 'tell_about_yourself');"></textarea>
									</div>
									<div class="form-group add_top_30">
										<label>Upload your profile/one pager (optional)<br><small>(Files accepted: .docx, .doc, .pdf)</small></label>
										<div class="fileupload">
											<input type="file" name="cv" accept="image/*,.pdf" onchange="getVals(this, 'fileupload');">
										</div>
									</div>
									<div id="pass-info" class="clearfix"></div>
								</div>
								
							</div>
							<!-- /middle-wizard -->
							<div id="bottom-wizard">
								<button type="button" name="backward" class="backward">Prev</button>
								<button type="button" name="forward" class="forward">Next</button>
								<button type="submit" name="process" value="empanel" class="submit">Submit</button>
							</div>
							<!-- /bottom-wizard -->
						</form>
					</div>
					<!-- /Wizard container -->
			</div>
			<!-- /content-right-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!--/ custom_login_from -->
   