<?php
			
function db_connect_mysqli_wf(){
	$dbuser	= "d4lwishfinprod"; 
	$dbserver= "172.16.245.49";
	$dbpass	= "VQZ6JhRZnSvA1f4K";
	$dbname	= "wishfinprod"; 
	$conn = mysqli_connect($dbserver, $dbuser, $dbpass, $dbname) or die ('I cannot connect to the database for reason: ' . mysqli_connect_error());
	if($conn)
		return $conn;

	return (FALSE);
}

	$conn = db_connect_mysqli_wf();
  	
?>