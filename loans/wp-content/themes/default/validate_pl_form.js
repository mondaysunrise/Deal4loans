alert("hello");
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
ni.innerHTML = "<table  width='100%' border='0' cellspacing='0' cellpadding='0'><tr align='left'><td   class='frmbldtxt'><b>Card held since?</b></td><td style='padding-left:20px;'><select size='1' name='Card_Vintage' style='width:150px;'><option value='0'>Please select</option> <option value='1'>Less than 6 months</option> <option value='2'>6 to 9 months</option> <option value='3'>9 to 12 months</option><option value='4'>more than 12 months</option> </select></td></tr></table>";}}
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
if(document.personalloan_form.Email.value!="Email Id")
{
if (!validmail(document.personalloan_form.Email.value))
{
//alert("Please enter your valid email address!");
document.personalloan_form.Email.focus();
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
if(Form.Email.value=="Email Id")
{
Form.Email.value=" ";
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