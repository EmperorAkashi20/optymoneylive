<?php

/*function generate_hash($xml)
{*/
	$xml = "BQHPA7841M_ITR-1_2020_N_8824.xml";
	$command = 'java -classpath .:"/home/lib/*:/usr/local/src" hashing '.$xml;

	try
	{
		ob_start();
		$output = shell_exec($command);
		ob_end_clean(); 
		//echo "hashing:---".$output;
	}
	catch(Exception $e)
	{
		$output =  'Message: ' .$e->getMessage();
	}
	echo $output;
/*}*/
/*
$xml = "BSJPB7947P_ITR-1_2019_N_8824.xml";
//$command =  //'java -classpath .:"/home/lib/*:/usr/local/src " hashing '.$xml;//' 2>&1';  //'java hashing '.$xml;
  //          'java -classpath target/ hashing '.$xml; 
     
//'java -classpath .:"/home/lib/*:/usr/local/src " hashing '.$xml.' 2>&1';

echo $command."<br>";

try
{
	ob_start();
	//exec($command, $output);

	//ob_end_flush();

	$output = shell_exec($command);
	ob_end_clean(); 
	echo "hashing:---".$output;
	//print_r($output);	
}
catch(Exception $e)
{
	echo 'Message: ' .$e->getMessage();
}
*/
?>