      <?php setlocale(LC_MONETARY,"en_IN"); ?>
      <!-- ============================================================== -->
      <!-- Start right Content here -->
      <!-- ============================================================== -->
      <div class="main-content " style="background-color: #fff; margin-left: 0px !important">
         <div class="page-content">
            <div class="row"><br></div>
            <div class="">
               <div class="container" style="background-color: #fff;">
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
                                          <h5 class="card-title"> Transaction History </h5>
                                       </div><!-- /.card-header -->
                                       <div class="card-body">
                                          <div class="row">
                                             <p id="siteurl" style="display: none;"><?= $CONFIG->siteurl; ?>__lib.ajax/mutual_fund.php</p>
                                             <div class="col-md-12">
                                                <table class="table table-striped table-bordered" id="sip_order_details">
                                                   <thead>
                                                      <tr>
                                                         <th scope="col"> Date <div class="arrow-down"></div></th>
                                                         <!--<th scope="col"> Folio<div class="arrow-down"></div></th>-->
                                                         <th scope="col"> Scheme Name<div class="arrow-down"></div></th>
                                                         <th scope="col">Amount<div class="arrow-down"></div></th>
                                                         <th scope="col">Investment Type<div class="arrow-down"></div></th>
                                                         <!-- <th scope="col">
                                                            CURRENT
                                                            <div class="arrow-down"></div>
                                                         </th>
                                                         <th scope="col">ACTIONS</th>
                                                         <th scope="col"></th> -->
                                                      </tr>
                                                   </thead>
                                                   <tbody>
                                                      <?php
                                                         $fetch_orders= $mutualFund->fetch_orders();
                                                         //print_r($fetch_orders);
                                                         // while(list($val,$key) as each($fetch_portfolio))
                                                         // echo "SELECT mf_nav_master.Scheme_Name,mf_cart_sys.amnt,mf_cart_sys.p_method,mf_cart_sys.date_sip,mf_cart_sys.mf_cart_id FROM mf_cart_sys inner join mf_nav_recomended on (mf_cart_sys.sch_id=mf_nav_recomended.pk_recomend_id) inner join mf_nav_master on (mf_nav_recomended.fr_nav_id= mf_nav_master.pk_nav_id)  where fr_usr_id=".$CONFIG->loggedUserId." AND cart_status='1'";
                                                         while (list($key,$val) = each($fetch_orders)) {
                                                            //print_r($val);
                                                         ?>
                                                            <tr>
                                                               <td><?php echo date('d-m-Y h:i:s A',strtotime($val['cart_timestamp'] . ' +330 minutes')); ?></td>
                                                               <!--<td><?= $val['folio']; ?></td>-->
                                                               <td><?= $val['scheme_name']; ?></td>
                                                               <td><?= money_format("%n", round($val['amnt'], 2)); ?></td>
                                                               <td>
                                                                  <?php 
                                                                     if ($val['p_method'] == 1) {
                                                                        echo "LumpSum";
                                                                     } else {
                                                                        echo "SIP";
                                                                     }
                                                                  ?>      
                                                               </td>
                                                            </tr>
                                                         <?php
                                                         }
                                                      ?>
                                                   </tbody>
                                                </table>
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
                                 <div class="col-xl-12">
                                    <div class="card">
                                       <div class="card-header p-3">
                                          <h5 class="card-title"> Transaction History </h5>
                                       </div>
                                       <div class="card-body">
                                          <table class="table table-striped table-bordered" id="will_order_details">
                                             <thead>
                                                <tr>
                                                   <th scope="col"> Date<div class="arrow-down"></div></th>
                                                   <th scope="col"> Transaction Id<div class="arrow-down"></div></th>
                                                   <th scope="col">Amount(in INR)<div class="arrow-down"></div></th>
                                                   <th scope="col">Status<div class="arrow-down"></div></th>
                                                </tr>
                                             </thead>
                                             <tbody>
                                                <?php
                                                   $willpayDetails = $willProfile->getWillPayDetails();
                                                   // print_r($willpayDetails);
                                                   while (list($key,$val) = each($willpayDetails)) {
                                                ?>
                                                   <tr>
                                                      <td><?php echo date('d-m-Y h:i:s A',strtotime($val['cart_timestamp'] . ' +330 minutes')); ?></td>
                                                      <td><?= $val['txn_id']; ?></td>
                                                      <td><?= money_format("%n", round($val['paid_amount'], 2)); ?></td>
                                                      <td><?= $val['response_msg']; ?></td>
                                                   </tr>
                                                <?php } ?>
                                             </tbody>
                                          </table>
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
         <!-- /.modal -->
         <!-- footer_end -->
         <!-- end main content-->
         <!-- END layout-wrapper -->
         <!-- Right Sidebar -->
         <!-- end slimscroll-menu-->
      </div>
      <!-- /Right-bar -->
      <!-- Right bar overlay-->