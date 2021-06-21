<?php
    //echo "<pre>";print_r($_SESSION);
    //$bankInfo = $customerProfile->getCustomerBankInfo();
    //print_r($bankInfo);
    if ($_REQUEST[rid]) {
        $db->db_run_query("UPDATE mf_pan_attached_list SET request_status='Rejected' WHERE pk_request_id='".$_REQUEST[rid]."'");
    }
    if ($_REQUEST[aid]) {
        $db->db_run_query("UPDATE mf_pan_attached_list SET request_status='Accepted' WHERE pk_request_id='".$_REQUEST[aid]."'");
    }

?>
<div class="main-content">
				<div class="main-content-inner">
					<!-- #section:basics/content.breadcrumbs -->
					<!-- <div class="breadcrumbs ace-save-state" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="?module_interface=<?php //echo $commonFunction->setPage('home'); ?>">Home</a>
							</li>
							<li class="active">Mutual Fund</li><li class="active">Add Other Users</li>
						</ul>

						<?php //include 'form.search.php'; ?>
					</div> -->
                    
                    
                    <nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="<?php echo $CONFIG->siteurl; ?>mySaveTax/">Home</a>
							</li>
							<li class="active">Mutual Fund</li><li class="active">Add Other Users</li>
						</ol><!-- /.breadcrumb -->
						<?php //include("mdocs.lib.htmlPages/form.search.php");?>

						<!-- /section:basics/content.searchbox -->
                    </nav>
					<div class="page-content">						
                        <div class="widget-box">
                                        <div class="widget-header">
                                            <h4 class="widget-title">Add Other Users</h4>
                                        </div>
										<div class="widget-body">
                                            <div class="widget-main">
                                                <form class="form-inline" method="post" action="../ajax-request/post_login_response.php?name=attache_pan" onsubmit="attachePAN(this);return false;">
                                                        <label class="inline" style="padding:4px;">
                                                        PAN  <input type="text" class="ace" name="pan_no_attach" placeholder="Enter Pan no." required>
                                                        </label>
                                                        
                                                        <button class="btn btn-info btn-sm" type="submit">
                                                            <i class="ace-icon fa fa-check bigger-110"></i><strong>Submit</strong>
                                                        </button>
                                                        <label id="attach_status" class="red"></label>
                                                </form>
                                            </div>                                                										
										</div>
						</div>
						<div class="row">
							<div class="col-md-12">                            
                               <div class="space-8"></div>
                                <div class="row">
					                <div class="col-xs-12">		
                                    	<div class="clearfix">
                                        	<div class="pull-left tableTools-container">
                                            	<h4 class="red"><i class="fa fa-asterisk bigger-110 pink"></i>Request From Other Users To Attach</h4>
                                            </div>  											
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                	 <table class="table table-bordered table-striped">
                                            <thead class="thin-border-bottom">
                                                <tr>
                                                    <th>PAN</th>
                                                    <th>Name</th>                                                    
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                           <tbody>
<?php

    $totalReq = $mutualFund->listAllMappedPAN('getAllAttachRequest');
    if (count($totalReq) == 0) {
        echo "<tr><td colspan='4' class='red' align='center'>No Record Found.</td></tr>";
    } else {
        while (list($key, $val) = each($totalReq)) {
            ?>                                           
            <tr>                                               
                <td><?php echo strtoupper($val['recevier_pan_num']); ?></td>
                <td><?php echo ucwords($customerProfile->getCustomerName($val['fr_user_recevier_id'])); ?></td>
                <td><?php echo $val['request_status']; ?></td>
                <td><a href="?rid=<?php echo $val['pk_request_id']; ?>&module_interface=<?php echo $commonFunction->setPage('map_users'); ?>"><i class="ace-icon fa fa-times red2"></i></a><a href="?aid=<?php echo $val['pk_request_id']; ?>&module_interface=<?php echo $commonFunction->setPage('map_users'); ?>"><i class="ace-icon fa fa-check"></i></a></td>                                             
            </tr>   
<?php
        }
    }
?>                                                                             	
                                    </tbody>
                                  </table>
								</div>
                                <div class="space-8"></div>
                                <div class="row">
					                <div class="col-xs-12">		
                                    	<div class="clearfix">
                                        	<div class="pull-left tableTools-container">
                                            	<h4 class="red"><i class="fa fa-asterisk bigger-110 pink"></i> Attached Users With My Account</h4>
                                            </div>  											
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                	 <table class="table table-bordered table-striped">
                                            <thead class="thin-border-bottom">
                                                <tr>
                                                    <th>PAN</th>
                                                    <th>Name</th>                                                    
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                           <tbody>
<?php

    $totalReq = $mutualFund->listAllMappedPAN('', 'attachedUser');
    if (count($totalReq) == 0) {
        echo "<tr><td colspan='3' class='red' align='center'>No Record Found.</td></tr>";
    } else {
        while (list($key, $val) = each($totalReq)) {
            ?>                                           
            <tr>                                               
                <td><?php echo strtoupper($val['recevier_pan_num']); ?></td>
                <td><?php echo ucwords($customerProfile->getCustomerName($val['fr_user_recevier_id'])); ?></td>
                <td><?php echo $val['request_status']; ?></td>                                                
            </tr>   
<?php
        }
    }
?>                                                                             	
                                    </tbody>
                                  </table>
								</div>
                                 <div class="space-8"></div>
                                <div class="row">
					                <div class="col-xs-12">		
                                    	<div class="clearfix">
                                        	<div class="pull-left tableTools-container">
                                            	<h4 class="red"><i class="fa fa-asterisk bigger-110 pink"></i>Sent Request Pending</h4>
                                            </div>  											
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                	 <table class="table table-bordered table-striped">
                                            <thead class="thin-border-bottom">
                                                <tr>
                                                    <th>PAN</th>
                                                    <th>Name</th>                                                    
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                           <tbody>
<?php

    $totalReq = $mutualFund->listAllMappedPAN('', '', 'pendingReq');
    if (count($totalReq) == 0) {
        echo "<tr><td colspan='3' class='red' align='center'>No Record Found.</td></tr>";
    } else {
        while (list($key, $val) = each($totalReq)) {
            ?>                                           
            <tr>                                               
                <td><?php echo strtoupper($val['recevier_pan_num']); ?></td>
                <td><?php echo ucwords($customerProfile->getCustomerName($val['fr_user_recevier_id'])); ?></td>
                <td><?php echo $val['request_status']; ?></td>                                                
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