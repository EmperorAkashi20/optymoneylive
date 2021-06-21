<?php
class buySell {
	function buySell() {
		global $CONFIG,$commonFunction,$documentFiles,$customerProfile;
		//global $bseSync;
		global $db;
		$this->db					= $db;
		$this->dbName				= $CONFIG->dbName;
		$this->commonFunction		= $commonFunction;
		$this->CONFIG				= $CONFIG;
		$this->documentFiles		= $documentFiles;
		$this->customerProfile		= $customerProfile;
		//$this->bseSync		        = $bseSync;
		$this->buySell				= array();
	}

	function bse_update_user_api($user_info, $uid) { 
		global $bseSync;
		$this->bseSync = $bseSync;
		/*---------------------------------- UCC creation ------------------------------------------------*/
		$ucc_para = $this->ucc_creation_para_api($user_info, $uid);
		$mandate_id = $this->bseSync->create_ucc($ucc_para);
		/*--------------------------------------- Mandate Creation ---------------------------------------*/
		$mandate_para = $this->mandate_reg($user_info);
		$mandate_id = $this->bseSync->create_mandate($mandate_para);
		$pos = strpos($mandate_id, "FAILED");
		if($pos>0) {
			$val[mandate_id] = $mandate_id;
			$val[status] = "failure";
			return $val;
		} else {
			$val[mandate_id] = $mandate_id;
			$val[status] = "success";
			return $val;
		}
	}

	/*----------------------------------------------------------------------------------------------------------------*/
	function bse_create_user_api($user_info, $uid) { 
		global $bseSync;
		$this->bseSync = $bseSync;
		/*---------------------------------- UCC creation ------------------------------------------------*/
		$ucc_para = $this->ucc_creation_para_api($user_info, $uid);
		$this->bseSync->create_ucc($ucc_para);
		$result = $this->db->db_run_query("update bfsi_user set bse_id='".$this->ucc_n_create_api($uid)."'where pk_user_id ='".$uid."'");
		/*----------------------------------- Send Fatca -------------------------------------------------*/
		$fatca_para = $this->fatca_para($user_info);
		$this->bseSync->create_fatca($fatca_para);
		/*--------------------------------------- Mandate Creation ---------------------------------------*/
		$mandate_para = $this->mandate_reg($user_info);
		$mandate_id = $this->bseSync->create_mandate($mandate_para);
		$pos = strpos($mandate_id, "FAILED");
		if($pos>0) {
			$val[mandate_id] = $mandate_id;
			$val[status] = "failure";
			return $val;
		} else {
			$val[mandate_id] = $mandate_id;
			$val[ucc] = $this->ucc_n_create_api($uid);
			$val[status] = "success";
			return $val;
		}
	}

	/*------------------------ UCC number creation ---------------------------------*/
	function ucc_n_create_api($uid) {
		$num = $uid;
		$x =strlen($num);
		$y=6;
		$z= $y-$x;
		$p = "0";
		for($i=1;$i<$z;$i++) {
		    $p =+ $p.$p;
		}
		$client_code ="OPMY".$p.$num;
		return $client_code;
	}

	/*---------------------------------------- UCC creation Value Parmeter value 06 ---------------------------------------------------*/
	function ucc_creation_para_api($value, $uid){
		if($value[client_code]=="") {
			$client_code = $this->ucc_n_create_api($uid);
		} else {
			$client_code = $value[client_code];
		}
		/*-------------------------- UCC parameters ------------------------------------*/
		if($value['sex'] == "Male") {
			$value['sex'] = "M";
		} else {
			$value['sex'] = "F";
		}
		$transBSEArr = array( 
							"CODE" => $client_code,
							"HOLDING" => $this->CONFIG->clientHolding['Single'],
							"TAXSTATUS" => $this->CONFIG->taxStatus['Individual'],
							"OCCUPATIONCODE" => $this->CONFIG->occupationCode['Service'],
							"APPNAME1" => $value['cust_name'],
							"APPNAME2" => "",
							"APPNAME3" => "",
							"DOB" => date_format(date_create($value['dob']),"d/m/Y"),
							"GENDER" => $value['sex'],
							"FATHER/HUSBAND/gurdian" => "",
							"PAN" => $value['pan_number'],
							"NOMINEE" => $value['nominee_name'],
							"NOMINEE_RELATION" => $value['r_of_nominee_w_app'],
							"GUARDIANPAN" => "",
							"TYPE" => "P",
							"DEFAULTDP" => "",
							"CDSLDPID" => "",
							"CDSLCLTID" => "",
							"NSDLDPID" => "",						//IN302164
							"NSDLCLTID" => "",						//10295484
							"ACCTYPE_1" => "SB",					//bank.account_type_bse,
							"ACCNO_1" => "",
							"MICRNO_1" => "",
							"NEFT/IFSCCODE_1" => "",
							"default_bank_flag_1" => "",
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
							"ADD1" => $value['address1'],
							"ADD2" => $value['address2'],
							"ADD3" => $value['address3'],
							"CITY" => $value['city'],
							"STATE" => $value['state'],
							"PINCODE" => $value['pincode'],
							"COUNTRY" => "INDIA",
							"RESIPHONE" => "",
							"RESIFAX" => "",
							"OFFICEPHONE" => "",
							"OFFICEFAX" => "",
							"EMAIL" => $value['login_id'],
							"COMMMODE" => "E",
							"DIVPAYMODE" => "02",
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
							"CM_MOBILE" => $value['contact_no']);
		$result = $this->db->db_run_query("Select * from bfsi_bank_details where fr_user_id ='".$uid."' order by pk_bank_detail_id asc");
		$total_records = $this->db->db_num_rows($result);
		$i=1;
		while ($row = $this->db->db_fetch_assoc($result)){
			$transBSEArr["ACCTYPE_".$i] = "SB";					//bank.account_type_bse,
			$transBSEArr["ACCNO_".$i] = $row["acc_no"];
			$transBSEArr["MICRNO_".$i] = "";
			$transBSEArr["NEFT/IFSCCODE_".$i] = $row['ifsc_code'];
			if($row['default_bank']==1) {
				$transBSEArr["default_bank_flag_".$i] = "Y";
			} else {
				$transBSEArr["default_bank_flag_".$i] = "N";
			}
			$i++;
		}
		$pipeValues = implode("|",$transBSEArr);		
		return $pipeValues;
	}



