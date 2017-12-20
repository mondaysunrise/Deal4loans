<?php
/**
 * ColorMag functions and definitions
 *
 * This file contains all the functions and it's defination that particularly can't be
 * in other files.
 *
 * @package ThemeGrill
 * @subpackage ColorMag
 * @since ColorMag 1.0
 */

/****************************************************************************************/
add_action( 'wp_enqueue_scripts', 'colormag_scripts_styles_method' );
/**
 * Register jquery scripts
 */
function colormag_scripts_styles_method() {

	$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
   /**
	* Loads our main stylesheet.
	*/
	wp_enqueue_style( 'colormag_style', get_stylesheet_uri() );

   // Google Font Options
   $colormag_googlefonts = array();
   array_push( $colormag_googlefonts, get_theme_mod( 'colormag_site_title_font', 'Open+Sans:400,600' ) );
   array_push( $colormag_googlefonts, get_theme_mod( 'colormag_site_tagline_font', 'Open+Sans:400,600' ) );
   array_push( $colormag_googlefonts, get_theme_mod( 'colormag_primary_menu_font', 'Open+Sans:400,600' ) );
   array_push( $colormag_googlefonts, get_theme_mod( 'colormag_all_titles_font', 'Open+Sans:400,600' ) );
   array_push( $colormag_googlefonts, get_theme_mod( 'colormag_content_font', 'Open+Sans:400,600' ) );

   $colormag_googlefonts = array_unique( $colormag_googlefonts );
   $colormag_googlefonts = implode("|", $colormag_googlefonts);

   wp_register_style( 'colormag_googlefonts', '//fonts.googleapis.com/css?family='.$colormag_googlefonts );
   wp_enqueue_style( 'colormag_googlefonts' );

	/**
	 * Adds JavaScript to pages with the comment form to support
	 * sites with threaded comments (when in use).
	 */
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );
   // BxSlider JS
   wp_register_script( 'colormag-bxslider', COLORMAG_JS_URL . '/jquery.bxslider' . $suffix . '.js', array( 'jquery' ), '4.1.2', true );
   // Sticky Menu
   if (get_theme_mod('colormag_primary_sticky_menu', 0) == 1) {
      wp_enqueue_script( 'colormag-sticky-menu', COLORMAG_JS_URL. '/sticky/jquery.sticky' . $suffix . '.js', array( 'jquery' ), '20150309', true );
   }
   // News Ticker
	wp_register_script( 'colormag-news-ticker', COLORMAG_JS_URL. '/news-ticker/jquery.newsTicker' . $suffix . '.js', array( 'jquery' ), '1.0.0', true );
   if (get_theme_mod('colormag_breaking_news', 0) == 1) {
      wp_enqueue_script( 'colormag-news-ticker' );
   }
   // MagnificPopup JS
   wp_register_script( 'colormag-featured-image-popup', COLORMAG_JS_URL. '/magnific-popup/jquery.magnific-popup' . $suffix . '.js', array( 'jquery' ), '20150310', true );
   // MagnificPopup CSS
   wp_register_style( 'colormag-featured-image-popup-css', COLORMAG_JS_URL.'/magnific-popup/magnific-popup' . $suffix . '.css', array(), '20150310' );

   if ( (get_theme_mod('colormag_featured_image_popup', 0) == 1) && is_singular('post') ) {
      wp_enqueue_script( 'colormag-featured-image-popup' );
      wp_enqueue_style( 'colormag-featured-image-popup-css' );
   }
   // EasyTabs JS
   wp_register_script( 'colormag-easy-tabs', COLORMAG_JS_URL. '/easytabs/jquery.easytabs' . $suffix . '.js', array( 'jquery' ), '20150409', true );
   // Navigation JS
   wp_enqueue_script( 'colormag-navigation', COLORMAG_JS_URL . '/navigation' . $suffix . '.js', array( 'jquery' ), false, true );
   // FontAwesome CSS
   wp_enqueue_style( 'colormag-fontawesome', get_template_directory_uri().'/fontawesome/css/font-awesome' . $suffix . '.css', array(), '4.4.0' );
   // FitVids JS
   wp_enqueue_script( 'colormag-fitvids', COLORMAG_JS_URL. '/fitvids/jquery.fitvids' . $suffix . '.js', array( 'jquery' ), '20150311', true );
   // Sharing Buttons JS
   if ( get_theme_mod( 'colormag_social_share', 0 ) == 1 ) {
      wp_enqueue_script( 'colormag-social-share', COLORMAG_JS_URL. '/sharrre/jquery.sharrre' . $suffix . '.js', array( 'jquery' ), '20150304', true );
   }
   // HTML5Shiv for Lower IE versions
   $colormag_user_agent = strtolower($_SERVER['HTTP_USER_AGENT']);
	if(preg_match('/(?i)msie [1-8]/',$colormag_user_agent)) {
		wp_enqueue_script( 'html5', COLORMAG_JS_URL . '/html5shiv' . $suffix . '.js', true );
	}
	// Custom JS
   wp_enqueue_script( 'colormag-custom', COLORMAG_JS_URL. '/colormag-custom' . $suffix . '.js', array( 'jquery' ), false, true );
   // wp_enqueue_style( 'colormag_bxslider_style', get_template_directory_uri() . '/css/jquery.bxslider.css' );

   // Enqueue bxslider if post has gallery post format
   if ( has_post_format( 'gallery' ) || is_home() || is_search() || is_archive() ) {
      wp_enqueue_script('colormag-bxslider');
   }

}

add_action('admin_enqueue_scripts', 'colormag_image_uploader');
function colormag_image_uploader() {
    wp_enqueue_media();
    wp_enqueue_script('colormag-widget-image-upload', COLORMAG_JS_URL . '/image-uploader.js', false, '20150309', true);
}

/****************************************************************************************/

add_filter( 'excerpt_length', 'colormag_excerpt_length' );
/**
 * Sets the post excerpt length to 40 words.
 *
 * function tied to the excerpt_length filter hook.
 *
 * @uses filter excerpt_length
 */
function colormag_excerpt_length( $length ) {
	return 20;
}

add_filter( 'excerpt_more', 'colormag_continue_reading' );
/**
 * Returns a "Continue Reading" link for excerpts
 */
function colormag_continue_reading() {
	return '';
}

/****************************************************************************************/

/**
 * Removing the default style of wordpress gallery
 */
add_filter( 'use_default_gallery_style', '__return_false' );

/**
 * Filtering the size to be full from thumbnail to be used in WordPress gallery as a default size
 */
function colormag_gallery_atts( $out, $pairs, $atts ) {
	$atts = shortcode_atts( array(
	'size' => 'colormag-featured-image',
	), $atts );

	$out['size'] = $atts['size'];

	return $out;

}
add_filter( 'shortcode_atts_gallery', 'colormag_gallery_atts', 10, 3 );

/****************************************************************************************/

add_filter( 'body_class', 'colormag_body_class' );
/**
 * Filter the body_class
 *
 * Throwing different body class for the different layouts in the body tag
 */
