<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';

$maxage=date('Y')-62;
$minage=date('Y')-18;

	$pl_requestid = $_REQUEST['pl_requestid'];
	$pl_bank_name = $_REQUEST['pl_bank_name'];
	
	if (strlen($pl_bank_name)>1 && $pl_requestid>1)
	{
		$selqry="select Email,Loan_Amount,Company_Name,City,Net_Salary,Mobile_Number,RequestID,PL_Bank,Name,DOB from Req_Loan_Personal Where RequestID=".$pl_requestid;
	$restselqry= ExecQuery($selqry);
	$plrow=mysql_fetch_array($restselqry);
	$pl_banks=$plrow['PL_Bank'];
	$Mobile_Number=$plrow['Mobile_Number'];
	$Name=$plrow['Name'];
	$RequestID=$plrow['RequestID'];
	$DOB=$plrow['DOB'];
	$City=$plrow['City'];
	$Company_Name=$plrow['Company_Name'];
	$Net_Salary=$plrow['Net_Salary'];
	$Email=$plrow['Email'];
	$Loan_Amount=$plrow['Loan_Amount'];
	list($year,$month,$day) = split('[-]',$DOB);
	
	if(strlen($pl_banks)>1)
		{
			$newpl_banks= $pl_banks.",".$pl_bank_name;
			$plupdate= "Update Req_Loan_Personal  set PL_Bank='".$newpl_banks."' Where (Req_Loan_Personal.RequestID=".$pl_requestid.")";		
		}
		else
		{
			$plupdate= "Update Req_Loan_Personal  set PL_Bank='".$pl_bank_name."' Where (Req_Loan_Personal.RequestID=".$pl_requestid.")";
		
		}
		ExecQuery($plupdate);
		//echo $plupdate."<br>";
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Apply for Personal Loan  | Personal Loan Application | Personal Loans Comparison Chart</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<meta name="description" content="Apply for Credit Cards online: Get facility to apply directly for credit cards in all banks. Online Credit Card application form to get information about credit card schemes from all credit cards provider banks located in major cities of India like Mumbai, Delhi, Gurgaon, Bangalore, Ahmedabad, Chennai, Hyderabad, Navi Mumbai, Kochi etc.">
<meta name="keywords" content="Credit Card Application, Apply Credit Cards, Compare Credit Cards in Mumbai Hyderabad Pune kolkata Delhi Noida Bangalore">
<link href="source.css" rel="stylesheet" type="text/css" />
 <script type="text/javascript" src="scripts/mainmenu.js"></script>
 <script type="text/javascript" src="scripts/common.js"></script>
<style type="text/css">
<!-- 
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color: #203f5f;
	overflow-x:hidden;
	background-color:#FFF;
}
.red {
	color: #F00;
}
.apply_pl_input{
  border: 2px solid #999999;
    height: 28px;
    width: 298px;
	}
.dd_pl
{
	border: 2px solid #999999;
    height: 28px;
    width: 58px;
	}
.yy_pl
{
	border: 2px solid #999999;
    height: 28px;
    width: 58px;
	}
