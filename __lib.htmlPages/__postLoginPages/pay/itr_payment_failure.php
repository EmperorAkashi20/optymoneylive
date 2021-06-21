<?php
include '../../../__lib.includes/config.inc.php';
?>
<div class="main-content">
    <div class="main-content-inner">
        <nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="<?php echo $CONFIG->siteurl; ?>mySaveTax/">Home</a>
							</li>
							<li class="active">Payment</li>
						</ol><!-- /.breadcrumb -->
						<?php //include("mdocs.lib.htmlPages/form.search.php");?>

						<!-- /section:basics/content.searchbox -->
        </nav>
        <div class="card">
                  <div class="card-body">
        <div id="page-content">
           <center>
            <div class="row">
		    	<div class="col-xs-12 col-sm-6 col-md-10 col-md-offset-1">
                    <div class="widget-box transparent">
                        <div class="widget-body">
					    	<div class="widget-main no-padding">
				                <h4><center>WE COULDN'T PROCESS YOUR PAYMENT</center><br> <center><span class="span-end"></span></center></h4>
                                <br>Your transaction ID is : <?php echo $_REQUEST['transaction_id']; ?>
                                <p>Unfortunately, we couldn't collect your payment on filing the ITR. Please Retry. </p>
                            </div>
                        </div>
                    </div>
        	    </div>
		    </div>
        </div>
        </center>

        <?php
            $tbname = ' bfsi_users_settings';
            $id = $_SESSION['maxPayID'];
            $dataarray = array(
                'pay_status' => 0,
            );
            $commonFunction->dynamicUpdatePay($tbname, $dataarray, $id);
        ?>
	</div>
</div>
        </div>
    </div>

