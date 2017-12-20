<?php

	require 'scripts/db_init.php';
	require 'scripts/functions_nw.php';


$ShowDate = date("H:i:s");
$StartTime = "09:00:00";
$EndTime = "18:00:00";	
if($ShowDate > $StartTime && $ShowDate < $EndTime)			
{
			
	$getLastDocSql = "select RequestID from Req_Compaign where Compaign_ID=1899";
	$getLastDocQuery = ExecQuery($getLastDocSql);
	$lastID = mysql_result($getLastDocQuery,0,'RequestID');
	
	$getDocSql = "select * from fil_appointments where RequestID>'".$lastID."' and Reply_Type=1";
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
				
			
	
		$getBiddersSql = "select Bidders_List.BidderID as BidderID, Req_Feedback_Bidder1.AllRequestID as AllRequestID from Req_Feedback_Bidder1 left join Bidders_List on Bidders_List.BidderID=Req_Feedback_Bidder1.BidderID where Req_Feedback_Bidder1.AllRequestID='".$RequestID."' and Bidders_List.BankID='17' and Req_Feedback_Bidder1.Reply_Type='1'";
		$getBiddersQuery = ExecQuery($getBiddersSql);
		echo "<br>".$getBiddersSql."<br>";	
		$BidderID = mysql_result($getBiddersQuery,0,'BidderID');
		//echo "<br>".$BidderID;
		$getCustomerSql = "select * FROM Req_Loan_Personal where  RequestID = '".$RequestID."' ";
		$getCustomerQuery = ExecQuery($getCustomerSql);
		$Name = mysql_result($getCustomerQuery,0,'Name');
		$Mobile_Number = mysql_result($getCustomerQuery,0,'Mobile_Number');
		$City = mysql_result($getCustomerQuery,0,'City');
		if($City=="Others")
		{
			$City = mysql_result($getCustomerQuery,0,'City_Other');
		}
		
		$getBidderSql = "select * FROM Bidders where  BidderID = '".$BidderID."' ";
		$getBidderQuery = ExecQuery($getBidderSql);
		$BidderName = mysql_result($getBidderQuery,0,'Name');
	
		
		$getSmsSql = "SELECT * FROM `Req_Compaign` where BidderID = '".$BidderID."' and Sms_Flag=1 ";	
		$getSmsQuery = ExecQuery($getSmsSql);
	echo	$Mobile_no = mysql_result($getSmsQuery,0,'Mobile_no');
		
		
		if($BidderID==996 || $BidderID==1000 || $BidderID==1012 || $BidderID==1015 || $BidderID==1050)
		{
			$getSmsSql = "SELECT * FROM `Req_Compaign` where BidderID = '".$BidderID."'";	
			$getSmsQuery = ExecQuery($getSmsSql);
			echo $Mobile_no = mysql_result($getSmsQuery,0,'Mobile_no');
		}
	
		echo "<br>".$getSmsSql;
		
		if(strlen($address_apt)>0)
		{
			$Msg = "Appointment Fixed: FIL lead ".$Name.",".$Mobile_Number.",".$City.",".$address_apt.",".$appdate.",".$time; 
			echo "<br><br>".$Msg;
			if(strlen(trim($Mobile_no)) > 0)
			{
				//$Mobile_no = 9911025470;
				SendSMSforLMS($Msg, $Mobile_no);
//				SendSMSAir2Web($Msg, $Mobile_no);
			//	$testMobile = 9999570210;
				//$testMobile = 9999876067;   
				//SendSMSforLMS($Msg, $testMobile);   
				echo "<br>".$Mobile_no."--".$BidderID ;
			}
		}
				
		$updateleadSql = "update Req_Compaign set RequestID='".$RequestID."' where Compaign_ID=1899";
		$updateleadQuery = ExecQuery($updateleadSql);
		//echo $updateleadSql."<br>";
	}

}
else
{
	echo "Time Out";
}

?>