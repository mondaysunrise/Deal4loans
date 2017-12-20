<?php
	require 'scripts/functions.php';
	require 'scripts/session_check.php';

	$name = $_SESSION['Temp_Name'] ;
	$mobile = $_SESSION['Temp_mobile'] ;
	$Email=	$_SESSION['Temp_email'] ;
	$loan_type = $_SESSION['Temp_loan_type'] ;
	$last_id = $_SESSION['Temp_Last_Inserted'] ;
	
	?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>LCD Personal Loan</title>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script src='scripts/pldigittowordconverter.js' type='text/javascript' language='javascript'></script>
<script type="text/javascript" src="ajax.js"></script>
<script type="text/javascript" src="ajax-dynamic-pllist.js"></script>
 <style>
body{
	margin:0px;
	padding:0px;
	font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:11px;
	line-height:16px;
	color:#292323;
}

input{
	margin:0px;
	padding:0px;
	border:1px solid #878787;
}

select{
	margin:0px;
	padding:0px;
	border:1px solid #878787;
}

.bldtxt{
font-weight:bold;
line-height:16px;
color:#4f4d4d;
}

.orgtext {
color:#D75B10;
font-family:Verdana,Arial,Helvetica,sans-serif;
font-size:11px;
font-weight:bold;
line-height:16px;
}

.txt ul{
	margin:0px 0px 0px 2px;
	padding:0px 0px 0px 2px;
}

.txt ul li{
	background: url(images/cl/arrow.gif) no-repeat 0px 4px;
	list-style-type:none;
	color:#292323;
	padding-left:15px; 
	padding-right:0; 
	padding-top:0; 
	padding-bottom:4px 
}
form{
		display:inline;
		margin:0px;
		padding:0px;
}
/* Big box with list of options */
	#ajax_listOfOptions{
		position:absolute;	/* Never change this one */
		width:250px;	/* Width of box */
		height:160px;	/* Height of box */
		overflow:auto;	/* Scrolling features */
		border:1px solid #317082;	/* Dark green border */
		background-color:#FFF;	/* White background color */
    	color: black;
		font-family:Verdana, Arial, Helvetica, sans-serif;
		text-align:left;
		font-size:10px;
		z-index:100;
	}
	#ajax_listOfOptions div{	/* General rule for both .optionDiv and .optionDivSelected */
		margin:1px;		
		padding:1px;
		cursor:pointer;
		font-size:10px;
	}

	#ajax_listOfOptions .optionDivSelected{ /* Selected item in the list */
		background-color:#2375CB;
		color:#FFF;
	}
	#ajax_listOfOptions_iframe{
		background-color:#F00;
		position:absolute;
		z-index:5;
	}
</style>
<script Language="JavaScript" Type="text/javascript">

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

