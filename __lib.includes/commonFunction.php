<?php

class commonFunction{

	function commonFunction($getDB)
	{
		global $CONFIG,$_SESSION;
		$this->db = $getDB;
		$CONFIG->dbLink = $this->db->connect();
		$this->CONFIG = $CONFIG;
		//$this->SESSION = $_SESSION;
	}
	function runInShell($command)
	{
		ob_start();
		$output = shell_exec($command);
		ob_end_clean(); 	
		return $output;
	}

	/* duplicates from array of objects based on key */
	function unique_multidimensional_array($array, $key) {
		$temp_array = array();
		$i = 0;
		$key_array = array();
	
		foreach($array as $val) {
			if (!in_array($val[$key], $key_array)) {
				$key_array[$i] = $val[$key];
				$temp_array[$i] = $val;
			}
			$i++;
		}
		return $temp_array;
	}

	/*------------------------------------------------------------------------------*/
    function check_pan($pan){

        $sql = "SELECT * FROM `itr_profile` WHERE `itr_pd_pan_number`='".$pan."' AND ";
        $res = $this->db->db_run_query($sql);
         
        if($this->db->db_num_rows($res) > 0)
		{
			//$this->setPage($fill_itr);
			//$_SESSION['pan_error'] = 1;
			$res =  "0";
		}
		else
		{
			$res =  "1";
		}
        return $res;
    }
    function check_coupon($chk_cpn)
    {
    	$retVal = $this->db->db_run_query("SELECT cou_per FROM coupon_list where cou_code='".trim($chk_cpn)."'");
		//echo "SELECT cou_per FROM coupon_list where cou_code='".trim($chk_cpn)."'";
		$chk_cpn_status = $this->db->db_num_rows($retVal);
		if ($chk_cpn_status == 1) 
		 {
		 	$cou_per = $this->db->db_fetch_array($retVal);
		 	//print_r($cou_per);
		 	//echo "Coupon Percentage:-".$cou_per['cou_per'];
		 	//$cou_per = $cou_per[cou_per]/100;
		}

		return $cou_per['cou_per']; 
    }
    /*------------------------------------------------------------------------------*/
	function doLogin($getCustomerID) {
		global $_SESSION,$customerProfile,$mutualFund;								//print_r($this->SESSION);
		$customerDetails = $customerProfile->getCustomerInfo($getCustomerID);
		$cart_count = $mutualFund->fetch_cart_count($getCustomerID);
		$_SESSION[securimage_code_value] 						= "";
		$_SESSION[$this->CONFIG->sessionPrefix.'loginstatus']	= true;
		$_SESSION[$this->CONFIG->sessionPrefix.'user_id']		= $customerDetails['pk_user_id'];
		$_SESSION[$this->CONFIG->sessionPrefix.'customer_id']	= $customerDetails['fr_customer_id'];
		$_SESSION[$this->CONFIG->sessionPrefix.'email_id']		= $customerDetails['login_id'];
		$_SESSION[$this->CONFIG->sessionPrefix.'user_name']		= $customerDetails['cust_name'];
        $_SESSION[$this->CONFIG->sessionPrefix.'encrypt']		= $customerDetails['passwd'];
		$_SESSION[$this->CONFIG->sessionPrefix.'pan_number']		= $customerDetails['pan_number'];
		$_SESSION[$this->CONFIG->sessionPrefix.'_AY_TEXT'] = $_SESSION[$this->CONFIG->sessionPrefix.'_AY'] = (date("n") < 4) ? (date("Y")-1)."-".date("Y") : date("Y")."-".(date("Y")+1);
		$this->CONFIG->loggedUserId								= $_SESSION[$this->CONFIG->sessionPrefix."user_id"];
		$this->CONFIG->customerId								= $_SESSION[$this->CONFIG->sessionPrefix."customer_id"];
		$this->CONFIG->loggedUserEmail							= $_SESSION[$this->CONFIG->sessionPrefix.'email_id'];	
		$this->CONFIG->loggedUserName							= $_SESSION[$this->CONFIG->sessionPrefix.'user_name'];
		$this->CONFIG->UserPan                                  = $_SESSION[$this->CONFIG->sessionPrefix.'pan_number'];
		return $_SESSION;		//$this->SESSION;			exit;											
	}
	function requestEncodeDecode($getEDString,$whatToDO='')
	{
		$returnEDString = '';

		if($whatToDO == '')
			$returnEDString = strtr(base64_encode(addslashes(gzcompress(serialize($getEDString),9))), '+/=', '-_,');	
		else if($whatToDO == 'encode')
			$returnEDString = strtr(base64_encode(addslashes(gzcompress(serialize($getEDString),9))), '+/=', '-_,');	
		else if($whatToDO == 'decode')
		{
			$returnEDString = unserialize(gzuncompress(stripslashes(base64_decode(strtr($getEDString, '+/=','-_,')))));
			$returnEDString = str_replace($this->CONFIG->requestPrefixStart,"",$returnEDString);
			$returnEDString = str_replace($this->CONFIG->requestPrefixEnd,"",$returnEDString);
		}
		return $returnEDString;		
	}
	function setPage($setPageName)
	{
		return $this->encodeDecode($setPageName,'encode');
	}
	
