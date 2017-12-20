<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	$Dated=ExactServerdate();
	
	$leadid="";
	$leadid = $_SESSION['Temp_LID'];
	$getpldetails="select Referrer,Annual_Turnover,Employment_Status,RequestID,Email,City,Net_Salary,source From Req_Loan_Personal Where (RequestID='".$leadid."')";
	list($CheckNumRows,$plrow)=Mainselectfunc($getpldetails,$array = array());
?>
<!DOCTYPE html>
<html>
<head>
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'>  
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<link href="lp-styles-bnr.css" rel="stylesheet" type="text/css">
<link href="lp-media-queries-bnr.css" rel="stylesheet" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Apply for Personal Loan | Personal Loans Online Apply India |Deal4Loans</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<meta name="keywords" content="Apply Personal Loans, personal loans apply, online personal loan apply, apply personal loan india">
<meta name="description" content="Apply Online Personal Loans through Deal4loans.com Get instant information on personal loans banks like Mumbai, Delhi, Noida, Kolkata, Gurgaon, Bangalore, Chennai, Hyderabad.">
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script type="text/javascript" src="scripts/mootools.js"></script>
 <script type="text/javascript" src="ajax.js"></script>
<script type="text/javascript" src="ajax-dynamic-pllist.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<style type="text/css">
		/* Big box with list of options */
	#ajax_listOfOptions{
		position:absolute;	/* Never change this one */
		width:280px;	/* Width of box */
		height:50px;	/* Height of box */
		overflow:auto;	/* Scrolling features */
		border:1px solid #317082;	/* Dark green border */
		background-color:#FFF;	/* White background color */
    color: black;
		text-align:left;
		font-size:0.9em;
		z-index:100;
	}
	#ajax_listOfOptions div{	/* General rule for both .optionDiv and .optionDivSelected */
		margin:1px;		
		padding:1px;
		cursor:pointer;
		font-size:0.9em;
	}
	#ajax_listOfOptions .optionDiv{	/* Div for each item in list */
		
	}
	#ajax_listOfOptions .optionDivSelected{ /* Selected item in the list */
		background-color:#2375CB;
		color:#FFF;
	}
	#ajax_listOfOptions_iframe{
		background-color:#F00;
		position:absolute;
		z-index:5;
	}
	
	form{
		display:inline;
	}
 
h3{
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size:11px;
	text-decoration:none;
	color:#660000;
	padding:0px;
	margin:0px 0px 0px 0px;
	text-align:left;
	cursor:pointer;
}

.faqContainer .toggler {
	padding:5px 0px 0px 15px;
	font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:11px;
	line-height:17px;
	font-weight:bold;
	text-align:justify;
	cursor:pointer;
}

.elementInside{
	border-bottom:1px dashed #6a290d;
	margin:0px 0px 4px 0px;
	padding:0px 0px 6px 0px; 
}
 

body {
	margin: 0px;
	padding:0px;	 
	font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:11px;
	color:#292323;
	}
	
	
input{
	margin:0px;
	padding:0px;
	border:1px solid #878787;
}

select{
	margin:0px;
	padding:0px;
	border:1px solid #878787;
}


.bldtxt{
font-weight:bold;
line-height:16px;
color:#4f4d4d;
}
  
  	/*--------------step2 css-----------------*/
 
