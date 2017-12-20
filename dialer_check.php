<?php
require 'scripts/db_init.php';
$RequestID = 1948171;
$Name = "Upendra Kumar";
$Mobile = 9971396361;
$identifier= "smsplleads";
$campaignId=1001;
$AgentID = 5931;

$call_check = redialDialler($Name,$Mobile,$RequestID,$identifier,$campaignId,$AgentID);
echo "<br><br>";
print_r($call_check);
echo "<br><br>";
function redialDialler($Name,$Mobile,$RequestID,$identifier,$campaignId,$AgentID,$feedback='Callback')
{
	//https://122.176.122.134/webclient/reports/deal4loan_click2call.php?Name=Krishna&Mobile_Number=912912912&UniqueID=9870&LeadIdentifier=aa12dd&campaignId=98989898&feedback=Callback&userID=[USERID]                 
 

	$diallerUrl = "https://122.176.122.134/webclient/reports/deal4loan_click2call.php?";
	$param["Name"] = trim($Name);
	$param["Mobile_Number"] = "0".$Mobile;
	$param["UniqueID"] = $RequestID;
	$param["LeadIdentifier"] = $identifier;
	$param["campaignId"] = $campaignId;
	$param["feedback"] = $feedback;
	$param["userID"] = $AgentID;
		
	$dated = ExactServerdate();
	echo "<br>";
	print_r($param);
	echo "<br>";
 
	$request = '';
	foreach($param as $key=>$val) //traverse through each member of the param array
	{ 
	  $request.= $key."=".urlencode($val); //we have to urlencode the values
	  $request.= "&"; //append the ampersand (&) sign after each paramter/value pair
	}
	$request = substr($request, 0, strlen($request)-1); //remove the final ampersand sign from the request

	$InsertSQl = "INSERT INTO Req_Dialer_Records_PL (Reply_Type, RequestID, Name, Mobile_Number, Feedback, Dated, lead_track) VALUES ('".$Reply_Type."', '".$param["UniqueID"]."', '".$param["Name"]."', '".$param["Mobile_Number"]."', '', '".$dated."', 'ClickCall')";
	$InsertQuery = ExecQuery($InsertSQl);
	$lastID =mysql_insert_id();

	//echo $request."<br><br>";

  	echo  $url = $diallerUrl."".$request;
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	//curl_setopt ($ch, CURLOPT_POST, 1);
	$content = curl_exec ($ch);
	echo "<br>";
	echo "<br>";
	print_r($content);
	echo "<br>";
	$explodeVal = explode(',',$content);
	$ReqID = $explodeVal[0];
	$ReqservID = $explodeVal[1];
	$status = $explodeVal[2];
	
	echo "<br>";
	echo $UpdateSQl = "update Req_Dialer_Records_PL set Feedback = '".$status."', DialerID = '".$ReqservID."' where ID = '".$lastID."' and RequestID='".$ReqID."'";
	ExecQuery($UpdateSQl);
	curl_close ($ch);
	return $status; 
}
?>