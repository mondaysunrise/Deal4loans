<?php
	require 'scripts/session_check.php';
	require 'scripts/functions.php';
	?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<title>Personal Loan</title>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script src='scripts/pldigittowordconverter.js' type='text/javascript' language='javascript'></script>
<script type="text/javascript" src="ajax.js"></script>
<script type="text/javascript" src="ajax-dynamic-pllist.js"></script>
 <style type="text/css">
 @import url(http://fonts.googleapis.com/css?family=Droid+Sans);
body{font-family:'Droid Sans', sans-serif;
	margin:0px;
	padding:0px;
	font-size:14px;
	line-height:16px;
	color:#292323;

}

input{margin:0px; width:97%;
	padding:0px; height:28px;
	border:1px solid #ccc;
}

select{
	margin:0px;
	padding:0px; height:31px;
	border:1px solid #ccc; width:98%;

}

.bldtxt{
font-weight:bold;
line-height:16px;
color:#4f4d4d;
}


.txt ul{
	margin:0px 0px 0px 2px;
	padding:0px 0px 0px 2px;
}

.button-wrapper{ float:left; width:91px;}
.button-new{ background:#0e86b3; padding:10px; color:#FFF; text-align:center; font-size:14px; height:40px; outline:none; border-radius:5px;}
.txt ul li{
	background: url(images/cl/arrow.gif) no-repeat 0px 4px;
	list-style-type:none;
	color:#292323;
	padding-left:15px; 
	padding-right:0; 
	padding-top:0; 
	padding-bottom:4px 
}
/* START CSS NEEDED ONLY IN DEMO */
	
	#mainContainer{
		width:660px;
		margin:0 auto;
		text-align:left;
		height:100%;		
		border-left:3px double #000;
		border-right:3px double #000;
	}
	#formContent{
		padding:5px;
	}
	/* END CSS ONLY NEEDED IN DEMO */
	
	
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
	
