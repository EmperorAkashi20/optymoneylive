<?php
require_once("../../__lib.includes/config.inc.php");

ini_set('display_errors',1);
//error_reporting(E_ALL);


$profileInfo = $customerProfile->getCustomerInfo($CONFIG->loggedUserId);

function storetransactiontoDB($response) {
    global $CONFIG;
    $sqlquery = "INSERT INTO`bfsi_payments`(`pk_user_id`, `fr_customer_id`, `order_id`, `description`, `name`, `email`, `phone`, `city`, `zip_code`, `payment_datetime`, `response_message`, `response_code`, `transaction_id`, `payment_method`, `hash`, `calculated_hash`, `valid_hash`) VALUES ('" 
        . $response['udf3'] . "','" 
        . $response['udf2'] . "','" 
        . $response['order_id'] . "','" 
        . $response['description'] . "','" 
        . $response['name'] . "','" 
        . $response['email'] . "','" 
        . $response['phone'] . "','" 
        . $response['city'] . "','" 
        . $response['zip_code'] . "','" 
        . $response['payment_datetime'] . "','" 
        . $response['response_message'] . "','" 
        . $response['response_code'] . "','" 
        . $response['transaction_id'] . "','" 
        . $response['payment_method'] . "','" 
        . $response['hash'] . "','" 
        . $response['calculated_hash'] . "','" 
        . $response['valid_hash'] . "')"; 

    $result = $CONFIG->db->db_run_query($sqlquery);
    
    //echo $sqlquery;
    //echo $result;
}

function hashCalculate($salt,$input){
	/* Remove hash key if it is present */
	unset($input['hash']);
	/*Sort the array before hashing*/
	ksort($input);
	
	/*first value of hash data will be salt*/
	$hash_data = $salt;
	
	/*Create a | (pipe) separated string of all the $input values which are available in $hash_columns*/
	foreach ($input as $key=>$value) {
		if (strlen($value) > 0) {
			$hash_data .= '|' . $value;
		}
	}

	$hash = null;
	if (strlen($hash_data) > 0) {
		$hash = strtoupper(hash("sha512", $hash_data));
	}
		
	return $hash;
}

if(isset($_POST)){
	$response = $_POST;
	
	/* It is very important to calculate the hash using the returned value and compare it against the hash that was sent while payment request, to make sure the response is legitimate */
	$salt = "57d8a81fe00082fee3b1264fac9baa286184f1e5"; /* put your salt provided by traknpay here */
	if(isset($salt) && !empty($salt)){
		$response['calculated_hash']=hashCalculate($salt, $response);
		$response['valid_hash'] = ($response['hash']==$response['calculated_hash'])?'Yes':'No';
        
        if($response['valid_hash']==="Yes") {
            $paymentstatus= "Success";
            storetransactiontoDB($response);
        } else {
            $paymentstatus = "Failed";
        }
        
	} else {
		$response['valid_hash']='Failed from gateway';
	}
    
    
}
?>

<HTML>
<HEAD>
<TITLE>TaxSave Payment Confirmation</TITLE>
    <META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=iso-8859-1"></META>