	function recomendNAV($REQUEST) {
		//print_r($REQUEST);
		while(list($key,$val) = each($REQUEST[recomend])) {
			if($this->isRecomended($val) == 0) {
				//echo "COUNT:-".$this->isRecomended($val);
				$navDetails = $this->commonFunction->getSingleRow("SELECT * FROM mf_master WHERE pk_nav_id = '".$val."'");
				$this->db->db_run_query("INSERT INTO mf_nav_recomended SET fr_nav_id ='".$navDetails[pk_nav_id]."'");
				//Removing for now value needed
				// $insertedRec = $this->db->db_insert_id();
				// if($this->db->db_num_rows($this->db->db_run_query("SELECT * FROM mf_nav_price WHERE ISIN = '".$navDetails[ISIN]."'")) > 0)
				// {
				// 	$navPrice = $this->commonFunction->getSingleRow("SELECT * FROM mf_nav_price WHERE ISIN = '".$navDetails[ISIN]."' ORDER BY pk_price_id DESC");
				// 	$this->db->db_run_query("UPDATE mf_nav_recomended SET net_asset_value = '".$navPrice[net_asset_value]."',
				// 	repurchase_price = '".$navPrice[repurchase_price]."', sale_price ='".$navPrice[sale_price]."' WHERE pk_recomend_id = '".$insertedRec."'");
				// }
			}
		}
		return "MF Recomended.";
	} 
	/*------------------------------------------------------------------ Update Recomendation ---------------------------------------------------------------*/
	function updateRec($data1) {
		$sql = 'update mf_master set sch_risk="'.$data1[sch_risk].'",sch_category="'.$data1[sch_category].'",sch_popularity="'.$data1[sch_popularity].'",sch_priority="'.$data1[sch_priority].'",sch_fundsize="'.$data1[sch_fund_size].'",offer="'.$data1[offer].'",recommended="'.$data1[recommand].'" where pk_nav_id="'.$data1[pk_nav_id].'"';
		//return $sql;
		$this->db->db_run_query($sql);
		foreach ($data1[offer] as $selectedOption) {
			//echo "offer id : ".$selectedOption."\n";
			$fetch_sql = 'select offer_nav from mf_nav_offer where pk_offer_id="'.$selectedOption.'"';
			$fetch_s_data =  $this->commonFunction->mysqlResultIntoArray($fetch_sql,'SQL');
			if($fetch_s_data[0][offer_nav]=="") {
				$fetch_s_data[0][offer_nav] = $data1[pk_nav_id];
			} else {
				$fetch_s_data[0][offer_nav] = $fetch_s_data[0][offer_nav].",".$data1[pk_nav_id];
			}
			$updateOffer = 'update mf_nav_offer set offer_nav="'.$fetch_s_data[0][offer_nav].'" where pk_offer_id="'.$selectedOption.'"';
			//print_r("nav id : ".$data1[pk_nav_id]."<br>offer_nav : ".$fetch_s_data[0][offer_nav]." sql : ".$updateOffer); 
			$this->db->db_run_query($updateOffer);
		}
		$fetch_sql = "SELECT mf_master.*,mf_nav_offer.offer_name FROM mf_master left join mf_nav_offer on (mf_master.offer=mf_nav_offer.pk_offer_id) where pk_nav_id='".$data1[pk_nav_id]."' AND mf_master.purchase_allowed='Y' AND  mf_master.scheme_plan='NORMAL'";
		$fetch_s_data =  $this->commonFunction->mysqlResultIntoArray($fetch_sql,'SQL');
		return json_encode($fetch_s_data);
	}
	/*------------------------------------------------------------------ Update Recomendation ---------------------------------------------------------------*/
	function isRecomended($getNAVId)
	{
		return $this->db->db_num_rows($this->db->db_run_query("SELECT * FROM mf_nav_recomended WHERE fr_nav_id = '".$getNAVId."'"));
	}
	function getAllRecomendedNAV() {
		$SQL = "SELECT mf_nav_recomended.*,mf_master.* FROM mf_nav_recomended INNER JOIN mf_master
						ON ( mf_nav_recomended.fr_nav_id = mf_master.pk_nav_id )";
		// WHERE mf_nav_recomended.fr_nav_id = 1
		$returnArray =  $this->commonFunction->mysqlResultIntoArray($SQL,'SQL');
		return $returnArray;
	}
	function getAllOfferedNAV($commaSeperatedNavId) {
		$SQL = "SELECT * FROM mf_master WHERE pk_nav_id IN (".$commaSeperatedNavId.")";
		// WHERE mf_nav_recomended.fr_nav_id = 1
		$returnArray =  $this->commonFunction->mysqlResultIntoArray($SQL,'SQL');
		return $returnArray;
	}
	function getNAVAllPrices($getNAVId,$retFields='')
	{
		if($retFields == '')
			$fields = 'net_asset_value,pk_price_id';
		else
			$fields = '*';

		$SQL = "SELECT ".$fields." FROM mf_nav_price WHERE fr_nav_id = '".$getNAVId."' ORDER BY pk_price_id DESC";
		//echo "SQL:-".$SQL."<br>";
		$returnArray =  $this->commonFunction->mysqlResultIntoArray($SQL,'SQL');
		return $returnArray;
	}
	function getNAVPriceWithName($getNAVId,$retFields='')
	{
		if($retFields == '')
			$fields = 'net_asset_value,pk_price_id';
		else
			$fields = '*';

		$SQL = "SELECT ".$fields." FROM mf_nav_price WHERE fr_nav_id = '".$getNAVId."' GROUP BY fr_scheme_name ORDER BY pk_price_id DESC";
		$returnArray =  $this->commonFunction->mysqlResultIntoArray($SQL,'SQL');
		return $returnArray;
	}
	function getSingleNAVDetails($getNAVId)
	{
		$navDetails = array();
		$SQL = "SELECT * FROM mf_master WHERE pk_nav_id = '".$getNAVId."'";
		$navArray =  $this->commonFunction->mysqlResultIntoArray($SQL,'SQL');	// or die(mysql_error());
		$priceSql = "SELECT * FROM mf_nav_price WHERE fr_nav_id = '".$getNAVId."' ORDER BY pk_price_id DESC ";
		$priceArray =  $this->commonFunction->mysqlResultIntoArray($priceSql,'SQL');	// or die(mysql_error());
		$navDetails['MF_DETAILS'] = $navArray;
		$navDetails['MF_PRICE'] = $priceArray;
		return $navDetails;
		//print_r($priceArray);	exit;

	}
	/*----------------------------------------------------------------------------------------------------------------*/
	function create_user($user_info) { 
		global $bseSync;
		$this->bseSync = $bseSync;
		/*echo "User info<pre>";
		print_r($user_info);
		echo "</pre>";*/
		/*---------------------------------- UCC creation ------------------------------------------------*/
		$ucc_para = $this->ucc_creation_para($user_info);
		/*echo "<br>UCC:-";
		echo "<pre>";
		print($ucc_para);
		echo "</pre>";*/
		$this->bseSync->create_ucc($ucc_para);
		//echo "sql : update bfsi_users_details set bse_id='".$this->ucc_n_create()."'where fr_user_id ='".$this->CONFIG->loggedUserId."'";
		$result = $this->db->db_run_query("update bfsi_user set bse_id='".$this->ucc_n_create()."'where pk_user_id ='".$this->CONFIG->loggedUserId."'");
		/*----------------------------------- Send Fatca -------------------------------------------------*/
		$fatca_para = $this->fatca_para($user_info);
		/*echo "<br>Fatca:-";
		echo "<pre>";
		print($fatca_para);
		echo "</pre>";*/
		$this->bseSync->create_fatca($fatca_para);
		/*--------------------------------------- Mandate Creation ---------------------------------------*/
		$mandate_para = $this->mandate_reg($user_info);
		/*echo "<pre>";
		echo $mandate_para;
		echo "</pre>";*/
		$mandate_id = $this->bseSync->create_mandate($mandate_para);
		//echo "<br>MandateID".$mandate_id."<br>";
		$pos = strpos($mandate_id, "FAILED");
		//echo "<br>bse sync pos : ".$pos;
		// /*------------------------------ Mandate Status ---------------------------------------------------*/
		// $m_status_para = $this->mandate_status();
		// echo "<pre>";
		// echo $m_status_para;
		// echo "</pre>";
		// $this->bseSync->mandate_stat($m_status_para);
		if($pos>0) {
			$val[mandate_id] = $mandate_id;
			$val[status] = "failure";
			return $val;
		} else {
			$val[mandate_id] = $mandate_id;
			$val[ucc] = $this->ucc_n_create();
			$val[status] = "success";
			return $val;
		}
		/*if($mandate_id !="") {
			$val[mandate_id] = $mandate_id;
			$val[ucc] = $this->ucc_n_create();
			return $val;
		}*/
	}

