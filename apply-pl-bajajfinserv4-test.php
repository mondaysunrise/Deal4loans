<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	
	$pl_requestid = $_REQUEST["pl_requestid"];
	$loan_amount = $_REQUEST["loan_amount"];
	$name = $_REQUEST["name"];
	$DOB = $_REQUEST["DOB"];
	$company_name = $_REQUEST["company_name"];
	$salary = $_REQUEST["salary"]/12;
	$City = $_REQUEST["City"];
	$Mobile_Number = $_REQUEST["Mobile_Number"];
	$Email = $_REQUEST["Email"];
	$source = $_REQUEST["source"];
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">
.heading_text {
	font: bold 18px/100% Arial, Helvetica, sans-serif;
	color: #0199cd;
	margin-left: 15px;
}
.sbi_text_c {
	color: #0199cd;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 13px;
	font-weight: bold;
}
#sidebar {
	width: 340px;
	float: right;
	margin: 30px 0 30px;
}
#content {
	background: #fff;
	margin: 30px 0 30px 20px;
	padding: 10px;
	width: 570px;
	float: left;
	/* rounded corner */
	-webkit-border-radius: 8px;
	-moz-border-radius: 8px;
	border-radius: 8px;
	/* box shadow */
	-webkit-box-shadow: 0 1px 3px rgba(0,0,0,.4);
	-moz-box-shadow: 0 1px 3px rgba(0,0,0,.4);
	box-shadow: 0 1px 3px rgba(0,0,0,.4);
}
.widget {
	background: #fff;
	margin: 0 0 30px;
	padding: 10px 20px;
	/* rounded corner */
	-webkit-border-radius: 8px;
	-moz-border-radius: 8px;
	border-radius: 8px;
	/* box shadow */
	-webkit-box-shadow: 0 1px 3px rgba(0,0,0,.4);
	-moz-box-shadow: 0 1px 3px rgba(0,0,0,.4);
	box-shadow: 0 1px 3px rgba(0,0,0,.4);
}
.bajaj-fin_input {
	width: 100%;
	height: 25px;
	border-radius: 5px 5px 5px 5px;
	border: solid 2px #0199cd;
}
.bajaj-fin_txtinput {
	width: 100%;
	border-radius: 5px 5px 5px 5px;
	border: solid 2px #0199cd;
}
.sbi_text_bullet ul {
	padding: 0px 0px 0px 0px;
	margin: 0px 0px 0px 0px
}
.sbi_text_bullet li {
	color: #0199cd;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 14px;
	font-weight: bold;
	list-style: url(/new-images/sbi_bullet1.jpg);
	margin-left: 15px;
	line-height: 25px;
}
.sbi_text_bullet li a {
	color: #0199cd;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 14px;
	font-weight: bold;
}
</style>
<link href="source.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.heading_text1 {
	font: bold 20px/100% Arial, Helvetica, sans-serif;
	color: #0199cd;
	margin-left: 20px;
}
</style>
<script type="text/javascript" src="scripts/mainmenu.js"></script>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script Language="JavaScript" Type="text/javascript">
function sameasabove_adress()
{
	var ni1 = document.cibil_form.caddress.value;
	document.getElementById('paddress').value= ni1;	
	var ni2 = document.cibil_form.state.value;
	document.getElementById('pstate').value= ni2;	
	var ni3 = document.cibil_form.pincode.value;
	document.getElementById('ppincode').value= ni3;
}

