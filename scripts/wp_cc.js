
function ckhcreditcard(Form)
{
	var j;
	var cnt=-1;
	var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
	var dt,mdate;dt=new Date();
	var cit=document.creditcard_form.City.value;
	var sal=document.creditcard_form.Net_Salary.value;
	var alpha=/^[a-zA-Z\ ]*$/;
	var alphanum=/^[a-zA-Z0-9]*$/;
	var num=/^[0-9]*$/;
	var space=/^[\ ]*$/;
	var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";
 		
	if(document.creditcard_form.Net_Salary.value=="")
	{
		document.getElementById('netSalaryVal').innerHTML = "<span  class='hintanchor'>Enter Annual Income!</span>";	
		document.creditcard_form.Net_Salary.focus();
		return false;
	}
	if (document.creditcard_form.Employment_Status.selectedIndex==0)
	{
		document.getElementById('empStatusVal').innerHTML = "<span  class='hintanchor'>Enter Employment Status!</span>";
		document.creditcard_form.Employment_Status.focus();
		return false;
	}
	if (document.creditcard_form.City.selectedIndex==0)
	{
		document.getElementById('cityVal').innerHTML = "<span  class='hintanchor'>Enter City to Continue!</span>";	
		document.creditcard_form.City.focus();
		return false;
	}
	
	if (document.creditcard_form.salary_account.selectedIndex==0)
	{		
	  	document.getElementById('salAccountVal').innerHTML = "<span  class='hintanchor'>Select Salary Account!</span>";
   		document.creditcard_form.salary_account.focus();		return false;	
	}
   
	if((document.creditcard_form.Full_Name.value=="") || (Trim(document.creditcard_form.Full_Name.value))==false)
	{
        document.getElementById('nameVal').innerHTML = "<span  class='hintanchor'>Please Enter Your name</span>";		
		document.creditcard_form.Full_Name.focus();
		return false;
	}

	if(document.creditcard_form.Full_Name.value!="")
	{
		if(containsdigit(document.creditcard_form.Full_Name.value)==true)
		{
			document.getElementById('nameVal').innerHTML = "<span  class='hintanchor'>First Name contains numbers!</span>";
			document.creditcard_form.Full_Name.focus();
			return false;
		}
	}
   for (var i = 0; i <document.creditcard_form.Full_Name.value.length; i++) 
   {
		if (iChars.indexOf(document.creditcard_form.Full_Name.value.charAt(i)) != -1) 
		{
			document.getElementById('nameVal').innerHTML = "<span  class='hintanchor'>Contains special characters!</span>";
			document.creditcard_form.Full_Name.focus();
			return false;
		}
  }
  
  	if(document.creditcard_form.Phone.value=="")
	{
		document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Fill Mobile Number!</span>";
		document.creditcard_form.Phone.focus();
		return false;
	}
	if(isNaN(document.creditcard_form.Phone.value)|| document.creditcard_form.Phone.value.indexOf(" ")!=-1)
	{
		document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Enter numeric value!</span>";
		document.creditcard_form.Phone.focus();
		return false;  
	}
	if (document.creditcard_form.Phone.value.length < 10 )
	{
	  	document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Enter 10 Digits!</span>";	
		document.creditcard_form.Phone.focus();
		return false;
	}
	if ((document.creditcard_form.Phone.value.charAt(0)!="9") && (document.creditcard_form.Phone.value.charAt(0)!="8") && (document.creditcard_form.Phone.value.charAt(0)!="7"))
	{
	  	document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>should start with 9 or 8 or 7!</span>";	
		document.creditcard_form.Phone.focus();
		return false;
	}
	
	if(document.creditcard_form.Email.value=="")
	{
		document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter  Email Address!</span>";	
		document.creditcard_form.Email.focus();
		return false;
	}
	
	var str=document.creditcard_form.Email.value
	var aa=str.indexOf("@")
	var bb=str.indexOf(".")
	var cc=str.charAt(aa)

	if(aa==-1)
	{
		document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter Valid Email Address!</span>";	
		document.creditcard_form.Email.focus();
		return false;
	}
	else if(bb==-1)
	{
		document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter Valid Email Address!</span>";	
		document.creditcard_form.Email.focus();
		return false;
	}

		
	if(document.creditcard_form.day.value=="" || document.creditcard_form.day.value=="dd")
	{
		document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Fill Day of Birth!</span>";
		document.creditcard_form.day.focus();
		return false;
	}
	if(document.creditcard_form.day.value!="")
	{
		if((document.creditcard_form.day.value<1) || (document.creditcard_form.day.value>31))
		{
			document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Date of Birth(Range 1-31)!</span>";
			document.creditcard_form.day.focus();
			return false;
		}
	}
	if(!checkData(document.creditcard_form.day, 'Day', 2))
		return false;
	
	if(document.creditcard_form.month.value=="" || document.creditcard_form.month.value=="mm")
	{
		document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Fill month of Birth!</span>";
		document.creditcard_form.month.focus();
		return false;
	}
	if(document.creditcard_form.month.value!="")
	{
		if((document.creditcard_form.month.value<1) || (document.creditcard_form.month.value>12))
		{
			document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Month of Birth(Range 1-12)!</span>";
			document.creditcard_form.month.focus();
			return false;
		}
	}
	if(!checkData(document.creditcard_form.month, 'month', 2))
		return false;

	if(document.creditcard_form.year.value=="" || document.creditcard_form.year.value=="yyyy")
	{
		document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Fill Year of Birth!</span>";
		document.creditcard_form.year.focus();
		return false;
	}
	if(document.creditcard_form.year.value!="")
	{
		if((document.creditcard_form.year.value < "<?php echo $maxage;?>") || (document.creditcard_form.year.value >"<?php echo $minage;?>"))
		{
			document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Age between 18 -62!</span>";
			document.creditcard_form.year.focus();
			return false;
		}
	}
	if(!checkData(document.creditcard_form.year, 'Year', 4))
		return false;
	
	if((document.creditcard_form.Company_Name.value=="") || (document.creditcard_form.Company_Name.value=="Type Slowly for Autofill")|| (Trim(document.creditcard_form.Company_Name.value))==false)
	{
		document.getElementById('companyNameVal').innerHTML = "<span  class='hintanchor'>Fill Company Name!</span>";	
		document.creditcard_form.Company_Name.focus();
		return false;
	}
	else if(document.creditcard_form.Company_Name.value.length < 3)
	{
		document.getElementById('companyNameVal').innerHTML = "<span  class='hintanchor'>Fill Company Name!</span>";	
		document.creditcard_form.Company_Name.focus();
		return false;
	}
	if (document.creditcard_form.Pincode.value=="")
	{
		document.getElementById('pincodeVal').innerHTML = "<span  class='hintanchor'>Enter Pincode!</span>";	
		document.creditcard_form.Pincode.focus();
		return false;
	}
	if (document.creditcard_form.Pincode.value!="")
	{
		if(document.creditcard_form.Pincode.value.length < 6)
		{
			document.getElementById('pincodeVal').innerHTML = "<span  class='hintanchor'>Enter Pincode(6 Digits)!</span>";	
			document.creditcard_form.Pincode.focus();
			return false;
		}
	}
if(document.creditcard_form.City.value=="Others")
	{
	if((document.creditcard_form.City.value=="Others") && ((document.creditcard_form.City_Other.value=="" || document.creditcard_form.City_Other.value=="Other City"  ) || !isNaN(document.creditcard_form.City_Other.value)))
	{
		document.getElementById('othercityVal').innerHTML = "<span  class='hintanchor'>Enter Other City to Continue!</span>";		
		document.creditcard_form.City_Other.focus();
		return false;
	}
	for (var i = 0; i <document.creditcard_form.City_Other.value.length; i++) {
  	if (iChars.indexOf(document.creditcard_form.City_Other.value.charAt(i)) != -1) {
		document.getElementById('othercityVal').innerHTML = "<span  class='hintanchor'>Remove Special Characters!</span>";	
		document.creditcard_form.City_Other.focus();
  		return false;
  	}
  }
	}   
  

for(j=0; j<document.creditcard_form.CC_Holder.length; j++) 
	{
        if(document.creditcard_form.CC_Holder[j].checked)
		{
   	 		cnt= j;
		}
	}
	if(cnt == -1) 
	{
		alert("Select Card holder or not!");	
		return false;
	}
	if(cnt ==0)
	{ 
		if(document.creditcard_form.No_of_Banks.selectedIndex==0)
		{
			document.getElementById('ccbnknmeVal').innerHTML = "<span  class='hintanchor'>Select card from which Bank!</span>";	
			document.creditcard_form.No_of_Banks.focus();
			return false;
		}
		if(document.creditcard_form.City.selectedIndex >0)
		{
	if((cit=="Bangalore" || cit=="Chennai" || cit=="Delhi" || cit=="Hyderabad" || cit=="Jaipur" || cit=="Kolkata" || cit=="Mumbai" || cit=="Pune" || cit=="Ahmedabad" || cit=="Chandigarh" || cit=="Indore" || cit=="Cochin" || cit=="Bhopal") && sal < 360000)
			{
		if(document.creditcard_form.Card_Vintage.selectedIndex==0)
		{
			document.getElementById('ccvintageVal').innerHTML = "<span  class='hintanchor'>Please select since how long you holding credit card.</span>";	
			document.creditcard_form.Card_Vintage.focus();
			return false;
		}
		if(document.creditcard_form.Credit_Limit.selectedIndex==0)
		{
			document.getElementById('cclimitVal').innerHTML = "<span  class='hintanchor'>Please select Card Credit Limit.</span>";	
			document.creditcard_form.Credit_Limit.focus();
			return false;
		}

			}
		}
		
	}
		
	if(!document.creditcard_form.accept.checked)
	{
		document.getElementById('acceptVal').innerHTML = "<span  class='hintanchor'>Read and Accept Terms & Conditions!</span>";	
		document.creditcard_form.accept.focus();
		return false;
	}
}   
function validateDiv(div)
{	var ni1 = document.getElementById(div);	ni1.innerHTML = ''; }
function onFocusBlank(element,defaultVal){	if(element.value==defaultVal){		element.value="";	} }
function onBlurDefault(element,defaultVal){	if(element.value==""){		element.value = defaultVal;	} }
function Trim(strValue) {	var j=strValue.length-1;i=0;	while(strValue.charAt(i++)==' ');	while(strValue.charAt(j--)==' ');	return strValue.substr(--i,++j-i+1); }
function containsdigit(param){	mystrLen = param.length;	for(i=0;i<mystrLen;i++)	{		if((param.charAt(i)=="0") || (param.charAt(i)=="1") || (param.charAt(i)=="2") || (param.charAt(i)=="3") || (param.charAt(i)=="4") || (param.charAt(i)=="5") || (param.charAt(i)=="6") || (param.charAt(i)=="7") || (param.charAt(i)=="8") || (param.charAt(i)=="9") || (param.charAt(i)=="/"))		{			return true;		}	}	return false;}


