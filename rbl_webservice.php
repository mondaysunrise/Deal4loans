<?php
ini_set('max_execution_time', 2000);
require 'scripts/db_init.php';
require 'webservices_functions.php';
require_once ("lib/nusoap.php");

//error_reporting(E_ALL);
//ini_set('display_errors', 1);

$RequestID = $_REQUEST["requestid"];

$IP_Remote = $_SERVER["REMOTE_ADDR"];
if ($IP_Remote == '192.124.249.12' || $IP_Remote == '185.93.228.12') {
    $IP = $_SERVER['HTTP_X_SUCURI_CLIENTIP'];
} else {
    $IP = $IP_Remote;
}

$getUserDetailsSql = "SELECT * FROM Req_Credit_Card WHERE RequestID = '".$RequestID."'";
$getUserDetailsResult = d4l_ExecQuery($getUserDetailsSql);
$getUserDetails = d4l_mysql_fetch_assoc($getUserDetailsResult);

$Name = $getUserDetails['Name'];
echo "Name - <b>".$Name."</b><br><br>";

/* Check if user already submitted request within 30 minutes Start*/
$checkRequestDataQry = "SELECT id, last_updated, response_data FROM credit_card_banks_apply WHERE cc_requestid=".$RequestID." AND applied_bankname LIKE '%RBL%' AND request_data != '' AND last_updated > DATE_SUB(NOW(), INTERVAL 30 MINUTE) ORDER BY id DESC LIMIT 0,1";
$getRequestDataResult = d4l_ExecQuery($checkRequestDataQry);
$getRequestData = d4l_mysql_fetch_assoc($getRequestDataResult);
$get_ccba_id = $getRequestData['id'];
$punch_date = $getRequestData['last_updated'];
$response_data = $getRequestData['response_data'];

if(!empty($get_ccba_id)){
	echo 'Submitted at '.$punch_date;
	echo '<br/>In Process ...<br/>';
	die();
}
/* Check if user already submitted request within 30 minutes End*/

/* Check if user already submitted If Blank*/
if(!empty($get_ccba_id) && empty($response_data)){ 
	echo "Already punched to RBL. No Response";
	die();
}
/*Check if user already submitted If Blank*/

list($first_name,$middle_name,$last_name) = explode(" ",$getUserDetails["Name"]);
if(strlen($middle_name)>0 && $middle_name!="Middle Name" && $last_name=="")
{
	$last_name= $middle_name;
	$middle_name="";
}
else
{
	if($last_name=="")
	{
		$last_name= "Kumar";
	}
}
	
if($middle_name=="Middle Name")
{
	$middle_name="";
}

$Mobile_Number = $getUserDetails["Mobile_Number"];
$Email = $getUserDetails["Email"];
$Gender = $getUserDetails["Gender"];
$Pancard = $getUserDetails["Pancard"];
list($year,$mm,$dd) = explode("-",$getUserDetails["DOB"]);
$dobstr= $dd."-".$mm."-".$year;
$applied_card_name = $getUserDetails["applied_card_name"];
$CC_Holder = $getUserDetails["CC_Holder"];
$Applied_With_Banks = $getUserDetails["Applied_With_Banks"];

$Residence_Address = $getUserDetails["Residence_Address"];
$Residence_Address1 = substr($Residence_Address,0,39);
$Residence_Address2 = substr($Residence_Address,41,39);

$City = $getUserDetails["City"];
$citycode=GetCityCode($City);
$Pincode = $getUserDetails["Pincode"];

$Office_Address= $getUserDetails["Office_Address"];
$strofficeadd = round((strlen($Office_Address)/2));
$officeadd = str_split($Office_Address, $strofficeadd);
$OfficeAddress1 = substr(trim($officeadd[0]),0,23);
$OfficeAddress2 = substr(trim($officeadd[1]),0,23);

$Employment_Status = $getUserDetails["Employment_Status"];
$Net_Salary = $getUserDetails["Net_Salary"];
$monthlyincome = round($Net_Salary/12);
$CompanyName= $getUserDetails["Company_Name"];
$CompanyName = substr(trim($CompanyName),0,24);
$Std_Code= $getUserDetails["Std_Code"];
$Landline= $getUserDetails["Landline"];
$Phone_Number=$Std_Code."".$Landline;

