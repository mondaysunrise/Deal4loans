<?php
require 'scripts/session_check_onlinelms.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';
session_start();

	$bidderid = FixString($_REQUEST["bidderid"]);
	$custid = FixString($_REQUEST["custid"]);
	$estype = FixString($_REQUEST["estype"]);
	
	if($bidderid>0 && $custid>0 && $estype>0)
	{
		$appqry=ExecQuery("Select appt_date,appt_time,special_remarks From smspl_status_details Where AllRequestID=".$custid." and BidderID=".$bidderid);
		$row1=mysql_fetch_array($appqry);
		if($row1["appt_date"]!='0000-00-00 00:00:00')
		{
			$appt_date = "Appointment Date : ".$row1["appt_date"];
		}
		if($row1["appt_time"]!="")
		{
			$appt_time = ", Appointment Time : ".$row1["appt_time"];
		}

		$sendqry=ExecQuery("Select bidder_number, Sendnow_Date From smsapp_leadallocation_log Where RequestID=".$custid." and BidderID=".$bidderid);
		$row2=mysql_fetch_array($sendqry);

		$detqry=ExecQuery("Select Name,Mobile_Number,Company_Name,City,City_Other,Net_Salary From Req_Loan_Personal Where RequestID=".$custid);
		$row3=mysql_fetch_array($detqry);

		$mapqry=ExecQuery("Select rm_name,rm_emailid,bank_name From smspl_mapping_bidderlms Where (bank_consiolidated_id=".$bidderid." or (bank_individual_id like '%".$bidderid."%'))");
		$row4=mysql_fetch_array($mapqry);
		$email = $row4["rm_emailid"];
	
	$Message="";
	$Message.='<table cellpadding="0" cellspacing="0" width="600">
		<tr>
				<td colspan="2">Dear '.$row4["rm_name"].',<br /></td></tr>
		<tr>
		<td>
		<table cellpadding="5" cellspacing="0">
		<tr>
				<td colspan="2">Below are the Appointment Details</td></tr>
			<tr>
				<td><b>Customer Name :</b> '.$row3["Name"].'</td>
				<td></td>
			</tr>
			<tr>
				<td><b>Customer Number :</b> '.$row3["Mobile_Number"].'</td>
				<td></td>
			</tr>
			<tr>
				<td><b>Company Name :</b> '.$row3["Company_Name"].'</td>
				<td></td>
			</tr>
			<tr>
				<td><b>City :</b> '.$row3["City"].' ('.$row3["City_Other"].')</td>
				<td></td>
			</tr>
			<tr>
				<td><b>Income :</b> '.$row3["Net_Salary"].'</td>
				<td></td>
			</tr>
			<tr>
				<td><b>Comments :</b> '.$row1["special_remarks"].' '.$appt_date.' '.$appt_time.'</td>
				<td></td>
			</tr>
			<tr>
				<td><b>Send date :</b> '.$row2["Sendnow_Date"].'</td>
				<td></td>
			</tr>
			<tr>
				<td><b>Send To :</b> '.$bidderid.' ('.$row2["bidder_number"].') '.$row4["bank_name"].'</td>
				<td></td>
			</tr>
		</table>
		</td></tr>
		<tr><td colspan="2">&nbsp;</td></tr>
		<tr>
				<td colspan="2">Regards,<br />Parveen Team</td></tr>
		<tr></table>';
	 echo $Message."<br><br>";
		$headers = "From: Parveen <parveen.kumar@deal4loans.com>";
		$semi_rand = md5( time() ); 
		$mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 
		$headers .= "\nMIME-Version: 1.0\n" . 
		"Content-Type: multipart/mixed;\n" . 
		" boundary=\"{$mime_boundary}\""."\n";
		if($estype==1)
		{ 
			$headers .= "Cc: parveen.kumar@deal4loans.com "."\n";	
		 }
		elseif($estype==2)
		{
			$headers .= "Cc: parveen.kumar@deal4loans.com,balbir.singh@deal4loans.com "."\n";	
		}
		elseif($estype==3)
		{
			$headers .= "Cc: parveen.kumar@deal4loans.com,balbir.singh@deal4loans.com,rishi@deal4loans.com "."\n";	
		}
		else
		{
			$headers .= "Cc: parveen.kumar@deal4loans.com "."\n";	
		}
			
		$message = "This is a multi-part message in MIME format.\n\n" . 
		"--{$mime_boundary}\n" . 
		"Content-Type: text/html; charset=\"iso-8859-1\"\n" . 
		"Content-Transfer-Encoding: 7bit\n\n" . 
		$Message . "\n\n";
		
		//$email="ranjana5chauhan@gmail.com";
		mail($email,'PL Appointment Exclusive lead', $message, $headers);

		echo "Mail sent";

	}
	else
	{
		echo "Sorry for Inconvenience";
	}

?>