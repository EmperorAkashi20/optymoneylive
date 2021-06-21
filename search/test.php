<?php


function url_get_contents ($url) {
    if (function_exists('curl_exec')){ 
        $conn = curl_init($url);
        curl_setopt($conn, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($conn, CURLOPT_FRESH_CONNECT,  true);
        curl_setopt($conn, CURLOPT_RETURNTRANSFER, 1);
        $url_get_contents_data = (curl_exec($conn));
        curl_close($conn);
    }elseif(function_exists('file_get_contents')){
        $url_get_contents_data = file_get_contents($url);
    }elseif(function_exists('fopen') && function_exists('stream_get_contents')){
        $handle = fopen ($url, "r");
        $url_get_contents_data = stream_get_contents($handle);
    }else{
        $url_get_contents_data = false;
    }
return $url_get_contents_data;
} 

$data = url_get_contents('http://www.bsestarmf.in/StarMFPaymentGatewayService/StarMFPaymentGatewayService.svc/GetPassword');
if($data){

$context = stream_context_create(array(
        'http' => array(
            'header' => 'MemberId' => '15133',
                        'PassKey'=> 'MAG4657',
                        'Password'=> '123456',
                        'UserId'=> '1513303'
        )
    ));
    $contents = file_get_contents($url,false,$context);
     
    //If $contents is not a boolean FALSE value.
    if($contents !== false){
        //Print out the contents.
        //echo  $contents;

        $contents = json_decode($contents);
        // echo json_encode($json);

        
    }}
}



?>