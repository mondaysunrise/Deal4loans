<?php
$ReqID = $_REQUEST["postid"];
$BidID = $_REQUEST["biddt"];
$requestid = $_REQUEST["postid"];
$bidderid = $_REQUEST["biddt"];

require 'scripts/session_check_online.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';
require 'webservices_functions.php';

$IP_Remote = $_SERVER["REMOTE_ADDR"];
if ($IP_Remote == '192.124.249.12' || $IP_Remote == '185.93.228.12') {
    $IP = $_SERVER['HTTP_X_SUCURI_CLIENTIP'];
} else {
    $IP = $IP_Remote;
}


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

$getAgentCheckSql = "select AllRequestID from lead_allocate Where AllRequestID = '".$ReqID."' and BidderID='".$BidID."'";
$getAgentCheckQuery = d4l_ExecQuery($getAgentCheckSql);
$getAgentCheckNumRows = d4l_mysql_num_rows($getAgentCheckQuery);
/*if($getAgentCheckNumRows>0) { }  else { echo "You are not authorised to view this details."; die(); }*/


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	foreach($_POST as $a=>$b)
		$$a=$b;
	$RequestID = $_REQUEST["RequestID"];
	$first_name = trim($_POST["first_name"]);
	$middle_name = trim($_POST["middle_name"]);
	$last_name = trim($_POST["last_name"]);
	$Email = trim($_REQUEST["Email"]);
	$Gender = $_REQUEST["Gender"];
	$panno = trim($_REQUEST["panno"]);
	$Mobile_Number = trim($_POST["Mobile_Number"]);
	$Qualification = $_POST["Qualification"];
	$Phone_Numberwithstd = $_POST["resilandline"];
	$stdwithphone=split_on($Phone_Numberwithstd, 4);
	$STD = $stdwithphone[0];
	$Phone_Number = $stdwithphone[1];
	$alreadyamexcard= $_POST["alreadyamexcard"];
	$CC_Holder = $_POST["CC_Holder"];
	$selected_card_bank = $_POST["selected_card_bank"];
	
	$City = $_REQUEST["City"];
	$City = GetAmexCity($City);
	$City_Other = $_REQUEST["City_Other"];
	$City_Other = GetAmexCity($City_Other);
	$resiaddress1 = $_REQUEST["resiaddress1"];
	$Residence_Address = $resiaddress1;
	$strresiadd = round((strlen($resiaddress1)/2));
	$resiadd = str_split($resiaddress1, $strresiadd);
	$ResidenceAddress1 = substr(trim($resiadd[0]),0,23);
	$ResidenceAddress2 = substr(trim($resiadd[1]),0,23);
	$pincode = trim($_REQUEST["ResiPin"]);
	$OfficeCity = $_REQUEST["office_city"];
	$OfficeCity = GetAmexCity($OfficeCity);
	$OfficeState = GetStateCode(ucwords(strtolower($OfficeCity)));
	$officeddress = $_REQUEST["officeddress"];
	$strofficeadd = round((strlen($officeddress)/2));
	$officeadd = str_split($officeddress, $strofficeadd);
	$OfficeAddress1 = substr(trim($officeadd[0]),0,23);
	$OfficeAddress2 = substr(trim($officeadd[1]),0,23);
	$OfficePin = trim($_REQUEST["OfficePin"]);
	
	$Net_Salary = $_REQUEST["Net_Salary"];
	$monthlyincome = round($Net_Salary/12);
	$CompanyName = $_POST["Company_Name"];
	$CompanyName = substr(trim($CompanyName),0,24);
	$BillingPrefernce = $_POST["BillingPrefernce"];
	$comment_section = $_POST["comment_section"];
	$ccfeedback = $_POST["ccfeedback"];
	$FollowupDate  = $_POST["FollowupDate"];
	$card_dtvalues = $_POST["card_dtvalues"];
	list($card_name,$card_id)=explode("_",$card_dtvalues);

	$amexapirun = $_POST["amexapirun"];
	$lead_source="LMS";

	$Employment_Status = $_REQUEST["Employment_Status"];
	if($Employment_Status==0)
	{
		$EmpType="SE";
	}
	else
	{
		$EmpType="E";
	}

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
	$dobstr= $mm."-".$dd."-".$year;
	$Dated=ExactServerdate();
 
	if(strlen($City)>0)
	{
		$cityclause=", City='".$City."'";
		if(strlen($City_Other)>0)
		{
			$othercityclause=", City_Other='".$City_Other."'";
		}
	}
	if($City=="Others")
	{
		$calcity=$City_Other;
	}
	else
	{
		$calcity=$City;
	}
	$ResiState = GetStateCode(ucwords(strtolower($calcity)));
	if($Gender==2) {
		$Gender="Female";
	}
	else
	{
		$Gender="Male";
	}

	//if($alreadyamexcard==1)
	//{
		$amexcardsclause="";
	//}
	//else
	//{
		//$amexcardsclause=" applied_card_name= CONCAT( applied_card_name, ', ".$card_name."')";
		$amexcardsclause="  applied_card_name= '".$card_name."' ";
	//}

	$upcctblenw="Update Req_Credit_Card set Name='".$Name."',DOB='".$DOB."', Gender='".$Gender."', Email='".$Email."',Net_Salary='".$Net_Salary."',Residence_Address ='".$Residence_Address."', Std_Code='".$STD."', Landline='".$Phone_Number."',Pancard='".$panno."', Employment_Status='".$Employment_Status."', Company_Name='".$CompanyName."', Pincode='".$pincode."',CC_Holder='".$CC_Holder."',Applied_With_Banks='".$selected_card_bank."', Office_Address='".$officeddress."', ".$amexcardsclause." ".$cityclause." ".$othercityclause." Where (RequestID=".$RequestID.")";
	$resulupcctblenw=d4l_ExecQuery($upcctblenw);
	
	// FETCH CARD WITH ID
	if($card_id==46) {
		$chosenCard="gold";
	} elseif($card_id==47){
		$chosenCard="platinumTravel";
	} elseif($card_id==50){
		$chosenCard="makeMyTrip";
	} elseif($card_id==71){
		$chosenCard="membershipreward";
	} else{
		$chosenCard="membershipreward";
	}
	
	//Update values in credit_card_banks_apply table
	$getdetails="select id From credit_card_banks_apply Where ( cc_requestid='".$RequestID."' and applied_bankname like '%American Express%') order by id DESC";
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
		$DataArray= array("cc_requestid"=>$RequestID, "qualification" => $Qualification, "billing_preference" =>$BillingPrefernce, "office_city"=> $OfficeCity, "office_pincode"=> $OfficePin, "applied_bankname"=>"American Express", "applied_cardname" =>$chosenCard, "lead_source"=>$lead_source, "date_created"=>$Dated);
		$ccba_id = Maininsertfunc("credit_card_banks_apply", $DataArray);
	}

	//Save Feedback
	if(strlen($ccfeedback)>0 || strlen($comment_section)>0)
	{
		$strSQL="";
		$Msg="";
		$result = d4l_ExecQuery("select FeedbackID,not_contactable_counter from Req_Feedback_CC where AllRequestID=".$RequestID." and BidderID=".$bidderid." AND Reply_Type=4");
		$num_rows = d4l_mysql_num_rows($result);
		if($num_rows > 0)
		{
			$row = d4l_mysql_fetch_array($result);
			$strSQL="Update Req_Feedback_CC Set Feedback='".$ccfeedback."',comment_section='".$comment_section."',Followup_Date='".$FollowupDate."', last_updated=Now()";
			$strSQL=$strSQL."Where FeedbackID=".$row["FeedbackID"];
		}
		else
		{
			$strSQL="Insert into Req_Feedback_CC(AllRequestID, BidderID, Reply_Type , Feedback, Followup_Date,comment_section,last_updated) Values (";
			$strSQL=$strSQL.$RequestID.",".$bidderid.",4,'".$ccfeedback."','".$FollowupDate."','".$comment_section."',Now())";
		}
		//echo $strSQL;
		$result = d4l_ExecQuery($strSQL);
		if ($result == 1)
		{
		}
		else
		{
			$Msg = "** There was a problem in adding your feedback. Please try again.";
		}
	}

	if($amexapirun==1)
	{
		ini_set('max_execution_time', 2000);

		if($Gender==2) {
			$Gender="Female";
		}else
		{
			$Gender="Male";
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
			}
			*/
			
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

		$webserviceObj = new Webservices();
		$serviceResponse = $webserviceObj->AmexWebservice($dataArr, $extraDataArr, $ccba_id);
		//echo '<pre>';print_r($serviceResponse);

	}
}

