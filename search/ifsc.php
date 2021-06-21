<?php

  //      'headers' => [
         
  //       'Content-Type'     => 'application/json',
  //         'DY-X-Authorization'      => 'f48fb01da2304bdbe71cd3b5b083b33c6b1a61e5'
  //     ];
  //     $header = array();
  // $header[] = 'Content-length: 0';
  // $header[] = 'Content-type: application/json';
  //  $header[] = 'DY-X-Authorization: f48fb01da2304bdbe71cd3b5b083b33c6b1a61e5';
 
 if(!empty($_GET['ifsc'])){

  	//The URL with parameters / query string.
	$url = 'https://ifsc.datayuge.com/api/v1/'.$_GET['ifsc'];
	 
	//Once again, we use file_get_contents to GET the URL in question.

	$context = stream_context_create(array(
	    'http' => array(
	        'header' => "DY-X-Authorization: f48fb01da2304bdbe71cd3b5b083b33c6b1a61e5"
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
?>	

 




 Bank : <input type="text" value="<?php echo $contents->bank; ?>" name="bank"><br>
 Micr : <input type="text" value="<?php echo $contents->micr; ?>" name="micr"><br>

 Ifsc : <input type="text" value="<?php echo $contents->ifsc; ?>" name="ifsc"><br>

 branch : <input type="text" value="<?php echo $contents->branch; ?>" name="branch"><br>

 address : <input type="text" value="<?php echo $contents->address; ?>" name="address"><br>
 city : <input type="text" value="<?php echo $contents->city; ?>" name="city"><br>
 district : <input type="text" value="<?php echo $contents->district; ?>" name="district"><br>
 state : <input type="text" value="<?php echo $contents->state; ?>" name="state"><br>

 






 


 