<?php
$ReqID = $_REQUEST["postid"];
$BidID = $_REQUEST["biddt"];
$requestid = $_REQUEST["postid"];
$bidderid = $_REQUEST["biddt"];

error_reporting(E_ALL);
ini_set('display_error', 1);

//require 'scripts/session_check_online.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';
require 'webservices_functions.php';

/*
if($BidID!=6729)
{
	if($_SESSION['leadidentifier']=='amercianexpresscallerlms_cc' || $_SESSION['leadidentifier']=='amercianexpressinternalcallerlms_cc')
	{
		$updateqry= "Update lead_allocate set BidderID='".$BidID."' Where AllRequestID = '".$ReqID."' and BidderID=6843";
		$updateqryresult = d4l_ExecQuery($updateqry);
	}
	else if($_SESSION['leadidentifier']=='amexdigicallerlms_cc')
	{
		//Get Bidder ID FROM Profile for Digitech Only
		$getBidderIDQry = "SELECT BidderID FROM Bidders WHERE Profile = '".$BidID."' AND leadidentifier = 'amexdigicallerlms_cc'";
		$getBidderIDResult = d4l_ExecQuery($getBidderIDQry);
		$getBidderResponse = d4l_mysql_fetch_assoc($getBidderIDResult);
		$getBidderID = !empty($getBidderResponse['BidderID']) ? $getBidderResponse['BidderID'] : 0;
		if($getBidderID > 0){
			$bidderid = $getBidderID;
			$BidID = $getBidderID;
		}
		
		$updateqry= "Update lead_allocate set BidderID='".$getBidderID."' Where AllRequestID = '".$ReqID."' and BidderID=7194";
		$updateqryresult = d4l_ExecQuery($updateqry);
	}
	
}
*/
/*
$getAgentCheckSql = "select AllRequestID from lead_allocate Where AllRequestID = '".$ReqID."' and BidderID='".$BidID."'";
$getAgentCheckQuery = d4l_ExecQuery($getAgentCheckSql);
$getAgentCheckNumRows = d4l_mysql_num_rows($getAgentCheckQuery);
if($getAgentCheckNumRows>0) { }  else { echo "You are not authorised to view this details."; die(); }
*/


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	foreach($_POST as $a=>$b)
		$$a=$b;
	$RequestID = $_REQUEST["RequestID"];
	$first_name = trim($_POST["first_name"]);
	$middle_name = trim($_POST["middle_name"]);
	$last_name = trim($_POST["last_name"]);
	$Mobile_Number = trim($_POST["Mobile_Number"]);
	$Email = trim($_REQUEST["Email"]);
	$Gender = $_REQUEST["Gender"];
	$panno = trim($_REQUEST["panno"]);
	$alreadyicicicard= $_POST["alreadyicicicard"];
	$CC_Holder = $_POST["CC_Holder"];
	$selected_card_bank = $_POST["selected_card_bank"];
	$card_dtvalues = $_POST["card_dtvalues"];
	list($card_name,$card_id)=explode("_",$card_dtvalues);
	$ResidenceAddress1 = $_REQUEST["resiaddress1"];
	$ResidenceAddress2 = $_REQUEST["resiaddress2"];
	$ResidenceAddress3 = $_REQUEST["resiaddress3"];
	$City = $_REQUEST["City"];
	$pincode = trim($_REQUEST["ResiPin"]);
	$STD = trim($_REQUEST["resistdcode"]);
	$Phone_Number = trim($_REQUEST["resilandline"]);
	$Employment_Status = $_REQUEST["Employment_Status"];
	$CompanyName = $_POST["Company_Name"];
	$Net_Salary = $_REQUEST["Net_Salary"];
	$monthlyincome = round($Net_Salary/12);
	$total_experience = $_POST["total_experience"];
	$IciciRelationship = $_POST["IciciRelationship"];
	$relationship_number = $_POST["relationship_number"];
	$salaryaccountwithotherbank = $_POST["salaryaccountwithotherbank"];
	$salaryaccountopened = $_POST["salaryaccountopened"];
	$comment_section = $_POST["comment_section"];
	$ccfeedback = $_POST["ccfeedback"];
	$FollowupDate  = $_POST["FollowupDate"];
	$iciciapirun = $_POST["iciciapirun"];
	$State = $_POST["State"];
	//$State = GetStateCode($City);
	$lead_source="LMS";

	/* Name Logic Start */
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
	$Name=$first_name." ".$middle_name." ".$last_name;
	/* Name Logic End */
	
	/* Employment Logic Start */
	if($Employment_Status==0)
	{
		$EmpType="Salaried";
	}
	else
	{
		$EmpType="Selfemployed";
	}
	/* Employment Logic End */
	
	/* Gender Logic Start */
	if($Gender==2 || $Gender=="Female")
	{
		$Gender="Female";
	}
	else
	{
		$Gender="Male";
	}
	/* Gender Logic End */
	
	/* DOB Logic Start */
	$day = $_POST["day"];
	if(strlen($day)==1)
	{
		$dd="0".$day;
	}
	else
	{
		$dd=$day;
	}
	$month = $_POST["month"];
	if(strlen($month)==1)
	{
		$mm="0".$month;
	}
	else
	{
		$mm=$month;
	}
	$year = $_POST["year"];
	$DOB = $year."-".$mm."-".$dd;
	$dobstr = $dd."/".$mm."/".$year;
	/* DOB Logic End */
	
	/* Residence Address Logic Start */
	$ResidenceAddressArr = array('ResidenceAddress1'=>$ResidenceAddress1, 'ResidenceAddress2'=>$ResidenceAddress2, 'ResidenceAddress3'=>$ResidenceAddress3);
	$ResidenceAddressJson = json_encode($ResidenceAddressArr);
	
	$ResidenceAddressFull = $ResidenceAddress1.' '.$ResidenceAddress2.' '.$ResidenceAddress3;
	/* Residence Address Logic End */
	 
	$Dated=ExactServerdate();

	$icicicardsclause=" applied_card_name= '".$card_name."' ";

	//Update values in Req_Credit_Card table
	$updateUserDetailsSql="UPDATE Req_Credit_Card SET Name='".$Name."',DOB='".$DOB."', Gender='".$Gender."', Email='".$Email."',Net_Salary='".$Net_Salary."',Residence_Address ='".$ResidenceAddressFull."', Std_Code='".$STD."', Landline='".$Phone_Number."',Pancard='".$panno."', Employment_Status='".$Employment_Status."', Company_Name='".$CompanyName."', Total_Experience='".$total_experience."', Pincode='".$pincode."',CC_Holder='".$CC_Holder."',Applied_With_Banks='".$selected_card_bank."', City='".$City."', ".$icicicardsclause." Where (RequestID=".$RequestID.")";
	$updateUserDetailsResult=d4l_ExecQuery($updateUserDetailsSql);

	
	//Update values in credit_card_banks_apply table
	$getccbadetails="SELECT id FROM credit_card_banks_apply WHERE cc_requestid = '".$RequestID."' AND applied_bankname like '%ICICI%' order by id DESC";
	list($alreadyExist,$ccbarow)=Mainselectfunc($getccbadetails,$array = array());
	if($ccbarow['id'] > 0)
	{
		$DataArray = array("resi_address"=>$ResidenceAddressFull, "residence_address"=>$ResidenceAddressJson, "applied_bankname"=>"ICICI Bank", "applied_cardname" =>$card_name, "relation_with_bank" =>$IciciRelationship, "bank_relationship_number" =>$relationship_number, "lead_source"=>$lead_source);
		$wherecondition ="(id='".$ccbarow['id']."')";
		Mainupdatefunc("credit_card_banks_apply", $DataArray, $wherecondition);
		$ccba_id = $ccbarow['id'];
	}
	else
	{
		$DataArray= array("cc_requestid"=>$RequestID, "resi_address"=>$ResidenceAddressFull, "residence_address"=>$ResidenceAddressJson, "applied_bankname"=>"ICICI Bank", "applied_cardname" =>$card_name, "relation_with_bank" =>$IciciRelationship, "bank_relationship_number" =>$relationship_number, "lead_source"=>$lead_source, "date_created"=>$Dated);
		$ccba_id = Maininsertfunc("credit_card_banks_apply", $DataArray);
	}

	/* Save Feedback Start */
	if(strlen($ccfeedback)>0 || strlen($comment_section)>0)
	{
		$strSQL="";
		$Msg="";
		$result = d4l_ExecQuery("SELECT FeedbackID FROM Req_Feedback_CC WHERE AllRequestID=".$RequestID." AND BidderID=".$bidderid." AND Reply_Type=4");
		$num_rows = d4l_mysql_num_rows($result);
		if($num_rows > 0)
		{
			$row = d4l_mysql_fetch_array($result);
			$strSQL="UPDATE Req_Feedback_CC SET Feedback='".$ccfeedback."',comment_section='".$comment_section."',Followup_Date='".$FollowupDate."', last_updated=Now()";
			$strSQL=$strSQL."WHERE FeedbackID=".$row["FeedbackID"];
		}
		else
		{
			$strSQL="INSERT INTO Req_Feedback_CC (AllRequestID, BidderID, Reply_Type, Feedback, Followup_Date, comment_section, last_updated) Values (";
			$strSQL=$strSQL.$RequestID.",".$bidderid.",4,'".$ccfeedback."','".$FollowupDate."','".$comment_section."',Now())";
		}
		$result = d4l_ExecQuery($strSQL);
	}
	/* Save Feedback End */

	if($iciciapirun==1)
	{
		//ini_set('max_execution_time', 2000);
		
		try{
			$errMsg = "";
			$flag = 0;

			if(empty($first_name)){
				$errMsg .= 'FirstName is empty'.'<br/>';
				$flag = 1;
			}elseif(strlen($first_name) > 26){
				$errMsg .= 'FirstName: Max length is 26 chars'.'<br/>';
				$flag = 1;
			}elseif(!preg_match('/^[a-zA-Z\s]+$/',$first_name)){
				$errMsg .= 'FirstName can have letters only.'.'<br/>';
				$flag = 1;
			}
			
			if(!empty($middle_name)){
				if(strlen($middle_name) > 26){
					$errMsg .= 'MiddleName: Max length is 26 chars'.'<br/>';
					$flag = 1;
				}elseif(!preg_match('/^[a-zA-Z\s]+$/',$middle_name)){
					$errMsg .= 'MiddleName can have letters only.'.'<br/>';
					$flag = 1;
				}
			}

			if(empty($last_name)){
				$errMsg .= 'LastName is empty'.'<br/>';
				$flag = 1;
			}elseif(strlen($last_name) > 26){
				$errMsg .= 'LastName: Max length is 26 chars'.'<br/>';
				$flag = 1;
			}elseif(!preg_match('/^[a-zA-Z\s]+$/',$last_name)){
				$errMsg .= 'LastName can have letters only.'.'<br/>';
				$flag = 1;
			}
			
			/*
			if(empty($Email)){
				$errMsg .= 'Email is empty'.'<br/>';
				$flag = 1;
			}elseif(!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
				$errMsg .= 'Email format is invalid'.'<br/>';
				$flag = 1;
			}
			*/
			
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

			/*
			if(empty($Qualification)){
				$errMsg .= 'Qualification is empty'.'<br/>';
				$flag = 1;
			}
			*/
			
			if(empty($panno)){
				$errMsg .= 'PAN is empty'.'<br/>';
				$flag = 1;
			}elseif(strlen($panno) != 10){
				$errMsg .= 'PAN should be of 10 numbers'.'<br/>';
				$flag = 1;
			}elseif(!preg_match("/^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}?$/", $panno)){
				$errMsg .= 'PAN is invalid'.'<br/>';
				$flag = 1;
			}elseif(substr($panno, 3, 1) != 'P'){
				$errMsg .= 'Please enter a valid PAN Number.'.'<br/>';
				$flag = 1;
			}
			
			if(empty($monthlyincome)){
				$errMsg .= 'MonthlyIncome is empty'.'<br/>';
				$flag = 1;
			}elseif(!preg_match('/^[1-9][0-9]*$/', $monthlyincome)) {
				$errMsg .= 'MonthlyIncome: Please enter only numbers'.'<br/>';
				$flag = 1;
			}elseif(strlen($monthlyincome) > 7){
				$errMsg .= 'MonthlyIncome: Max length is 7 digits'.'<br/>';
				$flag = 1;
			}
			
			if(empty($ResidenceAddress1)){
				$errMsg .= 'ResidenceAddress1 is empty'.'<br/>';
				$flag = 1;
			}elseif(strlen($ResidenceAddress1) > 40){
				$errMsg .= 'ResidenceAddress1: Max length is 40 chars'.'<br/>';
				$flag = 1;
			}
			
			if(empty($ResidenceAddress2)){
				$errMsg .= 'ResidenceAddress2 is empty'.'<br/>';
				$flag = 1;
			}elseif(strlen($ResidenceAddress2) > 40){
				$errMsg .= 'ResidenceAddress2: Max length is 40 chars'.'<br/>';
				$flag = 1;
			}
			
			if(!empty($ResidenceAddress3) && (strlen($ResidenceAddress3) > 40)){
				$errMsg .= 'ResidenceAddress3: Max length is 40 chars'.'<br/>';
				$flag = 1;
			}
			
			if(empty($City)){
				$errMsg .= 'City is empty'.'<br/>';
				$flag = 1;
			}
			/*
			if(empty($ResiState)){
				$errMsg .= 'Please select valid residence city. AMEX do not provide cards for this city.'.'<br/>';
				$flag = 1;
			}
			*/
			if(empty($pincode)){
				$errMsg .= 'Pincode is empty'.'<br/>';
				$flag = 1;
			}elseif(strlen($pincode) != 6){
				$errMsg .= 'Pincode should be of 6 numbers'.'<br/>';
				$flag = 1;
			}elseif(!preg_match('/^[1-9][0-9]*$/', $pincode)){
				$errMsg .= 'Pincode: Please enter only numbers'.'<br/>';
				$flag = 1;
			}

			if(empty($EmpType)){
				$errMsg .= 'EmpType is empty'.'<br/>';
				$flag = 1;
			}

			if(($EmpType == 'Salaried') && empty($CompanyName)){
				$errMsg .= 'CompanyName is empty'.'<br/>';
				$flag = 1;
			}
			
			if(empty($STD)){
				$errMsg .= 'STD is empty'.'<br/>';
				$flag = 1;
			}elseif(!preg_match('/^[1-9][0-9]*$/', $STD)) {
				$errMsg .= 'STD: Please enter only numbers'.'<br/>';
				$flag = 1;
			}

			if(($EmpType == 'Salaried') && empty($total_experience)){
				$errMsg .= 'Total Experience is empty'.'<br/>';
				$flag = 1;
			}
			
			if(empty($IciciRelationship)){
				$errMsg .= 'Please select ICICI Relationship'.'<br/>';
				$flag = 1;
			}
			
			if(($IciciRelationship == 'Norelationship') && empty($salaryaccountwithotherbank)){
				$errMsg .= 'Salary Account opened with other bank is empty'.'<br/>';
				$flag = 1;
			}
			
			if(($IciciRelationship == 'Salary') && empty($salaryaccountopened)){
				$errMsg .= 'Salary Account opened is empty'.'<br/>';
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
		$dataArr['ChannelType'] = 'Deal4loans';
		$dataArr['ApplicantFirstName'] = trim($first_name);
		$dataArr['ApplicantMiddleName'] = trim($middle_name);
		$dataArr['ApplicantLastName'] = trim($last_name);
		$dataArr['Gender'] = $Gender;
		$dataArr['DateOfBirth'] = $dobstr;
		$dataArr['ResidenceAddress1'] = trim($ResidenceAddress1);
		$dataArr['ResidenceAddress2'] = trim($ResidenceAddress2);
		$dataArr['ResidenceAddress3'] = trim($ResidenceAddress3);
		$dataArr['City'] = trim($City);
		$dataArr['ResidencePincode'] = trim($pincode);
		$dataArr['ResidenceState'] = trim($ResiState);
		$dataArr['STDCode'] = $STD;
		$dataArr['ResidencePhoneNumber'] = trim($Phone_Number);
		$dataArr['ResidenceMobileNo'] = trim($Mobile_Number);
		$dataArr['PanNo'] = trim($panno);
		$dataArr['ICICIBankRelationship'] = trim($IciciRelationship);
		$dataArr['ICICIRelationshipNumber'] = trim($relationship_number);
		$dataArr['CustomerProfile'] = $EmpType;
		$dataArr['CompanyName'] = trim($CompanyName);
		$dataArr['SalaryAccountWithOtherBank'] = trim($salaryaccountwithotherbank);
		$dataArr['Total_Exp'] = trim($total_experience);
		$dataArr['Income'] = trim($monthlyincome);	
		$dataArr['SalaryAccountOpened'] = trim($salaryaccountopened);
		
		echo '<pre>';print_r($dataArr);exit;

		$extraDataArr = array();
		$extraDataArr['lead_source'] = $lead_source;

		//$webserviceObj = new Webservices();
		//$serviceResponse = $webserviceObj->ICICIWebservice($dataArr, $extraDataArr, $ccba_id);
		//echo '<pre>';print_r($serviceResponse);

	}
}

$followup_date="";
$getUserDetailsSql = "SELECT Office_Address, Gender, Pancard, Employment_Status, Dated, DOB, Name, Email, Company_Name, City, State, Mobile_Number, Net_Salary, Pincode, Total_Experience, IP_Address, applied_card_name, CC_Holder,Applied_With_Banks, Updated_Date, Std_Code, Landline, Feedback, comment_section, Followup_Date FROM Req_Credit_Card LEFT JOIN Req_Feedback_CC ON Req_Feedback_CC.AllRequestID=Req_Credit_Card.RequestID and Req_Feedback_CC.BidderID in (".$bidderid.") Where (RequestID=".$requestid.")";
$getUserDetailsResult = d4l_ExecQuery($getUserDetailsSql);
$getUserDetailsRow = d4l_mysql_fetch_assoc($getUserDetailsResult);
$applied_card_name = $getUserDetailsRow["applied_card_name"];
list($first_name,$middle_name,$last_name) = explode(" ",$getUserDetailsRow["Name"]);
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

$Gender = $getUserDetailsRow["Gender"];
$City = $getUserDetailsRow["City"];
$Feedback = $getUserDetailsRow["Feedback"];
list($year,$mm,$dd) = explode("-",$getUserDetailsRow["DOB"]);
$Pincode = $getUserDetailsRow["Pincode"];
$Email = $getUserDetailsRow["Email"];
$Mobile_Number = $getUserDetailsRow["Mobile_Number"];
$Employment_Status = $getUserDetailsRow["Employment_Status"];
$Net_Salary = $getUserDetailsRow["Net_Salary"];
$monthlyincome = $getUserDetailsRow["Net_Salary"]/12;
$Pancard = $getUserDetailsRow["Pancard"];
$Feedback = $getUserDetailsRow["Feedback"];
$CompanyName = $getUserDetailsRow["Company_Name"];
$followup_date = $getUserDetailsRow["Followup_Date"];
$comment_section = $getUserDetailsRow["comment_section"];
$Std_Code = $getUserDetailsRow["Std_Code"];
$Landline = $getUserDetailsRow["Landline"];
$Office_Address= $getUserDetailsRow["Office_Address"];
$CC_Holder = $getUserDetailsRow["CC_Holder"];
$Applied_With_Banks = $getUserDetailsRow["Applied_With_Banks"];
$Updated_Date = $getUserDetailsRow["Updated_Date"];
$Total_Experience = $getUserDetailsRow["Total_Experience"];

$needle = 'ICICI';
if (strpos($applied_card_name,$needle) !== false) {
	$alreadyicicicard=1;
    echo '<center><b>SELECTED ICICI CARD</b></center>';
}
else
{
	$alreadyicicicard=0;
}

$getUserExtraDetailsSql = "SELECT * FROM credit_card_banks_apply WHERE (cc_requestid = '".$requestid."' AND applied_bankname LIKE '%ICICI%')";
$getUserExtraDetailsResult = d4l_ExecQuery($getUserExtraDetailsSql);
$getUserExtraDetailsRow = d4l_mysql_fetch_array($getUserExtraDetailsResult);
$Residence_Address = $getUserExtraDetailsRow["residence_address"];
$IciciRelationship = $getUserExtraDetailsRow["relation_with_bank"];
$relationship_number = $getUserExtraDetailsRow["bank_relationship_number"];

$Residence_Address = json_decode($Residence_Address, true);
$Residence_Address1 = $Residence_Address['ResidenceAddress1'];
$Residence_Address2 = $Residence_Address['ResidenceAddress2'];
$Residence_Address3 = $Residence_Address['ResidenceAddress3'];

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


//GET ICICI City List
$getIciciCitySql = "SELECT city FROM icici_cc_city_state_list GROUP BY city ORDER BY city ASC";
$getIciciCityResult = d4l_ExecQuery($getIciciCitySql);
$CityArr = array();
while($getIciciCityRow = d4l_mysql_fetch_assoc($getIciciCityResult)){
	$CityArr[] = $getIciciCityRow['city'];
}
//echo '<pre>';print_r($CityArr);exit;


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Credit Card</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script language="javascript" type="text/javascript" src="scripts/datetime.js"></script>
<script src="js/jquery-2.1.4.min.js" type="text/javascript"></script>
<style type="text/css">
/* Big box with list of options */
#ajax_listOfOptions {
	position: absolute;	/* Never change this one */
	width: 260px;	/* Width of box */
	height: 160px;	/* Height of box */
	overflow: auto;	/* Scrolling features */
	border: 1px solid #317082;	/* Dark green border */
	background-color: #FFF;	/* White background color */
	color: black;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	text-align: left;
	font-size: 10px;
	z-index: 50;
}
#ajax_listOfOptions div {	/* General rule for both .optionDiv and .optionDivSelected */
	margin: 1px;
	padding: 1px;
	cursor: pointer;
	font-size: 10px;
}
#ajax_listOfOptions .optionDivSelected { /* Selected item in the list */
	background-color: #2375CB;
	color: #FFF;
}
#ajax_listOfOptions_iframe {
	background-color: #F00;
	position: relative;
	z-index: 5;
}
form {
	display: inline;
}
</style>
<style type="text/css">
.alert_msg {
font-family: Verdana, Arial, Helvetica, sans-serif; 
    color: #FF0000;
    font-weight: bold;
    font-size: 10px;
}
</style>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script language="javascript">
$(document).ready(function(){

	$('input[name=CC_Holder]').on('change',function(){
		if($(this).val() == 2){
			 $("td[class='card_bank']").hide();
			 $('#selected_card_bank').val('');
		}else{
			$("td[class='card_bank']").show();
		}
	});
	
});

