<?php
require 'scripts/functions.php';
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>HDFC Personal Loan</title>
<script type="text/javascript" src="ajax.js"></script>
<script type="text/javascript" src="ajax-dynamic-hdfc-pllist.js"></script>
<link href="css/hdfc_pl.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="/scripts/common.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<script Language="JavaScript" Type="text/javascript">
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

function addElement()
{
	var ni = document.getElementById('myDiv');
		
		if(ni.innerHTML=="")
		{		
			if(document.hdfc_calc.loan_running.value="on")
			{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '<table width="100%"  border="0" cellspacing="0" cellpadding="0"><tr><td width="23%" height="25" align="left" valign="middle" class="boldtxt">Availed Loan Amount</td><td width="29%" align="left"><input type="text" name="availed_loan_amt" id="availed_loan_amt"  style="width: 145px;" onkeyup="intOnly(this);" onkeypress="intOnly(this);" /></td><td width="22%" height="25" align="left" valign="middle" class="boldtxt">Amount of EMI Paying</td><td width="26%" align="left"><input type="text" name="hdfc_emi_amt" id="hdfc_emi_amt"  style="width: 145px;" onkeyup="intOnly(this);" onkeypress="intOnly(this);" /></td></tr><tr><td height="25" align="left" valign="middle" class="boldtxt">Tenure</td><td align="left"><select name="hdfc_loan_tenure" id="hdfc_loan_tenure" style="width:149px; font-size:13px; "><option value="">Please Select</option><option value="12">12 months (1 yr)</option><option value="24">24 months (2 yrs)</option><option value="36">36 months (3 yrs)</option><option value="48">48 months (4 yrs)</option><option value="60">60 months (5 yrs)</option></select></td><td height="25" align="left" valign="middle"  class="boldtxt">No Of EMI Paid ?</td><td align="left"><select name="no_emi_paid"  style="width: 149px; font-size:13px;"><option value="0">Please select</option><option value="1">Less than 9 months</option><option value="2">9 to 12 months</option><option value="3">more than 12 months</option ></select></td></tr></table>';
			}
		}
		
		return true;

	}


