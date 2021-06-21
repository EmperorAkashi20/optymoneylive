<?php
session_start();
$display = "none";
if ($_SESSION['status']) {
  $status = $_SESSION['status']; 
  if ($status == "REGISTER_DONE") {
    $output = "User Register Sucessfully";
    $display = "block";
  } elseif ($status == "REGISTER_FAILED") {
    $output = "User Already Registered";
    $display = "block";
  } else {
    $output = "";
    $display = "none";
  }
}
/*echo "Status:-".$status;
echo "output:-".$output;*/

?>
<!DOCTYPE html>
<html>
  <head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
      body { font-family: Arial, Helvetica, sans-serif; background-color: black; }
      * { box-sizing: border-box; }
      /* Add padding to containers */
      .container { padding: 16px; background-color: white; }
      /* Full-width input fields */
      input[type=text], input[type=password],input[type=email],input[type=tel] {
        width: 100%;
        padding: 15px;
        margin: 5px 0 22px 0;
        display: inline-block;
        border: none;
        background: #f1f1f1;
      }
      input[type=text]:focus, input[type=password],input[type=email]:focus { background-color: #ddd; outline: none; }
      /* Overwrite default styles of hr */
      hr { border: 1px solid #f1f1f1; margin-bottom: 25px; }
      /* Set a style for the submit button */
      .registerbtn { background-color: #4CAF50; color: white; padding: 16px 20px; margin: 8px 0; border: none; cursor: pointer; width: 100%; opacity: 0.9; }
      .registerbtn:hover { opacity: 1; }
      /* Add a blue text color to links */
      a { color: dodgerblue; }
      /* Set a grey background color and center the text of the "sign in" section */
      .signin { background-color: #f1f1f1; text-align: center; }
    </style>
  </head>
  <body>
    <form action="ajax-request/ajax_response.php?action=externaldoSignup&subaction=submit" method="post" name="signup_frm" id="signup_frm">
      <div class="container">
        <h1>Register</h1>
        <p>Please fill in this form to create an account.</p>
        <hr>
        <?php if ($output == "User Already Registered")  { ?>
          <div style="display: <?= $display; ?>" align="center" ><font color="red"><?= $output; ?></font></div>
        <?php unset($_SESSION['status']); } else { ?>
          <div style="display: <?= $display; ?>" align="center" ><font color="blue"><?= $output; ?></font></div>
        <?php unset($_SESSION['status']); } ?>
    <label for="email"><b>Email</b></label><br>
    <input type="email" name="email" placeholder="Enter Email"  required>
<br>
    <label for="name"><b>Name</b></label>
    <input type="text" name="name" placeholder="Enter Name"  required>

    <label for="mobile"><b>Phone Number</b></label>
    <input type="tel" name="mobile" placeholder="Enter Phone Number"  required>
    <label for="pan"><b>PAN Number</b></label>
    <input type="text" name="pan" placeholder="Enter Pan Number"   
    pattern="[A-Za-z]{3}[pP]{1}[A-Za-z]{1}[0-9]{4}[A-Za-z]{1}">
    <label for="psw"><b>Ucc code</b></label>
    <input type="text" name="bse" placeholder="Enter BSE Id">
   <b> Please select Nach Update:</b></p>

<!--   <div class="radio">
  <label class="radio" ><input  type="radio" id="Nach1" name="nach" value="1" class="nach">Yes</label> 
  </div>
  <div class="radio">
   <label><input type="radio" id="Nach1" name="nach" value="0" class="nach" checked>No</label> 
 </div> -->
 <table border="0">

<tr>
  <td><input  type="radio" id="Nach1" name="nach" value="1" class="nach"></td>
  <td>Yes</td>

</tr>
<tr>
  <td><input type="radio" id="Nach1" name="nach" value="0" class="nach" checked></td>
  <td>No</td>

</tr>
</table>
  <br>

  <div class="mandatediv"> 
  <label for="mandate"><b>Mandate ID</b></label><br>
  <div id="clone">
    <input type="text" name="mandate[]" placeholder="Enter Mandate id" id="Mandate">
    <button type="button" class="add btn btn-primary" id="addmore">Add more Mandate id+</button>
  </div> 
  </div>
 <!--  <div class="mandatediv1"> 
  <label for="mandate"><b>Mandate ID</b></label><br>
  <div id="clone">
    <input type="text" name="mandate[]" placeholder="Enter Mandate id">
  </div> 
  </div> -->
    <hr>
    <button type="submit" class="registerbtn">Register</button>


  </div>
</form>


<script type="text/javascript">

 
 
function signupJSnew(form) {       
    //var re = "[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?";

    if(!(looksLikeMail($("#email").val()))) {
      //alert("test");
       $("#signup_invalid_email").html('Please enter valid email address.');
            $("#signup_invalid_email").css("display", "block");
            return false;
    }    
      if(!(/^[0-9\-]+$/.test($("#mobile").val())))
      {
          $("#signup_invalid_email").html('Please enter valid mobile no.');
          $("#signup_invalid_email").css("display", "block");
          return false;
      }
      if($("#mobile").val().length != 10)
      {
          $("#signup_invalid_email").html('Please enter valid mobile no.');
          $("#signup_invalid_email").css("display", "block");
          return false;
      }
      /*if($("#reg_passwd").val().length < 6)
      {
          $("#signup_invalid_email").html('Password must be 6 character long.');
          $("#signup_invalid_email").css("display", "block");
          return false;
      }   
      if($("#reg_passwd").val() != $("#repasswd").val())
      {
          $("#signup_invalid_email").html('Password Mismatch.');
          $("#signup_invalid_email").css("display", "block");
          return false;
      }*/
              /*if($("#otp").val().length != 5) 
              {
                  $("#signup_invalid_email").html('Please enter OTP.');
                  $("#signup_invalid_email").css("display", "block");
                  return false;
              }*/
      $("#signup_invalid_email").html('');    
      $("#signup_loader").css("display", "block");  
      $("#signup_invalid_email").css("display", "none");
      //alert("inside js");
      $.ajax({
          cache:false,
          url: form.action,
          type: form.method,
          data: $(form).serialize(),
          success: function(response) {
            console.log(response);
        
             /* if(response.indexOf("WRONG_PASSCODE")>=0)
              {
                  $("#verifyCaptcha").attr('src', "captcha/securimage_show.php?"+$.now());
                  $("#signup_loader").css("display", "none");
                  $("#signup_invalid_email").html('Invalid security code.');
                  $("#signup_invalid_email").css("display", "block");
                  $("#email").focus();
              }
              else if(response.indexOf("WRONG_OTP")>=0)
              {
                  $("#signup_invalid_email").html('Invalid OTP.');
                  $("#signup_invalid_email").css("display", "block");
                  $("#otp").focus();
              }*/
              if(response.indexOf("REGISTER_DONE")>=0) {                 
                  //alert("inside_register");
                  location.href='<?php echo $CONFIG->siteurl;?>mySaveTax/';       
              }
           /*   else
              {
                  $("#verifyCaptcha").attr('src', "captcha/securimage_show.php?"+$.now());
                  $("#signup_loader").css("display", "none");
                  $("#signup_invalid_email").html('Email Already Exists.');    
                  $("#signup_invalid_email").css("display", "block");
                  $("#email").focus();
                  //html('Email Already Exists.');
              }*/
          }            
      });
      return false;
  }
  </script>
   <script type="text/javascript">
 $(document).ready(function()
   {
    // alert('hi');
        $('.mandatediv').hide();
        $('.mandatediv1').hide();

        $(".nach").click(function()
        {
          var value=$(this).val();
          // alert(value);
          if(value==0)
          {
            $('.mandatediv').hide();
            $('.mandatediv1').hide();
          }
          else
          {
          $('.mandatediv').show();
          // $('.mandatediv1').show();
          }
        });
    }); 
</script>
<script type="text/javascript">
   var limit = 1;
  $('.add').click(function()
  {
    // alert('add');
   if(limit<5)  
    {

    $(".mandatediv").append(' <input type="text" name="mandate[]" placeholder="Enter more Mandate id" id="Mandate">'); 
    // alert('hi');
    //$('#mandatediv').clone(True);
     limit++;
  }
  });
</script>

</body>

</html>
 