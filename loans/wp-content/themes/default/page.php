<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

//get_header(); ?>


<?
if((strlen(strpos($_SERVER['REQUEST_URI'], "/loans/credit-card/hdfc-credit-card-eligibility-apply/")) > 0) || (strlen(strpos($_SERVER['REQUEST_URI'], "/loans/banks/sbi-credit-cards/")) > 0) || (strlen(strpos($_SERVER['REQUEST_URI'], "/loans/credit-card/icici-bank-credit-cards-eligibility-documents-apply/")) > 0) || (strlen(strpos($_SERVER['REQUEST_URI'], "/loans/car-loan/sbi-advantage-car-loans-car-loan-scheme-sbi/")) > 0) || (strlen(strpos($_SERVER['REQUEST_URI'], "/loans/calculators/sbi-home-loan-emi-calculator-eligibility-calculator/")) > 0) || (strlen(strpos($_SERVER['REQUEST_URI'], "/loans/education-loan/sbi-education-loan-interest-rates-documents-sbi-schemes/")) > 0) || (strlen(strpos($_SERVER['REQUEST_URI'], "/loans/personal-loan/hdfc-personal-loan-bhopal-interest-rates-apply-online/")) > 0) || (strlen(strpos($_SERVER['REQUEST_URI'], "/loans/loan/gold-loan-loan/sbi-gold-loan-interest-rates-onlinme-apply-eligibility/")) > 0) || (strlen(strpos($_SERVER['REQUEST_URI'], "/loans/loan/hdfc-bank-business-loan-interest-rates-documents-apply/")) > 0))

{
	$responsiveTheme = "active";
}	
else
{
	$responsiveTheme = "active";
	//$responsiveTheme = "active";
}

 get_header(); ?>

  <!-- End Main Banner Menu Panel -->
  <!-- Start Main Container Panel -->
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
if($responsiveTheme == "active")
{?>
    <div class="wp_main">
   <?php
   }
?>

<?php	
}
else
{
	?>
    <?php
if($responsiveTheme == "active")
{?>
    <div class="wp_main">
   <?php
   }
   else
   {
   ?> 
   
   <!--
    <div style="width:663px;  margin-top:0px; float:left; clear:right;">
   -->
   <div style="width:100%; margin-top:0px; float:left; clear:right;">
   
    <?php
	}
	?>
<!--	<div id="lftbar">
<div class="lfttxtbar">
 -->
  <? }?>

  <div id="txt">
  <?php //if (function_exists('HAG_Breadcrumbs')) { HAG_Breadcrumbs(); } ?>
<!--<table width="776"><tr><td width="556" valign="top">-->
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<div class="post" id="post-<?php the_ID(); ?>">
		<h1><?php the_title(); ?></h1>
			<div class="entry">
			<?php the_content('<p class="serif">Read the rest of this page &raquo;</p>'); ?>
			<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
			</div>
		</div>
		<?php endwhile; endif; ?>
	<?php edit_post_link('Edit this entry.', '<p>', '</p>'); ?>
	<!--</td><td width="220"  valign="top"> <div ></div></td></tr></table>-->
</div> 
<? if ($view_form==1)
{
if($responsiveTheme == "active")
{?>
    </div>
   <?php
   }
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