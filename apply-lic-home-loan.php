<?php
	require 'scripts/functions.php';

$maxage=date('Y')-62;
$minage=date('Y')-18;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<link href="style/new-bima.css" rel="stylesheet"  type="text/css" />
<script type="text/javascript" src="scripts/common.js"></script>
<script Language="JavaScript">
function addIdentified()
{
		var ni = document.getElementById('myDiv1');
		ni.innerHTML = '<table width="100%" align="left" border="0"><tr><td height="20"  align="left" valign="middle" class="frmbldtxt" width="46%"><b style="color:#373737;">Property Location</b></td>	<td colspan="3" align="left" height="20" class="frmbldtxt">&nbsp;&nbsp;&nbsp;<select style="width:150px;" name="Property_Loc" id="Property_Loc" tabindex="16"><?=getCityList1($City)?></select></td></tr></table>';
		return true;
}	
	
function removeIdentified()
{
		var ni = document.getElementById('myDiv1');
		ni.innerHTML = '<table border="0"><tr><td height="20" colspan="2" align="left" valign="center" class="subheading"><input type="checkbox" name="updateProperty" style="border:none;" ><span class="form-text">&nbsp;Can we tell you about some properties</font></td></tr></table>';
		return true;

}

function addOthercity()
{
		var ni = document.getElementById('myDiv_oc');
		if(document.loan_form.City.value=="Others")
		{
		ni.innerHTML = '<table width="100%" align="left" border="0"><tr><td height="28" align="left" class="frmbldtxt" width="48%">Other City :</td> <td height="28" class="frmbldtxt"><input type="text" name="City_Other" value="Other City" onfocus="this.select();" style="width:148px;" tabindex="8" /></td></tr></table>';
		}
		else
		{
				ni.innerHTML='';
		}
		
			
		return true;
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
	//alert(periodPos);
	//alert(email.length);
	if (periodPos+3 > email1.length)	
	{		// must be at least 2 characters after the "."
		alert("Invalid E-mail ID.");
		return false;
		
	}
	return true;
}
function chkform()
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
		alert("Please fill your Full Name.");
		document.loan_form.Name.focus();
		return false;
	}
	if(document.loan_form.Name.value!="")
	{
	 if(containsdigit(document.loan_form.Name.value)==true)
	{
	alert("First Name contains numbers!");
	document.loan_form.Name.focus();
	return false;
	}
	}
  for (var i = 0; i <document.loan_form.Name.value.length; i++) {
  	if (iChars.indexOf(document.loan_form.Name.value.charAt(i)) != -1) {
  	alert ("First Name has special characters.\n Please remove them and try again.");
	document.loan_form.Name.focus();
 	return false;
  	}
  }
	if(document.loan_form.day.value=="" || document.loan_form.day.value=="DD")
	{
		alert("Please fill your day of birth.");
		document.loan_form.day.focus();
		return false;
	}
	if(document.loan_form.day.value!="")
	{
	 if((document.loan_form.day.value<1) || (document.loan_form.day.value>31))
	{
	alert("Kindly Enter your valid Date of Birth(Range 1-31)");
	document.loan_form.day.focus();
	return false;
	}
	}
	if(!checkData(document.loan_form.day, 'Day', 2))
		return false;
	
	if(document.loan_form.month.value=="" || document.loan_form.month.value=="MM")
	{
		alert("Please fill your month of birth.");
		document.loan_form.month.focus();
		return false;
	}
	if(document.loan_form.month.value!="")
	{
	if((document.loan_form.month.value<1) || (document.loan_form.month.value>12))
	{
	alert("Kindly Enter your valid Month of Birth(Range 1-12)");
	document.loan_form.month.focus();
	return false;
	}
	}
	if(!checkData(document.loan_form.month, 'month', 2))
		return false;

	if(document.loan_form.year.value=="" || document.loan_form.year.value=="YYYY")
	{
		alert("Please fill your year of birth.");
		document.loan_form.year.focus();
		return false;
	}
		if(document.loan_form.year.value!="")
	{
	  if((document.loan_form.year.value < "<?php echo $maxage;?>") || (document.loan_form.year.value > "<?php echo $minage;?>"))
	{
		alert("Age Criteria! \n Applicants between age group 18 - 62 only are elgibile.");
		document.loan_form.year.focus();
		return false;
		}
	}
	if(!checkData(document.loan_form.year, 'Year', 4))
		return false;
	if(document.loan_form.Phone.value=="")
	{
		alert("Please fill your mobile number.");
		document.loan_form.Phone.focus();
		return false;
	}
	 if(isNaN(document.loan_form.Phone.value)|| document.loan_form.Phone.value.indexOf(" ")!=-1)
		{
              alert("Enter numeric value");
			  document.loan_form.Phone.focus();
			  return false;  
		}
        if (document.loan_form.Phone.value.length < 10 )
		{
                alert("Please Enter 10 Digits"); 
				 document.loan_form.Phone.focus();
				return false;
        }
        if ((document.loan_form.Phone.value.charAt(0)!="9") && (document.loan_form.Phone.value.charAt(0)!="8") && (document.loan_form.Phone.value.charAt(0)!="7"))
		{
                alert("The number should start only with 9 or 8 or 7");
				 document.loan_form.Phone.focus();
                return false;
        }
		if(document.loan_form.Email.value=="")
	{
		alert("Please fill your Email.");
		document.loan_form.Email.focus();
		return false;
	}

	 if(document.loan_form.Email.value!="")
	{
		if (!validmail(document.loan_form.Email.value))
		{
			//alert("Please enter your valid email address!");
			document.loan_form.Email.focus();
			return false;
		}
	}
	
	if (document.loan_form.City.selectedIndex==0)
	{
		alert("Please enter City Name to Continue");
		document.loan_form.City.focus();
		return false;
	}
	if((document.loan_form.City.value=="Others") && (document.loan_form.City_Other.value=="" || document.loan_form.City_Other.value=="Other City"  ) || !isNaN(document.loan_form.City_Other.value))
	{
		alert("Kindly fill your Other City!");
		document.loan_form.City_Other.focus();
		return false;
	}
