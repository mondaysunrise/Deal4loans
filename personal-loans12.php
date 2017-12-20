<?php
	ob_start( 'ob_gzhandler' );
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
$maxage=date('Y')-62;
$minage=date('Y')-18;
if(strlen($_REQUEST['source'])>0){	$retrivesource="HL Site Page"; }else{	$retrivesource="HL Site Page";}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'> 
<link href="css/personal-loan-sbi-styles.css" type="text/css" rel="stylesheet" />
<title>Personal Loan India | Documents | Criteria | 2014</title>
<meta name="keywords" content="Personal Loan, best personal loans, Personal Loans, Personal Loan India, compare personal loans, personal loans comparison, online personal loans, Personal Loans India, Personal loans Online">
<meta name="description" content="Personal loans: Get Instant approval on personal loans by HDFC, ICICI, Bajaj Finserv, Kotak, Fullerton India, SBI & Axis Bank at lowest Rates & EMI. Check criteria, most borrowed, cibil effects on personal loans.">
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
	form{
		display:inline;
	}
.ui-dialog { position: absolute; padding: .2em; width: 700px; overflow: hidden; z-index:1001;}
.ui-dialog .ui-dialog-titlebar { padding: .4em 1em; position: relative;  }
.ui-dialog .ui-dialog-title { float: left; margin: .1em 16px .1em 0; font-size:11px; line-height:18px;}
.ui-dialog .ui-dialog-titlebar-close { position: absolute; right: .3em; top: 50%; width: 19px; margin: -10px 0 0 0; padding: 1px; height: 18px; }
.ui-dialog .ui-dialog-titlebar-close span { display: block; margin: 1px; }
.ui-dialog .ui-dialog-titlebar-close:hover, .ui-dialog .ui-dialog-titlebar-close:focus { padding: 0; }
.ui-dialog .ui-dialog-buttonpane { text-align: left; border-width: 1px 0 0 0; background-image: none; margin: .5em 0 0 0; padding: .3em 1em .5em .4em; }
.ui-dialog .ui-dialog-buttonpane .ui-dialog-buttonset { float: right; }
.ui-dialog .ui-dialog-buttonpane button { margin: .5em .4em .5em 0; cursor: pointer; }
.ui-dialog .ui-resizable-se { width: 14px; height: 14px; right: 3px; bottom: 3px; }
.ui-draggable .ui-dialog-titlebar { cursor: move; }
</style>
  <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.1/themes/base/jquery-ui.css" />
  <link href="css/personal-loan-sbi-styles121.css" type="text/css" rel="stylesheet" />
    <script src="http://code.jquery.com/jquery-1.8.2.js"></script>
    <script src="/resources/demos/external/jquery.bgiframe-2.1.2.js"></script>
    <script src="http://code.jquery.com/ui/1.9.1/jquery-ui.js"></script>
<script type="text/javascript" src="http://www.deal4loans.com/ajax.js"></script>
<script type="text/javascript" src="http://www.deal4loans.com/ajax-dynamic-pllist.js"></script>
<script type="text/javascript" src="scripts/mainmenu.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<script type="text/javascript" src="scripts/common.js"></script>
<script language="JavaScript" type="text/javascript" src="http://www.deal4loans.com/suggest.js"></script>
<script language="javascript">
$(function() {
	$("#IncomeAmount").focusout(function(){
			if($("#IncomeAmount").val()<=50000){

		var ai=$("#IncomeAmount").val();
	var mai= Math.round(ai/12);
		    $( "#dialog-modal" ).dialog({
			title:"You Have Indicated Your Annual Income Is 'Rs. " + ai + "' which is 'Rs." + mai + "' per month. If correct Continue or Edit Annual Income to get Right Quote",
            height: 0,
            modal: true
        });
			//$("#IncomeAmount").val().focus();
		}
		});
    });

function onFocusBlank(element,defaultVal){	if(element.value==defaultVal){		element.value="";	} }
function onBlurDefault(element,defaultVal){	if(element.value==""){		element.value = defaultVal;	} }

