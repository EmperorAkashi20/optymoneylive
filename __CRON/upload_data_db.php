<?php

include("../__lib.includes/config.inc.php");
//phpinfo();
// $commonFunction->runInShell("mkdir 3");
// // mkdir("test");
// if (!is_dir(3))
// {
// 	echo "Not there";
// }
// else
// {
// 	echo "there";
// }

//print_r($CONFIG);
/*$importCAMPath = "/var/www/html/__CRON/mf_data_file/rta_data/KARVY/";
$getCSVFile = $importCAMPath."W0T416.csv";
echo $getCSVFile."<br>";
$RTAName = "karvy";
if (file_exists($getCSVFile)) {
	$newLine = "\n";
	$a = '"';
	$delimeter = "'$a'";
	$d1 = "' '";
	$importSQL = 'LOAD DATA LOCAL INFILE "'.$getCSVFile.'"
	                               INTO TABLE mf_'.strtolower($RTAName).'
	                               FIELDS TERMINATED by \',\' OPTIONALLY ENCLOSED BY '.$delimeter.' 
	                               LINES TERMINATED BY \''.$newLine.'\'  IGNORE 1 LINES;';	
	echo "<br>SQL:-".$importSQL."<br>";
	$run = $CONFIG->db->db_run_query($importSQL);
	$CONFIG->db->db_close();
	if ($run) {
	    echo "<br>HURRAY";
	} else {
	    echo "<br>OOOOPS!SORRY";
	}
} else {
	echo "FILE NOT EXIST";
}
$time = "";*/
// $sch_id = "5";

//  echo "string<br>";
// // //$fetch_portfolio = $mutualFund->fetch_schema_details('1040255974');
// $fetch_portfolio = $mutualFund->fetch_portfolio();
// echo "<pre>";
// print_r($fetch_portfolio);
// echo "</pre>";
//$mutualFund->get_nav_latest('D100');
// while(list($key,$val) = each($fetch_portfolio))
// {
// 	echo "<br>First Key:".$key."<br>";
//     echo "First Val:";
//     print_r($val);
//     echo "<br>";
//     while (list($key1,$val1) = each($val)) 
//     {
//     	echo "<hr><br>Second Key:".$key1."<br>";
// 	    echo "Second Val:";
// 	    print_r($val1);
// 	    echo "<br>";
//     }
// }
echo $mutualFund->updateLiveMFTable(); // run this function after updating of cams, karvy and franklin transaction history top code
//$bseSync->check_kyc();
//print_r($customerProfile->ucc_check());
//eco "string";
// echo "<pre>";
// print_r($mutualFund->fetch_portfolio());
// echo "</pre>";
//$mutualFund->updateCAMData();
// echo "string<br>";
// $payment_status = $buySell->payment_status();
// echo "Payment Status:-".$payment_status;
// $x = $bseSync->p_status($payment_status);
// if(strpos($x,"NOT")=="")
// {
// 	echo "Payment not initiated";
// }
// else
// {
// 	echo "Payment initiated";	
// }
// echo "<br>--------------------------------------------------------------------------------------------------------------------------------<br>";
// $mandate_status = $buySell->mandate_status();
// echo "Mandate Status:-".$mandate_status;
// $bseSync->mandate_stat($mandate_status);
// echo "Date:-".date("d/m/2099");
//$mutualFund->get_per_nav('INF789F01810',1);
//$mutualFund->get_c_amount("B251G");
// $otpnew = "456465";
// $mobno = "8622807690";
// $otp_msg = "Your OTP to Register on OPTYMONEY is ".$otpnew." The OTP will be valid for next 15 mins";
// $url = "https://api-alerts.solutionsinfini.com/v4/?api_key=A97ac1e77641316f29e16438656e2cbb4&method=sms&message=".$otp_msg."&to=".$mobno."&sender=OPTMNY";
// $result = file_get_contents($url);
// print($result);
//echo $buySell->kyc_check('FEPPS4533L');
?>