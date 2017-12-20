<?php
require 'scripts/db_init.php';
require 'scripts/functions.php';


if(isset($_GET['bank_name']) && isset($_GET['letters'])){
	$letters = $_GET['letters'];
	$letters = preg_replace("/[^a-z0-9 ]/si","",$letters);
	$res = ExecQuery("select rateid,bank_name from personal_loan_interest_rate_chart where bank_name like '".$letters."%'") );
	
	while($inf = mysql_fetch_array($res)){
		echo $inf["rateid"]."###".$inf["bank_name"]."|";
	}	
}
?>