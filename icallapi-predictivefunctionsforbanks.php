<?php
	function funMakeCall($RequestID, $MobileNum, $CampId, $leadId, $leadidentifier,$Name,$call_IP )	{
		$callUrl = "http://".$call_IP.":8080/iCallMateMasterAPI/webresources/";
		$param = ''; 
		$param["MobileNo"] = $MobileNum;
		 $param["Name"] = $Name;
		  $param["LandMark"] = "City";
		   $param["clientid"] = $RequestID; 
		   $param["crmcallid"] = $leadidentifier;
		   
		   
		$appendStr = "CampaignID=".$CampId."&LeadID=".$leadId."";	
	
		
		$request = '';	foreach($param as $key=>$val) { $request.= $key."=".urlencode($val);  $request.= "&"; }
		$request = substr($request, 0, strlen($request)-1);  $getUrl = $callUrl; $url = $getUrl."setMasterAPI/".$request."?".$appendStr; $ch = curl_init();
		curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_URL, $url); curl_setopt($ch, CURLOPT_HEADER, 0);	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); $content = curl_exec ($ch);		
		$result = json_decode($content); $status = $result->status; return $status;
	}
	
function insertLeadtoICCS($leadidentifier, $PushBidderID,$DefinedSource,$CampId,$leadId,$call_IP)
{
	$currentdate=Date('Y-m-d');
	$min_date = $currentdate." 00:00:00";
	$max_date = $currentdate." 23:59:59";

	$startprocess="Select total_lead_count From lead_allocation_table Where (Citywise='".$leadidentifier."' and BidderID='".$PushBidderID."')";
	echo $startprocess."<br>";
	$startprocessresult = d4l_ExecQuery($startprocess);
	$recordcount = d4l_mysql_num_rows($startprocessresult);
	$row=d4l_mysql_fetch_array($startprocessresult);
//	print_r($row);
 	$total_lead_count = $row["total_lead_count"];
	if($total_lead_count>0)
	{
		$qry = "SELECT RequestID,Name,Mobile_Number FROM Req_Credit_Card LEFT OUTER JOIN lead_allocate ON lead_allocate.AllRequestID=Req_Credit_Card.RequestID WHERE ( Req_Credit_Card.source='".$DefinedSource."' and RequestID>'".$total_lead_count."' and lead_allocate.BidderID='".$PushBidderID."' and (Req_Credit_Card.Section IS NULL OR Req_Credit_Card.Section='') and (Req_Credit_Card.Dated  > DATE_SUB(NOW(), INTERVAL 2 DAY))) group by AllRequestID";
	}
	echo $qry."<br>";
	$select4mcardsresult = d4l_ExecQuery($qry);
	echo $recordcount1 = d4l_mysql_num_rows($select4mcardsresult);
	//if($recordcount1>500) {		$recordcount1=500;	} // Commented on 020517 as discussed and said by Lalit Sir
//	$leadidentifier = "cciccs";

	//die();
	for($i=0;$i<$recordcount1;$i++)
	{
		$AllRequestID = d4l_mysql_result($select4mcardsresult,$i,'RequestID');
		$Name = d4l_mysql_result($select4mcardsresult,$i,'Name');
		$Mobile_Number = d4l_mysql_result($select4mcardsresult,$i,'Mobile_Number');
		$callApi = funMakeCall($AllRequestID, $Mobile_Number, $CampId, $leadId, $leadidentifier,$Name,$call_IP);
		$updateProductTbl = "Update Req_Credit_Card set Section='".$callApi."' where RequestID='".$AllRequestID."'";
		$updateProductTblResult = d4l_ExecQuery($updateProductTbl);

		$updateqry= "Update lead_allocation_table set total_lead_count='".$AllRequestID."' Where (Citywise='".$leadidentifier."' and BidderID='".$PushBidderID."')";
		$updateqryresult = d4l_ExecQuery($updateqry);
		echo $updateqry."<br>";
	}
}
?>