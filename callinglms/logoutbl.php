<?php
include_once("includes/application-topbl.php");
	session_unset();
	session_destroy();
	redirectURL(SITE_URL."login.php");
?>