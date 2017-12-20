<?php
	require 'scripts/db_init.php';
if(isset($_GET['getCarNameByLetters']) && isset($_GET['letters'])){

	$letters = $_GET['letters'];
	//$letters = "india";
	$letters = preg_replace("/[^a-z0-9 ]/si","",$letters);
	$res = "select  hdfc_car_name from  hdfc_car_list_category where  hdfc_car_name like '".$letters."%'";
	list($numrows,$inf)=MainselectfuncNew($res,$array = array());
for($i=0;$i<$numrows;$i++){
		echo "###".$inf[$i]["hdfc_car_name"]."|";
	}	
}
?>




	
	
	