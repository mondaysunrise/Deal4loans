<?php

	require 'scripts/db_init.php';
	require 'scripts/functions_nw.php';


$ShowDate = date("H:i:s");
$StartTime = "09:00:00";
$EndTime = "18:00:00";	
if($ShowDate > $StartTime && $ShowDate < $EndTime)			
{
			
	$getLastDocSql = "select RequestID from Req_Compaign where Compaign_ID=2647";
	$getLastDocQuery = ExecQuery($getLastDocSql);
	$lastID = mysql_result($getLastDocQuery,0,'RequestID');
	
	$getDocSql = "select * from hdfc_cl_appointments where RequestID>'".$lastID."' and Reply_Type=3";
	//echo "<br>".$getDocSql."<br>";
	$getDocQuery = ExecQuery($getDocSql);
	$numgetDoc = mysql_num_rows($getDocQuery);
	for($jj=0;$jj<$numgetDoc;$jj++)
	{
		
		$id = mysql_result($getDocQuery,$jj,'id');
		$address_apt  = mysql_result($getDocQuery,$jj,'address_apt');
		$RequestID = mysql_result($getDocQuery,$jj,'RequestID');
		$appdate  = mysql_result($getDocQuery,$jj,'appdate');
		$changeapp_time  = mysql_result($getDocQuery,$jj,'changeapp_time');
		$docs = mysql_result($getDocQuery,$jj,'docs');
		$Reply_Type = mysql_result($getDocQuery,$jj,'Reply_Type');
		$time = '';
				if($changeapp_time=="08:00:00")
				{
					$time =  "8(am)-9(am)";
				}	
				else if($changeapp_time=="09:00:00")
				{
					$time =  "9(am)-10(am)";
				}
				else if($changeapp_time=="10:00:00")
				{
					$time =  "10(am)-11(am)";
				}
				else if($changeapp_time=="11:00:00")
				{
					$time =  "11(am)-12(pm)";
				}
				else if($changeapp_time=="12:00:00")
				{
					$time =  "12(pm)-1(pm)";
				}
				else if($changeapp_time=="13:00:00")
				{
					$time =  "1(pm)-2(pm)";
				}
				else if($changeapp_time=="14:00:00")
				{
					$time =  "2(pm)-3(pm)";
				}
				else if($changeapp_time=="15:00:00")
				{
					$time =  "3(pm)-4(pm)";
				}
				else if($changeapp_time=="16:00:00")
				{
					$time =  "4(pm)-5(pm)";
				}
				else if($changeapp_time=="17:00:00")
				{
					$time =  "5(pm)-6(pm)";
				}
				else if($changeapp_time=="18:00:00")
				{
					$time =  "6(pm)-7(pm)";
				}
				else if($changeapp_time=="19:00:00")
				{
					$time =  "7(pm)-8(pm)";
				}
				
			
	
		$getBiddersSql = "select Req_Feedback_Bidder1.AllRequestID as AllRequestID from Req_Feedback_Bidder1 where (Req_Feedback_Bidder1.AllRequestID='".$RequestID."' and Req_Feedback_Bidder1.BidderID=1825 and Req_Feedback_Bidder1.Reply_Type=3)";
		$getBiddersQuery = ExecQuery($getBiddersSql);
		$recordcount = mysql_num_rows($getBiddersQuery);
		//echo "<br>".$getBiddersSql."<br>";	

		if($recordcount>0)
		{
		$getCustomerSql = "select Name,Mobile_Number,City,City_Other FROM Req_Loan_Car where  RequestID = '".$RequestID."' ";
		//echo "<br>".$getCustomerSql."<br>";
		$getCustomerQuery = ExecQuery($getCustomerSql);
		$Name = mysql_result($getCustomerQuery,0,'Name');
		$Mobile_Number = mysql_result($getCustomerQuery,0,'Mobile_Number');
		$City = mysql_result($getCustomerQuery,0,'City');
		if($City=="Others")
		{
			$City = mysql_result($getCustomerQuery,0,'City_Other');
		}
		
				
		$getSmsSql = "SELECT * FROM `Req_Compaign` where (BidderID = '1825' and Sms_Flag=1 and City_Wise like '%".$City."%' )";	
		$getSmsQuery = ExecQuery($getSmsSql);
	$Mobile_no = mysql_result($getSmsQuery,0,'Mobile_no');
			//echo "<br><br>".$Mobile_no."<br><br>";		
		//echo "<br>".$getSmsSql;
		
		if(strlen($address_apt)>0)
		{
			$Msg = "Appointment Fixed: ".$Name.",".$Mobile_Number.",".$City.",".$address_apt.",".$appdate.",".$time; 
			//echo "<br><br>".$Msg;
			//$Mobile_nonew=9811215138;
			if(strlen(trim($Mobile_no)) > 0)
			{
				
				SendSMSforLMS($Msg, $Mobile_no);
	
	//SendSMSforLMS($Msg, $Mobile_nonew);
				
			}
		}
				
		$updateleadSql = "update Req_Compaign set RequestID='".$RequestID."' where Compaign_ID=2647";
		$updateleadQuery = ExecQuery($updateleadSql);
		echo $updateleadSql."<br>";
	}
	}

}
else
{
	echo "Time Out";
}

?>