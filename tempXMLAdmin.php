<?php
	include("__lib.includes/config.inc.php");
	if(!($_SESSION['oPageAccess'])) { header("HTTP/1.1 401 Unauthorized");header("Location: $CONFIG->siteurl");exit;}
	
	$fr_itr_id	=	$_GET['fr_itr_id'];
	$fr_user_id	=	$_GET['fr_user_id'];
	
	$_SESSION[$CONFIG->sessionPrefix.'_ITR_ID']		= $fr_itr_id;
	$_SESSION[$CONFIG->sessionPrefix."user_id"]		= $fr_user_id;

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
		
		//print_r($_SESSION);exit;
		
	$itrXMLcal = array();
	
	$fyear = "2019-07-31";

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
	$itrXMLcal['TotalIncomeOfHP'] = (((int)$sum1) + ((int)$sum2) * -1);
	$dateOfBirth = $itr_profile['itr_pd_dob'];
	$itrXMLcal['Section80DUsrType'] = 0;
	$userAgeOrSelf = date_diff(date_create($dateOfBirth), date_create(date("Y-m-d")))->format('%y');
	$parentAge = date_diff(date_create($itr_deduction['ded_hi_hip80d_ageoparent']), date_create(date("Y-m-d")))->format('%y');
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

	$itrXMLcal['Section80D'] = (((int)$itr_deduction['ded_hi_hip80d_ssc']) + ((int)$itr_deduction['ded_hi_hip80d_parents']));
	
	$donamt100 = $itrFill->getDonation('dona_80g_damount','itr_donation',$fr_itr_id,$fr_user_id,1);
	$donamt50 = $itrFill->getDonation('dona_80g_damount','itr_donation',$fr_itr_id,$fr_user_id,0);
	$itrXMLcal['Section80G'] = $donamt100 + ($donamt50/2);

	$itrXMLcal['TotalChapVIADeductions'] = $itrXMLcal['Section80D'] + $itr_deduction['ded_othd_80dd'] + $itr_deduction['ded_othd_80ddb'] + $itr_deduction['ded_othd_80e'] + $itr_deduction['ded_othd_80ee'] + $itrXMLcal['Section80G'] + $itr_deduction['ded_gd__80gg'] + $itr_deduction['ded_othdon_80gga_dfsrrd'] + $itr_deduction['ded_othdon_80ggc_dpp'] + $itr_deduction['ded_othd_80u'] + $itr_deduction['ded_othd_80rrb'] + $itr_deduction['ded_othd_80qqb'] + $itr_deduction['ded_othd_80ccg'] + $itr_deduction['ded_gd__80tta'];
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
	$itrXMLcal['S80CCDEmployer'] = $itr_taxfilling['tax_re_inccha_undsal'];
	 $salinccal = (10/100)*$itr_taxfilling['tax_re_inccha_undsal'];
	if($salinccal >$salinccal)
	{
	  $itrXMLcal['S80CCDEmployer'] = $salinccal;
	}
	
	$S7_93 = $itr_deduction['ded_hi_hip80d_ssc'];
	$S7_94 = $itr_deduction['ded_hi_hip80d_parents'];
	if($userAgeOrSelf < 60)
	{
	  $S7_93 = 25000;
	}
	else
	{
	  $S7_93 = 30000;
	}
	if($parentAge < 60)
	{
	  $S7_94 = 25000;
	}
	else
	{
	  $S7_94  = 30000;
	}

	$itrXMLcal['S80D'] = $S7_93 + $S7_94;
	
	$itrXMLcal['S80DD'] = $itr_deduction['ded_othd_80dd'];
	if($itrXMLcal['S80DD'] > 125000)
	{
	  $itrXMLcal['S80DD'] =125000;
	}
	
	$itrXMLcal['S80DDB'] = $itr_deduction['ded_othd_80ddb'];
	if($userAgeOrSelf < 60)
	{
	  $itrXMLcal['S80DDB'] = 40000;
	}
	elseif($userAgeOrSelf >= 60)
	{
	  $itrXMLcal['S80DDB'] = 60000;
	}
	elseif($userAgeOrSelf >= 80)
	{
	   $itrXMLcal['S80DDB'] = 80000;
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
	
	$value1 = $itr_deduction['ded_gd__80gg'] - (10/100)*$netIncCal;
	$value2 =  60000;
	$value3 = (25/100)*$netIncCal;
	$calvalue = 0;
	if($value1 < $value2 && $value1 < $value3 )
	{
	  $calvalue = $value1;
	}
	elseif ($value2 < $value1 && $value2 < $value3) {
	  $calvalue = $value2;
	}
	elseif ($value3 < $value1 && $value3 < $value2) {
	  $calvalue = $value3;
	}
	$itrXMLcal['S80GG'] = $calvalue;
	$itrXMLcal['S_TotalChapVIADeductions'] = $S13except_TotalChapVIADeductions + $itrXMLcal['S80GG'];
	//echo "<pre>";
	//print_r($itr_donation);
	$donationXmlStr='<ITRForm:Schedule80G>';$flag = 0;
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
	
	$itrXMLcal['TDS'] = ($itrFill->getSum('reco_tdsonsal_tdsdeduc','itr_taxreconci_tds',$fr_itr_id,$fr_user_id)) + ($itrFill->getSum('reco_tdsothsal_tdsclaim',' itr_taxreconci_tdsothsal',$fr_itr_id,$fr_user_id));
	
	$itrXMLcal['SelfAssessmentTax'] = $itrFill->getSum('reco_selfasstxpd_amount','itr_taxreconci_selfasstaxpaid',$fr_itr_id,$fr_user_id);
	
	$itrXMLcal['AssesseeVerName'] = $itr_profile['itr_pd_fname'].''.$itr_profile['itr_pd_mname'].''.$itr_profile['itr_pd_lname'];

header("Content-Type: application/xml");
if($_REQUEST[at] == 'save')
	header('Content-Disposition: attachment; filename="ITR.xml"');
echo '<?xml version="1.0" encoding="ISO-8859-1"?>
 <ITRETURN:ITR xmlns:ITRETURN="http://incometaxindiaefiling.gov.in/main" xmlns:ITR1FORM="http://incometaxindiaefiling.gov.in/ITR1" xmlns:ITRForm="http://incometaxindiaefiling.gov.in/master" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
  <ITR1FORM:ITR1>
  <ITRForm:CreationInfo>
  <ITRForm:SWVersionNo>R1</ITRForm:SWVersionNo>
  <ITRForm:SWCreatedBy>SW92201718</ITRForm:SWCreatedBy>
  <ITRForm:XMLCreatedBy>SW92201718</ITRForm:XMLCreatedBy>
  <ITRForm:XMLCreationDate>2019-02-28</ITRForm:XMLCreationDate>
  <ITRForm:IntermediaryCity>Delhi</ITRForm:IntermediaryCity>
  <ITRForm:Digest>4cEBR9WZtNsW9s9E4qz+WhE9zydtXughD1fYBVQM654=</ITRForm:Digest>
  </ITRForm:CreationInfo>
  <ITRForm:Form_ITR1>
  <ITRForm:FormName>ITR-1</ITRForm:FormName>
  <ITRForm:Description>For Indls having Income from Salary, Pension, family pension and Interest</ITRForm:Description>
  <ITRForm:AssessmentYear>2017</ITRForm:AssessmentYear>
  <ITRForm:SchemaVer>Ver1.0</ITRForm:SchemaVer>
  <ITRForm:FormVer>Ver1.0</ITRForm:FormVer>
  </ITRForm:Form_ITR1>
  <ITRForm:PersonalInfo>
  <ITRForm:AssesseeName>
  <ITRForm:FirstName>'.$itr_profile['itr_pd_fname'].'</ITRForm:FirstName>
  <ITRForm:SurNameOrOrgName>'.$itr_profile['itr_pd_lname'].'</ITRForm:SurNameOrOrgName>
  </ITRForm:AssesseeName>
  <ITRForm:PAN>'.$itr_profile['itr_pd_pan_number'].'</ITRForm:PAN>
  <ITRForm:Address>
  <ITRForm:ResidenceNo>'.$itr_profile['itr_cond_fl_do_bl'].'</ITRForm:ResidenceNo>
  <ITRForm:ResidenceName>'.$itr_profile['itr_cond_buname'].'</ITRForm:ResidenceName>
  <ITRForm:RoadOrStreet>'.$itr_profile['itr_cond_ro_st_po'].'</ITRForm:RoadOrStreet>
  <ITRForm:LocalityOrArea>'.$itr_profile['itr_cond_area_loc'].'</ITRForm:LocalityOrArea>
  <ITRForm:CityOrTownOrDistrict>'.$itr_profile['itr_cond_city'].'</ITRForm:CityOrTownOrDistrict>
  <ITRForm:StateCode>'.$itr_profile['itr_cond_state'].'</ITRForm:StateCode>
  <ITRForm:CountryCode>'.$itr_profile['itr_cond_country'].'</ITRForm:CountryCode>
  <ITRForm:PinCode>'.$itr_profile['itr_cond_pin_code'].'</ITRForm:PinCode>
  <ITRForm:MobileNo>'.$itr_profile['itr_cond_mobile_number'].'</ITRForm:MobileNo>
  <ITRForm:EmailAddress>'.$itr_profile['itr_cond_email_id'].'</ITRForm:EmailAddress>
  </ITRForm:Address>
  <ITRForm:DOB>'.$itr_profile['itr_pd_dob'].'</ITRForm:DOB>
  <ITRForm:EmployerCategory>'.$itr_sou_salary[0]['sou_sa_employer_type'].'</ITRForm:EmployerCategory>
  <ITRForm:AadhaarCardNo>'.$itr_profile['itr_pd_adhar_no'].'</ITRForm:AadhaarCardNo>
  </ITRForm:PersonalInfo>
  <ITRForm:FilingStatus>
  <ITRForm:ReturnFileSec>'.$itrXMLcal['ReturnFileSec'].'</ITRForm:ReturnFileSec>
  <ITRForm:ReturnType>'.$itrXMLcal['ReturnType'].'</ITRForm:ReturnType>
  <ITRForm:ResidentialStatus>'.$itr_profile['itr_pd_resi_sta'].'</ITRForm:ResidentialStatus>
  <ITRForm:PortugeseCC5A>N</ITRForm:PortugeseCC5A>
  </ITRForm:FilingStatus>
  <ITRForm:ITR1_IncomeDeductions>
  <ITRForm:IncomeFromSal>'.$itr_taxfilling['tax_re_inccha_undsal'].'</ITRForm:IncomeFromSal>
  <ITRForm:TypeOfHP>'.$itrXMLcal['TypeOfHP'].'</ITRForm:TypeOfHP>
  <ITRForm:TotalIncomeOfHP>'.$itrXMLcal['TotalIncomeOfHP'].'</ITRForm:TotalIncomeOfHP>
  <ITRForm:IncomeOthSrc>'.$itr_taxfilling['tax_re_inc_othsou'].'</ITRForm:IncomeOthSrc>
  <ITRForm:GrossTotIncome>'.$itr_taxfilling['tax_re_gro_totinc'].'</ITRForm:GrossTotIncome>
  <ITRForm:UsrDeductUndChapVIA>
  <ITRForm:Section80C>'.$itr_deduction['ded_gd__80c'].'</ITRForm:Section80C>
  <ITRForm:Section80CCC>'.$itr_deduction['ded_othd_80ccc'].'</ITRForm:Section80CCC>
  <ITRForm:Section80CCDEmployeeOrSE>'.$itr_deduction['ded_othd_80ccd1'].'</ITRForm:Section80CCDEmployeeOrSE>
  <ITRForm:Section80CCD1B>'.$itr_deduction['ded_othd_80ccd1b'].'</ITRForm:Section80CCD1B>
  <ITRForm:Section80CCDEmployer>'.$itr_deduction['ded_othd_80ccd2'].'</ITRForm:Section80CCDEmployer>
  <ITRForm:Section80DUsrType>'.$itrXMLcal['Section80DUsrType'].'</ITRForm:Section80DUsrType>
  <ITRForm:Section80D>'.$itrXMLcal['Section80D'].'</ITRForm:Section80D>
  <ITRForm:Section80DD>'.$itr_deduction['ded_othd_80dd'].'</ITRForm:Section80DD>
  <ITRForm:Section80DDB>'.$itr_deduction['ded_othd_80ddb'].'</ITRForm:Section80DDB>
  <ITRForm:Section80E>'.$itr_deduction['ded_othd_80e'].'</ITRForm:Section80E>
  <ITRForm:Section80EE>'.$itr_deduction['ded_othd_80ee'].'</ITRForm:Section80EE>
  <ITRForm:Section80G>'.$itrXMLcal['Section80G'].'</ITRForm:Section80G>
  <ITRForm:Section80GG>'.$itr_deduction['ded_gd__80gg'].'</ITRForm:Section80GG>
  <ITRForm:Section80GGA>'.$itr_deduction['ded_othdon_80gga_dfsrrd'].'</ITRForm:Section80GGA>
  <ITRForm:Section80GGC>'.$itr_deduction['ded_othdon_80ggc_dpp'].'</ITRForm:Section80GGC>
  <ITRForm:Section80U>'.$itr_deduction['ded_othd_80u'].'</ITRForm:Section80U>
  <ITRForm:Section80RRB>'.$itr_deduction['ded_othd_80rrb'].'</ITRForm:Section80RRB>
  <ITRForm:Section80QQB>'.$itr_deduction['ded_othd_80qqb'].'</ITRForm:Section80QQB>
  <ITRForm:Section80CCG>'.$itr_deduction['ded_othd_80ccg'].'</ITRForm:Section80CCG>
  <ITRForm:Section80TTA>'.$itr_deduction['ded_gd__80tta'].'</ITRForm:Section80TTA>
  <ITRForm:TotalChapVIADeductions>'.$itrXMLcal['TotalChapVIADeductions'].'</ITRForm:TotalChapVIADeductions>
  </ITRForm:UsrDeductUndChapVIA>
  <ITRForm:DeductUndChapVIA>
  <ITRForm:Section80C>'.$itrXMLcal['S80c'].'</ITRForm:Section80C>
  <ITRForm:Section80CCC>'.$itrXMLcal['S80ccc'].'</ITRForm:Section80CCC>
  <ITRForm:Section80CCDEmployeeOrSE>'.$itrXMLcal['S80ccd'].'</ITRForm:Section80CCDEmployeeOrSE>
  <ITRForm:Section80CCD1B>'.$itrXMLcal['S80CCD1B'].'</ITRForm:Section80CCD1B>
  <ITRForm:Section80CCDEmployer>'.$itrXMLcal['S80CCDEmployer'].'</ITRForm:Section80CCDEmployer>
  <ITRForm:Section80D>'.$itrXMLcal['S80D'].'</ITRForm:Section80D>
  <ITRForm:Section80DD>'.$itrXMLcal['S80DD'].'</ITRForm:Section80DD>
  <ITRForm:Section80DDB>'.$itrXMLcal['S80DDB'].'</ITRForm:Section80DDB>
  <ITRForm:Section80E>'.$itrXMLcal['S80E'].'</ITRForm:Section80E>
  <ITRForm:Section80EE>'.$itrXMLcal['S80EE'].'</ITRForm:Section80EE>
  <ITRForm:Section80G>'.$itrXMLcal['S80G'].'</ITRForm:Section80G>
  <ITRForm:Section80GG>'.$itrXMLcal['S80GG'].'</ITRForm:Section80GG>
  <ITRForm:Section80GGA>'.$itrXMLcal['S80GGA'].'</ITRForm:Section80GGA>
  <ITRForm:Section80GGC>'.$itrXMLcal['S80GGC'].'</ITRForm:Section80GGC>
  <ITRForm:Section80U>'.$itrXMLcal['S80U'].'</ITRForm:Section80U>
  <ITRForm:Section80RRB>'.$itrXMLcal['S80RRB'].'</ITRForm:Section80RRB>
  <ITRForm:Section80QQB>'.$itrXMLcal['S80QQB'].'</ITRForm:Section80QQB>
  <ITRForm:Section80CCG>'.$itrXMLcal['S80CCG'].'</ITRForm:Section80CCG>
  <ITRForm:Section80TTA>'.$itrXMLcal['S80TTA'].'</ITRForm:Section80TTA>
  <ITRForm:TotalChapVIADeductions>'.$itrXMLcal['S_TotalChapVIADeductions'].'</ITRForm:TotalChapVIADeductions>
  </ITRForm:DeductUndChapVIA>
  <ITRForm:TotalIncome>'.$itr_taxfilling['tax_re_tot_taxinc'].'</ITRForm:TotalIncome>
  </ITRForm:ITR1_IncomeDeductions>
  <ITRForm:ITR1_TaxComputation>
  <ITRForm:TotalTaxPayable>'.$itr_taxfilling['tax_re_tax_totinc'].'</ITRForm:TotalTaxPayable>
  <ITRForm:Rebate87A>'.$itr_taxfilling['tax_re_rebate'].'</ITRForm:Rebate87A>
  <ITRForm:TaxPayableOnRebate>'.$itr_taxfilling['tax_re_taxaft_rebate'].'</ITRForm:TaxPayableOnRebate>
  <ITRForm:EducationCess>'.$itr_taxfilling['tax_re_cess'].'</ITRForm:EducationCess>
  <ITRForm:GrossTaxLiability>'.$itrXMLcal['GrossTaxLiability'].'</ITRForm:GrossTaxLiability>
  <ITRForm:Section89>'.$itr_taxfilling['tax_re_sec89_relief'].'</ITRForm:Section89>
  <ITRForm:NetTaxLiability>'.$itrXMLcal['NetTaxLiability'].'</ITRForm:NetTaxLiability>
  <ITRForm:TotalIntrstPay>'.$itrXMLcal['TotalIntrstPay'].'</ITRForm:TotalIntrstPay>
  <ITRForm:IntrstPay>
  <ITRForm:IntrstPayUs234A>'.$itr_taxfilling['tax_re_int_234a'].'</ITRForm:IntrstPayUs234A>
  <ITRForm:IntrstPayUs234B>'.$itr_taxfilling['tax_re_int_234b'].'</ITRForm:IntrstPayUs234B>
  <ITRForm:IntrstPayUs234C>'.$itr_taxfilling['tax_re_int_234c'].'</ITRForm:IntrstPayUs234C>
  </ITRForm:IntrstPay>
  <ITRForm:TotTaxPlusIntrstPay>'.$itrXMLcal['TotTaxPlusIntrstPay'].'</ITRForm:TotTaxPlusIntrstPay>
  </ITRForm:ITR1_TaxComputation>
  <ITRForm:TaxPaid>
  <ITRForm:TaxesPaid>
  <ITRForm:AdvanceTax>'.$itrXMLcal['AdvanceTax'].'</ITRForm:AdvanceTax>
  <ITRForm:TDS>'.$itrXMLcal['TDS'].'</ITRForm:TDS>
  <ITRForm:TCS>0</ITRForm:TCS>
  <ITRForm:SelfAssessmentTax>'.$itrXMLcal['SelfAssessmentTax'].'</ITRForm:SelfAssessmentTax>
  <ITRForm:TotalTaxesPaid>'.$itr_taxfilling['tax_re_total_taxpaid'].'</ITRForm:TotalTaxesPaid>
  <ITRForm:ExcIncSec1038>'.$itr_sou_other['sou_oth_exi_ltcg'].'</ITRForm:ExcIncSec1038>
  <ITRForm:ExcIncSec1034>'.$itr_sou_other['sou_oth_exi_diviinc'].'</ITRForm:ExcIncSec1034>
  </ITRForm:TaxesPaid>
  <ITRForm:BalTaxPayable>'.$itr_taxfilling['tax_re_bal_taxtopaid'].'</ITRForm:BalTaxPayable>
  </ITRForm:TaxPaid>
  <ITRForm:Refund>
  <ITRForm:RefundDue>'.$itr_taxfilling['tax_re_ref_recev'].'</ITRForm:RefundDue>
  <ITRForm:BankAccountDtls>
  <ITRForm:BankDtlsFlag>Y</ITRForm:BankDtlsFlag>
  <ITRForm:PriBankDetails>
  <ITRForm:IFSCCode>'.$itr_taxfilling['tax_bkd_ifsc'].'</ITRForm:IFSCCode>
  <ITRForm:BankName>'.$itr_taxfilling['tax_bkd_bname'].'</ITRForm:BankName>
  <ITRForm:BankAccountNo>'.$itr_taxfilling['tax_bkd_accno'].'</ITRForm:BankAccountNo>
  <ITRForm:CashDeposited>'.$itr_taxfilling['tax_bkd_add_demo'].'</ITRForm:CashDeposited>
  </ITRForm:PriBankDetails>
  </ITRForm:BankAccountDtls>
  </ITRForm:Refund>'.$donationXmlStr . $TDSonXmlStr . $TDSonOthThanSals_XmlStr . $TaxPayments_XmlStr.'
<ITR1FORM:TaxExmpIntInc>'.$itr_sou_other['sou_oth_oi_agriinc'].'</ITR1FORM:TaxExmpIntInc>
<ITRForm:Verification>
<ITRForm:Declaration>
<ITRForm:AssesseeVerName>'.$itrXMLcal['AssesseeVerName'].'</ITRForm:AssesseeVerName>
<ITRForm:FatherName>'.$itr_profile['itr_pd_father_name'].'</ITRForm:FatherName>
<ITRForm:AssesseeVerPAN>'.$itr_profile['itr_pd_pan_number'].'</ITRForm:AssesseeVerPAN>
</ITRForm:Declaration>
<ITRForm:Place>'.$itr_taxfilling['tax_re_place'].'</ITRForm:Place>
<ITRForm:Date>'.$itr_taxfilling['tax_re_date'].'</ITRForm:Date>
</ITRForm:Verification>
</ITR1FORM:ITR1>
</ITRETURN:ITR>';
?>