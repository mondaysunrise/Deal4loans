<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';

	$pl_requestid = $_REQUEST['pl_requestid'];
	$pl_bank_name = $_REQUEST['pl_bank_name'];


if (strlen($pl_bank_name)>1 && $pl_requestid>1)
{
	$selqry="select PL_Bank,Loan_Amount,Name,DOB,Company_Name,Net_Salary,City,Mobile_Number,Email,source from Req_Loan_Personal Where RequestID=".$pl_requestid;
	list($Numrows,$plrow)=MainselectfuncNew($selqry,$array = array());
	$countr = count($plrow)-1;
	$pl_banks=$plrow[$countr]['PL_Bank'];
	$loan_amount = $plrow[$countr]["Loan_Amount"];
	$name = $plrow[$countr]["Name"];
	$DOB = $plrow[$countr]["DOB"];
	$company_name = $plrow[$countr]["Company_Name"];
	$salary = $plrow[$countr]["Net_Salary"]/12;
	$City = $plrow[$countr]["City"];
	$Mobile_Number = $plrow[$countr]["Mobile_Number"];
	$Email = $plrow[$countr]["Email"];
	$source = $plrow[$countr]["source"];

if(strlen($pl_banks)>1)
	{
		$newpl_banks= $pl_banks.",".$pl_bank_name;
		$wherecondition= "(Req_Loan_Personal.RequestID=".$pl_requestid.")";
		$dataarray=array("PL_Bank"=>$newpl_banks);	
	}
	else
	{
		$dataarray=array("PL_Bank"=>$pl_bank_name);
		$wherecondition= "(Req_Loan_Personal.RequestID=".$pl_requestid.")";
	}
	$rowcount=Mainupdatefunc("Req_Loan_Personal", $dataarray, $wherecondition);
	//echo $plupdate."<br>";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">
.heading_text{font: bold 18px/100% Arial, Helvetica, sans-serif; color:#0199cd; margin-left:15px; }
.sbi_text_c{ color:#0199cd; font-family:Arial, Helvetica, sans-serif; font-size:13px; font-weight:bold;}
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
.bajaj-fin_input{width:100%; height:25px; border-radius:5px 5px 5px 5px; border: solid 2px #0199cd;}
.bajaj-fin_txtinput{width:100%;  border-radius:5px 5px 5px 5px; border: solid 2px #0199cd;}

.sbi_text_bullet ul{ padding:0px 0px 0px 0px; margin:0px 0px 0px 0px}
.sbi_text_bullet li{color:#0199cd; font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; list-style: url(/new-images/sbi_bullet1.jpg); margin-left:15px; line-height:25px; }
.sbi_text_bullet li a{color:#0199cd; font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold;}

</style>


<link href="source.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.heading_text1 {font: bold 20px/100% Arial, Helvetica, sans-serif; color:#0199cd; margin-left:20px; }
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
<div id="content"><form name="cibil_form" method="post" action="/apply_pl_consent_thank.php"  onSubmit="return ckhcreditcard(document.cibil_form); ">
<input type="hidden" name="requestid" id="requestid" value="<? echo $pl_requestid; ?>"/> 
<input type="hidden" name="Email" id="Email" value="<? echo $Email; ?>"/>
<input type="hidden" name="City" id="City" value="<? echo $City; ?>"/>
<input type="hidden" name="source" id="source" value="<? echo $source; ?>"/>
<input type="hidden" name="pl_bank_name" id="pl_bank_name" value="<? echo $pl_bank_name; ?>"/>
<input type="hidden" name="Mobile_Number" id="Mobile_Number" value="<? echo $Mobile_Number; ?>"/>
<table align="center"  cellpadding="5" cellspacing="0"  width="100%">
<tr><td colspan="2"   bgcolor="#FFFFFF" class="heading_text" align="left">Fill in the below details to start your loan application process</td></tr>
<tr>
<td colspan="2" valign="middle" bgcolor="#FFFFFF" class="heading_text" height="40"> &nbsp;Enquiry Details</td></tr>
<tr>
  <td class="sbi_text_c">Enquiry Amount:</td>
  <td><input type="text" name="loan_amount" id="loan_amount" value="<? echo $loan_amount; ?>" class="bajaj-fin_input" /></td></tr>
<tr>
<td colspan="2"  class="heading_text" height="40"> &nbsp;Personal Details</td></tr>
 <tr>
  <td class="sbi_text_c" height="25">Name:</td>
  <td><input type="text" name="name" id="name" value="<? echo $name; ?>" class="bajaj-fin_input"/></td></tr>
  <tr>
  <td class="sbi_text_c" height="25">DOB:</td>
  <td><input type="text" name="dob" id="dob" value="<? echo $DOB; ?>" class="bajaj-fin_input"/></td></tr>
<tr><td width="205" class="sbi_text_c">Gender:</td>
<td width="273" class="sbi_text_c"><input type="radio" name="gender" id="gender" value=1 />Male <input type="radio" name="gender" id="gender" value="2"/>female</td></tr>
<tr>
<td colspan="2" valign="middle" class="heading_text" height="40"> &nbsp;Identification</td></tr>
<tr><td class="sbi_text_c" height="25">PAN No:</td><td><input type="text" name="panno" id="panno" maxlength="10" class="bajaj-fin_input"/></td></tr>
<!--<tr>
<td colspan="2" valign="middle" class="heading_text"> &nbsp;Residence Address</td>
</tr>-->
<tr>
  <td class="sbi_text_c" >Residence Address <br />(With Landmark & Pincode):</td>
  <td ><textarea rows="3" cols="21" name="caddress" id="caddress" class="bajaj-fin_txtinput"></textarea></td>
</tr>
<tr>
  <td class="sbi_text_c" height="25">Office Address <br />(With Landmark & Pincode):</td>
  <td style="font-size:13px;"><textarea rows="3" cols="19" name="paddress" id="paddress" class="bajaj-fin_txtinput" ></textarea></td></tr>

    <tr>
<td colspan="2" valign="middle" class="heading_text"> &nbsp;Employer Details</td></tr>
   <tr>
  <td class="sbi_text_c" height="25">Employer Name:</td>
  <td><input type="text" name="company_name" id="company_name" value="<? echo $company_name; ?>" class="bajaj-fin_input"/></td></tr>
  <tr>
  <td class="sbi_text_c" height="25">Gross Monthly Salary:</td>
  <td><input type="text" name="salary" id="salary" value="<? echo round($salary); ?>" class="bajaj-fin_input"/></td></tr>
   <tr>
  <td class="sbi_text_c" height="25">Net Monthly Salary:</td>
  <td><input type="text" name="salary" id="salary" value="<? echo round($salary);?>" class="bajaj-fin_input"/></td></tr>
    <td colspan="2" align="center"><input type="submit" style="border: 0px none ; background-image: url(new-images/submit_details.jpg); width: 153px; height: 47px; margin-bottom: 0px;" value=""/></td></tr>
    <!--<tr><td colspan="2" class="sbi_text_c" style="color:#333333; font-weight:normal;"><b>Disclaimer</b> : By submitting the above details you are authorizing Bajaj Finserv Lending to run a CIBIL check on your profile
</td></tr>-->
    </table></form>    
   </div>    
    <div id="sidebar">
    <div class="widget">
      <table width="100%" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td width="58%" height="40" class="heading_text1" style="font-size:18px;"><span class="heading_text_b">Why <? echo $pl_bank_name; ?>?</span></td>
          <td width="42%" align="right" class="heading_text1" style="font-size:18px;"></td>
        </tr>
        <tr>
          <td colspan="2" style="color:#999; font-family:Verdana, Geneva, sans-serif; font-size:12px;">&nbsp;</td>
        </tr>
      </table>
      <!--<div class="sbi_text_bullet">
  <ul>
<li>Loans up to Rs.18 lacs<br/>
<div style="font-size:11px; color:#999; font-weight:normal; line-height:15px;">Bold dreams need big means. We offer the highest ticket size of up to 25 lacs so that you can pursue your bold dreams. This is the highest ticket size that anyone offers in this category.</div></li>
<li>Step Down Interest Rate
<br/>
<div style="font-size:11px; color:#999; font-weight:normal; line-height:15px;">0.20% reduction in IRR in year 2 and year 3 (only for 2 yrs).
</div>
</li>
<li>Part Prepayment facility
<br/>
<div style="font-size:11px; color:#999; font-weight:normal; line-height:15px;">You can prepay upto 6 times in a calendar year at any interval with the minimum amount per prepay transaction being not less than 3 EMIs. There is no limit on the maximum amount. This is subject to your clearing your first EMI. 
</div>
</li>
<li>Nil Foreclosure charges
<br/>
<div style="font-size:11px; color:#999; font-weight:normal; line-height:15px;">Now you can choose to foreclose your loan anytime during your loan tenor without paying any foreclosure charges. 
</div>
</li>
<li>Access to best Relationship Manager
<br/>
<div style="font-size:11px; color:#999; font-weight:normal; line-height:15px;">Get best service from quality sales representative.
</div>
</li>
</ul>  
</div>-->
    </div>
    </div>
</div>

<div style="clear:both;"></div>
<!--partners-->
<?php 
$REMOVE_ADD=1;
include("footer_sub_menu.php"); ?>
</body>
</html>