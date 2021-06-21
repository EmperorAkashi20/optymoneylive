<?php
$activeTab = 0;
$activeTab1 = $willProfile->getPayStatus();
// print_r($activeTab1);
$willid = $activeTab1[0]['pk_user_settings_id'];
$activeTab = $activeTab1[0]['pay_status'];
// if (isset($_POST['willPayFrm'])) {
//    $activeTab = 1;
// } else {
//    $activeTab = 0;
// }
$totalRec = $willProfile->getWillPayCount();
// Will assets 
$willassets_data = $willProfile->getwillassets('bfsi_users_details', 'will_assets');
// print_r($willassets_data);
// die();
$willassets_data = $willassets_data->will_assets;
$url .= $_SERVER['REQUEST_URI'];
$url1 = explode("&", $url);
$url2 = explode("=", $url1[1]);
// echo "URL:".$url;
// print_r($url1);
// echo "<br>URL2:";
// print_r($url2);
// echo $url2[1];
$_SESSION[$CONFIG->sessionPrefix . 'h_page'] = $url2[1];
// $suburl = $url1[1];
$suburl = explode("=", $url1[2]);
// "<br>SubURL:".$suburl[1]."<br>";
$_SESSION[$CONFIG->sessionPrefix . 'sub_h_page'] = $suburl[1];
$sub_sub_url = explode("=", $url1[3]);
//echo "Sub Sub URL:".$sub_sub_url[1]."<br>";
$_SESSION[$CONFIG->sessionPrefix . 'sub_sub_url_h_page'] = $sub_sub_url[1];

