<?php
$ReqID = $_REQUEST["postid"];
$BidID = $_REQUEST["biddt"];
$requestid = $_REQUEST["postid"];
$bidderid = $_REQUEST["biddt"];

require 'scripts/session_check_online.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';
require 'webservices_functions.php';


if($_SESSION['leadidentifier']=='amexdigicallerlms_cc')
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

if($_POST['method'] == 'checkvalidbank'){
	$cityval = $_POST['cityval'];
	
	//Check for RBL 
	$checkRblSql = "SELECT FIND_IN_SET('".$cityval."', City) as CityVal FROM Bidders_List WHERE BidderID IN (4905)";
	$checkRblResult = d4l_ExecQuery($checkRblSql);
	$checkRblValArr = d4l_mysql_fetch_assoc($checkRblResult);
	$checkRblVal = $checkRblValArr['CityVal'];
	
	//Check for Amex 
	$checkAmexSql = "SELECT FIND_IN_SET('".$cityval."', City) as CityVal FROM Bidders_List WHERE BidderID IN (5596)";
	$checkAmexResult = d4l_ExecQuery($checkAmexSql);
	$checkAmexValArr = d4l_mysql_fetch_assoc($checkAmexResult);
	$checkAmexVal = $checkAmexValArr['CityVal'];
	
	if($checkRblVal > 0 && $checkAmexVal > 0){
		$validBank = 'Both';
	}
	elseif($checkRblVal > 0){
		$validBank = 'Rbl';
	}
	elseif($checkAmexVal > 0){
		$validBank = 'Amex';
	}
	echo $validBank;
	exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	foreach($_POST as $a=>$b)
		$$a=$b;
	$validBank = $_REQUEST["validBank"];
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
	$CC_Holder = $_POST["CC_Holder"];
	$selected_card_bank = $_POST["selected_card_bank"];
	
	$City = $_REQUEST["City"];
	$Residence_Address = $_REQUEST["resiaddress1"];
	$pincode = trim($_REQUEST["ResiPin"]);
	$OfficeCity = $_REQUEST["office_city"];
	$officeddress = $_REQUEST["officeddress"];
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

	if($Gender==2) {
		$Gender="Female";
	}
	else
	{
		$Gender="Male";
	}
	
	//Save Only One Latest Selected Card for each bank
	$cardsclause="";
	//Get User Card Names
	$getCardsQry = "SELECT applied_card_name FROM Req_Credit_Card WHERE RequestID = '".$RequestID."'";
	$getCardsResult = d4l_ExecQuery($getCardsQry);
	$getCardsArr = d4l_mysql_fetch_assoc($getCardsResult);
	$getCards = $getCardsArr['applied_card_name'];
	if(empty($getCards)){
		$cardsclause=" applied_card_name = '".$card_name."'";
	}
	else{
		$CardsArr = explode(',', $getCards);
		$keyneedle1 = 'RBL';
		$keyneedle2 = 'American';
		
		//For RBL
		if(strpos($card_name, $keyneedle1) !== false){
			$checkRblBankCardArr = CheckItemInArray($CardsArr, $keyneedle1);
			if(count($checkRblBankCardArr)){
				$first_rbl_value = reset($checkRblBankCardArr); // First Element's Value
				$first_rbl_key = key($checkRblBankCardArr);
			}
			$CardsArr[$first_rbl_key] = $card_name;
		}
		
		//For AMEX
		if(strpos($card_name, $keyneedle2) !== false){
			$checkAmexBankCardArr = CheckItemInArray($CardsArr, $keyneedle2);
			if(count($checkAmexBankCardArr)){
				$first_amex_value = reset($checkAmexBankCardArr); // First Element's Value
				$first_amex_key = key($checkAmexBankCardArr);
			}
			$CardsArr[$first_amex_key] = $card_name;
		}
		
		$finalCardsName = implode(',', $CardsArr);
		$cardsclause=" applied_card_name = '".$finalCardsName."'";
	}


	$upcctblenw="Update Req_Credit_Card set Name='".$Name."',DOB='".$DOB."', Gender='".$Gender."', Email='".$Email."',Net_Salary='".$Net_Salary."',Residence_Address ='".$Residence_Address."', City='".$City."', Std_Code='".$STD."', Landline='".$Phone_Number."',Pancard='".$panno."', Employment_Status='".$Employment_Status."', Company_Name='".$CompanyName."', Pincode='".$pincode."',CC_Holder='".$CC_Holder."',Applied_With_Banks='".$selected_card_bank."', Office_Address='".$officeddress."', ".$cardsclause." Where (RequestID=".$RequestID.")";
	$resulupcctblenw=d4l_ExecQuery($upcctblenw);
	
	// Fetch AMEX card with card_id
	if($card_id==46) {
		$chosenCard="gold";
	}elseif($card_id==47){
		$chosenCard="platinumTravel";
	}elseif($card_id==50){
		$chosenCard="makeMyTrip";
	}elseif($card_id==71){
		$chosenCard="membershipreward";
	}else{
		$chosenCard="membershipreward";
	}
	
	// Fetch RBL card with card_name
	if($card_name=="RBL Bank Platinum Maxima Credit Card"){
		$CreditCardApplied=21;
	}elseif($card_name=="RBL Bank Platinum Delight Credit Card"){
		$CreditCardApplied=24;
	}elseif($card_name=="RBL Bank Titanium Delight Credit Card"){
		$CreditCardApplied=16;
	}else{
		$CreditCardApplied=16;
	}
	
	$Dated=ExactServerdate();
	/////////******* Update values in credit_card_banks_apply table for banks Start *******///////////
	if($validBank == 'Both' || $validBank == 'Amex'){
		$getAmexDetailsSql="SELECT id FROM credit_card_banks_apply WHERE cc_requestid='".$RequestID."' AND applied_bankname LIKE '%American Express%' ORDER BY id DESC";
		list($getAmexDetailsNumRows,$getAmexDetails)=Mainselectfunc($getAmexDetailsSql,$array = array());
		$amex_ccba_id = $getAmexDetails['id'];
		if($amex_ccba_id>0)
		{
			$DataArray = array("qualification" => $Qualification, "billing_preference" =>$BillingPrefernce, "office_city"=> $OfficeCity, "office_pincode"=> $OfficePin, "applied_bankname"=>"American Express","applied_cardname" =>$chosenCard, "lead_source"=>$lead_source);
			$wherecondition ="(id='".$amex_ccba_id."')";
			Mainupdatefunc ("credit_card_banks_apply", $DataArray, $wherecondition);
		}
		else
		{
			$DataArray= array("cc_requestid"=>$RequestID, "qualification" => $Qualification, "billing_preference" =>$BillingPrefernce, "office_city"=> $OfficeCity, "office_pincode"=> $OfficePin, "applied_bankname"=>"American Express", "applied_cardname" =>$chosenCard, "lead_source"=>$lead_source, "date_created"=>$Dated);
			Maininsertfunc("credit_card_banks_apply", $DataArray);
		}
	}
	
	if($validBank == 'Both' || $validBank == 'Rbl'){
		$getRblDetailsSql = "SELECT id FROM credit_card_banks_apply WHERE cc_requestid=".$RequestID." AND applied_bankname like '%RBL%' ORDER BY id DESC";
		list($getRblDetailsNumRows,$getRblDetails)=Mainselectfunc($getRblDetailsSql,$array = array());
		$rbl_ccba_id = $getRblDetails['id'];
		if($rbl_ccba_id>0)
		{
			$DataArray = array("qualification" => $Qualification, "applied_bankname"=>"RBL Bank","applied_cardname" =>$CreditCardApplied, "lead_source"=>$lead_source);
			$wherecondition ="(id='".$rbl_ccba_id."')";
			Mainupdatefunc ("credit_card_banks_apply", $DataArray, $wherecondition);
		}
		else
		{
			$DataArray= array("cc_requestid"=>$RequestID, "qualification" => $Qualification, "applied_bankname"=>"RBL Bank", "applied_cardname" =>$CreditCardApplied, "lead_source"=>$lead_source, "date_created"=>$Dated);
			Maininsertfunc("credit_card_banks_apply", $DataArray);
		}
	}
	/////////******* Update values in credit_card_banks_apply table for banks End *******///////////

	//Save Feedback
	if(strlen($ccfeedback)>0 || strlen($comment_section)>0)
	{
		$result = d4l_ExecQuery("SELECT FeedbackID FROM Req_Feedback_CC WHERE AllRequestID=".$RequestID." AND BidderID=".$bidderid." AND Reply_Type=4");
		$num_rows = d4l_mysql_num_rows($result);
		if($num_rows > 0)
		{
			$row = d4l_mysql_fetch_array($result);
			$strSQL="UPDATE Req_Feedback_CC SET Feedback='".$ccfeedback."',comment_section='".$comment_section."',Followup_Date='".$FollowupDate."', last_updated=Now()";
			$strSQL=$strSQL."WHERE FeedbackID = ".$row["FeedbackID"];
		}
		else
		{
			$strSQL="INSERT INTO Req_Feedback_CC(AllRequestID, BidderID, Reply_Type, Feedback, Followup_Date, comment_section, last_updated) Values (";
			$strSQL=$strSQL.$RequestID.",".$bidderid.",4,'".$ccfeedback."','".$FollowupDate."','".$comment_section."',Now())";
		}
		$result = d4l_ExecQuery($strSQL);
	}
}

