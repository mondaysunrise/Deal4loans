<?php
   ////////////////////////////////////////
   function db_connect_in(){
	
	$dbuser_ivr	= "bimanetd_d4l"; 
	//$dbserver_ivr= "174.37.176.188:3306"; 
	$dbserver_ivr= "bimadeals.net:3306"; 
	$dbpass_ivr	= "d4l&20"; 
	$dbname_ivr	= "bimanetd_d4l";
	/*
	db name : bimanetd_d4l
	db user : bimanetd_d4l
	db pwd : d4l&20	 
	$dbuser_ivr	= "valuemnt_ivr"; 
	$dbserver_ivr= "value-max.net:3306"; 
	$dbpass_ivr	= "dataivr"; 
	$dbname_ivr	= "valuemnt_ivr";
	
	*/

	$conn_in = mysql_connect($dbserver_ivr, $dbuser_ivr, $dbpass_ivr) or die ('I cannot connect to the database because: ' . mysql_error());

	if($conn_in && mysql_select_db($dbname_ivr, $conn_in))
	    	return $conn_in;

	return (FALSE);
   }

   ////////////////////////////////////////
   function ExecQuery_in($sql){

	/////////////////////////Connect to the db
	db_connect_in();

	/////////////////////////Return the resultset
	return (mysql_query($sql));
   }

   ////////////////////////////////////////
 /*   function ThrowError($mysql_error)
    {
	global $Msg;
	$Msg = $mysql_error; 
    }
*/
   ////////////////////////////////////////
  /* function ThrowErrors($err_type,$err_descr)
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
*/ 
?>