<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';

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
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'>  
<title>Apply for Personal Loan | Personal Loans Online Apply India |Deal4Loans</title>
<meta name="keywords" content="Apply Personal Loans, personal loans apply, online personal loan apply, apply personal loan india">
<meta name="description" content="Apply Online Personal Loans through Deal4loans.com Get instant information on personal loans banks like Mumbai, Delhi, Noida, Kolkata, Gurgaon, Bangalore, Chennai, Hyderabad.">
<link href="source.css" rel="stylesheet" type="text/css" />
 <script type="text/javascript" src="scripts/mainmenu.js"></script>
 <link href="css/slider.css" rel="stylesheet" type="text/css" />
 <script type="text/javascript" src="js/jquery-1.2.6.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-personalized-1.5.2.packed.js"></script>
<script type="text/javascript" src="js/sprinkle.js"></script>
<script type="text/javascript" src="js/easySlider1.5.js"></script>
 <script type="text/javascript" src="scripts/common.js"></script>
 <script language="JavaScript" type="text/javascript" src="http://www.deal4loans.com/suggest.js"></script>
 <script type="text/javascript" src="ajax.js"></script>
<script type="text/javascript" src="ajax-dynamic-pllist.js"></script>
<script type="text/javascript">
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
	</script>
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
	  <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.1/themes/base/jquery-ui.css" />
    <script src="http://code.jquery.com/jquery-1.8.2.js"></script>
    <script src="/resources/demos/external/jquery.bgiframe-2.1.2.js"></script>
    <script src="http://code.jquery.com/ui/1.9.1/jquery-ui.js"></script>
 <script type="text/javascript" src="http://www.deal4loans.com/ajax.js"></script>
<script type="text/javascript" src="http://www.deal4loans.com/ajax-dynamic-pllist.js"></script>
   <script type="text/javascript" src="scripts/mainmenu.js"></script>
   <script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>

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
	//var i;
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
	    ni1.innerHTML = '<div style=" float:left; width:183px; height:47px;  margin-top:5px;"><div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Card held since?</div>    <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;"><select size="1" name="Card_Vintage" style="width:180px; height:24px; font-family:Verdana, Geneva, sans-serif; font-size:11px; color:#4c4c4c;" onchange="validateDiv(\'vintageVal\');" ><option value="0">Please select</option> <option value="1">Less than 6 months</option> <option value="2">6 to 9 months</option> <option value="3">9 to 12 months</option><option value="4">more than 12 months</option> </select></div><div id="vintageVal"></div></div>';
					
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
//	var otrcit = document.loan_form.City_Other.value;
ni1.innerHTML = '';
	if(cit =="Bangalore" || cit =="Baroda" || cit =="Bhubaneshwar" || cit =="Chandigarh" || cit =="Chennai" || cit =="Cochin" || cit =="Cuttack" || cit =="Delhi" || cit =="Faridabad" || cit =="Gaziabad" || otrcit =="Greater Noida" || cit =="Gurgaon" || cit =="Guwahati" || cit =="Hyderabad" || cit =="Indore" || cit =="Jaipur" || cit =="Kanpur" || cit =="Kochi" || cit =="Kolkata" || cit =="Lucknow" || cit =="Mumbai" || cit =="Noida" || cit =="Pune" || cit =="Sahibabad" ||
cit =="Surat" || cit =="Thane" || cit =="Vadodara" || cit =="Vijaywada" || cit =="Vishakapatanam" || cit =="Vizag" )
	{
		//alert("ranjana");
		ni1.innerHTML = '<table  style="border:1px solid #000000; padding:2px; width:706px;"><tr><td colspan="2" class="frmbldtxt" style="font-family:verdana; font-size:10px; color:#ffffff; font-weight:normal; " height="20"><span style="color:#ff0000;">(Optional) </span>Special service only for Deal4loans customers:</td></tr> <tr><td width="23"><input type="checkbox"  name="hdfclife" id="hdfclife" value="1"/></td> <td width="611" class="frmbldtxt" style="font-family:verdana; font-size:10px; color:#ffffff; font-weight:normal; "> I would like to avail of <b>FREE </b>financial planning services by <b>Insurance & Investment experts</b> from HDFC Life.</td>		 </tr>	 </table>';	
	}
	else
	{
		ni1.innerHTML = '';
	}
	
	return true;
}


