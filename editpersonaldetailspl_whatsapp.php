<?php
ob_start();
//require 'scripts/session_check_online.php';
session_start();
require 'scripts/db_init.php';
require 'scripts/functions.php';

//echo "<pre>";
//print_r($_POST);
$_SESSION['whatsapp_returnValue']='';
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		foreach($_POST as $a=>$b)
			$$a=$b;
		$callerid = FixString($_POST["callerid"]);
		$requestid= FixString($_POST["requestid"]);
		$whatsapp_message= FixString($_POST["whatsapp_message"]);
		$table_name="Req_Loan_Personal";
		$sql = "select Mobile_Number from Req_Loan_Personal where RequestID='".$requestid."'";

		$query = d4l_ExecQuery($sql);
		$mobile=d4l_mysql_result($query,0,'Mobile_Number');
		//echo $whatsapp_message=$whatsapp_message."--".$mobile;
		//$mobile = 9971396361;
		//die();
		$returnValue = json_decode(whatsappCustomSendMessage($mobile,$table_name,$requestid,$whatsapp_message));
		$_SESSION['whatsapp_returnValue']=$returnValue->status;
		//print_r($returnValue);
		//die();
		header("Location: edit-pl-appointments_wapps.php?id=".$requestid."&Bid=".$callerid);
		exit();

}

function oauthRequest()
{
	$curl = curl_init();
	curl_setopt_array($curl, array(
	  CURLOPT_URL => "https://api.wishfin.com/oauth",
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => "",
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 30,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => "POST",
	  CURLOPT_POSTFIELDS => "{\"username\": \"deal4loans\",\"password\": \"ZGVhbDRsb2Fuc3w3WjZYYk5mcw\",\"client_id\": \"deal4loans\",\"grant_type\" : \"password\"}",
	  CURLOPT_HTTPHEADER => array("cache-control: no-cache", "content-type: application/json")));
	$response = curl_exec($curl);
	$err = curl_error($curl);
	curl_close($curl);
	if ($err) {
	  $return = json_encode(array("error"=>"error #:" . $err));
	} else {
	  $return = $response;
	}
	return $return;
}
/*End oauth*/

function whatsappCustomSendMessage($mobile,$table_name,$requestid,$custom_message)
{
	$oauthRequest = oauthRequest();
	$oauthValue = json_decode($oauthRequest);
	//echo "oAuth - ".$oauthRequest ."<br>";
	//print_r($oauthValue);
	
	if(strlen($oauthValue->error)>0)
	{
		$errorFlag=1;
		$error = $oauthValue->error;
	}
	else
	{
		$errorFlag=0;
		$Bearer= $oauthValue->access_token;
	}
	//echo "Bearer- ".$Bearer."<br>";
	
	//die();

	$curl = curl_init();
	curl_setopt_array($curl, array(
	  CURLOPT_URL => "https://api.wishfin.com/api/v1/send-whatsapp-message",
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => "",
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 30,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => "POST",
	  CURLOPT_POSTFIELDS => "{  \r\n   \"template_id\":\"whatsapp_custom_message_template\",\r\n   \"process_name\":\"deal4loan_experts_message\",\r\n   \"mobile_number\":\"$mobile\",\r\n   \"table_name\":\"$table_name\",\r\n   \"unique_id\":\"$requestid\",\r\n   \"variables\":{  \r\n      \"CUSTOM_MESSAGE\":\"$custom_message\"\r\n   }\r\n}",
	  CURLOPT_HTTPHEADER => array("authorization: Bearer $Bearer", "cache-control: no-cache", "content-type: application/json")));
	
	$response = curl_exec($curl);
	$err = curl_error($curl);
	
	if($errorFlag==1)
	{
		
	}
	else {
		if ($err) {
		   $return = json_encode(array("status"=>"error #:" . $err));
		} else {
		  $return_json_decode = json_decode($response);
	
		  $status = $return_json_decode->status;
		  if($status=="success")
		  {
		  	$return = json_encode(array("status"=>"Message Sent"));
		  }
		  else
		  {
		  	$return = json_encode(array("status"=>"Message Not Sent"));
		  }
		  
		}
	}
	curl_close($curl);
	return $return;
}


?>