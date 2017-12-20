<?php
//Return Page from ICCS Predective Call

$ReqID = $_REQUEST["postid"];
$BidID = $_REQUEST["biddt"];
$requestid = $_REQUEST["postid"];

require 'scripts/session_check_online.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';


if($BidID==1001) { $BidID= 7028; }
else if($BidID==1002) { $BidID= 7029;}
else if($BidID==1003) { $BidID= 7030;}
else if($BidID==1004) { $BidID= 7031;}
else if($BidID==1005) { $BidID= 7032;}
else if($BidID==1006) { $BidID= 7033;}
else if($BidID==1007) { $BidID= 7034;}
else if($BidID==1008) { $BidID= 7035;}

$updateqry= "Update lead_allocate set BidderID='".$BidID."' Where AllRequestID = '".$ReqID."' and BidderID=6449";
$updateqryresult = d4l_ExecQuery($updateqry);

$bidderid = $BidID;

if($_SESSION["BidderID"] != $BidID) {  echo "You are not authorised to view this details."; die();  }

$getAgentSql = "select BidderID from Bidders Where leadidentifier NOT IN ('diallercallerccpredictive','diallerleadccsmsnew') AND BidderID='".$_SESSION["BidderID"]."'";
$getAgentQuery = d4l_ExecQuery($getAgentSql);
$getAgentNumRows = d4l_mysql_num_rows($getAgentQuery);
if($getAgentNumRows>0) {  echo "You are not authorised to view this details.."; die();  }

$getAgentCheckSql = "select AllRequestID from lead_allocate Where AllRequestID = '".$requestid."' and BidderID='".$_SESSION["BidderID"]."'";
$getAgentCheckQuery = d4l_ExecQuery($getAgentCheckSql);
$getAgentCheckNumRows = d4l_mysql_num_rows($getAgentCheckQuery);
if($getAgentCheckNumRows>0) { }  else { echo "You are not authorised to view this details..."; die(); }


