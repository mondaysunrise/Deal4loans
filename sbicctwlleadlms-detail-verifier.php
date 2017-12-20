<?php
$requestid = $_REQUEST["postid"];
$bidderid = $_REQUEST["biddt"];

require 'scripts/session_check_online.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';

if($_SESSION["BidderID"] != $bidderid) {  echo "You are not authorised to view this details."; die();  }

$getAgentSql = "SELECT BidderID FROM Bidders WHERE leadidentifier NOT IN ('sbiverifierlms') AND BidderID='".$_SESSION["BidderID"]."'";
$getAgentQuery = d4l_ExecQuery($getAgentSql);
$getAgentNumRows = d4l_mysql_num_rows($getAgentQuery);
if($getAgentNumRows>0) {  echo "You are not authorised to view this details.."; die();  }


$getAgentCheckSql = "SELECT AllRequestID FROM lead_allocate WHERE AllRequestID = '".$requestid."' AND BidderID='".$_SESSION["BidderID"]."'";
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
	$RequestID = $_POST["RequestID"];
	$sbiccid = $_POST["sbiccid"];
	$comment_section = $_POST["comment_section"];
	$ccfeedback = $_POST["ccfeedback"];
	$FollowupDate  = $_POST["FollowupDate"];
	$AppointmentDate = $_POST["AppointmentDate"];

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
		$result = d4l_ExecQuery("SELECT FeedbackID FROM Req_Feedback_CC WHERE AllRequestID=".$requestid." AND BidderID=".$bidderid." AND Reply_Type=10");
		$num_rows = d4l_mysql_num_rows($result);
		if($num_rows > 0)
		{	
			$row = d4l_mysql_fetch_array($result);
			$strSQL="UPDATE Req_Feedback_CC SET Feedback='".$ccfeedback."',comment_section='".$comment_section."',Followup_Date='".$FollowupDate."', last_updated='".$last_updated."'";
			$strSQL=$strSQL."WHERE FeedbackID=".$row["FeedbackID"];
		}
		else
		{
			$strSQL="INSERT INTO Req_Feedback_CC(AllRequestID, BidderID, Reply_Type , Feedback, Followup_Date,comment_section,last_updated) Values (";
			$strSQL=$strSQL.$requestid.",".$bidderid.",10,'".$ccfeedback."','".$FollowupDate."','".$comment_section."','".$last_updated."')";
		}
		//echo $strSQL;exit;
		$result = d4l_ExecQuery($strSQL);
		if ($result == 1)
		{

		}
		else
		{
			$Msg = "** There was a problem in adding your feedback. Please try again.";
		}	
	}
	
	//Update Appointment Date time
	$ccupqry="UPDATE sbi_credit_card_5633 SET appointment_datetime='".$AppointmentDate."' Where sbiccid='".$sbiccid."'";
	$ccupqryresult=d4l_ExecQuery($ccupqry);
}

$ccdetails = "SELECT * FROM sbi_ccoffers_directonsite WHERE sbiccoffersid='".$requestid."'";
$ccdetailsresult = d4l_ExecQuery($ccdetails);
$ccrow = d4l_mysql_fetch_array($ccdetailsresult);
$sbiccoffersid= $ccrow["sbiccoffersid"];
$postpaidmobile= $ccrow["sbicc_postpaidmobile"];
$sbicc_email = $ccrow["sbicc_email"];
$sbicc_mobile = $ccrow["sbicc_mobile"];
$sbicc_occupation = $ccrow["sbicc_occupation"];
$sbicc_net_salary = $ccrow["sbicc_net_salary"];
$sbicc_pincode = $ccrow["sbicc_pincode"];
$Landline = $ccrow["sbicc_landline"];
$Std_Code = $ccrow["sbicc_std_code"];
$sbicc_requestid = $ccrow["sbicc_requestid"];
$City = $ccrow["sbicc_city"];
$sbicc_pancard = $ccrow["sbicc_pancard"];

list($year,$mm,$dd) = split("[-]",$ccrow["sbicc_dob"]);
list($first_name,$middle_name,$last_name) = split("[ ]",$ccrow["sbicc_name"]);
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

