<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package ThemeGrill
 * @subpackage ColorMag
 * @since ColorMag 1.0
 */
?>

<?php
$featured_image_size = 'colormag-featured-image';
$class_name_layout_two = '';
if (get_theme_mod('colormag_archive_search_layout', 'double_column_layout') == 'single_column_layout') {
		$featured_image_size = 'colormag-featured-post-medium';
		$class_name_layout_two = 'archive-layout-two';
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( $class_name_layout_two ); ?>>
   <?php do_action( 'colormag_before_post_content' ); ?>

   <?php if ( has_post_thumbnail() ) { ?>
      <div class="featured-image">
         <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail( $featured_image_size ); ?></a>
      </div>
   <?php } ?>

   <div class="article-content clearfix">

      <?php if( get_post_format() ) { get_template_part( 'inc/post-formats' ); } ?>

      <?php colormag_colored_category(); ?>

      <header class="entry-header">
         <h2 class="entry-title">
            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute();?>"><?php the_title(); ?></a>
         </h2>
      </header>

      <?php colormag_entry_meta(); ?>

      <div class="entry-content clearfix">
         <?php the_excerpt(); ?>
         <a class="more-link" title="<?php the_title(); ?>" href="<?php the_permalink(); ?>"><span><?php echo get_theme_mod('colormag_read_more_text', esc_html__( 'Read more', 'colormag' ) ); ?></span></a>
      </div>

   </div>

   <?php do_action( 'colormag_after_post_content' ); ?>
</article>
