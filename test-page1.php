<?php
//ob_start();
//require 'scripts/session_check_online.php';
session_start();
require 'wishfin_whatsapp_api.php';
echo $whatsapp_message="Check"."--".$mobile;

	$mobile = 9971396361;
	//die();
	$returnValue = json_decode(whatsappCustomSendMessage($mobile,'Req_Loan_Home','1871854',$whatsapp_message,'deal4loan_homeloan7342_message'));
	$_SESSION['whatsapp_returnValue']=$returnValue->status;
	print_r($returnValue);
	
?>