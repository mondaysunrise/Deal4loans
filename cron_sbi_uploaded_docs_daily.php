<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);

require 'scripts/db_init.php';
require 'phpmailer/class.phpmailer.php';

//$current_date = date('Y-m-d');
$yesterday_date = date('Y-m-d', strtotime('-1 day'));

//Query to get records for all docs uploaded today
$getDocsRecordSql = "SELECT scc.LeadRefNumber as LEAD_REFERENCE_NUMBER, sd.source_code as SOURCE_CODE, substring_index(substring_index(request_xml, '<CardType>', -1), '</CardType>', 1) as CARD_TYPE, substring_index(substring_index(request_xml, '<TextSpareField1>', -1), '</TextSpareField1>', 1) as LEAD_ID, '' as APPLICATION_DECISION, CONCAT(substring_index(substring_index(request_xml, '<FirstName>', -1), '</FirstName>', 1), ' ', substring_index(substring_index(request_xml, '<MiddleName>', -1), '</MiddleName>', 1), ' ', substring_index(substring_index(request_xml, '<LastName>', -1), '</LastName>', 1)) as APPLICANT_NAME, substring_index(substring_index(request_xml, '<Mobile>', -1), '</Mobile>', 1) as MOBILE_NUMBER, REPLACE(substring_index(substring_index(request_xml, '<CompanyName>', -1), '</CompanyName>', 1), ',' , ' ') as COMPANY_NAME, REPLACE(substring_index(substring_index(request_xml, '<ResiAddress1>', -1), '</ResiAddress1>', 1), ',' , ' ') as RESIDENCE_ADDRESS1, REPLACE(substring_index(substring_index(request_xml, '<ResiAddress2>', -1), '</ResiAddress2>', 1), ',' , ' ') as RESIDENCE_ADDRESS2, substring_index(substring_index(request_xml, '<ResiCity>', -1), '</ResiCity>', 1) as RESIDENCE_CITY, substring_index(substring_index(request_xml, '<ResiPin>', -1), '</ResiPin>', 1) as RESIDENCE_PIN, substring_index(substring_index(request_xml, '<ResiState>', -1), '</ResiState>', 1) as RESIDENCE_STATE, REPLACE(substring_index(substring_index(request_xml, '<OfficeAddress1>', -1), '</OfficeAddress1>', 1), ',' , ' ') as OFFICE_ADDRESS1, REPLACE(substring_index(substring_index(request_xml, '<OfficeAddress2>', -1), '</OfficeAddress2>', 1), ',' , ' ') as OFFICE_ADDRESS2, substring_index(substring_index(request_xml, '<OfficeCity>', -1), '</OfficeCity>', 1) as OFFICE_CITY, substring_index(substring_index(request_xml, '<OfficePin>', -1), '</OfficePin>', 1) as OFFICE_PIN, substring_index(substring_index(request_xml, '<OfficeState>', -1), '</OfficeState>', 1) as OFFICE_STATE, '' as SEQUENCE_ID, '' as REQUEST_NUMBER, scc.ProcessingStatus as PROCESSING_STATUS_DESCRIPTION, scc.RequestID as REQUEST_ID, REPLACE(sd.doc_name, ',',' ') as DOC_NAME, IF(doc_category='Surrogate','Yes','No') as SURROGATE_DOC_TYPE, sd.created_date as CREATED_DATE, IF(doc_type='Identity Proof','Yes','No') as `ID Proof`, IF(doc_type='Address Proof','Yes','No') as `Address Proof`, IF(doc_name='Credit_Card_Statement','Yes','No') as `Credit Card Stmt 1`, IF(doc_name='Credit_Card_Face','Yes','No') as `Card Face Copy`, IF(doc_name='Slip_for_1st_month','Yes','No') as `Pay Slip 1`, IF(doc_name='Slip_for_2nd_month','Yes','No') as `Pay Slip 2`, IF(doc_name='ITR_Statement','Yes','No') as `ITR`, IF(doc_name='Bank_Statement','Yes','No') as `Bank Statement`, IF(doc_name='Form_16','Yes','No') as `Form 16` FROM `sbi_documents` as sd JOIN sbi_credit_card_5633 as scc ON (scc.RequestID = sd.RequestID) WHERE DATE(sd.created_date) = '".$yesterday_date."' AND scc.ProcessingStatus = 1";

saveDbDataToXls($getDocsRecordSql);


//Send Mail Using PHPMailer
$message = 'PFA file to get details of newly uploaded docs';

//$server_path = $_SERVER['DOCUMENT_ROOT'];
$server_path = '/home/deal4loans/public_html';
$filename = 'sbi_doc_records.xls';
$path = $server_path.'/data/files/';
$filepath = $path . $filename;
$newfilename = date('Y-m-d').'.xls';

$subject = "Deal4loans:Document Upload Status Report-".date('d M Y');

$FromArr = array();
$FromArr['email'] = 'noreply@deal4loans.com';
$FromArr['name'] = 'Deal4loans';

