<?php
	include_once("__lib.includes/config.inc.php");
	if(!($_SESSION['oPageAccess'])) { header("HTTP/1.1 401 Unauthorized");header("Location: $CONFIG->siteurl");exit;}
	//ini_set("display_errors",1);
	//error_reporting(E_ALL);
	$itr_profile					= $itrFill->getEfillingDetails('itr_profile');
	$itr_pd_residential_st			= $itrFill->getEfillingDetails('itr_pd_residential_st');
	$itr_business_profession		= $itrFill->getEfillingDetails('itr_business_profession');
	$itr_presumptive				= $itrFill->getEfillingDetails('itr_presumptive');
	$itr_sou_other					= $itrFill->getEfillingDetails('itr_sou_other');
	$itr_deduction					= $itrFill->getEfillingDetails('itr_deduction');
	$itr_taxreconci_tds				= $itrFill->getEfillingDetails('itr_taxreconci_tds');
	$itr_taxfilling					= $itrFill->getEfillingDetails('itr_taxfilling');
	$itr_capitalgain				= $itrFill->getEfillingDetails('itr_capitalgain');
	
	$itr_sou_salary					= $itrFill->getEfillingDetailsMultiple('itr_sou_salary');
	$itr_hp_selfocc					= $itrFill->getEfillingDetailsMultiple('itr_hp_selfocc');
	$itr_hp_coowner_selfocc			= $itrFill->getEfillingDetailsMultiple('itr_hp_coowner_selfocc');
	$itr_hp_letout					= $itrFill->getEfillingDetailsMultiple('itr_hp_letout');
	$itr_hp_coowner_letout			= $itrFill->getEfillingDetailsMultiple('itr_hp_coowner_letout');
	$itr_cg_saleoland_prop			= $itrFill->getEfillingDetailsMultiple('itr_cg_saleoland_prop');
	$itr_cg_purchse_impro			= $itrFill->getEfillingDetailsMultiple('itr_cg_purchse_impro');	
	$itr_cg_saleomutualfunds		= $itrFill->getEfillingDetailsMultiple('itr_cg_saleomutualfunds');
	$itr_cg_saleoshareordeben		= $itrFill->getEfillingDetailsMultiple('itr_cg_saleoshareordeben');
	$itr_cg_saleotherassets			= $itrFill->getEfillingDetailsMultiple('itr_cg_saleotherassets');
	$itr_business_profe_addmor		= $itrFill->getEfillingDetailsMultiple('itr_business_profe_addmor');
	$itr_presumptive_tax44ae		= $itrFill->getEfillingDetailsMultiple('itr_presumptive_tax44ae');
	$itr_sou_partnership			= $itrFill->getEfillingDetailsMultiple('itr_sou_partnership');
	$itr_foa_forginassets			= $itrFill->getEfillingDetailsMultiple('itr_foa_forginassets');
	$itr_foa_financialinterest		= $itrFill->getEfillingDetailsMultiple('itr_foa_financialinterest');
	$itr_foa_immovableproperty		= $itrFill->getEfillingDetailsMultiple('itr_foa_immovableproperty');
	$itr_foa_othcaptialassets		= $itrFill->getEfillingDetailsMultiple('itr_foa_othcaptialassets');
	$itr_foa_signingauthority		= $itrFill->getEfillingDetailsMultiple('itr_foa_signingauthority');
	$itr_foa_detailsoftrust			= $itrFill->getEfillingDetailsMultiple('itr_foa_detailsoftrust');
	$itr_foa_othincomederived		= $itrFill->getEfillingDetailsMultiple('itr_foa_othincomederived');
	$itr_sou_foreignincome			= $itrFill->getEfillingDetailsMultiple('itr_sou_foreignincome');
	$itr_donation					= $itrFill->getEfillingDetailsMultiple('itr_donation');
	$itr_taxreconci_tdsothsal		= $itrFill->getEfillingDetailsMultiple('itr_taxreconci_tdsothsal');	
	$itr_taxreconci_tdsimoprop		= $itrFill->getEfillingDetailsMultiple('itr_taxreconci_tdsimoprop');
	$itr_taxreconci_taxpaid_advan	= $itrFill->getEfillingDetailsMultiple('itr_taxreconci_taxpaid_advan');
	$itr_taxreconci_selfasstaxpaid	= $itrFill->getEfillingDetailsMultiple('itr_taxreconci_selfasstaxpaid');
	$itr_taxreconciliation			= $itrFill->getEfillingDetailsMultiple('itr_taxreconciliation');
	$itr_taxfilling_land			= $itrFill->getEfillingDetailsMultiple('itr_taxfilling_land');
		
	$fr_itr_id	=	$_SESSION[$CONFIG->sessionPrefix.'_ITR_ID'];
	$fr_user_id	=	$CONFIG->loggedUserId;
		//print_r($_SESSION);exit;
		
	$itrXMLcal = array();
	
	$fyear = "2019-07-31";
	$XMLCreationDate = date("Y-m-d");
	$Digest = "4cEBR9WZtNsW9s9E4qz+WhE9zydtXughD1fYBVQM654=";

	$itrXMLcal['ReturnFileSec'] ='';
	if($itr_profile['itr_pd_return_type'] == 'Revised')
	{
	  $itrXMLcal['ReturnFileSec'] = 17;
	  $itrXMLcal['ReturnType'] = 'R';
	}
	else
	{
	   if(date("Y-m-d")>strtotime($fyear ))
	  {
		  $itrXMLcal['ReturnFileSec'] = 12;
		  $itrXMLcal['ReturnType'] = 'O';
	  }
	  else
	  {
		$itrXMLcal['ReturnFileSec'] = 11;
		$itrXMLcal['ReturnType'] = 'O';
	  }
	}

	$itrXMLcal['TypeOfHP'] = 'S';

	$sum1 = $itrFill->getSum('self_hloan_int','itr_hp_selfocc',$fr_itr_id,$fr_user_id); 
	$sum2 = $itrFill->getSum('self_con_per_int','itr_hp_selfocc',$fr_itr_id,$fr_user_id);
	$itrXMLcal['TotalIncomeOfHP'] = "-".(((int)$sum1) + ((int)$sum2));
	
	if($itrXMLcal['TotalIncomeOfHP'] == 0 || $itrXMLcal['TotalIncomeOfHP'] == '')
	{
	  $itrXMLcal['TypeOfHP'] = '';
	  $itrXMLcal['TotalIncomeOfHP'] = '';
	}
	else
	{
	  $itrXMLcal['TypeOfHP'] = '<ITRForm:TypeOfHP>S</ITRForm:TypeOfHP>';
	  $itrXMLcal['TotalIncomeOfHP'] = '<ITRForm:TotalIncomeOfHP>'. $itrXMLcal['TotalIncomeOfHP'].'</ITRForm:TotalIncomeOfHP>';
	}
	$userAgeOrSelf = 0;
	$parentAge = 0;
	if($itr_deduction['ded_hi_hip80d_ageoparent'] != '')
	{
	  $parentAge = $itr_deduction['ded_hi_hip80d_ageoparent'];
	}
	
	$dateOfBirth = $itr_profile['itr_pd_dob'];
	$itrXMLcal['Section80DUsrType'] = 0;
	if($dateOfBirth != '')
 	{
		$from = new DateTime($dateOfBirth);
		$to   = new DateTime('today');
		$userAgeOrSelf = $from->diff($to)->y;
		
		$parentAge = $itr_deduction['ded_hi_hip80d_ageoparent'];
		
		if(($userAgeOrSelf<60) && $itr_deduction['ded_hi_hip80d_parents'] == '')
		{ 
			//seinor citizen with family
			$itrXMLcal['Section80DUsrType'] = 1;
		}
		if(($userAgeOrSelf>=60) && $itr_deduction['ded_hi_hip80d_parents'] == '')
		{
			$itrXMLcal['Section80DUsrType'] = 2;
		}
		if(($parentAge<60) && $itr_deduction['ded_hi_hip80d_ssc'] == '')
		{
			$itrXMLcal['Section80DUsrType'] = 3;
		}
		if(($parentAge>=60) && $itr_deduction['ded_hi_hip80d_ssc'] == '')
		{
			$itrXMLcal['Section80DUsrType'] = 4;
		}
		if(($parentAge<60) && ($userAgeOrSelf<60) && $itr_deduction['ded_hi_hip80d_ssc'] != '' && $itr_deduction['ded_hi_hip80d_parents'] !='')
		{
			$itrXMLcal['Section80DUsrType'] = 5;
		}
		if(($parentAge>=60) && ($userAgeOrSelf<60) && $itr_deduction['ded_hi_hip80d_ssc'] != '' && $itr_deduction['ded_hi_hip80d_parents'] !='')
		{
			$itrXMLcal['Section80DUsrType'] = 6;
		}
		if(($userAgeOrSelf>=60) && ($parentAge>=60) && $itr_deduction['ded_hi_hip80d_ssc'] != '' && $itr_deduction['ded_hi_hip80d_parents'] !='')
		{
			$itrXMLcal['Section80DUsrType'] = 7;
		}
	}
	
	$itrXMLcal['Section80D'] = (((int)$itr_deduction['ded_hi_hip80d_ssc']) + ((int)$itr_deduction['ded_hi_hip80d_parents']));
	
	$donamt100 = $itrFill->getDonation('dona_80g_damount','itr_donation',$fr_itr_id,$fr_user_id,1);
	$donamt50 = $itrFill->getDonation('dona_80g_damount','itr_donation',$fr_itr_id,$fr_user_id,0);
	$itrXMLcal['Section80G'] = $donamt100 + ($donamt50/2);

	$itrXMLcal['TotalChapVIADeductions'] = $itr_deduction['ded_gd__80c'] + $itr_deduction['ded_othd_80ccc'] + $itr_deduction['ded_othd_80ccd1'] + $itr_deduction['ded_othd_80ccd1b'] + $itr_deduction['ded_othd_80ccd2'] + $itrXMLcal['Section80D'] + $itr_deduction['ded_othd_80dd'] + $itr_deduction['ded_othd_80ddb'] + $itr_deduction['ded_othd_80e'] + $itr_deduction['ded_othd_80ee'] + $itrXMLcal['Section80G'] + $itr_deduction['ded_gd__80gg'] + $itr_deduction['ded_othdon_80gga_dfsrrd'] + $itr_deduction['ded_othdon_80ggc_dpp'] + $itr_deduction['ded_othd_80u'] + $itr_deduction['ded_othd_80rrb'] + $itr_deduction['ded_othd_80qqb'] + $itr_deduction['ded_othd_80ccg'] + $itr_deduction['ded_gd__80tta'];
	$itrXMLcal['S80c'] = $itr_deduction['ded_gd__80c'];
	$itrXMLcal['S80ccc'] = $itr_deduction['ded_othd_80ccc'];
	$itrXMLcal['S80ccd'] = $itr_deduction['ded_othd_80ccd1'];
	$s1s2s3Sum = $itrXMLcal['S80c'] + $itrXMLcal['S80ccc'] + $itrXMLcal['S80ccd'];

	$sumDiff1 = $s1s2s3Sum - 150000;
	if($sumDiff1 > 0)
	{
	  $sumDiff2 =  $itrXMLcal['S80ccd'] - $sumDiff1;
	  if($sumDiff2 >0)
	  {
		// $itrXMLcal['S80c'] = $itr_deduction['ded_gd__80c'];
		// $itrXMLcal['S80ccc'] = $itr_deduction['ded_othd_80ccc'];
		$itrXMLcal['S80ccd'] = $sumDiff2;
	  }
	  else
	  {
		$itrXMLcal['S80ccd'] = 0;
		$sumDiff3 = $itrXMLcal['S80ccc'] + $sumDiff2;
		if($sumDiff3 >0)
		{
		  $itrXMLcal['S80ccc'] = $sumDiff3;
		}
		else
		{
		  $itrXMLcal['S80ccc'] = 0;
		  $sumDiff4 = $itrXMLcal['S80c'] + $sumDiff3;
		  $itrXMLcal['S80c'] = $sumDiff4;
		}
	
	  }
	}
	$itrXMLcal['S80CCD1B'] = $itr_deduction['ded_othd_80ccd1b'];
	if($itrXMLcal['S80CCD1B'] > 50000)
	{
	  $itrXMLcal['S80CCD1B'] = 50000;
	}
	$itrXMLcal['S80CCDEmployer'] = $itr_deduction['ded_othd_80ccd2'];
	$salinccal = ($itr_taxfilling['tax_re_inccha_undsal'] * (10/100));
	if($itrXMLcal['S80CCDEmployer'] > $salinccal)
	{
		$itrXMLcal['S80CCDEmployer'] = $salinccal;
	}
	
	$S7_93 = (int)$itr_deduction['ded_hi_hip80d_ssc'];
	$S7_94 = (int)$itr_deduction['ded_hi_hip80d_parents'];
	
	if($S7_93 == '')
	{
	  $S7_93 = 0;
	}
	if($S7_94 == '')
	{
	  $S7_94 = 0;
	}
	
	if($userAgeOrSelf < 60)
	{
	  if($S7_93 > 25000)
	  {
		$S7_93 = 25000;
	  }
	}
	else
	{
	  if($S7_93 > 30000)
	  {
		$S7_93 = 30000;
	  }
	}
	if($parentAge < 60)
	{
	  if($S7_94 > 25000)
	  {
		$S7_94 = 25000;
	  }
	}
	else
	{
	  if($S7_94 > 30000)
	  {
		$S7_94  = 30000;
	  }
	}
	$itrXMLcal['S80D'] = $S7_93 + $S7_94;
	
	$itrXMLcal['S80DD'] = $itr_deduction['ded_othd_80dd'];
	if($itrXMLcal['S80DD'] > 125000)
	{
	  $itrXMLcal['S80DD'] =125000;
	}
	
	$itrXMLcal['S80DDB'] = $itr_deduction['ded_othd_80ddb'];
	if($userAgeOrSelf < 60 && $itrXMLcal['S80DDB'] >40000)
	{
	  $itrXMLcal['S80DDB'] = 40000;
	}
	elseif($userAgeOrSelf >= 60 && $itrXMLcal['S80DDB'] >60000)
	{
	  $itrXMLcal['S80DDB'] = 60000;
	}
	elseif($userAgeOrSelf >= 80 && $itrXMLcal['S80DDB'] >80000)
	{
	   $itrXMLcal['S80DDB'] = 80000;
	}
	if($itr_deduction['ded_othd_80ddb'] == 0 || $itr_deduction['ded_othd_80ddb'] == '')
	{
		$itrXMLcal['S80DDB'] = 0;
	}
	
	$itrXMLcal['S80E'] = $itr_deduction['ded_othd_80e'];

	$itrXMLcal['S80EE'] = $itr_deduction['ded_othd_80ee'];
	if($itrXMLcal['S80EE'] >50000)
	{
	  $itrXMLcal['S80EE'] = 50000;
	}
	$itrXMLcal['S80G'] = $itrXMLcal['Section80G'];
	$itrXMLcal['S80GG'] = $itr_deduction['ded_gd__80gg']; //todo
	if($itrXMLcal['S80GG'] > 60000)
	{
	  $itrXMLcal['S80GG'] = 60000;
	}
	$itrXMLcal['S80GGA'] = $itr_deduction['ded_othdon_80gga_dfsrrd'];
	$itrXMLcal['S80GGC'] = $itr_deduction['ded_othdon_80ggc_dpp'];
	$itrXMLcal['S80U']   = $itr_deduction['ded_othd_80u'];
	if($itrXMLcal['S80U'] >125000)
	{
	  $itrXMLcal['S80U'] = 125000;
	}
	$itrXMLcal['S80RRB'] = $itr_deduction['ded_othd_80rrb'];
	if($itrXMLcal['S80RRB']  >300000)
	{
	  $itrXMLcal['S80RRB']  = 300000;
	}
	$itrXMLcal['S80QQB'] = $itr_deduction['ded_othd_80qqb'];
	if($itrXMLcal['S80QQB'] > 300000)
	{
	  $itrXMLcal['S80QQB']  = 300000;
	}
	
	$itrXMLcal['S80CCG'] = $itr_deduction['ded_othd_80ccg'];
	
	$grosstotalinc = $itr_taxfilling['tax_re_gro_totinc'];
	
	if($grosstotalinc > 1200000)
	{
	  $itrXMLcal['S80CCG'] = 0;
	}
	$itrXMLcal['S80TTA'] = $itr_deduction['ded_gd__80tta'];
	if($itrXMLcal['S80TTA'] > 10000)
	{
	  $itrXMLcal['S80TTA'] = 10000;
	}

	$S13except_TotalChapVIADeductions = $itrXMLcal['S80c'] + $itrXMLcal['S80ccc'] + $itrXMLcal['S80ccd'] + $itrXMLcal['S80CCD1B'] + $itrXMLcal['S80CCDEmployer'] + $itrXMLcal['S80D'] + $itrXMLcal['S80DD'] + $itrXMLcal['S80DDB'] + $itrXMLcal['S80E'] + $itrXMLcal['S80EE'] + $itrXMLcal['S80G'] + $itrXMLcal['S80GGA'] + $itrXMLcal['S80GGC'] + $itrXMLcal['S80U'] + $itrXMLcal['S80RRB'] + $itrXMLcal['S80QQB'] + $itrXMLcal['S80CCG'] + $itrXMLcal['S80TTA'];

	$netIncCal =  $grosstotalinc - $S13except_TotalChapVIADeductions;
	
	$value2 =  $itrXMLcal['S80GG'];
	$value3 = ($netIncCal*(25/100));
	$calvalue = 0;
	if($value2 < $value3)
	{
	  $calvalue = $value2;
	}
	else
	{
	  $calvalue = $value3;
	}
	
	$itrXMLcal['S80GG'] = $calvalue;
	if($itrXMLcal['S80GG'] == 0 || $itrXMLcal['S80GG'] == '')
	{
		$itrXMLcal['S80GG'] = 0;
	}

	$itrXMLcal['S_TotalChapVIADeductions'] = $S13except_TotalChapVIADeductions + $itrXMLcal['S80GG'];

	$donationXmlStr='<ITRForm:Schedule80G>';
	$flag = 0;
	$TotalEligibleDonationsUs80G = 0;
	$TotalDonationsUs80G = 0;
	$XMLstrWoQulidon100 = '<ITRForm:Don100Percent>';
	$totalAmt_WoQulidon100 = 0;
	foreach ($itr_donation as $key => $value) 
	{
	  if($value['dona_80g_deligilibity']== 'without qualifing limit' && $value['dona_share_50_100'] == 1)
	  {
		//print_r($value);
		$XMLstrWoQulidon100 = $XMLstrWoQulidon100.'<ITRForm:DoneeWithPan>';
		$XMLstrWoQulidon100 = $XMLstrWoQulidon100.'<ITRForm:DoneeWithPanName>'.$value['dona_80g_dname'].'</ITRForm:DoneeWithPanName>';
		$XMLstrWoQulidon100 = $XMLstrWoQulidon100.'<ITRForm:DoneePAN>'.$value['dona_80g_dpan'].'</ITRForm:DoneePAN>';
		$XMLstrWoQulidon100 = $XMLstrWoQulidon100.'<ITRForm:AddressDetail>';
		$XMLstrWoQulidon100 = $XMLstrWoQulidon100.'<ITRForm:AddrDetail>'.$value['dona_80g_daddr'].'</ITRForm:AddrDetail>';
		$XMLstrWoQulidon100 = $XMLstrWoQulidon100.'<ITRForm:CityOrTownOrDistrict>'.$value['dona_80g_dcity'].'</ITRForm:CityOrTownOrDistrict>';
		$XMLstrWoQulidon100 = $XMLstrWoQulidon100.'<ITRForm:StateCode>'.$value['dona_80g_dstate'].'</ITRForm:StateCode>';
		$XMLstrWoQulidon100 = $XMLstrWoQulidon100.'<ITRForm:PinCode>'.$value['dona_80g_dpincode'].'</ITRForm:PinCode>';
		$XMLstrWoQulidon100 = $XMLstrWoQulidon100.'</ITRForm:AddressDetail>';
		$XMLstrWoQulidon100 = $XMLstrWoQulidon100.'<ITRForm:DonationAmt>'.$value['dona_80g_damount'].'</ITRForm:DonationAmt>';
		$XMLstrWoQulidon100 = $XMLstrWoQulidon100.'<ITRForm:EligibleDonationAmt>'.$value['dona_80g_damount'].'</ITRForm:EligibleDonationAmt>';
		$XMLstrWoQulidon100 = $XMLstrWoQulidon100.'</ITRForm:DoneeWithPan>';
		$totalAmt_WoQulidon100 = $totalAmt_WoQulidon100 + $value['dona_80g_damount']; $flag = 1;                
	  } 
	}
	$XMLstrWoQulidon100 = $XMLstrWoQulidon100.'<ITRForm:TotEligibleDon100Percent>'.$totalAmt_WoQulidon100.'</ITRForm:TotEligibleDon100Percent>';
	$XMLstrWoQulidon100 = $XMLstrWoQulidon100.'<ITRForm:TotDon100Percent>'.$totalAmt_WoQulidon100.'</ITRForm:TotDon100Percent>';
	$XMLstrWoQulidon100 = $XMLstrWoQulidon100.'</ITRForm:Don100Percent>';
	$TotalEligibleDonationsUs80G = $TotalEligibleDonationsUs80G + $totalAmt_WoQulidon100;
	$TotalDonationsUs80G = $TotalDonationsUs80G + $totalAmt_WoQulidon100;
	
	if($flag == 1)
	{
	  $donationXmlStr = $donationXmlStr.$XMLstrWoQulidon100;
	}
	$S12except_TotalChapVIADeductions = $itrXMLcal['S80c'] + $itrXMLcal['S80ccc'] + $itrXMLcal['S80ccd'] + $itrXMLcal['S80CCD1B'] + $itrXMLcal['S80CCDEmployer'] + $itrXMLcal['S80D'] + $itrXMLcal['S80DD'] + $itrXMLcal['S80DDB'] + $itrXMLcal['S80E'] + $itrXMLcal['S80EE'] + $itrXMLcal['S80GG'] + $itrXMLcal['S80GGA'] + $itrXMLcal['S80GGC'] + $itrXMLcal['S80U'] + $itrXMLcal['S80RRB'] + $itrXMLcal['S80QQB'] + $itrXMLcal['S80CCG'] + $itrXMLcal['S80TTA'];
	
	$netIncCalforDonetion =  $grosstotalinc - $S12except_TotalChapVIADeductions;
	$lowest_value_netIncCalforDonetion = (10/100)*$netIncCalforDonetion;
	
	$XMLstrWithQulidon100 = '<ITRForm:Don100PercentApprReqd>';
	$totalAmt_WithQulidon100 = 0;
	$total_EligibleDonationAmt_WithQulidon100 = 0;
	foreach ($itr_donation as $key => $value) 
	{
	  if($value['dona_80g_deligilibity']== 'with qualifing limit' && $value['dona_share_50_100'] == 1)
	  { 
		$EligibleDonationAmt = 0;
		if($lowest_value_netIncCalforDonetion < $value['dona_80g_damount'])
		{
		  $EligibleDonationAmt = $lowest_value_netIncCalforDonetion;
		}
		else
		{
		  $EligibleDonationAmt = $value['dona_80g_damount'];
		}
		//print_r($value);
		$XMLstrWithQulidon100 = $XMLstrWithQulidon100.'<ITRForm:DoneeWithPan>';
		$XMLstrWithQulidon100 = $XMLstrWithQulidon100.'<ITRForm:DoneeWithPanName>'.$value['dona_80g_dname'].'</ITRForm:DoneeWithPanName>';
		$XMLstrWithQulidon100 = $XMLstrWithQulidon100.'<ITRForm:DoneePAN>'.$value['dona_80g_dpan'].'</ITRForm:DoneePAN>';
		$XMLstrWithQulidon100 = $XMLstrWithQulidon100.'<ITRForm:AddressDetail>';
		$XMLstrWithQulidon100 = $XMLstrWithQulidon100.'<ITRForm:AddrDetail>'.$value['dona_80g_daddr'].'</ITRForm:AddrDetail>';
		$XMLstrWithQulidon100 = $XMLstrWithQulidon100.'<ITRForm:CityOrTownOrDistrict>'.$value['dona_80g_dcity'].'</ITRForm:CityOrTownOrDistrict>';
		$XMLstrWithQulidon100 = $XMLstrWithQulidon100.'<ITRForm:StateCode>'.$value['dona_80g_dstate'].'</ITRForm:StateCode>';
		$XMLstrWithQulidon100 = $XMLstrWithQulidon100.'<ITRForm:PinCode>'.$value['dona_80g_dpincode'].'</ITRForm:PinCode>';
		$XMLstrWithQulidon100 = $XMLstrWithQulidon100.'</ITRForm:AddressDetail>';
		$XMLstrWithQulidon100 = $XMLstrWithQulidon100.'<ITRForm:DonationAmt>'.$value['dona_80g_damount'].'</ITRForm:DonationAmt>';
		$XMLstrWithQulidon100 = $XMLstrWithQulidon100.'<ITRForm:EligibleDonationAmt>'.$EligibleDonationAmt.'</ITRForm:EligibleDonationAmt>';
		$XMLstrWithQulidon100 = $XMLstrWithQulidon100.'</ITRForm:DoneeWithPan>';
		$totalAmt_WithQulidon100 = $totalAmt_WithQulidon100 + $value['dona_80g_damount'];  $flag =2; 
		$total_EligibleDonationAmt_WithQulidon100 = $total_EligibleDonationAmt_WithQulidon100 + $EligibleDonationAmt;              
	  } 
	}
	$XMLstrWithQulidon100 = $XMLstrWithQulidon100.'<ITRForm:TotEligibleDon100PercentApprReqd>'.$total_EligibleDonationAmt_WithQulidon100.'</ITRForm:TotEligibleDon100PercentApprReqd>';
	$XMLstrWithQulidon100 = $XMLstrWithQulidon100.'<ITRForm:TotDon100PercentApprReqd>'.$totalAmt_WithQulidon100.'</ITRForm:TotDon100PercentApprReqd>';
	$XMLstrWithQulidon100 = $XMLstrWithQulidon100.'</ITRForm:Don100PercentApprReqd>';
	$TotalEligibleDonationsUs80G = $TotalEligibleDonationsUs80G + $total_EligibleDonationAmt_WithQulidon100;
	$TotalDonationsUs80G = $TotalDonationsUs80G + $totalAmt_WithQulidon100;
	
	if($flag == 2)
	{
	  $donationXmlStr = $donationXmlStr.$XMLstrWithQulidon100;
	}
	
	
	$XMLstrWoQulidon50 = '<ITRForm:Don50PercentNoApprReqd>';
	$totalAmt_WoQulidon50 = 0;
	foreach ($itr_donation as $key => $value) 
	{
	  if($value['dona_80g_deligilibity']== 'without qualifing limit' && $value['dona_share_50_100'] == 0)
	  {
		$XMLstrWoQulidon50 = $XMLstrWoQulidon50.'<ITRForm:DoneeWithPan>';
		$XMLstrWoQulidon50 = $XMLstrWoQulidon50.'<ITRForm:DoneeWithPanName>'.$value['dona_80g_dname'].'</ITRForm:DoneeWithPanName>';
		$XMLstrWoQulidon50 = $XMLstrWoQulidon50.'<ITRForm:DoneePAN>'.$value['dona_80g_dpan'].'</ITRForm:DoneePAN>';
		$XMLstrWoQulidon50 = $XMLstrWoQulidon50.'<ITRForm:AddressDetail>';
		$XMLstrWoQulidon50 = $XMLstrWoQulidon50.'<ITRForm:AddrDetail>'.$value['dona_80g_daddr'].'</ITRForm:AddrDetail>';
		$XMLstrWoQulidon50 = $XMLstrWoQulidon50.'<ITRForm:CityOrTownOrDistrict>'.$value['dona_80g_dcity'].'</ITRForm:CityOrTownOrDistrict>';
		$XMLstrWoQulidon50 = $XMLstrWoQulidon50.'<ITRForm:StateCode>'.$value['dona_80g_dstate'].'</ITRForm:StateCode>';
		$XMLstrWoQulidon50 = $XMLstrWoQulidon50.'<ITRForm:PinCode>'.$value['dona_80g_dpincode'].'</ITRForm:PinCode>';
		$XMLstrWoQulidon50 = $XMLstrWoQulidon50.'</ITRForm:AddressDetail>';
		$XMLstrWoQulidon50 = $XMLstrWoQulidon50.'<ITRForm:DonationAmt>'.$value['dona_80g_damount'].'</ITRForm:DonationAmt>';
		$XMLstrWoQulidon50 = $XMLstrWoQulidon50.'<ITRForm:EligibleDonationAmt>'.($value['dona_80g_damount']/2).'</ITRForm:EligibleDonationAmt>';
		$XMLstrWoQulidon50 = $XMLstrWoQulidon50.'</ITRForm:DoneeWithPan>';
		$totalAmt_WoQulidon50 = $totalAmt_WoQulidon50 + $value['dona_80g_damount']; $flag = 3;
	  }
	}
	$XMLstrWoQulidon50 = $XMLstrWoQulidon50.'<ITRForm:TotEligibleDon50Percent>'.($totalAmt_WoQulidon50/2).'</ITRForm:TotEligibleDon50Percent>';
	$XMLstrWoQulidon50 = $XMLstrWoQulidon50.'<ITRForm:TotDon50PercentNoApprReqd>'.$totalAmt_WoQulidon50.'</ITRForm:TotDon50PercentNoApprReqd>';
	$XMLstrWoQulidon50 = $XMLstrWoQulidon50.'</ITRForm:Don50PercentNoApprReqd>';
	$TotalEligibleDonationsUs80G = $TotalEligibleDonationsUs80G + ($totalAmt_WoQulidon50/2);
	$TotalDonationsUs80G = $TotalDonationsUs80G + $totalAmt_WoQulidon50;
	
	if($flag == 3)
	{
	  $donationXmlStr = $donationXmlStr.$XMLstrWithQulidon100;
	}
	
	
	$XMLstrWithQulidon50 = '<ITRForm:Don50PercentApprReqd>';
	$totalAmt_WithQulidon50 = 0;
	$total_EligibleDonationAmt_WithQulidon50 = 0;
	foreach ($itr_donation as $key => $value) 
	{
	  if($value['dona_80g_deligilibity']== 'with qualifing limit' && $value['dona_share_50_100'] == 0)
	  {
		$EligibleDonationAmt = 0;
		if($lowest_value_netIncCalforDonetion < $value['dona_80g_damount'])
		{
		  $EligibleDonationAmt = $lowest_value_netIncCalforDonetion;
		}
		else
		{
		  $EligibleDonationAmt = $value['dona_80g_damount'];
		}
		$XMLstrWithQulidon50 = $XMLstrWithQulidon50.'<ITRForm:DoneeWithPan>';
		$XMLstrWithQulidon50 = $XMLstrWithQulidon50.'<ITRForm:DoneeWithPanName>'.$value['dona_80g_dname'].'</ITRForm:DoneeWithPanName>';
		$XMLstrWithQulidon50 = $XMLstrWithQulidon50.'<ITRForm:DoneePAN>'.$value['dona_80g_dpan'].'</ITRForm:DoneePAN>';
		$XMLstrWithQulidon50 = $XMLstrWithQulidon50.'<ITRForm:AddressDetail>';
		$XMLstrWithQulidon50 = $XMLstrWithQulidon50.'<ITRForm:AddrDetail>'.$value['dona_80g_daddr'].'</ITRForm:AddrDetail>';
		$XMLstrWithQulidon50 = $XMLstrWithQulidon50.'<ITRForm:CityOrTownOrDistrict>'.$value['dona_80g_dcity'].'</ITRForm:CityOrTownOrDistrict>';
		$XMLstrWithQulidon50 = $XMLstrWithQulidon50.'<ITRForm:StateCode>'.$value['dona_80g_dstate'].'</ITRForm:StateCode>';
		$XMLstrWithQulidon50 = $XMLstrWithQulidon50.'<ITRForm:PinCode>'.$value['dona_80g_dpincode'].'</ITRForm:PinCode>';
		$XMLstrWithQulidon50 = $XMLstrWithQulidon50.'</ITRForm:AddressDetail>';
		$XMLstrWithQulidon50 = $XMLstrWithQulidon50.'<ITRForm:DonationAmt>'.$value['dona_80g_damount'].'</ITRForm:DonationAmt>';
		$XMLstrWithQulidon50 = $XMLstrWithQulidon50.'<ITRForm:EligibleDonationAmt>'.($EligibleDonationAmt/2).'</ITRForm:EligibleDonationAmt>';
		$XMLstrWithQulidon50 = $XMLstrWithQulidon50.'</ITRForm:DoneeWithPan>';
		$totalAmt_WithQulidon50 = $totalAmt_WithQulidon50 + $value['dona_80g_damount']; $flag = 4;
		$total_EligibleDonationAmt_WithQulidon50 = $total_EligibleDonationAmt_WithQulidon50 + ($EligibleDonationAmt/2);
	  }
	}
	$XMLstrWithQulidon50 = $XMLstrWithQulidon50.'<ITRForm:TotEligibleDon50PercentApprReqd>'.($totalAmt_WithQulidon50/2).'</ITRForm:TotEligibleDon50PercentApprReqd>';
	$XMLstrWithQulidon50 = $XMLstrWithQulidon50.'<ITRForm:TotDon50PercentApprReqd>'.$totalAmt_WithQulidon50.'</ITRForm:TotDon50PercentApprReqd>';
	$XMLstrWithQulidon50 = $XMLstrWithQulidon50.'</ITRForm:Don50PercentApprReqd>';
	$TotalEligibleDonationsUs80G = $TotalEligibleDonationsUs80G + ($total_EligibleDonationAmt_WithQulidon50);
	$TotalDonationsUs80G = $TotalDonationsUs80G + $totalAmt_WithQulidon50;
	
	if($flag == 4)
	{
	  $donationXmlStr = $donationXmlStr.$XMLstrWithQulidon50;
	}
	$donationXmlStr = $donationXmlStr.'<ITRForm:TotalEligibleDonationsUs80G>'.$TotalEligibleDonationsUs80G.'</ITRForm:TotalEligibleDonationsUs80G>';
	$donationXmlStr = $donationXmlStr.' <ITRForm:TotalDonationsUs80G>'.$TotalDonationsUs80G.'</ITRForm:TotalDonationsUs80G>';
	$donationXmlStr = $donationXmlStr. '</ITRForm:Schedule80G>';
	if($flag == 0)
	{
	  $donationXmlStr = '';
	}
	
	$TDSonXmlStr='<ITRForm:TDSonSalaries>';
	$flagTDSon = 0;
	$TotalTDSonSalaries = 0;
	foreach ($itr_sou_salary as $key => $value) 
	{
		if($value['sou_sa_ntslary'] == '')
		{
			$flagTDSon = 0;
		}
		else
		{
		  $TDSonXmlStr .=  '<ITRForm:TDSonSalary>';
		  $TDSonXmlStr .=  '<ITRForm:EmployerOrDeductorOrCollectDetl>';
		  $TDSonXmlStr .=  '<ITRForm:TAN>'.$value['sou_sa_tan_no'].'</ITRForm:TAN>';
		  $TDSonXmlStr .=  '<ITRForm:EmployerOrDeductorOrCollecterName>'.$value['sou_sa_employer_name'].'</ITRForm:EmployerOrDeductorOrCollecterName>';
		  $TDSonXmlStr .=  '</ITRForm:EmployerOrDeductorOrCollectDetl>';
		  $TDSonXmlStr .=  '<ITRForm:IncChrgSal>'.$value['sou_sa_ntslary'].'</ITRForm:IncChrgSal>';
		  $TDSonXmlStr .=  '<ITRForm:TotalTDSSal>'.$value['sou_sa_tds_on_sal'].'</ITRForm:TotalTDSSal>';
		  $TDSonXmlStr .=  '</ITRForm:TDSonSalary>';
		  $TotalTDSonSalaries = $TotalTDSonSalaries + $value['sou_sa_tds_on_sal']; 
		  $flagTDSon = 1;
		}
	}
	$TDSonXmlStr .= '<ITRForm:TotalTDSonSalaries>'.$TotalTDSonSalaries.'</ITRForm:TotalTDSonSalaries>';
	$TDSonXmlStr .= '</ITRForm:TDSonSalaries>';
	if($flagTDSon == 0)
	{
	  $TDSonXmlStr = '';
	}
	
	$TDSonOthThanSals_XmlStr='<ITRForm:TDSonOthThanSals>';
	$flagTDSonOth = 0;
	$TotalTDSonOthThanSals = 0;
	foreach ($itr_taxreconci_tdsothsal as $key => $value) 
	{
	
	  $TDSonOthThanSals_XmlStr .= '<ITRForm:TDSonOthThanSal>';
	  $TDSonOthThanSals_XmlStr .= '<ITRForm:EmployerOrDeductorOrCollectDetl>';
	  $TDSonOthThanSals_XmlStr .= '<ITRForm:TAN>'.$value['reco_tdsothsal_tanoded'].'</ITRForm:TAN>';
	  $TDSonOthThanSals_XmlStr .= '<ITRForm:EmployerOrDeductorOrCollecterName>'.$value['reco_tdsonsal_nameodedu'].'</ITRForm:EmployerOrDeductorOrCollecterName>';
	  $TDSonOthThanSals_XmlStr .= '</ITRForm:EmployerOrDeductorOrCollectDetl>';
	  $TDSonOthThanSals_XmlStr .= '<ITRForm:AmtForTaxDeduct>'.$value['reco_tdsothsal_rec26as'].'</ITRForm:AmtForTaxDeduct>';
	  $TDSonOthThanSals_XmlStr .= '<ITRForm:DeductedYr>'.$value['reco_tdsothsal_yeartdsdedu'].'</ITRForm:DeductedYr>';
	  $TDSonOthThanSals_XmlStr .= '<ITRForm:TotTDSOnAmtPaid>'.$value['reco_tdsothsal_tdsdeduc'].'</ITRForm:TotTDSOnAmtPaid>';
	  $TDSonOthThanSals_XmlStr .= '<ITRForm:ClaimOutOfTotTDSOnAmtPaid>'.$value['reco_tdsothsal_tdsclaim'].'</ITRForm:ClaimOutOfTotTDSOnAmtPaid>';
	  $TDSonOthThanSals_XmlStr .= '<ITRForm:AmtClaimedBySpouse>0</ITRForm:AmtClaimedBySpouse>';
	  $TDSonOthThanSals_XmlStr .= '</ITRForm:TDSonOthThanSal>';
	
	  $TotalTDSonOthThanSals = $TotalTDSonOthThanSals + $value['reco_tdsothsal_tdsclaim']; $flagTDSonOth = 1;
	}
	$TDSonOthThanSals_XmlStr .= '<ITRForm:TotalTDSonOthThanSals>'.$TotalTDSonOthThanSals.'</ITRForm:TotalTDSonOthThanSals>';
	$TDSonOthThanSals_XmlStr .= '</ITRForm:TDSonOthThanSals>';
	
	if($flagTDSonOth == 0)
	{
	  $TDSonOthThanSals_XmlStr = '';
	}
	
	
	$TaxPayments_XmlStr='<ITRForm:TaxPayments>';
	$flagTaxPayments = 0;
	$TotalTaxPayments = 0;
	foreach ($itr_taxreconci_selfasstaxpaid as $key => $value) 
	{
	  $TaxPayments_XmlStr .= '<ITRForm:TaxPayment>';
	  $TaxPayments_XmlStr .= '<ITRForm:BSRCode>'.$value['reco_selfasstxpd_bsrcodobnk'].'</ITRForm:BSRCode>';
	  $TaxPayments_XmlStr .= '<ITRForm:DateDep>'.$value['reco_selfasstxpd_dateodepos'].'</ITRForm:DateDep>';
	  $TaxPayments_XmlStr .= '<ITRForm:SrlNoOfChaln>'.$value['reco_selfasstxpd_challsrno'].'</ITRForm:SrlNoOfChaln>';
	  $TaxPayments_XmlStr .= '<ITRForm:Amt>'.$value['reco_selfasstxpd_amount'].'</ITRForm:Amt>';
	  $TaxPayments_XmlStr .= '</ITRForm:TaxPayment>';
	  $TotalTaxPayments = $TotalTaxPayments + $value['reco_selfasstxpd_amount']; $flagTaxPayments = 1;
	}
	$TaxPayments_XmlStr .= '<ITRForm:TotalTaxPayments>'.$TotalTaxPayments.'</ITRForm:TotalTaxPayments>';
	$TaxPayments_XmlStr .= '</ITRForm:TaxPayments>';
	
	if($flagTaxPayments == 0)
	{
	  $TaxPayments_XmlStr = '';
	}
	
	
	// echo "<br>";
	// echo "<br>";
	$itrXMLcal['GrossTaxLiability'] = ((int)$itr_taxfilling['tax_re_taxaft_rebate']) + ((int)$itr_taxfilling['tax_re_cess']);
	
	$itrXMLcal['NetTaxLiability'] = (((int)$itr_taxfilling['tax_re_taxaft_rebate']) + ((int)$itr_taxfilling['tax_re_cess']))-((int)$itr_taxfilling['tax_re_sec89_relief']);
	
	$itrXMLcal['TotalIntrstPay'] = ((int)$itr_taxfilling['tax_re_int_234a']) + ((int)$itr_taxfilling['tax_re_int_234b']) + ((int)$itr_taxfilling['tax_re_int_234c']);
	
	$itrXMLcal['TotTaxPlusIntrstPay'] = ((int)$itr_taxfilling['tax_re_total_taxpyble']) + ((int)$itr_taxfilling['tax_re_int_234a']) + ((int)$itr_taxfilling['tax_re_int_234b']) + ((int)$itr_taxfilling['tax_re_int_234c']);
	
	$itrXMLcal['AdvanceTax'] = $itrFill->getSum('reco_txpaidadv_amount','itr_taxreconci_taxpaid_advan',$fr_itr_id,$fr_user_id);
	
	//$itrXMLcal['TDS'] = ($itrFill->getSum('reco_tdsonsal_tdsdeduc','itr_taxreconci_tds',$fr_itr_id,$fr_user_id)) + ($itrFill->getSum('reco_tdsothsal_tdsclaim',' itr_taxreconci_tdsothsal',$fr_itr_id,$fr_user_id));
	
	$itrXMLcal['TDS'] = ($itrFill->getSum('tax_re_total_taxpaid','itr_taxfilling',$fr_itr_id,$fr_user_id)) ;
	
	$itrXMLcal['SelfAssessmentTax'] = $itrFill->getSum('reco_selfasstxpd_amount','itr_taxreconci_selfasstaxpaid',$fr_itr_id,$fr_user_id);
	
	$itrXMLcal['AssesseeVerName'] = $itr_profile['itr_pd_fname'].' '.$itr_profile['itr_pd_mname'].' '.$itr_profile['itr_pd_lname'];

	$ResidenceName = '';
	if($itr_profile['itr_cond_buname'] != '')
	{
		$ResidenceName .= '<ITRForm:ResidenceName>'.$itr_profile['itr_cond_buname'].'</ITRForm:ResidenceName>';
	}
	
	$RoadOrStreet = '';
	if($itr_profile['itr_cond_ro_st_po'] != '')
	{
		$RoadOrStreet .= '<ITRForm:RoadOrStreet>'. $itr_profile['itr_cond_ro_st_po'].'</ITRForm:RoadOrStreet>';
	}
	
	$Section80DUsrType = '';
	if($itrXMLcal['Section80DUsrType'] != 0)
	{
		$Section80DUsrType .= '<ITRForm:Section80DUsrType>'. $itrXMLcal['Section80DUsrType'].'</ITRForm:Section80DUsrType>';
	}

?>