function Trim(strValue) {	var j=strValue.length-1;i=0;	while(strValue.charAt(i++)==' ');	while(strValue.charAt(j--)==' ');	return strValue.substr(--i,++j-i+1); }
function containsdigit(param) {	mystrLen = param.length;	for(i=0;i<mystrLen;i++)	{		if((param.charAt(i)=="0") || (param.charAt(i)=="1") || (param.charAt(i)=="2") || (param.charAt(i)=="3") || (param.charAt(i)=="4") || (param.charAt(i)=="5") || (param.charAt(i)=="6") || (param.charAt(i)=="7") || (param.charAt(i)=="8") || (param.charAt(i)=="9") || (param.charAt(i)=="/"))		{			return true;		}	}	return false; }
function chkpersonalloan(Form)
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

	if (document.personalloan_form.Loan_Amount.value=="")
	{
		document.getElementById('loanAmtVal').innerHTML = "<span  class='hintanchor'>Enter Loan Amount!</span>";	
		document.personalloan_form.Loan_Amount.focus();
		return false;
	}	
	if(!checkNum(document.personalloan_form.Loan_Amount, 'Loan Amount',0))
		return false;

	if (document.personalloan_form.Employment_Status.selectedIndex==0)
	{
		document.getElementById('empStatusVal').innerHTML = "<span  class='hintanchor'>Select Employment Status to Continue!</span>";	
		document.personalloan_form.Employment_Status.focus();
		return false;
	}
	 if (document.personalloan_form.Employment_Status.value==0)
	{
		if (document.personalloan_form.Annual_Turnover.selectedIndex==0)
	{
		document.getElementById('annualTurnoverVal').innerHTML = "<span  class='hintanchor'>Select Annual Turnover to Continue!</span>";	
		document.personalloan_form.Annual_Turnover.focus();
		return false;
	}
	}
 if(document.personalloan_form.Employment_Status.value==1)
	{
	if((document.personalloan_form.Company_Name.value=="") || (document.personalloan_form.Company_Name.value=="Type slowly to autofill")|| (Trim(document.personalloan_form.Company_Name.value))==false)
	{
		document.getElementById('companyNameVal').innerHTML = "<span  class='hintanchor'>Fill Company Name!</span>";	
		document.personalloan_form.Company_Name.focus();
		return false;
	}
	else if(document.personalloan_form.Company_Name.value.length < 3)
	{
		document.getElementById('companyNameVal').innerHTML = "<span  class='hintanchor'>Fill Company Name!</span>";	
		document.personalloan_form.Company_Name.focus();
		return false;
	}
	}

		if (document.personalloan_form.IncomeAmount.value=="")
	{
		document.getElementById('netSalaryVal').innerHTML = "<span  class='hintanchor'>Enter Annual Income!</span>";	
		document.personalloan_form.IncomeAmount.focus();
		return false;
	}	
	if(!checkNum(document.personalloan_form.IncomeAmount, 'Annual Income',0))
		return false;

	if (document.personalloan_form.City.selectedIndex==0)
	{
		document.getElementById('cityVal').innerHTML = "<span  class='hintanchor'>Enter City to Continue!</span>";	
		document.personalloan_form.City.focus();
		return false;
	}
	if((document.personalloan_form.City.value=="Others") && ((document.personalloan_form.City_Other.value=="" || document.personalloan_form.City_Other.value=="Other City"  ) || !isNaN(document.personalloan_form.City_Other.value)))
	{
		document.getElementById('othercityVal').innerHTML = "<span  class='hintanchor'>Enter Other City to Continue!</span>";		
		document.personalloan_form.City_Other.focus();
		return false;
	}

	if((document.personalloan_form.Name.value==""))
	{
        document.getElementById('nameVal').innerHTML = "<span  class='hintanchor'>Please Enter Your name</span>";		
		document.personalloan_form.Name.focus();
		return false;
	}

	if(document.personalloan_form.Name.value!="")
	{
		if(containsdigit(document.personalloan_form.Name.value)==true)
		{
			document.getElementById('nameVal').innerHTML = "<span  class='hintanchor'>First Name contains numbers!</span>";
			document.personalloan_form.Name.focus();
			return false;
		}
	}
   for (var i = 0; i <document.personalloan_form.Name.value.length; i++) 
   {
		if (iChars.indexOf(document.personalloan_form.Name.value.charAt(i)) != -1) 
		{
			document.getElementById('nameVal').innerHTML = "<span  class='hintanchor'>Contains special characters!</span>";
			document.personalloan_form.Name.focus();
			return false;
		}
  }
  
  if(document.personalloan_form.Phone.value=="")
	{
		document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Fill Mobile Number!</span>";
		document.personalloan_form.Phone.focus();
		return false;
	}
	if(isNaN(document.personalloan_form.Phone.value)|| document.personalloan_form.Phone.value.indexOf(" ")!=-1)
	{
		document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Enter numeric value!</span>";
		document.personalloan_form.Phone.focus();
		return false;  
	}
	if (document.personalloan_form.Phone.value.length < 10 )
	{
	  	document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Enter 10 Digits!</span>";	
		document.personalloan_form.Phone.focus();
		return false;
	}
	if ((document.personalloan_form.Phone.value.charAt(0)!="9") && (document.personalloan_form.Phone.value.charAt(0)!="8") && (document.personalloan_form.Phone.value.charAt(0)!="7"))
	{
	  	document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>should start with 9 or 8 or 7!</span>";	
		document.personalloan_form.Phone.focus();
		return false;
	}
	
	if(document.personalloan_form.Email.value=="")
	{
		document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter  Email Address!</span>";	
		document.personalloan_form.Email.focus();
		return false;
	}
	
	var str=document.personalloan_form.Email.value
	var aa=str.indexOf("@")
	var bb=str.indexOf(".")
	var cc=str.charAt(aa)

	if(aa==-1)
	{
		document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter Valid Email Address!</span>";	
		document.personalloan_form.Email.focus();
		return false;
	}
	else if(bb==-1)
	{
		document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter Valid Email Address!</span>";	
		document.personalloan_form.Email.focus();
		return false;
	}
		
	if(document.personalloan_form.day.value=="" || document.personalloan_form.day.value=="dd")
	{
		document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Fill Day of Birth!</span>";
		document.personalloan_form.day.focus();
		return false;
	}
	if(document.personalloan_form.day.value!="")
	{
		if((document.personalloan_form.day.value<1) || (document.personalloan_form.day.value>31))
		{
			document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Date of Birth(Range 1-31)!</span>";
			document.personalloan_form.day.focus();
			return false;
		}
	}
	if(!checkData(document.personalloan_form.day, 'Day', 2))
		return false;
	
	if(document.personalloan_form.month.value=="" || document.personalloan_form.month.value=="mm")
	{
		document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Fill month of Birth!</span>";
		document.personalloan_form.month.focus();
		return false;
	}
	if(document.personalloan_form.month.value!="")
	{
		if((document.personalloan_form.month.value<1) || (document.personalloan_form.month.value>12))
		{
			document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Month of Birth(Range 1-12)!</span>";
			document.personalloan_form.month.focus();
			return false;
		}
	}
	if(!checkData(document.personalloan_form.month, 'month', 2))
		return false;

	if(document.personalloan_form.year.value=="" || document.personalloan_form.year.value=="yyyy")
	{
		document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Fill Year of Birth!</span>";
		document.personalloan_form.year.focus();
		return false;
	}
	if(document.personalloan_form.year.value!="")
	{
		if((document.personalloan_form.year.value < "<?php echo $maxage;?>") || (document.personalloan_form.year.value >"<?php echo $minage;?>"))
		{
			document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Age between 18 -62!</span>";
			document.personalloan_form.year.focus();
			return false;
		}
	}
	if(!checkData(document.personalloan_form.year, 'Year', 4))
		return false;
		
	
	if (document.personalloan_form.Pincode.value=="")
	{
		document.getElementById('pincodeVal').innerHTML = "<span  class='hintanchor'>Enter Pincode!</span>";	
		document.personalloan_form.Pincode.focus();
		return false;
	}
	if (document.personalloan_form.Pincode.value!="")
	{
		if(document.personalloan_form.Pincode.value.length < 6)
		{
			document.getElementById('pincodeVal').innerHTML = "<span  class='hintanchor'>Enter Pincode(6 Digits)!</span>";	
			document.personalloan_form.Pincode.focus();
			return false;
		}
	}

	var myOption = -1;
		for (i=document.personalloan_form.CC_Holder.length-1; i > -1; i--) {
			if(document.personalloan_form.CC_Holder[i].checked) {
				if(i==0)
				{
					if (document.personalloan_form.Card_Vintage.selectedIndex==0)
					{
						document.getElementById('vintageVal').innerHTML = "<span  class='hintanchor'>Holding Credit Card Since!</span>";	
						document.personalloan_form.Card_Vintage.focus();
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

	if(!document.personalloan_form.accept.checked)
	{
		document.getElementById('acceptVal').innerHTML = "<span  class='hintanchor'>Read and Accept Terms & Conditions!</span>";	

		document.personalloan_form.accept.focus();
		return false;
	}	
}  

function addIdentified()
{
		var ni1 = document.getElementById('myDiv1');
	    ni1.innerHTML = '<div style=" float:left;  margin-top:5px;"><div class="text" style=" float:left; height:auto; color:#FFF; font-size:12px; text-transform:none;">Card held since?</div>    <div class="text" style=" float:left; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;"><select size="1" name="Card_Vintage" class="pl_select_b" style=" font-family:Verdana, Geneva, sans-serif; font-size:11px; color:#4c4c4c;" onchange="validateDiv(\'vintageVal\');" ><option value="0">Please select</option> <option value="1">Less than 6 months</option> <option value="2">6 to 9 months</option> <option value="3">9 to 12 months</option><option value="4">more than 12 months</option> </select></div><div id="vintageVal"></div></div>';
					
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

function addibibo()
{
	var ni1 = document.getElementById('getibibo');
	var cit = document.personalloan_form.City.value;
	//alert(cit);	
	ni1.innerHTML = '';
	if(cit!="Please Select")
	{
		//alert("ranjana");
		ni1.innerHTML = ' <table  style="border:1px solid #999999; padding:2px;"> <tr> <td class="frmbldtxt" style="font-family:verdana; font-size:10px; color:#ffffff; font-weight:normal; "> <u>Special offer for Deal4loans customers</u></td>		 </tr>	  <tr>	 <td class="frmbldtxt" style="font-family:verdana; font-size:10px; color:#ffffff; font-weight:normal;"> Take  a Free Test  Drive for New Maruti  and <b>Win a Branded Laptop</b></td> </tr>	 <tr> <td style="font-family:verdana; font-size:10px; color:#ffffff; font-weight:normal; "> <input type="radio" name="Ibibo_compaign" id="Ibibo_compaign" style="border:none;" value="Estillo"/> Estillo <input type="radio" style="border:none;" value="WagonR" name="Ibibo_compaign" id="Ibibo_compaign"/> WagonR <input type="radio" name="Ibibo_compaign" id="Ibibo_compaign" value="A-Star" style="border:none;"/> A-Star</td>	 </tr>	</table>	';	
	}
	else
	{
		ni1.innerHTML = '';
	}
	return true;
}

function addhdfclife()
{
	var ni1 = document.getElementById('hdfclife');
	var cit = document.personalloan_form.City.value;
	var txtview = '<table  style="border:1px solid #000000; padding:2px; width:606px;"><tr><td colspan="2" class="frmbldtxt" style="font-family:verdana; font-size:10px; color:#ffffff; font-weight:normal; " height="20"><span style="color:#ff0000;">(Optional) </span>Special service only for Deal4loans customers:</td></tr> <tr><td width="23"><input type="checkbox"  name="hdfclife" id="hdfclife" value="1"/></td> <td width="611" class="frmbldtxt" style="font-family:verdana; font-size:10px; color:#ffffff; font-weight:normal; "> I would like to avail of <b>FREE </b>financial planning services by <b>Insurance & Investment experts</b> from HDFC Life.</td>		 </tr>	 </table>';	
	hdfclifecamp(ni1,cit,txtview);
}


function change_empstst()
{
//alert("sdfds");
	var occpdiv1 = document.getElementById('chnge_empststName');
	var occpdiv2 = document.getElementById('chnge_empststVal');
	var occupation = document.personalloan_form.Employment_Status.value;
	
	if(occupation==0)
	{
	occpdiv1.innerHTML = '<span class="text" style=" float:left; height:auto; color:#FFF; font-size:12px; text-transform:none;">Annual Turnover: </span>';
	occpdiv2.innerHTML = ' <select name="Annual_Turnover" id="Annual_Turnover" class="pl_select_b">		<option value="">Please Select</option>	<option value="1" > 0 To 40 Lacs</option>	<option value="4" > 40 Lacs To 1 Cr</option>		<option value="2" > 1Cr - 3Crs </option>	<option value="3" >3Crs & above</option></select>                        <div id="annualTurnoverVal"></div>            ';
	}
	else
	{
	occpdiv1.innerHTML = '<span class="text" style=" float:left; height:auto; color:#FFF; font-size:12px; text-transform:none;">Company Name: </span>';
	
	occpdiv2.innerHTML = '<input name="Company_Name" id="Company_Name" type="text" class="pl_input_b" onblur="onBlurDefault(this,\'Type slowly to autofill\');" onkeyup="ajax_showOptions(this,\'getCountriesByLetters\',event, \'http://www.deal4loans.com/ajax-list-plcompanies.php\')" onfocus="onFocusBlank(this,\'Type slowly to autofill\');" onkeydown="validateDiv(\'companyNameVal\');" value="Type slowly to autofill" tabindex=11/>                        <div id="companyNameVal"></div>';
			}

}

function othercity1()
{
//alert(document.personalloan_form.City.value);
	//var citydiv1 = document.getElementById('otherCityName');
	var citydiv2 = document.getElementById('otherCityName');
	if(document.personalloan_form.City.value=='Others')	
	{
//	alert(document.personalloan_form.City.value);
		citydiv2.innerHTML = '<table width="100%" border="0" cellpadding="0" cellspacing="0"><tr><td height="25"><span class="text" style=" float:left;  height:auto; color:#FFF; font-size:12px; text-transform:none;">Other City:</span></td></tr><tr><td height="25"><input name="City_Other" id="City_Other" type="text" class="pl_input_b" onKeyUp="searchSuggest();" onkeydown="validateDiv(\'othercityVal\');"  /><div id="othercityVal"></div></td></tr></table>';	
	}

	else
	{
		citydiv2.innerHTML = '';
	}
}

function addPersonalDetails()
{
	var ni1 = document.getElementById('personalDetails');
	var ni2 = document.getElementById('addPadding');
	var ni3 = document.getElementById('addSubmit');
	var ni5 = document.getElementById('getImageScroll');
	
	ni1.innerHTML = '<div class="pl_input_box" style="width:100%; padding-top:7px;"><table width="98%" border="0" cellpadding="0" cellspacing="0"><tr><td width="21%"  align="left" style="font-size:19px; color:#fff; padding-top:5px;"> Personal Details</td><td style="font-size:11px; font-weight:normal; color:#96b34b; font-weight:bold; font-family: \'Droid Sans\', sans-serif;"><img src="images/security.png" width="14" height="16"> Your Information is secure with us and will not be shared without your consent</td></tr></table></div><div class="pl_input_box">  <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td height="25"><span class="text" style=" float:left; width:137px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Full Name:</span></td>    </tr>    <tr>      <td height="25">   <input name="Name" id="Name" type="text"  class="pl_input_b" onkeydown="validateDiv(\'nameVal\');" />   <div id="nameVal"></div>  </td>    </tr>    </table></div><div class="pl_input_box">  <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">    <tr>      <td height="25"><span class="text" style=" float:left; width:137px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Email ID :</span></td>    </tr>    <tr>      <td height="25">  <input name="Email" id="Email" type="text" class="pl_input_b" onkeydown="validateDiv(\'emailVal\');"  />          <div id="emailVal"></div>   </td>    </tr>      </table></div><div class="pl_input_box">  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">    <tr>      <td height="25"><span class="text" style=" float:left; width:137px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Mobile:</span></td>    </tr>        <tr>      <td height="25"><span style=" color:#FFF; font-size:12px; "><em>+91</em></span>        <input name="Phone" id="Phone" maxlength="10" onkeyup="intOnly(this);" onkeypress="intOnly(this)"; onchange="intOnly(this);" type="text" class="pl_mobo_b" onkeydown="validateDiv(\'phoneVal\');"  />            <div id="phoneVal"></div>   </td>    </tr>  </table></div><div class="pl_input_box">  <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td height="25"><span class="text" style=" float:left;  height:auto; color:#FFF; font-size:12px; text-transform:none;">DOB:</span></td></tr><tr><td height="25"><input name="day" id="day" type="text" class="hl_emi_dd" value="dd" onBlur="onBlurDefault(this,\'dd\');" onFocus="onFocusBlank(this,\'dd\');" maxlength="2" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" onKeyDown="validateDiv(\'dobVal\');" />        <input name="month" id="month" type="text" class="hl_emi_dd" value="mm" onBlur="onBlurDefault(this,\'mm\');" onFocus="onFocusBlank(this,\'mm\');" maxlength="2" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" onKeyDown="validateDiv(\'dobVal\');" />  <input name="year" id="year" type="text" class="hl_emi_yy" value="yyyy" onBlur="onBlurDefault(this,\'yyyy\');" onFocus="onFocusBlank(this,\'yyyy\');" maxlength="4" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" onKeyDown="validateDiv(\'dobVal\');" />        <div id="dobVal"></div></td>    </tr>    </table></div><div style="clear:both;"></div><div class="pl_input_box">  <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td height="25"><span class="text" style=" float:left; width:137px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Pincode:</span></td>    </tr>    <tr>      <td height="25">  <input name="Pincode" id="Pincode" maxlength="6" onkeypress="intOnly(this);" onkeyup="intOnly(this);"  onkeydown="validateDiv(\'pincodeVal\');" type="text" class="pl_input_b" tabindex="5" />  <div id="pincodeVal"></div></td>    </tr>    </table></div><div class="pl_input_box">  <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td height="25"><span class="text" style=" float:left;  height:auto; color:#FFF; font-size:12px; text-transform:none;">Credit Card:</span></td></tr><tr><td height="25"  style="font-size:12px; color:#FFF;"> <input type="radio" name="CC_Holder" id="CC_Holder" value="1" onclick="return addIdentified();" style="border:none;" /> Yes <input size="10" type="radio" style="border:none;" name="CC_Holder"  onclick="removeIdentified();" value="0" checked > No</td>    </tr>    </table></div><div class="pl_input_box" id="myDiv1"></div>';
	ni3.innerHTML = '<div class="pl_terms_box"><span class="text" style="color:#FFF; font-size:11px; text-transform:none;">  <input name="accept" type="checkbox" checked="checked" /> I authorize Deal4loans.com & its <a href="http://www.deal4loans.com/pl-partnering-banks.php" target="_blank" rel="nofollow"  class="text" style=" color:#88a943; font-size:11px; text-decoration:underline;">partnering banks</a> to contact me to explain the product & I Agree to <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow"  class="text" style=" color:#88a943; font-size:11px; text-decoration:underline;">Privacy policy</a> and <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow"  class="text" style=" color:#88a943; font-size:11px; text-decoration:underline;">Terms and Conditions</a>.                 <div id="acceptVal"></div></span></div>                  <div class="pl_bnt_b"> <input type="submit" style="border: 0px none ; background-image: url(images/get1.gif); width: 114px; height: 52px; margin-bottom: 0px;" value=""/></div>                  <div style="clear:both;"></div>                  <div id="hdfclife"></div>                  <div style="clear:both;"></div>';
	ni5.innerHTML = '<img src="images/animated_pl.gif" width="575" height="21" />';
}
  </script>
  
<link href="source.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style1 {color: #4c4c4c}
.style3 {font-family: 'Droid Serif', serif}
.style4 {font-size: 16}
.style5 {font-size: 16px}
.style7 {font-family: 'Droid Serif', serif; font-size: 16; }
.style9 {font-weight: bold}
-->
</style>
<link href="source1.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="menu-style.css">
</head>
<body onload="MM_preloadImages('images/emi2.gif','images/apply2.gif','images/get2.gif')">

<div class="hide_top_menu"><!--top-->
<?php include "top-menu.php"; ?><!--top--></div>

<!--logo navigation-->
<?php include "main-menu2.php"; ?>
<script type="text/javascript" src="script1.js"></script>
<!--logo navigation-->
<div style="clear:both;"></div>
<div  class="pl_sbi_wrapper">

<div style="clear:both;"></div>
<div class="pl_left_box">
<div class="text12" style="margin:auto; width:100%; height:11px; margin-top:11px; color:#0a8bd9;">
<u><a href="index.php" class="text12" style="color:#0080d6;" >Home</a></u> > <span  class="text12" style="color:#4c4c4c;">Personal Loan</span>
</div>
  <div class="pl_titile_wraper"><h1 class="text3" id="title_pl">Personal Loan</h1><div class="pl_emi_btn_box"><a href="Contents_Calculators.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image3','','images/emi2.gif',1)"><img src="images/emi1.gif" name="Image3" width="95" height="20" border="0" id="Image3" /></a></div>
</div>
<div><span style="width:100%; height:auto; margin-top:2px; padding-top:2px; text-align:justify;">
    <h3 class="text" style="color:#4c4c4c; size:18px; ">What is a Personal loan?<br />
      <span class="text11" style="color:#4c4c4c; ">Personal Loan is an unsecured loan for personal use which doesn’t require any security or collateral and can be availed for any purpose, be it a wedding expenditure, a holiday or purchasing consumer durables, the loans is very handy &amp; caters to all your needs. The amount of loans can be ranged from Rs. 50,000 – Rs. 20 lakh &amp; the tenure for repaying the loan varies from 1 to 5 years.<br />
    <br />
    <strong>Personal Loan applications received for <img src="images/rupees.gif" />
    <? 
$result1 = ExecQuery("SELECT sum( `Amount` ) AS ttlcnt FROM `totalLoans` WHERE ( Name ='PL' )");
$row1 = mysql_fetch_array($result1);
$fVal = substr(trim($row1['ttlcnt']), 0, strlen(trim($row1['ttlcnt']))-7);
echo $plVal = number_format($fVal)." crores"; ?>
till <? echo date('d F Y');?> </strong></span></h3>
  </span></div>
<div style="clear:both;"></div>
<div class="pl_form_box">
  <form name="personalloan_form"  action="insert_personal_loan_value_step1.php" method="POST" onSubmit="return chkpersonalloan(document.personalloan_form);">
  <input type="hidden" name="Type_Loan" value="Req_Loan_Personal" />
                <input type="hidden" name="source" value="PL main page" />
                <input type="hidden" name="PostURL" value="personal-loans2.php" />
<div class="pl_form_title"><strong class="text3" style=" color:#FFF; font-size:15px; text-transform:none; ">Compare Personal Loan Rates - Eligibility - Process of All Banks.</strong></div>
<div class="pl_blink_text" id="getImageScroll"><img src="images/animated_pl_before.gif" width="575" height="21" /></div>
<div style="clear:both;"></div>
<div style="padding-left:20px; font-size:19px; color:#fff;">
Professional Details
</div>
<div style="clear:both;"></div>
<div class="pl_input_box">
  <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
   <tr>
      <td height="25"><span class="text" style=" float:left; height:auto; color:#FFF; font-size:12px; text-transform:none;">Loan Amount:</span></td>
    </tr>
    <tr>
      <td height="25"><input name="Loan_Amount" id="Loan_Amount" maxlength="8" onkeypress="intOnly(this);" onkeyup="intOnly(this); getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');"  onblur="getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');"  type="text" class="pl_input_b"  onkeydown="validateDiv('loanAmtVal');" />
     <div id="loanAmtVal"></div><span id='formatedlA' style='font-size:11px;
font-weight:normal; color:#ffffff;font-Family:Verdana;'></span><span id='wordloanAmount' style='font-size:11px;
font-weight:normal; color:#ffffff;font-Family:Verdana;text-transform: capitalize;'></span></td>
    </tr>
  </table>
</div>
<div class="pl_input_box">
  <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td height="25"><span class="text" style=" float:left; height:auto; color:#FFF; font-size:12px; text-transform:none;">Occupation :</span></td>
    </tr>
    <tr>
      <td height="25"> <select  name="Employment_Status" class="pl_select_b" style=" font-family:Verdana, Geneva, sans-serif; font-size:11px; color:#4c4c4c;" id="Employment_Status" onChange="change_empstst(); validateDiv('empStatusVal');" tabindex="2">
              <option selected="selected" value="-1">Employment Status</option>
              <option  value="1">Salaried</option>
              <option value="0">Self Employed</option>
            </select><div id="empStatusVal" class="alert_msg"></div>  </td>
    </tr>
  </table>
</div>
<div class="pl_input_box">
  <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td height="25"><span class="text" style=" float:left; height:auto; color:#FFF; font-size:12px; text-transform:none;">Annual Income: </span></td>
    </tr>
    <tr>
      <td height="25"><input type="text" name="IncomeAmount" id="IncomeAmount" class="pl_input_b"  onkeyup="intOnly(this); getDiToWordsIncome('IncomeAmount','formatedIncome','wordIncome');" onkeypress="intOnly(this);"  onblur="getDiToWordsIncome('IncomeAmount','formatedIncome','wordIncome');"  onchange="ShowHide('incomeShow','IncomeAmount');" onkeydown="validateDiv('netSalaryVal');"  />
              <div id="dialog-modal" > </div>
        <div id="netSalaryVal"></div>  <span id='formatedIncome' style='font-size:11px;font-weight:normal; color:#ffffff;font-Family:Verdana;'></span> <span id='wordIncome' style='font-size:11px;font-weight:normal; color:#ffffff;font-Family:Verdana;text-transform: capitalize;'></span>  </td>
    </tr>
  </table>
</div>
<div class="pl_input_box">
  <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
      <td height="25"><span class="text" style=" float:left; height:auto; color:#FFF; font-size:12px; text-transform:none;">City:</span></td>
    </tr>
    <tr>
      <td height="25"><select name="City" id="City" class="pl_select_b" style=" font-family:Verdana, Geneva, sans-serif; font-size:11px; color:#4c4c4c;" onchange=" addPersonalDetails(); othercity1(); addhdfclife(); validateDiv('cityVal');" tabindex="7">
                            <?=plgetCityList($City)?>
                        </select>
                         <div id="cityVal"></div></td>
    </tr>
</table>
</div>
<div style="clear:both;"></div>
<div class="pl_input_box">
  <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
      <td id="chnge_empststName"></td>
    </tr>
    <tr>
      <td  id="chnge_empststVal"></td>
    </tr>
</table>
</div>
<div class="pl_input_box">
  <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td align="right"></td>
    </tr>
</table>
</div>
<div class="pl_input_box">
  <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">

    <tr>
      <td align="right"></td>
    </tr>
</table>
</div>
<div class="pl_input_box" style="float:right; padding-right:-7px;" >  <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">         <tr>      <td height="25" align="right" id="otherCityName"><img src="images/get1.gif" border="0" width="114" height="45" /></td>    </tr>   </table></div>
<div style="clear:both;"></div>
<div id="personalDetails"></div>
  <div id="addSubmit"></div>
                </form>
</div>
<div style="clear:both;"> </div>

 <div class="pl_compare_a"><img src="images/compare-offers1.jpg" width="234" height="72" /></div>
 <div class="pl_compare_b"><img src="images/compare-offers2.jpg" /></div>
 <div class="pl_compare_c">
   <table width="100%" border="0" align="right" cellpadding="0" cellspacing="0" style="border:#ff5816 solid thin; ">
     <tr>
       <td height="40" bgcolor="#edf8fc"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
         <tr>
           <td width="81" align="center" style="font-family:Verdana, Geneva, sans-serif; color:#ff5816; font-size:11px; font-weight:normal;">Special Offers</td>
           <td width="159" align="center" style="font-family:Verdana, Geneva, sans-serif; color:#ff5816; font-size:11px; font-weight:bold;">Get gifts upto Rs. 12,500 on disbursal.</td>
         </tr>
       </table></td>
     </tr>
     <tr>
       <td height="26" align="center" bgcolor="#ff5816" style="font-family:Verdana, Geneva, sans-serif; font-size:9px; color:#FFF;"><strong>Refer to T &amp; C -<br />
       </strong>www.deal4loans.com/personal-loan-offers.php</td>
     </tr>
   </table>
 </div>
<div class="pl_text_wrapper">
<div style=" width:100%; height:auto; margin-top:5px; text-align:justify;"><br /><span class="style9">
<a href="http://www.deal4loans.com/loans/personal-loan/personal-loan-charges-india/" class="text12" style="color:#0080d6;"><strong>Charges</strong></a> | <a href="http://www.deal4loans.com/loans/personal-loan/important-pointers-in-personal-loan-india-deal4loans/" class="text12" style="color:#0080d6;"><strong>Pointers</strong></a> | <a href="http://www.deal4loans.com/loans/personal-loan/latest-personal-loan-trends/" class="text12" style="color:#0080d6;"><strong>Latest Trends</strong></a></span><br />

<span class="style3" style="color:#4c4c4c; size:18px;; font-weight: normal; font-variant: normal; color: #005399; text-decoration: none; font-style: italic; @import url(http://fonts.googleapis.com/css?family=Droid+Serif);"><h3 class="style4" style="font-weight:normal;">Most borrowed Personal loans</h3>
</span>
<p class="text11 style1"><a href="http://www.deal4loans.com/hdfc-personal-loan-eligibility.php"><strong>HDFC Bank Personal loan</strong></a>:<br />
  Interest  Rates: 12.99% to 20% | Prepayment charges: 4% | Processing Fees: 0.8% -  1.75% (for special companies), 2% (HDFC AC holder), 2.5% for others | Loan  disbursement time: 1-7 days  | Total loan  disbursed per month-1100 Crs<br /><br />
  <a href="http://www.deal4loans.com/personal-loan-icici-bank.php"><strong>ICICI Personal Loan</strong></a>: <br />
  Interest  Rates: 13.50% to 18.50% | Prepayment charges: 5% | Processing Fees: 0.8% for special companies else 2%   | Loan disbursement time: 3-4 Days  | Total Loan disbursed Per Month- 200crs<br />
  <strong><br />
  <a href="http://www.deal4loans.com/loans/personal-loan/bajaj-finserv-lending-personal-loan-eligibility-documents-interest-rates-apply/">Bajaj Finance Personal Loan</a></strong>: <br />
  Interest Rates: 15.00% to 17.00% | Prepayment charges: 0% | Processing Fees: 2% to 2.50% | Loan disbursement time: 1-7 Days | Total loan disbursed per month- 69 Crs<br /><br />
  <a href="http://www.deal4loans.com/personal-loan-axis-bank.php"><strong>Axis Bank personal loan</strong></a>: <br />
  Interest  Rates: 15.00% to 20.00% | Prepayment charges: 0% | Processing Fees: 2% | Loan  disbursement time:2-7 days | Total Loan disbursed per month-300 crs<br />
  <strong><br />
  <a href="http://www.deal4loans.com/kotak-personal-loan-eligibility.php">Kotak Personal loan</a></strong>: <br />
  Interest  Rates: 13.75% to 19.00% | Prepayment charges: 5% | Processing Fees: 2%  | Loan  disbursement time: 3-4 Days | Total Loan Disbursed per month – 35 Crs<br />
  <br />
   <a href="http://www.deal4loans.com/personal-loan-ingvysya-bank.php"><strong>Ing Vysya Personal Loan</strong></a>: <br />
  Interest Rates: 13.75% to 17.25% | Prepayment charges:Nil (till <strong>28th Feb'14</strong>)| Processing Fees: Upto 2%   | Loan disbursement time: 1-4 days  | Total loan disbursed per month- 40 Crs<br /><br />
    <a href="http://www.deal4loans.com/personal-loan-sbi.php"><strong>SBI Personal Loan</strong></a>: <br />
  Interest  Rates: 18.25% | Prepayment charges: N.A% | Processing Fees: N.A% | Loan  disbursement time:2-8 days<br /><br />
  <a href="http://www.deal4loans.com/fullerton-personal-loan-eligibility.php"><strong>Fullerton India</strong></a>: <br />
  Interest Rates: 21.00% - 32% | Prepayment charges: 4% | Processing Fees: 2% | Loan Disbursement time: 2-8 days | Total Loan Disbursed Per Month – 170 Crs<br /><br />
  <a href="http://www.deal4loans.com/personal-loan-stanc-bank.php"><strong>Standard Chartered</strong></a>: <br />
<span class="text11 style1">Interest Rates: 16% - 22% | Prepayment charges: 2% - 5% | Processing  Fees: 2% | Loan Disbursement time: 2-8 days</span><br />
</p>
<span class="style3" style="color:#4c4c4c; size:18px;; font-weight: normal; font-variant: normal; color: #005399; text-decoration: none; font-style: italic; @import url(http://fonts.googleapis.com/css?family=Droid+Serif);">

<h4 class="style4" style="font-weight:normal;">Tips for Best Personal loan deal</h4>
</span>
  <span class="text11" style="color:#4c4c4c; ">1) Compare exact Emi | Processing fee | Tenure | Documents before choosing bank<br>
2) Never pay any fee to any person to get loan sanctioned.Processing fee are deducted from Loan amount.<br>
3) Only give documents to one bank and check whether he is authorized Bank employee or vendor.<br />
</span>
<div class="text" style=" width:100%; height:auto; margin-top:5px; text-align:justify;">
  <h4 class="style5" style="font-weight:normal;">Basis to Compare Personal Loans</h4>
</div>
  <p class="text11" style="color:#4c4c4c; ">
    •&nbsp;<strong>Compare  Interest Rates:</strong>&nbsp;Unsecured Loan can be compared primarily on the basis  of interest rates which vary across banks depending on your profile which is  further linked to your occupation, salary/income, credit history etc and the  company that you work with. The <a href="http://www.deal4loans.com/personal-loan-interest-rate.php">personal loan interest rates</a> ranges from 13% to 40%, you must go for that loan which  is offering you at the minimum rate. These rates are lowest if you are working  in top 5000 companies in India and you have income  above 75000 and you have a good cibil track.<br />
  <br />
    •&nbsp;<strong>Other  Charges:</strong>&nbsp;You should also check on the other charges like processing  fee, pre-payment penalties and documentation fee because they increase the  overall loan cost and vary widely across banks.&nbsp;Processing fee range is  between 0.5% to 2.5% and prepayment charges are in range of 0-5%.<br />
  <br />
    •&nbsp;<strong>Evaluation  of various Loan offers:</strong>&nbsp;You should first calculate the entire loan  cost across banks which constitute the rate of interest &amp; other charges.  Evaluate offers keeping the tenure of the loan constant &amp; compare the rate  of interest, EMIs &amp; other charges. This process will help you get the Best  Loan deal.<br />
  <br />
    •&nbsp;<strong>EMIs:</strong>&nbsp;EMI  is the monthly equated installment which constitutes the principal amount and  the interest on the principal equally divided across each month in the loan  tenure. Use our&nbsp;<strong><a href="http://www.deal4loans.com/Contents_Calculators.php" title="EMI Calculator">EMI  Calculator</a></strong>&nbsp;to compare EMIs across banks<br />
  <br />
    •&nbsp;<strong>Tenure:</strong>&nbsp;Tenure  is the time frame for the loan payments to be paid back to the bank; it ranges  from 1 year to 5 years. If you have a longer tenure you will end up paying more  interest &amp; will have lower EMI, on the other hand shorter loan tenure will  carry higher EMIs &amp; the interest amount is less. You must compare the loan  offers by keeping the tenure constant.&nbsp;<br />
  <br />
    •&nbsp;<strong>Eligibility  Check:</strong>&nbsp;Before taking a loan you must know the eligibility criteria’s  offered by various banks on the basis of which they offer loans and also  compare&nbsp;<a href="http://www.deal4loans.com/personal-loan-banks.php" title="personal loan banks">personal loan banks</a>. Checking the eligibility  parameters will help you find the best loan deal.&nbsp;<a href="http://deal4loans.com/Contents_Personal_Loan_Eligibility.php">Check out  your eligibility by various banks</a>.<br />
  <br />
    •&nbsp;<strong>Turnaround  time:</strong>&nbsp;It becomes one of the most important factors in evaluation of  your loan application when you are in a dire need of money. Turnaround time is  the time which banks take in processing your loan application; you must check  this parameter which varies from bank to bank. </p>
  <p  class="text11" style="color:#4c4c4c; "><strong><u>How  does 0 % Prepayment help</u></strong></p>
  <p class="text11" style="color:#4c4c4c; ">If you have  taken a personal loan and you expect some money to come in between the tenure  of personal loan which you can return. By returning the loan amount before the  tenure will save you a lot. Eg. If you take up a  Personal Loan of 1 Lac for a tenure of 4 years @ 15% ROI with 0% prepayment.  You will be able to save approx Rs. 3,925 per Lac if you foreclose you loan  after one year; Rs. 2766 per Lac if you foreclose your loan after two years;  Rs. 1421 per Lac if you foreclose your loan after three years of repayment. </p>
</div>
<div style=" float:left; width:100%; height:auto; text-align:justify;"><span class="style3" style="color:#4c4c4c; size:18px;; font-weight: normal; font-variant: normal; color: #005399; text-decoration: none; font-style: italic; @import url(http://fonts.googleapis.com/css?family=Droid+Serif);">
  <p class="style4" style="font-weight:normal;">Benefits of Personal loan</p>
</span>
  <span class="text11" style="color:#4c4c4c; "><strong>1. A Loan without security: </strong>A Personal Loan is not a secured loan (bank doesn’t  ask for any security or collateral) as against a Secured Loan where one is  required to pledge a house or other security to acquire a loan.<br />
  <br />
  <strong>2. Simple Documentation: </strong>A Personal Loan can be accessed with minimal  paperwork or documentation &amp; doesn’t take much time to procure as against a  Secured Loan.<br />
  <br />
  <strong>3. No specification about the end use of the loan amount: </strong>You are not  required to disclose the end use of the money borrowed, Banks are concerned  about the fact that whether the borrower is able to pay back the loan with  interest before the due date or not and they confirm this by checking the  income, employment or business &amp; other factors of the borrower.<br />
  <br />
  <strong>4. Big Loan Amount : </strong>Personal Loan is a means to fulfill bigger loan  requirement, you can take a loan ranging from Rs. 50,000 to Rs. 30 lakhs.
 </span></div>
 
<div style=" float:left; width:100%; height:auto; text-align:justify;"><span class="style3" style="color:#4c4c4c; size:18px;; font-weight: normal; font-variant: normal; color: #005399; text-decoration: none; font-style: italic; @import url(http://fonts.googleapis.com/css?family=Droid+Serif);"><h3 class="style4" style="font-weight:normal;">Documents required in Personal Loan</h3>
</span>
  <span class="text11" style="color:#4c4c4c; "> The documentation process is very fast as against <strong><a href="http://www.deal4loans.com/home-loans.php" title="home loan">home  loan</a></strong>. Following documents are required by financial institutions to  process the loan application:<br />
<div style="margin-left:15px; padding-top:3px;" >
<table width="100%" ><tr><td width="295" valign="top">
<span class="text11" style="color:#4c4c4c; "><strong>In case of Salaried</strong><br />
</span><li><span class="text11" style="color:#4c4c4c; ">Identity proof</span></li>
<li><span class="text11" style="color:#4c4c4c; ">3 to 6 months Bank statements</span></li>
<li><span class="text11" style="color:#4c4c4c; "> Residence proof</span></li>
<li><span class="text11" style="color:#4c4c4c; "> Salary slip</span></li>
<li><span class="text11" style="color:#4c4c4c; "> Guarantors &amp; their same set of documents</span></li>
</td><td width="329" valign="top" >
<span class="text11" style="color:#4c4c4c; ">
<strong>In case of Self Employed</strong><br />
</span><li><span class="text11" style="color:#4c4c4c; ">Balance Sheets</span></li>
<li><span class="text11" style="color:#4c4c4c; ">Profit &amp; Loss Account</span></li>
<li><span class="text11" style="color:#4c4c4c; ">Partnership Deed &amp; other mandatory documents etc.</span></li>
</td></tr></table>
</div>
</span><div style=" float:left; width:100%; height:auto;text-align:justify;">
<h3 style="font-weight:normal;"><span class="style7" style="color:#4c4c4c; size:16px;; font-weight: normal; font-variant: normal; color: #005399; text-decoration: none; font-style: italic; @import url(http://fonts.googleapis.com/css?family=Droid+Serif);">Personal Loan Criteria by various banks </span></h3>
<span class="text11" style="color:#4c4c4c; "> Banks offer Loan to borrowers depending on various factors such as income,  employment, continuity of business so as to make sure that they repay the loan  with interest before the due date. The eligibility criterion of a personal loans  is primarily based on the work profile of a loan seeker which is broadly  divided into the following two classes: <br />
- Self-employed<br />
- Salaried<br />
In addition to the above factors banks also consider other aspects such as age,  work experience, existing relationship with the bank, repayment capacity etc.<br />
To find your eligibility Criteria across various banks in accordance with the  above parameters; Deal4Loans has brought in the <a href="http://deal4loans.com/Contents_Personal_Loan_Eligibility.php">Eligibility  Criteria</a> Check for Loan seekers. 
</span></div>
<div style=" float:left; width:100%; height:auto; text-align:justify;">
  <p style="font-weight:normal;"><span class="style7" style="color:#4c4c4c; size:18px;; font-weight: normal; font-variant: normal; color: #005399; text-decoration: none; font-style: italic; @import url(http://fonts.googleapis.com/css?family=Droid+Serif);">How does the Cibil Score affect your loan application?</span></p>
  <span class="text11" style="color:#4c4c4c; "> 
This a norm wherein the banks before giving Personal Loan checks the database  of all loan borrowers in the country by the Credit Information Bureau of India  (<strong><a href="http://www.deal4loans.com/loans/bank-info/know-your-cibil-scoreget-your-cibil-score/" title="CIBIL">CIBIL</a></strong>) which is called the Cibil Score. If there has been a  default in your loan payment; your loan application would certainly be  rejected. Your Cibil score ranges from 100 to 999, for instance if your credit  score is 100 then your loan application might be out rightly rejected. On other  hand if it is higher say 800, then your loan application would be processed  faster &amp; will be rewarded with lower interest rates &amp; discounts in  processing fee &amp; other charges.<br />
You can improve your credit score by repaying your loan EMIs on time and always  pay the minimum payment on your <a href="http://www.deal4loans.com/credit-cards.php">credit card</a> to avert from  the bad credit score.
</span></div>
<div style=" float:left; width:100%; height:auto; margin-top:5px; text-align:justify;">
  <p style="font-weight:normal;"><span class="style7" style="color:#4c4c4c; size:18px;; font-weight: normal; font-variant: normal; color: #005399; text-decoration: none; font-style: italic; @import url(http://fonts.googleapis.com/css?family=Droid+Serif);">Reducing Interest Rate or Flat Interest Rate, which is better?</span></p>
  <span class="text11" style="color:#4c4c4c; "> The Interest Rates vary between 14% and 25% depending on your profile &amp;  payment ability. There are basically two types of interest Rates offered by  banks which are <br />
1. Reducing Balance Interest Rate<br />
2. Flat Interest Rate<br />
In the Reducing Interest Rate calculation method, the interest on your loan  keeps on reducing as it is calculated on the reduced principle amount which  gets reduced daily, monthly, quarterly or annually.<br />
Flat Interest Rate calculation method on other hand implies that your rate of  interest remains the same &amp; is calculated over the entire loan period. The  outstanding loan amount is never reduced over the loan tenure.<br />
<br />
It is always advised to take a loan at reducing balance interest rates as the  Flat rate calculation comes out to be really expensive.
</span></div>
</div>
</div>
<div style="clear:both;"></div>
</div>
<div class="pl_right_box_b"><?php include "RightPL.php"; ?></div>
<div style="clear:both;"></div>
<?php
include "responsive_footer.php";
?>
</div> 
<div class="hide_top_menu">
<?php include "footer_pl1707.php"; ?></div>
</body></html>