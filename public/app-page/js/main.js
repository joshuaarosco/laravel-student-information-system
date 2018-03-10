/* ==========================================================================
   NOTE:
   This file is being used to activate and set options for all jQuery plugins
   for this template. Please don't modify this file unless necessary. This will 
   make it easy for you to upgrade your website with new template files easily 
   when new version of this template will be available.    
   --------------------------------------------------------------------------
    TABLE OF CONTENT
   --------------------------------------------------------------------------
   01 - preloader
   02 - on-scroll navbar animation
   03 - Tooltip
   04 - Carousel ( app screenshots )
   05 - Init Parallax
   06 - Appear Animation on Individual Elements
   07 - Progress ( skills ) Bars
   08 - Popup
   09 - Mailchimp Settings
   10 - Twitter Feed
   11 - back to top button
   ========================================================================== */

jQuery( document ).ready( function($){
	
	'use strict';	
	
	
	/*		
	01 - Preloader
	*/
    $('.spinner-wrap').fadeOut();
	$('.preloader').delay(500).fadeOut('slow');
	
	
	/*
	02 - Main Navigation
	*/
	$( function(){
		if ( $(".navbar").offset().top > 50 ) {
			$( ".navbar-fixed-top" ).addClass( "top-nav-collapse" );
		} else {
			$( ".navbar-fixed-top" ).removeClass( "top-nav-collapse" );
		}
	});
	$( window ).scroll( function() {
		if ( $( ".navbar" ).offset().top > 50 ) {
			$( ".navbar-fixed-top" ).addClass( "top-nav-collapse" );
		} else {
			$( ".navbar-fixed-top" ).removeClass( "top-nav-collapse" );
		}
	});
    // Closes the Responsive Menu on Menu Item Click
    $('.navbar-collapse ul li a').click(function() {
        $('.navbar-toggle:visible').click();
    });
	// Single Page Nav
	$('.nav li a, .logo').on('click', function(){	
		var el = $(this).attr('href');
		var elWrapped = $(el);		
		scrollToDiv(elWrapped,44);
		return false;	
	});
	function scrollToDiv(element,navheight){	
		var offset = element.offset();
		var offsetTop = offset.top;
		var totalScroll = offsetTop-navheight;
		
		$('body,html').animate({
				scrollTop: totalScroll
		}, 500);
	}
	
	
	/*
	03 - Tooltip
	*/
	$(function () {
	  $('[data-toggle="tooltip"]').tooltip();
	});
	
	
	
	/*
	04 - Carousel ( app screenshots )
	*/
	$(".screens-carousel").owlCarousel({
		items: 1,
		margin: 30,
		startPosition: 3,
		autoplay: true,
		autoplayTimeout: 3000,
		autoplayHoverPause: true,
		loop: true,
		nav:true,
		navText:['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>']
	});
	$("#testimonials-carousel").owlCarousel({
		items: 1,
		autoplay: true,
		autoplayTimeout: 3000,
		autoplayHoverPause: true,
		loop: true,
		dots:true,
		animateOut: 'fadeOut'
	});
	
	
	// restricting certain functionality to desktop only
	// matchMedia() START
	if ( matchMedia('only screen and (min-width: 768px)').matches ) {
	
	
		/*
		05 - Init Parallax
		*/
		$( '.parallax' ).parallaxie({
			speed: 0.5
		});
		
		/*
		06 - Appear Animation on Individual Elements
		*/
		$("html, body").animate({ scrollTop: 2 }, 1);
		$(function() {
			$('.element-to-animate').appear();
			$(document.body).on('appear', '.element-to-animate', function(e, $affected) {
				$affected.each( function(){
					$(this).removeClass().addClass( 'animated element-to-animate ' + $(this).attr( 'data-animation-in' ) );
				});
			});
			/*$(document.body).on('disappear', '.element-to-animate', function(e, $affected) {
				$affected.each( function(){
					$(this).removeClass().addClass( 'animated element-to-animate ' );
				});
			});*/
		});
		
	}// matchMedia() END
	
	
	/*
	07 - Progress ( skills ) Bars
	*/
	$(function() {
		$('.progress-bar').appear();
		$(document.body).on('appear', '.progress-bar', function(e, $affected) {
			var pBar = $(this);
			pBar.each(function(indx){
				$(this).css("width", $(this).attr("aria-valuenow") + "%");
			});			
		});
	});
	
	
	/*
	08 - Popup
	*/
	$('.lightbox').magnificPopup({
		removalDelay: 300, 		
		mainClass: 'mfp-with-zoom'
	});
	
	
	/*
	09 - Mailchimp Settings
	*/
	$('#mailchimp').ajaxChimp({
		callback: mailchimpCallback,
		url: "http://oscodo.us9.list-manage.com/subscribe/post?u=aef5e74&amp;id=f9f9e8db45"
		//replace above url with your own mailchimp post url inside the "".
		//to learn how to get your own URL, please check documentation file.
	});	
	function mailchimpCallback(resp) {
		 if (resp.result === 'success') {
			$('#mailchimp .subscription-success').html('<i class="icon_check_alt2"></i>' + resp.msg).fadeIn(1000);
			$('#mailchimp .subscription-error').fadeOut(500);
			
		} else if(resp.result === 'error') {
			$('#mailchimp .subscription-success').fadeOut(500);
			$('#mailchimp .subscription-error').html('<i class="icon_close_alt2"></i>' + resp.msg).fadeIn(1000);
		}  
	}
	
	
	/*
	10 - Twitter Feed
	*/
	// $('.twitter-feed .tweet').twittie({
	// 	dateFormat: '%b. %d, %Y',
	// 	template: '{{tweet}} <div class="date-user"><a href="{{url}}" class="avatar" title="{{user_name}}">{{avatar}}</a> {{date}}</div>',
	// 	count: 1,
	// 	loadingText: 'Loading!'
	// });
	
	
	
	
	/*
	11 - back to top button
	*/
	var offset = 300,
	offset_opacity = 1200,
	scroll_top_duration = 700,
	$back_to_top = $('.go-top');
	$(window).scroll(function(){
		( $(this).scrollTop() > offset ) ? $back_to_top.addClass('cd-is-visible') : $back_to_top.removeClass('cd-is-visible cd-fade-out');
		if( $(this).scrollTop() > offset_opacity ) { 
			$back_to_top.addClass('cd-fade-out');
		}
	});
	$back_to_top.on('click', function(event){
		event.preventDefault();
		$('body,html').animate({
			scrollTop: 0 ,
		 	}, scroll_top_duration
		);
	});
	
	
	

});
