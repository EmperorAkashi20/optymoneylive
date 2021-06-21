<?php
	//echo "<pre>";
	//print_r($_POST);
	//print_r($_FILES);
	if($_FILES['form26asFile']['size'] > 0 && $_FILES['form26asFile']['type'] == 'application/pdf')
	{
		$filename = $commonFunction->upload('form26asFile');
		$documentFiles->addForm26AS($filename[0],$_REQUEST[formsDataID],$_REQUEST[file_pass]);
		$commonFunction->jsRedirect($CONFIG->siteurl."mySaveTax/?formsDataID=".$_REQUEST[formsDataID]."&v=26&module_interface=".$commonFunction->setPage('process_forms'));		
		//print_r($filename);
	}
	else
		$_SESSION['msg'] = 'Invalid File Type.....';
		
	$formDataFromDB = $documentFiles->getFormData($_REQUEST[formsDataID]);
	//print_r($formDataFromDB);
?>
<div class="main-content">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="<?php echo $CONFIG->siteurl;?>mySaveTax/">Home</a>
                </li>
                <li>
                    <i class="ace-icon fa fa-list list-icon"></i>
                    <a href="<?php echo $CONFIG->siteurl;?>mySaveTax/?module_interface=<?php echo $commonFunction->setPage('forms_list');?>">Uploaded Forms</a>
                </li>
                <li class="active">Fill ITR</li>
            </ul>
                <?php include("form.search.php");?>
            </div>
            <div class="page-content">						
                <div class="row">
                    <div class="col-xs-12">
                        <div class="space-4"></div>
                            <div class="tab-pane active">											
                                <div class="row">
                                    <div class="col-xs-12">
                                        <h4 class="orange">																																
                                            <span class="middle">Fill ITR</span>
                                        </h4>  
                                        <div class="hr hr-8 dotted"></div>                                              
                                    </div>
                                </div>       
                                <div class="space-20"></div>                                                                       
                                <div id="user-profile-2" class="user-profile">
                                <div class="tabbable">
                                    <ul class="nav nav-tabs padding-18">
                                        <li <?php if($_REQUEST['v'] != 26 ) { ?>class="active"<?php }?>>
                                            <a data-toggle="tab" href="#form_16_part_a">																																						
                                                    <i class="orange ace-icon fa fa-book bigger-120"></i>
                                                    <strong>FORM 16 - PART A</strong>
                                            </a>
                                        </li>
                                        <li>
                                            <a data-toggle="tab" href="#form_16_part_b">
                                                <i class="orange ace-icon fa fa-book bigger-120"></i>
                                                <strong>Form 16 - PART B</strong>
                                            </a>
                                        </li>												
                                        <li <?php if($_REQUEST['v'] == 26 ) { ?>class="active"<?php }?>>
                                            <a data-toggle="tab" href="#paid_tax">
                                                <i class="orange ace-icon fa fa-filter bigger-120"></i>
                                                <strong>Paid Taxes</strong>
                                            </a>
                                        </li>
                                        <li>
                                            <a data-toggle="tab" href="#income_source">
                                                <i class="orange ace-icon fa fa-lightbulb-o bigger-120"></i>
                                                <strong>Other Income</strong>
                                            </a>
                                        </li>
                                        <li>
                                            <a data-toggle="tab" href="#personal_info">
                                                <i class="orange ace-icon fa fa-user bigger-120"></i>
                                                <strong>Personal Info</strong>
                                            </a>
                                        </li>
                                         <li>
                                            <a data-toggle="tab" href="#fill_itr">
                                                <i class="orange ace-icon fa fa-cloud-upload  bigger-120"></i>
                                                <strong>Fill ITR</strong>
                                            </a>
                                        </li>
                                    </ul>
                                  </div>
                                  <div class="tab-content no-border padding-24">
                                        <div id="form_16_part_a" class="tab-pane in <?php if($_REQUEST['v'] != 26 ) { ?>active<?php }?>">
                                            <div class="row">
                                    <div class="col-xs-12 col-sm-12">
                                    <div class="profile-user-info profile-user-info-striped">
                                        <div class="profile-info-row">
                                            <div class="profile-info-name"> Name and Address of the Deductor </div>
                                            <div class="profile-info-value">
                                                <span><?php echo ucwords(str_replace("_"," ",str_replace("#","<br />",$formDataFromDB[0]['employer_address']))); ?></span>
                                            </div>
                                            <div class="profile-info-name"> Name and Address of the Deductee </div>
                                            <div class="profile-info-value">
                                                <span><?php echo ucwords(str_replace("_"," ",str_replace("#"," <br />",trim($formDataFromDB[0]['employee_address'])))); ?></span>
                                            </div>
                                        </div>
                                        <div class="profile-info-row">
                                            <div class="profile-info-name"> PAN of the Deductor </div>
                                            <div class="profile-info-value">
                                                <span><?php echo strtoupper(str_replace("_"," ",str_replace("#","<br />",trim($formDataFromDB[0]['deductor_pan'])))); ?></span>
                                            </div>
                                            <div class="profile-info-name"> TAN of the deductor </div>
                                            <div class="profile-info-value">
                                                <span><?php echo strtoupper(str_replace("_"," ",str_replace("#","<br />",trim($formDataFromDB[0]['deductor_tan'])))); ?></span>
                                            </div>
                                        </div>                                                
                                        <div class="profile-info-row">
                                            <div class="profile-info-name"> PAN of the deductee </div>
                                            <div class="profile-info-value">
                                                <span id="calcAge"><?php echo strtoupper(str_replace("_"," ",str_replace("#","<br />",trim($formDataFromDB[0]['employee_pan'])))); ?></span>
                                            </div>
                                            <div class="profile-info-name"> Assessment Year </div>
                                            <div class="profile-info-value">
                                                <span id="calcAge"><?php echo trim($formDataFromDB[0]['assessment_year']); ?></span>
                                            </div>
                                        </div>
                                        <div class="profile-info-row">
                                            <div class="profile-info-name"> Period </div>
                                            <div class="profile-info-value">
                                                <span id="calcAge"><?php 
                                                    preg_match('/from#(.*?)#/', $formDataFromDB[0]['period_with_employer'], $from);	
                                                    if(count($from) == 0)
                                                    {
                                                        preg_match('/from#(.*)/', $formDataFromDB[0]['period_with_employer'], $from);	
                                                        preg_match('/to#(.*?)#/', $formDataFromDB[0]['period_with_employer'], $to);
                                                    }
                                                    else
                                                    {
                                                        preg_match('/#to#(.*)/', $formDataFromDB[0]['period_with_employer'], $to);	
                                                    }
                                                    echo "From - ".strtoupper($from[1])."<br>To - ".strtoupper($to[1]); ?></span>
                                            </div>
                                    <div class="profile-info-name"> <strong>Total TDS Deposited</strong> </div>
                                    <div class="profile-info-value">
                                        <span id="calcAge"><strong>INR <?php echo number_format(trim($formDataFromDB[0]['total_tds_deposited']),2); ?></strong></span>
                                    </div>
                                </div>
                            </div>
                            </div>                                            
                        </div>
                        </div>
                        <div id="form_16_part_b" class="tab-pane in ">
                            <div class="row">
                    <div class="col-xs-12 col-sm-12">
                    <div class="profile-user-info profile-user-info-striped">
                        <div class="profile-info-row">
                            <div class="profile-info-name"> Balance (1-2) </div>
                            <div class="profile-info-value">
                                <input type="text" name="bal_1_2" id="bal_1_2" value="<?php echo number_format(str_replace("_"," ",str_replace("#","<br />",$formDataFromDB[0]['balance_1_2'])),2); ?>" readonly>
                            </div>                                                       
                        </div>
                        <div class="profile-info-row">
                            <div class="profile-info-name"> <strong>Deduction</strong><br />(i)&nbsp;Entertainment Allowance </div>
                            <div class="profile-info-value">
                                <input type="text" name="bal_1_2" id="bal_1_2" value="<?php echo number_format(str_replace("_"," ",str_replace("#"," <br />",trim($formDataFromDB[0]['ded_enter_allowance']))),2); ?>" readonly>
                            </div>                                               
                            <div class="profile-info-name">  <strong>Deduction</strong><br />                                                 
                            (ii)&nbsp;Tax on employemnet </div>
                            <div class="profile-info-value">
                                <input type="text" name="bal_1_2" id="bal_1_2" value="<?php echo number_format(str_replace("_"," ",str_replace("#"," <br />",trim($formDataFromDB[0]['ded_tax_employment']))),2); ?>" readonly>
                            </div>												    
                        </div>
                        <div class="profile-info-row">
                            <div class="profile-info-name"> <strong>Deduction</strong><br />(a)&nbsp;<strong class="red">80C</strong> </div>
                            <div class="profile-info-value">
                                <input type="text" name="sec_80_c" id="sec_80_c" value="<?php echo number_format(str_replace("_"," ",trim($formDataFromDB[0]['total_80c'])),2); ?>">
                                <?php
										$txt80cArr = explode("<br>",$formDataFromDB[0]['total_80c_txt']);
										if(0)		//count($txt80cArr) > 0
										{
								?>		
											<div class="scrollable" data-size="125">
												<div class="content">
												<table class="table table-bordered table-striped">
									<?php																	
												while(list($key,$val) = each($txt80cArr))
												{
													if($val != '')
														echo '<tr><td>'.$val.'</td></tr>';
												}											
									?>			
												</table>												
												</div>
											</div>
								<?php
									}
								?>
							</div>                                               
                            <div class="profile-info-name">  <strong>Deduction</strong><br />                                                 
                            (b)&nbsp;<strong class="red">80CCC</strong> </div>
                            <div class="profile-info-value">
                                <input type="text" name="ded_80ccc" id="ded_80ccc" value="<?php echo ucwords(str_replace("_"," ",str_replace("#"," <br />",trim($formDataFromDB[0]['ded_80ccc'])))); ?>">
                            </div>												    
                        </div>
                        <div class="profile-info-row">
                            <div class="profile-info-name"> <strong>Deduction</strong><br />(c)&nbsp;<strong class="red">80CCD</strong> </div>
                            <div class="profile-info-value">
                                <input type="text" name="ded_80ccd" id="ded_80ccd" value="<?php echo ucwords(str_replace("_"," ",str_replace("#"," <br />",trim($formDataFromDB[0]['ded_80ccd'])))); ?>">
                            </div>                                               
                            <div class="profile-info-name">  <strong>Deduction</strong><br />(d)&nbsp;<strong class="red">80CCG</strong> </div>
                            <div class="profile-info-value">
                                <input type="text" name="ded_80ccg" id="ded_80ccg" value="<?php echo ucwords(str_replace("_"," ",str_replace("#"," <br />",trim($formDataFromDB[0]['ded_80ccg'])))); ?>">
                            </div>												    
                            </div>
                            <div class="profile-info-row">
                                <div class="profile-info-name"> <strong>Deduction</strong><br />(e)&nbsp;<strong class="red">80D</strong></div>
                                <div class="profile-info-value">
                                    <input type="text" name="ded_80d" id="ded_80d" value="<?php echo number_format(str_replace("_"," ",str_replace("#"," <br />",trim($formDataFromDB[0]['ded_80d']))),2); ?>">
                                </div>                                               
                                <div class="profile-info-name">  <strong>Deduction</strong><br />(f)&nbsp;<strong class="red">80G</strong> </div>
                                <div class="profile-info-value">
                                    <input type="text" name="ded_80g" id="ded_80g" value="<?php echo ucwords(str_replace("_"," ",str_replace("#"," <br />",trim($formDataFromDB[0]['ded_80g'])))); ?>">
                                </div>												    
                            </div>
                            <div class="profile-info-row">
                                <div class="profile-info-name"> <strong>Deduction</strong><br />(g)&nbsp;Other </div>
                                <div class="profile-info-value">
                                    <input type="text" name="other_80c_1" id="other_80c_1" value="<?php echo ucwords(str_replace("_"," ",str_replace("#"," <br />",trim($formDataFromDB[0]['80c_other1'])))); ?>">
                                </div>                                               
                                <div class="profile-info-name">  <strong>Deduction</strong><br />(h)&nbsp;Other</div>
                                <div class="profile-info-value">
                                    <input type="text" name="other_80c_2" id="other_80c_2" value="<?php echo ucwords(str_replace("_"," ",str_replace("#"," <br />",trim($formDataFromDB[0]['80c_other2'])))); ?>">
                                </div>												    
                            </div>
                            <div class="profile-info-row">
                                <div class="profile-info-name"> <strong>Total Deduction</strong></div>
                                <div class="profile-info-value"><div class="space-4"></div>
                                    <span><strong>INR <?php echo number_format(($formDataFromDB[0]['total_80c']+
                                                                 $formDataFromDB[0]['ded_80ccc']+
                                                             	 $formDataFromDB[0]['ded_80ccd']+
                                                             	 $formDataFromDB[0]['ded_80ccg']+
																 $formDataFromDB[0]['ded_80d']+
																 $formDataFromDB[0]['ded_80g']),2);?></strong></span>
                                </div>   
                                <div class="profile-info-name"> <strong>Total 80c Qualifying</strong></div>
                                <div class="profile-info-value"><div class="space-4"></div>
                                    <span><strong>INR 1,50,000.00</strong></span>
                                </div>                                              													
                            </div>                                                
                        </div>
                        </div>                                            
                    </div>
                  </div>                                                
                <div id="paid_tax" class="tab-pane in <?php if($_REQUEST['v'] == 26 ) { ?>active<?php }?>">
                <div class="row">
                    <div class="col-xs-12">
                        <?php
                            if($formDataFromDB[0]['form_26_total_tds'] == '')
                            {
                        ?>
                        <div class="col-xs-3">
                             <div style="margin-top:10px;">
                             <form method="post" name="form26asform" id="form26asform" enctype="multipart/form-data">
                              <!-- <input name="form26asFile" type="file" class="btn btn-success" value="Upload Form 26AS" onchange="$('#form_26_loader').addClass('show');this.form.submit();" />-->	
                               <input name="form26asFile" type="file" class="btn btn-success" value="Upload Form 26AS" required/><br />
                               <input name="file_pass" id="file_pass" type="password" value="" placeholder="PDF Password" required/>          <br />                     			
                               <input type="hidden" name="formsDataID" id="formsDataID" value="<?php echo $_REQUEST[formsDataID]; ?>" /><br />     
                               <button type="submit"  class="btn btn-success">Upload</button>
                             </form>
                             </div>
                        </div>
                        <div class="col-xs-9 hide" id="form_26_loader">                                   				
                            <div id="fetchProgressbar" class="ui-progressbar ui-widget ui-widget-content ui-corner-all progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="87"><div id="fetchProgressbarInner" class="ui-progressbar-value ui-widget-header ui-corner-left progress-bar progress-bar-success" style="width: 77%;"><strong>Uploading Form 26AS .....</strong></div></div>
                        </div>
                      <?php
                            }
                            else
                            {
                        ?>
                        <table class="table table-bordered table-striped">
                            <thead class="thin-border-bottom">
                                <tr>
                                    <th></th>
                                    <th>Total TDS Deposited</th>
                                    <th>PAN</th>
                                    <th>Assessment Year</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tr>
                                <td>Form 16</td>
                                <td><?php echo $formDataFromDB[0]['total_tds_deposited'];?></td>
                                <td><?php echo strtoupper($formDataFromDB[0]['employee_pan']);?></td>
                                <td><?php echo $formDataFromDB[0]['assessment_year'];?></td>
                                <td><i class="ace-icon fa fa-times red"></i></td>
                            </tr>
                            <tr>
                                <td>Form 26AS</td>
                                <td><?php echo $formDataFromDB[0]['form_26_total_tds'];?></td>
                                <td><?php echo $formDataFromDB[0]['form_26_pan'];?></td>
                                <td><?php echo $formDataFromDB[0]['form_26_assess'];?></td>
                                <td><i class="ace-icon fa fa-times red"></i></td>
                            </tr>
                            <tbody>
                            </tbody>
                        </table>
                        
                        <?php
                            }
                        ?>  
                      </div>                                    	 
                </div>  
                </div>                                              
                <div id="income_source" class="tab-pane in">
                	<div class="row">
                        <div class="col-sm-8">													
                            <button class="btn btn-sm btn-inverse dropdown-toggle add_income" data-toggle="dropdown" aria-expanded="false">
                                Add Income
                                <i class="ace-icon fa fa-angle-down icon-on-right"></i>
                            </button>                                                                
                        </div>    
                         <div class="row hide" id="other_income_table">                         		
                                <div class="col-xs-12 ">         <div class="space-8"></div>	                                            
                                   <table class="table table-bordered table-striped ">
                                        <thead class="thin-border-bottom ">
                                            <tr>
                                                <th>
                                                    <i class="ace-icon fa fa-caret-right blue"></i>Sl.No.
                                                </th>
                                                <th class="">
                                                    <i class="ace-icon fa fa-caret-right blue"></i>Nature Of Income
                                                </th>
                                                <th class="">
                                                    <i class="ace-icon fa fa-caret-right blue"></i>Amount
                                                </th>
                                                <th class="">
                                                    <i class="ace-icon fa fa-caret-right blue"></i>Action
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody id="_row_condition">
                                        <?php echo $ruleHTML; ?>
                                        </tbody>
                                    </table>
                                </div>
                        </div>           
					</div>
                </div>
                                                <div id="personal_info" class="tab-pane in ">
                                                <div class="profile-user-info profile-user-info-striped">
												<div class="profile-info-row">
													<div class="profile-info-name"> Father's Name </div>
													<div class="profile-info-value">
														<input type="text" id="fath_name" value="<?php echo trim($profileInfo[father_name]); ?>" />
													</div>
												</div>
                                                <div class="profile-info-row">
													<div class="profile-info-name"> Date Of Birth </div>
													<div class="profile-info-value">
														<input type="text" id="dob" value="<?php echo trim($profileInfo[dob]); ?>" />
													</div>
												</div>                                                                                               
                                                <div class="profile-info-row">
													<div class="profile-info-name"> Gender </div>
													<div class="profile-info-value">
														<span>
														<div class="radio">
													<label>
														<input type="radio" class="ace" name="form-gender-radio" onchange="ajaxCallKeyValue('sex',this.value);" value="Male"  <?php if($profileInfo[sex] == "Male") echo "checked"; ?>>
														<span class="lbl"> Male</span>
													</label>
                                                    <label>
														<input type="radio" class="ace" name="form-gender-radio" onchange="ajaxCallKeyValue('sex',this.value);" value="Female"  <?php if($profileInfo[sex] == "Female") echo "checked"; ?>>
														<span class="lbl"> Female</span>
													</label>                                                    
												</div>
													</span>
													</div>
												</div>                                                                                           																		
												<div class="profile-info-row">
													<div class="profile-info-name"> Address </div>
													<div class="profile-info-value">
                                                    	<input type="text" id="address1" value="<?php echo trim($profileInfo[address1]); ?>" />
                                                    </div>
												</div>
												<div class="profile-info-row">
													<div class="profile-info-name"> City </div>
													<div class="profile-info-value">
                                                    <input type="text" id="city1" value="<?php echo trim($profileInfo[city]); ?>" />													
													</div>
												</div>
												<div class="profile-info-row">
													<div class="profile-info-name"> State </div>
													<div class="profile-info-value">
                                                    	<input type="text" id="state" value="<?php echo trim($profileInfo[state]); ?>" />															
													</div>
												</div>
												<div class="profile-info-row">
													<div class="profile-info-name"> Zip </div>
													<div class="profile-info-value">
                                                    	<input type="text" id="pincode" value="<?php echo trim($profileInfo[pincode]); ?>" />																
													</div>
												</div>
												<div class="profile-info-row">
													<div class="profile-info-name"> Country </div>
													<div class="profile-info-value">
                                                    	<input type="text" id="country" value="<?php echo trim($profileInfo[country]); ?>" />														
													</div>
												</div>
                                                 <div class="profile-info-row">
													<div class="profile-info-name"> PAN </div>
													<div class="profile-info-value">
                                                    	<input type="text" id="pan" value="<?php echo trim($profileInfo[pan_number]); ?>" />														
													</div>
												</div>  
                                                 <div class="profile-info-row">
													<div class="profile-info-name"> Aadhaar No. </div>
													<div class="profile-info-value">
                                                    	<input type="text" id="aadhar" value="<?php echo trim($profileInfo[aadhaar_no]); ?>" />
													</div>
												</div>  
											</div>
                                                </div>
                                                <div id="fill_itr" class="tab-pane in ">
                                                </div>
                                          </div>
                                        </div>                                                                               
                                        <div class="space-20"></div>
                                    </div>																
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			</div>