$followup_date="";
$ccdetails = "select Office_Address,Gender,Pancard_No,Pancard,Employment_Status,Dated,DOB,Name,Email,Company_Name,City,City_Other,Mobile_Number,Net_Salary,Loan_Amount,Pincode,IP_Address,Add_Comment,Residence_Address,applied_card_name,CC_Holder,Applied_With_Banks,Updated_Date,Std_Code, Landline, Feedback,comment_section,Followup_Date from Req_Credit_Card LEFT OUTER JOIN Req_Feedback_CC ON Req_Feedback_CC.AllRequestID=Req_Credit_Card.RequestID and Req_Feedback_CC.BidderID in (".$bidderid.") Where (RequestID=".$requestid.")";

//echo $ccdetails."<br>";
$ccdetailsresult = d4l_ExecQuery($ccdetails);
$ccrow=d4l_mysql_fetch_array($ccdetailsresult);
$applied_card_name = $ccrow["applied_card_name"];
list($first_name,$middle_name,$last_name) = explode(" ",$ccrow["Name"]);
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

$Gender = $ccrow["Gender"];
$Feedback = $ccrow["Feedback"];
list($year,$mm,$dd) = explode("-",$ccrow["DOB"]);
$Residence_Address = $ccrow["Residence_Address"];
$Residence_Address = str_ireplace('|','',$Residence_Address);
$Pincode = $ccrow["Pincode"];
$Email = $ccrow["Email"];
$Mobile_Number = $ccrow["Mobile_Number"];
$Employment_Status = $ccrow["Employment_Status"];
$Net_Salary = $ccrow["Net_Salary"];
$monthlyincome = $ccrow["Net_Salary"]/12;
$Pancard = $ccrow["Pancard"];
$Feedback= $ccrow["Feedback"];
$CompanyName= $ccrow["Company_Name"];
$followup_date= $ccrow["Followup_Date"];
$comment_section= $ccrow["comment_section"];
$Std_Code= $ccrow["Std_Code"];
$Landline= $ccrow["Landline"];
$Office_Address= $ccrow["Office_Address"];
$resilandline=$Std_Code."".$Landline;
$CC_Holder = $ccrow["CC_Holder"];
$Applied_With_Banks = $ccrow["Applied_With_Banks"];

