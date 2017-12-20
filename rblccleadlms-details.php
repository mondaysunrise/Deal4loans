<?php

$ReqID = $_REQUEST["postid"];
$BidID = $_REQUEST["biddt"];
$requestid = $_REQUEST["postid"];
$bidderid = $_REQUEST["biddt"];
//print_r($_REQUEST);
require 'scripts/session_check_online.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';
require 'webservices_functions.php';
require_once ("lib/nusoap.php");

if($_SESSION['leadidentifier']=='rblcallerlms_cc' || $_SESSION['leadidentifier']=='rblcallerinternallms_cc')
{
	$updateqry= "Update lead_allocate set BidderID='".$BidID."' Where AllRequestID = '".$ReqID."' and BidderID=6844";
	$updateqryresult = d4l_ExecQuery($updateqry);
}
else if($_SESSION['leadidentifier']=='rblcallerdigilms_cc')
{
	//Get Bidder ID FROM Profile for Digitech Only
	$getBidderIDQry = "SELECT BidderID FROM Bidders WHERE Profile = '".$BidID."' AND leadidentifier = 'rblcallerdigilms_cc'";
	$getBidderIDResult = d4l_ExecQuery($getBidderIDQry);
	$getBidderResponse = d4l_mysql_fetch_assoc($getBidderIDResult);
	$getBidderID = !empty($getBidderResponse['BidderID']) ? $getBidderResponse['BidderID'] : 0;
	if($getBidderID > 0){
		$bidderid = $getBidderID;
		$BidID = $getBidderID;
	}
	
	$updateqry= "Update lead_allocate set BidderID='".$getBidderID."' Where AllRequestID = '".$ReqID."' and BidderID=7195";
	$updateqryresult = d4l_ExecQuery($updateqry);
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
	$card_name = $_POST["card_name"];
	
	$City = $_REQUEST["City"];
	$City_Other = $_REQUEST["City_Other"];
	$resiaddress = $_REQUEST["resiaddress"];
	$Residence_Address1 = substr($resiaddress,0,39);
	$Residence_Address2 = substr($resiaddress,41,39);
	$pincode = trim($_REQUEST["ResiPin"]);

	$Net_Salary = $_REQUEST["Net_Salary"];
	$monthlyincome = round($Net_Salary/12);
	$CompanyName = trim($_POST["Company_Name"]);

	$comment_section = $_POST["comment_section"];
	$ccfeedback = $_POST["ccfeedback"];
	$FollowupDate  = $_POST["FollowupDate"];

	$rblapirun = $_POST["rblapirun"];
	$lead_source="LMS";
	
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

	if($Gender==1)
	{
		$title="1";
	}
	else
	{
		$title="2";
	}

	if(strlen($City)>0)
	{
		$cityclause=", City='".$City."'";
		$othercityclause=", City_Other='".$City_Other."'";
	}
	if($City=="Others")
	{
		$calcity=$City_Other;
	}
	else
	{
		$calcity=$City;
	}
	$citycode=GetCityCode(ucwords(strtolower($calcity)));

	$upcctblenw="Update Req_Credit_Card set Name='".$Name."',DOB='".$DOB."', Email='".$Email."',Net_Salary='".$Net_Salary."',Residence_Address ='".$resiaddress."', Pancard='".$panno."', Employment_Status='".$Employment_Status."', Company_Name='".$CompanyName."',Gender='".$Gender."', Pincode='".$pincode."', `applied_card_name`= '".$card_name."' ".$cityclause." ".$othercityclause." Where (RequestID=".$RequestID.")";
	$resulupcctblenw=d4l_ExecQuery($upcctblenw);
	
	if($card_name=="RBL Bank Platinum Maxima Credit Card"){
		$CreditCardApplied=21;
	}
	elseif($card_name=="RBL Bank Platinum Delight Credit Card"){
		$CreditCardApplied=24;
	}
	elseif($card_name=="RBL Bank Titanium Delight Credit Card"){
		$CreditCardApplied=16;
	}
	else{
		$CreditCardApplied=16;
	}
	
	//Update values in credit_card_banks_apply table
	$getdetails="select id From credit_card_banks_apply Where ( cc_requestid='".$RequestID."' and applied_bankname like '%RBL Bank%') order by id DESC";
	list($alreadyExist,$myrow)=Mainselectfunc($getdetails,$array = array());
	$id=$myrow['id'];
	if($id>0)
	{
		$DataArray = array("applied_cardname"=>$CreditCardApplied, "lead_source"=>$lead_source);
		$wherecondition ="(id='".$id."')";
		Mainupdatefunc ("credit_card_banks_apply", $DataArray, $wherecondition);
		$ccba_id = $id;
	}
	else
	{
		$DataArray= array("cc_requestid"=>$RequestID, "applied_bankname"=>"RBL Bank", "applied_cardname" =>$CreditCardApplied, "lead_source"=>$lead_source, "date_created"=>$Dated);
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

	if($rblapirun==1)
	{
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
			}
			
			if(empty($resiaddress)){
				$errMsg .= 'ResidenceAddress is empty'.'<br/>';
				$flag = 1;
			}elseif(strlen($resiaddress) > 80){
				$errMsg .= 'ResidenceAddress: Max length is 80 chars'.'<br/>';
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
	}
}

$followup_date="";
$ccdetails = "select Gender,Pancard_No,Pancard,Employment_Status,Dated,DOB,Name,Email,Company_Name,City,City_Other,Mobile_Number,Net_Salary,Loan_Amount,Pincode,IP_Address,Add_Comment,Residence_Address,applied_card_name,Updated_Date, Feedback, Followup_Date, comment_section from Req_Credit_Card  LEFT OUTER JOIN Req_Feedback_CC ON Req_Feedback_CC.AllRequestID=Req_Credit_Card.RequestID and Req_Feedback_CC.BidderID in (".$bidderid.") Where (RequestID=".$requestid.")";
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
list($year,$mm,$dd) = explode("-",$ccrow["DOB"]);
$Residence_Address = $ccrow["Residence_Address"];
$Pincode = $ccrow["Pincode"];
$Email = $ccrow["Email"];
$Mobile_Number = $ccrow["Mobile_Number"];
$Employment_Status = $ccrow["Employment_Status"];
$Net_Salary = $ccrow["Net_Salary"];
$monthlyincome = round($ccrow["Net_Salary"]/12);
$Pancard = $ccrow["Pancard"];
$Feedback= $ccrow["Feedback"];
$CompanyName= $ccrow["Company_Name"];
$followup_date= $ccrow["Followup_Date"];
$comment_section= $ccrow["comment_section"];
$needle = 'RBL';
if (strpos($applied_card_name,$needle) !== false) {
    echo '<center><b>SELECTED RBL CARD</b></center>';
}
$City = $ccrow["City"];
$City_Other = $ccrow["City_Other"];
if($City=="Others")
{
	$calcity=$City_Other;
}
else
{
	$calcity=$City;
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Credit Card</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script language="javascript" type="text/javascript" src="scripts/datetime.js"></script>
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
</head>
<body>
<form name="loan_form" method="post" action="<? echo $_SERVER['PHP_SELF']; ?>?postid=<?echo $requestid;?>&biddt=<? echo $bidderid;?>" >
<input type="hidden" name="biddtnw" value="<? echo $bidderid;?>" />
<input type="hidden" name="RequestID" value="<? echo $requestid;?>" />
<input type="hidden" name="Mobile_Number" value="<? echo $Mobile_Number;?>" />
<table cellpadding="0" cellspacing="0" align="center">
<tr><td>
<table style='border:1px dotted #9C9A9C;' cellspacing="0" cellpadding="5" width="700" height="80%" align="center" border="1" >
<tr><td colspan="4" align="center" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; height:25px;">Credit Card customer details</td></tr>
<tr>
    <td width="180"><span class="style2">Customer Name: </span></td>
    <td width="392" colspan="3"><span class="style21">
		<input type="text" maxlength="12" size="13" name="first_name" id="first_name" value="<? echo $first_name; ?>" />&nbsp;<input type="text" maxlength="10" size="11" name="middle_name" id="middle_name" value="<? echo $middle_name; ?>"/>&nbsp;<input type="text" maxlength="16" size="17" name="last_name" id="last_name" value="<? echo $last_name; ?>" /></span>
	</td>
</tr>
<tr>
	<td><span class="style2"> Mobile No: </span></td>
	<td><span class="style21"><? echo "XXXXXXXXXX";?></span></td>
	<td><span class="style2"> Email: </span></td>
	<td><span class="style21"><input type="text" value="<? echo $Email; ?>" name="Email" id="Email" /></span></td>
</tr>
<tr>
	<td><span class="style2"> DOB: </span></td>
	<td><span class="style21"> <?php echo listbox_date('day',$dd);?>
		<?php echo listbox_month('month', $mm);?>
		<?php $minage= Date('Y')-18; $maxage=Date('Y')-62;
		   echo listbox_year('year',$maxage,$minage, $year);?></span>
	</td>
	<td><span class="style2"> Gender: </span></td>
	<td><span class="style21">
		<select name="Gender" id="Gender" >
			<option value="-1">Please Select</option>
			<option value="1" <? if($Gender=="Male" || $Gender==1) {echo "selected";} ?>>Male</option>
			<option value="2" <? if($Gender=="Female" || $Gender==2) {echo "selected";} ?>>Female</option>
		</select></span>
	</td>
</tr>    
<tr>
  	<td><span class="style2">PanCard No</span></td>
    <td><input type="text" class="d4l-input" name="panno" id="panno" value="<? echo $Pancard; ?>"  maxlength="10"/></td>
</tr>
<tr>
	<td><span class="style2">Select Card</span></td>
    <td>
		<select name="card_name" id="card_name">
			<option value="">Please select </option>
			<?php $getcardNameSql = "SELECT cc_bankid,cc_bank_name FROM `credit_card_banks_eligibility` WHERE (`cc_bank_name` like '%RBL%' and `cc_bank_flag`=1) group by `cc_bank_name`";
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
	<td><span class="style2">Selected Card</span></td>
	<td><?php echo $applied_card_name; ?></td>
</tr>
<tr>
	<td colspan="4" align="center" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; height:25px;">Residence details</td>
</tr>
<tr>
	<td><span class="style2"> Resi Address: </span></td>
	<td colspan="3"><span class="style21" ><input type="text" maxlength="80" size=70 name="resiaddress" id="resiaddress" value="<? echo $Residence_Address; ?>"  />&nbsp;</span></td>
</tr>
<tr>
	<td><span class="style2">Residence City: </span></td>
    <td><span class="style21">
		<select size="1" name="City" id="City">  
			<option value="">Please Select</option>
			<?php 
			$getAmexSql = "select Query,City from Bidders_List where BidderID = 4905";
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
			<option value="Others" <?php if($City == 'Others'){ echo 'selected'; }?>>Others</option>
		</select></span>
	</td>  
	<td><span class="style2"> Other City: </span></td>
	<td><span class="style21">
		<input type="text" value="<? echo $ccrow["City_Other"]; ?>" name="City_Other" id="City_Other" /></span>
	</td>
</tr>  
<tr>
	<td><span class="style2"> Resi pincode: </span></td>
	<td><span class="style21">
		<input type="text" name="ResiPin" id="ResiPin" value="<?php echo $Pincode; ?>" maxlength="6" /></span>
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
	</td>
	<td><span class="style2"> Company Name: </span></td>
	<td><span class="style21"><input name="Company_Name" id="Company_Name" type="text" class="d4l-input" onkeyup="ajax_showOptions(this,'getCountriesByLetters',event)"   style="width:200px;" maxlength="30" value="<? echo $CompanyName; ?>" /></span></td>
</tr>   
<tr>
	<td>&nbsp;</td>
	<td>&nbsp;</td><td><span class="style2"> Annual Income: </span></td>
	<td><span class="style21"><input type="text"  name="Net_Salary" id="Net_Salary" value="<? echo $Net_Salary; ?>"/></span></td>
</tr>
<tr>
	<td colspan="4" align="center" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; height:25px;">Feedback details</td></tr>
<tr>
	<td><span class="style2">LMS Comments: </span></td>
	<td><span class="style21"><textarea rows="2" cols="15" name="comment_section"><? echo $comment_section; ?></textarea></span></td>   
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
	<td class="fontstyle"><input type="Text"  name="FollowupDate" id="FollowupDate" maxlength="25" size="15" <?php if($Followup_Date !='0000-00-00 00:00:00') { ?>value="<?php  echo $followup_date; ?>" <?php } ?> /><a href="javascript:NewCal('FollowupDate','yyyymmdd',true,24)"><img src="images/cal.gif" width="16" height="16" border="0" alt="Pick a date" /></a></td>
	<td width="180"><span class="style2">Date of entry: </span></td>
	<td width="392"><span class="style21"><? echo $ccrow["Updated_Date"]; ?></span></td>
</tr> 
<tr>
	<td colspan="4"><input type="checkbox" value="1" name="rblapirun" />RBL Webservice Run</td>
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
	<td colspan="4" align="right"></td>
</tr>
<tr>
	<td colspan="4"> 
		<? $cc_alldetailsqry = d4l_ExecQuery("select response_data from credit_card_banks_apply Where (applied_bankname like '%RBL%' and cc_requestid='".$ReqID."') group by cc_requestid order by date_created DESC");
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