function colormag_body_class( $classes ) {
	global $post;

	if( $post ) { $layout_meta = get_post_meta( $post->ID, 'colormag_page_layout', true ); }

	if( is_home() ) {
		$queried_id = get_option( 'page_for_posts' );
		$layout_meta = get_post_meta( $queried_id, 'colormag_page_layout', true );
	}
	if( empty( $layout_meta ) || is_archive() || is_search() ) { $layout_meta = 'default_layout'; }
	$colormag_default_layout = get_theme_mod( 'colormag_default_layout', 'right_sidebar' );

	$colormag_default_page_layout = get_theme_mod( 'colormag_default_page_layout', 'right_sidebar' );
	$colormag_default_post_layout = get_theme_mod( 'colormag_default_single_posts_layout', 'right_sidebar' );

	if( $layout_meta == 'default_layout' ) {
		if( is_page() ) {
			if( $colormag_default_page_layout == 'right_sidebar' ) { $classes[] = ''; }
			elseif( $colormag_default_page_layout == 'left_sidebar' ) { $classes[] = 'left-sidebar'; }
			elseif( $colormag_default_page_layout == 'no_sidebar_full_width' ) { $classes[] = 'no-sidebar-full-width'; }
			elseif( $colormag_default_page_layout == 'no_sidebar_content_centered' ) { $classes[] = 'no-sidebar'; }
		}
		elseif( is_single() ) {
			if( $colormag_default_post_layout == 'right_sidebar' ) { $classes[] = ''; }
			elseif( $colormag_default_post_layout == 'left_sidebar' ) { $classes[] = 'left-sidebar'; }
			elseif( $colormag_default_post_layout == 'no_sidebar_full_width' ) { $classes[] = 'no-sidebar-full-width'; }
			elseif( $colormag_default_post_layout == 'no_sidebar_content_centered' ) { $classes[] = 'no-sidebar'; }
		}
		elseif( $colormag_default_layout == 'right_sidebar' ) { $classes[] = ''; }
		elseif( $colormag_default_layout == 'left_sidebar' ) { $classes[] = 'left-sidebar'; }
		elseif( $colormag_default_layout == 'no_sidebar_full_width' ) { $classes[] = 'no-sidebar-full-width'; }
		elseif( $colormag_default_layout == 'no_sidebar_content_centered' ) { $classes[] = 'no-sidebar'; }
	}
	elseif( $layout_meta == 'right_sidebar' ) { $classes[] = ''; }
	elseif( $layout_meta == 'left_sidebar' ) { $classes[] = 'left-sidebar'; }
	elseif( $layout_meta == 'no_sidebar_full_width' ) { $classes[] = 'no-sidebar-full-width'; }
	elseif( $layout_meta == 'no_sidebar_content_centered' ) { $classes[] = 'no-sidebar'; }

	if( get_theme_mod( 'colormag_site_layout', 'wide_layout' ) == 'wide_layout' ) {
		$classes[] = 'wide';
	}
	elseif( get_theme_mod( 'colormag_site_layout', 'wide_layout' ) == 'boxed_layout' ) {
		$classes[] = '';
	}

   if( get_theme_mod( 'colormag_header_display_type', 'type_one' ) == 'type_two' ) {
      $classes[] = 'header_display_type_one';
   }
   if( get_theme_mod( 'colormag_header_display_type', 'type_one' ) == 'type_three' ) {
      $classes[] = 'header_display_type_two';
   }

	return $classes;
}

/****************************************************************************************/

if ( ! function_exists( 'colormag_sidebar_select' ) ) :
/**
 * Function to select the sidebar
 */
function colormag_sidebar_select() {
	global $post;

	if( $post ) { $layout_meta = get_post_meta( $post->ID, 'colormag_page_layout', true ); }

	if( is_home() ) {
		$queried_id = get_option( 'page_for_posts' );
		$layout_meta = get_post_meta( $queried_id, 'colormag_page_layout', true );
	}

	if( empty( $layout_meta ) || is_archive() || is_search() ) { $layout_meta = 'default_layout'; }
	$colormag_default_layout = get_theme_mod( 'colormag_default_layout', 'right_sidebar' );

	$colormag_default_page_layout = get_theme_mod( 'colormag_default_page_layout', 'right_sidebar' );
	$colormag_default_post_layout = get_theme_mod( 'colormag_default_single_posts_layout', 'right_sidebar' );

	if( $layout_meta == 'default_layout' ) {
		if( is_page() ) {
			if( $colormag_default_page_layout == 'right_sidebar' ) { get_sidebar(); }
			elseif ( $colormag_default_page_layout == 'left_sidebar' ) { get_sidebar( 'left' ); }
		}
		if( is_single() ) {
			if( $colormag_default_post_layout == 'right_sidebar' ) { get_sidebar(); }
			elseif ( $colormag_default_post_layout == 'left_sidebar' ) { get_sidebar( 'left' ); }
		}
		elseif( $colormag_default_layout == 'right_sidebar' ) { get_sidebar(); }
		elseif ( $colormag_default_layout == 'left_sidebar' ) { get_sidebar( 'left' ); }
	}
	elseif( $layout_meta == 'right_sidebar' ) { get_sidebar(); }
	elseif( $layout_meta == 'left_sidebar' ) { get_sidebar( 'left' ); }
}
endif;

/****************************************************************************************/

if ( ! function_exists( 'colormag_entry_meta' ) ) :
/**
 * Shows meta information of post.
 */
function colormag_entry_meta() {
   if ( 'post' == get_post_type() ) :
   	echo '<div class="below-entry-meta">';
   	?>

      <?php
   	$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
      if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
         $time_string .= '<time class="updated" datetime="%3$s">%4$s</time>';
      }
      $time_string = sprintf( $time_string,
         esc_attr( get_the_date( 'c' ) ),
         esc_html( get_the_date() ),
         esc_attr( get_the_modified_date( 'c' ) ),
         esc_html( get_the_modified_date() )
      );
   	printf( __( '<span class="posted-on"><a href="%1$s" title="%2$s" rel="bookmark"><i class="fa fa-calendar-o"></i> %3$s</a></span>', 'colormag' ),
   		esc_url( get_permalink() ),
   		esc_attr( get_the_time() ),
   		$time_string
   	); ?>

  
      <?php if ( get_theme_mod( 'colormag_post_view_entry_meta_remove', 0 ) == 0 ) {
			echo colormag_post_view_display(get_the_ID());
		} ?>

      <?php
      if ( ! post_password_required() && comments_open() ) { ?>
         <span class="comments"><?php comments_popup_link( __( '<i class="fa fa-comment"></i> 0 Comment', 'colormag' ), __( '<i class="fa fa-comment"></i> 1 Comment', 'colormag' ), __( '<i class="fa fa-comments"></i> % Comments', 'colormag' ) ); ?></span>
      <?php }
   	$tags_list = get_the_tag_list( '<span class="tag-links"><i class="fa fa-tags"></i>', __( ', ', 'colormag' ), '</span>' );
   	if ( $tags_list ) echo $tags_list;

		// edit button remove option add
		if ( get_theme_mod( 'colormag_edit_button_entry_meta_remove', 0 ) == 0 ) {
	   	edit_post_link( __( 'Edit', 'colormag' ), '<span class="edit-link"><i class="fa fa-edit"></i>', '</span>' );
		}

   	echo '</div>';
   endif;
}
endif;

/****************************************************************************************/

add_action( 'admin_head', 'colormag_favicon' );
add_action( 'wp_head', 'colormag_favicon' );
/**
 * Favicon for the site
 */
function colormag_favicon() {
	if ( get_theme_mod( 'colormag_favicon_show', '0' ) == '1' ) {
		$colormag_favicon = get_theme_mod( 'colormag_favicon_upload', '' );
		$colormag_favicon_output = '';
		if ( !empty( $colormag_favicon ) ) {
			$colormag_favicon_output .= '<link rel="shortcut icon" href="'.esc_url( $colormag_favicon ).'" type="image/x-icon" />';
		}
		echo $colormag_favicon_output;
	}
}

/****************************************************************************************/

add_action('wp_head', 'colormag_custom_css');
/**
 * Hooks the Custom Internal CSS to head section
 */
