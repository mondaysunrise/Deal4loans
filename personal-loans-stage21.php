<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';

$maxage=date('Y')-62;
$minage=date('Y')-18;
$City = $_SESSION['City'];
$nday = $_SESSION['day'];
$nmonth = $_SESSION['month'];
$nyear = $_SESSION['year'];
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
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<link href="css/home-loan-emi-calculator.css" type="text/css" rel="stylesheet"/>
<script type="text/javascript" src="scripts/mainmenu.js"></script>
<link href="css/slider.css" rel="stylesheet" type="text/css" />
 <script src="http://code.jquery.com/jquery-1.8.2.js"></script>
<link rel="stylesheet" href="css/jquery-ui.css" />
<script src="http://code.jquery.com/ui/1.9.1/jquery-ui.js"></script>
<!--<script type="text/javascript" src="js/sprinkle.js"></script>-->
<script type="text/javascript" src="js/easySlider1.5.js"></script>
<script type="text/javascript" src="scripts/common.js"></script>
<script language="JavaScript" type="text/javascript" src="http://www.deal4loans.com/suggest.js"></script>
<script type="text/javascript">
	$(function() {
$("#Primary_Acc").keyup(function(){
	//alert("hello");
 $.post("jquery_bankmaster.php",
  {
    Primary_Acc: $("#Primary_Acc").val()
    },
  function(data,status){
		var temp = new Array();
temp = data.split(",");
//var availableTag = [data];
  $( "#Primary_Acc" ).autocomplete({
            source: temp
        });
  });
});
});

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
	</style>
 <script type="text/javascript" src="http://www.deal4loans.com/ajax.js"></script>
<script type="text/javascript" src="ajax-dynamic-stages.js"></script>
   <script type="text/javascript" src="scripts/mainmenu.js"></script>
   <script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>

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