.boldtxt
{
    font-family: Verdana, Arial, Helvetica, sans-serif;
    font-size: 12px;
       padding-left: 5px;
}
-->
</style>
<script language="javascript" type="application/javascript">
function ckhplform(Form)
{
var a=Form.panno.value;
	var regex1=/^[a-zA-Z]{5}\d{4}[a-zA-Z]{1}$/;  //this is the pattern of regular expersion
	
	if((Form.full_name.value=="") || (Form.full_name.value=="Name")|| (Trim(Form.full_name.value))==false)
	{
		alert("Kindly fill in your Name!");
		Form.full_name.focus();
		return false;
	}
	else if(containsdigit(Form.full_name.value)==true)
	{
		alert("Name contains numbers!");
		Form.full_name.focus();
		return false;
	}
	for (var i = 0; i < Form.full_name.value.length; i++) {
	if (iChars.indexOf(Form.full_name.value.charAt(i)) != -1) {
		alert ("Name has special characters.\n Please remove them and try again.");
		Form.full_name.focus();
		return false;
	}
	}
	if(Form.day.value=="" ||  Form.day.value=="DD")
	{
		alert("Please fill your day of birth.");
		Form.day.focus();
		return false;
	}
	if(Form.day.value!="")
	{
	 if((Form.day.value<1) || (Form.day.value>31))
	{
	alert("Kindly Enter your valid Date of Birth(Range 1-31)");
	Form.day.focus();
	return false;
	}
	}
	if(!checkData(Form.day, 'Day', 2))
		return false;
	
	if(Form.month.value=="" || Form.month.value=="MM")
	{
		alert("Please fill your month of birth.");
		Form.month.focus();
		return false;
	}
	if(Form.month.value!="")
	{
	if((Form.month.value<1) || (Form.month.value>12))
	{
	alert("Kindly Enter your valid Month of Birth(Range 1-12)");
	Form.month.focus();
	return false;
	}
	}
	if(!checkData(Form.month, 'month', 2))
		return false;

	if(Form.year.value=="" || Form.year.value=="YYYY")
	{
		alert("Please fill your year of birth.");
		Form.year.focus();
		return false;
	}
		if(Form.year.value!="")
	{
	if((Form.year.value < <? echo $minage; ?>) || (Form.year.value ><? echo $maxage; ?>))
	{
		alert("Age Criteria! \n Applicants between age group 18 - 62 only are elgibile.");
		Form.year.focus();
		return false;
		}
	}
	
	if(!checkData(Form.year, 'Year', 4))
		return false;
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
	if(Form.residence_address.value=="")
	{
			alert("Please enter Residence Address");
			Form.residence_address.focus();
			return false;
	}

	if(Form.office_address.value=="")
		{
				alert("Please enter Office Address");
				Form.office_address.focus();
				return false;
		}
	}
</script>
</head>
<body>
<?php include "top-menu.php"; ?>
<!--top-->
<!--logo navigation-->
<?php include "main-menu.php"; ?>
<!--logo navigation-->
<div class="text12" style="margin:auto; width:970px; height:11px; margin-top:11px; color:#0a8bd9;"><u><a href="index.html" class="text12" style="color:#0080d6;" >Home</a></u> > <a href="personal-loans.php"  class="text12" style="color:#0080d6;"><u>Personal Loan</u></a> <span class="text12" style="color:#4c4c4c;">> ING VYSYA BANK</span></div>
<div style="clear:both; height:1px;"></div>
<div style="clear:both; width:960px; margin:auto;  margin-top:2px;">
<div id="container">
  <div id="txt"  style="padding-top:15px;padding-bottom:15px;">
<table align="center" width="700" border="0" cellpadding="0" cellspacing="0">
<tr>
<td>
  <form name="ing_calc" method="POST" action="apply-ingpl-consent-continue.php" onSubmit="return ckhplform(document.ing_calc) ;">
			<input type="hidden" id="RequestID" name="RequestID" value="<? echo $RequestID; ?>">
             <input type="hidden" id="Name" name="Name" value="<? echo $Name; ?>">
            <input type="hidden" id="Mobile_Number" name="Mobile_Number" value="<? echo $Mobile_Number; ?>">
             <input type="hidden" id="Company_Name" name="Company_Name" value="<? echo $Company_Name; ?>">
              <input type="hidden" id="Net_Salary" name="Net_Salary" value="<? echo $Net_Salary; ?>">
              <input type="hidden" id="Email" name="Email" value="<? echo $Email; ?>">
              <input type="hidden" id="Loan_Amount" name="Loan_Amount" value="<? echo $Loan_Amount; ?>">
              <input type="hidden" id="City" name="City" value="<? echo $City; ?>">
              <table width="95%"  border="0" align="center" cellpadding="1" cellspacing="4" class="rgtfrmbg_nw"  style="border:1px solid #999999;">            
                <tr align="center">
                  <td height="35" colspan="2" class="stepdng" style="font-size:22px; text-align:left; color:#ae4212;  font-family: Verdana, Arial, Helvetica, sans-serif;">Other Details</td>
                  </tr>
                  <tr>
	<td align="left" class="boldtxt">Name As Per PAN Card</td>
	<td align="left"><input type="text" name="full_name" id="full_name"  class="apply_pl_input" tabindex="1" style="width: 290px !important;" value="<? echo $Name;?>"/></td>
