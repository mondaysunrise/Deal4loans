<?php
require 'scripts/db_init.php';
require 'scripts/functions.php';
require 'dialer_click2call_function.php';

$RequestID = $_REQUEST['RequestID'];
$agent_user = $_REQUEST['agent_user'];

$getUserDetailsSql = "select Name, Mobile_Number from Req_Credit_Card_Sms where RequestID = '".$RequestID."'";
$getUserDetailsQuery = ExecQuery($getUserDetailsSql);
$name = mysql_result($getUserDetailsQuery,0,'Name');
$mobile = mysql_result($getUserDetailsQuery,0,'Mobile_Number');

$qryCheck = "SELECT leadidentifier, Profile,dialler_process FROM Bidders where BidderID='".$agent_user."'";
$qryCheckQuery = ExecQuery($qryCheck);
$lead_identifier = mysql_result($qryCheckQuery,0,'leadidentifier');
$dialler_process = mysql_result($qryCheckQuery,0,'dialler_process');

$campaign_id = 1518;//Change this
$reply_type = 4;
if($dialler_process==2)
{
	$campaign_id = 9898;//CC [List ID]
	echo click2call_addlead_dialler2($RequestID, $mobile, $lead_identifier,$agent_user,$dialler_process,$campaign_id,$reply_type);
}
else
{
	echo click2call($RequestID, $name, $mobile, $reply_type, $lead_identifier,$agent_user,$campaign_id);
}


function click2call_addlead_dialler3($RequestID, $mobile, $lead_identifier,$agent_user,$dialler_process,$campaign_id, $reply_type=1)
{
	//Hit Api to Add Lead
	$param = array();
	$param["source"] = 'deal4loans_dialler2';
	$param["user"] = str_pad($agent_user, 4, '0', STR_PAD_LEFT);
	$param["pass"] = str_pad($agent_user, 4, '0', STR_PAD_LEFT);
	$param["agent_user"] = str_pad($agent_user, 4, '0', STR_PAD_LEFT);
	$param["function"] = 'external_add_lead';
	$param["phone_number"] = "0".$mobile;
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
// 	$url = "http://192.168.1.201/agc/api.php?".$request;
//echo $url;
//die();
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$content = curl_exec ($ch);
	echo '<pre>'; print_r($content); //exit;
	die();
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
//$url = "http://192.168.1.201/agc/api.php?".$request;
//echo $url;
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


?>