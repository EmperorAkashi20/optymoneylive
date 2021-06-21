<?php //include '../../__lib.includes/config.inc.php'; ?>
<?php
   /*$host_name = "localhost";
   $database = "taxnsave_sample"; // Change your database name
   $username = "dbuser";          // Your database user id 
   $password = "User@123";          // Your password
   */
   //error_reporting(0);// With this no error reporting will be there
   //////// Do not Edit below /////////
   
   /*$connection = mysqli_connect($host_name, $username, $password, $database);
   
   if (!$connection) {
       echo "Error: Unable to connect to MySQL.<br>";
       echo "<br>Debugging errno: " . mysqli_connect_errno();
       echo "<br>Debugging error: " . mysqli_connect_error();
       exit;
   }*/
   
   /*header('Access-Control-Allow-Origin: *');
       include '../../__lib.includes/config.inc.php';      //$pagename = $_GET[page] || $_GET[module_interface];
       $_SESSION['oPageAccess'] = 2;
       if (!($_SESSION[$CONFIG->sessionPrefix.'loginstatus'])) {
           header('HTTP/1.1 401 Unauthorized');
           header("Location: $CONFIG->siteurl");
           exit;
       }*/
       //print_r($_SESSION);
       $data = $commonFunction->get_single_data(); 
       //echo $data;
   
       if(isset($_REQUEST['submit'])){
   ?>
<script type="text/javascript">
   alert("We have recevied your documents.Our team will get in touch with you within 48 hours and your ITR will be filed. Thank you");
   //window.location.href='index.php';
</script>
<?php
   }
   
   ?>
