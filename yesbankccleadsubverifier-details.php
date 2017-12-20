<?php
$ReqID = $_REQUEST["postid"];
$BidID = $_REQUEST["biddt"];
$requestid = $_REQUEST["postid"];
$bidderid = $_REQUEST["biddt"];
//print_r($_REQUEST);
require 'scripts/session_check_online.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';
require_once ("lib/nusoap.php");


//Get Bidder ID FROM Profile for Digitech Only
$getBidderIDQry = "SELECT BidderID FROM Bidders WHERE BidderID = '".$BidID."' AND leadidentifier = 'CallerDigitechVerifierYesBank'";
$getBidderIDResult = d4l_ExecQuery($getBidderIDQry);
$getBidderIDNumRows = d4l_mysql_num_rows($getBidderIDResult);
if($getBidderIDNumRows > 0) { } else {
	echo "You are not authorised to view this lead...";
	die();
}


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
	$card_name = $_POST["card_name"];
	$AccountNumber = trim($_POST["AccountNumber"]);
	
	$City = $_REQUEST["City"];
	$State = $_REQUEST["State"];
	$resiaddress_flat = $_REQUEST["resiaddress_flat"];
	$resiaddress_building= $_REQUEST["resiaddress_building"];
	$resiaddress_road= $_REQUEST["resiaddress_road"];
	
	$resiAddressArray = '';
	$resiAddressArray['flat'] = $resiaddress_flat;
	$resiAddressArray['building'] = $resiaddress_building;
	$resiAddressArray['road'] = $resiaddress_road;
	
	$serializeAddress = serialize($resiAddressArray);

	$Residence_Address = $resiaddress_flat.' '.$resiaddress_building.' '.$resiaddress_road;
	$pincode = trim($_REQUEST["ResiPin"]);
	$landline_std = trim($_REQUEST["landline_std"]);
	$landline_number = trim($_REQUEST["landline_number"]);

	$Net_Salary = $_REQUEST["Net_Salary"];
	$monthlyincome = round($Net_Salary/12);
	$CompanyName = trim($_POST["Company_Name"]);
	$cc_holder = $_REQUEST["cc_holder"];
	$already_applied = $_REQUEST["already_applied"];

	$comment_section = $_POST["comment_section"];
	$ccfeedback = $_POST["ccfeedback"];
	$FollowupDate  = $_POST["FollowupDate"];

	$lead_source="Calling LMS";
	
	$yesapirun = $_POST["yesapirun"];

	$Employment_Status = $_REQUEST["Employment_Status"];
	if($Employment_Status==0)
	{
		$EmpType=2;
	}
	else
	{
		$EmpType=1;
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
	$dobstr=$dd."-".$mm."-".$year;
	$Dated=ExactServerdate();

	$upcctblenw="Update Req_Credit_Card set Name='".$Name."',DOB='".$DOB."', Email='".$Email."',Net_Salary='".$Net_Salary."',Residence_Address ='".$Residence_Address."', Pancard='".$panno."', Employment_Status='".$Employment_Status."', Company_Name='".$CompanyName."', Std_Code='".$landline_std."', Landline='".$landline_number."', Gender='".$Gender."', Pincode='".$pincode."', State='".$State."', applied_card_name='".$card_name."', City='".$City."' Where (RequestID=".$RequestID.")";
	$resulupcctblenw=d4l_ExecQuery($upcctblenw);

	//Update values in credit_card_banks_apply table
	$ccba_result = d4l_ExecQuery("select id from credit_card_banks_apply where (cc_requestid=".$RequestID." and applied_bankname like '%Yes%') order by id DESC");
	$ccba_num_rows = d4l_mysql_num_rows($ccba_result);
	if($ccba_num_rows > 0)
	{
		$ccba_row = d4l_mysql_fetch_array($ccba_result);
		$updatestrSQL="Update credit_card_banks_apply Set lead_source ='".$lead_source."', resi_address = '".$serializeAddress."', applied_cardname = '".$card_name."', bank_relationship_number='".$AccountNumber."', cc_holder='".$cc_holder."', already_applied='".$already_applied."'";
		$updatestrSQL=$updatestrSQL."Where id=".$ccba_row["id"];
	}
	else
	{
		$updatestrSQL="Insert into credit_card_banks_apply(cc_requestid, lead_source, applied_bankname, applied_cardname, bank_relationship_number, date_created, resi_address, cc_holder, already_applied ) Values (";
		$updatestrSQL=$updatestrSQL.$RequestID.",'".$lead_source."','Yes Bank', '".$card_name."', '".$AccountNumber."',Now(), '".$serializeAddress."', '".$cc_holder."', '".$already_applied."')";
	}
	$ccba_final_result = d4l_ExecQuery($updatestrSQL);

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
			$strSQL="Update Req_Feedback_CC Set Feedback='".$ccfeedback."', comment_section='".$comment_section."', Followup_Date='".$FollowupDate."', last_updated=Now()";
			$strSQL=$strSQL."Where FeedbackID=".$row["FeedbackID"];
		}
		else
		{
			$strSQL="Insert into Req_Feedback_CC(AllRequestID, BidderID, Reply_Type, Feedback, Followup_Date, comment_section, last_updated) Values (";
			$strSQL=$strSQL.$RequestID.",".$bidderid.",4,'".$ccfeedback."','".$FollowupDate."','".$comment_section."',Now())";
		}

		$result = d4l_ExecQuery($strSQL);
		if ($result == 1)
		{
		}
		else
		{
			$Msg = "** There was a problem in adding your feedback. Please try again.";
		}
	}

	if($yesapirun==1)
	{
		$getUserDetailSql = "SELECT * FROM Req_Credit_Card WHERE RequestID = '".$RequestID."'";
		$getUserDetailResult = d4l_ExecQuery($getUserDetailSql);
		$getUserDetailResponse = d4l_mysql_fetch_assoc($getUserDetailResult);
		$No_of_Banks = $getUserDetailResponse['No_of_Banks'];
		$CC_Holder = $getUserDetailResponse['CC_Holder'];
		$Net_Salary = $getUserDetailResponse['Net_Salary'];

		//Calculate Age
		$age = date_diff(date_create($DOB), date_create('now'))->y;

		//Validation
		try{
			$errMsg = "";
			$flag = 0;
			
			if(empty($card_name)){
				$errMsg .= 'Please select Card'.'<br/>';
				$flag = 1;
			}

			if(empty($first_name)){
				$errMsg .= 'FirstName is empty'.'<br/>';
				$flag = 1;
			}/*elseif(strlen($first_name) > 15){
				$errMsg .= 'FirstName: Max length is 15 chars'.'<br/>';
				$flag = 1;
			}*/elseif(!preg_match('/^[a-zA-Z\s]+$/',$first_name)){	
				$errMsg .= 'FirstName can have letters only.'.'<br/>';
				$flag = 1;
			}

			if(empty($last_name)){
				$errMsg .= 'LastName is empty'.'<br/>';
				$flag = 1;
			}/*elseif(strlen($last_name) < 2){
				$errMsg .= 'LastName: Min length is 2 chars'.'<br/>';
				$flag = 1;
			}elseif(strlen($last_name) > 15){
				$errMsg .= 'LastName: Max length is 15 chars'.'<br/>';
				$flag = 1;
			}*/elseif(!preg_match('/^[a-zA-Z\s]+$/',$last_name)){	
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
			
			if($age < 23){
				$errMsg .= 'Age should be greater than 23'.'<br/>';
				$flag = 1;
			}
			elseif($Net_Salary < 480000){
				$errMsg .= 'Salary should be greater than 480000'.'<br/>';
				$flag = 1;
			}
			elseif(($CC_Holder == 1) && (strpos(strtolower($No_of_Banks), 'yes') !== false)){
				$errMsg .= 'You already have Yes bank card '.'<br/>';
				$flag = 1;
			}
			
			if(empty($Gender)){
				$errMsg .= 'Gender is empty'.'<br/>';
				$flag = 1;
			}/*elseif($Gender !='Male' && $Gender != 'Female'){
				$errMsg .= 'Enter correct value of Gender'.'<br/>';
				$flag = 1;
			}*/

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
			}elseif(!preg_match("/^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}?$/", $panno)) {
				$errMsg .= 'PAN is invalid'.'<br/>';
				$flag = 1;
			}
			
			if(empty($monthlyincome)){
				$errMsg .= 'MonthlyIncome is empty'.'<br/>';
				$flag = 1;
			}elseif(!preg_match('/^[1-9][0-9]*$/', $monthlyincome)) {
				$errMsg .= 'MonthlyIncome: Please enter only numbers'.'<br/>';
				$flag = 1;
			}/*elseif(strlen($monthlyincome) > 8){
				$errMsg .= 'MonthlyIncome: Max length is 8 chars'.'<br/>';
				$flag = 1;
			}*/
			
			/*
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
			*/
			
			if(empty($City)){
				$errMsg .= 'City is empty'.'<br/>';
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
			}/*elseif(strlen($CompanyName) > 24){
				$errMsg .= 'CompanyName: Max length is 24 chars'.'<br/>';
				$flag = 1;
			}*/
			
			if(empty($landline_std)){
				$errMsg .= 'STD Code is empty'.'<br/>';
				$flag = 1;
			}
			
			if(empty($landline_number)){
				$errMsg .= 'Landline Number is empty'.'<br/>';
				$flag = 1;
			}
			
			if(empty($cc_holder)){
				$errMsg .= 'Please provide answer for "Do you already have Yes Bank Credit Card?"'.'<br/>';
				$flag = 1;
			}
			
			if(empty($already_applied)){
				$errMsg .= 'Please provide answer for "Have you applied for Yes Bank Card in last 3 months?"'.'<br/>';
				$flag = 1;
			}
			
			if($flag){
				throw new Exception($errMsg);
			}
		}catch(Exception $e){
			echo $e->getMessage().'<br/>'.'<strong>Please fill all required fields</strong>';
			exit;
		}

		////////////*********** Lead Allocation Start ***********////////////

		$source = 'CallerVerifierYesBank';
		$lead_allocation_logic = 158;

		$startprocess="Select total_lead_count From lead_allocation_table Where (Citywise='".$source."' and lead_allocation_logic='".$lead_allocation_logic."')";
		$startprocessresult = d4l_ExecQuery($startprocess);
		$recordcount = d4l_mysql_num_rows($startprocessresult);
		$row=d4l_mysql_fetch_array($startprocessresult);
		$total_lead_count = $row["total_lead_count"];
		
		$counterVal = 1;
		$arrcallerqry=d4l_ExecQuery("Select BidderID from Bidders Where (leadidentifier='".$source."' and Status=1) order by BidderID ASC");
		while($rowcal=d4l_mysql_fetch_array($arrcallerqry))
		{
			$arrCallerrID[$counterVal] = $rowcal["BidderID"];
			$counterVal = $counterVal + 1;
		}
		$strBidderID = implode(',', $arrCallerrID);
		
		$sequenceid=d4l_ExecQuery("Select last_allocated_to,total_no_agents From lead_allocation_table Where (Citywise='".$source."' and lead_allocation_logic='".$lead_allocation_logic."')");
		$seqid = d4l_mysql_fetch_array($sequenceid);
		$last_allocated_to = $seqid["last_allocated_to"];
		$total_no_agents = $seqid["total_no_agents"];
		if($total_no_agents>$last_allocated_to)
		{
			$sequence=$last_allocated_to+1;
		}
		else
		{
			$sequence=1;
		}
		
		$getCheckSQl = "select leadid from lead_allocate where (AllRequestID = '".$requestid."' and BidderID in (".$strBidderID."))";
		$getCheckQuery = d4l_ExecQuery($getCheckSQl);
		$getCheckNum = d4l_mysql_num_rows($getCheckQuery);
		if($getCheckNum>0)
		{
			//Already Existing Lead
		}
		else
		{
			$callerID = $arrCallerrID[$sequence];
			if($requestid>0 && $callerID>1)
			{
				//insert allocation
				$final_allocationciti="INSERT lead_allocate (AllRequestID, BidderID, Reply_Type, Allocation_Date) VALUE ('".$requestid."','".$callerID."','4', Now())";
				$final_allocationcitiresult = d4l_ExecQuery($final_allocationciti);
				$updateqry= "Update lead_allocation_table set last_allocated_to='".$sequence."' , total_lead_count='".$requestid."' Where (Citywise='".$source."' and lead_allocation_logic='".$lead_allocation_logic."')";
				$updateqryresult = d4l_ExecQuery($updateqry);
				
			}
		}
		////////////*********** Lead Allocation End ***********////////////
	}
}