$needle = 'American';
if (strpos($applied_card_name,$needle) !== false) {
	$alreadyamexcard=1;
    echo '<center><b>SELECTED Amex CARD</b></center>';
}
else
{
	$alreadyamexcard=0;
}
$City = $ccrow["City"];
$City_Other = $ccrow["City_Other"];

$result = d4l_ExecQuery("select office_city,office_pincode,billing_preference,qualification from credit_card_banks_apply where (cc_requestid=".$requestid." and applied_bankname like '%American%')");
$num_rows = d4l_mysql_num_rows($result);
if($num_rows > 0)
{	
	$amexrow = d4l_mysql_fetch_array($result);
	$OfficePin = $amexrow["office_pincode"];
	$BillingPrefernce = $amexrow["billing_preference"];
	$Qualification = $amexrow["qualification"];
	$officecity = $amexrow["office_city"];
}


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

if((strlen($first_name)<2 || strlen($first_name)>15) ||
(strlen($last_name)<2 || strlen($last_name)>15) ||
(strlen($Email)<3) ||
(($dd<1 || $dd>31) && ($mm<1 || $mm>12) && ($year<$maxage || $year>$minage)) ||
($Gender!=1 && $Gender!=2 && $Gender!='Male' && $Gender!='Female' ) ||
(strlen($Pancard)!=10) ||
($Qualification!='U' && $Qualification!='B' && $Qualification!='M' && $Qualification!='D' && $Qualification!='O' ) ||
((strlen(strpos(trim($applied_card_name), 'American'))) == 0) ||
(intval($Net_Salary) < 1000000 && $CC_Holder == 2) ||
(intval($Net_Salary) < 1000000 && $Applied_With_Banks=='AMEX') ||
//($card_status == 0) ||
(strlen($Residence_Address)<23) ||
(strlen($City)<2) ||
(strlen($Pincode)!=6) ||
(strlen($resilandline)!=11) ||
(strlen($Office_Address)<23) ||
(strlen($OfficePin)!=6) ||
($ccrow["Employment_Status"]!=1 && $ccrow["Employment_Status"]!=0) ||
(strlen($CompanyName)<=3 || strlen($CompanyName)>24) ||
(intval($Net_Salary) == 0 || strlen(intval($Net_Salary))>8) ||
($BillingPrefernce!='0' && $BillingPrefernce!='5' && $BillingPrefernce!='9') || $checkNegativePincodeStatusOffice==0 || $checkNegativePincodeStatusResidence==0)
{
	$submitApiStatus = 0;
} else {
	$submitApiStatus = 1;
}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Credit Card</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script language="javascript" type="text/javascript" src="scripts/datetime.js"></script>
<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
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
<input type="hidden" name="biddtnw" value="<? echo $bidderid;?>" />
<input type="hidden" name="RequestID" value="<? echo $requestid;?>" />
<input type="hidden" name="Mobile_Number" value="<? echo $Mobile_Number;?>" />
<input type="hidden" name="alreadyamexcard" value="<? echo $alreadyamexcard;?>" />
<table cellpadding="0" cellspacing="0" align="center">
<tr><td>
<table style='border:1px dotted #9C9A9C;' cellspacing="0" cellpadding="5" width="700" height="80%" align="center" border="1" >
<tr><td colspan="4" align="center" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; height:25px;">Amex Credit Card customer details
<br />
<?php 
if($submitApiStatus == 1){
?>
<div class="alert_msg" style="font-size:16px;">Submit the Amex Service by checking Amex Webservice Run and then SUBMIT</div>
<?php 
}
?>

