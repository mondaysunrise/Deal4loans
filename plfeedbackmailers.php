<?php
	$customerSql = "select * from Req_Loan_Personal where RequestID='".$lead_id."'";
	list($NumRows,$customerQuery)=MainselectfuncNew($customerSql,$array = array());
	$Name = $customerQuery[0]['Name'];
	$Number = $customerQuery[0]['Mobile_Number'];
	$Company = $customerQuery[0]['Company_Name'];
	$Email = $customerQuery[0]['Email'];
	
	
	$bidderSql = "select * from Bidders where BidderID = '".$bidder_id."'";
	list($NumRows,$customerQuery)=MainselectfuncNew($customerSql,$array = array());
	$EmailBidder = $bidderQuery[0]['FeedbackMailID'];
	$Define_PrePost = $bidderQuery[0]['Define_PrePost'];
	
	$getBiddersSql = "select * from Req_Feedback_Bidder1 where  Reply_Type = 1 and AllRequestID='".$lead_id."' and BidderID='".$bidder_id."'";
	list($NumRows,$customerQuery)=MainselectfuncNew($customerSql,$array = array());
	 $Allocation_Date = $getBiddersQuery[0]['Allocation_Date'];
	 
if($feedback=="Esclation")
{
	if($Define_PrePost=="PostPaid")
	{
		$mailer = "<table width='560' border='0' align='center' cellpadding='0' cellspacing='0'><tr><td width='560' height='101' align='center' valign='top'><img src='http://www.deal4loans.com/images/mlr-hdr.jpg' width='560' height='101' /></td></tr><tr><td><table width='560' border='0' align='center' cellpadding='0' cellspacing='0'><tr><td width='1' bgcolor='#7cabda'><img src='http://www.deal4loans.com/images/spacer.gif' width='1'  height='1' border='0' /></td><td valign='top'><table width='98%' border='0' align='center' cellpadding='0' cellspacing='0'><tr><td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '><p><br />Through our internal customer feedback process  Mr. ".$Name." has shared their feedback with us. He/she hasn&rsquo;t received any  call from your representative. Kindly contact the customer immediately<br><b>His Profile</b></p><ul>
	<li>Name : ".$Name."</li> 
	<li>Contact Number : ".$Number."</li> 	
	<li>Company name : ".$Company."</li>	
	<li>DOE : ".$Allocation_Date."</li>
	</ul><b>Regards</b> <br />Team Deal4loans.com<br />Loans by choice not by chance!!<br /><div style='text-align:center;'><a href='http://www.deal4loans.com/Contents_Blogs.php?source=plAM' target='_blank' style='color:#0a4988; text-decoration:underline;'>Blogs</a> | <a href='http://www.deal4loans.com/Contents_Feedback.php?source=plAM' target='_blank' style='color:#0a4988; text-decoration:underline;'>Testimonials</a> | <a href='http://www.deal4loans.com/Loan_Query.php?source=plAM' target='_blank' style='color:#0a4988; text-decoration:underline;'>LoanQueries</a></div></td></tr></table></td><td width='1' bgcolor='#7cabda'><img src='http://www.deal4loans.com/images/spacer.gif' width='1'  height='1' border='0' /></td></tr></table></td></tr><tr><td><img src='http://www.deal4loans.com/images/tp_bl-line.gif' width='560' height='20' /></td></tr></table>";

		$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
		$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'Bcc: balbir.singh@deal4loans.com' . "\r\n";
		
		$SubjectLine = "Follow Up Missing";
		if(strlen($EmailBidder)>0)
		{
		//	mail($EmailBidder, $SubjectLine, $mailer, $headers);
		}
		//SMS
		 $SMSMessage = "";
		$smsSql = "select * from Bidder_Contact_To_Customers where BidderID = '".$bidder_id."' and  Reply_Type=1 and Sms_Flag=1";
		list($sms_numRows,$smsQuery)=MainselectfuncNew($smsSql,$array = array());
		if($sms_numRows>0)
		{
 	  	    $Bank_Name = $smsQuery[0]['Bank_Name'];
		    $Banker_Contact = $smsQuery[0]['Banker_Contact'];
		    $SMSMessage = "Dear ".$Name.", the bank contact as per your request is: ".$Bank_Name.", ".$Banker_Contact.". Team Deal4loans.com";
			if(strlen($Number)==10)
			{
			  // $Numbe = 9971396361;
			 ///  	SendSMS($SMSMessage, $Number);
			}
		}
		
	}
	
}

if($feedback=="Requirement Postponed/Cancelled")
{
	$customerMailer = "<table width='560' border='0' align='center' cellpadding='0' cellspacing='0'><tr><td width='560' height='101' align='center' valign='top'><img src='http://www.deal4loans.com/images/mlr-hdr.jpg' width='560' height='101' /></td></tr><tr><td><table width='560' border='0' align='center' cellpadding='0' cellspacing='0'><tr><td width='1' bgcolor='#7cabda'><img src='http://www.deal4loans.com/images/spacer.gif' width='1'  height='1' border='0' /></td><td valign='top'><table width='98%' border='0' align='center' cellpadding='0' cellspacing='0'><tr><td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '><p><b>Dear $Name</b>,</p><p> Thank you for registering your loan application  on our website and giving us a privilege to serve you. Deal4loans is associated  with all the major players in the market. We can help you in choosing the best  available offer based upon your profile. If your requirement has been postponed  for the time being, then you can get yourself registered on our portal once  again when your requirement crops up in the future.  </p><b>Regards</b> <br />Team Deal4loans.com<br />Loans by choice not by chance!!<br /><div style='text-align:center;'><a href='http://www.deal4loans.com/Contents_Blogs.php?source=plAM' target='_blank' style='color:#0a4988; text-decoration:underline;'>Blogs</a> | <a href='http://www.deal4loans.com/Contents_Feedback.php?source=plAM' target='_blank' style='color:#0a4988; text-decoration:underline;'>Testimonials</a> | <a href='http://www.deal4loans.com/Loan_Query.php?source=plAM' target='_blank' style='color:#0a4988; text-decoration:underline;'>LoanQueries</a></div></td></tr></table></td><td width='1' bgcolor='#7cabda'><img src='http://www.deal4loans.com/images/spacer.gif' width='1'  height='1' border='0' /></td></tr></table></td></tr><tr>    <td><img src='http://www.deal4loans.com/images/tp_bl-line.gif' width='560' height='20' /></td></tr></table>";

	$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
	$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$headers .= 'Bcc: balbir.singh@deal4loans.com' . "\r\n";

	
	$SubjectLine = "Ready To Serve You Today, Tomorrow And Forever";
	//mail($Email, $SubjectLine, $customerMailer, $headers);
}



?>