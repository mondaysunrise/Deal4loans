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
	$mobile = $_SESSION['Temp_mobile'] ;
	$Email=	$_SESSION['Temp_email'] ;
	$loan_type = $_SESSION['Temp_loan_type'] ;
	// echo "loan".$loan_type; 
   
	?>
<html>
<head>
<title>Compare Bank Loans Online, Compare Home Loans, Compare Personal Loans, Compare Car Loans, Compare Credit Cards & Loan Against Property</title>
<meta name="keywords" content="home loans, home loan, car loan, car loans, personal loan, personal loans, loans against property, credit card, credit cards, loan portal, loans india, banks india, easy loans, loan providers india, home loans banks, instant personal loan, quick car loans, compare loans, compare home loan, compare personal loan, compare credit cards, loan, loans">
<meta name="description" content="Deal4Loans is an online loan information portal, provides valuable information on all types of loans in India offered by top banks. Read online information on home loans, car loans, personal loans, loans against property, loan providers and credit cards. Just fill in a simple form, Get, Compare and Choose deals from all the leading loan providers / banks">
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
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
function valButton2() {
    var cnt = -1;
	var i;
    for(i=0; i<document.loan_form.From_Product.length; i++) 
	{
        if(document.loan_form.From_Product[i].checked)
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
function addElement()
{
		var ni = document.getElementById('myDiv');
		
		if(ni.innerHTML=="")
		{
		
			if(document.loan_form.CC_Holder.value="on")
			{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '<table border="0"><tr> <td align="left"  class="style4" width="200" height="20" ><font class="style4">I have an active credit card from ? </font></td> <td colspan="3" class="bodyarial11" width="300"><table border="0"> <tr><td class="style4" width="60%"><input type="checkbox" id="From_Product" name="From_Product[]" class="noBrdr" value="Abn Ambro">ABN AMRO</td><td class="style4" width="60%"><input type="checkbox" class="noBrdr" id="From_Product" name="From_Product[]" value="Amex">Amex</td><tr><td class="style4"><input type="checkbox" id="From_Product" name="From_Product[]" class="noBrdr" id="From_Product" value="Canara Bank" >Canara Bank</td><td class="style4"><input type="checkbox" name="From_Product[]" id="From_Product" class="noBrdr" value="Citi Bank" >Citi Bank</td></tr><tr><td class="style4"><input type="checkbox" name="From_Product[]" class="noBrdr" id="From_Product" value="Deutsche bank">Deutsche Bank</td><td class="style4"><input type="checkbox"  id="From_Product" name="From_Product[]" value="HDFC" class="noBrdr">HDFC</td></tr><tr><td class="style4"><input type="checkbox" class="noBrdr" value="HSBC" name="From_Product[]" id="From_Product" >HSBC</td><td class="style4"> <input type="checkbox" id="From_Product" name="From_Product[]" class="noBrdr" value="ICICI">ICICI</td></tr><tr><td class="style4" colspan="2"><input type="checkbox" name="From_Product[]" value="Standard Chartered" id="From_Product" class="noBrdr" >Standard Chartered</td></tr><tr><td class="style4"><input type="checkbox" id="From_Product" name="From_Product[]" class="noBrdr" value="SBi">SBI</td><td class="style4"><input type="checkbox" name="From_Product[]" value="Others" id="From_Product" class="noBrdr" >Others</table></table>		';
				

			}
		}
		
		return true;

	}


function removeElement()
{
		var ni = document.getElementById('myDiv');
		
		if(ni.innerHTML!="")
		{
		
			if(document.loan_form.CC_Holder.value="on")
			{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '';
				
			}
		}
		
		return true;

	}
function submitform(Form)
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
if(document.loan_form.Email.value!="Email Id")
{
	if (!validmail(document.loan_form.Email.value))
	{
		//alert("Please enter your valid email address!");
		document.loan_form.Email.focus();
		return false;
	}
	
}

<?
}
?>
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

/*if((Form.LName.value=="") || (Form.LName.value=="Last Name")|| (Trim(Form.LName.value))==false)
{
alert("Kindly fill in your Last Name!");
Form.LName.focus();
return false;
}
else if(containsdigit(Form.LName.value)==true)
{
alert("Last Name contains numbers!");
Form.LName.focus();
return false;
}
for (var i = 0; i < Form.LName.value.length; i++) {
  	if (iChars.indexOf(Form.LName.value.charAt(i)) != -1) {
  	alert ("Last Name has special characters.\n Please remove them and try again.");
	Form.LName.focus();

  	return false;
  	}
  }
/*if(Form.Type_Loan.selectedIndex==0)
{
alert("Kindly select the Product you are interested!");
Form.Type_Loan.focus();
return false;
}*/
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

	/*if(Form.Phone1.value!="")
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
	}*/
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
for (var i = 0; i < Form.Company_Name.value.length; i++) {
  	if (iChars.indexOf(Form.Company_Name.value.charAt(i)) != -1) {
  	alert ("Company Name has special characters.\n Please remove them and try again.");
	Form.Company_Name.focus();
  	return false;
  	}
  }
if(Form.Net_Salary.selectedIndex==0)
{
	alert("Please select Annual income range to Continue");
	Form.Net_Salary.focus();
	return false;
}
if((Form.IncomeAmount.value=='')||(Form.IncomeAmount.value=="Annual Income"))
{
	alert("Please enter Annual income to Continue");
	Form.IncomeAmount.focus();
	return false;
}
else if(Form.Net_Salary.selectedIndex==1)
{
	if((parseInt(Form.IncomeAmount.value) < 50000) || (parseInt(Form.IncomeAmount.value) > 100000))
	{
		alert("Your exact Annual income should be between the range you have selected");
		Form.IncomeAmount.select();
		return false;
	}

}
else if(Form.Net_Salary.selectedIndex==2)
{
	if((parseInt(Form.IncomeAmount.value) < 100000) || (parseInt(Form.IncomeAmount.value) >200000))
	{
		alert("Your exact Annual income should be between the range you have selected");
		Form.IncomeAmount.select();
		return false;
	}

}
else if(Form.Net_Salary.selectedIndex==3)
{
	if((parseInt(Form.IncomeAmount.value) < 200000) || (parseInt(Form.IncomeAmount.value) >300000))
	{
		alert("Your exact Annual income should be between the range you have selected");
		Form.IncomeAmount.select();
		return false;
	}

}
else if(Form.Net_Salary.selectedIndex==4)
{
	if((parseInt(Form.IncomeAmount.value) < 300000) || (parseInt(Form.IncomeAmount.value) >400000))
	{
		alert("Your exact Annual income should be between the range you have selected");
		Form.IncomeAmount.select();
		return false;
	}

}
else if(Form.Net_Salary.selectedIndex==5)
{
	if(parseInt(Form.IncomeAmount.value) <= 400000)
	{
		alert("Your exact Annual income should be, as per the range you have selected");
		Form.IncomeAmount.select();
		return false;
	}

}

/*else if(Form.Type_Loan.value!='Req_Credit_Card')
{*/

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
					btn2=valButton2();
					if(!btn2)
					{
						alert('From which bank.');
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
if(document.loan_form.City.value=='Others')
{
document.loan_form.City_Other.disabled=false;
}
else
{document.loan_form.City_Other.disabled=true;
}
}

</script>
</head>
<body>
<form name="loan_form" method="post" action="landing_page_thanku.php" onSubmit="return submitform(document.loan_form);">

<!--div align="center"!-->
<table width="850" style="border: 1px solid #68718A;" >
<tr>
	<td colspan="5" width="840"><img src="images/matrimonial.gif" height="25" width="190"></td>
	</tr>
	<tr>
		<td colspan="5" align="center" width="840"><img src="images/naukri_pl.gif"></td>
	</tr>
	
	<tr>
		<td width="4">&nbsp;</td>
		<td width="470" valign="top" align="right" >
		<table border="0" width="460">
		
			<tr>
				<td colspan="2" valign="top" width="463" ><img src="images/3steps.gif" align="left" >
				</td>
			</tr>
			
			<tr>
				<td width="28"><table  height="55" align="right" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td height="4"></td>
				</tr>
				<tr>
					<td height="13"><img src="images/arrow2.gif"></td>
				</tr>
				<tr>
					<td height="13" ><img src="images/arrow2.gif"></td>
				</tr>

				<tr>
					<td height="13"  ><img src="images/arrow2.gif"></td>
				</tr>
			</table>
			<td align="left" height="58" width="431" ><font class="style1"> Post your Personal loan requirement.<br />
			Get &amp; compare offers from all Banks.<br />
			Go with the lowest bank.</font> </td>
			</tr>
			<tr>
		
					<td colspan="2" style="padding-left:33px;" width="431"><font style="color:blue;font-family:Verdana ;font-size:13px;font-weight:bolder;">www.deal4loans.com</font></td>
						</tr>
						<tr>
		
					<td colspan="2" style="padding-left:25px;" width="439"><font class="style1">The one-stop shop for best on all Personal loan requirements</font></td>
						</tr>
						<tr>
						<td colspan="2" style="padding-left:25px;" width="439"><font class="style1">Now get offers from</font> <font  style="font-weight:bold;color:black;font-family:Verdana; font-size:12px;" > Deutsche, Citibank, HSBC, Kotak, Standard Chartered ,and IDBI </font><font class="style1">and choose the best deal!</font></td>
						</tr>
						<tr>
						<td colspan="2" width="463"></td>
						</tr>
						<tr>
						
					<!--<td colspan="2" style="padding-left:22px; " bgcolor="0A71D9"><font color="white" style="font-weight:bold;">-->
					<td colspan="2" width="460"><table width="100%" border="0" >
					<tr>
					<td width="10">&nbsp;</td>
					<td bgcolor="0A71D9"><font class="style2">
					Testimonials</font></td>
						</tr>

					<tr>
					<td width="10">&nbsp;</td>
				<td colspan="2" style="padding-left:15px;padding-right:15px; " bgcolor="DAEAF9"><font class="style1"><p>I think that the launch of a service like <a href="http://www.deal4loans.com/">www.deal4loans.com</a> will ease the loan seeking and deal hunting process for the likes of me. I wish u guys all the success.</font><br>
		
			<font  style="font-weight:bold;color:black;font-family:Verdana; font-size:12px; float:right;" >- Divya&nbsp; </font>
				</td>
			</tr>	
		
			
			<tr>
					<td width="10">&nbsp;</td>
					<td bgcolor="0A71D9"><font class="style2">
					Helpful tips to get deals on personal loans.</font></td>
						</tr>
	</table></td>
					
			<tr>
					<td height="17" width="28" valign="top"><img src="images/arrow2.gif"></td>
					<td valign="top" width="431" ><font class="style3">Personal loans are provided on the basis of your income, mainly estimation given by banks is on the basis of your income & most of loans are happening on the basis of the track record of the customer with any bank. Credit card usage/payments also impact your personal loan eligibility & rates as it is an unsecured loan so banks try gauging your intention to pay loan. Customers tend to make mistakes while entering into deals, which may not be beneficial for them, so better compare all the variables before signing a loan agreement by different banks. The various parameters that you need to compare on Personal loan are :<ol>

<li> Eligibility.</li> 

<li> Interest rates best suited. </li>

<li> Processing Fees. </li>

<li> Pre-payment/Foreclosure charges.</li> 

<li> Document required. </li>

<li> Turn Around Time.</li>
</ol>
 <br>
					<a href="http://www.deal4loans.com/Contents_Personal_Loan_Mustread.php" style="border: 0px;" target="_blank" ><img src="images/khnowmore.gif" ></a>
	 
 				</font>
				</td>
				</tr>
		
		  
	
		</table></td>
		
		<td bgcolor="DAEAF9" width="300" valign="top" align="center" >
		<table border="0" height="100%" cellspacing="0" cellpadding="0" width="200">
			<tr><td width="278"></td> <td width="84"></td></tr>
			
				<tr>			
			<td rowspan="2" align="center" valign="bottom" colspan="2" width="362"><font style="font-family:Verdana; font-weight:bold;font-size:12px"> Personal Loan Request </font></td>
			
			</tr>
			
			<tr><td>&nbsp;</td></tr>

			<tr>
					<td width="280"></td> <td width="90"></td></tr>
					<tr>
					<td align="center" colspan="2"><font style="font-family:Verdana;"><h5>Step 1 of 2</h5></font></td>
				</tr>
			<tr>
			<td colspan="2" align="center"  width="4"></td><input type="hidden" name="referrer" value="<? echo $_REQUEST['referrer'] ?>"></td>

			</tr>
			<tr>
			<td colspan="2" align="center" width="4"></td><input type="hidden" name="Type_Loan" value="Req_Loan_Personal"></td>
			</tr>
			<tr>
			<td colspan="2" align="center" width="4"></td><input type="hidden" name="creative" value="<? echo $_REQUEST['creative'] ?>"></td>

			</tr>
			<tr>
			<td colspan="2" align="center" width="4"></td><input type="hidden" name="section" value="<? echo $_REQUEST['section'] ?>"></td>

			</tr>
			<tr>
			<td colspan="2" align="center" width="4"></td><input type="hidden" name="source" value="jeevansathi"></td>

			</tr>
				
			<tr>
				<td width="278">
				<table border="0" width="230" align="center" cellpadding="0" cellspacing="4" >
			<!--<tr>
				<td colspan="4" align="left" width="340" height="18">
				<input size="17" value="First Name" name="FName" onfocus="this.select();" class="style4" style="float: left"><input size="17" value="Last Name" name="LName" onfocus="this.select();" class="style4" style="float: right"></td>
			</tr>-->
			<tr>
				<td align="left" colspan="4" align="center" width="340" height="18" ><input class="style4" size="39" <? if(isset($loan_type)) { ?>value="<? echo $name; ?>" <? }else {?>value="Full Name"<?}?> name="Name"  style="float: left" ><br></td>
			</tr>
					
			<tr>
		   <td align="left" width="148" height="20"><font class="style4">&nbsp;DOB</font></td>
		   <td colspan="3" align="right" width="196" height="20">
			<input name="day" value="dd" type="text" id="day" size="4" maxlength="2" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)"; class="style4">
			<input name="month" id="month" size="4" maxlength="2" onChange="intOnly(this);" value="mm"  onKeyUp="intOnly(this);" onKeyPress="intOnly(this)" class="style4">
			<input name="year" type="text" id="year" value="yyyy" size="4" maxlength="4" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)"; class="style4">
		   </td>

		 </tr>
		 
			<tr>
				<td align="left" class="style4" width="148" height="20"><font class="style4">&nbsp;Mobile No.</font></td>
				<td colspan="3" align="right" width="196" height="20" >
				
				<input size="19" type="text" onChange="intOnly(this);" maxlength="10" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)"; class="style4" name="Phone"  <? if(isset($loan_type)) { ?>value="<? echo $mobile; ?>" <? }?> onFocus="return Decorate('Please give correct Moblie number,to activate your loan request.')"  onBlur="return Decorate1(' ')"><div id="plantype2" style="position:absolute;font-size:10px;width:105px;text-align:center;font-family:verdana;">
				</div></td>
			</tr>
		<? if(!isset($_SESSION['UserType'])) {?>
			<tr>
				<td align="left" colspan="4" align="center" width="340" height="18" ><input class="style4" size="39" <? if(isset($loan_type)) { ?>value="<? echo $Email; ?>" <? }else {?>value="Email Id"<?}?> name="Email"  style="float: left" ><br></td>

			</tr>
			
			<? }?>
			<!--<tr>
				 <td class="style4" width="140" height="20">Residence Address</td>
				 <td class="bodyarial11" colspan="3" align="right" ><textarea rows="3" name="Residence_Address" cols="18" class="style4"> </textarea></td>
			   </tr> -->
			 <tr>
		 <td align="left" colspan="4" align="right" width="340" height="20" >
		  <select size="1" align="left" style="width:251"  name="City" onChange="othercity1(this)" class="style4">
		 <?=getCityList1($City)?>
		 </select>
		 </td>
	   </tr>
			<tr>
				<td colspan="4" align="center" width="340" height="18" >
				<input size="39" class="style4" disabled value="Other City"  onfocus="this.select();" name="City_Other" style="float: left"></td>
			</tr>
			<tr>
				<td colspan="4" align="center" width="340" height="18" >
				<input size="39" class="style4" value="PinCode"  maxlength="6" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" onfocus="this.select();" name="Pincode" style="float: left"></td>

			</tr>
			<tr>
				<td align="left" colspan="4" width="340" height="18" >
				<select align="left" style="width:251" class="style4"  name="Employment_Status">
				<option selected value="-1">Employment Status</option>
				<option  value="1">Salaried</option>
				<option value="0">Self Employed</option>
				</select></td>
			</tr>
			<tr>
				<td colspan="4" align="center" width="348" height="18">
				<input size="39" class="style4" name="Company_Name"  onfocus="this.select();" value="Company Name" style="float: left"></td>
			</tr>
			<tr>
				<td colspan="4" align="center" width="340" height="18" >
				<select name="Net_Salary" style="width:251" class="style4" >
			   <OPTION value="-1" selected>Annual Income Range(Rs.)</OPTION>
				<OPTION value="50000">50,000-1,00,000</OPTION>
				<OPTION value="100000">1,00,000-2,00,000</OPTION>
				<OPTION value="200000">2,00,000-3,00,000</OPTION>
				<OPTION value="300000">3,00,000-4,00,000</OPTION>
				<OPTION value="400000">Above4,00,000</OPTION></SELECT></td>
			</tr>
			<tr>
				<td colspan="4" align="left" width="340" height="18">
				<input size="39" value="Annual Income" name="IncomeAmount" onfocus="this.select();" class="style4"onChange="intOnly(this);"  onKeyUp="intOnly(this);" onKeyPress="intOnly(this)"; style="float: left"></td>
				
			</tr>	
			<tr>
				<td colspan="4" align="left" width="340" height="18">
				<input size="39" value="Loan Amount" name="Loan_Amount" onfocus="this.select();" class="style4"onChange="intOnly(this);"  onKeyUp="intOnly(this);" onKeyPress="intOnly(this)"; style="float: left"></td>
			</tr>
			 <tr>
			<td align="left" class="style4" width="150" height="20"><font class="style4">Are you a Credit card holder?</font></td> <td colspan="3" class="bodyarial11" width="350" ><table border="0" >
			<td  align="right" width="60" height="20"><input type="radio"  name="CC_Holder" class="NoBrdr"  value="1"  onclick="addElement();" ><font class="style4">Yes</font></td>
			<td  align="right" width="60" height="18">
			<input type="radio" class="NoBrdr" name="CC_Holder" value="0" onclick="removeElement();"><font class="style4"  >No</font></td></tr></table></td>
		</tr>	
		 <tr><td colspan="4" id="myDiv"></td></tr>
		
			</table>
		  
		
	</td>
	</tr>
		
			<td colspan="4" align="center" width="276"><input  type="image" src="images/submit1.gif" style="border: 0px;"></td>
		</tr>
		 <tr>
			<td colspan="2">&nbsp;</td>
		</tr>
		 <tr>
			<td colspan="2">&nbsp;</td>
		</tr>
		 <tr>
			 <td colspan="2">&nbsp;</td>
		</tr>
		</table>
		</td>
		</td>
	<td width="62">&nbsp;</td>
</tr>
<tr bgcolor="DAEAF9">
	<td bgcolor="DAEAF9" colspan="5" width="847">&nbsp;</td>
	</tr>

</table>
<!--/div!-->
</form>
<script src="http://www.google-analytics.com/urchin.js"  
type="text/javascript">
</script>
<script type="text/javascript">
_uacct = "UA-1312775-1";
urchinTracker();
</script>
</body>
</html>