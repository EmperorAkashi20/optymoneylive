<?php
class customerProfile{

	function customerProfile() {
		global $CONFIG,$commonFunction,$permissionSettings;
		global $db;
		$this->db = $db;
		$this->dbName	 = $CONFIG->dbName;	
		$this->commonFunction = $commonFunction;
		$this->permissionSettings = $permissionSettings;
		$this->CONFIG = $CONFIG;
		$this->customerProfile = array();
	}

	// Check Coupon code
	function couponcheck($data) {
		$result1 = $this->db->db_run_query("select * from coupon_list where cou_code='" . $data . "'");
		$r1 = $this->db->db_fetch_array($result1);
		if($r1['cou_quantity']>0) {
			$count = $r1['cou_quantity']-1;
			$result1 = $this->db->db_run_query("update coupon_list set cou_quantity='".$count."' where cou_code='" . $data . "'");
			$val['msg'] = "Coupon applied Successfully";
			$val['status'] = 1;
			$val['percent'] = $r1['cou_per'];
			$val['qty'] = $r1['cou_quantity'];
		} else {
			$val['msg'] = "Not valid coupon";
			$val['status'] = 0;
			// $val['sql'] = "select * from coupon_list where cou_code='" . $data . "'";
		}
		return json_encode($val);
	}

	// My Goal Event Reg 
	function saveParticipantReg($post){
		//print_r($post);
		
		$par_name =$post['par_name'];
		$par_email =$post['par_email'];
		$par_mob =$post['par_mob'];
		$par_cam_code =$post['par_cam_code'];

		$temp = 0;
		$result = $this->commonFunction->is_email_exist($par_email);
		//echo "email exist : ".$result;
        if($result > 0) {
			$customerID = $result;
		} else {             
			$SQL 		= "INSERT INTO bfsi_user SET
							login_id = '".$par_email."',
							passwd = '".md5('456789')."',
							communication_email = 'Permanent',	
							user_status = 'Active',										
							signup_ip = '".$_SERVER['REMOTE_ADDR']."'";				
			$custRes	= $this->db->db_run_query($SQL);
			$customerID =  $this->db->db_insert_id();
			$SQL1 		= "INSERT INTO bfsi_users_details SET
						fr_user_id = '".$customerID."',
						cust_name = '".$par_name."',
						contact_no = '".$par_mob."',
						detail_created_date = now()";
			$custRes	= $this->db->db_run_query($SQL1);
		}
		//echo "user : ".$customerID."---".$par_cam_code;
		//exit;
		$result = $this->commonFunction->is_mygoal_email_exist($customerID, $par_cam_code);
		//echo "goal : ".$result;
		//exit;
		if($result>0) {
			$val[msg] = "Participant Already Registered";
			$val[status] = 0;
		} else {
			//echo "<br>folder path : ".$customerID;
			$folder = $this->CONFIG->wwwroot . $this->CONFIG->userFilesURL . $this->CONFIG->mycampaign;
			$tmpFilePath = $_FILES['par_myphoto']['tmp_name'];
			if (!is_dir($folder.$customerID)) {
				mkdir($folder.$customerID, 0777, true);
				//echo "<br>folder exist</br>";
			} 
			if ($tmpFilePath != ""){
				$newFilePath = $folder.$customerID."/".$customerID."_".$par_cam_code."_".$_FILES['par_myphoto']['name'];
				//$newFilePath = $folder.$_FILES['par_myphoto']['name'];
                //echo "<br>file path : ".$newFilePath;
				//echo "<br>temp file path : ".$tmpFilePath;
				if(move_uploaded_file($tmpFilePath, $newFilePath)) {
					$val[msg] = "Participant Registered Successfully";
					$val[status] = 1;
				} else {
					$val[msg] = "Participant Registration Failed";
					$val[status] = 0;
				}
				$SQL 		= "INSERT INTO mygoal_details SET
						user_id = '".$customerID."',
						mobile_no = '".$par_mob."',
						campaign_code = '".$par_cam_code."',
						par_name  = '".$par_name."',
						par_myphoto  = '".$customerID."_".$par_cam_code."_".$_FILES['par_myphoto']['name']."',
						signup_ip = '".$_SERVER['REMOTE_ADDR']."'";				
				$custRes	= $this->db->db_run_query($SQL);
				$message = $this->commonFunction->readPHP("../__lib.mailFormats/campaign.html");
				
				//$message = str_replace("*|MC:SUBJECT|*","My Goal Campaign",$message);
				/*$message = str_replace("ACTIVE_CODE_1","a=".$getPostedData['email'],$message);
				$message = str_replace("ACTIVE_CODE_2","verifyEmail=".md5($getPostedData['email']),$message);*/
				$mail_res = $this->commonFunction->send_mail($par_email,"Welcome to optymoney — Participant registration successful",$message,true);
				$val[mail_res] = $mail_res;
			} else {
				$SQL 		= "INSERT INTO mygoal_details SET
						user_id = '".$customerID."',
						mobile_no = '".$par_mob."',
						campaign_code = '".$par_cam_code."',
						par_name  = '".$par_name."',
						signup_ip = '".$_SERVER['REMOTE_ADDR']."'";				
				$custRes	= $this->db->db_run_query($SQL);
				$message = $this->commonFunction->readPHP("../__lib.mailFormats/campaign.html");
				$mail_res = $this->commonFunction->send_mail($par_email,"Welcome to optymoney — Participant registration successful",$message,true);
				if($custRes==1) {
					$val[msg] = "Participant Registered Successfully";
					$val[status] = 1;
				} else {
					$val[msg] = "Participant Registration Failed";
					$val[status] = 0;
				}
				$val[mail_res] = $mail_res;
			}
		}
		return $val;
	}

