<?php
error_reporting(E_ALL);
ini_set('display_errors',1);


$sequenceid=d4l_ExecQuery("Select total_lead_count From lead_allocation_table WHERE lead_allocation_logic = 129");
$seqid = d4l_mysql_fetch_array($sequenceid);
$lastsbiccid = $seqid["total_lead_count"];


$query = "SELECT sbiccid, RequestID FROM `sbi_credit_card_5633` WHERE productflag = 0 ANd DATE(date_modified) >= '2017-01-01' AND request_xml != '' AND sbiccid < '".$lastsbiccid."' ORDER BY sbiccid DESC LIMIT 0,1000";
$result = d4l_ExecQuery($query);
$idArray= array();
while($row=d4l_mysql_fetch_assoc($result)){
	$sbiccid = $row["sbiccid"];
	$RequestID = $row["RequestID"];
	
	$checkIDInSMSQry = "SELECT UserID FROM Req_Credit_Card_Sms WHERE UserID = '".$RequestID."'";
	$checkIDInSMSResult = d4l_ExecQuery($checkIDInSMSQry);
	$SMSRows = d4l_mysql_num_rows($checkIDInSMSResult);
	echo $sbiccid.'--'.$RequestID.'--'.$SMSRows.'\n';
	if($SMSRows){
		$idArray[] = $sbiccid;
	}
}
//echo '<pre>';print_r($idArray);
//save last updated sbiccid
echo $updatelastsbiccid = d4l_ExecQuery("Update lead_allocation_table SET total_lead_count = '".$sbiccid."' WHERE lead_allocation_logic = 129");
$sbiccString = implode(',',$idArray);
if(!empty($sbiccString)){
echo $updatequery="Update sbi_credit_card_5633 set productflag='44' Where sbiccid IN (".$sbiccString.")";
echo '\n';
$FinalResult = d4l_ExecQuery($updatequery);
}


function db_connect_mysqli(){
	$dbuser	= "root"; 
	$dbserver= "p:localhost";
	$dbpass	= "";
	$dbname	= "deal4loans_primary"; 
	$conn = mysqli_connect($dbserver, $dbuser, $dbpass, $dbname) or die ('I cannot connect to the database for reason: ' . mysqli_error());
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

function d4l_mysql_num_rows($result){
	return @mysqli_num_rows($result);
}

function d4l_mysql_fetch_array($result){
	return @mysqli_fetch_array($result);
}

function d4l_mysql_fetch_assoc($result){
	return @mysqli_fetch_assoc($result);
}

?>