//Get User Details From Req_Credit_Card
$ccdetails = "SELECT rcc.*, rfc.Feedback, rfc.comment_section, rfc.Followup_Date FROM Req_Credit_Card as rcc LEFT JOIN Req_Feedback_CC as rfc ON ((rfc.AllRequestID = rcc.RequestID) AND (rfc.BidderID IN (".$bidderid."))) WHERE RequestID = '".$requestid."'";
//echo $ccdetails;
$ccdetailsresult = d4l_ExecQuery($ccdetails);
$ccrow=d4l_mysql_fetch_array($ccdetailsresult);

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

$Mobile_Number = $ccrow["Mobile_Number"];
$Email = $ccrow["Email"];
$Gender = $ccrow["Gender"];
$Pancard = $ccrow["Pancard"];
list($year,$mm,$dd) = explode("-",$ccrow["DOB"]);
$applied_card_name = $ccrow["applied_card_name"];
$CC_Holder = $ccrow["CC_Holder"];
$Applied_With_Banks = $ccrow["selected_card_bank"];
$Residence_Address = $ccrow["Residence_Address"];
$Residence_Address = str_ireplace('|','',$Residence_Address);
$City = $ccrow["City"];
$Pincode = $ccrow["Pincode"];
$Office_Address= $ccrow["Office_Address"];
$Employment_Status = $ccrow["Employment_Status"];
$Net_Salary = $ccrow["Net_Salary"];
$monthlyincome = $ccrow["Net_Salary"]/12;
$CompanyName= $ccrow["Company_Name"];
$Std_Code= $ccrow["Std_Code"];
$Landline= $ccrow["Landline"];
$resilandline=$Std_Code."".$Landline;
$Feedback= $ccrow["Feedback"];
$followup_date= $ccrow["Followup_Date"];
$comment_section= $ccrow["comment_section"];
$Updated_Date = $ccrow["Updated_Date"];

