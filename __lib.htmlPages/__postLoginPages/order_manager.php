<?php
    //echo "<pre>";print_r($_SESSION);
    //$bankInfo = $customerProfile->getCustomerBankInfo();
    //print_r($bankInfo);
    //$mutualFund->updatePrice();
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
                <li class="active">BSE Orders</li><li class="active">List Orders</li>
            </ul>
            <?php //include 'form.search.php';?>           
        </div> -->
        <nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="<?php echo $CONFIG->siteurl; ?>mySaveTax/">Home</a>
							</li>
							<li class="active">BSE Orders</li><li class="active">List Orders</li>
						</ol><!-- /.breadcrumb -->
						<?php //include("mdocs.lib.htmlPages/form.search.php");?>

						<!-- /section:basics/content.searchbox -->
                    </nav>
        <div class="page-content">						
            <div class="row">
                <div class="col-xs-12">
                    <div class="row">
<table class="table table-bordered table-striped">
    <thead class="thin-border-bottom">
        <tr>																
            <th>
                <i class="ace-icon fa fa-caret-right blue"></i>Customer Name 
            </th>
        <!--     <th>
                <i class="ace-icon fa fa-caret-right blue"></i>Order No.
            </th> -->
            <th class="hidden-480">
                <i class="ace-icon fa fa-caret-right blue"></i>BSE Order Id
            </th>
            <th class="hidden-480">
                <i class="ace-icon fa fa-caret-right blue"></i>Scheme Name
            </th>
            <th class="hidden-480">
                <i class="ace-icon fa fa-caret-right blue"></i>Amount
            </th>
            <th class="hidden-480">
                <i class="ace-icon fa fa-caret-right blue"></i>BSE Remarks
            </th>
            <th class="hidden-480">
                <i class="ace-icon fa fa-caret-right blue"></i>Status
            </th>
            <th class="hidden-480">
                <i class="ace-icon fa fa-caret-right blue"></i>Date
            </th>
        </tr>
    </thead>
    <tbody>
<?php
    $totalFiles = $buySell->orderListCount($CONFIG->loggedUserId);
    $fileList = $buySell->orderList($CONFIG->loggedUserId);
    if ($totalFiles == 0) {
        $fileHTML = '<tr><td class="center red"> No Order(s) Found.</td></tr>';
    } else {
        while (list($fileKey, $fileVal) = each($fileList)) {
            $arr = explode('-', $fileVal[asses_year]); ?>														
    <tr>       
        <td>
            <b class=""><?php echo $customerProfile->getCustomerName($fileVal[fr_user_id]); ?></b>
        </td>
        <!-- <td>
            <b class=""><?php //echo $fileVal[order_ref_no]; ?></b>
        </td> -->
         <td>
            <b class="green"><?php echo $fileVal[bse_order_id]; ?></b>
        </td>       
         <td>
            <?php echo wordwrap($fileVal[scheme_name], 25, "<br />\n"); ?> - <?php echo $fileVal[scheme_code]; ?>
        </td>
         <td>
            <b class="green">&#x20b9; <?php echo $fileVal[amount]; ?></b>
        </td>
        <td>
            <?php echo wordwrap($fileVal[bse_remarks], 25, "<br />\n"); ?>
        </td>
         <td>
            <span class="label label-warning"><strong><?php echo $fileVal[trxnstatus]; ?></strong></span>
        </td>         
        <td class="hidden-480">
            <span class="label label-info arrowed-right arrowed-in"><?php echo $commonFunction->dateFormatWithTime($fileVal[order_date]); ?></span>
        </td>        
    </tr>
<?php
        }
    }
?>
            </tbody>
        </table>                                                
     </div> 
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.page-content -->
    </div>
			</div>