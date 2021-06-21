<?php

	include("../__lib.includes/config.inc.php");
	if(!($_SESSION[$CONFIG->sessionPrefix.'loginstatus']) && !($_SESSION[$CONFIG->sessionPrefix.'adminLoginStatus'])) { header("HTTP/1.1 401 Unauthorized");header("Location: $CONFIG->siteurl");exit;}
	//print_r($_REQUEST);exit;
	if($_REQUEST['name'] == "email")
	{
		//$retVal = $db->db_run_query("UPDATE mdoc_users_details SET cust_name = '".$_REQUEST['value']."' WHERE fr_user_id = '".$CONFIG->loggedUserId."'");
	}
  else  if(isset($_POST['confirm_pass']))
    { 
    	$temp= $_POST['confirm_pass'];
       $retVal = $db->db_run_query("UPDATE bfsi_user SET passwd = '".md5($temp)."' WHERE pk_user_id  = '".$CONFIG->loggedUserId."'");
		$customerLog->activityLogCommon("Password has been updated");
     
    }






	else if($_REQUEST['name'] == "cust_name")
	{
		$retVal = $db->db_run_query("UPDATE bfsi_users_details SET cust_name = '".$_REQUEST['value']."' WHERE fr_user_id = '".$CONFIG->loggedUserId."'");
		$_SESSION[$CONFIG->sessionPrefix.'user_name'] = $_REQUEST['value'];
		$customerLog->activityLogCommon("Name updated");
	}
	else if($_REQUEST['name'] == "alternet_email_id")
	{
		$retVal = $db->db_run_query("UPDATE bfsi_user SET alternet_email_id = '".$_REQUEST['value']."' WHERE pk_user_id = '".$CONFIG->loggedUserId."'");
		$customerLog->activityLogCommon("Alternate Email id updated");
	}
   else if(isset($_POST['delete_id']))
   {
      
       $temp= $_POST['delete_id'];
        
       

       $retVal = $db->db_run_query("delete from bfsi_bank_details where pk_bank_detail_id='$temp' and fr_user_id='".$CONFIG->loggedUserId."'");
       $customerLog->activityLogCommon("Bank Account Delete");
   }


	// else if($_REQUEST['name'] == "change_pass")
	// {
	// 	$retVal = $db->db_run_query("UPDATE bfsi_user SET passwd = '".md5(trim($_REQUEST['value']))."' WHERE pk_user_id  = '".$CONFIG->loggedUserId."'");
	// 	$customerLog->activityLogCommon("Password has been updated");
	// }

    else if($_REQUEST['name'] == "fath_name")
	{
		$retVal = $db->db_run_query("UPDATE bfsi_users_details SET father_name = '".$_REQUEST['value']."' WHERE fr_user_id = '".$CONFIG->loggedUserId."'");
		$customerLog->activityLogCommon("Father name has been updated.");
	}
    /*-------------------------------------------*/






    else if($_REQUEST['name'] == "mother_name")
	{
		$retVal = $db->db_run_query("UPDATE bfsi_users_details SET mother_name = '".$_REQUEST['value']."' WHERE fr_user_id = '".$CONFIG->loggedUserId."'");
		$customerLog->activityLogCommon("Mother name has been updated.");
	}
    /*-----------------------------------------*/
	else if($_REQUEST['name'] == "sex")
	{
		$retVal = $db->db_run_query("UPDATE bfsi_users_details SET sex = '".$_REQUEST['value']."' WHERE fr_user_id = '".$CONFIG->loggedUserId."'");
		$customerLog->activityLogCommon("Gender has been updated");
	}
	else if($_REQUEST['name'] == "city")
	{
		$retVal = $db->db_run_query("UPDATE bfsi_users_details SET city = '".$_REQUEST['value']."' WHERE fr_user_id = '".$CONFIG->loggedUserId."'");
		$customerLog->activityLogCommon("City has been updated");
	}
	/*------------------------------------------------------------------------------------------------------------------------*/

	else if($_REQUEST['name'] == "city1")
	{
		$retVal = $db->db_run_query("UPDATE bfsi_users_details SET city = '".$_REQUEST['value']."' WHERE fr_user_id = '".$CONFIG->loggedUserId."'");
		$customerLog->activityLogCommon("City has been updated");
	}
	/*------------------------------------------------------------------------------------------------------------------------*/	
	else if($_REQUEST['name'] == "dob")
	{
		$retVal = $db->db_run_query("UPDATE bfsi_users_details SET dob = '".$_REQUEST['value']."' WHERE fr_user_id = '".$CONFIG->loggedUserId."'");
		echo $customerProfile->customerAge($_REQUEST['value']);
		exit;
	}
	else if($_REQUEST['name'] == "contact_no")
	{
		$retVal = $db->db_run_query("UPDATE bfsi_users_details SET contact_no = '".$_REQUEST['value']."' WHERE fr_user_id = '".$CONFIG->loggedUserId."'");
		$customerLog->activityLogCommon("Mobile Number has been updated");
	}
	else if($_REQUEST['name'] == "profession")
	{
		$retVal = $db->db_run_query("UPDATE bfsi_users_details SET profession = '".$_REQUEST['value']."' WHERE fr_user_id = '".$CONFIG->loggedUserId."'");
		$customerLog->activityLogCommon("Profession has been updated");
	}
    /*-----------------------------------------*/

    else if($_REQUEST['name'] == "occupation")
	{
		$retVal = $db->db_run_query("UPDATE bfsi_users_details SET occupation = '".$_REQUEST['value']."' WHERE fr_user_id = '".$CONFIG->loggedUserId."'");
		$customerLog->activityLogCommon("Occupation has been updated");
	}

     else if($_REQUEST['name'] == "nominee_name")
	{
		$retVal = $db->db_run_query("UPDATE bfsi_users_details SET nominee_name = '".$_REQUEST['value']."' WHERE fr_user_id = '".$CONFIG->loggedUserId."'");
		$customerLog->activityLogCommon("Nominee Name has been updated");
	}
    
     else if($_REQUEST['name'] == "nominee_dob")
	{
		$retVal = $db->db_run_query("UPDATE bfsi_users_details SET nominee_dob = '".$_REQUEST['value']."' WHERE fr_user_id = '".$CONFIG->loggedUserId."'");
		$customerLog->activityLogCommon("Nominee's DOB has been updated");
	}

     else if($_REQUEST['name'] == "r_of_nominee_w_app")
	{
		$retVal = $db->db_run_query("UPDATE bfsi_users_details SET r_of_nominee_w_app = '".$_REQUEST['value']."' WHERE fr_user_id = '".$CONFIG->loggedUserId."'");
		$customerLog->activityLogCommon("Relationship of Nominee with Applicant has been updated");
	}

    /*-----------------------------------------*/

	else if($_REQUEST['name'] == "address1")
	{
		$retVal = $db->db_run_query("UPDATE bfsi_users_details SET address1 = '".$_REQUEST['value']."' WHERE fr_user_id = '".$CONFIG->loggedUserId."'");
		$customerLog->activityLogCommon("Address has been updated");
	}
	else if($_REQUEST['name'] == "address2")
	{
		$retVal = $db->db_run_query("UPDATE bfsi_users_details SET address2 = '".$_REQUEST['value']."' WHERE fr_user_id = '".$CONFIG->loggedUserId."'");
	}
	else if($_REQUEST['name'] == "state")
	{
		$retVal = $db->db_run_query("UPDATE bfsi_users_details SET state = '".$_REQUEST['value']."' WHERE fr_user_id = '".$CONFIG->loggedUserId."'");
		$customerLog->activityLogCommon("State has been updated");
	}
	else if($_REQUEST['name'] == "pincode")
	{
		$retVal = $db->db_run_query("UPDATE bfsi_users_details SET pincode = '".$_REQUEST['value']."' WHERE fr_user_id = '".$CONFIG->loggedUserId."'");
		$customerLog->activityLogCommon("Zip Code has been updated");
	}
	else if($_REQUEST['name'] == "country")
	{
		$retVal = $db->db_run_query("UPDATE bfsi_users_details SET country = '".$_REQUEST['value']."' WHERE fr_user_id = '".$CONFIG->loggedUserId."'");
		$customerLog->activityLogCommon("Country has been updated");
	}
	else if($_REQUEST['name'] == "pan")
	{
		$retVal = $db->db_run_query("UPDATE bfsi_users_details SET pan_number = '".$_REQUEST['value']."' WHERE fr_user_id = '".$CONFIG->loggedUserId."'");
		$customerLog->activityLogCommon("PAN number has been updated");
	}
	else if($_REQUEST['name'] == "aadhar")
	{
		$retVal = $db->db_run_query("UPDATE bfsi_users_details SET aadhaar_no = '".$_REQUEST['value']."' WHERE fr_user_id = '".$CONFIG->loggedUserId."'");
		$customerLog->activityLogCommon("AADHAR Number has been updated");
	}
 

	else if($_REQUEST['name'] == "nationality")
	{
		$retVal = $db->db_run_query("UPDATE bfsi_users_details SET nationality = '".$_REQUEST['value']."' WHERE fr_user_id = '".$CONFIG->loggedUserId."'");
		$customerLog->activityLogCommon("Nationality has been updated");
	}
	else if($_REQUEST['name'] == "taxstatus")
	{
		$retVal = $db->db_run_query("UPDATE bfsi_users_details SET taxstatus = '".$_REQUEST['value']."' WHERE fr_user_id = '".$CONFIG->loggedUserId."'");
		$customerLog->activityLogCommon("Taxstatus has been updated");
	}
	else if($_REQUEST['name'] == "bank_name")
	{
		$commonFunction->addIfNotExist("bfsi_bank_details");
         
		$retVal = $db->db_run_query("UPDATE bfsi_bank_details SET bank_name = '".$_REQUEST['value']."' WHERE fr_user_id = '".$CONFIG->loggedUserId."' and  bank_name IS NULL " );
		$customerLog->activityLogCommon("Bank Name has been updated");
	}
	else if($_REQUEST['name'] == "acc_no")
	{
		$retVal = $db->db_run_query("UPDATE bfsi_bank_details SET acc_no = '".$_REQUEST['value']."' WHERE fr_user_id = '".$CONFIG->loggedUserId."' and  acc_no IS NULL");
		$customerLog->activityLogCommon("Bank Account Number has been updated");
	}
	else if($_REQUEST['name'] == "ifsc_code")
	{

		$retVal = $db->db_run_query("UPDATE bfsi_bank_details SET ifsc_code = '".$_REQUEST['value']."' WHERE fr_user_id = '".$CONFIG->loggedUserId."' and  ifsc_code IS NULL");
		$customerLog->activityLogCommon("IFSC Code has been updated");
        $bankInfos = $customerProfile->getCustomerBankInfo1();



		
	}
	else if($_REQUEST['name'] == "swift_code")
	{
		$retVal = $db->db_run_query("UPDATE bfsi_bank_details SET swift_code = '".$_REQUEST['value']."' WHERE fr_user_id = '".$CONFIG->loggedUserId."'");
		$customerLog->activityLogCommon("SWIFT Code has been updated");
	}
	else if($_REQUEST['name'] == "bank_address")
	{
		$retVal = $db->db_run_query("UPDATE bfsi_bank_details SET address1 = '".$_REQUEST['value']."' WHERE fr_user_id = '".$CONFIG->loggedUserId."'");
		$customerLog->activityLogCommon("Bank Address has been updated");
	}
	else if($_REQUEST['name'] == "bank_city")
	{
		$retVal = $db->db_run_query("UPDATE bfsi_bank_details SET city = '".$_REQUEST['value']."' WHERE fr_user_id = '".$CONFIG->loggedUserId."'");
		$customerLog->activityLogCommon("Bank City has been updated");
	}
	else if($_REQUEST['name'] == "bank_state")
	{
		$retVal = $db->db_run_query("UPDATE bfsi_bank_details SET state = '".$_REQUEST['value']."' WHERE fr_user_id = '".$CONFIG->loggedUserId."'");
		$customerLog->activityLogCommon("Bank State has been updated");
	}
	else if($_REQUEST['name'] == "bank_country")
	{
		$retVal = $db->db_run_query("UPDATE bfsi_bank_details SET country = '".$_REQUEST['value']."' WHERE fr_user_id = '".$CONFIG->loggedUserId."'");
		$customerLog->activityLogCommon("Bank Country has been updated");
	}	
	else if($_REQUEST['name'] == "communication_email")
	{
		$retVal = $db->db_run_query("UPDATE bfsi_user SET communication_email = '".$_REQUEST['value']."' WHERE pk_user_id = '".$CONFIG->loggedUserId."'");
	}
	else if($_REQUEST['name'] == "MF_IMPORT")
	{
		//print_r($_REQUEST);
		$RTAArr = explode("_@_",$_REQUEST['value']);
		//print_r($RTAArr);
		echo $totalInsertedID = $mutualFund->importRTAData($RTAArr[1],$RTAArr[0]);
		//echo $totalInsertedID;
		//$retVal = $db->db_run_query("UPDATE bfsi_user SET communication_email = '".$_REQUEST['value']."' WHERE pk_user_id = '".$CONFIG->loggedUserId."'");
	}
	else if($_REQUEST['name'] == "attache_pan")
	{
		//print_r($_REQUEST);
		echo $totalInsertedID = $mutualFund->sendMapRequest($_REQUEST[pan_no_attach]);
	}
?>