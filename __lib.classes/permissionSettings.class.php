<?php
class permissionSettings{

	function permissionSettings()
	{
		global $db,$CONFIG,$commonFunction,$customerProfile,$documentFiles,$folders;

		$this->db = $db;
		$this->dbName	 = $CONFIG->dbName;	
		$this->commonFunction	 = $commonFunction;	
		$this->CONFIG	 = $CONFIG;	
		$this->customerProfile	 = $customerProfile;	
		$this->folders	 = $folders;	
		$this->permissionSettings = array();
		$this->CONFIG->permissionTable = $this->setPermissionTable();
	}
	function allowUpload()
	{
		$SQL="SELECT * FROM mdoc_disk_usages WHERE fr_customer_id   = '".$this->CONFIG->customerId."'";	
		$sizeArr = $this->commonFunction->getSingleRow($SQL);
		if($sizeArr[quota_used] >= $sizeArr[quota_assigned])
		{
			return false;
		} 
		else
		{
			return true;
		}
	}
	function needPermission()
	{																		
		//echo $this->CONFIG->userType;
		if($this->CONFIG->userType == "Sub_User")
			return true;
		else
			return false;
	}
	function pageAccessPermission($getPageType,$getPageActionName)
	{
		if($this->needPermission())
		{
			$permTableArr = $this->getPermissionTable($this->CONFIG->loggedUserId);				
			//echo $getPageActionName;print_r($permTableArr[$getPageType]);exit;
			if(count($permTableArr[$getPageType]) > 0)
			{
				if(!in_array($getPageActionName,$permTableArr[$getPageType]))
					return false;
				else
					return true;
			}
			else
				return false;
		}
		else						// If Owner
			return true;
	}
	function pagePermissionAction($getPageType,$getPageActionName)
	{
		global $_SESSION;
		if($this->needPermission())
		{
			if($this->pageAccessPermission($getPageType,$getPageActionName))
			{
				// Do Nothing if get TRUE		
			}
			else
			{
				$_SESSION['msg_strip'] = "You don't have permission to access this page. Please contact to account administrator.";
				$this->commonFunction->jsRedirect("?module_interface=".$this->commonFunction->setPage('home'));
				exit;
			}
		}
		else						// If Owner
			return true;
	}
	function getPermissionTable($getSubUserId)		// Get User Id, In case of edit
	{
		$userPermArr = array();
		$getUserPermSQL = "SELECT * FROM mdoc_access_user WHERE fr_user_id = '".$getSubUserId."'";	
		$getUserPermission = $this->commonFunction->mysqlResultIntoArray($getUserPermSQL,'SQL');	
		while(list($fileKey,$fileVal) = each($getUserPermission))
		{
			$userPermArr[$fileVal[access_type]][] = $fileVal[access_action];
		}
		return $userPermArr;
	}
	function setPermissionTable()
	{		
		$getAllPermission = $this->getAccessMaster();
		while(list($fileKey,$fileVal) = each($getAllPermission))
		{
			$this->CONFIG->permissionTable[$fileVal[access_type]][] = $fileVal[access_action];
		}
		return $this->CONFIG->permissionTable;
		//print_r($getAllPermission);
		//exit;
	}
	
