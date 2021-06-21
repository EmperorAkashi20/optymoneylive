<?php
include '../../../__lib.includes/config.inc.php';

//echo "hi";
//$response = [
  //  'order_id' => '86158', 'amount' => '9.00', 'currency' => 'INR', 'description' => 'Payment for ITR', 'name' => 'yamuna', 'email' => 'yamunsk@yahoo.co.in', 'phone' => '7760270477', 'address_line_1' => 'dummy1', 'address_line_2' => 'dummy2', 'city' => 'Bangalore', 'state' => 'dummy3', 'country' => 'IND', 'zip_code' => '560001', 'udf1' => '', 'udf2' => '9131051910000001', 'udf3' => '1', 'udf4' => 'dummy4', 'udf5' => 'dummy5', 'transaction_id' => 'TGDEMN1702104717', 'payment_mode' => 'Netbanking', 'payment_channel' => 'Demo Bank', 'payment_datetime' => '2019-06-08 14:11:33', 'response_code' => '1', 'response_message' => 'Transaction successful', 'error_desc' => '', 'cardmasked' => '', 'hash' => 'CB407E9E2201B5928F22FDC4BE967183E11B31050BAA1CE47DBA971E3540A854040FFEFD16DE4460F8D28E65B25C92EA6B76034DB781AD326566F243D1307498', ];
//var_dump($_GET['data']);
$response = json_decode($_GET['data'], true);
/*echo "<br>----------------------------";
foreach($response as $key=>$value) {
    echo "$key=$value<br>";
  }
echo "Get Data :".$_GET['data'];
echo "aa : ";
echo "ab : ".$response['hash'];
echo "<br>----------------------------";
die();*/

$response_hash = $response['hash'];
unset($response['hash']);

$salt = '57d8a81fe00082fee3b1264fac9baa286184f1e5';
$hash = generateHashKey($response, $salt);
//echo $response;
//die();
// echo $response_hash.'<br/>';
// echo $hash;
//echo "response code".$_REQUEST['response_code'];
function generateHashKey($parameters, $salt, $hashing_method = 'sha512'){
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
if ($response_hash == $hash) {
    if ($response['response_code'] == 0) {
        $status = 1;
    } else {
        $status = 0;
    }

    $tbname = ' bfsi_users_settings';
    $result = $commonFunction->latestRowById('bfsi_users_settings', $CONFIG->loggedUserId, 'pk_user_settings_id', $limit = 1);
    $id = $_SESSION['maxPayID'];
    //echo "<br>ID:-".$id."<br>";
    //echo "ID:-";
   // print_r($result);
    $dataarray = array(
        'pay_status' => $status,
        'txn_id' => $response['transaction_id'],
        'response_msg' => $response['response_message'],
    );
    print_r($dataarray);
    $res = $commonFunction->dynamicUpdatePay($tbname, $dataarray,$id);
    $userData = $customerProfile->getCustomerInfo($CONFIG->loggedUserId);
    
    if($res) {
        $message = $commonFunction->readPHP("../../__lib.mailFormats/will_email.html");
        $f_name = ucfirst(strtolower($userData['cust_name']));
        $message = str_replace("USERNAME",$f_name,$message);
        // echo "message111 : ".$message;
        $commonFunction->send_mail($userData['login_id'],"Your Will Status",$message,true);
    }
    //print_r($userData);
    // echo "res : ".$userData['login_id'];
    // exit;
}
$_SESSION['paystatus'] = $status;
//echo "status : ".$status;
?>
<div class="main-content">
    <div class="main-content-inner">
        <?php if ($status == 1) { ?>
            <form class="loginForm" role="form" method="post" action="?module_interface=<?php  echo $commonFunction->setPage('create_will'); ?>"
                            name="payment_success">
                <div class="card">
                    <div class="card-body">
                        <div id="page-content">  
                            <center>
                            <div class="row">
                                <div class="col-xs-12 col-sm-6 col-md-12 col-md-offset-1">
                                    <div class="widget-box transparent">
                                        <div class="widget-body">
                                            <div class="widget-main no-padding">
                                                <h4><center>Thank you for Making WILL with us</center><br> <center><span class="span-end"></span></center></h4>
                                                <p>Your account has been charged and your transaction is successful. <br>Your transaction ID is : <?php echo $response['transaction_id']; ?><br>Your paid amount is :<?php echo $response['amount']; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix">
                                <button id="paymentFrm" name="willPayFrm" type="submit"
                                    class="width-35 pull-center btn btn-sm btn-success">
                                    <i class="ace-icon fa fa-key"></i> <span class="bigger-110">Proceed to making Will</span>
                                </button>
                            </div>
                            <input type="hidden" name="activeTab" id="activeTab" value="pay_download"/>
                            <input type="hidden" name="paystatus" id="paystatus" value="1"/>
                            </center>
                        </div>
                    </div>
                </div>
            </form>
                    <?php
                    } ?>

        <?php
                    if ($status == 0) {
                        ?>
        <form class="loginForm" role="form" method="post" action="?module_interface=<?php  echo $commonFunction->setPage('create_will'); ?>"
									name="payment_failed">
            <div class="card">
                <div class="card-body">
                    <div id="page-content">
                        <center>
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-12 col-md-offset-1">
                                <div class="widget-box transparent">
                                    <div class="widget-body">
                                        <div class="widget-main no-padding">
                                            <h4><center>WE COULDN'T PROCESS YOUR PAYMENT</center><br> <center><span class="span-end"></span></center></h4>
                                            <br>Your transaction ID is : <?php echo $response['transaction_id']; ?>
                                            <p>Unfortunately, we couldn't collect your payment on making the WILL. Please Retry. </p>
                                        </div>
                                        <button id="PaymentBk" name="loginFrm" type="submit"
                                                    class="width-35 pull-center btn btn-sm btn-success">
                                                    <i class="ace-icon fa fa-key"></i> <span class="bigger-110">Back</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </center>
                    </div>
                </div>
            </div>
        </form>                               
                    <?php
                    } ?>                             
        </div>
    </div>