/* extra div*/
.expandeddiv{
height:138px;
width:auto;
border-left:2px solid #5578C8;
border-right:2px solid #5578C8;
}
.addexpandeddiv{
height:150px;
width:auto;
border-left:2px solid #5578C8;
border-right:2px solid #5578C8;
}
.alert_msg{color:#FF0000; font-weight:bold; font-size:10px;}
input,select{border:1px solid #878787;margin:0;padding:0}
select:focus, input:focus
{
border:#FF0000 1px solid; 
}

</style>

<Script Language="JavaScript" Type="text/javascript">

function addDiv()
{
		var ni = document.getElementById('mynewDiv');
		
		if(ni.innerHTML=="")
		{
		
			if(document.personalloan_form.LoanAny.value="on")
			{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '<div id="expanddiv" class="expandeddiv" ></div>';
			
			}
		}
		
		return true;
	}


function addElementLoan()
{
	var ni1 = document.getElementById('myDivLoan1');
	var ni2 = document.getElementById('myDivLoan2');
	var ninw1 = document.getElementById('myDivLoan3');
	var ninw2 = document.getElementById('myDivLoan4');
	var ninw5 = document.getElementById('myDivLoan5');
	var ninw6 = document.getElementById('myDivLoan6');


	if(document.personalloan_form.emp_st.value==0)
	{
		ni1.innerHTML = 'Any type of loan(s) running?';
		ni2.innerHTML = '<table width="100%" border="0" align="left" cellpadding="0" cellspacing="0"><tr> <td    height="20" align="left" ><input type="checkbox" style="border:none;" id="Loan_Any" name="Loan_Any[]"  value="hl" /> Home</td><td align="left"><input type="checkbox" style="border:none;"  id="Loan_Any" name="Loan_Any[]" value="pl" /> Personal</td><td align="left">&nbsp;</td></tr><tr> <td   height="20" align="left" ><input type="checkbox" style="border:none;"  name="Loan_Any[]"  id="Loan_Any" value="cl" /> Car</td><td  align="left"  ><input type="checkbox" style="border:none;" name="Loan_Any[]" id="Loan_Any"  value="lap" /> Property</td><td align="left"  ><input type="checkbox" style="border:none;" name="Loan_Any[]" id="Loan_Any"  value="other" /> Other</td></tr></table><div id="typeloanVal"></div>';
		ninw1.innerHTML='How many EMI paid?';
		ninw2.innerHTML='<select name="EMI_Paid" onChange="validateDiv(\'emiVal\');" tabindex="12" class="select_input" > <option value="0">Please select</option><option value="1">Less than 6 months</option> <option value="2">6 to 9 months</option> <option value="3">9 to 12 months</option> <option value="4">more than 12 months</option ></select><div id="emiVal" class="alert_msg"></div>';
	}
	else
	{	
		ni1.innerHTML = 'How many EMI paid?';
		ni2.innerHTML = '<select name="EMI_Paid" onChange="validateDiv(\'emiVal\');" tabindex="12" class="select_input" > <option value="0">Please select</option><option value="1">Less than 6 months</option> <option value="2">6 to 9 months</option> <option value="3">9 to 12 months</option> <option value="4">more than 12 months</option ></select><div id="emiVal" class="alert_msg"></div>';

	ninw1.innerHTML='';
	ninw2.innerHTML='';	
	}

	if(document.personalloan_form.salary_chk.value<=239000)
	{
		ninw5.innerHTML = 'Any Loan running with Fullerton India?';
		ninw6.innerHTML = '<input type="radio" style="border:none;"  value="1"  name="fullerton_loan"  /> Yes &nbsp;  <input size="10" type="radio" style="border:none;" name="fullerton_loan"  value="0"> No';
	}

	
	return true;
}

function removeElementLoan()
{
	var ni = document.getElementById('myDiv');
	var niln1 = document.getElementById('myDivLoan1');
	var niln2 = document.getElementById('myDivLoan2');
	var ninw1 = document.getElementById('myDivLoan3');
	var ninw2 = document.getElementById('myDivLoan4');
	var ninw5 = document.getElementById('myDivLoan5');
	var ninw6 = document.getElementById('myDivLoan6');

	var cty = document.getElementById('City').value;
	var ni2 = document.getElementById('myDivcc2');
	niln1.innerHTML='';	
	niln2.innerHTML='';	
	if(cty=="Delhi" || cty=="Mumbai" || cty=="Chennai" || cty=="Kolkata" || cty=="Bangalore" || cty=="Hyderabad" || cty=="Pune" || cty=="Noida" || cty=="Gurgaon" || cty=="Gaziabad" || cty=="Faridabad" || cty=="Thane" || cty=="Navi Mumbai")
	{
		if(ni2.innerHTML=="")
		{
		
			ninw1.innerHTML = 'Did you had any Credit Card or Loan in last 12 months ?';
			ninw2.innerHTML = '<input type="radio" style="border:none;"  value="1"  name="is_permit" id="is_permit"/> Yes &nbsp;  <input size="10" type="radio" style="border:none;" name="is_permit" value="2" id="is_permit"> No';
		}
							
	}
	else
	{
		niln1.innerHTML = '';
		niln2.innerHTML = '';			
		ninw1.innerHTML = '';
		ninw2.innerHTML = '';
		ninw5.innerHTML = '';
		ninw6.innerHTML = '';
	}
		
		return true;

	}


function addElement()
{		
	var ni1 = document.getElementById('myDivcc1');
	var ni2 = document.getElementById('myDivcc2');
	//alert("fdsfs");
	
		ni1.innerHTML = 'Card held since?';
		ni2.innerHTML = '<select name="Card_Vintage" onChange="validateDiv(\'vintageVal\');" tabindex="14" class="select_input" ><option value="0">Please select</option> <option value="1">Less than 6 months</option> <option value="2">6 to 9 months</option> <option value="3">9 to 12 months</option><option value="4">more than 12 months</option> </select><div id="vintageVal" class="alert_msg"></div>';
	
	return true;
}

function removeElement()
{
	var ni1 = document.getElementById('myDivcc1');
	var ni2 = document.getElementById('myDivcc2');
	ni1.innerHTML = '';
	ni2.innerHTML = '';
		return true;
}
function submitform(Form)
	{

var btn2;
	var btn3;
	var myOption;
	var i;
	var incpf;
	var myOption1;
	var j;
	
if((Form.Company_Name.value=="") || (Form.Company_Name.value=="Company Name"))
{
//alert("Kindly fill in your Company Name!");
document.getElementById('companyVal').innerHTML = "<span  class='hintanchor'>Enter Company Name!</span>";
Form.Company_Name.focus();
return false;
}
else if(Form.Company_Name.value.length < 3)
{
document.getElementById('companyVal').innerHTML = "<span  class='hintanchor'>Enter Company Name!</span>";
Form.Company_Name.focus();
return false;
}

 if((Form.Loan_Amount.value==''))
{
//alert("Kindly fill in your Loan Amount (Numeric Only)!");
	document.getElementById('loanVal').innerHTML = "<span  class='hintanchor'>Enter Loan Amount!</span>";
	Form.Loan_Amount.focus();
	return false;
}
if(Form.Primary_Acc.selectedIndex==0)
{
//	alert("Please fill your Salary Account.");
	document.getElementById('priAccVal').innerHTML = "<span  class='hintanchor'>Fill your Salary Account!</span>";
	Form.Primary_Acc.focus();
	return false;
}
  <? if($plrow["Employment_Status"]==0)
				  { ?>
	  if(Form.Annual_Turnover.selectedIndex==0)
{
//	alert("Please enter Residential Status to Continue");
	document.getElementById('annulturnVal').innerHTML = "<span  class='hintanchor'>Fill Annual Turnover!</span>";
	Form.Annual_Turnover.focus();
	return false;
}
<?
				  }
				  else 
				  { ?>
if(Form.Residential_Status.selectedIndex==0)
{
//	alert("Please enter Residential Status to Continue");
	document.getElementById('resiStatusVal').innerHTML = "<span  class='hintanchor'>Fill Residential Status!</span>";
	Form.Residential_Status.focus();
	return false;
}
if(Form.Company_Type.selectedIndex==0)
{
	//alert("Please enter Company Type to Continue");
	document.getElementById('compTypeVal').innerHTML = "<span  class='hintanchor'>Fill Company Type!</span>";
	Form.Company_Type.focus();
	return false;
}
<?php } ?>
	if (Form.Years_In_Company.value=="")
	{
//		alert("Please enter Years in Company.");
		document.getElementById('yearsCompVal').innerHTML = "<span  class='hintanchor'>Fill Years in Company!</span>";
		Form.Years_In_Company.focus();
		return false;

	}	
	if (Form.Total_Experience.value=="")
	{
		//alert("Please enter Total Experience.");
		document.getElementById('totalExpVal').innerHTML = "<span  class='hintanchor'>Fill Total Experience!</span>";
		Form.Total_Experience.focus();
		return false;
	}
	<? if($plrow['Employment_Status']==0) 
		   { }
		   else
		   {  ?>
	if(Form.Salary_Drawn.selectedIndex==0)
	{
		alert("Please enter How do you get your salary to Continue");
		Form.Salary_Drawn.focus();
		return false;
	}
<?php } ?>


myOption1 = -1;
		for (j=Form.CC_Holder.length-1; j > -1; j--) {
			if(Form.CC_Holder[j].checked) {
				if(j==0)
				{
				if (Form.Card_Vintage.selectedIndex==0)
				{
					//alert("Please select since how long you holding credit card");
					document.getElementById('vintageVal').innerHTML = "<span  class='hintanchor'>Holding Credit Card Since!</span>";
					Form.Card_Vintage.focus();
					return false;
				}

				}
					myOption1 = j;
	
			}
		}
	
		if (myOption1 == -1) 
		{
			alert("Please select you are credit card holder or not");
			return false;
		}


	myOption = -1;
		for (i=Form.LoanAny.length-1; i > -1; i--) {
			if (Form.LoanAny[i].checked) {
				if(i==0)
				{
					if(Form.EMI_Paid.selectedIndex==0)
					{
						//alert('No of EMI paid.');
						document.getElementById('emiVal').innerHTML = "<span  class='hintanchor'>No of EMI paid.!</span>";
						Form.EMI_Paid.focus();
						return false;
					}
				}
				myOption = i;
			}
		}
		if(myOption == -1) 
		{
//			alert("You must select a Loan Any button");
			document.getElementById('loanVal').innerHTML = "<span  class='hintanchor'>You must select a Loan Any button!</span>";
			return false;
		}
		
return true;
}
function valButtonLoan() {
    var cnt = -1;
	var i;
    for(i=0; i<document.personalloan_form.LoanAny.length; i++) 
	{
        if(document.personalloan_form.LoanAny[i].checked)
		{
			cnt=i;
			
		}
    }
    if(cnt > -1)
	{ 
		return true;
	}
    else
	{
		return false;
	}
}

</script>

</head>

<body>
<div id="pagewrap">
<header id="header_continue">
<div id="continue_logo"><img src="new-images/pl/deal4loans-continue-logo.jpg"></div></header>
<div style="clear:both;"></div>
<div class="pl_cont_text">60% of your application for quote from all Banks is complete.</div>
<div class="ajax_loader_box"><img src="new-images/hl/ajax-loader.gif"></div>
<div class="pl_cont_text" style="color:#136071;">Share few more details to get exact quote on Emi,Rates &amp; Loan Amount.</div>
  <div id="continue_form" style="margin-top:10px;">
<? 	if($plrow["Net_Salary"]<=239000 && ($plrow["City"]!="Delhi" && $plrow["City"]!="Noida" && $plrow["City"]!="Faridabad" && $plrow["City"]!="Gurgaon" && $plrow["City"]!="Gaziabad"))
	{
		?>
<form name="personalloan_form"  action="insert_personal_loan_bnrless.php" method="POST" onsubmit="return submitform(document.personalloan_form); ">
<? }
else {
	 ?>
<form name="personalloan_form"  action="insert_personal_loan_bnr.php" method="POST" onSubmit="return submitform(document.personalloan_form); ">
<? }
?>

	<input type="hidden" value="<? echo $_SESSION['Temp_LID'];?>" name="leadid" />
	
	<input type="hidden" value="<? echo $plrow["City"];?>" name="City" id="City" />
	<input type="hidden" value="<? echo $plrow["Net_Salary"];?>" name="salary_chk" id="salary_chk" />
    
    	<input type="hidden" value="<? echo $plrow["Employment_Status"];?>" name="emp_st" id="emp_st" />
    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td height="35" colspan="2" align="center" bgcolor="#f4f4f4" class="form_text_pl" style="font-size:13px;">Personal Loan Quote Request</td>
      </tr>
      <tr>
        <td width="41%" height="30" class="form_text_pl">Company Name</td>
        <td>
        <input name="Company_Name" id="Company_Name" type="text" onKeyUp="ajax_showOptions(this,'getCountriesByLetters',event)" class="input_box"  autocomplete="off" onKeyDown="validateDiv('companyVal');" tabindex="1" />
        <div id="companyVal" class="alert_msg"></div>  </td>
      </tr>
        <tr>
    <td height="28" class="form_text_pl">Loan Amount</td>
    <td class="alert_msg">
    <input name="Loan_Amount" id="Loan_Amount" type="text" class="input_box" onChange="getDigitToWords('Loan_Amount','formatedlA','wordloanAmount'); intOnly(this);"  onKeyUp="intOnly(this);getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');"  onKeyDown="getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" onKeyPress="intOnly(this); getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" onBlur="getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" tabindex="2">
    <div id="loanVal"></div></td>
  </tr>
<tr>
	  <td colspan="2" align="left">  <span id='formatedlA' style='font-size:11px; font-weight:bold;color:666699;font-Family:Verdana; '></span><span id='wordloanAmount' style='font-size:11px; font-weight:bold;color:666699;font-Family:Verdana;text-transform: capitalize; margin-left:10px; margin-bottom:5px;'></span></td>
</tr>


      <tr>
        <td width="41%" height="30" class="frmbldtxt"><strong>Primary Account in which bank?</strong></td>
        <td>
        <? $cmp_nme="select Bank_Name from Bank_Master"; 
			  list($cmp_nmerecordcount,$cmp_nmerow)=Mainselectfunc($cmp_nme,$array = array());
			  //$cmp_nmerecordcount = mysql_num_rows($cmp_nme);
			  
			  if($cmp_nmerecordcount>1)
			  {
				  ?>
		    <select name="Primary_Acc" id="Primary_Acc" class="select_input" onChange="validateDiv('priAccVal');" tabindex="3" >
				  <option value="">Please Select</option>
			  <? while($cmp_nmerow=mysql_fetch_array($cmp_nme))
		{ ?>
			<option value="<? echo $cmp_nmerow["Bank_Name"]; ?>"><? echo $cmp_nmerow["Bank_Name"]; ?> </option>
		<? } ?> </select> 
		    <? } ?>
          <div id="priAccVal" class="alert_msg"></div>  </td>
      </tr>
        <? if($plrow["Employment_Status"]==0)
				  { 
			
				   ?>
<tr>
        <td height="30" class="frmbldtxt"><strong>Annual Turnover</strong></td>
        <td><select name="Annual_Turnover" class="select_input" id="Annual_Turnover"  tabindex="4" >
 <option value=''>Please Select</option>	
<option value='1' <? if($plrow["Annual_Turnover"]==1) { echo "selected";}?> > 0 - 40 Lacs</option>
			 <option value='4' <? if($plrow["Annual_Turnover"]==4) { echo "selected";}?>> 40 Lacs - 1 Cr</option>	
			 <option value='2' <? if($plrow["Annual_Turnover"]==2) { echo "selected";}?> > 1Cr - 3Crs </option>	<option value='3' <? if($plrow["Annual_Turnover"]==3) { echo "selected";}?>>3Crs & above</option>
	    </select>
        <div id="annulturnVal"></div></td>
      </tr>
			   <?
				  }
				  else 
				  { ?>
      <tr>
        <td height="30" class="frmbldtxt"><strong>Residential Status</strong></td>
        <td valign="middle"><select name="Residential_Status" class="select_input" id="Residential_Status" onChange="validateDiv('resiStatusVal');" tabindex="4">
		  <option value="0">Please Select</option>
		  	<option value="4">Owned By Self/Spouse</option>
			<option value="1">Owned By Parent/Sibling</option>
			<option value="3">Company Provided</option>
			<option value="5">Rented - With Family</option>
			<option value="6">Rented - With Friends</option>
			<option value="2">Rented - Staying Alone</option>
			<option value="7">Paying Guest</option>
			<option value="8">Hostel</option>
			</select>
        <div id="resiStatusVal"></div></td>
      </tr>
      <tr>
        <td height="30" class="frmbldtxt"><strong>Company Type</strong></td>
        <td height="30"><select name="Company_Type" class="select_input" id="Company_Type" onChange="validateDiv('compTypeVal');" tabindex="5" >
		  <option value="0">Please Select</option>
		  	<option value="1">Pvt Ltd</option>
			<option value="2">MNC Pvt Ltd</option>
			<option value="3">Limited</option>
			 <option value="4">Govt.( Central/State )</option>
		<option value="5">PSU (Public sector Undertaking)</option>
			</select>
        <div id="compTypeVal"></div></td>
      </tr>
  <?php 
  }
  ?>
      <tr>
        <td height="30" class="frmbldtxt"><b><? if($plrow['Employment_Status']==0) 
		   { echo "Current Business Stability (in Years)"; } else { echo "No. of years in this Company"; } ?></b></td>
        <td><input name="Years_In_Company" type="text" class="input_box"  maxlength="15" tabindex="6" onKeyDown="validateDiv('yearsCompVal');">
        <div id="yearsCompVal"></div></td>
      </tr>
      <tr>
        <td height="30" class="frmbldtxt"><strong>Total Experience (Years)/ Total Years in Business</strong></td>
        <td><input name="Total_Experience" class="input_box" onFocus="this.select();" tabindex="7" onKeyDown="validateDiv('totalExpVal');" onKeyUp="intOnly(this);" />
        <div id="totalExpVal"></div>  </td>
      </tr>
      	<? if($plrow['Employment_Status']==0) 
		   { 
			 		   }
		   else
		   {  ?>
      <tr>
        <td height="30" class="frmbldtxt"><strong>How do you get your Salary?</strong></td>
        <td><select name="Salary_Drawn" class="select_input" id="Salary_Drawn" onChange="validateDiv('salVal');" tabindex="8" >
			  <option value="">Please Select</option>
<option value="1">By Cash</option>
<option value="2">By Cheque</option>
<option value="3">By Account Transfer</option>
	    </select>
        <div id="salVal"></div></td>
      </tr>
      <?php } ?>
          <tr>
    <td height="28" class="form_text_pl"><strong>Are you a Credit card holder?</strong></td>
    <td  class="form_text_pl" style="font-weight:normal;"><input type="radio"  name="CC_Holder" id="CC_Holder" value="1"  style="border:none;" tabindex="12" onClick="addElement(); validateDiv('ccholderVal');" > Yes &nbsp;<input type="radio"  name="CC_Holder" id="CC_Holder" style="border:none;" value="0" tabindex="13" onClick="removeElement(); validateDiv('ccholderVal'); "> No  <div id="ccholderVal" class="alert_msg" ></div> </td>
  </tr>
	<tr align="left"> <td id="myDivcc1" class="form_text_pl" style="font-weight:bold;" ></td>	<td id="myDivcc2"></td>	  </tr>
      <tr>
        <td height="30" class="frmbldtxt"><strong>Any Loan running?</strong></td>
        <td class="frmbldtxt" style="font-weight:normal;"><input type="radio" value="1"  name="LoanAny" tabindex="9"  onclick="addElementLoan(); addDiv(); validateDiv('loanVal');" /> Yes &nbsp;<input size="10" type="radio" name="LoanAny"  onclick="removeElementLoan(); validateDiv('loanVal');" value="0" tabindex="10"> No  <div id="loanVal"></div></td>
      </tr>
       <tr>
             <td id="myDivLoan1" bgcolor="#f4f4f4" class="form_text_pl"></td>
       
              <td colspan="6" bgcolor="#f4f4f4" id="myDivLoan2"></td>
            </tr>
       <tr>
             <td id="myDivLoan3" class="form_text_pl"></td>
       
              <td colspan="6" id="myDivLoan4"></td>
            </tr>    
	<tr>
             <td id="myDivLoan5" class="form_text_pl"></td>
       
              <td colspan="6" id="myDivLoan6"></td>
            </tr>    
         
         
  <tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td colspan="2" align="center"><input type="image" name="Submit" src="new-images/pl/quote.gif" style="width:115px; height:29px; border:none;" tabindex="15"></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table>
    </form>
  </div>
</div>
<? if((strncmp("Cloverads", $plrow["source"],9))==0)
{ ?>
<!-- Offer Conversion: Deal4loans - CPL -->
<img src="http://cloveads.go2cloud.org/SL6j" width="1" height="1" />
<!-- // End Offer Conversion -->
<? } 
elseif((strncmp("Adwinks", $plrow["source"],7))==0)
{ ?>
<div id='m3_tracker_272' style='position: absolute; left: 0px; top: 0px; visibility: hidden;'><img src='http://ads.ibibo.com/ad/www/delivery/ti.php?trackerid=272&amp;Email_Id=<? echo $plrow["Email"]; ?>&amp;cb=%%RANDOM_NUMBER%%' width='0' height='0' alt='' /></div>

<? }
elseif((strncmp("Clovenetwork", $plrow["source"],7))==0)
{ ?>
<!-- Advertiser 'Interactiveavenues.com - IN',  Conversion tracking 'Dec 11 Deal4Loans Conversion pixel' - DO NOT MODIFY THIS PIXEL IN ANY WAY -->
<script src="http://ad.clovenetwork.com/pixel?id=1609735&t=1" type="text/javascript"></script>
<!-- End of conversion tag -->
<? } 
elseif((strncmp("admagnet", $plrow["source"],8))==0)
{ ?>
	<script type='text/javascript'><!--//<![CDATA[

    var OA_p=location.protocol=='https:'?'https:':'http:';
    var OA_r=Math.floor(Math.random()*999999);
    document.write ("<" + "script language='JavaScript' ");
    document.write ("type='text/javascript' src='"+OA_p);
    document.write ("//n.admagnet.net/panda/www/delivery/tjs.php");
    document.write ("?trackerid=10&amp;r="+OA_r+"'><" + "/script>");
//]]>--></script><noscript><div id='m3_tracker_10' style='position: absolute; left: 0px; top: 0px; visibility: hidden;'><img src='http://n.admagnet.net/panda/www/delivery/ti.php?trackerid=10&amp;adid=&amp;sname=%%SNAME_VALUE%%&amp;Order_ID=%%ORDER_ID_VALUE%%&amp;OrderID=%%ORDERID_VALUE%%&amp;Quantity=%%QUANTITY_VALUE%%&amp;Value=%%VALUE_VALUE%%&amp;Transactionid=%%TRANSACTIONID_VALUE%%&amp;cb=%%RANDOM_NUMBER%%' width='0' height='0' alt='' /></div></noscript>
<? }
elseif((strncmp("Adchakra", $plrow["source"],8))==0)
{ ?>
 <!-- Begin ZEDO -->
<SCRIPT LANGUAGE="JavaScript" src="http://c1.zedo.com/up/1287/414933/n.js">
</script>
<!-- End ZEDO -->
<? }
elseif(((strncmp("ozonemedia", $plrow["source"],10))==0) && ($plrow["Net_Salary"]>=360000))
{ ?>
<!-- Advertiser 'Deals4Loans',  Conversion tracking 'Deals4Loans_Pixel' - DO NOT MODIFY THIS PIXEL IN ANY WAY -->
<script src="http://ad.yieldmanager.com/pixel?id=1630881&t=1" type="text/javascript"></script>
<!-- End of conversion tag -->
<? }
elseif((strncmp("clove_network", $plrow["source"],13))==0)
{ ?>
<!-- Advertiser 'Deal 4 Loans - IN',  Conversion tracking 'Jan 12 Deal4 loan PL conversion Pixel' - DO NOT MODIFY THIS PIXEL IN ANY WAY -->
<script src="http://ad.clovenetwork.com/pixel?id=1634915&t=1" type="text/javascript"></script>
<!-- End of conversion tag -->
<? }
elseif((strncmp("tyroo", $plrow["source"],5))==0 && ($plrow["Net_Salary"]>=360000) && ( $plrow["City"]=="Ahmedabad" || $plrow["City"]=="Kolkata" || $plrow["City"]=="Jaipur" || $plrow["City"]=="Chandigarh" || $plrow["City"]=="Lucknow" || $plrow["City"]=="Jalandhar" || $plrow["City"]=="Cochin" || $plrow["City"]=="Nagpur" || $plrow["City"]=="Delhi" || $plrow["City"]=="Noida" || $plrow["City"]=="Gurgaon" || $plrow["City"]=="Mumbai" || $plrow["City"]=="Thane" || $plrow["City"]=="Bangalore" || $plrow["City"]=="Chennai" || $plrow["City"]=="Hyderabad" || $plrow["City"]=="Pune" || $plrow["City"]=="Surat" || $plrow["City"]=="Coimbatore" || $plrow["City"]=="Gaziabad"))
{ ?>
<script src="http://affiliates.tyroodr.com/lead_third/304/<? echo $plrow["City"]; ?>,<? echo $leadid; ?>"></script>
<noscript><img src="http://affiliates.tyroodr.com/track_lead/304/<? echo $plrow["City"]; ?>,<? echo $leadid; ?>"></noscript>
<? } 
elseif($plrow["source"]=="komlipl" && ($plrow["Net_Salary"]>=360000) && ( $plrow["City"]=="Ahmedabad" || $plrow["City"]=="Kolkata" || $plrow["City"]=="Jaipur" || $plrow["City"]=="Chandigarh" || $plrow["City"]=="Lucknow" || $plrow["City"]=="Jalandhar" || $plrow["City"]=="Cochin" || $plrow["City"]=="Nagpur" || $plrow["City"]=="Delhi" || $plrow["City"]=="Noida" || $plrow["City"]=="Gurgaon" || $plrow["City"]=="Mumbai" || $plrow["City"]=="Thane" || $plrow["City"]=="Bangalore" || $plrow["City"]=="Chennai" || $plrow["City"]=="Hyderabad" || $plrow["City"]=="Pune" || $plrow["City"]=="Surat" || $plrow["City"]=="Coimbatore" || $plrow["City"]=="Gaziabad" ) && $plrow["City"]!="Others" && $plrow["City"]!="" && $plrow["City_Other"]=="")
{ $uniqueid=$leadid."pl";

$getplnwdetails="select City,Net_Salary From Req_Loan_Personal Where (RequestID='".$plrow["RequestID"]."')";
list($CheckNumRows,$plnrow)=Mainselectfunc($getplnwdetails,$array = array());


	if($plnrow["City"]!="Others" && $plnrow["City"]!="" && $plnrow["Net_Salary"]>=360000)
	{
?>
	<script src="http://partners.komli.com/lead_third/10067/mobileno,<? echo $plrow['Email']; ?>,<? echo $plrow['City']; ?>,<? echo $uniqueid; ?>"></script>
<noscript><img src="http://partners.komli.com/track_lead/10067/mobileno,<? echo $plrow['Email']; ?>,<? echo $plrow['City']; ?>,<? echo $uniqueid; ?>"></noscript>
<script type="text/javascript" src="http://trk.atomex.net/cgi-bin/tracker.fcgi/conv?px=9430&ty=1"></script>
<? 
	//for komli
//$insrtkomli="INSERT INTO komli_plcompaign (komli_uniqueid, komli_email, komli_city, komli_date, komli_netsalary, vendor_name) VALUES ('".$uniqueid."', '".$plrow['Email']."', '".$plrow['City']."', NOW(),'".$plnrow["Net_Salary"]."','komli')";
//$insrtkomliresult2=ExecQuery($insrtkomli);

$insrtkomli=array("komli_uniqueid"=>$uniqueid, "komli_email"=>$plrow['Email'], "komli_city"=>$plrow['City'], "komli_date"=>$Dated, "komli_netsalary"=>$plnrow["Net_Salary"], "vendor_name"=>'komli');
$insrtkomliresult2 = Maininsertfunc("komli_plcompaign", $insrtkomli);


	}
}
elseif($plrow["source"]=="nexzenpropl" && ($plrow["Net_Salary"]>=360000) && ( $plrow["City"]=="Ahmedabad" || $plrow["City"]=="Kolkata" || $plrow["City"]=="Jaipur" || $plrow["City"]=="Chandigarh" || $plrow["City"]=="Lucknow" || $plrow["City"]=="Jalandhar" || $plrow["City"]=="Cochin" || $plrow["City"]=="Nagpur" || $plrow["City"]=="Delhi" || $plrow["City"]=="Noida" || $plrow["City"]=="Gurgaon" || $plrow["City"]=="Mumbai" || $plrow["City"]=="Thane" || $plrow["City"]=="Bangalore" || $plrow["City"]=="Chennai" || $plrow["City"]=="Hyderabad" || $plrow["City"]=="Pune" || $plrow["City"]=="Surat" || $plrow["City"]=="Coimbatore" || $plrow["City"]=="Gaziabad"))
{ ?>
<!-- Offer Conversion: Deals For Loan -->
<iframe src="http://nexzenpro.go2cloud.org/SL52" scrolling="no" frameborder="0" width="1" height="1"></iframe>
<!-- // End Offer Conversion -->

<? } 
elseif($plrow["source"]=="icubespl" && ($plrow["Net_Salary"]>=360000) && ( $plrow["City"]=="Ahmedabad" || $plrow["City"]=="Kolkata" || $plrow["City"]=="Jaipur" || $plrow["City"]=="Chandigarh" || $plrow["City"]=="Lucknow" || $plrow["City"]=="Jalandhar" || $plrow["City"]=="Cochin" || $plrow["City"]=="Nagpur" || $plrow["City"]=="Delhi" || $plrow["City"]=="Noida" || $plrow["City"]=="Gurgaon" || $plrow["City"]=="Mumbai" || $plrow["City"]=="Thane" || $plrow["City"]=="Bangalore" || $plrow["City"]=="Chennai" || $plrow["City"]=="Hyderabad" || $plrow["City"]=="Pune" || $plrow["City"]=="Surat" || $plrow["City"]=="Coimbatore" || $plrow["City"]=="Gaziabad"))
{  $uniqueid=$leadid."pl"; ?>
<script src="http://affiliates.icubeswire.com/lead_third/227/<? echo $uniqueid; ?>"></script>
<noscript><img src="http://affiliates.icubeswire.com/track_lead/227/<? echo $uniqueid; ?>"></noscript>
<? }
elseif((strncmp("ibibopl", $plrow["source"],7))==0 && ($plrow["Net_Salary"]>=360000) && ( $plrow["City"]=="Ahmedabad" || $plrow["City"]=="Lucknow" || $plrow["City"]=="Delhi" || $plrow["City"]=="Thane" || $plrow["City"]=="Pune" || $plrow["City"]=="Kolkata" || $plrow["City"]=="Jalandhar" || $plrow["City"]=="Noida" || $plrow["City"]=="Bangalore" || $plrow["City"]=="Surat" || $plrow["City"]=="Jaipur" || $plrow["City"]=="Cochin" || $plrow["City"]=="Gurgaon" || $plrow["City"]=="Chennai" || $plrow["City"]=="Coimbatore" || $plrow["City"]=="Chandigarh" || $plrow["City"]=="Nagpur" || $plrow["City"]=="Mumbai" || $plrow["City"]=="Hyderabad" || $plrow["City"]=="Gaziabad"))
{ ?>
<script type='text/javascript'><!--//<![CDATA[

    var Email_Id = '<? echo $plrow["Email"]; ?>';

//]]>--></script>

 <script type='text/javascript'><!--//<![CDATA[

    var OA_p = (location.protocol=='https:'?'https://ads.ibibo.com/ad/www/delivery/tjs.php':'http://ads.ibibo.com/ad/www/delivery/tjs.php');

 

    var OA_r=Math.floor(Math.random()*999999);

    document.write ("<" + "script language='JavaScript' ");

    document.write ("type='text/javascript' src='"+OA_p);

    document.write ("?trackerid=272&amp;append=0&amp;r="+OA_r+"'><" + "\/script>");

//]]>--></script><noscript><div id='m3_tracker_272' style='position: absolute; left: 0px; top: 0px; visibility: hidden;'><img src='http://ads.ibibo.com/ad/www/delivery/ti.php?trackerid=272&amp;Email_Id=<? echo $plrow['Email']; ?>&amp;cb=%%RANDOM_NUMBER%%' width='0' height='0' alt='' /></div></noscript>

<? } 
else
{
?>

<? } ?>

</body>
</html>