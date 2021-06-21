<?php

include("../__lib.includes/config.inc.php");

$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => "https://bsestarmf.in/RPTNAVMASTER.aspx",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "__VIEWSTATE=8W8ftWTuqDSHVu4vr4l5dqIA6QtFU3gU5POJ8qjASqutwKjt%2FSfrs89sWW7pKI33Qx1Qhn6zWDavJf%2Flim1dUOW%2BCkqQSDTlxgRMbd5mcg8mdu1zbpmw48hnBBoxk01HZUcKCw%3D%3D&__VIEWSTATEGENERATOR=8EE3ED57&__VIEWSTATEENCRYPTED=&__EVENTVALIDATION=%2BaAQyJDFUdIbvGKQVluXs3bib4BsgkBXII12LqjUFiEn9nQsBRDbcGTTdDQCW7ckFdiM4k5Mgo7SC%2BOqfSU%2B4RKO%2FzYPdkMLGlGnTuSmB8QiaXo4Mt6nRqoQcJI6J1l%2FtlgqXT3qvRyn8z%2B0D96idERnlrTPGDN1iDstvqJuj2f81eMn&txtToDate=22-Apr-2021&btnText=Export+to+Text",
  CURLOPT_HTTPHEADER => array(
    "cache-control: no-cache",
    "content-type: application/x-www-form-urlencoded",
    "postman-token: 705f867f-1c65-cfc8-73a2-6be3fdbc2b83"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);
echo "Date : ".date("Y-m-d");
//exit;
curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  $res = explode(PHP_EOL, $response);
  foreach($res as $data){
    $dataArr = explode('|', $data);
    //print_r($dataArr);
    $sqlNavPrice	= "SELECT * FROM mf_master WHERE isin = '".$dataArr[5]."'";
		$navPriceResult = $db->db_run_query($sqlNavPrice);
    //echo "MF_Master : SELECT * FROM mf_master WHERE isin = '".$dataArr[5]."'<br>";
		while($val = $db->db_fetch_array($navPriceResult)) {
      //print_r($val);
      $sqlNavPrice1	= "SELECT * FROM mf_nav_price WHERE price_date= '".$dataArr[0]."'and dividend_reinvest='".$dataArr[4]."'and isin = '".$dataArr[5]."'";
      //echo "sql : ".$sqlNavPrice1. "<br>";
		  $navPriceResult = $db->db_run_query($sqlNavPrice1);
      if($db->db_fetch_array($navPriceResult)) {
        echo "exist";
      } else {
        $res = $db->db_run_query("INSERT INTO mf_nav_price SET fr_nav_id = '".$val[pk_nav_id]."',price_date= '".$dataArr[0]."',net_asset_value='".$dataArr[6]."',sale_price='0',
										dividend_reinvest='".$dataArr[4]."',fr_unique_no='".$val[unique_no]."',repurchase_price=0,fr_scheme_code='".$val[scheme_code]."',
										fr_scheme_name='".addslashes($val[scheme_name])."',ISIN = '".$dataArr[5]."'");
        echo "Result : ".$res;
        echo "<br><br>INSERT INTO mf_nav_price SET fr_nav_id = '".$val[pk_nav_id]."',price_date= '".$dataArr[0]."',net_asset_value='".$dataArr[6]."',sale_price='0',
          dividend_reinvest='".$dataArr[4]."',fr_unique_no='".$val[unique_no]."',repurchase_price=0,fr_scheme_code='".$val[scheme_code]."',
          fr_scheme_name='".addslashes($val[scheme_name])."',ISIN = '".$dataArr[5]."'<br><br>";
      }
    }
  }
}
?>