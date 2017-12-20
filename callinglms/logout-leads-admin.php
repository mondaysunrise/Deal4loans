<?php
include_once("includes/application-top.php");
	session_unset();
	session_destroy();
	redirectURL(SITE_URL."leads-admin-login.php");
?>