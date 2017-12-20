<?php
	session_start();
	if(!isset($_SESSION['Email'])){
		header("Location: http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."no_session.php");
		exit;

	}
?>