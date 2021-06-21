<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://bsestarmf.in/StarMFWebService/StarMFWebService.svc/EMandateAuthURL",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS =>"{\r\n \"ClientCode\":\"test000001\",\r\n \"MandateID\":\"5251657\",\r\n \"MemberCode\":\"15133\",\r\n \"Password\":\"159487!\",\r\n \"UserId\":\"1513303\"\r\n}",
  CURLOPT_HTTPHEADER => array(
    "Content-Type: application/json"
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;
?>