<?php

	include("../__lib.includes/config.inc.php");
	include("../__lib.includes/Sms.php");
    
	/* update will offer payment data */
	if ($_REQUEST['action'] == "proceed_to_download") {
		$json = file_get_contents('php://input');
		$data = json_decode($json);
		// print_r($data);
		echo json_encode($willProfile->updatePayment($data));
	}

	//if(!($_SESSION['oPageAccess'])) { header("HTTP/1.1 401 Unauthorized");header("Location: $CONFIG->siteurl");exit;}
	
	//echo "ACtion:-".$_REQUEST['action'];
	//echo $_SERVER['REQUEST_URI'];
    //$_SESSION['itr_status'] = 1;
    if($_REQUEST['itr_status']){
      $_SESSION['itr_status']= $_REQUEST['itr_status'];
    }

	/* Best Plans Offers List */
	if($_REQUEST['action']== "offerslist") {
    	echo json_encode($mutualFund->get_offer_list());
	}

	/* fetch AMC list */
	if($_REQUEST['action']== "amccodes") {
		$search = $_POST[amc_search];
    	echo json_encode($mutualFund->fetch_AMC_Code($search));
	}

	/* fetch AMC list */
	if($_REQUEST['action']== "schemetypelist") {
		$search = $_POST[st_search];
    	echo json_encode($mutualFund->fetch_Scheme_Type_api($search));
	}

	/* My Goal Page */
	if($_REQUEST['action']== "par_reg") {
		//print_r($_POST);
		//echo "File Name : ".$_FILES['par_myphoto']['name'];
    	echo json_encode($customerProfile->saveParticipantReg($_POST));
	}
	/* My Goal selfie upload Page */
	if($_REQUEST['action']== "upload_my_selfie") {
		//echo "File Name : ".$_FILES['par_myphoto']['name'];
		echo json_encode($customerProfile->saveMygoalSelfie($_POST));
	}

	/* Dashboard */
	if($_REQUEST['action']== "itrv") {
    	echo json_encode($itrFill->get_itrv_files($_POST[uid]));
	}
	if($_REQUEST['action']== "form16") {
    	echo json_encode($itrFill->get_form_16($_POST[uid]));
	}

    /*-------------------------------------------settings ---------------------------------------------*/

	if($_REQUEST['action']== "getCustomerOrders") {
    	echo json_encode($mutualFund->fetch_orders_api($_POST[uid]));
	}

    if($_REQUEST['action']== "getCustomerInfo") {
    	
    	//print_r($_POST);
    	//die();
    	echo json_encode($customerProfile->getCustomerInfo($_POST[uid]));
	}
	if($_REQUEST['action']== "settinginfo") {
    	
    	//print_r($_POST);
    	//die();
    	echo $customerProfile->update_setting($_POST);
	}

	if($_REQUEST['action']== "settinginfoapp") {
    	
    	//print_r($_POST);
    	//die();
    	echo $customerProfile->update_setting_app($_POST);
	}

	if($_REQUEST['action']== "fetchPortfolioApp") {
    	
    	//print_r($_POST);
    	//die();
    	echo $mutualFund->fetch_portfolio_app($_POST);
	}
	
	if($_REQUEST['action']== "settingBankinfo") {
    	$customerProfile->update_bank_setting($_POST);
    	//print_r($_POST);
    	//die();
    	echo "update_info";
    }

	if($_REQUEST['action']== "getBankDetails") {
    	echo $customerProfile->get_bank_details($_POST);
    }

	if($_REQUEST['action']== "getBankDetails_api") {
    	echo $customerProfile->get_bank_details_api($_POST);
    }

	if($_REQUEST['action']== "insertbank_api") {
    	echo $customerProfile->update_bank_setting_api($_POST);
    }

	if($_REQUEST['action']== "deletebank_api") {
		echo $customerProfile->delete_bank_setting_api($_POST);
    }

	if($_REQUEST['action']== "kyccheck_api") {
		$data = json_decode(file_get_contents('php://input'));
		echo $buySell->kyc_check($data->pan);
    }

	if($_REQUEST['action']== "insertbank") {
    	echo $customerProfile->update_bank_setting($_POST);
    }

	if($_REQUEST['action']== "deletebank") {
		echo $customerProfile->delete_bank_setting($_POST);
    }

	if ($_REQUEST['action'] == "couponcheck") {
		$json = file_get_contents('php://input');
		$data = json_decode($json);
		echo $customerProfile->couponcheck($data->cou_code);
	}
    /*-----------------------------------------------------------------------------------------------*/

	if($_REQUEST['action'] == "panel") {
		//print_r($CONFIG);
		//$folder = $CONFIG->userFilesPath.$CONFIG->empanel;
		$targetFolder = $CONFIG->userFilesPath.$CONFIG->empanel; 
		//echo "<br>Folder:`-".$folder;

		$cv_name = $_FILES["cv"]["name"];
		$cv_path = $_FILES['cv']['tmp_name'];

		if($cv_name != "") {
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
			if(file_exists($targetFile)) {
				echo "<br>Stored<br>";
			} else {
				echo "<br>Not stored<br>";
			}
		}
		//echo "<br>CV Name:".$cv_name."<br>";
		//echo "<br>CV Path:".$cv_path;
		//echo "<br>CV Path:-".$folder.$cv_name."<br>";
		//print_r($_POST);

		if ($_POST['education'] == "other") {
			$edu = $_POST['other_q'];		
		} else {
			$edu = $_POST['education'];
		}
		$sql = "INSERT INTO `em_panel` (name,email,mobile_no,city,gender,education,high_q_r,interest,training,about_yourself,cv) values 
                                ('".$_POST['name']."','".$_POST['email']."','".$_POST['mobile_no']."','".$_POST['city']."','".$_POST['gender']."','".$edu."','".$_POST['high_q_r']."','".$_POST['interest']."','".$_POST['training']."','".$_POST['about_yourself']."','".$file_name."')";
        $res = $db->db_run_query($sql);
        //echo "<br>SQL:-".$sql;
        if($res) {
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
        } else {
        	echo "OOOOOOOOOOOOOOOOOOOOOOOOOOOPS";
        }
	}
	/*------------------------------------- Filter Fetch schemes ------------------------------------------------*/

	if($_REQUEST['filter_search']) {
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
	if($_REQUEST['filter_offer_search']) {
		$amc_code      = $_REQUEST["amc_code"];
		$schm_type     = $_REQUEST["schm_type"];
		$sch_risk      = $_REQUEST["sch_risk"];
		$sch_fund_size = $_REQUEST["sch_fund_size"];
		$offer_id = $_REQUEST['offer_id'];
		$res = $mutualFund->fetch_all_schema($amc_code,$schm_type,$sch_risk,$sch_fund_size,$fetch_sch,$offer_id);
		$res_dup = $commonFunction->unique_multidimensional_array($res, "pk_nav_id");
		$result = $mutualFund->addNavData($res_dup);
		echo json_encode($result);
	}

	if($_REQUEST['filter_search_app']) {
		$amc_code      = $_REQUEST["amc_code"];
		$schm_type     = $_REQUEST["schm_type"];
		$sch_risk      = $_REQUEST["sch_risk"];
		$sch_fund_size = $_REQUEST["sch_fund_size"];
		$res = $mutualFund->fetch_all_schema_app($amc_code,$schm_type,$sch_risk,$sch_fund_size,$fetch_sch);
		$result = $mutualFund->addNavData($res);
		echo json_encode($result);
	}

	if($_REQUEST['filter_offer_search_app']) {
		$amc_code      = $_REQUEST["amc_code"];
		$schm_type     = $_REQUEST["schm_type"];
		$sch_risk      = $_REQUEST["sch_risk"];
		$sch_fund_size = $_REQUEST["sch_fund_size"];
		$offer_id = $_REQUEST['offer_id'];
		$res = $mutualFund->fetch_all_schema_app($amc_code,$schm_type,$sch_risk,$sch_fund_size,$fetch_sch,$offer_id);
		$result = $mutualFund->addNavData($res);
		echo json_encode($result);
	}
	if ($_REQUEST['action'] == "filter_offer_search_app_test1") {
		$json = file_get_contents('php://input');
		$data = json_decode($json);
		//print_r($data);
		//die();
		$amc_code = $data->amc_code;
		$schm_type = $data->schm_type;
		$sch_risk = $sch_risk;
		$sch_fund_size = $sch_fund_size;
		$offer_id = $offer_id;
		$res = $mutualFund->fetch_all_schema_app_test($amc_code,$schm_type,$sch_risk,$sch_fund_size,$fetch_sch,$offer_id);
		$res_dup = $commonFunction->unique_multidimensional_array($res, "pk_nav_id");
		$result = $mutualFund->addNavData($res_dup);
		echo json_encode($result);
	}

	if($_REQUEST['filter_offer_search_app_test']) {
		$amc_code      = $_REQUEST["amc_code"];
		$schm_type     = $_REQUEST["schm_type"];
		$sch_risk      = $_REQUEST["sch_risk"];
		$sch_fund_size = $_REQUEST["sch_fund_size"];
		$offer_id = $_REQUEST['offer_id'];
		$res = $mutualFund->fetch_all_schema_app_test($amc_code,$schm_type,$sch_risk,$sch_fund_size,$fetch_sch,$offer_id);
		$res_dup = $commonFunction->unique_multidimensional_array($res, "pk_nav_id");
		$result = $mutualFund->addNavData($res_dup);
		echo json_encode($result);
	}

	/*--------------------------------  View more option ----------------------------------------------------------*/
    if($_REQUEST['view_more'] == 'yes') {	
    	//$offer = 0;
    	$limit = 30;
    	$res = $mutualFund->fetch_all_schema($amc_code,$schm_type,$sch_risk,$sch_fund_size,$fetch_sch,$offer,$limit);
		$res_dup = $commonFunction->unique_multidimensional_array($res, "pk_nav_id");
		$result = $mutualFund->addNavData($res_dup);
		echo json_encode($result);
    	//echo json_encode($res);
    }
	/*--------------------------------  View more option ----------------------------------------------------------*/
	if($_REQUEST['offer_select']) {
		$offer_id = $_REQUEST['offer_id'];
		$res = $mutualFund->fetch_all_schema($amc_code,$schm_type,$sch_risk,$sch_fund_size,$fetch_sch,$offer_id);
		$res_dup = $commonFunction->unique_multidimensional_array($res, "pk_nav_id");
		$result = $mutualFund->addNavData($res_dup);
		echo json_encode($result);
	}
	/*-----------------------------------------------------------------------------------------------------------*/
	if($_REQUEST['get_nav_per']) {	
		$ISIN = $_POST['ISIN'];
		$get_per_nav = array();
		if(stripos($_POST['year'], '-')) {
			$year = explode("-",$_POST['year']);
			foreach ($year as $value) {
				$get_nav = $mutualFund->get_per_nav($ISIN,$value);
				$get_per_nav[$value] = $get_nav;
			}
		} else {
			$get_nav = $mutualFund->get_per_nav($ISIN,$_POST['year']);
			$get_per_nav[$_POST['year']] = $get_nav;
		}
		//$get_per_nav = $mutualFund->get_per_nav($ISIN,$year);
		echo json_encode($get_per_nav);
	}
	/*-----------------------------------------------------------------------------------------------------------*/
	if($_REQUEST['amc_search']) {
		$amc_val = $_REQUEST['amc_val'];
		$amc_val_res = $mutualFund->fetch_AMC_Code($amc_val);
		echo json_encode($amc_val_res);
	}
	/*----------------------------------------- Individual Scheme Chart Data based on ISIN ----------------------------------------------------------------*/
	if($_REQUEST['get_nav']) {
		$get_nav = $_POST['get_nav'];
		$ISIN = base64_decode($_POST['sch_code']);
		$res = $mutualFund->get_nav($ISIN);
		echo json_encode($res);
	}
	/*----------------------------------------- Individual Scheme Data based on id ----------------------------------------------------------------*/
	if($_REQUEST['get_scheme_data']) {
		$fetch_sch = $_POST['fetch_sch'];
		$ISIN = base64_decode($_POST['sch_code']);
		$res = $mutualFund->get_scheme_data($fetch_sch);
		echo json_encode($res);
	}
    /*----------------------------------------------------------------------------------------*/
    if ($_REQUEST['action'] == "check_pan") {
    	$pan = $_POST['pan'];
    	$assYear = $_POST['ay'].'-'.(1 + $_POST['ay']);
    	//echo "<br>PAN:".$pan;
    	$sql = "SELECT `itr_pan`,`itr_status` FROM `bfsi_itr` WHERE `itr_pan`='".$pan."' AND asses_year='".$assYear."'";
        $res = $db->db_run_query($sql);
        if($db->db_num_rows($res) > 0) {
            $_SESSION['pan_error'] = 1;
            $res =  "0";
            $_SESSION['pan_check_status'] = "PAN Number Already Exist";
            $url = $CONFIG->siteurl."mySaveTax/?module_interface=".$commonFunction->setPage('fill_itr');
        } else {
        	$_SESSION['pan_error'] = 0;
            $res =  "1";
            $_SESSION['pan'] = $pan;
            /*---------------------------------- Checking User Can not File more than 10 -------------------------------------------------*/
            $limit_sql = "SELECT * FROM `bfsi_itr` WHERE `fr_user_id`=".$CONFIG->loggedUserId;
            $limit_res = $db->db_run_query($limit_sql);
            //echo "string".$db->db_num_rows($limit_res);
            if($db->db_num_rows($limit_res) >= 10) {
        		$_SESSION['pan_error'] = 1;
        		$_SESSION['pan_check_status'] = "You Have Exceeded Your Limit For Filing ITR Return";
        		$url = $CONFIG->siteurl."mySaveTax/?module_interface=".$commonFunction->setPage('fill_itr');
        	} else {
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
	if($_REQUEST['action'] == "doAdminLogin") {
		//print_r($_POST);
		if($_POST[username] == '' || $_POST[password] == '') {
			echo "Empty Fields Not Allowed";
			exit;
		}
		$result = $db->db_run_query("SELECT * FROM ".$CONFIG->dbName.".bfsi_admin_user WHERE login_id  = '".$_POST[username]."' 
						AND passwd = '".md5($_POST[password])."' AND user_status='Active'");
		$retVal = $db->db_num_rows($result);
		if($retVal > 0) {
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
		} else {
			echo "LOGIN_FAILED";
			exit;
		}
	}
	if($_REQUEST['action'] == "doLogin") {
		//print_r($_POST);
		if($_POST[email] == '' || $_POST[passwd] == '') {
			echo "Empty Fields Not Allowed";
			exit;
		}
		$result = $commonFunction->check_login($_POST[email],$_POST[passwd]);	//md5(sha1("09022011 - ").$_POST[txtPassword])
		$retVal = $db->db_num_rows($result);
		echo "Value|".$retVal;
		if($retVal > 0) {
			$customerDetails = $db->db_fetch_array($result);
			$loggedin = $commonFunction->doLogin($customerDetails['pk_user_id']);
			if(!empty($_SESSION['cart_details'])) {
				$mutualFund->cart_query($_SESSION['cart_details'],1);
				unset($_SESSION['cart_details']);
			} else {
				echo "empty";
			}
			$customerLog->activityLogin($CONFIG->loggedUserId,$CONFIG->customerId,$CONFIG->loggedUserEmail,$CONFIG->loggedIP);
			echo 'PASS';
			exit;
		} else {
			echo "LOGIN_FAILED";
			exit;
		}
	} 
	if($_REQUEST['action'] == "doLoginApp") {
		//print_r($_POST);
		$data = json_decode(file_get_contents('php://input'));
		//print_r($data);
		// echo $buySell->kyc_check($data->pan);
		if($data->email == '' || $data->passwd == '') {
			$login_result->status = 0;
			$login_result->message = "Empty Fields Not Allowed";
			$login_result->token = "";
		}
		$result = $commonFunction->check_login($data->email,$data->passwd);	//md5(sha1("09022011 - ").$_POST[txtPassword])
		$retVal = $db->db_num_rows($result);
		if($retVal > 0) {
			$customerDetails = $db->db_fetch_array($result);
			$loggedin = $commonFunction->doLogin($customerDetails['pk_user_id']);
			$login_result->message = "LOGIN_SUCCESS";
			$login_result->token = json_encode($loggedin);
		}
		else {
			$login_result->status = $retVal;
			$login_result->message = "LOGIN_FAILED";
			$login_result->token = "";
		}
		echo json_encode($login_result);
	}
	if($_REQUEST['action'] == "doLoginAppWithPin") {
		//print_r($_POST);
		if($_POST[userid] == '' || $_POST[mpin] == '') {
			$login_result->status = 0;
			$login_result->message = "Empty Fields Not Allowed";
			$login_result->token = "";
		}
		$result = $commonFunction->check_login_with_pin($_POST[userid],$_POST[mpin]);	//md5(sha1("09022011 - ").$_POST[txtPassword])
		$retVal = $db->db_num_rows($result);
		if($retVal > 0) {
			$customerDetails = $db->db_fetch_array($result);
			$loggedin = $commonFunction->doLogin($customerDetails['pk_user_id']);
			$login_result->message = "LOGIN_SUCCESS";
			$login_result->token = json_encode($loggedin);
		}
		else {
			$login_result->status = $retVal;
			$login_result->message = "LOGIN_FAILED";
			$login_result->token = "";
		}
		echo json_encode($login_result);
	}
	if($_REQUEST['action'] == "checkMPINApp") {
		//print_r($_POST);
		if($_POST[uid] == '') {
			$checkpin_result->status = 0;
			$checkpin_result->message = "Empty Fields Not Allowed";
		}
		$result = $commonFunction->check_mpin_app($_POST[uid]);	//md5(sha1("09022011 - ").$_POST[txtPassword])
		$retVal = $db->db_num_rows($result);
		if($retVal > 0) {
			$customerDetails = $db->db_fetch_array($result);
			if($customerDetails['mpin']) {
				$checkpin_result->status = 1;
				$checkpin_result->message = "MPIN_SET";
			} else {
				$checkpin_result->status = 0;
				$checkpin_result->message = "MPIN_NOT_SET";
			}
		}
		else {
			$checkpin_result->status = $retVal;
			$checkpin_result->message = "USER_NOT_EXIST";
		}
		echo json_encode($checkpin_result);
	}
	if($_REQUEST['action'] == "doSignup") {		
		/*----------------- Comment the Captcha Code Checking-----------------------------------*/
		if($CONFIG->debug == "live"){
			if(md5(trim($_POST['sec_code'])) != $_SESSION['securimage_code_value'])	{
				echo "WRONG_PASSCODE";
				exit;
			}
		}
		/*----------------------------------- 20190218-BSEN -------------------------------------*/
        if($_POST['otp'] != $_SESSION['otp']) {
            echo "WRONG_OTP";
            exit;
        }
		if($_POST[email] == '') {
			echo "Blank Email not allowed.";
			exit;
		}
    	$result = $commonFunction->is_email_exist($_POST[email]);				
		/*----------------------------------- 20190218-BSEN -------------------------------------*/
        if($result > 0) {
			echo "EMAIL_EXISTS";
            exit;
		} else {             
            //else verify otp and add user
			$getCustomerID = $customerProfile->newCustomer($_POST);
    		/*----------------------------------- 20190218-BSEN -------------------------------------*/
			$loggedin = $commonFunction->doLogin($getCustomerID);	
			if(!empty($_SESSION['cart_details'])) {
				$mutualFund->cart_query($_SESSION['cart_details'],1);
				unset($_SESSION['cart_details']);
			}
            if($getCustomerID != '') {				
				echo "REGISTER_DONE";
			}
			exit;
		}		
	}
	if($_REQUEST['action'] == "doSignupFromApp") {	
		$verifyCode = $commonFunction->getSingleRow("SELECT * FROM bfsi_verification WHERE email_id = '".$_POST[email]."' and sent_otp='".$_POST[otp]."'");
		if($_POST[email] == '') {
			$signup_result->status = 0;
			$signup_result->message = "BLANK_EMAIL_NOT_ALLOWED";
			exit;
		}
		if($verifyCode) {
			//echo "Success";
		} else {
			$signup_result->status = 0;
			$signup_result->message = "WRONG_OTP";		
            exit;
		}
		//echo json_encode($verifyCode);
		$result = $commonFunction->is_email_exist($_POST[email]);				
		/*----------------------------------- 20190218-BSEN -------------------------------------*/
        if($result > 0) {
			$signup_result->status = 0;
			$signup_result->message = "EMAIL_EXISTS";		
            exit;
		} else {             
            //else verify otp and add user
			$getCustomerID = $customerProfile->newCustomer($_POST);
            //echo "sign up started 1";
			//echo "HI";
			/*----------------------------------- 20190218-BSEN -------------------------------------*/
			/*------------------------------------ Testing ---------------------------------------------*/
			$loggedin = $commonFunction->doLogin($getCustomerID);	
			if(!empty($_SESSION['cart_details'])) {
				//print_r($_SESSION['cart_details']);
				$mutualFund->cart_query($_SESSION['cart_details'],1);
				unset($_SESSION['cart_details']);
				//echo '<script type="text/javascript">console.log("'.$_SESSION['cart_details'].'");</script>';	
				//die();
			}
            //echo "sign up started 2 " . $getCustomerID;
            if($getCustomerID != '') {		
				$signup_result->status = $getCustomerID;
				$signup_result->message = "REGISTER_SUCCESS";		
				
			} else {
				$signup_result->status = 0;
				$signup_result->message = "REGISTER_FAILED";		
			}
		}
		echo json_encode($signup_result);
		exit;		
	}
	else if($_REQUEST['action'] == "savePin") {		
		$status = $customerProfile->savePin($_POST);
		echo $status;
        exit;
	}
	/*---------------------------------------------------------*/
	else if($_REQUEST['action'] == "externaldoSignup") {		
		/*----------------------------------- 20190218-BSEN -------------------------------------*/
		/*----------------- Comment the Captcha Code Checking-----------------------------------*/
		
		//print_r($_REQUEST);print_r($_SESSION);
		/* if($CONFIG->debug == "live"){
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
		if($_POST[email] == '') {
			echo "Blank Email not allowed.";
			exit;
		}
        //$result = "111";
		$result = $commonFunction->is_email_exist($_POST[email]);				
		//echo "Rows " . $result;
        //echo "MAIN Result|".$result;
		/*----------------------------------- 20190218-BSEN -------------------------------------*/
        if($result > 0)	{
			//echo "REGISTER_FAILED";
			//$status = base64_encode("REGISTER_FAILED");
			$_SESSION['status'] = "REGISTER_FAILED";
			header("location:".$CONFIG->siteurl."external_reg.html");
            exit;
		}
		else {            
            //else verify otp and add user
			$getCustomerID = $customerProfile->externalnewCustomer($_POST);
            //echo "sign up started 1";
			//echo "HI";
			/*----------------------------------- 20190218-BSEN -------------------------------------*/
			/*------------------------------------ Testing ---------------------------------------------*/
			//$loggedin = $commonFunction->doLogin($getCustomerID);	
            //echo "sign up started 2 " . $getCustomerID;
			
            if($getCustomerID != '') {				
				//echo "REGISTER_DONE";
				//$status = base64_encode("REGISTER_DONE");
				$_SESSION['status'] = "REGISTER_DONE";
				header("location:".$CONFIG->siteurl."external_reg.html");
			}
			exit;
		}		
	}
	else if($_REQUEST['action'] == "connect_us") {
		if ($_POST['url']) {
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
		if ($p_code == "") {
			$_SESSION['status'] = "REGISTER_FAIL";
			//header("location:".$CONFIG->siteurl."connect_us.html");
		}
		else {
			$result = $commonFunction->is_email_exist($_POST[email]);				
	        if($result > 0)	{
				//echo base64_encode($p_code);
				$exist_user_event = $commonFunction->check_event_exist($result,$p_code);
				//echo "<br>event123 : ".$exist_user_event;
				$event_detail = $commonFunction->getEventByPcode(base64_encode($p_code));
				//print_r($event_detail);
				//die();
				//echo "event name : ".$event_detail[event_name];
				if ($exist_user_event) {
					$_SESSION['status'] = "REGISTER_FAILED";
					//header("location:".$CONFIG->siteurl."connect_us.html");
					//exit;
				}
				else {
					$f_name = explode(" ",$_POST[name]);
					//print_r($f_name);
					
					$f_name = ucfirst(strtolower($f_name));
					// if($p_code == "IRCH4_24.7.20")
					// {
						$message = $commonFunction->readPHP("../__lib.mailFormats/event_assessment.html");	
						$message = str_replace("USERNAME",$_POST[name],$message);
						//$message = str_replace("EVENT",$event_detail[event_name],$message);
						//$message = str_replace("EDATE",$event_detail[event_date],$message);
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
			else {            
	            //else verify otp and add user
				$getCustomerID = $customerProfile->externalnewCustomer($_POST);
	            //echo "sign up started 1";
				//echo "HI";
				/*----------------------------------- 20190218-BSEN -------------------------------------*/
				/*------------------------------------ Testing ---------------------------------------------*/
				//$loggedin = $commonFunction->doLogin($getCustomerID);	
	            //echo "sign up started 2 " . $getCustomerID;
	            if($getCustomerID != '') {	
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
						$message = str_replace("USERNAME",$f_name,$message);
						$commonFunction->send_mail($_POST['email'],"Registration successful",$message,true);
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
    else if($_REQUEST['action'] == "doSendOTP") {
        $result = $commonFunction->is_email_exist($_POST[email]);
        if($result > 0) {
            echo "EMAIL_EXISTS";
            exit;
        }
        //send OTP here 
        $mobno = $_POST['mobile'];
    
        $otpnew = mt_rand(10000, 99999);
        //echo $otpnew;
        $_SESSION['otp'] = $otpnew; 
        //$_SESSION['otp'] = "12345"; 
        $otp_msg = 'Your OTP to Register on OPTYMONEY is "'.$otpnew.'" The OTP will be valid for next 15 mins';
		$url = "http://alerts.kaleyra.com/api/v4/?method=sms&api_key=A97ac1e77641316f29e16438656e2cbb4&message=".$otp_msg."&sender=DEVMAN&to=".$mobno."&entity_id=&template_id=1307160472687884955";
        //$url = "https://api-alerts.solutionsinfini.com/v4/?api_key=A97ac1e77641316f29e16438656e2cbb4&method=sms&message=".$otp_msg."&to=".$mobno."&sender=DEVOPT";
		echo "<br>URL : ".$url;
		$message = 'Your OTP to Register on OPTYMONEY is '.$otpnew.' The OTP will be valid for next 15 mins';
		$message = str_replace("USERNAME",$getPostedData['name'],$message);
		$message = str_replace("ACTIVE_CODE_1","a=".$_POST[email],$message);
		$message = str_replace("ACTIVE_CODE_2","verifyEmail=".md5($_POST[email]),$message);
		$db->db_run_query("INSERT INTO bfsi_verification SET sent_otp='".$otpnew."', email_id = '".$_POST[email]."', fr_customer_id='".$dbCustomerID."',auth_code='".md5($getPostedData['email'])."',ip_address = '".$_SERVER['REMOTE_ADDR']."',verification_type='Register', create_date=now()");
		$commonFunction->send_mail($_POST[email],"OTP to register with optymoney.com",$message,true);
		//echo "INSERT INTO bfsi_verification SET sent_otp='".$otpnew."', email_id = '".$_POST[email]."', fr_customer_id='".$dbCustomerID."',auth_code='".md5($getPostedData['email'])."',ip_address = '".$_SERVER['REMOTE_ADDR']."',verification_type='Register', create_date=now()";
		//echo $url;
        $result = file_get_contents($url);
        if ($result === FALSE) { echo "OTP_FAILED. Please retry after some time."; }
        else {
            echo $result;
            //echo return message
            echo "OTP_SENT to Mobile Number and Email Address";
        }
        exit;
    }
    else if($_REQUEST['action'] == "doPayment") {
        
    }
	else if($_REQUEST['action'] == "doResetPassword") {
		//print_r($_REQUEST);
		if(md5(trim($_POST['reset_sec_code'])) != $_SESSION['securimage_code_value']) {
			echo "WRONG_PASSCODE";
			exit;
		}	
		if($_POST[reset_email] == '') {
			echo "Blank Email not allowed.";
			exit;
		}
		$result = $commonFunction->is_email_exist($_POST[reset_email]);
		if($result > 0)	{
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
		else {
			echo "RESET_PASSWORD_FAILED";
            exit;
		}		
	}
	else if($_REQUEST['action'] == "doResetPasswordApp") {
		//print_r($_REQUEST);
		if($_POST[reset_email] == '') {
			$reset_pswd_result->status = 0;
			$reset_pswd_result->message = "Blank Email not allowed";
			$reset_pswd_result->resetcode = "";
		} else {
			$result = $commonFunction->is_email_exist($_POST[reset_email]);
			if($result > 0)	{
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
				$reset_pswd_result->status = 1;
				$reset_pswd_result->message = "RESET_EMAIL_SENT";
				$reset_pswd_result->resetcode = md5($_POST['reset_email']);
			}
			else {
				$reset_pswd_result->status = 0;
				$reset_pswd_result->message = "RESET_PASSWORD_FAILED";
				$reset_pswd_result->resetcode = "";
			}
		}
		echo json_encode($reset_pswd_result);
		exit;
	}
	else if($_REQUEST['action'] == "changePassword" && $_REQUEST['password'] != '' && $_REQUEST['user_id'] !='') {
		$db->db_run_query("UPDATE bfsi_user SET passwd = '".md5(trim($_REQUEST['password']))."' WHERE pk_user_id  = '".$_REQUEST[user_id]."'");
		echo "PASSWORD_CHANGED";
		exit;
	}
    else if($_REQUEST['action'] == "doChangePassword") {
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
	else if($_REQUEST['action'] == "doChangePasswordApp") {
		//print_r($_REQUEST);
		if($_POST[resetemail] == '') {
			$update_pswd_result->status = 0;
			$update_pswd_result->message = "Blank Email not allowed";
		} else {
			$email = trim($_POST['resetemail']);
			$code = $_POST['resetcode'];
			$customerDetails = $commonFunction->getSingleRow("SELECT auth_code FROM bfsi_verification WHERE email_id = '".$email."'");
			if($code !== md5($email)) {
				$update_pswd_result->status = 0;
				$update_pswd_result->message = "CODE_MISMATCH";
			} else {
				$res = $db->db_run_query("UPDATE bfsi_user SET passwd = '".md5(trim($_POST['reset_passwd']))."' WHERE login_id = '".$email."'");
				if($res==1) {
					$res1 = $db->db_run_query("DELETE from bfsi_verification where email_id = '".$email."'");
					$update_pswd_result->status = 1;
					$update_pswd_result->message = "PASSWORD_CHANGED";
				} else {
					$update_pswd_result->status = 0;
					$update_pswd_result->message = "PASSWORD_CHANGE_FAILED";
				}
			}
		}
		echo json_encode($update_pswd_result);
		exit;
	}
	else if($_REQUEST['action'] == "doChangeMpinApp") {
		//print_r($_REQUEST);
		if($_POST[mpin] == '') {
			$update_mpin_result->status = 0;
			$update_mpin_result->message = "Blank MPIN not allowed";
		} else {
			$mpin = trim($_POST['mpin']);
			$userid = $_POST['userid'];
			/*$customerDetails = $commonFunction->getSingleRow("SELECT auth_code FROM bfsi_verification WHERE email_id = '".$email."'");
			if($code !== md5($email)) {
				$update_pswd_result->status = 0;
				$update_pswd_result->message = "CODE_MISMATCH";
			} else {*/
				$res = $db->db_run_query("UPDATE bfsi_user SET mpin = '".$mpin."' WHERE pk_user_id = '".$userid."'");
				if($res==1) {
					$update_mpin_result->status = 1;
					$update_mpin_result->message = "MPIN_CHANGED";
					//$update_mpin_result->sql = "UPDATE bfsi_user SET mpin = '".$mpin."' WHERE pk_user_id = '".$userid."'";
				} else {
					$update_mpin_result->status = 0;
					$update_mpin_result->message = "MPIN_CHANGE_FAILED";
				}
			//}
		}
		echo json_encode($update_mpin_result);
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
        $res = $commonFunction->send_mail("support@optymoney.com","ECA query from Optymoney",$message,true);
 		echo $res;
        exit;
    }
    else if($_REQUEST['action'] == "e_assist") {
		$ea_expected = "Assistance required on ";
		if($_POST['investment']!="") {
			$ea_expected = $ea_expected."<br>Investment";
		}
		if($_POST['tax']!="") {
			$ea_expected = $ea_expected."<br>Tax";
			if($_POST['taxFile']!="") {
				$ea_expected = $ea_expected."<br>Tax Filing";
			}
			if($_POST['taxAssessment']!="") {
				$ea_expected = $ea_expected."<br>Tax Assessment";
			}
		}
		if($_POST['will']!="") {
			$ea_expected = $ea_expected."<br>Will";
		}
		$message = "Mail from : " . $_POST['ea_name'] . "\nMail id : " . $_POST['ea_email'] . "\n" . 
			"Mobile number : " . $_POST['ea_mob'] . "\nAssistance For : " . $ea_expected;
		$db->db_run_query("INSERT INTO expertassistance set ea_name='".$_POST['ea_name']."', ea_email='".$_POST['ea_email']."', ea_mobile='".$_POST['ea_num']."', ea_expected='".$ea_expected."', ea_date=now()");
		$commonFunction->send_mail("support@optymoney.com","Expert Assistance Query from Optymoney",$message,true);
		$message = "<p>Hello ".$_POST['ea_name']."..</p>
		<p>&nbsp;</p>
		<p>Welcome to optymoney!!</p>
		<p>Thanks for reaching out to us and it would be our pleasure to assist you. We have received your request for the Expert Assistance. You would be contacted by our team to understand your requirement in more details and schedule an appointment with our Subject Matter Expert.</p>
		<p>Hope to resolve your query in the shortest time frame.</p>
		<p>&nbsp;</p>
		<p>Thanks &amp; Regards</p>
		<p>Team <br><img src='https://optymoney.com/static/opty_theme/img/logo_3.png'></p>"; 
		$res = $commonFunction->send_mail_client($_POST['ea_name'],$_POST['ea_email'],"Optymoney Expert Assistance",$message,true);
		echo $res;
    }
    else if($_REQUEST['action'] == "contactushome") {
		if (filter_var($_POST['formemail'], FILTER_VALIDATE_EMAIL)) {
			$message = "Mail from : " . $_POST['formname'] . "\nMail id : " . $_POST['formemail'] . "\n" . 
			"Mobile number : " . $_POST['formnumber'] . "\n\n" . 
			"Description : " . $_POST['formmessage'];
			$db->db_run_query("INSERT INTO subscription set sub_name='".$_POST['formname']."', sub_email='".$_POST['formemail']."', sub_mobile='".$_POST['formnumber']."', sub_message='".$_POST['formmessage']."', sub_date=now()");
			//echo $message;
			$commonFunction->send_mail("support@optymoney.com","Optymoney Newsletter Subscription",$message,true);
			$message = "<p>Hello ".$_POST['formname'].";</p>
			<p>Greetings from optymoney.com, the one stop platform for all your personal finance needs.</p>
			<p>Thanks for reaching out to us and subscribing to our optymoney digest.</p>
			<p>It would give you a wrap-up of the weekly update on the market and a glance of the tax and other related updates impacting your personal finances.</p>
			<p>Donot reply to this mail as it is an auto generated email.</p>
			<p>Please feel free to write with your comments or suggestions to <a href='mailto:support@optymoney.com'>support@optymoney.com</a></p>
			<p>We are always eager to assist you.</p>
			<p>Happy Investing!!</p>
			<p>Team <br><img src='https://optymoney.com/static/opty_theme/img/logo_3.png'></p>"; 
			$res = $commonFunction->send_mail_client($_POST['formname'],$_POST['formemail'],"Optymoney Newsletter Subscription",$message,true);
			echo $res;
			exit;
		} else {
			echo "Please enter valid email address";
		}
	}
	else if($_REQUEST['action'] == "contactus") {
		if (filter_var($_POST['formemail'], FILTER_VALIDATE_EMAIL)) {
			$message = "Mail from : " . $_POST['formname'] . "\nMail id : " . $_POST['formemail'] . "\n" . 
				"Mobile number : " . $_POST['formnumber'] . "\n\n" . 
				"Description : " . $_POST['formmessage'];
			$db->db_run_query("INSERT INTO contact_info set con_name='".$_POST['formname']."', con_email='".$_POST['formemail']."', con_mobile='".$_POST['formnumber']."', con_msg='".$_POST['formmessage']."', con_date=now()");
			//echo $message;
			$commonFunction->send_mail("support@optymoney.com","Optymoney Contact Us",$message,true);
			$message = "<p>Hello ".$_POST['formname'].";</p>
			<p>Greetings from optymoney.com, the one stop platform for all your personal finance needs.</p>
			<p>Thanks for reaching out to us and subscribing to our optymoney digest.</p>
			<p>It would give you a wrap-up of the weekly update on the market and a glance of the tax and other related updates impacting your personal finances.</p>
			<p>Donot reply to this mail as it is an auto generated email.</p>
			<p>Please feel free to write with your comments or suggestions to <a href='mailto:support@optymoney.com'>support@optymoney.com</a></p>
			<p>We are always eager to assist you.</p>
			<p>Happy Investing!!</p>
			<p>Team <br><img src='https://optymoney.com/static/opty_theme/img/logo_3.png'></p>"; 
			$res = $commonFunction->send_mail_client($_POST['formname'],$_POST['formemail'],"Support at Optymoney",$message,true);
			echo $res;
			exit;
		} else {
			echo "Please enter valid email address";
		}
    }
?>
