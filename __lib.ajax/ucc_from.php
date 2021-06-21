<?php $ucc_data = $customerProfile->ucc_check(); 
   if($_GET[err]) {
      echo '<script>alert("'.$_GET[err].'")</script>'; 
   } else {
      //echo '<script>alert("hi")</script>'; 
   }
?>
<div class="ucc_login">
   <!-- Ucc -->
   <div class="container">
      <div class="section-title">
            <h5 class="wow fadeInUp" data-wow-duration="1s" data-wow-delay=".1s">Lets Start the KYC updation!</h5>
      </div>
      <br>
      <div class="page-title-box-error" id="errorDisplay">
         <div class="container-fluid">
            <div class="row align-items-center">
               <div class="col-md-12 text-center">
                  <h4 class="page-title mb-1"  style="color: #D33633"> <?php echo $_GET[err]; ?></h4>
               </div>
            </div>
         </div>
      </div>
      <div class="text-center">
         <p>Documents Required For Updation: 1. PAN Copy               2. Aadhar Copy 3. Cancelled Cheque or Bank Passbook             4. Picture of Your Signature</p>
         <p>(All documents to be Self Attested)</p>
      </div>
      <div class="col-lg-12 content-right" id="start">
         <div id="wizard_container">
            <form name="uccform" id="wrapped" method="post" action="<?= $CONFIG->siteurl ?>ajax-request/mutual_fund.php">
               <input id="website" name="website" type="text" value="">
               <!-- Leave for security protection, read docs for details -->
               <div id="middle-wizard">
                  <div class="row">
                     <div class='col-md-3'>
                        <h3 class="main_question"><strong>Investor Details</strong></h3>
                        <div class="form-group">
                           <label class="form-label">Name of the Investor<span class="required">*</span></label>
                           <input type="text" name="first_name" id="first_name" class="form-control required" disabled="disabled" value="<?= $ucc_data['cust_name']; ?>">
                        </div>
                        <div class="form-group">
                           <label class="form-label">Gender<span class="required">*</span></label>
                           <div class="styled-select clearfix">
                              <select class="wide required form-control" name="gender" id="gender">
                                 <option value="">Gender </option>
                                 <option value="Male" <?=$ucc_data['sex'] == 'Male' ? ' selected="selected"' : '';?>>Male</option>
                                 <option value="Female" <?=$ucc_data['sex'] == 'Female' ? ' selected="selected"' : '';?>>Female</option>
                              </select>
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="form-label">PAN Number<span class="required">*</span></label>
                           <input class="panumber form-control required" name="pan" id="pan" type="text" placeholder="Eg: ABCDE 1234 F" autocomplete="on" value="<?= $ucc_data['pan_number']; ?>">
                        </div>
                        <div class="form-group">
                           <label class="form-label">Date of Birth<span class="required">*</span></label>
                           <input type="date" id="birthday" class="form-control required" name="birthday" min="1920-12-31" max="<?php echo date("Y")-18; ?>-12-31" value="<?= $ucc_data['dob']; ?>">
                        </div>
                        <div class="form-group">
                           <label class="form-label">Email<span class="required">*</span></label>
                           <input type="email" name="email" id="email" class="form-control" disabled="disabled" value="<?= $ucc_data['login_id']; ?>">
                        </div>
                        <div class="form-group">
                           <label class="form-label">Mobile Number<span class="required">*</span></label>
                           <input type="tel" name="tel" id="tel" class="form-control required" value="<?= $ucc_data['contact_no']; ?>">
                        </div>
                     </div>
                     <div class='col-md-3'>
                        <h3 class="main_question"><strong>Address/ Communication Details</strong></h3>
                        <div class="form-group">
                           <label class="form-label">Address Line 1<span class="required">*</span></label>
                           <input type="text" name="line1" id="line1" class="form-control required" placeholder="Line 1" value="<?= $ucc_data['address1']; ?>">
                        </div>
                        <div class="form-group">
                           <label class="form-label">Address Line 2<span class="required">*</span></label>
                           <input type="text" name="line2" id="line2" class="form-control" placeholder="Line 2" value="<?= $ucc_data['address2']; ?>">
                        </div>
                        <div class="form-group">
                           <label class="form-label">Address Line 3</label>
                           <input type="text" name="line3" id="line3" class="form-control" placeholder="Line 3" value="<?= $ucc_data['address3']; ?>">
                        </div>
                        <div class="form-group">
                           <label class="form-label">City<span class="required">*</span></label>
                           <input type="text" name="city" id="city" class="form-control required" placeholder="City" value="<?= $ucc_data['city']; ?>">
                        </div>
                        <div class="form-group">
                           <label class="form-label">State<span class="required">*</span></label>
                           <div class="styled-select clearfix">
                              <select name="state" id="state" class="wide required form-control" >
                                 <option value="AN" <?=$ucc_data['state'] == 'AN' ? ' selected="selected"' : '';?>>Andaman and Nicobar Islands</option>
                                 <option value="AR" <?=$ucc_data['state'] == 'AR' ? ' selected="selected"' : '';?>>Andhra Pradesh</option>
                                 <option value="AP" <?=$ucc_data['state'] == 'AP' ? ' selected="selected"' : '';?>>Arunachal Pradesh</option>
                                 <option value="AS" <?=$ucc_data['state'] == 'AS' ? ' selected="selected"' : '';?>>Assam</option>
                                 <option value="BH" <?=$ucc_data['state'] == 'BH' ? ' selected="selected"' : '';?>>Bihar</option>
                                 <option value="CH" <?=$ucc_data['state'] == 'CH' ? ' selected="selected"' : '';?>>Chandigarh</option>
                                 <option value="CG" <?=$ucc_data['state'] == 'CG' ? ' selected="selected"' : '';?>>Chhattisgarh</option>
                                 <option value="DN" <?=$ucc_data['state'] == 'DN' ? ' selected="selected"' : '';?>>Dadar and Nagar Haveli</option>
                                 <option value="DD" <?=$ucc_data['state'] == 'DD' ? ' selected="selected"' : '';?>>Daman and Diu</option>
                                 <option value="GO" <?=$ucc_data['state'] == 'GO' ? ' selected="selected"' : '';?>>GOA</option>
                                 <option value="GU" <?=$ucc_data['state'] == 'GU' ? ' selected="selected"' : '';?>>Gujarat</option>
                                 <option value="HA" <?=$ucc_data['state'] == 'HA' ? ' selected="selected"' : '';?>>Haryana</option>
                                 <option value="HP" <?=$ucc_data['state'] == 'HP' ? ' selected="selected"' : '';?>>Himachal Pradesh</option>
                                 <option value="JM" <?=$ucc_data['state'] == 'JM' ? ' selected="selected"' : '';?>>Jammu and Kashmir</option>
                                 <option value="JK" <?=$ucc_data['state'] == 'JK' ? ' selected="selected"' : '';?>>Jharkhand</option>
                                 <option value="KA" <?=$ucc_data['state'] == 'KA' ? ' selected="selected"' : '';?>>Karnataka</option>
                                 <option value="KE" <?=$ucc_data['state'] == 'KE' ? ' selected="selected"' : '';?>>Kerala</option>
                                 <option value="LD" <?=$ucc_data['state'] == 'LD' ? ' selected="selected"' : '';?>>Lakshadweep</option>
                                 <option value="MP" <?=$ucc_data['state'] == 'MP' ? ' selected="selected"' : '';?>>Madhya Pradesh</option>
                                 <option value="MA" <?=$ucc_data['state'] == 'MA' ? ' selected="selected"' : '';?>>Maharashtra</option>
                                 <option value="MN" <?=$ucc_data['state'] == 'MN' ? ' selected="selected"' : '';?>>Manipur</option>
                                 <option value="ME" <?=$ucc_data['state'] == 'ME' ? ' selected="selected"' : '';?>>Meghalaya</option>
                                 <option value="MI" <?=$ucc_data['state'] == 'MI' ? ' selected="selected"' : '';?>>Mizoram</option>
                                 <option value="ND" <?=$ucc_data['state'] == 'ND' ? ' selected="selected"' : '';?>>New Delhi</option>
                                 <option value="NA" <?=$ucc_data['state'] == 'NA' ? ' selected="selected"' : '';?>>Nagaland</option>
                                 <option value="OR" <?=$ucc_data['state'] == 'OR' ? ' selected="selected"' : '';?>>Odisha</option>
                                 <option value="PO" <?=$ucc_data['state'] == 'PO' ? ' selected="selected"' : '';?>>Pondicherry</option>
                                 <option value="PU" <?=$ucc_data['state'] == 'PU' ? ' selected="selected"' : '';?>>Punjab</option>
                                 <option value="RA" <?=$ucc_data['state'] == 'RA' ? ' selected="selected"' : '';?>>Rajasthan</option>
                                 <option value="SI" <?=$ucc_data['state'] == 'SI' ? ' selected="selected"' : '';?>>Sikkim</option>
                                 <option value="TN" <?=$ucc_data['state'] == 'TN' ? ' selected="selected"' : '';?>>Tamil Nadu</option>
                                 <option value="TG" <?=$ucc_data['state'] == 'TG' ? ' selected="selected"' : '';?>>Telangana</option>
                                 <option value="TR" <?=$ucc_data['state'] == 'TR' ? ' selected="selected"' : '';?>>Tripura</option>
                                 <option value="UP" <?=$ucc_data['state'] == 'UP' ? ' selected="selected"' : '';?>>Uttar Pradesh</option>
                                 <option value="UC" <?=$ucc_data['state'] == 'UC' ? ' selected="selected"' : '';?>>Uttaranchal</option>
                                 <option value="WB" <?=$ucc_data['state'] == 'WB' ? ' selected="selected"' : '';?>>West Bengal</option>
                              </select>
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="form-label">PIN Code<span class="required">*</span></label>
                           <input type="number" name="pincode" id="pincode" class="form-control required" placeholder="Pin Code" min="100000" max="999999" value="<?= $ucc_data['pincode']; ?>">
                        </div>
                        <div class="form-group">
                           <label class="form-label">Country<span class="required">*</span></label>
                           <input type="text" name="country" id="country" class="form-control required" placeholder="Country" value="<?= $ucc_data['country']; ?>">
                        </div>
                     </div>
                     <div class='col-md-3'>
                        <h3 class="main_question"><strong>Bank Details</strong></h3>
                        <div class="form-group">
                           <label class="form-label">Bank Name<span class="required">*</span></label>
                           <input type="text" name="bank_name" id="bank_name" class="form-control required" placeholder="Bank Name" value="<?= $ucc_data['bank_name']; ?>">
                        </div>
                        <div class="form-group">
                           <label class="form-label">Bank Account No.<span class="required">*</span></label>
                           <input type="number" name="bank_account" id="bank_account" class="form-control required" placeholder="Bank Account number" value="<?= $ucc_data['acc_no']; ?>">
                        </div>
                        <div class="form-group">
                           <label class="form-label">IFSC Code<span class="required">*</span></label>
                           <input type="text" name="IFSC" id="IFSC" class="form-control required" placeholder="IFSC Code" value="<?= $ucc_data['ifsc_code']; ?>">
                        </div>
                     </div>
                     <div class="col-md-3">
                        <h3 class="main_question"><strong>Nominee Details</strong></h3>
                        <div class="form-group">
                           <label class="form-label">Nominee Name<span class="required">*</span></label>
                           <input type="text" name="nominee" id="nominee" class="form-control required" placeholder="Nominee Name" value="<?= $ucc_data['nominee_name']; ?>">
                        </div>
                        <div class="form-group">
                           <label class="form-label">Nominee Relationship<span class="required">*</span></label>
                           <div class="styled-select clearfix">
                              <select class="wide required form-control" name="g_n_r" id="g_n_r">
                                 <option value="">Nominee Relationship</option>
                                 <option value="Father" <?=$ucc_data['g_n_r'] == 'Father' ? ' selected="selected"' : '';?>>Father</option>
                                 <option value="Mother" <?=$ucc_data['g_n_r'] == 'Mother' ? ' selected="selected"' : '';?>>Mother</option>
                                 <option value="Brother" <?=$ucc_data['g_n_r'] == 'Brother' ? ' selected="selected"' : '';?>>Brother</option>
                                 <option value="Sister" <?=$ucc_data['g_n_r'] == 'Sister' ? ' selected="selected"' : '';?>>Sister</option>
                                 <option value="Spouse" <?=$ucc_data['g_n_r'] == 'Spouse' ? ' selected="selected"' : '';?>>Spouse</option>
                                 <option value="Son" <?=$ucc_data['g_n_r'] == 'Son' ? ' selected="selected"' : '';?>>Son</option>
                                 <option value="Mother" <?=$ucc_data['g_n_r'] == 'Mother' ? ' selected="selected"' : '';?>>Daughter</option>
                              </select>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- /step-->
               </div>
               <!-- /middle-wizard -->
               <div id="bottom-wizard">
                  <button type="submit" name="process_ucc" style="z-index: 9999999" class="submit">Submit</button>
               </div>
               <!-- /bottom-wizard -->
            </form>
         </div>
         <!-- /Wizard container -->
      </div>
      <!-- /content-right-->
   </div>
</div>