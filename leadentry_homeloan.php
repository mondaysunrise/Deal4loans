<?php
require 'scripts/functions.php';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<script type="text/javascript" src="/scripts/common.js"></script>
<script type="text/javascript">
function othercity1(form)
{	

	if(document.getElementById('City').value=='Others')
	{
		document.getElementById('City_Other').disabled=false;
		document.getElementById('City_Other').focus();
	}
	else
	{
		document.getElementById('City_Other').disabled=true;
		document.getElementById('City_Other').focus();
	}
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


function addIdentified()
{
		var ni = document.getElementById('myDiv1');
				
		if(ni.innerHTML=="")
		{
				
			if(document.home_loan.Property_Identified.value="on")
			{
				
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '<table border="0"><tr><td height="20"  align="left" valign="middle" class="formtext" width="172"><span class="form-text">Property Location</span></td>	<td colspan="3" align="left" height="20" >&nbsp;&nbsp;&nbsp;<select style="width:147px;" name="Property_Loc" id="Property_Loc"><?=getCityList1($City)?></select></td></tr></table>';
			}
			
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
if((Form.IncomeAmount.value=='')||(Form.IncomeAmount.value=="Annual Income"))
	{
		alert("Please enter Annual income to Continue");
		Form.IncomeAmount.focus();
		return false;
	}
	if(Form.day.value=="" || Form.day.value=="dd")
	{
		alert("Please fill your day of birth.");
		Form.day.focus();
		return false;
	}
	if(Form.day.value!="")
	{
	 if((Form.day.value<1) || (Form.day.value>31))
	{
	alert("Kindly Enter your valid Date of Birth(Range 1-31)");
	Form.day.focus();
	return false;
	}
	}
	if(!checkData(Form.day, 'Day', 2))
		return false;
	
	if(Form.month.value=="" || Form.month.value=="mm")
	{
		alert("Please fill your month of birth.");
		Form.month.focus();
		return false;
	}
	if(Form.month.value!="")
	{
	if((Form.month.value<1) || (Form.month.value>12))
	{
	alert("Kindly Enter your valid Month of Birth(Range 1-12)");
	Form.month.focus();
	return false;
	}
	}
	if(!checkData(Form.month, 'month', 2))
		return false;

	if(Form.year.value=="" || Form.year.value=="yyyy")
	{
		alert("Please fill your year of birth.");
		Form.year.focus();
		return false;
	}
		if(Form.year.value!="")
	{
	  if((Form.year.value < "1947") || (Form.year.value >"1990"))
	{
		alert("Age Criteria! \n Applicants between age group 18 - 62 only are elgibile.");
		Form.year.focus();
		return false;
		}
	}
	if(!checkData(Form.year, 'Year', 4))
		return false;
	
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

</script>
</head>

<body>
<table width="500"  border="0" cellspacing="2" cellpadding="2" align="center" style="border:1px solid #c2c2c2;">
	<tr>
	<td width="289" height="50" align="center" valign="top" class="bldtxt"><h2> Home Loan</h2></td>
	</tr>
	<tr>
	<td valign="top" >
			<form name="home_loan" action="leadentry_homeloan_continue.php" onSubmit="return submitform(document.home_loan);" method="post">
			<table width="93%" border="0" align="right" cellpadding="0" cellspacing="0">
			<tr>
			<td width="116" height="26" align="left" valign="middle" class="bldtxt">First Name</td>
			<td width="166" class="bldtxt">
			<INPUT TYPE="hidden" NAME="onCloseValue" id="onCloseValue" value="1">
			<input type="text" name="Name" id="Name" value="<? if(isset($loan_type)) {  echo $name;  }?>"  style="width:140px;"/></td>
			</tr>
			<tr>
			<td width="116" height="26" align="left" valign="middle" class="bldtxt">Mobile</td>
			<td class="bldtxt"><font class="style4">+91</font>
			<input type="text"  style="width:113px;" maxlength="10"  name="Phone" id="Phone"  value="<? if(isset($loan_type)) echo $mobile; ?>"  onChange="intOnly(this); tosendsms(); insertData();" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" onFocus="addtooltip();">
			</td>
			</tr>
			<tr>
			<td colspan="2"><div id="myDiv" style="color:#7d0606; font-family:Verdana; font-size:11px;"></div></td>
			</tr>
			<tr>
			<td height="26" align="left" valign="middle" class="bldtxt">Email</td>
			<td class="bldtxt"><input class="style4" style="width:140px;" value="<? if(isset($loan_type)) echo $Email; else "Email Id" ?>" name="Email" id="Email" onBlur="onBlurDefault(this,'Email Id');"  onFocus="removetooltip();"  onChange="insertData();">                                </td>
			</tr>
			<tr>
			<td height="26" align="left" valign="middle" class="bldtxt">City</td>
			<td class="bldtxt"><select size="1" align="left" style="width:140"  name="City" id="City" onChange="othercity1(this); " />

			<?=getCityList1($City)?>
			</select></td>
			</tr>

			<tr>
			<td height="26" align="left" valign="middle" class="bldtxt">Other City </td>
			<td class="bldtxt"><input disabled value="Other City"  onfocus="this.select();" name="City_Other" id="City_Other" style="width: 140px;"  >                                </td>
			</tr>
			<tr>
			<td width="116" height="26" align="left" valign="middle" class="bldtxt">Net Salary</td>
			<td class="bldtxt"><input   name="IncomeAmount" id="IncomeAmount" onFocus="this.select();" onChange="intOnly(this);"  onKeyUp="intOnly(this); getDigitToWords('IncomeAmount','formatedIncome','wordIncome');" onKeyPress="intOnly(this); getDigitToWords('IncomeAmount','formatedIncome','wordIncome');" style="width:140px;" onBlur="getDigitToWords('IncomeAmount', 'formatedIncome', 'wordIncome'); onBlurDefault(this,'Annual Income');">                                </td>
			</tr>
			<tr>
			<td width="166" align="left" valign="middle" class="bldtxt" colspan="2"><span id='formatedIncome' style='font-family: Verdana, Arial, Helvetica, sans-serif;	font-size:11px;	color:#3A0D04; text-decoration:none; font-weight:bold; text-align:left;'></span><span id='wordIncome' style='font-family: Verdana, Arial, Helvetica, sans-serif;	font-size:11px;	color:#3A0D04; text-decoration:none; font-weight:bold; text-align:left;'></span> </td>
			</tr>
			<tr>
			<td height="26" align="left" valign="middle" class="bldtxt">Loan Amount </td>
			<td class="bldtxt"><input   name="Loan_Amount"  id="Loan_Amount" onFocus="this.select();" onChange="intOnly(this);"  onKeyUp="intOnly(this); getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" onKeyPress="intOnly(this); getDigitToWords('Loan_Amount', 'formatedlA','wordloanAmount');" style="width:140px;" onKeyDown="getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" onBlur="getDigitToWords('Loan_Amount', 'formatedlA', 'wordloanAmount'); onBlurDefault(this,'Loan Amount');">
			<input type="hidden" name="Type_Loan" value="Req_Loan_Home">
			<input type="hidden" name="source" value="common floor">
			<input type="hidden" name="last_id" value="<? echo $last_id; ?>">
			<input type="hidden" name="PostURL" value="<?php echo $_SERVER['REQUEST_URI']; ?>">                                </td>
			</tr>
			<tr>
			<td colspan="2" align="left" valign="middle" class="bldtxt"><span id='formatedlA' style='font-family: Verdana, Arial, Helvetica, sans-serif;	font-size:11px;	color:#3A0D04; text-decoration:none; font-weight:bold; text-align:left;'></span><span id='wordloanAmount' style='font-family: Verdana, Arial, Helvetica, sans-serif;	font-size:11px;	color:#3A0D04; text-decoration:none; font-weight:bold; text-align:left;'></span> </td>
			</tr>
			


			<tr>
			<td width="120" height="26" align="left" valign="middle" class="nrmltxt" style="color:#4b4b4b;">Date of Birth </td>
			<td width="156" class="nrmltxt">
			<input type="text" name="day" id="day" maxlength="2" style="width:38px;"  onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" onBlur="onBlurDefault(this,'dd');"  onFocus="onFocusBlank(this,'dd');"/>&nbsp;<input type="text" name="month" id="month" maxlength="2" style="width:38px;"  onChange="intOnly(this);"  onKeyUp="intOnly(this);" onKeyPress="intOnly(this)" onBlur="onBlurDefault(this,'mm');"  onFocus="onFocusBlank(this,'mm');" />&nbsp;<input type="text" maxlength="4" name="year" id="year" style="width:54px;"  onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" onBlur="onBlurDefault(this,'yyyy');" onFocus="onFocusBlank(this,'yyyy');" /></td>
			</tr>
			<tr>
			<td width="120" height="26" align="left" valign="middle" class="nrmltxt" style="color:#4b4b4b;">Pincode</td>
			<td class="nrmltxt"><input name="Pincode" type="text" id="Pincode" style="width:140px;" onFocus="this.select();" onChange="intOnly(this);" onKeyPress="intOnly(this);" onKeyUp="intOnly(this);"  maxlength="6" /></td>
			</tr>

			<td height="26" align="left" valign="middle" class="nrmltxt" style="color:#4b4b4b;">Occupation</td>
			<td class="nrmltxt"><select style="width:140px;" name="Employment_Status" id="Employment_Status">
			<option selected value="-1">Employment Status</option>
			<option  value="1">Salaried</option>
			<option value="0">Self Employed</option>
			</select></td>
			</tr>
			<tr>
			<td height="26" align="left" valign="middle" class="nrmltxt" style="color:#4b4b4b;">Company Name</td>
			<td class="nrmltxt"><input type="text" name="Company_Name" id="Company_Name" style="width:140px;"/>                                </td>
			</tr>
			<tr>
			<td width="120" height="26" align="left" valign="middle" class="nrmltxt" style="color:#4b4b4b;">Property Identified</td>
			<td class="nrmltxt" style="color:#4b4b4b;"><input type="radio" name="Property_Identified" id="Property_Identified" value="1" onClick="addIdentified();" style="border:none;" /> Yes&nbsp;&nbsp;<input type="radio"  name="Property_Identified" id="Property_Identified" onClick="removeIdentified();" value="0" style="border:none;" /> No                                </td>
			</tr>
			<tr><td colspan="2" align="left" class="nrmltxt" id="myDiv1"></td></tr>

			<tr>
			<td height="26" align="left" valign="middle" class="nrmltxt" style="color:#4b4b4b;">Property Value</td>
			<td class="nrmltxt"><input type="text" name="Property_Value" id="Property_Value" style="width:140px;" onKeyUp="intOnly(this); getDigitToWords('Property_Value','formatedPV','wordpropertyvalue');" onKeyPress="intOnly(this); getDigitToWords('Loan_Amount', 'formatedPV','wordloanAmount');"  onKeyDown="getDigitToWords('Property_Value','formatedPV','wordpropertyvalue');" onBlur="getDigitToWords('Property_Value', 'formatedPV', 'wordpropertyvalue'); onBlurDefault(this,'Loan Amount');"/></td>
			</tr>
	
			<tr>
			<td colspan="2" align="left" valign="middle" class="nrmltxt" style="color:#4b4b4b;" ><div id='formatedPV' class="nrmltxt"></div><div id='wordpropertyvalue' class="nrmltxt"></div> </td>
			</tr>
			<tr>
			<td height="55" align="left" valign="middle" class="nrmltxt" style="color:#4b4b4b;">Total EMIs you currently pay per month (if any)</td>
			<td class="nrmltxt"><input type="text" name="obligations" id="obligations" style="width:140px;"    onkeyup="intOnly(this);" onKeyPress="intOnly(this);" />                                </td>
			</tr>
			<tr>
			<td height="55" align="left" valign="middle" class="nrmltxt"  style="color:#4b4b4b;">When you are planning to take<br> 
			loan</td>
			<td class="nrmltxt"><select name="Loan_Time" style="width:140px;">
			<OPTION value="-1" selected>Please select</OPTION>
			<OPTION value="15 days">15 days</OPTION>
			<OPTION value="1 month">1 months</OPTION>
			<OPTION value="2 months">2 months</OPTION>
			<OPTION value="3 months">3 months</OPTION>
			<OPTION value="3 months above">more than 3 months</OPTION>
			</select>

			</td>

			</tr>
			<tr>
			<td height="26" align="left" colspan="2" valign="middle" class="nrmltxt"  style="color:#4b4b4b;"><input type="checkbox" name="co_appli" id="co_appli" value="1" onClick="return showdetailsFaq(1,12);" style="border:none;">
			Co- Applicant</td></tr>
			<tr><td colspan="2">
			<div style=" display:none; " id="divfaq1">
			<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
			<tr>
			<td width="185" height="30" align="left"  class="nrmltxt" style="color:#4b4b4b;">Name</td>
			<td width="183" align="left"> 
			<input type="text" name="co_name" id="co_name" style="width:140px;"  maxlength="30" >
			</td></tr>
			<tr>
			<td width="185" align="left" class="nrmltxt" style="color:#4b4b4b;">DOB </td>
			<td width="183" align="left">
			<input type="text" value="dd" name="co_day" id="co_day" maxlength="2" style="width:38px;"  onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" onBlur="onBlurDefault(this,'dd');"  onFocus="onFocusBlank(this,'dd');"/>&nbsp;<input type="text" name="co_month" id="co_month" maxlength="2" style="width:38px;"  onChange="intOnly(this);" value="mm"  onKeyUp="intOnly(this);" onKeyPress="intOnly(this)" onBlur="onBlurDefault(this,'mm');"  onFocus="onFocusBlank(this,'mm');" />&nbsp;<input type="text" maxlength="4" value="yyyy" name="co_year" id="co_year" style="width:52px;"  onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" onBlur="onBlurDefault(this,'yyyy');" onFocus="onFocusBlank(this,'yyyy');" /></td></tr>
			<tr>
			<td width="185" height="30" align="left" class="nrmltxt" style="color:#4b4b4b;">Net Monthly Income</td>
			<td width="183" align="left">            <input type="text" name="co_monthly_income" id="co_monthly_income" style="width:140px;" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" />          </td>
			</tr>
			<tr>
			<td height="30" align="left" class="nrmltxt" style="color:#4b4b4b;">Consolidated EMI's<br /> 
			(Per Month)</td>
			<td align="left">            <input type="text" name="co_obligations" id="co_obligations" style="width:140px;"   onkeyup="intOnly(this);" onKeyPress="intOnly(this);" />          </td>

			</tr>
			</table>

			</div></td></tr>
		

			<tr>
			<td height="54" colspan="2" align="center" valign="middle"><input type="submit" name="Submit"  value="Submit"/></td>
			</tr>
			</table>
			</form></td>
	</tr>

	<tr>
	<td height="10" ></td>
	</tr>

</table>
</body>
</html>
