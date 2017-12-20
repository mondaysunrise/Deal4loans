<?php

function db_connect(){
	$dbuser	= "root"; 
	//$dbserver= "localhost"; 
	$dbserver= "localhost";
	$dbpass	= "";
	$dbname	= "deal4loans_primary"; 
	$conn = mysql_connect($dbserver, $dbuser, $dbpass) or die ('I cannot connect to the database because: ' . mysql_error());
	if($conn && mysql_select_db($dbname))
		return $conn;

	return (FALSE);
}

function ExecQuery($sql){

	//Connect to the db
	$sqlcheckip=strtolower($sql);
	if((strlen(strpos($sqlcheckip, "insert")) > 0)) 
	{
		restrictIPinst($sql);
	}
	db_connect();

	//Return the resultset
	return (mysql_query($sql));
}

function db_connect_PDO(){
	$dbuser	= "root"; 
	//$dbserver= "localhost"; 
	$dbserver= "localhost";
	$dbpass	= "";
	$dbname	= "deal4loans_primary"; 
	try {
		$pdo = new PDO('mysql:host='.$dbserver.';dbname=deal4loans_primary', $dbuser, $dbpass);
		$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		return ($pdo);
	} catch (PDOException $pe) {
		die("Could not connect to the database $dbname :" . $pe->getMessage());
	}
}