</script>
</head>
<body>
<form name="loan_form" method="post" action="<? echo $_SERVER['PHP_SELF']; ?>?postid=<?echo $requestid;?>&biddt=<? echo $bidderid;?>" >
<input type="hidden" name="RequestID" value="<? echo $requestid;?>" />
<input type="hidden" name="Mobile_Number" value="<? echo $Mobile_Number;?>" />
<input type="hidden" name="alreadyicicicard" value="<? echo $alreadyicicicard;?>" />
<table cellpadding="0" cellspacing="0" align="center">
<tr><td>
<table style='border:1px dotted #9C9A9C;' cellspacing="0" cellpadding="5" width="700" height="80%" align="center" border="1" >
<tr><td colspan="4" align="center" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; height:25px;">ICICI Credit Card Customer Details
</td></tr>
<tr>
    <td width="180"><span class="style2">Customer Name: </span></td>
    <td width="392" colspan="3">
		<span class="style21">
			<input type="text" maxlength="26" size="13" name="first_name" id="first_name" value="<? echo $first_name; ?>" />&nbsp;<input type="text" maxlength="26" size="11" name="middle_name" id="middle_name" value="<? echo $middle_name; ?>"/>&nbsp;<input type="text" maxlength="26" size="17" name="last_name" id="last_name" value="<? echo $last_name; ?>" />
		</span>
	</td>