	function update_user($user_info) { 
		global $bseSync;
		$this->bseSync = $bseSync;
		/*---------------------------------- UCC creation ------------------------------------------------*/
		$ucc_para = $this->ucc_creation_para($user_info);
		$mandate_id = $this->bseSync->create_ucc($ucc_para);
		/*--------------------------------------- Mandate Creation ---------------------------------------*/
		$mandate_para = $this->mandate_reg($user_info);
		//echo $mandate_para;
		$mandate_id = $this->bseSync->create_mandate($mandate_para);
		//echo "<br>MandateID".$mandate_id;
		$pos = strpos($mandate_id, "FAILED");
		//echo "<br>bse sync pos : ".$pos;
		// /*------------------------------ Mandate Status ---------------------------------------------------*/
		// $m_status_para = $this->mandate_status();
		// echo "<pre>";
		// echo $m_status_para;
		// echo "</pre>";
		// $this->bseSync->mandate_stat($m_status_para);
		if($pos>0) {
			$val[mandate_id] = $mandate_id;
			$val[status] = "failure";
			return $val;
		} else {
			$val[mandate_id] = $mandate_id;
			$val[status] = "success";
			return $val;
		}
		/*if($mandate_id !="") {
			$val[mandate_id] = $mandate_id;
			$val[ucc] = $this->ucc_n_create();
			return $val;
		}*/
	}

	function update_user_info($user_info) { 
		global $bseSync;
		$this->bseSync = $bseSync;
		/*---------------------------------- UCC creation ------------------------------------------------*/
		$ucc_para = $this->ucc_creation_para($user_info);
		//echo "<br>";
		//print($ucc_para);
		$mandate_id = $this->bseSync->create_ucc($ucc_para);
		//echo $mandate_id;
		if($pos>0) {
			$val[mandate_id] = $mandate_id;
			$val[status] = "failure";
			return $val;
		} else {
			$val[mandate_id] = $mandate_id;
			$val[status] = "success";
			return $val;
		}
		/*if($mandate_id !="") {
			$val[mandate_id] = $mandate_id;
			$val[ucc] = $this->ucc_n_create();
			return $val;
		}*/
	}