function colormag_custom_css() {
	$colormag_internal_css = '';
	$primary_color = get_theme_mod( 'colormag_primary_color', '#289dcc' );
	if( $primary_color != '#289dcc' ) {
		$colormag_internal_css .= ' .colormag-button,blockquote,button,input[type=reset],input[type=button],input[type=submit]{background-color:'.$primary_color.'}a{color:'.$primary_color.'}#site-navigation{border-top:4px solid '.$primary_color.'}.home-icon.front_page_on,.main-navigation a:hover,.main-navigation ul li ul li a:hover,.main-navigation ul li ul li:hover>a,.main-navigation ul li.current-menu-ancestor>a,.main-navigation ul li.current-menu-item ul li a:hover,.main-navigation ul li.current-menu-item>a,.main-navigation ul li.current_page_ancestor>a,.main-navigation ul li.current_page_item>a,.main-navigation ul li:hover>a,.main-small-navigation li a:hover,.site-header .menu-toggle:hover{background-color:'.$primary_color.'}.main-small-navigation .current-menu-item>a,.main-small-navigation .current_page_item>a{background:'.$primary_color.'}#main .breaking-news-latest,.fa.search-top:hover{background-color:'.$primary_color.'}.byline a:hover,.comments a:hover,.edit-link a:hover,.posted-on a:hover,.social-links i.fa:hover,.tag-links a:hover{color:'.$primary_color.'}.widget_featured_posts .article-content .above-entry-meta .cat-links a{background-color:'.$primary_color.'}.widget_featured_posts .article-content .entry-title a:hover{color:'.$primary_color.'}.widget_featured_posts .widget-title{border-bottom:2px solid '.$primary_color.'}.widget_featured_posts .widget-title span,.widget_featured_slider .slide-content .above-entry-meta .cat-links a{background-color:'.$primary_color.'}.widget_featured_slider .slide-content .below-entry-meta .byline a:hover,.widget_featured_slider .slide-content .below-entry-meta .comments a:hover,.widget_featured_slider .slide-content .below-entry-meta .posted-on a:hover,.widget_featured_slider .slide-content .entry-title a:hover{color:'.$primary_color.'}.widget_highlighted_posts .article-content .above-entry-meta .cat-links a{background-color:'.$primary_color.'}.widget_block_picture_news.widget_featured_posts .article-content .entry-title a:hover,.widget_highlighted_posts .article-content .below-entry-meta .byline a:hover,.widget_highlighted_posts .article-content .below-entry-meta .comments a:hover,.widget_highlighted_posts .article-content .below-entry-meta .posted-on a:hover,.widget_highlighted_posts .article-content .entry-title a:hover{color:'.$primary_color.'}.category-slide-next,.category-slide-prev,.slide-next,.slide-prev,.tabbed-widget ul li{background-color:'.$primary_color.'}i#breaking-news-widget-next,i#breaking-news-widget-prev{color:'.$primary_color.'}#secondary .widget-title{border-bottom:2px solid '.$primary_color.'}#content .wp-pagenavi .current,#content .wp-pagenavi a:hover,#secondary .widget-title span{background-color:'.$primary_color.'}#site-title a{color:'.$primary_color.'}.page-header .page-title{border-bottom:2px solid '.$primary_color.'}#content .post .article-content .above-entry-meta .cat-links a,.page-header .page-title span{background-color:'.$primary_color.'}#content .post .article-content .entry-title a:hover,.entry-meta .byline i,.entry-meta .cat-links i,.entry-meta a,.post .entry-title a:hover,.search .entry-title a:hover{color:'.$primary_color.'}.entry-meta .post-format i{background-color:'.$primary_color.'}.entry-meta .comments-link a:hover,.entry-meta .edit-link a:hover,.entry-meta .posted-on a:hover,.entry-meta .tag-links a:hover,.single #content .tags a:hover{color:'.$primary_color.'}.format-link .entry-content a,.more-link{background-color:'.$primary_color.'}.count,.next a:hover,.previous a:hover,.related-posts-main-title .fa,.single-related-posts .article-content .entry-title a:hover{color:'.$primary_color.'}.pagination a span:hover{color:'.$primary_color.';border-color:'.$primary_color.'}.pagination span{background-color:'.$primary_color.'}#content .comments-area a.comment-edit-link:hover,#content .comments-area a.comment-permalink:hover,#content .comments-area article header cite a:hover,.comments-area .comment-author-link a:hover{color:'.$primary_color.'}.comments-area .comment-author-link span{background-color:'.$primary_color.'}.comment .comment-reply-link:hover,.nav-next a,.nav-previous a{color:'.$primary_color.'}.footer-widgets-area .widget-title{border-bottom:2px solid '.$primary_color.'}.footer-widgets-area .widget-title span{background-color:'.$primary_color.'}#colophon .footer-menu ul li a:hover,.footer-widgets-area a:hover,a#scroll-up i{color:'.$primary_color.'}.advertisement_above_footer .widget-title{border-bottom:2px solid '.$primary_color.'}.advertisement_above_footer .widget-title span{background-color:'.$primary_color.'}.sub-toggle{background:'.$primary_color.'}.main-small-navigation li.current-menu-item > .sub-toggle i {color:'.$primary_color.'}.error{background:'.$primary_color.'}.num-404{color:'.$primary_color.'}';
	}

   // google fonts custom css
   if( get_theme_mod( 'colormag_site_title_font', 'Open Sans' ) != 'Open Sans' ) {
      $colormag_internal_css .= ' #site-title a { font-family: "'.get_theme_mod( 'colormag_site_title_font', 'Open Sans' ).'"; }';
   }
   if( get_theme_mod( 'colormag_site_tagline_font', 'Open Sans' ) != 'Open Sans' ) {
      $colormag_internal_css .= ' #site-description { font-family: "'.get_theme_mod( 'colormag_site_tagline_font', 'Open Sans' ).'"; }';
   }
   if( get_theme_mod( 'colormag_primary_menu_font', 'Open Sans' ) != 'Open Sans' ) {
      $colormag_internal_css .= ' .main-navigation li, .site-header .menu-toggle { font-family: "'.get_theme_mod( 'colormag_primary_menu_font', 'Open Sans' ).'"; }';
   }
   if( get_theme_mod( 'colormag_all_titles_font', 'Open Sans' ) != 'Open Sans' ) {
      $colormag_internal_css .= ' h1, h2, h3, h4, h5, h6 { font-family: "'.get_theme_mod( 'colormag_all_titles_font', 'Open Sans' ).'"; }';
   }
   if( get_theme_mod( 'colormag_content_font', 'Open Sans' ) != 'Open Sans' ) {
      $colormag_internal_css .= ' body, button, input, select, textarea, p, blockquote p, .entry-meta, .more-link { font-family: "'.get_theme_mod( 'colormag_content_font', 'Open Sans' ).'"; }';
   }

   // header area font size custom css
   if( get_theme_mod( 'colormag_title_font_size', '46' ) != '46' ) {
      $colormag_internal_css .= ' #site-title a { font-size: '.get_theme_mod( 'colormag_title_font_size', '46' ).'px; }';
   }
   if( get_theme_mod( 'colormag_tagline_font_size', '16' ) != '16' ) {
      $colormag_internal_css .= ' #site-description { font-size: '.get_theme_mod( 'colormag_tagline_font_size', '16' ).'px; }';
   }
   if( get_theme_mod( 'colormag_primary_menu_font_size', '14' ) != '14' ) {
      $colormag_internal_css .= ' .main-navigation ul li a { font-size: '.get_theme_mod( 'colormag_primary_menu_font_size', '14' ).'px; }';
   }
   if( get_theme_mod( 'colormag_primary_sub_menu_font_size', '14' ) != '14' ) {
      $colormag_internal_css .= ' .main-navigation ul li ul li a { font-size: '.get_theme_mod( 'colormag_primary_sub_menu_font_size', '14' ).'px; }';
   }

   // title related font sizes css
   if( get_theme_mod( 'colormag_heading_h1_font_size', '42' ) != '42' ) {
      $colormag_internal_css .= ' h1 { font-size: '.get_theme_mod( 'colormag_heading_h1_font_size', '42' ).'px; }';
   }
   if( get_theme_mod( 'colormag_heading_h2_font_size', '38' ) != '38' ) {
      $colormag_internal_css .= ' h2 { font-size: '.get_theme_mod( 'colormag_heading_h2_font_size', '38' ).'px; }';
   }
   if( get_theme_mod( 'colormag_heading_h3_font_size', '34' ) != '34' ) {
      $colormag_internal_css .= ' h3 { font-size: '.get_theme_mod( 'colormag_heading_h3_font_size', '34' ).'px; }';
   }
   if( get_theme_mod( 'colormag_heading_h4_font_size', '30' ) != '30' ) {
      $colormag_internal_css .= ' h4 { font-size: '.get_theme_mod( 'colormag_heading_h4_font_size', '30' ).'px; }';
   }
   if( get_theme_mod( 'colormag_heading_h5_font_size', '26' ) != '26' ) {
      $colormag_internal_css .= ' h5 { font-size: '.get_theme_mod( 'colormag_heading_h5_font_size', '26' ).'px; }';
   }
   if( get_theme_mod( 'colormag_heading_h6_font_size', '22' ) != '22' ) {
      $colormag_internal_css .= ' h6 { font-size: '.get_theme_mod( 'colormag_heading_h6_font_size', '22' ).'px; }';
   }
   if( get_theme_mod( 'colormag_post_title_font_size', '32' ) != '32' ) {
      $colormag_internal_css .= ' #content .post .article-content .entry-title { font-size: '.get_theme_mod( 'colormag_post_title_font_size', '32' ).'px; }';
   }
   if( get_theme_mod( 'colormag_page_title_font_size', '34' ) != '34' ) {
      $colormag_internal_css .= ' .type-page .entry-title { font-size: '.get_theme_mod( 'colormag_page_title_font_size', '34' ).'px; }';
   }
   if( get_theme_mod( 'colormag_widget_title_font_size', '18' ) != '18' ) {
      $colormag_internal_css .= ' #secondary .widget-title { font-size: '.get_theme_mod( 'colormag_widget_title_font_size', '18' ).'px; }';
   }
   if( get_theme_mod( 'colormag_comment_title_font_size', '22' ) != '22' ) {
      $colormag_internal_css .= ' .comments-title, .comment-reply-title, #respond h3#reply-title { font-size: '.get_theme_mod( 'colormag_comment_title_font_size', '22' ).'px; }';
   }

   // content font size custom css
   if( get_theme_mod( 'colormag_content_font_size', '18' ) != '18' ) {
      $colormag_internal_css .= ' body, button, input, select, textarea, p, blockquote p, dl, .previous a, .next a, .nav-previous a, .nav-next a, #respond h3#reply-title #cancel-comment-reply-link, #respond form input[type="text"], #respond form textarea, #secondary .widget, .error-404 .widget { font-size: '.get_theme_mod( 'colormag_content_font_size', '18' ).'px; }';
   }
   if( get_theme_mod( 'colormag_post_meta_font_size', '12' ) != '12' ) {
      $colormag_internal_css .= ' #content .post .article-content .below-entry-meta .posted-on a, #content .post .article-content .below-entry-meta .byline a, #content .post .article-content .below-entry-meta .comments a, #content .post .article-content .below-entry-meta .tag-links a, #content .post .article-content .below-entry-meta .edit-link a, #content .post .article-content .below-entry-meta .total-views { font-size: '.get_theme_mod( 'colormag_post_meta_font_size', '12' ).'px; }';
   }
   if( get_theme_mod( 'colormag_button_text_font_size', '12' ) != '12' ) {
      $colormag_internal_css .= ' .colormag-button, input[type="reset"], input[type="button"], input[type="submit"], button, .more-link span { font-size: '.get_theme_mod( 'colormag_button_text_font_size', '12' ).'px; }';
   }

   // footer area font size custom css
   if( get_theme_mod( 'colormag_footer_widget_title_font_size', '15' ) != '15' ) {
      $colormag_internal_css .= ' .footer-widgets-area .widget-title { font-size: '.get_theme_mod( 'colormag_footer_widget_title_font_size', '15' ).'px; }';
   }
   if( get_theme_mod( 'colormag_footer_widget_content_font_size', '14' ) != '14' ) {
      $colormag_internal_css .= ' #colophon, #colophon p { font-size: '.get_theme_mod( 'colormag_footer_widget_content_font_size', '14' ).'px; }';
   }
   if( get_theme_mod( 'colormag_footer_copyright_text_font_size', '14' ) != '14' ) {
      $colormag_internal_css .= ' .footer-socket-wrapper .copyright { font-size: '.get_theme_mod( 'colormag_footer_copyright_text_font_size', '14' ).'px; }';
   }
   if( get_theme_mod( 'colormag_footer_small_menu_font_size', '14' ) != '14' ) {
      $colormag_internal_css .= ' .footer-menu a { font-size: '.get_theme_mod( 'colormag_footer_small_menu_font_size', '14' ).'px; }';
   }

   // header area custom css
   if( get_theme_mod( 'colormag_site_title_color', '#289dcc' ) != '#289dcc' ) {
      $colormag_internal_css .= ' #site-title a { color: '.get_theme_mod( 'colormag_site_title_color', '#289dcc' ).'; }';
   }
   if( get_theme_mod( 'colormag_site_tagline_color', '#666666' ) != '#666666' ) {
      $colormag_internal_css .= ' #site-description { color: '.get_theme_mod( 'colormag_site_tagline_color', '#666666' ).'; }';
   }
   if( get_theme_mod( 'colormag_primary_menu_text_color', '#ffffff' ) != '#ffffff' ) {
      $colormag_internal_css .= ' .main-navigation a, .main-navigation ul li ul li a, .main-navigation ul li.current-menu-item ul li a, .main-navigation ul li ul li.current-menu-item a, .main-navigation ul li.current_page_ancestor ul li a, .main-navigation ul li.current-menu-ancestor ul li a, .main-navigation ul li.current_page_item ul li a { color: '.get_theme_mod( 'colormag_primary_menu_text_color', '#ffffff' ).'; }';
   }
   if( get_theme_mod( 'colormag_primary_menu_selected_hovered_text_color', '#ffffff' ) != '#ffffff' ) {
      $colormag_internal_css .= ' .main-navigation a:hover, .main-navigation ul li.current-menu-item a, .main-navigation ul li.current_page_ancestor a, .main-navigation ul li.current-menu-ancestor a, .main-navigation ul li.current_page_item a, .main-navigation ul li:hover > a, .main-navigation ul li ul li a:hover, .main-navigation ul li ul li:hover > a, .main-navigation ul li.current-menu-item ul li a:hover { color: '.get_theme_mod( 'colormag_primary_menu_selected_hovered_text_color', '#ffffff' ).'; }';
   }
   if( get_theme_mod( 'colormag_header_background_color', '#ffffff' ) != '#ffffff' ) {
      $colormag_internal_css .= ' #header-text-nav-container { background-color: '.get_theme_mod( 'colormag_header_background_color', '#ffffff' ).'; }';
   }

   // content part color options custom css
   if( get_theme_mod( 'colormag_content_part_title_color', '#333333' ) != '#333333' ) {
      $colormag_internal_css .= ' h1, h2, h3, h4, h5, h6 { color: '.get_theme_mod( 'colormag_content_part_title_color', '#333333' ).'; }';
   }
   if( get_theme_mod( 'colormag_post_title_color', '#333333' ) != '#333333' ) {
      $colormag_internal_css .= ' .post .entry-title, .post .entry-title a { color: '.get_theme_mod( 'colormag_post_title_color', '#333333' ).'; }';
   }
   if( get_theme_mod( 'colormag_page_title_color', '#333333' ) != '#333333' ) {
      $colormag_internal_css .= ' .type-page .entry-title { color: '.get_theme_mod( 'colormag_page_title_color', '#333333' ).'; }';
   }
   if( get_theme_mod( 'colormag_content_text_color', '#444444' ) != '#444444' ) {
      $colormag_internal_css .= ' body, button, input, select, textarea { color: '.get_theme_mod( 'colormag_content_text_color', '#444444' ).'; }';
   }
   if( get_theme_mod( 'colormag_post_meta_color', '#888888' ) != '#888888' ) {
      $colormag_internal_css .= ' .posted-on a, .byline a, .comments a, .tag-links a, .edit-link a { color: '.get_theme_mod( 'colormag_post_meta_color', '#888888' ).'; }';
   }
   if( get_theme_mod( 'colormag_button_text_color', '#ffffff' ) != '#ffffff' ) {
      $colormag_internal_css .= ' .colormag-button, input[type="reset"], input[type="button"], input[type="submit"], button, .more-link span { color: '.get_theme_mod( 'colormag_button_text_color', '#ffffff' ).'; }';
   }
   if( get_theme_mod( 'colormag_button_background_color', '#d40234' ) != '#d40234' ) {
      $colormag_internal_css .= ' .colormag-button, input[type="reset"], input[type="button"], input[type="submit"], button, .more-link span { background-color: '.get_theme_mod( 'colormag_button_background_color', '#d40234' ).'; }';
   }
   if( get_theme_mod( 'colormag_sidebar_widget_title_color', '#ffffff' ) != '#ffffff' ) {
      $colormag_internal_css .= ' #secondary .widget-title span { color: '.get_theme_mod( 'colormag_sidebar_widget_title_color', '#ffffff' ).'; }';
   }
   if( get_theme_mod( 'colormag_content_section_background_color', '#ffffff' ) != '#ffffff' ) {
      $colormag_internal_css .= ' #main { background-color: '.get_theme_mod( 'colormag_content_section_background_color', '#ffffff' ).'; }';
   }

   // footer part color options
   if( get_theme_mod( 'colormag_footer_widget_title_color', '#ffffff' ) != '#ffffff' ) {
      $colormag_internal_css .= ' .footer-widgets-area .widget-title span { color: '.get_theme_mod( 'colormag_footer_widget_title_color', '#ffffff' ).'; }';
   }
   if( get_theme_mod( 'colormag_footer_widget_content_color', '#ffffff' ) != '#ffffff' ) {
      $colormag_internal_css .= ' .footer-widgets-area, .footer-widgets-area p { color: '.get_theme_mod( 'colormag_footer_widget_content_color', '#ffffff' ).'; }';
   }
   if( get_theme_mod( 'colormag_footer_widget_content_link_text_color', '#ffffff' ) != '#ffffff' ) {
      $colormag_internal_css .= ' .footer-widgets-area a { color: '.get_theme_mod( 'colormag_footer_widget_content_link_text_color', '#ffffff' ).'; }';
   }
   if( get_theme_mod( 'colormag_footer_widget_background_color', '' ) != '' ) {
      $colormag_internal_css .= ' .footer-widgets-wrapper { background-color: '.get_theme_mod( 'colormag_footer_widget_background_color', '' ).'; }';
   }
   if( get_theme_mod( 'colormag_footer_copyright_text_color', '#b1b6b6' ) != '#b1b6b6' ) {
      $colormag_internal_css .= ' .footer-socket-wrapper .copyright { color: '.get_theme_mod( 'colormag_footer_copyright_text_color', '#b1b6b6' ).'; }';
   }
   if( get_theme_mod( 'colormag_footer_copyright_link_text_color', '#b1b6b6' ) != '#b1b6b6' ) {
      $colormag_internal_css .= ' .footer-socket-wrapper .copyright a { color: '.get_theme_mod( 'colormag_footer_copyright_link_text_color', '#b1b6b6' ).'; }';
   }
   if( get_theme_mod( 'colormag_footer_small_menu_text_color', '#b1b6b6' ) != '#b1b6b6' ) {
      $colormag_internal_css .= ' #colophon .footer-menu ul li a { color: '.get_theme_mod( 'colormag_footer_small_menu_text_color', '#b1b6b6' ).'; }';
   }
   if( get_theme_mod( 'colormag_footer_copyright_part_background_color', '' ) != '' ) {
      $colormag_internal_css .= ' .footer-socket-wrapper { background-color: '.get_theme_mod( 'colormag_footer_copyright_part_background_color', '' ).'; }';
   }
	// post meta data settings
	// total post meta remove
	if( get_theme_mod( 'colormag_all_entry_meta_remove', 0 ) == 1 ) {
		$colormag_internal_css .= ' .above-entry-meta,.below-entry-meta{display:none;}';
	}
	// author post meta remove
	if( get_theme_mod( 'colormag_author_entry_meta_remove', 0 ) == 1 ) {
		$colormag_internal_css .= ' .below-entry-meta .byline{display:none;}';
	}
	// date post meta remove
	if( get_theme_mod( 'colormag_date_entry_meta_remove', 0 ) == 1 ) {
		$colormag_internal_css .= ' .below-entry-meta .posted-on{display:none;}';
	}
	// category post meta remove
	if( get_theme_mod( 'colormag_category_entry_meta_remove', 0 ) == 1 ) {
		$colormag_internal_css .= ' .above-entry-meta{display:none;}';
	}
	// comments post meta remove
	if( get_theme_mod( 'colormag_comments_entry_meta_remove', 0 ) == 1 ) {
		$colormag_internal_css .= ' .below-entry-meta .comments{display:none;}';
	}
	// tags post meta remove
	if( get_theme_mod( 'colormag_tags_entry_meta_remove', 0 ) == 1 ) {
		$colormag_internal_css .= ' .below-entry-meta .tag-links{display:none;}';
	}

	if( !empty( $colormag_internal_css ) ) {
		echo '<!-- '.get_bloginfo('name').' Internal Styles -->';
		?><style type="text/css"><?php echo $colormag_internal_css; ?></style>
<?php
	}

	$colormag_custom_css = get_theme_mod( 'colormag_custom_css', '' );
	if( !empty( $colormag_custom_css ) ) {
		echo '<!-- '.get_bloginfo('name').' Custom Styles -->';
		?><style type="text/css"><?php echo $colormag_custom_css; ?></style><?php
	}
}