</tr>
<tr>
	<td><span class="style2"> Mobile No: </span></td>
	<td><span class="style21"><? if($_SESSION['BidderID']==6729) { echo $Mobile_Number; } else { echo "XXXXXXXXXX"; } ?></span></td>
	<td><span class="style2"> Email: </span></td>
	<td><span class="style21">
		<input type="text" value="<? echo $Email; ?>" name="Email" id="Email" />
	</td>
</tr>
<tr>
	<td><span class="style2"> DOB: </span></td>
	<td><span class="style21">
		<?php echo listbox_date('day',$dd);?>
		<?php echo listbox_month('month', $mm);?>
		<?php $minage= Date('Y')-18; $maxage=Date('Y')-65; echo listbox_year('year',$maxage,$minage, $year);?>
		</span>
	</td>
	<td><span class="style2"> Gender: </span></td>
	<td><span class="style21">
		<select name="Gender" id="Gender" >
			<option value="-1">Please Select</option>
			<option value="Male" <? if($Gender=="Male" || $Gender==1) {echo "selected";} ?>>Male</option>
			<option value="Female" <? if($Gender=="Female" || $Gender==2) {echo "selected";} ?>>Female</option>
		</select></span>
	</td>
</tr>    
<tr>
	<td><span class="style2">PanCard No</span></td>
    <td>
		<input type="text" class="d4l-input" name="panno" id="panno" value="<? echo $Pancard; ?>"  maxlength="10"/>
	</td>
	<td><!--Qualification--></td>
	<td>
		<!--<select name="Qualification" id="Qualification" class="mobile-ui-input qualification-icon input-bottom-margin" onchange="validateDiv('QualificationVal');">
			<option value="">Select Qualification</option>
			<option value="U" <?php if($Qualification=="U") { echo "Selected"; } ?>>Under Graduate</option>
			<option value="B" <?php if($Qualification=="B") { echo "Selected"; } ?>>Graduate / Diploma</option>
			<option value="M" <?php if($Qualification=="M") { echo "Selected"; } ?>>Post Graduate</option>
			<option value="D" <?php if($Qualification=="D") { echo "Selected"; } ?>>Professional</option>
			<option value="O" <?php if($Qualification=="O") { echo "Selected"; } ?>>Others</option>
		</select>
		-->
	</td>
