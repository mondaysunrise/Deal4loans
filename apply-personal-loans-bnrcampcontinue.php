<?php
require 'scripts/session_check.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';

$plrequestid= $_REQUEST["plrequestid"];
$reference_code= $_REQUEST["reference_code"];
$activation_code= $_REQUEST["activation_code"];
$Employment_Status = $_REQUEST["Employment_Status"];
$pubid = $_REQUEST['pubid']; // used by ad2click only 19 nov2016
$City = $_REQUEST["City"];

function DetermineAgeGETDOB ($YYYYMMDD_In)
{
  $yIn=substr($YYYYMMDD_In, 0, 4);  $mIn=substr($YYYYMMDD_In, 4, 2);  $dIn=substr($YYYYMMDD_In, 6, 2);  $ddiff = date("d") - $dIn;  $mdiff = date("m") - $mIn;  $ydiff = date("Y") - $yIn;
   if ($mdiff < 0)  {
      $ydiff--;
  } elseif ($mdiff==0)
  {   if ($ddiff < 0)
    {         $ydiff--;    }
  }
  return $ydiff;
  }

if($reference_code == $activation_code)
{
	$Is_Valid =1;
}
else
{
	$Is_Valid =0;
}

$updateArray = array('Is_Valid'=>$Is_Valid);
$wherecondition = "(RequestID='".$plrequestid."')";
Mainupdatefunc ('Req_Loan_Personal', $updateArray, $wherecondition);

$getselpldetails="select Card_Vintage,CC_Holder,Company_Name,Loan_Amount,Email,City,Net_Salary,source,DOB From Req_Loan_Personal Where (RequestID='".$plrequestid."')";
list($alreadyExist,$plrow)=MainselectfuncNew($getselpldetails,$array = array());
$plrowcontr=count($plrow)-1;
$DOB=$plrow[$plrowcontr]["DOB"];
$getDOB = str_replace("-","", $DOB);
	$age = DetermineAgeGETDOB($getDOB);
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
	#ajax_listOfOptions div{	/* General rule for both .optionDiv and .optionDivSelected */	margin:1px;		
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

	if(document.personalloan_form.emp_st.value==0)
	{
		ni1.innerHTML = 'Any type of loan(s) running?';
		ni2.innerHTML = '<table width="100%" border="0" align="left" cellpadding="0" cellspacing="0"><tr> <td    height="20" align="left" ><input type="checkbox" style="border:none;" id="Loan_Any" name="Loan_Any[]"  value="hl" /> Home</td><td align="left"><input type="checkbox" style="border:none;"  id="Loan_Any" name="Loan_Any[]" value="pl" /> Personal</td><td align="left"><input type="checkbox" style="border:none;" name="Loan_Any[]" id="Loan_Any"  value="cdl" /> Consumer Durable</td></tr><tr> <td   height="20" align="left" ><input type="checkbox" style="border:none;"  name="Loan_Any[]"  id="Loan_Any" value="cl" /> Car</td><td  align="left"  ><input type="checkbox" style="border:none;" name="Loan_Any[]" id="Loan_Any"  value="lap" /> Property</td><td align="left"  ><input type="checkbox" style="border:none;" name="Loan_Any[]" id="Loan_Any"  value="other" /> Other</td></tr></table><div id="typeloanVal"></div>';
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
return true;
}

function removeElementLoan()
{
	var ni = document.getElementById('myDiv');
	var niln1 = document.getElementById('myDivLoan1');
	var niln2 = document.getElementById('myDivLoan2');
	var ninw1 = document.getElementById('myDivLoan3');
	var ninw2 = document.getElementById('myDivLoan4');
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
	}
		return true;
	}
