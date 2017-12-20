<?php
require 'scripts/db_init.php';
require 'scripts/functions.php';
//error_reporting(0);

	$lead_id =$_REQUEST['lead_id'];
	$feedback =$_REQUEST['feedback'];
	$FollowupDate =$_REQUEST['FollowupDate'];
	$bidder_id = $_REQUEST['bidder_id'];
	$i = $_REQUEST['i'];
	$doa =$_REQUEST['doa'];
	$toa =$_REQUEST['toa'];
	$address = $_REQUEST['address'];
	
	$bidderSql = "select * from Bidders where BidderID = '".$bidder_id."'";
	list($totalbidder,$bidderQuery)=MainselectfuncNew($bidderSql,$array = array());
	
	$BidderEmailID = $bidderQuery[0]['BidderEmailID'];

	$customerSql = "select * from Req_Loan_Personal where RequestID='".$lead_id."'";
	list($totalcustomerQuery,$customerQuery)=MainselectfuncNew($customerSql,$array = array());
	$Name = $customerQuery[0]['Name'];
	$Number = $customerQuery[0]['Mobile_Number'];
	$Company = $customerQuery[0]['Company_Name'];
	$City = $customerQuery[0]['City'];
	
	$customerMailer = "<table width='560' border='0' align='center' cellpadding='0' cellspacing='0'><tr><td width='560' height='101' align='center' valign='top'><img src='http://www.deal4loans.com/images/mlr-hdr.jpg' width='560' height='101' /></td></tr><tr><td><table width='560' border='0' align='center' cellpadding='0' cellspacing='0'><tr><td width='1' bgcolor='#7cabda'><img src='http://www.deal4loans.com/images/spacer.gif' width='1'  height='1' border='0' /></td><td valign='top'><table width='98%' border='0' align='center' cellpadding='0' cellspacing='0'><tr><td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '><p><b>Dear Banker </b>,<br>Appointment Details  </p>
  <p>Customer Name: ".$Name."<br>
Mobile No.: ".$Number."<br>
DOA: ".$doa."<br>
Time: ".$toa."<br>
Address: ".$address."</p>
<b>Regards</b> <br />Team Deal4loans.com<br />Loans by choice not by chance!!<br /><div style='text-align:center;'><a href='http://www.deal4loans.com/Contents_Blogs.php?source=plAM' target='_blank' style='color:#0a4988; text-decoration:underline;'>Blogs</a> | <a href='http://www.deal4loans.com/Contents_Feedback.php?source=plAM' target='_blank' style='color:#0a4988; text-decoration:underline;'>Testimonials</a> | <a href='http://www.deal4loans.com/Loan_Query.php?source=plAM' target='_blank' style='color:#0a4988; text-decoration:underline;'>LoanQueries</a></div></td></tr></table></td><td width='1' bgcolor='#7cabda'><img src='http://www.deal4loans.com/images/spacer.gif' width='1'  height='1' border='0' /></td></tr></table></td></tr><tr>    <td><img src='http://www.deal4loans.com/images/tp_bl-line.gif' width='560' height='20' /></td></tr></table>>";

	$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
	$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$EmailBidder = "balbir.singh@deal4loans.com";
	$SubjectLine = "Appointment Generated";
//	mail($EmailBidder, $SubjectLine, $customerMailer, $headers);
	
	$retrieve_query="select Allocation_Date from Req_Feedback_Bidder1 where AllRequestID=".$lead_id." and Reply_Type=1";
//echo $retrieve_query."<br>";
	list($totalretrieve_result,$retrieve_result)=MainselectfuncNew($retrieve_query,$array = array());
	$lead_date = $retrieve_result[0]['Allocation_Date'];

 $SMSMessage = "";
		$smsSql = "select * from Req_Compaign where BidderID = '".$bidder_id."' and  Reply_Type=1 and Sms_Flag=1";
		list($sms_numRows,$smsQuery)=MainselectfuncNew($smsSql,$array = array());
	//	$sms_numRows = 1;
		if($sms_numRows>0)
		{
 	  	    $Bank_Name = $smsQuery[0]['Bank_Name'];
		    $Banker_Contact = $smsQuery[0]['Mobile_no'];
		    $SMSMessage = "Appointment Fixed:".$Name.",".$Number.",cty-".$City.",".$address.", ".$doa.",".$toa."";
			if(strlen($Number)==10)
			{
			   // $Number = $Banker_Contact;
			//	SendSMSforLMS($SMSMessage, $Number);
				$Number = 9971396361;	
				SendSMSforLMS($SMSMessage, $Number);
			}
		}
			
	$checkSql = "select * from pl_feedback where lead_id='".$lead_id."' and bidder_id = '".$bidder_id."'";
	list($numRows,$checkQuery)=MainselectfuncNew($checkSql,$array = array());
	$Dated = ExactServerdate();
	if($numRows>0)
	{
	//update
		$dataUpdate = array('feedback'=>$feedback, 'doa'=>$doa, 'toa'=>$toa, 'address'=>$address, 'update_date'=>$Dated);
		$wherecondition ="(lead_id='".$lead_id."' and bidder_id = '".$bidder_id."')";
		Mainupdatefunc ('pl_feedback', $dataUpdate, $wherecondition);
	}
	else
	{
		$dataInsert = array('lead_id'=>$lead_id, 'bidder_id'=>$bidder_id, 'feedback'=>$feedback, 'dated'=>$Dated, 'lead_date'=>$lead_date, 'doa'=>$doa, 'toa'=>$toa, 'address'=>$address);
		$insert = Maininsertfunc ('pl_feedback', $dataInsert);
	//insert
	}
//		echo $query;
	echo "Feedback Saved";
?>