$needle1 = 'American';
$needle2 = 'RBL';
if (strpos($applied_card_name,$needle1) !== false) {
    echo '<center><b>SELECTED Amex CARD</b></center>';
}
$needle = 'RBL';
if (strpos($applied_card_name,$needle2) !== false) {
    echo '<center><b>SELECTED RBL CARD</b></center>';
}

//Get User Details From credit_card_banks_apply
$ccbaDetailsSql = "SELECT office_city, office_pincode, billing_preference, qualification FROM credit_card_banks_apply WHERE cc_requestid=".$requestid." AND applied_bankname LIKE '%American%'";
$ccbaDetailsResult = d4l_ExecQuery($ccbaDetailsSql);
$ccbaDetailsRow = d4l_mysql_fetch_assoc($ccbaDetailsResult);

$OfficePin = $ccbaDetailsRow["office_pincode"];
$BillingPrefernce = $ccbaDetailsRow["billing_preference"];
$Qualification = $ccbaDetailsRow["qualification"];
$officecity = $ccbaDetailsRow["office_city"];


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Credit Card</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script language="javascript" type="text/javascript" src="scripts/datetime.js"></script>
<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
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
	var cityval = $('#City').val();
	checkvalidBank(cityval)

	$('#City').on('change',function(){
		var cityval = $(this).val();
		checkvalidBank(cityval)
	});
	
	function checkvalidBank(cityval){
		$.ajax({
			type: 'POST',
			data: {
				cityval : cityval,
				method : 'checkvalidbank',
			},
			success:function(response){
				console.log(response);
				$('#validBank').val(response);
				if(response == 'Both'){
					$('#resiCityVal').text('Valid for Both AMEX & RBL');
				}
				else if(response == 'Amex'){
					$('#resiCityVal').text('Valid for AMEX only');
				}
				else if(response == 'Rbl'){
					$('#resiCityVal').text('Valid for RBL only');
				}
			}
		});
	}
	
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
<input type="hidden" name="validBank" id="validBank" value="" />
<table cellpadding="0" cellspacing="0" align="center">
<tr><td>
<table style='border:1px dotted #9C9A9C;' cellspacing="0" cellpadding="5" width="700" height="80%" align="center" border="1" >
<tr><td colspan="4" align="center" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; height:25px;">Credit Card customer details
<br />
</td></tr>
<tr>
    <td width="180"><span class="style2">Customer Name: </span></td>
    <td width="392" colspan="3">
		<span class="style21">
			<input type="text" maxlength="15" size="13" name="first_name" id="first_name" value="<? echo $first_name; ?>" onkeypress="validateDiv('fnameVal');" />&nbsp;<input type="text" maxlength="15" size="11" name="middle_name" id="middle_name" value="<? echo $middle_name; ?>"/>&nbsp;<input type="text" maxlength="15" size="17" name="last_name" id="last_name" value="<? echo $last_name; ?>" onkeypress="validateDiv('fnameVal');" />
		</span>
		<div id="fnameVal"  class="alert_msg">
			<?php //if(strlen($first_name)<2 || strlen($first_name)>15){ echo "FirstName - Min : 1, Max : 15 Characters";}?>
			<?php //if(strlen($last_name)<2 || strlen($last_name)>15) { echo "LastName - Min : 1, Max : 15 Characters";}?>
		</div>
	</td>