	/*---------------------------------------------User KYC status check ---------------------------------------------*/
	function kyc_check($chk_PAN) {
		
		/*$kyc_db = $this->commonFunction->mysqlResultIntoArray("SELECT kyc_onboarding_id, kyc_status, nsdl_kyc_res, nsdl_kyc_status FROM bfsi_users_details where fr_user_id='".$this->CONFIG->loggedUserId."'");
		$kyc_status = $kyc_db[0][nsdl_kyc_res]; 
		echo "kyc : ".$kyc_status;
		if ($kyc_status!="") {
			$response_a = "KYC";
		} else { */
			$userId   = $this->CONFIG->NSDLuserId;
			$mobile   = $this->CONFIG->NSDLmobile;
			$password = $this->CONFIG->NSDLpassword;
			// Pass key
			$p_key = date("d").date("y").rand(000000,999999);
			// Request Id
			$request_id = date("Y").rand(000000,999999);
			$wsdl = 'https://kra.ndml.in/sms-ws/PANServiceImplService/PANServiceImplService.wsdl';
			//echo "P key:-".$p_key."<br>";
			//echo "pan1 : ".$chk_PAN;
			//die();
			$context = stream_context_create([
												'ssl' => [
													// set some SSL/TLS specific options
													'verify_peer' => false,
													'verify_peer_name' => true,
													'allow_self_signed' => true
												]
											]);
			$options = array(
								'uri'=>'http://schemas.xmlsoap.org/soap/envelope/',
								'style'=>SOAP_RPC,
								'use'=>SOAP_ENCODED,
								'soap_version'=>SOAP_1_1,
								'cache_wsdl'=>WSDL_CACHE_NONE,
								'connection_timeout'=>15,
								'trace'=>true,
								'encoding'=>'UTF-8',
								'exceptions'=>true,
								'stream_context' => $context
					);  
			$soap = new SoapClient($wsdl, $options); 
			//print_r($soap->__getFunctions());
			try {
				//echo "Password:-".$password."<br>";
				$passKey = $p_key;
				//echo "Request_ID:".$request_id."<br>";
				$passcode_params = array('arg0' => $password, 'arg1' => $passKey);
				$encPass = $soap->getPasscode($passcode_params);            
				$encPassword = $encPass->return;
				//print_r("@@@@@@@@@@      Encrypted Password  :->      ".$encPassword."\r\n<br>");            
				$xml_request =  '<APP_REQ_ROOT>
									<APP_PAN_INQ>
										<APP_PAN_NO>'.$chk_PAN.'</APP_PAN_NO>
										<APP_MOBILE_NO>'.$mobile.'</APP_MOBILE_NO>
										<APP_REQ_NO>'.$request_id.'</APP_REQ_NO>
									</APP_PAN_INQ>
								</APP_REQ_ROOT>';
				//echo "XML:".$xml_request."<br>";
				$params = array('arg0' => $xml_request, 'arg1' => $userId, 'arg2' => $encPassword, 'arg3' => $passKey);
				$data = $soap->panInquiryDetails($params)->return;

				/*---------------------------------  Insert into database -------------------------------------------------------------*/
				$this->db->db_run_query("Insert into kyc_check set kyc_PAN='".$chk_PAN."', req_id='".$request_id."',kyc_res='".$data."'");
				//echo "Insert into kyc_check set kyc_PAN='".$chk_PAN."', req_id='".$request_id."',kyc_res='".$data."'";
				//echo "Insert into kyc_check (`kyc_PAN`,`req_id`,`kyc_res`) Values ('".$chk_PAN."','".$request_id."','".$data."');";
				/*---------------------------------------------------------------------------------------------------------------------*/
				$xml=simplexml_load_string($data) or die("Error: Cannot create object");
				$kyc_status_xml = $xml->APP_PAN_INQ[0]->APP_STATUS; 
				//echo "status : ".$kyc_status_xml;
				//die();
				if(strpos($kyc_status_xml,'Not Available') !== false) {
					$val[status] = "failure";
					$val[msg] =  "Lets Complete Your KYC to Start Investing";	
					$response_a = "KYCNOT";
				} else {
					$val[status] = "success";
					$val[msg] =  "Great !! You are Investment ready ! Lets Start";	
					$response_a = "KYC";
				}
				/* update nsdl status to user details */
				$this->db->db_run_query("update bfsi_users_details set nsdl_kyc_status = '".$response_a."', nsdl_kyc_res='".$kyc_status_xml."' where fr_user_id='".$this->CONFIG->loggedUserId."'");
				//echo "update bfsi_users_details set nsdl_kyc_status='".$response_a."', nsdl_kyc_res='".$kyc_status_xml."' where fr_user_id='".$this->CONFIG->loggedUserId."'";
				//echo "done";
			}
			catch(Exception $e) {
				print_r("@@@@@@@@@@      Exception occured :->      ".$e->getMessage()."\r\n");
				die ($e->getTraceAsString());
			}
		//}
		//die();
        return json_encode($val);
	}
	/*----------------------------------------------------------------------------------------------------------------*/
	function createOrder($userId) {
		// print_r($userId);
		// die();
		// INCLUDE BSE SYNC CLASS
		global $bseSync;
		$this->bseSync = $bseSync;
			
		while (list($key,$val) = each($userId)) {
			//echo"create order<br>";
			//print_r($val);
			// create unqiue id
        	$unique_id = time();
			$unique_id = $unique_id.sprintf('%06d', $val[mf_cart_id]);
			//create reference id
			$ref_no    = date("Ymd")."1".$this->CONFIG->loggedUserId.sprintf('%06d', $val[mf_cart_id]);
			//echo "<br>uniqid:-".$unique_id."<br>";
			//echo "<br>ref_no:-".$ref_no."<br>";
   			if($val[p_method] == 1) { // Lumpsum
				$para_val = $this->lumpsum($val,$unique_id,$ref_no);
				//echo "<br>Lump-Sum:-".$para_val."<br>";
				//echo "<br>cartid:-".$val[mf_cart_id]."<br>";
				$order_id = $this->bseSync->placeOrderBSE($para_val,$val[mf_cart_id]);
				//echo "<br><br><br>order_id:";
				//echo $order_id;
				//die();
				$pos = strpos($order_id, "FAILED");
				//echo "pos : ".$pos;
				if($pos > 0) {
					return $order_id;
				} else {
					$this->db->db_run_query("Update mf_cart_sys set  pipe_val='".$para_val."', bse_order_id='".$order_id."' where mf_cart_id='".$val[mf_cart_id]."'");
				}
				// echo "<br><br>";
				//$this->db->db_run_query("Update mf_cart_sys set cart_status='1', pipe_val='".$para_val."', bse_order_id='".$order_id."' where mf_cart_id='".$val[mf_cart_id]."'");
				//print($r);
				// $transBSEArr = array(
				// 			 "Membercode"		=> "15133",
				// 			 "ClientCode"		=> "DM00000156",
				// 			 "LogOutURL"		=> "https://optymoney.com/mySaveTax/"
				// 				);	
				// $pipeValues = implode("|",$transBSEArr);	
				//echo $pipeValues;
			}
			elseif($val[p_method] == 2) { // SIP
				//$this->sip($userId);
				$para_val = $this->sip($val,$unique_id,$ref_no);
				//print_r($val);
				//echo "<br>Cart Id:-".$val[mf_cart_id]."<br>";
				//echo "<br>para:-".$para_val."<br>";
				$order_id = $this->bseSync->placeSIPOrderBSE($para_val,$val[mf_cart_id]);
				echo "<br>order id : ".$order_id;
				//die();
				$pos = strpos($order_id, "FAILED");
				if($pos > 0) {
					return $order_id;
				} else {
					//echo "update cart";
					$this->db->db_run_query("Update mf_cart_sys set pipe_val='".$para_val."', bse_order_id='".$order_id."' where mf_cart_id='".$val[mf_cart_id]."'");
				}
				//echo "<br>order : ".$order_id;
				//die();
				//echo "<br>SIP<br>";
			}
			$bse_user_id = $val['bse_id'];
        }
		// echo "<br><br><br>BSE Id:".$bse_user_id."<br><br><br>";
		// $sip_Auth_p    = $this->sip_Auth_p($bse_user_id);
		// echo "parameter:-".$sip_Auth_p;
		// $sip_Auth_link = $this->bseSync->sipAuth($sip_Auth_p);
		// print_r($sip_Auth_link);
        $p_link_para = $this->p_link_p($bse_user_id);
        //print_r()
		//echo "P Link".$p_link_para;
		$p_link = $this->bseSync->getPLink($p_link_para);
		$link = 'http'.$p_link;
		return $link;
		//echo "Links:".$link;
		//die();
	}

