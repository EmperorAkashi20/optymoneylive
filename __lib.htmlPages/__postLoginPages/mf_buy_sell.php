<?php
    //print_r($_REQUEST);
?>
<div class="main-content">
				<div class="main-content-inner">
					<!-- #section:basics/content.breadcrumbs -->
					<!-- <div class="breadcrumbs ace-save-state" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="?module_interface=<?php //echo $commonFunction->setPage('home');?>">Home</a>
							</li>
							<li class="active">Buy Mutual Fund</li>
						</ul>
						<?php //include("mdocs.lib.htmlPages/form.search.php");?>
                    </div> -->
                    <nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="<?php echo $CONFIG->siteurl; ?>mySaveTax/">Home</a>
							</li>
							<li class="active">Buy Mutual Fund</li>
						</ol><!-- /.breadcrumb -->
						<?php //include("mdocs.lib.htmlPages/form.search.php");?>

						<!-- /section:basics/content.searchbox -->
                    </nav>
					<div class="page-content">						
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
                                    <div class="space-6"></div>
                                    <!-- <div class="row"> -->
                                            <?php

                                            $getAllNAV = $buySell->getAllRecomendedNAV();
                                            if (count($getAllNAV) == 0) {
                                                echo $fileHTML = '<tr><td class="center red" colspan="9"> No Row(s) Found.</td></tr>';
                                            } else {
                                                $i = 0;
                                                while (list($logKey, $logVal) = each($getAllNAV)) {
                                                    $mfPrice = $buySell->getNAVAllPrices($logVal[fr_nav_id]);
                                                    //print_r($mfPrice);
                                                    if ($mfPrice[0][net_asset_value] > $mfPrice[1][net_asset_value]) {
                                                        $arrow = 'success';
                                                        $n = $mfPrice[0][net_asset_value] - $mfPrice[1][net_asset_value];
                                                        $pn = $n / $mfPrice[1][net_asset_value] * 100;
                                                    } else {
                                                        $arrow = 'important';
                                                        $n = $mfPrice[1][net_asset_value] - $mfPrice[0][net_asset_value];
                                                        $pn = $n / $mfPrice[1][net_asset_value] * 100;
                                                    } ?>	
                                            <div class="col-xs-4">
                                                <div class="search-area well no-margin-bottom" style="min-height:150px;">												
                                                    <div class="row">
                                                        <div class=""  style="margin:5px;"><div class="infobox pull-right" style="width:90px; background-color:#F5F5F5;"><div class="stat stat-<?php echo $arrow; ?>"><?=number_format($pn, 2); ?>%</div></div>
                                                            <h5 class="search-title">
                                                                <?php echo $logVal['scheme_name']; ?>
                                                            </h5>                                             
                                                        </div>
                                                        <code title="Scheme Code"><?php echo $logVal['scheme_code']; ?></code>  
                                                        <code title="ISIN"><?php echo $logVal['isin']; ?></code>
                                                        <code title="Scheme Type"><?php echo $logVal['scheme_type']; ?></code>                         
                                                    </div>												
                                                    <div class="space space-2"></div>
                                                    <span class="green">Minium Purchase Amount - &#x20b9; <?php echo $logVal['minimum_purchase_amount']; ?></span>&nbsp;&nbsp;&nbsp;
                                                    <span class="orange"></span>
                                                    <div class="space space-2"></div>
                                                    <!-- <span class="orange"><strong>Repurchase Price - &#x20b9; <?php //echo $logVal['repurchase_price']; ?></strong></span> -->
                                                    <span class="orange"><strong>Net Asset Value - &#x20b9; <?php echo $logVal['net_asset_value']; ?></strong></span>&nbsp;&nbsp;&nbsp;
                                                    <!-- <span class="orange"><strong>Sale Price - &#x20b9; <?php //echo $logVal['sale_price']; ?></strong></span> -->
                                                    <div class="space space-2"></div>
                                                    <label class="pull-right">
                                                        <span class="label label-success">
                                                            <a href="#<?php echo str_replace(' ', '_', $logVal['scheme_name']); ?>" title="<?php echo $logVal['scheme_name']; ?>" data-toggle="modal" id="<?php echo $logVal[pk_nav_id]; ?>" class="white" data-target="#edit-modal"><strong>Buy Now</strong></a>
                                                        </span>
                                                    </label>
                                                    <div class="space space-4"></div>
                                                </div>
                                            </div>
                                        
                                        

                                            <?php
                                                                ++$i;
                                                    if ($i == 3) {
                                                        echo '</div><div class="space-6"></div><div class="row">';
                                                        $i = 0;
                                                    }
                                                }
                                            }
                                            ?>  
                                    <!-- </div> -->
                               
                               

                               

                                </div>                                  
                            </div>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.page-content -->
</div>


<div id="edit-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form class="form-horizontal" action="../ajax-request/place_order.php" method="POST" onSubmit="placeBSEOrder(this);return false;" id="BSEOrder">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #2c3e50; color:#FFFFFF;">

                    

                    <h4 class="modal-title" id="myModalLabel"><img src="<?php echo $CONFIG->staticURL.$CONFIG->theme; ?>img/formsubmitpreloader.gif"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color:#FFFFFF;">&times;</button>

                </div>           
                    <div class="modal-body edit-content">
                        <img src="<?php echo $CONFIG->staticURL.$CONFIG->theme; ?>img/formsubmitpreloader.gif">
                    </div>          
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Place Order</button>
                </div>
            </div>
        </div>
    </form>
</div>