<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functionshttps.php';

$getflag="select City,Employment_Status From Req_Loan_Personal Where (RequestID=".$_SESSION['Temp_LID'].")";
list($CheckNumRows,$flg)=Mainselectfunc($getflag,$array = array());

?>
<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<head>

<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'>  
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Apply for Personal Loan | Personal Loans Online Apply India |Deal4Loans</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<meta name="keywords" content="Apply Personal Loans, personal loans apply, online personal loan apply, apply personal loan india">
<meta name="description" content="Apply Online Personal Loans through Deal4loans.com Get instant information on personal loans banks like Mumbai, Delhi, Noida, Kolkata, Gurgaon, Bangalore, Chennai, Hyderabad.">
<link href="source.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="scripts/mainmenu.js"></script>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script type="text/javascript" src="scripts/mootools.js"></script>
 <script type="text/javascript" src="ajax.js"></script>
<script type="text/javascript" src="ajax-dynamic-list.js"></script>
<link href="landing-page-styles.css" rel="stylesheet" type="text/css">
<link href="landing-page-media-queries.css" rel="stylesheet" type="text/css">
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


</style>


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
		var ni1 = document.getElementById('myDivLoan1');
		var ni2 = document.getElementById('myDivLoan2');
		var ni3 = document.getElementById('myDivLoan3');
		var ni4 = document.getElementById('myDivLoan4');
		

				ni1.innerHTML = 'Any type of loan(s) running?';
				ni2.innerHTML = '<table width="100%" border="0" align="left" cellpadding="0" cellspacing="0"><tr> <td    height="20" align="left" ><input type="checkbox" style="border:none;" id="Loan_Any" name="Loan_Any[]"  value="hl" /> Home</td><td align="left"><input type="checkbox" style="border:none;"  id="Loan_Any" name="Loan_Any[]" value="pl" /> Personal</td><td align="left"><input type="checkbox" style="border:none;" name="Loan_Any[]" id="Loan_Any"  value="cdl" />Consumer Durable</td></tr><tr> <td   height="20" align="left" ><input type="checkbox" style="border:none;"  name="Loan_Any[]"  id="Loan_Any" value="cl" /> Car</td><td  align="left"  ><input type="checkbox" style="border:none;" name="Loan_Any[]" id="Loan_Any"  value="lap" /> Property</td><td align="left"  ><input type="checkbox" style="border:none;" name="Loan_Any[]" id="Loan_Any"  value="other" /> Other</td></tr></table><div id="typeloanVal"></div>';
				ni3.innerHTML = 'How many EMI paid?';
				ni4.innerHTML = '<select name="EMI_Paid" onChange="validateDiv(\'emiVal\');"  > <option value="0">Please select</option><option value="1">Less than 6 months</option> <option value="2">6 to 9 months</option> <option value="3">9 to 12 months</option> <option value="4">more than 12 months</option ></select><div id="emiVal"></div>';
		
		return true;
}

