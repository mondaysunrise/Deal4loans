<?php
ini_set('max_execution_time', 1500);
require 'scripts/db_init.php';

$qry = "SELECT RequestID,Name,Mobile_Number FROM Req_Credit_Card_Sms WHERE `source` LIKE '%SMS_Lead_ICCS%' AND DATE(Dated) = '2017-09-12' AND Section NOT IN ('Success','Failure')";
//echo $qry."<br>";
$select4mcardsresult = ExecQuery($qry);
$recordcount1 = mysql_num_rows($select4mcardsresult);
$leadidentifier = "cciccs";
$CampId = 94;
$leadId = 660;	
for($i=0;$i<$recordcount1;$i++)
{
	$AllRequestID = mysql_result($select4mcardsresult,$i,'RequestID');
	$Name = mysql_result($select4mcardsresult,$i,'Name');
	$Mobile_Number = mysql_result($select4mcardsresult,$i,'Mobile_Number');
	$callApi = funMakeCall($AllRequestID, $Mobile_Number, $CampId, $leadId, $leadidentifier,$Name);
	$updateProductTbl = "Update Req_Credit_Card_Sms set Section='".$callApi."' where RequestID='".$AllRequestID."'";
	$updateProductTblResult = ExecQuery($updateProductTbl);
}

function funMakeCall($RequestID, $MobileNum, $CampId, $leadId, $leadidentifier,$Name)
{
	$callUrl = "http://124.124.244.139:8080/iCallMateMasterAPI/webresources/";	//new

	//Replace Non-breakable space (nbsp)
	$Name = utf8_encode($Name);
	$Name = preg_replace('/\xc2\xa0/', ' ', $Name);

	$param = '';
	$param["MobileNo"] = $MobileNum;
	$param["Name"] = trim($Name);
	$param["LandMark"] = "City";
	$param["clientid"] = $RequestID;
	$param["crmcallid"] = $leadidentifier;
	$appendStr = "CampaignID=".$CampId."&LeadID=".$leadId."";
	/*
	 * clientid = Unique id of the customer [Send By Deal4loans]
	 * MobileNo = Customer Mobile Number [Send By Deal4loans]
	 * Name = Customer Name [Send By Deal4loans]
	 * transferto = '' This will be blank for this case
	 * CampaignID = ICCS Campaign ID [ICCS End]
	 * LeadID = ICCS ID [ICCS End]
	 * crmcallid = 'leadidentifier' [Send By Deal4loans]
	 */
	$request = '';
	foreach($param as $key=>$val) //traverse through each member of the param array
	{
		$request.= $key."=".urlencode($val); //we have to urlencode the values
		$request.= "&"; 
	}
	$request = substr($request, 0, strlen($request)-1); //remove the final ampersand sign from the request
	$getUrl = $callUrl;
	$url = $getUrl."setMasterAPI/".$request."?".$appendStr;
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$content = curl_exec ($ch);
	$result = json_decode($content);
	//echo "<pre>";print_r($result);
	$status = $result->status;
	return $status;
}

?>
