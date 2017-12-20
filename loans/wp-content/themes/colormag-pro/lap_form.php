<?php
if($_SERVER['REQUEST_URI'] != "/loans/" && $_SERVER['REQUEST_URI'] != "/loans/category/loan-against-property/"  && (strlen(strpos($_SERVER['REQUEST_URI'], "/loans/category/")) < 1) && (strlen(strpos($_SERVER['REQUEST_URI'], "/loans/?s=")) < 1))
{
	$d4l_section="Wordpress CMS";
	$TagLine = "Get Free Instant Quotes on Rates, EMI & Eligibility on Loan Against Property";
	include "../loan-against-property-widget-wp.php";
}
?>