<?php
   ////////////////////////////////////////
   function db_connect_bima(){
	$dbuser	= "bima"; 
	$dbserver= "localhost"; 
	$dbpass	= "mataji"; 
	$dbname	= "bimadeal"; 

	$conn = mysql_connect($dbserver, $dbuser, $dbpass) or die ('I cannot connect to the database because: ' . mysql_error());

	if($conn && mysql_select_db($dbname))
	    	return $conn;

	return (FALSE);
   }

   ////////////////////////////////////////
   function ExecQuery_bima($sql){

	/////////////////////////Connect to the db
	db_connect_bima();

	/////////////////////////Return the resultset
	return (mysql_query($sql));
   }

  
?>