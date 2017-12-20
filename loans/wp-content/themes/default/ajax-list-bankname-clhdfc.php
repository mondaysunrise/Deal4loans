<?php
	require 'scripts/db_init.php';
if(isset($_GET['getCountriesByLetters']) && isset($_GET['letters'])){
	$letters = $_GET['letters'];
	//$letters = "india";
	$letters = preg_replace("/[^a-z0-9 ]/si","",$letters);
	$res = ExecQuery("select company_name from cl_company_list_hdfc where company_name like '".$letters."%'") or die(mysql_error());
	//cho "select bank_name from personal_loan_interest_rate_chart where bank_name like '".$letters."%'";
	while($inf = mysql_fetch_array($res)){
		echo "###".$inf["company_name"]."|";
	}	
}
?>
