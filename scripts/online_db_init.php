<?php
   ////////////////////////////////////////
   function db_connect(){
	$dbuser	= "rmwireless"; 
	$dbserver= "205.178.146.18"; 
	$dbpass	= "mataji"; 
	$dbname	= "deal4loans"; 

	$conn = mysql_connect($dbserver, $dbuser, $dbpass) or die ('I cannot connect to the database because: ' . mysql_error());

	if($conn && mysql_select_db($dbname))
	    	return $conn;

	return (FALSE);
   }

   ////////////////////////////////////////
   function ExecQuery($sql){

	/////////////////////////Connect to the db
	db_connect();

	/////////////////////////Return the resultset
	return (mysql_query($sql));
   }

   ////////////////////////////////////////
    function ThrowError($mysql_error)
    {
	global $Msg;
	$Msg = $mysql_error; 
    }

   ////////////////////////////////////////
   function ThrowErrors($err_type,$err_descr)
   {
	$err_text = "";
	switch ($err_type)
	{
		case "9991SQLresultcount":
			return "<BR><B>ERROR:  --> " . mysql_error() ."</b>
					<BR>LOCATION: $err_type 
					<BR>DESCRIPTION: Unable to execute SQL statement.
					<BR>Please Check the Following:
					<BR>- Ensure the Table(s) Exists in database $dbname
					<BR>- Ensure All Fields Exist in the Table(s)
					
					<BR>- SQL STATEMENT: $err_descr<BR>
					<BR>- MYSQL ERROR: " . mysql_error();
			break;
		case "9994SQL":
			return "<BR><B>ERROR:  --> " . mysql_error() ."</b>
					<BR>LOCATION: $err_type 
					<BR>DESCRIPTION: Unable to execute SQL statement.
					<BR>Please Check the Following:
					<BR>- Ensure the Table(s) Exists in database $dbname
					<BR>- Ensure All Fields Exist in the Table(s)
					
					<BR>- SQL STATEMENT: $err_descr<BR>
					<BR>- MYSQL ERROR: " . mysql_error();
			break;
		default:
			return "UNKNOWN ERROR TYPE: $err_type 
					<BR>DESCR: $err_descr<BR>";
			break;
	} //end switch

	return $err_text;
	} 
?>