<?php
ini_set('max_execution_time', 600);
require 'scripts/db_init.php';
require 'scripts/functions.php';

//print_r($_REQUEST);
$ReqID = FixString($_REQUEST['ReqID']);
$Name = FixString($_REQUEST["Name"]);
$Phone = FixString($_REQUEST["Phone"]);

$IP = FixString($_REQUEST["IP"]);
$Source = FixString($_REQUEST["Source"]);
$DOB = FixString($_REQUEST["DOB"]);
$City= FixString($_REQUEST["City"]);
$Dated = FixString($_REQUEST["Dated"]);
$Plan =  FixString($_REQUEST["Plan"]);
$mobile_verified=  FixString($_REQUEST["mobile_verified"]);
$is_invest_ready=  FixString($_REQUEST["is_invest_ready"]);
$Net_Salary = 400000;
$Email = FixString($_REQUEST["Email"]);
$EmpStatus = 1;


if (strlen($Phone) > 9) {
    $tomorrow = mktime(0, 0, 0, date("m"), date("d") - 30, date("Y"));
    $days30date = date('Y-m-d', $tomorrow);
    $days30datetime = $days30date . " 00:00:00";
    $currentdate = date('Y-m-d');
    $currentdatetime = date('Y-m-d') . " 23:59:59";

    $getdetails = "select RequestID From Req_Mutual_Fund  Where ((Mobile_Number='" . $Phone . "' and Mobile_Number not in ('9811555306','9811215138','9717594465','9717594462')) and Updated_Date between '" . $days30datetime . "' and '" . $currentdatetime . "') order by RequestID DESC";
    list($alreadyExist, $myrow) = MainselectfuncNew($getdetails, $array = array());
    $myrowcontr = count($myrow) - 1;

    if ($alreadyExist > 0) {
  
        $ProductValue = $myrow[$myrowcontr]["RequestID"];
        $Duplicate = "1";
    } else {
    
    //INSERT INTO Req_Mutual_Fund (RequestID, UserID, Name, Email, Employment_Status, Company_Name, City, City_Other, Mobile_Number, Net_Salary, Plan, CC_Holder, Residence_Address, Residence_Pincode, Office_Address, Office_Pincode, Contact_Time, Dated, source, Referrer, Creative, Section, IP_Address, DOB, Allocated, Reference_Code, Is_Valid, Bidder_Count, Bidderid_Details, checked_bidders, Updated_Date, Add_Comment, Company_Type, Pancard, wishfin_id) VALUES (NULL, '0', '', '', '1', '', '', '', NULL, '0', '', '0', '', '0', '', '0', '', '0000-00-00 00:00:00', '', '', '', '', '', '0000-00-00', '0', '', '0', '', '', '', '0000-00-00 00:00:00', '', '', '', '0');
 //   Array ( [Name] => Swapna Ediga [Email] => dr.swapnaraj09@gmail.com [Employment_Status] => 1 [Mobile_Number] => 9611491746 [Dated] => 2017-04-03 01:02:10 [source] => wf_fb_leads [IP_Address] => 185.93.230.3 [Updated_Date] => 2017-04-03 01:02:10 [Net_Salary] => [City] => Bangalore [wishfin_id] => 69171 [Plan] => Child Plan ) 
        //$dataInsert = array('Name' => $Name, 'Email' => $Email, 'Employment_Status' => $EmpStatus, 'Mobile_Number' => $Phone, 'Dated' => $Dated, 'source' => $Source, 'IP_Address' => $IP, 'Updated_Date' => $Dated, 'Net_Salary'=>$Net_Salary, 'City' => $City, 'wishfin_id'=>$ReqID, 'Plan'=>$Plan);
        
        $dataInsert = array('Name' => $Name, 'Email' => $Email, 'Employment_Status' => $EmpStatus, 'Mobile_Number' => $Phone, 'Dated' => $Dated, 'source' => $Source, 'IP_Address' => $IP, 'Updated_Date' => $Dated,  'City' => $City, 'wishfin_id'=>$ReqID ,'MF_Plan'=>$Plan,'Net_Salary'=>$Net_Salary, 'is_invest_ready'=>$is_invest_ready, 'mobile_verified'=>$mobile_verified);

        $ProductValue = Maininsertfunc('Req_Mutual_Fund', $dataInsert);
    }
}//$crap Check

echo $ProductValue;
echo "," . $ReqID;
echo "," . $Duplicate;

?>