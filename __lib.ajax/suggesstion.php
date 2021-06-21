<?php

	include("../__lib.includes/config.inc.php");
	if(!($_SESSION['oPageAccess'])) { header("HTTP/1.1 401 Unauthorized");header("Location: $CONFIG->siteurl");exit;}
	//print_r($_REQUEST);
	header('content-type: application/json; charset=utf-8');
	
	if($_REQUEST['term'] != '')
	{
		$searchStr = $_REQUEST['term'];
		$searchField = $_REQUEST['field'];
		$result = $mutualFund->singleFieldAutocomplete($searchStr,$searchField);
		//print_r($result);
		$jsonpArr = $commonFunction->convertTOJSONP($result);
		echo $_REQUEST['callback'] . '('.$jsonpArr.')';
	}
	
?>