$followup_date="";
$ccdetails = "select Gender,Pancard_No,Pancard,Employment_Status,Dated,DOB,Name,Email,Company_Name,Std_Code,Landline,City,City_Other,Mobile_Number, Net_Salary,Loan_Amount,Pincode,IP_Address ,Add_Comment, Residence_Address, applied_card_name, Updated_Date, Feedback, Followup_Date, comment_section,State from Req_Credit_Card  LEFT OUTER JOIN Req_Feedback_CC ON Req_Feedback_CC.AllRequestID=Req_Credit_Card.RequestID and Req_Feedback_CC.BidderID in (".$bidderid.") Where (RequestID=".$requestid.")";
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
$State= $ccrow["State"];
$Gender = $ccrow["Gender"];
list($year,$mm,$dd) = explode("-",$ccrow["DOB"]);
$Residence_Address = $ccrow["Residence_Address"];
$Pincode = $ccrow["Pincode"];
$Email = $ccrow["Email"];
$Mobile_Number = $ccrow["Mobile_Number"];
$Employment_Status = $ccrow["Employment_Status"];
$Net_Salary = $ccrow["Net_Salary"];
$monthlyincome = round($ccrow["Net_Salary"]/12);
$Pancard = $ccrow["Pancard"];
$CompanyName= $ccrow["Company_Name"];
$LandlineStd = $ccrow["Std_Code"];
$LandlineNumber = $ccrow["Landline"];
$Feedback= $ccrow["Feedback"];
$followup_date= $ccrow["Followup_Date"];
$comment_section= $ccrow["comment_section"];
$needle = 'Yes';
if (strpos($applied_card_name,$needle) !== false) {
    echo '<center><b>SELECTED Yes Bank CARD</b></center>';
}
$City = $ccrow["City"];

