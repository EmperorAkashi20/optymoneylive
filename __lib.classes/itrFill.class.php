
<?php
/* 20190527-BSEN-update-SQL-START: Updating SQL for Fetching data(Pan, XMl data) from bfsi_user Table */

class itrFill
{
    public function itrFill()
    {
        global $CONFIG,$commonFunction,$customerProfile,$permissionSettings;
        global $db;
        $this->db = $db;
        $this->dbName = $CONFIG->dbName;
        $this->commonFunction = $commonFunction;
        $this->CONFIG = $CONFIG;
        $this->customerProfile = $customerProfile;
        $this->websiteContent = array();
    }

    public function startSession($REQUEST)
    {
        global $_SESSION;
        $assYear = $REQUEST['ay'].'-'.(1 + $REQUEST['ay']);

        //$REQUEST['pan'];//$_SESSION['user_pan_number'];//
        $this->addEfilling($assYear);
        
        $_SESSION[$this->CONFIG->sessionPrefix.'_AY'] = $REQUEST[ay];
        $_SESSION[$this->CONFIG->sessionPrefix.'_AY_TEXT'] = $assYear;

        $this->CONFIG->currentAY = $REQUEST[ay];

        return $_SESSION;
    }


    public function checkPending($REQUEST)
    {
        global $_SESSION;	//print_r($REQUEST);
        $assYear = $REQUEST['ay'].'-'.(1 + $REQUEST['ay']);	//$this->CONFIG->currentAYTEXT;
        $SQL = "SELECT * FROM bfsi_itr WHERE fr_user_id = '".$this->CONFIG->loggedUserId."' AND asses_year = '".$assYear."'";
        $countITR = $this->commonFunction->getRecordCount($SQL);
        if ($countITR == 0) {
            $this->addEfilling($assYear);
        } else {
            $setCurrentITR = $this->commonFunction->getSingleRow($SQL);
            $_SESSION[$this->CONFIG->sessionPrefix.'_ITR_ID'] = $setCurrentITR['pk_itr_id'];
        }
        $_SESSION[$this->CONFIG->sessionPrefix.'_AY'] = $REQUEST[ay];
        $_SESSION[$this->CONFIG->sessionPrefix.'_AY_TEXT'] = $assYear;
        $this->CONFIG->currentAY = $REQUEST[ay];

        return $_SESSION;
    }

