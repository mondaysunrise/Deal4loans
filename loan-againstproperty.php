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
<meta name="keywords" content="loan against property India,housing mortage loan india, loan against property India, apply for loan against property, loan against property eligibility,loan against property documents">
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
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
}function submitform(Form)
{
var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
var dt,mdate;dt=new Date();

var alpha=/^[a-zA-Z\ ]*$/;
var alphanum=/^[a-zA-Z0-9]*$/;
var num=/^[0-9]*$/;
var space=/^[\ ]*$/;
var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";
var j;
var cnt=-1;
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
  }if((space.test(Form.day.value)) || (Form.day.value=="dd"))
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
}if((Form.Phone.value=='Mobile') || (Form.Phone.value=='') || Trim(Form.Phone.value)==false)
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
	
}if(Form.City.selectedIndex==0)
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
if((Form.Property_Value.value==''))
{
alert("Kindly fill in your Property Value (Numeric Only)!");
Form.Property_Value.select();
return false;
}

if(Form.Employment_Status.value==0)
	{
	
for(j=0; j<Form.surrogate.length; j++) 
	{
	
        if(Form.surrogate[j].checked)
		{
			
   	 		cnt= j;
		}
	}
		if(cnt == -1) 
		{
			alert("please select you have any existing loan / credit card");
			return false;
		}
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


function addsurrogate()
{
	var ni1 = document.getElementById('myDiv2');
		
	if(document.getElementById('Employment_Status').value==0)
	{
		ni1.innerHTML = '<table border="0" width="100%"><tr>	<td width="180">Do you have any existing Loan / Credit Card ?</td><td><input type="radio" name="surrogate" id="surrogate" value="1" style="border:none;" />Yes&nbsp;&nbsp;<input type="radio"  name="surrogate" id="surrogate" value="2" style="border:none;" />No</td></tr></table>';
	}
	else
	{	ni1.innerHTML ='';

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
			//alert("bye");
			var get_full_name = document.getElementById('Name').value;
			
			//alert(get_full_name);
			var get_email = document.getElementById('Email').value;
			
			//alert (document.getElementById('Phone').value);
			var get_mobile_no = document.getElementById('Phone').value;
			//alert (get_mobile_no);
			//alerty(get_mobile_no);
			var get_city = document.getElementById('City').value;
			//alert(get_city);
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

	window.onload = ajaxFunctionMain;</script>
</head><body>
<table width="780" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="206" height="139" align="left" valign="top"><img src="images/lap-header1.gif" width="206" height="139" /></td>
            <td width="168" height="139" align="left" valign="top"><img src="images/lap-header2.gif" width="168" height="139" /></td>
            <td width="200" height="139" align="left" valign="top"><img src="images/lap-header3.gif" width="200" height="139" /></td>
          </tr>
          <tr>
            <td width="206" height="122" align="left" valign="top"><img src="images/lap-header4.gif" width="206" height="122" /></td>
            <td width="168" height="122" align="left" valign="top"><img src="images/lap-header5.gif" width="168" height="122" /></td>
            <td width="200" height="122" align="left" valign="top"><img src="images/lap-header6.gif" width="200" height="122" /></td>
          </tr>
        </table></td>
        <td width="206" height="261" align="right" valign="top"><img src="images/lap-right-hdr.gif" width="206" height="261" /></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF"  style="border:1px solid #C6C6C6; border-bottom:none; border-top:none;">
	<table width="100%" border="0" align="right" cellpadding="0" cellspacing="0"  >
      <tr>
        <td width="450"  valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="99" valign="top" background="images/lap-step-bg.gif" ><table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                  <td width="38%"  valign="middle" class="blue-text" style="padding-top:35px;">Post your Loan Against Property requirement</td>
                  <td width="38%" class="blue-text" style="padding-top:35px;">Get &amp; Compare Offers<br />
                    from all Banks</td>
                  <td width="24%" class="blue-text" style="padding-top:35px;">Go with the Best<br />
                    Bid</td>
                </tr>
            </table></td>
          </tr>
          <tr>
				<td class="blue-text" style="padding-left:8px; padding-top:10px;" ><span class="bluebld-text">www.deal4loans.com</span><br />
              The one-stop shop for best on all loan requirements. Now get offers
              from <b>ICICI Bank</b>, <b>IDBI Bank</b>, <b>HDFC</b>, <b>SBI</b>,<b> Citibank </b>,<b> Axis Bank</b> and Choose the Best Deal!<br />
              -----------------------------------------------------------------------------------<br />
              <span class="bluebld-text"> Why to opt for Loan Against Property ?</span><br />
              &bull; Capital requirement for Business.<br />
              &bull; For your Child's marriage.<br />
              &bull; Send your Child for higher studies!<br />
              &bull; Fund Medical Treatments.<br />
              &bull; In Debt consolidation <br />
              <br />
              <span class="bluebld-text">Helpful Tips</span><br />
              Please ensure that you compare your Loan Against Property
bid from various Banks on the following parameters:<br />
              &bull; Interest rates .<br />
              &bull; Processing Fees.<br />
              &bull; Pre-payment/Foreclosure charges.<br />
              &bull; Documents required.<br />
              &bull; Is your Propety located in an approved location.<br />
              <div style="float:right;"><a href="http://www.deal4loans.com/Contents_Loan_Against_Property_Mustread.php" target="_bank">Know more........</a></div></td>
          </tr>
		  <!------------------>
		 
		  
		  <!--------------->
        </table></td>
        <td align="right" valign="top"><table width="100%"   border="0" align="right" cellpadding="0" cellspacing="0">
          
		  <tr>
		    <td width="317" height="80" align="center" class="whtbold-text" valign="bottom" background="images/lap-form-bg.gif" style="background-repeat:no-repeat; background-position:center; font-size:14px; color:#5E5509;">Loan Against Property Request </td>
		    </tr>
			  <!--<tr>
		   <td  class="whtbold-text" align="center" valign="bottom" background="images/lap-form-bot-bg.gif" style="background-repeat:repeat-y; background-position:center; padding-top:15px; color:#5E5509;"> Step 1 of 2</td>
			
		    </tr>-->
		  <tr>
		 
		    <td align="center" valign="bottom" background="images/lap-form-bot-bg.gif" style="background-repeat:repeat-y; background-position:center; padding-top:15px;">
			<form name="loan_form" method="post" action="/loan_against_property_continue.php" onSubmit="return submitform(document.loan_form);">
			<table width="85%" border="0" align="center" cellpadding="0" cellspacing="2"   >
			<tr><td align="center" colspan="2"><font face="Verdana, Arial, Helvetica, sans-serif" color="#FF0000"><strong><?php if(isset($_GET['msg'])) echo "Kindly give Valid Details"; ?></strong></font>
	</td></tr>
	<input type="hidden" name="PostURL" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
              <input type="hidden" name="referrer" value="<? echo $_REQUEST['referrer'] ?>" />
              <input type="hidden" name="Type_Loan" value="Req_Loan_Against_Property" />
              <input type="hidden" name="creative" value="<? echo $_REQUEST['creative'] ?>" />
              <input type="hidden" name="section" value="<? echo $_REQUEST['section'] ?>" />
              <input type="hidden" name="source" value="LAP Rates SEO" />
			  <input type="hidden" name="Activate" id="Activate" />
              <input type="hidden" name="last_id" value="<? echo 	$last_id ?>" />
              <tr>
                <td width="50%" height="23" align="left" class="whtbold-text"   style="color:#5E5509;">Full Name </td>
                <td width="56%" align="left"><input type="text"  <? if(isset($loan_type)) { ?>value="<? echo $name; ?>" <? }?> name="Name" id="Name"  onchange="insertData();" style="width:130px;" /></td>
              </tr>
              <tr>
                <td width="50%" height="23" align="left" class="whtbold-text"  style="color:#5E5509;">DOB</td>
                <td width="56%" align="left"><input type="text" name="day" value="dd"  id="day" size="4" maxlength="2">
                    <input name="month" id="month" size="4" maxlength="2"  value="mm">
                    <input name="year" type="text" id="year" value="yyyy" size="6" maxlength="4" /></td>
              </tr>
              <tr>
                <td height="23" align="left" class="whtbold-text"  style="color:#5E5509;">Mobile No. </td>
                <td align="left"><input type="text" name="Phone" id="Phone" <? if(isset($loan_type)) { ?>value="<? echo $mobile; ?>" <? }?>  onchange="intOnly(this);insertData();" maxlength="10" onkeyup="intOnly(this);" onkeypress="intOnly(this);" style="width:130px;" /></td>
              </tr>
              <tr>
                <td height="23" align="left" class="whtbold-text"  style="color:#5E5509;">Email ID </td>
                <td align="left"><input type="text" <? if(isset($loan_type)) { ?>value="<? echo $Email; ?>" <? }?> name="Email" id="Email"  onchange="insertData();" style="width:130px;" /></td>
              </tr>
              <!-- <tr>
                          <td align="left" class="whtbold-text"  style="color:#FFFFFF;">Residence<br />
                            Address</td>
                          <td align="left"><textarea rows="3" name="Residence_Address" cols="18" style="width:130px;"> </textarea></td>
                        </tr>-->
              <tr>
                <td height="23" align="left" class="whtbold-text"  style="color:#5E5509;">City</td>
                <td align="left"><select size="1" style="width:132px;"  name="City" id="City" onchange="othercity1(this); addibibo(); insertData();">
                    <? echo getCityList($City); ?>
                  </select>                </td>
              </tr>
              <tr>
                <td height="23" align="left" class="whtbold-text"  style="color:#5E5509;">Other City </td>
                <td align="left"><input type="text" disabled="disabled" value="Other City"   name="City_Other" style="width:130px;">                </td>
              </tr>
                <tr>
                <td height="23" align="left" class="whtbold-text"  style="color:#5E5509;">Employment Status</td>
                <td align="left">        <select  name="Employment_Status" id="Employment_Status" style="width:132px;" onchange="addsurrogate();">
				<option selected value="-1">Please Select</option>
				<option  value="1">Salaried</option>
				<option value="0">Self Employed</option>
				</select></td>
              </tr>
            
              <tr>
                <td height="23" align="left" class="whtbold-text"  style="color:#5E5509;">Annual
                  Income</td>
                <td align="left"><input type="text" name="IncomeAmount" id="IncomeAmount" onfocus="this.select();" onchange="intOnly(this);"  onkeyup="intOnly(this); getDigitToWords('IncomeAmount','formatedIncome','wordIncome');" onkeypress="intOnly(this); getDigitToWords('IncomeAmount','formatedIncome','wordIncome');"  onkeydown="getDigitToWords('IncomeAmount','formatedIncome','wordIncome');" onblur="getDigitToWords('IncomeAmount','formatedIncome','wordIncome'); " style="width:130px;" />                </td>
              </tr>
              <tr>
                <td colspan="2" align="left"><span id='formatedIncome' style='font-size:11px;
		font-weight:bold;color:#5E5509;font-Family:Verdana;'></span><span id='wordIncome' style='font-size:11px;
		font-weight:bold;color:#5E5509;font-Family:Verdana;text-transform: capitalize;'></span></td>
              </tr>
                     
              <tr>
                <td height="23" align="left" class="whtbold-text"  style="color:#5E5509;">Loan Amount</td>
                <td align="left"><input type="text" id ="Loan_Amount" name="Loan_Amount" onfocus="this.select();" class="style4"onChange="intOnly(this);"  onKeyUp="intOnly(this); getDigitToWords('Loan_Amount','formatedloanamt','wordloanamt');" onKeyPress="intOnly(this); getDigitToWords('Loan_Amount','formatedloanamt','wordloanamt');" style="float:left; width:130px;"  onKeyDown="getDigitToWords('Loan_Amount','formatedloanamt','wordloanamt');" onblur="getDigitToWords('Loan_Amount','formatedloanamt','wordloanamt'); "  /></td>
              </tr> 
              <tr>
                <td colspan="2" align="left"><span id='formatedloanamt' style='font-size:11px;
		font-weight:bold;color:#5E5509;font-Family:Verdana;'></span><span id='wordloanamt' style='font-size:11px;
		font-weight:bold;color:#5E5509;font-Family:Verdana;text-transform: capitalize;'></span></td>
              </tr>
			   <tr>
                <td height="23" align="left" class="whtbold-text"  style="color:#5E5509;">Property Value </td>
                <td align="left"><input type="text" name="Property_Value"  style="width:130px;" onkeypress="intOnly(this);" onkeyup="intOnly(this);" />                </td>
              </tr>
			     <tr>
                <td height="50" align="left" class="whtbold-text"  style="color:#5E5509;" colspan="2">
				<div id="myDiv2" width="100%" >
				</div>
				</td>
             </tr>
			
              <tr>
                <td colspan="2" align="left" valign="bottom"  ><input type="checkbox"  name="accept" checked="checked" style="border:none;" />
                    <font class="wht-text" style="color:#5E5509;">I authorize Deal4loans.com & its partnering banks to contact me to explain the product & I Agree to <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow">privacy policy</a> and <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow">Terms and Conditions</a>.</font><br /></td>
              </tr>
			  
			 
              <tr>
                <td height="25" colspan="2" align="center" valign="bottom"><input name="submit" type="image" src="images/lap-form-sbt.gif"  width="123px" height="43px" style="border:none;" /></td>
              </tr>
			  
            </table>
			</form>			</td>
		    </tr>
		  <tr>
		  <td align="center" valign="bottom" background="images/lap-form-bot-bg.gif" style="background-repeat:repeat-y; background-position:center;"><img src="images/lap-form-bot.gif" width="300" height="11" /></td>
		  </tr>
		
          
          
        </table></td>
      </tr>
    </table></td>
  </tr>
 
   <tr>
            <td class="blue-text" style="padding-left:8px; padding-top:10px; border:1px solid #C6C6C6; border-bottom:none; border-top:none;" ><span class="bluebld-text">Testimonials</span><br />
              Blore Loan Against Property<br />
              I am glad that i could get 3 quotes on my loan requirement within just 48 hrs that too w/o stepping out of home. I can now close out my property also. Only thing is that I came across your site accidentally- you should promote ur value-adding services better..
              <div style="float:right; font-weight:bold; padding-right:5px">By lakshminarayan</div></td>
		  </tr>
  <tr>
    <td><img src="images/lap-bot-panle.gif" width="780" height="22" /></td>
  </tr>
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
