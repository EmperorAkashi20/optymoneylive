<?php

class willProfile {
    public function willProfile() {
        global $CONFIG, $commonFunction, $permissionSettings;
        global $db;
        $this->db = $db;
        $this->dbName = $CONFIG->dbName;
        $this->commonFunction = $commonFunction;
        $this->CONFIG = $CONFIG;
        $this->willProfile = array();
    }

    /* Update payment status */ 
    function updatePayment($data) {
        $sql_query = "INSERT INTO bfsi_users_settings set fr_user_id = '".$this->CONFIG->loggedUserId."', paid_amount = '".$data->paid_amount."', pending_amount = 0, pay_status = '".$data->pay_status."', pay_for = 'Will', txn_id = '".$data->txn_id."', response_msg='".$data->response_msg."'";
        //echo "SQL : ".$sql_query;
        return $this->db->db_run_query($sql_query);
    }

    function getPayStatus() {
        $sql = "SELECT * FROM bfsi_users_settings WHERE fr_user_id=".$this->CONFIG->loggedUserId." ORDER BY pk_user_settings_id DESC LIMIT 1";
        return $this->commonFunction->mysqlResultIntoArray($sql,'SQL');
    }
    function getWillPayDetails() {
        $sql = "SELECT * FROM bfsi_users_settings WHERE fr_user_id=".$this->CONFIG->loggedUserId." ORDER BY pk_user_settings_id DESC";
        return $this->commonFunction->mysqlResultIntoArray($sql,'SQL');
    }
    function getAll($user_id) {
        $will_data = array();
        $tableList = ["bfsi_users_details", "will_beneficiary", "will_executor", "will_custodian", "will_witness"];
        $tableList1 = ["will_bank_accounts", "will_locker_info", "will_fixed_deposit", "will_mutual_fund", "will_share", "will_bond_details", "will_immovable_properties", "will_business", "will_ppf_info", "will_pension_funds", "will_gratuity", "will_general_insurance", "will_lic", "will_jewellery", "will_body_organ", "will_pet_animal", "will_other_assets", "will_ipr", "will_vehicle", "will_liabilities"];
        foreach ($tableList as $key => $val) {
            $will_data[$val] = $this->getWillInfo($val, $user_id);
            //$will_data[$val] = $user_id;
        }
        foreach ($tableList1 as $key => $val) {
            $will_data[$val] = $this->getWillBenificiaryInfo($val, $user_id);
            //$will_data[$val] = $user_id;
        }
        return json_encode($will_data);
    }
    /* Saving Will Personal information */ 
    function updateWillPersonalInfo($tbname, $user_id, $data, $act, $key, $id) {
        $sql_query = "";
        $sqlcheck = "select * from ".$tbname." WHERE fr_user_id='".$user_id."'";
        $check = $this->db->db_run_query($sqlcheck);
        $rowcount=$this->db->db_num_rows($check);
        if($rowcount==0) {
            $sql_query = "INSERT INTO ".$tbname." SET fr_user_id='".$user_id."',".$data;
        } else{
            $sql_query = "UPDATE ".$tbname." SET ".$data." WHERE ".$key."='".$id."'";
        }
        //return "query:".$sql_query;
        return $this->db->db_run_query($sql_query);
    }

