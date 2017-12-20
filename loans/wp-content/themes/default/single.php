<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

//get_header(); ?>

<? get_header(); ?>

<? $postida=get_the_ID();

$getpost="select view_form from wp_posts Where ID=".$postida;
$resultpost = mysql_query($getpost);
$postrow = mysql_fetch_array($resultpost);
$view_form = $postrow['view_form'];
//echo "<br>".$view_form."<br>";
?>
  <!-- End Main Banner Menu Panel -->
  <!-- Start Main Container Panel -->

  
<? if ($view_form==1)
{
?>

<?php	
}
else
{
?>
<style type="text/css">

/*..................................new styles added on 23-9-2014 Satarts ...........*/
  
.left_boxtablecms{float:left; width:645px; margin-top:10px;}
.left_boxtablecms_right{float:left; width:275px; margin-left:50px;}

@media screen and (max-width: 768px) {

.left_boxtablecms{width:100%; float:none!important; margin-top:10px;}
.left_boxtablecms_right{width:275px; margin: auto; clear:both;}

}
  
/*...................................new styles added on 23-9-2014 Satarts ...........*/

</style>

<div class="left_boxtablecms">

<!--	<div id="lftbar">
<div class="lfttxtbar">
 -->
  <? }?>
    <div id="txt">
    <?php //if (function_exists('HAG_Breadcrumbs')) { HAG_Breadcrumbs(); } ?>
<!--<table width="776"><tr><td width="556" valign="top">-->
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<!--<div class="navigation">
			<div class="alignleft"><?php// previous_post_link('&laquo; %link') ?><br></div>
			<div class="alignright"><?php //next_post_link('%link &raquo;') ?></div>
		</div>-->

		<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
	<h1><?php the_title(); ?></h1>
			<div class="entry">
<p><!-- Place this tag where you want the +1 button to render. -->
<div class="g-plusone" data-size="tall" data-annotation="inline" data-width="250"></div>

    <!-- Place this tag after the last +1 button tag. -->
    <script type="text/javascript">
      (function() {
        var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
        po.src = 'https://apis.google.com/js/platform.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
      })();
    </script>
    </p>
				<?php the_content('<p class="serif">Read the rest of this entry &raquo;</p>'); ?>

				<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
				<?php the_tags( '<p>Tags: ', ', ', '</p>'); ?>

				<!--<p class="postmetadata alt">
					<small>
						This entry was posted
						<?php /* This is commented, because it requires a little adjusting sometimes.
							You'll need to download this plugin, and follow the instructions:
							http://binarybonsai.com/wordpress/time-since/ */
							/* $entry_datetime = abs(strtotime($post->post_date) - (60*120)); echo time_since($entry_datetime); echo ' ago'; */ ?>
						on <?php the_time('l, F jS, Y') ?> at <?php the_time() ?>
						and is filed under <?php the_category(', ') ?>.
						You can follow any responses to this entry through the <?php post_comments_feed_link('RSS 2.0'); ?> feed.

						<?php if ( comments_open() && pings_open() ) {
							// Both Comments and Pings are open ?>
							You can <a href="#respond">leave a response</a>, or <a href="<?php trackback_url(); ?>" rel="trackback">trackback</a> from your own site.

						<?php } elseif ( !comments_open() && pings_open() ) {
							// Only Pings are Open ?>
							Responses are currently closed, but you can <a href="<?php trackback_url(); ?> " rel="trackback">trackback</a> from your own site.

						<?php } elseif ( comments_open() && !pings_open() ) {
							// Comments are open, Pings are not ?>
							You can skip to the end and leave a response. Pinging is currently not allowed.

						<?php } elseif ( !comments_open() && !pings_open() ) {
							// Neither Comments, nor Pings are open ?>
							Both comments and pings are currently closed.

						<?php } edit_post_link('Edit this entry','','.'); ?>

					</small>
				</p>-->

			</div>
		</div>
        </div>
<? if ($view_form==1 || $d4l_section=="Wordpress CMS")
		{
		}
		
	else
	{?>
	
	<?php //comments_template(); ?>
	
	<? }?>



	<?php endwhile; else: ?>

		<p>Sorry, no posts matched your criteria.</p>

<?php endif; ?>
	<!--</td><td width="220"  valign="top"> <div ></div></td></tr></table>-->
<? if ($view_form==1)
{
?>

<?php
}
else
{ ?>
</div>
<!--</div>
</div> -->
<? } ?>

<div class="left_boxtablecms_right">

<?php 

if ($view_form==1 || $d4l_section=="Wordpress CMS")
{ ?>
</div>
<? }
else
{
?>
<?php get_sidebar(); ?>
<? } ?>
</div>
<?php get_footer(); ?>
</body>
</html>