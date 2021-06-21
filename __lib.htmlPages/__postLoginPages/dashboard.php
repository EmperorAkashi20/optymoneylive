   <div class="container">
            <div class="current_value">
               <div class="row">
                  <div class="col-md-4 col-sm-6 col-xs-12">
                     <div class="info-box">
                        <span class="info-box-icon bg-color"><img src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>img/investment_icon.png" alt="" style="width: 70%"></span>
                        <div class="info-box-content">
                           <span class="info-box-text">Invested Value</span>
                           <span class="info-box-number"><span id="invstd_val"></span></span>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-4 col-sm-6 col-xs-12">
                     <div class="info-box">
                        <span class="info-box-icon bg-color" style="color: #FFF; ">PV</span>
                        <div class="info-box-content">
                           <span class="info-box-text">Present Value</span>
                           <span class="info-box-number"><span id="total_rtn"></span></span>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-4 col-sm-6 col-xs-12">
                     <div class="info-box">
                        <span class="info-box-icon bg-color"><i style="color: #FFF;" class="fa fa-arrow-down"></i><i style="color: #FFF;" class="fa fa-arrow-up"></i></span>
                        <div class="info-box-content">
                           <span class="info-box-text">Profit/Loss</span>
                           <span class="info-box-number"><h4><span id="profit_loss_rtn"></span></h4></span>
                        </div>
                     </div>
                  </div>
                  <!--<div class="col-md-3 col-sm-6 col-xs-12">
                     <div class="info-box">
                        <span class="info-box-icon bg-color"><img src="<?php //echo $CONFIG->staticURL;?><?php //echo $CONFIG->theme_new; ?>img/cagr_icon.png" alt="" style="width: 70%"></span>
                        <div class="info-box-content">
                           <span class="info-box-text">CAGR</span>
                           <span class="info-box-number"></span>
                        </div>
                     </div>
                  </div>-->
               </div>
               
               <div class="row">
                  <div class="col-md-2 col-xs-12">
                     <div class="card">
                        <div class="card-body">
                           <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                              <a class="nav-link text-left active" id="v-pills-ba-tab" data-toggle="pill" href="#v-pills-ba" role="tab" aria-controls="v-pills-ba" aria-selected="true">Wealth</a>
                              <a class="nav-link text-left" id="v-pills-smfb-tab" data-toggle="pill" href="#v-pills-smfb" role="tab" aria-controls="v-pills-smfb" aria-selected="false">Will</a>
                              <a class="nav-link text-left" id="v-pills-ip-tab" data-toggle="pill" href="#v-pills-ip" role="tab" aria-controls="v-pills-ip" aria-selected="false">Income Tax</a>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-10 col-xs-12">
                     <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="v-pills-ba" role="tabpanel" aria-labelledby="v-pills-ba-tab">
                           <div class="panel-body-small2" id="balist">
                              <div class="row">
                                 <div class="col-md-12">
                                    <div class="card">
                                       <div class="card-header p-3">
                                          <ul class="nav nav-pills">
                                             <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Summary</a></li>
                                             <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Detailed Report</a></li>
                                          </ul>
                                       </div><!-- /.card-header -->
                                       <div class="card-body">
                                          <div class="tab-content">
                                             <div class="tab-pane active" id="activity">
                                                <div class="post">
                                                   <div class="row"><div class="col-md-12 text-center"><div id="chartInfo"></div></div></div>
                                                   <div class="row">
                                                      <div class="col-md-8">
                                                         <div class="chart">
                                                            <div class="chartjs-size-monitor">
                                                               <div class="chartjs-size-monitor-expand">
                                                                  <div class=""></div>
                                                               </div>
                                                               <div class="chartjs-size-monitor-shrink">
                                                                  <div class=""></div>
                                                               </div>
                                                            </div>
                                                            <!-- Sales Chart Canvas -->
                                                            <canvas id="barChart" width="400" height="400"></canvas>
                                                         </div>
                                                      </div>
                                                      <div class="col-md-4">
                                                         <div class="progress-group" id="fundsList">
                                                   
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                             <!-- /.tab-pane -->
                                             <div class="tab-pane" id="timeline">
                                                <div style="display:none">    
                                                   <table id="detailsMFTable">
                                                      <thead class="btn-primary-rect"> 
                                                            <tr>
                                                               <th>Date</th>
                                                               <th>Type</th>
                                                               <th>Units</th>
                                                               <th>NAV</th>
                                                               <th>Amount</th>
                                                               <!-- <th>Id</th>-->
                                                            </tr>
                                                      </thead>
                                                      <tbody></tbody>
                                                   </table>
                                                </div>
                                                <div class="row">
                                                   <p id="siteurl" style="display: none;"><?= $CONFIG->siteurl; ?>__lib.ajax/mutual_fund.php</p>
                                                   <div class="col-md-12">
                                                      <table class="table table-bordered " id='transaction_list'>
                                                         <thead>
                                                            <tr>
                                                               <th>Scheme&nbsp;Name</th>
                                                               <th>Scheme&nbsp;Type</th>
                                                               <th>Purchase</th>
                                                               <th>Unit</th>
                                                               <th>Current&nbsp;Value</th>
                                                               <th>Absolute&nbsp;Returns</th>
                                                               <th>Loss/Gain</th>
                                                               <th>Action</th>
                                                            </tr>
                                                         </thead>
                                                         <tbody>
                                                            <?php
                                                            $arr = array(); 
                                                            $total_amnt = 0;
                                                            $total_inv = 0;
                                                            $tot_c_amnt = 0;
                                                            $fetch_portfolio= $mutualFund->fetch_portfolio();
                                                            //echo "<script>var folioDataTemp = ".json_encode($fetch_portfolio)."; console.log('Folio : '+folioDataTemp);</script>";
                                                            //print_r($fetch_portfolio);
                                                            //die();
                                                            setlocale(LC_MONETARY,"en_IN");
                                                            while(list($key,$val) = each($fetch_portfolio)) {
                                                               $subarr = array(); 
                                                               $schemeType = $val["scheme_type"];
                                                               $units = $val["all_units"];
                                                               $amount = $val["amount"];
                                                               if($val["status"] == "active") {
                                                                  echo "<script>console.log('".implode(" ",$val)."');</script>";
                                                                  //print_r($val);
                                                                  //echo "<br><br>";
                                                                  //echo "scheme : ".$val["isin"];
                                                                  //echo "<br><br><br>";
                                                                  $get_sch_name_nav = $mutualFund->get_nav_latest($val[fr_scheme_code]);
                                                                  $schemeType = $get_sch_name_nav["scheme_type"];
                                                                  //$get_nav = $mutualFund->get_per_nav($get_sch_name_nav["isin"],1);
                                                                  /*echo "<br>";
                                                                  print_r($get_sch_name_nav);
                                                                  echo "<br>get schemename nav<br>";
                                                                  print_r($get_nav);*/
                                                                  //echo "get_sch_name_nav[fr_scheme_name] : ".$get_sch_name_nav[fr_scheme_name]."<br>";
                                                                  //while(list($key1,$val1) = each($val)) {
                                                                  if($get_sch_name_nav[fr_scheme_name] != "") {
                                                                     //if(gettype($key1) == "string") {
                                                            ?>
                                                            <tr>
                                                               <th>
                                                                  <a href="" class="dropdown-item hovrclr transacData" style="font-weight: bold;" data-id="<?php echo base64_encode($val[fr_scheme_code]); ?>" data-val="<?php echo base64_encode($val[folio]); ?>">
                                                                     <?php
                                                                        //get Latest NAV
                                                                        $str = explode("-",$val[fr_scheme_name]);
                                                                        foreach ($str as $value) {
                                                                           echo "$value <br>";
                                                                         }
                                                                        //Get Purchase Nav and Amount
                                                                        //$get_pur_nav = $mutualFund->get_sch_nav($val[fr_scheme_code]);
                                                                     ?>
                                                                  </a>
                                                               </th>
                                                               <td><?php echo $schemeType; ?></td>
                                                               <td><?= money_format("%n", round($val["amount"], 2)); ?></td>
                                                               <td><?= round($units, 3); ?></td>
                                                               <td><span class="profit_amt"><?php $profitamt = $units*$get_sch_name_nav[net_asset_value]; echo money_format("%n", round($profitamt, 2)); /*echo "<br>Today's NAV : ".$get_sch_name_nav[net_asset_value];*/ ?></span></td>
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
                                                                     $pnv = number_format($profit);
                                                                     if ($pnv > 0) {
                                                                        echo '<i style="color: GREEN;" class="fa fa-arrow-up"></i>';
                                                                     }
                                                                     if ($pnv == 0) {
                                                                        $message = "Zero";
                                                                     }
                                                                     if ($pnv < 0) {
                                                                        echo '<i style="color: RED;" class="fa fa-arrow-down"></i>';
                                                                     }
                                                                     echo money_format("%n", round($profit, 2));
                                                                  ?>
                                                               </td>
                                                               <td>
                                                                  <div class="dropdown">
                                                                     <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                        <i class="fa fa-ellipsis-h" aria-hidden="true"></i>
                                                                     </button>
                                                                     <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                                        <a href="?module_interface=<?php echo $commonFunction->setPage('single_product'); ?>&id=<?php echo base64_encode($val['pk_nav_id']);?>&nav=<?php echo base64_encode($get_nav);?>" data-sch="<?= $get_sch_name_nav['fr_scheme_name']; ?>" data-amnt="<?= $c_amnt; ?>" class="dropdown-item hovrclr" style="font-weight: bold;">Purchase</a>
                                                                        <a href="#" data-sch="<?= $get_sch_name_nav['fr_scheme_name']; ?>" data-folio="<?php echo $val['folio']; ?>" data-schemecode="<?php echo $val['bse_scheme_code']; ?>" data-amnt="<?= $c_amnt; ?>" class="dropdown-item hovrclr redeem" style="font-weight: bold;">Redeem</a>
                                                                     </div>
                                                                  </div>
                                                               </td>
                                                            </tr>
                                                            <?php
                                                                  $tot_c_amnt += $c_amnt;
                                                                  $total_inv += $val["amount"];
                                                                  $tot_profit += $profit;
                                                                        //}
                                                                     }
                                                                  //}
                                                                  if (array_key_exists($schemeType,$arr)) { 
                                                                     $p_amnt = $arr[$schemeType] + $val["amount"];
                                                                  }
                                                                  //$subarr[$schemeType] = $p_amnt;
                                                                  $arr[$schemeType]=$p_amnt;
                                                                  //print_r($arr);
                                                               }
                                                            }
                                                            //echo "tot : ".$total_inv;
                                                            $temp = json_encode($arr);
                                                            ?>
                                                            <span id="invest_funds" style="display: none"><?php echo $temp; ?></span>
                                                            <input type="text" style="display: none" name="invest_amt" id="invest_amt" value="<?php echo  number_format($total_inv); ?>">
                                                            <input type="text" style="display: none" name="tot_profit" id="tot_profit" value="<?php echo  number_format($tot_profit); ?>">
                                                            <input type="text" style="display: none" name="tot_c_amnt" id="tot_c_amnt" value="<?php echo  number_format($tot_c_amnt); ?>">
                                                         </tbody>
                                                      </table>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div><!-- /.card-body -->
                                       <div> 
                                          <?php 
                                             //$child= $mutualFund->fetch_child(); 
                                             //echo "Child : ".$child;
                                          ?>
                                       </div>
                                    </div>
                                    <!-- /.nav-tabs-custom -->
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="tab-pane fade" id="v-pills-smfb" role="tabpanel" aria-labelledby="v-pills-smfb-tab">
                           <div class="panel-body-small2">
                              <div class="row">
                                 <div class="col-xl-12">
                                    <div class="card">
                                       <div class="card-header p-3">
                                          <h5 class="card-title"> Summary </h5>
                                       </div>
                                       <div class="card-body">
                                          <?php 
                                             $activeTab1 = $willProfile->getPayStatus();
                                             $activeTab = $activeTab1[0]['pay_status'];
                                             if($activeTab==1) { ?>
                                                <a href="<?php echo $activeTab1[0]['url_link']; ?>" target="_blank">Download PDF</a>
                                          <?php } else {?>
                                          <p class="text-center">No Data Available</p>
                                          <?php } ?>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="tab-pane fade" id="v-pills-ip" role="tabpanel" aria-labelledby="v-pills-ip-tab">
                           <div class="panel-body-small2">
                              <div class="row">
                                 <div class="col-md-12">
                                    <div class="card">
                                       <div class="card-header p-3">
                                          <h5 class="card-title"> Documents </h5>
                                       </div>
                                       <div class="card-body">
                                          <table class="table table-bordered " id='doc_list'>
                                             <thead>
                                                <tr>
                                                   <th>Name of the document</th>
                                                   <th>Document Number</th>
                                                   <th>View </th>
                                                   <th>Download</th>
                                                </tr>
                                             </thead>
                                             <tbody>
                                                
                                             </tbody>
                                          </table>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
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
         <div class="col-xl-12 col-lg-12">
            <div class="row current_value">
               <div class="col-md-12 section-title text-center"><h5>Set Your Goals</h5></div>
               <div class="col-md-3 col-sm-6 col-xs-12">
                  <a href="?module_interface=<?php echo $commonFunction->setPage('all_product'); ?>&offer=25">
                     <div class="info-box" data-toggle="modal" data-target="#retirement_popup">
                        <span class="info-box-icon"><img src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>img/icon/Retirement-Icon.png" alt=""></span>
                        <div class="info-box-content">
                           <span class="info-box-text">Retire Rich</span>
                        </div>
                     </div>
                  </a>
               </div>
               <div class="col-md-3 col-sm-6 col-xs-12">
                  <a href="?module_interface=<?php echo $commonFunction->setPage('all_product'); ?>&offer=24">
                     <div class="info-box" data-toggle="modal" data-target="#retirement_popup">
                        <span class="info-box-icon"><img src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>img/icon/Grand-Wedding.png" alt=""></span>
                        <div class="info-box-content">
                           <span class="info-box-text">Grand Wedding</span>
                        </div>
                     </div>
                  </a>
               </div>
               <div class="col-md-3 col-sm-6 col-xs-12">
                  <a href="?module_interface=<?php echo $commonFunction->setPage('all_product'); ?>&offer=26">
                     <div class="info-box" data-toggle="modal" data-target="#retirement_popup">
                        <span class="info-box-icon"><img src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>img/icon/Eucation.png" alt=""></span>
                        <div class="info-box-content">
                           <span class="info-box-text">Higher Education</span>
                        </div>
                     </div>
                  </a>
               </div>
               <div class="col-md-3 col-sm-6 col-xs-12">
                  <a href="?module_interface=<?php echo $commonFunction->setPage('all_product'); ?>&offer=27">
                     <div class="info-box" data-toggle="modal" data-target="#retirement_popup">
                        <span class="info-box-icon"><img src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>img/icon/House-Icon.png" alt=""></span>
                        <div class="info-box-content">
                           <span class="info-box-text">Own A House</span>
                        </div>
                     </div>
                  </a>
               </div>
               <div class="col-md-3 col-sm-6 col-xs-12">
                  <a href="?module_interface=<?php echo $commonFunction->setPage('all_product'); ?>&offer=28">
                     <div class="info-box" data-toggle="modal" data-target="#retirement_popup">
                        <span class="info-box-icon"><img src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>img/icon/Card-Icon.png" alt=""></span>
                        <div class="info-box-content">
                           <span class="info-box-text">Buy A Car</span>
                        </div>
                     </div>
                  </a>
               </div>
               <div class="col-md-3 col-sm-6 col-xs-12">
                  <a href="?module_interface=<?php echo $commonFunction->setPage('all_product'); ?>&offer=29">
                     <div class="info-box" data-toggle="modal" data-target="#retirement_popup">
                        <span class="info-box-icon"><img src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>img/icon/Vacation.png" alt=""></span>
                        <div class="info-box-content">
                           <span class="info-box-text">Vacation Plan</span>
                        </div>
                     </div>
                  </a>
               </div>
               <div class="col-md-3 col-sm-6 col-xs-12">
                  <a href="?module_interface=<?php echo $commonFunction->setPage('all_product'); ?>&offer=30">
                     <div class="info-box" data-toggle="modal" data-target="#retirement_popup">
                        <span class="info-box-icon"><img src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>img/icon/Emergency-Fund-Icon.png" alt=""></span>
                        <div class="info-box-content">
                           <span class="info-box-text">Emergency Fund</span>
                        </div>
                     </div>
                  </a>
               </div>
               <div class="col-md-3 col-sm-6 col-xs-12">
                  <a href="?module_interface=<?php echo $commonFunction->setPage('all_product'); ?>&offer=31">
                     <div class="info-box" data-toggle="modal" data-target="#retirement_popup">
                        <span class="info-box-icon"><img src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>img/icon/Goal.png" alt=""></span>
                        <div class="info-box-content">
                           <span class="info-box-text">Unique Goal</span>
                        </div>
                     </div>
                  </a>
               </div>
            </div>
            <div class="modal fade custom_login_from" id="book_expert" tabindex="-1" role="dialog" aria-hidden="true">
               <div class="modal-dialog modal-dialog-centered noscroll_popup" role="document">
                  <div class="modal-content">
                     <div class="modal-body ">
                        <div class="login_form">
                           <div class="login_heading">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h3> Hire our experts to optimize your tax returns</h3>
                           </div>
                           <div class="main_content">
                              <form  class="login">
                                 <div class="single_input">
                                    <input type="text" autocomplete="off" class="" placeholder="Name" id="eca_name">
                                    <span id="eca_name_error" class="bottom_error"></span>
                                 </div>
                                 <div class="single_input">
                                    <input type="email" class="" autocomplete="off" placeholder="Enter your email" id="eca_email">
                                    <span id="eca_email_error" class="bottom_error"></span>
                                 </div>
                                 <div class="single_input">
                                    <input type="tel" class="" autocomplete="off" placeholder="Phone Number" id="eca_mob">
                                    <span id="eca_mob_error" class="bottom_error"></span>
                                 </div>
                                 <div class="login_button">
                                    <button class="boxed_btn3 w-100" type="submit" id="hire_now">Hire Expert Now</button>
                                 </div>
                              </form>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
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
                                 <div id="redemption_error" class="redemption_error"></div>
                                 <form id="redeemForm" action="<?= $CONFIG->siteurl; ?>__lib.ajax/mutual_fund.php?action=p_to_redeem&subaction=submit">
                                    <div class="first-show">
                                       <div class="row">
                                          <p>Total Redeemable Amount (as per latest NAV)<BR/>₹<span class="all_units" id="all_units"></span></p>
                                       </div>
                                       <div class="form-group">
                                          <label class="form-label">Redeem Amount<span class="required">*</span></label>
                                          <input type="text" name="redeem_amnt" class="form-control" id="redeem_amnt" value="">
                                       </div>
                                       <input type="hidden" name="redeem_folio" class="form-control" id="redeem_folio" value="">
                                       <input type="hidden" name="redeem_scheme_id" class="form-control" id="redeem_scheme_id" value="">
                                       <input type="hidden" name="redeem_order_id" class="form-control" id="redeem_order_id" value="">
                                       <input type="hidden" name="redeem_all_amount" class="form-control" id="redeem_all_amount" value="">
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
                                    </div>
                                    <div class="second-show" style="display: none;">
                                       <div class="row">
                                          <p>Total Redeemable Amount (as per latest NAV)<BR/>₹<span class="all_units"></span></p>
                                       </div>
                                       <div class="form-group"><span id="redeemAmt"></span>
                                          <a href="#" class="anchclrs"> CHANGE AMOUNT</a>
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
                                    </div>
                                    <div class="third-show" style="display: none;">
                                       
                                       <div class="row ml-1">
                                          <p>Redemption of <span id="redeemAmt_third"></span></p>
                                       </div>
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
                                          <a href="" class="btn btn-primary" id="confirm" style="width: 65%;">CONFIRM</a>
                                       </div>
                                       <div class="modal-footer">
                                          <a href="#" class="ForgetPwd">Safe And Secure</a>
                                       </div>
                                    </div>
                                 </form>
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
         </div>
   </div>