$cc_alldetails = d4l_ExecQuery("SELECT * FROM sbi_credit_card_5633 WHERE RequestID='".$requestid."' AND productflag=10 AND ProcessingStatus = 1 AND ApplicationNumber != '' ORDER BY sbiccid DESC LIMIT 0,1");
$ccrowal = d4l_mysql_fetch_array($cc_alldetails);
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
$account_number = $ccrowal["account_number"];
$ApplicationNumber = $ccrowal["ApplicationNumber"];
$AppointmentDate = $ccrowal["appointment_datetime"];

if(strlen($ccrowal["CompanyName"])>1)
{
	$CompanyName = $ccrowal["CompanyName"];
}
else
{
	$CompanyName = $ccrow["sbicc_company_name"];
}

if(strlen($CompanyName)>1)
{
	$sbi_category="";
	$sbi_companycat= d4l_ExecQuery('select * from sbi_cc_company_list Where (sbi_companyname="'.$CompanyName.'")');
	$sbicomp=d4l_mysql_fetch_array($sbi_companycat);
	$sbi_category= $sbicomp["sbi_category"];
}

$ccfb_alldetails = d4l_ExecQuery("SELECT * FROM Req_Feedback_CC WHERE BidderID='".$bidderid."' AND AllRequestID='".$requestid."' AND Reply_Type = 10");
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
<script>
function showUser(str) {
    if (str == "") {
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET","getcity-value.php?q="+str,true);
        xmlhttp.send();
    }
}
function showResiUser(str) {
    if (str == "") {
        document.getElementById("txtResiHint").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("txtResiHint").innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET","getcity-resivalue.php?q="+str,true);
        xmlhttp.send();
    }
}
</script>
<script>
function showPinCode(str) {
   // alert('ddd');
	if (str == "") {
         document.getElementById("txtHint2").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("txtHint2").innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET","get-stdcode.php?q="+str,true);
        xmlhttp.send();
    }
}
function showResiPinCode(str) {
   // alert('ddd');
	if (str == "") {
         document.getElementById("resiSTD").value = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("resiSTD").value = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET","get-resistdcode.php?q="+str,true);
        xmlhttp.send();
    }
}
</script>
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
	var product = "TWL";
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

