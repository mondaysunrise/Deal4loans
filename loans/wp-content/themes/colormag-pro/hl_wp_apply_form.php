<?php
if($_SERVER['REQUEST_URI'] != "/loans/" && $_SERVER['REQUEST_URI'] != "/loans/category/home-loan/" && (strlen(strpos($_SERVER['REQUEST_URI'], "/loans/category/")) < 1) && (strlen(strpos($_SERVER['REQUEST_URI'], "/loans/?s=")) < 1))
{
	$d4l_section="Wordpress CMS";
	$subjectLine = "GET INSTANT HOME LOAN QUOTES ONLINE";
	include "../home-loans-widget-wp.php";
	$view_form=1;
}
?>