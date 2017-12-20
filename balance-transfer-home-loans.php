<?php
require 'scripts/session_check.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';

$maxage=date('Y')-62;
$minage=date('Y')-18;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'> 
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<title>Home Loan Transfer: Calculate & Apply for new bank</title>
<meta name="keywords" content="home loan transfer, home loan balance transfer, balance transfer home loan, housing loan transfer, interest rates of balance transfer, home loan transfer documents, home loan transfer eligibility">
<meta name="description" content="By Using Home loan transfer you can save upto lacs of Rupees on you current home loans. Calculate & Apply for best bank to save your hard earned money.">
<link href="css/common-d4l-styles.css" type="text/css" rel="stylesheet"  />
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
-->
</style>
<link href="source.css" rel="stylesheet" type="text/css" />
<link href="css/hl-intrrates.css" rel="stylesheet" type="text/css" />
<!--
<script type="text/javascript" src="scripts/mainmenu.js"></script>
<script type="text/javascript" src="js/dropdowntabs.js"></script>
<script type="text/javascript" src="js/jquery-1.2.6.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-personalized-1.5.2.packed.js"></script>
<script type="text/javascript" src="js/sprinkle.js"></script>
<script type="text/javascript" src="js/easySlider1.5.js"></script>
-->
<link href="css/slider.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="scripts/common.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<script type="text/javascript" src="ajax.js"></script>
<script type="text/javascript" src="ajax-dynamic-list.js"></script>
<style>
/* Big box with list of options */
#ajax_listOfOptions{
	position:absolute;	/* Never change this one */
	width:149px;	/* Width of box */
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
</style>
<script type="text/javascript">
/*
	$(document).ready(function(){	
		$("#slider").easySlider({
			controlsBefore:	'<p id="controls">',
			controlsAfter:	'</p>',
			auto: false, 
			continuous: true
			
		});
		$("#slider2").easySlider({
			controlsBefore:	'<p id="controls2">',
			controlsAfter:	'</p>',		
			prevId: 'prevBtn2',
			nextId: 'nextBtn2',
			auto: true, 
			continuous: true	
		});		
	});
*/	
</script>

<Script Language="JavaScript">
function validmail(email1) 
{
	invalidChars = " /:,;";
	if (email1 == "")
	{// cannot be empty
		alert("Invalid E-mail ID.");
		return false;	
	}
	for (i=0; i<invalidChars.length; i++) 
	{	// does it contain any invalid characters?
		badChar = invalidChars.charAt(i);
		if (email1.indexOf(badChar,0) > -1) 
		{
			return false;
		}
	}
	atPos = email1.indexOf("@",1)// there must be one "@" symbol
	if (atPos == -1) 
	{
		alert("Invalid E-mail ID.");
		return false;
	}
	if (email1.indexOf("@",atPos+1) != -1) 
	{	// and only one "@" symbol
		alert("Invalid E-mail ID.");
		return false;
	}
	periodPos = email1.indexOf(".",atPos)
	if (periodPos == -1) 
	{// and at least one "." after the "@"
		alert("Invalid E-mail ID.");
		return false;
	}
	//alert(periodPos);
	//alert(email.length);
	if (periodPos+3 > email1.length)	
	{		// must be at least 2 characters after the "."
		alert("Invalid E-mail ID.");
		return false;
	}
	return true;
}
function cityother()
{
	if(document.loan_form.City.value=="Others")
	{
		document.loan_form.City_Other.disabled = false;
	}
	else
	{
		document.loan_form.City_Other.disabled = true;
	}
} 
function validmobile(mobile) 
{
	atPos = mobile.indexOf("0")// there must be one "@" symbol
	if (atPos == 0) 
	{
		alert("Mobile number cannot start with 0.");
		return false;
	}
	if(!checkData(document.loan_form.Phone, 'Mobile number', 10))
		return false;

return true;
}
/*
function Decorate(strPlan)
{
   if (document.getElementById('plantype2') != undefined)  
   {
	   document.getElementById('plantype2').innerHTML = strPlan;
	   document.getElementById('plantype2').style.background='Beige';  
   }
   return true;
}
function Decorate1(strPlan)
{
   if (document.getElementById('plantype2') != undefined) 
   {
	   document.getElementById('plantype2').innerHTML = strPlan;
	   document.getElementById('plantype2').style.background='';  
   }
   return true;
}
*/
function addIdentified()
{
	var ni = document.getElementById('myDiv1');
	ni.innerHTML = '<table width="100%" align="left" border="0"><tr><td height="20"  align="left" valign="middle" class="frmbldtxt"><b style="color:#373737;">Property Location</b></td>	<td colspan="3" align="left" height="20" >&nbsp;&nbsp;&nbsp;<select style="width:150px;" name="Property_Loc" id="Property_Loc" tabindex="16"><?=getCityList1($City)?></select></td></tr></table>';
	return true;
}	
	