	function createOrder_api($userId) {
		// INCLUDE BSE SYNC CLASS
		// print_r($userId);
		// die();
		global $bseSync;
		$this->bseSync = $bseSync;
			
		while (list($key,$val) = each($userId)) {
			// print_r($val);
			// die();
			// create unqiue id
        	$unique_id = time();
			$unique_id = $unique_id.sprintf('%06d', $val['mf_cart_id']);
			//create reference id
			$ref_no    = date("Ymd")."1".$this->CONFIG->loggedUserId.sprintf('%06d', $val['mf_cart_id']);
   			if($val['p_method'] == 1) { // Lumpsum
				$para_val = $this->lumpsum($val,$unique_id,$ref_no);
				// echo "Lumpsum : ".$para_val;
				$order_id = $this->bseSync->placeOrderBSE($para_val,$val['mf_cart_id']);
				$pos = strpos($order_id, "FAILED");
				if($pos > 0) {
					return $order_id;
				} else {
					$this->db->db_run_query("Update mf_cart_sys set  pipe_val='".$para_val."', bse_order_id='".$order_id."' where mf_cart_id='".$val[mf_cart_id]."'");
				}
			}
			elseif($val['p_method'] == 2) { // SIP
				//$this->sip($userId);
				$para_val = $this->sip($val,$unique_id,$ref_no);
				echo "SIP : ".$para_val;
				$order_id = $this->bseSync->placeSIPOrderBSE($para_val,$val['mf_cart_id']);
				$pos = strpos($order_id, "FAILED");
				if($pos > 0) {
					return $order_id;
				} else {
					//echo "update cart";
					$this->db->db_run_query("Update mf_cart_sys set pipe_val='".$para_val."', bse_order_id='".$order_id."' where mf_cart_id='".$val[mf_cart_id]."'");
				}
			}
			$bse_user_id = $val['bse_id'];
        }
        $p_link_para = $this->p_link_p($bse_user_id);
		$p_link = $this->bseSync->getPLink($p_link_para);
		$link = 'http'.$p_link;
		echo $link;
	}

	function createRedemptionOrder($userId) {
		$SQL = "INSERT INTO mf_redemption set redeem_amnt='".$userId[redeem_amnt]."', redeem_folio='".$userId[redeem_folio]."', redeem_scheme_id='".$userId[redeem_scheme_id]."', redeem_order_id='".$userId[redeem_order_id]."', redeem_all_amount='".$userId[redeem_all_amount]."', redeem_status='pending', fr_user_id='".$this->CONFIG->loggedUserId."', redeem_usr_ip='".$_SERVER['REMOTE_ADDR']."', redeem_timestamp=now()";
		$redeem_insert_sql = $this->db->db_run_query($SQL);
		$get_id = $this->commonFunction->mysqlResultIntoArray("SELECT * FROM mf_redemption where fr_user_id='".$this->CONFIG->loggedUserId."' order by mf_redeem_id desc limit 1");
		$getbse_id = $this->commonFunction->mysqlResultIntoArray("SELECT * FROM bfsi_user where pk_user_id='".$this->CONFIG->loggedUserId."' limit 1");
		//echo "SELECT * FROM bfsi_user where pk_user_id='".$this->CONFIG->loggedUserId."' limit 1<br>";
		//print_r($getbse_id);
		//echo "<br>";
		$id = $get_id[0][mf_redeem_id];
		$bse_id = $getbse_id[0][bse_id];
		// INCLUDE BSE SYNC CLASS
		global $bseSync;
		$this->bseSync = $bseSync;
		// create unqiue id
		$unique_id = time();
		$unique_id = $unique_id.sprintf('%06d', $id);
		//create reference id
		$ref_no    = date("Ymd")."1".$this->CONFIG->loggedUserId.sprintf('%06d', $id);
		//echo "UserData : ";
		//print_r($userId);
		//echo $userId."---".$unique_id."---".$ref_no."---".$bse_id;
		//echo "<br>";
		/* Redemption Process*/
		$para_val = $this->lumpsumRedemption($userId,$unique_id,$ref_no, $bse_id);
		//echo "<br>Lump-Sum:-".$para_val."<br>";
		//exit;
		//echo "<br>cartid:-".$val[mf_cart_id]."<br>";
		$order_id = $this->bseSync->placeOrderBSE($para_val,$id);
		//echo "<br>Order_id : ".$order_id;
		$pos = strpos($order_id, "FAILED");
		//echo "pos : ".$pos;
		if($pos > 0) {
			$redeem[order_id] = $order_id;
			$redeem[status] = "failure";
		} else {
			$this->db->db_run_query("Update mf_redemption set pipe_val='".$para_val."', redeem_order_id='".$order_id."' where mf_redeem_id='".$id."'");
			$redeem[order_id] = $order_id;
			$redeem[status] = "success";
		}
		echo json_encode($redeem);
    }

	function createRedemptionOrder_api($userId) {
		$SQL = "INSERT INTO mf_redemption set redeem_amnt='".$userId->redeem_amnt."', redeem_folio='".$userId->redeem_folio."', redeem_scheme_id='".$userId->redeem_scheme_id."', redeem_order_id='".$userId->redeem_order_id."', redeem_all_amount='".$userId->redeem_all_amount."', redeem_status='pending', fr_user_id='".$userId->uid."', redeem_usr_ip='".$_SERVER['REMOTE_ADDR']."', redeem_timestamp=now()";
		$redeem_insert_sql = $this->db->db_run_query($SQL);
		$get_id = $this->commonFunction->mysqlResultIntoArray("SELECT * FROM mf_redemption where fr_user_id='".$userId->uid."' order by mf_redeem_id desc limit 1");
		$getbse_id = $this->commonFunction->mysqlResultIntoArray("SELECT * FROM bfsi_user where pk_user_id='".$userId->uid."' limit 1");
		//echo "SELECT * FROM bfsi_user where pk_user_id='".$this->CONFIG->loggedUserId."' limit 1<br>";
		//print_r($getbse_id);
		//echo "<br>";
		$id = $get_id[0][mf_redeem_id];
		$bse_id = $getbse_id[0][bse_id];
		// INCLUDE BSE SYNC CLASS
		global $bseSync;
		$this->bseSync = $bseSync;
		// create unqiue id
		$unique_id = time();
		$unique_id = $unique_id.sprintf('%06d', $id);
		//create reference id
		$ref_no    = date("Ymd")."1".$userId->uid.sprintf('%06d', $id);
		// echo "UserData : ";
		// print_r($userId);
		// echo "---".$unique_id."---".$ref_no."---".$bse_id;
		// echo "<br>";
		/* Redemption Process*/
		$para_val = $this->lumpsumRedemption_api($userId,$unique_id,$ref_no, $bse_id);
		// echo "<br>Lump-Sum:-".$para_val."<br>";
		//echo "<br>cartid:-".$val[mf_cart_id]."<br>";
		$order_id = $this->bseSync->placeOrderBSE($para_val,$id);
		// echo "<br>Order_id : ".$order_id;
		// exit;
		$pos = strpos($order_id, "FAILED");
		//echo "pos : ".$pos;
		if($pos > 0) {
			$redeem[order_id] = $order_id;
			$redeem[status] = "failure";
		} else {
			$this->db->db_run_query("Update mf_redemption set pipe_val='".$para_val."', redeem_order_id='".$order_id."' where mf_redeem_id='".$id."'");
			$redeem[order_id] = $order_id;
			$redeem[status] = "success";
		}
		echo json_encode($redeem);
    }

