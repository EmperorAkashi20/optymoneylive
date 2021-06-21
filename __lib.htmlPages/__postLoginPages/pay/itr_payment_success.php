
<div class="main-content">
    <div class="main-content-inner">
        <nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="<?php echo $CONFIG->siteurl; ?>mySaveTax/">Home</a>
							</li>
							<li class="active">Payment</li>
						</ol><!-- /.breadcrumb -->
						<?php //include("mdocs.lib.htmlPages/form.search.php");?>

						<!-- /section:basics/content.searchbox -->
        </nav>
        <div class="card">
            <div class="card-body">
                <div id="page-content">
           <center>
           <?php
            if ($_REQUEST['response_code'] == 0) {
                ?>
            <form class="loginForm" role="form" method="post"
                    action="?module_interface=<?php  echo $commonFunction->setPage('itr_forms'); ?>"
									name="payment_frm"
									accept-charset="UTF-8" id="login-nav">

                

                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-10 col-md-offset-1">
                        <div class="widget-box transparent">
                            <div class="widget-body">
                                <div class="widget-main no-padding">
                                <p><strong><?php echo $_REQUEST['response_code']; ?></strong></p>
                                    <h4><center>Thank you for Filing ITR with us</center><br> <center><span class="span-end"></span></center></h4>
                                    <p>Your account has been charged and your transaction is successful. <br>Your transaction ID is : <?php echo $_REQUEST['transaction_id']; ?><br>Your paid amount is :<?php echo $_REQUEST['amount']; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clearfix">
                    <button id="paymentFrm" name="loginFrm" type="submit"
                        class="width-35 pull-center btn btn-sm btn-success">
                        <i class="ace-icon fa fa-key"></i> <span class="bigger-110">Proceed to filing ITR</span>
                    </button>
                </div>
            </form>
            <?php
            } else {
                ?>
                <form class="loginForm" role="form" method="post"
                    action="?module_interface=<?php  echo $commonFunction->setPage('fill_itr'); ?>"
									name="payment_frm"
									accept-charset="UTF-8" id="login-nav">
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-10 col-md-offset-1">
                            <div class="widget-box transparent">
                                <div class="widget-body">
                                        <div class="widget-main no-padding">
                                            <h4><center>WE COULDN'T PROCESS YOUR PAYMENT</center><br> <center><span class="span-end"></span></center></h4>
                                            <br>Your transaction ID is : <?php echo $_REQUEST['transaction_id']; ?>
                                            <p>Unfortunately, we couldn't collect your payment on filing the ITR. Please Retry. </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix">
                        <button id="PaymentBk" name="loginFrm" type="submit"
                            class="width-35 pull-center btn btn-sm btn-success">
                            <i class="ace-icon fa fa-key"></i> <span class="bigger-110">Back</span>
                        </button>
                    </div>
                </form>
            <?php
            } ?>
            </center>
        </div>
        

        <?php
            $tbname = ' bfsi_users_settings';
            $dataarray = array(
                'pay_status' => 1,
                'pay_date' => $_REQUEST['payment_datetime'],
                'paid_amount' => $_REQUEST['amount'],
                'txn_id' => $_REQUEST['transaction_id'],
            );
            $commonFunction->dynamicUpdatePay($tbname, $dataarray);
        ?>
	</div>
</div>
        </div>
    </div>

