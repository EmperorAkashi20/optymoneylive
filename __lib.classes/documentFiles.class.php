<?php
class documentFiles{

	function documentFiles()
	{
		global $CONFIG,$commonFunction,$customerLog;
		global $db;
		$this->db = $db;
		$this->dbName	 = $CONFIG->dbName;	
		$this->commonFunction	 = $commonFunction;	
		$this->CONFIG	 = $CONFIG;	
		$this->customerLog	 = $customerLog;	
		$this->documentFiles = array();
	}
	
	function addDocument($filePath,$fileName,$totalPages,$filesize,$userId='',$customerId='',$filetype='pdf')
	{		
		global $_SESSION;
		if($this->CONFIG->loggedUserId == '')
		{
			$SQL 		= "INSERT INTO bfsi_uploads SET
							file_name = '".$fileName."',
							file_size = '".$filesize."',
							file_type = 'pdf',							
							file_total_pages = '".$totalPages."',
							file_location = '".$this->CONFIG->uploadLinkPoint."'";	
			$docRes	 = $this->db->db_run_query($SQL);
			$docID	 = $this->db->db_insert_id();	
			$_SESSION[$this->CONFIG->sessionPrefix."new_user_upload"] = $docID;	
		}
		else
		{
			$getRows = $this->commonFunction->getSingleRow("SELECT * FROM bfsi_uploads WHERE fr_user_id = '".$this->CONFIG->loggedUserId."' AND 
									   fr_itr_id = '".$_SESSION['caTAX__ITR_ID']."' AND 
									   asses_year = '".$_SESSION[$this->CONFIG->sessionPrefix.'_AY_TEXT']."'");
			
			$docID	 = $getRows[pk_upload_id];			
			//echo  $filePath,$fileName,$totalPages,$filesize;
			$SQL 		= "UPDATE bfsi_uploads SET
							file_name = '".$fileName."',
							file_size = '".$filesize."',
							file_type = 'pdf',
							fr_customer_id='".$this->CONFIG->customerId."',
							file_total_pages = '".$totalPages."',
							file_location = '".$this->CONFIG->uploadLinkPoint."'
							 WHERE pk_upload_id = '".$docID."'";	
			/*echo "SQL:-".$sql;
			die();*/
			$docRes	= $this->db->db_run_query($SQL);
		}
		/*$_SESSION['form16text'] = $filePath;
		$filePath= "/var/www/test/__uploaded.files/storage_1/9115071910000003/\16_07_2019_06_43_57_1563259437.675_1.pdf";*/
		$fileText = $this->getFileText($filePath);
		$SQL = "UPDATE bfsi_uploads SET document_text = '".$fileText."' WHERE pk_upload_id  = '".$docID."'";						
		$docRes	= $this->db->db_run_query($SQL);   
		if($this->CONFIG->loggedUserId == '')
		{
			$_SESSION[$this->CONFIG->sessionPrefix."new_user_upload"] = $docID;
		}
		else
		{
			$this->customerLog->activityDocUpload($this->CONFIG->loggedUserId,$this->CONFIG->customerId,$this->CONFIG->loggedUserEmail,$custom_name,$this->CONFIG->loggedIP);
		}
		
		//$formDocID	 = $getRows[fr_itr_id];	

		/*$formDocID	 = $_SESSION['form16_id'];	
		unset($_SESSION['form16_id']);*/

		$form_id = $this->commonFunction->getform16id();//$_SESSION['form16_id'];	
		$formDocID	 =$form_id['pk_form_id'];
		//$_SESSION[$CONFIG->sessionPrefix.'_form16_id'] = "";	
		if($this->CONFIG->loggedUserId == '')
			return $docID;
		else
		{
			$this->txtToForm16DB($fileText,$formDocID);
			return $formDocID;

			// $res = $this->txtToForm16DB($fileText,$formDocID);
			// if($res){
			// 	echo '<script>alert("'.$res.'");</script>';
			// }
			// else
			// {
			// return $formDocID;
		//}
			
		}
	}
	
    function txtToForm16DB($getFileText,$geFormtDocID)
	{
		if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
			$newLine="\r\n";;
		} else {
			$newLine="\n";
		}	
		$a = str_replace("(","",str_replace(")","",str_replace(" ","_",str_replace($newLine,"#",trim(strtolower($getFileText))))));
		$a1a = str_replace("(","",str_replace(")","",str_replace(" ","_",str_replace("\n","#",trim(strtolower($getFileText))))));
		$b = str_replace($newLine,"#",trim(strtolower($getFileText)));
		$arr = explode($newLine,$getFileText);
        
		

		/*-----------------------------------------------------------------------------------------------
			$pan = $this->$commonFunction->get_pan();

        	preg_match('/#pan_of_the_employee#(.*?)#assessment_year#/', $a, $field5);
			if(count($field5) == 0)
				preg_match('/#pan_of_the_employee#(.*?)#assessment_year#/', $a, $field5);
			
			$pan_emp = explode("#", $field5[0]);
	      
	        $pan_emp = array_slice($pan_emp, -3,1);
	      
	        $pan_emp = strtoupper($pan_emp[0]);
	      
	        if($pan != $pan_emp){
	        	$error = "pan";
	        	return $error;
	        }

        /*-----------------------------------------------------------------------------------------------*/

        /*-----------------------------------------------------------------------------------------------

        preg_match('/#assessment_year#(.*?)#cit_tds#/', $a, $field6);
				
		$ass_yr = explode("#", $field6[0]);
      
        $ass_yr = array_slice($ass_yr, -3,1);
      
        $ass_yr = strtoupper($ass_yr[0]);

        $ass_yr = explode("-", $ass_yr);

        if($CONFIG->currentAY != $ass_yr)
        {
        	$error = "ay";
	        return $error;
        }

        /*-----------------------------------------------------------------------------------------------*/


		// FORM 16 PART B				print_r($field1[1]);//echo "<br>";//echo "2.  ";
		preg_match('/#name_and_address_of_the_deductor#(.*?)#name_and_address_of_the_deductee#/', $a, $field1);
		if(count($field1) == 0)
			preg_match('/#name_and_address_of_the_employer#(.*?)#name_and_address_of_the_employee#/', $a, $field1);
			
		//$this->db->db_run_query("UPDATE bfsi_form_16_a SET employer_address = '".$field1[1]."' WHERE pk_form_id  = '".$geFormtDocID."'"); 

				$sub_field1 = explode("#", $field1[1]);
				$employer_name = array_shift($sub_field1);
				$employer_name = str_replace("_", " ", $employer_name);
				$employer_name = ucwords($employer_name);
				/*--------------------------- Employer Name -------------------------------*/
				////echo "<br><br><hr>Emplyeer Name:---- ".$employer_name;
                //$this->update_form_16("employee_name",$employer_name,$geFormtDocID);
                if($employer_name)
                $this->db->db_run_query("UPDATE bfsi_form_16_a SET `employee_name`= '".$employer_name."' WHERE pk_form_id  = '".$geFormtDocID."'"); 
                
			  	 
              	$sub_field1_count = count($sub_field1);
              	
              	$sub_field1_add =  array_splice($sub_field1, 2);
              	
              	$address_of_employee = implode("", $sub_field1);
              	
              	$address_of_employee = str_replace("_", " ", $address_of_employee);
				$address_of_employee = ucwords($address_of_employee);
				

				/*--------------------------- Employer Address -------------------------------*/
              	////echo "<br><br><hr>Emplyeer Address:-- ".$address_of_employee;
                //$this->update_form_16("employer_address",$address_of_employee,$geFormtDocID);
                if($address_of_employee)
                $this->db->db_run_query("UPDATE bfsi_form_16_a SET `employer_address`= '".$address_of_employee."' WHERE pk_form_id  = '".$geFormtDocID."'"); 


		
		/*preg_match('/#PAN of the Deductor #(.*?)#pan_of_the_deductor#/', $a, $field2);
		if(count($field2) == 0) 
			preg_match('/#name_and_address_of_the_employee#(.*?)#pan_of_the_deductor#/', $a, $field2);
		//$this->db->db_run_query("UPDATE bfsi_form_16_a SET employee_address = '".$field2[1]."' WHERE pk_form_id  = '".$geFormtDocID."'"); 
		*/

		preg_match('/#pan_of_the_deductor#(.*?)#tan_of_the_deductor#/', $a, $field3);
		//$this->db->db_run_query("UPDATE bfsi_form_16_a SET deductor_pan = '".$field3[1]."' WHERE pk_form_id  = '".$geFormtDocID."'"); 
		
		/*//echo "<br><br><hr>Pan:------";
        print_r($field3);*/
        $pan_of_ded = explode("#", $field3[0]);
        /*//echo "<br><br><hr>pan_of_the_deductor:------";
        print_r($pan_of_ded);*/
        $pan_of_the_ded = array_slice($pan_of_ded, -3,1);
        ////echo "<br><br><hr>PAN of the Deductor:------ ".strtoupper($pan_of_the_ded[0]);
        //print_r($pan_of_the_ded);
        /*----------------------------------------------*/
        //$this->update_form_16("deductor_pan",$pan_of_the_ded[0],$geFormtDocID);
        $pan_of_the_ded = strtoupper($pan_of_the_ded[0]);
        if($pan_of_the_ded)
        $this->db->db_run_query("UPDATE bfsi_form_16_a SET `deductor_pan`= '".$pan_of_the_ded."' WHERE pk_form_id  = '".$geFormtDocID."'"); 

		
		preg_match('/#tan_of_the_deductor#(.*?)#pan_of_the_deductee#/', $a, $field4);
		if(count($field4) == 0)
			preg_match('/#tan_of_the_deductor#(.*?)#pan_of_the_employee#/', $a, $field4);
		//$this->db->db_run_query("UPDATE bfsi_form_16_a SET deductor_tan = '".$field4[1]."' WHERE pk_form_id  = '".$geFormtDocID."'"); 
		
		$tan_of_ded = explode("#", $field4[0]);
        /*//echo "<br><br><hr>pan_of_the_deductor:------";
        print_r($pan_of_ded);*/
        $tan_of_the_ded = array_slice($tan_of_ded, -3,1);
        ////echo "<br><br><hr>TAN of the Deductor:------ ".strtoupper($tan_of_the_ded[0]);
        $tan_of_the_ded = strtoupper($tan_of_the_ded[0]);
        //$this->update_form_16("deductor_tan",$tan_of_the_ded,$geFormtDocID);

        if($tan_of_the_ded)
        $this->db->db_run_query("UPDATE bfsi_form_16_a SET `deductor_tan`= '".$tan_of_the_ded."' WHERE pk_form_id  = '".$geFormtDocID."'"); 
		////echo "<br><br><hr>TAN of the Deductor:------".strtoupper($field3[1]);
		
		preg_match('/#pan_of_the_employee#(.*?)#assessment_year#/', $a, $field5);
		if(count($field5) == 0)
			preg_match('/#pan_of_the_employee#(.*?)#assessment_year#/', $a, $field5);
		//$this->db->db_run_query("UPDATE bfsi_form_16_a SET employee_pan = '".$field5[1]."' WHERE pk_form_id  = '".$geFormtDocID."'"); 
		////echo "<br><br><hr>PAN Employee:------";
		
		$pan_emp = explode("#", $field5[0]);
        /*//echo "<br><br><hr>pan_of_the_deductor:------";
        print_r($pan_of_ded);*/
        $pan_emp = array_slice($pan_emp, -3,1);
        ////echo "<br><br><hr>PAN of the Employee:------ ".strtoupper($pan_emp[0]);
        $pan_emp = strtoupper($pan_emp[0]);
      
        //$this->update_form_16("employee_pan",$pan_emp,$geFormtDocID);
        if($pan_emp)
        $this->db->db_run_query("UPDATE bfsi_form_16_a SET `employee_pan`= '".$pan_emp."' WHERE pk_form_id  = '".$geFormtDocID."'");

		
		preg_match('/#assessment_year#(.*?)#cit_tds#/', $a, $field6);
		//$this->db->db_run_query("UPDATE bfsi_form_16_a SET assessment_year = '".$field6[1]."' WHERE pk_form_id  = '".$geFormtDocID."'"); 
		
		$ass_yr = explode("#", $field6[0]);
        /*//echo "<br><br><hr>pan_of_the_deductor:------";
        print_r($pan_of_ded);*/
        $ass_yr = array_slice($ass_yr, -3,1);
        //echo "<br><br><hr>Assement Year:------ ".strtoupper($ass_yr[0]);
        $ass_yr = strtoupper($ass_yr[0]);
        
        
		
		preg_match('/#period_with_the_employer#(.*?)#rs.rs.#/', $a, $field7);
		if(count($field7) == 0)
			preg_match('/#period_with_the_employer#(.*?)#summary_of_amount_paid(.*?)#/', $a, $field7);
		//$this->db->db_run_query("UPDATE bfsi_form_16_a SET period_with_employer = '".$field7[1]."' WHERE pk_form_id  = '".$geFormtDocID."'"); 
		
		/*//echo "<br><br><hr>period_with:------ ";
		print_r($field7);*/

		$p_start = explode("#", $field7[0]);

		/*//echo "<br><br><hr>period_with_the_employer:------ ";
		print_r($p_start);*/

		$p_start_to   = $p_start[3];
		$p_start_form = $p_start[5];

		//echo "<br><br><hr>p_start_to:------ ".$p_start_to;
		//echo "<br><br><hr>p_start_form:------ ".$p_start_form;

		
		preg_match('/#salary_as_per_provisions_contained_in_section_171a(.*?)#bvalue_of_perquisites_under_section_172_as_per_form_no(.*?)#/', $a, $field8);
		/*------------------------ salary_as_per_provisions_contained_in_section_17(1)a --------------------------------*/
		//echo "<br><br><hr>salary_as_per_provisions_contained_in_section_17(1)a:------ ";
		print_r($field8[1]);
        $sec_17_1_a = $field8[1];
		if($sec_17_1_a)
        $this->db->db_run_query("UPDATE bfsi_form_16_a SET `section_17_1`= '".intval($sec_17_1_a)."' WHERE pk_form_id  = '".$geFormtDocID."'");
      
		
		preg_match('/#bvalue_of_perquisites_under_section_172_as_per_form_no._12ba,#wherever_applicable(.*?)#cprofits_in_lieu_of_salary_under_section_173_as_per_form_no.#/', $a, $field8a);

		/*------------------------ salary_as_per_provisions_contained_in_section_17(2)a --------------------------------*/
		//echo "<br><br><hr>salary_as_per_provisions_contained_in_section_17(2)a:------ ".$field8a[1];
		//print_r($field9);
	    $sec_17_2 = $field8a[1];
		if($sec_17_2)
        $this->db->db_run_query("UPDATE bfsi_form_16_a SET `section_17_2`= '".intval($sec_17_2)."' WHERE pk_form_id  = '".$geFormtDocID."'");  
      
		preg_match('/#cprofits_in_lieu_of_salary_under_section_173_as_per_form_no.#12ba,_wherever_applicable(.*?)#dtotal(.*?)#/', $a, $field8b);

		/*------------------------ salary_as_per_provisions_contained_in_section_17(3)a --------------------------------*/
		//echo "<br><br><hr>salary_as_per_provisions_contained_in_section_17(2)a:------ ".$field8b[1];
		//print_r($field8b);
        
        $sec_17_3 = $field8b[1];
		if($sec_17_3)
        $this->db->db_run_query("UPDATE bfsi_form_16_a SET `section_17_3`= '".intval($sec_17_3)."' WHERE pk_form_id  = '".$geFormtDocID."'");  

		/*------------------------ Gross Salary --------------------------------*/
		//echo "<br><br><hr>Gross Salary:------ ".$field8b[2];
      
        $gross_sal = $field8b[2];
		if($gross_sal)
        $this->db->db_run_query("UPDATE bfsi_form_16_a SET `gross_sal`= '".intval($gross_sal)."' WHERE pk_form_id  = '".$geFormtDocID."'");  


		preg_match('/#ereported_total_amount_of_salary_received_from_other_employers(.*?)#2.less:_allowances_to_the_extent_exempt_under_section_10#/', $a, $field9);
		/*------------------ reported_total_amount_of_salary_received_from_other_employers -------------------------*/
		//echo "<br><br><hr>reported_total_amount_of_salary_received_from_other_employers:------ ".$field9[1];
		//print_r($field9);

		preg_match('/#2.less:_allowances_to_the_extent_exempt_under_section_10#(.*?)travel_concession_or_assistance_under_section_105a#/', $a, $field10);
		//print_r($field10);
		/*------------------ travel_concession_or_assistance_under_section_10(5)a -------------------------*/
		//echo "<br><br><hr>travel_concession_or_assistance_under_section_10(5)a:------ ".$field10[1];
        $sec_10_5 = $field10[1];
        if($sec_10_5)
        $this->db->db_run_query("UPDATE bfsi_form_16_a SET `sec_10_5`= '".intval($sec_10_5)."' WHERE pk_form_id  = '".$geFormtDocID."'");  

		preg_match('/travel_concession_or_assistance_under_section_105a#(.*?)death-cum-retirement_gratuity_under_section_1010b#/', $a, $field11);
		/*------------------ travel_concession_or_assistance_under_section_10(10) -------------------------*/
		//echo "<br><br><hr>travel_concession_or_assistance_under_section_10(10):------ ".$field11[1];
		//print_r($field11);
        $sec_10_10 = $field11[1];
        if($sec_10_10)
        $this->db->db_run_query("UPDATE bfsi_form_16_a SET `sec_10_10`= '".intval($sec_10_10)."' WHERE pk_form_id  = '".$geFormtDocID."'");
      
		preg_match('/#commuted_value_of_pension_under_section_1010(.*?).#certificate_no.last_updated_on(.*?)/', $a, $field12);
		/*//echo "<br><br><hr>travel_concession_or_assistance_under_section_10(10):------ ";
		print_r($field12);*/
		$sec_10 = explode("#", $field12[0]);

		//echo "<br><br><hr>section_10(10A):------ ".$sec_10[3];
        $sec_10_10_a = $sec_10[3];
        if($sec_10_10_a)
        $this->db->db_run_query("UPDATE bfsi_form_16_a SET `sec_10_10_A`= '".intval($sec_10_10_a)."' WHERE pk_form_id  = '".$geFormtDocID."'");
		//echo "<br><br><hr>section_10(10AA):------ ".$sec_10[5];
        $sec_10_10_aa = $sec_10[5];
        if($sec_10_10_aa)
        $this->db->db_run_query("UPDATE bfsi_form_16_a SET `sec_10_10_AA`= '".intval($sec_10_10_aa)."' WHERE pk_form_id  = '".$geFormtDocID."'");
		//print_r($sec_10);

		$HRA = $sec_10[4];
		$HRA = ltrim($HRA, 'e');
		//echo "<br><br><hr>HRA:-- ".$HRA;
      
        $hra = $HRA;
        if($hra)
        $this->db->db_run_query("UPDATE bfsi_form_16_a SET `hra`= '".intval($hra)."' WHERE pk_form_id  = '".$geFormtDocID."'");

		preg_match('/#amount_of_any_other_exemption_under_section_10#(.*?)total_amount_of_salary_received_from_current_employer(.*?)#/', $a, $field13);

		/*//echo "<br><br><hr>section_10:------ ";
		print_r($field13);*/
		////echo "<br><br><hr>amount_of_any_other_exemption_under_section_10:------ ";
		$oth_sec_10 = explode("#", $field13[0]);

		//print_r($oth_sec_10);

		//echo "<br><br><hr>amount_of_any_other_exemption_under_section_10:--- ".$oth_sec_10[7];

		$tot_se_10 = $oth_sec_10[8];
		$tot_se_10 = rtrim($tot_se_10,'h');
        
		//echo "<br><br><hr>total_amount_of_exemption_claimed_under_section_10:---".$tot_se_10;
        if($tot_se_10)
        $this->db->db_run_query("UPDATE bfsi_form_16_a SET `tot_amt_cl_un_sec_10`= '".intval($tot_se_10)."' WHERE pk_form_id  = '".$geFormtDocID."'");

		$net_sal = explode(".", $oth_sec_10[9]);

		$net_point = $net_sal[1];
		$net_point =  substr($net_point, 0, -1);
        $net_point = $net_sal[0].".".$net_point;
        if($net_point)
        $this->db->db_run_query("UPDATE bfsi_form_16_a SET `net_sal`= '".intval($net_point)."' WHERE pk_form_id  = '".$geFormtDocID."'");

		//echo "<br><br><hr>Net Salary:---".$net_sal[0].".".$net_point;

		preg_match('/entertainment_allowance_under_section_16ii#(.*?)standard_deduction_under_section_16ia#/', $a, $field14);

		$sec16ia = explode("#", $field14[0]);



		
		//print_r($field14);
		$sec16ia_val = $sec16ia[1];
		$sec16ia_val = ltrim($sec16ia_val, 'a');
		//echo "<br><br><hr>16(ia):---".$sec16ia_val;
		//print_r($sec16ia);
        $sec_16ia = $sec16ia_val;
        if($sec_16ia)
        $this->db->db_run_query("UPDATE bfsi_form_16_a SET `sec_16_ia`= '".intval($sec_16ia)."' WHERE pk_form_id  = '".$geFormtDocID."'");
        
        

		preg_match('/#4.less:_deductions_under_section_16#(.*?)entertainment_allowance_under_section_16ii#/', $a, $field15);

		//echo "<br><br><hr>16(ii):---".$field15[1];
        
		//print_r($field15);
        $sec_16ii = $field15[1];
        if($sec_16ii)
        $this->db->db_run_query("UPDATE bfsi_form_16_a SET `sec_16_ii`= '".intval($sec_16ii)."' WHERE pk_form_id  = '".$geFormtDocID."'");  
      
		$sec16iii = $sec16ia[3];
		//$sec16iii = preg_replace("/[^0-9]/", $sec16iii);
		$sec16iii = str_ireplace("tax_on_employment_under_section_16iii", "", $sec16iii);
		$sec16iii = str_ireplace("c", "", $sec16iii);
      
        //$sec_16iii = $sec16iii;
        if($sec_16ii)
        $this->db->db_run_query("UPDATE bfsi_form_16_a SET `sec_16_iii`= '".intval($sec16iii)."' WHERE pk_form_id  = '".$geFormtDocID."'");  
        
		//echo "<br><br><hr>16(iii):---".$sec16iii;

		preg_match('/#add:_any_other_income_reported_by_the_employee_under_as_per_section_192_2b#(.*?)income_under_the_head_other_sources_offered_for_tds#/', $a, $field16);

		$field16 = explode("#", $field16[1]);

		//echo "<br><br><hr>Total Amount of Deduction:---".$field16[0];
        $t_amt_ded = $field16[0];
        if($t_amt_ded)
        $this->db->db_run_query("UPDATE bfsi_form_16_a SET `tot_ded_16`= '".intval($sec16iii)."' WHERE pk_form_id  = '".$geFormtDocID."'");  
		//print_r($field16);

		$head_sal = $field16[1];
		//$head_sal = substr($head_sal, 0, -1);
		$head_sal =  substr($head_sal, 0, -2);
		//echo "<br><br><hr>Head Salaries:---".$head_sal;
        //$t_amt_ded = $field16[0];
        if($head_sal)
        $this->db->db_run_query("UPDATE bfsi_form_16_a SET `head_sal`= '".intval($head_sal)."' WHERE pk_form_id  = '".$geFormtDocID."'");


    	/*----------------------------*/
		preg_match('/#income_under_the_head_other_sources_offered_for_tds#(.*?).#b#/', $a, $field17a);	
		
		//print_r($field17a);
		$inc_h_p = explode("-", $field17a[1]);
		//print_r($inc_h_p);

		$inc_h_p = $inc_h_p[1];
		if ($inc_h_p)
        $this->db->db_run_query("UPDATE bfsi_form_16_a SET `inc_s_o_property`= '".intval($inc_h_p)."' WHERE pk_form_id  = '".$geFormtDocID."'");
		//echo "<br><br><hr>Income Under The Head Other Sources Offered For Tds:---".$inc_h_p;
		/*---------------------------*/

		preg_match('/#total_amount_of_other_income_reported_by_the_employee(.*?).#deduction_in_respect_of_contribution_to_certain_pension_funds#/', $a, $field17);

		////echo "<br><br><hr>7(a) + 7(b):---";
		

		$field17 = explode("-", $field17[1]);
        $sec_tot_7a_7b = $field17[1];
		if ($sec_tot_7a_7b)
        $this->db->db_run_query("UPDATE bfsi_form_16_a SET `sec_tot_7a_7b`= '".intval($sec_tot_7a_7b)."' WHERE pk_form_id  = '".$geFormtDocID."'");
		

		preg_match('/#employee_offered_for_tds(.*?).#deductions_under_chapter_vi-a#/', $a, $field18);
		

		$field18 = explode("#", $field18[1]);		
		$gross_sal = $field18[4];
		$gross_sal = str_ireplace("gross_total_income_6+89", "", $gross_sal);
		if($gross_sal)
        $this->db->db_run_query("UPDATE bfsi_form_16_a SET `gross_tot_inc`= '".intval($gross_sal)."' WHERE pk_form_id  = '".$geFormtDocID."'");

    	preg_match('/#provident_fund_etc._under_section_80c#(.*?).#deduction_in_respect_of_contribution_by_taxpayer_to_pension#/', $a, $field19);
		//print_r($field19);
		//echo $field19[0];
		$c80 = explode("#", $field19[0]);
		//print_r($c80);
		$c80 = $c80[4];
		if($c80)
        $this->db->db_run_query("UPDATE bfsi_form_16_a SET `c80`= '".intval($c80)."' WHERE pk_form_id  = '".$geFormtDocID."'");
		//echo "<br><br><hr>section 80C:---".$c80[4]."<br>";
		
		#tax_on_total_income#

		preg_match('/#tax_on_total_income#(.*?).#surcharge,_wherever_applicable#/', $a, $field20);
		//print_r($field20);
		$total_t_inc = explode("#", $field20[0]);
		//print_r($total_t_inc);
		$total_t_inc = $total_t_inc[6];
		$total_tax_inc = str_ireplace("total_taxable_income_9-11", "", $total_t_inc);

		if($total_tax_inc)
        $this->db->db_run_query("UPDATE bfsi_form_16_a SET `total_tax_inc`= '".intval($total_tax_inc)."' WHERE pk_form_id  = '".$geFormtDocID."'");
		//echo "<br><br><hr>Total taxable income:---".$total_t_inc;

		preg_match('/#rebate_under_section_87a,_if_applicable(.*?).#less:_relief_under_section_89_attach_details#/', $a, $field21);
		//#rebate_under_section_87a,_if_applicable
		
		//print_r($field21);
		$field21 =  explode("#", $field21[0]);
		//print_r($field21);
		$net_tax_payble = $field21[6];
		if($net_tax_payble)
        $this->db->db_run_query("UPDATE bfsi_form_16_a SET `net_tax_payble`= '".intval($net_tax_payble)."' WHERE pk_form_id  = '".$geFormtDocID."'");
		//echo "<br><br><hr>Net Tax Payable:---".$field21[6];
		
		return;
	}
	function trfrFrm16DataToMainDB($getRequest)
	{
		$getITRID = $getRequest[formsDataID];
		$salary_id = $getRequest[salary_id];
		
		$getSource = $this->commonFunction->getSingleRow("SELECT * FROM bfsi_form_16_a WHERE fr_user_id = '".$this->CONFIG->loggedUserId."' AND 
					fr_itr_id  = '".$getITRID."'");
		
		$employerAddress = 	explode("#",$getSource[employer_address]);	
		$arrBuild = explode(",",$employerAddress[2]);
		$arrCityZip = explode("-",$arrBuild[1]);	
		
		 $SQL 	   = "UPDATE itr_sou_salary SET
						sou_sa_ntslary 				= '".$getSource[balance_1_2]."',
						sou_sa_employer_name 		= '".$getSource[employee_name]."',
						sou_sa_employer_add			= '".$getSource[employee_address]."',
                        sou_sa_salary               = '".$getSource[section_17_1]."',
                        sou_sa_perquisite           = '".$getSource[section_17_2]."',
                        sou_sa_profits              = '".$getSource[section_17_3]."',
						sou_sa_employercountry		= 'INDIA',
						sou_sa_employer_city 		= '".trim(ucwords(str_replace("_"," ",$arrCityZip[0])))."',
						sou_sa_employer_state 		= '".ucwords(str_replace("_"," ",$employerAddress[3]))."',
						sou_sa_employer_pincode 	= '".trim(ucwords(str_replace("_"," ",$arrCityZip[1])))."',
						sou_sa_tan_no 				= '".strtoupper($getSource[deductor_tan])."',
						sou_sa_tds_on_sal 			= '".$getSource[total_tds_deposited]."' 
					 WHERE fr_itr_id = '".$getITRID."' AND fr_user_id = '".$this->CONFIG->loggedUserId."' AND pk_sousal_id = '".$salary_id."'";
		
		$SQL1 	   = "INSERT INTO itr_sou_salary SET
						sou_sa_ntslary 				= '".$getSource[balance_1_2]."',
						sou_sa_employer_name 		= '".ucwords(str_replace("_"," ",$employerAddress[0]))."',
						sou_sa_employer_add			= '".ucwords(str_replace("_"," ",$employerAddress[1]))." ".ucwords(str_replace("_"," ",$arrBuild[0]))."',
						sou_sa_employercountry		= 'INDIA',
						sou_sa_employer_city 		= '".trim(ucwords(str_replace("_"," ",$arrCityZip[0])))."',
						sou_sa_employer_state 		= '".ucwords(str_replace("_"," ",$employerAddress[3]))."',
						sou_sa_employer_pincode 	= '".trim(ucwords(str_replace("_"," ",$arrCityZip[1])))."',
						sou_sa_tan_no 				= '".strtoupper($getSource[deductor_tan])."',
						sou_sa_tds_on_sal 			= '".$getSource[total_tds_deposited]."', 
					    fr_itr_id 					= '".$getITRID."',
						fr_user_id 					= '".$this->CONFIG->loggedUserId."'";
					 
		$docRes	= $this->db->db_run_query($SQL);
		//exit;
		$SQL 	   = "UPDATE itr_deduction SET
						ded_gd__80c 		= '".trim($getSource[total_80c])."',
						ded_gd__80gg 		= '".trim($getSource[ded_80gg])."',
						ded_gd__80tta		= '".trim($getSource[ded_80tta])."',
						ded_hi_hip80d_ssc	= '".trim($getSource[ded_80tta])."',
						ded_othd_80ddb 		= '".trim($getSource[ded_80tta])."',
						ded_othd_80e 		= '".trim($getSource[ded_80e])."',
						ded_othd_80ee 		= '".trim($getSource[ded_80ee])."',
						ded_othd_80ccc 		= '".trim($getSource[ded_80ccc])."',
						ded_othd_80ccd1 	= '".trim($getSource[ded_80ccd])."' 
					 WHERE fr_itr_id = '".$getITRID."' AND fr_user_id = '".$this->CONFIG->loggedUserId."'";
		
		$docRes	= $this->db->db_run_query($SQL);
		return;
		//exit;
	}
	function cleanCommaDotInNumbers($getNumeric)
	{
		$withDot = preg_replace("/[^0-9.]/", "", $getNumeric);
		$formatStr = number_format($withDot,2);
		$arrWith = explode(".",$formatStr);
		return preg_replace("/[^0-9]/", "", $arrWith[0]);			//print_r($balance);
	}
	function getFileText($fileName)
	{

		if($this->CONFIG->loggedUserId == '')
			$fileName = str_replace("/\\","",$fileName);
		else
			$fileName = str_replace("/\\","/",$fileName);	
		
		ini_set('pcre.backtrack_limit',100000000000);
		ini_set('pcre.recursion_limit',100000000000); 
		
		include ( $this->CONFIG->wwwroot.'__lib.apis/__PdfToText/PdfToText.phpclass' ) ;
		
		$pdf 		  = new PdfToText ( $fileName ) ;
		$pdfText 	  = $pdf -> Text ;
		//$_SESSION['form16text'] = $pdf;
		return trim(str_replace("'","",str_replace("\"","",$pdfText)));
	}
	function getForm26ASText($getFilename,$getPassword='')
	{
		$retRes = array();
		$javaTool = $this->CONFIG->wwwroot.'__lib.apis/__PdfToText/apBox/';
		$getFilename = $this->CONFIG->customerFilePath.$getFilename;
		//echo 'java -jar "'.$javaTool.'pdfbox-app-2.0.8.jar" ExtractText -console -password '.$getPassword.' "'.$getFilename.'"';
		if($getPassword == '')
			$output = shell_exec('java -jar "'.$javaTool.'pdfbox-app-2.0.8.jar" ExtractText -console "'.$getFilename.'"');
		else
			$output = shell_exec('java -jar "'.$javaTool.'pdfbox-app-2.0.8.jar" ExtractText -console -password '.$getPassword.' "'.$getFilename.'"');
		
		//echo 'java -jar "'.$javaTool.'pdfbox-app-2.0.8.jar" ExtractText -console -password '.$getPassword.' "'.$getFilename.'"';
			
		if($output == '')
			$retRes = array("need_password");
		else
		{
			$output = str_replace("(","",str_replace(")","",str_replace(" ","_",str_replace("\n","#",trim(strtolower($output))))));
			preg_match('/total_tax_deducted#(.*?)sr/', $output, $field1);
			$tot_tds = explode(".00",$field1[1]);
			//print_r($tot_tds);
			//echo "Total TDS : ".number_format($tot_tds[1],2)."<br>";			
			preg_match('/financial_year_assessment_year(.*?)#/', $output, $field2);
			$arr = explode("_",$field2[1]);
			//echo "PAN : ".strtoupper($field2[1])."<br>";
			preg_match('/##_tds_deposited#(.*?)#total_tax_deducted##/', $output, $field3);
			$field3Arr = explode("_",$field3[1]);			
			$clientTAN = strtoupper($field3Arr[count($field3Arr)-2]);
			$totCredited = $field3Arr[count($field3Arr)-1];
			$clientNameArr = array_splice($field3Arr, -2);			
			$clientName = '';
			while(list($key,$val) = each($field3Arr))
			{
				$clientName .= ucwords($val)." ";
			}
			$retRes = array("TEXT" => $output, "TAN" => $clientTAN, "CREDITED" => $totCredited, "CLIENT_NAME" => $clientName, "TDS" => number_format($tot_tds[1],2),
								 "PAN" => strtoupper($arr[0]), "FIN_YEAR" => $arr[1], "ASSESS_YEAR" => $arr[2]);
		}
		
		return $retRes;
	}
	function addForm26AS($getFormFilename,$getFormID,$getFormPDFPass)
	{		
		$form26Txt = $this->getForm26ASText($getFormFilename,$getFormPDFPass);
		//print_r($form26Txt);
		
		$SQL 		= "INSERT INTO bfsi_form_26_as SET
							fr_itr_id = '".$getFormID."',
							form_file_name = '".$getFormFilename."',
							client_name = '".$form26Txt['CLIENT_NAME']."',
							tot_credited = '".$form26Txt['CREDITED']."',
							client_tan = '".$form26Txt['TAN']."',
							form_file_txt = '".str_replace("'","",$form26Txt['TEXT'])."',
							assess_year = '".$form26Txt['ASSESS_YEAR']."',
							pan_no = '".$form26Txt['PAN']."',
							total_tds = '".$form26Txt['TDS']."',
							form_created_date = now(),
							fr_user_id  = '".$this->CONFIG->loggedUserId."'";	
		$docRes	= $this->db->db_run_query($SQL);
     	$form26ASID = $this->db->db_insert_id();
		$this->db->db_run_query("UPDATE bfsi_form_16_a SET form_26_total_tds = '".$form26Txt['TDS']."',
								form_26_pan = '".$form26Txt['PAN']."',form_26_assess = '".$form26Txt['ASSESS_YEAR']."' WHERE pk_form_id  = '".$getFormID."'");
		
		$SQL 		= "INSERT INTO itr_taxreconciliation SET
							fr_itr_id = '".$getFormID."',							
							reco_reconci_nameodeduc  = '".$form26Txt['CLIENT_NAME']."',
							reco_reconci_totamtcre  = '".$form26Txt['CREDITED']."',
							reco_reconci_tanodeduc  = '".$form26Txt['TAN']."',						
							reco_reconci_tottdsdop  = '".$form26Txt['TDS']."',
							fr_user_id  = '".$this->CONFIG->loggedUserId."'";	
		$docRes	= $this->db->db_run_query($SQL);
		
		//exit;
		return;
	}	
	function getFormData($getFormID)
	{
		$SQL="SELECT * FROM bfsi_form_16_a WHERE pk_form_id = '".$getFormID."' AND fr_user_id  = '".$this->CONFIG->loggedUserId."'";			
		return $this->commonFunction->mysqlResultIntoArray($SQL,'SQL');
	}
	function getFormIdOfFile($getFileID)
	{
		$SQL="SELECT pk_form_id,assessment_year FROM bfsi_form_16_a WHERE fr_upload_doc_id = '".$getFileID."' AND fr_user_id  = '".$this->CONFIG->loggedUserId."'";			
		return $this->commonFunction->getSingleRow($SQL);
	}
	function latestUploadedFiles($customerID)
	{
		$SQL="SELECT * FROM bfsi_uploads WHERE fr_user_id  = '".$this->CONFIG->loggedUserId."' ORDER BY pk_upload_id  DESC LIMIT 12";	
		return $this->commonFunction->mysqlResultIntoArray($SQL,'SQL');
	}
	function getFileDetail($getFileID,$customerID)
	{
		$SQL="SELECT * FROM bfsi_uploads WHERE fr_customer_id = '".$getFileID."' AND customer_id  = '".$customerID."'";	
		return $this->commonFunction->getSingleRow($SQL);
	}
	function latestUploadedFilesCount($customerID)
	{
		$SQL="SELECT * FROM bfsi_uploads WHERE fr_customer_id  = '".$customerID."' ORDER BY pk_upload_id  DESC LIMIT 5";	
		$docRes	= $this->db->db_run_query($SQL);
		return $this->db->db_num_rows($docRes);
	}	
	function allUploadedFilesCount($customerID)
	{
		$SQL="SELECT * FROM bfsi_uploads WHERE fr_customer_id  = '".$customerID."'";	
		$docRes	= $this->db->db_run_query($SQL);
		return $this->db->db_num_rows($docRes);
	}		
	function getAllFiles($customerID,$folderID='')
	{
		$SQL="SELECT * FROM bfsi_uploads WHERE fr_customer_id  = '".$customerID."' ORDER BY pk_upload_id DESC";	
		
		return $this->commonFunction->mysqlResultIntoArray($SQL,'SQL');
	}
}

?>