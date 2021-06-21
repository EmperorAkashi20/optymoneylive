<?php
    //print_r($_REQUEST);
?>
<div class="main-content">
				<div class="main-content-inner">
					<div class="page-content">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb">
								<li>
									<i class="ace-icon fa fa-home home-icon"></i>
									<a href="<?php echo $CONFIG->siteurl; ?>mySaveTax/">Home</a>
								</li>
								<li class="active">Payment history</li>
							</ol><!-- /.breadcrumb -->
							<?php //include("mdocs.lib.htmlPages/form.search.php");?>

							<!-- /section:basics/content.searchbox -->
						</nav>						
						<div class="row">
							<div class="col-xs-12">
              <?php
                    if ($_SESSION['msg_strip'] != '') {
                        ?>              
                        <div class="alert alert-danger">
                            <button data-dismiss="alert" class="close" type="button">
                                <i class="ace-icon fa fa-times"></i>
                            </button>                        
                            <strong>
                                <i class="ace-icon fa fa-times"></i>
                                Oh!
                            </strong>                        
                           <?php echo $_SESSION['msg_strip']; ?>
                            <br>
                        </div>
             <?php

                    $_SESSION['msg_strip'] = '';
                    }
            ?>                   
								<div class="row">
									<div class="col-sm-12">
										<div class="widget-box transparent">
											<div class="widget-header widget-header-flat">
												<div class="widget-toolbar">
													<a href="#" data-action="collapse">
														<i class="ace-icon fa fa-chevron-up"></i>
													</a>
												</div>
											</div>

											<div class="widget-body">
												<div class="widget-main no-padding">
													<table class="table table-bordered table-striped">
														<thead class="thin-border-bottom">
															<tr>		
                                                                <th>Payment Date</th>
                                                                <th>Payment made for</th>
                                                                <th>Transaction Id</th>
                                                                <th>Amount</th>
                                                                <th>Status</th>
                                                                <th>Currency</th>
															</tr>
														</thead>
                                                        <tbody>
<?php
    $totalRec = $payment->getPaymentCount();
    $Result = $payment->getPaymentDetails('bfsi_users_settings');

    if ($totalRec == 0) {
        echo $fileHTML = '<tr><td class="center red" colspan="7"> No File(s) Found.</td></tr>';
    } else {
        while (list($fileKey, $fileVal) = each($Result)) {
            /*----------------------------------- 20190525-BSEN -------------------------------------*/ ?>													
    <tr>
        <td>
        <span class="label label-info arrowed-right arrowed-in"><?php echo $commonFunction->dateFormatWithTime($fileVal[pay_date]); ?></span>
        </td>	
        <td>
            <b class="green"><?php echo $fileVal[pay_for]; ?></b>
        </td>
         <td><?php echo $fileVal[txn_id]; ?></td>
        <td class="hidden-480"> <?php echo $fileVal[paid_amount]; ?></td>        
        <td class="hidden-480"><?php if ($fileVal[pay_status] == 1) {
                echo 'Success';
            } elseif ($fileVal[pay_status] == 0) {
                echo 'Failed';
            } ?></td>        
        <td class="hidden-480">INR</td>        
    </tr>
<?php
        }
    }
?>

														</tbody>
													</table>
												</div><!-- /.widget-main -->
											</div><!-- /.widget-body -->
										</div><!-- /.widget-box -->
									</div><!-- /.col -->

									<!-- /.col -->
								</div><!-- /.row -->

								<div class="hr hr32 hr-dotted"></div>

								<!-- /.row -->

								<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			</div>