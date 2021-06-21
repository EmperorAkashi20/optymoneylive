<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta charset="utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php
echo   "<pre>";

//echo $output = shell_exec('java -jar pdfbox-app-2.0.8.jar ExtractText 2.pdf 2.txt');
$output = shell_exec('java -jar pdfbox-app-2.0.8.jar ExtractText -console -password 2710198811 11.pdf');
echo   "<pre>";
echo $output;

if($output == '')
	$output = shell_exec('java -jar pdfbox-app-2.0.8.jar ExtractText -console -password 27101988 11.pdf');
	
$output = str_replace("(","",str_replace(")","",str_replace(" ","_",str_replace("\n","#",trim(strtolower($output))))));
preg_match('/total_tax_deducted#(.*?)sr/', $output, $field1);
$tot_tds = explode(".00",$field1[1]);
echo "Total TDS : ".number_format($tot_tds[1],2)."<br>";

preg_match('/financial_year_assessment_year(.*?)_/', $output, $field2);
echo "PAN : ".strtoupper($field2[1])."<br>";
//var_dump($field2);
//echo $output;
exit;

echo $a=str_replace("(","",str_replace(")","",str_replace(" ","_",str_replace("\r\n","#",trim(strtolower($a))))));
preg_match('/#name_and_address_of_the_deductor#(.*?)#name_and_address_of_the_deductee#/', $a, $field1);
$a1 = explode("\r\n",$a);
print_r($field1);
//java -jar pdfbox-app-2.0.8.jar ExtractText 4.pdf 41.txt

//$a=file_get_contents("41.txt");
//exit;
echo   "<pre>";
$b = strtolower($a);
 //$arr = str_word_count($a, 1,"0..3");
 //echo $a;
 echo $a=str_replace("(","",str_replace(")","",str_replace(" ","_",str_replace("\r\n","#",trim(strtolower($a))))));

echo "<br><br>1.  ";

preg_match('/#name_and_address_of_the_deductor#(.*?)#name_and_address_of_the_deductee#/', $a, $field1);
if(count($field1) == 0)
	preg_match('/#name_and_address_of_the_employer#(.*?)#name_and_address_of_the_employee#/', $a, $field1);
print_r($field1[1]);echo "<br>";echo "2.  ";

preg_match('/#name_and_address_of_the_deductee#(.*?)#pan_of_the_deductor#/', $a, $field2);
if(count($field2) == 0) 
	preg_match('/#name_and_address_of_the_employee#(.*?)#pan_of_the_deductor#/', $a, $field2);
print_r($field2[1]);echo "<br>";echo "3.  ";

preg_match('/#pan_of_the_deductor#(.*?)#tan_of_the_deductor#/', $a, $field3);
print_r($field3[1]);echo "<br>4. ";

preg_match('/#tan_of_the_deductor#(.*?)#pan_of_the_deductee#/', $a, $field4);
if(count($field4) == 0)
	preg_match('/#tan_of_the_deductor#(.*?)#pan_of_the_employee#/', $a, $field4);
print_r($field4[1]);echo "<br>5. ";

preg_match('/#pan_of_the_deductee#(.*?)#assessment_year#/', $a, $field5);
if(count($field5) == 0)
	preg_match('/#pan_of_the_employee#(.*?)#assessment_year#/', $a, $field5);
print_r($field5[1]);echo "<br>6. ";

preg_match('/#assessment_year#(.*?)#cit_tds#/', $a, $field6);
print_r($field6[1]);echo "<br>7.  ";

preg_match('/#period#(.*?)#summary_of_payment#/', $a, $field7);
if(count($field7) == 0)
	preg_match('/#period_with_the_employer#(.*?)#summary_of_amount_paid(.*?)#/', $a, $field7);
print_r($field7[1]);echo "<br>8. ";

preg_match('/#total_rs(.*?)#summary_of_tax_deducted_at_source_in_respect_of_deductee#/', $a, $field8);
if(count($field8) == 0)
	preg_match('/#c_total_tax_paid(.*?)#/', $a, $field8);
if(count($field8) == 0)
	preg_match('/#total_rs(.*?)#legend_used_in_form_16#/', $a, $field8);
if(count($field8) == 0)
	preg_match('/that_a_sum_of_rs._#(.*?)#_/', $a, $field8);
	
