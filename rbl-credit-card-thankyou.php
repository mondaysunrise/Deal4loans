<?php
ini_set('max_execution_time', 1000);
require 'scripts/db_init.php';
require 'webservices_functions.php';
require_once ("lib/nusoap.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$Dated=ExactServerdate();
	
	$referencefrom = $_POST["referencefrom"];
	$requestID = $_POST["requestID"];
	$card_name = $_POST["card_name"];
	$card_id = $_POST["card_id"];
	$first_name = trim($_POST["first_name"]);
	$middle_name = trim($_POST["middle_name"]);
	$last_name = trim($_POST["last_name"]);
	$Gender = $_POST["Gender"];
	$panno = trim($_POST["panno"]);
	$resiaddress1 = $_POST["resiaddress1"];
	$Residence_Address = substr(trim($resiaddress1),0,39);
	$pincode= trim($_POST["pincode"]);
	$DOB= $_POST["DOB"];
	list($day,$month,$year) = explode("/",$DOB);
	$dobstr=$day."-".$month."-".$year;
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
	
	$lead_source="";
	if($referencefrom=="website")
	{
		$lead_source="DIRECT";
	}
	else
	{
		$lead_source="LMS";
	}

	$InsertProductSql= array("Name"=>$full_name, "Gender" => $Gender, "Pancard" => $panno, "Residence_Address" => $Residence_Address, "Pincode"=>$pincode);
	$wherecondition ="(RequestID='".$requestID."')";
	Mainupdatefunc("Req_Credit_Card", $InsertProductSql, $wherecondition);

	if($card_id==42) { $CreditCardApplied=21;} elseif($card_id==43){ $CreditCardApplied=24;} elseif($card_id==44){ $CreditCardApplied=16;}else{ $CreditCardApplied=16;}
	
	//Update values in credit_card_banks_apply table
	$getdetails="select id From credit_card_banks_apply Where ( cc_requestid='".$requestID."' and applied_bankname like '%RBL Bank%') order by id DESC";
	list($alreadyExist,$myrow)=Mainselectfunc($getdetails,$array = array());
	$id=$myrow['id'];
	if($id>0)
	{
		$DataArray = array("applied_cardname" =>$CreditCardApplied, "lead_source"=>$lead_source);
		$wherecondition ="(id='".$id."')";

		Mainupdatefunc ("credit_card_banks_apply", $DataArray, $wherecondition);
		$ccba_id = $id;
	}
	else
	{
		$DataArray= array("cc_requestid"=>$requestID, "applied_bankname"=>"RBL Bank", "applied_cardname" =>$CreditCardApplied, "lead_source"=>$lead_source, "date_created"=>$Dated);
		$ccba_id = Maininsertfunc("credit_card_banks_apply", $DataArray);
	}

	$slct="select Email,DOB,Company_Name,Net_Salary,Mobile_Number,Employment_Status,City from Req_Credit_Card Where (RequestID='".$requestID."')";
	list($Getnum,$row)=Mainselectfunc($slct,$array = array());
	$DOB = $row["DOB"];
	list($year,$month,$day) = explode("-",$DOB);
	$dobstr= $day."-".$month."-".$year;
	$CompanyName = trim($row["Company_Name"]);
	$Email = trim($row["Email"]);
	$Net_Salary = $row["Net_Salary"];
	$AnnIncome = intval($Net_Salary);
	$monthlyincome = round($AnnIncome/12);
	$Mobile_Number = trim($row["Mobile_Number"]);
	$Employment_Status = $row["Employment_Status"];
	$City = $row["City"];
	$citycode=GetCityCode(ucwords(strtolower($City)));
	if($Employment_Status==0)
	{
		$EmpType=2;
	}
	else
	{
		$EmpType=1;
	}
	
	if($Gender==1)
	{
		$title="1";
	}
	else
	{
		$title="2";
	}
	
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

		if(empty($last)){
			$errMsg .= 'LastName is empty'.'<br/>';
			$flag = 1;
		}elseif(strlen($last) > 15){
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
		}
		
		if(empty($Residence_Address)){
			$errMsg .= 'ResidenceAddress is empty'.'<br/>';
			$flag = 1;
		}elseif(strlen($Residence_Address) > 40){
			$errMsg .= 'ResidenceAddress: Max length is 40 chars'.'<br/>';
			$flag = 1;
		}
		
		if(empty($citycode)){
			$errMsg .= 'Please select valid city. RBL do not provide cards for this city.'.'<br/>';
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
		
		if(empty($panno)){
			$errMsg .= 'PAN is empty'.'<br/>';
			$flag = 1;
		}elseif(strlen($panno) != 10){
			$errMsg .= 'PAN should be of 10 numbers'.'<br/>';
			$flag = 1;
		}elseif(!preg_match("/^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}?$/", $panno)) {
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
	$dataArr['RequestID'] = $requestID;
	$dataArr['CreditCardApplied'] = $CreditCardApplied;
	$dataArr['Title'] = $title;
	$dataArr['FirstName'] = trim($first_name);
	$dataArr['LastName'] = trim($last);
	$dataArr['Gender'] = $Gender;
	$dataArr['DOB'] = $dobstr;
	$dataArr['ResAddress1'] = $Residence_Address;
	$dataArr['ResAddress2'] = '';
	$dataArr['ResCity'] = $citycode;
	$dataArr['ResPIN'] = trim($pincode);
	$dataArr['Email'] = trim($Email);
	$dataArr['Mobile'] = trim($Mobile_Number);
	$dataArr['EmpType'] = $EmpType;
	$dataArr['NMI'] = $monthlyincome;
	$dataArr['PAN'] = trim($panno);
	
	$extraDataArr = array();
	$extraDataArr['lead_source'] = $lead_source;

	$webserviceObj = new Webservices();
	$serviceResponse = $webserviceObj->RBLWebservice($dataArr, $extraDataArr, $ccba_id);
	//echo '<pre>';print_r($serviceResponse);
	
	$Status = $serviceResponse["Status"];
	$ReferenceCode = $serviceResponse["ReferenceCode"];
	$EligibleCard = $serviceResponse["EligibleCard"];
	$Errorcode = $serviceResponse["Errorcode"];
	$Errorinfo = $serviceResponse["Errorinfo"];
	$RequestIP = $serviceResponse["RequestIP"];
}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Instant E Apply Credit Cards Online in India- RBL</title>
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
<div class="common-bread-crumb" style="margin:auto; width:100%; margin-top:70px; color:#0a8bd9;"><u><a href="index.php" class="text12" style="color:#0080d6;" >Home</a></u> > <a href="credit-cards.php"  class="text12" style="color:#0080d6;"><u>Credit Card</u></a> <span style="color:#4c4c4c;">> RBL Bank Credit Card</span></div>
<div style="clear:both; height:10px;"></div>
<div style="clear:both; height:20px; width:100%; margin:auto; margin-top:10px; padding-top:10px; font-size:18px; color:#000; height:200px;">
Thank you for applying  for <? echo $card_name; ?>  through deal4loans, we will get back to you soon.
</div>
<?php
if($referencefrom=="website")
{
}
else
{
	//0: FAILURE/ERROR, 1: AIP APPROVED, 2: AIP REFER, 3: AIP REJECT
	if(isset($Status) && $Status==0)
	{
		echo "FAILURE/ERROR";
	}
	elseif($Status==1)
	{
		echo "AIP APPROVED";
	}
	elseif($Status==2)
	{
		echo "AIP REFER";
	}
	elseif($Status==3)
	{
		echo "AIP REJECT";
	}
	elseif(isset($Status) && $Status==''){
		echo "No Response From RBL";
	}

	if(!empty($ReferenceCode)){
		echo "Reference Code - ". $ReferenceCode;
	}

	echo "<br>".$Errorinfo;
}
?>
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
	
