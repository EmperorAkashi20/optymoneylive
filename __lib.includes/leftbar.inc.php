<!-- ======= Top Bar ======= -->
<section id="topbar" class="d-none d-lg-block">
    <div class="container clearfix">
        <div class="contact-info float-left">
            <i class="fas fa-envelope"></i><a href="mailto:support@optymoney.com">support@optymoney.com</a>
            <i class="fas fa-phone-alt ml-2"></i><a href="tel:+917411011280">+91 741 101 1280</a>
        </div>
        <div class="social-links float-right">
            <a href="#" class="qrcode" data-toggle="popover" data-content='<img src="<?php echo $CONFIG->siteurl;?>/static/opty_theme/img/optymoney_qrcode.jfif" class="mr-3" style="width: 100%" alt="QR Code">'><i class="fas fa-qrcode"></i></a>
            <a href="https://web.whatsapp.com/send?phone=+917411011280" target="_blank" class="whatsapp"><i class="fab fa-whatsapp"></i></a>
            <a href="https://bit.ly/optytwitter" target="_blank" class="twitter"><i class="fab fa-twitter"></i></a>
            <a href="https://bit.ly/optyfb" target="_blank" class="facebook"><i class="fab fa-facebook-f"></i></a>
            <a href="https://bit.ly/optyinsta" target="_blank" class="instagram"><i class="fab fa-instagram"></i></a>
            <a href="https://bit.ly/optylinkedin" target="_blank" class="linkedin"><i class="fab fa-linkedin-in"></i></a>
        </div>
    </div>
</section>

