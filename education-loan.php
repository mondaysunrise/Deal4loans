<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	
$maxage=date('Y')-62;
$minage=date('Y')-18;

if(strlen($_REQUEST['source'])>0)
{
	$source = $_REQUEST['source'];
}
else
{
	$source="site page";
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Education Loan</title>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<script type="text/javascript" src="/scripts/common.js"></script>
<style type="text/css">

body{
	background-color:#f5f5f5;
	font-family: Arial, Helvetica, sans-serif;
	font-size:13px;
	color:#3c3725;
	margin:0px;
	padding:0px;}
	
input, select{
	border:1px solid #e0e0e0;
	margin:0px;
	padding:0px;
}

.frmbldtxt{
	padding-left:12px;	
}
	
.redtxt{

	color:#b54a0b;
	font-size:17px;
	font-family:Arial, Helvetica, sans-serif;
	font-weight:bold;
	line-height:22px;
 	
}	
.blutxt{
	color:#137aaf;
	font-weight:bold;
	font-size:30px;
 }
 
.brdr{
	background-color:#FFFFFF;
	border-left:1px solid #e8e8e8;
	border-right:1px solid #e8e8e8;
}
.frmbrdr{
	background-color:#e7f7ad;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	color:#45501d;
	font-size:11px;
	font-weight:bold;
	border-left:1px solid #d7e898;
	border-right:1px solid #d7e898;
}
.frmhdng{
	background:url(new-images/edu/frmhdng1.gif) no-repeat center top;
 	color:#3d3d3d;
	font-size:16px;
	font-weight:bold;
	font-family:Arial, Helvetica, sans-serif;
	height:36px;
	line-height:35px;
}

.txthdng{
	background:url(new-images/edu/hdngbg.gif) no-repeat left top;
	font-size:12px;
	font-family:Verdana, Arial, Helvetica, sans-serif;
	font-weight:bold;
	text-indent:30px;
	color:#3d3d3d;
	height:34px;
  	line-height:32px;
}
	
</style>
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
	//alert(periodPos);
	//alert(email.length);
	if (periodPos+3 > email1.length)	
	{		// must be at least 2 characters after the "."
		alert("Invalid E-mail ID.");
		return false;
		
	}
	return true;
}


