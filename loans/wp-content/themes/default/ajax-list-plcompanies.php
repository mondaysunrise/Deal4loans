<?php
echo "hello";
	require 'http://www.deal4loans.com/scripts/db_init.php';
	echo "hello1";
if(isset($_GET['getCountriesByLetters']) && isset($_GET['letters'])){
	echo "hello547";

	$letters = $_GET['letters'];
	//$letters = "india";
	$letters = preg_replace("/[^a-z0-9 ]/si","",$letters);
	$res = ExecQuery("select company_name from pl_company_list where company_name like '".$letters."%'") or die(mysql_error());
	echo "select  company_name from pl_company_list  where company_name like '".$letters."%'";
	while($inf = mysql_fetch_array($res)){
		echo "###".$inf["company_name"]."|";
	}	
}
?>




	
	
	