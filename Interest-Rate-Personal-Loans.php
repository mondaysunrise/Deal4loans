<?php
	header("Location: personal-loan-interest-rate.php");
	require 'scripts/functions.php';
	
	?>
<html>
<head>

<title>Personal loan Interest Rates Comparison Chart | Deal4loans</title>
<meta name="keywords" content="Best Personal Loan Rates, Best Interest Rates, personal loans, personal loan, personal loans India, personal loan in India, personal loan interest rates,  personal loan rates in India, personal finance loans, compare personal loan rates, personal loans at least interest rate">
<meta name="verify-v1" content="iC5qAw9C0E3rRZYbtAKvnPHmBSQU3zWJu5Ooj8hO3Og=">
<meta name="description" content="Complete Personal Loan interest rate chart. Compare personal loan interest rates from AbnAmro Bank, Axis Bank, Bank of Baroda, Barclays Finance, Canara Bank, Citibank, Citifinancial, Corporation Bank, HDFC Bank, Oriental Bank of Commerce, Reliance and SBI">
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<meta http-equiv="refresh" content="900">
<link href="includes/style1.css" rel="stylesheet" type="text/css">
 <script Language="JavaScript" Type="text/javascript">
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
function validmobile(phone) 
{
	
	atPos = phone.indexOf("0")// there must be one "@" symbol
	if (atPos == 0) 
	{
		alert("Mobile number cannot start with 0.");
		return false;
	}
	if(!checkData(document.loan_form.mobile, 'Mobile number', 10))
		return false;

return true;
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

 if (document.loan_form.Type_Loan.selectedIndex==0)
	{
		alert("Please enter the type of loan you are looking for");
		document.loan_form.Type_Loan.focus();
		return false;
	}
	if(document.loan_form.fullname.value=="")
	{
		alert("Please fill your name.");
		document.loan_form.fullname.focus();
		return false;
	}
 
  if(document.loan_form.mobile.value=="")
	{
		alert("Please fill your mobile no.");
		document.loan_form.mobile.focus();
		return false;
	}
	  if(isNaN(document.loan_form.mobile.value)|| document.loan_form.mobile.value.indexOf(" ")!=-1)
		{
              alert("Enter numeric value");
			  document.loan_form.mobile.focus();
			  return false;  
		}
        if (document.loan_form.mobile.value.length < 10 )
		{
                alert("Please Enter 10 Digits"); 
				 document.loan_form.mobile.focus();
				return false;
        }
        if (document.loan_form.mobile.value.charAt(0)!="9")
		{
                alert("The number should start only with 9");
				 document.loan_form.mobile.focus();
                return false;
		}
/*	if(document.loan_form.mobile.value!="")
	{
		if (!validmobile(document.loan_form.mobile.value))
		{
			//alert("Please enter your valid email address!");
			document.loan_form.mobile.focus();
			return false;
		}
	}
*/
	if(document.loan_form.email_id.value=="")
	{
		alert("Please fill your email id.");
		document.loan_form.email_id.focus();
		return false;
	}
	 if(document.loan_form.email_id.value!="")
	{
		if (!validmail(document.loan_form.email_id.value))
		{
			//alert("Please enter your valid email address!");
			document.loan_form.email_id.focus();
			return false;
		}
		
	
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
</script>	<? $tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-1, date("Y"));
$currentdate=date('d F Y',$tomorrow);
?> 
<?php include '~Top.php';?>
<div id="dvMainbanner">
<?php include '~Upper.php';?>           
</div>
  <!-- End Main Banner Menu Panel -->
  <!-- Start Main Container Panel -->
  <div id="dvContentPanel">
  <div id="dvMaincontent" style="margin-top:0px;">
  <table width="774" cellpadding="0" cellspacing="0">
  <tr>
    <td  valign="top" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; text-align:justify; padding:0px 4px;"> <H1 class="pg_heading" style="margin-bottom:0px;">Interest Rates for Personal Loans</H1><div align="center">( Last edited on : <? echo $currentdate; ?> )</div>
      <p>
      Personal loan rates in India depend on various criteria, one being the income level. Different banks have different classifications based on which interest rates are calculated. To start with whether you are working for an employer (salaried) or you are an employer yourself (self – employed). The factors which determine your Personal Loan interest rates are as follows: -<br>
	  

&bull; Income<br>
&bull; Your Company Status<br>
&bull; Credit and Payment history.<br>
&bull; Relationship with the Bank you intend to take loan from.<br>
&bull; Individual’s Negotiating Ability.
</p>

</td>
      <td width="237" align="left" valign="top"><? if(!isset($_SESSION['UserType'])) 
  {
  include 'right-interestrate.php';
  }
  ?></td>
    </tr>
	
	<tr>
	<td colspan="2" valign="top"  style="color:#333333; text-align:justify;"><b>Read below how these factors effect your Interest rates</b><font color="#FF0000">**</font><br>
To help its customers get the best interest rates on personal loans deal4loans has consolidated all the information regarding latest rate of interests at one place. Please keep visiting this section to get updated rates of interests on personal loans.<br>
<br>

</td>
	</tr>
  
  <tr>
     <td align="left" colspan="2"><table width="777"  border="0" cellpadding="1" cellspacing="1" bgcolor="d5cfb1">
       <tr bgcolor="#E8F0F6">
         <td width="99" rowspan="2" align="center" bgcolor="#494949" class="tblwt_txt" ><b>Banks/Rates</b></td>
         <td height="25" colspan="5" align="center" bgcolor="#494949" class="tblwt_txt"><b>Salaried</b></td>
         </tr>
       <tr bgcolor="#494949" >
         <td width="131"  height="30" align="center" class="tblwt_txt"><b>CAT A</b></td>
         <td width="134"  height="30" align="center" bgcolor="#494949" class="tblwt_txt"><b>CAT B</b></td>
         <td width="139" align="center" class="tblwt_txt"><b>Others</b></td>
         <td width="107" align="center" class="tblwt_txt"><b>Pre-Payment Charges</b></td>
		   <td width="141" align="center" class="tblwt_txt"><b>Processing Fees</b></td>
       </tr>
       <tr bgcolor="#F6F4ED">
         <td height="25" align="center" bgcolor="#FFFFFF"  > <b>AbnAmro Bank</b> </td>
         <td align="center" bgcolor="#FFFFFF" class="tbl_txt">16%-23%</td>
		  <td align="center" bgcolor="#FFFFFF" class="tbl_txt">16%-23%</td>
		   <td align="center" bgcolor="#FFFFFF" class="tbl_txt">16%-23%</td>
         <td align="center" bgcolor="#FFFFFF" class="tbl_txt">4%-5%</td>
         <td align="center" bgcolor="#FFFFFF" class="tbl_txt">2.25%</td>
       </tr>
      <!-- <tr bgcolor="#EFEEEE">
         <td height="25" align="center" class="tbl_txt"><b>Axis Bank </b></td>
         <td  align="center" class="tbl_txt">15%-21%</td>
          <td  align="center" class="tbl_txt">15%-21%</td>
          <td  align="center" class="tbl_txt">15%-21%</td>
          <td align="center" class="tbl_txt">N.A.</td>
         <td align="center" class="tbl_txt">2%</td>
       </tr>-->
	   <tr bgcolor="#EFEEEE">
	     <td height="30" align="center" bgcolor="#FFFFFF" class="tbl_txt"><b>Bank of Baroda</b></td>
	     <td height="30" align="center" bgcolor="#FFFFFF" class="tbl_txt">14.50%</td>
	     <td height="30" align="center" bgcolor="#FFFFFF" class="tbl_txt">14.50%</td>
	     <td height="30" align="center" bgcolor="#FFFFFF" class="tbl_txt">14.50%</td>
	     <td align="center" bgcolor="#FFFFFF" class="tbl_txt">2%</td>
	     <td align="center" bgcolor="#FFFFFF" class="tbl_txt">N.A.</td>
	     </tr>
	   <tr bgcolor="#F6F4ED">
         <td height="30" align="center" bgcolor="#FFFFFF" class="tbl_txt"><b>Barclays Finance<br>
         </b></td>
         <td height="30" align="center" bgcolor="#FFFFFF" class="tbl_txt">21%-33%</td>
          <td height="30" align="center" bgcolor="#FFFFFF" class="tbl_txt">21%-33%</td>
         <td height="30" align="center" bgcolor="#FFFFFF" class="tbl_txt">21%-33%</td>
		 <td align="center" bgcolor="#FFFFFF" class="tbl_txt">5%</td>
         <td align="center" bgcolor="#FFFFFF" class="tbl_txt">2%</td>
       </tr>
       <tr bgcolor="#EFEEEE">
         <td height="25" align="center" bgcolor="#FFFFFF" class="tbl_txt"><b>Canara Bank</b></td>
         <td align="center" bgcolor="#FFFFFF" class="tbl_txt">13%</td>
          <td align="center" bgcolor="#FFFFFF" class="tbl_txt">13%</td>
         <td align="center" bgcolor="#FFFFFF" class="tbl_txt">13%</td>
         <td align="center" bgcolor="#FFFFFF" class="tbl_txt">N.A.</td>
         <td align="center" bgcolor="#FFFFFF" class="tbl_txt">0.50%</td>
       </tr>
       <tr bgcolor="#F6F4ED">
         <td height="25" align="center" bgcolor="#FFFFFF" class="tbl_txt"><b>Citibank</b></td>
         <td align="center" bgcolor="#FFFFFF" class="tbl_txt">16.5%-18%</td>
         <td align="center" bgcolor="#FFFFFF" class="tbl_txt">18%-20%</td>
         <td align="center" bgcolor="#FFFFFF" class="tbl_txt">19%-21%</td>
         <td align="center" bgcolor="#FFFFFF" class="tbl_txt">5%</td>
         <td align="center" bgcolor="#FFFFFF" class="tbl_txt">2%</td>
       </tr>
	  <!-- <tr bgcolor="#EFEEEE">
         <td height="30" align="center" bgcolor="#FFFFFF"  class="tbl_txt"><b>Citifinancial</b></td>
         <td height="30" align="center" bgcolor="#FFFFFF" class="tbl_txt">16% - 18%</td>
         <td align="center" bgcolor="#FFFFFF" class="tbl_txt">18% - 20%</td>
         <td align="center" bgcolor="#FFFFFF" class="tbl_txt">19%-21%</td>
         <td align="center" bgcolor="#FFFFFF" class="tbl_txt">4%</td>
         <td align="center" bgcolor="#FFFFFF" class="tbl_txt">2%</td>
       </tr>-->
	   <tr bgcolor="#F6F4ED">
	     <td height="30" align="center" bgcolor="#FFFFFF"  class="tbl_txt"><b>Corporation Bank
</b></td>
	     <td height="30" align="center" bgcolor="#FFFFFF" class="tbl_txt">14.50%</td>
	     <td align="center" bgcolor="#FFFFFF" class="tbl_txt">14.50% </td>
	     <td align="center" bgcolor="#FFFFFF" class="tbl_txt">14.50% </td>
	     <td align="center" bgcolor="#FFFFFF" class="tbl_txt">N.A.</td>
	     <td align="center" bgcolor="#FFFFFF" class="tbl_txt">1.50% or Rs.500 whichever is higher</td>
	     </tr>
       
       <tr bgcolor="#EFEEEE">
         <td align="center" bgcolor="#FFFFFF" class="tbl_txt"><b>HDFC Bank</b></td>
         <td align="center" bgcolor="#FFFFFF" class="tbl_txt">14.5% (for 75,000 & above salary),<br>
           15.5% (for 35,000-75,000 salary),<br> 
           16.5% (upto 35,000 salary)</td>
         <td align="center" bgcolor="#FFFFFF" class="tbl_txt">17%
           (for 35,000 & above salary), <br>
           19% (upto 35,000 salary)</td>
         <td align="center" bgcolor="#FFFFFF" class="tbl_txt">22%(for 35,000 & above salary),<br> 
           24% (upto 35,000 salary)</td>
         <td align="center" bgcolor="#FFFFFF" class="tbl_txt">4%</td>
         <td align="center" bgcolor="#FFFFFF" class="tbl_txt">0.5%(if salaried account in HDFC) if not than 2%</td>
       </tr>
       
       
       
       
	   
	   <tr bgcolor="#F6F4ED">
	     <td height="30" align="center" bgcolor="#FFFFFF"  class="tbl_txt"><b>Oriental Bank of Commerce</b></td>
	     <td height="30" align="center" bgcolor="#FFFFFF" class="tbl_txt">13%</td>
	     <td align="center" bgcolor="#FFFFFF" class="tbl_txt">13%</td>
	     <td align="center" bgcolor="#FFFFFF" class="tbl_txt">13%</td>
	     <td align="center" bgcolor="#FFFFFF" class="tbl_txt">N.A.</td>
	     <td align="center" bgcolor="#FFFFFF" class="tbl_txt">0.50%</td>
	     </tr>
	   <tr bgcolor="#EFEEEE">
         <td height="30" align="center" bgcolor="#FFFFFF"  class="tbl_txt"><b>Reliance</b></td>
         <td height="30" align="center" bgcolor="#FFFFFF" class="tbl_txt">23%</td>
         <td align="center" bgcolor="#FFFFFF" class="tbl_txt">23%</td>
         <td align="center" bgcolor="#FFFFFF" class="tbl_txt">23%</td>
         <td align="center" bgcolor="#FFFFFF" class="tbl_txt">5%</td>
         <td align="center" bgcolor="#FFFFFF" class="tbl_txt">2%</td>
       </tr>
	   <tr bgcolor="#F6F4ED">
	     <td height="30" align="center" bgcolor="#FFFFFF"  class="tbl_txt"><b>SBI</b>&nbsp;</td>
	     <td height="30" align="center" bgcolor="#FFFFFF" class="tbl_txt">16.50%</td>
 	     <td height="30" align="center" bgcolor="#FFFFFF" class="tbl_txt">16.50%</td>
	     <td height="30" align="center" bgcolor="#FFFFFF" class="tbl_txt">16.50%</td>
	     <td align="center" bgcolor="#FFFFFF" class="tbl_txt">N.A.</td>
	     <td align="center" bgcolor="#FFFFFF" class="tbl_txt">2%-3%</td>
	     </tr>
     </table></td>
  </tr>
</table>

  
	<!-------place form here------------>	<?php 

///if(strpos($_SERVER['HTTP_USER_AGENT'], "MSIE 6.0") > 0)
//{
?>
<!-- IE 6.0 -->
	<!-- <table width="237" border="0" align="center" cellpadding="0" cellspacing="0"  class="blueborder" >
<?php
//}
//else //{
?>

	 <table width="237" border="0" align="center" cellpadding="0" cellspacing="0"  class="blueborder" >


	<?php //} ?>

	 <tr bgcolor="#529BE4">
	 <td height="20" colspan="2" align="center" class="quick"  style="font-size:13px; font-family: Arial, Helvetica, sans-serif; font-weight:bold;color:#FFFFFF;">Apply Here </td>
	 </tr><tr><td bgcolor="#FFFFFF">
	 	<form name="loan_form" method="post" action="/Right.php" onSubmit="return chkform();">

	 <table width="95%"  border="0" align="center" cellpadding="0" cellspacing="4" >
	 
	 
	 <td width="40%" align="left" class="quick">Product Type</td>
	 <td width="70%" align="right">
	 <select style="width:130px;" name="Type_Loan">
	  <option value="1">Please select</option>
	  <option value="Req_Loan_Personal">Personal Loan</option>
	   <option value="Req_Loan_Home">Home Loan</option>
	   <option value="Req_Loan_Car">Car loan</option>
	   <option value="Req_Loan_Against_Property">Loan against Property</option>
	   <option value="Req_Credit_Card">Credit Card</option>
	   <option value="Req_Business_Loan">Business Loan</option>
	 </select></td>
	 </tr>
  <tr align="left"><td colspan="2"  width="4"><input type="hidden" name="source" value="QuickApply"></td>
		  </tr>
	 <tr>
	 <td align="left" class="quick">Full Name</td>
	 <td align="right" ><input type="text" name="fullname" style="width:130px;" maxlength="30"></td>
	 </tr>
	<tr>
	 <td align="left" class="quick">Mobile</td>
	 <td align="right" class="quick">+91
	   <input type="text" style="width:100px;" maxlength="10" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" name="mobile"></td>
	 </tr>
	 <tr>
	 <td align="left" class="quick">Email id</td>
	 <td align="right" ><input type="text" name="email_id" style="width:130px;"></td>
	 </tr>
	 <tr><td colspan="2"></td></tr>
	 <tr><td colspan="2" align="center"> <input type="submit" class="bluebutton" value="Submit" >&nbsp;
            <input type="reset" class="bluebutton" value="Reset" ></td></tr>
	 </table>
	 </form></td></tr>
	 
	 
	   
</table>--><br>

<b>Where</b><br>
<table border="0" cellspacing="0" cellpadding="0" style="color:#333333;">
  <tr>
    <td width="163" height="20">CAT A refers to</td>
    <td width="204">- Top 1000 companies</td>
  </tr>
  <tr>
    <td height="20">CAT B refers to</td>
    <td>- Multi National Companies( MNC's )</td>
  </tr>
  <tr>
    <td height="20">CAT C refers to</td>
    <td>- Small companies</td>
  </tr>
    <tr>
    <td height="20">Non Listed refers to</td>
    <td>- Smaller companies with 100 emloyees.</td>
  </tr>
    <tr>
    <td height="20">Loan Surrogates refers to </td>
    <td>- Any running loan from any bank</td>
  </tr>
</table>

<br>
<div style="width:750px; float:left;">
<b>Income :</b> If your Income is above a certain limit,Banks believe that
your chances of not paying are lesser as you have Income to pay.
Income above 75 per month usually gets some discounts from all Banks.<br>

<b>Your Company Status :</b> If the company you are working with is a well
known corporate,the Banks feel that you are less likely to shift from
your job and will result in lesser defaults.<br>


<b>Credit and Payment History :</b> Banks follows Cibil scores/rating before
deciding giving loans.If your payments for Credit Cards and Loans is
not upto mark , you have the most likely chance of being rejected for
the loan or the Bank will give you at amuch higher rate.<br>

<b>Relationship with Bank :</b>The Bank where you have your Salary
account/Savings account is likely to pass on you to some special rate
for your Loans or Processing fee.<br>

<b>Individuals Negotiating Skills :</b>Based on your above points you can
always ask Bank to give you waivers on Rates, Fees Etc. <br>
<br>
<span style="color:#666666;"><b>Disclaimer:</b> Please note that the interest rates given here are based on the market research. To enable the comparisons certain set of data has been reorganized / restructured / tabulated .Users are advised to recheck the same with the individual companies / organizations. This site does not take any responsibility for any sudden / uninformed changes in interest rates.<br>
Banks/ Financial Institutions can contact us at  <a href="mailto:customercare@deal4loans.com" style="color:#0F74D4;">customercare@deal4loans.com</a> for inclusions or updates. </span><br>
<br>

</div>
</div>
</div>
<?php include '~Bottom.php';?>
  </body>
</html>