$ccba_result = d4l_ExecQuery("select * from credit_card_banks_apply where (cc_requestid=".$requestid." and applied_bankname like '%Yes%') order by id DESC");
$ccba_row=d4l_mysql_fetch_array($ccba_result);
$resi_address = $ccba_row["resi_address"];
$unserializeAddress = unserialize($resi_address);
$Residence_Address_Flat = $unserializeAddress['flat'];
$Residence_Address_Building = $unserializeAddress['building'];
$Residence_Address_Road = $unserializeAddress['road'];
$AccountNumber = $ccba_row["bank_relationship_number"];
$cc_holder = $ccba_row["cc_holder"];
$already_applied = $ccba_row["already_applied"];

//Caller Comments
$callerCommentsSql = "SELECT * FROM `Req_Feedback_CC` WHERE AllRequestID = '".$requestid."' AND BidderID In (SELECT BidderID FROM `Bidders` WHERE `leadidentifier` LIKE '%ybankdigicallerlms_cc%')";
$callerCommentsResult = d4l_ExecQuery($callerCommentsSql);
$callerCommentsResponse = d4l_mysql_fetch_assoc($callerCommentsResult);
$caller_feedback = $callerCommentsResponse["Feedback"];
$caller_comment = $callerCommentsResponse["comment_section"];
$caller_followup_date = ($callerCommentsResponse["Followup_Date"] != '0000-00-00 00:00:00') ? $callerCommentsResponse["Followup_Date"]: '0000-00-00 00:00:00';
//echo '<pre>';print_r($callerCommentsResponse);exit;

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
<script>
function isNumberKey(evt)
{
	var charCode = (evt.which) ? evt.which : evt.keyCode;
	if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57)){
		return false;
	}
	return true;
}
</script>
</head>
<body>
<form name="loan_form" method="post" action="<? echo $_SERVER['PHP_SELF']; ?>?postid=<?echo $requestid;?>&biddt=<? echo $bidderid;?>" >
<input type="hidden" name="biddtnw" value="<? echo $bidderid;?>" />
<input type="hidden" name="RequestID" value="<? echo $requestid;?>" />
<input type="hidden" name="Mobile_Number" value="<? echo $Mobile_Number;?>" />
<table cellpadding="0" cellspacing="0" align="center">
<tr><td>
<table style='border:1px dotted #9C9A9C;' cellspacing="0" cellpadding="5" width="1000" height="80%" align="center" border="1" >
<tr><td colspan="4" align="center" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; height:25px;">Credit Card customer details</td></tr>
<tr>
    <td style="width: 261px"><span class="style2">Customer Name: </span></td>
    <td colspan="2"><span class="style21">
		<input type="text" maxlength="25" size="13" name="first_name" id="first_name" value="<? echo $first_name; ?>" />&nbsp;<input type="text" maxlength="20" size="11" name="middle_name" id="middle_name" value="<? echo $middle_name; ?>"/>&nbsp;<input type="text" maxlength="25" size="17" name="last_name" id="last_name" value="<? echo $last_name; ?>" /></span>
	</td><td><span class="style2"> Mobile No: </span> - <span class="style21"><? echo "XXXXXXXXXX";?></span></td>