</tr>
<tr>
	<td><span class="style2"> Mobile No: </span></td>
	<td><span class="style21"><? if($_SESSION['BidderID']==6729) { echo $Mobile_Number; } else { echo "XXXXXXXXXX"; } ?></span></td>
	<td><span class="style2"> Email: </span></td>
	<td><span class="style21">
		<input type="text" value="<? echo $Email; ?>" name="Email" id="Email" />
		<div id="emailVal"  class="alert_msg"><?php if(empty($Email)) { echo "EMail should be like - abc@xyx.com"; } ?></div></span>
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
			<option value="">Please Select</option>
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
			<?php //if($Qualification == '') { echo "Select Qualification"; } ?>
		</div>
	</td>
</tr>
<tr>
  	<td><span class="style2">Select Card</span></td>
    <td>
		<select name="card_dtvalues" id="card_dtvalues">
			<option value="">Please select </option>
			<?php $getcardNameSql = "SELECT cc_bankid,cc_bank_name FROM `credit_card_banks_eligibility` WHERE (`cc_bank_name` like '%American%' OR `cc_bank_name` like '%RBL%') and `cc_bank_flag`= 1 group by `cc_bank_name`";
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
		<div id="cardVal"  class="alert_msg">
			<?php if(strpos($applied_card_name, 'American') === false && strpos($applied_card_name, 'RBL') === false) { echo "Select Card";} ?>
		</div>
	</td>
	<td><span class="style2">Selected Card</span></td>
	<td><?php echo $applied_card_name; ?></td>
