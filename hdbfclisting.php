<?php
	require 'scripts/db_init.php';
	//print_r($_GET);
	if(isset($_GET['getCollegesByLetters']) && isset($_GET['letters'])){

	  $letters = $_GET['letters'];
//	    $letters = "A";
	//$letters = "india";
	$letters = preg_replace("/[^a-z0-9 ]/si","",$letters);
	$res = ("select company_name from hdbfc_companylist where company_name like '".$letters."%' group by  company_name") or die(mysql_error());
	 list($recordcount,$inf)=MainselectfuncNew($res,$array = array());
		$cntr=0;
	
	//echo "select bank_name from creditndebit_card_offer where bank_name like '".$letters."%'";
	while($cntr<count($inf))
        {
		echo "###".strtolower($inf[$cntr]["company_name"])."|";
		$cntr = $cntr +1;
	
	}	
}
?>
