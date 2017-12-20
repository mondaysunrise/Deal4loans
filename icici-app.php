<?php
//header("Location: icici_app_new.php");
require 'scripts/db_init.php';
require 'scripts/functions.php';

$maxage=date('Y')-62;
$minage=date('Y')-18;
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ICICI Personal Loan</title>
<link href="icici-app-styles.css" type="text/css" rel="stylesheet" />
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<link href='progression.min.css' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="tip-yellow.css" type="text/css" />
	   <script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
        <script type="text/javascript" src="scripts/common.js"></script>
 <script language="JavaScript" type="text/javascript" src="http://www.deal4loans.com/suggest.js"></script>
 <script type="text/javascript" src="http://www.deal4loans.com/ajax.js"></script>
<script type="text/javascript" src="http://www.deal4loans.com/ajax-dynamic-icici.js"></script>
	<!-- jQuery and the Poshy Tip plugin files -->
	<script type="text/javascript" src="jquery-1.4.2.min.js"></script>
	<script type="text/javascript" src="jquery.poshytip.js"></script>
<script src="javascript-browser.js" type="text/javascript"></script>
<script type="text/javascript">
		//<![CDATA[
		$(function(){

			$('#comp-basic').poshytip();
			$('#demo-tip-yellow').poshytip();
			$('#demo-tip-violet').poshytip({
				className: 'tip-violet',
				bgImageFrameSize: 9
			});
			$('#sal-basic').poshytip();
			$('#demo-tip-yellow').poshytip();
			$('#demo-tip-violet').poshytip({
				className: 'tip-violet',
				bgImageFrameSize: 9
			});
			$('#rela-basic').poshytip();
			$('#demo-tip-yellow').poshytip();
			$('#demo-tip-violet').poshytip({
				className: 'tip-violet',
				bgImageFrameSize: 9
			});
			$('#obli-basic').poshytip();
			$('#demo-tip-yellow').poshytip();
			$('#demo-tip-violet').poshytip({
				className: 'tip-violet',
				bgImageFrameSize: 9
			});
			$('#emi-basic').poshytip();
			$('#demo-tip-yellow').poshytip();
			$('#demo-tip-violet').poshytip({
				className: 'tip-violet',
				bgImageFrameSize: 9
			});
			$('#occupa-basic').poshytip();
			$('#demo-tip-yellow').poshytip();
			$('#demo-tip-violet').poshytip({
				className: 'tip-violet',
				bgImageFrameSize: 9
			});
			$('#te-basic').poshytip();
			$('#demo-tip-yellow').poshytip();
			$('#demo-tip-violet').poshytip({
				className: 'tip-violet',
				bgImageFrameSize: 9
			});
			$('#dob-basic').poshytip();
			$('#demo-tip-yellow').poshytip();
			$('#demo-tip-violet').poshytip({
				className: 'tip-violet',
				bgImageFrameSize: 9
			});
			$('#city-basic').poshytip();
			$('#demo-tip-yellow').poshytip();
			$('#demo-tip-violet').poshytip({
				className: 'tip-violet',
				bgImageFrameSize: 9
			});
		});
		//]]>
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