    public function addEfilling($getAssYear)
    {
        global $_SESSION,$documentFiles;
        $pan = $_SESSION['pan'];
        $insertSql = "INSERT INTO  bfsi_itr SET fr_user_id = '".$this->CONFIG->loggedUserId."', fr_customer_id='".$this->CONFIG->customerId."', 
					  asses_year='".$getAssYear."', itr_status='0'";
        $this->db->db_run_query($insertSql);
        $itrID = $this->db->db_insert_id();
        $_SESSION[$this->CONFIG->sessionPrefix.'_ITR_ID'] = $itrID;

        if ($_SESSION[$this->CONFIG->sessionPrefix.'new_user_upload'] != '') {
            //print_r($_SESSION);
            $getRows = $this->commonFunction->getSingleRow("SELECT * FROM bfsi_uploads WHERE pk_upload_id = '".$_SESSION[$this->CONFIG->sessionPrefix.'new_user_upload']."'");
            $SQL = "UPDATE bfsi_uploads SET fr_user_id = '".$this->CONFIG->loggedUserId."',fr_customer_id = '".$this->CONFIG->customerId."',
					fr_itr_id = '".$itrID."',asses_year = '".$getAssYear."' WHERE pk_upload_id = '".$_SESSION[$this->CONFIG->sessionPrefix.'new_user_upload']."'";
            $this->db->db_run_query($SQL);
            $SQL = "INSERT INTO bfsi_form_16_a SET fr_upload_doc_id ='".$_SESSION[$this->CONFIG->sessionPrefix.'new_user_upload']."',
					fr_user_id = '".$this->CONFIG->loggedUserId."',fr_asses_year = '".$getAssYear."', fr_itr_id = '".$itrID."', form_created_date = now()";
            $this->db->db_run_query($SQL);
            /*-------------------------------------------*/
            $form16_id = $this->db->db_insert_id();
            $_SESSION['form16_id'] = $form16_id;
            /*-------------------------------------------*/
            $documentFiles->txtToForm16DB($getRows[document_text], $getRows[pk_upload_id]);
        //exit;
        } else {
            $SQL = "INSERT INTO bfsi_uploads SET fr_user_id = '".$this->CONFIG->loggedUserId."',fr_customer_id = '".$this->CONFIG->customerId."',
					fr_itr_id = '".$itrID."',asses_year = '".$getAssYear."'";
            $this->db->db_run_query($SQL);
            $docID = $this->db->db_insert_id();
            $SQL = "INSERT INTO bfsi_form_16_a SET fr_upload_doc_id ='".$docID."',fr_user_id = '".$this->CONFIG->loggedUserId."',
					fr_asses_year = '".$getAssYear."', fr_itr_id = '".$itrID."', form_created_date = CURRENT_TIMESTAMP";
            $this->db->db_run_query($SQL);
            /*-------------------------------------------*/
            $form16_id = $this->db->db_insert_id();
            $_SESSION['form16_id'] = $form16_id;
            /*-------------------------------------------*/
        }

        $SQL = "INSERT INTO bfsi_form_26_as SET fr_itr_id ='".$itrID."',fr_user_id = '".$this->CONFIG->loggedUserId."',form_created_date = CURRENT_TIMESTAMP";
        $this->db->db_run_query($SQL);

        $SQL = "INSERT INTO itr_capitalgain SET fr_user_id = '".$this->CONFIG->loggedUserId."',fr_itr_id = '".$itrID."'";
        $this->db->db_run_query($SQL);

        $SQL = "INSERT INTO itr_deduction SET fr_user_id = '".$this->CONFIG->loggedUserId."',fr_itr_id = '".$itrID."'";
        $this->db->db_run_query($SQL);

        /*$SQL = "INSERT INTO itr_donation SET fr_user_id = '".$this->CONFIG->loggedUserId."',fr_itr_id = '".$itrID."'";
        $this->db->db_run_query($SQL);*/

        $SQL = "INSERT INTO itr_profile SET fr_user_id = '".$this->CONFIG->loggedUserId."' ,itr_pd_pan_number='".$pan."',fr_itr_id = '".$itrID."'";
        $this->db->db_run_query($SQL);

        $SQL = "INSERT INTO  itr_sou_salary SET fr_user_id = '".$this->CONFIG->loggedUserId."',fr_itr_id = '".$itrID."'";
        $this->db->db_run_query($SQL);

        $SQL = "INSERT INTO itr_taxfilling SET fr_user_id = '".$this->CONFIG->loggedUserId."',fr_itr_id = '".$itrID."'";
        $this->db->db_run_query($SQL);

        $SQL = "INSERT INTO itr_pd_residential_st SET fr_user_id = '".$this->CONFIG->loggedUserId."',fr_itr_id = '".$itrID."'";
        $this->db->db_run_query($SQL);

        $SQL = "INSERT INTO itr_business_profession SET fr_user_id = '".$this->CONFIG->loggedUserId."',fr_itr_id = '".$itrID."'";
        $this->db->db_run_query($SQL);

        $SQL = "INSERT INTO  itr_presumptive SET fr_user_id = '".$this->CONFIG->loggedUserId."',fr_itr_id = '".$itrID."'";
        $this->db->db_run_query($SQL);

        /*--------------------------------------------------------------------------------------------------------------*/

        $SQL = "INSERT INTO  itr_taxreconci_tdsrent SET fr_user_id = '".$this->CONFIG->loggedUserId."',fr_itr_id = '".$itrID."'";
        $this->db->db_run_query($SQL);

        /*--------------------------------------------------------------------------------------------------------------*/

        $SQL = "INSERT INTO  itr_taxreconci_tcs SET fr_user_id = '".$this->CONFIG->loggedUserId."',fr_itr_id = '".$itrID."', fr_recotds_id = '0'";
        $this->db->db_run_query($SQL);

        /*--------------------------------------------------------------------------------------------------------------*/

        $SQL = "INSERT INTO  itr_taxreconci_tdsothsal SET fr_user_id = '".$this->CONFIG->loggedUserId."',pk_recotdsothsal_id = '0',fr_itr_id = '".$itrID."', fr_recotds_id = '0'";
        $this->db->db_run_query($SQL);

        /*--------------------------------------------------------------------------------------------------------------*/
        $SQL = "INSERT INTO  itr_sou_other SET fr_user_id = '".$this->CONFIG->loggedUserId."',fr_itr_id = '".$itrID."'";
        $this->db->db_run_query($SQL);
        
        unset($_SESSION['pan']);
        return $_SESSION;
    }

