<?php
/**
 * Contains all the functions related to sidebar and widget.
 *
 * @package ThemeGrill
 * @subpackage ColorMag
 * @since ColorMag 1.0
 */

add_action( 'widgets_init', 'colormag_widgets_init');
/**
 * Function to register the widget areas(sidebar) and widgets.
 */
function colormag_widgets_init() {

   /**
    * Registering widget areas for front page
    */
   // Registering main right sidebar
   register_sidebar( array(
      'name'            => __( 'Right Sidebar', 'colormag' ),
      'id'              => 'colormag_right_sidebar',
      'description'     => __( 'Shows widgets at Right side.', 'colormag' ),
      'before_widget'   => '<aside id="%1$s" class="widget %2$s clearfix">',
      'after_widget'    => '</aside>',
      'before_title'    => '<h3 class="widget-title"><span>',
      'after_title'     => '</span></h3>'
   ) );

   // Registering main left sidebar
   register_sidebar( array(
      'name'            => __( 'Left Sidebar', 'colormag' ),
      'id'              => 'colormag_left_sidebar',
      'description'     => __( 'Shows widgets at Left side.', 'colormag' ),
      'before_widget'   => '<aside id="%1$s" class="widget %2$s clearfix">',
      'after_widget'    => '</aside>',
      'before_title'    => '<h3 class="widget-title"><span>',
      'after_title'     => '</span></h3>'
   ) );

   // Registering Header sidebar
   register_sidebar( array(
      'name'            => __( 'Header Sidebar', 'colormag' ),
      'id'              => 'colormag_header_sidebar',
      'description'     => __( 'Shows widgets in header section just above the main navigation menu.', 'colormag' ),
      'before_widget'   => '<aside id="%1$s" class="widget %2$s clearfix">',
      'after_widget'    => '</aside>',
      'before_title'    => '<h3 class="widget-title">',
      'after_title'     => '</h3>'
   ) );

   // registering the Front Page: Top Full width Area
   register_sidebar( array(
      'name'            => __( 'Front Page: Top Full Width Area', 'colormag' ),
      'id'              => 'colormag_front_page_top_full_width_area',
      'description'     => __( 'Show widget just below menu.', 'colormag' ),
      'before_widget'   => '<section id="%1$s" class="widget %2$s clearfix">',
      'after_widget'    => '</section>',
      'before_title'    => '<h3 class="widget-title"><span>',
      'after_title'     => '</span></h3>'
   ) );

   // registering the Front Page: Slider Area Sidebar
   register_sidebar( array(
      'name'            => __( 'Front Page: Slider Area', 'colormag' ),
      'id'              => 'colormag_front_page_slider_area',
      'description'     => __( 'Show widget just below menu. Suitable for TG: Featured Cat Slider.', 'colormag' ),
      'before_widget'   => '<section id="%1$s" class="widget %2$s clearfix">',
      'after_widget'    => '</section>',
      'before_title'    => '<h3 class="widget-title"><span>',
      'after_title'     => '</span></h3>'
   ) );

   // registering the Front Page: Area beside slider Sidebar
   register_sidebar( array(
      'name'            => __( 'Front Page: Area beside slider', 'colormag' ),
      'id'              => 'colormag_front_page_area_beside_slider',
      'description'     => __( 'Show widget beside the slider. Suitable for TG: Highlighted Posts.', 'colormag' ),
      'before_widget'   => '<section id="%1$s" class="widget %2$s clearfix">',
      'after_widget'    => '</section>',
      'before_title'    => '<h3 class="widget-title"><span>',
      'after_title'     => '</span></h3>'
   ) );

   // registering the Front Page: Content Top Section Sidebar
   register_sidebar( array(
      'name'            => __( 'Front Page: Content Top Section', 'colormag' ),
      'id'              => 'colormag_front_page_content_top_section',
      'description'     => __( 'Content Top Section', 'colormag' ),
      'before_widget'   => '<section id="%1$s" class="widget %2$s clearfix">',
      'after_widget'    => '</section>',
      'before_title'    => '<h3 class="widget-title"><span>',
      'after_title'     => '</span></h3>'
   ) );

   // registering the Front Page: Content Middle Left Section Sidebar
   register_sidebar( array(
      'name'            => __( 'Front Page: Content Middle Left Section', 'colormag' ),
      'id'              => 'colormag_front_page_content_middle_left_section',
      'description'     => __( 'Content Middle Left Section', 'colormag' ),
      'before_widget'   => '<section id="%1$s" class="widget %2$s clearfix">',
      'after_widget'    => '</section>',
      'before_title'    => '<h3 class="widget-title"><span>',
      'after_title'     => '</span></h3>'
   ) );

   // registering the Front Page: Content Middle Right Section Sidebar
   register_sidebar( array(
      'name'            => __( 'Front Page: Content Middle Right Section', 'colormag' ),
      'id'              => 'colormag_front_page_content_middle_right_section',
      'description'     => __( 'Content Middle Right Section', 'colormag' ),
      'before_widget'   => '<section id="%1$s" class="widget %2$s clearfix">',
      'after_widget'    => '</section>',
      'before_title'    => '<h3 class="widget-title"><span>',
      'after_title'     => '</span></h3>'
   ) );

   // registering the Front Page: Content Bottom Section Sidebar
   register_sidebar( array(
      'name'            => __( 'Front Page: Content Bottom Section', 'colormag' ),
      'id'              => 'colormag_front_page_content_bottom_section',
      'description'     => __( 'Content Middle Bottom Section', 'colormag' ),
      'before_widget'   => '<section id="%1$s" class="widget %2$s clearfix">',
      'after_widget'    => '</section>',
      'before_title'    => '<h3 class="widget-title"><span>',
      'after_title'     => '</span></h3>'
   ) );

   // Registering contact Page sidebar
   register_sidebar( array(
      'name'            => __( 'Contact Page Sidebar', 'colormag' ),
      'id'              => 'colormag_contact_page_sidebar',
      'description'     => __( 'Shows widgets on Contact Page Template.', 'colormag' ),
      'before_widget'   => '<aside id="%1$s" class="widget %2$s clearfix">',
      'after_widget'    => '</aside>',
      'before_title'    => '<h3 class="widget-title"><span>',
      'after_title'     => '</span></h3>'
   ) );

   // Registering Error 404 Page sidebar
   register_sidebar( array(
      'name'            => __( 'Error 404 Page Sidebar', 'colormag' ),
      'id'              => 'colormag_error_404_page_sidebar',
      'description'     => __( 'Shows widgets on Error 404 page.', 'colormag' ),
      'before_widget'   => '<aside id="%1$s" class="widget %2$s clearfix">',
      'after_widget'    => '</aside>',
      'before_title'    => '<h3 class="widget-title"><span>',
      'after_title'     => '</span></h3>'
   ) );

   // Registering advertisement above footer sidebar
   register_sidebar( array(
      'name'            => __( 'Advertisement Above The Footer', 'colormag' ),
      'id'              => 'colormag_advertisement_above_the_footer_sidebar',
      'description'     => __( 'Shows widgets Just Above The Footer, suitable for TG: 728x90 widget.', 'colormag' ),
      'before_widget'   => '<aside id="%1$s" class="widget %2$s clearfix">',
      'after_widget'    => '</aside>',
      'before_title'    => '<h3 class="widget-title"><span>',
      'after_title'     => '</span></h3>'
   ) );

   // Registering footer sidebar one upper
   register_sidebar( array(
      'name'            => __( 'Footer Sidebar One ( Upper )', 'colormag' ),
      'id'              => 'colormag_footer_sidebar_one_upper',
      'description'     => __( 'Shows widgets at footer sidebar one in upper.', 'colormag' ),
      'before_widget'   => '<aside id="%1$s" class="widget %2$s clearfix">',
      'after_widget'    => '</aside>',
      'before_title'    => '<h3 class="widget-title"><span>',
      'after_title'     => '</span></h3>'
   ) );

   // Registering footer sidebar two upper
   register_sidebar( array(
      'name'            => __( 'Footer Sidebar Two ( Upper )', 'colormag' ),
      'id'              => 'colormag_footer_sidebar_two_upper',
      'description'     => __( 'Shows widgets at footer sidebar two in upper.', 'colormag' ),
      'before_widget'   => '<aside id="%1$s" class="widget %2$s clearfix">',
      'after_widget'    => '</aside>',
      'before_title'    => '<h3 class="widget-title"><span>',
      'after_title'     => '</span></h3>'
   ) );

   // Registering footer sidebar three upper
   register_sidebar( array(
      'name'            => __( 'Footer Sidebar Three ( Upper )', 'colormag' ),
      'id'              => 'colormag_footer_sidebar_three_upper',
      'description'     => __( 'Shows widgets at footer sidebar three in upper.', 'colormag' ),
      'before_widget'   => '<aside id="%1$s" class="widget %2$s clearfix">',
      'after_widget'    => '</aside>',
      'before_title'    => '<h3 class="widget-title"><span>',
      'after_title'     => '</span></h3>'
   ) );

	// Registering footer sidebar one
	register_sidebar( array(
		'name' 				=> __( 'Footer Sidebar One ( Lower )', 'colormag' ),
		'id' 					=> 'colormag_footer_sidebar_one',
		'description'   	=> __( 'Shows widgets at footer sidebar one.', 'colormag' ),
		'before_widget' 	=> '<aside id="%1$s" class="widget %2$s clearfix">',
		'after_widget'  	=> '</aside>',
		'before_title'  	=> '<h3 class="widget-title"><span>',
		'after_title'   	=> '</span></h3>'
	) );

	// Registering footer sidebar two
	register_sidebar( array(
		'name' 				=> __( 'Footer Sidebar Two ( Lower )', 'colormag' ),
		'id' 					=> 'colormag_footer_sidebar_two',
		'description'   	=> __( 'Shows widgets at footer sidebar two.', 'colormag' ),
		'before_widget' 	=> '<aside id="%1$s" class="widget %2$s clearfix">',
		'after_widget'  	=> '</aside>',
		'before_title'  	=> '<h3 class="widget-title"><span>',
		'after_title'   	=> '</span></h3>'
	) );

   // Registering footer sidebar three
   register_sidebar( array(
      'name'            => __( 'Footer Sidebar Three ( Lower )', 'colormag' ),
      'id'              => 'colormag_footer_sidebar_three',
      'description'     => __( 'Shows widgets at footer sidebar three.', 'colormag' ),
      'before_widget'   => '<aside id="%1$s" class="widget %2$s clearfix">',
      'after_widget'    => '</aside>',
      'before_title'    => '<h3 class="widget-title"><span>',
      'after_title'     => '</span></h3>'
   ) );

   // Registering footer sidebar four
   register_sidebar( array(
      'name'            => __( 'Footer Sidebar Four ( Lower )', 'colormag' ),
      'id'              => 'colormag_footer_sidebar_four',
      'description'     => __( 'Shows widgets at footer sidebar four.', 'colormag' ),
      'before_widget'   => '<aside id="%1$s" class="widget %2$s clearfix">',
      'after_widget'    => '</aside>',
      'before_title'    => '<h3 class="widget-title"><span>',
      'after_title'     => '</span></h3>'
   ) );

   register_widget( "colormag_featured_posts_slider_widget" );
   register_widget( "colormag_highlighted_posts_widget" );
   register_widget( "colormag_featured_posts_widget" );
   register_widget( "colormag_featured_posts_vertical_widget" );
   register_widget( "colormag_728x90_advertisement_widget" );
   register_widget( "colormag_300x250_advertisement_widget" );
   register_widget( "colormag_125x125_advertisement_widget" );
   // Pro Options
   register_widget( "colormag_video_widget" );
   register_widget( "colormag_news_in_picture_widget" );
   register_widget( "colormag_default_news_widget" );
   register_widget( "colormag_tabbed_widget" );
   register_widget( "colormag_random_post_widget" );
   register_widget( "colormag_slider_news_widget" );
   register_widget( "colormag_breaking_news_widget" );
   register_widget( "colormag_ticker_news_widget" );
   register_widget( "colormag_featured_posts_small_thumbnails" );
}

/****************************************************************************************/

/**
 * Featured Posts widget
 */
class colormag_featured_posts_slider_widget extends WP_Widget {

   function __construct() {
      $widget_ops = array( 'classname' => 'widget_featured_slider widget_featured_meta', 'description' => __( 'Display latest posts or posts of specific category, which will be used as the slider.', 'colormag') );
      $control_ops = array( 'width' => 200, 'height' =>250 );
      parent::__construct( false,$name= __( 'TG: Featured Category Slider', 'colormag' ),$widget_ops);
   }

   function form( $instance ) {
      $tg_defaults['number'] = 4;
      $tg_defaults['type'] = 'latest';
      $tg_defaults['category'] = '';
      $tg_defaults['image_size'] = 'medium';
      $instance = wp_parse_args( (array) $instance, $tg_defaults );
      $number = $instance['number'];
      $type = $instance['type'];
      $category = $instance['category'];
      $image_size = $instance['image_size'];
      ?>
      <p>
         <label for="<?php echo $this->get_field_id('number'); ?>"><?php _e( 'Number of posts to display:', 'colormag' ); ?></label>
         <input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" />
      </p>

      <p><input type="radio" <?php checked($type, 'latest') ?> id="<?php echo $this->get_field_id( 'type' ); ?>" name="<?php echo $this->get_field_name( 'type' ); ?>" value="latest"/><?php _e( 'Show latest Posts', 'colormag' );?><br />
       <input type="radio" <?php checked($type,'category') ?> id="<?php echo $this->get_field_id( 'type' ); ?>" name="<?php echo $this->get_field_name( 'type' ); ?>" value="category"/><?php _e( 'Show posts from a category', 'colormag' );?><br /></p>

      <p>
         <label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php _e( 'Select category', 'colormag' ); ?>:</label>
         <?php wp_dropdown_categories( array( 'show_option_none' =>' ','name' => $this->get_field_name( 'category' ), 'selected' => $category ) ); ?>
      </p>
      <p><?php _e( 'Image Size:', 'colormag' ); ?></p>
      <p><input type="radio" <?php checked($image_size, 'medium') ?> id="<?php echo $this->get_field_id( 'image_size' ); ?>" name="<?php echo $this->get_field_name( 'image_size' ); ?>" value="medium"/><?php _e( 'Image Size medium (800X445 pixels)', 'colormag' );?><br />
       <input type="radio" <?php checked($image_size,'large') ?> id="<?php echo $this->get_field_id( 'image_size' ); ?>" name="<?php echo $this->get_field_name( 'image_size' ); ?>" value="large"/><?php _e( 'Image Size large (1400X600 pixels, suitable for Front Page: Top Full Width Area)', 'colormag' );?><br /></p>

      <?php
   }

