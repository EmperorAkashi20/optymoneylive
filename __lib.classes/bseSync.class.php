<?php
class bseSync{

	function bseSync()
	{
		global $CONFIG,$commonFunction,$documentFiles,$customerProfile,$buySell;
		global $db;
		$this->db					= $db;
		$this->dbName				= $CONFIG->dbName;
		$this->commonFunction		= $commonFunction;
		$this->CONFIG				= $CONFIG;
		$this->documentFiles		= $documentFiles;
		$this->customerProfile		= $customerProfile;
		$this->bseSync				= array();
	}
	function prepareUserParamBSE($getUserId='')
	{
		$returnArray = array();

		if($getUserId == '')
			$userId = $this->CONFIG->loggedUserId;
		else
			$userId = $getUserId;

		$userDetails = 	$this->userKYCData($userId);
		$bankDetails = 	$this->customerProfile->getCustomerBankInfo($userId);

		$returnArray['USER_DETAIL'] =  $userDetails;
		$returnArray['BANK_DETAIL'] =  $bankDetails;

		return $returnArray;
	}
	function userKYCData($getUserId='')
	{
		if($getUserId == '')
			$userId = $this->CONFIG->loggedUserId;
		else
			$userId = $getUserId;

		$user_data = $this->customerProfile->getCustomerInfo($userId);
		return $user_data;
	}
	function createUserBSEString($getUserId='')
	{
		if($getUserId == '')
			$userId = $this->CONFIG->loggedUserId;
		else
			$userId = $getUserId;

		$getDetails = $this->prepareUserParamBSE($userId);

		if($getDetails[USER_DETAIL][bse_id] == '')
		{
			//echo $getDetails[USER_DETAIL][fr_customer_id];	echo "<br>";
			$client_code = "D".date("y",strtotime($getDetails[USER_DETAIL][created_date])).sprintf('%07d', $getDetails[USER_DETAIL][pk_user_id]);
			$this->db->db_run_query("UPDATE bfsi_user SET bse_id = '".$client_code."' WHERE pk_user_id = '".$getDetails[USER_DETAIL][pk_user_id]."'");
		}
		else
			$client_code = $getDetails[USER_DETAIL][bse_id];

		$appname1	= $getDetails[USER_DETAIL][cust_name];
		$dob		= date("d/m/Y",strtotime($getDetails[USER_DETAIL][dob]));		//dd/mm/yyyy
		$gender		= $this->CONFIG->genderArr[$getDetails[USER_DETAIL][sex]];

		$acc_no		= strtoupper($getDetails[BANK_DETAIL][acc_no]);
		$ifsc_code	= strtoupper($getDetails[BANK_DETAIL][ifsc_code]);
		$add1		= strtoupper($getDetails[USER_DETAIL][address1]);
		$add2		= strtoupper($getDetails[USER_DETAIL][address2]);
		$add3		= strtoupper($getDetails[USER_DETAIL][address3]);
		$city		= strtoupper($getDetails[USER_DETAIL][city]);
		$state		= $this->CONFIG->stateCodeBSE[ucwords($getDetails[USER_DETAIL][state])];
		$pincode	= strtoupper($getDetails[USER_DETAIL][pincode]);
		$email		= strtoupper($getDetails[USER_DETAIL][login_id]);

		$phone		= strtoupper($getDetails[USER_DETAIL][contact_no]);
		$pan		= strtoupper($getDetails[USER_DETAIL][pan_number]);

		//echo "<pre>";print_r($getDetails);

		$userParam = array( "CODE" => $client_code,
							"HOLDING" => $this->CONFIG->clientHolding['Single'],
							"TAXSTATUS" => $this->CONFIG->taxStatus['Individual'],
							"OCCUPATIONCODE" => $this->CONFIG->occupationCode['Service'],
							"APPNAME1" => $appname1,
							"APPNAME2" => "",
							"APPNAME3" => "",
							"DOB" => $dob,
							"GENDER" => $gender,
							"FATHER/HUSBAND/gurdian" => "01",
							"PAN" => $pan,
							"NOMINEE" => "",
							"NOMINEE_RELATION" => "",
							"GUARDIANPAN" => "",
							"TYPE" => "P",
							"DEFAULTDP" => "NSDL",
							"CDSLDPID" => "",
							"CDSLCLTID" => "",
							"NSDLDPID" => "",						//IN302164
							"NSDLCLTID" => "",						//10295484
							"ACCTYPE_1" => "SB",					//bank.account_type_bse,
							"ACCNO_1" => $acc_no,
							"MICRNO_1" => "",
							"NEFT/IFSCCODE_1" => $ifsc_code,
							"default_bank_flag_1" => "Y",
							"ACCTYPE_2" => "",
							"ACCNO_2" => "",
							"MICRNO_2" => "",
							"NEFT/IFSCCODE_2" => "",
							"default_bank_flag_2" => "",
							"ACCTYPE_3" => "",
							"ACCNO_3" => "",
							"MICRNO_3" => "",
							"NEFT/IFSCCODE_3" => "",
							"default_bank_flag_3" => "",
							"ACCTYPE_4" => "",
							"ACCNO_4" => "",
							"MICRNO_4" => "",
							"NEFT/IFSCCODE_4" => "",
							"default_bank_flag_4" => "",
							"ACCTYPE_5" => "",
							"ACCNO_5" => "",
							"MICRNO_5" => "",
							"NEFT/IFSCCODE_5" => "",
							"default_bank_flag_5" => "",
							"CHEQUENAME" => "",
							"ADD1" => str_replace(","," ",str_replace("-","",$add1)),
							"ADD2" => str_replace(","," ",str_replace("-","",$add2)),
							"ADD3" => str_replace(","," ",str_replace("-","",$add3)),
							"CITY" => $city,
							"STATE" => $state,
							"PINCODE" => $pincode,
							"COUNTRY" => "INDIA",
							"RESIPHONE" => "",
							"RESIFAX" => "",
							"OFFICEPHONE" => "",
							"OFFICEFAX" => "",
							"EMAIL" => $email,
							"COMMMODE" => "M",
							"DIVPAYMODE" => "01",
							"PAN2" => "",
							"PAN3" => "",
							"MAPINNO" => "",
							//"ARNCODE" => "ARN-60277",
							"CM_FORADD1" => "",
							"CM_FORADD2" => "",
							"CM_FORADD3" => "",
							"CM_FORCITY" => "",
							"CM_FORPINCODE" => "",
							"CM_FORSTATE" => "",
							"CM_FORCOUNTRY" => "",
							"CM_FORRESIPHONE" => "",
							"CM_FORRESIFAX" => "",
							"CM_FOROFFPHONE" => "",
							"CM_FOROFFFAX" => "",
							"CM_MOBILE" => $phone);

		$fatcaParam = array("PAN_RP" => $pan,
							"PEKRN" => "",
							"INV_NAME" => $appname1,
							"DOB" => "",
							"FR_NAME" => "",
							"SP_NAME" => "",
							"TAX_STATUS" => $this->CONFIG->taxStatus["Individual"],
							"DATA_SRC" => "E",
							"ADDR_TYPE" => "1",
							"PO_BIR_INC" => "IN",
							"CO_BIR_INC" => "IN",
							"TAX_RES1" => "IN",
							"TPIN1" => $pan,
							"ID1_TYPE" => "C",
							"TAX_RES2" => "",
							"TPIN2" => "",
							"ID2_TYPE" => "",
							"TAX_RES3" => "",
							"TPIN3" => "",
							"ID3_TYPE" => "",
							"TAX_RES4" => "",
							"TPIN4" => "",
							"ID4_TYPE" => "",
							"SRCE_WEALT" => $this->CONFIG->sourceOfWealth["Salary"],
							"CORP_SERVS" => "",
							"INC_SLAB" => "32",
							"NET_WORTH" => "",
							"NW_DATE" => "",
							"PEP_FLAG" => "N",
							"OCC_CODE" => $this->CONFIG->occupationCode["Professional"],
							"OCC_TYPE" => "S",
							"EXEMP_CODE" => "",
							"FFI_DRNFE" => "",
							"GIIN_NO" => "",
							"SPR_ENTITY" => "",
							"GIIN_NA" => "",
							"GIIN_EXEMC" => "",
							"NFFE_CATG" => "",
							"ACT_NFE_SC" => "",
							"NATURE_BUS" => "",
							"REL_LISTED" => "",
							"EXCH_NAME" => "O",
							"UBO_APPL" => "N",
							"UBO_COUNT" => "",
							"UBO_NAME" => "",
							"UBO_PAN" => "",
							"UBO_NATION" => "",
							"UBO_ADD1" => "",
							"UBO_ADD2" => "",
							"UBO_ADD3" => "",
							"UBO_CITY" => "",
							"UBO_PIN" => "",
							"UBO_STATE" => "",
							"UBO_CNTRY" => "",
							"UBO_ADD_TY" => "",
							"UBO_CTR" => "",
							"UBO_TIN" => "",
							"UBO_ID_TY" => "",
							"UBO_COB" => "",
							"UBO_DOB" => "",
							"UBO_GENDER" => "",
							"UBO_FR_NAM" => "",
							"UBO_OCC" => "",
							"UBO_OCC_TY" => "",
							"UBO_TEL" => "",
							"UBO_MOBILE" => "",
							"UBO_CODE" => "",
							"UBO_HOL_PC" => "",
							"SDF_FLAG" => "",
							"UBO_DF" => "",
							"AADHAAR_RP" => "",
							"NEW_CHANGE" => "N",
							"LOG_NAME" => $client_code,
							"DOC1" => "",
							"DOC2" => "");

		$strUserParam ='';
		$strFatcaParam ='';

		while(list($userKey,$userVal) = each($userParam))
		{
			$strUserParam .= $userVal."|";
		}
		while(list($fatcaKey,$fatcaVal) = each($fatcaParam))
		{
			$strFatcaParam .= $fatcaVal."|";
		}

		return array("USER_PARAM" => substr($strUserParam,0,-1), "FATCA_PARAM" => substr($strFatcaParam,0,-1));
	}
	
