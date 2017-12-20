<?php
ini_set('max_execution_time', 2000);
require 'scripts/db_init.php';
require 'webservices_functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$Dated=ExactServerdate();
	
	$requestID = $_POST["requestID"];
	$card_id = $_POST["card_id"];
	$getcitySql = " SELECT * FROM `credit_card_banks_eligibility` WHERE cc_bankid='".$card_id."' and `cc_bank_flag`=1";
	list($numRowscity,$getcityQuery)=MainselectfuncNew($getcitySql,$array = array());
	$card_name =ucwords(strtolower($getcityQuery[0]['cc_bank_name']));

	$first_name = trim($_POST["first_name"]);
	$middle_name = trim($_POST["middle_name"]);
	$last_name = trim($_POST["last_name"]);
	$Gender = $_POST["Gender"];
	$panno = trim($_POST["panno"]);
	$resiaddress1 = $_POST["resiaddress1"];
	$strresiadd = round((strlen($resiaddress1)/2));
	$resiadd = str_split($resiaddress1, $strresiadd);
	$ResidenceAddress1 = substr(trim($resiadd[0]),0,23);
	$ResidenceAddress2 = substr(trim($resiadd[1]),0,23);
	$Qualification = $_POST["Qualification"];
	$OfficeAddress1 = $_POST["OfficeAddress1"];
	$strofficeadd = round((strlen($OfficeAddress1)/2));
	$officeadd = str_split($OfficeAddress1, $strofficeadd);
	$OfficeAddress1 = substr(trim($officeadd[0]),0,23);
	$OfficeAddress2 = substr(trim($officeadd[1]),0,23);
	$OfficeCity = $_POST["OfficeCity"];
	$OfficeCity = GetAmexCity($OfficeCity);
	$OfficeState = GetStateCode(ucwords(strtolower($OfficeCity)));
	$OfficePin = trim($_POST["OfficePin"]);
	$BillingPrefernce = $_POST["BillingPrefernce"];
	//$STD = $_POST["STD"];
	$Phone_Numberwithstd = trim($_POST["Phone_Number"]);
	$pincode= trim($_POST["pincode"]);
	$City = $_POST["City"];
	$City = GetAmexCity($City);
	$ResiState = GetStateCode(ucwords(strtolower($City)));
	$full_name=$first_name."".$middle_name."".$last_name;

	if(strlen($middle_name)>0 && $middle_name!="Middle Name" && $last_name=="")
	{
		$last= $middle_name;
		$middle_name="";
	}
	else
	{
		$last= $last_name;
	}
	if($last=="")
	{
		$last="kumar";
	}
	$stdwithphone=split_on($Phone_Numberwithstd, 4);
	$STD = $stdwithphone[0];
	$Phone_Number = $stdwithphone[1];
	
	$lead_source = "Direct";

	$InsertProductSql= array("Name"=>$full_name, "Gender" => $Gender, "Pancard" => $panno, "Residence_Address" => $Residence_Address, "Std_Code"=>$STD, "Landline"=>$Phone_Number, "Pincode"=>$pincode, "Office_Address"=>$OfficeAddress1);
	$wherecondition ="(RequestID='".$requestID."')";
	Mainupdatefunc("Req_Credit_Card", $InsertProductSql, $wherecondition);
	
	if($card_id==46) { $chosenCard="gold";} elseif($card_id==47){ $chosenCard="platinumTravel";} elseif($card_id==50){ $chosenCard="makeMyTrip";}  elseif($card_id==71){ $chosenCard="membershipreward";}else{ $chosenCard="membershipreward";}

	//Update values in credit_card_banks_apply table
	$getdetails="select id From credit_card_banks_apply Where ( cc_requestid='".$requestID."' and applied_bankname like '%American Express%') order by id DESC";
	list($alreadyExist,$myrow)=Mainselectfunc($getdetails,$array = array());
	$id=$myrow['id'];
	if($id>0)
	{
		$DataArray = array("qualification" => $Qualification, "billing_preference" =>$BillingPrefernce, "office_city"=> $OfficeCity, "office_pincode"=> $OfficePin, "applied_bankname"=>"American Express","applied_cardname" =>$chosenCard, "lead_source"=>$lead_source);
		$wherecondition ="(id='".$id."')";
		Mainupdatefunc ("credit_card_banks_apply", $DataArray, $wherecondition);
		$ccba_id = $id;
	}
	else
	{
		$DataArray= array("cc_requestid"=>$requestID, "qualification" => $Qualification, "billing_preference" =>$BillingPrefernce, "office_city"=> $OfficeCity, "office_pincode"=> $OfficePin, "applied_bankname"=>"American Express", "applied_cardname" =>$chosenCard, "lead_source"=>$lead_source, "date_created"=>$Dated);
		$ccba_id = Maininsertfunc("credit_card_banks_apply", $DataArray);
	}


	$slct="select Email,DOB,Company_Name,Net_Salary,Mobile_Number,Employment_Status,City from Req_Credit_Card Where (RequestID='".$requestID."')";
	list($Getnum,$row)=Mainselectfunc($slct,$array = array());
	$DOB = $row["DOB"];
	list($year,$month,$day) = explode("-",$DOB);
	$dobstr= $month."-".$day."-".$year;
	$CompanyName = $row["Company_Name"];
	$CompanyName = substr(trim($CompanyName),0,24);
	$Net_Salary = $row["Net_Salary"];
	list($AnnIncome,$extrapt) = explode(".",$Net_Salary);
	$monthlyincome = round($AnnIncome/12);

	$Email = trim($row["Email"]);
	$Mobile_Number = trim($row["Mobile_Number"]);
	$Employment_Status = $row["Employment_Status"];
	if($Employment_Status==0)
	{
		$EmpType="SE";
	}
	else
	{
		$EmpType="E";
	}
		
	$IP = getenv("REMOTE_ADDR");

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

		if(empty($last)){
			$errMsg .= 'LastName is empty'.'<br/>';
			$flag = 1;
		}elseif(strlen($last) < 2){
			$errMsg .= 'LastName: Min length is 2 chars'.'<br/>';
			$flag = 1;
		}elseif(strlen($last) > 15){
			$errMsg .= 'LastName: Max length is 15 chars'.'<br/>';
			$flag = 1;
		}elseif(!preg_match('/^[a-zA-Z\s]+$/',$last)){	
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
		}elseif(empty($day) || empty($month) || empty($year)){
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
		
		if(empty($panno)){
			$errMsg .= 'PAN is empty'.'<br/>';
			$flag = 1;
		}elseif(strlen($panno) != 10){
			$errMsg .= 'PAN should be of 10 numbers'.'<br/>';
			$flag = 1;
		}elseif(!preg_match("/^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}?$/", $panno)) {
			$errMsg .= 'PAN is invalid'.'<br/>';
			$flag = 1;
		}elseif(substr($panno, 3, 1) != 'P') {
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
		
		if(empty($pincode)){
			$errMsg .= 'Pincode is empty'.'<br/>';
			$flag = 1;
		}elseif(strlen($pincode) != 6){
			$errMsg .= 'Pincode should be of 6 numbers'.'<br/>';
			$flag = 1;
		}elseif(!preg_match('/^[1-9][0-9]*$/', $pincode)) {
			$errMsg .= 'Pincode: Please enter only numbers'.'<br/>';
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
		
		if(empty($STD)){
			$errMsg .= 'STD is empty'.'<br/>';
			$flag = 1;
		}elseif(!preg_match('/^[0-9][0-9]*$/', $STD)) {
			$errMsg .= 'STD: Please enter only numbers'.'<br/>';
			$flag = 1;
		}
		/*
		elseif(strlen($STD) != 11){
			$errMsg .= 'STD should be of 11 numbers'.'<br/>';
			$flag = 1;
		}*/

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
	$dataArr['RequestID'] = $requestID;
	$dataArr['chosenCard'] = $chosenCard;
	$dataArr['FNAME'] = trim($first_name);
	$dataArr['MNAME'] = trim($middle_name);
	$dataArr['LNAME'] = trim($last);
	$dataArr['EMAIL'] = trim($Email);
	$dataArr['MOBILE'] = trim($Mobile_Number);
	$dataArr['DOB'] = $dobstr;
	$dataArr['GENDER'] = $Gender;
	$dataArr['educationalQualification'] = $Qualification;
	$dataArr['PANCARD'] = trim($panno);
	$dataArr['monthlyInCome'] = trim($monthlyincome);
	$dataArr['address'] = trim($ResidenceAddress1);
	$dataArr['address2'] = trim($ResidenceAddress2);
	$dataArr['city'] = trim($City);
	$dataArr['state'] = trim($ResiState);
	$dataArr['pincode'] = trim($pincode);
	$dataArr['permaddress'] = trim($ResidenceAddress1);
	$dataArr['permaddress2'] = trim($ResidenceAddress2);
	$dataArr['permcity'] = trim($City);
	$dataArr['permstate'] = trim($ResiState);
	$dataArr['permpincode'] = trim($pincode);
	$dataArr['employmentType'] = $EmpType;
	$dataArr['companyName'] = trim($CompanyName);
	$dataArr['O_ADDRESS'] = trim($OfficeAddress1);
	$dataArr['O_ADDRESS2'] = trim($OfficeAddress2);
	$dataArr['O_City'] = trim($OfficeCity);
	$dataArr['O_State'] = trim($OfficeState);
	$dataArr['O_Pincode'] = trim($OfficePin);
	$dataArr['PHONE'] = trim($Phone_Number);
	$dataArr['STD'] = $STD;
	$dataArr['IP'] = $IP;
	$dataArr['platinumCardBillingPreference'] = $BillingPrefernce;
	
	$extraDataArr = array();
	$extraDataArr['lead_source'] = $lead_source;
	//echo '<pre>';print_r($dataArr);
	
	$webserviceObj = new Webservices();
	$serviceResponse = $webserviceObj->AmexWebservice($dataArr, $extraDataArr, $ccba_id);
	//echo '<pre>';print_r($serviceResponse);
	
	$output = $serviceResponse;
	//echo $output;exit;

}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Instant E Apply Credit Cards Online in India</title>
<meta name="keywords" content="online credit cards, online credit cards applications, Credit card comparison, online application of credit card, apply online credit cards, online credit card application" />
<meta name="description" content="Fill Application form for credit cards. Instant Apply & get Approval for Credit cards such as HDFC, ICICI, Citibank, Standard Chartered, SBI and American express Online in India." />
<meta name="verify-v1" content="iC5qAw9C0E3rRZYbtAKvnPHmBSQU3zWJu5Ooj8hO3Og=">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<link href="css/credit-card-styles.css" type="text/css" rel="stylesheet"  />
</head>
<body>
<?php include "middle-menu.php"; ?>
<div style="clear:both;"></div>
<div class="cc_inner_wrapper">
	<div style="clear:both;"></div>
	<div class="common-bread-crumb" style="margin:auto; width:100%; margin-top:70px; color:#0a8bd9;">
		<u><a href="index.php" class="text12" style="color:#0080d6;" >Home</a></u> > <a href="credit-cards.php"  class="text12" style="color:#0080d6;"><u>Credit Card</u></a> <span style="color:#4c4c4c;">> American Express Credit Card</span>
	</div>
	<div style="clear:both; height:10px;"></div>
	<div style="clear:both; height:20px; width:100%; margin:auto; margin-top:10px; padding-top:10px; font-size:18px; color:#000; height:400px;">
	Thank you for applying  for <? echo $card_name; ?>  through deal4loans, we will get back to you soon.
	<br>
	<?php
	$xmlArray = str_ireplace('<soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema"><soap:Body>','',$output);
	$xmlArray = str_ireplace('</soap:Body></soap:Envelope>','',$xmlArray);
	$xmlArray = simplexml_load_string($xmlArray);
	//print_r($xmlArray);
	$json = json_encode($xmlArray);
	$responseArray = json_decode($json,true);
	//print_r($responseArray);
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
				$msg = "The Application is Pending.";
			}
			elseif($response['successResponse']['cancelled'] == "true"){
				$msg = "The Application is Cancelled.";
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
	if(isset($output) && empty($output)){
		echo "No Response From Amex.<br>";
	}
	?>
	</div>
</div>
</div>
<div style="clear:both; height:100px;"></div>
<!--partners-->
<?php include("footer_sub_menu.php"); ?>
</body>
</html>
</body>
</html>
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
	
