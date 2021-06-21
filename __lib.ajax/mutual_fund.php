<?php
ob_start();
include("../__lib.includes/config.inc.php");
//include("../__lib.includes/Sms.php");


if($_REQUEST['action'] == 'add_pre_cart') {
	if($_SESSION[$CONFIG->sessionPrefix.'loginstatus'] == "") {
		$_SESSION['cart_details'] = $_POST;
		print_r($_SESSION['cart_details']);
		echo "PASS";
		exit;
	}	
}
if($_REQUEST['action'] == 'add_cart_api') {
	$json = file_get_contents('php://input');
	$data = json_decode($json);
	$mutualFund->cart_query_api($data,1);
}
if($_REQUEST['action'] == 'view_cart_api') {
	$data = json_decode(file_get_contents('php://input'));
	echo json_encode($mutualFund->fetch_cart_api($data));
}
if($_REQUEST['action'] == 'rmv_sch_api') {
	$data = json_decode(file_get_contents('php://input'));
	$mutualFund->cart_query_api($data,2);
}
if($_REQUEST['action'] == 'cart_scheme_count_api') {
	$data = json_decode(file_get_contents('php://input'));
	$mutualFund->fetch_cart_count_api($data->uid);
}


if ($_REQUEST['add_cart']) {
	print_r($_POST);
	//die();
	$mutualFund->cart_query($_POST,1);
}
if ($_REQUEST['rmv_sch'])  {
	echo "string";
	print_r($_POST);
	$s = $mutualFund->cart_query($_POST,2);
	echo "S".$s;
}
if ($_REQUEST['p_to_pay']) {
	//print_r($_POST);
	$cart_details = $mutualFund->fetch_cart(2);
	// echo "<pre>";
	// print_r($cart_details);
	// echo "</pre>";
	$userData = $customerProfile->getCustomerInfo($CONFIG->loggedUserId);
	if($userData['pan_number']=="") {
		$url = $CONFIG->siteurl."mySaveTax/?module_interface=".$commonFunction->setPage('ucc_from');
		header("location:".$url);
	} else {
		// echo $userData['pan_number'];
		$kyc_ck = $buySell->kyc_check($userData['pan_number']);
		$obj = json_decode($kyc_ck);
		// echo $obj->status;
		// echo "res:".$kyc_ck;
		// die();
		if($obj->status ==='failure'){
			$url = $CONFIG->siteurl."mySaveTax/?module_interface=".$commonFunction->setPage('kyc');
			header("location:".$url);
		}
		else { 
			/*------------------------------------ UCC check ----------------------------------*/
			$ucc_check = $customerProfile->ucc_check();
			//echo "bse : ".$ucc_check['bse_id'];
			//echo "mandate : ".$ucc_check['mandate_id'];
			if($ucc_check['bse_id'] == "" || $ucc_check['mandate_id'] == "") {
				//echo "null";
				$url = $CONFIG->siteurl."mySaveTax/?module_interface=".$commonFunction->setPage('ucc_from');
				header("location:".$url);
			}
			else {
				//echo "not null";
				$link = $buySell->createOrder($cart_details);
				// echo "Link :".$link;
				// die();
				$pos = strpos($link, "FAILED");
				//echo "pos : ".$pos;
				if($pos > 0) {
					if($ucc_check['bse_id'] == "" || $ucc_check['mandate_id'] == "") {
						$url = $CONFIG->siteurl."mySaveTax/?module_interface=".$commonFunction->setPage('ucc_from')."&err=".$link;
					} else {
						$url = $CONFIG->siteurl."mySaveTax/?module_interface=".$commonFunction->setPage('cart_sys')."&err=".$link;
					}
					header("location:".$url);
				} else {
					header("location:".$link);
				}
				//echo "Link:-".$link."<br>";
				//die();
			}
		}
	}
	
}

