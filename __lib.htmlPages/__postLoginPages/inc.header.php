<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
<nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
          <a class="brand-logo" href="<?php echo $CONFIG->siteurl; ?>mySaveTax/">
          <img src="<?php echo $CONFIG->siteurl; ?>__UI.assets/postloginAssets/assets/images/logo.png" alt="" /> </a>
          <!-- <a class="navbar-brand brand-logo-mini" href="index.html">
            <img src="<?php //echo $CONFIG->siteurl;?>__UI.assets/postloginAssets/assets/images/logo-mini.png" alt="logo" />
          </a> -->
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-center">
          <!-- <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
          </button> -->
          <ul class="navbar-nav">
            <li class="nav-link">
                  <!-- <p class="mb-0 font-weight-medium float-left"><?php //if ($_SESSION[$CONFIG->sessionPrefix.'_AY_TEXT'] == '') {
    //echo 'Please Select - A.Y.';
//} else {
    //echo 'A.Y. '.$_SESSION[$CONFIG->sessionPrefix.'_AY_TEXT'];
//}?></p> -->
            </li>
          </ul>
          <!-- <ul class="navbar-nav navbar-nav-left header-links">
            
            <li class="nav-item active d-none d-md-flex">
              <a href="?module_interface=<?php //echo $commonFunction->setPage('google-charts'); ?>" class="nav-link">
                <i class="mdi mdi-elevation-rise"></i>Reports</a>
            </li>
          </ul> -->
          <form action="#" class="form form-search ml-auto d-none d-md-flex">
            <!-- <div class="input-group">
              <input type="text" class="form-control" placeholder="Search anything .." aria-describedby="form-search" autocomplete="off">
              <div class="input-group-prepend">
                <span class="input-group-text" id="form-search"><i class="mdi mdi-magnify"></i></span>
              </div>
            </div> -->
          </form>
          <ul class="navbar-nav">
            <li class="nav-item dropdown  d-xl-inline-flex">
              <a class="nav-link dropdown-toggle pl-4 d-flex align-items-center" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                <div class="count-indicator d-inline-flex mr-3">
                  <img class="img-xs rounded-circle" src="<?php echo $loggedUserImage; ?>" alt="Profile image">
                  <!-- <span class="count count-sm bg-inverse-primary"></span> -->
                </div>
                <span class="profile-text font-weight-medium"><small>Welcome,</small>
            <?php echo $CONFIG->loggedUserName; ?></span>
              </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                <a class="dropdown-item p-0">
                  <div class="d-flex border-bottom">
                    <div class="py-3 px-4 d-flex align-items-center justify-content-center">
                      <i class="mdi mdi-bookmark-plus-outline mr-0 text-gray"></i>
                    </div>
                    <div class="py-3 px-4 d-flex align-items-center justify-content-center border-left border-right">
                      <i class="mdi mdi-account-outline mr-0 text-gray"></i>
                    </div>
                    <div class="py-3 px-4 d-flex align-items-center justify-content-center">
                      <i class="mdi mdi-alarm-check mr-0 text-gray"></i>
                    </div>
                  </div>
                </a>
                <a class="dropdown-item mt-2" href="?module_interface=<?php echo $commonFunction->setPage('profile'); ?>#settings">
                  Manage Accounts
              </a>
                <a class="dropdown-item" href="<?php echo $CONFIG->siteurl; ?>logout.php">Logout</a>
              </div>
            </li>
          </ul>
           <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="icon-menu"><img src="https://optymoney.com/__lib.htmlPages/__postLoginPages/images/menu-image-icon-12.jpg" width="50px" height="40px"></span>
          </button> 
          <!-- <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span> 
      </button> -->
        </div>
</nav>