function change_empstst()
{
	var occpdiv = document.getElementById('chnge_empstst');
	var occupation = document.loan_form.Employment_Status.value;
	
	if(occupation==0)
	{
	occpdiv.innerHTML = '<div style=" float:left; width:183px; height:45px; margin-left:0px; margin-top:5px;">                    <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;"><span class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Annual Turnover: </span></div>                  <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;">                  <select name="Annual_Turnover" id="Annual_Turnover" style="width:180px; height:22px; font-family:Verdana, Geneva, sans-serif; font-size:11px; color:#4c4c4c;">		<option value="">Please Select</option>		<option value="1" > Less Than 1 Cr</option>		<option value="2" > 1Cr - 3Crs </option>	<option value="3" >3Crs & above</option></select>                        <div id="annualTurnoverVal"></div>                    </div>                </div>';
	
	}
	else
	{
	occpdiv.innerHTML = '<div style=" float:left; width:183px; height:45px; margin-left:0px; margin-top:5px;">                    <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;"><span class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Company Name: </span></div>                  <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;">                   <input name="Company_Name" id="Company_Name" type="text"  style="width:180px; height:16px;" onblur="onBlurDefault(this,\'Type slowly to autofill\');" onkeyup="ajax_showOptions(this,\'getCountriesByLetters\',event, \'http://www.deal4loans.com/ajax-list-plcompanies.php\')" onfocus="onFocusBlank(this,\'Type slowly to autofill\');" onkeydown="validateDiv(\'companyNameVal\');" value="Type slowly to autofill" tabindex=11/>                        <div id="companyNameVal"></div>                    </div>                </div>';
				}
				
}
  </script>

  
</head>

<body >
<?php include "middle-menu.php"; ?>
<div style="clear:both;"></div>
<div class="cc_inner_wrapper">
<div style="clear:both;"></div>
<div class="common-bread-crumb" style="margin:auto; width:74%; margin-top:70px; color:#0a8bd9;"><u><a href="index.php" class="text12" style="color:#0080d6;" >Home</a></u> > <a href="personal-loans.php"  class="text12" style="color:#0080d6;"><u>Personal Loan</u></a> <span class="text12" style="color:#4c4c4c;">> Apply for Personal Loan</span></div>
<div class="intrl_txt" style="margin:auto;">
<div style=" float:right; width:663px; height:auto; margin-top:5px; text-align:justify;"><table align="center" border="0" width="660"><tr><td align="center"><table width="90%" cellpadding="2" cellspacing="0" bgcolor="#EDF8FC" style="border:1px solid #ADE4F8;"><tr><td width="22%" rowspan="2" style="color:#FF6600; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px;" align="right"><b>Festive Offer :</b></td><td width="78%" align="center" style="color:#4E4D4D; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px;"><b>Get gifts upto Rs 12500 on disbursal.</b></td></tr><tr><td align="center" style="color:#4E4D4D; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px;">Refer to T & C - www.deal4loans.com/personal-loan-offers.php 
</td></tr></table></td></tr></table></div>
<div style="clear:both; height:1px;"></div>

<table width="663" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td  align="left" valign="top" ><table width="960" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="14" align="left" valign="top"><img src="images/bgtop1.jpg" width="960" height="14" /></td>
      </tr>
      <tr>
        <td height="55" align="left" valign="top" bgcolor="#21405F"><table width="955" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="24">&nbsp;</td>
            <td width="735"><div class="text3" style=" color:#FFF; font-size:24px; text-transform:none; "><strong>Apply Personal Loan</strong></div></td>
            <td width="196" rowspan="2" valign="top">&nbsp;</td>
          </tr>
          
          <tr>
            <td>&nbsp;</td>
            <td><span class="text3" style="float:left; width:575px; font-size:24px; color:#FFF; text-transform:none; margin-top:11px"><img src="images/animated_pl.gif"  /></span></td>
          </tr>
          </table></td>
      </tr>
      <tr>
        <td  align="center" valign="top" bgcolor="#21405F"><form name="loan_form" method="post" action="insert_personal_loan_value_step1.php" onSubmit="return chkpersonalloan();"><input type="hidden" name="PostURL" value="<?php echo $_SERVER['REQUEST_URI']; ?>"><table width="943" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="11" rowspan="2" align="left" valign="top">&nbsp;</td>
            <td width="183" align="left" valign="top"><table width="183" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="183" height="58" align="left" valign="top"><div style=" float:left; width:183px; height:45px; margin-left:0px; margin-top:5px;">
                      <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Full Name:</div>
                    <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;">
                     <input type="hidden" name="Activate" id="Activate" ><input type="hidden" name="source" value="bajajfinserv_testing">
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
                   <input name="Company_Name" id="Company_Name" type="text"  style="width:180px; height:16px;" onblur="onBlurDefault(this,'Type slowly to autofill');" onkeyup="ajax_showOptions(this,'getCountriesByLetters',event, 'http://www.deal4loans.com/ajax-list-plcompanies.php')" onfocus="onFocusBlank(this,'Type slowly to autofill');" onkeydown="validateDiv('companyNameVal');" value="Type slowly to autofill" tabindex=11/>
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
                                 <input name="accept" type="checkbox" /> I Agree to&nbsp;<a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow"  class="text" style=" color:#88a943; font-size:11px; text-decoration:underline;">privacy policy</a> and&nbsp;<a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow"  class="text" style=" color:#88a943; font-size:11px; text-decoration:underline;">Terms and Conditions</a>.
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
    </table></td>
  </tr>
