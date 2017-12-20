<?php
   function db_connect_fil(){
	$dbuser	= "fullerto_loans"; 
	$dbserver= "205.147.96.165:3306"; //New
	$dbpass	= "fnUt78ZC"; 
	$dbname	= "admin_fullerto"; //New
	
	$conn = mysql_connect($dbserver, $dbuser, $dbpass) or die ('I cannot connect to the database because: ' . mysql_error());
	if($conn && mysql_select_db($dbname))
	    	return $conn;
	return (FALSE);
   }

   function ExecQuery_fil($sql){
	db_connect_fil();
	return (mysql_query($sql));
   }
?>