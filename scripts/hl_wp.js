function onFocusBlank(element,defaultVal){	if(element.value==defaultVal){		element.value="";	} }
function onBlurDefault(element,defaultVal){	if(element.value==""){		element.value = defaultVal;	} }
function cityother() {	if(document.loan_form.City.value=="Others")	{		document.loan_form.City_Other.disabled = false;	}	else	{		document.loan_form.City_Other.disabled = true;	}} 
function Trim(strValue) {	var j=strValue.length-1;i=0;	while(strValue.charAt(i++)==' ');	while(strValue.charAt(j--)==' ');	return strValue.substr(--i,++j-i+1); }
function containsdigit(param) {	mystrLen = param.length;	for(i=0;i<mystrLen;i++)	{		if((param.charAt(i)=="0") || (param.charAt(i)=="1") || (param.charAt(i)=="2") || (param.charAt(i)=="3") || (param.charAt(i)=="4") || (param.charAt(i)=="5") || (param.charAt(i)=="6") || (param.charAt(i)=="7") || (param.charAt(i)=="8") || (param.charAt(i)=="9") || (param.charAt(i)=="/"))		{			return true;		}	}	return false;}
function chkform()
{
	var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
	var dt,mdate;dt=new Date();
	var cnt;
	var alpha=/^[a-zA-Z\ ]*$/;
	var alphanum=/^[a-zA-Z0-9]*$/;
	var num=/^[0-9]*$/;
	var space=/^[\ ]*$/;
	var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";
	var curr_dt = '';
	curr_dt = new Date().getFullYear();
	maxage = curr_dt - 62;
	minage = curr_dt - 18

	if (document.loan_form.Loan_Amount.value=="")
	{ document.getElementById('loanAmtVal').innerHTML = "<span  class='hintanchor'>Enter Loan Amount!</span>"; document.loan_form.Loan_Amount.focus();		return false;	}	
	if(!checkNum(document.loan_form.Loan_Amount, 'Loan Amount',0))
		return false;
	
	if (document.loan_form.Employment_Status.selectedIndex==0)
	{
		document.getElementById('empStatusVal').innerHTML = "<span  class='hintanchor'>Select Employment Status to Continue!</span>";	
		document.loan_form.Employment_Status.focus();
		return false;
	}	
		
	if (document.loan_form.Net_Salary.value=="")	{		document.getElementById('netSalaryVal').innerHTML = "<span  class='hintanchor'>Enter Annual Income!</span>";			document.loan_form.Net_Salary.focus();		return false;	}	
	if(!checkNum(document.loan_form.Net_Salary, 'Annual Income',0))
		return false;

	if (document.loan_form.City.selectedIndex==0)
	{		document.getElementById('cityVal').innerHTML = "<span  class='hintanchor'>Enter City to Continue!</span>";			document.loan_form.City.focus();		return false;	}

	if((document.loan_form.Name.value=="") || (Trim(document.loan_form.Name.value))==false)
	{        document.getElementById('nameVal').innerHTML = "<span  class='hintanchor'>Please Enter Your name</span>";				document.loan_form.Name.focus();		return false;	}

	if(document.loan_form.Name.value!="")
	{
		if(containsdigit(document.loan_form.Name.value)==true)
		{			document.getElementById('nameVal').innerHTML = "<span  class='hintanchor'>First Name contains numbers!</span>";			document.loan_form.Name.focus();			return false;		}
	}
   for (var i = 0; i <document.loan_form.Name.value.length; i++) 
   {
		if (iChars.indexOf(document.loan_form.Name.value.charAt(i)) != -1) 
		{			document.getElementById('nameVal').innerHTML = "<span  class='hintanchor'>Contains special characters!</span>";			document.loan_form.Name.focus();			return false;		}
  }
	if(document.loan_form.Email.value=="")
	{		document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter  Email Address!</span>";			document.loan_form.Email.focus();		return false;	}
	var str=document.loan_form.Email.value
	var aa=str.indexOf("@")
	var bb=str.indexOf(".")
	var cc=str.charAt(aa)
	if(aa==-1)
	{		document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter Valid Email Address!</span>";			document.loan_form.Email.focus();		return false;	}
	else if(bb==-1)
	{		document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter Valid Email Address!</span>";			document.loan_form.Email.focus();		return false;	}
	
	if(document.loan_form.Phone.value=="")
	{		document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Fill Mobile Number!</span>";		document.loan_form.Phone.focus();		return false;	}
	if(isNaN(document.loan_form.Phone.value)|| document.loan_form.Phone.value.indexOf(" ")!=-1)
	{		document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Enter numeric value!</span>";		document.loan_form.Phone.focus();		return false;  	}
	if (document.loan_form.Phone.value.length < 10 )
	{	  	document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Enter 10 Digits!</span>";			document.loan_form.Phone.focus();		return false;	}
	if ((document.loan_form.Phone.value.charAt(0)!="9") && (document.loan_form.Phone.value.charAt(0)!="8") && (document.loan_form.Phone.value.charAt(0)!="7"))
	{	  	document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>should start with 9 or 8 or 7!</span>";			document.loan_form.Phone.focus();		return false;	}

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
		if((document.loan_form.year.value < maxage) || (document.loan_form.year.value > minage))
		{
			document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Age between 18 -62!</span>";
			document.loan_form.year.focus();
			return false;
		}
	}
	if(!checkData(document.loan_form.year, 'Year', 4))
		return false;
		
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
	
	for(j=0; j<document.loan_form.Property_Identified.length; j++) 
	{
        if(document.loan_form.Property_Identified[j].checked)
		{
   	 		cnt= j;
		}
	}
	if(cnt == -1) 
	{
		document.getElementById('propEditifiedVal').innerHTML = "<span  class='hintanchor'>Select Property identified or not!</span>";	
		return false;
	}
	if(cnt ==0)
	{ 
		if(document.loan_form.Property_Loc.selectedIndex==0)
		{
			document.getElementById('propEditifiedVal').innerHTML = "<span  class='hintanchor'>Select Property Location!</span>";	
			document.loan_form.Property_Loc.focus();
			return false;
		}
	}

	
	
	if(!document.loan_form.accept.checked)
	
	{		document.getElementById('acceptVal').innerHTML = "<span  class='hintanchor'>Read and Accept Terms & Conditions!</span>";				document.loan_form.accept.focus();		return false;	}	
}  
function addPersonalDetails()
{
	var ni1 = document.getElementById('personalDetails');
	var ni2 = document.getElementById('addSubmit');
	
	ni1.innerHTML = '<div class="box_c"><div class="text_head" style=" margin:0px 0px 0px 0px; padding:0px 0px 0px 0px; font-size: 21px; color: #00000"><div class="prs_detl_box"><div class="prs_detl_box_a"><span style="font-size:21px; color:#00000;">Personal Details</span></div><div class="prs_detl_box_b"><span style="font-size:13px; font-weight:normal; color:#00000;"><img src="/images/security.png" width="14" height="16" /> Your Information is secure with us and will not be shared without your consent</span></div><div style="clear:both;"></div></div><div style="clear:both;"></div></div><div class="input_box"><table width="100%" border="0" cellpadding="0" cellspacing="0"><tr><td><span>Full Name: <span style="color:#FF0000; font-weight:bold;">*</span></span></td></tr><tr><td class="formhlwpbody-text"><input name="Name" id="Name" type="text" class="input" onKeyDown="validateDiv(\'nameVal\');" /><div id="nameVal"></div></td></tr></table></div><div class="input_box"><table width="100%" border="0" cellpadding="0" cellspacing="0"> <tr><td class="formhlwpbody-text"><span >DOB: <span style="color:#FF0000; font-weight:bold;">*</span></span></td></tr><tr><td><input name="day" id="day" type="text" class="dd" value="dd" onBlur="onBlurDefault(this,\'dd\');" onFocus="onFocusBlank(this,\'dd\');" maxlength="2" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" onKeyDown="validateDiv(\'dobVal\');" /><input name="month" id="month" type="text" class="dd" value="mm" onBlur="onBlurDefault(this,\'mm\');" onFocus="onFocusBlank(this,\'mm\');" maxlength="2" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" onKeyDown="validateDiv(\'dobVal\');" /><input name="year" id="year" type="text" class="yy" value="yyyy" onBlur="onBlurDefault(this,\'yyyy\');" onFocus="onFocusBlank(this,\'yyyy\');" maxlength="4" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" onKeyDown="validateDiv(\'dobVal\');" /><div id="dobVal"></div></td></tr></table></div><div class="input_box"><table width="100%" border="0" cellpadding="0" cellspacing="0"><tr><td colspan="2" class="formhlwpbody-text"><span style="  height:auto; color:#00000; text-transform:none;">Mobile: <span style="color:#FF0000; font-weight:bold;">*</span></span></td></tr><tr><td width="18%" class="formhlwpbody-text"><span  style=" color:#00000;  text-transform:none; clear:right; margin-top:3px; ">+91</span></td><td width="82%" align="left"><input name="Phone" id="Phone" maxlength="10" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)"; onChange="intOnly(this);"type="text" class="mobile" onKeyDown="validateDiv(\'phoneVal\');"  /><div id="phoneVal"></div></td></tr></table></div><div class="input_box"><table width="100%" border="0" cellpadding="0" cellspacing="0"><tr><td class="formhlwpbody-text"><span style=" float:left; width:180px; height:auto; color:#00000; text-transform:none;">Email ID : <span style="color:#FF0000; font-weight:bold;">*</span></span></td></tr><tr><td><input name="Email" id="Email" type="text" class="input" onKeyDown="validateDiv(\'emailVal\');"  /><div id="emailVal"></div></td></tr></table></div><div style="clear:both;"></div><div style="clear:both;"></div><div class="input_box">  <table width="100%" border="0" cellpadding="0" cellspacing="0">   <tr><td class="formhlwpbody-text"><span>Pincode </span></td> </tr><tr><td> <input name="Pincode" id="Pincode" maxlength="6" onKeyPress="intOnly(this);" onKeyUp="intOnly(this);"  onkeydown="validateDiv(\'pincodeVal\');" type="text" class="input" tabindex="5" />  <div id="pincodeVal"></div> </td>    </tr>  </table></div><div class="input_box"><table width="100%" border="0" cellpadding="0" cellspacing="0"><tr>  <td class="formhlwpbody-text"><span >Property Value: <span style="color:#FF0000; font-weight:bold;">*</span></span></td></tr><tr>      <td><input name="property_value" id="property_value" maxlength="8" onKeyPress="intOnly(this);" onKeyUp="intOnly(this); "   type="text" class="input" onKeyDown="validateDiv(\'propertyValueVal\');" /><div id="propertyValueVal"></div></td>    </tr>  </table></div><div class="input_box"><table width="100%" border="0" cellpadding="0" cellspacing="0">    <tr>      <td class="formhlwpbody-text"><span>Total EMI of All Loans : <span style="color:#FF0000; font-weight:bold;">*</span></span></td>    </tr>    <tr>      <td><input name="obligations" id="obligations" maxlength="8" onKeyPress="intOnly(this);" onKeyUp="intOnly(this); "   type="text" class="input" onKeyDown="validateDiv(\'obligationVal\');" /><div id="obligationVal"></td>    </tr>  </table>  </div><div class="input_box"><table width="100%" border="0" cellpadding="0" cellspacing="0">    <tr>      <td><span>Property Identified:</span></td>    </tr>    <tr>      <td class="formhlwpbody-text"><input type="radio" name="Property_Identified" id="Property_Identified" value="1" onClick="return addIdentified();" style="border:none;" /> Yes   <input type="radio"  name="Property_Identified" id="Property_Identified" onClick="removeIdentified();" value="0" style="border:none;" checked="checked" /> No </td>    </tr>  </table></div><div style="clear:both;"></div><div class="input_box" id="myDiv1"></div></div>';

ni2.innerHTML = '<table width="100%" border="0" cellspacing="2"> <tr><td> <table cellpadding="0" width="100%"> <tr><td valign="top" ><div class="text" style=" float:left; height:auto; font-size:11px; text-transform:none; margin-top:5px;"><input name="accept" type="checkbox"  /> I authorize Deal4loans.com & its <a href="http://www.deal4loans.com/hl-partnering-banks.php" target="_blank" rel="nofollow"  class="text" style=" color:#0033CC; font-size:11px; text-decoration:underline;"> partnering banks</a> to contact me to explain the product & I Agree to <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow"  class="text" style=" color:#0033CC; font-size:11px; text-decoration:underline;">Privacy policy</a> and <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow"  class="text" style=" color:#0033CC; font-size:11px; text-decoration:underline;">Terms and Conditions</a>.<div id="acceptVal"></div></div></td><td   align="left" valign="top"><div style=" float:right;  height:47px; margin-top:0px; margin-left:0px; margin-right:30px; text-align:center;"> <input type="image" src="http://www.deal4loans.com/images/wp-loan-get-quote.png" width="117px" height="44px" /> </div></td></tr></table></td> </tr> </table>';

}

function showdetailsFaq(d,e)
{			
	for(j=1;j<=e;j++)
	{
		if(d==j)
		{
			if(eval(document.getElementById("divfaq"+j)).style.display=='none')
			{				eval(document.getElementById("divfaq"+j)).style.display=''			}
			else			{				eval(document.getElementById("divfaq"+j)).style.display='none'			}
		}
			
	}
}

function addIdentified()
{
	var ni1 = document.getElementById('myDiv1');
	 ni1.innerHTML = '<div style=" float:left; width:183px; height:47px;  margin-top:5px; text-align:left;"><div class="formhlwpbody-text">Property Location</div>    <div class="text" style="  color:#00000; text-align:left; font-size:12px; text-transform:none; margin-top:5px;"><select name="Property_Loc" id="Property_Loc"  class="select" style=" font-family:Verdana, Geneva, sans-serif; font-size:11px; color:#4c4c4c;"><option value="Please Select">Please Select</option><option value="Ahmedabad">Ahmedabad</option><option value="Aurangabad">Aurangabad</option><option value="Bangalore">Bangalore</option><option value="Baroda">Baroda</option><option value="Bhopal">Bhopal</option><option value="Bhubneshwar">Bhubneshwar</option><option value="Chandigarh">Chandigarh</option><option value="Chennai">Chennai</option><option value="Cochin">Cochin</option><option value="Coimbatore">Coimbatore</option><option value="Cuttack">Cuttack</option><option value="Dehradun">Dehradun</option><option value="Delhi">Delhi</option><option value="Faridabad">Faridabad</option><option value="Gaziabad">Gaziabad</option><option value="Gurgaon">Gurgaon</option><option value="Guwahati">Guwahati</option><option value="Hosur">Hosur</option><option value="Hyderabad">Hyderabad</option><option value="Indore">Indore</option><option value="Jabalpur">Jabalpur</option><option value="Jaipur">Jaipur</option><option value="Jamshedpur">Jamshedpur</option><option value="Kanpur">Kanpur</option><option value="Kochi">Kochi</option><option value="Kolkata">Kolkata</option><option value="Lucknow">Lucknow</option><option value="Ludhiana">Ludhiana</option><option value="Madurai">Madurai</option><option value="Mangalore">Mangalore</option><option value="Mysore">Mysore</option><option value="Mumbai">Mumbai</option><option value="Nagpur">Nagpur</option><option value="Nasik">Nasik</option><option value="Navi Mumbai">Navi Mumbai</option><option value="Noida">Noida</option><option value="Patna">Patna</option><option value="Pune">Pune</option><option value="Ranchi">Ranchi</option><option value="Sahibabad">Sahibabad</option><option value="Surat">Surat</option><option value="Thane">Thane</option><option value="Thiruvananthapuram">Thiruvananthapuram</option><option value="Trivandrum">Trivandrum</option><option value="Trichy">Trichy</option><option value="Vadodara">Vadodara</option><option value="Vishakapatanam">Vishakapatanam</option><option value="Others">Others</option></select></div><div id="vintageVal"></div></div>';
		
		return true;
}	
	
function removeIdentified()
{
	var ni1 = document.getElementById('myDiv1');
	ni1.innerHTML = '';
				
		return true;

}	

/*
function addhdfclife()
{
	var ni1 = document.getElementById('hdfclife');
	var cit = document.loan_form.City.value;
	//var otrcit = document.loan_form.City_Other.value;
//	alert(cit);	
	if(cit =="Baroda" || cit =="Bhubaneshwar" || cit =="Chandigarh" || cit =="Cuttack" || cit =="Delhi" || cit =="Faridabad" || cit =="Gaziabad" || cit =="Gurgaon" || cit =="Guwahati" || cit =="Hyderabad" || cit =="Indore" || cit =="Jaipur" || cit =="Kanpur" || cit =="Kolkata" || cit =="Lucknow" || cit =="Mumbai" || cit =="Noida" || cit =="Pune" || cit =="Sahibabad" || cit =="Thane" || cit =="Vadodara" || cit =="Vijaywada" || cit =="Vishakapatanam" || cit =="Vizag" )
	{
		//alert("ranjana");
		ni1.innerHTML = '<table  style="border:1px solid #000000; padding:2px;"><tr><td colspan="2" class="frmbldtxt" style="font-family:verdana; font-size:10px; color:#ffffff; font-weight:normal; " height="20"><span style="color:#FF0000;">(Optional) </span>Special service only for Deal4loans customers:</td></tr> <tr><td width="23"><input type="checkbox"  name="hdfclife" id="hdfclife" value="1"/></td> <td width="611" class="frmbldtxt" style="font-family:verdana; font-size:10px; color:#ffffff; font-weight:normal; "> I would like to avail of <b>FREE </b>financial planning services by <b>Insurance & Investment experts</b> from HDFC Life.</td>		 </tr>	 </table>';	
	}
	else if(cit =="Cochin" || cit =="Chennai" || cit =="Bangalore" || cit =="Mangalore" || cit =="Madurai" || cit =="Salem" || cit =="Trivandrum" || cit =="Kochi" || cit =="Coimbatore" || cit =="Erode" || cit =="Trichy" || cit =="Thrissur" || cit =="Pondicherry")
	{
		ni1.innerHTML ='<table  style="border:1px solid #000000; padding:2px;"><tr><td colspan="2" class="frmbldtxt" style="font-family:verdana; font-size:10px; color:#ffffff; font-weight:normal; " height="20"><span style="color:#FF0000;">(Optional) </span>Special service only for Deal4loans customers:</td></tr> <tr><td width="23"><input type="checkbox"  name="mahindra_life" id="mahindra_life" value="2"/></td> <td width="711" class="frmbldtxt" style="font-family:verdana; font-size:10px; color:#ffffff; font-weight:normal; "> If you are also interested in a Mahindra Lifespaces-Iris Court Chennai Property, Please tick here, we will get in touch with you.</td></tr>	 </table>';
	}
	else
	{
		ni1.innerHTML = '';
	}
	return true;
}
*/

function validateDiv(div) {	var ni1 = document.getElementById(div); 	ni1.innerHTML = ''; }