/**************************************************************************************/

add_filter('the_content_more_link', 'colormag_remove_more_jump_link');
/**
 * Removing the more link jumping to middle of content
 */
function colormag_remove_more_jump_link($link) {
	$offset = strpos($link, '#more-');
	if ($offset) {
		$end = strpos($link, '"',$offset);
	}
	if ($end) {
		$link = substr_replace($link, '', $offset, $end-$offset);
	}
	return $link;
}

/**************************************************************************************/

if ( ! function_exists( 'colormag_content_nav' ) ) :
/**
 * Display navigation to next/previous pages when applicable
 */
function colormag_content_nav( $nav_id ) {
	global $wp_query, $post;

	// Don't print empty markup on single pages if there's nowhere to navigate.
	if ( is_single() ) {
		$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
		$next = get_adjacent_post( false, '', false );

		if ( ! $next && ! $previous )
			return;
	}

	// Don't print empty markup in archives if there's only one page.
	if ( $wp_query->max_num_pages < 2 && ( is_home() || is_archive() || is_search() ) )
		return;

	$nav_class = ( is_single() ) ? 'post-navigation' : 'paging-navigation';

	?>
	<nav role="navigation" id="<?php echo esc_attr( $nav_id ); ?>" class="<?php echo $nav_class; ?>">
		<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'colormag' ); ?></h1>

	<?php if ( is_single() ) : // navigation links for single posts ?>

		<?php previous_post_link( '<div class="nav-previous">%link</div>', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'colormag' ) . '</span> %title' ); ?>
		<?php next_post_link( '<div class="nav-next">%link</div>', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'colormag' ) . '</span>' ); ?>

	<?php elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) : // navigation links for home, archive, and search pages ?>

		<?php if ( get_next_posts_link() ) : ?>
		<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'colormag' ) ); ?></div>
		<?php endif; ?>

		<?php if ( get_previous_posts_link() ) : ?>
		<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'colormag' ) ); ?></div>
		<?php endif; ?>

	<?php endif; ?>

	</nav><!-- #<?php echo esc_html( $nav_id ); ?> -->
	<?php
}
endif; // colormag_content_nav

