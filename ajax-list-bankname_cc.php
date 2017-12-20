<?php
	require 'scripts/db_init.php';
if(isset($_GET['getCountriesByLetters']) && isset($_GET['letters'])){

	$letters = $_GET['letters'];
	//$letters = "india";
	$letters = preg_replace("/[^a-z0-9 ]/si","",$letters);
	$res = ("select bank_name from creditndebit_card_offer where ccndc_approval =1 and bank_name like '".$letters."%' group by bank_name");
	
	 list($recordcount,$inf)=MainselectfuncNew($res,$array = array());
		$cntr=0;
	//echo "select bank_name from creditndebit_card_offer where bank_name like '".$letters."%'";
	while($cntr<count($inf))
        {
		echo "###".$inf[$cntr]["bank_name"]."|";
		
		$cntr=$cntr+1;
	}	
}
?>
