<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);

require 'scripts/db_init.php';
require 'phpmailer/class.phpmailer.php';

$min_date = date("Y-m-d 00:00:00");
$max_date = date("Y-m-d 23:59:59");
$blankRecordArr = array();

//Query To get records who have only one entry and their response_xml is blank in webservice_log_sbi table
$getBlankRecordSql = "SELECT CONCAT('D4L', cc_requestid) as `Marketing Partner Unique Number`, '' as `Application Number/Lead Ref Number (if available)`, SUBSTR(request_xml, LOCATE ('<PAN>', request_xml) + 5 , 10) as `PAN`, DATE(first_dated) as `Date and time for request submission`, 'Blank' as `Status/Error Message` FROM `webservice_log_sbi` WHERE cc_requestid IN (SELECT cc_requestid FROM (select cc_requestid, COUNT(cc_requestid) AS c FROM `webservice_log_sbi` GROUP BY cc_requestid HAVING C < 2 ) as temp) AND response_xml = '' and first_dated between '".$min_date."' AND  '".$max_date."' ORDER BY cc_requestid DESC";

saveDbDataToXls($getBlankRecordSql);

//Send Mail Using PHPMailer
$message = 'PFA file to get details of blank LRN leads';

//$server_path = $_SERVER['DOCUMENT_ROOT'];
$server_path = '/home/deal4loans/public_html';
$filename = 'sbi_blank_leads.xls';
$path = $server_path.'/data/files/';
$filepath = $path . $filename;
$newfilename = date('Y-m-d').'.xls';

$subject = "SBI Blank LRN Leads ".date('Y-m-d');

$FromArr = array();
$FromArr['email'] = 'noreply@deal4loans.com';
$FromArr['name'] = 'Deal4loans';

$ReplyToArr = array();
$ReplyToArr['email'] = 'noreply@deal4loans.com';
$ReplyToArr['name'] = 'Deal4loans';

$ToArr = array();
$ToArr[0]['email'] = 'Sheetal.Narvekar@ge.com';
$ToArr[0]['name'] = 'Sheetal';

$ToArr[1]['email'] = 'Dharitri.Dalvi@sbicard.com';
$ToArr[1]['name'] = 'Dharitri';

$ToArr[2]['email'] = 'kanika.sawant@sbicard.com';
$ToArr[2]['name'] = 'Kanika';

$ToArr[3]['email'] = 'bhupendra.dwivedi@deal4loans.com';
$ToArr[3]['name'] = 'Bhupendra';


$CcArr = array();
$CcArr[0]['email'] = 'Kunal.Burman@sbicard.com';
$CcArr[0]['name'] = 'Kunal';

$CcArr[1]['email'] = 'manish.sinha@deal4loans.com';
$CcArr[1]['name'] = 'Manish';

$CcArr[2]['email'] = 'amarjeet.kaushik@deal4loans.com';
$CcArr[2]['name'] = 'Amarjeet';

$CcArr[3]['email'] = 'lokesh.upadhyay@deal4loans.com';
$CcArr[3]['name'] = 'Lokesh';

$CcArr[4]['email'] = 'tripti.khurana@deal4loans.com';
$CcArr[4]['name'] = 'Tripti';

$CcArr[5]['email'] = 'mohd.mahtab@deal4loans.com';
$CcArr[5]['name'] = 'Mahtab';

$CcArr[6]['email'] = 'sanjeet.saxena@sbicard.com';
$CcArr[6]['name'] = 'Sanjeet';


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
	$csvfile = $server_path.'/data/files/sbi_blank_leads.xls';
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