/**************************************************************************************/

if ( ! function_exists( 'colormag_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 */
function colormag_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
		// Display trackbacks differently than normal comments.
	?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<p><?php _e( 'Pingback:', 'colormag' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'colormag' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
		// Proceed with normal comments.
		global $post;
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<header class="comment-meta comment-author ">
				<?php
					echo get_avatar( $comment, 74 );
					printf( '<div class="comment-author-link"><i class="fa fa-user"></i>%1$s%2$s</div>',
						get_comment_author_link(),
						// If current post author is also comment author, make it known visually.
						( $comment->user_id === $post->post_author ) ? '<span>' . __( 'Post author', 'colormag' ) . '</span>' : ''
					);
					printf( '<div class="comment-date-time"><i class="fa fa-calendar-o"></i>%1$s</div>',
						sprintf( __( '%1$s at %2$s', 'colormag' ), get_comment_date(), get_comment_time() )
					);
					printf( '<a class="comment-permalink" href="%1$s"><i class="fa fa-link"></i>Permalink</a>', esc_url( get_comment_link( $comment->comment_ID ) ) );
					edit_comment_link();
				?>
			</header><!-- .comment-meta -->

			<?php if ( '0' == $comment->comment_approved ) : ?>
				<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'colormag' ); ?></p>
			<?php endif; ?>

			<section class="comment-content comment">
				<?php comment_text(); ?>
				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'colormag' ), 'after' => '', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</section><!-- .comment-content -->

		</article><!-- #comment-## -->
	<?php
		break;
	endswitch; // end comment_type check
}
endif;

/**************************************************************************************/

/*
 * Category Color Options
 */
if ( ! function_exists( 'colormag_category_color' ) ) :
function colormag_category_color( $wp_category_id ) {
   $args = array(
      'orderby' => 'id',
      'hide_empty' => 0
   );
   $category = get_categories( $args );
   foreach ($category as $category_list ) {
      $color = get_theme_mod('colormag_category_color_'.$wp_category_id);
      return $color;
   }
}
endif;

