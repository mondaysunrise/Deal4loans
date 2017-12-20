jQuery(document).ready(function(){
	// Header Search Form
	jQuery('.search-top').click(function(){
		jQuery('#masthead .search-form-top').toggle();
	});
	// Adds right icon to submenu
	jQuery('.menu-primary-container .menu-item-has-children').append('<span class="sub-toggle"> <i class="fa fa-angle-right"></i> </span>');
	// Adds down icon for menu with sub menu
	jQuery('.menu-primary-container .sub-toggle').click(function() {
		jQuery(this).parent('.menu-item-has-children').children('ul.sub-menu').first().slideToggle('1000');
		jQuery(this).children('.fa-angle-right').first().toggleClass('fa-angle-down');
	});
	// Hides the scroll up button initially
	jQuery('#scroll-up').hide();
	// Scroll up settings
	jQuery(window).scroll(function () {
		if (jQuery(this).scrollTop() > 1000) {
			jQuery('#scroll-up').fadeIn();
		} else {
			jQuery('#scroll-up').fadeOut();
		}
	});
	jQuery('a#scroll-up').click(function () {
		jQuery('body,html').animate({
			scrollTop: 0
		}, 800);
		return false;
	});
	// Sticky Menu
	if ( typeof jQuery.fn.sticky !== 'undefined' ) {
		var wpAdminBar = jQuery('#wpadminbar');
		if (wpAdminBar.length) {
			jQuery('#site-navigation').sticky({topSpacing:wpAdminBar.height()});
		} else {
		jQuery('#site-navigation').sticky({topSpacing:0});
		}
	}
	// Tabbed widget
	if ( typeof jQuery.fn.easytabs !== 'undefined' ) {
		jQuery('.tabbed-widget').easytabs();
	}
	// Fitvids setting
	if ( typeof jQuery.fn.fitVids !== 'undefined' ) {
		jQuery('.fitvids-video').fitVids();
	}
	// Magnific Popup Setting
	if ( typeof jQuery.fn.magnificPopup !== 'undefined' ) {
		jQuery('.image-popup').magnificPopup({type: 'image'});
		// Magnific Popup for gallery
		jQuery('.gallery').magnificPopup({
			delegate: 'a',
			type: 'image',
			gallery: { enabled:true }
		});
		// Ticker news popup
		jQuery('.colormag-ticker-news-popup-link').magnificPopup({
			type: 'ajax',
			callbacks: {
				parseAjax: function( mfpResponse ) {
					var setting      = jQuery.magnificPopup.instance,
					content          = jQuery( setting.currItem.el[0] ),
					fragment         = ( content.data( 'fragment' ) );
					mfpResponse.data = jQuery( mfpResponse.data ).find( fragment );
				}
			}
		});
	}
	// Ticker Setting
	/* global colormag_ticker_settings */
	if ( typeof jQuery.fn.newsTicker !== 'undefined' ) {
		// News Ticker Settings at header top
			var breaking_news_slide_effect = colormag_ticker_settings.breaking_news_slide_effect;
			var breaking_news_duration = colormag_ticker_settings.breaking_news_duration;
			var breaking_news_speed = colormag_ticker_settings.breaking_news_speed;

			jQuery('.newsticker').newsTicker({
				row_height: 25,
				max_rows: 1,
				speed: breaking_news_speed,
				direction: breaking_news_slide_effect,
				duration: breaking_news_duration,
				autostart: 1,
				pauseOnHover: 1,
				start: function() {
					jQuery('.newsticker').css('visibility', 'visible');
				}
			});

		// News Ticker in widget
		jQuery('#breaking-news-widget').newsTicker({
			row_height: 100,
			max_rows: 3,
			duration: 4000,
			prevButton: jQuery('#breaking-news-widget-prev'),
			nextButton: jQuery('#breaking-news-widget-next'),
			start: function(){
				jQuery('#breaking-news-widget').css('visibility', 'visible');
			}
		});
	}
	// Ticker Setting
	if ( typeof jQuery.fn.bxSlider !== 'undefined' ) {
		// Category Slider Widget
		jQuery('.widget_slider_area_rotate').bxSlider({
			mode: 'horizontal',
			speed: 1500,
			auto: true,
			pause: 5000,
			adaptiveHeight: true,
			nextText: '<div class="category-slide-next"><i class="fa fa-angle-right"></i></div>',
			prevText: '<div class="category-slide-prev"><i class="fa fa-angle-left"></i></div>',
			pager: false,
			tickerHover: true,
			onSliderLoad: function(){
				jQuery('.widget_slider_area_rotate').css('visibility', 'visible');
				jQuery('.widget_slider_area_rotate').css('height', 'auto');
			}
		});
		// News in Picture/Highlighted Post Area Setting
		jQuery('.widget_block_picture_news .widget_highlighted_post_area').bxSlider({
			minSlides: 1,
			maxSlides: 2,
			slideWidth: 390,
			slideMargin: 20,
			speed: 1500,
			pause: 5000,
			adaptiveHeight: true,
			nextText: '<div class="slide-next"><i class="fa fa-angle-right"></i></div>',
			prevText: '<div class="slide-prev"><i class="fa fa-angle-left"></i></div>',
			pager: false,
			captions: false,
			onSliderLoad: function(){
				jQuery('.widget_block_picture_news .widget_highlighted_post_area').css('visibility', 'visible');
				jQuery('.widget_block_picture_news .widget_highlighted_post_area').css('height', 'auto');
			}
		});
		// Image Slider with pager
		jQuery('.thumbnail-big-sliders').bxSlider({
			pagerCustom: '.thumbnail-slider',
			captions: false,
			nextText: '',
			prevText: '',
			nextSelector: '',
			prevSelector: '',
			onSliderLoad: function(){
				jQuery('.thumbnail-big-sliders').css('visibility', 'visible');
				jQuery('.thumbnail-big-sliders').css('height', 'auto');
			}
		});
		// Ticker image settings
		jQuery('.image-ticker-news').bxSlider({
			minSlides: 5,
			maxSlides: 5,
			slideWidth: 150,
			slideMargin: 12,
			ticker: true,
			speed: 50000,
			tickerHover: true,
			useCSS: false,
			onSliderLoad: function(){
				jQuery('.image-ticker-news').css('visibility', 'visible');
				jQuery('.image-ticker-news').css('height', 'auto');
			}
		});
		// Gallery Post
		jQuery('.blog .gallery-images, .archive .gallery-images, .search .gallery-images, .single-post .gallery-images').bxSlider({
			mode: 'fade',
			speed: 1500,
			auto: true,
			pause: 3000,
			adaptiveHeight: true,
			nextText: '',
			prevText: '',
			nextSelector: '.slide-next',
			prevSelector: '.slide-prev',
			pager: false
		});
	}
});