<style>
        table {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;
        }

        th {
            font-size: 12px;
            background: #54b254;
            color: #FFFFFF;
            font-weight: bold;
            height: 30px;
        }

        td {
            font-size: 12px;
            background: #dff3e0
        }

        .error {
            color: #FF0000;
            font-weight: bold;
        }
    
    .btn-submit  {font-family: 'Montserrat', sans-serif;font-size:18px;border-radius:5px;margin-bottom:30px;width:310px;background-color:#003366;color: #fff; height: 64px;}
</style>
</HEAD>
 
    
    
<BODY LEFTMARGIN=0 TOPMARGIN=0 MARGINWIDTH=0 MARGINHEIGHT=0 bgcolor="#ECF1F7">
    <div style="font-family:'ABeeZee',calibri;font-size:110%">
    <div style="width:50%;margin:0 auto">
        <div class="row" id="printableArea">
        <div style="width:100%;margin:0 auto;background-color:#33bbff;float:left;margin-top:15px;padding:10px 10px 10px 10px">
            <img src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme; ?>img/logo.png" width="150px" class="CToWUd"><br>
            <h2 style="color:white">Payment Status</h2>
        </div>
        <div style="width:100%;margin:0 auto;background-color:#eeee;float:left;padding:10px 10px 10px 10px">
           
            <p>Hello <b><a> <?php echo $response['name'];?> </a></b></p>
            <p>Thanks for your payment.<p>
			<p>Please note the transaction details below:</p>
            <p>PAYMENT STATUS: <?php if($paymentstatus=="Success") {echo $response['response_message'];} else {echo "Failed";}?></p>
			<p>PRODUCT NAME: <?php echo $response['description'];?></p>
			<p>TRANSACTION ID:<?php echo $response['transaction_id'];?></p>
			<p>DATE & TIME: <?php echo $response['payment_datetime'];?></p>
			<p>AMOUNT: <?php echo $response['amount'];?></p>	
            <p>We look forward to serve you.</p>
            <p>You can always reach us on <a href="mailto:support@taxsave.in?Subject=Hello%20again" target="_blank">support@taxsave.in</a> or <u>+91-80-420-61247</u> for any assistance.</p>
            
            <p>Regards,<br>
            Team TaxSave</p>
        </div>
        </div>
        <div class="row">
            <p><b>Note : </b>In case the payment status is not 'Transaction successful', the payment is incomplete and will be reversed automatically if needed. Please contact us with the transaction ID  should you need any assistance.  </p>
        </div>
        <div class="row" align="center">
            <input type="button" class="btn-submit" onclick="printDiv('printableArea')" value="Print receipt" />
        </div>
        <div class="row"  align="center">
            <form class="loginForm" role="form" method="post" action="<?php echo $response['udf1'];?>"
									name="payment_frm"
									accept-charset="UTF-8" id="login-nav">
                <input type="hidden" name="paymentstatus" value="<?php echo $response['response_message'];?>" />
                <input type="hidden" name="amount" value="<?php echo $response['amount'];?>" />
                <input type="hidden" name="transactionid" value="<?php echo $response['transaction_id'];?>" />
                <input type="hidden" name="description" value="<?php echo $response['description'];?>" />
                
                <input type="submit" class="btn-submit" value="Continue" />
            </form>
        </div>
        </div>
    </div>
        <div style="display:none">
<table width="90%" cellpadding="2" cellspacing="2" border="0" align="center" aria-activedescendant="">
    <tr>
        <th colspan="2">
                <h1>Payment Confirmation</h1>
		<table width="100%" cellpadding="2" cellspacing="2" border="0">
			<tr>
				<td colspan="2" align="center"><h3>NOTE: It is very important to calculate the hash using the returned value and compare it against the hash that was sent with payment request, to make sure the response is legitimate.</h3></td>
			</tr>
			<tr>
				<th colspan="2">Response from TraknPay</th>
			</tr>
<?php
		foreach( $response as $key => $value) {
?>			
			<tr>
			    <td width="25%"><?php echo $key; ?></td>
			    <td><?php echo $value; ?></td>
			</tr>
<?php
		}
?>
</table>
        </th>
    </tr>
</table>
    </div>
    
    </BODY>
</HTML>


<script type="text/javascript">

    
function printDiv(divName) {        
        var divToPrint = document.getElementById(divName);
        var popupWin = window.open('', '_blank', 'width=300,height=300');
        popupWin.document.open();
        popupWin.document.write('<html><head><title>TaxSave payment status</title>');
        popupWin.document.write('</head><body onload="window.print()">');
        popupWin.document.write(divToPrint.innerHTML);
        //Append the external CSS file.
        //popupWin.document.write('<link href="style.css" rel="stylesheet" type="text/css" />');
        popupWin.document.write('</body></html>');
        popupWin.document.close();
}
</script>