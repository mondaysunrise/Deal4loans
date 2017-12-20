<?php
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>Business Loans| Business Loans India| Business Loans Apply | Business Loans Compare| Business Loans EMI | Deal4Loans - Compare Apply</title>
<meta name="description" content="Get online information on business loans from all business loan provider banks located in major cities of India like Mumbai, Delhi, Noida, Kolkata, Gurgaon, Bangalore, Ahmedabad, Chennai, Hyderabad, Navi Mumbai, Kochi etc. ">
<meta name="keywords" content="business loans in delhi, business loan in Mumbai, business loans in kolkata, noida business loans, Mumbai, Delhi, Bangalore">
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<link href="includes/style1.css" rel="stylesheet" type="text/css">
 <script language="javascript">
 
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

function citycheck()
{
	if(document.loan_form.City.value=="Others")
	{
		//alert("OTHERS");
		document.loan_form.City_Other.disabled = false;
	}
	else
	{
	//alert("Disabled");
		document.loan_form.City_Other.disabled = true;
	}
}



function addElementLoan()
{
		var ni = document.getElementById('myDivLoan');
		
		if(ni.innerHTML=="")
		{
		
			if(document.loan_form.LoanAny.value="on")
			{
				//alert(document.loan_form.CC_Holder.value);
					ni.innerHTML = '<table border="0"><tr> <td align="left" class="bodyarial11" width="200" height="20" >Which type of loan(s) running? </td> <td colspan="3" class="bodyarial11" width="300" ><table border="0">	 <tr><td class="bodyarial11" width="60" height="20" ><input type="checkbox" id="Loan_Any" name="Loan_Any[]" class="noBrdr" value="hl">Home</td><td class="bodyarial11"  width="60" height="20"><input type="checkbox" class="noBrdr" id="Loan_Any" name="Loan_Any[]" value="pl">Personal</td><tr><td  width="60" height="20" class="bodyarial11"><input type="checkbox" id="Loan_Any" name="Loan_Any[]" class="noBrdr" id="Loan_Any" value="cl" >Car</td><td class="bodyarial11" ><input type="checkbox" name="Loan_Any[]" id="Loan_Any" class="noBrdr" value="lap">Property</td></tr><tr><td class="bodyarial11" ><input type="checkbox" name="Loan_Any[]" id="Loan_Any" class="noBrdr" value="other">Other</td></tr> </table></td></tr><tr><td width="400" height="5" colspan="4">&nbsp;	 </td> </tr> <tr>    <td align="left"  width="200" height="20" class="bodyarial11">How many Installments paid?  </td>   <td colspan="3" align="left" width="300" height="18" ><select name="EMI_Paid"  style="float: left"> <option value="0">Please select</option><option value="1">Less than 6 months</option> <option value="2">6 to 9 months</option> <option value="3">9 to 12 months</option> <option value="4">more than 12 months</option </select>  </td>	</tr></table>';
			}
		}
		
		return true;
}

function removeElementLoan()
{
		var ni = document.getElementById('myDivLoan');
		
		if(ni.innerHTML!="")
		{
		
			if(document.loan_form.LoanAny.value="on")
			{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '';
				
			}
		}
		
		return true;

	}
