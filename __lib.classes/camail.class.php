<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
class mdocmail{
		
	function mdocmail()
	{
		global $CONFIG,$commonFunction,$documentFiles,$customerProfile,$buySell;
		global $db;
		$this->db					= $db;
		$this->dbName				= $CONFIG->dbName;
		$this->commonFunction		= $commonFunction;
		$this->CONFIG				= $CONFIG;
		$this->documentFiles		= $documentFiles;
		$this->customerProfile		= $customerProfile;
		$this->mdocmail				= array();
	}
	function sendHTMLMails($TO,$FROM_EMAIL,$FROM_NAME,$SUBJECT,$HTML_TEXT,$PLAIN_TEXT,$SET_MAIL_FORMAT,$ATTACHEMENT='')	{
		
		//include_once '../__lib.apis/PHPMailer/PHPMailer/get_oauth_token.php';
		 /*echo "<br>To:".$TO."<br>";
		 echo "FROM_EMAIL:".$FROM_EMAIL."<br>";
		 echo "FROM_NAME:".$FROM_NAME."<br>";
		 echo "SUBJECT:".$SUBJECT."<br>";
		 echo "HTML_TEXT:".$HTML_TEXT."<br>";
		 echo "PLAIN_TEXT:".$PLAIN_TEXT."<br>";
		 echo "SET_MAIL_FORMAT:".$SET_MAIL_FORMAT."<br>";
		 echo "ATTACHEMENT:".$ATTACHEMENT."<br>";*/
		
		//date_default_timezone_set('Asia/Kolkata');
		include_once $this->CONFIG->wwwroot.'__lib.apis/vendor/autoload.php';
		//echo "INCLUDE:".$this->CONFIG->wwwroot.'__lib.apis/vendor/autoload.php';
		$mail = new PHPMailer(true);
		//$mail->SMTPDebug = SMTP::DEBUG_OFF(0);
	 	//$mail->SMTPDebug = 0;
	 	//echo "FROM_EMAIL:-".$FROM_EMAIL."<br>";
	 	//echo "TO:".$TO;
	 	if ($TO!= "") {
	 		$email = $TO;  
	 	}
	 	else {
	 		$email = "support@optymoney.com";
	 	}
	 	//echo "Email:-".$email;
	    $message1 = $HTML_TEXT;
	    $subject = $SUBJECT;
	    //echo "<br>HTML_TEXT:-".$HTML_TEXT;
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
		    $mail->setFrom($FROM_EMAIL, 'Optymoney');
		    $mail->addAddress($email);     // Add a recipient
//$mail->addCC('saikrishna@devmantra.com');
		    //$mail->addBCC('support@optymoney.com');
		    

		    // Content
		    $mail->isHTML(true);
		                                // Set email format to HTML
		    $mail->Subject = $subject;
		    $mail->Body    =  $message1;
		    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

		    $message = $mail->send();
		    return $message;
		    //print("<pre>".print_r($mail,true)."</pre>");
		     //$_SESSION['contact'] = "done";

		     //header("Location: https://test.optymoney.com/contact.html");
		   
			//$emailList ='support@optymoney.com';
			// $headers = array(
			//   'From: "Optymoney" <noreply@optymoney.com>' ,
			//   'Reply-To: "Optymoney" <noreply@optymoney.com>' ,
			//   'X-Mailer: PHP/' . phpversion() ,
			//   'MIME-Version: 1.0' ,
			//   'Content-type: text/html; charset=iso-8859-1' ,
			//   'BCC: ' . $emailList
			// );
			// $headers = implode( "\r\n" , $headers );

			//  $email_from='support@optymoney.com';
			//  $subject="Thanks for contact us";
			//  $message="Hello! 
			//  Thank you for contacting us! We will get back to you 
			//  as soon as possible! 
			//   ";

			//  mail($email, $subject, $message, $headers, '-f'.$email_from);

			    
			   // echo '</script>';
		} 
		catch (Exception $e) {
			echo "<script>alert('Mail was not sent. Please try again later');</script>";
		}
	}

	function bulkEmailSend($TO,$FROM_EMAIL,$FROM_NAME,$SUBJECT,$HTML_TEXT,$PLAIN_TEXT,$SET_MAIL_FORMAT,$ATTACHEMENT='')
	{
		
		//include_once '../__lib.apis/PHPMailer/PHPMailer/get_oauth_token.php';
		
		date_default_timezone_set('Asia/Kolkata');
		include_once '../__lib.apis/vendor/autoload.php';
		$mail = new PHPMailer(true);
		//$mail->SMTPDebug = SMTP::DEBUG_OFF(0);
	 	//$mail->SMTPDebug = 0;
	 	echo "FROM_EMAIL:-".$FROM_EMAIL."<br>";
	 	echo "TO:".$TO;
	 	if ($TO!= "") 
	 	{
	 		$email = $TO;  
	 	}
	 	else
	 	{
	 		$email = "support@optymoney.com";
	 	}
	    
	      
	    $message1 = $HTML_TEXT;
	    
	    $subject = $SUBJECT;
	    
	    echo "<br>HTML_TEXT:-".$HTML_TEXT;

		try {
		    //Server settings
		    //$mail->SMTPDebug = 2;                                       // Enable verbose debug output
		    $mail->isSMTP();                                            // Set mailer to use SMTP
		    $mail->Host       = 'stmp.gmail.com';  // Specify main and backup SMTP servers
		    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
		    $mail->Username   = 'support@optymoney.com';                     // SMTP username
		    $mail->Password   = 'support@123##';                               // SMTP password
		    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;                                // Enable TLS encryption, `ssl` also accepted
		    $mail->Port       = 465;                                    // TCP port to connect to

		    //Recipients
		    $mail->setFrom($FROM_EMAIL, 'Optymoney');
		    $mail->AddReplyTo($FROM_EMAIL, 'Optymoney');
		    $mail->addAddress($email);     // Add a recipient
		    //$mail->addCC('support@optymoney.com');
		    //$mail->addBCC('support@optymoney.com');
		    

		    // Content
		    $mail->isHTML(true);
		                                // Set email format to HTML
		    $mail->Subject = $subject;
		    $mail->Body    =  $message1;
		    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

		    $mail->send();
		    
		    //print("<pre>".print_r($mail,true)."</pre>");
		     //$_SESSION['contact'] = "done";

		     //header("Location: https://test.optymoney.com/contact.html");
		   
			//$emailList ='support@optymoney.com';
			// $headers = array(
			//   'From: "Optymoney" <noreply@optymoney.com>' ,
			//   'Reply-To: "Optymoney" <noreply@optymoney.com>' ,
			//   'X-Mailer: PHP/' . phpversion() ,
			//   'MIME-Version: 1.0' ,
			//   'Content-type: text/html; charset=iso-8859-1' ,
			//   'BCC: ' . $emailList
			// );
			// $headers = implode( "\r\n" , $headers );

			//  $email_from='support@optymoney.com';
			//  $subject="Thanks for contact us";
			//  $message="Hello! 
			//  Thank you for contacting us! We will get back to you 
			//  as soon as possible! 
			//   ";

			//  mail($email, $subject, $message, $headers, '-f'.$email_from);

			    
			   // echo '</script>';
		} 
		catch (Exception $e) 
		{
			echo "<script>alert('Mail was not sent. Please try again later');</script>";
		}
	}

	function sendMailToMembers($TO,$FROM,$SUBJECT,$PLAIN_TEXT,$HTML_TEXT,$ATTACHEMENT='',$CC='',$BCC='')
	{
		$notice_text = "This is a multi-part message in MIME format.";
		$plain_text = $PLAIN_TEXT;		//"This is a plain text email.\r\nIt is very cool.";
		$html_text = $HTML_TEXT;		//"<html><body>This is an <b style='color:purple'>HTML</b> text email.\r\nIt is very cool.</body></html>";

		$semi_rand = md5(time());
		$mime_boundary = "==MULTIPART_BOUNDARY_$semi_rand";
		$mime_boundary_header = chr(34) . $mime_boundary . chr(34);

		$to = $TO;							
											
		$from = $FROM;						
		$subject = $SUBJECT;				
		
		$body = "$notice_text

		--$mime_boundary
		Content-Type: text/plain; charset=us-ascii
		Content-Transfer-Encoding: 7bit

		$plain_text

		--$mime_boundary
		Content-Type: text/html; charset=us-ascii
		Content-Transfer-Encoding: 7bit

		$html_text

		--$mime_boundary--";

		if (@mail($to, $subject, $body,
			"From: " . $from . "\n" .
			//"bcc: " . $bcc . "\n" .
			"MIME-Version: 1.0\n" .
			"Content-Type: multipart/alternative;\n" .
			"     boundary=" . $mime_boundary_header))
			return 1;
		else
			return 0;	
	}
}
?>