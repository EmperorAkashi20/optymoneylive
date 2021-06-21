<!doctype html>
<html lang="en">

    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        
        <title>Account Statement</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
       
        <!-- App favicon -->
        <link rel="shortcut icon" href="img/favicon.ico">

        <!-- datepicker -->
<!--         <link href="css/datepicker.min.css" rel="stylesheet" type="text/css" />
 -->
        <!-- jvectormap -->
        <link href="assets/js/jqvmap.min.css" rel="stylesheet" />

        <!-- Bootstrap Css -->
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="css/app.min.css" rel="stylesheet" type="text/css" />
         <link href="css/style.css" rel="stylesheet" type="text/css" />

         <link href="css/will.css" rel="stylesheet" type="text/css" />

 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
 <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
 <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.bootstrap4.min.css">



        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.bootstrap4.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.colVis.min.js"></script>

        
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

        <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
        <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />

  <link href="css/cart.css" rel="stylesheet" />
    </head>

    <body data-layout="horizontal" data-layout-size="boxed">

        <!-- Begin page -->
        <div id="layout-wrapper">

            <header id="page-topbar">
                <div class="navbar-header">
                    <div class="container-fluid">
                        <div class="float-right">

                            <div class="dropdown d-inline-block ml-2">
                                <form class="app-search d-none d-lg-block">
                                    <div class="position-relative">
                                        <input type="text" class="form-control" placeholder="Search...">
                                        <span class="mdi mdi-magnify"></span>
                                    </div>
                                </form>
                            </div>

                            <div class="dropdown d-inline-block">
                                <button type="button" class="btn header-item noti-icon right-bar-toggle waves-effect">
                                    <i class="fa fa-bell-o"></i>
                                </button>
                            </div>
                            <div class="dropdown d-inline-block">
                                <a href="wallet.html"><button type="button" class="btn header-item noti-icon waves-effect">
                                    <i class="mdi mdi-wallet"></i>
                                </button>
                                </a>
                            </div>
                            <div class="dropdown d-inline-block">
                              <a href="empty_cart.html">  <button type="button" class="btn header-item noti-icon waves-effect">
                                    <i class="fa fa-shopping-cart"></i>
                                </button>
                                </a>
                            </div>
                           

                            <div class="dropdown d-inline-block">
                                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img class="rounded-circle header-profile-user" src="img/avatar.svg" alt="Header Avatar">
                                   
                                    <i class="mdi mdi-chevron-down d-none d-sm-inline-block"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <!-- item-->
                                   <a class="dropdown-item user_name" href="#"> <span class="d-none d-sm-inline-block ml-1"><i class="mdi mdi-face-profile font-size-16 align-middle mr-1"></i>Aakash</span></a>
                                    <a class="dropdown-item" href="#"><i class="mdi mdi-face-profile font-size-16 align-middle mr-1"></i> Profile</a>
                                    <a class="dropdown-item" href="#"><i class="fa fa-university font-size-16 align-middle mr-1"></i> Bank Accounts</a>
                                    <a class="dropdown-item" href="#"><i class="mdi mdi-credit-card-outline font-size-16 align-middle mr-1"></i> Billing</a>
                                    <a class="dropdown-item" href="#"><i class="mdi mdi-note font-size-16 align-middle mr-1"></i> Orders</a>
                                    <a class="dropdown-item" href="#"><i class="mdi mdi-account-settings font-size-16 align-middle mr-1"></i> Settings</a>
                                    <a class="dropdown-item" href="#"><i class="mdi mdi-phone font-size-16 align-middle mr-1"></i> Help & Support</a>
                                    
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#"><i class="mdi mdi-logout font-size-16 align-middle mr-1"></i> Logout</a>
                                </div>
                            </div>
                        </div>

                        <!-- LOGO -->
                        <div class="navbar-brand-box">
                            <a href="index.html" class="logo logo-dark">
                                <span class="logo">
                                    <img src="img/logo.png" alt="" >
                                </span>
                                
                            </a>

                            
                        </div>

                        <button type="button" class="btn btn-sm mr-2 font-size-16 d-lg-none header-item waves-effect waves-light" data-toggle="collapse" data-target="#topnav-menu-content">
                            <i class="fa fa-fw fa-bars"></i>
                        </button>

                        <div class="topnav">
                            <nav class="navbar navbar-light navbar-expand-lg topnav-menu">

                                <div class="collapse navbar-collapse" id="topnav-menu-content">
                                    <ul class="navbar-nav">
                                        <li class="nav-item">
                                            <a class="nav-link" href="index.html">
                                                Tax
                                            </a>
                                        </li>

                                        <li class="nav-item">
                                            <a class="nav-link" href="index.html">
                                                Investments
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="index.html">
                                                Will
                                            </a>
                                        </li>
                                       

                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-components" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Resources <div class="arrow-down"></div>
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="topnav-components">
                                                <div class="dropdown">
                                                    <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-email" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <div class="d-inline-block icons-sm mr-2"></div> Knowledge
                                                       
                                                    </a>
                                                    <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-email" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <div class="d-inline-block icons-sm mr-2"></div> FAQ
                                                      
                                                    </a>
                                                  
                                                </div>
                                                
                                            </div>
                                        </li>
                                       
                                               
                                            
                                           
                                        </li>

                                    </ul>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>

    
            </header>

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
<div class="main-content" style="background-color: #fff;">

    <div class="page-content">

