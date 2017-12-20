<?php
	require 'scripts/session_check_online.php';
	require 'scripts/functions.php';
	require 'scripts/db_init.php';	

function randomPassword() {
    $alphabet = "abcdefgrstuwxyz123456789";
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
	$password = implode($pass);
	return $password;
}
	$Name = $_POST['Name'];
	$Phone = $_POST['Phone'];
	$Email = $_POST['Email'];
	$pwd = randomPassword();
	$insertSql = "INSERT INTO  `RM_List` (`BD_Name` ,`BD_Manager` ,`BD_Number` ,`BD_Email` ,`BD_pwd` ,`dated` ,`Status`)VALUES ('".$Name."',  '".$Name."',  '".$Phone."',  '".$Email."',  '".$pwd."',  Now(),  '1')";
	
	$insertQuery = ExecQuery($insertSql);
	
	header("Location: rm_view.php");
	exit();
?>