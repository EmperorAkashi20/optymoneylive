<?php

	include("../__lib.includes/config.inc.php");
	if(!($_SESSION['oPageAccess'])) { header("HTTP/1.1 401 Unauthorized");header("Location: $CONFIG->siteurl");exit;}
	//print_r($_REQUEST);exit;
	if($_REQUEST['action'] == "recomend_nav")
	{
		$result = $buySell->recomendNAV($_REQUEST);
		echo $result;
		exit;
	}
	else if($_REQUEST['action'] == "updateRec") {
		// print_r($_REQUEST);
		// echo "<br><b><br>";
		// print_r($_POST);
		$result = $buySell->updateRec($_POST);
		// echo $result;
		// exit;
		header("location:".$CONFIG->siteurl.'secureAdmin/?module_interface='.$commonFunction->setPage('selected_scheme'));
	}
	if($_REQUEST['tableName'] != "" && $_REQUEST['value'] != "")
	{
		$mutualFund->deleteOffer($_REQUEST);
		exit;
	}
?>