<?php
require_once 'scripts/db_init.php';
require_once 'scripts/functions_nw.php';
function convertDt($dDate)
{
	$implodeDt = explode("-", $dDate);
	$dt = $implodeDt[2]."-".$implodeDt[1]."-".$implodeDt[0];
	return $dt;
}
$getConstantsMsgSql = "select to_email, cc_email,to_sms, cc_sms, mail_template, sms_template  from web_services_notifications where WSID='10001'";
	list($checkmyrowWSNum,$getConstantsMsgVal)=MainselectfuncNew($getConstantsMsgSql,$array = array());
	//print_r($getConstantsMsgVal);
	$default_to_email = $getConstantsMsgVal[0]['to_email'];
	$default_cc_email = $getConstantsMsgVal[0]['cc_email'];
	$default_to_sms = $getConstantsMsgVal[0]['to_sms'];
	$default_cc_sms = $getConstantsMsgVal[0]['cc_sms'];
	$default_sms_template = $getConstantsMsgVal[0]['sms_template'];
	$default_email_template = $getConstantsMsgVal[0]['mail_template'];

	define("default_to_email", $default_to_email);
	define("default_cc_email", $default_cc_email);
	define("default_to_sms", $default_to_sms);
	define("default_cc_sms", $default_cc_sms);

	$lastHourTS = time() - (60 * 60 * 24);
	$Today = date('Y-m-d', $lastHourTS);
	$min_date=$Today." 00:00:00";
	$max_date=$Today." 23:59:59";
	$TodayDt = date('d-m-Y', $lastHourTS);

