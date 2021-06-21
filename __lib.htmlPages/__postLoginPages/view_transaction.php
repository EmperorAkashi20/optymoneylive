<?php
//echo "string";

//print_r($_REQUEST);
//die();
$scheme_code = base64_decode($_REQUEST[id]);
$folio = base64_decode($_REQUEST[fol]);
//echo "<br>Scheme Code:-".$scheme_code."<br>";
$get_sch_info = $mutualFund->fetch_schema_details($scheme_code,$folio);
$get_l_nav = $mutualFund->get_nav_latest($scheme_code);
//echo "NAV:-".$get_l_nav[net_asset_value];
// print_r($get_sch_info);
//echo "info:-".$get_sch_info;
//die();
//print_r($get_sch_info);
?>
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content" style="background-color: #fff; margin-left: 0px !important">
   <div class="page-content">
      <!-- Page-Title -->
      <!-- end page title end breadcrumb -->
      <div class="row"><br></div>
      <div class="container" style="background-color: #fff;">
         <!-- The Modal -->
         
         <div class="row">
            <div class="col">
               <a href="?module_interface=<?php echo $commonFunction->setPage('mutual_fund'); ?>" class="anchclrs"><i class="fa">&#xf104;</i> Back to investments</a>
            </div>
         </div>
         <div class="row"><br></div>
         <div class="row">
            <div class="col">
               <h5><?= $get_l_nav[fr_scheme_name]; ?></h5>
            </div>
            <div class="col-md-auto">
               <h3 class="pull-right">₹1,087</h3>
            </div>
            <div class="col col-lg-2">
               <!-- <a href="#" class="btn btn-primary" style="width: 100%;">INVEST MORE</a> -->
               <!-- <div class="col align-self-center">
                  <a href="#" class="btn btn-primary" style="width: 100%;">INVEST MORE</a>
               </div> -->
               <!-- <br/> -->
               <div class="col align-self-center">
                  <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#myModal" style="width: 100%;">REDEEM</a>
               </div>
            </div>
         </div>
         <div class="row"><br></div>
         <div class="row">
            <div class="col">
               <span class="pull-left"> CURRENT NAV:- </span><span class="ml-5" style="font-weight: bold;"> <?= $get_l_nav[net_asset_value]; ?></span>
            </div>
            <div class="col order-1">
               <span class="pull-left">UNITS YOU OWN:- </span><span class="ml-5" style="font-weight: bold;"> 6.15</span>          
            </div>
            <div class="col order-12">          
               <span >INVESTED:-</span><span class="ml-5" style="font-weight: bold;"> ₹1,000</span> 
            </div>
         </div>
         <div class="row"><br></div>
         <div class="row">
            <!-- <div class="col">          
               <span class="pull-left"> AVERAGE NAV </span><span class="ml-5" style="font-weight: bold;">162.57</span>
            </div> -->
            <div class="col order-1">         
               <span class="pull-left"> FOLIO NUMBER:-</span><span class="ml-5" style="font-weight: bold;" id="folio"><?= $get_sch_info[0][folio]; ?> &nbsp;
               </span><i class="fa fa-file iconbackclr" aria-hidden="true" onclick="copyToClipboard('#folio')"></i>
            </div>
            <!-- <div class="col order-1" style="position: relative;left: 1%;">
               <span class="pull-left ml-5" >
                  <h4 style="position: relative; bottom: 6px"><a href="#" class="anchclrs">+₹87</a></h4>
                  &nbsp;
               </span>
               <span style="font-weight: bold;"> (8.70%)</span>
            </div> -->
         </div>
         <div class="row"><br></div>
         <div class="row">
            <div class="col-md-12">
            <table class="table table-striped table-bordered" id="sip_details">
               <thead>
                  <tr>
                     <td>DATE</td>
                     <td>TYPE</td>
                     <td>UNITS</td>
                     <td>NAV</td>
                     <td>AMOUNT</td>
                     <td>TXN ID</td>
                  </tr>
               </thead>
               <tbody>
                  <?php
                  while(list($key,$val) = each($get_sch_info))
                  {

                  ?>
                  <tr>
                     <td><?= $val[purchase_date]; ?></td>
                     <th>REDEEM</th>
                     <td><?= $val[unit]; ?></td>
                     <td><?= $val[purchase_price]; ?></td>
                     <th><?= $val[amount]; ?></th>
                     <td><?= $val[trnx_id]; ?></td>
                  </tr>
                  <?php
                  }
                  ?>
               </tbody>
            </table>
         </div>
         </div>
      </div>
   </div>   
</div>