	function getPage($getPageName)
	{
		return $this->encodeDecode($getPageName,'decode');
	}
	
	/*------------------------------------------------- Fetch EmPanel Details -------------------------------------------*/

	function get_empanel()
	{
		$sql = $this->db->db_run_query("SELECT * FROM em_panel");
		if($this->db->db_num_rows($sql)>0)
		{
			$result = $this->mysqlResultIntoArray($sql);	

		}
		$result = "HIsdadsdasdasdadads";
		return $result;
	    
	}
	/*------------------------------------------------- Fetch EmPanel Details -------------------------------------------*/


	
	
	function encodeDecode($getEncodeString,$whatToDO='')
	{
		$retturnString = '';
		
		if($whatToDO == '')
			$retturnString = base64_encode($getEncodeString);
		else if($whatToDO == 'encode')
			$retturnString = base64_encode($getEncodeString);
		else if($whatToDO == 'decode')
			$retturnString = base64_decode($getEncodeString);

		return $retturnString;		

	}
	/*----------------------Get Id for form16-Start-------------------------------*/
	function getform16id()
	{
		$sql = $this->db->db_run_query("SELECT `pk_form_id` FROM `bfsi_form_16_a` WHERE `fr_itr_id`='".$_SESSION[$this->CONFIG->sessionPrefix.'_ITR_ID']."' AND `fr_user_id`='".$_SESSION[$this->CONFIG->sessionPrefix.'user_id']."'");
    	//$s= "SELECT `bfsi_user`.`login_id`, `bfsi_users_details`.`contact_no`,`bfsi_users_details`.`cust_name` FROM `bfsi_user` INNER JOIN `bfsi_users_details` ON `bfsi_user`.`pk_user_id` = `bfsi_users_details`.`fr_user_id` WHERE `bfsi_user`.`pk_user_id`= '31'";
		//$result = $this->db->db_run_query($sql);
		if($this->db->db_num_rows($sql)>0)
		{
			$result = $this->db->db_fetch_assoc($sql);	

		}
		//$result = "SELECT `pk_form_id` FROM `bfsi_form_16_a` WHERE `fr_itr_id`='".$_SESSION[$this->CONFIG->sessionPrefix.'_ITR_ID']."' AND `fr_user_id`='".$_SESSION[$this->CONFIG->sessionPrefix.'user_id']."'";
		return $result;
	}

	/*---------------------------------------------------------------------------*/

	function run_the_query($sql){
		
		$result = $this->db->db_run_query($sql);

		if ($result) 
		{
			return true;	
		}
		else
		{
			return false;
		}

		//return;
		
	}

