<?php
/**
 * Theme Footer Section for our theme.
 *
 * Displays all of the footer section and closing of the #main div.
 *
 * @package ThemeGrill
 * @subpackage ColorMag
 * @since ColorMag 1.0
 */
// echo "<pre>";
// print_r($_SERVER);
?>

		</div><!-- .inner-wrap -->
	</div><!-- #main -->
   <?php if ( is_active_sidebar('colormag_advertisement_above_the_footer_sidebar') ) { ?>
      <div class="advertisement_above_footer">
         <div class="inner-wrap">
            <?php dynamic_sidebar('colormag_advertisement_above_the_footer_sidebar'); ?>
         </div>
      </div>
   <?php } ?>
	<?php do_action( 'colormag_before_footer' ); ?>
		<footer id="colophon" class="clearfix">
			<?php get_sidebar( 'footer' ); ?>
			<div class="footer-socket-wrapper clearfix">
				<div class="inner-wrap">
					<div class="footer-socket-area">
                  <div class="footer-socket-right-section">
   						<?php if( get_theme_mod( 'colormag_social_link_activate', 0 ) == 1 ) { colormag_social_links(); } ?>
                     <nav class="footer-menu" class="clearfix">
                        <?php
                           if ( has_nav_menu( 'footer' ) ) {
                              wp_nav_menu( array( 'theme_location' => 'footer',
                                                   'depth' => -1
                              ) );
                           }
                        ?>
                     </nav>
                  </div>
                  <div class="footer-socket-left-section">
   						<?php do_action( 'colormag_footer_copyright' ); ?>
                  </div>
					</div>

				</div>
			</div>
		</footer>
      <?php if (get_theme_mod( 'colormag_scroll_to_top', 0 ) == 0 ) { ?>
         <a href="#masthead" id="scroll-up"><i class="fa fa-chevron-up"></i></a>
      <?php } ?>
	</div><!-- #page -->
	<?php wp_footer(); ?>
</body>
</html>