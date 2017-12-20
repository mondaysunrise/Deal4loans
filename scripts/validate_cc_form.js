function othercity1()
{
	if(document.creditcard_form.City.value=='Others')
	{
		document.creditcard_form.City_Other.disabled=false;
	}
	else
	{
		document.creditcard_form.City_Other.disabled=true;
	}
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
function cityother()
{
	if(document.creditcard_form.City.value=="Others")
	{
		document.creditcard_form.City_Other.disabled = false;
	}
	else
	{
		document.creditcard_form.City_Other.disabled = true;
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
function ckhcreditcard(Form)
{	
var cit=Form.City.value;
var sal=Form.Net_Salary.value;

var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
var dt,mdate;dt=new Date();
var alpha=/^[a-zA-Z\ ]*$/;
var alphanum=/^[a-zA-Z0-9]*$/;
var num=/^[0-9]*$/;
var space=/^[\ ]*$/;
var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";
var myOption;

if((Form.Full_Name.value=="") || (Form.Full_Name.value=="Full Name")|| (Trim(Form.Full_Name.value))==false)
{
alert("Kindly fill in your Name!");
Form.Full_Name.focus();
return false;
}
else if(containsdigit(Form.Full_Name.value)==true)
{
alert("Name contains numbers!");
Form.Full_Name.focus();
return false;
}
  for (var i = 0; i < Form.Full_Name.value.length; i++) {
  	if (iChars.indexOf(Form.Full_Name.value.charAt(i)) != -1) {
  	alert ("Name has special characters.\n Please remove them and try again.");
	Form.Full_Name.focus();
  	return false;
  	}
  }
if((space.test(Form.day.value)) || (Form.day.value=="dd")  )
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
else if ((Form.Phone.value.charAt(0)!="9") && (Form.Phone.value.charAt(0)!="8") && (Form.Phone.value.charAt(0)!="7"))
		{
                alert("The number should start only with 9 or 8 or 7");
				 Form.Phone.focus();
                return false;
        }
else if(containsalph(Form.Phone.value)==true)
{
alert("Kindly fill in your Correct Mobile Number(Numeric Only)!");
Form.Phone.focus();
return false;
}
 if(Form.Email.value!="Email Id")
{
	if (!validmail(Form.Email.value))
	{
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

if(Form.Company_Name.value=='')
{
	alert("Please enter Company Name to Continue");
	Form.Company_Name.focus();
	return false;
}

if(Form.Employment_Status.selectedIndex==0)
{
	alert("Please select employment status ");
	Form.Employment_Status.focus();
	return false;
}

if((Form.Net_Salary.value=='')||(Form.Net_Salary.value=="Annual Income"))
{
	alert("Please enter Annual income to Continue");
	Form.Net_Salary.focus();
	return false;
}
  myOption = -1;
		for (i=Form.CC_Holder.length-1; i > -1; i--) {
			if(Form.CC_Holder[i].checked) {
				if(i==0)
				{
				if (Form.No_of_Banks.selectedIndex==0)
				{
						alert("Please select Bank from which you are holding credit card");
						Form.No_of_Banks.focus();
						return false;
				}
				if(Form.City.selectedIndex >0)
		{
	if((cit=="Bangalore" || cit=="Chennai" || cit=="Delhi" || cit=="Hyderabad" || cit=="Jaipur" || cit=="Kolkata" || cit=="Mumbai" || cit=="Pune" || cit=="Ahmedabad" || cit=="Chandigarh" || cit=="Indore" || cit=="Cochin" || cit=="Bhopal") && sal < 360000)
			{
		if(Form.Card_Vintage.selectedIndex==0)
		{
			alert("Please select since how long you holding credit card.");	
			Form.Card_Vintage.focus();
			return false;
		}
		if(Form.Credit_Limit.selectedIndex==0)
		{
			alert("Please select Card Credit Limit.");	
			Form.Credit_Limit.focus();
			return false;
		}

			}
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

function addElement()
{

		var ni = document.getElementById('myDiv');
		
			if(document.creditcard_form.CC_Holder.value=="1")
			{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '<table  width="100%" border="0" cellspacing="0" cellpadding="0"><tr align="left"><td   class="frmbldtxt"><b>Bank Name ?</b></td><td style="padding-left:20px;"><select size="1" name="No_of_Banks" id="No_of_Banks"style="width:150px;"><option value="0">Please select</option> <option value="HDFC Bank">HDFC Bank</option> <option value="Standard Chartered">Standard Chartered</option> <option value="Kotak Bank">Kotak Bank</option><option value="Other">Other</option></select></td></tr></table>';
			}
		
		
		return true;
	}


function removeElement()
{
		var ni = document.getElementById('myDiv');
		
		
		if(ni.innerHTML!="")
		{
			if(document.creditcard_form.CC_Holder.value="0")
			{
				ni.innerHTML = '';
							}
		}
		
		return true;

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



function onFocusBlank(element,defaultVal){ if(element.value==defaultVal){ element.value="";	} }
function onBlurDefault(element,defaultVal){	if(element.value==""){ element.value = defaultVal; }}

function addibibo(Form)
{
	var ni1 = document.getElementById('getibibo');
	var cit = Form.City.value;
	
	if(cit!="Please Select")
	{
		//alert("ranjana");
		ni1.innerHTML = ' <table  style="border:1px solid #999999; padding:2px;"> <tr> <td class="frmbldtxt" style="font-family:verdana; font-size:10px; color:#666666; font-weight:normal; "> <u>Special offer for Deal4loans customers</u></td>		 </tr>	  <tr>	 <td class="frmbldtxt" style="font-family:verdana; font-size:10px; color:#666666; font-weight:normal;"> Take  a Free Test  Drive for New Maruti  and <b>Win a Branded Laptop</b></td> </tr>	 <tr> <td style="font-family:verdana; font-size:10px; color:#666666; font-weight:normal; "> <input type="radio" name="Ibibo_compaign" id="Ibibo_compaign" style="border:none;" value="Estillo"/> Estillo <input type="radio" style="border:none;" value="WagonR" name="Ibibo_compaign" id="Ibibo_compaign"/> WagonR <input type="radio" name="Ibibo_compaign" id="Ibibo_compaign" value="A-Star" style="border:none;"/> A-Star</td>	 </tr>	</table>	';	
	}
	else
	{
		ni1.innerHTML = '';
	}
	return true;
}

function addhdfclife(Form)
{

	var ni1 = document.getElementById('hdfclife');
	var cit = Form.City.value;
	//alert(cit);	
	if(cit =="Ahmedabad" || cit =="Allahabad" || cit =="Bangalore" || cit =="Baroda" || cit =="Bhubaneshwar" || cit =="Chandigarh" || cit =="Chennai" || cit =="Cochin" || cit =="Cuttack" || cit =="Delhi" || cit =="Faridabad" || cit =="Gaziabad" || cit =="Greater Noida" || cit =="Gurgaon" || cit =="Guwahati" || cit =="Hyderabad" || cit =="Indore" || cit =="Jaipur" || cit =="Kanpur" || cit =="Kochi" || cit =="Kolkata" || cit =="Lucknow" || cit =="Mumbai" || cit =="Noida" || cit =="Pune" || cit =="Sahibabad" ||
cit =="Surat" || cit =="Thane" || cit =="Vadodara" || cit =="Vijaywada" || cit =="Vishakapatanam" || cit =="Vizag" )
	{
		//alert("ranjana");
		ni1.innerHTML = '<table  style="border:1px solid #999999; padding:2px;"><tr><td colspan="2" class="frmbldtxt" style="font-family:verdana; font-size:10px; color:#666666; font-weight:normal; " height="20">Special service only for Deal4loans customers:</td></tr> <tr><td width="23" valign="top"><input type="checkbox"  name="hdfclife" id="hdfclife" value="1"/></td> <td width="611" class="frmbldtxt" style="font-family:verdana; font-size:10px; color:#666666; font-weight:normal; "> I would like to avail of <b>FREE </b>financial planning services by Insurance & Investment experts from HDFC Life.</td>		 </tr>	 </table>';	
	}
	else
	{
		ni1.innerHTML = '';
	}
	return true;
}

function addcty_oth()
{
		var ni = document.getElementById('othercty_id');
		
		if(ni.innerHTML=="")
		{
		
			if(document.creditcard_form.City.value=="Others")
			{
			
				ni.innerHTML = '<table cellpadding="0" cellspacing="0" width="100%"><tr><td height="25" align="left" class="text" style=" padding-top:3px; color:#FFF; font-size:12px; text-transform:none;" width="100">Other City</td><td height="25" class="text" style=" padding-top:3px; color:#FFF; font-size:12px; text-transform:none;" width="170"><input type="text" name="City_Other" " onfocus="this.select();" style="width:148px;" tabindex="8" /></td></tr></table>';
				

			}
		}
		else
	{
		ni.innerHTML="";
	}
		
		return true;

	}

function addElementCC()
{
		var ni = document.getElementById('myDivCC');
		 var newdivCC = document.createElement('div');
		 var niicici = document.getElementById('icici_rqdfield');
		var cit = document.getElementById('City').value;
		var sal =document.getElementById('Net_Salary').value;
					
				ni.innerHTML = '<table border="0" cellspacing="0" cellpadding="0"><tr><td class="bldtxt" width="125">Bank Name ?</td><td class="bldtxt" width="140"><select size="1" name="No_of_Banks" id="No_of_Banks" style="width:140px; " class="field"><option value="0">Please select</option> <option value="HDFC Bank">HDFC Bank</option> <option value="Standard Chartered">Standard Chartered</option> <option value="Kotak Bank">Kotak Bank</option><option value="ICICI Bank">ICICI Bank</option><option value="Other">Other</option></select><div id="ccbnknmeVal"></div></td></tr></table>';

			if((cit=="Bangalore" || cit=="Chennai" || cit=="Delhi" || cit=="Hyderabad" || cit=="Jaipur" || cit=="Kolkata" || cit=="Mumbai" || cit=="Pune" || cit=="Ahmedabad" || cit=="Chandigarh" || cit=="Indore" || cit=="Cochin" || cit=="Bhopal") && sal < 360000)
	{
			
	niicici.innerHTML='<table width="90%"  border="0" cellpadding="0" cellspacing="0">                <tr>                  <td width="183" height="58" align="left" valign="top"><div style=" float:left; width:183px; height:47px; margin-left:0px; margin-top:5px;">                      <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Card Vintage:</div>                    <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;">                       <select size="1" name="Card_Vintage" style="width:180px; height:24px; font-family:Verdana, Geneva, sans-serif; font-size:11px; color:#4c4c4c;" onchange="validateDiv(\'vintageVal\');" ><option value="0">Please select</option> <option value="1">Less than 6 months</option> <option value="2">6 to 9 months</option> <option value="3">9 to 12 months</option><option value="4">more than 12 months</option> </select>   <div id="vintageVal"></div>                         </div>                  </div></td>				  <td width="59" align="left" valign="top">&nbsp;</td><td width="469" align="left" valign="top"><div style=" float:left; width:183px; height:47px; margin-left:0px; margin-top:5px;">                      <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Credit Limit:</div>                    <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;">                      <span class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">                      <select size="1" name="Credit_Limit" id="Credit_Limit" style="width:180px; height:24px; font-family:Verdana, Geneva, sans-serif; font-size:11px; color:#4c4c4c;" onchange="validateDiv(\'cclimitVal\');" >                        <option value="0">Please select</option>                        <option value="1">Upto 75,000</option>                        <option value="2">75,000 to 1,50,000 </option>                        <option value="3">1,50,000 & Above</option>                       </select>                      </span>                      <div id="cclimitVal"></div>                         </div>                  </div></td>				   </tr></table>';
	}

			ni.appendChild(newdivCC);
	}

function removeElementCC()
{	var ni = document.getElementById('myDivCC');
var niicici = document.getElementById('icici_rqdfield');
		if(ni.innerHTML!="")
		{
		ni.innerHTML = '';
		niicici.innerHTML = '';
		}
		return true;

	}