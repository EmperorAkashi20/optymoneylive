<?php
   $interface1 = $_SERVER['REQUEST_URI'];
   $request_sch = explode("?", $interface1);
   $CONFIG->sch_id = base64_decode($request_sch[1]);
   $CONFIG->nav = base64_decode($request_sch[2]);

   if($CONFIG->sch_id) {
      $fetch_sch = $CONFIG->sch_id;
      $get_sql = $mutualFund->get_scheme_data($fetch_sch);
      $get_nav = $mutualFund->get_nav_latest($get_sql[0]['channel_partner_code']);
      $p_date=date_create($get_nav['price_date']);
   }
?>    
<div class="container" style="background-color: white;">
   <section class="tax_file_page wow fadeInUp">
      <div class="row">
         <div class="col-md-6 col-lg-6 col-12">
            <h2><?= $get_sql[0]['scheme_name'];?></h2>
         </div>
         <div class="col-md-6 col-lg-6 col-12">
            <h2><strong><?= $CONFIG->nav; ?>%</strong></h2> 1 Year Return
         </div>
      </div>
      <div class="row">
         <div class="col-md-12 col-lg-8 col-12">
            <div class="graph_detail">
               <div id="chartdiv"></div>
            </div>
         </div>
         <div class="col-md-12 col-lg-4 col-12 p-3 mb-5 bg-white rounded right-sidebar-detail">
            <form method="POST" action="<?= $CONFIG->siteurl ?>ajax-request/mutual_fund.php?action=add_pre_cart" onSubmit="prelogin_cart(this);return false;"> 
               <div class="card-header p-0 border-bottom-0" id="singleProd_tabs">
                  <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                     <li class="nav-item" style="width: 50%;">
                        <a class="nav-link active add_sip" id="custom-tabs-three-home-tab" data-toggle="pill" href="#custom-tabs-three-home" role="tab" aria-controls="custom-tabs-three-home" aria-selected="true">MONTHLY SIP</a>
                     </li>
                     <li class="nav-item" style="width: 50%;">
                        <a class="nav-link rmv_sip" id="custom-tabs-three-profile-tab" data-toggle="pill" href="#custom-tabs-three-profile" role="tab" aria-controls="custom-tabs-three-profile" aria-selected="false">ONE TIME</a>
                     </li>
                  </ul>
                  <input type="hidden" name="sch_code" id="sch_code" value="<?php echo base64_encode($get_sql[0]['isin']); ?>">
                  <!-- Tab panes -->
                  <div class="tab-content" id="custom-tabs-three-tabContent">
                     <div class="tab-pane fade active show" id="custom-tabs-three-home" role="tabpanel" aria-labelledby="custom-tabs-three-home-tab">
                        <div class="d-flex justify-content-center padd">Enter Installment Amount</div>
                        <?php if($get_sql[0]['sip_maximum_installment_amount']==0) { ?>
                           <div class="d-flex justify-content-center" style="font-size: 28px;" >₹<input type="number" class="f_amount bottom_line" name="f_sip_amount" min="<?= $get_sql[0]['sip_minimum_installment_amount']; ?>" value="<?= $get_sql[0]['sip_minimum_installment_amount']; ?>" required="false"></div>
                        <?php } else { ?>
                           <div class="d-flex justify-content-center" style="font-size: 28px;" >₹<input type="number" class="f_amount bottom_line" name="f_sip_amount" max="<?= $get_sql[0]['sip_maximum_installment_amount']; ?>"  min="<?= $get_sql[0]['sip_minimum_installment_amount']; ?>" value="<?= $get_sql[0]['sip_minimum_installment_amount']; ?>" required="false"></div>
                        <?php } ?>
                        <div class="d-flex justify-content-center padd">
                           <button type="button" class="btn btn-success rounded-pill backgrndxclr w_amnt" value="1000">+ ₹1,000</button>&nbsp;
                           <button type="button" class="btn btn-success rounded-pill backgrndxclr w_amnt" value="2000">+ ₹2,000 </button>&nbsp;
                           <button type="button" class="btn btn-success rounded-pill backgrndxclr w_amnt"value="5000">+ ₹5,000 </button>
                        </div>
                        <div class="row card-body">
                           <div class="col-md-auto">
                              <i class="fa fa-calendar" aria-hidden="true"></i> SIP Date
                           </div>
                           <div class="col">             
                           </div>
                           <div class="col-md-auto">
                              <select name="sip_date" class="sip_date" id="sip_date" required="required">
                                 <option value="0" selected="selected">Date</option>
                                 <option value="1">1</option>
                                 <option value="2">2</option>
                                 <option value="3">3</option>
                                 <option value="4">4</option>
                                 <option value="5">5</option>
                                 <option value="6">6</option>
                                 <option value="7">7</option>
                                 <option value="8">8</option>
                                 <option value="9">9</option>
                                 <option value="10">10</option>
                                 <option value="11">11</option>
                                 <option value="12">12</option>
                                 <option value="13">13</option>
                                 <option value="14">14</option>
                                 <option value="15">15</option>
                                 <option value="16">16</option>
                                 <option value="17">17</option>
                                 <option value="18">18</option>
                                 <option value="19">19</option>
                                 <option value="20">20</option>
                                 <option value="21">21</option>
                                 <option value="22">22</option>
                                 <option value="23">23</option>
                                 <option value="24">24</option>
                                 <option value="25">25</option>
                                 <option value="26">26</option>
                                 <option value="27">27</option>
                                 <option value="28">28</option>
                              </select>
                              <span id="dt_typ"> </span> of every month
                           </div>
                        </div>
                        <div class="d-flex justify-content-center padd">
                           <input type="hidden" name="sch_d" class="sch_d" value="<?= $get_sql[0]['pk_nav_id']; ?>">
                           <!-- <button type="button" ></button>&nbsp; -->
                           <input type="submit" class="btn btn-success" id="sip" name="add_cart" value="ADD TO CART">
                           <!-- <button type="button" class="btn btn-success">START SIP</button> -->
                        </div>
                     </div>
                     <div class="tab-pane fade" id="custom-tabs-three-profile" role="tabpanel" aria-labelledby="custom-tabs-three-profile-tab">
                        <div class="d-flex justify-content-center padd">Enter Amount</div>
                        <?php if($get_sql[0]['maximum_purchase_amount']==0) { ?>
                           <div class="d-flex justify-content-center" style="font-size: 28px;">₹<input type="number" class="f_amount bottom_line" name="f_lum_amount" min="<?= $get_sql[0]['minimum_purchase_amount']; ?>" value="<?= $get_sql[0]['minimum_purchase_amount']; ?>"  required="false"></div>
                        <?php } else { ?>
                           <div class="d-flex justify-content-center" style="font-size: 28px;">₹<input type="number" class="f_amount bottom_line" name="f_lum_amount" max="<?= $get_sql[0]['maximum_purchase_amount']+1; ?>"  min="<?= $get_sql[0]['minimum_purchase_amount']; ?>" value="<?= $get_sql[0]['minimum_purchase_amount']; ?>"  required="false"></div>
                        <?php } ?>
                        <div class="d-flex justify-content-center padd">
                           <button type="button" class="btn btn-success rounded-pill backgrndxclr w_amnt" value="1000">+ ₹1,000</button>&nbsp;
                           <button type="button" class="btn btn-success rounded-pill backgrndxclr w_amnt" value="2000">+ ₹2,000 </button>&nbsp;
                           <button type="button" class="btn btn-success rounded-pill backgrndxclr w_amnt" value="5000">+ ₹5,000 </button>
                        </div>
                        <div class="d-flex justify-content-center padd">
                           <input type="hidden" name="sch_d" class="sch_d" value="<?= $get_sql[0]['pk_nav_id']; ?>">
                           <!-- <button type="button" class="btn btn-success add_cart" name="add_cart" value="2">ADD TO CART</button>&nbsp; -->
                           <input type="submit" class="btn btn-success" id="lumpsum" name="add_cart" value="ADD TO CART">
                           <!-- <button type="button" class="btn btn-success">START SIP</button> -->
                        </div>
                     </div>
                  </div>
               </div>
            </form>
         </div>
      </div>
      <div class="row">
         <h6 class="card-title">Fund Details</h6>
      </div>
      <div class="row">
         <div class="col-sm">
            <table class="table">
               <thead>
                  <tr>
                     <th scope="col-md-auto">Risk</th>
                     <th scope="col-md-auto" class="text-right">Moderately High</th>
                  </tr>
               </thead>
               <tbody>
                  <tr>
                     <th scope="row col-md-auto">Min SIP Amount</th>
                     <td class="text-right">₹<?= $get_sql[0]['sip_minimum_installment_amount']; ?></td>
                  </tr>
                  
               </tbody>
            </table>
         </div>
         <div class="col-sm">
            <table class="table">
               <thead>
                  <tr>
                     <th scope="col-md-auto">NAV</th>
                     <th scope="col-md-auto" class="text-right">₹<?= $get_nav['net_asset_value'];  ?> (<?= date_format($p_date,"d M Y"); ?>)</th>
                  </tr>
               </thead>
               <tbody>
                  <tr>
                     <th scope="row col-md-auto">Fund Started</th>
                     <td class="text-right"><?= $get_sql[0]['start_date']; ?></td>
                  </tr>
                  
               </tbody>
            </table>
         </div>
      </div>
      <!-- <div class="row col-sm-8">
         <div class="row col-sm"> <h6 class="card-title">Fund Overview</h6></div>
         <div class="embed-responsive embed-responsive-16by9">
            <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/zpOULjyy-n8?rel=0" allowfullscreen></iframe>
         </div>
         </div> -->
      <!--<div class="col-12 col-lg-8 col-md-8 p-3 mb-5 bg-white rounded" style="border: 2px solid #f7f7f7;">
         <div class="card-header p-0 border-bottom-0 col-12 col-lg-4 col-md-4">
            <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
               <li class="nav-item" style="width: 50%;">
                  <a class="nav-link active" id="custom-tabs-three-home-tab" data-toggle="pill" href="#custom-tabs-three-home" role="tab" aria-controls="custom-tabs-three-home" aria-selected="true">SIP</a>
               </li>
               <li class="nav-item" style="width: 50%;">
                  <a class="nav-link" id="custom-tabs-three-profile-tab" data-toggle="pill" href="#custom-tabs-three-profile" role="tab" aria-controls="custom-tabs-three-profile" aria-selected="false">Lumpsum</a>
               </li>
            </ul>
         </div>
         <div class="col-md-12 tab-content lumpsum_calc" id="custom-tabs-three-tabContent">
            <div class="tab-pane fade active show" id="custom-tabs-three-home" role="tabpanel" aria-labelledby="custom-tabs-three-home-tab">
               <div class="card-body">
                  <div class="col-md-auto">
                     <p class="justify-content-left">I want to invest per month</p>
                  </div>
                  <div class="col"> </div>
                  <div class="col-md-auto">
                     <h6 class="card-title">
                        ₹ <spanv id="inv_amt">
                        <?= $get_sql[0]['sip_minimum_installment_amount']; ?></span>
                     </h6>
                  </div>
                  <div class="slidecontainer justify-content-center">            
                     <input id="multi3" class="" type="range" min="<?= $get_sql[0]['Minimum_Purchase_Amount']; ?>" max="<?= $get_sql[0]['Maximum_Purchase_Amount']+1; ?>" value="<?= $get_sql[0]['Minimum_Purchase_Amount']; ?>" />                
                  </div>
                  <div class="row card-body">
                     <div class="col-md-auto">
                        <p class="justify-content-left">For how many years?</p>
                     </div>
                  </div>
                  <div class="d-flex justify-content-left">
                     <button type="button" class="btn btn-success">1 Year</button>&nbsp;
                     <button type="button" class="btn btn-success">3 Years</button>&nbsp;
                     <button type="button" class="btn btn-success">5 Years</button>
                  </div>
               </div>
               <div class="row card-footer">
                  <div class="col-md-auto"> <p class="justify-content-left">Estimated value as per Historical Returns</p> </div>
                  <div class="col">
                     <a href="" class="d-flex" style="color: #d33633; font-size: 20px; font-weight: 500;"> ₹0 </a>with -5.0% annual returns
                  </div>
               </div>
            </div>
            <div class="tab-pane fade" id="custom-tabs-three-profile" role="tabpanel" aria-labelledby="custom-tabs-three-profile-tab">
               <div class="d-flex justify-content-center padd">Enter Installment Amount</div>
               <div class="d-flex justify-content-center" style="font-size: 28px;">₹0</div>
               <div class="d-flex justify-content-center padd">
                  <button type="button" class="btn btn-success rounded-pill backgrndxclr">+ ₹1,000</button>&nbsp;
                  <button type="button" class="btn btn-success rounded-pill backgrndxclr">+ ₹2,000 </button>&nbsp;
                  <button type="button" class="btn btn-success rounded-pill backgrndxclr">+ ₹5,000 </button>
               </div>
            </div>
         </div>
      </div>-->
   </section>
</div>