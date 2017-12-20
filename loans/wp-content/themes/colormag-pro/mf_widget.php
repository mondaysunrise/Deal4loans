<?php
if($_SERVER['REQUEST_URI'] != "/loans/" && (strlen(strpos($_SERVER['REQUEST_URI'], "/loans/category/")) < 1) && (strlen(strpos($_SERVER['REQUEST_URI'], "/loans/?s=")) < 1))
{
	$d4l_section="Wordpress CMS";
	include "../mf_apply_widget.php";
}
?>