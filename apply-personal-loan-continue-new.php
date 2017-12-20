<?php
require 'scripts/session_check.php';
require 'scripts/db_init.php';
require 'scripts/functionshttps.php';

$maxage=date('Y')-62;
$minage=date('Y')-18;

if(strlen($_REQUEST['source'])>0)
{
	$retrivesource=$_REQUEST['source'];
}
else
{
	$retrivesource="PL Site Page";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href='//fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'>  
<title>Apply for Personal loans online - Deal4loans.com</title>
<meta name="keywords" content="Apply Personal Loans, personal loans apply, online personal loan apply, apply personal loan india">
<meta name="description" content="Apply online for personal loans from leading loan providers in India to solve personal finance problems. Get fast and easy personal loans approval with deal4loans.com in India.">
<link href="source.css" rel="stylesheet" type="text/css" />
 <script type="text/javascript" src="scripts/mainmenu.js"></script>
 <link href="css/slider.css" rel="stylesheet" type="text/css" />
 <script type="text/javascript" src="scripts/common.js"></script>
 <script type="text/javascript" src="ajax.js"></script>
<!--<script type="text/javascript" src="http://www.deal4loans.com/ajax-dynamic-pllist.js"></script>-->
<script type="text/javascript" src="ajax-dynamic-hhtpspllist.js"></script>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.9.1/themes/base/jquery-ui.css" />
    <script src="//code.jquery.com/jquery-1.8.2.js"></script>
       <script src="//code.jquery.com/ui/1.9.1/jquery-ui.js"></script>
   <script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
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

function othercity1()
{
	if(document.loan_form.City.value=='Others')
	{
		document.loan_form.City_Other.disabled=false;
	}
	else
	{
		document.loan_form.City_Other.disabled=true;
	}
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
		
	if (document.loan_form.City.selectedIndex==0)
	{
		document.getElementById('cityVal').innerHTML = "<span  class='hintanchor'>Enter City to Continue!</span>";	
		document.loan_form.City.focus();
		return false;
	}
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

	if (document.loan_form.Loan_Amount.value=="")
	{
		document.getElementById('loanAmtVal').innerHTML = "<span  class='hintanchor'>Enter Loan Amount!</span>";	
		document.loan_form.Loan_Amount.focus();
		return false;
	}	
	if(!checkNum(document.loan_form.Loan_Amount, 'Loan Amount',0))
		return false;

	var myOption = -1;
		for (i=document.loan_form.CC_Holder.length-1; i > -1; i--) {
			if(document.loan_form.CC_Holder[i].checked) {
				if(i==0)
				{
					if (document.loan_form.Card_Vintage.selectedIndex==0)
					{
						document.getElementById('vintageVal').innerHTML = "<span  class='hintanchor'>Holding Credit Card Since!</span>";	
						document.loan_form.Card_Vintage.focus();
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

	if(!document.loan_form.accept.checked)
	{
		document.getElementById('acceptVal').innerHTML = "<span  class='hintanchor'>Read and Accept Terms & Conditions!</span>";	

		document.loan_form.accept.focus();
		return false;
	}	
}  

function addIdentified()
{
		var ni1 = document.getElementById('myDiv1');
	    ni1.innerHTML = '<div style="height:47px;  margin-top:5px;"><div class="text" style=" float:left; height:auto; color:#FFF; font-size:12px; text-transform:none;">Card held since?</div>    <div class="text" style=" height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;"><select size="1" name="Card_Vintage" class="aplc_input_abc_new" onchange="validateDiv(\'vintageVal\');" ><option value="0">Please select</option> <option value="1">Less than 6 months</option> <option value="2">6 to 9 months</option> <option value="3">9 to 12 months</option><option value="4">more than 12 months</option> </select></div><div id="vintageVal"></div></div>';
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
  </script>
  <link href="source.css" rel="stylesheet" type="text/css" />
  <script type="text/javascript">
function addhdfclife()
{
	var ni1 = document.getElementById('hdfclife');
	var cit = document.loan_form.City.value;
var txtview = '<table  style="border:1px solid #000000; padding:2px; width:706px;"><tr><td colspan="2" class="frmbldtxt" style="font-family:verdana; font-size:10px; color:#ffffff; font-weight:normal; " height="20"><span style="color:#ff0000;">(Optional) </span>Special service only for Deal4loans customers:</td></tr> <tr><td width="23"><input type="checkbox"  name="hdfclife" id="hdfclife" value="1"/></td> <td width="611" class="frmbldtxt" style="font-family:verdana; font-size:10px; color:#ffffff; font-weight:normal; "> I would like to avail of <b>FREE </b>financial planning services by <b>Insurance & Investment experts</b> from HDFC Life.</td>		 </tr>	 </table>';	
	hdfclifecamp(ni1,cit,txtview);
}

function change_empstst()
{
	var occpdiv = document.getElementById('chnge_empstst');
	var occupation = document.loan_form.Employment_Status.value;
	if(occupation==0)
	{
	occpdiv.innerHTML = '<div style=" float:left; width:183px; height:45px; margin-left:0px; margin-top:5px;">                    <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;"><span class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Annual Turnover: </span></div>                  <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;">                  <select name="Annual_Turnover" id="Annual_Turnover" style="width:180px; height:22px; font-family:Verdana, Geneva, sans-serif; font-size:11px; color:#4c4c4c;">		<option value="">Please Select</option>	<option value="1" > 0 To 40 Lacs</option>	<option value="4" > 40 Lacs To 1 Cr</option>		<option value="2" > 1Cr - 3Crs </option>	<option value="3" >3Crs & above</option></select>                        <div id="annualTurnoverVal"></div>                    </div>                </div>';
	
	}
	else
	{
	occpdiv.innerHTML = '<div style=" float:left; width:183px; height:45px; margin-left:0px; margin-top:5px;">                    <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;"><span class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Company Name: </span></div>                  <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;">                   <input name="Company_Name" id="Company_Name" type="text"  style="width:180px; height:16px;" onblur="onBlurDefault(this,\'Type slowly to autofill\');" onkeyup="ajax_showOptions(this,\'getCountriesByLetters\',event, \'\')" onfocus="onFocusBlank(this,\'Type slowly to autofill\');" onkeydown="validateDiv(\'companyNameVal\');" value="Type slowly to autofill" tabindex=11/>                        <div id="companyNameVal"></div>                    </div>                </div>';
				}
				
}
</script>
<link href="apply-personal-loan-continue_styles_mobile.css" type="text/css" rel="stylesheet" />

</head>
<body>
<!--top-->
<div class="header-continue_aplc"><?php include "top-menu.php"; ?><!--top--></div>
<!--logo navigation-->
<div class="header-continue_aplc"><?php include "main-menu.php"; ?></div>
<!--logo navigation-->
<div class="aplc_logo_new_one"><img src="images/d4l-hlc-logo.png" width="198" height="73" /></div>
<div class="aplc_clearfix"></div>
<div class="text12 header_bx_aplc_header_text_one" style="margin:auto; height:11px; margin-top:11px; color:#0a8bd9;"><u><a href="index.php" class="text12" style="color:#0080d6;" >Home</a></u> > <a href="personal-loans.php"  class="text12" style="color:#0080d6;"><u>Personal Loan</u></a> <span class="text12" style="color:#4c4c4c;">> Apply for Personal Loan</span></div>


<div class="intrl_txt" style="margin:auto;">
<div class="right_ad_box_abc"><table align="center" border="0" width="100%"><tr><td align="center">    <?php include "special-offers_table.php"; ?></td></tr></table></div>
<div style="clear:both; height:1px;"></div>


<div class="form-wrapper-continue_aplc">
<form name="loan_form" method="post" action="insert_personal_loan_value_httpsstep.php" onSubmit="return chkpersonalloan();"><input type="hidden" name="creative" value="<? echo $_SERVER["HTTP_USER_AGENT"]; ?>">
<div class="head_text_form-wrapper-continue_aplc">Apply Personal Loan</div>
<div class="aplc_anmated-text_box"><img src="images/animated_pl.gif" width="100%" height="21" alt="animated text" /></div>
<div class="innner_box_aplc margin_rihgt">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="25" align="left" scope="row">Full Name:</td>
    </tr>
    <tr>
      <td scope="row"><input type="hidden" name="Activate" id="Activate" ><input type="hidden" name="source" value="<? echo $retrivesource; ?>">
<input name="Name" class="aplc_input_abc_new" id="Name" type="text"  onkeydown="validateDiv('nameVal');" tabindex=1/>
   <div id="nameVal"></div></td>
    </tr>
  </table>
</div>

<div class="innner_box_aplc margin_rihgt">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="25" align="left" scope="row">City:</td>
    </tr>
    <tr>
      <td scope="row"><select name="City" id="City" class="aplc_input_abc_new"  onChange="othercity1(); addhdfclife();  validateDiv('cityVal');" tabindex="6">
                            <?=plgetCityList($City)?>
                   <option value="Vapi">Vapi</option>
				   <option value="Ankleshwar">Ankleshwar</option>
				    <option value="Anand">Anand</option>
					 <option value="Anand">Dahod</option>
					  <option value="Anand">Navsari</option>
                        </select>
          <div id="cityVal"></div> </td>
    </tr>
  </table>
</div>

<div class="innner_box_aplc margin_rihgt">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="25" align="left" scope="row">Pincode:</td>
    </tr>
    <tr>
      <td scope="row"><input name="Pincode" id="Pincode" maxlength="6" onkeypress="intOnly(this);" onkeyup="intOnly(this);"  onkeydown="validateDiv('pincodeVal');" type="text" class="aplc_input_abc_new" tabindex=9/>
         <div id="pincodeVal"></div></td>
    </tr>
  </table>
</div>
<div class="innner_box_aplc margin_rihgt">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="25" align="left" scope="row">Annual Income:</td>
    </tr>
    <tr>
      <td scope="row"><input type="text" name="IncomeAmount" id="IncomeAmount" class="aplc_input_abc_new" onkeyup="intOnly(this); getDigitToWords('IncomeAmount','formatedIncome','wordIncome');" onkeypress="intOnly(this);"  onblur="getDigitToWords('IncomeAmount','formatedIncome','wordIncome');"  onchange="ShowHide('incomeShow','IncomeAmount');" onkeydown="validateDiv('netSalaryVal');"  tabindex=12/>
                             <div id="dialog-modal" > </div>
        <div id="netSalaryVal"></div> 
        <span id='formatedIncome' style='font-size:11px;
font-weight:normal; color:#ffffff;font-Family:Verdana;'></span> <span id='wordIncome' style='font-size:11px;
font-weight:normal; color:#ffffff;font-Family:Verdana;text-transform: capitalize;'></span> </td>
    </tr>
  </table>
</div>
<div class="aplc_clearfix"></div>
<div class="innner_box_aplc margin_rihgt">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="25" align="left" scope="row">DOB:</td>
    </tr>
    <tr>
      <td scope="row"><input name="day" id="day" type="text" class="dd-aplc_new" value="dd" onblur="onBlurDefault(this,'dd');" onfocus="onFocusBlank(this,'dd');" maxlength="2" onkeyup="intOnly(this);" onkeypress="intOnly(this);" onkeydown="validateDiv('dobVal');" tabindex=2/>
       <input name="month" id="month" type="text" class="dd-aplc_new" value="mm" onblur="onBlurDefault(this,'mm');" onfocus="onFocusBlank(this,'mm');" maxlength="2" onkeyup="intOnly(this);" onkeypress="intOnly(this);" onkeydown="validateDiv('dobVal');" tabindex=3/>
       <input name="year" id="year" type="text" class="dd-aplc_new" value="yyyy" onblur="onBlurDefault(this,'yyyy');" onfocus="onFocusBlank(this,'yyyy');" maxlength="4" onkeyup="intOnly(this);" onkeypress="intOnly(this);" onkeydown="validateDiv('dobVal');" tabindex=4/>
        <div id="dobVal"></div>   
      </td>
    </tr>
  </table>
</div>

<div class="innner_box_aplc margin_rihgt">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="25" align="left" scope="row">Other City:</td>
    </tr>
    <tr>
      <td scope="row"> <input name="City_Other" id="City_Other" type="text" class="aplc_input_abc_new" disabled  onkeydown="validateDiv('othercityVal');"  tabindex=7/>
          <div id="othercityVal"></div>  </td>
    </tr>
  </table>
</div>
<div class="innner_box_aplc margin_rihgt">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="25" align="left" scope="row">Occupation:</td>
    </tr>
    <tr>
      <td scope="row"><select name="Employment_Status" id="Employment_Status"  onchange="validateDiv('empStatusVal'); change_empstst();" class="aplc_input_abc_new" tabindex=10 >
                           <option value="-1">Please Select</option>
                           <option value="1">Salaried</option>
                           <option value="0">Self Employed</option>
                     </select>
          <div id="empStatusVal"></div></td>
    </tr>
  </table>
</div>

<div class="innner_box_aplc margin_rihgt">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="25" align="left" scope="row">Loan Amount:</td>
    </tr>
    <tr>
      <td scope="row"> <input name="Loan_Amount" id="Loan_Amount" maxlength="8" onkeypress="intOnly(this);" onkeyup="intOnly(this); getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');"  onblur="getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');"  type="text" class="aplc_input_abc_new" onkeydown="validateDiv('loanAmtVal');" tabindex=13/>
     <div id="loanAmtVal"></div>
     <span id='formatedlA' style='font-size:11px;
font-weight:normal; color:#ffffff;font-Family:Verdana;'></span><span id='wordloanAmount' style='font-size:11px;
font-weight:normal; color:#ffffff;font-Family:Verdana;text-transform: capitalize;'></span>
</td>
    </tr>
  </table>
</div>
<div class="aplc_clearfix"></div>
<div class="innner_box_aplc margin_rihgt">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="25" colspan="2" align="left" scope="row">Mobile:</td>
    </tr>
    <tr>
      <td width="13%" scope="row"> +91
</td>
      <td width="87%" align="left" scope="row"><input name="Phone" id="Phone" maxlength="10" onkeyup="intOnly(this);" onkeypress="intOnly(this)"; onchange="intOnly(this);" type="text" class="aplc_input_abc_new" onkeydown="validateDiv('phoneVal');"  tabindex=5/>
            <div id="phoneVal"></div> </td>
    </tr>
  </table>
</div>

<div class="innner_box_aplc margin_rihgt">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="25" align="left" scope="row">Email ID :</td>
    </tr>
    <tr>
      <td scope="row"><input name="Company_Name" id="Company_Name" type="text"  class="aplc_input_abc_new" onblur="onBlurDefault(this,'Type slowly to autofill');" onkeyup="ajax_showOptions(this,'getCountriesByLetters',event, " onfocus="onFocusBlank(this,'Type slowly to autofill');" onkeydown="validateDiv('companyNameVal');" value="Type slowly to autofill" tabindex=11/>
            <div id="companyNameVal"></div></td>
    </tr>
  </table>
</div>

<div class="innner_box_aplc margin_rihgt">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="25" align="left" scope="row">Company Name:</td>
    </tr>
    <tr>
      <td scope="row"><input name="Company_Name" id="Company_Name" type="text"  class="aplc_input_abc_new" onblur="onBlurDefault(this,'Type slowly to autofill');" onkeyup="ajax_showOptions(this,'getCountriesByLetters',event, " onfocus="onFocusBlank(this,'Type slowly to autofill');" onkeydown="validateDiv('companyNameVal');" value="Type slowly to autofill" tabindex=11/>
            <div id="companyNameVal"></div></td>
    </tr>
  </table>
</div>

<div class="innner_box_aplc margin_rihgt">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td align="left" scope="row">Credit Card:  <input type="radio" name="CC_Holder" id="CC_Holder" value="1" onclick="return addIdentified();" style="border:none;" /> 
      Yes  <input type="radio"  name="CC_Holder" id="CC_Holder" onclick="removeIdentified();" value="0" style="border:none;" checked="checked" /> No</td>
    </tr>
    <tr>
      <td scope="row"> <div id="ccholderVal"></div>
      <div id="myDiv1"></div>  </td>
    </tr>
  </table>
</div>
<div class="aplc_clearfix"></div>
<div class="aplc_iauthorised_box"><input name="accept" type="checkbox" /> I authorize Deal4loans.com & its <a href="/pl-partnering-banks.php" target="_blank" rel="nofollow"  class="text" style=" color:#88a943; font-size:11px; text-decoration:underline;">partnering banks</a> to contact me to explain the product & I Agree to <a href="/Privacy.php" target="_blank" rel="nofollow"  class="text" style=" color:#88a943; font-size:11px; text-decoration:underline;">Privacy policy</a> and <a href="Privacy.php" target="_blank" rel="nofollow"  class="text" style=" color:#88a943; font-size:11px; text-decoration:underline;">Terms and Conditions</a>.
 <div id="acceptVal"></div></div>
 <div class="aplc_getquote_btn"><input type="submit" style="border: 0px none ; background-image: url(images/get1.gif); width: 114px; height: 52px; margin-bottom: 0px;" value=""/></div>
<div class="aplc_clearfix"></div>
<div id="hdfclife"></div>

<div style="clear:both;"></div>
</form>
</div>

<table width="663" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td  align="left" valign="top" ><!--<table width="960" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="14" align="left" valign="top"><img src="images/bgtop1.jpg" width="960" height="14" /></td>
      </tr>
      <tr>
        <td height="55" align="left" valign="top" bgcolor="#21405F"><table width="955" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="24">&nbsp;</td>
            <td width="735"><div class="text3" style=" color:#FFF; font-size:24px; text-transform:none; "><h1 class="text3" style="width:500px; height:33; margin-top:0px; float:left; clear:right; font-size:24px; text-transform:none; color:#fff;">Apply Personal Loan</h1></div></td>
            <td width="196" rowspan="2" valign="top">&nbsp;</td>
          </tr>
       <tr>
            <td>&nbsp;</td>
            <td><span class="text3" style="float:left; width:575px; font-size:24px; color:#FFF; text-transform:none; margin-top:11px"><img src="images/animated_pl.gif"  /></span></td>
          </tr>
          </table></td>
      </tr>
      <tr>
        <td  align="center" valign="top" bgcolor="#21405F"><form name="loan_form" method="post" action="insert_personal_loan_value_httpsstep.php" onSubmit="return chkpersonalloan();"><input type="hidden" name="creative" value="<? echo $_SERVER["HTTP_USER_AGENT"]; ?>"><table width="943" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="11" rowspan="2" align="left" valign="top">&nbsp;</td>
            <td width="183" align="left" valign="top"><table width="183" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="183" height="58" align="left" valign="top"><div style=" float:left; width:183px; height:45px; margin-left:0px; margin-top:5px;">
                      <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Full Name:</div>
                    <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;">
                     <input type="hidden" name="Activate" id="Activate" ><input type="hidden" name="source" value="<? echo $retrivesource; ?>">
                        <input name="Name" id="Name" type="text" style="width:180px; height:16px;" onkeydown="validateDiv('nameVal');" tabindex=1/>
   <div id="nameVal"></div>   
                      </div>
                  </div></td>
                </tr>
                <tr>
                  <td height="55" align="left" valign="top"><div style=" float:left; width:183px; height:45px; margin-left:0px; margin-top:5px;">
                      <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">DOB:</div>
                    <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;">
                        <div class="text" style=" float:left; clear:right;">
                        <input name="day" id="day" type="text" style="width:43px; height:16px;" value="dd" onblur="onBlurDefault(this,'dd');" onfocus="onFocusBlank(this,'dd');" maxlength="2" onkeyup="intOnly(this);" onkeypress="intOnly(this);" onkeydown="validateDiv('dobVal');" tabindex=2/>&nbsp;
                        </div>
                      <div class="text" style=" float:left; clear:right;">
                        <input name="month" id="month" type="text" style="width:43px; height:16px;" value="mm" onblur="onBlurDefault(this,'mm');" onfocus="onFocusBlank(this,'mm');" maxlength="2" onkeyup="intOnly(this);" onkeypress="intOnly(this);" onkeydown="validateDiv('dobVal');" tabindex=3/>&nbsp;
                        </div>
                      <div class="text" style=" float:left; clear:right;">
                        	<input name="year" id="year" type="text" style="width:60px; height:16px;" value="yyyy" onblur="onBlurDefault(this,'yyyy');" onfocus="onFocusBlank(this,'yyyy');" maxlength="4" onkeyup="intOnly(this);" onkeypress="intOnly(this);" onkeydown="validateDiv('dobVal');" tabindex=4/>
                        </div>
                           <div id="dobVal"></div>   
                    </div>
                  </div></td>
                </tr>
                <tr>
                  <td height="58"><div style=" float:left; width:183px; height:45px; margin-left:0px; margin-top:5px;">
                      <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;"><span class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Mobile:</span></div>
                    <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;">
                        <div class="text" style=" float:left; width:26px; height:auto; color:#FFF; font-size:12px; text-transform:none; clear:right; margin-top:3px; "> +91</div>
                      <div class="text" style=" float:left; width:26px; height:auto; color:#FFF; font-size:12px; text-transform:none; clear:right; ">
                        <input name="Phone" id="Phone" maxlength="10" onkeyup="intOnly(this);" onkeypress="intOnly(this)"; onchange="intOnly(this);" type="text" style="width:153px; height:16px;" onkeydown="validateDiv('phoneVal');"  tabindex=5/>
            <div id="phoneVal"></div>  
                        </div>
                    </div>
                  </div></td>
                </tr>
               
            </table></td>
            <td width="58" align="left" valign="top">&nbsp;</td>
            <td width="185" align="left" valign="top"><table width="192" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="192" height="58" align="left" valign="top"><div style=" float:left; width:183px; height:45px; margin-left:0px; margin-top:5px;">
                    <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">City:</div>
                  <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;">                   <select name="City" id="City" style="width:180px; height:22px; font-family:Verdana, Geneva, sans-serif; font-size:11px; color:#4c4c4c;"  onChange="othercity1(); addhdfclife();  validateDiv('cityVal');" tabindex="6">
                            <?=plgetCityList($City)?>
                   <option value="Vapi">Vapi</option>
				   <option value="Ankleshwar">Ankleshwar</option>
				    <option value="Anand">Anand</option>
					 <option value="Anand">Dahod</option>
					  <option value="Anand">Navsari</option>
                        </select>
                         <div id="cityVal"></div>   
                    </div>
                </div></td>
              </tr>
              <tr>
                <td height="58" align="left" valign="top"><div style=" float:left; width:183px; height:45px; margin-left:0px; margin-top:5px;">
                    <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Other City:</div>
                  <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;">
                       <input name="City_Other" id="City_Other" type="text" style="width:180px; height:16px;" disabled  onkeydown="validateDiv('othercityVal');"  tabindex=7/>
                        <div id="othercityVal"></div>   
                    </div>
                </div></td>
              </tr>
              <tr>
                <td height="58"><div style=" float:left; width:183px; height:45px; margin-left:0px; margin-top:5px;">
                    <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Email ID :</div>
                  <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;">
                  <input name="Email" id="Email" type="text" style="width:180px; height:16px;" onkeydown="validateDiv('emailVal');"  tabindex=8/>
          <div id="emailVal"></div> 
                    </div>
                </div></td>
              </tr>              
            </table></td>
            <td width="50" align="left" valign="top">&nbsp;</td>
            <td width="186" align="left" valign="top"><table width="183" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="183" height="58" align="left" valign="top"><div style=" float:left; width:183px; height:45px; margin-left:0px; margin-top:5px;">
                  <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Pincode:</div>
                  <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;"><input name="Pincode" id="Pincode" maxlength="6" onkeypress="intOnly(this);" onkeyup="intOnly(this);"  onkeydown="validateDiv('pincodeVal');" type="text" style="width:180px; height:16px;" tabindex=9/>
         <div id="pincodeVal"></div>
                    </div>
                </div></td>
              </tr>
              <tr>
                <td height="58" align="left" valign="top"><div style=" float:left; width:183px; height:45px; margin-left:0px; margin-top:5px;">
                    <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;"><span class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Occupation: </span></div>
                  <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;">
                 <select name="Employment_Status" id="Employment_Status"  onchange="validateDiv('empStatusVal'); change_empstst();"  style="width:180px; height:22px; font-family:Verdana, Geneva, sans-serif; font-size:11px; color:#4c4c4c;" tabindex=10 >
                           <option value="-1">Please Select</option>
                           <option value="1">Salaried</option>
                           <option value="0">Self Employed</option>
                     </select>
                       <div id="empStatusVal"></div>
                    </div>
                </div></td>
              </tr>
              <tr>
                <td height="58"><div id="chnge_empstst"><div style=" float:left; width:183px; height:45px; margin-left:0px; margin-top:5px;">
                    <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;"><span class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Company Name: </span></div>
                  <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;">
                   <input name="Company_Name" id="Company_Name" type="text"  style="width:180px; height:16px;" onblur="onBlurDefault(this,'Type slowly to autofill');" onkeyup="ajax_showOptions(this,'getCountriesByLetters',event, " onfocus="onFocusBlank(this,'Type slowly to autofill');" onkeydown="validateDiv('companyNameVal');" value="Type slowly to autofill" tabindex=11/>
                        <div id="companyNameVal"></div>
                    </div>
                </div></div></td>
              </tr>
            </table></td>
            <td width="56" align="left" valign="top">&nbsp;</td>
            <td width="214" align="left" valign="top"><table width="183" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="183" height="58" align="left" valign="top"><div style=" float:left; width:183px; height:45px; margin-left:0px; margin-top:5px;">
                      <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Annual Income:</div>
                    <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;">
                       <input type="text" name="IncomeAmount" id="IncomeAmount" style="width:180px; height:16px;"  onkeyup="intOnly(this); getDigitToWords('IncomeAmount','formatedIncome','wordIncome');" onkeypress="intOnly(this);"  onblur="getDigitToWords('IncomeAmount','formatedIncome','wordIncome');"  onchange="ShowHide('incomeShow','IncomeAmount');" onkeydown="validateDiv('netSalaryVal');"  tabindex=12/>
              <div id="dialog-modal" > </div>
        <div id="netSalaryVal"></div>   
                      </div>
                  </div>  <span id='formatedIncome' style='font-size:11px;
font-weight:normal; color:#ffffff;font-Family:Verdana;'></span> <span id='wordIncome' style='font-size:11px;
font-weight:normal; color:#ffffff;font-Family:Verdana;text-transform: capitalize;'></span></td>
                </tr>
                <tr>
                  <td height="58" align="left" valign="top"><div style=" float:left; width:183px; height:45px; margin-left:0px; margin-top:5px;">
                      <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Loan Amount:</div>
                    <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;">
                    <input name="Loan_Amount" id="Loan_Amount" maxlength="8" onkeypress="intOnly(this);" onkeyup="intOnly(this); getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');"  onblur="getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');"  type="text" style="width:180px; height:16px;" onkeydown="validateDiv('loanAmtVal');" tabindex=13/>
     <div id="loanAmtVal"></div>
                      </div>
                  </div><span id='formatedlA' style='font-size:11px;
font-weight:normal; color:#ffffff;font-Family:Verdana;'></span><span id='wordloanAmount' style='font-size:11px;
font-weight:normal; color:#ffffff;font-Family:Verdana;text-transform: capitalize;'></span></td>
                </tr>
                <tr>
                  <td height="58">
                 <div style=" float:left; width:183px; height:45px; margin-left:0px; margin-top:5px;">
                  <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;"></div>
                  <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:17px;">
                    <div style=" float:left; width:70px; height:auto; clear:right; ">Credit Card:</div>
                    <div style=" float:left; width:15px; height:auto; clear:right; margin-left:0px; margin-top:5px; ">
                    <input type="radio" name="CC_Holder" id="CC_Holder" value="1" onclick="return addIdentified();" style="border:none;" />
                    </div>
                    <div style=" float:left; width:15px; height:auto; clear:right; margin-left:8px; margin-top:8px; "> Yes</div>
                    <div style=" float:left; width:15px; height:auto; clear:right; margin-left:13px; margin-top:5px; ">
                     <input type="radio"  name="CC_Holder" id="CC_Holder" onclick="removeIdentified();" value="0" style="border:none;" checked="checked" />
                    </div>
                    <div style=" float:left; width:10px; height:auto; clear:right; margin-left:5px; margin-top:8px; "> No</div>
                     <div id="ccholderVal"></div>   
                  </div>
                </div></td>
                </tr>
                 <tr>
                <td  id="myDiv1" >
          </td>
		  </tr>
            </table></td>
          </tr>
          <tr>
            <td height="40" colspan="7" align="left" valign="top"><table width="923" border="0" cellspacing="0" cellpadding="0">
              <tr>
               
                <td width="772" align="left" valign="top"><div class="text" style=" float:left; width:760px; height:auto; color:#FFF; font-size:11px; text-transform:none; margin-top:5px;">
                                 <input name="accept" type="checkbox" /> I authorize Deal4loans.com & its <a href="/pl-partnering-banks.php" target="_blank" rel="nofollow"  class="text" style=" color:#88a943; font-size:11px; text-decoration:underline;">partnering banks</a> to contact me to explain the product & I Agree to <a href="/Privacy.php" target="_blank" rel="nofollow"  class="text" style=" color:#88a943; font-size:11px; text-decoration:underline;">Privacy policy</a> and <a href="Privacy.php" target="_blank" rel="nofollow"  class="text" style=" color:#88a943; font-size:11px; text-decoration:underline;">Terms and Conditions</a>.
              <div id="acceptVal"></div></div></td>
                <td width="151" align="right" valign="top"><div style=" float:right; width:114px; height:45px; margin-top:0px; margin-left:0px;">  <input type="submit" style="border: 0px none ; background-image: url(images/get1.gif); width: 114px; height: 52px; margin-bottom: 0px;" value=""/></div></td>
              </tr>
            </table>              </td>
            </tr>
             <tr>
            <td colspan="7" align="left" valign="top">
             <div id="hdfclife"></div>
            </td></tr>
        </table></form></td>
      </tr>
      <tr>
        <td height="14" align="center" valign="top"><img src="images/bgbottom1.jpg" width="960" height="14" /></td>
      </tr>
    </table>--></td>
  </tr>
</table>

<!--partners--></div>
<div class="aplc_clearfix"></div>
<div class="artical_head_text_aplc">Quotes available from following Banks - Maximum  <strong style="background:#88a943; padding:3px; font-weight:normal; color:#FFF;">Personal loan Bank</strong>  Tie ups in online space</div>
<div class="body_box-tird">
<div class="arrow_aplc_indicator"></div>
<div class="table_wrapper_new">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="11%" height="64" align="center" bgcolor="#2799de" class="table_head_txt_aplc" scope="row" style="border-right:thin solid #FFF;">Banks</td>
    <td width="12%" height="64" align="center" bgcolor="#2799de" class="table_head_txt_aplc" scope="row" style="border-right:thin solid #FFF;">Rate of Interest</td>
    <td width="10%" height="64" align="center" bgcolor="#2799de" class="table_head_txt_aplc" scope="row" style="border-right:thin solid #FFF;">Processing Fee</td>
    <td width="15%" height="64" align="center" bgcolor="#2799de" class="table_head_txt_aplc" scope="row" style="border-right:thin solid #FFF;">Loan Amount</td>
    <td width="15%" height="64" align="center" bgcolor="#2799de" class="table_head_txt_aplc" scope="row" style="border-right:thin solid #FFF;">Prepayment Charges</td>
    <td width="10%" height="64" align="center" bgcolor="#2799de" class="table_head_txt_aplc" scope="row" style="border-right:thin solid #FFF;">Disbursal Time</td>
    <td width="8%" align="center" bgcolor="#2799de" class="table_head_txt_aplc" scope="row" style="border-right:thin solid #FFF;">Part Payment Option</td>
    <td width="19%" align="center" bgcolor="#2799de" class="table_head_txt_aplc" scope="row">Basic Documents</td>
  </tr>
  <tr>
    <td height="70" bgcolor="#e0f0fb" class="table_head_txt_aplc_b" scope="row" style="border-right:thin solid #FFF;">HDFC Bank</td>
    <td height="70" align="center" bgcolor="#e0f0fb" class="table_head_txt_aplc_c" scope="row">12.99% - 20%</td>
    <td height="70" align="center" bgcolor="#e0f0fb" class="table_head_txt_aplc_c" scope="row" style="border-right:thin solid #FFF;">2% (Acc holder), else 2.5%</td>
    <td height="70" align="center" bgcolor="#e0f0fb" class="table_head_txt_aplc_c" scope="row" style="border-right:thin solid #FFF;">Rs.50,000 - Rs.15,00,000</td>
    <td height="70" align="center" bgcolor="#e0f0fb" class="table_head_txt_aplc_c" scope="row" style="border-right:thin solid #FFF;">4%</td>
    <td height="70" align="center" bgcolor="#e0f0fb" class="table_head_txt_aplc_c" scope="row" style="border-right:thin solid #FFF;">3 - 4 Days</td>
    <td height="70" align="center" bgcolor="#e0f0fb" class="table_head_txt_aplc_c" scope="row" style="border-right:thin solid #FFF;">No</td>
    <td rowspan="5" bgcolor="#e0f0fb" class="table_head_txt_aplc_d" scope="row"><div class="table_head_txt_aplc_d" style="margin-top:0px; padding-top:0px;"><strong>Identity Proof :</strong> Passport/ Driving License/PAN card/ Photo credit card (with embossed Signature and last two months statement)/ banker’s sign verification (Anyone of the above)</div>

     <div class="table_head_txt_aplc_d">   <strong>Age Proof :</strong> PAN Card/ Passport/ Driving License / School leaving certificate/ Voter’s card/BirthCertificate/ LIC policy (only for age Proof). (Anyone of the above)</div>
       <div class="table_head_txt_aplc_d"> <strong>Address Proof :</strong> Passport/ Telephone bill (BSNL/MTNL)/ Electricity bill/ Title deed of property/Rental agreement/ Driving license/ Election ID card/ Photo-credit card (with last two month statements) (Anyone of the above) </div>
       <div>
       <div class="table_head_txt_aplc_d">
        <strong>Income Proof :</strong> Latest 2 months salary slip<br />
        <strong>Job Continuity Proof :</strong> Form 16/relieving letter/appointment Letter (for last two months) (Anyone of the above)<br />
        <strong>Banking History :</strong> Bank statements of latest 3 months 
    </p></div>
    </div>
    </td>
  </tr>
  <tr>
    <td height="70" bgcolor="#f2fbfd" class="table_head_txt_aplc_b" scope="row" style="border-right:thin solid #FFF;">Bajaj Finance</td>
    <td height="70" align="center" bgcolor="#f2fbfd" class="table_head_txt_aplc_c" scope="row" style="border-right:thin solid #FFF;">15% - 17%</td>
    <td height="70" align="center" bgcolor="#f2fbfd" class="table_head_txt_aplc_c" scope="row" style="border-right:thin solid #FFF;">Upto 2%</td>
    <td height="70" align="center" bgcolor="#f2fbfd" class="table_head_txt_aplc_c" scope="row" style="border-right:thin solid #FFF;">Upto 18 Lacs</td>
    <td height="70" align="center" bgcolor="#f2fbfd" class="table_head_txt_aplc_c" scope="row" style="border-right:thin solid #FFF;" >NIL Foreclosure</td>
    <td height="70" align="center" bgcolor="#f2fbfd" class="table_head_txt_aplc_c" scope="row" style="border-right:thin solid #FFF;">Approval In 24 Hours</td>
    <td height="70" align="center" bgcolor="#f2fbfd" class="table_head_txt_aplc_c" scope="row" style="border-right:thin solid #FFF;">Yes</td>
    </tr>
  <tr>
    <td height="70" bgcolor="#E0F0FB" class="table_head_txt_aplc_b" scope="row" style="border-right:thin solid #FFF;">Kotak Bank</td>
    <td height="70" align="center" bgcolor="#E0F0FB" class="table_head_txt_aplc_c" scope="row" style="border-right:thin solid #FFF;">13.60% - 18%</td>
    <td height="70" align="center" bgcolor="#E0F0FB" class="table_head_txt_aplc_c" scope="row" style="border-right:thin solid #FFF;">2%</td>
    <td height="70" align="center" bgcolor="#E0F0FB" class="table_head_txt_aplc_c" scope="row" style="border-right:thin solid #FFF;">Rs.100,000 - Rs.15,00,000</td>
    <td height="70" align="center" bgcolor="#E0F0FB" class="table_head_txt_aplc_c" scope="row" style="border-right:thin solid #FFF;">5%</td>
    <td height="70" align="center" bgcolor="#E0F0FB" class="table_head_txt_aplc_c" scope="row" style="border-right:thin solid #FFF;">3 - 4 working days</td>
    <td height="70" align="center" bgcolor="#E0F0FB" class="table_head_txt_aplc_c" scope="row">No</td>
    </tr>
  <tr>
    <td height="70" bgcolor="#F2FBFD" class="table_head_txt_aplc_b" scope="row" style="border-right:thin solid #FFF;">ICICI Bank</td>
    <td height="70" align="center" bgcolor="#F2FBFD" class="table_head_txt_aplc_c" scope="row" style="border-right:thin solid #FFF;">13.49% - 17.50%</td>
    <td height="70" align="center" bgcolor="#F2FBFD" class="table_head_txt_aplc_c" scope="row" style="border-right:thin solid #FFF;">0.50% for special companies else 1.50% - 2.25%</td>
    <td height="70" align="center" bgcolor="#F2FBFD" class="table_head_txt_aplc_c" scope="row" style="border-right:thin solid #FFF;">Rs.50,000 - Rs.15,00,000</td>
    <td height="70" align="center" bgcolor="#F2FBFD" class="table_head_txt_aplc_c" scope="row" style="border-right:thin solid #FFF;">Nil (For Loan amount &gt;10 lacs &amp; 12 EMI paid), else 5%</td>
    <td height="70" align="center" bgcolor="#F2FBFD" class="table_head_txt_aplc_c" scope="row" style="border-right:thin solid #FFF;">3 - 4 working days</td>
    <td height="70" align="center" bgcolor="#F2FBFD" class="table_head_txt_aplc_c" scope="row" style="border-right:thin solid #FFF;">No</td>
    </tr>
  <tr>
    <td height="70" bgcolor="#E0F0FB" class="table_head_txt_aplc_b" scope="row" style="border-right:thin solid #FFF;">ING Vysya Bank</td>
    <td height="70" align="center" bgcolor="#E0F0FB" class="table_head_txt_aplc_c" scope="row" style="border-right:thin solid #FFF;">13.75% - 18.25%</td>
    <td height="70" align="center" bgcolor="#E0F0FB" class="table_head_txt_aplc_c" scope="row" style="border-right:thin solid #FFF;">Upto 2%</td>
    <td height="70" align="center" bgcolor="#E0F0FB" class="table_head_txt_aplc_c" scope="row" style="border-right:thin solid #FFF;">1 Lac - 15 Lacs</td>
    <td height="70" align="center" bgcolor="#E0F0FB" class="table_head_txt_aplc_c" scope="row" style="border-right:thin solid #FFF;">Nil Foreclosure Charges Special Offer*. Valid till (30th Sept'14</td>
    <td height="70" align="center" bgcolor="#E0F0FB" class="table_head_txt_aplc_c" scope="row" style="border-right:thin solid #FFF;">2-4 working days</td>
    <td height="70" align="center" bgcolor="#E0F0FB" class="table_head_txt_aplc_c" scope="row" style="border-right:thin solid #FFF;">Yes</td>
    </tr>
</table>

</div>
</div>
<div class="aplc_clearfix"></div>
<div class="aplc_new_terms_cc">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="86%" scope="row">*Terms & conditions apply<br />
<strong>Tips for Best Personal loan deal</strong><br />
1) Compare exact Emi|Processing fee |Tenure|Documents before choosing bank|<br />
2) Never pay any fee to any person to get loan sanctioned.Processing fee are deducted from Loan amount.<br />
3) Only give documents to one bank and check whether he is authorized Bank employee or vendor.</td>
    <td width="14%"><a href="Contents_Calculators.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image3','','images/emi2.gif',1)"><img src="images/emi1.gif" alt="EMI Calculator" name="Image3" width="95" height="20" border="0" id="Image3" hspace="5px"></a></td>
  </tr>
</table>


</div>
<div class="aplc_clearfix"></div>
<div class="head_text_below_aplc">Loan Partners</div>
<div class="banks_logos_abcd" > <img src="images/banks_logos_aplc.png" width="946" height="60" /></div>
<div class="banks_logos_abcd_mobile"><img src="images/mobile-aplc-partner_logos.jpg" width="292" height="108" alt="partner banks logo" /></div>

<!--partners-->
<div class="header-continue_aplc"><?php include "footer1.php"; ?></div>
</body>
</html>