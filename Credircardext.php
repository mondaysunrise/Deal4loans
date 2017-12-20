<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';

?>
<html>

<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>Apply online for credit cards in Delhi, Gurgaon & Noida | Credit cards Mumbai</title>
<meta name="description" content="Get online information about credit card schemes from all credit cards provider banks located in major cities of India like Mumbai, Delhi, Gurgaon, Bangalore, Ahmedabad, Chennai, Hyderabad, Navi Mumbai, Kochi etc. ">
<meta name="keywords" content="apply online for credit cards, credit cards, credit card plans, online credit card, Noida, Mumbai, Delhi, Bangalore">
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<link rel="stylesheet" type="text/css" href="css/menu.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<link href="includes/style.css" rel="stylesheet" type="text/css">
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
function cityother()
{
	if(loan_form.City.value=="Others")
	{
		loan_form.City_Other.disabled = false;
	}
	else
	{
		loan_form.City_Other.disabled = true;
	}
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

function retain(strPlan)
{
	if(document.loan_form.Email.value!="")
	{
	   if ((document.getElementById('plantype') != undefined)  && (document.getElementById('plantype1') != undefined))
       {
               document.getElementById('plantype').innerHTML = strPlan;
			     document.getElementById('plantype1').innerHTML = strPlan;
       }
	}
       return true;
	}
function Decoration(strPlan)
{
       if ((document.getElementById('plantype') != undefined)  && (document.getElementById('plantype1') != undefined))
       {
               document.getElementById('plantype').innerHTML = strPlan;
			     document.getElementById('plantype1').innerHTML = strPlan;
       }

       return true;
}
function Decoration1(strPlan)
{
       if ((document.getElementById('plantype') != undefined)  && (document.getElementById('plantype1') != undefined))
       {
               document.getElementById('plantype').innerHTML = strPlan;
			     document.getElementById('plantype1').innerHTML = strPlan;
       }

       return true;
}
function chkform()
{
<?
if($_SESSION['UserType']=="") 
{
?>	
	if(document.loan_form.Email.value!="")
	{
		if (!validmail(document.loan_form.Email.value))
		{
			//alert("Please enter your valid email address!");
			document.loan_form.Email.focus();
			return false;
		}
		if(document.loan_form.PWD1.value=="")
		{
			alert("please fill password.");
			document.loan_form.PWD1.focus();
			return false;
		}
		if(document.loan_form.PWD2.value=="")
		{
			alert("please retype password.");
			document.loan_form.PWD2.focus();
			return false;
		}
		if(document.loan_form.PWD1.value!=document.loan_form.PWD2.value)
		{
			alert("Both password must be same.");
			document.loan_form.PWD1.focus();
			return false;
		}
	}
	
	if(document.loan_form.PWD1.value!=document.loan_form.PWD2.value)
	{
		alert("Both password must be same.");
		document.loan_form.PWD1.focus();
		return false;
	}
<?
}
?>
	if(document.loan_form.FName.value=="")
	{
		alert("Please fill your first name.");
		document.loan_form.FName.focus();
		return false;
	}
	if(document.loan_form.LName.value=="")
	{
		alert("Please fill your Last name.");
		document.loan_form.LName.focus();
		return false;
	}
	if(document.loan_form.day.value=="")
	{
		alert("Please fill your day of birth.");
		document.loan_form.day.focus();
		return false;
	}
	if(!checkData(document.loan_form.day, 'Day', 2))
		return false;
	if(document.loan_form.month.value=="")
	{
		alert("Please fill your month of birth.");
		document.loan_form.month.focus();
		return false;
	}
	if(!checkData(document.loan_form.month, 'Month', 2))
		return false;
	if(document.loan_form.year.value=="")
	{
		alert("Please fill your year of birth.");
		document.loan_form.year.focus();
		return false;
	}
	if(!checkData(document.loan_form.year, 'Year', 4))
		return false;
	if(document.loan_form.Phone.value=="")
	{
		alert("Please fill your mobile number.");
		document.loan_form.Phone.focus();
		return false;
	}
	if(document.loan_form.Phone.value!="")
	{
		if (!validmobile(document.loan_form.Phone.value))
		{
			//alert("Please enter your valid email address!");
			document.loan_form.Phone.focus();
			return false;
		}
	}
	if(document.loan_form.Phone1.value!="")
	{
		if(document.loan_form.Std_Code1.value=="")
		{
			alert("Please fill your STD Code for Residence Landline number.");
			document.loan_form.Std_Code1.focus();
			return false;
		}
	}
	if(document.loan_form.Phone2.value!="")
	{
		if(document.loan_form.Std_Code2.value=="")
		{
			alert("Please fill your STD Code for Office Landline number.");
			document.loan_form.Std_Code2.focus();
			return false;
		}
	}
	if(!checkData(document.loan_form.Company_Name, 'Company Name', 5))
		return false;
		
	if (document.loan_form.City.selectedIndex==0)
	{
		alert("Please enter City Name to Continue");
		document.loan_form.City.focus();
		return false;
	}
	if((document.loan_form.City.value=="Others") && (document.loan_form.City_Other.value=="" || document.loan_form.City_Other.value=="Other City"  ) || !isNaN(document.loan_form.City_Other.value))
	{
		alert("Kindly fill your Other City!");
		document.loan_form.City_Other.focus();
		return false;
	}
	
	if (document.loan_form.Total_Experience.value=="")
	{
		alert("Please enter Total Experience.");
		document.loan_form.Total_Experience.focus();
		return false;
	}
	if(!checkNum(document.loan_form.Total_Experience, 'Total Experience',0))
		return false;
		
	if (document.loan_form.Net_Salary.value=="")
	{
		alert("Please enter Net Salary.");
		document.loan_form.Net_Salary.focus();
		return false;
	}
	if(!checkNum(document.loan_form.Net_Salary, 'Net Salary',0))
		return false;
}  
</script>
</head>

<body>
<table width="712" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><?php include '~Top.php'; ?></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="202" align="left" valign="top">     <?php if(session_is_registered('Email'))
		{
		include '~Left.php';
		}
		else
		{
		include '~Login.php';
		}
?></td>
	<td width="510" valign="top"><table width="510"  border="0" cellspacing="0" cellpadding="0">
		<tr>
		 <td width="23">&nbsp;</td>
            <td>
  <form name="loan_form" method="post" action="<? echo $_SERVER['PHP_SELF'] ?>" onSubmit="return chkform();">
 <p class="head2" align="center">
   Credit Card Request</p>
 <table width="450" border="0" cellpadding="4" cellspacing="0" class="blueborder" id="frm">
   
    
   <tr>
            <td width="25%" class="bodyarial11">Do You Have Pan Card</td>
     <td width="75%" class="bodyarial11">
     <input type="radio" name="Pancard" class="noBrdr">Yes<input type="radio" name="Pancard" class="noBrdr">No</td>
   </tr>
   <tr>
      <td width="25%" class="bodyarial11">credit Card</td>
     <td width="75%" class="bodyarial11"><table border="0">
	 <tr><td>
     <input type="checkbox" name="Bank" class="noBrdr">ANZ Grindlays</td><td><input type="checkbox" class="noBrdr" name="Bank" >HSBC</td><td><input type="checkbox" name="Bank" class="noBrdr" >SBI GE</td><td><input type="checkbox" name="Bank" class="noBrdr">HDFC</td></tr><tr><td><input type="checkbox" name="Bank" class="noBrdr">Canara Bank</td><td><input type="checkbox" class="noBrdr" name="Bank" >Amex</td><td><input type="checkbox" name="Bank" class="noBrdr">ABN AMRO</td><td><input type="checkbox" name="Bank" class="noBrdr" >SBI</td></tr><tr><td><input type="checkbox" name="Bank" class="noBrdr" >Andhra Bank</td><td> <input type="checkbox" name="Bank" class="noBrdr">ICICI</td><td colspan="2"><input type="checkbox" name="Bank" class="noBrdr">Standard Chartered</table></td></tr>
   <tr>
     <td colspan="2" align="center" class="bodyarial11"><br>
       <input type="submit" class="bluebutton" value="Submit">
       &nbsp;
       <input type="reset" class="bluebutton" value="Reset"></td>
   </tr>
  <tr>
     <td colspan="2"><font style="font-weight:normal; font-size:9;">Clicking "Submit" means that you agree to the terms of the Deal4Loans <a href="Privacy.html" target="_blank">Terms and Condition</a> and <a href="Privacy.html" target="_blank">Privacy</a> statement.</font>	</td> 
   </tr>
   <tr>
     <td colspan="2"><font size="-10" style="font-size:9; font-weight:normal;">** If you do not select this option, your privacy is assured & you will receive SMS & Emails.Otherwise your contact details will be shared with the associated banks.</font>	</td> 
   </tr>
  </table>
 </form>
 
     </td>
     </tr>
            </table></td>
        <td>
	  <?php include '~Right.php';?>
	<!--  <img src="images/120_90.gif"><BR><BR>
	  	  <img src="images/120_240.gif">
	  -->
	  </td>
		  </tr>
        </table></td>
		
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><?php include '~Bottom.php';?></td>
  </tr>
</table>
</body>
</html>