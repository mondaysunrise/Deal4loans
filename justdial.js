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
//function validmail(email1) END

function Decoration(strPlan)
{
       if (document.getElementById('plantype') != undefined)  
       {
               document.getElementById('plantype').innerHTML = strPlan;
			   document.getElementById('plantype').style.background='Beige';  
       }

       return true;
}
//function Decoration(strPlan) END

function Decoration1(strPlan)
{
       if (document.getElementById('plantype') != undefined) 
       {
               document.getElementById('plantype').innerHTML = strPlan;
			   document.getElementById('plantype').style.background='';               
       }
       return true;
}
//function Decoration1(strPlan) END

function Decorate(strPlan)
{
       if (document.getElementById('plantype2') != undefined)  
       {
               document.getElementById('plantype2').innerHTML = strPlan;
			   document.getElementById('plantype2').style.background='Beige';  
       }

       return true;
}
//function Decorate(strPlan) END

function Decorate1(strPlan)
{
       if (document.getElementById('plantype2') != undefined) 
       {
               document.getElementById('plantype2').innerHTML = strPlan;
			   document.getElementById('plantype2').style.background='';  
       }
       return true;
}
//function Decorate1(strPlan) END

function validmobile(mobile) 
{
	
	atPos = mobile.indexOf("0")// there must be one "@" symbol
alert (atPos);
	if (atPos == 0) 
	{
		alert("Mobile number cannot start with 0.");
		return false;
	}
	if(!checkData(Form.Phone, 'Mobile number', 10))
		return false;

return true;
}
//function validmobile(mobile) END

