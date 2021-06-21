<?php
	//print_r($_REQUEST);
	//$CONFIG->customerId
?>
<div class="main-content">
				<div class="main-content-inner">
					<!-- #section:basics/content.breadcrumbs -->
					<div class="breadcrumbs ace-save-state" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="<?php echo $CONFIG->siteurl;?>mySaveTax">Home</a>
							</li>
							<li class="active">Activities</li>
						</ul><!-- /.breadcrumb -->
						<?php include("form.search.php");?>

						<!-- /section:basics/content.searchbox -->
					</div>

					<!-- /section:basics/content.breadcrumbs -->
					<div class="page-content">						
						<div class="row">
							<div class="col-xs-12">

								<!-- /section:custom/extra.hr -->
								<div class="row">
									<div class="col-xs-12">
										<div class="widget-box transparent">
											<div class="widget-header widget-header-flat">
												<h4 class="widget-title orange">
													<i class="ace-icon fa fa-file-o green"></i>
													Account Logs
												</h4>                                                
											</div>
											<div class="widget-body">
												<div class="widget-main no-padding">
													<table class="table table-bordered table-striped">
														<thead class="thin-border-bottom">
															<tr>
																<th>
																	<i class="ace-icon fa fa-caret-right blue"></i>Username
																</th>																
																<th>
																	<i class="ace-icon fa fa-caret-right blue"></i>Description
																</th>
																<th class="hidden-480">
																	<i class="ace-icon fa fa-caret-right blue"></i>Date
																</th>
															</tr>
														</thead>
                                                        <tbody>
<?php
	$logCount = $customerLog->logCount($CONFIG->customerId);
	$logList = $customerLog->getAllLogs($CONFIG->customerId);
	if($logCount == 0 || $logCount == '')
		echo $fileHTML = '<tr><td class="center red" colspan="3"> No Log(s) Found.</td></tr>';
	else
	{
		while(list($logKey,$logVal) = each($logList))
		{
			$username = $customerProfile->getCustomerName($logVal[fr_user_id]);
?>
														
															<tr>
																<td><?php echo $username; ?></td>
																<td>
																	<b class="green"><?php echo $logVal[acitivity_description]; ?></b>
																</td>
																<td class="hidden-480">
																	<span class="label label-info arrowed-right arrowed-in"><?php echo $commonFunction->dateFormatWithTime($logVal[activity_created_date]); ?></span>
																</td>
                                                                
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