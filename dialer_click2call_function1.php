<?php
require_once 'dialer_constant.php';
function click2call($RequestID, $name, $mobile, $reply_type, $lead_identifier,$agent_user,$campaign_id)
{
	//$agent_user = 6163;
//	$agent_user = 5960;
	$list_id = $campaign_id;
	$param = '';
	//$param["source"] = "Click2Call";
	$param["source"] = $name;
	$param["user"] = str_pad($agent_user, 4, '0', STR_PAD_LEFT);
	$param["pass"] = str_pad($agent_user, 4, '0', STR_PAD_LEFT);
	$param["agent_user"] = str_pad($agent_user, 4, '0', STR_PAD_LEFT);
	$param["list_id"] = $list_id;
	$param["first_name"] = $name;
	$param["function"] = 'external_dial';
	$param["value"] = $mobile;//Mobile
	$param["search"] = 'YES';
	$param["preview"] = 'NO';
	$param["focus"] = 'YES';
	$param["unique_id"] = $RequestID;
	$param["product_id"] = '1';
	$param["lead_identifier"] = $lead_identifier;
		
//	print_r($param);
	//exit();
		
	$dated = ExactServerdate();

	$request = '';
	foreach($param as $key=>$val) //traverse through each member of the param array
	{ 
	  $request.= $key."=".urlencode($val); //we have to urlencode the values
	  $request.= "&"; //append the ampersand (&) sign after each paramter/value pair
	}
	$request = substr($request, 0, strlen($request)-1); //remove the final ampersand sign from the request

 	$url = "https://".DIALLERIP."/agc/api.php?".$request;
 	//echo $url."<br>";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	//curl_setopt ($ch, CURLOPT_POST, 1);
	$content = curl_exec ($ch);
	//echo "<br>";
//echo "<br>";
//	print_r($content);
	//echo $content;
//echo "<br>";
    if((strlen(strpos($content, "ERROR")) > 0))
	{
		$returnValue = $content;
	}
	else
	{
		$explodeVal = explode('|',$content);
		//print_r($explodeVal);
		
		$reqID = substr(trim($explodeVal[11]),4);
		$ReqservID = substr(trim($explodeVal[12]), 0, -4);
		
//http://192.168.1.201/agc/api.php?source=test&user=8001&pass=8001&agent_user=8001&function=external_dial&value=9694666974&search=YES&preview=NO&focus=YES&unique_id=3004&product_id=5678&lead_identifier=abc

		if($lead_identifier=="plmainlms79" || $lead_identifier=="plmainlmsS")
		{
			$qryCheck = "SELECT BidderID FROM Bidders where leadidentifier='".$lead_identifier."' and Profile='".$agent_user."'";
			$qryCheckQuery = ExecQuery($qryCheck);
			$agent_user = mysql_result($qryCheckQuery,0,'BidderID');
			$InsertSQl = "INSERT INTO Req_Dialer_Records_PL (Reply_Type, RequestID, Name, Mobile_Number, Feedback, Dated,dialer_camp_id, DialerID, AgentID) VALUES ('".$reply_type."', '".$RequestID."', '".$name."', '".$mobile."','NEW', '".$dated."', '".$campaign_id."', '".$ReqservID."', '".$agent_user."')";
			$InsertQuery = ExecQuery($InsertSQl);
		}
		else
		{
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
			
				$InsertSQl = "INSERT INTO Req_Dialer_Records_PL (Reply_Type, RequestID, Name, Mobile_Number, Feedback, Dated,dialer_camp_id, DialerID, AgentID) VALUES ('".$reply_type."', '".$RequestID."', '".$name."', '".$mobile."','NEW', '".$dated."', '".$campaign_id."', '".$ReqservID."', '".$agent_user."')";
				$InsertQuery = ExecQuery($InsertSQl);
			}
		}
		$returnValue = "Your call will get conneted in sometime.";
	}
	return $returnValue;
}


function click2call_addlead_dialler2($RequestID, $mobile, $lead_identifier,$agent_user,$dialler_process,$campaign_id, $reply_type=1)
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

 echo	$url = "http://".DIALLERIP."/agc/api.php?".$request;
/*
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
	} */
	
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