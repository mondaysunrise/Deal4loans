<?php
	require 'scripts/db_init.php';
require 'scripts/functionshttps.php';

if(isset($_GET['letters'])){

	$letters = $_GET['letters'];
	//$letters = "india";
	$letters = preg_replace("/[^a-z0-9 ]/si","",$letters);
	$res = "select organisation_name from icici_organisation_list where organisation_name like '".$letters."%'";

	//echo "select  organisation_name from icici_organisation_list  where organisation_name like '".$letters."%'";
	list($numRows,$inf)=MainselectfuncNew($res,$array = array());

	for($i=0;$i<$numRows;$i++)
	{
		echo "###".$inf[$i]["organisation_name"]."|";
	}	
}
?>




	
	
	