function addElement()
{
	var ni = document.getElementById('myDiv');
	var niicici = document.getElementById('icici_rqdfield');
	var cit = document.creditcard_form.City.value;
	var sal = document.creditcard_form.Net_Salary.value;
		
	ni.innerHTML = '<div class="input_box"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td class="formhlwpbody-text">Bank Name :</td>    </tr>    <tr>      <td height="25"><select size="1" name="No_of_Banks" id="No_of_Banks" class="select"><option value="0">Please select</option> <option value="HDFC Bank">HDFC Bank</option> <option value="Standard Chartered">Standard Chartered</option> <option value="Kotak Bank">Kotak Bank</option><option value="ICICI Bank">ICICI Bank</option><option value="Other">Other</option></select><div id="ccbnknmeVal"></div>  </td>    </tr></table></div>';

	if((cit=="Bangalore" || cit=="Chennai" || cit=="Delhi" || cit=="Hyderabad" || cit=="Jaipur" || cit=="Kolkata" || cit=="Mumbai" || cit=="Pune" || cit=="Ahmedabad" || cit=="Chandigarh" || cit=="Indore" || cit=="Cochin" || cit=="Bhopal") && sal < 360000)
	{
		niicici.innerHTML='<div class="input_box"> <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td class="formhlwpbody-text">Card Vintage :</td></tr><tr><td height="25"><select size="1" name="Card_Vintage" class="select" onChange="validateDiv(\'vintageVal\');" ><option value="0">Please select</option> <option value="1">Less than 6 months</option> <option value="2">6 to 9 months</option> <option value="3">9 to 12 months</option><option value="4">more than 12 months</option> </select><div id="ccvintageVal"></div></td>    </tr></table></div><div class="input_box"> <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td class="formhlwpbody-text">Credit Limit :</td></tr><tr><td height="25">  <select size="1" name="Credit_Limit" id="Credit_Limit" class="select" onChange="validateDiv(\'cclimitVal\');" ><option value="0">Please select</option><option value="1">Upto 75,000</option><option value="2">75,000 to 1,50,000 </option><option value="3">1,50,000 & Above</option></select><div id="cclimitVal"></div></td></tr></table></div>';
	}
	return true;
}

