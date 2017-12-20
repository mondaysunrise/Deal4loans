<?php
require 'scripts/db_init.php';
require 'scripts/functions.php';
require 'scripts/session_checkBilling.php';

$BillingMonth = $_POST['BillingMonth'];
$Invoice = $_POST['Invoice'];
$InvoiceDate = $_POST['InvoiceDate'];
$BidderID = $_POST['BidderID'];
$LeadVolume = $_POST['LeadVolume'];

$Cost = $_POST['Cost'];
$Sub_Total = $LeadVolume * $Cost;

$STPercent =10;
$eduCess = 2;
$highereduCess = 1;
$ServiceTax = round(($Sub_Total * $STPercent / 100),0).".00";
$educationcess = round(($ServiceTax * $eduCess / 100),0).".00";
$highereducationcess = round(($ServiceTax * $highereduCess / 100),0).".00";

$FinalTotal = round(($Sub_Total + $ServiceTax + $educationcess + $highereducationcess),0).".00";

//$Update_Query = "update Bill_Record set Lead_Volume = '".$LeadVolume."', Cost_Lead = '".$Cost."', Sub_Total = '".$Sub_Total."',  Service_Tax = '".$ServiceTax."',educationcess = '".$educationcess."',highereducationcess = '".$highereducationcess."',  Total_Amount = '".$FinalTotal."' where Bill_Period ='".$BillingMonth."' and Invoice_Number ='".$Invoice."' and Invoice_Date ='".$InvoiceDate."' and BidderID ='".$BidderID."' ";
//ExecQuery($Update_Query);
//echo $Update_Query;

 $DataArray = array("Lead_Volume"=>$LeadVolume, "Cost_Lead"=>$Cost, "Sub_Total"=>$Sub_Total, "Service_Tax"=>$ServiceTax,"educationcess"=>$educationcess, "highereducationcess"=>$highereducationcess, "Total_Amount"=>$FinalTotal);
		$wherecondition ="Bill_Period ='".$BillingMonth."' and Invoice_Number ='".$Invoice."' and Invoice_Date ='".$InvoiceDate."' and BidderID ='".$BidderID."'";
		Mainupdatefunc ('Bill_Record', $DataArray, $wherecondition);

//exit();
header("Location: billing_confirm.php?BidderID=$BidderID&submit=Edited&Invoice=$Invoice");
?>