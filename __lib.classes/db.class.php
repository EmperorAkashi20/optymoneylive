<?php
class Db {
	
	function connect(){
		global $CONFIG;
		/*----------------------------------- 20190218-BSEN -------------------------------------*/
		
		/*--------------- Changed mysql to mysqli for upgrading from php 5.6 into php 7 ---------*/
		
		
		    /*-----------------------------  Old Query  -------------------------------------*/
		
		/*
		$mySqlLink = mysqli_connect($CONFIG->dbHost,$CONFIG->dbUser,$CONFIG->dbPassword) or die(mysqli_error());
		@mysqli_select_db($CONFIG->dbName) or die(mysqli_error());
		*/
		
		  /*-----------------------------------  New Query   -------------------------------*/
		$mySqlLink = mysqli_connect($CONFIG->dbHost,$CONFIG->dbUser,$CONFIG->dbPassword,$CONFIG->dbName);// or die(mysqli_error());
		mysqli_options($mySqlLink, MYSQLI_OPT_LOCAL_INFILE, true);
		return $mySqlLink;
	}

	function db_run_query($query) {
		global $CONFIG;
		/*----------------------------------- 20190218-BSEN -------------------------------------*/
		
		/*----------------------------------- Testing purpose -------------------------------------*/
		
		//echo "Query |".$query."<br>";
		//die();
		
		/*------------ Changed mysql to mysqli for upgrading from php 5.6 into php 7 --------------*/
		
		 /*-----------------------------  Old Query  -------------------------------------*/
		
		//$temp = mysql_query(str_replace("information_schema","",str_replace("mysql","",($query))),$CONFIG->dbLink) ;
		//or die("<font size=2 color=red>You have an error(<font color=black>". mysqli_error() . "</font>) in executing query : " . $query . " in file " . __FILE__ . " at line " . __LINE__ . "</font>");
		 //echo "TEMP |".$temp;
		
		/*-----------------------------------  New Query   -------------------------------*/
		
		$temp = mysqli_query($CONFIG->dbLink,str_replace("information_schema","",str_replace("mysqli","",($query)))) ;
		//echo $query;
		return $temp;
		//mysqli_real_escape_string
		//return mysqli_query($query,$CONFIG->dbLink);
	}
	function db_run_query_bene($query) {
	    global $CONFIG;
		
		/*----------------------------------- 20190218-BSEN -------------------------------------*/
		
		/*------------ Changed mysql to mysqli for upgrading from php 5.6 into php 7 --------------*/
		
		/*------------------------------------  Old Query  -------------------------------------*/
		
		 //$temp = mysql_query($query,$CONFIG->dbLink);
		
		/*-----------------------------------  New Query   ------------------------------------*/
		
	    $temp = mysqli_query($CONFIG->dbLink,$query);
	    return $temp;
	}
	function db_fetch_array($result) {
		
		/*----------------------------------- 20190218-BSEN -------------------------------------*/
		
		/*------------ Changed mysql to mysqli for upgrading from php 5.6 into php 7 --------------*/
		
		/*------------------------------------  Old Query  -------------------------------------*/
		
		//return mysql_fetch_array($result);
		
		/*-----------------------------------  New Query   ------------------------------------*/
		
		return mysqli_fetch_array($result);
	}
	
	function db_fetch_row($result) {
		
		/*----------------------------------- 20190218-BSEN -------------------------------------*/
		
		/*------------ Changed mysql to mysqli for upgrading from php 5.6 into php 7 --------------*/
		
		/*------------------------------------  Old Query  -------------------------------------*/
		
		//return mysql_fetch_row($result);
		
		/*-----------------------------------  New Query   ------------------------------------*/
		
		return mysqli_fetch_row($result);
	}
	
