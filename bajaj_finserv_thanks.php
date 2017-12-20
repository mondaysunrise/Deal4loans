<?php
require 'scripts/db_init.php';
require 'scripts/functions.php';
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<meta name="viewport" content="width=device-width; initial-scale=1.0">
<title>Bajaj Finserv Personal Loans | Personal Loan Rates | Personal Loan EMI</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<link href="css/bajaj-finserv-pl-styles.css" rel="stylesheet" type="text/css">
<link href="css/bajaj-finserv-pl-media.css" rel="stylesheet" type="text/css">
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
#slides .slides_container {
width:575px; padding:5px;
height:50px;display:none; -webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;
-webkit-box-shadow: 0 1px 3px rgba(0,0,0,.4);-moz-box-shadow: 0 1px 3px rgba(0,0,0,.4);box-shadow: 0 1px 3px rgba(0,0,0,.4);}
#slides .slides_container {width:575px;height:50px;display:block;}
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
	
	if((document.loan_form.name.value=="") || (Trim(document.loan_form.name.value))==false)
	{
        document.getElementById('nameVal').innerHTML = "<span  class='hintanchor'>Please Enter Your name</span>";		
		document.loan_form.name.focus();
		return false;
	}

   for (var i = 0; i <document.loan_form.name.value.length; i++) 
   {
		if (iChars.indexOf(document.loan_form.name.value.charAt(i)) != -1) 
		{
			document.getElementById('nameVal').innerHTML = "<span  class='hintanchor'>Contains special characters!</span>";
			document.loan_form.name.focus();
			return false;
		}
  }
	
	if (document.loan_form.City.selectedIndex==0)
	{
		document.getElementById('cityVal').innerHTML = "<span  class='hintanchor'>Enter City to Continue!</span>";	
		document.loan_form.City.focus();
		return false;
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
	
nwoccpdiv.innerHTML='<table width="100%"> <tr>			    <td height="53" valign="middle" bgcolor="#FFFFFF" class="heading_text">Personal information <br><img src="new-images/security.png"><span class="sbi_text_a" style="font-size:10px; font-weight:normal; color:#333333; vertical-align:bottom;"> We keep this secure</span></td>		    </tr>      <tr>   <td height="35" valign="middle" bgcolor="#FFFFFF" class="sbi_text_c">Name (As Per PanCard)</td>   </tr>  <tr>		    <td height="35" valign="middle" bgcolor="#FFFFFF" class="alert_msg"><input name="first_name" type="text" class="sbi_input" id="first_name" onKeyDown="validateDiv(\'fnameVal\');" style="width:170px !important;" value="First Name" onFocus="onFocusBlank(this,\'First Name\');" /> <input name="middle_name" type="text" class="sbi_input" id="middle_name" onKeyDown="validateDiv(\'nameVal\');" style="width:170px !important;" value="Middle Name" onFocus="onFocusBlank(this,\'Middle Name\');" /> <input name="last_name" type="text" class="sbi_input" id="last_name" onKeyDown="validateDiv(\'nameVal\');" style="width:170px !important;" value="Last Name" onFocus="onFocusBlank(this,\'Last Name\');" /><div id="nameVal" ></div></td>  </tr> <tr><td height="35" valign="middle" bgcolor="#FFFFFF" class="sbi_text_c">Mobile Number</td>	    </tr><tr>			    <td height="35" valign="middle" bgcolor="#FFFFFF" class="alert_msg"><input name="mobile" type="text" class="sbi_input" id="mobile"  onchange="intOnly(this);" onKeyPress="intOnly(this)"  onKeyDown="validateDiv(\'mobileVal\');" onKeyUp="intOnly(this);" maxlength="10"; /><div id="mobileVal"></div></td>	    </tr>			  <tr>			    <td height="35" valign="middle" bgcolor="#FFFFFF" class="sbi_text_c">Email Id</td>		    </tr>			  <tr>			    <td height="35" valign="middle" bgcolor="#FFFFFF" class="alert_msg"><input name="Email" type="text" class="sbi_input" id="Email"  onkeydown="validateDiv(\'emailVal\');" /><div id="emailVal"></div></td>		    </tr><tr>			    <td height="35" valign="middle" bgcolor="#FFFFFF" class="sbi_text_c">Occupation</td>		    </tr>			  <tr>			    <td height="35" valign="middle" bgcolor="#FFFFFF" class="alert_msg"><select name="Employment_Status" id="Employment_Status"  onchange="validateDiv(\'empStatusVal\');"  class="sbi_input">   <option value="-1">Please Select</option>         <option value="1">Salaried</option>                           <option value="0">Self Employed</option>                   </select><div id="empStatusVal"></div></td>		    </tr></table>';
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
</script>
<!--[if IE 8]>
<link rel="stylesheet" type="text/css" href="css/bajaj-finserv-pl-styles-ie8.css">
<![endif]-->
</head>
<body>
<div id="pagewrap">
<div id="header">
<div class="heading_text">Best Personal Loan from Bajaj Finserv.<span style="float:right;">Powered by Deal4loans </span></div>
	<div class="bajaj-finserv_box" style="margin-right:25px;"><img src="new-images/bajaj-finserv1.jpg"></div>
		<div class="lining"></div>
  </div>
	<div id="content-new">
  <div id="content">
     
<form name="loan_form" action="bajaj_finserv_thanks_continue.php" method="post" onSubmit="return chkpersonalloan();">
<input type="hidden" value="<? echo $bajajvalue; ?>"  name="bajajf_reqid" id="bajajf_reqid"/>
<input type="hidden" value="<? echo $marvcity; ?>"  name="bajajf_city" id="bajajf_city"/>
<input type="hidden" value="<? echo $Name; ?>"  name="bajajf_name" id="bajajf_name"/>
<input type="hidden" value="<? echo $sentflag; ?>"  name="sentflag" id="sentflag"/>
<input type="hidden" name="Source" id="Source" value="bfsmailer" />
		  <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
		    <tr>
			    <td height="35" valign="middle" bgcolor="#FFFFFF" class="heading_text">Professional Details</td>
		      </tr>
			  <tr>
			    <td height="25" valign="middle" bgcolor="#FFFFFF" class="sbi_text_c">Loan Amount </td>
		      </tr>
			  <tr>
			    <td height="0" valign="middle" bgcolor="#FFFFFF" class="alert_msg"><input name="Loan_Amount" type="text" class="sbi_input" id="Loan_Amount"  onblur="getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" onKeyPress="intOnly(this);" onKeyDown="validateDiv('loanAmtVal');" onKeyUp="intOnly(this); getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" />
			    <span id='formatedlA' style='font-size:11px;
font-weight:normal; color:#000;font-Family:Verdana;'></span><span id='wordloanAmount' style='font-size:11px;
font-weight:normal; color:#000;font-Family:Verdana;text-transform: capitalize;'></span>  <div id="loanAmtVal"></div></td>
		    </tr>
			 
			  <tr>
			    <td height="35" valign="middle" bgcolor="#FFFFFF" id="chnge_empstst_label" class="sbi_text_c">Company Name</td>
		      </tr>
			  <tr>
			    <td height="35" valign="middle" bgcolor="#FFFFFF" class="alert_msg"><input name="Company_Name" type="text" class="sbi_input" id="Company_Name" autocomplete="off" onKeyDown="validateDiv('companyNameVal');"  onkeyup="ajax_showOptions(this,'getCountriesByLetters',event, 'ajax-list-plcompanies.php')" /> <span class="hint">Type slowly to get the Company dropdown.<span class="hint-pointer">&nbsp;</span></span>
     <div id="companyNameVal"></div></td>
		    </tr>
			  <tr>
			    <td height="35" valign="middle" bgcolor="#FFFFFF" class="sbi_text_c">Net yearly Income</td>
		      </tr>
			  <tr>
			    <td height="35" valign="middle" bgcolor="#FFFFFF" class="alert_msg"><input name="IncomeAmount" type="text" class="sbi_input" id="IncomeAmount"   onblur="getDigitToWords('IncomeAmount','formatedIncome','wordIncome');" onKeyPress="intOnly(this);" onKeyDown="validateDiv('netSalaryVal');"  onkeyup="intOnly(this); getDigitToWords('IncomeAmount','formatedIncome','wordIncome');"  />    
      
         <span id='formatedIncome' style='font-size:11px;
font-weight:normal; color:#000;font-Family:Verdana;'></span> <span id='wordIncome' style='font-size:11px;
font-weight:normal; color:#000;font-Family:Verdana;text-transform: capitalize;'></span>
       <div id="netSalaryVal"></div></td>
		    </tr>
            <tr>
			    <td height="35" valign="middle" bgcolor="#FFFFFF" class="sbi_text_c">City</td>
		    </tr>
			  <tr>
			    <td height="35" valign="middle" bgcolor="#FFFFFF" class="alert_msg"><select name="City" class="sbi_input" id="City"  onChange="shw_complete(); validateDiv('cityVal');" >
         <?=plgetCityList($City)?>
                   <option value="Vapi">Vapi</option>
				   <option value="Ankleshwar">Ankleshwar</option>
				    <option value="Anand">Anand</option>
					 <option value="Anand">Dahod</option>
					  <option value="Anand">Navsari</option>
      </select><div id="cityVal"></div> </td>
		    </tr>
			 <tr>
			    <td bgcolor="#FFFFFF" id="viewform_part_here"></td>
		    </tr>
			  <tr>
			    <td height="35" valign="middle" bgcolor="#FFFFFF" ><span style="font-size:10px; font-weight:normal;">
			      <input type="checkbox" name="accept" id="accept" style="border:none;"/>
		        I have read the <a href="http://www.deal4loans.com/Privacy.php" target="_blank">Privacy Policy</a> and agree to the <a href="http://www.deal4loans.com/Privacy.php">Terms And Condition</a>.</span><div id="acceptVal"></div></td>
		    </tr>
			  <tr>
			    <td height="0" align="center" valign="middle" bgcolor="#FFFFFF" >  <input type="submit" style="border: 0px none ; background-image: url(new-images/sbi_get_quote_btn.png); width: 153px; height: 47px; margin-bottom: 0px;" value=""/></td>
		    </tr>
		  </table>
          </form>
<div style="clear:both"></div>
	</div>
    <div id="slides">
		<div class="slides_container">
<?php $bajajselect=("Select bajajf_name,bajajf_company_name,bajajf_loan_amount From bajaj_finserv_mailer_leads where (bajajf_loan_amount>=100000) Order by bajajf_dated DESC LIMIT 0,3");

list($Getnum,$bajajrow)=MainselectfuncNew($bajajselect,$array = array());
$i=0;
$r=3;
		  while($i<count($bajajrow))
		 {
				if(strlen($bajajrow[$i]["bajajf_loan_amount"]>=6))
				{
					
					$bajajf_loan_amount = substr(trim($bajajrow[$i]["bajajf_loan_amount"]), 0, strlen(trim($bajajrow[$i]["bajajf_loan_amount"]))-8);
				}
				?>
<div class="text">
	<span class="top_text"><? echo $r; ?> min ago</span>  <br><div style="margin-top:5px;">Mr.<? echo $bajajrow[$i]["bajajf_name"]; ?> (From: <? echo $bajajrow[$i]["bajajf_company_name"]; ?>) applied for loan of <strong>Rs. <? echo $bajajf_loan_amount; ?> lacs</strong></div>
</div>

<? $i=$i+1;
$r=$r+3;
} 
		?>
		 <!--<div class="text">
				<span class="top_text">5 min ago</span>  <br><span>Mr.DINESH BAGGA (From: ADITYA TRADERS) applied for loan of <strong>Rs.5 lacs</strong></span>
			</div>-->
</div>
    </div>
    </div>
	<div id="sidebar">
		<div class="widget">
		 	  <div class="right-box-d">
		 	    <h4 class="heading_text_b">Why Bajaj Finserv?</h4>
	 	  </div>
	 	  <div class="sbi_text_bullet">
  <ul>
<li>Loans up to Rs.18 Lacs<br/>
<div style="font-size:11px; color:#999; font-weight:normal; line-height:15px;">Bold dreams need big means. We offer the highest ticket size of up to 18 lacs so that you can pursue your bold dreams. This is the highest ticket size that anyone offers in this category.</div>
</li>
<li>Nil Foreclosure charges
<br/>
<div style="font-size:11px; color:#999; font-weight:normal; line-height:15px;">Now you can choose to foreclose your loan anytime during your loan tenor without paying any foreclosure charges. </div>
</li>
<li>Step Down Interest Rate
<br/>
<div style="font-size:11px; color:#999; font-weight:normal; line-height:15px;">0.20% reduction in IRR in year 2 and year 3 (only for 2 yrs).
</div>
</li>
<li>Flexi Loans
<br/>
<div style="font-size:11px; color:#999; font-weight:normal; line-height:15px;">Flexibility to not only prepay but to withdraw as per your requirement. And You can also operate the loan account in a very easy & convenient way.
</div>
</li>
<li>Part Prepayment facility
<br/>
<div style="font-size:11px; color:#999; font-weight:normal; line-height:15px;">You can prepay upto 6 times in a calendar year at any interval with the minimum amount per prepay transaction being not less than 3 EMIs. There is no limit on the maximum amount. This is subject to your clearing your first EMI. 
</div>
</li>
<li>Access to best Relationship Manager
<br/>
<div style="font-size:11px; color:#999; font-weight:normal; line-height:15px;">Get best service from quality sales representative.
</div>
</li>
</ul>  
</div>
		</div>
  <div class="widget clearfix">						
        <img src="http://www.deal4loans.com/new-images/pl/diwali-welcome-rewards.jpg"><div style="font-size:11px; color:#999; font-weight:normal; line-height:15px;">* Refer to terms & Conditions - www.deal4loans.com/personal-loan-offers.php</div></div>
							
  </div>
	<div style="clear:both; "></div>
    <div style=" margin-top:-40px; padding-top:0px; margin:auto;" >
      <table border="0" cellspacing="0" cellpadding="0" width="100%" >
        <tr>
          <td width="172" valign="bottom" style="border:1px #0199cd solid;border-right:1px #FFFFFF solid; color:#FFFFFF; background-color:#0199cd;"><p align="center"><strong>Bank A<br>
            (Without Partpayment<br>
            Option)</strong></p></td>
          <td width="130" valign="bottom" style="border:1px #0199cd solid;border-right:1px #FFFFFF solid; color:#FFFFFF; background-color:#0199cd;"><p align="center"><strong>Actual Interest<br>
            (Bank A)</strong></p></td>
          <td width="196" valign="bottom" style="border:1px #0199cd solid;border-right:1px #FFFFFF solid; color:#FFFFFF; background-color:#0199cd;"><p align="center"><strong>Bank B<br>
            (With Partpayment<br>
            Option)</strong></p></td>
          <td width="186" valign="bottom" style="border:1px #0199cd solid;border-right:1px #FFFFFF solid; color:#FFFFFF; background-color:#0199cd;"><p align="center"><strong>Part Payment<br>
            (Amount)</strong></p></td>
          <td width="173" valign="bottom" style="border:1px #0199cd solid;border-right:1px #FFFFFF solid; color:#FFFFFF; background-color:#0199cd;"><p align="center"><strong>Acutual Interest<br>
            (After Partpayment)</strong></p></td>
          <td width="123" valign="bottom" style="border:1px #0199cd solid; color:#FFFFFF; background-color:#0199cd;"><p align="center"><strong>Net Saving<br>
            (With Part Payment)</strong></p></td>
        </tr>
        <tr>
          <td width="172" nowrap rowspan="2" valign="bottom" style="border:1px #0199cd solid;"><p align="center">14.50%</p></td>
          <td width="130" nowrap rowspan="2" valign="bottom" style="border:1px #0199cd solid;"><p align="center">31167</p></td>
          <td width="196" nowrap rowspan="2" valign="bottom" style="border:1px #0199cd solid;"><p align="center">15.50%</p></td>
          <td width="186" nowrap valign="bottom" style="border:1px #0199cd solid;"><p align="center">25,000 in 1st Year</p></td>
          <td width="173" nowrap valign="bottom" style="border:1px #0199cd solid;"><p align="center">22342</p></td>
          <td width="123" nowrap valign="bottom" style="border:1px #0199cd solid;"><p align="center">8825</p></td>
        </tr>
        <tr>
          <td width="186" nowrap valign="bottom" style="border:1px #0199cd solid;"><p align="center">25,000 in 2nd Year</p></td>
          <td width="173" nowrap valign="bottom" style="border:1px #0199cd solid;"><p align="center">27029</p></td>
          <td width="123" nowrap valign="bottom" style="border:1px #0199cd solid;"><p align="center">4138</p></td>
        </tr>

        <tr>
          <td nowrap colspan="6" valign="bottom"><p>* Calculation Basis 1,00,000    Loan Amount &amp; 25,000 part payment after 1st &amp; 2nd Year</p></td>
        </tr>
      </table>
    </div>
	
</div>


</body>
</html>