	// selfie upload for mygoal in profile page
	function saveMygoalSelfie($post){
		$customerID = $this->CONFIG->loggedUserId;
		$par_cam_code = "mygoal";
		$result = $this->commonFunction->is_mygoal_email_exist($customerID, $par_cam_code);
		if($result>0) {
			$folder = $this->CONFIG->wwwroot . $this->CONFIG->userFilesURL . $this->CONFIG->mycampaign;
			$tmpFilePath = $_FILES['par_myphoto']['tmp_name'];
			if (!is_dir($folder.$customerID)) {
				mkdir($folder.$customerID, 0777, true);
			} 
			if ($tmpFilePath != ""){
				$newFilePath = $folder.$customerID."/".$customerID."_".$par_cam_code."_".$_FILES['par_myphoto']['name'];
				if(move_uploaded_file($tmpFilePath, $newFilePath)) {
					$val[msg] = "Participant Registered Successfully";
					$val[status] = 1;
				} else {
					$val[msg] = "Participant Registration Failed";
					$val[status] = 0;
				}
				$SQL 		= "UPDATE mygoal_details SET
						par_myphoto  = '".$customerID."_".$par_cam_code."_".$_FILES['par_myphoto']['name']."',
						where user_id = '".$customerID."'";				
				$custRes	= $this->db->db_run_query($SQL);
			}
			$val[msg] = "Participant Already Registered";
			$val[status] = 0;
		} else {
			$userinfo = $this->getCustomerInfo($customerID);
			$folder = $this->CONFIG->wwwroot . $this->CONFIG->userFilesURL . $this->CONFIG->mycampaign;
			$tmpFilePath = $_FILES['par_myphoto']['tmp_name'];
			if (!is_dir($folder.$customerID)) {
				mkdir($folder.$customerID, 0777, true);
			} 
			if ($tmpFilePath != ""){
				$newFilePath = $folder.$customerID."/".$customerID."_".$par_cam_code."_".$_FILES['par_myphoto']['name'];
				if(move_uploaded_file($tmpFilePath, $newFilePath)) {
					$val[msg] = "Participant Registered Successfully";
					$val[status] = 1;
				} else {
					$val[msg] = "Participant Registration Failed";
					$val[status] = 0;
				}
				$SQL 		= "INSERT INTO mygoal_details SET
						user_id = '".$customerID."',
						mobile_no = '".$userinfo['contact_no']."',
						campaign_code = '".$par_cam_code."',
						par_name  = '".$userinfo['cust_name']."',
						par_myphoto  = '".$customerID."_".$par_cam_code."_".$_FILES['par_myphoto']['name']."',
						signup_ip = '".$_SERVER['REMOTE_ADDR']."'";				
				$custRes	= $this->db->db_run_query($SQL);
				$message = $this->commonFunction->readPHP("../__lib.mailFormats/campaign.html");
				$mail_res = $this->commonFunction->send_mail($par_email,"Welcome to optymoney — Participant registration successful",$message,true);
				$val[mail_res] = $mail_res;
			}
		}
		return $val;
	}
	//  for admin section
	function getAllUsers($getRequest,$pageLimit='') {
		if($pageLimit != '')
			$limit = " LIMIT ".$pageLimit.",".$this->CONFIG->paginationPageItem;
		else
			$limit='';
			
		if($pageLimit == 0)
			$limit = " LIMIT ".$pageLimit.",".$this->CONFIG->paginationPageItem;
		
		if(!empty($getRequest[order_by]))
			$orderBy = " ORDER BY ".$getRequest[order_by]." ".$getRequest[sorting];
		else
			$orderBy = '';
				
		$userQuery			= "SELECT  	bfsi_users_details.pan_number,
										bfsi_users_details.contact_no,
								        bfsi_users_details.cust_name,
								        bfsi_user.created_date,
								        bfsi_user.user_status,
								        bfsi_user.bse_id,
								        bfsi_user.login_id,
								        bfsi_user.pk_user_id,
								        bfsi_user.fr_customer_id,
								        bfsi_itr.pk_itr_id,
								        bfsi_itr.asses_year,
								        bfsi_itr.itr_status,
								        bfsi_itr.form_created_date,
								        bfsi_itr.itr_pan,
								        bfsi_itr.itr_v 
								        FROM bfsi_users_details bfsi_users_details
									    INNER JOIN bfsi_user bfsi_user
									    ON (bfsi_users_details.fr_user_id = bfsi_user.pk_user_id) 
									    LEFT JOIN bfsi_itr bfsi_itr 
                                        ON (bfsi_user.pk_user_id =bfsi_itr.fr_user_id) order By bfsi_user.pk_user_id desc";
          // echo 'userQuery:'.$userQuery;
          // die();


		if($orderBy !='')
			$userQuery .= "  ".$orderBy;
		if($limit !='')
			$userQuery .= "  ".$limit;
		
		$countSearch = $this->getAllUsersCount($getRequest);
		
		//echo $countSearch,$SQL;				
		
		if($countSearch > 0)
		{			
			$customerList		=	$this->commonFunction->mysqlResultIntoArray($userQuery,'SQL');
		}
		else
			$customerList = array("MF_NONE");
						
		return $customerList;
	}	

	// for ADMIN SECTION
	function getAllitrUsers($getRequest,$pageLimit='') {
		if($pageLimit != '')
			$limit = " LIMIT ".$pageLimit.",".$this->CONFIG->paginationPageItem;
		else
			$limit='';
			
		if($pageLimit == 0)
			$limit = " LIMIT ".$pageLimit.",".$this->CONFIG->paginationPageItem;
		
		if(!empty($getRequest[order_by]))
			$orderBy = " ORDER BY ".$getRequest[order_by]." ".$getRequest[sorting];
		else
			$orderBy = '';
				
		$userQuery			= "SELECT bfsi_itr.pk_itr_id,bfsi_user.login_id,bfsi_itr.itr_pan,bfsi_itr.asses_year,bfsi_itr.itr_v FROM bfsi_itr inner join bfsi_user on bfsi_itr.fr_user_id=bfsi_user.pk_user_id";

		if($orderBy !='')
			$userQuery .= "  ".$orderBy;
		if($limit !='')
			$userQuery .= "  ".$limit;
		
		$countSearch = $this->getAllitrCount($getRequest);
		
		//echo $countSearch,$SQL;				
		
		if($countSearch > 0)
		{			
			$customerList		=	$this->commonFunction->mysqlResultIntoArray($userQuery,'SQL');
		}
		else
			$customerList = array("MF_NONE");
						
		return $customerList;
	}

	// COUNT FOR ADMIN SECTION COUNT OF ALL USER
	function getAllUsersCount($getRequest='') {
		$result1 = $this->db->db_run_query("select count(*) count from bfsi_user");
		$r1 = $this->db->db_fetch_array($result1);
		$count1=(int)$r1['count'];
		return $count1;
	}

