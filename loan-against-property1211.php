<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';

$maxage=date('Y')-62;
$minage=date('Y')-18;

	$Msg = "";
	if($_SESSION['UserType']== "bidder")
	{
	$Msg = getAlert("Sorry!!!! You are not Authorised to Apply for Loan.", TRUE, "index.php");
	echo $Msg;
	}

	$name = $_SESSION['Temp_Name'] ;
	$mobile = $_SESSION['Temp_mobile'] ;
	$Email=	$_SESSION['Temp_email'] ;
	$loan_type = $_SESSION['Temp_loan_type'] ;
	$last_id = $_SESSION['Temp_Last_Inserted'] ;
	//echo "last in serted id".$last_id;
	?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Loan Against Property</title>
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<link href="css/loan-against-property-lp-styles.css" type="text/css" rel="stylesheet" /></head>
<script type="text/javascript" src="scripts/common.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<script Language="JavaScript" Type="text/javascript">
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
	if (periodPos+3 > email1.length)	
	{		// must be at least 2 characters after the "."
		alert("Invalid E-mail ID.");
		return false;
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
	
	if((Form.Loan_Amount.value=='')||(Form.Loan_Amount.value=="Loan Amount"))
	{	alert("Kindly fill in your Loan Amount (Numeric Only)!");	Form.Loan_Amount.focus();	return false;	}
	
	else if(containsalph(Form.Loan_Amount.value)==true)
	{	alert("Loan Amount contains characters!");	Form.Loan_Amount.focus();	return false;	}
	
	if((Form.Property_Value.value=='')||(Form.Property_Value.value=="Property Value"))
	{	alert("Kindly fill in your Property Value (Numeric Only)!");	Form.Property_Value.focus();	return false;	}
	
	else if(containsalph(Form.Property_Value.value)==true)
	{	alert("Property Value contains characters!");	Form.Property_Value.focus();	return false;	}

	
			if((Form.IncomeAmount.value=='')||(Form.IncomeAmount.value=="Annual Income"))
	{		alert("Please enter Annual income to Continue");		Form.IncomeAmount.focus();		return false;	}
	
		if(Form.City.selectedIndex==0)
	{		alert("Please enter City Name to Continue");		Form.City.focus();		return false;	}
	
	else if((Form.City.value=='Others')  && ((Form.City_Other.value=='')||!isNaN(Form.City_Other.value)||(Form.City_Other.value=="Other City")))
	{	alert("Kindly fill in your other City!");	Form.City_Other.focus();	return false;	}

	if((Form.Name.value=="") || (Form.Name.value=="Full Name")|| (Trim(Form.Name.value))==false)
	{	alert("Kindly fill in your Name!");	Form.Name.focus();	return false;	}
	else if(containsdigit(Form.Name.value)==true)
	{
	alert("Name contains numbers!");
	Form.Name.focus();
	return false;
	}
	  for (var i = 0; i < Form.Name.value.length; i++) {
		if (iChars.indexOf(Form.Name.value.charAt(i)) != -1) {
		alert ("Name has special characters.\n Please remove them and try again.");
		Form.Name.focus();
		return false;
		}
	  }
	  
	if((Form.Phone.value=='Mobile') || (Form.Phone.value=='') || Trim(Form.Phone.value)==false)
	{
	alert("Kindly fill in your Mobile Number!");
	Form.Phone.focus();
	return false;
	}
		  if(isNaN(Form.Phone.value)|| Form.Phone.value.indexOf(" ")!=-1)
			{
				  alert("Enter numeric value");
				  Form.Phone.focus();
				  return false;  
			}
			if (Form.Phone.value.length < 10 )
			{
					alert("Please Enter 10 Digits"); 
					 Form.Phone.focus();
					return false;
			}
			if ((Form.Phone.value.charAt(0)!="9") && (Form.Phone.value.charAt(0)!="8") && (Form.Phone.value.charAt(0)!="7"))
			{
					alert("The number should start only with 9 or 8 or 7");
					 Form.Phone.focus();
					return false;
			}
		
	if(Form.Email.value!="Email Id")
	{
		if (!validmail(Form.Email.value))		{			Form.Email.focus();			return false;		}
	}
	if((space.test(Form.day.value)) || (Form.day.value=="DD"))
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
		else if((space.test(Form.month.value)) || (Form.month.value=="MM"))
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
		else if((space.test(Form.year.value)) || (Form.year.value=="YYYY"))
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
			orm.day.select();
			return false;
		}
		else if(Form.year.value.length != 4)
		{
			alert("Kindly enter your correct 4 digit Year of Birth.(Numeric ONLY)!");
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
			alert("Cannot have 31st Day");
			Form.day.select();
			return false;
		}
	if(Form.Employment_Status.selectedIndex==0)
	{		alert("Please enter Occupation to Continue");		Form.Employment_Status.focus();		return false;	}
	
	if((Form.City.value=="Others") && ((Form.City_Other.value=="" || Form.City_Other.value=="Other City"  ) || !isNaN(Form.City_Other.value)))
	{
		alert("Enter Other City to Continue");		
		Form.City_Other.focus();
		return false;
	}
	
	if(!Form.accept.checked)

	{	alert("Accept the Terms and Condition");	Form.accept.focus();	return false;	}
}
function containsdigit(param)
{
	mystrLen = param.length;
	for(i=0;i<mystrLen;i++)
	{
		if((param.charAt(i)=="0") || (param.charAt(i)=="1") || (param.charAt(i)=="2") || (param.charAt(i)=="3") || (param.charAt(i)=="4") || (param.charAt(i)=="5") || (param.charAt(i)=="6") || (param.charAt(i)=="7") || (param.charAt(i)=="8") || (param.charAt(i)=="9") || (param.charAt(i)=="/"))		{			return true;		}
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

function addPersonalDetails()
{
	var ni1 = document.getElementById('personalDetails');
	var ni20 = document.getElementById('City').value;
	if(ni20!='Others')
	{	
	ni1.innerHTML = '<table width="100%" cellpadding="0" cellspacing="0" border="0" align="center"><tr> <td width="39%"height="40" colspan="2" class="head_text">Personal Details</td> </tr> <tr>  <td width="39%"height="45" colspan="2" class="term_text"><img src="images/security.png" width="14" height="16"> Your details are secure with us and only will be shared with your consent.</td> </tr> <tr> <td height="45" width="39%" class="form_body">Name</td>  <td width="61%" height="35"><input type="text" name="Name" id="Name" class="input_lap"></td> </tr> <tr>  <td height="45" class="form_body">Mobile Number</td>   <td height="35" class="form_body">+91 <input type="text" name="Phone" id="Phone" class="mob_input_lap" maxlength="10" onChange="intOnly(this);"  onKeyUp="intOnly(this);" onKeyPress="intOnly(this);"></td> </tr> <tr> <td height="45" class="form_body">Email Id</td>  <td height="35"><input type="text" name="Email" id="Email" class="input_lap"></td> </tr> <tr>  <td height="45" class="form_body">DOB</td>  <td height="35" ><input type="text" name="day" id="day" class="dd_input_lap" value="DD" onblur="onBlurDefault(this,\'DD\');" onfocus="onFocusBlank(this,\'DD\');" maxlength="2"> <input type="text" name="month" id="month" class="dd_input_lap" value="MM" onblur="onBlurDefault(this,\'MM\');" onfocus="onFocusBlank(this,\'MM\');" maxlength="2"> <input type="text" name="year" id="year" class="dd_input_lap" value="YYYY" onblur="onBlurDefault(this,\'YYYY\');" onfocus="onFocusBlank(this,\'YYYY\');" maxlength="4"></td>  </tr> <tr>   <td height="45" class="form_body">Occupation</td>  <td height="35"><Select name="Employment_Status" id="Employment_Status" class="select_lap">  <option value="-1">Please Select</option>   <option value="1">Salaried</option>                 <option value="0">Self Employed</option></Select></td></tr> <tr><td height="45" colspan="2" align="right" class="term_text" style="font-weight:normal;"><input type="checkbox" name="accept"  style="border:none;" checked />&nbsp;I have read the <a href="http://www.deal4loans.com/Privacy.php" target="_blank">Privacy Policy</a> and agree to the <a href="http://www.deal4loans.com/Privacy.php" target="_blank">Terms And Condition</a>. </td></tr><tr> <td height="45" colspan="2" align="center">   <input type="image" name="Submit"  src="images/lap-get-quote.jpg"  style="width:198px; height:42px; border:none; " />  </td>    </tr></table>';
	}
	else
{
	ni1.innerHTML = '<table width="100%" cellpadding="0" cellspacing="0" border="0" align="center"><tr> <td width="39%"height="40" colspan="2" class="head_text">Personal Details</td> </tr> <tr>  <td width="39%"height="45" colspan="2" class="term_text"><img src="images/security.png" width="14" height="16"> Your details are secure with us and only will be shared with your consent.</td> </tr> <tr> <td height="45" width="39%" class="form_body">Name</td>  <td width="61%" height="35"><input type="text" name="Name" id="Name" class="input_lap"></td> </tr> <tr>  <td height="45" class="form_body">Mobile Number</td>   <td height="35" class="form_body">+91 <input type="text" name="Phone" id="Phone" class="mob_input_lap" maxlength="10" onChange="intOnly(this);"  onKeyUp="intOnly(this);" onKeyPress="intOnly(this);"></td> </tr> <tr> <td height="45" class="form_body">Email Id</td>  <td height="35"><input type="text" name="Email" id="Email" class="input_lap"></td> </tr> <tr>  <td height="45" class="form_body">DOB</td>  <td height="35" ><input type="text" name="day" id="day" class="dd_input_lap" value="DD" onblur="onBlurDefault(this,\'DD\');" onfocus="onFocusBlank(this,\'DD\');" maxlength="2"> <input type="text" name="month" id="month" class="dd_input_lap" value="MM" onblur="onBlurDefault(this,\'MM\');" onfocus="onFocusBlank(this,\'MM\');" maxlength="2"> <input type="text" name="year" id="year" class="dd_input_lap" value="YYYY" onblur="onBlurDefault(this,\'YYYY\');" onfocus="onFocusBlank(this,\'YYYY\');" maxlength="4"></td>  </tr> <tr>   <td height="45" class="form_body">Occupation</td>  <td height="35"><Select name="Employment_Status" id="Employment_Status" class="select_lap">  <option value="-1">Please Select</option>   <option value="1">Salaried</option>                 <option value="0">Self Employed</option></Select></td></tr> <tr> <tr> <td height="45" class="form_body">Other City</td>  <td height="35"><input type="text" name="City_Other" id="City_Other" class="input_lap"></td> </tr><td height="45" colspan="2" align="right" class="term_text" style="font-weight:normal;"><input type="checkbox" name="accept"  style="border:none;" checked />&nbsp;I have read the <a href="http://www.deal4loans.com/Privacy.php" target="_blank">Privacy Policy</a> and agree to the <a href="http://www.deal4loans.com/Privacy.php" target="_blank">Terms And Condition</a>. </td></tr><tr> <td height="45" colspan="2" align="center">   <input type="image" name="Submit"  src="images/lap-get-quote.jpg"  style="width:198px; height:42px; border:none; " />  </td>    </tr></table>';
}
	}
</script>
<body>
<div id="header-lap">
<div id="header-lap-inner">
<div class="logo"><img src="images/d4l-logo-lap.png"></div>
<div class="top-textbox"><span class="top-text">Loan against Property</span><div style="clear:both;"></div>
<span class="top-text-sub">Free Instant quote from 7 PSU & 6 Private Banks.<br>
Loan on Residential & Commercial property.<br>
Loan upto 85% on value of property.</span>
</div>
</div>
</div>
<div class="mobo_box">
<table width="100%" cellspacing="0" cellpadding="0">
 <tr>
   <td class="head_text">Loan Against Property</td>
 </tr>
 <tr>
   <td class="bullete_text"><ul>
   <li>For Working Capital Business Needs.</li>
     <li>Expansion of Business.</li>
<li>      New Property Investment </li><li>Renovation of Home.</li></ul></td>
 </tr>
</table>


</div>
<div class="content">
<div class="rihgt_box_lap">
  <table width="95%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td class="right_body-text"><span style="color:#0f8eda; font-size:16px; font-weight:bold;">Best Banks for Loan against Property - </span><br><br>
        <span style="font-size:20px;">Sbi (State Bank)</span>, <span style="color:#da251c;">Hdfc Ltd</span>, <span style="color:#a50032;">ICICI Ltd</span>, <span style=" color:#0177be;">Citibank</span>, <span style=" color:#f8c301;">Pnb Housing Finance</span>, <span style=" color:#ff6600;">Federal Bank</span>, <span style=" color:#00529c;">Bajaj Finserv</span>, and<span style=" color:#0072a8;"> Ing Vysya</span>.</td>
    </tr>
    <tr>
      <td style="border-bottom:#b8b8b8 thin solid; height:5px;"></td>
    </tr>
    <tr>
      <td class="right_body-text">&nbsp;</td>
    </tr>
    <tr>
      <td class="right_body-text">  <span style="color:#0f8eda; font-size:16px; font-weight:bold;"> Why to opt for Loan Against Property ?</span>
             </td>
    </tr>
    <tr>
      <td class="bullete_text">
      <ul>
      <li>      Capital requirement for Business.</li>
      <li>For your Child's marriage.</li>
      <li>Send your Child for higher studies!</li>
        <li>Fund Medical Treatments.</li>
      <li>In Debt consolidation.</li>
      <li>Loan Against Property Loan Quotes are free for customers. It's a totally free service for customers.</li>
        <li>All loans repayment period are over 6 months. No short term loans.</li>
      </ul>
 <br>
 <div style="height:15px;"></div>
  
</td>
    </tr>
  </table>
</div>
<div class="form_box_lap"><form name="laploan_form" method="post" action="loan_against_property_continue.php" onSubmit="return submitform(document.laploan_form);">	<input type="hidden" name="PostURL" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
              <input type="hidden" name="referrer" value="<? echo $_REQUEST['referrer'] ?>" />
              <input type="hidden" name="Type_Loan" value="Req_Loan_Against_Property" />
              <input type="hidden" name="creative" value="<? echo $_REQUEST['creative'] ?>" />
              <input type="hidden" name="section" value="<? echo $_REQUEST['section'] ?>" />
              <input type="hidden" name="source" value="LAP" />
			  <input type="hidden" name="Activate" id="Activate" />
              <input type="hidden" name="last_id" value="<? echo 	$last_id ?>" /><table width="98%" border="0" cellspacing="0" cellpadding="0">

  <tr>
    <td height="40" colspan="2" class="head_text">Professional Details</td>
  </tr>
  <tr>
    <td width="39%" height="45" class="form_body">Loan Amount</td>
    <td width="61%">

      <input type="text" name="Loan_Amount" id="Loan_Amount" class="input_lap" onChange="intOnly(this);"  onKeyUp="intOnly(this); getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" onKeyPress="intOnly(this); getDigitToWords('Loan_Amount', 'formatedlA','wordloanAmount');" onKeyDown="getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" onBlur="getDigitToWords('Loan_Amount', 'formatedlA', 'wordloanAmount');">
 </td>
  </tr>
   <tr><td></td><td class="term_text"><span id='formatedlA' style='font-family: Verdana, Arial, Helvetica, sans-serif;	font-size:11px;	color:#3A0D04; text-decoration:none; font-weight:bold; text-align:left;'></span><span id='wordloanAmount' style='font-family: Verdana, Arial, Helvetica, sans-serif;	font-size:11px;	color:#3A0D04; text-decoration:none; font-weight:bold; text-align:left;'></span></td></tr>
  <tr>
    <td height="45" class="form_body">Property Value</td>
    <td height="35"><input type="text" name="Property_Value" id="Property_Value" class="input_lap" onChange="intOnly(this);"  onKeyUp="intOnly(this); getDigitToWords('Property_Value','formatedPV','wordloanAmountPV');" onKeyPress="intOnly(this); getDigitToWords('Property_Value', 'formatedPV','wordloanAmountPV');" onKeyDown="getDigitToWords('Property_Value','formatedPV','wordloanAmountPV');" onBlur="getDigitToWords('Property_Value', 'formatedPV', 'wordloanAmountPV');"></td>
  </tr>
   <tr><td></td><td class="term_text"><span id='formatedPV' style='font-family: Verdana, Arial, Helvetica, sans-serif;	font-size:11px;	color:#3A0D04; text-decoration:none; font-weight:bold; text-align:left;'></span><span id='wordloanAmountPV' style='font-family: Verdana, Arial, Helvetica, sans-serif;	font-size:11px;	color:#3A0D04; text-decoration:none; font-weight:bold; text-align:left;'></span></td></tr>
  <tr>
    <td height="45" class="form_body">Yearly Income</td>
    <td height="35"><input type="text" name="IncomeAmount" id="IncomeAmount" class="input_lap" onKeyUp="intOnly(this); getDigitToWords('IncomeAmount','formatedNS','wordloanAmountNS');" onKeyPress="intOnly(this); getDigitToWords('IncomeAmount', 'formatedNS','wordloanAmountNS');" onKeyDown="getDigitToWords('IncomeAmount','formatedNS','wordloanAmountNS');" onBlur="getDigitToWords('IncomeAmount', 'formatedNS', 'wordloanAmountNS');"></td>
  </tr>
  <tr><td></td><td class="term_text"><span id='formatedNS' style='font-family: Verdana, Arial, Helvetica, sans-serif;	font-size:11px;	color:#3A0D04; text-decoration:none; font-weight:bold; text-align:left;'></span><span id='wordloanAmountNS' style='font-family: Verdana, Arial, Helvetica, sans-serif;	font-size:11px;	color:#3A0D04; text-decoration:none; font-weight:bold; text-align:left;'></span></td></tr>
  <tr>
    <td height="45" class="form_body">City</td>
    <td height="35"><Select name="City" id="City" class="select_lap" onChange="addPersonalDetails();"> <?=getCityList1($City);?></Select></td>
  </tr>
  <tr>
  <td colspan="2" id="personalDetails"><table width="100%"><tr><td align="center"><img src="images/lap-get-quote.jpg" style=" width:198px; height:42px;" width="198" height="42"> </td></tr></table>  </td>
  </tr>
  
     <tr>
    <td height="45" colspan="2" class="term_text"><strong>Disclaimer:</strong> All loans are on sole discretion on the respective banks</td>
    </tr>
</table>
</form>
</div>
<div style="clear:both;"></div>
<div class="bank-name"><table width="95%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="right_body-text"><span style="color:#0f8eda; font-size:16px; font-weight:bold;">Best Banks for Loan against Property - </span><br />
      <br />
      <span style="font-size:20px;">Sbi (State Bank)</span>, <span style="color:#da251c;">Hdfc Ltd</span>, <span style="color:#a50032;">ICICI Ltd</span>, <span style=" color:#0177be;">Citibank</span>, <span style=" color:#f8c301;">Pnb Housing Finance</span>, <span style=" color:#ff6600;">Federal Bank</span>, <span style=" color:#00529c;">Bajaj Finserv</span>, and<span style=" color:#0072a8;"> Ing Vysya</span>.</td>
  </tr>
  <tr>
    <td style="border-bottom:#b8b8b8 thin solid; height:5px;"></td>
  </tr>
</table></div>
 <div style="height:130px; clear:both;"></div>
 <div style="clear:both; "></div>
<?php include 'footer_landingpage2.php'; ?>
</div>
</body>
</html>