</tr>
<tr>
  	<td><span class="style2">Select Card</span></td>
    <td>
		<select name="card_dtvalues" id="card_dtvalues">
			<option value="">Please select </option>
			<?php $getcardNameSql = "SELECT cc_bankid,cc_bank_name FROM `credit_card_banks_eligibility` WHERE (`cc_bank_name` like '%ICICI%' and `cc_bank_flag`=1) group by `cc_bank_name`";
			list($numRowsCardName,$getCardNameQuery)=MainselectfuncNew($getcardNameSql,$array = array());
			for($cN=0;$cN<$numRowsCardName;$cN++)
			{
				$Card_id = $getCardNameQuery[$cN]['cc_bankid'];
				$cc_bank_name = $getCardNameQuery[$cN]['cc_bank_name'];
				?>
				  <option value="<?php echo $cc_bank_name."_".$Card_id; ?>" <?php if(trim($cc_bank_name)==trim($applied_card_name)) { echo "Selected";} ?>><?php echo ucwords(strtolower($cc_bank_name)); ?></option>
			<?php
			}
			?>
		</select>
	</td>
	<td><span class="style2">Selected Card</span></td>
	<td><?php echo $applied_card_name; ?></td>
</tr>
<tr>
	<td><span class="style2">Do you hold any card?</span></td>
	<td>
		<input type="radio" id="CC_Holder" name="CC_Holder" value="1" class="css-checkbox" <?php if($CC_Holder==1) { echo "checked";} ?>>Yes</input>
		<input type="radio" id="CC_Holder" name="CC_Holder" value="2" class="css-checkbox" <?php if($CC_Holder==2 || $CC_Holder==0) { echo "checked";} ?>>No</input>
	</td>
	<td class="card_bank" <?php if($CC_Holder==1){?>style="display:table-cell;"<?php }else{?>style="display:none;"<?php } ?>><span class="style2">Select Card Bank</span></td>
	<td class="card_bank" <?php if($CC_Holder==1){?>style="display:table-cell;"<?php }else{?>style="display:none;"<?php } ?>><span class="style21">
		<select name="selected_card_bank" id="selected_card_bank">
			<option value="">Please Select</option>
			<option value="AMEX" <?php if($Applied_With_Banks=='AMEX') { echo "selected";} ?>>AMEX</option>
			<option value="SBI" <?php if($Applied_With_Banks=='SBI') { echo "selected";} ?>>SBI</option>
			<option value="ICICI" <?php if($Applied_With_Banks=='ICICI') { echo "selected";} ?>>ICICI</option>
			<option value="RBL" <?php if($Applied_With_Banks=='RBL') { echo "selected";} ?>>RBL</option>
			<option value="SCB" <?php if($Applied_With_Banks=='SCB') { echo "selected";} ?>>Standard Chartered Bank</option>
			<option value="Others" <?php if($Applied_With_Banks=='Others') { echo "selected";} ?>>Others</option>
		</select></span>
	</td>
