<?php
	require 'scripts/session_check.php';
     //require 'scripts/db_init.php';
	require 'scripts/functions.php';
	//session_start();
	 $page_name = "Home Loan";

	 $name = $_SESSION['Temp_Name'] ;
	$mobile = $_SESSION['Temp_mobile'] ;
	$Email=	$_SESSION['Temp_email'] ;
	$loan_type = $_SESSION['Temp_loan_type'] ;
	$last_id = $_SESSION['Temp_Last_Inserted'] ;
	?>
	
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Home Loans India Apply Compare | Housing Mortage Loan</title>
<meta name="keywords" content="Home loans India, Apply Home Loans, Compare Home Loans in Mumbai Hyderabad Pune kolkata Delhi Noida Bangalore">
 <script type="text/javascript" src="js/dropdowntabs.js"></script>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/easySlider1.5.js"></script>
<script type="text/javascript">
		$(document).ready(function(){	
			$("#slider").easySlider({
				controlsBefore:	'<p id="controls">',
				controlsAfter:	'</p>',
				auto: false, 
				continuous: true
				
			});
			$("#slider2").easySlider({
				controlsBefore:	'<p id="controls2">',
				controlsAfter:	'</p>',		
				prevId: 'prevBtn2',
				nextId: 'nextBtn2',
				auto: true, 
				continuous: true	
			});		
		});	
	</script>
<style  >
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
.orgtext{
	color:#d75b10;
	line-height:16px;
	font-weight:bold;
	font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:10px;
}

.nrmltxt{
	line-height:16px;
	color:#5e5e5e;
	font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:11px;
}

.nrmltxt span{
	font-weight:bold;
	color:#a9643a;
	font-size:12px;

}

.bldtxt{
	font-weight:bold;
	line-height:16px;
	color:#5e5e5e;
	font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:11px;
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
	
form{
	display:inline;
	}
 
#slider{
	width:590px;
	margin:0 0 0 50px;
 }	

#slider ul, #slider li{
	margin:0;
	padding:0;
	list-style:none;
}

#slider li{ 
	/* 
	define width and height of list item (slide)
	entire slider area will adjust according to the parameters provided here
	*/ 
	width:590px;
	height:65px;
	overflow:hidden; 
}
		
	
#slider li div{
	display:block;
	float:left;
	width:143px;
 }

p#controls{
	margin:-76px 0 0 15;
	position:relative;
	width:650px;
} 
	
		
#prevBtn, #nextBtn{ 
	display:block;
	overflow:hidden;
	text-indent:-8000px;		
	width:36px;
	height:80px;
	position:absolute;
}	

#nextBtn{ 
	left:605px;
}														
#prevBtn a, #nextBtn a{  
	display:block;
	width:36px;
	height:84px;
	background: url(new-images/hl/slider/prv-btn.jpg) no-repeat left center;
 
}	

#nextBtn a{ 
	background: url(new-images/hl/slider/nxt-btn.jpg) no-repeat left center;
}												
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