function addElementCC()
{
		var ni = document.getElementById('myDivCC');
		
		if(ni.innerHTML=="")
		{
		
			if(document.loan_form.CCbusiness.value="on")
			{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '<table border="0"><tr>	 <td align="left"  class="bodyarial11" width="200" height="20">Cards held since?</td>		<td  align="left"  colspan="3" width="300" height="20"><select size="1" class="style4" name="Card_Vintage"><option value="0">Please select</option> <option value="1">Less than 6 months</option>	 <option value="2">6 to 9 months</option>	 <option value="3">9 to 12 months</option>	 <option value="4">more than 12 months</option>	 </select> </td></tr>	<tr> <td align="left"  valign="top" class="bodyarial11" width="200" height="20" >I have an active credit card from ? </td> <td colspan="3" class="bodyarial11" width="300"><table border="0"> <tr><td class="bodyarial11" width="60%"><input type="checkbox" id="From_Product" name="From_Product[]" class="noBrdr" value="Abn Ambro">ABN AMRO</td><td class="bodyarial11" width="60%"><input type="checkbox" class="noBrdr" id="From_Product" name="From_Product[]" value="Amex">Amex</td><tr><td class="bodyarial11"><input type="checkbox" id="From_Product" name="From_Product[]" class="noBrdr" id="From_Product" value="Canara Bank" >Canara Bank</td><td class="bodyarial11"><input type="checkbox" name="From_Product[]" id="From_Product" class="noBrdr" value="Citi Bank" >Citi Bank</td></tr><tr><td class="bodyarial11"><input type="checkbox" name="From_Product[]" class="noBrdr" id="From_Product" value="Deutsche bank">Deutsche Bank</td><td class="bodyarial11"><input type="checkbox"  id="From_Product" name="From_Product[]" value="HDFC" class="noBrdr">HDFC</td></tr><tr><td class="bodyarial11"><input type="checkbox" class="noBrdr" value="HSBC" name="From_Product[]" id="From_Product" >HSBC</td><td class="bodyarial11"> <input type="checkbox" id="From_Product" name="From_Product[]" class="noBrdr" value="ICICI">ICICI</td></tr><tr><td class="bodyarial11" colspan="2"><input type="checkbox" name="From_Product[]" value="Standard Chartered" id="From_Product" class="noBrdr" >Standard Chartered</td></tr><tr><td class="bodyarial11"><input type="checkbox" id="From_Product" name="From_Product[]" class="noBrdr" value="SBi">SBI</td><td class="bodyarial11"><input type="checkbox" name="From_Product[]" value="Others" id="From_Product" class="noBrdr" >Others</table></table>';
				

			}
		}
		
		return true;

	}


