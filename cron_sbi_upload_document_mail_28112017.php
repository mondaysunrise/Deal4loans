<?php
require 'scripts/db_init.php';

$maxtime = date('Y-m-d H:i:s');
$endtime = date('Y-m-d H:i:s', strtotime('-1 hour'));

$getApprovedDataSql = "SELECT sbiccid,RequestID,LeadRefNumber,ApplicationNumber,StatusCode,ProcessingStatus,first_dated, substring_index(substring_index(request_xml, '<FirstName>', -1), '</FirstName>', 1) as FirstName,substring_index(substring_index(request_xml, '<MiddleName>', -1), '</MiddleName>', 1) as MiddleName,substring_index(substring_index(request_xml, '<LastName>', -1), '</LastName>', 1) as LastName, substring_index(substring_index(request_xml, '<EmailAddress>', -1), '</EmailAddress>', 1) as EmailAddress FROM `sbi_credit_card_5633` WHERE ProcessingStatus=1 AND StatusCode IN (170,120) AND (first_dated >= DATE_SUB(NOW(), INTERVAL 1 Hour)) AND doc_email_status = 0 LIMIT 0,7";

$getApprovedDataResult = d4l_ExecQuery($getApprovedDataSql);
while($getApprovedDataRow = d4l_mysql_fetch_assoc($getApprovedDataResult)){
	$getApprovedData[] = $getApprovedDataRow;
	
	$reqid = base64_encode($getApprovedDataRow['RequestID']);
	//$reqid = base64_encode(1359751);
	$status = base64_encode($getApprovedDataRow['StatusCode']);
	$FirstName = $getApprovedDataRow['FirstName'];
	$MiddleName = $getApprovedDataRow['MiddleName'];
	$LastName = $getApprovedDataRow['LastName'];
	$EmailAddress = $getApprovedDataRow['EmailAddress'];
	
	if(!empty($EmailAddress)){
		//Send Mail
		$detailsArr = array();
		$detailsArr['customer_name'] = $FirstName.' '.$MiddleName.' '.$LastName;
		$detailsArr['customer_email'] = $EmailAddress;
		//$detailsArr['customer_email'] = 'upendra@wishfin.com';
		$detailsArr['reqid'] = $reqid;
		$detailsArr['status'] = $status;
		$mailResponse = SendDocumentsMailToCustomers($detailsArr);
		
		if($mailResponse == 'Mail Sent'){
			//Update Reference Code in DB
			$updateStatusSql = "UPDATE sbi_credit_card_5633 SET doc_email_status = 1 WHERE sbiccid = '".$getApprovedDataRow['sbiccid']."'";
			echo $updateStatusSql.'<br>';
			$updateStatusResult = d4l_ExecQuery($updateStatusSql);
		}
	}
	
}
//echo '<pre>';print_r($getApprovedData);exit;

function SendDocumentsMailToCustomers($detailsArr){
	$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
	$url = $protocol . $_SERVER['HTTP_HOST'];
	
	$message = '<table cellpadding="0" cellspacing="0" border="0" width="600" align="center"><tr><td bgcolor="#0c60b6">&nbsp;</td></tr><tr><td bgcolor="#0c60b6" align="right"><img src="http://www.deal4loans.com/images/deal4loans_logo.png" style="margin-right:25px;" /></td></tr><tr><td bgcolor="#0c60b6">&nbsp;</td></tr><tr><td bgcolor="#bdd8ef">&nbsp;</td></tr><tr><td bgcolor="#bdd8ef">&nbsp;</td></tr><tr><td bgcolor="#bdd8ef"><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td bgcolor="#FFFFFF">&nbsp;</td></tr><tr><td height="35" bgcolor="#FFFFFF" style="font-family:Arial, Helvetica, sans-serif; font-size:18px; color:#171717; padding-left:15px;">Dear '.$detailsArr['customer_name'].',</td></tr><tr><td bgcolor="#FFFFFF" style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#4c4c4c; line-height:21px; padding-left:15px;">Thank you for considering Deal4loans for Comparing Loan and credit card deals. We are India\'s Largest Financial Comparative platform with an association with India’s Top Banks/NBFC\'s for Loan &amp; Credit card. We are continuously working towards getting you the best deal on your  requirement basis your profile/eligibility.</td></tr><tr><td bgcolor="#FFFFFF">&nbsp;</td></tr><tr><td bgcolor="#FFFFFF" style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#4c4c4c; line-height:21px; padding-left:15px;">Your SBI credit card application is almost complete. Pls upload the <a href="#" style="color:#0c60b6; text-decoration:none;">required  documents</a> to the below mentioned link for instant approval.</td></tr><tr><td bgcolor="#FFFFFF">&nbsp;</td></tr><tr><td bgcolor="#FFFFFF" style="font-family:Arial, Helvetica, sans-serif; font-size:14px; line-height:21px; padding-left:15px;"><a href="http://www.deal4loans.com/document-upload-verification.php?reqid='.$detailsArr['reqid'].'&status='.$detailsArr['status'].'" style="color:#0c60b6; text-decoration:none;">Click Here</a></td></tr><tr><td bgcolor="#FFFFFF">&nbsp;</td></tr><tr><td bgcolor="#FFFFFF">&nbsp;</td></tr><tr><td bgcolor="#FFFFFF" style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#4c4c4c; line-height:21px; padding-left:15px;">Regards</td></tr><tr><td bgcolor="#FFFFFF" style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#4c4c4c; line-height:21px; padding-left:15px;">Deal4loans Family</td></tr><tr><td bgcolor="#FFFFFF">&nbsp;</td></tr><tr><td bgcolor="#FFFFFF">&nbsp;</td></tr></table></td></tr><tr><td bgcolor="#bdd8ef">&nbsp;</td></tr><tr><td bgcolor="#bdd8ef"><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td style="font-family:Arial, Helvetica, sans-serif; font-size:10px; color:#676767;">Disclaimer: Deal4loans does not provide Loans on its own but ensures your information is sent to bank/agent which you have opted for. We do not do short term loans. Deal4loans has no sales team on its own and we just help you to compare loans. All loans are on discretion of the associated</td></tr></table></td></tr><tr><td bgcolor="#bdd8ef">&nbsp;</td></tr></table>';

	//print_r($message);
	
	////////////////--------------Send Mail via PHP---------------///////////////

	$to = $detailsArr['customer_email'];
	//$to = 'rachit2264@gmail.com';
	$subject = "Complete your SBI Credit Card Application";

	// Set content-type header for sending HTML email
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	// Additional headers
	$headers .= 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
	//$headers .= 'Cc: upendra.kumar@wishfin.com' . "\r\n";
	//$headers .= 'Bcc: rachit.jain@wishfin.com,upendra@wishfin.com' . "\r\n";

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
