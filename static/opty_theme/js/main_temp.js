(function($) {
    "use strict";
    // back to top 
    $('#back-top a').on("click", function() {
        $('body,html').animate({
            scrollTop: 0
        }, 1000);
        return false;
    });


    // wow js
    new WOW().init();

    // nice select 
    $('select').niceSelect();

    // #######################
    //  review-active        
    // #######################
    $('.brand_active').owlCarousel({
        loop: true,
        margin: 0,
        items: 1,
        autoplay: true,
        navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
        nav: false,
        dots: true,
        autoplayHoverPause: true,
        autoplaySpeed: 800,
        responsive: {
            0: {
                items: 2
            },
            767: {
                items: 3
            },
            992: {
                items: 5
            }
        }
    });

    // ####################### 
    // case_actove       
    // #######################

    $('.case_actove').owlCarousel({
        loop: true,
        margin: 20,
        items: 1,
        // autoplay:true,
        navText: ['<i class="ti-angle-left"></i>', '<i class="ti-angle-right"></i>'],
        nav: true,
        dots: false,
        autoplayHoverPause: true,
        autoplaySpeed: 800,
        responsive: {
            0: {
                items: 1,
                nav: false
            },
            767: {
                items: 2,
                nav: false
            },
            992: {
                items: 3
            },
            1200: {
                items: 4
            }
        }
    });

    $('.case_actove2').owlCarousel({
        loop: true,
        margin: 0,
        items: 1,
        // autoplay:true,
        navText: ['<i class="ti-angle-left"></i>', '<i class="ti-angle-right"></i>'],
        nav: true,
        dots: false,
        autoplayHoverPause: true,
        autoplaySpeed: 800,
        responsive: {
            0: {
                items: 1,
                nav: false
            },
            767: {
                items: 2,
                nav: false
            },
            992: {
                items: 3
            },
            1200: {
                items: 4
            }
        }
    });

    // ####################### 
    // testmonial_active     
    // #######################

    $('.testmonial_active').owlCarousel({
        loop: true,
        margin: 20,
        items: 1,
        autoplay: true,
        navText: ['<i class="flaticon-back"></i>', '<i class="flaticon-next"></i>'],
        nav: true,
        dots: false,
        autoplayHoverPause: true,
        autoplaySpeed: 800,
        animateOut: 'fadeOut',
        animateIn: 'fadeIn',
        responsive: {
            0: {
                items: 1
            },
            767: {
                items: 1
            },
            992: {
                items: 1
            }
        }
    });

    // counter 
    /*$('.counter').counterUp({
      delay: 10,
      time: 10000
    });*/

    /* magnificPopup img view */
    $('.popup-image').magnificPopup({
        type: 'image',
        gallery: {
            enabled: true
        }
    });

    /* magnificPopup video view */
    $('.popup-video').magnificPopup({
        type: 'iframe',
        mainClass: 'mfp-fade',
        removalDelay: 160,
        preloader: false,
        fixedContentPos: false
    });

    // for filter
    // init Isotope
    var $grid = $('.grid').isotope({
        itemSelector: '.grid-item',
        percentPosition: true,
        masonry: {
            // use outer width of grid-sizer for columnWidth
            columnWidth: 1
        }
    });

    // filter items on button click
    $('.portfolio-menu').on('click', 'button', function() {
        var filterValue = $(this).attr('data-filter');
        $grid.isotope({
            filter: filterValue
        });
    });

    //for menu active class
    $('.portfolio-menu button').on('click', function(event) {
        $(this).siblings('.active').removeClass('active');
        $(this).addClass('active');
        event.preventDefault();
    });

    $('.testmonial3_active').on('initialized.owl.carousel changed.owl.carousel', function(e) {
        if (!e.namespace) {
            return;
        }
        var carousel = e.relatedTarget;
        $('.slider-counter').text(carousel.relative(carousel.current()) + 1 + '/' + carousel.items().length);
    }).owlCarousel({
        loop: true,
        margin: 0,
        items: 1,
        autoplay: true,
        nav: false,
        dots: false,
        autoplayHoverPause: true,
        autoplaySpeed: 800,
        animateOut: 'fadeOut',
        animateIn: 'fadeIn'
    });

    /*=============================================== 
          Parallax business_image
    ================================================*/
    if ($('.business_image').length > 0) {
        $('.business_image').parallax({
            scalarX: 7.0,
            scalarY: 0.0,
        });
    }

    $('.SeeMore2').click(function() {
        var $this = $(this);
        $this.toggleClass('SeeMore2');
        if ($this.hasClass('SeeMore2')) {
            $this.text('Read More');
        } else {
            $this.text('Read Less');
        }
    });


    $('#eca').click(function(e) {
        e.preventDefault(); // avoid to execute the actual submit of the form.
        var datares = 1;
        if ($('#formname').val() == "") {
            datares = 0;
            $("#eca_name_error").text("Name Required");
        } else {
            $("#eca_name_error").text("");
        }
        if ($('#formemail').val() == "") {
            datares = 0;
            $("#eca_email_error").text("Email Required");
        } else {
            $("#eca_email_error").text("");
        }
        if ($('#formnumber').val() == "") {
            datares = 0;
            $("#eca_mob_error").text("Mobile Required");
        } else {
            $("#eca_mob_error").text("");
        }
        if (datares == 1) {
            var form = $('#contact-form');
            var url = form.attr('action');
            $.ajax({
                type: "POST",
                url: url,
                data: form.serialize(), // serializes the form's elements.
                beforeSend: function() {
                    $('.ajax-loader').css("visibility", "visible");
                },
                complete: function() {
                    $('.ajax-loader').css("visibility", "hidden");
                },
                success: function(data) {
                    if (data == 1) {
                        $('#contact-form')[0].reset();
                        $('#contactresponsehome').text("Your Request Submitted, Our team will get back to you soon");
                        $('#contactresponsehome').css("color", "green");
                    } else {
                        $('#contactresponsehome').text("Request submission failed");
                        $('#contactresponsehome').css("color", "red");
                    }
                }
            });
        }
    });
    $('#contact-form1').submit(function(e) {
        e.preventDefault();
        if ($('#contact-form1').valid()) {
            $.ajax({
                cache: false,
                url: $('#contact-form1')[0].action,
                type: "POST",
                data: $('#contact-form1').serialize(),
                success: function(response) {
                    //alert(response);
                    var res = $.trim(response);
                    //alert(res);
                    if (res == 1 || data == "CONTACT_SENT") {
                        $("#contact-form1").val("");
                        $("#ea_email").val("");
                        $("#ea_mob").val("");
                        $("#taxCheck").prop("checked", false);
                        $("#investmentCheck").prop("checked", false);
                        $("#willCheck").prop("checked", false);
                        $("#taxFileCheck").prop("checked", false);
                        $("#taxAssessmentCheck").prop("checked", false);
                        // alert("Thank you for contacting us.We will contact with you shortly."); 
                        $("#eca_success").text("Thank you for contacting us. We will get back to you at the earliest, usually within 24 hours.");
                        $('#eca_success').css("color", "green");
                    } else {
                        $("#eca_success").text("Please Try Again...");
                        $('#eca_success').css("color", "red");
                    }
                }
            });
        }
    });
    $('#contactusSubmit').click(function(e) {
        e.preventDefault(); // avoid to execute the actual submit of the form.
        var datares = 1;
        if ($('#formname').val() == "") {
            datares = 0;
        }
        if ($('#formemail').val() == "") {
            datares = 0;
        }
        if ($('#formnumber').val() == "") {
            datares = 0;
        }
        if (datares == 1) {
            var form = $('#contact-form');
            var url = form.attr('action');
            $.ajax({
                type: "POST",
                url: url,
                data: form.serialize(), // serializes the form's elements.
                beforeSend: function() {
                    $('.ajax-loader').css("visibility", "visible");
                },
                complete: function() {
                    $('.ajax-loader').css("visibility", "hidden");
                },
                success: function(data) {
                    if (data == 1) {
                        $('#contact-form')[0].reset();
                        $('#contactresponse').text("Your message Received, Our team will get back to you soon");
                        $('#contactresponse').css("color", "green");
                    } else {
                        $('#contactresponse').text("Message sent failed");
                        $('#contactresponse').css("color", "red");
                    }
                }
            });
        }
    });
    if ($('.brands_slider').length) {
        var brandsSlider = $('.brands_slider');

        brandsSlider.owlCarousel({
            loop: true,
            autoplay: true,
            autoplayTimeout: 5000,
            nav: false,
            dots: false,
            autoWidth: true,
            items: 8,
            margin: 10
        });

        if ($('.brands_prev').length) {
            var prev = $('.brands_prev');
            prev.on('click', function() {
                brandsSlider.trigger('prev.owl.carousel');
            });
        }

        if ($('.brands_next').length) {
            var next = $('.brands_next');
            next.on('click', function() {
                brandsSlider.trigger('next.owl.carousel');
            });
        }
    }
    


    /*$(".owl-carousel").owlCarousel({
        autoPlay: 3000,
        items : 4,
        itemsDesktop : [1199,3],
        itemsDesktopSmall : [979,3],
        center: true,
        nav:true,
        loop:true,
        responsive: {
            600: {
                items: 4
            }
        }
    });*/
})(jQuery);