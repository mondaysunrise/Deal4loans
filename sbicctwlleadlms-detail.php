<?php
$requestid = $_REQUEST["postid"];
$bidderid = $_REQUEST["biddt"];
require 'scripts/session_check_online.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';

function ccMasking($number, $maskingCharacter = 'X') 
{
	return substr($number, 0, 2) . str_repeat($maskingCharacter, strlen($number) - 4) . substr($number, -2);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	foreach($_POST as $a=>$b)
		$$a=$b;
	$RequestID = $_REQUEST["RequestID"];
	$sbiccid = $_REQUEST["sbiccid"];
	$Email = $_REQUEST["Email"];
	$Gender = $_REQUEST["Gender"];
	$panno = $_REQUEST["panno"];
	$City = $_REQUEST["City"];
	$City_Other = $_REQUEST["City_Other"];
	$State = GetCityStatecCode($City);
	$postpaid_mobile = trim($_REQUEST["postpaid_mobile"]);
	$pincode = $_REQUEST["ResiPin"];
	$Net_Salary = $_REQUEST["Net_Salary"];
	$Employment_Status = $_REQUEST["Employment_Status"];
	$comment_section = $_POST["comment_section"];
	$ccfeedback = $_POST["ccfeedback"];
	$FollowupDate  = $_POST["FollowupDate"];
	$ResidenceAddress1 = $_REQUEST["ResidenceAddress1"];
	$ResidenceAddress2 = $_REQUEST["ResidenceAddress2"];
	$ResidenceAddress3 = $_REQUEST["ResidenceAddress3"];
	$ResidenceAddress = $ResidenceAddress1." ".$ResidenceAddress2." ".$ResidenceAddress3;
	$CompanyName = $_POST["Company_Name"];
	$OfficeAddress1 = $_POST["OfficeAddress1"];
	$OfficeAddress2 = $_POST["OfficeAddress2"];
	$OfficeAddress3 = $_POST["OfficeAddress3"];
	$OfficePin = $_POST["OfficePin"];
	$Land_linenumber = $_POST["Land_linenumber"];
	$OfficeCity = $_POST["OfficeCity"];
	$Phone_Number = $_POST["Phone_Number"];	
	$OfficeState = GetCityStatecCode($OfficeCity);
	$Qualification = $_POST["Qualification"];
	$Designation = $_POST["Designation"];	
	$card_name = $_POST["card_name"];
	$STD = "0".$_POST["STD"];
	$resiSTD = $_POST["resiSTD"];
	$resiPhone_Number = $_POST["resiPhone_Number"];;
	$first_name = $_POST["first_name"];
	$middle_name = $_POST["middle_name"];
	$last_name = $_POST["last_name"];
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
		$ccupqry="Update sbi_credit_card_5633 set pushflag='".$pushflag."',RequestID='".$RequestID."',CompanyName='".$Company_Name."',ResidenceAddress1='".$ResidenceAddress1."',ResidenceAddress2='".$ResidenceAddress2."',ResidenceAddress3='".$ResidenceAddress3."',OfficeAddress1='".$OfficeAddress1."',OfficeAddress2='".$OfficeAddress2."',OfficeAddress3='".$OfficeAddress3."',OfficePin='".$OfficePin."',OfficeCity='".$OfficeCity."',LandlineNo='".$Phone_Number."',OfficeState='".$OfficeState."',Qualification='".$Qualification."',CardName='".$card_name."',Designation='".$Designation."',sbi_cc_holder='".$sbicardholder."',applied_in_6_months='".$sbicardapplied."',relationship_type='".$sbirelation."',account_number='".$account_number."',Dated='".$Dated."', productflag=10  ".$insert_pancard." Where (sbiccid='".$sbiccid."')";
	}
	else
	{
		$ccMobileSql = "select sbicc_mobile as Mobile_Number from sbi_ccoffers_directonsite Where (sbiccoffersid=".$RequestID.")";
		$ccMobileSqlresult = d4l_ExecQuery($ccMobileSql);
		$ccMobilerow=d4l_mysql_fetch_array($ccMobileSqlresult);
		$ccMobile_Number = $ccMobilerow["Mobile_Number"];

		$ccupqry="INSERT INTO sbi_credit_card_5633 set RequestID='".$RequestID."',CompanyName='".$Company_Name."',ResidenceAddress1='".$ResidenceAddress1."',ResidenceAddress2='".$ResidenceAddress2."',ResidenceAddress3='".$ResidenceAddress3."',OfficeAddress1='".$OfficeAddress1."',OfficeAddress2='".$OfficeAddress2."',OfficeAddress3='".$OfficeAddress3."',OfficePin='".$OfficePin."',OfficeCity='".$OfficeCity."',LandlineNo='".$Phone_Number."',OfficeState='".$OfficeState."',Qualification='".$Qualification."',CardName='".$card_name."',Designation='".$Designation."',sbi_cc_holder='".$sbicardholder."',applied_in_6_months='".$sbicardapplied."',relationship_type='".$sbirelation."',account_number='".$account_number."',Dated='".$Dated."',pushflag='".$pushflag."',productflag=10, agent_id='".$bidderid."', MobileNumber='".$ccMobile_Number."'  ".$insert_pancard." ";
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
		$resi_landline=substr(trim($postpaid_mobile),0,8);
	}

	$upcctblenw="Update sbi_ccoffers_directonsite set sbicc_name='".$Name."',sbicc_dob='".$DOB."',sbicc_company_name='".$Company_Name."',sbicc_std_code='".$resiSTD."',sbicc_landline='".$resi_landline."', sbicc_email='".$Email."',sbicc_net_salary='".$Net_Salary."',sbicc_gender='".$Gender."',sbicc_residence_address ='".$ResidenceAddress."' ,sbicc_state='".$State."', sbicc_pancard='".$panno."',sbicc_pincode='".$pincode."',sbicc_city='".$City."', sbicc_occupation='".$Employment_Status."', sbicc_postpaidmobile='".$postpaid_mobile."'  Where (sbiccoffersid=".$RequestID.")";
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
		if($requestid>0)
		{
			$strSQL="Update sbi_ccoffers_directonsite Set lms_feedback='".$ccfeedback."',lms_comment='".$comment_section."',lms_followup_date='".$FollowupDate."', lms_last_updated='".$last_updated."', sendnow_date=Now()";
			$strSQL=$strSQL."Where sbiccoffersid=".$requestid;
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
}

