<?php
require 'scripts/session_check.php';
require 'scripts/functions.php';

	$name = $_SESSION['Temp_Name'] ;
	$mobile = $_SESSION['Temp_mobile'] ;
	$Email=	$_SESSION['Temp_email'] ;
	$loan_type = $_SESSION['Temp_loan_type'] ;
	$last_id = $_SESSION['Temp_Last_Inserted'] ;
		//echo "last in serted id".$last_id;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Credit Cards</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<Script Language="JavaScript" Type="text/javascript">
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
	if(creditcard_form.City.value=="Others")
	{
		creditcard_form.City_Other.disabled = false;
	}
	else
	{
		creditcard_form.City_Other.disabled = true;
	}
}   

function valButton2() {
		var cnt = -1;
		var i;
		for(i=0; i<document.creditcard_form.Pancard.length; i++) 
		{
			if(document.creditcard_form.Pancard[i].checked)
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

function ckhcreditcard(Form)
{	
var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
var dt,mdate;dt=new Date();
var alpha=/^[a-zA-Z\ ]*$/;
var alphanum=/^[a-zA-Z0-9]*$/;
var num=/^[0-9]*$/;
var space=/^[\ ]*$/;
var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";
var myOption;
/* if(document.loan_form.Email.value!="Email Id")
{
	if (!validmail(document.loan_form.Email.value))
	{
		document.loan_form.Email.focus();
		return false;
	}
}*/
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
if(Form.Employment_Status.selectedIndex==0)
{
	alert("Please select employment status ");
	Form.Employment_Status.focus();
	return false;
}
/*
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
*/
if((Form.Net_Salary.value=='')||(Form.Net_Salary.value=="Annual Income"))
{
	alert("Please enter Annual income to Continue");
	Form.Net_Salary.focus();
	return false;
}
/*var btn = valButton2();
   if (!btn)
   {
		alert('Please select you have pancard or not.');
				return false;
   }*/
  /* myOption = -1;
		for (i=Form.CC_Holder.length-1; i > -1; i--) {
			if(Form.CC_Holder[i].checked) {
				if(i==0)
				{
					if(Form.Card_Vintage.selectedIndex==0)
					{
						alert('Card Held since.');
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
		}*/
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

function othercity1()
{
if(document.creditcard_form.City.value=='Others')
{
document.creditcard_form.City_Other.disabled=false;
}
else
{document.creditcard_form.City_Other.disabled=true;
}
}

function onFocusBlank(element,defaultVal){ if(element.value==defaultVal){ element.value="";	} }
function onBlurDefault(element,defaultVal){	if(element.value==""){ element.value = defaultVal; }}
function HandleOnClose(filename) { if ((event.clientY < 0)) {	   
	   myWindow = window.open(filename, "tinyWindow", 'resizable width=510,height=390, scrollbars')
	   myWindow.document.bgColor=""
	   myWindow.document.close() 
   }
}
function addElementCC()
{
		var ni = document.getElementById('myDivCC');
		 var newdivCC = document.createElement('div');
					
				ni.innerHTML = 'Cards held since?                 <select size="1" name="Card_Vintage" id="Card_Vintage" style="margin-left:20px;valign:bottom;"><option value="0">Please select</option><option value="1">Less than 6 months</option><option value="2">6 to 9 months</option><option value="3">9 to 12 months</option><option value="4">more than 12 months</option></select><br />';
				

			
		
		ni.appendChild(newdivCC);
		

	}


function removeElementCC()
{
		var ni = document.getElementById('myDivCC');
		
		if(ni.innerHTML!="")
		{
		
			
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '';
				
			
		}
		
		return true;

	}
	
	/* function tataaig_comp()
{
	//alert("hello");
	var ni = document.getElementById('tataaig_compaign');
		
		if(ni.innerHTML=="")
		{
			if(document.creditcard_form.City.value=="Delhi" || document.creditcard_form.City.value=='Delhi' || document.creditcard_form.City.value=='Noida'  ||  document.creditcard_form.City.value=='Gurgaon'  ||  document.creditcard_form.City.value=='Faridabad'  ||  document.creditcard_form.City.value=='Gaziabad'  ||  document.creditcard_form.City.value=='Faridabad'  ||  document.creditcard_form.City.value=='Greater Noida'  || document.creditcard_form.City.value=='Chennai'  ||  document.creditcard_form.City.value=='Mumbai'  ||  document.creditcard_form.City.value=='Thane'  ||  document.creditcard_form.City.value=='Navi mumbai'  ||  document.creditcard_form.City.value=='Kolkata'  ||  document.creditcard_form.City.value=='Kolkota'  ||  document.creditcard_form.City.value=='Hyderabad'  ||  document.creditcard_form.City.value=='Pune'  || document.creditcard_form.City.value=='Bangalore')
			{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '<input type="checkbox"  class="NoBrdr" name="Accidental_Insurance" id="Accidental_Insurance" value="1" checked>&nbsp;<a href="tata-aig-personal-accident-cover.php" target="_blank" > Get free personal accident insurance from TATA AIG</a>';
			}
			else 
			{
			//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '';
			}
			
		}
		else if(ni.innerHTML!="")
		{
			if(document.creditcard_form.City.value=="Delhi" || document.creditcard_form.City.value=='Delhi' || document.creditcard_form.City.value=='Noida'  ||  document.creditcard_form.City.value=='Gurgaon'  ||  document.creditcard_form.City.value=='Faridabad'  ||  document.creditcard_form.City.value=='Gaziabad'  ||  document.creditcard_form.City.value=='Faridabad'  ||  document.creditcard_form.City.value=='Greater Noida'  || document.creditcard_form.City.value=='Chennai'  ||  document.creditcard_form.City.value=='Mumbai'  ||  document.creditcard_form.City.value=='Thane'  ||  document.creditcard_form.City.value=='Navi mumbai'  ||  document.creditcard_form.City.value=='Kolkata'  ||  document.creditcard_form.City.value=='Kolkota'  ||  document.creditcard_form.City.value=='Hyderabad'  ||  document.creditcard_form.City.value=='Pune'  || document.creditcard_form.City.value=='Bangalore')
			{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '<input type="checkbox"  class="NoBrdr" name="Accidental_Insurance" id="Accidental_Insurance" value="1" checked>&nbsp;<a href="tata-aig-personal-accident-cover.php" target="_blank" > Get free personal accident insurance from TATA AIG</a>';
			}
			else 
			{
			//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '';
			}
			
		}
		return true;
}
*/

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
<Script Language="JavaScript" Type="text/javascript">
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
		var ni = document.getElementById('myDiv');
		
		if(ni.innerHTML=="")
		{
		
			//if(document.loan_form.Phone.value!="")
			//{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = 'Please give correct Mobile Number to Activate your Card Request';
			//}
		}
		
		return true;

	}


function removetooltip()
{
		var ni = document.getElementById('myDiv');
		
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
			var get_full_name = document.getElementById('Full_Name').value;
			//var get_full_name = document.getElementById('full_name').value;
			
			var get_email = document.getElementById('Email').value;
			//var get_email = document.getElementById('email').value;		
			
			var get_mobile_no = document.getElementById('Phone').value;
			//var get_mobile_no = document.getElementById('mobile_no').value;
			
			var get_city = document.getElementById('City').value;
			
			var get_id = document.getElementById('Activate').value;
			//alert();
			var get_product ="4";

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
<style type="text/css">
body{
	margin:0px;
	padding:0px;
	background:#cbecff url(../new-images/main-bg.gif) repeat-y center;
	font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:11px;
	line-height:16px;
	color:#373737;
	background-color:#545d63;
	}

a{
	font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:11px;
	color:#373737;

	}


input{
	border:1px solid #8c8b8b;
	font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:11px;
	color: #333333;
	font-weight:normal;
 	padding:2px;

}

select{

	border:1px solid #8c8b8b;
	font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:11px;
	color: #333333;
	font-weight:normal;
 	padding:2px;
}

.hdrboldtxt{
	font-family: Arial, Helvetica, sans-serif;
	font-size:36px;
	line-height:45px;
	font-weight: bold;
	color:#12517b;
	background:url(new-images/cc/hdr-bg.jpg) no-repeat left top;
}

.banknametxt{
 	font-size:11px;
	line-height:16px;
 	color:#05394a;
	background:url(new-images/cc/hdr-bankbg.jpg) no-repeat left top;
}
 
.steptext{
	font-size:13px;
	font-weight:bold;
	color:#ffffff;
	background:url(new-images/cc/step-bg.jpg) no-repeat left top;
	height:47px;

}

.hdngbg{
	font-size:16px;
	font-family:Arial, Helvetica, sans-serif;
	font-weight:bold;
	text-indent:10px;
 	color:#2f373c;
	background:url(new-images/cc/hdng-bg.jpg) no-repeat;
	height:29px;
}

.formhdng{
	font-size:16px;
	font-family:Arial, Helvetica, sans-serif;
	font-weight:bold;
	text-indent:10px;
 	color:#db681b;
 }

.formbg{
 	background:#f2f2f2 url(new-images/cc/formbg.gif) no-repeat left bottom;
	width:324px;
	float:left;

}


.txt ul{
	margin:5px 0px 0px 5px;
	padding:5px 0px 0px 5px;
}

.txt ul li{
	background: url(new-images/cc/arrow.jpg) no-repeat 0px 4px;
	list-style-type:none; 
	padding-left:15px; 
	padding-right:0; 
	padding-top:0; 
	padding-bottom:4px 
}

 
</style>
</head>

<body>
<table width="960" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td><table width="950" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="70" align="left" style="padding-left:15px; "><img src="new-images/cc/logo.gif" width="176" height="55" /></td>
  </tr>
  <tr>
    <td> 
      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td width="57" height="238" rowspan="2" align="left" valign="top"><img src="new-images/cc/hdr1.gif" width="57" height="238" /></td>
          <td height="149" align="left" valign="middle" class="hdrboldtxt">Let Banks Competite to give<br />
            you their Best Credit Cards</td>
          <td width="141" rowspan="2"><img src="new-images/cc/hdr2.jpg" width="141" height="238" /></td>
          <td width="141" rowspan="2" align="right"><img src="new-images/cc/hdr3.jpg" width="141" height="238" /></td>
          <td width="130" rowspan="2" align="right"><img src="new-images/cc/hdr4.jpg" width="130" height="238" /></td>
        </tr>
        <tr>
          <td height="89" valign="top" class="banknametxt"><table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
              <td height="26"><b>www.deal4loans.com</b></td>
            </tr>
            <tr>
              <td>The one-stop shop for best on all credit card requirements<br />
                Now get offers from <b>ICICI, ABN AMRO, Deutsche, Citibank, Reliance</b> and <b>SBI</b><br />
                and choose the best card!</td>
            </tr>
          </table></td>
          </tr>
      </table></td>
  </tr>
  <tr>
    <td style="padding-top:5px; ">&nbsp;</td>
  </tr>
  <tr>
            <td height="52" align="center" valign="middle" class="formhdng">Thanks for Applying Deal4loans.com</td>
  </tr>
  <tr>
    <td height="400" align="center" valign="middle" class="formhdng">&nbsp;</td>
  </tr>
</table>
</td>
  </tr>
</table>
  
</body>
</html>