function othercity1()
{
	if(document.loan_form.City.value=='Others')
		document.loan_form.City_Other.disabled=false;
	else
		document.loan_form.City_Other.disabled=true;
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
<?php
if($City == "Others")
{
?>
	if( ((document.loan_form.City_Other.value=="" || document.loan_form.City_Other.value=="Other City"  ) || !isNaN(document.loan_form.City_Other.value)))
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
<?php
}
?>	
	
	if (document.loan_form.Employment_Status.selectedIndex==0)
	{
		document.getElementById('empStatusVal').innerHTML = "<span  class='hintanchor'>Select Employment Status to Continue!</span>";	
		document.loan_form.Employment_Status.focus();
		return false;
	}
	
	if(document.loan_form.Residential_Status.selectedIndex==0)
	{
		document.getElementById('resiStatusVal').innerHTML = "<span  class='hintanchor'>Enter Residential Status!</span>";	
		document.loan_form.Residential_Status.focus();
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

	if(document.loan_form.Company_Type.selectedIndex==0)
	{
		document.getElementById('companyTypeVal').innerHTML = "<span  class='hintanchor'>Enter Company Type!</span>";	
		document.loan_form.Company_Type.focus();
		return false;
	}
	
	if(document.loan_form.Primary_Acc.value=="" || document.loan_form.Primary_Acc.value=="Type slowly to autofill")
	{
		document.getElementById('primaryAccVal').innerHTML = "<span  class='hintanchor'> Fill Salary Account!</span>";	
		document.loan_form.Primary_Acc.focus();
		return false;
	}

	if (Form.Years_In_Company.value=="")
	{
		document.getElementById('yearsInVal').innerHTML = "<span  class='hintanchor'>Enter Years in Company!</span>";
		Form.Years_In_Company.focus();
		return false;
	}	
	
	if(!checkNum(Form.Years_In_Company, 'No of years in current company',0))
		return false;
		
	if (Form.Total_Experience.value=="")
	{
		document.getElementById('totalExpVal').innerHTML = "<span  class='hintanchor'>Enter Total Experience!</span>";
		Form.Total_Experience.focus();
		return false;
	}	
	if(!checkNum(Form.Total_Experience, 'Total Experience',0))
		return false;

	myOption = -1;
		for (i=Form.CC_Holder.length-1; i > -1; i--) {
			if(Form.CC_Holder[i].checked) {
				if(i==0)
				{
					if (Form.Card_Vintage.selectedIndex==0)
					{
						document.getElementById('vintageVal').innerHTML = "<span  class='hintanchor'>Holding Credit Card Since!</span>";	
						Form.Card_Vintage.focus();
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

	myOption1 = -1;
		for (i=Form.LoanAny.length-1; i > -1; i--) {
			if (Form.LoanAny[i].checked) {
				if(i==0)
				{
					btn2=valButtonLoan();
					if(!btn2)
					{
						document.getElementById('loanTypeVal').innerHTML = "<span  class='hintanchor'>Type of loan running.!</span>";	
						return false;
					}
					if(Form.EMI_Paid.selectedIndex==0)
					{
						document.getElementById('emiPaidVal').innerHTML = "<span  class='hintanchor'>No of EMI paid!</span>";	
						Form.EMI_Paid.focus();
						return false;
					}
					

				}
				myOption1 = i;
			}
		}
		if(myOption1 == -1) 
		{
			document.getElementById('emiPaidVal').innerHTML = "<span  class='hintanchor'>select Loan Any button!</span>";	
			return false;
		}


	if(!document.loan_form.accept.checked)
	{
		document.getElementById('acceptVal').innerHTML = "<span  class='hintanchor'>Accept Terms and Condition!</span>";	

		document.loan_form.accept.focus();
		return false;
	}	
}  

function valButtonLoan() {
    var cnt = -1;
	var i;
    for(i=0; i<document.loan_form.Loan_Any.length; i++) 
	{
        if(document.loan_form.Loan_Any[i].checked)
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

function addElementLoan()
{
	var ni = document.getElementById('myDivLoan');
	var ni1 = document.getElementById('myDivLoan1');
	
	if(ni.innerHTML=="")
	{
		ni.innerHTML = '<div style=" float:left; width:183px; height:45px; margin-left:0px; margin-top:5px;"><div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:11px; text-transform:none;">How many EMI paid?:</div><div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;"><select name="EMI_Paid" id="EMI_Paid" onchange="validateDiv(\'emiPaidVal\');" style="width:180px; height:22px; font-family:Verdana, Geneva, sans-serif; font-size:11px; color:#4c4c4c;" > <option value="0">Please select</option><option value="1">Less than 6 months</option> <option value="2">6 to 9 months</option> <option value="3">9 to 12 months</option> <option value="4">more than 12 months</option ></select><div id="emiPaidVal"></div>   </div></div>';	
		
		ni1.innerHTML = '<table width="100%" border="0" align="left" cellpadding="0" cellspacing="0"><tr><td colspan="3" align="left" class="text" style="float:left; width:180px; height:auto; color:#FFF; font-size:11px; text-transform:none; margin-top:5px;" >Any type of loan(s) running?</td></tr><tr><td colspan="3" align="left"  style="color:#ffffff;" ><table width="183" border="0" align="left" cellpadding="0" cellspacing="0"  style="color:height:auto; color:#FFF; font-size:11px; text-transform:none;" class="text"><tr> <td width="136"    height="20" align="left" ><input type="checkbox" style="border:none;" id="Loan_Any" name="Loan_Any[]"  value="hl" /> Home</td><td width="169" align="left"><input type="checkbox" style="border:none;"  id="Loan_Any" name="Loan_Any[]" value="pl" /> Personal</td><td width="106" align="left"><input type="checkbox" style="border:none;"  name="Loan_Any"  id="Loan_Any" value="cl" />Car</td></tr><tr><td  align="left" colspan="3" ><input type="checkbox" style="border:none;" name="Loan_Any[]" id="Loan_Any"  value="lap" /> Property&nbsp;&nbsp;&nbsp;<input type="checkbox" style="border:none;" name="Loan_Any[]" id="Loan_Any"  value="other" /> Other</td></tr></table></td></tr></table><div id="loanTypeVal"></div>';	
	}
	return true;
}

function removeElementLoan()
{
		var ni = document.getElementById('myDivLoan');
		var ni1 = document.getElementById('myDivLoan1');
	
		ni.innerHTML = '';
		ni1.innerHTML = '';		
		return true;

	}



function validateDiv(div)
{

	var ni1 = document.getElementById(div);
	ni1.innerHTML = '';
}


function change_empstst()
{
	var occpdiv = document.getElementById('chnge_empstst');
	var myDivLoanpd = document.getElementById('myDivLoanpd');
	
	var occupation = document.loan_form.Employment_Status.value;
	
	if(occupation==0)
	{
	occpdiv.innerHTML = '<div style=" float:left; width:183px; height:45px; margin-left:0px; margin-top:5px;">                    <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;"><span class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Annual Turnover: </span></div>                  <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;">                  <select name="Annual_Turnover" id="Annual_Turnover" style="width:180px; height:22px; font-family:Verdana, Geneva, sans-serif; font-size:11px; color:#4c4c4c;">		<option value="">Please Select</option>	<option value="1" > 0 To 40 Lacs</option>	<option value="4" > 40 Lacs To 1 Cr</option>		<option value="2" > 1Cr - 3Crs </option>	<option value="3" >3Crs & above</option></select>                      <div id="annualTurnoverVal"></div>                    </div>                </div>';
myDivLoanpd.innerHTML ='<div style=" float:left; width:183px; height:45px; margin-left:0px; margin-top:5px;">                    <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;"><span class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Professional details: </span></div>                  <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;">                  <select name="professional_details" id="professional_details" style="width:180px; height:22px; font-family:Verdana, Geneva, sans-serif; font-size:11px; color:#4c4c4c;">		 <option value="0">Please Select</option>		  	<option value="1">Businessmen</option>			<option value="2">Doctor</option>			<option value="3">Engineer</option>			 <option value="4">Architect</option>		<option value="5">Chartered Accountant</option></select>                      <div id="annualTurnoverVal"></div>                    </div>                </div>';
	
	}
	else
	{
	occpdiv.innerHTML = '<div style=" float:left; width:183px; height:45px; margin-left:0px; margin-top:5px;">                    <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;"><span class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Company Name: </span></div>                  <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;">                   <input name="Company_Name" id="Company_Name" type="text"  style="width:180px; height:16px;" onblur="onBlurDefault(this,\'Type slowly to autofill\');" onkeyup="ajax_showOptions(this,\'getCountriesByLetters\',event, \'http://www.deal4loans.com/ajax-list-plcompanies.php\')" onfocus="onFocusBlank(this,\'Type slowly to autofill\');" onkeydown="validateDiv(\'companyNameVal\');" value="Type slowly to autofill" tabindex=11/>                        <div id="companyNameVal"></div>                    </div>                </div>';

	myDivLoanpd.innerHTML="";
				}
				
}
  </script>
  <link href="source.css" rel="stylesheet" type="text/css" />
   
</head>

<body>
<div class="hide_top_menu">
<?php include "top-menu.php"; ?>
<?php include "main-menu.php"; ?>
</div>
<div class="hl_emi_cal_wrapper">
<div class="hl_emi_logo_box"><img src="images/logo.gif" /></div>
<div style="clear:both;"></div>

<div class="text12" style="margin:auto; width:97%; height:11px; margin-top:11px; color:#0a8bd9;"><u><a href="index.php" class="text12" style="color:#0080d6;" >Home</a></u> > <a href="personal-loans.php"  class="text12" style="color:#0080d6;"><u>Personal Loan</u></a> <a href="#"  class="text12" style="color:#4c4c4c;">> Apply for Personal Loan</a></div>
<div class="intrl_txt" style="margin:auto;">
<div style="clear:both; height:10px;"></div>

<div></div>

<div style="clear:both;"></div>
<div class="hl_emi_cal_form">
  <div class="pl_emi_cal_text"><h2 class="text3" style=" color:#FFF; font-size:16px; text-transform:none;"><strong><span style="color:#8dae48;">Step 2</span> - To get  online quotes from all Banks-Please Input further details</strong></h2></div>

<div class="pl_emi_cal_blink_b"></div>
<div style="clear:both;"></div><form name="loan_form" method="post" action="insert_personal_loan_stage2.php" onSubmit="return chkpersonalloan();">
        <input type="hidden" value="<? echo $_SESSION['Temp_LID'];?>" name="leadid" /> 
  <div class="hl_emi_input_form">
    <table width="98%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td height="30"><span class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">DOB:</span></td>
      </tr>
      <tr>
        <td height="30"><input name="day" id="day" type="text" class="hl_emi_dd" value="<? if(strlen($nday)>0) {echo $nday;} else { echo "dd"; }?>" onblur="onBlurDefault(this,'dd');" onfocus="onFocusBlank(this,'dd');" maxlength="2" onkeyup="intOnly(this);" onkeypress="intOnly(this);" onkeydown="validateDiv('dobVal');" />
        <input name="month" id="month" type="text" class="hl_emi_dd" value="<? if(strlen($nmonth)>0) {echo $nmonth;} else { echo "mm"; }?>" onblur="onBlurDefault(this,'mm');" onfocus="onFocusBlank(this,'mm');" maxlength="2" onkeyup="intOnly(this);" onkeypress="intOnly(this);" onkeydown="validateDiv('dobVal');" />
        <input name="year" id="year" type="text"class="hl_emi_yy" value="<? if(strlen($nyear)>0) {echo $nyear;} else { echo "yyyy"; }?>" onblur="onBlurDefault(this,'yyyy');" onfocus="onFocusBlank(this,'yyyy');" maxlength="4" onkeyup="intOnly(this);" onkeypress="intOnly(this);" onkeydown="validateDiv('dobVal');" />
        <div id="dobVal"></div>   
        
        </td>
      </tr>
    </table>
  </div>
    <div class="hl_emi_input_form">
      <table width="98%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td height="30"><span class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Occupation: </span></td>
        </tr>
        <tr>
          <td height="30">   <select name="Employment_Status" id="Employment_Status"  onchange="change_empstst(); validateDiv('empStatusVal');"   class="hl_emi_select"  style=" font-family:Verdana, Geneva, sans-serif; font-size:11px; color:#4c4c4c;" >
                           <option value="-1">Please Select</option>
                           <option value="1">Salaried</option>
                           <option value="0">Self Employed</option>
                     </select>
                       <div id="empStatusVal"></div> </td>
        </tr>
      </table>
    </div>
      <div class="hl_emi_input_form">
        <table width="98%" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td height="30"><span class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Company Type :</span></td>
          </tr>
          <tr>
            <td height="30"><select name="Company_Type" id="Company_Type" class="hl_emi_select"  style=" font-family:Verdana, Geneva, sans-serif; font-size:11px; color:#4c4c4c;">
		  <option value="0">Please Select</option>
		  	<option value="1">Pvt Ltd</option>
			<option value="2">MNC Pvt Ltd</option>
			<option value="3">Limited</option>
			 <option value="4">Govt.( Central/State )</option>
		<option value="5">PSU (Public sector Undertaking)</option>
			</select>
         <div id="companyTypeVal"></div></td>
          </tr>
        </table>
      </div>
        <div class="hl_emi_input_form">
          <table width="98%" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="100%" height="30"><span class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">No. of years in this Company:</span></td>
            </tr>
            <tr>
              <td height="30">  <input  name="Years_In_Company"  id="Years_In_Company" maxlength="10"   onkeyup="intOnly(this);" onkeypress="intOnly(this);" type="text" class="hl_emi_input" onkeydown="validateDiv('propertyValueVal');"  tabindex="6" />
         <div id="propertyValueVal"></div>    </td>
            </tr>
          </table>
        </div>
                <div style="clear:both;"></div>
                <div class="hl_emi_input_form_b">
                  <table width="100%" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td height="30"><table width="98%" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                          <td height="30"><span class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Pincode:</span></td>
                        </tr>
                        <tr>
                          <td height="30"><input name="Pincode" id="Pincode" maxlength="6" onkeypress="intOnly(this);" onkeyup="intOnly(this);"  onkeydown="validateDiv('pincodeVal');" type="text" class="hl_emi_input" />
         <div id="pincodeVal"></div></td>
                        </tr>
                      </table></td>
                    </tr>
                  </table>
                </div>
                  <div class="hl_emi_input_form_b">
                    <table width="100%" border="0" cellpadding="0" cellspacing="0">
                      <tr>
                        <td height="30"><table width="98%" border="0" cellpadding="0" cellspacing="0">
                          <tr>
                            <td height="30"><span class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Residential Status :</span></td>
                          </tr>
                          <tr>
                            <td height="30"><select name="Residential_Status" id="Residential_Status" onchange="validateDiv('resiStatusVal');"  class="hl_emi_select"   style="font-family:Verdana, Geneva, sans-serif; font-size:11px; color:#4c4c4c;">
		  <option value="0">Please Select</option>
			<option value="1">Owned</option>
			<option value="2">Rented</option>
			<option value="3">Company Provided</option>
			</select>
         <div id="resiStatusVal"></div></td>
                          </tr>
                        </table></td>
                      </tr>
                    </table>
                  </div>
                  <div class="hl_emi_input_form_b">
                    <table width="100%" border="0" cellpadding="0" cellspacing="0">
                      <tr>
                        <td height="30"><table width="98%" border="0" cellpadding="0" cellspacing="0">
                          <tr>
                            <td height="30"><span class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:11px; text-transform:none;">Primary Account in which bank? </span></td>
                          </tr>
                          <tr>
                            <td height="30"><input type="text"  class="hl_emi_input" name="Primary_Acc" id="Primary_Acc" onblur="onBlurDefault(this,'Type slowly to autofill');" onfocus="onFocusBlank(this,'Type slowly to autofill');" value="Type slowly to autofill">
         <div id="primaryAccVal"></div></td>
                          </tr>
                        </table></td>
                      </tr>
                    </table>
      </div>
                  
                  <div class="hl_emi_input_form_b">
                    <table width="98%" border="0" cellpadding="0" cellspacing="0">
                      <tr>
                        <td height="25"><span class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Total Experience (Years)/Total Years in Business :</span></td>
                      </tr>
                      <tr>
                        <td height="25" ><input class="hl_emi_input"  name="Total_Experience" onfocus="this.select();"> 
         <div id="totalExpVal"></div></td>
                      </tr>
                    </table>
                  </div>
                        <div style="clear:both;"></div><div style=" " id="divfaq1">
   <div class="hl_emi_input_form_b">
    <?php 
				  if($City=="Others")
                  { 
                  ?>
     <table width="99%" border="0" cellpadding="0" cellspacing="5">
       <tr>
         <td height="25"><div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Other City:</div></td>
       </tr>
       <tr>
         <td> <input name="City_Other" id="City_Other" type="text" class="hl_emi_input"  onKeyUp="searchSuggest();" onkeydown="validateDiv('othercityVal');"  />
                  
                                  <div id="othercityVal"></div></td>
       </tr>
     </table>
       <?php }
                  ?>
   </div>
   
   <div class="hl_emi_input_form_b"><div id="chnge_empstst">
     <table width="100%" border="0" cellpadding="0" cellspacing="5">
       <tr>
         <td height="25"><span class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Company Name: </span></td>
       </tr>
       <tr>
         <td align="left"> <input name="Company_Name" id="Company_Name" type="text"  class="hl_emi_input"   onblur="onBlurDefault(this,'Type slowly to autofill');" onkeyup="ajax_showOptions(this,'getCountriesByLetters',event, 'http://www.deal4loans.com/ajax-list-plcompanies.php')" onfocus="onFocusBlank(this,'Type slowly to autofill');" onkeydown="validateDiv('companyNameVal');"  value="Type slowly to autofill"/>
              <div id="companyNameVal"></div></td>
       </tr>
     </table></div>
   </div>
   
   <div class="hli_input_section">
     <table width="99%" border="0" cellpadding="0" cellspacing="5">
       <tr>
         <td height="25"><span class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Any Loan running?:</span></td>
       </tr>
       <tr>
         <td class="text" style=" color:#FFF; font-size:12px;"><input type="radio" style="border:none;"  value="1"  name="LoanAny"  onclick="addElementLoan(); addDiv();"  />
           Yes  <input size="10" type="radio" style="border:none;" name="LoanAny"  onclick="removeElementLoan();" value="0" checked > No</td>
       </tr>
       </table>
   </div>
   <div class="hli_input_section">
     <table width="99%" border="0" cellpadding="0" cellspacing="5">
       <tr>
         <td width="47%"><span class="text" style="color:#FFF; font-size:12px; text-transform:none;">Credit Card:</span></td>
         <td width="53%" class="text" style="color:#FFF; font-size:12px; text-transform:none;">  <input type="radio" name="CC_Holder" id="CC_Holder" value="1" onclick="return addIdentified();" style="border:none;" /> 
         Yes   <input size="10" type="radio" style="border:none;" name="CC_Holder"  onclick="removeIdentified();" value="0" checked > 
         No</td>
       </tr>
       <tr>
         <td colspan="2" id="myDiv1">&nbsp;</td>
       </tr>
     </table>
   </div>
     </div><div style="clear:both;"></div>
  <div class="hli_input_section">
      <div id="myDivLoan" ></div>
      </div>
        <div class="hli_input_section">
              <div id="myDivLoan1"  ></div>
      </div>
       <div class="hli_input_section">
              <div id="myDivLoanpd"  ></div>
      </div>
      <div style="clear:both;"></div>
      <div class="hl_emi_get_quote"><input type="submit" style="border: 0px none ; background-image: url(images/get1.gif); width: 114px; height: 52px; margin-bottom: 0px;" value=""/></div></form></div>
  
  </div></td></tr></table>
    </div>

<div style="clear:both; height:4px;"></div>
<!--partners-->
<div class="text" style="margin:auto; width:960px; height:auto; margin-top:2px; color:#8dae48;"  id="hide_text"><b>Quotes available from following Banks</b></div>
<div  class="hide_top_menu">
<div  style="margin:auto; width:949px; height:85px; margin-top:3px;">

<div class="sldrpnl" style="margin:auto;" >
	<div id="slider" >
		<ul>				
			        <li style="width:800px;	height:136px;	overflow:hidden;">
<div style="display:block; 	float:left;	width:145px;"><img  src="new-images/pl/icici_lgo.jpg" alt="ICICI Bank" width="100" height="30"  style="border:none;"/></div>
<div style="display:block; 	float:left;	width:165px;"><img src="http://deal4loans.com/new-images/slider/thumb/hdfc.jpg" alt="HDFC Bank" width="138" height="39"  style="border:none;"/></div>
<div style="display:block; 	float:left;	width:235px;"><img src="http://deal4loans.com/new-images/slider/thumb/bajaj-finserv.jpg" alt="Bajaj Finserv" width="221" height="39"  style="border:none;"/></div>

<div style="display:block; 	float:left;	width:210px;"><img src="http://deal4loans.com/new-images/slider/thumb/hdbfs_logo.jpg" alt="HDB Financial Services" width="200" height="36"  style="border:none;"/></div>

            </li>
            <li>
<div style="display:block; 	float:left;	width:145px;"><img  src="http://deal4loans.com/new-images/slider/thumb/partner_fullerton.gif" alt="Fullerton India" width="124" height="36"  style="border:none;"/></div>
<div style="display:block; 	float:left;	width:165px;"> <img src="http://deal4loans.com/new-images/slider/thumb/hdfc.jpg" alt="HDFC Bank" width="138" height="39"  style="border:none;"/></div>
<div style="display:block; 	float:left;	width:235px;"><img src="http://deal4loans.com/new-images/slider/thumb/bajaj-finserv.jpg" alt="Bajaj Finserv" width="221" height="39"  style="border:none;"/></div>
<div style="display:block; 	float:left;	width:150px;"><img src="http://deal4loans.com/new-images/slider/thumb/stan-chat.jpg" alt="Standard Chartered" width="133" height="45"  style="border:none;"/></div>

            </li>
		</ul>
	</div>
    </div>
</div>
</div>
</div>
<!--partners-->
<div class="hide_top_menu"><?php include "footer1.php"; ?></div>

</body>
</html>