	function addEditUserAccess($getPostedData)
	{
		//print_r($getPostedData);
		$file = $getPostedData[File];
		$folder = $getPostedData[Folder];
		$report = $getPostedData[Report];
		$profile = $getPostedData[Profile];
		$tag = $getPostedData[Tag];
		$Add_user = $getPostedData[Add_user];
		$user_id = $getPostedData[user_id];
		
		if(count($file) > 0)
		{			
			while(list($fileKey,$fileVal) = each($file))
			{
				$SQL = "SELECT * FROM mdoc_access_user WHERE fr_user_id   = '".$user_id."' AND access_action = '".$fileVal."' AND access_type = 'File'";	
				$chkRes = $this->db->db_run_query($SQL);
				$accCount = $this->db->db_num_rows($chkRes);		
				if($accCount == 0)
				{					
					$this->db->db_run_query("INSERT INTO mdoc_access_user SET fr_user_id = '".$user_id."', access_type='File',access_action='".$fileVal."',user_access_create_date=now()");					
				}
			}
			$this->deleteUnusedPermission($user_id,"File",$file);			
		}
		else
			$this->db->db_run_query("DELETE FROM mdoc_access_user WHERE fr_user_id = '".$user_id."' AND access_type='File'");
		
		if(count($folder) > 0)
		{
			while(list($fileKey,$fileVal) = each($folder))
			{
				$SQL = "SELECT * FROM mdoc_access_user WHERE fr_user_id   = '".$user_id."' AND access_action = '".$fileVal."' AND access_type = 'Folder'";	
				$chkRes = $this->db->db_run_query($SQL);
				$accCount = $this->db->db_num_rows($chkRes);		
				if($accCount == 0)
				{					
					$this->db->db_run_query("INSERT INTO mdoc_access_user SET fr_user_id = '".$user_id."', access_type='Folder',access_action='".$fileVal."',user_access_create_date=now()");
				}
			}
			$this->deleteUnusedPermission($user_id,"Folder",$folder);	
		}
		else
			$this->db->db_run_query("DELETE FROM mdoc_access_user WHERE fr_user_id = '".$user_id."' AND access_type='Folder'");
		
		if(count($report) > 0)
		{
			while(list($fileKey,$fileVal) = each($report))
			{
				$SQL = "SELECT * FROM mdoc_access_user WHERE fr_user_id   = '".$user_id."' AND access_action = '".$fileVal."' AND access_type = 'Report'";	
				$chkRes = $this->db->db_run_query($SQL);
				$accCount = $this->db->db_num_rows($chkRes);		
				if($accCount == 0)
				{					
					$this->db->db_run_query("INSERT INTO mdoc_access_user SET fr_user_id = '".$user_id."', access_type='Report',access_action='".$fileVal."',user_access_create_date=now()");
				}
			}
			$this->deleteUnusedPermission($user_id,"Report",$report);				
		}
		else
			$this->db->db_run_query("DELETE FROM mdoc_access_user WHERE fr_user_id = '".$user_id."' AND access_type='Report'");
		
		if(count($profile) > 0)
		{
			while(list($fileKey,$fileVal) = each($profile))
			{
				$SQL = "SELECT * FROM mdoc_access_user WHERE fr_user_id   = '".$user_id."' AND access_action = '".$fileVal."' AND access_type = 'Profile'";	
				$chkRes = $this->db->db_run_query($SQL);
				$accCount = $this->db->db_num_rows($chkRes);		
				if($accCount == 0)
				{					
					$this->db->db_run_query("INSERT INTO mdoc_access_user SET fr_user_id = '".$user_id."', access_type='Profile',access_action='".$fileVal."',user_access_create_date=now()");
				}
			}
			$this->deleteUnusedPermission($user_id,"Profile",$profile);
		}
		else
			$this->db->db_run_query("DELETE FROM mdoc_access_user WHERE fr_user_id = '".$user_id."' AND access_type='Profile'");

		if(count($tag) > 0)
		{
			while(list($fileKey,$fileVal) = each($tag))
			{
				$SQL = "SELECT * FROM mdoc_access_user WHERE fr_user_id   = '".$user_id."' AND access_action = '".$fileVal."' AND access_type = 'Tag'";	
				$chkRes = $this->db->db_run_query($SQL);
				$accCount = $this->db->db_num_rows($chkRes);		
				if($accCount == 0)
				{					
					$this->db->db_run_query("INSERT INTO mdoc_access_user SET fr_user_id = '".$user_id."', access_type='Tag',access_action='".$fileVal."',user_access_create_date=now()");
				}
			}
			$this->deleteUnusedPermission($user_id,"Tag",$tag);
		}
		else
			$this->db->db_run_query("DELETE FROM mdoc_access_user WHERE fr_user_id = '".$user_id."' AND access_type='Tag'");
			
		if(count($Add_user) > 0)
		{
			while(list($fileKey,$fileVal) = each($Add_user))
			{
				$SQL = "SELECT * FROM mdoc_access_user WHERE fr_user_id   = '".$user_id."' AND access_action = '".$fileVal."' AND access_type = 'Add_user'";	
				$chkRes = $this->db->db_run_query($SQL);
				$accCount = $this->db->db_num_rows($chkRes);		
				if($accCount == 0)
				{					
					$this->db->db_run_query("INSERT INTO mdoc_access_user SET fr_user_id = '".$user_id."', access_type='Add_user',access_action='".$fileVal."',user_access_create_date=now()");
				}
			}
			$this->deleteUnusedPermission($user_id,"Add_user",$Add_user);			
		}
		else
			$this->db->db_run_query("DELETE FROM mdoc_access_user WHERE fr_user_id = '".$user_id."' AND access_type='Add_user'");
			
	}	
	function deleteUnusedPermission($getUserid,$getPermType,$getUserPermArr)
	{
		$leaveSelectedPerm = '';
		while(list($fileKey,$fileVal) = each($getUserPermArr))
		{
			$leaveSelectedPerm .= " access_action != '".$fileVal."' AND ";
		}
		$this->db->db_run_query("DELETE FROM mdoc_access_user WHERE fr_user_id = '".$getUserid."' AND access_type='".$getPermType."' AND (".substr($leaveSelectedPerm,0,-4).")");
		//echo "DELETE FROM mdoc_access_user WHERE fr_user_id = '".$getUserid."' AND access_type='".$getPermType."' AND (".substr($leaveSelectedPerm,0,-3).")";
		//exit;
	}
	function getAccessMaster()
	{
		$accMasterQuery	= "SELECT * FROM mdoc_access_master";
		return $this->commonFunction->mysqlResultIntoArray($accMasterQuery,'SQL');
	}
	
}

?>