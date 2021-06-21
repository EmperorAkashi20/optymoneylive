<style>
.card-header:first-child {
    border-radius: calc(0.25rem - 1px) calc(0.25rem - 1px) 0 0;
}
.card-header {
    background-color: rgba(0, 0, 0, 0.03);
    border-bottom: 1px solid rgba(0, 0, 0, 0.125);
    margin-bottom: 0;
    padding: 0.75rem 1.25rem;
}
.bs-component .card {
margin-bottom: 1rem;
}
.text-white {
color: #fff !important;
}
.mb-3, .my-3 {
margin-bottom: 1rem !important;
}
.bg-primary {
/*background-color: #2c3e50 !important;*/
}
.card {
background-clip: border-box;
background-color: #fff;
border: 1px solid rgba(0, 0, 0, 0.125);
border-radius: 0.25rem;
display: flex;
flex-direction: column;
min-width: 0;
position: relative;
word-wrap: break-word;
}
</style>    
<div class="main-content">
	<div class="main-content-inner">
		<!-- <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="?module_interface=<?php //echo $commonFunction->setPage('home');?>">Home</a>
                </li>
                <li class="active">Buy Mutual Fund</li>
            </ul>
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
                <div class="space-6"></div>
                    <div class="col-xs-12">
                    <?php
                    $getAllOffer = $mutualFund->offerList();
                    if (count($getAllOffer) == 0) {
                    } else {
                        while (list($offerKey, $offerVal) = each($getAllOffer)) {
                            $commaSeperatedNavId = $offerVal[offer_nav];
                    ?>        
            
                        <div class="card text-white bg-primary mb-3">
                            <div class="card-header"><strong style="background-color:#3399FF;"><?php //echo $offerVal[offer_name];?></strong></div>
                                <div class="card-body" style="background-color:#FFFFF;">
                                    <div class="space-6"></div>
                                    <?php
                                        echo '<div class="row"><div class="col-xs-12">';
                            $getAllNAV = $buySell->getAllOfferedNAV($commaSeperatedNavId);

                            $i = 0;
                            while (list($logKey, $logVal) = each($getAllNAV)) {
                                $mfPrice = $buySell->getNAVAllPrices($logVal[pk_nav_id]);
                                if ($mfPrice[0][net_asset_value] > $mfPrice[1][net_asset_value]) {
                                    $arrow = 'success';
                                    $n = $mfPrice[0][net_asset_value] - $mfPrice[1][net_asset_value];
                                    $pn = $n / $mfPrice[1][net_asset_value] * 100;
                                } else {
                                    $arrow = 'important';
                                    $n = $mfPrice[1][net_asset_value] - $mfPrice[0][net_asset_value];
                                    $pn = $n / $mfPrice[1][net_asset_value] * 100;
                                }
                                        ?>	
                                    <div class="col-xs-4">
                                        <div class="search-area well no-margin-bottom" style="min-height:150px;">												
                                                <div class="row">
                                                    <div class="" style="margin:5px;" ><div class="infobox pull-right" style="width:90px;">
                                                        <div class="stat stat-<?php echo $arrow; ?>"><?=number_format($pn, 2); ?>%</div></div>
                                                        <h5 class="search-title" style="color:#000000;" >
                                                            <?php echo $logVal['scheme_name']; ?>
                                                        </h5>                                                     
                                                    </div>
                                                    <code title="Scheme Code"><?php echo $logVal['scheme_code']; ?></code>  
                                                    <code title="ISIN"><?php echo $logVal['isin']; ?></code>
                                                    <code title="Scheme Type"><?php echo $logVal['scheme_type']; ?></code> 
                                                </div>												
                                            <div class="row">
                                                <code> Min. Purchase Amount1 - &#x20b9; <?php echo $logVal['minimum_purchase_amount']; ?></code>               	 	
                                            </div>
                                            <div class="space space-2"></div>
                                            <span class="red pull-left"><strong>Asset Value - &#x20b9; <?php echo $mfPrice[0]['net_asset_value']; ?></strong></span>
                                            <label class="pull-right">                	
                                                <span class="label label-success">
                                                <a href="#<?php echo str_replace(' ', '_', $logVal['scheme_name']); ?>" title="<?php echo $logVal['scheme_name']; ?>" data-toggle="modal" id="<?php echo $logVal[pk_nav_id]; ?>" class="white" data-target="#edit-modal"><strong>Buy Now</strong></a>
                                                    <i class="ace-icon fa fa-arrow-right icon-on-right"></i>
                                                </span> 
                                            </label>
                                            <div class="space space-4"></div>
                                        </div>
                                    </div>
                
                                    <?php
                                                ++$i;
                                if ($i == 3) {
                                    echo '</div></div><div class="space-6"></div><div class="row"><div class="col-xs-12">';
                                    $i = 0;
                                }
                            }
                                    ?>
                            </div>
                        </div><br />
                    </div>		
            </div>
            <?php
                        }
                    }
            ?>
        </div>
    </div>
</div>
<div id="edit-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form class="form-horizontal" action="../ajax-request/place_order.php" method="POST" onSubmit="placeBSEOrder(this);return false;" id="BSEOrder">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #2c3e50; color:#FFFFFF;">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color:#FFFFFF;">&times;</button>
                <h4 class="modal-title" id="myModalLabel"><img src="<?php echo $CONFIG->staticURL.$CONFIG->theme; ?>img/formsubmitpreloader.gif"></h4>
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