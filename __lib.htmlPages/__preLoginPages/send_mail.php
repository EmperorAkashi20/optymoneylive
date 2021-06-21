<?php
   public function send_mails($email_to,$subject,$message){
       
    $email_to = "magendiran@devmantra.com";
    $subject = "TEST";
    $message = "TESTING";
    // Import PHPMailer classes into the global namespace
    // These must be at the top of your script, not inside a function
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    date_default_timezone_set('Asia/Kolkata');
    // Load Composer's autoloader
    require 'vendor/autoload.php';

    // Instantiation and passing `true` enables exceptions
    $mail = new PHPMailer(true);
    //$mail->SMTPDebug = SMTP::DEBUG_OFF(0);
     //$mail->SMTPDebug = 0;


    try {
        //Server settings
       //$mail->SMTPDebug = 2;                                       // Enable verbose debug output
        $mail->isSMTP();                                            // Set mailer to use SMTP
        $mail->Host       = 'email-smtp.ap-south-1.amazonaws.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'AKIAWQE25SYKSUFPRUW2';                     // SMTP username
        $mail->Password   = 'BKzG602zpBiTf/IBH5zNTlE5Z900DF3CP5rb9RyLkwlN';                               // SMTP password
        $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
        $mail->Port       = 587;                                    // TCP port to connect to

        //Recipients
        $mail->setFrom('support@optymoney.com', 'Optymoney');
        $mail->addAddress($email_to, 'Optymoney');     // Add a recipient
        //$mail->addAddress('ellen@example.com');               // Name is optional
        $mail->addReplyTo($email_to, 'Optymoney');
        $mail->addCC('support@optymoney.com');
        $mail->addBCC('support@optymoney.com');

        // Attachments
        //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

        // Content
        $mail->isHTML(true);
                                    // Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    =  $message;
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        /*if($mail->send) 
        {*/
         /*$_SESSION['contact'] = "done";

         header("Location: https://test.optymoney.in/contact.html?res=success");*/
        /*}*/
        //echo "<script>alert('Mail was sent !');</script>";
        //echo '<script language="javascript">';
        //echo 'alert("message successfully sent")';

       
        
       // echo '</script>';
    } catch (Exception $e) {
        echo "<script>alert('Mail was not sent. Please try again later');</script>";
    }
         
}
?>