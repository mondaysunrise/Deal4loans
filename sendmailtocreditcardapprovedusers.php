<?php
require 'scripts/db_init.php';
require 'sendcreditcardmail.php';

//error_reporting(E_ALL);
//ini_set('display_errors', 1);
//$updateqry= "Update credit_card_mail_logs set customer_consent='1' Where 1";
//$updateqryresult = ExecQuery($updateqry);

$getAllAcceptedMailLogSql = "SELECT ccml.created_date, ccml.request_id, rcc.Name, rcc.Email, rcc.Mobile_Number ,rcc.City, scc.CardName FROM credit_card_mail_logs AS ccml JOIN Req_Credit_Card AS rcc ON(rcc.RequestID = ccml.request_id) LEFT JOIN sbi_credit_card_5633 AS scc ON(scc.RequestID = ccml.request_id) WHERE ccml.customer_consent = '1' AND ccml.created_date < DATE_SUB(NOW(), INTERVAL 30 MINUTE) AND ccml.mail2_status=1 GROUP BY ccml.request_id";
list($numRows,$getAllAcceptedMailLogResponse)=MainselectfuncNew($getAllAcceptedMailLogSql,$array = array());
//echo '<pre>';print_r($getAllAcceptedMailLogResponse);exit;

$mailer=2;
foreach($getAllAcceptedMailLogResponse as $key=>$value){
	//Send Mail to customer
	$detailsArr = array();
	$detailsArr['request_id'] = $value['request_id'];
	$detailsArr['customer_name'] = ucwords(strtolower($value['Name']));
	$detailsArr['customer_email'] = $value['Email'];
	$detailsArr['bank_name'] = 'SBI';
	$detailsArr['customer_phone'] = $value['Mobile_Number'];
	$detailsArr['customer_location'] = $value['City'];
	$detailsArr['card_name'] = $value['CardName'];

	$mailres = SendMailToCustomers($detailsArr, $mailer);
	
	$updateMailLogQry="UPDATE credit_card_mail_logs set mail2_status='2' WHERE request_id='".$value['request_id']."'";
	$updateMailLogQry;
	$updatemailLogRes = ExecQuery($updateMailLogQry);
}

?>
