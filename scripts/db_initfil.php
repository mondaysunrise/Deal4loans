<?php
   function db_connectfil(){
	$dbuser	= "fullerto_loans"; 
	$dbserver= "182.18.168.111:3306"; 
	$dbpass	= "loans&20"; 
	$dbname	= "admin_fullerto"; 
	
	$conn = mysql_connect($dbserver, $dbuser, $dbpass) or die ('I cannot connect to the database because: ' . mysql_error());
	if($conn && mysql_select_db($dbname))
	    	return $conn;
	return (FALSE);
   }

   function ExecQueryfil($sql){
	db_connectfil();
	return (mysql_query($sql));
   }
?>