function removeElement()
{
		var ni = document.getElementById('myDiv');
		
		if(ni.innerHTML!="")
		{
		
			if(document.hdfc_calc.loan_running.value="on")
			{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '';
				
			}
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

function chkpersonalloan(Form)
{
	var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
	var dt,mdate;dt=new Date();
	var alpha=/^[a-zA-Z\ ]*$/;
	var alphanum=/^[a-zA-Z0-9]*$/;
	var num=/^[0-9]*$/;
	var space=/^[\ ]*$/;
	var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";
	var myOption;
	var i;
	
	if((Form.full_name.value=="") || (Form.full_name.value=="Name")|| (Trim(Form.full_name.value))==false)
	{
		alert("Kindly fill in your Name!");
		Form.full_name.focus();
		return false;
	}
	else if(containsdigit(Form.full_name.value)==true)
	{
		alert("Name contains numbers!");
		Form.full_name.focus();
		return false;
	}
	for (var i = 0; i < Form.full_name.value.length; i++) {
	if (iChars.indexOf(Form.full_name.value.charAt(i)) != -1) {
		alert ("Name has special characters.\n Please remove them and try again.");
		Form.full_name.focus();
		return false;
	}
	}
/*	if((Form.age.value=="") || (Form.age.value=="Name")|| (Trim(Form.age.value))==false)
	{
		alert("Kindly fill in your Age!");
		Form.age.focus();
		return false;
	}
*/

if(Form.day.value=="" ||  Form.day.value=="DD")
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
	
	if(Form.month.value=="" || Form.month.value=="MM")
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

	if(Form.year.value=="" || Form.year.value=="YYYY")
	{
		alert("Please fill your year of birth.");
		Form.year.focus();
		return false;
	}
		if(Form.year.value!="")
	{
	if((Form.year.value < "1948") || (Form.year.value >"1992"))
	{
		alert("Age Criteria! \n Applicants between age group 18 - 62 only are elgibile.");
		Form.year.focus();
		return false;
		}
	}
	
	if(!checkData(Form.year, 'Year', 4))
		return false;
		
			
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
	if(Form.email_id.value!="Email Id")
		{
			if (!validmail(Form.email_id.value))
			{
				//alert("Please enter your valid email address!");
				Form.email_id.focus();
				return false;
			}
			
		}
		/*
		if(Form.Employment_Status.selectedIndex==0)
		{
			alert("Please select emplyment status ");
			Form.Employment_Status.focus();
			return false;
		}
*/
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
	
	if((Form.net_salary.value=='') || (Form.net_salary.value=="Monthly Income"))
	{
		alert("Please enter Income to Continue");
		Form.net_salary.focus();
		return false;
	}
	if(Form.City.selectedIndex==0)
	{
		alert("Please enter City Name to Continue");
		Form.City.focus();
		return false;
	}
	if(Form.company_cate_type.selectedIndex==0)
	{
		alert("Please enter Company Type");
		Form.company_cate_type.focus();
		return false;
	}
	if(Form.company_type.selectedIndex==0)
	{
		alert("Please enter Company Category");
		Form.company_type.focus();
		return false;
	}

	myOption = -1;
		for (i=Form.loan_running.length-1; i > -1; i--) {
			if(Form.loan_running[i].checked) {
				if(i==0)
				{
					if (Form.availed_loan_amt.value=='')
					{
							alert("Please Enter the Loan Amount availed from HDFC");
							Form.availed_loan_amt.focus();
							return false;
					}

					if (Form.hdfc_loan_tenure.selectedIndex==0)
					{
							alert("Please Select The Loan Tenure");
							Form.hdfc_loan_tenure.focus();
							return false;
					}
					if (Form.hdfc_emi_amt.value=='')
					{
							alert("Please Enter Amount of EMI Paying to  HDFC");
							Form.hdfc_emi_amt.focus();
							return false;
					}

					if (Form.no_emi_paid.selectedIndex==0)
					{
							alert("Please Enter No of EMI Paid so far");
							Form.no_emi_paid.focus();
							return false;
					}

				}
					myOption = i;
	
			}
		}
	
		if (myOption == -1) 
		{
			alert("Please select do you have any Personal loan running with HDFC or not");
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
function Trim(strValue)
	{
		var j=strValue.length-1;i=0;
		while(strValue.charAt(i++)==' ');
		while(strValue.charAt(j--)==' ');
		return strValue.substr(--i,++j-i+1);
	}

	</script>
</head>

<body>
<table width="990" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="6" class="lftshado">&nbsp;</td>
    <td bgcolor="#FFFFFF"><table width="965"  border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="77%" height="74"><img src="new-images/hdfc-pl/hdfcbank_logo.gif" width="171" height="29"></td>
            <td width="23%"><img src="new-images/hdfc-pl/deal4loans_logo.gif" width="200" height="54"></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="200" height="290" align="left" valign="top"><img src="new-images/hdfc-pl/hdr1.gif" width="200" height="290"></td>
            <td width="187"><img src="new-images/hdfc-pl/hdr2.gif" width="187" height="290"></td>
            <td width="202"><img src="new-images/hdfc-pl/hdr3.gif" width="202" height="290"></td>
            <td width="193" align="left" valign="top"><img src="new-images/hdfc-pl/hdr4.gif" width="193" height="290"></td>
            <td width="183" align="left" valign="top"><img src="new-images/hdfc-pl/hdr5.gif" width="183" height="290"></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td height="3"></td>
      </tr>
      <tr>
        <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top" class="frmbg">
			<form name="hdfc_calc" method="POST" action="hdfc-personal-loan-thank.php" onSubmit="return chkpersonalloan(document.hdfc_calc);">

			<table width="98%"  border="0" align="right" cellpadding="0" cellspacing="0">
              <tr>
                <td height="35" class="frmhdng">Apply Now to get Instant Personal Loan Eligibility Quote
</td>
              </tr>
              <tr>
                <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="23%" height="25" class="boldtxt">Name</td>
                    <td width="29%" align="left"><input name="full_name" id="full_name" type="text" style="width: 145px;" tabindex="1" /></td>
                    <td class="boldtxt">City</td>
                    <td align="left"><select name="City" id="City"  style="width: 149px; font-size:13px;" onchange="othercity1();  insertData();" tabindex="9">
                      <?=plgetCityList($City)?>
                    </select></td>
                  </tr>
                  <tr>
                    <td height="25" class="boldtxt">DOB</td>
                    <td align="left" class="boldtxt"><!--<input name="age" id="age" type="text" tabindex="1"  style="width: 120px;" maxlength="2" onkeyup="intOnly(this);" onkeypress="intOnly(this);" />(In Yrs)-->
                        <input name="day" type="text" id="day"  value="DD" style="  width:35px; font-size:12px; " onblur="onBlurDefault(this,'DD');" onfocus="onFocusBlank(this,'DD');" maxlength="2" onkeyup="intOnly(this);" onkeypress="intOnly(this);" tabindex="3"/>
                        <input  name="month" type="text" id="month" style="width:35px;  font-size:12px; " value="MM" onblur="onBlurDefault(this,'MM');" onfocus="onFocusBlank(this,'MM');" maxlength="2" onkeyup="intOnly(this);" onkeypress="intOnly(this);" tabindex="4"/>
                        <input name="year" type="text" id="year" style="width:59px;  font-size:12px; " value="YYYY" onblur="onBlurDefault(this,'YYYY');" onfocus="onFocusBlank(this,'YYYY');" maxlength="4" onkeyup="intOnly(this);" onkeypress="intOnly(this);" tabindex="4"/></td>
                    <td width="22%" class="boldtxt">Company Type </td>
                    <td width="26%" align="left">
                      <select name="company_cate_type" id="company_cate_type" style="width: 149px; font-size:13px;" tabindex="10">
                        <option value="0">Please Select</option>
                        <option value="1">Pvt Ltd</option>
                        <option value="2">MNC Pvt Ltd</option>
                        <option value="3">Limited</option>
						<option value="4">Partership</option>
						<option value="5">Sole Proprietor</option>
                      </select>
                    </span></td>
                  </tr>
                  <tr>
                    <td height="25" class="boldtxt">Mobile</td>
                    <td align="left" class="boldtxt"> +91
                        <input type="text" style="width:117px;" name="Phone" id="Phone" maxlength="10"   onkeyup="intOnly(this);" onkeypress="intOnly(this);" onchange="intOnly(this);"  tabindex="5"/></td>
                    <td class="boldtxt"> Company Category </td>
                    <td align="left">
                     <select name="company_type" id="company_type" tabindex="11" style="width: 149px; font-size:13px;">
					<option value="">Please Select</option>
				<option value="BPO">BPO</option>
				<option value="Insurance">Insurance</option>
				<option value="Others">Others</option>
			</select>
                    </td>
                  </tr>
                  <tr>
                    <td height="25" class="boldtxt">Email Id</td>
                    <td align="left"><input name="email_id" id="email_id" type="text" tabindex="5"    style="width: 145px;" /></td>
                    <td class="boldtxt">Primary Account </td>
                    <td align="left"><select name="primary_acc" id="primary_acc"  style="width: 149px; font-size:13px;" tabindex="12" >
                      <option value="HDFC Bank">HDFC Bank</option>
                      <option value="Other">Other</option>
                    </select></td>
                  </tr>
                 
				  <tr>
				    <td height="25" class="boldtxt">Employment Status</td>
				    <td align="left"><select   name="Employment_Status"  id="Employment_Status" style="width:149px; font-size:13px;" tabindex="6" >
                        <option value="1">Salaried</option>
                        <option value="0">Self Employment</option>
                    </select></td>
                    <td class="boldtxt">No. of Loan Running </td>
                    <td align="left"><select name="no_of_loans"  style="width: 149px; font-size:13px;" tabindex="13" >
                      <option value="">0</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">More than 3</option>
                    </select></td>
                  </tr>
				   <tr>
				     <td height="25" class="boldtxt">Company Name</td>
				     <td align="left"><input name="Company_Name" id="Company_Name" type="text" tabindex="7"    style="width: 145px;"  onblur="onBlurDefault(this,'Company Name');" onKeyUp="ajax_showOptions(this,'getCountriesByLetters',event)" onfocus="onFocusBlank(this,'Company Name');" /></td>
                    <td class="boldtxt">Clubbed EMI :</td>
                    <td align="left"><input type="text" name="clubbed_emi" id="clubbed_emi"  style="width: 145px;" tabindex="14" onkeyup="intOnly(this);" onkeypress="intOnly(this);" /></td>
                  </tr>
                  <tr>
                    <td height="25" class="boldtxt"> Net Salary <br>
                      <font style="font-family: verdana; font-size:10px; font-weight:normal; ">(Per month)</font></td>
                    <td align="left"><input type="text" name="net_salary" id="net_salary" style="width:145px;" onkeyup="intOnly(this); getDigitToWords('net_salary','formatedIncome','wordIncome');" onkeypress="intOnly(this);"  onblur="getDigitToWords('net_salary','formatedIncome','wordIncome');" tabindex="8" /></td>
                  <td colspan="2"  ><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td class="boldtxt"><b>Personal Loan Running with HDFC Bank ?</b></td>
                        </tr>
                      <tr>
                        <td height="25" class="boldtxt" style="font-weight:normal; "><input type="radio" name="loan_running" id="loan_running" value="1" onClick="addElement();" style="border:none ;" tabindex="15"/>
                          Yes &nbsp;
                          <input type="radio" name="loan_running" id="loan_running" value="2" onClick="removeElement();" style="border:none ;" tabindex="16"/>
                          No</td>
                        </tr>
                    </table></td> 
                  </tr>
                  <tr>
                    <td  valign="top" colspan="2"><span id='formatedIncome' style='font-size:11px;
font-weight:normal; color:#b04c09;font-Family:Verdana;'></span>
<span id='wordIncome' style='font-size:11px;
font-weight:normal; color:#b04c09;font-Family:Verdana;text-transform: capitalize;'></span></td>
<td colspan="2"  ></td></tr>
                  <tr>
                    <td  valign="top" colspan="4"><div id="myDiv"></div></td>
                    </tr>                  
                  <tr>
                    <td height="58" colspan="3" valign="middle" class="privcytxt"  style="text-align:justify; padding-right:10px; "  ><input type="checkbox" style="border:none ;" name="accept" id="accept">    I / We declare that the information provided herein above is accurate and complete. I/We understand that the offer of the bank is only indicative and final sanction including the amount and the tenure of the loan is at the sole discretion of the bank  and subject to my creditability and the bank may at its discretion conduct additional verification to complete this process. </td>
                    <td align="left"><input name="image"  value="Submit" type="image" src="new-images/hdfc-pl/get_quote.gif" width="151" height="37"  style="border:0px;" /></td>
                  </tr>
                </table></td>
              </tr>
            </table></form></td>
            <td width="280" height="306" align="right" valign="top"><a href="http://server.iad.liveperson.net/hc/18259720/?cmd=file&file=visitorWantsToChat&site=18259720&imageUrl=http://server.iad.liveperson.net/hcp/Gallery/ChatButton-Gallery/English/General/1a/&referrer=http://www.deal4loans.com&utm_content=ad+banner&utm_campaign=d4l/test/personal_loans.htm"><img src="new-images/hdfc-pl/chat_online_banner3.gif" width="280" height="306" border="0"></a></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td height="3"></td>
      </tr>
      <tr>
        <td height="33" bgcolor="#f6f6f6" class="hdng">Features of HDFC Bank Personal Loan</td>
      </tr>
      <tr>
        <td style="padding-left:50px; " align="left"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="21"><img src="new-images/hdfc-pl/bullet.gif" width="8" height="8"></td>
            <td width="522" height="30" class="blutxt">Get cash loan upto 15 Lacs<br></td>
            <td width="24"><img src="new-images/hdfc-pl/bullet.gif" width="8" height="8"></td>
            <td width="348" class="blutxt">Get loans for 12 to 60 months</td>
          </tr>
          <tr>
            <td width="21"><img src="new-images/hdfc-pl/bullet.gif" width="8" height="8"></td>
            <td height="30" class="blutxt">Rate of Interest ranges between 15.5-22 %</td>
            <td width="24"><img src="new-images/hdfc-pl/bullet.gif" width="8" height="8"></td>
            <td class="blutxt">Repay in easy EMIs</td>
          </tr>
          <tr>
            <td><img src="new-images/hdfc-pl/bullet.gif" width="8" height="8"></td>
            <td height="30" class="blutxt">No collateral requirement</td>
            <td><img src="new-images/hdfc-pl/bullet.gif" width="8" height="8"></td>
            <td class="blutxt">Easy Documentation</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
    </table></td>
    <td width="6" class="rgtshado">&nbsp;</td>
  </tr>
</table>

<!-- BEGIN LivePerson Monitor. --><script language='javascript'> var lpMTagConfig = {'lpServer' : "server.iad.liveperson.net",'lpNumber' : "18259720",'lpProtocol' : (document.location.toString().indexOf('https:')==0) ? 'https' : 'http'}; function lpAddMonitorTag(src){if(typeof(src)=='undefined'||typeof(src)=='object'){src=lpMTagConfig.lpMTagSrc?lpMTagConfig.lpMTagSrc:'/hcp/html/mTag.js';}if(src.indexOf('http')!=0){src=lpMTagConfig.lpProtocol+"://"+lpMTagConfig.lpServer+src+'?site='+lpMTagConfig.lpNumber;}else{if(src.indexOf('site=')<0){if(src.indexOf('?')<0)src=src+'?';else src=src+'&';src=src+'site='+lpMTagConfig.lpNumber;}};var s=document.createElement('script');s.setAttribute('type','text/javascript');s.setAttribute('charset','iso-8859-1');s.setAttribute('src',src);document.getElementsByTagName('head').item(0).appendChild(s);} if (window.attachEvent) window.attachEvent('onload',lpAddMonitorTag); else window.addEventListener("load",lpAddMonitorTag,false);</script><!-- END LivePerson Monitor. -->

</body>
</html>
