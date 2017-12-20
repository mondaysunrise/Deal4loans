<?php
ini_set('max_execution_time', 2000);
require 'scripts/db_init.php';
require 'webservices_functions.php';

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
$checkRequestDataQry = "SELECT id, last_updated, response_data FROM credit_card_banks_apply WHERE cc_requestid=".$RequestID." AND applied_bankname LIKE '%American Express%' AND request_data != '' AND last_updated > DATE_SUB(NOW(), INTERVAL 30 MINUTE) ORDER BY id DESC LIMIT 0,1";
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
	echo "Already punched to AMEX. No Response";
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
$dobstr= $mm."-".$dd."-".$year;
$applied_card_name = $getUserDetails["applied_card_name"];
$CC_Holder = $getUserDetails["CC_Holder"];
$Applied_With_Banks = $getUserDetails["Applied_With_Banks"];

$Residence_Address = $getUserDetails["Residence_Address"];
$Residence_Address = str_ireplace('|','',$Residence_Address);
$strresiadd = round((strlen($Residence_Address)/2));
$resiadd = str_split($Residence_Address, $strresiadd);
$ResidenceAddress1 = substr(trim($resiadd[0]),0,23);
$ResidenceAddress2 = substr(trim($resiadd[1]),0,23);

$City = $getUserDetails["City"];
$City = GetAmexCity($City);
$ResiState = GetStateCode(ucwords(strtolower($City)));
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
	$Gender="Female";
}
else
{
	$Gender="Male";
}

if($Employment_Status==0)
{
	$EmpType="SE";
}
else
{
	$EmpType="E";
}

$getUserExtraDetailsSql = "SELECT id, office_city, office_pincode, billing_preference, qualification, applied_cardname, lead_source FROM credit_card_banks_apply WHERE cc_requestid = '".$RequestID."' AND applied_bankname LIKE '%American%'";
$getUserExtraDetailsResult = d4l_ExecQuery($getUserExtraDetailsSql);
$getUserExtraDetails = d4l_mysql_fetch_assoc($getUserExtraDetailsResult);
$ccba_id = $getUserExtraDetails["id"];
$chosenCard = $getUserExtraDetails["applied_cardname"];
$OfficePin = $getUserExtraDetails["office_pincode"];
$BillingPrefernce = $getUserExtraDetails["billing_preference"];
$Qualification = $getUserExtraDetails["qualification"];
$OfficeCity = $getUserExtraDetails["office_city"];
$OfficeCity = GetAmexCity($OfficeCity);
$OfficeState = GetStateCode(ucwords(strtolower($OfficeCity)));
$lead_source = $getUserExtraDetails["lead_source"];

//Amex Validations
if(strlen($Pincode)==6 || strlen($OfficePin)==6 )
{
	$checkNegativePincodeStatusResidence = 0;
	$checkNegativePincodeStatusOffice = 0;	
	$checkPincodeSql = "select * from amex_negative_pincode where (pincode='".$Pincode."')";
	$checkPincodeQuery = d4l_ExecQuery($checkPincodeSql);
	$numcheckPincode = d4l_mysql_num_rows($checkPincodeQuery);
	if($numcheckPincode>0)
	{
		$checkNegativePincodeStatusResidence= 0;	
	}
	else
	{
		$checkNegativePincodeStatusResidence= 1;
	}
	
	$checkPincodeSql = "select * from amex_negative_pincode where (pincode='".$OfficePin."')";
	$checkPincodeQuery = d4l_ExecQuery($checkPincodeSql);
	$numcheckPincode = d4l_mysql_num_rows($checkPincodeQuery);
	if($numcheckPincode>0)
	{
		$checkNegativePincodeStatusOffice= 0;	
	}
	else
	{
		$checkNegativePincodeStatusOffice= 1;
	}
}

$card_status = 1;
if(intval($Net_Salary) >= 1000000){
	$card_status = 1;
}
else{
	if(($CC_Holder == 2) || ($Applied_With_Banks=='AMEX')){
		$card_status = 0;
	}else{
		$card_status = 1;
	}
}


