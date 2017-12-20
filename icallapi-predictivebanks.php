<?php
/*
NOT IS USE

SINGLE FILES MADE FOR EVERY BANK

*/

//@set_time_limit(600);
ini_set('max_execution_time', 600);
require 'scripts/db_init.php';
require 'icallapi-predictivefunctionsforbanks.php';
 $call_IP="124.124.244.139";
echo "<br>***********************************************************************************************************<br>";
echo "Leads Push through ICCS API for Predective Calling";
echo "<br>***********************************************************************************************************<br>";

//echo $amex = insertLeadtoICCS('diallerccleadstoiccsamex',6843,'SMS_Lead_AMEX',105,638,$call_IP);
echo $amex = insertLeadtoICCS('diallerccleadstoiccsamex',6843,'SMS_Lead_AMEX',105,661,$call_IP);
echo "<br>***********************************************************************************************************<br>";

//echo $rbl = insertLeadtoICCS('diallerccleadstoiccsrbl',6844,'SMS_Lead_RBL',103,640,$call_IP);
echo $rbl = insertLeadtoICCS('diallerccleadstoiccsrbl',6844,'SMS_Lead_RBL',103,663,$call_IP);
echo "<br>***********************************************************************************************************<br>";
echo $sbi = insertLeadtoICCS('diallerccleadstoiccssbi',6845,'SMS_Lead_SBI',102,641,$call_IP);
echo "<br>***********************************************************************************************************<br>";
echo $icici = insertLeadtoICCS('diallerccleadstoiccsicici',6846,'SMS_Lead_ICICI',101,639,$call_IP);
echo "<br>***********************************************************************************************************<br>";
echo $scb = insertLeadtoICCS('diallerccleadstoiccsscb',6847,'SMS_Lead_SCB',104,642,$call_IP);
echo "<br>***********************************************************************************************************<br>";


/*
AMEX 

http://124.124.244.139:8080/iCallMateMasterAPI/webresources/setMasterAP
I/MobileNo=9958202041&Name=Amit&LandMark=Noida&clientid=123456&
crmcallid=1234567?CampaignID=105&LeadID=638

ICICI

http:// 124.124.244.139:8080/iCallMateMasterAPI/webresources/setMasterAP
I/MobileNo=9958202041&Name=Amit&LandMark=Noida&clientid=123456&
crmcallid=1234567?CampaignID=101&LeadID=639

RBL


http:// 124.124.244.139:8080/iCallMateMasterAPI/webresources/setMasterAP
I/MobileNo=9958202041&Name=Amit&LandMark=Noida&clientid=123456&
crmcallid=1234567?CampaignID=103&LeadID=640

SCB


http:// 124.124.244.139:8080/iCallMateMasterAPI/webresources/setMasterAP
I/MobileNo=9958202041&Name=Amit&LandMark=Noida&clientid=123456&
crmcallid=1234567?CampaignID=104&LeadID=642

SBI

http:// 124.124.244.139:8080/iCallMateMasterAPI/webresources/setMasterAP
I/MobileNo=9958202041&Name=Amit&LandMark=Noida&clientid=123456&
crmcallid=1234567?CampaignID=102&LeadID=641
 

*/
?>