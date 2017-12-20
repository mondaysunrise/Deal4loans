<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	$Net_Salary = $_SESSION['Net_Salary'];
$City = $_SESSION['City'];
	$maxage=date('Y')-62;
	$minage=date('Y')-18;

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
 <script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script type="text/javascript" src="scripts/mootools.js"></script>
 <script type="text/javascript" src="ajax.js"></script>
<script type="text/javascript" src="ajax-dynamic-stages.js"></script>
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
		var ni = document.getElementById('myDivLoan');
		
		if(ni.innerHTML=="")
		{
		
			
				ni.innerHTML = '<table width="100%" border="0" align="left" cellpadding="0" cellspacing="0"><tr><td width="240"  height="20" align="left" class="bldtxt">Any type of loan(s) running? </td><td colspan="3" align="left"  style="color:#000000;" ><table width="100%" border="0" align="left" cellpadding="0" cellspacing="0"  style="color:#000000;"><tr> <td    height="20" align="left" ><input type="checkbox" style="border:none;" id="Loan_Any" name="Loan_Any[]"  value="hl" /> Home</td><td align="left"><input type="checkbox" style="border:none;"  id="Loan_Any" name="Loan_Any[]" value="pl" /> Personal</td><td align="left">&nbsp;</td></tr><tr> <td  width="71" height="20" align="left" ><input type="checkbox" style="border:none;"  name="Loan_Any[]"  id="Loan_Any" value="cl" /> Car</td><td width="93" align="left"  ><input type="checkbox" style="border:none;" name="Loan_Any[]" id="Loan_Any"  value="lap" /> Property</td><td width="160" align="left"  ><input type="checkbox" style="border:none;" name="Loan_Any[]" id="Loan_Any"  value="other" /> Other</td></tr></table></td></tr><tr><td align="left" height="30" class="bldtxt">How many EMI paid?  </td> <td colspan="3"  align="left" width="324"><select name="EMI_Paid" style="width:203px;"  > <option value="0">Please select</option><option value="1">Less than 6 months</option> <option value="2">6 to 9 months</option> <option value="3">9 to 12 months</option> <option value="4">more than 12 months</option ></select></td></tr></table>';
			
		}
		
		return true;
}

