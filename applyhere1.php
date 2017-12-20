<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';

	$Msg = "";
	if($_SESSION['UserType']== "bidder")
	{
	$Msg = getAlert("Sorry!!!! You are not Authorised to Apply for Loan.", TRUE, "index.php");
	echo $Msg;
	}
	$name = $_SESSION['Temp_Name'] ;
	$last_id = $_SESSION['Temp_Last_Inserted'] ;
	$mobile = $_SESSION['Temp_mobile'] ;
	$Email=	$_SESSION['Temp_email'] ;
	$loan_type = $_SESSION['Temp_loan_type'] ;
	
	if($_SESSION['Temp_loan_type'] == "Req_Loan_Against_Property")
		$file_name = "closedby_lap.php";
	else if($_SESSION['Temp_loan_type'] == "Req_Loan_Car")
		$file_name = "closedby_cl.php";
	else if($_SESSION['Temp_loan_type'] == "Req_Loan_Personal")
		$file_name = "closedby_pl.php";
	else if($_SESSION['Temp_loan_type'] == "Req_Loan_Home")
		$file_name = "closedby_hl.php";
	else if($_SESSION['Temp_loan_type'] == "Req_Credit_Card")
		$file_name = "closedby_cc.php";
	else 
		$file_name = "closedby_pl.php";
		
	
	if($_GET['section']=='cl')
		$file_name = "closedby_cl.php";
	else if($_GET['section'] == "lap")
		$file_name = "closedby_lap.php";
	else if($_GET['section'] == "pl")
		$file_name = "closedby_pl.php";
	else if($_GET['section'] == "cc")
		$file_name = "closedby_cc.php";
	else if($_GET['section'] == "hl")
		$file_name = "closedby_hl.php";
	else 
		$file_name = "closedby_pl.php";
		
	

//echo "last in serted id".$file_name;
   	
	?>
<html>
<head>
<title>Apply Personal Home Loans| Deal4Loans</title>
<meta name="keywords" content="Apply Personal Loans, Apply Home Loans , Apply Loan Against Property, Compare Personal Loans, Compare Home Loans, Compare Loan Against Property">
<meta name="description" content="Deal4Loans is an online loan information portal, provides valuable information on all types of loans in India offered by top banks. Apply for home loans, car loans, personal loans, loans against property, loan providers and credit cards, Business loan on Deal4loans.com to get compatitive offers from major banks. Just fill in a simple form, Get, Compare and Choose deals from all the leading loan providers / banks.">
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script src='http://www.deal4loans.com/scripts/pldigittowordconverter.js' type='text/javascript' language='javascript'></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<style>

body, form{
	margin:0px;
	padding:0px;
}

blktxt.img{
	vertical-align:middle;
}

input, select {	
	font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:11px;
	font-weight:normal;
	padding:1px; 
	margin:0px; 
	border: 1px solid #68718A;
}

input .NoBrdr{
	border: none;
}

.whttxt{
	font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:11px;
	color:#FFFFFF;
	font-weight:bold;	
}

.blktxt{
	font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:11px;
	text-align:justify;
	color:#003e5f;
	line-height:17px;
}
.brdr{
	border:1px solid #1b86bf;
	border-top:none;
	background-color:#f9fdff;
}
</style>

