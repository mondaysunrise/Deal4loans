<?php
$page=$_REQUEST["pg"];
include_once("includes/application-top.php");
	session_unset();
	session_destroy();
	if($page=="HL")
	{
		redirectURL(SITE_URL."hllmslogin.php");
	}
	else
	{
		redirectURL(SITE_URL."lmslogin.php");
	}
?>