$willassets_data = explode("|", $willassets_data);
$_SESSION[$CONFIG->sessionPrefix . 'asset_id'] = $willassets_data;
// echo "assests ";
// print_r($_SESSION[$CONFIG->sessionPrefix . 'asset_id']);
$_SESSION[$CONFIG->sessionPrefix . 'link'] = $linkcategory;
//echo "Page Highlight:-".$_SESSION[$CONFIG->sessionPrefix.'h_page'];
include '__willPages\bank-account-details.php';
?>
<div class="main-content">
   <div class="container">
      <!-- <a href="" id="genpdf">Genpdf</a> -->
      <div class="page-content">
         <div class="panel panel-default">
            <div class="card">
               <span id="will_id" style="display: none;"><?php echo $willid; ?></span>
               <div class="card-body" id="custtab">
                  <ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
                     <li class="nav-item"><a class="nav-link text-center <?php if ($activeTab == 0) {
                                                                              echo "active";
                                                                           } ?>" id="personal-tab-2" data-toggle="tab" href="#personalInfo" role="tab" aria-controls="home" aria-selected="false">Personal Information</a></li>
                     <li class="nav-item"><a class="nav-link text-center" id="beneficiary-tab-2" data-toggle="tab" href="#beneficiaries" role="tab" aria-controls="profile" aria-selected="false">Beneficiaries</a></li>
                     <li class="nav-item"><a class="nav-link text-center" id="executor-tab-2" data-toggle="tab" href="#executor" role="tab" aria-controls="profile" aria-selected="false">Executor</a></li>
                     <li class="nav-item"><a class="nav-link text-center" id="assets-tab-2" data-toggle="tab" href="#assets" role="tab" aria-controls="contact" aria-selected="false">Assets</a></li>
                     <li class="nav-item"><a class="nav-link text-center" id="custodian-tab-2" data-toggle="tab" href="#custodian" role="tab" aria-controls="profile" aria-selected="false">Custodian</a></li>
                     <li class="nav-item"><a class="nav-link text-center" id="witness-tab-2" data-toggle="tab" href="#witness" role="tab" aria-controls="profile" aria-selected="false">Witness</a></li>
                     <li class="nav-item"><a class="nav-link text-center" id="preview-tab-2" data-toggle="tab" href="#preview" role="tab" aria-controls="profile" aria-selected="false">Preview</a></li>
                     <li class="nav-item"><a class="nav-link text-center <?php if ($activeTab == 1) {
                                                                              echo "active";
                                                                           } ?> id=" pay-download-tab-2" data-toggle="tab" href="#pay_download" role="tab" aria-controls="profile" aria-selected="false">Pay & Download</a></li>
                  </ul>
                  <div class="tab-content">
                     <div class="tab-pane fade <?php if ($activeTab == 0) {
                                                   echo "active show";
                                                } ?>" id="personalInfo" role="tabpanel" aria-labelledby="personal-tab-2">
                        <div class="">
                           <form name="frmProfiles" id="frmProfiles" class="frmCurrent has-validation-callback" method="POST" action="<?= $CONFIG->siteurl; ?>./__lib.ajax/frmForm.php" data-formType="0">
                              <div class="card-body">
                                 <div class="row">
                                    <div class="col-md-3">
                                       <div class="form-group">
                                          <label class="mandatory mandatory_label">PAN Number</label>
                                          <input type="text" class="form-control input-sm" name="pan_number" id="pan_number" value="" placeholder="PAN Number" alt="PAN Number Sample ABCPD1234E">
                                       </div>
                                    </div>
                                    <div class="col-md-3">
                                       <div class="form-group ">
                                          <label class="mandatory mandatory_label">Aadhaar Number</label>
                                          <input type="text" class="form-control" name="aadhaar_no" id="aadhaar_no" value="" placeholder="Aadhaar Number" alt="Enter 12 digit number">
                                       </div>
                                    </div>
                                    <div class="col-md-3">
                                       <div class="form-group">
                                          <label class="mandatory mandatory_label">Date of Birth </label>
                                          <input type="date" id="dob" class="form-control hasDatepicker" name="dob" value="" placeholder="Birth date" alt="Please select Date of Birth. Click inside the box to view calender and select the date. 18 years and above are allowed">
                                       </div>
                                    </div>
                                    <div class="col-md-3">
                                       <div class="form-group">
                                          <label class="mandatory mandatory_label">Age </label>
                                          <input type="text" id="age" name="age" class="form-control age" value="" placeholder="Age" readonly="" alt="Age">
                                       </div>
                                    </div>
                                    <div class="col-md-3">
                                       <div class="form-group">
                                          <label class="mandatory mandatory_label">Gender </label>
                                          <select name="sex" id="sex" class="input-select form-control" alt="Please select appropriate gender from the dropdown list" data-validation="length" data-validation-length="1-20" data-validation-error-msg="Please select a Gender">
                                             <option value="" selected="">Please Select</option>
                                             <option value="Male">Male</option>
                                             <option value="Female">Female</option>
                                             <option value="Transgender">Transgender</option>
                                          </select>
                                       </div>
                                    </div>
                                    <div class="col-md-3">
                                       <div class="form-group">
                                          <label class="mandatory mandatory_label">Email </label>
                                          <input type="email" id="email" class="form-control" name="email" placeholder="Email" value="" alt="Please enter only valid and active email ID. If you provide more than one email ID, verification URL will be sent on the first email ID" autocomplete="Off">
                                       </div>
                                    </div>
                                    <div class="col-md-3">
                                       <div class="form-group">
                                          <label class="mandatory mandatory_label">Mobile Number </label>
                                          <div class="input-group">
                                             <div class="input-group-prepend">
                                                <input id="isd" type="tel" class="form-control numeric col-sm-4" name="isd" readonly placeholder="+91" value="+91" alt="Please enter contry code" autocomplete="Off">
                                                <input type="tel" id="contact_no" class="form-control numeric" name="contact_no" placeholder="Mobile Number" value="" alt="Please enter Mobile Number. If you provide more than one Mobile Numbers, OTP will be sent on the first mobile number" autocomplete="Off">
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="col-md-3">
                                       <div class="form-group">
                                          <label class="mandatory">Landline Number</label>
                                          <input type="tel" pattern="[0][0-9]{10}" name="landline" id="landline" class="form-control" value="" placeholder="Landline Number" alt="Please enter valid Landline Number of an individual whose details are provided above" autocomplete="Off">
                                       </div>
                                    </div>
                                    <div class="col-md-3">
                                       <div class="form-group">
                                          <label class="mandatory mandatory_label">Nationality </label>
                                          <select class="input-select form-control" id="nationality" name="nationality" alt="Please select appropriate Nationality from the dropdown list">
                                             <option value="Indian" selected>Indian</option>
                                          </select>
                                       </div>
                                    </div>
                                    <div class="col-md-3">
                                       <div class="form-group">
                                          <label class="mandatory mandatory_label">Religion </label>
                                          <select name="religion" id="religion" class="input-select form-control" alt="Please select appropriate Religion from the dropdown list" onchange="javascript: toggle_other_religion(this.value, 'span_religion_other');">
                                             <option value="" selected>Please select</option>
                                             <option value="Buddhist">Buddhist</option>
                                             <option value="Christian">Christian</option>
                                             <option value="Hindu">Hindu</option>
                                             <option value="Jain">Jain</option>
                                             <option value="Judaism">Judaism</option>
                                             <option value="Parsi">Parsi</option>
                                             <option value="Sikh">Sikh</option>
                                          </select>
                                       </div>
                                    </div>
                                    <div class="col-md-3">
                                       <div class="form-group">
                                          <label class="mandatory mandatory_label">Father's name </label>
                                          <input type="text" name="father_name" class="form-control" id="father_name" value="" placeholder="Father Name" alt="Only alphabets are allowed. Abbreviations and initials to be avoided">
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-xl-6">
                                       <h4 class="card-title">Permanent Address</h4>
                                       <div class="col-md-12" id="individual_main_perm_add">
                                          <div id="populate_permanent_address">
                                             <div class="row no-gutters">
                                                <div class="col-md-4">
                                                   <div class="form-group">
                                                      <label class="mandatory mandatory_label">Address 1</label>
                                                      <input class="form-control" name="address1" id="address1" value="" placeholder="Address Line1" alt="Please enter Flat / Floor / Door / Block Number as applicable" type="text">
                                                   </div>
                                                </div>
                                                <div class="col-md-4">
                                                   <div class="form-group">
                                                      <label class="mandatory mandatory_label">Address 2 </label>
                                                      <input class="form-control" name="address2" id="address2" value="" placeholder="Address Line2" alt="Please enter Name of Premises / Building of Permanent Address" type="text">
                                                   </div>
                                                </div>
                                                <div class="col-md-4">
                                                   <div class="form-group">
                                                      <label>Address 3</label>
                                                      <input class="form-control" name="address3" id="address3" value="" placeholder="Address Line3" alt="Please enter name of Road / Street / Lane as applicable " type="text">
                                                   </div>
                                                </div>
                                                <div class="col-md-4">
                                                   <div class="form-group">
                                                      <label class="mandatory_label">City / Village / Town </label>
                                                      <input name="city" id="city" class="form-control" value="" placeholder="City / Village / Town" alt="Please enter name of City / Village / Town as applicable" type="text">
                                                   </div>
                                                </div>
                                                <div class="col-md-4">
                                                   <div class="form-group">
                                                      <label class="mandatory mandatory_label">State </label>
                                                      <span id="span_permanent_state">
                                                         <select name="state" id="state" class="input-select form-control" alt="Please select appropriate State">
                                                            <option value="" selected>Select State</option>
                                                            <option value="AN">Andaman and Nicobar Islands</option>
                                                            <option value="AR">Andhra Pradesh</option>
                                                            <option value="AP">Arunachal Pradesh</option>
                                                            <option value="AS">Assam</option>
                                                            <option value="BH">Bihar</option>
                                                            <option value="CH">Chandigarh</option>
                                                            <option value="CG">Chhattisgarh</option>
                                                            <option value="DN">Dadar and Nagar Haveli</option>
                                                            <option value="DD">Daman and Diu</option>
                                                            <option value="GO">GOA</option>
                                                            <option value="GU">Gujarat</option>
                                                            <option value="HA">Haryana</option>
                                                            <option value="HP">Himachal Pradesh</option>
                                                            <option value="JM">Jammu and Kashmir</option>
                                                            <option value="JK">Jharkhand</option>
                                                            <option value="KA">Karnataka</option>
                                                            <option value="KE">Kerala</option>
                                                            <option value="LD">Lakshadweep</option>
                                                            <option value="MP">Madhya Pradesh</option>
                                                            <option value="MA">Maharashtra</option>
                                                            <option value="MN">Manipur</option>
                                                            <option value="ME">Meghalaya</option>
                                                            <option value="MI">Mizoram</option>
                                                            <option value="ND">New Delhi</option>
                                                            <option value="NA">Nagaland</option>
                                                            <option value="OR">Odisha</option>
                                                            <option value="PO">Pondicherry</option>
                                                            <option value="PU">Punjab</option>
                                                            <option value="RA">Rajasthan</option>
                                                            <option value="SI">Sikkim</option>
                                                            <option value="TN">Tamil Nadu</option>
                                                            <option value="TG">Telangana</option>
                                                            <option value="TR">Tripura</option>
                                                            <option value="UP">Uttar Pradesh</option>
                                                            <option value="UC">Uttaranchal</option>
                                                            <option value="WB">West Bengal</option>
                                                         </select>
                                                      </span>
                                                   </div>
                                                </div>
                                                <div class="col-md-4">
                                                   <div class="form-group">
                                                      <label class="mandatory mandatory_label">Pincode / Zipcode </label>
                                                      <input class="form-control numeric" name="pincode" id="pincode" placeholder="Pincode" alt="Please enter PIN Code for India if Permanent Address is in India, Zip Code for address outside India" type="text">

                                                   </div>
                                                </div>
                                                <div class="col-md-4">
                                                   <div class="form-group">
                                                      <label class="mandatory mandatory_label">Country </label>
                                                      <span id="span_permanent_country">
                                                         <select name="country" id="country" class="input-select form-control select-country-list" alt="Please select appropriate Country for permanent Address" data-validation="length" data-validation-length="1-60" data-validation-error-msg="Please select a valid Country for permanent address" other_state_txt="permanent_state_other" onchange="javascript: populate_states(this.value,'permanent_state', 'span_permanent_state', '102', 'toggle_other_state(\'permanent_state\', \'span_permanent_state_other\')'); toggle_other_state_country(this.value, 'span_permanent_state_other', {'state_id':''}); ;">
                                                            <option value="India" selected="selected">India</option>
                                                         </select>
                                                      </span>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="col-xl-6">
                                       <h4 class="card-title">
                                          <span class="mandatory">Is the Correspondence Address same as Permanent Address?
                                             <input id="cor_as_perm" name="cor_as_perm" value="" alt="Select the checkbox if Correspondence Address is same as Permanent  Address" type="checkbox" onclick="filladd()">
                                          </span>
                                       </h4>
                                       <div class="correspondenceAdd">
                                          <div class="row" style="display:none">
                                             <div class="col-xl-6">
                                                &nbsp;&nbsp;&nbsp;
                                                <input class="same_cor_address" name="correspondence_is_same_as_permanent" value="P" id="correspondence_is_same_as_permanent" account_count="" for_address="correspondence" alt="Select if is this Address same as your Permanent Address?" type="checkbox">&nbsp;&nbsp;&nbsp;
                                                <label class="mandatory">Is this Address same as your Permanent Address?</label>
                                             </div>
                                             <div class="col-xl-6">
                                                &nbsp;&nbsp;&nbsp;
                                                <input class="same_cor_address" name="correspondence_is_same_as_correspondence" value="C" id="correspondence_is_same_as_correspondence" account_count="" for_address="correspondence" alt="Select if is this Address same as your Correspondence Address?" type="checkbox">&nbsp;&nbsp;&nbsp;
                                                <label class="mandatory">Is this Address same as your Correspondence Address?</label>
                                             </div>
                                          </div>
                                          <div id="populate_correspondence_address">
                                             <div class="row no-gutters">
                                                <div class="col-md-4">
                                                   <div class="form-group">
                                                      <label class="mandatory mandatory_label">Address 1 </label>
                                                      <input class="form-control" id="cor_addr1" name="cor_addr1" placeholder="Address Line1" value="" alt="Please enter Flat / Floor / Door / Block Number as applicable" type="text">
                                                   </div>
                                                </div>
                                                <div class="col-md-4">
                                                   <div class="form-group">
                                                      <label class="mandatory mandatory_label">Address 2 </label>
                                                      <input class="form-control" id="cor_addr2" name="cor_addr2" placeholder="Street name" value="" alt="Please enter Name of Premises / Building of correspondence Address" type="text">
                                                   </div>
                                                </div>
                                                <div class="col-md-4">
                                                   <div class="form-group">
                                                      <label>Address 3</label>
                                                      <input class="form-control" id="cor_addr3" name="cor_addr3" placeholder="Address Line3" value="" alt="Please enter name of Road / Street / Lane as applicable " type="text">
                                                   </div>
                                                </div>
                                                <div class="col-md-4">
                                                   <div class="form-group">
                                                      <label class="mandatory_label">City / Village / Town </label>
                                                      <input class="form-control" id="cor_city" name="cor_city" placeholder="City / Village / Town" value="" alt="Please enter name of City / Village / Town as applicable" type="text">
                                                   </div>
                                                </div>
                                                <div class="col-md-4">
                                                   <div class="form-group">
                                                      <label class="mandatory mandatory_label">State </label>
                                                      <span id="span_correspondence_state">
                                                         <select name="cor_state" id="cor_state" class="input-select form-control" alt="Please select appropriate State for Permanent Address" onchange="javascript: toggle_other_state('correspondence_state', 'span_other_state');">
                                                            <option value="" selected>Select State</option>
                                                            <option value="AN">Andaman and Nicobar Islands</option>
                                                            <option value="AR">Andhra Pradesh</option>
                                                            <option value="AP">Arunachal Pradesh</option>
                                                            <option value="AS">Assam</option>
                                                            <option value="BH">Bihar</option>
                                                            <option value="CH">Chandigarh</option>
                                                            <option value="CG">Chhattisgarh</option>
                                                            <option value="DN">Dadar and Nagar Haveli</option>
                                                            <option value="DD">Daman and Diu</option>
                                                            <option value="GO">GOA</option>
                                                            <option value="GU">Gujarat</option>
                                                            <option value="HA">Haryana</option>
                                                            <option value="HP">Himachal Pradesh</option>
                                                            <option value="JM">Jammu and Kashmir</option>
                                                            <option value="JK">Jharkhand</option>
                                                            <option value="KA">Karnataka</option>
                                                            <option value="KE">Kerala</option>
                                                            <option value="LD">Lakshadweep</option>
                                                            <option value="MP">Madhya Pradesh</option>
                                                            <option value="MA">Maharashtra</option>
                                                            <option value="MN">Manipur</option>
                                                            <option value="ME">Meghalaya</option>
                                                            <option value="MI">Mizoram</option>
                                                            <option value="ND">New Delhi</option>
                                                            <option value="NA">Nagaland</option>
                                                            <option value="OR">Odisha</option>
                                                            <option value="PO">Pondicherry</option>
                                                            <option value="PU">Punjab</option>
                                                            <option value="RA">Rajasthan</option>
                                                            <option value="SI">Sikkim</option>
                                                            <option value="TN">Tamil Nadu</option>
                                                            <option value="TG">Telangana</option>
                                                            <option value="TR">Tripura</option>
                                                            <option value="UP">Uttar Pradesh</option>
                                                            <option value="UC">Uttaranchal</option>
                                                            <option value="WB">West Bengal</option>
                                                         </select>
                                                      </span>
                                                   </div>
                                                </div>
                                                <div class="col-md-4">
                                                   <div class="form-group">
                                                      <label class="mandatory mandatory_label">Pincode / Zipcode </label>
                                                      <input name="cor_zip" id="cor_zip" class="form-control numeric" value="" placeholder="Pincode" type="text">
                                                   </div>
                                                </div>
                                                <div class="col-md-4">
                                                   <div class="form-group">
                                                      <label class="mandatory mandatory_label">Country </label>
                                                      <span id="span_correspondence_country">
                                                         <select name="cor_country" id="cor_country" class="input-select form-control select-country-list" alt="Please select appropriate Country for Correspondence Address" other_state_txt="correspondence_state_other">
                                                            <option value="India" selected="selected">India</option>
                                                         </select>
                                                      </span>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-md-6">
                                       <div class="form-group">
                                          <label class="mandatory mandatory_label">Place</label>
                                          <input type="text" name="pi_place" id="pi_place" class="form-control formname" value="" placeholder="Place" alt="Enter valid Place" autocomplete="Off">
                                       </div>
                                    </div>
                                    <div class="col-md-6">
                                       <div class="form-group">
                                          <label class="mandatory mandatory_label">Date and Time</label>
                                          <input type="text" name="pi_date" id="pi_date" class="form-control" value="" placeholder="23/03/21" autocomplete="Off" readonly>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="personalInfoScroll jumbotron p-1 mb-3 text-justify font-italic"><span style="color:#d33633;font-size:bigger">Note</span><br><b>* What is will:</b> A will is a legal document that sets forth your wishes regarding the distribution of
                                 your property and the care of any minor children. If you die without a will, those wishes may not be carried out. Further, your heirs may end up
                                 spending additional time, money, and emotional energy to settle your affairs after you're gone.
                              </div>
                              <div class="card-footer text-center">
                                 <button class="btn btn-danger btn-sm save" style="color:white" data-role="update" data-id="" data-table="bfsi_users_details" data-key="pk_user_detail_id">Save</button>
                              </div>
                           </form>
                        </div>
                     </div>
                     <div class="tab-pane fade" id="beneficiaries" role="tabpanel" aria-labelledby="beneficiary-tab-2">
                        <div class="">
                           <div class="card-body">
                              <div class="table-responsive mt-2">
                                 <a href="#beneficiaryModal" class="add_btn float-right add" data-toggle="modal" id="addBeneficiaryModal"><i class="fas fa-plus mr-1" aria-hidden="true" style="font-size: inherit; color: inherit;"></i><span>Add Beneficiary</span></a>
                                 <table class="table table-striped table-bordered dt-responsive nowrap" id="beneficiary">
                                    <thead>
                                       <tr>
                                          <th>Name</th>
                                          <th>Relation</th>
                                          <th>Address</th>
                                          <th>Action</th>
                                       </tr>
                                    </thead>
                                    <tbody></tbody>
                                 </table>
                              </div>

                           </div>
                        </div>
                        <div id="beneficiaryModal" class="modal fade">
                           <div class="modal-dialog modal-xl">
                              <div class="modal-content">
                                 <form name="frmBeneficiary" id="frmBeneficiary" action="<?= $CONFIG->siteurl; ?>./__lib.ajax/frmForm.php" method="post" class="frmCurrent has-validation-callback" data-formType="1">
                                    <div class="modal-header">
                                       <h4 class="modal-title">Beneficiary</h4>
                                       <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                       <div class="row">
                                          <div class="col-xl-12">
                                             <div id="bnfcryAddWrap">
                                                <!-- do not delte this div -->
                                                <div id="individual_main">
                                                   <div class="row">
                                                      <div class="col-md-8">
                                                         <div class="form-group">
                                                            <label class="mandatory mandatory_label">Name of the Beneficiary</label>
                                                            <div class="input-group mt-0 input-group-prepend">
                                                               <select name="ben_title" id="ben_title" class="input-select form-control " alt="Please select appropriate title from the dropdown list. Drop-down of the standard Titles normally used in writing Will" onchange="javascript: title_change();">
                                                                  <option value="" selected="">Title</option>
                                                                  <option value="1">Mr.</option>
                                                                  <option value="2">Mrs.</option>
                                                                  <option value="3">Ms.</option>
                                                                  <option value="10">Master</option>
                                                                  <option value="23">Kumar</option>
                                                                  <option value="24">Kumari</option>
                                                               </select>
                                                               <input class="form-control" name="ben_fname" id="ben_fname" value="" placeholder="First Name" maxlength="33" pattern="[a-zA-Z]{1,15}" alt="Only alphabets are allowed. Abbreviations and initials to be avoided" type="text">
                                                               <input class="form-control" name="ben_mname" id="ben_mname" value="" placeholder="Middle Name" alt="Only alphabets are allowed" type="text">
                                                               <input class="form-control" name="ben_lname" id="ben_lname" value="" placeholder="Last Name / Surname" maxlength="33" alt="Only alphabets and single apphostophe (') is allowed as special characters. For e.g. D'Silva, D'Souza. If you have a single name, please enter here" data-validation="length" data-validation-length="2-33" data-validation-error-msg="Please enter valid Last Name / Surname" type="text">
                                                            </div>
                                                         </div>
                                                      </div>
                                                      <div class="col-md-4">
                                                         <div class="form-group">
                                                            <label class="mandatory mandatory_label">Gender </label>
                                                            <div class="input-group mt-0 input-group-prepend">
                                                               <select name="ben_gender" id="ben_gender" class="input-select form-control" alt="Please select appropriate gender from the dropdown list" data-validation="length" data-validation-length="1-20" data-validation-error-msg="Please select a Gender">
                                                                  <option value="" selected="">Please Select</option>
                                                                  <option value="1">Male</option>
                                                                  <option value="2">Female</option>
                                                                  <option value="3">Transgender</option>
                                                               </select>
                                                            </div>
                                                         </div>
                                                      </div>
                                                      <div class="col-md-4">
                                                         <div class="form-group">
                                                            <label class="cnd-mandatory mandatory_label">Date of Birth </label>
                                                            <input id="ben_dob" name="ben_dob" class="form-control hasDatepicker" value="" placeholder="Birth date" alt="Please select Date of Birth. Click inside the box to view calender and select the date" type="date">
                                                         </div>
                                                      </div>
                                                      <div class="col-md-4">
                                                         <div class="form-group">
                                                            <label class="cnd-mandatory mandatory_label">Age </label>
                                                            <input type="text" id="ben_age" name="ben_age" class="form-control" value="" placeholder="Age" alt="Age" min="1" max="100" readonly="">
                                                            <input type="hidden" id="ben_minor" name="ben_minor" class="form-control" value="" placeholder="Minor" alt="Minor" min="1" max="100" readonly="">
                                                         </div>
                                                      </div>
                                                      <div class="col-md-4">
                                                         <div class="form-group">
                                                            <label class="mandatory mandatory_label">Mobile Number <small>Beneficiary/Guardian</small> </label>
                                                            <div class="input-group">
                                                               <div class="input-group-prepend">
                                                                  <input id="ben_isd" type="tel" class="form-control numeric col-sm-4" name="ben_isd" placeholder="+91" value="+91" alt="Please enter contry code" autocomplete="Off">
                                                                  <input type="tel" id="ben_mobile" class="form-control numeric" name="ben_mobile" placeholder="Mobile Number" value="" alt="Please enter Mobile Number. If you provide more than one Mobile Numbers, OTP will be sent on the first mobile number" autocomplete="Off">
                                                               </div>
                                                            </div>
                                                         </div>
                                                      </div>
                                                      <div class="col-md-4" id="other_relation" style="display: none">
                                                         <div class="form-group">
                                                            <label class="cnd-mandatory mandatory_label">Email</label>
                                                            <input type="text" id="other_rel" name="other_rel" class="numberinput" value="" placeholder="Specify Other Relation" alt="Other Relation">
                                                         </div>
                                                      </div>
                                                      <div class="col-md-4">
                                                         <div class="form-group">
                                                            <label class="mandatory_label">Relationship with testator </label>
                                                            <select name="ben_rel_with_testator" id="ben_rel_with_testator" class="input-select form-control" alt="Select beneficiary’s relationship with the Testator from the drop-down list. For e.g. If Testator is defining his son as beneficiary, select ‘Relationship with testator’ as ‘Son’" data-validation="length" data-validation-length="1-3" data-validation-error-msg="Please select a relationship" onchange="javascript: toggle_other_relation('relationship_with_testator', 'span_beneficary_relationship');">
                                                               <option value="" selected="">Please select</option>
                                                               <option value="2">Spouse</option>
                                                               <option value="3">Son</option>
                                                               <option value="4">Daughter</option>
                                                               <option value="5">Mother</option>
                                                               <option value="6">Father</option>
                                                               <option value="7">Brother</option>
                                                               <option value="8">Sister</option>
                                                               <option value="19">Grand Daughter</option>
                                                               <option value="20">Grandson</option>
                                                               <option value="21">Grand Father</option>
                                                               <option value="22">Grand Mother</option>
                                                               <option value="23">Son-in-Law</option>
                                                               <option value="24">Daughter-in-law</option>
                                                               <option value="99">Other</option>
                                                            </select>
                                                         </div>
                                                      </div>
                                                   </div>
                                                   <div class="row">
                                                      <div class="col-md-12">
                                                         <span>Is your beneficiary mentally disabled or mentally incapacity?</span>
                                                         <input type="radio" name="ben_mentally" class="incap" value="1"> Yes
                                                         <input type="radio" name="ben_mentally" class="incap" value="0" checked=""> No
                                                      </div>
                                                   </div>
                                                   <div class="row">
                                                      <div class="col-md-12">
                                                         <h4 class="card-title">Permanent Address</h4>
                                                         <div id="individual_main_perm_add">
                                                            <div id="populate_permanent_address">
                                                               <div class="row">
                                                                  <div class="col-md-4">
                                                                     <div class="form-group">
                                                                        <label class="mandatory mandatory_label">Address Line 1</label>
                                                                        <input class="form-control" name="ben_perm_addr1" id="ben_perm_addr1" value="" placeholder="Address Line1" maxlength="60" alt="Please enter Flat / Floor / Door / Block Number as applicable" data-validation="length" data-validation-length="1-60" data-validation-error-msg="Please enter valid Address Line1 for permanent address" type="text">
                                                                     </div>
                                                                  </div>
                                                                  <div class="col-md-4">
                                                                     <div class="form-group">
                                                                        <label class="mandatory mandatory_label">Address Line 2 </label>
                                                                        <input class="form-control" name="ben_perm_addr2" id="ben_perm_addr2" value="" placeholder="Address Line2" maxlength="60" alt="Please enter Name of Premises / Building of Permanent Address" data-validation="length" data-validation-length="1-60" data-validation-error-msg="Please enter valid Address Line2 for permanent address" type="text">
                                                                     </div>
                                                                  </div>
                                                                  <div class="col-md-4">
                                                                     <div class="form-group">
                                                                        <label class="mandatory_label">City / Village / Town </label>
                                                                        <input name="ben_perm_city" id="ben_perm_city" class="form-control" value="" placeholder="City / Village / Town" maxlength="60" alt="Please enter name of City / Village / Town as applicable" data-validation="length" data-validation-length="1-60" data-validation-error-msg="Please enter valid City / Village / Town for permanent address" type="text">
                                                                     </div>
                                                                  </div>
                                                                  <div class="col-md-4">
                                                                     <div class="form-group">
                                                                        <label class="mandatory mandatory_label">State </label>
                                                                        <span id="span_permanent_state">
                                                                           <select name="ben_perm_state" id="ben_perm_state" class="input-select form-control" alt="Please select appropriate State" data-validation="length" data-validation-length="1-60" data-validation-error-msg="Please select a valid State">
                                                                              <option value="">Select State</option>
                                                                              <option value="35">Andaman and Nicobar Islands</option>
                                                                              <option value="25">Daman and Diu</option>
                                                                              <option value="28">Andhra Pradesh</option>
                                                                              <option value="12">Arunachal Pradesh</option>
                                                                              <option value="18">Assam</option>
                                                                              <option value="10">Bihar</option>
                                                                              <option value="4">Chandigarh</option>
                                                                              <option value="22">Chhattisgarh</option>
                                                                              <option value="26">Dadra and Nagar Haveli</option>
                                                                              <option value="7">Delhi</option>
                                                                              <option value="30">Goa</option>
                                                                              <option value="24">Gujarat</option>
                                                                              <option value="6">Haryana</option>
                                                                              <option value="2">Himachal Pradesh</option>
                                                                              <option value="1">Jammu and Kashmir</option>
                                                                              <option value="20">Jharkhand</option>
                                                                              <option value="29">Karnataka</option>
                                                                              <option value="32">Kerala</option>
                                                                              <option value="31">Lakshadweep</option>
                                                                              <option value="23">Madhya Pradesh</option>
                                                                              <option value="27">Maharashtra</option>
                                                                              <option value="14">Manipur</option>
                                                                              <option value="17">Meghalaya</option>
                                                                              <option value="15">Mizoram</option>
                                                                              <option value="13">Nagaland</option>
                                                                              <option value="21">Odisha</option>
                                                                              <option value="34">Puducherry</option>
                                                                              <option value="3">Punjab</option>
                                                                              <option value="8">Rajasthan</option>
                                                                              <option value="11">Sikkim</option>
                                                                              <option value="33">Tamil Nadu</option>
                                                                              <option value="36">Telangana</option>
                                                                              <option value="16">Tripura</option>
                                                                              <option value="5">Uttarakhand</option>
                                                                              <option value="9">Uttar Pradesh</option>
                                                                              <option value="19">West Bengal</option>
                                                                           </select>
                                                                        </span>
                                                                     </div>
                                                                  </div>
                                                                  <div class="col-md-4">
                                                                     <label class="mandatory mandatory_label">Pincode / Zipcode </label>
                                                                     <input class="form-control  numeric" name="ben_perm_zip" id="ben_perm_zip" placeholder="Pincode" value="" pattern="[0-9]{6}" alt="Please enter PIN Code for India if Permanent Address is in India, Zip Code for address outside India" type="text">
                                                                  </div>
                                                                  <div class="col-md-4">
                                                                     <label class="mandatory mandatory_label">Country </label>
                                                                     <span id="span_permanent_country">
                                                                        <select name="ben_perm_country" id="ben_perm_country" class="input-select form-control select-country-list" alt="Please select appropriate Country for permanent Address" data-validation="length" data-validation-length="1-60" data-validation-error-msg="Please select a valid Country for permanent address" other_state_txt="permanent_state_other" onchange="javascript: populate_states(this.value,'permanent_state', 'span_permanent_state', '102', 'toggle_other_state(\'permanent_state\', \'span_permanent_state_other\')'); toggle_other_state_country(this.value, 'span_permanent_state_other', {'state_id':''}); ;">
                                                                           <option value="102" selected="selected">India</option>
                                                                        </select>
                                                                     </span>
                                                                  </div>
                                                               </div>
                                                            </div>
                                                         </div>
                                                      </div>
                                                   </div>
                                                   <div class="row">
                                                      <div class="col-md-12">
                                                         <h4 class="card-title">
                                                            <span class="mandatory">Is the Correspondence Address same as Permanent Address?
                                                               <input id="ben_cor_as_perm" name="ben_cor_as_perm" value="" alt="Select the checkbox if Correspondence Address is same as Permanent  Address" type="checkbox" onclick="filladdBen()">
                                                            </span>
                                                         </h4>
                                                         <div class="correspondenceAdd">
                                                            <div id="populate_correspondence_address">
                                                               <div class="row">
                                                                  <div class="col-md-4">
                                                                     <div class="form-group">
                                                                        <label class="mandatory mandatory_label">Address Line 1 </label>
                                                                        <input class="form-control" id="ben_cor_addr1" name="ben_cor_addr1" placeholder="Address Line1" value="" maxlength="60" data-validation="length" data-validation-length="1-60" data-validation-error-msg="Please enter valid Address Line1 for correspondence address" title="Please enter Flat / Floor / Door / Block Number as applicable" alt="Please enter Flat / Floor / Door / Block Number as applicable" type="text">
                                                                     </div>
                                                                  </div>
                                                                  <div class="col-md-4">
                                                                     <div class="form-group">
                                                                        <label class="mandatory mandatory_label">Address Line 2 </label>
                                                                        <input class="form-control" id="ben_cor_addr2" name="ben_cor_addr2" placeholder="Street name" value="" maxlength="60" data-validation="length" data-validation-length="1-60" data-validation-error-msg="Please enter valid Address Line2 for correspondence address" title="Please enter Name of Premises / Building of correspondence Address" alt="Please enter Name of Premises / Building of correspondence Address" type="text">
                                                                     </div>
                                                                  </div>
                                                                  <div class="col-md-4">
                                                                     <div class="form-group">
                                                                        <label class="mandatory_label">City / Village / Town </label>
                                                                        <input class="form-control" id="ben_cor_city" name="ben_cor_city" placeholder="City / Village / Town" value="" maxlength="60" title="Please enter name of City / Village / Town as applicable" alt="Please enter name of City / Village / Town as applicable" data-validation="length" data-validation-length="1-60" data-validation-error-msg="Please enter valid City / Village / Town for correspondence address" type="text">
                                                                     </div>
                                                                  </div>
                                                                  <div class="col-md-4">
                                                                     <div class="form-group">
                                                                        <label class="mandatory mandatory_label">State </label>
                                                                        <span id="span_correspondence_state">
                                                                           <select name="ben_cor_state" id="ben_cor_state" class="input-select form-control" title="Please select appropriate State for Permanent Address" alt="Please select appropriate State for Permanent Address" data-validation="length" data-validation-length="1-60" data-validation-error-msg="Please select a valid State for permanent address" onchange="javascript: toggle_other_state('correspondence_state', 'span_other_state');">
                                                                              <option value="" selected="">Select State</option>
                                                                              <option value="35">Andaman and Nicobar Islands</option>
                                                                              <option value="25">Daman and Diu</option>
                                                                              <option value="28">Andhra Pradesh</option>
                                                                              <option value="12">Arunachal Pradesh</option>
                                                                              <option value="18">Assam</option>
                                                                              <option value="10">Bihar</option>
                                                                              <option value="4">Chandigarh</option>
                                                                              <option value="22">Chhattisgarh</option>
                                                                              <option value="26">Dadra and Nagar Haveli</option>
                                                                              <option value="7">Delhi</option>
                                                                              <option value="30">Goa</option>
                                                                              <option value="24">Gujarat</option>
                                                                              <option value="6">Haryana</option>
                                                                              <option value="2">Himachal Pradesh</option>
                                                                              <option value="1">Jammu and Kashmir</option>
                                                                              <option value="20">Jharkhand</option>
                                                                              <option value="29">Karnataka</option>
                                                                              <option value="32">Kerala</option>
                                                                              <option value="31">Lakshadweep</option>
                                                                              <option value="23">Madhya Pradesh</option>
                                                                              <option value="27">Maharashtra</option>
                                                                              <option value="14">Manipur</option>
                                                                              <option value="17">Meghalaya</option>
                                                                              <option value="15">Mizoram</option>
                                                                              <option value="13">Nagaland</option>
                                                                              <option value="21">Odisha</option>
                                                                              <option value="34">Puducherry</option>
                                                                              <option value="3">Punjab</option>
                                                                              <option value="8">Rajasthan</option>
                                                                              <option value="11">Sikkim</option>
                                                                              <option value="33">Tamil Nadu</option>
                                                                              <option value="36">Telangana</option>
                                                                              <option value="16">Tripura</option>
                                                                              <option value="5">Uttarakhand</option>
                                                                              <option value="9">Uttar Pradesh</option>
                                                                              <option value="19">West Bengal</option>
                                                                           </select>
                                                                        </span>
                                                                     </div>
                                                                  </div>
                                                                  <div class="col-md-4">
                                                                     <div class="form-group">
                                                                        <label class="mandatory mandatory_label">Pincode / Zipcode </label>
                                                                        <input name="ben_cor_zip" id="ben_cor_zip" class="form-control numeric" value="" placeholder="Pincode" type="text">
                                                                     </div>
                                                                  </div>
                                                                  <div class="col-md-4">
                                                                     <div class="form-group">
                                                                        <label class="mandatory mandatory_label">Country </label>
                                                                        <span id="span_correspondence_country">
                                                                           <select name="ben_cor_country" id="ben_cor_country" class="input-select form-control select-country-list" title="Please select appropriate Country for Correspondence Address" alt="Please select appropriate Country for Correspondence Address" other_state_txt="correspondence_state_other">
                                                                              <option value="102" selected="selected">India</option>
                                                                           </select>
                                                                        </span>
                                                                     </div>
                                                                  </div>
                                                               </div>
                                                            </div>
                                                            <!-- correspon Address END -->
                                                         </div>
                                                      </div>
                                                   </div>
                                                   <div class="row">
                                                      <div class="col-md-12">
                                                         <div id="guardiant_main" style="display: block;">
                                                            <div class="grdn-details" id="fdJoinGuardiantAddWrap">
                                                               <h4 class="card-title">Details of Guardian</h4>
                                                               <small class="note">
                                                                  Note: It is only required to fill below information under these two conditions:
                                                                  <br> 1. If the Beneficiary is less than 18 years of age, the details of the Guardian have to be captured.
                                                                  <br> 2. Incase of mentally incapacitated, details of Guardian have to be captured.
                                                               </small>
                                                               <div class="row">
                                                                  <div class="col-md-12">
                                                                     <div class="form-group">
                                                                        <label class="mandatory mandatory_label">Name of Guardian </label>
                                                                        <div class="input-group mt-3">
                                                                           <div class="input-group-prepend">
                                                                              <select name="ben_gard_title" id="ben_gard_title" class="input-select form-control " title="Please select appropriate title from the dropdown list. Drop-down of the standard Titles normally used in writing Will" alt="Please select appropriate title from the dropdown list. Drop-down of the standard Titles normally used in writing Will" data-validation="length" data-validation-length="1-20" data-validation-error-msg="Please select a Title" onchange="javascript: title_change();">
                                                                                 <option value="" selected="">Title</option>
                                                                                 <option value="1">Mr.</option>
                                                                                 <option value="2">Mrs.</option>
                                                                                 <option value="3">Ms.</option>
                                                                              </select>
                                                                              <input name="ben_gard_fname" id="ben_gard_fname" pattern="[a-zA-Z]{1,15}" value="" placeholder="First Name" class="form-control guardian_all" maxlength="33" title="Only alphabets are allowed. Abbreviations and initials to be avoided" alt="Only alphabets are allowed. Abbreviations and initials to be avoided" type="text">
                                                                              <input name="ben_gard_mname" pattern="[a-zA-Z]{1,15}" id="ben_gard_mname" value="" placeholder="Middle Name" class="form-control guardian_all" maxlength="33" title="Only alphabets are allowed" alt="Only alphabets are allowed" type="text">
                                                                              <input name="ben_gard_lname" pattern="[a-zA-Z]{1,15}" id="ben_gard_lname" value="" placeholder="Last Name / Surname" class="form-control guardian_all" maxlength="33" title="Only alphabets and single apphostophe (') is allowed as special characters. For e.g. D'Silva, D'Souza. If you have a single name, please enter here" alt="Only alphabets and single apphostophe (') is allowed as special characters. For e.g. D'Silva, D'Souza. If you have a single name, please enter here" data-validation="length" data-validation-length="1-33" data-validation-error-msg="Please enter valid guardian Last Name / Surname" type="text">
                                                                           </div>
                                                                        </div>
                                                                     </div>
                                                                  </div>
                                                               </div>
                                                               <div class="row">
                                                                  <div class="col-md-12">
                                                                     <div class="form-group">
                                                                        <label class="mandatory mandatory_label">Guardian's Father Name</label>
                                                                        <div class="input-group mt-3">
                                                                           <div class="input-group-prepend">
                                                                              <select name="ben_gard_father_title" pattern="[a-zA-Z]{1,15}" id="ben_gard_father_title" class="input-select form-control guardian_all" title="Please select appropriate title from the dropdown list. Drop-down of the standard Titles normally used in writing Will" alt="Please select appropriate title from the dropdown list. Drop-down of the standard Titles normally used in writing Will" data-validation="length" data-validation-length="1-20" data-validation-error-msg="Please select a Title" onchange="javascript: title_change();">
                                                                                 <option value="" selected="">Title</option>
                                                                                 <option value="1">Mr.</option>
                                                                                 <!-- <option value="2" >Mrs.</option>
                                                                                       <option value="3" >Ms.</option>
                                                                                       -->
                                                                              </select>
                                                                              <input name="ben_gard_father_fname" pattern="[a-zA-Z]{1,15}" id="ben_gard_father_fname" value="" placeholder="First Name" class="form-control guardian_all" maxlength="33" title="Only alphabets are allowed. Abbreviations and initials to be avoided" alt="Only alphabets are allowed. Abbreviations and initials to be avoided" type="text">
                                                                              <input name="ben_gard_father_mname" pattern="[a-zA-Z]{1,15}" id="ben_gard_father_mname" value="" placeholder="Middle Name" class="form-control guardian_all" maxlength="33" title="Only alphabets are allowed" alt="Only alphabets are allowed" type="text">
                                                                              <input name="ben_gard_father_lname" pattern="[a-zA-Z]{1,15}" id="ben_gard_father_lname" value="" placeholder="Last Name / Surname" class="form-control guardian_all" maxlength="33" title="Only alphabets and single apphostophe (') is allowed as special characters. For e.g. D'Silva, D'Souza. If you have a single name, please enter here" alt="Only alphabets and single apphostophe (') is allowed as special characters. For e.g. D'Silva, D'Souza. If you have a single name, please enter here" data-validation="length" data-validation-length="1-33" data-validation-error-msg="Please enter valid guardian Last Name / Surname" type="text">
                                                                           </div>
                                                                        </div>
                                                                     </div>
                                                                  </div>
                                                               </div>
                                                               <div class="row">
                                                                  <div class="col-md-4">
                                                                     <div class="form-group">
                                                                        <label class="mandatory mandatory_label">Date of Birth</label>
                                                                        <input name="ben_gard_dob" id="ben_gard_dob" class="form-control guardian_all" value="" placeholder="Guardian Birth date" type="date" min="1920-10-19" max="2002-10-19">
                                                                     </div>
                                                                  </div>
                                                                  <div class="col-md-4">
                                                                     <div class="form-group">
                                                                        <label class="mandatory mandatory_label">Age</label>
                                                                        <input type="text" id="ben_gard_age" name="ben_gard_age" class="form-control guardian_all" value="" placeholder="Age" title="Age" alt="Age" readonly="">
                                                                     </div>
                                                                  </div>
                                                                  <div class="col-md-4">
                                                                     <div class="form-group">
                                                                        <label class="mandatory mandatory_label">Gender</label>
                                                                        <select name="ben_gard_gender" id="ben_gard_gender" class="input-select form-control guardian_all" title="Please select appropriate gender from the dropdown list" alt="Please select appropriate gender from the dropdown list" data-validation="length" data-validation-length="1-20" data-validation-error-msg="Please enter valid guardian Gender">
                                                                           <option value="" selected="">Please select</option>
                                                                           <option value="1">Male</option>
                                                                           <option value="2">Female</option>
                                                                           <option value="3">Transgender</option>
                                                                        </select>
                                                                     </div>
                                                                  </div>
                                                                  <div class="col-md-4">
                                                                     <div class="form-group">
                                                                        <label class="mandatory mandatory_label">Nationality</label>
                                                                        <select name="ben_gard_nationality" id="ben_gard_nationality" class="input-select form-control guardian_all" title="">
                                                                           <!-- <option value="" selected >Please Select</option> -->
                                                                           <option value="indian">Indian</option>
                                                                           <!-- <option value="other"  >Other</option> -->
                                                                        </select>
                                                                     </div>
                                                                  </div>
                                                                  <div class="col-md-4">
                                                                     <div class="form-group">
                                                                        <label class="mandatory mandatory_label">Occupation</label>
                                                                        <select name="ben_gard_occupation" id="ben_gard_occupation" class="input-select form-control guardian_all" title="">
                                                                           <option value="" selected="">Please select</option>
                                                                           <option value="service">Service</option>
                                                                           <option value="business">Business</option>
                                                                           <option value="other">other</option>
                                                                           <!-- <option value="other"  >Other</option> -->
                                                                        </select>
                                                                     </div>
                                                                  </div>
                                                                  <div class="col-md-4">
                                                                     <div class="form-group">
                                                                        <label class="mandatory mandatory_label">Religion</label>
                                                                        <select name="ben_gard_religious" id="ben_gard_religious" class="input-select form-control guardian_all" title="">
                                                                           <option value="" selected="">Please Select</option>
                                                                           <option value="hindu">Hindu</option>
                                                                           <option value="Buddhist">Buddhist</option>
                                                                           <option value="Christian">Christian</option>
                                                                           <option value="Jain">Jain</option>
                                                                           <option value="Judaism">Judaism</option>
                                                                           <option value="Parsi">Parsi</option>
                                                                           <option value="Sikh">Sikh</option>
                                                                           <!--  <option value="other"  >Other</option> -->
                                                                        </select>
                                                                     </div>
                                                                  </div>
                                                                  <div class="col-md-6">
                                                                     <div class="form-group">
                                                                        <label class="mandatory mandatory_label">Relationship of the Guardian with the Beneficiary</label>
                                                                        <select name="ben_gard_relation" id="ben_gard_relation" class="input-select form-control" title="Please select appropriate 'Relationship of the Guardian with the Beneficiary' from the dropdown list" alt="Please select appropriate 'Relationship of the Guardian with the Beneficiary' from the dropdown list" data-validation="length" data-validation-length="1-33" data-validation-error-msg="Please select appropriate 'Relationship of the Guardian with the Beneficiary' from the dropdown list" onchange="javascript: toggle_other_relation('guardian_beneficary_relationship', 'span_guardian_beneficary_relationship');">
                                                                           <option value="">Please select</option>
                                                                           <option value="2">Spouse</option>
                                                                           <option value="3">Son</option>
                                                                           <option value="4">Daughter</option>
                                                                           <option value="5">Mother</option>
                                                                           <option value="6">Father</option>
                                                                           <option value="7" selected="selected">Brother</option>
                                                                           <option value="8">Sister</option>
                                                                           <option value="19">Grand Daughter</option>
                                                                           <option value="20">Grandson</option>
                                                                           <option value="21">Grand Father</option>
                                                                           <option value="22">Grand Mother</option>
                                                                           <option value="23">Son-in-Law</option>
                                                                           <option value="24">Daughter-in-law</option>
                                                                           <!-- <option value="99">Other</option>-->
                                                                        </select>
                                                                     </div>
                                                                  </div>
                                                               </div>
                                                               <div class="row">
                                                                  <div class="col-md-12">
                                                                     <h4 class="card-title">Guardian - Permanent Address</h4>
                                                                     <div class="form-group">
                                                                        <input class="guardian_same_per_address guardian_all" name="ben_gard_cor_as_perm" value="" id="ben_gard_cor_as_perm" value="" account_count="" for_address="guardian_permanent" title="Select if is this Address same as your Permanent Address?" onclick="filladdBenGardPerm()" alt="Select if is this Address same as your Permanent Address?" type="checkbox">&nbsp;&nbsp;&nbsp;
                                                                        <label>Is this Address same as your Permanent Address?</label>
                                                                     </div>
                                                                  </div>
                                                               </div>
                                                               <div class="row" id="populate_guardian_permanent_address">
                                                                  <div class="col-md-4">
                                                                     <div class="form-group">
                                                                        <label class="mandatory mandatory_label">Address Line 1 </label>
                                                                        <input name="ben_gard_perm_addr1" id="ben_gard_perm_addr1" class="form-control guardian_all" value="" placeholder="Address Line1" maxlength="60" title="Please enter Flat / Floor / Door / Block Number of the Guardian's Permanent Address" alt="Please enter Address Line1 for guardian permanent address" data-validation="length" data-validation-length="1-60" data-validation-error-msg="Please enter valid Address Line1 for guardian permanent address" type="text">
                                                                     </div>
                                                                  </div>
                                                                  <div class="col-md-4">
                                                                     <div class="form-group">
                                                                        <label class="mandatory mandatory_label">Address Line 2 </label>
                                                                        <input name="ben_gard_perm_addr2" id="ben_gard_perm_addr2" class="form-control" value="" placeholder="Address Line2" maxlength="60" title="Please enter Name of Premises / Building of the Gaurdian's Permanent Address" alt="Please enter Name of Premises / Building of the Gaurdian's Permanent Address" data-validation="length" data-validation-length="1-60" data-validation-error-msg="Please enter valid Address Line2 for guardian permanent address" type="text">
                                                                     </div>
                                                                  </div>
                                                                  <div class="col-md-4">
                                                                     <div class="form-group">
                                                                        <label class="mandatory mandatory_label">City / Village / Town </label>
                                                                        <input name="ben_gard_perm_city" id="ben_gard_perm_city" class="form-control guardian_all" value="" placeholder="City / Village / Town" maxlength="60" title="Please enter name of City / Village / Town of the Gaurdian's Permanent Address" alt="Please enter name of City / Village / Town of the Gaurdian's Permanent Address" data-validation="length" data-validation-length="1-60" data-validation-error-msg="Please enter valid City / Village / Town for guardian permanent address" type="text">
                                                                     </div>
                                                                  </div>
                                                                  <div class="col-md-4">
                                                                     <div class="form-group">
                                                                        <label class="mandatory mandatory_label">State </label>
                                                                        <span id="span_guardian_permanent_state">
                                                                           <select name="ben_gard_perm_state" id="ben_gard_perm_state" class="input-select form-control guardian_all" title="Please select appropriate State" alt="Please select appropriate State" data-validation="length" data-validation-length="1-60" data-validation-error-msg="Please select a valid State">
                                                                              <option value="" selected="">Select State</option>
                                                                              <option value="35">Andaman and Nicobar Islands</option>
                                                                              <option value="25">Daman and Diu</option>
                                                                              <option value="28">Andhra Pradesh</option>
                                                                              <option value="12">Arunachal Pradesh</option>
                                                                              <option value="18">Assam</option>
                                                                              <option value="10">Bihar</option>
                                                                              <option value="4">Chandigarh</option>
                                                                              <option value="22">Chhattisgarh</option>
                                                                              <option value="26">Dadra and Nagar Haveli</option>
                                                                              <option value="7">Delhi</option>
                                                                              <option value="30">Goa</option>
                                                                              <option value="24">Gujarat</option>
                                                                              <option value="6">Haryana</option>
                                                                              <option value="2">Himachal Pradesh</option>
                                                                              <option value="1">Jammu and Kashmir</option>
                                                                              <option value="20">Jharkhand</option>
                                                                              <option value="29">Karnataka</option>
                                                                              <option value="32">Kerala</option>
                                                                              <option value="31">Lakshadweep</option>
                                                                              <option value="23">Madhya Pradesh</option>
                                                                              <option value="27">Maharashtra</option>
                                                                              <option value="14">Manipur</option>
                                                                              <option value="17">Meghalaya</option>
                                                                              <option value="15">Mizoram</option>
                                                                              <option value="13">Nagaland</option>
                                                                              <option value="21">Odisha</option>
                                                                              <option value="34">Puducherry</option>
                                                                              <option value="3">Punjab</option>
                                                                              <option value="8">Rajasthan</option>
                                                                              <option value="11">Sikkim</option>
                                                                              <option value="33">Tamil Nadu</option>
                                                                              <option value="36">Telangana</option>
                                                                              <option value="16">Tripura</option>
                                                                              <option value="5">Uttarakhand</option>
                                                                              <option value="9">Uttar Pradesh</option>
                                                                              <option value="19">West Bengal</option>
                                                                           </select>
                                                                        </span>
                                                                     </div>
                                                                  </div>
                                                                  <div class="col-md-4">
                                                                     <div class="form-group">
                                                                        <label class="mandatory mandatory_label">Pincode / Zipcode </label>
                                                                        <input name="ben_gard_perm_zip" id="ben_gard_perm_zip" class="form-control numeric guardian_all" value="" pattern="[0-9]{6}" placeholder="Pincode" title="Please enter PIN Code for India if Gaurdian's Permanent Address is in India, Zip Code for address outside India" alt="Please enter Pincode / Zipcode for guardian permanent address" data-validation="length" maxlength="6" data-validation-length="6-6" data-validation-error-msg="Please enter valid Pincode / Zipcode for guardian permanent address" type="text">
                                                                     </div>
                                                                  </div>
                                                                  <div class="col-md-4">
                                                                     <div class="form-group">
                                                                        <label class="mandatory mandatory_label">Country </label>
                                                                        <span id="span_guardian_permanent_country">
                                                                           <select name="ben_gard_perm_country" id="ben_gard_perm_country" class="input-select form-control guardian_all" title="Please select appropriate Country for Guardian's Permanent Address" alt="Please select appropriate Country for Guardian's Permanent Address" data-validation="length" data-validation-length="1-33" data-validation-error-msg="Please select a Country for guardian permanent address" onchange="javascript: populate_states(this.value,'guardian_permanent_state', 'span_guardian_permanent_state', '102', 'toggle_other_state(\'guardian_permanent_state\', \'guardian_permanent_span_other_state\')');; toggle_other_state_country(this.value, 'guardian_permanent_span_other_state', {'state_id':''});;">
                                                                              <option value="102" selected="selected">India</option>
                                                                           </select>
                                                                        </span>
                                                                     </div>
                                                                  </div>
                                                               </div>
                                                               <div class="row">
                                                                  <div class="col-md-12">
                                                                     <h4 class="card-title">Guardian - Correspondence Address<h4>
                                                                           <div class="form-group">
                                                                              <input name="ben_gard_cor_as_gard_perm" id="ben_gard_cor_as_gard_perm" value="" title="Select the checkbox if Guardian's Correspondence Address is same as Permanent  Address" alt="Select the checkbox if Guardian's Correspondence Address is same as Permanent  Address" type="checkbox" onclick="GardcorAddrGardPermAddr()">
                                                                              <label class="mandatory mandatory_label">Is the Correspondence Address same as Permanent Address ?</label>
                                                                           </div>
                                                                           <div class="form-group">
                                                                              <input class="ben_gard_cor_as_ben_perm" name="ben_gard_cor_as_ben_perm" value="0" id="guardian_correspondence_is_same_as_permanent" account_count="" for_address="guardian_correspondence" checked="" title="Select if is this Address same as your Permanent Address?" alt="Select if is this Address same as your Permanent Address?" type="checkbox" onclick="filladdBenGard()">&nbsp;&nbsp;&nbsp;
                                                                              <label class="mandatory mandatory_label">Is this Address same as Beneficiary Permanent Address?</label>
                                                                           </div>
                                                                           <div class="form-group">
                                                                              <input class="ben_gard_cor_as_ben_cor" name="ben_gard_cor_as_ben_cor" value="0" id="guardian_correspondence_is_same_as_correspondence" account_count="" for_address="guardian_correspondence" title="Select if is this Address same as your Correspondence Address?" onclick="GardcorAddrBenCorAddr()" alt="Select if is this Address same as your Correspondence Address?" type="checkbox">&nbsp;&nbsp;&nbsp;
                                                                              <label class="mandatory mandatory_label">Is this Address same as Beneficiary Correspondence Address?</label>
                                                                           </div>
                                                                  </div>
                                                               </div>
                                                               <div class="row" id="populate_guardian_correspondence_address">
                                                                  <div class="col-md-4">
                                                                     <div class="form-group">
                                                                        <label class="mandatory mandatory_label">Address Line 1 </label>
                                                                        <input name="ben_gard_cor_addr1" id="ben_gard_cor_addr1" class="form-control" value="" placeholder="Address Line1" maxlength="60" title="Please enter Flat / Floor / Door / Block Number of the Gaurdian's Correspondence Address" alt="Please enter Flat / Floor / Door / Block Number of the Gaurdian's Correspondence Address" data-validation="length" data-validation-length="1-60" data-validation-error-msg="Please enter valid Address Line1 for guardian correspondence address" type="text">
                                                                     </div>
                                                                  </div>
                                                                  <div class="col-md-4">
                                                                     <div class="form-group">
                                                                        <label class="mandatory mandatory_label">Address Line 2 </label>
                                                                        <input name="ben_gard_cor_addr2" id="ben_gard_cor_addr2" class="form-control" value="" placeholder="Address Line2" maxlength="60" title="Please enter Name of Premises / Building of the Gaurdian's Correspondence Address" alt="Please enter Name of Premises / Building of the Gaurdian's Correspondence Address" data-validation="length" data-validation-length="1-60" data-validation-error-msg="Please enter valid Address Line2 for guardian correspondence address" type="text">
                                                                     </div>
                                                                  </div>
                                                                  <div class="col-md-4">
                                                                     <div class="form-group">
                                                                        <label class="mandatory mandatory_label">City / Village / Town </label>
                                                                        <input name="ben_gard_cor_city" id="ben_gard_cor_city" class="form-control" value="" placeholder="City / Village / Town" maxlength="60" title="Please enter City / Village / Town for correspondence address" alt="Please enter City / Village / Town for correspondence address" data-validation="length" data-validation-length="1-60" data-validation-error-msg="Please enter valid City / Village / Town for guardian correspondence address" type="text">
                                                                     </div>
                                                                  </div>
                                                                  <div class="col-md-4">
                                                                     <div class="form-group">
                                                                        <label class="mandatory mandatory_label">State </label>
                                                                        <span id="span_guardian_correspondence_state">
                                                                           <select name="ben_gard_cor_state" id="ben_gard_cor_state" class="input-select form-control" title="Please select appropriate State" alt="Please select appropriate State" data-validation="length" data-validation-length="1-60" data-validation-error-msg="Please select a valid State">
                                                                              <option value="" selected="">Select State</option>
                                                                              <option value="35">Andaman and Nicobar Islands</option>
                                                                              <option value="25">Daman and Diu</option>
                                                                              <option value="28">Andhra Pradesh</option>
                                                                              <option value="12">Arunachal Pradesh</option>
                                                                              <option value="18">Assam</option>
                                                                              <option value="10">Bihar</option>
                                                                              <option value="4">Chandigarh</option>
                                                                              <option value="22">Chhattisgarh</option>
                                                                              <option value="26">Dadra and Nagar Haveli</option>
                                                                              <option value="7">Delhi</option>
                                                                              <option value="30">Goa</option>
                                                                              <option value="24">Gujarat</option>
                                                                              <option value="6">Haryana</option>
                                                                              <option value="2">Himachal Pradesh</option>
                                                                              <option value="1">Jammu and Kashmir</option>
                                                                              <option value="20">Jharkhand</option>
                                                                              <option value="29">Karnataka</option>
                                                                              <option value="32">Kerala</option>
                                                                              <option value="31">Lakshadweep</option>
                                                                              <option value="23">Madhya Pradesh</option>
                                                                              <option value="27">Maharashtra</option>
                                                                              <option value="14">Manipur</option>
                                                                              <option value="17">Meghalaya</option>
                                                                              <option value="15">Mizoram</option>
                                                                              <option value="13">Nagaland</option>
                                                                              <option value="21">Odisha</option>
                                                                              <option value="34">Puducherry</option>
                                                                              <option value="3">Punjab</option>
                                                                              <option value="8">Rajasthan</option>
                                                                              <option value="11">Sikkim</option>
                                                                              <option value="33">Tamil Nadu</option>
                                                                              <option value="36">Telangana</option>
                                                                              <option value="16">Tripura</option>
                                                                              <option value="5">Uttarakhand</option>
                                                                              <option value="9">Uttar Pradesh</option>
                                                                              <option value="19">West Bengal</option>
                                                                           </select>
                                                                        </span>
                                                                     </div>
                                                                  </div>
                                                                  <div class="col-md-4">
                                                                     <div class="form-group">
                                                                        <label class="mandatory mandatory_label">Pincode / Zipcode </label>
                                                                        <input name="ben_gard_cor_zip" id="ben_gard_cor_zip" class="form-control numeric" value="" placeholder="Pincode" title="Please enter PIN Code for India if Guardian's Correspondence Address is in India, Zip Code for address outside India" pattern="[0-9]{6}" alt="Please enter PIN Code for India if Guardian's Correspondence Address is in India, Zip Code for address outside India" type="text">
                                                                     </div>
                                                                  </div>
                                                                  <div class="col-md-4">
                                                                     <div class="form-group">
                                                                        <label class="mandatory mandatory_label">Country</label>
                                                                        <span id="span_guardian_correspondence_country">
                                                                           <select name="ben_gard_cor_country" id="ben_gard_cor_country" class="input-select form-control" title="Please select appropriate Country for Gaurdian's Correspondence Address" alt="Please select appropriate Country for Gaurdian's Correspondence Address" data-validation="length" data-validation-length="1-33" data-validation-error-msg="Please enter valid Country for guardian correspondence address" onchange="javascript: populate_states(this.value,'guardian_correspondence_state', 'span_guardian_correspondence_state', '102', 'toggle_other_state(\'guardian_correspondence_state\', \'guardian_correspondence_span_other_state\')');">
                                                                              <option value="102" selected="selected">India</option>
                                                                           </select>
                                                                        </span>
                                                                     </div>
                                                                  </div>
                                                               </div>
                                                            </div>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="personalInfoScroll jumbotron p-1 m-3 text-justify font-italic"><span style="color:#d33633;font-size:bigger">Note</span><br><b>* Testator:</b> A testator is a person who has written and executed a last will and testament that is in effect at the time of his/her death. It is any 'person who makes a will.<br>
                                       <b>* Beneficiary:</b> A person who receives money or property from someone who has died.
                                    </div>
                                    <div class="modal-footer">
                                       <button class="boxed_btn4 save" id="benSave" data-role="update" data-id="" data-table="will_beneficiary" data-key="ben_id">Save</button>
                                       <input type="button" class="boxed_btn4" data-dismiss="modal" value="Cancel">
                                    </div>
                                 </form>
                              </div>
                           </div>
                        </div>
                        <div id="deleteBeneficiaryModal" class="modal fade">
                           <div class="modal-dialog">
                              <div class="modal-content">
                                 <form id="deleteBeneficiary">
                                    <div class="modal-header">
                                       <h4 class="modal-title">Delete Beneficiary</h4>
                                       <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                       <p>Are you sure you want to delete these Records?</p>
                                       <p class="text-warning"><small>This action cannot be undone.</small></p>
                                    </div>
                                    <div class="modal-footer">
                                       <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                                       <input type="submit" class="btn btn-danger" value="Delete">
                                    </div>
                                 </form>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="tab-pane fade" id="executor" role="tabpanel" aria-labelledby="executor-tab-2">
                        <div class="">
                           <form action="<?= $CONFIG->siteurl; ?>./__lib.ajax/frmForm.php" name="frmexecutordetails" method="post" id="frmexecutordetails" class="frmCurrent has-validation-callback" data-formType="0">
                              <div class="card-body">
                                 <div id="executor_details">
                                    <div class="executor MentallyYes">
                                       <div class="row">
                                          <div class="col-md-6">
                                             <div class="form-group">
                                                <label class="mandatory mandatory_label">Name of Executors</label>
                                                <div class="input-group">
                                                   <div class="input-group-prepend">
                                                      <select name="exe_title" id="exe_title" class="input-select form-control" alt="Please select a Title" data-validation="length" data-validation-length="1-33" data-validation-error-msg="Please select a Title." onchange="javascript: title_change();">
                                                         <option value="" selected="">Title</option>
                                                         <option value="1">Mr. </option>
                                                         <option value="2">Mrs. </option>
                                                         <option value="3">Ms. </option>
                                                         <option value="10">Master </option>
                                                         <option value="23">Kumar </option>
                                                         <option value="24">Kumari </option>
                                                      </select>
                                                      <input class="form-control formname" placeholder="First Name" id="exe_fname" name="exe_fname" maxlength="33" value="" alt="Please enter First Name" type="text">
                                                      <input class="form-control formname" placeholder="Middle Name" id="exe_mname" name="exe_mname" maxlength="33" value="" alt="Please enter Middle Name" type="text">
                                                      <input class="form-control formname" value="" placeholder="Last Name / Surname" id="exe_lname" name="exe_lname" type="text">
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="col-md-6">
                                             <div class="form-group">
                                                <label class="mandatory mandatory_label">Executor's Father Name </label>
                                                <div class="input-group">
                                                   <div class="input-group-prepend">
                                                      <select name="exe_father_title" id="exe_father_title" class="input-select form-control formname" alt="Please select appropriate title from the dropdown list. Drop-down of the standard Titles normally used in writing Will" data-validation="length" data-validation-length="1-20" data-validation-error-msg="Please select a Title" onchange="javascript: title_change();">
                                                         <option value="" selected="">Title</option>
                                                         <option value="1">Mr. </option>
                                                         <option value="10">Master </option>
                                                      </select>
                                                      <input name="exe_father_fname" id="exe_father_fname" value="" placeholder="First Name" class="form-control formname" type="text">
                                                      <input name="exe_father_mname" id="exe_father_mname" value="" placeholder="Middle Name" class="form-control formname" pattern="[a-zA-Z]{1,15}" alt="Only alphabets are allowed" type="text">
                                                      <input name="exe_father_lname" id="exe_father_lname" value="" placeholder="Last Name / Surname" class="form-control formname" pattern="[a-zA-Z]{1,15}" type="text">
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="col-md-3">
                                             <div class="form-group">
                                                <label class="cnd-mandatory mandatory_label">Occupation </label>
                                                <input name="exe_occupation" id="exe_occupation" value="" placeholder="occupation" class="form-control formname" type="text">
                                             </div>
                                          </div>
                                          <div class="col-md-3">
                                             <div class="form-group">
                                                <label class="cnd-mandatory mandatory_label">Religion </label>
                                                <select name="exe_religious" id="exe_religious" class="input-select form-control">
                                                   <option value="" selected="">Please select</option>
                                                   <option value="1">Buddhist</option>
                                                   <option value="2">Christian</option>
                                                   <option value="3">Hindu</option>
                                                   <option value="4">Islam</option>
                                                   <option value="5">Jain</option>
                                                   <option value="6">Judaism</option>
                                                   <option value="7">Parsi</option>
                                                   <option value="8">Sikh</option>
                                                </select>
                                             </div>
                                          </div>
                                          <div class="col-md-3">
                                             <div class="form-group">
                                                <label class="cnd-mandatory mandatory_label">Nationality </label>
                                                <select name="exe_nationality" id="exe_nationality" class="input-select form-control">
                                                   <option value="Indian" selected="">Indian</option>
                                                   <!-- <option value="Other"  >Other</option> -->
                                                </select>
                                             </div>
                                          </div>
                                          <div class="col-md-3">
                                             <div class="form-group">
                                                <label class="mandatory mandatory_label">Gender </label>
                                                <select name="exe_gender" id="exe_gender" class="input-select form-control" alt="Please select appropriate gender from the dropdown list" data-validation="length" data-validation-length="1-33" data-validation-error-msg="Please select gender.">
                                                   <option value="" selected="">Please select</option>
                                                   <option value="1">Male</option>
                                                   <option value="2">Female</option>
                                                   <option value="3">Transgender</option>
                                                </select>
                                             </div>
                                          </div>
                                          <div class="col-md-3">
                                             <div class="form-group">
                                                <label class="cnd-mandatory mandatory_label">Age </label>
                                                <input type="text" id="exe_age" name="exe_age" class="form-control" value="" placeholder="Age" alt="Age">
                                             </div>
                                          </div>
                                          <div class="col-md-3">
                                             <div class="form-group">
                                                <label class="mandatory mandatory_label">Do you have relation with executor ?</label>
                                                <select name="exe_rel_with_testator" id="exe_rel_with_testator" class="input-select form-control" alt="Please select appropriate 'Relationship with Testaor' from the dropdown list" data-validation="length" data-validation-length="1-33" data-validation-error-msg="Please select a Relationship with Testator" onchange="javascript: toggle_other_relation('relationship_with_testator', 'span_beneficary_relationship');">
                                                   <option value="" selected="">Please select</option>
                                                   <option value="2">Spouse</option>
                                                   <option value="3">Son</option>
                                                   <option value="4">Daughter</option>
                                                   <option value="5">Mother</option>
                                                   <option value="6">Father</option>
                                                   <option value="7">Brother</option>
                                                   <option value="8">Sister</option>
                                                   <option value="19">Grand Daughter</option>
                                                   <option value="20">Grandson</option>
                                                   <option value="21">Grand Father</option>
                                                   <option value="22">Grand Mother</option>
                                                   <option value="23">Son-in-Law</option>
                                                   <option value="24">Daughter-in-law</option>
                                                   <option value="99">Other</option>
                                                </select>
                                             </div>
                                          </div>
                                          <div class="col-md-3">
                                             <div class="form-group">
                                                <span id="span_beneficary_relationship" style="display:none;">
                                                   <div class="col-md-3 last">
                                                      <label class="cnd-mandatory mandatory_label">Other Relation (If not listed) </label>
                                                      <input class="form-control" name="exe_other_rel" value="" placeholder="Relationship" type="text" id="exe_other_rel">
                                                   </div>
                                                </span>
                                             </div>
                                          </div>
                                       </div>
                                       <hr class="my-4">
                                       <h2 class="mt-4">Residential Address</h2>
                                       <div class="row">
                                          <div class="col-md-3">
                                             <div class="form-group">
                                                <label class="mandatory mandatory_label">Address Line1 </label>
                                                <input class="form-control" placeholder="Address Line1" id="exe_perm_addr1" name="exe_perm_addr1" maxlength="60" data-validation="length" data-validation-length="1-60" data-validation-error-msg="Please enter valid Address Line1" value="" alt="Please enter Flat / Floor / Door / Block Number as applicable" type="text">
                                             </div>
                                          </div>
                                          <div class="col-md-3">
                                             <div class="form-group">
                                                <label class="mandatory mandatory_label">Address Line2 </label>
                                                <input class="form-control" placeholder="Address Line2" id="exe_perm_addr2" name="exe_perm_addr2" maxlength="60" data-validation="length" data-validation-length="1-60" data-validation-error-msg="Please enter Address Line2" value="" alt="Please enter Name of Premises / Building of Permanent Address" type="text">
                                             </div>
                                          </div>
                                          <div class="col-md-3">
                                             <div class="form-group">
                                                <label class="mandatory_label">City / Village / Town </label>
                                                <input class="form-control" placeholder="City / Village / Town" id="exe_perm_city" name="exe_perm_city" maxlength="60" value="" alt="Please select a City / Village / Town for permanent address" data-validation="length" data-validation-length="1-60" data-validation-error-msg="Please enter valid name of City / Village / Town for permanent address" type="text">
                                             </div>
                                          </div>
                                          <div class="col-md-3">
                                             <div class="form-group">
                                                <label class="mandatory mandatory_label">State </label>
                                                <span id="span_permanent_state">
                                                   <select name="exe_perm_state" id="exe_perm_state" class="input-select form-control" alt="Please select appropriate State" data-validation="length" data-validation-length="1-60" data-validation-error-msg="Please select a valid State" onchange="javascript: toggle_other_state('permanent_state', 'permanent_span_other_state');">
                                                      <option value="" selected="">Select State</option>
                                                      <option value="35">Andaman and Nicobar Islands</option>
                                                      <option value="25">Daman and Diu</option>
                                                      <option value="28">Andhra Pradesh</option>
                                                      <option value="12">Arunachal Pradesh</option>
                                                      <option value="18">Assam</option>
                                                      <option value="10">Bihar</option>
                                                      <option value="4">Chandigarh</option>
                                                      <option value="22">Chhattisgarh</option>
                                                      <option value="26">Dadra and Nagar Haveli</option>
                                                      <option value="7">Delhi</option>
                                                      <option value="30">Goa</option>
                                                      <option value="24">Gujarat</option>
                                                      <option value="6">Haryana</option>
                                                      <option value="2">Himachal Pradesh</option>
                                                      <option value="1">Jammu and Kashmir</option>
                                                      <option value="20">Jharkhand</option>
                                                      <option value="29">Karnataka</option>
                                                      <option value="32">Kerala</option>
                                                      <option value="31">Lakshadweep</option>
                                                      <option value="23">Madhya Pradesh</option>
                                                      <option value="27">Maharashtra</option>
                                                      <option value="14">Manipur</option>
                                                      <option value="17">Meghalaya</option>
                                                      <option value="15">Mizoram</option>
                                                      <option value="13">Nagaland</option>
                                                      <option value="21">Odisha</option>
                                                      <option value="34">Puducherry</option>
                                                      <option value="3">Punjab</option>
                                                      <option value="8">Rajasthan</option>
                                                      <option value="11">Sikkim</option>
                                                      <option value="33">Tamil Nadu</option>
                                                      <option value="36">Telangana</option>
                                                      <option value="16">Tripura</option>
                                                      <option value="5">Uttarakhand</option>
                                                      <option value="9">Uttar Pradesh</option>
                                                      <option value="19">West Bengal</option>
                                                   </select>
                                                </span>
                                             </div>
                                          </div>
                                          <div class="col-md-3">
                                             <div class="form-group">
                                                <label class="mandatory mandatory_label">Pincode / ZipCode </label>
                                                <input class="form-control numeric" placeholder="Pincode" id="exe_perm_zip" value="" name="exe_perm_zip" alt="Please enter PIN Code for India if Permanent Address is in India, Zip Code for address outside India" type="text">
                                             </div>
                                          </div>
                                          <div class="col-md-3">
                                             <div class="form-group">
                                                <label class="mandatory mandatory_label">Country </label>
                                                <span id="span_permanent_country">
                                                   <select name="exe_perm_country" id="exe_perm_country" class="input-select form-control" alt="Please select appropriate Country for Permanent Address" data-validation="length" data-validation-length="1-60" data-validation-error-msg="Please select a valid Country for permanent address" onchange="javascript: populate_states(this.value,'permanent_state', 'span_permanent_state', '0', 'toggle_other_state(\'permanent_state\', \'permanent_span_other_state\')'); toggle_other_state_country(this.value, 'permanent_span_other_state'); toggle_other_state('permanent_state', 'permanent_span_other_state');">
                                                      <option value="102" selected="selected">India</option>
                                                   </select>
                                                </span>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="personalInfoScroll jumbotron p-1 mb-3 text-justify align-middle font-italic"><span style="color:#d33633;font-size:bigger">Note</span><br><b>* Executor:</b> An executor is a person/institution who is the legal representative,
                                 named in a will or implied as such, to carry out the process of the distribution of the assets of the testator.
                              </div>
                              <div class="card-footer text-center">
                                 <!-- <a class="btn btn-danger btn-sm float-left btnNext" id="left" style="color:white">Previous</a> -->
                                 <button class="btn btn-danger btn-sm save" style="color:white" data-role="update" data-id="" data-table="will_executor" data-key="exe_id">Save</button>
                                 <!-- <a class="btn btn-danger btn-sm float-right btnNext" id="right" style="color:white">Next</a>  -->
                              </div>
                           </form>
                        </div>
                     </div>
                     <div class="tab-pane fade" id="assets" role="tabpanel" aria-labelledby="assets-tab-2">
                        <div class="">
                           <div class="card-body">
                              <div class="row">
                                 <div class="col-lg-2 no-gutters">
                                    <div class="nav flex-md-column nav-pills justify-content-center" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                       <ul class="nav nav-tabs nav-fill">
                                          <li><a class="nav-link text-left active" id="v-pills-ba-tab" data-toggle="pill" href="#v-pills-ba" role="tab" aria-controls="v-pills-ba" aria-selected="true">Bank Accounts</a></li>
                                          <li><a class="nav-link text-left" id="v-pills-smfb-tab" data-toggle="pill" href="#v-pills-smfb" role="tab" aria-controls="v-pills-smfb" aria-selected="false">Securities/MF/Bonds</a></li>
                                          <li><a class="nav-link text-left" id="v-pills-ip-tab" data-toggle="pill" href="#v-pills-ip" role="tab" aria-controls="v-pills-ip" aria-selected="false">Immovable Properties</a></li>
                                          <li><a class="nav-link text-left" id="v-pills-b-tab" data-toggle="pill" href="#v-pills-b" role="tab" aria-controls="v-pills-b" aria-selected="false">Business</a></li>
                                          <li><a class="nav-link text-left" id="v-pills-rf-tab" data-toggle="pill" href="#v-pills-rf" role="tab" aria-controls="v-pills-rf" aria-selected="false">Retirement Funds</a></li>
                                          <li><a class="nav-link text-left" id="v-pills-gi-tab" data-toggle="pill" href="#v-pills-gi" role="tab" aria-controls="v-pills-gi" aria-selected="false">General Insurance</a></li>
                                          <li><a class="nav-link text-left" id="v-pills-lip-tab" data-toggle="pill" href="#v-pills-lip" role="tab" aria-controls="v-pills-lip" aria-selected="false">Life Insurance Policies</a></li>
                                          <li><a class="nav-link text-left" id="v-pills-j-tab" data-toggle="pill" href="#v-pills-j" role="tab" aria-controls="v-pills-j" aria-selected="false">Jewellery</a></li>
                                          <li><a class="nav-link text-left" id="v-pills-bo-tab" data-toggle="pill" href="#v-pills-bo" role="tab" aria-controls="v-pills-bo" aria-selected="false">Body Organs</a></li>
                                          <li><a class="nav-link text-left" id="v-pills-pa-tab" data-toggle="pill" href="#v-pills-pa" role="tab" aria-controls="v-pills-pa" aria-selected="false">Pet Animals</a></li>
                                          <li><a class="nav-link text-left" id="v-pills-oa-tab" data-toggle="pill" href="#v-pills-oa" role="tab" aria-controls="v-pills-oa" aria-selected="false">Other Assets</a></li>
                                          <li><a class="nav-link text-left" id="v-pills-l-tab" data-toggle="pill" href="#v-pills-l" role="tab" aria-controls="v-pills-l" aria-selected="false">Liabilities</a></li>
                                       </ul>
                                    </div>
                                 </div>
                                 <div class="col-lg-10 no-gutters">
                                    <div class="tab-content" id="v-pills-tabContent">
                                       <div class="tab-pane fade show active" id="v-pills-ba" role="tabpanel" aria-labelledby="v-pills-ba-tab">
                                          <div class="panel-body-small2" id="balist">
                                             <!-- Nav tabs -->
                                             <ul class="nav nav-tabs nav-fill" role="tablist" id="v-pills-ba_list">
                                                <li role="presentation" class="nav-item  active"><a class="nav-link text-center active" href="#bankAccounts" aria-controls="bankAccounts" role="tab" data-toggle="tab">Bank Accounts</a></li>
                                                <li role="presentation" class="nav-item "><a class="nav-link text-center" href="#lockers" aria-controls="lockers" role="tab" data-toggle="tab">Lockers</a></li>
                                                <li role="presentation" class="nav-item "><a class="nav-link text-center" href="#fixedDeposits" aria-controls="fixedDeposits" role="tab" data-toggle="tab">Fixed Deposits</a></li>
                                             </ul>
                                             <!-- Tab panes -->
                                             <div class="tab-content">
                                                <div role="tabpanel" class="tab-pane active show" id="bankAccounts">
                                                   <div class="row no-gutters">
                                                      <div class="col-xl-12" id="bnkacAddWrap">
                                                         <a href="#bankAccountModal" id="addBankAcModal" class="add_btn float-right add" data-toggle="modal"><i class="fas fa-plus mr-1" aria-hidden="true" style="font-size: inherit; color: inherit;"></i><span>Add Bank Account</span></a>
                                                         <div class="table-responsive mt-2">
                                                            <table class="table table-bordered" id="bankAccountsTable" style="width: 100%;">
                                                               <thead class="thead-light">
                                                                  <tr>
                                                                     <th>Bank Name</th>
                                                                     <th>A/c Number</th>
                                                                     <th>Account Type</th>
                                                                     <th>Used Percentage</th>
                                                                     <th>Balance Percentage</th>
                                                                     <th style="width: 266px;">Actions</th>
                                                                  </tr>
                                                               </thead>
                                                               <tbody>

                                                               </tbody>
                                                            </table>
                                                            <div style="display:none">
                                                               <table id="detailsTable">
                                                                  <thead class="btn-primary-rect">
                                                                     <tr>
                                                                        <th>Beneficiary</th>
                                                                        <th>Percentage</th>
                                                                        <th>Actions</th>
                                                                     </tr>
                                                                  </thead>
                                                                  <tbody></tbody>
                                                               </table>
                                                            </div>
                                                         </div>
                                                      </div>
                                                   </div>
                                                   <div id="bankAccountModal" class="modal fade">
                                                      <div class="modal-dialog modal-lg">
                                                         <div class="modal-content">
                                                            <form data-formType="1" name="addBankAccount" id="addBankAccount" action="<?= $CONFIG->siteurl; ?>./__lib.ajax/frmForm.php" method="post" class="frmCurrent has-validation-callback">
                                                               <div class="modal-header">
                                                                  <h4 class="modal-title">Add Bank Account</h4>
                                                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                               </div>
                                                               <div class="modal-body">
                                                                  <div class="row">
                                                                     <div class="col-md-4">
                                                                        <div class="form-group">
                                                                           <label class="mandatory mandatory_label">Account Number</label>
                                                                           <input class="form-control numeric" name="ba_ac_number" id="ba_ac_number" value="" placeholder="Account No." alt="Please enter Account No" type="text">
                                                                        </div>
                                                                     </div>
                                                                     <div class="col-md-4">
                                                                        <div class="form-group">
                                                                           <label class="mandatory mandatory_label">Name of Bank </label>
                                                                           <input class="form-control" name="ba_bank_name" id="ba_bank_name" value="" placeholder="Name of bank" alt="Please enter Bank Name" type="text">
                                                                        </div>
                                                                     </div>
                                                                     <div class="col-md-4">
                                                                        <div class="form-group">
                                                                           <label class="mandatory  mandatory_label">Branch Name </label>
                                                                           <input class="form-control" name="ba_branch_name" id="ba_branch_name" value="" placeholder="Branch name" alt="Please enter Branch Name" type="text">
                                                                        </div>
                                                                     </div>
                                                                     <div class="col-md-4">
                                                                        <div class="form-group">
                                                                           <label class="mandatory mandatory_label">Type of Account</label>
                                                                           <select name="ba_account_type" id="ba_account_type" class="input-select form-control" alt="Please select Type of Account">
                                                                              <option value="" selected="">Please select</option>
                                                                              <option value="1">Current</option>
                                                                              <option value="2">Savings</option>
                                                                              <option value="3">ESCROW</option>
                                                                           </select>
                                                                        </div>
                                                                     </div>
                                                                     <div class="col-md-4">
                                                                        <div class="form-group">
                                                                           <label class="mandatory mandatory_label">Address Line 1</label>
                                                                           <input class="form-control" name="ba_addr1" id="ba_addr1" value="" placeholder="Address Line 1" alt="Please enter Address Line1" type="text">
                                                                        </div>
                                                                     </div>
                                                                     <div class="col-md-4">
                                                                        <div class="form-group">
                                                                           <label class="mandatory mandatory_label">Address Line 2</label>
                                                                           <input class="form-control" name="ba_addr2" id="ba_addr2" value="" placeholder="Address Line 2" alt="Please enter Address Line2" type="text">
                                                                        </div>
                                                                     </div>
                                                                     <div class="col-md-4">
                                                                        <div class="form-group">
                                                                           <label class="mandatory mandatory_label">City / Village / Town</label>
                                                                           <input class="form-control" name="ba_city" id="ba_city" value="" placeholder="City / Village / Town" alt="Please enter City / Village / Town" type="text">
                                                                        </div>
                                                                     </div>
                                                                     <div class="col-md-4">
                                                                        <div class="form-group">
                                                                           <label class="mandatory mandatory_label">State</label>
                                                                           <span id="span_state">
                                                                              <select name="ba_state" id="ba_state" class="input-select form-control" alt="Please select appropriate State">
                                                                                 <option value="" selected="">Select State</option>
                                                                                 <option value="35">Andaman and Nicobar Islands</option>
                                                                                 <option value="25">Daman and Diu</option>
                                                                                 <option value="28">Andhra Pradesh</option>
                                                                                 <option value="12">Arunachal Pradesh</option>
                                                                                 <option value="18">Assam</option>
                                                                                 <option value="10">Bihar</option>
                                                                                 <option value="4">Chandigarh</option>
                                                                                 <option value="22">Chhattisgarh</option>
                                                                                 <option value="26">Dadra and Nagar Haveli</option>
                                                                                 <option value="7">Delhi</option>
                                                                                 <option value="30">Goa</option>
                                                                                 <option value="24">Gujarat</option>
                                                                                 <option value="6">Haryana</option>
                                                                                 <option value="2">Himachal Pradesh</option>
                                                                                 <option value="1">Jammu and Kashmir</option>
                                                                                 <option value="20">Jharkhand</option>
                                                                                 <option value="29">Karnataka</option>
                                                                                 <option value="32">Kerala</option>
                                                                                 <option value="31">Lakshadweep</option>
                                                                                 <option value="23">Madhya Pradesh</option>
                                                                                 <option value="27">Maharashtra</option>
                                                                                 <option value="14">Manipur</option>
                                                                                 <option value="17">Meghalaya</option>
                                                                                 <option value="15">Mizoram</option>
                                                                                 <option value="13">Nagaland</option>
                                                                                 <option value="21">Odisha</option>
                                                                                 <option value="34">Puducherry</option>
                                                                                 <option value="3">Punjab</option>
                                                                                 <option value="8">Rajasthan</option>
                                                                                 <option value="11">Sikkim</option>
                                                                                 <option value="33">Tamil Nadu</option>
                                                                                 <option value="36">Telangana</option>
                                                                                 <option value="16">Tripura</option>
                                                                                 <option value="5">Uttarakhand</option>
                                                                                 <option value="9">Uttar Pradesh</option>
                                                                                 <option value="19">West Bengal</option>
                                                                              </select>
                                                                           </span>
                                                                        </div>
                                                                     </div>
                                                                     <div class="col-md-4">
                                                                        <div class="form-group">
                                                                           <label class="mandatory mandatory_label">Pincode</label>
                                                                           <input class="form-control numeric" name="ba_zip" id="ba_zip" value="" placeholder="Pincode" alt="Please enter Pincode" type="text">
                                                                        </div>
                                                                     </div>
                                                                     <div class="col-md-4">
                                                                        <div class="form-group">
                                                                           <label class="mandatory mandatory_label">Country</label>
                                                                           <select name="ba_country" id="ba_country" class="input-select form-control" alt="Please select a Country" onchange="javascript: populate_states(this.value,'state', 'span_state', '0','toggle_other_state(\'state\',\'state_other\')'); toggle_other_state_country(this.value, 'span_state_other');;">
                                                                              <option value="102" selected="selected">India</option>
                                                                           </select>
                                                                        </div>
                                                                     </div>
                                                                     <div class="col-md-4">
                                                                        <div class="form-group">
                                                                           <label class="mandatory mandatory_label">% of ownership</label>
                                                                           <input class="form-control" name="ba_ownership_perc" id="ba_ownership_perc" value="" placeholder="% of ownership" type="text">
                                                                           <input class="form-control" name="ba_usedperc" id="ba_usedperc" value="0" maxlength="3" min="1" max="100" type="hidden">
                                                                           <input class="form-control" name="ba_balperc" id="ba_balperc" value="100" maxlength="3" min="1" max="100" type="hidden">
                                                                        </div>
                                                                     </div>
                                                                  </div>
                                                               </div>
                                                               <div class="personalInfoScroll jumbotron p-1 font-italic m-2 text-justify"><span style="color:#d33633;font-size:bigger">Note</span><br><b>* % of ownership:</b> if the bank account held individually, then 100% and if the bank account held jointly with someone then % of ownership in the bank account so held along with other members
                                                               </div>


                                                               <div class="modal-footer">
                                                                  <button class="boxed_btn4 save" data-role="update" data-id="" data-table="will_bank_accounts" data-key="pk_bk_id">Save</button>
                                                                  <input type="button" class="boxed_btn4" data-dismiss="modal" value="Cancel">
                                                               </div>
                                                            </form>

                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                                <div role="tabpanel" class="tab-pane" id="lockers">
                                                   <div class="row no-gutters">
                                                      <div class="table-responsive mt-2">
                                                         <a href="#bankLockerModal" class="add_btn float-right add" data-toggle="modal"><i class="fas fa-plus mr-1" aria-hidden="true" style="font-size: inherit; color: inherit;"></i><span>Add Bank Locker</span></a>
                                                         <table class="table table-bordered" id="bankLockerTable">
                                                            <thead class="thead-light">
                                                               <tr>
                                                                  <th>Bank Name</th>
                                                                  <th>Locker Number</th>
                                                                  <th>Used Percentage</th>
                                                                  <th>Balance Percentage</th>
                                                                  <th style="width: 266px;">Action</th>
                                                               </tr>
                                                            </thead>
                                                            <tbody>

                                                            </tbody>
                                                         </table>
                                                      </div>
                                                   </div>
                                                   <div id="bankLockerModal" class="modal fade">
                                                      <div class="modal-dialog modal-lg">
                                                         <div class="modal-content">
                                                            <form data-formType="1" name="addLockerAccount" id="addLockerAccount" action="<?= $CONFIG->siteurl; ?>./__lib.ajax/frmForm.php" method="post" class="frmCurrent has-validation-callback">
                                                               <div class="modal-header">
                                                                  <h4 class="modal-title">Add Bank Locker</h4>
                                                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                               </div>
                                                               <div class="modal-body">
                                                                  <div class="row">
                                                                     <div class="col-md-4">
                                                                        <div class="form-group">
                                                                           <label class="mandatory mandatory_label">Locker Number</label>
                                                                           <input class="form-control" name="loc_number" id="loc_number" value="" placeholder="Locker Number" alt="Please enter Locker Number" type="text">
                                                                        </div>
                                                                     </div>
                                                                     <div class="col-md-4">
                                                                        <div class="form-group">
                                                                           <label class="mandatory mandatory_label">Name of Bank </label>
                                                                           <input class="form-control" name="loc_bank_name" id="loc_bank_name" value="" placeholder="Name of the bank" alt="Please enter Bank Name" type="text">
                                                                        </div>
                                                                     </div>
                                                                     <div class="col-md-4">
                                                                        <div class="form-group">
                                                                           <label class="mandatory mandatory_label">Branch Name </label>
                                                                           <input class="form-control" name="loc_branch_name" id="loc_branch_name" value="" placeholder="Branch name" alt="Please enter Branch Name" type="text">
                                                                        </div>
                                                                     </div>
                                                                     <div class="col-md-4">
                                                                        <div class="form-group">
                                                                           <label class="mandatory mandatory_label">Address Line 1</label>
                                                                           <input class="form-control" name="loc_addr1" id="loc_addr1" value="" placeholder="Address Line 1" alt="Please enter Address Line1" type="text">
                                                                        </div>
                                                                     </div>
                                                                     <div class="col-md-4">
                                                                        <div class="form-group">
                                                                           <label class="mandatory mandatory_label">Address Line 2</label>
                                                                           <input class="form-control" name="loc_addr2" id="loc_addr2" value="" placeholder="Address Line 2" alt="Please enter Address Line2" type="text">
                                                                        </div>
                                                                     </div>
                                                                     <div class="col-md-4">
                                                                        <div class="form-group">
                                                                           <label class="mandatory mandatory_label">City / Village / Town</label>
                                                                           <input class="form-control" name="loc_city" id="loc_city" value="" placeholder="City / Village / Town" type="text">
                                                                        </div>
                                                                     </div>
                                                                     <div class="col-md-4">
                                                                        <div class="form-group">
                                                                           <label class="mandatory mandatory_label">Pincode</label>
                                                                           <input class="form-control numeric" name="loc_zip" id="loc_zip" value="" placeholder="Pincode" alt="Please enter Pincode" type="text">
                                                                        </div>
                                                                     </div>
                                                                     <div class="col-md-4">
                                                                        <div class="form-group">
                                                                           <label class="mandatory mandatory_label">State
                                                                              <!--  -->
                                                                           </label>
                                                                           <span id="span_state">
                                                                              <select name="loc_state" id="loc_state" class="input-select form-control" alt="Please select appropriate State">
                                                                                 <option value="" selected="">Select State</option>
                                                                                 <option value="35">Andaman and Nicobar Islands</option>
                                                                                 <option value="25">Daman and Diu</option>
                                                                                 <option value="28">Andhra Pradesh</option>
                                                                                 <option value="12">Arunachal Pradesh</option>
                                                                                 <option value="18">Assam</option>
                                                                                 <option value="10">Bihar</option>
                                                                                 <option value="4">Chandigarh</option>
                                                                                 <option value="22">Chhattisgarh</option>
                                                                                 <option value="26">Dadra and Nagar Haveli</option>
                                                                                 <option value="7">Delhi</option>
                                                                                 <option value="30">Goa</option>
                                                                                 <option value="24">Gujarat</option>
                                                                                 <option value="6">Haryana</option>
                                                                                 <option value="2">Himachal Pradesh</option>
                                                                                 <option value="1">Jammu and Kashmir</option>
                                                                                 <option value="20">Jharkhand</option>
                                                                                 <option value="29">Karnataka</option>
                                                                                 <option value="32">Kerala</option>
                                                                                 <option value="31">Lakshadweep</option>
                                                                                 <option value="23">Madhya Pradesh</option>
                                                                                 <option value="27">Maharashtra</option>
                                                                                 <option value="14">Manipur</option>
                                                                                 <option value="17">Meghalaya</option>
                                                                                 <option value="15">Mizoram</option>
                                                                                 <option value="13">Nagaland</option>
                                                                                 <option value="21">Odisha</option>
                                                                                 <option value="34">Puducherry</option>
                                                                                 <option value="3">Punjab</option>
                                                                                 <option value="8">Rajasthan</option>
                                                                                 <option value="11">Sikkim</option>
                                                                                 <option value="33">Tamil Nadu</option>
                                                                                 <option value="36">Telangana</option>
                                                                                 <option value="16">Tripura</option>
                                                                                 <option value="5">Uttarakhand</option>
                                                                                 <option value="9">Uttar Pradesh</option>
                                                                                 <option value="19">West Bengal</option>
                                                                              </select>
                                                                           </span>
                                                                        </div>
                                                                     </div>
                                                                     <div class="col-md-4">
                                                                        <div class="form-group">
                                                                           <label class="mandatory mandatory_label">Country
                                                                              <!--  -->
                                                                           </label>
                                                                           <select name="loc_country" id="loc_country" class="input-select form-control" alt="Please select a Country" onchange="javascript: populate_states(this.value,'state', 'span_state', '0','toggle_other_state(\'state\',\'state_other\')'); toggle_other_state_country(this.value, 'state_other');;">

                                                                              <option value="102" selected="selected">India</option>
                                                                           </select>
                                                                        </div>
                                                                     </div>
                                                                     <div class="col-md-4">
                                                                        <div class="form-group">
                                                                           <label class="mandatory mandatory_label">% of ownership</label>
                                                                           <div class="input-group suffix">
                                                                              <input class="form-control percentage_in" name="loc_ownership_perc" id="loc_ownership_perc" value="" placeholder="% of ownership" alt="Please enter percentage of locker ownership" type="text">
                                                                              <span class="input-group-addon ">%</span>
                                                                           </div>
                                                                           <input class="form-control" name="ba_usedperc" id="ba_usedperc" value="0" maxlength="3" min="1" max="100" type="hidden">
                                                                           <input class="form-control" name="ba_balperc" id="ba_balperc" value="100" maxlength="3" min="1" max="100" type="hidden">
                                                                        </div>
                                                                     </div>
                                                                  </div>
                                                               </div>
                                                               <div class="modal-footer">
                                                                  <button class="boxed_btn4 save" data-role="update" data-id="" data-table="will_locker_info" data-key="pk_locker_id">Save</button>
                                                                  <input type="button" class="boxed_btn4" data-dismiss="modal" value="Cancel">
                                                               </div>
                                                            </form>

                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                                <div role="tabpanel" class="tab-pane" id="fixedDeposits">
                                                   <div class="row no-gutters">
                                                      <div class="table-responsive mt-2">
                                                         <a href="#bankFDModal" class="add_btn float-right add" data-toggle="modal"><i class="fas fa-plus mr-1" aria-hidden="true" style="font-size: inherit; color: inherit;"></i><span>Add Fixed Deposit</span></a>
                                                         <table class="table table-bordered" id="bankFDTable">
                                                            <thead class="thead-light">
                                                               <tr>
                                                                  <th>Bank Name</th>
                                                                  <th>FD Number</th>
                                                                  <th>Used Percentage</th>
                                                                  <th>Balance Percentage</th>
                                                                  <th style="width: 266px;">Action</th>
                                                               </tr>
                                                            </thead>
                                                            <tbody>

                                                            </tbody>
                                                         </table>
                                                      </div>
                                                   </div>
                                                   <div id="bankFDModal" class="modal fade">
                                                      <div class="modal-dialog modal-lg">
                                                         <div class="modal-content">
                                                            <form data-formType="1" name="addFixedDeposit" id="addFixedDeposit" action="<?= $CONFIG->siteurl; ?>./__lib.ajax/frmForm.php" method="post" class="frmCurrent has-validation-callback">
                                                               <div class="modal-header">
                                                                  <h4 class="modal-title">Fixed Deposit</h4>
                                                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                               </div>
                                                               <div class="modal-body">
                                                                  <div class="row">
                                                                     <div class="col-md-4">
                                                                        <div class="form-group">
                                                                           <label class="mandatory mandatory_label">Account Number</label>
                                                                           <input class="form-control " name="fd_ac_number" id="fd_ac_number" value="" placeholder="Account No." alt="Please enter valid Account Number" type="text">
                                                                        </div>
                                                                     </div>
                                                                     <div class="col-md-4">
                                                                        <div class="form-group">
                                                                           <label class="mandatory mandatory_label">IFSC</label>
                                                                           <input class="form-control" name="fd_ifsc_code" id="fd_ifsc_code" value="" placeholder="IFSC Code" alt="Please enter IFSC code" type="text">
                                                                        </div>
                                                                     </div>
                                                                     <div class="col-md-4">
                                                                        <div class="form-group">
                                                                           <label class="mandatory mandatory_label">Name of Bank</label>
                                                                           <input class="form-control" name="fd_bank_name" id="fd_bank_name" value="" placeholder="Name of the bank" alt="Please enter valid Bank Name" type="text">
                                                                        </div>
                                                                     </div>
                                                                     <div class="col-md-4">
                                                                        <div class="form-group">
                                                                           <label class="mandatory mandatory_label">Branch Name</label>
                                                                           <input class="form-control" name="fd_branch_name" id="fd_branch_name" value="" placeholder="Branch name" alt="Please enter Branch Name" type="text">
                                                                        </div>
                                                                     </div>
                                                                     <div class="col-md-4">
                                                                        <div class="form-group">
                                                                           <label class="mandatory mandatory_label">Address Line 1</label>
                                                                           <input class="form-control" name="fd_addr1" id="fd_addr1" value="" placeholder="Address Line 1" alt="Please enter Address Line1" type="text">
                                                                        </div>
                                                                     </div>
                                                                     <div class="col-md-4">
                                                                        <div class="form-group">
                                                                           <label class="mandatory mandatory_label">Address Line 2</label>
                                                                           <input class="form-control" name="fd_addr2" id="fd_addr2" value="" placeholder="Address Line 2" alt="Please enter Address Line2" type="text">
                                                                        </div>
                                                                     </div>
                                                                     <div class="col-md-4">
                                                                        <div class="form-group">
                                                                           <label class="mandatory">Address Line 3</label>
                                                                           <input class="form-control" name="fd_addr3" id="fd_addr3" value="" placeholder="Address Line 3" alt="Please enter Address Line3" type="text">
                                                                        </div>
                                                                     </div>
                                                                     <div class="col-md-4">
                                                                        <div class="form-group">
                                                                           <label class="mandatory  mandatory_label">City / Village / Town </label>
                                                                           <input class="form-control" name="fd_city" id="fd_city" value="" placeholder="City / Village / Town" alt="Please enter City / Village / Town" type="text">
                                                                        </div>
                                                                     </div>
                                                                     <div class="col-md-4">
                                                                        <div class="form-group">
                                                                           <label class="mandatory mandatory_label">State
                                                                              <!--  -->
                                                                           </label>
                                                                           <span id="span_state">
                                                                              <select name="fd_state" id="fd_state" class="input-select form-control" alt="Please select appropriate State">
                                                                                 <option value="" selected="">Select State</option>
                                                                                 <option value="35">Andaman and Nicobar Islands</option>
                                                                                 <option value="25">Daman and Diu</option>
                                                                                 <option value="28">Andhra Pradesh</option>
                                                                                 <option value="12">Arunachal Pradesh</option>
                                                                                 <option value="18">Assam</option>
                                                                                 <option value="10">Bihar</option>
                                                                                 <option value="4">Chandigarh</option>
                                                                                 <option value="22">Chhattisgarh</option>
                                                                                 <option value="26">Dadra and Nagar Haveli</option>
                                                                                 <option value="7">Delhi</option>
                                                                                 <option value="30">Goa</option>
                                                                                 <option value="24">Gujarat</option>
                                                                                 <option value="6">Haryana</option>
                                                                                 <option value="2">Himachal Pradesh</option>
                                                                                 <option value="1">Jammu and Kashmir</option>
                                                                                 <option value="20">Jharkhand</option>
                                                                                 <option value="29">Karnataka</option>
                                                                                 <option value="32">Kerala</option>
                                                                                 <option value="31">Lakshadweep</option>
                                                                                 <option value="23">Madhya Pradesh</option>
                                                                                 <option value="27">Maharashtra</option>
                                                                                 <option value="14">Manipur</option>
                                                                                 <option value="17">Meghalaya</option>
                                                                                 <option value="15">Mizoram</option>
                                                                                 <option value="13">Nagaland</option>
                                                                                 <option value="21">Odisha</option>
                                                                                 <option value="34">Puducherry</option>
                                                                                 <option value="3">Punjab</option>
                                                                                 <option value="8">Rajasthan</option>
                                                                                 <option value="11">Sikkim</option>
                                                                                 <option value="33">Tamil Nadu</option>
                                                                                 <option value="36">Telangana</option>
                                                                                 <option value="16">Tripura</option>
                                                                                 <option value="5">Uttarakhand</option>
                                                                                 <option value="9">Uttar Pradesh</option>
                                                                                 <option value="19">West Bengal</option>
                                                                              </select>
                                                                           </span>
                                                                        </div>
                                                                     </div>
                                                                     <div class="col-md-4">
                                                                        <div class="form-group">
                                                                           <label class="mandatory  mandatory_label">Country</label>
                                                                           <select name="fd_country" id="fd_country" class="input-select form-control" alt="Please select a Country" onchange="javascript: populate_states(this.value,'state', 'span_state', '0','toggle_other_state(\'state\',\'state_other\')'); toggle_other_state_country(this.value, 'span_state_other');">

                                                                              <option value="102" selected="selected">India</option>
                                                                           </select>
                                                                        </div>
                                                                     </div>
                                                                     <div class="col-md-4">
                                                                        <div class="form-group">
                                                                           <label class="mandatory  mandatory_label">Pincode </label>
                                                                           <input class="form-control numeric" name="fd_zip" id="fd_zip" value="" placeholder="Pincode" alt="Please enter Pincode" type="text">
                                                                        </div>
                                                                     </div>
                                                                     <div class="col-md-4">
                                                                        <div class="form-group">
                                                                           <label class="mandatory  mandatory_label">% of ownership</label>
                                                                           <div class="input-group suffix">
                                                                              <input class="form-control percentage_in" name="fd_ownership_perc" id="fd_ownership_perc" value="" placeholder="% of ownership" required maxlength="30" data-validation="length" data-validation-length="1-30" data-validation-error-msg="Please enter valid percentage of locker ownership" alt="Please enter percentage of locker ownership" type="text">
                                                                              <span class="input-group-addon ">%</span>
                                                                           </div>
                                                                           <input class="form-control" name="ba_usedperc" id="ba_usedperc" value="0" maxlength="3" min="1" max="100" type="hidden">
                                                                           <input class="form-control" name="ba_balperc" id="ba_balperc" value="100" maxlength="3" min="1" max="100" type="hidden">
                                                                        </div>
                                                                     </div>
                                                                  </div>
                                                               </div>
                                                               <div class="modal-footer">
                                                                  <button class="boxed_btn4 save" data-role="update" data-id="" data-table="will_fixed_deposit" data-key="pk_fd_id">Save</button>
                                                                  <input type="button" class="boxed_btn4" data-dismiss="modal" value="Cancel">
                                                               </div>
                                                            </form>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="tab-pane fade" id="v-pills-smfb" role="tabpanel" aria-labelledby="v-pills-smfb-tab">
                                          <div class="panel-body-small2" id="smfblist">
                                             <!-- Nav tabs -->
                                             <ul class="nav nav-tabs nav-fill" role="tablist" id="v-pills-smfb-list">
                                                <li role="presentation" class="nav-item active"><a class="nav-link text-center active" href="#mf" aria-controls="mf" role="tab" data-toggle="tab">Mutual Funds</a></li>
                                                <li role="presentation" class="nav-item"><a class="nav-link text-center" href="#shares" aria-controls="shares" role="tab" data-toggle="tab">Shares</a></li>
                                                <li role="presentation" class="nav-item"><a class="nav-link text-center" href="#bonds" aria-controls="bonds" role="tab" data-toggle="tab">Bonds</a></li>
                                             </ul>
                                             <!-- Tab panes -->
                                             <div class="tab-content">
                                                <div role="tabpanel" class="tab-pane active show" id="mf">
                                                   <div class="row no-gutters">
                                                      <div class="col-xl-12" id="bnkacAddWrap">
                                                         <div class="table-responsive mt-2">
                                                            <a href="#shareMFModal" class="add_btn float-right add" data-toggle="modal"><i class="fas fa-plus mr-1" aria-hidden="true" style="font-size: inherit; color: inherit;"></i><span>Add Mutual Fund</span></a>
                                                            <table class="table table-bordered" id="shareMFTable">
                                                               <thead class="thead-light">
                                                                  <tr>
                                                                     <th>Mutual Fund Name</th>
                                                                     <th>Scheme Name</th>
                                                                     <th>Folio number</th>
                                                                     <th>Used Percentage</th>
                                                                     <th>Balance Percentage</th>
                                                                     <th style="width: 266px;">Action</th>
                                                                  </tr>
                                                               </thead>
                                                               <tbody>

                                                               </tbody>
                                                            </table>
                                                         </div>
                                                      </div>
                                                   </div>
                                                   <div id="shareMFModal" class="modal fade">
                                                      <div class="modal-dialog modal-lg">
                                                         <div class="modal-content">
                                                            <form data-formType="1" name="addMF" id="addMF" action="<?= $CONFIG->siteurl; ?>./__lib.ajax/frmForm.php" method="post" class="frmCurrent has-validation-callback">
                                                               <div class="modal-header">
                                                                  <h4 class="modal-title">Mutual Fund</h4>
                                                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                               </div>
                                                               <div class="modal-body">
                                                                  <div class="row">
                                                                     <div class="col-md-4">
                                                                        <div class="form-group">
                                                                           <label class="mandatory mandatory_label">Mutual Fund Name </label>
                                                                           <input class="form-control" name="mf_name" id="mf_name" placeholder="Mutual fund name" value="" alt="Enter Mutual Fund Name" type="text">
                                                                        </div>
                                                                     </div>
                                                                     <div class="col-md-4">
                                                                        <div class="form-group">
                                                                           <label class="mandatory mandatory_label">Scheme Name </label>
                                                                           <input class="form-control" name="mf_scheme" id="mf_scheme" placeholder="Scheme name" value="" alt="Enter Scheme Name" type="text">
                                                                        </div>
                                                                     </div>
                                                                     <div class="col-md-4">
                                                                        <div class="form-group">
                                                                           <label class="mandatory mandatory_label">Folio Number </label>
                                                                           <input class="form-control" name="mf_folio_number" id="mf_folio_number" placeholder="Folio Number" value="" alt="Enter Folio Number" type="text">
                                                                        </div>
                                                                     </div>
                                                                     <div class="col-md-4">
                                                                        <div class="form-group">
                                                                           <label class="mandatory mandatory_label">Amount of MF</label>
                                                                           <input class="form-control" name="mf_amount" id="mf_amount" placeholder="Enter mutual fund amount" value="" alt="" type="text">
                                                                        </div>
                                                                     </div>
                                                                     <div class="col-md-4">
                                                                        <div class="form-group">
                                                                           <label class="mandatory">Number of Units </label>
                                                                           <input type="text" class="form-control numeric_dobule" name="mf_share_count" id="mf_share_count" placeholder="Number of Units" value="" alt="Please enter Number of Units" />
                                                                        </div>
                                                                        <input class="form-control" name="ba_usedperc" id="ba_usedperc" value="0" maxlength="3" min="1" max="100" type="hidden">
                                                                        <input class="form-control" name="ba_balperc" id="ba_balperc" value="100" maxlength="3" min="1" max="100" type="hidden">
                                                                     </div>
                                                                  </div>
                                                               </div>
                                                               <div class="modal-footer">
                                                                  <button class="boxed_btn4 save" id="mfSave" data-role="update" data-id="" data-table="will_mutual_fund" data-key="pk_mf_id">Save</button>
                                                                  <input type="button" class="boxed_btn4" data-dismiss="modal" value="Cancel">
                                                               </div>
                                                            </form>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                                <div role="tabpanel" class="tab-pane" id="shares">
                                                   <div class="row no-gutters">
                                                      <div class="col-xl-12" id="bnkacAddWrap">
                                                         <div class="table-responsive mt-2">
                                                            <a href="#sharesModal" class="add_btn float-right add" data-toggle="modal"><i class="fas fa-plus mr-1" aria-hidden="true" style="font-size: inherit; color: inherit;"></i><span>Add Shares</span></a>
                                                            <table class="table table-bordered" id="sharesTable">
                                                               <thead class="thead-light">
                                                                  <tr>
                                                                     <th>Type of Share</th>
                                                                     <th>Company Name</th>
                                                                     <th>Share Amount</th>
                                                                     <th>Used Percentage</th>
                                                                     <th>Balance Percentage</th>
                                                                     <th style="width: 266px;">Action</th>
                                                                  </tr>
                                                               </thead>
                                                               <tbody>

                                                               </tbody>
                                                            </table>
                                                         </div>
                                                      </div>
                                                   </div>
                                                   <div id="sharesModal" class="modal fade">
                                                      <div class="modal-dialog modal-lg">
                                                         <div class="modal-content">
                                                            <form data-formType="1" name="addShare" id="addShare" action="<?= $CONFIG->siteurl; ?>./__lib.ajax/frmForm.php" method="post" class="frmCurrent has-validation-callback">
                                                               <div class="modal-header">
                                                                  <h4 class="modal-title">Add Share</h4>
                                                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                               </div>
                                                               <div class="modal-body">
                                                                  <div class="row">
                                                                     <div class="col-md-4">
                                                                        <div class="form-group">
                                                                           <label class="mandatory mandatory_label">Type of share </label>
                                                                           <input class="form-control" name="share_type" id="share_type" placeholder="Type of share" value="" alt="Please enter Type of share" type="text">
                                                                        </div>
                                                                     </div>
                                                                     <div class="col-md-4">
                                                                        <div class="form-group">
                                                                           <label class="mandatory mandatory_label">Amount </label><br>
                                                                           <input class="form-control" name="share_amount" id="share_amount" placeholder="Amount" value="" alt="Please enter amount" type="text">
                                                                        </div>
                                                                     </div>
                                                                     <div class="col-md-4">
                                                                        <div class="form-group">
                                                                           <label class="mandatory mandatory_label">Demat Number </label><br>
                                                                           <input class="form-control numeric" name="share_demat_number" id="share_demat_number" placeholder="Demat Number" value="" alt="Please enter Demat Number" type="text">
                                                                        </div>
                                                                     </div>
                                                                     <div class="col-md-4">
                                                                        <div class="form-group">
                                                                           <label class="mandatory mandatory_label">Company Name</label>
                                                                           <input class="form-control" name="share_company_name" id="share_company_name" placeholder="Company name" value="" alt="Please enter company name" type="text">
                                                                        </div>
                                                                     </div>
                                                                     <div class="col-md-4">
                                                                        <div class="form-group">
                                                                           <label class="mandatory mandatory_label">Bank name </label>
                                                                           <input class="form-control" name="share_bank_name" id="share_bank_name" placeholder="Bank name" value="" alt="Please enter bank name" type="text">
                                                                        </div>
                                                                        <input class="form-control" name="ba_usedperc" id="ba_usedperc" value="0" maxlength="3" min="1" max="100" type="hidden">
                                                                        <input class="form-control" name="ba_balperc" id="ba_balperc" value="100" maxlength="3" min="1" max="100" type="hidden">
                                                                     </div>
                                                                  </div>
                                                               </div>
                                                               <div class="modal-footer">
                                                                  <button class="boxed_btn4 save" data-role="update" data-id="" data-table="will_share" data-key="pk_share_id">Save</button>
                                                                  <input type="button" class="boxed_btn4" data-dismiss="modal" value="Cancel">
                                                               </div>
                                                            </form>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                                <div role="tabpanel" class="tab-pane" id="bonds">
                                                   <div class="row no-gutters">
                                                      <div class="col-xl-12" id="bnkacAddWrap">
                                                         <div class="table-responsive mt-2">
                                                            <a href="#bondsModal" class="add_btn float-right add" data-toggle="modal"><i class="fas fa-plus mr-1" aria-hidden="true" style="font-size: inherit; color: inherit;"></i><span>Add Bond</span></a>
                                                            <table class="table table-bordered" id="bondsTable">
                                                               <thead class="thead-light">
                                                                  <tr>
                                                                     <th>Company Name</th>
                                                                     <th>Scheme Name</th>
                                                                     <th>Amount</th>
                                                                     <th>Used Percentage</th>
                                                                     <th>Balance Percentage</th>
                                                                     <th style="width: 266px;">Action</th>
                                                                  </tr>
                                                               </thead>
                                                               <tbody>

                                                               </tbody>
                                                            </table>
                                                         </div>
                                                      </div>
                                                   </div>
                                                   <div id="bondsModal" class="modal fade">
                                                      <div class="modal-dialog modal-lg">
                                                         <div class="modal-content">
                                                            <form data-formType="1" name="addBond" id="addBond" action="<?= $CONFIG->siteurl; ?>./__lib.ajax/frmForm.php" method="post" class="frmCurrent has-validation-callback">
                                                               <div class="modal-header">
                                                                  <h4 class="modal-title">Add Bond</h4>
                                                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                               </div>
                                                               <div class="modal-body">
                                                                  <div class="row">
                                                                     <div class="col-md-4">
                                                                        <div class="form-group">
                                                                           <label class="mandatory mandatory_label">Name of Company, Issuing the Bond </label>
                                                                           <input class="form-control" name="bond_company_name" id="bond_company_name" placeholder="Name of Company" value="" alt="Please enter Name of Company, Issuing the Bond" type="text">
                                                                        </div>
                                                                     </div>
                                                                     <div class="col-md-4">
                                                                        <div class="form-group">
                                                                           <label class="mandatory mandatory_label">Scheme Name </label>
                                                                           <input class="form-control" name="bond_scheme_details" id="bond_scheme_details" placeholder="Scheme Name" value="" alt="Please enter Scheme Name" type="text"">
                                                                        </div>
                                                                     </div>
                                                                     <div class=" col-md-4">
                                                                           <div class="form-group">
                                                                              <label class="mandatory mandatory_label">Demat AIC Number </label>
                                                                              <input class="form-control numeric" name="bond_dmat_number" id="bond_dmat_number" placeholder="Demat AIC Number" value="" alt="Please enter Demat AIC Number" type="text">
                                                                           </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                           <div class="form-group">
                                                                              <label class="mandatory mandatory_label">Bank name </label><br>
                                                                              <input class="form-control" name="bond_bank_name" id="bond_bank_name" placeholder="Bank name" value="" alt="Please enter bank name" type="text">
                                                                           </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                           <div class="form-group">
                                                                              <label class="mandatory mandatory_label">Amount</label>
                                                                              <input class="form-control" name="bond_amount" id="bond_amount" placeholder="Amount" value="" alt="Please enter company name" type="text">
                                                                           </div>
                                                                           <input class="form-control" name="ba_usedperc" id="ba_usedperc" value="0" maxlength="3" min="1" max="100" type="hidden">
                                                                           <input class="form-control" name="ba_balperc" id="ba_balperc" value="100" maxlength="3" min="1" max="100" type="hidden">
                                                                        </div>
                                                                     </div>
                                                                  </div>
                                                                  <div class="modal-footer">
                                                                     <button class="boxed_btn4 save" data-role="update" data-id="" data-table="will_bond_details" data-key="pk_bond_id">Save</button>
                                                                     <input type="button" class="boxed_btn4" data-dismiss="modal" value="Cancel">
                                                                  </div>
                                                            </form>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="tab-pane fade" id="v-pills-ip" role="tabpanel" aria-labelledby="v-pills-ip-tab">
                                          <div class="panel-body-small2">
                                             <div class="row no-gutters">
                                                <div class="col-xl-12" id="bnkacAddWrap">
                                                   <div class="table-responsive mt-2">
                                                      <a href="#propertyModal" class="add_btn float-right add" data-toggle="modal"><i class="fas fa-plus mr-1" aria-hidden="true" style="font-size: inherit; color: inherit;"></i><span>Add Property</span></a>
                                                      <table class="table table-bordered" id="propertytable">
                                                         <thead class="thead-light">
                                                            <tr>
                                                               <th>Property Type</th>
                                                               <th>Address</th>
                                                               <th>Measurement</th>
                                                               <th>Used Percentage</th>
                                                               <th>Balance Percentage</th>
                                                               <th style="width: 266px;">Action</th>
                                                            </tr>
                                                         </thead>
                                                         <tbody>

                                                         </tbody>
                                                      </table>
                                                   </div>
                                                </div>
                                             </div>
                                             <div id="propertyModal" class="modal fade">
                                                <div class="modal-dialog modal-lg">
                                                   <div class="modal-content">
                                                      <form data-formType="1" name="addProperty" id="addProperty" action="<?= $CONFIG->siteurl; ?>./__lib.ajax/frmForm.php" method="post" class="frmCurrent has-validation-callback">
                                                         <div class="modal-header">
                                                            <h4 class="modal-title">Add Property</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                         </div>
                                                         <div class="modal-body">
                                                            <div class="row">
                                                               <div class="col-md-4">
                                                                  <div class="form-group">
                                                                     <label class="mandatory mandatory_label">Type of the Property </label>
                                                                     <select class="form-control" name="property_type" id="property_type">
                                                                        <option value="">Select</option>
                                                                        <option value="Ag land">Agricultural land</option>
                                                                        <option value="Non Ag. Land">Non Agricultural Land</option>
                                                                        <option value="C. Building">Commercial Building</option>
                                                                        <option value="R. building">Residental building</option>
                                                                        <option value="Factory">Factory</option>
                                                                        <!--  <option value="Other" >Other</option> -->
                                                                     </select>
                                                                  </div>
                                                               </div>
                                                               <div class="col-md-4">
                                                                  <div class="form-group">
                                                                     <label class="mandatory mandatory_label">Address Line1 </label>
                                                                     <input class="form-control" name="property_addr1" id="property_addr1" value="" placeholder="Address Line 1" alt="Please enter Address Line1" type="text">
                                                                  </div>
                                                               </div>
                                                               <div class="col-md-4">
                                                                  <div class="form-group">
                                                                     <label class="mandatory mandatory_label">Address Line2 </label>
                                                                     <input class="form-control" name="property_addr2" id="property_addr2" value="" placeholder="Address Line 2" alt="Please enter Address Line2" type="text">
                                                                  </div>
                                                               </div>
                                                               <div class="col-md-4">
                                                                  <div class="form-group">
                                                                     <label class="mandatory_label">City / Village / Town </label>
                                                                     <input class="form-control" name="property_city" id="property_city" value="" placeholder="City / Village / Town" alt="Please enter City / Village / Town" type="text">
                                                                  </div>
                                                               </div>
                                                               <div class="col-md-4">
                                                                  <div class="form-group">
                                                                     <label class="mandatory mandatory_label">Pincode </label>
                                                                     <input class="form-control numeric" name="property_zip" id="property_zip" value="" placeholder="Pincode" alt="Please enter pincode" type="text">
                                                                  </div>
                                                               </div>
                                                               <div class="col-md-4">
                                                                  <div class="form-group">
                                                                     <label class="mandatory mandatory_label">Country </label>
                                                                     <select name="property_country" id="property_country" class="input-select form-control" alt="Please select country">
                                                                        <option value="102" selected="selected">India</option>
                                                                     </select>
                                                                  </div>
                                                               </div>
                                                               <div class="col-md-4">
                                                                  <div class="form-group">
                                                                     <label class="mandatory mandatory_label">State </label>
                                                                     <span id="span_state">
                                                                        <select name="property_state" id="property_state" class="input-select form-control" alt="Please select appropriate state">
                                                                           <option value="" selected>Select State</option>
                                                                           <option value="35">Andaman and Nicobar Islands</option>
                                                                           <option value="25">Daman and Diu</option>
                                                                           <option value="28">Andhra Pradesh</option>
                                                                           <option value="12">Arunachal Pradesh</option>
                                                                           <option value="18">Assam</option>
                                                                           <option value="10">Bihar</option>
                                                                           <option value="4">Chandigarh</option>
                                                                           <option value="22">Chhattisgarh</option>
                                                                           <option value="26">Dadra and Nagar Haveli</option>
                                                                           <option value="7">Delhi</option>
                                                                           <option value="30">Goa</option>
                                                                           <option value="24">Gujarat</option>
                                                                           <option value="6">Haryana</option>
                                                                           <option value="2">Himachal Pradesh</option>
                                                                           <option value="1">Jammu and Kashmir</option>
                                                                           <option value="20">Jharkhand</option>
                                                                           <option value="29">Karnataka</option>
                                                                           <option value="32">Kerala</option>
                                                                           <option value="31">Lakshadweep</option>
                                                                           <option value="23">Madhya Pradesh</option>
                                                                           <option value="27">Maharashtra</option>
                                                                           <option value="14">Manipur</option>
                                                                           <option value="17">Meghalaya</option>
                                                                           <option value="15">Mizoram</option>
                                                                           <option value="13">Nagaland</option>
                                                                           <option value="21">Odisha</option>
                                                                           <option value="34">Puducherry</option>
                                                                           <option value="3">Punjab</option>
                                                                           <option value="8">Rajasthan</option>
                                                                           <option value="11">Sikkim</option>
                                                                           <option value="33">Tamil Nadu</option>
                                                                           <option value="36">Telangana</option>
                                                                           <option value="16">Tripura</option>
                                                                           <option value="5">Uttarakhand</option>
                                                                           <option value="9">Uttar Pradesh</option>
                                                                           <option value="19">West Bengal</option>
                                                                        </select>
                                                                     </span>
                                                                  </div>
                                                               </div>
                                                               <div class="col-md-4">
                                                                  <div class="form-group">
                                                                     <label class="mandatory mandatory_label">Measurement of the property(Sqr ft) </label>
                                                                     <input class="form-control" value="" name="property_measurement" id="property_measurement" type="text">
                                                                  </div>
                                                               </div>
                                                               <div class="col-md-4">
                                                                  <div class="form-group">
                                                                     <label class="mandatory mandatory_label">Owner Status</label>
                                                                     <select name="property_ownership_status" id="property_ownership_status" class="form-control">
                                                                        <option value="">Select one</option>
                                                                        <option value="single">Single</option>
                                                                        <option value="joint">Joint</option>
                                                                     </select>
                                                                  </div>
                                                               </div>
                                                               <div class="col-md-4">
                                                                  <div class="form-group">
                                                                     <label class="mandatory mandatory_label">Owner status in %</label>
                                                                     <div class="input-group suffix">
                                                                        <input class="form-control" value="" name="property_ownership_perc" id="property_ownership_perc" type="number">
                                                                        <span class="input-group-addon ">%</span>
                                                                     </div>
                                                                     <input class="form-control" name="ba_usedperc" id="ba_usedperc" value="0" maxlength="3" min="1" max="100" type="hidden">
                                                                     <input class="form-control" name="ba_balperc" id="ba_balperc" value="100" maxlength="3" min="1" max="100" type="hidden">
                                                                  </div>
                                                               </div>
                                                            </div>
                                                         </div>
                                                         <div class="personalInfoScroll jumbotron p-1 font-italic m-2 text-justify"><span style="color:#d33633;font-size:bigger">Note</span><br><b>* Owner Status in %:</b> 100% if owner status is Single or actual % ownership in case of owner status is Joint.
                                                         </div>


                                                         <div class="modal-footer">
                                                            <button class="boxed_btn4 save" data-role="update" data-id="" data-table="will_immovable_properties" data-key="pk_prop_id">Save</button>
                                                            <input type="button" class="boxed_btn4" data-dismiss="modal" value="Cancel">
                                                         </div>
                                                      </form>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="tab-pane fade" id="v-pills-b" role="tabpanel" aria-labelledby="v-pills-b-tab">
                                          <div class="panel-body-small2">
                                             <div class="row no-gutters">
                                                <div class="table-responsive mt-2">
                                                   <a href="#businessModal" class="add_btn float-right add" data-toggle="modal"><i class="fas fa-plus mr-1" aria-hidden="true" style="font-size: inherit; color: inherit;"></i><span>Add Business</span></a>
                                                   <table class="table table-bordered" id="businessTable">
                                                      <thead class="thead-light">
                                                         <tr>
                                                            <th>Business Type</th>
                                                            <th>Company Name</th>
                                                            <th>Address</th>
                                                            <th>Used Percentage</th>
                                                            <th>Balance Percentage</th>
                                                            <th style="width: 266px;">Action</th>
                                                         </tr>
                                                      </thead>
                                                      <tbody>

                                                      </tbody>
                                                   </table>
                                                </div>
                                             </div>
                                             <div id="businessModal" class="modal fade">
                                                <div class="modal-dialog modal-lg">
                                                   <div class="modal-content">
                                                      <form data-formType="1" name="addBusiness" id="addBusiness" action="<?= $CONFIG->siteurl; ?>./__lib.ajax/frmForm.php" method="post" class="frmCurrent has-validation-callback">
                                                         <div class="modal-header">
                                                            <h4 class="modal-title">Business</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                         </div>
                                                         <div class="modal-body">
                                                            <div class="row">
                                                               <div class="col-md-4">
                                                                  <div class="form-group">
                                                                     <label class="mandatory">Type of business activity</label>
                                                                     <input class="form-control numeric" name="business_type" id="business_type" value="" placeholder="Enter type of business activity" alt="Please enter Account No" type="text">
                                                                  </div>
                                                               </div>
                                                               <div class="col-md-4">
                                                                  <div class="form-group">
                                                                     <label class="mandatory mandatory_label">Ownership type </label>
                                                                     <input class="form-control" name="business_owner_type" id="business_owner_type" value="" placeholder="Enter ownership type" alt="Please enter Bank Name" type="text">
                                                                  </div>
                                                               </div>
                                                               <div class="col-md-4">
                                                                  <div class="form-group">
                                                                     <label class="mandatory mandatory_label">Ownership in %</label>
                                                                     <input class="form-control" value="" placeholder="Enter ownership in %" name="businesss_ownership_perc" id="businesss_ownership_perc" type="text">
                                                                  </div>
                                                               </div>
                                                               <div class="col-md-4">
                                                                  <div class="form-group">
                                                                     <label class="mandatory  mandatory_label">Name of the company</label>
                                                                     <input class="form-control" name="business_company_name" id="business_company_name" value="" placeholder="Enter name of the company" alt="Please enter Branch Name" type="text">
                                                                  </div>
                                                               </div>
                                                               <div class="col-md-4">
                                                                  <div class="form-group">
                                                                     <label class="mandatory ">Address Line 1</label>
                                                                     <input class="form-control" name="business_addr1" id="business_addr1" value="" placeholder="Address Line 1" alt="Please enter Address Line1" type="text">
                                                                  </div>
                                                               </div>
                                                               <div class="col-md-4">
                                                                  <div class="form-group">
                                                                     <label class="mandatory ">Address Line 2</label>
                                                                     <input class="form-control" name="business_addr2" id="business_addr2" value="" placeholder="Address Line 2" alt="Please enter Address Line2" type="text">
                                                                  </div>
                                                               </div>
                                                               <div class="col-md-4">
                                                                  <div class="form-group">
                                                                     <label class="mandatory">City / Village / Town</label>
                                                                     <input class="form-control" name="business_city" id="business_city" value="" placeholder="City / Village / Town" type="text">
                                                                  </div>
                                                               </div>
                                                               <div class="col-md-4">
                                                                  <div class="form-group">
                                                                     <label class="mandatory mandatory_label">State </label>
                                                                     <span id="span_state">
                                                                        <select name="business_state" id="business_state" class="input-select form-control" alt="Please select appropriate State">
                                                                           <option value="" selected>Select State</option>
                                                                           <option value="35">Andaman and Nicobar Islands</option>
                                                                           <option value="25">Daman and Diu</option>
                                                                           <option value="28">Andhra Pradesh</option>
                                                                           <option value="12">Arunachal Pradesh</option>
                                                                           <option value="18">Assam</option>
                                                                           <option value="10">Bihar</option>
                                                                           <option value="4">Chandigarh</option>
                                                                           <option value="22">Chhattisgarh</option>
                                                                           <option value="26">Dadra and Nagar Haveli</option>
                                                                           <option value="7">Delhi</option>
                                                                           <option value="30">Goa</option>
                                                                           <option value="24">Gujarat</option>
                                                                           <option value="6">Haryana</option>
                                                                           <option value="2">Himachal Pradesh</option>
                                                                           <option value="1">Jammu and Kashmir</option>
                                                                           <option value="20">Jharkhand</option>
                                                                           <option value="29">Karnataka</option>
                                                                           <option value="32">Kerala</option>
                                                                           <option value="31">Lakshadweep</option>
                                                                           <option value="23">Madhya Pradesh</option>
                                                                           <option value="27">Maharashtra</option>
                                                                           <option value="14">Manipur</option>
                                                                           <option value="17">Meghalaya</option>
                                                                           <option value="15">Mizoram</option>
                                                                           <option value="13">Nagaland</option>
                                                                           <option value="21">Odisha</option>
                                                                           <option value="34">Puducherry</option>
                                                                           <option value="3">Punjab</option>
                                                                           <option value="8">Rajasthan</option>
                                                                           <option value="11">Sikkim</option>
                                                                           <option value="33">Tamil Nadu</option>
                                                                           <option value="36">Telangana</option>
                                                                           <option value="16">Tripura</option>
                                                                           <option value="5">Uttarakhand</option>
                                                                           <option value="9">Uttar Pradesh</option>
                                                                           <option value="19">West Bengal</option>
                                                                        </select>
                                                                     </span>
                                                                  </div>
                                                               </div>
                                                               <div class="col-md-4">
                                                                  <div class="form-group">
                                                                     <label class="mandatory mandatory_label">Country </label>
                                                                     <select name="business_country" id="business_country" class="input-select form-control" alt="Please select a Country">

                                                                        <option value="102" selected>India</option>
                                                                     </select>
                                                                  </div>
                                                               </div>
                                                               <div class="col-md-4">
                                                                  <div class="form-group">
                                                                     <label class="mandatory mandatory_label">Pincode </label>
                                                                     <input class="form-control numeric" name="business_zip" id="business_zip" value="" placeholder="Pincode" alt="Please enter Pincode" type="text">
                                                                  </div>
                                                                  <input class="form-control" name="ba_usedperc" id="ba_usedperc" value="0" maxlength="3" min="1" max="100" type="hidden">
                                                                  <input class="form-control" name="ba_balperc" id="ba_balperc" value="100" maxlength="3" min="1" max="100" type="hidden">
                                                               </div>
                                                            </div>
                                                         </div>
                                                         <div class="modal-footer">
                                                            <button class="boxed_btn4 save" data-role="update" data-id="" data-table="will_business" data-key="pk_business_id">Save</button>
                                                            <input type="button" class="boxed_btn4" data-dismiss="modal" value="Cancel">
                                                         </div>
                                                      </form>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="tab-pane fade" id="v-pills-rf" role="tabpanel" aria-labelledby="v-pills-rf-tab">
                                          <div class="panel-body-small2" id="rflist">
                                             <!-- Nav tabs -->
                                             <ul class="nav nav-tabs nav-fill" role="tablist">
                                                <li role="presentation" class="nav-item active"><a class="nav-link text-center active" href="#pf" aria-controls="pf" role="tab" data-toggle="tab">Provident Funds (PF)</a></li>
                                                <li role="presentation" class="nav-item" data-toggle="popover" data-content="">
                                                   <a class="nav-link text-center" href="#pensionFund" aria-controls="pensionFund" role="tab" data-toggle="tab">Pension Fund</a>
                                                </li>
                                                <li role="presentation" class="nav-item"><a class="nav-link text-center" href="#gratuity" aria-controls="gratuity" role="tab" data-toggle="tab">Gratuity</a></li>
                                             </ul>
                                             <!-- Tab panes -->
                                             <div class="tab-content">
                                                <div role="tabpanel" class="tab-pane active show" id="pf">
                                                   <div class="panel-body-small2">
                                                      <div class="row no-gutters">
                                                         <div class="table-responsive mt-2">
                                                            <a href="#pfModal" class="add_btn float-right add" data-toggle="modal"><i class="fas fa-plus mr-1" aria-hidden="true" style="font-size: inherit; color: inherit;"></i><span>Add Provident Fund</span></a>
                                                            <table class="table table-bordered" id="pfTable">
                                                               <thead class="thead-light">
                                                                  <tr>
                                                                     <th>PF Account</th>
                                                                     <th>Company Name</th>
                                                                     <th>Address</th>
                                                                     <th>Used Percentage</th>
                                                                     <th>Balance Percentage</th>
                                                                     <th style="width: 266px;">Action</th>
                                                                  </tr>
                                                               </thead>
                                                               <tbody>

                                                               </tbody>
                                                            </table>
                                                         </div>
                                                      </div>
                                                      <div id="pfModal" class="modal fade">
                                                         <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                               <form data-formType="1" name="addPF" id="addPF" action="<?= $CONFIG->siteurl; ?>./__lib.ajax/frmForm.php" method="post" class="frmCurrent has-validation-callback">
                                                                  <div class="modal-header">
                                                                     <h4 class="modal-title">Add Provident Fund</h4>
                                                                     <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                  </div>
                                                                  <div class="modal-body">
                                                                     <div class="row">
                                                                        <div class="col-md-4">
                                                                           <div class="form-group">
                                                                              <label class="mandatory mandatory_label">Account Number</label>
                                                                              <input class="form-control " placeholder="Account Number" name="pf_ac_number" id="pf_ac_number" value="" alt="Please enter Account Number" type="text">
                                                                           </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                           <div class="form-group">
                                                                              <label class="mandatory mandatory_label">Company Name</label>
                                                                              <input class="form-control " placeholder="Company Name" name="pf_company_name" id="pf_company_name" value="" alt="Please Enter Company Name" type="text">
                                                                           </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                           <div class="form-group">
                                                                              <label class="mandatory mandatory_label">Address Line 1</label>
                                                                              <input class="form-control" name="pf_addr1" id="pf_addr1" value="" placeholder="Address Line 1" alt="Please enter Address Line1" type="text">
                                                                           </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                           <div class="form-group">
                                                                              <label class="mandatory mandatory_label">Address Line 2</label>
                                                                              <input class="form-control" name="pf_addr2" id="pf_addr2" value="" placeholder="Address Line 2" alt="Please enter Address Line2" type="text">
                                                                           </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                           <div class="form-group">
                                                                              <label class="mandatory mandatory_label">City / Village / Town</label>
                                                                              <input class="form-control" name="pf_city" id="pf_city" value="" placeholder="City / Village / Town" alt="Please enter City / Village / Town" type="text">
                                                                           </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                           <div class="form-group">
                                                                              <label class="mandatory mandatory_label">State </label>
                                                                              <span id="span_state">
                                                                                 <select name="pf_state" id="pf_state" class="input-select form-control" alt="Please select appropriate State">
                                                                                    <option value="" selected>Select State</option>
                                                                                    <option value="35">Andaman and Nicobar Islands</option>
                                                                                    <option value="25">Daman and Diu</option>
                                                                                    <option value="28">Andhra Pradesh</option>
                                                                                    <option value="12">Arunachal Pradesh</option>
                                                                                    <option value="18">Assam</option>
                                                                                    <option value="10">Bihar</option>
                                                                                    <option value="4">Chandigarh</option>
                                                                                    <option value="22">Chhattisgarh</option>
                                                                                    <option value="26">Dadra and Nagar Haveli</option>
                                                                                    <option value="7">Delhi</option>
                                                                                    <option value="30">Goa</option>
                                                                                    <option value="24">Gujarat</option>
                                                                                    <option value="6">Haryana</option>
                                                                                    <option value="2">Himachal Pradesh</option>
                                                                                    <option value="1">Jammu and Kashmir</option>
                                                                                    <option value="20">Jharkhand</option>
                                                                                    <option value="29">Karnataka</option>
                                                                                    <option value="32">Kerala</option>
                                                                                    <option value="31">Lakshadweep</option>
                                                                                    <option value="23">Madhya Pradesh</option>
                                                                                    <option value="27">Maharashtra</option>
                                                                                    <option value="14">Manipur</option>
                                                                                    <option value="17">Meghalaya</option>
                                                                                    <option value="15">Mizoram</option>
                                                                                    <option value="13">Nagaland</option>
                                                                                    <option value="21">Odisha</option>
                                                                                    <option value="34">Puducherry</option>
                                                                                    <option value="3">Punjab</option>
                                                                                    <option value="8">Rajasthan</option>
                                                                                    <option value="11">Sikkim</option>
                                                                                    <option value="33">Tamil Nadu</option>
                                                                                    <option value="36">Telangana</option>
                                                                                    <option value="16">Tripura</option>
                                                                                    <option value="5">Uttarakhand</option>
                                                                                    <option value="9">Uttar Pradesh</option>
                                                                                    <option value="19">West Bengal</option>
                                                                                 </select>
                                                                              </span>
                                                                           </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                           <div class="form-group">
                                                                              <label class="mandatory mandatory_label">Country </label>
                                                                              <select name="pf_country" id="pf_country" class="input-select form-control" alt="Please select a Country">

                                                                                 <option value="102" selected="selected">India</option>
                                                                              </select>
                                                                           </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                           <div class="form-group">
                                                                              <label class="mandatory mandatory_label">Pincode </label>
                                                                              <input class="form-control numeric" name="pf_zip" id="pf_zip" value="" placeholder="Pincode" alt="Please enter Pincode" type="text">
                                                                           </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                           <div class="form-group">
                                                                              <label class="mandatory mandatory_label">Ownership Percent </label>
                                                                              <input class="form-control numeric" name="pf_ownership_perc" id="pf_ownership_perc" value="100" readonly title="Please enter percent" alt="Please enter Percent" type="text">
                                                                           </div>
                                                                           <input class="form-control" name="ba_usedperc" id="ba_usedperc" value="0" maxlength="3" min="1" max="100" type="hidden">
                                                                           <input class="form-control" name="ba_balperc" id="ba_balperc" value="100" maxlength="3" min="1" max="100" type="hidden">
                                                                        </div>
                                                                     </div>
                                                                  </div>
                                                                  <div class="modal-footer">
                                                                     <button class="boxed_btn4 save" data-role="update" data-id="" data-table="will_ppf_info" data-key="pk_ppf_id">Save</button>
                                                                     <input type="button" class="boxed_btn4" data-dismiss="modal" value="Cancel">
                                                                  </div>
                                                               </form>
                                                            </div>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                                <div role="tabpanel" class="tab-pane" id="pensionFund">
                                                   <div class="panel-body-small2">
                                                      <div class="row no-gutters">
                                                         <div class="table-responsive mt-2">
                                                            <a href="#pensionModal" class="add_btn float-right add" data-toggle="modal"><i class="fas fa-plus mr-1" aria-hidden="true" style="font-size: inherit; color: inherit;"></i><span>Add Pension Fund</span></a>
                                                            <table class="table table-bordered" id="pensionTable">
                                                               <thead class="thead-light">
                                                                  <tr>
                                                                     <th>Pension Fund</th>
                                                                     <th>Company Name</th>
                                                                     <th>Address</th>
                                                                     <th>Used Percentage</th>
                                                                     <th>Balance Percentage</th>
                                                                     <th style="width: 266px;">Action</th>
                                                                  </tr>
                                                               </thead>
                                                               <tbody>
                                                               </tbody>
                                                            </table>
                                                         </div>
                                                      </div>
                                                      <div id="pensionModal" class="modal fade">
                                                         <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                               <form data-formType="1" name="addPension" id="addPension" action="<?= $CONFIG->siteurl; ?>./__lib.ajax/frmForm.php" method="post" class="frmCurrent has-validation-callback">
                                                                  <div class="modal-header">
                                                                     <h4 class="modal-title">Pension Fund</h4>
                                                                     <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                  </div>
                                                                  <div class="modal-body">
                                                                     <div class="row">
                                                                        <div class="col-md-4">
                                                                           <div class="form-group">
                                                                              <label class="mandatory mandatory_label">Name of the plan </label>
                                                                              <input placeholder="Name of the plan" class="form-control" name="pension_plan_name" id="pension_plan_name" value="" alt="Please enter name of plan" type="text">
                                                                           </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                           <div class="form-group">
                                                                              <label class="mandatory">Pension a/c number</label>
                                                                              <input placeholder="Pension a/c number" class="form-control" name="pension_ac_number" id="pension_ac_number" value="" alt="Please enter Folio Number / Account Number" type="number">
                                                                           </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                           <div class="form-group">
                                                                              <label class="mandatory">Company Name</label>
                                                                              <input placeholder="Company name" class="form-control" name="pension_company_name" id="pension_company_name" value="" alt="Enter Company Name" type="text">
                                                                           </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                           <div class="form-group">
                                                                              <label class="mandatory ">Address Line 1</label>
                                                                              <input class="form-control" name="pension_addr1" id="pension_addr1" value="" placeholder="Address Line 1" alt="Please enter Address Line1" type="text">
                                                                           </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                           <div class="form-group">
                                                                              <label class="mandatory ">Address Line 2</label>
                                                                              <input class="form-control" name="pension_addr2" id="pension_addr2" value="" placeholder="Address Line 2" alt="Please enter Address Line2" type="text">
                                                                           </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                           <div class="form-group">
                                                                              <label class="mandatory">City / Village / Town</label>
                                                                              <input class="form-control" name="pension_city" id="pension_city" value="" placeholder="City / Village / Town" alt="Please enter City / Village / Town" type="text">
                                                                           </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                           <div class="form-group">
                                                                              <label class="mandatory mandatory_label">State </label>
                                                                              <span id="span_state">
                                                                                 <select name="pension_state" id="pension_state" class="input-select form-control" alt="Please select appropriate State">
                                                                                    <option value="" selected>Select State</option>
                                                                                    <option value="35">Andaman and Nicobar Islands</option>
                                                                                    <option value="25">Daman and Diu</option>
                                                                                    <option value="28">Andhra Pradesh</option>
                                                                                    <option value="12">Arunachal Pradesh</option>
                                                                                    <option value="18">Assam</option>
                                                                                    <option value="10">Bihar</option>
                                                                                    <option value="4">Chandigarh</option>
                                                                                    <option value="22">Chhattisgarh</option>
                                                                                    <option value="26">Dadra and Nagar Haveli</option>
                                                                                    <option value="7">Delhi</option>
                                                                                    <option value="30">Goa</option>
                                                                                    <option value="24">Gujarat</option>
                                                                                    <option value="6">Haryana</option>
                                                                                    <option value="2">Himachal Pradesh</option>
                                                                                    <option value="1">Jammu and Kashmir</option>
                                                                                    <option value="20">Jharkhand</option>
                                                                                    <option value="29">Karnataka</option>
                                                                                    <option value="32">Kerala</option>
                                                                                    <option value="31">Lakshadweep</option>
                                                                                    <option value="23">Madhya Pradesh</option>
                                                                                    <option value="27">Maharashtra</option>
                                                                                    <option value="14">Manipur</option>
                                                                                    <option value="17">Meghalaya</option>
                                                                                    <option value="15">Mizoram</option>
                                                                                    <option value="13">Nagaland</option>
                                                                                    <option value="21">Odisha</option>
                                                                                    <option value="34">Puducherry</option>
                                                                                    <option value="3">Punjab</option>
                                                                                    <option value="8">Rajasthan</option>
                                                                                    <option value="11">Sikkim</option>
                                                                                    <option value="33">Tamil Nadu</option>
                                                                                    <option value="36">Telangana</option>
                                                                                    <option value="16">Tripura</option>
                                                                                    <option value="5">Uttarakhand</option>
                                                                                    <option value="9">Uttar Pradesh</option>
                                                                                    <option value="19">West Bengal</option>
                                                                                 </select>
                                                                              </span>
                                                                           </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                           <div class="form-group">
                                                                              <label class="mandatory mandatory_label">Country </label>
                                                                              <select name="pension_country" id="pension_country" class="input-select form-control" alt="Please select a Country">

                                                                                 <option value="102" selected="selected">India</option>
                                                                              </select>
                                                                           </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                           <div class="form-group">
                                                                              <label class="mandatory mandatory_label">Pincode </label>
                                                                              <input class="form-control numeric" name="pension_zip" id="pension_zip" value="" placeholder="Pincode" alt="Please enter Pincode" type="text">
                                                                           </div>
                                                                           <input class="form-control" name="ba_usedperc" id="ba_usedperc" value="0" maxlength="3" min="1" max="100" type="hidden">
                                                                           <input class="form-control" name="ba_balperc" id="ba_balperc" value="100" maxlength="3" min="1" max="100" type="hidden">
                                                                        </div>
                                                                     </div>
                                                                  </div>
                                                                  <div class="personalInfoScroll jumbotron p-1 font-italic m-3 text-justify"><span style="color:#d33633;font-size:bigger">Note</span><br><b>1. Name of the plan:</b> Name of pension scheme plan in which the investment has been made.
                                                                     <br><b>2. Pension A/c Number:</b> The unique account number in which pension fund is deposited time to time.
                                                                     <br><b>3. Company Name:</b> Company with whom the pension fund is operated.
                                                                     <br><b>4. Address:</b> Address of the company where the pension fund is operated.
                                                                  </div>


                                                                  <div class="modal-footer">
                                                                     <button class="boxed_btn4 save" data-role="update" data-id="" data-table="will_pension_funds" data-key="pen_id">Save</button>
                                                                     <input type="button" class="boxed_btn4" data-dismiss="modal" value="Cancel">
                                                                  </div>
                                                               </form>
                                                            </div>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                                <div role="tabpanel" class="tab-pane" id="gratuity">
                                                   <div class="panel-body-small2">
                                                      <div class="row no-gutters">
                                                         <div class="table-responsive mt-2">
                                                            <a href="#gratuityModal" class="add_btn float-right add" data-toggle="modal"><i class="fas fa-plus mr-1" aria-hidden="true" style="font-size: inherit; color: inherit;"></i><span>Add Gratuity</span></a>
                                                            <table class="table table-bordered" id="gratuityTable">
                                                               <thead class="thead-light">
                                                                  <tr>
                                                                     <th>Gratuity</th>
                                                                     <th>Company Name</th>
                                                                     <th>Address</th>
                                                                     <th>Used Percentage</th>
                                                                     <th>Balance Percentage</th>
                                                                     <th style="width: 266px;">Action</th>
                                                                  </tr>
                                                               </thead>
                                                               <tbody>

                                                               </tbody>
                                                            </table>
                                                         </div>
                                                      </div>
                                                      <div id="gratuityModal" class="modal fade">
                                                         <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                               <form data-formType="1" name="addGratuity" id="addGratuity" action="<?= $CONFIG->siteurl; ?>./__lib.ajax/frmForm.php" method="post" class="frmCurrent has-validation-callback">
                                                                  <div class="modal-header">
                                                                     <h4 class="modal-title">Gratuity</h4>
                                                                     <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                  </div>
                                                                  <div class="modal-body">
                                                                     <div class="row">
                                                                        <div class="col-md-4">
                                                                           <div class="form-group">
                                                                              <label class="mandatory mandatory_label">Account Number</label>
                                                                              <input placeholder="Account Number" class="form-control" name="gratuity_ac_number" id="gratuity_ac_number" value="" alt="Please enter Folio Number / Account Number" type="number">
                                                                           </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                           <div class="form-group">
                                                                              <label class="mandatory mandatory_label">Company Name</label><br>
                                                                              <input placeholder="Company name" class="form-control" name="gratuity_company_name" id="gratuity_company_name" value="" type="text">
                                                                           </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                           <div class="form-group">
                                                                              <label class="mandatory mandatory_label">Address Line 1</label>
                                                                              <input class="form-control" name="gratuity_addr1" id="gratuity_addr1" value="" placeholder="Address Line 1" alt="Please enter Address Line1" type="text">
                                                                           </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                           <div class="form-group">
                                                                              <label class="mandatory mandatory_label">Address Line 2</label>
                                                                              <input class="form-control" name="gratuity_addr2" id="gratuity_addr2" value="" placeholder="Address Line 2" alt="Please enter Address Line2" type="text">
                                                                           </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                           <div class="form-group">
                                                                              <label class="mandatory mandatory_label">City / Village / Town</label>
                                                                              <input class="form-control" name="gratuity_city" id="gratuity_city" value="" placeholder="City / Village / Town" alt="Please enter City / Village / Town" type="text">
                                                                           </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                           <div class="form-group">
                                                                              <label class="mandatory mandatory_label">State </label>
                                                                              <span id="span_state">
                                                                                 <select name="gratuity_state" id="gratuity_state" class="input-select form-control" alt="Please select appropriate State">
                                                                                    <option value="" selected>Select State</option>
                                                                                    <option value="35">Andaman and Nicobar Islands</option>
                                                                                    <option value="25">Daman and Diu</option>
                                                                                    <option value="28">Andhra Pradesh</option>
                                                                                    <option value="12">Arunachal Pradesh</option>
                                                                                    <option value="18">Assam</option>
                                                                                    <option value="10">Bihar</option>
                                                                                    <option value="4">Chandigarh</option>
                                                                                    <option value="22">Chhattisgarh</option>
                                                                                    <option value="26">Dadra and Nagar Haveli</option>
                                                                                    <option value="7">Delhi</option>
                                                                                    <option value="30">Goa</option>
                                                                                    <option value="24">Gujarat</option>
                                                                                    <option value="6">Haryana</option>
                                                                                    <option value="2">Himachal Pradesh</option>
                                                                                    <option value="1">Jammu and Kashmir</option>
                                                                                    <option value="20">Jharkhand</option>
                                                                                    <option value="29">Karnataka</option>
                                                                                    <option value="32">Kerala</option>
                                                                                    <option value="31">Lakshadweep</option>
                                                                                    <option value="23">Madhya Pradesh</option>
                                                                                    <option value="27">Maharashtra</option>
                                                                                    <option value="14">Manipur</option>
                                                                                    <option value="17">Meghalaya</option>
                                                                                    <option value="15">Mizoram</option>
                                                                                    <option value="13">Nagaland</option>
                                                                                    <option value="21">Odisha</option>
                                                                                    <option value="34">Puducherry</option>
                                                                                    <option value="3">Punjab</option>
                                                                                    <option value="8">Rajasthan</option>
                                                                                    <option value="11">Sikkim</option>
                                                                                    <option value="33">Tamil Nadu</option>
                                                                                    <option value="36">Telangana</option>
                                                                                    <option value="16">Tripura</option>
                                                                                    <option value="5">Uttarakhand</option>
                                                                                    <option value="9">Uttar Pradesh</option>
                                                                                    <option value="19">West Bengal</option>
                                                                                 </select>
                                                                              </span>
                                                                           </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                           <div class="form-group">
                                                                              <label class="mandatory mandatory_label">Country </label>
                                                                              <select name="gratuity_country" id="gratuity_country" class="input-select form-control" alt="Please select a Country">

                                                                                 <option value="102" selected="selected">India</option>
                                                                              </select>
                                                                           </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                           <div class="form-group">
                                                                              <label class="mandatory mandatory_label">Pincode </label>
                                                                              <input class="form-control numeric" name="gratuity_zip" id="gratuity_zip" value="" placeholder="Pincode" alt="Please enter Pincode" type="number">
                                                                           </div>
                                                                           <input class="form-control" name="ba_usedperc" id="ba_usedperc" value="0" maxlength="3" min="1" max="100" type="hidden">
                                                                           <input class="form-control" name="ba_balperc" id="ba_balperc" value="100" maxlength="3" min="1" max="100" type="hidden">
                                                                        </div>
                                                                     </div>
                                                                  </div>
                                                                  <div class="modal-footer">
                                                                     <button class="boxed_btn4 save" data-role="update" data-id="" data-table="will_gratuity" data-key="gra_id">Save</button>
                                                                     <input type="button" class="boxed_btn4" data-dismiss="modal" value="Cancel">
                                                                  </div>
                                                               </form>
                                                            </div>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="tab-pane fade" id="v-pills-gi" role="tabpanel" aria-labelledby="v-pills-gi-tab">
                                          <div class="panel-body-small2">
                                             <div class="row no-gutters">
                                                <div class="table-responsive mt-2">
                                                   <a href="#generalInsuranceModal" class="add_btn float-right add" data-toggle="modal"><i class="fas fa-plus mr-1" aria-hidden="true" style="font-size: inherit; color: inherit;"></i><span>Add General Insurance</span></a>
                                                   <table class="table table-bordered" id="generalInsuranceTable">
                                                      <thead class="thead-light">
                                                         <tr>
                                                            <th>General Insurance A/c</th>
                                                            <th>Company Name</th>
                                                            <th>Start Date</th>
                                                            <th>Matuirity Date</th>
                                                            <th>Amount</th>
                                                            <th>Used Percentage</th>
                                                            <th>Balance Percentage</th>
                                                            <th style="width: 266px;">Action</th>
                                                         </tr>
                                                      </thead>
                                                      <tbody>
                                                      </tbody>
                                                   </table>
                                                </div>
                                             </div>
                                             <div id="generalInsuranceModal" class="modal fade">
                                                <div class="modal-dialog modal-lg">
                                                   <div class="modal-content">
                                                      <form data-formType="1" name="addGeneralInsurance" id="addGeneralInsurance" action="<?= $CONFIG->siteurl; ?>./__lib.ajax/frmForm.php" method="post" class="frmCurrent has-validation-callback">
                                                         <div class="modal-header">
                                                            <h4 class="modal-title">Add General Insurance</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                               &times;
                                                            </button>
                                                         </div>
                                                         <div class="modal-body">
                                                            <div class="row">
                                                               <div class="col-md-4">
                                                                  <div class="form-group">
                                                                     <label class="mandatory mandatory_label">Type of policy
                                                                     </label>
                                                                     <input type="text" class="form-control" name="gi_policy_type" id="gi_policy_type" value="" placeholder="Type of Policy" alt="Please enter policy type" />
                                                                  </div>
                                                               </div>
                                                               <div class="col-md-4">
                                                                  <div class="form-group">
                                                                     <label class="mandatory mandatory_label">Policy Number
                                                                     </label>
                                                                     <input type="number" class="form-control" name="gi_policy_number" id="gi_policy_number" value="" placeholder="Policy Number" alt="Please enter Policy number" />
                                                                  </div>
                                                               </div>
                                                               <div class="col-md-4">
                                                                  <div class="form-group">
                                                                     <label class="mandatory mandatory_label">Company name
                                                                     </label>
                                                                     <input type="text" class="form-control" name="gi_com_name" id="gi_com_name" value="" placeholder="Company Name" alt="Please enter Policy number" />
                                                                  </div>
                                                               </div>
                                                               <div class="col-md-4">
                                                                  <div class="form-group">
                                                                     <label class="mandatory mandatory_label">Start Date </label>
                                                                     <input type="date" id="gi_policy_start_date" name="gi_policy_start_date" class="form-control" value="" placeholder="Policy Start Date" alt="Please select Policy Start Date" />
                                                                  </div>
                                                               </div>
                                                               <div class="col-md-4">
                                                                  <div class="form-group">
                                                                     <label class="mandatory">Maturity Date </label>
                                                                     <input type="date" id="gi_maturity_date" name="gi_maturity_date" class="form-control" value="" placeholder="Policy Maturity Date" alt="Please select Policy Maturity Date" />
                                                                  </div>
                                                               </div>
                                                               <div class="col-md-4">
                                                                  <div class="form-group">
                                                                     <label class="mandatory mandatory_label">Amount </label><br />
                                                                     <input type="number" class="form-control" name="gi_amount" id="gi_amount" value="" placeholder="Policy Number" alt="Please enter Policy number" />
                                                                  </div>
                                                                  <input class="form-control" name="ba_usedperc" id="ba_usedperc" value="0" maxlength="3" min="1" max="100" type="hidden" />
                                                                  <input class="form-control" name="ba_balperc" id="ba_balperc" value="100" maxlength="3" min="1" max="100" type="hidden" />
                                                               </div>
                                                               <div class="personalInfoScroll jumbotron p-1 font-italic m-2 text-justify">
                                                                  <span style="color: #d33633; font-size: bigger">Note</span><br /><b>1. General Insurance:</b>
                                                                  General insurance or non-life insurance policies, including automobile and
                                                                  homeowners’ policies, provide payments depending on the loss from a
                                                                  particular financial event. <br /><b>2. Type of policy:</b> Write here
                                                                  whether its House Insurance, Car Insurance or any other such kind of
                                                                  non-life insurance policy benefit of which will arise in present or near
                                                                  future or on occurrence of certain event as mentioned in the policy.
                                                                  <br /><b>3. Policy Number:</b> Unique Policy Number as mentioned on the
                                                                  policy certificate. <br /><b>4. Company Name:</b> Company from which the
                                                                  policy is bought. <br /><b>5. Start Date:</b> Date of commencement of
                                                                  policy. <br /><b>6. Maturity Date:</b> Date on which the policy will get
                                                                  mature and benefit from the policy will accrue. <br /><b>7. Amount of policy:</b>
                                                                  Insured value, means the value of benefit that will accrue on the maturity
                                                                  of policy or on the happening of the event for which the insurance has
                                                                  been taken.
                                                               </div>
                                                               <div class="col-md-12 modal-footer">
                                                                  <button class="boxed_btn4 save" data-role="update" data-id="" data-table="will_general_insurance" data-key="pk_gi_id">
                                                                     Save
                                                                  </button>
                                                                  <input type="button" class="boxed_btn4" data-dismiss="modal" value="Cancel" />
                                                               </div>
                                                            </div>
                                                         </div>
                                                      </form>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="tab-pane fade" id="v-pills-lip" role="tabpanel" aria-labelledby="v-pills-lip-tab">
                                          <div class="panel-body-small2">
                                             <div class="row no-gutters">
                                                <!-- <h5><strong>Policy Details(Life insurance)</strong></h5> -->
                                                <div class="table-responsive mt-2">
                                                   <a href="#lifeInsuranceModal" class="add_btn float-right add" data-toggle="modal"><i class="fas fa-plus mr-1" aria-hidden="true" style="font-size: inherit; color: inherit;"></i><span>Add Life Insurance</span></a>
                                                   <table class="table table-bordered" id="lifeInsuranceTable">
                                                      <thead class="thead-light">
                                                         <tr>
                                                            <th>Life Insurance A/c</th>
                                                            <th>Company Name</th>
                                                            <th>Start Date</th>
                                                            <th>Matuirity Date</th>
                                                            <th>Amount</th>
                                                            <th>Used Percentage</th>
                                                            <th>Balance Percentage</th>
                                                            <th style="width: 266px;">Action</th>
                                                         </tr>
                                                      </thead>
                                                      <tbody>

                                                      </tbody>
                                                   </table>
                                                </div>
                                             </div>
                                             <div id="lifeInsuranceModal" class="modal fade">
                                                <div class="modal-dialog modal-lg">
                                                   <div class="modal-content">
                                                      <form data-formType="1" name="addLifeInsurance" id="addLifeInsurance" action="<?= $CONFIG->siteurl; ?>./__lib.ajax/frmForm.php" method="post" class="frmCurrent has-validation-callback">
                                                         <div class="modal-header">
                                                            <h4 class="modal-title">Life Insurance</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                         </div>
                                                         <div class="modal-body">
                                                            <div class="row">
                                                               <div class="col-md-4">
                                                                  <div class="form-group">
                                                                     <label class="mandatory mandatory_label">Name of Insurance Company </label>
                                                                     <input type="text" class="form-control" name="li_issuer_name" id="li_issuer_name" value="" placeholder="Name of the Insurance Company" alt="Please enter Name of the Insurance Company">
                                                                  </div>
                                                               </div>
                                                               <div class="col-md-4">
                                                                  <div class="form-group">
                                                                     <label class="mandatory mandatory_label">Policy Number </label><br>
                                                                     <input type="number" class="form-control" name="li_policy_number" id="li_policy_number" value="" placeholder="Policy Number" alt="Please enter Policy number">
                                                                  </div>
                                                               </div>
                                                               <div class="col-md-4">
                                                                  <div class="form-group">
                                                                     <label class="mandatory mandatory_label">Policy Start Date </label><br>
                                                                     <input type="date" id="li_start_date" name="li_start_date" class="form-control" value="" placeholder="Policy Start Date" alt="Please select Policy Start Date">
                                                                  </div>
                                                               </div>
                                                               <div class="col-md-4">
                                                                  <div class="form-group">
                                                                     <label class="mandatory">Policy Maturity Date </label>
                                                                     <input type="date" id="li_maturity_date" name="li_maturity_date" class="form-control" value="" placeholder="Policy Maturity Date" alt="Please select Policy Maturity Date">
                                                                  </div>
                                                               </div>
                                                               <div class="col-md-4">
                                                                  <div class="form-group">
                                                                     <label class="mandatory">Sum Assured in Lacs</label>
                                                                     <input type="text" class="form-control numeric_dobule number_amt" name="li_sum_assured" id="li_sum_assured" value="" placeholder="Sum Assured" alt="Please enter Sum Assured">
                                                                  </div>
                                                               </div>
                                                               <div class="col-md-4">
                                                                  <div class="form-group">
                                                                     <label class="mandatory">Branch Name</label>
                                                                     <input type="text" class="form-control numeric_dobule number_amt" name="li_branch_name" id="li_branch_name" value="" placeholder="Branch Name" alt="Please enter Sum Assured">
                                                                  </div>
                                                                  <input class="form-control" name="ba_usedperc" id="ba_usedperc" value="0" maxlength="3" min="1" max="100" type="hidden">
                                                                  <input class="form-control" name="ba_balperc" id="ba_balperc" value="100" maxlength="3" min="1" max="100" type="hidden">
                                                               </div>
                                                            </div>
                                                         </div>
                                                         <div class="personalInfoScroll jumbotron p-1 font-italic m-2 text-justify">
                                                            <span style="color: #d33633; font-size: bigger">Note</span><br /><b>1. Name of the insurance company:</b>
                                                            Company from where the insurance has been taken.<br />
                                                            <b>2. Policy Number:</b> Unique Policy Number as mentioned on the policy
                                                            certificate.<br />
                                                            <b>3. Start Date:</b> Date of commencement of policy.<br />
                                                            <b>4. Maturity Date:</b> Date on which the policy will get mature and
                                                            benefit from the policy will accrue. <br />
                                                            <b>5. Sum Assured:</b> Sum Assured means the amount of life insurance
                                                            taken, which will get accrue in the event of death of the policy
                                                            holder.<br />
                                                            <b>6. Branch Name:</b> Branch of the company from where the policy is
                                                            taken.
                                                         </div>
                                                         <div class="modal-footer">
                                                            <button class="boxed_btn4 save" data-role="update" data-id="" data-table="will_lic" data-key="pk_lic_id">Save</button>
                                                            <input type="button" class=" boxed_btn4" data-dismiss="modal" value="Cancel">
                                                         </div>
                                                      </form>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="tab-pane fade" id="v-pills-j" role="tabpanel" aria-labelledby="v-pills-j-tab">
                                          <div class="panel-body-small2">
                                             <div class="row no-gutters">
                                                <h5><strong>Jewellery</strong></h5>
                                                <div class="table-responsive mt-2">
                                                   <a href="#jewelModal" class="add_btn float-right add" data-toggle="modal"><i class="fas fa-plus mr-1" aria-hidden="true" style="font-size: inherit; color: inherit;"></i><span>Add Jewel</span></a>
                                                   <table class="table table-bordered" id="jewelTable">
                                                      <thead class="thead-light">
                                                         <tr>
                                                            <th>Jewellery Name</th>
                                                            <th>Grams</th>
                                                            <th>Description</th>
                                                            <th>Used Percentage</th>
                                                            <th>Balance Percentage</th>
                                                            <th style="width: 266px;">Action</th>
                                                         </tr>
                                                      </thead>
                                                      <tbody>

                                                      </tbody>
                                                   </table>
                                                </div>
                                             </div>
                                             <div id="jewelModal" class="modal fade">
                                                <div class="modal-dialog modal-lg">
                                                   <div class="modal-content">
                                                      <form data-formType="1" name="addJewel" id="addJewel" action="<?= $CONFIG->siteurl; ?>./__lib.ajax/frmForm.php" method="post" class="frmCurrent has-validation-callback">
                                                         <div class="modal-header">
                                                            <h4 class="modal-title">Jewellery</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                         </div>
                                                         <div class="modal-body">
                                                            <div class="row">
                                                               <div class="col-md-4">
                                                                  <div class="form-group">
                                                                     <label class="mandatory mandatory_label">Type of jewellery </label>
                                                                     <select class="form-control" name="jwl_type" id="jwl_type">
                                                                        <option value="" selected="">Select</option>
                                                                        <option value="gold">Gold</option>
                                                                        <option value="silver">Silver</option>
                                                                        <option value="dimond">Diamond</option>
                                                                        <option value="other">Other</option>
                                                                     </select>
                                                                  </div>
                                                               </div>
                                                               <div class="col-md-4">
                                                                  <div class="form-group">
                                                                     <label class="mandatory mandatory_label">Name </label>
                                                                     <input type="text" class="form-control" name="jwl_name" id="jwl_name" value="" placeholder="Name" alt="Please enter name">
                                                                  </div>
                                                               </div>
                                                               <div class="col-md-4">
                                                                  <div class="form-group">
                                                                     <label class="mandatory mandatory_label">Grams </label>
                                                                     <input type="text" class="form-control" name="jwl_amount" id="jwl_amount" value="" placeholder="Amount" alt="Please enter amount">
                                                                  </div>
                                                               </div>
                                                               <div class="col-md-4">
                                                                  <div class="form-group">
                                                                     <label class="mandatory mandatory_label">Description </label><br>
                                                                     <textarea name="jwl_description" id="jwl_description" cols="30" rows="3" class="form-control"></textarea>
                                                                  </div>
                                                                  <input class="form-control" name="ba_usedperc" id="ba_usedperc" value="0" maxlength="3" min="1" max="100" type="hidden">
                                                                  <input class="form-control" name="ba_balperc" id="ba_balperc" value="100" maxlength="3" min="1" max="100" type="hidden">
                                                               </div>
                                                            </div>
                                                         </div>
                                                         <div class="personalInfoScroll jumbotron p-1 font-italic m-2 text-justify">
                                                            <span style="color: #d33633; font-size: bigger">Note</span><br /><b>1. Type of jewellery:</b>
                                                            Select the type of jewellery held by the ‘will writer’ which is required
                                                            to be distributed among the beneficiaries.<br />
                                                            <b>2. Name:</b> Name of jewellery item, for example, if jewellery is a
                                                            gold ring then name would be Gold Ring or chain in case of gold chain.<br />
                                                            <b>3. Grams:</b> Jewellery is necessarily needs to put in grams. Here 1 KG
                                                            is equals to 1000 grams. <br />
                                                            <b>4. Description:</b> Any Description or details about the item so added.
                                                         </div>
                                                         <div class="modal-footer">
                                                            <button class="boxed_btn4 save" data-role="update" data-id="" data-table="will_jewellery" data-key="pk_jwl_id">Save</button>
                                                            <input type="button" class=" boxed_btn4" data-dismiss="modal" value="Cancel">
                                                         </div>
                                                      </form>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="tab-pane fade" id="v-pills-bo" role="tabpanel" aria-labelledby="v-pills-bo-tab">
                                          <div class="panel-body-small2">
                                             <div class="row no-gutters">
                                                <h5><strong>Body Organ</strong></h5>
                                                <div class="table-responsive mt-2">
                                                   <a href="#bodyOrganModal" class="add_btn float-right add" data-toggle="modal"><i class="fas fa-plus mr-1" aria-hidden="true" style="font-size: inherit; color: inherit;"></i><span>Add Body Organs</span></a>
                                                   <table class="table table-bordered" id="bodyorganTable">
                                                      <thead class="thead-light">
                                                         <tr>
                                                            <th>Organs Name</th>
                                                            <th>Hospital</th>
                                                            <th>Address</th>
                                                            <th style="width: 266px;">Action</th>
                                                         </tr>
                                                      </thead>
                                                      <tbody>

                                                      </tbody>
                                                   </table>
                                                </div>
                                             </div>
                                             <div id="bodyOrganModal" class="modal fade">
                                                <div class="modal-dialog modal-lg">
                                                   <div class="modal-content">
                                                      <form data-formType="1" name="addBodyOrgans" id="addBodyOrgans" action="<?= $CONFIG->siteurl; ?>./__lib.ajax/frmForm.php" method="post" class="frmCurrent has-validation-callback">
                                                         <div class="modal-header">
                                                            <h4 class="modal-title">Body Organ</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                         </div>
                                                         <div class="modal-body">
                                                            <div class="row">
                                                               <div class="col-md-4">
                                                                  <div class="form-group">
                                                                     <label class="mandatory mandatory_label">Body Organ Name </label>
                                                                     <input type="text" class="form-control" name="body_organ_name" id="body_organ_name" value="" placeholder="Body Organ Name" alt="Please enter organ name">
                                                                  </div>
                                                               </div>
                                                               <div class="col-md-4">
                                                                  <div class="form-group">
                                                                     <label class="mandatory mandatory_label">Name of hospital </label>
                                                                     <input type="text" class="form-control" name="body_organ_hospital_name" id="body_organ_hospital_name" value="" placeholder="Name of hospital" alt="Please enter hospital name">
                                                                  </div>
                                                               </div>
                                                               <div class="col-md-4">
                                                                  <div class="form-group">
                                                                     <label class="mandatory mandatory_label">Address Line 1</label>
                                                                     <input class="form-control" name="body_organ_addr1" id="body_organ_addr1" value="" placeholder="Address Line 1" alt="Please enter Address Line1" type="text">
                                                                  </div>
                                                               </div>
                                                               <div class="col-md-4">
                                                                  <div class="form-group">
                                                                     <label class="mandatory mandatory_label">Address Line 2</label>
                                                                     <input class="form-control" name="body_organ_addr2" id="body_organ_addr2" value="" placeholder="Address Line 2" alt="Please enter Address Line2" type="text">
                                                                  </div>
                                                               </div>
                                                               <div class="col-md-4">
                                                                  <div class="form-group">
                                                                     <label class="mandatory mandatory_label">City / Village / Town</label>
                                                                     <input class="form-control" name="body_organ_city" id="body_organ_city" value="" placeholder="City / Village / Town" alt="Please enter City / Village / Town">
                                                                  </div>
                                                               </div>
                                                               <div class="col-md-4">
                                                                  <div class="form-group">
                                                                     <label class="mandatory mandatory_label">State </label>
                                                                     <span id="span_state">
                                                                        <select name="body_organ_state" id="body_organ_state" class="input-select form-control" title="" alt="Please select appropriate State">
                                                                           <option value="" selected="">Select State</option>
                                                                           <option value="35">Andaman and Nicobar Islands</option>
                                                                           <option value="25">Daman and Diu</option>
                                                                           <option value="28">Andhra Pradesh</option>
                                                                           <option value="12">Arunachal Pradesh</option>
                                                                           <option value="18">Assam</option>
                                                                           <option value="10">Bihar</option>
                                                                           <option value="4">Chandigarh</option>
                                                                           <option value="22">Chhattisgarh</option>
                                                                           <option value="26">Dadra and Nagar Haveli</option>
                                                                           <option value="7">Delhi</option>
                                                                           <option value="30">Goa</option>
                                                                           <option value="24">Gujarat</option>
                                                                           <option value="6">Haryana</option>
                                                                           <option value="2">Himachal Pradesh</option>
                                                                           <option value="1">Jammu and Kashmir</option>
                                                                           <option value="20">Jharkhand</option>
                                                                           <option value="29">Karnataka</option>
                                                                           <option value="32">Kerala</option>
                                                                           <option value="31">Lakshadweep</option>
                                                                           <option value="23">Madhya Pradesh</option>
                                                                           <option value="27">Maharashtra</option>
                                                                           <option value="14">Manipur</option>
                                                                           <option value="17">Meghalaya</option>
                                                                           <option value="15">Mizoram</option>
                                                                           <option value="13">Nagaland</option>
                                                                           <option value="21">Odisha</option>
                                                                           <option value="34">Puducherry</option>
                                                                           <option value="3">Punjab</option>
                                                                           <option value="8">Rajasthan</option>
                                                                           <option value="11">Sikkim</option>
                                                                           <option value="33">Tamil Nadu</option>
                                                                           <option value="36">Telangana</option>
                                                                           <option value="16">Tripura</option>
                                                                           <option value="5">Uttarakhand</option>
                                                                           <option value="9">Uttar Pradesh</option>
                                                                           <option value="19">West Bengal</option>
                                                                        </select>
                                                                     </span>
                                                                  </div>
                                                               </div>
                                                               <div class="col-md-4">
                                                                  <div class="form-group">
                                                                     <label class="mandatory mandatory_label">Country </label>
                                                                     <select name="body_organ_country" id="body_organ_country" class="input-select form-control" title="Please select a Country" alt="Please select a Country">
                                                                        <option value="102" selected="selected">India</option>
                                                                     </select>
                                                                  </div>
                                                               </div>
                                                               <div class="col-md-4">
                                                                  <div class="form-group">
                                                                     <label class="mandatory mandatory_label">Pincode </label>
                                                                     <input class="form-control numeric" name="body_organ_zip" id="body_organ_zip" value="" placeholder="Pincode" title="Please enter Pincode" alt="Please enter Pincode" type="text">
                                                                  </div>
                                                               </div>
                                                            </div>
                                                         </div>
                                                         <div class="personalInfoScroll jumbotron p-1 font-italic m-2 text-justify">
                                                            <span style="color: #d33633; font-size: bigger">Note</span><br /><b>1. Body Organ Name:</b>
                                                            Body organ name which is specifically donated or agreed to pass on to
                                                            someone after the death through an agreement.<br />
                                                            <b>2. Name of Hospital:</b> Name of hospital where the operations will be
                                                            carried out and as mentioned in the agreement so executed. <br />
                                                            <b>3. Address:</b> Address of the hospital.
                                                         </div>
                                                         <div class="modal-footer">
                                                            <button class="boxed_btn4 save" data-role="update" data-id="" data-table="will_body_organ" data-key="pk_borgan_id">Save</button>
                                                            <input type="button" class="boxed_btn4" data-dismiss="modal" value="Cancel">
                                                         </div>
                                                      </form>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="tab-pane fade" id="v-pills-pa" role="tabpanel" aria-labelledby="v-pills-pa-tab">
                                          <div class="panel-body-small2">
                                             <div class="row no-gutters">
                                                <h5><strong>Pet Animal</strong></h5>
                                                <div class="table-responsive mt-2">
                                                   <a href="#petAnimalModal" class="add_btn float-right add" data-toggle="modal"><i class="fas fa-plus mr-1" aria-hidden="true" style="font-size: inherit; color: inherit;"></i><span>Add Pet Animal</span></a>
                                                   <table class="table table-bordered" id="petAnimalTable">
                                                      <thead class="thead-light">
                                                         <tr>
                                                            <th>Pet Name</th>
                                                            <th>Pet Type</th>
                                                            <th>Beneficiary</th>
                                                            <th style="width: 266px;">Action</th>
                                                         </tr>
                                                      </thead>
                                                      <tbody>

                                                      </tbody>
                                                   </table>
                                                </div>
                                             </div>
                                             <div id="petAnimalModal" class="modal fade">
                                                <div class="modal-dialog modal-lg">
                                                   <div class="modal-content">
                                                      <form data-formType="1" name="addPetAnimal" id="addPetAnimal" action="<?= $CONFIG->siteurl; ?>./__lib.ajax/frmForm.php" method="post" class="frmCurrent has-validation-callback">
                                                         <div class="modal-header">
                                                            <h4 class="modal-title">Pet</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                         </div>
                                                         <div class="modal-body">
                                                            <div class="row">
                                                               <div class="col-md-4">
                                                                  <div class="form-group">
                                                                     <label class="mandatory mandatory_label">Pet Details (Type) </label>
                                                                     <input type="text" class="form-control" name="pet_animal_type" id="pet_animal_type" value="" placeholder="Pet Details (Type)" alt="Please enter Policy number">
                                                                  </div>
                                                               </div>
                                                               <div class="col-md-4">
                                                                  <div class="form-group">
                                                                     <label class="mandatory mandatory_label">Name of animal </label>
                                                                     <input type="text" class="form-control" name="pet_animal_name" id="pet_animal_name" value="" placeholder="Name of animal" alt="Please enter Policy number">
                                                                  </div>
                                                               </div>
                                                               <div class="col-md-4">
                                                                  <div class="form-group">
                                                                     <label class="mandatory mandatory_label">Beneficiary </label>
                                                                     <select name="pet_animal_beneficiary" id="pet_animal_beneficiary" class="input-select form-control" alt="Please select a Beneficiary">
                                                                        <option value="">Please select</option>
                                                                     </select>
                                                                  </div>
                                                               </div>
                                                            </div>
                                                         </div>
                                                         <div class="personalInfoScroll jumbotron p-1 font-italic m-2 text-justify">
                                                            <span style="color: #d33633; font-size: bigger">Note</span><br /><b>1. Pet Details (Type):</b>
                                                            The type of pet like cat or dog or rabbit, etc.<br />
                                                            <b>2. Name of the Animal:</b> The name which is generally used to
                                                            addressed.<br />
                                                            <b>3. Beneficiary:</b> Select the beneficiary who will be entitled to keep
                                                            the pet after the death of the ‘will writer/ testator’.
                                                         </div>
                                                         <div class="modal-footer">
                                                            <button class="boxed_btn4 save" data-role="update" data-id="" data-table="will_pet_animal" data-key="pk_pa_id">Save</button>
                                                            <input type="button" class="boxed_btn4" data-dismiss="modal" value="Cancel">
                                                         </div>
                                                      </form>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="tab-pane fade" id="v-pills-oa" role="tabpanel" aria-labelledby="v-pills-oa-tab">
                                          <div class="panel-body-small2" id="oalist">
                                             <!-- Nav tabs -->
                                             <ul class="nav nav-tabs nav-fill" role="tablist">
                                                <li role="presentation" class="nav-item active"><a class="nav-link text-center active" href="#otherAssets" aria-controls="otherAssets" role="tab" data-toggle="tab">Other Assets</a></li>
                                                <li role="presentation" class="nav-item"><a class="nav-link text-center" href="#ipr" aria-controls="ipr" role="tab" data-toggle="tab">IPR</a></li>
                                                <li role="presentation" class="nav-item"><a class="nav-link text-center" href="#vehicle" aria-controls="vehicle" role="tab" data-toggle="tab">Vehicle</a></li>
                                             </ul>
                                             <!-- Tab panes -->
                                             <div class="tab-content">
                                                <div role="tabpanel" class="tab-pane active show" id="otherAssets">
                                                   <div class="panel-body-small2">
                                                      <div class="row no-gutters">
                                                         <div class="table-responsive mt-2">
                                                            <a href="#otherAssetsModal" class="add_btn float-right add" data-toggle="modal"><i class="fas fa-plus mr-1" aria-hidden="true" style="font-size: inherit; color: inherit;"></i><span>Add Other Assets</span></a>
                                                            <table class="table table-bordered" id="otherAssetsTable">
                                                               <thead class="thead-light">
                                                                  <tr>
                                                                     <th>Property Type</th>
                                                                     <th>Address</th>
                                                                     <th>Measurement</th>
                                                                     <th>Used Percentage</th>
                                                                     <th>Balance Percentage</th>
                                                                     <th style="width: 266px;">Action</th>
                                                                  </tr>
                                                               </thead>
                                                               <tbody>

                                                               </tbody>
                                                            </table>
                                                         </div>
                                                      </div>
                                                      <div id="otherAssetsModal" class="modal fade">
                                                         <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                               <form data-formType="1" name="addOtherAsset" id="addOtherAsset" action="<?= $CONFIG->siteurl; ?>./__lib.ajax/frmForm.php" method="post" class="frmCurrent has-validation-callback">
                                                                  <div class="modal-header">
                                                                     <h4 class="modal-title">Add Asset</h4>
                                                                     <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                  </div>
                                                                  <div class="modal-body">
                                                                     <div class="row">
                                                                        <div class="col-md-4">
                                                                           <div class="form-group">
                                                                              <label class="mandatory mandatory_label">Name of the asset </label>
                                                                              <input type="text" class="form-control" name="oa_name" id="oa_name" value="" placeholder="Name of the asset" alt="Please enter Policy number">
                                                                           </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                           <div class="form-group">
                                                                              <label class="mandatory mandatory_label">Ownership type </label>
                                                                              <select name="oa_ownership" id="oa_ownership" class="form-control">
                                                                                 <option value="">Select</option>
                                                                                 <option value="single">Single</option>
                                                                                 <option value="joint">Joint</option>
                                                                              </select>
                                                                           </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                           <div class="form-group">
                                                                              <label class="mandatory mandatory_label">Ownership in %</label>
                                                                              <input class="form-control" value="" name="oa_own_perc" id="oa_own_perc" type="text">
                                                                           </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                           <div class="form-group">
                                                                              <label class="mandatory mandatory_label">Description of assets </label>
                                                                              <input type="text" class="form-control" name="oa_desc" id="oa_desc" value="" placeholder="Asset description" alt="">
                                                                           </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                           <div class="form-group">
                                                                              <label class="mandatory mandatory_label">Address Line 1 </label>
                                                                              <input class="form-control" name="oa_addr1" id="oa_addr1" value="" placeholder="Address Line 1" alt="Please enter Address Line1" type="text">
                                                                           </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                           <div class="form-group">
                                                                              <label class="mandatory mandatory_label">Address Line 2 </label>
                                                                              <input class="form-control" name="oa_addr2" id="oa_addr2" value="" placeholder="Address Line 2" alt="Please enter Address Line2" type="text">
                                                                           </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                           <div class="form-group">
                                                                              <label class="mandatory mandatory_label">City / Village / Town</label>
                                                                              <input class="form-control" name="oa_city" id="oa_city" value="" placeholder="City / Village / Town" alt="Please enter City / Village / Town">
                                                                           </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                           <div class="form-group">
                                                                              <label class="mandatory mandatory_label">State </label>
                                                                              <span id="span_state">
                                                                                 <select name="oa_state" id="oa_state" class="input-select form-control" alt="Please select appropriate State">
                                                                                    <option value="" selected>Select State</option>
                                                                                    <option value="35">Andaman and Nicobar Islands</option>
                                                                                    <option value="25">Daman and Diu</option>
                                                                                    <option value="28">Andhra Pradesh</option>
                                                                                    <option value="12">Arunachal Pradesh</option>
                                                                                    <option value="18">Assam</option>
                                                                                    <option value="10">Bihar</option>
                                                                                    <option value="4">Chandigarh</option>
                                                                                    <option value="22">Chhattisgarh</option>
                                                                                    <option value="26">Dadra and Nagar Haveli</option>
                                                                                    <option value="7">Delhi</option>
                                                                                    <option value="30">Goa</option>
                                                                                    <option value="24">Gujarat</option>
                                                                                    <option value="6">Haryana</option>
                                                                                    <option value="2">Himachal Pradesh</option>
                                                                                    <option value="1">Jammu and Kashmir</option>
                                                                                    <option value="20">Jharkhand</option>
                                                                                    <option value="29">Karnataka</option>
                                                                                    <option value="32">Kerala</option>
                                                                                    <option value="31">Lakshadweep</option>
                                                                                    <option value="23">Madhya Pradesh</option>
                                                                                    <option value="27">Maharashtra</option>
                                                                                    <option value="14">Manipur</option>
                                                                                    <option value="17">Meghalaya</option>
                                                                                    <option value="15">Mizoram</option>
                                                                                    <option value="13">Nagaland</option>
                                                                                    <option value="21">Odisha</option>
                                                                                    <option value="34">Puducherry</option>
                                                                                    <option value="3">Punjab</option>
                                                                                    <option value="8">Rajasthan</option>
                                                                                    <option value="11">Sikkim</option>
                                                                                    <option value="33">Tamil Nadu</option>
                                                                                    <option value="36">Telangana</option>
                                                                                    <option value="16">Tripura</option>
                                                                                    <option value="5">Uttarakhand</option>
                                                                                    <option value="9">Uttar Pradesh</option>
                                                                                    <option value="19">West Bengal</option>
                                                                                 </select>
                                                                              </span>
                                                                           </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                           <div class="form-group">
                                                                              <label class="mandatory mandatory_label">Country </label>
                                                                              <select name="oa_country" id="oa_country" class="input-select form-control" alt="Please select a country">
                                                                                 <option value="102" selected="selected">India</option>
                                                                              </select>
                                                                           </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                           <div class="form-group">
                                                                              <label class="mandatory mandatory_label">Pincode </label>
                                                                              <input class="form-control numeric" name="oa_zip" id="oa_zip" value="" placeholder="Pincode" alt="Please enter Pincode" type="text">
                                                                           </div>
                                                                           <input class="form-control" name="ba_usedperc" id="ba_usedperc" value="0" maxlength="3" min="1" max="100" type="hidden">
                                                                           <input class="form-control" name="ba_balperc" id="ba_balperc" value="100" maxlength="3" min="1" max="100" type="hidden">
                                                                        </div>
                                                                     </div>
                                                                  </div>
                                                                  <div class="personalInfoScroll jumbotron p-1 font-italic m-2 text-justify">
                                                                     <span style="color: #d33633; font-size: bigger">Note</span><br /><b>
                                                                        1. Detail of any other asset which is not covered in any of the above
                                                                        categories can be captured here.</b><br />
                                                                     <b>2. Name of the other Asset:</b> Mention the name of the asset. <br />
                                                                     <b>3. Ownership:</b> % ownership of the asset so mentioned.
                                                                  </div>
                                                                  <div class="modal-footer">
                                                                     <button class="boxed_btn4 save" data-role="update" data-id="" data-table="will_other_assets" data-key="pk_oasset_id">Save</button>
                                                                     <input type="button" class="boxed_btn4" data-dismiss="modal" value="Cancel">
                                                                  </div>
                                                               </form>
                                                            </div>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                                <div role="tabpanel" class="tab-pane" id="ipr">
                                                   <div class="panel-body-small2">
                                                      <div class="row no-gutters">
                                                         <div class="table-responsive mt-2">
                                                            <a href="#iprModal" class="add_btn float-right add" data-toggle="modal"><i class="fas fa-plus mr-1" aria-hidden="true" style="font-size: inherit; color: inherit;"></i><span>Add IPR</span></a>
                                                            <table class="table table-bordered" id="iprTable">
                                                               <thead class="thead-light">
                                                                  <tr>
                                                                     <th>IPR Type</th>
                                                                     <th>Amount</th>
                                                                     <th>Used Percentage</th>
                                                                     <th>Balance Percentage</th>
                                                                     <th style="width: 266px;">Action</th>
                                                                  </tr>
                                                               </thead>
                                                               <tbody>

                                                               </tbody>
                                                            </table>
                                                         </div>
                                                      </div>
                                                      <div id="iprModal" class="modal fade">
                                                         <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                               <form data-formType="1" name="addIPR" id="addIPR" action="<?= $CONFIG->siteurl; ?>./__lib.ajax/frmForm.php" method="post" class="frmCurrent has-validation-callback">
                                                                  <div class="modal-header">
                                                                     <h4 class="modal-title">IPR</h4>
                                                                     <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                  </div>
                                                                  <div class="modal-body">
                                                                     <div class="row">
                                                                        <div class="col-md-4">
                                                                           <div class="form-group">
                                                                              <label class="mandatory mandatory_label">Type of IPR </label>
                                                                              <select name="ipr_type" id="ipr_type" class="input-select form-control" alt="Please select Type of asset">
                                                                                 <option value="" selected="">Please select</option>
                                                                                 <option value="1">Digital Photograph</option>
                                                                                 <option value="2">Software Code</option>
                                                                                 <option value="3">Software Patent</option>
                                                                                 <option value="4">Others</option>
                                                                              </select>
                                                                           </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                           <div class="form-group">
                                                                              <label class="mandatory mandatory_label">Amount </label>
                                                                              <input class="form-control numeric_share" name="ipr_amount" id="ipr_amount" placeholder="Enter IPR amount" alt="Please enter Percentage Share to be allotted" value="" type="text">
                                                                           </div>
                                                                           <input class="form-control" name="ba_usedperc" id="ba_usedperc" value="0" maxlength="3" min="1" max="100" type="hidden">
                                                                           <input class="form-control" name="ba_balperc" id="ba_balperc" value="100" maxlength="3" min="1" max="100" type="hidden">
                                                                        </div>
                                                                     </div>
                                                                  </div>
                                                                  <div class="modal-footer">
                                                                     <button class=" boxed_btn4 save" data-role="update" data-id="" data-table="will_ipr" data-key="pk_digi_id">Save</button>
                                                                     <input type="button" class="boxed_btn4" data-dismiss="modal" value="Cancel">
                                                                  </div>
                                                               </form>
                                                            </div>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                                <div role="tabpanel" class="tab-pane" id="vehicle">
                                                   <div class="panel-body-small2">
                                                      <div class="row no-gutters">
                                                         <div class="table-responsive mt-2">
                                                            <a href="#vehicleModal" class="add_btn float-right add" data-toggle="modal"><i class="fas fa-plus mr-1" aria-hidden="true" style="font-size: inherit; color: inherit;"></i><span>Add Vehicle</span></a>
                                                            <table class="table table-bordered" id="vehicletable">
                                                               <thead class="thead-light">
                                                                  <tr>
                                                                     <th>Vehicle Name</th>
                                                                     <th>No.</th>
                                                                     <th>Beneficiary</th>
                                                                     <th style="width: 266px;">Action</th>
                                                                  </tr>
                                                               </thead>
                                                               <tbody>

                                                               </tbody>
                                                            </table>
                                                         </div>
                                                      </div>
                                                      <div id="vehicleModal" class="modal fade">
                                                         <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                               <form data-formType="1" name="addVehicle" id="addVehicle" action="<?= $CONFIG->siteurl; ?>./__lib.ajax/frmForm.php" method="post" class="frmCurrent has-validation-callback">
                                                                  <div class="modal-header">
                                                                     <h4 class="modal-title">Vehicle</h4>
                                                                     <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                  </div>
                                                                  <div class="modal-body">
                                                                     <div class="row">
                                                                        <div class="col-md-4">
                                                                           <div class="form-group">
                                                                              <label class="mandatory mandatory_label">Name of asset </label>
                                                                              <input type="text" class="form-control" name="vehicle_name" id="vehicle_name" value="" placeholder="Enter Name of asset" alt="Please enter Policy number">
                                                                           </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                           <div class="form-group">
                                                                              <label class="mandatory mandatory_label">Ownership </label>
                                                                              <select class="form-control" name="vehicle_ownership" id="vehicle_ownership">
                                                                                 <option value="">Select</option>
                                                                                 <option value="single">Single</option>
                                                                                 <option value="joint">Joint</option>
                                                                              </select>
                                                                           </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                           <div class="form-group">
                                                                              <label class="mandatory mandatory_label">Reg. No </label><br>
                                                                              <input type="text" class="form-control" name="vehicle_reg_num" id="vehicle_reg_num" value="" placeholder="Enter Reg. No" alt="Please enter Policy number">
                                                                           </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                           <div class="form-group">
                                                                              <label class="mandatory madatory_label">Color </label><br>
                                                                              <input type="text" class="form-control" name="vehicle_color" id="vehicle_color" value="" placeholder="Enter color" alt="Please enter Policy number">
                                                                           </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                           <div class="form-group">
                                                                              <label class="mandatory mandatory_label">Address Line 1 </label>
                                                                              <input class="form-control" name="vehicle_addr1" id="vehicle_addr1" value="" placeholder="Address Line 1" alt="Please enter Address Line1" type="text">
                                                                           </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                           <div class="form-group">
                                                                              <label class="mandatory mandatory_label">Address Line 2 </label>
                                                                              <input class="form-control" name="vehicle_addr2" id="vehicle_addr2" value="" placeholder="Address Line 2" alt="Please enter Address Line2" type="text">
                                                                           </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                           <div class="form-group">
                                                                              <label class="mandatory mandatory_label">City / Village / Town</label>
                                                                              <input class="form-control" name="vehicle_city" id="vehicle_city" value="" placeholder="City / Village / Town" alt="Please enter City / Village / Town">
                                                                           </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                           <div class="form-group">
                                                                              <label class="mandatory mandatory_label">State </label>
                                                                              <span id="span_state">
                                                                                 <select name="vehicle_state" id="vehicle_state" class="input-select form-control" alt="Please select appropriate State">
                                                                                    <option value="" selected>Select State</option>
                                                                                    <option value="35">Andaman and Nicobar Islands</option>
                                                                                    <option value="25">Daman and Diu</option>
                                                                                    <option value="28">Andhra Pradesh</option>
                                                                                    <option value="12">Arunachal Pradesh</option>
                                                                                    <option value="18">Assam</option>
                                                                                    <option value="10">Bihar</option>
                                                                                    <option value="4">Chandigarh</option>
                                                                                    <option value="22">Chhattisgarh</option>
                                                                                    <option value="26">Dadra and Nagar Haveli</option>
                                                                                    <option value="7">Delhi</option>
                                                                                    <option value="30">Goa</option>
                                                                                    <option value="24">Gujarat</option>
                                                                                    <option value="6">Haryana</option>
                                                                                    <option value="2">Himachal Pradesh</option>
                                                                                    <option value="1">Jammu and Kashmir</option>
                                                                                    <option value="20">Jharkhand</option>
                                                                                    <option value="29">Karnataka</option>
                                                                                    <option value="32">Kerala</option>
                                                                                    <option value="31">Lakshadweep</option>
                                                                                    <option value="23">Madhya Pradesh</option>
                                                                                    <option value="27">Maharashtra</option>
                                                                                    <option value="14">Manipur</option>
                                                                                    <option value="17">Meghalaya</option>
                                                                                    <option value="15">Mizoram</option>
                                                                                    <option value="13">Nagaland</option>
                                                                                    <option value="21">Odisha</option>
                                                                                    <option value="34">Puducherry</option>
                                                                                    <option value="3">Punjab</option>
                                                                                    <option value="8">Rajasthan</option>
                                                                                    <option value="11">Sikkim</option>
                                                                                    <option value="33">Tamil Nadu</option>
                                                                                    <option value="36">Telangana</option>
                                                                                    <option value="16">Tripura</option>
                                                                                    <option value="5">Uttarakhand</option>
                                                                                    <option value="9">Uttar Pradesh</option>
                                                                                    <option value="19">West Bengal</option>
                                                                                 </select>
                                                                              </span>
                                                                           </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                           <div class="form-group">
                                                                              <label class="mandatory mandatory_label">Country </label>
                                                                              <select name="vehicle_country" id="vehicle_country" class="input-select form-control" alt="Please select a Country">

                                                                                 <option value="102" selected="selected">India</option>
                                                                              </select>
                                                                           </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                           <div class="form-group">
                                                                              <label class="mandatory mandatory_label">Pincode </label>
                                                                              <input class="form-control numeric" name="vehicle_zip" id="vehicle_zip" value="" placeholder="Pincode" alt="Please enter Pincode" type="text">
                                                                           </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                           <div class="form-group">
                                                                              <label class="mandatory mandatory_label">Beneficiary </label>
                                                                              <select name="vehicle_beneficiary" id="vehicle_beneficiary" class="input-select form-control" alt="Please select a Beneficiary">
                                                                                 <option value="">Please select</option>
                                                                              </select>
                                                                           </div>
                                                                        </div>
                                                                     </div>
                                                                  </div>
                                                                  <div class="modal-footer">
                                                                     <button class="boxed_btn4 save" data-role="update" data-id="" data-table="will_vehicle" data-key="pk_vehicle_id">Save</button>
                                                                     <input type="button" class="boxed_btn4" data-dismiss="modal" value="Cancel">
                                                                  </div>
                                                               </form>
                                                            </div>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="tab-pane fade" id="v-pills-l" role="tabpanel" aria-labelledby="v-pills-l-tab">
                                          <div class="panel-body-small2">
                                             <div class="row no-gutters">
                                                <h5><strong>Liability</strong></h5>
                                                <div class="table-responsive mt-2">
                                                   <a href="#liabilityModal" class="add_btn float-right add" data-toggle="modal"><i class="fas fa-plus mr-1" aria-hidden="true" style="font-size: inherit; color: inherit;"></i><span>Add Liability</span></a>
                                                   <table class="table table-bordered" id="liabilityTable">
                                                      <thead class="thead-light">
                                                         <tr>
                                                            <th>Liability Type</th>
                                                            <th>Name of the Individual / Institution</th>
                                                            <th>Loan Amount</th>
                                                            <th>Property Address</th>
                                                            <th>Individual Address</th>
                                                            <th>Used Percentage</th>
                                                            <th>Balance Percentage</th>
                                                            <th>Action</th>
                                                         </tr>
                                                      </thead>
                                                      <tbody>

                                                      </tbody>
                                                   </table>
                                                </div>
                                             </div>
                                             <div id="liabilityModal" class="modal fade">
                                                <div class="modal-dialog modal-lg">
                                                   <div class="modal-content">
                                                      <form data-formType="1" name="addLiability" id="addLiability" action="<?= $CONFIG->siteurl; ?>./__lib.ajax/frmForm.php" method="post" class="frmCurrent has-validation-callback">
                                                         <div class="modal-header">
                                                            <h4 class="modal-title">Add Liability</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                         </div>
                                                         <div class="modal-body">
                                                            <div class="row">
                                                               <div class="col-md-4">
                                                                  <div class="form-group">
                                                                     <label class="mandatory mandatory_label ">Type of Liability </label>
                                                                     <select name="liability_type " id="liability_type " class="input-select form-control" alt="Please select Type of liability ">
                                                                        <option value=" " selected>Please select</option>
                                                                        <option value="1">Loan</option>
                                                                        <option value="2">Hypothecation</option>
                                                                        <option value="3">Mortgage</option>
                                                                        <option value="4">Guarantor</option>
                                                                        <option value="5">Other</option>
                                                                     </select>
                                                                  </div>
                                                               </div>
                                                               <div class="col-md-4">
                                                                  <div class="form-group">
                                                                     <label class="mandatory mandatory_label ">Name of the Individual / Institution </label>
                                                                     <input type="text " class="form-control " name="liability_institution_name" id="liability_institution_name" value="" placeholder="Name of the Individual / Institution" alt="Please enter Name of the Individual / Institution ">
                                                                  </div>
                                                               </div>
                                                               <div class="col-md-4">
                                                                  <div class="form-group">
                                                                     <label class="mandatory mandatory_label ">Loan amount </label>
                                                                     <input type="text" class="form-control " name="liability_amount " id="liability_amount " value="" placeholder="Enter Loan amount" alt="Please enter Name of the Individual / Institution ">
                                                                  </div>
                                                               </div>
                                                               <div class="col-md-4">
                                                                  <div class="form-group">
                                                                     <label class="mandatory mandatory_label ">Measurement of property </label>
                                                                     <input type="text " class="form-control " name="liability_prop_mes" id="liability_prop_mes" value="" placeholder="Enter measurement of property" alt="Please enter Name of the Individual / Institution ">
                                                                  </div>
                                                               </div>
                                                            </div>
                                                            <h6><strong>Address of the property</strong></h6>
                                                            <div class="row">
                                                               <div class="col-md-4">
                                                                  <div class="form-group">
                                                                     <label class="mandatory ">Address Line 1</label>
                                                                     <input class="form-control" name="liability_addr1" id="liability_addr1" value="" placeholder="Address Line 1" alt="Please enter Address Line1" type="text">
                                                                  </div>
                                                               </div>
                                                               <div class="col-md-4">
                                                                  <div class="form-group">
                                                                     <label class="mandatory ">Address Line 2</label>
                                                                     <input class="form-control" name="liability_addr1" id="liability_addr2" value="" placeholder="Address Line 2" alt="Please enter Address Line2" type="text">
                                                                  </div>
                                                               </div>
                                                               <div class="col-md-4">
                                                                  <div class="form-group">
                                                                     <label class="mandatory">City / Village / Town</label>
                                                                     <input class="form-control" name="liability_city" id="liability_city" value="" placeholder="City / Village / Town" alt="Please enter City / Village / Town" type="text">
                                                                  </div>
                                                               </div>
                                                               <div class="col-md-4">
                                                                  <div class="form-group">
                                                                     <label class="mandatory ">State </label>
                                                                     <span id="span_state">
                                                                        <select name="liability_state" id="liability_state" class="input-select form-control" alt="Please select appropriate State">
                                                                           <option value="" selected>Select State</option>
                                                                           <option value="35">Andaman and Nicobar Islands</option>
                                                                           <option value="25">Daman and Diu</option>
                                                                           <option value="28">Andhra Pradesh</option>
                                                                           <option value="12">Arunachal Pradesh</option>
                                                                           <option value="18">Assam</option>
                                                                           <option value="10">Bihar</option>
                                                                           <option value="4">Chandigarh</option>
                                                                           <option value="22">Chhattisgarh</option>
                                                                           <option value="26">Dadra and Nagar Haveli</option>
                                                                           <option value="7">Delhi</option>
                                                                           <option value="30">Goa</option>
                                                                           <option value="24">Gujarat</option>
                                                                           <option value="6">Haryana</option>
                                                                           <option value="2">Himachal Pradesh</option>
                                                                           <option value="1">Jammu and Kashmir</option>
                                                                           <option value="20">Jharkhand</option>
                                                                           <option value="29">Karnataka</option>
                                                                           <option value="32">Kerala</option>
                                                                           <option value="31">Lakshadweep</option>
                                                                           <option value="23">Madhya Pradesh</option>
                                                                           <option value="27">Maharashtra</option>
                                                                           <option value="14">Manipur</option>
                                                                           <option value="17">Meghalaya</option>
                                                                           <option value="15">Mizoram</option>
                                                                           <option value="13">Nagaland</option>
                                                                           <option value="21">Odisha</option>
                                                                           <option value="34">Puducherry</option>
                                                                           <option value="3">Punjab</option>
                                                                           <option value="8">Rajasthan</option>
                                                                           <option value="11">Sikkim</option>
                                                                           <option value="33">Tamil Nadu</option>
                                                                           <option value="36">Telangana</option>
                                                                           <option value="16">Tripura</option>
                                                                           <option value="5">Uttarakhand</option>
                                                                           <option value="9">Uttar Pradesh</option>
                                                                           <option value="19">West Bengal</option>
                                                                        </select>
                                                                     </span>
                                                                  </div>
                                                               </div>
                                                               <div class="col-md-4">
                                                                  <div class="form-group">
                                                                     <label class="mandatory">Country </label>
                                                                     <select name="liability_country" id="liability_country" class="input-select form-control" alt="Please select a Country">

                                                                        <option value="102" selected="selected">India</option>
                                                                     </select>
                                                                  </div>
                                                               </div>
                                                               <div class="col-md-4">
                                                                  <div class="form-group">
                                                                     <label class="mandatory ">Pincode </label>
                                                                     <input class="form-control numeric" name="liability_zip" id="liability_zip" value="" placeholder="Pincode" alt="Please enter Pincode" type="text">
                                                                  </div>
                                                               </div>
                                                            </div>
                                                            <h6><strong>Address of the individual</strong></h6>
                                                            <div class="row">
                                                               <div class="col-md-4">
                                                                  <div class="form-group">
                                                                     <label class="mandatory ">Address Line 1</label>
                                                                     <input type="text " class="form-control " name="liability_ind_addr1" id="liability_ind_addr1" value="" placeholder="Address Line 1" alt="Please enter Address Line1 ">
                                                                  </div>
                                                               </div>
                                                               <div class="col-md-4">
                                                                  <div class="form-group">
                                                                     <label class="mandatory ">Address Line 2</label>
                                                                     <input type="text " class="form-control " name="liability_ind_addr2" name="liability_ind_addr2" value="" placeholder="Address Line 2" alt="Please enter Address Line2 ">
                                                                  </div>
                                                               </div>
                                                               <div class="col-md-4">
                                                                  <div class="form-group">
                                                                     <label class="mandatory">City / Village / Town</label>
                                                                     <input type="text " class="form-control " name="liability_ind_city" id="liability_ind_city" value="" placeholder="City/Town/Village" alt="Please enter City / Village / Town ">
                                                                  </div>
                                                               </div>
                                                               <div class="col-md-4">
                                                                  <div class="form-group">
                                                                     <label class="mandatory ">State </label>
                                                                     <span id="span_state">
                                                                        <select name="liability_ind_state" id="liability_ind_state" class="input-select form-control ">
                                                                           <option value="" selected>Select State</option>
                                                                           <option value="35">Andaman and Nicobar Islands</option>
                                                                           <option value="25">Daman and Diu</option>
                                                                           <option value="28">Andhra Pradesh</option>
                                                                           <option value="12">Arunachal Pradesh</option>
                                                                           <option value="18">Assam</option>
                                                                           <option value="10">Bihar</option>
                                                                           <option value="4">Chandigarh</option>
                                                                           <option value="22">Chhattisgarh</option>
                                                                           <option value="26">Dadra and Nagar Haveli</option>
                                                                           <option value="7">Delhi</option>
                                                                           <option value="30">Goa</option>
                                                                           <option value="24">Gujarat</option>
                                                                           <option value="6">Haryana</option>
                                                                           <option value="2">Himachal Pradesh</option>
                                                                           <option value="1">Jammu and Kashmir</option>
                                                                           <option value="20">Jharkhand</option>
                                                                           <option value="29">Karnataka</option>
                                                                           <option value="32">Kerala</option>
                                                                           <option value="31">Lakshadweep</option>
                                                                           <option value="23">Madhya Pradesh</option>
                                                                           <option value="27">Maharashtra</option>
                                                                           <option value="14">Manipur</option>
                                                                           <option value="17">Meghalaya</option>
                                                                           <option value="15">Mizoram</option>
                                                                           <option value="13">Nagaland</option>
                                                                           <option value="21">Odisha</option>
                                                                           <option value="34">Puducherry</option>
                                                                           <option value="3">Punjab</option>
                                                                           <option value="8">Rajasthan</option>
                                                                           <option value="11">Sikkim</option>
                                                                           <option value="33">Tamil Nadu</option>
                                                                           <option value="36">Telangana</option>
                                                                           <option value="16">Tripura</option>
                                                                           <option value="5">Uttarakhand</option>
                                                                           <option value="9">Uttar Pradesh</option>
                                                                           <option value="19">West Bengal</option>
                                                                        </select>
                                                                     </span>
                                                                  </div>
                                                               </div>
                                                               <div class="col-md-4">
                                                                  <div class="form-group">
                                                                     <label class="mandatory">Country </label>
                                                                     <select name="liability_ind_country " id="liability_ind_country " class="input-select form-control" alt="Please select a Country">

                                                                        <option value="102 " selected="selected ">India</option>
                                                                     </select>
                                                                  </div>
                                                               </div>
                                                               <div class="col-md-4">
                                                                  <div class="form-group">
                                                                     <label class="mandatory ">Pincode </label>
                                                                     <input type="text" class="form-control numeric " name="liability_ind_zip" id="liability_ind_zip" value="" placeholder="Pincode" alt="Please enter Pincode">
                                                                  </div>
                                                               </div>
                                                            </div>
                                                            <div class="row">
                                                               <div class="col-md-4">
                                                                  <div class="form-group">
                                                                     <label class="mandatory ">Loan Starting Date</label>
                                                                     <input type="date" name="liability_start_date" id="liability_start_date" placeholder="Loan starting date" class="form-control" value="" alt="Please enter Loan starting date ">
                                                                  </div>
                                                               </div>
                                                               <div class="col-md-4">
                                                                  <div class="form-group">
                                                                     <label class="mandatory ">Loan Closing Date</label>
                                                                     <input type="date" name="liability_closing_date" id="liability_closing_date" placeholder="Loan closing date" class="form-control" value="" alt="Please enter Loan closing date ">
                                                                  </div>
                                                               </div>
                                                               <div class="col-md-4">
                                                                  <div class="form-group">
                                                                     <label class="mandatory "><span id="account_num_txt ">Account Number</span></label>
                                                                     <input type="text" placeholder="Account number" name="liability_account_number" id="liability_account_number" class="form-control numeric" value="" alt="Please enter Account number ">
                                                                  </div>
                                                               </div>
                                                               <div class="col-md-4">
                                                                  <div class="form-group">
                                                                     <label class="mandatory "><span id="account_num_txt ">Interest rate</span></label>
                                                                     <input type="text" placeholder="Interest rate" name="liability_interest_rate" id="liability_interest_rate" class="form-control numeric" value="" alt="Please enter Account number ">
                                                                  </div>
                                                                  <input class="form-control" name="ba_usedperc" id="ba_usedperc" value="0" maxlength="3" min="1" max="100" type="hidden">
                                                                  <input class="form-control" name="ba_balperc" id="ba_balperc" value="100" maxlength="3" min="1" max="100" type="hidden">
                                                               </div>
                                                            </div>
                                                         </div>
                                                         <div class="personalInfoScroll jumbotron p-1 font-italic m-2 text-justify">
                                                            <span style="color: #d33633; font-size: bigger">Note</span><br /><b>1. Measurement of Property:</b>
                                                            For N/A mention ‘0’ (Zero in numeric)
                                                         </div>
                                                         <div class="modal-footer">
                                                            <button class="boxed_btn4 save" data-role="update" data-id="" data-table="will_liabilities" data-key="pk_liabi_id">Save</button>
                                                            <input type="button" class="boxed_btn4" data-dismiss="modal" value="Cancel">
                                                         </div>
                                                      </form>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="card-footer text-center">
                              <!-- <button class="btn btn-primary btn-sm float-left btnPrevious" id="left" style="color:white"> Previous </button>
                              <button class="btn btn-danger btn-sm float-right btnNext" id="right" style="color:white">Next</button>  -->
                           </div>
                        </div>
                     </div>
                     <div class="tab-pane fade" id="custodian" role="tabpanel" aria-labelledby="custodian-tab-2">
                        <div class="">
                           <form name="frmCustodian" action="<?= $CONFIG->siteurl; ?>./__lib.ajax/frmForm.php" id="frmCustodian" method="post" class="frmCurrent" data-formType="0">
                              <div class="card-body">
                                 <div class="row">
                                    <div class="col-md-3">
                                       <div class="form-group">
                                          <label class="mandatory mandatory_label">Custodian full name </label>
                                          <input type="text" class="form-control formname" name="cust_name" id="cust_name" value="" placeholder="Custodian name" alt="Please enter custodian name" data-validation="" data-validation-error-msg="please enter valid custodian name">
                                       </div>
                                    </div>
                                    <div class="col-md-3">
                                       <div class="form-group">
                                          <label class="mandatory mandatory_label">Custodian father name</label>
                                          <input type="text" class="form-control formname" name="cust_father_name" id="cust_father_name" value="" placeholder="Custodian father name" maxlength="20" alt="please enter custodian father name" data-validation="" data-validation-error-msg="please enter valid custodian father name">
                                       </div>
                                    </div>
                                    <div class="col-md-3">
                                       <div class="form-group">
                                          <label class="mandatory mandatory_label">Address line 1 </label>
                                          <input class="form-control" name="cust_addr1" id="cust_addr1" value="" placeholder="Address line 1" alt="please enter address line1" type="text">
                                       </div>
                                    </div>
                                    <div class="col-md-3">
                                       <div class="form-group">
                                          <label class="mandatory mandatory_label">Address line 2 </label>
                                          <input class="form-control" name="cust_addr2" id="cust_addr2" value="" placeholder="Address line 2" alt="please enter address line2" type="text">
                                       </div>
                                    </div>
                                    <div class="col-md-3">
                                       <div class="form-group">
                                          <label class="mandatory">Address line3</label>
                                          <input class="form-control" name="cust_addr3" id="cust_addr3" value="" placeholder="Address line 3" alt="please enter address line3" type="text">
                                       </div>
                                    </div>
                                    <div class="col-md-3">
                                       <div class="form-group">
                                          <label class="mandatory mandatory_label">City / Village / Town </label>
                                          <input class="form-control" name="cust_city" id="cust_city" value="" placeholder="City/Village/Town" alt="please enter city / village / town" type="text">
                                       </div>
                                    </div>
                                    <div class="col-md-3">
                                       <div class="form-group">
                                          <label class="mandatory mandatory_label">State </label>
                                          <span id="span_state">
                                             <select name="cust_state" id="cust_state" class="input-select form-control">
                                                <option value="" selected="">Select State</option>
                                                <option value="35">Andaman and Nicobar Islands</option>
                                                <option value="25">Daman and Diu</option>
                                                <option value="28">Andhra Pradesh</option>
                                                <option value="12">Arunachal Pradesh</option>
                                                <option value="18">Assam</option>
                                                <option value="10">Bihar</option>
                                                <option value="4">Chandigarh</option>
                                                <option value="22">Chhattisgarh</option>
                                                <option value="26">Dadra and Nagar Haveli</option>
                                                <option value="7">Delhi</option>
                                                <option value="30">Goa</option>
                                                <option value="24">Gujarat</option>
                                                <option value="6">Haryana</option>
                                                <option value="2">Himachal Pradesh</option>
                                                <option value="1">Jammu and Kashmir</option>
                                                <option value="20">Jharkhand</option>
                                                <option value="29">Karnataka</option>
                                                <option value="32">Kerala</option>
                                                <option value="31">Lakshadweep</option>
                                                <option value="23">Madhya Pradesh</option>
                                                <option value="27">Maharashtra</option>
                                                <option value="14">Manipur</option>
                                                <option value="17">Meghalaya</option>
                                                <option value="15">Mizoram</option>
                                                <option value="13">Nagaland</option>
                                                <option value="21">Odisha</option>
                                                <option value="34">Puducherry</option>
                                                <option value="3">Punjab</option>
                                                <option value="8">Rajasthan</option>
                                                <option value="11">Sikkim</option>
                                                <option value="33">Tamil Nadu</option>
                                                <option value="36">Telangana</option>
                                                <option value="16">Tripura</option>
                                                <option value="5">Uttarakhand</option>
                                                <option value="9">Uttar Pradesh</option>
                                                <option value="19">West Bengal</option>
                                             </select>
                                          </span>
                                       </div>
                                    </div>
                                    <div class="col-md-3">
                                       <div class="form-group">
                                          <label class="mandatory mandatory_label">Pincode </label>
                                          <input class="form-control numeric" name="cust_zip" id="cust_zip" value="" placeholder="Pincode" alt="please enter pincode" type="text">
                                       </div>
                                    </div>
                                    <div class="col-md-3">
                                       <div class="form-group">
                                          <label class="mandatory mandatory_label">Country </label>
                                          <select name="cust_country" id="cust_country" class="input-select form-control">
                                             <option value="102" selected="">India</option>
                                          </select>
                                       </div>
                                    </div>
                                    <div class="col-md-3">
                                       <div class="form-group">
                                          <label class="mandatory mandatory_label">Age </label>
                                          <input type="number" id="cust_age" name="cust_age" class="form-control" value="" placeholder="Age" alt="age" min="18" max="100">
                                       </div>
                                    </div>
                                    <div class="col-md-3">
                                       <div class="form-group">
                                          <label class="mandatory mandatory_label">Religion </label>
                                          <select name="cust_religion" id="cust_religion" class="input-select form-control" data-validation="length" data-validation-length="1-20" data-validation-error-msg="please select a religion" onchange="javascript: toggle_other_religion(this.value, 'span_religion_other');">
                                             <option value="" selected="">Please Select</option>
                                             <option value="1">Buddhist</option>
                                             <option value="2">Christian</option>
                                             <option value="3">Hindu</option>
                                             <option value="4">Islam</option>
                                             <option value="5">Jain</option>
                                             <option value="6">Judaism</option>
                                             <option value="7">Parsi</option>
                                             <option value="8">Sikh</option>
                                             <option value="10">Other</option>
                                          </select>
                                       </div>
                                    </div>
                                    <div class="col-md-3">
                                       <div class="form-group">
                                          <label class="mandatory mandatory_label">Nationality </label>
                                          <select class="input-select form-control" id="cust_nationality" name="cust_nationality">
                                             <option value="" selected="">Please Select</option>
                                             <option value="Indian">Indian</option>
                                             <option value="Other">Other</option>
                                          </select>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="personalInfoScroll jumbotron p-1 mb-3 text-justify font-italic"><span style="color:#d33633;font-size:bigger">Note</span><br><b>* Custodian:</b> On the death of the person who wrote the will, custodian of a will is the person who has the possession of the will.
                                 And custodian will make sure to distribute the assets/liabilities as mentioned in the will among the beneficiaries.
                              </div>
                              <div class="card-footer text-center">
                                 <button class="btn btn-danger btn-sm save" data-role="update" data-id="" data-table="will_custodian" data-key="pk_custodian_id">Save</button>
                              </div>
                           </form>
                        </div>
                     </div>
                     <div class="tab-pane fade" id="witness" role="tabpanel" aria-labelledby="witness-tab-2">
                        <div class="">
                           <form action="<?= $CONFIG->siteurl; ?>./__lib.ajax/frmForm.php" name="frmWitness" id="frmWitness" method="post" class="frmCurrent" data-formType="0">
                              <div class="card-body">
                                 <h4 class="card-title">Witness 1</h4>
                                 <hr class="my-1">
                                 <div class="row">
                                    <div class="col-md-3">
                                       <div class="form-group">
                                          <label class="mandatory mandatory_label">Name</label>
                                          <input type="text" class="form-control" name="witness1_name" id="witness1_name" value="" placeholder="Name of witness" maxlength="99" alt="Please enter name">
                                       </div>
                                    </div>
                                    <div class="col-md-3">
                                       <div class="form-group">
                                          <label class="mandatory mandatory_label">Father Name</label>
                                          <input type="text" class="form-control" name="witness1_fathername" id="witness1_fathername" value="" placeholder="Father name of witness" maxlength="99" alt="Please enter father name">
                                       </div>
                                    </div>
                                    <div class="col-md-3">
                                       <div class="form-group">
                                          <label class="mandatory">Phone</label>
                                          <input type="number" class="form-control" name="witness1_phone" id="witness1_phone" value="" placeholder="Phone number" alt="Please enter Name of the Individual / Institution" pattern="[6789][0-9]{9}">
                                       </div>
                                    </div>
                                    <div class="col-md-3">
                                       <div class="form-group">
                                          <label class="mandatory mandatory_label">Address 1</label>
                                          <input type="text" class="form-control" name="witness1_addr_line1" id="witness1_addr_line1" value="" placeholder="Address Line 1" alt="Please enter Address Line1">
                                       </div>
                                    </div>
                                    <div class="col-md-3">
                                       <div class="form-group">
                                          <label class="mandatory mandatory_label">Address 2</label>
                                          <input type="text" class="form-control" name="witness1_addr_line2" id="witness1_addr_line2" value="" placeholder="Address Line 2" alt="Please enter Address Line2">
                                       </div>
                                    </div>
                                    <div class="col-md-3">
                                       <div class="form-group">
                                          <label class="mandatory">Address 3</label>
                                          <input type="text" class="form-control" name="witness1_addr_line3" id="witness1_addr_line3" value="" placeholder="Address Line 3" alt="Please enter Address Line3">
                                       </div>
                                    </div>
                                    <div class="col-md-3">
                                       <div class="form-group">
                                          <label class="mandatory mandatory_label">Pincode</label>
                                          <input type="text" class="form-control numeric" name="witness1_zipcode" id="witness1_zipcode" value="" placeholder="Pincode" maxlength="6" data-validation="" data-validation-length="1-6" data-validation-error-msg="Please enter Pincode" alt="Please enter Pincode">
                                       </div>
                                    </div>
                                    <div class="col-md-3">
                                       <div class="form-group">
                                          <label class="mandatory mandatory_label">City / Village</label>
                                          <input type="text" class="form-control" name="witness1_city" id="witness1_city" value="" placeholder="City/Town/Village" alt="Please enter City / Village / Town" data-validation="" data-validation-length="1-60" data-validation-error-msg="Please enter valid City / Village / Town">
                                       </div>
                                    </div>
                                    <div class="col-md-3">
                                       <div class="form-group">
                                          <label class="mandatory mandatory_label">State</label>
                                          <span id="span_state">
                                             <select name="witness1_state" id="witness1_state" class="input-select form-control">
                                                <option value="" selected="">Select State</option>
                                                <option value="35">Andaman and Nicobar Islands</option>
                                                <option value="25">Daman and Diu</option>
                                                <option value="28">Andhra Pradesh</option>
                                                <option value="12">Arunachal Pradesh</option>
                                                <option value="18">Assam</option>
                                                <option value="10">Bihar</option>
                                                <option value="4">Chandigarh</option>
                                                <option value="22">Chhattisgarh</option>
                                                <option value="26">Dadra and Nagar Haveli</option>
                                                <option value="7">Delhi</option>
                                                <option value="30">Goa</option>
                                                <option value="24">Gujarat</option>
                                                <option value="6">Haryana</option>
                                                <option value="2">Himachal Pradesh</option>
                                                <option value="1">Jammu and Kashmir</option>
                                                <option value="20">Jharkhand</option>
                                                <option value="29">Karnataka</option>
                                                <option value="32">Kerala</option>
                                                <option value="31">Lakshadweep</option>
                                                <option value="23">Madhya Pradesh</option>
                                                <option value="27">Maharashtra</option>
                                                <option value="14">Manipur</option>
                                                <option value="17">Meghalaya</option>
                                                <option value="15">Mizoram</option>
                                                <option value="13">Nagaland</option>
                                                <option value="21">Odisha</option>
                                                <option value="34">Puducherry</option>
                                                <option value="3">Punjab</option>
                                                <option value="8">Rajasthan</option>
                                                <option value="11">Sikkim</option>
                                                <option value="33">Tamil Nadu</option>
                                                <option value="36">Telangana</option>
                                                <option value="16">Tripura</option>
                                                <option value="5">Uttarakhand</option>
                                                <option value="9">Uttar Pradesh</option>
                                                <option value="19">West Bengal</option>
                                             </select>
                                          </span>
                                       </div>
                                    </div>
                                    <div class="col-md-3">
                                       <div class="form-group">
                                          <label class="mandatory mandatory_label">Country</label>
                                          <select name="witness1_country" id="witness1_country" class="input-select form-control" alt="Please select a Country" onchange="javascript: populate_states(this.value,'state ', 'span_state ', '0 ','toggle_other_state(\ 'state\',\ 'state_other\') '); toggle_other_state_country(this.value, 'state_other');">
                                             <option value="102" selected="selected">India</option>
                                          </select>
                                       </div>
                                    </div>
                                 </div>
                                 <h4 class="card-title">Witness 2</h4>
                                 <hr class="my-1">
                                 <div class="row">
                                    <div class="col-md-3">
                                       <div class="form-group">
                                          <label class="mandatory mandatory_label">Name</label>
                                          <input type="text" class="form-control" name="witness2_name" id="witness2_name" value="" placeholder="Name of Witness" maxlength="99" data-validation="length" data-validation-length="1-99" data-validation-error-msg="Please enter valid Name of the Individual / Institution" alt="Please enter Name of the Individual / Institution">
                                       </div>
                                    </div>
                                    <div class="col-md-3">
                                       <div class="form-group">
                                          <label class="mandatory mandatory_label">Father Name</label>
                                          <input type="text" class="form-control" name="witness2_fathername" id="witness2_fathername" value="" placeholder="Father name of witness" maxlength="99" title="Please enter father name" alt="Please enter father name">
                                       </div>
                                    </div>
                                    <div class="col-md-3">
                                       <div class="form-group">
                                          <label class="mandatory">Phone</label>
                                          <input type="number" class="form-control" name="witness2_phone" id="witness2_phone" value="" placeholder="Phone number" maxlength="99" data-validation="length" data-validation-length="1-99" data-validation-error-msg="Please enter valid Name of the Individual / Institution" alt="Please enter phone number" pattern="[6789][0-9]{9}">
                                       </div>
                                    </div>
                                    <div class="col-md-3">
                                       <div class="form-group">
                                          <label class="mandatory mandatory_label">Address 1</label>
                                          <input type="text" class="form-control" name="witness2_addr_line1" id="witness2_addr_line1" value="" placeholder="Address Line 1" maxlength="60" data-validation="" data-validation-length="1-60" data-validation-error-msg="Please enter valid Address Line1" alt="Please enter Address Line1">
                                       </div>
                                    </div>
                                    <div class="col-md-3">
                                       <div class="form-group">
                                          <label class="mandatory mandatory_label">Address 2</label>
                                          <input type="text" class="form-control" name="witness2_addr_line2" id="witness2_addr_line2" value="" placeholder="Address Line 2" maxlength="60" data-validation="" data-validation-length="1-60" data-validation-error-msg="Please enter valid Address Line2" alt="Please enter Address Line2">
                                       </div>
                                    </div>
                                    <div class="col-md-3">
                                       <div class="form-group">
                                          <label class="mandatory">Address 3</label>
                                          <input type="text" class="form-control" name="witness2_addr_line3" id="witness2_addr_line3" value="" placeholder="Address Line3" maxlength="60" alt="Please enter Address Line3">
                                       </div>
                                    </div>
                                    <div class="col-md-3">
                                       <div class="form-group">
                                          <label class="mandatory mandatory_label">Pincode</label>
                                          <input type="text" class="form-control numeric" name="witness2_zipcode" id="witness2_zipcode" value="" placeholder="Pincode" maxlength="6" data-validation="" data-validation-length="1-6" data-validation-error-msg="Please enter Pincode" alt="Please enter Pincode">
                                       </div>
                                    </div>
                                    <div class="col-md-3">
                                       <div class="form-group">
                                          <label class="mandatory mandatory_label">City / Village</label>
                                          <input type="text" class="form-control" name="witness2_city" id="witness2_city" value="" placeholder="City/Town/Village" maxlength="60" alt="Please enter City / Village / Town" data-validation="" data-validation-length="1-60" data-validation-error-msg="Please enter valid City / Village / Town">
                                       </div>
                                    </div>
                                    <div class="col-md-3">
                                       <div class="form-group">
                                          <label class="mandatory mandatory_label">State</label>
                                          <span id="span_state">
                                             <select name="witness2_state" id="witness2_state" class="input-select form-control">
                                                <option value="" selected="">Select State</option>
                                                <option value="35">Andaman and Nicobar Islands</option>
                                                <option value="25">Daman and Diu</option>
                                                <option value="28">Andhra Pradesh</option>
                                                <option value="12">Arunachal Pradesh</option>
                                                <option value="18">Assam</option>
                                                <option value="10">Bihar</option>
                                                <option value="4">Chandigarh</option>
                                                <option value="22">Chhattisgarh</option>
                                                <option value="26">Dadra and Nagar Haveli</option>
                                                <option value="7">Delhi</option>
                                                <option value="30">Goa</option>
                                                <option value="24">Gujarat</option>
                                                <option value="6">Haryana</option>
                                                <option value="2">Himachal Pradesh</option>
                                                <option value="1">Jammu and Kashmir</option>
                                                <option value="20">Jharkhand</option>
                                                <option value="29">Karnataka</option>
                                                <option value="32">Kerala</option>
                                                <option value="31">Lakshadweep</option>
                                                <option value="23">Madhya Pradesh</option>
                                                <option value="27">Maharashtra</option>
                                                <option value="14">Manipur</option>
                                                <option value="17">Meghalaya</option>
                                                <option value="15">Mizoram</option>
                                                <option value="13">Nagaland</option>
                                                <option value="21">Odisha</option>
                                                <option value="34">Puducherry</option>
                                                <option value="3">Punjab</option>
                                                <option value="8">Rajasthan</option>
                                                <option value="11">Sikkim</option>
                                                <option value="33">Tamil Nadu</option>
                                                <option value="36">Telangana</option>
                                                <option value="16">Tripura</option>
                                                <option value="5">Uttarakhand</option>
                                                <option value="9">Uttar Pradesh</option>
                                                <option value="19">West Bengal</option>
                                             </select>
                                          </span>
                                       </div>
                                    </div>
                                    <div class="col-md-3">
                                       <div class="form-group">
                                          <label class="mandatory mandatory_label">Country</label>
                                          <select name="witness2_country" id="witness2_country" class="input-select form-control" alt="Please select a Country" onchange="javascript: populate_states(this.value,'state ', 'span_state ', '0 ','toggle_other_state(\ 'state\',\ 'state_other\') '); toggle_other_state_country(this.value, 'state_other');">

                                             <option value="102" selected="">India</option>
                                          </select>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="personalInfoScroll jumbotron p-1 mb-3 text-justify font-italic"><span style="color:#d33633;font-size:bigger">Note</span><br><b>* Witness:</b> For making will legally enforceable, will is required to be signed in front of two witnesses who can be anyone, from family, friends, relatives, colleague, or anybody in whose presence will is executed and signed by the will writer.
                              </div>


                              <div class="card-footer text-center">
                                 <button class="btn btn-danger btn-sm save" style="color:white" data-role="update" data-id="" data-table="will_witness" data-key="pk_witness_id">Save</button>
                              </div>
                           </form>
                        </div>
                     </div>
                     <div class="tab-pane fade" id="preview" role="tabpanel" aria-labelledby="preview-tab-2">
                        <div class="">
                           <div class="card-body">
                              <div class="col-md-9 row mx-auto" id="div_preview">
                                 <script language="JavaScript">
                                    document.addEventListener("contextmenu", function(e) {
                                       e.preventDefault();
                                    }, false);
                                 </script>
                                 <div id="test" onmousedown="return false;" onselectstart="return false;">
                                    <style type="text/css" media="print">
                                       /** { display: none;  }*/
                                       @page {
                                          size: A4;
                                          margin: 20px;
                                       }

                                       @media print {
                                          table {
                                             max-height: 90% !important;
                                             overflow: hidden !important;
                                             page-break-after: always;
                                          }
                                       }
                                    </style>
                                    <div class="container p-0" align="justify" id="willCodeHTML">
                                       <table id="willPreviewHTML" class="myTableBg">
                                          <tbody>

                                          </tbody>
                                       </table>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="tab-pane fade <?php if ($activeTab == 1) {
                                                   echo "active show";
                                                } ?> " id="pay_download" role="tabpanel" aria-labelledby="pay-download-tab-2">
                        <div class="" id="div_pay_download">
                           <div class="page-content text-center">
                              <div class="row">
                                 <div class="col-md-12">
                                    <div class="widget-box transparent">
                                       <div class="widget-header widget-header-flat">
                                          <h4 class="widget-title orange">Payment of Will making</h4>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <br>
                              <div class="row">
                                 <div class="container">
                                    <div class="row">
                                       <div class="col-md-12">
                                          <p>Please click on the button below to pay the fee of the Will. <br> Please note that once the payment is done, a PDF copy of the Will will be generated. You may download the same and use it
                                             for all future references.
                                          </p>
                                          <p>Thank you for generating the Will on Optymoney.</p>
                                       </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                       <div class="col-md-12">
                                          <?php if ($activeTab == 0) { ?>
                                             <form method="post" action="?module_interface=cGF5L3dpbGxfcGF5bWVudGRldGFpbHM=">
                                                <button type="submit" class="btn btn-success">Pay Now </button>
                                             </form>
                                          <?php } else { ?>
                                             <form method="post" target="_blank" action="__willPages/create_pdf.php">
                                                <input type="hidden" id="pi_name" name="pi_name" value="">
                                                <input type="hidden" id="pi_place" name="pi_place" value="">
                                                <input type="hidden" id="pi_date" name="pi_date" value="">
                                             </form>
                                             <button type="button" id="downloadWillPDF" class="btn btn-success btndwn">Generate PDF</button>
                                          <?php } ?>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div id="beniBankModal" class="modal fade">
            <div class="modal-dialog modal-lg">
               <div class="modal-content">
                  <form name="benAssign" id="benAssign" class="frmCurrent has-validation-callback" method="POST" action="<?= $CONFIG->siteurl; ?>./__lib.ajax/frmForm.php" data-formType="1">
                     <div class="modal-header">
                        <h4 class="modal-title">Add Beneficiary</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                     </div>
                     <div class="modal-body">
                        <div class="row">
                           <div class="col-md-4">
                              <div class="form-group">
                                 <label class="mandatory mandatory_label">Beneficiary </label>
                                 <select name="fk_ben_id" id="fk_ben_id" class="input-select form-control" title="Please select a Beneficiary" alt="Please select a Beneficiary">
                                    <option value="">Please select</option>
                                 </select>
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="form-group">
                                 <label class="mandatory mandatory_label">Percentage Share to be allotted </label>
                                 <div class="input-group suffix">
                                    <input class="form-control numeric_share" name="txt_beneficiary_share" id="txt_beneficiary_share" placeholder="Enter Percentage" title="Add More Beneficiary" alt="Please enter Percentage Share to be allotted" value="" type="text">
                                    <span class="input-group-addon ">%</span>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="modal-footer">
                        <button class="boxed_btn4 save" id="btn_assign" data-role="update" data-id="" data-table="will_assign_beneficiary" data-key="pk_percent_id">Assign Beneficiary</button>
                        <input type="button" class="boxed_btn4" data-dismiss="modal" value="Cancel">
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<?php
//}
unset($_SESSION[$CONFIG->sessionPrefix . 'h_page']);
?>