<div class="p-5 bg-white rounded shadow mb-5">

<div class="card">
  <div class="card-header">
    <h4 style="color: #a51f22 !important;">Search</h4>
  </div>
  <div class="card-body">
    <!-- body -->

    <div class="widget-main">
        <form class="form-inline">
       
        Applicant&nbsp;
         <select id="" name="" class="form-control">
                    <option selected="">All</option>
                  </select>
            <select id="" name="" class="form-control">
                    <option value="">All Objective</option>
                    <option value="">All Debt</option>
                    <option value="">All Equity</option>
                    <option value="">Debt: Credit Opportunities</option>
                    <option value="">Debt: FMP</option>
                    <option value="">Debt: Income</option>
                    <option value="">Debt: Liquid</option>
                    <option value="">Debt: Short Term</option>
                    <option value="">Debt: Ultra Short Term</option>
                    <option value="">Equity: Infrastructure</option>
                    <option value="">Equity: Large Cap</option>
                    <option value="">Equity: Mid Cap</option>
                    <option value="">Equity: Multi Cap</option>
                    <option value="">Equity: Pharma</option>
                    <option value="">Equity: Sectoral</option>
                    <option value="">Equity: Small Cap</option>
                    <option value="">Equity: Tax Planning</option>
                    <option value="">Gold: Gold Funds</option>
                  </select>
             &nbsp;<select id="" name="" class="form-control">
                    <option value="">--All Companies--</option>
                    <option value="">Aditya Birla Sun Life Mutual Fund&lt;</option>
                    <option value="">BOI  AXA Mutual Fund</option>
                    <option value="">DHFL Pramerica Mutual Fund</option>
                    <option value="">DSP BlackRock Mutual Fund</option>
                    <option value="">Edelweiss Mutual Fund</option>
                    <option value="">Franklin Templeton Mutual Fund</option>
                    <option value="">HDFC Mutual Fund</option>
                    <option value="">HSBC Mutual Fund</option>
                    <option value="">ICICI Prudential Mutual Fund</option>
                    <option value="">IDFC Mutual Fund</option>
                    <option value="">Invesco Mutual Fund</option>
                    <option value="">Kotak Mutual Fund</option>
                    <option value="">L&amp;T Mutual Fund</option>
                    <option value="">LIC Mutual Fund</option>
                    <option value="">Reliance Mutual Fund</option>
                    <option value="">SBI Mutual Fund</option>
                    <option value="">Tata Mutual Fund</option>
                  </select>  &nbsp;                                                
                  
            <div class="input-daterange input-group">
                <input type="text" name="start" id="datepicker" class="input-sm form-control" placeholder="Start Trade Date">
                <span class="input-group-addon">
                    <i class="fa fa-exchange"></i>
                </span>
                <input type="text" name="end" id="datepicker1" class="input-sm form-control" placeholder="End Trade Date">
            </div>                                  
        </form>
         <br/>
         <div class="pull-right mr-5">                               
                    <button class="btn btn-primary btn-sm" type="button">
                        <i class="ace-icon fa fa-search bigger-110"></i><strong> Search</strong>
                    </button>
                </div>
    </div>
   
  </div>
