<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	
	$sql ="select City,Employment_Status,EMI_Paid,source From Req_Loan_Personal Where (RequestID=".$_SESSION['Temp_LID'].")";
	list($CheckNumRows,$flg)=Mainselectfunc($sql,$array = array());
	$sourcepg= $flg["source"];
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<link href="css/common-d4l-styles.css" type="text/css" rel="stylesheet"  />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'>  
<title>Apply for Personal Loan | Personal Loans Online Apply India |Deal4Loans</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<meta name="keywords" content="Apply Personal Loans, personal loans apply, online personal loan apply, apply personal loan india">
<meta name="description" content="Apply Online Personal Loans through Deal4loans.com Get instant information on personal loans banks like Mumbai, Delhi, Noida, Kolkata, Gurgaon, Bangalore, Chennai, Hyderabad.">
<link href="source.css" rel="stylesheet" type="text/css" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
 <script type="text/javascript" src="scripts/mainmenu.js"></script>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script type="text/javascript" src="scripts/mootools.js"></script>
 <script type="text/javascript" src="ajax.js"></script>
<script type="text/javascript" src="ajax-dynamic-list.js"></script>
<style type="text/css">
<!--
.red {color:#F00;}
-->
</style>
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

</style>
<script type="text/javascript">
window.addEvent('domready', function(){
var accordion = new Accordion('h3.atStart', 'div.atStart', {
opacity: false,
onActive: function(toggler, element){
toggler.setStyle('color', '#0b3154');
},

onBackground: function(toggler, element){
toggler.setStyle('color', '#0b3154');
}
}, $('accordion'));

//This is for default selected optio		
var newTog = new Element('h3', {'class': 'toggler1'}).setHTML('');

var newEl = new Element('div', {'class': 'element1'}).setHTML('');

accordion.addSection(newTog, newEl, 0);
}); 

//
</script>
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
function onFocusBlank(element,defaultVal){
	if(element.value==defaultVal){
		element.value="";
	}
}

function onBlurDefault(element,defaultVal){
	if(element.value==""){
		element.value = defaultVal;
	}
}


function HandleOnClose(filename) {
   if ((event.clientY < 0)) {
	
	   
	   myWindow = window.open(filename, "tinyWindow", 'resizable width=510,height=390, scrollbars')
	   myWindow.document.bgColor=""
	   myWindow.document.close() 
   }
}

function addElementLoan()
{
		var ni = document.getElementById('myDivLoan');
		
		if(ni.innerHTML=="")
		{	
				ni.innerHTML = '<table width="100%" border="0" align="left" cellpadding="0" cellspacing="0"><tr><td height="20" align="left" class="bldtxt">Any type of loan(s) running? </td><td colspan="3" align="left"  style="color:#000000;" ><table width="100%" border="0" align="left" cellpadding="0" cellspacing="0"  style="color:#000000;"><tr> <td    height="20" align="left" ><input type="checkbox" style="border:none;" id="Loan_Any" name="Loan_Any[]"  value="hl" /> Home</td><td align="left"><input type="checkbox" style="border:none;"  id="Loan_Any" name="Loan_Any[]" value="pl" /> Personal</td><td align="left"><input type="checkbox" style="border:none;" name="Loan_Any[]" id="Loan_Any"  value="other" /> Other</td></tr><tr> <td  width="71" height="20" align="left" ><input type="checkbox" style="border:none;"  name="Loan_Any[]"  id="Loan_Any" value="cl" /> Car</td><td width="93" align="left"  ><input type="checkbox" style="border:none;" name="Loan_Any[]" id="Loan_Any"  value="lap" /> Property</td><td width="160" align="left"  ><input type="checkbox" style="border:none;" name="Loan_Any[]" id="Loan_Any"  value="cdl" />Consumer Durable</td></tr></table></td></tr><tr><td align="left" height="30" class="bldtxt">How many EMI paid?  </td> <td colspan="3"  align="left"><select name="EMI_Paid"  class="emi_input" > <option value="0">Please select</option><option value="1">Less than 6 months</option> <option value="2">6 to 9 months</option> <option value="3">9 to 12 months</option> <option value="4">more than 12 months</option ></select></td></tr></table>';			
		}
		
		return true;
}

function removeElementLoan()
{
		var ni = document.getElementById('myDivLoan');
		
		if(ni.innerHTML!="")
		{		
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '';			
		}
		
		return true;
	}

	function submitform(Form)
	{

var btn2;
	var btn3;
	var myOption;
	var i;
	var incpf;
	if(Form.Primary_Acc.value=="")
		{
			alert("Please fill your Salary Account.");
			Form.Primary_Acc.focus();
			return false;
		}
<?		if($flg['Employment_Status']==0) 
		{ ?>
if(Form.professional_details.selectedIndex==0)
{
	alert("Please enter Professional Details to Continue");
	Form.professional_details.focus();
	return false;
}
	<?	}
		else
		{ ?>
	if(Form.Company_Type.selectedIndex==0)
{
	alert("Please enter Company Type to Continue");
	Form.Company_Type.focus();
	return false;
}
<? } ?>
	if (Form.Years_In_Company.value=="")
	{
		alert("Please enter Years in Company.");
		Form.Years_In_Company.focus();
		return false;
	}	
	if(!checkNum(Form.Years_In_Company, 'No of years in current company',0))
		return false;

	if (Form.Total_Experience.value=="")
	{
		alert("Please enter Total Experience.");
		Form.Total_Experience.focus();
		return false;
	}	
	if(!checkNum(Form.Total_Experience, 'Total Experience',0))
		return false;
<?
if($flg["EMI_Paid"]>0)
		{ } 
else 
		{?>
		myOption = -1;
		for (i=Form.LoanAny.length-1; i > -1; i--) {
			if (Form.LoanAny[i].checked) {
				if(i==0)
				{
					btn2=valButtonLoan();
					if(!btn2)
					{
						alert('Type of loan running.');
						return false;
					}
					if(Form.EMI_Paid.selectedIndex==0)
					{
						alert('No of EMI paid.');
						Form.EMI_Paid.focus();
						return false;
					}
				}
				myOption = i;
			}
		}
		if(myOption == -1) 
		{
			alert("You must select a Loan Any button");
			return false;
		}
		<? } ?>
		
incpf=incomeproof();
if((!incpf))
		{
			alert('please select the documents that you have or can arrange.');
						return false;
		}
	return true;
}

function valButtonLoan() {
    var cnt = -1;
	var i;
    for(i=0; i<document.personalloan_form.Loan_Any.length; i++) 
	{
        if(document.personalloan_form.Loan_Any[i].checked)
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

function incomeproof() {
    var cnt = -1;
	var i;
    for(i=0; i<document.personalloan_form.Document_proof.length; i++) 
	{
        if(document.personalloan_form.Document_proof[i].checked)
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
	var ni = document.getElementById('myDiv');
	 var newdiv = document.createElement('div');
	if(ni.innerHTML=="")
		{
			ni.innerHTML = '<table border="0"><tr><td height="25">Reconfirm Mobile No.</td>	<td width="158" ><input size="18" type="text" style="margin-left:8px;" maxlength="10"  name="RePhone" id="RePhone"></td></tr></table>';
			ni.appendChild(newdiv);
		}
		else if(ni.innerHTML!="")
		{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '';
		}
		//return true;
		}

function askfordoc()
{
var answer = confirm ("Please select the documents that you have or can arrange.")
	if (answer)
	{
	}
	else
	{
	form.submit();
	}
}

</script>
<style>
.bnk_logo{
	width:105px;
	height:35px;
	padding-left:4px;
	padding-top:0px;
	*padding-top:11px;
}

.colprop{
color:#373737;
font-family:Verdana,Arial,Helvetica,sans-serif;
font-size:11px;
line-height:15px;

}
</style>
</head>
<body>
<!--top-->
<!--logo navigation-->
<?php include "middle-menu.php"; ?>
<div style="clear:both; height:70px;"></div>
<!--logo navigation-->
<div class="lac-main-wrapper">
<div class="text12"><u><a href="index.php" class="text12" style="color:#0080d6;" >Home</a></u> > <a href="#"  class="text12" style="color:#0080d6;"><u>Personal Loan</u></a> <a href="#"  class="text12" style="color:#4c4c4c;">> Apply for Personal Loan</a></div>
<div style="clear:both; height:15px;"></div>
<div class="text12">
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
	<tr>               
       <td align="center" valign="middle" style="color: #643E02; font-weight:bold; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; ">60% of your application for quote from all Banks is complete.</td>            
      </tr>
	  <tr>
	   <td align="center" >&nbsp;</td>            
      </tr>	  
      <tr>               
       <td align="center" valign="middle" ><img src="/new-images/hl/ajax-loader.gif" width="220" height="19" /></td>
      </tr>
	   <tr>
	   <td align="center" >&nbsp;</td>            
      </tr>
	  <tr>               
       <td align="center" valign="middle" style="color: #136071; font-weight:bold; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; ">Share few more details to get exact quote on Emi,Rates & Loan Amount.
</td>            
      </tr>
    </table></td>
  </tr>
  <tr>
    <td valign="top" style="padding-top:8px; "><table width="97%"  border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td valign="top">
   <div class="common-from-cont-wrapper">
   <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="21" style="border-top:1px solid #d4d4d4 ">&nbsp;</td>
    </tr>
  <tr>
    <td><form name="personalloan_form"  action="insert_personal_loan_value_step2.php" method="POST" onsubmit="return submitform(document.personalloan_form); ">
      <input type="hidden" value="<? echo $_SESSION['Temp_LID'];?>" name="leadid" />
      <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
        
        <tr align="center" bgcolor="#f4f4f4">
          <td height="35" colspan="2" class="bldtxt" style="font-size:13px; font-family:Verdana, Arial, Helvetica, sans-serif; "> Personal Loan Quote Request</td>
          </tr>
        <tr>
          <td height="10" colspan="2" ></td>
          </tr>
        <tr>
          <td width="35%" height="35" align="left" class="bldtxt">Primary Account 
            in which bank?  </td>
          <td width="65%" height="20"  align="left"><input type="text" class="emi_input" name="Primary_Acc" id="Primary_Acc" onkeyup="ajax_showOptions(this,'getCountriesByLetters',event); getstatementlink();" onchange="getstatementlink();" onkeydown="getstatementlink();" onclick="getstatementlink();"></td>
          </tr>
        <? if($flg['Employment_Status']==0) 
		   { } 
		   else 
		   { ?> 
        <tr>
          <td height="20" align="left" class="bldtxt">Residential Status </td>
          <td  align="left" ><table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
            <tr>
              <td width="6%" ><input type="radio" style="border:none;" value="1" name="Residential_Status"  checked="checked" /></td>
              <td width="19%" style="color:#000000;" >                        Owned</td>
              <td width="6%" ><input type="radio" style="border:none;" value="2" name="Residential_Status" /></td>
              <td width="19%" style="color:#000000;" >                        Rented</td>
              <td width="6%" ><input type="radio" style="border:none;" value="3" name="Residential_Status" /></td>
              <td width="44%" style="color:#000000;" > Company Provided</td>
              </tr>
            </table></td>
          </tr>
        <tr>
          <td height="35" class="bldtxt">Company Type</td>
          <td class="frmtxt"><select name="Company_Type" id="Company_Type" class="emi_select">
            <option value="0">Please Select</option>
            <option value="1">Pvt Ltd</option>
            <option value="2">MNC Pvt Ltd</option>
            <option value="3">Limited</option>
            
            <option value="4">Govt.( Central/State )</option>
            <option value="5">PSU (Public sector Undertaking)</option>
            </select></td>
          </tr>  
        <? } ?>
        <? if($flg['Employment_Status']==0) 
		   { ?>
        <tr>
          <td height="35" class="bldtxt">Professional details</td>
<td class="frmtxt"><select name="professional_details" id="professional_details" class="emi_input">
            <option value="0">Please Select</option>
            <option value="1">Businessmen</option>
            <option value="2">Doctor</option>
            <option value="3">Engineer</option>
            <option value="4">Architect</option>
            <option value="5">Chartered Accountant</option>
            </select></td>
          </tr>  
        <? }
		   ?>
        <tr>
          <td height="35" align="left" class="bldtxt" ><? if($flg['Employment_Status']==0) 
		   { echo "Current Business Stability (in Years)"; } else { echo "No. of years in this Company"; } ?></td>
          <td align="left" ><input type="text" name="Years_In_Company" class="emi_input" maxlength="15"></td>
          </tr>
        <tr>
          <td height="42" align="left" class="bldtxt" >Total Experience (Years)/
            Total Years  
            in Business</td>
          <td align="left" ><input class="emi_input"  name="Total_Experience" onfocus="this.select();">              </td>
          </tr>
        <tr>
          <td colspan="2"><input type="hidden" value="PersonalLoan" name="type" /></td>
          </tr>
        <?   if($flg["EMI_Paid"]>0)
{ ?>
        <input type="hidden" name="EMI_Paid" id="EMI_Paid"  value="<? echo $flg["EMI_Paid"]; ?>">
        <?}
else
{
?>      <tr>
          <td height="30" align="left" class="bldtxt" >Any Loan running?</td>
          <td align="left" style="color:#000000;" ><input type="radio" style="border:none;"  value="1"  name="LoanAny"  onclick="addElementLoan(); addDiv();" /> Yes &nbsp;  <input size="10" type="radio" style="border:none;" name="LoanAny"  onclick="removeElementLoan();" value="0"> No</td>
          </tr>
        <tr>
          <td colspan="2" id="myDivLoan"></td>
          </tr>
        <? }?>
        
        <tr>
          <td height="35" colspan="2" align="center"><input type="image" name="Submit"  src="/new-images/pl/quote.gif"  style="width:115px; height:29px; border:none; " /></td>
          </tr>
        </table>
    </form></td>
    </tr>
  <tr>
    <td height="21"  style="border-bottom:1px solid #d4d4d4 ">&nbsp;</td>
    </tr>
</table>
   </div>
   
   


</td>    
      </tr>
    </table></td>
  </tr>
</table>
</div>
<div style="clear:both; height:15px;"></div>
</div>
<? 
 if($flg["source"]=="requestpersonal-mobile" || $flg["source"]=="PLForm_sept")
	 { //echo "entered";?>
		<!-- Google Code for lead Conversion Page -->
		<script type="text/javascript">
		/* <![CDATA[ */
		var google_conversion_id = 1066264455;
		var google_conversion_language = "en";
		var google_conversion_format = "3";
		var google_conversion_color = "ffffff";
		var google_conversion_label = "UcZECLrjrlYQh8-3_AM";
		var google_remarketing_only = false;
		/* ]]> */
		</script>
		<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
		</script>
        </div>
		<noscript>
		<div style="display:inline;">
		<img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/1066264455/?label=UcZECLrjrlYQh8-3_AM&amp;guid=ON&amp;script=0"/>
		</div>
		</noscript>
	 <?  } 
?>
<?php include "footer_sub_menu.php"; ?>
<?
 
	 
 if((strlen(strpos($_SERVER['HTTP_REFERER'], "laptop-apply-for-personal-loans.php")) > 0))
	 { ?>	 

<!-- Google Code for Laptop Conversion Page -->
<script type="text/javascript">
<!--
var google_conversion_id = 1066264455;
var google_conversion_language = "en_US";
var google_conversion_format = "1";
var google_conversion_color = "ffffff";
var google_conversion_label = "ZdyQCIPJiQEQh8-3_AM";
var google_conversion_value = 0;
if (1.0) {
  google_conversion_value = 1.0;
}
//-->
</script>
<script type="text/javascript" src="http://www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="http://www.googleadservices.com/pagead/conversion/1066264455/?value=1.0&amp;label=ZdyQCIPJiQEQh8-3_AM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>

	
	 <?  }
 elseif((strlen(strpos($_SERVER['HTTP_REFERER'], "desktop-apply-for-personal-loans.php")) > 0))
	 {?>

<!-- Google Code for Desktop Conversion Page -->
<script type="text/javascript">
<!--
var google_conversion_id = 1066264455;
var google_conversion_language = "en";
var google_conversion_format = "2";
var google_conversion_color = "ffffff";
var google_conversion_label = "17L4CJXKqAEQh8-3_AM";
var google_conversion_value = 0;
//-->
</script>
<script type="text/javascript" src="http://www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="http://www.googleadservices.com/pagead/conversion/1066264455/?label=17L4CJXKqAEQh8-3_AM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>

	 <? 
	 }
	
  else if((strlen(strpos($_SERVER['HTTP_REFERER'], "lcd-apply-for-personal-loans.php")) > 0))
	  {?>

<!-- Google Code for LCD Conversion Page -->
<script type="text/javascript">
<!--
var google_conversion_id = 1066264455;
var google_conversion_language = "en";
var google_conversion_format = "2";
var google_conversion_color = "ffffff";
var google_conversion_label = "1PcVCNPTnQEQh8-3_AM";
var google_conversion_value = 0;
//-->
</script>
<script type="text/javascript" src="http://www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="http://www.googleadservices.com/pagead/conversion/1066264455/?label=1PcVCNPTnQEQh8-3_AM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>

 <? 
	 }
	
	   else if((strlen(strpos($_SERVER['HTTP_REFERER'], "tft-apply-for-personal-loans")) > 0))
	  { ?>

<!-- Google Code for TFT Conversion Page -->
<script type="text/javascript">
<!--
var google_conversion_id = 1066264455;
var google_conversion_language = "en";
var google_conversion_format = "2";
var google_conversion_color = "ffffff";
var google_conversion_label = "3Qh4CJ-bogEQh8-3_AM";
var google_conversion_value = 0;
//-->
</script>
<script type="text/javascript" src="http://www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="http://www.googleadservices.com/pagead/conversion/1066264455/?label=3Qh4CJ-bogEQh8-3_AM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>

 <? 
	 }
	
	   else if((strlen(strpos($_SERVER['HTTP_REFERER'], "personal-loans-emi.php")) > 0))
	  {?>

<!-- Google Code for EMI PL Conversion Page -->
<script type="text/javascript">
<!--
var google_conversion_id = 1066264455;
var google_conversion_language = "en_US";
var google_conversion_format = "1";
var google_conversion_color = "ffffff";
var google_conversion_label = "106RCMmqkAEQh8-3_AM";
var google_conversion_value = 0;
if (1.0) {
  google_conversion_value = 1.0;
}
//-->
</script>
<script type="text/javascript" src="http://www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="http://www.googleadservices.com/pagead/conversion/1066264455/?value=1.0&amp;label=106RCMmqkAEQh8-3_AM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>


 <? 
	 }
	
	   else if((strlen(strpos($_SERVER['HTTP_REFERER'], "news-apply-personal-loans.php")) > 0))
	  {?>

<!-- Google Code for retire-content Conversion Page -->
<script type="text/javascript">
<!--
var google_conversion_id = 1066264455;
var google_conversion_language = "en_US";
var google_conversion_format = "1";
var google_conversion_color = "ffffff";
var google_conversion_label = "pAZBCO3KkgEQh8-3_AM";
var google_conversion_value = 0;
//-->
</script>
<script type="text/javascript" src="http://www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="http://www.googleadservices.com/pagead/conversion/1066264455/?label=pAZBCO3KkgEQh8-3_AM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>

 <? 
	 }
	
	   else if((strlen(strpos($_SERVER['HTTP_REFERER'], "apply-personal-loans-banks.php")) > 0))
	  {?>

<!-- Google Code for Loans-Only Conversion Page -->
<script type="text/javascript">
<!--
var google_conversion_id = 1066264455;
var google_conversion_language = "en_US";
var google_conversion_format = "1";
var google_conversion_color = "ffffff";
var google_conversion_label = "raymCOnKkwEQh8-3_AM";
var google_conversion_value = 0;
//-->
</script>
<script type="text/javascript" src="http://www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="http://www.googleadservices.com/pagead/conversion/1066264455/?label=raymCOnKkwEQh8-3_AM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>

 <? 
	 }
	
	   elseif((strlen(strpos($_SERVER['HTTP_REFERER'], "fullertonpl-apply-personal-loans.php")) > 0))
	  {?>

<!-- Google Code for Fullerton Conversion Page -->
<script type="text/javascript">
<!--
var google_conversion_id = 1066264455;
var google_conversion_language = "en";
var google_conversion_format = "2";
var google_conversion_color = "ffffff";
var google_conversion_label = "5LbpCJvHaRCHz7f8Aw";
var google_conversion_value = 0;
//-->
</script>
<script type="text/javascript" src="http://www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="http://www.googleadservices.com/pagead/conversion/1066264455/?label=5LbpCJvHaRCHz7f8Aw&amp;guid=ON&amp;script=0"/>
</div>
</noscript>

 <? 
	 }
	
	   elseif((strlen(strpos($_SERVER['HTTP_REFERER'], "barcfinpl-apply-personal-loans.php")) > 0))
	  {?>

<!-- Google Code for Barclays Conversion Page -->
<script type="text/javascript">
<!--
var google_conversion_id = 1066264455;
var google_conversion_language = "en_US";
var google_conversion_format = "2";
var google_conversion_color = "ffffff";
var google_conversion_label = "Vn98CP_niAEQh8-3_AM";
var google_conversion_value = 0;
if (1.0) {
  google_conversion_value = 1.0;
}
//-->
</script>
<script type="text/javascript" src="http://www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="http://www.googleadservices.com/pagead/conversion/1066264455/?value=1.0&amp;label=Vn98CP_niAEQh8-3_AM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>

 <? 
	 }
	
	   elseif((strlen(strpos($_SERVER['HTTP_REFERER'], "hdfcpl-apply-personal-loans.php")) > 0))
	  {?>

<!-- Google Code for HDFC PL Conversion Page -->
<script type="text/javascript">
<!--
var google_conversion_id = 1066264455;
var google_conversion_language = "en_US";
var google_conversion_format = "1";
var google_conversion_color = "ffffff";
var google_conversion_label = "5-E-CM_jjQEQh8-3_AM";
var google_conversion_value = 0;
if (1.0) {
  google_conversion_value = 1.0;
}
//-->
</script>
<script type="text/javascript" src="http://www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="http://www.googleadservices.com/pagead/conversion/1066264455/?value=1.0&amp;label=5-E-CM_jjQEQh8-3_AM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>
 <? 
	 }	
	   elseif((strlen(strpos($_SERVER['HTTP_REFERER'], "citifinpl-apply-personal-loans.php")) > 0))
	  {?>

<!-- Google Code for CITI FIn Conversion Page -->
<script type="text/javascript">
<!--
var google_conversion_id = 1066264455;
var google_conversion_language = "en";
var google_conversion_format = "1";
var google_conversion_color = "666666";
var google_conversion_label = "default";
var google_conversion_value = 0;
//-->
</script>
<script type="text/javascript" src="http://www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="http://www.googleadservices.com/pagead/conversion/1066264455/?label=default&amp;guid=ON&amp;script=0"/>
</div>
</noscript>
 <? 
	 }
	
	   elseif((strlen(strpos($_SERVER['HTTP_REFERER'], "fb-personal-loans.php")) > 0))
	  {?>

<script src="//ah8.facebook.com/js/conversions/tracking.js"></script><script type="text/javascript">
try {
  FB.Insights.impression({
     'id' : 6002449792250,
     'h' : '9fa90dac14'
  });
} catch (e) {}
</script>

 <? } 

?>
<script src="//tt.mbww.com/tt-a5ae3f2dbbf72da099be343eabff98aae7ac71c6f71cf1f1583825c92fd085ba.js" async>
</script>
</body>
</html>