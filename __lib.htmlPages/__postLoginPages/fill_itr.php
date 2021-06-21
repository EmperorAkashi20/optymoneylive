<?php
    //echo "<pre>";
    //print_r($_SESSION);
    //print_r($_REQUEST);
    //$CONFIG->customerId
    //$CONFIG->currentAY = $_REQUEST[ay]."-".(1+$_REQUEST[ay]);
    $current_yr = date("Y");
    $current_ay = $current_yr."-".($current_yr + 1); 

    $documentFiles->trfrFrm16DataToMainDB($_SESSION[$CONFIG->sessionPrefix.'_ITR_ID']);
    $ayYears = explode('-', $current_yr);

?>
<div class="main-content">
				<div class="main-content-inner">
                    
					<!-- /section:basics/content.breadcrumbs -->
					<div class="page-content">	
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li>
                                    <i class="ace-icon fa fa-home home-icon"></i>
                                    <a href="<?php echo $CONFIG->siteurl; ?>mySaveTax/">Home</a>
                                </li>
                                <li class="active">ITR</li>
                            </ol><!-- /.breadcrumb -->
                            <?php //include("mdocs.lib.htmlPages/form.search.php");?>

                            <!-- /section:basics/content.searchbox -->
                        </nav>											
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="widget-box transparent">
                                    <div class="widget-header widget-header-flat">
                                        <h4 class="widget-title orange">
                                            <!-- <i class="ace-icon fa fa-file-o green"></i> -->
                                            Assessment Year
                                        </h4>                                                     
                                    </div>
                                </div><!-- /.widget-box -->
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                        <div class="row">
                            <div class="col-xs-12">
                            	<div class="space-8"></div>
                                    <div class="widget-box">
                                        <div class="widget-header widget-header-flat">
                                            <h4 class="widget-title">Choose Assessment Year</h4>
                                        </div>
                                        <div class="widget-body">
                                            <div class="widget-main">  
<!-- <form method="post" action="?module_interface=<?php //echo $commonFunction->setPage('pay/itr_payment');?>"> -->
<!-- <form method="post" action="?module_interface=<?php  //echo $commonFunction->setPage('itr_forms'); ?>"> -->
    <form method="post" autocomplete="off" action="../ajax-request/ajax_response.php?action=check_pan">
                                                <div class="row">
                                                    <div id="task-tab" class="tab-pane active col-xs-9">
                                                        <ul id="tasks" class="item-list">
                                                            <li class="item-orange clearfix">
<div class="body">
	<div class="name">
		<input type="hidden" name="new" class="ace" checked value="1" />
    	<input type="radio" name="ay" class="ace" checked value="<?php echo $ayYears[0]; ?>" />
        <span class="lbl"> <strong>A.Y. <?php echo $current_ay; ?></strong></span></a>
	</div>

	<div class="text">
    	<span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;The Financial Year (F.Y.) is <span >
		<strong><?php echo($ayYears[0] - 1).'-'.$ayYears[0]; ?></strong></span>
         , which starts from <strong>01/04/<?php echo $ayYears[0] - 1; ?></strong> and ends on 
         <strong>31/03/<?php echo $ayYears[0]; ?></strong> </span>
    </div>
</div>
														    </li>
								
															</ul>
														</div>
													</div><br>
                                <div class="row">
                                <div class="pansection">
                                    <?php

                                    ?>    
                                
                                    <p>&nbsp;&nbsp;Please Enter Your Pan: <input type="pan" class="form-control" id="pancheck" name="pan" placeholder="Enter Your Pan Number" required data-validation="PAN">
                                        <?php
                                        if($_SESSION['pan_error'] == 1) {
                                        ?>
                                        <span style="color:red "><?php echo $_SESSION['pan_check_status']; ?></span></p>
                                        <?php
                                        unset($_SESSION['pan_error']);
                                        unset($_SESSION['pan_check_status']);
                                        }
                                        ?><br><br>
                                        
                                    <!-- <p>&nbsp;&nbsp;Do you wish to continue? Please click the button to make the payment &nbsp;&nbsp; -->
								<button id="loading-btn" type="submit" class="btn btn-success" data-loading-text="Loading...">&nbsp;&nbsp;Save & Continue&nbsp;&nbsp;</button>
                                <!-- <button id="loading-btn" type="submit" class="btn btn-success" data-loading-text="Loading...">&nbsp;&nbsp;Make Payment&nbsp;&nbsp;</button> -->
                                </p>
                                </div>
                                </div>
</form>
												</div>
											</div>
									</div>
                            </div>
                      </div>
					</div>
				</div>
			</div>
            
<style type="text/css">
                .pansection{
                    margin-left:15px;
                }
            </style>