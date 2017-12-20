<?php
	require 'scripts/db_init.php';
if(isset($_GET['getCountriesByLetters']) && isset($_GET['letters'])){
	$letters = $_GET['letters'];
	//$letters = "india";
	$letters = preg_replace("/[^a-z0-9 ]/si","",$letters);
	$res = "select Bank_Name from Bank_Master where (Bank_Name like '".$letters."%' and vw_flag=1)";
list($numrows,$inf)=MainselectfuncNew($res,$array = array());
for($i=0;$i<$numrows;$i++){
		echo "###".$inf[$i]["Bank_Name"]."|";
	}	
}
?>
