<?php
//less Salary
session_start();
require 'scripts/db_init.php';
require 'scripts/functions.php';

$RequestID = $_SESSION['Temp_LID'];

$maxage=date('Y')-62;
$minage=date('Y')-18;
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Personal Loans | Personal Loan Rates | Personal Loan EMI</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<link href="get-pl.css" rel="stylesheet" type="text/css">
<link href="media-queries.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="scripts/common.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<style type="text/css">
	
	/* Big box with list of options */
	#ajax_listOfOptions{
		position:absolute;	/* Never change this one */
		width:250px;	/* Width of box */
		height:160px;	/* Height of box */
		overflow:auto;	/* Scrolling features */
		border:1px solid #317082;	/* Dark green border */
		background-color:#FFF;	/* White background color */
    	color: black;
		font-family:Verdana, Arial, Helvetica, sans-serif;
		text-align:left;
		font-size:10px;
		z-index:50;
	}
	#ajax_listOfOptions div{	/* General rule for both .optionDiv and .optionDivSelected */
		margin:1px;		
		padding:1px;
		cursor:pointer;
		font-size:10px;
	}

	#ajax_listOfOptions .optionDivSelected{ /* Selected item in the list */
		background-color:#2375CB;
		color:#FFF;
	}
	#ajax_listOfOptions_iframe{
		background-color:#F00;
		position:relative;
		z-index:5;
	}
