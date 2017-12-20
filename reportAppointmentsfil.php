<?php
	require 'scripts/db_init.php';
	require 'scripts/functions_nw.php';

$mkDate = mktime(0, 0, 0, date("m")  , date("d")-1, date("Y"));;

$startDate = date("Y-m-d", $mkDate)." 00:00:00";

$endDate = date("Y-m-d", $mkDate)." 23:59:59";



		$getBidders_Sql = "select Bidders_List.BidderID as BidderID from Bidders_List where Bidders_List.BankID='17' and Bidders_List.Reply_Type='1' and Bidders_List.Restrict_Bidder='1' ";
		$getBidders_Query = ExecQuery($getBidders_Sql);
		$numR = mysql_num_rows($getBidders_Query);
		$Bid = "";
		for($j=0;$j<$numR;$j++)
		{
			$BidderID = mysql_result($getBidders_Query,$j,'BidderID');
			$Bid[] = $BidderID;
		}
		
		$bidderStr = implode(",",$Bid);


	
	$getDocSql = "select * from fil_appointments left join Req_Feedback_Bidder1 on Req_Feedback_Bidder1.AllRequestID = fil_appointments.RequestID where (Req_Feedback_Bidder1.Allocation_Date between '".$startDate."' and '".$endDate."') and Req_Feedback_Bidder1.BidderID in (".$bidderStr.") group by fil_appointments.RequestID";

//	$getDocSql = "select * from fil_appointments where 	Dated between '".$startDate."' and '".$endDate."' group by RequestID";
	$getDocQuery = ExecQuery($getDocSql);
//	echo $getDocSql."<br>";
	$numgetDoc = mysql_num_rows($getDocQuery);
	$Content .='<table width="720" cellpadding="0" cellspacing="0" align="center" border="1">';
	$Content .='<tr><td colspan="6" bgcolor="pink" align="center"><b> Appointments </b></td></tr>';
	$Content .='<tr>';
	$Content .='<td class="head1" align="center"><b>BidderID</b></td>';
	$Content .='<td class="head1" align="center"><b>Bidder Name</b></td>';
	$Content .='<td class="head1" align="center"><b>Customer Name</b></td>';
	$Content .='<td class="head1" align="center"><b>City</b></td>';
	$Content .='<td class="head1" align="center"><b>Address</b></td>';
	$Content .='<td class="head1" align="center"><b>Time</b></td>';
//	$Content .='<td class="head1" align="center"><b>Docs</b></td>';	
	$Content .='</tr>';
		

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
		//echo "<br>".$getBiddersSql."<br>";	
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
		$BidderName = mysql_result($getBidderQuery,0,'Bidder_Name');
	
		$Content .='<tr>';
		$Content .='<td class="head1" align="center">'.$BidderID.'&nbsp;</td>';
		$Content .='<td class="head1" align="center">'.$BidderName.'&nbsp;</td>';
		$Content .='<td class="head1" align="center">'.$Name.'&nbsp;</td>';
		$Content .='<td class="head1" align="center">'.$City.'&nbsp;</td>';
		$Content .='<td class="head1" align="center">'.$address_apt.'&nbsp;</td>';
		$Content .='<td class="head1" align="center">'.$appdate.' - '.$time.'&nbsp;</td>';
	//	$Content .='<td class="head1" align="center">'.$docs.'</td>';		
		$Content .='</tr>';
			
		
	}
	$Content .='</table>';
echo 	$Content;

$Email="h.shuaib@gmail.com,balbirsingh499@gmail.com";

$headers = "From: deal4loans <no-reply@deal4loans.com>";
//$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";
		 $semi_rand = md5( time() ); 
        $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 
         $headers .= "\nMIME-Version: 1.0\n" . 
                    "Content-Type: multipart/mixed;\n" . 
                    " boundary=\"{$mime_boundary}\""."\n";
		
	    $message = "This is a multi-part message in MIME format.\n\n" . 
                "--{$mime_boundary}\n" . 
                "Content-Type: text/html; charset=\"iso-8859-1\"\n" . 
                "Content-Transfer-Encoding: 7bit\n\n" . 
                $Content . "\n\n";

/*$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors

$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";*/
mail($Email,'Appointments Leads - Deal4loans', $message, $headers);

//reportAppointmentsfil.php
///usr/bin/php /var/www/vhosts/deal4loans.com/httpdocs/reportAppointmentsfil.php
?>