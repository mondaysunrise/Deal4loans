<?php
require 'scripts/db_init.php';
require 'errorLogReporting.php';
$Dated = ExactServerdate();
$errorLogReporting = new errorLogReporting();
$getNotificationSql = "select * from web_services_default_values where value!=1 and status=1";
list($checkgeNotificationNum, $getNotificationrow) = MainselectfuncNew($getNotificationSql,$array = array());
//echo $checkgeNotificationNum."<br>";
//print_r($getNotificationrow);
echo $Dated;
echo "<br>";
for($j=0;$j<$checkgeNotificationNum;$j++)
{
	//$feedback =  $getNotificationrow[$j]['value'];
	$feedback =  $getNotificationrow[$j]['name'];
	$turnaroundtime =  $getNotificationrow[$j]['turnaroundtime'];
	$lastHourTS = time() - (60 * $turnaroundtime);
	$lastHour = date('Y-m-d H:i:s', $lastHourTS);
	echo "<br>";
	echo "Feedback - ".$feedback.", ".$turnaroundtime;
	echo "<br>";
	echo $getWSDetailSql = "select * from web_services_error_log left join web_services on web_services_error_log.WSID=web_services.ID where Status=1 and Dated>'".$lastHour."' and feedback='".$feedback."' group by feedback, web_services.ID";
	echo "<br>";
	list($checkgetWSDetailNum,$getWSDetailrow)=MainselectfuncNew($getWSDetailSql,$array = array());
	
	for($i=0;$i<$checkgetWSDetailNum;$i++)
	{
		$webServiceID =  $getWSDetailrow[$i]['ID'];
		$feedback =  $getWSDetailrow[$i]['feedback'];
		$actual_feedback =  $getWSDetailrow[$i]['actual_feedback'];
		$BidderID =  $getWSDetailrow[$i]['BidderID'];
		$RequestID =  $getWSDetailrow[$i]['RequestID'];
		$Client_Name =  $getWSDetailrow[$i]['Client_Name'];
		
		echo "<br>".$webServiceID.", ".$feedback.", ". $actual_feedback.", ". $RequestID.", ". $lastHour.", ". $Client_Name.", ". $BidderID."<br>";
	
		$errorLogReporting->sendMail($webServiceID,$feedback, $actual_feedback, $RequestID, $lastHour, $Client_Name, $BidderID);
		$errorLogReporting->sendSms ($webServiceID,$feedback, $actual_feedback, $RequestID, $lastHour, $Client_Name, $BidderID);
		
	}
}
?>