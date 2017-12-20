<?php
require 'scripts/db_init.php';
require 'scripts/functions.php';

if(isset($_REQUEST["source"]))
{
	$source = $_REQUEST["source"];
}
else	
{
	$source = "bfsmailer";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Bajaj Finserv Personal Loan </title>
<meta name="viewport" content="width=device-width; initial-scale=1.0">
<link href="css/bajaj-finserv-styles11715.css" type="text/css" rel="stylesheet" />
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<script type="text/javascript" src="scripts/common.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<script type="text/javascript" src="ajax.js"></script>
<script type="text/javascript" src="bajajfinserv-dynamic-pllist.js"></script>
<script src="js/text-slider.js" type="text/javascript"></script>
<script src="js/slides.min.jquery.js"></script>

	<script>
		$(function(){
			$('#slides').slides({
				generateNextPrev: true,
				play: 2500
			});
			$('#slides_two').slides({
				generateNextPrev: true,
				play: 4500
			});
			$('#slides_three').slides({
				generateNextPrev: true,
				play: 6500,
				autoHeight: true
			});

				});
	</script>
<style type="text/css" media="screen">
#slides .slides_container {width:575px;height:70px;display:block;}
#slides_two .slides_container{width:250px;display:none;}
#slides_two .slides_container {width:250px;	height:50px;display:block;}
#slides_three .slides_container {width:200px;display:none;}
#slides_three .slides_container {width:200px;height:50px;display:block;}
.top_text{ font-family:Verdana, Geneva, sans-serif; font-size:14px; font-weight:bold; color:#0199ca;}
.text{ font-family:Verdana, Geneva, sans-serif; font-size:14px;}
</style><style type="text/css" media="screen">
@media screen and (max-width: 420px) {
#slides .slides_container {
width:90%; padding:5px;
height:50px;display:none; -webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;
-webkit-box-shadow: 0 1px 3px rgba(0,0,0,.4);-moz-box-shadow: 0 1px 3px rgba(0,0,0,.4);box-shadow: 0 1px 3px rgba(0,0,0,.4);}
#slides .slides_container {width:90%;display:block;}
#slides_two .slides_container{width:90%;display:none;}
#slides_two .slides_container {width:90%;height:250px;display:block;}
#slides_three .slides_container {width:90%;display:none;}
#slides_three .slides_container {width:90%;height:100px;display:block;}
.top_text{ font-family:Verdana, Geneva, sans-serif; font-size:14px; font-weight:bold; color:#0199ca;}
.text{ font-family:Verdana, Geneva, sans-serif; font-size:12px;}}
</style>
<style>

/* Big box with list of options */
#ajax_listOfOptions{
	position:absolute;	/* Never change this one */
	width:350px;	/* Width of box */
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

.hintanchor{
color:#F00;
font-size:12px;
}

form{
		display:inline;
	}
select:focus, input:focus
{
border:#FF0000 1px solid; 
}
</style>

<script type="text/javascript">
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

	if (document.loan_form.Loan_Amount.value=="")
	{
		document.getElementById('loanAmtVal').innerHTML = "<span  class='hintanchor'>Enter Loan Amount!</span>";	
		document.loan_form.Loan_Amount.focus();
		return false;
	}	
	if(!checkNum(document.loan_form.Loan_Amount, 'Loan Amount',0))
		return false;

	if((document.loan_form.Company_Name.value=="") || (document.loan_form.Company_Name.value=="Type slowly to autofill")|| (Trim(document.loan_form.Company_Name.value))==false)
		{
			document.getElementById('companyNameVal').innerHTML = "<span  class='hintanchor'>Fill Company Name!</span>";	
			document.loan_form.Company_Name.focus();
			return false;
		}
		else if(document.loan_form.Company_Name.value.length < 3)
		{
			document.getElementById('companyNameVal').innerHTML = "<span  class='hintanchor'>Fill Company Name!</span>";	
			document.loan_form.Company_Name.focus();
			return false;
		}
	if (document.loan_form.IncomeAmount.value=="")
	{
		document.getElementById('netSalaryVal').innerHTML = "<span  class='hintanchor'>Enter Annual Income!</span>";	
		document.loan_form.IncomeAmount.focus();
		return false;
	}	
			
	if (document.loan_form.City.selectedIndex==0)
	{
		document.getElementById('cityVal').innerHTML = "<span  class='hintanchor'>Enter City to Continue!</span>";	
		document.loan_form.City.focus();
		return false;
	}
	if((document.loan_form.first_name.value=="") || (document.loan_form.first_name.value=="First Name") || (Trim(document.loan_form.first_name.value))==false)
	{
        document.getElementById('nameVal').innerHTML = "<span  class='hintanchor'>Please Enter Your name</span>";		
		document.loan_form.first_name.focus();
		return false;
	}

   for (var i = 0; i <document.loan_form.first_name.value.length; i++) 
   {
		if (iChars.indexOf(document.loan_form.first_name.value.charAt(i)) != -1) 
		{
			document.getElementById('nameVal').innerHTML = "<span  class='hintanchor'>Contains special characters!</span>";
			document.loan_form.first_name.focus();
			return false;
		}
  }
	if(document.loan_form.mobile.value=="")
	{
		document.getElementById('mobileVal').innerHTML = "<span  class='hintanchor'>Fill Mobile Number!</span>";
		document.loan_form.mobile.focus();
		return false;
	}
	if(isNaN(document.loan_form.mobile.value)|| document.loan_form.mobile.value.indexOf(" ")!=-1)
	{
		document.getElementById('mobileVal').innerHTML = "<span  class='hintanchor'>Enter numeric value!</span>";
		document.loan_form.mobile.focus();
		return false;  
	}
	if (document.loan_form.mobile.value.length < 10 )
	{
	  	document.getElementById('mobileVal').innerHTML = "<span  class='hintanchor'>Enter 10 Digits!</span>";	
		document.loan_form.mobile.focus();
		return false;
	}
	if ((document.loan_form.mobile.value.charAt(0)!="9") && (document.loan_form.mobile.value.charAt(0)!="8") && (document.loan_form.mobile.value.charAt(0)!="7"))
	{
	  	document.getElementById('mobileVal').innerHTML = "<span  class='hintanchor'>should start with 9 or 8 or 7!</span>";	
		document.loan_form.mobile.focus();
		return false;
	}
	if(document.loan_form.Email.value=="")
	{
		document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter  Email Address!</span>";	
		document.loan_form.Email.focus();
		return false;
	}
	var str=document.loan_form.Email.value
	var aa=str.indexOf("@")
	var bb=str.indexOf(".")
	var cc=str.charAt(aa)

	if(aa==-1)
	{
		document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter Valid Email Address!</span>";	
		document.loan_form.Email.focus();
		return false;
	}
	else if(bb==-1)
	{
		document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter Valid Email Address!</span>";	
		document.loan_form.Email.focus();
		return false;
	}
		
	if (document.loan_form.Employment_Status.selectedIndex==0)
	{
		document.getElementById('empStatusVal').innerHTML = "<span  class='hintanchor'>Enter Occupation to Continue!</span>";	
		document.loan_form.Employment_Status.focus();
		return false;
	}

	if(!document.loan_form.accept.checked)
	{
		document.getElementById('acceptVal').innerHTML = "<span  class='hintanchor'>Read and Accept Terms & Conditions!</span>";	
		document.loan_form.accept.focus();
		return false;
	}	
	return true;

}
function shw_complete()
{
	
	var nwoccpdiv = document.getElementById('viewform_part_here');
	if(nwoccpdiv.innerHTML=="" )
	{
	
nwoccpdiv.innerHTML='<h1>Personal information </h1><div style="margin-left:10px; font-size:12px; margin-bottom:10px;" class="righttext"><img src="http://www.deal4loans.com/new-images/security.png" /> We keep this secure</div><div class="text_b">Name (As Per PanCard)</div><input name="first_name" type="text" class="inputsecond" id="first_name" onKeyDown="validateDiv(\'fnameVal\');" value="First Name" onFocus="onFocusBlank(this,\'First Name\');" /> <input name="middle_name" type="text" class="inputsecond" id="middle_name" onKeyDown="validateDiv(\'nameVal\');" value="Middle Name" onFocus="onFocusBlank(this,\'Middle Name\');" /> <input name="last_name" type="text" class="inputsecond" id="last_name" onKeyDown="validateDiv(\'nameVal\');" value="Last Name" onFocus="onFocusBlank(this,\'Last Name\');" /><div id="nameVal" ></div><div class="clearfix"></div><label>Mobile Number</label><div class="input-wrapper"><div class="input-wrapper1"><img src="images/mobile-bajaj.png" width="9" height="16" alt="Loan Amount" class="logo margin-top" /><input name="mobile" type="text" class="input" id="mobile"  onchange="intOnly(this);" onKeyPress="intOnly(this)"  onKeyDown="validateDiv(\'mobileVal\');" onKeyUp="intOnly(this);" maxlength="10"; /><div id="mobileVal"></div><div class="clearfix"></div></div><div class="clearfix"></div></div><div class="clearfix"></div><label>Email Id</label><div class="input-wrapper"><div class="input-wrapper1"><img src="images/emild.png" width="10" height="16" alt="Loan Amount" class="logo margin-top" /><input name="Email" type="text" class="input" id="Email"  onkeydown="validateDiv(\'emailVal\');" /><div id="emailVal"></div><div class="clearfix"></div></div><div class="clearfix"></div></div><div class="clearfix"></div><label>Occupation</label><div class="input-wrapper"><div class="input-wrapper1"><img src="images/occupationbag.png" width="10" height="16" alt="Loan Amount" class="logo margin-top" /><select name="Employment_Status" id="Employment_Status"  onchange="validateDiv(\'empStatusVal\');"  class="select">   <option value="-1">Please Select</option>         <option value="1">Salaried</option><option value="0">Self Employed</option>                 </select><div id="empStatusVal"></div>    <div class="clearfix"></div></div><div class="clearfix"></div></div>';
	}
	
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

function validateDiv(div)
{
	var ni1 = document.getElementById(div);
	ni1.innerHTML = '';
}
</script>
<!--[if IE 8]>
<link rel="stylesheet" type="text/css" href="css/bajaj-finserv-pl-styles-ie8.css">
<![endif]-->
</head>
<body>
<div class="topbox">Powered by Deal4loans</div>
<div class="header">
<div class="header-in"><img src="images/bajaj-finlogo.jpg" width="117" height="45" class="logo" />Best Personal Loan from Bajaj Finserv.</div>
<div class="clearfix"></div>
</div>
<div class="main">
<div class="left-wrapper">
<div class="form-wrapper">
<form name="loan_form" action="bajaj_finserv_thanks_continue.php" method="post" onSubmit="return chkpersonalloan();">
<input type="hidden" value="<? echo $bajajvalue; ?>"  name="bajajf_reqid" id="bajajf_reqid"/>
<input type="hidden" value="<? echo $marvcity; ?>"  name="bajajf_city" id="bajajf_city"/>
<input type="hidden" value="<? echo $Name; ?>"  name="bajajf_name" id="bajajf_name"/>
<input type="hidden" value="<? echo $sentflag; ?>"  name="sentflag" id="sentflag"/>
<input type="hidden" name="Source" id="Source" value="<? echo $source; ?>" />
<h1>Professional Details</h1>
<label>Loan Amount</label>
<div class="input-wrapper">
<div class="input-wrapper1"><img src="images/rupee-bajaj.jpg" width="9" height="14" alt="Loan Amount" class="logo margin-top" /><input name="Loan_Amount" type="text" class="input" id="Loan_Amount"  onblur="getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" onKeyPress="intOnly(this);" onKeyDown="validateDiv('loanAmtVal');" onKeyUp="intOnly(this); getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" />
			    <span id='formatedlA' style='font-size:11px;
font-weight:normal; color:#000;font-Family:Verdana;'></span><span id='wordloanAmount' style='font-size:11px;
font-weight:normal; color:#000;font-Family:Verdana;text-transform: capitalize;'></span>  <div id="loanAmtVal"></div>

<div class="clearfix"></div></div>
<div class="clearfix"></div>
</div>
<div class="clearfix"></div>
<label>Company Name</label>
<div class="input-wrapper">
<div class="input-wrapper1"><img src="images/company-name-bajaj.jpg" width="10" height="12" alt="Loan Amount" class="logo margin-top" />
    <input name="Company_Name" type="text"  class="input" id="Company_Name" autocomplete="off" onKeyDown="validateDiv('companyNameVal');"  onkeyup="ajax_showOptions(this,'getCountriesByLetters',event, 'ajax-list-plcompanies.php')" /> <span class="hint" style="font-size:12px; color:#666; padding-left:10px;">Type slowly to get the Company dropdown.<span class="hint-pointer">&nbsp;</span></span>
     <div id="companyNameVal"></div
  ><div class="clearfix"></div></div>
<div class="clearfix"></div>
</div>
<div class="clearfix"></div>
<label>Net yearly Income</label>
<div class="input-wrapper">
<div class="input-wrapper1"><img src="images/rupee-bajaj.jpg" width="9" height="14" alt="Loan Amount" class="logo margin-top" />
<input name="IncomeAmount" type="text" class="input" id="IncomeAmount"   onblur="getDigitToWords('IncomeAmount','formatedIncome','wordIncome');" onKeyPress="intOnly(this);" onKeyDown="validateDiv('netSalaryVal');"  onkeyup="intOnly(this); getDigitToWords('IncomeAmount','formatedIncome','wordIncome');"  />    
     
<span id='formatedIncome' style='font-size:11px;
font-weight:normal; color:#000;font-Family:Verdana;'></span> <span id='wordIncome' style='font-size:11px;
font-weight:normal; color:#000;font-Family:Verdana;text-transform: capitalize;'></span>
       <div id="netSalaryVal"></div>
  <div class="clearfix"></div></div>
<div class="clearfix"></div>
</div>
<div class="clearfix"></div>
<label>City</label>
<div class="input-wrapper">
<div class="input-wrapper1"><img src="images/location-bajaj.jpg" width="10" height="14" alt="City" class="logo margin-top" />
    <select name="City" class="select" id="City"  onChange="shw_complete(); validateDiv('cityVal');" >
         <?=plgetCityList($City)?>
                   <option value="Vapi">Vapi</option>
				   <option value="Ankleshwar">Ankleshwar</option>
				    <option value="Anand">Anand</option>
					 <option value="Anand">Dahod</option>
					  <option value="Anand">Navsari</option>
      </select><div id="cityVal"></div>
 
  <div class="clearfix"></div></div>
<div class="clearfix"></div>
</div>
<div class="clearfix"></div>

<div class="terms-bajaj" id="viewform_part_here"></div>


<div class="terms-bajaj"><input type="checkbox" name="accept" id="accept" style="border:none;"/> I have read the<a href="http://www.deal4loans.com/Privacy.php" target="_blank" style="color:#FFF;"> Privacy Policy</a> and agree to the <a href="http://www.deal4loans.com/Privacy.php" target="_blank" style="color:#FFF;">Terms And Condition</a>.</div>
<div class="clearfix"></div>
<div class="automargin"><input type="submit" class="quotebtn"  value="Get Quote"/>
</div>
<div class="automargin"></div>
<div class="clearfix"></div></form>
<div class="clearfix"></div>
</div>
 <div id="slides" class="slider-mainwrapper">
		<div class="slides_container">
<?php $bajajselect="Select bajajf_name,bajajf_company_name,bajajf_loan_amount From bajaj_finserv_mailer_leads where (bajajf_loan_amount>=100000) Order by bajajf_dated DESC LIMIT 0,3";
list($Getnum,$bajajrow)=MainselectfuncNew($bajajselect,$array = array());

$i=0;
$r=3;
		 while($i<count($bajajrow))
		 {
				if(strlen($bajajrow[$i]["bajajf_loan_amount"]>=6))
				{
					
					$bajajf_loan_amount = substr(trim($bajajrow[$i]["bajajf_loan_amount"]), 0, strlen(trim($bajajrow["bajajf_loan_amount"]))-8);
				}
				?>
<div class="text">
	<span class="top_text"><? echo $r; ?> min ago</span>  <br><div style="margin-top:5px;">Mr.<? echo $bajajrow[$i]["bajajf_name"]; ?> (From: <? echo $bajajrow[$i]["bajajf_company_name"]; ?>) <br>applied for loan of <strong>Rs. <? echo $bajajf_loan_amount; ?> lacs</strong></div>
</div>

<? $i=$i+1;
$r=$r+3;
} 
		?>
		 </div>
    </div>
<div class="offerbox"><strong style="color:#cd1739; font-size:21px;">Welcome Rewards</strong><br />
  <strong style="color:#0576aa; font-weight:normal; font-size:17px;">Get gifts upto Rs. 18,840 on disbursal.</strong><br />
  <strong style="font-weight:normal; font-size:13px; color:#30aa05;">Refer to <strong style="color:#F00;">*</strong>Terms and Conditions<strong style="color:#F00;">*</strong></strong></div>
  <span style="color:#999; font-size:11px;"><strong style="color:#F00;">*</strong> Refer to Terms and Conditions - www.deal4loans.com/personal-loan-offers.php</span>

</div>
<div class="right-box">
<div class="right-box2"><h2>Benefits of Personal Loan over Used Car Loan</h2>
<ul class="righttext">
<li>Zero Part/Pre Payment option available</li>
</ul>
<table width="100%" border="0" cellpadding="3" cellspacing="1">
  <tr>
    <td height="35" bgcolor="#76ccfe">&nbsp;</td>
    <td height="35" bgcolor="#76ccfe" class="tablefont"><strong>Flexi Loan Account <br />
      Repayment</strong></td>
    <td height="35" bgcolor="#76ccfe" class="tablefont"><strong>Normal Used Car 
      Loan Repayment</strong></td>
  </tr>
  <tr>
    <td bgcolor="#bae5fe" class="tablefont">Loan Amount</td>
    <td align="center" bgcolor="#bae5fe" class="tablefont">450000</td>
    <td align="center" bgcolor="#bae5fe" class="tablefont">450000</td>
  </tr>
  <tr>
    <td bgcolor="#bae5fe" class="tablefont">ROI</td>
    <td align="center" bgcolor="#bae5fe" class="tablefont">15.25%</td>
    <td align="center" bgcolor="#bae5fe" class="tablefont">15.00%</td>
  </tr>
  <tr>
    <td bgcolor="#bae5fe" class="tablefont">Tenor</td>
    <td align="center" bgcolor="#bae5fe" class="tablefont">48</td>
    <td align="center" bgcolor="#bae5fe" class="tablefont">48</td>
  </tr>
  <tr>
    <td bgcolor="#bae5fe" class="tablefont">Part Prepayment (3rd Month)</td>
    <td align="center" bgcolor="#bae5fe" class="tablefont">275000</td>
    <td align="center" bgcolor="#bae5fe" class="tablefont">Nil</td>
  </tr>
  <tr>
    <td bgcolor="#bae5fe" class="tablefont">Withdrawal (4th month)</td>
    <td align="center" bgcolor="#bae5fe" class="tablefont">100000</td>
    <td align="center" bgcolor="#bae5fe" class="tablefont">Nil</td>
  </tr>
  <tr>
    <td bgcolor="#bae5fe" class="tablefont">Part Pre Payment <br />
      (15 th month)</td>
    <td align="center" bgcolor="#bae5fe" class="tablefont">250000</td>
    <td align="center" bgcolor="#bae5fe" class="tablefont">Nil</td>
  </tr>
  <tr>
    <td bgcolor="#bae5fe" class="tablefont">Withdrawal (20th Month)</td>
    <td align="center" bgcolor="#bae5fe" class="tablefont">150000</td>
    <td align="center" bgcolor="#bae5fe" class="tablefont">15000</td>
  </tr>
  <tr>
    <td bgcolor="#bae5fe" class="tablefont">Total Interest Paid</td>
    <td align="center" bgcolor="#bae5fe" class="tablefont">97698</td>
    <td align="center" bgcolor="#bae5fe" class="tablefont">151144</td>
  </tr>
  <tr>
    <td bgcolor="#bae5fe" class="tablefont"><strong>Savings</strong></td>
    <td colspan="2" align="center" bgcolor="#bae5fe" class="tablefont"><strong style="color:#00b44c;">53,446</strong></td>
    </tr>
  <tr>
    <td bgcolor="#bae5fe" class="tablefont"><strong >Interest Saved</strong></td>
    <td colspan="2" align="center" bgcolor="#bae5fe" class="tablefont"><strong style="color:#00b44c;">35%</strong></td>
    </tr>
</table>
<ul class="righttext">
<li>Withdrawal facility also available</li>
<li>No limit on Part/Pre Payment & Withdrawal</li>
<li>Vehicle registration on your own name</li>
<li>Lesser Documentation</li>
<li>Approval In 24 Hours</li>
</ul>
</div>
<div class="clearfix" style="height:15px;"></div>
<div class="right-box2">
<h2>Why Bajaj Finserv?</h2>
<div class="righttext">India’s first Flexi Loan product with cash in 72 hours. Get Personal Loan approval of upto 25 Lacs in 8 Working Hours along with unique benefits on Part/Pre Payment.</div>
</div>
</div>
</div>
</body>
</html>