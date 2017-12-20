<?php
//include 'scripts/functions.php';
session_start();
	

	//$msg = "Sorry, Please Login First!!!!";
	if(!isset($_SESSION['Name'])){
	$LoginVar = "Please Login";
	header("Location: BillingAdmin.php?$lv=$LoginVar");
	exit;
	}
?>