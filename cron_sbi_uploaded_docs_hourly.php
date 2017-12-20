<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);

require 'scripts/db_init.php';

//Query to get records for all docs uploaded hourly
$getDocsRecordSql = "SELECT sd.RequestID, sd.source_code, GROUP_CONCAT(Distinct(doc_category) SEPARATOR ' | ') as doc_category, GROUP_CONCAT(Distinct(doc_type) SEPARATOR ' | ') as doc_type, GROUP_CONCAT(Distinct(doc_name) SEPARATOR ' | ') as doc_name, GROUP_CONCAT(Distinct(doc_path) SEPARATOR ' | ') as doc_path, scc.LeadRefNumber, scc.ApplicationNumber FROM `sbi_documents` as sd JOIN sbi_credit_card_5633 as scc ON (scc.RequestID = sd.RequestID) WHERE (sd.created_date >= DATE_SUB(NOW(), INTERVAL 1 Hour)) AND scc.ProcessingStatus = 1 GROUP BY sd.RequestID";
$getDocsRecordResult = d4l_ExecQuery($getDocsRecordSql);
while($getDocsRecordRow = d4l_mysql_fetch_assoc($getDocsRecordResult)){
	//$data[] = $getDocsRecordRow;
	$BidderID = '';
	$getBidderEmailSql = "SELECT BidderID, Email, Bidder_Name FROM Bidders WHERE leadidentifier = 'sbidocslms' AND Profile = '".$getDocsRecordRow['source_code']."'";
	$getBidderEmailResult = d4l_ExecQuery($getBidderEmailSql);
	$getBidderEmailResponse = d4l_mysql_fetch_assoc($getBidderEmailResult);
	$BidderEmail = $getBidderEmailResponse['Email'];
	$BidderID = $getBidderEmailResponse['BidderID'];
	$BidderName = $getBidderEmailResponse['Bidder_Name'];
	if(!empty($BidderEmail)){
		//Send Mail
		$detailsArr = array();
		$detailsArr['customer_email'] = $BidderEmail;
		$detailsArr['RequestID'] = $getDocsRecordRow['RequestID'];
		$detailsArr['BidderID'] = $BidderID;
		$detailsArr['BidderName'] = $BidderName;
		$detailsArr['doc_category'] = $getDocsRecordRow['doc_category'];
		$detailsArr['doc_type'] = $getDocsRecordRow['doc_type'];
		$detailsArr['doc_name'] = $getDocsRecordRow['doc_name'];
		$detailsArr['doc_path'] = $getDocsRecordRow['doc_path'];
		$detailsArr['LeadRefNumber'] = $getDocsRecordRow['LeadRefNumber'];
		$detailsArr['ApplicationNumber'] = $getDocsRecordRow['ApplicationNumber'];
		$mailResponse = SendNormalMailToCustomers($detailsArr);
	}
}
//echo '<pre>';print_r($data);exit;