   function update( $new_instance, $old_instance ) {
      $instance = $old_instance;
      $instance[ 'number' ] = absint( $new_instance[ 'number' ] );
      $instance[ 'type' ] = $new_instance[ 'type' ];
      $instance[ 'category' ] = $new_instance[ 'category' ];
      $instance[ 'image_size' ] = $new_instance[ 'image_size' ];

      return $instance;
   }

   function widget( $args, $instance ) {
      if ( is_active_widget( false, false, $this->id_base ) || is_customize_preview() ) {
         wp_enqueue_script('colormag-bxslider');
      }
      extract( $args );
      extract( $instance );

      global $post;
      $number = empty( $instance[ 'number' ] ) ? 4 : $instance[ 'number' ];
      $type = isset( $instance[ 'type' ] ) ? $instance[ 'type' ] : 'latest' ;
      $category = isset( $instance[ 'category' ] ) ? $instance[ 'category' ] : '';
      $image_size = isset( $instance[ 'image_size' ] ) ? $instance[ 'image_size' ] : 'medium';

      // adding the excluding post function
      $post__not_in = colormag_exclude_duplicate_posts();

      if( $type == 'latest' ) {
         $get_featured_posts = new WP_Query( array(
            'posts_per_page'        => $number,
            'post_type'             => 'post',
            'ignore_sticky_posts'   => true,
            'no_found_rows'         => true,
            'post__not_in'          => $post__not_in
         ) );
      }
      else {
         $get_featured_posts = new WP_Query( array(
            'posts_per_page'        => $number,
            'post_type'             => 'post',
            'category__in'          => $category,
            'no_found_rows'         => true,
            'post__not_in'          => $post__not_in
         ) );
      }

      colormag_append_excluded_duplicate_posts( $get_featured_posts );
      echo $before_widget;
      ?>
      <div class="widget_featured_slider_inner_wrap clearfix">
         <?php if ( $image_size == 'medium' ) {
            $featured = 'colormag-featured-image';
         } else {
            $featured = 'colormag-featured-image-large';
         }
         ?>
            <div class="widget_slider_area_rotate">
            <?php
            $i=1;
            while( $get_featured_posts->have_posts() ):$get_featured_posts->the_post();

               if ( $i == 1 ) { $classes = "single-slide displayblock"; } else { $classes = "single-slide displaynone"; }

               ?>
               <div class="<?php echo $classes; ?>">
                  <?php
                  if( has_post_thumbnail() ) {
                     $image = '';
                     $title_attribute = get_the_title( $post->ID );
                     $image .= '<figure class="slider-featured-image">';
                     $image .= '<a href="' . get_permalink() . '" title="'.the_title( '', '', false ).'">';
                     $image .= get_the_post_thumbnail( $post->ID, $featured, array( 'title' => esc_attr( $title_attribute ), 'alt' => esc_attr( $title_attribute ) ) ).'</a>';
                     $image .= '</figure>';
                     echo $image;
                  } else { ?>
                     <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                        <img src="<?php echo get_template_directory_uri(); ?>/img/slider-featured-image.png">
                     </a>
                  <?php }
                  ?>
                  <div class="slide-content">
                     <?php colormag_colored_category(); ?>
                     <h3 class="entry-title">
                        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute();?>"><?php the_title(); ?></a>
                     </h3>
                     <div class="below-entry-meta">
                        <?php
                           $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
                           $time_string = sprintf( $time_string,
                              esc_attr( get_the_date( 'c' ) ),
                              esc_html( get_the_date() )
                           );
                           printf( __( '<span class="posted-on"><a href="%1$s" title="%2$s" rel="bookmark"><i class="fa fa-calendar-o"></i> %3$s</a></span>', 'colormag' ),
                              esc_url( get_permalink() ),
                              esc_attr( get_the_time() ),
                              $time_string
                           );
                        ?>
                        <span class="byline"><span ><i class="fa fa-user"></i><a class="url fn n" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" title="<?php echo get_the_author(); ?>"><?php echo esc_html( get_the_author() ); ?></a></span></span>
                        <span class="comments"><i class="fa fa-comment"></i><?php comments_popup_link( '0', '1', '%' );?></span>
                     </div>
                  </div>

               </div>
            <?php
               $i++;
            endwhile;
            // Reset Post Data
            wp_reset_query();
            ?>
         </div>
      </div>
      <?php echo $after_widget;
      }
}

/**
 * Highlighted Posts widget
 */
class colormag_highlighted_posts_widget extends WP_Widget {

   function __construct() {
      $widget_ops = array( 'classname' => 'widget_highlighted_posts widget_featured_meta', 'description' => __( 'Display latest posts or posts of specific category. Suitable for the Area Beside Slider Sidebar.', 'colormag') );
      $control_ops = array( 'width' => 200, 'height' =>250 );
      parent::__construct( false,$name= __( 'TG: Highligted Posts', 'colormag' ),$widget_ops);
   }

   function form( $instance ) {
      $tg_defaults['number'] = 4;
      $tg_defaults['type'] = 'latest';
      $tg_defaults['category'] = '';
      $instance = wp_parse_args( (array) $instance, $tg_defaults );
      $number = $instance['number'];
      $type = $instance['type'];
      $category = $instance['category'];
      ?>
      <p>
         <label for="<?php echo $this->get_field_id('number'); ?>"><?php _e( 'Number of posts to display:', 'colormag' ); ?></label>
         <input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" />
      </p>

      <p><input type="radio" <?php checked($type, 'latest') ?> id="<?php echo $this->get_field_id( 'type' ); ?>" name="<?php echo $this->get_field_name( 'type' ); ?>" value="latest"/><?php _e( 'Show latest Posts', 'colormag' );?><br />
       <input type="radio" <?php checked($type,'category') ?> id="<?php echo $this->get_field_id( 'type' ); ?>" name="<?php echo $this->get_field_name( 'type' ); ?>" value="category"/><?php _e( 'Show posts from a category', 'colormag' );?><br /></p>

      <p>
         <label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php _e( 'Select category', 'colormag' ); ?>:</label>
         <?php wp_dropdown_categories( array( 'show_option_none' =>' ','name' => $this->get_field_name( 'category' ), 'selected' => $category ) ); ?>
      </p>
      <?php
   }

   function update( $new_instance, $old_instance ) {
      $instance = $old_instance;
      $instance[ 'number' ] = absint( $new_instance[ 'number' ] );
      $instance[ 'type' ] = $new_instance[ 'type' ];
      $instance[ 'category' ] = $new_instance[ 'category' ];

      return $instance;
   }

   function widget( $args, $instance ) {
      extract( $args );
      extract( $instance );

      global $post;
      $number = empty( $instance[ 'number' ] ) ? 4 : $instance[ 'number' ];
      $type = isset( $instance[ 'type' ] ) ? $instance[ 'type' ] : 'latest' ;
      $category = isset( $instance[ 'category' ] ) ? $instance[ 'category' ] : '';

      // adding the excluding post function
      $post__not_in = colormag_exclude_duplicate_posts();

      if( $type == 'latest' ) {
         $get_featured_posts = new WP_Query( array(
            'posts_per_page'        => $number,
            'post_type'             => 'post',
            'ignore_sticky_posts'   => true,
            'no_found_rows'         => true,
            'post__not_in'          => $post__not_in
         ) );
      }
      else {
         $get_featured_posts = new WP_Query( array(
            'posts_per_page'        => $number,
            'post_type'             => 'post',
            'category__in'          => $category,
            'no_found_rows'         => true,
            'post__not_in'          => $post__not_in
         ) );
      }

      colormag_append_excluded_duplicate_posts( $get_featured_posts );
      echo $before_widget;
      ?>
      <div class="widget_highlighted_post_area">
      <?php $featured = 'colormag-highlighted-post'; ?>
         <?php
         $i=1;
         while( $get_featured_posts->have_posts() ):$get_featured_posts->the_post();
            ?>
            <div class="single-article">
               <?php
               if( has_post_thumbnail() ) {
                  $image = '';
                  $title_attribute = get_the_title( $post->ID );
                  $image .= '<figure class="highlights-featured-image">';
                  $image .= '<a href="' . get_permalink() . '" title="'.the_title( '', '', false ).'">';
                  $image .= get_the_post_thumbnail( $post->ID, $featured, array( 'title' => esc_attr( $title_attribute ), 'alt' => esc_attr( $title_attribute ) ) ).'</a>';
                  $image .= '</figure>';
                  echo $image;
               } else { ?>
                  <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                     <img src="<?php echo get_template_directory_uri(); ?>/img/highlights-featured-image.png">
                  </a>
               <?php }
               ?>
               <div class="article-content">
                  <?php colormag_colored_category(); ?>
                  <h3 class="entry-title">
                     <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute();?>"><?php the_title(); ?></a>
                  </h3>
                  <div class="below-entry-meta">
                     <?php
                        $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
                        $time_string = sprintf( $time_string,
                           esc_attr( get_the_date( 'c' ) ),
                           esc_html( get_the_date() )
                        );
                        printf( __( '<span class="posted-on"><a href="%1$s" title="%2$s" rel="bookmark"><i class="fa fa-calendar-o"></i> %3$s</a></span>', 'colormag' ),
                           esc_url( get_permalink() ),
                           esc_attr( get_the_time() ),
                           $time_string
                        );
                     ?>
                     <span class="byline"><span ><i class="fa fa-user"></i><a class="url fn n" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" title="<?php echo get_the_author(); ?>"><?php echo esc_html( get_the_author() ); ?></a></span></span>
                     <span class="comments"><i class="fa fa-comment"></i><?php comments_popup_link( '0', '1', '%' );?></span>
                  </div>
               </div>

            </div>
         <?php
            $i++;
         endwhile;
         // Reset Post Data
         wp_reset_query();
         ?>
      </div>
      <?php echo $after_widget;
      }
}

/**
 * Featured Posts widget
 */
class colormag_featured_posts_widget extends WP_Widget {

   function __construct() {
      $widget_ops = array( 'classname' => 'widget_featured_posts widget_featured_meta', 'description' => __( 'Display latest posts or posts of specific category.' , 'colormag') );
      $control_ops = array( 'width' => 200, 'height' =>250 );
      parent::__construct( false,$name= __( 'TG: Featured Posts (Style 1)', 'colormag' ),$widget_ops);
   }

   function form( $instance ) {
      $tg_defaults['title'] = '';
      $tg_defaults['text'] = '';
      $tg_defaults['number'] = 4;
      $tg_defaults['type'] = 'latest';
      $tg_defaults['category'] = '';
      $instance = wp_parse_args( (array) $instance, $tg_defaults );
      $title = esc_attr( $instance[ 'title' ] );
      $text = esc_textarea($instance['text']);
      $number = $instance['number'];
      $type = $instance['type'];
      $category = $instance['category'];
      ?>
      <p><?php _e( 'Layout will be as below:', 'colormag' ) ?></p>
      <div style="text-align: center;"><img src="<?php echo get_template_directory_uri() . '/img/style-1.jpg'?>"></div>
      <p>
         <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:', 'colormag' ); ?></label>
         <input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
      </p>
      <?php _e( 'Description','colormag' ); ?>
      <textarea class="widefat" rows="5" cols="20" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo $text; ?></textarea>
      <p>
         <label for="<?php echo $this->get_field_id('number'); ?>"><?php _e( 'Number of posts to display:', 'colormag' ); ?></label>
         <input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" />
      </p>

      <p><input type="radio" <?php checked($type, 'latest') ?> id="<?php echo $this->get_field_id( 'type' ); ?>" name="<?php echo $this->get_field_name( 'type' ); ?>" value="latest"/><?php _e( 'Show latest Posts', 'colormag' );?><br />
       <input type="radio" <?php checked($type,'category') ?> id="<?php echo $this->get_field_id( 'type' ); ?>" name="<?php echo $this->get_field_name( 'type' ); ?>" value="category"/><?php _e( 'Show posts from a category', 'colormag' );?><br /></p>

      <p>
         <label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php _e( 'Select category', 'colormag' ); ?>:</label>
         <?php wp_dropdown_categories( array( 'show_option_none' =>' ','name' => $this->get_field_name( 'category' ), 'selected' => $category ) ); ?>
      </p>
      <?php
   }

