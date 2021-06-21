<?php
 // echo 'enc:-'.$CONFIG->encrypt;
// die();
/*include ('../__lib.ajax/post_login_response.php');
echo $res;
die();*/
// echo  $CONFIG->loggedUserEmail;
//  echo "<br>";
// echo 'password:-'. $CONFIG->encrypt;
//  echo "<br>";
//  echo 'customerid:-'.  $CONFIG->customerId;
// die();


// echo ($CONFIG->userFilesPaths);
     // echo "<pre>";print_r($_SESSION);
// print_r($profileInfo);
    $bankInfo = $customerProfile->getCustomerBankInfo();
    $bankInfos = $customerProfile->getCustomerBankInfo1();
    $custInfo = $customerProfile->getCustomerInfo($CONFIG->loggedUserId );
    // $finfo = mysqli_fetch_assoc($bankInfos);
    
     
  
    while($row = mysqli_fetch_array($bankInfos)) 
    {
    $rows[] = $row;
    }
  $res=count($rows);
$password=($custInfo['passwd']);
 // echo "Password".$password ;
// echo "<br>";


// var_dump (hash ($password));

// $encrypt=md5($password);
// echo $encrypt;
  // echo "string:-". $res;
// print_r("<br>");
// print_r($rows[0][2]);
// print_r("<br>");
// print_r($rows[0][3]);
// print_r("<br>");
// print_r($rows[0][4]);
// print_r("<br>");
// print_r($rows[1][2]);
// print_r("<br>");
// print_r($rows[1][3]);
// print_r("<br>");
// print_r($rows[1][4]);
// print_r("<br>");
    // $bankInfo = $customerProfile->getCustomerBankInfo();
    // echo $CONFIG->customerProfileImg;
     // print_r($finfo);
