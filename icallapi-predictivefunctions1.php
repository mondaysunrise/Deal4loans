<?php
ini_set('max_execution_time', 1500);
require 'scripts/db_init.php';
	//	var $callUrl = "http://43.252.243.14:8080/iCallMateWebSvCC";
	//	var $callUrl = "http://115.249.245.30:8080/iCallMateWebSvCC";
//http://115.249.245.30:8080/iCallMateMasterAPI/webresources/setMasterAPI/MobileNo=9728300674&Name=Amit&LandMark=Noida&clientid=85749615&crmcallid=1234567?CampaignID=94&LeadID=566
//http://115.249.245.30:8080/iCallMateMasterAPI/webresources/setMasterAPI/MobileNo=9998881112&Name=Arjun&LandMark=Noida&API-DateTime=2016-05-03 20:04:07.000?CampaignID=94&LeadID=566
	function funMakeCall($RequestID, $MobileNum, $CampId, $leadId, $leadidentifier,$Name)
	{
		//$callUrl = "http://115.249.245.30:8080/iCallMateMasterAPI/webresources/";	//08-03-17
		$callUrl = "http://124.124.244.139:8080/iCallMateMasterAPI/webresources/";	//new
//		$callUrl = "http://103.18.75.251:8080/iCallMateMasterAPI/webresources/";//new as on 04-03-17
//		$callUrl = "http://180.151.74.83:8080/iCallMateMasterAPI/webresources/";
		//var $callUrl = "http://115.249.245.30:8080/iCallMateWebSvc";
		
		
		
		$param = '';
		$param["MobileNo"] = $MobileNum;
		$param["Name"] = $Name;
		$param["LandMark"] = "City";
		$param["clientid"] = $RequestID;
		$param["crmcallid"] = $leadidentifier;
		$appendStr = "CampaignID=".$CampId."&LeadID=".$leadId."";
		/*
		clientid = Unique id of the customer [Send By Deal4loans]		MobileNo = Customer Mobile Number [Send By Deal4loans]		Name = Customer Name [Send By Deal4loans]
		transferto = '' This will be blank for this case		campid = ICCS Campaign ID [ICCS End]		leadid = ICCS ID [ICCS End]		crmcallid = 'leadidentifier' [Send By Deal4loans]
		*/
		$request = '';
		foreach($param as $key=>$val) //traverse through each member of the param array
		{ 
		  $request.= $key."=".urlencode($val); //we have to urlencode the values
		  $request.= "&"; 
		}
		$request = substr($request, 0, strlen($request)-1); //remove the final ampersand sign from the request
		$getUrl = $callUrl;
	echo	$url = $getUrl."setMasterAPI/".$request."?".$appendStr;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$content = curl_exec ($ch);
		$result = json_decode($content);
		echo "<pre>";
		print_r($result);
		$status = $result->status;
		return $status;
	}

//insert in Req_Credit_Card_Sms
//$NameArr = array("Upendra", "Upendra 1", "Parveen", "Shweta", "Ranjana", "Ranjana 1"); //$MobileNum = array(9971396361,9953696361,9599048545, 9999047207,9811215138,9873678915);

	$startprocess="Select total_lead_count From lead_allocation_table Where (Citywise='diallerccleadstoiccs' and BidderID=6449)";
	echo $startprocess."<br>";
	$startprocessresult = ExecQuery($startprocess);
	$recordcount = mysql_num_rows($startprocessresult);
	$row=mysql_fetch_array($startprocessresult);
//	print_r($row);
 	$total_lead_count = $row["total_lead_count"];
	if($total_lead_count>0)
	{
	$currentdate=Date('Y-m-d');
	$min_date = $currentdate." 00:00:00";
	$max_date = $currentdate." 23:59:59";

		$qry = "SELECT RequestID,Name,Mobile_Number FROM Req_Credit_Card_Sms LEFT OUTER JOIN lead_allocate ON lead_allocate.AllRequestID=Req_Credit_Card_Sms.RequestID WHERE ( Req_Credit_Card_Sms.source='SMS_Lead_ICCS' and RequestID>'".$total_lead_count."' and lead_allocate.BidderID=6449 and (Req_Credit_Card_Sms.Section IS NULL OR Req_Credit_Card_Sms.Section='') and Req_Credit_Card_Sms.Dated Between '".$min_date."' and '".$max_date."') group by AllRequestID";
	}
		$qry = "SELECT RequestID,Name,Mobile_Number FROM Req_Credit_Card_Sms WHERE RequestID=1";
		echo $qry."<br>";
	$select4mcardsresult = ExecQuery($qry);
	echo $recordcount1 = mysql_num_rows($select4mcardsresult);
	//if($recordcount1>500) {		$recordcount1=500;	} // Commented on 020517 as discussed and said by Lalit Sir
	$leadidentifier = "cciccs";
//	$CampId = 94;	$leadId = 566;
	$CampId = 94;	$leadId = 660;	
	for($i=0;$i<$recordcount1;$i++)
	{
		$AllRequestID = mysql_result($select4mcardsresult,$i,'RequestID');
		$Name = mysql_result($select4mcardsresult,$i,'Name');
		$Mobile_Number = mysql_result($select4mcardsresult,$i,'Mobile_Number');
		$callApi = funMakeCall($AllRequestID, $Mobile_Number, $CampId, $leadId, $leadidentifier,$Name);
		$updateProductTbl = "Update Req_Credit_Card_Sms set Section='".$callApi."' where RequestID='".$AllRequestID."'";
		$updateProductTblResult = ExecQuery($updateProductTbl);
		echo $updateProductTbl."<br>";
		$updateqry= "Update lead_allocation_table set total_lead_count='".$AllRequestID."' Where (Citywise='diallerccleadstoiccs' and BidderID=6449)";
		//$updateqryresult = ExecQuery($updateqry);
		echo $updateqry."<br>";
		
	}
?>
