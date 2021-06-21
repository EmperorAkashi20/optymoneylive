<nav class="sidebar sidebar-offcanvas" id="sidebar">
<!-- <nav class="sidebar sidebar-offcanvas dynamic-active-class-disabled" id="sidebar"> -->
          <ul class="nav">
            <li class="nav-item">
              <a class="nav-link" href="?module_interface=<?php echo $commonFunction->setPage('profile'); ?>#settings">
              <i class="menu-icon mdi mdi-speedometer"></i>
                <span class="menu-title">My Account</span>
              </a>
            </li>
             <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#itr-layouts" aria-expanded="true" aria-controls="message-layouts">
                <i class="menu-icon fa fa-rupee"></i>
                <span class="menu-title">ITR</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="itr-layouts">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item">
                    <a class="nav-link" href="?module_interface=<?php echo $commonFunction->setPage('home'); ?>">All ITR Files</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="?module_interface=<?php echo $commonFunction->setPage('fill_itr'); ?>">File an ITR</a>
                  </li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="?module_interface=<?php echo $commonFunction->setPage('create_will'); ?>">
              <i class="menu-icon mdi mdi-account-multiple-outline"></i>
                <span class="menu-title">Will</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#message-layouts" aria-expanded="true" aria-controls="message-layouts">
                <i class="menu-icon mdi mdi-email-outline"></i>
                <span class="menu-title">Wealth</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="message-layouts">
                <ul class="nav flex-column sub-menu">
                  <!-- <li class="nav-item">
                    <a class="nav-link" href="?module_interface=<?php //echo $commonFunction->setPage('folio_summary'); ?>">Folio Summary</a>
                  </li> -->
                  <li class="nav-item">
                    <a class="nav-link" href="?module_interface=<?php echo $commonFunction->setPage('ac_stmt'); ?>">A/c Statement</a>
                  </li>
                 <!--  <li class="nav-item">
                    <a class="nav-link" href="?module_interface=<?php //echo $commonFunction->setPage('folio_query'); ?>">Folio Query</a>
                  </li> -->
                  <li class="nav-item">
                    <a class="nav-link" href="?module_interface=<?php echo $commonFunction->setPage('mf_offer_buy'); ?>">Recommended Plans</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="?module_interface=<?php echo $commonFunction->setPage('mf_buy_sell'); ?>">Buy/Sell</a>
                  </li>
                  <!-- <li class="nav-item">
                    <a class="nav-link" href="?module_interface=<?php //echo $commonFunction->setPage('order_manager'); ?>">Order Manager</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="?module_interface=<?php //echo $commonFunction->setPage('map_users'); ?>">Map Other User</a>
                  </li> -->
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <!-- <a class="nav-link" href="?module_interface=<?php //echo $commonFunction->setPage('payment');?>"> -->
              <a class="nav-link" href="?module_interface=<?php echo $commonFunction->setPage('payment_history'); ?>">
              <i class="menu-icon mdi mdi-cart-plus"></i>
                <span class="menu-title">Payment History</span>
              </a>
            </li>
             <li class="nav-item">
              <!-- <a class="nav-link" href="?module_interface=<?php //echo $commonFunction->setPage('payment');?>"> -->
              <a class="nav-link" href="?module_interface=<?php echo $commonFunction->setPage('user'); ?>">
                <i class="menu-icon mdi mdi-headset"></i>
                <span class="menu-title">Help Desk</span>
              </a>
            </li>
          </ul>
       </nav>
	
	
	