</td></tr>
<tr>
    <td width="180"><span class="style2">Customer Name: </span></td>
    <td width="392" colspan="3">
		<span class="style21">
			<input type="text" maxlength="15" size="13" name="first_name" id="first_name" value="<? echo $first_name; ?>" onkeypress="validateDiv('fnameVal');" />&nbsp;<input type="text" maxlength="15" size="11" name="middle_name" id="middle_name" value="<? echo $middle_name; ?>"/>&nbsp;<input type="text" maxlength="15" size="17" name="last_name" id="last_name" value="<? echo $last_name; ?>" onkeypress="validateDiv('fnameVal');" />
		</span>
		<div id="fnameVal"  class="alert_msg">
			<?php if(strlen($first_name)<2 || strlen($first_name)>15) { echo "FirstName - Min : 1, Max : 15 Characters"; } ?><?php if(strlen($last_name)<2 || strlen($last_name)>15) { echo "LastName - Min : 1, Max : 15 Characters"; } ?>
		</div>
	</td>
</tr>
<tr>
	<td><span class="style2"> Mobile No: </span></td>
	<td><span class="style21"><? if($_SESSION['BidderID']==6729) { echo $Mobile_Number; } else { echo "XXXXXXXXXX"; } ?></span></td>
	<td><span class="style2"> Email: </span></td>
	<td><span class="style21">
		<input type="text" value="<? echo $Email; ?>" name="Email" id="Email" />
		<div id="emailVal"  class="alert_msg"><?php if(strlen($Email)<3) { echo "EMail should be like - abc@xyx.com"; } ?></div></span>
	</td>
