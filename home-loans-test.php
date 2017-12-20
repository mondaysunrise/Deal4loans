<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';

 $tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-1, date("Y"));
$currentdate=date('d F Y',$tomorrow);

?>  

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Home loan: Know Eligibility and Documents requirements for Home Loan in India.</title>
<meta name="keywords" content="Home Loan, Home Loans, Home Loan India, Home loans India, Home Loans Eligibility, home loans documents">
<meta name="Description" content="Home Loan - Compare interest rates of Housing loans and EMI from all major National and international banks of India such as SBI, HDFC, LIC Housing Finance, ICICI HFC, Barclays Finance, UBI, IDBI, Axis Bank, Fullerton and Citibank.">
<!-- <link href="style/new-bima-blue.css" rel="stylesheet"  type="text/css" /> -->
<link href="style/new-bima.css" rel="stylesheet"  type="text/css" />
<link href="style/glowing.css" rel="stylesheet"  type="text/css" />
<script type="text/javascript" src="js/dropdowntabs.js"></script>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
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

function showdetailsFaq(d,e)
{			
	for(j=1;j<=e;j++)
		{
			if(d==j)
				{
					if(eval(document.getElementById("divfaq"+j)).style.display=='none')
						{
							eval(document.getElementById("divfaq"+j)).style.display=''
						}
					else
						{
							eval(document.getElementById("divfaq"+j)).style.display='none'
						}
				}
			
		}
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
	var i;
	var myOption;
	
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
	
	
	
	if(Form.Email.value!="")
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

if (Form.Pincode.value=="")
	{
		alert("Please enter Pincode.");
		Form.Pincode.focus();
		return false;
	}
	if (Form.Pincode.value!="")
	{
		if(Form.Pincode.value.length < 6)
	{
		alert("Kindly fill in your Pincode(6 Digits)!");
		Form.Pincode.focus();
		return false;
	}
	}

	if(Form.Employment_Status.selectedIndex==0)
{
	alert("Please select Occupation ");
	Form.Employment_Status.focus();
	return false;
}	

	if((Form.Net_Salary.value=='')||(Form.Net_Salary.value=="Annual Income"))
	{
		alert("Please enter Annual Income to Continue");
		Form.Net_Salary.focus();
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
		for (i=Form.Property_Identified.length-1; i > -1; i--) {
			if(Form.Property_Identified[i].checked) {
				if(i==0)
				{
					if(Form.Property_Loc.selectedIndex==0)
				{
					alert("Plese select city where property is located");
					Form.Property_Loc.focus();
					return false;
				}

				}
					myOption = i;
	
			}
		}
	
		if (myOption == -1) 
		{
			alert("please select you have identified any property or not");
			return false;
		}

	/*for(j=0; j<Form.Property_Identified.length; j++) 
	{
	//alert(document.loan_form.Property_Identified.length);
        if(Form.Property_Identified[j].checked)
		{
   	 		cnt= j;
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
		*/
	
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
		ni.innerHTML = '<table width="100%" align="left" border="0"><tr><td width="41%" height="20"  align="left" valign="middle" class="frmbldtxt"><b style="color:#373737;">Property Location</b></td>				<td width="59%" height="20" colspan="3" align="left" >&nbsp;&nbsp;&nbsp;				  <select style="width:130px;" name="Property_Loc" id="Property_Loc" tabindex="16"><?=getCityList1($City)?></select></td></tr></table>';
			
		return true;
}	
	
function removeIdentified()
{
		var ni = document.getElementById('myDiv1');
		ni.innerHTML = '';
			
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
<body>
<?php include '~Top-new-hl.php';?>
<?php include '~menu.php';?>
<div id="container">
<div id="lftbar">
<div class="lfttxtbar">
  <span><a href="index.php">Home</a> > Home Loans</span>

  <div id="txt">
<h1>Home Loans</h1>
	
 <p><b> Overview</b><br>
   Your Home is a place where you relax after coming back from  your day’s tiring work, it is that place where you can give time to your family  &amp; spend beautiful moments with them. To acquire a home which can be  christened your “Own House” is a life-time decision &amp; has to be taken with  a lot of planning &amp; requires huge finances. Your Dream Home is not very far  away with a Home Loan which will fulfill your Dream into a reality. We at <a href="http://www.deal4loans.com/">Deal4Loans</a> are working constantly to get  you the BEST Loan Deal &amp; have brought a small guide which would answer some  important questions related to Home Loan &amp; help you decide your loan deal.
  <form name="home_loan"  action="apply-home-loans-continue1.php" method="POST" onSubmit="return submitform(document.home_loan);"> 
<table width="680"  border="0" align="center" cellpadding="0" cellspacing="0" class="brdr5">
	 <tr>
        <td style=" padding:12px;" ><table width="500" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="30"  bgcolor="#FFFFFF" class="frmbldtxt" ><h1 style="margin:0px; padding:0px;">Compare Home Loan Rates- Eligibility- Process of All Banks.</h1></td>
  </tr>
</table></td>
 </tr>
     <tr>
     <td><table width="100%" border="0" align="right" cellpadding="0" cellspacing="0"  id="frm">
          <tr>
            <td colspan="2" align="center"><input type="hidden" name="Type_Loan" value="Req_Loan_Home">
			<input type="hidden" name="source" value="HL main page">
<input type="hidden" name="PostURL" value="/home-loans.php">	
	      </tr>
          <tr>
            <td colspan="2" align="center"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
               <tr>
                 <td valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                   <tr valign="middle">
                     <td height="28" class="frmbldtxt" style="padding-top:3px; ">&nbsp;Full Name :</td>
                     <td height="28" class="frmbldtxt"  style="padding-top:3px; "><input type="text" name="Name" id="Name" style="width:120px;" maxlength="30"  onchange="insertData();" tabindex="1" /></td>
                     <td width="23%" height="28" class="frmbldtxt" style="padding-top:3px; ">City :</td>
                     <td width="28%" height="28" class="frmbldtxt"  style="padding-top:3px; "><select name="City" id="City" style="width:110px;" onchange="othercity1(); edelweiss_comp();  insertData();" tabindex="7">
                       <?=getCityList($City)?>
                     </select></td>
                   </tr>
                   <tr valign="middle">
                     <td height="28" class="frmbldtxt">&nbsp;DOB :</td>
                     <td height="28" class="frmbldtxt"><input name="day" type="text" id="day"  value="DD" style="  width:30px; " onblur="onBlurDefault(this,'dd');" onfocus="onFocusBlank(this,'dd');" maxlength="2" onkeyup="intOnly(this);" onkeypress="intOnly(this);" tabindex="2"/>
                         <input  name="month" type="text" id="month" style="width:30px; " value="MM" onblur="onBlurDefault(this,'mm');" onfocus="onFocusBlank(this,'mm');" maxlength="2" onkeyup="intOnly(this);" onkeypress="intOnly(this);" tabindex="3"/>
                         <input name="year" type="text" id="year" style="width:50px; " value="YYYY" onblur="onBlurDefault(this,'yyyy');" onfocus="onFocusBlank(this,'yyyy');" maxlength="4" onkeyup="intOnly(this);" onkeypress="intOnly(this);" onchange="insertData();" tabindex="4"/></td>
                     <td height="28" align="left" class="frmbldtxt">Other City :</td>
                     <td height="28" class="frmbldtxt"><input type="text" name="City_Other" disabled  value="Other City" onfocus="this.select();" style="width:110px;" tabindex="8" /></td>
                   </tr>
                   <tr valign="middle">
                     <td height="28" class="frmbldtxt">&nbsp;Mobile :</td>
                     <td height="28" class="frmbldtxt">+91
                         <input type="text" style="width:94px;" name="Phone" id="Phone" maxlength="10"   onkeyup="intOnly(this);" onkeypress="intOnly(this);" onchange="intOnly(this);insertData();" onblur="return Decorate1('')" onFocus="return Decorate('Please give correct Mobile number, to activate your loan request.')" tabindex="5"/><!--<div id="plantype2" style="position:absolute; font-size:10px; width:245px; font-weight:none; left: 260px; top: 420px; height: 38px;" ></div>--></td>
                     <td height="28" class="frmbldtxt">Pincode :</td>
                     <td height="28" class="frmbldtxt"><input type="text" name="Pincode" onfocus="this.select();" style="width:110px;" maxlength="6" onkeypress="intOnly(this);" onkeyup="intOnly(this);"   tabindex="9" /></td>
                   </tr>
                   <tr valign="middle">
                     <td width="19%" height="28" class="frmbldtxt">&nbsp;Email ID :</td>
                     <td width="30%" height="28" class="frmbldtxt"><input type="text" name="Email" id="Email"  style="width:120px;" onchange="insertData();" tabindex="6" /></td>
                     <td width="23%" height="28" class="frmbldtxt">Property Value:</td>
                     <td width="28%" height="28" class="frmbldtxt"><input name="property_value" id="property_value" type="text" tabindex="10"   style=" width:110px;"  /></td>
                   </tr>
                   <tr valign="middle">
                    <tr valign="top">
                     <td height="28" colspan="3" class="frmbldtxt" style="padding-top:5px;">Total Monthly EMI for all running loans :</td>
                     <td height="28" style="padding-top:4px; "><input type="text" name="obligations" id="obligations" style="width:110px;"    onkeyup="intOnly(this);" onkeypress="intOnly(this);" tabindex="17" /></td>
                   </tr>
                 
                 </table></td>
                 <td width="230" valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                <tr>
                <td width="44%" height="28" class="frmbldtxt">Occupation :</td>
                <td width="56%" class="frmbldtxt"><select   name="Employment_Status"  id="Employment_Status" style="width:123px;" tabindex="11" >
                         <option value="-1">Please Select</option>
                         <option value="1">Salaried</option>
                         <option value="0">Self Employment</option>
                     </select>&nbsp;</td>
              </tr>
              <tr>
                <td height="28" class="frmbldtxt">Annual Income </td>
                <td class="frmbldtxt"><input type="text" name="Net_Salary" id="Net_Salary" style="width:122px;" onkeyup="intOnly(this); getDigitToWords('Net_Salary','formatedIncome','wordIncome');" onkeypress="intOnly(this);"  onblur="getDigitToWords('Net_Salary','formatedIncome','wordIncome');"   tabindex="12" />&nbsp;                </td>
              </tr>
              <tr>
                <td   colspan="2" class="frmbldtxt"><span id='formatedIncome' style='font-size:11px;
font-weight:normal; color:#333333;font-Family:Verdana;'></span>
<span id='wordIncome' style='font-size:11px;
font-weight:normal; color:#333333;font-Family:Verdana;text-transform: capitalize;'></span></td>
              </tr>
              <tr>
                <td height="28" class="frmbldtxt">Loan Amount :</td>
                <td class="frmbldtxt"><input name="Loan_Amount" id="Loan_Amount" tabindex="13" type="text" style="width:122px;" maxlength="10" onfocus="this.select();" onkeyup="intOnly(this);getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');"  onkeydown="getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" onkeypress="intOnly(this); getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" onblur="getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" />                  &nbsp;                </td>
              </tr>
              <tr>
                <td colspan="2" class="frmbldtxt"><span id='formatedlA' style='font-size:11px;
font-weight:normal; color:#333333;font-Family:Verdana;'></span><span id='wordloanAmount' style='font-size:11px;
font-weight:normal; color:#333333;font-Family:Verdana;text-transform: capitalize;'></span></td>
              </tr>
           
              <tr>
                <td height="28" class="frmbldtxt" colspan="2">Property Identified :<br />
                 <input type="radio" name="Property_Identified" id="Property_Identified" value="1" onclick="addIdentified();" style="border:none;" tabindex="14" />
      Yes&nbsp;&nbsp;
      <input type="radio"  name="Property_Identified" id="Property_Identified" onclick="removeIdentified();" value="0" style="border:none;" tabindex="15" />No</td>
              </tr>
               <tr>
                <td colspan="2" class="frmbldtxt">
				<div id="myDiv1"></div>
                  </td>
              </tr>
            </table></td>
               </tr>
             </table></td>
           </tr>
			  <tr>
             <td height="22"  colspan="5" align="left" class="frmbldtxt">&nbsp;<input type="checkbox" name="co_appli" id="co_appli" value="1" onClick="return showdetailsFaq(1,12);" style="border:none;" tabindex="18">&nbsp; Co- Applicant</td>
           </tr>
          <tr>
             <td  colspan="5" align="left" class="frmbldtxt">
				<div style="display:none;" id="divfaq1">
                  <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
                    <tr>
                      <td width="9%" class="frmbldtxt" height="30">&nbsp;<b> Name :</b></td>
          <td width="24%" align="left"><span class="frmbldtxt">
            <input type="text" name="co_name" id="co_name" style="width:120px;" tabindex="19" maxlength="30" value="<?php echo $co_name; ?>" >
            </span></td>
          <td width="6%" align="left" class="frmbldtxt"><b>DOB : </b></td>
          <td width="24%" align="left"><input onfocus="insertData();" name="co_day" type="text" id="co_day" style="width:40px;" maxlength="2" onchange="intOnly(this);" onkeyup="intOnly(this);" onkeypress="intOnly(this)"; value="DD" tabindex="20" />
            <input name="co_month" type="text" id="co_month" style="width:40px;" maxlength="2" onchange="intOnly(this);" onkeyup="intOnly(this);" onkeypress="intOnly(this);" value="MM" tabindex="21" />
            <input name="co_year" type="text" id="co_year" style="width:53px;" maxlength="4" onchange="intOnly(this);" onkeyup="intOnly(this);" onkeypress="intOnly(this);" value="YYYY" tabindex="22" /></td>
          <td width="18%" height="30" class="frmbldtxt"><b> Net Monthly Income : </b></td>
          <td width="19%" align="left"><span class="frmbldtxt">
            <input type="text" name="co_monthly_income" id="co_monthly_income" style="width:120px;" value="<?php echo $income; ?>"  onkeyup="intOnly(this);" onkeypress="intOnly(this);" tabindex="23" />
          </span></td>
                    </tr>
                    <tr>
                      <td height="30" colspan="5" class="frmbldtxt">&nbsp;<b> Total Monthly EMI for all running loans : </b>
            <input type="text" name="co_obligations" id="co_obligations" tabindex="24" style="width:135px;" value="<?php echo $obligations; ?>"  onkeyup="intOnly(this);" onkeypress="intOnly(this);" />
          </td>
          
          <td align="left">&nbsp;</td>
                    </tr>
		</table>
       </div>
			 </td>
           </tr>
 <tr>
                  <td width="76%" align="left" class="frmbldtxt"  style="font-weight:normal;">&nbsp;
		              <input type="checkbox" name="accept" style="border:none;" checked>
 I have read the <a href="Privacy.php" target="_blank">Privacy Policy</a> and agree to the <a href="Privacy.php" target="_blank">Terms And Condition</a>.
			  </td>
            <td width="24%"><input type="submit" style="border: 0px none ; background-image: url(new-images/quote-btn.jpg); width: 128px; height: 31px; margin-bottom: 0px;" value=""/></td>
              </tr>
            </table></td>
               </tr>
			   
             </table></td>
          </tr>   
 
          </table></td>
      </tr>
	    <tr>
	      <td >&nbsp;</td>
        </tr>
    </table>
	</form>
	* Quotes are totally free for customers<br /><br />

   <b>What is a Home loan?</b><br>
Home Loan is a Secured <a href="http://www.deal4loans.com" title="Loan">Loan</a> offered against the security of a house/property  which is funded by the bank’s loan, the property could be a personal property  or a commercial one. The Home Loan is a loan taken by a borrower from the bank  issued against the property/security intended to be bought on the part by the  borrower giving the banker a conditional ownership over the property i.e. if  the borrower is failed to pay back the loan, the banker can retrieve the lent  money by selling the property. Get more Information on home loan section click <a href="http://www.deal4loans.com/loans/category/home-loan/" title="Articles about Home Loan">Articles about Home Loan</a> and <a href="http://www.deal4loans.com/Contents_Home_Loan_Mustread.php" title="Home Loan must read">Home Loan must read</a>.<br>
<br>
<b>Most borrowed home loans</b><br>
<b><a href="http://www.deal4loans.com/sbi-home-loan.php" title="SBI Home Loan">SBI Home Loan</a>:</b> Before borrowing any loan borrower compare  interest rates. Generally people prefer to take SBI Home Loan because SBI  (State bank of India)  is main centralized and national bank. <a href="http://www.deal4loans.com/loans/banks/sbi-state-bank-of-india-loan/" title="SBI">SBI</a> provides loan at comparatively low  interest rate.<br>
<br>
<b><a href="http://www.deal4loans.com/hdfc-ltd-home-loan.php" title="HDFC Bank Home Loan">HDFC</a> stands for Housing Development Finance Corporation</b>. Its has counseling and advisory services for acquiring property. It provide loan from any office for purchase of home anywhere in India. It gives Home Loan approval even before a property is selected.Because of flexible feature and transparent policy, most people prefer .<a href="http://www.deal4loans.com/loans/banks/hdfc-bank-hdfc-ltd/" title="HDFC">HDFC </a>home Loan for their requirement<br>
<br>
<b><a href="http://www.deal4loans.com/icici-hfc-home-loan.php" title="ICICI Bank Home Loan">ICICI Bank Home Loan</a>:</b> ICICI Bank offers a wide range  of Home Loan products, designed to meet the requirements of customer. : <a href="http://www.deal4loans.com/loans/banks/icici-bank-icici/" title="ICICI Bank">ICICI Bank</a> offers Doorstep service, Speedy loan sanction, Simplified  documentation and Loan amounts ranging from Rs. 2 lakh to Rs. 3 crore Rupees  only.<br>
<br>

<b> Types of Home Loan</b><br>
There are different types of home loans available in the market to cater borrower’s different needs.<br>
<br>
• <b> Home Purchase Loan :  </b> This is the basic type of a home loan which has the purpose of purchasing a new house.<br>
<br>
• <b> Home Improvement Loan :  </b> This type of home loan is for the renovation or repair of the home which is already bought<br>
<br>
• <b> Home Extension Loan :  </b> This type of loan serves the purpose when the borrower wants to extend or expand an existing home, like adding an extra room etc.<br>
<br>
• <b> Home Conversion Loan :</b>  It is that loan wherein the borrower has already taken a home loan to finance his current home, but now wants to move to another home. The Conversion Home Loan helps the borrower to transfer the existing loan to the new home which requires extra funds, so the new loan pays the previous loan &amp; fulfills the money required for new home.<br>
• <b> Bridge Loan :</b>  This type of loan helps finance the new home of the borrower when he wants to sell the existing home, this is normally a short term loan to the borrower &amp; helps during the interim period when he wants to sell the old home &amp; want to buy a new one, It is given till the time a buyer is found for the old home.<br>
<br>
• <b> Home Construction Loan :</b>  This type of loan taken when the borrower wants to construct a new home.<br>
<br>
• <b> Land Purchase Loan :</b>  It is that loan which is taken to purchase a land for construction &amp; investment purposes. 
<br>
<b> Documents required in Home Loan</b><br>
Generally the documents required to processing your loan application are almost similar across all the banks; however they may differ with various banks depending upon specific requirement etc. Following documents are required by financial institutions to process the loan application:<br>
• Age Proof<br>
• Address Proof<br>
•Income Proof of the applicant &amp; co-applicant<br>
• Last 6 months bank A/C statement<br>
• Passport size photograph of the applicant &amp; co-applicant<br>
<br>
<b> In case of Salaried</b><br>
• Employment certificate from the employer,<br>
• Copies of pay slips for last few months and TDS certificate<br>
• Latest Form 16 issued by employer Bank statements<br>
<br>
<b> In case of Self-employed</b><br>
• Copy of audited financial statements for the last 2 years<br>
• Copy of partnership deed if it is a partnership firm or copy of memorandum of association and articles of association if it is a company<br>
• Profit and loss account for the last few years<br>
• Income tax assessment order<br>
<br>
<b> Home Loan Process &amp; various steps involved</b><br>
There are various steps involved in getting a Home Loan from selecting your property to filling up the loan application. Following are the various stages in Home Loan:<br>
<br>
• The first step involved in the process is to <b> find your property</b>  which is followed by the verification of property documents, post that the documents are examined &amp; simultaneously you can start searching for the lender who can offer the BEST Home Loan Deal after checking your eligibility criteria.<br>
<br>
• <b> Know the Home Loan Eligibility :</b> Banks offer the loan amount only after checking your profile &amp; based on various eligibility criteria’s like age, income &amp; salary banks lend you the money.<br>
<br>
• <b> Select the Best Home Loan after evaluation:</b>  <a href="http://www.deal4loans.com/home-loans-interest-rates.php">Comparing home loan interest rates</a> is the primary feature in the home loan selection, however other fees &amp; charges like Application fees, processing fees, legal charges should not be neglected when comparing various loan offers. To check the interest rates &amp; other charges incurred by various banks, Deal4Loans has brought in a <a href="http://www.deal4loans.com/Interest-Rate-Home-Loans.php"> Home Loan Comparison Chart</a> across various Banks.<br>
<br>
• <b> Applying for the Loan :</b> After you have selected your lender, you have to fill in the application form wherein the lender requires complete information about your financial assets &amp; liabilities; other personal &amp; professional details together with the property details &amp; its costs.<br>
<br>
• <b> Documentation &amp; Verification Process :</b>  You are required to submit the necessary documents to the bank which will be verified together with the details in the application.<br>
<br>
• <b> Credit &amp; default check :</b>  Bank checks out the borrower’s loan eligibility (through repayment capacity) &amp; the amount of loan is confirmed. The borrower’s repayment capacity is reached which is based on the income, salary, age, experience &amp; nature of business etc. Bank also checks credit history through the Cibil Score which plays a critical role in deciding &amp; approving your loan application. Low Credit Score implies that the bank upfront rejects your application on the basis of earlier credit defaults; on the other hand high credit score gives a green signal to your application.<br>
<br>
• <b> Bank sanctions Loan &amp; Offer letter to the borrower :</b>  After the credit appraisal of the borrower bank decides the final amount &amp; sanctions the loan, the bank further sends an offer letter to the borrower which constitutes the details like rate of interest, loan tenure &amp; repayment options etc.<br>
<br>
• <b> Acceptance Copy to the Bank :</b>  The borrower needs to send an acceptance copy to the bank after the borrower agrees with the terms &amp; conditions in the offer letter.<br>
<br>
• <b> Bank checks the legal documents :</b>  The bank further asks the legal documents of property from the borrower to check its authenticity so as to keep them as a security for the loan amount given. The next step involved is the valuation of the property by the bank which determines the loan amount sanctioned by the bank.<br>
<br>
• <b> Signing of agreement &amp; the loan disbursal :</b>  The borrower signs the loan agreement &amp; the bank disburses the loan amount.<br>
<br>
<b> Charges in Home Loan</b><br>
Acquiring a Home Loan doesn’t only involve the cost of <a href="http://www.deal4loans.com/home-loans-interest-rates.php">home loan interest rates</a> but it also includes other charges &amp; fee accompanying at various stages of taking the Home loan. You must consider all these charges while comparing the cost structure across banks. Following is the detailed fee structure incurred by banks at different loan stages:<br>
<br>
• <b> Processing Charge :</b>  It is a fee payable at the time of submitting the loan application to the bank which is normally non-refundable. The fee ranges between 0.5 per cent and 1 per cent of the loan amount.<br>
<br>
• <b> Administrative Fee :</b>  It is a fee incurred by banks at the time of loan sanction; there are few banks who have removed this fee so you must check it with all the banks.<br>
<br>
• <b> Prepayment Penalties :</b>  When the borrower pre-pays the loan before the loan tenure, banks charge a penalty which usually varies between 1 per cent and 2 per cent of the pre-paid amount.<br>
<br>
• <b> Legal Charges :</b>  Banks also incur some charges from the customer for legal and technical verification of the property.<br>
<br>
• <b> Delayed payment Charges :</b>  When there is a delay in the payment of your EMI, banks charge a late payment fee from the borrower which normally ranges from 2% to 3% of the EMI.<br>
<br>
• <b> Cheque bounce charges :</b>  Banks charge between Rs. 250 and Rs. 500 for every bounced cheque towards the loan payment because of lack of funds in your account. </p>
<b><a href="http://www.deal4loans.com/home-loan-banks.php"> </a></b>
<p><b ><a href="home-loan-banks.php">Home Loan  Criteria by various banks </a></b><br>
The borrower’s eligibility of getting a home loan depend upon his/her repayment capacity & the banks establish this repayment capacity by considering various factors such income, spouse's income,  age, number of dependants qualifications ,  assets, liabilities, stability and continuity of occupation and savings history. You can now check your eligibility for Home Loan through our <a href="http://www.deal4loans.com/home-loan-calculator.php">Home Loan Eligibility Calculator</a> <br>

<a href="http://www.deal4loans.com/Contents_Home_Loan_Article1.php" >Deal4loans has brought in the Home Loan Eligibility Factors by banks</a><br>
<br>
<b >Important Pointers in Home Loan</b><br>
&bull; <b>Increase your Loan eligibility</b><br>
&bull; <b>Credit History :</b> Your chances of getting a home loan are increased if you have a good credit history which is known by banks by checking the borrower’s Cibil score. Now it is very hard to get a loan from another bank when you already have a bad debt with one bank.<br>
<br>
&bull; <b>Clubbing of income :</b> Your eligibility to take a home loan will augment when you club your income with your spouse’s income, bank in this case will calculate your eligibility on the basis of the clubbed income of both the applicants. You can club incomes of spouse, children & parents staying with you and having regular income.<br>
<br>
&bull; <b>Enhance your loan tenure :</b> Longer is the loan tenure, lower will be the EMIs which further increases the repayment capacity of the borrower & in turn enhances the loan eligibility.<br>
<br>
&bull; Step-up Loan: In this type of loan EMIs remain low in the beginning & increase gradually as and when the borrower’s spending power increases. Therefore lower EMIs in the initial years enhances the borrower’s ability to pay & further increases the loan eligibility<br>
<br>
&bull; <b>Increase the down payment :</b> You must know that in a <a href="home-loan-banks.php">home loan bank</a> finances only 85 to 90% for the property & the rest amount has to be funded by the borrower. You should increase the down payment if you have more than required amount which will mitigate your debt considerably. 
<br>
<br>
<b >Tax Benefits in Home Loan</b><br>

The home loan borrower enjoys Tax Benefits on both Interest paid & the Principal re-paid. Under Section 24(d) of Income Tax, the deduction of interest payable on the home loan is up to a maximum of Rs. 1, 50,000.<br>
Under Section 80(c) of Income Tax, Principal amount for the repayment of loan along with other savings & investments is eligible for tax deduction up to a maximum limit of <br>
          Rs. 1, 00,000.
</p>
	<div align="right"><a href="#pg_up" >Top<img src="/new-images/top.gif" width="12" height="18" alt="Top" border="0"/></a></div>

	</div>

</div></div>
<div id="rgtbar">

<table width="250" border="0" cellpadding="0" cellspacing="0" id="bgclr">
<tr>
  <td bgcolor="#FFFFFF" ><table width="250" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="44" align="center" valign="middle" background="new-images/rgt-int-tpbg.gif"  style=" color:#333333; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; text-align:center; line-height:15px;" ><b style="font-size:12px; ">Home Loan Rate of Interest</b><br />

( Last edited on : <? echo $currentdate; ?> )</td>
    </tr>
    <tr>
      <td style="border-left:3px solid #f5e77d; border-right:3px solid #f5e77d; "><table width="235" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#f4f3eb">
        <tr bgcolor="#FFFFFF">
          <td height="22" align="center" valign="middle" class="tbl_txt"><b>Bank</b>
          </td>
          <td width="95" align="center" valign="middle" class="tbl_txt" style="width:95px; "> <b>Interest<br />
      Rates</b></td>
 
          <td align="center" valign="middle" class="tbl_txt"><b>Apply</b></td>
        </tr>
        <? $gethlrates=("Select ndtv_rates,bank_name,bank_url,processing_fee From home_loan_interest_rate_chart where (tenure=1 and hlrateid in (5,102,105,151,10,203,115,3,8) and flag=1)  order by  priority ASC");
	 list($recordcount,$hlrow)=MainselectfuncNew($gethlrates,$array = array());
		$cntr=0;
	
	while($cntr<count($hlrow))
        {
	?>
        <tr bgcolor="#FFFFFF">
          <td height="35" align="center" valign="middle" style="font-size:10px;"><a href="<?  echo $hlrow[$cntr]['bank_url'];?>" style="color:#335599;line-height:13px; text-decoration:none;" class="tbl_txt"><? echo $hlrow[$cntr]["bank_name"]; ?></a></td>
          <td align="center" valign="middle"  class="tbl_txt"><? echo $hlrow[$cntr]["ndtv_rates"]; ?></td>
 
          <td align="center" valign="middle" class="tbl_txt" style="font-size:10px;"><a href="http://www.deal4loans.com/apply-for-home-loans.php" target="_blank"><img src="new-images/apl-sml.gif" width="46" height="16" border="0" /></a> </td>
          <? $cntr = $cntr +1;}?>
          
      </table></td>
    </tr>
    <tr>
      <td height="16" valign="top"><img src="new-images/rgt-int-btbg.gif" width="250" height="16" /></td>
    </tr>
  </table></td>
</tr>
        <tr>
         <td  align="center" valign="middle" bgcolor="#FFFFFF" height="10" ></td>
       </tr>
      
  <!--<tr>
          <td height="13" ><div id="frmbt"></div></td>
      </tr>-->
  
  <tr>
    <td  align="center" valign="middle" bgcolor="#FFFFFF" style="padding-top:2px;">Advertisement</td>
	</tr>
	
	<tr>
	<td align="center" valign="middle" bgcolor="#FFFFFF"><script type="text/javascript"><!--
google_ad_client = "pub-6880092259094596";
/* 250x250, created 10/26/09 */
google_ad_slot = "1962172606";
google_ad_width = 250;
google_ad_height = 250;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
<!-- <script type='text/javascript' src='http://j.admagnet.net/panda/js/Bizfin-160x600/Deal4Loans_160x600_1268645580.js?'></script>
<noscript><a href='http://n.admagnet.net/panda/www/delivery/ck.php?n=a3abe099&amp;cb=60501175' target='_blank'><img src='http://n.admagnet.net/panda/www/delivery/avw.php?zoneid=3943&amp;n=a3abe099' border='0' alt='' /></a></noscript> --></td>
	</tr>
<tr>
  <td bgcolor="#FFFFFF"  style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px;"  ><div id="testi"><div align="center" style="width:210px; margin-left:20px; text-align:left; line-height:15px; padding-top:45px;">Hi deal4loans team, the article on home loans was the first article i read and it has given me a good insight into the home loans scenarios.. thanks a ton<br>

<div style="float:right; font-weight:bold; padding-top:10px;">Umesh Sondhi</div></div></div></td>
</tr>
	
	<!-- <tr>
	<td align="center" valign="middle" bgcolor="#FFFFFF">&nbsp;</td>
	</tr> -->
</table>
</div>

<? if ((($_REQUEST['flag'])!=1))
	{ ?>
<?php include '~Bottom-new1.php';?><?php } ?>
</div>
</body>
</html>