</tr>
<tr>
	<td style="width: 261px"><span class="style2">PanCard No</span></td>
	<td style="width: 294px"><span class="style21"><input type="text" class="d4l-input" name="panno" id="panno" value="<? echo $Pancard; ?>"  maxlength="10"/></span></td>
	<td style="width: 387px"><span class="style2"> Email: </span></td>
	<td><span class="style21"><input type="text" value="<? echo $Email; ?>" name="Email" id="Email" /></span></td>
</tr>
<tr>
	<td style="width: 261px"><span class="style2"> DOB: </span></td>
	<td style="width: 294px"><span class="style21"> <?php echo listbox_date('day',$dd);?>
		<?php echo listbox_month('month', $mm);?>
		<?php $minage= Date('Y')-18; $maxage=Date('Y')-62;
		   echo listbox_year('year',$maxage,$minage, $year);?></span>
	</td>
	<td style="width: 387px"><span class="style2"> Gender: </span></td>
	<td><span class="style21">
		<select name="Gender" id="Gender" >
			<option value="-1">Please Select</option>
			<option value="1" <? if($Gender=="Male" || $Gender==1) {echo "selected";} ?>>Male</option>
			<option value="2" <? if($Gender=="Female" || $Gender==2) {echo "selected";} ?>>Female</option>
		</select></span>
	</td>