/**************************************************************************************/

/*
 * Breaking News/Latest Posts ticker section in the header
 */
if ( ! function_exists( 'colormag_breaking_news' ) ) :
function colormag_breaking_news() {
   if ( false === ( $get_featured_posts = get_transient( 'colormag_cached_breaking_news' ) ) ) {
      $get_featured_posts = new WP_Query( array(
         'posts_per_page'         => 5,
         'post_type'              => 'post',
         'ignore_sticky_posts'    => true,
         'no_found_rows'          => true,
         'update_post_meta_cache' => false,
         'update_post_term_cache' => false
      ) );

      set_transient( 'colormag_cached_breaking_news', $get_featured_posts, DAY_IN_SECONDS);
    }
?>
   <div class="breaking-news">
      <strong class="breaking-news-latest">
         <?php echo get_theme_mod( 'colormag_breaking_news_content_option' , __( 'Latest:', 'colormag' ) ); ?>
      </strong>
      <ul class="newsticker">
      <?php while( $get_featured_posts->have_posts() ):$get_featured_posts->the_post(); ?>
         <li>
            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute();?>"><?php the_title(); ?></a>
         </li>
      <?php endwhile; ?>
      </ul>
   </div>
   <?php
   // Reset Post Data
   wp_reset_query();
}
endif;

/**
 * Purge the transient
 */
add_action( 'save_post', 'colormag_purge_transient' );
function colormag_purge_transient( $post ) {
	delete_transient( 'colormag_cached_breaking_news' );
	delete_transient( 'colormag_cached_random_post' );
}

// Breaking News Javascript Alter
if ( ! function_exists( 'colormag_breaking_news_option' ) ) :

   function colormag_breaking_news_option() {
      $breaking_news_slide_effect = get_theme_mod( 'colormag_breaking_news_setting_animation_options', 'down' );
      $breaking_news_duration = get_theme_mod( 'colormag_breaking_news_duration_setting_options', 4 );
      $breaking_news_speed = get_theme_mod( 'colormag_breaking_news_speed_setting_options', 1 );

      $breaking_news_duration = intval($breaking_news_duration);
      $breaking_news_speed = intval($breaking_news_speed);

      if ( $breaking_news_duration != 0 ) { $breaking_news_duration = $breaking_news_duration * 1000; } else { $breaking_news_duration = 4000; }
      if ( $breaking_news_speed != 0 ) { $breaking_news_speed = $breaking_news_speed * 1000; } else { $breaking_news_speed = 1000; }

      wp_localize_script(
         'colormag-news-ticker',
         'colormag_ticker_settings',
         array(
            'breaking_news_slide_effect' => $breaking_news_slide_effect,
            'breaking_news_duration' => $breaking_news_duration,
            'breaking_news_speed' => $breaking_news_speed
         )
      );
   }

endif;

add_action('wp_enqueue_scripts', 'colormag_breaking_news_option', 100);

/**************************************************************************************/

/*
 * Display the date in the header
 */
if ( ! function_exists( 'colormag_date_display' ) ) :
function colormag_date_display() { ?>
   <div class="date-in-header">
      <?php echo date_i18n('l, F j, Y'); ?>
   </div>
<?php
}
endif;

/**************************************************************************************/

/*
 * Random Post in header
 */
if ( ! function_exists( 'colormag_random_post' ) ) :
function colormag_random_post() {
   if ( false === ( $get_random_post = get_transient( 'colormag_cached_random_post' ) ) ) {
      $get_random_post = new WP_Query( array(
         'posts_per_page'         => 1,
         'post_type'              => 'post',
         'ignore_sticky_posts'    => true,
         'orderby'                => 'rand',
         'no_found_rows'          => true,
         'update_post_meta_cache' => false,
         'update_post_term_cache' => false
      ) );

      set_transient( 'colormag_cached_random_post', $get_random_post, DAY_IN_SECONDS);

    }
?>
   <div class="random-post">
      <?php while( $get_random_post->have_posts() ):$get_random_post->the_post(); ?>
         <a href="<?php the_permalink(); ?>" title="<?php _e( 'View a random post', 'colormag' ); ?>"><i class="fa fa-random"></i></a>
      <?php endwhile; ?>
   </div>
   <?php
   // Reset Post Data
   wp_reset_query();
}
endif;

/**************************************************************************************/

/*
 * Display the related posts
 */
if ( ! function_exists( 'colormag_related_posts_function' ) ) {

   function colormag_related_posts_function() {
      wp_reset_postdata();
      global $post;

      // Define shared post arguments
      $args = array(
         'no_found_rows'            => true,
         'update_post_meta_cache'   => false,
         'update_post_term_cache'   => false,
         'ignore_sticky_posts'      => 1,
         'orderby'               => 'rand',
         'post__not_in'          => array($post->ID),
         'posts_per_page'        => 3
      );
      // Related by categories
      if ( get_theme_mod('colormag_related_posts', 'categories') == 'categories' ) {

         $cats = get_post_meta($post->ID, 'related-posts', true);

         if ( !$cats ) {
            $cats = wp_get_post_categories($post->ID, array('fields'=>'ids'));
            $args['category__in'] = $cats;
         } else {
            $args['cat'] = $cats;
         }
      }
      // Related by tags
      if ( get_theme_mod('colormag_related_posts', 'categories') == 'tags' ) {

         $tags = get_post_meta($post->ID, 'related-posts', true);

         if ( !$tags ) {
            $tags = wp_get_post_tags($post->ID, array('fields'=>'ids'));
            $args['tag__in'] = $tags;
         } else {
            $args['tag_slug__in'] = explode(',', $tags);
         }
         if ( !$tags ) { $break = true; }
      }

      $query = !isset($break)?new WP_Query($args):new WP_Query;
      return $query;
   }

}

/**************************************************************************************/

/*
 * Category Color for widgets and other
 */
if ( !function_exists('colormag_colored_category') ) :
   function colormag_colored_category() {
      global $post;
      $categories = get_the_category();
      $separator = '&nbsp;';
      $output = '';
      if($categories) {
         $output .= '<div class="above-entry-meta"><span class="cat-links">';
         foreach($categories as $category) {
            $color_code = colormag_category_color(get_cat_id($category->cat_name));
            if (!empty($color_code)) {
               $output .= '<a href="'.get_category_link( $category->term_id ).'" style="background:' . colormag_category_color(get_cat_id($category->cat_name)) . '" rel="category tag">'.$category->cat_name.'</a>'.$separator;
            } else {
               $output .= '<a href="'.get_category_link( $category->term_id ).'"  rel="category tag">'.$category->cat_name.'</a>'.$separator;
            }
      }
         $output .='</span></div>';
         echo trim($output, $separator);
      }
   }
endif;

/*
 * Just returning the value
 */
if ( !function_exists('colormag_colored_category_return') ) :
   function colormag_colored_category_return() {
      global $post;
      $categories = get_the_category();
      $separator = '&nbsp;';
      $output = '';
      if($categories) {
         $output .= '<div class="above-entry-meta"><span class="cat-links">';
         foreach($categories as $category) {
            $color_code = colormag_category_color(get_cat_id($category->cat_name));
            if (!empty($color_code)) {
               $output .= '<a href="'.get_category_link( $category->term_id ).'" style="background:' . colormag_category_color(get_cat_id($category->cat_name)) . '" rel="category tag">'.$category->cat_name.'</a>'.$separator;
            } else {
               $output .= '<a href="'.get_category_link( $category->term_id ).'"  rel="category tag">'.$category->cat_name.'</a>'.$separator;
            }
      }
         $output .='</span></div>';
         $output = trim($output, $separator);
      }
      return $output;
   }
endif;

/**************************************************************************************/

/*
 * Creating responsive video for posts/pages
 */
if ( !function_exists('colormag_responsive_video') ) :
   function colormag_responsive_video( $html, $url, $attr, $post_ID ) {
       return '<div class="fitvids-video">'.$html.'</div>';
   }
   add_filter( 'embed_oembed_html', 'colormag_responsive_video', 10, 4 ) ;
endif;

/**************************************************************************************/

/*
 * Use of the hooks for Category Color in the archive titles
 */