</tr>
<tr>
	<td><span class="style2">Do you hold any card?</span></td>
	<td>
		<input type="radio" id="CC_Holder" name="CC_Holder" value="1" class="css-checkbox" <?php if($CC_Holder==1) { echo "checked";} ?>>Yes</input>
		<input type="radio" id="CC_Holder" name="CC_Holder" value="2" class="css-checkbox" <?php if($CC_Holder==2 || $CC_Holder==0) { echo "checked";} ?>>No</input>
		<div class="alert_msg">
			<?php //if(intval($Net_Salary) < 1000000 && $CC_Holder == 2) { echo "Yo do not have existing card";} ?>
		</div>
	</td>
	<td class="card_bank" <?php if($CC_Holder==1){?>style="display:table-cell;"<?php }else{?>style="display:none;"<?php } ?>>
		<span class="style2">Select Card Bank</span>
	</td>
	<td class="card_bank" <?php if($CC_Holder==1){?>style="display:table-cell;"<?php }else{?>style="display:none;"<?php } ?>>
		<span class="style21">
		<select name="selected_card_bank" id="selected_card_bank">
			<option value="">Please Select</option>
			<option value="AMEX" <?php if($Applied_With_Banks=='AMEX') { echo "selected";} ?>>AMEX</option>
			<option value="SBI" <?php if($Applied_With_Banks=='SBI') { echo "selected";} ?>>SBI</option>
			<option value="ICICI" <?php if($Applied_With_Banks=='ICICI') { echo "selected";} ?>>ICICI</option>
			<option value="RBL" <?php if($Applied_With_Banks=='RBL') { echo "selected";} ?>>RBL</option>
			<option value="SCB" <?php if($Applied_With_Banks=='SCB') { echo "selected";} ?>>Standard Chartered Bank</option>
			<option value="Others" <?php if($Applied_With_Banks=='Others') { echo "selected";} ?>>Others</option>
		</select>
		</span>
		<div class="alert_msg">
			<?php //if(intval($Net_Salary) < 1000000 && $Applied_With_Banks=='AMEX') { echo "Already have AMEX Card";} ?>
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
			<?php //if(strlen($Residence_Address)<23) { echo "Address Should be minimum 24 characters"; } ?>
		</div>
	</td>
</tr>
<tr>
	<td><span class="style2">Residence City: </span></td>
    <td><span class="style21">
		<select size="1" name="City" id="City">
			<option value="">Please Select</option>
			<?php 
				$getAmexRblCitySql = "SELECT GROUP_CONCAT(City) as City FROM Bidders_List WHERE BidderID IN (5596,4905)";
				$getAmexRblCityResult = d4l_ExecQuery($getAmexRblCitySql);
				$getAmexRblCityArr = d4l_mysql_fetch_assoc($getAmexRblCityResult);
				$getAmexRblCity = $getAmexRblCityArr['City'];
				//Get Unique Amex and RBL City List
				$getAmexRblCity = array_unique(explode(',', $getAmexRblCity));
				$CityArr="";
				$CityArr = $getAmexRblCity;
				sort($CityArr);
				$optionCity = '';
				for($cityCount=0;$cityCount<count($CityArr);$cityCount++)
				{
					$selected="";
					if($CityArr[$cityCount]==$City){
						$selected="selected";
					}
					echo $optionCity = "<option value='".$CityArr[$cityCount]."' ".$selected.">".$CityArr[$cityCount]."</option>";
				}
			?>
		</select></span>
		<div id="resiCityVal"  class="alert_msg">
			<?php if(empty($City)) { echo "Select City"; } ?>
		</div>
	</td>  
	<td><span class="style2"></span></td>
	<td><span class="style21"></span></td>