if($Gender == 2 || $Gender == 'Female') {
	$Gender=2;
}
else
{
	$Gender=1;
}

if($Gender==1)
{
	$title="1";
}
else
{
	$title="2";
}

if($Employment_Status==0)
{
	$EmpType=2;
}
else
{
	$EmpType=1;
}


$getUserExtraDetailsSql = "SELECT id, office_city, office_pincode, applied_cardname, billing_preference, qualification, lead_source FROM credit_card_banks_apply WHERE cc_requestid = '".$RequestID."' AND applied_bankname LIKE '%RBL%'";
$getUserExtraDetailsResult = d4l_ExecQuery($getUserExtraDetailsSql);
$getUserExtraDetails = d4l_mysql_fetch_assoc($getUserExtraDetailsResult);
$ccba_id = $getUserExtraDetails["id"];
$CreditCardApplied = $getUserExtraDetails["applied_cardname"];
$OfficePin = $getUserExtraDetails["office_pincode"];
$BillingPrefernce = $getUserExtraDetails["billing_preference"];
$Qualification = $getUserExtraDetails["qualification"];
$OfficeCity = $getUserExtraDetails["office_city"];
$lead_source = $getUserExtraDetails["lead_source"];

//RBL Validations

try{
	$errMsg = "";
	$flag = 0;
	
	if(empty($CreditCardApplied)){
		$errMsg .= 'Please select Card'.'<br/>';
		$flag = 1;
	}
	
	if(empty($title)){
		$errMsg .= 'Please select title'.'<br/>';
		$flag = 1;
	}

	if(empty($first_name)){
		$errMsg .= 'FirstName is empty'.'<br/>';
		$flag = 1;
	}elseif(strlen($first_name) > 15){
		$errMsg .= 'FirstName: Max length is 15 chars'.'<br/>';
		$flag = 1;
	}

	if(empty($last_name)){
		$errMsg .= 'LastName is empty'.'<br/>';
		$flag = 1;
	}elseif(strlen($last_name) > 15){
		$errMsg .= 'LastName: Max length is 15 chars'.'<br/>';
		$flag = 1;
	}
	
	if(empty($Gender)){
		$errMsg .= 'Gender is empty'.'<br/>';
		$flag = 1;
	}elseif($Gender !='1' && $Gender != '2'){
		$errMsg .= 'Enter correct value of Gender'.'<br/>';
		$flag = 1;
	}
	
	if(empty($dobstr)){
		$errMsg .= 'DOB is empty'.'<br/>';
		$flag = 1;
	}elseif(empty($dd) || empty($mm) || empty($year)){
		$errMsg .= 'Select valid DOB'.'<br/>';
		$flag = 1;
	}
	
	if(empty($Residence_Address)){
		$errMsg .= 'ResidenceAddress is empty'.'<br/>';
		$flag = 1;
	}elseif(strlen($Residence_Address) > 80){
		$errMsg .= 'ResidenceAddress: Max length is 80 chars'.'<br/>';
		$flag = 1;
	}
	
	if(empty($citycode)){
		$errMsg .= 'Please select valid city. RBL do not provide cards for this city.'.'<br/>';
		$flag = 1;
	}

	if(empty($Pincode)){
		$errMsg .= 'Pincode is empty'.'<br/>';
		$flag = 1;
	}elseif(strlen($Pincode) != 6){
		$errMsg .= 'Pincode should be of 6 numbers'.'<br/>';
		$flag = 1;
	}elseif(!preg_match('/^[1-9][0-9]*$/', $Pincode)) {
		$errMsg .= 'Pincode: Please enter only numbers'.'<br/>';
		$flag = 1;
	}
	
	if(empty($Email)){
		$errMsg .= 'Email is empty'.'<br/>';
		$flag = 1;
	}elseif(!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
		$errMsg .= 'Email format is invalid'.'<br/>';
		$flag = 1;
	}
	
	if(empty($Mobile_Number)){
		$errMsg .= 'Mobile Number is empty'.'<br/>';
		$flag = 1;
	}elseif(!preg_match('/^[1-9][0-9]*$/', $Mobile_Number)) {
		$errMsg .= 'Mobile Number: Please enter only numbers'.'<br/>';
		$flag = 1;
	}elseif(strlen($Mobile_Number) != 10){
		$errMsg .= 'Mobile Number should be of 10 numbers'.'<br/>';
		$flag = 1;
	}elseif(substr($Mobile_Number,0,1) != 9 && substr($Mobile_Number,0,1) != 8 && substr($Mobile_Number,0,1) != 7){
		$errMsg .= 'Mobile Number should should start with 9,8 or 7'.'<br/>';
		$flag = 1;
	}
	
	if(empty($EmpType)){
		$errMsg .= 'EmpType is empty'.'<br/>';
		$flag = 1;
	}

	if(empty($monthlyincome)){
		$errMsg .= 'MonthlyIncome is empty'.'<br/>';
		$flag = 1;
	}elseif(!preg_match('/^[1-9][0-9]*$/', $monthlyincome)) {
		$errMsg .= 'MonthlyIncome: Please enter only numbers'.'<br/>';
		$flag = 1;
	}
	
	if(empty($Pancard)){
		$errMsg .= 'PAN is empty'.'<br/>';
		$flag = 1;
	}elseif(strlen($Pancard) != 10){
		$errMsg .= 'PAN should be of 10 numbers'.'<br/>';
		$flag = 1;
	}elseif(!preg_match("/^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}?$/", $Pancard)) {
		$errMsg .= 'PAN is invalid'.'<br/>';
		$flag = 1;
	}

	if($flag){
		throw new Exception($errMsg);
	}
}catch(Exception $e){
	echo $e->getMessage().'<br/>'.'<strong>Please fill all required fields</strong>';
	exit;
}