</table>
<div style=" float:left; width:940px; height:auto; margin-top:15px;  margin-left:20px; text-align:justify;">
  <span class="text11" style="color:#88a943; font-size:17px; font-weight:bold;">Quotes available from following Banks - Maximum Personal loan Bank Tie ups in online space<br />
<br />
</span></div>
<br />
<table width="934" border="0" align="center" cellpadding="0" cellspacing="0"  style="border: 1px solid #ececec; ">
  
  <tr>
    <td valign="top"  >
    <table width="132" border="0" align="center" cellpadding="0" cellspacing="0" >
      <tr>
        <td height="48" align="center" valign="middle" class="font2" style="background-color:#88a943; border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1; padding-left:2px;"><strong class="text3" style="color:#FFF; text-transform:none; font-size:16px;"><strong>Banks</strong></strong></td></tr>
  <tr>
        <td width="142" height="52" align="center" valign="middle" class="font2" style="border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1; padding-left:2px;"><strong>Rate of Interest 
        </strong></td></tr>
  <tr>
        <td width="142" height="52" align="center" valign="middle" class="font2" style="border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1; padding-left:2px;"><strong>Processing Fee
        </strong></td></tr>
          <tr>
        <td width="142" height="52" align="center" valign="middle" class="font2" style="border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1; padding-left:2px;"><strong>Loan Amount
        </strong></td></tr>
          <tr>
        <td width="142" height="90" align="center" valign="middle" class="font2" style="border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1; padding-left:2px;"><strong>Prepayment Charges
        </strong></td></tr>
          <tr>
        <td width="142" height="70" align="center" valign="middle" class="font2" style="border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1; padding-left:2px;"><strong>Disbursal Time
        </strong></td></tr>
              </table>
        </td>
 <?
	  $selectplbanks="Select * From personal_loan_banks_eligibility where pl_bank_flag=1";
	 
	   list($rowscount,$myrow)=MainselectfuncNew($selectplbanks,$array = array());
	  
	  
	//$plbankresult = ExecQuery($selectplbanks);
	//$rowscount = mysql_num_rows($plbankresult);
	  ?>
       <?
		 if($rowscount>0)
		 {
		 	$i=0;
		 while($i<count($myrow))
		 {?>
   <td valign="top"  >
    <table width="142" border="0" align="center" cellpadding="0" cellspacing="0"  >
      <tr>
        <td height="48" align="center" valign="middle" class="font2" style="background-color:#88a943; border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1; padding-left:2px;"><strong class="text3" style="color:#FFF; text-transform:none; font-size:16px;"><strong><? echo $myrow[$i]["pl_bank_name"];?></strong></strong></td></tr>
  <tr>
        <td width="142" height="52" align="center" valign="middle" class="font2" style="border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1; padding-left:2px;"><strong><? echo $myrow[$i]["pl_bank_roi"];?>
        </strong></td></tr>
  <tr>
        <td width="142" height="52" align="center" valign="middle" class="font2" style="border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1; padding-left:2px;"><strong><? echo $myrow[$i]["pl_bank_processing_fee"];?>
        </strong></td></tr>
          <tr>
        <td width="142" height="53" align="center" valign="middle" class="font2" style="border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1; padding-left:2px;"><strong><? echo $myrow[$i]["pl_bank_loan_amt"];?>
        </strong></td></tr>
          <tr>
        <td width="142" height="90" align="center" valign="middle" class="font2" style="border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1; padding-left:2px;"><strong><? echo $myrow[$i]["pl_bank_prepayment"];?>
        </strong></td></tr>
          <tr>
        <td width="142" height="70" align="center" valign="middle" class="font2" style="border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1; padding-left:2px;"><strong><? echo $myrow[$i]["pl_bank_disbursal_time"];?>
        </strong></td></tr>
              </table>
        </td>
          <? 
			   $i=$i+1;
			   }
			   }
			   ?>
  </tr>
   <tr>
    <td width="142" height="47" align="center" valign="middle" class="font2" style="border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1; padding-left:2px;"><strong>Basic Documents</strong></td><td colspan="6"><table  border="0" cellpadding="0" cellspacing="0" style="border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1; padding-left:2px;">
                <tr>
                <td class="font2"><b>Identity Proof : </b>  Passport/ Driving License/PAN card/                                              
                  Photo credit card (with embossed 
                  Signature and last two months                                                      
                  statement)/ banker&rsquo;s sign verification <strong>(Anyone of the above) </strong></td>
              </tr>
              <tr>
                <td class="font2"><b>Age Proof : </b> PAN Card/ Passport/ Driving  License                                                                                                           / School leaving certificate/ Voter&rsquo;s card/BirthCertificate/ LIC policy (only for                                                    
                  age Proof). <strong>(Anyone of the above) </strong></td>
              </tr>
              <tr>
               <td class="font2"><b>Address Proof : </b> Passport/ Telephone bill 
                  (BSNL/MTNL)/ Electricity bill/ Title 
                  deed of property/Rental agreement/                                                                                 
                  Driving license/ Election ID card/ 
                  Photo-credit card (with last two month 
                  statements) <strong>(Anyone of the above)</strong></td>
              </tr>
              <tr>
                 <td class="font2"><b>Income Proof : </b> Latest salary slip/current dated salary                    
                  Certificate with latest form 16 <strong>(Anyone of the above)</strong></td>
              </tr>
              <tr>
                  <td  class="font2"><b>Job Continuity Proof : </b> Form 16/relieving letter/appointment                   
                  Letter (for last two months)<strong> (Anyone of the above)</strong></td>
              </tr>
              <tr>
                
                <td  class="font2"><b>Banking History : </b> Bank statements of latest 2 months/                   
                  3 months bank passbook <strong>(Anyone of the above)</strong></td>
              </tr>
          </table></td></tr>