form{display:inline;}
.wrapper{ width:990px; margin:90px auto;}
.formwrapper{ width:980px; margin:auto; background:#f7f7f7; padding:15px; border:thin solid #e4e4e4; border-radius:5px;}
h1{color:#0E79B9; font-size: 24px; font-weight:normal; margin:0px 0px 15px 0px;}
.header-menu-new {
    width: 100%;
    background: #0c4669;
    position: fixed;
    top: 0!important;
    z-index: 9999;
}
.menu-main-wrapper { padding-top:5px; padding-bottom:5px;
    width: 1000px; 
    margin:auto;
}
.input-wrapper{ float:left; width:319px;}
.input-wrapper2{ float:left; width:400px;}
.inputbox-margin{ margin-left:10px;}
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
		
//			if(document.personalloan_form.IncomeAmount.value=="on")
	//		{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '<div id="expanddiv" class="addexpandeddiv" ></div>';
				

		//	}
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
				ni.innerHTML = '<div  class="form-bg"><span class="form-text"><b>Card held since?</b></span><select class="style4" size="1" name="Card_Vintage"><option value="0">Please select</option> <option value="1">Less than 6 months</option>		 <option value="2">6 to 9 months</option> <option value="3">9 to 12 months</option>				<option value="4">more than 12 months</option> </select></div>';
				

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



function tataaig_comp()
{
	//alert("hello");
	var ni = document.getElementById('tataaig_compaign');
		
		if(ni.innerHTML=="")
		{
			if(document.personalloan_form.City.value=="Delhi" || document.personalloan_form.City.value=='Delhi' || document.personalloan_form.City.value=='Noida'  ||  document.personalloan_form.City.value=='Gurgaon'  ||  document.personalloan_form.City.value=='Faridabad'  ||  document.personalloan_form.City.value=='Gaziabad'  ||  document.personalloan_form.City.value=='Faridabad'  ||  document.personalloan_form.City.value=='Greater Noida'  || document.personalloan_form.City.value=='Chennai'  ||  document.personalloan_form.City.value=='Mumbai'  ||  document.personalloan_form.City.value=='Thane'  ||  document.personalloan_form.City.value=='Navi Mumbai'  ||  document.personalloan_form.City.value=='Kolkata'  ||  document.personalloan_form.City.value=='Kolkota'  ||  document.personalloan_form.City.value=='Hyderabad'  ||  document.personalloan_form.City.value=='Pune'  || document.personalloan_form.City.value=='Bangalore')
			{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '<input type="checkbox" style="border:none;" name="Accidental_Insurance" id="Accidental_Insurance" value="1" checked>&nbsp;<a onclick="open_win()" style="cursor:pointer; " ><u> Get free personal accident insurance from TATA AIG</u></a>';
			}
			else 
			{
			//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '';
			}
			
		}
		else if(ni.innerHTML!="")
		{
			if(document.personalloan_form.City.value=="Delhi" || document.personalloan_form.City.value=='Delhi' || document.personalloan_form.City.value=='Noida'  ||  document.personalloan_form.City.value=='Gurgaon'  ||  document.personalloan_form.City.value=='Faridabad'  ||  document.personalloan_form.City.value=='Gaziabad'  ||  document.personalloan_form.City.value=='Faridabad'  ||  document.personalloan_form.City.value=='Greater Noida'  || document.personalloan_form.City.value=='Chennai'  ||  document.personalloan_form.City.value=='Mumbai'  ||  document.personalloan_form.City.value=='Thane'  ||  document.personalloan_form.City.value=='Navi Mumbai'  ||  document.personalloan_form.City.value=='Kolkata'  ||  document.personalloan_form.City.value=='Kolkota'  ||  document.personalloan_form.City.value=='Hyderabad'  ||  document.personalloan_form.City.value=='Pune'  || document.personalloan_form.City.value=='Bangalore')
			{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '<input type="checkbox" style="border:none;" name="Accidental_Insurance" id="Accidental_Insurance" value="1" checked>&nbsp;<a onclick="open_win()" style="cursor:pointer;" ><u> Get free personal accident insurance from TATA AIG</u></a>';
			}
			else 
			{
			//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '';
			}
			
		}
		return true;
}

function open_win()
   {
   window.open("tata-aig-personal-accident-cover.html",'welcome','width=500,height=500,menubar=no,status=no,location=no,toolbar=no,scrollbars=yes');
   }

function open_win_privacy()
   {
   window.open("Privacy.html",'welcome','width=500,height=500,menubar=no,status=no,location=no,toolbar=no,scrollbars=yes');
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
<div class="header-menu-new">
<div class="menu-main-wrapper">
<img src="/images/dea4lonasnew-logo 1111.png" border="0" width="123" height="50" alt="logo">
</div>
</div>
<div class="wrapper">
<h1>Personal Loan Request</h1>

<div class="formwrapper">

<form name="personalloan_form"  action="personal-loan-chatapp-continue.php" method="POST" onSubmit="return chkpersonalloan(document.personalloan_form);">
<input type="hidden" name="biddt" value="<?php echo $_GET['biddt']; ?>"> 
<input type="hidden" name="source" value="mywishbankchat"> 
<input type="hidden" name="Activate" id="Activate" >
<input type="hidden" name="PostURL" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
<div align="center"><font face="Verdana, Arial, Helvetica, sans-serif;" color="#FF0000"><strong><?php if(isset($_GET['msg'])) echo "Kindly give Valid Details"; ?></strong></font></div>
<div class="input-wrapper">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="35%">Full Name</td>
      <td width="65%"><input name="Name" type="text" <? if(isset($loan_type)) { ?>value="<? echo $name; ?>" <? }else {?>value=""<? }?> id="Name" onBlur="onBlurDefault(this,'Name');"  onFocus="onFocusBlank(this,'Name');" onchange="insertData();"/></td>
    </tr>
  </table>
</div>
<div class="input-wrapper inputbox-margin"><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="33%">DOB</td>
    <td width="67%"><input name="day" type="text" id="day" value="dd" style="width:30%; " onBlur="onBlurDefault(this,'dd');"  onFocus="onFocusBlank(this,'dd');" maxlength="2" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);"/> <input name="month" id="month" type="text" value="mm"  style="width:30%; " onBlur="onBlurDefault(this,'mm');"  onFocus="onFocusBlank(this,'mm');" maxlength="2" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);"/> <input name="year" id="year" type="text" value="yyyy"   style="width:30%; " onBlur="onBlurDefault(this,'yyyy');"  onFocus="onFocusBlank(this,'yyyy');" maxlength="4" onChange="intOnly(this); insertData();" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);"/></td>
  </tr>
</table>
</div>
<div class="input-wrapper inputbox-margin">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="30%">Mobile No.</td>
      <td width="70%">+91 <input name="Phone" id="Phone" type="text"  <? if(isset($loan_type)) { ?>value="<? echo $mobile; ?>" <? }else {?>value="" <? }?>style="width:188px; " onChange="intOnly(this); tosendsms(); insertData();" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" onFocus="addtooltip();" maxlength="10"  /></td>
    </tr>
  </table>
</div>
<div style="clear:both; height:18px;"></div>
<div class="input-wrapper">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="35%">E-mail Id</td>
      <td width="65%"><input name="Email" id="Email" type="text" <? if(isset($loan_type)) { ?>value="<? echo $Email; ?>" <? }else { ?>value=""<? } ?>  onblur="onBlurDefault(this,'Email Id');" onFocus="removetooltip();"  onChange="insertData();"/></td>
    </tr>
  </table>
</div>
<div class="input-wrapper inputbox-margin">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="33%">City</td>
      <td width="67%"><select name="City" id="City" onchange="tataaig_comp(); insertData(); "  >
        <?=plgetCityList($City)?>
      </select></td>
    </tr>
  </table>
</div>
<div class="input-wrapper inputbox-margin">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="31%">Occupation</td>
      <td width="69%"><select name="Employment_Status" id="Employment_Status" >
        <option selected value="-1">Employment Status</option>
        <option  value="1">Salaried</option>
        <option value="0">Self Employed</option>
      </select></td>
    </tr>
  </table>
</div>
<div style="clear:both; height:18px;"></div>
<div class="input-wrapper">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="35%">Company Name </td>
      <td width="65%"><input name="Company_Name" id="Company_Name" type="text" onBlur="onBlurDefault(this,'Company Name');"  onFocus="onFocusBlank(this,'Company Name');"  onKeyUp="ajax_showOptions(this,'getCountriesByLetters',event)" /></td>
    </tr>
  </table>
</div>
<div class="input-wrapper inputbox-margin">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="33%">Annual Income </td>
      <td width="67%"><input name="IncomeAmount" id="IncomeAmount" type="text" onFocus="this.select();"  onChange="intOnly(this); addDiv();"  onKeyUp="intOnly(this);PlgetDigitToWords('IncomeAmount','formatedIncome','wordIncome'); addDiv();" onKeyPress="intOnly(this); PlgetDigitToWords('IncomeAmount','formatedIncome','wordIncome');" onBlur="PlgetDigitToWords('IncomeAmount','formatedIncome','wordIncome'); "/></td>
    </tr>
  </table>
  <div style="padding-top:4px;">	<span id='formatedIncome' style='font-size:11px; font-weight:bold;color:666699;font-Family:Verdana;'></span>
	<span id='wordIncome' style='font-size:11px;font-weight:bold;color:666699;font-Family:Verdana;text-transform: capitalize;   margin-left:10px; margin-bottom:5px;'></span></div>
</div>
<div class="input-wrapper inputbox-margin">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="32%">Loan Amount</td>
      <td width="68%"><input name="Loan_Amount" id="Loan_Amount" type="text" onFocus="this.select(); onBlurDefault(this,'Loan Amount');" onChange="intOnly(this);"  onKeyUp="intOnly(this);PlgetDigitToWords('Loan_Amount','formatedlA','wordloanAmount');"  onKeyDown="PlgetDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" onKeyPress="intOnly(this); PlgetDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" onBlur="PlgetDigitToWords('Loan_Amount','formatedlA','wordloanAmount'); onBlurDefault(this,'Loan Amount'); onBlurDefault(this,'Loan Amount');"></td>
    </tr>
  </table>
  <div style="padding-top:4px;">	<span id='formatedlA' style='font-size:11px; font-weight:bold;color:666699;font-Family:Verdana; '></span><span id='wordloanAmount' style='font-size:11px;
font-weight:bold;color:666699;font-Family:Verdana;text-transform: capitalize; margin-left:10px; margin-bottom:5px;'></span></div>
</div>
<div style="clear:both; height:18px;"></div>
<div class="input-wrapper" style="margin-top:15px;">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="60%">Are you a Credit card holder?</td>
      <td width="40%"><input type="radio"  name="CC_Holder" id="CC_Holder" value="1"  style="border:none; width:15px; height:15px;" onclick="addElement();" >
Yes
<input type="radio"  name="CC_Holder" id="CC_Holder"  style="border:none; width:15px; height:15px;" value="0" onClick="removeElement();">
No</td>
    </tr>
</table>
</div>
<div class="input-wrapper">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td><div  id="myDiv"></div></td>
</tr>
</table>
</div>
<div class="button-wrapper"><input type="button" name="Submit" class="button-new" value="Submit"/></div>
<div style="clear:both; height:18px;"></div>
</form>
</div>
</div>
</body>
</html>