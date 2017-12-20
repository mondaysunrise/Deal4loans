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
//print_r($_POST);

	$Name = $_POST['Name'];
	$Phone = $_POST['Phone'];
	$Email = $_POST['Email'];
	$City = $_POST['City'];
	$City_Other = $_POST['City_Other'];
	$product = "Personal Loan";
	
	$pwd = randomPassword();
	$insertSql = "INSERT INTO  `Req_Partner` (`Partner_Username` ,`Partner_Password` ,`Partner_Name` ,`Partner_Email` ,`Partner_City` ,`Partner_City_Other` ,`Partner_Mobile` ,`Partner_Product` ,`Partner_Company` ,`Partner_Date` ,`Partner_Manager_ID` ,`Partner_Manager` ,`Status`, Is_Verified) VALUES ('".$Email."',  '".$pwd."',  '".$Name."',  '".$Email."',  '".$City."',  '".$City_Other."',  '".$Phone."',  '".$product."',  '',  Now(),  '".$_SESSION['BidderID']."',  '".$_SESSION['UName']."',  '1', '1')";
	$insertQuery = ExecQuery($insertSql);
	header("Location: agents_ref_view.php");
	exit();
?>