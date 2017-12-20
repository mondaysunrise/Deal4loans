<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Indusind Credit Cards</title>
<link href="css/indusind-bank-landing-page-styles.css" type="text/css" rel="stylesheet" />
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<script type="text/javascript" src="http://www.deal4loans.com/ajax.js"></script>
<script type="text/javascript" src="http://www.deal4loans.com/ajax-dynamic-cclist.js"></script>
<Script Language="JavaScript">
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

function icicivalide(Form)
{
	var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";
	var myOption;
	var i;

	if(Form.Employment_Status.selectedIndex==0)
	{
		alert("Please select Employment Status");
		Form.Employment_Status.focus();
		return false;
	}
	 if((Form.company_name.value=='') ||(Form.company_name.value=='Type Slowly for Autofill'))
	{
		alert("Kindly fill in Company Name!");
		Form.company_name.focus();
		return false;
	}
	 if((Form.IncomeAmount.value=='')||(Form.IncomeAmount.value=="Annual Income"))
	{
		alert("Kindly fill in your Annual Income (Numeric Only)!");
		Form.IncomeAmount.focus();
		return false;
	}
	else if(containsalph(Form.IncomeAmount.value)==true)
	{
		alert("Annual Income contains characters!");
		Form.IncomeAmount.focus();
		return false;
	}

if(Form.City.selectedIndex==0)
	{
		alert("Please select City ");
		Form.City.focus();
		return false;
	}
	if((Form.City.value=="Others") && ((Form.other_city.value=="") || (Trim(Form.other_city.value))==false))
	{
		alert("Kindly fill in Other City!");
		Form.other_city.focus();
		return false;
	}
	if((Form.full_name.value=="") || (Form.full_name.value=="Full Name")|| (Trim(Form.full_name.value))==false)
	{
		alert("Kindly fill in your First Name!");
		Form.full_name.focus();
		return false;
	}
	else if(containsdigit(Form.full_name.value)==true)
	{
		alert("First Name contains numbers!");
		Form.full_name.focus();
		return false;
	}
	for (var i = 0; i < Form.full_name.value.length; i++) {
	if (iChars.indexOf(Form.full_name.value.charAt(i)) != -1) {
		alert ("First Name has special characters.\n Please remove them and try again.");
		Form.full_name.focus();
		return false;
	}
	}
	if((Form.mobile_no.value=='Mobile No') || (Form.mobile_no.value=='') || Trim(Form.mobile_no.value)==false)
	{
		alert("Kindly fill in your Mobile Number!");
		Form.mobile_no.focus();
		return false;
	}
	else if(isNaN(Form.mobile_no.value)|| Form.mobile_no.value.indexOf(" ")!=-1)
	{
		alert("Enter numeric value in ");
		Form.mobile_no.focus();
		return false;  
	}
	else if (Form.mobile_no.value.length < 10 )
	{
		alert("Please Enter 10 Digits"); 
		Form.mobile_no.focus();
		return false;
	}
	else if ((Form.mobile_no.value.charAt(0)!="9") && (Form.mobile_no.value.charAt(0)!="8") && (Form.mobile_no.value.charAt(0)!="7"))
	{
		alert("The number should start only with 9 or 8 or 7");
		Form.mobile_no.focus();
		return false;
	}	
		if(Form.email_id.value!="Email ID")
		{
		if (!validmail(Form.email_id.value))
		{
			//alert("Please enter your valid email address!");
			Form.email_id.focus();
			return false;
		}

		}
	 if((Form.dd.value=='')||(Form.dd.value=="DD"))
	{
		alert("Kindly fill in your dd (Numeric Only)!");
		Form.dd.focus();
		return false;
	}
	else if(containsalph(Form.dd.value)==true)
	{
		alert("DD contains characters!");
		Form.dd.focus();
		return false;
	}
	 if((Form.mm.value=='')||(Form.mm.value=="MM"))
	{
		alert("Kindly fill in your MM (Numeric Only)!");
		Form.mm.focus();
		return false;
	}
	else if(containsalph(Form.mm.value)==true)
	{
		alert("MM contains characters!");
		Form.mm.focus();
		return false;
	}
	 if((Form.yyyy.value=='')||(Form.yyyy.value=="YYYY"))
	{
		alert("Kindly fill in your yyyy (Numeric Only)!");
		Form.yyyy.focus();
		return false;
	}
	else if(containsalph(Form.yyyy.value)==true)
	{
		alert("YYYY contains characters!");
		Form.yyyy.focus();
		return false;
	}
if(Form.Employment_Status.selectedIndex==2)
	{
	myOption = -1;
		for (i=Form.existing_rel.length-1; i > -1; i--) {
			if(Form.existing_rel[i].checked) {
				if(i==0)
				{
				if (Form.typeofrel.selectedIndex==0)
				{
						alert("select type of relation with icici bank!");	
						Form.typeofrel.focus();
						return false;
				}
				}
					myOption = i;
				}
		}
		if (myOption == -1) 
		{
			alert("Do you have an existing ralation with ICICI bank");
			return false;
		}
	}
if(!Form.accept.checked)
	{
		alert("Accept the Terms and Condition");
		
		Form.accept.focus();
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

function Trim(strValue) {
	var j=strValue.length-1;i=0;
	while(strValue.charAt(i++)==' ');
	while(strValue.charAt(j--)==' ');
	return strValue.substr(--i,++j-i+1);
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

function askfrrel()
{
	var i;
	var niextrel = document.getElementById('addexistrel');
	var myOption = -1;
		for (i=document.icici_cc.existing_rel.length-1; i > -1; i--) {
			if(document.icici_cc.existing_rel[i].checked) {
				if(i==0)
				{
				niextrel.innerHTML='<table width="100%" cellpadding="0" cellspacing="0"><tr>          <td width="37%" ></td>          <td width="63%">            <select  name="typeofrel" class="select_platinum" id="typeofrel" tabindex="1">	<option selected="selected" value="">Please Select</option> <option  value="1">Account Holder</option> <option  value="4">Credit Card Holder</option>              <option  value="2">Loan Running</option>              <option value="3">Others</option>            </select>          </td>        </tr></table>';
				}
				if(i==1)
				{
				niextrel.innerHTML='';
				}
					myOption = i;
				}
		}	
}

function addPersonalDetails()
{
	var ni1 = document.getElementById('personalDetails');

ni1.innerHTML ='<table width="100%" border="0" cellpadding="3" cellspacing="0"> <tr>    <th colspan="2" align="left" class="text-head1" scope="row" >Personal Details</th>    </tr>  <tr>    <th colspan="2" align="left" class="text-head2" scope="row" style="font-size:12px; font-weight:400;"><img src="images/bt_locked.png" width="14" height="13"> Your Information is secure with us &amp; will only be shared with Indusind Bank credit card team </th>    </tr>  <tr>    <td colspan="2"  height="10"></td>    </tr>  <tr>    <th align="left" class="text-head2" scope="row" width="35%">Name</th>    <td width="65%"><input type="text" name="full_name" id="full_name" class="input"></td>  </tr>  <tr>    <td colspan="2" align="left"  height="5"></td>    </tr>  <tr>    <th align="left" class="text-head2" scope="row">Mobile No.</th>    <td><div class="input-number1">+91</div>      <input type="text" name="mobile_no" id="mobile_no" class="input-number2"></td>  </tr>  <tr>    <td colspan="2" align="left"  height="5"></td>    </tr>  <tr>    <th align="left" class="text-head2" scope="row">Email Id</th>    <td><input type="text" name="email_id" id="email_id" class="input"></td>  </tr>  <tr>    <td colspan="2" align="left"  height="5"></td>    </tr>  <tr>    <th align="left" class="text-head2" scope="row">DOB</th>    <td><input type="text" name="dd" id="dd" class="dob">      <input type="text" name="mm" id="mm" class="dob">      <input type="text" name="yyyy" id="yyyy" class="dob"></td>  </tr>  <tr>    <th colspan="2" scope="row" height="15"></th>    </tr>  <tr>    <th colspan="2" align="left" class="text-head2" scope="row">Do You Have An Existing Relationship With Indusind Bank?</th>    </tr>  <tr>    <th scope="row">&nbsp;</th>    <td class="text-head2">      <input type="radio" name="salary_account" id="salary_account" value="radio"> Yes  <input type="radio" name="salary_account" id="radio" value="radio"> No    </td>  </tr>  <tr>    <th scope="row">&nbsp;</th>    <td>&nbsp;</td>  </tr>  <tr>    <th colspan="2" align="left" class="text-head2" scope="row" style="font-size:13px;">     <input type="checkbox" name="checkbox" id="checkbox"> I authorize the website and its partnering banks to contact me and this will override DNC registration and agree to <a href="/Privacy.php" target="_blank">Terms and Conditions</a></th>    </tr><tr>    <th type="image"colspan="2" scope="row"><input type="image" src="images/get-quote-btn-new1.png" width="114" height="39"></th>    </tr></table>';
}
function onFocusBlank(element,defaultVal){	if(element.value==defaultVal){		element.value="";	} }
function onBlurDefault(element,defaultVal){	if(element.value==""){		element.value = defaultVal;	} }
</script>
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
</head>
<body>
<div class="bg-wrapper">
<div class="bg-wrapper2">
<div class="logo-ind"><img src="images/indusind-logo-lp.png" width="201" height="22" alt="indusind logo"></div>
<div class="credit-cards"><img src="images/indusind-aura-card.png" width="196" height="170"></div>
</div>
</div>
<div style="clear:both;"></div>
<div class="form-wrapper">
<div class="text-head1">Professional Details</div>
<div class="form-left">
<form name="icici_cc" method="post" onSubmit="return icicivalide(document.icici_cc);" action="indusindbank-platinum-card-continue.php">
<table width="98%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td colspan="2" align="left"  scope="row"></td>
    </tr>
  <tr>
    <th width="37%" align="left" class="text-head2" scope="row">Occupation</th>
    <td width="63%">  
     <select  name="Employment_Status" class="select" id="Employment_Status" tabindex="1" >
            <option selected="selected" value="-1">Employment Status</option>
            <option  value="1">Salaried</option>
            <option value="0">Self Employed</option>
          </select>
    </td>
  </tr>
  <tr>
    <th colspan="2" align="left" scope="row" height="15"></th>
    </tr>
  <tr>
    <th align="left" class="text-head2" scope="row">Company Name </th>
    <td><input type="text" name="company_name" id="company_name" class="input" onKeyDown="validateDiv('companyNameVal');" onKeyUp="ajax_showOptions(this,'getCountriesByLetters',event)" value="Type Slowly for Autofill" onBlur="onBlurDefault(this,'Type Slowly for Autofill');" onFocus="onFocusBlank(this,'Type Slowly for Autofill');"></td>
  </tr>
  <tr>
    <th colspan="2" align="left" scope="row" height="15"></th>
    </tr>
  <tr>
    <th align="left" class="text-head2" scope="row">Annual Income</th>
    <td><input type="text" name="IncomeAmount" id="IncomeAmount" class="input" onBlur="getDiToWordsIncome('IncomeAmount', 'formatedIncome', 'wordIncome');" onChange="intOnly(this);" onKeyPress="intOnly(this); getDiToWordsIncome('IncomeAmount','formatedIncome','wordIncome');" onKeyDown="validateDiv('netSalaryVal');"  onKeyUp="intOnly(this); getDiToWordsIncome('IncomeAmount','formatedIncome','wordIncome');"></td>
  </tr>
    <tr><td align="left" colspan="2"><span id='formatedIncome' style='font-family: Verdana, Arial, Helvetica, sans-serif;	font-size:11px;	color:#3A0D04; text-decoration:none; font-weight:bold; text-align:left;'></span><span id='wordIncome' style='font-family: Verdana, Arial, Helvetica, sans-serif;	font-size:11px;	color:#3A0D04; text-decoration:none; font-weight:bold; text-align:left;'></span></td></tr>
  <tr>
    <th colspan="2" align="left" scope="row" height="15"></th>
    </tr>
  <tr>
    <th align="left" class="text-head2" scope="row">City</th>
    <td><select  name="City" class="select" id="City"  tabindex="4" onChange=" addPersonalDetails(); addcty_oth();" ><option value="Select Your City">Select your City</option> <option value="Ahmedabad">Ahmedabad</option>
				<option value="Ankleshwar">Ankleshwar</option>
				<option value="Badlapur">Badlapur</option>
				<option value="Bangalore">Bangalore</option>
				<option value="Baroda">Baroda</option>
				<option value="Bharuch">Bharuch</option>
				<option value="Bhopal">Bhopal</option>
				<option value="Bhubaneswar">Bhubaneswar</option>
				<option value="Bhubneshwar">Bhubneshwar</option>
				<option value="Chandigarh">Chandigarh</option>
				<option value="Chennai">Chennai</option>
				<option value="Coimbatore">Coimbatore</option>
				<option value="Delhi">Delhi</option>
				<option value="Dombivali">Dombivali</option>
				<option value="Faridabad">Faridabad</option>
				<option value="Gandhinagar">Gandhinagar</option>
				<option value="Gaziabad">Gaziabad</option>
				<option value="Greater Noida">Greater Noida</option>
				<option value="Gurgaon">Gurgaon</option>
				<option value="Hooghly">Hooghly</option>
				<option value="Howrah">Howrah</option>
				<option value="Hyderabad">Hyderabad</option>
				<option value="Indore">Indore</option>
				<option value="Jaipur">Jaipur</option>
				<option value="Jammu">Jammu</option>
				<option value="Jamnagar">Jamnagar</option>
				<option value="Jodhpur">Jodhpur</option>
				<option value="Kalyan">Kalyan</option>
				<option value="Kochi">Kochi</option>
				<option value="Kolkata">Kolkata</option>
				<option value="Mohali">Mohali</option>
				<option value="Mumbai">Mumbai</option>
				<option value="Mysore">Mysore</option>
				<option value="Naigaon">Naigaon</option>
				<option value="Nashik">Nashik</option>
				<option value="Nasik">Nasik</option>
				<option value="Navi Mumbai">Navi Mumbai</option>
				<option value="Noida">Noida</option>
				<option value="Panchkula">Panchkula</option>
				<option value="Pune">Pune</option>
				<option value="Rajkot">Rajkot</option>
				<option value="Secunderabad">Secunderabad</option>
				<option value="Surat">Surat</option>
				<option value="Thane">Thane</option>
				<option value="Udaipur">Udaipur</option>
				<option value="Vadoadara">Vadoadara</option>
				<option value="Vadodara">Vadodara</option>
				<option value="Valsad">Valsad</option>
				<option value="Vapi">Vapi</option>
				<option value="Vizag">Vizag</option><option value="Others">Others</option>
             </select>     </td>
  </tr>
  <tr>
    <th scope="row">&nbsp;</th>
    <td>&nbsp;</td>
  </tr>
  <tr>
      <td colspan="2" scope="row" id="personalDetails"><table align="center" width="100%"><tr><td align="center"><img src="images/get-quote-btn-new1.png" width="114" height="39"></td></tr></table></td></tr>  
  <tr>
    <th scope="row">&nbsp;</th>
    <td>&nbsp;</td>
  </tr>
</table>
</form>
</div>
<div class="form-right">
  <div class="features_head">Exclusive Privileges: </div>
  <div class="features_head_body">
    <ul>
      <li>Fuel Surcharge waiver.</li>
      <li>Access to over 600+ airport lounges</li>
      <li>Concierge Services</li>
      <li>Enhanced security with EMV Chip</li>
      <li> Exclusive offers on lifestyle,travel and much more</li>
    </ul>
  </div>
  <br />
  <div class="features_head">Rewards Points: </div>
  <div class="features_head_body2">
    <ul>
      <li><b>Platinum Aura Shop Plan</b><br />
        Earn 4X reward points on departmental stores, electronic and restaurants.</li>
      <li><b>Platinum Aura Home Plan</b><br />
        Earn 4X reward points on  household expenses, grocery, mobile/electricity bills and medical spends.</li>
      <li><b>Platinum Aura Travel Plan</b><br />
        Earn 4X reward points on airline, railway tickets, hotel bills and car rentals.</li>
      <li><b>Platinum Aura Party Plan</b><br />
        Earn 4X reward points at restaurants, bars, pubs, departmental stores and theatres.</li>
    </ul>
  </div>
</div>
<div style="clear:both;"></div>
</div>
</body>
</html>