?>
<div class="main-content">
				<div class="main-content-inner">
					<!-- #section:basics/content.breadcrumbs -->
					<!-- <div class="breadcrumbs ace-save-state" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="?module_interface=<?php //echo $commonFunction->setPage('home');?>">Home</a>
							</li>
							<li class="active">Payment history</li>
						</ul>
						<?php //include("mdocs.lib.htmlPages/form.search.php");?>
						
					</div> -->

                    <!-- /section:basics/content.breadcrumbs -->
                    <nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="<?php echo $CONFIG->siteurl; ?>mySaveTax/">Home</a>
							</li>
							<li class="active">Payment history</li>
						</ol><!-- /.breadcrumb -->
						<?php //include("mdocs.lib.htmlPages/form.search.php");?>

						<!-- /section:basics/content.searchbox -->
                    </nav>
					<div class="page-content">						
						<div class="row">
							<div class="col-xs-12">
                            	<div class="space-4"></div><div class="space-8"></div>
								<div class="active">
									<div id="user-profile-2" class="user-profile">
										<div class="tabbable">
											<div id="tabshow">
											<ul class="nav nav-tabs padding-18" >
												<li id="profile">
													<a onclick="window.open('<?php echo $CONFIG->siteurl;?>mySaveTax/?module_interface=cHJvZmlsZQ==#home','_self')" data-toggle="tab" href="#home">
														<i class="green ace-icon fa fa-user bigger-120"></i>
														Profile
													</a>
												</li>

												<li id="Personal_Details">
													<a  data-toggle="tab" href="#feed"  onclick="window.open('<?php echo $CONFIG->siteurl;?>
													mySaveTax/?module_interface=cHJvZmlsZQ==#feed','_self')">
														<i class="orange ace-icon fa fa-book bigger-120"></i>
														Personal Details
													</a>
												</li>
                                               
												<li id="Bank_Details">
													<a  data-toggle="tab" href="#friends" onclick="window.open('<?php echo $CONFIG->siteurl;?>mySaveTax/?module_interface=cHJvZmlsZQ==#friends','_self')">
														<i  class="blue ace-icon fa fa-hdd-o bigger-120"></i>
														Bank Details
													</a>
												</li>
										

												<li id="setting">
													<a data-toggle="tab" href="#settings" onclick="window.open('<?php echo $CONFIG->siteurl;?>mySaveTax/?module_interface=cHJvZmlsZQ==#settings','_self')">
														<i class="pink ace-icon fa fa-cog bigger-120"></i>
														Settings
													</a>
												</li>
											</ul>
										</div>

											<div class="tab-content no-border padding-24">
												<div id="home" class="tab-pane in active">
													<div class="row">
														<div class="col-xs-12 col-sm-3 center"><div class="space space-12"></div>
															<span class="profile-picture">
																<img class="editable img-responsive" alt="<?php echo $CONFIG->loggedUserName; ?>" id="avatar" src="<?php echo $loggedUserImage; ?>" />
															</span>

															<div class="space space-4"></div>

															
														</div><!-- /.col -->

														<div class="col-xs-12 col-sm-9">
															<h4 class="orange">																
																<span class="label label-purple arrowed-in-right">
																	<i class="ace-icon fa fa-circle smaller-80 align-middle"></i>
																	&nbsp;<strong>A/c</strong> &nbsp; 
																</span>
                                                                <span class="middle"><?php echo $CONFIG->loggedUserName; ?></span>
															</h4>
															<div class="profile-user-info profile-user-info-striped">
												<div class="profile-info-row">
													<div class="profile-info-name"> Email </div>

													<div class="profile-info-value">
														<span class="editable" id="email"><?php echo $CONFIG->loggedUserEmail; ?></span>
													</div>
												</div>
												<div class="profile-info-row">
													<div class="profile-info-name"> Name </div>

													<div class="profile-info-value">
														<span class="editable" id="cust_name"><?php echo $profileInfo[cust_name]; ?></span>
													</div>
												</div>							
												<div class="profile-info-row">
													<div class="profile-info-name"> Alternate Email </div>

													<div class="profile-info-value">
														<span class="editable" id="alternet_email_id"><?php echo trim($profileInfo[alternet_email_id]); ?></span>
													</div>
												</div>		
                                                <div class="profile-info-row">
													<div class="profile-info-name"> Mobile </div>
													<div class="profile-info-value">
														<span class="editable" id=""><?php echo trim($profileInfo[contact_no]); ?></span>
													</div>
												</div>  										
												<div class="profile-info-row">
													<div class="profile-info-name"> Customer ID </div>
													<div class="profile-info-value">
														<span><strong><?php echo trim($profileInfo[fr_customer_id]); ?></strong></span>
													</div>
												</div>
												<div class="profile-info-row">
													<div class="profile-info-name"> Change Password </div>
													<div class="profile-info-value">
														
														<input style="border: none;" type="password" name="old_pass" class="editable" id="old_pass" placeholder="Enter old Password"  >
                                                         <button type="button" class="btn btn-primary" id="ok_button">Ok</button><br>



														<input type="hidden" name="passwd" id="passwd" value="<?php echo 
														$CONFIG->encrypt; ?>">
                                                       

                                                       <input style="border: none;display: none;" type="password" name="change_pass" class="editable" id="change_pass" placeholder="Enter New Password"><br>
                                                       
                                                      <!--  	<input style="display: none;" type="button" name="ok_button" id="ok_button1" class="btn btn-primary" value="Ok">
                                                       	<br> -->
                                                           

														<!-- <span style="display: none;" class="editable" id="change_pass">Enter New Password</span><br> -->
                                                         
                                                        <input style="border: none;display: none;" type="password" name="confirm_pass" class="editable" id="confirm_pass" placeholder="Re-Type New Password">
                                                        
                                                        <input style="display: none;" type="button" name="ok_button" id="ok_button2" class="btn btn-primary" value="Ok"><br>



													<!-- <span style="display: none;" class="editable" id="confirm_pass">Re-Type New Password</span>
													<br> -->

													</div>
												</div>
                                                <div class="profile-info-row">
													<div class="profile-info-name"> Joined </div>
													<div class="profile-info-value">
													<span><?php echo date('d-m-Y h:i:s A',strtotime($profileInfo[created_date] . ' +330 minutes')); ?></span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name"> Last Login </div>
													<div class="profile-info-value">
														<span><td><?php echo date('d-m-Y h:i:s A',strtotime($profileInfo[last_login] . ' +330 minutes')); ?></td></span>
													</div>
												</div>
											</div>

															<div class="hr hr-8 dotted"></div>															
														</div><!-- /.col -->
													</div><!-- /.row -->

													<div class="space-20"></div>

													
												</div><!-- /#home -->

												<div id="feed" class="tab-pane">
													<div id="" class="tab-pane in ">
													<div class="row">
														<div class="col-xs-12 col-sm-9">
															<h4 class="orange">																
																<span class="label label-purple arrowed-in-right">
																	<i class="ace-icon fa fa-circle smaller-80 align-middle"></i>
																	&nbsp;<strong>A/c</strong> &nbsp; 
																</span>
                                                                <span class="middle"><?php echo $CONFIG->loggedUserName; ?></span>
															</h4>

															<div class="profile-user-info profile-user-info-striped">
												<div class="profile-info-row">
													<div class="profile-info-name"> Father's Name </div>
													<div class="profile-info-value">
														<span class="editable" id="fath_name"><?php echo trim($profileInfo[father_name]); ?></span>
													</div>
												</div>
                                                <!--------------------------------update-Add-Mother-Name-Biswa-07-06-2019-START ----------->
                                                <div class="profile-info-row">
													<div class="profile-info-name"> Mother's Name </div>
													<div class="profile-info-value">
														<span class="editable" id="mother_name"><?php echo trim($profileInfo[mother_name]); ?></span>
													</div>
												</div>          
                                                <!--------------------------------update-Add-Mother-Name-Biswa-07-06-2019-END ---------->
                                                <div class="profile-info-row">
													<div class="profile-info-name"> Date Of Birth </div>
													<div class="profile-info-value">
														<span class="editable" id="dob"><?php echo trim($profileInfo[dob]); ?></span>
													</div>
												</div>                                                
                                                <div class="profile-info-row">
													<div class="profile-info-name"> Age </div>
													<div class="profile-info-value">
														<span id="calcAge"><?php if($profileInfo['dob']){ echo $customerProfile->customerAge($profileInfo['dob']); } ?></span>
													</div>
												</div>
                                                <div class="profile-info-row">
													<div class="profile-info-name"> Gender </div>
													<div class="profile-info-value">
														<span>
														<div class="radio">
													<label>
														<input type="radio" class="ace" name="form-gender-radio" onchange="ajaxCallKeyValue('sex',this.value);" value="Male"  <?php if ($profileInfo[sex] == 'Male') {echo 'checked';}?>>
														<span class="lbl"> Male</span>
													</label>
                                                    <label>
														<input type="radio" class="ace" name="form-gender-radio" onchange="ajaxCallKeyValue('sex',this.value);" value="Female"  <?php if ($profileInfo[sex] == 'Female') {echo 'checked';} ?>>
														<span class="lbl"> Female</span>
													</label>                                                    
												</div>
													</span>
													</div>
												</div>
                                                <div class="profile-info-row">
													<div class="profile-info-name"> Profession </div>
													<div class="profile-info-value">
														<span class="editable" id="profession"><?php echo trim($profileInfo[profession]); ?></span>
													</div>
												</div>  
                                                              
                                                <!------------------- update-Add-columns-Biswa-07-06-2019-START ---------------------->
                                                              
                                                <div class="profile-info-row">
													<div class="profile-info-name"> Occupation </div>
													<div class="profile-info-value">
														<span class="editable" id="occupation"><?php echo trim($profileInfo[occupation]); ?></span>
													</div>
												</div>  
                                                              
                                                <div class="profile-info-row">
													<div class="profile-info-name"> Nominee Name </div>
													<div class="profile-info-value">
														<span class="editable" id="nominee_name"><?php echo trim($profileInfo[nominee_name]); ?></span>
													</div>
												</div> 
                                                              
                                                <div class="profile-info-row">
													<div class="profile-info-name"> Nominee's Date of Birth </div>
													<div class="profile-info-value">
														<span class="editable" id="nominee_dob"><?php echo trim($profileInfo[nominee_dob]); ?></span>
													</div>
												</div> 
                                                              
                                                <div class="profile-info-row">
													<div class="profile-info-name"> Relationship of Nominee with Applicant </div>
													<div class="profile-info-value">
														<span class="editable" id="r_of_nominee_w_app"><?php echo trim($profileInfo[r_of_nominee_w_app]); ?></span>
													</div>
												</div> 
                                                              
                                                <!---------------------- update-Add-columns-Biswa-07-06-2019-END --------------------->
                                                              
												<div class="profile-info-row">
													<div class="profile-info-name"> Address </div>
													<div class="profile-info-value">
														<span class="editable" id="address1"><?php echo trim($profileInfo[address1]); ?></span>
                                                        <!--<span class="editable" id="address2"><?php echo trim($profileInfo[address2]); ?></span>-->
													</div>
												</div>
												<div class="profile-info-row">
													<div class="profile-info-name"> City </div>

													<div class="profile-info-value">
													<span class="editable" id="city1"><?php echo trim($profileInfo[city]); ?></span>
													</div>
												</div>
												<div class="profile-info-row">
													<div class="profile-info-name"> State </div>

													<div class="profile-info-value">
														<span class="editable" id="state"><?php echo trim($profileInfo[state]); ?></span>
													</div>
												</div>
												<div class="profile-info-row">
													<div class="profile-info-name"> Zip </div>

													<div class="profile-info-value">
														<span class="editable" id="pincode"><?php echo trim($profileInfo[pincode]); ?></span>
													</div>
												</div>
												<div class="profile-info-row">
													<div class="profile-info-name"> Country </div>

													<div class="profile-info-value">
														<span class="editable" id="country"><?php echo trim($profileInfo[country]); ?></span>
													</div>
												</div>
													<div class="profile-info-row">
													<div class="profile-info-name"> Nationality </div>

													<div class="profile-info-value">
														<span class="editable" id="nationality"><?php echo trim($profileInfo[nationality]); ?></span>
													</div>
												</div>
													<div class="profile-info-row">
													<div class="profile-info-name"> Tax Status </div>
													<div class="profile-info-value">
														<span class="editable" id="taxstatus"><?php echo trim($profileInfo[taxstatus]); ?></span>
													</div>
												</div>
                                                 <div class="profile-info-row">
													<div class="profile-info-name"> PAN </div>
													<div class="profile-info-value">
														<span class="editable" id="pan"><?php echo trim($profileInfo[pan_number]); ?></span>
													</div>
												</div>  
                                                 <div class="profile-info-row">
													<div class="profile-info-name"> Aadhaar No. </div>
													<div class="profile-info-value">
														<span class="editable" id="aadhar"><?php echo trim($profileInfo[aadhaar_no]); ?></span>
													</div>
												</div>  
											</div>

															<div class="hr hr-8 dotted"></div>

															
														</div><!-- /.col -->
													</div><!-- /.row -->

													<div class="space-20"></div>

													
												</div><!-- /.row -->

													<div class="space-12"></div>

													
												</div><!-- /#feed -->


												<div id="friends" class="tab-pane">
													<!-- #section:pages/profile.friends -->
													<div class="profile-users clearfix">
														<div class="row">
                                                        <h4 class="orange">																
																<span class="label label-purple arrowed-in-right">
																	<i class="ace-icon fa fa-circle smaller-80 align-middle"></i>
																	&nbsp;<strong>A/c</strong> &nbsp; 
																</span>
                                                                <span class="middle"><?php echo $CONFIG->loggedUserName; ?></span>
															</h4>
													  
                                                    <div class="col-xs-12 col-sm-9" id="bankone">
															<div class="profile-user-info profile-user-info-striped">
												<div class="profile-info-row">
													<div class="profile-info-name"> Bank Name </div>
													<div class="profile-info-value">
														<span class="editable" id="bank_name1"><?php print_r($rows[0][2]);?></span>
													</div>
												</div>
												<div class="profile-info-row">
													<div class="profile-info-name"> Account Number </div>
													<div class="profile-info-value">
														<span class="editable" id="acc_no1"><?php print_r($rows[0][3]);?></span>
													</div>
												</div>  
                                                <div class="profile-info-row">
													<div class="profile-info-name"> IFSC </div>
													<div class="profile-info-value">
														<span  class="editable" id="ifsc_code1"><?php print_r($rows[0][4]);?></span>
													</div>

												</div> 

                                                <!--<div class="profile-info-row">
													<div class="profile-info-name"> IBAN/Swift Code </div>
													<div class="profile-info-value">
														<span class="editable" id="swift_code"><?php //echo trim($bankInfo[swift_code]); ?></span>
													</div>
												</div>  
                                                <div class="profile-info-row">
													<div class="profile-info-name"> Address </div>
													<div class="profile-info-value">
														<span class="editable" id="bank_address"><?php //echo trim($bankInfo[address1]); ?></span>
													</div>
												</div>    
                                                <div class="profile-info-row">
													<div class="profile-info-name"> City </div>
													<div class="profile-info-value">
														<span class="editable" id="bank_city"><?php //echo trim($bankInfo[city]); ?></span>
													</div>
												</div>    
                                                <div class="profile-info-row">
													<div class="profile-info-name"> State </div>
													<div class="profile-info-value">
														<span class="editable" id="bank_state"><?php //echo trim($bankInfo[state]); ?></span>
													</div>
												</div>
                                                <div class="profile-info-row">
													<div class="profile-info-name"> Country </div>
													<div class="profile-info-value">
														<span class="editable" id="bank_country"><?php //echo trim($bankInfo[country]); ?></span>
													</div>
												</div>  -->                                    
											</div>
											<br>
											<button style="display: none;" class="btn btn-primary" id='addbnkone'>Add more Bank Button</button>
											
											<button style="display: none;" type="button" class="btn btn-danger" id="deletebank"  value="<?php print_r($rows[0][0]);?>">Delete</button>
                                          
											<br><br>
										</div>

									
										<!-- bank two -->

                                         <div class="col-xs-12 col-sm-9" id="banktwo" style="margin-left: 10%;display: none;">
															<div class="profile-user-info profile-user-info-striped">
												<div class="profile-info-row">
													<div class="profile-info-name"> Bank Name </div>
													<div class="profile-info-value">
														<span class="editable" id="bank_name2"><?php print_r($rows[1][2]);?></span>
													</div>
												</div>
												<div class="profile-info-row">
													<div class="profile-info-name"> Account Number </div>
													<div class="profile-info-value">
														<span class="editable" id="acc_no2"><?php print_r($rows[1][3]);?></span>
													</div>
												</div>  
                                                <div class="profile-info-row">
													<div class="profile-info-name"> IFSC </div>
													<div class="profile-info-value">
														<span class="editable" id="ifsc_code2"><?php print_r($rows[1][4]);?></span>
													</div>
												</div>    
                                                <!--<div class="profile-info-row">
													<div class="profile-info-name"> IBAN/Swift Code </div>
													<div class="profile-info-value">
														<span class="editable" id="swift_code"><?php //echo trim($bankInfo[swift_code]); ?></span>
													</div>
												</div>  
                                                <div class="profile-info-row">
													<div class="profile-info-name"> Address </div>
													<div class="profile-info-value">
														<span class="editable" id="bank_address"><?php //echo trim($bankInfo[address1]); ?></span>
													</div>
												</div>    
                                                <div class="profile-info-row">
													<div class="profile-info-name"> City </div>
													<div class="profile-info-value">
														<span class="editable" id="bank_city"><?php //echo trim($bankInfo[city]); ?></span>
													</div>
												</div>    
                                                <div class="profile-info-row">
													<div class="profile-info-name"> State </div>
													<div class="profile-info-value">
														<span class="editable" id="bank_state"><?php //echo trim($bankInfo[state]); ?></span>
													</div>
												</div>
                                                <div class="profile-info-row">
													<div class="profile-info-name"> Country </div>
													<div class="profile-info-value">
														<span class="editable" id="bank_country"><?php //echo trim($bankInfo[country]); ?></span>
													</div>
												</div>  -->                                    
											</div>
										<br>
											<br>
											<button style="display: none;" class="btn btn-primary" id='addbnktwo'>Add more Bank Button</button>
                                            <button style="display: none;" type="button" class="btn btn-danger" id="deletebank1"  value="<?php print_r($rows[1][0]);?>">Delete</button> 
										</div>


									    
                                        
										<!-- bank two end -->
										<!-- bank three -->
                                         
										 <div class="col-xs-12 col-sm-9" id="bankthree" style="margin-left: 10%;display: none;">
										 	<br>
															<div class="profile-user-info profile-user-info-striped">
												<div class="profile-info-row">
													<div class="profile-info-name"> Bank Name </div>
													<div class="profile-info-value">
														<span class="editable" id="bank_name3"><?php print_r($rows[2][2]);?></span>
													</div>
												</div>
												<div class="profile-info-row">
													<div class="profile-info-name"> Account Number </div>
													<div class="profile-info-value">
														<span class="editable" id="acc_no3"><?php print_r($rows[2][3]);?></span>
													</div>
												</div>  
                                                <div class="profile-info-row">
													<div class="profile-info-name"> IFSC </div>
													<div class="profile-info-value">
														<span class="editable" id="ifsc_code3"><?php print_r($rows[2][4]);?></span>
													</div>
												</div>    
                                                <!--<div class="profile-info-row">
													<div class="profile-info-name"> IBAN/Swift Code </div>
													<div class="profile-info-value">
														<span class="editable" id="swift_code"><?php //echo trim($bankInfo[swift_code]); ?></span>
													</div>
												</div>  
                                                <div class="profile-info-row">
													<div class="profile-info-name"> Address </div>
													<div class="profile-info-value">
														<span class="editable" id="bank_address"><?php //echo trim($bankInfo[address1]); ?></span>
													</div>
												</div>    
                                                <div class="profile-info-row">
													<div class="profile-info-name"> City </div>
													<div class="profile-info-value">
														<span class="editable" id="bank_city"><?php //echo trim($bankInfo[city]); ?></span>
													</div>
												</div>    
                                                <div class="profile-info-row">
													<div class="profile-info-name"> State </div>
													<div class="profile-info-value">
														<span class="editable" id="bank_state"><?php //echo trim($bankInfo[state]); ?></span>
													</div>
												</div>
                                                <div class="profile-info-row">
													<div class="profile-info-name"> Country </div>
													<div class="profile-info-value">
														<span class="editable" id="bank_country"><?php //echo trim($bankInfo[country]); ?></span>
													</div>
												</div>  -->                                    
											</div>
											<br>
											<button style="display: none;" class="btn btn-primary" id="addbnkthree">Add more Bank Button</button>
											<button style="display: none;" type="button" class="btn btn-danger" id="deletebank2"  value="<?php print_r($rows[2][0]);?>">Delete</button> 
										</div>

										<!-- bank three end -->
										<!-- bank four -->
										<div class="col-xs-12 col-sm-9" id="bankfour" style="margin-left: 10%;display: none;">
										 	<br>
															<div class="profile-user-info profile-user-info-striped">
												<div class="profile-info-row">
													<div class="profile-info-name"> Bank Name </div>
													<div class="profile-info-value">
														<span class="editable" id="bank_name4"><?php print_r($rows[3][2]);?></span>
													</div>
												</div>
												<div class="profile-info-row">
													<div class="profile-info-name"> Account Number </div>
													<div class="profile-info-value">
														<span class="editable" id="acc_no4"><?php print_r($rows[3][3]);?></span>
													</div>
												</div>  
                                                <div class="profile-info-row">
													<div class="profile-info-name"> IFSC </div>
													<div class="profile-info-value">
														<span class="editable" id="ifsc_code4"><?php print_r($rows[3][4]);?></span>
													</div>
												</div>    
                                                <!--<div class="profile-info-row">
													<div class="profile-info-name"> IBAN/Swift Code </div>
													<div class="profile-info-value">
														<span class="editable" id="swift_code"><?php //echo trim($bankInfo[swift_code]); ?></span>
													</div>
												</div>  
                                                <div class="profile-info-row">
													<div class="profile-info-name"> Address </div>
													<div class="profile-info-value">
														<span class="editable" id="bank_address"><?php //echo trim($bankInfo[address1]); ?></span>
													</div>
												</div>    
                                                <div class="profile-info-row">
													<div class="profile-info-name"> City </div>
													<div class="profile-info-value">
														<span class="editable" id="bank_city"><?php //echo trim($bankInfo[city]); ?></span>
													</div>
												</div>    
                                                <div class="profile-info-row">
													<div class="profile-info-name"> State </div>
													<div class="profile-info-value">
														<span class="editable" id="bank_state"><?php //echo trim($bankInfo[state]); ?></span>
													</div>
												</div>
                                                <div class="profile-info-row">
													<div class="profile-info-name"> Country </div>
													<div class="profile-info-value">
														<span class="editable" id="bank_country"><?php //echo trim($bankInfo[country]); ?></span>
													</div>
												</div>  -->                                    
											</div>
											<br>
											<button style="display: none;" class="btn btn-primary" id="addbnkfour">Add more Bank Button</button>
											<button style="display: none;" type="button" class="btn btn-danger" id="deletebank3"  value="<?php print_r($rows[3][0]);?>">Delete</button> 
										</div>

										<!-- bank four end -->
										<!-- bank five -->
										<div class="col-xs-12 col-sm-9" id="bankfive" style="margin-left: 10%;display: none;">
										 	<br>
															<div class="profile-user-info profile-user-info-striped">
												<div class="profile-info-row">
													<div class="profile-info-name"> Bank Name </div>
													<div class="profile-info-value">
														<span class="editable" id="bank_name5"><?php print_r($rows[4][2]);?></span>
													</div>
												</div>
												<div class="profile-info-row">
													<div class="profile-info-name"> Account Number </div>
													<div class="profile-info-value">
														<span class="editable" id="acc_no5"><?php print_r($rows[4][3]);?></span>
													</div>
												</div>  
                                                <div class="profile-info-row">
													<div class="profile-info-name"> IFSC </div>
													<div class="profile-info-value">
														<span class="editable" id="ifsc_code5"><?php print_r($rows[4][4]);?></span>
													</div>
												</div>    
                                                <!--<div class="profile-info-row">
													<div class="profile-info-name"> IBAN/Swift Code </div>
													<div class="profile-info-value">
														<span class="editable" id="swift_code"><?php //echo trim($bankInfo[swift_code]); ?></span>
													</div>
												</div>  
                                                <div class="profile-info-row">
													<div class="profile-info-name"> Address </div>
													<div class="profile-info-value">
														<span class="editable" id="bank_address"><?php //echo trim($bankInfo[address1]); ?></span>
													</div>
												</div>    
                                                <div class="profile-info-row">
													<div class="profile-info-name"> City </div>
													<div class="profile-info-value">
														<span class="editable" id="bank_city"><?php //echo trim($bankInfo[city]); ?></span>
													</div>
												</div>    
                                                <div class="profile-info-row">
													<div class="profile-info-name"> State </div>
													<div class="profile-info-value">
														<span class="editable" id="bank_state"><?php //echo trim($bankInfo[state]); ?></span>
													</div>
												</div>
                                                <div class="profile-info-row">
													<div class="profile-info-name"> Country </div>
													<div class="profile-info-value">
														<span class="editable" id="bank_country"><?php //echo trim($bankInfo[country]); ?></span>
													</div>
												</div>  -->                                    
											</div>
											<br>
											<button  style="display: none;" class="btn btn-primary" id="addbnkfive">Add more Bank Button</button>
											<button  style="display: none;" type="button" class="btn btn-danger" id="deletebank4"  value="<?php print_r($rows[4][0]);?>">Delete</button> 
											<input type="hidden" name="countbank" value=" <?php echo $res;?>" id="countbank">
											<input type="hidden" id="profile_password" name="profile_password" value="<?php echo $password;?>">

										</div>
										<!-- bank five end -->
													</div>
													</div>
												</div><!-- /#friends -->

												<div id="settings" class="tab-pane">
													<div class="profile-users clearfix">
														<div class="row">
                                                        <h4 class="orange">																
																<span class="label label-purple arrowed-in-right">
																	<i class="ace-icon fa fa-circle smaller-80 align-middle"></i>
																	&nbsp;<strong>A/c</strong> &nbsp; 
																</span>
                                                                <span class="middle"><?php echo $CONFIG->loggedUserName; ?></span>
															</h4>
                                                        <div class="col-xs-4 col-sm-9">															
															<div class="profile-user-info profile-user-info-striped">
												<div class="profile-info-row">
													<div class="profile-info-name"> Communication Email </div>
													<div class="profile-info-value">
														<span class="small">Default is Login id, for communication.</span>
													</div>
												</div>
												<div class="profile-info-row">
													<div class="profile-info-name"> LoginId</div>

													<div class="profile-info-value">
														<div class="radio">
													<label>
														<input checked="" type="radio" class="ace" name="form-field-radio" onchange="ajaxCallKeyValue('communication_email',this.value);" value="Permanent"  <?php if ($profileInfo[communication_email] == 'Permanent') {
                                                             echo 'checked';
                                                             } ?>>
														<span class="lbl"> <?php echo $CONFIG->loggedUserEmail; ?></span>
													</label>
												</div>
													</div>
												</div>  
												<?php 
												//echo  "rohit".isset($profileInfo['alternet_email_id']); 
												if (isset($profileInfo['alternet_email_id']) != "") 
												{	
												?>
                                                <div class="profile-info-row">
													<div class="profile-info-name"> Alternet Email Id </div>
													<div class="profile-info-value">
														<div class="radio">
													<label>
														<input type="radio" class="ace" name="form-field-radio" onchange="ajaxCallKeyValue('communication_email',this.value);" value="Alternate" <?php if ($profileInfo[communication_email] == 'Alternate') {
    															echo 'checked';
															} ?>>
														<span class="lbl"> <span><?php echo $profileInfo[alternet_email_id]; ?></span></span>
													</label>
												</div>
													</div>
												</div>  
												<?php
												}
												?>                                                
											</div>
										</div>
													</div>
													</div>
												</div><!-- /#pictures -->
											</div>
										</div>
									</div>
								</div>								
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			</div>
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/blueimp-md5/2.12.0/js/md5.js"></script>

        <script type="text/javascript">
        	
          $('#addbnkone').click(function()
        	{
        		// alert('one');
            var banknameone = $('#bank_name1').text();
            var accountnoone= $('#acc_no1').text();
            var ifsc_codeone =$('#ifsc_code1').text();

            // alert(banknameone);
            // alert(accountnoone);
            // alert(ifsc_code);
            if(banknameone =='Empty'  && accountnoon=='Empty' && ifsc_codeone=='Empty')
            {
              alert('please enter the bank details');

            }
            
           
             else 
            {
            	$('#banktwo').css('display', '');
                // alert('bank account details insert');
                $('#addbnkone').attr('hidden','true');
                $('#deletebank1').attr('hidden','true');
            	 
            	   
            }
          	 });
          </script>  
          <script type="text/javascript">
        	
          $('#addbnktwo').click(function()
          {
          	// alert('two');
          	$('#deletebank1').css('display', '');
          	$('#addbnkthree').attr('hidden','true');
          	 // alert('two');
          	var banknametwo = $('#bank_name2').text();
            var accountnotwo= $('#acc_no2').text();
            var ifsc_codetwo =$('#ifsc_code2').text();

            // alert(banknameone);
            // alert(accountnoone);
            // alert(ifsc_code);

             // $('#bankthree').css('display', '');
              if(banknametwo =='Empty'  && accountnotwo=='Empty' && ifsc_codetwo=='Empty')
            {
              alert('please enter the bank details');

            }
            
           
             else 
            {
            	$('#bankthree').css('display', '');
                // alert('bank account details insert');
                $('#addbnktwo').attr('hidden','true');
                

            	 
            }


          });
      </script>
      <script type="text/javascript">
           $('#addbnkthree').click(function()
          {
          	
          	$('#addbnkfour').attr('hidden','true');
          	
          	// alert('three');
          	var banknamethree = $('#bank_name3').text();
            var accountnothree= $('#acc_no3').text();
            var ifsc_codethree =$('#ifsc_code3').text();
              // alert(banknametwo);
              // alert(accountnotwo);
              // alert(ifsc_codetwo);
          if(banknamethree =='Empty'  && accountnothree=='Empty' && ifsc_codethree=='Empty')
            {
              alert('please enter the bank details');

            }
            
           
             else 
            {
            	$('#bankfour').css('display', '');
            
                // alert('bank account details insert');
                $('#addbnkthree').attr('hidden','true');
            	 
            }

          });
      </script>
      <script type="text/javascript">
          $('#addbnkfour').click(function()
          {
          $('#addbnkfive').attr('hidden','true');

          $('#deletebank4').attr('hidden','true');
          

          	
          	// alert('four');
          	var banknamefour = $('#bank_name4').text();
            var accountnofour= $('#acc_no4').text();
            var ifsc_codefour =$('#ifsc_code4').text();
              // alert(banknametwo);
              // alert(accountnotwo);
              // alert(ifsc_codetwo);


              if(banknamefour =='Empty'  && accountnofour=='Empty' && ifsc_codefour=='Empty')
            {
              alert('please enter the bank details');

            }
            
           
             else 
            {
            	$('#bankfive').css('display', '');
            	
                // alert('bank account details insert');
                 $('#addbnkfour').attr('hidden','true');
            	 
            }

          });
      </script>
      <script type="text/javascript">
          $('#addbnkfive').click(function()
          {
          	// alert('five');
            alert('sorry maximum limit is upto five'); 
            $('#addbnkfive').attr('hidden','true');

          });
       </script>   