function valButton2() 
{
    var cnt = -1;
	var i;
    for(i=0; i<Form.From_Product.length; i++) 
	{
        if(Form.From_Product[i].checked)
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
//function valButton2() END
function addElement()
{
		var ni = document.getElementById('myDivPL');
		
		if(ni.innerHTML=="")
		{
		
			if(document.loan_formPL.CC_Holder.value="on")
			{
				//alert(document.loan_formPL.CC_Holder.value);
				ni.innerHTML = '<table width="302" border="0"><tr><td colspan="4"><font class="style4">I have an active credit card from ? </font></td></tr><tr><td class="style4" width="44%" colspan="2"><input type="checkbox" id="From_Product" name="From_Product[]" class="noBrdr" value="Abn Ambro">ABN AMRO</td><td class="style4" width="56%"  colspan="2"><input type="checkbox" class="noBrdr" id="From_Product" name="From_Product[]" value="Amex">Amex</td><tr><td class="style4"  colspan="2"><input type="checkbox" class="noBrdr" value="HSBC" name="From_Product[]" id="From_Product" >HSBC</td><td width="56%" class="style4"  colspan="2"> <input type="checkbox" id="From_Product" name="From_Product[]" class="noBrdr" value="ICICI">ICICI</td></tr><tr><td class="style4"  colspan="2"><input type="checkbox" id="From_Product" name="From_Product[]" class="noBrdr" value="SBi">SBI</td><td class="style4"  colspan="2"><input type="checkbox" name="From_Product[]" id="From_Product" class="noBrdr" value="Citi Bank" >Citi Bank</td></tr><tr><td class="style4"  colspan="2"><input type="checkbox" id="From_Product" name="From_Product[]" class="noBrdr" value="Canara Bank" >Canara Bank</td><td  colspan="2" class="style4"><input type="checkbox" name="From_Product[]" class="noBrdr" id="From_Product" value="Deutsche bank">Deutsche Bank</td></tr><tr> <td class="style4"  colspan="2"><input type="checkbox"  id="From_Product" name="From_Product[]" value="HDFC" class="noBrdr">HDFC</td><td   colspan="2" class="style4"><input type="checkbox" name="From_Product[]" value="Standard Chartered" id="From_Product" class="noBrdr" >Standard Chartered</td></tr><tr><td class="style4" colspan="4"><input type="checkbox" name="From_Product[]" value="Others" id="From_Product" class="noBrdr" >Others</td></tr></table>		';
				

			}
		}
		
		return true;

	}
//function addElement() END

function removeElement()
{
		var ni = document.getElementById('myDivPL');
		
		if(ni.innerHTML!="")
		{
			if(document.loan_formPL.CC_Holder.value="on")
			{
				//alert(document.Form.CC_Holder.value);
				ni.innerHTML = '';
			}
		}
		return true;

	}
//function removeElement() END

function onFocusBlank(element,defaultVal)
{
	if(element.value==defaultVal)
	{
		element.value="";
	}
}
//function onFocusBlank(element,defaultVal) END

function onBlurDefault(element,defaultVal)
{
	if(element.value=="")
	{
		element.value = defaultVal;
	}
}
//function onBlurDefault(element,defaultVal) END

function HandleOnClose(filename) 
{
   if ((event.clientY < 0)) {
	   myWindow = window.open(filename, "tinyWindow", 'resizable width=510,height=390, scrollbars')
	   myWindow.document.bgColor=""
	   myWindow.document.close() 
   }
}
//function HandleOnClose(filename) END



function submitformPL(Form)
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
	//alert("Hello");
	
	
	if((Form.FName.value=="") || (Form.FName.value=="First Name")|| (Trim(Form.FName.value))==false)
	{
		alert("Kindly fill in your First Name!");
		Form.FName.focus();
		return false;
	}
	else if(containsdigit(Form.FName.value)==true)
	{
		alert("Name contains numbers!");
		Form.FName.focus();
		return false;
	}
    for (var i = 0; i < Form.FName.value.length; i++) 
	{
		if (iChars.indexOf(Form.FName.value.charAt(i)) != -1) 
		{
			alert ("Name has special characters.\n Please remove them and try again.");
			Form.FName.focus();
			return false;
	  	}
    }
	
	if((Form.LName.value=="") || (Form.LName.value=="Last Name")|| (Trim(Form.LName.value))==false)
	{
		alert("Kindly fill in your Last Name!");
		Form.LName.focus();
		return false;
	}
	else if(containsdigit(Form.LName.value)==true)
	{
		alert("Name contains numbers!");
		Form.LName.focus();
		return false;
	}
    for (var i = 0; i < Form.LName.value.length; i++) 
	{
		if (iChars.indexOf(Form.LName.value.charAt(i)) != -1) 
		{
			alert ("Name has special characters.\n Please remove them and try again.");
			Form.LName.focus();
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


if(Form.Phone1.value!="")
	{
		if(Form.Std_Code.value=="")
		{
			alert("Please fill your STD Code for Residence Landline number.");
			Form.Std_Code.focus();
			return false;
		}
	}
	if(Form.Landline_O.value!="")
	{
		if(Form.Std_Code_O.value=="")
		{
			alert("Please fill your STD Code for Office Landline number.");
			Form.Std_Code_O.focus();
			return false;
		}
	}
	
	if((Form.Phone.value=='Mobile') || (Form.Phone.value=='') || Trim(Form.Phone.value)==false)
	{
		alert("Kindly fill in your Mobile Number!");
		Form.Phone.focus();
		return false;
	}
	
	else if(Form.Phone.value.length < 10)
	{
		alert("Kindly fill in your Correct Mobile Number!");
		Form.Phone.focus();
		return false;
	}
	else if(containsalph(Form.Phone.value)==true)
	{
		alert("Kindly fill in your Correct Mobile Number(Numeric Only)!");
		Form.Phone.focus();
		return false;
	}
	
/*	if((Form.Email.value=="") || (Form.Email.value=="Email Id")|| (Trim(Form.Email.value))==false)
	{
		alert("Kindly fill in your Email Id!");
		Form.Email.focus();
		return false;
	}
	*/	
	if(Form.Email.value!="Email Id" || Form.Email.value!="")
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
	 
/*	if((Form.Loan_Amount.value=='')||(Form.Loan_Amount.value=="Loan Amount"))
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
	*/

	
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
	if(document.loan_formPL.City.value=='Others')
	{
		document.loan_formPL.City_Other.disabled=false;
	}
	else
	{
		document.loan_formPL.City_Other.disabled=true;
	}
}


function addElementLoan()
{
		var ni = document.getElementById('myDivLoan');
		
		if(ni.innerHTML=="")
		{
		
			if(document.loan_formPL.LoanAny.value="on")
			{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '<table border="0"><tr> <td align="left" class="style4" width="250" height="20" ><font class="style4">Any type of loan(s) running? </font></td> <td colspan="3" class="bodyarial11" width="250" ><table border="0">	 <tr><td class="style4" width="60" height="20" ><input type="checkbox" id="Loan_Any" name="Loan_Any[]" class="noBrdr" value="hl">Home</td><td class="style4"  width="60" height="20"><input type="checkbox" class="noBrdr" id="Loan_Any" name="Loan_Any[]" value="pl">Personal</td><tr><td  width="60" height="20" class="style4"><input type="checkbox" id="Loan_Any" name="Loan_Any[]" class="noBrdr" id="Loan_Any" value="cl" >Car</td><td class="style4" ><input type="checkbox" name="Loan_Any[]" id="Loan_Any" class="noBrdr" value="lap">Property</td></tr><tr><td class="style4" ><input type="checkbox" name="Loan_Any[]" id="Loan_Any" class="noBrdr" value="other">Other</td></tr> </table></td></tr><tr><td width="400" height="5" colspan="4">&nbsp;	 </td> </tr> <tr>    <td align="left"  class="style4" width="250" height="20" ><font class="style4">How many EMI paid? </font>  </td>   <td colspan="3" align="left" width="250" height="18"><select name="EMI_Paid"  style="float: left" class="style4"> <option value="0">Please select</option><option value="1">Less than 6 months</option> <option value="2">6 to 9 months</option> <option value="3">9 to 12 months</option> <option value="4">more than 12 months</option </select>  </td>	</tr></table>';
			}
		}
		
		return true;
}

function removeElementLoan()
{
		var ni = document.getElementById('myDivLoan');
		
		if(ni.innerHTML!="")
		{
		
			if(document.loan_formPL.LoanAny.value="on")
			{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '';
				
			}
		}
		
		return true;

}



//function valButton2() END
function addElementHomeLoan()
{
		var ni = document.getElementById('myHomeLoan');
		var ni1 = document.getElementById('myHomeLoan1');
		var ni2 = document.getElementById('myHomeLoan2');
		var ni3 = document.getElementById('myHomeLoan3');
		
	//	alert(loan_formPL.Product_Type.value);
	//	if(ni.innerHTML=="")
	//	{
		
			if(loan_formPL.Product_Type.value=="Req_Loan_Home")
			{
				//alert(document.loan_formPL.CC_Holder.value);
				ni.innerHTML = '<table><tr><td align="left" class="style4" width="230" height="20"><font class="style4">&nbsp;When planning to take loan?</font></td><td align="left" height="20"><select name="Loan_Time" style="width:150" class="style4" ><OPTION value="-1" selected>Please select</OPTION><OPTION value="15 days">15 days</OPTION><OPTION value="1 month">1 months</OPTION><OPTION value="2 months">2 months</OPTION><OPTION value="3 months">3 months</OPTION><OPTION value="3 months above">more than 3 months</OPTION></SELECT></td><td >&nbsp;</td></tr><tr><td align="left" class="style4" width="230" height="20"><font class="style4">&nbsp;Residence Address</font></td><td align="left" height="20"><textarea  name="Residence_Address" rows="2" cols="20" class="NoBrdr" ></textarea></td><td >&nbsp;</td></tr><tr><td align="left" class="style4" width="230" height="20"><font class="style4">&nbsp;Property Identified</font></td><td align="left" height="20"><input type="radio"  name="Property_Identified"  class="NoBrdr"  value="1" onclick="addIdentified();"><font class="style4">Yes</font><input size="10" type="radio" class="NoBrdr" name="Property_Identified" onclick="removeIdentified();" value="0" ><font class="style4">No</font></td><td >&nbsp;</td></tr><tr><td id="myDiv1" colspan="4"></td></tr><tr><td colspan="4" id="myDiv2"></td></tr></table>';
			}
			else 
			{
				ni.innerHTML = '';
			}
			if(loan_formPL.Product_Type.value=="Req_Loan_Car")
			{
				//alert(document.loan_formPL.CC_Holder.value);
				ni1.innerHTML = '<table><tr><td align="left" class="style4" width="280" height="20">Car Type</td><td><select size="1" name="Car_Type"><option value="1">New Car</option><option value="0">Old Car</option></select></td></tr><tr><td colspan="2"><input type="checkbox" class="style4" name="Car_Insurance" value="1" checked> <font class="style4">Get quotes for car Insurance</font></td></tr></table>';
			}
			else 
			{
				ni1.innerHTML = '';
			}
			if(loan_formPL.Product_Type.value=="Req_Loan_Against_Property")
			{
				//alert(document.loan_formPL.CC_Holder.value);
				ni2.innerHTML = '<table><td align="left" class="style4" width="230" height="20"><font class="style4">&nbsp;Residence Address</font></td><td align="left" height="20"><textarea  name="Residence_Address" rows="2" cols="20" class="NoBrdr" ></textarea></td><td >&nbsp;</td></tr><tr><td align="left" class="style4" width="280" height="20">Estimated market value of the property?</td><td class="bodyarial11"><select name="Budget" class="style4" ><option value="-1" selected>Please Select</option><option value="Upto 7 Lakhs">Upto 7 Lakhs </option><option value="7-15 Lakhs">7-15 Lakhs </option><option value="15-20 Lakhs">15-20 Lakhs </option><option value="20-25 Lakhs">20-25 Lakhs </option><option value="Above 25 Lakhs">Above 25 Lakhs</option></select></td></tr></table>';
			}
			else {
				ni2.innerHTML = '';
			}
			if(loan_formPL.Product_Type.value=="Req_Business_Loan")
			{
				//alert(document.loan_formPL.CC_Holder.value);
				ni3.innerHTML = '<table><tr> <td class="style4">Year of Establishment </td><td><select name="Year_Of_Establishment" class="style4"><option value="1">Please Select</option><option value="1950">1950</option> <option value="1951">1951</option><option value="1952">1952</option><option value="1953">1953</option><option value="1954">1954</option><option value="1955">1955</option><option value="1956">1956</option><option value="1957">1957</option><option value="1958">1958</option><option value="1959">1959</option><option value="1960">1960</option><option value="1961">1961</option><option value="1962">1962</option><option value="1963">1963</option><option value="1964">1964</option><option value="1965">1965</option><option value="1966">1966</option><option value="1967">1967</option><option value="1968">1968</option><option value="1969">1969</option><option value="1970">1970</option><option value="1971">1971</option><option value="1972">1972</option><option value="1973">1973</option><option value="1974">1974</option><option value="1975">1975</option><option value="1976">1976</option><option value="1977">1977</option><option value="1978">1978</option><option value="1979">1979</option><option value="1980">1980</option><option value="1981">1981</option><option value="1982">1982</option><option value="1983">1983</option><option value="1984">1984</option><option value="1985">1985</option><option value="1986">1986</option><option value="1987">1987</option><option value="1988">1988</option><option value="1989">1989</option><option value="1990">1990</option><option value="1991">1991</option><option value="1992">1992</option><option value="1993">1993</option><option value="1994">1994</option><option value="1995">1995</option><option value="1996">1996</option><option value="1997">1997</option><option value="1998">1998</option><option value="1999">1999</option><option value="2000">2000</option><option value="2001">2001</option><option value="2002">2002</option><option value="2003">2003</option><option value="2004">2004</option><option value="2005">2005</option><option value="2006">2006</option><option value="2007">2007</option></select></td></tr><tr> <td class="style4">Annual Turnover <font size="1" color="#FF0000">*</font></td><td> <select size="1"  name="Annual_Turnover" ><option value="-1">Please Select</option><option value="1">Below 25 Lacs</option><option value="2">25-50 Lacs</option><option value="3">50-75 Lacs</option><option value="4">75-1 Crore</option><option value="5">1-1.25 crore</option><option value="6">1.25 cr& above</option></select> </td></tr></table>';
			}
			else 
			{
				ni3.innerHTML = '';
			}
		//}
		
		return true;
	}
//function addElement() END


function addIdentified()
{
		var ni = document.getElementById('myDiv1');
		var ni1 = document.getElementById('myDiv2');
		
		if(ni.innerHTML=="")
		{
		
			if(document.loan_formPL.Property_Identified.value="on")
			{
				ni1.innerHTML = '';
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '<table border="0" width="100%"><tr><td align="left"  width="200" class="style4"  height="20"><font class="style4">Property Location</td><td  width="196" align="center"  height="20" colspan="3"><input size="13" class="style4" name="Property_Loc" onfocus="this.select();" style="float: left"></td></tr></table>';
			}
			
		}
			
		return true;
	}


function removeIdentified()
{
		var ni = document.getElementById('myDiv1');
		var ni1 = document.getElementById('myDiv2');
		
		if((ni.innerHTML!="")|| (ni1.innerHTML==""))
		{
		
			if(document.loan_formPL.Property_Identified.value!="on")
			{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '';
				ni1.innerHTML = '<table border="0"><tr><td align="left"  class="style4"  height="20">&nbsp;<input type="checkbox" name="update" class="noBrdr" ></td><td  align="left"  height="20"><font class="style4">Can we tell you about some properties	</td></tr>	</table>';
			}
		}
		
		return true;

	}



