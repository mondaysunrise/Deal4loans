<?php
function db_connect_wf(){
	$dbuser	= "d4lwishfinprod"; 
	//$dbserver= "localhost"; 
	$dbserver= "172.16.245.49";
	$dbpass	= "VQZ6JhRZnSvA1f4K";
	$dbname	= "wishfinprod"; 
	$conn = mysql_connect($dbserver, $dbuser, $dbpass) or die ('I cannot connect to the database because: ' . mysql_error());
	if($conn && mysql_select_db($dbname))
		return $conn;

	return (FALSE);
}

function ExecQuery_wf($sql){

	//Connect to the db
	$sqlcheckip=strtolower($sql);
	if((strlen(strpos($sqlcheckip, "insert")) > 0)) 
	{
		restrictIPinst($sql);
	}
	db_connect_wf();

	//Return the resultset
	return (mysql_query($sql));
}

function db_connect_PDO_wf(){
	$dbuser	= "d4lwishfinprod"; 
	//$dbserver= "localhost"; 
	$dbserver= "172.16.245.49";
	$dbpass	= "VQZ6JhRZnSvA1f4K";
	$dbname	= "wishfinprod"; 
	try {
		$pdo = new PDO('mysql:host='.$dbserver.';dbname=wishfinprod', $dbuser, $dbpass);
		$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		return ($pdo);
	} catch (PDOException $pe) {
		die("Could not connect to the database $dbname :" . $pe->getMessage());
	}
}

function Maininsertfunc_wf ($table, $data){
	$pdo = db_connect_PDO_wf();
	foreach ($data as $column => $value) 
	{
		$cols[] = "$column";
		$colsval[] = ":".$column."";
		$values[] = '"'.$value.'"';
		if ($value != NULL) 
		{
			$updateCols[] = "`$column`".' = "'.$value.'"';
		}
	}		
	$colsvalst= implode(",",$colsval);
	$colsar=implode(",",$cols);
	$coloums=implode(",",$updateCols);
	$sql = "INSERT INTO {$table} (".$colsar.") VALUES (".$colsvalst.")";
	$stmt = $pdo->prepare($sql);
	$stmt->execute($data);
	$leadid = $pdo->lastInsertId();
	return($leadid);	   
}

function MaininsertMFfunc_wf ($table, $data){
	$pdo = db_connect_PDO_wf();
	foreach ($data as $column => $valuet) 
	{
		$cols[] = "$column";
		$colsval[] = ":".$column."";
		$values[] = '"'.$value.'"';
		if ($value != NULL) 
		{
			$updateCols[] = "`$column`".' = "'.$value.'"';
		}
	}		
	$colsvalst= implode(",",$colsval);
			print_r($colsvalst);
	$colsar=implode(",",$cols);
	$coloums=implode(",",$updateCols);
	echo $sql = "INSERT INTO {$table} (".$colsar.") VALUES (".$colsvalst.")";
	$stmt = $pdo->prepare($sql);
	$stmt->execute($data);
	$leadid = $pdo->lastInsertId();
	return($leadid);	   
}
        
//Select Function
function Mainselectfunc_wf($sql,$array = array()){
	$pdo = db_connect_PDO_wf();
	$stmt = $pdo->prepare($sql);
	foreach($array as $key => $value){
		if(is_int($value)){
		   $stmt->bindValue("$key", $value, PDO::PARAM_INT);
		} else {
		   $stmt->bindValue("$key", $value);
		}
	}
	$stmt->execute();
	$rowcount=$stmt->rowCount();
	$rowVal= $stmt->fetch(PDO::FETCH_ASSOC);			
	$selectarr = array($rowcount,$rowVal);
	return($selectarr);
}

//Select Function
function MainselectfuncNew_wf($sql,$array = array()){
	$pdo = db_connect_PDO_wf();
	$stmt = $pdo->prepare($sql);
	foreach($array as $key => $value){
		if(is_int($value)){
		   $stmt->bindValue("$key", $value, PDO::PARAM_INT);
		} else {
		   $stmt->bindValue("$key", $value);
		}
	}
	$stmt->execute();
	$rowcount=$stmt->rowCount();
	$rowVal= $stmt->fetchAll(PDO::FETCH_ASSOC);			
	$selectarr = array($rowcount,$rowVal);
	return($selectarr);
}

function Mainupdatefunc_wf ($table, $data, $wherecondition){
	$pdo = db_connect_PDO_wf();
	$setPart = array();
	$bindings = array();

	foreach ($data as $key => $value)
	{
		$setPart[] = "{$key} = :{$key}";
		$bindings[":{$key}"] = $value;
	}
	$sql = "UPDATE {$table} SET ".implode(', ', $setPart)." WHERE ".$wherecondition;
	$stmt = $pdo->prepare($sql);
	$stmt->execute($bindings);
	$rowcount=$stmt->rowCount();

	return($rowcount);
}

function Maindeletefunc_wf($sql,$array = array()){
	$pdo = db_connect_PDO_wf();
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	$rowcount=$stmt->rowCount();

	return($rowcount);
}


function db_connect_mysqli_wf(){
	$dbuser	= "d4lwishfinprod"; 
	$dbserver= "172.16.245.49";
	$dbpass	= "VQZ6JhRZnSvA1f4K";
	$dbname	= "wishfinprod"; 
	$conn = mysqli_connect($dbserver, $dbuser, $dbpass, $dbname) or die ('I cannot connect to the database for reason: ' . mysqli_error());
	if($conn)
		return $conn;

	return (FALSE);
}

function wf_ExecQuery($sql){
	//Connect to the db
	global $conn;
	$conn = db_connect_mysqli_wf();

	//Return the resultset
	return @mysqli_query($conn, $sql);
}

function wf_mysql_insert_id(){
	global $conn;
	return @mysqli_insert_id($conn);
}

function wf_mysql_num_rows($result){
	return @mysqli_num_rows($result);
}

function wf_mysqli_affected_rows(){
	global $conn;
	return @mysqli_affected_rows($conn);
}


function wf_mysql_fetch_array($result){
	return @mysqli_fetch_array($result);
}

function wf_mysql_fetch_row($result){
	return @mysqli_fetch_row($result);
}

function wf_mysql_fetch_object($result){
	return @mysqli_fetch_object($result);
}

function wf_mysql_fetch_assoc($result){
	return @mysqli_fetch_assoc($result);
}

function wf_mysql_result($result, $rows, $field)
{
	return wf_mysqli_result($result,$rows,$field);	
}

function wf_mysqli_result($res,$row=0,$col=0)
{ 
    $numrows = mysqli_num_rows($res); 
    if ($numrows && $row <= ($numrows-1) && $row >=0)
    {
        mysqli_data_seek($res,$row);
        $resrow = (is_numeric($col)) ? mysqli_fetch_row($res) : mysqli_fetch_assoc($res);
        if (isset($resrow[$col]))
        {
            return $resrow[$col];
        }
    }
    return false;
}


?>