   function update( $new_instance, $old_instance ) {
      $instance = $old_instance;
      $instance[ 'title' ] = strip_tags( $new_instance[ 'title' ] );
      if ( current_user_can('unfiltered_html') )
         $instance['text'] =  $new_instance['text'];
      else
         $instance['text'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['text']) ) );
      $instance[ 'number' ] = absint( $new_instance[ 'number' ] );
      $instance[ 'type' ] = $new_instance[ 'type' ];
      $instance[ 'category' ] = $new_instance[ 'category' ];

      return $instance;
   }

   function widget( $args, $instance ) {
      extract( $args );
      extract( $instance );

      global $post;
      $title = apply_filters( 'widget_title', isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : '' );
      $text = isset( $instance[ 'text' ] ) ? $instance[ 'text' ] : '';
      $number = empty( $instance[ 'number' ] ) ? 4 : $instance[ 'number' ];
      $type = isset( $instance[ 'type' ] ) ? $instance[ 'type' ] : 'latest' ;
      $category = isset( $instance[ 'category' ] ) ? $instance[ 'category' ] : '';

      // For WPML plugin compatibility
      if ( function_exists( 'icl_register_string' ) ) {
         icl_register_string( 'ColorMag Pro', 'TG: Featured Posts (Style 1) Description' . $this->id, $text );
      }

      // adding the excluding post function
      $post__not_in = colormag_exclude_duplicate_posts();

      if( $type == 'latest' ) {
         $get_featured_posts = new WP_Query( array(
            'posts_per_page'        => $number,
            'post_type'             => 'post',
            'ignore_sticky_posts'   => true,
            'no_found_rows'         => true,
            'post__not_in'          => $post__not_in
         ) );
      }
      else {
         $get_featured_posts = new WP_Query( array(
            'posts_per_page'        => $number,
            'post_type'             => 'post',
            'category__in'          => $category,
            'no_found_rows'         => true,
            'post__not_in'          => $post__not_in
         ) );
      }

      colormag_append_excluded_duplicate_posts( $get_featured_posts );
      echo $before_widget;
      ?>
      <?php
         if ( $type != 'latest' ) {
            $border_color = 'style="border-bottom-color:' . colormag_category_color($category) . ';"';
            $title_color = 'style="background-color:' . colormag_category_color($category) . ';"';
         } else {
            $border_color = '';
            $title_color = '';
         }
         // For WPML plugin compatibility
         if ( function_exists( 'icl_t' ) ) {
            $text = icl_t( 'ColorMag Pro', 'TG: Featured Posts (Style 1) Description' . $this->id, $text );
         }
         if ( !empty( $title ) ) { echo '<h3 class="widget-title" '. $border_color .'><span ' . $title_color .'>'. esc_html( $title ) .'</span></h3>'; }
         if( !empty( $text ) ) { ?> <p> <?php echo esc_textarea( $text ); ?> </p> <?php } ?>
         <?php
         $i=1;
         while( $get_featured_posts->have_posts() ):$get_featured_posts->the_post();
            ?>
            <?php if( $i == 1 ) { $featured = 'colormag-featured-post-medium'; } else { $featured = 'colormag-featured-post-small'; } ?>
            <?php if( $i == 1 ) { echo '<div class="first-post">'; } elseif ( $i == 2 ) { echo '<div class="following-post">'; } ?>
               <div class="single-article clearfix">
                  <?php
                  if( has_post_thumbnail() ) {
                     $image = '';
                     $title_attribute = get_the_title( $post->ID );
                     $image .= '<figure>';
                     $image .= '<a href="' . get_permalink() . '" title="'.the_title( '', '', false ).'">';
                     $image .= get_the_post_thumbnail( $post->ID, $featured, array( 'title' => esc_attr( $title_attribute ), 'alt' => esc_attr( $title_attribute ) ) ).'</a>';
                     $image .= '</figure>';
                     echo $image;
                  }
                  ?>
                  <div class="article-content">
                     <?php colormag_colored_category(); ?>
                     <h3 class="entry-title">
                        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute();?>"><?php the_title(); ?></a>
                     </h3>
                     <div class="below-entry-meta">
                        <?php
                           $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
                           $time_string = sprintf( $time_string,
                              esc_attr( get_the_date( 'c' ) ),
                              esc_html( get_the_date() )
                           );
                           printf( __( '<span class="posted-on"><a href="%1$s" title="%2$s" rel="bookmark"><i class="fa fa-calendar-o"></i> %3$s</a></span>', 'colormag' ),
                              esc_url( get_permalink() ),
                              esc_attr( get_the_time() ),
                              $time_string
                           );
                        ?>
                        <span class="byline"><span ><i class="fa fa-user"></i><a class="url fn n" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" title="<?php echo get_the_author(); ?>"><?php echo esc_html( get_the_author() ); ?></a></span></span>
                        <span class="comments"><i class="fa fa-comment"></i><?php comments_popup_link( '0', '1', '%' );?></span>
                     </div>
                     <?php if( $i == 1 ) { ?>
                     <div class="entry-content">
                        <?php the_excerpt(); ?>
                     </div>
                     <?php } ?>
                  </div>

               </div>
            <?php if( $i == 1 ) { echo '</div>'; } ?>
         <?php
            $i++;
         endwhile;
         if ( $i > 2 ) { echo '</div>'; }
         // Reset Post Data
         wp_reset_query();
         ?>
      <!-- </div> -->
      <?php echo $after_widget;
      }
}

/**
 * Featured Posts widget
 */
class colormag_featured_posts_vertical_widget extends WP_Widget {

   function __construct() {
      $widget_ops = array( 'classname' => 'widget_featured_posts widget_featured_posts_vertical widget_featured_meta', 'description' => __( 'Display latest posts or posts of specific category.', 'colormag') );
      $control_ops = array( 'width' => 200, 'height' =>250 );
      parent::__construct( false,$name= __( 'TG: Featured Posts (Style 2)', 'colormag' ),$widget_ops);
   }

   function form( $instance ) {
      $tg_defaults['title'] = '';
      $tg_defaults['text'] = '';
      $tg_defaults['number'] = 4;
      $tg_defaults['type'] = 'latest';
      $tg_defaults['category'] = '';
      $instance = wp_parse_args( (array) $instance, $tg_defaults );
      $title = esc_attr( $instance[ 'title' ] );
      $text = esc_textarea($instance['text']);
      $number = $instance['number'];
      $type = $instance['type'];
      $category = $instance['category'];
      ?>
      <p><?php _e( 'Layout will be as below:', 'colormag' ) ?></p>
      <div style="text-align: center;"><img src="<?php echo get_template_directory_uri() . '/img/style-2.jpg'?>"></div>
      <p>
         <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:', 'colormag' ); ?></label>
         <input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
      </p>
      <?php _e( 'Description','colormag' ); ?>
      <textarea class="widefat" rows="5" cols="20" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo $text; ?></textarea>
      <p>
         <label for="<?php echo $this->get_field_id('number'); ?>"><?php _e( 'Number of posts to display:', 'colormag' ); ?></label>
         <input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" />
      </p>

      <p><input type="radio" <?php checked($type, 'latest') ?> id="<?php echo $this->get_field_id( 'type' ); ?>" name="<?php echo $this->get_field_name( 'type' ); ?>" value="latest"/><?php _e( 'Show latest Posts', 'colormag' );?><br />
       <input type="radio" <?php checked($type,'category') ?> id="<?php echo $this->get_field_id( 'type' ); ?>" name="<?php echo $this->get_field_name( 'type' ); ?>" value="category"/><?php _e( 'Show posts from a category', 'colormag' );?><br /></p>

      <p>
         <label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php _e( 'Select category', 'colormag' ); ?>:</label>
         <?php wp_dropdown_categories( array( 'show_option_none' =>' ','name' => $this->get_field_name( 'category' ), 'selected' => $category ) ); ?>
      </p>
      <?php
   }

   function update( $new_instance, $old_instance ) {
      $instance = $old_instance;
      $instance[ 'title' ] = strip_tags( $new_instance[ 'title' ] );
      if ( current_user_can('unfiltered_html') )
         $instance['text'] =  $new_instance['text'];
      else
         $instance['text'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['text']) ) );
      $instance[ 'number' ] = absint( $new_instance[ 'number' ] );
      $instance[ 'type' ] = $new_instance[ 'type' ];
      $instance[ 'category' ] = $new_instance[ 'category' ];

      return $instance;
   }

   function widget( $args, $instance ) {
      extract( $args );
      extract( $instance );

      global $post;
      $title = apply_filters( 'widget_title', isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : '' );
      $text = isset( $instance[ 'text' ] ) ? $instance[ 'text' ] : '';
      $number = empty( $instance[ 'number' ] ) ? 4 : $instance[ 'number' ];
      $type = isset( $instance[ 'type' ] ) ? $instance[ 'type' ] : 'latest' ;
      $category = isset( $instance[ 'category' ] ) ? $instance[ 'category' ] : '';

      // For WPML plugin compatibility
      if ( function_exists( 'icl_register_string' ) ) {
         icl_register_string( 'ColorMag Pro', 'TG: Featured Posts (Style 2) Description' . $this->id, $text );
      }

      // adding the excluding post function
      $post__not_in = colormag_exclude_duplicate_posts();

      if( $type == 'latest' ) {
         $get_featured_posts = new WP_Query( array(
            'posts_per_page'        => $number,
            'post_type'             => 'post',
            'ignore_sticky_posts'   => true,
            'no_found_rows'         => true,
            'post__not_in'          => $post__not_in
         ) );
      }
      else {
         $get_featured_posts = new WP_Query( array(
            'posts_per_page'        => $number,
            'post_type'             => 'post',
            'category__in'          => $category,
            'no_found_rows'         => true,
            'post__not_in'          => $post__not_in
         ) );
      }

      colormag_append_excluded_duplicate_posts( $get_featured_posts );
      echo $before_widget;
      ?>
      <?php
         if ( $type != 'latest' ) {
            $border_color = 'style="border-bottom-color:' . colormag_category_color($category) . ';"';
            $title_color = 'style="background-color:' . colormag_category_color($category) . ';"';
         } else {
            $border_color = '';
            $title_color = '';
         }
         // For WPML plugin compatibility
         if ( function_exists( 'icl_t' ) ) {
            $text = icl_t( 'ColorMag Pro', 'TG: Featured Posts (Style 2) Description' . $this->id, $text );
         }
         if ( !empty( $title ) ) { echo '<h3 class="widget-title" '. $border_color .'><span ' . $title_color .'>'. esc_html( $title ) .'</span></h3>'; }
         if( !empty( $text ) ) { ?> <p> <?php echo esc_textarea( $text ); ?> </p> <?php } ?>
         <?php
         $i=1;
         while( $get_featured_posts->have_posts() ):$get_featured_posts->the_post();
            ?>
            <?php if( $i == 1 ) { $featured = 'colormag-featured-post-medium'; } else { $featured = 'colormag-featured-post-small'; } ?>
            <?php if( $i == 1 ) { echo '<div class="first-post">'; } elseif ( $i == 2 ) { echo '<div class="following-post">'; } ?>
               <div class="single-article clearfix">
                  <?php
                  if( has_post_thumbnail() ) {
                     $image = '';
                     $title_attribute = get_the_title( $post->ID );
                     $image .= '<figure>';
                     $image .= '<a href="' . get_permalink() . '" title="'.the_title( '', '', false ).'">';
                     $image .= get_the_post_thumbnail( $post->ID, $featured, array( 'title' => esc_attr( $title_attribute ), 'alt' => esc_attr( $title_attribute ) ) ).'</a>';
                     $image .= '</figure>';
                     echo $image;
                  }
                  ?>
                  <div class="article-content">
                     <?php colormag_colored_category(); ?>
                     <h3 class="entry-title">
                        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute();?>"><?php the_title(); ?></a>
                     </h3>
                     <div class="below-entry-meta">
                        <?php
                           $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
                           $time_string = sprintf( $time_string,
                              esc_attr( get_the_date( 'c' ) ),
                              esc_html( get_the_date() )
                           );
                           printf( __( '<span class="posted-on"><a href="%1$s" title="%2$s" rel="bookmark"><i class="fa fa-calendar-o"></i> %3$s</a></span>', 'colormag' ),
                              esc_url( get_permalink() ),
                              esc_attr( get_the_time() ),
                              $time_string
                           );
                        ?>
                        <span class="byline"><span ><i class="fa fa-user"></i><a class="url fn n" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" title="<?php echo get_the_author(); ?>"><?php echo esc_html( get_the_author() ); ?></a></span></span>
                        <span class="comments"><i class="fa fa-comment"></i><?php comments_popup_link( '0', '1', '%' );?></span>
                     </div>
                     <?php if( $i == 1 ) { ?>
                     <div class="entry-content">
                        <?php the_excerpt(); ?>
                     </div>
                     <?php } ?>
                  </div>

               </div>
            <?php if( $i == 1 ) { echo '</div>'; } ?>
         <?php
            $i++;
         endwhile;
         if ( $i > 2 ) { echo '</div>'; }
         // Reset Post Data
         wp_reset_query();
         ?>
      <?php echo $after_widget;
      }

}

/****************************************************************************************/

/**
 * 300x250 Advertisement Ads
 */
class colormag_300x250_advertisement_widget extends WP_Widget {

   function __construct() {
      $widget_ops = array( 'classname' => 'widget_300x250_advertisement', 'description' => __( 'Add your 300x250 Advertisement here', 'colormag') );
      $control_ops = array( 'width' => 200, 'height' =>250 );
      parent::__construct( false,$name= __( 'TG: 300x250 Advertisement', 'colormag' ),$widget_ops);
   }

   function form( $instance ) {
      $instance = wp_parse_args( (array) $instance, array( 'title' => '', '300x250_image_url' => '', '300x250_image_link' => '') );
      $title = esc_attr( $instance[ 'title' ] );

      $image_link = '300x250_image_link';
      $image_url = '300x250_image_url';

      $instance[ $image_link ] = esc_url( $instance[ $image_link ] );
      $instance[ $image_url ] = esc_url( $instance[ $image_url ] );

      ?>

      <p>
         <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:', 'colormag' ); ?></label>
         <input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
      </p>
      <label><?php _e( 'Add your Advertisement 300x250 Images Here', 'colormag' ); ?></label>
      <p>
         <label for="<?php echo $this->get_field_id( $image_link ); ?>"> <?php _e( 'Advertisement Image Link ', 'colormag' ); ?></label>
         <input type="text" class="widefat" id="<?php echo $this->get_field_id( $image_link ); ?>" name="<?php echo $this->get_field_name( $image_link ); ?>" value="<?php echo $instance[$image_link]; ?>"/>
      </p>
      <p>
         <label for="<?php echo $this->get_field_id( $image_url ); ?>"> <?php _e( 'Advertisement Image ', 'colormag' ); ?></label>

         <?php
         if ( $instance[ $image_url ] != '' ) :
            echo '<img id="' . $this->get_field_id( $instance[ $image_url ] . 'preview') . '"src="' . $instance[ $image_url ] . '"style="max-width:250px;" /><br />';
         endif;
         ?>

         <input type="text" class="widefat custom_media_url" id="<?php echo $this->get_field_id( $image_url ); ?>" name="<?php echo $this->get_field_name( $image_url ); ?>" value="<?php echo $instance[$image_url]; ?>" style="margin-top:5px;"/>

         <input type="button" class="button button-primary custom_media_button" id="custom_media_button" name="<?php echo $this->get_field_name( $image_url ); ?>" value="<?php _e( 'Upload Image', 'colormag' ); ?>" style="margin-top:5px; margin-right: 30px;" onclick="imageWidget.uploader( '<?php echo $this->get_field_id( $image_url ); ?>' ); return false;"/>
      </p>

   <?php }
   function update( $new_instance, $old_instance ) {
      $instance = $old_instance;
      $instance[ 'title' ] = strip_tags( $new_instance[ 'title' ] );

      $image_link = '300x250_image_link';
      $image_url = '300x250_image_url';

      $instance[ $image_link ] = esc_url_raw( $new_instance[ $image_link ] );
      $instance[ $image_url ] = esc_url_raw( $new_instance[ $image_url ] );

      return $instance;
   }