function removeElement()
{
	var ni = document.getElementById('myDiv');
	var niicici = document.getElementById('icici_rqdfield');
		
	if(ni.innerHTML!="")
	{
		if(document.creditcard_form.CC_Holder.value="0")
		{
			ni.innerHTML = '';
			niicici.innerHTML = '';
		}
	}
	return true;
}

function addhdfclife()
{
	var ni1 = document.getElementById('hdfclife');
	var cit = document.creditcard_form.City.value;
	
	if(cit =="Ahmedabad" || otrcit =="Allahabad" || cit =="Bangalore" || cit =="Baroda" || cit =="Bhubaneshwar" || cit =="Chandigarh" || cit =="Chennai" || cit =="Cochin" || cit =="Cuttack" || cit =="Delhi" || cit =="Faridabad" || cit =="Gaziabad" || cit =="Gurgaon" || cit =="Guwahati" || cit =="Hyderabad" || cit =="Indore" || cit =="Jaipur" || cit =="Kanpur" || cit =="Kochi" || cit =="Kolkata" || cit =="Lucknow" || cit =="Mumbai" || cit =="Noida" || cit =="Pune" || cit =="Sahibabad" ||
cit =="Surat" || cit =="Thane" || cit =="Vadodara" || cit =="Vijaywada" || cit =="Vishakapatanam" || cit =="Vizag" )
	{
		//alert("ranjana");
		ni1.innerHTML = '<table  style="border:1px solid #000000; padding:2px;"><tr><td colspan="2" class="frmbldtxt" style="font-family:verdana; font-size:10px; color:#ffffff; font-weight:normal; " height="20"><span style="color:#FF0000;">(Optional) Special service only for Deal4loans customers:</td></tr> <tr><td width="23"><input type="checkbox"  name="hdfclife" id="hdfclife" value="1"/></td> <td width="611" class="frmbldtxt" style="font-family:verdana; font-size:10px; color:#ffffff; font-weight:normal; "> I would like to avail of <b>FREE </b>financial planning services by <b>Insurance & Investment experts</b> from HDFC Life.</td>		 </tr>	 </table>';	
	}
	else
	{
	ni1.innerHTML = '';
	
	}
	return true;
}

