<?php

$url.= $_SERVER['REQUEST_URI'];


if ($_SESSION['status']) 
{
  $status = $_SESSION['status'];
  /*if ($status == "REGISTER_DONE") 
  {
    $output = "You are register for the event";
    $display = "block";
  }
  elseif ($status == "REGISTER_FAILED") 
  {
    $output = "You Already Registered";
    $display = "block";
  }
  else
  {
    $output = "";
    $display = "none";
  }*/
  // echo "STATUS:".$status;
  // die();
}

?>
<!doctype html>
<html class="no-js" lang="zxx">
<style>
    .home_3 .header_area .main_menu ul li a {
    color: #d33633;
}
form.connect_us input {
    border: 1px solid #f1f1f1 !important;
    padding: 8px 0px 8px 21px !important;
    border-radius: 20px;
}
</style>
</head>

<body class="home_3 inner_pages">

               
  <!-- contact_form_area_start  -->
    <div class="contact_form_area">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="section_title text-center wow fadeInUp" data-wow-duration="1s" data-wow-delay=".1s">
                        <h3>Registration Form</h3>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-xl-6 col-md-6">
                    <form class="connect_us" action="ajax-request/ajax_response.php?action=connect_us&subaction=submit" method="POST"  id="contact_form">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="single_field bordered_1 wow fadeInUp" data-wow-duration="1s" data-wow-delay=".1s">
                                    <input type="text" class="effect-1" name="name" placeholder="Your Name" required="required">
                                    <span class="focus-border"></span>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="single_field bordered_1 wow fadeInUp" data-wow-duration="1s" data-wow-delay=".1s" >
                                    <input type="email" name="email" class="effect-1" placeholder="Your Email" required="required">
                                    <span class="focus-border"></span>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="single_field bordered_1 wow fadeInUp" data-wow-duration="1s" data-wow-delay=".1s" >
                                    <input type="tel" name="mobile" class="effect-1" placeholder="Mobile Number" required="required">
                                    <span class="focus-border"></span>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="single_field bordered_1 wow fadeInUp" data-wow-duration="1s" data-wow-delay=".1s" >
                                    <input type="text" name="org" class="effect-1" placeholder="Organization" >
                                    <span class="focus-border"></span>
                                </div>
                            </div>
                           <input type="hidden" name="url" value="<?= $url ?>">
                            <div class="col-md-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay=".2s">
                                <button type="submit" class="boxed_btn">Submit</button>
                            </div>
                        </div>
                        <!--<a href="#" data-toggle="modal" data-target="#thanks_message">thanks_message</a>-->
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- contact_form_area_start  -->
        
        <!-- thankyou message -->
        <div class="modal fade custom_login_from" id="thanks_message" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered thanks_message" role="document">
                <div class="modal-content">
                    <div class="modal-body ">
                        <div class="login_form">
                            <div class="login_heading">
                                 <button type="button" class="close" data-dismiss="modal">&times;</button>
                               
                            </div>
                            <div class="main_content">
                               
                                <span id="sccs"></span>
                                
                            </div>
                            <div class="login_button">
                                        <button class="boxed_btn3 w-100" data-dismiss="modal">Ok</button>
                                    </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ thankyou message -->

    <!-- footer_start -->
    <footer>
        <div class="ilstrator_footer_img d-none d-lg-block ">
            <img src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>img/banner/footer_ils_1.png" alt="">
        </div>
        <div class="anim_icon ">
            <div class="anim_icon_1 amination_custom">
                <img src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>img/animated_icon/4.png" alt="">
            </div>
            <div class="anim_icon_2 amination_custom11">
                <img src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>img/animated_icon/5.png" alt="">
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
 <!-- <a href="#" class="float_chat" target="_blank">