   function widget( $args, $instance ) {
      extract( $args );
      extract( $instance );

      $title = apply_filters( 'widget_title', isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : '' );

      $image_link = '300x250_image_link';
      $image_url = '300x250_image_url';

      $image_link = isset( $instance[ $image_link ] ) ? $instance[ $image_link ] : '';
      $image_url = isset( $instance[ $image_url ] ) ? $instance[ $image_url ] : '';

      // For WPML plugin compatibility
      if ( function_exists( 'icl_register_string' ) ) {
         icl_register_string( 'ColorMag Pro', 'TG: 300x250 Image Link' . $this->id, $image_link );
         icl_register_string( 'ColorMag Pro', 'TG: 300x250 Image URL' . $this->id, $image_url );
      }

      echo $before_widget; ?>

      <div class="advertisement_300x250">
         <?php
         // For WPML plugin compatibility
         if ( function_exists( 'icl_t' ) ) {
            $image_link = icl_t( 'ColorMag Pro', 'TG: 300x250 Image Link' . $this->id, $image_link );
            $image_url = icl_t( 'ColorMag Pro', 'TG: 300x250 Image URL' . $this->id, $image_url );
         }
         ?>
         <?php if ( !empty( $title ) ) { ?>
            <div class="advertisement-title">
               <?php echo $before_title. esc_html( $title ) . $after_title; ?>
            </div>
         <?php }
            $output = '';
            if ( !empty( $image_url ) ) {
               $output .= '<div class="advertisement-content">';
               if ( !empty( $image_link ) ) {
               $output .= '<a href="'.$image_link.'" class="single_ad_300x250" target="_blank" rel="nofollow">
                                    <img src="'.$image_url.'" width="300" height="250">
                           </a>';
               } else {
                  $output .= '<img src="'.$image_url.'" width="300" height="250">';
               }
               $output .= '</div>';
               echo $output;
            } ?>
      </div>
      <?php
      echo $after_widget;
   }
}

/****************************************************************************************/

/**
 * 728x90 Advertisement Ads
 */
class colormag_728x90_advertisement_widget extends WP_Widget {

   function __construct() {
      $widget_ops = array( 'classname' => 'widget_728x90_advertisement', 'description' => __( 'Add your 728x90 Advertisement here', 'colormag') );
      $control_ops = array( 'width' => 200, 'height' =>250 );
      parent::__construct( false,$name= __( 'TG: 728x90 Advertisement', 'colormag' ),$widget_ops);
   }

   function form( $instance ) {
      $instance = wp_parse_args( (array) $instance, array( 'title' => '', '728x90_image_url' => '', '728x90_image_link' => '') );
      $title = esc_attr( $instance[ 'title' ] );

      $image_link = '728x90_image_link';
      $image_url = '728x90_image_url';

      $instance[ $image_link ] = esc_url( $instance[ $image_link ] );
      $instance[ $image_url ] = esc_url( $instance[ $image_url ] );

      ?>

      <p>
         <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:', 'colormag' ); ?></label>
         <input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
      </p>
      <label><?php _e( 'Add your Advertisement 728x90 Images Here', 'colormag' ); ?></label>
      <p>
         <label for="<?php echo $this->get_field_id( $image_link ); ?>"> <?php _e( 'Advertisement Image Link ', 'colormag' ); ?></label>
         <input type="text" class="widefat" id="<?php echo $this->get_field_id( $image_link ); ?>" name="<?php echo $this->get_field_name( $image_link ); ?>" value="<?php echo $instance[$image_link]; ?>"/>
      </p>
      <p>
         <label for="<?php echo $this->get_field_id( $image_url ); ?>"> <?php _e( 'Advertisement Image ', 'colormag' ); ?></label>

         <?php
         if ( $instance[ $image_url ] != '' ) :
            echo '<img id="' . $this->get_field_id( $instance[ $image_url ] . 'preview') . '"src="' . $instance[ $image_url ] . '"style="max-width:250px;" /><br />';
         endif;
         ?>

         <input type="text" class="widefat custom_media_url" id="<?php echo $this->get_field_id( $image_url ); ?>" name="<?php echo $this->get_field_name( $image_url ); ?>" value="<?php echo $instance[$image_url]; ?>" style="margin-top:5px;"/>

         <input type="button" class="button button-primary custom_media_button" id="custom_media_button" name="<?php echo $this->get_field_name( $image_url ); ?>" value="<?php _e( 'Upload Image', 'colormag' ); ?>" style="margin-top:5px; margin-right: 30px;" onclick="imageWidget.uploader( '<?php echo $this->get_field_id( $image_url ); ?>' ); return false;"/>
      </p>

   <?php }
   function update( $new_instance, $old_instance ) {
      $instance = $old_instance;
      $instance[ 'title' ] = strip_tags( $new_instance[ 'title' ] );

      $image_link = '728x90_image_link';
      $image_url = '728x90_image_url';

      $instance[ $image_link ] = esc_url_raw( $new_instance[ $image_link ] );
      $instance[ $image_url ] = esc_url_raw( $new_instance[ $image_url ] );

      return $instance;
   }

   function widget( $args, $instance ) {
      extract( $args );
      extract( $instance );

      $title = apply_filters( 'widget_title', isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : '' );

      $image_link = '728x90_image_link';
      $image_url = '728x90_image_url';

      $image_link = isset( $instance[ $image_link ] ) ? $instance[ $image_link ] : '';
      $image_url = isset( $instance[ $image_url ] ) ? $instance[ $image_url ] : '';

      // For WPML plugin compatibility
      if ( function_exists( 'icl_register_string' ) ) {
         icl_register_string( 'ColorMag Pro', 'TG: 728x90 Image Link' . $this->id, $image_link );
         icl_register_string( 'ColorMag Pro', 'TG: 728x90 Image URL' . $this->id, $image_url );
      }

      echo $before_widget; ?>

      <div class="advertisement_728x90">
         <?php
         // For WPML plugin compatibility
         if ( function_exists( 'icl_t' ) ) {
            $image_link = icl_t( 'ColorMag Pro', 'TG: 728x90 Image Link' . $this->id, $image_link );
            $image_url = icl_t( 'ColorMag Pro', 'TG: 728x90 Image URL' . $this->id, $image_url );
         }
         ?>
         <?php if ( !empty( $title ) ) { ?>
            <div class="advertisement-title">
               <?php echo $before_title. esc_html( $title ) . $after_title; ?>
            </div>
         <?php }
            $output = '';
            if ( !empty( $image_url ) ) {
               $output .= '<div class="advertisement-content">';
               if ( !empty( $image_link ) ) {
               $output .= '<a href="'.$image_link.'" class="single_ad_728x90" target="_blank" rel="nofollow">
                                    <img src="'.$image_url.'" width="728" height="90">
                           </a>';
               } else {
                  $output .= '<img src="'.$image_url.'" width="728" height="90">';
               }
               $output .= '</div>';
               echo $output;
            } ?>
      </div>
      <?php
      echo $after_widget;
   }
}

/****************************************************************************************/

/**
 * 125x125 Advertisement Ads
 */
class colormag_125x125_advertisement_widget extends WP_Widget {

   function __construct() {
      $widget_ops = array( 'classname' => 'widget_125x125_advertisement', 'description' => __( 'Add your 125x125 Advertisement here', 'colormag') );
      $control_ops = array( 'width' => 200, 'height' =>250 );
      parent::__construct( false,$name= __( 'TG: 125x125 Advertisement', 'colormag' ),$widget_ops);
   }

   function form( $instance ) {
      $instance = wp_parse_args( (array) $instance, array( 'title' => '', '125x125_image_url_1' => '', '125x125_image_url_2' => '', '125x125_image_url_3' => '', '125x125_image_url_4' => '', '125x125_image_url_5' => '', '125x125_image_url_6' => '', '125x125_image_link_1' => '', '125x125_image_link_2' => '', '125x125_image_link_3' => '', '125x125_image_link_4' => '', '125x125_image_link_5' => '', '125x125_image_link_6' => '') );
      $title = esc_attr( $instance[ 'title' ] );
      for ( $i = 1; $i < 7; $i++ ) {
         $image_link = '125x125_image_link_'.$i;
         $image_url = '125x125_image_url_'.$i;

         $instance[ $image_link ] = esc_url( $instance[ $image_link ] );
         $instance[ $image_url ] = esc_url( $instance[ $image_url ] );
      }
      ?>

      <p>
         <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:', 'colormag' ); ?></label>
         <input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
      </p>
      <label><?php _e( 'Add your Advertisement 125x125 Images Here', 'colormag' ); ?></label>
      <?php
      for ( $i = 1; $i < 7 ; $i++ ) {
         $image_link = '125x125_image_link_'.$i;
         $image_url = '125x125_image_url_'.$i;
      ?>
      <p>
         <label for="<?php echo $this->get_field_id( $image_link ); ?>"> <?php _e( 'Advertisement Image Link ', 'colormag' ); echo $i; ?></label>
         <input type="text" class="widefat" id="<?php echo $this->get_field_id( $image_link ); ?>" name="<?php echo $this->get_field_name( $image_link ); ?>" value="<?php echo $instance[$image_link]; ?>"/>
      </p>
      <p>
         <label for="<?php echo $this->get_field_id( $image_url ); ?>"> <?php _e( 'Advertisement Image ', 'colormag' ); echo $i; ?></label>

         <?php
         if ( $instance[$image_url]  != '' ) :
            echo '<img id="' . $this->get_field_id( $instance[$image_url] . 'preview') . '"src="' . $instance[$image_url] . '"style="max-width:250px;" /><br />';
         endif;
         ?>

         <input type="text" class="widefat custom_media_url" id="<?php echo $this->get_field_id( $image_url ); ?>" name="<?php echo $this->get_field_name( $image_url ); ?>" value="<?php echo $instance[$image_url]; ?>" style="margin-top:5px;"/>

         <input type="button" class="button button-primary custom_media_button" id="custom_media_button" name="<?php echo $this->get_field_name( $image_url ); ?>" value="<?php _e( 'Upload Image', 'colormag' ); ?>" style="margin-top:5px; margin-right: 30px;" onclick="imageWidget.uploader( '<?php echo $this->get_field_id( $image_url ); ?>' ); return false;"/>
      </p>
      <?php } ?>

   <?php }
   function update( $new_instance, $old_instance ) {
      $instance = $old_instance;
      $instance[ 'title' ] = strip_tags( $new_instance[ 'title' ] );
      for ( $i = 1; $i < 7; $i++ ) {
         $image_link = '125x125_image_link_'.$i;
         $image_url = '125x125_image_url_'.$i;

         $instance[ $image_link ] = esc_url_raw( $new_instance[ $image_link ] );
         $instance[ $image_url ] = esc_url_raw( $new_instance[ $image_url ] );
      }

      return $instance;
   }

   function widget( $args, $instance ) {
      extract( $args );
      extract( $instance );

      $title = apply_filters( 'widget_title', isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : '' );
      $image_array = array();
      $link_array = array();

      $j = 0;
      for ( $i = 1; $i < 7; $i++ ) {
         $image_link = '125x125_image_link_'.$i;
         $image_url = '125x125_image_url_'.$i;

         $image_link = isset( $instance[ $image_link ] ) ? $instance[ $image_link ] : '';
         $image_url = isset( $instance[ $image_url ] ) ? $instance[ $image_url ] : '';
         array_push( $link_array, $image_link );
         array_push( $image_array, $image_url );

         // For WPML plugin compatibility
         if ( function_exists( 'icl_register_string' ) ) {
            icl_register_string( 'ColorMag Pro', 'TG: 125x125 Image Link' . $this->id . $j, $image_array[$j] );
         }
         if ( function_exists( 'icl_register_string' ) ) {
            icl_register_string( 'ColorMag Pro', 'TG: 125x125 Image URL' . $this->id . $j, $link_array[$j] );
         }
         $j++;
      }
      echo $before_widget; ?>

      <div class="advertisement_125x125">
         <?php if ( !empty( $title ) ) { ?>
            <div class="advertisement-title">
               <?php echo $before_title. esc_html( $title ) . $after_title; ?>
            </div>
         <?php }
            $output = '';
            if ( !empty( $image_array ) ) {
            $output .= '<div class="advertisement-content">';
            for ( $i = 1; $i < 7; $i++ ) {
               $j = $i - 1;
               if( !empty( $image_array[$j] ) ) {
                  // For WPML plugin compatibility
                  if ( function_exists( 'icl_t' ) ) {
                     $image_array[$j] = icl_t( 'ColorMag Pro', 'TG: 125x125 Image Link' . $this->id . $j, $image_array[$j] );
                  }
                  if ( function_exists( 'icl_t' ) ) {
                     $link_array[$j] = icl_t( 'ColorMag Pro', 'TG: 125x125 Image URL' . $this->id . $j, $link_array[$j] );
                  }

                  if ( !empty( $link_array[$j] ) ) {
                     $output .= '<a href="'.$link_array[$j].'" class="single_ad_125x125" target="_blank" rel="nofollow">
                                 <img src="'.$image_array[$j].'" width="125" height="125">
                              </a>';
                  } else {
                     $output .= '<img src="'.$image_array[$j].'" width="125" height="125">';
                  }
               }
            }
            $output .= '</div>';
            echo $output;
         } ?>
      </div>
      <?php
      echo $after_widget;
   }
}

/****************************************************************************************/

/**
 * Colormag Video Widget
 */
class colormag_video_widget extends WP_Widget {

   function __construct() {
      $widget_ops = array( 'classname' => 'widget_video_colormag', 'description' => __( 'Add the videos here, Youtube and Vimeo Videos is only accepted for now.', 'colormag') );
      $control_ops = array( 'width' => 200, 'height' =>250 );
      parent::__construct( false,$name= __( 'TG: Videos', 'colormag' ),$widget_ops);
   }

   function form( $instance ) {
      $instance = wp_parse_args( (array) $instance, array( 'title' => '', 'link' => '', 'vimeo_title' => '', 'vimeo_link' => '' ) );
      $title = esc_attr( $instance[ 'title' ] );

      $link = 'link';
      $instance[ $link ] = strip_tags( $instance[ $link ] );
      $vimeo_link = 'vimeo_link';
      $instance[ $vimeo_link ] = strip_tags( $instance[ $vimeo_link ] );

      ?>

      <p>
         <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:', 'colormag' ); ?></label>
         <input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
      </p>
      <p>
         <label for="<?php echo $this->get_field_id( $link ); ?>"> <?php _e( 'Youtube Video ID:', 'colormag' ); ?></label>
         <input type="text" class="widefat" id="<?php echo $this->get_field_id( $link ); ?>" name="<?php echo $this->get_field_name( $link ); ?>" value="<?php echo $instance[$link]; ?>"/>
      </p>
      <p>
         <label for="<?php echo $this->get_field_id( $vimeo_link ); ?>"> <?php _e( 'Vimeo Video ID:', 'colormag' ); ?></label>
         <input type="text" class="widefat" id="<?php echo $this->get_field_id( $vimeo_link ); ?>" name="<?php echo $this->get_field_name( $vimeo_link ); ?>" value="<?php echo $instance[$vimeo_link]; ?>"/>
      </p>

   <?php }
   function update( $new_instance, $old_instance ) {
      $instance = $old_instance;
      $instance[ 'title' ] = strip_tags( $new_instance[ 'title' ] );

      $link = 'link';
      $instance[ $link ] = strip_tags( $new_instance[ $link ] );
      $vimeo_link = 'vimeo_link';
      $instance[ $vimeo_link ] = strip_tags( $new_instance[ $vimeo_link ] );

      return $instance;
   }

