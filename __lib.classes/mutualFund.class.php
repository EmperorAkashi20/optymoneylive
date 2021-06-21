<?php
class mutualFund{

	function mutualFund()
	{
		global $CONFIG,$commonFunction,$documentFiles,$customerProfile,$_SESSION;
		global $db;
		$this->db					= $db;
		$this->dbName				= $CONFIG->dbName;	
		$this->commonFunction		= $commonFunction;	
		$this->CONFIG				= $CONFIG;	
		$this->documentFiles		= $documentFiles;	
		$this->customerProfile		= $customerProfile;	
		$this->mutualFund			= array();
		$this->buysell				= $buySell;
	}	
	function updatePrice() {
		$sqlNavPrice	= "SELECT * FROM amfi_data WHERE is_updated = 0";
		//echo "SQL:-".$sqlNavPrice;
		$navPriceResult = $this->db->db_run_query($sqlNavPrice);
		while($val = $this->db->db_fetch_array($navPriceResult)) {
			//echo "<br>SQL_ master:- SELECT * FROM mf_master WHERE isin = '".$val['ISIN']."'";
			if($this->db->db_num_rows($this->db->db_run_query("SELECT * FROM mf_master WHERE isin = '".$val[ISIN]."'")) > 0) {
				$update_date = date("Y-m-d",strtotime($val[amfi_update_date]));
				//echo "UPDATE_DATE:".$update_date."<br>";
				//echo "SELECT * FROM mf_nav_price WHERE ISIN = '".$val[ISIN]."' AND price_date = '".$update_date."'";
				//echo "<br><br><br><br>";
				//die();
				if($this->db->db_num_rows($this->db->db_run_query("SELECT * FROM mf_nav_price WHERE ISIN = '".$val[ISIN]."' AND price_date = '".$update_date."'")) == 0) {				
					/*echo "SELECT * FROM mf_master WHERE ISIN = '".$val[ISIN]."'"."<br>";*/
					$navMaster = $this->commonFunction->getSingleRow("SELECT * FROM mf_master WHERE isin = '".$val[ISIN]."'");
					// echo "INSERT INTO mf_nav_price SET fr_nav_id = '".$navMaster[pk_nav_id]."',price_date= '".$update_date."',
					// 					net_asset_value='".$val[net_asset_value]."',repur_unit='0.00',sale_price='0',
					// 					fr_unique_no='".$navMaster[Unique_No]."',fr_scheme_code='".$navMaster[scheme_code]."',
					// 					fr_scheme_name='".addslashes($navMaster[scheme_name])."',ISIN = '".$val[ISIN]."'";
					// echo "<br><br><br><br>";
					/*----------------------------------- Remove repur_unit ----------------------------------------------*/
					// $this->db->db_run_query("INSERT INTO mf_nav_price SET fr_nav_id = '".$navMaster[pk_nav_id]."',price_date= '".$update_date."',net_asset_value='".$val[net_asset_value]."',repur_unit='0.00',sale_price='0',
					// 					fr_unique_no='".$navMaster[Unique_No]."',fr_scheme_code='".$navMaster[scheme_code]."',
					// 					fr_scheme_name='".addslashes($navMaster[scheme_name])."',ISIN = '".$val[ISIN]."'");

					$this->db->db_run_query("INSERT INTO mf_nav_price SET fr_nav_id = '".$navMaster[pk_nav_id]."',price_date= '".$update_date."',net_asset_value='".$val[net_asset_value]."',sale_price='0',
										fr_unique_no='".$navMaster[unique_no]."',repurchase_price=0,fr_scheme_code='".$navMaster[scheme_code]."',
										fr_scheme_name='".addslashes($navMaster[scheme_name])."',ISIN = '".$val[ISIN]."'");

					// echo "INSERT INTO mf_nav_price SET fr_nav_id = '".$navMaster[pk_nav_id]."',price_date= '".$update_date."',net_asset_value='".$val[net_asset_value]."',sale_price='0',fr_unique_no='".$navMaster[Unique_No]."',fr_scheme_code='".$navMaster[scheme_code]."',
					// 					fr_scheme_name='".addslashes($navMaster[scheme_name])."',ISIN = '".$val[ISIN]."'";

					/*echo "INSERT INTO mf_nav_price SET fr_nav_id = '".$navMaster[pk_nav_id]."',price_date= '".$update_date."',net_asset_value='".$val[net_asset_value]."',sale_price='0',
										fr_unique_no='".$navMaster[unique_no]."',repurchase_price=0,fr_scheme_code='".$navMaster[scheme_code]."',
										fr_scheme_name='".addslashes($navMaster[scheme_name])."',ISIN = '".$val[ISIN]."'";*/

					$this->db->db_run_query("UPDATE amfi_data SET is_updated = 1 WHERE pk_amfi_price_id = '".$val[pk_amfi_price_id]."'");
					//echo "UPDATE amfi_data SET is_updated = 1 WHERE pk_amfi_price_id = '".$val[pk_amfi_price_id]."'";
				} else {
					echo "THis date price already in table.";// THis date price already in table.
				}
			}

			//echo "<br>ISIN_REINVESTMENT:-SELECT * FROM mf_master WHERE isin = '".$val[ISIN_REINVESTMENT]."'<br>";
			if($this->db->db_num_rows($this->db->db_run_query("SELECT * FROM mf_master WHERE isin = '".$val[ISIN_REINVESTMENT]."'")) > 0) {
				$update_date = date("Y-m-d",strtotime($val[amfi_update_date]));
				//echo "UPDATE_DATE:".$update_date."<br>";
				//echo "SELECT * FROM mf_nav_price WHERE ISIN = '".$val[ISIN]."' AND price_date = '".$update_date."'";
				//echo "<br><br><br><br>";
				//die();
				if($this->db->db_num_rows($this->db->db_run_query("SELECT * FROM mf_nav_price WHERE ISIN = '".$val[ISIN_REINVESTMENT]."' AND price_date = '".$update_date."'")) == 0) {				
					/*echo "SELECT * FROM mf_master WHERE ISIN = '".$val[ISIN]."'"."<br>";*/
					$navMaster = $this->commonFunction->getSingleRow("SELECT * FROM mf_master WHERE isin = '".$val[ISIN_REINVESTMENT]."'");
					$this->db->db_run_query("INSERT INTO mf_nav_price SET fr_nav_id = '".$navMaster[pk_nav_id]."',price_date= '".$update_date."',net_asset_value='".$val[net_asset_value]."',sale_price='0',
										fr_unique_no='".$navMaster[unique_no]."',repurchase_price=0,fr_scheme_code='".$navMaster[scheme_code]."',
										fr_scheme_name='".addslashes($navMaster[scheme_name])."',ISIN = '".$val[ISIN_REINVESTMENT]."'");
					/*echo "INSERT INTO mf_nav_price SET fr_nav_id = '".$navMaster[pk_nav_id]."',price_date= '".$update_date."',net_asset_value='".$val[net_asset_value]."',sale_price='0',
										fr_unique_no='".$navMaster[unique_no]."',repurchase_price=0,fr_scheme_code='".$navMaster[scheme_code]."',
										fr_scheme_name='".addslashes($navMaster[scheme_name])."',ISIN = '".$val[ISIN_REINVESTMENT]."'";*/
					$this->db->db_run_query("UPDATE amfi_data SET is_updated = 1 WHERE pk_amfi_price_id = '".$val[pk_amfi_price_id]."'");
					//echo "UPDATE amfi_data SET is_updated = 1 WHERE pk_amfi_price_id = '".$val[pk_amfi_price_id]."'";
				} else {
					echo "THis date ISIN Reinvestment price already in table.";// THis date price already in table.
				}
			} else {
				echo "<br>NO ISIN REINVESTMENT<br>";
			}
		}
	}

	/*-------------------------------------------------------------External Price Update------------------------------------------------------------------------------------------*/

	function exupdatePrice() {
		$sqlNavPrice	= "SELECT * FROM all_nav WHERE nav_status = 0";
		$navPriceResult = $this->db->db_run_query($sqlNavPrice);
		while($val = $this->db->db_fetch_array($navPriceResult)) {
			if($this->db->db_num_rows($this->db->db_run_query("SELECT * FROM mf_master WHERE isin = '".$val[ISIN]."'")) > 0) {
				// echo "<pre>";
				// print_r($val);
				// echo "</pre>";
				$update_date = date("Y-m-d",strtotime($val[nav_date]));
				// echo "UPDATE_DATE:".$update_date."<br>";
				// echo "SELECT * FROM mf_nav_price WHERE ISIN = '".$val[ISIN]."' AND price_date = '".$update_date."'";
				// echo "<br><br><br><br>";
				//die();
				if($this->db->db_num_rows($this->db->db_run_query("SELECT * FROM mf_nav_price WHERE ISIN = '".$val[ISIN]."' AND price_date = '".$update_date."'")) == 0) {				
					//echo "SELECT * FROM mf_master WHERE ISIN = '".$val[ISIN]."'"."<br>";
					$navMaster = $this->commonFunction->getSingleRow("SELECT * FROM mf_master WHERE isin = '".$val[ISIN]."'");
					echo "<br>"."<br>INSERT INTO mf_nav_price SET fr_nav_id = '".$navMaster[pk_nav_id]."',price_date= '".$update_date."',net_asset_value='".doubleval($val[nav])."',sale_price='0',
										fr_unique_no='".$navMaster[unique_no]."',fr_scheme_code='".$navMaster[scheme_code]."',
										fr_scheme_name='".addslashes($navMaster[scheme_name])."',ISIN = '".$val[ISIN]."'"."<br>";
					// echo "<br><br><br><br>";
					$this->db->db_run_query("INSERT INTO mf_nav_price SET fr_nav_id = '".$navMaster[pk_nav_id]."',price_date= '".$update_date."',net_asset_value='".doubleval($val[nav])."',sale_price='0',
										fr_unique_no='".$navMaster[Unique_No]."',fr_scheme_code='".$navMaster[scheme_code]."',
										fr_scheme_name='".addslashes($navMaster[scheme_name])."',ISIN = '".$val[ISIN]."'");
					$this->db->db_run_query("UPDATE all_nav SET nav_status = 1 WHERE nav_id = '".$val[nav_id]."'");
				} else {
					echo "<br>This date price already in table.<br>";// THis date price already in table.
				}
			} else {
				echo "Not found in BSE Master Physical, then INSERT into NAV MASTER<br>";// Not found in BSE Master Physical, then INSERT into NAV MASTER
			}
		}
	}

	/*--------------------------------------------- Add to cart table --------------------------------------------------------*/
	function cart_query($value,$action) {
		if ($action == 1) {
			$get_nav = $this->commonFunction->mysqlResultIntoArray("SELECT net_asset_value FROM mf_nav_price inner join mf_master on mf_nav_price.ISIN=mf_master.isin where pk_nav_id=".$value[sch_d]." order by mf_nav_price.price_date desc limit 1");
			$nav = $get_nav[0][net_asset_value];
			if($value[sip_date] == 0) {
				$p_method = 1;  // Lumpsum
				$f_amount = $value[f_lum_amount];
			}
			else {
				$p_method = 2;	//SIP
				$f_amount = $value[f_sip_amount];
			}
			//echo "f_amount : ".$f_amount;
			//echo "<br>INSERT into mf_cart_sys SET fr_usr_id='".$this->CONFIG->loggedUserId."',sch_id='".$value[sch_d]."',amnt='".$f_amount."',d_day_nav=".$nav.",date_sip=".$value[sip_date].",p_method='".$p_method."',cart_usr_ip='".$_SERVER['REMOTE_ADDR']."',cart_timestamp=now()";
			$cart_insert_sql = $this->db->db_run_query("INSERT into mf_cart_sys SET fr_usr_id='".$this->CONFIG->loggedUserId."',sch_id='".$value[sch_d]."',amnt='".$f_amount."',d_day_nav=".$nav.",date_sip=".$value[sip_date].",p_method='".$p_method."',cart_usr_ip='".$_SERVER['REMOTE_ADDR']."',cart_timestamp=now()");
			//echo "<br><br><br>echo SQL=".$cart_insert_sql;
			//exit;
			//return $cart_insert_sql;
			//$link = '"'.$CONFIG->siteurl."mySaveTax/?module_interface='".$this->commonFunction->setPage('cart_sys').'"';
			//echo "INSERT into mf_cart_sys SET fr_usr_id='".$this->CONFIG->loggedUserId."',sch_id='".$value[sch_d]."',amnt='".$value[f_amount]."',d_day_nav=".$nav.",date_sip=".$value[sip_date].",p_method='".$p_method."',cart_usr_ip='".$_SERVER['REMOTE_ADDR']."',cart_timestamp=now()";
		}
		elseif($action == 2) {
			$cart_insert_sql = $this->db->db_run_query("Update mf_cart_sys set cart_status='2' where mf_cart_id='".$value[cart_id]."'");
		}
		$link = $this->CONFIG->siteurl."mySaveTax/?module_interface='".$this->commonFunction->setPage('cart_sys');
		// echo "Link:".$link;
		//die();
		header("location:".$link); 	
	}
	function cart_query_api($value,$action) {
		if ($action == 1) {
			$get_nav = $this->commonFunction->mysqlResultIntoArray("SELECT net_asset_value FROM mf_nav_price inner join mf_master on mf_nav_price.ISIN=mf_master.isin where pk_nav_id=".$value->sch_d." order by mf_nav_price.price_date desc limit 1");
			$nav = $get_nav[0]['net_asset_value'];
			if($value->sip_date == 0) {
				$p_method = 1;  // Lumpsum
				$f_amount = $value->f_lum_amount;
			}
			else {
				$p_method = 2;	//SIP
				$f_amount = $value->f_sip_amount;
			}
			$cart_insert_sql = $this->db->db_run_query("INSERT into mf_cart_sys SET fr_usr_id='".$value->uid."',sch_id='".$value->sch_d."',amnt='".$f_amount."',d_day_nav=".$nav.",date_sip=".$value->sip_date.",p_method='".$p_method."',cart_usr_ip='".$_SERVER['REMOTE_ADDR']."',cart_timestamp=now()");
			if($cart_insert_sql==1) {
				$val['status'] = "success";
				$val['msg'] =  "Scheme added to cart successfully";
			} else{
				$val['status'] = "failure";
				$val['msg'] =  "Adding to cart failed, please try again";
			}
		}
		elseif($action == 2) {
			$cart_insert_sql = $this->db->db_run_query("Update mf_cart_sys set cart_status='2' where mf_cart_id='".$value->cart_id."'");
			if($cart_insert_sql==1) {
				$val['status'] = "success";
				$val['msg'] =  "Scheme deleted successfully";
			} else{
				$val['status'] = "failure";
				$val['msg'] =  "Scheme deletion failed, please try again";
			}
		}
		echo json_encode($val);
	}
	/*-------------------------------------------------- Fetch Oreders in settings ---------------------------------------------------------------------*/
	function fetch_orders() {
		//$fetch_orders = $this->commonFunction->mysqlResultIntoArray("SELECT mf_master.scheme_name,mf_cart_sys.amnt,mf_cart_sys.p_method,mf_cart_sys.date_sip,mf_cart_sys.mf_cart_id,mf_cart_sys.cart_timestamp FROM mf_cart_sys inner join mf_nav_recomended on (mf_cart_sys.sch_id=mf_nav_recomended.pk_recomend_id) inner join mf_master on (mf_nav_recomended.fr_nav_id= mf_master.pk_nav_id)  where fr_usr_id=".$this->CONFIG->loggedUserId." AND cart_status='1'");
		$fetch_orders = $this->commonFunction->mysqlResultIntoArray("SELECT mf_master.scheme_name,mf_cart_sys.amnt,mf_cart_sys.p_method,mf_cart_sys.date_sip,mf_cart_sys.mf_cart_id,mf_cart_sys.cart_timestamp FROM mf_cart_sys inner join mf_master on (mf_cart_sys.sch_id=mf_master.pk_nav_id) where fr_usr_id=".$this->CONFIG->loggedUserId." AND cart_status='1'");
		return $fetch_orders;
	}
	/*-------------------------------------------------- Fetch Oreders in settings ---------------------------------------------------------------------*/
	function fetch_orders_api($uid) {
		//$fetch_orders = $this->commonFunction->mysqlResultIntoArray("SELECT mf_master.scheme_name,mf_cart_sys.amnt,mf_cart_sys.p_method,mf_cart_sys.date_sip,mf_cart_sys.mf_cart_id,mf_cart_sys.cart_timestamp FROM mf_cart_sys inner join mf_nav_recomended on (mf_cart_sys.sch_id=mf_nav_recomended.pk_recomend_id) inner join mf_master on (mf_nav_recomended.fr_nav_id= mf_master.pk_nav_id)  where fr_usr_id=".$this->CONFIG->loggedUserId." AND cart_status='1'");
		//echo "SELECT mf_master.scheme_name,mf_cart_sys.amnt,mf_cart_sys.p_method,mf_cart_sys.date_sip,mf_cart_sys.mf_cart_id,mf_cart_sys.cart_timestamp FROM mf_cart_sys inner join mf_master on (mf_cart_sys.sch_id=mf_master.pk_nav_id) where fr_usr_id=".$uid." AND cart_status='1'";
		$fetch_orders = $this->commonFunction->mysqlResultIntoArray("SELECT mf_master.scheme_name,mf_cart_sys.amnt,mf_cart_sys.p_method,mf_cart_sys.date_sip,mf_cart_sys.mf_cart_id,mf_cart_sys.cart_timestamp FROM mf_cart_sys inner join mf_master on (mf_cart_sys.sch_id=mf_master.pk_nav_id) where fr_usr_id=".$uid." AND cart_status='1'");
		return $fetch_orders;
	}

	/*-------------------------------------------------- Fetch cart Count ---------------------------------------------------------------------*/
	function fetch_cart_count() {
		$fetch_cart_cnt = $this->db->db_num_rows($this->db->db_run_query("SELECT * FROM mf_cart_sys where fr_usr_id=".$this->CONFIG->loggedUserId." AND cart_status='0'"));
		return $fetch_cart_cnt;
	}

	function fetch_cart_count_api($uid) {
		$fetch_cart_cnt = $this->db->db_num_rows($this->db->db_run_query("SELECT * FROM mf_cart_sys where fr_usr_id=".$uid." AND cart_status='0'"));
		$val['status'] = "success";
		$val['count'] =  $fetch_cart_cnt;
		echo json_encode($val);
	}
	/*-------------------------------------------------- Fetch cart deatils ---------------------------------------------------------------------*/
	function fetch_cart($action) {
		if($action == "") {
			$fetch_cart_sql = $this->commonFunction->mysqlResultIntoArray("SELECT mf_master.scheme_name,mf_cart_sys.amnt,mf_cart_sys.p_method,mf_cart_sys.date_sip,mf_cart_sys.mf_cart_id FROM mf_cart_sys inner join mf_master on (mf_cart_sys.sch_id= mf_master.pk_nav_id)  where fr_usr_id=".$this->CONFIG->loggedUserId." AND cart_status='0'");
		} else if($action == 2) {
			$fetch_cart_sql = $this->commonFunction->mysqlResultIntoArray("SELECT mf_master.scheme_code,mf_cart_sys.amnt,mf_cart_sys.p_method,mf_cart_sys.date_sip,mf_cart_sys.mf_cart_id,bfsi_bank_details.mandate_id,bfsi_user.bse_id	FROM mf_cart_sys inner join mf_master on (mf_cart_sys.sch_id = mf_master.pk_nav_id) 
                inner join bfsi_user on (mf_cart_sys.fr_usr_id = bfsi_user.pk_user_id) inner join bfsi_bank_details on (bfsi_bank_details.fr_user_id = bfsi_user.pk_user_id) where mf_cart_sys.fr_usr_id=".$this->CONFIG->loggedUserId." AND mf_cart_sys.cart_status='0' AND bfsi_bank_details.default_bank = '1'");
		} else if($action == 3) {
			$fetch_cart_sql = $this->commonFunction->mysqlResultIntoArray("SELECT p_method FROM mf_cart_sys where fr_usr_id=".$this->CONFIG->loggedUserId." AND cart_status='0'");
		}
		return $fetch_cart_sql;
	}

	function fetch_cart_api($action) {
		// echo "status : ".$action->status; 
		if($action->status == "") {
			$fetch_cart_sql = $this->commonFunction->mysqlResultIntoArray("SELECT mf_master.scheme_name,mf_cart_sys.amnt,mf_cart_sys.p_method,mf_cart_sys.date_sip,mf_cart_sys.mf_cart_id FROM mf_cart_sys inner join mf_master on (mf_cart_sys.sch_id= mf_master.pk_nav_id)  where fr_usr_id=".$action->uid." AND cart_status='0'");
		} else if($action->status == 2) {
			$fetch_cart_sql = $this->commonFunction->mysqlResultIntoArray("SELECT mf_master.scheme_code,mf_cart_sys.amnt,mf_cart_sys.p_method,mf_cart_sys.date_sip,mf_cart_sys.mf_cart_id,bfsi_bank_details.mandate_id,bfsi_user.bse_id	FROM mf_cart_sys inner join mf_master on (mf_cart_sys.sch_id = mf_master.pk_nav_id) 
                inner join bfsi_user on (mf_cart_sys.fr_usr_id = bfsi_user.pk_user_id) inner join bfsi_bank_details on (bfsi_bank_details.fr_user_id = bfsi_user.pk_user_id) where mf_cart_sys.fr_usr_id=".$action->uid." AND mf_cart_sys.cart_status='0' AND bfsi_bank_details.default_bank = '1'");
		} else if($action->status == 3) {
			$fetch_cart_sql = $this->commonFunction->mysqlResultIntoArray("SELECT p_method FROM mf_cart_sys where fr_usr_id=".$action->uid." AND cart_status='0'");
		}
		
		return $fetch_cart_sql;
	}
	/*------------------------------------------------------------------------------------------------------------------------------------------*/

	/*------------------------------------------------------- Check User status --------------------------------------------------------------------*/
	function chk_usr_status() {
		$SQL = "SELECT * FROM mf_live_table where pan_no='".$this->CONFIG->UserPan."' order by asset_type";
		//echo "SQL:".$SQL;
		$count = $this->db->db_num_rows($this->db->db_run_query($SQL));
		//echo "Count:-".$count;
		return $count;
	}
	function get_trxn_status() {
		//$SQL = "SELECT * FROM mf_cart_sys where fr_usr_id='2150' order by mf_cart_id desc limit 1";
		//$SQL = "SELECT * FROM mf_cart_sys where fr_usr_id='".$this->CONFIG->loggedUserId."' order by mf_cart_id desc limit 1";
		$SQL ="SELECT mf_cart_sys.mf_cart_id,mf_cart_sys.bse_order_id,bfsi_user.bse_id FROM mf_cart_sys inner join bfsi_user on (mf_cart_sys.fr_usr_id=bfsi_user.pk_user_id) where mf_cart_sys.fr_usr_id='".$this->CONFIG->loggedUserId."' order by mf_cart_sys.mf_cart_id desc limit 1";
		//echo "<br>SQL:-".$SQL."<br>";
		$get_trxn_status = $this->db->db_fetch_assoc($this->db->db_run_query($SQL));
		return $get_trxn_status;
	}

	function fetch_child() {
		$buySell = new buySell();
       	$link = $buySell->sipChild();
		return $link;
	}

	function fetch_portfolio_app($data) {
		/*-------------------------------------------------- Transaction Status ------------------------------------------------------------------*/
		//FOR KARVY & CAM
		$purchase = array('P','SI','TI','DR');
		//FOR FRANKLIN
		$frnklin_pur = array("NEWPUR","ADDPUR","TI","SWIN","SIP");
		//FOR KARVY & CAM
		$sell = array('R','SO','TO');
		//FOR FRANKLIN
		$franklin_red = array('DIR','RED','SIPR','SWOF','NEWPURR','TO');

		/*---------------------------------------------------------------------------------------------------------------------------------------------------------*/
		$this->db->db_run_query("SET sql_mode = ''");
		//For Getting all Folio
		$fetch_portfolio = array();
		if ($data[pan]!="") {
			//echo "SELECT folio,fr_scheme_code FROM mf_live_table where pan_no='".$this->CONFIG->UserPan."' AND duplicate_val='0' group by folio order by scheme_name";
			$all_sch_code = $this->db->db_run_query("SELECT folio,fr_scheme_code FROM mf_live_table where pan_no='".$data[pan]."' AND duplicate_val='0' group by scheme_name, folio order by scheme_name");
			while ($all_sch_row = $this->db->db_fetch_assoc($all_sch_code)) {
				//echo "folio : ".$all_sch_row[folio]."---scheme code : ".$all_sch_row[fr_scheme_code];
				//For Get all details of the folio
				/*$SQL = "SELECT mlt.pan_no, mlt.fr_scheme_code, mlt.tran_type, mlt.unit, mlt.scheme_name, mlt.purchase_price, mlt.purchase_date, mlt.folio, mlt.amount, mlt.trans_mode, mlt.scheme_type, mm.pk_nav_id, mm.scheme_code, mm.isin FROM mf_live_table mlt INNER JOIN mf_master mm on mm.pk_nav_id = (
					SELECT p2.pk_nav_id
					FROM mf_master AS p2
					WHERE p2.channel_partner_code = mlt.fr_scheme_code
					LIMIT 1
				) where mlt.pan_no='".$this->CONFIG->UserPan."' AND mlt.folio='".$all_sch_row[folio]."' AND mlt.fr_scheme_code='".$all_sch_row[fr_scheme_code]."' AND duplicate_val=0 order by mlt.purchase_date asc";
				*/
				$SQL = "SELECT fr_scheme_code,tran_type,unit,scheme_name,purchase_price,purchase_date,folio,fr_franklin_id,fr_cam_id,fr_karvy_id,amount,trans_mode, scheme_type FROM mf_live_table where pan_no='".$data[pan]."' AND folio='".$all_sch_row[folio]."' AND fr_scheme_code='".$all_sch_row[fr_scheme_code]."' AND duplicate_val=0  order by purchase_date asc";
				$SQL1 = "SELECT pk_nav_id, isin, scheme_code FROM mf_master where channel_partner_code='".$all_sch_row[fr_scheme_code]."' limit 1";
				//echo "<br>SQL:".$SQL;
				$stamnt = $this->commonFunction->mysqlResultIntoArray($SQL,'SQL');	//$this->db->db_num_rows($this->db->db_run_query($SQL));
				$stamnt1 = $this->commonFunction->mysqlResultIntoArray($SQL1,'SQL');
				$pk_nav_id = ""; 
				$bse_scheme_code = "";
				$isin = "";
				$stamnt = $this->commonFunction->mysqlResultIntoArray($SQL,'SQL');	//$this->db->db_num_rows($this->db->db_run_query($SQL));
				$stamnt1 = $this->commonFunction->mysqlResultIntoArray($SQL1,'SQL');
				while(list($key,$val) = each($stamnt1)) {
					$pk_nav_id = $val[pk_nav_id]; 
					$bse_scheme_code = $val[scheme_code];
					$isin = $val[isin];
				}
				$acStmtArr = array();
				$folio = "";
				$fr_scheme_name = "";
				$purchase_price = "";
				$unit = "";
				$fr_scheme_code = "";
				$trantype = "";
				$acStmtArr1 = array();
				$unitPrice = array();
				$unitPriceList = array();
				$tran_type      = "";
				$pur_price      = "";
				$sell_price = "";
				$pur_unit = 0;
				$amnt = 0;
				$scheme_type = "";
				$fr_cam_id = "";
				$fr_karvy_id = "";
				$sellUnits = 0;
				$totInvest = 0;
				$pur = array();
				$red = 0;
				while(list($key,$val) = each($stamnt)) {
					//echo "<br>array : ".$acStmtArr;
					$folio = $val[folio];
					$fr_scheme_name = $val[scheme_name];
					$scheme_type = $val[scheme_type];
					$purchase_price = $val[purchase_price];
					$unit = $val[unit];
					$fr_scheme_code = $val[fr_scheme_code];
					if ($folio === "") {
						$acStmtArr["folio"] = $val[folio];
					}
					if(isset($val[fr_franklin_id]))	{
						//Addition Units
						foreach ($frnklin_pur as $pur_value) {
							if ($val[tran_type] === $pur_value)	{
								$pur_unit +=  $val[unit];	
								$amnt  +=	$val[amount];
							} 
						}
						//Redemption Units
						foreach ($franklin_red as $sell_value) {
							if ($val[tran_type] === $sell_value) {
								$pur_unit -= $val[unit];
								$amnt  -=	$val[amount];	
							} 
						}
					} else {
						$math = "";
						if (isset($val[fr_cam_id])) {
							$fr_cam_id = $val[fr_cam_id];
							$result = substr($val[tran_type], 0, 1);
							if($result == "P" || $result == "R") {
								$trantype =  $result; 
							}
							$result = substr($val[tran_type], 0, 2);
							if($result == "SI"   ||  $result == "SO" || $result == "TI" || $result == "TO" || $result == "DR") {
								$trantype =  $result; 
							}
							foreach ($purchase as $pur_value) {
								if ($trantype == $pur_value) {
									if($val[unit]>0||$val[unit]<0) {
										$pur_unit += $val[unit];	
										$amnt  +=	$val[amount];
										//$pur[]= $val[purchase_date]."----".round($amnt, 3)."----".round($pur_unit, 3)."----".$val[unit]."----".$val[amount]."----".$val[tran_type]."----".$trantype."<br>";
									}
								} 
							}
							//Redemption Units
							foreach ($sell as $sell_value) {
								if ($trantype == $sell_value) {
									$pur_unit -= $val[unit];
									$amnt  -=	$val[amount];		
									//$red[]= round($amnt, 3)."----".round($pur_unit, 3)."----".$val[unit]."----".$val[amount]."----".$val[tran_type]."----".$trantype."<br>";
								} 
							}
						} else {
							$fr_karvy_id = $val[fr_karvy_id];
							foreach ($purchase as $pur_value)  {
								if ($val[tran_type] == $pur_value) {
									$pur_unit += $val[unit];
									$amnt  +=	$val[amount];
								} 
							}
							//Redemption Units
							foreach ($sell as $sell_value) {
								if ($val[tran_type] == $sell_value) {
									if($val[unit]<0) {
										$pur_unit -=  abs($val[unit]);
										$amnt  -=	abs($val[amount]);
									} else{
										$pur_unit -=  $val[unit];
										$amnt  -=	$val[amount];
									}
								} 
							}
							//$pur[]= round($pur_unit, 3)."----".$val[unit];
						}
					}
					$c++;
					//echo "<br>-------------------------------------------------------------------------<br>";
				}
				$get_nav = $this->get_nav_latest($fr_scheme_code);
				$acStmtArr["isin"] = $isin;
				$acStmtArr["folio"] = $folio;
				$acStmtArr["pk_nav_id"] = $pk_nav_id;
				$acStmtArr["bse_scheme_code"] = $bse_scheme_code;
				$acStmtArr["fr_scheme_name"] = $fr_scheme_name;
				$acStmtArr["scheme_type"] = $scheme_type;
				$acStmtArr["purchase_price"] = $purchase_price;
				$acStmtArr["amount"] = round($amnt, 2);
				//$acStmtArr["fr_franklin_id"] = $fr_franklin_id;
				//$acStmtArr["fr_cam_id"] = $fr_cam_id;
				//$acStmtArr["fr_karvy_id"] = $fr_karvy_id;
				$acStmtArr["fr_scheme_code"] = $fr_scheme_code;
				$acStmtArr["nav_price"] = round($get_nav['net_asset_value'], 4);
				
				if(round($pur_unit, 3) <= 0) {
					$acStmtArr["all_units"] = 0;
					$status = "closed";
				}
				else {
					$acStmtArr["all_units"] = round($pur_unit, 3);
					$status = "active";
				}
				$acStmtArr["pur"] = $pur;
				$acStmtArr["red"] = $red;

				$k = 0;
				foreach ( $fetch_portfolio as $key => $value ) {
					if($value["pk_nav_id"]==$acStmtArr["pk_nav_id"]) {
						$acStmtArr["purchase_price"] = $value["purchase_price"] + $purchase_price;
						$acStmtArr["amount"] = round(($value["amount"] + $amnt), 2);
						$acStmtArr["all_units"] = round(($value["all_units"] + $pur_unit), 3);
						$acStmtArr["msg"] = "exist".$key;
						$k=$key;
						if(round($acStmtArr["all_units"], 3) <= 0) {
							$status = "closed";
						}
						else {
							$status = "active";
						}
						break;
					} else {
						$acStmtArr["msg"] = "not exist";
					}
				}
				$acStmtArr["status"] = $status;
				$acStmtArr["msg"] = "";
				//print_r($acStmtArr);
				//echo "<br>";
				//if($pur_unit!=0){
					if($k==0) {
						$fetch_portfolio[] = $acStmtArr;
					} else {
						$fetch_portfolio[$k] = $acStmtArr;
						$k=0;
					}
				//}
				$c++;
			} 
		} else {
			$fetch_portfolio[] = "";
		}
		return json_encode($fetch_portfolio);
		//return "SELECT folio,fr_scheme_code FROM mf_live_table where pan_no='".$data[pan]."' AND duplicate_val='0' group by scheme_name, folio order by scheme_name";
	}


	function fetch_portfolio() {
		/*-------------------------------------------------- Transaction Status ------------------------------------------------------------------*/
		/*------------------- Transaction status for purchase -----------------------*/
		/*
		P Purchases	Addition
		SI	Switch In	Addition
		TI	Transfer In	Addition
		DR	Dividend Reinvested	Addition
		#Franklin Purchase #
		NEWPUR	Fresh Purchase		
		ADDPUR	Additional Purchase		
		TI	    Transfer IN		
		SWIN	Switch In		
		SIP	    Systamatic Investment Plan		
		*/
		//FOR KARVY & CAM
		$purchase = array('P','SI','TI','DR');
		//FOR FRANKLIN
		$frnklin_pur = array("NEWPUR","ADDPUR","TI","SWIN","SIP");
		/*------------------- Transaction status for sell --------------------------*/
		/*
		R	Redemptions	Subtraction
		SO	Switch Out	Subtraction
		TO	Transfer Out	Subtraction
		J	Rejected Transaction	No Effect
		All others	Non Financial	No Effect
		#Franklin Sell #
		DIR	    Dividend Reinvestment		
		RED	    Redemption		
		SIPR	Systamatic Investment Plan Reversal 		
		SWOF	Switch Out		
		NEWPURR	Fresh Purchase Rejection		
		TO	    TRansfer Out		
		*/
		//FOR KARVY & CAM
		$sell = array('R','SO','TO');
		//FOR FRANKLIN
		$franklin_red = array('DIR','RED','SIPR','SWOF','NEWPURR','TO');

		/*---------------------------------------------------------------------------------------------------------------------------------------------------------*/
		$this->db->db_run_query("SET sql_mode = ''");
		//For Getting all Folio
		$fetch_portfolio = array();
		if ($this->CONFIG->UserPan!="") {
			//echo "SELECT folio,fr_scheme_code FROM mf_live_table where pan_no='".$this->CONFIG->UserPan."' AND duplicate_val='0' group by folio order by scheme_name";
			$all_sch_code = $this->db->db_run_query("SELECT folio,fr_scheme_code FROM mf_live_table where pan_no='".$this->CONFIG->UserPan."' AND duplicate_val='0' group by scheme_name, folio order by scheme_name");
			while ($all_sch_row = $this->db->db_fetch_assoc($all_sch_code)) {
				//echo "folio : ".$all_sch_row[folio]."---scheme code : ".$all_sch_row[fr_scheme_code];
				//For Get all details of the folio
				$SQL = "SELECT fr_scheme_code,tran_type,unit,scheme_name,purchase_price,purchase_date,folio,fr_franklin_id,fr_cam_id,fr_karvy_id,amount,trans_mode, scheme_type FROM mf_live_table where pan_no='".$this->CONFIG->UserPan."' AND folio='".$all_sch_row[folio]."' AND fr_scheme_code='".$all_sch_row[fr_scheme_code]."' AND duplicate_val=0  order by purchase_date asc";
				$SQL1 = "SELECT pk_nav_id, isin, scheme_code FROM mf_master where channel_partner_code='".$all_sch_row[fr_scheme_code]."' limit 1";
				//echo "<br>SQL:".$SQL;
				$count = $this->chk_usr_status();
				if($count > 0) {
					$pk_nav_id = ""; 
					$bse_scheme_code = "";
					$isin = "";
					$stamnt = $this->commonFunction->mysqlResultIntoArray($SQL,'SQL');	//$this->db->db_num_rows($this->db->db_run_query($SQL));
					$stamnt1 = $this->commonFunction->mysqlResultIntoArray($SQL1,'SQL');
					while(list($key,$val) = each($stamnt1)) {
						$pk_nav_id = $val[pk_nav_id]; 
						$bse_scheme_code = $val[scheme_code];
						$isin = $val[isin];
					}
					$acStmtArr = array();
					$folio = "";
					$fr_scheme_name = "";
					$purchase_price = "";
					$unit = "";
					$fr_scheme_code = "";
					$trantype = "";
					$acStmtArr1 = array();
					$unitPrice = array();
					$unitPriceList = array();
					$tran_type      = "";
					$pur_price      = "";
					$sell_price = "";
					$pur_unit = 0;
					$amnt = 0;
					$scheme_type = "";
					$fr_cam_id = "";
					$fr_karvy_id = "";
					$sellUnits = 0;
					$totInvest = 0;
					while(list($key,$val) = each($stamnt)) {
						//print_r($val);
						$folio = $val[folio];
						$fr_scheme_name = $val[scheme_name];
						$scheme_type = $val[scheme_type];
						$purchase_price = $val[purchase_price];
						$unit = $val[unit];
						$fr_scheme_code = $val[fr_scheme_code];
						if ($folio === "") {
							$acStmtArr["folio"] = $val[folio];
						}
						if(isset($val[fr_franklin_id]))	{
							//Addition Units
							foreach ($frnklin_pur as $pur_value) {
								if ($val[tran_type] === $pur_value)	{
									$pur_unit +=  $val[unit];	
									$amnt  +=	$val[amount];
								} 
							}
							//Redemption Units
							foreach ($franklin_red as $sell_value) {
								if ($val[tran_type] === $sell_value) {
									$pur_unit -= $val[unit];
									$amnt  -=	$val[amount];	
								} 
							}
							$pur[]= $val[purchase_date]."----".round($amnt, 3)."----".round($pur_unit, 3)."----".$val[unit]."----".$val[amount]."----".$val[tran_type]."----".$trantype."<br>";
						} else {
							$math = "";
							if (isset($val[fr_cam_id])) {
								$fr_cam_id = $val[fr_cam_id];
								$result = substr($val[tran_type], 0, 1);
								if($result == "P" || $result == "R") {
									$trantype =  $result; 
								}
								$result = substr($val[tran_type], 0, 2);
								if($result == "SI"   ||  $result == "SO" || $result == "TI" || $result == "TO" || $result == "DR") {
									$trantype =  $result; 
								}
								foreach ($purchase as $pur_value) {
									if ($trantype == $pur_value) {
										if($val[unit]>0||$val[unit]<0) {
											$pur_unit += $val[unit];	
											$amnt  +=	$val[amount];
											//$pur[]= $val[purchase_date]."----".round($amnt, 3)."----".round($pur_unit, 3)."----".$val[unit]."----".$val[amount]."----".$val[tran_type]."----".$trantype."<br>";
										}
									} 
								}
								//Redemption Units
								foreach ($sell as $sell_value) {
									if ($trantype == $sell_value) {
										$pur_unit -= $val[unit];
										$amnt  -=	$val[amount];		
										//$red[]= round($amnt, 3)."----".round($pur_unit, 3)."----".$val[unit]."----".$val[amount]."----".$val[tran_type]."----".$trantype."<br>";
									} 
								}
								$pur[]= $val[purchase_date]."----".round($amnt, 3)."----".round($pur_unit, 3)."----".$val[unit]."----".$val[amount]."----".$val[tran_type]."----".$trantype."<br>";
							} else {
								$fr_karvy_id = $val[fr_karvy_id];
								foreach ($purchase as $pur_value)  {
									if ($val[tran_type] == $pur_value) {
										$pur_unit += $val[unit];
										$amnt  +=	$val[amount];
									} 
								}
								//Redemption Units
								foreach ($sell as $sell_value) {
									if ($val[tran_type] == $sell_value) {
										$pur_unit -=  abs($val[unit]);
										$amnt  -=	abs($val[amount]);
									} 
								}
								$pur[]= $val[purchase_date]."----".round($amnt, 3)."----".round($pur_unit, 3)."----".$val[unit]."----".$val[amount]."----".$val[tran_type]."----".$trantype."<br>";
							}
						}
						$c++;
						//echo "<br>";
					}
					
					$acStmtArr["isin"] = $isin;
					$acStmtArr["folio"] = $folio;
					$acStmtArr["pk_nav_id"] = $pk_nav_id;
					$acStmtArr["bse_scheme_code"] = $bse_scheme_code;
					$acStmtArr["fr_scheme_name"] = $fr_scheme_name;
					$acStmtArr["scheme_type"] = $scheme_type;
					$acStmtArr["purchase_price"] = $purchase_price;
					$acStmtArr["amount"] = $amnt;
					$acStmtArr["fr_franklin_id"] = $fr_franklin_id;
					$acStmtArr["fr_cam_id"] = $fr_cam_id;
					$acStmtArr["fr_karvy_id"] = $fr_karvy_id;
					$acStmtArr["fr_scheme_code"] = $fr_scheme_code;
					$acStmtArr["nav_price"] = $get_nav;
					
					if(round($pur_unit, 3) <= 0) {
						$acStmtArr["all_units"] = 0;
						$status = "closed";
					}
					else {
						$acStmtArr["all_units"] = round($pur_unit, 3);
						$status = "active";
					}
					$acStmtArr["pur"] = $pur;
					$acStmtArr["red"] = $red;

					$k = 0;
					foreach ( $fetch_portfolio as $key => $value ) {
						if($value["pk_nav_id"]==$acStmtArr["pk_nav_id"]) {
							$acStmtArr["purchase_price"] = $value["purchase_price"] + $purchase_price;
							$acStmtArr["amount"] = $value["amount"] + $amnt;
							$acStmtArr["all_units"] = $value["all_units"] + $pur_unit;
							$acStmtArr["msg"] = "exist".$key;
							$k=$key;
							if(round($acStmtArr["all_units"], 3) <= 0) {
								$status = "closed";
							}
							else {
								$status = "active";
							}
							break;
						} else {
							$acStmtArr["msg"] = "not exist";
						}
					}
					$acStmtArr["status"] = $status;
					$acStmtArr["msg"] = json_encode($get_nav);
					//print_r($acStmtArr);
					//echo "<br>";
					//if($pur_unit!=0){
						if($k==0) {
							$fetch_portfolio[$isin] = $acStmtArr;
						} else {
							$fetch_portfolio[$k] = $acStmtArr;
							$k=0;
						}
					//}
				}
				$c++;
			} 
		} else {
			$fetch_portfolio[] = "";
		}
		//echo "Count:-".$count;
		return $fetch_portfolio;
	}
	/*----------------------------------------------- Day Changes Nave absolute Return  --------------------------------------------------------------------*/
	function get_per_nav($ISIN,$get_type) {
		//m = monthly and integer means years
		if($get_type == 'm') {
			//$prevs = date("Y-m--d");
			$tdate  = date("Y-m-d");
			$prevdt = date('Y-m-d', strtotime('-30 days'));
		} elseif($get_type == 1) {
			$tdate  = date("Y-m-d");
			$prevdt = date('Y-m-d', strtotime('-12 months'));
		} elseif($get_type == 3) {
			$tdate  = date("Y-m-d");
			$prevdt = date('Y-m-d', strtotime('-36 months'));
		} elseif($get_type == 5) {
			$tdate  = date("Y-m-d");
			$prevdt = date('Y-m-d', strtotime('-60 months'));
		}
		//$get_type = 1;
		//$day = date('D',strtotime($prevs));

		//echo "ISIN:".$ISIN."\/";
		//echo "Date:-".$tdate."\/";
		//echo "Previous Date:-".$prevdt."\/";
		//echo "DAY Name:-".$day;
		//$sql = "SELECT net_asset_value FROM mf_nav_price where ISIN='".$ISIN."' AND price_date'".$."'";

		$get_l_nav = $this->db->db_fetch_assoc($this->db->db_run_query("SELECT net_asset_value,price_date FROM mf_nav_price where ISIN = '".$ISIN."' ORDER BY price_date desc LIMIT 1"));
		//echo "<br>Latest Nav:-";
		//print_r($get_l_nav);

		$get_o_nav = $this->db->db_fetch_assoc($this->db->db_run_query("SELECT net_asset_value,price_date FROM mf_nav_price WHERE ISIN = '".$ISIN."' AND (price_date BETWEEN '".$prevdt."' AND '".$tdate."') order by price_date asc limit 1,1"));
		//echo "SELECT net_asset_value,price_date FROM mf_nav_price WHERE ISIN = '".$ISIN."' AND (price_date BETWEEN '".$prevdt."' AND '".$tdate."') order by price_date asc limit 1,1";
		//echo "<br>OLD Nav:-";
		//print_r($get_o_nav);		
		$nav_per = $this->nav_cal($get_o_nav[net_asset_value],$get_l_nav[net_asset_value],$get_type); 
		//echo "<br>NAV Percentage:-".$nav_per;
		//return $nav_per;
		//echo "<br>Old Nav:-".$get_o_nav."<br>";
		//echo "SELECT net_asset_value,price_date FROM mf_nav_price where ISIN = '".$ISIN."' AND price_date='".$prevs."' ORDER BY price_date desc LIMIT 1";
		
		return $nav_per;
		//return "SELECT net_asset_value,price_date FROM mf_nav_price where ISIN = '".$ISIN."' ORDER BY price_date desc LIMIT 1";
	}
	/*--------------------------------------------------- Get latest NAV data ------------------------------------------------------------------------*/
	function get_nav_latest($sch_code) {	
		$SQL = "SELECT mnm.scheme_name, mnm.channel_partner_code, mnm.isin, mnm.scheme_type, mnp.fr_scheme_name, mnp.net_asset_value, mnp.price_date FROM opty_m.mf_nav_price mnp INNER JOIN opty_m.mf_master mnm ON mnp.ISIN=mnm.isin where mnm.channel_partner_code='".$sch_code."' order by mnp.price_date desc limit 1";
		$get_nav = $this->db->db_fetch_assoc($this->db->db_run_query($SQL));
		return $get_nav;
	}
	
	/*-------------------------------------------------------- Getting OfferList start-------------------------------------------------------------------*/

	function get_offer_list() {
		$SQL = "SELECT pk_offer_id,offer_name,offer_group FROM opty_m.mf_nav_offer where offer_group='offer' and offer_status='Active'";
		$get_offer_list =  $this->commonFunction->mysqlResultIntoArray($SQL,'SQL');
		return $get_offer_list;
	}
	/*-------------------------------------------------------- Getting OfferList end-------------------------------------------------------------------*/
	/*-------------------------------------------------------- Getting Scheme Code -------------------------------------------------------------------*/
	function get_schm_code($id) {
		$SQL ="SELECT fr_nav_id FROM mf_nav_recomended where pk_recomend_id='".$id."'";
		//echo $SQL;
		$get_sch_code = $this->db->db_fetch_assoc($this->db->db_run_query($SQL));
		return $get_sch_code;
	}
	function Channel_Partner_Code($pk_nav_id){
		$SQL ="SELECT channel_partner_code FROM mf_master where pk_nav_id='".$pk_nav_id."'";
		$Channel_Partner_Code = $this->db->db_fetch_assoc($this->db->db_run_query($SQL));
		return $Channel_Partner_Code;
	}
	/*--------------------------------------------------- Get puchase NAV data ------------------------------------------------------------------------*/
	function get_sch_nav($sch_code) {
		$SQL ="SELECT purchase_price,amount FROM mf_live_table where pan_no='".$this->CONFIG->UserPan."' AND fr_scheme_code='".$sch_code."' order by purchase_price desc";
		$get_nav = $this->db->db_fetch_assoc($this->db->db_run_query($SQL));
		return $get_nav;
	}
	// Getting abosolute return
	function absolute_return($current_val,$purchase_val) {
		$gain = $current_val -$purchase_val;
		$abst_rtn = ($gain/$purchase_val)*100;	
		//echo "Return:-".$abst_rtn." %";
		return $abst_rtn;
	}
	/*----------------------------------------------------- fetch schema details -----------------------------------------------------------------*/
	function fetch_schema_details($schema_code,$folio_no)
    {
        $SQL = "SELECT purchase_price,unit,purchase_date,tran_type,trnx_id,amount,folio FROM mf_live_table where pan_no='".$this->CONFIG->UserPan."' AND fr_scheme_code='".$schema_code."' AND folio='".$folio_no."' AND duplicate_val='0'";
        //echo "SQL:-".$SQL;
        $tran_history =  $this->commonFunction->mysqlResultIntoArray($SQL,'SQL');
        return $tran_history;
    }
	/*----------------------------------------------------- fetch schema details -----------------------------------------------------------------*/
	function fetch_schema_details_app($schema_code,$folio_no, $pan)
    {
        $SQL = "SELECT purchase_price,unit,purchase_date,tran_type,trnx_id,amount,folio FROM mf_live_table where pan_no='".$pan."' AND fr_scheme_code='".$schema_code."' AND folio='".$folio_no."' AND duplicate_val='0'";
        //echo "SQL:-".$SQL;
        $tran_history =  $this->commonFunction->mysqlResultIntoArray($SQL,'SQL');
        return $tran_history;
    }
	/*------------------------------------------------------------------------------------------------------------------------------------------*/
	function updateNAVMaster() {		
		$sqlNav			= "SELECT * FROM mf_scheme_bse_master WHERE is_updated = 0";
		$navResultSet	= $this->db->db_run_query($sqlNav);
		$insertNavSql	= "INSERT INTO mf_master SET  ";
		$updateNavSql	= "UPDATE mf_master SET  ";

		$val = $this->db->db_fetch_array($navResultSet);
		// echo "<br>";
		// print_r($val);
		while($val = $this->db->db_fetch_array($navResultSet)) { 	//while(list($key,$val) = each($resArr))
			set_time_limit(0);
			$insertNavSql1	= " unique_no = '".$val[Unique_No]."', scheme_code = '".$val[scheme_code]."', rta_scheme_code = '".$val[RTA_scheme_code]."',
							   amc_scheme_code = '".$val[AMC_scheme_code]."', isin = '".$val[ISIN]."', amc_code = '".$val[AMC_Code]."',
							   scheme_type = '".$val[Scheme_Type]."', scheme_plan = '".$val[Scheme_Plan]."', scheme_name = '".addslashes($val[Scheme_Name])."',
							   purchase_allowed = '".$val[Purchase_Allowed]."', purchase_transaction_mode = '".$val[Purchase_Transaction_mode]."', 
							   minimum_purchase_amount = '".$val[Minimum_Purchase_Amount]."',additional_purchase_amount = '".$val[Additional_Purchase_Amount]."', 
							   maximum_purchase_amount = '".$val[Maximum_Purchase_Amount]."', purchase_amount_multiplier = '".$val[Purchase_Amount_Multiplier]."',
							   purchase_cutoff_time = '".$val[Purchase_Cutoff_Time]."', redemption_allowed = '".$val[Redemption_Allowed]."', 
							   redemption_transaction_mode = '".$val[Redemption_Transaction_Mode]."',minimum_redemption_qty = '".$val[Minimum_Redemption_Qty]."', 
							   redemption_qty_multiplier = '".$val[Redemption_Qty_Multiplier]."', maximum_redemption_qty = '".$val[Maximum_Redemption_Qty]."',
							   redemption_amount_minimum = '".$val[Redemption_Amount_Minimum]."', redemption_amount_maximum = '".$val[Redemption_Amount_Maximum]."',
							   redemption_amount_multiple = '".$val[Redemption_Amount_Multiple]."', 
							   redemption_cutoff_time = '".$val[Redemption_Cut_off_Time]."', rta_agent_code = '".$val[RTA_Agent_Code]."',
							   amc_active_flag = '".$val[AMC_Active_Flag]."', dividend_reinvestment_flag = '".$val[Dividend_Reinvestment_Flag]."',
							   sip_flag = '".$val[SIP_FLAG]."',stp_flag = '".$val[STP_FLAG]."',swp_flag = '".$val[SWP_Flag]."',switch_flag = '".$val[Switch_FLAG]."',
							   settlement_type = '".$val[SETTLEMENT_TYPE]."',amc_ind = '".$val[AMC_IND]."',face_value = '".$val[Face_Value]."',
							   start_date = '".$val[Start_Date]."',end_date = '".$val[End_Date]."',exit_load_flag = '".$val[Exit_Load_Flag]."',
							   exit_load = '".$val[Exit_Load]."',lockin_period_flag = '".$val[Lock_in_Period_Flag]."',
							   lockin_period = '".$val[Lock_in_Period]."',channel_partner_code = '".$val[Channel_Partner_Code]."'";
			if($this->db->db_num_rows($this->db->db_run_query("SELECT * FROM mf_master WHERE unique_no = '".$val[Unique_No]."'")) > 0) {
				//	$insertNavSql1	= $updateNavSql.$insertNavSql1." WHERE Unique_No = '".$val[Unique_No]."'";
				echo "Updated<br>";
			} else {
				$insertNavSql1	= $insertNavSql.$insertNavSql1;
				//echo "<br>SQL:-".$insertNavSql1."<br>";
				$this->db->db_run_query($insertNavSql1) or die(mysql_error());	
				$this->db->db_run_query("UPDATE mf_scheme_bse_master SET is_updated = 1 WHERE pk_scheme_id = '".$val[pk_scheme_id]."'");	
				//echo $insertNavSql1."<br><br>";			
			}
			/*	die("hi");*/
			// $this->db->db_run_query($insertNavSql1) or die(mysql_error());	
			// $this->db->db_run_query("UPDATE mf_scheme_bse_master SET is_updated = 1 WHERE pk_scheme_id = '".$val[pk_scheme_id]."'");			
			$insertNavSql1 = '';		//exit;
		}
	}	

	/*--------------------------------------------------------------Fetch all Schemes ------------------------------------------------------------------*/
	function fetch_Scheme_Type($type){
		if($type == "") {
			$wealth_cat_p = array();
	        $wealth_cat_sub = array();
	        $wealth_cat = $this->db->db_run_query('SELECT mf_cat_id,cat_name FROM mf_cat_table where parent_cat_id="0"');
	        //print_r($wealth_cat);
	        while ($row =  $this->db->db_fetch_array($wealth_cat)) {
	            $wealth_cat1 = $this->db->db_run_query('SELECT mf_cat_id,cat_name FROM mf_cat_table where parent_cat_id="'.$row['mf_cat_id'].'"');
	            while ($row1 =  $this->db->db_fetch_array($wealth_cat1)) {
	              array_push($wealth_cat_sub,array($row1['mf_cat_id'],$row1['cat_name']));
	            }
	            $wealth_cat_p[$row['cat_name']][] = $wealth_cat_sub;
	            $wealth_cat_sub = array();
	        }
        } else {
        	$wealth_cat_p = array();
	        $wealth_cat_sub = array();
	        $wealth_cat = $this->db->db_run_query('SELECT mf_cat_id,cat_name FROM mf_cat_table where cat_name="'.$type.'"');
	        //print_r($wealth_cat);
	        while ($row =  $this->db->db_fetch_array($wealth_cat)) {
	            $wealth_cat1 = $this->db->db_run_query('SELECT mf_cat_id,cat_name FROM mf_cat_table where parent_cat_id="'.$row['mf_cat_id'].'"');
	            while ($row1 =  $this->db->db_fetch_array($wealth_cat1)) {
	              array_push($wealth_cat_p,array($row1['mf_cat_id'],$row1['cat_name']));
	            }
	            //$wealth_cat_p[$row['cat_name']][] = $wealth_cat_sub;
	            $wealth_cat_sub = array();
	        }
        }
        return $wealth_cat_p;
	}

	/*--------------------------------------------------------------Fetch all Schemes ------------------------------------------------------------------*/
	function fetch_Scheme_Type_api($type){
		if($type == "") {
			$wealth_cat_p = array();
	        $wealth_cat_sub = array();
	        $wealth_cat = $this->db->db_run_query('SELECT mf_cat_id,cat_name FROM mf_cat_table where parent_cat_id="0"');
	        //print_r($wealth_cat);
	        while ($row =  $this->db->db_fetch_array($wealth_cat)) {
	            $wealth_cat1 = $this->db->db_run_query('SELECT mf_cat_id,cat_name FROM mf_cat_table where parent_cat_id="'.$row['mf_cat_id'].'"');
	            while ($row1 =  $this->db->db_fetch_array($wealth_cat1)) {
					$myObj = null;
					$myObj->id = $row1['mf_cat_id'];
					$myObj->name = $row1['cat_name'];
	              	array_push($wealth_cat_sub,$myObj);
	            }
				$myObj1 = null;
				$myObj1->id = $row['mf_cat_id'];
				$myObj1->value = $wealth_cat_sub;
	            $wealth_cat_p[$row['cat_name']] = $myObj1;
	            $wealth_cat_sub = array();
	        }
        } else {
        	$wealth_cat_p = array();
	        $wealth_cat_sub = array();
	        $wealth_cat = $this->db->db_run_query('SELECT mf_cat_id,cat_name FROM mf_cat_table where cat_name="'.$type.'"');
	        //print_r($wealth_cat);
	        while ($row =  $this->db->db_fetch_array($wealth_cat)) {
	            $wealth_cat1 = $this->db->db_run_query('SELECT mf_cat_id,cat_name FROM mf_cat_table where parent_cat_id="'.$row['mf_cat_id'].'"');
	            while ($row1 =  $this->db->db_fetch_array($wealth_cat1)) {
	              array_push($wealth_cat_p,array($row1['mf_cat_id'],$row1['cat_name']));
	            }
	            //$wealth_cat_p[$row['cat_name']][] = $wealth_cat_sub;
	            $wealth_cat_sub = array();
	        }
        }
        return $wealth_cat_p;
	}

	/*------------------------------------------------------------------- Fetch all AMC ---------------------------------------------------------------*/
	function fetch_AMC_Code($search) {
		//$SQL = 'SELECT AMC_Code FROM mf_master where scheme_plan="NORMAL" and purchase_allowed="Y" group by amc_code';
		//$SQL = 'select distinct(mf_master.amc_code) FROM tax_n_save.mf_master inner join mf_nav_recomended ON(mf_master.pk_nav_id = mf_nav_recomended.fr_nav_id)'; 
		if ($search == "") {
			$SQL = 'SELECT mf_schema_id,amc_name_act FROM mf_schema_name_list order by amc_name_act asc;';
		} else {
			$p = "%";
			$SQL = "SELECT mf_schema_id,amc_name_act FROM mf_schema_name_list where amc_name_act like ('".$p.$search.$p."')  order by amc_name_act asc";
		}
		//$all_amc_code =  $this->db->db_fetch_array($this->db->db_run_query($SQL));
		//echo "SQL".$SQL;
		$returnArray =  $this->commonFunction->mysqlResultIntoArray($SQL,'SQL');
		return $returnArray;
	}
	/*------------------------------------------------------------------- Fetch all Risk --------------------------------------------------------------*/
	function fetch_risk() {
		//$SQL = 'SELECT AMC_Code FROM mf_master where scheme_plan="NORMAL" and purchase_allowed="Y" group by amc_code';
		$SQL = 'select distinct(mf_nav_recomended.sch_risk) FROM mf_master inner join mf_nav_recomended ON(mf_master.pk_nav_id = mf_nav_recomended.fr_nav_id )'; 
		$all_amc_code =  $this->db->db_fetch_array($this->db->db_run_query($SQL));
		$returnArray =  $this->commonFunction->mysqlResultIntoArray($SQL,'SQL');
		return $returnArray;
	}
	/*------------------------------------------------------------------- Fetch all Fund Size ---------------------------------------------------------*/
	function fetch_fund_size() {
		//$SQL = 'SELECT AMC_Code FROM mf_master where scheme_plan="NORMAL" and purchase_allowed="Y" group by amc_code';
		$SQL = 'select distinct(mf_nav_recomended.sch_fund_size) FROM mf_master inner join mf_nav_recomended ON(mf_master.pk_nav_id = mf_nav_recomended.fr_nav_id) order by mf_nav_recomended.sch_fund_size asc'; 
		$all_amc_code =  $this->db->db_fetch_array($this->db->db_run_query($SQL));
		$returnArray =  $this->commonFunction->mysqlResultIntoArray($SQL,'SQL');
		return $returnArray;
	}
	function get_nav($ISIN) {
		$SQL = 'SELECT distinct(price_date),net_asset_value FROM mf_nav_price where ISIN="'.$ISIN.'" order by price_date asc'; 
		$all_amc_code =  $this->db->db_fetch_array($this->db->db_run_query($SQL));
		$returnArray =  $this->commonFunction->mysqlResultIntoArray($SQL,'SQL');
		return $returnArray;
	}

	function get_scheme_data($fetch_sch) {
		$SQL = "select * FROM mf_master where pk_nav_id=".$fetch_sch;
		$returnArray =  $this->commonFunction->mysqlResultIntoArray($SQL,'SQL');
		return $returnArray;
	}
	/*---------------------------------------------------------- Fetch All Schemes Data ---------------------------------------------------------------*/
	function fetch_all_schema($amc_code,$schm_type,$sch_risk,$sch_fund_size,$fetch_sch,$offer=0,$limit=0) {
		$result1 = $this->db->db_run_query("SET sql_mode = ''");
		global $_SESSION; 
		if ($limit==0) {
			$limit = 20;
		} else {
			//$limit =30;
			/*---------------------- for increasing limit -------------------------------*/
			$amc_code      = $_SESSION['amc_code'];
			$schm_type     = $_SESSION['schm_type'];
			$sch_risk      = $_SESSION['sch_risk'];
			$sch_fund_size = $_SESSION['sch_fund_size'];
			$fetch_sch     = $_SESSION['fetch_sch'];
			$offer         = $_SESSION['offer'];
			$limit         = $_SESSION['limit']+$limit;
			// echo "amc_code".$amc_code."<br>";
			// echo "schm_type".$schm_type."<br>";
			// echo "sch_risk".$sch_risk."<br>";
			// echo "sch_fund_size".$sch_fund_size."<br>";
			// echo "$fetch_sch".$fetch_sch."<br>";
			// echo "offer".$offer."<br>";
			//echo "limit".$limit."<br>";

		}
		/*-------------------------------------------------------------------------------------------------------------*/
		$_SESSION['amc_code']      = $amc_code;
		$_SESSION['schm_type']     = $schm_type;
		$_SESSION['sch_risk']      = $sch_risk;
		$_SESSION['sch_fund_size'] = $sch_fund_size;
		$_SESSION['fetch_sch']     = $fetch_sch;
		$_SESSION['offer']         = $offer;
		$_SESSION['limit']         = $limit;
		// echo "SESSION:";
		// print_r($_SESSION);
		/*-------------------------------------------------------------------------------------------------------------*/
		$sql = "Select mm.* from mf_master mm, sch_offers so ";
		$add_whr = 0;
		$odr_asc = " order by so.priority ASC, mm.scheme_name ASC limit 0,".$limit;
		if ($add_whr == "0") {
			$whr = " where ";
			$add_whr=1;
		} elseif ($add_whr == "1") {
			$and = " AND ";
		}
		$growth_sql = $and." mm.scheme_name not like '%DIVIDEND%'";
		if ($amc_code) {
			if ($add_whr == "0") {
				$whr = " where ";
				$add_whr=1;
			} elseif ($add_whr == "1") {
				$and = " AND ";
			}
			$last_val = end($amc_code);
			foreach ($amc_code as $key) {
				$fetch_amc_name = "SELECT msnl.amc_name_bse FROM mf_schema_name_list msnl where msnl.mf_schema_id='".$key."'";
				$fetch_amc_name =  $this->db->db_fetch_assoc($this->db->db_run_query($fetch_amc_name));
				if($key == $last_val) {
					$amc_str .= "'".$fetch_amc_name['amc_name_bse']."'";
				} else {
					$amc_str .= "'".$fetch_amc_name['amc_name_bse']."',";
				}
			}
			$add_amc_sql = $and." AMC_Code IN (".$amc_str.") GROUP BY mm.isin";
		}
		if ($sch_risk) {
			if ($add_whr == "0") {
				$whr = " where ";
				$add_whr=1;
			} elseif ($add_whr == "1") {
				$and = " AND ";
			}
			$sch_risk = implode(",", $sch_risk);
			$add_sch_risk_sql = $and." mm.sch_risk IN (".$sch_risk.")";
		}
		if ($schm_type) {
			$sch_add_sql = "";
			$sch_sub_id = "";
			if ($add_whr == "0") {
				$whr = " where ";
				$add_whr=1;
			} elseif ($add_whr == "1") {
				$and = " AND ";
			}
			foreach ($schm_type as $key) {
				if(is_string($key)) {
					$cat_p_id = $this->db->db_fetch_assoc($this->db->db_run_query('SELECT mct.mf_cat_id FROM mf_cat_table mct where mct.cat_name="'.base64_decode($key).'"'));
					//print_r($cat_p_id);
					$get_sub_id =  $this->db->db_run_query('SELECT mct.mf_cat_id FROM mf_cat_table mct where mct.parent_cat_id="'.$cat_p_id['mf_cat_id'].'"');
					while($row_sub_id = $this->db->db_fetch_assoc($get_sub_id)) {
						$sch_sub_id .= $row_sub_id[mf_cat_id].",";
					}
					$sch_sub_id = rtrim($sch_sub_id,",");//print_r($get_sub_id);
				} else {
					$get_sub_id =  $this->db->db_run_query('SELECT mct.mf_cat_id FROM mf_cat_table mct where mct.parent_cat_id="'.$cat_p_id['mf_cat_id'].'"');
					while($row_sub_id = $this->db->db_fetch_assoc($get_sub_id)) {
						$sch_sub_id1 .= $row_sub_id[mf_cat_id].",";
					}
					$sch_sub_id1 = rtrim($sch_sub_id,",");//print_r($get_sub_id);
				}
			}
			if ($sch_sub_id && $sch_sub_id1) {
				$sch_add_sql =$sch_sub_id.",".$sch_sub_id1;
			} elseif($sch_sub_id) {
				$sch_add_sql =$sch_sub_id;
			} else {	
				$sch_add_sql =$sch_sub_id1;
			}
			$add_schm_type_sql = $and." sch_category IN (".$sch_add_sql.") GROUP BY mm.isin";
			//echo $add_schm_type_sql;
		}
		if ($sch_fund_size) {
			if ($add_whr == "0") {
				$whr = " where ";
				$add_whr=1;
			} elseif ($add_whr == "1")  {
				$and = " AND ";
			}
			$sch_fund_size = implode(",", $sch_fund_size);
			$add_sch_fund_size_sql = $and." mm.sch_fund_size IN (".$sch_fund_size.")";
		}
		if($offer) {
			if ($add_whr == "0") {
				$whr = " where ";
				$add_whr=1;
			} elseif ($add_whr == "1") {
				$and = " AND ";
			}
			$add_offer_sql = $and." so.offer_id='".$offer."' AND so.sch_id=mm.pk_nav_id GROUP BY mm.isin ";
			$odr_asc = " order by so.priority ASC limit 0,".$limit;
			$offer_schemetypes = $this->getNavOffer($offer);
			$scheme_type = $offer_schemetypes[0]['offer_schemetype'];
			//print_r($offer_schemetypes);
			//echo "scheme type : ".$scheme_type."<br>sdfsd";
		}
		$filter_sql = $sql.$whr.$growth_sql.$add_amc_sql.$add_sch_risk_sql.$add_schm_type_sql.$add_sch_fund_size_sql.$add_offer_sql.$odr_asc;
		//$res = $this->db->db_run_query($filter_sql);
		//return $filter_sql;
		//echo "sql : ".$filter_sql;
		if ($fetch_sch) {
			$filter_sql = "select * FROM mf_master where pk_nav_id=".$fetch_sch;
		}
		$returnArray =  $this->commonFunction->mysqlResultIntoArray($filter_sql,'SQL');
		$arrResultLength = count($returnArray);
		$add_whr=0;
		if($limit==20) {
			if($arrResultLength<20) {
				$balLength = 20-$arrResultLength;
				if($offer) {
					if ($add_whr == "0") {
						$whr = " where ";
						$add_whr=1;
					} elseif ($add_whr == "1") {
						$and = " AND ";
					}
					if($scheme_type) {
						$arr = explode(",",$scheme_type);
						if(count($arr)>=1) {
							$i = count($arr);
							foreach ($arr as $value) {
								$sch_all .= "'".$value."'";
								if($i>1) {
									$sch_all .= ",";
								}
								$i--;
							}
							$sch = "mm.scheme_type IN (".$sch_all.") ";
							$add_offer_sql = $and.$sch." GROUP BY mm.isin ";
						} else {
							$add_offer_sql = $and.$sch_all." GROUP BY mm.isin ";
						}
					} else {
						$add_offer_sql = $and;
					}
					$odr_asc = " limit 0,".$balLength;
				}
				$filter_sql1 = $sql.$whr.$growth_sql.$add_amc_sql.$add_sch_risk_sql.$add_schm_type_sql.$add_sch_fund_size_sql.$add_offer_sql.$odr_asc;
				$returnBalArray =  $this->commonFunction->mysqlResultIntoArray($filter_sql1,'SQL');
				//echo " second : ".$filter_sql1;
				$result = array_merge($returnArray,$returnBalArray);
				return $result;
			} else {
				return $returnArray;	
			}
		} else {
			if($offer) {
				if ($add_whr == "0") {
					$whr = " where ";
					$add_whr=1;
				} elseif ($add_whr == "1") {
					$and = " AND ";
				}
				if($scheme_type) {
					$arr = explode(",",$scheme_type);
					if(count($arr)>=1) {
						$i = count($arr);
						foreach ($arr as $value) {
							$sch_all .= "'".$value."'";
							if($i>1) {
								$sch_all .= ",";
							}
							$i--;
						}
						$sch = "mm.scheme_type IN (".$sch_all.") ";
						$add_offer_sql = $and.$sch." GROUP BY mm.isin ";
					} else {
						$add_offer_sql = $and.$sch_all." GROUP BY mm.isin ";
					}
				} else {
					$add_offer_sql = $and;
				}
				$odr_asc = " limit 0,".$limit;
			}
			$filter_sql1 = $sql.$whr.$growth_sql.$add_amc_sql.$add_sch_risk_sql.$add_schm_type_sql.$add_sch_fund_size_sql.$add_offer_sql.$odr_asc;
			$returnBalArray =  $this->commonFunction->mysqlResultIntoArray($filter_sql1,'SQL');
			//echo " third : ".$filter_sql1;
			$result = array_merge($returnArray,$returnBalArray);
			return $result;
		}		
	}

	function fetch_all_schema_app($amc_code,$schm_type,$sch_risk,$sch_fund_size,$fetch_sch,$offer=0,$limit=0) {
		$result1 = $this->db->db_run_query("SET sql_mode = ''");
		global $_SESSION; 
		if ($limit==0) {
			$limit = 20;
		} else {
			//$limit =30;
			/*---------------------- for increasing limit -------------------------------*/
			$amc_code      = $_SESSION['amc_code'];
			$schm_type     = $_SESSION['schm_type'];
			$sch_risk      = $_SESSION['sch_risk'];
			$sch_fund_size = $_SESSION['sch_fund_size'];
			$fetch_sch     = $_SESSION['fetch_sch'];
			$offer         = $_SESSION['offer'];
			$limit         = $_SESSION['limit']+$limit;
			// echo "amc_code".$amc_code."<br>";
			// echo "schm_type".$schm_type."<br>";
			// echo "sch_risk".$sch_risk."<br>";
			// echo "sch_fund_size".$sch_fund_size."<br>";
			// echo "$fetch_sch".$fetch_sch."<br>";
			// echo "offer".$offer."<br>";
			//echo "limit".$limit."<br>";

		}
		/*-------------------------------------------------------------------------------------------------------------*/
		$_SESSION['amc_code']      = $amc_code;
		$_SESSION['schm_type']     = $schm_type;
		$_SESSION['sch_risk']      = $sch_risk;
		$_SESSION['sch_fund_size'] = $sch_fund_size;
		$_SESSION['fetch_sch']     = $fetch_sch;
		$_SESSION['offer']         = $offer;
		$_SESSION['limit']         = $limit;
		// echo "SESSION:";
		// print_r($_SESSION);
		/*-------------------------------------------------------------------------------------------------------------*/
		$sql = "Select mm.pk_nav_id, mm.unique_no, mm.scheme_code, mm.rta_scheme_code, mm.amc_scheme_code,mm.isin, mm.scheme_type, mm.scheme_plan,
		mm.scheme_name from mf_master mm, sch_offers so ";
		$add_whr = 0;
		$odr_asc = " order by so.priority ASC, mm.scheme_name ASC limit 0,".$limit;
		if ($add_whr == "0") {
			$whr = " where ";
			$add_whr=1;
		} elseif ($add_whr == "1") {
			$and = " AND ";
		}
		$growth_sql = $and." mm.scheme_name not like '%DIVIDEND%'";
		if ($amc_code) {
			if ($add_whr == "0") {
				$whr = " where ";
				$add_whr=1;
			} elseif ($add_whr == "1") {
				$and = " AND ";
			}
			$last_val = end($amc_code);
			foreach ($amc_code as $key) {
				$fetch_amc_name = "SELECT msnl.amc_name_bse FROM mf_schema_name_list msnl where msnl.mf_schema_id='".$key."'";
				$fetch_amc_name =  $this->db->db_fetch_assoc($this->db->db_run_query($fetch_amc_name));
				if($key == $last_val) {
					$amc_str .= "'".$fetch_amc_name['amc_name_bse']."'";
				} else {
					$amc_str .= "'".$fetch_amc_name['amc_name_bse']."',";
				}
			}
			$add_amc_sql = $and." AMC_Code IN (".$amc_str.") GROUP BY mm.isin";
		}
		if ($sch_risk) {
			if ($add_whr == "0") {
				$whr = " where ";
				$add_whr=1;
			} elseif ($add_whr == "1") {
				$and = " AND ";
			}
			$sch_risk = implode(",", $sch_risk);
			$add_sch_risk_sql = $and." mm.sch_risk IN (".$sch_risk.")";
		}
		if ($schm_type) {
			$sch_add_sql = "";
			$sch_sub_id = "";
			if ($add_whr == "0") {
				$whr = " where ";
				$add_whr=1;
			} elseif ($add_whr == "1") {
				$and = " AND ";
			}
			foreach ($schm_type as $key) {
				if(is_string($key)) {
					$cat_p_id = $this->db->db_fetch_assoc($this->db->db_run_query('SELECT mct.mf_cat_id FROM mf_cat_table mct where mct.cat_name="'.base64_decode($key).'"'));
					//print_r($cat_p_id);
					$get_sub_id =  $this->db->db_run_query('SELECT mct.mf_cat_id FROM mf_cat_table mct where mct.parent_cat_id="'.$cat_p_id['mf_cat_id'].'"');
					while($row_sub_id = $this->db->db_fetch_assoc($get_sub_id)) {
						$sch_sub_id .= $row_sub_id[mf_cat_id].",";
					}
					$sch_sub_id = rtrim($sch_sub_id,",");//print_r($get_sub_id);
				} else {
					$get_sub_id =  $this->db->db_run_query('SELECT mct.mf_cat_id FROM mf_cat_table mct where mct.parent_cat_id="'.$cat_p_id['mf_cat_id'].'"');
					while($row_sub_id = $this->db->db_fetch_assoc($get_sub_id)) {
						$sch_sub_id1 .= $row_sub_id[mf_cat_id].",";
					}
					$sch_sub_id1 = rtrim($sch_sub_id,",");//print_r($get_sub_id);
				}
			}
			if ($sch_sub_id && $sch_sub_id1) {
				$sch_add_sql =$sch_sub_id.",".$sch_sub_id1;
			} elseif($sch_sub_id) {
				$sch_add_sql =$sch_sub_id;
			} else {	
				$sch_add_sql =$sch_sub_id1;
			}
			$add_schm_type_sql = $and." sch_category IN (".$sch_add_sql.") GROUP BY mm.isin";
			//echo $add_schm_type_sql;
		}
		if ($sch_fund_size) {
			if ($add_whr == "0") {
				$whr = " where ";
				$add_whr=1;
			} elseif ($add_whr == "1")  {
				$and = " AND ";
			}
			$sch_fund_size = implode(",", $sch_fund_size);
			$add_sch_fund_size_sql = $and." mm.sch_fund_size IN (".$sch_fund_size.")";
		}
		if($offer) {
			if ($add_whr == "0") {
				$whr = " where ";
				$add_whr=1;
			} elseif ($add_whr == "1") {
				$and = " AND ";
			}
			$add_offer_sql = $and." so.offer_id='".$offer."' AND so.sch_id=mm.pk_nav_id GROUP BY mm.isin ";
			$odr_asc = " order by so.priority ASC limit 0,".$limit;
			$offer_schemetypes = $this->getNavOffer($offer);
			$scheme_type = $offer_schemetypes[0]['offer_schemetype'];
			//print_r($offer_schemetypes);
			//echo "scheme type : ".$scheme_type."<br>sdfsd";
		}
		$filter_sql = $sql.$whr.$growth_sql.$add_amc_sql.$add_sch_risk_sql.$add_schm_type_sql.$add_sch_fund_size_sql.$add_offer_sql.$odr_asc;
		//$res = $this->db->db_run_query($filter_sql);
		//echo $filter_sql;
		//die();
		//exit;
		//echo "sql : ".$filter_sql;
		if ($fetch_sch) {
			$filter_sql = "select * FROM mf_master where pk_nav_id=".$fetch_sch;
		}
		$returnArray =  $this->commonFunction->mysqlResultIntoArray($filter_sql,'SQL');
		$arrResultLength = count($returnArray);
		$add_whr=0;
		if($limit==20) {
			if($arrResultLength<20) {
				$balLength = 20-$arrResultLength;
				if($offer) {
					if ($add_whr == "0") {
						$whr = " where ";
						$add_whr=1;
					} elseif ($add_whr == "1") {
						$and = " AND ";
					}
					if($scheme_type) {
						$arr = explode(",",$scheme_type);
						if(count($arr)>=1) {
							$i = count($arr);
							foreach ($arr as $value) {
								$sch_all .= "'".$value."'";
								if($i>1) {
									$sch_all .= ",";
								}
								$i--;
							}
							$sch = "mm.scheme_type IN (".$sch_all.") ";
							$add_offer_sql = $and.$sch." GROUP BY mm.isin ";
						} else {
							$add_offer_sql = $and.$sch_all." GROUP BY mm.isin ";
						}
					} else {
						$add_offer_sql = $and;
					}
					$odr_asc = " limit 0,".$balLength;
				}
				$filter_sql1 = $sql.$whr.$growth_sql.$add_amc_sql.$add_sch_risk_sql.$add_schm_type_sql.$add_sch_fund_size_sql.$add_offer_sql.$odr_asc;
				$returnBalArray =  $this->commonFunction->mysqlResultIntoArray($filter_sql1,'SQL');
				//echo " second : ".$filter_sql1;
				$result = array_merge($returnArray,$returnBalArray);
				return $result;
			} else {
				return $returnArray;	
			}
		} else {
			if($offer) {
				if ($add_whr == "0") {
					$whr = " where ";
					$add_whr=1;
				} elseif ($add_whr == "1") {
					$and = " AND ";
				}
				if($scheme_type) {
					$arr = explode(",",$scheme_type);
					if(count($arr)>=1) {
						$i = count($arr);
						foreach ($arr as $value) {
							$sch_all .= "'".$value."'";
							if($i>1) {
								$sch_all .= ",";
							}
							$i--;
						}
						$sch = "mm.scheme_type IN (".$sch_all.") ";
						$add_offer_sql = $and.$sch." GROUP BY mm.isin ";
					} else {
						$add_offer_sql = $and.$sch_all." GROUP BY mm.isin ";
					}
				} else {
					$add_offer_sql = $and;
				}
				$odr_asc = " limit 0,".$limit;
			}
			$filter_sql1 = $sql.$whr.$growth_sql.$add_amc_sql.$add_sch_risk_sql.$add_schm_type_sql.$add_sch_fund_size_sql.$add_offer_sql.$odr_asc;
			$returnBalArray =  $this->commonFunction->mysqlResultIntoArray($filter_sql1,'SQL');
			//echo " third : ".$filter_sql1;
			$result = array_merge($returnArray,$returnBalArray);
			return $filter_sql;
		}		
	}

	function fetch_all_schema_app_test($amc_code,$schm_type,$sch_risk,$sch_fund_size,$fetch_sch,$offer=0,$limit=0) {
		$result1 = $this->db->db_run_query("SET sql_mode = ''");
		global $_SESSION; 
		if ($limit==0) {
			$limit = 20;
		} else {
			//$limit =30;
			/*---------------------- for increasing limit -------------------------------*/
			$amc_code      = $_SESSION['amc_code'];
			$schm_type     = $_SESSION['schm_type'];
			$sch_risk      = $_SESSION['sch_risk'];
			$sch_fund_size = $_SESSION['sch_fund_size'];
			$fetch_sch     = $_SESSION['fetch_sch'];
			$offer         = $_SESSION['offer'];
			$limit         = $_SESSION['limit']+$limit;
			// echo "amc_code".$amc_code."<br>";
			// echo "schm_type".$schm_type."<br>";
			// echo "sch_risk".$sch_risk."<br>";
			// echo "sch_fund_size".$sch_fund_size."<br>";
			// echo "$fetch_sch".$fetch_sch."<br>";
			// echo "offer".$offer."<br>";
			//echo "limit".$limit."<br>";

		}
		/*-------------------------------------------------------------------------------------------------------------*/
		$_SESSION['amc_code']      = $amc_code;
		$_SESSION['schm_type']     = $schm_type;
		$_SESSION['sch_risk']      = $sch_risk;
		$_SESSION['sch_fund_size'] = $sch_fund_size;
		$_SESSION['fetch_sch']     = $fetch_sch;
		$_SESSION['offer']         = $offer;
		$_SESSION['limit']         = $limit;
		// echo "SESSION:";
		// print_r($_SESSION);
		/*-------------------------------------------------------------------------------------------------------------*/
		$sql = "Select mm.* from mf_master mm, sch_offers so ";
		$add_whr = 0;
		$odr_asc = " order by so.priority ASC, mm.scheme_name ASC limit 0,".$limit;
		if ($add_whr == "0") {
			$whr = " where ";
			$add_whr=1;
		} elseif ($add_whr == "1") {
			$and = " AND ";
		}
		$growth_sql = $and." mm.scheme_name not like '%DIVIDEND%'";
		if ($amc_code) {
			if ($add_whr == "0") {
				$whr = " where ";
				$add_whr=1;
			} elseif ($add_whr == "1") {
				$and = " AND ";
			}
			$last_val = end($amc_code);
			foreach ($amc_code as $key) {
				$fetch_amc_name = "SELECT msnl.amc_name_bse FROM mf_schema_name_list msnl where msnl.mf_schema_id='".$key."'";
				$fetch_amc_name =  $this->db->db_fetch_assoc($this->db->db_run_query($fetch_amc_name));
				if($key == $last_val) {
					$amc_str .= "'".$fetch_amc_name['amc_name_bse']."'";
				} else {
					$amc_str .= "'".$fetch_amc_name['amc_name_bse']."',";
				}
			}
			$group = 1;
			$add_amc_sql = $and." AMC_Code IN (".$amc_str.") GROUP BY mm.isin";
		}
		if ($sch_risk) {
			if ($add_whr == "0") {
				$whr = " where ";
				$add_whr=1;
			} elseif ($add_whr == "1") {
				$and = " AND ";
			}
			$sch_risk = implode(",", $sch_risk);
			$add_sch_risk_sql = $and." mm.sch_risk IN (".$sch_risk.")";
		}
		if ($schm_type) {
			$sch_add_sql = "";
			$sch_sub_id = "";
			if ($add_whr == "0") {
				$whr = " where ";
				$add_whr=1;
			} elseif ($add_whr == "1") {
				$and = " AND ";
			}
			$sch_type_arr = array();
			foreach ($schm_type as $key) {
				$data_key = base64_decode($key);
				if(is_numeric($data_key)) {
					if (in_array($data_key, $sch_type_arr)) {
						//echo "found";
					} else {
						$sch_type_arr[]=$data_key;
					}
				} else {
					$sql_type = 'select * from (SELECT mfp.mf_cat_id, mfp.cat_name as p_cat_name, mfc.cat_name as c_cat_name FROM opty_m.mf_cat_table mfp, opty_m.mf_cat_table mfc where mfp.parent_cat_id=mfc.mf_cat_id) t where t.c_cat_name="'.$data_key.'"';
					$get_sub_id =  $this->db->db_run_query($sql_type);
					$checkNum =  $this->db->db_num_rows($get_sub_id);
					if($checkNum>0) {
						while($row_sub_id = $this->db->db_fetch_assoc($get_sub_id)) {
							if (in_array($row_sub_id[mf_cat_id], $sch_type_arr)) {
								  //echo "found";
							} else {
								$sch_type_arr[]=$row_sub_id[mf_cat_id];
							}
						}
					} else {
						$sql_type = 'SELECT * FROM opty_m.mf_cat_table mfp where mfp.cat_name="'.$data_key.'"';
						$get_sub_id =  $this->db->db_run_query($sql_type);
						while($row_sub_id = $this->db->db_fetch_assoc($get_sub_id)) {
							if (in_array($row_sub_id[mf_cat_id], $sch_type_arr)) {
								//echo "found";
							} else {
								$sch_type_arr[]=$row_sub_id[mf_cat_id];
							}
						}
					}
				}
			}
			//echo implode(",",$sch_type_arr);
			if($group==1) {
				$add_schm_type_sql = $and." sch_category IN (".implode(",",$sch_type_arr).")";
			} else {
				$add_schm_type_sql = $and." sch_category IN (".implode(",",$sch_type_arr).") GROUP BY mm.isin";
			}
		}
		if ($sch_fund_size) {
			if ($add_whr == "0") {
				$whr = " where ";
				$add_whr=1;
			} elseif ($add_whr == "1")  {
				$and = " AND ";
			}
			$sch_fund_size = implode(",", $sch_fund_size);
			$add_sch_fund_size_sql = $and." mm.sch_fund_size IN (".$sch_fund_size.")";
		}
		if($offer) {
			if ($add_whr == "0") {
				$whr = " where ";
				$add_whr=1;
			} elseif ($add_whr == "1") {
				$and = " AND ";
			}
			$add_offer_sql = $and." so.offer_id='".$offer."' AND so.sch_id=mm.pk_nav_id GROUP BY mm.isin ";
			$odr_asc = " order by so.priority ASC limit 0,".$limit;
			$offer_schemetypes = $this->getNavOffer($offer);
			$scheme_type = $offer_schemetypes[0]['offer_schemetype'];
			//print_r($offer_schemetypes);
			//echo "scheme type : ".$scheme_type."<br>sdfsd";
		}
		$filter_sql = $sql.$whr.$growth_sql.$add_schm_type_sql.$add_amc_sql.$add_sch_risk_sql.$add_sch_fund_size_sql.$add_offer_sql.$odr_asc;
		//$res = $this->db->db_run_query($filter_sql);
		// echo "sql : ".$filter_sql;
		// die();
		if ($fetch_sch) {
			$filter_sql = "select * FROM mf_master where pk_nav_id=".$fetch_sch;
		}
		$returnArray =  $this->commonFunction->mysqlResultIntoArray($filter_sql,'SQL');
		$arrResultLength = count($returnArray);
		$add_whr=0;
		if($limit==20) {
			//echo "Scheme Type : ".$schm_type;
			if($arrResultLength<20) {
				//echo "sql1 : ".$filter_sql;
				//die();
				$balLength = 20-$arrResultLength;
				if($offer) {
					if ($add_whr == "0") {
						$whr = " where ";
						$add_whr=1;
					} elseif ($add_whr == "1") {
						$and = " AND ";
					}
					if($scheme_type) {
						$arr = explode(",",$scheme_type);
						if(count($arr)>=1) {
							$i = count($arr);
							foreach ($arr as $value) {
								$sch_all .= "'".$value."'";
								if($i>1) {
									$sch_all .= ",";
								}
								$i--;
							}
							$sch = "mm.scheme_type IN (".$sch_all.") ";
							$add_offer_sql = $and.$sch." GROUP BY mm.isin ";
						} else {
							$add_offer_sql = $and.$sch_all." GROUP BY mm.isin ";
						}
					} else {
						$add_offer_sql = $and;
					}
					$odr_asc = " limit 0,".$balLength;
				}
				if ($schm_type) {
					$filter_sql1 = $sql.$whr.$growth_sql.$add_sch_risk_sql.$add_schm_type_sql.$add_sch_fund_size_sql.$add_offer_sql.$odr_asc;
				} else {
					$filter_sql1 = $sql.$whr.$growth_sql.$add_amc_sql.$add_sch_risk_sql.$add_sch_fund_size_sql.$add_offer_sql.$odr_asc;
				}
				//$filter_sql1 = $sql.$whr.$growth_sql.$add_amc_sql.$add_sch_risk_sql.$add_schm_type_sql.$add_sch_fund_size_sql.$add_offer_sql.$odr_asc;
				if ($schm_type) { 
					//echo " second : ".$filter_sql1;
					$result = $returnArray;
				} else {
					//echo " second23 : ".$filter_sql1;
					$returnBalArray =  $this->commonFunction->mysqlResultIntoArray($filter_sql1,'SQL');
					$result = array_merge($returnArray,$returnBalArray);
				}		
				
				//$result = array_merge($returnArray,$returnBalArray);
				return $result;
			} else {
				//echo "sql2 : ".$filter_sql;
				//die();
				return $returnArray;	
			}
		} else {
			//echo "sql123 : ".$filter_sql;
			//die();
			if($offer) {
				if ($add_whr == "0") {
					$whr = " where ";
					$add_whr=1;
				} elseif ($add_whr == "1") {
					$and = " AND ";
				}
				if($scheme_type) {
					$arr = explode(",",$scheme_type);
					if(count($arr)>=1) {
						$i = count($arr);
						foreach ($arr as $value) {
							$sch_all .= "'".$value."'";
							if($i>1) {
								$sch_all .= ",";
							}
							$i--;
						}
						$sch = "mm.scheme_type IN (".$sch_all.") ";
						$add_offer_sql = $and.$sch." GROUP BY mm.isin ";
					} else {
						$add_offer_sql = $and.$sch_all." GROUP BY mm.isin ";
					}
				} else {
					$add_offer_sql = $and;
				}
				$odr_asc = " limit 0,".$limit;
			}
			$filter_sql1 = $sql.$whr.$growth_sql.$add_amc_sql.$add_sch_risk_sql.$add_schm_type_sql.$add_sch_fund_size_sql.$add_offer_sql.$odr_asc;
			$returnBalArray =  $this->commonFunction->mysqlResultIntoArray($filter_sql1,'SQL');
			//echo " third : ".$filter_sql1;
			$result = array_merge($returnArray,$returnBalArray);
			return $filter_sql;
		}		
	}

	function addNavData($res) {
		//echo "ajax : --- ";
		$resultArray = array();
		foreach ($res as $data)  {
			//echo " isin : ".$data[isin];
			$yearData =  "1-3-5";
			$get_per_nav = array();
			$year = explode("-",$yearData);
			foreach ($year as $value) {
				$get_nav = $this->get_per_nav($data['isin'],$value);
				$get_per_nav[$value] = $get_nav;
			}
			$data['nav_price'] = $get_per_nav;
			$resultArray[] = $data;
        }
		return $resultArray;
	}
	/*-------------------------------------------------------------------------------------------------------------------------------------------------*/
	/*----------------------------------------------------------- NAV Calculation-Start ---------------------------------------------------------------------*/
	function nav_cal($start_dt_nav,$end_dt_nav,$time)
	{
		// $a = 17.6488;
		// $b = 18.4263;
		// $time = 3;
		$res = (pow(($end_dt_nav/$start_dt_nav),1/$time)-1)*100;
		//echo "RES:".$res;
		return round($res,2);
	}	
	/*----------------------------------------------------------- NAV Calculation-End ---------------------------------------------------------------------*/
	function sendMapRequest($getPanNum)
	{
		$SQL = "SELECT * FROM mf_pan_attached_list WHERE fr_user_sender_id = '".$this->CONFIG->loggedUserId."' AND recevier_pan_num = '".$getPanNum."'";
		$checkNum =  $this->db->db_num_rows($this->db->db_run_query($SQL));
		if($checkNum == 0)
		{
			$SQL = "SELECT * FROM bfsi_users_details WHERE pan_number = '".$getPanNum."'";
			$checkPAN =  $this->db->db_num_rows($this->db->db_run_query($SQL));
			if($checkPAN == 0)
			{
				return "PAN Number Does Not Exist.";
			}
			else
			{
				$getDetail = $this->commonFunction->getSingleRow("SELECT * FROM  bfsi_users_details WHERE pan_number = '".$getPanNum."' AND fr_user_id != '".
																	$this->CONFIG->loggedUserId."'");
				$getEmail = $this->commonFunction->getSingleRow("SELECT * FROM  bfsi_user WHERE pk_user_id = '".$getDetail[fr_user_id]."'");
				$this->db->db_run_query("INSERT INTO mf_pan_attached_list SET fr_user_sender_id = '".$this->CONFIG->loggedUserId."',
																			  fr_user_recevier_id = '".$getDetail[fr_user_id]."',
																			  recevier_pan_num = '".$getPanNum."'");
				$message = $this->commonFunction->readPHP("../__lib.mailFormats/pan_request.html");
				$message = str_replace("USERNAME",$getDetail['cust_name'],$message);
				$this->commonFunction->send_mail($getEmail['login_id'],"PAN Request On TaxSave.in",$message,true);
				return "Request has been Sent to user.";
			}
		}
		else
			return "Request already sent.";
	}
	function listAllMappedPAN($getAllAttachRequest='',$attachedUser='',$pendingReq='',$panBasedResultSet='')
	{
		if($getAllAttachRequest != '')
		{
			$SQL = "SELECT * FROM mf_pan_attached_list WHERE fr_user_sender_id = '".$this->CONFIG->loggedUserId."' AND (request_status = 'Pending' OR attach_status = 
						'Rejected') ";
		}
		else if($attachedUser != '')
		{
			$SQL = "SELECT * FROM mf_pan_attached_list WHERE fr_user_sender_id = '".$this->CONFIG->loggedUserId."' AND request_status = 'Accepted' ";
		}
		else if($pendingReq != '')
		{
			$SQL = "SELECT * FROM mf_pan_attached_list WHERE fr_user_sender_id = '".$this->CONFIG->loggedUserId."' AND request_status = 'Pending' ";
		}
		else if($panBasedResultSet != '')
		{
			$SQL = "SELECT * FROM mf_pan_attached_list WHERE fr_user_sender_id = '".$this->CONFIG->loggedUserId."' AND pan_no = '' ";
		}
		else
			$SQL = "SELECT * FROM mf_pan_attached_list WHERE fr_user_sender_id = '".$this->CONFIG->loggedUserId."'";
		
		

		$returnArray =  $this->commonFunction->mysqlResultIntoArray($SQL,'SQL');
		return $returnArray;
	}
	function importRTAData($getFilename,$RTAName='')
	{
		$result1 = $this->db->db_run_query("select count(*) count from mf_".strtolower($RTAName));
		$r1 = $this->db->db_fetch_array($result1);
		$count1=(int)$r1['count'];
		$getCSVFile = str_replace("\"","",$getCSVFile);
		$getCSVFile = $this->convertToCSV($getFilename);
		//echo $importSQL = "LOAD DATA INFILE '".$getCSVFile."' INTO TABLE mf_".strtolower($RTAName)." FIELDS TERMINATED BY ',' ENCLOSED BY '\"' IGNORE 1 LINES";
		$importSQL = ' LOAD DATA LOCAL INFILE "'.$getCSVFile.'"
								INTO TABLE mf_'.strtolower($RTAName).'
								FIELDS TERMINATED by \',\' 
								LINES TERMINATED BY \''.$this->CONFIG->newLine.'\' IGNORE 1 LINES;';
		$this->db->db_run_query($importSQL);
		
		

		$result2 = $this->db->db_run_query("select count(*) count from mf_".strtolower($RTAName));
		$r2 = $this->db->db_fetch_array($result2);
		$count2=(int)$r2['count'];
		
		

		$count = $count2-$count1;
		return $count;
	}
	function convertToCSV($getExcelFile)
	{
		$excelFile = $getExcelFile;
		$path_parts = pathinfo($getExcelFile);
		$csvFile = $path_parts['dirname']."/".$path_parts['filename'].".csv";
		
		

		if(strtolower($path_parts['extension']) == 'dbf')
		{
			$dbf2csv = $this->CONFIG->wwwroot.'__lib.apis/__dbf2csv/dbf2csv.py';
			
			

			shell_exec('python "'.$dbf2csv.'" "'.$getExcelFile.'" "'.$csvFile.'"');
			foreach (glob($path_parts['dirname']."/".$path_parts['filename']."*.csv") as $filename) 
			{
 			   $csvFile = $filename;
			}
			return $csvFile;
		}
		
		

		ini_set('max_execution_time', 2000);
		ini_set('memory_limit', '281M'); 
		
		

		require_once $this->CONFIG->wwwroot.'__lib.apis/__excel.Lib/PHPExcel/PHPExcel.php';
		require_once $this->CONFIG->wwwroot.'__lib.apis/__excel.Lib/PHPExcel/PHPExcel/IOFactory.php';
		require_once $this->CONFIG->wwwroot.'__lib.apis/__excel.Lib/PHPExcel/PHPExcel/Writer/CSV.php';						
		
		

		$objPHPExcel = new PHPExcel();
		try 
		{
			$inputFileType = PHPExcel_IOFactory::identify($excelFile);
			$objReader = PHPExcel_IOFactory::createReader($inputFileType);
			$objPHPExcel = $objReader->load($excelFile);
		}
		catch(Exception $e)
		{
			die('Error loading file "'.pathinfo($excelFile,PATHINFO_BASENAME).'": '.$e->getMessage());
		}
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');
		$objWriter->setUseBOM(true);
		$objWriter->save($csvFile);
		return $csvFile;
	}
	function listRTA($whichRTA,$pageVal)
	{
		$returnArray = array();
		$countRTA = $this->totalCountRTA($whichRTA);
		if($countRTA > 0)
		{
			$limit = " LIMIT ".$pageVal.",".$this->CONFIG->paginationPageItem;
			if(strtolower($whichRTA) == $this->CONFIG->RTANames[0])		// CAM
				$SQL = "SELECT folio_no,scheme,inv_name,usercode,purprice,units,amount,traddate,brokcode FROM mf_".strtolower($whichRTA).$limit;	
			if(strtolower($whichRTA) == $this->CONFIG->RTANames[1])		// KARVY
				$SQL = "SELECT FMCODE,FUNDDESC,INVNAME,SMCODE,TD_AMT,TD_UNITS,TD_AMT,TD_TRDT,TD_BRANCH FROM mf_".strtolower($whichRTA).$limit;	
			if(strtolower($whichRTA) == $this->CONFIG->RTANames[2])		// FRANKLIN
				$SQL = "SELECT FOLIO_NO,SCHEME_NA1,INVESTOR_2,CHECK_NO,DIVIDEND_4,UNITS,AMOUNT,CREA_DATE,BROK_COMM FROM mf_".strtolower($whichRTA).$limit;	
			if(strtolower($whichRTA) == $this->CONFIG->RTANames[3])		// SUNDRAM
				$SQL = "SELECT FOLIO_NO,SCHEME,INV_NAME,USERCODE,PURPRICE,UNITS,AMOUNT,TRADDATE,BROKCODE FROM mf_".strtolower($whichRTA).$limit;	

			$returnArray =  $this->commonFunction->mysqlResultIntoArray($SQL,'SQL');
		}
		else
			$returnArray = array("MF_NONE");
		
		

		return $returnArray;
	}
	function totalCountRTA($whichRTA)
	{
		$result1 = $this->db->db_run_query("select count(*) count from mf_".strtolower($whichRTA));
		$r1 = $this->db->db_fetch_array($result1);
		$count1=(int)$r1['count'];
		return $count1;
	}
	function saveOffer($getPostedData)
	{
		$insertSql = "INSERT INTO mf_nav_offer SET offer_name = '".$getPostedData[offer_name]."', offer_date=CURDATE(),offer_nav = '".implode(",",$getPostedData[duallistbox_demo1])."',
						offer_status = '".$getPostedData[offer_status]."'";
		if($getPostedData[offer_id] != '')
			$insertSql .= " WHERE pk_offer_id = '".$getPostedData[offer_id]."'";
		
		

		/*echo "SQL:-";
		print_r($insertSql);*/
		$this->db->db_run_query($insertSql);	
	}
	function getNavOffer($getOfferID) {
		$SQL = "SELECT * FROM mf_nav_offer ";
		if($getOfferID[offer_id] !='')
			$SQL .= " WHERE pk_offer_id = '".$getOfferID."'";
		$navArray =  $this->commonFunction->mysqlResultIntoArray($SQL,'SQL');// or die(mysql_error());	
		return $navArray;				
	}
	function offerListCount($getRequest='')
	{
		$SQL = "SELECT COUNT(*) as count FROM mf_nav_offer ";
		$result1 = $this->db->db_run_query($SQL);	// or die(mysql_error());
		$r1 = $this->db->db_fetch_array($result1);
		$count1=(int)$r1['count'];
		return $count1;
	}
	function offerList($getRequest,$pageLimit='')
	{
		$SQL = "SELECT * FROM mf_nav_offer ";			
		$countSearch = $this->offerListCount($getRequest);					
		
		

		if($countSearch > 0)
		{			
			$navArray =  $this->commonFunction->mysqlResultIntoArray($SQL,'SQL');	
		}
		else
			$navArray = array("MF_NONE");
		
		

		//print_r($folioArray);	
		return $navArray;
	}	
	function deleteOffer($getRequest)
	{
		$result1 = $this->db->db_run_query("DELETE FROM ".$getRequest['tableName']." WHERE pk_offer_id = '".$getRequest['value']."'");
		return;
	}	
	function getMFName()
	{
		$SQL = "SELECT scheme_name,fr_scheme_code FROM mf_live_table GROUP BY scheme_name";
		$returnArray[] =  $this->commonFunction->mysqlResultIntoArray($SQL,'SQL');
	}
	function mfACStmt()
	{
		$result1 = $this->db->db_run_query("SET sql_mode = ''");
		$SQL = "SELECT inv_name,scheme_name,fr_scheme_code,purchase_date,pur_unit,tran_type,amount,unit FROM mf_live_table Where pan_no = '".$this->CONFIG->UserPan."' group by purchase_date  order by purchase_date;";
		/*--------------------------------------------- OLD SQL-START -------------------------------------------------------*/
		//= "SELECT * FROM mf_live_table Where pan_no = '".$this->CONFIG->UserPan."'";
		/*---------------------------------------------- OLD SQL-End -----------------------------------------------------*/

		echo $SQL."<br>";


		//$SQL = "SELECT * FROM mf_live_table WHERE pan_no = ''";
		//$SQL = "SELECT * FROM mf_live_table Where pan_no = '".$this->CONFIG->loggedUserName."'";
		$resultArray =  $this->commonFunction->mysqlResultIntoArray($SQL,'SQL');	

		$acStmtArr = array();
		$acStmtArr1 = array();
		while(list($key,$val) = each($resultArray))

		{
			if(max($val[unit], 0) == 0)
			{
				$add_content = "(Reversal -Cheque Dishonoured/Collection Dishonoured)";
			}
			else
		{
				$add_content = "";	
			}
			$acValues = array(date("d-m-Y", strtotime($val[purchase_date])),$val[tran_type].$add_content,$val[pur_unit],$val[amount],$val[pur_unit],$val[unit],max($val[unit], 0));

			$acStmtArr[$val[inv_name]][$val[scheme_name]][] = $acValues;
		}
		return $acStmtArr;
	}
     
     

      /*--------------------------20190517-Magz-START-------------------------------*/

	function portfolioSummary()  
	{
		$SQL = "SELECT * FROM mf_live_table Where inv_name = '".$this->CONFIG->loggedUserName."'";

      //$SQL = "SELECT * FROM mf_live_table";
		//$SQL = "SELECT * FROM mf_live_table WHERE pan_no = ''";
		//$SQL = "SELECT * FROM mf_live_table WHERE inv_name= 'Magendiran'";

		$resultArray =  $this->commonFunction->mysqlResultIntoArray($SQL,'SQL');	

		$acStmtArr = array();
		$acStmtArr1 = array();
		while(list($key,$val) = each($resultArray))
		{
			if (strpos(strtolower($val[scheme_type]), 'equity') !== false) 
				$schemeCategory = "Equity-MF";
			else
				$schemeCategory = "DEBT-MF";
			
			

			$acValues = array($val[purchase_date],$val[folio],$val[pur_unit],$switchIn,$divReinvAmt,$sold,$switchOut,$bal_unit,$cur_price,$gain,$absRet,$xirr);
			$acStmtArr[$val[inv_name]][$schemeCategory][$val[scheme_name]][] = $acValues;
			$schemeCategory = '';
		}
		return $acStmtArr;
	}
	function navMasterListCount($getRequest='') {
		$search_str = $getRequest[search_str];
		$searchRAWStr='';
		if($getRequest[Scheme_Plan] !='')
			$searchRAWStr = " mf_master.scheme_plan = '".$getRequest[Scheme_Plan]."' AND ";
		if($getRequest[Scheme_Type] !='')
			$searchRAWStr .= " mf_master.scheme_type = '".$getRequest[Scheme_Type]."' AND ";
		if($getRequest[Minimum_Purchase_Amount] !='')
			$searchRAWStr .= " mf_master.minimum_purchase_amount <= '".$getRequest[Minimum_Purchase_Amount]."' OR ";
		if($search_str !='')
			$searchRAWStr .= " (mf_master.isin LIKE '%".$search_str."%' OR mf_master.scheme_name LIKE '%".$search_str."%' ) ";
		$SQL = "SELECT COUNT(*) as count FROM mf_master
       				INNER JOIN mf_nav_price ON (mf_master.pk_nav_id = mf_nav_price.fr_nav_id) ";
		if($searchRAWStr !='')
			$SQL .= " WHERE ".$searchRAWStr;
		//echo "<br>SQL:-".$SQL;							
		$result1 = $this->db->db_run_query($SQL);	// or die(mysql_error());
		$r1 = $this->db->db_fetch_array($result1);
		$count1=(int)$r1['count'];
		//echo "<br>Count:-".$count1;
		return $count1;
	}
	function getAllNAV() {
		$SQL = "SELECT mf_master.pk_nav_id, mf_master.unique_no, mf_master.scheme_name, mf_master.purchase_allowed, mf_nav_price.fr_nav_id, 
				mf_nav_price.price_date, mf_nav_price.net_asset_value,mf_nav_price.sale_price,mf_nav_price.pk_price_id  FROM mf_master
       				INNER JOIN mf_nav_price
          				ON (mf_master.purchase_allowed = 'Y' AND mf_master.pk_nav_id = mf_nav_price.fr_nav_id AND mf_nav_price.net_asset_value != 0) 
						GROUP BY mf_master.scheme_name ORDER BY mf_nav_price.pk_price_id DESC ";
		//echo "SQL:-".$SQL;
		//die();
		$navArray =  $this->commonFunction->mysqlResultIntoArray($SQL,'SQL');// or die(mysql_error());	
		return $navArray;				
	}
	function getNavWithPriceArray() {
		$SQL = "SELECT * FROM mf_master GROUP BY scheme_name";
		$navArray =  $this->commonFunction->mysqlResultIntoArray($SQL,'SQL');	// or die(mysql_error());
		$priceSql = "SELECT * FROM mf_nav_price GROUP BY fr_nav_id ";
		$priceArray =  $this->commonFunction->mysqlResultIntoArray($priceSql,'SQL');	// or die(mysql_error());
		//print_r($priceArray);	exit;
		$navArr = array();
		while(list($navKey,$navVal) = each($navArray))
		{
			$priceSql = "SELECT * FROM mf_nav_price WHERE fr_nav_id = '".$navVal[pk_nav_id]."' ORDER BY pk_price_id  DESC LIMIT 1";
			$result1 = $this->db->db_run_query($priceSql);	// or die(mysql_error());
			if($this->db->db_num_rows($result1) > 0)
			{
				$r1 = $this->db->db_fetch_array($result1);
				$net_asset_value = $r1[net_asset_value];
			}
			else
			{
				$net_asset_value = 0;
			}	
			//print_r($navVal);
			$navVal[net_asset_value] = $net_asset_value;
			//print_r($navVal);		
			$navArr[] = $navVal; 	
		}	
		return $navArr;
	}
	function navMasterList($getRequest,$pageLimit='') {
		if($pageLimit != '')
			$limit = " LIMIT ".$pageLimit.",".$this->CONFIG->paginationPageItem;
		else
			$limit='';
		if($pageLimit == 0)
			$limit = " LIMIT ".$pageLimit.",".$this->CONFIG->paginationPageItem;
		$search_str = $getRequest[search_str];		
		if(!empty($getRequest[order_by]))
			$orderBy = " ORDER BY ".$getRequest[order_by]." ".$getRequest[sorting];
		else
			$orderBy = '';
		$searchRAWStr='';
		if($getRequest[Scheme_Plan] !='')
			$searchRAWStr = " mf_master.scheme_plan = '".$getRequest[Scheme_Plan]."' AND ";
		if($getRequest[Scheme_Type] !='')
			$searchRAWStr .= " mf_master.scheme_type = '".$getRequest[Scheme_Type]."' AND ";
		if($getRequest[Minimum_Purchase_Amount] !='')
			$searchRAWStr .= " mf_master.minimum_purchase_amount <= '".$getRequest[Minimum_Purchase_Amount]."' OR ";
		if($search_str !='')
			$searchRAWStr .= " (mf_master.isin LIKE '%".$search_str."%' OR mf_master.scheme_name LIKE '%".$search_str."%' ) ";
		
		$consql = $this->db->db_run_query("SET sql_mode = ''");
		// $SQL = "SELECT mf_master.*,mf_master.pk_nav_id,mf_nav_price.fr_nav_id,mf_nav_price.price_date,mf_nav_price.net_asset_value,
		//         mf_nav_price.repurchase_price,mf_nav_price.sale_price,mf_nav_price.pk_price_id  FROM mf_master
 	    //      				INNER JOIN mf_nav_price
  		//         				ON (mf_master.isin = mf_nav_price.ISIN) ";
 		
 		$SQL = "SELECT mf_master.*,mf_master.pk_nav_id,mf_nav_price.fr_nav_id,mf_nav_price.price_date,mf_nav_price.net_asset_value,
		        mf_nav_price.repurchase_price,mf_nav_price.sale_price,mf_nav_price.pk_price_id  FROM mf_master INNER JOIN mf_nav_price ON (mf_master.scheme_code = mf_nav_price.fr_scheme_code)";
		
		//echo "SQL:-".$SQL;
		        $grp = " group by mf_master.scheme_code ";

		$add_group =1;
		if($searchRAWStr !='')
			$SQL .= " WHERE ".$searchRAWStr;
			// ADD group

		if($orderBy !='')
			$SQL .= "  ".$orderBy;
			// ADD group
		$SQL .= $grp;
		if($limit !='')
			$SQL .= "  ".$limit;
		//echo "getRequest:-".$SQL;
		//print_r($getRequest);
		$countSearch = $this->navMasterListCount($getRequest);
		//echo $countSearch,$SQL;				
		if($countSearch > 0) {			
			$navArray =  $this->commonFunction->mysqlResultIntoArray($SQL,'SQL');	
		} else {
			$navArray = array("MF_NONE");
		}
		//print_r($folioArray);	
		return $navArray;
	}		
	function getSchemeType() {
		$SQL = 'SELECT scheme_type FROM mf_master where purchase_allowed="Y" GROUP BY scheme_type order By scheme_type asc';
		$schemeTypeArray =  $this->commonFunction->mysqlResultIntoArray($SQL,'SQL');	
		return $schemeTypeArray;
	}
	function getSchemePlan() {
		$SQL = 'SELECT scheme_plan FROM mf_master where purchase_allowed="Y" GROUP BY scheme_plan';
		$schemePlanArray =  $this->commonFunction->mysqlResultIntoArray($SQL,'SQL');	
		return $schemePlanArray;
	}
	function getPurchaseAmount() {
		$SQL = 'SELECT Distinct(minimum_purchase_amount) FROM mf_master where purchase_allowed="Y" AND minimum_purchase_amount> 499 order by minimum_purchase_amount asc';
		$amtArray =  $this->commonFunction->mysqlResultIntoArray($SQL,'SQL');	
		return $amtArray;
	}
	function folioQueryCount($getRequest='') {
		$search_str = $getRequest[search_str];
		if(!empty($this->CONFIG->loggedAdminId)) {
			if($search_str !='')
				$search_str = " WHERE (scheme_name LIKE '%".$search_str."%' OR product_code LIKE '%".$search_str."%' OR folio_no LIKE '%".$search_str."%' OR 
							client_name LIKE '%".$search_str."%' OR pan_no LIKE '%".$search_str."%' OR address1 LIKE '%".$search_str."%')";
			$SQL = "SELECT count(*) count FROM mf_live_investor_folio ".$search_str;				
		}
		else {
			if($search_str !='')
				$search_str = " AND (scheme_name LIKE '%".$search_str."%' OR product_code LIKE '%".$search_str."%' OR folio_no LIKE '%".$search_str."%' OR 
							client_name LIKE '%".$search_str."%' OR pan_no LIKE '%".$search_str."%' OR address1 LIKE '%".$search_str."%')";
			$SQL = "SELECT count(*) count FROM mf_live_investor_folio WHERE pan_no = '' ".$search_str;				
		}
		//echo $SQL;			
		$result1 = $this->db->db_run_query($SQL);	// or die(mysql_error());
		$r1 = $this->db->db_fetch_array($result1);
		$count1=(int)$r1['count'];
		return $count1;
	}
	function folioQuery($getRequest,$pageLimit='') {
		if($pageLimit != '')
			$limit = " LIMIT ".$pageLimit.",".$this->CONFIG->paginationPageItem;
		else
			$limit='';
		if($pageLimit == 0)
			$limit = " LIMIT ".$pageLimit.",".$this->CONFIG->paginationPageItem;
		$countSearch = $this->folioQueryCount($search_str);
		$search_str = $getRequest[search_str];
		if(!empty($getRequest[order_by]))
			$orderBy = " ORDER BY ".$getRequest[order_by]." ".$getRequest[sorting];
		if(!empty($this->CONFIG->loggedAdminId)) {
			if($search_str !='')
				$searchStr = " WHERE (scheme_name LIKE '%".$search_str."%' OR product_code LIKE '%".$search_str."%' OR folio_no LIKE '%".$search_str."%' OR 
							client_name LIKE '%".$search_str."%' OR pan_no LIKE '%".$search_str."%' OR address1 LIKE '%".$search_str."%')";
			$SQL = "SELECT * FROM mf_live_investor_folio  ".$searchStr." ".$orderBy.$limit;
		} else {
			if($search_str !='')
				$searchStr = " AND (scheme_name LIKE '%".$search_str."%' OR product_code LIKE '%".$search_str."%' OR folio_no LIKE '%".$search_str."%' OR 
							client_name LIKE '%".$search_str."%' OR pan_no LIKE '%".$search_str."%' OR address1 LIKE '%".$search_str."%')";
			$SQL = "SELECT * FROM mf_live_investor_folio WHERE pan_no = '' ".$searchStr." ".$orderBy.$limit;
		}	
		//echo $countSearch,$SQL;				
		if($countSearch > 0) {			
			$folioArray =  $this->commonFunction->mysqlResultIntoArray($SQL,'SQL');	
		} else {
			$folioArray = array("MF_NONE");
		}
		//print_r($folioArray);	
		return $folioArray;
	}
	function updateInvestorFolio() {
		ini_set('max_execution_time', 2000);
		ini_set('memory_limit', '281M'); 
		$sql1		= "SELECT * FROM mf_live_investor_folio";
		$resultSet	= $this->db->db_run_query($sql1);
		if($this->db->db_num_rows($resultSet) > 0 ) {
			while($rows = $this->db->db_fetch_array($resultSet)) {	//while(list($key,$val) = each($resArr))
				if($rows['fr_cam_inv_id'] != 0) {
					$sql2 = "SELECT * FROM mf_cam_inv WHERE pk_inv_cam_id = '".$rows['fr_cam_inv_id']."'";
					$checkInCAMMainTable = $this->db->db_num_rows($this->db->db_run_query($sql2));
					if($checkInCAMMainTable == 0) {
						$this->db->db_run_query("DELETE FROM mf_live_investor_folio WHERE pk_mf_inv_id = '".$rows['pk_mf_inv_id']."'");
					}
				} else if($rows['fr_karvy_inv_id'] != 0) {
					$sql21 = "SELECT * FROM mf_karvy_inv WHERE pk_inv_karvy_id = '".$rows['fr_karvy_inv_id']."'";
					$checkInKARVYMainTable = $this->db->db_num_rows($this->db->db_run_query($sql21));
					if($checkInKARVYMainTable == 0) {
						$this->db->db_run_query("DELETE FROM mf_live_investor_folio WHERE pk_mf_inv_id = '".$rows['pk_mf_inv_id']."'");
					}				
				} else if($rows['fr_franklin_inv_id'] != 0) {
					$sql3 = "SELECT * FROM mf_franklin_inv WHERE pk_inv_franklin_id = '".$rows['fr_franklin_inv_id']."'";
					$checkInFRANKLINMainTable = $this->db->db_num_rows($this->db->db_run_query($sql3));
					if($checkInFRANKLINMainTable == 0) {
						$this->db->db_run_query("DELETE FROM mf_live_investor_folio WHERE pk_mf_inv_id = '".$rows['pk_mf_inv_id']."'");
					}				
				} else if($rows['fr_sundram_inv_id'] != 0) {
					$sql4 = "SELECT * FROM mf_sundram_inv WHERE pk_inv_sundram_id = '".$rows['fr_sundram_inv_id']."'";
					$checkInSUNDRAMMainTable = $this->db->db_num_rows($this->db->db_run_query($sql4));
					if($checkInSUNDRAMMainTable == 0) {
						$this->db->db_run_query("DELETE FROM mf_live_investor_folio WHERE pk_mf_inv_id = '".$rows['pk_mf_inv_id']."'");
					}				
				}
			}
		}
		$sql5 			= "SELECT * FROM mf_cam_inv WHERE inv_in_report = 0";
		$resultSetCAM	= $this->db->db_run_query($sql5);
		$insertCAMSql	= "INSERT INTO mf_live_investor_folio VALUES ( ";
		if($this->db->db_num_rows($resultSetCAM) > 0 ) {  
			while($rows = $this->db->db_fetch_array($resultSetCAM))	{ //while(list($key,$val) = each($resArr))
				set_time_limit(0);
				$rows = $this->commonFunction->removeCharFromArray($rows,'#');
				$rows = $this->commonFunction->removeCharFromArray($rows,'"');
				$rows = $this->commonFunction->removeCharFromArray($rows,'\'');
				$camSql = "'', '".$rows['pk_inv_cam_id']."', '', '', '', '".$rows['sch_name']."','".$rows['product']."', 
						  '".$rows['foliochk']."', '".$rows['inv_name']."', '', '".$rows['pan_no']."', '', '".$rows['address1']."','".$rows['address2']."',
						  '".$rows['address3']."',
						  '', '".$rows['joint1_pan']."', '', '".$rows['joint2_pan']."', '".$rows['nom_name']."', '".$rows['nom2_name']."', '".$rows['nom3_name']."',
						  '".$rows['ac_no']."', '".$rows['ac_type']."', '".$rows['bank_name']."', '".$rows['branch']."', '', '', '',
						  '', '',CURRENT_TIMESTAMP)";				
				$this->db->db_run_query($insertCAMSql.$camSql);		// or die(mysql_error());	
				$this->db->db_run_query("UPDATE mf_cam_inv SET inv_in_report = '1' WHERE  pk_inv_cam_id = '".$rows['pk_inv_cam_id']."'");		 				
			}
		}
		$sql6 			= "SELECT * FROM mf_franklin_inv WHERE inv_in_report = 0";
		$resultSetFRANK	= $this->db->db_run_query($sql6);
		$insertFRANKSql	= "INSERT INTO mf_live_investor_folio VALUES ( ";
		if($this->db->db_num_rows($resultSetFRANK) > 0 ) {  
			while($rows = $this->db->db_fetch_array($resultSetFRANK)) {	//while(list($key,$val) = each($resArr))
				set_time_limit(0);
				$rows = $this->commonFunction->removeCharFromArray($rows,'#');
				$rows = $this->commonFunction->removeCharFromArray($rows,'"');
				$rows = $this->commonFunction->removeCharFromArray($rows,'\'');

				$frankSql = "'', '', '', '".$rows['pk_inv_franklin_id']."', '', '".$rows['sch_name']."','".$rows['product']."', 
						  '".$rows['FOLIO_NO']."', '".$rows['INV_NAME']."', '', '".$rows['PANNO1']."', '', '".$rows['ADDRESS1']."','".$rows['ADDRESS2']."',
						  '".$rows['ADDRESS3']."',
						  '', '".$rows['joint1_pan']."', '', '".$rows['joint2_pan']."', '".$rows['NOMINEE1']."', '".$rows['NOMINEE2']."', '".$rows['NOMINEE3']."',
						  '".$rows['ACCNT_NO']."', '".$rows['AC_TYPE']."', '".$rows['BANK_NAME']."', '".$rows['BRANCH']."', '', '', '',
						  '', '',CURRENT_TIMESTAMP)";				
				$this->db->db_run_query($insertFRANKSql.$frankSql) or die(mysql_error());		
				$this->db->db_run_query("UPDATE mf_franklin_inv SET inv_in_report = '1' WHERE  pk_inv_franklin_id = '".$rows['pk_inv_franklin_id']."'");		 				
			}
		}
		$sql7 			= "SELECT * FROM mf_karvy_inv WHERE inv_in_report = 0";
		$resultSetKARVY	= $this->db->db_run_query($sql7);
		$insertKARVYSql	= "INSERT INTO mf_live_investor_folio VALUES ( ";
		if($this->db->db_num_rows($resultSetKARVY) > 0 ) {  
			while($rows = $this->db->db_fetch_array($resultSetKARVY)) {	//while(list($key,$val) = each($resArr))
				set_time_limit(0);
				$rows = $this->commonFunction->removeCharFromArray($rows,'#');
				$rows = $this->commonFunction->removeCharFromArray($rows,'"');
				$rows = $this->commonFunction->removeCharFromArray($rows,'\'');

				$karvySql = "'', '', '".$rows['pk_inv_karvy_id']."', '', '', '".$rows['Fund_Description']."','".$rows['Product_Code']."',  
						  '".$rows['Folio']."', '".$rows['Investor_Name']."', '', '".$rows['PAN_Number']."', '', '".$rows['Address__1']."','".$rows['Address__2']."',
						  '".$rows['Address__3']."',
						  '', '".$rows['PAN2']."', '', '".$rows['PAN3']."', '".$rows['Nominee']."', '".$rows['Nominee2']."', '".$rows['Nominee3']."',
						  '".$rows['BankAccno']."', '".$rows['Account_Type']."', '".$rows['Bank_Name']."', '".$rows['Branch']."', '', '', '',
						  '', '',CURRENT_TIMESTAMP)";				
				$this->db->db_run_query($insertKARVYSql.$karvySql) or die(mysql_error());	
				$this->db->db_run_query("UPDATE mf_karvy_inv SET inv_in_report = '1' WHERE  pk_inv_karvy_id = '".$rows['pk_inv_karvy_id']."'");		 				
			}
		}
		$sql8 			= "SELECT * FROM mf_sundram_inv WHERE inv_in_report = 0";
		$resultSetSUND	= $this->db->db_run_query($sql8);
		$insertSUNDSql	= "INSERT INTO mf_live_investor_folio VALUES ( ";
		if($this->db->db_num_rows($resultSetSUND) > 0 ) {  
			while($rows = $this->db->db_fetch_array($resultSetSUND)) {	//while(list($key,$val) = each($resArr))
				set_time_limit(0);
				$rows = $this->commonFunction->removeCharFromArray($rows,'#');
				$rows = $this->commonFunction->removeCharFromArray($rows,'"');
				$rows = $this->commonFunction->removeCharFromArray($rows,'\'');

				$sundSql = "'', '', '', '', '".$rows['pk_inv_sundram_id']."', '".$rows['SCHEME']."','".$rows['PRODCODE']."',  
						  '".$rows['FOLIO']."', '".$rows['INVNAME']."', '', '".$rows['PAN']."', '', '".$rows['ADDRESS1']."','".$rows['ADDRESS2']."',
						  '".$rows['ADDRESS3']."',
						  '', '".$rows['JOINT1PAN']."', '', '".$rows['JOINT2PAN']."', '".$rows['NOMNAME']."', '".$rows['Nominee2']."', '".$rows['Nominee3']."',
						  '".$rows['BANKACNO']."', '', '".$rows['BANKNAME']."', '".$rows['BANKBRA']."', '', '', '',
						  '', '',CURRENT_TIMESTAMP)";				
				$this->db->db_run_query($insertSUNDSql.$sundSql) or die(mysql_error());	
				$this->db->db_run_query("UPDATE mf_sundram_inv SET inv_in_report = '1' WHERE  pk_inv_sundram_id = '".$rows['pk_inv_sundram_id']."'");		 				
			}
		}
	}
		/*------------------------------------------------------------- Update INV karvy into mf live INV-----------------------------------------------------*/
	function updateinvkarvy(){
		$sql 			= "SELECT * FROM mf_karvy_inv WHERE inv_in_report = 0";
		$resultSetKARVY	= $this->db->db_run_query($sql);
		$insertKARVYSql	= "INSERT INTO mf_live_investor_folio VALUES ( ";
		if($this->db->db_num_rows($resultSetKARVY) > 0 )
		{  
			while($rows = $this->db->db_fetch_array($resultSetKARVY))	//while(list($key,$val) = each($resArr))
			{
				set_time_limit(0);
				$rows = $this->commonFunction->removeCharFromArray($rows,'#');
				$rows = $this->commonFunction->removeCharFromArray($rows,'"');
				$rows = $this->commonFunction->removeCharFromArray($rows,'\'');

				// echo "Row:-";
				// print_r($rows);
				//echo "<br><br>";
				$karvySql = "'', '', '".$rows['pk_inv_karvy_id']."', '', '', '".$rows['FUNDDESC']."','".$rows['PRCODE']."',  
						  '".$rows['Folio']."', '".$rows['INVNAME']."', '', '".$rows['PANGNO']."', '', '".$rows['ADD1']."','".$rows['ADD2']."',
						  '".$rows['ADD3']."',
						  '', '".$rows['PAN2']."', '', '".$rows['PAN3']."', '".$rows['NOMINEE']."', '".$rows['NOMINEE2']."', '".$rows['NOMINEE3']."',
						  '".$rows['BNKACNO']."', '".$rows['BNKACTYPE']."', '".$rows['BNAME']."', '".$rows['BRANCH']."', '', '', '',
						  '', '',CURRENT_TIMESTAMP)";				
				//echo "Karvy SQl:".$karvySql."<br>";
				$this->db->db_run_query($insertKARVYSql.$karvySql) or die(mysql_error());	
				$this->db->db_run_query("UPDATE mf_karvy_inv SET inv_in_report = '1' WHERE  pk_inv_karvy_id = '".$rows['pk_inv_karvy_id']."'");		 				
			}
		}
	}
	/*------------------------------------------------------------- Update INV Franklin into mf live INV-----------------------------------------------------*/
	function updateinvfranklin()
	{
		$sql6 			= "SELECT * FROM mf_franklin_inv WHERE inv_in_report = 0";
		$resultSetFRANK	= $this->db->db_run_query($sql6);
		$insertFRANKSql	= "INSERT INTO mf_live_investor_folio VALUES ( ";
		if($this->db->db_num_rows($resultSetFRANK) > 0 )
		{  
			while($rows = $this->db->db_fetch_array($resultSetFRANK))	//while(list($key,$val) = each($resArr))
			{
				set_time_limit(0);
				$rows = $this->commonFunction->removeCharFromArray($rows,'#');
				$rows = $this->commonFunction->removeCharFromArray($rows,'"');
				$rows = $this->commonFunction->removeCharFromArray($rows,'\'');

				//print_r($rows);
				//echo "<br><br><br>";
				$frankSql = "'', '', '', '".$rows['pk_inv_franklin_id']."', '', '".$rows['sch_name']."','".$rows['product']."', 
						  '".$rows['FOLIO_NO']."', '".$rows['F_NAME']." ".$rows['M_NAME']."', '', '".$rows['PANNO1']."', '', '".$rows['ADDRESS1']."','".$rows['ADDRESS2']."',
						  '".$rows['ADDRESS3']."',
						  '', '".$rows['joint1_pan']."', '', '".$rows['joint2_pan']."', '".$rows['NOMINEE1']."', '".$rows['NOMINEE2']."', '".$rows['NOMINEE3']."',
						  '".$rows['ACCNT_NO']."', '".$rows['AC_TYPE']."', '".$rows['BANK_NAME']."', '".$rows['BRANCH']."', '', '', '',
						  '', '',CURRENT_TIMESTAMP)";			
				//echo "SQL:".$insertFRANKSql.$frankSql."<br><br>";	
				$this->db->db_run_query($insertFRANKSql.$frankSql) or die(mysql_error());		
				//$this->db->db_run_query("UPDATE mf_franklin_inv SET inv_in_report = '1' WHERE  pk_inv_franklin_id = '".$rows['pk_inv_franklin_id']."'");		 				
			}
		}
	}
	/*----------------------------------------------------------------------------------------------------------------------------------------------------------*/	

	function updateinvcams(){
		$sql5 			= "SELECT * FROM mf_cam_inv WHERE inv_in_report = 0";
		$resultSetCAM	= $this->db->db_run_query($sql5);
		$insertCAMSql	= "INSERT INTO mf_live_investor_folio VALUES ( ";
		if($this->db->db_num_rows($resultSetCAM) > 0 )
		{  
			while($rows = $this->db->db_fetch_array($resultSetCAM))	//while(list($key,$val) = each($resArr))
			{
				set_time_limit(0);
				$rows = $this->commonFunction->removeCharFromArray($rows,'#');
				$rows = $this->commonFunction->removeCharFromArray($rows,'"');
				$rows = $this->commonFunction->removeCharFromArray($rows,'\'');

				$camSql = "'', '".$rows['pk_inv_cam_id']."', '', '', '', '".$rows['sch_name']."','".$rows['product']."', 
						  '".$rows['foliochk']."', '".$rows['inv_name']."', '', '".$rows['pan_no']."', '', '".$rows['address1']."','".$rows['address2']."',
						  '".$rows['address3']."',
						  '', '".$rows['joint1_pan']."', '', '".$rows['joint2_pan']."', '".$rows['nom_name']."', '".$rows['nom2_name']."', '".$rows['nom3_name']."',
						  '".$rows['ac_no']."', '".$rows['ac_type']."', '".$rows['bank_name']."', '".$rows['branch']."', '', '', '',
						  '', '',CURRENT_TIMESTAMP)";		
				//echo "<br>CAM SQL:-".$camSql."<br>";		
				$this->db->db_run_query($insertCAMSql.$camSql);		// or die(mysql_error());	
				$this->db->db_run_query("UPDATE mf_cam_inv SET inv_in_report = '1' WHERE  pk_inv_cam_id = '".$rows['pk_inv_cam_id']."'");		 				
				echo "<br>"."UPDATE mf_cam_inv SET inv_in_report = '1' WHERE  pk_inv_cam_id = '".$rows['pk_inv_cam_id']."'"."<br>";
			}
		}
		
	}
	function updateLiveMFTable() {
		// $this->updateKARVYData();
		$this->updateCAMData();
		//$this->updateFRANKLINData();
		//$this->updateSUNDRAMData();
	}
	
	function updateFRANKLINData() {
		$sqlFranklin		= "SELECT SCHEME_CO0,SCHEME_NA1,REGD_DATE,NAV,AMOUNT,UNITS,TRXN_TYPE,FOLIO_NO,DIVIDEND_4,pk_franklin_id,PLAN_TYPE,TRXN_NO,INVESTOR_2,POSTDT_DA3,CREA_DATE,PBANK_NAME,
							   ACCOUNT_16,TRXN_MODE,IT_PAN_NO1,PAN_STATU8 FROM mf_".$this->CONFIG->RTANames[2]." WHERE in_report = '0'";
		//echo "SQL:-".$sqlFranklin."<br>";
		$frankResultSet		= $this->db->db_run_query($sqlFranklin);
		$pan_pattern = '/^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}?$/';
		$count_123 = 1;
		while($val = $this->db->db_fetch_array($frankResultSet)) { 		//while(list($key,$val) = each($resArr))
			set_time_limit(0);
			if (str_replace("\"","",$val[SCHEME_NA1]) == "") {
     			//Nothing to do 
    		} else {
				echo "<br>Count : ".$count_123;
				$count_123++;
				// PAN Insertion
				if($val[IT_PAN_NO1]) {
					$value = $val[IT_PAN_NO1];
					$result = preg_match($pan_pattern, $value);
				} elseif($val[PAN_STATU8]) {
					$value = $val[PAN_STATU8];
					$result = preg_match($pan_pattern, $value);
				} else {
					$pan = "";
				}
				if ($result) {
				    $pan = $value;
				}
				//echo "<br>DATE:-".$tradDate."<br>";
				$check_update = $this->check_live_tbl("mf_".$this->CONFIG->RTANames[2],$val[TRXN_NO],$val[UNITS],$val[AMOUNT],$val[FOLIO_NO]);
				if($check_update > 0) {
					$duplicate_val = 1;
				} else {
					$duplicate_val = 0;
				}
				/*------------------------------------------------------------ Date Format Change Start ---------------------------------------------------------------------*/
				$val[REGD_DATE]  = date_format(date_create($val[REGD_DATE]),"Y-m-d"); 
				$val[POSTDT_DA3] = date_format(date_create($val[POSTDT_DA3]),"Y-m-d");
				$val[CREA_DATE]  = date_format(date_create($val[CREA_DATE]),"Y-m-d");
				/*------------------------------------------------------------ Date Format Change End ----------------------------------------------------------------------*/
				$franklin_sql = "INSERT INTO mf_live_table SET fr_scheme_code='".str_replace("\"","",$val[SCHEME_CO0])."',scheme_name='".str_replace("\"","",str_replace("'","",$val[SCHEME_NA1]))."',purchase_date='".str_replace("\"","",str_replace("'","",$val[REGD_DATE]))."',purchase_price='".floatval(str_replace("\"","",$val[NAV]))."',amount='".str_replace("\"","",$val[AMOUNT])."',unit='".$val[UNITS]."',tran_type='".str_replace("\"","",$val[TRXN_TYPE])."',folio='".str_replace("\"","",$val[FOLIO_NO])."',dividend='".str_replace("\"","",$val[DIVIDEND_4])."',pan_no='".$pan."',fr_franklin_id='".$val[pk_franklin_id]."',scheme_type='".str_replace("\"","",$val[PLAN_TYPE])."',inv_name='".str_replace("\"","",$val[INVESTOR_2])."',transaction_date='".str_replace("\"","",$val[POSTDT_DA3])."',start_date='".str_replace("\"","",$val[CREA_DATE])."',bank_name='".str_replace("\"","",$val[PBANK_NAME])."',ac_no='".str_replace("\"","",$val[ACCOUNT_16])."',trnx_id='".str_replace("\"","",$val[TRXN_NO])."',trans_mode='".str_replace("\"","",$val[TRXN_MODE])."',duplicate_val=".$duplicate_val;
				echo "<br>franklin_sql".$franklin_sql."<br>";
				$this->db->db_run_query($franklin_sql) or die(mysql_error());
				//$insertCamSql1 = '';
				$this->db->db_run_query("UPDATE mf_".$this->CONFIG->RTANames[2]." SET in_report ='1' WHERE pk_franklin_id=".$val[pk_franklin_id]);
				echo "<br>UPDATE mf_".$this->CONFIG->RTANames[2]." SET in_report ='1' WHERE pk_franklin_id=".$val[pk_franklin_id];
				echo "<br>";

			}
		}		

		return;
	}
	function updateKARVYData() {
		//echo "karvy data";
		// $check_update = $this->check_live_tbl("mf_".$this->CONFIG->RTANames[1]);
		// if($check_update > 0)
		// {
		// 	$duplicate_val = 1;
		// }
		// else
		// {
		// 	$duplicate_val = 0;
		// }

		$sqlKarvy = "SELECT pk_karvy_id,TD_PURRED,TD_TRDT,FUNDDESC,FMCODE,TD_POP,TD_UNITS,TD_AMT,TD_UNITS,TRDESC,UNQNO,TD_ACNO,PAN1,SCHPLN,INVNAME,ASSETTYPE,CRDATE,PORTDT,TRNMODE FROM mf_".$this->CONFIG->RTANames[1]." WHERE in_report ='0'";
		$karvyResultSet		= $this->db->db_run_query($sqlKarvy);
		//print_r($karvyResultSet);
		//die();
		while($val = $this->db->db_fetch_assoc($karvyResultSet)) {
			set_time_limit(0);
			if (str_replace("\"","",$val[FUNDDESC]) == "") {
     			//Nothing to do 
    		}
			else {
				// $check_update = $this->check_live_tbl($val);
				// die();
				$check_update = $this->check_live_tbl("mf_".$this->CONFIG->RTANames[1],$val[UNQNO],$val[TD_UNITS],$val[TD_AMT],$val[TD_ACNO]);
				//echo "Check Update:-".$check_update."<br>";
				if($check_update > 0) {
					$duplicate_val = 1;
				}
				else {
					$duplicate_val = 0;
				}
				//echo "<br>duplicate_val:-".$duplicate_val."<br>";
				/*--------------------------------------------------------- Date Format start ----------------------------------------------------------------------------*/
				$val[CRDATE]  = date_format(date_create($val[CRDATE]),"Y-m-d");
				$val[PORTDT]  = date_format(date_create($val[PORTDT]),"Y-m-d");
				$val[TD_TRDT] = date_format(date_create($val[TD_TRDT]),"Y-m-d");
				/*--------------------------------------------------------- Date Format end ----------------------------------------------------------------------------*/
				$karvy_SQL = "INSERT INTO mf_live_table SET fr_scheme_code='".str_replace("\"","",$val[FMCODE])."',scheme_name='".str_replace("\"","",str_replace("'","",$val[FUNDDESC]))."',purchase_date='".str_replace("\"","",str_replace("'","",$val[TD_TRDT]))."',purchase_price='".str_replace("\"","",str_replace("'","",$val[TD_POP]))."',amount='".str_replace("\"","",$val[TD_AMT])."',unit='".str_replace("\"","",$val[TD_UNITS])."',tran_type='".str_replace("\"","",$val[TD_PURRED])."',folio='".str_replace("\"","",$val[TD_ACNO])."',pan_no='".str_replace("\"","",$val[PAN1])."',asset_type='".str_replace("\"","",$val[ASSETTYPE])."',fr_karvy_id='".$val[pk_karvy_id]."',scheme_type='".
									str_replace("\"","",$val[SCHPLN])."',inv_name='".str_replace("\"","",$val[INVNAME])."',transaction_date='".str_replace("\"","",$val[PORTDT])."',start_date='".str_replace("\"","",$val[CRDATE])."',trnx_id='".str_replace("\"","",$val[UNQNO])."',trans_mode='".str_replace("\"","",$val[TRNMODE])."',duplicate_val=".$duplicate_val;
				echo "<br><br><br>".$karvy_SQL."<br><br><br>";
				$this->db->db_run_query($karvy_SQL) or die(mysql_error());
				$insertCamSql1 = '';
				$this->db->db_run_query("UPDATE mf_".$this->CONFIG->RTANames[1]." SET in_report ='1' WHERE pk_karvy_id=".$val[pk_karvy_id]);
				echo "<br><br>";
				echo "UPDATE mf_".$this->CONFIG->RTANames[1]." SET in_report ='1' WHERE pk_karvy_id=".$val[pk_karvy_id];
				echo "<br><br>";
			}
		}
		//return $sqlKarvy;
	}
	function updateCAMData() {
		$camsqlCam= "SELECT prodcode,traddate,scheme,purprice,amount,units,trxntype,pan,pk_cam_id,scheme_type,inv_name,trxnno,folio_no,scheme_type,rep_date,postdate,bank_name,ac_no,trxnmode FROM mf_".$this->CONFIG->RTANames[0]." WHERE in_report ='0'";
		//echo "SQL:-".$camsqlCam;
		$resultSet 		= $this->db->db_run_query($camsqlCam);
		$count_123 = 1;
		while($val = $this->db->db_fetch_array($resultSet)) {
			set_time_limit(0);
			if (str_replace("\"","",$val[prodcode]) == "") {
     			// Nothing to do
    		} else {	
				echo "<br>Count : ".$count_123;
				$count_123++;				
				$check_update = $this->check_live_tbl("mf_".$this->CONFIG->RTANames[0],$val[trxnno],$val[units],$val[amount],$val[folio_no]);
				echo "Check Update:-".$check_update."<br>";
				if($check_update > 0) {
					$duplicate_val = 1;
				} else {
					$duplicate_val = 0;
				}
				/*------------------------------------------------------ Date Format Start ---------------------------------------------------------------*/
				$val[rep_date] = date_format(date_create($val[rep_date]),"Y-m-d");
				$val[traddate] = date_format(date_create($val[traddate]),"Y-m-d");
				$val[postdate] = date_format(date_create($val[postdate]),"Y-m-d");
				/*------------------------------------------------------ Date Format End ---------------------------------------------------------------*/
				$insert_mf_live_q =  "INSERT INTO mf_live_table SET fr_scheme_code='".str_replace("\"","",$val[prodcode])."',scheme_name='".str_replace("\"","",str_replace("'","",$val[scheme]))."',purchase_date='".str_replace("\"","",str_replace("'","",$val[traddate]))."', purchase_price='".str_replace("\"","",$val[purprice])."',amount='".str_replace("\"","",$val[amount])."',unit='".$val[units]."',tran_type='".str_replace("\"","",$val[trxntype])."',folio='".str_replace("\"","",$val[folio_no])."',dividend='',pan_no='".str_replace("\"","",$val[pan])."',asset_type='".str_replace("\"","",$val[scheme_type])."',fr_cam_id='".$val[pk_cam_id]."',scheme_type='".str_replace("\"","",$val[scheme_type])."',inv_name='".str_replace("\"","",$val[inv_name])."',transaction_date='".str_replace("\"","",$val[rep_date])."',start_date='".str_replace("\"","",$val[postdate])."',bank_name='".str_replace("\"","",$val[bank_name])."',ac_no='".str_replace("\"","",$val[ac_no])."',trans_mode='".str_replace("\"","",$val[trxnmode])."',trnx_id='".str_replace("\"","",$val[trxnno])."',duplicate_val=".$duplicate_val;
				echo "<br><br><br>".$insert_mf_live_q."<br><br><br>";
				$this->db->db_run_query($insert_mf_live_q) or die(mysql_error());
				$this->db->db_run_query("UPDATE mf_".$this->CONFIG->RTANames[0]." SET in_report ='1' WHERE pk_cam_id=".$val[pk_cam_id]);
				echo "<br><br><br><br>";
				echo "UPDATE mf_".$this->CONFIG->RTANames[0]." SET in_report ='1' WHERE pk_cam_id=".$val[pk_cam_id];
				echo "<br><br><br><br>";
			}
		}
	}
	/*---------------------------------------------- for checking mf_live_table is already update or not -------------------------------------------------------*/

	function check_live_tbl($field,$trxn_id,$unit,$amount,$folio) {
		//echo "Field:-".$field;
		if($field == 'mf_franklin') {
			$field = 'fr_franklin_id'; 
			//$field1 = 'TRXN_NO'; 
		} elseif($field == 'mf_karvy') {
			$field = 'fr_karvy_id'; 
			//$field1 = 'UNQNO'; 
		}elseif($field == 'mf_cam') {
			$field = 'fr_cam_id'; 
			//$field1 = 'trxnno'; 
		}
		// echo "<br>Field1:".$field1;
		// $date = date("Y-N-d");
		$run_sql = $this->db->db_num_rows($this->db->db_run_query("SELECT * FROM mf_live_table where '".$field."' is not Null AND unit='".$unit."' AND amount='".$amount."' AND folio='".$folio."' AND trnx_id='".$trxn_id."'"));
		echo "SELECT * FROM mf_live_table where '".$field."' is not Null AND unit='".$unit."' AND amount='".$amount."' AND folio='".$folio."' AND trnx_id='".$trxn_id."'<br>";
		//echo "SELECT * FROM mf_live_table where ".$field."!='' AND purchase_date='".$date."'";
		echo "COUNT:-".$run_sql."<br>";
		return $run_sql;
	}

	function singleFieldAutocomplete($searchString,$field) {
		$returnArray = array();
		if($field == "scheme") {
			$SQL = "SELECT scheme FROM mf_cam WHERE scheme LIKE '%".$searchString."%' GROUP BY scheme";
			$returnArray[] =  $this->commonFunction->mysqlResultIntoArray($SQL,'SQL');
			$SQL = "SELECT FUNDDESC FROM mf_karvy WHERE FUNDDESC LIKE '%".$searchString."%' GROUP BY FUNDDESC";
			$returnArray[] =  $this->commonFunction->mysqlResultIntoArray($SQL,'SQL');
			$SQL = "SELECT SCHEME_NA1 FROM mf_franklin WHERE SCHEME_NA1 LIKE '%".$searchString."%' GROUP BY SCHEME_NA1";
			$returnArray[] =  $this->commonFunction->mysqlResultIntoArray($SQL,'SQL');
			$SQL = "SELECT SCHEME FROM mf_sundram WHERE SCHEME LIKE '%".$searchString."%' GROUP BY SCHEME";
			$returnArray[] =  $this->commonFunction->mysqlResultIntoArray($SQL,'SQL');
		}
		if($field == "inv_name") {
			$SQL = "SELECT inv_name FROM mf_cam WHERE inv_name LIKE '%".$searchString."%' GROUP BY inv_name";
			$returnArray[] =  $this->commonFunction->mysqlResultIntoArray($SQL,'SQL');
			$SQL = "SELECT INVNAME FROM mf_karvy WHERE INVNAME LIKE '%".$searchString."%' GROUP BY INVNAME";
			$returnArray[] =  $this->commonFunction->mysqlResultIntoArray($SQL,'SQL');
			$SQL = "SELECT INVESTOR_2 FROM mf_franklin WHERE INVESTOR_2 LIKE '%".$searchString."%' GROUP BY INVESTOR_2";
			$returnArray[] =  $this->commonFunction->mysqlResultIntoArray($SQL,'SQL');
			$SQL = "SELECT INV_NAME FROM mf_sundram WHERE INV_NAME LIKE '%".$searchString."%' GROUP BY INV_NAME";
			$returnArray[] =  $this->commonFunction->mysqlResultIntoArray($SQL,'SQL');
		}
		if($field == "brok_code") {
			$SQL = "SELECT brokcode FROM mf_cam WHERE brokcode LIKE '%".$searchString."%' GROUP BY brokcode";
			$returnArray[] =  $this->commonFunction->mysqlResultIntoArray($SQL,'SQL');
			$SQL = "SELECT TD_BRANCH FROM mf_karvy WHERE TD_BRANCH LIKE '%".$searchString."%' GROUP BY TD_BRANCH";
			$returnArray[] =  $this->commonFunction->mysqlResultIntoArray($SQL,'SQL');
			$SQL = "SELECT BROK_COMM FROM mf_franklin WHERE BROK_COMM LIKE '%".$searchString."%' GROUP BY BROK_COMM";
			$returnArray[] =  $this->commonFunction->mysqlResultIntoArray($SQL,'SQL');
			$SQL = "SELECT BROKCODE FROM mf_sundram WHERE BROKCODE LIKE '%".$searchString."%' GROUP BY BROKCODE";
			$returnArray[] =  $this->commonFunction->mysqlResultIntoArray($SQL,'SQL');
		}
		return $returnArray;
	}
	
	function searchMFLayerOneDB($getSearchString,$pageVal)
	{
		$returnArray = array();
		$sDate		= $getSearchString['start'];
		$eDate		= $getSearchString['end'];
		$scheme		= $getSearchString['scheme'];
		$inv_name	= $getSearchString['inv_name'];
		$brok_code	= $getSearchString['brok_code'];
		
		

		$whereCam		= "";
		$whereKarvy		= "";
		$whereFranklin	= "";
		$whereSundram	= "";
		
		

		if($scheme != '')
		{
			$whereCam		.= "  scheme LIKE '%".$scheme."%' OR ";
			$whereKarvy		.= "  FUNDDESC LIKE '%".$scheme."%' OR ";
			$whereFranklin	.= "  SCHEME_NA1 LIKE '%".$scheme."%' OR ";
			$whereSundram	.= "  SCHEME LIKE '%".$scheme."%' OR ";
		}
		if($inv_name != '')
		{
			$whereCam		.= "  inv_name LIKE '%".$inv_name."%' OR ";
			$whereKarvy		.= "  INVNAME LIKE '%".$inv_name."%' OR ";
			$whereFranklin	.= "  INVESTOR_2 LIKE '%".$inv_name."%' OR ";
			$whereSundram	.= "  INV_NAME LIKE '%".$inv_name."%' OR ";
		}
		if($brok_code != '')
		{
			$whereCam		.= "  brokcode LIKE '%".$brok_code."%' OR ";
			$whereKarvy		.= "  TD_BRANCH LIKE '%".$brok_code."%' OR ";
			$whereFranklin	.= "  BROK_COMM LIKE '%".$brok_code."%' OR ";
			$whereSundram	.= "  BROKCODE LIKE '%".$brok_code."%' OR ";
		}
		
		

		if($sDate != '' && $eDate != '')
		{
			$whereCam		.= "  str_to_date(traddate,'%d/%m/%Y') BETWEEN str_to_date('".$sDate."','%d/%m/%Y') AND str_to_date('".$eDate."','%d/%m/%Y') OR ";
			$whereKarvy		.= "  str_to_date(TD_TRDT,'%d/%m/%Y') BETWEEN str_to_date('".$sDate."','%d/%m/%Y') AND str_to_date('".$eDate."','%d/%m/%Y') OR ";
			$whereFranklin	.= "  str_to_date(CREA_DATE,'%d/%m/%Y') BETWEEN str_to_date('".$sDate."','%d/%m/%Y') AND str_to_date('".$eDate."','%d/%m/%Y') OR ";
			$whereSundram	.= "  str_to_date(TRADDATE,'%d/%m/%Y') BETWEEN str_to_date('".$sDate."','%d/%m/%Y') AND str_to_date('".$eDate."','%d/%m/%Y') OR ";
		}
		else if($sDate != '' && $eDate == '')
		{
			$whereCam		.= "  str_to_date(traddate,'%d/%m/%Y') >= '".$sDate."' OR ";
			$whereKarvy		.= "  str_to_date(TD_TRDT,'%d/%m/%Y') >= '".$sDate."' OR ";
			$whereFranklin	.= "  str_to_date(CREA_DATE,'%d/%m/%Y') >= '".$sDate."' OR ";
			$whereSundram	.= "  str_to_date(TRADDATE,'%d/%m/%Y') >= '".$sDate."' OR ";
		}
		else if($sDate == '' && $eDate != '')
		{
			$whereCam		.= "  str_to_date(traddate,'%d/%m/%Y') <= '".$eDate."' OR ";
			$whereKarvy		.= "  str_to_date(TD_TRDT,'%d/%m/%Y') <= '".$eDate."' OR ";
			$whereFranklin	.= "  str_to_date(CREA_DATE,'%d/%m/%Y') <= '".$eDate."' OR ";
			$whereSundram	.= "  str_to_date(TRADDATE,'%d/%m/%Y') <= '".$eDate."' OR ";
		}
		
		

		$whereCam		= " WHERE ".substr($whereCam,0,-3);
		$whereKarvy		= " WHERE ".substr($whereKarvy,0,-3);
		$whereFranklin	= " WHERE ".substr($whereFranklin,0,-3);
		$whereSundram	= " WHERE ".substr($whereSundram,0,-3);
		
		

		$limit = " LIMIT ".$pageVal.",".$this->CONFIG->paginationPageItem;

		$SQL = "SELECT folio_no,scheme,inv_name,usercode,purprice,units,amount,traddate,brokcode FROM mf_".$this->CONFIG->RTANames[0].$whereCam.$limit;	
		$returnArray =  $this->commonFunction->mysqlResultIntoArray($SQL,'SQL');
		
		

		$SQL = "SELECT FMCODE,FUNDDESC,INVNAME,SMCODE,TD_AMT,TD_UNITS,TD_AMT,TD_TRDT,TD_BRANCH FROM mf_".$this->CONFIG->RTANames[1].$whereKarvy.$limit;	
		$returnArray =  array_merge($returnArray,$this->commonFunction->mysqlResultIntoArray($SQL,'SQL'));
		
		

		$SQL = "SELECT FOLIO_NO,SCHEME_NA1,INVESTOR_2,CHECK_NO,DIVIDEND_4,UNITS,AMOUNT,CREA_DATE,BROK_COMM FROM mf_".$this->CONFIG->RTANames[2].$whereFranklin.$limit;	
		$returnArray =  array_merge($returnArray,$this->commonFunction->mysqlResultIntoArray($SQL,'SQL'));
		
		

		$SQL = "SELECT FOLIO_NO,SCHEME,INV_NAME,USERCODE,PURPRICE,UNITS,AMOUNT,TRADDATE,BROKCODE FROM mf_".$this->CONFIG->RTANames[3].$whereSundram.$limit;	
		$returnArray =  array_merge($returnArray,$this->commonFunction->mysqlResultIntoArray($SQL,'SQL'));
			
		

		

		if(count($returnArray) > 0)
		{
			$returnArray = array(count($returnArray),$returnArray);
		}
		else
			$returnArray = array("MF_NONE");
		
		

		return $returnArray;
	}
}

?>