function chkeducaionloan(Form)
{
	
	var myOption;
	var i;
	var newmyOption;
	var j;
var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
var dt,mdate;dt=new Date();
var alpha=/^[a-zA-Z\ ]*$/;
var alphanum=/^[a-zA-Z0-9]*$/;
var num=/^[0-9]*$/;
var space=/^[\ ]*$/;
var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";

if((Form.Name.value=="") || (Form.Name.value=="Name")|| (Trim(Form.Name.value))==false)
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
myOption = -1;
		for (i=Form.gender.length-1; i > -1; i--) {
			if(Form.gender[i].checked) {
							myOption = i;
	
			}
		}
	
		if (myOption == -1) 
		{
			alert("Please select Gender.");
			return false;
		}

if((Form.Phone.value=='Mobile No') || (Form.Phone.value=='') || Trim(Form.Phone.value)==false)
{
alert("Kindly fill in your Mobile Number!");
Form.Phone.focus();
return false;
}
 else if(isNaN(Form.Phone.value)|| Form.Phone.value.indexOf(" ")!=-1)
		{
              alert("Enter numeric value in ");
			  Form.Phone.focus();
			  return false;  
		}
        else if (Form.Phone.value.length < 10 )
		{
                alert("Please Enter 10 Digits"); 
				 Form.Phone.focus();
				return false;
        }
else if ((Form.Phone.value.charAt(0)!="9") && (Form.Phone.value.charAt(0)!="8") && (Form.Phone.value.charAt(0)!="7"))
		{
                alert("The number should start only with 9 or 8 or 7");
				 Form.Phone.focus();
                return false;
        }

if(Form.Email.value!="Email Id")
{
	if (!validmail(Form.Email.value))
	{
		//alert("Please enter your valid email address!");
		Form.Email.focus();
		return false;
	}
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

newmyOption = -1;
		for (j=Form.Collateral_Security.length-1; j > -1; j--) {
			if(Form.Collateral_Security[j].checked) {
				newmyOption = j;
	
			}
		}
	
		if (newmyOption == -1) 
		{
			alert("Please tell your offer Collateral Security or not.");
			return false;
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

function othercity1()
{
if(document.eduloan_form.City.value=='Others')
{
document.eduloan_form.City_Other.disabled=false;
}
else
{document.eduloan_form.City_Other.disabled=true;
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

function addOtherCity()
{
		var ni = document.getElementById('getothercity');
		if(document.eduloan_form.City.value=="Others")
		{
			ni.innerHTML = '<table border="0" width="100%"><tr><td height="26" align="left" class="frmbldtxt">Other City :</td><td height="28" align="right" class="frmbldtxt" style="padding-right:10px;"><input type="text" name="City_Other" id="City_Other" style="width:160px;"></td></tr></table>';	
		}
		else
		{
			ni.innerHTML = '';
		}
		return true;
	}


</script>
</head>

<body>
<table width="835" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="148" height="185" align="left" valign="top"><img src="new-images/edu/hdr1.gif" width="148" height="185"></td>
        <td width="142" height="185" align="left"><img src="new-images/edu/hdr2.gif" width="142" height="185"></td>
        <td width="335" height="185" valign="top" background="new-images/edu/education-hdr.gif"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="40" >&nbsp;</td>
          </tr>
          <tr>
            <td height="40" valign="top" class="blutxt">Education Loan </td>
          </tr>
          <tr>
            <td valign="top" class="redtxt">Finance your Higher Education <br>
      to unlock your Professional Success</td>
          </tr>
        </table></td>
        <td width="158" align="right"><img src="new-images/edu/hdr-logo.gif" width="234" height="185"></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td class="brdr" style="padding-top:10px; "> <table width="813" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="33" align="left" class="txthdng">3 step to your Education Loan </td>
          </tr>
          <tr>
            <td align="left" height="6"></td>
          </tr>
          <tr>
            <td align="left"><table width="97%"  border="0" align="right" cellpadding="0" cellspacing="0">
              <tr>
                <td width="4%"><img src="new-images/edu/arrow.gif" width="6" height="9"></td>
                <td width="96%" height="22">Post your Loan requirement</td>
              </tr>
              <tr>
                <td width="4%"><img src="new-images/edu/arrow.gif" width="6" height="9"></td>
                <td height="22">Get &amp; Compare Offers from various Banks </td>
              </tr>
              <tr>
                <td width="4%"><img src="new-images/edu/arrow.gif" width="6" height="9"></td>
                <td height="22">Choose the lowest Loan Quote
</td>
              </tr>
              <tr>
                <td colspan="2" height="15"></td>                 
              </tr>
            </table></td>
          </tr>
          
          <tr>
            <td height="33" align="left" class="txthdng">Get Loan Quotes from </td>
          </tr>
		  <tr>
            <td height="10"></td>
          </tr>
          <tr>
            <td ><table width="97%"  border="0" align="right" cellpadding="0" cellspacing="0">
              <tr>
                <td width="4%">&nbsp;</td>
                <td width="96%"><img src="new-images/edu/bank-logo.gif" width="404" height="40"></td>
              </tr>
            </table></td>
          </tr>
              <tr>
                <td colspan="2" height="15"></td>                 
              </tr>
          <tr>
            <td height="33" align="left" class="txthdng">Benefits of Education Loan</td>
          </tr>
		    <tr>
            <td align="left" height="6"></td>
          </tr>
          <tr>
            <td><table width="97%"  border="0" align="right" cellpadding="0" cellspacing="0">
              <tr>
                <td width="4%"><img src="new-images/edu/arrow.gif" width="6" height="9"></td>
                <td width="96%" height="22">Borrow upto cost of Education</td>
              </tr>
              <tr>
                <td width="4%"><img src="new-images/edu/arrow.gif" width="6" height="9"></td>
                <td height="22">No repayment of loan while studying</td>
              </tr>
              <tr>
                <td width="4%"><img src="new-images/edu/arrow.gif" width="6" height="9"></td>
                <td height="22">No burden on parents</td>
              </tr>
              <tr>
                <td width="4%"><img src="new-images/edu/arrow.gif" width="6" height="9"></td>
                <td height="22">Low Rate of Interest</td>
              </tr>
              <tr>
                <td width="4%"><img src="new-images/edu/arrow.gif" width="6" height="9"></td>
                <td height="22">Quick Loan Sanction</td>
              </tr>
              <tr>
                <td colspan="2" height="15"></td>                 
              </tr>
            </table></td>
          </tr>
          <tr>
            <td height="33" align="left" class="txthdng">Testimonial</td>
          </tr>
          <tr>
            <td align="left" height="6"></td>
          </tr>
          <tr>
            <td align="left" >Delhi Education Loan<br>
              I am glad that i could get my loan approval in just 48 hours. Its like dream<br>
              come true now I can take my higher studies without burdening my<br>
              parents. Good Luck team &amp; thanks for getting my education loan disbursed.<br></td>
          </tr>
              <tr>
                <td colspan="2" height="15"></td>                 
              </tr>
          <tr>
            <td height="61" background="new-images/edu/tipsbg.gif" style="background-repeat:no-repeat; "><table width="95%"  border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td height="25"><b>Helpful Tips </b></td>
              </tr>
              <tr>
                <td>Do not wait till last minute apply for education loan before admission.</td>
              </tr>
            </table></td>
          </tr>
        </table></td>
        <td width="370" align="right" valign="top"><table width="360"  border="0" cellpadding="0" cellspacing="0" bgcolor="#ebf8ff">
          <tr>
            <td width="360" height="8" valign="top"><img src="new-images/edu/formtp1.gif" width="360" height="8"></td>
          </tr>
          <tr>
            <td class="frmbrdr"><form name="eduloan_form" action="education-loan-continue.php" method="POST" onSubmit="return chkeducaionloan(document.eduloan_form);"><table width="92%"  border="0" align="center" cellpadding="0" cellspacing="0">
              <tr align="center">
                <td height="36" colspan="2" align="center" class="frmhdng">Apply Education Loan</td>
              </tr>
              <tr>
                <td height="6" colspan="2" ></td>
              </tr>
              <tr>
                <td width="43%" height="26" align="left" valign="middle" class="frmbldtxt" style="padding-top:3px; ">Full Name :</td>
                <td width="57%" align="left" valign="middle" class="frmbldtxt"  style="padding-top:3px; ">
                <input type="hidden" name="source" id="source" value="Landing Page" />
                <input type="text" name="Name" id="Name" style="width:160px;" maxlength="30"  /></td>
              </tr>
              <tr>
                <td height="26" align="left" valign="middle" class="frmbldtxt">DOB :</td>
                <td align="left" valign="middle" class="frmbldtxt"><input name="day" type="text" id="day"  value="DD" style="  width:38px; " onblur="onBlurDefault(this,'dd');" onfocus="onFocusBlank(this,'dd');" maxlength="2" onkeyup="intOnly(this);" onkeypress="intOnly(this);" />
                    <input  name="month" type="text" id="month" style="width:38px; " value="MM" onblur="onBlurDefault(this,'mm');" onfocus="onFocusBlank(this,'mm');" maxlength="2" onkeyup="intOnly(this);" onkeypress="intOnly(this);" />
                    <input name="year" type="text" id="year" style="width:67px; " value="YYYY" onblur="onBlurDefault(this,'yyyy');" onfocus="onFocusBlank(this,'yyyy');" maxlength="4" onkeyup="intOnly(this);" onkeypress="intOnly(this);" /></td>
              </tr>
              <tr>
                <td height="26" align="left" valign="middle" class="frmbldtxt">Gender :</td>
                <td align="left" valign="middle" class="frmbldtxt"><input type="radio" value="male" name="gender" style="border:0px; " />
  Male &nbsp;
  <input type="radio" value="female" name="gender" style="border:0px; "/>
  Female</td>
              </tr>
              <tr>
                <td height="26" align="left" class="frmbldtxt">Mobile No. : </td>
                <td align="left" class="frmbldtxt" style="font-weight:normal; ">+91 <input type="text" name="Phone" id="Phone"  style="width:133px;" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);"  maxlength="10" /></td>
              </tr>
              <tr>
                <td height="26" align="left" class="frmbldtxt">Email ID : </td>
                <td align="left" class="frmbldtxt"><input type="text" name="Email" id="Email"  style="width:160px;" /></td>
              </tr>
              <tr valign="middle">
                <td height="26" align="left" class="frmbldtxt">Residence City :</td>
                <td height="28" align="left" class="frmbldtxt"><select name="City" id="City" style="width:164px;" onchange="addOtherCity();">
                    <?=getCityList1($City)?>
                </select></td>
              </tr>
              <tr><td  colspan="2" id="getothercity"></td>
  </tr>
              
              <tr valign="middle">
                <td height="26" align="left" class="frmbldtxt" style="padding-top:3px; ">Country of Study :</td>
                <td height="28" align="left" class="frmbldtxt"  style="padding-top:3px; "><select name="Country" id="Country" style="width:164px;">
                    <option value="1">India</option>
                    <option value="2">UK</option>
                    <option value="3">USA</option>
                    <option value="4">Other Country</option>
                </select></td>
              </tr>
              <tr valign="middle">
                <td height="26" align="left" class="frmbldtxt">Course of Study :</td>
                <td height="28" align="left" class="frmbldtxt"><select name="Course" id="Course" style="width:164px;" onchange="othercity1();">
                    <option value="1">MBA</option>
                    <option value="2">Post Graduation Courses</option>
                    <option value="3">Graduation Courses</option>
                    <option value="4">Other Courses</option>
                </select></td>
              </tr>
              <tr>
                <td height="26" align="left" class="frmbldtxt">Loan Amount :</td>
                <td align="left" class="frmbldtxt"><input name="Loan_Amount" id="Loan_Amount" type="text" style="width:160px;" maxlength="10" onfocus="this.select();" onchange="ShowHide('loanShow','Loan_Amount');"  onkeyup="intOnly(this);getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');"  onkeydown="getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" onkeypress="intOnly(this); getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" onblur="getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" />
                </td>
              </tr>
			  <tr>
                <td colspan="2" class="frmbldtxt"><span id='formatedlA' style='font-size:11px;
font-weight:normal; color:#333333;font-Family:Verdana;'></span><span id='wordloanAmount' style='font-size:11px;
font-weight:normal; color:#333333;font-Family:Verdana;text-transform: capitalize;'></span></td>
              </tr>
              <tr>
                <td height="26" align="left" class="frmbldtxt">Collateral Security :</td>
                <td height="28" align="left"  class="frmbldtxt"><input type="radio" value="Yes" name="Collateral_Security" id="Collateral_Security" style="border:0px; "/>
    Yes &nbsp;
    <input type="radio" value="No" name="Collateral_Security" style="border:0px; "/>
    No</td>
              </tr>
              <tr align="left">
                <td colspan="2" valign="middle" class="frmbldtxt" style="font-weight:normal; font-size:11px; padding-left:12px;  "><input type="checkbox" name="accept" style="border:none;" checked>
I authorize Deal4loans.com & its partnering banks to contact me to explain the product & I Agree to <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow">privacy policy</a> and <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow">Terms and Conditions</a>.</td>
              </tr>
              <tr>
                <td align="center" valign="bottom" height="50" colspan="2" ><input type="submit" style="border: 0px none ; background-image: url(new-images/edu/get-quote-grn.gif); width: 172px; height: 36px; margin-bottom: 0px;" value=""/></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
            </table></form></td>
          </tr>
          <tr>
            <td width="360" height="8" align="left" valign="bottom"><img src="new-images/edu/formbt1.gif" width="360" height="8"></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td width="835" height="12"><img src="new-images/edu/brdr-btm.gif" width="835" height="12"></td>
  </tr>
</table>
</body>
</html>