function chgtxtsal()
{
	var nitxt = document.getElementById('chgtxt');
	var niadtxt = document.getElementById('adtxt');
	var citemp = document.personalloan_form.Employment_Status.value;
	if(citemp==0)
	{
		nitxt.innerHTML ="Annual ITR";
		niadtxt.innerHTML="Annual Turnover  <select name='Annual_Turnover' id='Annual_Turnover'  style='width:140px;'>	<option value=''>Please Select</option>	<option value='1' > 0 - 40 Lacs</option>	<option value='4' > 40 Lacs - 1 Cr</option>		<option value='2' > 1Cr - 3Crs </option>	<option value='3' >3Crs & above</option>	</select>";	
	}
	else 
	{
		
		nitxt.innerHTML ="Annual Income";	
		niadtxt.innerHTML="";	
	}
	
}
function addElement()
{
		var ni = document.getElementById('myDiv');
		
		if(ni.innerHTML=="")
		{
		
			if(document.personalloan_form.CC_Holder.value="on")
			{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '<div class="bldtxt">Card held since?<select  size="1" name="Card_Vintage" style="width:140px; "><option value="0">Please select</option> <option value="1">Less than 6 months</option><option value="2">6 to 9 months</option> <option value="3">9 to 12 months</option> <option value="4">more than 12 months</option> </select></div>';
				

			}
		}
		
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
<?
if($_SESSION['UserType']=="") 
{
?>
if(document.personalloan_form.Email.value!="Email Id")
{
	if (!validmail(document.personalloan_form.Email.value))
	{
		//alert("Please enter your valid email address!");
		document.personalloan_form.Email.focus();
		return false;
	}
	
}


<?
}
?>
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
else if((Form.year.value < "1950") || (Form.year.value >"1994"))
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

if((Form.IncomeAmount.value=='')||(Form.IncomeAmount.value=="Annual Income") || (Form.IncomeAmount.value=="Net Take Home(Montly Salary)"))
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

function Decorate(strPlan)
{
       if (document.getElementById('plantype2') != undefined)  
       {
               document.getElementById('plantype2').innerHTML = strPlan;
			   document.getElementById('plantype2').style.background='Beige';  
       }

       return true;
}
function Decorate1(strPlan)
{
       if (document.getElementById('plantype2') != undefined) 
       {
               document.getElementById('plantype2').innerHTML = strPlan;
			   document.getElementById('plantype2').style.background='';  
			     
               
       }

       return true;
}

</script>
<Script Language="JavaScript">
var ajaxRequestMain;  // The variable that makes Ajax possible!
		function ajaxFunctionMain(){
			
			try{
				// Opera 8.0+, Firefox, Safari
				ajaxRequestMain = new XMLHttpRequest();
			} catch (e){
				// Internet Explorer Browsers
				try{
					ajaxRequestMain = new ActiveXObject("Msxml2.XMLHTTP");
				} catch (e) {
					try{
						ajaxRequestMain = new ActiveXObject("Microsoft.XMLHTTP");
					} catch (e){
						// Something went wrong
						alert("Your browser broke!");
						return false;
					}
				}
			}
		}


function addtooltip()
{
		var ni = document.getElementById('myDiv1');
		
		if(ni.innerHTML=="")
		{
		
			//if(document.loan_form.Phone.value!="")
			//{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = 'Please give correct Mobile Number to Activate your Loan Request';
			//}
		}
		
		return true;

	}


function removetooltip()
{
		var ni = document.getElementById('myDiv1');
		
		if(ni.innerHTML!="")
		{
		
//			if(document.loan_form.Phone.value!="")
	//		{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '';
		//	}
		}
		
		return true;

	}

		function insertData()
		{
			var get_full_name = document.getElementById('Name').value;
			//var get_full_name = document.getElementById('full_name').value;
			
			var get_email = document.getElementById('Email').value;
			//var get_email = document.getElementById('email').value;		
			
			var get_mobile_no = document.getElementById('Phone').value;
			//var get_mobile_no = document.getElementById('mobile_no').value;
			
			var get_city = document.getElementById('City').value;
			
			var get_id = document.getElementById('Activate').value;
			//alert();
			var get_product ="1";

				var queryString = "?get_Mobile=" + get_mobile_no +"&get_City=" + get_city + "&get_Full_Name=" + get_full_name +"&get_Email=" + get_email +"&get_product=" + get_product +"&get_Id=" + get_id ;
				
				//alert(queryString); 
				ajaxRequestMain.open("GET", "insert-incomplete-data.php" + queryString, true);
				// Create a function that will receive data sent from the server
				ajaxRequestMain.onreadystatechange = function(){
					if(ajaxRequestMain.readyState == 4)
					{
						document.getElementById('Activate').value=ajaxRequestMain.responseText;
					}
				}

				ajaxRequestMain.send(null); 
			 
		}

	window.onload = ajaxFunctionMain;


</script>
</head>

<body>
<table width="1004" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="161" height="169" align="left" valign="top"><img src="new-images/pl/hdr1.gif" width="161" height="169" /></td>
            <td width="158" height="169" align="left" valign="top"><img src="new-images/pl/hdr2.gif" width="158" height="169" /></td>
            <td width="177" height="169" align="left" valign="top"><img src="new-images/pl/hdr3.gif" width="177" height="169" /></td>
            <td width="186" height="169" align="left" valign="top"><img src="new-images/pl/hdr4.gif" width="186" height="169" /></td>
          </tr>
          <tr>
            <td height="167" align="left" valign="top"><img src="new-images/pl/hdr5.gif" width="161" height="167" /></td>
            <td height="167" align="left" valign="top"><img src="new-images/pl/hdr6.gif" width="158" height="167" /></td>
            <td height="167" align="left" valign="top"><img src="new-images/pl/hdr7.gif" width="177" height="167" /></td>
            <td height="167" align="left" valign="top"><img src="new-images/pl/hdr8.gif" width="186" height="167" /></td>
          </tr>
          <tr>
            <td colspan="4"><table width="95%"  border="0" align="center" cellpadding="0" cellspacing="0">
			   <tr>
			     <td height="8"></td>
			     </tr>
			   <tr>
                <td height="26" valign="middle" class="bldtxt" style="font-size:13px; font-family:Verdana, Arial, Helvetica, sans-serif; ">Apply for Loans to Buy</td>
              </tr>
              <tr>
                <td valign="middle">Laptop, Desktop pc, LCD Monitors TFT/Plazma Screen TV and Latest Computer peripherals.</td>
              </tr>
              <tr>
                <td  style="color:#999999; ">...................................................................................................................................</td>
              </tr>
              <tr>
                <td height="25" class="bldtxt" style="font-size:13px; font-family:Verdana, Arial, Helvetica, sans-serif; " >Why Deal4loans.com</td>
              </tr>
              <tr>
                <td><table width="550" border="0" cellspacing="0" cellpadding="0" >
                  <tr>
                    <td align="left"><table   border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="22" height="22" align="left" valign="middle"><img src="new-images/pl/orng-arrow.gif" width="12" height="12" /></td>
                        <td>Over 6 lakh customers have taken quote at Deal4loans.com</td>
                      </tr>
                      <tr>
                        <td width="22" height="22" align="left" valign="middle"><img src="new-images/pl/orng-arrow.gif" width="12" height="12" /></td>
                        <td>Ndtv Chooses Deal4loans.com to empower its Loans Section.</td>
                      </tr>
                      <tr>
                        <td width="22" height="22" align="left" valign="middle"><img src="new-images/pl/orng-arrow.gif" width="12" height="12" /></td>
                        <td>Personal Loan Quotes are free for customers.</td>
                      </tr>
                      <tr>
                        <td width="22" height="22" align="left" valign="middle"><img src="new-images/pl/orng-arrow.gif" width="12" height="12" /></td>
                        <td>Deal4loans.com has tie ups with all Personal loan Banks in India.</td>
                      </tr>
<tr>
                        <td width="22" height="22" align="left" valign="middle"><img src="new-images/pl/orng-arrow.gif" width="12" height="12" /></td>
                        <td>Personal Loan Quotes are free for customers. It's a totally free service for customers.</td>
                      </tr>
                      <tr>
                        <td width="22" height="22" align="left" valign="middle"><img src="new-images/pl/orng-arrow.gif" width="12" height="12" /></td>
                        <td>All loans repayment period are over 6 months. No short term loans.</td>
                      </tr>
                    </table></td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td height="8">&nbsp;</td>
              </tr>
             
             <tr>
                <td height="25" class="bldtxt" style="font-size:13px; font-family:Verdana, Arial, Helvetica, sans-serif; " >Testimonial</td>
              </tr>
              <tr>
                <td>I think that the launch of a service like www.deal4loans.com will ease the loan seeking and deal hunting process for the likes of me. I wish u guys all the success.
				<div style="float:right; font-weight:bold;" class="bldtxt">Divya</div>
				</td>
              </tr>
             <tr>
                <td  style="color:#999999; ">..................................................................................................................................................................</td>
              </tr>
              <tr>
                <td height="8"></td>
              </tr>
              <tr>
                <td height="25" class="bldtxt" style="font-size:13px; font-family:Verdana, Arial, Helvetica, sans-serif; " >Loan Partners</td>
              </tr>
              <tr>
                <td   ><table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0">
                  <tr>
                    <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td width="17%"><img src="new-images/pl/icici_lgo.jpg" width="99" height="27" /></td>
                          <td width="17%"><img src="new-images/pl/hdfc.jpg" width="99" height="29" /></td>
						  <td width="15%"><img src="new-images/pl/ing_vlgo.jpg" width="90" height="26" /></td>
						  <td width="20%"><img src="new-images/pl/bajj_flgo.jpg" width="110" height="23" /></td>
                          <td width="15%"><img src="new-images/pl/fultrn_n1.jpg" width="90" height="25" /></td>
                        </tr>
                    </table></td>
                  </tr>
                </table></td>
              </tr>
            </table></td>
            </tr>
        </table></td>
        <td width="322" valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="289" height="88" align="left" valign="top"><img src="new-images/pl/frm-hdng.gif" width="289" height="88" /></td>
              </tr>
              <tr>
                <td valign="top" style="border-left:1px solid #c2c2c2; border-right:1px solid #c2c2c2;">
				<form name="personalloan_form"  action="insert_personal_loan_value_step1.php" method="POST" onSubmit="return chkpersonalloan(document.personalloan_form);">
<input type="hidden" name="Type_Loan" value="Req_Loan_Personal">
<input type="hidden" name="creative" value="<? echo $_REQUEST['creative'] ?>">
<input type="hidden" name="section" value="<? echo $_REQUEST['section'] ?>">
<input type="hidden" name="source" value="LdPL"> 
<input type="hidden" name="referrer" value="<? echo $_REQUEST['referrer'] ?>"> 
<input type="hidden" name="Activate" id="Activate" >
<input type="hidden" name="PostURL" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
<div align="center"><font face="Verdana, Arial, Helvetica, sans-serif;" color="#FF0000"><strong><?php if(isset($_GET['msg'])) echo "Kindly give Valid Details"; ?></strong></font></div>
<table width="95%"  border="0" align="right" cellpadding="0" cellspacing="0">
				<tr>
				  <Td>&nbsp;</Td>
				  <Td>&nbsp;</Td>
				  </tr>
				<tr align="left">
				<Td width="40%" class="bldtxt">Full Name </Td>
 				<Td width="60%"><input name="Name" type="text" <? if(isset($loan_type)) { ?>value="<? echo $name; ?>" <? }else {?>value=""<? }?> id="Name" style=" width:140px;" onBlur="onBlurDefault(this,'Name');"  onFocus="onFocusBlank(this,'Name');" onchange="insertData();"/></Td>
				</tr>
				<tr align="left">
				  <Td height="26" class="bldtxt">DOB</Td>
				  <Td><input name="day" type="text" id="day" value="dd" style="width:40px; " onBlur="onBlurDefault(this,'dd');"  onFocus="onFocusBlank(this,'dd');" maxlength="2" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);"/> <input name="month" id="month" type="text" value="mm"  style="width:40px; " onBlur="onBlurDefault(this,'mm');"  onFocus="onFocusBlank(this,'mm');" maxlength="2" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);"/> <input name="year" id="year" type="text" value="yyyy"   style="width:47px; " onBlur="onBlurDefault(this,'yyyy');"  onFocus="onFocusBlank(this,'yyyy');" maxlength="4" onChange="intOnly(this); insertData();" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);"/></Td>
				  </tr>
				<tr align="left">
				  <Td height="26" class="bldtxt">Mobile No. </Td>
				  <Td>+91 
	  <input name="Phone" id="Phone" type="text"  <? if(isset($loan_type)) { ?>value="<? echo $mobile; ?>" <? }else {?>value="" <? }?>style="width:110px; " onChange="intOnly(this); tosendsms(); insertData();" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" onFocus="addtooltip();" maxlength="10"  /></Td>
				  </tr>
				   <tr>
		  <td colspan="2"><div id="myDiv1" style="color:#7d0606; font-family:Verdana; font-size:11px;"></div></td>
		  </tr>
				<tr align="left">
				  <Td height="26" class="bldtxt">Email Id </Td>
				  <Td><input name="Email" id="Email" type="text" <? if(isset($loan_type)) { ?>value="<? echo $Email; ?>" <? }else { ?>value=""<? } ?> style="width:140px; "  onblur="onBlurDefault(this,'Email Id');" onFocus="removetooltip();"  onChange="insertData();"/></Td>
				  </tr>
				<tr align="left">
				  <Td height="26" class="bldtxt">City</Td>
				  <Td><select style="width:142px; height:18px;  "  name="City" id="City" onchange="othercity1(this); insertData(); "  >
        <?=plgetCityList($City)?>
      </select>
 
	  </Td>
				  </tr>
				<tr align="left">
				  <Td height="26" class="bldtxt">Other City </Td>
				  <Td><input name="City_Other" id="City_Other" type="text" value="Other City" style="width:140px; " onblur="onBlurDefault(this,'Other City');"  onfocus="onFocusBlank(this,'Other City');" disabled  /></Td>
				  </tr>
				<tr align="left">
				  <Td height="26" class="bldtxt">Pincode</Td>
				  <Td><input name="Pincode" id="Pincode" type="text"  MAXLENGTH="6" style="width:140px; "  onBlur="onBlurDefault(this,'Pincode');"  onFocus="onFocusBlank(this,'Pincode');" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" /></Td>
				  </tr>
				<tr align="left">
				  <Td height="26" class="bldtxt">Occupation</Td>
				  <Td><select   style="width:140px;"  name="Employment_Status" id="Employment_Status" onChange="chgtxtsal();">
        <option selected value="-1">Employment Status</option>
        <option  value="1">Salaried</option>
        <option value="0">Self Employed</option>
      </select></Td>
				  </tr>
				<tr align="left">
				  <Td height="26" class="bldtxt">Company Name </Td>
				  <Td><input name="Company_Name" id="Company_Name" type="text" style="width:140px; "  onBlur="onBlurDefault(this,'Company Name');"  onFocus="onFocusBlank(this,'Company Name');"  onKeyUp="ajax_showOptions(this,'getCountriesByLetters',event)" /></Td>
				  </tr>
				<tr align="left">
				  <Td height="26" class="bldtxt"><div id="chgtxt">Annual Income</div></Td>
				  <Td><input name="IncomeAmount" id="IncomeAmount" type="text"  style="width:140px; " onFocus="this.select();"  onChange="intOnly(this); addDiv();"  onKeyUp="intOnly(this);PlgetDigitToWords('IncomeAmount','formatedIncome','wordIncome'); addDiv();" onKeyPress="intOnly(this); PlgetDigitToWords('IncomeAmount','formatedIncome','wordIncome');" onBlur="PlgetDigitToWords('IncomeAmount','formatedIncome','wordIncome'); "/>
				  </Td>
				  </tr>
				  <tr>
				  <td colspan="2" align="left"><span id='formatedIncome' style='font-size:11px; font-weight:bold;color:666699;font-Family:Verdana;'></span>
	<span id='wordIncome' style='font-size:11px;font-weight:bold;color:666699;font-Family:Verdana;text-transform: capitalize;   margin-bottom:5px;'></span></td>
				  </tr>
				   <tr>
				  <td colspan="2" align="left" class="bldtxt"><div id="adtxt"></div></td></tr>
				<tr align="left">
				  <Td height="26" class="bldtxt">Loan Amount </Td>
				  <Td><input name="Loan_Amount" id="Loan_Amount" type="text"  style="width:140px; " onFocus="this.select(); onBlurDefault(this,'Loan Amount');" onChange="intOnly(this);"  onKeyUp="intOnly(this);PlgetDigitToWords('Loan_Amount','formatedlA','wordloanAmount');"  onKeyDown="PlgetDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" onKeyPress="intOnly(this); PlgetDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" onBlur="PlgetDigitToWords('Loan_Amount','formatedlA','wordloanAmount'); onBlurDefault(this,'Loan Amount'); onBlurDefault(this,'Loan Amount');">
				</Td>
				  </tr>
				  <tr>
				  <td colspan="2" align="left">  <span id='formatedlA' style='font-size:11px; font-weight:bold;color:666699;font-Family:Verdana; '></span><span id='wordloanAmount' style='font-size:11px;
