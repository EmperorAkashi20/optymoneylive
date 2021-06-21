<?php

	include("../__lib.includes/config.inc.php");
	if(!($_SESSION['oPageAccess'])) { header("HTTP/1.1 401 Unauthorized");header("Location: $CONFIG->siteurl");exit;}

	//print_r($_SESSION);//
	// echo $CONFIG->loggedUserId;
	// echo "<pre>";//print_r($_POST);	//
	// print_r($_REQUEST);
	// echo "<pre>";

	$LIVE		= 1;	//0 = testing; 1 = live
	/*$MEMBERID	= '15133';
	$USERID		= '1513303';
	$PASSWORD	= '123456';*/
	$MEMBERID	= array('15133', '15133');
	$USERID		= array('1513301', '1513303');
	$PASSWORD	= array('123456!', '123456%');
	$PASSKEY= 'tns'.rand(0000,9999);



	$navDetails1			= $buySell->getSingleNAVDetails($_REQUEST['nav_id']);
	$navDetails				= $navDetails1['MF_DETAILS'];
	$navPrice				= $navDetails1['MF_PRICE'];

	$orderDetails	 		= $buySell->createOrder($CONFIG->loggedUserId,$navDetails,$navPrice,'Pending',$_REQUEST['nav_amount']);
	/*echo "<br>Order Details:-";
	print_r($orderDetails);
	die();*/
	$transactionNoBSE		= $orderDetails[unique_id];	//time();
	$refNo					= $orderDetails[ref_no]; //date("Ymd")."1".$CONFIG->loggedUserId.sprintf('%06d', $internalOrderNum[pk_order_id]);
	$userDetails 			= $customerProfile->getPotalUserDetails($CONFIG->loggedUserId);
	$clientCode				= $userDetails[bse_id];
	$mandate_id				= $userDetails[mandate_id];

	//echo "Scheme_code:-".$navDetails[0]['Scheme_Code'];

	if($_REQUEST['pay_option'] == "one_time")
	{

		$transBSEArr = array(
						 "trans_code"			=> "NEW",
						 "trans_no"				=> $transactionNoBSE,
						 "OrderId"				=> "",
						 "user_id"				=> $USERID[$LIVE],
						 "member_id"			=> $MEMBERID[$LIVE],
						 "client_code" 			=> $clientCode,
						 "scheme_cd" 			=> $navDetails[0]['scheme_code'],
						 "buy_sell" 			=> "P",
						 "buy_sell_type"		=> "FRESH",
						 "DPTxn"				=> "P",
						 "order_val"			=> $_REQUEST['nav_amount'],
						 "QTY"					=> "",
						 "all_redeem" 			=> "N",
						 "FolioNo" 				=> "",
						 "Remarks" 				=> "NEW",
						 "KYCStatus"			=> "Y",
						 "RefNo"				=> $refNo,
						 "SubBrCode"			=> "",
						 "EUIN"					=> "",
						 "EUINVal"				=> "N",
						 "min_redeem" 			=> "N",
						 "DPC"					=> "N",
						 "IPAdd"				=> $CONFIG->loggedIP
						 );

		//echo count($transBSEArr);"192.168.254.222"
		$pipeValues = implode("|",$transBSEArr);		//echo $pipeValues;
		$pay_option = $_REQUEST['pay_option'];
		$transaction_detail = $bseSync->placeOrderBSE($pipeValues,$orderDetails,$pay_option);
		//echo $transaction_details;		//,$pipeValues;
		//echo "One Time";
		if ($transaction_detail == "success") 
		{
			$transBSEArr = array(
							 "Membercode"		=> "15133",
							 "ClientCode"		=> $clientCode,
							 "LogOutURL"		=> "https://optymoney.com/mySaveTax/"
								);	
			$pipeValues = implode("|",$transBSEArr);	
			//echo $pipeValues;
			$transaction_details = $bseSync->getPLink($pipeValues);
			//echo "<br>PipeValues:-".$pipeValues."<br>";
			//$transaction_details = $bseSync->getPLink($pipeValues,$orderDetails,$pay_option);
			echo $transaction_details;		//,$pipeValues;
			//echo "One Time";
		}

	}
	else
	{
		$day = 10;
        $date = date("d");
		$month = date("m");
		$year = date("Y");
        echo $year;
		if ($date > 10) 
		{
			if ($month >= 12) 
			{
				$month = 1;
				$year = $year+1;
			}else
			{
				$month =$month +1;
			}

		}
		$start_date = date($day."/".$month."/".$year);
		$transBSEArr = array(
						 "trans_code"			=> "NEW",
						 "trans_no"				=> $transactionNoBSE,
						 "scheme_cd" 			=> $navDetails[0]['scheme_code'],
						 "member_id"			=> $MEMBERID[$LIVE],
						 "client_code" 			=> $clientCode,
						 "user_id"				=> $USERID[$LIVE],
						 "INTERNALRefNo"        => "",
						 "Transmode"			=> "P",
						 "DPTxn"                => "P",
						 "Start_date"           => $start_date,
						 "Frequency_type"       => "MONTHLY",
						 "Frequency_allowed"    => "1",
						 "Installment Amount"   => $_REQUEST['nav_amount'],
						 "NoOfInstallment"      => "60",
						 "Remarks"              => "",
						 "FolioNo"              => "",
						 "FirstOrderFlag"       => "Y",
						 "Brokerage"			=> "",
						 "MandateID"            => $mandate_id,
						 "SubBrCode"			=> "",
						 "EUIN"                 => "E026834",
						 "EUINVal"              => "N",
						 "DPC"                  => "N",
						 "XsipRegID"            => "",
						 "IPAdd"				=> $CONFIG->loggedIP
						 );



		//echo count($transBSEArr);"192.168.254.222"
		$pipeValues = implode("|",$transBSEArr);		//echo $pipeValues;
		$pay_option = $_REQUEST['pay_option'];
		$transaction_detail = $bseSync->placeSIPOrderBSE($pipeValues,$orderDetails,$pay_option);
		//echo $transaction_details;		//,$pipeValues;
		if ($transaction_detail == "success") 
		{
			$transBSEArr = array(
							 "Membercode"		=> "15133",
							 "ClientCode"		=> $clientCode,
							 "LogOutURL"		=> "https://optymoney.com/mySaveTax/"
								);	
			$pipeValues = implode("|",$transBSEArr);		//echo $pipeValues;
			$transaction_details = $bseSync->getPLink($pipeValues);
			//echo "<br>PipeValues:-".$pipeValues."<br>";
			//$transaction_details = $bseSync->getPLink($pipeValues,$orderDetails,$pay_option);
			echo $transaction_details;		//,$pipeValues;
			//echo "One Time";
		}
	}
?>