function addPersonalDetails()
{
	var ni1 = document.getElementById('personalDetails');
	var ni3 = document.getElementById('addSubmit');
	//var ni5 = document.getElementById('getImageScroll');
	var cit = document.creditcard_form.City.value;
//	ni5.innerHTML ='<img src="http://www.deal4loans.com/images/animated_cc.gif" width="575" height="21" />';
	if(cit=="Others")
	{
		ni1.innerHTML = '<div style="padding-left:20px; padding-top:7px;" ><table width="98%" border="0" cellpadding="0" cellspacing="0"><tr><td width="21%"  align="left" style="font-size:19px; color:#000; padding-top:5px;"> Personal Details</td><td style="font-size:13px; color:#000;"><img src="http://www.deal4loans.com/images/security.png" width="14" height="16"> Your Information is secure with us and will not be shared without your consent</td></tr></table></div> <div style="clear:both;"></div><div class="input_box"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td class="formhlwpbody-text">Full Name :<span style="color:#FF0000; font-weight:bold;">*</span></td></tr><tr><td> <input name="Full_Name" id="Full_Name" type="text" class="input"  onkeydown="validateDiv(\'nameVal\');" /><div id="nameVal"></div>     </td></tr></table></div><div class="input_box"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td class="formhlwpbody-text">Mobile :<span style="color:#FF0000; font-weight:bold;">*</span></td></tr><tr><td class="formhlwpbody-text"><table width="100%" cellpadding="0" cellspacing="0"><tr><td>+91 </td><td><input name="Phone" id="Phone" maxlength="10" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" onChange="intOnly(this);" type="text" class="mobile"  onkeydown="validateDiv(\'phoneVal\');"  /></td></tr></table><div id="phoneVal"></div> </td></tr></table></div><div class="input_box"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td class="formhlwpbody-text">Email :<span style="color:#FF0000; font-weight:bold;">*</span></td></tr><tr><td height="25">  <input name="Email" id="Email" type="text" class="input"   onkeydown="validateDiv(\'emailVal\');"  /><div id="emailVal"></div></td></tr></table></div><div class="input_box"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td class="formhlwpbody-text"> DOB:<span style="color:#FF0000; font-weight:bold;">*</span></td></tr><tr><td><input name="day" id="day" type="text" class="dd" value="dd" onBlur="onBlurDefault(this,\'dd\');" onFocus="onFocusBlank(this,\'dd\');" maxlength="2" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" onKeyDown="validateDiv(\'dobVal\');" /><input name="month" id="month" type="text" class="dd" value="mm" onBlur="onBlurDefault(this,\'mm\');" onFocus="onFocusBlank(this,\'mm\');" maxlength="2" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" onKeyDown="validateDiv(\'dobVal\');" /></div><div class="text" style=" float:left; clear:right;"><input name="year" class="yy" id="year" type="text" value="yyyy" onBlur="onBlurDefault(this,\'yyyy\');" onFocus="onFocusBlank(this,\'yyyy\');" maxlength="4" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" onKeyDown="validateDiv(\'dobVal\');" /></div><div id="dobVal"></div>  </td></tr></table></div><div style="clear:both;"></div><div class="input_box"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td class="formhlwpbody-text">Company Name :</td></tr><tr><td height="25"> <input name="Company_Name" autocomplete="off" id="Company_Name" type="text" class="input" onKeyDown="validateDiv(\'companyNameVal\');"  onKeyUp="ajax_showOptions(this,\'getCountriesByLetters\',event)"  value="Type Slowly for Autofill" onBlur="onBlurDefault(this,\'Type Slowly for Autofill\');" onFocus="onFocusBlank(this,\'Type Slowly for Autofill\');"/><div id="companyNameVal"></div></td></tr></table></div><div class="input_box"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td class="formhlwpbody-text">Pincode :</td></tr><tr><td height="25"><input name="Pincode" id="Pincode" type="text" class="input"  onkeydown="validateDiv(\'pincodeVal\');"  maxlength="6"/><div id="pincodeVal"></div></td></tr></table></div><div class="input_box"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td class="formhlwpbody-text">Other City :</td></tr><tr><td height="25"> <input name="City_Other" id="City_Other" type="text" class="input"  onKeyUp="searchSuggest();" onKeyDown="validateDiv(\'othercityVal\');"  /><div id="othercityVal"></div></td></tr></table></div><div class="input_box"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td class="formhlwpbody-text">Credit Card Holder? :</td></tr><tr><td height="25">   <div style=" float:left; width:15px; height:auto; clear:right; margin-left:0px; margin-top:5px; " ><input type="radio" value="1" name="CC_Holder" id="CC_Holder" style="border:none;" onClick="addElement();"></div><div style=" float:left; width:15px; height:auto; clear:right; margin-left:8px; margin-top:8px;  color:#FFF;  font-size:12px; text-transform:none;"  class="text"> Yes</div><div style=" float:left; width:15px; height:auto; clear:right; margin-left:13px; margin-top:5px; "><input type="radio" value="2" name="CC_Holder" id="CC_Holder" style="border:none;" onClick="removeElement();"></div><div style=" float:left; width:10px; height:auto; clear:right; margin-left:5px; margin-top:8px;  color:#FFF;  font-size:12px; text-transform:none;"  class="text"> No</div><div id="ccholderVal"></div>   </td></tr></table></div><div style="clear:both;"></div><div id="myDiv"></div><div id="icici_rqdfield"></div><div style="clear:both; height:10px;"></div>';
	}
	else
	{
		ni1.innerHTML = '<div style="padding-left:20px; padding-top:7px;" ><table width="98%" border="0" cellpadding="0" cellspacing="0"><tr><td width="21%"  align="left" style="font-size:19px; color:#000; padding-top:5px;"> Personal Details</td><td style="font-size:13px; color:#000;"><img src="http://www.deal4loans.com/images/security.png" width="14" height="16"> Your Information is secure with us and will not be shared without your consent</td></tr></table></div> <div style="clear:both;"></div><div class="input_box"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td class="formhlwpbody-text">Full Name :<span style="color:#FF0000; font-weight:bold;">*</span></td></tr><tr><td height="25"> <input name="Full_Name" id="Full_Name" type="text" class="input"  onkeydown="validateDiv(\'nameVal\');" /><div id="nameVal"></div>     </td></tr></table></div><div class="input_box"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td class="formhlwpbody-text">Mobile :<span style="color:#FF0000; font-weight:bold;">*</span></td></tr><tr><td class="formhlwpbody-text"><table width="100%" cellpadding="0" cellspacing="0"><tr><td>+91 </td><td><input name="Phone" id="Phone" maxlength="10" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" onChange="intOnly(this);" type="text" class="mobile"  onkeydown="validateDiv(\'phoneVal\');"  /></td></tr></table><div id="phoneVal"></div> </td></tr></table></div><div class="input_box"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td class="formhlwpbody-text">Email :<span style="color:#FF0000; font-weight:bold;">*</span></td></tr><tr><td height="25">  <input name="Email" id="Email" type="text" class="input"   onkeydown="validateDiv(\'emailVal\');"  /><div id="emailVal"></div></td></tr></table></div><div class="input_box"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td class="formhlwpbody-text"> DOB:<span style="color:#FF0000; font-weight:bold;">*</span></td></tr><tr><td height="25" >  <input name="day" id="day" type="text"  class="dd" value="dd" onBlur="onBlurDefault(this,\'dd\');" onFocus="onFocusBlank(this,\'dd\');" maxlength="2" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" onKeyDown="validateDiv(\'dobVal\');" /><input name="month" id="month" type="text" class="dd" value="mm" onBlur="onBlurDefault(this,\'mm\');" onFocus="onFocusBlank(this,\'mm\');" maxlength="2" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" onKeyDown="validateDiv(\'dobVal\');" /><input name="year" id="year" type="text" class="yy" value="yyyy" onBlur="onBlurDefault(this,\'yyyy\');" onFocus="onFocusBlank(this,\'yyyy\');" maxlength="4" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" onKeyDown="validateDiv(\'dobVal\');" /><div id="dobVal"></div>  </td></tr></table></div><div style="clear:both;"></div><div class="input_box"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td class="formhlwpbody-text">Company Name :</td></tr><tr><td height="25"> <input name="Company_Name" id="Company_Name" type="text" autocomplete="off" class="input" onKeyDown="validateDiv(\'companyNameVal\');"  onKeyUp="ajax_showOptions(this,\'getCountriesByLetters\',event)"  value="Type Slowly for Autofill" onBlur="onBlurDefault(this,\'Type Slowly for Autofill\');" onFocus="onFocusBlank(this,\'Type Slowly for Autofill\');"/><div id="companyNameVal"></div></td></tr></table></div><div class="input_box"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td class="formhlwpbody-text">Pincode :</td></tr><tr><td height="25"><input name="Pincode" id="Pincode" type="text" class="input"  onkeydown="validateDiv(\'pincodeVal\');"  maxlength="6"/><div id="pincodeVal"></div></td></tr></table></div><div class="input_box"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td class="formhlwpbody-text">Credit Card Holder? :</td></tr><tr><td> <input type="radio" value="1" name="CC_Holder" id="CC_Holder" style="border:none;" onClick="addElement();"> Yes <input type="radio" value="2" name="CC_Holder" id="CC_Holder" style="border:none;" onClick="removeElement();"> No <div id="ccholderVal"></div>   </td></tr></table></div><div style="clear:both;"></div><div id="myDiv"></div><div id="icici_rqdfield"></div><div style="clear:both; height:10px;"></div>';	
	}
	
	ni3.innerHTML = '<div style="clear:both;"></div><div class="box_term"> <input name="accept" type="checkbox" checked="checked" />I authorize Deal4loans.com & its partnering banks to contact me to explain the product & I Agree to <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow"  style="text-decoration:underline;">Privacy policy</a> and <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow" style="text-decoration:underline;">Terms and Conditions</a>.<div id="acceptVal"></div></div><div class="pl_bnt_b" style="margin-right:60px;"> <input type="image" src="http://www.deal4loans.com/images/wp-loan-get-quote.png" border="0" width="117px" height="44px" value="" /></div> <div style="clear:both;"></div> ';	
}