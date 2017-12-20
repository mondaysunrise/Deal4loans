<?php
ini_set('max_execution_time', 1800);
require 'scripts/db_init.php';
require 'digitech-predictivefunctionsforbanks.php';

$call_IP="103.12.135.98";
//$call_IP="122.160.2.249";

$DigitechPredictiveFunctionsObj = new DigitechPredictiveFunctions();

echo "<br>***********************************************************************************************************<br>";
echo "Leads Push through DIGITECH API for Predective Calling";
echo "<br>***********************************************************************************************************<br>";

echo $sbibank = $DigitechPredictiveFunctionsObj->insertLeadsToRCCSDigitech('diallerccleadstodigitechsbi',7297,'SMS_Digi_Lead_SBI',104,678,$call_IP);//669
echo "<br>***********************************************************************************************************<br>";

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