font-weight:bold;color:666699;font-Family:Verdana;text-transform: capitalize; margin-bottom:5px;'></span></td>
				  </tr>
				<tr align="left">
				  <Td height="40" valign="middle" class="bldtxt" >Are you a Credit card holder?</td>
				  <Td>
<input type="radio"  name="CC_Holder" id="CC_Holder" value="1"  style="border:none;" onclick="addElement();" >
Yes
<input type="radio"  name="CC_Holder" id="CC_Holder" style="border:none;" value="0" onClick="removeElement();">
No</Td>
				  </tr>
				<tr align="left">
				  <Td colspan="2" ><div  id="myDiv"></div></Td>
		  </tr>
				<tr align="left">
				  <Td colspan="2"> <div id="tataaig_compaign" ></div></Td>
				  </tr>
				<tr align="left">
				  <Td height="50" colspan="2"><input type="checkbox"  name="accept" style="border:none;" checked  > I authorize Deal4loans.com & its partnering banks to contact me to explain the product & I Agree to <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow">privacy policy</a> and <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow">Terms and Conditions</a>.</Td>

				  </tr>
				<tr align="center">
				  <Td colspan="2"><input type="image" name="Submit"  src="new-images/pl/quote.gif"  style="width:115px; height:29px; border:none; " /></Td>
				  </tr>
                </table>
				</form></td>
              </tr>
              <tr>
                <td valign="top"><img src="new-images/pl/frm-btm.gif" width="289"   height="21"></td>
              </tr>
              <tr>
                <td valign="middle" height="120"><img src="new-images/pl/step-ban.gif" width="289" height="108" /></td>
              </tr>
            </table></td>
            <td width="33" height="336" align="right" valign="top"><img src="new-images/pl/frm-rgt.gif" width="33" height="336" /></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
<tr><td><?php include 'footer_landingpage1.php'; ?></td></tr>
  <!-- <Tr>
  <td height="69" valign="bottom" style=" background-image:url(new-images/pl/prtnr-bg.gif); background-repeat:no-repeat; "><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                        <tr align="center" class="orgtext">
                          <td width="14%" height="30">SBI</td>
                          <td width="12%">ICICI Bank </td>
                          <td width="13%">Deutsche Bank </td>
                          <td width="12%">HDFC Bank </td>
                          <td width="10%">Citibank</td>
                          <td width="14%">Kotak Mahindra </td>
                          <td width="9%">HSBC</td>
                          <td width="16%">Standard Chartered</td>
                        </tr>
                    </table></td>
  </Tr> -->
</table>

<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-1312775-1");
pageTracker._trackPageview();
} catch(err) {}</script>
</body>
</html>
