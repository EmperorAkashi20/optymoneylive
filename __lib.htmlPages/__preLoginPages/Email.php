<?php
$to = 'magendiran@devmantra.com';
$subject = 'Marriage Proposal';
$from = 'magendiran@devmantra.com';
 
  // $email = $_POST['formemail'];  
    $name = 'magendiran';
    $number = '8880437480';
    $message = 'Testmail';

// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Create email headers
$headers .= 'From: '.$from."\r\n".
  'Reply-To: '.$from."\r\n" .
  'Reply-To: '.$from."\r\n" .
  'X-Mailer: PHP/' . phpversion();

// Compose a simple HTML email message
$Ret_InvSipAmt1=$_POST['Ret_InvSipAmt1'];

$message = "To reach the goal SIP of Rs.$Ret_InvSipAmt1";

// Sending email
if(mail($to, $subject, $message, $headers)){
  echo 'Your mail has been sent successfully.';
} else{
  echo 'Unable to send email. Please try again.';
}
?>
