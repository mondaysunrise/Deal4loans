<?php
	require 'scripts/session_check_online.php';
	require 'scripts/functions.php';
	require 'scripts/db_init.php';	
	$Name = $_POST['Name'];
	$Phone = $_POST['Phone'];
	$Email = $_POST['Email'];
	$City = $_POST['City'];
	$City_Other = $_POST['City_Other'];
	$product = "Personal Loan";
	$Partner_ID = $_POST['Partner_ID'];
	
	$pwd = $_POST['pwd'];
	$insertSql = "update Req_Partner set Partner_Username='".$Email."' , Partner_Password='".$pwd."' , Partner_Name='".$Name."' ,Partner_Email='".$Email."' ,Partner_City='".$City."' ,Partner_City_Other='".$City_Other."' ,Partner_Mobile='".$Phone."' where Partner_ID='".$Partner_ID."'";
	$insertQuery = ExecQuery($insertSql);
	header("Location: agents_ref_view.php");
	exit();
?>