</tr>    
<tr>
	<td style="width: 261px"><span class="style2">Select Card</span></td>
    <td style="width: 294px">
		<select name="card_name" id="card_name">
			<option value="">Please select </option>
			<?php 
			//$getcardNameSql = "SELECT cc_bankid,cc_bank_name FROM `credit_card_banks_eligibility` WHERE (`cc_bank_name` like '%YES%' and `cc_bank_flag`=1) group by `cc_bank_name`";
			$getcardNameSql = "SELECT cc_bankid,cc_bank_name FROM `credit_card_banks_eligibility` WHERE (`cc_bank_name` like '%YES%') group by `cc_bank_name`";
			list($numRowsCardName,$getCardNameQuery)=MainselectfuncNew($getcardNameSql,$array = array());
			for($cN=0;$cN<$numRowsCardName;$cN++)
			{
				$Card_id = $getCardNameQuery[$cN]['cc_bankid'];
				$cc_bank_name = $getCardNameQuery[$cN]['cc_bank_name'];
				?>
			<option value="<?php echo $cc_bank_name; ?>" <? if($cc_bank_name==$applied_card_name) { echo "Selected";} ?>><?php echo ucwords(strtolower($cc_bank_name)); ?></option>
			<?php
			}
			?>
		</select>
	</td>
	<td style="width: 387px"><span class="style2">Selected Card</span></td>
	<td><?php echo $applied_card_name; ?></td>
