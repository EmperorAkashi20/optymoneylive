<header class="masthead" style="background-image: url('<?php echo $CONFIG->staticURL; ?><?php echo $CONFIG->theme_new; ?>img/bannerBG.svg');">
    <div class="container h-100">
        <img src="<?php echo $CONFIG->staticURL; ?><?php echo $CONFIG->theme_new; ?>img/contactus.svg" class="vector" />
        <div class="row h-100 align-items-center">
            <div class="col-12 text-left">
                <h1 class="font-weight-light">Contact Us</h1>
                <p class="lead">Contact for Support & Expert Assistance</p>
            </div>
        </div>
    </div>
</header>
<!--/ bradcam_area -->

<!-- contact_form_area_start  -->
<div class="contact_form_area">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="row justify-content-center">
                    <div class="col-xl-10">
                        <div class="section_title text-center wow fadeInUp" data-wow-duration="1s" data-wow-delay=".1s">
                            <h5>Reach Us Demistify Finance</h5>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="single_contact_info text-center wow fadeInUp" data-wow-duration="1s" data-wow-delay=".1s">
                            <div class="icon">
                                <i class="Flaticon flaticon-placeholder"></i>
                            </div>
                            <h6>Bangalore Office</h6>
                            <p>Dev Mantra Online Services Private Limited <br>
                                No. 85/1, CBI Main Road, Bangalore, Karnataka, 560 024 <br>
                                email : support@optymoney.com<br>
                                CIN : U72900KA2018PTC111791
                            </p>
                        </div>
                        <div class="single_contact_info text-center wow fadeInUp" data-wow-duration="1s" data-wow-delay=".3s">
                            <div class="icon">
                                <i class="Flaticon flaticon-share"></i>
                            </div>
                            <h6>Follow Us</h6>
                            <div class="social_links">
                                <ul>
                                    <li><a href="https://bit.ly/optyfb"><i class="fab fa-facebook-f"></i></a></li>
                                    <li><a href="https://bit.ly/optylinkedin"><i class="fab fa-linkedin-in"></i></a></li>
                                    <li> <a href="https://bit.ly/optyoutube"><i class="fab fa-youtube"></i></a></li>
                                    <li> <a href="https://bit.ly/optyinsta"><i class="fab fa-instagram"></i></a></li>
                                    <li> <a href="https://bit.ly/optytwitter"><i class="fab fa-twitter"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="section_title text-center wow fadeInUp" data-wow-duration="1s" data-wow-delay=".1s">
                            <h5>We are happy to assist you</h5>
                        </div>
                    </div>
                </div>
                <form action="<?= $CONFIG->siteurl; ?>ajax-request/ajax_response.php?action=contactus&subaction=submit" method="post" name="contact-form" id="contact-form" onSubmit="contactusJS(this);return false;">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="single_field bordered_1 wow fadeInUp" data-wow-duration="1s" data-wow-delay=".1s">
                                <input type="text" class="effect-1 formname" autocomplete="off" name="formname" id="formname" placeholder="Your Name">
                                <span class="focus-border"></span>
                                <span id="formname_error" class="bottom_error"></span>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="single_field bordered_1 wow fadeInUp" data-wow-duration="1s" data-wow-delay=".1s">
                                <input type="email" class="effect-1 formemail" autocomplete="off" name="formemail" id="formemail" placeholder="Your Email">
                                <span class="focus-border"></span>
                                <span id="formemail_error" class="bottom_error"></span>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="single_field bordered_1 wow fadeInUp" data-wow-duration="1s" data-wow-delay=".2s">
                                <input type="text" class="effect-1 formnumber" autocomplete="off" name="formnumber" id="formnumber" placeholder="Your Mobile Number">
                                <span class="focus-border"></span>
                                <span id="formnumber_error" class="bottom_error"></span>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="single_field  wow fadeInUp" name="formmessage" id="formmessage" data-wow-duration="1s" data-wow-delay=".2s mb-40">
                                <textarea placeholder="Message"></textarea>
                            </div>
                        </div>
                        <div class="captcha col-sm-12 text-center">
                            <div class="g-recaptcha" data-sitekey="6Ld0L9UUAAAAAPU9nm94IpPxd9uRrnwHQ9jVdB3g"></div>
                            <input type="hidden" name="g_value" value="6Ld0L9UUAAAAAPU9nm94IpPxd9uRrnwHQ9jVdB3g">
                        </div>
                        <div class="col-md-12 wow fadeInUp text-center" data-wow-duration="1s" data-wow-delay=".2s">
                            <a class="paste_btn2" href="#" id="contactusSubmit">Send Message</a>
                        </div>
                    </div>
                </form>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div style="display: <?= $display; ?>;" id="contactresponse" class="orange">
                        <!-- <strong>Thank you for Contact with us. We will call you back ASAP.</strong> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- contact_form_area_start  -->
<div id="row embed-responsive ">
    <iframe class="col-12 embed-responsive-item" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15548.563476480287!2d77.587337!3d13.0267!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xeba33dfdad272411!2sOptymoney!5e0!3m2!1sen!2sin!4v1589561946125!5m2!1sen!2sin" width="800" height="450" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
</div>
<div class="main_contact_area">
</div>
<!-- footer_start -->