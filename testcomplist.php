<?php
	$connip = mysql_connect('localhost', 'root', '');
	$connip = mysql_select_db('deal4loans_primary');

	//print_r($_GET);

if(isset($_GET['getCountriesByLetters']) && isset($_GET['letters'])){
	//echo "i m here";
	$letters = $_GET['letters'];
	//$letters = "india";
	$letters = preg_replace("/[^a-z0-9 ]/si","",$letters);
	$res = mysql_query("select company_name from cl_company_list_hdfc where company_name like '".$letters."%'") or die(mysql_error());
	//cho "select bank_name from personal_loan_interest_rate_chart where bank_name like '".$letters."%'";
	while($inf = mysql_fetch_array($res)){
		echo "###".$inf["company_name"]."|";
	}	
}
?>
