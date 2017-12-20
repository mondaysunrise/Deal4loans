<?php
	session_start();
	if(!isset($_SESSION['Email-sms'])){
		header("Location: smslogin.php");
		exit;

	}
?>