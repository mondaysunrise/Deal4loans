<?php
	require 'scripts/session_check_online.php';
	require 'scripts/functions.php';
	require 'scripts/db_init.php';	

	$Name = $_POST['Name'];
	$Phone = $_POST['Phone'];
	$Email = $_POST['Email'];
	$pwd = $_POST['pwd'];
	$BD_ID = $_POST['BD_ID'];
	$insertSql = "update  RM_List set BD_Name = '".$Name."', BD_Manager ='".$Name."' ,BD_Number ='".$Phone."' ,BD_Email='".$Email."' ,BD_pwd='".$pwd."' where BD_ID='".$BD_ID."'";
	
	$insertQuery = ExecQuery($insertSql);
	
	header("Location: rm_view.php");
	exit();
?>