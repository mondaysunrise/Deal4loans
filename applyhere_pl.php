<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	$page_Name = "LandingPage_PL";
	$Msg = "";
	if($_SESSION['UserType']== "bidder")
	{
	$Msg = getAlert("Sorry!!!! You are not Authorised to Apply for Loan.", TRUE, "index.php");
	echo $Msg;
	}
	$name = $_SESSION['Temp_Name'] ;
	$mobile = $_SESSION['Temp_mobile'] ;
	$Email=	$_SESSION['Temp_email'] ;
	$loan_type = $_SESSION['Temp_loan_type'] ;
	$last_id = $_SESSION['Temp_Last_Inserted'] ;
	//echo "last in serted id".$last_id;
	?>
<html>
<head>
<title>Apply Personal Loans India | Compare Best Rates Personal Loans</title>
<meta name="description" content="Deal4Loans is an online loan information portal, provides valuable information on Personal loans in India offered by top banks. Apply for Personal Loans and Get, Compare and Choose deals from all the leading loan providers / banks like HDFC Bank, ICICI bank, SBI, Citibank, Barclays Bank etc.">
<meta name="keywords" content="Personal loans India, Apply Personal Loans, Compare Personal Loans in Mumbai Hyderabad Pune kolkata Delhi Noida Bangalore">
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script src='scripts/pldigittowordconverter.js' type='text/javascript' language='javascript'></script>
<style>
.style1{
font-size:12px;
line-height:150%;
color:68718A;
font-weight:bold;
font-Family:Verdana;
}
.style4{
font-size:10px;
font-weight:bold;
color:666699;
font-Family:Verdana;
}
.style3{
font-size:12px;
color:68718A;
font-weight:bold;
line-height:150%;
font-Family:Verdana;
}
.style2{
font-size:12.5px;
color:white;

font-weight:bolder;
font-Family:Verdana;
}
input, select {font:12px Arial; padding:2px; margin:0px; border: 1px solid #68718A;}
input.NoBrdr	{font:12px Arial; padding:0px; margin:0px; border: 0px}
</style>
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
	function Decoration(strPlan)
{
       if (document.getElementById('plantype') != undefined)  
       {
               document.getElementById('plantype').innerHTML = strPlan;
			   document.getElementById('plantype').style.background='Beige';  
       }

       return true;
}
function Decoration1(strPlan)
{
       if (document.getElementById('plantype') != undefined) 
       {
               document.getElementById('plantype').innerHTML = strPlan;
			   document.getElementById('plantype').style.background='';  
			     
               
       }

       return true;
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

/*function tataaig_comp()
{
	//alert("hello");
	var ni = document.getElementById('tataaig_compaign');
		
		if(ni.innerHTML=="")
		{
			if(document.loan_form.City.value=="Delhi" || document.loan_form.City.value=='Delhi' || document.loan_form.City.value=='Noida'  ||  document.loan_form.City.value=='Gurgaon'  ||  document.loan_form.City.value=='Faridabad'  ||  document.loan_form.City.value=='Gaziabad'  ||  document.loan_form.City.value=='Faridabad'  ||  document.loan_form.City.value=='Greater Noida'  || document.loan_form.City.value=='Chennai'  ||  document.loan_form.City.value=='Mumbai'  ||  document.loan_form.City.value=='Thane'  ||  document.loan_form.City.value=='Navi mumbai'  ||  document.loan_form.City.value=='Kolkata'  ||  document.loan_form.City.value=='Kolkota'  ||  document.loan_form.City.value=='Hyderabad'  ||  document.loan_form.City.value=='Pune'  || document.loan_form.City.value=='Bangalore')
			{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '<input type="checkbox"  class="NoBrdr" name="Accidental_Insurance" id="Accidental_Insurance" value="1" checked>&nbsp;<a href="tata-aig-personal-accident-cover.php" target="_blank" class="style4"> Get free personal accident insurance from TATA AIG</a>';
			}
			else 
			{
			//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '';
			}
			
		}
		else if(ni.innerHTML!="")
		{
			if(document.loan_form.City.value=="Delhi" || document.loan_form.City.value=='Delhi' || document.loan_form.City.value=='Noida'  ||  document.loan_form.City.value=='Gurgaon'  ||  document.loan_form.City.value=='Faridabad'  ||  document.loan_form.City.value=='Gaziabad'  ||  document.loan_form.City.value=='Faridabad'  ||  document.loan_form.City.value=='Greater Noida'  || document.loan_form.City.value=='Chennai'  ||  document.loan_form.City.value=='Mumbai'  ||  document.loan_form.City.value=='Thane'  ||  document.loan_form.City.value=='Navi mumbai'  ||  document.loan_form.City.value=='Kolkata'  ||  document.loan_form.City.value=='Kolkota'  ||  document.loan_form.City.value=='Hyderabad'  ||  document.loan_form.City.value=='Pune'  || document.loan_form.City.value=='Bangalore')
			{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '<input type="checkbox"  class="NoBrdr" name="Accidental_Insurance" id="Accidental_Insurance" value="1" checked>&nbsp;<a href="tata-aig-personal-accident-cover.php" target="_blank" class="style4" > Get free personal accident insurance from TATA AIG</a>';
			}
			else 
			{
			//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '';
			}
			
		}
		return true;
} */

function valButton2() {
    var cnt = -1;
	var i;
    for(i=0; i<document.loan_form.From_Product.length; i++) 
	{
        if(document.loan_form.From_Product[i].checked)
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
		
			if(document.loan_form.CC_Holder.value="on")
			{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '<table><tr><td align="left"  class="style4" width="210" height="20"><font class="style4">Card held since?</td><td  align="left" colspan="3" width="290" height="20"><select class="style4" size="1" name="Card_Vintage"><option value="0">Please select</option> <option value="1">Less than 6 months</option>		 <option value="2">6 to 9 months</option> <option value="3">9 to 12 months</option>				<option value="4">more than 12 months</option> </select></td>	</tr></table>';
				

			}
		}
		
		return true;

	}


function removeElement()
{
		var ni = document.getElementById('myDiv');
		
		if(ni.innerHTML!="")
		{
		
			if(document.loan_form.CC_Holder.value="on")
			{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '';
				
			}
		}
		
		return true;

	}

	function netsalarytab()
{
	
	 if (( loan_form.Employment_Status.value=="0" ))
       {
               		document.loan_form.IncomeAmount.value="Annual Income";
			          }
	else {
		
             
			   document.loan_form.IncomeAmount.value="Net Take Home(Montly Salary)";
			     //document.getElementById('plantype1').innerHTML = strPlan;
       }

       return true;
}   
function submitform(Form)
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
if(document.loan_form.Email.value!="Email Id")
{
	if (!validmail(document.loan_form.Email.value))
	{
		//alert("Please enter your valid email address!");
		document.loan_form.Email.focus();
		return false;
	}
	
}

<?
}
?>
if((Form.Name.value=="") || (Form.Name.value=="Full Name")|| (Trim(Form.Name.value))==false)
{
alert("Kindly fill in your Name!");
document.loan_form.Name.focus();
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

	
if((Form.Phone.value=='Mobile') || (Form.Phone.value=='') || Trim(Form.Phone.value)==false)
{
alert("Kindly fill in your Mobile Number!");
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

/*
else if(Form.Phone.value!='')
	{
		if (!validmobile(Form.Phone.value))
		{
			//alert("Please enter your valid email address!");
			Form.Phone.focus();
			return false;
		}
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
*/
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
if((Form.IncomeAmount.value=='')||(Form.IncomeAmount.value=="Annual Income")|| (Form.IncomeAmount.value=="Net Take Home(Montly Salary)"))
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
if(document.loan_form.City.value=='Others')
{
document.loan_form.City_Other.disabled=false;
}
else
{document.loan_form.City_Other.disabled=true;
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
</script>
<script>
var ajaxRequest;  // The variable that makes Ajax possible!
		function ajaxFunction(){
			
			try{
				// Opera 8.0+, Firefox, Safari
				ajaxRequest = new XMLHttpRequest();
			} catch (e){
				// Internet Explorer Browsers
				try{
					ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
				} catch (e) {
					try{
						ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
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
				ni.innerHTML = 'Please give correct Mobile Number to Activate your Loan Request';
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
				ajaxRequest.open("GET", "insert-incomplete-data.php" + queryString, true);
				// Create a function that will receive data sent from the server
				ajaxRequest.onreadystatechange = function(){
					if(ajaxRequest.readyState == 4)
					{
						document.getElementById('Activate').value=ajaxRequest.responseText;
					}
				}

				ajaxRequest.send(null); 
			 
		}

	window.onload = ajaxFunction;


</script>

</head>
<body onbeforeunload="HandleOnClose('closedby_pl.php')">
<form name="loan_form" method="post" action="thank_individual.php?closeref=PL" onSubmit="return submitform(document.loan_form);">

<!--div align="center"!-->
<table width="850" style="border: 1px solid #68718A;" align="center">
	<tr>
		<td colspan="5" align="center" width="840"><img src="images/logopersonal1.gif" alt="personal loans deal4loans"></td>
	</tr>
	
	<tr>
		<td width="4">&nbsp;</td>
		<td width="470" valign="top" align="right" >
		<table border="0" width="460">
		
			<tr>
				<td colspan="2" valign="top" width="463" ><img src="images/3steps.gif" alt="apply personal loan" align="left" >
				</td>
			</tr>
			
			<tr>
				<td width="28"><table  height="55" align="right" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td height="4"></td>
				</tr>
				<tr>
					<td height="13"><img src="images/arrow2.gif"></td>
				</tr>
				<tr>
					<td height="13" ><img src="images/arrow2.gif"></td>
				</tr>

				<tr>
					<td height="13"  ><img src="images/arrow2.gif"></td>
				</tr>
			</table>
			<td align="left" height="58" width="431" ><font class="style1"> Post your Personal loan requirement.<br />
			Get &amp; compare Personal loan offers from all Banks.<br />
			Get the best deal for your Personal loan.</font> </td>
			</tr>
			<tr>
		
					<td colspan="2" style="padding-left:33px;" width="431"><font style="color:blue;font-family:Verdana ;font-size:13px;font-weight:bolder;">www.deal4loans.com</font></td>
						</tr>
						<tr>
		
					<td colspan="2" style="padding-left:25px;" width="439"><font class="style1">The one-stop shop for best on all Personal loan requirements</font></td>
						</tr>
						<tr>
						<td colspan="2" style="padding-left:25px;" width="439"><font class="style1">Now get offers from</font> <font  style="font-weight:bold;color:black;font-family:Verdana; font-size:12px;" >ICICI, HDFC Bank, Deutsche, Citibank, HSBC, Kotak, Standard Chartered ,and IDBI </font><font class="style1">and choose the best deal!</font></td>
						</tr>
						<tr>
						<td colspan="2" width="463"></td>
						</tr>
						<tr>
						<td colspan="2" width="460"><table width="100%" border="0" >
					<tr>
					<td width="10">&nbsp;</td>
					<td bgcolor="0A71D9"><font class="style2">
					Deal4loans Testimonials</font></td>
						</tr>

					<tr>
					<td width="10">&nbsp;</td>
				<td colspan="2" style="padding-left:15px;padding-right:15px; " bgcolor="DAEAF9"><font class="style1"><p>I think that the launch of a service like <a href="http://www.deal4loans.com/">www.deal4loans.com</a> will ease the loan seeking and deal hunting process for the likes of me. I wish u guys all the success.</p></font><br>
		
			<font  style="font-weight:bold;color:black;font-family:Verdana; font-size:12px; float:right;" >- Divya&nbsp; </font>
				</td>
			</tr>	
				<!--<tr>
					<td width="10">&nbsp;</td>
					<td bgcolor="0A71D9"><font class="style2">
					Introducing Live chat- Get online quotes for your loan requirement </font></td>
						</tr>
						<tr>
						<td width="10">&nbsp;</td>
					<td colspan="2" style="padding-left:15px;padding-right:15px; " align="center" bgcolor="DAEAF9">
			<img src="images/banner.gif" onclick="javascript:window.open('http://www.deal4loans.com/Contents_chat.php','_blank');" style="cursor:pointer;"></a>
			</td>
			</tr>	-->
			<tr>
					<td width="10">&nbsp;</td>
					<td bgcolor="0A71D9"><font class="style2">
					Helpful tips to get the best personal loan deal.</font></td>
						</tr>
	</table></td>
					
			<tr>
					<td height="17" width="28" valign="top"><img src="images/arrow2.gif"></td>
					<td valign="top" width="431" ><font class="style3">Your eligibility & rates for Personal loans are provided on the basis of income,  track record with any bank, credit card usage/payments and many more.<font  style="font-weight:bold;color:black;font-family:Verdana; font-size:12px;" > To get the critical information for personal loan, Apply Now!</font><br>
As it is an unsecured loan so banks try gauging your intention to pay loan. Customers tend to make mistakes while entering into deals, which is not beneficial to them, so its better to compare all the variables given by different banks before signing a loan agreement. 
The parameters on the basis of which you can compre a Personal Loan are:
<ol>

<li> Eligibility.</li> 

<li> Interest rates best suited. </li>

<li> Processing Fees. </li>

<li> Pre-payment/Foreclosure charges.</li> 

<li> Document required. </li>

<li> Turn Around Time.</li>
</ol>
 <br>
					<a href="http://www.deal4loans.com/Contents_Personal_Loan_Mustread.php" style="border: 0px;" target="_blank" ><img src="images/khnowmore.gif" ></a>
	 
 				</font>
				</td>
				</tr>
		
		  
	
		</table></td>
		
		<td bgcolor="DAEAF9" width="300" valign="top" align="center" >
		<table border="0" height="100%" cellspacing="0" cellpadding="0" width="200">
		<tr>			
			<td align="center" valign="bottom" colspan="2" width="362"><h2 style="font-family:Verdana; font-weight:bold;font-size:12px"> Personal Loan Request </h2></td>
			</tr>
			<tr>
				<td align="center" colspan="2"><font style="font-family:Verdana;"><h5>Step 1 of 2</h5></font></td>
				</tr>
			<tr>
			<td colspan="2" align="center"  width="4"><input type="hidden" name="referrer" value="<? echo $_REQUEST['referrer'] ?>"></td>

			</tr>
			<tr>
			<td colspan="2" align="center" width="4"><input type="hidden" name="Type_Loan" value="Req_Loan_Personal"></td>
			</tr>
			<tr>
			<td colspan="2" align="center" width="4"><input type="hidden" name="creative" value="<? echo $_REQUEST['creative'] ?>"></td>

			</tr>
			<tr>
			<td colspan="2" align="center" width="4"><input type="hidden" name="section" value="<? echo $_REQUEST['section'] ?>"></td>

			</tr>
			<tr>
			<td colspan="2" align="center" width="4">
            <?php
			if(strlen($_REQUEST['source'])>0)
			{
				$source = $_REQUEST['source'];
			}
			else
			{
				$source = "applyhere_pl";
			}
			?>
            <input type="hidden" name="source" value="<? echo $source; ?>">
			 <input type="hidden" name="PostURL" value="<?php echo $_SERVER['REQUEST_URI']; ?>"></td>
			</tr>
			<tr>
			<td colspan="2" align="center" width="4"><input type="hidden" name="last_id" value="<? echo $last_id ?>"></td>
			</tr>
			<tr>
				<td width="278">
				<table border="0" width="230" align="center" cellpadding="0" cellspacing="4" >
				<tr><td align="center" colspan="4"><font face="Verdana, Arial, Helvetica, sans-serif" color="#FF0000"><strong><?php if(isset($_GET['msg'])) echo "Kindly give Valid Details"; ?></strong></font>
	</td></tr>
			<tr>
				<td align="left" colspan="4"  width="340" height="18" ><input class="style4" size="39" <? if(isset($loan_type)) { ?>value="<? echo $name; ?>" <? }else {?>value="Full Name"<? }?> name="Name" id="Name" style="float: left" onBlur="onBlurDefault(this,'Full Name');" onFocus="onFocusBlank(this,'Full Name');" onChange="insertData();"><br></td>
			</tr>
					
			<tr>
		   <td align="left" width="148" height="20"><font class="style4">&nbsp;DOB</font></td>
		   <td colspan="3" align="right" width="196" height="20">
			<input name="day" value="dd" type="text" id="day" size="4" maxlength="2" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)"; class="style4" onBlur="onBlurDefault(this,'dd');" onFocus="onFocusBlank(this,'dd');">
			<input name="month" id="month" size="4" maxlength="2" onChange="intOnly(this);" value="mm"  onKeyUp="intOnly(this);" onKeyPress="intOnly(this)" class="style4" onBlur="onBlurDefault(this,'mm');" onFocus="onFocusBlank(this,'mm');">
			<input name="year" type="text" id="year" value="yyyy" size="4" maxlength="4" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)"; class="style4" onBlur="onBlurDefault(this,'yyyy');" onFocus="onFocusBlank(this,'yyyy');">
		   </td>

		 </tr>
		 
			<tr>
				<td align="left" class="style4" width="148" height="20"><font class="style4">&nbsp;Mobile No.</font></td>
				<td colspan="3" align="right" width="196" height="20" >
				<font class="style4">+91</font>
				<input size="17" type="text"   maxlength="10" class="style4" name="Phone" id="Phone"  <? if(isset($loan_type)) { ?>value="<? echo $mobile; ?>" <? }?> onChange="intOnly(this); tosendsms(); insertData();" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" onFocus="addtooltip();"> </td>
			</tr>
			<tr>
			  <td align="left" colspan="4"><div id="myDiv" style="color:#7d0606; font-family:Verdana; font-size:11px; font-weight:normal;"></div></td>
			  </tr>
			<tr>
				<td align="left" colspan="4"  width="340" height="18" ><input class="style4" size="39" <? if(isset($loan_type)) { ?>value="<? echo $Email; ?>" <? }else { ?>value="Email Id"<? } ?> name="Email" id="Email" style="float: left"  onblur="onBlurDefault(this,'Email Id');"  onFocus="removetooltip();"  onChange="insertData();"> </td>

			</tr>
			
			 <tr>
		 <td align="left" colspan="4"  width="340" height="20" >
		  <select size="1" align="left" style="width:251" id="City" name="City" onChange="othercity1(this); insertData();" class="style4">
		 <?=getCityList1($City)?>
		 </select>
		 </td>
	   </tr>
			<tr>
				<td colspan="4" align="center" width="340" height="18" >
				<input size="39" class="style4" disabled value="Other City"   name="City_Other" style="float: left" onBlur="onBlurDefault(this,'Other City');" onFocus="onFocusBlank(this,'Other City');"></td>
			</tr>
			<tr>
				<td colspan="4" align="center" width="340" height="18" >
				<input size="39" class="style4" value="Pincode" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" name="Pincode" style="float: left" onBlur="onBlurDefault(this,'PinCode');" onFocus="onFocusBlank(this,'Pincode');" maxlength="7"></td>

			</tr>
			<tr>
				<td align="left" colspan="4" width="340" height="18" >
				<select align="left" style="width:251" class="style4"  name="Employment_Status" id="Employment_Status" onChange="netsalarytab();">
				<option selected value="-1">Employment Status</option>
				<option  value="1">Salaried</option>
				<option value="0">Self Employed</option>
				</select></td>
			</tr>
			<tr>
				<td colspan="4" align="center" width="348" height="18">
				<input size="39" class="style4" name="Company_Name"  value="Company Name" style="float: left" onBlur="onBlurDefault(this,'Company Name');"  onFocus="onFocusBlank(this,'Company Name');"></td>
			</tr>
			
			<tr>
				<td colspan="4" align="left" width="348" height="18">
				<input size="39" value="Annual Income" name="IncomeAmount" id="IncomeAmount" onFocus="this.select();" class="style4" onChange="intOnly(this);"  onKeyUp="intOnly(this); PlgetDigitToWords('IncomeAmount','formatedIncome','wordIncome');" onKeyPress="intOnly(this);"  style="float: left" onBlur="PlgetDigitToWords('IncomeAmount','formatedIncome','wordIncome');  if(document.getElementById('Employment_Status').value==1){ onBlurDefault(this,'Net Take Home(Montly Salary)');}else {onBlurDefault(this,'Annual Income');
				};"><br> <span id='formatedIncome' style='font-size:11px; font-weight:bold;color:666699;font-Family:Verdana;'></span><span id='wordIncome' style='font-size:11px;
font-weight:bold;color:666699;font-Family:Verdana;text-transform: capitalize;'></span></td>
				
			</tr>
			<tr>
				<td colspan="4" align="left" width="340" height="18">
				<input size="39" value="Loan Amount" name="Loan_Amount"  id="Loan_Amount" onFocus="this.select();" class="style4" onChange="intOnly(this);"  onKeyUp="intOnly(this);PlgetDigitToWords('Loan_Amount','formatedlA','wordloanAmount');"  style="float: left" onKeyDown="PlgetDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" onKeyPress="intOnly(this); PlgetDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" onBlur="PlgetDigitToWords('Loan_Amount','formatedlA','wordloanAmount'); onBlurDefault(this,'Loan Amount');"><br> <span id='formatedlA' style='font-size:11px; font-weight:bold;color:666699;font-Family:Verdana;'></span><span id='wordloanAmount' style='font-size:11px;
font-weight:bold;color:666699;font-Family:Verdana;text-transform: capitalize;'></span></td>
			</tr>
			 <tr>
			<td align="left" class="style4" width="150" height="20"><font class="style4">Are you a Credit card holder?</font></td> <td colspan="3" class="bodyarial11" width="350" ><table border="0" >
			<td  align="right" width="60" height="20"><input type="radio"  name="CC_Holder" class="NoBrdr"  value="1"  onclick="addElement();" ><font class="style4">Yes</font></td>
			<td  align="right" width="60" height="18">
			<input type="radio" class="NoBrdr" name="CC_Holder" value="0" onClick="removeElement();"><font class="style4"  >No</font></td></tr></table></td>
		</tr>	
		 <tr><td colspan="4" id="myDiv"></td></tr>
		
			</table>
		  
		
	</td>
	</tr>
	  <tr><td colspan="2" id="tataaig_compaign"></td></tr>
	<tr>
			<td colspan="4"><input type="hidden" name="Activate" id="Activate" ><input type="checkbox" class="style4" name="accept" checked> <font class="style4"> I authorize Deal4loans.com & its partnering Banks to call me with reference to my loan application  & Agree to <a href="http://www.deal4loans.com/Privacy.php" target="_blank">Privacy Policy</a> and <a href="http://www.deal4loans.com/Privacy.php" target="_blank">Terms and Conditions</a>.</font></td></tr>
		<tr>
			<td colspan="4">&nbsp;</td></tr>
		<tr>
			<td colspan="4" align="center" width="276"><input  type="image" src="images/submit1.gif" style="border: 0px;"></td>
		</tr>
		 <tr>
			<td colspan="2">&nbsp;</td>
		</tr>
		 <tr>
			<td colspan="2">&nbsp;</td>
		</tr>
		 <tr>
			 <td colspan="2">&nbsp;</td>
		</tr>
		</table>
		</td>
	<td width="62">&nbsp;</td>
</tr>
<tr bgcolor="DAEAF9">
	<td bgcolor="DAEAF9" colspan="5" width="847">&nbsp;</td>
	</tr>

</table>
<!--/div!-->
</form>
<script src="http://www.google-analytics.com/urchin.js"  
type="text/javascript">
</script>
<script type="text/javascript">
_uacct = "UA-1312775-1";
urchinTracker();
</script>
</body>
</html>