$dataArr = array();
$dataArr['RequestID'] = $RequestID;
$dataArr['CreditCardApplied'] = $CreditCardApplied;
$dataArr['Title'] = $title;
$dataArr['FirstName'] = trim($first_name);
$dataArr['LastName'] = trim($last_name);
$dataArr['Gender'] = $Gender;
$dataArr['DOB'] = $dobstr;
$dataArr['ResAddress1'] = $Residence_Address1;
$dataArr['ResAddress2'] = $Residence_Address2;
$dataArr['ResCity'] = $citycode;
$dataArr['ResPIN'] = trim($Pincode);
$dataArr['Email'] = trim($Email);
$dataArr['Mobile'] = trim($Mobile_Number);
$dataArr['EmpType'] = $EmpType;
$dataArr['NMI'] = $monthlyincome;
$dataArr['PAN'] = trim($Pancard);

$extraDataArr = array();
$extraDataArr['lead_source'] = $lead_source;

$webserviceObj = new Webservices();
$serviceResponse = $webserviceObj->RBLWebservice($dataArr, $extraDataArr, $ccba_id);
//echo '<pre>';print_r($serviceResponse);

/*
$responseArray = array();
$responseArray['Status'] = 0;
$responseArray['ReferenceCode'] = '#CCHR3E9C6';
$responseArray['EligibleCard'] = '';
$responseArray['Errorcode'] = 6;
$responseArray['Errorinfo'] = 'Duplicate application';
$responseArray['RequestIP'] = '180.179.212.193';

$serviceResponse = $responseArray;
*/

$responsedata = $serviceResponse;
if(count($responsedata)>0)
{
	foreach($responsedata as $key=>$value)
	{
		echo $key.' - '.$value."<br>";
	}
}
?>

<?php

function GetCityCode($pKey){
    $titles = array(
	'Gurgaon'=>7,
	'Gurugram'=>7,
	'Hyderabad'=>15,
	'Bangalore'=>19,
	'Chennai'=>21,
	'Ahmedabad'=>22,
	'Mumbai'=>25,
	'Pune'=>26,
	'Coimbatore'=>69,
	'Noida'=>78,
	'Gaziabad'=>87,
	'Ghaziabad'=>87,
	'Indore'=>106,
	'Navi Mumbai'=>163,
	'Surat'=>190,
	'New Delhi'=>318,
	'Delhi'=>318,
	'Bhopal'=>623,
	'Thane'=>640,
	'Greater Noida'=>704,
	'Baroda'=>707,
	'Jaipur'=>100,
	'Chandigarh'=>9,
	'Panchkula'=>2223,
	'Mohali'=>1087,
	'Faridabad'=>981,
	'Vadodara'=>993,
	'Vadodra'=>993
    	);
    foreach ($titles as $key=>$value)
        if($pKey==$key)
        return $value;
    return "";
}

?>
