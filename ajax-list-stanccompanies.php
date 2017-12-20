<?php
	require 'scripts/db_init.php';
if(isset($_GET['getCountriesByLetters']) && isset($_GET['letters'])){

	$letters = $_GET['letters'];
	//$letters = "india";
	$letters = preg_replace("/[^a-z0-9 ]/si","",$letters);
	$res = "select company_name from pl_company_stanc where company_name like '".$letters."%'";
	list($numrows,$inf)=MainselectfuncNew($res,$array = array());
for($i=0;$i<$numrows;$i++){
		echo "###".$inf[$i]["company_name"]."|";
	}	
}
?>

	
	
	