<i class="fa fa-comment my-float"></i></a> -->
            </div>
        </div>
        
        
 <!-- Login Form -->
    <div class="modal fade custom_login_from" id="login_form" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body ">
                    <div class="login_form">
                        <div class="login_heading">
                             <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h3>Login</h3>
                        </div>
                        <div class="main_content">
                           
                            <form action="wealth.html" class="login">
                                
                                <div class="single_input">
                                    <input type="email" placeholder="Email Address" >
                                </div>
                                <div class="single_input">
                                    <input type="password" placeholder="Password" >
                                </div>
                                <div class="login_button">
                                    <button class="boxed_btn3 w-100" type="submit">Login</button>
                                </div>
                                <div class="forgot_pass">
                                    <p><a href="#" class="sign_in" data-toggle="modal" data-target="#forgot_password">Forget Password?</a></p>
                                    <p>Don't have an account? <a class="sign_in" data-toggle="modal" data-target="#signupp" href="#">Sign Up</a></p>
                                </div>
                            </form>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!--/ Login Form -->


 <!-- Forgot Password -->
    <div class="modal fade custom_login_from" id="forgot_password" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body ">
                    <div class="login_form">
                        <div class="login_heading">
                             <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h3>Reset Password</h3>
                        </div>
                        <div class="main_content">
                           
                            <form action="wealth.html" class="login">
                                
                                <div class="single_input">
                                    <input type="email" placeholder="Email Address" >
                                </div>
                               
                                <div class="login_button">
                                    <button class="boxed_btn3 w-100" type="submit">Reset Password</button>
                                </div>
                               
                            </form>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!--/ Forgot Password -->
 <!-- start now -->
    <div class="modal fade custom_login_from" id="exampleModalCenter" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body ">
                    <div class="login_form">
                        <div class="login_heading">
                             <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h3>Sign Up</h3>
                        </div>
                        <div class="main_content">
                           
                            <form action="wealth.html" class="login">
                                <div class="single_input">
                                    <input type="text" placeholder="Name" >
                                </div>
                                <div class="single_input">
                                    <input type="email" placeholder="Enter your email" >
                                </div>
                                <div class="single_input">
                                    <input type="tel" placeholder="Phone Number" >
                                </div>
                                <div class="login_button">
                                    <button class="boxed_btn3 w-100" type="submit">Submit</button>
                                </div>
                            </form>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!--/ start now -->

 <!-- signup -->
    <div class="modal fade custom_login_from" id="signupp" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body ">
                    <div class="login_form">
                        <div class="login_heading">
                             <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h3>Sign Up</h3>
                        </div>
                        <div class="main_content">
                           
                            <form action="wealth.html" class="login">
                                <div class="single_input">
                                    <input type="text" placeholder="Name" >
                                </div>
                                <div class="single_input">
                                    <input type="email" placeholder="Enter your email" >
                                </div>
                                <div class="single_input">
                                    <input type="tel" placeholder="Phone Number" >
                                </div>
                                <div class="login_button">
                                    <button class="boxed_btn3 w-100" type="submit">Request OTP</button>
                                </div>
                                 <div class="single_input">
                                    <input type="password" placeholder="Password" >
                                </div>
                                 <div class="single_input">
                                    <input type="tel" placeholder="Confirm Password" >
                                </div>
                                <div class="login_button">
                                    <button class="boxed_btn3 w-100" type="submit">Submit</button>
                                </div>
                            </form>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!--/ signup -->
    </footer>
    <!-- footer_end -->
   


   

    <!-- back-top_start  -->
    <div id="back-top">
        <a title="Go to Top" href="#">
            <i class="ti-angle-up"></i>
        </a>
    </div>
    <!-- back-top_end -->

    <!--All JS here -->
    
  
    <script src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>js/popper.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

    <script src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>js/owl.carousel.min.js"></script>
    <script src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>js/isotope.pkgd.min.js"></script>
    <script src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>js/jquery.counterup.min.js"></script>
    <script src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>js/imagesloaded.pkgd.min.js"></script>
    <script src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>js/wow.min.js"></script>
    <script src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>js/nice-select.min.js"></script>
    <script src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>js/jquery.slicknav.js"></script>
    <script src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>js/jquery.magnific-popup.min.js"></script>
    <script src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>js/parallax.js"></script>
    <script src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>js/plugins.js"></script>
    <script
      src="<?php echo $CONFIG->siteurl;?>__UI.assets/js/js_function.php"></script>
    <!-- main js  -->
    <script src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>js/main.js"></script>
         <?php
            if ($status == "REGISTRATION_SUCCESS") 
            {
            ?>
               <?php
                echo "<script type='text/javascript'>
                $(document).ready(function(){
                $('#thanks_message').modal('show');
                $('#sccs').text('Thank you for registering for the live session. Please check your email for joining details. Thank you.');
                
                });
                </script>";
                ?>
            <?php
            }
            elseif ($status == "REGISTRATION_SUCCESS_1") 
            {
               ?>
               <?php
                echo "<script type='text/javascript'>
                $(document).ready(function(){
                $('#thanks_message').modal('show');
                $('#sccs').text('Thank you for registering for TAX PE BAAT live interactive session on HOW PROFESSIONALS CAN SAVE TAX OUTGO? Please check your email for further details.');
                });
                </script>";
                ?>
            <?php
            }
            elseif ($status == "REGISTER_FAIL" || $status == "REGISTER_FAILED") 
            {
               ?>
               <?php
                echo "<script type='text/javascript'>
                $(document).ready(function(){
                $('#thanks_message').modal('show');
                $('#sccs').text('You already registerd for this event. Please check your email for details.');
                });
                </script>";
                ?>
            <?php
            }
             unset($_SESSION['status']);
            ?>
    <script type="text/javascript">
        $(document).ready(function() {
        $('#contact_form').bootstrapValidator({
            // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                first_name: {
                    validators: {
                            stringLength: {
                            min: 2,
                        },
                            notEmpty: {
                            message: 'Please enter your First Name'
                        }
                    }
                },
                 last_name: {
                    validators: {
                         stringLength: {
                            min: 2,
                        },
                        notEmpty: {
                            message: 'Please enter your Last Name'
                        }
                    }
                },
            
                email: {
                    validators: {
                        notEmpty: {
                            message: 'Please enter your Email Address'
                        },
                        emailAddress: {
                            message: 'Please enter a valid Email Address'
                        }
                    }
                },
                contact_no: {
                    validators: {
                      stringLength: {
                            min: 12, 
                            max: 12,
                        notEmpty: {
                            message: 'Please enter your Contact No.'
                         }
                    }
                },
            
                    }
                }
            })
            .on('success.form.bv', function(e) {
                $('#success_message').slideDown({ opacity: "show" }, "slow") // Do something ...
                    $('#contact_form').data('bootstrapValidator').resetForm();

                // Prevent form submission
                e.preventDefault();

                // Get the form instance
                var $form = $(e.target);

                // Get the BootstrapValidator instance
                var bv = $form.data('bootstrapValidator');

                // Use Ajax to submit form data
                $.post($form.attr('action'), $form.serialize(), function(result) {
                    console.log(result);
                }, 'json');
            });
    });
    </script>
    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
    s1.async=true;
    s1.src='https://embed.tawk.to/5ed75b7d9e5f6944228fc6bd/default';
    s1.charset='UTF-8';
    s1.setAttribute('crossorigin','*');
    s0.parentNode.insertBefore(s1,s0);
    })();
    </script>
    <!--End of Tawk.to Script-->

</body>
</html>