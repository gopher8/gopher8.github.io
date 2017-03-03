
$('.about-slider').slick({
  dots: false,
  infinite: true,
  speed: 500,
  autoplay: true,
  arrows: true,
  asNavFor: '.slider-nav'
});
$('.slider-nav').slick({
  slidesToShow: 2,
  slidesToScroll: 1,
  asNavFor: '.about-slider',
  dots: false,
  centerMode: true,
  focusOnSelect: true,
  arrows: false,
});

// Explore slider
$('.rl-explore-slider').slick({
  dots: false,
  infinite: true,
  speed: 500,
  autoplay: true,
  arrows: true,
});

// Insta slider
$('.instagram-wrap').slick({
  dots: false,
  infinite: true,
  speed: 500,
  autoplay: true,
  arrows: true,
  slidesToShow: 3,
  slidesToScroll: 3,
  responsive: [
      {
        breakpoint: 990,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 3,
          infinite: true,
        }
      },
      {
        breakpoint: 768,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2
        }
      },
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      }
  ]
});

// testimonial slider
var $status = $('.pagingInfo');
var $slickElement = $('.testimonial-slider');
$slickElement.on('init reInit afterChange', function (event, slick, currentSlide, nextSlide) {
    //currentSlide is undefined on init -- set it to 0 in this case (currentSlide is 0 based)
    var i = (currentSlide ? currentSlide : 0) + 1;
    $status.text('0'+i + '/' + '0'+slick.slideCount);
  });
$('.testimonial-slider').slick({
  dots: false,
  infinite: true,
  speed: 500,
  autoplay: true,
  arrows: true
});


//Counter
if ( $( ".timer" ).length ) {
  $(document).on('scroll', function() {
     var hT = $('.timer').offset().top,
         hH = $('.timer').outerHeight(),
         wH = $(window).height(),
         wS = $(this).scrollTop();
     if (wS > (hT+hH-wH)){
        $(document).off('scroll');
        $('.timer').countTo();
     }
  });
}


// Offcanvas mobile navigation
jQuery('.menu-btn').sidr({
  side: 'left',
  body: '.offcanvas-wrap'
});

$('<i class="icon ion-android-arrow-forward sidedropdown"></i>').appendTo($("#sidr li.menu-item-has-children > a"));

$("#sidr ul .sidedropdown").on('click', function(event) {
  event.preventDefault();
  $(this).toggleClass('open');
  $(this).toggleClass('first');
  $(this).parent().next('.sub-menu').toggleClass('open');
});

$('.control').click(function () {
  $('body').addClass('mode-search hide-scroll');
  $('.input-search').focus();
});
$('.icon-close').click(function () {
  $('body').removeClass('mode-search hide-scroll');
});

/********************************
Window Load Functions
*********************************/
$(window).load(function() {
  $('#sidr').removeClass('hidden');
});

function responsiveIframe(){
var videoSelectors = [
  'iframe[src*="player.vimeo.com"]',
  'iframe[src*="youtube.com"]',
  'iframe[src*="youtube-nocookie.com"]',
  'iframe[src*="kickstarter.com"][src*="video.html"]',
  'iframe[src*="screenr.com"]',
  'iframe[src*="blip.tv"]',
  'iframe[src*="dailymotion.com"]',
  'iframe[src*="viddler.com"]',
  'iframe[src*="qik.com"]',
  'iframe[src*="revision3.com"]',
  'iframe[src*="hulu.com"]',
  'iframe[src*="funnyordie.com"]',
  'iframe[src*="flickr.com"]',
  'embed[src*="v.wordpress.com"]',
  'iframe[src*="videopress.com"]',
            'embed[src*="videopress.com"]'
  // add more selectors here
];
var allVideos = videoSelectors.join( ',' );
jQuery( allVideos ).wrap( '<span class="media-holder" />' );
}
// Responsive Iframes
  responsiveIframe();