function ccMasking($number, $maskingCharacter = 'X') 
{
	return substr($number, 0, 2) . str_repeat($maskingCharacter, strlen($number) - 4) . substr($number, -2);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	foreach($_POST as $a=>$b)
		$$a=$b;
	$RequestID = FixString($RequestID);
	$sbiccid = FixString($sbiccid);
	$productflag= FixString($productflag);
	$Email = FixString($Email);
	$Gender = FixString($Gender);
	$panno = FixString($panno);
	$City = FixString($City);
	$City_Other = FixString($City_Other);
	$State = GetCityStatecCode($City);
	$postpaid_mobile = FixString($postpaid_mobile);
	$pincode = FixString($ResiPin);
	$Net_Salary = FixString($Net_Salary);
	$Employment_Status = FixString($Employment_Status);
	$comment_section = FixString($comment_section);
	$ccfeedback = FixString($ccfeedback);
	$FollowupDate  = FixString($FollowupDate);
	$ResidenceAddress1 = $_REQUEST["ResidenceAddress1"];
	$ResidenceAddress2 = $_REQUEST["ResidenceAddress2"];
	$ResidenceAddress3 = $_REQUEST["ResidenceAddress3"];
	$ResidenceAddress = $ResidenceAddress1." ".$ResidenceAddress2." ".$ResidenceAddress3;
	$CompanyName = FixString($Company_Name);
	$OfficeAddress1 = FixString($OfficeAddress1);
	$OfficeAddress2 = FixString($OfficeAddress2);
	$OfficeAddress3 = FixString($OfficeAddress3);
	$OfficeAddress = $OfficeAddress1." ".$OfficeAddress2." ".$OfficeAddress3;
	$OfficePin = FixString($OfficePin);
	$Land_linenumber = FixString($Land_linenumber);
	$OfficeCity = FixString($OfficeCity);
	$Phone_Number = FixString($Phone_Number);	
	$OfficeState = GetCityStatecCode($OfficeCity);
	$Qualification = FixString($Qualification);
	$Designation = FixString($Designation);	
	$card_name = FixString($card_name);
	$STD = "0".FixString($STD);
	$resiSTD = FixString($resiSTD);
	$opt_citicard = FixString($opt_citicard); //citibank option
	$citicard_name = FixString($citicard_name);
	$resiPhone_Number = FixString($resiPhone_Number);;
	$first_name = FixString($first_name);
	$middle_name = FixString($middle_name);
	$last_name = FixString($last_name);
	$Submitciti = FixString($Submitciti);//Citibank Form
	$mailing_address = FixString($mailing_address);
	$citiDesignation = FixString($citiDesignation);
	$dcb_bank = FixString($dcb_bank);
	$CC_Holder = FixString($CC_Holder);
	$sbicardholder = FixString($sbicardholder);
	$sbicardapplied = FixString($sbicardapplied);
	$sbirelation = FixString($sbirelation);
	$account_number = FixString($account_number);
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
	$card_id = $_POST["card_id"];
	$Dated=ExactServerdate();

	if(strlen($ccfeedback)>0 && $ccfeedback=="Send Now")
	{
		$pushflag=1;
	}
	if(strlen($panno)==10)
	{
		$insert_pancard = " , Pan_card='".$panno."' ";
	}
	if($sbiccid>0)
	{
		$insert_productflag = '';
		if($productflag==0)
		{
			$insert_productflag = " , productflag='44' ";
		}
	
		$ccupqry="Update sbi_credit_card_5633 set pushflag='".$pushflag."',RequestID='".$RequestID."',CompanyName='".$Company_Name."',ResidenceAddress1='".$ResidenceAddress1."',ResidenceAddress2='".$ResidenceAddress2."',ResidenceAddress3='".$ResidenceAddress3."',OfficeAddress1='".$OfficeAddress1."',OfficeAddress2='".$OfficeAddress2."',OfficeAddress3='".$OfficeAddress3."',OfficePin='".$OfficePin."',OfficeCity='".$OfficeCity."',LandlineNo='".$Phone_Number."',OfficeState='".$OfficeState."',Qualification='".$Qualification."',CardName='".$card_name."',Designation='".$Designation."',sbi_cc_holder='".$sbicardholder."',applied_in_6_months='".$sbicardapplied."',relationship_type='".$sbirelation."',account_number='".$account_number."',Dated='".$Dated."',table_name='Req_Credit_Card_Sms' ".$insert_productflag." ".$insert_pancard." Where (sbiccid='".$sbiccid."')";
	}
	else
	{
		$ccMobileSql = "select Mobile_Number from Req_Credit_Card_Sms Where (RequestID=".$RequestID.")";
		$ccMobileSqlresult = d4l_ExecQuery($ccMobileSql);
		$ccMobilerow=d4l_mysql_fetch_array($ccMobileSqlresult);
		$ccMobile_Number = $ccMobilerow["Mobile_Number"];
	
		$ccupqry="INSERT IGNORE INTO sbi_credit_card_5633 set RequestID='".$RequestID."',CompanyName='".$Company_Name."',ResidenceAddress1='".$ResidenceAddress1."',ResidenceAddress2='".$ResidenceAddress2."',ResidenceAddress3='".$ResidenceAddress3."',OfficeAddress1='".$OfficeAddress1."',OfficeAddress2='".$OfficeAddress2."',OfficeAddress3='".$OfficeAddress3."',OfficePin='".$OfficePin."',OfficeCity='".$OfficeCity."',LandlineNo='".$Phone_Number."',OfficeState='".$OfficeState."',Qualification='".$Qualification."',CardName='".$card_name."',Designation='".$Designation."', sbi_cc_holder='".$sbicardholder."',applied_in_6_months='".$sbicardapplied."',relationship_type='".$sbirelation."',account_number='".$account_number."',Dated='".$Dated."',pushflag='".$pushflag."', productflag='44', table_name='Req_Credit_Card_Sms', agent_id='".$BidID."', MobileNumber='".$ccMobile_Number."'  ".$insert_pancard." ";
	}
	//echo $ccupqry;
	$ccupqrynw=d4l_ExecQuery($ccupqry);
 
	if(strlen($City)>0)
	{
		$cityclause=", City='".$City."'";
		if(strlen($City_Other)>0)
		{
			$othercityclause=", City_Other='".$City_Other."'";
		}
	}

	if($resiPhone_Number>0)
	{
		$resi_landline=$resiPhone_Number;
	}
	else
	{
		$resi_landline=$postpaid_mobile;
	}
	$upcctblenw="Update Req_Credit_Card_Sms set Name='".$Name."',DOB='".$DOB."',Company_Name='".$Company_Name."',Std_Code='".$resiSTD."',Landline='".$resi_landline."', Email='".$Email."',Net_Salary='".$Net_Salary."',Gender='".$Gender."',Residence_Address ='".$ResidenceAddress1."',State='".$State."', Office_Address='".$OfficeAddress."',Employment_Status='".$Employment_Status."',CC_Holder='".$CC_Holder."', Pancard='".$panno."', Updated_Date=Now(), Pincode='".$pincode."' ".$cityclause." ".$othercityclause." Where (RequestID=".$RequestID.")";
	$resulupcctblenw=d4l_ExecQuery($upcctblenw);	

	if(strlen($ccfeedback)>0 || strlen($comment_section)>0)
	{
		if($ccfeedback=="Process")
		{
			$last_updated=Date('Y-m-d');
		}
		else
		{
			$last_updated="";
		}
		$strSQL="";
		$Msg="";
		$result = d4l_ExecQuery("select RequestID,not_contactable_counter from Req_Credit_Card_Sms where RequestID=".$requestid."");
		$num_rows = d4l_mysql_num_rows($result);
		if($num_rows > 0)
		{	
			$row = d4l_mysql_fetch_array($result);
			$strSQL="Update Req_Credit_Card_Sms Set Feedback='".$ccfeedback."',comment_section='".$comment_section."',Followup_Date='".$FollowupDate."', sendnow_date='".$last_updated."'";
			$strSQL=$strSQL."Where RequestID=".$row["RequestID"];
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
	if($dcb_bank=="DCB")
	{
		$result = d4l_ExecQuery("select id from credit_card_banks_apply where (cc_requestid=".$requestid." and applied_bankname like '%DCB%')");
		$num_rows = d4l_mysql_num_rows($result);
		if($num_rows>0)
		{	}
		else
		{
			$strDCBSQL="Insert into credit_card_banks_apply(cc_requestid, lead_source, applied_bankname , date_created) Values ('".$requestid."','SMS LMS','DCB Bank',Now())";
			$DCBresult = d4l_ExecQuery($strDCBSQL);
		}
	}

}
$followup_date="";
$ccdetails = "select Gender,Landline,Std_Code, Account_No,Pancard_No,Pancard,Employment_Status, CC_Holder,Dated,DOB,Name,Email,Company_Name,City, City_Other,Mobile_Number,Net_Salary,Loan_Amount,Pincode,IP_Address,Add_Comment,Residence_Address, applied_card_name,Office_Address,Updated_Date, UserID from  Req_Credit_Card_Sms Where (RequestID=".$requestid.")";
$ccdetailsresult = d4l_ExecQuery($ccdetails);
$ccrow=d4l_mysql_fetch_array($ccdetailsresult);
$applied_card_name = $ccrow["applied_card_name"];
$UserID = $ccrow["UserID"];

$needle = 'SBI';
if (strpos($applied_card_name,$needle) !== false) {
    echo '<center><b>SELECTED SBI CARD</b></center>';
}
$Gender = $ccrow["Gender"];
$Landline = $ccrow["Landline"];
$Std_Code = $ccrow["Std_Code"];
$City = $ccrow["City"];
/*
$OffiAddress= $ccrow["Office_Address"];
$stroffiadd = round((strlen($OffiAddress)/3));
$offiadd = str_split($OffiAddress, $stroffiadd);
$OfficeAddress1 = $offiadd[0];
$OfficeAddress2 = $offiadd[1];
$OfficeAddress3 = $offiadd[2];
$Residence_Address = $ccrow["Residence_Address"];
$Residence_Address = str_ireplace('|','',$Residence_Address);
*/
list($year,$mm,$dd) = split("[-]",$ccrow["DOB"]);
list($first_name,$middle_name,$last_name) = split("[ ]",$ccrow["Name"]);
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
$cc_alldetailsSql = "select * from sbi_credit_card_5633 Where (RequestID='".$requestid."' AND productflag='44') ORDER BY  sbiccid DESC LIMIT 0,1";
$cc_alldetails = d4l_ExecQuery($cc_alldetailsSql);
$ccrowal=d4l_mysql_fetch_array($cc_alldetails);
$ResidenceAddress1 = $ccrowal["ResidenceAddress1"];
$ResidenceAddress2 = $ccrowal["ResidenceAddress2"];
$ResidenceAddress3 = $ccrowal["ResidenceAddress3"];
$OfficeAddress1 = $ccrowal["OfficeAddress1"];
$OfficeAddress2 = $ccrowal["OfficeAddress2"];
$OfficeAddress3 = $ccrowal["OfficeAddress3"];
$Qualification = $ccrowal["Qualification"];
$Designation = $ccrowal["Designation"];
$CardName = $ccrowal["CardName"];
$LandlineNo = $ccrowal["LandlineNo"];
$OfficePin = $ccrowal["OfficePin"];
$OfficeCity = $ccrowal["OfficeCity"];
$sbiccid = $ccrowal["sbiccid"];
$productflag= $ccrowal["productflag"];
$account_number = $ccrowal["account_number"];
if($ccrow["Employment_Status"]==0)
{
	$emp_status="Self Employed";
}
else
{
	$emp_status="Salaried";
}
if($ccrow["CC_Holder"]==1)
{
	$cc_holder="Yes";
}
if($ccrow["CC_Holder"]==0)
{
	$cc_holder="No";
}

if($ccrow["Card_Vintage"]==1)
{
	$card_vintage="Less than 6 months";
}
elseif($ccrow["Card_Vintage"]==2)
{
	$card_vintage="6 to 9 months";
}
elseif($ccrow["Card_Vintage"]==3)
{
	$card_vintage="9 to 12 months";
}
elseif($ccrow["Card_Vintage"]==4)
{
	$card_vintage="more than 12 months";
}
else{
	$card_vintage="";
}
if(strlen($ccrowal["CompanyName"])>1)
{
	$CompanyName = $ccrowal["CompanyName"];
}
else
{
	$CompanyName = $ccrow["Company_Name"];
}
if(strlen($CompanyName)>1)
{
	$sbi_category="";
	$sbi_companycat= d4l_ExecQuery('select * from sbi_cc_company_list Where (sbi_companyname="'.$CompanyName.'")');
	$sbicomp=d4l_mysql_fetch_array($sbi_companycat);
	$sbi_category= $sbicomp["sbi_category"];
}

$ccfb_alldetails = d4l_ExecQuery("select * from Req_Credit_Card_Sms Where (RequestID=".$requestid.")");
$ccrowfb=d4l_mysql_fetch_array($ccfb_alldetails);
$Feedback= $ccrowfb["Feedback"];
$followup_date= $ccrowfb["Followup_Date"];
$comment_section= $ccrowfb["comment_section"];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Credit Card</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script language="javascript" type="text/javascript" src="scripts/datetime.js"></script>
<script type="text/javascript" src="ajax.js"></script>
<script type="text/javascript" src="ajax-dynamic-sbicclist.js"></script>
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
<!--
.style2 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold;}
.style21 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size:12px;}
-->
</style>
<script>
$(document).ready(function(){
	
	<?php if($ccrowal["relationship_type"] == "Yes"){?>
		$('#account_number_div').show();
	<?php } ?>
	
	$('input[name="sbirelation"]').on('click', function(){
		var value = $('input[name="sbirelation"]:checked').val()
		if(value == 'Yes'){
			$('#account_number_div').show();
		}
		else{
			$('#account_number_div').hide();
		}
	});
	
	$('[name="sendform"]').submit(function() {
		$('#submitbtn').prop('disabled',true);
		$('#submitbtn').css({ 'background-color': '#000' });
	});
	
	$('#validatepanbtn').click(function() {
		$('#validatepanbtn').prop('disabled',true);
		$('#validatepanbtn').css({ 'background-color': '#000' });
	});
});
</script>
<script>

