<?php
require 'errorLogReporting.php';
define("PRODUCT_TYPE_ID", "4");

$errorLogReporting = new errorLogReporting();
$Allocation_Date = '2016-01-01 04:20:02';
$iWebServiceStatus='';
$myXMLData = '';
$RequestID = 1504417;
$errorLogReporting->errorReportInsertion($iWebServiceStatus, $myXMLData, $ClientName, PRODUCT_TYPE_ID, $BidderID=5737, $RequestID, $webServiceID=3, $Allocation_Date);

?>