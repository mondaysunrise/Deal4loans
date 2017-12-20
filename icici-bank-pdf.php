<?php
ob_start();
require 'scripts/db_init.php';
//error_reporting(E_ALL);
//ini_set('display_errors', 1);

$start_datetime = date('Y-m-d 00:00:00');
$end_datetime = date('Y-m-d 23:59:59');
$applied_bankname = 'ICICI BANK';
$response_data = 'Approved';

$sql = "SELECT rcc.`Dated` AS DATE_OF_CALLING, 
				MONTHNAME(rcc.`Dated`) AS CALLING_MONTH, 
				rcc.`City` AS CITY_NAME, 
				rcc.`City` AS Region, 
				rcc.`Name` AS CUSTOMER_NAME, 
				rcc.`Mobile_Number` AS MOBILE_NO, 
				rcc.`DOB` AS DOB, 
				'deal4loans' AS CAMPAIGN_NAME, 
				rcc.`source` AS SOURCE_1, 
				rcc.`Pancard` AS PAN_NO, 
				rcc.`source` AS SOURCE_2, 
				'' AS PQ_LEADS, 
				rcc.`source` AS SOURCE_3, 
				rcc.`Reference_Code` AS CODE, 
				'' AS SFA_ID, 
				rcc.`applied_card_name` AS PRODUCT, 
				rcc.`Landline` AS RESI_LANDLINENO, 
				rcc.`Residence_Address` AS RESIDENCE_ADDRESS, 
				rcc.`Pincode` AS RESI_PINCODE, 
				'' AS OFFICE_LANDLINE_NUMBER, 
				rcc.`Company_Name` AS COMPANY_NAME, 
				rcc.`Office_Address` AS OFF_ADDRESS, 
				'' AS OFF_PINCODE, 
				'' AS CO_EMAIL_ID, 
				ccba.`date_created` AS DATE_OF_APPOINTMENT, 
				'' AS APPT_TIME, 
				'' AS DOCUMENT_TYPE, 
				'' AS APPOINTMENT_PLACE, 
				'' AS APPOINTMENT_PINCODE, 
				'' AS PBO_NAME, 
				'' AS CM_AGE, 
				rcc.`Net_Salary` AS SALARY, 
				'' AS TL_NAME, 
				'' AS STATUS, 
				'' AS COMMENT, 
				rcc.`Add_Comment` AS EXTRA_COMMENT, 
				'' AS AUDITOR_NAME, 
				'' AS ALTERNATE_MOBILE_NO 
				FROM `Req_Credit_Card` AS rcc JOIN `credit_card_banks_apply` AS ccba ON (ccba.cc_requestid = rcc.RequestID) WHERE (ccba.`applied_bankname` = '".$applied_bankname."') AND (ccba.`date_created` BETWEEN '".$start_datetime."' AND '".$end_datetime."') AND (ccba.`response_data` like '%".$response_data."%')";
//echo $sql;exit;
list($total_records,$myrow) = MainselectfuncNew($sql,$array = array());
//echo '<pre>'; echo $total_records;print_r($myrow);exit;

$content = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
		"http://www.w3.org/TR/html4/loose.dtd">
		<html>
		<head>
		<title>PDF</title></head>
		<body>';
$content.= '<table border="1" cellpadding="0" cellspacing="0" style="width:600px;border:1px dotted #ccc;margin-top:0;margin-left:auto;margin-right:auto;font-family:arial;margin-bottom:10px;" >';

//Header
$arraykeys = array_keys($myrow[0]);
$content.='<tr>';
foreach($arraykeys as $value){
	$content.= '<td style="width:250px;font-family:arial;font-weight:bold;font-size:15px;color:#000;">'.$value.'</td>';
}
$content.='</tr>';

//Rows
foreach($myrow as $key=>$value){
	$arrayvalues = array_values($value);
	$content.='<tr>';
	foreach($arrayvalues as $val){
		$val = wordwrap ($val,25," ",true);
		$content.= '<td style="width:250px;font-family:arial;font-size:12px;color:#000;">'.$val.'</td>';
	}
	$content.='</tr>';
}
$content.='</table>';
$content.='</body></html>';
ob_get_clean();
//print_r($content);exit;
$pdf_name = date('YmdHis').'_data.pdf';
$width_in_inches = 110;
$height_in_inches = 60;
$width_in_mm = $width_in_inches * 25.4; 
$height_in_mm = $height_in_inches * 25.4;
require_once(dirname(__FILE__).'/html2pdfnew/html2pdf/html2pdf.class.php');
//$html2pdf = new HTML2PDF('P','A4','en');
$html2pdf = new HTML2PDF('P', array($width_in_mm,$height_in_mm), 'en');
$html2pdf->setDefaultFont('Arial');
$html2pdf->pdf->SetProtection(array('print', 'copy'), '1234', '12345');
$html2pdf->WriteHTML($content);
$html2pdf->Output(dirname(__FILE__).'/zipfiles/'.$pdf_name,'F');
?>