window.onload = ajaxFunctionMain;
</script>
<style>
.validate_btn {background: #0785e8; padding: 5px; width:63px; text-align:center;  border-radius:5px;  font-size:13px; color:#FFF; font-family: Arial, Helvetica, sans-serif;}

.p-text{font-family: Arial, Helvetica, sans-serif; font-size: 12px;}
.auto-style1 {
	font-weight: bold;
}
</style>
</head>
<body>
<form name="loan_form" method="post" action="<? echo $_SERVER['PHP_SELF'] ?>?postid=<?echo $requestid;?>&biddt=<? echo $bidderid;?>" >
<input type="hidden" name="biddtnw" value="<? echo $bidderid;?>" />
<input type="hidden" name="RequestID" value="<? echo $requestid;?>" />
<input type="hidden" name="sbiccid" value="<? echo $sbiccid;?>" />
<table style='border:1px dotted #9C9A9C;' cellspacing="0" cellpadding="5" width="1000" height="80%" align="center" border="1" >
<tr>
	<td colspan="4" align="center" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; height:25px;">Credit Card customer details [Selected Card - <?php if(!empty($applied_card_name)){echo $applied_card_name;}else{ echo $CardName;} ?>]</td>
</tr>
<tr>
	<td width="180" class="auto-style1">Customer Name: </td>
    <td width="392" colspan="3">
		<span class="style21">
			<input type="text" maxlength="12" size="13" name="first_name" id="first_name" value="<? echo $first_name; ?>" readonly />
			&nbsp;
			<input type="text" maxlength="10" size="11" name="middle_name" id="middle_name" value="<? echo $middle_name; ?>"readonly />
			&nbsp;
			<input type="text" maxlength="16" size="17" name="last_name" id="last_name" value="<? echo $last_name; ?>" readonly />
			</span>
	</td>
</tr>
<tr>
	<td class="auto-style1">Mobile No: </td>
	<td><span class="style21"><? echo ccMasking($sbicc_mobile); ?></span></td>
	<td><span class="style2"> <strong>Email: </strong> </span></td>
	<td><span class="style21">
		<input type="text" value="<? echo $sbicc_email; ?>" name="Email" id="Email" readonly /></span>
	</td>
</tr>
<tr>
	<td class="auto-style1">DOB: </td>
	<td><span class="style21">
		   <input type="text" value="<? echo $dd.'-'.$mm.'-'.$year; ?>" readonly />
		</span>
	</td>
	<td><span class="style2"> <strong>Gender: </strong> </span></td>
	<td><span class="style21">
		<input type="text" value="<? echo $Gender; ?>" readonly /></span>
	</td>
</tr>    
<tr>
	<td class="auto-style1">PanCard No</td>
    <td>
		<input type="text" class="d4l-input" name="panno" id="panno" value="<? echo $sbicc_pancard ;?>"  maxlength="10" readonly />
	</td>
    <td><span class="style2"><strong>Qualification</strong></span></td>
    <td>
		<span class="style21">
			<input type="text" value="<? if($Qualification=="10 or below") { echo "Metric or below"; }elseif($Qualification=="Plus 2 or below") { echo "Higher secondary"; }elseif($Qualification=="Graduate") { echo "Graduation"; }elseif($Qualification=="Post graduate") { echo "Postgraduate and above"; }?>" readonly />
		</span>
	</td>
</tr>
<tr>
	<td colspan="4" align="center" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:14px; height:25px;" class="auto-style1">Residence details</td>
</tr>
<tr>
	<td class="auto-style1">Resi Address: </td>
	<td colspan="3">
		<span class="style21" >
		<input type="text" maxlength="40" size=25 name="ResidenceAddress1" id="ResidenceAddress1" value="<? echo $ResidenceAddress1; ?>" placeholder="Address Line 1" readonly />
		&nbsp;
		<input type="text" maxlength="40" size=25 name="ResidenceAddress2" id="ResidenceAddress2" value="<? echo $ResidenceAddress2; ?>" placeholder="Address Line 2" readonly />
	&nbsp;
		<input type="text" maxlength="40" size=25 name="ResidenceAddress3" id="ResidenceAddress3" value="<? echo $ResidenceAddress3; ?>" placeholder="Address Line 3" readonly />
		</span>
	</td>
</tr>
<tr>
	<td class="auto-style1">Residence City: </td>
    <td><span class="style21">
		<input type="text" value="<? echo $City; ?>" readonly /></span>
		
	</td>
<td><span class="style2"> <strong>Post-paid mobile number: </strong> </span></td>
	<td>
		<table cellpadding="2" cellspacing="2">
			<tr>
				<td>
				+91<input type="text" class="stdnumber" id="postpaid_mobile" name="postpaid_mobile" value="<? echo $postpaidmobile; ?>" maxlength="10" size="15" readonly />
				</td>
			</tr>
		</table>
	</td></tr>  
<tr>
	<td class="auto-style1">Resi pincode: </td>
	<td><span class="style21">
		<input type="text" value="<? echo $sbicc_pincode; ?>" readonly />
		</span>
	</td>
	<td><span class="style2"> <strong>Resi number: </strong> </span></td>
	<td>
		<table cellpadding="2" cellspacing="2">
			<tr>
				<td>
					<div id="resitxtHint2" style="float:left; width:50px;">
						<input type="text" class="std"  name="resiSTD" value="<? echo $Std_Code; ?>"  onfocus="(this.value == 'STD') && (this.value = '')"   onblur="(this.value == '') && (this.value = 'STD')" id="resiSTD" style="width:50px;" readonly />
					</div>
				</td>
				<td>
					<input type="text" class="stdnumber" id="resiPhone_Number" name="resiPhone_Number" value="<? echo $Landline; ?>" maxlength="8" size="10" readonly />
				</td>
			</tr>
		</table>
	</td>
</tr>
<tr>
	<td colspan="4" align="center" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:14px; height:25px;" class="auto-style1">Professional details</td>
</tr>
<tr>
	<td class="auto-style1">Occupation: </td>
	<td><span class="style21">
		<input type="text" value="<? if($sbicc_occupation==1) {echo "Salaried";}elseif($sbicc_occupation==0) {echo "Self Employment";}?>" readonly />
		</span>
	</td>
	<td><span class="style2"> <strong>Company Name: </strong> </span></td>
	<td><span class="style21">
		<input name="Company_Name" id="Company_Name" type="text" class="d4l-input" onkeyup="ajax_showOptions(this,'getCountriesByLetters',event)"   style="width:200px;" maxlength="30" value="<? echo $CompanyName; ?>" readonly />
		</span>
	</td>
</tr>   
<tr>
	<td class="auto-style1">Designation: </td>
	<td><span class="style21">
		<input type="text" value="<? echo $Designation; ?>" readonly />
		</span>
	</td>
	<td><span class="style2"> <strong>Annual Income: </strong> </span></td>
	<td><span class="style21">
		<input type="text"  name="Net_Salary" id="Net_Salary" value="<? echo $sbicc_net_salary; ?>" readonly />
		</span>
	</td>
</tr>
<tr>
	<td class="auto-style1">Office Address: </td>
	<td colspan="3">
		<span class="style21" >
		<input type="text" maxlength="40" size=25 name="OfficeAddress1" id="OfficeAddress1" value="<? echo $OfficeAddress1; ?>" placeholder="Address Line 1" readonly />
		&nbsp;
		<input type="text" maxlength="40" size=25 name="OfficeAddress2" id="OfficeAddress2" value="<? echo $OfficeAddress2; ?>" placeholder="Address Line 2" readonly />
		&nbsp;
		<input type="text" maxlength="40" size=25 name="OfficeAddress3" id="OfficeAddress3" value="<? echo $OfficeAddress3; ?>" placeholder="Address Line 3" readonly />
		</span>
	</td>
</tr>
<tr>
	<td class="auto-style1">Office City: </td>
	<td><span class="style21" >
		<input type="text" value="<? echo $OfficeCity; ?>" readonly />
		</span>
	</td>
	<td><span class="style2"> <strong>Office pincode: </strong> </span></td>
	<td> 
		<input type="text" value="<? echo $OfficePin; ?>" readonly />
		</select>				
	</td>
</tr>
<tr>
	<td class="auto-style1">Office number: </td>
	<td>
		<table cellpadding="2" cellspacing="2">
			<tr>
				<td>
					<div id="txtHint2" style="float:left; width:50px;">
						<input type="text" class="std"  name="STD"  onfocus="(this.value == 'STD') && (this.value = '')"   onblur="(this.value == '') && (this.value = 'STD')" id="STD" style="width:50px;" readonly >
					</div>
				</td>
				<td>
					<input type="text" class="stdnumber" id="Phone_Number" name="Phone_Number"  value="<? echo $LandlineNo; ?>" maxlength="8" onkeydown="Land_linenumberVal2" size="10" readonly />
				</td>
			</tr>
		</table>
	</td>
	<td><span class="style2"><strong>Company Category</strong></span></td>
	<td><? echo $sbi_category;?></td>
</tr>
<tr>
     <td colspan="4" align="center" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:14px; height:25px;" class="auto-style1">Feedback details</td>
</tr>
<tr>
	<td class="auto-style1">LMS Comments: </td>
	<td><span class="style21"><textarea rows="2" cols="15" name="comment_section"><? echo $comment_section; ?></textarea></span></td>
	<td><span class="style2"><strong>LMS feedback </strong> </span></td>
	<td><span class="style21">
		<select name="ccfeedback" id="ccfeedback">
			<option value="" <?if($Feedback == "") { echo "selected"; }?>>No Feedback</option>
			<option value="Send For Appointment" <?if($Feedback == "Send For Appointment") { echo "selected"; }?>>Send For Appointment</option>
			<option value="FollowUp" <?if($Feedback == "FollowUp") { echo "selected"; }?>>FollowUp</option>
			<option value="Ringing" <?if($Feedback == "Ringing") { echo "selected"; }?>>Ringing</option>
			<option value="Not Contactable" <?if($Feedback == "Not Contactable") { echo "selected"; }?>>Not Contactable</option>
			<option value="Not Interested" <?if($Feedback == "Not Interested") { echo "selected"; }?>>Not Interested</option>
			<option value="Not Eligible" <?if($Feedback == "Not Eligible") { echo "selected"; }?>>Not Eligible</option>
			<option value="Never Applied" <?if($Feedback == "Never Applied") { echo "selected"; }?>>Never Applied</option>
			<option value="Wrong Number" <?if($Feedback == "Wrong Number") { echo "selected"; }?>>Wrong Number</option>
			<option value="OCL Customer" <?if($Feedback == "OCL Customer") { echo "selected"; }?>>OCL Customer</option>
		</select>
		</span>
	</td>
</tr>	
<tr>
	<td class="auto-style1">Follow Up Date</td>
	<td class="fontstyle">
		<input type="Text"  name="FollowupDate" id="FollowupDate" maxlength="25" size="15" <?php if($Followup_Date !='0000-00-00 00:00:00') { ?>value="<?php  echo $followup_date; ?>" <?php } ?>>
		<a href="javascript:NewCal('FollowupDate','yyyymmdd',true,24)">
			<img src="images/cal.gif" width="16" height="16" border="0" alt="Pick a date">
		</a>
	</td>
	<td width="180"><span class="style2"><strong>Date of entry: </strong> </span></td>
    <td width="392"><span class="style21"><? echo $ccrow["sbicc_dated"]; ?></span></td>
</tr>
<tr>
	<td class="auto-style1">Appointment Date</td>
	<td class="fontstyle">
		<input type="Text"  name="AppointmentDate" id="AppointmentDate" maxlength="25" size="15" <?php if($AppointmentDate !='0000-00-00 00:00:00') { ?>value="<?php  echo $AppointmentDate; ?>" <?php } ?>>
		<a href="javascript:NewCal('AppointmentDate','yyyymmdd',true,24)">
			<img src="images/cal.gif" width="16" height="16" border="0" alt="Pick a date">
		</a>
	</td>
	<td width="180"><span class="style2"></span></td>
	<td width="392"><span class="style21"></span></td>
</tr>
<tr>
	<td colspan="4" align="center">
		<input type="Submit" id="submitdata" name="Submit" value="Submit" onclick="this.form.submit(); this.disabled=true;" />
	</td>
</tr>
</table>
</form>
<table style='border:1px dotted #9C9A9C;' cellspacing="0" cellpadding="5" width="1000" height="80%" align="center" border="1" >
	<tr><td colspan="4" align="right">
		<?php
		/*To check if second webservice is already hit*/
		$checkSecondRequestSql = "SELECT * FROM `sbi_credit_card_5633` WHERE request2_xml != '' AND ApplicationNumber = '".$ApplicationNumber."' AND RequestID = '".$requestid."' AND productflag = 10";
		//echo $checkSecondRequestSql."<br>";
		$checkSecondRequestResult = d4l_ExecQuery($checkSecondRequestSql);
		$checkSecondRequestNumRows = d4l_mysql_num_rows($checkSecondRequestResult);
		if($checkSecondRequestNumRows>0) 
		{
			//Hide Button 
			echo "Already Send";
		}
		else 
		{
		//<form method="POST" action="/soapservice_sbi5633_verifier.php" name="sendform">
			//	<input type="hidden" name="custid"id="custid"  value="" />
			//	<input type="hidden" name="sbiccid"id="sbiccid"  value="" />
			//	<input type="Submit" id="submitbtn" name="Submitd" value="Send now" style="color:#FFF; background-color:#C00;" />
			//</form>
		?>
			
		<?php
		}
		?>
	</td></tr>
	<tr><td colspan="4">
	<?php
	$cc_alldetailsqry = d4l_ExecQuery("select * from sbi_credit_card_5633 Where (sbiccid=".$sbiccid.") ORDER BY sbiccid DESC limit 0,1");
	$numWSCheck = d4l_mysql_num_rows($cc_alldetailsqry);
	if($numWSCheck>0)
	{
		$ccal = d4l_mysql_fetch_array($cc_alldetailsqry);
	?>
	<table align="left">
	  <tr><td>Application Number : <? echo $ccal["ApplicationNumber_2"]; ?> <br>Status Code : <? echo $ccal["StatusCode_2"]; ?><br>Processing Status : <? echo $ccal["ProcessingStatus_2"]; ?></td></tr>
	</table>
	<?php 
	}
	?>
</td></tr>
</table>
</body>
</html>
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
?>