   function widget( $args, $instance ) {
      extract( $args );
      extract( $instance );

      $title = apply_filters( 'widget_title', isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : '' );

      $link = 'link';
      $link = isset( $instance[ $link ] ) ? $instance[ $link ] : '';
      $vimeo_link = 'vimeo_link';
      $vimeo_link = isset( $instance[ $vimeo_link ] ) ? $instance[ $vimeo_link ] : '';

      echo $before_widget; ?>

      <div class="fitvids-video">
         <?php if ( !empty( $title ) ) { ?>
            <div class="video-title">
               <?php echo $before_title. esc_html( $title ) . $after_title; ?>
            </div>
         <?php }
            if ( !empty( $link ) ) {
               $output = '<div class="video"><iframe src="https://www.youtube.com/embed/' . $link .'"></iframe></div>';
               echo $output;
            }
            if ( !empty( $vimeo_link ) ) {
               $output = '<div class="video"><iframe src="https://player.vimeo.com/video/' . $vimeo_link .'"></iframe></div>';
               echo $output;
            } ?>
      </div>
         <?php

      echo $after_widget;
   }
}

/****************************************************************************************/

/**
 * News In Picture widget
 */
class colormag_news_in_picture_widget extends WP_Widget {

   function __construct() {
      $widget_ops = array( 'classname' => 'widget_block_picture_news widget_highlighted_posts widget_featured_meta widget_featured_posts', 'description' => __( 'Display latest posts or posts of specific category.', 'colormag') );
      $control_ops = array( 'width' => 200, 'height' =>250 );
      parent::__construct( false,$name= __( 'TG: Featured Posts (Style 5)', 'colormag' ),$widget_ops);
   }

   function form( $instance ) {
      $tg_defaults['title'] = '';
      $tg_defaults['text'] = '';
      $tg_defaults['number'] = 4;
      $tg_defaults['type'] = 'latest';
      $tg_defaults['category'] = '';
      $tg_defaults['slide'] = '1';
      $instance = wp_parse_args( (array) $instance, $tg_defaults );
      $title = esc_attr( $instance[ 'title' ] );
      $text = esc_textarea($instance['text']);
      $number = $instance['number'];
      $type = $instance['type'];
      $category = $instance['category'];
      $slide = $instance[ 'slide' ] ? 'checked="checked"' : '';
      ?>
      <p><?php _e( 'Layout will be as below:', 'colormag' ) ?></p>
      <div style="text-align: center;"><img src="<?php echo get_template_directory_uri() . '/img/style-5.jpg'?>"></div>
      <p>
         <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:', 'colormag' ); ?></label>
         <input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
      </p>
      <?php _e( 'Description','colormag' ); ?>
      <textarea class="widefat" rows="5" cols="20" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo $text; ?></textarea>
      <p>
         <label for="<?php echo $this->get_field_id('number'); ?>"><?php _e( 'Number of posts to display:', 'colormag' ); ?></label>
         <input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" />
      </p>

      <p><input type="radio" <?php checked($type, 'latest') ?> id="<?php echo $this->get_field_id( 'type' ); ?>" name="<?php echo $this->get_field_name( 'type' ); ?>" value="latest"/><?php _e( 'Show latest Posts', 'colormag' );?><br />
       <input type="radio" <?php checked($type,'category') ?> id="<?php echo $this->get_field_id( 'type' ); ?>" name="<?php echo $this->get_field_name( 'type' ); ?>" value="category"/><?php _e( 'Show posts from a category', 'colormag' );?><br /></p>

      <p>
         <label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php _e( 'Select category', 'colormag' ); ?>:</label>
         <?php wp_dropdown_categories( array( 'show_option_none' =>' ','name' => $this->get_field_name( 'category' ), 'selected' => $category ) ); ?>
      </p>
      <p>
         <input class="checkbox" <?php echo $slide; ?> id="<?php echo $this->get_field_id( 'slide' ); ?>" name="<?php echo $this->get_field_name( 'slide' ); ?>" type="checkbox" />
         <label for="<?php echo $this->get_field_id('slide'); ?>"><?php _e( 'Check not to have the slider effect for this widget', 'colormag' ); ?></label>
      </p>

      <?php
   }

   function update( $new_instance, $old_instance ) {
      $instance = $old_instance;
      $instance[ 'title' ] = strip_tags( $new_instance[ 'title' ] );
      if ( current_user_can('unfiltered_html') )
         $instance['text'] =  $new_instance['text'];
      else
         $instance['text'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['text']) ) );
      $instance[ 'number' ] = absint( $new_instance[ 'number' ] );
      $instance[ 'type' ] = $new_instance[ 'type' ];
      $instance[ 'category' ] = $new_instance[ 'category' ];
      $instance[ 'slide' ] = isset( $new_instance[ 'slide' ] ) ? 1 : 0;

      return $instance;
   }

   function widget( $args, $instance ) {
      extract( $args );
      extract( $instance );

      global $post;
      $title = apply_filters( 'widget_title', isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : '' );
      $text = isset( $instance[ 'text' ] ) ? $instance[ 'text' ] : '';
      $number = empty( $instance[ 'number' ] ) ? 4 : $instance[ 'number' ];
      $type = isset( $instance[ 'type' ] ) ? $instance[ 'type' ] : 'latest' ;
      $category = isset( $instance[ 'category' ] ) ? $instance[ 'category' ] : '';
      $slide = !empty( $instance[ 'slide' ] ) ? 'true' : 'false';

      if(($slide == 1) && (is_active_widget( false, false, $this->id_base ) || is_customize_preview())) {
      	wp_enqueue_script('colormag-bxslider');
      }
      // For WPML plugin compatibility
      if ( function_exists( 'icl_register_string' ) ) {
         icl_register_string( 'ColorMag Pro', 'TG: Featured Posts (Style 5) Description' . $this->id, $text );
      }

      // adding the excluding post function
      $post__not_in = colormag_exclude_duplicate_posts();

      if( $type == 'latest' ) {
         $get_featured_posts = new WP_Query( array(
            'posts_per_page'        => $number,
            'post_type'             => 'post',
            'ignore_sticky_posts'   => true,
            'no_found_rows'         => true,
            'post__not_in'          => $post__not_in
         ) );
      }
      else {
         $get_featured_posts = new WP_Query( array(
            'posts_per_page'        => $number,
            'post_type'             => 'post',
            'category__in'          => $category,
            'no_found_rows'         => true,
            'post__not_in'          => $post__not_in
         ) );
      }

      colormag_append_excluded_duplicate_posts( $get_featured_posts );
      echo $before_widget;
      ?>
      <?php $featured = 'colormag-featured-post-medium'; ?>
      <?php
      if ( $type != 'latest' ) {
         $border_color = 'style="border-bottom-color:' . colormag_category_color($category) . ';"';
         $title_color = 'style="background-color:' . colormag_category_color($category) . ';"';
      } else {
         $border_color = '';
         $title_color = '';
      }
      // For WPML plugin compatibility
      if ( function_exists( 'icl_t' ) ) {
         $text = icl_t( 'ColorMag Pro', 'TG: Featured Posts (Style 5) Description' . $this->id, $text );
      }
      if ( !empty( $title ) ) { echo '<h3 class="widget-title" '. $border_color .'><span ' . $title_color .'>'. esc_html( $title ) .'</span></h3>'; }
      if( !empty( $text ) ) { ?> <p> <?php echo esc_textarea( $text ); ?> </p> <?php } ?>
      <?php
         if ( $slide == 'false' ) {
            $class = 'widget_highlighted_post_area';
         } else {
            $class = 'widget_highlighted_post_area_no_slide';
         }
      ?>
         <div class="widget_block_picture_news_inner_wrap">
            <div class="<?php echo $class; ?>">
            <?php
            $i=1;
            while( $get_featured_posts->have_posts() ):$get_featured_posts->the_post(); ?>
               <div class="single-article">
                  <?php
                  if( has_post_thumbnail() ) {
                     $image = '';
                     $title_attribute = get_the_title( $post->ID );
                     $image .= '<figure>';
                     $image .= '<a href="' . get_permalink() . '" title="'.the_title( '', '', false ).'">';
                     $image .= get_the_post_thumbnail( $post->ID, $featured, array( 'title' => esc_attr( $title_attribute ), 'alt' => esc_attr( $title_attribute ) ) ).'</a>';
                     $image .= '</figure>';
                     echo $image;
                  }
                  ?>
                  <div class="article-content">
                     <?php colormag_colored_category(); ?>
                     <h3 class="entry-title">
                        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute();?>"><?php the_title(); ?></a>
                     </h3>
                     <div class="below-entry-meta">
                        <?php
                           $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
                           $time_string = sprintf( $time_string,
                              esc_attr( get_the_date( 'c' ) ),
                              esc_html( get_the_date() )
                           );
                           printf( __( '<span class="posted-on"><a href="%1$s" title="%2$s" rel="bookmark"><i class="fa fa-calendar-o"></i> %3$s</a></span>', 'colormag' ),
                              esc_url( get_permalink() ),
                              esc_attr( get_the_time() ),
                              $time_string
                           );
                        ?>
                        <span class="byline"><span ><i class="fa fa-user"></i><a class="url fn n" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" title="<?php echo get_the_author(); ?>"><?php echo esc_html( get_the_author() ); ?></a></span></span>
                        <span class="comments"><i class="fa fa-comment"></i><?php comments_popup_link( '0', '1', '%' );?></span>
                     </div>
                  </div>
               </div>
            <?php
            $i++;
            endwhile;
            // Reset Post Data
            wp_reset_query();
            ?>
         </div>
      </div>
      <?php echo $after_widget;
      }
}

/****************************************************************************************/

/**
 * Default News Widget
 */
class colormag_default_news_widget extends WP_Widget {

   function __construct() {
      $widget_ops = array( 'classname' => 'widget_default_news_colormag widget_featured_posts', 'description' => __( 'Display latest posts or posts of specific category.', 'colormag') );
      $control_ops = array( 'width' => 200, 'height' =>250 );
      parent::__construct( false,$name= __( 'TG: Featured Posts (Style 4)', 'colormag' ),$widget_ops);
   }

   function form( $instance ) {
      $tg_defaults['title'] = '';
      $tg_defaults['text'] = '';
      $tg_defaults['number'] = 4;
      $tg_defaults['type'] = 'latest';
      $tg_defaults['category'] = '';
      $instance = wp_parse_args( (array) $instance, $tg_defaults );
      $title = esc_attr( $instance[ 'title' ] );
      $text = esc_textarea($instance['text']);
      $number = $instance['number'];
      $type = $instance['type'];
      $category = $instance['category'];
      ?>
      <p><?php _e( 'Layout will be as below:', 'colormag' ) ?></p>
      <div style="text-align: center;"><img src="<?php echo get_template_directory_uri() . '/img/style-4.jpg'?>"></div>
      <p>
         <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:', 'colormag' ); ?></label>
         <input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
      </p>
      <?php _e( 'Description','colormag' ); ?>
      <textarea class="widefat" rows="5" cols="20" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo $text; ?></textarea>
      <p>
         <label for="<?php echo $this->get_field_id('number'); ?>"><?php _e( 'Number of posts to display:', 'colormag' ); ?></label>
         <input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" />
      </p>

      <p><input type="radio" <?php checked($type, 'latest') ?> id="<?php echo $this->get_field_id( 'type' ); ?>" name="<?php echo $this->get_field_name( 'type' ); ?>" value="latest"/><?php _e( 'Show latest Posts', 'colormag' );?><br />
       <input type="radio" <?php checked($type,'category') ?> id="<?php echo $this->get_field_id( 'type' ); ?>" name="<?php echo $this->get_field_name( 'type' ); ?>" value="category"/><?php _e( 'Show posts from a category', 'colormag' );?><br /></p>

      <p>
         <label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php _e( 'Select category', 'colormag' ); ?>:</label>
         <?php wp_dropdown_categories( array( 'show_option_none' =>' ','name' => $this->get_field_name( 'category' ), 'selected' => $category ) ); ?>
      </p>

      <?php
   }

