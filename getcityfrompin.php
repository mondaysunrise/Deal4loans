<?php
require 'scripts/db_init.php';
require 'scripts/functions.php';
$pin_code = $_REQUEST['pin_code'];
if(strlen($pin_code)==6)
{
	$getPinSql = "SELECT * FROM sbi_cc_city_state_list WHERE pincode = '".$pin_code."'";
	list($numRowsCarName,$getCarNameQuery)=MainselectfuncNew($getPinSql,$array = array());
	for($cN=0;$cN<$numRowsCarName;$cN++)
	{
		$City = $getCarNameQuery[$cN]['city'];
	}
	echo $City;exit;
}
?>
