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
							<li class="active">ITR eFilling</li><li class="active">Upload New Form</li>
						</ul>
					</div>
					<!-- /section:basics/content.breadcrumbs -->
					<div class="page-content">												
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="widget-box transparent">
                                    <div class="widget-header widget-header-flat">
                                        <h4 class="widget-title orange">
                                            <i class="ace-icon fa fa-file-o green"></i>
                                            Upload Form 16
                                        </h4>                                                     
                                    </div>
                                </div><!-- /.widget-box -->
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                        <div class="row">
                            <div class="col-xs-12">
                            	<div class="col-xs-3">
                                     <div id="container" style="margin-top:10px;">
                                        <a id="pickfiles" href="#" class="btn btn-success">Select Form 16</a>				
                                    </div>
                                    <div id="filelist"></div>
                                </div>
                                <div class="col-xs-9 hide" id="form_text">                                	
                                    <input type="hidden" name="form_data_id" id="form_data_id" value="" />
                                    <div id="fetchProgressbar" class="ui-progressbar ui-widget ui-widget-content ui-corner-all progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="87"><div id="fetchProgressbarInner" class="ui-progressbar-value ui-widget-header ui-corner-left progress-bar progress-bar-success" style="width: 77%;"><strong>Fetching all the data from uploaded files.....</strong></div></div>
                                    </div>
                            </div>
                      </div>
					</div><!-- /.page-content -->
				</div>
			</div>