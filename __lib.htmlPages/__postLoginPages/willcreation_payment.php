<?php
include_once("__lib.includes/config.inc.php");
$pi_data = $willProfile->getWillDetails('will_personal_information');
?>

    <div class="agreement-row">
        <div class="container">
            <div class="row">
                
                <div class="col-xs-12">
                                    <label class="mandatory">Please click on the button below to pay the fee of the Will. <br>
                                        
                                        Please note that once the payment is done, a PDF copy of the Will will be generated. You may download the same and use it for all future references. 
                                        </label>
                                    
                    
                                </div>
                </div>
            <div class="row">
                <div class="col-xs-12"> 
                    <form method="post" target="_blank" action="__willPages/create_will_pdf.php">
                        <button type="submit">Pay Now </button>
                    </form>
                    
                    <form method="post" target="_blank" action="__willPages/create_will_pdf.php">
                        <input type="hidden" id="pi_name" name ="pi_name" value="<?php echo $pi_data->pi_f_name ?>" >
                        <input type="hidden" id="pi_place" name ="pi_place" value="<?php echo $pi_data->pi_place ?>" >
                        <input type="hidden" id="pi_date" name ="pi_date" value="<?php echo $pi_data->pi_date ?>" >
                        <button type="submit">Generate PDF</button>
                    </form>
                  </div>
                </div>
            <div class="row">
                <div class="col-xs-12">
                    
                    <p>Thank you for generating the Will on taxsave.</p>

                    
                  </div>
                </div>
            
        </div>
    </div>