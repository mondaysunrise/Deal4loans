<script src='/scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<script type="text/javascript" src="/scripts/common.js"></script>
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
function cityother()
{
	if(document.loan_form.City.value=="Others")
	{
		document.loan_form.City_Other.disabled = false;
	}
	else
	{
		document.loan_form.City_Other.disabled = true;
	}
} 
function validmobile(mobile) 
{
	
	atPos = mobile.indexOf("0")// there must be one "@" symbol
	if (atPos == 0) 
	{
		alert("Mobile number cannot start with 0.");
		return false;
	}
	if(!checkData(document.loan_form.Phone, 'Mobile number', 10))
		return false;

return true;
}

function Trim(strValue) {
var j=strValue.length-1;i=0;
while(strValue.charAt(i++)==' ');
while(strValue.charAt(j--)==' ');
return strValue.substr(--i,++j-i+1);
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
	
	if (document.loan_form.City.selectedIndex==0)
	{
		document.getElementById('cityVal').innerHTML = "<span  class='hintanchor'>Enter City to Continue!</span>";	
		document.loan_form.City.focus();
		return false;
	}
		if((document.loan_form.City.value=="Others") && ((document.loan_form.City_Other.value=="" || document.loan_form.City_Other.value=="Other City"  ) || !isNaN(document.loan_form.City_Other.value)))
	{
		document.getElementById('othercityVal').innerHTML = "<span  class='hintanchor'>Enter Other City to Continue!</span>";		
		document.loan_form.City_Other.focus();
		return false;
	}
	for (var i = 0; i <document.loan_form.City_Other.value.length; i++) {
  	if (iChars.indexOf(document.loan_form.City_Other.value.charAt(i)) != -1) {
		document.getElementById('othercityVal').innerHTML = "<span  class='hintanchor'>Remove Special Characters!</span>";	
		document.loan_form.City_Other.focus();
  		return false;
  	}
  }

	
	if (document.loan_form.Net_Salary.value=="")
	{
		document.getElementById('netSalaryVal').innerHTML = "<span  class='hintanchor'>Enter Annual Income!</span>";	
		document.loan_form.Net_Salary.focus();
		return false;
	}	
	if(!checkNum(document.loan_form.Net_Salary, 'Annual Income',0))
		return false;

	if (document.loan_form.Loan_Amount.value=="")
	{
		document.getElementById('loanAmtVal').innerHTML = "<span  class='hintanchor'>Enter Loan Amount!</span>";	
		document.loan_form.Loan_Amount.focus();
		return false;
	}	
	if(!checkNum(document.loan_form.Loan_Amount, 'Loan Amount',0))
		return false;
	
	if(!document.loan_form.accept.checked)
	{
		document.getElementById('acceptVal').innerHTML = "<span  class='hintanchor'>Read and Accept Terms & Conditions!</span>";	

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

function addhdfclife()
{
	var ni1 = document.getElementById('hdfclife');
	var cit = document.loan_form.City.value;
	var otrcit = document.loan_form.City_Other.value;
	//alert(cit);	
	if(cit =="Baroda" || cit =="Bhubaneshwar" || cit =="Chandigarh" || cit =="Cuttack" || cit =="Delhi" || cit =="Faridabad" || cit =="Gaziabad" || cit =="Gurgaon" || cit =="Guwahati" || cit =="Hyderabad" || cit =="Indore" || cit =="Jaipur" || cit =="Kanpur" || cit =="Kolkata" || cit =="Lucknow" || cit =="Mumbai" || cit =="Noida" || cit =="Pune" || cit =="Sahibabad" ||
cit =="Surat" || cit =="Thane" || cit =="Vadodara" || cit =="Vijaywada" || cit =="Vishakapatanam" || cit =="Vizag" )
	{
		//alert("ranjana");
		ni1.innerHTML = '<table  style="border:1px solid #000000; padding:2px;"><tr><td colspan="2" class="frmbldtxt" style="font-family:verdana; font-size:10px; color:#ffffff; font-weight:normal; " height="20"><span style="color:#FF0000;">(Optional) </span>Special service only for Deal4loans customers:</td></tr> <tr><td width="23"><input type="checkbox"  name="hdfclife" id="hdfclife" value="1"/></td> <td width="611" class="frmbldtxt" style="font-family:verdana; font-size:10px; color:#ffffff; font-weight:normal; "> I would like to avail of <b>FREE </b>financial planning services by <b>Insurance & Investment experts</b> from HDFC Life.</td>		 </tr>	 </table>';	
	}
	else if(cit =="Cochin" || cit =="Chennai" || cit =="Bangalore" || cit =="Mangalore" || cit =="Madurai" || cit =="Salem" || cit =="Trivandrum" || cit =="Kochi" || cit =="Coimbatore" || cit =="Erode" || cit =="Trichy" || cit =="Thrissur" || cit =="Pondicherry")
	{
		ni1.innerHTML ='<table  style="border:1px solid #000000; padding:2px;"><tr><td colspan="2" class="frmbldtxt" style="font-family:verdana; font-size:10px; color:#ffffff; font-weight:normal; " height="20"><span style="color:#FF0000;">(Optional) </span>Special service only for Deal4loans customers:</td></tr> <tr><td width="23"><input type="checkbox"  name="mahindra_life" id="mahindra_life" value="2"/></td> <td width="611" class="frmbldtxt" style="font-family:verdana; font-size:10px; color:#ffffff; font-weight:normal; "> If you are also interested in a Mahindra Lifespaces-Iris Court Chennai Property, Please tick here, we will get in touch with you.</td></tr>	 </table>';
	}
	else
	{
		ni1.innerHTML = '';
	}
	return true;
}


function validateDiv(div)
{

	var ni1 = document.getElementById(div);
	ni1.innerHTML = '';
}
</script>
<div style=" width:300px; height:auto; margin-left:24px; border-radius:7px 7px 7px 7px; background:#21405f;">

<div class="text3" style="width:300px; margin:auto; height:auto; font-size:11px; color:#88a943; margin-top:0px;">
<form name="loan_form" method="post" action="insert_home_loan_step_value1.php" onSubmit="return chkform();">
<input type="hidden" name="Activate" id="Activate" ><input type="hidden" name="source" value="<?php echo $newsource; ?>">
<input type="hidden" name="PostURL" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
<input type="hidden" name="Type_Loan" id="Type_Loan" value="Req_Loan_Home">
<table width="300" border="0" cellspacing="0" cellpadding="0" align="center";>
<tr>
	<td height="10" align="left" valign="top"></td>
</tr>
<tr>
	<td align="left" valign="top" bgcolor="#21405F"><table border="0" cellpadding="0" cellspacing="0">
<tr>
	<td width="2" align="left" valign="top">&nbsp;</td>
	<td  align="center" valign="top" width="298">
		<table width="298" border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td align="left" valign="top" colspan="2" height="25" style=" color:#FFF; font-size:12px;  text-align:center; ">
				<strong>Compare Home loan Rates & Eligibility</strong>			</td>
		</tr>
                <tr>
			<td align="left" valign="top" colspan="2" style=" color:#FFF; font-size:11px; height:30; text-transform:capitalize; padding-left:0px; ">
 <strong>Bank A</strong> - Fixed rate for 2 years<span style="color:#FF0000; font-weight:bold;">*</span> <br />
 <strong>Bank B</strong> - Fixed rate for 10 years.<span style="color:#FF0000; font-weight:bold;">*</span><br />
 <strong>Bank C</strong> -  Last  12 month  Emi waived off<span style="color:#FF0000; font-weight:bold;">*</span><br />
 Check your Free  customized Offers from 10 other Banks

 <hr style="color:#CCCCCC;" align="center" width="280" />
 </td>
		</tr>
<tr>
<td width="120" height="33" align="left" valign="middle" class="text" style="  color:#FFF; font-size:11px; ">&nbsp;&nbsp;
Full Name</td>
<td width="178" class="text" style="  color:#FFF; font-size:11px;  " height="23">
<input name="Name" id="Name" type="text" style="width:150px; height:18px;" onKeyDown="validateDiv('nameVal');" />
<div id="nameVal"></div>    
</td>
</tr>
<tr>
<td width="120" height="33" class="text" valign="middle"  style="  color:#FFF; font-size:11px; ">&nbsp;&nbsp;
Mobile</td>
<td width="178" class="text" style="  color:#FFF; font-size:11px;  ">
+91 
<input name="Phone" id="Phone" maxlength="10" onkeyup="intOnly(this);" onkeypress="intOnly(this)"; onchange="intOnly(this);" type="text" style="width:128px; height:18px;" onkeydown="validateDiv('phoneVal');"  />
            <div id="phoneVal"></div>    
</td>
</tr>
<tr>
<td width="120" height="33" class="text" style="  color:#FFF; font-size:11px; ">
&nbsp;&nbsp;Email ID </td>
<td width="178" class="text" style="  color:#FFF; font-size:11px;  ">
<input name="Email" id="Email" type="text" style="width:150px; height:18px;" onkeydown="validateDiv('emailVal');"  />
          <div id="emailVal"></div>   
</td>
</tr>
<tr>
<td width="120" height="33" align="left" valign="middle" class="text" style="  color:#FFF; font-size:11px; ">
&nbsp;&nbsp;City</td>
<td width="178" class="text" style="  color:#FFF; font-size:11px;  ">
    <select name="City" id="City" style="width:154px; height:24px; font-family:Verdana, Geneva, sans-serif; font-size:11px; color:#4c4c4c;" onchange="cityother(); addhdfclife(); validateDiv('cityVal');" tabindex="7">
                            <?=plgetCityList($City)?>
                        </select>
                        <div id="cityVal"></div>   
</td>
</tr>
<tr>
<td width="120" height="33" align="left" valign="middle" class="text" style="  color:#FFF; font-size:11px; ">
&nbsp;&nbsp;Other City</td>
<td width="178" class="text" style="  color:#FFF; font-size:11px;  ">
       <input name="City_Other" id="City_Other" type="text" style="width:150px; height:18px;" disabled onKeyUp="searchSuggest();" onKeyDown="validateDiv('othercityVal');"  />
                        <div id="othercityVal"></div>   
</td>
</tr>
<tr>
<td width="120" height="33" align="left" valign="middle" class="text" style="color:#FFF; font-size:11px;  padding-right:2px;">
&nbsp;&nbsp;Annual Income</td>
<td width="178" class="text" style="color:#FFF; font-size:11px;  ">
  <input type="text" name="Net_Salary" id="Net_Salary" style="width:150px; height:18px;"  onkeyup="intOnly(this); getDigitToWords('Net_Salary','formatedIncome','wordIncome');" onkeypress="intOnly(this);"  onblur="getDigitToWords('Net_Salary','formatedIncome','wordIncome');"  onchange="ShowHide('incomeShow','Net_Salary');" onkeydown="validateDiv('netSalaryVal');"  />
              
        <div id="netSalaryVal"></div>  
</td>
</tr>
<tr><td colspan="2"> <span id='formatedIncome' style='font-size:11px;
font-weight:normal; color:#ffffff;font-Family:Verdana;'></span> <span id='wordIncome' style='font-size:11px;
font-weight:normal; color:#ffffff;font-Family:Verdana;text-transform: capitalize;'></span></td></tr>
<tr>
<td width="120" height="33" align="left" valign="middle" class="text" style="color:#FFF; font-size:11px;  padding-right:2px;">&nbsp;&nbsp;Loan Amount </td>
<td width="178" class="text" style="color:#FFF; font-size:11px;  ">
  <input name="Loan_Amount" id="Loan_Amount" maxlength="8" onkeypress="intOnly(this);" onkeyup="intOnly(this); getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');"  onblur="getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');"  type="text" style="width:150px; height:18px;" onkeydown="validateDiv('loanAmtVal');" />
     <div id="loanAmtVal"></div>  
</td>
</tr>
<tr><td colspan="2"> <span id='formatedlA' style='font-size:11px;
font-weight:normal; color:#ffffff;font-Family:Verdana;'></span><span id='wordloanAmount' style='font-size:11px;
font-weight:normal; color:#ffffff;font-Family:Verdana;text-transform: capitalize;'></span></td></tr>
 <tr><td style="padding:5px; text-transform:capitalize;" colspan="2"> <div id="hdfclife"></div></td></tr>
<tr>
<td align="left" valign="top" colspan="2"  height="33" class="text9" style=" color:#FFF; font-size:8px; margin-top:0px; text-transform:capitalize; margin-left:10px;"><input name="accept" type="checkbox" tabindex="7" onclick="validateDiv('acceptVal');" /> I Agree to <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow"  class="text" style="font-size:8px;  color:#88a943; text-decoration:underline;">privacy policy</a> and&nbsp;<a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow" class="text" style=" color:#88a943; font-size:8px; text-decoration:underline;">Terms and Conditions</a> of deal4loans.com.
     <div id="acceptVal"></div>
</td>
</tr>
<tr>
<td>&nbsp;</td><td  align="center" valign="top"  height="33"  style= "margin-left:0px;">
<input type="submit" style="border: 0px none ; background-image: url(images/get_quot.jpg); width: 94px; height: 27px; margin-bottom: 0px;" value="" tabindex="8"/>
</td>
</tr>
<tr>
<td align="left" valign="top" colspan="2" class="text9" style=" color:#FFF; font-size:9px; margin-top:0px; text-transform:capitalize;">
<span style="color:#FF0000; font-weight:bold;">*</span> All loans and offers on sole discretion of banks.
</td>
</tr> 
</table>
        </td>
</tr>

</table></td>
</tr>
<tr>
<td height="15" align="left" valign="top"></td>
</tr>
</table>
</form>
</div>
</div>