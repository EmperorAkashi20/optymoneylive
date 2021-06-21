      <!-- ============================================================== -->
      <!-- Start right Content here -->
      <!-- ============================================================== -->
      <div class="main-content " style="background-color: #fff; margin-left: 0px !important">
         <div class="page-content">
            <div class="row"><br></div>
            <div class="">
               <div class="container" style="background-color: #fff;">
                  <div class="row">
                     <div class="col-md-12">
                        <nav>
                           <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist" style="width: 65%;">
                              <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Mutual Funds</a>
                              <div class="text-center"><a href="?module_interface=<?php echo $commonFunction->setPage('all_product'); ?>" class="btn btn-danger">NEW INVESTMENT</a></div>
                           </div>
                        </nav>
                        <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
                           <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                              <div class="current_value">
                                 <div class="row">
                                    <div class="col-xs-3 col-sm">
                                       <h4><span id="all_amt"></span></h4>
                                       <div>TOTAL CURRENT VALUE</div>
                                    </div>
                                    <div class="text-left col-auto">
                                       <p>Invested Value:<span id="invstd_val"></span></p>
                                       <p>Total Returns: <span id="total_rtn"></span></p>
                                       <!-- <p >XIRR</p> -->
                                    </div>
                                    <!-- <div class="col-auto text-left">
                                       <div >
                                          <h6>₹1,000</h6>
                                       </div>
                                       <div style="font-weight: bold;">+ ₹87<a href="#" style="color: #d33633">&nbsp;(8.7%)</a></div>
                                       <div > <a href="#" style="color: #d33633"> N.A</a></div>
                                    </div>
                                    <div class="col-auto text-left">
                                       <div>
                                          <p> See how your investments are doing</p>
                                       </div>
                                       <div class="text-right"> <a href="#" style="color: #d33633" class="port">PORTFOLIO INSIGHT <i class="fa fa-line-chart"></i></a></div>
                                    </div> -->
                                 </div>
                              </div>
                              <div class="row"><br/><br/></div>
                              <div style="display:none">    
                                 <table id="detailsMFTable">
                                    <thead class="btn-primary-rect"> 
                                          <tr>
                                             <th>Date</th>
                                             <th>Type</th>
                                             <th>Units</th>
                                             <th>NAV</th>
                                             <th>Amount</th>
                                             <th>Id</th>
                                          </tr>
                                    </thead>
                                    <tbody></tbody>
                                 </table>
                              </div>
                              <div class="row">
                                 <div class="col-md-12">
                                    <p id="siteurl" style="display: none;"><?= $CONFIG->siteurl; ?>__lib.ajax/mutual_fund.php</p>
                                    <table class="table table-bordered" id='transaction_list' style="font-size: 12px">
                                       <thead>
                                          <tr>
                                             <th>SCHEME NAME</th>
                                             <th>SCHEME TYPE</th>
                                             <th>PURCHASE</th>
                                             <th>CURRENT VALUE</th>
                                             <th>UNITS</th>
                                             <th>ABSOLUTE RETURNS</th>
                                             <th>GAIN</th>
                                             <th>ACTIONS</th>
                                             
                                          </tr>
                                       </thead>
                                       <tbody>
                                          <?php
                                          $arr = array(); 
                                          $total_amnt = 0;
                                          $total_inv = 0;
                                          $fetch_portfolio= $mutualFund->fetch_portfolio();
                                          //print_r($fetch_portfolio);
                                          //die();
                                          while(list($key,$val) = each($fetch_portfolio)) {
                                             $subarr = array(); 
                                             $schemeType = $val["scheme_type"];
                                             $units = $val["all_units"];
                                             $amount = $val["amount"];
                                             if($val["status"] == "active") {
                                                //echo "<br>".$key;
                                                //print_r($val);
                                                //echo "<br>";
                                                $get_sch_name_nav = $mutualFund->get_nav_latest($val[fr_scheme_code]);
                                                $schemeType = $get_sch_name_nav["scheme_type"];
                                                //echo "<br>scheme nav : ".$get_sch_name_nav["fr_scheme_name"];
                                                //echo "<br>scheme nav price: ".$get_sch_name_nav["net_asset_value"];
                                                //echo "<br>scheme Type: ".$get_sch_name_nav["Scheme_Type"];
                                                //while(list($key1,$val1) = each($val)) {
                                                if($get_sch_name_nav[fr_scheme_name] != "") {
                                                   //if(gettype($key1) == "string") {
                                          ?>
                                          <tr>
                                             <th>
                                                <a href="" class="dropdown-item hovrclr transacData" style="font-weight: bold;" data-id="<?php echo base64_encode($val[fr_scheme_code]); ?>" data-val="<?php echo base64_encode($val[folio]); ?>">
                                                <?php
                                                   //get Latest NAV
                                                   echo $get_sch_name_nav[fr_scheme_name];
                                                   //Get Purchase Nav and Amount
                                                   $get_pur_nav = $mutualFund->get_sch_nav($val[fr_scheme_code]);
                                                ?>
                                                </a>
                                             </th>
                                             <td><?php echo $schemeType; ?></td>
                                             <td>₹<?= round($amount); ?></td>
                                             <td>₹<span class="profit_amt"><?php echo number_format(round($units*$get_sch_name_nav[net_asset_value]));  ?></span></td>
                                             <td><?= $units; ?></td>
                                             <td>
                                                <?php 
                                                   $p_amnt = $amount;
                                                   $c_amnt = round($units*$get_sch_name_nav[net_asset_value]);
                                                   echo round($mutualFund->absolute_return($c_amnt,$p_amnt),3)."%"; 
                                                ?>
                                             </td>
                                             <td>
                                                <?php
                                                   $profit = ($units*$get_sch_name_nav[net_asset_value])-$amount; 
                                                   $pnv = number_format(round($profit));
                                                   if ($pnv > 0) {
                                                      echo '<i style="color: GREEN;" class="fa fa-arrow-up"></i>';
                                                   }
                                                   if ($pnv == 0) {
                                                      $message = "Zero";
                                                   }
                                                   if ($pnv < 0) {
                                                      echo '<i style="color: RED;" class="fa fa-arrow-down"></i>';
                                                   }
                                                   echo "&nbsp;&nbsp;₹".number_format(round($profit));
                                                ?>
                                             </td>
                                             <!-- <td><a href="" style="color: #d33633">INVEST</a></td> -->
                                             <td>
                                                <div class="bs-example">
                                                   <a href="#" data-sch="<?= $get_sch_name_nav[fr_scheme_name]; ?>" data-amnt="<?= $amnt; ?>" class="dropdown-item hovrclr redeem" style="font-weight: bold;">Redeem</a>
                                                </div>
                                             </td>
                                          </tr>
                                          <?php
                                                $total_inv += $p_amnt;
                                                      //}
                                                   }
                                                //}
                                             }
                                          }
                                          ?>
                                          <input type="text" style="display: none" name="invest_amt" id="invest_amt" value="<?php echo  number_format(round($total_inv)); ?>">
                                       </tbody>
                                    </table>
                                 </div>
                              </div>
                           </div>
                           <div class="tab-pane fade card" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                              <div class="row">
                                 <div class="col-sm-6">
                                    <div class="card">
                                       <div class="card-body">
                                          <img src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>img/Round-Flow-Chart.png" style="width: 100%; height: 100%">
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-sm-6">
                                    <div class="card">
                                       <div class="card-body" style="min-height: 334px;">
                                          <p class="card-text">Introducing</p>
                                          <h5 class="card-title">Stocks</h5>
                                          <br><br>
                                          <p class="card-text">Investing in stocks will never be the <br>same again.</p>
                                          <br><br>
                                          <div class="col text-center"><a href="#" class="btn btn-primary" style="width: 100%;">TRY IT OUT</a></div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                              <div class="row">
                                 <div class="col-sm-6">
                                    <div class="card">
                                       <div class="card-body">
                                          <img src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>img/Round-Flow-Chart.png" style="width: 100%; height: 100%">
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-sm-6">
                                    <div class="card">
                                       <div class="card-body" style="min-height: 334px;">
                                          <p class="card-text"></p>
                                          <h5 class="card-title">No investments yet?</h5>
                                          <br><br>
                                          <p class="card-text">Start your investment journey today. Your<br>future self will thank you for this day.</p>
                                          <br><br>
                                          <div class="col text-center"><a href="#" class="btn btn-primary" style="width: 100%;">BUY GOLD</a></div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- end container-fluid -->
            </div>
            <!-- end page-content-wrapper -->
         </div>
         <!-- End Page-content -->
         <!-- footer_start -->
         <!-- sample modal content -->
         <div id="delete_popup" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
               <div class="modal-content">
                  <div class="modal-header">
                     <h5 class="modal-title mt-0" id="myModalLabel"><i class="fa fa-trash confirm_del_icon"></i></h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                     </button>
                  </div>
                  <div class="modal-body">
                     <h3 class="font-size-16">Are you sure you want to remove this fund from your cart?</h3>
                  </div>
                  <div class="modal-footer">
                     <button type="button" class="btn btn-secondary waves-effect modal_cancel" data-dismiss="modal">Cancel</button>
                     <button type="button" class="btn btn-primary waves-effect waves-light modal_remove">Remove</button>
                  </div>
               </div>
               <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
         </div>
      
<!-- The Modal -->
         <div class="modal fade" id="redeem_val">
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
                                 <span class="ml-2" id="sch_n"></span>
                              </h6>
                              <div class="row"><br/></div>
                              <div class="first-show">
                                 <div class="row">
                                    <p>Total Redeemable Amount (as per latest NAV)<BR/>₹<span class="all_units" id="all_units"></span></p>
                                 </div>
                                 <form>
                                    <div class="form-group">
                                       <!-- <input type="text" class="form-control" placeholder="Your Email *" value="" /> -->
                                       <input type="number" required="required" name="name" class="form-control" id="redeem_amnt" value="">
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
                                    <p>Total Redeemable Amount (as per latest NAV)<BR/>₹<span  class="all_units"></span></p>
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
      </div>
      <!-- /Right-bar -->
      <!-- Right bar overlay-->