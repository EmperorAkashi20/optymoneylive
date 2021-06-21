<?php

	$xml_string = '<?xml version="1.0" encoding="UTF-8"?><ns3:ITR xmlns:ns3="http://incometaxindiaefiling.gov.in/main" xmlns="http://incometaxindiaefiling.gov.in/master" xmlns:ns2="http://incometaxindiaefiling.gov.in/ITR1">
    <ns2:ITR1><CreationInfo><SWVersionNo>101</SWVersionNo><SWCreatedBy>SW10001886</SWCreatedBy><XMLCreatedBy>SW10001886</XMLCreatedBy><XMLCreationDate>'.date("Y-m-d").'</XMLCreationDate><IntermediaryCity>BANGALORE</IntermediaryCity>
			<Digest>-</Digest></CreationInfo><Form_ITR1><FormName>ITR-1</FormName><Description>For Indls having Income from Salary, Pension, family pension and Interest</Description><AssessmentYear>2019</AssessmentYear><SchemaVer>Ver1.0</SchemaVer><FormVer>Ver1.0</FormVer></Form_ITR1></ns2:ITR1>
	</ns3:ITR>';
	$doc = new DOMDocument();
	$doc->preserveWhiteSpace = false;
	$doc->formatOutput = true;	
	$doc->loadXML($xml_string);	

	$xml_name = "text";
	$xml_path = $xml_name.".xml";

	$doc->save($xml_path);
?>