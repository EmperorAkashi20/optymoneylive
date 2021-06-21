<?php
	include("__lib.includes/config.inc.php");
	/*---------------------------------inculde zip file creation function-BSEN----------------------------------------*/	
	include("zipcreation.php");
	/*---------------------------------inculde file creation Hashing-BSEN----------------------------------------*/	
	include("hashing.php");
	if(!($_SESSION['oPageAccess'])) { header("HTTP/1.1 401 Unauthorized");header("Location: $CONFIG->siteurl");exit;}
	ini_set("display_errors",1);
	//error_reporting(E_ALL);
	//include("__lib.ajax/inc.summary_calc.php");

//print_r($_POST);
if(isset($_POST['xml-data']))
{
	
	/*----------------------------------- 20190220-BSEN -------------------------------------*/
	$xml = $_POST['xml-data'];

	$xml_string = '<?xml version="1.0" encoding="UTF-8"?><ns3:ITR xmlns:ns3="http://incometaxindiaefiling.gov.in/main" xmlns="http://incometaxindiaefiling.gov.in/master" xmlns:ns2="http://incometaxindiaefiling.gov.in/ITR1">
    <ns2:ITR1><CreationInfo><SWVersionNo>101</SWVersionNo><SWCreatedBy>SW10001886</SWCreatedBy><XMLCreatedBy>SW10001886</XMLCreatedBy><XMLCreationDate>'.date("Y-m-d").'</XMLCreationDate><IntermediaryCity>BANGALORE</IntermediaryCity>
			<Digest>-</Digest></CreationInfo><Form_ITR1><FormName>ITR-1</FormName><Description>For Indls having Income from Salary, Pension, family pension and Interest</Description><AssessmentYear>2019</AssessmentYear><SchemaVer>Ver1.0</SchemaVer><FormVer>Ver1.0</FormVer></Form_ITR1>'.$_POST['xml-data'].'</ns2:ITR1>
</ns3:ITR>';

	$xml_string = preg_replace('/[\s]+/', ' ', $xml_string);

	//echo $_POST['pan'];
	/*$xml_string = '<?xml version="1.0" encoding="UTF-8" standalone="no"?><ITRETURN:ITR xmlns:ITRETURN="http://incometaxindiaefiling.gov.in/main" xmlns:ITR1FORM="http://incometaxindiaefiling.gov.in/ITR1" xmlns="http://incometaxindiaefiling.gov.in/master" xsi:schemaLocation="http://incometaxindiaefiling.gov.in/master schema.xsd" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"><ITR1FORM:ITR1><CreationInfo><SWVersionNo>101</SWVersionNo><SWCreatedBy>SW10001886</SWCreatedBy><XMLCreatedBy>SW10001886</XMLCreatedBy><XMLCreationDate>'.date("Y-m-d").'</XMLCreationDate><IntermediaryCity>BANGALORE</IntermediaryCity>
			<Digest>-</Digest></CreationInfo><Form_ITR1><FormName>ITR-1</FormName><Description>For Indls having Income from Salary, Pension, family pension and Interest</Description><AssessmentYear>2019</AssessmentYear><SchemaVer>Ver1.0</SchemaVer><FormVer>Ver1.0</FormVer></Form_ITR1>'.$_POST['xml-data'].'</ITR1FORM:ITR1></ITRETURN:ITR>';*/
	
	//Replace & with &amp; to avoid XML validation issues
	$xml_string = str_replace("&","&amp;",$xml_string);
	
	//echo "XML:-".$xml_string;

	$doc = new DOMDocument();
	$doc->preserveWhiteSpace = false;
	$doc->formatOutput = true;	
	$doc->loadXML($xml_string);	
	//echo "After XML:-";
	//print_r($doc);
	//die();
	$xml_name = $_POST['pan']."_ITR-1_".date('Y')."_N_8824";
		
		
	//$xml_path = "itrxmls/".$xml_name.".xml";

	$xml_path = "itrxmls/".$xml_name.".xml";
	if($doc->save($xml_path))
	{
		$get_hash = generate_hash($xml_path);
        $xml_pan = $_POST['pan'];
        //$x = $commonFunction->xmlUpload($xml_path,$xml_pan);
        
        //echo "Result:-".$x;
      
        //echo $upload_xml;
        //die();
		//unlink($xml_path);

		/*$xml_string = '<?xml version="1.0" encoding="UTF-8" standalone="no"?><ITRETURN:ITR xmlns:ITRETURN="http://incometaxindiaefiling.gov.in/main" xmlns:ITR1FORM="http://incometaxindiaefiling.gov.in/ITR1" xmlns="http://incometaxindiaefiling.gov.in/master" xsi:schemaLocation="http://incometaxindiaefiling.gov.in/master schema.xsd" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"><ITR1FORM:ITR1><CreationInfo><SWVersionNo>101</SWVersionNo><SWCreatedBy>SW10001886</SWCreatedBy><XMLCreatedBy>SW10001886</XMLCreatedBy><XMLCreationDate>'.date("Y-m-d").'</XMLCreationDate><IntermediaryCity>BANGALORE</IntermediaryCity>
			<Digest>'.trim($get_hash).'</Digest></CreationInfo><Form_ITR1><FormName>ITR-1</FormName><Description>For Indls having Income from Salary, Pension, family pension and Interest</Description><AssessmentYear>'.date("Y").'</AssessmentYear><SchemaVer>Ver1.0</SchemaVer><FormVer>Ver1.0</FormVer></Form_ITR1>'.$_POST['xml-data'].'</ITR1FORM:ITR1></ITRETURN:ITR>';*/


		$xml_string = '<?xml version="1.0" encoding="UTF-8"?><ns3:ITR xmlns:ns3="http://incometaxindiaefiling.gov.in/main" xmlns="http://incometaxindiaefiling.gov.in/master" xmlns:ns2="http://incometaxindiaefiling.gov.in/ITR1">
    <ns2:ITR1><CreationInfo><SWVersionNo>101</SWVersionNo><SWCreatedBy>SW10001886</SWCreatedBy><XMLCreatedBy>SW10001886</XMLCreatedBy><XMLCreationDate>'.date("Y-m-d").'</XMLCreationDate><IntermediaryCity>BANGALORE</IntermediaryCity>
			<Digest>'.trim($get_hash).'</Digest></CreationInfo><Form_ITR1><FormName>ITR-1</FormName><Description>For Indls having Income from Salary, Pension, family pension and Interest</Description><AssessmentYear>2019</AssessmentYear><SchemaVer>Ver1.0</SchemaVer><FormVer>Ver1.0</FormVer></Form_ITR1>'.$_POST['xml-data'].'</ns2:ITR1>
</ns3:ITR>';

		//$xml_string = str_replace("&","&amp;",$xml_string);

		$xml_string = preg_replace('/[\s]+/', ' ', $xml_string);
		
		$doc = new DOMDocument();
		$doc->preserveWhiteSpace = false;
		$doc->formatOutput = true;	
		$doc->loadXML($xml_string);	
	}

	if(isset($_POST['pan']))
	{
		$xml_name = $_POST['pan']."_ITR-1_".date('Y')."_N_8824";
	
		//$xml_path = "itrxmls/".$xml_name.".xml";
		//$xml_path = "itrxmls/".$xml_name.".xml";
		$xml_path = $xml_name.".xml";
		if($doc->save($xml_path))
		if($xml_name)
		{
			chmod($xml_path, 0775);
			
			$x = $commonFunction->xmlUpload($xml_path,$xml_pan);
			$destination =  "zip";
			//$result = create_zip($xml_path,$xml_name.'.zip');

			/*-------------------------------------------------*/


			$files_to_zip = array($xml_path);  // add the xml to creation of zip
			
			//if true, good; if false, zip creation failed
 
						//$rand_name = rand(0,10000);       

						//$rand_name = "ITR-".$rand_name."-".date("Y-m-d").".ZIP";     // create random name for the zip file

			$rand_name = $xml_name.".zip";					


			$result = create_zip($files_to_zip,$destination.'/'.$rand_name);            // Calling the function for creating zip

			//unlink($xml_path);


			//header('Content-Description: File Transfer');
			header("Content-Type: application/zip");
						


			/*-------------------------------------------------

				if ($result) 
				{
					echo "String";
				}
				else
				{
					echo "Faliure";
					//print_r($result);
				}
			/*---------------------------------------------------*/
			/*-------------------- Remove the XML -----------------------------*/
			unlink($xml_path);

			$zip_file = $xml_name.".zip";
			//chmod($zip_file, 0777);
			$final_path = "zip/".$zip_file; 
			chmod($final_path, 0775);
			if($final_path) 
			{
				
				$command = 'java -jar bulkitr_newer.jar '.$final_path;
				//$output = $_POST['pan'];
			}
			else
			{

			}

			
			/*$output = "success";*/
			/*
			TO DO 
			Select from bfsi-itr where pan condition and AY  fetch Xml data
			*/
			//echo "SQL:-".$x;
			/*$output = $_POST['pan'];
			echo $output;*/

			/*$command = 'java -classpath .:"/home/lib/*:/usr/local/src" bulkItrService.BulkItrService_Client '.$xml_name.' 2>&1';*/			
						
			try
			{
				ob_start();
				$output = shell_exec($command);
				ob_end_clean(); 	
				//echo $output;	

				if ($output) 
				{
					$toke_res = $commonFunction->update_token($output,$xml_pan);
					$output = $_POST['pan'];
					echo $output;
				}
			}
			catch(Exception $e)
			{
				echo 'Message: ' .$e->getMessage();
			}
		}

		else
		{
			echo "Error processing xml file";
		}		
	}
	else
	{
		header("Content-Type: application/xml");
		header('Content-Disposition: attachment; filename="ITR-"'.date("Y-m-d").'".xml"');
		
		echo $doc->saveXML();		
	}	
}
else
{
	echo 'Invalid request';
}	

?>