<?php
require 'scripts/db_init.php';
require 'scripts/functions.php';

mailersPP();

function mailersPP()
{
	$today= date('Y-m-d');
	$min_date=$today." 00:00:00";
	$max_date=$today." 23:59:59";
	$sqlC = "select RequestID from Req_Compaign where Compaign_ID=1712";
	list($queryCount,$queryC)=MainselectfuncNew($sqlC,$array = array());
	$lastID = $queryC[0]['RequestID'];
	$lastID = 51;
echo	$getBidSql = "SELECT * FROM Req_Loan_Personal left join upload_documents on upload_documents.RequestID = Req_Loan_Personal.RequestID and upload_documents.BidderID>0 and upload_documents.status!='send' where (upload_documents.BidderID>0 and upload_documents.status!='send' and  (Req_Loan_Personal.Updated_Date Between '".($min_date)."' and '".($max_date)."' ) and upload_documents.DocID>'".$lastID."')";
	list($numgetBidSql,$getBidQuery)=MainselectfuncNew($getBidSql,$array = array());
	for($i=0;$i<$numgetBidSql;$i++)
	{
		
	}
	
}

function mailers()
{
	$today= date('Y-m-d');
	$min_date=$today." 00:00:00";
	$max_date=$today." 23:59:59";
echo	$sqlC = "select RequestID from Req_Compaign where Compaign_ID=1712";
	list($queryCount,$queryC)=MainselectfuncNew($sqlC,$array = array());
		$lastID = $queryC[0]['RequestID'];

	echo "<br>";
echo 	$sqlF = "select RequestID from Req_Feedback_Bidder1 where Feedback_ID ='".$lastID."'";
		list($numgetBid,$queryF)=MainselectfuncNew($sqlF,$array = array());
	$lastID_F = $queryF[0]['AllRequestID'];
		echo "<br>";
	echo $getIDSql = "select * from Req_Loan_Personal left join upload_documents on  upload_documents.RequestID=Req_Loan_Personal.RequestID and Req_Loan_Personal.RequestID>'".$lastID."' where Req_Loan_Personal.RequestID>'".$lastID."' and Req_Loan_Personal.Net_Salary>='240000' and Req_Loan_Personal.Allocated='1' and Req_Loan_Personal.Bidder_Count='1' and Req_Loan_Personal.upload_flag=1 and (Req_Loan_Personal.Updated_Date Between '".($min_date)."' and '".($max_date)."' ) ";
			list($getID_numRows,$getIDQuery)=MainselectfuncNew($getIDSql,$array = array());
		for($i=0;$i<$getID_numRows;$i++)
		{
			$getBidderNum = '';

			$getBidderSql = "select Req_Feedback_Bidder1.BidderID as BidderID, Req_Feedback_Bidder1.Feedback_ID as Feedback_ID  from Req_Feedback_Bidder1 left join Bidders on Req_Feedback_Bidder1.BidderID = Bidders.BidderID  where Req_Feedback_Bidder1.AllRequestID='".$RequestID."' and Req_Feedback_Bidder1.Reply_Type='1' and Bidders.Define_PrePost='PostPaid'";
			list($getBidderNum,$getBidderQuery)=MainselectfuncNew($getBidderSql,$array = array());
			if($getBidderNum>0)
			{
				$bid_id = $getBidderQuery[0]['BidderID'];
				$Feedback_ID = $getBidderQuery[0]['Feedback_ID'];
				$RequestID = $getIDQuery[$i]['RequestID'];
				$Name = $getIDQuery[$i]['Name'];
				$City = $getIDQuery[$i]['City'];
				
				sendMailer($RequestID,$Name,$Mobile,$City,$bid_id);		
				
			}
			
			
		}
		if($Feedback_ID>0)
		{
			$DataArray = array("RequestID"=>$Feedback_ID);
			$wherecondition ="(Compaign_ID=1712)";
			Mainupdatefunc ('Req_Compaign', $DataArray, $wherecondition);
			echo "<br>".$updateleadSql;
		}
}



