<?php
/*
Plugin Name: Possibly Related Recent Posts
Plugin URI: http://sivel.net/wordpress/
Description: Automatically displays possibly related posts at the end of each post using a filter on the_content.  List generated on the fly by recency and the categories the current post is in.	Does NOT use tags.
Author: Matt Martz
Author URI: http://sivel.net/
Version: 1.3

		Copyright (c) 2008 Matt Martz (http://sivel.net)
		Possibly Related Recent Posts is released under the GNU General Public License (GPL)
		http://www.gnu.org/licenses/gpl-2.0.txt
*/

function possibly_related_recent_posts ( $related_content ) {
	$prrp = get_option('possibly_related_recent_posts');
	if ( empty ( $prrp ) )
		add_option('possibly_related_recent_posts', array ( 'on_home' => 'true' ) );
	if ( ! is_page () && $prrp['on_home'] != 'false' ) :
		global $post;
		$p = $post;
		$categories = '';
		foreach ( ( get_the_category () ) as $category ) :
			$categories .= $categories . ',' . $category->cat_ID ;
		endforeach;
		$related = '<p><strong>You Might find these relevant: </strong></p>' . "\r\n";
		$related .= '<ul>' . "\r\n";
		$related_links = '';
		foreach ( ( get_posts ( 'numberposts=10&category=' . $categories . '&orderby=date&exclude=' . $post->ID ) ) as $post ) :
			 $related_links .= '<li><a href="' . get_permalink($post->ID) . '" style="font-size:12px;">' . get_the_title($post->ID) . '</a></li>' . "\r\n";
		endforeach;
		if ( isset ( $related_links ) )
			$related .= $related_links;
		else
			$related .= '<li>None found</li>' . "\r\n";
		$related .= '</ul><br />' . "\r\n";
		$related_content = $related_content . "\r\n" . $related;
	endif;
	$post = $p;
	return $related_content;
}

function possibly_related_recent_posts_menu () {
	if ( current_user_can ( 'manage_options' ) && function_exists ( 'add_options_page' ) ) {
		add_options_page ( 'Possibly Related Recent Posts' , 'Possibly Related Recent Posts' , 'manage_options' , 'prrp' , 'possibly_related_recent_posts_page' );
	}
}

function possibly_related_recent_posts_page () {
	if ( ! empty ( $_POST['action'] ) && $_POST['action'] == 'update' ) {
		$prrp = array ( 'on_home' => $_POST['on_home'] );
		update_option ( 'possibly_related_recent_posts' , $prrp );
		echo '<div id="message" class="updated fade"><p><strong>Settings saved.</strong></p></div>';
	} else {
		$prrp = get_option ( 'possibly_related_recent_posts' );
		if ( empty ( $prrp ) )
			add_option('possibly_related_recent_posts', array ( 'on_home' => 'true' ) );
	}
?>
	<div class="wrap">
		<h2>Possibly Related Recent Posts Settings</h2>
		<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
			<input type="hidden" name="action" value="update" />
			<table class="form-table">
				<tr valign="top">
					<th scope="row">
						Display on blog page?
					</th>
					<td>
						<select name="on_home">
							<option value="true"<?php selected ( 'true' , $prrp['on_home'] ); ?>>true</option>
							<option value="false"<?php selected ( 'false' , $prrp['on_home'] ); ?>>false</option>
						</select>
						<br />
						Default is true.
					</td>
				</tr>
			</table>
			<p class="submit">
				<input type="submit" name="submit" class="button-primary" value="<?php _e( 'Save Changes' ); ?>" />
			</p>
		</form>
	</div>
<?php

}

add_filter ( 'the_content' , 'possibly_related_recent_posts' );
add_action ( 'admin_menu' , 'possibly_related_recent_posts_menu' ) ;

?>