<?php if ($_SESSION[$CONFIG->sessionPrefix . 'loginstatus']) { ?>
    <!-- ======= Header ======= -->
    <header id="header">
        <div class="container">
            <div class="logo float-left">
                <a href="home.html" class="navbar-brand img-fluid">
                    <img src="<?php echo $CONFIG->staticURL; ?><?php echo $CONFIG->theme_new; ?>img/logo_3.png" alt="">
                </a>
            </div>
            <nav class="nav-menu float-left d-none d-lg-block">
                <ul>
                    <li><a href="?module_interface=<?php echo $commonFunction->setPage('dashboard'); ?>" class="nav-link">Dashboard</a></li>
                    <li><a href="?module_interface=<?php echo $commonFunction->setPage('helpdesk'); ?>" class="nav-link">Tax</a></li>
                    <li><a href="?module_interface=<?php echo $commonFunction->setPage('all_product'); ?>" class="nav-link">Investments</a></li>
                    <li><a href="?module_interface=<?php echo $commonFunction->setPage('create_will'); ?>" class="nav-link">Will</a></li>
                    <li class="drop-down"><a href="">Resources</a>
                        <ul>
                            <li><a href="?module_interface=<?php echo $commonFunction->setPage('blogs'); ?>" class="dropdown-item">Blogs</a></li>
                            <li><a href="?module_interface=<?php echo $commonFunction->setPage('faq'); ?>" class="dropdown-item">FAQ</a></li>
                            <li><a href="?module_interface=<?php echo $commonFunction->setPage('downloads'); ?>" class="dropdown-item">Downloads</a></li>
                        </ul>
                    </li>
                    <li><a href="?module_interface=<?php echo $commonFunction->setPage('contact'); ?>" class="nav-link">Contact</a></li>
                    <!-- <li><a href="?module_interface=<?php echo $commonFunction->setPage('mygoal'); ?>" class="nav-link blink">My Goal</a></li> -->
                    <!-- <li><a href="?module_interface=<?php //echo $commonFunction->setPage('mutual_fund'); 
                                                        ?>" class="nav-link">Portfolio</a></li> -->
                </ul>
            </nav><!-- .nav-menu -->
            <div class="navbar-nav-cart float-right">
                <a class="cartIcon" href="?module_interface=<?php echo $commonFunction->setPage('cart_sys'); ?>">
                    <i class="fas fa-shopping-cart" style="font-size:24px; color: #696969"></i>
                    <span class="cartCount header-item noti-icon waves-effect sup">
                        <?php
                        $fetch_cart_cnt = $mutualFund->fetch_cart_count();
                        if ($fetch_cart_cnt) {
                            echo "<sup>" . $fetch_cart_cnt . "</sup>";
                        }
                        ?>
                    </span>
                </a>
                <div class="dropdown">
                    <button class="dropbtn">
                        <img class="rounded-circle header-profile-user" src="<?php echo $CONFIG->staticURL; ?><?php echo $CONFIG->theme_new; ?>img/avatar.svg" alt="Header Avatar">
                        <i class="fas fa-angle-down d-none d-sm-inline-block"></i>
                    </button>
                    <div class="dropdown-content dropdown-menu-right menudata">
                        <a class="dropdown-item user_name" href='?module_interface=<?php echo $commonFunction->setPage('settings'); ?>'> <span class="d-none d-sm-inline-block ml-1"><i class="fas fa-user-circle font-size-16 align-middle mr-1"></i>
                                <!--<i class="mdi mdi-face-profile font-size-16 align-middle mr-1"></i>--><?php echo $CONFIG->loggedUserName; ?>
                            </span></a>
                        <a class="dropdown-item" href="?module_interface=<?php echo $commonFunction->setPage('orders_details'); ?>"><i class="fas fa-sticky-note font-size-16 align-middle mr-1 ml-2"></i>
                            <!--<i class="mdi mdi-note font-size-16 align-middle mr-1"></i>--> Orders
                        </a>
                        <a class="dropdown-item" href="?module_interface=<?php echo $commonFunction->setPage('contact'); ?>"><i class="fas fa-phone-alt font-size-16 align-middle mr-1 ml-2"></i>
                            <!--<i class="fas fa-phone-alt mdi mdi-phone font-size-16 align-middle mr-1"></i>--> Help&nbsp;&&nbsp;Support
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?php echo $CONFIG->siteurl; ?>logout.php"><i class="fas fa-sign-out-alt font-size-16 align-middle mr-1 ml-2"></i>
                            <!--<i class="mdi mdi-logout font-size-16 align-middle mr-1"></i>--> Logout
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header><!-- End Header -->
<?php } else { ?>
<!-- ======= Header ======= -->
<header id="header">
    <div class="container">
        <div class="logo float-left">
            <a href="home.html" class="navbar-brand img-fluid">
                <img src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>img/logo_3.png" alt="">
            </a>
        </div>
        <nav class="nav-menu float-left d-none d-lg-block">
            <ul>
                <li><a href="#" class="nav-link d-block d-lg-none text-danger" data-toggle="modal" data-target="#login_form">Login</a></li>
                <li><a href="tax.html" class="nav-link">Tax</a></li>
                <li><a href="all_product.html" class="nav-link">Investments</a></li>
                <li><a href="createwill.html" class="nav-link">Will</a></li>
                <li class="drop-down"><a href="">Resources</a>
                    <ul>
                        <li><a href="blogs.html" class="dropdown-item">Blogs</a></li>
                        <li><a href="faq.html" class="dropdown-item">FAQ</a></li>
                        <li><a href="downloads.html" class="dropdown-item">Downloads</a></li>
                        <li><a href="https://optymoney.com/static/documents/Tax_Reckoner_2021_22.pdf" class="dropdown-item">Tax Reckoner 2021-22</a></li>
                    </ul>
                </li>
                <li><a href="contact.html" class="nav-link">Contact</a></li>
                <!-- <li><a href="mygoal.html" class="nav-link css_blink">My Goal</a></li> -->
                <!--<li><a href="https://optymoney.my-portfolio.in/Login.aspx" class="nav-link">Portfolio Check</a></li>-->
            </ul>
        </nav><!-- .nav-menu -->
        <div class="navbar-nav float-right">
            <a href="#" class="btn login_btn btn-lg  d-none d-lg-block" style="margin-right: 30px;" data-toggle="modal" data-target="#login_form">Login</a>
        </div>
    </div>
</header><!-- End Header -->
<?php } ?>