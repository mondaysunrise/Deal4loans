<?php
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
$cityList = 
'Agra,Ahmedabad,Surat,Vadodara,Gwalior,Vidisha,Hoshangabad,Itarsi,Ambala,Shimla,Chandigarh,Mandi,Patiala,Baddi,Mohali,Trivandrum,Kochi,Thrissur,Coimbatore,Erode,Ooty,Salem,Namakkal,Udumalpet,Rishikesh,Haridwar,Jamshedpur,Siliguri,Cuttack,Bhubaneshwar,Indore,Bhopal,Ujjain,Dewas,Ratlam,Mandsour,Neemuch,Jabalpur,Katni,Satna,Rewa,Singrauli,Jaipur,Ajmer,Alwar,Jodhpur,Bikaner,Pali,Ganganagar,Sonepat,Bahadhurgarh,Kurukshetra,Hisar,Kanpur,Jhansi,Lucknow,Meerut,Agra,Madurai,Tirunelveli,Nagercoil,Tuticorin,Rajapalayam,Sivakasi,Palani,Ramanathapuram,Nagpur,Nasik,Goa,Panaji,Margao,Vasco,Mapusa,Ponda,Bathinda,Ropar,Ludhiana,Jalandhar,Jammu,Pathankot,Amritsar,Hoshiarpur,Phagwara,Raipur,Rajnandgaon,Bilaspur,Durg,Raigarh,Korba,Rajkot,Ongole,Nellore,Tirupathi,Khammam,Kurnool,Ananthpur,Chittor,Kothagudem,Trichy,Thanjavur,Dindigul,Karur,Kumbakonam,Pudukottai,Tanjore,Karaikudi,Pattukottai,Mayiladuthurai,Udaipur,Bhilwara,Beawar,Banswara,Vellore,Pondicherry,Karaikkal,Kanchipuram,Krishnagiri,Vaniyambadi,Panruti,Tiruvannamalai,Guntur,Eluru,Vijayawada,Bhimavaram,Tenali,Machilipatnam,Tanuku,Palacollu,Rajahmundry,Srikakulam,Vizianagaram,Kakinada,Vizag,Anakapalli,Pitapuram,Tuni,Warangal,Nizamabad,Karimnagar,Ramagundam,Mahaboob Nagar,Armoor,Kodad,Aurangabad,Kolhapur,Ahmednagar,Solapur,Nanded,Latur,Parbhani,Satara,Chandrapur,Ratnagiri,Sangli,Jalna,Amravati,Beed,Nandurbar,Wardha,Akot,Greater Noida,Faridabad,Sahibabad,Dehradun,Rudhrapur,Saharanpur,Kishangarh,Haldwani,Firozabad,Mysore,Hubli,Hosur,Udipi,Mangalore,Belgaum,Hospet,Rishikesh';
$city_List = explode(",", $cityList);
sort($city_List);

$metrosCityList = "Bangalore,Chennai,Delhi,Gaziabad,Gurgaon,Hyderabad,Kolkata,Mumbai,Navi Mumbai,Noida,Pune,Thane";
$metrosCity_List = explode(",", $metrosCityList);
sort($metrosCity_List);


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ICICI Personal Loan| Eligibility | Documents | Apply</title>
<meta name="keywords" content="ICICI Bank Personal Loans, ICICI Bank Loans,
ICICI Bank Personal Loans Eligibility, ICICI Bank Personal Loans documents,
Apply ICICI Bank Personal Loan">
<meta name="description" content="Apply for Personal loans at ICICI Bank.
Get Lowest Interest Rates and Best Deals with ICICI Bank Loans At Delhi,
Mumbai, Bangalore, Kolkata, Chennai, Ahmedabad, Pune, Thane, Surat, Baroda
etc ">

<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script src='scripts/digitToWordConverting.js' type='text/javascript' language='javascript'></script>
<script type="text/javascript" src="ajax.js"></script>
<script type="text/javascript" src="ajax-dynamic-icicicompanies.js"></script>
<style>
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
		z-index:100;
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
		position:absolute;
		z-index:5;
	}
	
	