function removeElementCC()
{
		var ni = document.getElementById('myDivCC');
		
		if(ni.innerHTML!="")
		{
		
			if(document.loan_form.CCbusiness.value="on")
			{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '';
				
			}
		}
		
		return true;

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

function chkform()
{
var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
var dt,mdate;dt=new Date();

var alpha=/^[a-zA-Z\ ]*$/;
var alphanum=/^[a-zA-Z0-9]*$/;
var num=/^[0-9]*$/;
var space=/^[\ ]*$/;
var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";

	if(document.loan_form.Email.value=="")
	{
		alert("Please fill your Email.");
		document.loan_form.Email.focus();
		return false;
	}

	if(document.loan_form.Email.value!="")
	{
		if (!validmail(document.loan_form.Email.value))
		{
			alert("Please enter your valid email address!");
			document.loan_form.Email.focus();
			return false;
		}
		
	}

	if(document.loan_form.FName.value=="")
	{
		alert("Please fill your first name.");
		document.loan_form.FName.focus();
		return false;
	}
	if(document.loan_form.FName.value!="")
	{
	 if(containsdigit(document.loan_form.FName.value)==true)
	{
	alert("First Name contains numbers!");
	document.loan_form.FName.focus();
	return false;
	}
	}
  for (var i = 0; i <document.loan_form.FName.value.length; i++) {
  	if (iChars.indexOf(document.loan_form.FName.value.charAt(i)) != -1) {
  	alert ("First Name has special characters.\n Please remove them and try again.");
	document.loan_form.FName.focus();

  	return false;
  	}
  }
	if(document.loan_form.LName.value=="")
	{
		alert("Please fill your Last name.");
		document.loan_form.LName.focus();
		return false;
	}
	if(document.loan_form.LName.value!="")
	{
	 if(containsdigit(document.loan_form.LName.value)==true)
	{
	alert("last Name contains numbers!");
	document.loan_form.LName.focus();
	return false;
	}
	}
  for (var i = 0; i <document.loan_form.LName.value.length; i++) {
  	if (iChars.indexOf(document.loan_form.LName.value.charAt(i)) != -1) {
  	alert ("First Name has special characters.\n Please remove them and try again.");
	document.loan_form.LName.focus();

  	return false;
  	}
  }
	if(document.loan_form.day.value=="")
	{
		alert("Please fill your day of birth.");
		document.loan_form.day.focus();
		return false;
	}
	if(document.loan_form.day.value!="")
	{
	 if((document.loan_form.day.value<1) || (document.loan_form.day.value>31))
	{
	alert("Kindly Enter your valid Date of Birth(Range 1-31)");
	document.loan_form.day.focus();
	return false;
	}
	}
	if(!checkData(document.loan_form.day, 'Day', 2))
		return false;
	
	if(document.loan_form.month.value=="")
	{
		alert("Please fill your month of birth.");
		document.loan_form.month.focus();
		return false;
	}
	if(document.loan_form.month.value!="")
	{
	if((document.loan_form.month.value<1) || (document.loan_form.month.value>12))
	{
	alert("Kindly Enter your valid Month of Birth(Range 1-12)");
	document.loan_form.month.focus();
	return false;
	}
	}
	if(!checkData(document.loan_form.month, 'month', 2))
		return false;
	if(document.loan_form.year.value=="")
	{
		alert("Please fill your year of birth.");
		document.loan_form.year.focus();
		return false;
	}
		if(document.loan_form.year.value!="")
	{
	  if((document.loan_form.year.value < "1945") || (document.loan_form.year.value >"1989"))
	{
		alert("Age Criteria! \n Applicants between age group 18 - 62 only are elgibile.");
		document.loan_form.year.focus();
		return false;
		}
	}
	if(!checkData(document.loan_form.year, 'Year', 4))
		return false;
	
	if(document.loan_form.Phone.value=="")
	{
		alert("Please fill your mobile number.");
		document.loan_form.Phone.focus();
		return false;
	}

  if(isNaN(document.loan_form.Phone.value)|| document.loan_form.Phone.value.indexOf(" ")!=-1)
		{
              alert("Enter numeric value");
			  document.loan_form.Phone.focus();
			  return false;  
		}
        if (document.loan_form.Phone.value.length < 10 )
		{
                alert("Please Enter 10 Digits"); 
				 document.loan_form.Phone.focus();
				return false;
        }
        if (document.loan_form.Phone.value.charAt(0)!="9")
		{
                alert("The number should start only with 9");
				 document.loan_form.Phone.focus();
         	return false;
        }    

	/*if(document.loan_form.Phone.value!="")
	{
		if (!validmobile(document.loan_form.Phone.value))
		{
			//alert("Please enter your valid email address!");
			document.loan_form.Phone.focus();
			return false;
		}
	}*/
	if(document.loan_form.Phone1.value!="")
	{
		if(document.loan_form.Std_Code1.value=="")
		{
			alert("Please fill your STD Code for Residence/Office Landline number.");
			document.loan_form.Std_Code1.focus();
			return false;
		}
	}
	
	if (document.loan_form.City.selectedIndex==0)
	{
		alert("Please select City Name to Continue");
		document.loan_form.City.focus();
		return false;
	}
	if((document.loan_form.City.value=="Others") && (document.loan_form.City_Other.value=="" || document.loan_form.City_Other.value=="Other City"  ) || !isNaN(document.loan_form.City_Other.value))
	{
		alert("Kindly fill your Other City!");
		document.loan_form.City_Other.focus();
		return false;
	}
	for (var i = 0; i <document.loan_form.City_Other.value.length; i++) {
  	if (iChars.indexOf(document.loan_form.City_Other.value.charAt(i)) != -1) {
  	alert ("Other city has special characters.\n Please remove them and try again.");
	document.loan_form.City_Other.focus();
  	return false;
  	}
  }
  
  
  
	if (document.loan_form.Pincode.value=="")
	{
		alert("Please enter Pincode.");
		document.loan_form.Pincode.focus();
		return false;
	}
	if (document.loan_form.Pincode.value!="")
	{
		if(document.loan_form.Pincode.value.length < 6)
		{
			alert("Kindly fill in your Pincode(6 Digits)!");
			document.loan_form.Pincode.focus();
			return false;
		}
	}
		/*if (document.loan_form.Residence_Address.value=="")
	{
		alert("Please enter Residence Address.");
		document.loan_form.Residence_Address.focus();
		return false;
	}*/
	
	
	if (document.loan_form.Occupation.selectedIndex==0)
	{
		alert("Please select Occupation to Continue");
		document.loan_form.Occupation.focus();
		return false;
	}
	
	
	if (document.loan_form.Company.value=="")
	{
		alert("Please enter Company.");
		document.loan_form.Company.focus();
		return false;
	}
	
	if (document.loan_form.Experience.selectedIndex==0)
	{
		alert("Please select Years in Current Business");
		document.loan_form.Experience.focus();
		return false;
	}
	
	if (document.loan_form.Industry.selectedIndex==0)
	{
		alert("Please select industry");
		document.loan_form.Industry.focus();
		return false;
	}
	if (document.loan_form.Constitution.selectedIndex==0)
	{
		alert("Please select Type of company");
		document.loan_form.Constitution.focus();
		return false;
	}
	if (document.loan_form.Year_Of_Establishment.selectedIndex==0)
	{
		alert("Please select Year of establishment");
		document.loan_form.Year_Of_Establishment.focus();
		return false;
	}
	
	if (document.loan_form.Net_Salary.value=="")
	{
		alert("Please enter Annual Income.");
		document.loan_form.Net_Salary.focus();
		return false;
	}
	
	if(!checkNum(document.loan_form.Net_Salary, 'Annual Income',0))
		return false;
	
	if (document.loan_form.Annual_Turnover.selectedIndex==0)
	{
		alert("Please select Annual Turnover");
		document.loan_form.Annual_Turnover.focus();
		return false;
	}
	if (document.loan_form.Loan_Amount.value=="")
	{
		alert("Please enter Loan Amount.");
		document.loan_form.Loan_Amount.focus();
		return false;
	}	
	
	if(!checkNum(document.loan_form.Loan_Amount, 'Loan Amount',0))
		return false;
}
</script>

</head>

<body>
<table border="0" width="710"cellpadding="4" cellspacing="0" id="frm" align="center" >
<tr>
<td colspan="2"><img src="images/logopersonal1.gif" /></td>
</tr>
<tr>
<td width="410">Business Loan Text</td>
<td align="right">

 <form name="loan_form" method="post" action="businessloanentry_submit.php" onSubmit="return chkform();">
 
   <table border="0" width="310" cellpadding="4" cellspacing="0" class="blueborder" id="frm" align="center">
  <tr>
<td colspan="2" align="center" class="head1">Business Loan</td>
</tr>
<?php
if(isset($_GET['msg']))
{
?>
 <tr>
<td colspan="2" align="center" class="head1"><?php echo "You have entered Lead for ".$_GET['msg']; ?></td>
</tr>
 <?php
}
 ?>
   <tr>
                <td width="129" class="bodyarial11">Your Email Address</td>
     <td class="bodyarial11">
     <input type="text" name="Email" size="30" ></td>
   </tr>
     <tr>
       <td class="bodyarial11">First Name<font size="1" color="#FF0000">*</font></td>
       <td class="bodyarial11"><input type="text" name="FName" size="20" maxlength="30"></td>
     </tr>
     <tr>
       <td class="bodyarial11">Last Name<font size="1" color="#FF0000">*</font></td>
       <td class="bodyarial11"><input type="text" name="LName" size="20" maxlength="30"></td>
     </tr>
     <tr>
       <td class="bodyarial11">DOB<font size="1" color="#FF0000">*</font></td>
       <td class="bodyarial11"><input name="day" type="text" id="day" size="2" maxlength="2" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)";>
         <input name="month" type="text" id="month" size="2" maxlength="2" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)";>
         <input name="year" type="text" id="year" size="2" maxlength="5" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)";>
         (DD-MM-YYYY)</td>
     </tr>
      <tr>
       <td class="bodyarial11">MobileNo. <font size="1" color="#FF0000">*</font></td>
       <td class="bodyarial11"><input type="text" name="Zero" size="1" value="+91" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)"; readonly><input type="text" name="Phone" size="15" maxlength="10" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)"; ></td>
     </tr>
	 <tr>
       <td class="bodyarial11" align="bottom">Residence / Office No.</td>
	   <td class="bodyarial11"><input type="text" name="Std_Code1" size="1" maxlength="5" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)";><input type="text" name="Phone1" size="15" maxlength="10" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)";></td>
     </tr>
	 
    <tr>
     <td class="bodyarial11">City Name<font size="1" color="#FF0000">*</font></td>
	 
	 <td>
	 <select size="1" name="City" onChange="citycheck(); ">
     <?=getCityList($City)?>
	 </select>
	 </td>
	 </tr>
     <tr>
     <td class="bodyarial11">Others</td>
     <td width="310" class="bodyarial11"><input type="text" name="City_Other" disabled value="Other City" onFocus="this.select();" size="10"></td>
     </tr>
    <tr>
     <td class="bodyarial11">Pincode<font size="1" color="#FF0000">*</font></td>
     <td width="310" class="bodyarial11"><input type="text" name="Pincode" onFocus="this.select();" size="10" maxlength="6" onKeyPress="intOnly(this);" onKeyUp="intOnly(this);"></td>
    
   </tr>
   <!-- <tr>
     <td class="bodyarial11">Residence Address<font size="1" color="#FF0000">*</font></td>
     <td width="310" class="bodyarial11"><textarea rows="3" name="Residence_Address" cols="30"></textarea></td>
    
   </tr>  -->
     <!-- <tr>
     <td class="bodyarial11">Occupation<font size="1" color="#FF0000">*</font></td>
     <td width="310" class="bodyarial11"><select  name="Occupation" class="dropdowns" id="Occupation">
      <option value="Occupation" selected="selected">Occupation </option>
      <option value="Partnership Firm">Partnership Firm</option>
      <option value="Proprietorship Firm">Proprietorship Firm</option>
      <option value="Public Limited">Public Limited</option>
      <option value="Private Limited">Private Limited</option>
      <option value="Others">Others</option>
    </select></td>
    
   </tr> -->
   
    <tr>
     <td class="bodyarial11">Name Of Co./Bussiness<font size="1" color="#FF0000">*</font></td>
     <td width="310" class="bodyarial11"><input class="names" id="Company" name="Company" /></td>
    
   </tr> 
   
    <tr>
     <td class="bodyarial11">Years in Current Business<font size="1" color="#FF0000">*</font></td>
     <td width="310" class="bodyarial11"><select name="Experience" class="dropdowns" id="select2" >
      <option value="experiance_in" selected="selected">Years in Current Business</option>
      <option value="&lt; 1 year">&lt; 1 year</option>
      <option value="1-3 years">1-3 years</option>
      <option value="&gt; 3 years">&gt; 3 years</option>
    </select></td>
    
   </tr> 
   
  
    <tr>
	 <td class="bodyarial11">Which Industry You belongs to?</td>
   <td>
	   <select size="1"  name="Industry" class="style4">
		  <option value="1">Please Select</option> 
		  <option value="Automobile ">Automobile</option> 
		  <option value="Chemical">Chemical</option> 
		  <option value="Construction">Construction</option>
		  <option value="Education">Education</option>
		  <option value="Engineering">Engineering</option>
		  <option value="Gems & jewellery">Gems & jewellery</option> 
		  <option value="IT & ITES">IT & ITES</option> 
		  <option value="Logistics">Logistics</option> 
		  <option value="Pharmaceutical">Pharmaceutical</option>
		  <option value="Retail">Retail</option>
		  <option value="Service">Service</option>
		  <option value="Textiles">Textiles</option> 
		  <option value="Transportation">Transportation</option> 
		  <option value="Travel trade">Travel trade</option> 
		  <option value="Wholesale trader">Wholesale trader</option>
		  <option value="Others">Others</option>
	  </select>
  </td>
  </tr>
  <tr>
	 <td class="bodyarial11">Type of Company ?</td>
   <td>
   <select size="1"  name="Constitution" class="style4">
  <option value="1">Please Select</option> 
  <option value="Partnership Firm">Partnership Firm</option>
  <option value="Proprietorship Firm">Proprietorship Firm</option>
  <option value="Public Limited">Public Limited</option>
  <option value="Private Limited">Private Limited</option>
   <option value="Individual">Individual</option> 
   <option value="Trust">Trust</option>
  <option value="Assosiation">Association</option>
  <option value="Society">Society</option>
   <option value="Others">Others</option>
   </select>
  </td>
  </tr>
	<tr>
	 <td class="bodyarial11">Year of Establishment <font size="1" color="#FF0000">*</font></td>
	 <td><select name="Year_Of_Establishment" class="style4">
	 <option value="1">Please Select</option>
	 <?for($i=1950; $i<=2007; $i++)
	 {
		 echo "<option value='$i'>".$i."</option>";
	 }?>
	 </select></td>
	 </tr>
	 

   <tr>
     <td class="bodyarial11">Annual Income<font size="1" color="#FF0000">*</font></td>
     <td class="bodyarial11">
       <input type="text" name="Net_Salary" id="Net_Salary" size="15" onBlur="getDigitToWords('Net_Salary','formatedSalary','wordSalary');" onKeyUp="getDigitToWords('Net_Salary','formatedSalary','wordSalary'); intOnly(this);" onKeyPress="intOnly(this);"><br> <span id='formatedSalary' style='font-size:11px; font-weight:bold;color:666699;font-Family:Verdana;'></span><span id='wordSalary' style='font-size:11px;
