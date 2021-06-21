<?php

class payment
{
    public function payment()
    {
        global $CONFIG,$commonFunction,$permissionSettings;
        global $db;
        $this->db = $db;
        $this->dbName = $CONFIG->dbName;
        $this->commonFunction = $commonFunction;
        $this->CONFIG = $CONFIG;
        $this->payment = array();
    }

    public function getPaymentDetails($whichTable)
    {
        $SQL = "SELECT * FROM bfsi_users_settings WHERE fr_user_id='".$this->CONFIG->loggedUserId."' AND `pending_amount` != 0";

        return $this->commonFunction->mysqlResultIntoArray($SQL, 'SQL');
    }

    public function getPaymentCount()
    {
        $SQL = "SELECT * FROM bfsi_users_settings WHERE fr_user_id='".$this->CONFIG->loggedUserId."' AND `pending_amount` != 0";
        $docRes = $this->db->db_run_query($SQL);

        return $this->db->db_num_rows($docRes);
    }
}
