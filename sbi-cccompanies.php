<?php
	require 'scripts/db_init.php';
if(isset($_GET['getCountriesByLetters']) && isset($_GET['letters'])){

	$letters = $_GET['letters'];
	//$letters = "india";
	$letters = preg_replace("/[^a-z0-9 ]/si","",$letters);
	$res = ExecQuery("select sbi_companyname from sbi_cc_company_list where sbi_companyname like '".$letters."%'") or die(mysql_error());
	echo "select sbi_companyname from sbi_cc_company_list where sbi_companyname like '".$letters."%'";
	while($inf = mysql_fetch_array($res)){
		echo "###".$inf["sbi_companyname"]."|";
	}	
}
?>




	
	
	