function Maininsertfunc ($table, $data){
	$pdo = db_connect_PDO();
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

function MaininsertMFfunc ($table, $data){
	$pdo = db_connect_PDO();
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
function Mainselectfunc($sql,$array = array()){
	$pdo = db_connect_PDO();
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
function MainselectfuncNew($sql,$array = array()){
	$pdo = db_connect_PDO();
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

function Mainupdatefunc ($table, $data, $wherecondition){
	$pdo = db_connect_PDO();
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

function Maindeletefunc($sql,$array = array()){
	$pdo = db_connect_PDO();
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	$rowcount=$stmt->rowCount();

	return($rowcount);
}


function db_connect_mysqli(){
	$dbuser	= "root"; 
	$dbserver= "localhost";
	$dbpass	= "";
	$dbname	= "deal4loans_primary"; 
	$conn = mysqli_connect($dbserver, $dbuser, $dbpass, $dbname) or die ('I cannot connect to the database because: ' . mysqli_error());
	if($conn)
		return $conn;

	return (FALSE);
}

function d4l_ExecQuery($sql){
	//Connect to the db
	global $conn;
	$conn = db_connect_mysqli();

	//Return the resultset
	return @mysqli_query($conn, $sql);
}


function d4l_ExecQuery1($sql){
	$pdo = db_connect_PDO();
	$result = $pdo->query($sql);
	return $result;
}

function d4l_mysql_insert_id(){
	global $conn;
	return @mysqli_insert_id($conn);
}

function d4l_mysql_num_rows($result){
	return @mysqli_num_rows($result);
}

function d4l_mysqli_affected_rows(){
	global $conn;
	return @mysqli_affected_rows($conn);
}

function d4l_mysql_num_rows1($result){
	$rowcount=$result->rowCount();
	return $rowcount;
}

function d4l_mysql_fetch_array($result){
	return @mysqli_fetch_array($result);
}

function d4l_mysql_fetch_array1($result){
	$responsearr= $result->fetchAll();
	return $responsearr;
}

function d4l_mysql_fetch_row($result){
	return @mysqli_fetch_row($result);
}

function d4l_mysql_fetch_row1($result){
	$responsearr= $result->fetchAll(PDO::FETCH_ROW);
	return $responsearr;
}

function d4l_mysql_fetch_object($result){
	return @mysqli_fetch_object($result);
}

function d4l_mysql_fetch_assoc($result){
	return @mysqli_fetch_assoc($result);
}

function d4l_mysql_result($result, $rows, $field)
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


function ExactServerdate()
{
	$DateTime=date("Y-m-d H:i:s");
	return($DateTime);
}

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


function restrictIPinst($sql)
{
	$connip = mysql_connect('localhost', 'root', '');
	$connipA = mysql_select_db('deal4loans_primary');

	$IP = getenv("REMOTE_ADDR");
	$REQUESTURI = $_SERVER['REQUEST_URI'];
	$datetimeIP = date('Y-m-d');
	$mindatetimeIP = date('Y-m-d')." 00:00:00";
	$maxdatetimeIP = date('Y-m-d')." 23:59:59";
	if((strlen(strpos($REQUESTURI, "Sms_delivery_notification")) > 0) || (strlen(strpos($REQUESTURI, "cron")) > 0) || (strlen(strpos($REQUESTURI, "download")) > 0) || (strlen(strpos($REQUESTURI, "editlead")) > 0) || (strlen(strpos($REQUESTURI, "login")) > 0) || (strlen(strpos($REQUESTURI, "upload")) > 0)) 
	{ }
	else {
		if($IP=="182.18.168.111" || $IP=="122.176.100.27" || $IP=="122.176.100.28" || $IP=="122.176.122.134" || $IP=="182.50.130.113")
		{}
		else {
			if(strlen($IP)>0)
			{
				$sqlResIP = mysql_query("INSERT INTO `restrictIPAddr` (`IP_Address`, `Dated`, `Status`, `Page_Name`,`Query`) VALUES ('".$IP."', Now(), '1', '".$REQUESTURI."', '')"); 
				restrictIP($IP);
			}	
		}
	}
}
	
function restrictIP($IP)
{
	$datetimeIP = date('Y-m-d');
	$mindatetimeIP = date('Y-m-d')." 00:00:00";
	$maxdatetimeIP = date('Y-m-d')." 23:59:59";
			
	$sqlRest = "select id from restrictIPAddr where IP_Address='".$IP."' and Status=1 and (Dated between '".$mindatetimeIP."' and '".$maxdatetimeIP."')";
	$queryRest = ExecQuery($sqlRest);
	$numRestIP = mysql_num_rows($queryRest);
	if($numRestIP>20)
	{
		$Phone = 9811215138;
		$SMScampMessage = "IP- ".$IP." is creating problem on ".$datetimeIP."";
		//SendSMSforIP($SMScampMessage, $Phone);
		$Message2="<table width='560' border='0' align='center' cellpadding='0' cellspacing='0'>
					<tr>
					<td width='560' height='101' align='center' valign='top'><img src='http://www.deal4loans.com/images/mlr-hdr.jpg' width='560' height='101' /></td>
					</tr> <tr>
					<td width='560' height='101' align='center' valign='top'>IP-".$IP." is creating problem on ".$datetimeIP."</td>
					</tr>
					</table>";

		$SubjectLine = "Product Analysis";
		$headers = "From: deal4loans <no-reply@deal4loans.com>";
		$semi_rand = md5( time() ); 
		$mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 
		$headers .= "\nMIME-Version: 1.0\n" . 
			"Content-Type: multipart/mixed;\n" . 
			" boundary=\"{$mime_boundary}\""."\n";
		$message = "This is a multi-part message in MIME format.\n\n" . 
			"--{$mime_boundary}\n" . 
			"Content-Type: text/html; charset=\"iso-8859-1\"\n" . 
			"Content-Transfer-Encoding: 7bit\n\n" . 
			$Message2 . "\n\n";
		$Email = "tech@deal4loans.com,ranjana5chauhan@gmail.com";
		//mail($Email, $SubjectLine, $message, $headers);
	}
}
	
function SendSMSforIP($SMSMessage, $PhoneNumber)
{
	$request = ""; //initialize the request variable
	
	// 6161
	$param["pcode"] = "MICROFINANCIAL"; 
	$param["acode"] = "MICROFINANCIAL"; 
	$param["message"] = $SMSMessage; //this is the message that we want to send
	$param["mnumber"] = "91".$PhoneNumber; //these are the recipients of the message
	$param["pin"] = "mi@1";
	

	foreach($param as $key=>$val) //traverse through each member of the param array
	{ 
	  $request.= $key."=".urlencode($val); //we have to urlencode the values
	  $request.= "&"; //append the ampersand (&) sign after each paramter/value pair
	}
	$request = substr($request, 0, strlen($request)-1); //remove the final ampersand sign from the request

	//First prepare the info that relates to the connection
	$host = "luna.a2wi.co.in:7501";
	$script = "/failsafe/HttpPublishLink";
	$request_length = strlen($request);
	$method = "POST"; // must be POST if sending multiple messages
	if ($method == "GET") 
	{
	  $script .= "?$request";
	}

	//Now comes the header which we are going to post. 
	$header = "$method $script HTTP/1.1\r\n";
	$header .= "Host: $host\r\n";
	$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
	$header .= "Content-Length: $request_length\r\n";
	$header .= "Connection: close\r\n\r\n";
	$header .= "$request\r\n";

	//Now we open up the connection
	$socket = @fsockopen($host, 80, $errno, $errstr); 
	if ($socket) //if its open, then...
	{ 
	  fputs($socket, $header); // send the details over
	  while(!feof($socket))
	  {
		$output[] = fgets($socket); //get the results 
	  }
	  fclose($socket); 
	  	$Promocode = $param["pcode"];
		$selectSql = "select * from track_sms where pcode = '".$Promocode."'";
		$selectQuery = ExecQuery($selectSql);
		$smsCount = mysql_result($selectQuery,0,'smscount');
		if($smsCount==0)
		{
			$incrementSms = 1;
		}
		else
		{
			$incrementSms = $smsCount - 1;
		}
		$updateSql = "update track_sms set smscount = '".$incrementSms."', date = now() where pcode = '".$Promocode."'";
		$updateQuery = ExecQuery($updateSql);

	} 
}
	//restrictIP();
?>
