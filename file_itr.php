<?php
include("zipcreation.php");
$final_path = "BQHPA7841M_ITR-1_2020_N_8824.zip";//.$zip_file;
if(file_exists($final_path))
{
	echo "Exist";
}
else
{
	echo "Not Exist";
}
$rand_name = "BQHPA7841M_ITR-1_2020_N_8824.zip";

echo "<br>Rand Name:-".$rand_name."<br>";

$destination =  "zip/".$rand_name;

echo "<br>Destination:-".$destination."<br>";

$files_to_zip = array($xml_path);



// $result = create_zip($files_to_zip,$destination);            // Calling the function for creating zip

// //header("Content-Type: application/zip");
// $zip_file = $xml_name.".zip";

// if(file_exists($destination."/".$zip_file))
// {
// 	echo "ZIP file Exist";
// }
// else
// {
// 	echo "ZIP file Not Exist";
// }

$command = 'java -cp /var/www/html/itr_new.jar bulkItrService.BulkItrService_Client';
echo "<br>Command:-".$command."<br>";
try
			{
				ob_start();
				$output = shell_exec($command);
				ob_end_clean(); 	
				echo "<pre>".$output."</pre>";	
			}
			catch(Exception $e)
			{
				echo 'Message: ' .$e->getMessage();
			}
?>