function colormag_colored_category_title($title) {
   $color_value = colormag_category_color(get_cat_id($title));
   $color_border_value = colormag_category_color(get_cat_id($title));
   if ( !empty($color_value) ) {
      return '<h3 class="page-title" style="border-bottom-color: '.$color_border_value.'">'.'<span style="background-color: '.$color_value.'">'.$title.'</span></h3>';
   } else {
      return '<h1 class="page-title"><span>'.$title.'</span></h1>';
   }
}
function colormag_category_title_function($category_title) {
   add_filter('single_cat_title', 'colormag_colored_category_title');
}
add_action('colormag_category_title','colormag_category_title_function');

/**************************************************************************************/

/*
 * Adding the custom meta box for supporting the post formats
 */
function colormag_post_format_meta_box() {
   add_meta_box( 'post-video-url', __('Video URL', 'colormag'), 'colormag_post_format_video_url', 'post', 'side', 'high' );
}
add_action( 'add_meta_boxes', 'colormag_post_format_meta_box' );

function colormag_post_format_video_url( $post ) {
   $video_post_id = get_post_custom( $post->ID );
   $video_post_url = isset( $video_post_id['video_url'] ) ? esc_attr( $video_post_id['video_url'][0] ) : '';
   wp_nonce_field( 'my_meta_box_nonce', 'meta_box_nonce' );
   ?>
      <p>
         <input type="text" class="widefat" name="video_url" id="video_url" value="<?php echo $video_post_url; ?>" />
      </p>
   <?php
}

function colormag_post_meta_save( $post_id ) {
   if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;

   // checking if the nonce isn't there, or we can't verify it, then we should return
   if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'my_meta_box_nonce' ) ) return;

   // checking if the current user can't edit this post, then we should return
   if( !current_user_can( 'edit_posts' ) ) return;

   // saving the data in meta box
   // saving the video url in the meta box
   if( isset( $_POST['video_url'] ) ) {
      update_post_meta( $post_id, 'video_url', esc_url_raw( $_POST['video_url'] ) );
   }
}

add_action( 'save_post', 'colormag_post_meta_save' );

function colormag_meta_box_display_toggle() {
   $custom_script = '
   <script type="text/javascript">
      jQuery(document).ready(function() {
         // hide the div by default
         jQuery( "#post-video-url" ).hide();

         // if post format is selected, then, display the respective div
         if(jQuery( "#post-format-video" ).is( ":checked" ))
            jQuery( "#post-video-url" ).show();

         // hiding the default post format type input box by default
         jQuery( "input[name=\"post_format\"]" ).change(function() {
            jQuery( "#post-video-url" ).hide();
         });

         // if post format is selected, then, display the respective input div
         jQuery( "input#post-format-video" ).change( function() {
            jQuery( "#post-video-url" ).show();
         });
      });
   </script>
   ';

   return print $custom_script;
}
add_action( 'admin_footer', 'colormag_meta_box_display_toggle' );

/**************************************************************************************/

/*
 * Post view counter function
 */
// function to display the total number of posts view
function colormag_post_view_display( $postID ) {
   $count_key = 'total_number_of_views';
   $count = get_post_meta( $postID, $count_key, true );
   if( $count == '' ) {
      delete_post_meta( $postID, $count_key );
      add_post_meta( $postID, $count_key, '0' );
      return '<span class="post-views"><i class="fa fa-eye"></i>' . '<span class="total-views">' . __( '0 View', 'colormag' ) . '</span></span>';
   } else {
      return '<span class="post-views"><i class="fa fa-eye"></i>' . '<span class="total-views">' . sprintf ( __( '%s Views', 'colormag' ), $count ) . '</span></span>';
   }
}

// function to count views for the posts
function colormag_post_view_setup( $postID ) {
   $count_key = 'total_number_of_views';
   $count = get_post_meta( $postID, $count_key, true );
   if( $count == '' ) {
      $count = 0;
      delete_post_meta( $postID, $count_key );
      add_post_meta( $postID, $count_key, '0' );
   } else {
      $count++;
      update_post_meta( $postID, $count_key, $count );
   }
}

// Adding the number of views count in the WordPress Posts Dashboard
add_filter( 'manage_posts_columns', 'colormag_posts_column_views' );
add_action( 'manage_posts_custom_column', 'colormag_posts_custom_column_views', 5, 2 );
function colormag_posts_column_views( $defaults ){
   $defaults[ 'post_views' ] = __( 'Total Views', 'colormag' );
   return $defaults;
}
function colormag_posts_custom_column_views( $column_name, $id ) {
   if( $column_name === 'post_views' ) {
      echo colormag_post_view_display( get_the_ID() );
   }
}

/**************************************************************************************/

/*
 * Adding the Custom Generated User Field
 */
add_action( 'show_user_profile', 'colormag_extra_user_field' );
add_action( 'edit_user_profile', 'colormag_extra_user_field' );
function colormag_extra_user_field( $user ) { ?>
   <h3><?php _e( 'User Social Links', 'colormag' ); ?></h3>
   <table class="form-table">
      <tr>
         <th><label for="colormag_twitter"><?php _e( 'Twitter', 'colormag' ); ?></label></th>
         <td>
            <input type="text" name="colormag_twitter" id="colormag_twitter" value="<?php echo esc_attr( get_the_author_meta( 'colormag_twitter', $user->ID ) ); ?>" class="regular-text" />
         </td>
      </tr>
      <tr>
         <th><label for="colormag_facebook"><?php _e( 'Facebook', 'colormag' ); ?></label></th>
         <td>
            <input type="text" name="colormag_facebook" id="colormag_facebook" value="<?php echo esc_attr( get_the_author_meta( 'colormag_facebook', $user->ID ) ); ?>" class="regular-text" />
         </td>
      </tr>
      <tr>
         <th><label for="colormag_google_plus"><?php _e( 'Google Plus', 'colormag' ); ?></label></th>
         <td>
            <input type="text" name="colormag_google_plus" id="colormag_google_plus" value="<?php echo esc_attr( get_the_author_meta( 'colormag_google_plus', $user->ID ) ); ?>" class="regular-text" />
         </td>
      </tr>
      <tr>
         <th><label for="colormag_flickr"><?php _e( 'Flickr', 'colormag' ); ?></label></th>
         <td>
            <input type="text" name="colormag_flickr" id="colormag_flickr" value="<?php echo esc_attr( get_the_author_meta( 'colormag_flickr', $user->ID ) ); ?>" class="regular-text" />
         </td>
      </tr>
      <tr>
         <th><label for="colormag_linkedin"><?php _e( 'LinkedIn', 'colormag' ); ?></label></th>
         <td>
            <input type="text" name="colormag_linkedin" id="colormag_linkedin" value="<?php echo esc_attr( get_the_author_meta( 'colormag_linkedin', $user->ID ) ); ?>" class="regular-text" />
         </td>
      </tr>
      <tr>
         <th><label for="colormag_instagram"><?php _e( 'Instagram', 'colormag' ); ?></label></th>
         <td>
            <input type="text" name="colormag_instagram" id="colormag_instagram" value="<?php echo esc_attr( get_the_author_meta( 'colormag_instagram', $user->ID ) ); ?>" class="regular-text" />
         </td>
      </tr>
      <tr>
         <th><label for="colormag_tumblr"><?php _e( 'Tumblr', 'colormag' ); ?></label></th>
         <td>
            <input type="text" name="colormag_tumblr" id="colormag_tumblr" value="<?php echo esc_attr( get_the_author_meta( 'colormag_tumblr', $user->ID ) ); ?>" class="regular-text" />
         </td>
      </tr>
      <tr>
         <th><label for="colormag_youtube"><?php _e( 'Youtube', 'colormag' ); ?></label></th>
         <td>
            <input type="text" name="colormag_youtube" id="colormag_youtube" value="<?php echo esc_attr( get_the_author_meta( 'colormag_youtube', $user->ID ) ); ?>" class="regular-text" />
         </td>
      </tr>
   </table>
<?php }

// Saving the user field used above
add_action( 'personal_options_update', 'colormag_extra_user_field_save_option' );
add_action( 'edit_user_profile_update', 'colormag_extra_user_field_save_option' );