font-weight:bold;color:666699;font-Family:Verdana;text-transform: capitalize;'></span></td>
   </tr>
   <tr>
	 <td class="bodyarial11">Annual Turnover <font size="1" color="#FF0000">*</font></td>
	 <td>
   <select size="1"  name="Annual_Turnover" class="style4">
  <option value="-1">Please Select</option> 
  <option value="1">Below 25 Lacs</option> 
  <option value="2">25-50 Lacs</option> 
  <option value="3">50-75 Lacs</option>
  <option value="4">75-1 Crore</option>
  <option value="5">1-1.25 crore</option>
   <option value="6">1.25 cr& above</option>
   </select>
 <!--  <select name="Annual_Turnover" class="style4" id="Annual_Turnover" >
      <option value="business_turnover" selected="selected">Business Turnover</option>
      <option value="Less than 25 lac">Less than 25 lac</option>
      <option value="More than 25 lac">More than 25 lac</option>
    </select> -->
  </td>
  </tr>
     <tr>
     <td class="bodyarial11">Loan Amount Required<font size="1" color="#FF0000">*</font></td>
     <td class="bodyarial11"> <input type="text"  id="Loan_Amount" name="Loan_Amount" size="15" maxlength="30" onBlur="getDigitToWords('Loan_Amount','formatedIncome','wordIncome');" onKeyUp="getDigitToWords('Loan_Amount','formatedIncome','wordIncome'); intOnly(this);" onKeyPress="intOnly(this);"><br> <span id='formatedIncome' style='font-size:11px; font-weight:bold;color:666699;font-Family:Verdana;'></span><span id='wordIncome' style='font-size:11px;
