<?php
//ob_start();
//require 'scripts/session_check_online.php';
session_start();
require 'scripts/db_init.php';
require 'scripts/functions.php';
require 'wishfin_whatsapp_api.php';

$_SESSION['whatsapp_returnValue']='';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	foreach($_POST as $a=>$b)
		$$a=$b;
	$callerid = FixString($_POST["callerid"]);
	$requestid= FixString($_POST["requestid"]);
	$whatsapp_process_name = FixString($_POST["whatsapp_process_name"]);
	
	$whatsapp_message= FixString($_POST["whatsapp_message"]);
	$table_name="Req_Loan_Home";
	$sql = "select Mobile_Number from Req_Loan_Home where RequestID='".$requestid."'";

	$query = d4l_ExecQuery($sql);
	$mobile=d4l_mysql_result($query,0,'Mobile_Number');
	//echo $whatsapp_message=$whatsapp_message."--".$mobile;
	//$mobile = 9971396361;
	//die();
	$returnValue = json_decode(whatsappCustomSendMessage($mobile,$table_name,$requestid,$whatsapp_message,$whatsapp_process_name));
	$_SESSION['whatsapp_returnValue']=$returnValue->status;
	//print_r($returnValue);
	//die();
	//postid=1888434&biddt=7248id=1904129&Bid=7130
	header("Location: hllmsallocate_editlead.php?id=".$requestid."&Bid=".$callerid);
	exit();

}
?>