<?php
require 'scripts/db_init.php';
require 'scripts/db_init_wishfin.php';
require 'scripts/functions.php';

$postid = $_REQUEST["postid"];//$postid=23003;
$bidderID= $_REQUEST["biddt"];//$bidderID=7568;
$cardcc= $_REQUEST["cardcc"];

$viewqry="SELECT first_name, middle_name, last_name, gender, date_of_birth, mobile_number, email_id, pancard, is_pancard_kyc, residence_address, residence_pincode, city_name, state_code, legal_response, cibil_score, cibil_score_fetch_date from xkyknzl5dwfyk4hg_cibil WHERE id=".$postid." ";
//echo "dd - ".$viewqry;
$viewlead= wf_ExecQuery($viewqry);
$viewleadscount =wf_mysql_num_rows($viewlead);
//echo "<pre>"; print_r($viewlead); echo "<br>";

$first_name = wf_mysql_result($viewlead,0,'first_name');
$middle_name = wf_mysql_result($viewlead,0,'middle_name');
$last_name = wf_mysql_result($viewlead,0,'last_name');
$Name= FixString($first_name." ".$middle_name." ".$last_name);
$gender = wf_mysql_result($viewlead,0,'gender');
if($gender==1) { $gender='Male'; } else if($gender==2) { $gender='Female'; }
$DOB = wf_mysql_result($viewlead,0,'date_of_birth');
$Phone = FixString(wf_mysql_result($viewlead,0,'mobile_number'));
$Email = FixString(wf_mysql_result($viewlead,0,'email_id'));
$Pancard= FixString(wf_mysql_result($viewlead,0,'pancard'));
$is_pancard_kyc = wf_mysql_result($viewlead,0,'is_pancard_kyc');
$residence_address = wf_mysql_result($viewlead,0,'residence_address');
$residence_pincode = wf_mysql_result($viewlead,0,'residence_pincode');
$City = FixString(wf_mysql_result($viewlead,0,'city_name'));
$state_code = wf_mysql_result($viewlead,0,'state_code');
$source = 'wf_zbl_leads';
$time = strtotime("-23 year", time());
$DOB = date("Y-m-d", $time);
$accept=1;
$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-30, date("Y"));
$days30date=date('Y-m-d',$tomorrow);
$days30datetime = $days30date." 00:00:00";
$currentdate= date('Y-m-d');
$currentdatetime = date('Y-m-d')." 23:59:59";
$Dated=ExactServerdate();

$getdetails="SELECT RequestID, source FROM Req_Credit_Card WHERE Mobile_Number='".$Phone."' AND Mobile_Number NOT IN ('9811555306','9971396361', '9811215138','9999047207','9873678914', '9999570210', '9555060388', '9311773341') AND Updated_Date BETWEEN '".$days30datetime."' AND '".$currentdatetime."' ORDER BY RequestID DESC";
list($alreadyExist,$myrow)=Mainselectfunc($getdetails,$array = array());
if($alreadyExist>0)
{
	$ProductValue=$myrow['RequestID'];
	$_SESSION['Temp_LID'] = $ProductValue;
	
	if($myrow['source'] == 'wf_zbl_leads'){
		$location="sbiccleadlms-details.php?postid=".urlencode($ProductValue)."&biddt=".$bidderID;
		header ("Location: ".$location);
	}
	else{
		echo "Lead Already Exists From Other Source";
		exit();
	}
}
else
{
	$InsertProductSql = "INSERT INTO Req_Credit_Card (Name, Email, Employment_Status,City, City_Other, Mobile_Number, Net_Salary, DOB, Dated, source, Pancard, IP_Address, Updated_Date, Privacy, Gender, Referrer) VALUES ('".FixString($Name)."', '".FixString($Email)."', '".FixString($Employment_Status)."', '".FixString($City)."', '".FixString($City_Other)."', '".FixString($Phone)."', '".FixString($Net_Salary)."', '".FixString($DOB)."', '".FixString($Dated)."', '".FixString($source)."', '".FixString($Pancard)."', '".FixString($IP)."', '".FixString($Dated)."', '".FixString($accept)."', '".FixString($gender)."', '".FixString($cardcc)."')";
	
	$InsertProductQuery = d4l_ExecQuery($InsertProductSql);
	$ProductValue = d4l_mysql_insert_id();
	
	$inserticiciqry="INSERT INTO `lead_allocate` (`AllRequestID`, `BidderID`, `Reply_Type`, `Allocated`, `Allocation_Date`) VALUES ('".$ProductValue."', '".$bidderID."', '4', '0', '".$Dated."');";
	$inserticiciqryresult = d4l_ExecQuery($inserticiciqry);
	$location = "sbiccleadlms-details.php?postid=".urlencode($ProductValue)."&biddt=".$bidderID;
	header ("Location: ".$location);
	exit();
}
?>
