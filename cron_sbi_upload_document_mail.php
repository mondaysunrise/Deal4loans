<?php
//error_reporting(E_ALL);
//ini_set('display_error', 1);

require 'scripts/db_init.php';
require 'sendsbiuploaddocmail.php';

$getApprovedDataSql = "SELECT sbiccid,RequestID,LeadRefNumber,ApplicationNumber,StatusCode,ProcessingStatus,first_dated, substring_index(substring_index(request_xml, '<FirstName>', -1), '</FirstName>', 1) as FirstName,substring_index(substring_index(request_xml, '<MiddleName>', -1), '</MiddleName>', 1) as MiddleName,substring_index(substring_index(request_xml, '<LastName>', -1), '</LastName>', 1) as LastName, substring_index(substring_index(request_xml, '<EmailAddress>', -1), '</EmailAddress>', 1) as EmailAddress FROM `sbi_credit_card_5633` WHERE ProcessingStatus=1 AND StatusCode IN (170,120) AND (first_dated >= DATE_SUB(NOW(), INTERVAL 1 Hour)) AND doc_email_status = 0 LIMIT 0,7";

$getApprovedDataResult = d4l_ExecQuery($getApprovedDataSql);
while($getApprovedDataRow = d4l_mysql_fetch_assoc($getApprovedDataResult)){
	//$getApprovedData[] = $getApprovedDataRow;
	
	$reqid = base64_encode($getApprovedDataRow['RequestID']);
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
		//$detailsArr['customer_email'] = 'rachit.jain@wishfin.com';
		$detailsArr['upload_doc_url'] = "http://www.deal4loans.com/document-upload-verification.php?reqid=$reqid&status=$status";
		$mailResponse = sendUploadDocEmailer($detailsArr);
		
		if(strpos($mailResponse, 'OK') !== false){
			//Update doc_email_status in DB
			echo $updateStatusSql = "UPDATE sbi_credit_card_5633 SET doc_email_status = 1 WHERE sbiccid = '".$getApprovedDataRow['sbiccid']."'";
			//echo $updateStatusSql.'<br>';
			$updateStatusResult = d4l_ExecQuery($updateStatusSql);

			//$detailsArr['customer_email'] = 'rachit.jain@wishfin.com';
			//sendUploadDocEmailer($detailsArr);
		}
	}
}
///echo '<pre>';print_r($getApprovedData);exit;

?>
