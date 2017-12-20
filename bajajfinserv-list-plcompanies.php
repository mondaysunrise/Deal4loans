<?php
	require 'scripts/db_init.php';
if(isset($_GET['getCountriesByLetters']) && isset($_GET['letters'])){

	$letters = $_GET['letters'];
	//$letters = "india";
	$letters = preg_replace("/[^a-z0-9 ]/si","",$letters);
	$res = "select company_name from pl_company_list where (bajajfinserv !='' and company_name like '".$letters."%')" or die(mysql_error());
	
	list($Getnum,$inf)=MainselectfuncNew($res,$array = array());
	//echo "select  company_name from pl_company_bajajfinserv  where company_name like '".$letters."%'";
	 $i=0;
	 while($i<count($inf))
		 {
		echo "###".$inf[$i]["company_name"]."|";
	$i=$i+1;
	}	
}
?>




	
	
	