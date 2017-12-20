<?php
ini_set('max_execution_time', 1000);
require 'scripts/db_init.php';
require 'cron_creditcard_functionforbanks.php';

echo "<br>***********************************************************************************************************<br>";
echo "Leads Push Internal LMS Amex Calling";
echo "<br>***********************************************************************************************************<br>";
echo $amex = insertLeadtoAllocation('amercianexpressinternalcallerlms_cc',104,'SMS_Internal_Lead_AMEX');
echo "<br>***********************************************************************************************************<br>";
echo "Leads Push Internal LMS RBL Calling";
echo "<br>***********************************************************************************************************<br>";
echo $rbl = insertLeadtoAllocation('rblcallerinternallms_cc',105,'SMS_Internal_Lead_RBL');
echo "Leads Push Internal LMS ICICI Calling";
echo "<br>***********************************************************************************************************<br>";
echo $icici = insertLeadtoAllocation('icicibankinternalcallerlms_cc',106,'SMS_Internal_Lead_ICICI');

?>