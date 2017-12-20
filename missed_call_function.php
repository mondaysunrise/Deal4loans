<?php
	require 'scripts/db_init.php';
	
	$client_transaction_id = $_REQUEST['client_transaction_id'];
	$client_transaction_id = 12;
	$zipdial_no = $_REQUEST['zipdial_no'];
	$transaction_token = $_REQUEST['transaction_token'];
	$mobile = $_REQUEST['mobile'];
	$verified = $_REQUEST['verified'];
	$Dated = ExactServerdate();


$dataInsert = array("client_transaction_id"=>$client_transaction_id, "zipdial_no"=>$zipdial_no, "transaction_token"=>$transaction_token, "mobile"=>$mobile, "verified"=>$verified, "created"=>$Dated);
$table = 'z2v_transactions';
$insert = Maininsertfunc ($table, $dataInsert);


?>