<!--
   <button class="btn gen_wealth_report">Generate Report</button>
   -->
<!-- popup form -->
<div class="plan_goal_popup">
   <div class="modal fade custom_login_from" id="retirement_popup1" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
         <div class="modal-content">
            <div class="modal-body ">
               <div class="login_form">
                  <div class="login_heading">
                     <h3>Build Wealth</h3>
                  </div>
                  <div class="main_content">
                     <form action="" class="login">
                        In How many years do you want to accumulate wealth ?
                        <div class="multi_input">
                           <input type="number" placeholder="In Years" >
                        </div>
                        <div class="multi_input">
                           <input type="number" placeholder="In Months" >
                        </div>
                        Switch to date input
                        <div class="single_input">
                           How much wealth do you want to accumulate?
                           <input type="number" placeholder="Eg:500000" >
                        </div>
                        <div class="login_heading">
                           <!--Lorem ipsum dolor sit duis aute irure dolor in reprehent in the voluptate velit esse cillum dolore eu fugiat nulla pariatur. -->
                        </div>
                        <div class="login_button">
                           <a href="?module_interface=<?php echo $commonFunction->setPage('all_product'); ?>&offer=" class="boxed_btn3 w-100">ADD</a>
                        </div>
                        <div class="login_button">
                           <button class="boxed_btn3 w-100" type="button">CANCEL</button>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!--/ popup form -->
<!-- view doc modal -->
<div id="docViewModal" class="modal fade" role="dialog">
   <div class="modal-dialog modal-lg">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
         </div>
         <div class="modal-body">
            <embed src="~/Content/Article List.pdf" frameborder="0" width="100%" height="400px" id="docDetail">
            <div class="modal-footer">
               <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
         </div>
      </div>
   </div>
</div>