function chkpersonalloan(Form)
{
	var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
	var dt,mdate;dt=new Date();
	var cnt;
	var alpha=/^[a-zA-Z\ ]*$/;
	var alphanum=/^[a-zA-Z0-9]*$/;
	var num=/^[0-9]*$/;
	var space=/^[\ ]*$/;
	var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";
	
	
	if (document.loan_form.relationship.selectedIndex==0)
	{
		document.getElementById('relVal').innerHTML = "<span  class='hintanchor'>Enter City to Continue!</span>";	
		document.loan_form.relationship.focus();
		return false;
	}
	if (document.loan_form.City.selectedIndex==0)
	{
		document.getElementById('cityVal').innerHTML = "<span  class='hintanchor'>Enter City to Continue!</span>";	
		document.loan_form.City.focus();
		return false;
	}
	/*
	if((document.loan_form.City.value=="Others") && ((document.loan_form.City_Other.value=="" || document.loan_form.City_Other.value=="Other City"  ) || !isNaN(document.loan_form.City_Other.value)))
	{
		document.getElementById('othercityVal').innerHTML = "<span  class='hintanchor'>Enter Other City to Continue!</span>";		
		document.loan_form.City_Other.focus();
		return false;
	}
	for (var i = 0; i <document.loan_form.City_Other.value.length; i++) {
  	if (iChars.indexOf(document.loan_form.City_Other.value.charAt(i)) != -1) {
		document.getElementById('othercityVal').innerHTML = "<span  class='hintanchor'>Remove Special Characters!</span>";	
		document.loan_form.City_Other.focus();
  		return false;
  	}
  }		
  */
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

	if (document.loan_form.Employment_Status.selectedIndex==0)
	{
		document.getElementById('empStatusVal').innerHTML = "<span  class='hintanchor'>Select Employment Status to Continue!</span>";	
		document.loan_form.Employment_Status.focus();
		return false;
	}
/*	 if (document.loan_form.Employment_Status.value==0)
	{
		if (document.loan_form.Annual_Turnover.selectedIndex==0)
		{
			document.getElementById('annualTurnoverVal').innerHTML = "<span  class='hintanchor'>Select Annual Turnover to Continue!</span>";	
			document.loan_form.Annual_Turnover.focus();
			return false;
		}
	}
*/

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

	if (document.loan_form.Net_Salary.value=="")
	{
		document.getElementById('netSalaryVal').innerHTML = "<span  class='hintanchor'>Enter Annual Income!</span>";	
		document.loan_form.Net_Salary.focus();
		return false;
	}	
	
	/*if (document.loan_form.total_experience.value=="")
	{
		document.getElementById('expVal').innerHTML = "<span  class='hintanchor'>Enter Total Experience!</span>";	
		document.loan_form.total_experience.focus();
		return false;
	}	*/

	if(!document.loan_form.accept.checked)
	{
		document.getElementById('acceptVal').innerHTML = "<span  class='hintanchor'>Read and Accept Terms & Conditions!</span>";	

		document.loan_form.accept.focus();
		return false;
	}	
}  
	</script>
    <style type="text/css">
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
		.flickr-thumbs {
			overflow:hidden;
		}
		.flickr-thumbs a {
			float:left;
			display:block;
			margin:0 3px;
			border:1px solid #333;
		}
		.flickr-thumbs a:hover {
			border-color:#eee;
		}
		.flickr-thumbs img {
			display:block;
			width:60px;
			height:60px;
		}
		.alert_msg{color:#FF0000; font-weight:bold; font-size:12px; font-family: Verdana, Geneva, sans-serif;}
	</style>
</head>
<body>
<header>
<div class="top-bx">
<div class="logo"><img src="images/icici-app-logo.jpg" width="189" height="47"></div>
<div class="right-box"><span class="text-a">Powered by</span> <br>
<span class="text-a" style="color:#0f8eda; font-size:18px;">Deal4loans.com</span></div>
<div style="clear:both;"></div>
</div>
</header>
<div class="banner"><img src="images/banner-app.png" class="img"></div>
<div class="form-main-wrapper">
<div class="form-box">
  <div class="boxform-ext"><form id="myform" onSubmit="return chkpersonalloan();" action="icici-app-second-page.php" method="post" name="loan_form">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td colspan="4" align="right" class="text-b"><a href="#" class="tooltip"><span>
        <img class="callout" src="images/callout.gif" />
        <strong>Most Light-weight Tooltip</strong><br />
        This is the easy-to-use Tooltip driven purely by CSS.
    </span>
</a>
</td>
        </tr>
     <tr>
        <td align="right" class="text-b">Your relation with ICICI Bank </td>
        <td>&nbsp;</td>
        <td align="left"><select name="relationship" id="relationship" class="select" tabindex="1">
<option value="">Select</option>
<option value="SALARY_ACCOUNT">Salaried Account</option>
<option value="SAVINGS_ACCOUNT" selected="selected">Savings Account</option>
<option value="CREDIT_CARD">Credit Card</option>
<option value="CURRENT_ACCOUNT">Current Account</option>
<option value="HOME_LOAN">Home Loan</option>
<option value="PERSONAL_LOAN">Personal Loan</option>
<option value="CAR_LOAN">Car Loan</option>
<option value="TWO_WHLR_LOAN">Two Wheeler Loan</option>
<option value="TERM_DEPOSIT">Term Deposit</option>
<option value="LOAN_AGAINST_SECURITIES">Loan Against Securities</option>
<option value="DEMAT">Demat</option>
<option value="OTHER">No Existing Relationship</option>
        </select><div id="relVal" class="alert_msg"></div>
          </td>
        <td align="left"><a id="rela-basic" title="Your relation with ICICI Bank " href="#"><img src="images/question.png" width="14" height="15" border="0"><span>
        <img class="callout" src="images/callout.gif" border="0" /></a></td>
      </tr>
       <tr>
        <td colspan="4" align="right" height="10" class="text-b"></td>
      </tr>
         <tr>
        <td align="right" class="text-b">City</td>
        <td>&nbsp;</td>
        <td align="left"><select name="City" id="City" class="select" onChange="validateDiv('cityVal');" tabindex="2">
<?=plgetCityList($City)?>
                   <option value="Vapi">Vapi</option>
				   <option value="Ankleshwar">Ankleshwar</option>
				    <option value="Anand">Anand</option>
					 <option value="Anand">Dahod</option>
					  <option value="Anand">Navsari</option>		 </select>
                         <div id="cityVal" class="alert_msg"></div>
          </td>
        <td align="left"><a id="city-basic" title="City where you reside" href="#"><img src="images/question.png" width="14" height="15" border="0"><span>
        <img class="callout" src="images/callout.gif" border="0" /></a></td>
      </tr>
       <tr>
        <td colspan="4" align="right" height="10" class="text-b"></td>
      </tr>
         <tr>
        <td align="right" class="text-b">DOB</td>
        <td>&nbsp;</td>
        <td align="left">                   
                        <input name="day" id="day" type="text" class="dd-icici-app" value="dd" onBlur="onBlurDefault(this,'dd');" onFocus="onFocusBlank(this,'dd');" maxlength="2" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" onKeyDown="validateDiv('dobVal');" tabindex=3/>&nbsp;        <input name="month" id="month" type="text" class="dd-icici-app" value="mm" onBlur="onBlurDefault(this,'mm');" onFocus="onFocusBlank(this,'mm');" maxlength="2" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" onKeyDown="validateDiv('dobVal');" tabindex="4"/>&nbsp;	<input name="year" id="year" type="text" class="yy-icici-app" value="yyyy" onBlur="onBlurDefault(this,'yyyy');" onFocus="onFocusBlank(this,'yyyy');" maxlength="4" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" onKeyDown="validateDiv('dobVal');" tabindex="5"/><div id="dobVal" class="alert_msg"></div></td>
        <td align="left"><a id="dob-basic" title="Provide Date of Birth" href="#"><img src="images/question.png" width="14" height="15" border="0"><span>
        <img class="callout" src="images/callout.gif" border="0" /></a></td>
      </tr>
      
      <tr>
        <td colspan="4" align="right" height="10" class="text-b"></td>
      </tr>
         <tr>
        <td align="right" class="text-b">Occupation</td>
        <td>&nbsp;</td>
        <td align="left"><select   name="Employment_Status"  id="Employment_Status" class="select" tabindex="6"  onchange="validateDiv('empStatusVal');" >
                           <option value="-1">Occupation</option>
                           <option value="1">Salaried</option>
                           <option value="0">Self Employment</option>
                       </select>  <div id="empStatusVal" class="alert_msg"></div>
         </td>
        <td align="left"> <a id="occupa-basic" title="What is your Occupation" href="#"><img src="images/question.png" width="14" height="15" border="0"><span>
        <img class="callout" src="images/callout.gif" border="0" /></a></td>
      </tr>
      <tr>
        <td colspan="4" align="right" height="10" class="text-b"></td>
      </tr>
      <tr>
        <td width="245" align="right" class="text-b">Company Name</td>
        <td width="13">&nbsp;</td>
        <td width="256" align="left">
        <input name="Company_Name" id="Company_Name" type="text" class="input" onBlur="onBlurDefault(this,'Type slowly to autofill');" onKeyUp="ajax_showOptions(this,'getCountriesByLetters',event, 'http://www.deal4loans.com/ajax-list-plicici.php')" onFocus="onFocusBlank(this,'Type slowly to autofill');" onKeyDown="validateDiv('companyNameVal');" value="Type slowly to autofill" tabindex="7"/>
                        <div id="companyNameVal" class="alert_msg"></div>
        
        </td>
        <td width="38" align="left"><a id="comp-basic" title="In which Company you work." href="#"><img src="images/question.png" width="14" height="15" border="0"><span>
        <img class="callout" src="images/callout.gif" border="0" /></a></td>
      </tr>
      <tr>
        <td colspan="4" align="right" height="10" class="text-b"></td>
      </tr>
      <tr>
        <td align="right" class="text-b">Net Annual Income</td>
        <td>&nbsp;</td>
        <td align="left">
    <input type="text" name="Net_Salary" id="Net_Salary" class="input" onKeyUp="intOnly(this); getDiToWordsIncome('Net_Salary','formatedIncome','wordIncome');" onKeyPress="intOnly(this);"  onblur="getDiToWordsIncome('Net_Salary','formatedIncome','wordIncome');"  tabindex="8" onKeyDown="validateDiv('netSalaryVal');" />
     <div id="netSalaryVal" class="alert_msg"></div> <span id='formatedIncome' style='font-size:11px;
font-weight:normal; color:#ffffff;font-Family:Verdana;'></span> <span id='wordIncome' style='font-size:11px;
font-weight:normal; color:#ffffff;font-Family:Verdana;text-transform: capitalize;'></span>
         </td>
        <td align="left"><a id="sal-basic" title="Net Salary your draw" href="#"><img src="images/question.png" width="14" height="15" border="0"><span>
        <img class="callout" src="images/callout.gif" border="0" /></a></td>
      </tr>
      <tr>
        <td colspan="4" align="right" height="10" class="text-b"></td>
      </tr>
      <tr>
        <td align="right" class="text-b">Total EMI per Month</td>
        <td>&nbsp;</td>
        <td align="left">    <input type="text" name="total_emi" id="total_emi" class="input" onKeyUp="intOnly(this); getDiToWordsIncome('total_emi','formatedemi','wordemi');" onKeyPress="intOnly(this);"  onblur="getDiToWordsIncome('total_emi','formatedemi','wordemi');" tabindex="9" /> <span id='formatedemi' style='font-size:11px;
font-weight:normal; color:#ffffff;font-Family:Verdana;'></span> <span id='wordemi' style='font-size:11px;
font-weight:normal; color:#ffffff;font-Family:Verdana;text-transform: capitalize;'></span></td>
        <td align="left"><a id="emi-basic" title="Total EMI per Month" href="#"><img src="images/question.png" width="14" height="15" border="0"><span>
        <img class="callout" src="images/callout.gif" border="0" /></a></td>
      </tr>
      <tr>
        <td colspan="4" align="right" height="10" class="text-b"></td>
      </tr>
        <tr>
        <td align="right" class="text-b">Total EMI for Personal Loan</td>
        <td>&nbsp;</td>
        <td align="left"><input type="text" name="other_emi" id="other_emi" class="input" onKeyUp="intOnly(this); getDiToWordsIncome('other_emi','formatedother_emi','wordother_emi');" onKeyPress="intOnly(this);"  onblur="getDiToWordsIncome('other_emi','formatedother_emi','wordother_emi');" tabindex="10" /><span id='formatedother_emi' style='font-size:11px;
font-weight:normal; color:#ffffff;font-Family:Verdana;'></span> <span id='wordother_emi' style='font-size:11px;
font-weight:normal; color:#ffffff;font-Family:Verdana;text-transform: capitalize;'></span></td>
        <td align="left"><a id="obli-basic" title="Total EMI for Personal Loan" href="#"><img src="images/question.png" width="14" height="15" border="0"><span>
        <img class="callout" src="images/callout.gif" border="0" /></a></td>
      </tr>
      <tr>
        <td colspan="4" align="right" height="10" class="text-b"></td>
      </tr>
     
      <!--<tr>
        <td align="right" class="text-b">Total Experience</td>
        <td>&nbsp;</td>
        <td align="left"><input  type="text" class="input" name="total_experience" id="total_experience"  onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" value=""  onkeydown="validateDiv('expVal');" tabindex="11"><div id="expVal" class="alert_msg"></div></td>
        <td align="left"> <a id="te-basic" title="Total Experience" href="#"><img src="images/question.png" width="14" height="15" border="0"><span>
        <img class="callout" src="images/callout.gif" border="0" /></a></td>
      </tr>
      <tr>
        <td colspan="4" align="right" height="10" class="text-b"></td>
      </tr>-->
      <tr>
        <td colspan="4" align="right" height="10" class="text-b">    <input name="accept" type="checkbox" />  I Agree to <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow"  class="text" style=" color:#fff; text-decoration:none; font-size:11px;">Privacy policy</a> and <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow"  class="text" style="color:#fff; font-size:11px; text-decoration:none;">Terms and Conditions</a>.
              <div id="acceptVal" class="alert_msg"></div></td></tr>
              
                    <tr>
        <td colspan="4" align="right" height="10" class="text-b"></td>
      </tr>
      <tr>
        <td align="center" class="text-b">&nbsp;</td>
        <td align="center" class="text-b">&nbsp;</td>
        <td colspan="2" align="left" class="text-b"><input type="submit" style="border: 0px none ; background: #fe9515 url(images/submit-app.png); width: 135px; height: 40px; margin-bottom: 0px;" value=""/></td>
      </tr>
    </table></form>
  </div>
  <div class="arrow-bx"><img src="images/arrow-app.png" width="98" height="53"></div>
</div>
<div style="clear:both;"></div></div>
</div>
</body>
</html>