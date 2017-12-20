<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
$maxage=date('Y')-62;
$minage=date('Y')-18;

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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Loan Against property India| Housing Mortage loan India| compare apply Deal4loans</title>
<meta name="description" content="Deal4Loans is an online loan information portal, provides valuable information on all types of loans in India offered by top banks. Read online information on home loans, car loans,loan against property, loans against property, loan providers and credit cards. Just fill in a simple form, Get, Compare and Choose deals from all the leading loan providers / banks">
<meta name="keywords" content="loan against property India,housing mortage loan india, loan against property India, apply for loan against property, loan against property eligibility,loan against property documents">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<link rel="stylesheet" href="css/loan_property.css" type="text/css" />
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
function tataaig_comp()
{
	//alert("hello");
	var ni = document.getElementById('tataaig_compaign');
		
		if(ni.innerHTML=="")
		{
			if(document.loan_form.City.value=="Delhi" || document.loan_form.City.value=='Delhi' || document.loan_form.City.value=='Noida'  ||  document.loan_form.City.value=='Gurgaon'  ||  document.loan_form.City.value=='Faridabad'  ||  document.loan_form.City.value=='Gaziabad'  ||  document.loan_form.City.value=='Faridabad'  ||  document.loan_form.City.value=='Greater Noida'  || document.loan_form.City.value=='Chennai'  ||  document.loan_form.City.value=='Mumbai'  ||  document.loan_form.City.value=='Thane'  ||  document.loan_form.City.value=='Navi mumbai'  ||  document.loan_form.City.value=='Kolkata'  ||  document.loan_form.City.value=='Kolkota'  ||  document.loan_form.City.value=='Hyderabad'  ||  document.loan_form.City.value=='Pune'  || document.loan_form.City.value=='Bangalore')
			{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '<input type="checkbox" name="Accidental_Insurance" id="Accidental_Insurance" value="1" checked>&nbsp;<a href="tata-aig-personal-accident-cover.php" target="_blank" style="color:#FFFFFF;"> Get free personal accident insurance from TATA AIG</a>';
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
				ni.innerHTML = '<input type="checkbox"  name="Accidental_Insurance" id="Accidental_Insurance" value="1" checked>&nbsp;<a href="tata-aig-personal-accident-cover.php" target="_blank"  style="color:#FFFFFF;"> Get free personal accident insurance from TATA AIG</a>';
			}
			else 
			{
			//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '';
			}
			
		}
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
if((Form.Name.value=="") || (Trim(Form.Name.value))==false)
{
alert("Kindly fill in your Name!");
document.loan_form.Name.select();
return false;
}
else if(containsdigit(Form.Name.value)==true)
{
alert("Name contains numbers!");
Form.Name.select();
return false;
}
  for (var i = 0; i < Form.Name.value.length; i++) {
  	if (iChars.indexOf(Form.Name.value.charAt(i)) != -1) {
  	alert ("Name has special characters.\n Please remove them and try again.");
	Form.Name.select();
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
else if((Form.year.value < "<?php echo $maxage;?>") || (Form.year.value >"<?php echo $minage;?>"))
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
Form.Phone.select();
return false;
}
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
if(Form.Email.value!="")
{
	if (!validmail(Form.Email.value))
	{
		//alert("Please enter your valid email address!");
		Form.Email.select();
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
if((Form.Pincode.value=='PinCode') || (Form.Pincode.value=='') || Trim(Form.Pincode.value)==false)
{
alert("Kindly fill in your Pincode!");
Form.Pincode.select();
return false;
}
else if(Form.Pincode.value.length < 6)
{
alert("Kindly fill in your Pincode(6 Digits)!");
Form.Pincode.select();
return false;
}
else if(containsalph(Form.Pincode.value)==true)
{
alert("Kindly fill in your Correct Pincode (Numeric Only)!");
Form.Pincode.select();
return false;
}
if((Form.Property_Value.value=='')  || Trim(Form.Property_Value.value)==false)
{
alert("Kindly fill in your Property Value!");
Form.Property_Value.focus();
return false;
}

 if(Form.Employment_Status.selectedIndex==0)
{
	alert("Please select emplyment status ");
	Form.Employment_Status.focus();
	return false;
}

if((Form.IncomeAmount.value=='')||(Form.IncomeAmount.value=="Annual Income"))
{
	alert("Please enter Annual income to Continue");
	Form.IncomeAmount.select();
	return false;
}

 if((Form.Loan_Amount.value=='')||(Form.Loan_Amount.value=="Loan Amount"))
{
alert("Kindly fill in your Loan Amount (Numeric Only)!");
Form.Loan_Amount.select();
return false;
}
else if(containsalph(Form.Loan_Amount.value)==true)
{
alert("Loan Amount contains characters!");
Form.Loan_Amount.select();
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

if(Form.Std_Code.value=="std")
{
	Form.Std_Code.value=" ";
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

function HandleOnClose(filename) {
   if ((event.clientY < 0)) {
	
	   
	   myWindow = window.open(filename, "tinyWindow", 'resizable width=510,height=390, scrollbars')
	   myWindow.document.bgColor=""
	   myWindow.document.close() 
   }
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
			//alert("bye");
			var get_full_name = document.getElementById('Name').value;
			//var get_full_name = document.getElementById('full_name').value;
			
			var get_email = document.getElementById('Email').value;
			//var get_email = document.getElementById('email').value;		
			
			var get_mobile_no = document.getElementById('Phone').value;
			//var get_mobile_no = document.getElementById('mobile_no').value;
			
			var get_city = document.getElementById('City').value;
			
			var get_id = document.getElementById('Activate').value;
			//alert();
			var get_product ="5";

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
<table width="780" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="255" height="159" align="left" valign="top"><img src="images/lap-hdr1.gif" width="255" height="159" /></td>
        <td width="270" align="left" valign="top"><img src="images/lap-hdr2.gif" width="270" height="159" /></td>
        <td width="255" align="left" valign="top"><img src="images/lap-hdr3.gif" width="255" height="159" /></td>
      </tr>
      <tr>
        <td width="255" height="122" align="left" valign="top"><img src="images/lap-hdr4.gif" width="255" height="122" /></td>
        <td width="270" height="122" align="left" valign="top"><img src="images/lap-hdr5.gif" width="270" height="122" /></td>
        <td width="255" height="122" align="left" valign="top"><img src="images/lap-hdr6.gif" width="255" height="122" /></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>
	<table width="100%" border="0" align="right" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" style="border:1px solid #C6C6C6; border-bottom:none;">
      <tr>
        <td valign="top"><table width="100%" border="0" cellspacing="2" cellpadding="0">
          <tr>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="20" height="33" align="left" valign="top"><img src="images/lap-lft-img.gif" width="20" height="33" /></td>
                <td align="center" background="images/lap-panel-bg.gif" class="whtbold-text" style="font-size:12px;">3 Easy Steps </td>
                <td width="20" height="33" align="right"><img src="images/lap-rgt-img.gif" width="20" height="33" /></td>
              </tr>
              <tr>
                <td style="border-left:1px solid #3581BC;">&nbsp;</td>
                <td style="padding-top:5px;"><table width="90%" border="0" align="left" cellpadding="0" cellspacing="0">
                  <tr>
                    <td width="30" align="left"><img src="images/lap-arrow.gif" width="19" height="18" /></td>
                    <td height="30" class="stpbold-text">Post your Loan Against Property requirement.</td>
                  </tr>
                  <tr>
                    <td align="left"><img src="images/lap-arrow.gif" width="19" height="18" /></td>
                    <td height="30" class="stpbold-text">Get &amp; compare offers from all Banks.</td>
                  </tr>
                  <tr>
                    <td align="left"><img src="images/lap-arrow.gif" width="19" height="18" /></td>
                    <td height="30" class="stpbold-text">Go with the lowest bidder.</td>
                  </tr>
                </table></td>
                <td style="border-right:1px solid #3581BC;">&nbsp;</td>
              </tr>
              <tr>
                <td width="20" height="22" align="left" valign="top"><img src="images/lap-bot-img.gif" width="20" height="22" /></td>
                <td style="border-bottom:1px solid #3581BC;">&nbsp;</td>
                <td width="20" height="22" align="right" valign="top"><img src="images/lap-rgt-curv.gif" width="20" height="22" /></td>
              </tr>
            </table></td>
          </tr>
          <tr><td class="blue-text" style="padding-left:10px;
"><span class="bluebld-text">www.deal4loans.com</span><br />
              The one-stop shop for best on all loan requirements. Now get offers
from ICICI, HDFC, GE, Citifinancial and choose the best deal!<br />
-----------------------------------------------------------------------------------<br />
<span class="bluebld-text">Testimonials</span><br />    Blore Loan Against Property<br />
I am glad that i could get 3 quotes on my loan requirement within just 48 hrs that too w/o stepping out of home. I can now close out my property also. Only thing is that I came across your site accidentally- you should promote ur value-adding services better.. <div style="float:right; font-weight:bold; padding-right:5px">By lakshminarayan</div><br />
<br />
<span class="bluebld-text">
Why to opt Loan Against Property ?</span><br />
&bull; Capital requirement for Business.<br />
&bull; For your Child's marriage.<br />
&bull; Send your child for higher studies!<br />
&bull; Fund Medical Treatments.<br />
&bull; In Debt consolidation <br />
<br />
<span class="bluebld-text">Helpful Tips</span><br />
Compare with Banks for Loan amount is based on the value of<br />
property and your Income so do compare with banks on the loan<br />
amount .<br />
&bull; Interest rates .<br />
&bull; Processing Fees.<br />
&bull; Pre-payment/Foreclosure charges.<br />
&bull; Document required.<br />
&bull; Discuss your property location with bank so to know whether       it can be &nbsp;&nbsp;Mortgaged or not.<br />
<div style="float:right;"><a href="http://www.deal4loans.com/Contents_Loan_Against_Property_Mustread.php" target="_bank">Know more........</a></div></td>
          </tr>
        </table></td>
        <td width="350" align="right" valign="top"><table width="100%"   border="0" align="right" cellpadding="0" cellspacing="0">
          <tr>
            <td valign="top"><form name="loan_form" method="post" action="/thank_loanproperty.php" onSubmit="return submitform(document.loan_form);"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td width="13" height="22" align="left" valign="top"><img src="images/lap-form-top-lft-curve.gif" width="30" height="31" /></td>
                  <td height="31" align="center" valign="bottom" background="images/lap-form-tp-bg.gif" class="whtbold-text" style="font-size:12px;">Loan Against Property Request </td>
                  <td width="13" height="22" align="right" valign="top"><img src="images/lap-form-top-rgt-cuve.gif" width="30" height="31" /></td>
                </tr>
				<tr> <td align="left" valign="top" background="images/lap-form-lft-bg.gif" style="background-repeat:repeat-y;" >&nbsp;</td><td bgcolor="#087BBC">&nbsp;</td> <td height="22" align="right" valign="top"  background="images/lap-form-rgt-bg-img.gif" style="background-repeat:repeat-y;">&nbsp;</td></tr>
                <tr>
                  <td height="22" align="left" valign="top" background="images/lap-form-lft-bg.gif" style="background-repeat:repeat-y;">&nbsp;</td>
                  <td align="center" bgcolor="#087BBC" >

                      <table width="100%" border="0" cellpadding="0" cellspacing="2"   >
		<input type="hidden" name="referrer" value="<? echo $_REQUEST['referrer'] ?>">
		<input type="hidden" name="Type_Loan" value="Req_Loan_Against_Property">
		<input type="hidden" name="creative" value="<? echo $_REQUEST['creative'] ?>">	
		<input type="hidden" name="section" value="<? echo $_REQUEST['section'] ?>">
		<input type="hidden" name="source" value="google">
		<input type="hidden" name="last_id" value="<? echo 	$last_id ?>">
                        <tr>
                          <td width="50%" align="left" class="whtbold-text"   style="color:#FFFFFF;">Full Name </td>
                          <td width="50%" align="left"><input type="text"  <? if(isset($loan_type)) { ?>value="<? echo $name; ?>" <? }?> name="Name" id="Name"  onChange="insertData();" style="width:130px;" /></td>
                        </tr>
                        <tr>
                          <td width="44%" align="left" class="whtbold-text"  style="color:#FFFFFF;">DOB</td>
                          <td width="56%" align="left"><input type="text" name="day" value="dd"  id="day" size="4" maxlength="2" >
			<input name="month" id="month" size="4" maxlength="2"  value="mm" >
			<input name="year" type="text" id="year" value="yyyy" size="6" maxlength="4"></td>
                        </tr>
                        <tr>
                          <td align="left" class="whtbold-text"  style="color:#FFFFFF;">Mobile No.                             </td>
                          <td align="left"><input type="text" name="Phone" id="Phone" <? if(isset($loan_type)) { ?>value="<? echo $mobile; ?>" <? }?>  onChange="intOnly(this);insertData();" maxlength="10" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" style="width:130px;" /></td>
                        </tr>
                        <tr>
                          <td align="left" class="whtbold-text"  style="color:#FFFFFF;">Email ID </td>
                          <td align="left"><input type="text" <? if(isset($loan_type)) { ?>value="<? echo $Email; ?>" <? }?> name="Email" id="Email"  onChange="insertData();" style="width:130px;" /></td>
                        </tr>
						
                       <!-- <tr>
                          <td align="left" class="whtbold-text"  style="color:#FFFFFF;">Residence<br />
                            Address</td>
                          <td align="left"><textarea rows="3" name="Residence_Address" cols="18" style="width:130px;"> </textarea></td>
                        </tr>-->
                        <tr>
                          <td align="left" class="whtbold-text"  style="color:#FFFFFF;">City</td>
                          <td align="left"> <select size="1" style="width:132px;"  name="City" id="City" onChange="othercity1(this); tataaig_comp(); insertData();">
		 <? echo getCityList($City); ?> </select>		 </td>
                        </tr>
                        <tr>
                          <td align="left" class="whtbold-text"  style="color:#FFFFFF;">Other City </td>
                          <td align="left"><input type="text" disabled value="Other City"   name="City_Other" style="width:130px;"  >				            </tr>
                        <tr>
                          <td align="left" class="whtbold-text"  style="color:#FFFFFF;">Pincode</td>
                          <td align="left"><input type="text"  maxlength="6" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" onfocus="this.select();" name="Pincode"  style="width:130px;"  /></td>
                        </tr>
						<tr><td align="left" class="whtbold-text"  style="color:#FFFFFF;">Value Of Property</td> <td align="left"><input type="text" name="Property_Value"   onKeyPress="intOnly(this);" onKeyUp="intOnly(this);" style="width:130px;"></td></tr>
                        <tr>
                          <td align="left" class="whtbold-text"  style="color:#FFFFFF;">Employment Status</td>
                          <td align="left"><select  name="Employment_Status" style="width:132px;">
				<option selected value="-1">Employment Status</option>
				<option  value="1">Salaried</option>
				<option value="0">Self Employed</option>
				</select></td>
                        </tr>
                        <tr>
                          <td align="left" class="whtbold-text"  style="color:#FFFFFF;">Annual
                            Income</td>
                          <td align="left"><input type="text" name="IncomeAmount" id="IncomeAmount" onfocus="this.select();" onChange="intOnly(this);"  onKeyUp="intOnly(this); getDigitToWords('IncomeAmount','formatedIncome','wordIncome');" onKeyPress="intOnly(this); getDigitToWords('IncomeAmount','formatedIncome','wordIncome');"  onKeyDown="getDigitToWords('IncomeAmount','formatedIncome','wordIncome');" onblur="getDigitToWords('IncomeAmount','formatedIncome','wordIncome'); " style="width:130px;"> </td>
                        </tr>
						<tr><td colspan="2" align="left"><span id='formatedIncome' style='font-size:11px;
		font-weight:bold;color:#FFFFFF;font-Family:Verdana;'></span><span id='wordIncome' style='font-size:11px;
		font-weight:bold;color:#FFFFFF;font-Family:Verdana;text-transform: capitalize;'></span></td></tr>
                        <tr>
                          <td align="left" class="whtbold-text"  style="color:#FFFFFF;">Loan Amount</td>
                          <td align="left"><input type="text" id ="Loan_Amount" name="Loan_Amount" onfocus="this.select();" class="style4"onChange="intOnly(this);"  onKeyUp="intOnly(this); getDigitToWords('Loan_Amount','formatedloanamt','wordloanamt');" onKeyPress="intOnly(this); getDigitToWords('Loan_Amount','formatedloanamt','wordloanamt');" style="float:left; width:130px;"  onKeyDown="getDigitToWords('Loan_Amount','formatedloanamt','wordloanamt');" onblur="getDigitToWords('IncomeAmount','formatedIncome','wordIncome'); "  /></td>
                        </tr>
						<tr><td colspan="2" align="left"><span id='formatedloanamt' style='font-size:11px;
		font-weight:bold;color:#FFFFFF;font-Family:Verdana;'></span><span id='wordloanamt' style='font-size:11px;
		font-weight:bold;color:#FFFFFF;font-Family:Verdana;text-transform: capitalize;'></span></td></tr>
		<tr><td colspan="2" align="left" valign="bottom" id="tataaig_compaign" class="wht-text"></td></tr>
                        <tr>
                          <td colspan="2" align="left" valign="bottom" ><input type="checkbox"  name="accept" checked="checked" style="border:none;" />
                            <font class="wht-text">I have read the <a href="http://www.deal4loans.com/Privacy.php" target="_blank"  class="wht-text">Privacy Policy</a> and agree to the Terms And Condition.</font></td>
                        </tr>

                        <tr>
                          <td height="25" colspan="2" align="center" valign="bottom">&nbsp;</td>
                        </tr>
                      </table>
                      <input name="submit" type="image" src="images/sbt-btn.gif"  width="126px" height="48px" style="border:none;" />
</td>
                  <td height="22" align="right" valign="top"  background="images/lap-form-rgt-bg-img.gif" style="background-repeat:repeat-y;">&nbsp;</td>
                </tr>
                <tr>
                  <td width="30" align="left" valign="top"><img src="images/lap-form-bottom-lft-curve.gif" width="30" height="31" /></td>
                  <td  align="center" valign="bottom" background="images/lap-form-bottom-bg.gif" >&nbsp;</td>
                  <td width="30" align="right" valign="top"><img src="images/lap-form-bottom-rgt-curve.gif" width="30" height="31" /></td>
                </tr>
            </table>                  </form></td>
          </tr>
          
        </table></td>
      </tr>
      
      
    </table></td>
  </tr>
 
  <tr>
    <td><img src="images/lap-bot-panle.gif" width="780" height="22" /></td>
  </tr>
</table>
</body>
</html>
