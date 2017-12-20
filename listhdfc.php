<?php
	require 'scripts/db_init.php';
	//print_r($_GET);
	if(isset($_GET['getCollegesByLetters']) && isset($_GET['letters'])){

	  $letters = $_GET['letters'];
//	    $letters = "A";
	//$letters = "india";
	$letters = preg_replace("/[^a-z0-9 ]/si","",$letters);
	$res = ("select COMPANY_NAME from hdfc_company_list_gold where  COMPANY_NAME like '".$letters."%' group by  COMPANY_NAME") or die(mysql_error());
	//echo "select bank_name from creditndebit_card_offer where bank_name like '".$letters."%'";
	 list($recordcount,$inf)=MainselectfuncNew($res,$array = array());
		$cntr=0;

	
	while($cntr<count($inf))
        {
		echo "###".$inf[$cntr]["COMPANY_NAME"]."|";
		
		 $cntr=$cntr+1;
	}	
}
?>