	function userUpdateBSE($userParam,$fatcaParam)
	{
		$crUserTools = $this->CONFIG->apidir."__ESBTOOL/createUserBSE.py";
		//$crUserCMD = "/usr/local/bin/python3.6 \"".$crUserTools."\" \"".$userParam."\" \"".$fatcaParam."\" 2>&1";
		$crUserCMD = "/var/Python-3.7.4/python \"".$crUserTools."\" \"".$userParam."\" \"".$fatcaParam."\" 2>&1";
		//$crUserCMD = "/usr/local/bin/python2.7 \"".$crUserTools."\" \"".$userParam."\" \"".$fatcaParam."\" 2>&1";
		$output = $this->commonFunction->runInShell($crUserCMD);
		$getError = $this->getBSEErrorMsg($output);
		if($getError !='')
		{
			return $getError;
		}


		$pos1 = strpos($output, "Remote end closed connection without response");
		if ($pos1 === false)
		{
			// do nothing
		}
		else
		{
			//print_r($output);exit;
			return '<div class="alert alert-danger"><button data-dismiss="alert" class="close" type="button"><i class="ace-icon fa fa-times"></i>
					</button><strong><i class="ace-icon fa fa-times"></i>Oh snap!OOPS</strong> Remote end closed connection without response<br></div>';
		}
		$pos = strpos($output, "BSE error 644:");
		if ($pos === false) {
			return '<div class="alert alert-block alert-success"><button data-dismiss="alert" class="close" type="button"><i class="ace-icon fa fa-times"></i>
					</button><p><strong><i class="ace-icon fa fa-check"></i>Success!</strong> User Updated successfully.</p></div>';
		} 
		else 
		{
			$err = explode("unsuccessful:",$output);
			//print_r($err);
			return '<div class="alert alert-danger"><button data-dismiss="alert" class="close" type="button"><i class="ace-icon fa fa-times"></i>
					</button><strong><i class="ace-icon fa fa-times"></i>Oh snap!unsuccessful</strong> '.$err[count($err)-1].'<br></div>';
		}
	}