    /* Saving will Beneficiary */
    function willBeneficiaries($tbname, $user_id, $data, $act, $row_key, $id, $tbname1, $key_parent, $parent_row_id) {
        $sql_query = "";
        if($tbname=="will_assign_beneficiary") {
            if($act=="insert") {
                $sql_query = "INSERT INTO ".$tbname." SET fr_user_id='".$user_id."',".$data;
            } else {
                if($act=="update") {
                    $sql_query = "UPDATE ".$tbname." SET ".$data." WHERE ".$row_key."='".$id."'";
                }
            }
            $res = $this->db->db_run_query($sql_query);
            $usedPercent = 0;
            $balPercent = 0;
            $sql = "SELECT sum(txt_beneficiary_share) as used FROM ".$tbname." where fr_user_id='".$user_id."' and for_table='".$tbname1."' and row_id='".$parent_row_id."'";
            $result = $this->db->db_run_query($sql);
            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    $usedPercent = $row["used"];
                }
            }
            $sql_query1 = "UPDATE ".$tbname1." SET ba_usedperc='".$usedPercent."', ba_balperc='".(100-$usedPercent)."' WHERE ".$key_parent."='".$parent_row_id."'";
            //return "query:".$sql_query."\nquery2:".$sql."\nquery:".$sql_query1;
            return $this->db->db_run_query($sql_query1);
        } else{

            if($act=="insert") {
                $sql_query = "INSERT INTO ".$tbname." SET fr_user_id='".$user_id."',".$data;
            } else {
                if($act=="update") {
                    $sql_query = "UPDATE ".$tbname." SET ".$data." WHERE ".$row_key."='".$id."'";
                }
            }
            //return "query:".$sql_query."\nquery2:".$sql."\nquery:".$sql_query1;
            return $this->db->db_run_query($sql_query);
        }
    }

    /* Getting Details */ 
    function getWillInfo($tbname, $user_id) {
        if($tbname=="will_pet_animal") {
            $sql_query = "select * from ".$tbname." as wpa JOIN will_beneficiary as wb ON wpa.pet_animal_beneficiary=wb.ben_id WHERE wpa.fr_user_id='".$user_id."'";    
        } else {
            $sql_query = "select * from ".$tbname." WHERE fr_user_id='".$user_id."'";
        }
        $result = $this->db->db_run_query($sql_query);
        $total_records = $this->db->db_num_rows($result);
        $data = array();
        while ($row = $this->db->db_fetch_assoc($result)){
            $data[] = $row;
        }
        //echo json_encode($data);
        return json_encode($data);
    }

    /* Getting beneficiary Details for preview */ 
    function getWillBenificiaryInfo($tbname, $user_id) {
        $sql_query = "select * from ".$tbname." WHERE fr_user_id='".$user_id."'";
        $result = $this->db->db_run_query($sql_query);
        $total_records = $this->db->db_num_rows($result);
        $data = array();
        while ($row = $this->db->db_fetch_assoc($result)){
            $id_key = array_shift(array_keys($row));
            $id_value = $row[$id_key];
            $sql1 = "select wb.ben_title, wb.ben_fname, wb.ben_mname, wb.ben_lname, wb.ben_rel_with_testator, wab.txt_beneficiary_share from will_assign_beneficiary as wab JOIN ".$tbname." as wba ON wab.row_id = wba.".$id_key." JOIN will_beneficiary as wb ON wab.fk_ben_id=wb.ben_id where wab.for_table='".$tbname."' AND wba.".$id_key." = ".$id_value."";
            $result1 = $this->db->db_run_query($sql1);
            $total_records = $this->db->db_num_rows($result1);
            $data1 = array();
            while ($row1 = $this->db->db_fetch_assoc($result1)){
                $data1[] = $row1;
            }
            $row['ben'] =json_encode($data1);
            $data[] = $row;
        }
        //echo json_encode($data);
        return json_encode($data);
    }

    /* Delete Will Data */ 
    function deleteWillData($tbname, $user_id, $row_key, $id, $tbname1, $key_parent, $parent_row_id) {
        if($tbname=="will_assign_beneficiary") {
            $sql_query = "delete from ".$tbname." WHERE ".$row_key."='".$id."'";
            $result = $this->db->db_run_query($sql_query);
            $usedPercent = 0;
            $balPercent = 0;
            $sql = "SELECT sum(txt_beneficiary_share) as used FROM ".$tbname." where fr_user_id='".$user_id."' and row_id='".$parent_row_id."'";
            $result = $this->db->db_run_query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $usedPercent = $row["used"];
                }
            }
            $sql_query1 = "UPDATE ".$tbname1." SET ba_usedperc='".$usedPercent."', ba_balperc='".(100-$usedPercent)."' WHERE ".$key_parent."='".$parent_row_id."'";
            //return "query:".$sql_query."\nquery2:".$sql."\nquery:".$sql_query1;
            return $this->db->db_run_query($sql_query1);
        } else{
            $sql_query = "delete from ".$tbname." WHERE ".$row_key."='".$id."'";
            $result = $this->db->db_run_query($sql_query);
            return $result;
        }
        return "query:".$sql_query."\nquery2:".$sql."\nquery:".$sql_query1;
    }

    /* Getting single Will Personal information */ 
    function getSingleWillInfo($tbname, $row_key, $id) {
        $sql_query = "select * from ".$tbname." WHERE ".$row_key."='".$id."'";
        $result = $this->db->db_run_query($sql_query);
        $json = json_encode($this->db->db_fetch_assoc($result, MYSQLI_ASSOC));
        return $json;
    }

    /* Getting single Will Personal information */ 
    function getBenificiary($tbname, $user_id, $for_table, $row_id) {
        $sql_query = "SELECT wab.pk_percent_id, wab.fk_ben_id, wb.ben_title, wb.ben_fname, wb.ben_mname, wb.ben_lname, wb.ben_rel_with_testator, wab.txt_beneficiary_share FROM ".$tbname." as wab INNER JOIN will_beneficiary as wb ON wab.fk_ben_id = wb.ben_id WHERE wab.fr_user_id='".$user_id."' AND wab.for_table='".$for_table."' AND wab.row_id='".$row_id."'";
        $result = $this->db->db_run_query($sql_query);
        $data = array();
        while ($row = $this->db->db_fetch_array($result, MYSQLI_ASSOC)){
            $data[] = $row;
        }
        // return $sql_query;
        //select wb.ben_fname, wb.ben_mname, wb.ben_lname, wab.txt_beneficiary_share from will_assign_beneficiary as wab INNER JOIN will_beneficiary as wb ON wab.fk_ben_id = wb.ben_id;
        return json_encode($data);
    }

    

    

    public function getwillassets($whichTable, $value)

    {

        $getwillassets = array();

        // $sql = 'SELECT '.$value.' FROM '.$whichTable." WHERE fr_user_id = '".$this->CONFIG->loggedUserId."'";
        

        // echo "<br><br>sql:---".$sql;
        // die();
        // if($value == "")
        // {
        //     $value = "*";
        // }
        

        $getwillassets = $this
            ->db
            ->db_run_query('SELECT ' . $value . ' FROM ' . $whichTable . ' WHERE fr_user_id ="' . $this
            ->CONFIG->loggedUserId . '"');

        //echo 'SELECT '.$value.' FROM '.$whichTable.' WHERE fr_user_id ="'.$this->CONFIG->loggedUserId.'"';
        

        $getwillassets = $this
            ->db
            ->db_fetch_object($getwillassets);

        return $getwillassets;

    }

    public function getwillnextid($alllinkid, $currentlinkid)

    {

        $no_of_assets = sizeof($alllinkid);

        //echo "<br><br>no_of_assets:---".$no_of_assets;
        

        $current_asset = array_search($currentlinkid, $alllinkid);

        // echo "<br><br>current_asset:---".$current_asset;
        if ($no_of_assets - $current_asset == 1)

        {

            //echo "<br><br>last assets:---";
            return 34;

        }

        else

        {

            $next_asset = $current_asset + 1;

            return $alllinkid[$next_asset];

        }

    }

    public function getwillpreviousid($alllinkid, $currentlinkid)

    {

        $no_of_assets = sizeof($alllinkid);

        $current_asset = array_search($currentlinkid, $alllinkid);

        // echo "<br><br>current_asset:---".$current_asset;
        if ($current_asset == 0)

        {

            return 35;

        }

        else

        {

            $previous_asset = $current_asset - 1;

            return $alllinkid[$previous_asset];

        }

    }

    public function getwilllinkcategory($linkid)

    {

        $sql = $this
            ->db
            ->db_run_query('SELECT category_link FROM `will_link_category` WHERE link_id = ' . $linkid . " ");

        $link = $this
            ->db
            ->db_fetch_array($sql);

        $next_link = $link[category_link];

        return $next_link;

    }

    public function getWillDetails($whichTable)

    {

        $getWillDetails = array();

        //echo "SELECT * FROM ".$whichTable." WHERE fr_user_id = '".$this->CONFIG->loggedUserId."'";
        

        $getWillDetails = $this
            ->db
            ->db_run_query('SELECT * FROM ' . $whichTable . " WHERE fr_user_id = '" . $this
            ->CONFIG->loggedUserId . "'");

        //var_dump($getWillDetails);
        

        $getWillDetails = $this
            ->db
            ->db_fetch_object($getWillDetails);

        //var_dump($getWillDetails);
        

        return $getWillDetails;

    }

    /*------------------------------------------------------------------------*/

    // fetch will_asset_category
    

    public function getwillassetcategory($whichTable)

    {

        $assetcategory = array();

        $subassetcategory = array();

        $getwillassetcategory = $this
            ->db
            ->db_run_query('SELECT * FROM ' . $whichTable . " WHERE parent_category_id = '0' and asset_id!=34 and asset_id!=35");

        //print_r($getwillassetcategory);
        

        while ($row = $this
            ->db
            ->db_fetch_array($getwillassetcategory))

        {

            $getwillassetcategory1 = $this
                ->db
                ->db_run_query('SELECT * FROM ' . $whichTable . " WHERE parent_category_id = '" . $row['asset_id'] . "'");

            while ($row1 = $this
                ->db
                ->db_fetch_array($getwillassetcategory1))

            {

                // array_push($subassetcategory,$row1['asset_category_name']);
                

                array_push($subassetcategory, array(
                    $row1['asset_id'],
                    $row1['asset_category_name']
                ));

            }

            $assetcategory[$row['asset_category_name']][] = $subassetcategory;

            $subassetcategory = array();

        }

        return $assetcategory;

    }

    // fetch will_asset_category close
    

    public function getallWillDetails($whichTable)

    {

        $getWillDetails = array();

        //echo "SELECT * FROM ".$whichTable." WHERE fr_user_id = '".$this->CONFIG->loggedUserId."'";
        

        $getWillDetails = $this
            ->db
            ->db_run_query('SELECT * FROM ' . $whichTable . " WHERE fr_user_id = '" . $this
            ->CONFIG->loggedUserId . "'");

        //var_dump($getWillDetails);
        

        //$getWillDetails = $this->db->db_fetch_object($getWillDetails);
        

        //var_dump($getWillDetails);
        

        return $getWillDetails;

    }

    /*------------------------------------------------------------------------*/
    public function AmountInWords($amount)
    {
        $amount_after_decimal = round($amount - ($num = floor($amount)) , 2) * 100;
        // Check if there is any number after decimal
        $amt_hundred = null;
        $count_length = strlen($num);
        $x = 0;
        $string = array();
        $change_words = array(
            0 => '',
            1 => 'One',
            2 => 'Two',
            3 => 'Three',
            4 => 'Four',
            5 => 'Five',
            6 => 'Six',
            7 => 'Seven',
            8 => 'Eight',
            9 => 'Nine',
            10 => 'Ten',
            11 => 'Eleven',
            12 => 'Twelve',
            13 => 'Thirteen',
            14 => 'Fourteen',
            15 => 'Fifteen',
            16 => 'Sixteen',
            17 => 'Seventeen',
            18 => 'Eighteen',
            19 => 'Nineteen',
            20 => 'Twenty',
            30 => 'Thirty',
            40 => 'Forty',
            50 => 'Fifty',
            60 => 'Sixty',
            70 => 'Seventy',
            80 => 'Eighty',
            90 => 'Ninety'
        );
        $here_digits = array(
            '',
            'Hundred',
            'Thousand',
            'Lakh',
            'Crore'
        );
        while ($x < $count_length)
        {
            $get_divider = ($x == 2) ? 10 : 100;
            $amount = floor($num % $get_divider);
            $num = floor($num / $get_divider);
            $x += $get_divider == 10 ? 1 : 2;
            if ($amount)
            {
                $add_plural = (($counter = count($string)) && $amount > 9) ? 's' : null;
                $amt_hundred = ($counter == 1 && $string[0]) ? ' and ' : null;
                $string[] = ($amount < 21) ? $change_words[$amount] . ' ' . $here_digits[$counter] . $add_plural . ' 
       ' . $amt_hundred : $change_words[floor($amount / 10) * 10] . ' ' . $change_words[$amount % 10] . ' 
       ' . $here_digits[$counter] . $add_plural . ' ' . $amt_hundred;
            }
            else $string[] = null;
        }
        $implode_to_Rupees = implode('', array_reverse($string));
        $get_paise = ($amount_after_decimal > 0) ? "And " . ($change_words[$amount_after_decimal / 10] . " 
   " . $change_words[$amount_after_decimal % 10]) . ' Paise' : '';
        return ($implode_to_Rupees ? $implode_to_Rupees : '') . $get_paise;
    }

    /*-----------------------------------------------------------------------*/

    function fetch_data($getWillDetails)
    {

        $getWillDetails = array();

        $getWillDetails = $this
            ->db
            ->db_fetch_object($getWillDetails);

        return $getWillDetails;

    }

    /*-----------------------------------------------------------------------*/

    function get_fields_value($get_fieldId)

    {

        $getWillDetails = array();

        $s = 'SELECT `f_name`,`m_name`,`l_name`,`pk_benf_id`,`rel_with_testator`,`bene_percentage`,`pk_percent_id` from `will_beneficiary` INNER JOIN will_beneficiary_percentage ON pk_benf_id = fk_ben_id WHERE will_beneficiary_percentage.fk_form_id = "' . $get_fieldId . '" AND will_beneficiary_percentage.fr_user_id=' . $this
            ->CONFIG->loggedUserId;

        /*echo $s;
        
        
        
        die();*/

        $getWillDetails = $this
            ->db
            ->db_run_query($s);

        return $getWillDetails;

    }

    // bank account table
    

    function get_asset_details($get_fieldId, $get_table, $asset_table_id)

    {

        $getWillDetails = array();

        $s = 'SELECT * from `will_beneficiary` INNER JOIN will_beneficiary_percentage ON will_beneficiary.pk_benf_id = will_beneficiary_percentage.fk_ben_id INNER JOIN ' . $get_table . ' ON will_beneficiary_percentage.assets_id=' . $get_table . '.' . $asset_table_id . ' WHERE will_beneficiary_percentage.fk_form_id = "' . $get_fieldId . '" AND ' . $get_table . '.fr_user_id=' . $this
            ->CONFIG->loggedUserId;

        // echo $s;
        

        // die();
        

        $getWillDetails = $this
            ->db
            ->db_run_query($s);

        return $getWillDetails;

    }

    // bank account table close
    

    /*---------------------------  All Relation Start -------------------------------------------*/

    function relation()
    {

        $array = array(
            '2' => "Spouse",
            '3' => "Son",
            '4' => "Daughter",
            '5' => "Mother",
            '6' => "Father",
            '7' => "Brother",
            '8' => "Sister",
            '19' => "Grand Daughter",
            '20' => "Grandson",
            '21' => "Grand Father",
            '22' => "Grand Mother",
            '23' => "Son-in-Law",
            '24' => "Daughter-in-law"
        );

        /* foreach ($array as $relation => $relation_value) {
        
        
        
                                    if ($relation == $rel) 
        
        
        
                                    {
        
        
        
                                        $relationship =  $relation_value;
        
        
        
                                    }
        
        
        
                                }
    
        
        return $relationship;*/

        return $array;

    }

    /*---------------------------  All Relation End-------------------------------------------*/

    /*---------------------------  All Religion Start -------------------------------------------*/

    function religion()
    {

        $array = array(
            '1' => "Buddhist",
            '2' => "Christian",
            '3' => "Hindu",
            '4' => "Islam",
            '5' => "Jain",
            '6' => "Judaism",
            '7' => "Parsi",
            '8' => "Sikh"
        );

        /* foreach ($array as $religion => $relation_value) {
                                    if ($religion == $rel_val) 
        
                                    {
        
                                        $religions =  $relation_value;
    
                                    }
        
                                }*/

        //return $religions;
        

        return $array;

    }

    /*---------------------------  All Religion End -------------------------------------------*/

    /*---------------------------  All title Start -------------------------------------------*/

    function get_title()
    {

        $array = array(
            '1' => "Mr.",
            '2' => "Mrs.",
            '3' => "Ms.",
            '10' => "Master",
            '23' => "Kumar",
            '24' => "Kumari"
        );

        /* foreach ($array as $religion => $relation_value) {
        
        
        
                                    if ($religion == $rel_val) 
        
        
        
                                    {
        
        
        
                                        $religions =  $relation_value;
        
        
        
                                    }
        
        
        
                                }*/

        //return $religions;
        

        return $array;

    }

    /*---------------------------  All Religion End -------------------------------------------*/

    public function getWillBenDetails($whichTable)

    {

        //$getWillDetails = array();
        

        /*----------------------------------- 20190315-BSEN -------------------------------------*/

        //echo "SELECT * FROM ".$whichTable." WHERE fr_user_id = '".$this->CONFIG->loggedUserId."'";
        

        $getWillDetails = $this
            ->db
            ->db_run_query_bene('SELECT * FROM ' . $whichTable . " WHERE fr_user_id = '" . $this
            ->CONFIG->loggedUserId . "'");

        //var_dump($getWillDetails);
        

        return $getWillDetails;

    }

    public function state()
    {

        $array = array(
            '35' => "Andaman and Nicobar Islands",
            '25' => "Daman and Diu",
            '28' => "Andhra Pradesh",
            '12' => "Arunachal Pradesh",
            '18' => "Assam",
            '10' => "Bihar",
            '4' => "Chandigarh",
            '22' => "Chhattisgarh",
            '26' => "Dadra and Nagar Haveli",
            '7' => "Delhi",
            '30' => "Goa",
            '24' => "Gujarat",
            '6' => "Haryana",
            '2' => "Himachal Pradesh",
            '1' => "Jammu and Kashmir",
            '20' => "Jharkhand",
            '29' => "Karnataka",
            '32' => "Kerala",
            '31' => "Lakshadweep",
            '23' => "Madhya Pradesh",
            '27' => "Maharashtra",
            '14' => "Manipur",
            '17' => "Meghalaya",
            '15' => "Mizoram",
            '13' => "Nagaland",
            '21' => "Odisha",
            '34' => "Puducherry",
            '3' => "Punjab",
            '8' => "Rajasthan",
            '11' => "Sikkim",
            '33' => "Tamil Nadu",
            '36' => "Telangana",
            '16' => "Tripura",
            '5' => "Uttarakhand",
            '9' => "Uttar Pradesh",
            '19' => "West Bengal"
        );

        /* foreach ($array as $state => $state_val) {
        
        
        
                                    if ($state_val == $state) 
        
        
        
                                    {
        
        
        
                                        $get_state =  $state_val;
        
        
        
                                    }
        
        
        
                                }*/

        return $array;

    }

    public function getWillBenDetailsoneentry($whichTable, $itemnumber)

    {

        $getWillDetails = array();

        //echo "SELECT * FROM ".$whichTable." WHERE fr_user_id = '".$this->CONFIG->loggedUserId."'";
        

        $getWillDetails = $this
            ->db
            ->db_run_query('SELECT * FROM ' . $whichTable . " WHERE fr_user_id = '" . $this
            ->CONFIG->loggedUserId . "'");

        //var_dump($getWillDetails);
        

        $getWillDetails = $this
            ->db
            ->db_fetch_object_item($getWillDetails, $itemnumber);

        //var_dump($getWillDetails);
        

        return $getWillDetails;

    }

    public function getWillPayCount()

    {

        $SQL = "SELECT * FROM bfsi_users_settings WHERE fr_user_id = '" . $this
            ->CONFIG->loggedUserId . "' AND pay_for ='WILL'";

        $Res = $this
            ->db
            ->db_run_query($SQL);

        return $this
            ->db
            ->db_num_rows($Res);

    }

    public function get_share_ben_ins($whichTable, $share, $fr_user_id, $fk_ben_id)
    {

        $sql = "INSERT INTO '" . $whichTable . "'(`fr_user_id`, `fk_ben_id`, `fk_form_id`, `bene_percentage`) VALUES ('" . $fr_user_id . "','" . $fk_ben_id . "','" . $fk_form_id . "','" . $bene_percentage . "')";

    }

}

//class closed

