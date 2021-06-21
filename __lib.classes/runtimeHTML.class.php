<?php
class runtimeHTML{

	function runtimeHTML()
	{
		global $CONFIG,$commonFunction,$customerProfile,$permissionSettings;
		global $db;
		$this->db					= $db;
		$this->dbName				= $CONFIG->dbName;	
		$this->commonFunction		= $commonFunction;	
		$this->CONFIG				= $CONFIG;	
		$this->customerProfile		= $customerProfile;
		$this->permissionSettings	= $permissionSettings;	
		$this->tags = array();
	}
	function isPermissionFound($getPageType,$getPageActionName,$linkHTML,$retHTML='')
	{			
		//echo $getPageType,$getPageActionName,$linkHTML;
		if($this->permissionSettings->pageAccessPermission($getPageType,$getPageActionName))
			return $linkHTML;
		else
			return $retHTML;
     
	}
	
}

?>