function sendMailer($RequestID,$Name,$Mobile,$City,$BidderID)
{
	$getBidderSql = "select FeedbackMailID,BD_Name from Bidders where BidderID = '".$BidderID."'";
	list($getBidderNum,$getBidderQuery)=MainselectfuncNew($getBidderSql,$array = array());
	$FeedbackMailID = $getBidderQuery[0]['FeedbackMailID'];
	$BD_Name = $getBidderQuery[0]['BD_Name'];
	
	$sql = "select * from upload_documents where RequestID='".$RequestID."' and status!='send'";
	list($numRows,$query)=MainselectfuncNew($sql,$array = array());
	if($numRows>0)
	{
	$Appointment_Letter = $query[0]['Appointment_Letter'];
	$Form16  = $query[0]['Form16'];
	$Salary_Slip = $query[0]['Salary_Slip'];
	$Bank_Statement  = $query[0]['Bank_Statement'];
	$Pancard  = $query[0]['Pancard'];
	$Voterid = $query[0]['Voterid'];
	$Passport = $query[0]['Passport'];
	$Driving_License  = $query[0]['Driving_License'];
	$Photo = $query[0]['Photo'];
	$LIC_Policy = $query[0]['LIC_Policy'];
	$Telephone_Bill = $query[0]['Telephone_Bill'];
	$Electricity_Bill  = $query[0]['Electricity_Bill'];
	$Loan_Track  = $query[0]['Loan_Track'];
	$CC_Photocopy = $query[0]['CC_Photocopy'];

	//$Name = "Upendra Kumar";
	//$Mobile = 9971396361;
	//$City = "Delhi";
	
	$message = "<table width='560' border='0' align='center' cellpadding='0' cellspacing='0'>
	  <tr>
		<td height='101' align='center' valign='top'><img src='http://www.deal4loans.com/images/mlr-hdr.jpg' width='560' height='101' /></td>
	  </tr>
	  <tr>
		<td width='560'><table width='560' border='0' align='center' cellpadding='0' cellspacing='0'>
		  <tr>
			<td width='1' bgcolor='#7cabda'><img src='http://www.deal4loans.com/images/spacer.gif' width='1'  height='1' border='0' /></td>
			<td><table width='98%' border='0' align='center' cellpadding='0' cellspacing='0'>
			  <tr><td align='left'>
	<table width='88%' border='0' align='center' cellpadding='3' cellspacing='2'>
	<tr><td width='100%' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; ' colspan='2'><hr></td></tr>
	<tr><td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '><strong>Sir,</strong></td>
	<td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '>&nbsp;</td></tr>
	<tr>
	  <td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#061c33; line-height:18px; font-weight:bold;' colspan='2'>Please login your account to download the following list of documents of ".$Name." :</td>
	</tr>";
	$message .= "<tr><td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; ' colspan='2'>";
	if(strlen($Appointment_Letter)>0)
	{
	//	$message .= "<tr><td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; ' colspan='2'>Download <a href='http://www.deal4loans.com/upload/".$Appointment_Letter."' target='_blank'>Appointment Letter</a></td></tr>";
	$message .= "Appointment Letter<br>";
	}  
	 
	if(strlen($Form16)>0)
	{
		//$message .= "<tr><td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; ' colspan='2'>Download <a href='http://www.deal4loans.com/upload/".$Form16."' target='_blank'>Form 16</a></td></tr>";
		$message .= "Form 16<br>";
	}
	
	if(strlen($Salary_Slip)>0)
	{
		//$message .= "<tr><td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; ' colspan='2'>Download <a href='http://www.deal4loans.com/upload/".$Salary_Slip."' target='_blank'>3 Months Salary Slip</a></td></tr>";
		$message .= "3 Months Salary Slip<br>";
	}
	
	if(strlen($Bank_Statement)>0)
	{
		//$message .= "<tr><td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; ' colspan='2'>Download <a href='http://www.deal4loans.com/upload/".$Bank_Statement."' target='_blank'>3 Months Bank Statement</a></td></tr>";
		$message .= "3 Months Bank Statement<br>";
	}
	
	if(strlen($Pancard)>0)
	{
	//	$message .= "<tr><td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; ' colspan='2'>Download <a href='http://www.deal4loans.com/upload/".$Pancard."' target='_blank'>Pancard</a></td></tr>";
		$message .= "Pancard<br>";
	}
	
	if(strlen($Voterid)>0)
	{
		//$message .= "<tr><td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; ' colspan='2'>Download <a href='http://www.deal4loans.com/upload/".$Voterid."' target='_blank'>Voter id</a></td></tr>";
		$message .= "Voter ID<br>";
	}
	
	if(strlen($Passport)>0)
	{
		//$message .= "<tr><td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; ' colspan='2'>Download <a href='http://www.deal4loans.com/upload/".$Passport."' target='_blank'>Passport</a></td></tr>";
		$message .= "Passport<br>";
	}
	
	if(strlen($Driving_License)>0)
	{
		//$message .= "<tr><td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; ' colspan='2'>Download <a href='http://www.deal4loans.com/upload/".$Driving_License."' target='_blank'>Driving License</a></td></tr>";
		$message .= "Driving Licence<br>";
	}
	
	if(strlen($Photo)>0)
	{
		//$message .= "<tr><td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; ' colspan='2'>Download <a href='http://www.deal4loans.com/upload/".$Photo."' target='_blank'>Photo</a></td></tr>";
		$message .= "Photo<br>";
	}
	
	if(strlen($LIC_Policy)>0)
	{
		//$message .= "<tr><td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; ' colspan='2'>Download <a href='http://www.deal4loans.com/upload/".$LIC_Policy."' target='_blank'>LIC Policy</a></td></tr>";
		$message .= "LIC Policy<br>";
	}
	
	if(strlen($Telephone_Bill)>0)
	{
		//$message .= "<tr><td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; ' colspan='2'>Download <a href='http://www.deal4loans.com/upload/".$Telephone_Bill."' target='_blank'>Telephone Bill</a></td></tr>";
		$message .= "Telephone Bill<br>";
	}
	
	if(strlen($Electricity_Bill)>0)
	{
		//$message .= "<tr><td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; ' colspan='2'>Download <a href='http://www.deal4loans.com/upload/".$Electricity_Bill."' target='_blank'>Electricity Bill</a></td></tr>";
		$message .= "Electricity Bill<br>";
	}
	
	if(strlen($Loan_Track)>0)
	{
		//$message .= "<tr><td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; ' colspan='2'>Download <a href='http://www.deal4loans.com/upload/".$Loan_Track."' target='_blank'>Loan Track</a></td></tr>";
		$message .= "Loan Track<br>";
	}
	
	if(strlen($CC_Photocopy)>0)
	{
		//$message .= "<tr><td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; ' colspan='2'>Download <a href='http://www.deal4loans.com/upload/".$CC_Photocopy."' target='_blank'>Credit Card Photocopy</a></td></tr>";
		$message .= "Credit Card Photocopy<br>";
	}
	$message .= "</td></tr>";
	$message .= "<tr><td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; ' colspan='2'><hr></td></tr>
	</table> 
	</td>
	</tr>
	<tr><td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '>
	<b>Regards</b> <br />
	Team Deal4loans.com<br />
	Loans by choice not by chance!!<br />
	</td>
			  </tr>
			  </table></td>
			<td width='1' bgcolor='#7cabda'><img src='http://www.deal4loans.com/images/spacer.gif' width='1'  height='1' border='0' /></td>
		  </tr>
		</table></td>
	  </tr>
	  <tr>    <td><img src='http://www.deal4loans.com/images/tp_bl-line.gif' width='560' height='20' /></td>
	
	  </tr>
	</table>";
	echo $message;
	
				$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
				$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				
				if($BD_Name=="Shuaib")
				{
			
				}
				else if($BD_Name=="Balbir")
				{
					
				}
				else
				{
					
				}
				
				$SubjectLine = "Documents  Deal4loans.com";
		
				$DataArray = array("status"=>'send');
			$wherecondition ="(RequestID='".$RequestID."')";
			Mainupdatefunc ('upload_documents', $DataArray, $wherecondition);
	}
}

?>