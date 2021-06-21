</div><!-- footer_start -->
<div class="ajax-loader">
    <!-- <img src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>img/preloader.gif" class="img-responsive" />-->
</div>
<footer>
    <div class="anim_icon ">
        <div class="anim_icon_1 amination_custom">
            <img src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>img/animated_icon/4.png" alt="">
        </div>
        <div class="anim_icon_2 amination_custom11">
            <img src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>img/animated_icon/5.png" alt="">
        </div>
    </div>
    <div class="footer_top_area">
        <div class="container footer-padding">
            <div class="row">
                <div class="col-md-3">
                    <div class="dk-footer-box-info">
                        <div class="footer_logo">
                            <a href="home.html"><img src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>img/optymoney_icon.png" alt=""></a>
                        </div>
                        <p class="footer-info-text">
                            <!-- Dev Mantra Online Services Private Limited <br> -->
                            CIN : U72900KA2018PTC111791 <br>
                            No. 85/1, CBI Main Road, <br>
                            Bangalore, Karnataka, 560 024 <br>
                            <a href="mailto:support@optymoney.com">support@optymoney.com</a>
                        </p>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="row container">
                        <div class="col-md-3">
                            <div class="footer_widget wow fadeInUp" data-wow-duration="1s" data-wow-delay=".2s">
                                <div class="footer_title">
                                    <h6>Who We Are</h6>
                                </div>
                                <ul class="link_list">
                                    <li><a href='<?php if($_SESSION[$CONFIG->sessionPrefix.'loginstatus']){ echo "?module_interface=".$commonFunction->setPage("about");  }else{ echo "about.html"; } ?>'>About Us</a></li>
                                    <li><a href='<?php if($_SESSION[$CONFIG->sessionPrefix.'loginstatus']){ echo "?module_interface=".$commonFunction->setPage("partners");  }else{ echo "partners.html"; } ?>'>Partners</a></li>
                                    <!-- <li><a href='<?php //if($_SESSION[$CONFIG->sessionPrefix.'loginstatus']){ echo "?module_interface=".$commonFunction->setPage("testimonial");  }else{ echo "testimonial.html"; } ?>'>Testimonials</a></li> -->
                                    <li><a href='<?php if($_SESSION[$CONFIG->sessionPrefix.'loginstatus']){ echo "?module_interface=".$commonFunction->setPage("contact");  }else{ echo "contact.html"; } ?>'>Contact Us</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="footer_widget wow fadeInUp" data-wow-duration="1s" data-wow-delay=".3s">
                                <div class="footer_title">
                                    <h6>Our Services</h6>
                                </div>
                                <ul class="link_list">
                                    <li><a href='<?php if($_SESSION[$CONFIG->sessionPrefix.'loginstatus']){ echo "?module_interface=".$commonFunction->setPage("helpdesk");  }else{ echo "tax.html"; } ?>'>ITR Filing</a></li>
                                    <li><a href='<?php if($_SESSION[$CONFIG->sessionPrefix.'loginstatus']){ echo "?module_interface=".$commonFunction->setPage("all_product");  }else{ echo "all_product.html"; } ?>'>Investments</a></li>
                                    <li><a href='<?php if($_SESSION[$CONFIG->sessionPrefix.'loginstatus']){ echo "?module_interface=".$commonFunction->setPage("create_will");  }else{ echo "createwill.html"; } ?>'>Will</a></li>
                                    <li><a href='<?php if($_SESSION[$CONFIG->sessionPrefix.'loginstatus']){ echo "?module_interface=".$commonFunction->setPage("calculators");  }else{ echo "calculators.html"; } ?>'>Calculators</a></li>
                                    <!--<li><a href="#">Pricing</a></li>-->
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="footer_widget wow fadeInUp" data-wow-duration="1s" data-wow-delay=".3s">
                                <div class="footer_title">
                                    <h6>Explore</h6>
                                </div>
                                <ul class="link_list">
                                    <li><a href='<?php if($_SESSION[$CONFIG->sessionPrefix.'loginstatus']){ echo "?module_interface=".$commonFunction->setPage("all_product");  }else{ echo "all_product.html"; } ?>'>Mutual Funds Explorer</a></li>
                                    <li><a href='<?php if($_SESSION[$CONFIG->sessionPrefix.'loginstatus']){ echo "?module_interface=".$commonFunction->setPage("mfcategories");  }else{ echo "mfcategories.html"; } ?>'>Mutual Fund Categories</a></li>
                                    <li><a href='<?php if($_SESSION[$CONFIG->sessionPrefix.'loginstatus']){ echo "?module_interface=".$commonFunction->setPage("help");  }else{ echo "help.html"; } ?>'>Help & Support</a></li>   
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="footer_widget wow fadeInUp" data-wow-duration="1s" data-wow-delay=".3s">
                                <div class="footer_title">
                                    <h6>Resources</h6>
                                </div>
                                <ul class="link_list">
                                    <!-- <li><a href="#">Blogs and Bulletin</a></li> -->
                                    <li><a href='<?php if($_SESSION[$CONFIG->sessionPrefix.'loginstatus']){ echo "?module_interface=".$commonFunction->setPage("faq");  }else{ echo "faq.html"; } ?>'> FAQ & Knowledge Center</a></li>
                                    <li><a href='<?php if($_SESSION[$CONFIG->sessionPrefix.'loginstatus']){ echo "?module_interface=".$commonFunction->setPage("privacypolicy");  }else{ echo "privacypolicy.html"; } ?>'>Privacy Policy</a></li>
                                    <li><a href='<?php if($_SESSION[$CONFIG->sessionPrefix.'loginstatus']){ echo "?module_interface=".$commonFunction->setPage("termsofuse");  }else{ echo "termsofuse.html"; } ?>'>Terms & Conditions</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="dk-footer-box-info">
                        <div class="social_links">
                            <h6>Follow us</h6>
                            <ul>
                                <li><a href="https://bit.ly/optyfb" target="_blank"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="https://bit.ly/optylinkedin" target="_blank"><i class="fa fa-linkedin-square"></i></a></li>
                                <li><a href="https://bit.ly/optyoutube" target="_blank"><i class="fa fa-youtube"></i></a></li>
                                <li><a href="https://bit.ly/optytwitter" target="_blank"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="https://bit.ly/optyinsta" target="_blank"><i class="fa fa-instagram"></i></a></li>
                            </ul>
                        </div>
                        <!-- End Social link -->
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="row container">
                        <div class="col-md-12">
                            <div class="social_links">
                                <h6>Useful Links</h6>
                                <a href='https://www.amfiindia.com/' target="_blank"><img src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>img/icon/amfi.png" alt="" class="mb-3 uselink"></a>
                                <a href='https://www.incometaxindia.gov.in/' target="_blank"><img src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>img/icon/efilinglogo.gif" alt="" class="mb-3 uselink"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <hr>
                </div>
            </div>
            <div class="row">
                <!--<div class="col-md-2"></div>-->
                <div class="col-md-6">
                    <p>© <?= date("Y"); ?> <b>Optymoney</b>. A Venture of <a href="https://www.devmantra.com" target="_blank"><b>Devmantra</b></a>. All rights reserved.</p>
                </div>
                <!-- End Col -->
                <div class="col-md-6">
                    <div class="copyright-menu">
                        <ul>
                            <li>
                            <a href='<?php if($_SESSION[$CONFIG->sessionPrefix.'loginstatus']){ echo "?module_interface=".$commonFunction->setPage("termsofuse");  }else{ echo "termsofuse.html"; } ?>'>Company Terms</a>
                            </li>
                            <li>
                            <a href='<?php if($_SESSION[$CONFIG->sessionPrefix.'loginstatus']){ echo "?module_interface=".$commonFunction->setPage("privacypolicy");  }else{ echo "privacypolicy.html"; } ?>'>Privacy Policy</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copyrightBottom">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <p class="bottomData mt-1 text-center">AMFI : ARN 157435 | BSE Member ID 1513303 | ERI Registration – ERIA101037 | CIN no. – U72900KA2018PTC111791 | MSME Udhyam Registration - UDYAM-KR-03-0009603</p>
                </div>
            </div>
        </div>
    </div>
    <!--<a href="https://web.whatsapp.com/send?phone=+917411011280" class="float whatsapp" target="_blank"><i class="fa fa-whatsapp my-float"></i></a>
    <a href="#" class="float QR" data-toggle="popover"><i class="fa fa-qrcode my-float"></i></a> -->
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
</footer>
<?php if ($_SESSION[$CONFIG->sessionPrefix . 'loginstatus']) {
} else { ?>
    <div class="customizer border-left-blue-grey border-left-lighten-4 d-none d-xl-block">
        <a class="customizer-close" href="#"><i class="feather icon-x font-medium-3"></i></a>
        <a class="customizer-toggle bg-success" href="#">Expert Assistance</a>
        <div class="customizer-content p-2 ps">
            <h4 class="text-uppercase mb-0">Expert Assistance</h4>
            <hr>
            <p>Need Assistance for</p><br>
            <form action="<?= $CONFIG->siteurl; ?>ajax-request/ajax_response.php?action=e_assist&subaction=submit" method="post" id="e_assist" name="contact-form">
                <div class="form-group">
                    <input type="checkbox" id="taxCheck" name="tax" value="tax">
                    <label for="vehicle1"> Tax</label>
                    <input type="checkbox" id="investmentCheck" name="investment" value="investment">
                    <label for="vehicle2"> Investments</label>
                    <input type="checkbox" id="willCheck" name="will" value="will">
                    <label for="vehicle3"> Will</label>
                    <hr>
                    <div id="taxsub" style="display: none;">
                        <input type="checkbox" id="taxFileCheck" name="taxFile" value="taxFile">
                        <label for="vehicle2"> Tax File</label><br>
                        <input type="checkbox" id="taxAssessmentCheck" name="taxAssessment" value="taxAssessment">
                        <label for="vehicle3"> Tax Assessment</label>
                    </div>
                    <span id="eca_name_error"></span>
                </div>
                <div class="form-group">
                    <label class="mandatory mandatory_label">Name</label>
                    <input type="text" class="form-control" name="ea_name" id="ea_name" value="" placeholder="Name">
                    <span id="eca_name_error"></span>
                </div>
                <div class="form-group">
                    <label class="mandatory mandatory_label">e-mail Address</label>
                    <input type="email" class="form-control" name="ea_email" id="ea_email" value="" placeholder="Email Address">
                    <span id="eca_email_error"></span>
                </div>
                <div class="form-group">
                    <label class="mandatory mandatory_label">Mobile Number</label>
                    <input type="text" class="form-control" name="ea_mob" id="ea_mob" value="" placeholder="Mobile number">
                    <span id="eca_mob_error"></span>
                </div>
                <div class="login_button text-center">
                    <button class="btn login_btn btn-lg" type="submit" id="hire_now">Hire Expert Now</button>
                </div>
                <div class="form-group text-center">
                    <span id="eca_success"></span>
                </div>
            </form>
        </div>
    </div>
</div>
<?php } ?>
<!-- footer_end-->