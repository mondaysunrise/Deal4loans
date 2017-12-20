<?php
/*=========================================================
*		Shortcodes
========================================================= */
add_filter( 'mom_su/data/shortcodes', 'mom_register_my_custom_shortcode' );
function mom_register_my_custom_shortcode( $shortcodes ) {
	$imgs = MOM_URI . '/framework/shortcodes/images/';
	$ptcats = get_terms("portfolio_category");

	$sidebars = array();
	foreach ( $GLOBALS['wp_registered_sidebars'] as $sidebar ) {
		$sidebars[$sidebar['id']] = $sidebar['name'];
	}
	

	$ads = array();
	$get_e3lanat = get_posts('post_type=ads&posts_per_page=-1');
	foreach ($get_e3lanat as $ad ) {
	    $ads[$ad->ID] = $ad->post_title;
	}

	$vc_formats = array(
		   __('Gallery') => 'gallery',
		   __('Audio') => 'audio',
		   __('Video') => 'video',
		   __('Chat') => 'chat',
	);


$ani = array(
    'bounce'  => 'bounce',
'flash' => 'flash',
'pulse' => 'pulse',
'rubberBand'  => 'rubberBand',
'shake' => 'shake',
'swing' => 'swing',
'tada'  => 'tada',
'wobble'  => 'wobble',
'bounceIn'  => 'bounceIn',
'bounceInDown'  => 'bounceInDown',
'bounceInLeft'  => 'bounceInLeft',
'bounceInRight' => 'bounceInRight',
'bounceInUp'  => 'bounceInUp',
'fadeIn'  => 'fadeIn',
'fadeInDown'  => 'fadeInDown',
'fadeInDownBig' => 'fadeInDownBig',
'fadeInLeft'  => 'fadeInLeft',
'fadeInLeftBig' => 'fadeInLeftBig',
'fadeInRight' => 'fadeInRight',
'fadeInRightBig'  => 'fadeInRightBig',
'fadeInUp'  => 'fadeInUp',
'fadeInUpBig' => 'fadeInUpBig',
'flip'  => 'flip',
'flipInX' => 'flipInX',
'flipInY' => 'flipInY',
'lightSpeedIn'  => 'lightSpeedIn',
'rotateIn'  => 'rotateIn',
'rotateInDownLeft'  => 'rotateInDownLeft',
'rotateInDownRight' => 'rotateInDownRight',
'rotateInUpLeft'  => 'rotateInUpLeft',
'rotateInUpRight' => 'rotateInUpRight',
'slideInDown' => 'slideInDown',
'slideInLeft' => 'slideInLeft',
'slideInRight'  => 'slideInRight',
'hinge' => 'hinge',
'rollIn'  => 'rollIn',  
);



$ani_out = array(
   'bounceOut'  => 'bounceOut',
   'bounceOutDown'  => 'bounceOutDown',
   'bounceOutLeft'  => 'bounceOutLeft',
   'bounceOutRight' => 'bounceOutRight',
   'bounceOutUp'  => 'bounceOutUp',
   'fadeOut'  => 'fadeOut',
   'fadeOutDown'  => 'fadeOutDown',
   'fadeOutDownBig' => 'fadeOutDownBig',
   'fadeOutLeft'  => 'fadeOutLeft',
   'fadeOutLeftBig' => 'fadeOutLeftBig',
   'fadeOutRight' => 'fadeOutRight',
   'fadeOutRightBig'  => 'fadeOutRightBig',
   'fadeOutUp'  => 'fadeOutUp',
   'fadeOutUpBig' => 'fadeOutUpBig',
   'flip'  => 'flip',
   'flipOutX' => 'flipOutX',
   'flipOutY' => 'flipOutY',
   'lightSpeedOut'  => 'lightSpeedOut',
   'rotateOut'  => 'rotateOut',
   'rotateOutDownLeft'  => 'rotateOutDownLeft',
   'rotateOutDownRight' => 'rotateOutDownRight',
   'rotateOutUpLeft'  => 'rotateOutUpLeft',
   'rotateOutUpRight' => 'rotateOutUpRight',
   'slideOutDown' => 'slideOutDown',
   'slideOutLeft' => 'slideOutLeft',
   'slideOutRight'  => 'slideOutRight',
   'rollOut'  => 'rollOut',  
);

	global $of_categories;

/**
		Types : 

			text		:	single value
			textarea	:	single value
			select		:	values => array(
						'key' => __('label', 'theme'),
					),
			bool		:	yes/no
			radio		:	values => array(
						'key' => __('label', 'theme'),
					),
			radio_img	:	values => array(
						'key' => array('imgPath', 'title'),
					),
			upload		:	
			icon 		:
			color 		:
			number 		:  	'min' => 1,
							'max' => 200,

			slider 		:  	'min' => 1,
							'max' => 200,
							'step' => 1

*/

/**
	Feature slider shortcode
*/
					$shortcodes['feature_slider'] = array(
					'name' => __( 'Feature Slider', 'theme' ),
					'type' => 'single', // single, wrap
					'group' => 'content',
					'desc' => __( 'Feature slider shortcode', 'theme' ),
					'icon' => 'newspaper-o',
					//'content' => __( "Click here", 'theme' ),
					'atts' => array(
						'style' => array(
							'type' => 'select',
							'values' => array(
								'new' => __( 'New', 'theme' ),
								'' => __( 'Old', 'theme' ),
							),
							'default' => 'new',
							'name' => __( 'Style', 'theme' ),
						),

						'full_width' => array(
							'type' => 'select',
							'values' => array(
								'no' => __( 'No', 'theme' ),
								'yes' => __( 'Yes', 'theme' ),
							),
							'required' => array('style', 'new'),
							'default' => '',
							'name' => __( 'Full width slider', 'theme' ),
						),

						'no_spaces' => array(
							'type' => 'select',
							'values' => array(
								'no' => __( 'No', 'theme' ),
								'yes' => __( 'Yes', 'theme' ),
							),
							'required' => array('style', 'new'),
							'default' => '',
							'name' => __( 'No spaces in the slider', 'theme' ),
						),

						'display' => array(
							'type' => 'select',
							'values' => array(
									'' => __('Latest Posts', 'theme'),
									'category' => __('Category', 'theme'),
									'tag' => __('Tag', 'theme'),
							),
							'default' => '',
							'name' => __( 'Display', 'theme' ),
						),

						'category' => array(
							'type' => 'select',
							'name' => __( 'Category', 'theme' ),
							'default' => '',
							'required' => array('display', 'category'),
							'values' => array( "Select a Category" => '' ) + $of_categories,
						),						

						'tag' => array(
							'type' => 'text',
							'name' => __( 'Tag ID', 'theme' ),
							'default' => '',
							'required' => array('display', 'tag'),
						),						

						'exclude_categories' => array(
							'type' => 'text',
							'name' => __( 'Exclude Categories', 'theme' ),
							'default' => '',
							'desc' => __('Saperate each category id with comma ex: 1,5,7', 'theme'),
						),						

						'count' => array(
							'type' => 'text',
							'name' => __( 'Number of posts', 'theme' ),
							'default' => '',
							'desc' => __('-1 for all posts', 'theme'),
						),						

						'orderby' => array(
							'type' => 'select',
							'name' => __( 'order by', 'theme' ),
							'default' => '',
							'values' => array(
								'' => __("Recent", 'theme'),
								'popular' => __("Popular", 'theme'),
								'random' => __("Random", 'theme'),
							),
						),

  'caption' => array(
         "type" => "select",
         "name" => __("Caption", 'theme'),
         "values" => array(
			  'on'     =>  __("ON", 'theme'),
			  'off'    =>  __("OFF", 'theme'),
			  ),
      ),
      'caption_style' => array(
         "type" => "select",
         "name" => __("Caption Style", 'theme'),
         "values" => array(
			  ''    =>  __("Default", 'theme'),
			  2     =>  __("Alt", 'theme'),
			  ),
      ),
            
      'caption_length' => array(
         "type" => "text",
         "name" => __("Caption Length", 'theme'),
         "description" => __('characters length default is 110', 'theme')
      ),
      'caption_title_size' => array(
         "type" => "text",
         "name" => __("Post Title font size", 'theme'),
         "description" => __('in pixels ex: 20px', 'theme')
      ),
          
      'caption_text_size' => array(
         "type" => "text",
         "name" => __("Caption text font size", 'theme'),
         "description" => __('in pixels ex: 14px', 'theme')
      ),
          
        'nav' => array(
         "type" => "select",
         "name" => __("Navigation", 'theme'),
         "values" => array(
			  'bullets'   =>  __("Bullets", 'theme'),
			  'thumbs'    =>  __("Thumbs", 'theme'),
			  'numbers'   =>  __("Numbers", 'theme'),
	    ),
      ),
      'arrows' => array(
         "type" => "select",
         "name" => __("Arrows", 'theme'),
         "values" => array(
			  'off'    =>  __("OFF", 'theme'),
			  'on'     =>  __("ON", 'theme'),
			  ),
      ),	
      'items' => array(
         "type" => "text",
         "name" => __("Number of thumbnails", 'theme'),
         "description" => __('default is 6', 'theme')
      ),

// new style animation
      'animation_new' => array(
         "type" => "select",
         "name" => __("Animation", 'framework'),
         "required" => array("style", 'new'),
         "description" => __('post excerpt length in characters leave empty for default values', 'framework'),
         "values" => array(
      'Fade' => 'fade',
      'Slide' => 'slide',
      'Flip' => 'flip',
      'Custom Animation' => 'custom',
      ),
      ),

      'animation_out' => array(
         "type" => "select",
         "name" => __("Animation Out", 'framework'),
         "required" => array("animation_new", 'custom'),
         "description" => __('slider item out animation', 'framework'),
         "values" => $ani_out
      ),
      
      'animation_in' => array(
         "type" => "select",
         "name" => __("Animation In", 'framework'),
         "required" => array("animation_new", 'custom'),
         "description" => __('slider item in animation', 'framework'),
         "values" => $ani
      ),


      'autoplay' => array(
         "type" => "select",
         "name" => __("Auto Play", 'framework'),
         "values" => array(
    'Yes' => 'yes',
    'No' => 'no'
   )
      ),
//end new style animation
        'animation' => array(
         "type" => "select",
         "name" => __("Animation", 'theme'),
         "values" => array(
			  'crossfade'    =>  __("crossfade", 'theme'),
			  'scroll'    =>  __("scroll", 'theme'),
			  'directscroll'    =>  __("directscroll", 'theme'),
			  'fade'   =>  __("fade", 'theme'),
			  'cover'     =>  __("cover", 'theme'),
			  'cover-fade'   =>  __("cover-fade", 'theme'),
			  'uncover'   =>  __("uncover", 'theme'),
			  'uncover-fade'    =>  __("uncover-fade", 'theme'),
	    ),
                 "required" => array("style", ''),

      ),      
        'easing' => array(
         "type" => "select",
         "name" => __("Easing", 'theme'),
         "values" => array(
	'easeInOutCubic'   =>  __('easeInOutCubic', 'theme'),
	'jswing'     =>  __('jswing', 'theme'),
	'def'     =>  __('def', 'theme'),
	'easeInQuad'    =>  __('easeInQuad', 'theme'),
	'easeOutQuad'   =>  __('easeOutQuad', 'theme'),
	'easeInOutQuad'    =>  __('easeInOutQuad', 'theme'),
	'easeInCubic'   =>  __('easeInCubic', 'theme'),
	'easeOutCubic'     =>  __('easeOutCubic', 'theme'),
	'easeInQuart'   =>  __('easeInQuart', 'theme'),
	'easeOutQuart'     =>  __('easeOutQuart', 'theme'),
	'easeInOutQuart'   =>  __('easeInOutQuart', 'theme'),
	'easeInQuint'   =>  __('easeInQuint', 'theme'),
	'easeOutQuint'     =>  __('easeOutQuint', 'theme'),
	'easeInOutQuint'   =>  __('easeInOutQuint', 'theme'),
	'easeInSine'    =>  __('easeInSine', 'theme'),
	'easeOutSine'   =>  __('easeOutSine', 'theme'),
	'easeInOutSine'    =>  __('easeInOutSine', 'theme'),
	'easeInExpo'    =>  __('easeInExpo', 'theme'),
	'easeOutExpo'   =>  __('easeOutExpo', 'theme'),
	'easeInOutExpo'    =>  __('easeInOutExpo', 'theme'),
	'easeInCirc'    =>  __('easeInCirc', 'theme'),
	'easeOutCirc'   =>  __('easeOutCirc', 'theme'),
	'easeInOutCirc'    =>  __('easeInOutCirc', 'theme'),
	'easeInElastic'    =>  __('easeInElastic', 'theme'),
	'easeOutElastic'   =>  __('easeOutElastic', 'theme'),
	'easeInOutElastic'    =>  __('easeInOutElastic', 'theme'),
	'easeInBack'    =>  __('easeInBack', 'theme'),
	'easeOutBack'   =>  __('easeOutBack', 'theme'),
	'easeInOutBack'    =>  __('easeInOutBack', 'theme'),
	'easeInBounce'     =>  __('easeInBounce', 'theme'),
	'easeOutBounce'    =>  __('easeOutBounce', 'theme'),
	'easeInOutBounce'     =>  __('easeInOutBounce', 'theme'),
    ),
                 "required" => array("style", ''),

      ),
      'speed' => array(
         "type" => "text",
         "name" => __("Animation Speed", 'theme'),
                 "required" => array("style", ''),
           "description" => __('in ms, default is 600', 'theme')
      ),	

      'timeout' => array(
         "type" => "text",
         "name" => __("Timeout", 'theme'),
         "description" => __('the time between each slide in ms, default 4000 = 4 seconds', 'theme')
      ),
      
       'post_type' => array(
         "type" => "text",
         "name" => __("Custom post type", 'framework'),
         "description" => __('Advanced: you can use this option to get posts from custom post types, if you set this to anything the category and tags options not working', 'framework')
      ),

						'class' => array(
							'default' => '',
							'name' => __( 'Class', 'theme' ),
							'desc' => __( 'Extra CSS class', 'theme' )
						)				
				),
	);

	// Return modified data
	return $shortcodes;
}