function removeElementLoan()
{
		var ni = document.getElementById('myDivLoan');
		
		if(ni.innerHTML!="")
		{
		
			
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '';
				
			
		}
		
		return true;

	}

	function submitform(Form)
	{
	
		var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
		var dt,mdate;dt=new Date();
		var alpha=/^[a-zA-Z\ ]*$/;
		var alphanum=/^[a-zA-Z0-9]*$/;
		var num=/^[0-9]*$/;
		var space=/^[\ ]*$/;
		var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";
		var myOption;
		var btn2;
		var btn3;
		var myOption1;
		var i;
		var incpf;
	
		if((space.test(Form.day.value)) || (Form.day.value=="dd"))
		{
			alert("Kindly enter your Date of Birth");
			Form.day.select();
			return false;
		}
		
		else if(!num.test(Form.day.value))
		{
			alert("Kindly enter your Date of Birth(numbers Only)");
			Form.day.select();
			return false;
		}
		
		else if((Form.day.value<1) || (Form.day.value>31))
		{
			alert("Kindly Enter your valid Date of Birth(Range 1-31)");
			Form.day.select();
			return false;
		}
		
		else if((space.test(Form.month.value)) || (Form.month.value=="mm"))
		{
			alert("Kindly enter your Month of Birth");
			Form.month.select();
			return false;
		}
		else if(!num.test(Form.month.value))
		{
			alert("Kindly enter your Month of Birth(numbers Only)");
			Form.month.select();
			return false;
		}
		else if((Form.month.value<1) || (Form.month.value>12))
		{
			alert("Kindly Enter your valid Month of Birth(Range 1-12)");
			Form.month.select();
			return false;
		}
		else if((Form.month.value==2) && (Form.day.value>29))
		{
			alert("Month February cannot have more than 29 days");
			Form.day.select();
			return false;
		}
		else if((space.test(Form.year.value)) || (Form.year.value=="yyyy"))
		{
			alert("Kindly enter your Year of Birth");
			Form.year.select();
			return false;
		}
		else if(!num.test(Form.year.value))
		{
			alert("Kindly enter your Year of Birth(numbers Only) !");
			Form.year.select();
			return false;
		}
		else if((Form.day.value > 28) && (parseInt(Form.month.value)==2) && ((Form.year.value%4) != 0))
		{
			alert("February cannot have more than 28 days.");
			Form.day.select();
			return false;
		}
		
		else if(Form.year.value.length != 4)
		{
		alert("Kindly enter your correct 4 digit Year of Birth.(Numeric ONLY)!");
		Form.year.select();
		return false;
		}
		else if((Form.year.value < "<?php echo $maxage;?>") || (Form.year.value >"<?php echo $minage;?>"))
		{
		alert("Age Criteria! \n Applicants between age group 18 - 62 only are elgibile.");
		Form.year.select();
		return false;
		}
		else if(Form.year.value > parseInt(mdate-21) || Form.year.value < parseInt(mdate-62))
		{
		alert("Age Criteria! \n Applicants between age group 21 - 62 only are elgibile.");
		Form.year.select();
		return false;
		}
		else if((parseInt(Form.day.value)==31) && ((parseInt(Form.month.value)==4)||(parseInt(Form.month.value)==6)||(parseInt(Form.month.value)==9)||(parseInt(Form.month.value)==11)||(parseInt(Form.month.value)==2)))
		{
		alert("Cannot have 31st Day");Form.day.select();
		return false;
		}
		
		<?php
		if($City=="Others")
		{
		?>
		if(Form.City_Other.value=='')
		{
			alert("Kindly fill in your other City!");
			Form.City_Other.focus();
			return false;
		}
		<?php
		}
		?>
		
		
		if((Form.Pincode.value=='PinCode') || (Form.Pincode.value==''))
		{
		alert("Kindly fill in your Pincode!");
		Form.Pincode.focus();
		return false;
		}
		else if(Form.Pincode.value.length < 6)
		{
		alert("Kindly fill in your Pincode(6 Digits)!");
		Form.Pincode.focus();
		return false;
		}
		
		
		if((Form.Company_Name.value=="") || (Form.Company_Name.value=="Company Name"))
		{
		alert("Kindly fill in your Company Name!");
		Form.Company_Name.focus();
		return false;
		}
		else if(Form.Company_Name.value.length < 3)
		{
		alert("Kindly fill in your Company Name!");
		Form.Company_Name.focus();
		return false;
		}

		 if((Form.Loan_Amount.value=='')||(Form.Loan_Amount.value=="Loan Amount"))
{
alert("Kindly fill in your Loan Amount (Numeric Only)!");
Form.Loan_Amount.focus();
return false;
}
else if(containsalph(Form.Loan_Amount.value)==true)
{
alert("Loan Amount contains characters!");
Form.Loan_Amount.focus();
return false;
}

myOption = -1;
		for (i=Form.CC_Holder.length-1; i > -1; i--) {
			if(Form.CC_Holder[i].checked) {
				if(i==0)
				{
				if (Form.Card_Vintage.selectedIndex==0)
				{
						alert("Please select since how long you holding credit card");
						Form.Card_Vintage.focus();
						return false;
				}
				}
					myOption = i;
				}
		}
	
		if (myOption == -1) 
		{
			alert("Please select you are credit card holder or not");
			return false;
		}

	
	if(Form.Primary_Acc.value=="")
		{

			alert("Please fill your Salary Account.");
			Form.Primary_Acc.focus();
			return false;
		}
if(Form.Residential_Status.selectedIndex==0)
{
	alert("Please enter Residential Status to Continue");
	Form.Residential_Status.focus();
	return false;
}
	if(Form.Company_Type.selectedIndex==0)
{
	alert("Please enter Company Type to Continue");
	Form.Company_Type.focus();
	return false;
}
	if (Form.Years_In_Company.value=="")
	{
		alert("Please enter Years in Company.");
		Form.Years_In_Company.focus();
		return false;

	}	
	if(!checkNum(Form.Years_In_Company, 'No of years in current company',0))
		return false;

	if (Form.Total_Experience.value=="")
	{
		alert("Please enter Total Experience.");
		Form.Total_Experience.focus();
		return false;
	}	
	if(!checkNum(Form.Total_Experience, 'Total Experience',0))
		return false;

	myOption1 = -1;
		for (i=Form.LoanAny.length-1; i > -1; i--) {
			if (Form.LoanAny[i].checked) {
				if(i==0)
				{
					btn2=valButtonLoan();
					if(!btn2)
					{
						alert('Type of loan running.');
						return false;
					}
					if(Form.EMI_Paid.selectedIndex==0)
					{
						alert('No of EMI paid.');
						Form.EMI_Paid.focus();
						return false;
					}

				}
				myOption1 = i;
			}
		}
		if(myOption1 == -1) 
		{
			alert("You must select a Loan Any button");
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
function containsalph(param)
{
mystrLen = param.length;
for(i=0;i<mystrLen;i++)
{
if((param.charAt(i)<"0")||(param.charAt(i)>"9"))
{
return true;
}
}
return false;
}
function Trim(strValue) {
var j=strValue.length-1;i=0;
while(strValue.charAt(i++)==' ');
while(strValue.charAt(j--)==' ');
return strValue.substr(--i,++j-i+1);
}


function addElement()
{
		var ni1 = document.getElementById('myDivCC1');
		var ni2 = document.getElementById('myDivCC2');
				//alert(document.loan_form.CC_Holder.value);
				ni1.innerHTML = '<b>Card held since?</b>';
				ni2.innerHTML = '<select class="style4" size="1" name="Card_Vintage" style="width:140px; "><option value="0">Please select</option> <option value="1">Less than 6 months</option>		 <option value="2">6 to 9 months</option> <option value="3">9 to 12 months</option>				<option value="4">more than 12 months</option> </select>';
				ni.innerHTML = '<div  class="form-bg"><span class="form-text"><b>Card held since?</b></span><select class="style4" size="1" name="Card_Vintage" style="width:140px; "><option value="0">Please select</option> <option value="1">Less than 6 months</option>		 <option value="2">6 to 9 months</option> <option value="3">9 to 12 months</option>				<option value="4">more than 12 months</option> </select></div>';
		
		return true;

	}


function removeElement()
{
		var ni1 = document.getElementById('myDivCC1');
		var ni2 = document.getElementById('myDivCC2');
		//alert(document.loan_form.CC_Holder.value);
		ni2.innerHTML = '';
		ni1.innerHTML = '';
		return true;
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

</script>
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

</head>

<body>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td style="padding-left:40px;" >
<div id="logo_sml">
	<img src="new-images/d4l-sml-logo.gif" alt="Deal4loans"  onclick="javascript:location.href='http://www.deal4loans.com/'"/>
</div>
</td></tr>
<tr><td>

<table width="1004"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
	<tr>               
       <td align="center" valign="middle" style="color: #643E02; font-weight:bold; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; ">60% of your application for quote from all Banks is complete.</td>            
      </tr>
	  <tr>
	   <td align="center" >&nbsp;</td>            
      </tr>
	  
      <tr>               
       <td align="center" valign="middle" ><img src="new-images/hl/ajax-loader.gif" width="220" height="19" /></td>            
      </tr>
    </table></td>
  </tr>
  <tr>
    <td valign="top" style="padding-top:4px; "><table width="97%"  border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td valign="top">
   
<table width="650" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="21" height="21" align="left" valign="top"><img src="new-images/pl/lft-tp-curv.gif" width="21" height="21" /></td>
    <td style="border-top:1px solid #d4d4d4 ">&nbsp;</td>
    <td width="21" height="21" align="right" valign="top"><img src="new-images/pl/rgt-tp-curv.gif" width="21" height="21" /></td>
  </tr>
  <tr>
    <td  style="border-left:1px solid #d4d4d4 ">&nbsp;</td>
    <td><form name="personalloan_form"  action="apply-for-plloans-continue.php" method="POST" onsubmit="return submitform(document.personalloan_form); ">
	<input type="hidden" value="<? echo $_SESSION['Temp_LID'];?>" name="leadid" />
	<input type="hidden" name="Net_Salary" id="Net_Salary" value="<? echo $_SESSION['Net_Salary']; ?>">
	<input type="hidden" name="City" id="City" value="<? echo $_SESSION['City']; ?>">
		  <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                     <tr align="center" bgcolor="#f4f4f4">
              <td height="25" colspan="2" class="bldtxt" style="font-size:13px; font-family:Verdana, Arial, Helvetica, sans-serif; "> Personal Loan Quote Request</td>
              </tr>
            <tr>
              <td height="10" colspan="2" ></td>
              </tr>
         <tr align="left">
				  <Td height="26" class="bldtxt">DOB</Td>
				  <Td><input name="day" type="text" id="day" value="dd" style="width:40px; " onBlur="onBlurDefault(this,'dd');"  onFocus="onFocusBlank(this,'dd');" maxlength="2" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);"/> <input name="month" id="month" type="text" value="mm"  style="width:40px; " onBlur="onBlurDefault(this,'mm');"  onFocus="onFocusBlank(this,'mm');" maxlength="2" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);"/> <input name="year" id="year" type="text" value="yyyy"   style="width:47px; " onBlur="onBlurDefault(this,'yyyy');"  onFocus="onFocusBlank(this,'yyyy');" maxlength="4" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);"/></Td>
				  </tr>
                    <?php
			 if($_SESSION['City']=="Others")
			 {
			 ?>
               <tr align="left">
				  <Td height="26" class="bldtxt">Other City </Td>
				  <Td><input name="City_Other" id="City_Other" type="text" style="width:140px; " /></Td>
				  </tr>
                  <?php
				  }
				  ?>
                  	<tr align="left">
				  <Td height="26" class="bldtxt">Pincode</Td>
				  <Td><input name="Pincode" id="Pincode" type="text"  MAXLENGTH="6" style="width:140px; "  onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" /></Td>
				  </tr>
                  <tr align="left">
				  <Td height="26" class="bldtxt">Company Name </Td>
				  <Td><input name="Company_Name" id="Company_Name" type="text" style="width:140px; " onkeyup="ajax_showOptions(this,'getCountriesByLetters',event, 'http://www.deal4loans.com/ajax-list-plcompanies.php')" /></Td>
				  </tr>
                  <tr align="left">
				  <Td height="26" class="bldtxt">Loan Amount </Td>
				  <Td><input name="Loan_Amount" id="Loan_Amount" type="text"  style="width:140px; " onFocus="this.select();" onChange="intOnly(this);"  onkeyup="intOnly(this);getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');"  onkeydown="getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" onkeypress="intOnly(this); getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" onblur="getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');">
				</Td>
				  </tr>
				  <tr>
				  <td colspan="2" align="left" style="color:#000000;">  <span id='formatedlA' style='font-size:11px; font-weight:bold;color:#000000;font-Family:Verdana; margin-left:10px;'></span><span id='wordloanAmount' style='font-size:11px;
font-weight:bold;color:#000000;font-Family:Verdana;text-transform: capitalize; margin-left:10px; margin-bottom:5px;'></span></td>
				  </tr>
				<tr align="left">
				  <Td height="26" class="bldtxt" >Are you a Credit card holder?</td>
				  <Td class="bldtxt">
<input type="radio"  name="CC_Holder" id="CC_Holder" value="1"  style="border:none;" onclick="addElement();" >
Yes
<input type="radio"  name="CC_Holder" id="CC_Holder" style="border:none;" value="0" onClick="removeElement();">
No</Td>
				  </tr>
				<tr align="left">
                <td  class="bldtxt" id="myDivCC1"> </td>
				  <Td colspan="2" id="myDivCC2" ></Td>
		  </tr>
            <tr>
              <td width="234" height="35" align="left" class="bldtxt">Primary Account 
                in which bank?  </td>
              <td width="313" height="20"  align="left"><input type="text" style="width:200px;" name="Primary_Acc" id="Primary_Acc" onkeyup="ajax_showOptions(this,'getCountriesByLetters',event,'http://www.deal4loans.com/ajax-list-bankname.php'); " ></td>
            </tr>
            <tr>
              <td height="20" align="left" class="bldtxt">Residential Status </td>
              <td  align="left" ><select name="Residential_Status" id="Residential_Status" style="width: 203px;">
		 <?php
         if($Net_Salary<=239000)
		{
         ?>
         
          <option value="0">Please Select</option>
		  	<option value="4">Owned By Self/Spouse</option>
			<option value="1">Owned By Parent/Sibling</option>
			<option value="3">Company Provided</option>
			<option value="5">Rented - With Family</option>
			<option value="6">Rented - With Friends</option>
			<option value="2">Rented - Staying Alone</option>
			<option value="7">Paying Guest</option>
			<option value="8">Hostel</option>
		<?php
		}
		else
		{
		?>
        <option value="0">Please Select</option>
        			<option value="1">Owned</option>
			<option value="2">Rented</option>
			<option value="3">Company Provided</option>
        <?php
		}
		?>
        	</select></td>
            </tr>
			<tr>
                <td height="35" class="bldtxt">Company Type</td>
          <td class="frmtxt"><select name="Company_Type" id="Company_Type" style="width: 203px;">
		  <option value="0">Please Select</option>
		  	<option value="1">Pvt Ltd</option>
			<option value="2">MNC Pvt Ltd</option>
			<option value="3">Limited</option>

			 <option value="4">Govt.( Central/State )</option>
		<option value="5">PSU (Public sector Undertaking)</option>
			</select></td>
        </tr>  
            <tr>
              <td height="35" align="left" class="bldtxt" >No. of years in  
                this Company</td>
              <td align="left" ><input type="text" name="Years_In_Company" style="width:200px;" maxlength="15"></td>
            </tr>
            <tr>
              <td height="42" align="left" class="bldtxt" >Total Experience (Years)/
                Total Years  
                in Business</td>
              <td align="left" ><input style="width:200px;"  name="Total_Experience" onfocus="this.select();">              </td>
            </tr>
             <tr>
              <td height="20" align="left" class="bldtxt">How do you get your Salary? </td>
              <td  align="left" ><select name="Salary_Drawn" id="Salary_Drawn" style="width:200px;" >
			  <option value="">Please Select</option>
<option value="1">By Cash</option>
<option value="2">By Cheque</option>
<option value="3">By Account Transfer</option>

			  </select>
			  
			 </td>
            </tr>
            <tr>
              <td colspan="2"><input type="hidden" value="PersonalLoan" name="type" /></td>
            </tr>
            <? if ($_SESSION['Temp_CC_Holder']==1 || $_SERVER['Temp_CC_Holder']==1)
			{?>
            <tr>
              <td height="30" align="left" class="bldtxt" >Credit Card Limit?</td>
              <td align="left" ><input style="width:200px;" name="Credit_Limit" onchange="intOnly(this);" onkeyup="intOnly(this);" onkeypress="intOnly(this);" onfocus="this.select();">              </td>
            </tr>
            <? } ?>
            <tr>
              <td height="30" align="left" class="bldtxt" >Any Loan running?</td>
              <td align="left" style="color:#000000;" ><input type="radio" style="border:none;"  value="1"  name="LoanAny"  onclick="addElementLoan(); addDiv();" /> Yes &nbsp;  <input size="10" type="radio" style="border:none;" name="LoanAny"  onclick="removeElementLoan();" value="0"> No</td>
            </tr>
            <tr>
              <td colspan="2" id="myDivLoan"></td>
            </tr>
           
            <tr>
              <td  colspan="2" align="left"  >&nbsp;</td>
            </tr>
            <tr>
              <td height="35" colspan="2" align="center"><input type="image" name="Submit"  src="new-images/pl/quote.gif"  style="width:115px; height:29px; border:none; " /></td>
            </tr>
          </table>
		  </form></td>
    <td  style="border-right:1px solid #d4d4d4 ">&nbsp;</td>
  </tr>
  <tr>
    <td width="21" height="21"><img src="new-images/pl/lft-btm-crv.gif" width="21" height="21" /></td>
    <td  style="border-bottom:1px solid #d4d4d4 ">&nbsp;</td>
    <td width="21" height="21"><img src="new-images/pl/rgt-btm-curv.gif" width="21" height="21" /></td>
  </tr>
</table>
</td>
      </tr>
    </table></td>
  </tr>
</table>
</td></tr></table>

</body>
</html>