try{
	$errMsg = "";
	$flag = 0;
	
	if(empty($chosenCard)){ 
		$errMsg .= 'Please select Card'.'<br/>';
		$flag = 1;
	}

	if(empty($first_name)){
		$errMsg .= 'FirstName is empty'.'<br/>';
		$flag = 1;
	}elseif(strlen($first_name) > 15){
		$errMsg .= 'FirstName: Max length is 15 chars'.'<br/>';
		$flag = 1;
	}elseif(!preg_match('/^[a-zA-Z\s]+$/',$first_name)){	
		$errMsg .= 'FirstName can have letters only.'.'<br/>';
		$flag = 1;
	}

	if(empty($last_name)){
		$errMsg .= 'LastName is empty'.'<br/>';
		$flag = 1;
	}elseif(strlen($last_name) < 2){
		$errMsg .= 'LastName: Min length is 2 chars'.'<br/>';
		$flag = 1;
	}elseif(strlen($last_name) > 15){
		$errMsg .= 'LastName: Max length is 15 chars'.'<br/>';
		$flag = 1;
	}elseif(!preg_match('/^[a-zA-Z\s]+$/',$last_name)){	
		$errMsg .= 'LastName can have letters only.'.'<br/>';
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
	
	if(empty($dobstr)){
		$errMsg .= 'DOB is empty'.'<br/>';
		$flag = 1;
	}elseif(empty($dd) || empty($mm) || empty($year)){
		$errMsg .= 'Select valid DOB'.'<br/>';
		$flag = 1;
	}
	
	if(empty($Gender)){
		$errMsg .= 'Gender is empty'.'<br/>';
		$flag = 1;
	}elseif($Gender !='Male' && $Gender != 'Female'){
		$errMsg .= 'Enter correct value of Gender'.'<br/>';
		$flag = 1;
	}

	if(empty($Qualification)){
		$errMsg .= 'Qualification is empty'.'<br/>';
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
	}elseif(substr($Pancard, 3, 1) != 'P') {
		$errMsg .= 'Please enter a valid PAN Number.'.'<br/>';
		$flag = 1;
	}
	
	if(empty($monthlyincome)){
		$errMsg .= 'MonthlyIncome is empty'.'<br/>';
		$flag = 1;
	}elseif(!preg_match('/^[1-9][0-9]*$/', $monthlyincome)) {
		$errMsg .= 'MonthlyIncome: Please enter only numbers'.'<br/>';
		$flag = 1;
	}elseif(strlen($monthlyincome) > 8){
		$errMsg .= 'MonthlyIncome: Max length is 8 chars'.'<br/>';
		$flag = 1;
	}
	
	if(empty($ResidenceAddress1)){
		$errMsg .= 'ResidenceAddress1 is empty'.'<br/>';
		$flag = 1;
	}elseif(strlen($ResidenceAddress1) > 24){
		$errMsg .= 'ResidenceAddress1: Max length is 24 chars'.'<br/>';
		$flag = 1;
	}
	
	if(!empty($ResidenceAddress2) && (strlen($ResidenceAddress2) > 24)){
		$errMsg .= 'ResiAddress2: Max length is 24 chars'.'<br/>';
		$flag = 1;
	}
	
	if(empty($City)){
		$errMsg .= 'City is empty'.'<br/>';
		$flag = 1;
	}
	
	if(empty($ResiState)){
		$errMsg .= 'Please select valid residence city. AMEX do not provide cards for this city.'.'<br/>';
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
	}elseif($checkNegativePincodeStatusOffice == 0 || $checkNegativePincodeStatusResidence == 0){
		$errMsg .= 'Amex do not provide cards for given pincode'.'<br/>';
		$flag = 1;
	}

	if(empty($EmpType)){
		$errMsg .= 'EmpType is empty'.'<br/>';
		$flag = 1;
	}

	if(empty($CompanyName)){
		$errMsg .= 'CompanyName is empty'.'<br/>';
		$flag = 1;
	}elseif(strlen($CompanyName) > 24){
		$errMsg .= 'CompanyName: Max length is 24 chars'.'<br/>';
		$flag = 1;
	}

	if(empty($OfficeAddress1)){
		$errMsg .= 'OfficeAddress1 is empty'.'<br/>';
		$flag = 1;
	}elseif(strlen($OfficeAddress1) > 24){
		$errMsg .= 'OfficeAddress1: Max length is 24 chars'.'<br/>';
		$flag = 1;
	}
	
	if(!empty($OfficeAddress2) && (strlen($OfficeAddress2) > 24)){
		$errMsg .= 'OfficeAddress2: Max length is 24 chars'.'<br/>';
		$flag = 1;
	}
	
	if(empty($OfficeCity)){
		$errMsg .= 'OfficeCity is empty'.'<br/>';
		$flag = 1;
	}
	
	if(empty($OfficeState)){
		$errMsg .= 'Please select valid office city. AMEX do not provide cards for this city.'.'<br/>';
		$flag = 1;
	}
	
	if(empty($OfficePin)){
		$errMsg .= 'OfficePin is empty'.'<br/>';
		$flag = 1;
	}elseif(strlen($OfficePin) != 6){
		$errMsg .= 'OfficePin should be of 6 numbers'.'<br/>';
		$flag = 1;
	}elseif(!preg_match('/^[1-9][0-9]*$/', $OfficePin)) {
		$errMsg .= 'OfficePin: Please enter only numbers'.'<br/>';
		$flag = 1;
	}
	
	
	if(empty($Phone_Number)){
		$errMsg .= 'Phone Number is empty'.'<br/>';
		$flag = 1;
	}elseif(!preg_match('/^[0-9][0-9]*$/', $Phone_Number)) {
		$errMsg .= 'Phone Number: Please enter only numbers'.'<br/>';
		$flag = 1;
	}
	/*
	elseif(strlen($Phone_Number) < 7){
		$errMsg .= 'Phone Number: Min length is 7 numbers'.'<br/>';
		$flag = 1;
	}elseif(strlen($Phone_Number) > 8){
		$errMsg .= 'Phone Number: Max length is 8 numbers'.'<br/>';
		$flag = 1;
	}*/
	
	if(empty($Std_Code)){
		$errMsg .= 'STD is empty'.'<br/>';
		$flag = 1;
	}elseif(!preg_match('/^[0-9][0-9]*$/', $Std_Code)) {
		$errMsg .= 'STD: Please enter only numbers'.'<br/>';
		$flag = 1;
	}
	/*
	elseif(strlen($Std_Code) != 11){
		$errMsg .= 'STD should be of 11 numbers'.'<br/>';
		$flag = 1;
	}*/

	if(empty($Phone_Number)){
		$errMsg .= 'Landline Number is empty'.'<br/>';
		$flag = 1;
	}elseif(strlen($Phone_Number) != 11){
		$errMsg .= 'Landline Number should be of 11 numbers'.'<br/>';
		$flag = 1;
	}

	if($BillingPrefernce == ''){
		$errMsg .= 'BillingPrefernce is empty'.'<br/>';
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
$dataArr['chosenCard'] = $chosenCard;
$dataArr['FNAME'] = trim($first_name);
$dataArr['MNAME'] = trim($middle_name);
$dataArr['LNAME'] = trim($last_name);
$dataArr['EMAIL'] = trim($Email);
$dataArr['MOBILE'] = trim($Mobile_Number);
$dataArr['DOB'] = $dobstr;
$dataArr['GENDER'] = $Gender;
$dataArr['educationalQualification'] = $Qualification;
$dataArr['PANCARD'] = trim($Pancard);
$dataArr['monthlyInCome'] = trim($monthlyincome);
$dataArr['address'] = trim($ResidenceAddress1);
$dataArr['address2'] = trim($ResidenceAddress2);
$dataArr['city'] = trim($City);
$dataArr['state'] = trim($ResiState);
$dataArr['pincode'] = trim($Pincode);
$dataArr['permaddress'] = trim($ResidenceAddress1);
$dataArr['permaddress2'] = trim($ResidenceAddress2);
$dataArr['permcity'] = trim($City);
$dataArr['permstate'] = trim($ResiState);
$dataArr['permpincode'] = trim($Pincode);
$dataArr['employmentType'] = $EmpType;
$dataArr['companyName'] = trim($CompanyName);
$dataArr['O_ADDRESS'] = trim($OfficeAddress1);
$dataArr['O_ADDRESS2'] = trim($OfficeAddress2);
$dataArr['O_City'] = trim($OfficeCity);
$dataArr['O_State'] = trim($OfficeState);
$dataArr['O_Pincode'] = trim($OfficePin);
$dataArr['PHONE'] = trim($Landline);
$dataArr['STD'] = $Std_Code;
$dataArr['IP'] = $IP;
$dataArr['platinumCardBillingPreference'] = $BillingPrefernce;

$extraDataArr = array();
$extraDataArr['lead_source'] = $lead_source;

$webserviceObj = new Webservices();
$serviceResponse = $webserviceObj->AmexWebservice($dataArr, $extraDataArr, $ccba_id);
//echo '<pre>';print_r($serviceResponse);


$responsedata=trim($serviceResponse);
$xmlArray = str_ireplace('<soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema"><soap:Body>','',$responsedata);
$xmlArray = str_ireplace('</soap:Body></soap:Envelope>','',$xmlArray);
$xmlArray = simplexml_load_string($xmlArray);
$json = json_encode($xmlArray);
$responseArray = json_decode($json,true);
if(isset($responseArray['submitApplicationResult'])){
	$response = $responseArray['submitApplicationResult']; 
	if(isset($response) && $response['status']['success'] == "true"){
		if($response['successResponse']['approved'] == "true"){
			echo "<br>The Application is submitted successfully.<br>";
		}
		elseif($response['successResponse']['decline'] == "true"){ 
			echo "The Application is Decline.<br>";
			foreach($response['successResponse']['declineReason'] as $key=>$reason){
				if($reason == "true"){
					echo "Decline reason : $key.<br>";
				}
			}
		}
		elseif($response['successResponse']['pending'] == "true"){
			echo "The Application is Pending.";
		}
		elseif($response['successResponse']['cancelled'] == "true"){
			echo "The Application is Cancelled.";
		}
	}else{
		if($response['failureResponse']['validationError']['errorDesc']){
			echo "The Application is rejected for now.<br>";
			echo "Reason : ".$response['failureResponse']['validationError']['errorDesc'];
		}
		elseif($response['failureResponse']['unhandledException'] == "true"){
			echo "The Application is rejected for now.<br>";
			echo "Reason : unhandled Exception";
		}
	}
}
if(isset($responsedata) && empty($responsedata)){
	echo "No Response From Amex.<br>";
}

?>

<?php

function GetStateCode($pKey){
    $titles = array(
	'Ahmedabad'=>'Gujarat',
	'Bangalore'=>'Karnataka',
	'Chandigarh'=>'Chandigarh',
	'Chennai'=>'Tamil Nadu',
	'Coimbatore'=>'Tamil Nadu',
	'Indore'=>'Madhya Pradesh',
	'Jaipur'=>'Rajasthan',
	'Kolkata'=>'West Bengal',
	'Navi Mumbai'=>'Maharashtra',
	'Thane'=>'Maharashtra',
	'Mumbai'=>'Maharashtra',
	'Pune'=>'Maharashtra',
	'Surat'=>'Gujarat',
	'Vadodara'=>'Gujarat',
	'Vadodra'=>'Gujarat',
	'Baroda'=>'Gujarat',
	'New Delhi'=>'Delhi',
	'Delhi'=>'Delhi',
	'Greater Noida'=>'Uttar Pradesh',
	'Noida'=>'Uttar Pradesh',
	'Gurgaon'=>'Haryana',
	'Gaziabad'=>'Uttar Pradesh',
	'Ghaziabad'=>'Uttar Pradesh',
	'Faridabad'=>'Delhi',
	'Hyderabad'=>'Andhra Pradesh'
	   	);
    foreach ($titles as $key=>$value)
        if($pKey==$key)
        return $value;
    return "";
}

function GetAmexCity($pKey){
	$titles = array(
	'New Delhi'=>'Delhi',
	'Gaziabad'=>'Ghaziabad',
	'Gurugram'=>'Gurgaon',
	'Vadodara'=>'Vadodra',
	);
    foreach($titles as $key=>$value){
		if($pKey==$key){
			return $value;
		}
	}
	return $pKey;
}

function split_on($string, $num) {
	$length = strlen($string);
	$output[0] = substr($string, 0, $num);
	$output[1] = substr($string, $num, $length );
	return $output;
}

?>