/*=========================================================
*		Groups
========================================================= */

add_filter( 'mom_su/data/groups', 'mom_my_custom_groups' );

function mom_my_custom_groups ($groups) {
	unset( $groups['data']);
	unset( $groups['box']);
	$groups['shop'] = __('Shop', 'theme');
	return $groups;

}
/*=========================================================
*		Icons
========================================================= */
add_filter( 'mom_su/data/icons', 'mom_my_custom_icons' );

function mom_my_custom_icons ($icons) {
	$icons = array('momizat-icon-home','momizat-icon-home2','momizat-icon-home3','momizat-icon-office','momizat-icon-newspaper','momizat-icon-pencil','momizat-icon-pencil2','momizat-icon-quill','momizat-icon-pen','momizat-icon-blog','momizat-icon-droplet','momizat-icon-paint-format','momizat-icon-image','momizat-icon-image2','momizat-icon-images','momizat-icon-camera','momizat-icon-music','momizat-icon-headphones','momizat-icon-play','momizat-icon-film','momizat-icon-camera2','momizat-icon-dice','momizat-icon-pacman','momizat-icon-spades','momizat-icon-clubs','momizat-icon-diamonds','momizat-icon-pawn','momizat-icon-bullhorn','momizat-icon-connection','momizat-icon-podcast','momizat-icon-feed','momizat-icon-book','momizat-icon-books','momizat-icon-library','momizat-icon-file','momizat-icon-profile','momizat-icon-file2','momizat-icon-file3','momizat-icon-file4','momizat-icon-copy','momizat-icon-copy2','momizat-icon-copy3','momizat-icon-paste','momizat-icon-paste2','momizat-icon-paste3','momizat-icon-stack','momizat-icon-folder','momizat-icon-folder-open','momizat-icon-tag','momizat-icon-tags','momizat-icon-barcode','momizat-icon-qrcode','momizat-icon-ticket','momizat-icon-cart','momizat-icon-cart2','momizat-icon-cart3','momizat-icon-coin','momizat-icon-credit','momizat-icon-calculate','momizat-icon-support','momizat-icon-phone','momizat-icon-phone-hang-up','momizat-icon-address-book','momizat-icon-notebook','momizat-icon-envelope','momizat-icon-pushpin','momizat-icon-location','momizat-icon-location2','momizat-icon-compass','momizat-icon-map','momizat-icon-map2','momizat-icon-history','momizat-icon-clock','momizat-icon-clock2','momizat-icon-alarm','momizat-icon-alarm2','momizat-icon-bell','momizat-icon-stopwatch','momizat-icon-calendar','momizat-icon-calendar2','momizat-icon-print','momizat-icon-keyboard','momizat-icon-screen','momizat-icon-laptop','momizat-icon-mobile','momizat-icon-mobile2','momizat-icon-tablet','momizat-icon-tv','momizat-icon-cabinet','momizat-icon-drawer','momizat-icon-drawer2','momizat-icon-drawer3','momizat-icon-box-add','momizat-icon-box-remove','momizat-icon-download','momizat-icon-upload','momizat-icon-disk','momizat-icon-storage','momizat-icon-undo','momizat-icon-redo','momizat-icon-flip','momizat-icon-flip2','momizat-icon-undo2','momizat-icon-redo2','momizat-icon-forward','momizat-icon-reply','momizat-icon-bubble','momizat-icon-bubbles','momizat-icon-bubbles2','momizat-icon-bubble2','momizat-icon-bubbles3','momizat-icon-bubbles4','momizat-icon-user','momizat-icon-users','momizat-icon-user2','momizat-icon-users2','momizat-icon-user3','momizat-icon-user4','momizat-icon-quotes-left','momizat-icon-busy','momizat-icon-spinner','momizat-icon-spinner2','momizat-icon-spinner3','momizat-icon-spinner4','momizat-icon-spinner5','momizat-icon-spinner6','momizat-icon-binoculars','momizat-icon-search','momizat-icon-zoom-in','momizat-icon-zoom-out','momizat-icon-expand','momizat-icon-contract','momizat-icon-expand2','momizat-icon-contract2','momizat-icon-key','momizat-icon-key2','momizat-icon-lock','momizat-icon-lock2','momizat-icon-unlocked','momizat-icon-wrench','momizat-icon-settings','momizat-icon-equalizer','momizat-icon-cog','momizat-icon-cogs','momizat-icon-cog2','momizat-icon-hammer','momizat-icon-wand','momizat-icon-aid','momizat-icon-bug','momizat-icon-pie','momizat-icon-stats','momizat-icon-bars','momizat-icon-bars2','momizat-icon-gift','momizat-icon-trophy','momizat-icon-glass','momizat-icon-mug','momizat-icon-food','momizat-icon-leaf','momizat-icon-rocket','momizat-icon-meter','momizat-icon-meter2','momizat-icon-dashboard','momizat-icon-hammer2','momizat-icon-fire','momizat-icon-lab','momizat-icon-magnet','momizat-icon-remove','momizat-icon-remove2','momizat-icon-briefcase','momizat-icon-airplane','momizat-icon-truck','momizat-icon-road','momizat-icon-accessibility','momizat-icon-target','momizat-icon-shield','momizat-icon-lightning','momizat-icon-switch','momizat-icon-power-cord','momizat-icon-signup','momizat-icon-list','momizat-icon-list2','momizat-icon-numbered-list','momizat-icon-menu','momizat-icon-menu2','momizat-icon-tree','momizat-icon-cloud','momizat-icon-cloud-download','momizat-icon-cloud-upload','momizat-icon-download2','momizat-icon-upload2','momizat-icon-download3','momizat-icon-upload3','momizat-icon-globe','momizat-icon-earth','momizat-icon-link','momizat-icon-flag','momizat-icon-attachment','momizat-icon-eye','momizat-icon-eye-blocked','momizat-icon-eye2','momizat-icon-bookmark','momizat-icon-bookmarks','momizat-icon-brightness-medium','momizat-icon-brightness-contrast','momizat-icon-contrast','momizat-icon-star','momizat-icon-star2','momizat-icon-star3','momizat-icon-heart','momizat-icon-heart2','momizat-icon-heart-broken','momizat-icon-thumbs-up','momizat-icon-thumbs-up2','momizat-icon-happy','momizat-icon-happy2','momizat-icon-smiley','momizat-icon-smiley2','momizat-icon-tongue','momizat-icon-tongue2','momizat-icon-sad','momizat-icon-sad2','momizat-icon-wink','momizat-icon-wink2','momizat-icon-grin','momizat-icon-grin2','momizat-icon-cool','momizat-icon-cool2','momizat-icon-angry','momizat-icon-angry2','momizat-icon-evil','momizat-icon-evil2','momizat-icon-shocked','momizat-icon-shocked2','momizat-icon-confused','momizat-icon-confused2','momizat-icon-neutral','momizat-icon-neutral2','momizat-icon-wondering','momizat-icon-wondering2','momizat-icon-point-up','momizat-icon-point-right','momizat-icon-point-down','momizat-icon-point-left','momizat-icon-warning','momizat-icon-notification','momizat-icon-question','momizat-icon-info','momizat-icon-info2','momizat-icon-blocked','momizat-icon-cancel-circle','momizat-icon-checkmark-circle','momizat-icon-spam','momizat-icon-close','momizat-icon-checkmark','momizat-icon-checkmark2','momizat-icon-spell-check','momizat-icon-minus','momizat-icon-plus','momizat-icon-enter','momizat-icon-exit','momizat-icon-play2','momizat-icon-pause','momizat-icon-stop','momizat-icon-backward','momizat-icon-forward2','momizat-icon-play3','momizat-icon-pause2','momizat-icon-stop2','momizat-icon-backward2','momizat-icon-forward3','momizat-icon-first','momizat-icon-last','momizat-icon-previous','momizat-icon-next','momizat-icon-eject','momizat-icon-volume-high','momizat-icon-volume-medium','momizat-icon-volume-low','momizat-icon-volume-mute','momizat-icon-volume-mute2','momizat-icon-volume-increase','momizat-icon-volume-decrease','momizat-icon-loop','momizat-icon-loop2','momizat-icon-loop3','momizat-icon-shuffle','momizat-icon-arrow-up-left','momizat-icon-arrow-up','momizat-icon-arrow-up-right','momizat-icon-arrow-right','momizat-icon-arrow-down-right','momizat-icon-arrow-down','momizat-icon-arrow-down-left','momizat-icon-arrow-left','momizat-icon-arrow-up-left2','momizat-icon-arrow-up2','momizat-icon-arrow-up-right2','momizat-icon-arrow-right2','momizat-icon-arrow-down-right2','momizat-icon-arrow-down2','momizat-icon-arrow-down-left2','momizat-icon-arrow-left2','momizat-icon-arrow-up-left3','momizat-icon-arrow-up3','momizat-icon-arrow-up-right3','momizat-icon-arrow-right3','momizat-icon-arrow-down-right3','momizat-icon-arrow-down3','momizat-icon-arrow-down-left3','momizat-icon-arrow-left3','momizat-icon-tab','momizat-icon-checkbox-checked','momizat-icon-checkbox-unchecked','momizat-icon-checkbox-partial','momizat-icon-radio-checked','momizat-icon-radio-unchecked','momizat-icon-crop','momizat-icon-scissors','momizat-icon-filter','momizat-icon-filter2','momizat-icon-font','momizat-icon-text-height','momizat-icon-text-width','momizat-icon-bold','momizat-icon-underline','momizat-icon-italic','momizat-icon-strikethrough','momizat-icon-omega','momizat-icon-sigma','momizat-icon-table','momizat-icon-table2','momizat-icon-insert-template','momizat-icon-pilcrow','momizat-icon-left-toright','momizat-icon-right-toleft','momizat-icon-paragraph-left','momizat-icon-paragraph-center','momizat-icon-paragraph-right','momizat-icon-paragraph-justify','momizat-icon-paragraph-left2','momizat-icon-paragraph-center2','momizat-icon-paragraph-right2','momizat-icon-paragraph-justify2','momizat-icon-indent-increase','momizat-icon-indent-decrease','momizat-icon-new-tab','momizat-icon-embed','momizat-icon-code','momizat-icon-console','momizat-icon-share','momizat-icon-mail','momizat-icon-mail2','momizat-icon-mail3','momizat-icon-mail4','momizat-icon-google','momizat-icon-google-plus','momizat-icon-google-plus2','momizat-icon-google-plus3','momizat-icon-google-plus4','momizat-icon-google-drive','momizat-icon-facebook','momizat-icon-facebook2','momizat-icon-facebook3','momizat-icon-instagram','momizat-icon-twitter','momizat-icon-twitter2','momizat-icon-twitter3','momizat-icon-feed2','momizat-icon-feed3','momizat-icon-feed4','momizat-icon-youtube','momizat-icon-youtube2','momizat-icon-vimeo','momizat-icon-vimeo2','momizat-icon-vimeo3','momizat-icon-lanyrd','momizat-icon-flickr','momizat-icon-flickr2','momizat-icon-flickr3','momizat-icon-flickr4','momizat-icon-picassa','momizat-icon-picassa2','momizat-icon-dribbble','momizat-icon-dribbble2','momizat-icon-dribbble3','momizat-icon-forrst','momizat-icon-forrst2','momizat-icon-deviantart','momizat-icon-deviantart2','momizat-icon-steam','momizat-icon-steam2','momizat-icon-github','momizat-icon-github2','momizat-icon-github3','momizat-icon-github4','momizat-icon-github5','momizat-icon-wordpress','momizat-icon-wordpress2','momizat-icon-joomla','momizat-icon-blogger','momizat-icon-blogger2','momizat-icon-tumblr','momizat-icon-tumblr2','momizat-icon-yahoo','momizat-icon-tux','momizat-icon-apple','momizat-icon-finder','momizat-icon-android','momizat-icon-windows','momizat-icon-windows8','momizat-icon-soundcloud','momizat-icon-soundcloud2','momizat-icon-skype','momizat-icon-reddit','momizat-icon-linkedin','momizat-icon-lastfm','momizat-icon-lastfm2','momizat-icon-delicious','momizat-icon-stumbleupon','momizat-icon-stumbleupon2','momizat-icon-stackoverflow','momizat-icon-pinterest','momizat-icon-pinterest2','momizat-icon-xing','momizat-icon-xing2','momizat-icon-flattr','momizat-icon-foursquare','momizat-icon-foursquare2','momizat-icon-paypal','momizat-icon-paypal2','momizat-icon-paypal3','momizat-icon-yelp','momizat-icon-libreoffice','momizat-icon-file-pdf','momizat-icon-file-openoffice','momizat-icon-file-word','momizat-icon-file-excel','momizat-icon-file-zip','momizat-icon-file-powerpoint','momizat-icon-file-xml','momizat-icon-file-css','momizat-icon-html5','momizat-icon-html52','momizat-icon-css3','momizat-icon-chrome','momizat-icon-firefox','momizat-icon-IE','momizat-icon-opera','momizat-icon-safari','brankic-icon-number','brankic-icon-number2','brankic-icon-number3','brankic-icon-number4','brankic-icon-number5','brankic-icon-number6','brankic-icon-number7','brankic-icon-number8','brankic-icon-number9','brankic-icon-number10','brankic-icon-number11','brankic-icon-number12','brankic-icon-number13','brankic-icon-number14','brankic-icon-number15','brankic-icon-number16','brankic-icon-number17','brankic-icon-number18','brankic-icon-number19','brankic-icon-number20','brankic-icon-quote','brankic-icon-quote2','brankic-icon-tag','brankic-icon-tag2','brankic-icon-link','brankic-icon-link2','brankic-icon-cabinet','brankic-icon-cabinet2','brankic-icon-calendar','brankic-icon-calendar2','brankic-icon-calendar3','brankic-icon-file','brankic-icon-file2','brankic-icon-file3','brankic-icon-files','brankic-icon-phone','brankic-icon-tablet','brankic-icon-window','brankic-icon-monitor','brankic-icon-ipod','brankic-icon-tv','brankic-icon-camera','brankic-icon-camera2','brankic-icon-camera3','brankic-icon-film','brankic-icon-film2','brankic-icon-film3','brankic-icon-microphone','brankic-icon-microphone2','brankic-icon-microphone3','brankic-icon-drink','brankic-icon-drink2','brankic-icon-drink3','brankic-icon-drink4','brankic-icon-coffee','brankic-icon-mug','brankic-icon-ice-cream','brankic-icon-cake','brankic-icon-inbox','brankic-icon-download','brankic-icon-upload','brankic-icon-inbox2','brankic-icon-checkmark','brankic-icon-checkmark2','brankic-icon-cancel','brankic-icon-cancel2','brankic-icon-plus','brankic-icon-plus2','brankic-icon-minus','brankic-icon-minus2','brankic-icon-notice','brankic-icon-notice2','brankic-icon-cog','brankic-icon-cogs','brankic-icon-cog2','brankic-icon-warning','brankic-icon-health','brankic-icon-suitcase','brankic-icon-suitcase2','brankic-icon-suitcase3','brankic-icon-picture','brankic-icon-pictures','brankic-icon-pictures2','brankic-icon-android','brankic-icon-marvin','brankic-icon-pacman','brankic-icon-cassette','brankic-icon-watch','brankic-icon-chronometer','brankic-icon-watch2','brankic-icon-alarm-clock','brankic-icon-time','brankic-icon-time2','brankic-icon-headphones','brankic-icon-wallet','brankic-icon-checkmark3','brankic-icon-cancel3','brankic-icon-eye','brankic-icon-position','brankic-icon-site-map','brankic-icon-site-map2','brankic-icon-cloud','brankic-icon-upload2','brankic-icon-chart','brankic-icon-chart2','brankic-icon-chart3','brankic-icon-chart4','brankic-icon-chart5','brankic-icon-chart6','brankic-icon-location','brankic-icon-download2','brankic-icon-basket','brankic-icon-folder','brankic-icon-gamepad','brankic-icon-alarm','brankic-icon-alarm-cancel','brankic-icon-phone2','brankic-icon-phone3','brankic-icon-image','brankic-icon-open','brankic-icon-sale','brankic-icon-direction','brankic-icon-map','brankic-icon-trashcan','brankic-icon-vote','brankic-icon-graduate','brankic-icon-lab','brankic-icon-tie','brankic-icon-football','brankic-icon-eight-ball','brankic-icon-bowling','brankic-icon-bowling-pin','brankic-icon-baseball','brankic-icon-soccer','brankic-icon-3d-glasses','brankic-icon-microwave','brankic-icon-refrigerator','brankic-icon-oven','brankic-icon-washing-machine','brankic-icon-mouse','brankic-icon-smiley','brankic-icon-sad','brankic-icon-mute','brankic-icon-hand','brankic-icon-radio','brankic-icon-satellite','brankic-icon-medal','brankic-icon-medal2','brankic-icon-switch','brankic-icon-key','brankic-icon-cord','brankic-icon-locked','brankic-icon-unlocked','brankic-icon-locked2','brankic-icon-unlocked2','brankic-icon-magnifier','brankic-icon-zoom-in','brankic-icon-zoom-out','brankic-icon-stack','brankic-icon-stack2','brankic-icon-stack3','brankic-icon-moon-andstar','brankic-icon-transformers','brankic-icon-batman','brankic-icon-space-invaders','brankic-icon-skeletor','brankic-icon-lamp','brankic-icon-lamp2','brankic-icon-umbrella','brankic-icon-street-light','brankic-icon-bomb','brankic-icon-archive','brankic-icon-battery','brankic-icon-battery2','brankic-icon-battery3','brankic-icon-battery4','brankic-icon-battery5','brankic-icon-megaphone','brankic-icon-megaphone2','brankic-icon-patch','brankic-icon-pil','brankic-icon-injection','brankic-icon-thermometer','brankic-icon-lamp3','brankic-icon-lamp4','brankic-icon-lamp5','brankic-icon-cube','brankic-icon-box','brankic-icon-box2','brankic-icon-diamond','brankic-icon-bag','brankic-icon-money-bag','brankic-icon-grid','brankic-icon-grid2','brankic-icon-list','brankic-icon-list2','brankic-icon-ruler','brankic-icon-ruler2','brankic-icon-layout','brankic-icon-layout2','brankic-icon-layout3','brankic-icon-layout4','brankic-icon-layout5','brankic-icon-layout6','brankic-icon-layout7','brankic-icon-layout8','brankic-icon-layout9','brankic-icon-layout10','brankic-icon-layout11','brankic-icon-layout12','brankic-icon-layout13','brankic-icon-layout14','brankic-icon-tools','brankic-icon-screwdriver','brankic-icon-paint','brankic-icon-hammer','brankic-icon-brush','brankic-icon-pen','brankic-icon-chat','brankic-icon-comments','brankic-icon-chat2','brankic-icon-chat3','brankic-icon-volume','brankic-icon-volume2','brankic-icon-volume3','brankic-icon-equalizer','brankic-icon-resize','brankic-icon-resize2','brankic-icon-stretch','brankic-icon-narrow','brankic-icon-resize3','brankic-icon-download3','brankic-icon-calculator','brankic-icon-library','brankic-icon-auction','brankic-icon-justice','brankic-icon-stats','brankic-icon-stats2','brankic-icon-attachment','brankic-icon-hourglass','brankic-icon-abacus','brankic-icon-pencil','brankic-icon-pen2','brankic-icon-pin','brankic-icon-pin2','brankic-icon-discout','brankic-icon-edit','brankic-icon-scissors','brankic-icon-profile','brankic-icon-profile2','brankic-icon-profile3','brankic-icon-rotate','brankic-icon-rotate2','brankic-icon-reply','brankic-icon-forward','brankic-icon-retweet','brankic-icon-shuffle','brankic-icon-loop','brankic-icon-crop','brankic-icon-square','brankic-icon-square2','brankic-icon-circle','brankic-icon-dollar','brankic-icon-dollar2','brankic-icon-coins','brankic-icon-pig','brankic-icon-bookmark','brankic-icon-bookmark2','brankic-icon-address-book','brankic-icon-address-book2','brankic-icon-safe','brankic-icon-envelope','brankic-icon-envelope2','brankic-icon-radio-active','brankic-icon-music','brankic-icon-presentation','brankic-icon-male','brankic-icon-female','brankic-icon-aids','brankic-icon-heart','brankic-icon-info','brankic-icon-info2','brankic-icon-piano','brankic-icon-rain','brankic-icon-snow','brankic-icon-lightning','brankic-icon-sun','brankic-icon-moon','brankic-icon-cloudy','brankic-icon-cloudy2','brankic-icon-car','brankic-icon-bike','brankic-icon-truck','brankic-icon-bus','brankic-icon-bike2','brankic-icon-plane','brankic-icon-paper-plane','brankic-icon-rocket','brankic-icon-book','brankic-icon-book2','brankic-icon-barcode','brankic-icon-barcode2','brankic-icon-expand','brankic-icon-collapse','brankic-icon-pop-out','brankic-icon-pop-in','brankic-icon-target','brankic-icon-badge','brankic-icon-badge2','brankic-icon-ticket','brankic-icon-ticket2','brankic-icon-ticket3','brankic-icon-microphone4','brankic-icon-cone','brankic-icon-blocked','brankic-icon-stop','brankic-icon-keyboard','brankic-icon-keyboard2','brankic-icon-radio2','brankic-icon-printer','brankic-icon-checked','brankic-icon-error','brankic-icon-add','brankic-icon-minus3','brankic-icon-alert','brankic-icon-pictures3','brankic-icon-atom','brankic-icon-eyedropper','brankic-icon-globe','brankic-icon-globe2','brankic-icon-shipping','brankic-icon-ying-yang','brankic-icon-compass','brankic-icon-zip','brankic-icon-zip2','brankic-icon-anchor','brankic-icon-locked-heart','brankic-icon-magnet','brankic-icon-navigation','brankic-icon-tags','brankic-icon-heart2','brankic-icon-heart3','brankic-icon-usb','brankic-icon-clipboard','brankic-icon-clipboard2','brankic-icon-clipboard3','brankic-icon-switch2','brankic-icon-ruler3','enotype-icon-phone','enotype-icon-mobile','enotype-icon-mouse','enotype-icon-directions','enotype-icon-mail','enotype-icon-paperplane','enotype-icon-pencil','enotype-icon-feather','enotype-icon-paperclip','enotype-icon-drawer','enotype-icon-reply','enotype-icon-reply-all','enotype-icon-forward','enotype-icon-user','enotype-icon-users','enotype-icon-user-add','enotype-icon-vcard','enotype-icon-export','enotype-icon-location','enotype-icon-map','enotype-icon-compass','enotype-icon-location2','enotype-icon-target','enotype-icon-share','enotype-icon-sharable','enotype-icon-heart','enotype-icon-heart2','enotype-icon-star','enotype-icon-star2','enotype-icon-thumbs-up','enotype-icon-thumbs-down','enotype-icon-chat','enotype-icon-comment','enotype-icon-quote','enotype-icon-house','enotype-icon-popup','enotype-icon-search','enotype-icon-flashlight','enotype-icon-printer','enotype-icon-bell','enotype-icon-link','enotype-icon-flag','enotype-icon-cog','enotype-icon-tools','enotype-icon-trophy','enotype-icon-tag','enotype-icon-camera','enotype-icon-megaphone','enotype-icon-moon','enotype-icon-palette','enotype-icon-leaf','enotype-icon-music','enotype-icon-music2','enotype-icon-new','enotype-icon-graduation','enotype-icon-book','enotype-icon-newspaper','enotype-icon-bag','enotype-icon-airplane','enotype-icon-lifebuoy','enotype-icon-eye','enotype-icon-clock','enotype-icon-microphone','enotype-icon-calendar','enotype-icon-bolt','enotype-icon-thunder','enotype-icon-droplet','enotype-icon-cd','enotype-icon-briefcase','enotype-icon-air','enotype-icon-hourglass','enotype-icon-gauge','enotype-icon-language','enotype-icon-network','enotype-icon-key','enotype-icon-battery','enotype-icon-bucket','enotype-icon-magnet','enotype-icon-drive','enotype-icon-cup','enotype-icon-rocket','enotype-icon-brush','enotype-icon-suitcase','enotype-icon-cone','enotype-icon-earth','enotype-icon-keyboard','enotype-icon-browser','enotype-icon-publish','enotype-icon-progress-3','enotype-icon-progress-2','enotype-icon-brogress-1','enotype-icon-progress-0','enotype-icon-sun','enotype-icon-sun2','enotype-icon-adjust','enotype-icon-code','enotype-icon-screen','enotype-icon-infinity','enotype-icon-light-bulb','enotype-icon-credit-card','enotype-icon-database','enotype-icon-voicemail','enotype-icon-clipboard','enotype-icon-cart','enotype-icon-box','enotype-icon-ticket','enotype-icon-rss','enotype-icon-signal','enotype-icon-thermometer','enotype-icon-droplets','enotype-icon-uniE66E','enotype-icon-statistics','enotype-icon-pie','enotype-icon-bars','enotype-icon-graph','enotype-icon-lock','enotype-icon-lock-open','enotype-icon-logout','enotype-icon-login','enotype-icon-checkmark','enotype-icon-cross','enotype-icon-minus','enotype-icon-plus','enotype-icon-cross2','enotype-icon-minus2','enotype-icon-plus2','enotype-icon-cross3','enotype-icon-minus3','enotype-icon-plus3','enotype-icon-erase','enotype-icon-blocked','enotype-icon-info','enotype-icon-info2','enotype-icon-question','enotype-icon-help','enotype-icon-warning','enotype-icon-cycle','enotype-icon-cw','enotype-icon-ccw','enotype-icon-shuffle','enotype-icon-arrow','enotype-icon-arrow2','enotype-icon-retweet','enotype-icon-loop','enotype-icon-history','enotype-icon-back','enotype-icon-switch','enotype-icon-list','enotype-icon-add-to-list','enotype-icon-layout','enotype-icon-list2','enotype-icon-text','enotype-icon-text2','enotype-icon-document','enotype-icon-docs','enotype-icon-landscape','enotype-icon-pictures','enotype-icon-video','enotype-icon-music3','enotype-icon-folder','enotype-icon-archive','enotype-icon-trash','enotype-icon-upload','enotype-icon-download','enotype-icon-disk','enotype-icon-install','enotype-icon-cloud','enotype-icon-upload2','enotype-icon-bookmark','enotype-icon-bookmarks','enotype-icon-book2','enotype-icon-play','enotype-icon-pause','enotype-icon-record','enotype-icon-stop','enotype-icon-next','enotype-icon-previous','enotype-icon-first','enotype-icon-last','enotype-icon-resize-enlarge','enotype-icon-resize-shrink','enotype-icon-volume','enotype-icon-sound','enotype-icon-mute','enotype-icon-flow-cascade','enotype-icon-flow-branch','enotype-icon-flow-tree','enotype-icon-flow-line','enotype-icon-flow-parallel','enotype-icon-arrow-left','enotype-icon-arrow-down','enotype-icon-arrow-up--upload','enotype-icon-arrow-right','enotype-icon-arrow-left2','enotype-icon-arrow-down2','enotype-icon-arrow-up','enotype-icon-arrow-right2','enotype-icon-arrow-left3','enotype-icon-arrow-down3','enotype-icon-arrow-up2','enotype-icon-arrow-right3','enotype-icon-arrow-left4','enotype-icon-arrow-down4','enotype-icon-arrow-up3','enotype-icon-arrow-right4','enotype-icon-arrow-left5','enotype-icon-arrow-down5','enotype-icon-arrow-up4','enotype-icon-arrow-right5','enotype-icon-arrow-left6','enotype-icon-arrow-down6','enotype-icon-arrow-up5','enotype-icon-arrow-right6','enotype-icon-arrow-left7','enotype-icon-arrow-down7','enotype-icon-arrow-up6','enotype-icon-uniE6D8','enotype-icon-arrow-left8','enotype-icon-arrow-down8','enotype-icon-arrow-up7','enotype-icon-arrow-right7','enotype-icon-menu','enotype-icon-ellipsis','enotype-icon-dots','enotype-icon-dot','enotype-icon-cc','enotype-icon-cc-by','enotype-icon-cc-nc','enotype-icon-cc-nc-eu','enotype-icon-cc-nc-jp','enotype-icon-cc-sa','enotype-icon-cc-nd','enotype-icon-cc-pd','enotype-icon-cc-zero','enotype-icon-cc-share','enotype-icon-cc-share2','enotype-icon-daniel-bruce','enotype-icon-daniel-bruce2','enotype-icon-github','enotype-icon-github2','enotype-icon-flickr','enotype-icon-flickr2','enotype-icon-vimeo','enotype-icon-vimeo2','enotype-icon-twitter','enotype-icon-twitter2','enotype-icon-facebook','enotype-icon-facebook2','enotype-icon-facebook3','enotype-icon-googleplus','enotype-icon-googleplus2','enotype-icon-pinterest','enotype-icon-pinterest2','enotype-icon-tumblr','enotype-icon-tumblr2','enotype-icon-linkedin','enotype-icon-linkedin2','enotype-icon-dribbble','enotype-icon-dribbble2','enotype-icon-stumbleupon','enotype-icon-stumbleupon2','enotype-icon-lastfm','enotype-icon-lastfm2','enotype-icon-rdio','enotype-icon-rdio2','enotype-icon-spotify','enotype-icon-spotify2','enotype-icon-qq','enotype-icon-instagram','enotype-icon-dropbox','enotype-icon-evernote','enotype-icon-flattr','enotype-icon-skype','enotype-icon-skype2','enotype-icon-renren','enotype-icon-sina-weibo','enotype-icon-paypal','enotype-icon-picasa','enotype-icon-soundcloud','enotype-icon-mixi','enotype-icon-behance','enotype-icon-circles','enotype-icon-vk','enotype-icon-smashing','fa-icon-glass','fa-icon-music','fa-icon-search','fa-icon-envelope','fa-icon-heart','fa-icon-star','fa-icon-star-empty','fa-icon-user','fa-icon-film','fa-icon-th-large','fa-icon-th','fa-icon-th-list','fa-icon-ok','fa-icon-remove','fa-icon-zoom-in','fa-icon-zoom-out','fa-icon-off','fa-icon-signal','fa-icon-cog','fa-icon-trash','fa-icon-home','fa-icon-file','fa-icon-time','fa-icon-road','fa-icon-download-alt','fa-icon-download','fa-icon-upload','fa-icon-inbox','fa-icon-play-circle','fa-icon-repeat','fa-icon-refresh','fa-icon-list-alt','fa-icon-lock','fa-icon-flag','fa-icon-headphones','fa-icon-volume-off','fa-icon-volume-down','fa-icon-volume-up','fa-icon-qrcode','fa-icon-barcode','fa-icon-tag','fa-icon-tags','fa-icon-book','fa-icon-bookmark','fa-icon-print','fa-icon-camera','fa-icon-font','fa-icon-bold','fa-icon-italic','fa-icon-text-height','fa-icon-text-width','fa-icon-align-left','fa-icon-align-center','fa-icon-align-right','fa-icon-align-justify','fa-icon-list','fa-icon-indent-left','fa-icon-indent-right','fa-icon-facetime-video','fa-icon-picture','fa-icon-pencil','fa-icon-map-marker','fa-icon-adjust','fa-icon-tint','fa-icon-edit','fa-icon-share','fa-icon-check','fa-icon-move','fa-icon-step-backward','fa-icon-fast-backward','fa-icon-backward','fa-icon-play','fa-icon-pause','fa-icon-stop','fa-icon-forward','fa-icon-fast-forward','fa-icon-step-forward','fa-icon-eject','fa-icon-chevron-left','fa-icon-chevron-right','fa-icon-plus-sign','fa-icon-minus-sign','fa-icon-remove-sign','fa-icon-ok-sign','fa-icon-question-sign','fa-icon-info-sign','fa-icon-screenshot','fa-icon-remove-circle','fa-icon-ok-circle','fa-icon-ban-circle','fa-icon-arrow-left','fa-icon-arrow-right','fa-icon-arrow-up','fa-icon-arrow-down','fa-icon-share-alt','fa-icon-resize-full','fa-icon-resize-small','fa-icon-plus','fa-icon-minus','fa-icon-asterisk','fa-icon-exclamation-sign','fa-icon-gift','fa-icon-leaf','fa-icon-fire','fa-icon-eye-open','fa-icon-eye-close','fa-icon-warning-sign','fa-icon-plane','fa-icon-calendar','fa-icon-random','fa-icon-comment','fa-icon-magnet','fa-icon-chevron-up','fa-icon-chevron-down','fa-icon-retweet','fa-icon-shopping-cart','fa-icon-folder-close','fa-icon-folder-open','fa-icon-resize-vertical','fa-icon-resize-horizontal','fa-icon-bar-chart','fa-icon-twitter-sign','fa-icon-facebook-sign','fa-icon-camera-retro','fa-icon-key','fa-icon-cogs','fa-icon-comments','fa-icon-thumbs-up','fa-icon-thumbs-down','fa-icon-star-half','fa-icon-heart-empty','fa-icon-signout','fa-icon-linkedin-sign','fa-icon-pushpin','fa-icon-external-link','fa-icon-signin','fa-icon-trophy','fa-icon-github-sign','fa-icon-upload-alt','fa-icon-lemon','fa-icon-phone','fa-icon-check-empty','fa-icon-bookmark-empty','fa-icon-phone-sign','fa-icon-twitter','fa-icon-facebook','fa-icon-github','fa-icon-unlock','fa-icon-credit','fa-icon-rss','fa-icon-hdd','fa-icon-bell','fa-icon-certificate','fa-icon-hand-right','fa-icon-hand-left','fa-icon-hand-up','fa-icon-hand-down','fa-icon-circle-arrow-left','fa-icon-circle-arrow-right','fa-icon-circle-arrow-up','fa-icon-circle-arrow-down','fa-icon-globe','fa-icon-wrench','fa-icon-tasks','fa-icon-filter','fa-icon-briefcase','fa-icon-fullscreen','fa-icon-group','fa-icon-link','fa-icon-cloud','fa-icon-beaker','fa-icon-cut','fa-icon-copy','fa-icon-paper-clip','fa-icon-save','fa-icon-sign-blank','fa-icon-reorder','fa-icon-list-ul','fa-icon-list-ol','fa-icon-strikethrough','fa-icon-underline','fa-icon-table','fa-icon-magic','fa-icon-truck','fa-icon-pinterest','fa-icon-pinterest-sign','fa-icon-google-plus-sign','fa-icon-google-plus','fa-icon-money','fa-icon-caret-down','fa-icon-caret-up','fa-icon-caret-left','fa-icon-caret-right','fa-icon-columns','fa-icon-sort','fa-icon-sort-down','fa-icon-sort-up','fa-icon-envelope-alt','fa-icon-linkedin','fa-icon-undo','fa-icon-legal','fa-icon-dashboard','fa-icon-comment-alt','fa-icon-comments-alt','fa-icon-bolt','fa-icon-sitemap','fa-icon-umbrella','fa-icon-paste','fa-icon-lightbulb','fa-icon-exchange','fa-icon-cloud-download','fa-icon-cloud-upload','fa-icon-user-md','fa-icon-stethoscope','fa-icon-suitcase','fa-icon-bell-alt','fa-icon-coffee','fa-icon-food','fa-icon-file-alt','fa-icon-building','fa-icon-hospital','fa-icon-ambulance','fa-icon-medkit','fa-icon-fighter-jet','fa-icon-beer','fa-icon-h-sign','fa-icon-plus-sign2','fa-icon-double-angle-left','fa-icon-double-angle-right','fa-icon-double-angle-up','fa-icon-double-angle-down','fa-icon-angle-left','fa-icon-angle-right','fa-icon-angle-up','fa-icon-angle-down','fa-icon-desktop','fa-icon-laptop','fa-icon-tablet','fa-icon-mobile','fa-icon-circle-blank','fa-icon-quote-left','fa-icon-quote-right','fa-icon-spinner','fa-icon-circle','fa-icon-reply','fa-icon-github-alt','fa-icon-folder-close-alt','fa-icon-folder-open-alt','fa-icon-expand-alt','fa-icon-collapse-alt','fa-icon-smile','fa-icon-frown','fa-icon-meh','fa-icon-gamepad','fa-icon-keyboard','fa-icon-flag-alt','fa-icon-flag-checkered','fa-icon-terminal','fa-icon-code','fa-icon-reply-all','fa-icon-star-half-full','fa-icon-location-arrow','fa-icon-crop','fa-icon-code-fork','fa-icon-unlink','fa-icon-question','fa-icon-info','fa-icon-exclamation','fa-icon-superscript','fa-icon-subscript','fa-icon-eraser','fa-icon-puzzle','fa-icon-microphone','fa-icon-microphone-off','fa-icon-shield','fa-icon-calendar-empty','fa-icon-fire-extinguisher','fa-icon-rocket','fa-icon-maxcdn','fa-icon-chevron-sign-left','fa-icon-chevron-sign-right','fa-icon-chevron-sign-up','fa-icon-chevron-sign-down','fa-icon-html5','fa-icon-css3','fa-icon-anchor','fa-icon-unlock-alt','fa-icon-bullseye','fa-icon-ellipsis-horizontal','fa-icon-ellipsis-vertical','fa-icon-rss-sign','fa-icon-play-sign','fa-icon-ticket','fa-icon-minus-sign-alt','fa-icon-check-minus','fa-icon-level-up','fa-icon-level-down','fa-icon-check-sign','fa-icon-edit-sign','fa-icon-external-link-sign','fa-icon-share-sign','fa-icon-compass','fa-icon-collapse','fa-icon-collapse-top','fa-icon-expand','fa-icon-euro','fa-icon-gbp','fa-icon-dollar','fa-icon-rupee','fa-icon-yen','fa-icon-won','fa-icon-bitcoin','fa-icon-file2','fa-icon-file-text','fa-icon-sort-by-alphabet','fa-icon-sort-by-alphabet-alt','fa-icon-sort-by-attributes','fa-icon-sort-by-attributes-alt','fa-icon-sort-by-order','fa-icon-sort-by-order-alt','fa-icon-thumbs-up2','fa-icon-thumbs-down2','fa-icon-youtube-sign','fa-icon-youtube','fa-icon-xing','fa-icon-xing-sign','fa-icon-youtube-play','fa-icon-dropbox','fa-icon-stackexchange','fa-icon-instagram','fa-icon-flickr','fa-icon-adn','fa-icon-bitbucket-sign','fa-icon-tumblr','fa-icon-tumblr-sign','fa-icon-long-arrow-down','fa-icon-long-arrow-up','fa-icon-long-arrow-left','fa-icon-long-arrow-right','fa-icon-apple','fa-icon-windows','fa-icon-android','fa-icon-linux','fa-icon-dribbble','fa-icon-skype','fa-icon-foursquare','fa-icon-trello','fa-icon-female','fa-icon-male','fa-icon-gittip','fa-icon-sun','fa-icon-moon','fa-icon-archive','fa-icon-bug','fa-icon-vk','fa-icon-weibo','fa-icon-renren','linecon-icon-heart','linecon-icon-cloud','linecon-icon-star','linecon-icon-tv','linecon-icon-sound','linecon-icon-video','linecon-icon-trash','linecon-icon-user','linecon-icon-key','linecon-icon-search','linecon-icon-settings','linecon-icon-camera','linecon-icon-tag','linecon-icon-lock','linecon-icon-bulb','linecon-icon-pen','linecon-icon-diamond','linecon-icon-display','linecon-icon-location','linecon-icon-eye','linecon-icon-bubble','linecon-icon-stack','linecon-icon-cup','linecon-icon-phone','linecon-icon-news','linecon-icon-mail','linecon-icon-like','linecon-icon-photo','linecon-icon-note','linecon-icon-clock','linecon-icon-paperplane','linecon-icon-params','linecon-icon-banknote','linecon-icon-data','linecon-icon-music','linecon-icon-megaphone','linecon-icon-study','linecon-icon-lab','linecon-icon-food','linecon-icon-t-shirt','linecon-icon-fire','linecon-icon-clip','linecon-icon-shop','linecon-icon-calendar','linecon-icon-wallet','linecon-icon-vynil','linecon-icon-truck','linecon-icon-world','steady-icon-type','steady-icon-box','steady-icon-archive','steady-icon-envelope','steady-icon-email','steady-icon-files','steady-icon-uniE606','steady-icon-file-settings','steady-icon-file-add','steady-icon-file','steady-icon-align-left','steady-icon-align-right','steady-icon-align-center','steady-icon-align-justify','steady-icon-file-broken','steady-icon-browser','steady-icon-windows','steady-icon-window','steady-icon-folder','steady-icon-folder-add','steady-icon-folder-settings','steady-icon-folder-check','steady-icon-wifi-low','steady-icon-wifi-mid','steady-icon-wifi-full','steady-icon-connection-empty','steady-icon-connection-25','steady-icon-connection-50','steady-icon-connection-75','steady-icon-connection-full','steady-icon-list','steady-icon-grid','steady-icon-uniE620','steady-icon-battery-charging','steady-icon-battery-empty','steady-icon-battery-25','steady-icon-battery-50','steady-icon-battery-75','steady-icon-battery-full','steady-icon-settings','steady-icon-arrow-left','steady-icon-arrow-up','steady-icon-arrow-down','steady-icon-arrow-right','steady-icon-reload','steady-icon-refresh','steady-icon-volume','steady-icon-volume-increase','steady-icon-volume-decrease','steady-icon-mute','steady-icon-microphone','steady-icon-microphone-off','steady-icon-book','steady-icon-checkmark','steady-icon-checkbox-checked','steady-icon-checkbox','steady-icon-paperclip','steady-icon-download','steady-icon-tag','steady-icon-trashcan','steady-icon-search','steady-icon-zoom-in','steady-icon-zoom-out','steady-icon-chat','steady-icon-chat-1','steady-icon-chat-2','steady-icon-chat-3','steady-icon-comment','steady-icon-calendar','steady-icon-bookmark','steady-icon-email2','steady-icon-heart','steady-icon-enter','steady-icon-cloud','steady-icon-book2','steady-icon-star','steady-icon-clock','steady-icon-printer','steady-icon-home','steady-icon-flag','steady-icon-meter','steady-icon-switch','steady-icon-forbidden','steady-icon-lock','steady-icon-unlocked','steady-icon-unlocked2','steady-icon-users','steady-icon-user','steady-icon-users2','steady-icon-user2','steady-icon-bullhorn','steady-icon-share','steady-icon-screen','steady-icon-phone','steady-icon-phone-portrait','steady-icon-phone-landscape','steady-icon-tablet','steady-icon-tablet-landscape','steady-icon-laptop','steady-icon-camera','steady-icon-microwave-oven','steady-icon-credit-cards','steady-icon-calculator','steady-icon-bag','steady-icon-diamond','steady-icon-drink','steady-icon-shorts','steady-icon-vcard','steady-icon-sun','steady-icon-bill','steady-icon-coffee','steady-icon-uniE66F','steady-icon-newspaper','steady-icon-stack','steady-icon-map-marker','steady-icon-map','steady-icon-support','steady-icon-uniE675','steady-icon-barbell','steady-icon-stopwatch','steady-icon-atom','steady-icon-syringe','steady-icon-health','steady-icon-bolt','steady-icon-pill','steady-icon-bones','steady-icon-lab','steady-icon-clipboard','steady-icon-mug','steady-icon-bucket','steady-icon-select','steady-icon-graph','steady-icon-crop','steady-icon-image','steady-icon-cube','steady-icon-bars','steady-icon-chart','steady-icon-pencil','steady-icon-measure','steady-icon-eyedropper');
	//momizat icons
	return $icons;

}
