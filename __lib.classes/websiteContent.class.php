<?php
class websiteContent{

	function websiteContent()
	{
		global $CONFIG,$commonFunction,$customerProfile,$permissionSettings;
		global $db;
		$this->db					= $db;
		$this->dbName				= $CONFIG->dbName;	
		$this->commonFunction		= $commonFunction;	
		$this->CONFIG				= $CONFIG;	
		$this->customerProfile		= $customerProfile;
		$this->websiteContent 		= array();
	}
	function addMenu($REQUEST)
	{			
		$updateSql = "INSERT INTO bfsi_website SET link_name = '".$REQUEST[link_name]."', link_url='".str_replace(" ","_",strtolower($REQUEST[link_url]))."', 
					  link_keyword='".$REQUEST[link_keyword]."', link_description='".$REQUEST[link_description]."', link_title='".$REQUEST[link_title]."',
					   link_content='".$REQUEST[link_content]."', link_position='".$REQUEST[link_position]."',link_status='".$REQUEST[link_status]."'";
		$this->db->db_run_query($updateSql);
     
	}
	function updateMenu($REQUEST)
	{			
		$updateSql = "UPDATE bfsi_website SET link_name = '".$REQUEST[link_name]."', link_url='".str_replace(" ","_",strtolower($REQUEST[link_url]))."', 
					  link_keyword='".$REQUEST[link_keyword]."', link_description='".$REQUEST[link_description]."', link_title='".$REQUEST[link_title]."',
					   link_content='".$REQUEST[link_content]."', link_position='".$REQUEST[link_position]."',link_status='".$REQUEST[link_status]."'
					   WHERE pk_website_id = '".$REQUEST[pk_website_id]."'";
		$this->db->db_run_query($updateSql);     
	}
	function getMenuById($getRequest)
	{
		$SQL = "SELECT * FROM bfsi_website WHERE pk_website_id = '".$getRequest[mid]."'";	
		$menuArray =  $this->commonFunction->mysqlResultIntoArray($SQL,'SQL');	
		return $menuArray;
	}	
	function menuCount()
	{
		$SQL = "SELECT count(*) count FROM bfsi_website";				
		$result1 = $this->db->db_run_query($SQL);	// or die(mysql_error());
		$r1 = $this->db->db_fetch_array($result1);
		$count1=(int)$r1['count'];
		return $count1;
	}
	function menuList($getRequest='',$pageLimit='')
	{
		if($pageLimit != '')
			$limit = " LIMIT ".$pageLimit.",".$this->CONFIG->paginationPageItem;
		else
			$limit='';
			
		$countSearch = $this->menuCount();
		if($getRequest !='')
			$where = " WHERE link_position = '".$getRequest."' AND link_status = 'Active'";
			
		$SQL = "SELECT * FROM bfsi_website ".$where. " ORDER BY pk_website_id DESC";	
		
		if($countSearch > 0)
		{			
			$menuArray =  $this->commonFunction->mysqlResultIntoArray($SQL,'SQL');	
		}
		else
			$menuArray = array("MF_NONE");
		
		//print_r($folioArray);	
		return $menuArray;
	}	
}

?>