	/*---------------------------------------------------- New PLace Oder Section ---------------------------------------------------------------------------------------*/
	/*------------------------------------------------------ Add Payment Option ----------------------------------------------------------------------------------------*/
	
	function placeOrderBSE($pipeValues,$getOrderDetails) {
		//echo $c_mode = "sudo su";
		$crUserTools = $this->CONFIG->apidir."__ESBTOOL/orderBSE.py";
		$crUserCMD = " python \"".$crUserTools."\" \"".$pipeValues."\" 2>&1";
		
		//echo "PIPE VALUES";
		/********************************************/
		//echo "<br>CMD:-".$crUserCMD."<br>";
		/********************************************/
		$output = $this->commonFunction->runInShell($crUserCMD);
		// echo "<pre>";
		// print_r($output);
		// echo "</pre>";
		//echo "output:-".$output;
		$getError = $this->getBSEErrorMsg($output,$getOrderDetails);
		//print_r($getError);
		//echo "output:-".$getError;
		//die();
		if($getError !='') {
			return $getError;
		}
		//print_r($output);
		$pos = strpos($output, "Traceback");
		//echo "pos : ".$pos;
		if ($pos > 0) {
			$err = explode("641:",$output);
			$err1 = explode(",",$err[count($err)-1]);
			$msg = str_replace("'","",$err1[count($err1)-2]);
			//echo $msg;
			return $msg;
		} else {
			$c = strpos($output,"[");
			$d = strpos($output,"]");
			$string = substr($output,$c,$d);
			//echo "<br><br>String:-".$string."<br><br>";
			$ba = explode(",",$string);
			//echo "<br><br>$ba:-".$ba."<br><br>";
			$bac = explode(":",$ba['6']);
			//echo "<br><br>$bac:-".$bac."<br><br>";
			$order_id = $bac[9];
			//echo "<br><br>$order_id:-".$order_id."<br><br>";
			$order_id = str_replace("'","",$order_id);
			//echo "<br>Order_id:--";
			//print_r($bac);
			//echo "<br>";
			if(!is_int($order_id)) {
				$order_id = explode(" ", trim($order_id));
				$order_id = $order_id[0];
			}
			return $order_id;
		}
	}
	/*------------------------------------------------------------------Getting payemnet link-------------------------------------------------------------------*/
	function getPLink($pipeValues) {
		//echo "Value:".$pipeValues;
		$crUserTools = $this->CONFIG->apidir."__ESBTOOL/getPlink.py";
		//$crUserCMD = "/usr/lib/python2.7/site-packages/ \"".$crUserTools."\" \"".$pipeValues."\" 2>&1";
		$crUserCMD = "python \"".$crUserTools."\" \"".$pipeValues."\" 2>&1";
		$output = $this->commonFunction->runInShell($crUserCMD);
		// echo "link Data : <pre>";
		// print_r($output);
		// echo "</pre>";
		$getError = $this->getBSEErrorMsg($output,$getOrderDetails['pk_order_id']);
		if($getError !='') {
			return $getError;
		} else {
			$link = explode("|", $output);
			// echo "<br>";
			// print_r($link);
			// echo "<br>";
			/*-----------------------------------------------------------------------------------------------------------------------------------------------------------*/
			$link =  end($link);
			// echo "<br>";
			// echo "Link:".$link;
			// echo "<br>";
			$link = explode("</s:Envelope>", $link);
			// echo "<br>";
			// print_r($link);
			// echo "<br>";
			$link = explode("http", $link[0]);
			$link = $link[1];
		}
		return $link;
	}
	/*---------------------------------------------------- New PLace Oder Section ---------------------------------------------------------------------------------------*/
	/*------------------------------------------------------ Add Payment Option ----------------------------------------------------------------------------------------*/
	function placeSIPOrderBSE($pipeValues,$getOrderDetails,$pay_option=0) {
		$crUserTools = $this->CONFIG->apidir."__ESBTOOL/SIPorderBSE.py";
		//$crUserCMD = "/usr/lib/python2.7/site-packages/ \"".$crUserTools."\" \"".$pipeValues."\" 2>&1";
		$crUserCMD = "python \"".$crUserTools."\" \"".$pipeValues."\" 2>&1";
		//exit;//$crUserCMD = "/usr/local/bin/python2.7 \"".$crUserTools."\" \"".$pipeValues."\" 2>&1";
		/********************************************/
		//echo "CMD:-".$crUserCMD."<br>";
		/********************************************/
		$output = $this->commonFunction->runInShell($crUserCMD);
		//$output = "Forcing soap:address location to HTTPS ['NEW', '1616002723000480', '15133', 'OPMY002052', '1513303', '13704875', 'X-SIP HAS BEEN REGISTERED, REG NO IS : 13704875', '0']";
		// echo "<br>output:";
		// print_r($output);
		$getError = $this->getBSEErrorMsg($output,$getOrderDetails['pk_order_id']);
		//echo "<br> error : ";
		//print_r($getError);
		if($getError !='') {
			return $getError;
		}
		$pos = strpos($output, "Traceback");
		// echo "<br>bse sync pos : ".$pos;
		if ($pos > 0) {
			$err = explode("641:",$output);
			$err1 = explode(",",$err[count($err)-1]);
			$msg = str_replace("'","",$err1[count($err1)-2]);
			//echo "<br>msg : ".$msg;
			return $msg;
			/*-------------------------------------------------------------------------*/
		} else {
			$c = strpos($output,"[");
			$d = strpos($output,"]");
			$string = substr($output,$c,$d);
			//echo "<br><br>String:-".$string."<br><br>";
			$ba = explode(",",$string);
			//echo "<br><br>ba:-".$ba."<br><br>";
			//print_r($ba[5]);
			$order_id = $ba[5];
			//echo "<br><br>$order_id:-".$order_id."<br><br>";
			$order_id = str_replace("'","",$order_id);
			//echo "<br>bse abc : ".$order_id;
			return $order_id;
		}
	}
	/*------------------------------------------------------------------------*/
	function create_ucc($pipeValues) {
		//echo "Value:".$pipeValues;
		$crUserTools = $this->CONFIG->apidir."__ESBTOOL/ucc_create.py";
		//$crUserCMD = "/usr/lib/python2.7/site-packages/ \"".$crUserTools."\" \"".$pipeValues."\" 2>&1";
		$crUserCMD = "python \"".$crUserTools."\" \"".$pipeValues."\" 2>&1";
		$output = $this->commonFunction->runInShell($crUserCMD);
	}
	/*------------------------------------------------------------------------------------------------------------------*/
	/*------------------------------------------------------------------------*/
	function create_mandate($pipeValues)
	{
		//echo "Value:".$pipeValues;
		$crUserTools = $this->CONFIG->apidir."__ESBTOOL/mandate_reg.py";
		//$crUserCMD = "/usr/lib/python2.7/site-packages/ \"".$crUserTools."\" \"".$pipeValues."\" 2>&1";
		$crUserCMD = "python \"".$crUserTools."\" \"".$pipeValues."\" 2>&1";

		$output = $this->commonFunction->runInShell($crUserCMD);
		//print_r($output);
		//die();
		$getError = $this->getBSEErrorMsg($output,$getOrderDetails['pk_order_id']);
		if($getError !='') {
			return $getError;
		}
		$pos = strpos($output, "Exception:");
		//echo "Output :".$output;
		//echo "<br>bse sync pos : ".$pos;
		if ($pos > 0) {
			$err = explode("FAILED:",$output);
			//echo "<br>FAILED:".$err[1];
			return "error#FAILED:".$err[1];
			/*-------------------------------------------------------------------------*/
		} else {
			return $output;
		}
	}
	/*------------------------------------------------------------------------------------------------------------------*/
	/*------------------------------------------------------------------------*/
	function create_fatca($pipeValues)
	{
		//echo "Value:".$pipeValues;
		$crUserTools = $this->CONFIG->apidir."__ESBTOOL/fatca.py";
		//$crUserCMD = "/usr/lib/python2.7/site-packages/ \"".$crUserTools."\" \"".$pipeValues."\" 2>&1";
		$crUserCMD = "python \"".$crUserTools."\" \"".$pipeValues."\" 2>&1";

		$output = $this->commonFunction->runInShell($crUserCMD);
		/*echo "<pre>";
		print_r($output);
		echo "</pre>";*/
	}
	/*------------------------------------------------------------------------------------------------------------------*/
	function child_order($pipeValues) {
		//echo "Value:".$pipeValues;
		$crUserTools = $this->CONFIG->apidir."__ESBTOOL/ChildSIPorderBSE.py";
		//$crUserCMD = "/usr/lib/python2.7/site-packages/ \"".$crUserTools."\" \"".$pipeValues."\" 2>&1";
		$crUserCMD = "python \"".$crUserTools."\" \"".$pipeValues."\" 2>&1";

		$output = $this->commonFunction->runInShell($crUserCMD);
		/*echo "<pre>";
		print_r($output);
		echo "</pre>";*/
	}
	/*---------------------------------------------- Mandate Status ---------------------------------------------------*/

