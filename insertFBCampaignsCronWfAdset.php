<?php
ini_set('max_execution_time', 600);
require 'scripts/db_init.php';
require 'scripts/functions.php';

$ReqID = FixString($_REQUEST['ReqID']);
$Name = FixString($_REQUEST["Name"]);
$Phone = FixString($_REQUEST["Phone"]);

$IP = FixString($_REQUEST["IP"]);
$Source = FixString($_REQUEST["Source"]);
$DOB = FixString($_REQUEST["DOB"]);
$City= FixString($_REQUEST["City"]);
$Dated = FixString($_REQUEST["Dated"]);
$CurYrBusinessNum = FixString($_REQUEST["NumCurYrBusiness"]);
//$Net_Salary = FixString($_REQUEST["Net_Salary"]);
$Net_Salary = 400000;// As said by Rishi Sir 24/12/16
$Email = FixString($_REQUEST["Email"]);
$EmpStatus = FixString($_REQUEST["EmpStatus"]);

if (strlen($Phone) > 9) {
    $tomorrow = mktime(0, 0, 0, date("m"), date("d") - 30, date("Y"));
    $days30date = date('Y-m-d', $tomorrow);
    $days30datetime = $days30date . " 00:00:00";
    $currentdate = date('Y-m-d');
    $currentdatetime = date('Y-m-d') . " 23:59:59";

    $getdetails = "select RequestID From Req_Loan_Personal  Where ((Mobile_Number='" . $Phone . "' and Mobile_Number not in ('9811555306','9811215138','9717594465','9717594462')) and Updated_Date between '" . $days30datetime . "' and '" . $currentdatetime . "') order by RequestID DESC";
    list($alreadyExist, $myrow) = MainselectfuncNew($getdetails, $array = array());
    $myrowcontr = count($myrow) - 1;

    if ($alreadyExist > 0) {
        $ProductValue = $myrow[$myrowcontr]["RequestID"];
        $Duplicate = "1";
    } else {

        $dataInsert = array('Name' => $Name, 'Email' => $Email, 'Employment_Status' => $EmpStatus, 'Mobile_Number' => $Phone, 'Dated' => $Dated, 'Total_experience' => $CurYrBusinessNum, 'source' => $Source, 'IP_Address' => $IP, 'Updated_Date' => $Dated, 'Net_Salary'=>$Net_Salary, 'City' => $City, 'wishfin_id'=>$ReqID);


        //print_r($dataInsert);
        $ProductValue = Maininsertfunc('Req_Loan_Personal', $dataInsert);
    }
}//$crap Check

echo $ProductValue;
echo "," . $ReqID;
echo "," . $Duplicate;


//	header('Location: http://www.bestloansdeal.com/cronHL.php?ProductValue='.$ProductValue.'&bldReqID='.$bldReqID);
//exit();
?>