<?php
ini_set('max_execution_time', 1800);
require 'scripts/db_init.php';
//require 'digitech-predictivefunctionsforbanks.php';

$call_IP="103.12.135.98";

$DigitechPredictiveFunctionsObj = new DigitechPredictiveFunctions();

echo "<br>***********************************************************************************************************<br>";
echo "Leads Push through DIGITECH API for Predective Calling";
echo "<br>***********************************************************************************************************<br>";

echo $sbibank = $DigitechPredictiveFunctionsObj->insertLeadsToRCCSDigitech('diallerccleadstodigitechsbi',7297,'SMS_Digi_Lead_SBI',104,669,$call_IP);
echo "<br>***********************************************************************************************************<br>";




class DigitechPredictiveFunctions{
	
	public function __construct() {
		
    }
    
    function insertLeadsToRCCDigitech($leadidentifier, $PushBidderID,$DefinedSource,$CampId,$leadId,$call_IP)
	{
		$currentdate=Date('Y-m-d');
		$min_date = $currentdate." 00:00:00";
		$max_date = $currentdate." 23:59:59";
		
		//$min_date = "2017-09-07 00:00:00";
		//$max_date = "2017-09-07 23:59:59";

		$startprocess="SELECT total_lead_count FROM lead_allocation_table WHERE Citywise='".$leadidentifier."' and BidderID='".$PushBidderID."'";
		//echo $startprocess."<br>";
		$startprocessresult = d4l_ExecQuery($startprocess);
		$recordcount = d4l_mysql_num_rows($startprocessresult);
		$row=d4l_mysql_fetch_array($startprocessresult);
		$total_lead_count = $row["total_lead_count"];
		if($total_lead_count>0)
		{
			$qry = "SELECT RequestID,Name,Mobile_Number FROM Req_Credit_Card LEFT JOIN lead_allocate ON (lead_allocate.AllRequestID = Req_Credit_Card.RequestID) WHERE Req_Credit_Card.source='".$DefinedSource."' AND RequestID > '".$total_lead_count."' AND lead_allocate.BidderID = '".$PushBidderID."' AND (Req_Credit_Card.Section IS NULL OR Req_Credit_Card.Section='') AND (Req_Credit_Card.Dated  > DATE_SUB(NOW(), INTERVAL 2 DAY))  GROUP BY AllRequestID";
		}
		//echo $qry = "SELECT RequestID,Name,Mobile_Number FROM Req_Credit_Card WHERE RequestID = '1225589'";
		//echo $qry."<br>";
		$select4mcardsresult = d4l_ExecQuery($qry);
		$recordcount1 = d4l_mysql_num_rows($select4mcardsresult);

		for($i=0;$i<$recordcount1;$i++)
		{
			$AllRequestID = d4l_mysql_result($select4mcardsresult,$i,'RequestID');
			$Name = d4l_mysql_result($select4mcardsresult,$i,'Name');
			$Mobile_Number = d4l_mysql_result($select4mcardsresult,$i,'Mobile_Number');
			$callApi = $this->funMakeCall($AllRequestID, $Mobile_Number, $CampId, $leadId, $leadidentifier,$Name,$call_IP);
			$updateProductTbl = "UPDATE Req_Credit_Card SET Section='".$callApi."' WHERE RequestID='".$AllRequestID."'";
			$updateProductTblResult = d4l_ExecQuery($updateProductTbl);

			$updateqry= "UPDATE lead_allocation_table SET total_lead_count='".$AllRequestID."' WHERE Citywise='".$leadidentifier."' AND BidderID='".$PushBidderID."'";
			$updateqryresult = d4l_ExecQuery($updateqry);
			//echo $updateqry."<br>";
		}
	}
	