function SendNormalMailToCustomers($detailsArr){
	
	$message = '<table cellpadding="0" cellspacing="0" border="0" width="600" align="center">
				<tr><td bgcolor="#0c60b6">&nbsp;</td></tr>
				<tr>
					<td bgcolor="#0c60b6" align="right">
						<img src="http://www.deal4loans.com/images/deal4loans_logo.png" style="margin-right:25px;" />
					</td>
				</tr>
				<tr><td bgcolor="#0c60b6">&nbsp;</td></tr>
				<tr><td bgcolor="#bdd8ef">&nbsp;</td></tr>
				<tr><td bgcolor="#bdd8ef">&nbsp;</td></tr>
				<tr>
					<td bgcolor="#bdd8ef">
						<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
							<tr><td bgcolor="#FFFFFF">&nbsp;</td></tr>
							<tr>
								<td height="35" bgcolor="#FFFFFF" style="font-family:Arial, Helvetica, sans-serif; font-size:18px; color:#171717; padding-left:15px;">Dear '.$detailsArr['BidderName'].',</td>
							</tr>
							<tr>
								<td bgcolor="#FFFFFF" style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#4c4c4c; line-height:21px; padding-left:15px;">Applicant has uploaded his/her following EApply Documents:</td>
							</tr>
							<tr><td bgcolor="#FFFFFF">&nbsp;</td></tr>
							<tr>
								<td bgcolor="#FFFFFF" style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#4c4c4c; line-height:21px; padding-left:15px;">1. Doc Category : '.$detailsArr['doc_category'].'</td>
							</tr>
							<tr>
								<td bgcolor="#FFFFFF" style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#4c4c4c; line-height:21px; padding-left:15px;">2. Doc Type : '.$detailsArr['doc_type'].'</td>
							</tr>
							<tr>
								<td bgcolor="#FFFFFF" style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#4c4c4c; line-height:21px; padding-left:15px;">3. Doc Name : '.$detailsArr['doc_name'].'</td>
							</tr>
							<tr>
								<td bgcolor="#FFFFFF" style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#4c4c4c; line-height:21px; padding-left:15px;">4. File Upload Location : http://www.deal4loans.com/sbi-documents-details.php?reqid='.$detailsArr['RequestID'].'&biddt='.$detailsArr['BidderID'].'</td>
							</tr>
							<tr>
								<td bgcolor="#FFFFFF" style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#4c4c4c; line-height:21px; padding-left:15px;">5. Applicant Details : </td>
							</tr>
							<tr>
								<td bgcolor="#FFFFFF" style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#4c4c4c; line-height:21px; padding-left:30px;">a. Lead Reference No : '.$detailsArr['LeadRefNumber'].'</td>
							</tr>
							<tr>
								<td bgcolor="#FFFFFF" style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#4c4c4c; line-height:21px; padding-left:30px;">b. Application Status : '.$detailsArr['ApplicationNumber'].'</td>
							</tr>
							<tr><td bgcolor="#FFFFFF">&nbsp;</td></tr>
							<tr>
								<td bgcolor="#FFFFFF" style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#4c4c4c; line-height:21px; padding-left:15px;">Regards</td></tr>
							<tr>
								<td bgcolor="#FFFFFF" style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#4c4c4c; line-height:21px; padding-left:15px;">Deal4loans Family</td>
							</tr>
							<tr><td bgcolor="#FFFFFF">&nbsp;</td></tr>
							<tr><td bgcolor="#FFFFFF">&nbsp;</td></tr>
						</table>
					</td>
				</tr>
				<tr><td bgcolor="#bdd8ef">&nbsp;</td></tr><tr><td bgcolor="#bdd8ef"><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td style="font-family:Arial, Helvetica, sans-serif; font-size:10px; color:#676767;">Disclaimer: Deal4loans does not provide Loans on its own but ensures your information is sent to bank/agent which you have opted for. We do not do short term loans. Deal4loans has no sales team on its own and we just help you to compare loans. All loans are on discretion of the associated</td></tr></table></td></tr><tr><td bgcolor="#bdd8ef">&nbsp;</td></tr></table>';

	//print_r($message);exit;
	
	////////////////--------------Send Mail via PHP---------------///////////////

	$to = $detailsArr['customer_email'];
	//$to = 'rachit2264@gmail.com';
	$subject = "Deal4loans-New Upload";

	// Set content-type header for sending HTML email
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	// Additional headers
	$headers .= 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
	$headers .= 'Cc: sanjeet.saxena@sbicard.com' . "\r\n";
	$headers .= 'Bcc: rachit.jain@wishfin.com, upendra.kumar@wishfin.com' . "\r\n";

	// Send email
	if(mail($to,$subject,$message,$headers)){
		$Msg = 'Mail Sent';
	}
	else{
		$Msg = 'Mail Failed';
	}
	
	////////////////--------------Send Mail via PHP---------------///////////////

	return $Msg;
}

?>

