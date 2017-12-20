<?php
	session_start();
	if(!isset($_SESSION['Email-getdata'])){
		header("Location: loginfordata.php");
		exit;

	}
?>