</tr>  
<tr>
	<td><span class="style2"> Resi pincode: </span></td>
	<td><span class="style21">
		<input type="text" name="ResiPin" id="ResiPin" value="<?php echo $Pincode; ?>" maxlength="6" onKeyPress="intOnly(this);" /></span>
		<div id="rpincodeVal"  class="alert_msg">
			<?php if(strlen($Pincode)!=6) { echo "Pincode should be 6 digits"; } ?>
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
			<?php //if(strlen($Office_Address)<23) { echo "Office Address should be minimum 24 characters"; } ?>
		</div>
	</td>
</tr>
<tr>
	<td><span class="style2">Office City: </span></td>
    <td><span class="style21">
		<select size="1" name="office_city" id="office_city">  
			<option value="">Please Select</option>
			<?php 
				$getAmexRblCitySql = "SELECT GROUP_CONCAT(City) as City FROM Bidders_List WHERE BidderID IN (5596,4905)";
				$getAmexRblCityResult = d4l_ExecQuery($getAmexRblCitySql);
				$getAmexRblCityArr = d4l_mysql_fetch_assoc($getAmexRblCityResult);
				$getAmexRblCity = $getAmexRblCityArr['City'];
				//Get Unique Amex and RBL City List
				$getAmexRblCity = array_unique(explode(',', $getAmexRblCity));
				$CityArr="";
				$CityArr = $getAmexRblCity;
				sort($CityArr);
				$optionCity = '';
				for($cityCount=0;$cityCount<count($CityArr);$cityCount++)
				{
					$selected="";
					if($CityArr[$cityCount]==$officecity){
						$selected="selected";
					}
					echo $optionCity = "<option value='".$CityArr[$cityCount]."' ".$selected.">".$CityArr[$cityCount]."</option>";
				}
			?>
		</select></span>
		<div id="offcityVal"  class="alert_msg">
			<?php //if(empty($officecity)) { echo "Select Office City"; } ?>
		</div>
	</td>  
	<td><span class="style2"> Office pincode: </span></td>
	<td><span class="style21">
		<input type="text" name="OfficePin" id="OfficePin" value="<?php echo $OfficePin; ?>" maxlength="6"  onKeyPress="intOnly(this);" /></span>
		<div id="opincodeVal"  class="alert_msg">
			<?php //if(strlen($OfficePin)!=6) { echo "Pincode should be 6 digits"; } ?>
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
			<option value="">Please Select</option>
			<option value="1" <? if($Employment_Status == 1) {echo "Selected";}?>>Salaried</option>
			<option value="0" <? if($Employment_Status == 0) {echo "Selected";}?>>Self Employment</option>
		</select></span>
		<div id="empVal" class="alert_msg">
			<?php if($Employment_Status != 1 && $Employment_Status != 0) { echo "Select Employment Status"; } ?>
		</div>
	</td>
	<td><span class="style2"> Company Name: </span></td>
	<td><span class="style21">
		<input name="Company_Name" id="Company_Name" type="text" class="d4l-input" onkeyup="ajax_showOptions(this,'getCountriesByLetters',event)" style="width:200px;" maxlength="24" value="<? echo $CompanyName; ?>" /></span>
		<div id="compVal" class="alert_msg">
			<?php //if(empty($CompanyName)) { echo "Enter Company Name"; } ?>
		</div>
	</td>
</tr>   
<tr>
	<td><span class="style2"> Annual Income: </span></td>
	<td><span class="style21">
		<input type="text" name="Net_Salary" id="Net_Salary" value="<? echo $Net_Salary; ?>" onKeyPress="intOnly(this);"/></span>
		<div id="compVal"  class="alert_msg">
			<?php if(intval($Net_Salary) == 0 || strlen(intval($Net_Salary)) > 8) { echo "Salary should be between 1-8 characters"; } ?>
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
			<?php //if($BillingPrefernce!='0' && $BillingPrefernce!='5' && $BillingPrefernce!='9') { echo "Select Billing Preference"; } ?>
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
	<td width="392"><span class="style21"><? echo $Updated_Date; ?></span></td>