$getwsSql = "select * from web_services where Status=1";
list($checkgeNotificationNum, $getNotificationrow) = MainselectfuncNew($getwsSql,$array = array());
$content='';
for($j=0;$j<$checkgeNotificationNum;$j++)
{
		$content = '';	
	$WSID =  $getNotificationrow[$j]['ID'];
	$WSName =  $getNotificationrow[$j]['Name'];
	$table_name = $getNotificationrow[$j]['table_name'];
	$allotation_table_name = $getNotificationrow[$j]['allotation_table_name'];
	
	$getBidderIDSql = "select * from web_services_bidders_map where WSID='".$WSID."'";
	list($checkBidderINum, $getBidderIrow) = MainselectfuncNew($getBidderIDSql,$array = array());
	$getListBID = '';
	for($k=0;$k<$checkBidderINum;$k++)
	{
		$getBidderID = 	$getBidderIrow[$k]['BidderID'];
		$getListBID[] = $getBidderID;
	}
	$getListBidderID = implode(",", $getListBID);
	$getMsgSql = "select to_email, cc_email from web_services_notifications where WSID='".$WSID."' and to_email!='' and status=1";
	list($checkNum,$myrowWS)=MainselectfuncNew($getMsgSql,$array = array());
	echo "<br> checkNum - ".$checkNum."<br>";
	if($checkNum>0)
	{
		$to_email = $myrowWS[0]['to_email'];
		$cc_email = $myrowWS[0]['cc_email'];
	}
	else
	{
		$to_email = default_to_email;
		$cc_email = default_cc_email;
	}

	
 	$getLeadsSql = "select count(*) as feedbackCount, feedback, actual_feedback, DATE(allocation_date) as dDtate from web_services_error_log left join web_services on web_services_error_log.WSID=web_services.ID where WSID='".$WSID."' and (Dated between '".$min_date."' and '".$max_date."') group by feedback, DATE(allocation_date) order by DATE(allocation_date) asc ";
echo $getLeadsSql;
echo "<br>";
	list($getLeadsNum, $getLeadsrow) = MainselectfuncNew($getLeadsSql,$array = array());
	
	$content.="<table cellpadding='0' cellspacing='0'><tr><td>";
	$content.="<table width='550' cellspacing='0' cellpadding='0' border='1'>";
	$content.="<tr><td  height='29' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;font-weight:bold; color:#FFFFFF;background-color: #FCAA00;' >Date - ".$TodayDt." -  ".$WSName." (".$WSID.")</td><td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;font-weight:bold; color:#FFFFFF;background-color: #FCAA00;' align='center'>Count of Leads</td></tr>";	
	
		$totalCount[] = 0;
	//	$template .= "<tr><td>Feedback</td><td>Actual Feedback</td><td>Count</td></tr>";		
		for($i=0;$i<$getLeadsNum;$i++)
		{
			$feedbackCount =  $getLeadsrow[$i]['feedbackCount'];
			$feedback =  $getLeadsrow[$i]['feedback'];
			$actual_feedback =  $getLeadsrow[$i]['actual_feedback'];
			$dDtate =  convertDt($getLeadsrow[$i]['dDtate']);
		//	$dDtate = '';
			echo "<br>Feedback  - ".$feedback.", ".$feedbackCount;
			echo "<br>";
			
			$getConstantsSql = "select name, value from web_services_default_values where value='".$feedback."'";
			
			list($checkmyrowWSNum,$myrowWS)=MainselectfuncNew($getConstantsSql,$array = array());
			echo $getConstantsSql.", ".$checkmyrowWSNum;
			echo "<br>";
			$feedbackvalue = $myrowWS[0]['value'];
			$feedbackname = $myrowWS[0]['name'];

			if($i%2==0)
			{	
				$bgcolor = "#CCCCCC";	
			}
			else
			{
				$bgcolor = "#FFFFFF";
			}
			
			
		//$template = "<tr><td>".$feedbackname."</td><td>".$actual_feedback."</td><td>".$feedbackCount."</td></tr>";
			$content.="<tr bgcolor='".$bgcolor."'><td height='25' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;font-weight:bold; color:#1F68B2;' >( ".$dDtate." ) ".$feedback."</td><td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;font-weight:bold; color:#1F68B2;' align='center'>".$feedbackCount."</td></tr>";
			$totalCount[] = $feedbackCount;
		}
		
		$totalCountSum = array_sum($totalCount);
		$totalCount = '';
		
			$search_query = "select * from ".$table_name." left join ".$allotation_table_name." on ".$table_name.".RequestID=".$allotation_table_name.".AllRequestID  where  (".$allotation_table_name.".BidderID in (".$getListBidderID.") and (".$allotation_table_name.".Allocation_Date between '".$min_date."' and '".$max_date."')) ";
			list($recorcount,$search_queryWS)=MainselectfuncNew($search_query,$array = array());
		echo "<br>".$search_query."<br>";
		
		
		if($totalCountSum==$recorcount) { $clrCode = "color:#1F68B2;"; } else { $clrCode = "color:#d90606;"; }
	
	$getCountSql = "select count(*) as feedback_Count, DATE(allocation_date) as dt   from web_services_error_log left join web_services on web_services_error_log.WSID=web_services.ID where WSID='".$WSID."' and (Dated between '".$min_date."' and '".$max_date."') group by DATE(allocation_date) order by DATE(allocation_date) asc";
	list($recordcount,$getCountWS)=MainselectfuncNew($getCountSql, $array = array());
	for($k=0;$k<$recordcount;$k++)
	{	
		$feedback_Count =  $getCountWS[$k]['feedback_Count'];
		$dt =  $getCountWS[$k]['dt'];
		if($feedback_Count==$recorcount && $recordcount!=$k) { $clrCode = "color:#1F68B2;"; } else { //$clrCode = "color:#d90606;"; 
		$clrCode = "color:#1F68B2;";
		}
		$content.="<tr bgcolor='#FFFFCC'><td height='25' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;font-weight:bold; color:#000;' >( ".convertDt($dt)." ) Total leads proccessed</td><td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;font-weight:bold; ".$clrCode."' align='center'>".$feedback_Count."</td></tr>";
	
	}
	
		
		$content.="<tr bgcolor='#FFFFCC'><td height='25' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;font-weight:bold; color:#1F68B2;' >( ".convertDt($dt)." ) Total leads allocated</td><td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;font-weight:bold; ".$clrCode."' align='center'>".$recorcount."</td></tr>";
		//echo $totalCountSum;
		$content.="</table>";
		$Toemailid = $to_email;
		$CCemailid = $cc_email;
		
	//	$Toemailid = "upendra@deal4loans.com";
	echo "<br>******************************************<br>";
		echo $Toemailid."<br>";
		echo $CCemailid."<br>";
		echo $content;
	echo "<br>******************************************<br>";		
		$SubjectLine = "Deal4loans - Webservice ".$WSName." (".$WSID.") Daily Report for ".$TodayDt;
		$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
			$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= "Cc:".$CCemailid.""."\n";
		mail($Toemailid,$SubjectLine, $content, $headers);

$getListBidderID = '';
$$feedbackname = '';

}


?>