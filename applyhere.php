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
<title>Apply Cards Personal Home Loans| Deal4Loans</title>
<meta name="keywords" content="Apply Personal Loans, Apply Home Loans ,Apply Credit Cards, Apply Loan Against Property, Compare Personal Loans, Compare Home Loans Compare Credit Cards, Compare Loan Against Property">
<meta name="description" content="Deal4Loans is an online loan information portal, provides valuable information on all types of loans in India offered by top banks. Apply for home loans, car loans, personal loans, loans against property, loan providers and credit cards, Business loan on Deal4loans.com to get compatitive offers from major banks. Just fill in a simple form, Get, Compare and Choose deals from all the leading loan providers / banks.">
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script src='http://www.deal4loans.com/scripts/pldigittowordconverter.js' type='text/javascript' language='javascript'></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>


<style>
.style1{
font-size:12px;
line-height:150%;
color:68718A;
font-weight:bold;
font-Family:Verdana;
}
.style4{
font-size:10px;
font-weight:bold;
color:666699;
font-Family:Verdana;
}
.style3{
font-size:12px;
color:68718A;
font-weight:bold;
line-height:150%;
font-Family:Verdana;
}
.style2{
font-size:12.5px;
color:white;

font-weight:bolder;
font-Family:Verdana;
}
input, select {font:12px Arial; padding:2px; margin:0px; border: 1px solid #68718A;}
input.NoBrdr	{font:12px Arial; padding:0px; margin:0px; border: 0px}
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
if(document.loan_form.Email.value!="Email Id")
{
	if (!validmail(document.loan_form.Email.value))
	{
		document.loan_form.Email.focus();
		return false;
	}
	
}
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

	if(Form.Phone1.value!="")
	{
		if((Form.Std_Code.value=="")||(Form.Std_Code.value=="std"))
		{
			alert("Please fill your STD Code for Residence number.");
			Form.Std_Code.focus();
			return false;
		}
	}
	
	if(Form.Landline_O.value!="")
	{
		if((Form.Std_Code_O.value=="")||(Form.Std_Code_O.value=="std"))
		{
			alert("Please fill your STD Code for Office Landline number.");
			Form.Std_Code_O.focus();
			return false;
		}
	}
if((Form.Phone.value=='Mobile') || (Form.Phone.value=='') || Trim(Form.Phone.value)==false)
{
alert("Kindly fill in your Mobile Number!");
Form.Phone.focus();
return false;
}
else if(Form.Phone.value!='')
	{
		if (!validmobile(Form.Phone.value))
		{
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
if((Form.Residence_Address.value=='')  || Trim(Form.Residence_Address.value)==false)
{
alert("Kindly fill in your Residence Address!");
Form.Residence_Address.focus();
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
alert("Kindly select Employment Status!");
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
if((Form.IncomeAmount.value=='')||(Form.IncomeAmount.value=="Annual Income") || (Form.IncomeAmount.value=="Net Take Home(Montly Salary)") )
{
	alert("Please enter Annual income to Continue");
	Form.IncomeAmount.focus();
	return false;
}

else if(Form.Type_Loan.value!='Req_Credit_Card')
{

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

}
if(Form.Contact_Time.selectedIndex==0)
{
alert("Kindly select the Prefered time to contact !");
Form.Contact_Time.focus();
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

if(Form.Std_Code_O.value=="std")
{
	Form.Std_Code_O.value=" ";
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
function loanamt()
{
if(document.loan_form.Type_Loan.value=='Req_Credit_Card')
{
document.loan_form.Loan_Amount.disabled=true;
}
else
{document.loan_form.Loan_Amount.disabled=false;
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

function netsalarytab()
{
	if(document.loan_form.Type_Loan.value=="Req_Loan_Personal")
	{
	 if (( document.loan_form.Employment_Status.value=="0" ))
       {
               		document.loan_form.IncomeAmount.value="Annual Income";
			          }
	else {
		
             
			   document.loan_form.IncomeAmount.value="Net Take Home(Montly Salary)";
			     //document.getElementById('plantype1').innerHTML = strPlan;
       }
	}
	else
	{

	}

       return true;
} 




/*function tataaig_comp()
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
}*/

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
		var ni = document.getElementById('myDiv');
		
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
</head>
<body onbeforeunload="HandleOnClose('<?php echo $file_name; ?>')">


<table width="100" border="0" align="center" cellpadding="0" cellspacing="0" style="border: 1px solid #68718A;">
<tr>
<td width="847" height="120" colspan="4" align="center"><img src="images/logopersonal1.gif" alt="loans at deal4loans" width="720" height="120"></td>
</tr>
<tr>
	<td width="450" align="right" valign="top" ><table width="450" border="0" align="left" cellpadding="0" cellspacing="0">
      <tr>
        <td colspan="2" valign="top"><table width="100%" border="0" align="right" cellpadding="0" cellspacing="0">
            <tr>
              <td height="25" colspan="2" align="center" valign="middle"><img src="images/3steps.gif" alt="apply loans" width="450" height="40" align="left" ></td>
              </tr>
            <tr>
              <td width="66" height="25" align="center" valign="middle"><img src="images/arrow2.gif"></td>
              <td width="390" valign="middle"><font class="style3">Post your Loan requirement</font></td>
            </tr>
            <tr>
              <td height="25" align="center" valign="middle" ><img src="images/arrow2.gif"></td>
              <td valign="middle" ><font class="style3">Get &amp; Compare Offers from all Banks</font></td>
            </tr>
            <tr>
              <td height="25" align="center" valign="middle"  ><img src="images/arrow2.gif"></td>
              <td valign="middle"  ><font class="style3">Go with the Lowest Bidder</font> </td>
            </tr>
          </table>
      </tr>
      <tr>
        <td height="25" colspan="2" style="padding-left:18px;"><font style="color:blue;font-family:Verdana ;font-size:13px;font-weight:bolder;">www.deal4loans.com</font></td>
      </tr>
      <tr>
        <td colspan="2" style="padding-left:18px;"><font class="style3">The one-stop shop for Best on all Loan requirements</font></td>
      </tr>
      <tr>
        <td colspan="2"></td>
      </tr>
      <tr>
        <td colspan="2"><table width="100%" border="0" cellpadding="0" cellspacing="0" >
            <tr>
              <td height="25" bgcolor="0A71D9">&nbsp;<font class="style2">Testimonials</font></td>
            </tr>
            <tr>
              <td colspan="2"><font class="style3"> I think that the launch of a service like <a href="http://www.deal4loans.com/">www.deal4loans.com</a> will ease the loan seeking and deal hunting process for the likes of me. I wish u guys all the success.</font>
                  <div  style="font-weight:bold;color:black;font-family:Verdana; font-size:12px; float:right;" >- Divya&nbsp; </div></td>
            </tr>
            <tr>
              <td height="25" bgcolor="0A71D9">&nbsp;<font class="style2" style="font-size:12px; ">Helpful tips to look/Compare/Apply for Loans to Get the Best Deal</font></td>
            </tr>
        </table></td>
      </tr>
      <tr>
        <td height="17" width="18" valign="top"><img src="images/arrow2.gif"></td>
        <td valign="top" width="438" style="padding-bottom:7px; " ><font class="style3">Interest rates are the most critical of all the costs that you pay. Therefore you should go for the cheapest option. Beware of banking terms like flat interest rates that appear to be cheaper but are in fact the most expensive. For example a 7% flat rate would come out to an effective cost of around 13%. Therefore it's better to choose a monthly reducing balance option than a half-yearly reducing option or flat-rate option. This means lower effective cost for the same stated interest rate. Interest-free loans are sometimes too good to be true but view them with suspicion.</font></td>
      </tr>
      <tr>
        <td height="17" width="18" valign="top"><img src="images/arrow2.gif"></td>
        <td valign="top" width="438" ><font class="style3">There will also be other costs such as processing charges. You should ask for zero processing fees and zero-penalty for pre-payment option. If this is not available, then lowest cost would be better. Make sure you work out as to how much these other costs add up to. So even though the interest rate may be lower, it usually adds up to being expensive.</font></td>
      </tr>
      <tr>
        <td width="18" >&nbsp;</td>
        <td valign="top" width="438" >&nbsp;</td>
      <tr>
        <td colspan="2" ><a href="loans.php" style="border: 0px;" target="_blank" ><img src="images/khnowmore.gif" border="0" ></a></td>
      </tr>
      <tr>
        <td colspan="2" >&nbsp;</td>
      </tr>
    </table></td>
		
		<td width="270" align="center"  valign="top" bgcolor="#e6f2fd" >
		<form name="loan_form" method="post" action="thank_u.php" onSubmit="return submitform(document.loan_form);">
		<input type="hidden" name="referrer" value="<? echo $_REQUEST['referrer'] ?>">
		<input type="hidden" name="creative" value="<? echo $_REQUEST['creative'] ?>">
		<input type="hidden" name="section" value="<? echo $_REQUEST['section'] ?>">
		<input type="hidden" name="source" value="<? echo $_REQUEST['source'] ?>">
		<input type="hidden" name="last_id" value="<? echo $last_id; ?>">
		<table width="235"  border="0" align="center" cellpadding="0" cellspacing="0">
          <tr align="center" valign="middle" class="style4">
            <td height="50" colspan="2"><h3 style="font-family:Verdana; font-weight:bold;font-size:13px;">Please fill in your details</h3></td>
          </tr>
          <tr align="left" class="style4">
            <td height="30" colspan="2"><input name="Name" class="style4" id="Name" style="width:235px;"  onFocus="onFocusBlank(this,'Full Name');"  onblur="onBlurDefault(this,'Full Name');" onChange="insertData();"  <? if(isset($loan_type)) { ?>value="<? echo $name; ?>" <? } else { ?>value="Full Name"<? }?>></td>
          </tr>
          <tr align="left" class="style4">
            <td height="30" colspan="2"><select  name="Type_Loan" size="1" class="style4"  id="Type_Loan" style="width:235px;" onChange="loanamt(this);insertData();" align="left" >
                <option value="1">You are looking for</option>
                <option value="Req_Loan_Personal" <? if($loan_type=="Req_Loan_Personal") echo "selected";?>>Personal Loan</option>
                <option value="Req_Loan_Home" <? if($loan_type=="Req_Loan_Home") echo "selected";?>>Home Loan</option>
                <option value="Req_Loan_Car" <? if($loan_type=="Req_Loan_Car") echo "selected";?>>Car loan</option>
                <option value="Req_Loan_Against_Property" <? if($loan_type=="Req_Loan_Against_Property") echo "selected";?>>Loan against Property</option>
                <option value="Req_Credit_Card" <? if($loan_type=="Req_Credit_Card") echo "selected";?>>Credit Card</option>
            </select></td>
          </tr>
          <tr class="style4">
            <td width="95" height="25"><font class="style4">Marital Status</font></td>
            <td width="140"><input type="radio"  name="Marital_Status"  class="NoBrdr"  value="1" >              Single&nbsp;
                <input size="10" type="radio" class="NoBrdr" name="Marital_Status" value="2" checked>              Married </td>
          </tr>
          <tr class="style4">
            <td height="25" class="style4">DOB</td>
            <td><input name="day" type="text" class="style4" id="day" style="width:38px;"  onFocus="onFocusBlank(this,'dd');" onBlur="onBlurDefault(this,'dd');" onChange="intOnly(this);" onKeyPress="intOnly(this)" onKeyUp="intOnly(this);" value="dd" maxlength="2";>
                <input name="month" class="style4" id="month" style="width:38px;"  onFocus="onFocusBlank(this,'mm');"   onblur="onBlurDefault(this,'mm');" onChange="intOnly(this);" onKeyPress="intOnly(this)"  onKeyUp="intOnly(this);" value="mm" maxlength="2">
                <input name="year" type="text" class="style4" id="year" style="width:58px;"  onFocus="onFocusBlank(this,'yyyy');"  onblur="onBlurDefault(this,'yyyy');" onChange="intOnly(this);" onKeyPress="intOnly(this);" onKeyUp="intOnly(this);" value="yyyy" maxlength="4"></td>
          </tr>
          <tr class="style4">
            <td height="25"><font class="style4">Residence No.</font></td>
            <td><input type="text"  name="Std_Code" class="style4" style="width:38px;" onChange="intOnly(this);"  onKeyUp="intOnly(this);" onKeyPress="intOnly(this)"; value="std" onBlur="onBlurDefault(this,'std');">
                <input style="width:98px;" maxlength="10" type="text" class="style4" name="Phone1" onChange="intOnly(this);"  onKeyUp="intOnly(this);" onKeyPress="intOnly(this)";></td>
          </tr>
          <tr class="style4">
            <td height="25"><font class="style4">Office No.</font></td>
            <td><input type="text"  name="Std_Code_O" class="style4" style="width:38px;" onChange="intOnly(this);"  onKeyUp="intOnly(this);" onKeyPress="intOnly(this)"; value="std" onBlur="onBlurDefault(this,'std');"  onFocus="onFocusBlank(this,'std');">
                <input style="width:98px;" type="text" maxlength="10" class="style4" name="Landline_O" onChange="intOnly(this);"  onKeyUp="intOnly(this);" onKeyPress="intOnly(this)";></td>
          </tr>
          <tr class="style4">
            <td height="25"><font class="style4">Mobile No.</font></td>
            <td>+91
                <input style=" width:113px; " type="text" maxlength="10" class="style4" name="Phone" id="Phone" <? if(isset($loan_type)) { ?>value="<? echo $mobile; ?>" <? }?> onChange="intOnly(this); tosendsms(); insertData();" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" onFocus="addtooltip();"></td>
          </tr>
          <tr class="style4">
            <td colspan="2"><div id="myDiv" style="color:#7d0606; font-family:Verdana; font-size:11px; font-weight:normal;"></div></td>
          </tr>
          <tr class="style4">
            <td height="25" colspan="2"><input class="style4" style="width:235px;" <? if(isset($loan_type)) { ?>value="<? echo $Email; ?>" <? }else {?>value="Email Id"<? }?> name="Email" id="Email"  onblur="onBlurDefault(this,'Email Id');"   onFocus="removetooltip();"  onChange="insertData();"></td>
          </tr>
          <tr class="style4">
            <td height="25">Residence<br>
            Address</td>
            <td><textarea rows="3" name="Residence_Address" style="width:140px; "  onfocus="insertData();"> </textarea></td>
          </tr>
          <tr class="style4">
            <td height="25" colspan="2"><select size="1" align="left" style="width:235px;"  name="City" id ="City" onChange="othercity1(this); insertData(); tataaig_comp();" class="style4">
		 <?php echo getCityList1($City); ?>
		 </select></td>
          </tr>
          <tr class="style4">
            <td height="25" colspan="2"><input class="style4" disabled value="Other City" name="City_Other" style=" width:235px;" onBlur="onBlurDefault(this,'Other City');"  onFocus="onFocusBlank(this,'Other City');"></td>
          </tr>
          <tr class="style4">
            <td height="25" colspan="2"><select align="left" style="width:235px;" class="style4"  name="Employment_Status" id="Employment_Status" onChange="netsalarytab();">
				<option selected value="-1">Please Select</option>
				<option  value="1">Salaried</option>
				<option value="0">Self Employed</option>
				</select></td>
          </tr>
          <tr class="style4">
            <td height="25" colspan="2"><input  class="style4" name="Company_Name"  value="Company Name" style=" width:235px;" onBlur="onBlurDefault(this,'Company Name');"  onFocus="onFocusBlank(this,'Company Name');"></td>
          </tr>
          <tr class="style4">
            <td height="25" colspan="2"><input style="width:235px; " value="Annual Income" name="IncomeAmount" id="IncomeAmount" onFocus="this.select();" class="style4" onChange="intOnly(this);"  onKeyUp="intOnly(this); if(document.getElementById('Type_Loan').value=='Req_Loan_Personal'){PlgetDigitToWords('IncomeAmount','formatedIncome','wordIncome');}else {getDigitToWords('IncomeAmount','formatedIncome','wordIncome');}" onKeyPress="intOnly(this);"   onblur="if(document.getElementById('Type_Loan').value=='Req_Loan_Personal'){PlgetDigitToWords('IncomeAmount','formatedIncome','wordIncome');}else {getDigitToWords('IncomeAmount','formatedIncome','wordIncome');}; if(document.getElementById('Type_Loan').value=='Req_Loan_Personal'){ if(document.getElementById('Employment_Status').value==1){ onBlurDefault(this,'Net Take Home(Montly Salary)');}else {onBlurDefault(this,'Annual Income');
				}}else{ onBlurDefault(this,'Annual Income');};"></td>
          </tr>
          <tr class="style4">
            <td colspan="2"><span id='formatedIncome' style='font-size:11px; font-weight:bold;color:666699;font-Family:Verdana;'></span><span id='wordIncome' style='font-size:11px;
font-weight:bold;color:666699;font-Family:Verdana;text-transform: capitalize;'></span></td>
          </tr>
          <tr class="style4">
            <td height="25" colspan="2"><input style="width:235px; " value="Loan Amount" name="Loan_Amount"  id="Loan_Amount" onFocus="this.select();" class="style4" onChange="intOnly(this);" 
					onKeyUp="PlgetDigitToWords('Loan_Amount','formatedlA','wordloanAmount'); intOnly(this);" onKeyPress="intOnly(this)"  onblur="PlgetDigitToWords('Loan_Amount','formatedlA','wordloanAmount'); onBlurDefault(this,'Loan Amount');"></td>
          </tr>
          <tr class="style4">
            <td  colspan="2"><span id='formatedlA' style='font-size:11px; font-weight:bold;color:666699;font-Family:Verdana;'></span><span id='wordloanAmount' style='font-size:11px;
font-weight:bold;color:666699;font-Family:Verdana;text-transform: capitalize;'></span></td>
          </tr>
          <tr class="style4">
            <td height="45"><font class="style4">Are you a Credit card holder of any bank ?</font></td>
            <td height="25"><input type="radio"  name="CC_Holder" class="NoBrdr"  value="1" checked>              Yes &nbsp;  <input type="radio" class="NoBrdr" name="CC_Holder" value="0">
            No</td>
          </tr>
          <tr class="style4">
            <td height="25" colspan="2"><select size="1" align="left" style="width:235px;" name="Contact_Time" class="style4">
		  <option value="1">Prefered Time to Contact</option> 
		  <option value="10- 12 am">10- 12 am</option> 
		  <option value="12- 2 pm">12- 2 pm</option> 
		  <option value="2- 4 pm">2- 4 pm</option>
		  <option value="4- 6 pm">4- 6 pm</option>
		  <option value="After 6 pm">After 6 pm</option>
		  </select></td>
          </tr>
         
          <tr align="left" class="style4">
            <td height="45" colspan="2"  ><input type="hidden" name="Activate" id="Activate" ><input type="checkbox" class="style4" name="accept" checked> <font class="style4"> I authorize Deal4loans.com & its partnering Banks to call me with reference to my loan application  & Agree to <a href="http://www.deal4loans.com/Privacy.php" target="_blank">Privacy Policy</a> and <a href="http://www.deal4loans.com/Privacy.php" target="_blank">Terms and Conditions</a>.</font></td>
          </tr>
          <tr align="center" class="style4">
            <td height="35" colspan="2"><input  type="image" src="images/submit1.gif" style="border: 0px;"></td>
          </tr>
          <tr align="left" class="style4">
            <td height="35" colspan="2"><font class="style4">By accepting "Terms and Conditions" you also authorize our  partnering
banks to intiate Cibil/Satyam check on your profile.</font></td>
          </tr>
          <tr class="style4">
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table>
		</form></td>
</tr>
</table>
<!--<script language="javascript">
	function wsa_include_js(){
		var js = document.createElement('script');
		js.setAttribute('language','javascript');
		js.setAttribute('type','text/javascript');
		js.setAttribute('src','http://www.websitealive7.com/1118/Visitor/vTracker_v2.asp?groupid=1118&departmentid=');
		document.getElementsByTagName('head').item(0).appendChild(js);
	}
	window.onload = wsa_include_js;
</script>-->
<!--/div!-->

<script src="http://www.google-analytics.com/urchin.js"  
type="text/javascript">
</script>
<script type="text/javascript">
_uacct = "UA-1312775-1";
urchinTracker();
</script>
</body>
</html>