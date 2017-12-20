<?php
require 'scripts/db_init.php';
if(isset($_REQUEST['Primary_Acc'])) {
	$letters = $_REQUEST['Primary_Acc'];
	$letters = preg_replace("/[^a-z0-9 ]/si","",$letters);
	$res = "select Bank_Name from Bank_Master where (Bank_Name like '".$letters."%' and vw_flag=1) LIMIT 0,15";
list($alreadyExist,$inf)=MainselectfuncNew($res,$array = array());

for($i=0;$i<$alreadyExist;$i++) {
		$arrResults[]= $inf[$i]["Bank_Name"];
	}	
}
// Do your DB calls here to fill an array of results
//$arrResults = array('option', 'option2', 'option3');
// Print them out, one per line
echo implode(",",$arrResults); 
?>	