   function update( $new_instance, $old_instance ) {
      $instance = $old_instance;
      $instance[ 'title' ] = strip_tags( $new_instance[ 'title' ] );
      if ( current_user_can('unfiltered_html') )
         $instance['text'] =  $new_instance['text'];
      else
         $instance['text'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['text']) ) );
      $instance[ 'number' ] = absint( $new_instance[ 'number' ] );
      $instance[ 'type' ] = $new_instance[ 'type' ];
      $instance[ 'category' ] = $new_instance[ 'category' ];

      return $instance;
   }

   function widget( $args, $instance ) {
      extract( $args );
      extract( $instance );

      global $post;
      $title = apply_filters( 'widget_title', isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : '' );
      $text = isset( $instance[ 'text' ] ) ? $instance[ 'text' ] : '';
      $number = empty( $instance[ 'number' ] ) ? 4 : $instance[ 'number' ];
      $type = isset( $instance[ 'type' ] ) ? $instance[ 'type' ] : 'latest' ;
      $category = isset( $instance[ 'category' ] ) ? $instance[ 'category' ] : '';

      // For WPML plugin compatibility
      if ( function_exists( 'icl_register_string' ) ) {
         icl_register_string( 'ColorMag Pro', 'TG: Featured Posts (Style 4) Description' . $this->id, $text );
      }

      // adding the excluding post function
      $post__not_in = colormag_exclude_duplicate_posts();

      if( $type == 'latest' ) {
         $get_featured_posts = new WP_Query( array(
            'posts_per_page'        => $number,
            'post_type'             => 'post',
            'ignore_sticky_posts'   => true,
            'no_found_rows'         => true,
            'post__not_in'          => $post__not_in
         ) );
      }
      else {
         $get_featured_posts = new WP_Query( array(
            'posts_per_page'        => $number,
            'post_type'             => 'post',
            'category__in'          => $category,
            'no_found_rows'         => true,
            'post__not_in'          => $post__not_in
         ) );
      }

      colormag_append_excluded_duplicate_posts( $get_featured_posts );
      echo $before_widget;
      ?>
      <?php $featured = 'colormag-featured-post-medium'; ?>
      <?php
      if ( $type != 'latest' ) {
         $border_color = 'style="border-bottom-color:' . colormag_category_color($category) . ';"';
         $title_color = 'style="background-color:' . colormag_category_color($category) . ';"';
      } else {
         $border_color = '';
         $title_color = '';
      }
      // For WPML plugin compatibility
      if ( function_exists( 'icl_t' ) ) {
         $text = icl_t( 'ColorMag Pro', 'TG: Featured Posts (Style 4) Description' . $this->id, $text );
      }
      if ( !empty( $title ) ) { echo '<h3 class="widget-title" '. $border_color .'><span ' . $title_color .'>'. esc_html( $title ) .'</span></h3>'; }
      if( !empty( $text ) ) { ?> <p> <?php echo esc_textarea( $text ); ?> </p> <?php } ?>
         <div class="default-news">
         <?php
         $i=1;
         while( $get_featured_posts->have_posts() ):$get_featured_posts->the_post(); ?>
            <div class="single-article clearfix">
               <?php
               if( has_post_thumbnail() ) {
                  $image = '';
                  $title_attribute = get_the_title( $post->ID );
                  $image .= '<figure>';
                  $image .= '<a href="' . get_permalink() . '" title="'.the_title( '', '', false ).'">';
                  $image .= get_the_post_thumbnail( $post->ID, $featured, array( 'title' => esc_attr( $title_attribute ), 'alt' => esc_attr( $title_attribute ) ) ).'</a>';
                  $image .= '</figure>';
                  echo $image;
               }
               ?>
               <div class="article-content">
                  <?php colormag_colored_category(); ?>
                  <h3 class="entry-title">
                     <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute();?>"><?php the_title(); ?></a>
                  </h3>
                  <div class="below-entry-meta">
                     <?php
                        $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
                        $time_string = sprintf( $time_string,
                           esc_attr( get_the_date( 'c' ) ),
                           esc_html( get_the_date() )
                        );
                        printf( __( '<span class="posted-on"><a href="%1$s" title="%2$s" rel="bookmark"><i class="fa fa-calendar-o"></i> %3$s</a></span>', 'colormag' ),
                           esc_url( get_permalink() ),
                           esc_attr( get_the_time() ),
                           $time_string
                        );
                     ?>
                     <span class="byline"><span ><i class="fa fa-user"></i><a class="url fn n" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" title="<?php echo get_the_author(); ?>"><?php echo esc_html( get_the_author() ); ?></a></span></span>
                     <span class="comments"><i class="fa fa-comment"></i><?php comments_popup_link( '0', '1', '%' );?></span>
                  </div>
                  <div class="entry-content"><?php the_excerpt(); ?></div>
               </div>
            </div>
         <?php
         $i++;
         endwhile;
         // Reset Post Data
         wp_reset_query();
         ?>
      </div>
      <?php echo $after_widget;
      }
}

/****************************************************************************************/

/**
 * Tabbed widget
 */
class colormag_tabbed_widget extends WP_Widget {

   function __construct() {
      $widget_ops = array( 'classname' => 'widget_tabbed_colormag widget_featured_posts', 'description' => __( 'Displays the popular posts, latest posts and the recent comments in tab. Suitable for the Right/Left sidebar.', 'colormag') );
      $control_ops = array( 'width' => 200, 'height' =>250 );
      parent::__construct( false,$name= __( 'TG: Tabbed Widget', 'colormag' ),$widget_ops);
   }

   function form( $instance ) {
      $tg_defaults['number'] = 4;
      $tg_defaults['popular_view_count'] = '0';
      $instance = wp_parse_args( (array) $instance, $tg_defaults );
      $number = $instance['number'];
      $popular_view_count = $instance[ 'popular_view_count' ] ? 'checked="checked"' : '';
      ?>
      <p>
         <label for="<?php echo $this->get_field_id('number'); ?>"><?php _e( 'Number of popular posts, recent posts and comments to display:', 'colormag' ); ?></label>
         <input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" />
      </p>

      <p>
         <input class="checkbox" <?php echo $popular_view_count; ?> id="<?php echo $this->get_field_id( 'popular_view_count' ); ?>" name="<?php echo $this->get_field_name( 'popular_view_count' ); ?>" type="checkbox" />
         <label for="<?php echo $this->get_field_id('popular_view_count'); ?>"><?php _e( 'Check to enable the popular post by view count.', 'colormag' ); ?></label>
      </p>
      <?php
   }

   function update( $new_instance, $old_instance ) {
      $instance = $old_instance;
      $instance[ 'number' ] = absint( $new_instance[ 'number' ] );
      $instance[ 'popular_view_count' ] = isset( $new_instance[ 'popular_view_count' ] ) ? 1 : 0;

      return $instance;
   }

   function widget( $args, $instance ) {
      if ( is_active_widget( false, false, $this->id_base ) || is_customize_preview() ) {
         wp_enqueue_script( 'colormag-easy-tabs' );
      }

      extract( $args );
      extract( $instance );
      $number = empty( $instance[ 'number' ] ) ? 4 : $instance[ 'number' ];
      $popular_view_count = !empty( $instance[ 'popular_view_count' ] ) ? 'true' : 'false';

      echo $before_widget;

       ?>

      <div class="tabbed-widget">
         <ul class="widget-tabs">
            <li class="tabs popular-tabs"><a href="#popular"><?php _e('<i class="fa fa-star"></i>Popular','colormag'); ?></a></li>
            <li class="tabs recent-tabs"><a href="#recent"><?php _e('<i class="fa fa-history"></i>Recent','colormag'); ?></a></li>
            <li class="tabs comment-tabs"><a href="#comment"><?php _e('<i class="fa fa-comment"></i>Comment','colormag'); ?></a></li>
         </ul>

      <div class="tabbed-widget-popular" id="popular">
      <?php
      global $post;

      $args = array();
      if ( $popular_view_count == 'false' ) {
         $args = array(
            'posts_per_page'        => $number,
            'post_type'             => 'post',
            'ignore_sticky_posts'   => true,
            'orderby'               => 'comment_count',
            'no_found_rows'         => true
         );
      } else {
         $args = array(
            'posts_per_page'        => $number,
            'post_type'             => 'post',
            'ignore_sticky_posts'   => true,
            'meta_key'              => 'total_number_of_views',
            'orderby'               => 'meta_value_num',
            'order'                 => DESC,
            'no_found_rows'         => true
         );
      }

      $get_featured_posts = new WP_Query( $args );
      ?>
      <?php $featured = 'colormag-featured-post-small'; ?>
         <?php
         $i=1;
         while( $get_featured_posts->have_posts() ):$get_featured_posts->the_post();
            ?>
            <div class="single-article clearfix">
               <?php
               if( has_post_thumbnail() ) {
                  $image = '';
                  $title_attribute = get_the_title( $post->ID );
                  $image .= '<figure class="tabbed-images">';
                  $image .= '<a href="' . get_permalink() . '" title="'.the_title( '', '', false ).'">';
                  $image .= get_the_post_thumbnail( $post->ID, $featured, array( 'title' => esc_attr( $title_attribute ), 'alt' => esc_attr( $title_attribute ) ) ).'</a>';
                  $image .= '</figure>';
                  echo $image;
               }
               ?>
               <div class="article-content">
                  <h3 class="entry-title">
                     <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute();?>"><?php the_title(); ?></a>
                  </h3>
                  <div class="below-entry-meta">
                     <?php
                        $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
                        $time_string = sprintf( $time_string,
                           esc_attr( get_the_date( 'c' ) ),
                           esc_html( get_the_date() )
                        );
                        printf( __( '<span class="posted-on"><a href="%1$s" title="%2$s" rel="bookmark"><i class="fa fa-calendar-o"></i> %3$s</a></span>', 'colormag' ),
                           esc_url( get_permalink() ),
                           esc_attr( get_the_time() ),
                           $time_string
                        );
                     ?>
                     <span class="byline"><span ><i class="fa fa-user"></i><a class="url fn n" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" title="<?php echo get_the_author(); ?>"><?php echo esc_html( get_the_author() ); ?></a></span></span>
                     <span class="comments"><i class="fa fa-comment"></i><?php comments_popup_link( __('No Comment', 'colormag'), __('1 Comment', 'colormag'), __('% Comments', 'colormag') );?></span>
                  </div>
               </div>

            </div>
         <?php
            $i++;
         endwhile;
         // Reset Post Data
         wp_reset_query();
         ?>
         </div>

         <div class="tabbed-widget-recent" id="recent">
         <?php
         global $post;

         $get_featured_posts = new WP_Query( array(
            'posts_per_page'        => $number,
            'post_type'             => 'post',
            'ignore_sticky_posts'   => true,
            'no_found_rows'         => true
         ) );
         ?>
         <?php $featured = 'colormag-featured-post-small'; ?>
            <?php
            $i=1;
            while( $get_featured_posts->have_posts() ):$get_featured_posts->the_post();
               ?>
               <div class="single-article clearfix">
                  <?php
                  if( has_post_thumbnail() ) {
                     $image = '';
                     $title_attribute = get_the_title( $post->ID );
                     $image .= '<figure class="tabbed-images">';
                     $image .= '<a href="' . get_permalink() . '" title="'.the_title( '', '', false ).'">';
                     $image .= get_the_post_thumbnail( $post->ID, $featured, array( 'title' => esc_attr( $title_attribute ), 'alt' => esc_attr( $title_attribute ) ) ).'</a>';
                     $image .= '</figure>';
                     echo $image;
                  }
                  ?>
                  <div class="article-content">
                     <h3 class="entry-title">
                        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute();?>"><?php the_title(); ?></a>
                     </h3>
                     <div class="below-entry-meta">
                        <?php
                           $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
                           $time_string = sprintf( $time_string,
                              esc_attr( get_the_date( 'c' ) ),
                              esc_html( get_the_date() )
                           );
                           printf( __( '<span class="posted-on"><a href="%1$s" title="%2$s" rel="bookmark"><i class="fa fa-calendar-o"></i> %3$s</a></span>', 'colormag' ),
                              esc_url( get_permalink() ),
                              esc_attr( get_the_time() ),
                              $time_string
                           );
                        ?>
                        <span class="byline"><span ><i class="fa fa-user"></i><a class="url fn n" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" title="<?php echo get_the_author(); ?>"><?php echo esc_html( get_the_author() ); ?></a></span></span>
                     </div>
                  </div>

               </div>
            <?php
               $i++;
            endwhile;
            // Reset Post Data
            wp_reset_query();
            ?>
         </div>

         <div class="tabbed-widget-comment" id="comment">
         <?php
         $comments_query = new WP_Comment_Query();
         $comments = $comments_query->query( array( 'number' => $number, 'status' => 'approve' ) );
         $commented = '';
         if ( $comments ) : foreach ( $comments as $comment ) :
            $commented .= '<li class="tabbed-comment-widget"><a class="author" href="' . get_permalink( $comment->comment_post_ID ) . '#comment-' . $comment->comment_ID . '">';
            $commented .= get_avatar( $comment->comment_author_email, '50' );
            $commented .= get_comment_author( $comment->comment_ID ) . '</a>' . ' ' . __( 'says:', 'colormag' );
            $commented .= '<p class="commented">' . strip_tags( substr( apply_filters( 'get_comment_text', $comment->comment_content ), 0, '50' ) ) . '...</p></li>';
         endforeach; else :
            $commented .= __( 'No comments', 'colormag' );
         endif;
         echo $commented;
         ?>
         </div>

      </div>
      <?php echo $after_widget;
      }
}

/****************************************************************************************/

/**
 * Random Post widget
 */
class colormag_random_post_widget extends WP_Widget {

   function __construct() {
      $widget_ops = array( 'classname' => 'widget_random_post_colormag widget_featured_posts', 'description' => __( 'Displays the random posts from your site. Suitable for the Right/Left sidebar.', 'colormag') );
      $control_ops = array( 'width' => 200, 'height' =>250 );
      parent::__construct( false,$name= __( 'TG: Random Posts Widget', 'colormag' ),$widget_ops);
   }

   function form( $instance ) {
      $tg_defaults['number'] = 4;
      $tg_defaults['title'] = '';
      $instance = wp_parse_args( (array) $instance, $tg_defaults );
      $number = $instance['number'];
      $title = esc_attr( $instance[ 'title' ] );
      ?>
      <p>
         <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:', 'colormag' ); ?></label>
         <input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
      </p>
      <p>
         <label for="<?php echo $this->get_field_id('number'); ?>"><?php _e( 'Number of random posts to display:', 'colormag' ); ?></label>
         <input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" />
      </p>
      <?php
   }

   function update( $new_instance, $old_instance ) {
      $instance = $old_instance;
      $instance[ 'number' ] = absint( $new_instance[ 'number' ] );
      $instance[ 'title' ] = strip_tags( $new_instance[ 'title' ] );

      return $instance;
   }

   function widget( $args, $instance ) {
      extract( $args );
      extract( $instance );
      $number = empty( $instance[ 'number' ] ) ? 4 : $instance[ 'number' ];
      $title = apply_filters( 'widget_title', isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : '' );

      echo $before_widget;

       ?>

      <div class="random-posts-widget">
      <?php
      global $post;

      // adding the excluding post function
      $post__not_in = colormag_exclude_duplicate_posts();

      $get_featured_posts = new WP_Query( array(
         'posts_per_page'        => $number,
         'post_type'             => 'post',
         'ignore_sticky_posts'   => true,
         'orderby'               => 'rand',
         'no_found_rows'         => true,
         'post__not_in'          => $post__not_in
      ) );

      colormag_append_excluded_duplicate_posts( $get_featured_posts );
      ?>
      <?php $featured = 'colormag-featured-post-small'; ?>
         <?php
         if ( !empty( $title ) ) { echo $before_title . esc_html( $title ) . $after_title; } ?>
         <div class="random_posts_widget_inner_wrap">
            <?php
            $i=1;
            while( $get_featured_posts->have_posts() ):$get_featured_posts->the_post();
               ?>
               <div class="single-article clearfix">
                  <?php
                  if( has_post_thumbnail() ) {
                     $image = '';
                     $title_attribute = get_the_title( $post->ID );
                     $image .= '<figure class="random-images">';
                     $image .= '<a href="' . get_permalink() . '" title="'.the_title( '', '', false ).'">';
                     $image .= get_the_post_thumbnail( $post->ID, $featured, array( 'title' => esc_attr( $title_attribute ), 'alt' => esc_attr( $title_attribute ) ) ).'</a>';
                     $image .= '</figure>';
                     echo $image;
                  }
                  ?>
                  <div class="article-content">
                     <h3 class="entry-title">
                        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute();?>"><?php the_title(); ?></a>
                     </h3>
                     <div class="below-entry-meta">
                        <?php
                           $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
                           $time_string = sprintf( $time_string,
                              esc_attr( get_the_date( 'c' ) ),
                              esc_html( get_the_date() )
                           );
                           printf( __( '<span class="posted-on"><a href="%1$s" title="%2$s" rel="bookmark"><i class="fa fa-calendar-o"></i> %3$s</a></span>', 'colormag' ),
                              esc_url( get_permalink() ),
                              esc_attr( get_the_time() ),
                              $time_string
                           );
                        ?>
                        <span class="byline"><span ><i class="fa fa-user"></i><a class="url fn n" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" title="<?php echo get_the_author(); ?>"><?php echo esc_html( get_the_author() ); ?></a></span></span>
                        <span class="comments"><i class="fa fa-comment"></i><?php comments_popup_link( __('No Comment','colormag'), __('1 Comment','colormag'), __('% Comments','colormag') );?></span>
                     </div>
                  </div>

               </div>
            <?php
               $i++;
            endwhile;
            // Reset Post Data
            wp_reset_query();
            ?>
            </div>
         </div>
      <?php echo $after_widget;
      }
}