/*	for (var i = 0; i <document.loan_form.City_Other.value.length; i++) {
  	if (iChars.indexOf(document.loan_form.City_Other.value.charAt(i)) != -1) {
  	alert ("Other city has special characters.\n Please remove them and try again.");
	document.loan_form.City_Other.focus();
  	return false;
  	}
  }*/
	if (document.loan_form.Pincode.value=="")
	{
		alert("Please enter Pincode.");
		document.loan_form.Pincode.focus();
		return false;
	}
	if (document.loan_form.Pincode.value!="")
	{
		if(document.loan_form.Pincode.value.length < 6)
	{
		alert("Kindly fill in your Pincode(6 Digits)!");
		document.loan_form.Pincode.focus();
		return false;
	}
	}
	
	if (document.loan_form.Employment_Status.selectedIndex==0)
	{
		alert("Please select Employment Status to Continue");
		document.loan_form.Employment_Status.focus();
		return false;
	}
	
	if (document.loan_form.Net_Salary.value=="")
	{
		alert("Please enter Annual Income.");
		document.loan_form.Net_Salary.focus();
		return false;
	}	
	if(!checkNum(document.loan_form.Net_Salary, 'Annual Income',0))
		return false;

if (document.loan_form.Loan_Amount.value=="")
	{
		alert("Please enter Loan Amount.");
		document.loan_form.Loan_Amount.focus();
		return false;
	}	
	if(!checkNum(document.loan_form.Loan_Amount, 'Loan Amount',0))
		return false;