// API
if($_REQUEST['action']== "p_to_pay_api") {
	$json = file_get_contents('php://input');
	$data = json_decode($json);
	// print_r($data);
	// echo $data->uid;
	$cart_details = $mutualFund->fetch_cart_api($data);
	// echo "<pre>";
	// print_r($cart_details);
	// echo "</pre>";
	// die();
	$userData = $customerProfile->getCustomerInfo($data->uid);
	$kyc_ck = $buySell->kyc_check($userData['pan_number']);
	$obj = json_decode($kyc_ck);
	if($obj->status ==='failure'){
		$url = $CONFIG->siteurl."mySaveTax/?module_interface=".$commonFunction->setPage('kyc');
		header("location:".$url);
	}
	else { 
		/*------------------------------------ UCC check ----------------------------------*/
		$ucc_check = $customerProfile->ucc_check_api($data->uid);
		//echo "bse : ".$ucc_check['bse_id'];
		//echo "mandate : ".$ucc_check['mandate_id'];
		if($ucc_check['bse_id'] == "" || $ucc_check['mandate_id'] == "") {
			//echo "null";
			$url = $CONFIG->siteurl."mySaveTax/?module_interface=".$commonFunction->setPage('ucc_from');
			header("location:".$url);
		}
		else {
			$link = $buySell->createOrder_api($cart_details);
			$pos = strpos($link, "FAILED");
			//echo "pos : ".$pos;
			if($pos > 0) {
				if($ucc_check['bse_id'] == "" || $ucc_check['mandate_id'] == "") {
					$url = $CONFIG->siteurl."mySaveTax/?module_interface=".$commonFunction->setPage('ucc_from')."&err=".$link;
				} else {
					$url = $CONFIG->siteurl."mySaveTax/?module_interface=".$commonFunction->setPage('cart_sys')."&err=".$link;
				}
				echo $link;
			} else {
				echo $link;
			}
			//echo "Link:-".$link."<br>";
			//die();
		}
	}
}
if ($_REQUEST['action'] == "p_to_redeem") {
	//print_r($_POST);
	$link = $buySell->createRedemptionOrder($_POST);
}

if ($_REQUEST['action'] == "p_to_redeem_api") {
	$json = file_get_contents('php://input');
	$data = json_decode($json);
	$link = $buySell->createRedemptionOrder_api($data);
}
// if($_REQUEST['x'])
// {
	//$getAcStmtArr = $mutualFund->mfACStmt();
	//print_r($getAcStmtArr);
// }	

if($_POST['process_ucc']==="") {
	print_r($_POST);
	/*------------------------------------ Update data into database------------------------------------------*/
	echo $customerProfile->update_user_deatils($_POST);
	$kyc_ck = $buySell->kyc_check($_POST['pan']);
	$obj = json_decode($kyc_ck);
	echo $obj->status;
	echo "res:".$kyc_ck;
	if($obj->status ==='failure'){
		$url = $CONFIG->siteurl."mySaveTax/?module_interface=".$commonFunction->setPage('kyc');
	}
	else {
		/*-------------------------------Getting value for UCC and Mandte Creation---------------------------------*/
		$ucc_val = $customerProfile->UCC_Mandate();
		/* echo "<pre>";
		print_r($ucc_val);
		echo "</pre>"; */
		//Fetching Cart deatils for identifying Type (SIP or lumsump)
		//$cart_details = $mutualFund->fetch_cart(3);
		//print_r($cart_details);
		/*-------------------------------- Calling API UCC|Fatca|mandate-------------------------------------------*/
		$wealth_val = $buySell->create_user($ucc_val);
	 	if($wealth_val['status']=="failure") {
			$link = explode("#",$wealth_val['mandate_id'])[1];
			$url = $CONFIG->siteurl."mySaveTax/?module_interface=".$commonFunction->setPage('ucc_from')."&err=".$link;
		} else {
			if($wealth_val['status']=="success") {
				$customerProfile->update_ucc_mandate($wealth_val);
				/*----------------------------------------- Calling Create oreder BSE  ------------------------------------*/
				$url = $CONFIG->siteurl."mySaveTax/?module_interface=".$commonFunction->setPage('cart_sys');
			} else {
				echo "Transaction issue... Please Refresh the page";
			}
		}
	}

	header("location:".$url);
}
if($_REQUEST['tran_history'] == 'yes') {
	echo json_encode($mutualFund->fetch_portfolio());
}
if($_REQUEST['view_tran_history'] == 'yes') {
	$scheme_code = base64_decode($_REQUEST['id']);
	$folio = base64_decode($_REQUEST['val']);
	// echo "scheme_code:-".$scheme_code;
	// echo "<br>folio:-".$folio;
	// echo "<br>";
	echo json_encode($mutualFund->fetch_schema_details($scheme_code,$folio));
}
if($_REQUEST['view_tran_history_app'] == 'yes') {
	$scheme_code = base64_decode($_REQUEST['id']);
	$folio = base64_decode($_REQUEST['val']);
	$pan = base64_decode($_REQUEST['pan']);
	// echo "scheme_code:-".$scheme_code;
	// echo "<br>folio:-".$folio;
	// echo "<br>";
	echo json_encode($mutualFund->fetch_schema_details_app($scheme_code,$folio, $pan));
}
?>