<?php
	require 'scripts/db_init.php';
	require 'scripts/functions.php';

if(isset($_REQUEST["srcbnr"]))
	{
		$srcbnr = $_REQUEST["srcbnr"];
	}
	else	
	{
		$srcbnr = "digital_pl";
	}

?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<meta name="viewport" content="width=device-width; initial-scale=1.0">
<title>Personal Loans | Personal Loan Rates | Personal Loan EMI</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<link href="get-pl.css" rel="stylesheet" type="text/css">
<link href="media-queries.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="scripts/common.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<script type="text/javascript" src="ajax.js"></script>
<script type="text/javascript" src="ajax-dynamic-pllist.js"></script>
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

.white_text{ font-size:12px; color: #FFF;}
.bank_text{ font-size:12px; color: #90662d;}
.saving_text{ font-size:12px; color: #2f8497;}
.bank_logo_box{ width:950px; margin:auto; }

form{
		display:inline;
	}
select:focus, input:focus
{
border:#FF9122 1px solid; 
}
</style>
<script type="text/javascript">


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

	if (document.loan_form.Loan_Amount.value=="")
	{
		document.getElementById('loanAmtVal').innerHTML = "<span  class='hintanchor'>Enter Loan Amount!</span>";	
		document.loan_form.Loan_Amount.focus();
		return false;
	}	
	if(!checkNum(document.loan_form.Loan_Amount, 'Loan Amount',0))
		return false;

	if (document.loan_form.Employment_Status.selectedIndex==0)
	{
		document.getElementById('empStatusVal').innerHTML = "<span  class='hintanchor'>Select Employment Status to Continue!</span>";	
		document.loan_form.Employment_Status.focus();
		return false;
	}

	 if (document.loan_form.Employment_Status.value==0)
	{
		if (document.loan_form.Annual_Turnover.selectedIndex==0)
		{
			document.getElementById('annualTurnoverVal').innerHTML = "<span  class='hintanchor'>Select Annual Turnover to Continue!</span>";	
			document.loan_form.Annual_Turnover.focus();
			return false;
		}
	}
 	if(document.loan_form.Employment_Status.value==1)
	{
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
	}
	if (document.loan_form.IncomeAmount.value=="")
	{
		document.getElementById('netSalaryVal').innerHTML = "<span  class='hintanchor'>Enter Annual Income!</span>";	
		document.loan_form.IncomeAmount.focus();
		return false;
	}	
	if(!checkNum(document.loan_form.IncomeAmount, 'Annual Income',0))
		return false;


	if((document.loan_form.Name.value=="") || (Trim(document.loan_form.Name.value))==false)
	{
        document.getElementById('nameVal').innerHTML = "<span  class='hintanchor'>Please Enter Your name</span>";		
		document.loan_form.Name.focus();
		return false;
	}

   for (var i = 0; i <document.loan_form.Name.value.length; i++) 
   {
		if (iChars.indexOf(document.loan_form.Name.value.charAt(i)) != -1) 
		{
			document.getElementById('nameVal').innerHTML = "<span  class='hintanchor'>Contains special characters!</span>";
			document.loan_form.Name.focus();
			return false;
		}
  }
	
	if (document.loan_form.City.selectedIndex==0)
	{
		document.getElementById('cityVal').innerHTML = "<span  class='hintanchor'>Enter City to Continue!</span>";	
		document.loan_form.City.focus();
		return false;
	}
	

	if(document.loan_form.Phone.value=="")
	{
		document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Fill Mobile Number!</span>";
		document.loan_form.Phone.focus();
		return false;
	}
	if(isNaN(document.loan_form.Phone.value)|| document.loan_form.Phone.value.indexOf(" ")!=-1)
	{
		document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Enter numeric value!</span>";
		document.loan_form.Phone.focus();
		return false;  
	}
	if (document.loan_form.Phone.value.length < 10 )
	{
	  	document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Enter 10 Digits!</span>";	
		document.loan_form.Phone.focus();
		return false;
	}
	if ((document.loan_form.Phone.value.charAt(0)!="9") && (document.loan_form.Phone.value.charAt(0)!="8") && (document.loan_form.Phone.value.charAt(0)!="7"))
	{
	  	document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>should start with 9 or 8 or 7!</span>";	
		document.loan_form.Phone.focus();
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
		
	
	
	if(!document.loan_form.accept.checked)
	{
		document.getElementById('acceptVal').innerHTML = "<span  class='hintanchor'>Read and Accept Terms & Conditions!</span>";	

		document.loan_form.accept.focus();
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
<script language="javascript">
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

function change_empstst()
{
	var occpdiv = document.getElementById('chnge_empstst');
	var occpdiv_label = document.getElementById('chnge_empstst_label');
	var occupation = document.loan_form.Employment_Status.value;
	
	if(occupation==0)
	{
		occpdiv_label.innerHTML = 'Annual Turnover';
		occpdiv.innerHTML = '  <select name="Annual_Turnover" id="Annual_Turnover" class="sbi_input" onchange="validateDiv(\'annualTurnoverVal\');"><option value="">Please Select</option>			<option value="1" > 0 - 40 Lacs</option>	<option value="4" > 40 Lacs - 1 Cr</option>		<option value="2" > 1Cr - 3Crs </option>	<option value="3" >3Crs & above</option></select><div id="annualTurnoverVal"></div>';
	}
	else
	{
		occpdiv_label.innerHTML = 'Company Name';
		occpdiv.innerHTML = ' <input type="text" name="Company_Name" id="Company_Name" class="sbi_input" onkeydown="validateDiv(\'companyNameVal\');"  onkeyup="ajax_showOptions( this, \'getCountriesByLetters\',event, \'ajax-list-plcompanies.php\')"  autocomplete="off" /> <span class="hint">Type slowly to get the Company dropdown.<span class="hint-pointer">&nbsp;</span></span>  <div id="companyNameVal"></div>';
	}
				
}

</script>
</head>
<body>


<div id="pagewrap">

<div id="header">
<div class="top_container">
<div class="logo_get-pl"><img src="images/gpl_logo.png"></div>
<div class="text_box">Compare Personal Loan, <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Get your eligibility & Quotes 
  from different Banks<br>
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Call us Now @ <span style="font-size:28px; color:#2f8497 ;">1800 3000 1500</span> <span style="font-size:18px;">Toll Free</span></div>
</div>
</div>
<div class="Sbi_home-laon-top_ad_box" style="margin-top:-5px; width:1024px; text-align:right; color:#fff; font-weight:bold; font-size:18px;">&nbsp;</div>
<div class="second_wrapper">

<div style="clear:both;"></div>
<div class="call-us_box_new mobo_text_ab">Call us Now @ <strong class="mobo-hilight_text">1800 3000 1500</strong> <span style="font-size:18px;">Toll Free</span></div>
	<div class="right-box-c" ><h4 class="heading_text_b">Top Personal loan Banks in India - </h4>
			<span class="hdfc-bank
"><span class="sbi-bank">Sbi (State Bank)</span>, Hdfc Bank</span>,	<span class="bajaj-finserv">			Bajaj Finserv</span>, <span class="kotak">Kotak</span>, <span class="ing-vysya">Ing Vsaya,</span> <span class="fullerton">Fullerton</span>, <span class="pnb-bank">PNB</span>  <strong>and </strong><span class="Standard-Chart">Standard Chartered.</span></div>
  <div id="content">
       <form method="post"  name="loan_form"  action="apply-personal-loans-bnrcampvalidate.php"  onSubmit="return chkpersonalloan();"><input type="hidden" name="PostURL" value="<?php echo $_SERVER['REQUEST_URI']; ?>">

<input type="hidden" name="source" id="source" value="<? echo $srcbnr; ?>" />
	     <table width="98%" border="0" align="center" cellpadding="0" cellspacing="2">
		    <tr>
			    <td height="35" valign="middle" bgcolor="#FFFFFF" class="heading_text_c" colspan="2" style="font-size:24px;" >Professional Details</td>
		      </tr>
			  <tr>
			    <td width="27%" height="25" valign="middle" bgcolor="#FFFFFF" class="sbi_text_c">Loan Amount </td>
		   
			    <td width="73%" height="0" valign="middle" bgcolor="#FFFFFF" class="alert_msg"><input name="Loan_Amount" type="text" class="sbi_input" id="Loan_Amount"  onblur="getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" onKeyPress="intOnly(this);" onKeyDown="validateDiv('loanAmtVal');" onKeyUp="intOnly(this); getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" />
			    <span id='formatedlA' style='font-size:11px;
font-weight:normal; color:#000;font-Family:Verdana;'></span><span id='wordloanAmount' style='font-size:11px;
font-weight:normal; color:#000;font-Family:Verdana;text-transform: capitalize;'></span>  <div id="loanAmtVal"></div></td>
		    </tr>
			  <tr>
			    <td height="35" valign="middle" bgcolor="#FFFFFF" class="sbi_text_c">Employment Type</td>
		     
			    <td height="35" valign="middle" bgcolor="#FFFFFF" class="alert_msg"><select name="Employment_Status" class="sbi_input" id="Employment_Status" onChange="validateDiv('empStatusVal'); change_empstst();" style="height:30px;" >
        <option value="-1">Please Select</option>
        <option value="1">Salaried</option>
        <option value="0">Self Employment</option>
        </select>  
         <div id="empStatusVal"></div></td>
		    </tr>
			  <tr>
			    <td height="35" valign="middle" bgcolor="#FFFFFF" id="chnge_empstst_label" class="sbi_text_c">Company Name</td>
		     
			    <td height="35" valign="middle" bgcolor="#FFFFFF" id="chnge_empstst"  class="alert_msg"><input name="Company_Name" type="text" class="sbi_input" id="Company_Name" autocomplete="off" onKeyDown="validateDiv('companyNameVal');"  onkeyup="ajax_showOptions(this,'getCountriesByLetters',event, 'ajax-list-plcompanies.php')" /> <br><span class="hint" style="font-weight:normal; font-size:11px; color:#666666;" >Type slowly to get the Company dropdown.<span class="hint-pointer" >&nbsp;</span></span>
     <div id="companyNameVal"></div></td>
		    </tr>
			  <tr>
			    <td height="35" valign="middle" bgcolor="#FFFFFF" class="sbi_text_c">Net yearly Income</td>
		     
			    <td height="35" valign="middle" bgcolor="#FFFFFF" class="alert_msg"><input name="IncomeAmount" type="text" class="sbi_input" id="IncomeAmount"   onblur="getDigitToWords('IncomeAmount','formatedIncome','wordIncome');" onKeyPress="intOnly(this);" onKeyDown="validateDiv('netSalaryVal');"  onkeyup="intOnly(this); getDigitToWords('IncomeAmount','formatedIncome','wordIncome');"  />    
      
         <span id='formatedIncome' style='font-size:11px;
font-weight:normal; color:#000;font-Family:Verdana;'></span> <span id='wordIncome' style='font-size:11px;
font-weight:normal; color:#000;font-Family:Verdana;text-transform: capitalize;'></span>
       <div id="netSalaryVal"></div></td>
		    </tr>
			  <tr>
			    <td height="43" bgcolor="#FFFFFF" colspan="2" class="heading_text_c" >
                 <table width="100%" border="0" cellpadding="0" cellspacing="0">
                    <tbody>
                      <tr>
                        <td width="35%" height="43" align="left" class="heading_text_c" style="font-size:24px; "> Personal Details</td>
                        <td width="3%" style="font-size:10px; font-weight:normal; color:#999999; vertical-align:bottom;"><img src="images/security.png" width="14" height="16"></td>
                        <td width="62%" align="left"class="sbi_text_a"  style="font-size:10px; font-weight:normal; color:#333333; vertical-align:bottom;">We keep this secure</td>
                      </tr>
                    </tbody>
                </table>             </td>
	       </tr>
              <tr >
			    <td height="35" valign="middle" bgcolor="#FFFFFF" class="sbi_text_c ">Name</td>
		    
			    <td height="35" valign="middle" bgcolor="#FFFFFF" class="alert_msg"><input name="Name" type="text" class="sbi_input" id="Name" onKeyDown="validateDiv('nameVal');" /> <div id="nameVal"></div></td>
		    </tr>
			  <tr>
			    <td height="35" valign="middle" bgcolor="#FFFFFF" class="sbi_text_c">City</td>
		   
			    <td height="35" valign="middle" bgcolor="#FFFFFF" class="alert_msg"><select name="City" class="sbi_input" id="City"  onChange="validateDiv('cityVal');"  style="height:30px;">
         <?=plgetCityList($City)?>
                   <option value="Vapi">Vapi</option>
				   <option value="Ankleshwar">Ankleshwar</option>
				    <option value="Anand">Anand</option>
					 <option value="Anand">Dahod</option>
					  <option value="Anand">Navsari</option>
      </select><div id="cityVal"></div> </td>
		    </tr>
			  <tr>
			    <td height="35" valign="middle" bgcolor="#FFFFFF" class="sbi_text_c">Mobile Number</td>
		   
			    <td height="35" valign="middle" bgcolor="#FFFFFF" class="alert_msg"><input name="Phone" type="text" class="sbi_input" id="Phone"  onchange="intOnly(this);" onKeyPress="intOnly(this)"  onKeyDown="validateDiv('phoneVal');" onKeyUp="intOnly(this);" maxlength="10"; /><div id="phoneVal"></div></td>
		    </tr>
			  <tr>
			    <td height="35" valign="middle" bgcolor="#FFFFFF" class="sbi_text_c">Email Id</td>
		  
			    <td height="35" valign="middle" bgcolor="#FFFFFF" class="alert_msg"><input name="Email" type="text" class="sbi_input" id="Email"  onkeydown="validateDiv('emailVal');" /><div id="emailVal"></div></td>
		    </tr>
			  <tr>
			    <td height="35" valign="middle" bgcolor="#FFFFFF" colspan="2" ><span style="font-size:10px; font-weight:normal;">
			      <input type="checkbox" name="accept"  style="border:none;"/>
		        I authorize Deal4loans.com & its <a href="http://www.deal4loans.com/pl-partnering-banks.php" target="_blank" rel="nofollow">partnering banks</a> to contact me to explain the product & I Agree to <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow">Privacy policy</a> and <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow">Terms and Conditions</a>.</span><div id="acceptVal"></div></td>
		    </tr>
			  <tr>
			    <td height="0" align="center" valign="middle" bgcolor="#FFFFFF" colspan="2" >  <input type="submit" style="border: 0px none ; background-image: url(images/sbi_get_quote_btn.png); width: 148px; height: 43px; margin-bottom: 0px;" value=""/></td>
		    </tr>
              <tr>
                <td height="45" colspan="2" align="center"  class="mobo_text_ab">Call us Now @ <strong class="mobo-hilight_text">1800 3000 1500</strong> <span style="font-size:18px;">Toll Free</span></td>
              </tr>
             <tr>
      <td height="45" colspan="2" align="left"  class="sbi_home_loan_text_c" style="font-weight:normal; font-size:11px; "><strong>Disclaimer: </strong>All loans are on sole discretion on the respective banks</td>
    </tr>
		  </table>
      </form>

	</div>
	
	
	
	<div id="sidebar" style="width: 350px; !important">

		<div class="widget">
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

		</div>
	</div></div>
</div>
<div style="clear:both;"></div>
	<div class="bank_logo_box" style="margin-top:-25px;">
    
        <img src="images/loan-partner-img.jpg" width="100%" class="bank_logo_box">
       
        </div>
</div>

<? 

if($srcbnr=="inuxu_oct13")
{

	$slct="select * from captute_banner_click Where (banner_name ='inuxu_oct13')";
	$bnnr_click=1;
	list($alreadyExist,$myrow)=MainselectfuncNew($slct,$array = array());
	$checkNum = $alreadyExist;
	$myrowcontr=count($myrow)-1;
	$Net_Salary = $myrow[$myrowcontr]["capture_clicks"];

	if(($myrow[$myrowcontr]["capture_clicks"])>0)
	{
		
	$strcrd_nme=$myrow[$myrowcontr]["capture_clicks"] + $bnnr_click;
	}
	else
	{
		$strcrd_nme=$bnnr_click;
	}

	$DataArray = array("capture_clicks"=>$strcrd_nme);
	$wherecondition ="(captute_banner_click.banner_name='inuxu_oct13')";
	Mainupdatefunc ('captute_banner_click', $DataArray, $wherecondition);
}
else if($srcbnr=="logicserve")
{
?>
 <script type="text/javascript"> 
         var lsBaseURL = "http://results.affilitrace.com/scripts/"; 
         document.write(unescape("%3Cscript src='" + lsBaseURL + "lsTrack.js' type='text/javascript'%3E%3C/script%3E")); 
</script> 

<script type="text/javascript"> 
    try { 
        lsTrack._domainName = 'Deal4loans'; 
        lsTrack.runTracking(); 

    } catch (err) { } 
</script>
<? } 
if($srcbnr=="infomedia" || $srcbnr=="informediamailer")
{
	$IP = $_SERVER["HTTP_X_REAL_IP"];
	$Dated = ExactServerdate();
	$data = array("banner_name"=>$srcbnr, "capture_clicks"=>'1', "ip_address"=>$IP, "Dated"=>$Dated );
	$table = 'captute_banner_click';
	$insert = Maininsertfunc ($table, $data);
}
 ?>
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