.white_text{ font-size:12px; color: #FFF;}
.bank_text{ font-size:12px; color: #90662d;}
.saving_text{ font-size:12px; color: #2f8497;}
.bank_logo_box{ width:950px; margin:auto; }
	
	form{
		display:inline;
	}
	select:focus, input:focus
	{
		border:#FF0000 1px solid; 
	}
	</style>
 <script type="text/javascript" src="ajax.js"></script>
<script type="text/javascript" src="ajax-dynamic-list.js"></script>
<script type="text/javascript">

function addElementLoan()
{
	var ni1 = document.getElementById('myDivLoan1');
	var ni2 = document.getElementById('myDivLoan2');		
	ni1.innerHTML = 'How many EMI paid?';
	ni2.innerHTML = '<select name="EMI_Paid" class="sbi_input"><option value="0">Please select</option><option value="1">Less than 6 months</option> <option value="2">6 to 9 months</option> <option value="3">9 to 12 months</option> <option value="4">more than 12 months</option ></select><div id="emiVal"></div>';

	return true;
}

function removeElementLoan()
{
	var ni1 = document.getElementById('myDivLoan1');
	var ni2 = document.getElementById('myDivLoan2');
	ni1.innerHTML = '';
	ni2.innerHTML = '';	
	return true;
}


function addIdentified()
{
		var ni1 = document.getElementById('myDiv1');
		var ni2 = document.getElementById('myDiv2');
	    ni1.innerHTML = 'Card held since?';
		 ni2.innerHTML = '<select size="1" name="Card_Vintage" class="sbi_input" onchange="validateDiv(\'vintageVal\');" ><option value="0">Please select</option> <option value="1">Less than 6 months</option> <option value="2">6 to 9 months</option> <option value="3">9 to 12 months</option><option value="4">more than 12 months</option> </select><div id="vintageVal"></div>';
		
					
		return true;
}	
	
function removeIdentified()
{
	var ni1 = document.getElementById('myDiv1');
	var ni2 = document.getElementById('myDiv2');		
	ni1.innerHTML = '';
	ni2.innerHTML = '';
			
		return true;

}	

function validateDiv(div)
{
	var ni1 = document.getElementById(div);
	ni1.innerHTML = '';
}

function Trim(strValue) 
{
	var j=strValue.length-1;i=0;
	while(strValue.charAt(i++)==' ');
	while(strValue.charAt(j--)==' ');
	return strValue.substr(--i,++j-i+1);
}

function containsdigit(param)
{
	mystrLen = param.length;
	for(i=0;i<mystrLen;i++)
	{
		if((param.charAt(i)=="0") || (param.charAt(i)=="1") || (param.charAt(i)=="2") || (param.charAt(i)=="3") || (param.charAt(i)=="4") || (param.charAt(i)=="5") || (param.charAt(i)=="6") || (param.charAt(i)=="7") || (param.charAt(i)=="8") || (param.charAt(i)=="9") || (param.charAt(i)=="/"))
		{
			return true;
		}
	}
	return false;
}


function chkpersonalloan()
{
	var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
	var dt,mdate;dt=new Date();
	//var i;
	var cnt;
	var alpha=/^[a-zA-Z\ ]*$/;
	var alphanum=/^[a-zA-Z0-9]*$/;
	var num=/^[0-9]*$/;
	var space=/^[\ ]*$/;
	var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";

if(document.loan_form.day.value=="" || document.loan_form.day.value=="dd")
	{
		document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Fill Day of Birth!</span>";
		document.loan_form.day.focus();
		return false;
	}
	if(document.loan_form.day.value!="")
	{
		if((document.loan_form.day.value<1) || (document.loan_form.day.value>31))
		{
			document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Date of Birth(Range 1-31)!</span>";
			document.loan_form.day.focus();
			return false;
		}
	}
	if(!checkData(document.loan_form.day, 'Day', 2))
		return false;
	
	if(document.loan_form.month.value=="" || document.loan_form.month.value=="mm")
	{
		document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Fill month of Birth!</span>";
		document.loan_form.month.focus();
		return false;
	}
	if(document.loan_form.month.value!="")
	{
		if((document.loan_form.month.value<1) || (document.loan_form.month.value>12))
		{
			document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Month of Birth(Range 1-12)!</span>";
			document.loan_form.month.focus();
			return false;
		}
	}
	if(!checkData(document.loan_form.month, 'month', 2))
		return false;

	if(document.loan_form.year.value=="" || document.loan_form.year.value=="yyyy")
	{
		document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Fill Year of Birth!</span>";
		document.loan_form.year.focus();
		return false;
	}
	if(document.loan_form.year.value!="")
	{
		if((document.loan_form.year.value < "<?php echo $maxage;?>") || (document.loan_form.year.value >"<?php echo $minage;?>"))
		{
			document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Age between 18 -62!</span>";
			document.loan_form.year.focus();
			return false;
		}
	}
	if(!checkData(document.loan_form.year, 'Year', 4))
		return false;

	if(document.loan_form.Residential_Status.selectedIndex==0)
	{
//		alert("");
		document.getElementById('resiStatusVal').innerHTML = "<span  class='hintanchor'>Enter Residential Status!</span>";
		document.loan_form.Residential_Status.focus();
		return false;
	}
	if (document.loan_form.Pincode.value=="")
	{
		document.getElementById('pincodeVal').innerHTML = "<span  class='hintanchor'>Enter Pincode!</span>";	
		document.loan_form.Pincode.focus();
		return false;
	}
	if (document.loan_form.Pincode.value!="")
	{
		if(document.loan_form.Pincode.value.length < 6)
		{
			document.getElementById('pincodeVal').innerHTML = "<span  class='hintanchor'>Enter Pincode(6 Digits)!</span>";	
			document.loan_form.Pincode.focus();
			return false;
		}
	}
	
	var myOption = -1;
		for (i=document.loan_form.CC_Holder.length-1; i > -1; i--) {
			if(document.loan_form.CC_Holder[i].checked) {
				if(i==0)
				{
					if (document.loan_form.Card_Vintage.selectedIndex==0)
					{
						document.getElementById('vintageVal').innerHTML = "<span  class='hintanchor'>Holding Credit Card Since!</span>";	
						document.loan_form.Card_Vintage.focus();
						return false;
					}
				}
					myOption = i;
				}
		}
	
		if (myOption == -1) 
		{
			document.getElementById('vintageVal').innerHTML = "<span  class='hintanchor'>Credit Card holder or not!</span>";	
			return false;
		}
	
	if(document.loan_form.Primary_Acc.value=="")
		{
		//	alert("Please fill your Salary Account.");
			document.getElementById('priAccVal').innerHTML = "<span  class='hintanchor'>Fill your Salary Account!</span>";
			document.loan_form.Primary_Acc.focus();
			return false;
		}
	
	if(document.loan_form.Company_Type.selectedIndex==0)
	{
		//alert("Please enter Company Type to Continue");
		document.getElementById('compTypeVal').innerHTML = "<span  class='hintanchor'>Fill Company Type!</span>";
		document.loan_form.Company_Type.focus();
		return false;
	}
	if (document.loan_form.Years_In_Company.value=="")
	{
		//alert("Please enter Years in Company.");
		document.getElementById('yearsCompVal').innerHTML = "<span  class='hintanchor'>Fill Years in Company!</span>";
		document.loan_form.Years_In_Company.focus();
		return false;

	}	
	if(!checkNum(document.loan_form.Years_In_Company, 'No of years in current company',0))
		return false;

	if (document.loan_form.Total_Experience.value=="")
	{
		//alert("Please enter Total Experience.");
		document.getElementById('totalExpVal').innerHTML = "<span  class='hintanchor'>Fill Total Experience!</span>";
		document.loan_form.Total_Experience.focus();
		return false;
	}	
	if(!checkNum(document.loan_form.Total_Experience, 'Total Experience',0))
		return false;

	if(document.loan_form.Salary_Drawn.selectedIndex==0)
	{
		//alert("Please enter How do you get your salary to Continue");
		document.getElementById('salVal').innerHTML = "<span  class='hintanchor'>Fill How do you get your salary!</span>";
		document.loan_form.Salary_Drawn.focus();
		return false;
	}

	myOption1 = -1;
		for (i=document.loan_form.LoanAny.length-1; i > -1; i--) {
			if (document.loan_form.LoanAny[i].checked) {
				if(i==0)
				{
					if(document.loan_form.EMI_Paid.selectedIndex==0)
					{
						//alert('No of EMI paid.');
						document.getElementById('emiVal').innerHTML = "<span  class='hintanchor'>No of EMI paid.!</span>";
						document.loan_form.EMI_Paid.focus();
						return false;
					}

				}
				myOption1 = i;
			}
		}
		if(myOption1 == -1) 
		{
			//alert("You must select a Loan Any button");
			document.getElementById('loanVal').innerHTML = "<span  class='hintanchor'>You must select a Loan Any button!</span>";
			return false;
		}
				
	return true;

}

function addLoadEvent(func) {
  var oldonload = window.onload;
  if (typeof window.onload != 'function') {
    window.onload = func;
  } else {
    window.onload = function() {
      oldonload();
      func();
    }
  }
}

function prepareInputsForHints() {
	var inputs = document.getElementsByTagName("input");
	for (var i=0; i<inputs.length; i++){
		// test to see if the hint span exists first
		if (inputs[i].parentNode.getElementsByTagName("span")[0]) {
			// the span exists!  on focus, show the hint
			inputs[i].onfocus = function () {
				this.parentNode.getElementsByTagName("span")[0].style.display = "inline";
			}
			// when the cursor moves away from the field, hide the hint
			inputs[i].onblur = function () {
				this.parentNode.getElementsByTagName("span")[0].style.display = "none";
			}
		}
	}
	// repeat the same tests as above for selects
	var selects = document.getElementsByTagName("select");
	for (var k=0; k<selects.length; k++){
		if (selects[k].parentNode.getElementsByTagName("span")[0]) {
			selects[k].onfocus = function () {
				this.parentNode.getElementsByTagName("span")[0].style.display = "inline";
			}
			selects[k].onblur = function () {
				this.parentNode.getElementsByTagName("span")[0].style.display = "none";
			}
		}
	}
}
addLoadEvent(prepareInputsForHints);
</script>

</head>

<body>


<div id="pagewrap">

<header id="header">
<div class="top_container">
<div class="logo_get-pl"><img src="images/gpl_logo.png"></div>
<div class="text_box">Compare Personal Loan, <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Get your eligibility & Quotes 
  from different Banks</div>
</div>
  </header>
<div class="second_wrapper">
<div style="clear:both;"></div>
	<div class="right-box-c" ><h4 class="heading_text_b">Top Personal loan Banks in India - </h4>
			<span class="hdfc-bank
"><span class="sbi-bank">Sbi (State Bank)</span>, Hdfc Bank</span>, <span class="bajaj-finserv">Bajaj Finserv</span>, <span class="kotak">Kotak</span>, <span class="ing-vysya">Ing Vsaya,</span> <span class="fullerton">Fullerton</span>, <span class="pnb-bank">PNB</span>  <strong>and </strong><span class="Standard-Chart">Standard Chartered.</span></div>
  <div id="content">
        <form method="post"  name="loan_form"  action="PL_step2.php"  onSubmit="return chkpersonalloan();">
<input type="hidden" name="RequestID" id="RequestID" value="<?php echo $RequestID; ?>" />
<input type="hidden" name="ID" id="RequestID" value="<?php echo $ID; ?>" />
		  <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
		     <tr>
      <td height="35" colspan="2" class="heading_text_c" style="font-size:24px; border-bottom:thin solid #CCC;">Other Details</td>
    </tr>
			  <tr>
			    <td height="25" valign="middle" bgcolor="#FFFFFF" class="sbi_text_c">Date of Birth</td>
		      </tr>
			  <tr>
			    <td height="0" valign="middle" bgcolor="#FFFFFF" class="alert_msg" ><input name="day" type="text" class="sbi_input-b" id="day"  onkeypress="intOnly(this);" onKeyDown="validateDiv('dobVal');" onKeyUp="intOnly(this);" maxlength="2" />&nbsp;&nbsp;<input name="month" type="text" class="sbi_input-b" id="month" onKeyPress="intOnly(this);" onKeyDown="validateDiv('dobVal');" onKeyUp="intOnly(this);" maxlength="2" />&nbsp;&nbsp;<input name="year" type="text" class="sbi_input-b" id="year" onKeyPress="intOnly(this);" onKeyDown="validateDiv('dobVal');" onKeyUp="intOnly(this);" maxlength="4" /><br>
  <span class="hint">[DD-MM-YYYY].<span class="hint-pointer">&nbsp;</span></span>
      <div id="dobVal"></div></td>
		    </tr>
			  <tr>
			    <td height="35" valign="middle" bgcolor="#FFFFFF" class="sbi_text_c">Residential Status</td>
		      </tr>
			  <tr>
			    <td height="35" valign="middle" bgcolor="#FFFFFF" class="alert_msg"> <table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
			      <tr>
			        <td width="4%" ><input type="radio" style="border:none;" value="1" name="Residential_Status"  checked="checked" /></td>
			        <td width="21%" class="sbi_text_c"  > Owned</td>
			        <td width="4%" ><input type="radio" style="border:none;" value="2" name="Residential_Status" /></td>
			        <td width="21%" class="sbi_text_c"  > Rented</td>
			        <td width="4%" ><input type="radio" style="border:none;" value="3" name="Residential_Status" /></td>
			        <td width="46%" class="sbi_text_c"  > Company Provided</td>
		          </tr>
		        </table> 
          <div id="resiStatusVal"></div></td>
		    </tr>
			  <tr>
			    <td height="35" valign="middle" bgcolor="#FFFFFF" class="sbi_text_c">Pincode</td>
		      </tr>
			  <tr>
			    <td height="35" valign="middle" bgcolor="#FFFFFF" class="alert_msg" ><input name="Pincode" type="text" class="sbi_input" id="Pincode" onKeyPress="intOnly(this);"  onkeydown="validateDiv('pincodeVal');" onKeyUp="intOnly(this);" maxlength="6"  /> 
       <div id="pincodeVal"></div>  <div id="pincodeVal"></div></td>
		    </tr>
			  <tr>
			    <td height="35" valign="middle" bgcolor="#FFFFFF" class="sbi_text_c">Credit Card</td>
		      </tr>
			  <tr>
			    <td height="35" valign="middle" bgcolor="#FFFFFF" class="alert_msg"> <span style="color:#000000;">Yes</span>
       <input type="radio" name="CC_Holder" id="CC_Holder" value="1" onClick="return addIdentified();" style="border:none;" /> 
       &nbsp;&nbsp; <span style="color:#000000;">No</span>
       <input type="radio"  name="CC_Holder" id="CC_Holder" onClick="removeIdentified();" value="0" style="border:none;" checked="checked" />
           <div id="ccholderVal"></div></td>
		    </tr>
               <tr  class="text_bg"> 
         <td id="myDiv1" class="sbi_text_c"></td></tr><tr><td id="myDiv2"></td>
   </tr> 
			  <tr>
			    <td height="35" valign="middle" bgcolor="#FFFFFF" class="sbi_text_c">Primary Account in which bank?</td>
		    </tr>
			  <tr>
			    <td height="35" valign="middle" bgcolor="#FFFFFF" class="alert_msg"><input  name="Primary_Acc" class="sbi_input" id="Primary_Acc"   autocomplete="off" onKeyDown="validateDiv('priAccVal');" onKeyUp="ajax_showOptions(this,'getCountriesByLetters',event);" /><div id="priAccVal"></div> </td>
		    </tr>
			 
			  <tr>
			    <td height="35" valign="middle" bgcolor="#FFFFFF" class="sbi_text_c">Company Type</td>
		    </tr>
			  <tr>
			    <td height="35" valign="middle" bgcolor="#FFFFFF" class="alert_msg"><select name="Company_Type" class="sbi_input" id="Company_Type" onChange="validateDiv('compTypeVal');" >
      <option value="0">Please Select</option>
		  	<option value="1">Pvt Ltd</option>
			<option value="2">MNC Pvt Ltd</option>
			<option value="3">Limited</option>
			 <option value="4">Govt.( Central/State )</option>
		<option value="5">PSU (Public sector Undertaking)</option>
      </select><div id="compTypeVal"></div> </td>
		    </tr>
			  <tr>
			    <td height="35" valign="middle" bgcolor="#FFFFFF" class="sbi_text_c" >No. of years in present Company</td>
		    </tr>
			  <tr>
			    <td height="35" valign="middle" bgcolor="#FFFFFF" class="alert_msg" ><input name="Years_In_Company" type="text" class="sbi_input"   onkeypress="intOnly(this);" onKeyDown="validateDiv('yearsCompVal');" onKeyUp="intOnly(this);" maxlength="15" /><div id="yearsCompVal"></div></td>
		    </tr>
			  <tr>
			    <td height="35" valign="middle" bgcolor="#FFFFFF" ><span class="sbi_text_c">Total Experience (Years)/Total Years in Business</span></td>
		    </tr>
			  <tr>
			    <td height="35" valign="middle" bgcolor="#FFFFFF" class="alert_msg" ><input name="Total_Experience" type="text" class="sbi_input" id="Total_Experience"   onkeypress="intOnly(this);" onKeyDown="validateDiv('totalExpVal');" onKeyUp="intOnly(this);" /><div id="totalExpVal"></div></td>
		    </tr>
			 <!-- <tr>
			    <td height="35" valign="middle" bgcolor="#FFFFFF" class="sbi_text_c" >How do you get your Salary?</td>
		    </tr>
			  <tr>
			    <td height="35" valign="middle" bgcolor="#FFFFFF" class="alert_msg" ><select name="Salary_Drawn" class="sbi_input" id="Salary_Drawn"  onChange="validateDiv('salVal');" >
     <option value="">Please Select</option>
     <option value="1">By Cash</option>
     <option value="2">By Cheque</option>
     <option value="3">By Account Transfer</option>
      </select><div id="salVal"></div></td>
		    </tr>-->
			  <tr>
			    <td height="35" valign="middle" bgcolor="#FFFFFF" class="sbi_text_c" >Any Loan running?</td>
		    </tr>
			  <tr>
			    <td height="35" valign="middle" bgcolor="#FFFFFF" class="alert_msg" ><input type="radio" style="border:none;"  value="1"  name="LoanAny"  onclick="addElementLoan(); addDiv();" /> <span style="color:#000000;">Yes</span> &nbsp;  <input size="10" type="radio" style="border:none;" name="LoanAny"  onclick="removeElementLoan();" value="0"> <span style="color:#000000;">No</span>
        <div id="loanVal"></div> </td>
		    </tr>
              <tr  class="text_bg"> 
         <td id="myDivLoan1" class="sbi_text_c"></td></tr><tr><td id="myDivLoan2"></td>
   </tr>  
			
			  <tr>
			    <td height="0" align="center" valign="middle" bgcolor="#FFFFFF" ><input type="submit" style="border: 0px none ; background-image: url(images/sbi_get_quote_btn.png); width: 148px; height: 43px; margin-bottom: 0px;" value=""/></td>
		    </tr>
            <tr>
      <td height="45" colspan="2" align="left"  class="sbi_home_loan_text_c" style="font-weight:normal; font-size:11px; "><strong>Disclaimer: </strong>All loans are on sole discretion on the respective banks</td>
    </tr>
		  </table>
          </form>
		</div>
	
	
	
	<aside id="sidebar" style="width: 350px; !important">

		<section class="widget">
		 	  <div class="right-box-d">
			<h4 class="heading_text_b" style="font-size:13px; line-height:20px; font-weight:bold;"><span style="font-size:16px;">Offer1-</span> Personal loan offers from <span style="color:#0a8bd9; font-size:14px;">7 Banks</span> with<span style="color:#0a8bd9; font-size:14px;"> <br>
		    3 Banks</span> with No Prepayment charges<br>
			</h4>
            
            <div style="margin-top:5px; width:99%;">
              <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                  <td width="15%" height="28" align="center" bgcolor="#2f8497" class="white_text" style="border-right:thin #FFF solid;">Bank</td>
                  <td width="29%" height="28" align="center" bgcolor="#2f8497" class="white_text" style="border-right:thin #FFF solid;">Inerest Rate</td>
                  <td width="23%" height="28" align="center" bgcolor="#2f8497" class="white_text" style="border-right:thin #FFF solid;"> Emi</td>
                  <td width="33%" height="28" align="center" bgcolor="#2f8497" class="white_text" style="line-height:15px;">Prepayment<br>
Charges</td>
                </tr>
                <tr>
                  <td height="25" bgcolor="#f0f0f0"><strong class="bank_text">Bank A</strong></td>
                  <td height="25" align="center" bgcolor="#f0f0f0">13.99%</td>
                  <td height="25" align="center" bgcolor="#f0f0f0">Rs. 2,783</td>
                  <td height="25" align="center" bgcolor="#f0f0f0">4%</td>
                </tr>
                <tr>
                  <td height="25" class="bank_text"><strong>Bank B</strong></td>
                  <td height="25" align="center">14%</td>
                  <td height="25" align="center">Rs. 3,542</td>
                  <td height="25" align="center">5%</td>
                </tr>
                <tr>
                  <td height="25" bgcolor="#F0F0F0" class="bank_text"><strong>Bank C</strong></td>
                  <td height="25" align="center" bgcolor="#F0F0F0">14.5%</td>
                  <td height="25" align="center" bgcolor="#F0F0F0">Rs. 5,101</td>
                  <td height="25" align="center" bgcolor="#F0F0F0">0%</td>
                </tr>
                <tr>
                  <td height="25" bgcolor="#FFFFFF" class="bank_text"><strong>Bank D</strong></td>
                  <td height="25" align="center" bgcolor="#FFFFFF">17.5%</td>
                  <td height="25" align="center" bgcolor="#FFFFFF">Rs. 4,251</td>
                  <td height="25" align="center" bgcolor="#FFFFFF">0%</td>
                </tr>
              </table>
            </div>
            
	 	    </div>

<div class="right-box-d">
			<h4 class="heading_text_b" style="font-size:13px; line-height:20px; font-weight:bold;"><span style="font-size:16px;">Offer2-</span> Balance Transfer your Personal loan Offers from <span style="color:#0a8bd9; font-size:14px;">2 Banks </span>and reduce Emi<br>
		  </h4>
            
            <div style="margin-top:5px; width:99%;">
              <table width="98%" border="0" align="center" cellpadding="2" cellspacing="0">
                <tr>
                  <td width="15%" height="28" align="center" bgcolor="#2f8497" class="white_text" style="border-right:thin #FFF solid;">Bank</td>
                  <td width="29%" height="28" align="center" bgcolor="#2f8497" class="white_text" style="border-right:thin #FFF solid;">Existing Rate</td>
                  <td width="23%" height="28" align="center" bgcolor="#2f8497" class="white_text" style="border-right:thin #FFF solid;"> New Rate</td>
                  <td width="33%" height="28" align="center" bgcolor="#2f8497" class="white_text" style="line-height:15px;">New Bank EMI<br></td>
                </tr>
                <tr>
                  <td height="25" rowspan="2" bgcolor="#f0f0f0"><strong class="bank_text">Bank A</strong></td>
                  <td height="25" rowspan="2" align="center" bgcolor="#f0f0f0">15.5% </td>
                  <td height="25" rowspan="2" align="center" bgcolor="#f0f0f0">14%</td>
                  <td height="25" align="center" bgcolor="#f0f0f0">Rs. 13663</td>
                </tr>
                <tr>
                  <td height="25" align="center" bgcolor="#f0f0f0" style="line-height:15px;"><strong><span class="saving_text">Saving</span></strong><br>
                  Rs. 18192</td>
                </tr>
                <tr>
                  <td height="25" rowspan="2" class="bank_text"><strong>Bank B</strong></td>
                  <td height="25" rowspan="2" align="center">15.5% </td>
                  <td height="25" rowspan="2" align="center">13%</td>
                  <td height="12" align="center">Rs. 13413<br></td>
                </tr>
                <tr>
                  <td height="13" align="center"><strong><span class="saving_text">Saving</span></strong><br>
Rs. 30192</td>
                </tr>
              </table>
          </div>
	      </div>

<div class="sbi_text_bullet">
<h4 class="heading_text_b" style="font-size:13px;">Why Deal4loans.com - Widest Choice of Banks</h4>
<ul>
<li>Over <span style="color:#0a8bd9; font-size:14px;">42 lakh </span>customers have taken quote at Deal4loans.com</li>
<li>Personal Loan Quotes are <span style="color:#0a8bd9; font-size:14px;">free</span> for customers.</li>
<li>Deal4loans.com has tie ups with all personal loan Banks in India.</li>
<li>Your contact details will not be shared with any Banks, Unless you Apply after Quote in next stage.</li>
</ul>
 </div>
	</section>
	</aside>
	
</div>
</div>
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-1312775-1");
pageTracker._trackPageview();
} catch(err) {}</script>
</body>
</html>