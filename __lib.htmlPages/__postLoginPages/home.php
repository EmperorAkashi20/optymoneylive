<?php
    //print_r($_REQUEST);
?>
<div class="main-content">
				<div class="main-content-inner">
                				
					<div class="page-content">
                    <nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li breadcrumb-item>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="<?php echo $CONFIG->siteurl; ?>mySaveTax/">Home</a>
							</li>
							<li class="active">Dashboard</li>
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
								<!-- PAGE CONTENT BEGINS -->	<?php /* ?>
                                <div class="row">
                                    <div class="space-6"></div>
                                    <div class="col-sm-12 infobox-container">
                                        <div class="widget-box">
                                            <div class="widget-header widget-header-flat widget-header-small">
                                                <h5 class="widget-title pull-left orange">
                                                    <i class="ace-icon fa fa-search green"></i>
                                                    Search
                                                </h5>
                                            </div>
                                            <div class="widget-body">
                                                <div class="widget-main">
                                                    <!-- #section:plugins/charts.flotchart -->
                                                   <!-- <form class="form-search" method="get" action="?module_interface=<?php echo $commonFunction->setPage('mf_buy_sell');?>" id="searchForm" name="searchForm">
                                                   <input type="hidden" name="module_interface" id="module_interface" value="<?php echo $commonFunction->setPage('mf_buy_sell');?>" />
                                                    <div class="input-group input-group-lg">
                                                        <span class="input-group-addon">
                                                            <i class="ace-icon fa fa-check"></i>
                                                        </span>

                                                            <input type="text" placeholder="Type your query" class="form-control search-query" id="search_input" name="search_input">
                                                                    <span class="input-group-btn">
                                                                        <button class="btn btn-success btn-lg" type="submit">
                                                                            <span class="ace-icon fa fa-search icon-on-right bigger-110"></span>
                                                                            Search
                                                                        </button>
                                                                    </span>
                                                                </div>		<div id="email-error" class="help-block"></div>
                                                </form>--></div><!-- /.widget-main -->
                                            </div><!-- /.widget-body -->
                                        </div><!-- /.widget-box -->
                                    </div>
                                    <div class="vspace-12-sm"></div>
                                    <div class="col-sm-5 hide">
                                        <div class="widget-box">
                                            <div class="widget-header widget-header-flat widget-header-small">
                                                <h5 class="widget-title orange">
                                                    <i class="ace-icon fa fa-signal green"></i>
                                                    Usages Details
                                                </h5>
                                            </div>
                                            <div class="widget-body">
                                                <div class="widget-main">
                                                    <!-- #section:plugins/charts.flotchart -->
                                                    <div id="piechart-placeholder"></div>
                                                </div><!-- /.widget-main -->
                                            </div><!-- /.widget-body -->
                                        </div><!-- /.widget-box -->
                                    </div><!-- /.col -->
                                </div><!-- /.row -->

                                <!-- #section:custom/extra.hr -->
                                <div class="hr hr32 hr-dotted"></div><?php */ ?>

								<!-- /section:custom/extra.hr -->
								<div class="row">
									<div class="col-sm-12">
										<div class="widget-box transparent">
											<div class="widget-header widget-header-flat">
												<h4 class="widget-title orange">
													<!-- <i class="ace-icon fa fa-file-o green"></i> -->
													Latest Uploaded Forms
												</h4>

												<!-- <div class="widget-toolbar">
													<a href="#" data-action="collapse">
														<i class="ace-icon fa fa-chevron-up"></i>
													</a>
												</div> -->
											</div>

											<div class="widget-body">
												<div class="widget-main no-padding">
													<table class="table table-bordered table-striped">
														<thead class="thin-border-bottom">
															<tr>		
																<th>
																	<i class="ace-icon fa fa-caret-right blue"></i>PAN Number
																</th>															
																<th>
																	<i class="ace-icon fa fa-caret-right blue"></i>Assessment Year
																</th>
																<th class="hidden-480">
																	<i class="ace-icon fa fa-caret-right blue"></i>ITR Status
																</th>
                                                                <th class="hidden-480">
																	<i class="ace-icon fa fa-caret-right blue"></i>Action
																</th>                                                                
																<th class="hidden-480">
																	<i class="ace-icon fa fa-caret-right blue"></i>Upload Date
																</th>
                                                                <th class="hidden-480">
                                                                    <i class="ace-icon fa fa-caret-right blue"></i>ITR V
                                                                </th>

															</tr>
														</thead>
                                                        <tbody>
