//alert("hello");
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
function valButton2() {
var cnt = -1;
var i;
for(i=0; i<document.personalloan_form.From_Product.length; i++) 
{
if(document.personalloan_form.From_Product[i].checked)
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
function addElement()
{
var ni = document.getElementById('myDiv');
if(ni.innerHTML=="")
{
if(document.personalloan_form.CC_Holder.value="on")
{
ni.innerHTML = "<table  width='100%' border='0' cellspacing='0' cellpadding='0'><tr align='left'><td   class='text' style='padding-top:3px; color:#FFF; font-size:12px; text-transform:none;'>Card held since?</td><td style='padding-left:20px;'><select size='1' name='Card_Vintage' style='width:150px;'><option value='0'>Please select</option> <option value='1'>Less than 6 months</option> <option value='2'>6 to 9 months</option> <option value='3'>9 to 12 months</option><option value='4'>more than 12 months</option> </select></td></tr></table>";}}
return true;
}
function removeElement()
{
var ni = document.getElementById('myDiv');
if(ni.innerHTML!="")
{
if(document.personalloan_form.CC_Holder.value="on")
{
//alert(document.loan_form.CC_Holder.value);
ni.innerHTML = '';
}
}
return true;
}
function chkpersonalloan(Form)
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
if(Form.product.selectedIndex==0)
{
alert("Please Select Product Continue");
Form.product.focus();
return false;
}
if(Form.product.selectedIndex==1 && Form.product.value=="Req_Loan_Personal")
{
	document.getElementById('cc_pl_div').style.visibility="";
}
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
else if(Form.year.value > parseInt(mdate-18) || Form.year.value < parseInt(mdate-62))
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
if(document.personalloan_form.Email_id.value!="Email Id")
{
if (!validmail(document.personalloan_form.Email_id.value))
{
//alert("Please enter your valid email address!");
document.personalloan_form.Email_id.focus();
return false;
}
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
if((Form.Net_Salary.value=='')||(Form.Net_Salary.value=="Annual Income") || (Form.Net_Salary.value=="Monthly Income"))
{
alert("Please enter Income to Continue");
Form.Net_Salary.focus();
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
myOption = -1;
for (i=Form.CC_Holder.length-1; i > -1; i--) {
if(Form.CC_Holder[i].checked) {
if(i==0)
{
if (Form.Card_Vintage.selectedIndex==0)
{
alert("Please select since how long you holding credit card");
Form.Card_Vintage.focus();
return false;
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
alert("Read and Accept Terms & Conditions");
Form.accept.focus();
return false;
}
if(Form.Email_id.value=="Email Id")
{
Form.Email_id.value=" ";
}
}

function chkpl(Form)
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
else if(Form.year.value > parseInt(mdate-18) || Form.year.value < parseInt(mdate-62))
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
if(document.personalloan_form.Email_id.value!="Email Id")
{
if (!validmail(document.personalloan_form.Email_id.value))
{
//alert("Please enter your valid email address!");
document.personalloan_form.Email_id.focus();
return false;
}
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
if((Form.Net_Salary.value=='')||(Form.Net_Salary.value=="Annual Income") || (Form.Net_Salary.value=="Monthly Income"))
{
alert("Please enter Income to Continue");
Form.Net_Salary.focus();
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
myOption = -1;
for (i=Form.CC_Holder.length-1; i > -1; i--) {
if(Form.CC_Holder[i].checked) {
if(i==0)
{
if (Form.Card_Vintage.selectedIndex==0)
{
alert("Please select since how long you holding credit card");
Form.Card_Vintage.focus();
return false;
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
if(Form.Email_id.value=="Email Id")
{
Form.Email_id.value=" ";
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
if(document.personalloan_form.City.value=='Others')
{
document.personalloan_form.City_Other.disabled=false;
}
else
{document.personalloan_form.City_Other.disabled=true;
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
function HandleOnClose(filename) {
if ((event.clientY < 0)) {

myWindow = window.open(filename, "tinyWindow", 'resizable width=510,height=390, scrollbars')
myWindow.document.bgColor=""
myWindow.document.close() 
}
}

function getcourse_nme()
{
if(document.eduloan_form.Course.value==2 || document.eduloan_form.Course.value==3 || document.eduloan_form.Course.value==4)
{
document.eduloan_form.Course_Name.disabled=false;
}
else
{document.eduloan_form.Course_Name.disabled=true;
}
}

function eduothercity()
{
if(document.eduloan_form.City.value=='Others')
{
document.eduloan_form.City_Other.disabled=false;
}
else
{document.eduloan_form.City_Other.disabled=true;
}
}

function chkeducaionloan(Form)
{
var myOption;
var i;
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

if(Form.Email.value!="Email Id")
{
	if (!validmail(Form.Email.value))
	{
		//alert("Please enter your valid email address!");
		Form.Email.focus();
		return false;
	}
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

if(Form.Course.selectedIndex==0)
{
	alert("Please enter Course of Study to Continue");
	Form.Course.focus();
	return false;
}
else if((Form.Course.value>1)  && ((Form.Course_Name.value=='')||!isNaN(Form.Course_Name.value) ||(Form.Course_Name.value=="Course Name")))
{
alert("Kindly fill in Course Name!");
Form.Course_Name.focus();
return false;
}

if(Form.Employment_Status.selectedIndex==0)
{
	alert("Please enter Income Status to Continue");
	Form.Employment_Status.focus();
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

if(!Form.accept.checked)
	{
		alert("Read and Accept Terms & Conditions");
		Form.accept.focus();
		return false;
	}
	
}

function chkcarloan(Form)
{
var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
var dt,mdate;dt=new Date();
var alpha=/^[a-zA-Z\ ]*$/;
var alphanum=/^[a-zA-Z0-9]*$/;
var num=/^[0-9]*$/;
var space=/^[\ ]*$/;
var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";
var j;
var cnt=-1;
 
 
	if(Form.Name.value=="")
	{
		alert("Please fill your first name.");
		Form.Name.focus();
		return false;
	}
	if(Form.Name.value!="")
	{
	 if(containsdigit(Form.Name.value)==true)
	{
	alert("First Name contains numbers!");
	Form.Name.focus();
	return false;
	}
	}
  for (var i = 0; i <Form.Name.value.length; i++) {
  	if (iChars.indexOf(Form.Name.value.charAt(i)) != -1) {
  	alert ("First Name has special characters.\n Please remove them and try again.");
	Form.Name.focus();

  	return false;
  	}
  }
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
	
	 if(Form.year.value > parseInt(mdate-18) || Form.year.value < parseInt(mdate-62))
	{
		alert("Age Criteria! \n Applicants between age group 18 - 62 only are elgibile.");
		Form.year.focus();
		return false;
		}
	}
	
	if(!checkData(Form.year, 'Year', 4))
		return false;
	
	if(Form.Phone.value=="")
	{
		alert("Please fill your mobile number.");
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

	if(Form.Email.value=="")
	{
		alert("Please enter your valid email address!");
			Form.Email.focus();
			return false;
			
		}
	if(Form.Email.value!="")
	{
		if (!validmail(Form.Email.value))
		{
			//alert("Please enter your valid email address!");
			Form.Email.focus();
			return false;
		}	
	}

if (Form.City.selectedIndex==0)
	{
		alert("Please enter City Name to Continue");
		Form.City.focus();
		return false;
	}
	if((Form.City.value=="Others") && (Form.City_Other.value=="" || Form.City_Other.value=="Other City"  ) || !isNaN(Form.City_Other.value))
	{
		alert("Kindly fill your Other City!");
		Form.City_Other.focus();
		return false;
	}
	for (var i = 0; i <Form.City_Other.value.length; i++) {
  	if (iChars.indexOf(Form.City_Other.value.charAt(i)) != -1) {
  	alert ("Other city has special characters.\n Please remove them and try again.");
	Form.City_Other.focus();
  	return false;
  	}
  }
 	if(!checkData(Form.Company_Name, 'Company Name', 3))
		return false;
		
	
if (Form.Employment_Status.selectedIndex==0)
	{
		alert("Please enter Employment Status to Continue");
		Form.Employment_Status.focus();
		return false;
	}
	
if(Form.Net_Salary.value=="")
	{
		alert("Please enter Annual income to Continue");
		Form.Net_Salary.focus();
		return false;
	}
	
		for(j=0; j<document.loan_form.Car_Booked.length; j++) 
	{
		 if(document.loan_form.Car_Booked[j].checked)
		{
			 if(j==0)
				{
				if (document.loan_form.cldelivery_date.value=="" || document.loan_form.cldelivery_date.value=="DD-MM-YYYY")
				{
						document.getElementById('delivry_dtVal').innerHTML = "<span  class='hintanchor'>Enter valid delivery date</span>";	
						document.loan_form.cldelivery_date.focus();
						return false;
				}

				}

			 cnt= j;
		}
	}
	
		if(cnt == -1) 
		{
			document.getElementById('carbukedVal').innerHTML = "<span  class='hintanchor'> select car Booked or not</span>";	
			return false;
		}
	if (Form.Loan_Amount.value=="")
	{
		alert("Please enter Loan Amount.");
		Form.Loan_Amount.focus();
		return false;
	}	
	if(!checkNum(Form.Loan_Amount, 'Loan Amount',0))
		return false;
		
		if(!Form.accept.checked)
	{
	alert("Read and Accept Terms & Conditions");
	Form.accept.focus();
	return false;
	}
}

function cityother()
{
	if(document.carloan_form.City.value=="Others")
	{
		document.carloan_form.City_Other.disabled = false;
	}
	else
	{
		document.carloan_form.City_Other.disabled = true;
	}
} 

function lapchkform(Form)
{
var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
var dt,mdate;dt=new Date();
var alpha=/^[a-zA-Z\ ]*$/;
var alphanum=/^[a-zA-Z0-9]*$/;
var num=/^[0-9]*$/;
var space=/^[\ ]*$/;
var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";

	if(Form.FName.value=="")
	{
		alert("Please fill your full name.");
		Form.FName.focus();
		return false;
	}
	 if(Form.FName.value!="")
	{
	 if(containsdigit(Form.FName.value)==true)
	{
	alert("full Name contains numbers!");
	Form.FName.focus();
	return false;
	}
	}
  for (var i = 0; i <Form.FName.value.length; i++) {
  	if (iChars.indexOf(Form.FName.value.charAt(i)) != -1) {
  	alert ("First Name has special characters.\n Please remove them and try again.");
	Form.FName.focus();

  	return false;
  	}
  }
	if(Form.day.value=="" || Form.day.value=="DD")
	{
		alert("Please fill your day of birth.");
		Form.day.focus();
		return false;
	}
	if(Form.day.value!="" && Form.day.value!="DD") 
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
	if(Form.month.value!="" && Form.month.value!="MM")
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
		if(Form.year.value!="" && Form.year.value!="YYYY")
	{
	 if(Form.year.value > parseInt(mdate-18) || Form.year.value < parseInt(mdate-62))
	{
		alert("Age Criteria! \n Applicants between age group 18 - 62 only are elgibile.");
		Form.year.focus();
		return false;
		}
	}
	if(!checkData(Form.year, 'Year', 4))
		return false;
	
	if(Form.Phone.value=="")
	{
		alert("Please fill your mobile number.");
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
        if ((Form.Phone.value.charAt(0)!="9") && (Form.Phone.value.charAt(0)!="8"))
		{
                alert("The number should start only with 9 or 8");
				 Form.Phone.focus();
                return false;
        }
		
		if(Form.Email.value=="")
	{
		alert("Please fill your Email.");
		Form.Email.focus();
		return false;
	}
	
	 if(Form.Email.value!="")
	{
		if (!validmail(Form.Email.value))
		{
			//alert("Please enter your valid email address!");
			Form.Email.focus();
			return false;
		}
	}
	if (Form.City.selectedIndex==0)
	{
		alert("Please enter City Name to Continue");
		Form.City.focus();
		return false;
	}
	if((Form.City.value=="Others") && (Form.City_Other.value=="" || Form.City_Other.value=="Other City"  ) || !isNaN(Form.City_Other.value))
	{
		alert("Kindly fill your Other City!");
		Form.City_Other.focus();
		return false;
	}
	for (var i = 0; i <Form.City_Other.value.length; i++) {
  	if (iChars.indexOf(Form.City_Other.value.charAt(i)) != -1) {
  	alert ("Other city has special characters.\n Please remove them and try again.");
	Form.City_Other.focus();
  	return false;
  	}
  }
  
	if (Form.Pincode.value=="")
	{
		alert("Please enter Pincode.");
		Form.Pincode.focus();
		return false;
	}
	if (Form.Pincode.value!="")
	{
		if(Form.Pincode.value.length < 6)
	{
		alert("Kindly fill in your Pincode(6 Digits)!");
		Form.Pincode.focus();
		return false;
	}
	}
	
	if(!checkData(Form.Company_Name, 'Company Name', 3))
		return false;
	if (Form.Net_Salary.value=="")
	{
		alert("Please enter Net Salary.");
		Form.Net_Salary.focus();
		return false;
	}
	if(!checkNum(Form.Net_Salary, 'Net Salary',0))
		return false;
		
	if (Form.Loan_Amount.value=="")
	{
		alert("Please enter Loan Amount.");
		Form.Loan_Amount.focus();
		return false;
	}
	if(!checkNum(Form.Loan_Amount, 'Loan Amount',0))
		return false;

	if (Form.Property_Value.value=="")
	{
		alert("Please enter Property Value.");
		Form.Property_Value.focus();
		return false;
	}	
	if(!checkNum(Form.Property_Value, 'Value of the Property',0))
		return false;

	if(!Form.accept.checked)
	{
	alert("Read and Accept Terms & Conditions");
	Form.accept.focus();
	return false;
	}
}  

function lapcityother(Form)
{
	if(Form.City.value=="Others")
	{
		Form.City_Other.disabled = false;
	}
	else
	{
		Form.City_Other.disabled = true;
	}
} 


function chkgoldloan(Form)
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

if(Form.Email.value!="Email Id")
{
	if (!validmail(Form.Email.value))
	{
		//alert("Please enter your valid email address!");
		Form.Email.focus();
		return false;
	}
	
}

if((Form.IncomeAmount.value=='')||(Form.IncomeAmount.value=="Annual Income") || (Form.IncomeAmount.value=="Monthly Income"))
{
	alert("Please enter Income to Continue");
	Form.IncomeAmount.focus();
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

if(!Form.accept.checked)
	{
		alert("Read and Accept Terms & Conditions");
		Form.accept.focus();
		return false;
	}
	
	
if(Form.Email.value=="Email Id")
{
	Form.Email.value=" ";
}


}

function glothercity1()
{
if(document.goldloan_form.City.value=='Others')
{
document.goldloan_form.City_Other.disabled=false;
}
else
{document.goldloan_form.City_Other.disabled=true;
}
}

function chkhlbtform()
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
	  if((document.loan_form.year.value < 1950) || (document.loan_form.year.value >1994))
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
	for (var i = 0; i <document.loan_form.City_Other.value.length; i++) {
  	if (iChars.indexOf(document.loan_form.City_Other.value.charAt(i)) != -1) {
  	alert ("Other city has special characters.\n Please remove them and try again.");
	document.loan_form.City_Other.focus();
  	return false;
  	}
  }
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
  
	if (document.loan_form.Existing_Bank.value=="")
	{
		alert("Please enter Existing Bank.");
		document.loan_form.Existing_Bank.focus();
		return false;
	}	
	
	if (document.loan_form.Existing_Loan.value=="")
	{
		alert("Please enter Existing Loan.");
		document.loan_form.Existing_Loan.focus();
		return false;
	}	
	if(!checkNum(document.loan_form.Existing_Loan, 'Existing Loan',0))
		return false;

	if (document.loan_form.Existing_ROI.value=="")
	{
		alert("Please enter Existing ROI.");
		document.loan_form.Existing_ROI.focus();
		return false;
	}	

	if(!document.loan_form.accept.checked)
	{
	alert("Read and Accept Terms & Conditions");
	document.loan_form.accept.focus();
	return false;
	}
}  

function hlbtcityother()
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
	if(cit =="Ahmedabad" || cit =="Bangalore" || cit =="Baroda" || cit =="Bhubaneshwar" || cit =="Chandigarh" || cit =="Chennai" || cit =="Cochin" || cit =="Cuttack" || cit =="Delhi" || cit =="Faridabad" || cit =="Gaziabad" || cit =="Gurgaon" || cit =="Guwahati" || cit =="Hyderabad" || cit =="Indore" || cit =="Jaipur" || cit =="Kanpur" || cit =="Kochi" || cit =="Kolkata" || cit =="Lucknow" || cit =="Mumbai" || cit =="Noida" || cit =="Pune" || cit =="Sahibabad" || cit =="Thane" || cit =="Vadodara" || cit =="Vijaywada" || cit =="Vishakapatanam" || cit =="Vizag" )
	{
		//alert("ranjana");
		ni1.innerHTML = '<table  style="border:1px solid #000000; padding:2px;"><tr><td colspan="2" class="frmbldtxt" style="font-family:verdana; font-size:10px; color:#ffffff; font-weight:normal; " height="20"><span style="color:#FF0000;">(Optional) </span>Special service only for Deal4loans customers:</td></tr> <tr><td width="23"><input type="checkbox"  name="hdfclife" id="hdfclife" value="1"/></td> <td width="611" class="frmbldtxt" style="font-family:verdana; font-size:10px; color:#ffffff; font-weight:normal; "> I would like to avail of <b>FREE </b>financial planning services by <b>Insurance & Investment experts</b> from HDFC Life.</td>		 </tr>	 </table>';	
	}
	else
	{
		ni1.innerHTML = '';
	}
	return true;
}


function chgtxtsal()
{
	var nitxt = document.getElementById('chgtxt');
	var niadtxt = document.getElementById('adtxt');
	var citemp = document.personalloan_form.Employment_Status.value;
	if(citemp==0)
	{
		nitxt.innerHTML ="Annual ITR :";
		niadtxt.innerHTML="Annual Turnover: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<select name='Annual_Turnover' id='Annual_Turnover'  style='width:154px;'>		<option value='1'> 0 - 30 Lacs</option>		<option value='2'> 30 Lacs - 60 Lacs</option>		<option value='3'> 60 Lacs - 1 Cr</option>		<option value='4'> 1 Cr & above</option>		</select>";	
	}
	else 
	{
		
		nitxt.innerHTML ="Annual Income :";	
		niadtxt.innerHTML="";	
	}
	
}


function adddel_dt()
{
		var ni = document.getElementById('myDivdel_dt');
		
		if(ni.innerHTML=="")
		{
		
			/*if(document.loan_form.Car_Type.value=="1")
			{*/
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '<table cellpadding="0" cellspacing="0"><tr><td height="28" class="text" style=" padding-top:3px; color:#FFF; font-size:12px; text-transform:none;" width="110">Delivery Date</td><td class="text" style=" padding-top:3px; color:#FFF; font-size:12px; text-transform:none;"><input type="text" name="cldelivery_date" id="cldelivery_date" value="DD-MM-YYYY" onblur="onBlurDefault(this,\'DD-MM-YYYY\');" onfocus="onFocusBlank(this,\'DD-MM-YYYY\');" onkeydown="validateDiv(\'carbukedVal\');" style="width:150px;"/></td></tr></table>';
				

			//}
		}
		
		return true;

	}


function removedel_dt()
{
		var ni = document.getElementById('myDivdel_dt');
		
		if(ni.innerHTML!="")
		{
		
		//if(document.loan_form.Car_Type.value="on")
			//{
				ni.innerHTML = '';
				
			//}
		}
		
		return true;

	}


	function addhdfclife_cl(Form)
{
	var ni1 = document.getElementById('hdfclife');
	var cit = Form.City.value;
	
	//alert(cit);	
	if(cit !="Others")
	{
		ni1.innerHTML = '<table  style="border:1px solid #000000; padding:2px; width:706px;" ><tr><td colspan="2" class="frmbldtxt" style="font-family:verdana; font-size:10px; color:#ffffff; font-weight:normal; " height="20">Special service only for Deal4loans customers:</td></tr> <tr><td width="23"><input type="checkbox"  name="bajaj_Allianz" id="bajaj_Allianz" value="1"/></td> <td width="611" class="frmbldtxt" style="font-family:verdana; font-size:10px; color:#ffffff; font-weight:normal; "> Avail <b>24*7 Spot assistance service free</b> and  give your car best possible protection with Bajaj Allianz Car Insurance!</td>		 </tr>	 </table>';	
	}
	else
	{
		ni1.innerHTML = '';
	}
	return true;
}

function change_empstst()
{
	var occpdiv = document.getElementById('chnge_empstst');
	var occupation = document.personalloan_form.Employment_Status.value;
	
	if(occupation==0)
	{
	occpdiv.innerHTML = '<table cellpadding="0" cellspacing="0" width="100%"><tr><td class="text" style=" padding-top:3px; color:#FFF; font-size:12px; text-transform:none;"  width="38%" >Annual Turnover </td>                     <td width="62%">						 <select name="Annual_Turnover" id="Annual_Turnover" style=" width:148px;">                       <option value="">Please Select</option>	<option value="1" > 0 - 40 Lacs</option>	<option value="4" > 40 Lacs - 1 Cr</option>		<option value="2" > 1Cr - 3Crs </option>	<option value="3" >3Crs & above</option></select></td></tr></table>';
	
	}
	else
	{
	occpdiv.innerHTML = '<table cellpadding="0" cellspacing="0" width="100%"><tr><td class="text" style=" padding-top:3px; color:#FFF; font-size:12px; text-transform:none;"  width="38%" >Company Name</td>                     <td width="62%">                       <input name="Company_Name" id="Company_Name" type="text" tabindex="10"   style=" width:148px;"  onblur="onBlurDefault(this,\'Type slowly to autofill\');" onKeyUp="ajax_showOptions(this,\'getCountriesByLetters\',event)" onfocus="onFocusBlank(this,\'Type slowly to autofill\');"  value="Type slowly to autofill" /></td></tr></table>';
				}
				
}