</tr>
<tr>
	<td><span class="style2"> DOB: </span></td>
	<td><span class="style21">
		<?php echo listbox_date('day',$dd);?>
		<?php echo listbox_month('month', $mm);?>
		<?php $minage= Date('Y')-18; $maxage=Date('Y')-62; echo listbox_year('year',$maxage,$minage, $year);?>
		</span>
		<div id="emailVal"  class="alert_msg">
			<?php
			if(($dd<1 || $dd>31) && ($mm<1 || $mm>12) && ($year<$maxage || $year>$minage)){
				echo "Select valid DOB";
			}
			?>
		</div>
	</td>
	<td><span class="style2"> Gender: </span></td>
	<td><span class="style21">
		<select name="Gender" id="Gender"  onkeypress="validateDiv('genderVal');" >
			<option value="-1">Please Select</option>
			<option value="1" <? if($Gender=="Male" || $Gender==1) {echo "selected";} ?>>Male</option>
			<option value="2" <? if($Gender=="Female" || $Gender==2) {echo "selected";} ?>>Female</option>
		</select></span>
		<div id="genderVal" class="alert_msg">
			<?php if($Gender!=1 && $Gender!=2 && $Gender!='Male' && $Gender!='Female' ) { echo "Select Gender"; } ?>
		</div>
	</td>
</tr>    
<tr>
	<td><span class="style2">PanCard No</span></td>
    <td>
		<input type="text" class="d4l-input" name="panno" id="panno" value="<? echo $Pancard; ?>"  maxlength="10"/>
		<div id="panVal"  class="alert_msg">
			<?php if(strlen($Pancard)!=10) { echo "Pancard should be like - xxxpx1234x"; } ?>
		</div>
	</td>
	<td>Qualification</td>
	<td>
		<select name="Qualification" id="Qualification" class="mobile-ui-input qualification-icon input-bottom-margin" onchange="validateDiv('QualificationVal');">
			<option value="">Select Qualification</option>
			<option value="U" <?php if($Qualification=="U") { echo "Selected"; } ?>>Under Graduate</option>
			<option value="B" <?php if($Qualification=="B") { echo "Selected"; } ?>>Graduate / Diploma</option>
			<option value="M" <?php if($Qualification=="M") { echo "Selected"; } ?>>Post Graduate</option>
			<option value="D" <?php if($Qualification=="D") { echo "Selected"; } ?>>Professional</option>
			<option value="O" <?php if($Qualification=="O") { echo "Selected"; } ?>>Others</option>
		</select>
		<div id="qualificationVal" class="alert_msg">
			<?php if($Qualification!='U' && $Qualification!='B' && $Qualification!='M' && $Qualification!='D' && $Qualification!='O' ) { echo "Select Qualification"; } ?>
		</div>
	</td>
</tr>
<tr>
  	<td><span class="style2">Select Card</span></td>
    <td>
		<select name="card_dtvalues" id="card_dtvalues">
			<option value="">Please select </option>
			<?php $getcardNameSql = "SELECT cc_bankid,cc_bank_name FROM `credit_card_banks_eligibility` WHERE (`cc_bank_name` like '%American%' and `cc_bank_flag`=1) group by `cc_bank_name`";
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
		<div id="qualificationVal"  class="alert_msg">
			<?php if((strlen(strpos(trim($applied_card_name), 'American'))) == 0) { echo "Select Card";} ?>
		</div>
	</td>
	<td><span class="style2">Selected Card</span></td>
	<td><?php echo $applied_card_name; ?></td>
</tr>
<tr>
	<td><span class="style2">do you hold any card?</span></td>
	<td>
		<input type="radio" id="CC_Holder" name="CC_Holder" value="1" class="css-checkbox" <?php if($CC_Holder==1) { echo "checked";} ?>>Yes</input>
		<input type="radio" id="CC_Holder" name="CC_Holder" value="2" class="css-checkbox" <?php if($CC_Holder==2 || $CC_Holder==0) { echo "checked";} ?>>No</input>
		<div class="alert_msg">
			<?php if(intval($Net_Salary) < 1000000 && $CC_Holder == 2) { echo "Yo do not have existing card";} ?>
		</div>
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
		<div class="alert_msg">
			<?php if(intval($Net_Salary) < 1000000 && $Applied_With_Banks=='AMEX') { echo "Already have AMEX Card";} ?>
		</div>
	</td>
</tr>
<tr>
	<td colspan="4" align="center" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; height:25px;">Residence details</td>
</tr>
<tr>
	<td><span class="style2"> Resi Address: </span></td>
	<td colspan="3"><span class="style21" >
		<input type="text" maxlength="80" size=70 name="resiaddress1" id="resiaddress1" value="<? echo $Residence_Address; ?>"  />&nbsp;</span>
		<div id="resiVal"  class="alert_msg">
			<?php if(strlen($Residence_Address)<23) { echo "Address Should be minimum 24 characters"; } ?>
		</div>
	</td>