function removeElementLoan()
{
	var ni1 = document.getElementById('myDivLoan1');
	var ni2 = document.getElementById('myDivLoan2');
	var ni3 = document.getElementById('myDivLoan3');
	var ni4 = document.getElementById('myDivLoan4');
	ni1.innerHTML = '';
	ni2.innerHTML = '';
	ni3.innerHTML = '';
	ni4.innerHTML = '';
		
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
			//alert("Please fill your Salary Account.");
			document.getElementById('priAccVal').innerHTML = "<span  class='hintanchor'>Fill your Salary Account!</span>";
			Form.Primary_Acc.focus();
			return false;
		}
	if(Form.Company_Type.selectedIndex==0)
	{
//		alert("Please enter Company Type to Continue");
		document.getElementById('compTypeVal').innerHTML = "<span  class='hintanchor'>Fill Company Type!</span>";
		Form.Company_Type.focus();
		return false;
	}
	if (Form.Years_In_Company.value=="")
	{
//		alert("Please enter Years in Company.");
		document.getElementById('yearsCompVal').innerHTML = "<span  class='hintanchor'>Fill Years in Company!</span>";
		Form.Years_In_Company.focus();
		return false;

	}	
	

	if (Form.Total_Experience.value=="")
	{
//		alert("Please enter Total Experience.");
		document.getElementById('totalExpVal').innerHTML = "<span  class='hintanchor'>Fill Total Experience!</span>";
		Form.Total_Experience.focus();
		return false;
	}	
	
	myOption = -1;
		for (i=Form.LoanAny.length-1; i > -1; i--) {
			if (Form.LoanAny[i].checked) {
				if(i==0)
				{
					btn2=valButtonLoan();
					if(!btn2)
					{
//						alert('Type of loan running.');
						document.getElementById('typeloanVal').innerHTML = "<span  class='hintanchor'>Type of Loan.!</span>";
						return false;
					}
					if(Form.EMI_Paid.selectedIndex==0)
					{
//						alert('No of EMI paid.');
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

function validateDiv(div)
{
	var ni1 = document.getElementById(div);
	ni1.innerHTML = '';
}


</script>
<style>

.alert_msg{color:#FF0000; font-weight:bold; font-size:10px;}
input,select{border:1px solid #878787;margin:0;padding:0}
select:focus, input:focus
{
border:#FF0000 1px solid; 
}
</style>
</head>
<body>
<div id="pagewrap">
<header id="header_continue">
<div id="continue_logo"><img src="new-images/pl/deal4loans-continue-logo.jpg"></div></header>
<div style="clear:both;"></div>
<div class="pl_cont_text">60% of your application for quote from all Banks is complete.</div>
<div class="ajax_loader_box"><img src="new-images/hl/ajax-loader.gif"></div>
<div class="pl_cont_text" style="color:#136071;">Share few more details to get exact quote on Emi, Rates &amp; Loan Amount.</div>
<div id="continue_form" style="margin-top:10px;">
<form name="personalloan_form"  action="insert_personal_loan_value_httpsstep2.php" method="POST" onSubmit="return submitform(document.personalloan_form); ">
	<input type="hidden" value="<? echo $_SESSION['Temp_LID'];?>" name="leadid" />
    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
       <td height="35" colspan="7" align="center" bgcolor="#A0A0A0" class="form_text_pl" style="font-size:13px;">Personal Loan Quote Request</td>
    </tr>
      <tr>
        <td width="51%" height="30" bgcolor="#f4f4f4" class="frmbldtxt">Primary Account in which bank?</td>
        <td colspan="6" bgcolor="#f4f4f4"><input name="Primary_Acc" type="text" class="input_box_s" id="Primary_Acc" onChange="getstatementlink();" onClick="getstatementlink();" onKeyDown="getstatementlink(); validateDiv('priAccVal');" onKeyUp="ajax_showOptions(this,'getCountriesByLetters',event); getstatementlink();"  autocomplete="off" ><div id="priAccVal" class="alert_msg"></div></td>
      </tr>
      <tr >
        <td height="30" class="frmbldtxt">Residential Status</td>
        <td width="5%"  valign="middle"><input type="radio" value="1" name="Residential_Status"  checked="checked" />  
        
      </td>
        <td width="8%">Owned</td>
        <td width="4%"><input type="radio"  value="2" name="Residential_Status" /></td>
        <td width="9%">Rented</td>
        <td width="5%"><input type="radio"  value="3" name="Residential_Status" /></td>
        <td width="28%">Company Provided</td>
      </tr>
	  <tr>
        <td height="30" bgcolor="#f4f4f4" class="frmbldtxt">Company Type</td>
        <td height="30" bgcolor="#f4f4f4" colspan="6"><select name="Company_Type" class="select_input_s" id="Company_Type" onChange="validateDiv('compTypeVal');">
		  <option value="0">Please Select</option>
		  	<option value="1">Pvt Ltd</option>
			<option value="2">MNC Pvt Ltd</option>
			<option value="3">Limited</option>
			 <option value="4">Govt.( Central/State )</option>
		<option value="5">PSU (Public sector Undertaking)</option>
		</select><div id="compTypeVal"></div></td>
      </tr>
	  <? if($flg["Employment_Status"]==0)
	  { ?>
 <tr>
        <td height="30" bgcolor="#f4f4f4" class="frmbldtxt">Professional details</td>
        <td height="30" bgcolor="#f4f4f4" colspan="6"><select name="professional_details" class="select_input_s" id="professional_details" onChange="validateDiv('compTypeVal');">
		  <option value="0">Please Select</option>
		  	<option value="1">Businessmen</option>
			<option value="2">Doctor</option>
			<option value="3">Engineer</option>
			 <option value="4">Architect</option>
		<option value="5">Chartered Accountant</option>
		</select><div id="compTypeVal"></div></td>
      </tr>
	 <? }?>
     
      <tr>
        <td height="30" class="frmbldtxt">No. of years in this Company</td>
        <td colspan="6"><input name="Years_In_Company" type="text" class="input_box_s"  maxlength="15" onKeyDown="validateDiv('yearsCompVal');"  autocomplete="off"><div id="yearsCompVal" class="alert_msg"></div></td>
      </tr>
      <tr>
        <td height="30" bgcolor="#f4f4f4" class="frmbldtxt">Total Experience (Years)/ Total Years in Business</td>
        <td colspan="6" bgcolor="#f4f4f4"><input   name="Total_Experience" class="input_box_s" onFocus="this.select();" onKeyDown="validateDiv('totalExpVal');"  autocomplete="off" ><div id="totalExpVal" class="alert_msg"></div>  </td>
      </tr>
      <tr>
        <td height="30" class="frmbldtxt">Any Loan running?</td>
        <td colspan="6"><input type="radio" style="border:none;"  value="1"  name="LoanAny"  onclick="addElementLoan(); addDiv(); validateDiv('loanVal');" /> Yes &nbsp;  <input size="10" type="radio"  name="LoanAny"  onclick="removeElementLoan(); validateDiv('loanVal');" value="0" > No   <div id="loanVal"></div></td>
      </tr>
       <tr>
             <td id="myDivLoan1" bgcolor="#f4f4f4" class="frmbldtxt"></td>
       
              <td colspan="6" bgcolor="#f4f4f4" id="myDivLoan2"></td>
            </tr>
       <tr>
             <td id="myDivLoan3" class="frmbldtxt"></td>
       
              <td colspan="6" id="myDivLoan4"></td>
            </tr>            
      <tr>
        <td>&nbsp;</td>
        <td colspan="6">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="7" bgcolor="#f4f4f4" align="center"><input type="image" name="Submit" src="new-images/pl/quote.gif" style="width:115px; height:29px; border:none; "></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="6">&nbsp;</td>
      </tr>
    </table>
    </form>
  </div>
</div>

<!-- Google Code for Personal Loan Conversion Page -->
<!--<script type="text/javascript">
var google_conversion_id = 1066264455;
var google_conversion_language = "en_US";
var google_conversion_format = "2";
var google_conversion_color = "ffffff";
var google_conversion_label = "8uiLCN_ciAEQh8-3_AM";
var google_conversion_value = 0;
if (1.0) {
  google_conversion_value = 1.0;
}

</script>
<script type="text/javascript" src="http://www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="http://www.googleadservices.com/pagead/conversion/1066264455/?value=1.0&amp;label=8uiLCN_ciAEQh8-3_AM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>-->
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