font-weight:bold;color:666699;font-Family:Verdana;text-transform: capitalize;'></span></td>
   </tr>
   
    <tr>
			<td class="bodyarial11" >Are you a Credit card holder?</td> <td  class="bodyarial11" ><input type="radio" name="CCbusiness"  class="NoBrdr" value="1"  onclick="addElementCC();" >Yes
			
			<input type="radio" class="NoBrdr" name="CCbusiness" value="0" onClick="removeElementCC();" checked >No</td></tr>
		 <tr><td colspan="2" id="myDivCC"></td></tr>
		 
		 <tr>
					<td  class="bodyarial11">Any Loan running?</td>
					<td  class="bodyarial11"  ><input type="radio"   value="1"  name="LoanAny" class="NoBrdr" onclick="addElementLoan();">Yes <input type="radio" name="LoanAny" class="NoBrdr" onclick="removeElementLoan();" value="0" checked > No</td><tr>
				<tr><td colspan="4" id="myDivLoan"></td></tr>
    
      <tr>
     <td colspan="2" align="center"><br><input type="hidden" name="source" value="sms">
	 <input type="submit" class="bluebutton" value="Submit" name="submit"> 
       &nbsp;
       <input type="reset" class="bluebutton" value="Reset"></td>
   </tr>
     </table>
 </form>
 </td></tr></table>
</body>
</html>