</tr>
<tr>
	<td><span class="style2">Residence City: </span></td>
    <td><span class="style21">
		<select size="1" name="City" id="City">
			<option value="">Please Select</option>
			<?php 
				$getAmexSql = "select Query,City from Bidders_List where BidderID = 5596";
				$getAmexQuery = d4l_ExecQuery($getAmexSql);
				$getAmexNumRows = d4l_mysql_num_rows($getAmexQuery);
				$CityArr="";
				if($getAmexNumRows>0)
				{
					$CityICICI = d4l_mysql_result($getAmexQuery,0,'City');
				}	
				$CityArr = explode(",", $CityICICI);
				$optionCity = '';
				for($cityCount=0;$cityCount<count($CityArr);$cityCount++)
				{
					if($CityArr[$cityCount]==$City) { $selected="selected"; }
					echo $optionCity = "<option value='".$CityArr[$cityCount]."' ".$selected.">".$CityArr[$cityCount]."</option>"; 
					$selected="";
				}
			?>
		</select></span>
		<div id="resiCityVal"  class="alert_msg">
			<?php if(strlen($City)<2) { echo "Select City"; } ?>
		</div>
	</td>  
	<td><span class="style2"> Other City: </span></td>
	<td><span class="style21"><input type="text" value="<? echo $ccrow["City_Other"]; ?>" name="City_Other" id="City_Other" /></span></td>
</tr>  
<tr>
	<td><span class="style2"> Resi pincode: </span></td>
	<td><span class="style21">
		<input type="text" name="ResiPin" id="ResiPin" value="<?php echo $Pincode; ?>" maxlength="6" onKeyPress="intOnly(this);" /></span>
		<div id="rpincodeVal"  class="alert_msg">
			<?php if(strlen($Pincode)!=6) { echo "Pincode should be 6 digits"; } else if($checkNegativePincodeStatusResidence==0) { echo "Negative Area"; } ?>
		</div>
	</td>
	<td><span class="style2">Residence Landline Number with StdCode</span></td>
	<td><span class="style21">
		<input type="text" name="resilandline" id="resilandline" value="<?php echo $resilandline; ?>" maxlength="11" onKeyPress="intOnly(this);" /></span>
		<div id="rpincodeVal"  class="alert_msg">
			<?php if(strlen($resilandline)!=11) { echo "Landline should be 11 digits"; } ?>
		</div>
	</td>
</tr>
<tr>
     <td colspan="4" align="center" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; height:25px;">Office details</td>
</tr>
<tr>
	<td><span class="style2"> Office Address: </span></td>
	<td colspan="3"><span class="style21" >
		<input type="text" maxlength="80" size=70 name="officeddress" id="officeddress" value="<? echo $Office_Address; ?>"  />&nbsp;</span>
		<div id="offaddVal"  class="alert_msg">
			<?php if(strlen($Office_Address)<23) { echo "Office Address should be minimum 24 characters"; } ?>
		</div>
	</td>
</tr>
<tr>
	<td><span class="style2">Office City: </span></td>
    <td><span class="style21">
		<select size="1" name="office_city" id="office_city">  
			<option value="">Please Select</option>
			<?php 
				$getAmexSql = "select Query,City from Bidders_List where BidderID = 5596";
				$getAmexQuery = d4l_ExecQuery($getAmexSql);
				$getAmexNumRows = d4l_mysql_num_rows($getAmexQuery);
				$CityArr="";
				if($getAmexNumRows>0)
				{
					$CityICICI = d4l_mysql_result($getAmexQuery,0,'City');
				}	
				$CityArr = explode(",", $CityICICI);
				$optionCity = '';
				for($cityCount=0;$cityCount<count($CityArr);$cityCount++)
				{
					if($CityArr[$cityCount]==$officecity) { $selected="selected"; }
					echo $optionCity = "<option value='".$CityArr[$cityCount]."' ".$selected.">".$CityArr[$cityCount]."</option>"; 
					$selected="";
				}
			?>
		</select></span>
		<div id="offcityVal"  class="alert_msg">
			<?php if(strlen($City)<2) { echo "Select Office City"; } ?>
		</div>
	</td>  
	<td><span class="style2"> Office pincode: </span></td>
	<td><span class="style21">
		<input type="text" name="OfficePin" id="OfficePin" value="<?php echo $OfficePin; ?>" maxlength="6"  onKeyPress="intOnly(this);" /></span>
		<div id="opincodeVal"  class="alert_msg">
			<?php if(strlen($OfficePin)!=6) { echo "Pincode should be 6 digits"; }
			else if($checkNegativePincodeStatusOffice==0) { echo "Negative Area"; }
			 ?>
		</div>
	</td>
