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
							<li class="active">Uploaded Forms</li>
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
													Uploaded Forms
												</h4>   
                                                <div class="pull-right"><a href="?module_interface=<?php echo $commonFunction->setPage('forms_upload');?>">Upload New</a></div>                                             
											</div>
											<div class="widget-body">
												<div class="widget-main no-padding">
													<table class="table table-bordered table-striped">
														<thead class="thin-border-bottom">
															<tr>
																<th>
																	<i class="ace-icon fa fa-caret-right blue"></i>File Name
																</th>																
																<th>
																	<i class="ace-icon fa fa-caret-right blue"></i>Assessment Year 
																</th>
                                                                <th>
																	<i class="ace-icon fa fa-caret-right blue"></i>ITR Status  
																</th>
																<th class="hidden-480">
																	<i class="ace-icon fa fa-caret-right blue"></i>Date
																</th>
															</tr>
														</thead>
                                                        <tbody>
<?php
	$logCount = $documentFiles->allUploadedFilesCount($CONFIG->customerId);
	$logList = $documentFiles->getAllFiles($CONFIG->customerId);
	if($logCount == 0 || $logCount == '')
		echo $fileHTML = '<tr><td class="center red" colspan="3"> No File(s) Found.</td></tr>';
	else
	{
		while(list($logKey,$logVal) = each($logList))
		{
			$formID = $documentFiles->getFormIdOfFile($logVal[pk_upload_id]);
?>														
    <tr>
        <td><a href="../getMyFiles/<?php echo $CONFIG->customerId;?>/<?php echo $logVal[file_name]; ?>" target="_blank"><?php echo $logVal[file_name]; ?></td>
        <td>
            <b class="green"><?php echo $formID[assessment_year];?></b>
        </td>
         <td>
            <b class="green"><a href="?formsDataID=<?php echo $formID[pk_form_id]; ?>&module_interface=<?php echo $commonFunction->setPage('process_forms');?>">Pending</a></b>
        </td>
        <td class="hidden-480">
            <span class="label label-info arrowed-right arrowed-in"><?php echo $commonFunction->dateFormatWithTime($logVal[upload_date]); ?></span>
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