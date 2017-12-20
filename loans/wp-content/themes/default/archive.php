<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
//get_header(); 
?>

<?php get_header(); ?>
<!-- End Main Banner Menu Panel -->
<!-- Start Main Container Panel -->
<?php $postida=get_the_ID();

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
<div class="leftwpwrapper">
<!--	<div id="lftbar">
<div class="lfttxtbar">
 -->
  <? }?>


  <div id="txt">
  <?php //if (function_exists('HAG_Breadcrumbs')) { HAG_Breadcrumbs(); } ?>
<!--<table width="776"><tr><td width="556" valign="top">-->
	<?php if (have_posts()) : ?>

 	  <?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
 	  <?php /* If this is a category archive */ //if (is_category()) { ?>
		<!--<h2 class="pagetitle">Archive for the &#8216;<?php//single_cat_title(); ?>&#8217; Category</h2>-->
 	  <?php /* If this is a tag archive */ //} elseif( is_tag() ) { ?>
		<!-- <h2 class="pagetitle">Posts Tagged &#8216;<?php //single_tag_title(); ?>&#8217;</h2> -->
 	  <?php /* If this is a daily archive */ //} elseif (is_day()) { ?>
		<!--<h2 class="pagetitle">Archive for <?php the_time('F jS, Y'); ?></h2>-->
 	  <?php /* If this is a monthly archive */ //} elseif (is_month()) { ?>
		<!--<h2 class="pagetitle">Archive for <?php //the_time('F, Y'); ?></h2>-->
 	  <?php /* If this is a yearly archive */ //} elseif (is_year()) { ?>
	<!--	<h2 class="pagetitle">Archive for <?php //the_time('Y'); ?></h2>-->
	  <?php /* If this is an author archive */ //} elseif (is_author()) { ?>
	<!--	<h2 class="pagetitle">Author Archive</h2>-->
 	  <?php /* If this is a paged archive */ //} elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
<!--		<h2 class="pagetitle">Blog Archives</h2>-->
 	  <?php //} ?>


	<!--	<div class="navigation">
			<div class="alignleft"><?php //next_posts_link('&laquo; Older Entries') ?></div>
			<div class="alignright"><?php //previous_posts_link('Newer Entries &raquo;') ?></div>
		</div>-->

		<?php while (have_posts()) : the_post(); ?>
		<div <?php post_class() ?>>
				<h1 id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
				<small><?php the_time('l, F jS, Y') ?></small>

				<div class="entry">
					<?php the_content() ?>
				</div>

				<p class="postmetadata"><?php the_tags('Tags: ', ', ', '<br />'); ?> Posted in <?php the_category(', ') ?> | <?php edit_post_link('Edit', '', ' | '); ?>  <?php comments_popup_link('No Comments &#187;', '1 Comment &#187;', '% Comments &#187;'); ?></p>

			</div>

		<?php endwhile; ?>

		<div class="navigation">
			<div class="alignleft"><?php next_posts_link('&laquo; Older Entries') ?></div>
			<div class="alignright"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
		</div>
	<?php else :

		if ( is_category() ) { // If this is a category archive
			printf("<h2 class='center'>Sorry, but there aren't any posts in the %s category yet.</h2>", single_cat_title('',false));
		} else if ( is_date() ) { // If this is a date archive
			echo("<h2>Sorry, but there aren't any posts with this date.</h2>");
		} else if ( is_author() ) { // If this is a category archive
			$userdata = get_userdatabylogin(get_query_var('author_name'));
			printf("<h2 class='center'>Sorry, but there aren't any posts by %s yet.</h2>", $userdata->display_name);
		} else {
			echo("<h2 class='center'>No posts found.</h2>");
			?>
            <div align="center" style=" clear:both; padding:10px; ">
<script type="text/javascript"><!--
google_ad_client = "pub-6880092259094596";
/* 250x250, created 11/5/09 */
google_ad_slot = "8894074569";
google_ad_width = 250;
google_ad_height = 250;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
</div>
            <?php
		}
		get_search_form();

	endif;
?>

	<!--</td><td width="220"  valign="top"> <div ></div></td></tr></table>-->
</div> 

<? if ($view_form==1)
{
?>

<?php
}
else
{ ?></div>
<!--</div>
</div> -->
<? } ?>
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

<?php get_footer(); ?>
</body>
</html>