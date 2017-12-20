<?php
ini_set('max_execution_time', 1500);
require 'scripts/db_init.php';
	
$startprocess="Select total_lead_count From lead_allocation_table Where (Citywise='diallerccleadstoiccs' and BidderID=6449)";
//echo $startprocess."<br>";
$startprocessresult = ExecQuery($startprocess);
$recordcount = mysql_num_rows($startprocessresult);
$row=mysql_fetch_array($startprocessresult);
//print_r($row);
$total_lead_count = $row["total_lead_count"];
if($total_lead_count>0)
{
	$currentdate=Date('Y-m-d');
	$min_date = $currentdate." 00:00:00";
	$max_date = $currentdate." 23:59:59";

	$qry = "SELECT RequestID,Name,Mobile_Number,Section FROM Req_Credit_Card_Sms JOIN lead_allocate ON lead_allocate.AllRequestID=Req_Credit_Card_Sms.RequestID WHERE ( Req_Credit_Card_Sms.source='SMS_Lead_ICCS' and RequestID>'".$total_lead_count."' and lead_allocate.BidderID=6449 and (Req_Credit_Card_Sms.Section IS NULL OR Req_Credit_Card_Sms.Section='') and (Req_Credit_Card_Sms.Dated  > DATE_SUB(NOW(), INTERVAL 2 DAY))) group by AllRequestID LIMIT 0,700";
}
$qry = "SELECT RequestID,Name,Mobile_Number FROM `Req_Credit_Card_Sms` WHERE RequestID=2057232";
//echo $qry."<br>";

$select4mcardsresult = ExecQuery($qry);
$recordcount1 = mysql_num_rows($select4mcardsresult);
//if($recordcount1>1500) {		$recordcount1=1500;	} // Commented on 020517 as discussed and said by Lalit Sir
$leadidentifier = "cciccs";
//$CampId = 94;	$leadId = 699;	
$CampId = 94;	$leadId = 711;	
$Section='';
for($i=0;$i<$recordcount1;$i++)
{
	$Section='';
	$AllRequestID = mysql_result($select4mcardsresult,$i,'RequestID');
	$Name = mysql_result($select4mcardsresult,$i,'Name');
	$Mobile_Number = mysql_result($select4mcardsresult,$i,'Mobile_Number');
	$Section = mysql_result($select4mcardsresult,$i,'Section');
	if($Section!='Success')
	{
		echo $callApi = funMakeCall($AllRequestID, $Mobile_Number, $CampId, $leadId, $leadidentifier,$Name);

	}
	else 
	{
		echo $callApi = funMakeCall($AllRequestID, $Mobile_Number, $CampId, $leadId, $leadidentifier,$Name);
//		$Section='';
	}
	$updateProductTbl = "Update Req_Credit_Card_Sms set Section='".$callApi."' where RequestID='".$AllRequestID."'";
	//$updateProductTblResult = ExecQuery($updateProductTbl);
	//echo $updateProductTbl."<br>";
	$updateqry= "Update lead_allocation_table set total_lead_count='".$AllRequestID."' Where (Citywise='diallerccleadstoiccs' and BidderID=6449)";
	//$updateqryresult = ExecQuery($updateqry);
	//echo $updateqry."<br>";
}

function funMakeCall($RequestID, $MobileNum, $CampId, $leadId, $leadidentifier,$Name)
{
//	$callUrl = "http://124.124.244.139:8080/iCallMateMasterAPI/webresources/";	//new
	$callUrl = "http://103.47.56.10:8080/iCallMateMasterAPI/webresources/";	//updated on 20-10-17 as told by Sunny Suri ICCS Team

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
	echo $url."<br>";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$content = curl_exec ($ch);
	$result = json_decode($content);
	echo "<pre>";print_r($result);
	$status = $result->status;
	return $status;
}
?>