    public function truncateITRData($REQUEST)
    {
        $getITRId = $REQUEST[itr_id];
        $getUserId = $REQUEST[user_id];

        $deleteSql = "DELETE FROM bfsi_itr WHERE pk_itr_id = '".$getITRId."' AND fr_user_id = '".$getUserId."'";
        $this->db->db_run_query($deleteSql);

        $SQL = "DELETE FROM bfsi_uploads WHERE fr_user_id = '".$getUserId."' AND fr_itr_id = '".$getITRId."'";
        $this->db->db_run_query($SQL);

        $SQL = "DELETE FROM bfsi_form_16_a WHERE fr_user_id = '".$getUserId."' AND fr_itr_id = '".$getITRId."'";
        $this->db->db_run_query($SQL);

        $SQL = "DELETE FROM bfsi_form_26_as WHERE fr_itr_id ='".$getITRId."' AND fr_user_id = '".$getUserId."'";
        $this->db->db_run_query($SQL);

        $SQL = "DELETE FROM itr_capitalgain WHERE fr_user_id = '".$getUserId."' AND fr_itr_id = '".$getITRId."'";
        $this->db->db_run_query($SQL);

        $SQL = "DELETE FROM itr_cg_purchse_impro WHERE fr_user_id = '".$getUserId."' AND fr_itr_id = '".$getITRId."'";
        $this->db->db_run_query($SQL);

        $SQL = "DELETE FROM itr_cg_saleoland_prop WHERE fr_user_id = '".$getUserId."' AND fr_itr_id = '".$getITRId."'";
        $this->db->db_run_query($SQL);

        $SQL = "DELETE FROM itr_cg_saleomutualfunds WHERE fr_user_id = '".$getUserId."' AND fr_itr_id = '".$getITRId."'";
        $this->db->db_run_query($SQL);

        $SQL = "DELETE FROM itr_cg_saleoshareordeben WHERE fr_user_id = '".$getUserId."' AND fr_itr_id = '".$getITRId."'";
        $this->db->db_run_query($SQL);

        $SQL = "DELETE FROM itr_cg_saleotherassets WHERE fr_user_id = '".$getUserId."' AND fr_itr_id = '".$getITRId."'";
        $this->db->db_run_query($SQL);

        $SQL = "DELETE FROM itr_deduction WHERE fr_user_id = '".$getUserId."' AND fr_itr_id = '".$getITRId."'";
        $this->db->db_run_query($SQL);

        $SQL = "DELETE FROM itr_donation WHERE fr_user_id = '".$getUserId."' AND fr_itr_id = '".$getITRId."'";
        $this->db->db_run_query($SQL);

        $SQL = "DELETE FROM itr_foa_detailsoftrust WHERE fr_user_id = '".$getUserId."' AND fr_itr_id = '".$getITRId."'";
        $this->db->db_run_query($SQL);

        $SQL = "DELETE FROM itr_foa_financialinterest WHERE fr_user_id = '".$getUserId."' AND fr_itr_id = '".$getITRId."'";
        $this->db->db_run_query($SQL);

        $SQL = "DELETE FROM itr_foa_forginassets WHERE fr_user_id = '".$getUserId."' AND fr_itr_id = '".$getITRId."'";
        $this->db->db_run_query($SQL);

        $SQL = "DELETE FROM itr_foa_immovableproperty WHERE fr_user_id = '".$getUserId."' AND fr_itr_id = '".$getITRId."'";
        $this->db->db_run_query($SQL);

        $SQL = "DELETE FROM itr_foa_othcaptialassets WHERE fr_user_id = '".$getUserId."' AND fr_itr_id = '".$getITRId."'";
        $this->db->db_run_query($SQL);

        $SQL = "DELETE FROM itr_foa_othincomederived WHERE fr_user_id = '".$getUserId."' AND fr_itr_id = '".$getITRId."'";
        $this->db->db_run_query($SQL);

        $SQL = "DELETE FROM itr_foa_signingauthority WHERE fr_user_id = '".$getUserId."' AND fr_itr_id = '".$getITRId."'";
        $this->db->db_run_query($SQL);

        $SQL = "DELETE FROM itr_hp_coowner_letout WHERE fr_user_id = '".$getUserId."' AND fr_itr_id = '".$getITRId."'";
        $this->db->db_run_query($SQL);

        $SQL = "DELETE FROM itr_hp_coowner_selfocc WHERE fr_user_id = '".$getUserId."' AND fr_itr_id = '".$getITRId."'";
        $this->db->db_run_query($SQL);

        $SQL = "DELETE FROM itr_hp_letout WHERE fr_user_id = '".$getUserId."' AND fr_itr_id = '".$getITRId."'";
        $this->db->db_run_query($SQL);

        $SQL = "DELETE FROM itr_hp_selfocc WHERE fr_user_id = '".$getUserId."' AND fr_itr_id = '".$getITRId."'";
        $this->db->db_run_query($SQL);

        $SQL = "DELETE FROM itr_profile WHERE fr_user_id = '".$getUserId."' AND fr_itr_id = '".$getITRId."'";
        $this->db->db_run_query($SQL);

        $SQL = "DELETE FROM itr_sou_salary WHERE fr_user_id = '".$getUserId."' AND fr_itr_id = '".$getITRId."'";
        $this->db->db_run_query($SQL);

        $SQL = "DELETE FROM itr_taxfilling WHERE fr_user_id = '".$getUserId."' AND fr_itr_id = '".$getITRId."'";
        $this->db->db_run_query($SQL);

        $SQL = "DELETE FROM itr_pd_residential_st WHERE fr_user_id = '".$getUserId."' AND fr_itr_id = '".$getITRId."'";
        $this->db->db_run_query($SQL);

        $SQL = "DELETE FROM itr_business_profession WHERE fr_user_id = '".$getUserId."' AND fr_itr_id = '".$getITRId."'";
        $this->db->db_run_query($SQL);

        $SQL = "DELETE FROM itr_business_profe_addmor WHERE fr_user_id = '".$getUserId."' AND fr_itr_id = '".$getITRId."'";
        $this->db->db_run_query($SQL);

        $SQL = "DELETE FROM  itr_presumptive WHERE fr_user_id = '".$getUserId."' AND fr_itr_id = '".$getITRId."'";
        $this->db->db_run_query($SQL);

        $SQL = "DELETE FROM itr_presumptive_tax44ae WHERE fr_user_id = '".$getUserId."' AND fr_itr_id = '".$getITRId."'";
        $this->db->db_run_query($SQL);

        $SQL = "DELETE FROM  itr_sou_other WHERE fr_user_id = '".$getUserId."' AND fr_itr_id = '".$getITRId."'";
        $this->db->db_run_query($SQL);

        $SQL = "DELETE FROM  itr_sou_foreignincome WHERE fr_user_id = '".$getUserId."' AND fr_itr_id = '".$getITRId."'";
        $this->db->db_run_query($SQL);

        $SQL = "DELETE FROM itr_sou_partnership WHERE fr_user_id = '".$getUserId."' AND fr_itr_id = '".$getITRId."'";
        $this->db->db_run_query($SQL);

        $SQL = "DELETE FROM itr_taxfilling WHERE fr_user_id = '".$getUserId."' AND fr_itr_id = '".$getITRId."'";
        $this->db->db_run_query($SQL);

        $SQL = "DELETE FROM itr_taxfilling_land WHERE fr_user_id = '".$getUserId."' AND fr_itr_id = '".$getITRId."'";
        $this->db->db_run_query($SQL);

        $SQL = "DELETE FROM itr_taxreconciliation WHERE fr_user_id = '".$getUserId."' AND fr_itr_id = '".$getITRId."'";
        $this->db->db_run_query($SQL);

        $SQL = "DELETE FROM itr_taxreconci_selfasstaxpaid WHERE fr_user_id = '".$getUserId."' AND fr_itr_id = '".$getITRId."'";
        $this->db->db_run_query($SQL);

        $SQL = "DELETE FROM itr_taxreconci_taxpaid_advan WHERE fr_user_id = '".$getUserId."' AND fr_itr_id = '".$getITRId."'";
        $this->db->db_run_query($SQL);

        $SQL = "DELETE FROM itr_taxreconci_tds WHERE fr_user_id = '".$getUserId."' AND fr_itr_id = '".$getITRId."'";
        $this->db->db_run_query($SQL);

        $SQL = "DELETE FROM itr_taxreconci_tdsimoprop WHERE fr_user_id = '".$getUserId."' AND fr_itr_id = '".$getITRId."'";
        $this->db->db_run_query($SQL);

        $SQL = "DELETE FROM itr_taxreconci_tdsothsal WHERE fr_user_id = '".$getUserId."' AND fr_itr_id = '".$getITRId."'";
        $this->db->db_run_query($SQL);

        return;
    }