</div>


<div id="accordion" class="table-responsive">      
<table id="example" class="table table-striped table-bordered dt-responsive nowrap table-hover" style="width:100%;">
    <thead class="heading_table">
        <tr>
            <th>Purchase Date </th>
           
            <th>TranType</th>
            <th>NAV</th>
            <th>Amount</th>
            <th>Purchase Price</th>
            <th>Unit / No.</th>
            <th>Balance</th>
        </tr>
         <th colspan="7" style="border-bottom: 1px solid #d1dbec!important;">
        <h4><span class="badge badge-secondary">VIKASH TATIA</span></h4>
    </th>

    <tr id="headingOne" data-toggle="collapse" data-target="#collapseOne" class="trpointer">
        <th colspan="7" class="border-0">
            <h4> 
    <span class="badge badge-secondary" >NIPPON INDIA TAX SAVER ( ELSS ) FUND - DIVIDEND PLAN  &nbsp;<!-- <i class="fa fa-plus"></i> --></span>
            </h4>
        </th>
    </tr>
    </thead>    

   

<tbody>
    
        <tr id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
            <td>23-09-2005</td>
            <td>Purchase</td>
            <td>1470.588</td>
            <td>15000</td>
            <td>1470.588</td>
            <td>1470.588</td>
            <td>1470.588</td>
        </tr>
        <tr id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
            <td>21-02-2007</td>
            <td>Gross Dividend(Reversal -Cheque Dishonoured/Collection Dishonoured)</td>
            <td>0</td>
            <td>1470.59</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
        </tr>  
        <tr id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
            <td>02-11-2007</td>
            <td>Gross Dividend(Reversal -Cheque Dishonoured/Collection Dishonoured)</td>
            <td>0</td>
            <td>1470.59</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
        </tr>  
        <tr id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
            <td>28-08-2009</td>
            <td>Gross Dividend(Reversal -Cheque Dishonoured/Collection Dishonoured)</td>
            <td>0</td>
            <td>2205.88</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
        </tr>  
        <tr id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
            <td>06-10-2009</td>
            <td>Redemption</td>
            <td>1470.588</td>
            <td>18841.47</td>
            <td>1470.588</td>
            <td>1470.588</td>
            <td>1470.588</td>
        </tr>  

    </tbody>
       
</table>
 </div>

