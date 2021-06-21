<?php
$data = $commonFunction->get_single_data();

if (isset($_REQUEST['submit']))
{
?>
    <script type="text/javascript">
       alert("We have recevied your documents.Our team will get in touch with you within 48 hours and your ITR will be filed. Thank you");
       //window.location.href='index.php';
    </script>
<?php
}
?>
   <!-- ============================================================== -->
   <!-- Start right Content here -->
   <!-- ============================================================== -->
   <div class="container" style="background-color: #fff;">
   <div class="page-content">
      <div class="p-5 bg-white rounded shadow mb-5">
         <div class="form">
            <form action="?module_interface=<?php echo $commonFunction->setPage('pay/bill_paymentdetails'); ?>" method="post" enctype="multipart/form-data" id=""  >
               <div class="form-content">
                  <div class="row">
                     <div class="col-md-12">
                        <input type="radio" name="itr_e" value="itr">
                        <label for="ITR"> ITR Filing</label><br>
                        <input type="radio" name="itr_e" value="eassess">
                        <label for="Assess"> E-Assessment</label><br>
                     </div>
                     <hr>
                     <div class="col-md-6">
                        <div class="form-group ">
                           <label>Name</label>
                           <input type="text" readonly="" class="form-control" value="<?php if ($data){ echo $data[cust_name];} ?>" id="usr" name="fname">
                        </div>
                        <div class="form-group ">
                           <label>Mobile Number</label>
                           <input type="text" readonly="" class="form-control" value="<?php if ($data){ echo $data[contact_no];} ?>" name="mobile" id="formnumber" data-error="Mobile number is required">
                        </div>
                        <div class="form-group ">
                           <label>PAN*</label>
                           <input type="text" class="form-control" id="usr" name="pan" required="required" pattern="[A-Z]{5}[0-9]{4}[A-Z]{1}$" value="<?php if ($data){ echo $data[pan_number];} ?>">
                        </div>
                        <div class="form-group ">
                           <label>Date of Birth</label>
                           <input class="form-control" placeholder="Enter your your date of birth" id="dobofusr" required="required" name="dobofusr" type="date" value="<?php if ($data){ echo $data[dob];} ?>">
                        </div>
                        <div class="form-group">
                           <label>Address</label>
                           <textarea class="form-control" rows="4" name="address" id="address"><?php if ($data){ echo $data[address1]." ".$data[address2]." ".$data[address3]." ".$data[city]." ".$data[state];} ?></textarea>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group ">
                           <label>Father Name*</label>
                           <input type="text" class="form-control" required="required" pattern="[a-zA-Z\s]+" id="usr" name="father_name" value="<?php if ($data){ echo $data[father_name];} ?>">
                        </div>
                        <div class="form-group ">
                           <label>Email</label>
                           <input type="text" class="form-control" readonly="" value="<?php if ($data){ echo $data[login_id];} ?>" id="usr" name="email">
                        </div>
                        <div class="form-group ">
                           <label>Aadhaar / Enrolment No*</label>
                           <input type="text" class="form-control" required="required" id="usr" name="aadhaar" value="<?php if ($data){ echo $data[aadhaar_no];} ?>">
                        </div>
                        <div class="form-group">
                           <label>Description</label>
                           <textarea class="form-control" rows="4" name="description" id="comment"></textarea>
                        </div>
                        <div id="itrfilling" style="display: none;">
                           <div class="form-group">
                              <label>Attachments Upload Form 16/16A</label>
                              <input type="file" name="fileitr[]" multiple="multiple" class="form-control" id="usr">
                           </div>
                           <div class="form-group">
                              <label>Any Other Attachments</label>
                              <input type="file" name="addfileitr[]" multiple="multiple" class="form-control" id="usr">
                           </div>
                        </div>
                        <div id="eassest" style="display: none;">
                           <div class="form-group">
                              <label>Upload Notice Copy</label>
                              <input type="file" name="noticeCopy" class="form-control" id="usr">
                           </div>
                           <div class="form-group">
                              <label>Last ITR Filed Copy</label>
                              <input type="file" name="itrfiledcopy" class="form-control" id="usr">
                           </div>
                           <div class="form-group">
                              <label>Any Other Attachments</label>
                              <input type="file" name="addeassest[]" multiple="multiple" class="form-control" id="usr">
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-6">
                        <div class="row">
                           <label class="col-12">Bank details*:</label>
                        </div>
                        <div class="row">
                           <div class="col-md-4">                  
                              <input class="form-control formname" placeholder="Name Of Bank" required="required" name="bank" type="text">
                           </div>
                           <div class="col-md-4">                    
                              <input class="form-control" placeholder="Account Number" pattern="[0-9]{8,17}" name="acno" type="text">
                           </div>
                           <div class="col-md-4">                    
                              <input class="form-control" placeholder="IFSC Code" pattern="([^\s][A-z0-9À-ž\s]+)" name="ifsc" type="text">
                           </div>
                        </div>
                     </div>
                     <!--<div class="col-6">
                        <div class="row">
                           <label class="col-12">Incometax details:</label>
                        </div>
                        <div class="row">
                           <div class="col-md-6">
                              <input class="form-control" placeholder="UserID" name="tax_userid" type="text">
                           </div>
                           <div class="col-md-6">
                              <input class="form-control" placeholder="Password" name="tax_pwd" type="text">
                           </div>
                        </div>
                     </div>-->
                  </div>
                  <div class="c_acnt_section">
                  <div class="row">
                  	<p> Is your Total deposits in Current Accounts in all Banks exceeds Rs. 1 crore? </p>
                  	<input type="radio" class="c_acnt_c" name="c_acnt_c" value="1" id="c_acnt_y">Yes
                  	<input type="radio" class="c_acnt_c" name="c_acnt_c" value="0" id="c_acnt_n">No
                     <input type="text" name="c_acnt" id="c_acnt">
                  </div>
                  <div class="row">
                  	<p> Foreign Travel expenses for self or other person in family exceeds Rs. 2 Lakhs? </p>
                  	<input type="radio" class="f_travel_c" name="f_travel_c" value="1" id="f_travel_y">Yes
                  	<input type="radio" class="f_travel_c" name="f_travel_c" value="0" id="f_travel_n">No
                     <input type="text" name="f_travel_val" id="f_travel">
                  </div>
                  <div class="row">
                  	<p> Electricity charges exceed Rs. 1 Lakh? </p>
                  	<input type="radio" class="e_bill_c" name="e_bill_c" value="1" id="e_bill_y">Yes
                  	<input type="radio" class="e_bill_c" name="e_bill_c" value="0" id="e_bill_n">No
                     <input type="text" name="e_bill" id="e_bill">
                  </div>
               </div>
               </div>
               
               <button for="usr" style="float:right" class="btn btn-primary alrs" type="submit" name="btn-upload">SUBMIT</button>
            </form>
         </div>
      </div>
   </div>
