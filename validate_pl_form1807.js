function chkpersonalloan()
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
	var curr_dt = '';
	curr_dt = new Date().getFullYear();
	var maxage = curr_dt - 62;
	var minage = curr_dt - 18;

	if (document.loan_form.Loan_Amount.value=="")
	{
		document.getElementById('loanAmtVal').innerHTML = "<span  class='hintanchor'>Enter Loan Amount!</span>";	
		document.loan_form.Loan_Amount.focus();
		return false;
	}	
	
	if (document.loan_form.Employment_Status.selectedIndex==0)
	{
		document.getElementById('empStatusVal').innerHTML = "<span  class='hintanchor'>Select Employment Status to Continue!</span>";	
		document.loan_form.Employment_Status.focus();
		return false;
	}

	if (document.loan_form.IncomeAmount.value=="")
	{
		document.getElementById('netSalaryVal').innerHTML = "<span  class='hintanchor'>Enter Annual Income!</span>";	
		document.loan_form.IncomeAmount.focus();
		return false;
	}	
	

	if (document.loan_form.City.selectedIndex==0)
	{
		document.getElementById('cityVal').innerHTML = "<span  class='hintanchor'>Enter City to Continue!</span>";	
		document.loan_form.City.focus();
		return false;
	}
	
	if((document.loan_form.Name.value=="") || (Trim(document.loan_form.Name.value))==false)
	{
        document.getElementById('nameVal').innerHTML = "<span  class='hintanchor'>Please Enter Your name</span>";		
		document.loan_form.Name.focus();
		return false;
	}

	if(document.loan_form.Name.value!="")
	{
		if(containsdigit(document.loan_form.Name.value)==true)
		{
			document.getElementById('nameVal').innerHTML = "<span  class='hintanchor'>First Name contains numbers!</span>";
			document.loan_form.Name.focus();
			return false;
		}
	}
   for (var i = 0; i <document.loan_form.Name.value.length; i++) 
   {
		if (iChars.indexOf(document.loan_form.Name.value.charAt(i)) != -1) 
		{
			document.getElementById('nameVal').innerHTML = "<span  class='hintanchor'>Contains special characters!</span>";
			document.loan_form.Name.focus();
			return false;
		}
  }
		
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
		if((document.loan_form.year.value < maxage) || (document.loan_form.year.value >minage))
		{
			document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Age between 18 -62!</span>";
			document.loan_form.year.focus();
			return false;
		}
	}
	if(!checkData(document.loan_form.year, 'Year', 4))
		return false;
	if(document.loan_form.Phone.value=="")
	{
		document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Fill Mobile Number!</span>";
		document.loan_form.Phone.focus();
		return false;
	}
	if(isNaN(document.loan_form.Phone.value)|| document.loan_form.Phone.value.indexOf(" ")!=-1)
	{
		document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Enter numeric value!</span>";
		document.loan_form.Phone.focus();
		return false;  
	}
	if (document.loan_form.Phone.value.length < 10 )
	{
	  	document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Enter 10 Digits!</span>";	
		document.loan_form.Phone.focus();
		return false;
	}
	if ((document.loan_form.Phone.value.charAt(0)!="9") && (document.loan_form.Phone.value.charAt(0)!="8") && (document.loan_form.Phone.value.charAt(0)!="7"))
	{
	  	document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>should start with 9 or 8 or 7!</span>";	
		document.loan_form.Phone.focus();
		return false;
	}
	
	if(document.loan_form.Email.value=="")
	{
		document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter  Email Address!</span>";	
		document.loan_form.Email.focus();
		return false;
	}
	
	var str=document.loan_form.Email.value


	var aa=str.indexOf("@")
	var bb=str.indexOf(".")
	var cc=str.charAt(aa)

	if(aa==-1)
	{
		document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter Valid Email Address!</span>";	
		document.loan_form.Email.focus();
		return false;
	}
	else if(bb==-1)
	{
		document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter Valid Email Address!</span>";	
		document.loan_form.Email.focus();
		return false;
	}
	
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

	

	myOption = -1;
		for (i=document.loan_form.CC_Holder.length-1; i > -1; i--) {
			if(document.loan_form.CC_Holder[i].checked) {
				if(i==0)
				{
					if (document.loan_form.Card_Vintage.selectedIndex==0)
					{
						document.getElementById('vintageVal').innerHTML = "<span  class='hintanchor'>Holding Credit Card Since!</span>";	
						document.loan_form.Card_Vintage.focus();
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


	if(!document.loan_form.accept.checked)
	{
		document.getElementById('acceptVal').innerHTML = "<span  class='hintanchor'>Read and Accept Terms & Conditions!</span>";	

		document.loan_form.accept.focus();
		return false;
	}	


return true;
}  

function othercity1()
{
//alert(document.personalloan_form.City.value);
	//var citydiv1 = document.getElementById('otherCityName');
	var citydiv2 = document.getElementById('otherCityName');
	if(document.loan_form.City.value=='Others')	
	{
//	alert(document.personalloan_form.City.value);
		citydiv2.innerHTML = '<table width="100%" border="0" cellpadding="0" cellspacing="0"><tr><td height="25"><span class="formhlwpbody-text">Other City:<span style="color:#FF0000; font-weight:bold;">*</span></span></td></tr><tr><td height="25"><input name="City_Other" id="City_Other" type="text" class="pl_input_b" onKeyUp="searchSuggest();" onkeydown="validateDiv(\'othercityVal\');" /><div id="othercityVal"></div></td></tr></table>';	
	}
	else
	{
		citydiv2.innerHTML = '';
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


function addIdentified()
{
	var ni1 = document.getElementById('myDiv1');
	ni1.innerHTML = '<div class="formhlwpbody-text">Card held since?</div><div class="text" style=" float:left; height:auto; text-transform:none; margin-top:5px;"><select size="1" name="Card_Vintage" class="select" onchange="validateDiv(\'vintageVal\');" ><option value="0">Please select</option> <option value="1">Less than 6 months</option> <option value="2">6 to 9 months</option> <option value="3">9 to 12 months</option><option value="4">more than 12 months</option> </select></div><div id="vintageVal"></div></div>';
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

function validateDiv(div)
{
	var ni1 = document.getElementById(div);
	ni1.innerHTML = '';
}
/*
function addhdfclife()
{
	//alert("helloi");
	var ni1 = document.getElementById('hdfclife');
	var cit = document.loan_form.City.value;
	//var otrcit = document.loan_form.City_Other.value;

	if(cit =="Ahmedabad" || cit =="Allahabad" || cit =="Bangalore" || cit =="Baroda" || cit =="Bhubaneshwar" || cit =="Chandigarh" || cit =="Chennai" || cit =="Cochin" || cit =="Cuttack" || cit =="Delhi" || cit =="Faridabad" || cit =="Gaziabad" || cit =="Gurgaon" || cit =="Guwahati" || cit =="Hyderabad" || cit =="Indore" || cit =="Jaipur" || cit =="Kanpur" || cit =="Kochi" || cit =="Kolkata" || cit =="Lucknow" || cit =="Mumbai" || cit =="Noida" || cit =="Pune" || cit =="Sahibabad" || cit =="Thane" || cit =="Vadodara" || cit =="Vijaywada" || cit =="Vishakapatanam" || cit =="Vizag" )
	{
		//alert("ranjana");
		ni1.innerHTML = '<table style="border:1px solid #000000; padding:2px; width:706px;"><tr><td colspan="2" class="frmbldtxt" style="font-family:verdana; font-size:10px; color:#ffffff; font-weight:normal; " height="20"><span style="color:#ff0000;">(Optional) </span>Special service only for Deal4loans customers:</td></tr> <tr><td width="23"><input type="checkbox"  name="hdfclife" id="hdfclife" value="1"/></td> <td width="611" class="frmbldtxt" style="font-family:verdana; font-size:10px; color:#ffffff; font-weight:normal; "> I would like to avail of <b>FREE </b>financial planning services by <b>Insurance & Investment experts</b> from HDFC Life.</td>		 </tr>	 </table>';	
	}
	else
	{
		ni1.innerHTML = '';
	}
	return true;
}
*/

function change_empstst()
{
	
	var occupation = document.getElementById('Employment_Status').value;
	//alert(occupation);
	var occpdiv = document.getElementById('chnge_empstst');
	if(occupation==0)
	{
		occpdiv.innerHTML = '<div class="formhlwpbody-text"><div class="formhlwpbody-text">Annual Turnover: <span style="color:#FF0000; font-weight:bold;">*</span> </span></div> <div>        <select name="Annual_Turnover" id="Annual_Turnover" class="select"><option value="">Please Select</option><option value="1" > 0 - 40 Lacs</option><option value="4" > 40 Lacs - 1 Cr</option>		<option value="2" > 1Cr - 3Crs </option><option value="3" >3Crs & above</option></select><div id="annualTurnoverVal"></div></div></div><div style="clear:both;"></div>';	
	}
	else
	{
		occpdiv.innerHTML = '<div><div class="formhlwpbody-text">Company Name: <span style="color:#FF0000; font-weight:bold;">*</span></span></div><div><input name="Company_Name" id="Company_Name" type="text" class="input" onblur="onBlurDefault(this,\'Type slowly to autofill\');" onkeyup="ajax_showOptions(this,\'getCountriesByLetters\',event,\'http://www.deal4loans.com/ajax-list-plcompanies.php\')" onfocus="onFocusBlank(this,\'Type slowly to autofill\');" onkeydown="validateDiv(\'companyNameVal\');" value="Type slowly to autofill" tabindex=11/><div id="companyNameVal"></div></div></div><div style="clear:both;"></div> ';
	}			
}

function addPersonalDetails()
{
	var ni1 = document.getElementById('personalDetails');
	var ni2 = document.getElementById('Employment_Status').value;
	if(ni2==0)
	{
		ni1.innerHTML = '<div><table width="100%" border="0" cellpadding="0" cellspacing="0"><tr><td width="35%" align="left">Personal Details</td><td width="65%"><img src="/images/security.png" width="14" height="16"> Your Information is secure with us and will not be shared without your consent</td></tr></table></div><div style="clear:both;"></div>   <div class="input_box">    <table width="100%" border="0" cellpadding="0" cellspacing="0"><tr><td height="30"><span class="text">Full Name:<span style="color:#FF0000; font-weight:bold;">*</span></span></td></tr><tr><td height="30"><input name="Name" class="input" id="Name" type="text" onKeyDown="validateDiv(\'nameVal\');" /><div id="nameVal"></div></td></tr><tr><td class="formhlwpbody-text">Mobile:<span style="color:#FF0000; font-weight:bold;">*</span></td></tr><tr><td class="formhlwpbody-text"><em>+91</em><input name="Phone" id="Phone" maxlength="10" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)"; onChange="intOnly(this);" type="text" class="mobile" onKeyDown="validateDiv(\'phoneVal\');" /><div id="phoneVal"></div> </td></tr></table>  </div>    <div class="input_box"><table width="100%" border="0" cellpadding="0" cellspacing="0"><tr><td class="formhlwpbody-text">Email ID: <span style="color:#FF0000; font-weight:bold;">*</span></td></tr><tr><td height="30"><input name="Email" id="Email" type="text" class="input" onKeyDown="validateDiv(\'emailVal\');" /><div id="emailVal"></div> </td></tr><tr><td class="formhlwpbody-text">DOB:<span style="color:#FF0000; font-weight:bold;">*</span></td></tr><tr><td height="30"><input name="day" id="day" type="text" class="dd" value="dd" onBlur="onBlurDefault(this,\'dd\');" onFocus="onFocusBlank(this,\'dd\');" maxlength="2" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" onKeyDown="validateDiv(\'dobVal\');" /><input name="month" id="month" type="text" class="dd" value="mm" onBlur="onBlurDefault(this,\'mm\');" onFocus="onFocusBlank(this,\'mm\');" maxlength="2" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" onKeyDown="validateDiv(\'dobVal\');" /><input name="year" id="year" type="text" class="yy" value="yyyy" onBlur="onBlurDefault(this,\'yyyy\');" onFocus="onFocusBlank(this,\'yyyy\');" maxlength="4" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" onKeyDown="validateDiv(\'dobVal\');" /><div id="dobVal"></div></td>      </tr>      </table>    </div>      <div class="input_box" style="width:222px;"> <table width="100%" border="0" cellpadding="0" cellspacing="0"><tr><td class="formhlwpbody-text">Pincode:</span></td></tr><tr> <td height="30"><input name="Pincode" id="Pincode" maxlength="6" onKeyPress="intOnly(this);" onKeyUp="intOnly(this);" onkeydown="validateDiv(\'pincodeVal\');" type="text" class="input" /><div id="pincodeVal"></div></td></tr><tr><td colspan="2"><div id="chnge_empstst"><div style=" float:left; height:45px; margin-left:0px; margin-top:5px;"><div class="text" style=" float:left; height:auto; font-size:12px; text-transform:none;"><span class="text" style=" float:left; height:auto; text-transform:none;">Annual Turnover: <span style="color:#FF0000; font-weight:bold;">*</span> </span></div><div class="text" style=" float:left; height:auto; text-transform:none; margin-top:5px;"><select name="Annual_Turnover" id="Annual_Turnover" style="height:22px;"><option value="">Please Select</option>	<option value="1"> 0 - 40 Lacs</option><option value="4" > 40 Lacs - 1 Cr</option><option value="2" > 1Cr - 3Crs </option><option value="3" >3Crs & above</option></select><div id="annualTurnoverVal"></div></div></div></div></td></tr></table></div><div class="input_box" style="width:229px;"><table width="100%" border="0" cellpadding="0" cellspacing="0"><tr><td class="formhlwpbody-text" width="40%">Credit Card</span></td><td width="60%" style="color:#FFFFFF;"><input type="radio" name="CC_Holder" id="CC_Holder" value="1" onClick="return addIdentified();" style="border:none;" /><em>yes</em><input type="radio"  name="CC_Holder" id="CC_Holder" onClick="removeIdentified();" value="0" style="border:none;" checked="checked" /><em>No</em></td></tr><tr><td colspan="2" id="myDiv1" ></td></tr></table></div>        <div style="clear:both;"></div>  <div class="box_term"><input name="accept" type="checkbox" />I authorize Deal4loans.com & its <a href="http://www.deal4loans.com/pl-partnering-banks.php" target="_blank" rel="nofollow" style="text-decoration:underline;">partnering banks</a> to contact me to explain the product & I Agree to <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow" style="text-decoration:underline;">Privacy policy</a> and <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow" class="text" style=" text-decoration:underline;">Terms and Conditions</a>.<div id="acceptVal"></div></div>  <div class="hl_emi_get_quote"><input type="image" src="/images/wp-loan-get-quote.png" margin-bottom: 0px;" value=""/></div><div style="clear:both;"></div>';
	}
	else
	{
		ni1.innerHTML = '<div><table width="100%" border="0" cellpadding="0" cellspacing="0"><tr><td width="35%" align="left" style="font-size:21px; color:#000;">Personal Details</td><td style="font-size:14px; font-weight:normal;" width="65%"><img src="/images/security.png" width="14" height="16"> Your Information is secure with us and will not be shared without your consent</td></tr></table></div><div style="clear:both;"></div><div class="input_box"><table width="100%" border="0" cellpadding="0" cellspacing="0"><tr><td class="formhlwpbody-text">Full Name:</span></td></tr><tr><td height="30"><input name="Name" class="input" id="Name" type="text" onKeyDown="validateDiv(\'nameVal\');" /><div id="nameVal"></div></td></tr><tr><td class="formhlwpbody-text">Mobile:<span style="color:#FF0000; font-weight:bold;">*</span></span></td></tr><tr><td class="formhlwpbody-text"><em>+91</em><input name="Phone" id="Phone" maxlength="10" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)"; onChange="intOnly(this);" type="text" class="mobile" onKeyDown="validateDiv(\'phoneVal\');"  /><div id="phoneVal"></div> </td></tr></table>  </div>    <div class="input_box"><table width="100%" border="0" cellpadding="0" cellspacing="0"><tr><td class="formhlwpbody-text">Email ID:<span style="color:#FF0000; font-weight:bold;">*</span></td></tr><tr><td height="30"><input name="Email" id="Email" type="text" class="input" onKeyDown="validateDiv(\'emailVal\');"  /><div id="emailVal"></div> </td></tr> <tr> <td class="formhlwpbody-text">DOB:<span style="color:#FF0000; font-weight:bold;">*</span></span></td> </tr><tr><td height="30"><input name="day" id="day" type="text" class="dd" value="dd" onBlur="onBlurDefault(this,\'dd\');" onFocus="onFocusBlank(this,\'dd\');" maxlength="2" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" onKeyDown="validateDiv(\'dobVal\');" /> <input name="month" id="month" type="text" class="dd" value="mm" onBlur="onBlurDefault(this,\'mm\');" onFocus="onFocusBlank(this,\'mm\');" maxlength="2" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" onKeyDown="validateDiv(\'dobVal\');" /> <input name="year" id="year" type="text" class="yy" value="yyyy" onBlur="onBlurDefault(this,\'yyyy\');" onFocus="onFocusBlank(this,\'yyyy\');" maxlength="4" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" onKeyDown="validateDiv(\'dobVal\');" /><div id="dobVal"></div></td>      </tr>      </table>    </div>      <div class="input_box"><table width="100%" border="0" cellpadding="0" cellspacing="0"><tr><td class="formhlwpbody-text">Pincode:</span></td>          </tr>          <tr>            <td height="30"><input name="Pincode" id="Pincode" maxlength="6" onKeyPress="intOnly(this);" onKeyUp="intOnly(this);"  onkeydown="validateDiv(\'pincodeVal\');" type="text" class="input" /><div id="pincodeVal"></div></td></tr><tr><td colspan="2"><div id="chnge_empstst"><table cellpadding="0" cellspacing="0"><tr><td class="formhlwpbody-text">Company Name: <span style="color:#FF0000; font-weight:bold;">*</span></span></td></tr><tr><td height="30"><input name="Company_Name" id="Company_Name" type="text" class="input" onKeyDown="validateDiv(\'companyNameVal\');" onKeyUp="ajax_showOptions(this,\'getCountriesByLetters\',event)"  onblur="onBlurDefault(this,\'Type slowly to autofill\');"  value="Type slowly to autofill" onfocus="onFocusBlank(this,\'Type slowly to autofill\');"/><div id="companyNameVal"></div></td></tr></table></div></td></tr></table></div><div class="input_box" style="width:229px;"><table width="100%" border="0" cellpadding="0" cellspacing="0"><tr><td class="formhlwpbody-text" width="40%">Credit Card<span style="color:#FF0000; font-weight:bold;">*</span></span></td><td width="60%" style="color:#000;"><input type="radio" name="CC_Holder" id="CC_Holder" value="1" onClick="return addIdentified();" style="border:none;" /><em>yes</em><input type="radio"  name="CC_Holder" id="CC_Holder" onClick="removeIdentified();" value="0" style="border:none;" checked="checked" /><em>No</em></td></tr><tr><td colspan="2" id="myDiv1" ></td></tr></table></div><div style="clear:both;"></div><div class="box_term"><input name="accept" type="checkbox" /> I authorize Deal4loans.com & its <a href="http://www.deal4loans.com/pl-partnering-banks.php" target="_blank" rel="nofollow" style="text-decoration:underline;">partnering banks</a> to contact me to explain the product & I Agree to <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow" style="text-decoration:underline;">Privacy policy</a> and <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow" style=" text-decoration:underline;">Terms and Conditions</a>.<div id="acceptVal"></div></div>  <div class="hl_emi_get_quote"><input type="image" src="/images/wp-loan-get-quote.png" margin-bottom: 0px;" value=""/></div>   <div style="clear:both;"></div>';
	}
	
}