<script type="text/javascript">
	$('#confirm_pass').keypress( _.debounce( function()
		{
			alert('confirm');
		}, 1));
</script>           
<script type="text/javascript">
	var params = $(location).attr('href').split("#").pop();
	// alert(params);
	if(params=='friends')
    {
    	 $('#profile').removeClass('active');
                    
         $('#home').removeClass('active');
      $('#friends').addClass('active');
      $('#Bank_Details').addClass('active'); 
      var ifsc_code1=$('#ifsc_code1').text();
      // alert(ifsc_code1);
      if(ifsc_code1!='')
      {
      	$('#deletebank').css('display', '');
      	$('#addbnkone').css('display', '');
      }
      var ifsc_code1=$('#ifsc_code2').text();
      // alert (ifsc_code1);
      if(ifsc_code1!='')
      {
           		$('#banktwo').css('display', '');
           		$('#addbnktwo').css('display', '');
           		// $('#deletebank1').css('display', '');

           		
                // alert('bank account details insert');
                
 

      	
      }
      var ifsc_code2=$('#ifsc_code2').text();
     if(ifsc_code2!='')
     {
        $('#addbnkone').attr('hidden','true');


        $('#deletebank1').css('display', '');

          
     }
     var ifsc_code3=$('#ifsc_code3').text();
     // alert(ifsc_code3);
     if(ifsc_code3!='')
     {  
             $('#addbnktwo').attr('hidden','true');
	
        
     	$('#bankthree').css('display', '');

     	
     	$('#addbnkthree').css('display', '');
     	$('#deletebank2').css('display', '');
     	
     }
      var ifsc_code4=$('#ifsc_code4').text();
     // alert(ifsc_code4);
      if(ifsc_code4!='')
      {
      	
      $('#addbnkthree').attr('hidden','true');

      $('#deletebank3').css('display', '');

      	
      $('#bankfour').css('display', '');
      $('#addbnkfour').css('display', '');
        
      }
      var ifsc_code4=$('#ifsc_code5').text();
      // alert(ifsc_code4);
      if(ifsc_code4!='')
      {
        $('#addbnkfour').attr('hidden','true');

      	
      	$('#bankfive').css('display', '');
      	
      	
      	$('#addbnkfive').css('display', '');
        $('#deletebank4').css('display', '');

      }



    }
   
