<?php
require 'scripts/db_init.php';

$city = $_REQUEST['city'];
if(!empty($city)){
	
	//Get Pincode List
	$getPinSql = "SELECT pincode FROM yes_cc_city_state_list WHERE city = '".$city."' ORDER BY pincode ASC";
	list($numpinrows,$pincodelist) = MainselectfuncNew($getPinSql,$array = array());

	//Get State List
	$getStateSql = "SELECT state FROM yes_cc_city_state_list WHERE city = '".$city."' LIMIT 0,1";
	list($numstaterows,$statelist) = Mainselectfunc($getStateSql,$array = array());

	$responseArr = array('PincodeList'=>$pincodelist, 'State'=>$statelist['state']);
	echo json_encode($responseArr);
	exit;
}
?>