</tr> 
<tr>
	<td colspan="4" align="center"><input type="Submit" name="Submit" value="Submit" style="background-color:#529BE4;" /></td>
</tr>
</table>
</form>
</td></tr>
<tr>
<td align="right">
<?php
//Code to check if lead is already punched to RBL
$rblButtonQry = "SELECT request_data FROM credit_card_banks_apply WHERE applied_bankname LIKE '%RBL%' AND cc_requestid = '".$requestid."' ORDER BY date_created DESC";
$rblButtonResult = d4l_ExecQuery($rblButtonQry);
$rblButtonArr=d4l_mysql_fetch_array($rblButtonResult);
$rblButtonData=trim($rblButtonArr["request_data"]);
if(empty($rblButtonData)){
	$getrblSql = "SELECT Query,City FROM Bidders_List WHERE BidderID = 4905";
	$getrblQuery = d4l_ExecQuery($getrblSql);
	$getrblNumRows = d4l_mysql_num_rows($getrblQuery);
	if($getrblNumRows>0)
	{
		$City = d4l_mysql_result($getrblQuery,0,'City');
		$CityList =  str_replace(",", "', '", $City);	
		$sqlrbl = d4l_mysql_result($getrblQuery,0,'Query')." and Req_Credit_Card.RequestID='".$requestid."' and  Req_Credit_Card.City in ('".$CityList."')";	
		//echo $sqlrbl;
		$Queryrbl = d4l_ExecQuery($sqlrbl);
		$numRowsrbl = d4l_mysql_num_rows($Queryrbl);
		if($numRowsrbl>0)
		{
	?>
	<a href="rbl_webservice.php?requestid=<?php echo $requestid; ?>" style="color:#FFF; background-color:#C00;">RBL Send now</a>
	<?php 
		} 
	}
}
else{
	echo '<strong><span style="color:red;">Already punched for RBL</span><strong>';
	
}
?>
<?php
//Code to check if lead is already punched to AMEX
$amexButtonQry = "SELECT request_data FROM credit_card_banks_apply WHERE applied_bankname LIKE '%American%' AND cc_requestid = '".$requestid."' ORDER BY date_created DESC";
$amexButtonResult = d4l_ExecQuery($amexButtonQry);
$amexButtonArr=d4l_mysql_fetch_array($amexButtonResult);
$amexButtonData=trim($amexButtonArr["request_data"]);
if(empty($amexButtonData)){
	$getAmexSql = "SELECT Query,City FROM Bidders_List WHERE BidderID = 5596";
	$getAmexQuery = d4l_ExecQuery($getAmexSql);
	$getAmexNumRows = d4l_mysql_num_rows($getAmexQuery);
	if($getAmexNumRows>0)
	{
		$City = d4l_mysql_result($getAmexQuery,0,'City');
		$CityList =  str_replace(",", "', '", $City);
		
		$sqlAmex = d4l_mysql_result($getAmexQuery,0,'Query')." and Req_Credit_Card.RequestID='".$requestid."' and  Req_Credit_Card.City in ('".$CityList."')";
		//echo $sqlAmex;
		$QueryAmex = d4l_ExecQuery($sqlAmex);
		$numRowsAmex = d4l_mysql_num_rows($QueryAmex);
		if($numRowsAmex>0)
		{
	?>
	|
	<a href="amex_webservice.php?requestid=<?php echo $requestid; ?>" style="color:#FFF; background-color:#C00;">AMEX Send now</a>
	<?php 
		}
	}
}
else{
	echo '<strong><span style="color:red;">Already punched for AMEX</span><strong>';
}
?>
</td>
</tr>
<tr><td>
<table style='border:1px dotted #9C9A9C;' cellspacing="0" cellpadding="5" width="100%" height="80%" align="center" border="1" >
<tr>
	<td colspan="4" align="right">
	</td>
