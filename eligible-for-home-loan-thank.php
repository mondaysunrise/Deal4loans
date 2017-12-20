<?php
	require 'scripts/session_check.php';
    require 'scripts/db_init.php';
	require 'scripts/functions.php';
	//session_start();
	//print_r($_POST);
		$doc = $_POST['doc'];
		$docStr = implode(",", $doc);
		$insertedID = $_POST['insertedID'];
		$dataUpdate = array('documents'=>$docStr);
		$wherecondition = "(id = '".$insertedID."')";
		Mainupdatefunc ('home_loan_eligibility', $dataUpdate, $wherecondition);
?>
	
<html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Home Loans India Apply Compare | Housing Mortage Loan</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<meta name="description" content="Deal4Loans is an online loan information portal, provides valuable information on all types of loans in India offered by top banks. Read and apply online for home loans & Get, Compare and Choose deals from all the leading loan providers / banks. Know the interest rates, EMIs, Loan amount etc choose the Best Deal.">
<meta name="keywords" content="Home loans India, Apply Home Loans, Compare Home Loans in Mumbai Hyderabad Pune kolkata Delhi Noida Bangalore">
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<script type="text/javascript" src="scripts/calendardateinput.js"></script>
<script language="JavaScript" type="text/javascript" src="images/rollovers.js"></script>
<script type="text/javascript" src="js/dropdowntabs.js"></script>
<link rel="stylesheet" href="home_style.css" type="text/css" />
<!--<script type="text/javascript" src="js/jquery.js"></script>
 -->
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

function check_form(Form)
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
	
	if(Form.month.selectedIndex==0)
	{
		alert("Please enter DOB Month");
		Form.month.focus();
		return false;
	}
	if(Form.day.selectedIndex==0)
	{
		alert("Please enter DOB Day");
		Form.day.focus();
		return false;
	}
	if(Form.year.selectedIndex==0)
	{
		alert("Please enter DOB Year");
		Form.year.focus();
		return false;
	}
	if(Form.company_name.value=="")
	{
		alert('Please enter Company Name');
		Form.company_name.focus();
		return false;
	}
	if(Form.Employment_Status.selectedIndex==0)
	{
		alert("Please enter your Employment Status");
		Form.Employment_Status.focus();
		return false;
	}
	if(Form.monthly_income.value=="")
	{
		alert('Please enter Monthly Income');
		Form.monthly_income.focus();
		return false;
	}
	
	if((Form.loan_amount.value==""))
	{
		alert('Please enter Loan Amount');
		Form.loan_amount.focus();
		return false;
	}
	if((Form.loan_amount.value!=""))
	{
		if((Form.loan_amount.value <500000))
		{
			alert('Please enter Loan Amount greater then 500000');
			Form.loan_amount.focus();
			return false;
		}
	}
	
	if(Form.co_appli.checked)
	{

		if((Form.co_name.value=="") || (Form.co_name.value=="Full Name")|| (Trim(Form.co_name.value))==false)
		{
			alert("Kindly fill in Co Applicant Name!");
			Form.co_name.focus();
			return false;
		}
		else if(containsdigit(Form.co_name.value)==true)
		{
			alert("Name contains numbers!");
			Form.co_name.focus();
			return false;
		}
	    for (var i = 0; i < Form.co_name.value.length; i++) 
	    {
			if (iChars.indexOf(Form.co_name.value.charAt(i)) != -1) 
			{
				alert ("Name has special characters.\n Please remove them and try again.");
				Form.co_name.focus();
				return false;
			}
		}
		if(Form.co_month.selectedIndex==0)
		{
			alert("Please enter DOB Month");
			Form.co_month.focus();
			return false;
		}
		if(Form.co_day.selectedIndex==0)
		{
			alert("Please enter DOB Day");
			Form.co_day.focus();
			return false;
		}
		if(Form.co_year.selectedIndex==0)
		{
			alert("Please enter DOB Year");
			Form.co_year.focus();
			return false;
		}
		if(Form.co_monthly_income.value=="")
		{
			alert('Please enter Co Applicant Monthly Income.');
			Form.co_monthly_income.focus();
			return false;
		}
		
		
	}
	/*if(Form.co_income.value=="")
	{
		alert("Please enter Co-Applicant's Annual Income");
		Form.co_income.focus();
		return false;
	}*/
		
}
</script>
<script language="JavaScript">
	  function showdetailsFaq(d,e)
			{			
				for(j=1;j<=e;j++)
					{
						if(d==j)
							{
								if(eval(document.getElementById("divfaq"+j)).style.display=='none')
									{
									
										eval(document.getElementById("divfaq"+j)).style.display=''
										//eval(document.getElementById("imgfaq"+j)).src='images/minus2.gif'
									}
								else
									{
										
										eval(document.getElementById("divfaq"+j)).style.display='none'
										//eval(document.getElementById("imgfaq"+j)).src='images/plus2.gif'
									}
							}
						
					}
			}
							window.onload=showdetailsFaq
</script>
</head>
<body>
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
            <td width="197" height="160" align="left" valign="top"><img src="images/headr_lft.jpg" width="197" height="160" /></td>
            <td width="175" align="left"><img src="images/header-mdl.jpg" width="175" height="160" /></td>
            <td width="208"><img src="images/hl_header_rgt.jpg" width="208" height="160" /></td>
          </tr>
        </table></td>
      </tr>
      
      <tr>
        <td height="8" valign="top"  ></td>
      </tr>
      <tr>
        <td   style=" background-color:#EFE6CB; border:3px solid #FFFFFF; " valign="top" height="260"><table width="97%"  border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td height="33" align="center" class="text" style="text-align:center; font-size:12px; "><b>Thank You</b> </td>
      </tr>
      <tr>
        <td height="33" align="center" class="text" style="text-align:center; font-size:12px;" ><b>ICICI HFC representative will call you shortly!!</b></td>
      </tr>
      <tr>
        <td height="120" align="center" class="text"  >&nbsp;</td>
      </tr>
      
    </table></td>
      </tr>
	  <tr>
	  <td height="5"></td>
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
