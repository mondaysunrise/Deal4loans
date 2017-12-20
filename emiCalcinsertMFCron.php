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
$Phone = FixString($_REQUEST['Phone']); //
$Email = FixString($_REQUEST['Email']); //
$IP = FixString($_REQUEST['IP']);
$Source = FixString($_REQUEST['Source']); //
$lastId = FixString($_REQUEST['lastId']); //
$Company_Type = FixString($_REQUEST['Company_Type']);
$Pincode = FixString($_REQUEST['Pincode']);
$DOB = FixString($_REQUEST['DOB']);
$CC_Holder = FixString($_REQUEST['CC_Holder']);
$Dated = ExactServerdate();

$tomorrow = mktime(0, 0, 0, date("m"), date("d") - 30, date("Y"));
$days30date = date('Y-m-d', $tomorrow);
$days30datetime = $days30date . " 00:00:00";
$currentdate = date('Y-m-d');
$currentdatetime = date('Y-m-d') . " 23:59:59";
$getdetails = "select RequestID From Req_Mutual_Fund Where ( Mobile_Number not in (9811215138,9811555306,9999570210) and Mobile_Number='" . $Phone . "' and Updated_Date between '" . $days30datetime . "' and '" . $currentdatetime . "') order by RequestID DESC";
list($alreadyExist, $myrow) = MainselectfuncNew($getdetails, $array = array());
$myrowcontr = count($myrow) - 1;
if ($alreadyExist > 0) {

    $lastInsertedId = $myrow[$myrowcontr]["RequestID"];
    $Duplicate = "Duplicate";
} else {

    $dataInsert = array('Name' => $Name, 'Email' => $Email, 'Employment_Status' => $Employment_Status, 'Company_Name' => $Company_Name, 'City' => $City, 'Mobile_Number' => $Phone, 'Net_Salary' => $Net_Salary, 'DOB' => $DOB, 'Dated' => $Dated, 'Residence_Pincode' => $Pincode, 'source' => $Source, 'Updated_Date' => $Dated, 'IP_Address' => $IP, 'Company_Type' => $Company_Type, 'CC_Holder' => $CC_Holder);
    $lastInsertedId = Maininsertfunc('Req_Mutual_Fund', $dataInsert);
    $Duplicate = "";
}
echo $lastInsertedId;
echo "," . $lastId;
echo "," . $Duplicate;
?>