</tr>
<tr>
	<td colspan="4">
	<?php
	$amexDetailsQry = "SELECT request_data, response_data FROM credit_card_banks_apply WHERE applied_bankname LIKE '%American%' AND cc_requestid = '".$requestid."' ORDER BY date_created DESC";
	$amexDetailsResult = d4l_ExecQuery($amexDetailsQry);
	$amexDetailsArr=d4l_mysql_fetch_array($amexDetailsResult);
	$amexRequestData=trim($amexDetailsArr["request_data"]);
	$amexResponseData=trim($amexDetailsArr["response_data"]);
	
	if(isset($amexResponseData) && !empty($amexResponseData)){
		echo "<b>AMEX Response:</b> <br>";
		
		$xmlArray = str_ireplace('<soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema"><soap:Body>','',$amexResponseData);
		$xmlArray = str_ireplace('</soap:Body></soap:Envelope>','',$xmlArray);
		$xmlArray = simplexml_load_string($xmlArray);
		$amexJson = json_encode($xmlArray);
		$amexResponseArray = json_decode($amexJson,true);
		if(isset($amexResponseArray['submitApplicationResult'])){
			$amexResponse = $amexResponseArray['submitApplicationResult']; 
			if(isset($amexResponse) && $amexResponse['status']['success'] == "true"){
				if($amexResponse['successResponse']['approved'] == "true"){
					echo "<br>The Application is submitted successfully.<br>";
				}
				elseif($amexResponse['successResponse']['decline'] == "true"){ 
					echo "The Application is Decline.<br>";
					foreach($amexResponse['successResponse']['declineReason'] as $key=>$reason){
						if($reason == "true"){
							echo "Decline reason : $key.<br>";
						}
					}
				}
				elseif($amexResponse['successResponse']['pending'] == "true"){
					echo "The Application is Pending.";
				}
				elseif($amexResponse['successResponse']['cancelled'] == "true"){
					echo "The Application is Cancelled.";
				}
			}else{
				if($amexResponse['failureResponse']['validationError']['errorDesc']){
					echo "The Application is rejected for now.<br>";
					echo "Reason : ".$amexResponse['failureResponse']['validationError']['errorDesc'];
				}
				elseif($amexResponse['failureResponse']['unhandledException'] == "true"){
					echo "The Application is rejected for now.<br>";
					echo "Reason : unhandled Exception";
				}
			}
		}
	}
	
	if(!empty($amexRequestData) && isset($amexResponseData) && empty($amexResponseData)){
		echo "No Response From Amex.<br>";
	}
	?>
	</td>
</tr>
<tr>
	<td colspan="4"> 
	<?php 
	$rblDetailsQry = "SELECT response_data FROM credit_card_banks_apply WHERE applied_bankname LIKE '%RBL%' AND cc_requestid='".$requestid."' ORDER BY date_created DESC";
	$rblDetailsResult = d4l_ExecQuery($rblDetailsQry);
	$rblDetailsArr = d4l_mysql_fetch_array($rblDetailsResult);
	$rblResponseData = $rblDetailsArr["response_data"];
	$rblResponseDataFinal = explode(",", trim($rblResponseData));
	if(!empty($rblResponseData)){
		echo "<b>RBL Response:</b> <br>";
		for($r=0;$r<count($rblResponseDataFinal);$r++){
			echo $rblResponseDataFinal[$r]."<br>";
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
function split_on($string, $num) {
	$length = strlen($string);
	$output[0] = substr($string, 0, $num);
	$output[1] = substr($string, $num, $length );
	return $output;
}

function CheckItemInArray($data, $input){
	$result = array_filter($data, function ($item) use ($input) {
		if (stripos($item, $input) !== false) {
			return true;
		}
		return false;
	});
	
	return $result;
}
?>
