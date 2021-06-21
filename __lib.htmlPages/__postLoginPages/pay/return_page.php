<?php
ini_set('display_errors',1);
error_reporting(E_ALL);

if(isset($_POST)){
	$response = $_POST;
	
	/* It is very important to calculate the hash using the returned value and compare it against the hash that was sent while payment request, to make sure the response is legitimate */
	$salt = "57d8a81fe00082fee3b1264fac9baa286184f1e5"; /* put your salt provided by traknpay here */
	if(isset($salt) && !empty($salt)){
		$response['calculated_hash']=hashCalculate($salt, $response);
		$response['valid_hash'] = ($response['hash']==$response['calculated_hash'])?'Yes':'No';
        
        //if($response['valid_hash']==="Yes") {
            ///echo "Payment received successfully";
            
        //}
        
	} else {
		$response['valid_hash']='Set your salt in return_page.php to do a hash check on receiving response from Traknpay';
	}
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

?>
<HTML>
<HEAD>
<TITLE>TraknPay - Business Payment Return Page</TITLE>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=iso-8859-1">
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
</style>
</HEAD>
<BODY LEFTMARGIN=0 TOPMARGIN=0 MARGINWIDTH=0 MARGINHEIGHT=0 bgcolor="#ECF1F7">

<table width="90%" cellpadding="2" cellspacing="2" border="0" align="center">
    <tr>
        <th colspan="2">
                <h1>TraknPay Payment API Integration Test Kit</h1>
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

</body>
</html>