</tr>
<tr>
	<td colspan="4" align="center" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; height:25px;">Residence details</td>
</tr>
<tr>
	<td><span class="style2"> Residence Address1: </span></td>
	<td colspan="3"><span class="style21" >
		<input type="text" maxlength="80" size=70 name="resiaddress1" id="resiaddress1" value="<? echo $Residence_Address1; ?>"  />&nbsp;</span>
	</td>
</tr>
<tr>
	<td><span class="style2"> Residence Address2: </span></td>
	<td colspan="3"><span class="style21" >
		<input type="text" maxlength="80" size=70 name="resiaddress2" id="resiaddress2" value="<? echo $Residence_Address2; ?>"  />&nbsp;</span>
	</td>
</tr>
<tr>
	<td><span class="style2"> Residence Address3: </span></td>
	<td colspan="3"><span class="style21" >
		<input type="text" maxlength="80" size=70 name="resiaddress3" id="resiaddress3" value="<? echo $Residence_Address3; ?>"  />&nbsp;</span>
	</td>
</tr>
<tr>
	<td><span class="style2">Residence City: </span></td>
    <td><span class="style21">
		<select size="1" name="City" id="City">
			<option value="">Please Select</option>
			<?php
			$getIciciCitySql = "SELECT city FROM icici_cc_city_state_list GROUP BY city ORDER BY city ASC";
			list($citynumrows,$CityArr)=MainselectfuncNew($getIciciCitySql,$array = array());
			foreach($CityArr as $key=>$cityval)
			{
			?>
			<option value="<?php echo $cityval['city']; ?>" <?php if($cityval['city']==$City) { echo "selected"; }?>><?php echo $cityval['city']; ?></option>
			<?php
			}
			?>
		</select></span>
	</td>  
	<td><span class="style2">Residence State: </span></td>
    <td><span class="style21">
		<select size="1" name="State" id="State">  
			<option value="">Please Select</option>
			<?php
			$getStateSql = "SELECT state FROM icici_cc_city_state_list GROUP BY state ORDER BY state ASC";
			list($statenumrows,$statelist)=MainselectfuncNew($getStateSql,$array = array());
			foreach($statelist as $key=>$stateval)
			{
			?>
				<option value="<?php echo $stateval['state']; ?>" <? if($stateval['state']==$State) {echo "selected";} ?> ><?php echo $stateval['state']; ?></option>   
			<?php
			}
			?>
		</select></span>
	</td>
