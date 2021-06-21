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
                              <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">SYSTEMETIC INVESTMENT PLAN(SIP)</a>
                              
                              <div class="text-center"><a href="?module_interface=<?php echo $commonFunction->setPage('all_product'); ?>" class="btn btn-success">NEW INVESTMENT</a></div>
                           </div>
                        </nav>
                        <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
                           <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                              <div class="row"><br/><br/></div>
                              <div class="row">
                                 <table class="table table-bordered" id="sip_details">
                                    <thead>
                                       <tr>
                                          <th scope="col">
                                             SCHEME NAME
                                             <div class="arrow-down"></div>
                                          </th>
                                          <th scope="col">
                                             DAY CHANGE
                                             <div class="arrow-down"></div>
                                          </th>
                                          <th scope="col">
                                             RETURNS
                                             <div class="arrow-down"></div>
                                          </th>
                                          <th scope="col">
                                             CURRENT
                                             <div class="arrow-down"></div>
                                          </th>
                                          <th scope="col">ACTIONS</th>
                                          <th scope="col"></th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       <?php
                                          $fetch_portfolio= $mutualFund->fetch_portfolio();
                                          //print_r($fetch_portfolio);
                                          // while(list($val,$key) as each($fetch_portfolio))
                                          while(list($key,$val) = each($fetch_portfolio))
                                          {
                                             while(list($key1,$val1) = each($val))
                                             {
                                                //print_r($val1);
                                             }
                                          }
                                       ?>
                                    </tbody>
                                 </table>
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
         <!-- /.modal -->
         <!-- footer_end -->
         <!-- end main content-->
         <!-- END layout-wrapper -->
         <!-- Right Sidebar -->
         <!-- end slimscroll-menu-->
      </div>
      <!-- /Right-bar -->
      <!-- Right bar overlay-->