	/*-------------------------------------------- Lump-Sum parameter-start ---------------------------------------------*/
	function lumpsum($value,$unique_id,$ref_no) {
		
		$transBSEArr = array(
						 "trans_code"			=> "NEW",
						 "trans_no"				=> $unique_id,
						 "OrderId"				=> "",
						 "user_id"				=> $this->CONFIG->bseUserId,
						 "member_id"			=> $this->CONFIG->bseMemberId,
						 "client_code" 			=> $value['bse_id'],
						 "scheme_cd" 			=> $value['scheme_code'],
						 "buy_sell" 			=> "P",
						 "buy_sell_type"		=> "FRESH",
						 "DPTxn"				=> "P",
						 "order_val"			=> $value['amnt'],
						 "QTY"					=> "",
						 "all_redeem" 			=> "N",
						 "FolioNo" 				=> "",
						 "Remarks" 				=> "NEW",
						 "KYCStatus"			=> "Y",
						 "RefNo"				=> $ref_no,
						 "SubBrCode"			=> "",
						 "EUIN"					=> "",
						 "EUINVal"				=> "N",
						 "min_redeem" 			=> "N",
						 "DPC"					=> "N",
						 "IPAdd"				=> $this->CONFIG->loggedIP
						 );

		//echo count($transBSEArr);"192.168.254.222"
		$pipeValues = implode("|",$transBSEArr);		//echo $pipeValues;
		// $pay_option = $_REQUEST['pay_option'];
		// $transaction_detail = $bseSync->placeOrderBSE($pipeValues,$orderDetails,$pay_option);
		return $pipeValues;
	}

	function lumpsumRedemption_api($value,$unique_id,$ref_no,$bse_id) {
		$date = date("d");
		$month = date("m");
		$year = date("Y");
		if ($value->redeem_all_amount == "") {
			$allredeem = "N";
		} else {
			$allredeem = "Y";
		}
		$redeem_date = date($date."/".$month."/".$year);
		if (strpos($value->redeem_scheme_id, '-L1')) {
			$sch_code = explode("-L1",$value->redeem_scheme_id)[0];
			// echo '<br>true : '.$sch_code."<br>";
		} else {
			$sch_code = $value->redeem_scheme_id;
			// echo '<br>false';
		}
		$transBSEArr = array(
						 "trans_code"			=> "NEW",
						 "trans_no"				=> $unique_id,
						 "OrderId"				=> $value->order_id,
						 "user_id"				=> $this->CONFIG->bseUserId,
						 "member_id"			=> $this->CONFIG->bseMemberId,
						 "client_code" 			=> $bse_id,
						 "scheme_cd" 			=> $sch_code,
						 "buy_sell" 			=> "R",
						 "buy_sell_type"		=> "FRESH",
						 "DPTxn"				=> "P",
						 "AMOUNT"				=> $value->redeem_amnt,
						 "QTY"					=> "",
						 "all_redeem" 			=> $allredeem,
						 "FolioNo" 				=> $value->redeem_folio,
						 "Remarks" 				=> "REDEEM",
						 "KYCStatus"			=> "Y",
						 "RefNo"				=> $ref_no,
						 "SubBrCode"			=> "",
						 "EUIN"					=> "",
						 "EUINVal"				=> "N",
						 "min_redeem" 			=> "N",
						 "DPC"					=> "N",
						 "IPAdd"				=> $_SERVER['REMOTE_ADDR']
						 );
		//echo count($transBSEArr);"192.168.254.222"
		// print_r($transBSEArr);
		$pipeValues = implode("|",$transBSEArr);		//echo $pipeValues;
		// $pay_option = $_REQUEST['pay_option'];
		// $transaction_detail = $bseSync->placeOrderBSE($pipeValues,$orderDetails,$pay_option);
		return $pipeValues;
	}

	function lumpsumRedemption($value,$unique_id,$ref_no,$bse_id) {
		$date = date("d");
		$month = date("m");
		$year = date("Y");
		if ($value['redeem_all_amount'] == "") {
			$allredeem = "N";
		} else {
			$allredeem = "Y";
		}
		$redeem_date = date($date."/".$month."/".$year);
		if (strpos($value['redeem_scheme_id'], '-L1')) {
			$sch_code = explode("-L1",$value['redeem_scheme_id'])[0];
			// echo '<br>true : '.$sch_code."<br>";
		} else {
			$sch_code = $value['redeem_scheme_id'];
			// echo '<br>false';
		}
		$transBSEArr = array(
						 "trans_code"			=> "NEW",
						 "trans_no"				=> $unique_id,
						 "OrderId"				=> $value['order_id'],
						 "user_id"				=> $this->CONFIG->bseUserId,
						 "member_id"			=> $this->CONFIG->bseMemberId,
						 "client_code" 			=> $bse_id,
						 "scheme_cd" 			=> $sch_code,
						 "buy_sell" 			=> "R",
						 "buy_sell_type"		=> "FRESH",
						 "DPTxn"				=> "P",
						 "AMOUNT"				=> $value['redeem_amnt'],
						 "QTY"					=> "",
						 "all_redeem" 			=> $allredeem,
						 "FolioNo" 				=> $value['redeem_folio'],
						 "Remarks" 				=> "REDEEM",
						 "KYCStatus"			=> "Y",
						 "RefNo"				=> $ref_no,
						 "SubBrCode"			=> "",
						 "EUIN"					=> "",
						 "EUINVal"				=> "N",
						 "min_redeem" 			=> "N",
						 "DPC"					=> "N",
						 "IPAdd"				=> $this->CONFIG->loggedIP
						 );

		//echo count($transBSEArr);"192.168.254.222"
		//print_r($transBSEArr);
		$pipeValues = implode("|",$transBSEArr);		//echo $pipeValues;
		// $pay_option = $_REQUEST['pay_option'];
		// $transaction_detail = $bseSync->placeOrderBSE($pipeValues,$orderDetails,$pay_option);
		return $pipeValues;
	}
	/*--------------------------------------------- Lump-Sum parameter-end ---------------------------------------------*/

