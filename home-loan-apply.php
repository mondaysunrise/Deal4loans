<?php
	require 'scripts/session_check.php';
     //require 'scripts/db_init.php';
	require 'scripts/functions.php';
	//session_start();
	 $page_name = "Home Loan";
	?>
<html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Home Loans India Apply Compare | Housing Mortage Loan</title>
<meta name="keywords" content="Home loans India, Apply Home Loans, Compare Home Loans in Mumbai Hyderabad Pune kolkata Delhi Noida Bangalore">
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<script language="JavaScript" type="text/javascript" src="suggest.js"></script>
<link rel="stylesheet" href="home_style.css" type="text/css" />
<style type="text/css">
.qote{
	background-image:url(new-images/hl-quote.gif) ;
	background-repeat:no-repeat ;
	width:127px ;
	height:33px ;
	font-size:0px;
	color:#f4efe0;
	}
.bnksname{
	font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:11px;
	color:#403c3c;
	font-weight:bold;
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
</script>
  		
			
 <SCRIPT LANGUAGE="JavaScript">
  <!--
 /*function func()
 {
  document.getElementById("onCloseValue").value= "0";
 }
 
 window.onbeforeunload = function(e){
  if(document.getElementById("onCloseValue").value == "1")
  {
    	window.open("closedby_hl.php", "tinyWindow", 'width=510,height=390, scrollbars')
  }
 }*/
  //-->
 /* function tataaig_comp()
{
	//alert("hello");
	var ni = document.getElementById('tataaig_compaign');
		
		if(ni.innerHTML=="")
		{
			if(document.home_loan.City.value=="Delhi" || document.home_loan.City.value=='Delhi' || document.home_loan.City.value=='Noida'  ||  document.home_loan.City.value=='Gurgaon'  ||  document.home_loan.City.value=='Faridabad'  ||  document.home_loan.City.value=='Gaziabad'  ||  document.home_loan.City.value=='Faridabad'  ||  document.home_loan.City.value=='Greater Noida'  || document.home_loan.City.value=='Chennai'  ||  document.home_loan.City.value=='Mumbai'  ||  document.home_loan.City.value=='Thane'  ||  document.home_loan.City.value=='Navi mumbai'  ||  document.home_loan.City.value=='Kolkata'  ||  document.home_loan.City.value=='Kolkota'  ||  document.home_loan.City.value=='Hyderabad'  ||  document.home_loan.City.value=='Pune'  || document.home_loan.City.value=='Bangalore')
			{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '<input type="checkbox"  class="NoBrdr" name="Accidental_Insurance" id="Accidental_Insurance" value="1" style="border:none;" checked>&nbsp;<a href="tata-aig-personal-accident-cover.php" target="_blank" style="color:#3A0D04;" >Get free personal accident insurance from TATA AIG</a>';
			}
			else 
			{
			//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '';
			}
			
		}
		else if(ni.innerHTML!="")
		{
			if(document.home_loan.City.value=="Delhi" || document.home_loan.City.value=='Delhi' || document.home_loan.City.value=='Noida'  ||  document.home_loan.City.value=='Gurgaon'  ||  document.home_loan.City.value=='Faridabad'  ||  document.home_loan.City.value=='Gaziabad'  ||  document.home_loan.City.value=='Faridabad'  ||  document.home_loan.City.value=='Greater Noida'  || document.home_loan.City.value=='Chennai'  ||  document.home_loan.City.value=='Mumbai'  ||  document.home_loan.City.value=='Thane'  ||  document.home_loan.City.value=='Navi mumbai'  ||  document.home_loan.City.value=='Kolkata'  ||  document.home_loan.City.value=='Kolkota'  ||  document.home_loan.City.value=='Hyderabad'  ||  document.home_loan.City.value=='Pune'  || document.home_loan.City.value=='Bangalore')
			{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '<input type="checkbox"  class="NoBrdr" name="Accidental_Insurance" id="Accidental_Insurance" value="1" style="border:none;" checked>&nbsp;<a href="tata-aig-personal-accident-cover.php" target="_blank"  style="color:#3A0D04;">Get free personal accident insurance from TATA AIG</a>';
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


  </SCRIPT>
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
<table width="600" border="0" align="center" cellpadding="0" cellspacing="0" style="border:5px solid #E9DCB4; background-color:#F4EFE0;">
  <tr>
    <td style="padding:5px;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="150" height="55" align="center" valign="middle" >
			<img src="images/hl_logo.gif" width="140" height="45" /></td>
            <td width="420" align="left" valign="middle" style="font-family:Verdana, Arial, Helvetica, sans-serif; color:#3A0303; font-size:13px; text-decoration:none; font-weight:bold;	">Home Loans by choice not by chance!!</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="197" height="160" align="left" valign="top"><img src="images/hl_headr_lft.jpg" width="197" height="160" /></td>
            <td width="175" align="left"><img src="images/hl_header-mdl.jpg" width="175" height="160" /></td>
            <td width="208"><img src="images/hl_header_rgt.jpg" width="208" height="160" /></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td style="padding-top:5px;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="center" valign="top" background="images/hl_rgt-tp-bg.gif" style="background-repeat:no-repeat; width:272px; height:44px; background-position:top;"><table width="100%" height="260" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td style="padding-bottom:5px;"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                      <tr>
                        <td height="40" align="center" class="heading">Just 3 easy steps!</td>
                      </tr>
                      <tr>
                        <td align="center" style="background-color:#EFE6CB; border:3px solid #FFFFFF; border-top:none; padding-bottom:4px; "><table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
                            <tr>
                              <td width="16" height="20" align="left" valign="middle"><img src="images/hl_arrow.gif" width="11" height="9" /></td>
                              <td width="245" class="formtext"><b> Post your Home Loan requirement</b></td>
                            </tr>
                            <tr>
                              <td width="16" height="20" align="left" valign="middle"><img src="images/hl_arrow.gif" width="11" height="9" /></td>
                              <td class="formtext"><b> Get &amp; Compare Home Loan Offers</b></td>
                            </tr>
                            <tr>
                              <td width="16" height="19" align="left" valign="middle"><img src="images/hl_arrow.gif" width="11" height="9" /></td>
                              <td class="formtext"><b> Get the Best Deal for your Home Loan</b></td>
                            </tr>
                        </table></td>
                      </tr>
                  </table></td>
                </tr>
                <tr>
                  <td  style="padding:5px 0px; background-color:#EFE6CB; border:3px solid #FFFFFF;"><table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" >
                      <tr>
                        <td height="30" align="center" valign="top" class="heading">www.deal4loans.com</td>
                      </tr>
                      <tr>
                        <td class="text" style="padding-bottom:3px;">The one-stop shop for Best on Home Loan<br />
              requirements Now Get Offers from Major Banks</td>
                      </tr>
                     
                      <tr>
                        <td align="left"  class="text"></td>
                      </tr>
                      <tr>
                        <td height="25" align="right" class="formtext" style="text-align:right; " ><b>www.deal4loans.com</b></td>
                      </tr>
                  </table></td>
                </tr>
            </table></td>
            <td width="">&nbsp;</td>
			
            <td width="303" align="left" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td height="600" align="center" valign="middle" background="images/hl_form_bg.gif" style="background-repeat:no-repeat; width:303px; height:44px; background-position:top;"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                      <tr>
                        <td height="40" align="center" class="heading">Home Loan Quotes </td>
                      </tr>
                      <tr>
                        <td align="center" style="background-color:#EFE6CB; border:3px solid #FFFFFF; border-top:none; "><form name="home_loan" action="home-loan-apply-continue.php" onSubmit="return submitform(document.home_loan);" method="post">
                            <table width="93%" border="0" align="right" cellpadding="0" cellspacing="0">
                              <tr>
                                <td width="166" height="26" align="left" valign="middle" class="formtext"><b>First Name</b></td>
                                <td width="166" class="formtext"><INPUT TYPE="hidden" NAME="onCloseValue" id="onCloseValue" value="1">
                                    <input type="text" name="Name" id="Name" style="width:140px;"/></td>
                              </tr>
                              <tr>
                                <td width="166" height="26" align="left" valign="middle" class="formtext"><b>Mobile</b></td>
                                <td class="formtext"><font class="style4">+91</font>
                                    <input name="Phone" id="Phone" type="text"  <? if(isset($loan_type)) { ?>value="<? echo $mobile; ?>" <? }else {?>value="Mobile No" <? }?>style="width:110px; margin-top:2px;" onChange="intOnly(this); tosendsms(); insertData();" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" onFocus="addtooltip();" maxlength="10" />
                                </td>
                              </tr>
                              <tr>
                                <td   colspan="2" align="left" valign="middle" class="formtext"><div id="myDiv1" style="color:#7d0606; font-family:Verdana; font-size:11px; font-weight:normal;  padding-bottom:3px;"></div></td>
                              </tr>
                              <tr>
                                <td height="26" align="left" valign="middle" class="formtext"><b>Email Id</b></td>
                                <td class="formtext"><input class="style4" style="width:140px;" value="<? if(isset($loan_type)) echo $Email; else "Email Id" ?>" name="Email" id="Email" onBlur="onBlurDefault(this,'Email Id');"  onFocus="removetooltip();" onChange="insertData();">
                                </td>
                              </tr>
                              <tr>
                                <td height="26" align="left" valign="middle" class="formtext"><b>City</b></td>
                                <td class="formtext"><select size="1" align="left" style="width:140"  name="City" id="City" onChange="insertData(); othercity1(this); " />
                                  
                                    <?=getCityList1($City)?>
                                </td>
                              </tr>
                              <tr>
                                <td height="26" align="left" valign="middle" class="formtext"><b>Other City </b></td>
                                <td class="formtext"><input disabled value="Other City"  name="City_Other" id="City_Other" style="width: 140px;" onFocus="onFocusBlank(this,'Other City');"  onBlur="onBlurDefault(this,'Other City');" onKeyUp="searchSuggest();" />
                  <div id="CityOLayer"></div>
                                </td>
                              </tr>
                              <tr>
                                <td width="166" height="26" align="left" valign="middle" class="formtext"><b>Net Salary</b></td>
                                <td class="formtext"><input value="Annual Income" name="IncomeAmount" id="IncomeAmount" onFocus="this.select();" onChange="intOnly(this);"  onKeyUp="intOnly(this); getDigitToWords('IncomeAmount','formatedIncome','wordIncome');" onKeyPress="intOnly(this); getDigitToWords('IncomeAmount','formatedIncome','wordIncome');" style="width:140px;" onBlur="getDigitToWords('IncomeAmount', 'formatedIncome', 'wordIncome'); onBlurDefault(this,'Annual Income');">
                                </td>
                              </tr>
                              <tr>
                                <td width="166" align="left" valign="middle" class="formtext" colspan="2"><span id='formatedIncome' style='font-family: Verdana, Arial, Helvetica, sans-serif;	font-size:11px;	color:#3A0D04; text-decoration:none; font-weight:bold; text-align:left;'></span><span id='wordIncome' style='font-family: Verdana, Arial, Helvetica, sans-serif;	font-size:11px;	color:#3A0D04; text-decoration:none; font-weight:bold; text-align:left;'></span> </td>
                              </tr>
                              <tr>
                                <td height="26" align="left" valign="middle" class="formtext"><b>Loan Amount </b></td>
                                <td class="formtext"><input value="Loan Amount" name="Loan_Amount"  id="Loan_Amount" onFocus="this.select();" class="style4"onChange="intOnly(this);"  onKeyUp="intOnly(this); getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" onKeyPress="intOnly(this); getDigitToWords('Loan_Amount', 'formatedlA','wordloanAmount');" style="width:140px;" onKeyDown="getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" onBlur="getDigitToWords('Loan_Amount', 'formatedlA', 'wordloanAmount'); onBlurDefault(this,'Loan Amount');">
                                    <input type="hidden" name="referrer" value="<? echo $_REQUEST['referrer'] ?>">
                                    <input type="hidden" name="Type_Loan" value="Req_Loan_Home">
                                    <input type="hidden" name="creative" value="<? echo $_REQUEST['creative'] ?>">
                                    <input type="hidden" name="section" value="self">
                                    <input type="hidden" name="source" value="Home Loan1">
                                    <input type="hidden" name="last_id" value="<? echo $last_id; ?>">
                                    <input type="hidden" name="PostURL" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
                                </td>
                              </tr>
                              <tr>
                                <td colspan="2" align="left" valign="middle" class="formtext"><span id='formatedlA' style='font-family: Verdana, Arial, Helvetica, sans-serif;	font-size:11px;	color:#3A0D04; text-decoration:none; font-weight:bold; text-align:left;'></span><span id='wordloanAmount' style='font-family: Verdana, Arial, Helvetica, sans-serif;	font-size:11px;	color:#3A0D04; text-decoration:none; font-weight:bold; text-align:left;'></span> </td>
                              </tr>
                              <tr>
                                <td colspan="2" class="subheading" style="font-weight:normal; color:#3A0D04;" id="tataaig_compaign" ></td>
                              </tr>
                              <tr>
                                <td height="20" colspan="2" align="left" valign="middle"><input type="hidden" name="Activate" id="Activate" >
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                      <tr>
                                        <td width="11%" style="Font-size:9px;" colspan="2" class="formtext"><input type="checkbox" name="accept" style="border:none;" checked> I authorize Deal4loans.com & its partnering Banks to call me with reference to my loan application  & Agree to <a href="http://www.deal4loans.com/Privacy.php" target="_blank">Privacy Policy</a> and <a href="http://www.deal4loans.com/Privacy.php" target="_blank">Terms and Conditions.</a></td>
                                      </tr>
                                  </table></td>
                              </tr>
                              <tr>
                                <td height="50" colspan="2" align="center" valign="middle"><input value="Get Quotes" name="submit" type="submit" class="qote" border="0" style="border:none;" /></td>
                              </tr>
                            </table>
                        </form></td>
                      </tr>
                  </table></td>
                </tr>
                <tr>
                  <td  style="padding:5px 0px; "><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td style="background-color:#EFE6CB; border:3px solid #FFFFFF; padding:5px 0px; "><table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" >
                            <tr>
                              <td height="30" align="center" valign="top" class="heading">Testimonials</td>
                            </tr>
                            <tr>
                              <td class="text">I am glad that i could get 3 quotes on my loan requirement instantly that too w/o stepping out of home. I can now close out my property also. Only thing is that I came across your site accidentally- you should promote ur value-adding services better.. </td>
                            </tr>
                            <tr>
                              <td align="left"  class="text"></td>
                            </tr>
                            <tr>
                              <td align="right" valign="middle" ><b class="subheading" style=" text-decoration:none;">- By Jeffrey</b></td>
                            </tr>
                        </table></td>
                      </tr>
                  </table></td>
                </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
	 
	  
      <tr>
        <td valign="top" style=" background-color:#EFE6CB; border:3px solid #FFFFFF;"><table width="97%" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
              <td height="33" align="left" class="heading">Helpful tips <span class="subheading" style=" font-style:normal;">to Get the Best Home Loan Deal</span></td>
            </tr>
            <tr>
              <td class="text">Home loans are provided based on the market value, mainly estimation given by banks or the registration value of the property. Home loan is not a one-time decision; do review the market periodically before availing them. Customers tend to make mistakes while entering into deals, which may not be beneficial for them, so better compare all the variables before signing a loan agreement by different banks. The various parameters that you need to compare on Home loan are</td>
            </tr>
            <tr>
              <td height="25" align="right" valign="top"  style="padding :8px 0px;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td class="subheading" style="line-height:16px;">&raquo; Eligibility <br />
&raquo; Interest rates best suited. <br />
&raquo; Fixed interest loans or Floating. <br />
&raquo; Other costs. <br />
&raquo; Document required. <br />
&raquo; Penalties. </td>
                    </tr>
              </table></td>
            </tr>
        </table></td>
      </tr>
    </table></td>
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
