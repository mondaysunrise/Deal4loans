<?php
	require 'scripts/db_init.php';
	//print_r($_GET);
	if(isset($_GET['getCollegesByLetters']) && isset($_GET['letters'])){

	  $letters = $_GET['letters'];
//	    $letters = "A";
	//$letters = "india";
	$letters = preg_replace("/[^a-z0-9 ]/si","",$letters);
	$res = "select company_name from pl_company_list where (company_name like '".$letters."%' and ingvyasya!='') group by  company_name";
	list($alreadyExist,$inf)=MainselectfuncNew($res,$array = array());

for($i=0;$i<$alreadyExist;$i++) {
		echo "###".strtolower($inf[$i]["company_name"])."|";
	}	
}
?>
