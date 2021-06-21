<?php

	include("__lib.includes/config.inc.php");
	if(!($_SESSION['oPageAccess'])) { header("HTTP/1.1 401 Unauthorized");header("Location: $CONFIG->siteurl");exit;}

	//print_r($_SESSION);
	//print_r($_REQUEST);
	//exit;
	if($_REQUEST[formsDataID] != '')
	{
		//$documentFiles->trfrFrm16DataToMainDB($_REQUEST);
		$_SESSION[$CONFIG->sessionPrefix.'_ITR_ID']	= $_REQUEST[formsDataID];
		$commonFunction->jsRedirect($CONFIG->siteurl."mySaveTax/?activeTab=tabIncSource&module_interface=".$commonFunction->setPage('itr_forms'));
		exit;
	}

	if($_REQUEST[ay] != '')
	{
		if($_REQUEST[action] == 'remove')
		{
			$itrFill->truncateITRData($_REQUEST);
		}
		//print_r($_REQUEST);		
		$_SESSION[$CONFIG->sessionPrefix.'_AY'] = $_REQUEST[ay];
		$_SESSION[$CONFIG->sessionPrefix.'_AY_TEXT'] = $_REQUEST[ay]."-".(1+$_REQUEST[ay]);		
		$itrFill->checkPending($_REQUEST);		//exit;	
		$commonFunction->jsRedirect($CONFIG->siteurl."mySaveTax/?module_interface=".$commonFunction->setPage('fill_itr'));
	}
?>