    public function getEfillingDetails($whichTable)
    {
        global $_SESSION;
        $eFillingDetails = array();	//echo "SELECT * FROM ".$whichTable." WHERE fr_user_id = '".$this->CONFIG->loggedUserId."'";
        $eFillingDetails = $this->commonFunction->getSingleRow('SELECT * FROM '.$whichTable." WHERE fr_itr_id = '".$_SESSION[$this->CONFIG->sessionPrefix.'_ITR_ID']
                            ."' AND fr_user_id = '".$this->CONFIG->loggedUserId."'");

        return $eFillingDetails;
    }

    public function getEfillingDetailsMultiple($whichTable)
    {
        global $_SESSION;
        $eFillingDetails = array();	//echo "SELECT * FROM ".$whichTable." WHERE fr_user_id = '".$this->CONFIG->loggedUserId."'";
        $SQL = 'SELECT * FROM '.$whichTable." WHERE fr_itr_id = '".$_SESSION[$this->CONFIG->sessionPrefix.'_ITR_ID']
                            ."' AND fr_user_id = '".$this->CONFIG->loggedUserId."'";
        $eFillingDetailsMultiple = $this->commonFunction->mysqlResultIntoArray($SQL);

        return $eFillingDetailsMultiple;
    }

    /*------------------------------------------------- 20190525-BSEN-update-SQL-START ----------------------------------------------------------------*/
    /*--------------------------------------------- Update for fetching submited data-BSEN -----------------------------------------------------*/
    public function getAllEfilling($userID = '')
    {
        if ($userID == '') {
            $SQL = "SELECT bfsi_itr.*,itr_profile.itr_pd_pan_number FROM bfsi_itr JOIN itr_profile ON bfsi_itr.pk_itr_id = itr_profile.fr_itr_id WHERE bfsi_itr.fr_user_id = '".$this->CONFIG->loggedUserId."'";
        } else {
            $SQL = "SELECT * FROM bfsi_itr WHERE `itr_status`='1' ORDER by `pk_itr_id` DESC";
        }	/*********** 1=submitted ***********/
        return $this->commonFunction->mysqlResultIntoArray($SQL, 'SQL');
    }