</tr>  
<tr>		<td height="29" align="left" class="boldtxt">DOB As Per PAN Card</td>		<td align="left" class="boldtxt"><input type="text" class="dd_pl" name="day" id="day" maxlength="2"   onkeyup="intOnly(this);" onkeypress="intOnly(this);" onchange="intOnly(this);"  tabindex="2" value="<? echo $day; ?>"/>		/ <input type="text" class="dd_pl" name="month" id="month" maxlength="2"   onkeyup="intOnly(this);" onkeypress="intOnly(this);" onchange="intOnly(this);"  tabindex="3" value="<? echo $month; ?>"/> 		/		<input type="text" class="yy_pl" name="year" id="year" maxlength="4"   onkeyup="intOnly(this);" onkeypress="intOnly(this);" onchange="intOnly(this);"  tabindex="4"  style="width:140px !important;" value="<? echo $year; ?>"/></td>	</tr>	 
             <tr>
	<td align="left" class="boldtxt">PAN Card Number</td>
	<td align="left"><input type="text" name="panno" id="panno"  class="apply_pl_input" tabindex="1" style="width: 290px !important;" /></td>
</tr>       
<tr>
	<td width="41%" height="29" align="left" class="boldtxt">Residence Address <br>
	  (With Landmark & PIN Code)</td>
	<td width="59%" align="left"><textarea rows="3" cols="30" name="residence_address" id="residence_address" style=" border: 2px solid #999999; width: 290px;" tabindex="5"></textarea></td>
</tr>
<tr>
	<td width="41%" height="29" align="left" class="boldtxt">Office Address <br>
	  (With Landmark & PIN Code)</td>
	<td width="59%" align="left"><textarea rows="3" cols="30" name="office_address" id="office_address" style=" border: 2px solid #999999; width: 290px;" tabindex="6"> </textarea></td>
</tr>
	
				<tr>
                  <td colspan="2" id="addothercity"></td>
                </tr>
                 <tr>
                  <td height="55" colspan="2" align="center" ><input name="image"  value="Submit" type="image" src="new-images/get-instant-approval-btn.png"  width="173" height="37" style="border:0px;" tabindex="15" /></td>
                </tr>
                 <tr>	
                	<td colspan="2">&nbsp;
                    </td></tr>
                    </table>
            </form>
            </td></tr></table>
            </div>
            <div class="text12" style="color:#4c4c4c;">
                 <b>Terms & Conditions</b><br>
&bull;The Approval/Rejection of loan is at the sole discretion of ING Vysya Bank. This scheme is applicable only to citizen of India.<br>
&bull;This scheme is only valid for customers applying on Deal4Loans.com for Personal Loan and opting for ING Vysya Bank. Also, the basic Eligibility criteria as per ING Vysya Bank policy norms should be fulfilled.<br>
&bull;This scheme can be withdrawn by ING Vysya Bank at any time without giving any prior notice to the customers.<br><br>
<b>Disclaimer :</b> By submitting the above details you are authorizing ING Vysya Bank to run a CIBIL check on your profile
           	</div>

</div>
<div style="clear:both; height:80px; width:964px; margin:auto; margin-top:10px;"></div>
</div>
<?php //include "footer1.php"; ?>
</body>
</html>