<?php
	session_start();
	if(!isset($_SESSION["BidderID"])){
		header("Location: http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."no_session.php");
		exit;

	}
?>