    /*--------------------------------------------- Update for fetching submiteed data-BSEN -----------------------------------------------------*/
    public function getAllEfillingCount($userID = '')
    {
        if ($userID == '') {
            $SQL = "SELECT * FROM bfsi_itr WHERE fr_user_id = '".$this->CONFIG->loggedUserId."'";
        } else {
            /*--------------------------------- Old --------------------------------------------*/
            //$SQL = "SELECT * FROM bfsi_itr";
            /*--------------------------------- New --------------------------------------------*/
            $SQL = "SELECT * FROM bfsi_itr WHERE `itr_status`='1'";
        }	/*********** 1=submitted ***********/

        $docRes = $this->db->db_run_query($SQL);

        return $this->db->db_num_rows($docRes);
    }

    /*------------------------------------------------- 20190525-BSEN-update-SQL-END ----------------------------------------------------------------*/
    public function getSum($columnNane, $tbname, $fr_itr_id, $fr_user_id)
    {
        $sql = sprintf("SELECT sum(%s) as total FROM %s WHERE fr_itr_id='%s' AND fr_user_id='%s'", $columnNane, $tbname, $fr_itr_id, $fr_user_id);
        $result = $this->db->db_run_query($sql);
        $r1 = $this->db->db_fetch_array($result);
        $total = $r1['total'];

        return $total;
    }