	/*---------------------------------------------- SIP parameter-start -----------------------------------------------*/
	function sip($value,$unique_id,$ref_no) {
		$date = date("d");
		$month = date("m");
		$year = date("Y");
		if ($date >= $value['date_sip']) {
			if ($month >= 12) {
				$month = 1;
				$year = $year+1;
			} else {
				$month =$month +1;
			}
		}
		$start_date = date($value['date_sip']."/".$month."/".$year);
		$transBSEArr = array(
						 "trans_code"			=> "NEW",
						 "trans_no"				=> $unique_id,
						 "scheme_cd" 			=> $value['scheme_code'],
						 "member_id"			=> $this->CONFIG->bseMemberId,
						 "client_code" 			=> $value['bse_id'],
						 "user_id"				=> $this->CONFIG->bseUserId,
						 "INTERNALRefNo"        => "",
						 "Transmode"			=> "P",
						 "DPTxn"                => "P",
						 "Start_date"           => $start_date,
						 "Frequency_type"       => "MONTHLY",
						 "Frequency_allowed"    => "1",
						 "Installment Amount"   => $value['amnt'],
						 "NoOfInstallment"      => "60",
						 "Remarks"              => "",
						 "FolioNo"              => "",
						 "FirstOrderFlag"       => "Y",
						 "Brokerage"			=> "",
						 "MandateID"            => $value['mandate_id'],
						 "SubBrCode"			=> "",
						 "EUIN"                 => "E026834",
						 "EUINVal"              => "N",
						 "DPC"                  => "N",
						 "XsipRegID"            => "",
						 "IPAdd"				=> $this->CONFIG->loggedIP
						 );

		$pipeValues = implode("|",$transBSEArr);		
		//echo $pipeValues;
		return $pipeValues;
	}
	/*---------------------------------------------- SIP parameter-end -------------------------------------------------*/

	/*---------------------------------------------- SIP parameter-start -----------------------------------------------*/
	function sipChild() {
		global $bseSync;
		$this->bseSync = $bseSync;
		/*{
			"Date": "07 JUL 2017",
			"MemberCode": "99999",
			"ClientCode": "457",
			"SystematicPlanType": "XSIP" SystematicPlanType ( SIP, XSIP, ISIP, STP, SWP)
			"RegnNo": "75342",
			"EncryptedPassword": "ScGpdNmUHi5rA5PitbWz3lpDbIGAVSlnIEOuzCXppiza3HyKXCv10A==",
		}*/
		$date = date("d");
		$month = date("m");
		$year = date("Y");
		$start_date = date($date."/".$month."/".$year);
		$transBSEArr = array(
						"Date"					=> $start_date,
						"MemberCode"			=> $this->CONFIG->bseMemberId,
						"ClientCode"			=> $value['bse_id'],
						"SystematicPlanType"	=> "XSIP",// SystematicPlanType ( SIP, XSIP, ISIP, STP, SWP)
						"RegnNo"				=> "XSIP REG_ID",
						"EncryptedPassword"		=> ""
					);
		$pipeValues = implode("|",$transBSEArr);
		//die();
		$data = $this->bseSync->child_order($pipeValues);
		//echo $pipeValues;
		return $pipeValues."____".$data;
	}
	/*---------------------------------------------- SIP parameter-end -------------------------------------------------*/

	/*--------------------------------------- Payemtn gateway link for wealth ------------------------------------------*/
	function p_link_p($value)
	{
		$transBSEArr = array(
							 "Membercode"		=> $this->CONFIG->bseMemberId,
							 "ClientCode"		=> $value,
							 "LogOutURL"		=> $this->CONFIG->bsereturnurl
								);
		$pipeValues = implode("|",$transBSEArr);		

		return $pipeValues;
	}
	/*--------------------------------------- SIP Auth link for wealth not needed ------------------------------------------*/
	function sip_Auth_p($value) {
		$transBSEArr = array(
							 "Action"           => "NEW",
							 "Membercode"		=> $this->CONFIG->bseMemberId,
							 "ClientCode"		=> "1513303",
							 "LogOutURL"		=> $this->CONFIG->bsereturnurl
								);
		$pipeValues = implode("|",$transBSEArr);		
		return $pipeValues;
	}
	/*--------------------------------------- Payment Status for wealth ------------------------------------------*/
	function payment_status($value) {
		$transBSEArr = array(
							 "ClientCode"		=> $value['bse_id'],
							 "OrderNo"          => $value['bse_order_id'],
							 "Segment"          => "BSEMF"
								);
		$pipeValues = implode("|",$transBSEArr);		
		return $pipeValues;
	}
	/*------------------------------------------- Mandate Status-----------------------------------------------------*/

	function mandate_status() {
		$transBSEArr = array(
							 "Membercode"		 => "15133",
							 "ClientCode"        => "OP00000007",
							 "MandateID"         => "640002"
								);
		$pipeValues = implode("|",$transBSEArr);
	}