for(j=0; j<document.loan_form.Property_Identified.length; j++) 
	{
	//alert(document.loan_form.Property_Identified.length);
        if(document.loan_form.Property_Identified[j].checked)
		{
   	 		cnt= j;
		}
	}
		if(cnt == -1) 
		{
			alert("please select you have identified any property or not");
			return false;
		}
		if(cnt ==0)
		{ 
			if(document.loan_form.Property_Loc.selectedIndex==0)
			{
				alert("Plese select city where property is located");
				document.loan_form.Property_Loc.focus();
				return false;
			}
		}
		
	
		if(!document.loan_form.accept.checked)
	{
	alert("Accept the Terms and Condition");
	document.loan_form.accept.focus();
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


 function showdetailsFaq(d,e)
			{			
				for(j=1;j<=e;j++)
					{
						if(d==j)
							{
								if(eval(document.getElementById("divfaq"+j)).style.display=='none')
									{
									
										eval(document.getElementById("divfaq"+j)).style.display=''
										//eval(document.getElementById("imgfaq"+j)).src='images/minus2.gif'
									}
								else
									{
										
										eval(document.getElementById("divfaq"+j)).style.display='none'
										//eval(document.getElementById("imgfaq"+j)).src='images/plus2.gif'
									}
							}
						
					}
			}
</script>

</head>

<body>
<table align="center">
<tr>
<td height="30" align="center" style="background-image:url(new-images/lic-bckgrnd.jpg); background-repeat:repeat; width:979px; border:none;"> <img src="new-images/logon.jpg" /><img src="new-images/d4l_sml_logo.jpg" /></td></tr>
<tr>
<td height="15" align="center" style="background-color:#B50722; padding:10px;"></td></tr>
<tr>
<td height="15" align="center" 
>
<form name="loan_form" method="post" action="apply-lic-home-loan-continue.php" onSubmit="return chkform();">
<input type="hidden" name="source" value="<? echo $retrivesource; ?>">
 <table width="458" cellpadding="0" cellspacing="0" border="0">
   <tr>
     <td  valign="middle" style="background-repeat:no-repeat;">&nbsp;</td>
   </tr>
   <tr>
     <td height="70" valign="middle" background="new-images/apl-tp.gif" style="background-repeat:no-repeat;" align="center"><h4>Apply Here</h4></td>
   </tr>
   <tr>
          <td valign="top" class="aplfrm" style="padding-left:25px; "><table width="380" border="0" align="center" cellpadding="4" cellspacing="0" id="frm">
   <tr>
     <td class="frmbldtxt">Name</td>
     <td class="frmbldtxt"><input type="text" name="Name" id="Name" style="width:148px;" maxlength="30"  onchange="insertData();" tabindex="1" /></td>
   </tr>
   <tr>
     <td class="frmbldtxt">DOB</td>
     <td class="frmbldtxt"><input name="day" type="text" id="day"  value="DD" style="  width:35px; " onblur="onBlurDefault(this,'dd');" onfocus="onFocusBlank(this,'dd');" maxlength="2" onkeyup="intOnly(this);" onkeypress="intOnly(this);" tabindex="2"/>
         <input  name="month" type="text" id="month" style="width:35px; " value="MM" onblur="onBlurDefault(this,'mm');" onfocus="onFocusBlank(this,'mm');" maxlength="2" onkeyup="intOnly(this);" onkeypress="intOnly(this);" tabindex="3"/>
         <input name="year" type="text" id="year" style="width:63px; " value="YYYY" onblur="onBlurDefault(this,'yyyy');" onfocus="onFocusBlank(this,'yyyy');" maxlength="4" onkeyup="intOnly(this);" onkeypress="intOnly(this);" onchange="insertData();" tabindex="4"/></td>
   </tr>
   <tr>
     <td class="frmbldtxt">Mobile</td>
     <td class="frmbldtxt">+91
       <input type="text" style="width:120px;" name="Phone" id="Phone" maxlength="10"   onkeyup="intOnly(this);" onkeypress="intOnly(this)"; onchange="intOnly(this);insertData();" onblur="return Decorate1(' ')" tabindex="5"/></td>
   </tr>
   <tr>
     <td class="frmbldtxt">Email ID</td>
     <td class="frmbldtxt"><input type="text" name="Email" id="Email"  style="width:148px;" onchange="insertData();" tabindex="6" /></td>
   </tr>
   <tr>
     <td class="frmbldtxt">City</td>
     <td class="frmbldtxt"><select name="City" id="City" style="width:150px;" onchange="addOthercity();" tabindex="7">
         <?=getCityList($City)?>
       </select>
         <!---Other city--></td>
   </tr>
   <tr>
     <td colspan="2" class="frmbldtxt"><div id="myDiv_oc"></div></td>
   </tr>
   <tr>
     <td class="frmbldtxt">Pincode</td>
     <td class="frmbldtxt"><input type="text" name="Pincode" onfocus="this.select();" style="width:148px;" maxlength="6" onkeypress="intOnly(this);" onkeyup="intOnly(this);"   tabindex="9" /></td>
   </tr>
   <tr>
     <td class="frmbldtxt">Occupation</td>
     <td class="frmbldtxt"><select name="Employment_Status"  id="Employment_Status" style="width:150px;" tabindex="10" >
         <option value="-1">Employment Status</option>
         <option value="1">Salaried</option>
         <option value="0">Self Employment</option>
     </select></td>
   </tr>
   <tr>
     <td class="frmbldtxt">Annual Income</td>
     <td class="frmbldtxt"><input type="text" name="Net_Salary" id="Net_Salary" style="width:148px;" onkeyup="intOnly(this); getDigitToWords('Net_Salary','formatedIncome','wordIncome');" onkeypress="intOnly(this);"  onblur="getDigitToWords('Net_Salary','formatedIncome','wordIncome');"  onchange="ShowHide('incomeShow','Net_Salary');" tabindex="11" /></td>
   </tr>
   <tr>
     <td colspan="2" class="frmbldtxt"><span id='formatedIncome' style='font-size:11px;
	font-weight:normal; color:#333333;font-Family:Verdana;'></span> <span id='wordIncome' style='font-size:11px;
	font-weight:normal; color:#333333;font-Family:Verdana;text-transform: capitalize;'></span></td>
   </tr>
   <tr>
     <td class="frmbldtxt">Loan Amount</td>
     <td class="frmbldtxt"><input name="Loan_Amount" id="Loan_Amount" tabindex="12" type="text" style="width:148px;" maxlength="10" onfocus="this.select();" onchange="ShowHide('loanShow','Loan_Amount');"  onkeyup="intOnly(this);getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');"  onkeydown="getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" onkeypress="intOnly(this); getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" onblur="getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" /></td>
   </tr>
   <tr>
     <td colspan="2" class="frmbldtxt"><span id='formatedlA' style='font-size:11px;
font-weight:normal; color:#333333;font-Family:Verdana;'></span><span id='wordloanAmount' style='font-size:11px;
font-weight:normal; color:#333333;font-Family:Verdana;text-transform: capitalize;'></span></td>
   </tr>
   <tr>
     <td class="frmbldtxt">Property Value</td>
     <td class="frmbldtxt"><input type="text" name="property_value"  id="property_value" style="width:148px;" maxlength="30"   onkeyup="intOnly(this);" onkeypress="intOnly(this);" tabindex="13" /></td>
   </tr>
   <tr>
     <td class="frmbldtxt">Property Identified</td>
     <td class="frmbldtxt"><input type="radio" name="Property_Identified" id="Property_Identified" value="1" onclick="addIdentified();" style="border:none;" tabindex="14" />
       Yes&nbsp;&nbsp;
       <input type="radio"  name="Property_Identified" id="Property_Identified" onclick="removeIdentified();" value="0" style="border:none;" tabindex="15" />
       No</td>
   </tr>
   <tr>
     <td colspan="2" class="frmbldtxt"><div id="myDiv1"></div></td>
   </tr>
   <tr>
     <td class="frmbldtxt">Total Monthly EMI for all running loans :</td>
     <td class="frmbldtxt"><input type="text" name="obligations" id="obligations" style="width:148px;"    onkeyup="intOnly(this);" onkeypress="intOnly(this);" tabindex="17" /></td>
   </tr>
   <tr>
     <td height="22" colspan="2" align="left" class="frmbldtxt"><input type="checkbox" name="co_appli" id="co_appli" value="1" onclick="return showdetailsFaq(1,12);" style="border:none;" tabindex="18" />
       &nbsp; Co- Applicant</td>
   </tr>
   <tr>
     <td  colspan="5" align="left" class="frmbldtxt"><div style="display:none; " id="divfaq1">
         <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" style="border-top:#0000FF dashed 1px;">
           <tr>
             <td width="62%" class="frmbldtxt" height="30"><b>Co-Applicant Name :</b></td>
             <td width="38%" align="left"><input type="text" name="co_name" id="co_name" style="width:148px;" tabindex="19" maxlength="30" value="<?php echo $co_name; ?>" />             </td>
           </tr>
           <tr>
             <td width="11%" align="left" class="frmbldtxt"><b>Co-Applicant DOB : </b></td>
             <td width="21%" align="left"><input onfocus="insertData();" name="co_day" type="text" id="co_day" style="width:40px;" maxlength="2" onchange="intOnly(this);" onkeyup="intOnly(this);" onkeypress="intOnly(this)"; value="DD" tabindex="20" />
                 <input name="co_month" type="text" id="co_month" style="width:40px;" maxlength="2" onchange="intOnly(this);" onkeyup="intOnly(this);" onkeypress="intOnly(this);" value="MM" tabindex="21" />
                 <input name="co_year" type="text" id="co_year" style="width:53px;" maxlength="4" onchange="intOnly(this);" onkeyup="intOnly(this);" onkeypress="intOnly(this);" value="YYYY" tabindex="22" /></td>
           </tr>
           <tr>
             <td width="16%" height="30" class="frmbldtxt"><b>Co-Applicant Net Monthly Income : </b></td>
             <td width="17%" align="left" class="frmbldtxt"><input type="text" name="co_monthly_income" id="co_monthly_income" style="width:148px;" value="<?php echo $income; ?>"  onkeyup="intOnly(this);" onkeypress="intOnly(this);" tabindex="23" />             </td>
           </tr>
           <tr>
             <td height="30"  class="frmbldtxt"><b> Total Monthly EMI for all running loans : </b></td>
             <td align="left" class="frmbldtxt"><input type="text" name="co_obligations" id="co_obligations" tabindex="24" style="width:148px;" value="<?php echo $obligations; ?>"  onkeyup="intOnly(this);" onkeypress="intOnly(this);" />             </td>
           </tr>
         </table>
     </div></td>
   </tr>
   <tr>
             <td height="22" colspan="2" align="left" class="frmbldtxt" style="font-weight:normal; "><input type="checkbox" name="accept" style="border:none;" checked>
              I authorize Deal4loans.com & its partnering Banks to call me with reference to my loan application  & Agree to <a href="http://www.deal4loans.com/Privacy.php" target="_blank">Privacy Policy</a> and <a href="http://www.deal4loans.com/Privacy.php" target="_blank">Terms and Conditions</a>.</td>
			  </tr>
			  <tr>
			  <td colspan="2" align="center"><input type="submit" style="border: 0px none ; background-image: url(new-images/quote-btn.jpg); width: 128px; height: 31px; margin-bottom: 0px;" value=""/></td>
           </tr>
  
 </table>
 </td></tr>
  <tr>
          <td width="458" height="26" align="center"><img src="../new-images/apl-bt.gif" width="458" height="26" /></td>
      </tr>
 </table>
</form></td>
</tr>
 
</table>
</body>
</html>