</tr>  
<tr>
	<td><span class="style2"> Resi pincode: </span></td>
	<td id="txtResiHint"><span class="style21">
		<select name="ResiPin" id="ResiPin" class="d4l-select">
			<?
			$getPinSql = "SELECT pincode FROM icici_cc_city_state_list WHERE city = '".$City."' ORDER BY pincode ASC";
			list($pincodenumrows,$pincodelist)=MainselectfuncNew($getPinSql,$array = array());
			foreach($pincodelist as $key=>$pinval)
			{
			?>
				<option value="<?php echo $pinval['pincode']; ?>" <? if($pinval['pincode']==$Pincode) {echo "selected";} ?> ><?php echo $pinval['pincode']; ?></option>   
			<?php
			}
			?>
			<option value="">Select City first</option>
		</select></span>
	</td>
	<td><span class="style2">Residence Landline Number</span></td>
	<td><span class="style21">
		<input type="text" name="resistdcode" id="resistdcode" value="<?php echo $Std_Code; ?>" maxlength="4" onKeyPress="intOnly(this);" placeholder="STD" style="width: 20%;" />
		&nbsp;
		<input type="text" name="resilandline" id="resilandline" value="<?php echo $Landline; ?>" maxlength="10" onKeyPress="intOnly(this);" placeholder="Number" style="width: 50%;" /></span>
	</td>