print_r(ltrim($field8[1],"."));echo "<br>";

echo "<br>===================== PART B ========================<br>9 - ";
if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
    $newLine="\n";;
} else {
    $newLine="\r\n";
}
$arr = explode($newLine,strtolower($b));
//print_r($arr);
preg_match('/balance_1-2(.*?)#/', $a, $field9);				//var_dump($field9);
if(count($field9) == 0)
	preg_match('/balance_1-2(.*?)._/', $a, $field9);				//\]var_dump($field9);
if(count($field9) == 0)
{	
	while(list($key,$val)=each($arr))
	{
		 if(substr_count(strtolower($val), 'balance') != 0)
		 {
		 	$before = str_replace("_","",str_replace("rs","",str_replace(" ","_",strtolower(trim($arr[$key-1])))));
			$after  = str_replace("_","",str_replace("rs","",str_replace(" ","_",strtolower(trim($arr[$key+1])))));
			preg_match('/[^0-9,.]\D/', $before,$chkString);
			preg_match('/[^0-9,.]\D/', $after,$chkString1);
			$balance = '';
			if(count($chkString) == 0)
				$balance = str_replace(",","",$before);
			else if(count($chkString1) == 0)
				$balance = str_replace(",","",$after);
				
			echo $balance;
		 	break;
		 }
	}
}
else
	echo preg_replace("/[^0-9,.]/", "", $field9[1]);				//var_dump($field11);

echo "<br>10 - ";

preg_match('/#aentertainment_allowance_(.*?)#/', $a, $field10);				//var_dump($field9);
if(count($field10) == 0)
	preg_match('/a_entertainment_allowance_(.*?)b_tax_on_employment/', $a, $field10);				//var_dump($field9);

echo preg_replace("/[^0-9]/", "", $field10[1]);	
echo "<br>11 - ";

preg_match('/#btax_on_employment(.*?)#/', $a, $field11);				//var_dump($field11);
if(count($field11) == 0)
	preg_match('/b_tax_on_employment(.*?)5._aggregate/', $a, $field11);				//var_dump($field9);

echo preg_replace("/[^0-9]/", "", $field11[1]);				//var_dump($field11);
//print_r($field11[1]);
echo "<br>12 - ";
$c = str_replace(" ","_",str_replace($newLine,"#",$b));

preg_match('/9._deduction(.*?)11._total/', $a, $ded_80cdg);				//PF
preg_match('/9._deduction(.*?)11._total/', $c, $ded_80cdg1);				//PF

//print_r($ded_80cdg);
//print_r($ded_80cdg1);
if(count($ded_80cdg) > 0 && count($ded_80cdg1)> 0)
{
	$d = explode(")",$ded_80cdg1[0]);
	//print_r($d);
	$amtCount = substr_count($d[1],"amount");
	echo "<br> ....".$amtCount."<br>";
	if($amtCount == 0)			// Calculate with HASH
	{
		$arr1 = preg_split('/(?<=[0-9])(?=[a-z]+)/i',$d[2]);        // 80c array                                                       
		$section80c=0;
		print_r($arr1);
		while(list($key,$val)=each($arr1))
		{
			//echo trim($val);
			if(strstr($val,"section") === false)
			{
				echo "<br>dd".trim($val);
				$arr2 = explode("#",$val);
				print_r($arr2);echo $key;
			}
		}
	}
	else
	{
		$arr1 = preg_split('/(?<=[0-9])(?=[a-z]+)/i',$d[2]);        // 80c array                                                       
		$section80c=0;
		print_r($arr1);
		while(list($key,$val)=each($arr1))
		{
			$removeChar = preg_replace("/[^0-9,.]/", "", $val);	
			if(substr_count($removeChar,substr($removeChar,0,3)) == $amtCount)
			{
				//echo "<br>".$removeChar."<br>";
				$valArr = explode(substr($removeChar,0,3),$val);
				//print_r($valArr);
				$finalVal = preg_replace("/[^0-9.]/", "",substr($removeChar,0,3).$valArr[count($valArr)-1]);
				echo $valArr[0]." - ".number_format($finalVal,2);
				echo "<br>";
				$section80c = $section80c+$finalVal;
			}	
			else
			{
				$val = str_replace("section","",$val);
				if(strlen($val) > 4)
				{
					$valArr = explode(".",$val);		//print_r($valArr);
					if(count($valArr) > 2)
					{
						echo preg_replace("/[^a-z_]/", "", $valArr[0])." - ".$valArr[count($valArr)-2],2;
						$section80c = $section80c + str_replace(",","",$valArr[count($valArr)-2]);
					}
				}
			}
		}
	}
	echo "<br>-------".number_format($section80c,2)."---------<br>";

	$arr2 = preg_split('/(?<=[0-9])(?=[a-z]+)/i',$d[3]);        // 80ccc array                                                       
	$section80ccc=0;
	//print_r($arr2);

}
preg_match('/#i_pf(.*?)#/', $a, $field12);				//PF
print_r(str_replace("_","",str_replace("rs","",$field12[1])));