</tr>  
<tr>
	<td colspan="4" align="center" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; height:25px;">Professional details</td>
</tr>
<tr>
	<td><span class="style2"> Occupation: </span></td>
	<td><span class="style21">
		<select name="Employment_Status" id="Employment_Status" >
			<option value="-1">Please Select</option>
			<option value="1" <? if($ccrow["Employment_Status"]==1) {echo "Selected";}?>>Salaried</option>
			<option value="0" <? if($ccrow["Employment_Status"]==0) {echo "Selected";}?>>Self Employment</option>
		</select></span>
		<div id="empVal"  class="alert_msg">
			<?php if($ccrow["Employment_Status"]!=1 && $ccrow["Employment_Status"]!=0) { echo "Select Employment Status"; } ?>
		</div>
	</td>
	<td><span class="style2"> Company Name: </span></td>
	<td><span class="style21">
		<input name="Company_Name" id="Company_Name" type="text" class="d4l-input" onkeyup="ajax_showOptions(this,'getCountriesByLetters',event)" style="width:200px;" maxlength="24" value="<? echo $CompanyName; ?>" /></span>
		<div id="compVal" class="alert_msg">
			<?php if(strlen($CompanyName)<=3 || strlen($CompanyName)>24) { echo "Company Name should be between 1-24 characters"; } ?>																
		</div>
	</td>
</tr>   
<tr>
	<td><span class="style2"> Annual Income: </span></td>
	<td><span class="style21">
		<input type="text" name="Net_Salary" id="Net_Salary" value="<? echo $Net_Salary; ?>" onKeyPress="intOnly(this);"/></span>
		<div id="compVal"  class="alert_msg">
			<?php if(intval($Net_Salary) == 0 || strlen(intval($Net_Salary))>8) { echo "Salary should be between 1-8 characters"; } ?>
		</div>
	</td>
	<td><span class="style2"> Billing Preference: </span></td>
	<td><span class="style21">
		<select name="BillingPrefernce" id="BillingPrefernce" class="mobile-ui-input qualification-icon input-bottom-margin" onchange="validateDiv('BillingPrefernceal');">
			<option value="">Select Billing Preference</option>
			<option value="0" <?php if($BillingPrefernce==0) { echo "Selected"; } ?> >Beginning of the Month</option>
			<option value="5" <?php if($BillingPrefernce==5) { echo "Selected"; } ?>>Middle of the Month</option>
			<option value="9" <?php if($BillingPrefernce==9) { echo "Selected"; } ?>>End of the Month</option>
		</select></span>
		<div id="billingVal" class="alert_msg">
			<?php if($BillingPrefernce!='0' && $BillingPrefernce!='5' && $BillingPrefernce!='9') { echo "Select Billing Preference"; } ?>
		</div>
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
	<td width="392"><span class="style21"><? echo $ccrow["Updated_Date"]; ?></span></td>
</tr> 
<tr>
	<td colspan="4">
		<?php 
		if($submitApiStatus == 1){
		?>
		<input type="checkbox" value="1" name="amexapirun" />Amex Webservice Run
		<?php
		}
		else {
		?>
		<div id="billingVal"  class="alert_msg" style="font-size:14px;">Amex Creteria Fields Missing </div>
		<?php
		} 
		?>
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
	$cc_alldetailsqry = d4l_ExecQuery("select request_data, response_data from credit_card_banks_apply Where (applied_bankname like '%American%' and cc_requestid='".$requestid."') group by cc_requestid order by date_created DESC");
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
