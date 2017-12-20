<?php
ini_set('max_execution_time', 600);
require 'scripts/db_init.php';
require 'icallapi-predictivefunctionsforbanks.php';
 $call_IP="124.124.244.139";
echo "<br>***********************************************************************************************************<br>";
echo "Leads Push through ICCS API for Predective Calling Amex";
echo "<br>***********************************************************************************************************<br>";

//echo $amex = insertLeadtoICCS('diallerccleadstoiccsamex',6843,'SMS_Lead_AMEX',105,638,$call_IP);
echo $amex = insertLeadtoICCS('diallerccleadstoiccsamex',6843,'SMS_Lead_AMEX',105,661,$call_IP);
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