<!-- The Modal -->
         <div class="modal fade" id="myModal">
            <div class="modal-dialog modal-lg">
               <div class="modal-content" style="width: 90% !important;">
                  <div class="col-12">
                     <div class="row">
                        <div class="col-md-4 login-form-2">
                           <!-- <div class="row justify-content-center align-items-center">tyttt</div> -->
                           <div class="row h-50">
                              <div class="col-sm-12 h-100 d-table" style="height: 150% !important;">
                                 <div class="card card-block d-table-cell align-middle">
                                    <h4 class="ml-3" style="color: #fff;">Redeem</h4>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-8 login-form-1">
                           <div class="row">
                              <div class="col-12 pull-right">
                                 <button type="button" class="close" data-dismiss="modal" style="position: relative; top: 50%; right: 1%;">&times;</button>
                              </div>
                           </div>
                           <div class="full-focus">
                              <h6>
                                 <!-- <img class="" src="" width="30" height="30" alt="Mirae Asset Mutual Fund"> -->
                                 <span class="ml-2"> <?= $get_l_nav[fr_scheme_name]; ?> </span>
                              </h6>
                              <div class="row"><br/></div>
                              <div class="first-show">
                                 <div class="row">
                                    <p>Total Redeemable Amount (as per latest NAV)<BR/>₹587</p>
                                 </div>
                                 <form>
                                    <div class="form-group">
                                       <!-- <input type="text" class="form-control" placeholder="Your Email *" value="" /> -->
                                       <input type="text" name="name" class="form-control" id="name" value="">
                                    </div>
                                    <br/>
                                    <div class="chiller_cb">
                                       <input id="myCheckbox2" type="checkbox" style="width: 1.25rem; height: 1.25rem;">
                                       <label for="myCheckbox2">&nbsp;Tick this to redeem Full Amount (All Units)</label>
                                    </div>
                                    <br/>
                                    <div class="row ml-1">
                                       <p>Applicable exit load&nbsp;<i class="fa fa-question-circle-o iconbackclr" aria-hidden="true"></i></p>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                       <a href="#" class="btn btn-primary" id="first-con" style="width: 100%;">CONTINUE</a>
                                    </div>
                                    <div class="modal-footer">
                                       <a href="#" class="ForgetPwd">Safe And Secure</a>
                                    </div>
                                 </form>
                              </div>
                              <div class="second-show" style="display: none;">
                                 <div class="row">
                                    <p>Total Redeemable Amount (as per latest NAV)<BR/>₹587</p>
                                 </div>
                                 <form>
                                    <div class="form-group">
                                       500 <a href="#" class="anchclrs"> CHANGE AMOUNT</a>
                                    </div>
                                    <br/>
                                    <!--    <div class="chiller_cb">
                                       <input id="myCheckbox2" type="checkbox" style="width: 1.25rem; height: 1.25rem;">
                                       <label for="myCheckbox2">&nbsp;Tick this to redeem Full Amount (All Units)</label>
                                       
                                       </div><br/> -->
                                    <div class="form-group">
                                       ₹10 Estimated Exit Load&nbsp;<i class="fa fa-question-circle-o iconbackclr" aria-hidden="true"></i>
                                    </div>
                                    <br/>
                                    <div class="form-group">
                                       <h6>By continuing, you agree to <a href="#" class="ForgetPwd">Terms & Conditions</a></h6>
                                       <a href="#" class="btn btn-primary" id="second-con" style="width: 100%;">CONTINUE</a>
                                    </div>
                                    <div class="modal-footer">
                                       <a href="#" class="ForgetPwd">Safe And Secure</a>
                                    </div>
                                 </form>
                              </div>
                              <div class="third-show" style="display: none;">
                                 <div class="row ml-1">
                                    <p>Redemption of ₹500</p>
                                 </div>
                                 <form>
                                    <div class="form-group">
                                       <div class="row ml-1">
                                          <p><b>Choose mode of Redeem</b></p>
                                       </div>
                                    </div>
                                    <!-- <div class="row">
                                       <div class="col-auto ml-3">
                                          <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>                    
                                       </div>
                                       <div class="col-auto">
                                          <i class="fa fa-id-card iconbackclr" aria-hidden="true"></i>
                                       </div>
                                       <div class="col-auto">
                                          <b>Groww Balance</b><br/>
                                          <h6>You can re-invest this money in just a single click</h6>
                                       </div>
                                    </div>
                                    <br> -->
                                    <div class="row">
                                       <div class="col-auto ml-3">
                                          <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>                    
                                       </div>
                                       <div class="col-auto">
                                          <i class="fa fa-university iconbackclr" aria-hidden="true"></i>
                                       </div>
                                       <div class="col-auto">
                                          <b>Transfer to Bank</b><br/>
                                          <h6>In your bank account within 4-5 working days</h6>
                                       </div>
                                    </div>
                                    <br>
                                    <div class="form-group text-center">
                                       <a href="transatn_sucs.html" class="btn btn-primary" id="confirm" style="width: 65%;">CONFIRM</a>
                                    </div>
                                    <div class="modal-footer">
                                       <a href="#" class="ForgetPwd">Safe And Secure</a>
                                    </div>
                                 </form>
                              </div>
                           </div>
                        </div>
                     </div>
                     <!-- <div class="row">
                        <div class="col-3 bg-success">
                          <p>Lorem ipsum...</p>
                        </div>
                        <div class="col-9">
                             <div class="row">
                                <div class="col-12 pull-right">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                             </div>
                             <div class="row">
                          <h4 class="modal-title">Modal Heading</h4>
                        </div>
                        </div>
                        </div> -->
                  </div>
               </div>
            </div>
         </div>
         <!-- modal end -->