	function mandate_stat($pipeValues)
	{
		//echo "Value:".$pipeValues;
		$crUserTools = $this->CONFIG->apidir."__ESBTOOL/mandate_status.py";
		//$crUserCMD = "/usr/lib/python2.7/site-packages/ \"".$crUserTools."\" \"".$pipeValues."\" 2>&1";
		$crUserCMD = "python \"".$crUserTools."\" \"".$pipeValues."\" 2>&1";

		$output = $this->commonFunction->runInShell($crUserCMD);
		echo "<pre>";
		print_r($output);
		echo "</pre>";
	}

	/*------------------------------------------------ Payment Status -----------------------------------------------------*/
	function p_status($pipeValues)
	{
		//echo "Value:".$pipeValues;
		$crUserTools = $this->CONFIG->apidir."__ESBTOOL/p_status.py";
		//$crUserCMD = "/usr/lib/python2.7/site-packages/ \"".$crUserTools."\" \"".$pipeValues."\" 2>&1";
		$crUserCMD = "python \"".$crUserTools."\" \"".$pipeValues."\" 2>&1";

		$output = $this->commonFunction->runInShell($crUserCMD);
		// echo "<pre>";
		// print_r($output);
		// echo "</pre>";
		return $output;
	}



	/*------------------------------------------ error Meesge ---------------------------------------------------------------*/
	function getBSEErrorMsg($getOutput,$updateStatusBSE='')
	{
		$pos = strpos($getOutput, "640:");
		if ($pos === false)
		{
			return;
		}
		else
		{
			$err = explode("640:",$getOutput); //print_r($err);
			if($updateStatusBSE != '')
			{
				$this->db->db_run_query("UPDATE mf_cart_sys SET bse_remarks = '".str_replace("'","",$err[count($err)-1])."' WHERE	pk_order_id = '".$updateStatusBSE."'");
			}
			return;
		}
	}
}

?>
