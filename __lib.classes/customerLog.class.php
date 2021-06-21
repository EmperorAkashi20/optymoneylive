<?php
class customerLog{

	function customerLog()
	{
		global $CONFIG;
		global $db;
		global $commonFunction;
		$this->db				= $db;
		$this->CONFIG			= $CONFIG;	
		$this->dbName			= $this->CONFIG;	
		$this->customerLog		= array();	
		$this->commonFunction	= $commonFunction;		
		$this->documentFiles	= $documentFiles;		
	}
	
	function insertLog($userId,$customerID,$acDescription,$getIP,$usrType='USER')
	{		
		$sql = "INSERT INTO bfsi_activities (fr_user_id,fr_customer_id,acitivity_description,activity_ip,user_type) 
				values('".$userId."','".$customerID."','".$acDescription."','".$getIP."','".$usrType."')";
		
		$this->db->db_run_query($sql);
	}
	function activityLogin($getUserId,$getCustomerID,$getEmail,$getIP,$usrType='USER')
	{
		$logDescription = 'Last Login "'.$this->commonFunction->dateFormatWithTime(date("F j, Y, g:i a")).'" by '.$getEmail.' From IP '.$getIP;
		$this->insertLog($getUserId,$getCustomerID,$logDescription,$getIP,$usrType);
	}
	function activityDocUpload($getUserId,$getCustomerID,$getEmail,$docName,$getIP)
	{
		$logDescription = $docName.' Document Uploaded at "'.$this->commonFunction->dateFormatWithTime(date("F j, Y, g:i a")).'" by '.$getEmail.' From IP '.$getIP;
		$this->insertLog($getUserId,$getCustomerID,$logDescription,$getIP);
	}
	
	function activityLogCommon($logDescription)
	{
		$logDescription = $logDescription." at ".$this->commonFunction->dateFormatWithTime(date("F j, Y, g:i a")).' From IP '.$this->CONFIG->loggedIP;
		$this->insertLog($this->CONFIG->loggedUserId || $this->CONFIG->loggedAdminId,$this->CONFIG->customerId,$logDescription,$this->CONFIG->loggedIP);
	}
	function getAllLogs($customerID,$usrType='USER')
	{
		$SQL="SELECT * FROM bfsi_activities WHERE fr_customer_id  = '".$customerID."' AND user_type  = '".$usrType."' ORDER BY pk_activity_id DESC";	
		return $this->commonFunction->mysqlResultIntoArray($SQL,'SQL');
	}
	function logCount($customerID,$usrType='USER')
	{
		$SQL="SELECT * FROM bfsi_activities WHERE fr_customer_id  = '".$customerID."' AND user_type  = '".$usrType."'";
		$tagRes	= $this->db->db_run_query($SQL);
		return $this->db->db_num_rows($tagRes);
	}
	function getBrowser()
	{
		global $_SERVER;	
		$u_agent = $_SERVER['HTTP_USER_AGENT'];
		$bname = 'Unknown';
		$platform = 'Unknown';
		$version= "";
	
		//First get the platform?
		if (preg_match('/linux/i', $u_agent)) {
			$platform = 'linux';
		}
		elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
			$platform = 'mac';
		}
		elseif (preg_match('/windows|win32/i', $u_agent)) {
			$platform = 'windows';
		}
	   
		// Next get the name of the useragent yes seperately and for good reason
		if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent))
		{
			$bname = 'Internet Explorer';
			$ub = "MSIE";
		}
		elseif(preg_match('/Firefox/i',$u_agent))
		{
			$bname = 'Mozilla Firefox';
			$ub = "Firefox";
		}
		elseif(preg_match('/Chrome/i',$u_agent))
		{
			$bname = 'Google Chrome';
			$ub = "Chrome";
		}
		elseif(preg_match('/Safari/i',$u_agent))
		{
			$bname = 'Apple Safari';
			$ub = "Safari";
		}
		elseif(preg_match('/Opera/i',$u_agent))
		{
			$bname = 'Opera';
			$ub = "Opera";
		}
		elseif(preg_match('/Netscape/i',$u_agent))
		{
			$bname = 'Netscape';
			$ub = "Netscape";
		}
	   
		// finally get the correct version number
		$known = array('Version', $ub, 'other');
		$pattern = '#(?<browser>' . join('|', $known) .
		')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
		if (!preg_match_all($pattern, $u_agent, $matches)) {
			// we have no matching number just continue
		}
	   
		// see how many we have
		$i = count($matches['browser']);
		if ($i != 1) {
			//we will have two since we are not using 'other' argument yet
			//see if version is before or after the name
			if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
				$version= $matches['version'][0];
			}
			else {
				$version= $matches['version'][1];
			}
		}
		else {
			$version= $matches['version'][0];
		}
	   
		// check if we have a number
		if ($version==null || $version=="") {$version="?";}
	   
		return array(
			'userAgent' => $u_agent,
			'name'      => $bname,
			'version'   => $version,
			'platform'  => $platform,
			'pattern'    => $pattern
		);
	} 
}  
//class closed

?>
