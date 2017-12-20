<?php
	require 'scripts/db_init.php';
	require 'scripts/functions.php';

$mkDate = mktime(0, 0, 0, date("m")  , date("d")-1, date("Y"));;

$startDate = date("Y-m-d", $mkDate)." 00:00:00";

$endDate = date("Y-m-d", $mkDate)." 23:59:59";

	$getDocSql = "select * from fil_appointments where 	Dated between '".$startDate."' and '".$endDate."' group by RequestID";
    list($numgetDoc,$getDocQuery)=MainselectfuncNew($getDocSql,$array = array());
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
		
		$id = $getDocQuery[$jj]['id'];
		$address_apt  = $getDocQuery[$jj]['address_apt'];
		$RequestID = $getDocQuery[$jj]['RequestID'];
		$appdate  = $getDocQuery[$jj]['appdate'];
		$changeapp_time  = $getDocQuery[$jj]['changeapp_time'];
		$docs = $getDocQuery[$jj]['docs'];
		$Reply_Type = $getDocQuery[$jj]['Reply_Type'];
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
	    list($numBidders,$getBiddersQuery)=MainselectfuncNew($getBiddersSql,$array = array());
		//echo "<br>".$getBiddersSql."<br>";	
		$BidderID = $getBiddersQuery[0]['BidderID'];
		//echo "<br>".$BidderID;
		$getCustomerSql = "select * FROM Req_Loan_Personal where  RequestID = '".$RequestID."' ";
		list($numCustomer,$getCustomerQuery)=MainselectfuncNew($getCustomerSql,$array = array());
		$Name = $getCustomerQuery[0]['Name'];
		$Mobile_Number = $getCustomerQuery[0]['Mobile_Number'];
		$City = $getCustomerQuery[0]['City'];
		if($City=="Others")
		{
			$City = $getCustomerQuery[0]['City_Other'];
		}
		
		$getBidderSql = "select * FROM Bidders where  BidderID = '".$BidderID."' ";
		list($numBidders,$getBiddersQuery)=MainselectfuncNew($getBiddersSql,$array = array());
		$BidderName = $getBidderQuery[0]['Bidder_Name'];
	
		$Content .='<tr>';
		$Content .='<td class="head1" align="center">'.$BidderID.'&nbsp;</td>';
		$Content .='<td class="head1" align="center">'.$BidderName.'&nbsp;</td>';
		$Content .='<td class="head1" align="center">'.$Name.'<br>'.$Mobile_Number.'&nbsp;</td>';
		$Content .='<td class="head1" align="center">'.$City.'&nbsp;</td>';
		$Content .='<td class="head1" align="center">'.$address_apt.'&nbsp;</td>';
		$Content .='<td class="head1" align="center">'.$appdate.' - '.$time.'&nbsp;</td>';
	//	$Content .='<td class="head1" align="center">'.$docs.'</td>';		
		$Content .='</tr>';
			
		
	}
	$Content .='</table>';
echo 	$Content;

$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
//mail($Email,'Appointments Leads - Deal4loans', $Content, $headers);

//reportAppointmentsfil.php
///usr/bin/php /var/www/vhosts/deal4loans.com/httpdocs/reportAppointmentsfil.php
?>