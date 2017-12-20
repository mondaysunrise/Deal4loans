<?php
	require 'scripts/db_init.php';
	//print_r($_GET);
	if(isset($_GET['getCollegesByLetters']) && isset($_GET['letters'])){

	  $letters = $_GET['letters'];
//	    $letters = "A";
	//$letters = "india";
	$letters = preg_replace("/[^a-z0-9 ]/si","",$letters);
	$res = "select company_name from pl_company_list where company_name like '".$letters."%' group by  company_name";
	list($recordcount,$inf)=MainselectfuncNew($res,$array = array());
	//echo "select bank_name from creditndebit_card_offer where bank_name like '".$letters."%'";
	for($k=0;$k<$recordcount1;$k++)	
	{
		echo "###".strtolower($inf[$k]["company_name"])."|";
	}	
}
?>
