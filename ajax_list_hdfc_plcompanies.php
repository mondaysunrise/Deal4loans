<?php
	require 'scripts/db_init.php';
if(isset($_GET['getCountriesByLetters']) && isset($_GET['letters'])){

	$letters = $_GET['letters'];
	//$letters = "india";
	$letters = preg_replace("/[^a-z0-9 ]/si","",$letters);
	$res = ("select hdfc_company_name from hdfc_pl_company_list where hdfc_company_name like '".$letters."%'") or die(mysql_error());
	
	 list($recordcount,$inf)=MainselectfuncNew($res,$array = array());
		$cntr=0;
	
	echo "select  hdfc_company_name from hdfc_pl_company_list  where hdfc_company_name like '".$letters."%'";
	while($cntr<count($inf))
        {
		echo "###".$inf[$cntr]["hdfc_company_name"]."|";
		 $cntr=$cntr+1;
	}	
}
?>




	
	
	