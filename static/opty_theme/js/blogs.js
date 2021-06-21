$(function(){
    $(".contentHidden").hide();
    $(".blog_content").each(function(){
        var $ths = $(this),
            txt = $ths.text();
        //Clear the text
        $ths.text("");
        //First 100 chars
        $ths.append($("<span>").text(txt.split(/\s+/).slice(0,30).join(" ")));
    });
    $('.modalView').on('click',function(){
        $('#exampleModalLabel').text($(this).parent().prev('.card-body').find('h5').text());
        $('.modal-body').html($(this).parent().prev('.card-body').find('.contentHidden').html());
    });
    $('.owl-carousel').owlCarousel({     
        loop:true,
        margin:25,
        responsiveClass:true,
        nav: true,
        navText: [
            '<i class="fas fa-angle-left" aria-hidden="true"></i>',
            '<i class="fas fa-angle-right" aria-hidden="true"></i>'
        ],
        navContainer: '.owl-container .custom-nav',    
        autoplay:true,
        autoplayTimeout:2500, 
        responsive:{
            0:{
                items:1 
            },
            700:{
                items:2
            },
            1000:{
                items:3
            },
            1200:{
                items:4
            } 
        }
    });
});