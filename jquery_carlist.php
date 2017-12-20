<?php
require 'scripts/db_init.php';
if(isset($_REQUEST['car_name'])) {
	$letters = $_REQUEST['car_name'];
	$letters = preg_replace("/[^a-z0-9 ]/si","",$letters);
	$res = "select  hdfc_car_name from  hdfc_car_list_category where  hdfc_car_name like '".$letters."%' LIMIT 0,15"; list($alreadyExist,$inf)=MainselectfuncNew($res,$array = array());

for($i=0;$i<$alreadyExist;$i++) {
		$arrResults[]= $inf[$i]["hdfc_car_name"];
	}	
}
// Do your DB calls here to fill an array of results
//$arrResults = array('option', 'option2', 'option3');
// Print them out, one per line
echo implode(",",$arrResults); 
?>	