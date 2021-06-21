<?php
class search{

	function search()
	{
		global $CONFIG,$commonFunction,$documentFiles,$folders;
		global $db;
		$this->db = $db;
		$this->dbName	 = $CONFIG->dbName;	
		$this->commonFunction	 = $commonFunction;	
		$this->CONFIG	 = $CONFIG;	
		$this->documentFiles	 = $documentFiles;	
		$this->folders	 = $folders;	
		$this->search = array();
	}	
		
	

}

?>