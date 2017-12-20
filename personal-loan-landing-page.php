<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';

?>
<HTML>
<HEAD>
<title>Deal4Loans Personal Loan: Compare Personal Loans in India</title>
<meta name="description" content="Deal4Loans is an online loan information portal, provides valuable information on all types of loans in India offered by top banks. Read online information on home loans, car loans, personal loans, loans against property, loan providers and credit cards. Just fill in a simple form, Get, Compare and Choose deals from all the leading loan providers / banks">
<meta name="keywords" content="personal loan, personal loans, compare personal loan, compare personal loans, compare personal loan India, compare personal loans India, personal loan india, personal loan in india, personal loans india, personal loans in india, personal loan delhi, personal loan in delhi, personal loan mumbai, personal loan in mumbai, personal loan chennai, personal loan in chennai, personal loan bangalore, personal loan in bangalore">
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<style>
.style4{
font-size:10px;
font-weight:bold;
color:#666699;
font-Family:Verdana;
}
h1.head1{ color:#FFFFFF; font-family:News Gothic std; font-size:40px; margin-left:20px; font-weight:bold;}
.text{font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; line-height:17px;  }
li{font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold; }

input, select {font:12px Verdana; padding:2px; margin:0px; border: 1px solid #68718A;}
input.NoBrdr	{font:12px Verdana; padding:0px; margin:0px; border: 0px}
.style5 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 20px;
	font-weight: bold;
	color: #FFFFFF;
}
</style>
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


function valButton2() {
    var cnt = -1;
	var i;
    for(i=0; i<document.personalloan_form.From_Product.length; i++) 
	{
        if(document.personalloan_form.From_Product[i].checked)
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
function addElement()
{
		var ni = document.getElementById('myDiv');
		
		if(ni.innerHTML=="")
		{
		
			if(document.personalloan_form.CC_Holder.value="on")
			{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '<table><tr><td align="left"  class="style4" width="210" height="20"><font class="style4">Card held since?</td><td  align="left" colspan="3" width="290" height="20"><select class="style4" size="1" name="Card_Vintage"><option value="0">Please select</option> <option value="1">Less than 6 months</option>		 <option value="2">6 to 9 months</option> <option value="3">9 to 12 months</option>				<option value="4">more than 12 months</option> </select></td>	</tr></table>';
				

			}
		}
		
		return true;

	}


function removeElement()
{
		var ni = document.getElementById('myDiv');
		
		if(ni.innerHTML!="")
		{
		
			if(document.personalloan_form.CC_Holder.value="on")
			{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '';
				
			}
		}
		
		return true;

	}
function chkpersonalloan(Form)
{
	var btn2;
	var btn3;
	var myOption;
	var i;
var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
var dt,mdate;dt=new Date();

var alpha=/^[a-zA-Z\ ]*$/;
var alphanum=/^[a-zA-Z0-9]*$/;
var num=/^[0-9]*$/;
var space=/^[\ ]*$/;
var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";
<?
if($_SESSION['UserType']=="") 
{
?>
if(document.personalloan_form.Email.value!="Email Id")
{
	if (!validmail(document.personalloan_form.Email.value))
	{
		//alert("Please enter your valid email address!");
		document.personalloan_form.Email.focus();
		return false;
	}
	
}

<?
}
?>
if((Form.Name.value=="") || (Form.Name.value=="Full Name")|| (Trim(Form.Name.value))==false)
{
alert("Kindly fill in your Name!");
Form.Name.focus();
return false;
}
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
else if((Form.year.value < "1945") || (Form.year.value >"1989"))
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

	
if((Form.Phone.value=='Mobile') || (Form.Phone.value=='') || Trim(Form.Phone.value)==false)
{
alert("Kindly fill in your Mobile Number!");
Form.Phone.focus();
return false;
}
 else if(isNaN(Form.Phone.value)|| Form.Phone.value.indexOf(" ")!=-1)
		{
              alert("Enter numeric value");
			  Form.Phone.focus();
			  return false;  
		}
        else if (Form.Phone.value.length < 10 )
		{
                alert("Please Enter 10 Digits"); 
				 Form.Phone.focus();
				return false;
        }
else if (Form.Phone.value.charAt(0)!="9")
		{
                alert("The number should start only with 9");
				 Form.Phone.focus();
                return false;
        }


if(Form.City.selectedIndex==0)
{
	alert("Please enter City Name to Continue");
	Form.City.focus();
	return false;
}
else if((Form.City.value=='Others')  && ((Form.City_Other.value=='')||!isNaN(Form.City_Other.value)||(Form.City_Other.value=="Other City")))
{
alert("Kindly fill in your other City!");
Form.City_Other.focus();
return false;
}
if((Form.Pincode.value=='PinCode') || (Form.Pincode.value=='') || Trim(Form.Pincode.value)==false)
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
else if(containsalph(Form.Pincode.value)==true)
{
alert("Kindly fill in your Correct Pincode (Numeric Only)!");
Form.Pincode.focus();
return false;
}

 if(Form.Employment_Status.selectedIndex==0)
{
	alert("Please select emplyment status ");
	Form.Employment_Status.focus();
	return false;
}
if((Form.Company_Name.value=="") || (Form.Company_Name.value=="Company Name")|| (Trim(Form.Company_Name.value))==false)
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
for (var i = 0; i < Form.Company_Name.value.length; i++) {
  	if (iChars.indexOf(Form.Company_Name.value.charAt(i)) != -1) {
  	alert ("Company Name has special characters.\n Please remove them and try again.");
	Form.Company_Name.focus();
  	return false;
  	}
  }
if((Form.IncomeAmount.value=='')||(Form.IncomeAmount.value=="Annual Income"))
{
	alert("Please enter Annual income to Continue");
	Form.IncomeAmount.focus();
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

	if(!Form.accept.checked)
	{
		alert("Accept the Terms and Condition");
		Form.accept.focus();
		return false;
	}
	
	
if(Form.Email.value=="Email Id")
{
	Form.Email.value=" ";
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
function validateemailv2(email)
{
// a very simple email validation checking.
// you can add more complex email checking if it helps
var splitted = email.match("^(.+)@(.+)$");
if(splitted == null) return false;
if(splitted[1] != null )
{
var regexp_user=/^\"?[\w-_\.]*\"?$/;
if(splitted[1].match(regexp_user) == null) return false;
}
if(splitted[2] != null)
{
var regexp_domain=/^[\w-\.]*\.[a-za-z]{2,4}$/;
if(splitted[2].match(regexp_domain) == null)
{
var regexp_ip =/^\[\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}\]$/;
if(splitted[2].match(regexp_ip) == null) return false;
}// if
return true;
}
return false;
}
function othercity1()
{
if(document.personalloan_form.City.value=='Others')
{
document.personalloan_form.City_Other.disabled=false;
}
else
{document.personalloan_form.City_Other.disabled=true;
}
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

</script>




</HEAD>
<BODY BGCOLOR="#EBF5FE" LEFTMARGIN=0 TOPMARGIN=0 MARGINWIDTH=0 MARGINHEIGHT=0>
<!-- ImageReady Slices (Personal_Loan_landing_page1.psd) -->
<TABLE WIDTH=1000 BORDER=0 CELLPADDING=0 CELLSPACING=0>
	<TR>
		<TD ROWSPAN=11 width=200 height=1000 alt="" bgcolor="#EBF5FE">&nbsp;</TD>
		<TD COLSPAN=4>
			<IMG SRC="images/pl/Personal_Loan_landing_pa-03.jpg" WIDTH=600 HEIGHT=155 ALT=""></TD>
		<TD ROWSPAN=11 WIDTH=200 HEIGHT=1000 ALT="" bgcolor="#EBF5FE">&nbsp;</TD>
		<TD>
			<IMG SRC="images/pl/spacer.gif" WIDTH=1 HEIGHT=155 ALT=""></TD>
	</TR>
	<TR>
		<TD ROWSPAN=2 WIDTH=265 HEIGHT=115 ALT="" bgcolor="#456688"><h1 class="head1">Just 3<br> easy steps!</h1></TD>
		<TD COLSPAN=3>
			<IMG SRC="images/pl/Personal_Loan_landing_pa-06.jpg" WIDTH=335 HEIGHT=14 ALT=""></TD>
		<TD>
			<IMG SRC="images/pl/spacer.gif" WIDTH=1 HEIGHT=14 ALT=""></TD>
	</TR>
	<TR>
		<TD WIDTH=15 HEIGHT=566 ROWSPAN=5 background="images/pl/background-left.jpg" ALT="">&nbsp;</TD>
		<TD ROWSPAN=5 WIDTH=308 HEIGHT=566 ALT="" valign="top" style="background-image:url(images/pl/background.jpg)">
		
		<div style="margin-top:20px;" align="center">
		 <span style="font-size:18px; font-family:Verdana, Arial, Helvetica, sans-serif; color:#6C6A6A; text-align:center; font-weight:bold;">Personal Loan Request</span>
		</div>
		<BR><BR>
		<form name="personalloan_form"  action="thank_personalloan.php" method="POST" onsubmit="return chkpersonalloan(document.personalloan_form);">
		<table border="0" width="230" align="center" cellpadding="0" cellspacing="4" >
		   <tr>
			<td colspan="4" align="center"  width="4"></td><input type="hidden" name="referrer" value="<? echo $_REQUEST['referrer'] ?>"></td>

			</tr>
			<tr>
			<td colspan="4" align="center" width="4"></td><input type="hidden" name="Type_Loan" value="Req_Personal_Loan"></td>
			</tr>
			<tr>
			<td colspan="4" align="center" width="4"></td><input type="hidden" name="creative" value="<? echo $_REQUEST['creative'] ?>"></td>
			</tr>
			<tr>
			<td colspan="4" align="center" width="4"></td><input type="hidden" name="section" value="<? echo $_REQUEST['section'] ?>"></td>

			</tr>
				<tr>
			<td colspan="2" align="center" width="4"></td><input type="hidden" name="source" value="<? echo $_REQUEST['source'] ?>"> <input type="hidden" name="PostURL" value="<?php echo $_SERVER['REQUEST_URI']; ?>"></td>
			</tr>
			<tr><td align="center" colspan="4"><font face="Verdana, Arial, Helvetica, sans-serif" color="#FF0000"><strong><?php if(isset($_GET['msg'])) echo "Kindly give Valid Details"; ?></strong></font>
	</td></tr>
			<tr>
				<td align="left" colspan="4"  width="230" height="18" ><input class="style4" size="39" value="Full Name" name="Name"  style="float: left" onBlur="onBlurDefault(this,'Full Name');" onFocus="onFocusBlank(this,'Full Name');"><br></td>
			</tr>
			<tr>
		   <td align="left" height="20"><font class="style4">&nbsp;DOB</font></td>
		   <td colspan="4" align="right" height="20">
			<input name="day" value="dd" type="text" id="day" size="4" maxlength="2" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)"; class="style4" onBlur="onBlurDefault(this,'dd');" onFocus="onFocusBlank(this,'dd');">
			<input name="month" id="month" size="4" maxlength="2" onChange="intOnly(this);" value="mm"  onKeyUp="intOnly(this);" onKeyPress="intOnly(this)" class="style4" onBlur="onBlurDefault(this,'mm');" onFocus="onFocusBlank(this,'mm');">
			<input name="year" type="text" id="year" value="yyyy" size="4" maxlength="4" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)"; class="style4" onBlur="onBlurDefault(this,'yyyy');" onFocus="onFocusBlank(this,'yyyy');">
		   </td>

		 </tr>
		 
		 <tr>
				<td align="left"  width="100" height="20"><font class="style4">&nbsp;Mobile No.</font></td>
				<td colspan="4" align="right"  height="20" >
				<font class="style4">+91</font>
				<input size="17" type="text" onChange="intOnly(this);" maxlength="10" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" class="style4" name="Phone"  onFocus="return Decorate('Please give correct Mobile number,to activate your loan request.')"  onBlur="return Decorate1(' ')"><div id="plantype2" style="position:absolute;font-size:10px;width:105px;text-align:center;font-family:verdana;">
				</div></td>
		  </tr>
			<tr>
				<td align="left" colspan="4"  width="230" height="18" ><input class="style4" size="39" value="Email Id" name="Email"  style="float: left"  onblur="onBlurDefault(this,'Email Id');" onFocus="onFocusBlank(this,'Email Id');"><br></td>

			</tr>
			<tr>
		 <td align="left" colspan="4"  width="230" height="20" >
		  <select size="1" align="left" style="width:251"  name="City" onChange="othercity1(this)" class="style4"> <option value="Please Select">Please Select City</option>
                                <option value="Ahmedabad">Ahmedabad</option>
                                <option value="Aurangabad">Aurangabad</option>
                                <option value="Bangalore">Bangalore</option>
                                <option value="Baroda">Baroda</option>
                                <option value="Bhopal">Bhopal</option>
                                <option value="Bhubneshwar">Bhubneshwar</option>
                                <option value="Chandigarh">Chandigarh</option>
                                <option value="Chennai">Chennai</option>
                                <option value="Cochin">Cochin</option>
                                <option value="Coimbatore">Coimbatore</option>
                                <option value="Cuttack">Cuttack</option>
                                <option value="Dehradun">Dehradun</option>
                                <option value="Delhi">Delhi</option>
                                <option value="Faridabad">Faridabad</option>
                                <option value="Gaziabad">Gaziabad</option>
                                <option value="Gurgaon">Gurgaon</option>
                                <option value="Guwahati">Guwahati</option>
                                <option value="Hosur">Hosur</option>
                                <option value="Hyderabad">Hyderabad</option>
                                <option value="Indore">Indore</option>
                                <option value="Jabalpur">Jabalpur</option>
                                <option value="Jaipur">Jaipur</option>
                                <option value="Jamshedpur">Jamshedpur</option>
                                <option value="Kanpur">Kanpur</option>
                                <option value="Kochi">Kochi</option>
                                <option value="Kolkata">Kolkata</option>
                                <option value="Lucknow">Lucknow</option>
                                <option value="Ludhiana">Ludhiana</option>
                                <option value="Madurai">Madurai</option>
                                <option value="Mangalore">Mangalore</option>
                                <option value="Mysore">Mysore</option>
                                <option value="Mumbai">Mumbai</option>
                                <option value="Nagpur">Nagpur</option>
                                <option value="Nasik">Nasik</option>
                                <option value="Navi Mumbai">Navi 
                                  Mumbai</option>
                                <option value="Noida">Noida</option>
                                <option value="Patna">Patna</option>
                                <option value="Pune">Pune</option>
                                <option value="Ranchi">Ranchi</option>
                                <option value="Sahibabad">Sahibabad</option>
                                <option value="Surat">Surat</option>
                                <option value="Thane">Thane</option>
                                <option value="Thiruvananthapuram">Thiruvananthapuram</option>
                                <option value="Trivandrum">Trivandrum</option>
                                <option value="Trichy">Trichy</option>
                                <option value="Vadodara">Vadodara</option>
                                <option value="Vishakapatanam">Vishakapatanam</option>
                                <option value="Others">Others</option>
		
		 </select>
		 
		 </td>
	   </tr>

<tr>
				<td colspan="4" align="center" width="230" height="18" >
				<input size="39" class="style4" disabled value="Other City"   name="City_Other" style="float: left" onBlur="onBlurDefault(this,'Other City');" onFocus="onFocusBlank(this,'Other City');"></td>
		  </tr>
			
			<tr>
				<td colspan="4" align="center" width="230" height="18" >
				<input size="39" class="style4" value="Pincode" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" maxlength="6" name="Pincode" style="float: left" onBlur="onBlurDefault(this,'PinCode');" onFocus="onFocusBlank(this,'Pincode');" maxlength="7"></td>

			</tr>
			
			<tr>
				<td align="left" colspan="4" width="230" height="18" >
				<select align="left" style="width:251" class="style4"  name="Employment_Status">
				<option selected value="-1">Employment Status</option>
				<option  value="1">Salaried</option>
				<option value="0">Self Employed</option>
				</select></td>
			</tr>
			
			<tr>
				<td colspan="4" align="center" width="230" height="18">
				<input size="39" class="style4" name="Company_Name"  value="Company Name" style="float: left" onBlur="onBlurDefault(this,'Company Name');"  onFocus="onFocusBlank(this,'Company Name');"></td>
			</tr>
			
			<tr>
				<td colspan="4" align="left" width="230" height="18">
				<input size="39" value="Annual Income" name="IncomeAmount" id="IncomeAmount" onFocus="this.select();" class="style4"onChange="intOnly(this);"  onKeyUp="intOnly(this);" onKeyPress="intOnly(this); getDigitToWords('IncomeAmount','formatedIncome','wordIncome');"; style="float: left" onBlur="getDigitToWords('IncomeAmount','formatedIncome','wordIncome'); onBlurDefault(this,'Annual Income');"><br> <span id='formatedIncome' style='font-size:11px; font-weight:bold;color:666699;font-Family:Verdana;'></span><span id='wordIncome' style='font-size:11px;
font-weight:bold;color:666699;font-Family:Verdana;text-transform: capitalize;'></span></td>
				
			</tr>
			<tr>
				<td colspan="4" align="left" width="230" height="18">
				<input size="39" value="Loan Amount" name="Loan_Amount"  id="Loan_Amount" onFocus="this.select();" class="style4"onChange="intOnly(this);"  onKeyUp="intOnly(this);"  style="float: left" onKeyDown="getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" onKeyPress="intOnly(this); getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" onBlur="getDigitToWords('Loan_Amount','formatedlA','wordloanAmount'); onBlurDefault(this,'Loan Amount');"><br> <span id='formatedlA' style='font-size:11px; font-weight:bold;color:666699;font-Family:Verdana;'></span><span id='wordloanAmount' style='font-size:11px;
font-weight:bold;color:666699;font-Family:Verdana;text-transform: capitalize;'></span></td>
			</tr>
			 <tr>
			<td align="left" class="style4"  width="100" height="20"><font class="style4">Are you a Credit card holder?</font></td> <td  class="style4"  ><table border="0" >
			<td  align="right"  height="20"><input type="radio"  name="CC_Holder" class="NoBrdr"  value="1"  onclick="addElement();" ><font class="style4">Yes</font></td>
			<td  align="right" height="18">
			<input type="radio" class="NoBrdr" name="CC_Holder" value="0" onClick="removeElement();"><font class="style4"  >No</font></td></tr></table></td>
		</tr>	
	    <tr><td colspan="4" id="myDiv"></td></tr>
		  </table>
		<DIV style="margin-left:27px; margin-right:15px; margin-top:10px;"><input type="checkbox" class="style4" name="accept" checked> 
		<font class="style4">I have read the <a href="http://www.deal4loans.com/Privacy.php" target="_blank">Privacy Policy</a> and agree to the Terms And Condition.</font></DIV><br><br>
		
		<span style="float:right"><input  type="image" src="images/pl/submit99.jpg" style="border: 0px;"></span>
	
	</TD>
	</form>
		<TD WIDTH=12 HEIGHT=566 ROWSPAN=5 background="images/pl/background-right.jpg" ALT="">&nbsp;</TD>
		<TD>
			<IMG SRC="images/pl/spacer.gif" WIDTH=1 HEIGHT=101 ALT=""></TD>
	</TR>
	<TR>
		<TD WIDTH=265 HEIGHT=129 ALT="" bgcolor="#749EC9">
	<ul style="list-style-image:url(images/pl/arrow2.jpg); padding:2px; line-height:20px; margin:0; margin-left:40px; ">
	  <li >Post your Personal loan requirement.</li>
<li>Get & compare Personal loan offers from all Banks.</li>
<li>Get the best deal for your Personal loan.</li></ul></TD>
		<TD>
			<IMG SRC="images/pl/spacer.gif" WIDTH=1 HEIGHT=129 ALT=""></TD>
	</TR>
	<TR>
		<TD WIDTH=265 HEIGHT=123 ALT="" bgcolor="#EBF5FE" valign="top">
	 <div align="justify" style="margin-top:10px; margin-right:5px; margin-left:5px;"><span style="margin-top:15px; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:16px; font-weight:bold; color:#456688;">Deal4loans Testimonials</span><br><br>
		<span class="text"> The one-stop shop for best on all Personal loan requirements
Now get offers from ICICI, HDFC, Deutsche, Citibank, HSBC, Kotak, Standard Chartered ,and IDBI and choose the best deal!</span>
		</div>
		
		&nbsp;</TD>
		<TD>
			<IMG SRC="images/pl/spacer.gif" WIDTH=1 HEIGHT=123 ALT=""></TD>
	</TR>
	<TR>
		<TD WIDTH=265 HEIGHT=96 ALT="" bgcolor="#EBF5FE"><div style="margin-left:5px; "><span style="font:Verdana, Arial, Helvetica, sans-serif; font-size:36px; color:#456688; font-weight:bold"><i>Helpful tips</i></span> <br><span style="font:Verdana, Arial, Helvetica, sans-serif; font-size:20px; color:#456688; font-weight:bold"><i>to get the best</i></span><br> <span style="font:Verdana, Arial, Helvetica, sans-serif; font-size:25px; color:#456688; font-weight:bold"><i>personal loan</i></span> <span style="font:Verdana, Arial, Helvetica, sans-serif; font-size:20px; color:#456688; font-weight:bold"><i>deal.</i></span></div></TD>
		<TD>
			<IMG SRC="images/pl/spacer.gif" WIDTH=1 HEIGHT=96 ALT=""></TD>
	</TR>
	<TR>
	  <TD ROWSPAN=5 WIDTH=265 HEIGHT=382 ALT="" bgcolor="#EBF5FE" valign="top"><div align="justify" style=" margin-top:5px; margin-right:5px; margin-left:5px;"><span class="text" style="margin-top:10px;">Your eligibility & rates for Personal loans are provided on the basis of income, track record with any bank, credit card usage/payments and many more. To get the critical information for personal loan, Apply Now!
As it is an unsecured loan so banks try gauging your intention to pay loan. Customers tend to make mistakes while entering into deals, which is not beneficial to them, so its better to compare all the variables given by different banks before signing a loan agreement. The parameters on the basis of which you can compre a Personal Loan are:</span></div>

<ul style="list-style-image:url(images/pl/arrow3.jpg); line-height:20px; padding:2px; margin:0; margin-left:40px; font:Verdana; font-size:12px;">
	  <li> Eligibility.</li>
   <li>Interest rates best suited.</li>
<li>Processing Fees.</li>
<li>Pre-payment/Foreclosure charges.</li>
<li>Document required.</li>
<li>Turn Around Time.</li>
</ul>
<span style="float:right"><a href="http://www.deal4loans.com/Contents_Personal_Loan_Mustread.php"><img src="images/pl/know-more.jpg" border="0"></a></span></TD>
		<TD>
			<IMG SRC="images/pl/spacer.gif" WIDTH=1 HEIGHT=117 ALT=""></TD>
	</TR>
	<TR>
		<TD COLSPAN=3 bgcolor="#456689" valign="top">
			<IMG SRC="images/pl/Personal_Loan_landing_pa-14.jpg" WIDTH=335 HEIGHT=12 ALT="" ></TD>
		<TD>
			<IMG SRC="images/pl/spacer.gif" WIDTH=1 HEIGHT=12 ALT=""></TD>
	</TR>
	<TR>
		<TD WIDTH=335 HEIGHT=71 COLSPAN=3 valign="middle"  ALT="" bgcolor="#456688">
		  <div align="center"><span class="style5"><img src="images/pl/announcement.jpg" width="31" height="31"> Testimonials</span> </div></TD>
		<TD>
			<IMG SRC="images/pl/spacer.gif" WIDTH=1 HEIGHT=71 ALT=""></TD>
	</TR>
	<TR>
		<TD WIDTH=335 HEIGHT=160 COLSPAN=3 valign="top" background="images/pl/Personal_Loan_landing_pa-16.jpg" style="background-repeat:no-repeat" ALT="">
		
		<div style="margin-left:5px; margin-right:5px; margin-top:10px;"><span class="text">I think that the launch of a service like <a href="http://www.deal4loans.com/index.php">www.deal4loans.com</a> will ease the loan seeking and deal hunting process for the likes of me. I wish u guys all the success.</span></div>
        <div><span style="float:right; font-weight:bold; margin-right :5px;">- Divya</span></div>
	  </TD>
		<TD>
			<IMG SRC="images/pl/spacer.gif" WIDTH=1 HEIGHT=160 ALT=""></TD>
	</TR>
	<TR>
		<TD COLSPAN=3 WIDTH=335 HEIGHT=22 ALT="" bgcolor="#EBF5FE">&nbsp;</TD>
		<TD>
			<IMG SRC="images/pl/spacer.gif" WIDTH=1 HEIGHT=22 ALT=""></TD>
	</TR>
</TABLE>
<!-- End ImageReady Slices -->
<!---Google analytics code-->
<script src="http://www.google-analytics.com/urchin.js"  
type="text/javascript">
</script>
<script type="text/javascript">
_uacct = "UA-1312775-1";
urchinTracker();
</script>
<!-- end of google analytics code-->
</BODY>
</HTML>