</tr>
<tr>
	<td colspan="4" align="center" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; height:25px;">Residence details</td>
</tr>
<tr>
	<td style="width: 261px"><span class="style2"> Resi Address (Flat No): </span></td>
	<td colspan="3"><span class="style21" ><input type="text" maxlength="40" size=70 name="resiaddress_flat" id="resiaddress_flat" value="<? echo $Residence_Address_Flat; ?>"  />&nbsp;</span></td>
</tr>
<tr>
	<td style="width: 261px"><span class="style2"> Resi Address (Building): </span></td>
	<td colspan="3"><span class="style21" ><input type="text" maxlength="40" size=70 name="resiaddress_building" id="resiaddress_building" value="<? echo $Residence_Address_Building; ?>"  />&nbsp;</span></td>
</tr>
<tr>
	<td style="width: 261px"><span class="style2"> Resi Address (Road): </span></td>
	<td colspan="3"><span class="style21" ><input type="text" maxlength="40" size=70 name="resiaddress_road" id="resiaddress_road" value="<? echo $Residence_Address_Road; ?>"  />&nbsp;</span></td>
</tr>


<tr>
	<td style="width: 261px"><span class="style2">Residence City: </span></td>
    <td style="width: 294px"><span class="style21">
		<select size="1" name="City" id="City">  
			<option value="">Please Select</option>
			<?php
			/*
			$getYesCitySql = "SELECT city FROM yes_cc_city_state_list GROUP BY city ORDER BY city ASC";
			list($citynumrows,$CityArr)=MainselectfuncNew($getYesCitySql,$array = array());
			foreach($CityArr as $key=>$cityval)
			{
			?>
				<option value="<?php echo $cityval['city']; ?>" <?php if($cityval['city']==$City) { echo "selected"; }?>><?php echo $cityval['city']; ?></option>
			<?php
			}
			*/
			?>
			<?php
			$getYesCitySql = "SELECT GROUP_CONCAT(City) As City FROM Bidders_List WHERE Bidder_Name LIKE '%Yes Bank%' AND Reply_Type=4";
			list($citynumrows,$CityArr)=MainselectfuncNew($getYesCitySql,$array = array());
			$CityArrNew = explode(',', $CityArr[0]['City']);
			foreach($CityArrNew as $key=>$cityval)
			{
				//Check if pincode exists for city
				$getYesCityPinSql = "SELECT * FROM yes_cc_city_state_list WHERE city = '".$cityval."'";
				list($citypinrows,$CityPinArr)=MainselectfuncNew($getYesCityPinSql,$array = array());
				if($citypinrows){
			?>
				<option value="<?php echo $cityval; ?>" <?php if($cityval==$City) { echo "selected"; }?>><?php echo $cityval; ?></option>
			<?php
				}
			}
			?>
		</select></span>
	</td>  
	<td style="width: 387px"><span class="style2"> Resi pincode: </span></td>
	<td><span class="style21">
		<select name="ResiPin" id="ResiPin" class="d4l-select">
			<?
			$getPinSql = "SELECT pincode FROM yes_cc_city_state_list WHERE city = '".$City."' ORDER BY pincode ASC";
			list($pincodenumrows,$pincodelist)=MainselectfuncNew($getPinSql,$array = array());
			foreach($pincodelist as $key=>$pinval)
			{
			?>
				<option value="<?php echo $pinval['pincode']; ?>" <? if($pinval['pincode']==$Pincode) {echo "selected";} ?> ><?php echo $pinval['pincode']; ?></option>   
			<?php
			}
			?>
		</select></span>
	</td>
