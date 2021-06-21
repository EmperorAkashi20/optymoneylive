<div class="page-content plan_goal wealth_goal mb-40">
   <div class="container">
      <div class="row">
         <div class="col-xl-12 col-lg-12">
            <div class="current_value">
               <div class="row">
                  <div class="col-md-4 col-sm-6 col-xs-12">
                     <div class="info-box">
                        <span class="info-box-icon bg-color"><i style="color: #FFF;" class="fa fa-arrow-down"></i><i style="color: #FFF;" class="fa fa-arrow-up"></i></span>
                        <div class="info-box-content">
                           <span class="info-box-text">Profit/Loss</span>
                           <span class="info-box-number"><h4><span id="profit_loss_rtn"></span></h4></span>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-4 col-sm-6 col-xs-12">
                     <div class="info-box">
                        <span class="info-box-icon bg-color"><img src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>img/investment_icon.png" alt="" style="width: 70%"></span>
                        <div class="info-box-content">
                           <span class="info-box-text">Invested Value</span>
                           <span class="info-box-number"><span id="invstd_val"></span></span>
                        </div>
                     </div>
                  </div>
                  <div class="clearfix visible-sm-block"></div>
                  <div class="col-md-4 col-sm-6 col-xs-12">
                     <div class="info-box">
                        <span class="info-box-icon bg-color" style="color: #FFF; ">PV</span>
                        <div class="info-box-content">
                           <span class="info-box-text">Present Value</span>
                           <span class="info-box-number"><span id="total_rtn"></span></span>
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
                  <div class="col-2">
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
                  <div class="col-10">
                     <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="v-pills-ba" role="tabpanel" aria-labelledby="v-pills-ba-tab">
                           <div class="panel-body-small2" id="balist">
                              <div class="row">
                                 <div class="col-md-12">
                                    <div class="card">
                                       <div class="card-header p-2">
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
                                                <div class="row">
                                                   <div class="col-md-12">
                                                      <p id="siteurl" style="display: none;"><?= $CONFIG->siteurl; ?>__lib.ajax/mutual_fund.php</p>
                                                      <table class="table table-striped table-bordered dt-responsive wrap" id='transaction_list'>
                                                         <thead>
                                                            <tr>
                                                               <th scope="col">SCHEME NAME</th>
                                                               <th scope="col">SCHEME TYPE</th>
                                                               <th scope="col">PURCHASE</th>
                                                               <th scope="col">CURRENT VALUE</th>
                                                               <th scope="col">UNITS</th>
                                                               <th scope="col">ABSOLUTE RETURNS</th>
                                                               <th scope="col">GAIN</th>
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
                                                               if($val["status"] == "active") {
                                                                  echo "---------------------------<br>".$key."-".$val[fr_scheme_code]."----";
                                                                  $get_sch_name_nav = $mutualFund->get_nav_latest($val[fr_scheme_code]);
                                                                  echo "<br>scheme nav : ".$get_sch_name_nav["fr_scheme_name"];
                                                                  while(list($key1,$val1) = each($val)) {
                                                                     //echo "<br>".$key1."-".$val1;
                                                                     $get_sch_name_nav = $mutualFund->get_nav_latest($key1);
                                                                     //echo "scheme nav".$get_sch_name_nav[fr_scheme_name];
                                                                     if($get_sch_name_nav[fr_scheme_name] != "") {
                                                                        if(gettype($key1) == "string") {
                                                            ?>
                                                            <tr>
                                                               <th>
                                                                  <a href="" class="dropdown-item hovrclr transacData" style="font-weight: bold;" data-id="<?php echo base64_encode($key1); ?>" data-val="<?php echo base64_encode($val[3]); ?>">
                                                                  <?php
                                                                     //get Latest NAV
                                                                     echo $get_sch_name_nav[fr_scheme_name];
                                                                     //Get Purchase Nav and Amount
                                                                     $get_pur_nav = $mutualFund->get_sch_nav($key1);
                                                                  ?>
                                                                  </a>
                                                               </th>
                                                               <td><div style="font-size:20px;"><?php echo $schemeType; ?></div></td>
                                                               <?php while(list($key2,$val2) = each($val1)) {
                                                                     $units = $val2[0];
                                                                     $amnt = $val2[1];
                                                               } $arr[$schemeType] = $amnt;?>
                                                               <td><div style="font-size:20px;">₹<spa ><?= round($amnt); ?></span></div></td>
                                                               <td><div style="font-size:20px;">₹<span class="profit_amt"><?php echo number_format(round($units*$get_sch_name_nav[net_asset_value]));  ?></span></div></td>
                                                               <td><div style="font-size:20px;"><?= $units; ?></div></td>
                                                               <td>
                                                                  <div style="font-size:20px;">
                                                                     <?php 
                                                                        $p_amnt = $amnt;
                                                                        $c_amnt = round($units*$get_sch_name_nav[net_asset_value]);
                                                                        echo round($mutualFund->absolute_return($c_amnt,$p_amnt),3)."%"; 
                                                                     ?>
                                                                  </div>
                                                               </td>
                                                               <td>
                                                                  <div style="font-size:20px;">
                                                                     <?php
                                                                        $profit = ($units*$get_sch_name_nav[net_asset_value])-$amnt; 
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
                                                                  </div>
                                                               </td>
                                                            </tr>
                                                            <?php
                                                                  $total_inv += $p_amnt;
                                                                        }
                                                                     }
                                                                  }
                                                               }
                                                            }
                                                            $temp = json_encode($arr);
                                                            ?>
                                                            <span id="invest_funds" style="display: none"><?php echo $temp; ?></span>
                                                            <input type="text" style="display: none" name="invest_amt" id="invest_amt" value="<?php echo  number_format(round($total_inv)); ?>">
                                                         </tbody>
                                                      </table>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div><!-- /.card-body -->
                                    </div>
                                    <!-- /.nav-tabs-custom -->
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="tab-pane fade" id="v-pills-smfb" role="tabpanel" aria-labelledby="v-pills-smfb-tab">
                           <div class="panel-body-small2">
                              <div class="row">
                                 <div class="col-xl-12" id="bnkacAddWrap">
                                    <div class="card">
                                       <div class="card-header p-2">
                                          <h5 class="card-title"> Summary </h5>
                                       </div>
                                       <div class="card-body">
                                          <p class="text-center">No Data Available</p>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="tab-pane fade" id="v-pills-ip" role="tabpanel" aria-labelledby="v-pills-ip-tab">
                           <div class="panel-body-small2">
                              <div class="row">
                                 <div class="col-xl-12" id="bnkacAddWrap">
                                    <div class="card">
                                       <div class="card-header p-2">
                                          <h5 class="card-title"> Summary </h5>
                                       </div>
                                       <div class="card-body">
                                          <p class="text-center">No Data Available</p>
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
               <div class="col-md-12 text-center"><h5>Set Your Goals</h5></div>
               <div class="col-md-3 col-sm-6 col-xs-12">
                  <div class="info-box" data-toggle="modal" data-target="#retirement_popup">
                     <span class="info-box-icon"><img src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>img/icon/Retirement-Icon.png" alt=""></span>
                     <div class="info-box-content">
                        <span class="info-box-text">Retire Rich</span>
                     </div>
                  </div>
               </div>
               <div class="col-md-3 col-sm-6 col-xs-12">
                  <div class="info-box" data-toggle="modal" data-target="#retirement_popup">
                     <span class="info-box-icon"><img src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>img/icon/Grand-Wedding.png" alt=""></span>
                     <div class="info-box-content">
                        <span class="info-box-text">Grand Wedding</span>
                     </div>
                  </div>
               </div>
               <div class="clearfix visible-sm-block"></div>
               <div class="col-md-3 col-sm-6 col-xs-12">
                  <div class="info-box" data-toggle="modal" data-target="#retirement_popup">
                     <span class="info-box-icon"><img src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>img/icon/Eucation.png" alt=""></span>
                     <div class="info-box-content">
                        <span class="info-box-text">Higher Education</span>
                     </div>
                  </div>
               </div>
               <div class="col-md-3 col-sm-6 col-xs-12">
                  <div class="info-box" data-toggle="modal" data-target="#retirement_popup">
                     <span class="info-box-icon"><img src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>img/icon/House-Icon.png" alt=""></span>
                     <div class="info-box-content">
                        <span class="info-box-text">Own A House</span>
                     </div>
                  </div>
               </div>
               <div class="col-md-3 col-sm-6 col-xs-12">
                  <div class="info-box" data-toggle="modal" data-target="#retirement_popup">
                     <span class="info-box-icon"><img src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>img/icon/Card-Icon.png" alt=""></span>
                     <div class="info-box-content">
                        <span class="info-box-text">Buy A Car</span>
                     </div>
                  </div>
               </div>
               <div class="col-md-3 col-sm-6 col-xs-12">
                  <div class="info-box" data-toggle="modal" data-target="#retirement_popup">
                     <span class="info-box-icon"><img src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>img/icon/Vacation.png" alt=""></span>
                     <div class="info-box-content">
                        <span class="info-box-text">Vacation Plan</span>
                     </div>
                  </div>
               </div>
               <div class="clearfix visible-sm-block"></div>
               <div class="col-md-3 col-sm-6 col-xs-12">
                  <div class="info-box" data-toggle="modal" data-target="#retirement_popup">
                     <span class="info-box-icon"><img src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>img/icon/Emergency-Fund-Icon.png" alt=""></span>
                     <div class="info-box-content">
                        <span class="info-box-text">Emergency Fund</span>
                     </div>
                  </div>
               </div>
               <div class="col-md-3 col-sm-6 col-xs-12">
                  <div class="info-box" data-toggle="modal" data-target="#retirement_popup">
                     <span class="info-box-icon"><img src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>img/icon/Goal.png" alt=""></span>
                     <div class="info-box-content">
                        <span class="info-box-text">Unique Goal</span>
                     </div>
                  </div>
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
                     <form action="wealth.html" class="login">
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
                           <button class="boxed_btn3 w-100" type="submit">ADD</button>
                        </div>
                        <div class="login_button">
                           <button class="boxed_btn3 w-100" type="submit">CANCEL</button>
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