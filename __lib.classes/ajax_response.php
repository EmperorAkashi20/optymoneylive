<?php

	include("../__lib.includes/config.inc.php");
	include("../__lib.includes/Sms.php");
    

	//if(!($_SESSION['oPageAccess'])) { header("HTTP/1.1 401 Unauthorized");header("Location: $CONFIG->siteurl");exit;}
	
	//echo "ACtion:-".$_REQUEST['action'];
	//echo $_SERVER['REQUEST_URI'];
    //$_SESSION['itr_status'] = 1;
    if($_REQUEST['itr_status']){
      $_SESSION['itr_status']= $_REQUEST['itr_status'];
    }

    /*-------------------------------------------settings ---------------------------------------------*/

    if($_REQUEST['action']== "settinginfo")
    {
    	$customerProfile->update_setting($_POST);
    	echo "string";
    	print_r($_POST);
    	//die();
    	//echo "update_info";

    }

    /*-----------------------------------------------------------------------------------------------*/

	if($_REQUEST['action'] == "panel")
	{
		//print_r($CONFIG);
		//$folder = $CONFIG->userFilesPath.$CONFIG->empanel;
		$targetFolder = $CONFIG->userFilesPath.$CONFIG->empanel; 
		//echo "<br>Folder:`-".$folder;

		$cv_name = $_FILES["cv"]["name"];
		$cv_path = $_FILES['cv']['tmp_name'];

		if($cv_name != "") 
		{
			// $new_file_name = rand(0,1000).trim(strtolower($cv_name));
			// $final_file=str_replace(' ','-',$new_file_name);
			// move_uploaded_file($cv_path,$folder.$final_file);
			//echo "<br>".$file_loc,$folder.$final_file."<br>";

			$tempFile = $_FILES['cv']['tmp_name'];
			$targetPath = $targetFolder;
			$file_name = time().str_replace(" ","_",$_FILES['cv']['name']);
			$targetFile = rtrim($targetPath,'/') . '/' .$file_name;
			//echo "<br>target File:-".$targetFile."<br>";
			move_uploaded_file($tempFile,$targetFile);
			if(file_exists($targetFile))
			{
				echo "<br>Stored<br>";
			}
			else
			{
				echo "<br>Not stored<br>";
			}

		}
		//echo "<br>CV Name:".$cv_name."<br>";
		//echo "<br>CV Path:".$cv_path;
		//echo "<br>CV Path:-".$folder.$cv_name."<br>";
		//print_r($_POST);

		if ($_POST['education'] == "other")  
		{
			$edu = $_POST['other_q'];		
		}
		else
		{
			$edu = $_POST['education'];
		}
		$sql = "INSERT INTO `em_panel` (name,email,mobile_no,city,gender,education,high_q_r,interest,training,about_yourself,cv) values 
                                ('".$_POST['name']."','".$_POST['email']."','".$_POST['mobile_no']."','".$_POST['city']."','".$_POST['gender']."','".$edu."','".$_POST['high_q_r']."','".$_POST['interest']."','".$_POST['training']."','".$_POST['about_yourself']."','".$file_name."')";
        $res = $db->db_run_query($sql);
        //echo "<br>SQL:-".$sql;
        if($res)
        {
            //$this->setPage($fill_itr)
            
            $url = $CONFIG->siteurl."resource/empanel.html";
            $_SESSION[$CONFIG->sessionPrefix.'empanel'] = 1;

            //$commonFunction->send_mail($_POST['email'],"Contact us mail from Optymoney",$message,true);

            $message = $commonFunction->readPHP("../__lib.mailFormats/empanel_mail.html");
			
			$f_name = explode(" ",$_POST['name']);

			$f_name = ucfirst(strtolower($f_name[0]));
			$message = str_replace("USERNAME",$f_name[0],$message);
			
			$commonFunction->send_mail($_POST['email'],"Getting started, from CEO desk <optymoney>",$message,true);
            header("Location:".$url);


        }
        else
        {
        	echo "OOOOOOOOOOOOOOOOOOOOOOOOOOOPS";
        }
	}
	/*------------------------------------- Filter Fetch schemes ------------------------------------------------*/

	if($_REQUEST['filter_search'])
	{
		//echo "HI";
		//print_r($_REQUEST);

		$amc_code      = $_REQUEST["amc_code"];
		$schm_type     = $_REQUEST["schm_type"];
		$sch_risk      = $_REQUEST["sch_risk"];
		$sch_fund_size = $_REQUEST["sch_fund_size"];

		// echo $amc_code;
		// print_r($amc_code);

		// echo $schm_type;
		// print_r($schm_type);

		// echo $sch_risk;
		// print_r($sch_risk);

		// echo $sch_fund_size;
		// print_r($sch_fund_size);
		$res = $mutualFund->fetch_all_schema($amc_code,$schm_type,$sch_risk,$sch_fund_size,$fetch_sch);

		//print_r($res);
		echo json_encode($res);
		//print_r($res);
		//$a = json_decode($_REQUEST['filter_search']);
		//print_r($a);
		//echo $_REQUEST;
	}
	/*--------------------------------  View more option ----------------------------------------------------------*/
    if($_REQUEST['view_more'] == 'yes')
    {	
    	//$offer = 0;
    	$limit = 30;
    	$res = $mutualFund->fetch_all_schema($amc_code,$schm_type,$sch_risk,$sch_fund_size,$fetch_sch,$offer,$limit);
    	echo json_encode($res);
    }

	/*--------------------------------  View more option ----------------------------------------------------------*/
	if($_REQUEST['offer_select'])
	{
		$offer_id = $_REQUEST['offer_id'];
		$res = $mutualFund->fetch_all_schema($amc_code,$schm_type,$sch_risk,$sch_fund_size,$fetch_sch,$offer_id);
		echo json_encode($res);
	}
	/*-----------------------------------------------------------------------------------------------------------*/
	/*-----------------------------------------------------------------------------------------------------------*/
	if($_REQUEST['get_nav_per'])
	{	
		$ISIN = $_POST['ISIN'];
		$year = $_POST['year'];
		
		if($year) {
			$get_c_str = strlen($year);
			$get_nav = $mutualFund->get_per_nav($ISIN,$year[0]);
			// echo "GET NAV:-".$get_nav;
			array_push($get_per_nav, $get_nav);
			$get_nav1 = $mutualFund->get_per_nav($ISIN,$year[1]);
			// echo "<br>GET PER NAV:-".$get_per_nav;
			array_push($get_per_nav, $get_nav1);
		}
		
		//$get_per_nav = $mutualFund->get_per_nav($ISIN,$year);
		echo json_encode($get_per_nav);
	}
	/*-----------------------------------------------------------------------------------------------------------*/


	if($_REQUEST['amc_search'])
	{
		$amc_val = $_REQUEST['amc_val'];
		$amc_val_res = $mutualFund->fetch_AMC_Code($amc_val);

		echo json_encode($amc_val_res);

	}
	/*---------------------------------------------------------------------------------------------------------*/
	if($_REQUEST['get_nav'])
	{
		$get_nav = $_POST['get_nav'];
		$ISIN = base64_decode($_POST['sch_code']);
		$res = $mutualFund->get_nav($ISIN);

		echo json_encode($res);

	}
    /*----------------------------------------------------------------------------------------*/

    if ($_REQUEST['action'] == "check_pan") 
    {
    	$pan = $_POST['pan'];
    	$assYear = $_POST['ay'].'-'.(1 + $_POST['ay']);
    	//echo "<br>PAN:".$pan;

    	$sql = "SELECT `itr_pan`,`itr_status` FROM `bfsi_itr` WHERE `itr_pan`='".$pan."' AND asses_year='".$assYear."'";
    	//echo "<br>SQL:-".$sql;
    	//die();
        $res = $db->db_run_query($sql);
         
        if($db->db_num_rows($res) > 0)
        {
            //$this->setPage($fill_itr);

            $_SESSION['pan_error'] = 1;
            $res =  "0";
            $_SESSION['pan_check_status'] = "PAN Number Already Exist";
            
            $url = $CONFIG->siteurl."mySaveTax/?module_interface=".$commonFunction->setPage('fill_itr');


        }
        else
        {
        	$_SESSION['pan_error'] = 0;
            $res =  "1";
            $_SESSION['pan'] = $pan;
           
            /*---------------------------------- Checking User Can not File more than 10 -------------------------------------------------*/

            $limit_sql = "SELECT * FROM `bfsi_itr` WHERE `fr_user_id`=".$CONFIG->loggedUserId;
            $limit_res = $db->db_run_query($limit_sql);
            //echo "string".$db->db_num_rows($limit_res);
            if($db->db_num_rows($limit_res) >= 10)
        	{
        		$_SESSION['pan_error'] = 1;
        		$_SESSION['pan_check_status'] = "You Have Exceeded Your Limit For Filing ITR Return";
        		$url = $CONFIG->siteurl."mySaveTax/?module_interface=".$commonFunction->setPage('fill_itr');

        	}
        	else
        	{
	        	//$REQUEST['pan'];//$_SESSION['user_pan_number'];//
	        	$itrFill->addEfilling($assYear);

	            //$url = $CONFIG->siteurl."mySaveTax/?module_interface=".$commonFunction->setPage('fill_itr');
	            $url = $CONFIG->siteurl."mySaveTax/?module_interface=".$commonFunction->setPage('itr_forms');
        	}
        
        }
        //	echo "<br>".$url;
         header("location:".$url);
       // return $res;
    }

	/*----------------------------------- 20190219-BSEN -------------------------------------*/
	if($_REQUEST['action'] == "doAdminLogin")
	{
		//print_r($_POST);
		if($_POST[username] == '' || $_POST[password] == '')
		{
			echo "Empty Fields Not Allowed";
			exit;
		}
		$result = $db->db_run_query("SELECT * FROM ".$CONFIG->dbName.".bfsi_admin_user WHERE login_id  = '".$_POST[username]."' 
						AND passwd = '".md5($_POST[password])."' AND user_status='Active'");
      
        /*
        
        $result = $db->db_run_query("SELECT * FROM ".$CONFIG->dbName.".bfsi_admin_user WHERE login_id  = '".$_POST[username]."' 
						AND passwd = '".md5($_POST[password])."' AND user_status='Active'");
        
        */
      
        
		$retVal = $db->db_num_rows($result);

		if($retVal > 0)
		{
			$customerDetails = $db->db_fetch_array($result);
			$_SESSION[$CONFIG->sessionPrefix.'adminLoginStatus']		= true;
			$_SESSION[$CONFIG->sessionPrefix.'a_user_id']				= $customerDetails['pk_admin_user_id'];
			$_SESSION[$CONFIG->sessionPrefix.'a_email_id']				= $customerDetails['login_id'];
			$_SESSION[$CONFIG->sessionPrefix.'a_user_name']				= $customerDetails['admin_name'];			

			$_SESSION[$CONFIG->sessionPrefix.'user_level']				= $customerDetails['user_level'];	
			
			$_SESSION[$CONFIG->sessionPrefix."user_id"]					= '';
			$_SESSION[$CONFIG->sessionPrefix."customer_id"]				= '';
			$_SESSION[$CONFIG->sessionPrefix.'email_id']				= '';	
			$_SESSION[$CONFIG->sessionPrefix.'user_name']				= '';	
										
			$customerLog->activityLogin($customerDetails['pk_admin_user_id'],'',$customerDetails['login_id'],$CONFIG->loggedIP,'ADMIN');
																	// print_r($_SESSION);exit;
			echo 'PASS';
			exit;
		}
		else
		{
			echo "LOGIN_FAILED";
			exit;
		}
	}
	else if($_REQUEST['action'] == "doLogin")
	{
		//print_r($_POST);
		if($_POST[email] == '' || $_POST[passwd] == '')
		{
			echo "Empty Fields Not Allowed";
			exit;
		}
		$result = $commonFunction->check_login($_POST[email],$_POST[passwd]);	//md5(sha1("09022011 - ").$_POST[txtPassword])
		$retVal = $db->db_num_rows($result);
		//echo "Value|".$retVal;
		if($retVal > 0)
		{
			$customerDetails = $db->db_fetch_array($result);
			
			/*------------------------ 20190218-BSEN ------------------------------------*/
			/*------------------------- Testing ----------------------------------------*/
			/*echo "Details:---------------------";
			print_r($customerDetails);
			echo "<br>";echo "<br>";*/
			
			/*------------------------ 20190218-BSEN ------------------------------------*/
			/*echo "Email-ID".$customerDetails['login_id'];;
			echo "<br>";*/
			$loggedin = $commonFunction->doLogin($customerDetails['pk_user_id']);
			/*--------------------------------- 20190218-BSEN ---------------------------*/
			if(!empty($_SESSION['cart_details']))
			{
				//print_r($_SESSION['cart_details']);
				$mutualFund->cart_query($_SESSION['cart_details'],1);
				unset($_SESSION['cart_details']);
				//echo '<script type="text/javascript">console.log("'.$_SESSION['cart_details'].'");</script>';	
				//die();
			}
			
			
			/*echo "loggedin:--------------------";
			print_r($loggedin);
			echo "<br>";
			*/
			/*----------------------------- 20190218-BSEN -------------------------------*/
			$customerLog->activityLogin($CONFIG->loggedUserId,$CONFIG->customerId,$CONFIG->loggedUserEmail,$CONFIG->loggedIP);
																	// print_r($_SESSION);exit;
			echo 'PASS';
			exit;
		}
		else
		{
			echo "LOGIN_FAILED";
			exit;
		}
	}
	else if($_REQUEST['action'] == "doSignup")
    {		
		
		/*----------------------------------- 20190218-BSEN -------------------------------------*/
		/*----------------- Comment the Captcha Code Checking-----------------------------------*/
		
		//print_r($_REQUEST);print_r($_SESSION);
		if($CONFIG->debug == "live"){
			if(md5(trim($_POST['sec_code'])) != $_SESSION['securimage_code_value'])
			{
				echo "WRONG_PASSCODE";
				exit;
			}
		}
		//echo "ajax_response.php";
		/*----------------------------------- 20190218-BSEN -------------------------------------*/
        if($_POST['otp'] != $_SESSION['otp'])
        {
            echo "WRONG_OTP";
            exit;
        }
		if($_POST[email] == '')
		{
			echo "Blank Email not allowed.";
			exit;
		}
        //$result = "111";
		$result = $commonFunction->is_email_exist($_POST[email]);				
		//echo "Rows " . $result;
        //echo "MAIN Result|".$result;
		/*----------------------------------- 20190218-BSEN -------------------------------------*/
        if($result > 0)
		{
			echo "REGISTER_FAILED";
            exit;
		}
		else
		{            
            //else verify otp and add user
			$getCustomerID = $customerProfile->newCustomer($_POST);
            //echo "sign up started 1";
			//echo "HI";
			/*----------------------------------- 20190218-BSEN -------------------------------------*/
			/*------------------------------------ Testing ---------------------------------------------*/
			$loggedin = $commonFunction->doLogin($getCustomerID);	
			if(!empty($_SESSION['cart_details']))
			{
				//print_r($_SESSION['cart_details']);
				$mutualFund->cart_query($_SESSION['cart_details'],1);
				unset($_SESSION['cart_details']);
				//echo '<script type="text/javascript">console.log("'.$_SESSION['cart_details'].'");</script>';	
				//die();
			}
            //echo "sign up started 2 " . $getCustomerID;
			
            if($getCustomerID != '')
			{				
				echo "REGISTER_DONE";
			}
			exit;
		}		
	}


	/*---------------------------------------------------------*/

	else if($_REQUEST['action'] == "externaldoSignup")
    {		
		
		/*----------------------------------- 20190218-BSEN -------------------------------------*/
		/*----------------- Comment the Captcha Code Checking-----------------------------------*/
		
		//print_r($_REQUEST);print_r($_SESSION);
		/*if($CONFIG->debug == "live"){
			if(md5(trim($_POST['sec_code'])) != $_SESSION['securimage_code_value'])
			{
				echo "WRONG_PASSCODE";
				exit;
			}
		}*/
		//echo "ajax_response.php";
		/*----------------------------------- 20190218-BSEN -------------------------------------*/
       /* if($_POST['otp'] != $_SESSION['otp'])
        {
            echo "WRONG_OTP";
            exit;
        }*/
		if($_POST[email] == '')
		{
			echo "Blank Email not allowed.";
			exit;
		}
        //$result = "111";
		$result = $commonFunction->is_email_exist($_POST[email]);				
		//echo "Rows " . $result;
        //echo "MAIN Result|".$result;
		/*----------------------------------- 20190218-BSEN -------------------------------------*/
        if($result > 0)
		{
			//echo "REGISTER_FAILED";
			//$status = base64_encode("REGISTER_FAILED");
			$_SESSION['status'] = "REGISTER_FAILED";
			header("location:".$CONFIG->siteurl."external_reg.html");
            exit;
		}
		else
		{            
            //else verify otp and add user
			$getCustomerID = $customerProfile->externalnewCustomer($_POST);
            //echo "sign up started 1";
			//echo "HI";
			/*----------------------------------- 20190218-BSEN -------------------------------------*/
			/*------------------------------------ Testing ---------------------------------------------*/
			//$loggedin = $commonFunction->doLogin($getCustomerID);	
            //echo "sign up started 2 " . $getCustomerID;
			
            if($getCustomerID != '')
			{				
				//echo "REGISTER_DONE";
			
			//$status = base64_encode("REGISTER_DONE");
			$_SESSION['status'] = "REGISTER_DONE";
			header("location:".$CONFIG->siteurl."external_reg.html");
			
			}
			exit;
		}		
	}
	else if($_REQUEST['action'] == "connect_us")
    {		
		
		if ($_POST['url']) 
		{
			$pcode = $_POST['url'];
			// echo "Pcode:-".$pcode;
			// echo "<br>";
			$url = explode('?',$pcode);
			// print_r($url);
			// echo "<br>";
			$fb_url = explode("&", $url[1]);
			// print_r($fb_url);
			// echo "<br>";
			$pcode = explode('=', $fb_url[0]);
			//print_r($pcode);
			$p_code = $pcode[1];
			$p_code = base64_decode($p_code);	
			//die();
		}
		if ($p_code == "") 
		{
			$_SESSION['status'] = "REGISTER_FAIL";
			//header("location:".$CONFIG->siteurl."connect_us.html");
		}
		else
		{



			$result = $commonFunction->is_email_exist($_POST[email]);				

	        if($result > 0)
			{

				$exist_user_event = $commonFunction->check_event_exist($result,$p_code);
				
				if ($exist_user_event) 
				{
					$_SESSION['status'] = "REGISTER_FAILED";
					//header("location:".$CONFIG->siteurl."connect_us.html");
					//exit;
				}
				else
				{
					$f_name = explode(" ",$_POST[name]);
					//print_r($f_name);
					$f_name = ucfirst(strtolower($f_name[0]));
					// if($p_code == "IRCH4_24.7.20")
					// {
						$message = $commonFunction->readPHP("../__lib.mailFormats/event_assessment.html");	
						$message = str_replace("USERNAME",$f_name,$message);
						$commonFunction->send_mail($_POST['email'],"Registration successful | Faceless Assessment",$message,true);
						$_SESSION['status'] = "REGISTRATION_SUCCESS";
					// }
					// else
					// {
					// 	$message = $commonFunction->readPHP("../__lib.mailFormats/taxpebaat.html");	
					// 	$message = str_replace("USERNAME",$f_name,$message);
					// 	$commonFunction->send_mail($_POST['email'],"REGISTRATION SUCCESSFUL | TAX PE BAAT | HOW PROFESSIONAL CAN SAVE OUTGO?  BY OPTYMONEY",$message,true);	
					// 	$_SESSION['status'] = "REGISTRATION_SUCCESS_1";
					// }
					
					//$message = $commonFunction->readPHP("../__lib.mailFormats/event_maill.html");
					$customerProfile->add_event($result,$p_code,$_POST['org']);
					//header("location:".$CONFIG->siteurl."connect_us.html");
	           		// exit;
				}
				

				//$_SESSION['status'] = "REGISTER_FAILED";
				
			}
			else
			{            
	            //else verify otp and add user
				$getCustomerID = $customerProfile->externalnewCustomer($_POST);
	            //echo "sign up started 1";
				//echo "HI";
				/*----------------------------------- 20190218-BSEN -------------------------------------*/
				/*------------------------------------ Testing ---------------------------------------------*/
				//$loggedin = $commonFunction->doLogin($getCustomerID);	
	            //echo "sign up started 2 " . $getCustomerID;
				
	            if($getCustomerID != '')
				{	
					// $message = $commonFunction->readPHP("../__lib.mailFormats/event_maill.html");
					// $f_name = explode(" ",$_POST[name]);
					// print_r($f_name);
					// $f_name = ucfirst(strtolower($f_name[0]));
					// $message = str_replace("USERNAME",$f_name,$message);

					//$commonFunction->send_mail($_POST['email'],"Optymoney webinar registration successful!",$message,true);		

					//echo "REGISTER_DONE";
					/*---------------------------------------------------------------------*/
					//$message = $commonFunction->readPHP("../__lib.mailFormats/taxpebaat.html");	
					
					//$f_name = explode(" ",$_POST[name]);
					//print_r($f_name);
					$f_name = ucfirst(strtolower($f_name[0]));
					//$message = str_replace("USERNAME",$f_name,$message);
					// echo "F_name:".$f_name;
					// die();

					// $commonFunction->send_mail($_POST['email'],"REGISTRATION SUCCESSFUL | TAX PE BAAT | HOW PROFESSIONAL CAN SAVE OUTGO?  BY OPTYMONEY",$message,true);	
					// /*--------------------------------------------------------------------*/	
					// //$status = base64_encode("REGISTER_DONE");
					// $_SESSION['status'] = "REGISTRATION_SUCCESS";
					// if($p_code == "IRCH4_24.7.20")
					// {
						$message = $commonFunction->readPHP("../__lib.mailFormats/event_assessment.html");
						//$message = $commonFunction->readPHP("../__lib.mailFormats/Faceless_assessment.html");	
						$message = str_replace("USERNAME",$f_name,$message);
						$commonFunction->send_mail($_POST['email'],"Registration successful | Faceless Assessment",$message,true);
						$_SESSION['status'] = "REGISTRATION_SUCCESS";
					// }
					// else
					// {
					// 	$message = $commonFunction->readPHP("../__lib.mailFormats/taxpebaat.html");	
					// 	$message = str_replace("USERNAME",$f_name,$message);
					// 	$commonFunction->send_mail($_POST['email'],"REGISTRATION SUCCESSFUL | TAX PE BAAT | HOW PROFESSIONAL CAN SAVE OUTGO?  BY OPTYMONEY",$message,true);	
					// 	$_SESSION['status'] = "REGISTRATION_SUCCESS_1";
					// }
					
				
				}
				
			}
		}	
		$u = substr($_POST['url'], 1);
		echo "U:".$u;
		header("location:".$CONFIG->siteurl.$u);	

		exit;
	}
	/*---------------------------------------------------------*/
    else if($_REQUEST['action'] == "doSendOTP")
    {
        $result = $commonFunction->is_email_exist($_POST[email]);
        if($result > 0)
        {
            echo "EMAIL_EXISTS";
            exit;
        }
        //send OTP here 
        $mobno = $_POST['mobile'];
    
        $otpnew = mt_rand(10000, 99999);
        //echo $otpnew;
        $_SESSION['otp'] = $otpnew; 
        //$_SESSION['otp'] = "12345"; 
        $otp_msg = "Your OTP to Register on OPTYMONEY is ".$otpnew." The OTP will be valid for next 15 mins";
        $url = "https://api-alerts.solutionsinfini.com/v4/?api_key=A97ac1e77641316f29e16438656e2cbb4&method=sms&message=".$otp_msg."&to=".$mobno."&sender=OPTMNY";

    
        $result = file_get_contents($url);
        if ($result === FALSE) { echo "OTP_FAILED. Please retry after some time."; }
        else {
            //echo $result;
            //echo return message
            echo "OTP_SENT";
        }
        exit;
    }
    else if($_REQUEST['action'] == "doPayment")
	{
        
        
    }
	else if($_REQUEST['action'] == "doResetPassword")
	{
		//print_r($_REQUEST);
		if(md5(trim($_POST['reset_sec_code'])) != $_SESSION['securimage_code_value'])
		{
			echo "WRONG_PASSCODE";
			exit;
		}	
		if($_POST[reset_email] == '')
		{
			echo "Blank Email not allowed.";
			exit;
		}
		$result = $commonFunction->is_email_exist($_POST[reset_email]);
		if($result > 0)
		{
			//print_r($result);
			$customerDetails = $commonFunction->getSingleRow("SELECT * FROM bfsi_user WHERE login_id = '".$_POST[reset_email]."'");
			$customerDetails1 = $commonFunction->getSingleRow("SELECT * FROM bfsi_users_details WHERE fr_user_id = '".$customerDetails[pk_user_id]."'");
			
			$message = $commonFunction->readPHP("../__lib.mailFormats/forget_password_mail.html");
			
			$message = str_replace("USERNAME",$customerDetails1['name'],$message);
			$message = str_replace("LINK",$CONFIG->siteurl,$message);
			$message = str_replace("ACTIVE_CODE_1","a=".$_POST['reset_email'],$message);
			$message = str_replace("ACTIVE_CODE_2","forget_password=".md5($_POST['reset_email']),$message);
			
			$db->db_run_query("INSERT INTO bfsi_verification SET email_id = '".$_POST['reset_email']."', fr_customer_id='".$customerDetails[pk_customer_id]."',auth_code='".md5($_POST['reset_email'])."',ip_address = '".$_SERVER['REMOTE_ADDR']."',verification_type='Forget', create_date=now()");
			
			$x = $commonFunction->send_mail($_POST['reset_email'],"Password reset mail from Optymoney",$message,true);
			//echo "OOPS".$x;
			echo "RESET_DONE";
            exit;
		}
		else
		{
			echo "RESET_PASSWORD_FAILED";
            exit;
		}		
	}
	else if($_REQUEST['action'] == "changePassword" && $_REQUEST['password'] != '' && $_REQUEST['user_id'] !='')
	{
		$db->db_run_query("UPDATE bfsi_user SET passwd = '".md5(trim($_REQUEST['password']))."' WHERE pk_user_id  = '".$_REQUEST[user_id]."'");
		echo "PASSWORD_CHANGED";
		exit;
	}
    else if($_REQUEST['action'] == "doChangePassword")
	{
        $email = trim($_POST['resetemail']);
        $code = $_POST['resetcode'];
        
        $customerDetails = $commonFunction->getSingleRow("SELECT auth_code FROM bfsi_verification WHERE email_id = '".$email."'");
        
       // echo "SELECT auth_code FROM bfsi_verification WHERE email_id = '".$email."'";
        //echo "ResetCode:-".$code;
        //echo "Email".md5($email);
        //var_dump($customerDetails);
        //if(($code !== md5($email)) || ($code!=$customerDetails['auth_code'])) {
        if($code !== md5($email)) {
            echo "CODE_MISMATCH";
            exit;
        }
        
		$db->db_run_query("UPDATE bfsi_user SET passwd = '".md5(trim($_POST['reset_passwd']))."' WHERE login_id = '".$email."'");
        $db->db_run_query("DELETE from bfsi_verification where email_id = '".$email."'");
		echo "PASSWORD_CHANGED";
		exit;
	}
    else if($_REQUEST['action'] == "contactus") {
        $message = "Mail from : " . $_POST['formname'] . "\nMail id : " . $_POST['formemail'] . "\n" . 
            "Mobile number : " . $_POST['formnumber'] . "\n\n" . 
            "Description : " . $_POST['formmessage'];
        
        // $g_value = $_POST['g_value'];
        // if ($g_value) 
        // {
            //$subject = "Client Enquiry in Optymoney";

        	$secretKey ="6Ld0L9UUAAAAAMeCcSyFktGxDiBGzA-6YDGLKm2B";
	  		$responseKey =$_POST["g-recaptcha-response"];
	  		$userIP = $_SERVER['REMOTE_ADDR'];
	  		$url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$responseKey&remoteip=$userIp";
	  		$response= file_get_contents($url);
        	//echo "response:-".$response;
        	$res = json_decode($response);
        	//print_r($res);
        	if ($res->success !="") 
        	{
 				$commonFunction->send_mail("support@optymoney.com","Contact us mail from Optymoney",$message,true);
 				//$commonFunction->send_mail("akash@optymoney.com","Contact us mail from Optymoney",$message,true);
 				echo "CONTACT_SENT";
        	}
        	else
        	{
        		echo "OOPS! NICE TRY";
        	}
        	//die();

       

        // echo "AJAX:".$message;
        // $x = $commonFunction->send_mail("support@optymoney.com","Contact us mail from Optymoney",$message,true);
        // echo $x."<br>";
        
        exit;
        
    }
    else if($_REQUEST['action'] == "eca") {
        $message = "Mail from : " . $_POST['formname'] . "\nMail id : " . $_POST['formemail'] . "\n" . 
            "Mobile number : " . $_POST['formnumber'];
        $commonFunction->send_mail("support@optymoney.com","ECA query from Optymoney",$message,true);
 		echo "CONTACT_SENT";
        exit;
        
    }
    else if($_REQUEST['action'] == "e_assist") {
        $message = "Mail from : " . $_POST['ea_name'] . "\nMail id : " . $_POST['ea_email'] . "\n" . 
            "Mobile number : " . $_POST['ea_mob'];
        $commonFunction->send_mail("support@optymoney.com","Expert Assistance Query from Optymoney",$message,true);
 		echo "CONTACT_SENT";
        exit;
        
    }
    else if($_REQUEST['action'] == "contactushome") {

        $message = "Mail from : " . $_POST['formname'] . "\nMail id : " . $_POST['formemail'] . "\n" . 
            "Mobile number : " . $_POST['formnumber'] . "\n\n" . 
            "Description : " . $_POST['formmessage'];
        
        
        	
 		$commonFunction->send_mail("support@optymoney.com","Contact us mail from Optymoney",$message,true);
 		$commonFunction->send_mail("akash@optymoney.com","Contact us mail from Optymoney",$message,true);
 		echo "CONTACT_SENT";
        	
        
        exit;
        
    }
?>