$followup_date="";
$ccdetails = "select *, sbicc_pancard as Pancard from sbi_ccoffers_directonsite Where (sbiccoffersid=".$requestid.")";
$ccdetailsresult = d4l_ExecQuery($ccdetails);
$ccrow=d4l_mysql_fetch_array($ccdetailsresult);

if($ccrow["sbicc_occupation"]==0)
{
	$emp_status="Self Employed";
}
else
{
	$emp_status="Salaried";
}
$sbiccoffersid= $ccrow["sbiccoffersid"];
$Feedback= $ccrow["lms_feedback"];
$postpaidmobile= $ccrow["sbicc_postpaidmobile"];
$followup_date= $ccrow["lms_followup_date"];
$comment_section= $ccrow["lms_comment"];
$sbicc_email = $ccrow["sbicc_email"];
$sbicc_mobile = $ccrow["sbicc_mobile"];
$sbicc_occupation = $ccrow["sbicc_occupation"];
$sbicc_net_salary = $ccrow["sbicc_net_salary"];
$sbicc_pincode = $ccrow["sbicc_pincode"];
$Landline = $ccrow["sbicc_landline"];
$Std_Code = $ccrow["sbicc_std_code"];
$sbicc_requestid = $ccrow["sbicc_requestid"];
/*
$sbicc_residence_address = $ccrow["sbicc_residence_address"];
$Residence_Address = str_ireplace('|','',$sbicc_residence_address);
*/
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

