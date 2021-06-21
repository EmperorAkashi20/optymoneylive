
<?php
include '../../../__lib.includes/config.inc.php';
/*----------------------- AY for current Assement year ---------------------------------*/
$ayYears = explode('-', $CONFIG->currentAY);
/*----------------------- AY for current Assement year ---------------------------------*/
?>
<?php
if (isset($_POST)) {
    $actual_link = $_POST['return_page'];
    $product_desc = $_POST['proddesc'];
    $pan = $_REQUEST['pan'];
    $_SESSION['user_pan_number'] = $pan;
    $_SESSION['newitr'] = $_REQUEST['new'];
}

?>

<div id="paymentpage">
            <section class="payment-step" id="payment-type">
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
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">Payment Option</h3>
                        <p class="card-description">Select your income for AY 2019-20 (FY 2018-19)</p>
                                                               
                                <!-- <form class="paymentForm" role="form" method="post"
                                                                    action="./pay/itr_paymentdetails.php"
                                                                    onSubmit="changetopaymentdetails(this);return false;"
                                                                    name="payment_frm"
                                                                    accept-charset="UTF-8" id="pay-select"> -->

                            <form method="post" action="?module_interface=<?php  echo $commonFunction->setPage('itr_forms'); ?>">
                            <input type="hidden" name="new" class="ace" checked value="1" />
                <input type="hidden" name="ay" class="ace" checked value="<?php echo $ayYears[0]; ?>" />
                                                <div class="row">
                                                                <div class="col-xs-12 col-sm-4 col-md-4">
                                                                    <input type="checkbox" id="singleform16" value="SingleForm-16">
                                                                    <label for="singleform16">Salary Income - Single Form-16</label>
                                                                </div>
                                                                    
                                                                    <div class="col-xs-12 col-sm-4 col-md-4">
                                                                        <input   type="checkbox" id="multipleform16" value="MultipleForm -16">
                                                        <label    for="multipleform16">Salary Income - Multiple Form -16</label>
                                                                    </div>
                                                            
                                                                    <div class="col-xs-12 col-sm-4 col-md-4">
                                                                        <input   type="checkbox" id="interest" value="Interestincome">
                                                        <label   for="interest">Interest income</label>
                                                                    </div>
                                                                    
                                                                        <div class="col-md-12"><hr/>
                                                                        <input   type="checkbox" id="oneproperty" value="OneProperty">
                                                        <label   for="oneproperty">Income form House Property - One Property</label><hr/>
                                                                        </div>
                                                                    <div class="col-md-12">
                                                                        <input   type="checkbox" id="morethanoneproperty" value="MorethanoneProperty">
                                                        <label   for="morethanoneproperty">Income form House Property - More than one Property</label><hr/>
                                                                        </div>
                                                                    <div class="col-md-12">
                                                                        <input   type="checkbox" id="capitalgain" value="CapitalGains">
                                                        <label   for="capitalgain">Capital Gains - 1 to 5 transactions<p class="small"> If more than 5 transactions, please consult a CA</p></label><hr/>
                                                                        </div>
                                                                    <div class="col-md-12">
                                                                        <input   type="checkbox" id="incomefrombusiness" value="IncomefromBusiness">
                                                        <label   for="incomefrombusiness">Income from  Business - Turnover or Gross receipts less than Rs. 2 Crores or Income from Profession - Gross receipts less than 25 Lakhs<p class="small"> For any other cases, please consult a CA</p></label><hr/>
                                                                        </div>
                                                                    <div class="col-md-12">
                                                                        <input   type="checkbox" id="anyotherincome" value="Anyotherincome">
                                                        <label   for="anyotherincome">Any other income</label><hr/>
                                                                        </div>
                                                            <div class="col-xs-12 col-sm-6 col-md-6">
                                                                        <p class="fee">Your applicable fee Rs.</p>
                                                                        </div>
                                                                    <div class="col-xs-12 col-sm-6 col-md-6">
                                                                        <input type="text" id="amount" name="amount" value="0" readonly="true"/>
                                                                        </div>
                                                                    <div class="col-md-12">
                                                                        <button type="submit" class="btn btn-success">Proceed to file ITR</button><hr/>
                                                                        </div>
                                                                </div>  
                                                                
                                                                    <?php
                                                                        if ($actual_link == '') {
                                                                            $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http')."://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                                                                        }

                                                                    if ($product_desc == '') {
                                                                        $product_desc = 'Product info missing';
                                                                    }
                                                                    ?>
                                                                    <input type="hidden" name="return_page"    value="<?php echo $actual_link; ?>" /> 
                                                                    <input type="hidden" name="description"    value="<?php echo $product_desc; ?>" /> 
                                </form>
                            
      
                            <div class="row">
                                <div class="col-md-12">
                                <p class="note">Note - If there is any differential payment due to wrong selection of income or due to any other reason like complication in the case etc, the differential payment needs to be paid.  </p>
                                </div>
                            </div>
                            <!-- </div> -->
                        
                    </div>
                </div>
            </div>    
            </section>
        </div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">

    function calculate_total() {
        var totalcost = 0;
        if(document.getElementById("singleform16").checked) {
            totalcost += 100;
        }
        if(document.getElementById("multipleform16").checked) {
            totalcost += 200;
        }
        if(document.getElementById("interest").checked) {
            totalcost += 50;
        }
        if(document.getElementById("oneproperty").checked) {
            totalcost += 200;
        }
        if(document.getElementById("morethanoneproperty").checked) {
            totalcost += 500;
        }
        if(document.getElementById("capitalgain").checked) {
            totalcost += 500;
        }
        if(document.getElementById("incomefrombusiness").checked) {
            totalcost += 500;
        }
        if(document.getElementById("anyotherincome").checked) {
            totalcost += 500;
        }
        
        document.getElementById("amount").value = totalcost;     
    }
    
    
    $(document).ready(function(){
    
            $("#singleform16").click(function(){
            calculate_total();
    });
            $("#multipleform16").click(function(){
            calculate_total();
    });
            $("#interest").click(function(){
            calculate_total();
    });
            $("#oneproperty").click(function(){
            calculate_total();
    });
            $("#morethanoneproperty").click(function(){
            calculate_total();
    });
            $("#capitalgain").click(function(){
            calculate_total();
    });
            $("#incomefrombusiness").click(function(){
            calculate_total();
    });
            $("#anyotherincome").click(function(){
            calculate_total();
    });
});
    
    function changetopaymentdetails(form)     {
        calculate_total();
        if(document.getElementById("amount").value == "0") {
            alert("Please select any one option");
            return false;
        }
        
        //alert("prep");
        $.ajax({
        url: form.action,
        type: form.method,
        data: $(form).serialize(),
        success: function(response) {
            //alert("resp");
            $("#paymentpage").html(response);
        }            
    });
    return false;
    }
</script>
  
	