    public function getDonation($columnNane, $tbname, $fr_itr_id, $fr_user_id, $donType)
    {
        $sql = sprintf("SELECT sum(%s) as total FROM %s WHERE fr_itr_id='%s' AND fr_user_id='%s' And dona_share_50_100 = '%s'", $columnNane, $tbname, $fr_itr_id, $fr_user_id, $donType);  //0 mean 50% dodation 1 mean 100% donation
        $result = $this->db->db_run_query($sql);
        $r1 = $this->db->db_fetch_array($result);
        $total = $r1['total'];

        return $total;
    }

    public function fetchformdata($getFormID)
    {
        $SQL = "SELECT * FROM bfsi_form_16_a WHERE pk_form_id = '".$getFormID."' AND fr_user_id  = '".$this->CONFIG->loggedUserId."'";

        //$formData = $this->commonFunction->mysqlResultIntoArray($SQL,'SQL');
        $result = $this->db->db_run_query($SQL);
        $response = $this->db->db_fetch_assoc($result);

        return $response;
    }

    public function getState()
    {
        $SQL = 'SELECT * FROM itr_state';
        /*----------------------------------- 20190219-BSEN -------------------------------------*/
        //echo "itrfil state query|".$SQL;
        return $this->commonFunction->mysqlResultIntoArray($SQL, 'SQL');
    }

    public function getCountry()
    {
        $SQL = "SELECT * FROM itr_country WHERE country_name = 'INDIA'";

        return $this->commonFunction->mysqlResultIntoArray($SQL, 'SQL');
    }

    public function selfCoMultipleRow($getTableName, $fieldName)
    {
        $itr_cg_purchse_impro = array();
        $SQL = sprintf("SELECT * FROM %s WHERE fr_user_id='%s'", $getTableName, $this->CONFIG->loggedUserId);
        $result = $this->db->db_run_query($SQL);
        if ($this->db->db_num_rows($result) > 0) {
            while ($row = $this->db->db_fetch_array($result)) {
                $itr_cg_purchse_impro[$row[$fieldName]][] = $row;
            }
        }

        return $itr_cg_purchse_impro;
    }

