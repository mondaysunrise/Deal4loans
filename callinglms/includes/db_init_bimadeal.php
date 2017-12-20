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

/*
   ////////////////////////////////////////
   function ExecQuery_bima($sql){

	/////////////////////////Connect to the db
	db_connect_bima();

	/////////////////////////Return the resultset
	return (mysql_query($sql));
   }
*/

  ////////////////////////////////////////
   function FixString($strtofix){
	/** ESCAPES SPECIAL CHARACTERS FOR INSERTING INTO SQL **/
	if (get_magic_quotes_gpc()) { $addslash="no"; } else { $addslash="yes"; }

	if ($addslash == "yes") {  $strtofix = addslashes($strtofix); }
	$strtofix = @preg_replace(  "<", "&#60;", $strtofix );
	$strtofix = @preg_replace(  "'", "&#39;", $strtofix );
	$strtofix = @preg_replace(  "(\n)", "<BR>", $strtofix );
	return $strtofix;
   }


function db_connect_mysqli(){
	$dbuser	= "bimadealssprime"; 
	$dbserver= "172.16.101.195"; 
	$dbpass	= "RDJDsJpM3DcGSFTzbJrs"; 
	$dbname	= "bimadeals_primary";
	$conn = mysqli_connect($dbserver, $dbuser, $dbpass, $dbname) or die ('I cannot connect to the database because: ' . mysqli_error());
	if($conn)
		return $conn;

	return (FALSE);
}

function ExecQuery_bima($sql){
	//Connect to the db
	$sqlcheckip=strtolower($sql);
	global $conn;
	$conn = db_connect_mysqli();

	//Return the resultset
	return @mysqli_query($conn, $sql);
}


function bima_mysql_insert_id(){
	global $conn;
	return @mysqli_insert_id($conn);
}

function bima_mysql_num_rows($result){
	return @mysqli_num_rows($result);
}

function bima_mysqli_affected_rows(){
	global $conn;
	return @mysqli_affected_rows($conn);
}

function bima_mysql_num_rows1($result){
	$rowcount=$result->rowCount();
	return $rowcount;
}

function bima_mysql_fetch_array($result){
	return @mysqli_fetch_array($result);
}

function bima_mysql_fetch_array1($result){
	$responsearr= $result->fetchAll();
	return $responsearr;
}

function bima_mysql_fetch_row($result){
	return @mysqli_fetch_row($result);
}

function bima_mysql_result($result, $rows, $field)
{
	return mysqli_result($result,$rows,$field);	
}

function mysqli_result($res,$row=0,$col=0){ 
    $numrows = mysqli_num_rows($res); 
    if ($numrows && $row <= ($numrows-1) && $row >=0){
        mysqli_data_seek($res,$row);
        $resrow = (is_numeric($col)) ? mysqli_fetch_row($res) : mysqli_fetch_assoc($res);
        if (isset($resrow[$col])){
            return $resrow[$col];
        }
    }
    return false;
}
  
?>