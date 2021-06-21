<style>
   .submit_sum_btn {
   background: #;
   background: #d33633 !important;
   color: #fff !important;
   margin-right:10px;
   }
   .select_all {
   float: right;
   padding-top: 11px;
   }
   .card.summary_left {
   border: 2px solid #ddd;
   padding: 10px;
   } 
   @media only screen and (min-width: 767px) {
   .card.summary_left {
   padding-top: 50px;
   }
   }    
</style>
<?php
$title = ['Aditya Birla Sun Life ESG Fund','Hdfc Dividend Yield Fund','Invesco India - Invesco Global Consumer Trends Fund of Fund'];
$mf_fund = ['Aditya Birla Sun Life Mutual Fund','HDFC Mutual Fund','Invesco Mutual Fund']; 
$Scheme_Name = ['Aditya Birla Sun Life ESG Fund','Hdfc Dividend Yield Fund','Invesco India - Invesco Global Consumer Trends Fund of Fund']; 
$Objective_of_Scheme = ['The investment objective of the Scheme is to generate long-term capital appreciation by investing in a diversified basket of companies following Environmental, Social and Governance (ESG) theme.','To provide capital appreciation and/or dividend distribution by predominantly investing in a well-diversified portfolio of equity and equity related instruments of dividend yielding companies.','To provide long-term capital appreciation by investing predominantly in units of Invesco Global Consumer Trends Fund, an overseas fund which invests in an international portfolio of companies predominantly engaged in the design, production or distribution of products and services related to the discretionary consumer needs of individuals. However, there is no assurance or guarantee that the investment objective of the Scheme will be achieved. The Scheme does not assure or guarantee any returns.'];
$Scheme_Type = ['Open Ended','Open Ended','Open Ended'];
$Scheme_Category = ['Equity Scheme - Sectoral/ Thematic','Equity Scheme - Dividend Yield Fund','Other Scheme - FoF Overseas'];
$New_Fund_Launch_Date = ['04-Dec-2020','27-Nov-2020','04-Dec-2020'];
$New_Fund_Earliest_Closure_Date = ['','11-Dec-2020',''];
$New_Fund_Offer_Closure_Date = ['18-Dec-2020','11-Dec-2020','18-Dec-2020']; 
$Indicate_Load_Seperately = ['','Entry Load: NA Exit Load: Exit load of 1.00% is payable if Units are redeemed / switched-out within 1 year from the date of allotment of units',''];
$Minimum_Subscription_Amount = ['500','5000','Rs. 1,000/- per application and in multiples of Re'];
$For_Further_Details_Please_Visit_Website = ['https://mutualfund.adityabirlacapital.com','www.hdfcfund.com','www.invescomutualfund.com'];
//die();

//$all_sch_id = $mutualFund->fetch_sch_id_offr('NFO');

$all_pro = '1';
$nfOproduct = $mutualFund->fetch_all_schema($amc_code,$schm_type,$sch_risk,$sch_fund_size,$fetch_sch,$all_pro);

print_r($res);
//$all_sch_id = explode(',', $all_sch_id[0][offer_nav]);

?>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<div class="row">
   <aside class="col-sm-12">
      <div class="row">
         <div class="col-md-12">
            <div class="card">
               <h6 class="title"><br><br> NEW MUTUAL FUD FUND SCHEME</h6>
            </div>
         </div>
         <!-- <div class="col-md-3 pull-right" style="float: right;">
            <div class="select_all">
               <input type="checkbox" id="selectallsch" name="selectall" value="selectall">
               <label for="Select all"> Select All</label><br>
            </div>
         </div> -->
      </div>
      <div class="card">
        <?php
        // $i = 0;
        // foreach ($all_sch_id as $sch_id) 
        // {
        //   //echo "SCHEME ID:".$sch_id."<br>";
          
        //   $sch_details = $mutualFund->get_sch_details($sch_id);

          while(list($key,$val) = each($nfOproduct)){
            // echo "<br>key:".$key;
            // echo "<br><br>Val:-";
            // print_r($val);
          ?>
          <a href="single_product.html?<?= base64_encode($val['pk_recomend_id']); ?>?0?<?= base64_encode($val['all_pro']); ?>" style="color: #000000;">
              <div class="row <?php if($i % 2 != 0){ echo "card-header"; }else{ echo "card-body"; }  ?>">
                 <div class="col-sm-12">
                    <h6>
                       <!-- <input type="checkbox" id="check1" class="check_schm" name="check1" value="check1"> -->
                       &nbsp;&nbsp;<?= $val[Scheme_Name];?><br>  
                       <div class="col-sm-4" style="font-size: 13px; font-weight: 100; text-align: center; padding-right: 9%;">
                          <?= $val[Scheme_Type];?>
                       </div>
                    </h6>
                 </div>
              </div>
          </a>
        
        <?php
        //   $sch_details = "";          
        //   $i++;
        //   //die();
        // }
        }
        ?>
      </div>
      <!-- <center><button type="submit" name="add_cart" class="boxed_btn submit_sum_btn">Add to Cart</button></center> -->
   </aside>
   <!-- <aside class="col-sm-5">
      <div class="card summary_left">
         <div class="newfund-off-rgt">
                <h3>Aditya Birla Sun Life ESG Fund</h3>
                <table cellpadding="0" cellspacing="0" border="0" class="new-fund-tble">
                    <tbody>
                        <tr>
                            <td width="35%"><b>Mutual Fund</b></td>
                            <td>Aditya Birla Sun Life Mutual Fund</td>
                        </tr>
                        <tr style="background-color: rgb(240, 240, 240); ">
                            <td><b>Scheme Name</b></td>
                            <td>Aditya Birla Sun Life ESG Fund</td>
                        </tr>
                        <tr>
                            <td><b>Objective of Scheme</b></td>
                            <td>
                                The investment objective of the Scheme is to generate long-term capital appreciation by investing in a
                                diversified basket of companies following Environmental, Social and Governance (ESG) theme.
                            </td>
                        </tr>
                        <tr style="background-color: rgb(240, 240, 240); ">
                            <td><b>Scheme Type</b></td>
                            <td>Open Ended</td>
                        </tr>
                        <tr>
                            <td><b>Scheme Category</b></td>
                            <td>Equity Scheme - Sectoral/ Thematic</td>
                        </tr>
                        <tr style="background-color: rgb(240, 240, 240); ">
                            <td><b>New Fund Launch Date</b></td>
                            <td>04-Dec-2020</td>
                        </tr>
                        <tr>
                            <td><b>New Fund Earliest Closure Date</b></td>
                            <td></td>
                        </tr>
                        <tr style="background-color: rgb(240, 240, 240); ">
                            <td><b>New Fund Offer Closure Date</b></td>
                            <td>18-Dec-2020</td>
                        </tr>
                        <tr>
                            <td><b>Indicate Load Seperately</b></td>
                            <td></td>
                        </tr>
                        <tr style="background-color: rgb(240, 240, 240); ">
                            <td><b>Minimum Subscription Amount</b></td>
                            <td>500 </td>
                        </tr>
                        
                    </tbody>
                </table>
            </div>
      </div>
       //card.// 
   </aside> -->

  
</div>
</div>
