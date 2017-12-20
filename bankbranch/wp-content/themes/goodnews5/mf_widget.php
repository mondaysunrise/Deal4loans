<?php
if($_SERVER['REQUEST_URI'] != "/bankbranch/" && (strlen(strpos($_SERVER['REQUEST_URI'], "/bankbranch/category/")) < 1) && (strlen(strpos($_SERVER['REQUEST_URI'], "/bankbranch/?s=")) < 1))
{
	$d4l_section="Wordpress CMS";
	include "../mf_apply_widget.php";
}
?>