$cc_alldetails = d4l_ExecQuery("SELECT * FROM sbi_credit_card_5633 WHERE (RequestID=".$requestid." AND productflag=10) ORDER BY sbiccid DESC LIMIT 0,1");
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
$account_number = $ccrowal["account_number"];
if($ccrow["Employment_Status"]==0)
{
	$emp_status="Self Employed";
}
else{
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
else
{
	$card_vintage="";
}

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
<form name="loan_form" method="post" action="<? echo $_SERVER['PHP_SELF'] ?>?postid=<?echo $requestid;?>&biddt=<? echo $bidderid;?>" >
<input type="hidden" name="biddtnw" value="<? echo $bidderid;?>">
<input type="hidden" name="RequestID" value="<? echo $requestid;?>">
<input type="hidden" name="sbiccid" value="<? echo $sbiccid;?>">
<table style='border:1px dotted #9C9A9C;' cellspacing="0" cellpadding="5" width="700" height="80%" align="center" border="1" >
<tr><td colspan="4" align="center" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; height:25px;">Credit Card customer details</td></tr>
<tr>
	<td width="180"><span class="style2">Customer Name: </span></td>
    <td width="392" colspan="3"><span class="style21"><input type="text" maxlength="12" size="13" name="first_name" id="first_name" value="<? echo $first_name; ?>" />&nbsp;<input type="text" maxlength="10" size="11" name="middle_name" id="middle_name" value="<? echo $middle_name; ?>"/>&nbsp;<input type="text" maxlength="16" size="17" name="last_name" id="last_name" value="<? echo $last_name; ?>" /></span></td>
</tr>
<tr>
	<td><span class="style2"> Mobile No: </span></td>
	<td><span class="style21"><? echo ccMasking($sbicc_mobile); ?></span></td>
	<td><span class="style2"> Email: </span></td>
	<td><span class="style21"><input type="text" maxlength="40" value="<? echo $sbicc_email; ?>" name="Email" id="Email" /></span></td>
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
	<td><input type="text" class="d4l-input" name="panno" id="panno" value="<? echo $sbicc_pancard; ;?>"  maxlength="10"/><span id="panvalidation"><input type="button" id="validatepanbtn" onclick="getPanValidate();" class="validate_btn" value="Validate"></input></span></td>
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
	<td colspan="3">
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
		<input type="text" value="<? echo $sbicc_pincode; ?>" name="ResiPin" id="ResiPin" maxlength="6" /></span> <input type="button" id="GetCitybtn" onclick="getCityFromPin('City','ResiPin');" class="validate_btn" value="GetCity" />
	</td>
	<td><span class="style2" > City: </span></td>
	<td><span class="style21"><input type="text" value="<? echo trim($City); ?>" name="City" id="City" readonly="readonly" /></span></td>
</tr> 
<tr>
	<td><span class="style2"></span></td>
	<td><span class="style21"></span></td>
	<td><span class="style2"> Resi number: </span></td>
	<td><table cellpadding="2" cellspacing="2">
			<tr>
				<td>
					<div id="resitxtHint2" style="float:left; width:50px;"><input type="text" class="std"  name="resiSTD" value="<? echo $Std_Code; ?>" onfocus="(this.value == 'STD') && (this.value = '')" onblur="(this.value == '') && (this.value = 'STD')" id="resiSTD" maxlength="7" style="width:50px;"></div>
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
				+91<input type="text" class="stdnumber" id="postpaid_mobile" name="postpaid_mobile" value="<? echo $postpaidmobile; ?>" maxlength="10" size="15" onkeypress='return event.charCode >= 48 && event.charCode <= 57'/>
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
			<option value="1" <? if($sbicc_occupation==1) {echo "Selected";}?>>Salaried</option>
			<option value="0" <? if($sbicc_occupation==0) {echo "Selected";}?>>Self Employment</option>
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
			?>
			<option value="<?php echo $designation; ?>" <? if($designation ==$Designation) echo "selected"; ?>><?php echo ucwords(($designation)); ?></option>
			<?php
			}
			?>
			<option value="Other" <? if($Designation=="Other") echo "selected"; ?>>Other</option>
		</select></span>
	</td>
	<td><span class="style2"> Annual Income: </span></td>
	<td><span class="style21"><input type="text"  name="Net_Salary" id="Net_Salary" value="<? echo $sbicc_net_salary; ?>"/></span></td>