/****************************************************************************************/

/**
 * Slider News Widget
 */
class colormag_slider_news_widget extends WP_Widget {

   function __construct() {
      $widget_ops = array( 'classname' => 'widget_slider_news_colormag widget_featured_posts', 'description' => __( 'Display latest posts or posts of specific category.', 'colormag') );
      $control_ops = array( 'width' => 200, 'height' =>250 );
      parent::__construct( false,$name= __( 'TG: Featured Posts (Style 6)', 'colormag' ),$widget_ops);
   }

   function form( $instance ) {
      $tg_defaults['title'] = '';
      $tg_defaults['text'] = '';
      $tg_defaults['number'] = 5;
      $tg_defaults['type'] = 'latest';
      $tg_defaults['category'] = '';
      $instance = wp_parse_args( (array) $instance, $tg_defaults );
      $title = esc_attr( $instance[ 'title' ] );
      $text = esc_textarea($instance['text']);
      $number = $instance['number'];
      $type = $instance['type'];
      $category = $instance['category'];
      ?>
      <p><?php _e( 'Layout will be as below:', 'colormag' ) ?></p>
      <div style="text-align: center;"><img src="<?php echo get_template_directory_uri() . '/img/style-6.jpg'?>"></div>
      <p>
         <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:', 'colormag' ); ?></label>
         <input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
      </p>
      <?php _e( 'Description','colormag' ); ?>
      <textarea class="widefat" rows="5" cols="20" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo $text; ?></textarea>
      <p>
         <label for="<?php echo $this->get_field_id('number'); ?>"><?php _e( 'Number of posts to display:', 'colormag' ); ?></label>
         <input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" />
      </p>

      <p><input type="radio" <?php checked($type, 'latest') ?> id="<?php echo $this->get_field_id( 'type' ); ?>" name="<?php echo $this->get_field_name( 'type' ); ?>" value="latest"/><?php _e( 'Show latest Posts', 'colormag' );?><br />
       <input type="radio" <?php checked($type,'category') ?> id="<?php echo $this->get_field_id( 'type' ); ?>" name="<?php echo $this->get_field_name( 'type' ); ?>" value="category"/><?php _e( 'Show posts from a category', 'colormag' );?><br /></p>

      <p>
         <label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php _e( 'Select category', 'colormag' ); ?>:</label>
         <?php wp_dropdown_categories( array( 'show_option_none' =>' ','name' => $this->get_field_name( 'category' ), 'selected' => $category ) ); ?>
      </p>

      <?php
   }

   function update( $new_instance, $old_instance ) {
      $instance = $old_instance;
      $instance[ 'title' ] = strip_tags( $new_instance[ 'title' ] );
      if ( current_user_can('unfiltered_html') )
         $instance['text'] =  $new_instance['text'];
      else
         $instance['text'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['text']) ) );
      $instance[ 'number' ] = absint( $new_instance[ 'number' ] );
      $instance[ 'type' ] = $new_instance[ 'type' ];
      $instance[ 'category' ] = $new_instance[ 'category' ];

      return $instance;
   }

   function widget( $args, $instance ) {
      if ( is_active_widget( false, false, $this->id_base ) || is_customize_preview() ) {
         wp_enqueue_script('colormag-bxslider');
      }

      extract( $args );
      extract( $instance );

      global $post;
      $title = apply_filters( 'widget_title', isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : '' );
      $text = isset( $instance[ 'text' ] ) ? $instance[ 'text' ] : '';
      $number = empty( $instance[ 'number' ] ) ? 4 : $instance[ 'number' ];
      $type = isset( $instance[ 'type' ] ) ? $instance[ 'type' ] : 'latest' ;
      $category = isset( $instance[ 'category' ] ) ? $instance[ 'category' ] : '';
      // For WPML plugin compatibility
      if ( function_exists( 'icl_register_string' ) ) {
         icl_register_string( 'ColorMag Pro', 'TG: Featured Posts (Style 6) Description' . $this->id, $text );
      }

      // adding the excluding post function
      $post__not_in = colormag_exclude_duplicate_posts();

      if( $type == 'latest' ) {
         $get_featured_posts = new WP_Query( array(
            'posts_per_page'        => $number,
            'post_type'             => 'post',
            'ignore_sticky_posts'   => true,
            'no_found_rows'         => true,
            'update_post_meta_cache' => false,
            'post__not_in'          => $post__not_in
         ) );
      }
      else {
         $get_featured_posts = new WP_Query( array(
            'posts_per_page'        => $number,
            'post_type'             => 'post',
            'category__in'          => $category,
            'no_found_rows'         => true,
            'update_post_meta_cache' => false,
            'post__not_in'          => $post__not_in
         ) );
      }

      colormag_append_excluded_duplicate_posts( $get_featured_posts );
      echo $before_widget;
      ?>
      <?php $featured = 'colormag-featured-image'; ?>
      <?php
      if ( $type != 'latest' ) {
         $border_color = 'style="border-bottom-color:' . colormag_category_color($category) . ';"';
         $title_color = 'style="background-color:' . colormag_category_color($category) . ';"';
      } else {
         $border_color = '';
         $title_color = '';
      }
      // For WPML plugin compatibility
      if ( function_exists( 'icl_t' ) ) {
         $text = icl_t( 'ColorMag Pro', 'TG: Featured Posts (Style 6) Description' . $this->id, $text );
      }
      if ( !empty( $title ) ) { echo '<h3 class="widget-title" '. $border_color .'><span ' . $title_color .'>'. esc_html( $title ) .'</span></h3>'; }
      if( !empty( $text ) ) { ?> <p> <?php echo esc_textarea( $text ); ?> </p> <?php } ?>
         <div class="thumbnail-slider-news">
         <?php
         $i=1;
         $big_image = '';
         $big_image_output = '';
         $thumbnail_image = '';
         $post_count = $get_featured_posts->post_count;
         while( $get_featured_posts->have_posts() ):$get_featured_posts->the_post();
            $j = $i-1;
            $title_attribute = get_the_title( $post->ID );
            if (has_post_thumbnail()) {
               $big_image = '<a href="' . get_permalink( $post->ID ) . '">' . get_the_post_thumbnail( $post->ID, 'colormag-featured-image', array( 'title' => esc_attr( $title_attribute ), 'alt' => esc_attr( $title_attribute ) ) ) . '</a>';
               $thumbnail_image .= '<a data-slide-index="' . $j . '" href="">' . get_the_post_thumbnail( $post->ID, 'colormag-default-news', array( 'title' => esc_attr( $title_attribute ), 'alt' => esc_attr( $title_attribute ) ) ) . '<span class="title">' . $title_attribute . '</span></a>';
            } else {
               $big_image = '<a href="' . get_permalink( $post->ID ) . '"><img src="' . get_template_directory_uri() . '/img/thumbnail-big-slider.png">' . '</a>';
               $thumbnail_image .= '<a data-slide-index="' . $j . '" href=""><img src="' . get_template_directory_uri() . '/img/thumbnail-small-slider.png">' . '<span class="title">' . $title_attribute . '</span></a>';
            }
            $big_image_output .= '<li class="single-article">'.$big_image.'<div class="article-content">'.colormag_colored_category_return().'<h3 class="entry-title"><a href="'.get_permalink().'" title="'.esc_attr($title_attribute).'">'.get_the_title().'</a></h3></div></li>';
            if ( $i == $number || $i == $post_count ) {
               ?>
               <ul class="thumbnail-big-sliders">
                  <?php echo $big_image_output; ?>
               </ul>
               <div class="thumbnail-slider">
                  <?php echo $thumbnail_image; ?>
               </div>
               <?php
            }
            $i++;
         endwhile; ?>
         <?php
         // Reset Post Data
         wp_reset_query();
         ?>
      </div>
      <?php echo $after_widget;
      }
}

/****************************************************************************************/

/**
 * Breaking News widget
 */
class colormag_breaking_news_widget extends WP_Widget {

   function __construct() {
      $widget_ops = array( 'classname' => 'widget_breaking_news_colormag widget_featured_posts', 'description' => __( 'Displays the breaking news in the news ticker way. Suitable for the Right/Left Sidebar', 'colormag') );
      $control_ops = array( 'width' => 200, 'height' =>250 );
      parent::__construct( false,$name= __( 'TG: Breaking News Widget', 'colormag' ),$widget_ops);
   }

   function form( $instance ) {
      $tg_defaults['number'] = 4;
      $tg_defaults['title'] = '';
      $instance = wp_parse_args( (array) $instance, $tg_defaults );
      $number = $instance['number'];
      $title = esc_attr( $instance[ 'title' ] );
      ?>
      <p>
         <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:', 'colormag' ); ?></label>
         <input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
      </p>
      <p>
         <label for="<?php echo $this->get_field_id('number'); ?>"><?php _e( 'Number of recent posts to show as the breaking news:', 'colormag' ); ?></label>
         <input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" />
      </p>
      <?php
   }

   function update( $new_instance, $old_instance ) {
      $instance = $old_instance;
      $instance[ 'number' ] = absint( $new_instance[ 'number' ] );
      $instance[ 'title' ] = strip_tags( $new_instance[ 'title' ] );

      return $instance;
   }

   function widget( $args, $instance ) {
      if ( is_active_widget( false, false, $this->id_base ) || is_customize_preview() ) {
         wp_enqueue_script('colormag-news-ticker');
      }

      extract( $args );
      extract( $instance );
      $number = empty( $instance[ 'number' ] ) ? 4 : $instance[ 'number' ];
      $title = apply_filters( 'widget_title', isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : '' );

      echo $before_widget;

      global $post;

      // adding the excluding post function
      $post__not_in = colormag_exclude_duplicate_posts();

      $get_featured_posts = new WP_Query( array(
         'posts_per_page'        => $number,
         'post_type'             => 'post',
         'ignore_sticky_posts'   => true,
         'no_found_rows'         => true,
         'post__not_in'          => $post__not_in
      ) );

      colormag_append_excluded_duplicate_posts( $get_featured_posts );
      ?>
      <?php $featured = 'colormag-featured-post-small'; ?>
      <?php
         if ( !empty( $title ) ) { echo $before_title . esc_html( $title ) . $after_title; } ?>
         <div class="breaking_news_widget_inner_wrap">
            <i class="fa fa-arrow-up" id="breaking-news-widget-prev"></i>
            <ul id="breaking-news-widget">
            <?php
            $i=1;
            while( $get_featured_posts->have_posts() ):$get_featured_posts->the_post();
               ?>
               <li class="single-article clearfix">
                  <?php
                  if( has_post_thumbnail() ) {
                     $image = '';
                     $title_attribute = get_the_title( $post->ID );
                     $image .= '<figure class="tabbed-images">';
                     $image .= '<a href="' . get_permalink() . '" title="'.the_title( '', '', false ).'">';
                     $image .= get_the_post_thumbnail( $post->ID, $featured, array( 'title' => esc_attr( $title_attribute ), 'alt' => esc_attr( $title_attribute ) ) ).'</a>';
                     $image .= '</figure>';
                     echo $image;
                  }
                  ?>
                  <div class="article-content">
                     <h3 class="entry-title">
                        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute();?>"><?php the_title(); ?></a>
                     </h3>
                     <div class="below-entry-meta">
                        <?php
                           $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
                           $time_string = sprintf( $time_string,
                              esc_attr( get_the_date( 'c' ) ),
                              esc_html( get_the_date() )
                           );
                           printf( __( '<span class="posted-on"><a href="%1$s" title="%2$s" rel="bookmark"><i class="fa fa-calendar-o"></i> %3$s</a></span>', 'colormag' ),
                              esc_url( get_permalink() ),
                              esc_attr( get_the_time() ),
                              $time_string
                           );
                        ?>
                        <span class="byline"><span ><i class="fa fa-user"></i><a class="url fn n" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" title="<?php echo get_the_author(); ?>"><?php echo esc_html( get_the_author() ); ?></a></span></span>
                        <span class="comments"><i class="fa fa-comment"></i><?php comments_popup_link( __('No Comment','colormag'), __('1 Comment','colormag'), __('% Comments','colormag') );?></span>
                     </div>
                  </div>
               </li>
            <?php
            $i++;
            endwhile;
            // Reset Post Data
            wp_reset_query();
            ?>
         </ul>
         <i class="fa fa-arrow-down" id="breaking-news-widget-next"></i>
      </div>
      <?php echo $after_widget;
      }
}

/****************************************************************************************/

/**
 * Ticker News Widget
 */
class colormag_ticker_news_widget extends WP_Widget {

   function __construct() {
      $widget_ops = array( 'classname' => 'widget_ticker_news_colormag widget_featured_posts', 'description' => __( 'Display latest posts or posts of specific category.', 'colormag') );
      $control_ops = array( 'width' => 200, 'height' =>250 );
      parent::__construct( false,$name= __( 'TG: Featured Posts (Style 7)', 'colormag' ),$widget_ops);
   }

