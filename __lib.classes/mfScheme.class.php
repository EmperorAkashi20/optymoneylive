<?php
class mfScheme{

	function mfScheme()
	{
		global $CONFIG,$commonFunction;
		global $db;
		$this->db					= $db;
		$this->dbName				= $CONFIG->dbName;	
		$this->commonFunction		= $commonFunction;	
		$this->CONFIG				= $CONFIG;	
		$this->mfScheme 			= array();
	}
	
	function getSchemesByRiskId($getRequest)
	{
		$SQL = "SELECT * FROM mf_schemes WHERE Scheme_Type = '".$getRequest."' ORDER BY PORTFOLIO_Type ASC";	
		//echo $SQL;
		$schemeArray =  $this->commonFunction->mysqlResultIntoArray($SQL,'SQL');	
		return $schemeArray;
	}	
	function schemeCount()
	{
		$SQL = "SELECT count(*) count FROM mf_schemes";				
		$result1 = $this->db->db_run_query($SQL);	// or die(mysql_error());
		$r1 = $this->db->db_fetch_array($result1);
		$count1=(int)$r1['count'];
		return $count1;
	}	
}
?>