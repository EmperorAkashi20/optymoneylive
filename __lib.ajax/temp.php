/* update will offer payment data */
	if ($_REQUEST['action'] == "proceed_to_download") {
		$json = file_get_contents('php://input');
		$data = json_decode($json);
		//echo $customerProfile->couponcheck($data->cou_code);
	}
	// if($_REQUEST['action']== "proceed_to_download") {
	// 	$data = json_decode(file_get_contents('php://input'));
	// 	echo json_encode($willProfile->updatePayment($data));
	// }


    public function dynamicInsertPay($getTbname, $getArray, $payID) {
    //     $fr_user_id = $this->CONFIG->loggedUserId;
    //     foreach ($getArray as $key => $value) {
    //         //$value = mysql_real_escape_string($con,$value);
    //         $value = "'$value'";
    //         $updates[] = "$key = $value";
    //     }
    //     $implodeArray = implode(', ', $updates);
    //     $sql = sprintf('INSERT into %s SET %s WHERE fr_user_id='.$this->CONFIG->loggedUserId, $getTbname, $implodeArray);
    //     echo "<br>SQL:-".$sql;
    //     //die();
    //     //$result = $this->db->db_run_query($sql);
    //     //return $result;
	// }



    $('#will_download_btn').click(function(e){
		// 	e.preventDefault();
		// 	$.ajax({
		// 		url: "https://optymoney.com/__lib.ajax/ajax_response.php?action=proceed_to_download",
		// 		type: "POST",
		// 		data: JSON.stringify({"pay_status": "1","txn_id":$('#coupon').val(),"response_msg":"Transaction successful","paid_amount": "0" }),
		// 		success: function(response) {
		// 			console.log(response);
		// 			//$.redirect('https://optymoney.com/mySaveTax/?module_interface=Y3JlYXRlX3dpbGw=', {'paystatus': '1', 'status': 'success'});
		// 		}
		// 	});
			
		// 	//window.location.href = "https://optymoney.com/mySaveTax/?module_interface=Y3JlYXRlX3dpbGw=";
		// });



        /* Update payment status */ 
    // function updatePayment($data) {
    //     $sql_query = "INSERT INTO bfsi_users_settings SET fr_user_id='".$this->CONFIG->loggedUserId."',".$data;
    //     echo "SQL : ".$sql_query;
    //     //return $this->db->db_run_query($sql_query);
    // }