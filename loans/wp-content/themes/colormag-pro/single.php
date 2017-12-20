<?php
/**
 * Theme Single Post Section for our theme.
 *
 * @package ThemeGrill
 * @subpackage ColorMag
 * @since ColorMag 1.0
 */
?>

<?php get_header(); ?>

	<?php do_action( 'colormag_before_body_content' ); ?>

	<div id="primary">
		<div id="content" class="clearfix">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'single' ); ?>

			<?php endwhile; ?>

		</div><!-- #content -->

      <?php get_template_part( 'navigation', 'single' ); ?>

      <?php if ( get_the_author_meta( 'description' ) ) : ?>
         <div class="author-box">
            <div class="author-img"><?php echo get_avatar( get_the_author_meta( 'user_email' ), '100' ); ?></div>
            <div class="author-description-wrapper">
               <h4 class="author-name"><?php the_author_meta( 'display_name' ); ?></h4>
               
               <p class="author-description"><?php the_author_meta( 'description' ); ?></p>
               <?php if ( get_theme_mod( 'colormag_author_bio_social_sites_show', 0 ) == 1 )
                  colormag_author_social_link();
               ?>
               <?php if (get_theme_mod('colormag_author_bio_links', 0) == 1) { ?>
                  <p class="author-url"><?php printf(__('%1$s has %2$s posts and counting.', 'colormag'), get_the_author_meta('user_nicename'), absint(count_user_posts(get_the_author_meta('ID')))); ?><a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>"><?php printf(__('See all posts by %1$s', 'colormag'), get_the_author_meta('user_nicename')); ?></a></p>
               <?php } ?>
            </div>
         </div>

      <?php endif; ?>

      <?php if ( get_theme_mod( 'colormag_social_share', 0 ) == 1 )
         get_template_part( 'inc/share' );
      ?>

      <?php if ( get_theme_mod( 'colormag_related_posts_activate', 0 ) == 1 )
         get_template_part( 'inc/related-posts' );
      ?>

      <?php
         do_action( 'colormag_before_comments_template' );
         // If comments are open or we have at least one comment, load up the comment template
         if ( comments_open() || '0' != get_comments_number() )
            comments_template();
         do_action ( 'colormag_after_comments_template' );
      ?>

	</div><!-- #primary -->

	<?php colormag_sidebar_select(); ?>

	<?php do_action( 'colormag_after_body_content' ); ?>

<?php get_footer(); ?>