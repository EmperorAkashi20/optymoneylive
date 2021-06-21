<?php
	include("../__lib.includes/config.inc.php");
	if(!($_SESSION['oPageAccess'])) { header("HTTP/1.1 401 Unauthorized");header("Location: $CONFIG->siteurl");exit;}
	
	//print_r($_SESSION);//echo $CONFIG->loggedUserId; print_r($_POST);	//
	//print_r($_REQUEST);	
	//echo "<pre>";
	$navDetails1 = $buySell->getSingleNAVDetails($_REQUEST['MFID']);
	
	$navDetails = $navDetails1['MF_DETAILS'];
	$navPrice = $navDetails1['MF_PRICE'];	
	$price = $navPrice[0][net_asset_value];
	//print_r($navPrice);
?>
<div class="row">
   
</div>
<div class="row">
 	<div class="col-xs-5 pull-right">
    	<code> Min. Buy Amount - &#x20b9; <?php echo $navDetails[0]['minimum_purchase_amount'];?></code><br />
        <code title="Scheme Code">Scheme Code - <?php echo $navDetails[0]['scheme_code'];?></code><br />
        <code title="ISIN">ISIN - <?php echo $navDetails[0]['isin'];?></code><br />
        <code title="Scheme Type">Scheme Type - <?php echo $navDetails[0]['scheme_type'];?></code><br />        
        <code> <strong>Asset Value - &#x20b9; <?php echo $price;?></strong></code>   
    </div>
    <div class="col-xs-7">          
         
       <div class="form-group">
          <label class="control-label col-sm-4" for="">Payment Option</label>
          <div class="col-sm-8 .form-group">            
             <input type="radio" name="pay_option" checked="checked" value="one_time"> <label style="margin-top: 5px">One Time</label>
             <input type="radio" name="pay_option" value="monthly"> <label style="margin-top: 5px">Monthly</label>
          </div>
        </div>    
          
        <div class="form-group">
          <label class="control-label col-sm-4" for="">Amount (&#x20b9;)</label>
          <div class="col-sm-8">            
         <input name="nav_amount" id="nav_amount" type="text" value="" placeholder="&#x20b9;<?php echo $navDetails[0]['minimum_purchase_amount'];?>" class="required" />
         <input name="jsAMT" id="jsAMT" type="hidden" value="<?php echo $navDetails[0]['minimum_purchase_amount'];?>" />
         <input name="nav_id" id="nav_id" type="hidden" value="<?php echo $navDetails[0]['pk_nav_id'];?>" />
            <em id="nav_error" class="red" style="display:none;">Amount can't be less than min. buy amount</em>
          </div>
        </div>           
    </div> 
    <div class="col-xs-12 hide" id="bse_order_response"></div>       
    <div class="col-xs-12 hide" id="bse_order_loading">
              <div id="fetchProgressbar" class="ui-progressbar ui-widget ui-widget-content ui-corner-all progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="87">
                <div id="fetchProgressbarInner" class="ui-progressbar-value ui-widget-header ui-corner-left progress-bar progress-bar-success" style="width: 77%;"><strong>Submitting Order .....</strong></div>
              </div>
            </div>
  </div>