</tr>
<tr>
	<td><span class="style2"> Office Address: </span></td>
	<td colspan="3">
		<span class="style21" >
			<input type="text" maxlength="40" size=25 name="OfficeAddress1" id="OfficeAddress1" value="<? echo $OfficeAddress1; ?>" placeholder="Address Line 1" />
			&nbsp;
			<input type="text" maxlength="40" size=25 name="OfficeAddress2" id="OfficeAddress2" value="<? echo $OfficeAddress2; ?>" placeholder="Address Line 2" />
			<br /><br />
			<input type="text" maxlength="40" size=25 name="OfficeAddress3" id="OfficeAddress3" value="<? echo $OfficeAddress3; ?>" placeholder="Address Line 3" />
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
	<td><span class="style2">Company Category</span></td><td><? echo $sbi_category;?></td>
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
	<td><span class="style21"><textarea rows="2" cols="15" name="comment_section"><? echo $ccrow["lms_comment"]; ?></textarea></span></td>
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
	<td width="392"><span class="style21"><? echo $ccrow["sbicc_dated"]; ?></span></td>
</tr>
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
	$PageUrl = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	$dataArr = array();
	$dataArr['RequestID'] = $requestid;
	$dataArr['productflag'] = 10;
	$dataArr['Mobile'] = $ccrow["sbicc_mobile"];
	$dataArr['Pancard'] = $ccrow["sbicc_pancard"];
	$dataArr['PageUrl'] = $PageUrl;

	/*
		Note : This Query is checking for given mobile number or pancard whether:
		a. related user entry exists in table "sbi_credit_card_5633" based on column "first_dated" within 180 days.
		OR
		b. related user entry exists in table "sbi_credit_card_5633_log" based on column "first_dated" within 180 days.

		If there is any row exists in any table, then we do not submit data to SBI(Do not show "SBI Send now" button).
	*/
	$checkSMSMobileandPanSql = "SELECT scd.sbiccoffersid, scd.sbicc_mobile, scd.sbicc_pancard, scc.first_dated as SCC_FirstDated, sccl.first_dated as SCCL_FirstDated FROM `sbi_ccoffers_directonsite` as scd LEFT JOIN `sbi_credit_card_5633` as scc ON(scc.RequestID = scd.sbiccoffersid AND (scc.first_dated > DATE_SUB(NOW(), INTERVAL 180 DAY))) LEFT JOIN `sbi_credit_card_5633_log` as sccl ON (sccl.cc_requestid = scd.sbiccoffersid AND (sccl.first_dated > DATE_SUB(NOW(), INTERVAL 180 DAY))) WHERE (scd.`sbicc_mobile` = '".$ccrow["sbicc_mobile"]."' ";
	
	
	if(!empty($ccrow["sbicc_pancard"]))
	{
		$checkSMSMobileandPanSql .= " OR (scd.`sbicc_pancard` = '".$ccrow["sbicc_pancard"]."') ";
	}
	
	$checkSMSMobileandPanSql .= " ) AND (scc.first_dated != '0000-00-00 00:00:00' OR sccl.first_dated != '0000-00-00 00:00:00') AND ((scc.StatusCode!='156' OR sccl.StatusCode!='156') AND (scc.StatusCode IS NOT NULL))  AND (scc.productflag=10)  ";

	//echo $checkSMSMobileandPanSql;
	$checkSMSMobileandPanQuery = d4l_ExecQuery($checkSMSMobileandPanSql);
	while($newccrow=d4l_mysql_fetch_assoc($checkSMSMobileandPanQuery))
	{
		if($newccrow['sbiccoffersid'] != ''){
			$RequestIDArr[] = strtoupper($newccrow['sbiccoffersid']);
		}
		if($newccrow['sbicc_pancard'] != ''){
			$PancardArr[] = strtoupper($newccrow['sbicc_pancard']);
		}
		if($newccrow['sbicc_mobile'] != ''){
			$MobileArr[] = $newccrow['sbicc_mobile'];
		}
	}
	
	$checkSMSMobileandPanNumRows = d4l_mysql_num_rows($checkSMSMobileandPanQuery);      

	if($checkSMSMobileandPanNumRows>0)
	{
		$str="";
		
		$requestiduniquearr = array_unique($RequestIDArr);
		// If only one row and request id is same
		if(count($requestiduniquearr) == 1 && $requestiduniquearr[0] == $requestid){
				$str .= "Already Punched for you earlier ";
		}else{
			$pancountarr = array_count_values($PancardArr);
			$pan_count = $pancountarr[strtoupper($ccrow["sbicc_pancard"])];
			if($pan_count>0){
				$str .= "Duplicate PAN Number ";
			}
			
			$mobcountarr = array_count_values($MobileArr);
			$mob_count = $mobcountarr[$ccrow["sbicc_mobile"]];
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
		$getSBIButtonSql = "SELECT response_xml FROM `webservice_log_sbi` WHERE cc_requestid IN (SELECT cc_requestid FROM (select cc_requestid, COUNT(cc_requestid) AS c FROM `webservice_log_sbi` GROUP BY cc_requestid HAVING C < 2 ) as temp) AND response_xml = '' AND cc_requestid = '".$requestid."' AND response_blank = 0";
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
			$getSBIButtonRefHashSql = "SELECT bank_api_response_data FROM `xkyknzl5dwfyk4hg_tms_bank_api` WHERE `product_type` =  'CC' AND  `bank_code` =  '002' AND d4l_id='".$requestid."' AND d4l_id!=0 AND bank_api_response_data!=''";
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
				$checkPANInRequestSql = "SELECT * FROM `sbi_credit_card_5633` as scc WHERE request_xml LIKE '%<PAN>".$ccrow["sbicc_pancard"]."</PAN>%' AND (scc.first_dated > DATE_SUB(NOW(), INTERVAL 180 DAY)) AND (scc.ProcessingStatus IN (1,2,4,5,6,7) OR (scc.StatusCode = 156 AND RequestID != '".$requestid."'))";
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
					$checkPANInLogSql = "SELECT sbicclogid FROM `webservice_log_sbi` WHERE cc_requestid IN (SELECT cc_requestid FROM (select cc_requestid, COUNT(cc_requestid) AS c FROM `webservice_log_sbi` GROUP BY cc_requestid HAVING C < 2 ) as temp) AND response_xml = '' AND response_blank = 0 AND request_xml LIKE '%<PAN>".$ccrow["sbicc_pancard"]."</PAN>%' AND (first_dated > DATE_SUB(NOW(), INTERVAL 180 DAY))";//updated on 13092017
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
						/*To check if given pancard is found in any request_xml and response xml is blank for sbi log table*/
						$checkPANMobileLogSql = "SELECT sbicclogid FROM `webservice_log_sbi` WHERE request_xml != '' AND ((request_xml LIKE '%<PAN>".$ccrow["sbicc_pancard"]."</PAN>%') OR (request_xml LIKE '%<Mobile>".$ccrow["sbicc_mobile"]."</Mobile>%')) AND (first_dated > DATE_SUB(NOW(), INTERVAL 180 DAY)) AND (StatusCode != 156 OR StatusCode IS NULL)";//updated on 25092017
						//echo $checkPANMobileLogSql."<br>";
						$checkPANMobileLogResult = d4l_ExecQuery($checkPANMobileLogSql);
						$checkPANMobileLogNumRows = d4l_mysql_num_rows($checkPANMobileLogResult);
						if($checkPANMobileLogNumRows>0 && strlen($ccrow["sbicc_mobile"]) > 0 && strlen($ccrow["sbicc_pancard"]) > 0) 
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
							$checkSccPANMobileLogSql = "SELECT sbiccid FROM `sbi_credit_card_5633` WHERE request_xml != '' AND ((request_xml LIKE '%<PAN>".$ccrow["sbicc_pancard"]."</PAN>%') OR (request_xml LIKE '%<Mobile>".$ccrow["sbicc_mobile"]."</Mobile>%')) AND (first_dated > DATE_SUB(NOW(), INTERVAL 180 DAY)) AND (StatusCode != 156 OR StatusCode IS NULL)";//updated on 06102017
							$checkSccPANMobileLogResult = d4l_ExecQuery($checkSccPANMobileLogSql);
							$checkSccPANMobileLogNumRows = d4l_mysql_num_rows($checkSccPANMobileLogResult);
							if($checkSccPANMobileLogNumRows>0 && strlen($ccrow["sbicc_mobile"]) > 0 && strlen($ccrow["sbicc_pancard"]) > 0) 
							{
								//Insert sbi check error log
								$dataArr['StepNumber'] = 'Seven';
								insertsbicheckerrorlog($dataArr);
						
								//Hide Button 
								echo "<b>Duplicate Pancard Or Mobile Number..<b>";
							}
							else{

								/*To check if given pancard or mobile is found in any request_xml for sbi_credit_card_5633*/
								$checkSccPANMobileLog156Sql = "SELECT sbiccid,RequestID FROM `sbi_credit_card_5633` WHERE request_xml != '' AND ((request_xml LIKE '%<PAN>".$ccrow["sbicc_pancard"]."</PAN>%') OR (request_xml LIKE '%<Mobile>".$ccrow["sbicc_mobile"]."</Mobile>%')) AND (first_dated > DATE_SUB(NOW(), INTERVAL 180 DAY)) AND (StatusCode = 156) order by sbiccid DESC limit 0,1";//updated on 10102017
								$checkSccPANMobileLog156Result = d4l_ExecQuery($checkSccPANMobileLog156Sql);
								$checkSccPANMobileLogNum156Rows = d4l_mysql_num_rows($checkSccPANMobileLog156Result);
								$checkRequestID = d4l_mysql_result($checkSccPANMobileLog156Result,0,'RequestID');
								if($checkSccPANMobileLogNum156Rows>0 && strlen($ccrow["sbicc_mobile"]) > 0 && strlen($ccrow["sbicc_pancard"]) > 0 && ($checkRequestID!=$requestid )) 
								{
									//Insert sbi check error log
									$dataArr['StepNumber'] = 'Eight';
									insertsbicheckerrorlog($dataArr);

									//Hide Button 
									echo "<b>Duplicate Pancard Or Mobile Number...<b>";
								}
								else{

									if(strlen($ccrow["sbicc_mobile"]) > 0 && strlen($ccrow["sbicc_pancard"]) > 0){
										//Insert sbi check error log
										$dataArr['StepNumber'] = 'Final';
										insertsbicheckerrorlog($dataArr);
									}
									?>
									<form method="POST" action="/soapservice_sbi5633_twl.php" name="sendform">
										<input type="hidden" name="process" id="process"  value="main" />
										<input type="hidden" name="agent_id" id="agent_id"  value="<?php echo $bidderid; ?>" />
										<input type="hidden" name="custid"id="custid"  value="<?php echo $requestid; ?>">
										<input type="Submit" id="submitbtn" name="Submitd" value="Send now" style="color:#FFF; background-color:#C00;">
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
?>
<!-- SBI Response Code Start -->
<tr>
	<td>
	<table style='border:1px dotted #9C9A9C;' cellspacing="0" cellpadding="5" width="100%" height="80%" align="center" border="1" >
	<tr><td colspan="4" align="left"><b>SBI Response:<b></td></tr>
	<tr>
		<td colspan="4">
		<?php
		$sbiDetailsQry ="SELECT * FROM sbi_credit_card_5633 WHERE RequestID=".$requestid." AND ApplicationNumber!='' ORDER BY sbiccid DESC LIMIT 0,1";
		$sbiDetailsResult = d4l_ExecQuery($sbiDetailsQry);
		$numSbiRows = d4l_mysql_num_rows($sbiDetailsResult);
		if($numSbiRows>0)
		{
			$sbiDetailsArr = d4l_mysql_fetch_array($sbiDetailsResult); 
			if(count($sbiDetailsArr)) {
			?>
			<table align="left">
				<tr>
					<td>Application Number : <? echo $sbiDetailsArr["ApplicationNumber"]; ?> <br>Status Code : <? echo $sbiDetailsArr["StatusCode"]; ?><br>Processing Status : <? echo $sbiDetailsArr["ProcessingStatus"]; ?><br>Messages : <? echo $sbiDetailsArr["Messages"]; ?><br>message : <? echo $sbiDetailsArr["message"]; ?></td>
				</tr>
			</table>
			<?php 
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
	
	$insertchecksqry="INSERT INTO sbi_checks_errorlog SET RequestID='".$RequestID."',productflag='".$productflag."',Mobile='".$Mobile."',Pancard='".$Pancard."',StepNumber='".$StepNumber."',PageUrl='".$PageUrl."',Dated='".$Dated."'";
	d4l_ExecQuery($insertchecksqry);
}

?>