function ckhcreditcard(Form)
{
var a=Form.panno.value;
	var regex1=/^[a-zA-Z]{5}\d{4}[a-zA-Z]{1}$/;  //this is the pattern of regular expersion
	if(regex1.test(a)== false)
	{
	  alert('Please enter valid pan number');
	  Form.panno.focus();
	  return false;
	}
	if (Form.panno.value.charAt(3)!="P" && Form.panno.value.charAt(3)!="p")
	{
			alert("Please enter valid pan number");
			Form.panno.focus();
			return false;
	}
	if(Form.caddress.value=="")
	{
			alert("Please enter Current Address");
			Form.caddress.focus();
			return false;
	}
	if(Form.state.value=="")
	{
			alert("Please enter Current Address State");
			Form.state.focus();
			return false;
	}
	if(Form.pincode.value=="")
	{
			alert("Please enter Current Address Pincode");
			Form.pincode.focus();
			return false;
	}
	else if(Form.pincode.value.length < 6)
		{
		alert("Kindly fill in your Pincode(6 Digits)!");
		Form.pincode.focus();
		return false;
		}
if(Form.paddress.value=="")
	{
			alert("Please enter Permanent Address");
			Form.paddress.focus();
			return false;
	}
	if(Form.pstate.value=="")
	{
			alert("Please enter Permanent Address State");
			Form.pstate.focus();
			return false;
	}
	if(Form.ppincode.value=="")
	{
			alert("Please enter Permanent Address Pincode");
			Form.ppincode.focus();
			return false;
	}
	else if(Form.ppincode.value.length < 6)
		{
		alert("Kindly fill in your Pincode(6 Digits)!");
		Form.ppincode.focus();
		return false;
		}
}
</script>
</head>
<body>
<?php include "middle-menu.php"; ?>
<div style="clear:both;"></div>
<div class="cc_inner_wrapper">
<div style="clear:both;"></div>
<div class="common-bread-crumb" style="margin:auto; width:74%; margin-top:70px; color:#0a8bd9;"><u><a href="index.php" class="text12" style="color:#0080d6;" >Home</a></u> > <a href="#"  class="text12" style="color:#0080d6;"><u>Personal Loan</u></a> <span class="text12" style="color:#4c4c4c;">> Apply for Personal Loan</span></div>
<div style="clear:both; height:15px;"></div>
<div style="width:995px;  margin:auto;">
  <div id="content">
    <form name="cibil_form" method="post" action="apply-pl-bajajfinserv5.php"  onSubmit="return ckhcreditcard(document.cibil_form); ">
      <input type="hidden" name="requestid" id="requestid" value="<? echo $pl_requestid; ?>"/>
      <input type="hidden" name="Email" id="Email" value="<? echo $Email; ?>"/>
      <input type="hidden" name="City" id="City" value="<? echo $City; ?>"/>
      <input type="hidden" name="source" id="source" value="<? echo $source; ?>"/>
      <input type="hidden" name="Mobile_Number" id="Mobile_Number" value="<? echo $Mobile_Number; ?>"/>
      <table align="center"  cellpadding="5" cellspacing="0"  width="100%">
        <tr>
          <td colspan="2"   bgcolor="#FFFFFF" class="heading_text" align="left">Fill in the below details to start your loan application process</td>
        </tr>
        <tr>
          <td colspan="2" valign="middle" bgcolor="#FFFFFF" class="heading_text" height="40">&nbsp;Enquiry Details</td>
        </tr>
        <tr>
          <td class="sbi_text_c">Enquiry Amount:</td>
          <td><input type="text" name="loan_amount" id="loan_amount" value="<? echo $loan_amount; ?>" class="bajaj-fin_input" /></td>
        </tr>
        <tr>
          <td colspan="2"  class="heading_text" height="40">&nbsp;Personal Details</td>
        </tr>
        <tr>
          <td class="sbi_text_c" height="25">Name:</td>
          <td><input type="text" name="name" id="name" value="<? echo $name; ?>" class="bajaj-fin_input"/></td>
        </tr>
        <tr>
          <td class="sbi_text_c" height="25">DOB:</td>
          <td><input type="text" name="dob" id="dob" value="<? echo $DOB; ?>" class="bajaj-fin_input"/></td>
        </tr>
        <tr>
          <td width="205" class="sbi_text_c">Gender:</td>
          <td width="273" class="sbi_text_c"><input type="radio" name="gender" id="gender" value=1 />
            Male
            <input type="radio" name="gender" id="gender" value="2"/>
            female</td>
        </tr>
        <tr>
        <tr>
          <td class="sbi_text_c" height="25">Qualification:</td>
          <td>
			<Select name="Qualification" id="Qualification" class="bajaj-fin_input">
			<option value="">Please Select</option>
				<option value="Graduate">Graduate</option>
				<option value="Post Graduate">Post Graduate</option>
				<option value="Professionally Qualified">Professionally Qualified</option>
				<option value="Other">Other</option>				
			</Select></td>
        </tr>
        <tr>
          <td class="sbi_text_c" height="25">Marital Status:</td>
          <td width="273" class="sbi_text_c"><Select name="MaritalStatus" id="MaritalStatus" class="bajaj-fin_input">
			<option value="">Please Select</option>
			<option value="1">Single</option>
			<option value="2">Married</option>
			<option value="3">Widow</option>
			<option value="4">Divorced</option>
			</Select>
          </td>
        </tr>
        
          <td colspan="2" valign="middle" class="heading_text" height="40">&nbsp;Identification</td>
        </tr>
        <tr>
          <td class="sbi_text_c" height="25">PAN No:</td>
          <td><input type="text" name="panno" id="panno" maxlength="10" class="bajaj-fin_input"/></td>
        </tr>
        <tr>
          <td class="sbi_text_c" >Residence Address <br />
            (With Landmark):</td>
          <td ><textarea rows="3" cols="21" name="caddress" id="caddress" class="bajaj-fin_txtinput"></textarea></td>
        </tr>
        <tr>
          <td class="sbi_text_c">Current Residence Pincode:</td>
          <td><input type="text" name="Resi_Pincode" id="Resi_Pincode" value="<? echo $Resi_Pincode; ?>" class="bajaj-fin_input" maxlength="6"/></td>
        </tr>
        <tr>
          <td class="sbi_text_c" height="25">Office Address <br />
            (With Landmark):</td>
          <td style="font-size:13px;"><textarea rows="3" cols="19" name="paddress" id="paddress" class="bajaj-fin_txtinput" maxlength="200"></textarea></td>
        </tr>
        <tr>
        <tr>
          <td class="sbi_text_c">Current Office Pincode:</td>
          <td><input type="text" name="Offi_Pincode" id="Offi_Pincode" value="<? echo $Offi_Pincode; ?>" class="bajaj-fin_input"  maxlength="6"/></td>
        </tr>
         <tr>
          <td class="sbi_text_c">Office City:</td>
          <td><select name="OffiCity" id="OffiCity" class="bajaj-fin_input">
                <?php echo plgetCityList($City); ?>
                <option value="Vapi">Vapi</option>
                <option value="Ankleshwar">Ankleshwar</option>
                <option value="Anand">Anand</option>
                <option value="Anand">Dahod</option>
                <option value="Anand">Navsari</option>
            </select>
		  </td>
        </tr>
           <tr>
           <td class="sbi_text_c">Office Landline Number:</td>
          <td><table width="100%" cellpadding="0" cellspacing="0"><tr><td width="19%"><input type="text" name="OffiStdCode" id="OffiStdCode" value="STD" class="bajaj-fin_input" style=""/></td>&nbsp;<td width="79%"><input type="text" name="OffiLandlineNum" id="OffiLandlineNum" class="bajaj-fin_input"/></td></tr></table></td>
        </tr>
		<tr>        
          <td colspan="2" valign="middle" class="heading_text">&nbsp;Employer Details</td>
        </tr>
        <tr>
          <td class="sbi_text_c" height="25">Employer Name:</td>
          <td><input type="text" name="company_name" id="company_name" value="<? echo $company_name; ?>" class="bajaj-fin_input"/></td>
        </tr>
        <tr>
          <td class="sbi_text_c" height="25">Gross Monthly Salary:</td>
          <td><input type="text" name="salary" id="salary" value="<? echo round($salary); ?>" class="bajaj-fin_input"/></td>
        </tr>
        <tr>
          <td class="sbi_text_c" height="25">Net Monthly Salary:</td>
          <td><input type="text" name="salary" id="salary" value="<? echo round($salary);?>" class="bajaj-fin_input"/></td>
        </tr>
        
          <td colspan="2" align="center"><input type="submit" style="border: 0px none ; background-image: url(new-images/submit_details.jpg); width: 153px; height: 47px; margin-bottom: 0px;" value=""/></td>
        </tr>
        <tr>
          <td colspan="2" class="sbi_text_c" style="color:#333333; font-weight:normal;"><b>Disclaimer</b> : By submitting the above details you are authorizing Bajaj Finserv Lending to run a CIBIL check on your profile </td>
        </tr>
      </table>
    </form>
    <div class="sbi_text_c" style="color:#333333; font-weight:bold; padding-top:10px;">Terms & Conditions<br />
      <ul class="sbi_text_c" style="color:#333333; font-weight:normal;">
        <li>The Approval/Rejection of loan is at the sole discretion of Bajaj Finance Ltd (hereinafter referred to as ‘Bajaj Finserv Lending’) .This scheme is applicable only to citizen of India.</li>
        <li>The 24 Hour Approval Guarantee will start Post Login Only i.e. Only once complete documents are submitted along with the Application Form and Not from the date/time of applying with Deal4Loans.com </li>
        <li>In case any additional  hard copies of the documents are required Post Login, those documents have to be arranged and submitted by the customer. In case of unavailability/delay in submitting the required document the 24 Hour Approval Guarantee shall become invalid & Bajaj Finserv Lending will not be responsible for the same.</li>
        <li> This scheme is only valid for customers applying on Deal4Loans.com for Personal Loan and opting for Bajaj Finserv Lending. Also, the basic Eligibility criteria as per Bajaj Finserv Lending policy norms should be fulfilled.</li>
        <li> This scheme can be withdrawn by Bajaj Finserv Lending  at any time without giving any prior notice to the customers.</li>
      </ul>
      <br />
      <br />
    </div>
  </div>
  <div id="sidebar">
    <div class="widget">
      <table width="100%" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td width="58%" height="40" class="heading_text1" style="font-size:18px;"><span class="heading_text_b">Why Bajaj Finserv?</span></td>
          <td width="42%" align="right" class="heading_text1" style="font-size:18px;"><img src="new-images/bajaj-finserv1.jpg" width="117" height="53" /></td>
        </tr>
        <tr>
          <td colspan="2" style="color:#999; font-family:Verdana, Geneva, sans-serif; font-size:12px;">&nbsp;</td>
        </tr>
      </table>
      <div class="sbi_text_bullet">
        <ul>
          <li>Loans up to Rs.18 lacs<br/>
            <div style="font-size:11px; color:#999; font-weight:normal; line-height:15px;">Bold dreams need big means. We offer the highest ticket size of up to 25 lacs so that you can pursue your bold dreams. This is the highest ticket size that anyone offers in this category.</div>
          </li>
          <li>Step Down Interest Rate <br/>
            <div style="font-size:11px; color:#999; font-weight:normal; line-height:15px;">0.20% reduction in IRR in year 2 and year 3 (only for 2 yrs). </div>
          </li>
          <li>Part Prepayment facility <br/>
            <div style="font-size:11px; color:#999; font-weight:normal; line-height:15px;">You can prepay upto 6 times in a calendar year at any interval with the minimum amount per prepay transaction being not less than 3 EMIs. There is no limit on the maximum amount. This is subject to your clearing your first EMI. </div>
          </li>
          <li>Nil Foreclosure charges <br/>
            <div style="font-size:11px; color:#999; font-weight:normal; line-height:15px;">Now you can choose to foreclose your loan anytime during your loan tenor without paying any foreclosure charges. </div>
          </li>
          <li>Access to best Relationship Manager <br/>
            <div style="font-size:11px; color:#999; font-weight:normal; line-height:15px;">Get best service from quality sales representative. </div>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>
<div style="clear:both;"></div>
<!--partners-->
<?php include("footer_sub_menu.php"); ?>
</body>
</html>
