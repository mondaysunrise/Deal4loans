<?php
   ////////////////////////////////////////
   function db_dealin_connect(){
	$dbuser	= "deal4lin_drupal"; 
	$dbserver= "deal4loans.in:3306"; 
	$dbpass	= "drupal"; 
	$dbname	= "deal4lin_drupalin"; 

	$conn = mysql_connect($dbserver, $dbuser, $dbpass) or die ('I cannot connect to the database because: ' . mysql_error());

	if($conn && mysql_select_db($dbname))
	    	return $conn;

	return (FALSE);
   }


    function ExecQuery_dealin($sql){

	/////////////////////////Connect to the db
	db_dealin_connect();

	/////////////////////////Return the resultset
	return (mysql_query($sql));
   }

?>