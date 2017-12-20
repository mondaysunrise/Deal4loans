<?php
   ////////////////////////////////////////
   function db_connect_bima(){
	$dbuser	= "bimadealssprime"; 
	$dbserver= "172.16.101.195"; 
	$dbpass	= "RDJDsJpM3DcGSFTzbJrs"; 
	$dbname	= "bimadeals_primary"; 

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