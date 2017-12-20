<?php
	require 'scripts/session_check.php';
	require 'scripts/functions.php';
	$maxage=date('Y')-62;
$minage=date('Y')-18;

if(isset($_REQUEST["srcbnr"]))
{
	$src=$_REQUEST["srcbnr"];
}
else
{
	$src="BnnrCmpgn_CC";
}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Credit Card</title>
<link rel="stylesheet" href="css/creditcards1.css" type="text/css" />
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

.field{
font-family:verdana;
font-size:11px;
color:#000000;
}
body {
color:#292323;
font-family:Verdana,Arial,Helvetica,sans-serif;
font-size:11px;
line-height:16px;
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

if((Form.Full_Name.value=="") || (Trim(Form.Full_Name.value))==false)
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
if((Form.year.value < "<?php echo $maxage;?>") || (Form.year.value >"<?php echo $minage;?>"))
{
alert("Age Criteria! \n Applicants between age group 18 - 62 only are elgibile.");
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

if((Form.Company_Name.value=="") || (Form.Company_Name.value=="Type Slowly for Autofill")|| (Trim(Form.Company_Name.value))==false)
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
					
				ni.innerHTML = '<table border="0" cellspacing="0" cellpadding="0"><tr><td class="bldtxt" width="134">Bank Name ?</td><td class="bldtxt" width="140"><select size="1" name="No_of_Banks" id="No_of_Banks" style="width:140px; " class="field"><option value="0">Please select</option> <option value="HDFC Bank">HDFC Bank</option> <option value="Standard Chartered">Standard Chartered</option> <option value="Kotak Bank">Kotak Bank</option><option value="ICICI Bank">ICICI Bank</option><option value="Other">Other</option></select></td></tr></table>';
			ni.appendChild(newdivCC);
	}

function removeElementCC()
{	var ni = document.getElementById('myDivCC');
		if(ni.innerHTML!="")
		{
		ni.innerHTML = '';
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
			ni.innerHTML = '<table cellpadding="0" cellspacing="0" width="100%" > <tr align="left">				  <Td width="130" height="26" class="bldtxt">Other City </Td>				  <Td width="148"><input name="City_Other" id="City_Other" type="text"  class="field" style="width:140px; " /></Td>				  </tr></table>';
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
	
	//alert(cit);	
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

function addcty_oth()
{
		var ni = document.getElementById('myDiv');
		
		if(ni.innerHTML=="")
		{
		
			if(document.creditcard_form.City.value=="Others")
			{
				
				ni.innerHTML = '<Table cellpadding="0" cellspacing="0" width="100%"><tr align="left">				  <Td height="26" class="bldtxt" width="50%">Other City </Td>				  <Td width="5%"> <select style="width:142px; height:18px;  "  name="City_Other" id="City_Other"  ><option value="">Please Select</option><option value="Ananthpur">Ananthpur</option><option value="Aurangabad">Aurangabad</option><option value="Baroda">Baroda</option><option value="Bhimavaram">Bhimavaram</option><option value="Bhiwadi">Bhiwadi</option><option value="Bhopal">Bhopal</option><option value="Bhubneshwar">Bhubneshwar</option><option value="Calicut">Calicut</option><option value="Cuttack">Cuttack</option><option value="Dehradun">Dehradun</option><option value="Dindigul">Dindigul</option><option value="Eluru">Eluru</option><option value="Ernakulam">Ernakulam</option><option value="Erode">Erode</option><option value="Faridabad">Faridabad</option><option value="Guntur">Guntur</option><option value="Guwahati">Guwahati</option><option value="Hosur">Hosur</option><option value="Indore">Indore</option><option value="Jabalpur">Jabalpur</option><option value="Jamshedpur">Jamshedpur</option><option value="Kakinada">Kakinada</option><option value="Karaikkal">Karaikkal</option><option value="Karimnagar">Karimnagar</option><option value="Karur">Karur</option><option value="Kanpur">Kanpur</option><option value="Khammam">Khammam</option><option value="Kishangarh">Kishangarh</option><option value="Kochi">Kochi</option><option value="Kozhikode">Kozhikode</option><option value="Kumbakonam">Kumbakonam</option><option value="Kurnool">Kurnool</option><option value="Ludhiana">Ludhiana</option><option value="Madurai">Madurai</option><option value="Mangalore">Mangalore</option><option value="Mysore">Mysore</option><option value="Nagerkoil">Nagerkoil</option><option value="Nasik">Nasik</option><option value="Navi Mumbai">Navi Mumbai</option><option value="Nellore">Nellore</option><option value="Nizamabad">Nizamabad</option><option value="Ongole">Ongole</option><option value="Ooty">Ooty</option><option value="Patna">Patna</option><option value="Pondicherry">Pondicherry</option><option value="Pudukottai">Pudukottai</option><option value="Rajahmundry">Rajahmundry</option><option value="Ramagundam">Ramagundam</option><option value="Raipur">Raipur</option><option value="Rewari">Rewari</option><option value="Sahibabad">Sahibabad</option><option value="Salem">Salem</option><option value="Srikakulam">Srikakulam</option><option value="Thanjavur">Thanjavur</option><option value="Thrissur">Thrissur</option><option value="Thiruvananthapuram">Thiruvananthapuram</option><option value="Tirunelveli">Tirunelveli</option><option value="Tirupathi">Tirupathi</option><option value="Trivandrum">Trivandrum</option><option value="Trichy">Trichy</option><option value="Tuticorin">Tuticorin</option><option value="Vadodara">Vadodara</option><option value="Vellore">Vellore</option><option value="Vishakapatanam">Vishakapatanam</option><option value="Vizag">Vizag</option><option value="Vizianagaram">Vizianagaram</option><option value="Warangal">Warangal</option></select></Td>				  </tr></table>';
				

			}
		}
		else
	{
		ni.innerHTML="";
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
<table width="1004" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="161" height="169" align="left" valign="top"><img src="new-images/cc/hrdrn1.jpg" width="161" height="169" /></td>
            <td width="158" height="169" align="left" valign="top"><img src="new-images/cc/hrdrn2.jpg" width="158" height="169" /></td>
            <td width="177" height="169" align="left" valign="top"><img src="new-images/cc/hrdrn3.gif" width="177" height="169" /></td>
            <td width="186" height="169" align="left" valign="top"><img src="new-images/cc/hrdrn4.gif" width="186" height="169" /></td>
          </tr>
          <tr>
            <td height="167" align="left" valign="top"><img src="new-images/cc/hrdrn5.jpg" width="161" height="167" /></td>
            <td height="167" align="left" valign="top"><img src="new-images/cc/hrdrn6.jpg" width="158" height="167" /></td>
            <td height="167" align="left" valign="top"><img src="new-images/cc/hrdrn7.gif" width="177" height="167" /></td>
            <td height="167" align="left" valign="top"><img src="new-images/cc/hrdrn8.gif" width="186" height="167" /></td>
          </tr>
          <tr>
            <td colspan="4"><table width="95%"  border="0" align="center" cellpadding="0" cellspacing="0" style="border:1px solid #CCCCCC;">
              <tr>
                <td class="bldtxt" style="font-size:17px; font-family:Arial, Helvetica, sans-serif; " >&nbsp;</td>
              </tr>
              <tr>
                <td height="30" bgcolor="#FDF4AE" class="bldtxt" style="font-size:17px; font-family:Arial, Helvetica, sans-serif; color:#000000; padding-left:20px;" >Why Deal4loans.com</td>
              </tr>
              <tr>
                <td><table width="550" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td style="padding-left:15px; "><table width="98%"  border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="35" height="25" align="center" valign="middle"><img src="new-images/pl/arrow.gif" width="15" height="17" /></td>
                        <td><div style="color:#7e5a09; font-size:13px; font-weight:bold; line-height:24px;  ">Over 6 lakh customers have taken quote at Deal4loans.com</div></td>
                      </tr>
                      
                      <tr>
                        <td width="30" height="25" align="center" valign="middle"><img src="new-images/pl/arrow.gif" width="15" height="17" /></td>
                        <td><div style="color:#7e5a09; font-size:13px; font-weight:bold; line-height:24px;  ">Credit Card Offers are free for customers.</div></td>
                      </tr>
					   
					 

                      <tr>
                        <td width="30" height="25" align="center" valign="middle"><img src="new-images/pl/arrow.gif" width="15" height="17" /></td>
                        <td><div style="color:#7e5a09; font-size:13px; font-weight:bold; line-height:24px;  ">Deal4loans.com has tie ups with all Credit Card Banks in India.</div></td>
                      </tr>
					   <tr>
                        <td width="30" height="25" align="center" valign="middle"><img src="new-images/pl/arrow.gif" width="15" height="17" /></td>
                        <td><div style="color:#7e5a09; font-size:13px; font-weight:bold; line-height:24px;  ">Your details will not be shared with any bank unless you opt for it.</div></td>
                      </tr>
                      
                    </table></td>
                  </tr>
                </table></td>
              </tr>
			  <tr>
                <td width="550" height="10" align="left" valign="middle" bgcolor="#FFFFFF" style="font-family:verdana; font-size:16px; color:#000000; font-weight:bold;"></td>
              </tr>
			  
              <tr>
                <td height="45" bgcolor="#FDF4AE" style="font-family:arial; font-size:16px; color:#000000; font-weight:bold; padding-left:20px;">
                       Instant Online Credit Card applications from Hdfc Bank, Standard Chartered, ICICI Bank, Sbi, Amex</td>
              </tr>
			  <tr><td align="left" valign="middle" height="auto" style="font-family:arial; font-size:12px; color:#000000; padding:5px;"><table width="100%"><tr><td><img src="/new-images/thumb/hdfc-logo.jpg" height="67" width="146" /></td><td><img src="/new-images/thumb/icici.jpg" height="67" width="146" /></td><td><img src="/new-images/thumb/stanchart.jpg" height="67" width="146" /></td><td><img src="/new-images/thumb/amex-logo.jpg" height="67" width="146" /></td></tr></table></td></tr>
              <tr>
                <td  height="30" bgcolor="#FDF4AE" style="font-family:arial; font-size:17px; color:#000000; font-weight:bold; padding-left:20px;">Safety Tips for using a Credit Card.</td>
              </tr>
                           <tr>
                <td align="left" valign="middle" height="auto" style="font-family:arial; font-size:12px; color:#000000; padding:10px;"><font  color="#05394A">&bull;</font> Sign your card as soon as you receive it.<br />
                  <font  color="#05394A">&bull;</font> You will also receive the PIN number after a few days. Keep your
             PIN/account number safe.<br />
             <font  color="#05394A">&bull;</font> Every time you use your card, be aware when your card is being swiped
             by the cashier so as to ensure no misuse &nbsp;&nbsp;of your card takes place.<br />
             <font  color="#05394A">&bull;</font> When making payment with your card, make sure you check if it is your credit card that the cashier has returned.<br />
             <font  color="#05394A">&bull;</font> Do not forget to verify your purchases with your billing statements.<br />
             <font  color="#05394A">&bull;</font> After using your card at an ATM, do not throw your receipt behind.</td>
              </tr>
              <tr>
                <td height="5" align="center" valign="middle"></td>
              </tr>
              
            </table></td>
            </tr>
        </table></td>
        <td width="322" valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="289" height="88" align="left" valign="top"><img src="new-images/cc/credit-card.gif" width="289" height="88" /></td>
              </tr>
              <tr>
                <td valign="top" style="border-left:1px solid #c2c2c2; border-right:1px solid #c2c2c2;">
				   <form  name="creditcard_form" id="creditcard_form" action="credit-cards-bnrapply-continue.php" method="post" onSubmit="return ckhcreditcard(document.creditcard_form); " >
			<input type="hidden" name="Type_Loan" value="Req_Credit_Card">
<input type="hidden" name="creative" value="<? echo $_REQUEST['creative'] ?>">
<input type="hidden" name="section" value="<? echo $_REQUEST['section'] ?>">
<input type="hidden" name="source" value="<? echo $src; ?>"> 
<input type="hidden" name="referrer" value="<? echo $_REQUEST['referrer'] ?>"> 
<input type="hidden" name="Activate" id="Activate" >
<input type="hidden" name="PostURL" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
<div align="center"><font face="Verdana, Arial, Helvetica, sans-serif;" color="#FF0000"><strong><?php if(isset($_GET['msg'])) echo "Kindly give Valid Details"; ?></strong></font></div><table width="97%"  border="0" align="right" cellpadding="0" cellspacing="0">
				<tr align="left">
				  <Td width="134">&nbsp;</Td>
				  <Td width="144">&nbsp;</Td>
				  </tr>
				<tr align="left">
				<Td width="134" class="bldtxt">Full Name </Td>
 				<Td width="144"><input type="text" name="Full_Name" id="Full_Name" style=" width:140px;" onchange="insertData();" class="field"/></Td>
				</tr>
				<tr align="left">
				  <Td width="134" height="26" class="bldtxt">DOB</Td>
				  <Td width="144"><input name="day" type="text" id="day" value="dd" style="width:40px; " onBlur="onBlurDefault(this,'dd');"  onFocus="onFocusBlank(this,'dd');" maxlength="2" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);"/> <input name="month" id="month" type="text" value="mm"  style="width:40px; " onBlur="onBlurDefault(this,'mm');"  onFocus="onFocusBlank(this,'mm');" maxlength="2" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);"/> <input name="year" id="year" type="text" value="yyyy"   style="width:47px; " onBlur="onBlurDefault(this,'yyyy');"  onFocus="onFocusBlank(this,'yyyy');" maxlength="4" onChange="intOnly(this); insertData();" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" class="field"/></Td>
				  </tr>
				<tr align="left">
				  <Td width="134" height="26" class="bldtxt">Mobile No. </Td>
				  <Td width="144" class="bldtxt">+91
				    <input name="Phone" type="text" id="Phone" onfocus="addtooltip();" class="field" onchange="intOnly(this); insertData();" onkeypress="intOnly(this);" onkeyup="intOnly(this);" size="15" maxlength="10"  style="width:110px;" /></Td>
				  </tr>
				 <tr>
		  <td colspan="2"><div id="myDiv1" style="color:#7d0606; font-family:Verdana; font-size:10px;"></div></td>
		  </tr>
				<tr align="left">
				  <Td width="134" height="26" class="bldtxt">Email Id </Td>
				  <Td width="144"><input name="Email" id="Email" class="field" type="text"  style="width:140px;" onFocus="removetooltip();" onChange="insertData();"/></Td>
				  </tr>
				<tr align="left">
				  <Td width="134" height="26" class="bldtxt">City</Td>
				  <Td width="144"><select style="width:142px; height:18px;  " class="field"  name="City" id="City" onchange="addcty_oth(); addhdfclife(); "  >
        <option value="Please Select">Please Select</option><option value="Ahmedabad">Ahmedabad</option><option value="Bangalore">Bangalore</option><option value="Chandigarh">Chandigarh</option><option value="Chennai">Chennai</option><option value="Cochin">Cochin</option><option value="Coimbatore">Coimbatore</option><option value="Delhi">Delhi</option><option value="Gaziabad">Gaziabad</option><option value="Gurgaon">Gurgaon</option><option value="Hyderabad">Hyderabad</option><option value="Jaipur">Jaipur</option><option value="Jalandhar">Jalandhar</option><option value="Kolkata">Kolkata</option><option value="Lucknow">Lucknow</option><option value="Mumbai">Mumbai</option><option value="Nagpur">Nagpur</option><option value="Noida">Noida</option><option value="Pune">Pune</option><option value="Surat">Surat</option><option value="Thane">Thane</option><option value="Others">Others</option>
      </select>	  </Td>
				  </tr>
				<tr align="left">
				  <Td class="bldtxt" colspan="2" id="myDiv"></Td>
				   </tr>
			
				  <tr align="left">
				  <Td width="134" height="26" class="bldtxt">Company Name </Td>
				  <Td width="144"> <input name="Company_Name"  id="Company_Name" type="text" style="width:140px;" class="field" onKeyUp="ajax_showOptions(this,'getCountriesByLetters',event)" value="Type Slowly for Autofill" onblur="onBlurDefault(this,'Type Slowly for Autofill');" onfocus="onFocusBlank(this,'Type Slowly for Autofill');" /></Td>
				  </tr>
				<tr align="left">
				  <Td width="134" height="26" class="bldtxt">Annual Income </Td>
				  <Td width="144"><input name="Net_Salary" id="Net_Salary" type="text" value="Annual Income" style="width:140px; " onFocus="this.select();"  onChange="intOnly(this); addDiv();"  onKeyUp="intOnly(this);getDigitToWords('Net_Salary','formatedIncome','wordIncome'); addDiv();" onKeyPress="intOnly(this); getDigitToWords('Net_Salary','formatedIncome','wordIncome');" onBlur="getDigitToWords('Net_Salary','formatedIncome','wordIncome'); " class="field"/>				  </Td>
				  </tr>
				  <tr><td colspan="2">	<span id='formatedIncome' style='font-size:11px; font-weight:bold;color:666699;font-Family:Verdana;'></span><span id='wordIncome' style='font-size:11px;
font-weight:bold;color:666699;font-Family:Verdana;text-transform: capitalize;'></span></td></tr>

				<tr align="left">
				  <Td height="25" colspan="2" class="bldtxt">Are you a Credit card holder?</Td>
				  </tr>
				<tr align="left">
				  <Td height="25" valign="middle">&nbsp; </Td>
				  <Td height="25" valign="middle"><span class="bldtxt">
				    <input type="radio"   name="CC_Holder" value="1" onClick="addElementCC();" style="border:none;" />
				    Yes &nbsp;&nbsp;
                    <input type="radio" value="0"  name="CC_Holder" style="border:none;"  onClick="removeElementCC();"/>
                    No</span></Td>
				</tr>
			<tr><td colspan="2"><div id="myDivCC"></div></td></tr>
		<tr>
				    <td  colspan="2" align="left" style="padding:5px;"> <div id="hdfclife"></div></td>
		 </tr>
          				<tr align="left">
				  <Td height="50" colspan="2" style="font-family:verdana; font-size:10px; color:#000000;"><input type="checkbox"  name="accept" style="border:none;" checked  > I Agree to <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow">privacy policy</a> and <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow">Terms and Conditions</a>.</Td>
				  </tr>
				 
				<tr align="center">
				  <Td colspan="2"><br /><input type="image" name="Submit"  src="new-images/choose-cc.jpg"  style="width:200px; height:29px; border:none; " /></Td>
				  </tr>
                </table>
				</form></td>
              </tr>
              <tr>
                <td valign="top"><img width="289" height="21" src="images/cl/frm-btm.gif"/></td>
              </tr>
              <tr>
                <td valign="middle" height="120">&nbsp;</td>
              </tr>
            </table></td>
            <td width="33" height="336" align="right" valign="top"><img src="new-images/cc/right-33.gif" width="33" height="336" /></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <Tr>
  <td>&nbsp;</td>
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
