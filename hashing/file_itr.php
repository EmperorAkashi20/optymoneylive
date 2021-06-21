<?php
$final_path = "BQHPA7841M_ITR-1_2020_8824.zip";//.$zip_file;
if(file_exists($final_path))
{
	echo "Exist";
}
else
{
	echo "Not Exist";
}

$command = 'java -jar ITRCON.jar '.$final_path;
echo "<br>Command:-".$command."<br>";
try
			{
				ob_start();
				$output = shell_exec($command);
				ob_end_clean(); 	
				echo $output;	
			}
			catch(Exception $e)
			{
				echo 'Message: ' .$e->getMessage();
			}
?>