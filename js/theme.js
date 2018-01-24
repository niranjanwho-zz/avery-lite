jQuery(document).ready(function($){
	"use strict";

	// Scroll Up
	$(window).scroll(function () {
        if ($(this).scrollTop() > 600) {
            $('.scrollup').fadeIn();
        } else {
            $('.scrollup').fadeOut();
        }
    });
    $('.scrollup').click(function () {
        $("html, body").animate({
            scrollTop: 0
        }, 600);
        return false;
    });
	
	// Page Transition
	$('.animsition').animsition({
	    inClass: 'fade-in',
	    outClass: 'fade-out',
	    inDuration: 1500,
	    outDuration: 800,
	    linkElement: 'a[target!="_blank"]:not([href^="#"]):not(.media-img)',
	    // e.g. linkElement: 'a:not([target="_blank"]):not([href^="#"]'
	    loading: true,
	    loadingParentElement: 'body', //animsition wrapper element
	    loadingClass: 'animsition-loading',
	    loadingInner: '', // e.g '<img src="loading.svg" />'
	    timeout: false,
	    timeoutCountdown: 5000,
	    onLoadEvent: true,
	    browser: [ 'animation-duration', '-webkit-animation-duration'],
	    // "browser" option allows you to disable the "animsition" in case the css property in the array is not supported by your browser.
	    // The default setting is to disable the "animsition" in a browser that does not support "animation-duration".
	    overlay : false,
	    overlayClass : 'animsition-overlay-slide',
	    overlayParentElement : 'body',
	    transition: function(url){ window.location.href = url; }
	});

	// Search bar
	$('.site-search-toggle').on('click', function(){
		$(this).parent().toggleClass('toggled');
		$('.site-search-form').fadeToggle().toggleClass('show');
	});

	// Dynamically add column classes to footer widgets, depending on how many widgets are present
	$('#sidebar-footer').removeClass().addClass(function(){
	  return ["sidebar-footer-none", "sidebar-footer-one", "sidebar-footer-two", "sidebar-footer-three"]
	     [$(this).children('.sidebar-footer-widget').length];
	});

    // Add .more-link class to instagram link text
    $('.null-instagram-feed > p > a').addClass('more-link');

	// Swiper
	var swipercoverflow = new Swiper('.swiper-coverflow', {
        autoplay: 6000, // Delay between transitions (in ms)
        autoplayDisableOnInteraction: false, // Autoplay will not be disabled after user interactions
        parallax: true, // Parallaxed elements inside of slider
        speed: 2000, // Duration of transition between slides (in ms) 
        roundLengths: true, // Prevent blurry texts on usual resolution screens
        grabCursor: true, // User will see the "grab" cursor when hover on Swiper
        keyboardControl: true, // Enable navigation through slides using keyboard arrows 
        slidesPerView: 1, // Number of slides per view
        spaceBetween: 0, // Distance between slides in px
        loop: true, // Enable continuous loop mode
        nextButton: '.swiper-button-next', // Next slide
        prevButton: '.swiper-button-prev', // Previous slide
        effect: 'coverflow', // Swiper effect
        // Coverflow effect parameters
        coverflow: { 
            rotate: 50,
            stretch: 0,
            depth: 100,
            modifier: 1, 
            slideShadows : false // Disable shadows for better performance.
        }
    });

	// Add margin after swiper
	$('.swiper-slide').parent().parent().addClass('margin-bottom-40');

	// Trending
	var trending = new Swiper('.trending-post-swiper', {
        autoplay: 8000, // Delay between transitions (in ms)
        autoplayDisableOnInteraction: false, // Autoplay will not be disabled after user interactions
        speed: 1200, // Duration of transition between slides (in ms)
        roundLengths: true, // Prevent blurry texts on usual resolution screens
        grabCursor: true, // User will see the "grab" cursor when hover on Swiper
        keyboardControl: true, // Enable navigation through slides using keyboard arrows 
        slidesPerView: 3, // Number of slides per view
        spaceBetween: 10, // Distance between slides in px
        // Responsive breakpoints
        breakpoints: {
            1023: {
                slidesPerView: 2,
            },
            767: {
                slidesPerView: 1,
            }
        }
    });

    // Featured
	var featured = new Swiper('.widget-featured-post-swiper', {
        autoplay: 6000, // Delay between transitions (in ms)
        autoplayDisableOnInteraction: false, // Autoplay will not be disabled after user interactions
        parallax: true, // Parallaxed elements inside of slider
        speed: 2000, // Duration of transition between slides (in ms)
        roundLengths: true, // Prevent blurry texts on usual resolution screens
        grabCursor: true, // User will see the "grab" cursor when hover on Swiper
        keyboardControl: true, // Enable navigation through slides using keyboard arrows 
        slidesPerView: 1, // Number of slides per view
        spaceBetween: 0, // Distance between slides in px
        loop: true, // Enable continuous loop mode
    });

	// Sticky Sidebar
	$('.site-wrapper, .site-sidebar').theiaStickySidebar();

	// MagnificPopup  
	var img = jQuery('a').filter(function() {
	var href = jQuery(this).attr('href');
	if(typeof href !=='undefined') {
		href = href.toLowerCase();
		return href.substr(-4) == '.jpg' || href.substr(-5) == '.jpeg' ||  href.substr(-4) == '.png' || href.substr(-4) == '.gif';
	}
	});

	img.magnificPopup({
		type:'image',
		removalDelay: 300,
		gallery: {
			enabled:true
		}, 
		mainClass: 'mfp-with-zoom', // this class is for CSS animation below
		zoom: {
			enabled: true, // By default it's false, so don't forget to enable i
			duration: 300, // duration of the effect, in milliseconds
			easing: 'ease-in-out', // CSS transition easing function
			// The "opener" function should return the element from which popup will be zoomed in
			// and to which popup will be scaled down
			// By defailt it looks for an image tag:
			opener: function(openerElement) {
				// openerElement is the element on which popup was initialized, in this case its <a> tag
				// you don't need to add "opener" option if this code matches your needs, it's defailt one.
				return openerElement.is('img') ? openerElement : openerElement.find('img');
			}
		}
	});

});