</tr>  
<tr>
	<td style="width: 261px"><span class="style2">Residence State: </span></td>
    <td style="width: 294px"><span class="style21">
		<select size="1" name="State" id="State">  
			<option value="">Please Select</option>
			<?php
			$getStateSql = "SELECT state FROM yes_cc_city_state_list GROUP BY state ORDER BY state ASC";
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
	<td style="width: 387px"><span class="style2"> Landline Number: </span></td>
	<td><table cellpadding="2" cellspacing="2">
			<tr>
				<td>
					<div style="float:left; width:50px;">
						<input type="text" class="std" name="landline_std" id="landline_std" value="<? echo $LandlineStd; ?>" maxlength="7" style="width:50px;" placeholder="STD" onkeypress="return isNumberKey(event)">
					</div>
				</td>
				<td>
					<input type="text" class="stdnumber" id="landline_number" name="landline_number" value="<? echo $LandlineNumber; ?>" maxlength="8" size="10" placeholder="Number" onkeypress="return isNumberKey(event)"/>
				</td>
			</tr>
		</table>
	</td>
</tr>
<tr>
	<td colspan="4" align="center" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; height:25px;">Professional details</td>
</tr>
<tr>
	<td style="width: 261px"><span class="style2"> Occupation: </span></td>
	<td style="width: 294px"><span class="style21">
		<select name="Employment_Status" id="Employment_Status" >
			<option value="-1">Please Select</option>
			<option value="1" <? if($ccrow["Employment_Status"]==1) {echo "Selected";}?>>Salaried</option>
			<option value="0" <? if($ccrow["Employment_Status"]==0) {echo "Selected";}?>>Self Employment</option>
		</select></span>
	</td>
	<td style="width: 387px"><span class="style2"> Company Name: </span></td>
	<td><span class="style21"><input name="Company_Name" id="Company_Name" type="text" class="d4l-input" onkeyup="ajax_showOptions(this,'getCountriesByLetters',event)"   style="width:200px;" maxlength="30" value="<? echo $CompanyName; ?>" /></span></td>
</tr>   
<tr>
	<td style="width: 261px">Account Number</td>
	<td style="width: 294px"><input type="text"  name="AccountNumber" id="AccountNumber" maxlength="20" value="<? echo $AccountNumber; ?>" onkeypress="return isNumberKey(event)"/></td>
	<td style="width: 387px"><span class="style2"> Annual Income: </span></td>
	<td><span class="style21"><input type="text" name="Net_Salary" id="Net_Salary" value="<? echo $Net_Salary; ?>" onkeypress="return isNumberKey(event)"/></span></td>
</tr>
<tr>
	<td colspan="2"><span class="style2">Do you already have Yes Bank Credit Card?</span></td>
	<td colspan="2">
		<input type="radio" name="cc_holder" id="radio-one" value="Yes" class="css-checkbox" <?php if($cc_holder=="Yes") { echo "checked";} ?> />
		<label for="radio-one" class="css-label radGroup2" >Yes</label>
        <input type="radio" name="cc_holder" id="radio-two" value="No" class="css-checkbox" <?php if($cc_holder=="No") { echo "checked";} ?>/>
		<label for="radio-two" class="css-label radGroup2">No</label>
	</td>
</tr>
<tr>
	<td colspan="2"><span class="style2">Have you applied for Yes Bank Card in last 3 months?</span></td>
	<td colspan="2">
		<input type="radio" name="already_applied" id="radio-three" value="Yes" class="css-checkbox" <?php if($already_applied=="Yes") { echo "checked";} ?> />
		<label for="radio-three" class="css-label radGroup2" >Yes</label>
        <input type="radio" name="already_applied" id="radio-four" value="No" class="css-checkbox" <?php if($already_applied=="No") { echo "checked";} ?>/>
		<label for="radio-four" class="css-label radGroup2">No</label>
	</td>
</tr>
<tr>
	<td colspan="4" align="center" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; height:25px;">Caller Feedback details</td></tr>
<tr>
	<td style="width: 261px"><span class="style2">LMS Comments: </span></td>
	<td style="width: 294px"><span class="style21"><textarea rows="2" cols="15" name="caller_comment" readonly><? echo $caller_comment; ?></textarea></span></td>   
	<td style="width: 387px"><span class="style2">LMS feedback </span></td>
	<td><span class="style21"><input type="text" name="caller_feedback" id="caller_feedback" value="<? echo $caller_feedback; ?>" readonly /></span>
	</td>