	function db_fetch_object($result) {
		
		/*----------------------------------- 20190218-BSEN -------------------------------------*/
		
		/*------------ Changed mysql to mysqli for upgrading from php 5.6 into php 7 --------------*/
		
		/*------------------------------------  Old Query  -------------------------------------*/
		
		//return mysql_fetch_object($result);
		
		/*-----------------------------------  New Query   ------------------------------------*/
		return mysqli_fetch_object($result);
	}
	function db_fetch_object_item($result, $num) {
		
		/*----------------------------------- 20190218-BSEN -------------------------------------*/
		
		/*------------ Changed mysql to mysqli for upgrading from php 5.6 into php 7 --------------*/
		
		
	    while($num > 0) {
	        //echo $num;
			/*------------------------------------  Old Query  -------------------------------------*/
			
			//mysql_fetch_object($result);
			
			/*-----------------------------------  New Query   ------------------------------------*/
			
	        mysqli_fetch_object($result);
	        $num = $num - 1;
	    }
	    return mysqli_fetch_object($result);
	}
	function db_num_rows($result) {
		
		/*----------------------------------- 20190218-BSEN -------------------------------------*/
		
		/*------------ Changed mysql to mysqli for upgrading from php 5.6 into php 7 --------------*/
		
		/*------------------------------------  Old Query  -------------------------------------*/
		//return mysql_num_rows($result);
		
		/*-----------------------------------  New Query   ------------------------------------*/
		
		return mysqli_num_rows($result);
	}
	
	function db_affected_rows() {
		
		/*----------------------------------- 20190218-BSEN -------------------------------------*/
		
		/*------------ Changed mysql to mysqli for upgrading from php 5.6 into php 7 --------------*/
		
		/*------------------------------------  Old Query  -------------------------------------*/
		
		//return mysql_affected_rows();
		
		/*-----------------------------------  New Query   ------------------------------------*/
		
		return mysqli_affected_rows();
	}
	function db_insert_id() {
		
		/*----------------------------------- 20190218-BSEN -------------------------------------*/
		
		/*------------ Changed mysql to mysqli for upgrading from php 5.6 into php 7 --------------*/
		
		global $CONFIG; //update the global config to reflect the customer login data
		
		/*------------------------------------  Old Query  -------------------------------------*/
		
		//return mysqli_insert_id();
		
		/*-----------------------------------  New Query   ------------------------------------*/
		
		return mysqli_insert_id($CONFIG->dbLink);
		
	}
	function db_num_fields($result) {
		/*----------------------------------- 20190218-BSEN -------------------------------------*/
		
		/*------------ Changed mysql to mysqli for upgrading from php 5.6 into php 7 --------------*/
		
		/*------------------------------------  Old Query  -------------------------------------*/
		
		//return mysql_num_fields($result);
		/*-----------------------------------  New Query   ------------------------------------*/
		return mysqli_num_fields($result);
	}
	
	function db_field_name($query, $fieldno) {
		/*----------------------------------- 20190218-BSEN -------------------------------------*/
		
		/*------------ Changed mysql to mysqli for upgrading from php 5.6 into php 7 --------------*/
		
		/*------------------------------------  Old Query  -------------------------------------*/
		
		//return mysql_field_name($query, $fieldno);
		
		/*-----------------------------------  New Query   ------------------------------------*/
		return mysqli_field_name($query, $fieldno);
	}
	
	function db_fetch_assoc($result) {
		
		/*----------------------------------- 20190218-BSEN -------------------------------------*/
		
		/*------------ Changed mysql to mysqli for upgrading from php 5.6 into php 7 --------------*/
		
		/*------------------------------------  Old Query  -------------------------------------*/
		
		//return mysql_fetch_assoc($result);
		
		/*-----------------------------------  New Query   ------------------------------------*/
		
		return mysqli_fetch_assoc($result);
	}

	function db_close() {
		
		/*----------------------------------- 20190218-BSEN -------------------------------------*/
		
		/*------------ Changed mysql to mysqli for upgrading from php 5.6 into php 7 --------------*/
		
		/*------------------------------------  Old Query  -------------------------------------*/
		
		//return mysql_close();
		
		/*-----------------------------------  New Query   ------------------------------------*/
		
		return mysqli_close();
	}

}
?>