$ReplyToArr = array();
$ReplyToArr['email'] = 'noreply@deal4loans.com';
$ReplyToArr['name'] = 'Deal4loans';

$ToArr = array();
$ToArr[0]['email'] = 'kanika.sawant@sbicard.com';
$ToArr[0]['name'] = 'Kanika';

$ToArr[1]['email'] = 'Dharitri.Dalvi@sbicard.com';
$ToArr[1]['name'] = 'Dharitri';

$ToArr[2]['email'] = 'mohitabhishek.sharan@sbicard.com';
$ToArr[2]['name'] = 'Mohit';

$CcArr = array();
$CcArr[0]['email'] = 'bhupendra.dwivedi@wishfin.com';
$CcArr[0]['name'] = 'Bhupendra';

$CcArr[1]['email'] = 'sanjeet.saxena@sbicard.com';
$CcArr[1]['name'] = 'Sanjeet';


$BccArr = array();
$BccArr[0]['email'] = 'rachit.jain@wishfin.com';
$BccArr[0]['name'] = 'Rachit Jain';

$BccArr[1]['email'] = 'upendra.kumar@wishfin.com';
$BccArr[1]['name'] = 'Upendra Kumar';

SendMail($message, $filepath, $newfilename, $subject, $FromArr, $ReplyToArr, $ToArr, $CcArr, $BccArr);


function saveDbDataToXls($Sql){
	$result = d4l_ExecQuery($Sql);
	
	$header = '';
	$response = '';
	
	//$server_path = $_SERVER['DOCUMENT_ROOT'];
	$server_path = '/home/deal4loans/public_html';
	$sep = "\t";
	
	//Column Names
	$names = mysqli_fetch_fields($result) ;
	foreach($names as $name){
		$header .= $name->name . $sep;
	}
	
	//Data
	while($row = mysqli_fetch_row($result)) {
		$schema_insert = "";
		for($j=0; $j<mysqli_num_fields($result);$j++) {
			if(!isset($row[$j]))
				$schema_insert .= "NULL".$sep;
			elseif ($row[$j] != "")
				$schema_insert .= "$row[$j]".$sep;
			else
				$schema_insert .= "".$sep;
		}
		$schema_insert = str_replace($sep."$", "", $schema_insert);
		$schema_insert = preg_replace("/\r\n|\n\r|\n|\r/", " ", $schema_insert);
		$schema_insert .= "\t";
		
		$response .= trim($schema_insert)."\n";
	}

	if($response == "")
	{
		$response = "\nNo Record(s) Found!\n";                        
	}

	/* Code to download File Start 
	header("Content-Type: application/xls");
	header("Content-Disposition: attachment; filename=sbi_blank_leads.xls");
	header("Pragma: no-cache");
	header("Expires: 0");
	print "$header\n$response";
	/* Code to download File End */

	/* Code to save data in File Start */
	$output = "$header\n$response";
	$csvfile = $server_path.'/data/files/sbi_doc_records.xls';
	file_put_contents($csvfile, $output);
	/* Code to save data in File End */
}


function SendMail($message, $attachmentFilePath, $attachmentFileName, $subject, $FromArr, $ReplyToArr, $ToArr, $CcArr, $BccArr){

	$mail = new PHPMailer(true);						// Passing `true` enables exceptions

	//Server settings
	/*
	$mail->SMTPDebug = 2;								// Enable verbose debug output
	$mail->isSMTP();                 					// Set mailer to use SMTP
	$mail->Host = 'smtp1.example.com;smtp2.example.com';// Specify main and backup SMTP servers
	$mail->SMTPAuth = true;                        		// Enable SMTP authentication
	$mail->Username = 'user@example.com';         		// SMTP username
	$mail->Password = 'secret';                 		// SMTP password
	$mail->SMTPSecure = 'tls';                  		// Enable TLS encryption, `ssl` also accepted
	$mail->Port = 587;                      			// TCP port to connect to
	*/

	$mail->setFrom($FromArr['email'], $FromArr['name']);
	foreach($ToArr as $key=>$val){
		$mail->AddAddress($val['email'], $val['name']);
	}
	
	$mail->AddReplyTo($ReplyToArr['email'], $ReplyToArr['name']);
	
	foreach($CcArr as $key=>$val){
		$mail->AddCC($val['email'], $val['name']);
	}
	
	foreach($BccArr as $key=>$val){
		$mail->AddBCC($val['email'], $val['name']);
	}

	//$mail->WordWrap = 50;	 // set word wrap to 50 characters

	//Add Attachments
	$mail->AddAttachment($attachmentFilePath, $attachmentFileName);

	//$mail->IsHTML(true);  // set email format to HTML

	$mail->Subject = $subject;
	$mail->Body    = $message;
	//$mail->AltBody = "This is the body in plain text for non-HTML mail clients";

	if($mail->Send())
	{
		$Msg = 'Mail Sent';
	}
	else{
		$Msg = 'Mail Failed';
		$Msg .= '<br>Mailer Error'.$mail->ErrorInfo;
	}
	echo $Msg;
}
?>

