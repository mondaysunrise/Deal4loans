 <!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/icici-platinum-card.css" type="text/css" rel="stylesheet"  />
<title>ICICI Platinum Chip Card | Deal4loans.com</title>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<script type="text/javascript" src="http://www.deal4loans.com/ajax.js"></script>
<script type="text/javascript" src="http://www.deal4loans.com/ajax-dynamic-cclist.js"></script>
<script type="text/javascript"> // input select down menu start 
var $cs = $('.styled').customSelect();// input select down menu end
</script>
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

	/*if(document.icici_cc.Employment_Status.value==1)
	{
		ni1.innerHTML = '<table width="100%" border="0" cellpadding="3" cellspacing="0">        <tr>          <td colspan="2" valign="middle" class="platinum_head_text">Personal Details<br>            <span style="font-size:11px;"><img src="images/lock-platinum.jpg" width="14" height="15">Your Information is secure with us & will only be shared with ICICI Bank credit card team</span>  <br /><span  style="color:#B12A30; font-size:13px;" >Platinum chip Card Now at<strong> Nil </strong>Joining Fee</span></td>          </tr>        <tr>          <td width="37%"><span class="platinum_body_frm">Name</span></td>          <td width="63%"><input type="text" name="full_name" class="platinum_input" id="full_name" tabindex="5"></td>          </tr>             <tr>          <td><span class="platinum_body_frm">Mobile No.</span></td>          <td valign="middle"><span class="platinum_body_frm">+91 </span>            <input type="text" name="mobile_no" onKeyPress="intOnly(this);" maxlength="10" class="mobile_platinum" id="mobile_no" tabindex="6" ></td>        </tr>        <tr>          <td><span class="platinum_body_frm">Email Id</span></td>          <td><input type="text" name="email_id" class="platinum_input" id="email_id" tabindex="7"></td>        </tr>    <tr>          <td><span class="platinum_body_frm">DOB</span></td>          <td><input type="text" name="dd" class="yy_platinum" id="dd" onKeyPress="intOnly(this);" tabindex="8" > <input type="text" name="mm" class="yy_platinum" id="mm" onKeyPress="intOnly(this);" tabindex="9" >            <input type="text" name="yyyy" class="yy_platinum" id="yyyy" onKeyPress="intOnly(this);" tabindex="10" ></td>        </tr> <tr><td colspan="2"><div id="addempstst"></div></td></tr>  <tr>          <td width="37%" ><span class="platinum_body_frm">Salary account from which bank?</span></td>          <td width="63%" class="platinum_body_frm"><select name="salary_account" id="salary_account" type="text" class="select_platinum" onkeydown="validateDiv(\'salAccountVal\');" >				  <option name="">Please Select</option>  <option value="HDFC Bank">HDFC Bank</option>	  <option value="ICICI Bank">ICICI Bank</option>  <option value="Kotak Bank">Kotak Bank</option>  <option value="Standard Chartered">Standard Chartered</option>	  <option value="Others">Others</option>  </select></td>          </tr>  <tr>          <td colspan="2" class="platinum_body_frm"><input type="checkbox" name="accept" id="accept" tabindex="10">                         <span style="font-size:11px;">I authorize the website and its partnering banks to contact me and this will override DNC registration and agree to <a href="/Privacy.php" target="_blank">Terms and Conditions</a></span></td>          </tr>        <tr>          <td colspan="2" align="center"><input type="image" src="images/platinum-apply_btn.png" alt="Apply Now" tabindex="11"></td>        </tr>        </table>';
	}
	else
	{*/
		ni1.innerHTML ='<table width="100%" border="0" cellpadding="3" cellspacing="0">        <tr>          <td colspan="2" valign="middle" class="platinum_head_text">Personal Details<br>            <span style="font-size:11px;"><img src="images/lock-platinum.jpg" width="14" height="15">Your Information is secure with us & will only be shared with ICICI Bank credit card team</span>  <br /><span  style="color:#B12A30; font-size:13px;" >Platinum chip Card Now at<strong> Nil </strong>Joining Fee</span></td>          </tr>        <tr>          <td width="37%"><span class="platinum_body_frm">Name</span></td>          <td width="63%"><input type="text" name="full_name" class="platinum_input" id="full_name" tabindex="5"></td>          </tr>             <tr>          <td><span class="platinum_body_frm">Mobile No.</span></td>          <td valign="middle"><span class="platinum_body_frm">+91 </span>            <input type="text" name="mobile_no" onKeyPress="intOnly(this);" maxlength="10" class="mobile_platinum" id="mobile_no" tabindex="6" ></td>        </tr>        <tr>          <td><span class="platinum_body_frm">Email Id</span></td>          <td><input type="text" name="email_id" class="platinum_input" id="email_id" tabindex="7"></td>        </tr>    <tr>          <td><span class="platinum_body_frm">DOB</span></td>          <td><input type="text" name="dd" class="yy_platinum" id="dd" onKeyPress="intOnly(this);" tabindex="8" > <input type="text" name="mm" class="yy_platinum" id="mm" onKeyPress="intOnly(this);" tabindex="9" >            <input type="text" name="yyyy" class="yy_platinum" id="yyyy" onKeyPress="intOnly(this);" tabindex="10" ></td>        </tr>    <tr><td colspan="2"> <table width="100%" cellpadding="0" cellspacing="0" border="0"><tr>          <td width="37%" colspan="2"><span class="platinum_body_frm">Do You Have An Existing Relationship With ICICI Bank?</span></td>    </tr> <tr>      <td>&nbsp;</td><td width="63%" class="platinum_body_frm"><input type="radio" name="existing_rel" id="existing_rel" tabindex="10" onclick="askfrrel();" value="1">Yes <input type="radio" name="existing_rel" id="existing_rel" tabindex="10" value="2" onclick="askfrrel();">No</td>          </tr>  <tr><td colspan="2"><div id="addexistrel"></div></td></tr><tr><td colspan="2">&nbsp;</td></tr></table></td></tr><tr>          <td colspan="2" class="platinum_body_frm"><input type="checkbox" name="accept" id="accept" tabindex="11">                         <span style="font-size:11px;">I authorize the website and its partnering banks to contact me and this will override DNC registration and agree to <a href="/Privacy.php" target="_blank">Terms and Conditions</a></span></td>          </tr>        <tr>          <td colspan="2" align="center"><input type="image" src="images/platinum-apply_btn.png" alt="Apply Now" tabindex="11"></td>        </tr>        </table>';
	//}
	
}
function addcty_oth()
{
		var ni = document.getElementById('myDiv');
		
		if(ni.innerHTML=="")
		{
		if(document.icici_cc.City.value=="Others")
			{
			ni.innerHTML = '<table width="100%" cellpadding="0" cellspacing="0"> <tr>          <td width="38%"><span class="platinum_body_frm">Other City</span></td>          <td>          <input name="other_city"  id="other_city"  tabindex="2" class="platinum_input"/>         </td>        </tr></table>';
			}
		}
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
<div class="platinum_top_box">
<div class="platinum_top_box-b">
<div class="logo_platinum" style="vertical-align:bottom; padding-top:20px;"><img src="images/powered-by-deal4loans.jpg" width="208" height="20" ></div>
<div class="logo_platinum_icici"><img src="images/icici-platinum-card-logo.png" width="305" height="62"></div>
 </div>
</div>
<div style="clear:both;"></div>
<div class="heading_text" style="margin-top:7px;" align="center"><b>Enjoy the Benefits of platinum chip Card with<span style="font-size:30px;"> Nil
</span>Joining Fee</b></div>
<div class="platinum_second-wrapper" style="margin-top:15px;">
<div class="platinum_form_box">
<form name="icici_cc" method="post" onSubmit="return icicivalide(document.icici_cc);" action="icici_credit_card_mlr.php">
  <table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td align="center" valign="middle" class="platinum_form_tpbg">APPLY PLATINUM CHIP CARD</td>
    </tr>
    <tr>
      <td><table width="100%" border="0"  style="border:#CCC solid thin;" cellpadding="5" cellspacing="0">
        <tr>
          <td height="35" colspan="2" class="platinum_head_text">Professional Details</td>
        </tr>
        <tr>
          <td width="37%" align="left" valign="middle" class="platinum_body_frm">Occupation</td>
          <td width="63%">
          <label>
          <select  name="Employment_Status" class="select_platinum" id="Employment_Status" tabindex="1" >
            <option selected="selected" value="-1">Employment Status</option>
            <option  value="1">Salaried</option>
            <option value="0">Self Employed</option>
          </select>
          
          </label></td>
        </tr>
        <tr>
          <td><span class="platinum_body_frm">Company Name</span></td>
          <td>
          <input name="company_name" class="platinum_input" id="company_name"  tabindex="2" onKeyDown="validateDiv('companyNameVal');" onKeyUp="ajax_showOptions(this,'getCountriesByLetters',event)" value="Type Slowly for Autofill" onBlur="onBlurDefault(this,'Type Slowly for Autofill');" onFocus="onFocusBlank(this,'Type Slowly for Autofill');"/>         </td>
        </tr>
        <tr>
          <td><span class="platinum_body_frm">Annual Income</span></td>
          <td>
          <input name="IncomeAmount" class="platinum_input" id="IncomeAmount"  tabindex="3" onFocus="this.select();" onBlur="getDiToWordsIncome('IncomeAmount', 'formatedIncome', 'wordIncome');" onChange="intOnly(this);" onKeyPress="intOnly(this); getDiToWordsIncome('IncomeAmount','formatedIncome','wordIncome');" onKeyDown="validateDiv('netSalaryVal');"  onKeyUp="intOnly(this); getDiToWordsIncome('IncomeAmount','formatedIncome','wordIncome');"/>          </td>
        </tr>
           <tr><td align="left" colspan="2"><span id='formatedIncome' style='font-family: Verdana, Arial, Helvetica, sans-serif;	font-size:11px;	color:#3A0D04; text-decoration:none; font-weight:bold; text-align:left;'></span><span id='wordIncome' style='font-family: Verdana, Arial, Helvetica, sans-serif;	font-size:11px;	color:#3A0D04; text-decoration:none; font-weight:bold; text-align:left;'></span></td></tr>
        <tr>
          <td><span class="platinum_body_frm">City</span></td>
          <td>
                    <label>
         <select  name="City" class="select_platinum" id="City"  tabindex="4" onChange=" addPersonalDetails(); addcty_oth();" ><option value="Select Your City">Select your City</option> <option value="Ahmedabad">Ahmedabad</option>
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
             </select>     
             </label>
                  </td>
        </tr>
        <tr>
          <td colspan="2" id="myDiv"></td>
          </tr>
        <tr>
          <td colspan="2" height="5"></td>
          </tr>
        <tr>
          <td colspan="2" align="center" id="personalDetails"><img src="images/platinum-apply_btn.png" width="123" height="31"></td></tr>
      </table></td>
    </tr>
  </table>
  </form>
</div>
<div class="platinum_right_box">
<table cellpadding="0" cellspacing="0"><tr>
  <td class="features_text"><b>Your application will be processed by ICICI Bank credit card team within 24 hours.**</b></td>
</tr></table>
<div class="platinum_right_row-a" style="margin-top:30px;">
  <table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td width="42%"><img src="images/icici-patinum-card.jpg" style="width:100%;" width="189" height="125"></td>
      <td width="58%" class="text_platinum_bullet">
      <ul>
      <li>Security of a Chip<br>
      </li>
      <li>Minimum 15% savings at participating restaurants<br>
      </li>
      </ul></td>
    </tr>
  </table>
</div>
<div class="features_box"><table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="45" align="center" style="border-bottom:thin solid #c44631;" class="features_text">Enjoy the Benefits of platinum chip Card with<strong> <span style="color:#b12a30; font-size:16px;">Nil</span><br>
      </strong>Joining Fee and other additional features </td>
    </tr>
  <tr>
    <td height="5"> </td>
    </tr>
  <tr>
    <td class="text_platinum_bullet">
    <ul >
    <li style=" font-size:12px; color:#3e3d3d;">Additional Security of a Chip</li>
    <li style=" font-size:12px; color:#3e3d3d;">2 PAYBACK points for every Rs.100 spent (except on fuel).</li>
    <li style=" font-size:12px; color:#3e3d3d;">Minimum 15% saving on dining at over 800 participating restaurants</li>
    <li style=" font-size:12px; color:#3e3d3d;">Platinum Benefits from MasterCard/Visa*.</li>
    <li style=" font-size:12px; color:#3e3d3d;">Fuel surcharge waiver at HPCL fuel pumps</li>
    </ul>
    </td>
    </tr>
   </table>
</div>
<!--<div align="right" style="padding:10px;"><img src="images/powered-by-deal4loans.jpg" width="208" height="20"></div>-->
</div>

</div>
</body>
</html>