	/*----------------------Get Id for form16-End-------------------------------*/
	function orderByToggle($getRequest,$getFieldName,$getPageName='')
	{
		if(!empty($getRequest[search_str]))
			$order_by_str = 'search_str='.$getRequest[search_str].'&order_by='.$getFieldName;	
		else
			$order_by_str = 'order_by='.$getFieldName;	
				
		$sortingClass = "asc";
		if($getRequest[order_by] == $getFieldName)
		{			
			if($getRequest[sorting] == 'asc')
				$sortingClass = "desc";
			else
				$sortingClass = "asc";
					
			$orderByScheme = 'class="trClick sorting'."_".$sortingClass.'" data-href="?'.$order_by_str.'&sorting='.$sortingClass.'&module_interface='.$this->setPage($getPageName).'"';
		}
		else
		{
			$orderByScheme = 'class="trClick sorting" data-href="?'.$order_by_str.'&sorting='.$sortingClass.'&module_interface='.$this->setPage($getPageName).'"';
		}
		
		return $orderByScheme;
	}
	function resizeCorpSaveImage($filename,$image_source,$image_source_name,$maxwidth,$maxheight,$quality)
	{
			$zoom=1;
			$src_x=0;
			$src_y=0;

			$imgsrc=$image_source;
			$result_width=$maxwidth;
			$result_height=$maxheight;

			//Checking image dimension
			if(substr($image_source_name,strlen($image_source_name)-3,strlen($image_source_name))=='gif')
			{
				$gif=true;
			}
			else
			{
				$gif=false;
			}
			
			if($gif)
				$image = imagecreatefromgif($imgsrc);
			else
				$image = imagecreatefromjpeg($imgsrc);

			 
			
			$old_width = imagesx($image);
			$old_height = imagesy($image);



			//new width and height
			
			
			//Landscape image
			if($old_width>$old_height)
			{
				$ratio=$old_width/$old_height;
				if($old_height>=$result_height)
				{
					$new_height=$result_height;
					$new_width=$result_height*$ratio;
				}
				elseif($old_width>$result_width)
				{
					$new_width=$result_width;
					$new_height=$result_width/$ratio;
				}
				else
				{
					$new_width=$old_width;
					$new_height=$old_height;
				}
			}
			
			//Vertical image
			elseif($old_width<$old_height)
			{
				$ratio=$old_height/$old_width;
				if($old_width>$result_width)
				{
					$new_width=$result_width;
					$new_height=$result_height*$ratio;
				}
				elseif($old_height>$result_height)
				{
					$new_height=$result_height;
					$new_width=$result_height*$ratio;
				}
				else
				{
					$new_width=$old_width;
					$new_height=$old_height;
				}
			}
			
			//Square image
			elseif($old_width==$old_height)
			{
				$new_width=$old_width;
				$new_height=$old_height;
			}

			
			
			$new_width	=	 $new_width*$zoom;
			$new_height	=	 $new_height*$zoom;
			
			//src_x=
			//$src_y=
			if($new_width>$new_height&&$new_width>$result_width)
			{
				$src_x=($new_width-$result_width)/2;
			}
			elseif($new_width<$new_height&&$new_height>$result_height)
			{
				$src_y=($new_height-$result_height)/2;
			}


			// Resample
			$image_resized = imagecreatetruecolor($result_width, $result_height);
			imagecopyresampled($image_resized,$image,$dest_x, $dest_y, $src_x, $src_y, $new_width, $new_height, $old_width, $old_height);
			

			// Display resized image
			if($gif)
			{
				imagegif($image_resized,$filename,$quality);
			}
			else
			{
				imagejpeg($image_resized,$filename,$quality);
			}
			imagedestroy($image);
			imagedestroy($image_resized);			
			
	}
    /*----------------------------------------- Upload-XML-BSEN-START ------------------------------------------------*/

  
    function xmlUpload($xml, $xml_pan){
      
      //$table_name = "bfsi_itr";
      //$sql = "UPDATE `bfsi_itr` SET `xml`=".$xml." WHERE `pk_itr_id`= '".$this->CONFIG->loggedUserId."'";
      
      /*ob_start();

      echo readfile($xml);

      $image=ob_get_contents();

      ob_end_clean();*/
      $xml_all = file_get_contents($xml);
      
      $filetype = filetype($xml);
      
      $query = $this->db->db_run_query("UPDATE `bfsi_itr` SET `itr_status`='1',`itr_xml` = '".$xml_all."' WHERE `fr_user_id`= '".$this->CONFIG->loggedUserId."' and `itr_pan`='".$xml_pan."'");
      
      $a = "UPDATE `bfsi_itr` SET `itr_status`='submit',`itr_xml` = '".$xml_all."' WHERE `fr_user_id`= '".$this->CONFIG->loggedUserId."' and `itr_pan`='".$xml_pan."'";
     /* echo "console.log('".$a."');";*/
     
      return $a;
    }

    /*---------------------------------------------------------- Update Token -----------------------------------------------------------------------*/

	function update_token($resp,$xml_pan){
		$resp  = $resp;

		preg_match('/<ns3:tokenNumber>(.*?)ns3:tokenNumber>/', $resp, $a);

		$token_no = intval($a[1]);
		$sql = $this->db->db_run_query("UPDATE `bfsi_itr` SET `token_no`='".$token_no."' WHERE `fr_user_id`= '".$this->CONFIG->loggedUserId."' and `itr_pan`='".$xml_pan."'");

		return $xml_pan;
	}

	/*-----------------------------------------------------------------------------------------------------------------------------------------------*/

    function fetch_zip_data()
    {
	   	$sql = $this->db->db_run_query("SELECT * FROM tbl_uploads inner join bfsi_user ON `tbl_uploads`.`user_id` = `bfsi_user`.`pk_user_id` inner join `bfsi_users_details` ON `bfsi_user`.`pk_user_id` = `bfsi_users_details`.`fr_user_id` WHERE `tbl_uploads`.`file_status`  IN ('0','1','2') order by `id` DESC");
	    	//$s= "SELECT `bfsi_user`.`login_id`, `bfsi_users_details`.`contact_no`,`bfsi_users_details`.`cust_name` FROM `bfsi_user` INNER JOIN `bfsi_users_details` ON `bfsi_user`.`pk_user_id` = `bfsi_users_details`.`fr_user_id` WHERE `bfsi_user`.`pk_user_id`= '31'";
			//$result = $this->db->db_run_query($sql);
			/*if($this->db->db_num_rows($sql)>0)
			{
				$result = $this->db->db_fetch_assoc($sql);	

			}*/
			//$result = "HI";
			//echo "SELECT * FROM tbl_uploads inner join bfsi_user ON `tbl_uploads`.`user_id` = `bfsi_user`.`pk_user_id` inner join `bfsi_users_details` ON `bfsi_user`.`pk_user_id` = `bfsi_users_details`.`fr_user_id` WHERE `tbl_uploads`.`file_status`  IN ('0','1','2') order by `id` DESC";
		return $sql;
	}
	function event_user()
	{
	    $sql = $this->db->db_run_query("SELECT `bfsi_user`.`login_id`,`bfsi_user`.`p_code`,`bfsi_user`.`user_org`, `bfsi_users_details`.`contact_no`,`bfsi_users_details`.`cust_name` FROM `bfsi_user` INNER JOIN `bfsi_users_details` ON `bfsi_user`.`pk_user_id` = `bfsi_users_details`.`fr_user_id` WHERE `bfsi_user`.`pk_user_id`= `bfsi_users_details`.`fr_user_id` ORDER By `bfsi_user`.`user_org` DESC ");
		return $sql;
	}