if(count($field12) == 0)
{
	$b=str_replace("\r\n","#",trim(strtolower($b)));
	preg_match('/section 80c(.*?)section 80ccc/', $b, $field12);		//$b=explode("\r\n",trim(strtolower($b))); print_r($b); echo nl2br($b[152]);
	$s80c = explode("pf",$field12[1]);
	echo substr($s80c[1],0,10);		// PF
	echo ".... Other : ".$s80c[0];		// Other
}

preg_match('/ii_lic(.*?)#/', $a, $field13);				//LIC
print_r(str_replace("_","",str_replace("rs","",$field13[1])));echo "<br>14.";
if(count($field13) == 0)
{
	$b=str_replace("\r\n","#",trim(strtolower($b)));
	preg_match('/lic(.*?)a/', $b, $field12);		//$b=explode("\r\n",trim(strtolower($b))); print_r($b); echo nl2br($b[152]);
}
	
	preg_match('/#iii_total_of_80_c_qualifying:(.*?)#/', $a, $field14);				//80C Qualifying
	print_r(str_replace("_","",str_replace("rs","",$field14[1])));echo "<br>15.";
	
preg_match('/#b_sections_80ccc_(.*?)#/', $a, $field15);				//80Ccc 
print_r(str_replace("_","",str_replace("rs","",$field15[1])));echo "<br>16.";
if(count($field15) == 0)
{
	$b=str_replace("\r\n","#",trim(strtolower($b)));
	preg_match('/section 80ccc(.*?)section 80ccd/', $b, $field15);		//$b=explode("\r\n",trim(strtolower($b))); print_r($b); echo nl2br($b[152]);
	echo $field15[1];		// Other
}
	
	preg_match('/#c_sections_80ccd(.*?)#/', $a, $field16);				//80Ccd 
	print_r(str_replace("_","",str_replace("rs","",$field16[1])));echo "<br>17.";
if(count($field16) == 0)
{
	$b=str_replace("\r\n","#",trim(strtolower($b)));
	preg_match('/section 80ccd(.*?)note/', $b, $field16);		//$b=explode("\r\n",trim(strtolower($b))); print_r($b); echo nl2br($b[152]);
	echo $field16[1];		// Other
	//echo $b;
	//print_r( $field16);
}
	
	preg_match('/#isection_80_d_-_mediclaim_policy(.*?)#/', $a, $field17);				//Mediclaim 
	print_r(str_replace("rs","",str_replace("_","",$field17[1])));echo "<br>18.";
	
	
	preg_match('/#iisection__(.*?)#/', $a, $field18);				//80 g donation 
	print_r(str_replace("-donations50%exempt","",str_replace("_","",str_replace("rs","",$field18[1]))));echo "<br>19.";
	
		
	preg_match('/#iiisection_80ccg1_rgessrs_(.*?)#/', $a, $field19);				//RGESS
	print_r(str_replace("_","",str_replace("rs","",$field19[1])));echo "<br>20.";
	
	
	preg_match('/#ivsection_total_of_chapter_vi_a_qualifying(.*?)#/', $a, $field20);				//80 g donation 
	print_r(str_replace("rs","",str_replace(":","",str_replace("_","",$field20[1]))));echo "<br>21.";
	
	preg_match('/#10.aggregate_of_deductible_amount_under_chapter_via_&_80c(.*?)#/', $a, $field21);				//80 g donation 
	print_r(str_replace("_","",str_replace("rs","",$field21[1])));echo "<br>";

?>
</body>
</html>
