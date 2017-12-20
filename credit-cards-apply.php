<?php
	require 'scripts/session_check.php';
	require 'scripts/functions.php';
	$maxage=date('Y')-62;
$minage=date('Y')-18;

if(isset($_REQUEST["source"]))
{
	$src=$_REQUEST["source"];
}
else
{
	$src="self";
}


?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">

<title>Credit Card</title>
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<link href="css/lp-styles-bnr.css" type="text/css" rel="stylesheet" />
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<script type="text/javascript" src="ajax.js"></script>
<script type="text/javascript" src="ajax-dynamic-cclist.js"></script>
 <style type="text/css">
.bldtxt{
font-weight:bold;
line-height:11px;
color:#4f4d4d;
font-family:verdana;
font-size:11px;
}
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
</style>
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

function validateDiv(div)
{
	var ni1 = document.getElementById(div);
	ni1.innerHTML = '';
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

if((Form.Full_Name.value=="") || (Trim(Form.Full_Name.value))==false)
{
document.getElementById('nameVal').innerHTML = "<span  class='hintanchor'>Please Enter Your name</span>";		
Form.Full_Name.focus();
return false;
}
else if(containsdigit(Form.Full_Name.value)==true)
{
document.getElementById('nameVal').innerHTML = "<span  class='hintanchor'>First Name contains numbers!</span>";
Form.Full_Name.focus();
return false;
}
  for (var i = 0; i < Form.Full_Name.value.length; i++) {
  	if (iChars.indexOf(Form.Full_Name.value.charAt(i)) != -1) {
  	document.getElementById('nameVal').innerHTML = "<span  class='hintanchor'>Contains special characters!</span>";
	Form.Full_Name.focus();
  	return false;
  	}
  }
if((space.test(Form.day.value)) || (Form.day.value=="dd")  )
{
document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Fill Day of Birth!</span>";
Form.day.select();
return false;
}

else if(!num.test(Form.day.value))
{
	document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Numeric Only!</span>";
Form.day.select();
return false;
}

else if((Form.day.value<1) || (Form.day.value>31))
{
	document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Date of Birth(Range 1-31)!</span>";		
	Form.day.select();
	return false;
}

else if((space.test(Form.month.value)) || (Form.month.value=="mm"))
{
alert("Kindly enter your Month of Birth");
			document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Fill Month of Birth!</span>";
Form.month.select();
return false;
}

else if(!num.test(Form.month.value))
{
			document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Numeric Only!</span>";
Form.month.select();
return false;
}

else if((Form.month.value<1) || (Form.month.value>12))
{
		document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Date of Birth(Range 1-12)!</span>";
Form.month.select();
return false;
}

else if((Form.month.value==2) && (Form.day.value>29))
{
	document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>February 29 days!</span>";
	Form.day.select();
	return false;
}

else if((space.test(Form.year.value)) || (Form.year.value=="yyyy"))
{
	document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Fill Year of Birth!</span>";
	Form.year.select();
	return false;
}

else if(!num.test(Form.year.value))
{
	document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Numeric Only!</span>";
Form.year.select();
return false;
}

else if((Form.day.value > 28) && (parseInt(Form.month.value)==2) && ((Form.year.value%4) != 0))
{
	document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>February 28 Days!</span>";
Form.day.select();
return false;
}

else if(Form.year.value.length != 4)
{
	document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Numeric Only!</span>";
	Form.year.select();
	return false;
}
if((Form.year.value < "<?php echo $maxage;?>") || (Form.year.value >"<?php echo $minage;?>"))
{
	document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Age between 18 - 62!</span>";
	Form.year.select();
	return false;
}

else if((parseInt(Form.day.value)==31) && ((parseInt(Form.month.value)==4)||(parseInt(Form.month.value)==6)||(parseInt(Form.month.value)==9)||(parseInt(Form.month.value)==11)||(parseInt(Form.month.value)==2)))
{
	document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Cannot have 31st Day!</span>";
Form.day.select();
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
	document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Fill Mobile Number!</span>";
	Form.Phone.focus();
	return false;
}
else if ((Form.Phone.value.charAt(0)!="9") && (Form.Phone.value.charAt(0)!="8") && (Form.Phone.value.charAt(0)!="7"))
{
	document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Start with 9 or 8 or 7!</span>";
	Form.Phone.focus();
	return false;
}
else if(containsalph(Form.Phone.value)==true)
{
	document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Numeric only!</span>";
	Form.Phone.focus();
	return false;
}
	if(Form.Email.value=="")
	{
		document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter  Email Address!</span>";	
		Form.Email.focus();
		return false;
	}
	
	var str=Form.Email.value
	var aa=str.indexOf("@")
	var bb=str.indexOf(".")
	var cc=str.charAt(aa)

	if(aa==-1)
	{
		document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter Valid Email Address!</span>";	
		Form.Email.focus();
		return false;
	}
	else if(bb==-1)
	{
		document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter Valid Email Address!</span>";	
		Form.Email.focus();
		return false;
	}

if(Form.City.selectedIndex==0)
{
	document.getElementById('cityVal').innerHTML = "<span  class='hintanchor'>Enter City to Continue!</span>";	
	Form.City.focus();
	return false;
}
else if((Form.City.value=='Others')  && ((Form.City_Other.value=='')||!isNaN(Form.City_Other.value)||(Form.City_Other.value=="Other City")))
{
document.getElementById('othercityVal').innerHTML = "<span  class='hintanchor'>Enter Other City to Continue!</span>";
Form.City_Other.focus();
return false;
}
if(Form.Employment_Status.selectedIndex==0)
{
	document.getElementById('empStatusVal').innerHTML = "<span  class='hintanchor'>Select Employment Status!</span>";
	Form.Employment_Status.focus();
	return false;
}
if((Form.Company_Name.value=="") || (Form.Company_Name.value=="Type Slowly for Autofill")|| (Trim(Form.Company_Name.value))==false)
{
	document.getElementById('companyNameVal').innerHTML = "<span  class='hintanchor'>Fill Company Name!</span>";	
	Form.Company_Name.focus();
	return false;
}
else if(Form.Company_Name.value.length < 3)
{
	document.getElementById('companyNameVal').innerHTML = "<span  class='hintanchor'>Fill Company Name!</span>";	
	Form.Company_Name.focus();
	return false;
}

if((Form.Net_Salary.value=='')||(Form.Net_Salary.value=="Annual Income"))
{
	document.getElementById('netSalaryVal').innerHTML = "<span  class='hintanchor'>Enter Annual Income!</span>";	
	Form.Net_Salary.focus();
	return false;
}
if(Form.salary_account.selectedIndex==0)
{
	document.getElementById('salAccVal').innerHTML = "<span  class='hintanchor'>Salary Account in which bank!</span>";	
	Form.salary_account.focus();
	return false;
}
  myOption = -1;
		for (i=Form.CC_Holder.length-1; i > -1; i--) {
			if(Form.CC_Holder[i].checked) {
				if(i==0)
				{
				if (Form.No_of_Banks.selectedIndex==0)
				{
					//alert("Please select Bank from which you are holding credit card");
					document.getElementById('noBanksVal').innerHTML = "<span  class='hintanchor'>Bank from which you are holding credit card!</span>";	
					
					Form.No_of_Banks.focus();
					return false;
				}
				if(Form.City.selectedIndex >0)
		{
	if((cit=="Bangalore" || cit=="Chennai" || cit=="Delhi" || cit=="Hyderabad" || cit=="Jaipur" || cit=="Kolkata" || cit=="Mumbai" || cit=="Pune" || cit=="Ahmedabad" || cit=="Chandigarh" || cit=="Indore" || cit=="Cochin" || cit=="Bhopal") && sal < 360000)
			{
		if(Form.Card_Vintage.selectedIndex==0)
		{
			document.getElementById('cardVinVal').innerHTML = "<span  class='hintanchor'>Holding Credit Card Since!</span>";	
			Form.Card_Vintage.focus();
			return false;
		}
		if(Form.Credit_Limit.selectedIndex==0)
		{
			document.getElementById('credLimitVal').innerHTML = "<span  class='hintanchor'>Select Card Credit Limit!</span>";	
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
			document.getElementById('ccHolderVal').innerHTML = "<span  class='hintanchor'>Credit Card holder or not!</span>";
			return false;
		}
   	if(!Form.accept.checked)
	{
		document.getElementById('acceptVal').innerHTML = "<span  class='hintanchor'>Read and Accept Terms & Conditions!</span>";	
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

function othercity1(Form)
{
if(Form.City.value=='Others')
{
Form.City_Other.disabled=false;
}
else
{Form.City_Other.disabled=true;
}
}

function onFocusBlank(element,defaultVal){ if(element.value==defaultVal){ element.value="";	} }
function onBlurDefault(element,defaultVal){	if(element.value==""){ element.value = defaultVal; }}

function addElementCC()
{
		var ni = document.getElementById('myDivCC');
		 var newdivCC = document.createElement('div');
		 var niicici = document.getElementById('icici_rqdfield');
		var cit = document.creditcard_form.City.value;
		var sal = document.creditcard_form.Net_Salary.value;
					
				ni.innerHTML = '<table border="0" cellspacing="0" cellpadding="0"><tr><td class="bldtxt" width="134">Bank Name ?</td><td class="bldtxt" width="140"><select size="1" name="No_of_Banks" id="No_of_Banks" style="width:140px;" class="field"><option value="0">Please select</option> <option value="HDFC Bank">HDFC Bank</option> <option value="Standard Chartered">Standard Chartered</option> <option value="Kotak Bank">Kotak Bank</option><option value="ICICI Bank">ICICI Bank</option><option value="Other">Other</option></select><div id="noBanksVal" class="alert_msg"></div></td></tr></table>';
		if((cit=="Bangalore" || cit=="Chennai" || cit=="Delhi" || cit=="Hyderabad" || cit=="Jaipur" || cit=="Kolkata" || cit=="Mumbai" || cit=="Pune" || cit=="Ahmedabad" || cit=="Chandigarh" || cit=="Indore" || cit=="Cochin" || cit=="Bhopal") && sal < 360000)
	{
	niicici.innerHTML='<table width="100%"  border="0" cellpadding="0" cellspacing="0">   <tr>           <Td width="134" height="26" class="bldtxt">Card Vintage:</Td><Td width="144"><select style="width:142px; height:18px;  " class="field"  name="Card_Vintage" id="Card_Vintage" onChange="validateDiv(\'cardVinVal\');"><option value="0">Please select</option> <option value="1">Less than 6 months</option> <option value="2">6 to 9 months</option> <option value="3">9 to 12 months</option><option value="4">more than 12 months</option></select><div id="cardVinVal"></div>	  </Td></tr><tr><Td width="134" height="26" class="bldtxt">Credit Limit:</Td><Td width="144"><select style="width:142px; height:18px;  " class="field"  name="Credit_Limit" id="Credit_Limit" onChange="validateDiv(\'credLimitVal\');"><option value="0">Please select</option>       <option value="1">Upto 75,000</option>              <option value="2">75,000 to 1,50,000 </option> <option value="3">1,50,000 & Above</option></select><div id="credLimitVal" class="alert_msg"></div>	  </Td></tr></table>';
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
	
function addtooltip()
{
		var ni = document.getElementById('myDiv1');

		if(ni.innerHTML=="")
		{
				ni.innerHTML = 'Please give correct Mobile Number to Activate your Card Request';
		}
		return true;
}


function removetooltip()
{
		var ni = document.getElementById('myDiv1');
		if(ni.innerHTML!="")
		{
			ni.innerHTML = '';
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
			ni.innerHTML = '<table cellpadding="0" cellspacing="0" width="100%" > <tr align="left"><td width="130" height="26" class="bldtxt">Other City </td>				  <Td width="148"><input name="City_Other" id="City_Other" type="text"  class="field" style="width:140px;" onKeyDown="validateDiv(\'othercityVal\');" /><div id="othercityVal" class="alert_msg"></div></td>				  </tr></table>';
			}
		}
		else
	{
		ni.innerHTML="";
	}
	return true;
	}

function addhdfclife()
{
	var ni1 = document.getElementById('hdfclife');
	var cit = document.creditcard_form.City.value;
	
	if(cit =="Ahmedabad" || cit =="Bangalore" || cit =="Baroda" || cit =="Bhubaneshwar" || cit =="Chandigarh" || cit =="Chennai" || cit =="Cochin" || cit =="Cuttack" || cit =="Delhi" || cit =="Faridabad" || cit =="Gaziabad" || cit =="Gurgaon" || cit =="Guwahati" || cit =="Hyderabad" || cit =="Indore" || cit =="Jaipur" || cit =="Kanpur" || cit =="Kochi" || cit =="Kolkata" || cit =="Lucknow" || cit =="Mumbai" || cit =="Noida" || cit =="Pune" || cit =="Sahibabad" ||
cit =="Surat" || cit =="Thane" || cit =="Vadodara" || cit =="Vijaywada" || cit =="Vishakapatanam" || cit =="Vizag" )
	{
		//alert("ranjana");
		ni1.innerHTML = '<table  style="border:1px solid #000000; padding:2px;"><tr><td colspan="2" class="frmbldtxt" style="font-family:verdana; font-size:10px; color:#333333; font-weight:normal; " height="20"><span style="color:#FF0000;">(Optional) </span>Special service only for Deal4loans customers:</td></tr> <tr><td width="23"><input type="checkbox"  name="hdfclife" id="hdfclife" value="1"/></td> <td width="611" class="frmbldtxt" style="font-family:verdana; font-size:10px; color:#333333; font-weight:normal; "> I would like to avail of <b>FREE </b>financial planning services by <b>Insurance & Investment experts</b> from HDFC Life.</td>		 </tr>	 </table>';	
	}
	else
	{
		ni1.innerHTML = '';
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
			var get_email = document.getElementById('Email').value;
			var get_mobile_no = document.getElementById('Phone').value;
			var get_city = document.getElementById('City').value;
			var get_id = document.getElementById('Activate').value;
			
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
<div id="pagewrap">
<header id="header">
<div id="site-logo"><img src="new-images/pl/deal4loans-logo.jpg"></div>
<div class="pl_top_text_box">Credit Card by Choice not by Chance!</div>
  </header>
  <div style="clear:both;"></div>
	
  <div id="content">

		<article >
		  <div style=" float:left;"><table width="100%" border="0" cellpadding="0" cellspacing="0">
		    <tr>
		      <td width="100%">
              <div class="image_box_b"><img src="images/credit-cards-apply-sampl.jpg"></div>
              <div class="image_box_a"><img src="images/credit-cards-apply-banner.jpg"></div></td>
	        </tr>
	      </table>
          </div>
         <div id="content_credit"><table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="#FFFFFF"><table width="95%"  border="0" align="center" cellpadding="0" cellspacing="0" style="border:1px solid #CCCCCC;">
              <tr>
                <td class="bldtxt" style="font-size:17px; font-family:Arial, Helvetica, sans-serif; " >&nbsp;</td>
              </tr>
              <tr>
                <td height="30" bgcolor="#FDF4AE" class="bldtxt" style="font-size:17px; font-family:Arial, Helvetica, sans-serif; color:#000000; padding-left:20px;" ><strong>Why Deal4loans.com</strong></td>
              </tr>
              <tr>
                <td valign="top"><table width="99%"  border="0" cellspacing="0" cellpadding="0">
                  <tr>
                      <td width="35" height="25" align="center" valign="middle"><img src="new-images/pl/arrow.gif" width="15" height="17" /></td>
                      <td><div style="color:#7e5a09; font-size:13px; font-weight:bold; font-family:Verdana, Geneva, sans-serif; line-height:24px;  ">Over 6 lakh customers have taken quote at Deal4loans.com</div></td>
                    </tr>
                    <tr>
                      <td width="30" height="25" align="center" valign="middle"><img src="new-images/pl/arrow.gif" width="15" height="17" /></td>
                      <td><div style="color:#7e5a09; font-size:13px; font-weight:bold; line-height:24px; font-family:Verdana, Geneva, sans-serif;  ">Credit Card Offers are free for customers. it's a totally free service for customers.</div></td>
                    </tr>
                    <tr>
                      <td width="30" height="25" align="center" valign="middle"><img src="new-images/pl/arrow.gif" width="15" height="17" /></td>
                      <td><div style="color:#7e5a09; font-size:13px; font-weight:bold; line-height:24px; font-family:Verdana, Geneva, sans-serif;  ">Deal4loans.com has tie ups with all Credit Card Banks in India.</div></td>
                    </tr>
                    <tr>
                      <td width="30" height="25" align="center" valign="middle"><img src="new-images/pl/arrow.gif" width="15" height="17" /></td>
                      <td><div style="color:#7e5a09; font-size:13px; font-weight:bold; line-height:24px; font-family:Verdana, Geneva, sans-serif;  ">Your details will not be shared with any bank unless you opt for it.</div></td>
                    </tr>
                </table></td>
              </tr>
			  <tr>
                <td  height="10" align="left" valign="middle" bgcolor="#FFFFFF" style="font-family:verdana; font-size:16px; color:#000000; font-weight:bold;"></td>
              </tr>
			  
              <tr>
                <td height="45" bgcolor="#FDF4AE" style="font-family:arial; font-size:16px; color:#000000; font-weight:bold; padding-left:20px;">
                       Instant Online Credit Card applications from Hdfc Bank, Standard Chartered, ICICI Bank, Sbi, Amex</td>
              </tr>
			  <tr><td align="left" valign="middle" height="auto" style="font-family:arial; font-size:12px; color:#000000; padding:5px;"><table width="100%"><tr><td><img src="new-images/thumb/hdfc-logo.jpg" height="67" width="146" /></td><td><img src="new-images/thumb/icici.jpg" height="67" width="146" /></td><td><img src="new-images/thumb/stanchart.jpg" height="67" width="146" /></td><td><!--<img src="new-images/thumb/amex-logo.jpg" height="67" width="146" />--></td></tr></table></td></tr>
              <tr>
                <td  height="30" bgcolor="#FDF4AE" style="font-family:arial; font-size:17px; color:#000000; font-weight:bold; padding-left:20px;">Safety Tips for using a Credit Card.</td>
              </tr>
                           <tr>
                <td align="left" valign="middle" height="auto" style="font-family:arial; font-size:12px; color:#000000; padding:10px;"><font  color="#05394A"><strong>&bull;</strong></font><strong> Sign your card as soon as you receive it.<br />
                    <font  color="#05394A">&bull;</font> You will also receive the PIN number after a few days. Keep your
             PIN/account number safe.<br />
             <font  color="#05394A">&bull;</font> Every time you use your card, be aware when your card is being swiped
             by the cashier so as to ensure no misuse &nbsp;&nbsp;of your card takes place.<br />
             <font  color="#05394A">&bull;</font> When making payment with your card, make sure you check if it is your credit card that the cashier has returned.<br />
             <font  color="#05394A">&bull;</font> Do not forget to verify your purchases with your billing statements.<br />
             <font  color="#05394A">&bull;</font> After using your card at an ATM, do not throw your receipt behind.</strong></td>
              </tr>
              <tr>
                <td height="5" align="center" valign="middle"></td>
              </tr>
              
            </table></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF" style="height:10px;"><?php include 'footer_landingpage.php'; ?></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF"><div class="why_deal"></div></td>
  </tr>
</table>
         </div>
          
         	</article>
                  
            			</div>
                      
         
  <div id="sidebar_credit-card">
<div class="widget_b"><img src="images/credit-card-mobo.gif"></div>  

		<section class="widget">
		  <div class="right-box-b">
		  <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" class="form_text_pl"><form  name="creditcard_form" id="creditcard_form" action="get_cc_eligiblebank.php" method="post" onSubmit="return ckhcreditcard(document.creditcard_form); " >
			<input type="hidden" name="Type_Loan" value="Req_Credit_Card">
<input type="hidden" name="creative" value="<? echo $_REQUEST['creative'] ?>">
<input type="hidden" name="section" value="<? echo $_REQUEST['section'] ?>">
<input type="hidden" name="source" value="<? echo $src; ?>"> 
<input type="hidden" name="referrer" value="<? echo $_REQUEST['referrer'] ?>"> 
<input type="hidden" name="Activate" id="Activate" >
<input type="hidden" name="PostURL" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
<div align="center"><font face="Verdana, Arial, Helvetica, sans-serif;" color="#FF0000"><strong><?php if(isset($_GET['msg'])) echo "Kindly give Valid Details"; ?></strong></font></div><table width="98%"  border="0" align="right" cellpadding="0" cellspacing="0">
				<tr align="left">
				  <Td width="134" valign="top">&nbsp;</Td>
				  <Td width="144">&nbsp;</Td>
				  </tr>
				<tr align="left">
				<Td width="134" valign="top" class="bldtxt">Full Name </Td>
 				<Td width="144"><input type="text" name="Full_Name" id="Full_Name"  onchange="insertData();" class="input_credit"  onKeyDown="validateDiv('nameVal');" /><div id="nameVal" class="alert_msg" ></div></Td>
				</tr>
				<tr align="left">
				  <Td width="134" height="26" valign="top" class="bldtxt">DOB</Td>
				  <Td width="0" align="left"><input name="day" type="text" id="day" value="dd" class="dd_credit" onBlur="onBlurDefault(this,'dd');"  onFocus="onFocusBlank(this,'dd');" maxlength="2" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);"  onKeyDown="validateDiv('dobVal');" /> <input name="month" id="month" type="text" value="mm"  class="dd_credit" onBlur="onBlurDefault(this,'mm');"  onFocus="onFocusBlank(this,'mm');" maxlength="2" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);"  onKeyDown="validateDiv('dobVal');" /> <input name="year" id="year" type="text" value="yyyy"  onBlur="onBlurDefault(this,'yyyy');"  onFocus="onFocusBlank(this,'yyyy');" maxlength="4" onChange="intOnly(this); insertData();" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" class="mm_credit"  onKeyDown="validateDiv('dobVal');" /> <div id="dobVal" class="alert_msg"></div></Td>
				  </tr>
				<tr align="left">
				  <Td width="134" height="26" valign="top" class="bldtxt">Mobile No. </Td>
				  <Td width="144" class="bldtxt">+91
				    <input name="Phone" type="text" id="Phone" onFocus="addtooltip();"  onchange="intOnly(this); insertData();" onKeyPress="intOnly(this);" onKeyUp="intOnly(this);" size="15" maxlength="10" class="mobile_credit" onKeyDown="validateDiv('phoneVal');"  /><div id="phoneVal class="alert_msg""></div> </Td>
				  </tr>
				 <tr valign="top">
		  <td colspan="2"><div id="myDiv1" style="color:#7d0606; font-family:Verdana; font-size:10px;"></div></td>
		  </tr>
				<tr align="left">
				  <Td width="134" height="26" valign="top" class="bldtxt">Email Id </Td>
				  <Td width="144"><input name="Email" id="Email" class="input_credit" type="text"  onFocus="removetooltip();" onChange="insertData();" onKeyDown="validateDiv('emailVal');" /><div id="emailVal" class="alert_msg"></div></Td>
				  </tr>
				<tr align="left">
				  <Td width="134" height="26" valign="top" class="bldtxt">City</Td>
				  <Td width="144"><select  class="select_credit"  name="City" id="City" onChange="addcty_oth(); addhdfclife(); validateDiv('cityVal');" >         <?=CCgetCityList($City)?>      </select><div id="cityVal" class="alert_msg"></div>	  </Td>
				  </tr>
				<tr align="left" valign="top">
				  <Td colspan="2" class="bldtxt" id="othercty_id"></Td>
			      </tr>
				
				<tr align="left">
				  <td width="134" height="26" valign="top" class="bldtxt">Occupation</Td>
				  <td width="144"><select   style="width:140px;"  name="Employment_Status" id="Employment_Status" class="field" onChange="validateDiv('empStatusVal');" >
        <option selected value="-1">Employment Status</option>
        <option  value="1">Salaried</option>
        <option value="0">Self Employed</option>
      </select><div id="empStatusVal" class="alert_msg"></div></Td>
				  </tr>
				  <tr align="left">
				  <td width="134" height="26" valign="top" class="bldtxt">Company Name </Td>
				  <td width="144"> <input name="Company_Name"  id="Company_Name" type="text" class="input_credit" onKeyUp="ajax_showOptions(this,'getCountriesByLetters',event)" value="Type Slowly for Autofill" onBlur="onBlurDefault(this,'Type Slowly for Autofill');" onFocus="onFocusBlank(this,'Type Slowly for Autofill');" onKeyDown="validateDiv('companyNameVal');"  autocomplete="off" /><div id="companyNameVal" class="alert_msg"></div></Td>
				  </tr>
				<tr align="left">
				  <td width="134" height="26" valign="top" class="bldtxt">Annual Income </Td>
				  <td width="144"><input name="Net_Salary" id="Net_Salary" type="text" value="Annual Income" onFocus="this.select();"  onChange="intOnly(this); addDiv();"  onKeyUp="intOnly(this);getDigitToWords('Net_Salary','formatedIncome','wordIncome'); addDiv();" onKeyPress="intOnly(this); getDigitToWords('Net_Salary','formatedIncome','wordIncome');" onBlur="getDigitToWords('Net_Salary','formatedIncome','wordIncome'); "  onKeyDown="validateDiv('netSalaryVal');" class="input_credit"/><div id="netSalaryVal" class="alert_msg"></div>
               				
                    </Td>
				  </tr>
				  <tr valign="top"><td colspan="2">	<span id='formatedIncome' style='font-size:11px; font-weight:bold;color:666699;font-Family:Verdana;'></span><span id='wordIncome' style='font-size:11px;
font-weight:bold;color:666699;font-Family:Verdana;text-transform: capitalize;'></span></td>
				  </tr>
<tr align="left">
				  <Td width="134" height="26" valign="top" class="bldtxt">Salary Account</Td>
				  <Td width="144"><select style="width:142px; height:18px;  " class="field"  name="salary_account" id="salary_account"  onchange="validateDiv('empStatusVal');" >
          <option name="">Please Select</option>
				  <option value="HDFC Bank">HDFC Bank</option>
				  <option value="ICICI Bank">ICICI Bank</option>
				  <option value="Kotak Bank">Kotak Bank</option>
				  <option value="Standard Chartered">Standard Chartered</option>
				  <option value="Others">Others</option>
      </select><div id="salAccVal" class="alert_msg"></div>	  </Td>
				  </tr>
				<tr align="left" valign="top">
				  <Td height="25" colspan="2" class="bldtxt">Are you a Credit card holder?</Td>
				  </tr>
				<tr align="left">
				  <Td height="25" valign="top">&nbsp; </Td>
				  <Td height="25" valign="middle"><span class="bldtxt">
				    <input type="radio"   name="CC_Holder" value="1" onClick="addElementCC();" style="border:none;" />
				    Yes &nbsp;&nbsp;
                    <input type="radio" value="0"  name="CC_Holder" style="border:none;"  onClick="removeElementCC();"/>
                    No</span> <div id="ccHolderVal" class="alert_msg"></div></Td>
				</tr>
			<tr valign="top"><td colspan="2"><div id="myDivCC"></div></td></tr>
	<tr valign="top"><td colspan="2"><div id="icici_rqdfield"></div></td></tr>
			
		<tr valign="top">
				    <td  colspan="2" align="left" style="padding:5px;"> <div id="hdfclife"></div></td>
		 </tr>
          				<tr align="left" valign="top">
				  <Td height="50" colspan="2" style="font-family:verdana; font-size:10px; color:#000000;"><input type="checkbox"  name="accept" style="border:none;" checked  > I Agree to <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow">privacy policy</a> and <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow">Terms and Conditions</a>.<div id="acceptVal" class="alert_msg"></div></Td>
				  </tr>
				<tr align="center" valign="top">
				  <Td colspan="2"><br />
				    <input type="image" name="Submit"  src="http://www.deal4loans.com/new-images/choose-cc.jpg"  style="width:200px; height:29px; border:none; " /></Td>
				  </tr>
                </table></form></td>
  </tr>
  </table>
		  </div>
		</section>
    <div class="widget_c"></div>
  </div>
  <div id="right_img_credit-card"><img src="images/credit-card-right-mobo.jpg"></div>
  </div>
  <?php include "analytics.php"; ?>
</body>
</html>