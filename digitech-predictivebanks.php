<?php
ini_set('max_execution_time', 600);
require 'scripts/db_init.php';
require 'digitech-predictivefunctionsforbanks.php';

$call_IP="103.12.135.98";

$DigitechPredictiveFunctionsObj = new DigitechPredictiveFunctions();

echo "<br>***********************************************************************************************************<br>";
echo "Leads Push through DIGITECH API for Predective Calling";
echo "<br>***********************************************************************************************************<br>";

echo $amex = $DigitechPredictiveFunctionsObj->insertLeadsToRCCDigitech('diallerccleadstodigitechamex',7194,'SMS_Digi_Lead_AMEX',105,661,$call_IP);
echo "<br>***********************************************************************************************************<br>";

echo $rbl = $DigitechPredictiveFunctionsObj->insertLeadsToRCCDigitech('diallerccleadstodigitechrbl',7195,'SMS_Digi_Lead_RBL',103,662,$call_IP);
echo "<br>***********************************************************************************************************<br>";

echo $yesbank = $DigitechPredictiveFunctionsObj->insertLeadsToRCCDigitech('diallerccleadstodigitechyesbank',7231,'SMS_Digi_Lead_YesBank',102,667,$call_IP);
echo "<br>***********************************************************************************************************<br>";
/*
echo $sbi = $DigitechPredictiveFunctionsObj->insertLeadsToRCCDigitech('diallerccleadstoiccssbi',6845,'SMS_Lead_SBI',102,641,$call_IP);
echo "<br>***********************************************************************************************************<br>";

echo $icici = $DigitechPredictiveFunctionsObj->insertLeadsToRCCDigitech('diallerccleadstoiccsicici',6846,'SMS_Lead_ICICI',101,639,$call_IP);
echo "<br>***********************************************************************************************************<br>";

echo $scb = $DigitechPredictiveFunctionsObj->insertLeadsToRCCDigitech('diallerccleadstoiccsscb',6847,'SMS_Lead_SCB',104,642,$call_IP);
echo "<br>***********************************************************************************************************<br>";
*/

/* 
 * New API's
 * 
Amex

http://103.12.135.98:8080/iCallMateMasterAPI/webresources/setMasterAP
I/MobileNo=7838594940&Name=Amit&LandMark=Noida&clientid=123456&
crmcallid=1234567?CampaignID=105&LeadID=638


ICICI

http://125.16.147.178:8080/iCallMateMasterAPI/webresources/setMasterAP
I/MobileNo=9958202041&Name=Amit&LandMark=Noida&clientid=123456&
crmcallid=1234567?CampaignID=101&LeadID=639


RBL

http://125.16.147.178:8080/iCallMateMasterAPI/webresources/setMasterAP
I/MobileNo=9958202041&Name=Amit&LandMark=Noida&clientid=123456&
crmcallid=1234567?CampaignID=103&LeadID=640


SCb

http://125.16.147.178:8080/iCallMateMasterAPI/webresources/setMasterAP
I/MobileNo=9958202041&Name=Amit&LandMark=Noida&clientid=123456&
crmcallid=1234567?CampaignID=104&LeadID=642


SBI

http://125.16.147.178:8080/iCallMateMasterAPI/webresources/setMasterAP
I/MobileNo=9958202041&Name=Amit&LandMark=Noida&clientid=123456&
crmcallid=1234567?CampaignID=102&LeadID=641

*/
?>
