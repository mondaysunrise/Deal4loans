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
<title>Personal Loan</title>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script src='scripts/pldigittowordconverter.js' type='text/javascript' language='javascript'></script>
<link rel="stylesheet" href="http://www.deal4loans.com/css/personal-loan.css" type="text/css" />
<style>
.addexpandeddiv{
height:150px;
width:auto;
border-left:2px solid #5578C8;
border-right:2px solid #5578C8;
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


function addDiv()
{
		var ni = document.getElementById('mynewDiv');
		
		if(ni.innerHTML=="")
		{
		
			if(document.personalloan_form.IncomeAmount.value="on")
			{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '<div id="expanddiv" class="addexpandeddiv" ></div>';
				

			}
		}
		
		return true;

	}

function addElement()
{
		var ni = document.getElementById('myDiv');
		
		if(ni.innerHTML=="")
		{
		
			if(document.personalloan_form.CC_Holder.value="on")
			{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '<div  class="form-bg"><span class="form-text">Card held since?</span><select class="style4" size="1" name="Card_Vintage" style="margin-left:25px; width:140px; margin-top:2px;"><option value="0">Please select</option> <option value="1">Less than 6 months</option>		 <option value="2">6 to 9 months</option> <option value="3">9 to 12 months</option>				<option value="4">more than 12 months</option> </select></div>';
				

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
else if ((Form.Phone.value.charAt(0)!="9") && (Form.Phone.value.charAt(0)!="8"))
		{
                alert("The number should start only with 9 or 8");
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
for (var i = 0; i < Form.Company_Name.value.length; i++) {
  	if (iChars.indexOf(Form.Company_Name.value.charAt(i)) != -1) {
  	alert ("Company Name has special characters.\n Please remove them and try again.");
	Form.Company_Name.focus();
  	return false;
  	}
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

function netsalarytab()
{
	//alert(document.getElementById('Employment_Status').value);
	 if (( document.personalloan_form.Employment_Status.value=="0" ) || ( document.personalloan_form.Employment_Status.value=="-1" ))
       {
                 document.getElementById('nettab').innerHTML = "Annual Income  <input name='IncomeAmount' id='IncomeAmount' type='text' value='Annual Income' style='margin-left:27px; width:140px; margin-top:2px;' onFocus='this.select();'  onChange='intOnly(this); addDiv();'  onKeyUp=\"intOnly(this);PlgetDigitToWords('IncomeAmount','formatedIncome','wordIncome'); addDiv();\" onKeyPress=\"intOnly(this); PlgetDigitToWords('IncomeAmount','formatedIncome','wordIncome');\" onBlur=\"PlgetDigitToWords('IncomeAmount','formatedIncome','wordIncome'); \"/></div>";
			     //document.getElementById('plantype1').innerHTML = strPlan;
       }
	else {
		
               document.getElementById('nettab').innerHTML = "<span class='form-text' style='padding-left:0px; margin-left:0px;'>Net Take Home</span> <input name='IncomeAmount' id='IncomeAmount' type='text' value='Monthly Salary' style='margin-left:25px; width:140px; margin-top:2px;' onFocus=\"this.select(); onBlurDefault(this,'Annual Income');\"  onChange=\"intOnly(this); addDiv();\"  onKeyUp=\"intOnly(this);PlgetDigitToWords('IncomeAmount','formatedIncome','wordIncome'); addDiv();\" onKeyPress=\"intOnly(this); PlgetDigitToWords('IncomeAmount','formatedIncome','wordIncome');\" onBlur=\"PlgetDigitToWords('IncomeAmount','formatedIncome','wordIncome'); onBlurDefault(this,'Annual Income'); \"/>";
			     //document.getElementById('plantype1').innerHTML = strPlan;
       }

       return true;
}   

function tataaig_comp()
{
	//alert("hello");
	var ni = document.getElementById('tataaig_compaign');
		
		if(ni.innerHTML=="")
		{
			if(document.personalloan_form.City.value=="Delhi" || document.personalloan_form.City.value=='Delhi' || document.personalloan_form.City.value=='Noida'  ||  document.personalloan_form.City.value=='Gurgaon'  ||  document.personalloan_form.City.value=='Faridabad'  ||  document.personalloan_form.City.value=='Gaziabad'  ||  document.personalloan_form.City.value=='Faridabad'  ||  document.personalloan_form.City.value=='Greater Noida'  || document.personalloan_form.City.value=='Chennai'  ||  document.personalloan_form.City.value=='Mumbai'  ||  document.personalloan_form.City.value=='Thane'  ||  document.personalloan_form.City.value=='Navi mumbai'  ||  document.personalloan_form.City.value=='Kolkata'  ||  document.personalloan_form.City.value=='Kolkota'  ||  document.personalloan_form.City.value=='Hyderabad'  ||  document.personalloan_form.City.value=='Pune'  || document.personalloan_form.City.value=='Bangalore')
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
			if(document.personalloan_form.City.value=="Delhi" || document.personalloan_form.City.value=='Delhi' || document.personalloan_form.City.value=='Noida'  ||  document.personalloan_form.City.value=='Gurgaon'  ||  document.personalloan_form.City.value=='Faridabad'  ||  document.personalloan_form.City.value=='Gaziabad'  ||  document.personalloan_form.City.value=='Faridabad'  ||  document.personalloan_form.City.value=='Greater Noida'  || document.personalloan_form.City.value=='Chennai'  ||  document.personalloan_form.City.value=='Mumbai'  ||  document.personalloan_form.City.value=='Thane'  ||  document.personalloan_form.City.value=='Navi mumbai'  ||  document.personalloan_form.City.value=='Kolkata'  ||  document.personalloan_form.City.value=='Kolkota'  ||  document.personalloan_form.City.value=='Hyderabad'  ||  document.personalloan_form.City.value=='Pune'  || document.personalloan_form.City.value=='Bangalore')
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
<div id="container">
<div id="prsnl-top"></div>

<div id="prsnl-brdr" class="brder">

<div id="left-content">
<div class="logo"></div>

<div id="txt-bld">Personal Loans by Choice not by Chance !</div>

<div id="img-lft"></div>
<div id="img-rgt"></div>

<div class="content-pnl">Just 3 Easy Steps!</div>
<div id="steps1">Post your Personal loan requirement</div>
<div id="steps2">Get & compare Personal loan offers from all Banks</div>
<div id="steps3">Get the best deal for your Personal loan Instanly.</div>
<div id="steps3">It's a totally free service for customers</div>
<div class="content-pnl">www.deal4loans.com</div>
<div  class="content-deal">The one-stop shop for best on all Personal loan requirements
 Now get offers from <strong>SBI, ICICI, HDFC Bank, DEUTSCHE, CITIBANK, HSBC,
 Citifinancial, Fullerton, Barclays Finance </strong>and Choose the Best Deal!</div>
 <div class="content-pnl">Testimonial</div>
<div  class="content-deal">I think that the launch of a service like www.deal4loans.com
will ease the loan seeking and deal hunting process for the
likes of me. I wish u guys all the success.<div style="float:right; color:#4C2306;"><b>Divya</b></div>
</div>


</div>

<form name="personalloan_form"  action="apply-personal-loans-brands-continue.php" method="POST" onSubmit="return chkpersonalloan(document.personalloan_form);">

<div id="form-str">

<div id="form-top-lft">&nbsp;</div>
<div id="form-top-rgt">&nbsp;</div>
<div id="form-bld-text">Personal Loan Request</div>
	<input type="hidden" name="Type_Loan" value="Req_Loan_Personal">
<input type="hidden" name="creative" value="<? echo $_REQUEST['creative'] ?>">
<input type="hidden" name="section" value="<? echo $_REQUEST['section'] ?>">
<input type="hidden" name="source" value="compBrand Personal Loan"> 
<input type="hidden" name="referrer" value="<? echo $_REQUEST['referrer'] ?>"> 
<input type="hidden" name="Activate" id="Activate" >
<input type="hidden" name="PostURL" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
<div align="center"><font face="Verdana, Arial, Helvetica, sans-serif;" color="#FF0000"><strong><?php if(isset($_GET['msg'])) echo "Kindly give Valid Details"; ?></strong></font></div>

<div class="form-bg"><span class="form-text">Full Name</span> <input name="Name" type="text" <? if(isset($loan_type)) { ?>value="<? echo $name; ?>" <? }else {?>value="Name"<? }?> id="Name" style="margin-left:60px; width:140px; margin-top:2px;" onBlur="onBlurDefault(this,'Name');"  onFocus="onFocusBlank(this,'Name');" onchange="insertData();"/></div>

	<div class="form-bg"><span class="form-text">DOB </span> <input name="day" type="text" id="day" value="dd" style="margin-left:97px; width:40px; margin-top:2px;" onBlur="onBlurDefault(this,'dd');"  onFocus="onFocusBlank(this,'dd');" maxlength="2" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);"/> <input name="month" id="month" type="text" value="mm"  style="width:40px; margin-top:2px;" onBlur="onBlurDefault(this,'mm');"  onFocus="onFocusBlank(this,'mm');" maxlength="2" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);"/> <input name="year" id="year" type="text" value="yyyy"   style="width:47px; margin-top:2px;" onBlur="onBlurDefault(this,'yyyy');"  onFocus="onFocusBlank(this,'yyyy');" maxlength="4" onChange="intOnly(this); insertData();" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);"/></div>

	<div class="form-bg"><span class="form-text">Mobile No.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;+91</span>
	  <input name="Phone" id="Phone" type="text"  <? if(isset($loan_type)) { ?>value="<? echo $mobile; ?>" <? }else {?>value="Mobile No" <? }?>style="width:110px; margin-top:2px;" onblur="onBlurDefault(this,'Mobile No');"  maxlength="10" onfocus="onFocusBlank(this,'Mobile No');" onkeyup="intOnly(this);" onkeypress="intOnly(this);" onChange="insertData();"/>
	</div>

	<div class="form-bg"><span class="form-text">Email Id</span>
	  <input name="Email" id="Email" type="text" <? if(isset($loan_type)) { ?>value="<? echo $Email; ?>" <? }else { ?>value="Email Id"<? } ?> style="margin-left:72px; width:140px; margin-top:2px;"  onblur="onBlurDefault(this,'Email Id');" onchange="insertData();" onfocus="onFocusBlank(this,'Email Id');"/>
	</div>

	<div class="form-bg" style="vertical-align:top;">
	 <div style="width:319px;display:block; height:22px; margin:0px; padding-bottom:12px;"><span class="form-text">City</span> <select style="width:142px; margin-left:100px; height:18px; margin-top:2px; "  name="City" id="City" onchange="othercity1(this); tataaig_comp(); insertData(); "  >
        <?=getCityList($City)?>
      </select></div>
</div>
	<div class="form-bg"><span class="form-text">Other City</span> <input name="City_Other" id="City_Other" type="text" value="Other City" style="margin-left:58px; width:140px; margin-top:2px;" onblur="onBlurDefault(this,'Other City');"  onfocus="onFocusBlank(this,'Other City');" disabled  /></div>

	<div class="form-bg"><span class="form-text">Pincode</span> <input name="Pincode" id="Pincode" type="text" value="Pincode" MAXLENGTH="6" style="margin-left:74px; width:140px; margin-top:2px;"  onBlur="onBlurDefault(this,'Pincode');"  onFocus="onFocusBlank(this,'Pincode');" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" /></div>

	<div class="form-bg"><span class="form-text">Employment Status</span>
	  <select   style="width:140px; margin-left:0px; margin-top:2px; height:18px; "  name="Employment_Status" id="Employment_Status" onchange="netsalarytab();">
        <option selected value="-1">Employment Status</option>
        <option  value="1">Salaried</option>
        <option value="0">Self Employed</option>
      </select>
	</div>

	<div class="form-bg"><span class="form-text">Company Name</span> <input name="Company_Name" id="Company_Name" type="text" value="Company Name" style="margin-left:22px; width:140px; margin-top:2px;"  onBlur="onBlurDefault(this,'Company Name');"  onFocus="onFocusBlank(this,'Company Name');" /></div>


	<div class="form-bg"><div name="nettab" id="nettab" style="  float:left; padding-left:16px; line-height:20px;">Annual Income
	  <input name="IncomeAmount" id="IncomeAmount" type="text" value="Annual Income" style="margin-left:27px; width:140px; margin-top:2px;" onFocus="this.select();"  onChange="intOnly(this); addDiv();"  onKeyUp="intOnly(this);PlgetDigitToWords('IncomeAmount','formatedIncome','wordIncome'); addDiv();" onKeyPress="intOnly(this); PlgetDigitToWords('IncomeAmount','formatedIncome','wordIncome');" onBlur="PlgetDigitToWords('IncomeAmount','formatedIncome','wordIncome'); "/></div></div>
	<span id='formatedIncome' style='font-size:11px; font-weight:bold;color:666699;font-Family:Verdana; margin-left:10px; '></span>
	<span id='wordIncome' style='font-size:11px;font-weight:bold;color:666699;font-Family:Verdana;text-transform: capitalize;   margin-left:10px; margin-bottom:5px;'></span>

	<div class="form-bg"><span class="form-text">Loan Amount</span> <input name="Loan_Amount" id="Loan_Amount" type="text" value="Loan Amount" style="margin-left:40px; width:140px; margin-top:2px;" onFocus="this.select(); onBlurDefault(this,'Loan Amount');" onChange="intOnly(this);"  onKeyUp="intOnly(this);PlgetDigitToWords('Loan_Amount','formatedlA','wordloanAmount');"  onKeyDown="PlgetDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" onKeyPress="intOnly(this); PlgetDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" onBlur="PlgetDigitToWords('Loan_Amount','formatedlA','wordloanAmount'); onBlurDefault(this,'Loan Amount'); onBlurDefault(this,'Loan Amount');"></div> <span id='formatedlA' style='font-size:11px; font-weight:bold;color:666699;font-Family:Verdana;  margin-left:10px; '></span><span id='wordloanAmount' style='font-size:11px;
font-weight:bold;color:666699;font-Family:Verdana;text-transform: capitalize; margin-left:10px; margin-bottom:5px;'></span>
	
	
	<div  class="form-bg"><span class="form-text">
	Are you a Credit card holder? </span>
<input type="radio"  name="CC_Holder" id="CC_Holder" value="1"  style="border:none;" onclick="addElement();" >
Yes
<input type="radio"  name="CC_Holder" id="CC_Holder" style="border:none;" value="0" onClick="removeElement();">
No	</div>
<div  id="myDiv"></div>
 <div style="margin-left:15px; margin-bottom:8px;" id="tataaig_compaign" ></div>
<div style="margin-left:15px; margin-bottom:8px;"><input type="checkbox" class="style4" name="accept" style="border:none;"  > I have read the <a href="http://www.deal4loans.com/Privacy.php" target="_blank">Privacy Policy</a> and agree to the Terms And Condition.</div>
<div align="center"><input type="image" name="Submit"  src="images/pl/prsnl-sbtn.gif"  style="width:119px; height:34px; border:none; " /></div>
<div id="form-bt-lft">&nbsp;</div>
<div id="form-bt-rgt">&nbsp;</div>
</div>

</form>


</div>
<div id="mynewDiv" ></div>

<div id="prsnl-bot" ></div>

<div><?php include 'footer_landingpage.php'; ?></div>


</div>
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