function colormag_extra_user_field_save_option( $user_id ) {

   if ( !current_user_can( 'edit_user', $user_id ) )
      return false;

   update_user_meta( $user_id, 'colormag_twitter', wp_filter_nohtml_kses( $_POST['colormag_twitter'] ) );
   update_user_meta( $user_id, 'colormag_facebook', wp_filter_nohtml_kses( $_POST['colormag_facebook'] ) );
   update_user_meta( $user_id, 'colormag_google_plus', wp_filter_nohtml_kses( $_POST['colormag_google_plus'] ) );
   update_user_meta( $user_id, 'colormag_flickr', wp_filter_nohtml_kses( $_POST['colormag_flickr'] ) );
   update_user_meta( $user_id, 'colormag_linkedin', wp_filter_nohtml_kses( $_POST['colormag_linkedin'] ) );
   update_user_meta( $user_id, 'colormag_instagram', wp_filter_nohtml_kses( $_POST['colormag_instagram'] ) );
   update_user_meta( $user_id, 'colormag_tumblr', wp_filter_nohtml_kses( $_POST['colormag_tumblr'] ) );
   update_user_meta( $user_id, 'colormag_youtube', wp_filter_nohtml_kses( $_POST['colormag_youtube'] ) );
}

// fucntion to show the profile field data
function colormag_author_social_link() { ?>
   <ul class="author-social-sites">
      <?php if ( get_the_author_meta( 'colormag_twitter' ) ) { ?>
         <li class="twitter-link">
            <a href="http://twitter.com/<?php the_author_meta( 'colormag_twitter' ); ?>"><i class="fa fa-twitter"></i></a>
         </li>
      <?php } // End check for twitter ?>
      <?php if ( get_the_author_meta( 'colormag_facebook' ) ) { ?>
         <li class="facebook-link">
            <a href="http://facebook.com/<?php the_author_meta( 'colormag_facebook' ); ?>"><i class="fa fa-facebook"></i></a>
         </li>
      <?php } // End check for facebook ?>
      <?php if ( get_the_author_meta( 'colormag_google_plus' ) ) { ?>
         <li class="google_plus-link">
            <a href="http://plus.google.com/<?php the_author_meta( 'colormag_google_plus' ); ?>"><i class="fa fa-google-plus"></i></a>
         </li>
      <?php } // End check for google_plus ?>
      <?php if ( get_the_author_meta( 'colormag_flickr' ) ) { ?>
         <li class="flickr-link">
            <a href="http://flickr.com/<?php the_author_meta( 'colormag_flickr' ); ?>"><i class="fa fa-flickr"></i></a>
         </li>
      <?php } // End check for flickr ?>
      <?php if ( get_the_author_meta( 'colormag_linkedin' ) ) { ?>
         <li class="linkedin-link">
            <a href="http://linkedin.com/<?php the_author_meta( 'colormag_linkedin' ); ?>"><i class="fa fa-linkedin"></i></a>
         </li>
      <?php } // End check for linkedin ?>
      <?php if ( get_the_author_meta( 'colormag_instagram' ) ) { ?>
         <li class="instagram-link">
            <a href="http://instagram.com/<?php the_author_meta( 'colormag_instagram' ); ?>"><i class="fa fa-instagram"></i></a>
         </li>
      <?php } // End check for instagram ?>
      <?php if ( get_the_author_meta( 'colormag_tumblr' ) ) { ?>
         <li class="tumblr-link">
            <a href="http://tumblr.com/<?php the_author_meta( 'colormag_tumblr' ); ?>"><i class="fa fa-tumblr"></i></a>
         </li>
      <?php } // End check for tumblr ?>
      <?php if ( get_the_author_meta( 'colormag_youtube' ) ) { ?>
         <li class="youtube-link">
            <a href="http://youtube.com/<?php the_author_meta( 'colormag_youtube' ); ?>"><i class="fa fa-youtube"></i></a>
         </li>
      <?php } // End check for youtube ?>
   </ul><?php
}

/**************************************************************************************/

/* Register shortcodes. */
add_action( 'init', 'colormag_add_shortcodes' );
/**
 * Creates new shortcodes for use in any shortcode-ready area.  This function uses the add_shortcode()
 * function to register new shortcodes with WordPress.
 *
 * @uses add_shortcode() to create new shortcodes.
 */
function colormag_add_shortcodes() {
   /* Add theme-specific shortcodes. */
   add_shortcode( 'the-year', 'colormag_the_year_shortcode' );
   add_shortcode( 'site-link', 'colormag_site_link_shortcode' );
   add_shortcode( 'wp-link', 'colormag_wp_link_shortcode' );
   add_shortcode( 'tg-link', 'colormag_themegrill_link_shortcode' );
}

/**
 * Shortcode to display the current year.
 *
 * @uses date() Gets the current year.
 * @return string
 */
function colormag_the_year_shortcode() {
   return date( 'Y' );
}

/**
 * Shortcode to display a link back to the site.
 *
 * @uses get_bloginfo() Gets the site link
 * @return string
 */
function colormag_site_link_shortcode() {
   return '<a href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '" ><span>' . get_bloginfo( 'name', 'display' ) . '</span></a>';
}

/**
 * Shortcode to display a link to WordPress.org.
 *
 * @return string
 */
function colormag_wp_link_shortcode() {
   return '<a href="' .esc_url( 'http://wordpress.org' ). '" target="_blank" title="' . esc_attr__( 'WordPress', 'colormag' ) . '"><span>' . __( 'WordPress', 'colormag' ) . '</span></a>';
}

/**
 * Shortcode to display a link to colormag.com.
 *
 * @return string
 */
function colormag_themegrill_link_shortcode() {
   return '<a href="' .esc_url( 'http://themegrill.com/themes/colormag-pro' ) .'" target="_blank" title="'.esc_attr__( 'ThemeGrill', 'colormag' ).'" rel="designer"><span>'.__( 'ThemeGrill', 'colormag') .'</span></a>';
}

add_action( 'colormag_footer_copyright', 'colormag_footer_copyright', 10 );
/**
 * function to show the footer info, copyright information
 */
if ( ! function_exists( 'colormag_footer_copyright' ) ) :
function colormag_footer_copyright() {
   $default_footer_value = get_theme_mod( 'colormag_footer_editor', __( 'Copyright &copy; ', 'colormag' ).'[the-year] [site-link]. All rights reserved. '.'<br>'.__( 'Theme: ColorMag Pro by ', 'colormag' ).'[tg-link]. '.__( 'Powered by ', 'colormag' ).'[wp-link].' );
   $colormag_footer_copyright = '<div class="copyright">'.$default_footer_value.'</div>';
   echo do_shortcode( $colormag_footer_copyright );
}
endif;

/****************************************************************************************/

if ( ! function_exists( 'colormag_font_size_range_generator' ) ) :
/**
 * Function to generate font size range for font size options.
 */
function colormag_font_size_range_generator( $start_range, $end_range ) {
   $range_string = array();
   for( $i = $start_range; $i <= $end_range; $i++ ) {
      $range_string[$i] = $i;
   }
   return $range_string;
}
endif;

 /*
 * Unique Post Display function
 *
 * The following sets of fucntions help in removing the duplicate posts from being shown
 * in a page.
 *
 * colormag_exclude_duplicate_posts() - Excluding the Duplicate posts in featured posts widget
 * colormag_append_excluded_duplicate_posts() - Appending the duplicate posts
 */

function colormag_exclude_duplicate_posts() {
   global $colormag_duplicate_posts;

   if ( get_theme_mod('colormag_unique_post_system', 0) == 1 ) {
      $post__not_in = $colormag_duplicate_posts;
   }
   else {
      $post__not_in = array();
   }

   return $post__not_in;
}

function colormag_append_excluded_duplicate_posts( $featured_posts ) {
   global $colormag_duplicate_posts;

   if ( get_theme_mod('colormag_unique_post_system', 0) == 1 ) {
      $post_ids = wp_list_pluck( $featured_posts->posts, 'ID' );
      $colormag_duplicate_posts = array_unique( array_merge( $colormag_duplicate_posts, $post_ids ) );
   }
   else {
      return;
   }
}

/**************************************************************************************/

/**
 * Making the theme Woocommrece compatible
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );

add_filter( 'woocommerce_show_page_title', '__return_false' );

add_action('woocommerce_before_main_content', 'colormag_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'colormag_wrapper_end', 10);

function colormag_wrapper_start() {
  echo '<div id="primary">';
}

function colormag_wrapper_end() {
  echo '</div>';
}
?>