	/*------------------------ UCC number creation ---------------------------------*/
	function ucc_n_create() {
		$num = $this->CONFIG->loggedUserId;
		$x =strlen($num);
		//echo $x."<br>";
		$y=6;
		//echo $y."<br>";
		$z= $y-$x;
		//echo $z."<br>";
		$p = "0";
		for($i=1;$i<$z;$i++) {
		    $p =+ $p.$p;
		}
		// echo "<br>".strlen($ucc)."<br>";
		// echo $ucc;
		$client_code ="OPMY".$p.$num;
		return $client_code;
	}
	/*------------------------ UCC number creation ---------------------------------*/
	/*---------------------------------------- UCC creation Value Parmeter value 06 ---------------------------------------------------*/
	function ucc_creation_para($value){
		if($value[client_code]=="") {
			$client_code = $this->ucc_n_create();
		} else {
			$client_code = $value[client_code];
		}
		/*-------------------------- UCC parameters ------------------------------------*/
		if($value['sex'] == "Male") {
			$value['sex'] = "M";
		} else {
			$value['sex'] = "F";
		}
		$transBSEArr = array( 
							"CODE" => $client_code,
							"HOLDING" => $this->CONFIG->clientHolding['Single'],
							"TAXSTATUS" => $this->CONFIG->taxStatus['Individual'],
							"OCCUPATIONCODE" => $this->CONFIG->occupationCode['Service'],
							"APPNAME1" => $value['cust_name'],
							"APPNAME2" => "",
							"APPNAME3" => "",
							"DOB" => date_format(date_create($value['dob']),"d/m/Y"),
							"GENDER" => $value['sex'],
							"FATHER/HUSBAND/gurdian" => "",
							"PAN" => $value['pan_number'],
							"NOMINEE" => $value['nominee_name'],
							"NOMINEE_RELATION" => $value['r_of_nominee_w_app'],
							"GUARDIANPAN" => "",
							"TYPE" => "P",
							"DEFAULTDP" => "",
							"CDSLDPID" => "",
							"CDSLCLTID" => "",
							"NSDLDPID" => "",						//IN302164
							"NSDLCLTID" => "",						//10295484
							"ACCTYPE_1" => "SB",					//bank.account_type_bse,
							"ACCNO_1" => "",
							"MICRNO_1" => "",
							"NEFT/IFSCCODE_1" => "",
							"default_bank_flag_1" => "",
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
							"ADD1" => $value['address1'],
							"ADD2" => $value['address2'],
							"ADD3" => $value['address3'],
							"CITY" => $value['city'],
							"STATE" => $value['state'],
							"PINCODE" => $value['pincode'],
							"COUNTRY" => "INDIA",
							"RESIPHONE" => "",
							"RESIFAX" => "",
							"OFFICEPHONE" => "",
							"OFFICEFAX" => "",
							"EMAIL" => $value['login_id'],
							"COMMMODE" => "E",
							"DIVPAYMODE" => "02",
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
							"CM_MOBILE" => $value['contact_no']);
		$result = $this->db->db_run_query("Select * from bfsi_bank_details where fr_user_id ='".$this->CONFIG->loggedUserId."' order by pk_bank_detail_id asc");
		$total_records = $this->db->db_num_rows($result);
		$i=1;
		while ($row = $this->db->db_fetch_assoc($result)){
			$transBSEArr["ACCTYPE_".$i] = "SB";					//bank.account_type_bse,
			$transBSEArr["ACCNO_".$i] = $row["acc_no"];
			$transBSEArr["MICRNO_".$i] = "";
			$transBSEArr["NEFT/IFSCCODE_".$i] = $row['ifsc_code'];
			if($row['default_bank']==1) {
				$transBSEArr["default_bank_flag_".$i] = "Y";
			} else {
				$transBSEArr["default_bank_flag_".$i] = "N";
			}
			$i++;
		}
		//print_r($transBSEArr);
		$pipeValues = implode("|",$transBSEArr);		
		return $pipeValues;
	}
	/*-------------------------------------- Create Fatca Parameter ---------------------------------------------------*/

	function fatca_para($value)	{
		$client_code = $this->ucc_n_create();
		/*---------------------------------------Code 01 for fatca -------------------------------*/
			$transBSEArr = array("PAN_RP" => $value['pan_number'],
							"PEKRN" => "",
							"INV_NAME" => $value['cust_name'],
							"DOB" => "",
							"FR_NAME" => "",
							"SP_NAME" => "",
							"TAX_STATUS" => $this->CONFIG->taxStatus["Individual"],
							"DATA_SRC" => "E",
							"ADDR_TYPE" => "1",
							"PO_BIR_INC" => "IN",
							"CO_BIR_INC" => "IN",
							"TAX_RES1" => "IN",
							"TPIN1" => $value['pan_number'],
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
							"OCC_CODE" => $this->CONFIG->occupationCode["Service"],
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
							"UBO_DF" => "N",
							"AADHAAR_RP" => "",
							"NEW_CHANGE" => "N",
							"LOG_NAME" => $client_code,
							"DOC1" => "",
							"DOC2" => "");
		$pipeValues = implode("|",$transBSEArr);		
		return $pipeValues;
	}

	/*--------------------------------------- Mandate Registration for wealth value 2------------------------------------------*/
	function mandate_reg($value) {
		if($value[client_code]=="") {
			$client_code = $this->ucc_n_create();
		} else {
			$client_code = $value[client_code];
		}
		$transBSEArr = array(			
							 "ClientCode"		=> $client_code,
							 "amount"           => "100000",
							 "mandate_type"     => "N",
							 "acc_no"           => $value['acc_no'],
							 "acc_type"         => "SB",
							 "IFSC"             => $value['ifsc_code'],
							 "MICR"             => "",
							 "start_date"       => date("d/m/Y"),
							 "end_date"         => "31/12/2099",
								);
		$pipeValues = implode("|",$transBSEArr);		
		return $pipeValues;
	}

	/*-----------------------------------------------------------------------------------------------------------------*/
	function orderListCount($userId='')
	{
		if($userId == '')
			$SQL = "SELECT COUNT(*) as count FROM mf_order ORDER BY pk_order_id DESC";
		else
			$SQL = "SELECT COUNT(*) as count FROM mf_order WHERE fr_user_id = '".$userId."' ORDER BY pk_order_id DESC";

		$result1 = $this->db->db_run_query($SQL);	// or die(mysql_error());
		$r1 = $this->db->db_fetch_array($result1);
		$count1=(int)$r1['count'];
		return $count1;
	}
	function orderList($userId='')
	{
		if($userId == '')
			$SQL = "SELECT * FROM mf_order ORDER BY pk_order_id DESC ";
		else
			$SQL = "SELECT * FROM mf_order WHERE fr_user_id = '".$userId."' ORDER BY pk_order_id DESC";

		$countSearch = $this->orderListCount($getRequest);

		if($countSearch > 0)
		{
			$navArray =  $this->commonFunction->mysqlResultIntoArray($SQL,'SQL');
		}
		else
			$navArray = array("MF_NONE");

		//print_r($folioArray);
		return $navArray;
	}
}

?>
