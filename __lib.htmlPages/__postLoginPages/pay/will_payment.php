<?php
include_once '__lib.includes/config.inc.php';
$pi_data = $willProfile->getWillDetails('will_personal_information');
?>
<div class="main-content">
				<div class="main-content-inner">
					<div class="page-content">												
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="widget-box transparent">
                                    <div class="widget-header widget-header-flat">
                                        <h4 class="widget-title orange">
                                            Payment of Will making
                                        </h4>                                                     
                                    </div>
                                </div><!-- /.widget-box -->
                            </div><!-- /.col -->
                        </div><!-- /.row --><br>
                        <div class="row">
                            <div class="container">
                                <div class="row">
                                    
                                    <div class="col-xs-12">
                                                        <p>Please click on the button below to pay the fee of the Will. <br>
                                                            Please note that once the payment is done, a PDF copy of the Will will be generated. You may download the same and use it for all future references. 
                                                            </p>
                                                            <p>Thank you for generating the Will on taxsave.</p>
                                                    </div>
                                    </div><br>
                                <div class="row">
                                    <div class="col-xs-12"> 
                                    <form method="post" action="?module_interface=<?php echo $commonFunction->setPage('pay/will_paymentdetails'); ?>">
                                            <!-- <input type="hidden" name="newwill" class="ace" checked value="1" /> -->
                                            <button type="submit" class="btn btn-success">Pay Now </button>
                                        </form>
                                        
                                       <form method="post" target="_blank" action="__willPages/create_pdf.php">
                                            <input type="hidden" id="pi_name" name ="pi_name" value="<?php //echo $pi_data->pi_f_name;?>" >
                                            <input type="hidden" id="pi_place" name ="pi_place" value="<?php //echo $pi_data->pi_place;?>" >
                                            <input type="hidden" id="pi_date" name ="pi_date" value="<?php //echo $pi_data->pi_date;?>" >
                                            <!-- <button type="submit">Generate PDF</button> -->
                                        </form>  
                                    </div>
                                    </div><br>
                                <div class="row">
                                    <div class="col-xs-12">
                                        
                                        

                                        
                                    </div>
                                    </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
</div>