function submitform(Form)
{
	var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
	var dt,mdate;dt=new Date();
	
	var alpha=/^[a-zA-Z\ ]*$/;
	var alphanum=/^[a-zA-Z0-9]*$/;
	var num=/^[0-9]*$/;
	var space=/^[\ ]*$/;
	var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";
	
	
		var btnvalidate;
		var cnt=-1;
		var i;
		var btn;
		
		
	if((Form.Name.value=="") || (Form.Name.value=="Full Name")|| (Trim(Form.Name.value))==false)
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

	if((Form.IncomeAmount.value=='')||(Form.IncomeAmount.value=="Annual Income"))
	{
		alert("Please enter Annual income to Continue");
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
	
		if((space.test(Form.day.value)) || (Form.day.value=="dd"))
	{
	alert("Kindly enter your Date of Birth");
	Form.day.select();
	return false;
	}
	
	else if(!num.test(Form.day.value))
	{
	alert("Kindly enter your Date of Birth(numbers Only)");
	Form.day.focus();
	return false;
	}
	
	else if((Form.day.value<1) || (Form.day.value>31))
	{
	alert("Kindly Enter your valid Date of Birth(Range 1-31)");
	Form.day.focus();
	return false;
	}
	
	else if((space.test(Form.month.value)) || (Form.month.value=="mm"))
	{
	alert("Kindly enter your Month of Birth");
	Form.month.focus();
	return false;
	}
	
	else if(!num.test(Form.month.value))
	{
	alert("Kindly enter your Month of Birth(numbers Only)");
	Form.month.focus();
	return false;
	}
	
	else if((Form.month.value<1) || (Form.month.value>12))
	{
	alert("Kindly Enter your valid Month of Birth(Range 1-12)");
	Form.month.focus();
	return false;
	}
	
	else if((Form.month.value==2) && (Form.day.value>29))
	{
	alert("Month February cannot have more than 29 days");
	Form.day.focus();
	return false;
	}
	
	else if((space.test(Form.year.value)) || (Form.year.value=="yyyy"))
	{
	alert("Kindly enter your Year of Birth");
	Form.year.focus();
	return false;
	}
	
	else if(!num.test(Form.year.value))
	{
	alert("Kindly enter your Year of Birth(numbers Only) !");
	Form.year.focus();
	return false;
	}
	
	else if((Form.day.value > 28) && (parseInt(Form.month.value)==2) && ((Form.year.value%4) != 0))
	{
	alert("February cannot have more than 28 days.");
	Form.day.focus();
	return false;
	}
	
	else if(Form.year.value.length != 4)
	{
	alert("Kindly enter your correct 4 digit Year of Birth.(Numeric ONLY)!");
	Form.year.focus();
	return false;
	}
	else if((Form.year.value < "1945") || (Form.year.value >"1989"))
	{
	alert("Age Criteria! \n Applicants between age group 18 - 62 only are elgibile.");
	Form.year.focus();
	return false;
	}
	else if(Form.year.value > parseInt(mdate-21) || Form.year.value < parseInt(mdate-62))
	{
	alert("Age Criteria! \n Applicants between age group 21 - 62 only are elgibile.");
	Form.year.focus();
	return false;
	}
	
	else if((parseInt(Form.day.value)==31) && ((parseInt(Form.month.value)==4)||(parseInt(Form.month.value)==6)||(parseInt(Form.month.value)==9)||(parseInt(Form.month.value)==11)||(parseInt(Form.month.value)==2)))
	{
	alert("Cannot have 31st Day");Form.day.select();
	return false;
	}

	 if(Form.Employment_Status.selectedIndex==0)
	{
		alert("Please select Emplyment Status ");
		Form.Employment_Status.focus();
		return false;
	}
	
	for(i=0; i<Form.Property_Identified.length; i++) 
	{
        if(Form.Property_Identified[i].checked)
		{
   	 		cnt= i;
		}
	}
	if(cnt == -1) 
	{
		alert("please select you have identified any property or not");
		return false;
	}
	if(cnt ==0)
	{ 
		if(Form.Property_Loc.selectedIndex==0)
		{
			alert("Plese select city where property is located");
			Form.Property_Loc.focus();
			return false;
		}
	}
	
	if(!Form.accept.checked)
	{
	alert("Accept the Terms and Condition");
	Form.accept.focus();
	return false;
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
	if(document.home_loan.City.value=='Others')
	{
		document.home_loan.City_Other.disabled=false;
		document.home_loan.City_Other.focus();
	}
	else
	{
		document.home_loan.City_Other.disabled=true;
		document.home_loan.City_Other.focus();
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

function addIdentified()
{
		var ni = document.getElementById('myDiv1');
		var ni1 = document.getElementById('myDiv2');
		
		if(ni.innerHTML=="")
		{
		
			if(document.home_loan.Property_Identified.value="on")
			{
				ni1.innerHTML = '';
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '<table border="0" cellspacing="0" cellpadding="0" align="left"><tr><td align="left" valign="middle" class="nrmltxt"  style="color:#4b4b4b;" width="120">Property Location</td><td colspan="3" align="left" ><select style="width:140px;" name="Property_Loc" id="Property_Loc"><?=getCityList1($City)?></select></td></tr></table>';
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
		
			if(document.home_loan.Property_Identified.value="on")
			{
				ni.innerHTML = '';
				ni1.innerHTML = '<table border="0" cellspacing="0" cellpadding="0" align="left"><tr><td height="20" colspan="2" align="left" valign="center" class="nrmltxt"><input type="checkbox" name="updateProperty" style="border:none; color:#4b4b4b;"> Can we tell you about some properties</td></tr></table>';
			}
		}
		
		return true;

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
			ni.innerHTML = 'Please give correct Mobile Number to Activate your Loan Request';
		}
		return true;
	}



function removetooltip()
{
		var ni = document.getElementById('myDiv');
		
		if(ni.innerHTML!="")
		{
			ni.innerHTML = '';
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
			var get_product ="2";

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

<body onbeforeunload="HandleOnClose('closedby_hl.php')">
<table width="100%" cellpadding="0" cellspacing="0" >
<tr><td align="center">
<table width="1004" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="161" height="169" align="left" valign="top"><img src="new-images/hl/hdr1.gif" width="161" height="169" /></td>
            <td width="158" height="169" align="left" valign="top"><img src="new-images/hl/hdr2.gif" width="158" height="169" /></td>
            <td width="177" height="169" align="left" valign="top"><img src="new-images/hl/hdr3.gif" width="177" height="169" /></td>
            <td width="186" height="169" align="left" valign="top"><img src="new-images/hl/hdr4.gif" width="186" height="169" /></td>
          </tr>
          <tr>
            <td height="167" align="left" valign="top"><img src="new-images/hl/hdr5.gif" width="161" height="167" /></td>
            <td height="167" align="left" valign="top"><img src="new-images/hl/hdr6.gif" width="158" height="167" /></td>
            <td height="167" align="left" valign="top"><img src="new-images/hl/hdr7.gif" width="177" height="167" /></td>
            <td height="167" align="left" valign="top"><img src="new-images/hl/hdr8.gif" width="186" height="167" /></td>
          </tr>
          <tr>
            <td colspan="4"><table width="99%"  border="0"   cellpadding="0" cellspacing="0">
              <tr>
                <td >&nbsp;</td>
              </tr>
               <tr>
                <td  valign="top" style="background-repeat:no-repeat; ">
                <?php include "tophlbanks.php"; ?>
                </td>
              </tr>
              <tr>
                <td width="674" class="bldtxt" style="font-size:17px; font-family:Arial, Helvetica, sans-serif; " >&nbsp;</td>
              </tr>
                <tr>
                <td height="25"  style=" padding-left:10px; " ><img src="new-images/hl/why-d4l.gif" width="173" height="21"></td>
              </tr>
              <tr>
                <td height="25"  style="padding-left:15px; " ><table width="550" border="0" cellspacing="0" cellpadding="0" style="border:2px solid #def3f8; ">
                  <tr>
                    <td ><table width="98%"  border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="35" height="35" align="center" valign="middle"><img src="new-images/pl/arrow.gif" width="20" height="22" /></td>
                        <td><div style="color:#5e5e5e; font-size:13px; font-weight:bold; background-color:#f6fcfd; line-height:24px;  ">Over 6 lakh customers have taken quote at Deal4loans.com</div></td>
                      </tr>
                      <tr>
                        <td width="35" height="35" align="center" valign="middle"><img src="new-images/pl/arrow.gif" width="20" height="22" /></td>
                        <td><div style="color:#5e5e5e; font-size:13px; font-weight:bold; background-color:#f6fcfd; line-height:24px;  ">Ndtv Chooses Deal4loans.com to empower its Loans Section.</div></td>
                      </tr>
                      <tr>
                        <td width="35" height="35" align="center" valign="middle"><img src="new-images/pl/arrow.gif" width="20" height="22" /></td>
                        <td><div style="color:#5e5e5e; font-size:13px; font-weight:bold; background-color:#f6fcfd; line-height:24px;  ">Home Loan Quotes are free for customers.</div></td>
                      </tr>
                      <tr>
                        <td width="35" height="35" align="center" valign="middle"><img src="new-images/pl/arrow.gif" width="20" height="22" /></td>
                        <td><div style="color:#5e5e5e; font-size:13px; font-weight:bold; background-color:#f6fcfd; line-height:24px;  ">Deal4loans.com has tie ups with all Home loan Banks in India.</div></td>
                      </tr>
                    </table></td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td   >&nbsp;</td>
              </tr>
              <tr>
                <td height="25"  style=" padding-left:10px; " ><img src="new-images/hl/hlpful.gif" width="356" height="20"></td>
              </tr>
              <tr>
                <td class="nrmltxt" style=" padding-left:10px; ">Home loans are provided based on the market value, mainly estimation given by banks or the registration value of the property. Home loan is not a one-time decision; do review the market periodically before availing them. Customers tend to make mistakes while entering into deals, which may not be beneficial for them, so better compare all the variables before signing a loan agreement by different banks. The various parameters that you need to compare on Home loan are
                  <br>
                  <br>
                  <b>&raquo; Eligibility <br>
&raquo; Interest rates best suited. <br>
&raquo; Fixed interest loans or Floating. <br>
&raquo; Other costs. <br>
&raquo; Document required. <br>
&raquo; Penalties.</b></td>
              </tr>
            </table></td>
            </tr>
        </table></td>
        <td width="322" valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="289" height="88" align="left" valign="top"><img src="new-images/hl/frm-hdng.gif" width="289" height="88" /></td>
              </tr>
              <tr>
                <td valign="top" style="border-left:1px solid #c2c2c2; border-right:1px solid #c2c2c2; padding-top:15px;">
				<form name="home_loan" action="get-home-loan-thanks.php" onSubmit="return submitform(document.home_loan);" method="post">
                            <table width="93%" border="0" align="right" cellpadding="0" cellspacing="0">
                              <tr>
                                <td width="116" height="26" align="left" valign="middle" class="bldtxt">First Name</td>
                                <td width="166" class="bldtxt">
								<INPUT TYPE="hidden" NAME="onCloseValue" id="onCloseValue" value="1">
								<input type="text" name="Name" id="Name" value="<? if(isset($loan_type)) {  echo $name;  }?>"  style="width:140px;"/></td>
                              </tr>
                              <tr>
                                <td width="116" height="26" align="left" valign="middle" class="bldtxt">Mobile</td>
                                <td class="bldtxt"><font class="style4">+91</font>
                                    <input type="text"  style="width:113px;" maxlength="10"  name="Phone" id="Phone"  value="<? if(isset($loan_type)) echo $mobile; ?>"  onChange="intOnly(this); tosendsms(); insertData();" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" onFocus="addtooltip();">
                                </td>
                              </tr>
                             <tr>
		  <td colspan="2"><div id="myDiv" style="color:#7d0606; font-family:Verdana; font-size:11px;"></div></td>
		  </tr>
                              <tr>
                                <td height="26" align="left" valign="middle" class="bldtxt">Email</td>
                                <td class="bldtxt"><input class="style4" style="width:140px;" value="<? if(isset($loan_type)) echo $Email; else "Email Id" ?>" name="Email" id="Email" onBlur="onBlurDefault(this,'Email Id');"  onFocus="removetooltip();"  onChange="insertData();">                                </td>
                              </tr>
                              <tr>
                                <td height="26" align="left" valign="middle" class="bldtxt">City</td>
                                <td class="bldtxt"><select size="1" align="left" style="width:140"  name="City" id="City" onChange="othercity1(this); insertData(); " />
                                
                                    <?=getCityList1($City)?>
                                    </select></td>
                              </tr>
                              <tr>
                                <td height="26" align="left" valign="middle" class="bldtxt">Other City </td>
                                <td class="bldtxt"><input disabled value="Other City"  onfocus="this.select();" name="City_Other" id="City_Other" style="width: 140px;"  onBlur="onBlurDefault(this,'Other City');">                                </td>
                              </tr>
                              <tr>
                                <td width="116" height="26" align="left" valign="middle" class="bldtxt">Annual Income</td>
                                <td class="bldtxt"><input   name="IncomeAmount" id="IncomeAmount" onFocus="this.select();" onChange="intOnly(this);"  onKeyUp="intOnly(this); getDigitToWords('IncomeAmount','formatedIncome','wordIncome');" onKeyPress="intOnly(this); getDigitToWords('IncomeAmount','formatedIncome','wordIncome');" style="width:140px;" onBlur="getDigitToWords('IncomeAmount', 'formatedIncome', 'wordIncome'); onBlurDefault(this,'Annual Income');">                                </td>
                              </tr>
                              <tr>
                                <td width="166" align="left" valign="middle" class="bldtxt" colspan="2"><span id='formatedIncome' style='font-family: Verdana, Arial, Helvetica, sans-serif;	font-size:11px;	color:#3A0D04; text-decoration:none; font-weight:bold; text-align:left;'></span><span id='wordIncome' style='font-family: Verdana, Arial, Helvetica, sans-serif;	font-size:11px;	color:#3A0D04; text-decoration:none; font-weight:bold; text-align:left;'></span> </td>
                              </tr>
                              <tr>
                                <td height="26" align="left" valign="middle" class="bldtxt">Loan Amount </td>
                                <td class="bldtxt"><input   name="Loan_Amount"  id="Loan_Amount" onFocus="this.select();" onChange="intOnly(this);"  onKeyUp="intOnly(this); getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" onKeyPress="intOnly(this); getDigitToWords('Loan_Amount', 'formatedlA','wordloanAmount');" style="width:140px;" onKeyDown="getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" onBlur="getDigitToWords('Loan_Amount', 'formatedlA', 'wordloanAmount'); onBlurDefault(this,'Loan Amount');">
                                    <input type="hidden" name="referrer" value="<? echo $_REQUEST['referrer'] ?>">
                                    <input type="hidden" name="Type_Loan" value="Req_Loan_Home">
                                    <input type="hidden" name="creative" value="<? echo $_REQUEST['creative'] ?>">
                                    <input type="hidden" name="section" value="<? echo $_REQUEST['section'] ?>">
                                    <input type="hidden" name="source" value="admagnetLP">
                                    <input type="hidden" name="last_id" value="<? echo $last_id; ?>">
                                    <input type="hidden" name="PostURL" value="<?php echo $_SERVER['REQUEST_URI']; ?>">                                </td>
                              </tr>
                              <tr>
                                <td colspan="2" align="left" valign="middle" class="bldtxt"><span id='formatedlA' style='font-family: Verdana, Arial, Helvetica, sans-serif;	font-size:11px;	color:#3A0D04; text-decoration:none; font-weight:bold; text-align:left;'></span><span id='wordloanAmount' style='font-family: Verdana, Arial, Helvetica, sans-serif;	font-size:11px;	color:#3A0D04; text-decoration:none; font-weight:bold; text-align:left;'></span> </td>
                              </tr>
							  <tr>
                                <td width="120" height="26" align="left" valign="middle" class="nrmltxt" style="color:#4b4b4b;">Date of Birth </td>
                                <td width="156" class="nrmltxt">
								<input type="text" value="dd" name="day" id="day" maxlength="2" style="width:38px;"  onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" onBlur="onBlurDefault(this,'dd');"  onFocus="onFocusBlank(this,'dd');"/>&nbsp;<input type="text" name="month" id="month" maxlength="2" style="width:38px;"  onChange="intOnly(this);" value="mm"  onKeyUp="intOnly(this);" onKeyPress="intOnly(this)" onBlur="onBlurDefault(this,'mm');"  onFocus="onFocusBlank(this,'mm');" />&nbsp;<input type="text" maxlength="4" value="yyyy" name="year" id="year" style="width:54px;"  onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" onBlur="onBlurDefault(this,'yyyy');" onFocus="onFocusBlank(this,'yyyy');" /></td>
                              </tr>
							  <tr>
							     <td height="26" align="left" valign="middle" class="nrmltxt" style="color:#4b4b4b;">Occupation</td>
                                <td class="nrmltxt"><select style="width:140px;" name="Employment_Status" id="Employment_Status">
								<option selected value="-1">Employment Status</option>
								<option  value="1">Salaried</option>
								<option value="0">Self Employed</option>
                            </select></td>
                              </tr>
							 <tr>
                                <td width="120" height="26" align="left" valign="middle" class="nrmltxt" style="color:#4b4b4b;">Property Identified</td>
                                <td class="nrmltxt" style="color:#4b4b4b;"><input type="radio" name="Property_Identified" id="Property_Identified" value="1" onClick="addIdentified();" style="border:none;" /> Yes&nbsp;&nbsp;<input type="radio"  name="Property_Identified" id="Property_Identified" onClick="removeIdentified();" value="0" style="border:none;" /> No                                </td>
                              </tr>
					    <tr><td colspan="2" align="left" class="nrmltxt" id="myDiv1"></td></tr>
						<tr><td colspan="2" align="left" class="nrmltxt" id="myDiv2"></td></tr>
							   <tr>
                                <td height="26" align="left" valign="middle" class="nrmltxt" style="color:#4b4b4b;">Property Value</td>
                                <td class="nrmltxt"><input type="text" name="Property_Value" id="Property_Value" style="width:140px;" onKeyUp="intOnly(this); getDigitToWords('Property_Value','formatedPV','wordpropertyvalue');" onKeyPress="intOnly(this); getDigitToWords('Loan_Amount', 'formatedPV','wordloanAmount');"  onKeyDown="getDigitToWords('Property_Value','formatedPV','wordpropertyvalue');" onBlur="getDigitToWords('Property_Value', 'formatedPV', 'wordpropertyvalue'); onBlurDefault(this,'Loan Amount');"/></td>
                              </tr>
							    <tr>
                                <td height="55" align="left" valign="middle" class="nrmltxt" style="color:#4b4b4b;">Total EMIs you currently pay per month (if any)</td>
                                <td class="nrmltxt"><input type="text" name="obligations" id="obligations" style="width:140px;"    onkeyup="intOnly(this);" onKeyPress="intOnly(this);" />                                </td>
                              </tr>
							  <!--
							   <tr>
                                <td colspan="2" id="tataaig_compaign" class="nrmltxt" ></td></tr>
                              <tr>
                               -->  <td height="35" colspan="2" align="left" valign="middle" class="nrmltxt">
								<input type="hidden" name="Activate" id="Activate" >
								<input type="checkbox" name="accept" style="border:none;" checked> 
I have read the <a href="http://www.deal4loans.com/Privacy.php" target="_blank" style="text-decoration:none; ">Privacy Policy</a> and agree to the <a href="http://www.deal4loans.com/Privacy.php"  style="text-decoration:none; ">Terms And Condition</a>.</td>
                              </tr>
                              <tr>
                                <td height="54" colspan="2" align="center" valign="middle"><input type="image" name="Submit"  src="new-images/hl/pl-quote.gif"  style="width:117px; height:29px; border:none; " /></td>
                              </tr>
                          </table>
</form></td>
              </tr>
              <tr>
                <td valign="top"><img src="images/cl/frm-btm.gif" width="289"   height="21"></td>
              </tr>
              <tr>
                <td height="10" ></td>
              </tr>
              <tr>
                           <td valign="middle" height="120"><img src="new-images/hl/step-ban.gif" width="289" height="108" /></td>

              </tr>
            </table></td>
            <td width="33" height="336" align="right" valign="top"><img src="new-images/hl/frm-rgt.gif" width="33" height="336" /></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <Tr>
  <td>&nbsp;</td>
  </Tr>
</table>
</td>
  </Tr>
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
