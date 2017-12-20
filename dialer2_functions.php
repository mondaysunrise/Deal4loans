<?php
require_once 'dialer_constant.php';

$RequestID=121212;
$mobile=9953696361;
$lead_identifier="PLLeads";
$agent_user=6687;
$dialler_process=2;
$campaign_id =9899;//for Credit Card

echo $a = click2call_addlead_dialler2($RequestID, $mobile, $lead_identifier,$agent_user,$dialler_process,$campaign_id);

//echo "<br>";

//echo $b = click2dispose_hangup_dialler2($agent_user, $value);



function click2call_addlead_dialler2($RequestID, $mobile, $lead_identifier,$agent_user,$dialler_process,$campaign_id)
{
	//Hit Api to Add Lead
	$param = array();
	$param["source"] = 'deal4loans_dialler2';
	$param["user"] = str_pad($agent_user, 4, '0', STR_PAD_LEFT);
	$param["pass"] = str_pad($agent_user, 4, '0', STR_PAD_LEFT);
	$param["agent_user"] = str_pad($agent_user, 4, '0', STR_PAD_LEFT);
	$param["function"] = 'external_add_lead';
	$param["phone_number"] = $mobile;
	$param["phone_code"] = 1;
	$param["vendor_lead_code"]=$RequestID;
	$param["source_id"]=$lead_identifier;

	$request = '';
	foreach($param as $key=>$val) //traverse through each member of the param array
	{ 
		$request.= $key."=".urlencode($val); //we have to urlencode the values
		$request.= "&"; //append the ampersand (&) sign after each paramter/value pair
	}
	$request = substr($request, 0, strlen($request)-1); //remove the final ampersand sign from the request

 	$url = "http://".DIALLERIP."/agc/api.php?".$request;

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$content = curl_exec ($ch);
	//echo '<pre>'; print_r($content); //exit;
	
	if((strlen(strpos($content, "ERROR")) > 0))
	{
		$returnValue = $content;
	}
	else
	{
		$explodeVal = explode('|',$content);

		$reqID = substr(trim($explodeVal[11]),4);
		$ReqservID = substr(trim($explodeVal[12]), 0, -4);
		
		
		// Hit Api to Call
		$param = array();
		$param["source"] = 'deal4loans_dialler2';
		$param["user"] = str_pad($agent_user, 4, '0', STR_PAD_LEFT);
		$param["pass"] = str_pad($agent_user, 4, '0', STR_PAD_LEFT);
		$param["agent_user"] = str_pad($agent_user, 4, '0', STR_PAD_LEFT);
		$param["function"] = 'external_dial';
		$param["value"] = $mobile;
		$param["search"] = 'NO';
		$param["preview"] = 'NO';
		$param["focus"] = 'NO';
		
		$request = '';
		foreach($param as $key=>$val) //traverse through each member of the param array
		{ 
			$request.= $key."=".urlencode($val); //we have to urlencode the values
			$request.= "&"; //append the ampersand (&) sign after each paramter/value pair
		}
		$request = substr($request, 0, strlen($request)-1); //remove the final ampersand sign from the request

		$url = "http://".DIALLERIP."/agc/api.php?".$request;

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$content = curl_exec ($ch);
		//echo '<pre>'; print_r($content); //exit;

		if((strlen(strpos($content, "ERROR")) > 0))
		{
			$returnValue = $content;
		}
		else
		{
			$explodeVal = explode('|',$content);

			$reqID = substr(trim($explodeVal[11]),4);
			$ReqservID = substr(trim($explodeVal[12]), 0, -4);
			
			//dialler_process
			
			$checkSql = "select RequestID from Req_Dialer_Records_PL where dialer_camp_id='".$campaign_id."' and Mobile_Number='".$mobile."'";
			$checkQuery = ExecQuery($checkSql);
			$numRowsCheck = mysql_num_rows($checkQuery); 
			if($numRowsCheck>0)
			{
			//update
				$UpdateSQl = "update Req_Dialer_Records_PL set DialerID = '".$ReqservID."' where dialer_camp_id='".$campaign_id."' and RequestID='".$RequestID."'";
				ExecQuery($UpdateSQl);
			
			}
			else
			{
				$InsertSQl = "INSERT INTO Req_Dialer_Records_PL (Reply_Type, RequestID, Name, Mobile_Number, Feedback, Dated,dialer_camp_id, DialerID, AgentID, dialler_process) VALUES ('".$reply_type."', '".$RequestID."', '".$name."', '".$mobile."','NEW', '".$dated."', '".$campaign_id."', '".$ReqservID."', '".$agent_user."', '".$dialler_process."')";
				$InsertQuery = ExecQuery($InsertSQl);
			}

			
			$returnValue = "Your call will get connected in sometime.";
		}
	}
	
	return $returnValue;
}


function click2dispose_hangup_dialler2($agent_user, $value)
{
	//Hit Api to Dispose
	$param = array();
	$param["source"] = 'deal4loans_dialler2';
	$param["user"] = str_pad($agent_user, 4, '0', STR_PAD_LEFT);
	$param["pass"] = str_pad($agent_user, 4, '0', STR_PAD_LEFT);
	$param["agent_user"] = str_pad($agent_user, 4, '0', STR_PAD_LEFT);
	$param["function"] = 'external_status';
	$param["value"] = 'A';

	$request = '';
	foreach($param as $key=>$val) //traverse through each member of the param array
	{
		$request.= $key."=".urlencode($val); //we have to urlencode the values
		$request.= "&"; //append the ampersand (&) sign after each paramter/value pair
	}
	$request = substr($request, 0, strlen($request)-1); //remove the final ampersand sign from the request

 	$url = "http://".DIALLERIP."/agc/api.php?".$request;

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$content = curl_exec ($ch);
	//echo '<pre>'; print_r($content); //exit;

    if((strlen(strpos($content, "ERROR")) > 0))
	{
		$returnValue = $content;
	}
	else
	{
		$explodeVal = explode('|',$content);
		
		$reqID = substr(trim($explodeVal[11]),4);
		$ReqservID = substr(trim($explodeVal[12]), 0, -4);
		
		// Hit Api to Hangup
		$param = array();
		$param["source"] = 'deal4loans_dialler2';
		$param["user"] = str_pad($agent_user, 4, '0', STR_PAD_LEFT);
		$param["pass"] = str_pad($agent_user, 4, '0', STR_PAD_LEFT);
		$param["agent_user"] = str_pad($agent_user, 4, '0', STR_PAD_LEFT);
		$param["function"] = 'external_hangup';
		$param["value"] = 1;

		$request = '';
		foreach($param as $key=>$val) //traverse through each member of the param array
		{ 
			$request.= $key."=".urlencode($val); //we have to urlencode the values
			$request.= "&"; //append the ampersand (&) sign after each paramter/value pair
		}
		$request = substr($request, 0, strlen($request)-1); //remove the final ampersand sign from the request

		$url = "http://".DIALLERIP."/agc/api.php?".$request;

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

		$content = curl_exec ($ch);
		//echo '<pre>'; print_r($content); //exit;
		
		if((strlen(strpos($content, "ERROR")) > 0))
		{
			$returnValue = $content;
		}
		else
		{
			$explodeVal = explode('|',$content);
			
			$reqID = substr(trim($explodeVal[11]),4);
			$ReqservID = substr(trim($explodeVal[12]), 0, -4);
			
			$returnValue = "Your call will get hangup in sometime.";
		}
	}

	return $returnValue;
}

?>