var ajaxRequestMain;  // The variable that makes Ajax possible!
function ajaxFunctionMain(){
	try{
		// Opera 8.0+, Firefox, Safari
		ajaxRequestMain = new XMLHttpRequest();
	} catch (e){
		// Internet Explorer Browsers
		try{
			ajaxRequestMain = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {
			try{
				ajaxRequestMain = new ActiveXObject("Microsoft.XMLHTTP");
			} catch (e){
				// Something went wrong
				alert("Your browser broke!");
				return false;
			}
		}
	}
}

function getPanValidate()
{
	var	pan=document.getElementById('panno').value;;
	var product = "CCSMS";
	var RequestID = <?php echo $requestid; ?>;
	
	$.ajax({
		type: 'POST',
		url: 'pancard_validation.php',
		data: {
			product: product,
			RequestID: RequestID,
			pancard:pan,
		},
		success: function (response) {
		console.log(response);
			//var obj = JSON.parse(response);
			document.getElementById('panvalidation').innerHTML = response;
		}
	});
}

function getCityFromPin(fieldname,pin)
{
	var	pin_code =document.getElementById(pin).value;	
	$.ajax({
		type: 'POST',
		url: 'getcityfrompin.php',
		data: {
			pin_code: pin_code,
		},
		success: function (response) {
			//console.log(response);
			document.getElementById(fieldname).value = response;
		}
	});
}


window.onload = ajaxFunctionMain;
</script>
<style>
.validate_btn {background: #0785e8; padding: 5px; width:63px; text-align:center;  border-radius:5px;  font-size:13px; color:#FFF; font-family: Arial, Helvetica, sans-serif;}

.p-text{font-family: Arial, Helvetica, sans-serif; font-size: 12px;}
</style>
</head>
<body>
<table cellpadding="0" cellspacing="0" align="center">
<tr><td>
<?php 
if($process=="cq")
{
?>
<form name="loan_form" method="post" action="<? echo $_SERVER['PHP_SELF'] ?>?postid=<?echo $requestid;?>&biddt=<? echo $bidderid;?>&process="<?php echo $process; ?>"" >
<?php
}
else {
?>
<form name="loan_form" method="post" action="<? echo $_SERVER['PHP_SELF'] ?>?postid=<?echo $requestid;?>&biddt=<? echo $bidderid;?>" >
<?php } ?>
<input type="hidden" name="biddtnw" value="<? echo $bidderid;?>" />
<input type="hidden" name="RequestID" value="<? echo $requestid;?>" />
<input type="hidden" name="sbiccid" value="<? echo $sbiccid;?>" />
<input type="hidden" name="productflag" readonly="readonly" value="<? echo $productflag;?>" />
<table style='border:1px dotted #9C9A9C;' cellspacing="0" cellpadding="5" width="700" height="80%" align="center" border="1" >
<tr><td colspan="4" align="center" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; height:25px;">Credit Card customer details</td></tr>
<tr>
	<td width="180"><span class="style2">Customer Name: </span></td>
    <td width="392" colspan="3"><span class="style21"><input type="text" maxlength="12" size="13" name="first_name" id="first_name" value="<? echo $first_name; ?>" />&nbsp;<input type="text" maxlength="10" size="11" name="middle_name" id="middle_name" value="<? echo $middle_name; ?>"/>&nbsp;<input type="text" maxlength="16" size="17" name="last_name" id="last_name" value="<? echo $last_name; ?>" /></span></td>
</tr>
<tr>
	<td><span class="style2"> Mobile No: </span></td>
	<td><span class="style21"><? echo ccMasking($ccrow["Mobile_Number"]); ?></span></td>
	<td><span class="style2"> Email: </span></td>
	<td><span class="style21"><input type="text" maxlength="40" value="<? echo $ccrow["Email"];?>" name="Email" id="Email" /></span></td>
</tr>
<tr>
	<td><span class="style2"> DOB: </span></td>
	<td><span class="style21">
		<?php echo listbox_date('day',$dd);?>
		<?php echo listbox_month('month', $mm);?>
		<?php $minage= Date('Y')-18; $maxage=Date('Y')-62; echo listbox_year('year',$maxage,$minage, $year);?></span>
	</td>
	<td><span class="style2"> Gender: </span></td>
	<td><span class="style21">
		<select name="Gender" id="Gender" >
			<option value="-1">Please Select</option>
			<option value="Male" <? if($Gender=="Male") {echo "selected";} ?>>Male</option>
			<option value="Female" <? if($Gender=="Female") {echo "selected";} ?>>Female</option>
		</select></span>
	</td>
</tr>    
<tr>
  	<td><span class="style2">PanCard No</span></td>
    <td><input type="text" class="d4l-input" name="panno" id="panno" value="<? echo $ccrow["Pancard"] ;?>"  maxlength="10"/><span id="panvalidation"><input type="button" id="validatepanbtn" onclick="getPanValidate();" class="validate_btn" value="Validate"></input></span></td>
    <td><span class="style2">Qualification</span></td>
    <td><span class="style21">
		<select name="Qualification" id="Qualification">
			<option value="">Please Select</option>
            <option  value="10 or below" <? if($Qualification=="10 or below") { echo "Selected"; }?> >Metric or below</option>
            <option value="Plus 2 or below" <? if($Qualification=="Plus 2 or below") { echo "Selected"; }?> >Higher secondary </option>
            <option value="Graduate" <? if($Qualification=="Graduate") { echo "Selected"; }?>>Graduation</option>
            <option value="Post graduate" <? if($Qualification=="Post graduate") { echo "Selected"; }?> >Postgraduate and above</option>
		</select></span>
	</td>
</tr>
<tr>
  	<td><span class="style2">Select Card</span></td>
    <td>
		<select name="card_name" id="card_name">
			<option value="">Please select </option>
			<? $getcardNameSql = "SELECT cc_bankid,cc_bank_name FROM `credit_card_banks_eligibility` WHERE (`cc_bank_name` like '%SBI%' and `cc_bank_flag`=1) group by `cc_bank_name`";
			list($numRowsCardName,$getCardNameQuery)=MainselectfuncNew($getcardNameSql,$array = array());

			for($cN=0;$cN<$numRowsCardName;$cN++)
			{
				$Card_id = $getCardNameQuery[$cN]['cc_bankid'];
				$cc_bank_name = $getCardNameQuery[$cN]['cc_bank_name'];
				?>
			<option value="<?php echo $cc_bank_name; ?>" <? if($cc_bank_name==$CardName) { echo "Selected";} ?>><?php echo ucwords(strtolower($cc_bank_name)); ?></option>
			<?php
			}
			?>
		</select>
	</td>
	<td><span class="style2">Selected Card</span></td>
	<td><?php echo $applied_card_name; ?></td>
</tr>
<tr>
	<td colspan="2"><span class="style2">do you hold any card?</span></td>
	<td colspan="2">
		<input type="radio" name="CC_Holder" id="radio-one" value="1" class="css-checkbox" <?php if($ccrow["CC_Holder"]==1) { echo "checked";} ?> />
		<label for="radio-one" class="css-label radGroup2" >Yes</label>
        <input type="radio" name="CC_Holder" id="radio-two" value="2" class="css-checkbox" <?php if($ccrow["CC_Holder"]==2) { echo "checked";} ?>/>
		<label for="radio-two" class="css-label radGroup2">No</label>
	</td>
</tr>
<tr>
	<td colspan="4" align="center" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; height:25px;">Residence details</td>
</tr>
<tr>
	<td><span class="style2"> Resi Address: </span></td>
	<td colspan="3">
		<span class="style21" >
		<input type="text" maxlength="40" size=25 name="ResidenceAddress1" id="ResidenceAddress1" value="<? echo $ResidenceAddress1; ?>" placeholder="Address Line 1" />
		&nbsp;
		<input type="text" maxlength="40" size=25 name="ResidenceAddress2" id="ResidenceAddress2" value="<? echo $ResidenceAddress2; ?>" placeholder="Address Line 2"/>
		<br /><br />
		<input type="text" maxlength="40" size=25 name="ResidenceAddress3" id="ResidenceAddress3" value="<? echo $ResidenceAddress3; ?>" placeholder="Address Line 3"/>
		</span>
	</td>
</tr>
<tr>
	<td><span class="style2">Residence Pincode: </span></td>
    <td><span class="style21">
		<input type="text" value="<? echo $ccrow["Pincode"]; ?>" name="ResiPin" id="ResiPin" maxlength="6" /></span> <input type="button" id="GetCitybtn" onclick="getCityFromPin('City','ResiPin');" class="validate_btn" value="GetCity" />
	</td>
	<td><span class="style2" > City: </span></td>
	<td><span class="style21">
		<input type="text" value="<? echo trim($City); ?>" name="City" id="City" readonly="readonly" /></span>
	</td>
</tr> 
<tr>
	<td><span class="style2"></span></td>
	<td><span class="style21"></span></td>
	<td><span class="style2"> Resi number: </span></td>
	<td><table cellpadding="2" cellspacing="2">
			<tr>
				<td>
				<div id="resitxtHint2" style="float:left; width:50px;"><input type="text" class="std"  name="resiSTD" value="<? echo $Std_Code; ?>"  onfocus="(this.value == 'STD') && (this.value = '')"   onblur="(this.value == '') && (this.value = 'STD')" id="resiSTD" maxlength="7" style="width:50px;"></div>
				</td>
				<td>
				<input type="text" class="stdnumber" id="resiPhone_Number" name="resiPhone_Number" value="<? echo $Landline; ?>" maxlength="8" size="10" onkeypress='return event.charCode >= 48 && event.charCode <= 57'/>
				</td>
			</tr>
		</table>
	</td>
</tr>
<tr>
	<td><span class="style2"> Post-paid mobile number: </span></td>
	<td>
		<table cellpadding="2" cellspacing="2">
			<tr><td>
				+91<input type="text" class="stdnumber" id="postpaid_mobile" name="postpaid_mobile" value="<? echo $Landline; ?>" maxlength="10" size="15" onkeypress='return event.charCode >= 48 && event.charCode <= 57'/>
				</td>
			</tr>
		</table>
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
	<td><span class="style2"> Designation: </span></td>
	<td><span class="style21">
		<select name="Designation" id="Designation" >
           <option value="">Select Designation</option>
           <?php 
			$getdesgeSql = "SELECT * FROM sbi_cc_designation";
			list($numRowsgetdesge,$getdesgeSqlQuery)=MainselectfuncNew($getdesgeSql,$array = array());

			for($cN=0;$cN<$numRowsgetdesge;$cN++)
			{
				$designation = $getdesgeSqlQuery[$cN]['designation'];
				?> <option value="<?php echo $designation; ?>" <? if($designation ==$Designation) echo "selected"; ?>><?php echo ucwords(($designation)); ?></option>
							  <?php
			}
			?>
			<option value="Other" <? if($Designation=="Other") echo "selected"; ?>>Other</option>
		</select></span>
	</td>
	<td><span class="style2"> Annual Income: </span></td>
	<td><span class="style21"><input type="text"  name="Net_Salary" id="Net_Salary" value="<? echo $ccrow["Net_Salary"]; ?>"/></span></td>
</tr>
<tr>
	<td><span class="style2"> Office Address: </span></td>
	<td colspan="3">
		<span class="style21" >
			<input type="text" maxlength="40" size=25 name="OfficeAddress1" id="OfficeAddress1" value="<? echo $OfficeAddress1; ?>" placeholder="Address Line 1" />
			&nbsp;
			<input type="text" maxlength="40" size=25 name="OfficeAddress2" id="OfficeAddress2" value="<? echo $OfficeAddress2; ?>" placeholder="Address Line 2"/>
			<br /><br />
			<input type="text" maxlength="40" size=25 name="OfficeAddress3" id="OfficeAddress3" value="<? echo $OfficeAddress3; ?>" placeholder="Address Line 3"/>
		</span>
	</td>
</tr>
<tr>
	<td><span class="style2">Office pincode: </span></td>
	<td><span class="style21">
		<input type="text" value="<? echo $OfficePin; ?>" name="OfficePin" id="OfficePin" maxlength="6" /></span>
		<input type="button" id="GetCitybtn" onclick="getCityFromPin('OfficeCity','OfficePin');" class="validate_btn" value="GetCity" />
	</td>
	<td><span class="style2" >Office City: </span></td>
	<td><span class="style21"><input type="text" value="<? echo trim($OfficeCity); ?>" name="OfficeCity" id="OfficeCity" readonly="readonly" /></span>
	</td>
</tr>
<tr>
	<td><span class="style2"> Office number: </span></td>
	<td>
		<table cellpadding="2" cellspacing="2">
			<tr>
				<td>
					<div id="txtHint2" style="float:left; width:50px;"><input type="text" class="std"  name="STD"  onfocus="(this.value == 'STD') && (this.value = '')" onblur="(this.value == '') && (this.value = 'STD')" id="STD" maxlength="7" style="width:50px;"></div>
				</td>
				<td>
					<input type="text" class="stdnumber" id="Phone_Number" name="Phone_Number"  value="<? echo $LandlineNo; ?>" maxlength="8" onkeydown="Land_linenumberVal2" size="10" onkeypress='return event.charCode >= 48 && event.charCode <= 57'/>
				</td>
			</tr>
		</table>
	</td>
	<td><span class="style2">Company Category</span></td>
	<td><? echo $sbi_category;?></td>
</tr>   
<tr>
	<td colspan="4" align="center" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; height:25px;">For SBI Only</td>
</tr>
<tr>
	<td colspan="2"><span class="style2">Do you already have an SBI Credit Card?</span></td>
	<td colspan="2">
		<input type="radio" name="sbicardholder" id="radio-three" value="Yes" class="css-checkbox" <?php if($ccrowal["sbi_cc_holder"]=="Yes") { echo "checked";} ?> />
		<label for="radio-three" class="css-label radGroup2" >Yes</label>
        <input type="radio" name="sbicardholder" id="radio-four" value="No" class="css-checkbox" <?php if($ccrowal["sbi_cc_holder"]=="No") { echo "checked";} ?>/>
		<label for="radio-four" class="css-label radGroup2">No</label>
	</td>
</tr>
<tr>
	<td colspan="2"><span class="style2">Have you applied for SBI Card in last 6 months?</span></td>
	<td colspan="2">
		<input type="radio" name="sbicardapplied" id="radio-five" value="Yes" class="css-checkbox" <?php if($ccrowal["applied_in_6_months"]=="Yes") { echo "checked";} ?> />
		<label for="radio-five" class="css-label radGroup2" >Yes</label>
        <input type="radio" name="sbicardapplied" id="radio-six" value="No" class="css-checkbox" <?php if($ccrowal["applied_in_6_months"]=="No") { echo "checked";} ?>/>
		<label for="radio-six" class="css-label radGroup2">No</label>
	</td>
</tr>
<tr>
	<td colspan="2"><span class="style2">Do you have any existing relationship with SBI or its associate banks?</span></td>
	<td colspan="2">
		<input type="radio" name="sbirelation" id="radio-seven" value="Yes" class="css-checkbox" <?php if($ccrowal["relationship_type"]=="Yes") { echo "checked";} ?> />
		<label for="radio-seven" class="css-label radGroup2" >Yes</label>
        <input type="radio" name="sbirelation" id="radio-eight" value="No" class="css-checkbox" <?php if($ccrowal["relationship_type"]=="No") { echo "checked";} ?>/>
		<label for="radio-eight" class="css-label radGroup2">No</label>
	</td>
</tr>
<tr id="account_number_div" style="display:none;">
	<td colspan="2"><span class="style2"> Account Number/Loan Number/Debit Card Number: </span></td>
	<td colspan="2"><span><input type="text" maxlength="20" size=40 name="account_number" id="account_number" value="<?php echo $account_number; ?>" /></span></td>
</tr>
<tr>
	<td colspan="4" align="center" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; height:25px;">Feedback details</td>
</tr>
<tr>
	<td><span class="style2">LMS Comments: </span></td>
	<td><span class="style21">
		<textarea rows="2" cols="15" name="comment_section"><? echo $ccrowfb["comment_section"]; ?></textarea></span>
	</td>
	<td><span class="style2">LMS feedback </span></td>
	<td><span class="style21">
		<select name="ccfeedback" id="ccfeedback">
			<option value="" <?if($Feedback == "") { echo "selected"; }?>>No Feedback</option>
			<option value="Other Product" <?if($Feedback == "Other Product") { echo "selected"; }?>>Other Product</option>
			<option value="Not Interested" <?if($Feedback == "Not Interested") { echo "selected"; }?>>Not Interested</option>
			<option value="Callback Later" <?if($Feedback == "Callback Later") { echo "selected"; }?>>Callback Later</option>
			<option value="Wrong Number" <?if($Feedback == "Wrong Number") { echo "selected"; }?>>Wrong Number</option>
			<option value="Send Now" <?if($Feedback == "Send Now") { echo "selected"; }?>>Send Now</option>
			<option value="Not Eligible" <?if($Feedback == "Not Eligible") { echo "selected"; }?>>Not Eligible</option>
			<option value="Duplicate" <?if($Feedback == "Duplicate") { echo "selected"; }?>>Duplicate</option>
			<option value="Not Contactable" <?if($Feedback == "Not Contactable") { echo "selected"; }?>>Not Contactable</option>
			<option value="Ringing" <?if($Feedback == "Ringing") { echo "selected"; }?>>Ringing</option>
			<option value="FollowUp" <?if($Feedback == "FollowUp") { echo "selected"; }?>>FollowUp</option>
			<option value="Not Applied" <?if($Feedback == "Not Applied") { echo "selected"; }?>>Not Applied</option>
			<option value="Process" <?if($Feedback == "Process") { echo "selected"; }?>>Cibil ok</option>
			<option value="Closed" <?if($Feedback == "Closed") { echo "selected"; }?>>Cibil Reject</option>
			<option value="No Response SBI" <?if($Feedback == "No Response SBI") { echo "selected"; }?>>No Response SBI</option>
			<option value="Already SBI Card User" <?if($Feedback == "Already SBI Card User") { echo "selected"; }?>>Already SBI Card User</option>
		</select></span>
	</td>
</tr>	
<tr>
	<td class="fontstyle"><b>Follow Up Date</b></td>
	<td class="fontstyle"><input type="Text"  name="FollowupDate" id="FollowupDate" maxlength="25" size="15" <?php if($Followup_Date !='0000-00-00 00:00:00') { ?>value="<?php  echo $followup_date; ?>" <?php } ?>><a href="javascript:NewCal('FollowupDate','yyyymmdd',true,24)"><img src="images/cal.gif" width="16" height="16" border="0" alt="Pick a date"></a></td>
	<td width="180"><span class="style2">Date of entry: </span></td>
	<td width="392"><span class="style21"><? echo $ccrow["Updated_Date"]; ?></span></td>
</tr>
<?php //dcb_cards_pincode
$getDCBSql="select id from dcb_cards_pincode where (city like '%".$City."%' and pincode='".$ccrow["Pincode"]."')";
$getDCBQuery = d4l_ExecQuery($getDCBSql);
$getDCBNumRows = d4l_mysql_num_rows($getDCBQuery);
if($getDCBNumRows>0)
{
?>
<tr>
	<td colspan="4" align="left"><input type="checkbox" name="dcb_bank" value="DCB" <? if($dcb_bank=="DCB") {echo "Checked";} ?>>DCB Bank</td>
</tr>
<?php 
}
?>
<tr>
	<td colspan="4" align="center"><input type="Submit" id="submitdata" name="Submit" value="Submit" onclick="this.form.submit(); this.disabled=true;"></td>
</tr>
</table>
</form>
</td></tr>
<tr><td>
<table style='border:1px dotted #9C9A9C;' cellspacing="0" cellpadding="5" width="700" height="80%" align="center" border="1" >
<tr><td colspan="4" align="right">
<?php 
if($process=="cq")
{

//Put the Curing Queue Form
?>


<?php
}
else {
	$PageUrl = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	$dataArr = array();
	$dataArr['RequestID'] = $requestid;
	$dataArr['productflag'] = 44;
	$dataArr['Mobile'] = $ccrow["Mobile_Number"];
	$dataArr['Pancard'] = $ccrow["Pancard"];
	$dataArr['PageUrl'] = $PageUrl;
	
	/*
		Note : This Query is checking for given mobile number or pancard whether:
		a. related user entry exists in table "sbi_credit_card_5633" based on column "first_dated" within 180 days.
		OR
		b. related user entry exists in table "sbi_credit_card_5633_log" based on column "first_dated" within 180 days.

		If there is any row exists in any table, then we do not submit data to SBI(Do not show "SBI Send now" button).
	*/
	$checkSMSMobileandPanSql = "SELECT rcc.RequestID, rcc.Mobile_Number, rcc.Pancard, scc.first_dated as SCC_FirstDated, sccl.first_dated as SCCL_FirstDated FROM `Req_Credit_Card` as rcc LEFT JOIN `sbi_credit_card_5633` as scc ON(scc.RequestID = rcc.RequestID AND (scc.first_dated > DATE_SUB(NOW(), INTERVAL 180 DAY))) LEFT JOIN `sbi_credit_card_5633_log` as sccl ON (sccl.cc_requestid = rcc.RequestID AND (sccl.first_dated > DATE_SUB(NOW(), INTERVAL 180 DAY))) WHERE (rcc.`Mobile_Number` = '".$ccrow["Mobile_Number"]."' ";
	if(!empty($ccrow["Pancard"]))
	{
		$checkSMSMobileandPanSql .= " OR (rcc.`Pancard` = '".$ccrow["Pancard"]."') ";
	}
	
	$checkSMSMobileandPanSql .= " ) AND (scc.first_dated != '0000-00-00 00:00:00' OR sccl.first_dated != '0000-00-00 00:00:00') AND ((scc.StatusCode!='156' OR sccl.StatusCode!='156') AND (scc.StatusCode IS NOT NULL))  AND (scc.productflag!=10)  ";

	//	echo $checkSMSMobileandPanSql;
	$checkSMSMobileandPanQuery = d4l_ExecQuery($checkSMSMobileandPanSql);
	while($newccrow=d4l_mysql_fetch_assoc($checkSMSMobileandPanQuery))
	{
		if($newccrow['RequestID'] != ''){
			$RequestIDArr[] = strtoupper($newccrow['RequestID']);
		}
		if($newccrow['Pancard'] != ''){
			$PancardArr[] = strtoupper($newccrow['Pancard']);
		}
		if($newccrow['Mobile_Number'] != ''){
			$MobileArr[] = $newccrow['Mobile_Number'];
		}
	}
	
	$checkSMSMobileandPanNumRows = d4l_mysql_num_rows($checkSMSMobileandPanQuery);      

	if($checkSMSMobileandPanNumRows>0)
	{
		$str="";
		
		$requestiduniquearr = array_unique($RequestIDArr);
		// If only one row and request id is same
		if(count($requestiduniquearr) == 1 && $requestiduniquearr[0] == $UserID){
				$str .= "Already Punched for you earlier ";
		}else{
			$pancountarr = array_count_values($PancardArr);
			$pan_count = $pancountarr[strtoupper($ccrow["Pancard"])];
			if($pan_count>0){
				$str .= "Duplicate PAN Number ";
			}
			
			$mobcountarr = array_count_values($MobileArr);
			$mob_count = $mobcountarr[$ccrow["Mobile_Number"]];
			if($mob_count>0){
				$str .= "Duplicate Mobile Number ";
			}
		}
		
		//Insert sbi check error log
		$dataArr['StepNumber'] = 'One';
		insertsbicheckerrorlog($dataArr);

		echo '<strong><span style="color:red;">'.$str.'</span><strong>';
	}
	else {
		/*Check for first response blank*/
		$getSBIButtonSql = "SELECT response_xml FROM `webservice_log_sbi` WHERE cc_requestid IN (SELECT cc_requestid FROM (select cc_requestid, COUNT(cc_requestid) AS c FROM `webservice_log_sbi` GROUP BY cc_requestid HAVING C < 2 ) as temp) AND response_xml = '' AND cc_requestid = '".$UserID."' AND response_blank = 0";
		//echo $getSBIButtonSql."<br>";
		$getSBIButtonQuery = d4l_ExecQuery($getSBIButtonSql);
		$getSBIButtonNumRows = d4l_mysql_num_rows($getSBIButtonQuery);
		$response_xml = d4l_mysql_result($getSBIButtonQuery,0,'response_xml');
		if($getSBIButtonNumRows>0) 
		{
			//Insert sbi check error log
			$dataArr['StepNumber'] = 'Two';
			insertsbicheckerrorlog($dataArr);

			//Hide Button 
			echo "Already punched to SBI. No Response";
		}
		else 
		{
			$getSBIButtonRefHashSql = "SELECT bank_api_response_data FROM `xkyknzl5dwfyk4hg_tms_bank_api` WHERE `product_type` =  'CC' AND  `bank_code` =  '002' AND d4l_id='".$UserID."' AND d4l_id!=0 AND bank_api_response_data!=''";
			$getSBIButtonRefHashQuery = d4l_ExecQuery($getSBIButtonRefHashSql);
			$getSBIButtonRefHashNumRows = d4l_mysql_num_rows($getSBIButtonRefHashQuery);
			$bank_api_response_data = d4l_mysql_result($getSBIButtonRefHashQuery,0,'bank_api_response_data');
			//echo "<br>".$getSBIButtonRefHashSql."<br>";
			if(strlen($bank_api_response_data)>10) {
				//Insert sbi check error log
				$dataArr['StepNumber'] = 'Three';
				insertsbicheckerrorlog($dataArr);
				
				echo 'Already Punched';
			} 
			else
			{
				/*To check if given pancard is found in any request_xml for Processing Status 1 and 7*/
				$checkPANInRequestSql = "SELECT * FROM `sbi_credit_card_5633` as scc WHERE request_xml LIKE '%<PAN>".$ccrow["Pancard"]."</PAN>%' AND (scc.first_dated > DATE_SUB(NOW(), INTERVAL 180 DAY)) AND (scc.ProcessingStatus IN (1,2,4,5,6,7)  OR (scc.StatusCode = 156 AND RequestID != '".$UserID."'))";
				//echo $getSBIButtonSql."<br>";
				$checkPANInRequestResult = d4l_ExecQuery($checkPANInRequestSql);
				$checkPANInRequestNumRows = d4l_mysql_num_rows($checkPANInRequestResult);
				if($checkPANInRequestNumRows>0) 
				{
					//Insert sbi check error log
					$dataArr['StepNumber'] = 'Four';
					insertsbicheckerrorlog($dataArr);

					//Hide Button 
					echo "Duplicate Pancard";
				}
				else 
				{
					/*To check if given pancard is found in any request_xml and response xml is blank for sbi log table*/
					$checkPANInLogSql = "SELECT sbicclogid FROM `webservice_log_sbi` WHERE cc_requestid IN (SELECT cc_requestid FROM (select cc_requestid, COUNT(cc_requestid) AS c FROM `webservice_log_sbi` GROUP BY cc_requestid HAVING C < 2 ) as temp) AND response_xml = '' AND response_blank = 0 AND request_xml LIKE '%<PAN>".$ccrow["Pancard"]."</PAN>%' AND (first_dated > DATE_SUB(NOW(), INTERVAL 180 DAY))";//updated on 13092017
					//echo $checkPANInLogSql."<br>";
					$checkPANInLogResult = d4l_ExecQuery($checkPANInLogSql);
					$checkPANInLogNumRows = d4l_mysql_num_rows($checkPANInLogResult);
					if($checkPANInLogNumRows>0) 
					{
						//Insert sbi check error log
						$dataArr['StepNumber'] = 'Five';
						insertsbicheckerrorlog($dataArr);

						//Hide Button 
						echo "<b>Duplicate Pancard<b>";
					}
					else 
					{
						/*To check if given pancard or mobile is found in any request_xml for webservice_log_sbi*/
						$checkPANMobileLogSql = "SELECT sbicclogid FROM `webservice_log_sbi` WHERE request_xml != '' AND ((request_xml LIKE '%<PAN>".$ccrow["Pancard"]."</PAN>%') OR (request_xml LIKE '%<Mobile>".$ccrow["Mobile_Number"]."</Mobile>%')) AND (first_dated > DATE_SUB(NOW(), INTERVAL 180 DAY)) AND (StatusCode != 156 OR StatusCode IS NULL)";//updated on 25092017
						//echo $checkPANMobileLogSql."<br>";
						$checkPANMobileLogResult = d4l_ExecQuery($checkPANMobileLogSql);
						$checkPANMobileLogNumRows = d4l_mysql_num_rows($checkPANMobileLogResult);
						if($checkPANMobileLogNumRows>0 && strlen($ccrow["Mobile_Number"]) > 0 && strlen($ccrow["Pancard"]) > 0) 
						{
							//Insert sbi check error log
							$dataArr['StepNumber'] = 'Six';
							insertsbicheckerrorlog($dataArr);
					
							//Hide Button 
							echo "<b>Duplicate Pancard Or Mobile Number<b>";
						}
						else 
						{
							/*To check if given pancard or mobile is found in any request_xml for sbi_credit_card_5633*/
							$checkSccPANMobileLogSql = "SELECT sbiccid FROM `sbi_credit_card_5633` WHERE request_xml != '' AND ((request_xml LIKE '%<PAN>".$ccrow["Pancard"]."</PAN>%') OR (request_xml LIKE '%<Mobile>".$ccrow["Mobile_Number"]."</Mobile>%')) AND (first_dated > DATE_SUB(NOW(), INTERVAL 180 DAY)) AND (StatusCode != 156 OR StatusCode IS NULL)";//updated on 06102017
							$checkSccPANMobileLogResult = d4l_ExecQuery($checkSccPANMobileLogSql);
							$checkSccPANMobileLogNumRows = d4l_mysql_num_rows($checkSccPANMobileLogResult);
							if($checkSccPANMobileLogNumRows>0 && strlen($ccrow["Mobile_Number"]) > 0 && strlen($ccrow["Pancard"]) > 0) 
							{
								//Insert sbi check error log
								$dataArr['StepNumber'] = 'Seven';
								insertsbicheckerrorlog($dataArr);
						
								//Hide Button 
								echo "<b>Duplicate Pancard Or Mobile Number..<b>";
							}
							else{

								/*To check if given pancard or mobile is found in any request_xml for sbi_credit_card_5633*/
								$checkSccPANMobileLog156Sql = "SELECT sbiccid,RequestID FROM `sbi_credit_card_5633` WHERE request_xml != '' AND ((request_xml LIKE '%<PAN>".$ccrow["Pancard"]."</PAN>%') OR (request_xml LIKE '%<Mobile>".$ccrow["Mobile_Number"]."</Mobile>%')) AND (first_dated > DATE_SUB(NOW(), INTERVAL 180 DAY)) AND (StatusCode = 156) order by sbiccid DESC limit 0,1";//updated on 10102017
								$checkSccPANMobileLog156Result = d4l_ExecQuery($checkSccPANMobileLog156Sql);
								$checkSccPANMobileLogNum156Rows = d4l_mysql_num_rows($checkSccPANMobileLog156Result);
								$checkRequestID = d4l_mysql_result($checkSccPANMobileLog156Result,0,'RequestID');
								if($checkSccPANMobileLogNum156Rows>0 && strlen($ccrow["Mobile_Number"]) > 0 && strlen($ccrow["Pancard"]) > 0 && ($checkRequestID!=$UserID )) 
								{
									//Insert sbi check error log
									$dataArr['StepNumber'] = 'Eight';
									insertsbicheckerrorlog($dataArr);

									//Hide Button 
									echo "<b>Duplicate Pancard Or Mobile Number...<b>";
								}
								else{

									if(strlen($ccrow["Mobile_Number"]) > 0 && strlen($ccrow["Pancard"]) > 0){
										//Insert sbi check error log
										$dataArr['StepNumber'] = 'Final';
										insertsbicheckerrorlog($dataArr);
									}
									?>
									<form method="POST" action="/soapservice_sbi5633_1sms.php" name="sendform">
										<input type="hidden" name="process" id="process"  value="main" />
										<input type="hidden" name="agent_id" id="agent_id"  value="<?php echo $bidderid; ?>" />
										<input type="hidden" name="custid"id="custid"  value="<?php echo $requestid; ?>" />
										<input type="Submit" id="submitbtn" name="Submitd" value="SBI Send now" style="color:#FFF; background-color:#C00;" />
									</form>
									<?php
								}
							}
						}
					}
				}
			}
		}
	}
	
	//Show Button For SCB 
	$getStancSql = "select City, Query from Bidders_List where BidderID = 6455 and Restrict_Bidder=1";
	$getStancQuery = d4l_ExecQuery($getStancSql);
	$getStancNumRows = d4l_mysql_num_rows($getStancQuery);
	if($getStancNumRows>0)
	{
		$City = d4l_mysql_result($getStancQuery,0,'City');
		$CityList =  str_replace(",", "', '", $City);
		
		$sqlStanc = d4l_mysql_result($getStancQuery,0,'Query')." and Req_Credit_Card.RequestID='".$requestid."' and  Req_Credit_Card.City in ('".$CityList."')";
		$sqlStanc = str_replace("Req_Credit_Card", "Req_Credit_Card_Sms",$sqlStanc);
		//echo $sqlStanc."<br>";
		$QueryStanc = d4l_ExecQuery($sqlStanc);
		$numRowsStanc = d4l_mysql_num_rows($QueryStanc);
		if($numRowsStanc>0)
		{
	?>
	<!-- | <a href="scb_agent_form.php?cust_id=<?php echo $requestid; ?>" style="color:#FFF; background-color:#C00;" target="_blank">SCB Send now</a>-->
	<?php 
		} 
	}
	
	//Show Button For RBL
	$getrblSql = "select Query,City from Bidders_List where BidderID = 4905";
	$getrblQuery = d4l_ExecQuery($getrblSql);
	$getrblNumRows = d4l_mysql_num_rows($getrblQuery);
	if($getrblNumRows>0)
	{
		$City = d4l_mysql_result($getrblQuery,0,'City');
		$CityList =  str_replace(",", "', '", $City);	
		$sqlrbl = d4l_mysql_result($getrblQuery,0,'Query')." and Req_Credit_Card.RequestID='".$requestid."' and  Req_Credit_Card.City in ('".$CityList."')";
		$sqlrbl = str_replace("Req_Credit_Card", "Req_Credit_Card_Sms",$sqlrbl);

		$Queryrbl = d4l_ExecQuery($sqlrbl);
		$numRowsrbl = d4l_mysql_num_rows($Queryrbl);
		if($numRowsrbl>0)
		{
	?>
	 | <a href="rblcc_agent_form.php?cust_id=<?php echo $requestid; ?>" style="color:#FFF; background-color:#C00;" target="_blank">RBL Send now</a>
	<?php 
		} 
	} 

	//Show Button For Amex
	$getAmexSql = "select City, Query from Bidders_List where BidderID = 5596";
	$getAmexQuery = d4l_ExecQuery($getAmexSql);
	$getAmexNumRows = d4l_mysql_num_rows($getAmexQuery);
	if($getAmexNumRows>0)
	{
		$City = d4l_mysql_result($getAmexQuery,0,'City');
		$CityList =  str_replace(",", "', '", $City);
		
		$sqlAmex = d4l_mysql_result($getAmexQuery,0,'Query')." and Req_Credit_Card.RequestID='".$requestid."' and  Req_Credit_Card.City in ('".$CityList."')";
		$sqlAmex = str_replace("Req_Credit_Card", "Req_Credit_Card_Sms",$sqlAmex);
		//echo $sqlAmex ."<br>";
		$QueryAmex = d4l_ExecQuery($sqlAmex);
		$numRowsAmex = d4l_mysql_num_rows($QueryAmex);
		if($numRowsAmex>0)
		{
	?>
	 | <a href="amex_agent_form.php?cust_id=<?php echo $requestid; ?>" style="color:#FFF; background-color:#C00;" target="_blank">AMEX Send now</a>
	<?php 
		}
	}
	
	//Show Button For ICICI
	$getICICISql = "select City, Query from Bidders_List where BidderID = 6588";
	$getICICIQuery = d4l_ExecQuery($getICICISql);
	$getICICINumRows = d4l_mysql_num_rows($getICICIQuery);
	if($getICICINumRows>0)
	{
		$City = d4l_mysql_result($getICICIQuery,0,'City');
		$CityList =  str_replace(",", "', '", $City);
		
		$sqlICICI = d4l_mysql_result($getICICIQuery,0,'Query')." and Req_Credit_Card.RequestID='".$requestid."' and  Req_Credit_Card.City in ('".$CityList."')";
		$sqlICICI = str_replace("Req_Credit_Card", "Req_Credit_Card_Sms",$sqlICICI);
		//echo $sqlICICI ."<br>";
		$QueryICICI = d4l_ExecQuery($sqlICICI);
		$numRowsICICI = d4l_mysql_num_rows($QueryICICI);
		if($numRowsICICI>0)
		{
	?>
	<!-- | <a href="icici-credit-card-continue_lms.php?cust_id=<?php echo $requestid; ?>" style="color:#FFF; background-color:#C00;" target="_blank">ICICI Send now</a>-->
	<?php 
		}
	}
?>
</td></tr>
<?php 
}
?>
<!-- SBI Response Code Start -->
<tr>
	<td>
	<table style='border:1px dotted #9C9A9C;' cellspacing="0" cellpadding="5" width="100%" height="80%" align="center" border="1" >
	<tr><td colspan="4" align="left"><b>SBI Response:<b></td></tr>
	<tr>
		<td colspan="4">
		<?
		$checkProductTableDetails = d4l_ExecQuery("select * from Req_Credit_Card_Sms Where (RequestID=".$requestid." and UserID>0)");
		$checkProductTableDetailsQry=d4l_ExecQuery($checkProductTableDetails);
		$checkProductTableDetailsNum = d4l_mysql_num_rows($checkProductTableDetails);
		if($checkProductTableDetailsNum>0)
		{
			$sbiDetailsQry ="SELECT * FROM sbi_credit_card_5633 WHERE RequestID=".$UserID." AND ApplicationNumber!='' ORDER BY sbiccid DESC LIMIT 0,1";
			$sbiDetailsResult = d4l_ExecQuery($sbiDetailsQry);
			$numSbiRows = d4l_mysql_num_rows($sbiDetailsResult);
			if($numSbiRows>0)
			{
				$sbiDetailsArr = d4l_mysql_fetch_array($sbiDetailsResult); 
				if(count($sbiDetailsArr)) 
				{
				?>
				<table align="left">
					<tr>
						<td>Application Number : <? echo $sbiDetailsArr["ApplicationNumber"]; ?> <br>Status Code : <? echo $sbiDetailsArr["StatusCode"]; ?><br>Processing Status : <? echo $sbiDetailsArr["ProcessingStatus"]; ?><br>Messages : <? echo $sbiDetailsArr["Messages"]; ?><br>message : <? echo $sbiDetailsArr["message"]; ?></td>
					</tr>
				</table>
				<?php 
				} 
			}
		}
		?>
		</td>
	</tr>
	</table>
	</td>
</tr>
<!-- SBI Response Code End -->

<!-- RBL Response Code Start -->
<tr>
	<td>
	<table style='border:1px dotted #9C9A9C;' cellspacing="0" cellpadding="5" width="100%" height="80%" align="center" border="1" >
		<tr>
			<td colspan="4">
			<?
			$rblDetailsQry = "SELECT response_data FROM credit_card_banks_apply WHERE applied_bankname LIKE '%RBL%' AND cc_requestid='".$UserID."' ORDER BY date_created DESC";
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
	</td>
</tr>
<!-- RBL Response Code End -->

<!-- AMEX Response Code Start -->
<tr>
	<td>
	<table style='border:1px dotted #9C9A9C;' cellspacing="0" cellpadding="5" width="100%" height="80%" align="center" border="1" >
		<tr>
			<td colspan="4">
			<? 
			$amexDetailsQry = "SELECT request_data, response_data FROM credit_card_banks_apply WHERE applied_bankname LIKE '%American%' AND cc_requestid = '".$UserID."' ORDER BY date_created DESC";
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
	</table>
	</td>
</tr>
<!-- AMEX Response Code End -->

</table></td></tr>
</table>
</td></tr>
</table>
</body>
</html>
<?php
$IP_Remote = $_SERVER["REMOTE_ADDR"];
if($IP_Remote=='192.124.249.12' || $IP_Remote=='185.93.228.12') { $IP= $_SERVER['HTTP_X_SUCURI_CLIENTIP']; }
else { $IP= $IP_Remote;	}

?>
<?php
function GetCityStatecCode($pKey){
    $titles = array(
	'AHMEDABAD' => 'GUJ',
	'AURANGABAD' => 'MAH',
	'BANGALORE' => 'KTK',
	'BARODA' => 'GUJ',
	'BHOPAL' => 'MAD',
	'BHUBANESHWAR' => 'ORI',
	'CALCUTTA' => 'WGB',
	'CHANDIGARH' => 'CHD',
	'CHENNAI' => 'TMN',
	'COIMBATORE' => 'KTK',
	'FARIDABAD' => 'HAR',
	'GHAZIABAD' => 'UP',
	'GURGAON' => 'HAR',
	'HYDERABAD' => 'APR',
	'INDORE' => 'MAD',
	'JAIPUR' => 'RAJ',
	'JALANDHAR' => 'PUN',
	'JAMNAGAR' => 'MAD',
	'LUCKNOW' => 'UP',
	'LUDHIANA' => 'PUN',
	'MUMBAI' => 'MAH',
	'NAGPUR' => 'MAH',
	'NASIK' => 'MAD',
	'NEW DELHI' => 'DEL',
	'NOIDA' => 'UP',
	'PATNA' => 'BIH',
	'PUNE' => 'MAH',
	'RAJKOT' => 'MAD',
	'SURAT' => 'GUJ',
	'TIRUPUR' => 'TMN',
	'TRIVANDRUM' => 'KER'
);
    foreach ($titles as $key=>$value)
        if($pKey==$key)
        return $value;
    return "";
}

function insertsbicheckerrorlog($dataArr=array()){
	$Dated = ExactServerdate();
	$RequestID = $dataArr['RequestID'];
	$productflag = $dataArr['productflag'];
	$Mobile = $dataArr['Mobile'];
	$Pancard = $dataArr['Pancard'];
	$StepNumber = $dataArr['StepNumber'];
	$PageUrl = $dataArr['PageUrl'];
	
	if($RequestID > 0){
		$insertchecksqry="INSERT INTO sbi_checks_errorlog SET RequestID='".$RequestID."',productflag='".$productflag."',Mobile='".$Mobile."',Pancard='".$Pancard."',StepNumber='".$StepNumber."',PageUrl='".$PageUrl."',Dated='".$Dated."'";
		d4l_ExecQuery($insertchecksqry);
	}
}

?>