    public function calculatePaySelection($tbname, $fr_itr_id)
    {
        $pay_selection_fee = 0;
        $fees_code = array();
        //Salary
        $SQL_SAL = sprintf("SELECT sou_sa_salary FROM  %s WHERE fr_itr_id='%s' AND sou_sa_salary !='' ", 'itr_sou_salary', $fr_itr_id);
        $count_Salary = $this->commonFunction->getRecordCount($SQL_SAL);
        if ($count_Salary == 1) {
            array_push($fees_code, 'SAL161');
        } elseif ($count_Salary > 1) {
            array_push($fees_code, 'SAL16M');
        }

        //House Property
        $SQL_House_Prop = sprintf("SELECT let_ren_inc FROM  %s WHERE fr_itr_id='%s' AND let_ren_inc !='' ", 'itr_hp_letout', $fr_itr_id);
        $count_HP = $this->commonFunction->getRecordCount($SQL_House_Prop);
        if ($count_HP == 1) {
            array_push($fees_code, 'INCHP1');
        } elseif ($count_HP > 1) {
            array_push($fees_code, 'INCHPM');
        }

        //Interest Income
        $SQL_Int_Inc = sprintf("SELECT * FROM  %s WHERE fr_itr_id='%s' AND (sou_oth_oi_bnkint !='' OR sou_oth_oi_othint != '') ", 'itr_sou_other', $fr_itr_id);
        $count_Interest = $this->commonFunction->getRecordCount($SQL_Int_Inc);
        if ($count_Interest >= 1) {
            array_push($fees_code, 'INCINT');
        }

        //Any other Income
        $SQL_Oth_Inc = sprintf("SELECT * FROM  %s WHERE fr_itr_id='%s' AND sou_oth_oi_othinc != '' ", 'itr_sou_other', $fr_itr_id);
        $count_Other = $this->commonFunction->getRecordCount($SQL_Oth_Inc);
        if ($count_Other >= 1) {
            array_push($fees_code, 'INCOTH');
        }

        //Capital Gain

        //Income from Business

        //Calculation
        $fees_code = join("', '", $fees_code);

        $SQL = sprintf("SELECT sum(fee_amount) as total FROM fee_definition WHERE fee_code IN ('%s') ", $fees_code);
        $result = $this->db->db_run_query($SQL);
        $res_arr = $this->db->db_fetch_array($result);
        $pay_selection_fee = $res_arr['total'];

        $SQL_Fee = sprintf("SELECT fee_amount,fee_desc FROM fee_definition WHERE fee_code IN ('%s') ", $fees_code);
        $Fee_Stmnt = $this->commonFunction->mysqlResultIntoArray($SQL_Fee);
        $tot_sec = $this->commonFunction->getRecordCount($SQL_Fee);

        return array($pay_selection_fee, $Fee_Stmnt, $tot_sec);
    }

    public function get_itrv_files($uid) {
        $doclist = array();
        $SQL = "SELECT * FROM bfsi_itr WHERE fr_user_id='".$uid."'";
        $result = $this->commonFunction->mysqlResultIntoArray($SQL,'SQL');
        $fetch_portfolio["itr"] = $result;
        $SQL = "SELECT * FROM tbl_uploads WHERE user_id='".$uid."'";
        $result = $this->commonFunction->mysqlResultIntoArray($SQL,'SQL');
        $fetch_portfolio["docs"] = $result;
        return $fetch_portfolio;
    }

    public function get_form_16($uid) {
        $SQL = "SELECT * FROM tbl_uploads WHERE user_id='".$uid."'";
        $result = $this->commonFunction->mysqlResultIntoArray($SQL,'SQL');
        return $result;
    }
}

?>