	// COUNT FOR ADMIN SECTION COUNT OF ALL ITR USER
	function getAllitrCount($getRequest='') {
		$result1 = $this->db->db_run_query("SELECT count(*) count FROM bfsi_itr inner join bfsi_user on bfsi_itr.fr_user_id=bfsi_user.pk_user_id;");
		$r1 = $this->db->db_fetch_array($result1);
		$count1=(int)$r1['count'];
		return $count1;
	}

	function getPotalUserDetails($memberID)	{
		$query="SELECT * from $this->dbName.bfsi_user WHERE pk_user_id='$memberID'";
		if($result=$this->db->db_run_query($query))
			return $this->db->db_fetch_array($result);	
		else
			return false;
	}
	function customerAge($dob) {
		/*----------------------------------- 20190220-BSEN -------------------------------------*/
		//echo "DOB:|".$dob;
		$age = $this->commonFunction->mysqlResultIntoArray("SELECT TIMESTAMPDIFF( YEAR, '".date("Y-m-d",strtotime($dob))."', CURDATE( ) ) AS age");
		/*------------------------------------ for testing -------------------------------------*/
		//echo "SELECT TIMESTAMPDIFF( YEAR, '".date("Y-m-d",strtotime($dob))."', CURDATE( ) ) AS age";
		//print_r($age);
		return $age[0][age];
	}
	function getCustomerInfo($memberID) {
		$customerDetails=array();
		global $commonFunction;
		/*--------------------------------------------------- New Query Start -------------------------------------------------------------------------*/	
		$detailQuery = "SELECT bfsi_user.passwd,bfsi_user.last_login,bfsi_user.created_date,bfsi_user.pk_user_id,bfsi_user.bse_id,bfsi_user.profile_image,bfsi_user.fr_customer_id,bfsi_user.login_id,bfsi_user.signup_ip,bfsi_users_details.* FROM bfsi_user INNER JOIN bfsi_users_details ON (bfsi_user.pk_user_id = bfsi_users_details.fr_user_id)
		WHERE (bfsi_user.pk_user_id =  '".$memberID."')";
        /*--------------------------------------------------- New Query End ---------------------------------------------------------------------------*/	
		/*------------------------------------------------ Previous Query Start --------------------------------------------------------------------*/
    	/* = "SELECT bfsi_user.*,
									   bfsi_users_details.*
								  FROM bfsi_user bfsi_user
									   INNER JOIN bfsi_users_details bfsi_users_details
										  ON (bfsi_user.pk_user_id = bfsi_users_details.fr_user_id)
								 WHERE (bfsi_user.pk_user_id =  '".$memberID."')";
	    */
		/*---------------------------------------------------- Previous Query End --------------------------------------------------------------------*/	
		/*------------------------------------------------------------------------------------*/
		//$detailQuery = "SELECT * FROM `bfsi_users_details` WHERE `pk_user_detail_id`='".$memberID."'";
		//echo "QUERY:-".$detailQuery;
		//echo "<br>";
		$customerDetails		=	$this->commonFunction->getSingleRow($detailQuery);
		return $customerDetails;
	}
	function getCustomerBankInfo($getUserId='')	{		
		if($getUserId == '')
			$userId = $this->CONFIG->loggedUserId;
		else
			$userId = $getUserId;
	
		$detailQuery		= "SELECT * FROM bfsi_bank_details WHERE fr_user_id  =  '".$userId."'";
		$bankDetails		=	$this->commonFunction->getSingleRow($detailQuery);
		return $bankDetails;
	}
	function getCustomerBankInfo1($getUserId='') {		
		if($getUserId == '')
			$userId = $this->CONFIG->loggedUserId;
		else
			$userId = $getUserId;
	
		$detailQuery		= $this->db->db_run_query("SELECT * FROM bfsi_bank_details WHERE fr_user_id  =  '".$userId."' order by pk_bank_detail_id");
		// $bankDetails		=	$this->commonFunction->getSingleRow($detailQuery);

		return $detailQuery;
	}
	/*---------------------------------------- Update settings      -----------------------------------------------*/
	function update_setting($details) {
		// echo "Update bfsi_users_details set pan_number		   = '".$details[pan]."',
		// 									cust_name          = '".$details[cust_name]."',
		// 									father_name        = '".$details[father_name]."',
		// 									country            = '".$details[country]."',
		// 									sex                = '".$details[sex]."',
		// 									dob                = '".$details[birthday]."',
		// 									aadhaar_no         = '".$details[adhar_num]."',
		// 									address1           = '".$details[line1]."',
		// 									address2           = '".$details[line2]."',
		// 									address3           = '".$details[line3]."',
		// 									city               = '".$details[city]."',
		// 									state              = '".$details[state]."',
		// 									pincode            = '".$details[pincode]."',
		// 									country            = '".$details[country]."',
		// 									sex                = '".$details[sex]."',
		// 									dob                = '".$details[birthday]."',
		// 									nominee_name       = '".$details[nominee]."',
		// 									r_of_nominee_w_app = '".$details[r_of_nominee_w_app]."'
		// 									where fr_user_id='".$this->CONFIG->loggedUserId."'";
		/*-----------------------------------------Update use details in Table in bfsi_users_details -----------------------------------------------*/
		return $this->db->db_run_query("Update bfsi_users_details set pan_number='".$details[pan]."',
											cust_name          = '".$details[cust_name]."',
											father_name        = '".$details[father_name]."',
											country            = '".$details[country]."',
											sex                = '".$details[sex]."',
											dob                = '".$details[birthday]."',
											aadhaar_no         = '".$details[adhar_num]."',
											address1           = '".$details[line1]."',
											address2           = '".$details[line2]."',
											address3           = '".$details[line3]."',
											city               = '".$details[city]."',
											state              = '".$details[state]."',
											pincode            = '".$details[pincode]."',
											country            = '".$details[country]."',
											sex                = '".$details[sex]."',
											dob                = '".$details[birthday]."',
											nominee_name       = '".$details[nominee]."',
											r_of_nominee_w_app = '".$details[r_of_nominee_w_app]."'
											where fr_user_id='".$this->CONFIG->loggedUserId."'");
		/*$result = $this->db->db_run_query("select * from bfsi_bank_details where fr_user_id ='".$this->CONFIG->loggedUserId."'");
		$total_records = $this->db->db_num_rows($result);
		if($total_records>0) {
			$userInfo = $this->UCC_Mandate();
			$ucc_status = $this->ucc_check();
			//print_r($userInfo);
			if($ucc_status[bse_id]!="") {
				$ucc_update = $buySell->update_user_info($user_info);
				//echo "mand : ".$ucc_update[mandate_id];
			}
		}*/
	}
	/*---------------------------------------- Update settings      -----------------------------------------------*/
	function update_setting_app($details) {
		/*-----------------------------------------Update use details in Table in bfsi_users_details -----------------------------------------------*/
		$res = $this->db->db_run_query("Update bfsi_users_details set pan_number='".$details[pan]."',
											cust_name          = '".$details[cust_name]."',
											father_name        = '".$details[father_name]."',
											country            = '".$details[country]."',
											sex                = '".$details[sex]."',
											dob                = '".$details[birthday]."',
											aadhaar_no         = '".$details[adhar_num]."',
											address1           = '".$details[line1]."',
											address2           = '".$details[line2]."',
											address3           = '".$details[line3]."',
											city               = '".$details[city]."',
											state              = '".$details[state]."',
											pincode            = '".$details[pincode]."',
											country            = '".$details[country]."',
											sex                = '".$details[sex]."',
											dob                = '".$details[birthday]."',
											nominee_name       = '".$details[nominee]."',
											r_of_nominee_w_app = '".$details[r_of_nominee_w_app]."'
											where fr_user_id='".$details[uid]."'");
		if($res==1) {
			$val[msg] = "User Details Updated Successfully";
			$val[status] = 1;
		} else {
			$val[msg] = "User Details Update Failed";
			$val[status] = 0;
		}								
		return json_encode($val);
	}
	/*---------------------------------------------------------------------------------------*/
	function update_user_deatils($details) {
		/*-----------------------------------------Update use details in Table in bfsi_users_details -----------------------------------------------*/
		$this->db->db_run_query("Update bfsi_users_details set pan_number='".$details[pan]."',
											  address1           = '".$details[line1]."',
											  address2           = '".$details[line2]."',
											  address3           = '".$details[line3]."',
											  city               = '".$details[city]."',
											  state              = '".$details[state]."',
											  pincode            = '".$details[pincode]."',
											  country            = '".$details[country]."',
											  sex                = '".$details[gender]."',
											  dob                = '".$details[birthday]."',
											  nominee_name       = '".$details[nominee]."',
											  r_of_nominee_w_app = '".$details[g_n_r]."' where fr_user_id='".$this->CONFIG->loggedUserId."'");
		$check_bank = $this->db->db_run_query("Select * from bfsi_bank_details where fr_user_id ='".$this->CONFIG->loggedUserId."'");
		//echo "Select * from bfsi_bank_details where fr_user_id ='".$this->CONFIG->loggedUserId."'";
		//echo "BANK:-".$this->db->db_num_rows($check_bank)."<br>";
		if($this->db->db_num_rows($check_bank) > 0) {
			/*---------------------------------------- update into bfsi_bank_details -----------------------------------------------------*/
			$this->db->db_run_query("Update bfsi_bank_details set bank_name ='".$details[bank_name]."', 
															  acc_no    ='".$details[bank_account]."',
															  ifsc_code ='".$details[IFSC]."',default_bank='1' where fr_user_id ='".$this->CONFIG->loggedUserId."'");
		} else {
			$this->db->db_run_query("INSERT INTO bfsi_bank_details set bank_name ='".$details[bank_name]."', 
															  acc_no    ='".$details[bank_account]."',
															  ifsc_code ='".$details[IFSC]."',default_bank='1',fr_user_id ='".$this->CONFIG->loggedUserId."',bank_created_date = now()");
		}
		/*---------------------------------------- update into bfsi_bank_details -----------------------------------------------------*/
		return;
	}
	/*---------------------------------------- insert/update into bfsi_bank_details -----------------------------------------------------*/
	function update_bank_setting($details) {
		//print_r($details);
		$data = $details[data];
		$result = $this->db->db_run_query("select * from bfsi_bank_details where fr_user_id ='".$this->CONFIG->loggedUserId."'");
		$total_records = $this->db->db_num_rows($result);
		if($total_records>0) {
			$default_bank = 0;
		} else {
			$default_bank = 1;
		}
		$result1 = $this->db->db_run_query("select * from bfsi_bank_details where fr_user_id ='".$this->CONFIG->loggedUserId."' and acc_no ='".$data[acc_no]."'");
		$ac_avail = $this->db->db_num_rows($result1);
		if($ac_avail==0) {
			if($details[id]=="") {
				$result = $this->db->db_run_query("INSERT INTO bfsi_bank_details set bank_name ='".$data[bank_name]."', acc_no    ='".$data[acc_no]."', ifsc_code ='".$data[ifsc_code]."', default_bank ='".$default_bank."', fr_user_id ='".$this->CONFIG->loggedUserId."',bank_created_date = now()");
				$lastid = $this->db->db_run_query("Select * from bfsi_bank_details where fr_user_id ='".$this->CONFIG->loggedUserId."' order by pk_bank_detail_id desc limit 1");
				while ($row = $this->db->db_fetch_assoc($lastid)){
					$bankid = $row['pk_bank_detail_id'];
				}
			} else {
				$result = $this->db->db_run_query("Update bfsi_bank_details set bank_name ='".$data[bank_name]."', acc_no    ='".$data[acc_no]."', ifsc_code ='".$data[ifsc_code]."' where pk_bank_detail_id ='".$details[id]."'");	
				$bankid = $details[id];
			}
			//echo "bank id : ".$bankid;
			global $bseSync;
			$this->bseSync = $bseSync;
			$buySell = new buySell();
			$ucc_status = $this->ucc_check();
			if($ucc_status[bse_id]=="") {
				$userInfo = $this->UCC_Mandate();
				$userInfo[bank_name] = $data[bank_name];
				$userInfo[acc_no] = $data[acc_no];
				$userInfo[ifsc_code] = $data[ifsc_code];
				$userInfo[client_code] = $ucc_status[bse_id];
				$userInfo[tot_bank_ac] = $total_records;
				$ucc_update = $buySell->create_user($userInfo);
				$pos = strpos($ucc_update, "FAILED");
				if($pos>0) {
					$val[status] = "failure";
					$val[msg] =  "Please Update the basic details before going to proceed";
				} else {
					$result = $this->db->db_run_query("Update bfsi_bank_details set mandate_id ='".$ucc_update[mandate_id]."' where pk_bank_detail_id ='".$bankid."'");	
					$val[mandate_id] = $ucc_update[mandate_id];
					$val[status] = "success";
				}
				
			} else {
				$userInfo = $this->UCC_Mandate();
				//print_r($userInfo);
				$userInfo[bank_name] = $data[bank_name];
				$userInfo[acc_no] = $data[acc_no];
				$userInfo[ifsc_code] = $data[ifsc_code];
				$userInfo[client_code] = $ucc_status[bse_id];
				$userInfo[tot_bank_ac] = $total_records;
				if($ucc_status[bse_id]!="") {
					$ucc_update = $buySell->update_user($userInfo);
					//echo "mand : ".$ucc_update[mandate_id];
				} else {
					$ucc_update = $buySell->create_user($userInfo);
				}
				$pos = strpos($ucc_update, "FAILED");
				if($pos>0) {
					$val[mandate_id] = $ucc_update[mandate_id];
					$val[status] = "failure";
					$val[mandate] = $mandate_para;
					$val[ucc] = $ucc_status[bse_id];
				} else {
					$result = $this->db->db_run_query("Update bfsi_bank_details set mandate_id ='".$ucc_update[mandate_id]."' where pk_bank_detail_id ='".$bankid."'");	
					$val[mandate_id] = $ucc_update[mandate_id];
					$val[status] = "success";
				}
			}
		} else {
			$val[mandate_id] = "Bank Account number already exist";
			$val[status] = "failure";
		}
		return json_encode($val);
	}

	function update_bank_setting_api($data) {
		//print_r($data[uid]);
		$result = $this->db->db_run_query("select * from bfsi_bank_details where fr_user_id ='".$data[uid]."'");
		$total_records = $this->db->db_num_rows($result);
		if($total_records>0) {
			$default_bank = 0;
		} else {
			$default_bank = 1;
		}
		$result1 = $this->db->db_run_query("select * from bfsi_bank_details where fr_user_id ='".$data['uid']."' and acc_no ='".$data[acc_no]."'");
		$ac_avail = $this->db->db_num_rows($result1);
		if($ac_avail==0) {
			if($data[id]=="") {
				$result = $this->db->db_run_query("INSERT INTO bfsi_bank_details set bank_name ='".$data[bank_name]."', acc_no    ='".$data[acc_no]."', ifsc_code ='".$data[ifsc_code]."', default_bank ='".$default_bank."', fr_user_id ='".$data['uid']."',bank_created_date = now()");
				$lastid = $this->db->db_run_query("Select * from bfsi_bank_details where fr_user_id ='".$data['uid']."' order by pk_bank_detail_id desc limit 1");
				while ($row = $this->db->db_fetch_assoc($lastid)){
					$bankid = $row['pk_bank_detail_id'];
				}
			} else {
				$result = $this->db->db_run_query("Update bfsi_bank_details set bank_name ='".$data[bank_name]."', acc_no    ='".$data[acc_no]."', ifsc_code ='".$data[ifsc_code]."' where pk_bank_detail_id ='".$data[id]."'");	
				$bankid = $data[id];
			}
			global $bseSync;
			$this->bseSync = $bseSync;
			$buySell = new buySell();
			$ucc_status = $this->ucc_check_api($data['uid']);
			if($ucc_status[bse_id]=="") {
				$userInfo = $this->ucc_mandate_api($data['uid']);
				$userInfo[bank_name] = $data[bank_name];
				$userInfo[acc_no] = $data[acc_no];
				$userInfo[ifsc_code] = $data[ifsc_code];
				$userInfo[client_code] = $ucc_status[bse_id];
				$userInfo[tot_bank_ac] = $total_records;
				$ucc_update = $buySell->bse_create_user_api($userInfo, $data['uid']);
				$pos = strpos($ucc_update, "FAILED");
				if($pos>0) {
					$val[status] = "failure";
					$val[msg] =  "Please Update the basic details before going to proceed";
				} else {
					$result = $this->db->db_run_query("Update bfsi_bank_details set mandate_id ='".$ucc_update[mandate_id]."' where pk_bank_detail_id ='".$bankid."'");	
					$val[mandate_id] = $ucc_update[mandate_id];
					$val[status] = "success";
				}
				
			} else {
				$userInfo = $this->ucc_mandate_api($data['uid']);
				$userInfo[bank_name] = $data[bank_name];
				$userInfo[acc_no] = $data[acc_no];
				$userInfo[ifsc_code] = $data[ifsc_code];
				$userInfo[client_code] = $ucc_status[bse_id];
				$userInfo[tot_bank_ac] = $total_records;
				if($ucc_status[bse_id]!="") {
					$ucc_update = $buySell->bse_update_user_api($userInfo, $data['uid']);
					//echo "mand : ".$ucc_update[mandate_id];
				} else {
					//$ucc_update = $buySell->create_user($userInfo);
				}
				$pos = strpos($ucc_update, "FAILED");
				if($pos>0) {
					$val[mandate_id] = $ucc_update[mandate_id];
					$val[status] = "failure";
					$val[mandate] = $mandate_para;
					$val[ucc] = $ucc_status[bse_id];
				} else {
					$result = $this->db->db_run_query("Update bfsi_bank_details set mandate_id ='".$ucc_update[mandate_id]."' where pk_bank_detail_id ='".$bankid."'");	
					$val[mandate_id] = $ucc_update[mandate_id];
					$val[status] = "success";
				}
			}
		} else {
			$val[mandate_id] = "Bank Account number already exist";
			$val[status] = "failure";
		}
		return json_encode($val);
	}

	function delete_bank_setting_api($details) {
		/*---------------------------------------- update into bfsi_bank_details -----------------------------------------------------*/
		$sql_query = "delete from bfsi_bank_details where pk_bank_detail_id ='".$details[id]."'";    
        $result = $this->db->db_run_query($sql_query);
		$buySell = new buySell();
		$userInfo = $this->ucc_mandate_api($details[uid]);
		$ucc_update = $buySell->bse_update_user_api($user_info, $details[uid]);
        return $result;
	}

	/*----------------------------------- UCC check -------------------------------------*/
	function ucc_check_api($id) {
		$ucc = $this->db->db_fetch_assoc($this->db->db_run_query("SELECT * FROM bfsi_user left join bfsi_users_details ON (bfsi_user.pk_user_id = bfsi_users_details.fr_user_id) left join bfsi_bank_details on (bfsi_user.pk_user_id = bfsi_bank_details.fr_user_id) where bfsi_user.pk_user_id='".$id."'"));
		return $ucc;
	}
	/* UCC Mandate */
	function ucc_mandate_api($id) {
		$UCC_Mandate = $this->commonFunction->getSingleRow("Select bfsi_users_details.cust_name,
				       bfsi_users_details.dob,
				       bfsi_users_details.sex,
				       bfsi_users_details.pan_number,
				       bfsi_users_details.nominee_name,
				       bfsi_users_details.r_of_nominee_w_app,
				       bfsi_users_details.city,
				       bfsi_users_details.state,
				       bfsi_users_details.pincode,
				       bfsi_users_details.address1,
				       bfsi_users_details.address2,
				       bfsi_users_details.address3,
				       bfsi_users_details.contact_no,
				       bfsi_user.login_id,
				       bfsi_bank_details.bank_name,
				       bfsi_bank_details.acc_no,
				       bfsi_bank_details.ifsc_code From 
				       bfsi_users_details inner join bfsi_user on (bfsi_users_details.fr_user_id= bfsi_user.pk_user_id) inner join bfsi_bank_details on (bfsi_bank_details.fr_user_id=bfsi_users_details.fr_user_id) 
				                          where bfsi_users_details.fr_user_id='".$id."'");
		return  $UCC_Mandate;
	}


	function get_bank_details($details) {
		/*---------------------------------------- update into bfsi_bank_details -----------------------------------------------------*/
		$sql_query = "Select * from bfsi_bank_details where fr_user_id ='".$this->CONFIG->loggedUserId."'";    
        $result = $this->db->db_run_query($sql_query);
        $total_records = $this->db->db_num_rows($result);
        $data = array();
        while ($row = $this->db->db_fetch_assoc($result)){
            $data[] = $row;
        }
        //echo json_encode($data);
        return json_encode($data);
	}

	function get_bank_details_api($details) {
		/*---------------------------------------- update into bfsi_bank_details -----------------------------------------------------*/
		$sql_query = "Select * from bfsi_bank_details where fr_user_id ='".$details['uid']."'";    
        $result = $this->db->db_run_query($sql_query);
        $total_records = $this->db->db_num_rows($result);
        $data = array();
        while ($row = $this->db->db_fetch_assoc($result)){
            $data[] = $row;
        }
        //echo json_encode($data);
        return json_encode($data);
	}

	function delete_bank_setting($details) {
		/*---------------------------------------- update into bfsi_bank_details -----------------------------------------------------*/
		$sql_query = "delete from bfsi_bank_details where pk_bank_detail_id ='".$details[id]."'";    
        $result = $this->db->db_run_query($sql_query);
		$buySell = new buySell();
		$userInfo = $this->UCC_Mandate();
		$ucc_update = $buySell->update_user($userInfo);
        return $result;
	}

	/*---------------------------------------------------------------------------------------*/

	function UCC_Mandate()
	{
		$UCC_Mandate = $this->commonFunction->getSingleRow("Select bfsi_users_details.cust_name,
				       bfsi_users_details.dob,
				       bfsi_users_details.sex,
				       bfsi_users_details.pan_number,
				       bfsi_users_details.nominee_name,
				       bfsi_users_details.r_of_nominee_w_app,
				       bfsi_users_details.city,
				       bfsi_users_details.state,
				       bfsi_users_details.pincode,
				       bfsi_users_details.address1,
				       bfsi_users_details.address2,
				       bfsi_users_details.address3,
				       bfsi_users_details.contact_no,
				       bfsi_user.login_id,
				       bfsi_bank_details.bank_name,
				       bfsi_bank_details.acc_no,
				       bfsi_bank_details.ifsc_code From 
				       bfsi_users_details inner join bfsi_user on (bfsi_users_details.fr_user_id= bfsi_user.pk_user_id) inner join bfsi_bank_details on (bfsi_bank_details.fr_user_id=bfsi_users_details.fr_user_id) 
				                          where bfsi_users_details.fr_user_id='".$this->CONFIG->loggedUserId."'");
		return  $UCC_Mandate;
	}
	/*----------------------------- Update UCC Mandate Into DB -----------------------------------------*/
	function update_ucc_mandate($val,$for=0)
	{
		//echo "Update bfsi_user set bse_id ='".$val[ucc]."' where pk_user_id='".$this->CONFIG->loggedUserId."'";
		//echo "Update bfsi_bank_details set mandate_id ='".$val[mandate_id]."',mandate_start_dt='".date("d/m/Y")."',mandate_end_dt='31/12/2099' where fr_user_id='".$this->CONFIG->loggedUserId."' AND default_bank='1'";
		$update_ucc = $this->db->db_run_query("Update bfsi_user set bse_id ='".$val[ucc]."' where pk_user_id='".$this->CONFIG->loggedUserId."'"); 

		$update_mandate = $this->db->db_run_query("Update bfsi_bank_details set mandate_id ='".$val[mandate_id]."',mandate_start_dt='".date("d/m/Y")."',mandate_end_dt='"."31/12/2099"."' where fr_user_id='".$this->CONFIG->loggedUserId."' AND default_bank='1'"); 
		//echo "Update bfsi_bank_details set bank_mandateId ='".$val[mandate_id]."' where fr_user_id='".$this->CONFIG->loggedUserId."'";
		echo "Update bfsi_bank_details set mandate_id ='".$val[mandate_id]."',mandate_start_dt='".date("d/m/Y")."',mandate_end_dt='"."31/12/2099"."' where fr_user_id='".$this->CONFIG->loggedUserId."' AND default_bank='1'";
		//die();
		return;
	}
	function getCustomerName($fr_user_id)
	{
		global $commonFunction;
		$name = $commonFunction->getSingleCol('cust_name','bfsi_users_details', "fr_user_id ='$fr_user_id'");
		return trim($name);	
	}
	function setProfileImage($memberID,$imageName)
	{
		$this->db->db_run_query("UPDATE bfsi_user SET profile_image  = '".$imageName."' WHERE pk_user_id  = '".$memberID."'");
		return;
	}
	function getEmail($memberID)
	{
		$email = $this->commonFunction->getSingleRow("SELECT email_id FROM  $this->dbName.bfsi_user WHERE  pk_user_id ='$memberID'");
		return substr($email[email_id],0,strpos($email[email_id],'@'));
	}	
	function newCustomer($getPostedData,$isSubUser='')
	{
		global $commonFunction,$CONFIG;
		//5316071800000001
		$n = 10000000;	
		$fixed = "91".date("dmy");
		
		
	
		$SQL 		= "INSERT INTO bfsi_user SET
						login_id = '".$getPostedData['email']."',
						passwd = '".md5(trim($getPostedData['reg_passwd']))."',
						communication_email = 'Permanent',	
						user_status = 'Active',										
						signup_ip = '".$_SERVER['REMOTE_ADDR']."'";				
		
		/*----------------------------- 20190218-BSEN ------------------------------------------*/
		
		/*echo "user| ".$isSubUser;
		echo "getPostedData| ".$getPostedData;
		*/
			//echo "user| ".$isSubUser;
		/*echo "getPostedData|";
        print_r($getPostedData);
        echo "SQL|".$SQL;
        die();*/
		/*-------------------------------------------------------------------------------------*/
		//echo "SQL:-".$sql;
		
		$custRes	= $this->db->db_run_query($SQL);
		
		$customerID =  $this->db->db_insert_id(); //mysqli_fetch_array($custRes); //
		/*---------------------------- 20190218-BSEN ---------------------------------------*/
		
		//echo "Customer ID:-".$customerID;
		//$customerID = implode('',$customerID);
		//echo "Customer ID:-".$customerID; 
		if($customerID == 0)
		{
			//echo $SQL;
			echo "REGISTER_FAILED";
			return 0;
		}
		$dbCustomerID = $fixed.($n+$customerID);
		//echo "dbCustomerID:-".$dbCustomerID;
		$customerIDUpdate	= $this->db->db_run_query("UPDATE bfsi_user SET fr_customer_id = '".$dbCustomerID."' WHERE pk_user_id = '".$customerID."'");
		
		$SQL1 		= "INSERT INTO bfsi_users_details SET
						fr_user_id = '".$customerID."',
						cust_name = '".$getPostedData['name']."',
						contact_no = '".$getPostedData['mobile']."',
						detail_created_date = now()";				
		
		$result1	= $this->db->db_run_query($SQL1);
		
		//$SQL2 		= "INSERT INTO bfsi_users_settings SET		fr_user_id = '".$customerID."',						setting_create_date = now()";				

		//$SQL2 = "INSERT INTO bfsi_users_settings SET pay_date = DATE(NOW()), fr_user_id = '".$customerID."', paid_amount = '0', pending_amount = '0', pay_status = '0', 
                       // pay_for = '', setting_create_date = DATE(NOW()), txn_id = '', narration = '', setting_modified_date = now()";
		
		//$result2	= $this->db->db_run_query($SQL2);
		
		$SQL3 		= "INSERT INTO bfsi_bank_details SET
						fr_user_id = '".$customerID."',default_bank='1'
						bank_created_date = now()";				
		
		$result3	= $this->db->db_run_query($SQL3);
		
		$message = $commonFunction->readPHP("../__lib.mailFormats/registration_confirmation_mail.html");
		$message = str_replace("USERNAME",$getPostedData['name'],$message);
		$message = str_replace("ACTIVE_CODE_1","a=".$getPostedData['email'],$message);
		$message = str_replace("ACTIVE_CODE_2","verifyEmail=".md5($getPostedData['email']),$message);
		$this->db->db_run_query("INSERT INTO bfsi_verification SET email_id = '".$getPostedData['email']."', fr_customer_id='".$dbCustomerID."',auth_code='".md5($getPostedData['email'])."',ip_address = '".$_SERVER['REMOTE_ADDR']."',verification_type='Register', create_date=now()");
		$commonFunction->send_mail($getPostedData['email'],"Account Registered with optymoney.com",$message,true);
		return $customerID;
	}

	function savePin($getPostedData) {
		$SQL = "update bfsi_user SET mpin = '".$getPostedData['mpin']."' where pk_user_id='".$getPostedData['userid']."'";
		$custRes	= $this->db->db_run_query($SQL);
		return $custRes;
	}

	/*--------------------------------------------- External Customer Entry-START ----------------------------------------------------*/
	function externalnewCustomer($getPostedData,$isSubUser='') {
		$mandatearr=$getPostedData[mandate] ;
		$finalmandate ="";
		foreach($mandatearr as $key) {
            $finalmandate .= $key."|";
		}
		global $commonFunction,$CONFIG;
		//5316071800000001
		$n = 10000000;	
		$fixed = "91".date("dmy");
		//$getPostedData['reg_passwd'] = 'rand()';
		$getPostedData['reg_passwd'] = '456789';
		if ($getPostedData['url']) {
			$pcode = $getPostedData['url'];
			$url = explode('?',$pcode);
			$pcode = explode('=', $url[1]);
			$p_code = $pcode[1];
			$p_code = base64_decode($p_code);	
		}
		if ($getPostedData['org']) {
			$user_org = $getPostedData['org'];
		}
		$SQL 		= "INSERT INTO bfsi_user SET
						login_id = '".$getPostedData['email']."',
						passwd = '".md5(trim($getPostedData['reg_passwd']))."',
						communication_email = 'Permanent',	
						user_status = 'Active',	
						bse_id='".$getPostedData['bse']."',
						nach_update='".intval($getPostedData['nach'])."',
						p_code='".$p_code."',
						user_org='".$user_org."',							
						signup_ip = '".$_SERVER['REMOTE_ADDR']."'";				
		$custRes	= $this->db->db_run_query($SQL);
		$customerID =  $this->db->db_insert_id(); //mysqli_fetch_array($custRes); //
		/*---------------------------- 20190218-BSEN ---------------------------------------*/
		echo "Customer ID:-".$customerID;
		// $customerID = implode('',$customerID);
		// echo "Customer ID:-".$customerID; 
		if($customerID == 0) {
			//echo $SQL;
			echo "REGISTER_FAILED";
			return 0;
		}
		$dbCustomerID = $fixed.($n+$customerID);
		//echo "dbCustomerID:-".$dbCustomerID;
		$customerIDUpdate	= $this->db->db_run_query("UPDATE bfsi_user SET fr_customer_id = '".$dbCustomerID."' WHERE pk_user_id = '".$customerID."'");
		
		$SQL1 		= "INSERT INTO bfsi_users_details SET
						fr_user_id = '".$customerID."',
						cust_name = '".$getPostedData['name']."',
						contact_no = '".$getPostedData['mobile']."',
						pan_number='".$getPostedData['pan']."',
						detail_created_date = now(),
						pi_date = now()";

		// echo "<br>SQ11:-".$SQL1."<br>";
		// die();
		$result1	= $this->db->db_run_query($SQL1);
		
		//$SQL3 		= "INSERT INTO bfsi_bank_details SET fr_user_id = '".$customerID."',default_bank='1', bank_created_date = now()";
		
		//echo "<br>SQ13:-".$SQL3."<br>";										
		
		//$result3	= $this->db->db_run_query($SQL3);

		$this->add_event($customerID,$p_code,$user_org);
		$message = $commonFunction->readPHP("../__lib.mailFormats/registration_confirmation_mail.html");
		$message = str_replace("USERNAME",$getPostedData['name'],$message);
		$this->db->db_run_query("INSERT INTO bfsi_verification SET email_id = '".$getPostedData['email']."', fr_customer_id='".$dbCustomerID."',auth_code='".md5($getPostedData['email'])."',ip_address = '".$_SERVER['REMOTE_ADDR']."',verification_type='Register', create_date=now()");
		$commonFunction->send_mail($getPostedData['email'],"Account Registered with optymoney.com",$message,true);
		return $customerID;
	}	
	/*----------------------------------------------------------- Insert Event into Database  --------------------------------------------*/
	function add_event($id,$event,$org)
	{
		$SQL 		= "INSERT INTO event_details SET user_id='".$id."',event_p_code='".$event."',user_org='".$org."', event_timestamp=now()";	
		//echo "SQL:".$SQL;
		$result	= $this->db->db_run_query($SQL);
		return $SQL;
	}
	/*-----------------------------------------------------------------------------------------------------------------------------------*/
	/*---------------------------------------------- External Customer Entry-END ----------------------------------------------------*/

	function checkVerifyPending($getRequestEmail,$authCode) {
		$usagesQuery	= "SELECT * FROM $this->dbName.bfsi_verification WHERE email_id  = '".$getRequestEmail."' 
																		   AND auth_code ='".$authCode."' 
																		   AND verification_type = 'Forget' 
																		   AND action_status = 'Pending'";
		$tagRes	= $this->db->db_run_query($usagesQuery);
		$emailRes = $this->db->db_num_rows($tagRes);
		if($emailRes > 0) {
			return 1;
		} else {
			return 0;
		}
	}
	function verifyCustomer($getRequestEmail,$verificationType='Register')
	{
		global $commonFunction;
		$usagesQuery	= "SELECT * FROM $this->dbName.bfsi_verification WHERE auth_code   = '".$getRequestEmail."' AND verification_type='".$verificationType."'";
		$tagRes	= $this->db->db_run_query($usagesQuery);
		$emailRes = $this->db->db_num_rows($tagRes);		
		
		if($emailRes > 0)
		{
			$getEmail		 = $commonFunction->getSingleRow($usagesQuery);
			$customerDetails = $commonFunction->getSingleRow("SELECT * FROM bfsi_user WHERE login_id = '".$getEmail[email_id]."'");
			$verifyUpdate	 = $this->db->db_run_query("UPDATE bfsi_verification SET auth_code = '' WHERE pk_verify_id = '".$getEmail[pk_verify_id]."'");
			$this->activateAccount($customerDetails[pk_user_id]);
			return $customerDetails[pk_user_id];
		}
		else
			return 0;
	}
	/*----------------------------------- 20190219-BSEN-START -------------------------------------*/
	/*--------------------------- updating last login time into bfsi_user  -----------------------*/
	function lastlogin($login_id){
		global $commonFunction;
		$date = date("Y-m-d H:i:s");
		
		/*echo "SQL|"."UPDATE bfsi_user SET last_login ='".$date."' WHERE login_id ='".$login_id."'";
		die();*/
		
		$verifyUpdate	 = $this->db->db_run_query("UPDATE bfsi_user SET last_login ='".$date."' WHERE login_id ='".$login_id."'");
		
		
	}
	/*---------------------------------- *TBD about the Time* ------------------------------------*/
	/*----------------------------------- 20190219-BSEN-END -------------------------------------*/
	/*----------------------------------- UCC check -------------------------------------*/
	function ucc_check()
	{
		$ucc = $this->db->db_fetch_assoc($this->db->db_run_query("SELECT * FROM bfsi_user left join bfsi_users_details ON (bfsi_user.pk_user_id = bfsi_users_details.fr_user_id) left join bfsi_bank_details on (bfsi_user.pk_user_id = bfsi_bank_details.fr_user_id) where bfsi_user.pk_user_id='".$this->CONFIG->loggedUserId."'"));		
		//echo "SELECT * FROM bfsi_user inner join bfsi_users_details ON (bfsi_user.pk_user_id = bfsi_users_details.fr_user_id) inner join bfsi_bank_details on (bfsi_user.pk_user_id = bfsi_bank_details.fr_user_id) where bfsi_user.pk_user_id='".$this->CONFIG->loggedUserId."'";
		
		return $ucc;
	}
	/*----------------------------------- UCC check -------------------------------------*/

	
	function activateAccount($getUserId)
	{
		$subUSerUpdate	= $this->db->db_run_query("UPDATE bfsi_user SET user_status = 'Active' WHERE pk_user_id = '".$getUserId."'");
	}
}  
//class closed

?>
