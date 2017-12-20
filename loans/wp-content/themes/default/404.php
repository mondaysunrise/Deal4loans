<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

get_header();
//echo $_SERVER['REQUEST_URI'];

if((strlen(strpos($_SERVER['REQUEST_URI'], "loans/bank-info/yes-bank-credit-cards")) > 0))
{

}
else if((strlen(strpos($_SERVER['REQUEST_URI'], "personal")) > 0))
{
	header("Location: /personal-loans.php");
	exit();
}
else if((strlen(strpos($_SERVER['REQUEST_URI'], "home")) > 0))
{
	header("Location: /home-loans.php");
	exit();
}
else if((strlen(strpos($_SERVER['REQUEST_URI'], "car-")) > 0))
{
	header("Location: /car-loans.php");
	exit();
}
else if((strlen(strpos($_SERVER['REQUEST_URI'], "credit")) > 0))
{
	header("Location: /credit-cards.php");
	exit();
}
else if((strlen(strpos($_SERVER['REQUEST_URI'], "property")) > 0))
{
	header("Location: /loan-against-property.php");
	exit();
}
else if((strlen(strpos($_SERVER['REQUEST_URI'], "education")) > 0))
{
	header("Location: /loans/education-loan/education-loan-student-loan/");
	exit();
}
else
{
	header("Location: /index.php");
	exit();
}
?>

	<div id="content" class="narrowcolumn">

		<h2 class="center">Error 404 - Not Found</h2>
        
        <div align="center" style=" clear:both; padding:40px; ">
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

	</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>