</tr>
<tr>
	<td colspan="4" align="center" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; height:25px;">Professional details</td>
</tr>
<tr>
	<td><span class="style2"> Occupation: </span></td>
	<td><span class="style21">
		<select name="Employment_Status" id="Employment_Status" >
			<option value="">Please Select</option>
			<option value="0" <? if($Employment_Status==1) {echo "Selected";}?>>Salaried</option>
			<option value="1" <? if($Employment_Status==0) {echo "Selected";}?>>Self Employment</option>
		</select></span>
	</td>
	<td><span class="style2"> Company Name: </span></td>
	<td><span class="style21">
		<input name="Company_Name" id="Company_Name" type="text" class="d4l-input" onkeyup="ajax_showOptions(this,'getCountriesByLetters',event)" style="width:200px;" maxlength="24" value="<? echo $CompanyName; ?>" /></span>
	</td>
</tr>   
<tr>
	<td><span class="style2"> Annual Income: </span></td>
	<td><span class="style21">
		<input type="text" name="Net_Salary" id="Net_Salary" maxlength="7" value="<? echo $Net_Salary; ?>" onKeyPress="intOnly(this);"/></span>
	</td>
	<td><span class="style2"> Total Exp: </span></td>
	<td><span class="style21">
		<input type="text" name="total_experience" id="total_experience" maxlength="7" value="<? echo $Total_Experience; ?>" onKeyPress="intOnly(this);"/></span>
	</td>
</tr>
<tr>
	<td><span class="style2"> ICICI Bank Relationship: </span></td>
	<td><span class="style21">
		<select name="IciciRelationship" id="IciciRelationship" class="mobile-ui-input qualification-icon input-bottom-margin">
			<option value="">Select Relationship</option>
			<option value="Salary" <?php if($IciciRelationship=='Salary') { echo "Selected"; } ?> >Salary</option>
			<option value="Saving" <?php if($IciciRelationship=='Saving') { echo "Selected"; } ?>>Saving</option>
			<option value="Loan" <?php if($IciciRelationship=='Loan') { echo "Selected"; } ?>>Loan</option>
			<option value="Norelationship" <?php if($IciciRelationship=='Norelationship') { echo "Selected"; } ?>>Norelationship</option>
		</select></span>
	</td>
	<td><span class="style2"> ICICI Relationship No: </span></td>
	<td><span class="style21">
		<input type="text" name="relationship_number" id="relationship_number" maxlength="16" value="<? echo $relationship_number; ?>"/></span>
	</td>
</tr>
<tr>
	<td><span class="style2"> Salary Account With Other Bank: </span></td>
	<td><span class="style21">
		<select name="salaryaccountwithotherbank" id="salaryaccountwithotherbank" class="mobile-ui-input qualification-icon input-bottom-margin">
			<option value="">Please Select</option>
			<option value="Yes">Yes</option>
			<option value="No">No</option>
		</select></span>
	</td>
	<td><span class="style2"> Salary Account Opened: </span></td>
	<td><span class="style21">
		<select name="salaryaccountopened" id="salaryaccountopened" class="mobile-ui-input qualification-icon input-bottom-margin">
			<option value="">Please Select</option>
			<option value="Above2Months">> 2 Months</option>
			<option value="Below2Months"><= 2 Months</option>
		</select></span>
	</td>
</tr>
<tr>
	<td colspan="4" align="center" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; height:25px;">Feedback details</td>
