<?php
	session_start();
	if(!isset($_SESSION['Email'])){
		header("Location: bidders-creation.php");
		exit;
	}
?>