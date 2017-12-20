<?php
ini_set('max_execution_time', 600);
require 'scripts/db_init.php';
require 'webservices_functions.php';

$requestID = $_REQUEST["custid"];
$sbiccid = $_REQUEST["sbiccid"];

if(!isset($_SERVER['HTTP_REFERER']))
{ 
	echo "You Refreshed the Page";
	die();
}

/* Check if user already submitted request within 15 minutes Start*/
$checkRequestXmlQry = "SELECT request2_xml, second_dated FROM sbi_credit_card_5633 WHERE RequestID = '".$requestID."' AND second_dated > DATE_SUB(NOW(), INTERVAL 30 MINUTE) ORDER BY sbiccid DESC limit 0,1";
$getRequestXmlResult = d4l_ExecQuery($checkRequestXmlQry);
$request2_xml = d4l_mysql_result($getRequestXmlResult,0,'request2_xml');
$second_dated = d4l_mysql_result($getRequestXmlResult,0,'second_dated');

if(!empty($request2_xml)){
	echo 'Submitted at '.$second_dated;
	echo '<br/>In Process ...<br/>';
	die();
}
/* Check if user already submitted request within 15 minutes End*/

//echo "<br>**********************************************************sbi_credit_card_5633*************************************<br>";
$getSccDetailsQry = "SELECT * FROM sbi_credit_card_5633 WHERE sbiccid = '".$sbiccid."'";
$getSccDetailsResult = d4l_ExecQuery($getSccDetailsQry);
$getSccDetailsResponse = d4l_mysql_fetch_array($getSccDetailsResult);
$AppointmentDateTime = $getSccDetailsResponse['appointment_datetime'];
$ApplicationNumber = $getSccDetailsResponse['ApplicationNumber'];

$secondserviceresponse = sbisecond_webservice($sbiccid, $AppointmentDateTime, $ApplicationNumber);

foreach($secondserviceresponse as $key => $value){
	echo $key.' - '. $value;
	echo '<br>';
}

//echo "<br>**********************************************************sbi_credit_card_5633*************************************<br>";

function sbisecond_webservice($sbiccid, $AppointmentDateTime, $ApplicationNumber)
{
	
	$AppointmentDate = date('d/m/Y', strtotime($AppointmentDateTime));
	$AppointmentTime = date('H:i', strtotime($AppointmentDateTime));
	
	$dataArr = array();
	$dataArr['ApplicationNumber']= $ApplicationNumber;
	$dataArr['PickUpDate']= $AppointmentDate;
	$dataArr['PickUpTime']= $AppointmentTime;
	//echo '<pre>';print_r($dataArr);exit;

	$extraDataArr = array();

	$webserviceObj = new Webservices();
	$serviceResponse = $webserviceObj->SBIWebservice2($dataArr, $extraDataArr, $sbiccid);
	//echo '<pre>';print_r($serviceResponse);
}
?>