</tr>
<tr>
	<td><span class="style2">LMS Comments: </span></td>
	<td><span class="style21">
		<textarea rows="2" cols="15" name="comment_section"><? echo $comment_section; ?></textarea></span>
	</td>   
	<td><span class="style2">LMS feedback </span></td>
	<td><span class="style21">
		<select name="ccfeedback" id="ccfeedback">
			<option value="" <? if($Feedback == "") { echo "selected"; }?>>No Feedback</option>
			<option value="Other Product" <? if($Feedback == "Other Product") { echo "selected"; }?>>Other Product</option>
			<option value="Not Interested" <? if($Feedback == "Not Interested") { echo "selected"; }?>>Not Interested</option>
			<option value="Callback Later" <? if($Feedback == "Callback Later") { echo "selected"; }?>>Callback Later</option>
			<option value="Wrong Number" <? if($Feedback == "Wrong Number") { echo "selected"; }?>>Wrong Number</option>
			<option value="Send Now" <? if($Feedback == "Send Now") { echo "selected"; }?>>Send Now</option>
			<option value="Not Eligible" <? if($Feedback == "Not Eligible") { echo "selected"; }?>>Not Eligible</option>
			<option value="Duplicate" <? if($Feedback == "Duplicate") { echo "selected"; }?>>Duplicate</option>
			<option value="Not Contactable" <? if($Feedback == "Not Contactable") { echo "selected"; }?>>Not Contactable</option>
			<option value="Ringing" <? if($Feedback == "Ringing") { echo "selected"; }?>>Ringing</option>
			<option value="FollowUp" <? if($Feedback == "FollowUp") { echo "selected"; }?>>FollowUp</option>
			<option value="Not Applied" <? if($Feedback == "Not Applied") { echo "selected"; }?>>Not Applied</option>
			<option value="Process" <? if($Feedback == "Process") { echo "selected"; }?>>Cibil ok</option>
			<option value="Closed" <? if($Feedback == "Closed") { echo "selected"; }?>>Cibil Reject</option>
		</select></span>
	</td>
</tr>	
<tr>
	<td class="fontstyle"><b>Follow Up Date</b></td>
	<td class="fontstyle">
		<input type="Text"  name="FollowupDate" id="FollowupDate" maxlength="25" size="15" <?php if($followup_date !='0000-00-00 00:00:00') { ?>value="<?php  echo $followup_date; ?>" <?php } ?> /><a href="javascript:NewCal('FollowupDate','yyyymmdd',true,24)"><img src="images/cal.gif" width="16" height="16" border="0" alt="Pick a date" /></a>
	</td>
	<td width="180"><span class="style2">Date of entry: </span></td>
	<td width="392"><span class="style21"><? echo $Updated_Date; ?></span></td>
</tr> 
<tr>
	<td colspan="4">
		<input type="checkbox" value="1" name="iciciapirun" />ICICI Webservice Run
	</td>
</tr>
<tr>
	<td colspan="4" align="center"><input type="Submit" name="Submit" value="Submit" style="background-color:#529BE4;" /></td>
</tr>
</table>
</form>
</td></tr>
<tr><td>
<table style='border:1px dotted #9C9A9C;' cellspacing="0" cellpadding="5" width="100%" height="80%" align="center" border="1" >
<tr>
	<td colspan="4" align="right">
	</td>
</tr>
<tr>
	<td colspan="4">
	<?php
	$cc_alldetailsqry = d4l_ExecQuery("SELECT request_data, response_data FROM credit_card_banks_apply WHERE (applied_bankname LIKE '%ICICI%' AND cc_requestid='".$requestid."') ORDER BY date_created DESC LIMIT 0,1");
	$ccal=d4l_mysql_fetch_array($cc_alldetailsqry);
	$requestdata=trim($ccal["request_data"]);
	$responsedata=trim($ccal["response_data"]);
	$xmlArray = str_ireplace('<soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema"><soap:Body>','',$responsedata);
	$xmlArray = str_ireplace('</soap:Body></soap:Envelope>','',$xmlArray);
	//$xmlArray = str_ireplace(['SOAP-ENV:', 'SOAP:'], '', $responsedata);
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
	if(!empty($requestdata) && isset($responsedata) && empty($responsedata)){
		echo "No Response From Amex.<br>";
	}
	?>
	</td>
</tr>
</table>
</td></tr>
</table>
<script>
$(document).ready(function(){
	$('#City').on('change',function(){
		var city = $(this).val();
		
		if (city == ""){
			$('#txtResiHint').html('');
			return;
		}
		$.ajax({
			type: 'POST',
			url: 'geticicibank-pincode.php',
			data: {
				city: city,
				dataType:'html',
			},
			success: function (response) {
				console.log(response);
				$('#txtResiHint').html(response);
			}
		});
	});
});
</script>
</body>
</html>
<?php

function GetStateCode($City){
    $getStateSql = "SELECT city, state FROM icici_cc_city_state_list GROUP BY city HAVING city LIKE '%".$City."%'";
    $getStateResult = d4l_ExecQuery($getStateSql);
	$getStateResponse = d4l_mysql_fetch_assoc($getStateResult);
    $State = (isset($getStateResponse['state']) && !empty($getStateResponse['state'])) ? $getStateResponse['state'] : '';
    return $State;
}

?>