</div>
</div>

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
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
    <footer>
        <div class="ilstrator_footer_img d-none d-lg-block ">
            <img src="img/footer_ils_1.png" alt="">
        </div>
        <div class="anim_icon ">
            <div class="anim_icon_1 amination_custom">
                <img src="img/animated_icon/4.png" alt="">
            </div>
            <div class="anim_icon_2 amination_custom11">
                <img src="img/animated_icon/5.png" alt="">
            </div>
        </div>
        <div class="footer_top_area">
            <div class="container-fluid footer-padding">
                <div class="row">
                    <div class="col-xl-3 col-lg-3 col-md-6">
                        <div class="footer_widget wow fadeInUp" data-wow-duration="1s" data-wow-delay=".1s">
                            <div class="footer_logo">
                                <a href="#">
                                    <img src="img/logo.png" alt="" >
                                </a>
                            </div>
                           
                            <div class="social_links">
                                <ul>
                                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="#"><i class="fa fa-linkedin-square"></i></a></li>
                                    <li> <a href="#"><i class="fa fa-twitter"></i></a></li>
                                </ul>
                            </div>
                              
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6">
                        <div class="footer_widget wow fadeInUp" data-wow-duration="1s" data-wow-delay=".2s">
                            <div class="footer_title">
                                <h3>WHO WE ARE/COMPANY</h3>
                            </div>
                            <ul class="link_list">
                                <li><a href="#">About Us</a></li>
                                <li><a href="#">Media Coverage & Recognitions</a></li>
                                <li><a href="#">Partners</a></li>
                                <li><a href="#">Testimonials</a></li>
                                <li><a href="contact.html">Contact Us</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-6">
                        <div class="footer_widget wow fadeInUp" data-wow-duration="1s" data-wow-delay=".3s">
                            <div class="footer_title">
                                <h3>OUR SERVICES</h3>
                            </div>
                            <ul class="link_list">
                                <li><a href="#">ITR Filling</a></li>
                                <li><a href="#"> NRI Filling</a></li>
                                <li><a href="#">Notice Assistance</a></li>
                                <li><a href="#">Investments</a></li>
                                <li><a href="#">Will</a></li>
                                <li><a href="#">E-locker</a></li>
                                <li><a href="#">Pricing</a></li>
                            </ul>
                        </div>
                    </div> 
                    
                    <div class="col-xl-2 col-lg-2 col-md-6">
                        <div class="footer_widget wow fadeInUp" data-wow-duration="1s" data-wow-delay=".3s">
                            <div class="footer_title">
                                <h3>EXPLORE</h3>
                            </div>
                            <ul class="link_list">
                                <li><a href="#">Top Investment Options</a></li>
                                <li><a href="#">Mutual Funds Explorer</a></li>
                                <li><a href="#">Mutual Fund Categories</a></li>
                                <li><a href="#">Help & Support</a></li>
                                
                            </ul>
                        </div>
                    </div> 
                    
                    <div class="col-xl-2 col-lg-2 col-md-6">
                        <div class="footer_widget wow fadeInUp" data-wow-duration="1s" data-wow-delay=".3s">
                            <div class="footer_title">
                                <h3>RESOURCES</h3>
                            </div>
                            <ul class="link_list">
                                <li><a href="#">Blogs and Bulletin</a></li>
                                <li><a href="#"> FAQ & Knowledge Center</a></li>
                                <li><a href="#">Calculators</a></li>
                                <li><a href="#">Plan Your Goals</a></li>
                                <li><a href="#">Utilities & Tools</a></li>
                                <li><a href="#">Privacy Policy</a></li>
                                <li><a href="#">Terms & Conditions</a></li>
                            </ul>
                        </div>
                    </div> 
                   
                </div>
            </div>
        </div>
        <div class="copyright_area">
            <div class="container">
                <div class="footer_border"></div>
                <div class="row align-items-center">
                    <div class="col-xl-6 col-lg-6 col-md-6">
                        <div class="copy_right_text wow fadeInUp" data-wow-duration="1s" data-wow-delay=".1s">
                            <p>
                                    © 2020 Optymoney. All rights reserved.
                            </p>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6">
                        <div class="copy_right_links wow fadeInUp" data-wow-duration="1s" data-wow-delay=".2s">
                            <ul>
                                <li>
                                    <a href="#">Company Terms</a>
                                    <a href="#">Privacy Policy</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

 <a href="#" class="float_chat" target="_blank">
<i class="fa fa-comment my-float"></i></a>
            </div>
        </div>
        


    </footer>
    <!-- footer_end -->
   
            <!-- end main content-->

      
        <!-- END layout-wrapper -->

        <!-- Right Sidebar -->
        <div class="right-bar">
            <div data-simplebar class="h-100">
    
                <!-- Nav tabs -->
                <ul class="nav nav-tabs nav-tabs-custom rightbar-nav-tab nav-justified" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link py-3 active" data-toggle="tab" href="#chat-tab" role="tab">
                            <i class="mdi mdi-message-text font-size-22"></i>
                        </a>
                    </li>
                    
                </ul>

                <!-- Tab panes -->
                <div class="tab-content text-muted">
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
                                        <img src="img/avatar-1.jpg" class="rounded-circle avatar" alt="user-pic">
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
                        </div>
                        </div>                                        
                 

            </div> <!-- end slimscroll-menu-->
        </div>
        <!-- /Right-bar -->

      

        <!-- JAVASCRIPT -->


<script type="text/javascript">
    $(document).ready(function() {
    var table = $('#example').DataTable( {
        lengthChange: false,
        buttons: [ 'copy', 'excel', 'pdf', 'colvis' ]
    } );
 
    table.buttons().container()
        .appendTo( '#example_wrapper .col-md-6:eq(0)' );
} );
</script>

<script>
    $('#datepicker').datepicker({
        uiLibrary: 'bootstrap4'
    });
    $('#datepicker1').datepicker({
        uiLibrary: 'bootstrap4'
    });
</script>


    </body>
</html>
