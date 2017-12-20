<?php

require 'scripts/db_init.php';
require 'scripts/functions.php';
require 'getlistofeligiblebidders.php';

$Loan_Amount = FixString($_REQUEST['Loan_Amount']); //
$Employment_Status = FixString($_REQUEST['Employment_Status']); //
$Company_Name = FixString($_REQUEST['Company_Name']); //
$Net_Salary = FixString($_REQUEST['Net_Salary']); //
$Name = FixString($_REQUEST['Name']); //
$City = FixString($_REQUEST['City']); //
$City_Other = FixString($_REQUEST['City_Other']); //
$Phone = FixString($_REQUEST['Phone']); //
$Email = FixString($_REQUEST['Email']); //
$accept = FixString($_REQUEST['accept']);
$IP = FixString($_REQUEST['IP']);
$Source = FixString($_REQUEST['Source']); //
$lastId = FixString($_REQUEST['lastId']); //
$Residential_Status = FixString($_REQUEST['Residential_Status']);

$Loan_A = FixString($_REQUEST['Loan_Any']);
$Total_Experience = FixString($_REQUEST['Total_Experience']);
$Pincode = FixString($_REQUEST['Pincode']);
$DOB = FixString($_REQUEST['DOB']);
$CC_Holder = FixString($_REQUEST['CC_Holder']);
$Dated = ExactServerdate();

$tomorrow = mktime(0, 0, 0, date("m"), date("d") - 30, date("Y"));
$days30date = date('Y-m-d', $tomorrow);
$days30datetime = $days30date . " 00:00:00";
$currentdate = date('Y-m-d');
$currentdatetime = date('Y-m-d') . " 23:59:59";
$getdetails = "select RequestID From Req_Loan_Against_Property Where ( Mobile_Number not in (9811215138,9811555306,9999570210) and Mobile_Number='" . $Phone . "' and Updated_Date between '" . $days30datetime . "' and '" . $currentdatetime . "') order by RequestID DESC";

list($alreadyExist, $myrow) = MainselectfuncNew($getdetails, $array = array());
$myrowcontr = count($myrow) - 1;
if ($alreadyExist > 0) {

    $lastInsertedId = $myrow[$myrowcontr]["RequestID"];
    $Duplicate = "Duplicate";
} else {

    $dataInsert = array('Name' => $Name, 'Email' => $Email, 'Employment_Status' => $Employment_Status, 'Company_Name' => $Company_Name, 'City' => $City, 'City_Other' => $City_Other, 'Mobile_Number' => $Phone, 'Net_Salary' => $Net_Salary, 'Loan_Amount' => $Loan_Amount, 'DOB' => $DOB, 'Dated' => $Dated, 'Pincode' => $Pincode, 'source' => $Source, 'Updated_Date' => $Dated, 'IP_Address' => $IP, 'Privacy' => $accept, 'Residential_Status' => $Residential_Status, 'Total_Experience' => $Total_Experience, 'Loan_Any' => $Loan_A, 'CC_Holder' => $CC_Holder);
    $lastInsertedId = Maininsertfunc('Req_Loan_Against_Property', $dataInsert);
    $Duplicate = "";
}

if ($Net_Salary <= 298000) {
    list($realbankiD, $bankID, $FinalBidder, $finalBidderName) = getBiddersList("Req_Loan_Against_Property", $lastInsertedId, $City);
    $arrFinal_Bid = "";
    while (list ($key, $val) = @each($FinalBidder)) {
        $arrFinal_Bid[] = $val;
    }
    $Final_Bid = "";
    while (list ($key, $val) = @each($bankID)) {
        $Final_Bid[] = $val;
    }
    if (((strncmp("Fullerton", $Final_Bid[$i], 9)) == 0 || ($Final_Bid[$i] == "Fullerton")) && ($Residential_Status == 1 || $Residential_Status == 3 || $Residential_Status == 4 || $Residential_Status == 5)) {
        $arrfinal_bidders[] = $arrFinal_Bid[$i];
    } else {
        if ($Final_Bid[$i] != "Fullerton" || (strncmp("Fullerton", $Final_Bid[$i], 9)) != 0) {
            $arrfinal_bidders[] = $arrFinal_Bid[$i];
        }
    }
    $getarrfinal_bidders = implode(',', $arrfinal_bidders);
    if (strlen($getarrfinal_bidders) > 0) {
        $Allocated = 2;
    } else {
        $Allocated = 0;
    }
    if (strlen($getarrfinal_bidders) > 1) {
        $dataUpdate = array('Bidderid_Details' => $getarrfinal_bidders, 'Allocated' => $Allocated, 'IsProcessed' => '1');
        $wherecondition = "(RequestID=" . $lastInsertedId . ")";
        Mainupdatefunc('Req_Loan_Against_Property', $dataUpdate, $wherecondition);
    }
}
echo $lastInsertedId;
echo "," . $lastId;
echo "," . $Duplicate;
?>