<?php //error_reporting(0);
//require '../scripts/functions.php'; ?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
    <head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php 
if (mom_option('mom_og_tags') == 1) {
if (is_singular()) { ?>
<meta property="og:image" content="<?php echo mom_post_image('medium'); ?>"/>
<?php
    $mom_og_title = get_the_title(); 
if (function_exists('is_buddypress') && is_buddypress()) {
    if ( bp_is_user() && !bp_is_register_page() ) {
			$mom_og_title = bp_get_displayed_user_fullname();
    } else {
	$mom_og_title = wp_title('', false);
    }
}
?>
<meta property="og:title" content="<?php echo $mom_og_title; ?>"/>
<meta property="og:type" content="article"/>
<meta property="og:description" content="<?php global $post; echo wp_html_excerpt(strip_shortcodes($post->post_content), 200); ?>"/>
<meta property="og:url" content="<?php the_permalink(); ?>"/>
<meta property="og:site_name" content="<?php echo get_bloginfo( 'name' ) ?>"/>
<?php }
} //end facebook og ?>

<?php if(mom_option('enable_responsive') != true) { ?>
<meta name="viewport" content="user-scalable=yes, minimum-scale=0.25, maximum-scale=3.0" />
<?php } else {  ?>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<?php } ?>
<?php if ( mom_option('custom_favicon', 'url') != 'false') { ?>
<link rel="shortcut icon" href="<?php echo mom_option('custom_favicon', 'url'); ?>" />
<?php } ?>
<?php if ( mom_option('apple_touch_icon', 'url') != '') { ?>
<link rel="apple-touch-icon" href="<?php echo mom_option('apple_touch_icon', 'url'); ?>" />
<?php } else { ?>
<link rel="apple-touch-icon" href="<?php echo MOM_URI; ?>/apple-touch-icon-precomposed.png" />
<?php } ?>

<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
        <!--[if lt IE 9]>
	<script src="<?php echo MOM_HELPERS; ?>/js/html5.js"></script>
	<script src="<?php echo MOM_HELPERS; ?>/js/IE9.js"></script>
	<![endif]-->
	<?php
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
				wp_enqueue_script( 'comment-reply' );
		}

	?>