</tr>	
<tr>
	<td class="fontstyle" style="width: 261px"><b>Follow Up Date</b></td>
	<td class="fontstyle" style="width: 294px">
		<input type="Text" name="caller_followup_date" id="caller_followup_date" maxlength="25" size="15" value="<?php echo $caller_followup_date; ?>" readonly />
	</td>
	<td style="width: 387px"><span class="style2"></span></td>
	<td width="392"><span class="style21"></span></td>
</tr>
<tr>
	<td colspan="4" align="center" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; height:25px;">Feedback details</td></tr>
<tr>
	<td style="width: 261px"><span class="style2">LMS Comments: </span></td>
	<td style="width: 294px"><span class="style21"><textarea rows="2" cols="15" name="comment_section"><? echo $comment_section; ?></textarea></span></td>   
	<td style="width: 387px"><span class="style2">LMS feedback </span></td>
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
	<td class="fontstyle" style="width: 261px"><b>Follow Up Date</b></td>
	<td class="fontstyle" style="width: 294px"><input type="Text"  name="FollowupDate" id="FollowupDate" maxlength="25" size="15" <?php if($Followup_Date !='0000-00-00 00:00:00') { ?>value="<?php  echo $followup_date; ?>" <?php } ?> /><a href="javascript:NewCal('FollowupDate','yyyymmdd',true,24)"><img src="images/cal.gif" width="16" height="16" border="0" alt="Pick a date" /></a></td>
	<td style="width: 387px"><span class="style2">Date of entry: </span></td>
	<td width="392"><span class="style21"><? echo $ccrow["Updated_Date"]; ?></span></td>
</tr>
<tr>
	<td colspan="4">
	<?php
	$checkVerifierQry = "SELECT * FROM `lead_allocate` WHERE BidderID IN (SELECT BidderID FROM `Bidders` WHERE `leadidentifier` IN ('CallerVerifierYesBank')) AND AllRequestID = '".$requestid."'";
	$checkVerifierResult = d4l_ExecQuery($checkVerifierQry);
	$checkVerifierNumRows = d4l_mysql_num_rows($checkVerifierResult);
	if($checkVerifierNumRows == 0)
	{
	?>
		<input type="checkbox" value="1" name="yesapirun" />Check this to send
	<?php
	}
	else{
		echo 'Already Send';
	}
	?>
	</td>
<tr>
	<td colspan="4" align="center"><input type="Submit" name="Submit" value="Submit" style="background-color:#529BE4;" /></td>
</tr>
</table>
</form>
</td></tr>
<tr><td>
<table style='border:1px dotted #9C9A9C;' cellspacing="0" cellpadding="5" width="100%" height="80%" align="center" border="1" >
<tr>
	<td colspan="4"> 
		<? $cc_alldetailsqry = d4l_ExecQuery("select response_data from credit_card_banks_apply Where (applied_bankname like '%Yes%' and cc_requestid='".$ReqID."') group by cc_requestid order by date_created DESC");
		$ccal=d4l_mysql_fetch_array($cc_alldetailsqry);
		$responsedata= explode(",", trim($ccal["response_data"])); 
		if(count($responsedata)>0)
		{
			for($r=0;$r<count($responsedata);$r++)
			{
				echo $responsedata[$r]."<br>";
			}
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
		
		if(city != ''){
			$.ajax({
				type: 'POST',
				url: 'getyesbank-pincodecitystate.php',
				data: {
					city: city,
				},
				success: function (response) {
					//console.log(response);
					var responseJson = $.parseJSON(response);
					var state = responseJson.State;
					var pincodeArr = responseJson.PincodeList;

					var pincodehtml = '<option value="">Please Select</option>';
					var statehtml = '';
					
					$.each(pincodeArr, function(key, value){
						var pincode = value['pincode'];
						
						pincodehtml += '<option value="'+pincode+'">'+pincode+'</option>';
					});
					$('#ResiPin').html(pincodehtml);
					
					statehtml += '<option value="'+state+'">'+state+'</option>';
					$('#State').html(statehtml);
				}
			});
		}
		else{
			defaulthtml = '<option value="">Select City First</option>';
			$('#ResiPin').html(defaulthtml);
			$('#State').html(defaulthtml);
		}
	});
});
</script>
</body>
</html>