function removeIdentified()
{
	var ni = document.getElementById('myDiv1');
	ni.innerHTML = '<table border="0"><tr><td height="20" colspan="2" align="left" valign="center" class="subheading"><input type="checkbox" name="updateProperty" style="border:none;" ><span class="form-text">&nbsp;Can we tell you about some properties</font></td></tr></table>';
	return true;
}	

function validateDiv(div)
{

	var ni1 = document.getElementById(div);
	ni1.innerHTML = '';
}

function Trim(strValue) {
var j=strValue.length-1;i=0;
while(strValue.charAt(i++)==' ');
while(strValue.charAt(j--)==' ');
return strValue.substr(--i,++j-i+1);
}

function chkform()
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
	
  
	if (document.loan_form.Existing_Bank.value=="")
	{
		document.getElementById('existingBankVal').innerHTML = "<span  class='hintanchor'>Enter Existing Bank!</span>";	
		document.loan_form.Existing_Bank.focus();
		return false;
	}	
	
	if (document.loan_form.Existing_Loan.value=="")
	{
		document.getElementById('existingLoanVal').innerHTML = "<span  class='hintanchor'>Enter Existing Loan!</span>";	
		document.loan_form.Existing_Loan.focus();
		return false;
	}	
	
	if (document.loan_form.Existing_ROI.value=="")
	{
		document.getElementById('existingROIVal').innerHTML = "<span  class='hintanchor'>Enter Existing ROI!</span>";	
		document.loan_form.Existing_ROI.focus();
		return false;
	}	

	if((document.loan_form.Name.value=="") || (Trim(document.loan_form.Name.value))==false)
	{
        document.getElementById('nameVal').innerHTML = "<span  class='hintanchor'>Please Enter Your name</span>";		
		document.loan_form.Name.focus();
		return false;
	}

	if(document.loan_form.Name.value!="")
	{
		if(containsdigit(document.loan_form.Name.value)==true)
		{
			document.getElementById('nameVal').innerHTML = "<span  class='hintanchor'>First Name contains numbers!</span>";
			document.loan_form.Name.focus();
			return false;
		}
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
	
	if (document.loan_form.City.selectedIndex==0)
	{
		document.getElementById('cityVal').innerHTML = "<span  class='hintanchor'>Enter City to Continue!</span>";	
		document.loan_form.City.focus();
		return false;
	}
	
	if (document.loan_form.Employment_Status.selectedIndex==0)
	{
		document.getElementById('empStatusVal').innerHTML = "<span  class='hintanchor'>Select Employment Status to Continue!</span>";	
		document.loan_form.Employment_Status.focus();
		return false;
	}

	if (document.loan_form.Net_Salary.value=="")
	{
		document.getElementById('netSalaryVal').innerHTML = "<span  class='hintanchor'>Enter Annual Income!</span>";	
		document.loan_form.Net_Salary.focus();
		return false;
	}	
	if(!checkNum(document.loan_form.Net_Salary, 'Annual Income',0))
		return false;
		
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
	if(!document.loan_form.accept.checked)
	{
		document.getElementById('acceptVal').innerHTML = "<span  class='hintanchor'>Accept Terms and Condition!</span>";	
	document.loan_form.accept.focus();
	return false;
	}
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

function addibibo()
{
	var ni1 = document.getElementById('getibibo');
	var cit = document.loan_form.City.value;
	//alert(cit);	
	if(cit!="Please Select")
	{
		//alert("ranjana");
		ni1.innerHTML = ' <table  style="border:1px solid #999999; padding:2px;"> <tr> <td class="frmbldtxt" style="font-size:14px; color:#666666; font-weight:normal; "> <u>Special offer for Deal4loans customers</u></td>		 </tr>	  <tr>	 <td class="frmbldtxt" style=" font-size:10px; color:#666666; font-weight:normal;"> Take  a Free Test  Drive for New Maruti  and <b>Win a Branded Laptop</b></td> </tr>	 <tr> <td style=" font-size:10px; color:#666666; font-weight:normal; "> <input type="radio" name="Ibibo_compaign" id="Ibibo_compaign" style="border:none;" value="Estillo"/> Estillo <input type="radio" style="border:none;" value="WagonR" name="Ibibo_compaign" id="Ibibo_compaign"/> WagonR <input type="radio" name="Ibibo_compaign" id="Ibibo_compaign" value="A-Star" style="border:none;"/> A-Star</td>	 </tr>	</table>	';	
	}
	else
	{
		ni1.innerHTML = '';
	}
	return true;
}
function addtooltip()
{
	var ni = document.getElementById('myDiv');
	if(ni.innerHTML=="")
	{
		if(document.loan_form.Phone.value="on")
		{
			ni.innerHTML = 'Please give correct Mobile Number to Activate your Loan Request';
		}
	}
	return true;
}
function removetooltip()
{
	var ni = document.getElementById('myDiv');
	
	if(ni.innerHTML!="")
	{
		if(document.loan_form.Phone.value!="")
		{
			ni.innerHTML = '';
		}
	}
	return true;
}
	
function othercity1()
{

	var ni10 = document.getElementById('otherDetails');
	alert("fdfds");
	ni10 = 'fdddfdfdfghg';
	//ni1 = '<div class="input_box"><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td height="58" align="left" valign="top"><div style=" float:left; width:183px; height:45px; margin-left:0px; margin-top:5px;"><div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Other City:</div><div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;"><input name="City_Other" id="City_Other" type="text" class="input" disabled onKeyUp="searchSuggest();" onkeydown="validateDiv(\'othercityVal\');"  tabindex="15" /><div id="othercityVal"></div>   </div></div></td></tr></table></div>';
}

function addPersonalDetails()
{
	var ni1 = document.getElementById('personalDetails');
	var ni2 = document.getElementById('addSubmit');
	
	ni1.innerHTML = '<div class="box_c"><div class="text_head" style=" margin:0px 0px 0px 0px; padding:0px 0px 0px 0px; font-size:21px; color: #FFFFFF"><div class="prs_detl_box" style="text-align:left; margin-left:25px;"><div class="prs_detl_box_a"><span style="font-size:21px; color:#FFFFFF;">Personal Details</span></div><div class="prs_detl_box_b" style="text-align:left;"><span style="font-size:13px; font-weight:normal; color:#fff;"><img src="images/security.png" width="14" height="16" /> Your Information is secure with us and will not be shared without your consent</span></div><div style="clear:both;"></div></div><div style="clear:both;"></div></div><div style=" clear:both;"></div><div class="input_box"><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td width="100%" height="58" align="left" valign="top"><div style=" float:left; width:183px; height:45px; margin-left:0px; margin-top:5px;"><div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Full Name:</div><div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;"><input name="Name" id="Name" type="text" class="input" onkeydown="validateDiv(\'nameVal\');" tabindex="5" /><div id="nameVal"></div>   </div></div></td></tr></table></div><div class="input_box"><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td height="58"><div style=" float:left; width:183px; height:45px; margin-left:0px; margin-top:5px;"><div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Email ID :</div><div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;"><input name="Email" id="Email" type="text" class="input" onkeydown="validateDiv(\'emailVal\');" tabindex="6"  /><div id="emailVal"></div> </div></div></td></tr></table>   </div> <div class="input_box"><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td height="58"><div style=" float:left; width:183px; height:45px; margin-left:0px; margin-top:5px;"><div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;"><span class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Mobile:</span></div><div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;"><div class="text" style=" float:left; width:26px; height:auto; color:#FFF; font-size:12px; text-transform:none; clear:right; margin-top:3px; "> +91</div><div class="text" style=" float:left; width:26px; height:auto; color:#FFF; font-size:12px; text-transform:none; clear:right; "><input name="Phone" id="Phone" maxlength="10" onkeyup="intOnly(this);" onkeypress="intOnly(this)"; onchange="intOnly(this);" type="text" class="mobile" onkeydown="validateDiv(\'phoneVal\');"  tabindex="7" /><div id="phoneVal"></div>  </div></div></div></td></tr></table></div><div class="input_box"><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td width="192" height="58" align="left" valign="top"><div style=" float:left; width:183px; height:45px; margin-left:0px; margin-top:5px;"><div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">City:</div><div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;"><select name="City" id="City" class="select"  onChange="validateDiv(\'cityVal\');" tabindex="8"><?=getCityList($City)?></select><div id="cityVal"></div>   </div></div></td></tr></table></div><div style=" clear:both;"></div><div class="input_box"><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td height="58" align="left" valign="top"><div style=" float:left; width:183px; height:45px; margin-left:0px; margin-top:5px;"><div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;"><span class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Occupation: </span></div><div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;"><select name="Employment_Status" id="Employment_Status"  onchange="validateDiv(\'empStatusVal\');"  class="select" tabindex="14" ><option value="-1">Please Select</option><option value="1">Salaried</option><option value="0">Self Employment</option></select><div id="empStatusVal"></div></div></div></td></tr></table></div><div class="input_box"><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td width="100%" height="58" align="left" valign="top"><div style=" float:left; width:183px; height:45px; margin-left:0px; margin-top:5px;"><div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Annual Income:</div><div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;"><input type="text" name="Net_Salary" id="Net_Salary" class="input"  onkeyup="intOnly(this); getDigitToWords(\'Net_Salary\',\'formatedIncome\',\'wordIncome\');" onkeypress="intOnly(this);"  onblur="getDigitToWords(\'Net_Salary\',\'formatedIncome\',\'wordIncome\');"  onchange="ShowHide(\'incomeShow\',\'Net_Salary\');" onkeydown="validateDiv(\'netSalaryVal\');" tabindex="9"  /><div id="netSalaryVal"></div>   </div></div>  <span id=\'formatedIncome\' style=\'font-size:11px;font-weight:normal; color:#ffffff;font-Family:Verdana;\'></span> <span id=\'wordIncome\' style=\'font-size:11px;font-weight:normal; color:#ffffff;font-Family:Verdana;text-transform: capitalize;\'></span></td></tr></table>    </div><div class="input_box"><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td height="55" align="left" valign="top"><div style=" float:left; width:183px; height:45px; margin-left:0px; margin-top:5px;"><div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">DOB:</div><div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;"><input name="day" id="day" type="text" class="dd" value="dd" onblur="onBlurDefault(this,\'dd\');" onfocus="onFocusBlank(this,\'dd\');" maxlength="2" onkeyup="intOnly(this);" onkeypress="intOnly(this);" onkeydown="validateDiv(\'dobVal\');" tabindex="10" />&nbsp;<input name="month" id="month" type="text" class="dd" value="mm" onblur="onBlurDefault(this,\'mm\');" onfocus="onFocusBlank(this,\'mm\');" maxlength="2" onkeyup="intOnly(this);" onkeypress="intOnly(this);" onkeydown="validateDiv(\'dobVal\');" tabindex="11" />&nbsp;<input name="year" id="year" type="text" class="yy" value="yyyy" onblur="onBlurDefault(this,\'yyyy\');" onfocus="onFocusBlank(this,\'yyyy\');" maxlength="4" onkeyup="intOnly(this);" onkeypress="intOnly(this);" onkeydown="validateDiv(\'dobVal\');" tabindex="12" /><div id="dobVal"></div>   </div></div></td></tr></table></div><div class="input_box"><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td width="100%" height="58" align="left" valign="top"><div style=" float:left; width:183px; height:45px; margin-left:0px; margin-top:5px;"><div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Pincode:</div><div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;"><input name="Pincode" id="Pincode" maxlength="9" onkeypress="intOnly(this);" onkeyup="intOnly(this);"  onkeydown="validateDiv(\'pincodeVal\');" type="text" class="input" tabindex="13" /><div id="pincodeVal"></div></div></div></td></tr></table></div><div style=" clear:both;"></div><div id="otherDetails"></div>';
	
	ni2.innerHTML = '<div class="second_wrapper"><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td width="87%"  align="left" valign="top"><div class="text" style=" float:left; height:auto; color:#FFF; font-size:11px; text-transform:none; margin-top:25px; margin-left:25px;"><input name="accept" type="checkbox" checked="checked" tabindex="16" /> I Agree to&nbsp;<a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow"  class="text" style=" color:#88a943; font-size:11px; text-decoration:underline;">privacy policy</a> and&nbsp;<a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow"  class="text" style=" color:#88a943; font-size:11px; text-decoration:underline;">Terms and Conditions</a>.<div id="acceptVal"></div>    </div></td><td width="13%"   align="left" valign="top"><div style=" float:left; width:114px; height:55px margin-top:0px; margin-left:0px;">  <input type="submit" style="border: 0px none ; background-image: url(images/get1.gif); width: 114px; height: 52px; margin-bottom: 0px;" value="" tabindex="17" /></div></td></tr><tr><td  align="left" valign="top"><div id="hdfclife"></div></td></tr></table></div>';
}
/*
function showdetailsFaq(d,e)
{			
	for(j=1;j<=e;j++)
		{
			if(d==j)
				{
					if(eval(document.getElementById("divfaq"+j)).style.display=='none')
						{
						
							eval(document.getElementById("divfaq"+j)).style.display=''
							//eval(document.getElementById("imgfaq"+j)).src='images/minus2.gif'
						}
					else
						{
							
							eval(document.getElementById("divfaq"+j)).style.display='none'
							//eval(document.getElementById("imgfaq"+j)).src='images/plus2.gif'
						}
				}
			
		}
}
//window.onload=showdetailsFaq
*/
</script>
<Script Language="JavaScript">
var ajaxRequestMain;  // The variable that makes Ajax possible!
function ajaxFunctionMain(){
	
	try{
		// Opera 8.0+, Firefox, Safari
		ajaxRequestMain = new XMLHttpRequest();
	} catch (e){
		// Internet Explorer Browsers
		try{
			ajaxRequestMain = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {
			try{
				ajaxRequestMain = new ActiveXObject("Microsoft.XMLHTTP");
			} catch (e){
				// Something went wrong
				alert("Your browser broke!");
				return false;
			}
		}
	}
}

function insertData()
{
	var get_full_name = document.getElementById('Name').value;
	//var get_full_name = document.getElementById('full_name').value;
	var get_email = document.getElementById('Email').value;
	//var get_email = document.getElementById('email').value;		
	var get_mobile_no = document.getElementById('Phone').value;
	//var get_mobile_no = document.getElementById('mobile_no').value;
	var get_city = document.getElementById('City').value;
	var get_id = document.getElementById('Activate').value;
	//alert();
	var get_product ="2";
	var queryString = "?get_Mobile=" + get_mobile_no +"&get_City=" + get_city + "&get_Full_Name=" + get_full_name +"&get_Email=" + get_email +"&get_product=" + get_product +"&get_Id=" + get_id ;
		
	//alert(queryString); 
	ajaxRequestMain.open("GET", "insert-incomplete-data.php" + queryString, true);
	// Create a function that will receive data sent from the server
	ajaxRequestMain.onreadystatechange = function(){
		if(ajaxRequestMain.readyState == 4)
		{
			document.getElementById('Activate').value=ajaxRequestMain.responseText;
		}
	}
	ajaxRequestMain.send(null); 			 
}
window.onload = ajaxFunctionMain;
</script>
<link href="icici-hl-frm-styles.css" type="text/css" rel="stylesheet" />
<style> .box_c {width: 950px;margin: auto;} .mobile {width: 160px;height: 18px;margin-left: 5px; } .style1 {font-family: 'Droid Sans', sans-serif}</style>
</head>

<body>
<?php include "middle-menu.php"; ?>
<div class="intrl_txt">	
<div class="text12" style="margin:auto; width:970px; height:11px; margin-top:70px; color:#0a8bd9;"><u><a href="index.php" class="text12" style="color:#0080d6;" >Home</a></u> > <a href="home-loans.php"  class="text12" style="color:#0080d6;"><u>Home Loan</u></a> <span class="text12" style="color:#4c4c4c;">> Apply Home Loan</span></div>
<div class="intrl_txt" style="margin:auto;">
<div style="clear:both; height:15px;"></div>
 	  <font face="Verdana, Arial, Helvetica, sans-serif" color="#FF0000"><strong><?php if(isset($_GET['msg']) && ($_GET['msg']=="NotAuthorised")) echo "Kindly give Valid Details"; ?></strong></font>

<form name="loan_form" method="post" action="balance-transfer-home-loans-continue.php" onSubmit="return chkform();">
 <input type="hidden" name="Activate" id="Activate" >
 <input type="hidden" name="Balance_Transfer" id="Balance_Transfer" value="Balance Transfer" >
 <input type="hidden" name="source" value="Balance Transfer">
 <div class="form_section">
 <div class="text_head"><strong>Apply For Home Loan Balance Transfer</strong></div>
<div class="input_box">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td height="58" align="left" valign="top"><div style=" float:left; width:183px; height:45px; margin-left:0px; margin-top:5px;">
                      <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Balance Transfer Amount:</div>
                    <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;">
                    <input name="Loan_Amount" id="Loan_Amount" maxlength="8" onkeypress="intOnly(this);" onkeyup="intOnly(this); getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');"  onblur="getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');"  type="text" class="input" onkeydown="validateDiv('loanAmtVal');" tabindex="1" />
     <div id="loanAmtVal"></div>
                    </div>
                  </div><span id='formatedlA' style='font-size:11px;
font-weight:normal; color:#ffffff;font-Family:Verdana;'></span><span id='wordloanAmount' style='font-size:11px;
font-weight:normal; color:#ffffff;font-Family:Verdana;text-transform: capitalize;'></span></td>
                </tr>
</table></div>                <div class="input_box">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td height="58" align="left" valign="top"><div style=" float:left; width:183px; height:45px; margin-left:0px; margin-top:5px;">
                      <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Name of Existing Bank:</div>
                    <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;">
                       <input type="text" name="Existing_Bank"  id="Existing_Bank" tabindex="2" onkeyup="ajax_showOptions(this,'getCountriesByLetters',event); getstatementlink();" onchange="getstatementlink();" onkeydown="getstatementlink();" onclick="getstatementlink();" class="input" />
     <div id="existingBankVal"></div>
                    </div>
                  </div></td>
                </tr>
</table></div>                <div class="input_box">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td height="58" align="left" valign="top"><div style=" float:left; width:183px; height:45px; margin-left:0px; margin-top:5px;">
                      <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Existing Loan Amount:</div>
                    <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;">
                       <input type="text" name="Existing_Loan"  id="Existing_Loan" tabindex="3"   class="input" />
     <div id="existingLoanVal"></div>
                    </div>
                  </div></td>
                </tr>
          
            </table>          </div>      <div class="input_box">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="281" height="58" align="left" valign="top"><div style=" float:left; width:183px; height:45px; margin-left:0px; margin-top:5px;">
                      <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Existing ROI:</div>
                    <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;">
                       <input type="text" name="Existing_ROI"  id="Existing_ROI" tabindex="4"   class="input" onfocus="addPersonalDetails();" onkeypress="addPersonalDetails();" autocomplete="off" />
     <div id="existingROIVal"></div>
                    </div>
                    
                  </div></td> 
</tr></table>       </div>
<div style=" clear:both;"></div>
<div id="personalDetails">       <div class="second_wrapper">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
                <td width="87%"  align="left" valign="top">&nbsp;</td>
                <td width="13%"   align="left" valign="top"><div style=" float:left; width:114px; height:55px; margin-top:0px; margin-left:0px;"> <img src="images/get1.gif" width="114" height="52" border="0" /></div></td>
              </tr>
           
            </table>      
</div></div>
<div style="clear:both;"></div>
<div id="addSubmit"></div>
</div><div style="clear:both;"></div>
        
        
        </form>

	<br />&bull; It's a totally free service for customers<br />
    &bull; All loans repayment period are over 6 months. No short term loans.<br /><br />

	<table width="100%"  border="0" cellspacing="0" cellpadding="0" style="border: 1px solid #d5cfb1; ">
  <tr>
    <td><table width="100%" border="0" align="left" cellpadding="0" cellspacing="1" >
  
  <tr>
        <td width="101" height="43" align="center" valign="middle" class="font2" style="background-color:#88a943; border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1;"><strong class="text3" style="color:#FFF; text-transform:none; font-size:18px;"><strong>Banks</strong></strong></td>
        <td width="215" height="43" align="center" valign="middle" class="font2" style="background-color:#88a943; border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1;"><strong class="text3" style="color:#FFF; text-transform:none; font-size:18px;"><strong>ICICI Bank</strong></strong></td>
        <td width="335" height="43" align="center" valign="middle" class="font2" style="background-color:#88a943; border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1;"><strong class="text3" style="color:#FFF; text-transform:none; font-size:18px;"><strong>HDFC Ltd</strong></strong></td>
        <td width="201" height="43" align="center" valign="middle" class="font2" style="background-color:#88a943; border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1;"><strong class="text3" style="color:#FFF; text-transform:none; font-size:18px;"><strong>PNB Housing Finance</strong></strong></td>
        <td width="110" height="43" align="center" valign="middle" class="font2" style="background-color:#88a943; border-bottom:1px solid #d5cfb1;"><strong class="text3" style="color:#FFF; text-transform:none; font-size:18px;"><strong>Axis Bank</strong></strong></td>
        </tr>

  <tr>
   <td height="57" align="center" valign="middle" class="font2" style="border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1; padding-left:2px;font-size:13px;"><b>Rate of Interest</b></td>
    <td align="center" class="style1" style="border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1; padding-left:2px; font-size: 12px; font-variant: normal; color: #666666; text-decoration: none; @import url(http://fonts.googleapis.com/css?family=Droid+Sans);">8.65% to 8.70%</td>
    <td align="center" valign="middle" class="style1" style="border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1; padding-left:2px; font-size: 12px; font-variant: normal; color: #666666; text-decoration: none; @import url(http://fonts.googleapis.com/css?family=Droid+Sans);">8.65% to 8.70%</td>
    <td align="center" valign="middle" class="style1" style="border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1; padding-left:2px; font-size: 12px; font-variant: normal; color: #666666; text-decoration: none; @import url(http://fonts.googleapis.com/css?family=Droid+Sans);">8.90% - 9.10%</td>
	 <td align="center" valign="middle" class="style1" style="border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1; padding-left:2px; font-size: 12px; font-variant: normal; color: #666666; text-decoration: none; @import url(http://fonts.googleapis.com/css?family=Droid+Sans);">8.85%</td>
  </tr>
  <tr>
    <td height="57" align="center" valign="middle" class="font2" style="border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1; padding-left:2px; font-size:13px;"><b>Processing Fee</b></td>
    <td align="center" valign="middle" class="font2"  style="border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1;">0.5 to 1.00% of loan amount</td>
    <td align="center" valign="middle" class="font2" style="border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1;">Upto 0.50% of loan amount</td>
    <td align="center" valign="middle" class="font2" style="border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1;">0.50% to 50000.</td>
	    <td align="center" valign="middle" class="font2" style="border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1;">Rs.10000 to Rs.25000</td>
  </tr>
  <tr>
   <td height="57" align="center" valign="middle" class="font2" style="border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1; padding-left:2px;font-size:13px;"><b>EMI Per Lac</b></td>
<td align="center" valign="middle"  class="font2" style="border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1;">Rs.780 - Rs.783</td>
    <td align="center" valign="middle" class="font2" style="border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1;">Rs.780 - Rs.783</td>
    <td align="center" valign="middle" class="font2" style="border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1;">Rs.797 - Rs.812</td>
	    <td align="center" valign="middle" class="font2" style="border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1;">Rs.794</td>
  </tr>
   <tr>
    <td height="57" align="center" valign="middle" class="font2" style="border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1; padding-left:2px;font-size:13px;"><b>Prepayment Charges</b></td>
<td align="center" valign="middle" class="font2" style="border-right:1px solid #d5cfb1;">Nil</td>
    <td align="center" valign="middle" class="font2" style="border-right:1px solid #d5cfb1;">Nil</td>
    <td align="center" valign="middle" class="font2"  style="border-right:1px solid #d5cfb1;">Nil</td>
	    <td align="center" valign="middle" class="font2" style="border-right:1px solid #d5cfb1; ">Nil</td>
  </tr>
</table></td>
  </tr>
 
</table>


<div class="sldrpnl" >
	<div id="slider">
		<ul>				
			        <li>
<div><img src="new-images/slider/thumb/hdfc-h.jpg" alt="HDFC" width="126" height="52"  style="border:none;"/></div>
<div><img src="new-images/slider/thumb/axis.jpg" alt="Axis Bank" width="140" height="42"  style="border:none;"/></div>
<div><img src="new-images/slider/thumb/hfc_logo.jpg" alt="ICICI HFC" width="147" height="37"  style="border:none;"/></div>
<div><img src="new-images/slider/thumb/fblue.gif" alt="First Blue" width="126" height="41"  style="border:none;"/></div>

            </li>
         
		</ul>
	</div>
</div>
<br />
</div>
</div>

<?php include "footer_sub_menu.php"; ?>
</body>
</html>
</html>