</table>

<div style="clear:both; height:15px;"></div>
<div style="clear:both; height:20px; width:964px; margin:auto; margin-top:10px; padding-bottom:15px;">
<table width="962" cellpadding="0" cellspacing="0">
<tr><td>
<span class="text11" style="color:#4c4c4c; ">
<b>Tips for Best Personal loan deal</b><br>
1) Compare exact Emi|Processing fee |Tenure|Documents before choosing bank|<br>
2) Never pay any fee to any person to get loan sanctioned.Processing fee are deducted from Loan amount.<br>
3) Only give documents to one bank and check whether he is authorized Bank employee or vendor.
</span></td><td>
<a href="/Contents_Calculators.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image3','','images/emi2.gif',1)"><img src="images/emi1.gif" alt="EMI Calculator" name="Image3" width="95" height="20" border="0" id="Image3" hspace="5px" /></a></td></tr></table></div>
<!--partners-->
<div class="text" style="margin:auto; width:962px; height:auto; margin-top:35px; color:#8dae48;">Loan Partners</div>
<div style="margin:auto; width:949px; height:90px;; margin-top:20px;">
<div class="sldrpnl" style="height:70px; margin-left: 1px; width: 940px; float: left; !important">
<table cellpadding="0" cellspacing="0">
<tr><td>
<div style="display:block; 	float:left;	width:155px;"><img  src="/new-images/thumb/fullrton.jpg" alt="Fullerton" width="146" height="56"  style="border:none;" /></div>
</td><td>
<div style="display:block; 	float:left;	width:155px;"><img src="http://deal4loans.com/new-images/slider/thumb/hdfc_pllogo.jpg" alt="HDFC Bank" width="146" height="56"  style="border:none;"/></div></td>
<td>
<div style="display:block; 	float:left;	width:155px;"><img src="http://deal4loans.com/new-images/thumb/bajaj-finserv1.jpg" alt="Bajaj Finserv" width="146" height="56"  style="border:none;"/></div></td>
<td>
<div style="display:block; 	float:left;	width:155px;"><img src="http://deal4loans.com/new-images/thumb/hdb-logo.jpg" alt="HDB Financial Services" width="146" height="56"  style="border:none;"/></div></td>
<td>
<div style="display:block; 	float:left;	width:155px;"><img src="http://deal4loans.com/new-images/thumb/icici.jpg" width="146" height="56" style="border:none;" alt="ICICI Bank"/></div></td>
<td>
<div style="display:block; 	float:left;	width:155px;"><img src="http://deal4loans.com/new-images/thumb/ingv.gif" alt="ING Vysya" width="146" height="56"  style="border:none;"/></div></td>
</tr></table>
         

</div>
</div>
</div>
<!--partners-->
<div class="hide-top"><?php include "footer_sub_menu.php"; ?></div>
</body>
</html>
