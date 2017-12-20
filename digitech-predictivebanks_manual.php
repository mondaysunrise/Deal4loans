<?php
ini_set('max_execution_time', 600);
require 'scripts/db_init.php';

$call_IP="103.12.135.98";

//insertLeadsToRCCDigitech('diallerccleadstodigitechamex',7194,'SMS_Digi_Lead_AMEX',105,661,$call_IP);

//insertLeadsToRCCDigitech('diallerccleadstodigitechrbl',7195,'SMS_Digi_Lead_RBL',103,662,$call_IP);

echo  insertLeadsToRCCSDigitech('diallerccleadstodigitechsbi',7297,'SMS_Digi_Lead_SBI',104,678,$call_IP);

function insertLeadsToRCCSDigitech($leadidentifier, $PushBidderID,$DefinedSource,$CampId,$leadId,$call_IP)
{
	$qry = "SELECT RequestID,Name,Mobile_Number FROM `Req_Credit_Card_Sms` WHERE RequestID in (2050550,2050551,2050552,2050553,2050554,20505505)";
	//echo $qry."<br>";
	$select4mcardsresult = d4l_ExecQuery($qry);
	$recordcount1 = d4l_mysql_num_rows($select4mcardsresult);

	for($i=0;$i<$recordcount1;$i++)
	{
		$AllRequestID = d4l_mysql_result($select4mcardsresult,$i,'RequestID');
		$Name = d4l_mysql_result($select4mcardsresult,$i,'Name');
		$Mobile_Number = d4l_mysql_result($select4mcardsresult,$i,'Mobile_Number');
		//$Mobile_Number=9953696361;
		echo $callApi = funMakeCall($AllRequestID, $Mobile_Number, $CampId, $leadId, $leadidentifier,$Name,$call_IP);
		echo "<br>";
	echo	$updateProductTbl = "UPDATE Req_Credit_Card_Sms SET Section='".$callApi."' WHERE RequestID='".$AllRequestID."'";
		$updateProductTblResult = d4l_ExecQuery($updateProductTbl);
	}
}

function funMakeCall($RequestID, $MobileNum, $CampId, $leadId, $leadidentifier,$Name,$call_IP)
{
	$callUrl = "http://".$call_IP.":8080/iCallMateMasterAPI/webresources/";
	
	//Replace Non-breakable space (nbsp)
	$Name = utf8_encode($Name);
	$Name = preg_replace('/\xc2\xa0/', ' ', $Name);
	//echo $Name;

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
	foreach($param as $key=>$val)
	{
		$request.= $key."=".urlencode($val);
		$request.= "&";
	}
	$request = substr($request, 0, strlen($request)-1);
	$getUrl = $callUrl;
	echo "<br>";
	echo $url = $getUrl."setMasterAPI/".$request."?".$appendStr;
	echo "<br>";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$content = curl_exec ($ch);		
	$result = json_decode($content);
	echo '<pre>';print_r($result);
	$status = $result->status;
	
	return $status;
}
?>