</script>
<script type="text/javascript">
	$('#Bank_Details').click(function()
	{
    location.reload();

	});
</script>
<script type="text/javascript">
	$(document).ready(function() {
	var count=$('#countbank').val();
	if(count==1)
	{
		$('#deletebank').hide();
	}
	});
</script>
<script type="text/javascript">
	$('#profile').click(function()
	{
    location.reload();

	});
	
</script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/md5.js"></script>
 -->
<script type="text/javascript">
	$('#ok_button').click(function()
	{
		// $('#ok_button').hide();
	  // $('#ok_button1').css('display', '');
	   
      var old_pass=$('#old_pass').val();
      var encrypt=md5(old_pass);
       // alert(encrypt);
      // alert(old_pass);


      var old_password=$('#passwd').val();
       // alert(old_password);
      if(encrypt!=old_password)
      {
      	alert('Password Does Not Match With Old Password');
      
      	$('#confirm_pass').hide();
      }
      else
      {
      	alert('Old Password Match Enter The New Password');
      	$('#ok_button2').css('display', '');
      	$('#change_pass').css('display', '');
      	$('#confirm_pass').css('display', '');
      }

	});
</script>
<script type="text/javascript">
	$('#ok_button2').click(function()
	{
		
      var confirm_pass=$('#confirm_pass').val();
      var change_pass=$('#change_pass').val();
      // alert(confirm_pass);
      // alert(change_pass);
      if(confirm_pass!=change_pass)
      {
      	alert('New Password And Re-Type New Password Does Not Match');
      }
      else
      {
      	 $.ajax({
            type:'POST',
            url:'<?php echo $CONFIG->siteurl;?>/__lib.ajax/post_login_response.php',
            data:'confirm_pass='+confirm_pass,
             success: function(data) 
             { 
               
                location.reload(true);
                 alert('Password Successfully Updated');
             }
        });
      }
	});
</script>
<!-- <script type="text/javascript">
	$('#confirm_pass').change(function()
	{
		
		var old_password= $('#old_pass').val();
	    alert(old_password);
	    // var old_password= $('#confirm_pass').val();
	    // alert(old_password);
     //   var change_pass=$('#change_pass').val();
     //   alert(change_pass);
	});
</script> -->
<!-- <script type="text/javascript">
	var res=$('#profile_password').val();
	alert(res);

</script> -->
<!-- <script type="text/javascript">

	$('#Personal_Details').click(function()
	{
    location.reload();

	});
</script>


<script type="text/javascript">
	$('#setting').click(function()
	{
    location.reload();

	});
	
</script> -->