<div class="main-content">
   <div class="main-content-inner">
      <!-- #section:basics/content.breadcrumbs -->
      <div class="breadcrumbs ace-save-state" id="breadcrumbs">
         <ul class="breadcrumb">
            <li>
               <i class="ace-icon fa fa-home home-icon"></i>
               <a href="<?php echo $CONFIG->siteurl;?>mySaveTax/">Home</a>
            </li>
            <li class="active">Upload Form 16</li>
         </ul>
         <!-- /.breadcrumb -->
         <!-- /section:basics/content.searchbox -->
      </div>
      <!-- /section:basics/content.breadcrumbs -->
      <div class="page-content">
                  
            <div class="row">
                         <form action="?module_interface=<?php echo $commonFunction->setPage('pay/bill_paymentdetails'); ?>" method="post" enctype="multipart/form-data" id="">

               <legend>
                  <center><img src="images/logo.png"></center>
               </legend>  
               <div class="col-xs-6 form-group">
                  <label>Name</label>
                  <input type="text" readonly class="form-control" value="<?php if($data){echo $data[cust_name]; }  ?>" id="usr" name="fname">
               </div>
               <div class="col-xs-6 form-group">
                  <label>Father Name</label>
                  <input type="text"   class="form-control"  id="usr" name="father_name">
               </div>

               <div class="col-xs-6 form-group">
                  <label>Mobile Number</label>
                  <input type="text" readonly  class="form-control" value="<?php if($data){echo $data[contact_no]; }  ?>" name="mobile" id="formnumber" data-error="Mobile number is required">
               </div>
               <div class="col-xs-6 form-group">
                  <label>Email</label>
                  <input type="text" class="form-control" readonly value="<?php if($data){echo $data[login_id]; }  ?>" id="usr" name="email"/>
               </div>
               <div class="col-xs-6 form-group">
                  <label>PAN*</label>
                  <input type="text" class="form-control" id="usr" name="pan" required="" pattern="[A-Z]{5}[0-9]{4}[A-Z]{1}$" />
               </div>
               <div class="col-xs-6 form-group">
                  <label>Aadhaar / Enrolment No</label>
                  <input type="text" class="form-control" id="usr" name="aadhaar">
               </div>
                
               <div class="col-xs-6 form-group">
                  <label>Amount</label>
                  <input type="text" class="form-control" id="usr" name="amount">
               </div>
               <div class="col-xs-6 form-group">
                  <label>Attachments</label>
                  <input type="file" name="file" class="form-control" id="usr">
               </div>
               <div class="col-xs-6 form-group">
                  <label>Address</label>
                  <textarea class="form-control" rows="4" name="address" id="address"></textarea>
               </div>
               <div class="col-xs-6 form-group">
                  <label>Description</label>
                  <textarea class="form-control" rows="4" name="description" id="comment"></textarea>
               </div>
            
               <div class="col-xs-6">
                  <div class="row">
                     <label class="col-xs-12">Bank details:</label>
                  </div>
                  <div class="row">
                     <div class="col-xs-12 col-sm-4">
                        <input class="form-control" placeholder="Name Of Bank" name="bank" type="text"/>
                     </div>
                     <div class="col-xs-12 col-sm-4">
                        <input class="form-control" placeholder="Account Number" name="acno" type="text"/>
                     </div>
                     <div class="col-xs-12 col-sm-4">
                        <input class="form-control" placeholder="IFSC Code" name="ifsc" type="text"/>
                     </div>
                  </div>
               </div>
               <div class="col-xs-6">
                  <div class="row">
                     <label class="col-xs-12">Incometax details:</label>
                  </div>
                  <div class="row">
                     <div class="col-xs-12 col-sm-6">
                        <input class="form-control" placeholder="UserID" name="tax_userid" type="text"/>
                     </div>
                     <div class="col-xs-12 col-sm-6">
                        <input class="form-control" placeholder="Password" name="tax_pwd" type="text"/>
                     </div>
                  </div>
               </div>
          
               <button for="usr" style="float:right" class="btn btn-primary alrs" type="submit" name="btn-upload">SUBMIT</button>
            </div>
         
         <input class="alr"type="hidden" name="submit">
         </form>        
      </div>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
      <!--   <div class="col-xs-12">                            
         <div style="width: 600px; margin: 0 auto;">
         <form action="upload.php" method="post" enctype="multipart/form-data" id="">
         <fieldset>
         <legend><center><img src="images/logo.png"></center></legend>
         <div class="form-group">
         <label class="control-label col-sm-4 fmname" for="usr">Name:</label>
         <div class="col-sm-8">
            <input type="text" class="form-control" value="<?php if($data){echo $data[cust_name]; }  ?>" id="usr" name="fname" >
         </div>
         </div>
         
         <!-- <div class="form-group">
         <label class="control-label col-sm-4 fmname" for="usr">Last Name:</label>
         <div class="col-sm-8">
            <input type="text" class="form-control" id="usr" name="lname" >
         </div>
         </div> -->
      <!--  <div class="form-group">
         <label class="control-label col-sm-4 fmname" for="usr">PAN:</label>
         <div class="col-sm-8">
             <input type="text" class="form-control" id="usr" name="pan" required="">
         </div>
         </div>
         
         <div class="form-group">
         <label class="control-label col-sm-4 fmname" for="usr">Aadhaar / Enrolment No:</label>
         <div class="col-sm-8">
             <input type="text" class="form-control" id="usr" name="aadhaar">
         </div>
         </div>
         
         
         <div class="form-group">
         <label class="control-label col-sm-4 fmname" for="usr">Email</label>
         <div class="col-sm-8">
             <input type="text" class="form-control" value="<?php if($data){echo $data[login_id]; }  ?>" id="usr" name="email" >
         </div>
         </div>
         
         <div class="form-group">
         <label class="control-label col-sm-4 fmname" for="usr">Mobile Number</label>
         <div class="col-sm-8">
         
             <input type="text" pattern="[6789][0-9]{9}" class="form-control" value="<?php if($data){echo $data[contact_no]; }  ?>" name="mobile" id="formnumber" data-error="Mobile number is required" >
         
         </div>
         </div>
         
         <div class="form-group">
         <label for="comment" class="col-sm-4 fmname">Description:</label>
         <div class="col-sm-8">
             <textarea class="form-control" rows="5" name="description" id="comment"></textarea>
         </div>
         </div>
         <div class="form-group">
         <label class="control-label col-sm-4 fmname" for="usr">Amount:</label>
         <div class="col-sm-8">
             <input type="text" class="form-control" id="usr" name="amount" >
         </div>
         </div>
         <div class="form-group">
         <label for="comment" class="col-sm-4 fmname">Attachments:</label>
         <div class="col-sm-8">
             <input type="file" name="file" class="form-control" id="usr" >
             
         
             <p>Please upload any of files ( <strong>PDF,XLS,DOCX,TXT,ZIP</strong> )</p>
             <p>Note: <i>If more than one document please zip the file  </i></p>
           
             <br>
             <button for="usr" class="btn btn-primary" type="submit" name="btn-upload">SUBMIT</button>
         </div>
         </div>
         
         
         
         <input type="hidden" name="submit">
         </fieldset>
         </form>
         </div> --> 
   </div>
   <!-- /.row -->
</div>
<!-- /.page-content -->
</div>
</div>
<link rel="stylesheet" href="style.css" type="text/css" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<?php
   if(isset($_GET['success']))
   {
    ?>
<!-- <label>File Uploaded Successfully... </label> -->
<?php
   }
   else if(isset($_GET['fail']))
   {
    ?>
<label>Problem While File Uploading !</label>
<?php
   }
   else
   {
    ?>
<?php
   }
   ?>
<style type="text/css"> 
   .col-sm-8 {
   margin-top: 10px;
   }
   body {
   background-image: url("images/bg1.jpg");
   background-repeat: no-repeat;
   }
   .fmname {
   text-align: left;
   margin-top: 18px;
   }
   .navbar.fixed-top + .page-body-wrapper {
   padding-top: 0px;
   }
   .alrs{
width:200px;
  display:inline-block;
  overflow: auto;
  white-space: nowrap;
  margin:30px auto;
  
   }
   .col-xs-6{
   padding-left:40px;
   padding-right:40px;
   }
</style>