function blockSpecialChar(e) {
                e = e || event;
                return /^[a-zA-Z0-9-#'(),. ]+$/.test(
                        String.fromCharCode(e.charCode || e.keyCode)
                        );
            }

            function blockAllSpecialChar(e) {
                e = e || event;
                return /[a-z0-9]/i.test(
                        String.fromCharCode(e.charCode || e.keyCode)
                        ) || !e.charCode && e.keyCode < 48;
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
 if (Form.Residence_Address.value == "")
                {
                    alert('Please enter residence Address');
                    Form.Residence_Address.focus();
                    return false;
                }
                if (Form.residence_pincode.value == "")
                {
                    alert('Please enter Pincode');
                    Form.residence_pincode.focus();
                    return false;
                }
                var a = Form.Pancard.value;
                var regex1 = /^[a-zA-Z]{5}\d{4}[a-zA-Z]{1}$/;  //this is the pattern of regular expersion
                if (regex1.test(a) == false)
                {
                    alert('Please enter correct PAN number');
                    Form.Pancard.focus();
                    return false;
                }
                if (Form.Pancard.value.charAt(3) != "P" && Form.Pancard.value.charAt(3) != "p")
                {
                    alert('Please enter correct PAN number');
                    Form.Pancard.focus();
                    return false;
                }

                if ((Form.Pancard.value == ""))
                {
                    alert('Please enter PAN number');
                    Form.Pancard.focus();
                    return false;
                }

  <?php if($Employment_Status==0)
				  { 
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
	if(Form.Total_Experience.value=="")
	{
		//alert("Please enter Total Experience.");
		document.getElementById('totalExpVal').innerHTML = "<span  class='hintanchor'>Fill Total Experience!</span>";
		Form.Total_Experience.focus();
		return false;
	}
	<?php if($plrow[$plrowcontr]['Employment_Status']==0) 
		   { }
		   else
		   {  ?>
	if(Form.Salary_Drawn.selectedIndex==0)
	{
		alert("Please enter How do you get your salary to Continue");
		Form.Salary_Drawn.focus();
		return false;
	}
<? } 
if($plrow[$plrowcontr]['source']=="komlipl")
	  { 
	  }
	  else { ?>
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
<? } ?>
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

function addElement()
{		
	var ni1 = document.getElementById('myDivcc1');
	var ni2 = document.getElementById('myDivcc2');
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
<form name="personalloan_form"  action="insert_personal_loan_bnrcamp.php" method="POST" onSubmit="return submitform(document.personalloan_form); ">
	<input type="hidden" value="<? echo $_SESSION['Temp_LID'];?>" name="leadid" />
	<input type="hidden" value="<? echo $City;?>" name="City" id="City" />
	 	
    	<input type="hidden" value="<? echo $Employment_Status;?>" name="emp_st" id="emp_st" />
    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td height="35" colspan="2" align="center" bgcolor="#f4f4f4" class="form_text_pl" style="font-size:13px;">Personal Loan Quote Request</td>
      </tr>
	
      <tr>
        <td width="41%" height="30" class="form_text_pl"><strong>Company Name</strong></td>
        <td>
        <input name="Company_Name" id="Company_Name" type="text" onKeyUp="ajax_showOptions(this,'getCountriesByLetters',event)" class="input_box"  autocomplete="off" onKeyDown="validateDiv('companyVal');" tabindex="1" value="<? echo $plrow[$plrowcontr]['Company_Name']; ?>" />
        <div id="companyVal" class="alert_msg"></div>  </td>
      </tr>
        <tr>
    <td height="28" class="form_text_pl"><strong>Loan Amount</strong></td>
    <td class="alert_msg">
    <input name="Loan_Amount" id="Loan_Amount" type="text" class="input_box" onChange="getDigitToWords('Loan_Amount','formatedlA','wordloanAmount'); intOnly(this);"  onKeyUp="intOnly(this);getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');"  onKeyDown="getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" onKeyPress="intOnly(this); getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" onBlur="getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" tabindex="2" value="<? echo $plrow[$plrowcontr]['Loan_Amount']; ?>">
    <div id="loanVal"></div></td>
  </tr> 
<tr>
	  <td colspan="2" align="left">  <span id='formatedlA' style='font-size:11px; font-weight:bold;color:666699;font-Family:Verdana; '></span><span id='wordloanAmount' style='font-size:11px; font-weight:bold;color:666699;font-Family:Verdana;text-transform: capitalize; margin-left:10px; margin-bottom:5px;'></span></td>
</tr>
     <tr>
        <td width="41%" height="30" class="form_text_pl"><strong>Primary Account in which bank?</strong></td>
        <td>
        <? $cmp_nme = "select Bank_Name from Bank_Master"; 
			list($cmp_nmerecordcount,$cmp_nmerow)=MainselectfuncNew($cmp_nme,$array = array());
			  if($cmp_nmerecordcount>1)
			  {
				  ?>
		    <select name="Primary_Acc" id="Primary_Acc" class="select_input" onChange="validateDiv('priAccVal');" tabindex="3" >
				  <option value="">Please Select</option>
			 <? 
		for($cmp=0;$cmp<$cmp_nmerecordcount;$cmp++)
		{ ?>
			<option value="<? echo $cmp_nmerow[$cmp]["Bank_Name"]; ?>"><? echo $cmp_nmerow[$cmp]["Bank_Name"]; ?> </option>
		<? } ?> </select> 
		    <? } ?>
          <div id="priAccVal" class="alert_msg"></div>  </td>
      </tr>
      
      <tr>
                            <td height="20" align="left" class="bldtxt">Gender</td>
                            <td  align="left" ><table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td width="6%" ><input type="radio" style="border:none;" value="1" name="Gender"  checked="checked" /></td>
                                        <td width="19%" style="color:#000000;" >                        Male</td>
                                        <td width="6%" ><input type="radio" style="border:none;" value="2" name="Gender" /></td>
                                        <td width="19%" style="color:#000000;" > Female</td>
                                        <td width="6%" ></td>
                                        <td width="44%" style="color:#000000;" ></td>
                                    </tr>
                                </table></td>
                        </tr>
                        <tr>
                            <td height="35" class="bldtxt">Residence Address</td>
                            <td class="frmtxt"> <textarea name="Residence_Address" id="Residence_Address" maxlength="250" onkeypress="return blockSpecialChar(event)"></textarea></td>
                        </tr> 
                        <tr>
                            <td height="35" class="bldtxt">Residence Pincode</td>
                            <td class="frmtxt"><input type="text" name="residence_pincode" id="residence_pincode" maxlength="6" class="input_box" /></td>
                        </tr> 
                        <tr>
                            <td height="35" class="bldtxt">PAN No</td>
                            <td class="frmtxt"><input type="text" name="Pancard" id="Pancard" maxlength="10" class="input_box" style="text-transform: uppercase" onkeypress="return blockAllSpecialChar(event)"  /></td>
                        </tr> 
      
        <? if($Employment_Status==0)
				  { 
				  }
				  else 
				  { ?>
      <tr>
        <td height="30" class="form_text_pl"><strong>Residential Status</strong></td>
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
        <td height="30" class="form_text_pl"><strong>Company Type</strong></td>
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
        <td height="30" class="form_text_pl"><b><? if($Employment_Status==0) 
		   { echo "Current Business Stability (in Years)"; } else { echo "No. of years in this Company"; } ?></b></td>
        <td><input name="Years_In_Company" type="text" class="input_box"  maxlength="15" tabindex="6" onKeyDown="validateDiv('yearsCompVal');">
        <div id="yearsCompVal"></div></td>
      </tr>
      <tr>
        <td height="30" class="form_text_pl"><strong>Total Experience (Years)/ Total Years in Business</strong></td>
        <td><input name="Total_Experience" class="input_box" onFocus="this.select();" tabindex="7" onKeyDown="validateDiv('totalExpVal');" onKeyUp="intOnly(this);" />
        <div id="totalExpVal"></div>  </td>
      </tr>
      	<?php if($plrow[$plrowcontr]['Employment_Status']==0) 
		   { }
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
      <?php } 
	  if($plrow[$plrowcontr]['source']=="komlipl")
	  { ?>
	<input type="hidden"  name="CC_Holder" id="CC_Holder" value="<? echo $plrow[$plrowcontr]['CC_Holder']; ?>" >
	<input type="hidden"  name="Card_Vintage" id="Card_Vintage" value="<? echo $plrow[$plrowcontr]['Card_Vintage']; ?>" >
	  <? }
	  else 
	  { ?>
          <tr>
    <td height="28" class="form_text_pl"><strong>Are you a Credit card holder?</strong></td>
    <td  class="form_text_pl" style="font-weight:normal;"><input type="radio"  name="CC_Holder" id="CC_Holder" value="1"  style="border:none;" tabindex="12" onClick="addElement(); validateDiv('ccholderVal');" > Yes &nbsp;<input type="radio"  name="CC_Holder" id="CC_Holder" style="border:none;" value="0" tabindex="13" onClick="removeElement(); validateDiv('ccholderVal'); "> No  <div id="ccholderVal" class="alert_msg" ></div> </td>
  </tr>
	<tr align="left"> <td id="myDivcc1" class="form_text_pl" style="font-weight:bold;" ></td>	<td id="myDivcc2"></td>	  </tr>
	<? } ?>
      <tr>
        <td height="30" class="form_text_pl"><strong>Any Loan running?</strong></td>
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
<?
//echo $plrow[$plrowcontr]['source']." - ".$plrow[$plrowcontr]['City']." - ".$plrow[$plrowcontr]['Net_Salary']." - ".$Is_Valid."<br>";
if($plrow[$plrowcontr]['source']=="aduncle" && $plrow[$plrowcontr]['Net_Salary']>=360000 && ( $plrow[$plrowcontr]['City']=="Ahmedabad" || $plrow[$plrowcontr]['City']=="Kolkata" || $plrow[$plrowcontr]['City']=="Jaipur" || $plrow[$plrowcontr]['City']=="Chandigarh" || $plrow[$plrowcontr]['City']=="Lucknow" || $plrow[$plrowcontr]['City']=="Jalandhar" || $plrow[$plrowcontr]['City']=="Cochin" || $plrow[$plrowcontr]['City']=="Nagpur" || $plrow[$plrowcontr]['City']=="Delhi" || $plrow[$plrowcontr]['City']=="Noida" || $plrow[$plrowcontr]['City']=="Gurgaon" || $plrow[$plrowcontr]['City']=="Mumbai" || $plrow[$plrowcontr]['City']=="Thane" || $plrow[$plrowcontr]['City']=="Bangalore" || $plrow[$plrowcontr]['City']=="Chennai" || $plrow[$plrowcontr]['City']=="Hyderabad" || $plrow[$plrowcontr]['City']=="Pune" || $plrow[$plrowcontr]['City']=="Surat" || $plrow[$plrowcontr]['City']=="Coimbatore" || $plrow[$plrowcontr]['City']=="Gaziabad" ) && $Is_Valid==1)
{ 
	$Dated = ExactServerdate();
	$insertArray = array('komli_uniqueid'=>$plrequestid, 'komli_email'=>$plrow[$plrowcontr]['Email'], 'komli_city'=>$plrow[$plrowcontr]['City'], 'komli_date'=>$Dated, 'komli_netsalary'=>$plrow[$plrowcontr]['Net_Salary'], 'vendor_name'=>$plrow[$plrowcontr]['source'], 'validated'=>$Is_Valid);
	$insert = Maininsertfunc ('komli_plcompaign', $insertArray);


?>
<!-- Offer Conversion: Deal4Loan CPL  -->
<img src="http://track.aduncle.com/aff_l?offer_id=992&adv_sub=SUB_ID" width="1" height="1" />
<!-- // End Offer Conversion -->
<? }
else if (($plrow[$plrowcontr]['source']=="icubespl" || $plrow[$plrowcontr]['source']=="icubes") && $plrow[$plrowcontr]['Net_Salary']>=360000 && ($plrow[$plrowcontr]['City']=="Chennai" || $plrow[$plrowcontr]['City']=="Bangalore" || $plrow[$plrowcontr]['City']=="Hyderabad" || $plrow[$plrowcontr]['City']=="Mumbai" || $plrow[$plrowcontr]['City']=="Navi Mumbai" || $plrow[$plrowcontr]['City']=="Thane" || $plrow[$plrowcontr]['City']=="Delhi" || $plrow[$plrowcontr]['City']=="Kolkata" || $plrow[$plrowcontr]['City']=="Ahmedabad" || $plrow[$plrowcontr]['City']=="Pune" || $plrow[$plrowcontr]['City']=="Vizag" || $plrow[$plrowcontr]['City']=="Vishakapatanam" || $plrow[$plrowcontr]['City']=="Surat" || $plrow[$plrowcontr]['City']=="Indore" || $plrow[$plrowcontr]['City']=="Cochin" || $plrow[$plrowcontr]['City']=="Chandigarh" || $plrow[$plrowcontr]['City']=="Jaipur" || $plrow[$plrowcontr]['City']=="Baroda" || $plrow[$plrowcontr]['City']=="Coimbatore" || $plrow[$plrowcontr]['City']=="Noida" || $plrow[$plrowcontr]['City']=="Gurgaon" || $plrow[$plrowcontr]['City']=="Faridabad" || $plrow[$plrowcontr]['City']=="Gaziabad") && $Is_Valid==1 && $age>=27)
{
$uniqueid=$plrequestid."pl"; ?>
<!-- Offer Conversion: Deal4loans - CPL -->
<iframe src="http://tracking.icubeswire.com/SLUp?adv_sub=<? echo $uniqueid; ?>" scrolling="no" frameborder="0" width="1" height="1"></iframe>
<!-- // End Offer Conversion -->
<? 
	$Dated = ExactServerdate();
	$insertArray = array('komli_uniqueid'=>$plrequestid, 'komli_email'=>$plrow[$plrowcontr]['Email'], 'komli_city'=>$plrow[$plrowcontr]['City'], 'komli_date'=>$Dated, 'komli_netsalary'=>$plrow[$plrowcontr]['Net_Salary'], 'vendor_name'=>$plrow[$plrowcontr]['source'], 'validated'=>$Is_Valid);
	$insert = Maininsertfunc ('komli_plcompaign', $insertArray);

}
else if (($plrow[$plrowcontr]['source']=="mailkart" && $plrow[$plrowcontr]['Net_Salary']>=500000 && ( ($plrow[$plrowcontr]['City']=="Delhi" || $plrow[$plrowcontr]['City']=="Chennai" || $plrow[$plrowcontr]['City']=="Gurgaon" || $plrow[$plrowcontr]['City']=="Hyderabad" || $plrow[$plrowcontr]['City']=="Faridabad" || $plrow[$plrowcontr]['City']=="Kolkata" || $plrow[$plrowcontr]['City']=="Thane" || $plrow[$plrowcontr]['City']=="Ahmedabad" || $plrow[$plrowcontr]['City']=="Noida" || $plrow[$plrowcontr]['City']=="Pune" || $plrow[$plrowcontr]['City']=="Gaziabad" || $plrow[$plrowcontr]['City']=="Bangalore" || $plrow[$plrowcontr]['City']=="Mumbai" || $plrow[$plrowcontr]['City']=="Chandigarh" || $plrow[$plrowcontr]['City']=="Lucknow")) && $Is_Valid==1))
{
$Dated = ExactServerdate();
	$insertArray = array('komli_uniqueid'=>$plrequestid, 'komli_email'=>$plrow[$plrowcontr]['Email'], 'komli_city'=>$plrow[$plrowcontr]['City'], 'komli_date'=>$Dated, 'komli_netsalary'=>$plrow[$plrowcontr]['Net_Salary'], 'vendor_name'=>$plrow[$plrowcontr]['source'], 'validated'=>$Is_Valid);
	$insert = Maininsertfunc ('komli_plcompaign', $insertArray);
}
else if(($plrow[$plrowcontr]['source']=="pokktpl" && $plrow[$plrowcontr]['Net_Salary']>=400000) && ($plrow[$plrowcontr]["City"]=='Delhi' || $plrow[$plrowcontr]["City"]=='Noida' || $plrow[$plrowcontr]["City"]=='Gurgaon' || $plrow[$plrowcontr]["City"]=='Gaziabad' || $plrow[$plrowcontr]["City"]=='Faridabad' || $plrow[$plrowcontr]["City"]=='Sahibabad' || $plrow[$plrowcontr]["City"]=='Greater Noida' || $plrow[$plrowcontr]["City"]=='Bangalore' || $plrow[$plrowcontr]["City"]==' Mumbai' || $plrow[$plrowcontr]["City"]=='Navi Mumbai' || $plrow[$plrowcontr]["City"]=='Thane' || $plrow[$plrowcontr]["City"]=='Hyderabad' || $plrow[$plrowcontr]["City"]=='Chennai' || $plrow[$plrowcontr]["City"]=='Pune' || $plrow[$plrowcontr]["City"]=='Ahmedabad' || $plrow[$plrowcontr]["City"]=='Kolkata') && $Is_Valid==1)
{ ?>
	<img src="http://www.pokkt.com/pokktapi/callPokktApiWithTId" width='0' height='0'/>
<? }
else if(($plrow[$plrowcontr]['source']=="vcommissionpl" && $plrow[$plrowcontr]['Net_Salary']>=400000) && ($plrow[$plrowcontr]["City"]=='Delhi' || $plrow[$plrowcontr]["City"]=='Noida' || $plrow[$plrowcontr]["City"]=='Gurgaon' || $plrow[$plrowcontr]["City"]=='Gaziabad' || $plrow[$plrowcontr]["City"]=='Faridabad' || $plrow[$plrowcontr]["City"]=='Sahibabad' || $plrow[$plrowcontr]["City"]=='Greater Noida' || $plrow[$plrowcontr]["City"]=='Bangalore' || $plrow[$plrowcontr]["City"]==' Mumbai' || $plrow[$plrowcontr]["City"]=='Navi Mumbai' || $plrow[$plrowcontr]["City"]=='Thane' || $plrow[$plrowcontr]["City"]=='Hyderabad' || $plrow[$plrowcontr]["City"]=='Chennai' || $plrow[$plrowcontr]["City"]=='Pune' || $plrow[$plrowcontr]["City"]=='Kolkata') && $Is_Valid==1)
{  $uniqueid=$plrequestid; 
  $Dated = ExactServerdate();
	$insertArray = array('komli_uniqueid'=>$plrequestid, 'komli_email'=>$plrow[$plrowcontr]['Email'], 'komli_city'=>$plrow[$plrowcontr]['City'], 'komli_date'=>$Dated, 'komli_netsalary'=>$plrow[$plrowcontr]['Net_Salary'], 'vendor_name'=>$plrow[$plrowcontr]['source'], 'validated'=>$Is_Valid);
	$insert = Maininsertfunc ('komli_plcompaign', $insertArray);
  ?>
	<!-- Offer Conversion: Deal4loans CPL – India -->
<iframe src="https://tracking.vcommission.com/SL4xv?adv_sub=<? echo $uniqueid; ?>" scrolling="no" frameborder="0" width="1" height="1"></iframe>
<!-- // End Offer Conversion -->
<? }
else if((strncmp("ibiboplnw", $plrow[$plrowcontr]["source"],9))==0 && ($plrow[$plrowcontr]["Net_Salary"]>=360000) && ( $plrow[$plrowcontr]["City"]=="Ahmedabad" || $plrow[$plrowcontr]["City"]=="Lucknow" || $plrow[$plrowcontr]["City"]=="Delhi" || $plrow[$plrowcontr]["City"]=="Thane" || $plrow[$plrowcontr]["City"]=="Pune" || $plrow[$plrowcontr]["City"]=="Kolkata" || $plrow[$plrowcontr]["City"]=="Jalandhar" || $plrow[$plrowcontr]["City"]=="Noida" || $plrow[$plrowcontr]["City"]=="Bangalore" || $plrow[$plrowcontr]["City"]=="Surat" || $plrow[$plrowcontr]["City"]=="Jaipur" || $plrow[$plrowcontr]["City"]=="Cochin" || $plrow[$plrowcontr]["City"]=="Gurgaon" || $plrow[$plrowcontr]["City"]=="Chennai" || $plrow[$plrowcontr]["City"]=="Coimbatore" || $plrow[$plrowcontr]["City"]=="Chandigarh" || $plrow[$plrowcontr]["City"]=="Nagpur" || $plrow[$plrowcontr]["City"]=="Mumbai" || $plrow[$plrowcontr]["City"]=="Hyderabad" || $plrow[$plrowcontr]["City"]=="Gaziabad") && $Is_Valid==1)
{ $uniqueid=$plrequestid; 
$Dated = ExactServerdate();
	$insertArray = array('komli_uniqueid'=>$plrequestid, 'komli_email'=>$plrow[$plrowcontr]['Email'], 'komli_city'=>$plrow[$plrowcontr]['City'], 'komli_date'=>$Dated, 'komli_netsalary'=>$plrow[$plrowcontr]['Net_Salary'], 'vendor_name'=>$plrow[$plrowcontr]['source'], 'validated'=>$Is_Valid);
	$insert = Maininsertfunc ('komli_plcompaign', $insertArray);
?>
<iframe src="https://tracking.ads.ibibo.com/p.ashx?o=386&t=<? echo $uniqueid; ?>" height="1" width="1" frameborder="0"></iframe>
<? } 
else if(($plrow[$plrowcontr]['source']=="komlipl" || $plrow[$plrowcontr]['source']=="komli") && $plrow[$plrowcontr]['Net_Salary']>=360000 && ( $plrow[$plrowcontr]['City']=="Ahmedabad" || $plrow[$plrowcontr]['City']=="Kolkata" || $plrow[$plrowcontr]['City']=="Jaipur" || $plrow[$plrowcontr]['City']=="Chandigarh" || $plrow[$plrowcontr]['City']=="Lucknow" || $plrow[$plrowcontr]['City']=="Jalandhar" || $plrow[$plrowcontr]['City']=="Cochin" || $plrow[$plrowcontr]['City']=="Nagpur" || $plrow[$plrowcontr]['City']=="Delhi" || $plrow[$plrowcontr]['City']=="Noida" || $plrow[$plrowcontr]['City']=="Gurgaon" || $plrow[$plrowcontr]['City']=="Mumbai" || $plrow[$plrowcontr]['City']=="Thane" || $plrow[$plrowcontr]['City']=="Bangalore" || $plrow[$plrowcontr]['City']=="Chennai" || $plrow[$plrowcontr]['City']=="Hyderabad" || $plrow[$plrowcontr]['City']=="Pune" || $plrow[$plrowcontr]['City']=="Surat" || $plrow[$plrowcontr]['City']=="Coimbatore" || $plrow[$plrowcontr]['City']=="Gaziabad" ) && $Is_Valid==1)
{ $uniqueid=$plrequestid."pl"; ?>
<script src="http://partners.komli.com/lead_third/10067/mobileno,<? echo $plrow[$plrowcontr]['Email']; ?>,<? echo $plrow[$plrowcontr]['City']; ?>,<? echo $uniqueid; ?>"></script>
<noscript><img src="http://partners.komli.com/track_lead/10067/mobileno,<? echo $plrow[$plrowcontr]['Email']; ?>,<? echo $plrow[$plrowcontr]['City']; ?>,<? echo $uniqueid; ?>"></noscript>
<script type="text/javascript" src="http://trk.atomex.net/cgi-bin/tracker.fcgi/conv?px=9430&ty=1"></script>
<? 
$Dated = ExactServerdate();
	$insertArray = array('komli_uniqueid'=>$plrequestid, 'komli_email'=>$plrow[$plrowcontr]['Email'], 'komli_city'=>$plrow[$plrowcontr]['City'], 'komli_date'=>$Dated, 'komli_netsalary'=>$plrow[$plrowcontr]['Net_Salary'], 'vendor_name'=>$plrow[$plrowcontr]['source'], 'validated'=>$Is_Valid);
	$insert = Maininsertfunc ('komli_plcompaign', $insertArray);
}
else if(($plrow[$plrowcontr]['source']=="digitalmlr" || $plrow[$plrowcontr]['source']=="digitalmlr") && $plrow[$plrowcontr]['Net_Salary']>=360000 && ( $plrow[$plrowcontr]['City']=="Ahmedabad" || $plrow[$plrowcontr]['City']=="Kolkata" || $plrow[$plrowcontr]['City']=="Delhi" || $plrow[$plrowcontr]['City']=="Noida" || $plrow[$plrowcontr]['City']=="Gurgaon" || $plrow[$plrowcontr]['City']=="Mumbai" || $plrow[$plrowcontr]['City']=="Thane" || $plrow[$plrowcontr]['City']=="Bangalore" || $plrow[$plrowcontr]['City']=="Chennai" || $plrow[$plrowcontr]['City']=="Pune" || $plrow[$plrowcontr]['City']=="Gaziabad" ) && $Is_Valid==1)
{ 
$Dated = ExactServerdate();
	$insertArray = array('komli_uniqueid'=>$plrequestid, 'komli_email'=>$plrow[$plrowcontr]['Email'], 'komli_city'=>$plrow[$plrowcontr]['City'], 'komli_date'=>$Dated, 'komli_netsalary'=>$plrow[$plrowcontr]['Net_Salary'], 'vendor_name'=>$plrow[$plrowcontr]['source'], 'validated'=>$Is_Valid);
	$insert = Maininsertfunc ('komli_plcompaign', $insertArray);
}
else if(($plrow[$plrowcontr]['source']=="monsterpl" || $plrow[$plrowcontr]['source']=="monsterpl" || $plrow[$plrowcontr]['source']=="AFL_MLR_MONSTER_PL") && $plrow[$plrowcontr]['Net_Salary']>=400000 && ( $plrow[$plrowcontr]['City']=="Ahmedabad" || $plrow[$plrowcontr]['City']=="Delhi" || $plrow[$plrowcontr]['City']=="Noida" || $plrow[$plrowcontr]['City']=="Gurgaon" || $plrow[$plrowcontr]['City']=="Gaziabad" || $plrow[$plrowcontr]['City']=="Faridabad" || $plrow[$plrowcontr]['City']=="Mumbai" || $plrow[$plrowcontr]['City']=="Thane" || $plrow[$plrowcontr]['City']=="Bangalore" || $plrow[$plrowcontr]['City']=="Chennai" || $plrow[$plrowcontr]['City']=="Hyderabad" || $plrow[$plrowcontr]['City']=="Pune"
|| $plrow[$plrowcontr]['City']=="Chandigarh" || $plrow[$plrowcontr]['City']=="Coimbatore" || $plrow[$plrowcontr]['City']=="Baroda" || $plrow[$plrowcontr]['City']=="Jaipur" || $plrow[$plrowcontr]['City']=="Cochin" || $plrow[$plrowcontr]['City']=="Nasik" || $plrow[$plrowcontr]['City']=="Surat") && $Is_Valid==1)
{ 
$Dated = ExactServerdate();
	$insertArray = array('komli_uniqueid'=>$plrequestid, 'komli_email'=>$plrow[$plrowcontr]['Email'], 'komli_city'=>$plrow[$plrowcontr]['City'], 'komli_date'=>$Dated, 'komli_netsalary'=>$plrow[$plrowcontr]['Net_Salary'], 'vendor_name'=>$plrow[$plrowcontr]['source'], 'validated'=>$Is_Valid);
	$insert = Maininsertfunc ('komli_plcompaign', $insertArray);

?>
<img height='1' width='1' border='0' src='http://newsletter.monsterindia.com/track/track.html?cid=3344'/>
<?
}
else if(($plrow[$plrowcontr]['source']=="clckthrnetwk" || $plrow[$plrowcontr]['source']=="clckthrnetwk") && $plrow[$plrowcontr]['Net_Salary']>=360000 && ( $plrow[$plrowcontr]['City']=="Ahmedabad" || $plrow[$plrowcontr]['City']=="Kolkata" || $plrow[$plrowcontr]['City']=="Delhi" || $plrow[$plrowcontr]['City']=="Noida" || $plrow[$plrowcontr]['City']=="Gurgaon" || $plrow[$plrowcontr]['City']=="Mumbai" || $plrow[$plrowcontr]['City']=="Thane" || $plrow[$plrowcontr]['City']=="Bangalore" || $plrow[$plrowcontr]['City']=="Chennai" || $plrow[$plrowcontr]['City']=="Pune" || $plrow[$plrowcontr]['City']=="Gaziabad" ) && $Is_Valid==1)
{ 
$Dated = ExactServerdate();
	$insertArray = array('komli_uniqueid'=>$plrequestid, 'komli_email'=>$plrow[$plrowcontr]['Email'], 'komli_city'=>$plrow[$plrowcontr]['City'], 'komli_date'=>$Dated, 'komli_netsalary'=>$plrow[$plrowcontr]['Net_Salary'], 'vendor_name'=>$plrow[$plrowcontr]['source'], 'validated'=>$Is_Valid);
	$insert = Maininsertfunc ('komli_plcompaign', $insertArray);
?>
<!-- Begin ZEDO --> 
<iframe src = "http://c1.zedo.com/up/1966/676735/n.html" frameborder=0
marginheight=0 marginwidth=0 scrolling="no" allowTransparency="true"
></iframe>
<!-- End ZEDO -->
<!-- Offer Conversion: Deal4loans Oct 2013 -->
<img src="http://ctn.go2cloud.org/SLk?adv_sub=SUB_ID" width="1" height="1"
/>
<!-- // End Offer Conversion -->
<?
}
else if(($plrow[$plrowcontr]['source']=="logicserve" || $plrow[$plrowcontr]['source']=="logicserve") && $plrow[$plrowcontr]['Net_Salary']>=360000 && ( $plrow[$plrowcontr]['City']=="Ahmedabad" || $plrow[$plrowcontr]['City']=="Kolkata" || $plrow[$plrowcontr]['City']=="Delhi" || $plrow[$plrowcontr]['City']=="Noida" || $plrow[$plrowcontr]['City']=="Gurgaon" || $plrow[$plrowcontr]['City']=="Mumbai" || $plrow[$plrowcontr]['City']=="Thane" || $plrow[$plrowcontr]['City']=="Bangalore" || $plrow[$plrowcontr]['City']=="Chennai" || $plrow[$plrowcontr]['City']=="Pune" || $plrow[$plrowcontr]['City']=="Gaziabad" ) && $Is_Valid==1)
{ 
$Dated = ExactServerdate();
	$insertArray = array('komli_uniqueid'=>$plrequestid, 'komli_email'=>$plrow[$plrowcontr]['Email'], 'komli_city'=>$plrow[$plrowcontr]['City'], 'komli_date'=>$Dated, 'komli_netsalary'=>$plrow[$plrowcontr]['Net_Salary'], 'vendor_name'=>$plrow[$plrowcontr]['source'], 'validated'=>$Is_Valid);
	$insert = Maininsertfunc ('komli_plcompaign', $insertArray);
?>
<!-- Begin LS -->

<iframe src = 
"http://results.affilitrace.com/g1.aspx?uniqueid=<? echo $plrequestid; ?>&transaction_category=&transaction_value=&g1=" 
frameborder=0
 marginheight=0 marginwidth=0 scrolling="no" allowTransparency="true" 
></iframe>
<img src="http://www.pokkt.com/pokktapi/callPokktApiWithTId" width='0' height='0'/>
<!-- End LS -->
<?
}
else if(($plrow[$plrowcontr]['source']=="dgm_ploct13" || $plrow[$plrowcontr]['source']=="dgm_ploct13") && $plrow[$plrowcontr]['Net_Salary']>=360000 && ($plrow[$plrowcontr]['City']=="Ahmedabad " || $plrow[$plrowcontr]['City']=="Kolkata" || $plrow[$plrowcontr]['City']=="Jaipur" || $plrow[$plrowcontr]['City']=="Chandigarh" || $plrow[$plrowcontr]['City']=="Lucknow" || $plrow[$plrowcontr]['City']=="Nagpur" || $plrow[$plrowcontr]['City']=="Delhi" || $plrow[$plrowcontr]['City']=="Noida" || $plrow[$plrowcontr]['City']=="Gurgaon" || $plrow[$plrowcontr]['City']=="Faridabad" || $plrow[$plrowcontr]['City']=="Gaziabad" || $plrow[$plrowcontr]['City']=="Mumbai" || $plrow[$plrowcontr]['City']=="Thane" || $plrow[$plrowcontr]['City']=="Bangalore" || $plrow[$plrowcontr]['City']=="Chennai" || $plrow[$plrowcontr]['City']=="Hyderabad" || $plrow[$plrowcontr]['City']=="Pune" || $plrow[$plrowcontr]['City']=="Surat" || $plrow[$plrowcontr]['City']=="Coimbatore") && $Is_Valid==1)
{ ?>
<script src="https://www.s2d6.com/js/globalpixel.js?x=sp&a=265&h=67736&o=<? echo $plrequestid; ?>&g=registration&s=0.00&q=1"></script>
<? 
$Dated = ExactServerdate();
	$insertArray = array('komli_uniqueid'=>$plrequestid, 'komli_email'=>$plrow[$plrowcontr]['Email'], 'komli_city'=>$plrow[$plrowcontr]['City'], 'komli_date'=>$Dated, 'komli_netsalary'=>$plrow[$plrowcontr]['Net_Salary'], 'vendor_name'=>$plrow[$plrowcontr]['source'], 'validated'=>$Is_Valid);
	$insert = Maininsertfunc ('komli_plcompaign', $insertArray);
}
else if(($plrow[$plrowcontr]['source']=="inuxu_oct13" || $plrow[$plrowcontr]['source']=="inuxu_Jun15" || $plrow[$plrowcontr]['source']=="inuxu_oct13" || (strncmp ("inuxu", $plrow[$plrowcontr]['source'],5))==0) && $plrow[$plrowcontr]['Net_Salary']>=360000 && ($plrow[$plrowcontr]['City']=="Delhi" || $plrow[$plrowcontr]['City']=="Noida" || $plrow[$plrowcontr]['City']=="Gurgaon" || $plrow[$plrowcontr]['City']=="Gaziabad" || $plrow[$plrowcontr]['City']=="Faridabad" || $plrow[$plrowcontr]['City']=="Mumbai" || $plrow[$plrowcontr]['City']=="Thane" || $plrow[$plrowcontr]['City']=="Navi Mumbai" || $plrow[$plrowcontr]['City']=="Pune" || $plrow[$plrowcontr]['City']=="Chennai" || $plrow[$plrowcontr]['City']=="Bangalore") && $Is_Valid==1)
{ ?>
<iframe src="http://camclik.com/p.ashx?o=51&e=25&t=<? echo $plrequestid; ?>" height="1" width="1" frameborder="0"></iframe>
<? 
$Dated = ExactServerdate();
	$insertArray = array('komli_uniqueid'=>$plrequestid, 'komli_email'=>$plrow[$plrowcontr]['Email'], 'komli_city'=>$plrow[$plrowcontr]['City'], 'komli_date'=>$Dated, 'komli_netsalary'=>$plrow[$plrowcontr]['Net_Salary'], 'vendor_name'=>$plrow[$plrowcontr]['source'], 'validated'=>$Is_Valid);
	$insert = Maininsertfunc ('komli_plcompaign', $insertArray);
}
elseif($plrow[$plrowcontr]['source']=="netcorepl" && ($plrow[$plrowcontr]['City']=="Chennai" || $plrow[$plrowcontr]['City']=="Bangalore" || $plrow[$plrowcontr]['City']=="Hyderabad" || $plrow[$plrowcontr]['City']=="Mumbai" || $plrow[$plrowcontr]['City']=="Navi Mumbai" || $plrow[$plrowcontr]['City']=="Thane" || $plrow[$plrowcontr]['City']=="Delhi" || $plrow[$plrowcontr]['City']=="Kolkata" || $plrow[$plrowcontr]['City']=="Ahmedabad" || $plrow[$plrowcontr]['City']=="Pune" || $plrow[$plrowcontr]['City']=="Vizag" || $plrow[$plrowcontr]['City']=="Vishakapatanam" || $plrow[$plrowcontr]['City']=="Surat" || $plrow[$plrowcontr]['City']=="Indore" || $plrow[$plrowcontr]['City']=="Cochin" || $plrow[$plrowcontr]['City']=="Chandigarh" || $plrow[$plrowcontr]['City']=="Jaipur" || $plrow[$plrowcontr]['City']=="Baroda" || $plrow[$plrowcontr]['City']=="Coimbatore" || $plrow[$plrowcontr]['City']=="Noida" || $plrow[$plrowcontr]['City']=="Gurgaon" || $plrow[$plrowcontr]['City']=="Faridabad" || $plrow[$plrowcontr]['City']=="Gaziabad") && $plrow[$plrowcontr]['Net_Salary']>=360000 && $Is_Valid==1)
{ $Dated = ExactServerdate();
	$insertArray = array('komli_uniqueid'=>$plrequestid, 'komli_email'=>$plrow[$plrowcontr]['Email'], 'komli_city'=>$plrow[$plrowcontr]['City'], 'komli_date'=>$Dated, 'komli_netsalary'=>$plrow[$plrowcontr]['Net_Salary'], 'vendor_name'=>$plrow[$plrowcontr]['source'], 'validated'=>$Is_Valid);
	$insert = Maininsertfunc ('komli_plcompaign', $insertArray);

//echo $insrtnetocre;?>
<!-- Offer Conversion: Bima Deals Personal loan CPL -->
<iframe src="http://tracking.affiliatehub.co.in/SLJc?adv_sub=<? echo $plrequestid; ?>" scrolling="no" frameborder="0" width="1" height="1"></iframe>
<!-- // End Offer Conversion -->
<? }
elseif($plrow[$plrowcontr]['source']=="pyxelconnectpl" && ($plrow[$plrowcontr]['City']=="Chennai" || $plrow[$plrowcontr]['City']=="Bangalore" || $plrow[$plrowcontr]['City']=="Hyderabad" || $plrow[$plrowcontr]['City']=="Mumbai" || $plrow[$plrowcontr]['City']=="Navi Mumbai" || $plrow[$plrowcontr]['City']=="Thane" || $plrow[$plrowcontr]['City']=="Delhi" || $plrow[$plrowcontr]['City']=="Kolkata" || $plrow[$plrowcontr]['City']=="Ahmedabad" || $plrow[$plrowcontr]['City']=="Pune" || $plrow[$plrowcontr]['City']=="Vizag" || $plrow[$plrowcontr]['City']=="Vishakapatanam" || $plrow[$plrowcontr]['City']=="Surat" || $plrow[$plrowcontr]['City']=="Indore" || $plrow[$plrowcontr]['City']=="Cochin" || $plrow[$plrowcontr]['City']=="Chandigarh" || $plrow[$plrowcontr]['City']=="Jaipur" || $plrow[$plrowcontr]['City']=="Baroda" || $plrow[$plrowcontr]['City']=="Coimbatore" || $plrow[$plrowcontr]['City']=="Noida" || $plrow[$plrowcontr]['City']=="Gurgaon" || $plrow[$plrowcontr]['City']=="Faridabad" || $plrow[$plrowcontr]['City']=="Gaziabad") && $plrow[$plrowcontr]['Net_Salary']>=360000 && $Is_Valid==1)
{ $Dated = ExactServerdate();
	$insertArray = array('komli_uniqueid'=>$plrequestid, 'komli_email'=>$plrow[$plrowcontr]['Email'], 'komli_city'=>$plrow[$plrowcontr]['City'], 'komli_date'=>$Dated, 'komli_netsalary'=>$plrow[$plrowcontr]['Net_Salary'], 'vendor_name'=>$plrow[$plrowcontr]['source'], 'validated'=>$Is_Valid);
	$insert = Maininsertfunc ('komli_plcompaign', $insertArray);

//echo $insrtnetocre;?>
<? }
elseif($plrow[$plrowcontr]['source']=="timesmobpl" && $plrow[$plrowcontr]['Net_Salary']>=400000 && ($plrow[$plrowcontr]['City']=="Delhi" || $plrow[$plrowcontr]['City']=="Noida" || $plrow[$plrowcontr]['City']=="Gurgaon" || $plrow[$plrowcontr]['City']=="Gaziabad" || $plrow[$plrowcontr]['City']=="Faridabad" || $plrow[$plrowcontr]['City']=="Mumbai" || $plrow[$plrowcontr]['City']=="Thane" || $plrow[$plrowcontr]['City']=="Navi Mumbai" || $plrow[$plrowcontr]['City']=="Hyderabad" || $plrow[$plrowcontr]['City']=="Chennai" || $plrow[$plrowcontr]['City']=="Bangalore") && $Is_Valid==1)
{ ?>
<script type="text/javascript" src="https://track.in.omgpm.com/584203/transaction.asp?APPID=<? echo $plrequestid; ?>&MID=584203&PID=11996&status="></script>
<noscript><img src="https://track.in.omgpm.com/apptag.asp?APPID=<? echo $plrequestid; ?>&MID=584203&PID=11996&status=" border="0" height="1" width="1"></noscript>
<?
$Dated = ExactServerdate();
	$insertArray = array('komli_uniqueid'=>$plrequestid, 'komli_email'=>$plrow[$plrowcontr]['Email'], 'komli_city'=>$plrow[$plrowcontr]['City'], 'komli_date'=>$Dated, 'komli_netsalary'=>$plrow[$plrowcontr]['Net_Salary'], 'vendor_name'=>$plrow[$plrowcontr]['source'], 'validated'=>$Is_Valid);
	$insert = Maininsertfunc ('komli_plcompaign', $insertArray);

}
elseif($plrow[$plrowcontr]['source']=="cardekhopl" && $plrow[$plrowcontr]['Net_Salary']>=400000 && ($plrow[$plrowcontr]['City']=="Delhi" || $plrow[$plrowcontr]['City']=="Noida" || $plrow[$plrowcontr]['City']=="Gurgaon" || $plrow[$plrowcontr]['City']=="Gaziabad" || $plrow[$plrowcontr]['City']=="Faridabad" || $plrow[$plrowcontr]['City']=="Mumbai" || $plrow[$plrowcontr]['City']=="Thane" || $plrow[$plrowcontr]['City']=="Navi Mumbai" || $plrow[$plrowcontr]['City']=="Hyderabad" || $plrow[$plrowcontr]['City']=="Chennai" || $plrow[$plrowcontr]['City']=="Bangalore" || $plrow[$plrowcontr]['City']=="Pune" || $plrow[$plrowcontr]['City']=="Kolkata") && $Is_Valid==1 && $age>28)
{ 
$Dated = ExactServerdate();
	$insertArray = array('komli_uniqueid'=>$plrequestid, 'komli_email'=>$plrow[$plrowcontr]['Email'], 'komli_city'=>$plrow[$plrowcontr]['City'], 'komli_date'=>$Dated, 'komli_netsalary'=>$plrow[$plrowcontr]['Net_Salary'], 'vendor_name'=>$plrow[$plrowcontr]['source'], 'validated'=>$Is_Valid);
	$insert = Maininsertfunc ('komli_plcompaign', $insertArray);
?>
<img src="https://cardekhoaffiliate.go2cloud.org/aff_l?offer_id=693&adv_sub=<? echo $plrequestid; ?>" width="1" height="1" />
<? }
elseif(($plrow[$plrowcontr]['source']=="creditvidyaPL" || $plrow[$plrowcontr]['source']=="allbankngsolnPL" || $plrow[$plrowcontr]['source']=="investmentyogiPL") && $Is_Valid==1)
{
$Dated = ExactServerdate();
	$insertArray = array('komli_uniqueid'=>$plrequestid, 'komli_email'=>$plrow[$plrowcontr]['Email'], 'komli_city'=>$plrow[$plrowcontr]['City'], 'komli_date'=>$Dated, 'komli_netsalary'=>$plrow[$plrowcontr]['Net_Salary'], 'vendor_name'=>$plrow[$plrowcontr]['source'], 'validated'=>$Is_Valid);
	$insert = Maininsertfunc ('komli_plcompaign', $insertArray);

}
elseif($plrow[$plrowcontr]['source']=="yahoopl")
{ ?>
<!-- Advertiser 'WRS INFO INDIA PVT LTD',  Conversion tracking '741952_Bhimadeals_CPA_09July09' - DO NOT MODIFY THIS PIXEL IN ANY WAY -->
<img src="https://ads.yahoo.com/pixel?id=538556&t=2" width="1" height="1" />
<!-- End of conversion tag -->
<? }
elseif($plrow[$plrowcontr]['source']=="valuefirstpl" && $plrow[$plrowcontr]['Net_Salary']>=400000 && ($plrow[$plrowcontr]['City']=="Delhi" || $plrow[$plrowcontr]['City']=="Noida" || $plrow[$plrowcontr]['City']=="Gurgaon" || $plrow[$plrowcontr]['City']=="Gaziabad" || $plrow[$plrowcontr]['City']=="Faridabad" || $plrow[$plrowcontr]['City']=="Mumbai" || $plrow[$plrowcontr]['City']=="Thane" || $plrow[$plrowcontr]['City']=="Navi Mumbai" || $plrow[$plrowcontr]['City']=="Hyderabad" || $plrow[$plrowcontr]['City']=="Chennai" || $plrow[$plrowcontr]['City']=="Bangalore" || $plrow[$plrowcontr]['City']=="Pune" || $plrow[$plrowcontr]['City']=="Ahmedabad") && $Is_Valid==1)
{
	$Dated = ExactServerdate();
	$insertArray = array('komli_uniqueid'=>$plrequestid, 'komli_email'=>$plrow[$plrowcontr]['Email'], 'komli_city'=>$plrow[$plrowcontr]['City'], 'komli_date'=>$Dated, 'komli_netsalary'=>$plrow[$plrowcontr]['Net_Salary'], 'vendor_name'=>$plrow[$plrowcontr]['source'], 'validated'=>$Is_Valid);
	$insert = Maininsertfunc ('komli_plcompaign', $insertArray);

	?>
	<img src="http://vclix.biz/p.ashx?o=245&f=img&t=<? echo $plrequestid; ?>" width="1" height="1" border="0" />
<? }
elseif($plrow[$plrowcontr]['source']=="blueearthpl" && $plrow[$plrowcontr]['Net_Salary']>=500000 && ($plrow[$plrowcontr]['City']=="Delhi" || $plrow[$plrowcontr]['City']=="Noida" || $plrow[$plrowcontr]['City']=="Gurgaon" || $plrow[$plrowcontr]['City']=="Gaziabad" || $plrow[$plrowcontr]['City']=="Faridabad" || $plrow[$plrowcontr]['City']=="Mumbai" || $plrow[$plrowcontr]['City']=="Thane" || $plrow[$plrowcontr]['City']=="Navi Mumbai" || $plrow[$plrowcontr]['City']=="Hyderabad" || $plrow[$plrowcontr]['City']=="Chennai" || $plrow[$plrowcontr]['City']=="Bangalore" || $plrow[$plrowcontr]['City']=="Kolkata") && $Is_Valid==1 && $age>=28)
{
	$Dated = ExactServerdate();
	$insertArray = array('komli_uniqueid'=>$plrequestid, 'komli_email'=>$plrow[$plrowcontr]['Email'], 'komli_city'=>$plrow[$plrowcontr]['City'], 'komli_date'=>$Dated, 'komli_netsalary'=>$plrow[$plrowcontr]['Net_Salary'], 'vendor_name'=>$plrow[$plrowcontr]['source'], 'validated'=>$Is_Valid);
	$insert = Maininsertfunc ('komli_plcompaign', $insertArray);
 
 }
 else if(($plrow[$plrowcontr]['source']=="clickZootpl") && $plrow[$plrowcontr]['Net_Salary']>=360000 && ($plrow[$plrowcontr]['City']=="Delhi" || $plrow[$plrowcontr]['City']=="Noida" || $plrow[$plrowcontr]['City']=="Gurgaon" || $plrow[$plrowcontr]['City']=="Gaziabad" || $plrow[$plrowcontr]['City']=="Faridabad" || $plrow[$plrowcontr]['City']=="Mumbai" || $plrow[$plrowcontr]['City']=="Thane" || $plrow[$plrowcontr]['City']=="Navi Mumbai" || $plrow[$plrowcontr]['City']=="Pune" || $plrow[$plrowcontr]['City']=="Chennai" || $plrow[$plrowcontr]['City']=="Bangalore") && $Is_Valid==1)
{ ?>
<iframe src="http://cztrk.com/p.ashx?o=565&t=<? echo $plrequestid; ?>" height="1" width="1" frameborder="0"></iframe>
<? 
$Dated = ExactServerdate();
	$insertArray = array('komli_uniqueid'=>$plrequestid, 'komli_email'=>$plrow[$plrowcontr]['Email'], 'komli_city'=>$plrow[$plrowcontr]['City'], 'komli_date'=>$Dated, 'komli_netsalary'=>$plrow[$plrowcontr]['Net_Salary'], 'vendor_name'=>$plrow[$plrowcontr]['source'], 'validated'=>$Is_Valid);
	$insert = Maininsertfunc ('komli_plcompaign', $insertArray);

}
 else if(($plrow[$plrowcontr]['source']=="proformicspl") && $plrow[$plrowcontr]['Net_Salary']>=400000 && ($plrow[$plrowcontr]['City']=="Delhi" || $plrow[$plrowcontr]['City']=="Noida" || $plrow[$plrowcontr]['City']=="Gurgaon" || $plrow[$plrowcontr]['City']=="Gaziabad" || $plrow[$plrowcontr]['City']=="Faridabad" || $plrow[$plrowcontr]['City']=="Mumbai" || $plrow[$plrowcontr]['City']=="Thane" || $plrow[$plrowcontr]['City']=="Navi Mumbai" || $plrow[$plrowcontr]['City']=="Pune" || $plrow[$plrowcontr]['City']=="Chennai" || $plrow[$plrowcontr]['City']=="Bangalore" || $plrow[$plrowcontr]['City']=="Kolkata" || $plrow[$plrowcontr]['City']=="Hyderabad" || $plrow[$plrowcontr]['City']=="Ahmedabad") && $Is_Valid==1 && $age>27)
{  
$Dated = ExactServerdate();
	$insertArray = array('komli_uniqueid'=>$plrequestid, 'komli_email'=>$plrow[$plrowcontr]['Email'], 'komli_city'=>$plrow[$plrowcontr]['City'], 'komli_date'=>$Dated, 'komli_netsalary'=>$plrow[$plrowcontr]['Net_Salary'], 'vendor_name'=>$plrow[$plrowcontr]['source'], 'validated'=>$Is_Valid);
	$insert = Maininsertfunc ('komli_plcompaign', $insertArray);

?>
<!-- Offer Conversion: Deal4Loans_Personal Loan_City Targeted -->
<iframe src="http://tracking.proformics.com/aff_l?offer_id=698&adv_sub=<? echo $plrequestid; ?>" scrolling="no" frameborder="0" width="1" height="1"></iframe>
<!-- // End Offer Conversion -->
<?
}            
 else if(($plrow[$plrowcontr]['source']=="shopatbestpl" || $plrow[$plrowcontr]['source']=="AFL_MLR_SHOPATBEST_PL") && $plrow[$plrowcontr]['Net_Salary']>=450000 && ($plrow[$plrowcontr]['City']=="Delhi" || $plrow[$plrowcontr]['City']=="Noida" || $plrow[$plrowcontr]['City']=="Gurgaon" || $plrow[$plrowcontr]['City']=="Gaziabad" || $plrow[$plrowcontr]['City']=="Faridabad" || $plrow[$plrowcontr]['City']=="Mumbai" || $plrow[$plrowcontr]['City']=="Thane" || $plrow[$plrowcontr]['City']=="Navi Mumbai" || $plrow[$plrowcontr]['City']=="Pune" || $plrow[$plrowcontr]['City']=="Chennai" || $plrow[$plrowcontr]['City']=="Bangalore" || $plrow[$plrowcontr]['City']=="Coimbatore" || $plrow[$plrowcontr]['City']=="Hyderabad" || $plrow[$plrowcontr]['City']=="Ahmedabad") && $Is_Valid==1 && $age>28)
{  
	$Dated = ExactServerdate();
	$insertArray = array('komli_uniqueid'=>$plrequestid, 'komli_email'=>$plrow[$plrowcontr]['Email'], 'komli_city'=>$plrow[$plrowcontr]['City'], 'komli_date'=>$Dated, 'komli_netsalary'=>$plrow[$plrowcontr]['Net_Salary'], 'vendor_name'=>$plrow[$plrowcontr]['source'], 'validated'=>$Is_Valid);
	$insert = Maininsertfunc ('komli_plcompaign', $insertArray);

?>
<!-- Offer Conversion: Deals 4 Loan --> <iframe src="http://buzzindia.go2cloud.org/aff_l?offer_id=88" scrolling="no" frameborder="0" width="1" height="1"></iframe>
<!-- // End Offer Conversion -->
<?
}
else if(($plrow[$plrowcontr]['source']=="AFL_MLR_LEADSUTRA_PL") && $plrow[$plrowcontr]['Net_Salary']>=450000 && ($plrow[$plrowcontr]['City']=="Delhi" || $plrow[$plrowcontr]['City']=="Noida" || $plrow[$plrowcontr]['City']=="Gurgaon" || $plrow[$plrowcontr]['City']=="Gaziabad" || $plrow[$plrowcontr]['City']=="Faridabad" || $plrow[$plrowcontr]['City']=="Mumbai" || $plrow[$plrowcontr]['City']=="Thane" || $plrow[$plrowcontr]['City']=="Navi Mumbai" || $plrow[$plrowcontr]['City']=="Pune" || $plrow[$plrowcontr]['City']=="Chennai" || $plrow[$plrowcontr]['City']=="Bangalore" || $plrow[$plrowcontr]['City']=="Coimbatore" || $plrow[$plrowcontr]['City']=="Hyderabad" || $plrow[$plrowcontr]['City']=="Ahmedabad") && $Is_Valid==1 && $age>28)
{
	$Dated = ExactServerdate();
	$insertArray = array('komli_uniqueid'=>$plrequestid, 'komli_email'=>$plrow[$plrowcontr]['Email'], 'komli_city'=>$plrow[$plrowcontr]['City'], 'komli_date'=>$Dated, 'komli_netsalary'=>$plrow[$plrowcontr]['Net_Salary'], 'vendor_name'=>$plrow[$plrowcontr]['source'], 'validated'=>$Is_Valid);
	$insert = Maininsertfunc ('komli_plcompaign', $insertArray);	
	?>
	<!-- Offer Conversion: Deal4Loans - PL -->
	<img src="http://leadsutra.go2cloud.org/aff_l?offer_id=228&adv_sub=<?php echo $plrequestid; ?>" width="1" height="1" />
	<!-- // End Offer Conversion -->
<? }
else if(($plrow[$plrowcontr]['source']=="AFL_MLR_PROFILIAD_PL" || $plrow[$plrowcontr]['source']=="AFL_D4LMLR_LUCINI_PL") && $plrow[$plrowcontr]['Net_Salary']>=450000 && ($plrow[$plrowcontr]['City']=="Delhi" || $plrow[$plrowcontr]['City']=="Noida" || $plrow[$plrowcontr]['City']=="Gurgaon" || $plrow[$plrowcontr]['City']=="Gaziabad" || $plrow[$plrowcontr]['City']=="Faridabad" || $plrow[$plrowcontr]['City']=="Mumbai" || $plrow[$plrowcontr]['City']=="Thane" || $plrow[$plrowcontr]['City']=="Navi Mumbai" || $plrow[$plrowcontr]['City']=="Pune" || $plrow[$plrowcontr]['City']=="Chennai" || $plrow[$plrowcontr]['City']=="Bangalore" || $plrow[$plrowcontr]['City']=="Coimbatore" || $plrow[$plrowcontr]['City']=="Hyderabad" || $plrow[$plrowcontr]['City']=="Ahmedabad") && $Is_Valid==1 && $age>28)
{  
	$Dated = ExactServerdate();
	$insertArray = array('komli_uniqueid'=>$plrequestid, 'komli_email'=>$plrow[$plrowcontr]['Email'], 'komli_city'=>$plrow[$plrowcontr]['City'], 'komli_date'=>$Dated, 'komli_netsalary'=>$plrow[$plrowcontr]['Net_Salary'], 'vendor_name'=>$plrow[$plrowcontr]['source'], 'validated'=>$Is_Valid);
	$insert = Maininsertfunc ('komli_plcompaign', $insertArray);
	if($plrow[$plrowcontr]['source']=="AFL_MLR_PROFILIAD_PL")
	{
?>
<iframe src="http://proadsnet.com/p.ashx?a=40&e=63&t=<?php echo $plrequestid; ?>" height="1" width="1" frameborder="0"></iframe>
<?
	}
elseif($plrow[$plrowcontr]['source']=="AFL_D4LMLR_LUCINI_PL")
	{ ?>
		<!--<img src="http://lead.adsender.us/127054/0.png" width="1" height="1" />-->
		<img src="http://lead.adsender.us/127905/0.png" width="1" height="1" />
	<? }
	else{}
}
elseif($plrow[$plrowcontr]['source']=="pkonlinepl" && $plrow[$plrowcontr]['Net_Salary']>=400000 && ($plrow[$plrowcontr]['City']=="Delhi" || $plrow[$plrowcontr]['City']=="Noida" || $plrow[$plrowcontr]['City']=="Gurgaon" || $plrow[$plrowcontr]['City']=="Gaziabad" || $plrow[$plrowcontr]['City']=="Faridabad" || $plrow[$plrowcontr]['City']=="Mumbai" || $plrow[$plrowcontr]['City']=="Thane" || $plrow[$plrowcontr]['City']=="Navi Mumbai" || $plrow[$plrowcontr]['City']=="Pune" || $plrow[$plrowcontr]['City']=="Chennai" || $plrow[$plrowcontr]['City']=="Bangalore" || $plrow[$plrowcontr]['City']=="Kolkata" || $plrow[$plrowcontr]['City']=="Hyderabad" || $plrow[$plrowcontr]['City']=="Ahmedabad") && $Is_Valid==1 && $age>27)
{ $uniqueid=$plrequestid; 
$Dated = ExactServerdate();
	$insertArray = array('komli_uniqueid'=>$plrequestid, 'komli_email'=>$plrow[$plrowcontr]['Email'], 'komli_city'=>$plrow[$plrowcontr]['City'], 'komli_date'=>$Dated, 'komli_netsalary'=>$plrow[$plrowcontr]['Net_Salary'], 'vendor_name'=>$plrow[$plrowcontr]['source'], 'validated'=>$Is_Valid);
	$insert = Maininsertfunc ('komli_plcompaign', $insertArray);
 ?>
<!-- Offer Conversion: Deal4loans_CPL_Sep\'15 -->
<img src="http://vuroll.in/p.ashx?o=2348&e=254&f=img&t=<?php echo $uniqueid; ?>" width="1" height="1" border="0" />
<!-- // End Offer Conversion -->
<? }
elseif($plrow[$plrowcontr]['source']=="AFL_MLR_OPICLE_PL" && $plrow[$plrowcontr]['Net_Salary']>=400000 && ($plrow[$plrowcontr]['City']=="Delhi" || $plrow[$plrowcontr]['City']=="Noida" || $plrow[$plrowcontr]['City']=="Gurgaon" || $plrow[$plrowcontr]['City']=="Gaziabad" || $plrow[$plrowcontr]['City']=="Faridabad" || $plrow[$plrowcontr]['City']=="Mumbai" || $plrow[$plrowcontr]['City']=="Thane" || $plrow[$plrowcontr]['City']=="Navi Mumbai" || $plrow[$plrowcontr]['City']=="Pune" || $plrow[$plrowcontr]['City']=="Chennai" || $plrow[$plrowcontr]['City']=="Bangalore" || $plrow[$plrowcontr]['City']=="Kolkata" || $plrow[$plrowcontr]['City']=="Hyderabad" || $plrow[$plrowcontr]['City']=="Ahmedabad") && $Is_Valid==1 && $age>27)
{ $uniqueid=$plrequestid; 
$Dated = ExactServerdate();
	$insertArray = array('komli_uniqueid'=>$plrequestid, 'komli_email'=>$plrow[$plrowcontr]['Email'], 'komli_city'=>$plrow[$plrowcontr]['City'], 'komli_date'=>$Dated, 'komli_netsalary'=>$plrow[$plrowcontr]['Net_Salary'], 'vendor_name'=>$plrow[$plrowcontr]['source'], 'validated'=>$Is_Valid);
	$insert = Maininsertfunc ('komli_plcompaign', $insertArray);
 ?>
<!-- Offer Conversion: Deal4Loans PL CPL -->
<img src="http://track.opicle.com/aff_l?offer_id=1361&adv_sub=<?php echo $uniqueid; ?>" width="1" height="1" />
<!-- // End Offer Conversion -->
<? }
elseif(($plrow[$plrowcontr]['source']=="ammv3pl" || $plrow[$plrowcontr]['source']=="ammbctpl") && $plrow[$plrowcontr]['Net_Salary']>=400000 && ($plrow[$plrowcontr]['City']=="Delhi" || $plrow[$plrowcontr]['City']=="Noida" || $plrow[$plrowcontr]['City']=="Gurgaon" || $plrow[$plrowcontr]['City']=="Gaziabad" || $plrow[$plrowcontr]['City']=="Faridabad" || $plrow[$plrowcontr]['City']=="Mumbai" || $plrow[$plrowcontr]['City']=="Thane" || $plrow[$plrowcontr]['City']=="Navi Mumbai" || $plrow[$plrowcontr]['City']=="Pune" || $plrow[$plrowcontr]['City']=="Chennai" || $plrow[$plrowcontr]['City']=="Bangalore" || $plrow[$plrowcontr]['City']=="Kolkata" || $plrow[$plrowcontr]['City']=="Hyderabad" || $plrow[$plrowcontr]['City']=="Ahmedabad") && $Is_Valid==1 && $age>27)
{ $uniqueid=$plrequestid; 
$Dated = ExactServerdate();
	$insertArray = array('komli_uniqueid'=>$plrequestid, 'komli_email'=>$plrow[$plrowcontr]['Email'], 'komli_city'=>$plrow[$plrowcontr]['City'], 'komli_date'=>$Dated, 'komli_netsalary'=>$plrow[$plrowcontr]['Net_Salary'], 'vendor_name'=>$plrow[$plrowcontr]['source'], 'validated'=>$Is_Valid);
	$insert = Maininsertfunc ('komli_plcompaign', $insertArray);
 ?>
<? }
elseif(($plrow[$plrowcontr]['source']=="AFL_MLR_OPTMED_PL") && $plrow[$plrowcontr]['Net_Salary']>=400000 && ($plrow[$plrowcontr]['City']=="Delhi" || $plrow[$plrowcontr]['City']=="Noida" || $plrow[$plrowcontr]['City']=="Gurgaon" || $plrow[$plrowcontr]['City']=="Gaziabad" || $plrow[$plrowcontr]['City']=="Faridabad" || $plrow[$plrowcontr]['City']=="Mumbai" || $plrow[$plrowcontr]['City']=="Thane" || $plrow[$plrowcontr]['City']=="Navi Mumbai" || $plrow[$plrowcontr]['City']=="Pune" || $plrow[$plrowcontr]['City']=="Chennai" || $plrow[$plrowcontr]['City']=="Bangalore" || $plrow[$plrowcontr]['City']=="Kolkata" || $plrow[$plrowcontr]['City']=="Hyderabad" || $plrow[$plrowcontr]['City']=="Ahmedabad") && $Is_Valid==1 && $age>27)
{ $uniqueid=$plrequestid; 
$Dated = ExactServerdate();
	$insertArray = array('komli_uniqueid'=>$plrequestid, 'komli_email'=>$plrow[$plrowcontr]['Email'], 'komli_city'=>$plrow[$plrowcontr]['City'], 'komli_date'=>$Dated, 'komli_netsalary'=>$plrow[$plrowcontr]['Net_Salary'], 'vendor_name'=>$plrow[$plrowcontr]['source'], 'validated'=>$Is_Valid);
	$insert = Maininsertfunc ('komli_plcompaign', $insertArray);
 ?>
 <? }
elseif(($plrow[$plrowcontr]['source']=="AFL_MLR_POINTIFIC_PL") && $plrow[$plrowcontr]['Net_Salary']>=400000 && ($plrow[$plrowcontr]['City']=="Delhi" || $plrow[$plrowcontr]['City']=="Noida" || $plrow[$plrowcontr]['City']=="Gurgaon" || $plrow[$plrowcontr]['City']=="Gaziabad" || $plrow[$plrowcontr]['City']=="Faridabad" || $plrow[$plrowcontr]['City']=="Mumbai" || $plrow[$plrowcontr]['City']=="Thane" || $plrow[$plrowcontr]['City']=="Navi Mumbai" || $plrow[$plrowcontr]['City']=="Pune" || $plrow[$plrowcontr]['City']=="Chennai" || $plrow[$plrowcontr]['City']=="Bangalore" || $plrow[$plrowcontr]['City']=="Kolkata" || $plrow[$plrowcontr]['City']=="Hyderabad" || $plrow[$plrowcontr]['City']=="Ahmedabad") && $Is_Valid==1 && $age>27)
{ $uniqueid=$plrequestid; 
$Dated = ExactServerdate();
	$insertArray = array('komli_uniqueid'=>$plrequestid, 'komli_email'=>$plrow[$plrowcontr]['Email'], 'komli_city'=>$plrow[$plrowcontr]['City'], 'komli_date'=>$Dated, 'komli_netsalary'=>$plrow[$plrowcontr]['Net_Salary'], 'vendor_name'=>$plrow[$plrowcontr]['source'], 'validated'=>$Is_Valid);
	$insert = Maininsertfunc ('komli_plcompaign', $insertArray);
 ?>
 <img src="http://pointificsecure.com/p.ashx?o=660&e=357&f=img&t=TRANSACTION_ID" width="1" height="1" border="0" />
<? }
elseif(($plrow[$plrowcontr]['source']=="svgmediapl") && $plrow[$plrowcontr]['Net_Salary']>=400000 && ($plrow[$plrowcontr]['City']=="Delhi" || $plrow[$plrowcontr]['City']=="Noida" || $plrow[$plrowcontr]['City']=="Gurgaon" || $plrow[$plrowcontr]['City']=="Gaziabad" || $plrow[$plrowcontr]['City']=="Faridabad" || $plrow[$plrowcontr]['City']=="Mumbai" || $plrow[$plrowcontr]['City']=="Thane" || $plrow[$plrowcontr]['City']=="Navi Mumbai" || $plrow[$plrowcontr]['City']=="Pune" || $plrow[$plrowcontr]['City']=="Chennai" || $plrow[$plrowcontr]['City']=="Bangalore" || $plrow[$plrowcontr]['City']=="Kolkata" || $plrow[$plrowcontr]['City']=="Hyderabad" || $plrow[$plrowcontr]['City']=="Ahmedabad") && $Is_Valid==1 && $age>27)
{ $uniqueid=$plrequestid; 
$Dated = ExactServerdate();
	$insertArray = array('komli_uniqueid'=>$plrequestid, 'komli_email'=>$plrow[$plrowcontr]['Email'], 'komli_city'=>$plrow[$plrowcontr]['City'], 'komli_date'=>$Dated, 'komli_netsalary'=>$plrow[$plrowcontr]['Net_Salary'], 'vendor_name'=>$plrow[$plrowcontr]['source'], 'validated'=>$Is_Valid);
	$insert = Maininsertfunc ('komli_plcompaign', $insertArray);
 ?>
 <script src="https://www.s2d6.com/js/globalpixel.js?x=sp&a=265&h=67736&o=<? echo $uniqueid; ?>&g=pl&s=0.00&q=1"></script>
<? }
elseif(($plrow[$plrowcontr]['source']=="AFL_MLR_AD2CLICK_PL") && $plrow[$plrowcontr]['Net_Salary']>=400000 && ($plrow[$plrowcontr]['City']=="Delhi" || $plrow[$plrowcontr]['City']=="Noida" || $plrow[$plrowcontr]['City']=="Gurgaon" || $plrow[$plrowcontr]['City']=="Gaziabad" || $plrow[$plrowcontr]['City']=="Faridabad" || $plrow[$plrowcontr]['City']=="Mumbai" || $plrow[$plrowcontr]['City']=="Thane" || $plrow[$plrowcontr]['City']=="Navi Mumbai" || $plrow[$plrowcontr]['City']=="Pune" || $plrow[$plrowcontr]['City']=="Chennai" || $plrow[$plrowcontr]['City']=="Bangalore" || $plrow[$plrowcontr]['City']=="Kolkata" || $plrow[$plrowcontr]['City']=="Hyderabad" || $plrow[$plrowcontr]['City']=="Ahmedabad" || $plrow[$plrowcontr]['City']=="Vadodara" || $plrow[$plrowcontr]['City']=="Kochi" || $plrow[$plrowcontr]['City']=="Jaipur" || $plrow[$plrowcontr]['City']=="Chandigarh" || $plrow[$plrowcontr]['City']=="Coimbatore" || $plrow[$plrowcontr]['City']=="Ludhiana" || $plrow[$plrowcontr]['City']=="Surat" || $plrow[$plrowcontr]['City']=="Bhopal" || $plrow[$plrowcontr]['City']=="Indore" || $plrow[$plrowcontr]['City']=="Lucknow" || $plrow[$plrowcontr]['City']=="Nasik") && $Is_Valid==1 && $age>27)
{ $uniqueid=$plrequestid; 
$Dated = ExactServerdate();
if($pubid>0)
	{
		$pubid=$pubid;
	} else {$pubid=0;}
	$insertArray = array('komli_uniqueid'=>$plrequestid, 'komli_email'=>$plrow[$plrowcontr]['Email'], 'komli_city'=>$plrow[$plrowcontr]['City'], 'komli_date'=>$Dated, 'komli_netsalary'=>$plrow[$plrowcontr]['Net_Salary'], 'vendor_name'=>$plrow[$plrowcontr]['source'], 'validated'=>$Is_Valid, "pubid"=>$pubid);
	$insert = Maininsertfunc ('komli_plcompaign', $insertArray);
 ?>
 <!-- Offer Conversion: Deal4Loans -->
<iframe src="https://ad2click.go2cloud.org/SL16U" scrolling="no" frameborder="0" width="1" height="1"></iframe>
<!-- // End Offer Conversion -->

<? }
?>
</body>
</html>