.formfield
{
font-family:Arial, Helvetica, sans-serif;
font-size:13px;
color:#FFFFFF;
margin-top:4px;
}
.w175{width: 175px;}
.w230{width: 230px;}
</style>


<style type="text/css">input{	margin:0px;	padding:0px;	border:1px solid #878787;}select{	margin:0px;	padding:0px;	border:1px solid #878787;}#txt{	font-family:Verdana, Arial, Helvetica, sans-serif;	font-size:11px;  	padding-left:25px;	line-height:21px;	padding-top:8px;} .btmboxbg{	background-image:url(images/btm-box.jpg);	width:273px;	height:131px;	background-repeat:no-repeat;	background-position:center;}.redtxt{	font-family:Verdana, Arial, Helvetica, sans-serif;	font-size:12px;	font-weight:bold;	color:#8b321b;}.blktxt{	font-family:Verdana, Arial, Helvetica, sans-serif;	font-size:11px;	text-align:left;	line-height:16px;	padding-top:6px;}.frmhdng{	font-family:Arial, Helvetica, sans-serif;	font-size:17px;	font-weight:bold;	color:#802891;}.frmbg{ 	border-left:1px solid #c2c2c2;	border-bottom:1px solid #c2c2c2;}.frmtxt{	font-family:Verdana, Arial, Helvetica, sans-serif;	font-size:11px;	font-weight:bold;	color:#332d33;}.frmrgtbrdr{	border-bottom:22px solid #802891;	background-color:#fecb09;}/* START CSS NEEDED ONLY IN DEMO */	 </style>

<script language="javascript">

function addCompany()
{
		var ni = document.getElementById('comp_1');
		
		if(document.loan_form.Employment_Status.value=="1")
		{
			ni.innerHTML = '<table width="100%" border="0" align="left" cellpadding="3" cellspacing="3"><tr><td width="210" height="26" align="left" class="frmtxt">Company Name</td>	<td width="8" align="center" class="frmtxt">&nbsp;</td>	<td width="182" align="left" ><input name="company_name" id="company_name" type="text" tabindex="10"   style=" width:140px;  height:21px;"  onblur="onBlurDefault(this,\'Company Name\');" onKeyUp="ajax_showOptions(this,\'getCountriesByLetters\',event)" onfocus="onFocusBlank(this,\'Company Name\');" /></td></tr><tr><td width="210" height="26" align="left" class="frmtxt"  >Company Type</td>	<td width="8" align="center" class="frmtxt">&nbsp;</td>	<td width="182" align="left" class="frmtxt" style="font-weight:normal;"><select name="Company_Type" id="Company_Type" style="width: 143px; text-align:left;"><option value="0">Please Select</option>		<option value="1">Pvt Ltd</option><option value="2">MNC Pvt Ltd</option><option value="3">Limited</option><option value="4">Govt.( Central/State )</option><option value="5">PSU (Public sector Undertaking)</option> <option value="6">Armed Forces</option></select></td></tr><tr><td width="210" height="26" align="left" class="frmtxt"  >No. of years in this Company</td>	<td width="8" align="center" class="frmtxt">&nbsp;</td>	<td width="182" align="left" class="frmtxt"><select name="Years_Company" id="Years_Company" style="width:60px;"><option value="">Year</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10 & Above</option></select> &nbsp;<select name="Months_Company" id="Months_Company" style="width:60px;"><option value="">Month</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option><option value="11">11</option></select> </td></tr><tr><td width="210" height="26" align="left" class="frmtxt"  >Total Experience</td>	<td width="8" align="center" class="frmtxt">&nbsp;</td><td width="182" align="left" class="frmtxt"><select name="Total_Exp_Year" id="Total_Exp_Year" style="width:60px;"><option value="">Year</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10 & Above</option></select> &nbsp;<select name="Total_Exp_Month" id="Total_Exp_Month" style="width:60px;"><option value="">Month</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option><option value="11">11</option></select></td></tr>   <tr><td width="210" height="26" align="left" class="frmtxt">Monthly Income(Net Take Home)</td>	<td width="8" align="center" class="frmtxt">&nbsp;</td><td width="182" align="left" ><input type="text" name="Net_Salary1" id="Net_Salary1" style="width:140px; height:21px;" onkeyup="intOnly(this); getDigitToWordsMonthlySal(\'Net_Salary1\',\'formatedI\',\'wordIn\');" onkeypress="intOnly(this);"  onblur="getDigitToWordsMonthlySal(\'Net_Salary1\',\'formatedIncome\',\'wordIncome\');"  onchange="ShowHide(\'incomeShow\',\'Net_Salary\');" onmouseout=\'hideTooltip()\' onmouseover=\'showTooltip(event,"This is your net monthly salary as credited in your account after deductions."); return false\' /></td></tr> <tr><td height="26" colspan="3" align="left" class="frmtxt"  ><span id=\'formatedI\' style=\'font-size:11px; font-weight:normal; color:#333333;font-Family:Verdana;\'></span><span id=\'wordIn\' style=\'font-size:11px; font-weight:normal; color:#333333;font-Family:Verdana;text-transform: capitalize;\'></span></td></tr> </table>';	
					
		}
		else if(document.loan_form.Employment_Status.value=="0")
		{
			ni.innerHTML = '<table width="100%" border="0" align="left" cellpadding="3" cellspacing="3"><tr><td width="210"  height="20" align="left" class="bldtxt">Any type of loan(s) running? </td><td width="8" align="center" class="frmtxt">&nbsp;</td><td align="left" ><table width="100%" border="0" align="left" cellpadding="0" cellspacing="0"><tr> <td    height="20" align="left" ><input type="checkbox" style="border:none;" id="Loan_Any" name="Loan_Any[]"  value="hl" /> Home</td><td align="left"><input type="checkbox" style="border:none;"  id="Loan_Any" name="Loan_Any[]" value="pl" /> Personal</td></tr><tr> <td height="20" align="left" ><input type="checkbox" style="border:none;"  name="Loan_Any[]"  id="Loan_Any" value="cl" /> Car</td><td align="left"  ><input type="checkbox" style="border:none;" name="Loan_Any[]" id="Loan_Any"  value="lap" /> Property</td></tr><tr><td align="left" colspan="2" ><input type="checkbox" style="border:none;" name="Loan_Any[]" id="Loan_Any"  value="other" /> Other</td></tr></table></td></tr><tr><td width="210" height="30" align="left" class="bldtxt">How many EMI paid?  </td> <td width="8" align="center" class="frmtxt">&nbsp;</td><td  align="left"  width="182"><select name="EMI_Paid"   > <option value="0">Please select</option><option value="1">Less than 6 months</option> <option value="2">6 to 9 months</option> <option value="3">9 to 12 months</option> <option value="4">more than 12 months</option ></select></td></tr><tr><td width="210" height="30" align="left" class="bldtxt">Total Monthly EMI Obligation</td><td width="8" align="center" class="frmtxt">&nbsp;</td> <td  align="left"  width="182"><input type="text" name="other_emi" style="width:140px; height:21px;" maxlength="15"></td></tr></table>';
		}
		else
		{
			ni.innerHTML = '';
		}
		return true;
}

function addElementLoan()
{
	var ni = document.getElementById('Loan_Running');
	ni.innerHTML = '<table width="100%" border="0" align="left" cellpadding="3" cellspacing="3"><tr><td width="210"  height="20" align="left" class="bldtxt">Any type of loan(s) running? </td><td width="8" align="center" class="frmtxt">&nbsp;</td><td width="182" align="left" ><table width="100%" border="0" align="left" cellpadding="0" cellspacing="0"><tr> <td    height="20" align="left" ><input type="checkbox" style="border:none;" id="Loan_Any" name="Loan_Any[]"  value="hl" /> Home</td><td align="left"><input type="checkbox" style="border:none;"  id="Loan_Any" name="Loan_Any[]" value="pl" /> Personal</td></tr><tr> <td height="20" align="left" ><input type="checkbox" style="border:none;"  name="Loan_Any[]"  id="Loan_Any" value="cl" /> Car</td><td align="left"  ><input type="checkbox" style="border:none;" name="Loan_Any[]" id="Loan_Any"  value="lap" /> Property</td></tr><tr><td align="left" colspan="2" ><input type="checkbox" style="border:none;" name="Loan_Any[]" id="Loan_Any"  value="other" /> Other</td></tr></table></td></tr><tr><td width="210" height="30" align="left" class="bldtxt">How many EMI paid?  </td>   <td width="8" align="center" class="frmtxt">&nbsp;</td><td width="182" align="left"><select name="EMI_Paid"   > <option value="0">Please select</option><option value="1">Less than 6 months</option> <option value="2">6 to 9 months</option> <option value="3">9 to 12 months</option> <option value="4">more than 12 months</option ></select></td></tr><tr><td width="210" height="30" align="left" class="bldtxt">Total Monthly EMI Obligation</td>   <td width="8" align="center" class="frmtxt">&nbsp;</td><td align="left" width="182"><input type="text" name="other_emi" style="width:140px; height:21px;" maxlength="15"></td></tr></table>';
		return true;
}

function removeElementLoan()
{
	var ni = document.getElementById('Loan_Running');		
	ni.innerHTML = '';
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

function addElementER()
{
	var ni = document.getElementById('Loan_ER');
	ni.innerHTML = '<table width="100%" border="0" align="left" cellpadding="0" cellspacing="0"><tr><td align="left" height="30" class="bldtxt" width="210">Type of Relationship</td> <td width="8" align="center" class="frmtxt">&nbsp;</td><td align="left"><select name="relationship" style="width: 140px; " height="21"  > <option value="0">Please select</option><option value="1">Account Holder</option> <option value="2">Existing Loan</option></select></td></tr></table>';
		return true;
}

function removeElementER()
{
	var ni = document.getElementById('Loan_ER');		
	ni.innerHTML = '';
	
}

function addElementCC()
{
	var ni = document.getElementById('Loan_CC');
	ni.innerHTML = '<table width="100%" border="0" align="left" cellpadding="0" cellspacing="0"><tr>    <td align="left" height="30" class="bldtxt" width="210">Total Outstanding Amount</td> <td width="8" align="center" class="frmtxt">&nbsp;</td><td align="left" width="182"><input type="text" name="card_obligation" id="card_obligation" style="width:140px;   height:21px;" ></td></tr></table>';
		return true;
}

function removeElementCC()
{
	var ni = document.getElementById('Loan_CC');		
	ni.innerHTML = '';
	
}

function addElementRS()
{
	var ni = document.getElementById('resi_1');
	if(document.loan_form.Residential_Status.value=="2")
	{
		ni.innerHTML = '<table width="100%" border="0" align="left" cellpadding="0" cellspacing="0"><tr><td align="left" height="30" class="bldtxt" width="210">Years at Current Residence</td> <td width="8" align="center" class="frmtxt">&nbsp;</td><td align="left"  width="182"><select name="Residential_Stability" style="width: 140px; " height="21"  > <option value="0">Please select</option><option value="1"> Less Than One Year</option> <option value="2">1 To 3 Years</option> <option value="3">3 Yrs & Above</option></select></td></tr></table>';
		return true;
	}
	else
	{
		ni.innerHTML = '';
	}
}



</script>

<script language="javascript">
function submitform(Form)
{
	var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
	var dt,mdate;dt=new Date();
	var alpha=/^[a-zA-Z\ ]*$/;
	var alphanum=/^[a-zA-Z0-9]*$/;
	var num=/^[0-9]*$/;
	var space=/^[\ ]*$/;
	var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";

	if(Form.City.selectedIndex==0)
	{
		alert("Please enter City Name to Continue");
		Form.City.focus();
		return false;
	}

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
	else if((parseInt(Form.day.value)==31) && ((parseInt(Form.month.value)==4)||(parseInt(Form.month.value)==6)||(parseInt(Form.month.value)==9)||(parseInt(Form.month.value)==11)||(parseInt(Form.month.value)==2)))
	{
		alert("Cannot have 31st Day");Form.day.select();
		return false;
	}

	if(Form.Loan_Amount.value=='')
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
	if(Form.Loan_Amount.value.charAt(0)=="0")
	{
		alert("Kindly fill in your Loan Amount (Numeric Only)!");
		Form.Loan_Amount.focus();
		return false;
	}


if(Form.Employment_Status.selectedIndex==0)
{
	alert("Please select Employment Status to Continue");
	Form.Employment_Status.focus();
	return false;
}
if(Form.Employment_Status.value==1)
{
	if(Form.company_name.value=="" || Form.company_name.value=="Type slowly for autofill")
	{
		alert("Please Enter Company Name");
		Form.company_name.focus();
		return false;
	}
	if(Form.Company_Type.selectedIndex==0)
	{
		alert("Please select Company Type to Continue");
		Form.Company_Type.focus();
		return false;
	}
	
	if(Form.Years_In_Company.value=='')
	{
		alert("Please enter Years in Current Company to Continue");
		Form.Years_In_Company.focus();
		return false;
	}
	if(Form.Total_Experience.value=='')
	{
		alert("Please enter Total Experience to Continue");
		Form.Total_Experience.focus();
		return false;
	}
	if(Form.Net_Salary1.value=='')
	{
		alert("Please enter Income to Continue");
		Form.Net_Salary1.focus();
		return false;
	}
	if(Form.Net_Salary1.value.charAt(0)=="0")
	{
		alert("Please enter Monthly income to Continue");
		Form.Net_Salary1.focus();
		return false;
	}
}
if(Form.Employment_Status.value==0)
{
	if(Form.business_running.selectedIndex==0)
	{
		alert("Please Enter Business Running Since");
		Form.business_running.focus();
		return false;
	}
	if(Form.Net_Salary1.value=='')
	{
		alert("Please enter Income to Continue");
		Form.Net_Salary1.focus();
		return false;
	}
	if(Form.Net_Salary1.value.charAt(0)=="0")
	{
		alert("Please enter Monthly income to Continue");
		Form.Net_Salary1.focus();
		return false;
	}
	if(Form.Total_Experience.value=='')
	{
		alert("Please enter Total Experience to Continue");
		Form.Total_Experience.focus();
		return false;
	}
}

	if(Form.Residential_Status.selectedIndex==0)
	{
		alert("Please enter Residential Status to Continue");
		Form.Residential_Status.focus();
		return false;
	}
	
	if(Form.Residential_Status.value==2)
	{
		if(Form.Residential_Stability.selectedIndex==0)
		{
			alert("Please select Residential Stability");
			Form.Residential_Stability.focus();
			return false;
		}
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

</script>
</head>
<body bgcolor="#999999" style="font-family:Arial, Helvetica, sans-serif;">

<form name="loan_form" method="post" action="icici-personal-loan-quote.php" onSubmit="return submitform(document.loan_form);" enctype="multipart/form-data">

<table cellpadding="0" cellspacing="0" border="0" align="center" width="960" bgcolor="#FFFFFF">
<tr><td align="center" width="960">
<table cellpadding="2" cellspacing="0" border="0">

<tr><td width="581" align="left"><img src="new-images/icici-pl-logi.jpg" /></td>
<td align="right" valign="bottom"><img src="new-images/poweredby.png" /></td></tr>
<tr><td colspan="2"><img src="new-images/hd1.jpg" width="960" /></td></tr>
<tr><td valign="top" align="left" style="padding-left:5px; font-family:Arial, Helvetica, sans-serif;" ><div  style="padding-left:5px; font-family:Arial, Helvetica, sans-serif;">
  <h2 style="color:#1c4879;" ><u>Personal Loans</u></h2>
</div>
    <div  style="padding-left:5px; font-family:Arial, Helvetica, sans-serif;">
      <p>Thinking of renovating your house? Yearning to buy a new laptop? Need   financial assistance for marriage-related expenses or for your child's   higher education? An ICICI Bank Personal Loan is your one-stop-shop for   fulfilling all your financial aspirations!</p><br />
      <h2 style="color:#1c4879; font-size:16px;"><u>Key Benefits</u></h2>

      <ul>
        <li>
          Faster processing.        </li>
        <li>Loan up to Rs.15 Lakhs </li>
        <li>Minimum documentation </li>
        <li> Attractive rates of interest </li>
        <li>No security/guarantor required        </li>
        <li>
         Flexible repayment option of 12-48 months        </li>
      </ul>
  
    </div>
    <br /><br /><br /> <br /><br /><br />
    </td><td width="420" style="padding-top:6px;" align="right" valign="top" >
<table bgcolor="#f0ede4" cellpadding="0" cellspacing="0" style="border:#dcdacd 2px solid;">
<tr><td bgcolor="#f0ede4"  width="400" >
    <table  cellpadding="3" cellspacing="3"  width="400">
		<tr>	<td width="210" height="26" align="left" class="frmtxt">City</td>
		<td width="8" align="center" class="frmtxt">&nbsp;</td>
<td width="182" align="left">
<select size="1" align="left" style="width:143px;"  name="City" id="City" >
<option value="">Please Select</option>
<?php 
for($iii=0;$iii<count($metrosCity_List);$iii++)
{
	?>
	<option value="<?php echo ucfirst(strtolower(trim($metrosCity_List[$iii]))); ?>" ><?php echo ucfirst(strtolower(trim($metrosCity_List[$iii]))); ?></option>
	<?php
}
?>
<option value="" disabled="disabled">-------------------</option>
<?php 
for($ii=1;$ii<count($city_List);$ii++)
{
	?>
	<option value="<?php echo ucfirst(strtolower(trim($city_List[$ii]))); ?>" ><?php echo ucfirst(strtolower(trim($city_List[$ii]))); ?></option>
	<?php
}
?>
</select>
</td>
</tr>
<tr>
<td height="26" align="left" class="frmtxt">DOB</td>
<td width="8" align="center" class="frmtxt">&nbsp;</td>
	<td width="182" align="left"><input name="day" value="dd" type="text" id="day" style="width:38px;  height:21px;" maxlength="2" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)";  onBlur="onBlurDefault(this,'dd');" onFocus="onFocusBlank(this,'dd');">



			<input name="month" id="month" style="width:38px;  height:21px;" maxlength="2" onChange="intOnly(this);" value="mm"  onKeyUp="intOnly(this);" onKeyPress="intOnly(this)"  onBlur="onBlurDefault(this,'mm');" onFocus="onFocusBlank(this,'mm');">



			<input name="year" type="text" id="year" value="yyyy" style="width:52px;  height:21px;" maxlength="4" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)";  onBlur="onBlurDefault(this,'yyyy');" onFocus="onFocusBlank(this,'yyyy');">	</td>
</tr>
<tr>
<td  height="26" align="left" class="frmtxt">Loan Amount</td>
<td width="8" align="center" class="frmtxt">&nbsp;</td>
<td width="182" align="left"><input  style="width:140px;  height:21px; " name="Loan_Amount" id="Loan_Amount"  onkeyup="intOnly(this);getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');"  onkeydown="getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" onkeypress="intOnly(this); getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" onblur="getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');"  /></td>
</tr>   
<tr>
<td  align="left"  colspan="3"><span id='formatedlA' style='font-size:11px; font-weight:bold;color:666699;font-Family:Verdana; '></span><span id='wordloanAmount' style='font-size:11px;
font-weight:bold;color:666699;font-Family:Verdana;text-transform: capitalize; margin-left:10px; margin-bottom:5px;'></span></td>
</tr>   
<tr><td width="210" height="26" align="left" class="frmtxt">Employment Status</td>
	<td width="8" align="center" class="frmtxt">&nbsp;</td>
<td width="182" align="left">
    <select  style="width:143px;   height:21px;"   name="Employment_Status" onChange="addCompany(); ">
	    <option value="-1">Please Select</option>
        <option value="1">Salaried</option>
        <option value="0">Self Employed</option>
	</select>
</td>
</tr>
<tr>
<td align="left" class="frmtxt" id="comp_1" colspan="3" ></td>
</tr>

 <tr>	<td width="210" height="26" align="left" class="frmtxt">Residential Status </td>
		<td width="8" align="center" class="frmtxt">&nbsp;</td>
<td width="182" align="left" class="frmtxt" style="font-weight:normal;">
 <select  style="width:140px;   height:21px;"   name="Residential_Status" onChange="addElementRS(); ">
	  	    <option value="0">Select</option>
	  	    <option value="1">Owned</option>
        <option value="2">Rented</option>
	</select>
 </td>
</tr>
<tr>
<td align="left" class="frmtxt" id="resi_1" colspan="3" ></td>
</tr>
<tr>
<td width="210" height="26" align="left" class="frmtxt"  >Credit Card Holder</td>
<td width="8" align="center" class="frmtxt">&nbsp;</td>
	<td width="182" align="left" class="frmtxt" style="font-weight:normal;"><input type="radio" name="CC_Holder" id="CC_Holder" value="1"  style="border:none; "  onclick="addElementCC();"   /> Yes &nbsp;<input type="radio" name="CC_Holder" id="CC_Holder" value="0" checked style="border:none; " onclick="removeElementCC();" /> No</td>
</tr>
<tr>
<td align="left" class="frmtxt" id="Loan_CC" colspan="3" ></td>
</tr>
<tr>	<td width="210" height="26" align="left" class="frmtxt">Any Loan running?</td>
		<td width="8" align="center" class="frmtxt">&nbsp;</td>
<td width="182" align="left" class="frmtxt" style="font-weight:normal;">
    <input type="radio" style="border:none;"  value="1"  name="LoanAny"  onclick="addElementLoan();" /> Yes &nbsp;  <input size="10" type="radio" style="border:none;" name="LoanAny"  onclick="removeElementLoan();" value="0" checked="checked"> No
</td>
</tr>
<tr>
<td align="left" class="frmtxt" id="Loan_Running" colspan="3" ></td>
</tr>

<tr>
<td width="210" height="26" align="left" class="frmtxt" >Existing Relationship With ICICI Bank</td>
<td width="8" align="center" class="frmtxt">&nbsp;</td>
	<td width="182" align="left" class="frmtxt" style="font-weight:normal;"><input type="radio" name="existing_relationship" id="existing_relationship" value="1"  style="border:none; "  onclick="addElementER();"  /> Yes &nbsp; <input type="radio" name="existing_relationship" id="existing_relationship" onclick="removeElementER();" value="0" checked style="border:none; " /> No</td>
</tr>
<tr>
<td align="left" class="frmtxt" id="Loan_ER" colspan="3" ></td>
</tr>
 
<tr>
<td colspan="3" align="center" class="frmtxt"  > <input name="image"  value="Submit" type="image" src="http://www.deal4loans.com/new-images/hdfc-pl/get_quotesml.gif" width="129" height="35"  style="border:0px;" tabindex="9" /></td>
</tr>
 </table>
</td></tr>
</table>
</td></tr>

</table>
</td></tr></table>
</form>
</body>
</html>