<script language="javascript"> 
function toggle() {
	var ele = document.getElementById("toggleText");
	var text = document.getElementById("displayText");
	if(ele.style.display == "block") {
    		ele.style.display = "none";
		text.innerHTML = "<img src='images/pl/add.gif' width='12' height='12' style='border:none;'> <b style='color:#666666;'>Know more</b>";
  	}
	else {
		ele.style.display = "block";
		text.innerHTML = "<img src='images/pl/rmv.gif' width='12' height='12' style='border:none;'> <b style='color:#666666;'>Hide</b>";
	}
} 
function othercity1()
{
	if(document.loan_form.City.value=='Others')
	{
		document.loan_form.City_Other.disabled=false;
	}
	else
	{
		document.loan_form.City_Other.disabled=true;
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
	
	if(Form.Type_Loan.selectedIndex==0)
	{
	alert("Kindly select the Product you are interested!");
	Form.Type_Loan.focus();
	return false;
	}
	
	  if(Form.Phone.value=="")
		{
			alert("Please fill your mobile number.");
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
        if (Form.Phone.value.charAt(0)!="9")
		{
                alert("The number should start only with 9");
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
	/*if(Form.Employment_Status.selectedIndex==0)
	{
		alert("Please enter Employment Status to Continue");
		Form.Employment_Status.focus();
		return false;
	}*/
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
	if((Form.IncomeAmount.value=='')||(Form.IncomeAmount.value=="Annual Income") || (Form.IncomeAmount.value=="Net Take Home(Montly Salary)") || (Form.IncomeAmount.value<=0))
	{
		alert("Please enter Annual income to Continue");
		Form.IncomeAmount.focus();
		return false;
	}
	if(!Form.accept.checked)
	{
		alert("Accept the Terms and Condition");
		Form.focus();
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


function tataaig_comp()
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
}


		function insertData()
		{
			var get_product;
			var get_full_name = document.getElementById('Name').value;
			//var get_full_name = document.getElementById('full_name').value;
			
			var get_email = document.getElementById('Email').value;
			//var get_email = document.getElementById('email').value;		
			
			var get_mobile_no = document.getElementById('Phone').value;
			//var get_mobile_no = document.getElementById('mobile_no').value;
			
			var get_city = document.getElementById('City').value;
			
			var get_id = document.getElementById('Activate').value;
			var get_type = document.getElementById('Type_Loan').value;
			if(get_type=="Req_Loan_Personal")
			{
				get_product ="1";
			}
			else if(get_type=="Req_Loan_Home")
			{
				get_product ="2";
			}
			else if(get_type=="Req_Loan_Car")
			{
				get_product ="3";
			}
			else if(get_type=="Req_Loan_Against_Property")
			{
				get_product ="5";
			}
			else if(get_type=="Req_Credit_Card")
			{
				get_product ="4";
			}

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


</script>
 
<body onbeforeunload="HandleOnClose('<?php echo $file_name; ?>')">
<table width="780" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="255" height="197" align="left" valign="top"><img src="images/pl/hdr-lft.jpg" width="255" height="197" /></td>
        <td width="258" height="197" align="left" valign="top"><img src="images/pl/hdr-mdl.jpg" width="258" height="197" /></td>
        <td width="267" height="197" align="left" valign="top"><img src="images/pl/hdr-rgt.jpg" width="267" height="197" /></td>
      </tr>
      <tr>
        <td width="255" height="84" align="left" valign="top"><img src="images/pl/frst-stp.jpg" width="255" height="84" /></td>
        <td width="258" height="84" align="left" valign="top"><img src="images/pl/scnd-stp.jpg" width="258" height="84" /></td>
        <td width="267" height="84"><img src="images/pl/thrd-stp.jpg" width="267" height="84" /></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td class="brdr"><table width="760" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td valign="top"><table width="98%" border="0" align="left" cellpadding="0" cellspacing="0">
          <tr>
            <td height="25" ><h1 class="blktxt" style="font-size:13px;">Get Loan From Top Banks </h1></td>
          </tr>
          <tr>
            <td height="25" class="blktxt"><b style="font-size:12px;">Personal Loans </b></td>
          </tr>
          <tr>
            <td class="blktxt" style="color:#333333;">The one-stop shop for best on all Personal loan requirements.   <b>Now Get Offers in 2 Minutes</b> from <b style="color:#bf4e17;">SBI, Citibank, HDFC Bank, Citifinancial, Fullerton </b>and Choose the Best Deal!</td>
          </tr>
          <tr>
            <td height="25" class="blktxt" style="padding-top:8px;"><b style="font-size:12px;">Home Loans </b></td>
          </tr>
          <tr>
            <td class="blktxt" style="color:#333333;">The one-stop shop for best on all Home loan requirements.   <b>Now Get Offers in 2 Minutes</b>  from <b style="color:#bf4e17;">SBI, LIC HFL, HDFC Ltd, Axis, ICICI HFC </b>and Choose the Best Deal!</td>
          </tr>
          <tr>
            <td height="25" class="blktxt" style="padding-top:8px;"><b style="font-size:12px;">Testimonial</b></td>
          </tr>
          
          <tr>
            <td class="blktxt" style="color:#333333;">I think that the launch of a service like www.deal4loans.com will ease the loan seeking and deal hunting process for the likes of me. I wish u guys all the success.<div style="font-weight:bold; float:right;">Divya</div></td>
          </tr>
          <tr>
            <td height="25" align="left" class="blktxt" style="padding-top:8px; "><b style="font-size:12px;"> 	 Helpful Tips to Look/Compare/Apply for Loans to Get the Best Deal.</b></td>
          </tr>
          <tr>
            <td align="left" class="blktxt" style="color:#333333;">Interest rates are the most critical of all the costs that you pay. Therefore you should go for the cheapest option. Beware of banking terms like flat interest rates that appear to be cheaper but are in fact the most expensive. </td>
          </tr>
               
          
          <tr>
            <td align="left">
<div class="blktxt" id="toggleText" style="display: none; color:#333333;">For example a 7% flat rate would come out to an effective cost of around 13%. Therefore its better to choose a monthly reducing balance option than a half-yearly reducing option or flat-rate option. This means lower effective cost for the same stated interest rate. Interest-free loans are sometimes too good to be true but view them with suspicion.<br>
<br>
There will also be other costs such as processing charges. You should ask for zero processing fees and zero-penalty for pre-payment option. If this is not available, then lowest cost would be better. Make sure you work out as to how much these other costs add up to. So even though the interest rate may be lower, it usually adds up to being expensive.<br><br>


Usually the EMIs may come out a lot more than what you can afford on a monthly basis. But keep in mind that you should know that lower tenure will reduce the loan amount and lower loan amount will reduce the tenure.<br>
<br>


Make sure that all deals and offers agreed upon are supported by relevant papers. So make sure you always ask for a letter in a banks letter-head mentioning the likes of, exact rate of interests, processing fees, pre-payment charges along with interest-schedule. Also before signing the documents, make sure you recheck all terms and conditions.<br>
<br>


 Do not at any circumstance give any false information. This may amount to fraud and could land you in trouble.<br>
<br>


 Do not sign any blank documents. Even if it takes you a few hours to fill-up the form, please do so. Do not leave anything for the executive to fill-up.<br>
<br>


 Finally, once you have received a loan do your best to pay it back as quickly as possible. Banks make their money off the interest they charge and the sooner you pay back a loan the less money you will have to pay in interest.</div>
<div style="float:right;"><a id="displayText" href="javascript:toggle();" class="blktxt" style="text-decoration:none;"><img src="images/pl/add.gif" width="12" height="12" style="border:none;"> <b style=" color:#333333;">Know more</b></a></div></td>
          </tr>
          <tr>
            <td height="25" class="blktxt" style="padding-top:8px;"><b style="font-size:12px;">It's a totally free service for customers</b></td>
          </tr>
        </table></td>
        <td width="290" valign="top"><table width="290" border="0" align="right" cellpadding="0" cellspacing="0">
          <tr>
            <td height="36" align="center" background="images/pl/frm-top.gif" style="background-repeat:no-repeat;"><font class="whttxt" style="font-family:Verdana; font-weight:bold;font-size:12px"> Please Fill in your Details </font></td>
          </tr>
          <tr>
            <td bgcolor="#2494d0">
			<form name="loan_form" method="post" action="applyhere-continue.php" onSubmit="return submitform(document.loan_form);">

			<table width="92%" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td width="42%" height="30" class="whttxt">Full Name </td>
                <td width="58%" align="right" class="whttxt">
				<input type="hidden" name="referrer" value="<? echo $_REQUEST['referrer'] ?>">
				<input type="hidden" name="creative" value="<? echo $_REQUEST['creative'] ?>">
				<input type="hidden" name="section" value="<? echo $_REQUEST['section'] ?>">
				<input type="hidden" name="source" value="Loans">
				<input type="hidden" name="last_id" value="<? echo $last_id; ?>">
				<input  <? if(isset($loan_type)) { ?>value="<? echo $name; ?>" <? } else { ?>value="Full Name"<? }?> name="Name" id="Name"  onBlur="onBlurDefault(this,'Full Name');"  onFocus="onFocusBlank(this,'Full Name');"  style="width:130px;" onChange="insertData();" ></td>
              </tr>
              <tr>
                <td height="30" class="whttxt">Product</td>
                <td align="right" class="whttxt"><select    name="Type_Loan" onChange="loanamt(this); insertData();"  id="Type_Loan" style="width:130px;">
		   <option value="1">You are looking for</option>
		   <option value="Req_Loan_Personal" <? if($loan_type=="Req_Loan_Personal") echo "selected";?>>Personal Loan</option>
		   <option value="Req_Loan_Home" <? if($loan_type=="Req_Loan_Home") echo "selected";?>>Home Loan</option>
		   <option value="Req_Loan_Car" <? if($loan_type=="Req_Loan_Car") echo "selected";?>>Car loan</option>
		   <option value="Req_Loan_Against_Property" <? if($loan_type=="Req_Loan_Against_Property") echo "selected";?>>Loan against Property</option>
			 </select></td>
              </tr>
              <tr>
                <td height="30" class="whttxt">Mobile No.</td>
                <td align="right" class="whttxt">91
                  <input   type="text" maxlength="10" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);"  style="width:110px;" name="Phone" id="Phone" onChange="insertData();" <? if(isset($loan_type)) { ?>value="<? echo $mobile; ?>" <? }?> onFocus="insertData();"  ><div id="plantype2"   style="position:absolute; font-size:10px; color:#000000; font-weight:normal; width:105px; text-align:center; font-family:verdana; left: 872px; top: 370px;"></div></td>
              </tr>
			 <tr>
                <td height="30" width="42%"  class="whttxt">Email</td><td width="58%" align="right" class="whttxt" ><input class="style4" size="39" <? if(isset($loan_type)) { ?>value="<? echo $Email; ?>" <? }else {?>value="Email Id"<? }?> name="Email" id="Email" style="width:130px;" onBlur="onBlurDefault(this,'Email Id');"  onFocus="onFocusBlank(this,'Email Id');" onChange="insertData();"></td>
			</tr>
			<!-- <tr>
                <td height="30" class="whttxt">Employment Status</td>
                <td align="right" class="whttxt"><select size="1"  style="width:130px;"  name="Employment_Status" id ="Employment_Status" onChange="tataaig_comp(); insertData(); " >
		 <option value="-1">Please Select</option>
		 <option value="1">Salaried</option>
		 <option value="2">Self Employed</option>
		 </select></td>
              </tr>-->
              <tr>
                <td height="30" class="whttxt">City</td>
                <td align="right" class="whttxt"><select size="1"  style="width:130px;"  name="City" id ="City" onChange="othercity1(this); tataaig_comp(); insertData(); " >
		 <?php echo getCityList1($City); ?>
		 </select></td>
              </tr>
              <tr>
                <td height="30" class="whttxt">Othe City </td>
                <td align="right" class="whttxt"><input style="width:130px;" disabled value="Other City" name="City_Other"  onBlur="onBlurDefault(this,'Other City');"  onFocus="onFocusBlank(this,'Other City');"></td>
              </tr>
              <tr>
                <td height="30" class="whttxt">Company Name</td>
                <td align="right" class="whttxt"><input   name="Company_Name" style="width:130px;" value="Company Name"  onBlur="onBlurDefault(this,'Company Name');"  onFocus="onFocusBlank(this,'Company Name');"></td>
              </tr>
			  
			   <tr>
                <td height="30" class="whttxt">Annual Income</td>
                <td align="right" class="whttxt"><input style="width:130px;" value="Annual Income" name="IncomeAmount" id="IncomeAmount" onFocus="this.select();" onChange="intOnly(this);"  onKeyUp="intOnly(this); if(document.getElementById('Type_Loan').value=='Req_Loan_Personal'){PlgetDigitToWords('IncomeAmount','formatedIncome','wordIncome');}else {getDigitToWords('IncomeAmount','formatedIncome','wordIncome');}" onKeyPress="intOnly(this);"  onBlur="if(document.getElementById('Type_Loan').value=='Req_Loan_Personal'){PlgetDigitToWords('IncomeAmount','formatedIncome','wordIncome');}else {getDigitToWords('IncomeAmount','formatedIncome','wordIncome');}; if(document.getElementById('Type_Loan').value=='Req_Loan_Personal'){ if(document.getElementById('Employment_Status').value==1){ onBlurDefault(this,'Net Take Home(Montly Salary)');}else {onBlurDefault(this,'Annual Income');
				}}else{ onBlurDefault(this,'Annual Income');};"></td>
              </tr>
			   <tr>
			     <td height="30" colspan="2" class="whttxt" style="text-align:left;"> <span id='formatedIncome' style='font-size:11px; font-weight:normal;color:#FFFFFF;font-Family:Verdana;'></span><span id='wordIncome' style='font-size:11px;
font-weight:normal;color:#FFFFFF;font-Family:Verdana;text-transform: capitalize;'></span></td>
			     </tr>
				 <tr><td  height="30" colspan="2" class="whttxt" id="tataaig_compaign"></td></tr>
			   <tr>
			     <td height="35" colspan="2" valign="bottom" class="whttxt" style="font-weight:normal;"><input type="hidden" name="Activate" id="Activate" ><input type="checkbox"  name="accept" style="border:none;" checked> I have read the <a href="http://www.deal4loans.com/Privacy.php" target="_blank" style="color:#FFFFFF;">Privacy Policy</a> and agree to the Terms And Condition.</td>
			     </tr>
			   <tr>
                <td height="45" colspan="2" align="center" valign="bottom"><input type="image" src="images/pl/pl-stb.gif" width="112" height="34" style="border:none;" /></td>
                </tr>
            </table>
			</form></td>
          </tr>
          <tr>
            <td width="290" height="15" align="left" valign="top"><img src="images/pl/frm-bt.gif" width="290" height="15" /></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td valign="top">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  
</table>
<div align="center"><?php include 'footer_landingpage.php'; ?></div>
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
