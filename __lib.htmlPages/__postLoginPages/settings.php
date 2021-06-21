<?php
    $bankInfo = $customerProfile->getCustomerBankInfo();
    // echo "<br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
    //print_r($bankInfo);
    $bankInfos = $customerProfile->getCustomerBankInfo1();
    //print_r($bankInfos);
    $custInfo = $customerProfile->getCustomerInfo($CONFIG->loggedUserId );
    //print_r($custInfo);
?>
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">
   <div class="page-content settingspage">
      <!-- end page title end breadcrumb -->
      <div class="page-content-wrapper">
         <div class="container-fluid">
            <div class="row">
               <div class="col-md-3 mb-3">
                  <div class="card">
                     <div class="card-body">
                        <!-- User Profile Image -->
                        <div class="profile">
                           <img src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>img/avatar.svg"> 
                           <div class="overlay">
                              <input type="file" name="profile_pic">
                              <p>Upload Picture</p>
                           </div>
                        </div>
                        <h3 class="profilename"><?= $custInfo[cust_name]; ?></h3>
                        <ul class="nav nav-pills flex-column" id="myTab" role="tablist">
                           <li class="nav-item">
                              <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Basic Details</a>
                           </li>
                           <!-- <li class="nav-item">
                              <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Change Password</a>
                           </li> -->
                           <li class="nav-item">
                              <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Bank Accounts</a>
                           </li>
                           <!-- <li class="nav-item">
                              <a class="nav-link" id="mygoals-tab" data-toggle="tab" href="#mygoals" role="tab" aria-controls="mygoals" aria-selected="false">My Goals</a>
                           </li> -->
                        </ul>
                     </div>
                  </div>
               </div>
               <!-- /.col-md-4 -->
               <div class="col-md-9">
                  <div class="tab-content" id="myTabContent">
                     <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <form method="POST" action="../../ajax-request/ajax_response.php?action=settinginfo&subaction=submit" onSubmit="submitinfo(this);return false;">
                           <div class="row mt-4">
                              <div class='col-md-6'>
                                 <div class="form-group">
                                    <label class="form-label">Full Name<span class="required">*</span></label>
                                    <input type="text" class="form-control" name="cust_name" id="cust_name" value="<?= $custInfo[cust_name]; ?>">
                                 </div>
                                 <div class="form-group">
                                    <label class="form-label">Father Name<span class="required">*</span></label>
                                    <input type="text" class="form-control" name="father_name" id="father_name" value="<?= $custInfo[father_name]; ?>">
                                 </div>
                                 <div class="form-group">
                                    <label class="form-label">Date of Birth<span class="required">*</span></label>
                                    <input type="date" name="birthday" class="form-control" value="<?= $custInfo[dob]; ?>">
                                 </div>
                                 <div class="form-group">
                                    <label class="form-label">Gender<span class="required">*</span></label>
                                    <select class="wide required form-control" name="sex" id="sex">
                                       <option value="">Gender </option>
                                       <option value="Male" <?=$custInfo['sex'] == 'Male' ? ' selected="selected"' : '';?>>Male</option>
                                       <option value="Female" <?=$custInfo['sex'] == 'Female' ? ' selected="selected"' : '';?>>Female</option>
                                    </select>
                                 </div>
                                 <div class="form-group">
                                    <label class="form-label">Mobile Number<span class="required">*</span></label>
                                    <input type="tel" class="form-control" disabled="disabled" placeholder="Mobile Number" value="<?= $custInfo[contact_no]; ?>">
                                 </div>
                                 <div class="form-group">
                                    <label class="form-label">Email<span class="required">*</span></label>
                                    <input type="email" class="form-control" disabled="disabled" placeholder="Email ID"  value="<?= $custInfo[login_id]; ?>">
                                 </div>
                                 <div class="form-group">
                                    <label class="form-label">PAN Number<span class="required">*</span></label>
                                    <input type="text" class="form-control" name="pan" placeholder="PAN" value="<?= $custInfo[pan_number]; ?>">
                                 </div>
                                 <div class="form-group">
                                    <label class="form-label">Aadhaar Card<span class="required">*</span></label>
                                    <input type="text" class="form-control" name="adhar_num" placeholder="Adhar Card Number" value="<?= $custInfo[aadhaar_no]; ?>">
                                 </div>
                              </div>
                              <div class='col-md-6'>
                                 <div class="form-group">
                                    <label class="form-label">Address Line 1<span class="required">*</span></label>
                                    <input type="text" name="line1" id="line1" class="form-control required" placeholder="Line 1" value="<?= $custInfo['address1']; ?>">
                                 </div>
                                 <div class="form-group">
                                    <label class="form-label">Address Line 2<span class="required">*</span></label>
                                    <input type="text" name="line2" id="line2" class="form-control" placeholder="Line 2" value="<?= $custInfo['address2']; ?>">
                                 </div>
                                 <div class="form-group">
                                    <label class="form-label">Address Line 3</label>
                                    <input type="text" name="line3" id="line3" class="form-control" placeholder="Line 3" value="<?= $custInfo['address3']; ?>">
                                 </div>
                                 <div class="form-group">
                                    <label class="form-label">City<span class="required">*</span></label>
                                    <input type="text" name="city" id="city" class="form-control required" placeholder="City" value="<?= $custInfo['city']; ?>">
                                 </div>
                                 <div class="form-group">
                                    <label class="form-label">State<span class="required">*</span></label>
                                    <div class="styled-select clearfix">
                                       <select name="state" id="state" class="wide required form-control" >
                                          <option value="AN" <?=$custInfo['state'] == 'AN' ? ' selected="selected"' : '';?>>Andaman and Nicobar Islands</option>
                                          <option value="AR" <?=$custInfo['state'] == 'AR' ? ' selected="selected"' : '';?>>Andhra Pradesh</option>
                                          <option value="AP" <?=$custInfo['state'] == 'AP' ? ' selected="selected"' : '';?>>Arunachal Pradesh</option>
                                          <option value="AS" <?=$custInfo['state'] == 'AS' ? ' selected="selected"' : '';?>>Assam</option>
                                          <option value="BH" <?=$custInfo['state'] == 'BH' ? ' selected="selected"' : '';?>>Bihar</option>
                                          <option value="CH" <?=$custInfo['state'] == 'CH' ? ' selected="selected"' : '';?>>Chandigarh</option>
                                          <option value="CG" <?=$custInfo['state'] == 'CG' ? ' selected="selected"' : '';?>>Chhattisgarh</option>
                                          <option value="DN" <?=$custInfo['state'] == 'DN' ? ' selected="selected"' : '';?>>Dadar and Nagar Haveli</option>
                                          <option value="DD" <?=$custInfo['state'] == 'DD' ? ' selected="selected"' : '';?>>Daman and Diu</option>
                                          <option value="GO" <?=$custInfo['state'] == 'GO' ? ' selected="selected"' : '';?>>GOA</option>
                                          <option value="GU" <?=$custInfo['state'] == 'GU' ? ' selected="selected"' : '';?>>Gujarat</option>
                                          <option value="HA" <?=$custInfo['state'] == 'HA' ? ' selected="selected"' : '';?>>Haryana</option>
                                          <option value="HP" <?=$custInfo['state'] == 'HP' ? ' selected="selected"' : '';?>>Himachal Pradesh</option>
                                          <option value="JM" <?=$custInfo['state'] == 'JM' ? ' selected="selected"' : '';?>>Jammu and Kashmir</option>
                                          <option value="JK" <?=$custInfo['state'] == 'JK' ? ' selected="selected"' : '';?>>Jharkhand</option>
                                          <option value="KA" <?=$custInfo['state'] == 'KA' ? ' selected="selected"' : '';?>>Karnataka</option>
                                          <option value="KE" <?=$custInfo['state'] == 'KE' ? ' selected="selected"' : '';?>>Kerala</option>
                                          <option value="LD" <?=$custInfo['state'] == 'LD' ? ' selected="selected"' : '';?>>Lakshadweep</option>
                                          <option value="MP" <?=$custInfo['state'] == 'MP' ? ' selected="selected"' : '';?>>Madhya Pradesh</option>
                                          <option value="MA" <?=$custInfo['state'] == 'MA' ? ' selected="selected"' : '';?>>Maharashtra</option>
                                          <option value="MN" <?=$custInfo['state'] == 'MN' ? ' selected="selected"' : '';?>>Manipur</option>
                                          <option value="ME" <?=$custInfo['state'] == 'ME' ? ' selected="selected"' : '';?>>Meghalaya</option>
                                          <option value="MI" <?=$custInfo['state'] == 'MI' ? ' selected="selected"' : '';?>>Mizoram</option>
                                          <option value="ND" <?=$custInfo['state'] == 'ND' ? ' selected="selected"' : '';?>>New Delhi</option>
                                          <option value="NA" <?=$custInfo['state'] == 'NA' ? ' selected="selected"' : '';?>>Nagaland</option>
                                          <option value="OR" <?=$custInfo['state'] == 'OR' ? ' selected="selected"' : '';?>>Odisha</option>
                                          <option value="PO" <?=$custInfo['state'] == 'PO' ? ' selected="selected"' : '';?>>Pondicherry</option>
                                          <option value="PU" <?=$custInfo['state'] == 'PU' ? ' selected="selected"' : '';?>>Punjab</option>
                                          <option value="RA" <?=$custInfo['state'] == 'RA' ? ' selected="selected"' : '';?>>Rajasthan</option>
                                          <option value="SI" <?=$custInfo['state'] == 'SI' ? ' selected="selected"' : '';?>>Sikkim</option>
                                          <option value="TN" <?=$custInfo['state'] == 'TN' ? ' selected="selected"' : '';?>>Tamil Nadu</option>
                                          <option value="TG" <?=$custInfo['state'] == 'TG' ? ' selected="selected"' : '';?>>Telangana</option>
                                          <option value="TR" <?=$custInfo['state'] == 'TR' ? ' selected="selected"' : '';?>>Tripura</option>
                                          <option value="UP" <?=$custInfo['state'] == 'UP' ? ' selected="selected"' : '';?>>Uttar Pradesh</option>
                                          <option value="UC" <?=$custInfo['state'] == 'UC' ? ' selected="selected"' : '';?>>Uttaranchal</option>
                                          <option value="WB" <?=$custInfo['state'] == 'WB' ? ' selected="selected"' : '';?>>West Bengal</option>
                                       </select>
                                    </div>
                                 </div>
                                 <div class="form-group">
                                    <label class="form-label">PIN Code<span class="required">*</span></label>
                                    <input type="number" name="pincode" id="pincode" class="form-control required" placeholder="Pin Code" min="100000" max="999999" value="<?= $custInfo['pincode']; ?>">
                                 </div>
                                 <div class="form-group">
                                    <label class="form-label">Country<span class="required">*</span></label>
                                    <input type="text" class="form-control" name="country" placeholder="Enter Country Name" value="<?= $custInfo[country]; ?>">
                                 </div>
                              </div>
                           </div>
                           <div class="row align-items-center mt-4">
                              <div class='col-md-6'>
                                 <div class="form-group">
                                    <label class="form-label">Nominee Name<span class="required">*</span></label>
                                    <input type="text" name="nominee" id="nominee" class="form-control required" placeholder="Nominee Name" value="<?= $custInfo['nominee_name']; ?>">
                                 </div>
                              </div>
                              <div class='col-md-6'>
                                 <div class="form-group">
                                    <label class="form-label">Nominee Relationship<span class="required">*</span></label>
                                    <div class="styled-select clearfix">
                                       <select class="wide required form-control" name="r_of_nominee_w_app" id="r_of_nominee_w_app">
                                          <option value="">Nominee Relationship</option>
                                          <option value="Father" <?=$custInfo['r_of_nominee_w_app'] == 'Father' ? ' selected="selected"' : '';?>>Father</option>
                                          <option value="Mother" <?=$custInfo['r_of_nominee_w_app'] == 'Mother' ? ' selected="selected"' : '';?>>Mother</option>
                                          <option value="Brother" <?=$custInfo['r_of_nominee_w_app'] == 'Brother' ? ' selected="selected"' : '';?>>Brother</option>
                                          <option value="Sister" <?=$custInfo['r_of_nominee_w_app'] == 'Sister' ? ' selected="selected"' : '';?>>Sister</option>
                                          <option value="Spouse" <?=$custInfo['r_of_nominee_w_app'] == 'Spouse' ? ' selected="selected"' : '';?>>Spouse</option>
                                          <option value="Son" <?=$custInfo['r_of_nominee_w_app'] == 'Son' ? ' selected="selected"' : '';?>>Son</option>
                                          <option value="Daughter" <?=$custInfo['r_of_nominee_w_app'] == 'Daughter' ? ' selected="selected"' : '';?>>Daughter</option>
                                       </select>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="row mt-4">
                              <div class="col-md-12 text-center">
                                 <button type="submit" name="update_info" class="btn btn-primary" id="updateBasic">Update</button>
                              </div>
                           </div>
                        </form>
                     </div>
                     <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                        <div class="row">
                           <div class="col-xl-12" id="bnkacAddWrap">
                              <div class="table-responsive mt-2">
                                 <a href="#bankAccountModal"  id="addBankAcModal" class="btn btn-danger-rect float-right add" data-toggle="modal"><i class="fa fa-plus" aria-hidden="true"></i><span>Add Bank Account</span></a>
                                 <table class="table table-striped table-bordered dt-responsive nowrap" id="bankAccountsTable" style="width: 100%;">
                                    <thead class="thead-light">
                                       <tr>
                                          <th>Bank Name</th>
                                          <th>A/c Number</th>
                                          <th>IFSC Code</th>
                                          <th>Mandate Id</th>
                                          <th>Actions</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       
                                    </tbody>
                                    <tfoot class="thead-light">
                                       <tr>
                                          <th>Bank Name</th>
                                          <th>A/c Number</th>
                                          <th>IFSC Code</th>
                                          <th>Mandate Id</th>
                                          <th>Actions</th>
                                       </tr>
                                    </tfoot>
                                 </table>
                              </div>
                           </div>
                        </div>
                        <div id="bankAccountModal" class="modal fade">
                           <div class="modal-dialog modal-lg">
                              <div class="modal-content">
                                 <form data-formType="1" name="addBankAccount" id="addBankAccount" action="<?= $CONFIG->siteurl; ?>./__lib.ajax/ajax_response.php" method="post" class="frmCurrent has-validation-callback">
                                    <div class="modal-header">						
                                       <h4 class="modal-title">Add Bank Account</h4>
                                       <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    </div>
                                    <div class="modal-body">					
                                       <div class="row">
                                          <div class="col">
                                             <label>Bank Name</label>
                                             <input type="text" name="bank_name" id="bank_name" class="form-control" value="" placeholder="Bank Name">
                                          </div>
                                          <div class="col">
                                             <label>Account Number</label>
                                             <input type="text" name="acc_no" id="acc_no" class="form-control" value="" placeholder="Bank Account Number">
                                          </div>
                                          <div class="col">
                                             <label>IFSC Code</label>
                                             <input type="text" name="ifsc_code" id="ifsc_code" class="form-control" value="" placeholder="IFSC Code">
                                          </div>
                                       </div>
                                    </div>
                                    <div class="modal-footer">
                                       <button class="btn btn-danger btn-sm save" style="color:white" data-role="update" data-id="" data-table="will_bank_accounts" data-key="pk_bk_id">Save</button>
                                       <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                                    </div>
                                 </form>
                              </div>
                           </div>
                        </div>
                     </div>
                     <!-- <div class="tab-pane fade" id="mygoals" role="tabpanel" aria-labelledby="mygoals-tab">
                        <div class="card">
                           <div class="card-header p-3">
                              <h5 class="card-title"> Upload Selfie </h5>
                              <p>Write your Goal on paper or add Sticker to your photo, make it as creative and upload.</p>
                           </div>
                           <div class="card-body">
                              <div class="row">
                                 <div class="col-md-4 mb-3">
                                    <form method="POST" action="../../ajax-request/ajax_response.php?action=upload_my_selfie&subaction=submit" method="post" name="selfieForm" id="selfieForm" enctype="multipart/form-data">
                                       <div class="row align-items-center mt-4">
                                          <div class='col-md-12'>
                                             <div class="form-group">
                                                <div class="upload-btn-wrapper">
                                                   <button class="btns" id="uploadBtnText">PHOTO UPLOAD (JPG/PNG)</button>
                                                   <input type="file" name="par_myphoto" id="par_myphoto"/>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="row mt-4">
                                          <div class="col-md-12 text-center">
                                             <button type="submit" name="uploadSelfie" class="btn btn-primary" id="uploadSelfie">Upload</button>
                                          </div>
                                       </div>
                                    </form>
                                    <div id="evf_success"></div>
                                 </div>
                                 <div class="col-md-8 mb-3"> 
                                    <?php
                                       $sql1 = "SELECT * FROM mygoal_details WHERE user_id = '".$CONFIG->loggedUserId."' and campaign_code = 'mygoal'";
                                       $res = $db->db_run_query($sql1);
                                       if($db->db_num_rows($res) > 0) {
                                          while($row = $db->db_fetch_assoc($res)) { 
                                    ?>
                                       <img src="<?php echo $CONFIG->siteurl;?><?php echo $CONFIG->userFilesURL . $CONFIG->mycampaign . $CONFIG->loggedUserId."/"; ?><?php echo $row["par_myphoto"]; ?>">
                                    <?php } } ?>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div> -->
                  </div>
               </div>
               <!-- /.col-md-8 -->
            </div>
         </div>
         <!-- /.container -->
      </div>
      <!-- end container-fluid -->
   </div>
   <!-- end page-content-wrapper -->
</div>
</div>