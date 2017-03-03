$ = jQuery.noConflict();
jQuery(document).ready(function($){
    "use strict";

     $('a[href*="#"]:not([href="#"])').click(function() {
            if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') || location.hostname == this.hostname) {

                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                if (target.length) {
                    $('html,body').animate({
                        scrollTop: target.offset().top
                    }, 1000);
                    return false;
                }
            }
    });

    $("#menu-close").click(function(e) {
        e.preventDefault();
        $("#sidebar-wrapper").toggleClass("active");
    });

    //Archive content gallery carousel

    $('.resortica-gallery-carousel').slick({
      dots: false,
      infinite: true,
      speed: 500,
      autoplay: true,
      arrows: true,
    });
})