<?php
    $totalFiles = $itrFill->getAllEfillingCount();
    $fileList = $itrFill->getAllEfilling();

    //echo "totalFiles".$totalFiles;
   //  echo "<br>";
   // print_r($fileList);

    if ($totalFiles == 0) {
        echo $fileHTML = '<tr><td class="center red" colspan="5"> No File(s) Found.</td></tr>';
    }
     else 
    {
        while (list($fileKey, $fileVal) = each($fileList)) {
            /*----------------------------------- 20190525-BSEN -------------------------------------*/

            $arr = explode('-', $fileVal[asses_year]); ?>														
    <tr>
        <td>
            <b class="green"><?php echo $fileVal['itr_pd_pan_number']; ?></b>
        </td>	
        <td>
            <b class="green"><?php echo $fileVal[asses_year]; ?></b>
        </td>
         <td>
         	<?php
             if ($fileVal[itr_status] == '0' || $fileVal[itr_status] == '') 
             {
                 ?> 
            <b class="green"><a style="color:orange" href="?ay=<?php echo $arr[0]; ?>&formsDataID=<?php echo $fileVal[pk_itr_id]; ?>&itrStatus=<?= $fileVal[itr_status]; ?>&module_interface=<?php echo $commonFunction->setPage('middle_layer_redirection'); ?>">Pending &nbsp;(Click here to continue)</a></b>
            <?php
             } 
             elseif ($fileVal[itr_status] == '1') 
             {
                 echo 'ITR Filed';
             } ?>
        </td>
         <td>
           
            
            <?php

            if ($fileVal[itr_status] == '0' || $fileVal[itr_status] == '') {
                ?>
             <span>
              <a class="white1" href="?action=remove&itr_id=<?php echo $fileVal[pk_itr_id]; ?>&user_id=<?php echo $fileVal[fr_user_id]; ?>&ay=<?php echo $arr[0]; ?>&module_interface=<?php echo $commonFunction->setPage('middle_layer_redirection'); ?>">Reset Data & Fresh Start</a>
             </span>
           <?php
            } else {
                ?>
           <a href="?ay=<?php echo $arr[0]; ?>&formsDataID=<?php echo $fileVal[pk_itr_id]; ?>&itrStatus=<?= $fileVal[itr_status]; ?>&module_interface=<?php echo $commonFunction->setPage('middle_layer_redirection'); ?>"><?php if ($fileVal[itr_status] == '0') {
                    echo 'Pending &nbsp;(Click here to continue)';
                } elseif ($fileVal[itr_status] == '1') {
                    echo 'Click here to view';
                } ?></a>
           
           <?php
            } ?>
           
        </td>
        <td class="hidden-480">
            <span><?php echo $commonFunction->dateFormatWithTime($fileVal[form_created_date]); ?></span>
        </td>        
 <td class="hidden-480">
<?php 
if(!empty($fileVal['itr_v']))
{

?>
<a href="<?php echo $CONFIG->siteurl.$CONFIG->userFilesitrURL.$fileVal['itr_v'];?>" target="_blank" >download</a>
     </td>

<!--     <?php echo $fileVal[itr_v] ;?>-->

<?php
}
      
?>




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

<style type="text/css">
    a.white1 {
    color: #212529;
    font-weight: 700;
    font-size: 14px;
    padding-left: 12px;
}
.green{
    padding-left: 12px;
}
</style>