	//echo $amex = $DigitechPredictiveFunctionsObj->insertLeadsToRCCSDigitech('diallerccleadstoiccs',7188,'SMS_Lead_ICCS',94,660,$call_IP);
	function insertLeadsToRCCSDigitech($leadidentifier, $PushBidderID,$DefinedSource,$CampId,$leadId,$call_IP)
	{
		$currentdate=Date('Y-m-d');
		$min_date = $currentdate." 00:00:00";
		$max_date = $currentdate." 23:59:59";

		$startprocess="SELECT total_lead_count FROM lead_allocation_table WHERE Citywise='".$leadidentifier."' and BidderID='".$PushBidderID."'";
		//echo $startprocess."<br>";
		$startprocessresult = d4l_ExecQuery($startprocess);
		$recordcount = d4l_mysql_num_rows($startprocessresult);
		$row=d4l_mysql_fetch_array($startprocessresult);
		$total_lead_count = $row["total_lead_count"];
		if($total_lead_count>0)
		{
			$qry = "SELECT RequestID,Name,Mobile_Number FROM Req_Credit_Card_Sms LEFT JOIN lead_allocate ON (lead_allocate.AllRequestID = Req_Credit_Card_Sms.RequestID) WHERE Req_Credit_Card_Sms.source='".$DefinedSource."' AND RequestID > '".$total_lead_count."' AND lead_allocate.BidderID = '".$PushBidderID."' AND (Req_Credit_Card_Sms.Section IS NULL OR Req_Credit_Card_Sms.Section='') AND (Req_Credit_Card_Sms.Dated  > DATE_SUB(NOW(), INTERVAL 2 DAY)) GROUP BY AllRequestID";
		}
		echo $qry."<br>";
		$select4mcardsresult = d4l_ExecQuery($qry);
		$recordcount1 = d4l_mysql_num_rows($select4mcardsresult);

		for($i=0;$i<$recordcount1;$i++)
		{
			$AllRequestID = d4l_mysql_result($select4mcardsresult,$i,'RequestID');
			$Name = d4l_mysql_result($select4mcardsresult,$i,'Name');
			$Mobile_Number = d4l_mysql_result($select4mcardsresult,$i,'Mobile_Number');
			$callApi = $this->funMakeCall($AllRequestID, $Mobile_Number, $CampId, $leadId, $leadidentifier,$Name,$call_IP);
			$updateProductTbl = "UPDATE Req_Credit_Card_Sms SET Section='".$callApi."' WHERE RequestID='".$AllRequestID."'";
			$updateProductTblResult = d4l_ExecQuery($updateProductTbl);

			$updateqry= "UPDATE lead_allocation_table SET total_lead_count='".$AllRequestID."' WHERE Citywise='".$leadidentifier."' AND BidderID='".$PushBidderID."'";
			$updateqryresult = d4l_ExecQuery($updateqry);
			//echo $updateqry."<br>";
		}
	}
	
	function funMakeCall($RequestID, $MobileNum, $CampId, $leadId, $leadidentifier,$Name,$call_IP)
	{
		$callUrl = "http://".$call_IP.":8080/iCallMateMasterAPI/webresources/";
		
		$Name = utf8_encode($Name);
		$Name = preg_replace('/\xc2\xa0/', ' ', $Name);

		$param = '';
		$param["MobileNo"] = $MobileNum;
		$param["Name"] = $Name;
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
		//print_r($result);
		$status = $result->status;
		
		return $status;
	}

}


/* 
 * New API's
 * 
Amex

http://103.12.135.98:8080/iCallMateMasterAPI/webresources/setMasterAP
I/MobileNo=7838594940&Name=Amit&LandMark=Noida&clientid=123456&
crmcallid=1234567?CampaignID=105&LeadID=638


ICICI

http://125.16.147.178:8080/iCallMateMasterAPI/webresources/setMasterAP
I/MobileNo=9958202041&Name=Amit&LandMark=Noida&clientid=123456&
crmcallid=1234567?CampaignID=101&LeadID=639


RBL

http://125.16.147.178:8080/iCallMateMasterAPI/webresources/setMasterAP
I/MobileNo=9958202041&Name=Amit&LandMark=Noida&clientid=123456&
crmcallid=1234567?CampaignID=103&LeadID=640


SCb

http://125.16.147.178:8080/iCallMateMasterAPI/webresources/setMasterAP
I/MobileNo=9958202041&Name=Amit&LandMark=Noida&clientid=123456&
crmcallid=1234567?CampaignID=104&LeadID=642


SBI

http://125.16.147.178:8080/iCallMateMasterAPI/webresources/setMasterAP
I/MobileNo=9958202041&Name=Amit&LandMark=Noida&clientid=123456&
crmcallid=1234567?CampaignID=102&LeadID=641

*/
?>
