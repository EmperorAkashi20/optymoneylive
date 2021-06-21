<?php
$fetch_offer_name = $mutualFund->get_offer_list();
//echo "string";
// print_r($fetch_offer_name);
?>
<header class="masthead" style="background-image: url('<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>img/bannerBG.svg');">
  <div class="container h-100">
  	<img src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>img/investmentvector.svg" class="vector"/>
    <div class="row h-100 align-items-center">
      <div class="col-12 text-left">
        <h1 class="font-weight-light">Wealth</h1>
        <p class="lead">Grow your wealth with the best mutual funds</p>
      </div>
    </div>
  </div>
</header>
<body data-layout="horizontal" data-layout-size="boxed">
   <!-- Begin page -->
   <div id="layout-wrapper">
      <!-- ============================================================== -->
      <!-- Start right Content here -->
      <!-- ============================================================== -->
      <div class="main-content">
         <div class="container">
            <div class="row">
               <div class="col-md-12 mt-3 mb-3 text-center">
               <?php
                  //$fetch_offer_name = $mutualFund->fetch_Scheme_Type($fetch_offer_name);
                  while(list($offer_key,$offer_val) = each($fetch_offer_name)) {
                     if($offer_val[offer_group]!="dataanalytics") {
               ?>
                  <button class="bordered_btn offer_id" data-val="<?php echo $offer_val[pk_offer_id]; ?>"><?php echo $offer_val[offer_name];?></button>
               <?php  } } ?>
               </div>
            </div>
            <div class="row">
               <aside class="col-sm-4">
                  <div class="row">
                     <div class="col-md-6">
                        <p class="title">FILTERS</p>
                     </div>
                     <div class="col-md-6">
                        <p style="float:right;"><a href="#" id="clear_all">CLEAR ALL</a></p>
                     </div>
                  </div>
                  <div class="card">
                     <article class="card-group-item">
                        <a href="#demoss" data-toggle="collapse">
                           <header class="card-header">
                              <h6 class="title"> AMC </h6>
                        </a>
                        </header>
                        <form class="app-search d-none d-lg-block" action="#">
                           <div class="position-relative">
                              <input type="text" class="form-control" id="srch_amc" placeholder="Search AMC">
                           </div>
                        </form>
                        <div class="filter-content" id="demoss" class="collapse">
                           <form>
                              <div class="card-body" id="all_amc">
                                 <div class="hummingbird-treeview well h-scroll-large">
                                    <ul class="hummingbird-base">
                                    <?php
                                       $search = "";
                                       $fetch_Scheme_name = $mutualFund->fetch_AMC_Code($search);
                                       foreach ($fetch_Scheme_name as $key) {
                                    ?>
                                       <li>
                                          <label> 
                                             <input class="hummingbirdNoParent amc_code" name="amc_code" value="<?php echo $key['mf_schema_id']; ?>" type="checkbox"> 
                                             <?php echo str_ireplace("_", " ", $key['amc_name_act']); ?>
                                          </label>
                                       </li>
                                    <?php } ?>
                                    </ul>
                                 </div>
                              </div>
                              <!-- card-body.// -->
                           </form>
                        </div>
                     </article>
                     <!-- Category section starts -->
                     <article class="card-group-item">
                        <a href="#demoss1" data-toggle="collapse">
                           <header class="card-header">
                              <h6 class="title"> Category </h6>
                           </header>
                        </a>
                        <div class="filter-content" id="demoss1">
                           <div class="card-body">
                              <div id="treeview_container" class="hummingbird-treeview well h-scroll-large">
                                 <ul id="treeview" class="hummingbird-base">
                                    <?php
                                       $i = 1;
                                       $fetch_Scheme_Type = $mutualFund->fetch_Scheme_Type($type);
                                       while(list($key,$val) = each($fetch_Scheme_Type)) {
                                          //print_r ($val);
                                    ?>
                                       <li>
                                          <i class="fa fa-plus"></i> 
                                          <label> <input id="category<?= $i; ?>" class="schm_type" data-id="category<?= $i; ?>" value="<?php echo base64_encode($key); ?>" type="checkbox"> <?php echo str_replace("_"," ",$key);?></label>
                                          <ul style="margin-left: 40px;">
                                             <?php
                                                while(list($key1,$val1) = each($val)) {
                                                   while(list($key2,$val2) = each($val1)) {
                                             ?>
                                             <li><label> <input class="hummingbirdNoParent schm_type" id="<?php echo base64_encode($val2[0]); ?>" value="<?php echo base64_encode($val2[0]); ?>" type="checkbox"> <?php echo ucwords(str_replace("_"," ",$val2[1]));?></label></li>
                                             <?php } } ?>
                                          </ul>
                                       </li>
                                    <?php } ?>
                                 </ul>
                              </div>
                           </div>
                           <!-- card-body.// -->
                        </div>
                     </article>
                     <!-- <article class="card-group-item">
                        <a href="#demoss2" data-toggle="collapse">
                           <header class="card-header">
                              <h6 class="title"> Risk </h6>
                           </header>
                        </a>
                        <div class="filter-content" id="demoss2">
                           <div class="card-body">
                           <?php
                                 //$fetch_risk = $mutualFund->fetch_risk();
                                 //print_r($fetch_Scheme_Type);
                                 //foreach ($fetch_risk as $key3) {
                              ?>
                              <?php
                                 //foreach ($CONFIG->risk as $key4 => $value4) {
                                    //if($key4 == $key3['sch_risk']) {
                              ?>
                                 <label class="form-check">
                                    <input class="form-check-input sch_risk" type="checkbox" name="sch_risk" value="<?php echo "'".$key3['sch_risk']."'"; ?>">
                                    <span class="form-check-label">
                                       <?php  //echo $value4; ?>
                                    </span>
                                 </label>
                              <?php //} } } ?>
                           </div>
                        </div>
                     </article> -->
                     <!--<article class="card-group-item">
                        <a href="#demoss3" data-toggle="collapse">
                           <header class="card-header">
                              <h6 class="title"> Fund Size </h6>
                           </header>
                        </a>
                        <div class="filter-content" id="demoss3">
                           <div class="card-body">
                              <?php
                                 $fetch_fund_size = $mutualFund->fetch_fund_size();
                                 //print_r($fetch_fund_size);
                                 foreach ($fetch_fund_size as $key5) {
                              ?>
                              <?php if(!empty($key5['sch_fund_size'])) { ?>
                                 <label class="form-check">
                                    <input class="form-check-input sch_fund_size" type="checkbox" name="sch_fund_size" value="<?php echo $key5['sch_fund_size']; ?>">
                                    <span class="form-check-label">
                                       <?php echo $key5['sch_fund_size'];    ?>
                                    </span>
                                 </label>
                              <?php } } ?>
                           </div>
                        </div>
                     </article>-->
                  </div>
                  <!-- card.// -->
               </aside>
               <aside class="col-sm-8">
                  <div class="row">
                     <div class="col-sm-8">
                        <p class="title"> ALL MUTUAL FUNDS</p>
                     </div>
                  </div>
                  <input type="hidden" id="goalSelect" value="<?php echo $_GET[offer]; ?>">
                  <div class="row" id="all_pr_fetch"> </div>
                  <div class="row text-center">
                    <div class="col text-center">
                      <!-- <button class="btn btn-default">Centered button</button>  -->
                      <button id="view_more" class="btn btn-danger">View more</button>
                    </div>
                     
                  </div>
               </aside>
            </div>
         </div>
      </div>
      <section class="easy-step">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div class="section-title">
                     <h5 class="text-center wow fadeInUp" data-wow-duration="1s" data-wow-delay=".1s" style="visibility: visible; animation-duration: 1s; animation-delay: 0.1s; animation-name: fadeInUp;">Single Window To Manage Your Wealth</h5>
                  </div>
               </div>
            </div>
            <div class="savetax-sec">
               <div class="card-deck mb-3 text-center">
                  <div class="row">
                     <!-- <div class="col-md-4">
                        <div class="card mb-4 shadow-sm">
                           <div class="card-header">
                              <h6 class="title">RISK PROFILE</h6>
                           </div>
                           <div class="card-body">
                              <i class="iconfont icofont-exclamation-tringle" aria-hidden="true"></i>
                              <p>Your risk profile should decide your investment strategy. Higher risk will yield higher return.</p>
                              <button class="btn btn-lg btn-block btn-outline-danger" data-toggle="modal" data-target="#riskProfile" >Check it now</button>
                           </div>
                        </div>
                     </div> -->
                     <div class="col-md-4">
                        <div class="card mb-4 shadow-sm">
                           <div class="card-header">
                              <h6 class="title">CALCULATORS</h6>
                           </div>
                           <div class="card-body">
                              <i class="iconfont icofont-calculator"></i>
                              <p>Calculators to help you make better financial decisions</p>
                              <button class="btn btn-lg btn-block btn-outline-danger" onclick="javascript:window.location='?module_interface=<?php echo $commonFunction->setPage('calculators'); ?>'">Use them for Free</button>
                           </div>
                        </div>
                     </div>
                     <!-- <div class="col-md-4">
                        <div class="card mb-4 shadow-sm">
                           <div class="card-header">
                              <h6 class="title">ASSET ALLOCATION</h6>
                           </div>
                           <div class="card-body">
                              <i class="iconfont icofont-tasks"></i>
                              <p>An Ideal portfolio should balance your liquidity returns. It is important to check your portfolio allocation.</p>
                              <button class="btn btn-lg btn-block btn-outline-danger" data-toggle="modal" data-target="#assetallocation">Check it out now</button>
                           </div>
                        </div>
                     </div>-->
                     <div class="col-md-4">
                        <div class="card mb-4 shadow-sm">
                           <div class="card-header">
                              <h6 class="title">SIP / STP</h6>
                           </div>
                           <div class="card-body">
                              <i class="iconfont icofont-pig-face"></i>
                              <p>Turn market swings into opportunities by investing through SIP</p>
                              <button class="btn btn-lg btn-block btn-outline-danger" onclick="javascript:window.location='?module_interface=<?php echo $commonFunction->setPage('calculators'); ?>';" >Check it out now</button>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="card mb-4 shadow-sm">
                           <div class="card-header">
                              <h6 class="title">LUMPSUM</h6>
                           </div>
                           <div class="card-body">
                              <i class="iconfont icofont-money-bag"></i>
                              <p>Top best Mutual funds for Lumpsum investment</p>
                              <button class="btn btn-lg btn-block btn-outline-danger" onclick="javascript:window.location='?module_interface=<?php echo $commonFunction->setPage('calculators'); ?>';" >Check it out now</button>
                           </div>
                        </div>
                     </div>
                     <!-- <div class="col-md-4">
                        <div class="card mb-4 shadow-sm">
                           <div class="card-header">
                              <h6 class="title">OPTYMONEY</h6>
                           </div>
                           <div class="card-body">
                              <i class="iconfont icofont-file-alt"></i>
                              <p>Save your taxes by investing in top ELSS funds</p>
                              <button class="btn btn-lg btn-block btn-outline-danger" onclick="javascript:window.location='?module_interface=<?php echo $commonFunction->setPage('all_product'); ?>';">Check it out now</button>
                           </div>
                        </div>
                     </div> -->
                  </div>
               </div>
            </div><!-- manage wealth-->
         </div>
   </section>
   <!--<section class="plan-goal">
      <div class="container">
         <div class="goal-text">
            <div class="row current_value">
               <div class="col-md-12 section-title text-center"><h5>Set Your Goals</h5></div>
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
         </div>
      </div>
   </section>-->
   <!--</div>-->
   <!-- end main content-->
   <!-- END layout-wrapper -->
   <!-- Right Sidebar -->
   <!--<div class="right-bar">
      <div data-simplebar class="h-100">
         <!-- Nav tabs -->
         <!--<ul class="nav nav-tabs nav-tabs-custom rightbar-nav-tab nav-justified" role="tablist">
            <li class="nav-item">
               <a class="nav-link py-3 active" data-toggle="tab" href="#chat-tab" role="tab">
               <i class="mdi mdi-message-text font-size-22"></i>
               </a>
            </li>
         </ul>
         <!-- Tab panes -->
         <!--<div class="tab-content text-muted">
            <div class="tab-pane active" id="chat-tab" role="tabpanel">
               <form class="search-bar py-4 px-3">
                  <div class="position-relative">
                     <input type="text" class="form-control" placeholder="Search...">
                     <span class="mdi mdi-magnify"></span>
                  </div>
               </form>
               <h6 class="px-4 py-3 mt-2 bg-light text-center">Notifications</h6>
               <div class="p-2">
                  <a href="javascript: void(0);" class="text-reset notification-item">
                     <div class="media">
                        <div class="position-relative align-self-center mr-3">
                           <img src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme; ?>img/avatar-1.jpg" class="rounded-circle avatar-xs" alt="user-pic">
                           <i class="mdi mdi-circle user-status away"></i>
                        </div>
                        <div class="media-body overflow-hidden">
                           <h6 class="mt-0 mb-1">Lorem Ipsum</h6>
                           <div class="font-size-12 text-muted">
                              <p class="mb-0 text-truncate">Lorem Insvestments Added</p>
                           </div>
                        </div>
                     </div>
                  </a>
               </div>
            </div>
         </div>-->
      </div>
   </div>
   <!-- end slimscroll-menu-->
   </div>
   <!-- /Right-bar -->
   <!-- Right bar overlay-->
   <div class="rightbar-overlay"></div>
   <div class="modal fade" id="riskProfile" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
         <div class="modal-content">
            <div class="modal-body ">
               <div class="row about-content">
                  <div class="col-lg-12 col-md-12 col-sm-12">
                     <div class="jumbotron-contents">
                        <h4>To assess your risk tolerance Seven questions are given below. Each question is followed by three, possible answers. Circle the letter that corresponds to your answer.</h4>
                     </div>
	                  <form action="">
                        <div class="content-row">
                           <div class="row">
                              <div class="col-md-12">
                                 <div class="form-group">
                                    <label for="exampleInputEmail1">1.Just six weeks after you invested in a stock, its price declines by 20 percent if the fundamentals of the stock have not changed, what would you do? </label>
                                    <div class="radio" id="rg1">
                                          <input class="calc" type="radio" name="radio1" value="1">    Sell <br>
                                          <input class="calc" type="radio" name="radio1" value="2">    Do nothing <br>
                                          <input class="calc" type="radio" name="radio1" value="3">    Buy more <br>
                                    </div>
                                 </div>  
                                 <div class="form-group">
                                    <label for="exampleInputEmail1">2.Consider the previous question another way. Your stock dropped 20 percent, but it is part of a portfolio designed to meet investment goals with three different time horizons.</label>
                                    <label for="exampleInputEmail1">i.What would you do if your goal were five years away?</label>
                                    <div class="radio" id="rg2">
                                       <input class="calc" type="radio" name="radio2" value="1">Sell <br>
                                       <input class="calc" type="radio" name="radio2" value="2"> Do nothing <br>
                                       <input class="calc" type="radio" name="radio2" value="3"> Buy more <br>
                                    </div>
                                    <label for="exampleInputEmail1">ii.What would you do if the goal were 15 years away?</label>
                                    <div class="radio" id="rg3">
                                       <input class="calc" type="radio" name="radio3" value="1">Sell <br>
                                       <input class="calc" type="radio" name="radio3" value="2"> Do nothing  <br>
                                       <input class="calc" type="radio" name="radio3" value="3"> Buy more <br>
                                    </div>
                                    <label for="exampleInputEmail1"> iii.What would you do if the goal were 30 years away?</label>
                                    <div class="radio" id="rg4">
                                       <input class="calc" type="radio" name="radio4" value="1"> Sell <br>
                                       <input class="calc" type="radio" name="radio4" value="2"> Do nothing<br>
                                       <input class="calc" type="radio" name="radio4" value="3">Buy more<br>
                                    </div>
                                 </div> 
                                 <div class="form-group">
                                    <label for="exampleInputEmail1">3.You have bought a stock as part of your retirement portfolio. Its price rises by 25 percent one month. If the fundamentals of the stock have not changed, what would you do?</label>
                                    <div class="radio" id="rg5">
                                       <input class="calc" type="radio" name="radio5" value="1"> Sell<br>
                                       <input class="calc" type="radio" name="radio5" value="2"> Do nothing<br>
                                       <input class="calc" type="radio" name="radio5" value="3">Buy more<br> 
                                    </div>
                                 </div> 
                                 <div class="form-group">
                                    <label for="exampleInputEmail1">4.You are investing for retirement which is 15 years away. What would you do?</label>
                                    <div class="radio" id="rg6">
                                       <input class="calc" type="radio" name="radio6" value="1">Invest in a money market mutual fund or a guaranteed investment contract<br> 
                                       <input class="calc" type="radio" name="radio6" value="2"> Invest in a balanced mutual fund that has a stock: bond mix of 50:50<br>
                                       <input class="calc" type="radio" name="radio6" value="3"> Invest in an aggressive growth mutual fund<br>
                                    </div>
                                 </div> 
                                 <div class="form-group">
                                    <label for="exampleInputEmail1">5.As a prize winner, you have been given some choice. Which one would you choose?</label>
                                    <div class="radio" id="rg7">
                                       <input class="calc" type="radio" name="radio7" value="1">Rs.50,000 in cash<br>
                                       <input class="calc" type="radio" name="radio7" value="2">A 50 percent chance to get Rs. 125,000<br>
                                       <input class="calc" type="radio" name="radio7" value="3">A 20 percent chance to get Rs. 375,000<br>
                                    </div>
                                 </div> 
                                 <div class="form-group">
                                    <label for="exampleInputEmail1">6.A good investment opportunity has come your way. To participate in it you have to borrow money. Would you take a loan?</label>
                                    <div class="radio" id="rg8">
                                       <input class="calc" type="radio" name="radio8" value="1">No <br>
                                       <input class="calc" type="radio" name="radio8" value="2">Perhaps <br>
                                       <input class="calc" type="radio" name="radio8" value="3">Yes <br>
                                    </div>
                                 </div> 
                                 <div class="form-group">
                                    <label for="exampleInputEmail1">7.Your company, which is planning to go public after three years, is offering stock to its employees. Until it goes public, you can't sell your shares. Your investment, however, has the potential of multiplying 10 times when the company goes public. How much money would you invest?</label>
                                    <div class="radio" id="rg9">
                                       <input class="calc" type="radio" name="radio9" value="1">Nothing<br>
                                       <input class="calc" type="radio" name="radio9" value="2">Three months' salary<br>
                                       <input class="calc" type="radio" name="radio9" value="3">Six months' salary<br>
                                    </div>
                                 </div> 
				                  </div>
                           </div>
				            </div>
					         <button class="btn btn-info" onclick="calcscore()" id="submit" type="submit">Submit</button>
	                  </form>
	               </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="modal fade" id="assetallocation" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
         <div class="modal-content">
            <div class="modal-body ">
               <div class="row">
                  <div class="col-md-12">
                     <h3 class="text-center">ASSET ALLOCATION</h3>
                     <p>Pour your taxes into your investments</p>
                  </div>
               </div>
               <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12">
                     <p style="text-align: justify;">Asset allocation involves dividing an investment portfolio among different asset categories, such as stocks, bonds,mutual funds,investment partnerships,real estate, cash equivalents and private equity. It is important to decide how much money is to be invested in what and when rather than choosing in which mutual fund to invest in, this is called asset allocation. Asset allocation means different things to different people in different contexts. The concept is that the investor can lessen risk because each asset class has a different correlation to the others; for example when stocks rise, bonds often fall. The classical approach to investment management is a top-down approach that starts with Strategic Asset Allocation(SAA),in which strategic long-term decisions are made about how to allocate money across asset classes based on estimates of future returns, risks &amp; correlations. &nbsp;</p>
                     <p style="text-align: justify;">&nbsp;</p>
                     <p style="text-align: justify;">In the&nbsp;case of mutual funds, asset allocation refers to allocating money between debt and equity mutual funds. Debt and equity mutual funds have many sub-categories, equity mutual funds can be categorised as largecap, smallcap, and so on. Likewise, the sub-categories in debt mutual funds include liquid funds, ultra-short term funds&nbsp;and short-term funds. Each of these sub-categories offer different kinds of returns and are associated with varying levels of risk. When one set of funds perform poorly, the others will balance the underperformance.</p>
                     <p style="text-align: justify;">&nbsp;</p>
                     <p style="text-align: justify;">The asset allocation that works best for you at any given point in your life will depend largely on your time horizon and your ability to tolerate risk, when it comes to investing, risk and reward are inextricably entwined. You've probably heard the phrase "no pain, no gain" - those words come close to summing up the relationship between risk and reward. Before you make any investment, you should understand the risks of the investment and make sure the risks are appropriate for you. By including asset categories with investment returns that move up and down under different market conditions within a portfolio, an investor can protect against significant losses. Historically, the returns of the three major asset categories have not moved up and down at the same time.</p>
                     <p style="text-align: justify;">&nbsp;</p>
                     <p style="text-align: justify;">Market conditions that cause one asset category to do well often cause another asset category to have average or poor returns. By investing in more than one asset category can reduce the risk that you'll lose money and your portfolio's overall investment returns will have a smoother ride. If one asset category's investment return falls, you'll be in a position to counteract your losses in that asset category with better investment returns in another asset category. "Don't put all your eggs in one basket." The strategy involves spreading your money among various investments in the hope that if one investment loses money, the other investments will more than make up for those losses.</p>
                     <p style="text-align: justify;">&nbsp;</p>
                     <p style="text-align: justify;">In addition, asset allocation is important because it has major impact on whether you will meet your financial goal. If you don't include enough risk in your portfolio, your investments may not earn a large enough return to meet your goal. A portfolio heavily weighted in stock or stock mutual funds, for instance, would be inappropriate for a short-term goal, such as saving for a family's summer vacation.</p>
                     <p style="text-align: justify;">&nbsp;</p>
                     <p style="text-align: justify;"><strong>There is no single asset allocation model that is right for every financial goal and</strong> <strong>no person’s financial condition remains the same.&nbsp;This means that one would have to change their investment strategy from time to time.</strong></p>
                     <p style="text-align: justify;">&nbsp;</p>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>