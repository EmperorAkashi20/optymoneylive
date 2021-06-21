<?php
include '../../../__lib.includes/config.inc.php';
//global $CONFIG;
error_reporting(0); 

$profileInfo = $customerProfile->getCustomerInfo($CONFIG->loggedUserId);

$uname = $profileInfo['cust_name'];
$email = $profileInfo['login_id'];
$mobno = $profileInfo['contact_no'];
$custid = $profileInfo['fr_customer_id'];
$userid = $profileInfo['pk_user_id'];
/*$amount = 1500;
 $_POST['amount'] = $amount;*/
//$_POST['description'] = 'Making payment for will';
$_POST['return_page'] = 'user';
if ($_POST['description'] == "") {
    $_POST['description'] = "For Helpdesk";
}

if (isset($_POST['btn-upload']) || ($_POST['submit'])) {
    //print_r($_FILES);
    /*$file = $_FILES['file']['name'];
    $file_loc = $_FILES['file']['tmp_name'];
    $file_size = $_FILES['file']['size'];
    $file_type = $_FILES['file']['type'];*/

    $pan = $_POST['pan'];
    $aadhaar = $_POST['aadhaar'];
    $amount = $_POST['amount'];
    /*-----------------------------------*/
    $amount = $_POST['amount'];
    $_POST['amount'] = $amount;
    /*-----------------------------------*/
    $bankname = $_POST['bank'];
    $acno = $_POST['acno'];
    $ifsc = $_POST['ifsc'];
    $tax_id = $_POST['tax_userid'];
    $tax_pwd = $_POST['tax_pwd'];
    $address = $_POST['address'];
    $father = $_POST['father_name'];

    $c_acnt = $_POST['c_acnt'];
    $f_travel = $_POST['f_travel'];
    $e_bill = $_POST['e_bill'];
    $dt     = $_POST['dobofusr'];
    /*$email =$_POST['email'];
    $mobile =$_POST['mobile'];
    */
    $description = $_POST['description'];
    $folder = $CONFIG->wwwroot . $CONFIG->userFilesURL . $CONFIG->helpdesk;
    //echo "Folder:-".$folder.$CONFIG->loggedUserId."<br>";
    //echo "ID:-".$CONFIG->loggedUserId."<br>";
    if (!is_dir($folder.$CONFIG->loggedUserId)) {
        mkdir($folder.$CONFIG->loggedUserId, 0777, true);
        //echo "mkdir ".$folder.$CONFIG->loggedUserId;
        //$commonFunction->runInShell(mkdir $folder.$CONFIG->loggedUserId);
        //echo "Not exist";
    } 
    else {
        //echo "exist";
    }
    $all_file_name = [];
    if ($pan) {
        if($_POST['itr_e']=="itr") {
            $total = count($_FILES['fileitr']['name']);
            for( $i=0 ; $i < $total ; $i++ ) {
                $tmpFilePath = $_FILES['fileitr']['tmp_name'][$i];
                array_push($all_file_name,$_FILES['fileitr']['name'][$i]);
                if ($tmpFilePath != ""){
                    $newFilePath = $folder.$CONFIG->loggedUserId."/" . $_FILES['fileitr']['name'][$i];
                    if(move_uploaded_file($tmpFilePath, $newFilePath)) {
                        //echo "<br>HELLO";
                    } else {
                        // echo "NOT HELLO<br>";
                    }
                }
            }
            $total = count($_FILES['addfileitr']['name']);
            for( $i=0 ; $i < $total ; $i++ ) {
                $tmpFilePath = $_FILES['addfileitr']['tmp_name'][$i];
                array_push($all_file_name,$_FILES['addfileitr']['name'][$i]);
                if ($tmpFilePath != ""){
                    $newFilePath = $folder.$CONFIG->loggedUserId."/" . $_FILES['addfileitr']['name'][$i];
                    if(move_uploaded_file($tmpFilePath, $newFilePath)) {
                        //echo "<br>HELLO";
                    } else {
                        // echo "NOT HELLO<br>";
                    }
                }
            }
        } else {
            if($_POST['itr_e']=="eassess") {
                $tmpFilePath = $_FILES['noticeCopy']['tmp_name'];
                array_push($all_file_name,$_FILES['noticeCopy']['name']);
                if ($tmpFilePath != ""){
                    $newFilePath = $folder.$CONFIG->loggedUserId."/" . $_FILES['noticeCopy']['name'];
                    if(move_uploaded_file($tmpFilePath, $newFilePath)) {
                        //echo "<br>HELLO";
                    } else {
                        // echo "NOT HELLO<br>";
                    }
                }
                $tmpFilePath = $_FILES['itrfiledcopy']['tmp_name'];
                array_push($all_file_name,$_FILES['itrfiledcopy']['name']);
                if ($tmpFilePath != ""){
                    $newFilePath = $folder.$CONFIG->loggedUserId."/" . $_FILES['itrfiledcopy']['name'];
                    if(move_uploaded_file($tmpFilePath, $newFilePath)) {
                        //echo "<br>HELLO";
                    } else {
                        // echo "NOT HELLO<br>";
                    }
                }
                $total = count($_FILES['addeassest']['name']);
                for( $i=0 ; $i < $total ; $i++ ) {
                    $tmpFilePath = $_FILES['addeassest']['tmp_name'][$i];
                    array_push($all_file_name,$_FILES['addeassest']['name'][$i]);
                    if ($tmpFilePath != ""){
                        $newFilePath = $folder.$CONFIG->loggedUserId."/" . $_FILES['addeassest']['name'][$i];
                        if(move_uploaded_file($tmpFilePath, $newFilePath)) {
                            //echo "<br>HELLO";
                        } else {
                            // echo "NOT HELLO<br>";
                        }
                    }
                }
            }   
        }
        //print_r($all_file_name);
        $all_file_names = implode('|',$all_file_name);
        $sql = "INSERT INTO tbl_uploads(itr_e, file,type,size,amount,pan,aadhaar,user_id,bank,acno,ifsc,tax_userid,tax_pwd,address,fathers_name,description,c_acnt,f_travel,e_bill,dobofusr,upload_date) VALUES ('".$_POST[itr_e]."','" . $all_file_names . "','',0,'" . intval($amount) . "','" . $pan . "','" . intval($aadhaar) . "','" . $CONFIG->loggedUserId . "','" . $bankname . "','" . intval($acno) . "','" . $ifsc . "','" . $tax_id . "','" . $tax_pwd . "','" . $address . "','" . $father . "','" . $description . "','" . $c_acnt . "','" . $f_travel . "','" . $e_bill . "','" . $dt . "',now())";
        //echo "SQL".$sql;
        //die();
        $res = $commonFunction->run_the_query($sql);
        //$id = $db->db_insert_id($res);
        //mysqli_query($connection,$sql);
        if ($res) {
            $email_id= $_POST['email'];
            $subject = "Successful submission of ITR filing data with optymoney";
            $msg_format= "helpdesk_confirmation_mail.html";
            $name= $profileInfo['cust_name'];
            $frm_mail = "tax@optymoney.com";
            $from_name = "Optymoney Tax";
            if($commonFunction->send_mail_para($email_id,$subject,$msg_format,$name,$frm_mail,$from_name)) {
                //echo "sent";
            } else {
                //echo "not sent";
            }
        } else {
?>
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-10 col-md-offset-1">
                    <h1><center>Thers is some issue.Please fill the data again properly</center></h1><br>
                </div>
		    </div>
<?php   } 
    } else {
        //echo $sql="INSERT INTO tbl_uploads(file,type,size,amount,pan,aadhaar,user_id,bank,acno,ifsc,tax_userid,tax_pwd,address,father_name,description,upload_date) VALUES ('".$final_file."','".$file_type."','".$new_size."','".intval($amount)."','".$pan."','".intval($aadhaar)."','".$CONFIG->loggedUserId."','".$bankname."','".$acno."','".$ifsc."','".$tax_id."','".$tax_pwd."','".$address."','".$father."','".$description."',CURDATE())";
    }
} else {
    echo "OOPS Error!";
} ?>
<div class="container" style="margin-top: 100px;">
    <div class="card">
        <div class="card-body">
	        <div id="paymentpage">
                <section id="page_content" class="">
		            <div class="container"> 
                        <?php if ($_POST['amount'] == "") {
                                # code...
                                
                            ?>
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-12 col-md-offset-1">
                                <h1><center>We have recevied your documents.</center></h1><br>
                                <h4><center>Our team will get in touch with you within 48 hours and your ITR will be filed. Thank you</center></h4>  
                            </div>
                        </div>
                        <?php } else { ?>
                            <center>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6 col-md-10 col-md-offset-1">
                                        <h1><center>Payment</center></h1><br>
                                        <h4><center>Pay INR <?php echo $_POST['amount']; ?> only</center></h4>  
                                    </div>
		                        </div>
                                <div class="row">
                                    <div class="col-xs-12">
                                        
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-3"> </div>
                                    <div class="col-xs-6">
                                        <div id="login-box" class="login-box visible widget-box no-border">
                                            <div class="widget-body">
                                                <div class="widget-main">
                                                    <h4 class="header blue lighter bigger">
                                                        <i class="ace-icon fa fa-info green"></i> Please check all the details to make the payment
                                                    </h4>
                                                    <div class="space-6"></div>
                                                    <form class="loginForm" role="form" method="post" action="pay/paymentrequest.php" name="payment_frm" accept-charset="UTF-8" id="login-nav">
                                                        <fieldset>
                                                            <label class="block clearfix"> <span
                                                                class="block input-icon input-icon-right"> 
                                                                <input
                                                                    type="name" name="name" class="form-control" value="<?php echo $uname; ?>"
                                                                    id="paymentname" placeholder="Name" required>
                                                                    <i class="ace-icon fa fa-user"></i>
                                                            </span>
                                                            </label>
                                                            <label class="block clearfix"> <span
                                                                class="block input-icon input-icon-right"> 
                                                                <input
                                                                    type="email" name="email" class="form-control" value="<?php echo $email; ?>"
                                                                    id="paymentemail" placeholder="Email address" required>
                                                                    <i class="ace-icon fa fa-envelope"></i>
                                                            </span>
                                                            </label>
                                                            <label class="block clearfix"> <span
                                                                class="block input-icon input-icon-right"> 
                                                                <input
                                                                    type="phone" name="phone" class="form-control" value="<?php echo $mobno; ?>"
                                                                    id="paymentphone" placeholder="Phone number" required>
                                                                    <i class="ace-icon fa fa-mobile"></i>
                                                            </span>
                                                            </label>
                                                            <label class="block clearfix"> <span
                                                                class="block input-icon input-icon-right"> 
                                                                <input
                                                                    type="city" name="city" class="form-control" value="Bangalore"
                                                                    id="paymentcity" placeholder="City" required>
                                                                    <i class="ace-icon fa fa-map-marker"></i>
                                                            </span>
                                                            </label>
                                                            <label class="block clearfix"> <span
                                                                class="block input-icon input-icon-right"> 
                                                                <input
                                                                    type="zipcode" name="zip_code" class="form-control" value="560001"
                                                                    id="paymentzipcode" placeholder="Zip Code" required>
                                                                    <i class="ace-icon fa fa-globe"></i>
                                                            </span>
                                                            </label>
                                                            
                                                            <div class="space-6"></div>
                                                            <input type="hidden" name="api_key" value="fb7c78ca-18c7-434f-b4a0-29fd9e66274a" />
                                                            <?php
                                                                $actual_link1 = $CONFIG->siteurl;
                                                                $actual_link1 = $actual_link1 . 'mySaveTax/?module_interface=';
                                                                //$actual_link1 = $actual_link1.$commonFunction->setPage('pay/will_payment_success');
                                                                $actual_link1 = $actual_link1 . $commonFunction->setPage('pay/paymentresponse_helpdesk');
                                                                $_SESSION['return_page'] = $_POST['return_page'];
                                                                //$failed_url = $CONFIG->siteurl.'mySaveTax/?module_interface='.$commonFunction->setPage('pay/will_payment_failure');
                                                            ?>
                                                            <input type="hidden" name="return_url"    value="<?php echo $actual_link1; ?>" />
                                                            <!-- <input type="hidden" name="return_url_failure"    value="<?php //echo $failed_url; ?>" /> -->
                                                            <input type="hidden" name="mode"          value="LIVE" />
                                                            <input type="hidden" name="order_id"        value="<?php echo (int)rand(5000, 90000); ?>" />
                                                            <input type="hidden" name="amount"    value="<?php echo $_POST['amount'] . '.00'; ?>" /> 
                                                            <input type="hidden" name="currency"        value="INR" />
                                                            <input type="hidden" name="description" value="<?php echo $_POST['description']; ?>" /> 
                                                            <input type="hidden" name="country"        value="IND" />
                                                            <input type="hidden" name="address_line_1"          value="dummy" />
                                                            <input type="hidden" name="address_line_2"          value="dummy" />
                                                            <input type="hidden" name="state"          value="dummy" />
                                                            <input type="hidden" name="udf1"          value="<?php echo $_POST['return_page']; ?>" />
                                                            <input type="hidden" name="udf2"          value="<?php echo $custid; ?>" />
                                                            <input type="hidden" name="udf3"          value="<?php echo $userid; ?>" />
                                                            <input type="hidden" name="udf4"          value="dummy" />
                                                            <input type="hidden" name="udf5"          value="dummy" />
                                                            <div class="clearfix">
                                                                <button id="will_payment" name="will_payment" type="submit"
                                                                    class="width-35 pull-center btn btn-sm btn-success">
                                                                    <i class="ace-icon fa fa-key"></i> <span class="bigger-110">Proceed to Pay</span>
                                                                </button>
                                                                <div style="height: 20px;">
                                                                    <div style="display: none;" id="invalidpaymentdetails"
                                                                        class="orange">
                                                                        <strong>Invalid email found</strong>
                                                                    </div>
                                                                </div>
                                                            </div>
									                    </fieldset>
								                    </form>
								                    <div class="space-24"></div>
							                    </div>
						                    </div>
						                    <!-- /.widget-body -->
					                    </div>
				                    </div>
			                    </div>
                            </center>
                        <?php } ?>
		            </div>
		        </section>
	        </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
    function validatepayment(form) {
        if(!(/^[0-9\-]+$/.test($("#paymentphone").val()))) {
            $("#invalidpaymentdetails").html('Please enter valid mobile no.');
            $("#invalidpaymentdetails").css("display", "block");
            return false;
        }
        if($("#paymentphone").val().length != 10) {
            $("#invalidpaymentdetails").html('Please enter valid mobile no.');
            $("#invalidpaymentdetails").css("display", "block");
            return false;
        }    
        $.ajax({
            url: form.action,
            type: form.method,
            data: $(form).serialize(),
            success: function(response) {
                alert("resp");
                $("#paymentpage").html(response);
            }            
        });
        return false;
    }
</script>