<?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?>>
    <?php do_action('mom_first_on_body'); ?>
        <!--[if lt IE 7]>
            <p class="browsehappy"><?php _e('You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.', 'theme'); ?></p>
        <![endif]-->
        <div class="boxed-wrap clearfix">
	    <div id="header-wrapper">
            <?php if (mom_option('top_banner_position') != 'under_menu')get_template_part('elements/topbanner'); ?>
            <?php get_template_part('elements/topbar'); ?>
            <header class="header">
                <div class="inner">
                    <div class="logo">

					<?php 
					if( is_front_page() ){
						echo '<h1>';
					} ?>
                    <a href="http://www.deal4loans.com">
		    <?php if (mom_option('logo_type') == 1) { // 1 = image logo
			$default_logo = MOM_IMG.'/logo.png';
			$default_r_logo = MOM_IMG.'/retina_logo.png';
			if (mom_option('mom_color_skin') != '') {
			    $default_logo = MOM_IMG.'/logo-'.mom_option('mom_color_skin').'.png';
			    $default_r_logo = MOM_IMG.'/retina_logo-'.mom_option('mom_color_skin').'.png';
			}
			if (is_singular()) {
			    // custom logo 
                                    $the_logo = get_post_meta(get_queried_object_id(), 'mom_custom_logo', true);    
                                    if ($the_logo == '') {
                                    global $post;
					if (has_category('',$post->ID)) {
					$cat_obj = get_the_category($post->ID);
					$cat_id = $cat_obj[0]->term_id;
					$cat_data2 = get_option( 'category_'.$cat_id);
					$the_logo = isset($cat_data2['custom_logo']) ? $cat_data2['custom_logo'] : '';
					}
                                    }   
                                    $r_logo = '';
                                    if ($the_logo == '') {
                                    $the_logo = mom_option('logo_img', 'url');
                                    $r_logo = mom_option('retina_logo_img', 'url');
                                    }
			    
			    //custom banner
			    $header_banner = get_post_meta(get_queried_object_id(), 'mom_Header_banner', true);
			    if ($header_banner == '')  {
				$header_banner = mom_option('header_banner_id');
			    }
			} elseif (is_category()) {
			    // custom logo
			    $cat_data = get_option("category_".get_query_var('cat'));
			    $the_logo = isset($cat_data['custom_logo']) ? $cat_data['custom_logo'] :'';
			    $r_logo = '';
			    if ($the_logo == '') {
				$the_logo = mom_option('logo_img', 'url');
				$r_logo = mom_option('retina_logo_img', 'url');
			    }
			    
			    //custom banner
			    $header_banner = isset($cat_data['custom_banner']) ? $cat_data['custom_banner'] :'';
			    if ($header_banner == '')  {
				$header_banner = mom_option('header_banner_id');
			    }
			} else {
			    $the_logo = mom_option('logo_img', 'url');
			    $r_logo = mom_option('retina_logo_img', 'url');
			    $header_banner = mom_option('header_banner_id');
			} 
		    ?>
                        <?php if($the_logo != '') { ?>
                        <img src="<?php echo $the_logo; ?>" alt="<?php bloginfo('name'); ?>" width="<?php echo mom_option('logo_img', 'width'); ?>" height="<?php echo mom_option('logo_img', 'height'); ?>" />
                        <?php } else { ?>
                        <img src="<?php echo $default_logo; ?>" alt="<?php bloginfo('name'); ?>" width="241" height="60" />
                    <?php } ?>
                    <?php if($r_logo != '') { ?>
                        <img class="mom_retina_logo" src="<?php echo $r_logo; ?>" width="<?php echo mom_option('logo_img', 'width'); ?>" height="<?php echo mom_option('logo_img', 'height'); ?>" alt="<?php bloginfo('name'); ?>" />
                        <?php } else { ?>
                           <?php if ($the_logo != ''){ ?>
                        <img class="mom_retina_logo" src="<?php echo $the_logo; ?>" width="<?php echo mom_option('logo_img', 'width'); ?>" height="<?php echo mom_option('logo_img', 'height'); ?>" alt="<?php bloginfo('name'); ?>" />
                            <?php } else { ?>
                        <img class="mom_retina_logo" src="<?php echo $default_r_logo; ?>" width="241" height="60" alt="<?php bloginfo('name'); ?>" />
                            <?php } ?>
                    <?php } ?>
		    <?php } else {
			if (mom_option('logo_text') != '') {
			    echo '<span>'.mom_option('logo_text').'</span>';
			} else {
			    echo '<span>'.get_bloginfo('site_name').'</span>';
			}
		    } ?>
                </a>

					<?php 
					if( is_front_page() ){
						echo '</h1>';
					} ?>

                    </div>
                    <?php if (mom_option('header_banner') != false) { ?>
                    <div class="header-right">
                                  <?php 
                                        echo do_shortcode('[ad id="'.$header_banner.'"]');
                                  ?>
                    </div> <!--header right-->
                    <?php } else {
			    if (mom_option('header_custom_content') != '') {
				$mt = mom_option('header_custom_content_mt');
				echo '<div class="header-right header-right_custom-content" style="margin-top:'.$mt.'px">'.do_shortcode(mom_option('header_custom_content')).'</div>';
			    }
		    } ?>
		    
                <div class="clear"></div>
                </div>
            </header>
	    <?php do_action('mom_after_header'); ?>
	    </div> <!--header wrap-->
            <?php get_template_part('elements/navigation'); ?>
             <div style="margin-top:-17px; margin-bottom:20px;"><?php if (mom_option('top_banner_position') == 'under_menu')get_template_part('elements/topbanner'); ?></div>
            <?php do_action('mom_before_content'); ?>
            <div class="inner">
                <?php
		    $nt = mom_option('news_ticker');
		      global $post;
		      if (is_singular()) {
			$pnt = get_post_meta($post->ID, 'mom_disbale_newsticker', true);
			if ($pnt == 1) {
			  $nt = 0;
			}
		      }
		    if ($nt == 1) {
			$nt_title = mom_option('news_ticker_title');
			$nt_display = mom_option('news_ticker_display');
			$nt_category = mom_option('news_ticker_category');
			$nt_tag = mom_option('news_ticker_tag');
			$nt_custom = mom_option('news_ticker_custom');
			$custom_text_array = trim($nt_custom);
			$custom_text_array = explode("\n", $custom_text_array);
			$nt_custom = implode(',', $custom_text_array);
			$nt_count = mom_option('news_ticker_count');
			$nt_time = mom_option('news_ticker_time');
			$exclude_cats = mom_option('news_ticker_exclude_cats');
			$animation = mom_option('news_ticker_animation');
			if ($nt_time == 0) {
			    $nt_time = 'off';
			}
			$nt_time_format = mom_option('news_ticker_time_format');
			$nt_clock_only = mom_option('news_ticker_time_clock_only');

			$nt_icon = mom_option('news_ticker_icon');
			$nt_icon_url = isset($nt_icon['url']) ? $nt_icon['url'] : '';
			
			echo do_shortcode('[news_ticker title="'.$nt_title.'" animation="'.$animation.'" display="'.$nt_display.'" category="'.$nt_category.'" tag="'.$nt_tag.'" custom="'.$nt_custom.'" count="'.$nt_count.'" time="'.$nt_time.'" icon="'.$nt_icon_url.'" clock_only="'.$nt_clock_only.'" time_format="'.$nt_time_format.'" exclude_cats="'.$exclude_cats.'"]');
		    }
		?>
            </div>