	function will_user(){
	    	$sql = $this->db->db_run_query("SELECT `bfsi_users_details`.`cust_name`,
         `bfsi_users_details`.`contact_no`,
         `will_personal_information`.`email`, 
         `will_personal_information`.`pi_per_state`,
         `will_personal_information`.`pi_place`,
         `will_personal_information`.`pi_panaadharnum`,
         `will_personal_information`.`creation_date` FROM `bfsi_users_details` 
		  INNER JOIN `will_personal_information` 
		  ON `bfsi_users_details`.`fr_user_id` = `will_personal_information`.`fk_user_id` WHERE `bfsi_users_details`.`fr_user_id` = `will_personal_information`.`fk_user_id` ");
		  
		  return $sql;
	    }
  
  
    function get_single_data()
    {
    	$sql = $this->db->db_run_query("SELECT bfsi_user.login_id, bfsi_users_details.* FROM `bfsi_user` INNER JOIN `bfsi_users_details` ON bfsi_user.pk_user_id = bfsi_users_details.fr_user_id WHERE bfsi_user.pk_user_id= '".$this->CONFIG->loggedUserId."'");
    	//$s= "SELECT `bfsi_user`.`login_id`, `bfsi_users_details`.`contact_no`,`bfsi_users_details`.`cust_name` FROM `bfsi_user` INNER JOIN `bfsi_users_details` ON `bfsi_user`.`pk_user_id` = `bfsi_users_details`.`fr_user_id` WHERE `bfsi_user`.`pk_user_id`= '31'";
		//$result = $this->db->db_run_query($sql);
		if($this->db->db_num_rows($sql)>0)
		{
			$result = $this->db->db_fetch_array($sql);	

		}
		//$result = "HI";
		return $result;
    }
  
   
  
    /*--------------------------------------- Upload-XML-BSEN-END --------------------------------------------------------*/
  
    /*------------------------------------ -- Updating-pan-START ---------------------------------------------------------*/
  
    function updatePan($update_pan){
        global $CONFIG,$_SESSION;
        $query = $this->db->db_run_query("UPDATE `bfsi_itr` SET `itr_pan` = '".$update_pan."' WHERE `pk_itr_id`= '".$CONFIG->currentITRID."'");
        $sql = "UPDATE `bfsi_itr` SET `itr_pan` = '".$update_pan."' WHERE `pk_itr_id`= '".$CONFIG->currentITRID."'";
        return $sql;
    }
  
    /*-------------------------------------------------- Updating-pan-END -----------------------------------------------*/
  
  
	function pageAccessTokenCheck($getPageToken,$getTokenString)
	{
		if($getPageToken != md5($getTokenString))
		{
			echo "<div class='main-content'>!!Sorry!! I Can't show anything</div>";
			//$this->jsRedirect($this->CONFIG->siteurl);
			exit;
		}	
	}
	/*----------------------------------- 20190227-BSEN-Start -------------------------------------*/


	/*----------------------------------- 20190227-BSEN-End -------------------------------------*/
	
	
	function mysqlResultIntoArray($getMysqlParam,$paramType='')
	{
		
		
		$sqlResultArr = array();
		if($paramType == '' || $paramType == 'SQL')
		{
			/*----------------------------------- 20190219-BSEN -------------------------------------*/
			//echo "state query|".$getMysqlParam;
			/*------------------------ for testing ------------------------*/
			$resultSet = $this->db->db_run_query($getMysqlParam);	// or die(mysql_error());    //echo $getMysqlParam;exit;
		}
		else if($paramType == 'RESULT_SET')
		{
			$resultSet = $getMysqlParam;
		}
		if($this->db->db_num_rows($resultSet) > 0)
		{
			$i=0;
			while($resultRows = $this->db->db_fetch_assoc($resultSet))
			{
				$sqlResultArr[] = $resultRows;				//$i++;		//print_r($resultRows);
			}
		}	
		
		/*----------------------------------- 20190219-BSEN -------------------------------------*/
		/*echo "State|";
		print_r($sqlResultArr);*/
		//die();
		return $sqlResultArr;
	}
	function convertTOJSONP($arrResult)
	{
		$jsonpArr = array();
		$i=0;
		foreach($arrResult as $element1) 
		{
			foreach($element1 as $element) 
			{
				//print_r($element[0][0]);
				$val = ucwords(strtolower(str_replace("\"","",$element[0])));
				if($val != '')
					$jsonpArr[$i] = array("id" => "$val","name" => "$val","value" => "$val");
				$i++;
			}
		}	
		return json_encode($jsonpArr);	
	}
	function refineGetPOSTRequest($getAllTypeValue)
	{
		return strip_tags(addslashes($getAllTypeValue));
	}
	function getRecordCount($getSQL)
	{
		return $this->db->db_num_rows($this->db->db_run_query($getSQL));
	}
	function addIfNotExist($getTableName)
	{
		// $sql = "SELECT count(pk_bank_detail_id) FROM ".$getTableName." where `fr_user_id` = '".$this->CONFIG->loggedUserId."'";
		$sql="SELECT pk_bank_detail_id FROM ".$getTableName." where fr_user_id='".$this->CONFIG->loggedUserId."';";
		// echo "sql:-".$sql;
		// die();
        $res = $this->db->db_num_rows($this->db->db_run_query($sql));
       
        if($res < 5)
        {


		$total = $this->getRecordCount($SQL);
		if($total == 0)
			$this->db->db_run_query("INSERT INTO ".$getTableName." SET fr_user_id = '".$this->CONFIG->loggedUserId."',bank_created_date = now()");
	}
      
	}
	function array_push_assoc(&$arr)
	{
	   $args = func_get_args();
	   foreach ($args as $arg) {
		   if (is_array($arg)) {
			   foreach ($arg as $key => $value) {
				   $arr[$key] = $value;
				   $ret++;
			   }
		   }else{
			   $arr[$arg] = "";
		   }
	   }
	   return $ret;
	}

	/* Login Check */
	function check_login($email,$password) {		
		$query = $this->db->db_run_query("SELECT * FROM ".$this->CONFIG->dbName.".bfsi_user WHERE login_id  = '$email' AND passwd = '".md5($password)."' AND user_status='Active'");
		return $query;
	}
	
	/* Login Check with mpin*/
	function check_login_with_pin($userid,$mpin) {		
		$query = $this->db->db_run_query("SELECT * FROM ".$this->CONFIG->dbName.".bfsi_user WHERE pk_user_id = '$userid' AND mpin = '".$mpin."' AND user_status='Active'");
		return $query;
	}

	/* Check mpin*/
	function check_mpin_app($userid) {		
		$query = $this->db->db_run_query("SELECT * FROM ".$this->CONFIG->dbName.".bfsi_user WHERE pk_user_id = '$userid' AND user_status='Active'");
		return $query;
	}

	function is_email_exist($email) {
		$result = $this->db->db_run_query("SELECT pk_user_id FROM ".$this->CONFIG->dbName.".bfsi_user WHERE login_id = '$email'");
		$retVal = $this->db->db_fetch_assoc($result);
		$Id = $retVal[pk_user_id];
		return $Id;
	}	
	
	function is_mygoal_email_exist($email, $camp_code) {
		$result = $this->db->db_run_query("SELECT pk_goal_id FROM ".$this->CONFIG->dbName.".mygoal_details WHERE user_id = '$email' and campaign_code = '$camp_code'");
		$retVal = $this->db->db_fetch_assoc($result);
		$Id = $retVal[pk_goal_id];
		return $Id;
	}	

	/*----------------------------------- Check Event already exist --------------------------------------------*/

	function check_event_exist($id,$event_code)
	{
		echo $SQL = "SELECT * FROM ".$this->CONFIG->dbName.".event_details where user_id='".$id."' AND event_p_code='".$event_code."'";
		$result = $this->db->db_run_query("SELECT * FROM ".$this->CONFIG->dbName.".event_details where user_id='".$id."' AND event_p_code='".$event_code."'");
		$retVal = $this->db->db_num_rows($result);

		return $retVal;
	}

	/* get Event details based on p_code */
	function getEventByPcode($event_code) {
		echo "select * from events where event_code='".$event_code."'";

		$result = $this->db->db_run_query("SELECT * FROM events where event_code='".$event_code."'");
		$retVal = $this->db->db_fetch_assoc($result);
		return $retVal;
	}

	/*----------------------------------- Check Event already exist --------------------------------------------*/
	function getSingleRow($sql)
	{
		$response = "";
		$result = "";
		//echo $sql;
		$result = $this->db->db_run_query($sql);
		$response = $this->db->db_fetch_assoc($result);				//print_r($response);
		return $response;
	}
	/*----------------------------------------------------------------------------------------------------------*/
	/*----------------------------------------- Save Contact --------------------------------------------------*/
	function save_contact($data,$frm)
	{
		$query = sprintf("INSERT INTO %s (%s) %s", $table, $keys, $values);
	}
	/*-------------------------------------------------------------------------------------------------------*/
	function dynamicUpdate($getTbname,$getArray)
	{
		$fr_user_id = $this->CONFIG->loggedUserId;
		foreach ($getArray as $key => $value) 
		{
			//$value = mysql_real_escape_string($con,$value);
			$value = "'$value'";
			$updates[] = "$key = $value";
		}
		$implodeArray = implode(', ', $updates);
		 $sql = sprintf("UPDATE %s SET %s WHERE fr_user_id='".$this->CONFIG->loggedUserId."' AND fr_itr_id = '".$this->CONFIG->currentITRID."'", $getTbname, $implodeArray);
		 //echo "SQL:-".$sql;
		$result =  $this->db->db_run_query($sql);
	}
	function dynamicUpdateMultiple($table,$array) 
    { 
		/*----------------------------------- 20190226-BSEN -------------------------------------*/
		/*echo "|array|";
		print_r($array);*/
		/*echo "|sec_arg_value|".$sec_arg_value;
		echo "|sec_arg_name|".$sec_arg_name;*/
		/*----------------------------------- 20190226-BSEN -------------------------------------*/
		
    	$sec_arg_value = reset($array);
        $sec_arg_name   = key($array);
        unset($array[$sec_arg_name]);
		/*----------------------------  Remove it -----------------------------------------------*/
        //$fr_user_id = array_shift($array);
		$fr_user_id = $this->CONFIG->loggedUserId;
		/*----------------------------------- 20190226-BSEN -------------------------------------*/
		/*echo "|afterarray|";
		print_r($array);*/
		/*----------------------------------- 20190226-BSEN -------------------------------------*/
		foreach ($array as $key => $value) 
		{			
			$value = "'$value'";
			$updates[] = "$key = $value";
		}
		/*----------------------------------- 20190226-BSEN -------------------------------------*/
        $implodeArray = implode(', ', $updates);
		/*echo "|implodeArray|";
		print_r($implodeArray);*/
		/*----------------------------------- 20190226-BSEN -------------------------------------*/
		
         $sql = sprintf("UPDATE %s SET %s WHERE  fr_user_id='%s' AND %s = '%s' AND fr_itr_id = '".$this->CONFIG->currentITRID."'", $table, $implodeArray,$fr_user_id,$sec_arg_name,$sec_arg_value);
	    /*----------------------------------- 20190226-BSEN -------------------------------------*/
		/*----------------------------------- For testing ---------------------------------------*/
		//echo "<br>dynamicUpdateMultiple".$sql;
        $result =  $this->db->db_run_query($sql);
        return $result;      
	}
	function insertMultiple($table,$array) {        
		//echo $table;print_r($array);
		$column='';$data ='';$count = 1;
		$user_id =  $this->CONFIG->loggedUserId;
		if(isset($array[0])) {
			foreach ($array as $eacharray ) {
				$temp ='';
				foreach ($eacharray as $key => $value )  {
					if ($count == 1) {
						$column .= $key.',';
					}
					$temp .="'".$value."',";
				}
				$data .= "(".rtrim($temp,',').'),';
				$count=0;
			}
		} else {
			$temp ='';
			foreach ($array as $key => $value ) {
				if ($count == 1) {
					$column .= $key.',';
				}
				$temp .="'".$value."',";
			}
			$data .= "(".rtrim($temp,',').'),';
			$count=0;		
		}
		$keys = rtrim($column,',');
		$values   ="values".rtrim($data,',').";";
		 $sql = sprintf("INSERT INTO %s (%s) %s", $table, $keys, $values);
		/*----------------------------------- 20190226-BSEN -------------------------------------*/
		/*----------------------------------- For testing ---------------------------------------*/
		//echo $sql;
		$result =  $this->db->db_run_query($sql);
		return $result;      
	}
	function latestRowById($table,$fr_user_id,$orderby,$limit) 
	{			
		$fr_user_id = $this->CONFIG->loggedUserId;
		$orderby = $orderby;
		$limit = $limit;
		$sql = sprintf("SELECT * FROM %s WHERE fr_user_id='%s' ORDER BY %s DESC LIMIT %s", $table, $fr_user_id,$orderby,$limit);
		$result = $this->db->db_run_query($sql);
		if($this->db->db_num_rows($result)>0) {
			$result = $this->getSingleRow($sql);		  	
		}
		//echo "<br>SQL:-".$sql."<br>";
		return $result;
	}

	function getSingleResult($sql)
	{
		return $this->getSingleRow($sql);
	}
	 
	function getSingleCol($retField,$tableName,$cond='')
	{
		$SQL = "SELECT ".$retField." FROM ".$CONFIG->dbName.$tableName;
		if($cond)
			$SQL .= " WHERE ".$cond;
		else
			$SQL .= " WHERE 1 LIMIT 0,1";
		//echo $SQL;
		$retRes = $this->getSingleRow($SQL);

		if(empty($retRes[$retField]))
			return "Empty Name";
		else
			return $retRes[$retField];
	}	

	function date_format1($date,$age='')
	{
		if($date != '')
		{
			$tmp = date("M d, Y",strtotime($date));
			return $tmp ;
		}
	}
	function getTimeDuration($stamp)
	{
		$stamp=time()- $stamp;
		if($stamp/60/60<24) return 'Today';
		else if($stamp/60/60>=24)
		{
			if($stamp/60/60/24==1) return 'Yesterday';
			else			
			return round($stamp/60/60/24).' day(s) ago';
		}
	}	
	
	function convertDateWithTime($str)
	{
		list($date, $time) = explode(' ', $str);
		list($year, $month, $day) = explode('-', $date);
		list($hour, $minute, $second) = explode(':', $time);
		
		$timestamp = mktime($hour, $minute, $second, $month, $day, $year);
		
		return $timestamp;
	}
	function removeCharFromArray($getArray,$getChar)
	{
		$totCol = count($getArray);
		while(list($key,$val)=each($getArray))
		{
			$getArray[$key] = str_replace($getChar,"",trim($val));
		}		
		return $getArray;
	}
	function cleanURL($getText)
	{	
		$retText = str_replace("&","_",str_replace("'","_",str_replace("\"","_",str_replace("?","_",str_replace(".","_",str_replace("(","_",str_replace(")","_",str_replace("{","_",str_replace("}","_",str_replace("[","_",str_replace("]","_",str_replace("@","_",str_replace("#","_",str_replace("$","_",str_replace("$","_",str_replace("$","_",str_replace("%","_",str_replace("^","_",str_replace("~","_",str_replace("!","_",str_replace("*","_",str_replace("+","_",str_replace("\\","_",str_replace("/","_",str_replace(">","_",str_replace("<","_",str_replace(";","_",str_replace(":","_",str_replace(" ","_",str_replace(",","_",strtolower($getText)))))))))))))))))))))))))))))));
	
		return $retText;	
	}
		
	function update($values,$tablename,$key_field,$key_value)
	{
		//print_r($values);
		global $CONFIG;
		$updates='';
		$index=0;
		array_pop($values);			// Remove Action
		foreach($values as $field => $value)
		{
			if(++$index!=count($values))
			{
				$updates.=$field."='".$value."',";
			}
			else
			{
				$updates.=$field."='".$value."'";
			}
		}
		$SQL="UPDATE ".$tablename." SET ".$updates.", last_update='".$CONFIG->timestamp."' WHERE ".$key_field."='".$key_value."'";
		if($this->db->db_run_query($SQL))
		return true;
		else return false;
	}
	function upload($getFileID)
	{
		 if(!$_FILES[$getFileID]['name']) return array('','No file specified');
		 $file_title = microtime(true)."_26AS_".$this->cleanURL($_FILES[$getFileID]['name']).".pdf";
		 $uploadfile = $this->CONFIG->customerFilePath.$file_title;
		 if (!move_uploaded_file($_FILES[$getFileID]['tmp_name'], $uploadfile)) 
		 {
		 }
		 else
		 {
		 	 chmod($uploadfile,0777); //Make it universally writable.
			 return array($file_title);
		 }
	}
	function dateFormat($date)
	{
			return date("M d, Y",$date);
	}

	function dateFormatWithTime($date)
	{
			return date("F j, Y, g:i a",strtotime($date));
	}

	
	function readPHP($getFilenameWithPath)
	{
		// echo "<br>READ PHP".$getFilenameWithPath;
		$partialToken = md5('d9c9b9');
		ob_start();
		// echo "Current Directory".getcwd();
		include($getFilenameWithPath);
		$htmlText = ob_get_contents();
		ob_end_clean();
		// echo "<br>HTMLTEXT:-".$htmlText;
		return $htmlText;
	}
	
	function send_mail($email_to,$subject,$message,$html=false,$attachment='',$from_email='support@optymoney.com',$from_name='Optymoney Support') {
		/*echo "<br>Common Function:-";
		 echo "EMail To:-".$email_to."<br>";
		 echo "Subject:-".$subject."<br>";
		 echo "message:-".$message."<br>";
		 echo "Attachment".$attachment."<br>";*/
		global $mdocmail;
		if($attachment == '')
			$res = $mdocmail->sendHTMLMails("$email_to",$from_email,$from_name,$subject,$message,'','html');
		else
			$res = $mdocmail->sendHTMLMails($email_to,$from_email,$from_name,$subject,$message,'','html',$attachment);
		//mail($email_to, $subject, stripslashes($message), $headers);
		return $res;
	}
	function send_mail_client($from_name1,$email_to,$subject,$message,$html=false,$attachment='',$from_email='support@optymoney.com',$from_name='Optymoney Support') {
		/*echo "<br>Common Function:-";
		echo "EMail To:-".$email_to."<br>";
		echo "Subject:-".$subject."<br>";
		echo "message:-".$message."<br>";
		echo "Attachment".$attachment."<br>";*/
		global $mdocmail;
		if($attachment == '')
			$res = $mdocmail->sendHTMLMails("$email_to",$from_email,$from_name,$subject,$message,'','html');
		else
			$res = $mdocmail->sendHTMLMails($email_to,$from_email,$from_name,$subject,$message,'','html',$attachment);
		//mail($email_to, $subject, stripslashes($message), $headers);
		return $res;
   	}	
	function send_mail_para($email_id,$subject,$msg_format,$name,$frm_mail,$from_name)
	{

			// echo "EMAIL:-".$email_id."<br>";
			// echo "subject:-".$subject."<br>";
			// echo "msg_format:-".$msg_format."<br>";
			// echo "name:-".$name."<br>";
			
			$destination = $this->CONFIG->wwwroot."__lib.mailFormats/".$msg_format;
			//echo "<br>destination:-".$destination;
			
			
			
		    $message = $this->readPHP($destination); 
			
            $message = str_replace("USERNAME",$name,$message);
           //echo "<br>MESSAGE:".$message;
             
            $this->send_mail($email_id,$subject,$message,true,'',$frm_mail,$from_name);
            return false;
	}
	function send_bulk_mail($email_to,$subject,$message,$html=false,$attachment='',$from_email='support@optymoney.com',$from_name='Optymoney Support')
	{
		// echo "<br>Common Function:-";
		// echo "EMail To:-".$email_to."<br>";
		// echo "Subject:-".$subject."<br>";
		// echo "message:-".$message."<br>";
		
		global $mdocmail;
		if($attachment == '')
			$mdocmail->bulkEmailSend($email_to,$from_email,$from_name,$subject,$message,'','html');
		else
			$mdocmail->bulkEmailSend($email_to,$from_email,$from_name,$subject,$message,'','html',$attachment);
		//mail($email_to, $subject, stripslashes($message), $headers);
		return;
	}
	function jsRedirect($url) 
	{
		echo "<script>location.href='".$url."'</script>";
		exit;
	}
	function splitFilenameWithExt($getFilename,$withPath='')
	{
		if($withPath !='')
		{
		}
		
		$f = explode(".",$getFilename);
		$totalCount = count($f)-1;
		$retFilename = '';
		$extOfFile = $f[$totalCount];
		while(list($key,$val) = each($f))
		{
			if($key < $totalCount)
				$retFilename .= $val;
		}
		return array($retFilename,$extOfFile);
	}
	function generateString($length)
	{
		global $CONFIG;
		$t = time();
		$charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
	
		for($i=0; $i<$length; $i++) $key .= $charset[(mt_rand(0,(strlen($charset)-1)))]; 
	
		return $t."_".$key;
	}
	function require_login() 
	{
		if($this->CONFIG->loggedUserId == '')
			$this->jsRedirect($this->CONFIG->siteurl."logout.php");
	}

	function validate_email($str)
	{ 
        $str = strtolower($str); 
        if(ereg("^([^[:space:]]+)@(.+)\.(ad|ae|af|ag|ai|al|am|an|ao|aq|ar|arpa|as|at|au|aw|az|ba|bb|bd|be|bf|bg|bh|bi|bj|bm|bn|bo|br|bs|bt|bv|bw|by|bz|ca|cc|cd|cf|cg|ch|ci|ck|cl|cm|cn|co|com|cr|cu|cv|cx|cy|cz|de|dj|dk|dm|do|dz|ec|edu|ee|eg|eh|er|es|et|fi|fj|fk|fm|fo|fr|fx|ga|gb|gov|gd|ge|gf|gh|gi|gl|gm|gn|gp|gq|gr|gs|gt|gu|gw|gy|hk|hm|hn|hr|ht|hu|id|ie|il|in|int|io|iq|ir|is|it|jm|jo|jp|ke|kg|kh|ki|km|kn|kp|kr|kw|ky|kz|la|lb|lc|li|lk|lr|ls|lt|lu|lv|ly|ma|mc|md|mg|mh|mil|mk|ml|mm|mn|mo|mp|mq|mr|ms|mt|mu|mv|mw|mx|my|mz|na|nato|nc|ne|net|biz|info|nf|ng|ni|nl|no|np|nr|nu|nz|om|org|pa|pe|pf|pg|ph|pk|pl|pm|pn|pr|pt|pw|py|qa|re|ro|ru|rw|sa|sb|sc|sd|se|sg|sh|si|sj|sk|sl|sm|sn|so|sr|st|sv|sy|sz|tc|td|tf|tg|th|tj|tk|tm|tn|to|tp|tr|tt|tv|tw|tz|ua|ug|uk|um|us|uy|uz|va|vc|ve|vg|vi|vn|vu|wf|ws|ye|yt|yu|za|zm|zw)$",$str)){ 
        return 1; 
        } else { 
        return 0; 
        } 
    }
    public function dynamicUpdatePay($getTbname, $getArray, $payID) {
        $fr_user_id = $this->CONFIG->loggedUserId;
        foreach ($getArray as $key => $value) {
            //$value = mysql_real_escape_string($con,$value);
            $value = "'$value'";
            $updates[] = "$key = $value";
        }
        $implodeArray = implode(', ', $updates);
        $sql = sprintf('UPDATE %s SET %s WHERE pk_user_settings_id='.$payID.' AND fr_user_id='.$this->CONFIG->loggedUserId, $getTbname, $implodeArray);
        //echo "<br>SQL:-".$sql;
        //die();
        $result = $this->db->db_run_query($sql);
        return $result;
	} 
	
} // End Class
?>
