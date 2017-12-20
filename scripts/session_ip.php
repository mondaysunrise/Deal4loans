<?php
	session_start();
	if(!isset($_SESSION['Email'])){
		header("Location: ip-creation.php");
		exit;
	}
?>