<?php
ini_set('max_execution_time', 600);
require 'scripts/session_check_online.php';
require 'scripts/db_init.php';
require 'webservices_functions.php';

$sbiccid = $_REQUEST['sbiccid'];

if($_SESSION["BidderID"] != '6769') {  echo "You are not authorised to view this details."; die();  }

if(!isset($_SERVER['HTTP_REFERER']))
{
	echo "You Refreshed the Page";
	die();
}

/* Check if user already submitted request within 15 minutes Start*/
$checkRequestXmlQry = "SELECT request_xml, first_dated FROM sbi_credit_card_5633 WHERE sbiccid = '".$sbiccid."' AND first_dated > DATE_SUB(NOW(), INTERVAL 30 MINUTE) ORDER BY sbiccid DESC LIMIT 0,1";
$getRequestXmlResult = d4l_ExecQuery($checkRequestXmlQry);
$request_xml = d4l_mysql_result($getRequestXmlResult,0,'request_xml');
$first_dated = d4l_mysql_result($getRequestXmlResult,0,'first_dated');

if(!empty($request_xml)){
	echo 'Submitted at '.$first_dated;
	echo '<br/>In Process ...<br/>';
	die();
}
/* Check if user already submitted request within 15 minutes End*/
	
$webserviceObj = new Webservices();
$serviceResponse = $webserviceObj->SBIWebserviceNoResponse($sbiccid);

$LeadRefNumber = $serviceResponse['LeadRefNumber'];
$ApplicationNumber = $serviceResponse['ApplicationNumber'];
$StatusCode = $serviceResponse['StatusCode'];
$ProcessingStatus = $serviceResponse['ProcessingStatus'];
$CreditLimit = $serviceResponse['CreditLimit'];
$Message = $serviceResponse['Message'];
$code = $serviceResponse['code'];
$message = $serviceResponse['message'];

echo "LeadRef Numbner: ".$LeadRefNumber; echo "<br>";
echo "Application Number: ".$ApplicationNumber;echo "<br>";
echo "STatus Code: ".$StatusCode;echo "<br>";
echo "Processing Statusr: ".$ProcessingStatus;echo "<br>";
echo "CreditLimit: ".$CreditLimit;echo "<br>";
echo "Message: ".$Message;echo "<br>";
echo "code: ".$code;echo "<br>";
echo "message: ".$message;echo "<br>";

?>	
