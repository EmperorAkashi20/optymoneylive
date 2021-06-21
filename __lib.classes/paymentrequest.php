<?php

include '../../../__lib.includes/config.inc.php';
//error_reporting(E_ALL);
$_POST['return_url'] ='http://optymoney.com/mySaveTax/?module_interface=dHJhbl9zdGF0dXM=';
print_r($_POST);
if (isset($_POST['will_payment'])) {
    $tbname = 'bfsi_users_settings';
    $dataarray = array(
            'fr_user_id' => $CONFIG->loggedUserId,
            'pay_for' => 'Will',
            'pending_amount'=>'0',
            'pay_status' => '0',
            'pay_date' => "CURDATE()",
            'paid_amount' => $_POST['amount'],
        );
    $commonFunction->InsertMultiple($tbname, $dataarray);
    $SQL2 = "INSERT INTO bfsi_users_settings SET pay_date = DATE(NOW()), fr_user_id = '".$CONFIG->loggedUserId."', paid_amount = '0', pending_amount = '0', pay_status = '0', pay_for = '', setting_create_date = DATE(NOW()), txn_id = '', narration = '', setting_modified_date = now()";
    $db->db->db_run_query($SQL2);
} elseif (isset($_POST['itr_payment'])) { 
    $tbname = 'bfsi_users_settings';
    $dataarray = array(
            'fr_user_id' => $CONFIG->loggedUserId,
            'fr_itr_id' => $_SESSION[$CONFIG->sessionPrefix.'_ITR_ID'],
            'pay_for' => 'ITR',
            'pending_amount'=>'0',
            'pay_status' => '0',
            'pay_date' => "CURDATE()",
            'paid_amount' => $_POST['amount'],
        );
    $commonFunction->InsertMultiple($tbname, $dataarray);
}

$result = $commonFunction->latestRowById('bfsi_users_settings', $fr_user_id, 'pk_user_settings_id', $limit = 1);
//echo $result;

$_SESSION['maxPayID'] = $result['pk_user_settings_id'];
//echo "string";
$salt = '57d8a81fe00082fee3b1264fac9baa286184f1e5'; //Pass your SALT here
//$_POST['api_key'] = 'fb7c78ca-18c7-434f-b4a0-29fd9e66274a'; //Pass your API KEY here

$input = $_POST;
unset($input['loginFrm']);
$hash = generateHashKey($input, $salt);
//$hash = hashCalculate($salt, $_POST);

function generateHashKey($parameters, $salt, $hashing_method = 'sha512') {
    $secure_hash = null;
    ksort($parameters);
    $hash_data = $salt;
    foreach ($parameters as $key => $value) {
        if (strlen($value) > 0) {
            $hash_data .= '|'.trim($value);
        }
    }
    if (strlen($hash_data) > 0) {
        $secure_hash = strtoupper(hash($hashing_method, $hash_data));
    }
    return $secure_hash;
}

function hashCalculate($salt, $input) {
    /* Columns used for hash calculation, Donot add or remove values from $hash_columns array */
    //$hash_columns = ['address_line_1', 'address_line_2', 'amount', 'api_key', 'city', 'country', 'currency', 'description', 'email', 'mode', 'name', 'order_id', 'phone', 'udf1', 'udf2', 'udf3', 'udf4', 'udf5', 'zip_code', 'return_url', 'return_url_failure'];
    //$hash_columns = ['address_line_1', 'address_line_2', 'amount', 'api_key', 'city', 'country', 'currency', 'description', 'email', 'mode', 'name', 'order_id', 'phone', 'udf1', 'udf2', 'udf3', 'udf4', 'udf5', 'zip_code', 'return_url', 'return_url_failure', 'return_url_cancel', 'payment_options'];
    /*Sort the array before hashing*/
    //exit;
    $hash_columns = $input;
    sort($hash_columns);
    /*Create a | (pipe) separated string of all the $input values which are available in $hash_columns*/
    $hash_data = $salt;
    foreach ($hash_columns as $column) {
        if (isset($input[$column])) {
            if (strlen($input[$column]) > 0) {
                $hash_data .= '|'.trim($input[$column]);
            }
        }
    }
    $hash = strtoupper(hash('sha512', $hash_data));
    return $hash;
}
?>

<p>Redirecting...</p>

<form action="https://biz.traknpay.in/v2/paymentrequest" id="payment_form" method="POST">
<!-- <form action="https://optymoney.com/mySaveTax/?module_interface=cGF5L3BheW1lbnRyZXNwb25zZV9XaWxs" id="payment_form" method="POST"> -->
    <input type="hidden" value="<?php echo $hash; ?>"                   name="hash"/>
    <input type="hidden" value="<?php echo $_POST['api_key']; ?>"        name="api_key"/>
    <input type="hidden" value="<?php echo $_POST['return_url']; ?>"    name="return_url"/>
    <input type="hidden" value="<?php echo $_POST['mode']; ?>"           name="mode"/>
    <input type="hidden" value="<?php echo $_POST['order_id']; ?>"       name="order_id"/>
    <input type="hidden" value="<?php echo $_POST['amount']; ?>"         name="amount"/>
    <input type="hidden" value="<?php echo $_POST['currency']; ?>"       name="currency"/>
    <input type="hidden" value="<?php echo $_POST['description']; ?>"    name="description"/>
    <input type="hidden" value="<?php echo $_POST['name']; ?>"           name="name"/>
    <input type="hidden" value="<?php echo $_POST['email']; ?>"          name="email"/>
    <input type="hidden" value="<?php echo $_POST['phone']; ?>"          name="phone"/>
    <input type="hidden" value="<?php echo $_POST['address_line_1']; ?>" name="address_line_1"/>
    <input type="hidden" value="<?php echo $_POST['address_line_2']; ?>" name="address_line_2"/>
    <input type="hidden" value="<?php echo $_POST['city']; ?>"           name="city"/>
    <input type="hidden" value="<?php echo $_POST['state']; ?>"           name="state"/>
    <input type="hidden" value="<?php echo $_POST['zip_code']; ?>"       name="zip_code"/>
    <input type="hidden" value="<?php echo $_POST['country']; ?>"        name="country"/>
    <input type="hidden" value="<?php echo $_POST['udf1']; ?>"           name="udf1"/>
    <input type="hidden" value="<?php echo $_POST['udf2']; ?>"           name="udf2"/>
    <input type="hidden" value="<?php echo $_POST['udf3']; ?>"           name="udf3"/>
    <input type="hidden" value="<?php echo $_POST['udf4']; ?>"           name="udf4"/>
    <input type="hidden" value="<?php echo $_POST['udf5']; ?>"           name="udf5"/>
    <!-- <input type="hidden" value="<?php //echo $_POST['return_url_failure'];?>" name="return_url_failure"/> -->
    <!-- <input type="hidden" value="<?php //echo $_POST['return_url_cancel'];?>" name="return_url_cancel"/> -->
    <noscript><input type="submit" value="Continue"/></noscript>
</form>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
function formAutoSubmit () {
    var payform = document.getElementById("payment_form");
    alert("payform :"+document.getElementById("return_url"));
	payform.submit();
}
window.onload = formAutoSubmit;
</script>

