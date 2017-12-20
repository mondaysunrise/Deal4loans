<?php
/*
$mobile=9971396361;
$table_name="Req_Loan_Personal";
$requestid=12121213;
$full_name="Upendra Kumar";
$bank_name="Standard Chatered Bank";
$status = json_decode(whatsappSendMessage($mobile,$table_name,$requestid,$full_name,$bank_name));
echo $status->status;
*/
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
	//echo $return;
	return $return;
}
/*End oauth*/

function whatsappSendMessage($mobile,$table_name,$requestid,$full_name,$bank_name)
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
	  CURLOPT_POSTFIELDS => "{\"template_id\": \"d4l_whatsapp_message_template\", \"process_name\":\"deal4loan_process_name\", \"mobile_number\": \"$mobile\", \"table_name\": \"$table_name\", \"unique_id\": \"$requestid\", \"variables\": {\"FULL_NAME\": \"$full_name\",\"BANK_NAME\": \"$bank_name\", \"TAG_YES\": \"SC Y\", \"TAG_NO\":\"SC N\" } }",
	 // CURLOPT_POSTFIELDS => "{\"template_id\": \"d4l_whatsapp_message_template\", \"process_name\":\"deal4loan_process_name\", \"mobile_number\": \"9971396361\", \"table_name\": \"dummy\", \"unique_id\": \"12345\", \"variables\": {\"FULL_NAME\": \"Prashant\",\"BANK_NAME\": \"Prashant\", \"TAG_YES\": \"YES\", \"TAG_NO\":\"NO\" } }",
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

function whatsappCustomSendMessage($mobile,$table_name,$requestid,$custom_message,$process_name='deal4loan_experts_message')
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
	  CURLOPT_POSTFIELDS => "{  \r\n   \"template_id\":\"whatsapp_custom_message_template\",\r\n   \"process_name\":\"$process_name\",\r\n   \"mobile_number\":\"$mobile\",\r\n   \"table_name\":\"$table_name\",\r\n   \"unique_id\":\"$requestid\",\r\n   \"variables\":{  \r\n      \"CUSTOM_MESSAGE\":\"$custom_message\"\r\n   }\r\n}",
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