   function form( $instance ) {
      $tg_defaults['title'] = '';
      $tg_defaults['text'] = '';
      $tg_defaults['number'] = 5;
      $tg_defaults['type'] = 'latest';
      $tg_defaults['category'] = '';
      $tg_defaults['popup'] = '0';
      $instance = wp_parse_args( (array) $instance, $tg_defaults );
      $title = esc_attr( $instance[ 'title' ] );
      $text = esc_textarea($instance['text']);
      $number = $instance['number'];
      $type = $instance['type'];
      $category = $instance['category'];
      $popup_link = $instance[ 'popup' ] ? 'checked="checked"' : '';
      ?>
      <p><?php _e( 'Layout will be as below:', 'colormag' ) ?></p>
      <div style="text-align: center;"><img src="<?php echo get_template_directory_uri() . '/img/style-7.jpg'?>"></div>
      <p>
         <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:', 'colormag' ); ?></label>
         <input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
      </p>
      <?php _e( 'Description','colormag' ); ?>
      <textarea class="widefat" rows="5" cols="20" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo $text; ?></textarea>
      <p>
         <label for="<?php echo $this->get_field_id('number'); ?>"><?php _e( 'Number of posts to display:', 'colormag' ); ?></label>
         <input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" />
      </p>

      <p><input type="radio" <?php checked($type, 'latest') ?> id="<?php echo $this->get_field_id( 'type' ); ?>" name="<?php echo $this->get_field_name( 'type' ); ?>" value="latest"/><?php _e( 'Show latest Posts', 'colormag' );?><br />
       <input type="radio" <?php checked($type,'category') ?> id="<?php echo $this->get_field_id( 'type' ); ?>" name="<?php echo $this->get_field_name( 'type' ); ?>" value="category"/><?php _e( 'Show posts from a category', 'colormag' );?><br /></p>

      <p>
         <label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php _e( 'Select category', 'colormag' ); ?>:</label>
         <?php wp_dropdown_categories( array( 'show_option_none' =>' ','name' => $this->get_field_name( 'category' ), 'selected' => $category ) ); ?>
      </p>
      <p>
         <input class="checkbox" <?php echo $popup_link; ?> id="<?php echo $this->get_field_id( 'popup' ); ?>" name="<?php echo $this->get_field_name( 'popup' ); ?>" type="checkbox" />
         <label for="<?php echo $this->get_field_id('popup'); ?>"><?php _e( 'Check to display the content in the popup', 'colormag' ); ?></label>
      </p>

      <?php
   }

   function update( $new_instance, $old_instance ) {
      $instance = $old_instance;
      $instance[ 'title' ] = strip_tags( $new_instance[ 'title' ] );
      if ( current_user_can('unfiltered_html') )
         $instance['text'] =  $new_instance['text'];
      else
         $instance['text'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['text']) ) );
      $instance[ 'number' ] = absint( $new_instance[ 'number' ] );
      $instance[ 'type' ] = $new_instance[ 'type' ];
      $instance[ 'category' ] = $new_instance[ 'category' ];
      $instance[ 'popup' ] = isset( $new_instance[ 'popup' ] ) ? 1 : 0;

      return $instance;
   }

   function widget( $args, $instance ) {
      if ( is_active_widget( false, false, $this->id_base ) || is_customize_preview() ) {
         wp_enqueue_script('colormag-bxslider');
      }

      extract( $args );
      extract( $instance );

      global $post;
      $title = apply_filters( 'widget_title', isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : '' );
      $text = isset( $instance[ 'text' ] ) ? $instance[ 'text' ] : '';
      $number = empty( $instance[ 'number' ] ) ? 5 : $instance[ 'number' ];
      $type = isset( $instance[ 'type' ] ) ? $instance[ 'type' ] : 'latest' ;
      $category = isset( $instance[ 'category' ] ) ? $instance[ 'category' ] : '';
      $popup_link = !empty( $instance[ 'popup' ] ) ? 'true' : 'false';

      if (($popup == 1) && (is_active_widget( false, false, $this->id_base ) || is_customize_preview())) {
         wp_enqueue_script( 'colormag-featured-image-popup' );
         wp_enqueue_style( 'colormag-featured-image-popup-css' );
      }
      // For WPML plugin compatibility
      if ( function_exists( 'icl_register_string' ) ) {
         icl_register_string( 'ColorMag Pro', 'TG: Featured Posts (Style 7) Description' . $this->id, $text );
      }

      // adding the excluding post function
      $post__not_in = colormag_exclude_duplicate_posts();

      if( $type == 'latest' ) {
         $get_featured_posts = new WP_Query( array(
            'posts_per_page'        => $number,
            'post_type'             => 'post',
            'ignore_sticky_posts'   => true,
            'no_found_rows'         => true,
            'update_post_meta_cache' => false,
            'update_post_term_cache' => false,
            'post__not_in'          => $post__not_in
         ) );
      }
      else {
         $get_featured_posts = new WP_Query( array(
            'posts_per_page'        => $number,
            'post_type'             => 'post',
            'category__in'          => $category,
            'no_found_rows'         => true,
            'update_post_meta_cache' => false,
            'post__not_in'          => $post__not_in
         ) );
      }

      colormag_append_excluded_duplicate_posts( $get_featured_posts );
      echo $before_widget;
      ?>
      <?php $featured = 'colormag-default-news'; ?>
      <?php
      if ( $type != 'latest' ) {
         $border_color = 'style="border-bottom-color:' . colormag_category_color($category) . ';"';
         $title_color = 'style="background-color:' . colormag_category_color($category) . ';"';
      } else {
         $border_color = '';
         $title_color = '';
      }
      // For WPML plugin compatibility
      if ( function_exists( 'icl_t' ) ) {
         $text = icl_t( 'ColorMag Pro', 'TG: Featured Posts (Style 7) Description' . $this->id, $text );
      }
      if ( !empty( $title ) ) { echo '<h3 class="widget-title" '. $border_color .'><span ' . $title_color .'>'. esc_html( $title ) .'</span></h3>'; }
      if( !empty( $text ) ) { ?> <p> <?php echo esc_textarea( $text ); ?> </p> <?php } ?>
         <div class="image-ticker-news">
         <?php
         $i=1;
         while( $get_featured_posts->have_posts() ):$get_featured_posts->the_post(); ?>
            <div class="single-article clearfix">
            <a href="<?php the_permalink(); ?>" data-fragment="#content" class="colormag-ticker-news-popup-link">
               <?php
               if( has_post_thumbnail() ) {
                  $image = '';
                  $title_attribute = get_the_title( $post->ID );
                  $image .= '<figure>';
                  if ( $popup_link == 'false' ) {
                     $image .= '<a href="' . get_permalink() . '" title="'.the_title( '', '', false ).'">';
                  }
                  $image .= get_the_post_thumbnail( $post->ID, $featured, array( 'title' => esc_attr( $title_attribute ), 'alt' => esc_attr( $title_attribute ) ) );
                  if ( $popup_link == 'false' ) {
                     $image .= '</a>';
                  }
                  $image .= '</figure>';
                  echo $image;
               }
               ?>
            </a>
               <div class="article-content">
                  <?php colormag_colored_category(); ?>
                  <h3 class="entry-title">
                     <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute();?>"><?php the_title(); ?></a>
                  </h3>
               </div>
            </div>
         <?php
         $i++;
         endwhile;
         // Reset Post Data
         wp_reset_query();
         ?>
      </div>
      <?php echo $after_widget;
      }
}

/**
 * Featured Posts widget
 */
class colormag_featured_posts_small_thumbnails extends WP_Widget {

   function __construct() {
      $widget_ops = array( 'classname' => 'widget_featured_posts widget_featured_posts_small_thumbnails widget_featured_meta', 'description' => __( 'Display latest posts or posts of specific category.', 'colormag') );
      $control_ops = array( 'width' => 200, 'height' =>250 );
      parent::__construct( false,$name= __( 'TG: Featured Posts (Style 3)', 'colormag' ),$widget_ops);
   }

   function form( $instance ) {
      $tg_defaults['title'] = '';
      $tg_defaults['text'] = '';
      $tg_defaults['number'] = 4;
      $tg_defaults['type'] = 'latest';
      $tg_defaults['category'] = '';
      $instance = wp_parse_args( (array) $instance, $tg_defaults );
      $title = esc_attr( $instance[ 'title' ] );
      $text = esc_textarea($instance['text']);
      $number = $instance['number'];
      $type = $instance['type'];
      $category = $instance['category'];
      ?>
      <p><?php _e( 'Layout will be as below:', 'colormag' ) ?></p>
      <div style="text-align: center;"><img src="<?php echo get_template_directory_uri() . '/img/style-3.jpg'?>"></div>
      <p>
         <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:', 'colormag' ); ?></label>
         <input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
      </p>
      <?php _e( 'Description','colormag' ); ?>
      <textarea class="widefat" rows="5" cols="20" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo $text; ?></textarea>
      <p>
         <label for="<?php echo $this->get_field_id('number'); ?>"><?php _e( 'Number of posts to display:', 'colormag' ); ?></label>
         <input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" />
      </p>

      <p><input type="radio" <?php checked($type, 'latest') ?> id="<?php echo $this->get_field_id( 'type' ); ?>" name="<?php echo $this->get_field_name( 'type' ); ?>" value="latest"/><?php _e( 'Show latest Posts', 'colormag' );?><br />
       <input type="radio" <?php checked($type,'category') ?> id="<?php echo $this->get_field_id( 'type' ); ?>" name="<?php echo $this->get_field_name( 'type' ); ?>" value="category"/><?php _e( 'Show posts from a category', 'colormag' );?><br /></p>

      <p>
         <label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php _e( 'Select category', 'colormag' ); ?>:</label>
         <?php wp_dropdown_categories( array( 'show_option_none' =>' ','name' => $this->get_field_name( 'category' ), 'selected' => $category ) ); ?>
      </p>
      <?php
   }

   function update( $new_instance, $old_instance ) {
      $instance = $old_instance;
      $instance[ 'title' ] = strip_tags( $new_instance[ 'title' ] );
      if ( current_user_can('unfiltered_html') )
         $instance['text'] =  $new_instance['text'];
      else
         $instance['text'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['text']) ) );
      $instance[ 'number' ] = absint( $new_instance[ 'number' ] );
      $instance[ 'type' ] = $new_instance[ 'type' ];
      $instance[ 'category' ] = $new_instance[ 'category' ];

      return $instance;
   }

   function widget( $args, $instance ) {
      extract( $args );
      extract( $instance );

      global $post;
      $title = apply_filters( 'widget_title', isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : '' );
      $text = isset( $instance[ 'text' ] ) ? $instance[ 'text' ] : '';
      $number = empty( $instance[ 'number' ] ) ? 4 : $instance[ 'number' ];
      $type = isset( $instance[ 'type' ] ) ? $instance[ 'type' ] : 'latest' ;
      $category = isset( $instance[ 'category' ] ) ? $instance[ 'category' ] : '';

      // For WPML plugin compatibility
      if ( function_exists( 'icl_register_string' ) ) {
         icl_register_string( 'ColorMag Pro', 'TG: Featured Posts (Style 3) Description' . $this->id, $text );
      }

      // adding the excluding post function
      $post__not_in = colormag_exclude_duplicate_posts();

      if( $type == 'latest' ) {
         $get_featured_posts = new WP_Query( array(
            'posts_per_page'        => $number,
            'post_type'             => 'post',
            'ignore_sticky_posts'   => true,
            'no_found_rows'         => true,
            'post__not_in'          => $post__not_in
         ) );
      }
      else {
         $get_featured_posts = new WP_Query( array(
            'posts_per_page'        => $number,
            'post_type'             => 'post',
            'category__in'          => $category,
            'no_found_rows'         => true,
            'post__not_in'          => $post__not_in
         ) );
      }

      colormag_append_excluded_duplicate_posts( $get_featured_posts );
      echo $before_widget;
      ?>
      <?php
         if ( $type != 'latest' ) {
            $border_color = 'style="border-bottom-color:' . colormag_category_color($category) . ';"';
            $title_color = 'style="background-color:' . colormag_category_color($category) . ';"';
         } else {
            $border_color = '';
            $title_color = '';
         }
         // For WPML plugin compatibility
         if ( function_exists( 'icl_t' ) ) {
            $text = icl_t( 'ColorMag Pro', 'TG: Featured Posts (Style 3) Description' . $this->id, $text );
         }
         if ( !empty( $title ) ) { echo '<h3 class="widget-title" '. $border_color .'><span ' . $title_color .'>'. esc_html( $title ) .'</span></h3>'; }
         if( !empty( $text ) ) { ?> <p> <?php echo esc_textarea( $text ); ?> </p> <?php } ?>
         <?php $featured = 'colormag-featured-post-small'; ?>
         <div class="following-post">
         <?php
         $i=1;
         while( $get_featured_posts->have_posts() ):$get_featured_posts->the_post();
            ?>
               <div class="single-article clearfix">
                  <?php
                  if( has_post_thumbnail() ) {
                     $image = '';
                     $title_attribute = get_the_title( $post->ID );
                     $image .= '<figure>';
                     $image .= '<a href="' . get_permalink() . '" title="'.the_title( '', '', false ).'">';
                     $image .= get_the_post_thumbnail( $post->ID, $featured, array( 'title' => esc_attr( $title_attribute ), 'alt' => esc_attr( $title_attribute ) ) ).'</a>';
                     $image .= '</figure>';
                     echo $image;
                  }
                  ?>
                  <div class="article-content">
                     <?php colormag_colored_category(); ?>
                     <h3 class="entry-title">
                        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute();?>"><?php the_title(); ?></a>
                     </h3>
                     <div class="below-entry-meta">
                        <?php
                           $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
                           $time_string = sprintf( $time_string,
                              esc_attr( get_the_date( 'c' ) ),
                              esc_html( get_the_date() )
                           );
                           printf( __( '<span class="posted-on"><a href="%1$s" title="%2$s" rel="bookmark"><i class="fa fa-calendar-o"></i> %3$s</a></span>', 'colormag' ),
                              esc_url( get_permalink() ),
                              esc_attr( get_the_time() ),
                              $time_string
                           );
                        ?>
                        <span class="byline"><span ><i class="fa fa-user"></i><a class="url fn n" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" title="<?php echo get_the_author(); ?>"><?php echo esc_html( get_the_author() ); ?></a></span></span>
                        <span class="comments"><i class="fa fa-comment"></i><?php comments_popup_link( '0', '1', '%' );?></span>
                     </div>
                  </div>
               </div>
         <?php
            $i++;
         endwhile; ?>
         </div>
         <?php
         // Reset Post Data
         wp_reset_query();
         ?>
      <?php echo $after_widget;
      }

}
?>
