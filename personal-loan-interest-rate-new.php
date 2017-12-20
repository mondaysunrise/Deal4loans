<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'>  
<title>Personal loan Interest Rates | Personal Loan Rates | Deal4loans</title>
<meta name="keywords" content="Personal Loan Interest Rates, Personal Loans Interest Rates, Best Interest Rates, personal loans, personal loan, personal loan rates in India, Compare personal loan rates, personal loans at least interest rate">
<meta name="description" content="Personal Loan Interest rates: Instant quotes of Personal Loan Rates. Compare personal loans interest rate of Sbi, ICICI, HDFC, Citibank, Abn Amro Bank, Axis Bank, Bank of Baroda, Barclays Finance, Canara Bank, Citibank, Citifinancial, Corporation Bank, Reliance finance">
<link href="source.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="scripts/mainmenu.js"></script>
<script type="text/javascript" src="scripts/common.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<script>


	function chkpersonalloan()
{
	var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
	var dt,mdate;dt=new Date();
	//var i;
	var cnt;
	var alpha=/^[a-zA-Z\ ]*$/;
	var alphanum=/^[a-zA-Z0-9]*$/;
	var num=/^[0-9]*$/;
	var space=/^[\ ]*$/;
	var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";


	if((document.plloan_form.Name.value=="") || (Trim(document.plloan_form.Name.value))==false)
	{
        alert("Please Enter Your name");		
		document.plloan_form.Name.focus();
		return false;
	}

	if(document.plloan_form.Name.value!="")
	{
		if(containsdigit(document.plloan_form.Name.value)==true)
		{
			alert("Full Name contains numbers!");
			document.plloan_form.Name.focus();
			return false;
		}
	}
   for (var i = 0; i <document.plloan_form.Name.value.length; i++) 
   {
		if (iChars.indexOf(document.plloan_form.Name.value.charAt(i)) != -1) 
		{
			alert("Contains special characters!");
			document.plloan_form.Name.focus();
			return false;
		}
  }
  if(document.plloan_form.Email.value=="")
	{
		alert("Enter  Email Address!");	
		document.plloan_form.Email.focus();
		return false;
	}
	
	var str=document.plloan_form.Email.value
	var aa=str.indexOf("@")
	var bb=str.indexOf(".")
	var cc=str.charAt(aa)

	if(aa==-1)
	{
		alert("Enter Valid Email Address!");	
		document.plloan_form.Email.focus();
		return false;
	}
	else if(bb==-1)
	{
		alert("Enter Valid Email Address!");	
		document.plloan_form.Email.focus();
		return false;
	}
		
	if (document.plloan_form.City.selectedIndex==0)
	{
		alert("Enter City to Continue!");	
		document.plloan_form.City.focus();
		return false;
	}
	if((document.plloan_form.City.value=="Others") && ((document.plloan_form.City_Other.value=="" || document.plloan_form.City_Other.value=="Other City"  ) || !isNaN(document.plloan_form.City_Other.value)))
	{
		alert("Enter Other City to Continue!");		
		document.plloan_form.City_Other.focus();
		return false;
	}
	for (var i = 0; i <document.plloan_form.City_Other.value.length; i++) {
  	if (iChars.indexOf(document.plloan_form.City_Other.value.charAt(i)) != -1) {
		alert("Remove Special Characters!");	
		document.plloan_form.City_Other.focus();
  		return false;
  	}
  }
  if(document.plloan_form.Phone.value=="")
	{
		alert("Fill Mobile Number!");
		document.plloan_form.Phone.focus();
		return false;
	}
	if(isNaN(document.plloan_form.Phone.value)|| document.plloan_form.Phone.value.indexOf(" ")!=-1)
	{
		alert("Enter numeric value!");
		document.plloan_form.Phone.focus();
		return false;  
	}
	if (document.plloan_form.Phone.value.length < 10 )
	{
	  	alert("Enter 10 Digits!");	
		document.plloan_form.Phone.focus();
		return false;
	}
	if ((document.plloan_form.Phone.value.charAt(0)!="9") && (document.plloan_form.Phone.value.charAt(0)!="8") && (document.plloan_form.Phone.value.charAt(0)!="7"))
	{
	  	alert("should start with 9 or 8 or 7!");	
		document.plloan_form.Phone.focus();
		return false;
	}
	if (document.plloan_form.IncomeAmount.value=="")
	{
		alert("Enter Annual Income!");	
		document.plloan_form.IncomeAmount.focus();
		return false;
	}	
	if(!checkNum(document.plloan_form.IncomeAmount, 'Annual Income',0))
		return false;
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
function Trim(strValue) 
{
	var j=strValue.length-1;i=0;
	while(strValue.charAt(i++)==' ');
	while(strValue.charAt(j--)==' ');
	return strValue.substr(--i,++j-i+1);
}
function othercity1()
{
	if(document.plloan_form.City.value=='Others')
		document.plloan_form.City_Other.disabled=false;
	else
		document.plloan_form.City_Other.disabled=true;
}
</script>
</head>

<body>
<!--top-->

<?php include "top-menu.php"; ?>
<!--top-->

<!--logo navigation-->
<?php include "main-menu.php"; ?>
<!--logo navigation-->
<? $tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-1, date("Y"));
$currentdate=date('d F Y',$tomorrow);
$atag = '<img src="images/apl-yelo.gif" width="87" height="25" border="0"  />';	
$atagleft = '<img src="images/apl-yelo1.gif" width="87" height="25" border="0" />';
?>
<div class="text12" style="margin:auto; width:970px; height:11px; margin-top:11px; color:#0a8bd9;"><u><a href="index.php" class="text12" style="color:#0080d6;" >Home</a></u> > <a href="personal-loans.php"  class="text12" style="color:#0080d6;"><u>Personal Loan</u></a> <span class="text12" style="color:#4c4c4c;">> Personal Loan Interest Rates </span></div>
<div style="clear:both; height:15px;"></div>
<div class="intrl_txt">

<table align="center" ><tr><td width="72%">
<h1 class="text3" style="width:500px; height:33; margin-top:0px; float:left; clear:right; font-size:36px; text-transform:none; color:#88a943;"><strong>Personal Loan Interest Rates</strong></h1>
<span style="font-size:12px; font-weight:normal; ">(Last edited on : <? echo $currentdate; ?>)</span></td><td width="28%"></td>
   </tr></table>
<div style=" margin-left:15px; float:left; width:970px; height:2px;; margin-top:1px; "><img src="images/point5.gif" width="970" height="2" /></div>
 
<div class="text11" style="color:#4c4c4c; width:950px; margin-left:20px; margin-top:10px;">
Personal loan rates in India depend on various criteria, one being the income level. Different banks have different classifications based on which interest rates are calculated. To start with whether you are working for an employer (salaried) or you are an employer yourself (self &ndash; employed). The factors which determine your <a href="http://deal4loans.com/personal-loans.php">Personal Loan</a> interest rates are as follows: -<br>
<table width="100%"><tr>
<td width="216">
&bull; Income</td>
<td width="722">
&bull; Your Company Status</td>
</tr>
<tr>
<td>&bull; Credit and Payment history.</td>
<td>&bull; Relationship with the Bank you intend to take loan from.</td></tr>
<tr><td>&bull; Individual&rsquo;s Negotiating Ability.</td></tr></table>
<table width="663" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td  align="left" valign="top" ><table width="960" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="10" align="left" valign="top"><img src="images/bgtop1.jpg" width="960" height="10" /></td>
      </tr>
      <tr>
        <td height="30" align="left" valign="top" bgcolor="#21405F"><table width="955" border="0" cellspacing="0" cellpadding="0">
          <tr>
           
            <td class="text3" style=" color:#FFF; font-size:16px; text-transform:none; font-weight:bold;" align="center">Get Exact Quote on Personal Loan Interest Rates From all Banks</td>
           
          </tr>
                 
          </table></td>
      </tr>
      <tr>
        <td  align="center" valign="top" bgcolor="#21405F">
		<form name="plloan_form" method="post" action="insert_personal_loanstage1.php" onSubmit="return chkpersonalloan();">
		<input type="hidden" name="source" value="pl interest rate apply"> 
<input type="hidden" name="PostURL" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
		<table width="943" border="0" cellpadding="0" cellspacing="8">
		<tr>
			<td class="text" style=" float:left; height:auto; color:#FFF; font-size:12px; text-transform:none;">Full Name:</td>
			<td><input name="Name" id="Name" type="text" style="width:140px; height:12px;" /></td>
			
									   <td class="text" style=" float:left; height:auto; color:#FFF; font-size:12px; text-transform:none;">Email:</td>
			<td> <input name="Email" id="Email" type="text" style="width:140px; height:12px;" onKeyDown="validateDiv('emailVal');"  /></td>
			<td class="text" style=" float:left; height:auto; color:#FFF; font-size:12px; text-transform:none;">City:</td>
			<td> <select name="City" id="City" style="width:140px; height:18px; font-family:Verdana, Geneva, sans-serif; font-size:11px; color:#4c4c4c;"  onchange="othercity1();" tabindex="7">
                            <?=plgetCityList($City)?>
                                       </select></td>
				 
<td class="text" style=" height:auto; color:#FFF; font-size:12px; text-transform:none;" width="80">Other City:</td>
<td> <input name="City_Other" id="City_Other" type="text" style="width:140px; height:12px;" disabled="disabled" /></td>

		</tr>
		<tr> <td class="text" style=" float:left; height:auto; color:#FFF; font-size:12px; text-transform:none; padding-top:8px;">Mobile:</td><td><div class="text" style=" float:left; width:26px; height:auto; color:#FFF; font-size:12px; text-transform:none; clear:right; margin-top:3px; "> +91</div><input name="Phone" id="Phone" maxlength="10" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)"; onChange="intOnly(this);" type="text" style="width:113px; height:12px;" onKeyDown="validateDiv('phoneVal');"  /></td><td class="text" style=" float:left;  color:#FFF; font-size:12px; text-transform:none;" >Annual Salary:</td>
		  <td><input type="text" name="IncomeAmount" id="IncomeAmount" style="width:140px; height:12px;"  onkeyup="intOnly(this); " onkeypress="intOnly(this);"/></td>
		  <td colspan="4" valign="top"><table cellpadding="0" cellspacing="0" width="100%">
<tr><td  style="color:#FFF; font-size:11px; text-transform:none;" width="314">

<input name="accept" type="checkbox" checked="checked" />            
                   I Agree to&nbsp;<a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow"  class="text" style=" color:#88a943; font-size:11px; text-decoration:underline;">privacy policy</a> and&nbsp;<a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow"  class="text" style=" color:#88a943; font-size:11px; text-decoration:underline;">Terms and Conditions</a>.</td>
  <td width="115"><input name="submit" type="submit" style="border: 0px none ; background-image: url(images/get1-nw.jpg); background-repeat:no-repeat; width: 104px; height: 30px; margin-bottom: 2px;" value=""/></td>
</tr></table></td></tr>
		  <tr><td colspan="2"></td><td colspan="2" width="160"><span id='formatedIncome' style='font-size:11px;
font-weight:normal; color:#ffffff;font-Family:Verdana;'></span> <span id='wordIncome' style='font-size:11px;
font-weight:normal; color:#ffffff;font-Family:Verdana;text-transform: capitalize;'></span></td>
<td colspan="4"></td>
</tr>
		</table>
		</form>
		</td>
      </tr>
	   
      <tr>
        <td height="10" align="center" valign="top"><img src="images/bgbottom1.jpg" width="960" height="10" /></td>
      </tr>
    </table></td>
  </tr>
</table>
<div class="text11" style="color:#4c4c4c; width:950px; margin-left:20px; margin-top:5px; margin-bottom:5px; height:10px;"><b>Current Personal Loan Rate of Interest for all banks</b> </div>
 <table width="100%"  border="0" cellpadding="1" cellspacing="1" bgcolor="#d5cfb1">
      <tr bgcolor="#88a943">
        <td width="109" rowspan="2" align="center" bgcolor="#88a943" class="tblwt_txt" ><b>Banks/Rates</b></td>
        <td height="25" colspan="6" align="center" bgcolor="#88a943" class="tblwt_txt"><b>Salaried</b></td>
      </tr>
      <tr bgcolor="#88a943" >
        <td width="197"  height="30" align="center" style="font-weight:bold; color:#FFFFFF; clear:both"><b>CAT A</b></td>
        <td width="200"  height="30" align="center" bgcolor="#88a943" style="font-weight:bold; color:#FFFFFF; clear:both"><b>CAT B</b></td>
        <td width="192" align="center" style="font-weight:bold; color:#FFFFFF; clear:both"><b>Others</b></td>
        <td width="86" align="center" style="font-weight:bold; color:#FFFFFF; clear:both"><b>Pre Payment Charges</b></td>
	      <td width="82" align="center" style="font-weight:bold; color:#FFFFFF; clear:both"><b>Processing Fees</b></td>
          <td width="72" align="center" style="font-weight:bold; color:#FFFFFF; clear:both">Apply</td>
      </tr>
	  <tr bgcolor="#EFEEEE">
         <td height="25" align="left" bgcolor="#FFFFFF" class="tbl_txt"><b><a href="http://www.deal4loans.com/personal-loan-icici-bank.php" style="color:#0033FF;">ICICI Bank</a></b></td>
         <td height="17" align="center" bgcolor="#FFFFFF" class="tbl_txt"><b>15.5%</b><br /> (Salary Above 75,000)<br />
<b>16 %</b> <br />(Salary 50,000 -75,000)<br />
<b>17 %</b> <br />(Salary 30,000 -50,000)<br />
<b>18.25%</b><br /> (Salary 20,000 -30,000)<br />
<b>18.5%</b> <br />(Less Than 20,000)<br /><br />

<b>14% - 14.75%</b><br /> (For Special Corporates)
</td>
         <td align="center" bgcolor="#FFFFFF" class="tbl_txt"><b>15.5%</b><br /> (Salary Above 75,000)<br />
<b>16 %</b><br /> (Salary 50,000 -75,000)<br />
<b>17 %</b><br /> (Salary 30,000 -50,000)<br />
<b>18.25%</b><br /> (Salary 20,000 -30,000)<br />
<b>18.5%</b><br /> (Less Than 20,000)<br />
<br />

<b>14% -14.75%</b><br /> (For Special Corporates)
</td>
         <td align="center" bgcolor="#FFFFFF" class="tbl_txt"><b>15.5%</b><br /> (Salary Above 75,000)<br />
<b>16 %</b><br /> (Salary 50,000 -75,000)<br />
<b>17 %</b><br /> (Salary 30,000 - 50,000)<br />
<b>18.25%</b><br />(Salary 20,000 -30,000)<br />
<b>18.5%</b><br /> (Less Than 20,000)<br />
</td>
         <td align="center" bgcolor="#FFFFFF" class="tbl_txt">5%</td>
         <td align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt">2% - 2.25%
</td>
         <td height="35" align="center" valign="middle" bgcolor="#FFFFFF" >
			<a href="http://www.deal4loans.com/personal-loan-icici-bank.php" target="_blank" ><? echo $atagleft;?></a>
			
		</td>
	 
	  <tr bgcolor="#EFEEEE">
        <td height="126" align="left" bgcolor="#FFFFFF" class="tbl_txt"><b><a href="http://www.deal4loans.com/hdfc-personal-loan-eligibility.php
">HDFC Bank</a></b> </td>
        <td align="center" valign="top" bgcolor="#FFFFFF" class="tbl_txt"><b>15.75%</b><br /> 
(for 75,000 & above salary),<br />
<b>16.25%</b><br />
(for 50,000-75,000 salary),<br>

<b>17.25%</b><br /> 
(for 35,000-50,000 salary),<br>

<b>19.25%</b><br /> 
(below 35,000 salary)<br /> </td>
        <td align="center" bgcolor="#FFFFFF" class="tbl_txt"><b>15.75%</b><br />
  (for 75,000 & above salary),<br />
  <b>16.25%</b><br />
  (for 50,000-75,000 salary),<br />
  <b>17.25%</b><br />
  (for 35,000-50,000 salary),<br />
  <b>19.25%</b><br />
  (below 35,000 salary)
  </td>
        <td align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt"><b>22.25%</b></td>
        <td align="center" bgcolor="#FFFFFF" class="tbl_txt">4%</td>
        <td align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt">2% if salary account in HDFC - other wise 2.5%</td>
        <td height="126" align="center" valign="middle" bgcolor="#FFFFFF" >
			<a href="http://www.deal4loans.com/hdfc-personal-loan-eligibility.php" target="_blank" ><? echo $atagleft;?></a>		</td>
      </tr>
	  <tr bgcolor="#F6F4ED">
        <td height="25" align="left" bgcolor="#FFFFFF" class="tbl_txt"><b><a href="http://www.deal4loans.com/loans/personal-loan/bajaj-finserv-lending-personal-loan-eligibility-documents-interest-rates-apply/">Bajaj Finserv</a></b></td>
        <td align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt"><b>15.75%</b></td>
        <td align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt">
          <b>16%</b>
        </td>
        <td align="center" bgcolor="#FFFFFF" class="tbl_txt">
          <b>16.5% - 17%</b></td>
        <td align="center" bgcolor="#FFFFFF" class="tbl_txt">Nil</td>
        <td align="center" bgcolor="#FFFFFF" class="tbl_txt">2% - 2.5%</td>
        <td height="35" align="center" valign="middle" bgcolor="#FFFFFF" ><a href="http://www.deal4loans.com/loans/personal-loan/bajaj-finserv-lending-personal-loan-eligibility-documents-interest-rates-apply/" target="_blank" ><? echo $atagleft;?></a>
		</td>
      </tr>
	  <tr bgcolor="#EFEEEE">
        <td height="137" align="left" bgcolor="#FFFFFF" class="tbl_txt"><b><a href="http://www.deal4loans.com/get-quote-ingvysya.php">ING Vysya</a></b> </td>
        <td align="center"  bgcolor="#FFFFFF" class="tbl_txt"><b>14.75%</b>
        <br /> 
(for 75,000 & above salary),<br /><br />
<b>15.75%</b><br />
(for 40,000 - 75,000  salary),<br><br />

<b>17.25%</b><br />
(for 30,000 - 40,000 salary)<br /><br>

<b>0.5% Waiver for  Ing Salary Account Holder</b><br />
<br />
<b>14.50% for ING Bank Employee</b>
</td>
        <td align="center" bgcolor="#FFFFFF" class="tbl_txt"><b>14.75%</b><br />
  (for 75,000 & above salary),<br /><br />
  <b>16.25%</b><br />
  (for 40,000 - 75,000  salary),<br /><br />
  <b>17.25%</b><br />
  (for 30,000 - 40,000  salary)<br /><br /><b>0.5% Waiver for Ing SalaryAccount Holder</b><br /><br />
<b>14.50% for ING Bank Employee</b>
  </td>
        <td align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt"><b>16.25%</b><br />
  (for 75,000 & above salary),<br /><br />
  <b>16.75%</b><br />
  (for 40,000 - 75,000  salary),<br /><br />
  <b>18.25%</b><br />
  (for 25,000 - 40,000  salary)<br /><br /><b>0.5% Waiver for Ing Salary Account Holder</b><br /><br />
<b>14.50% for ING Bank Employee</b></td>
        <td align="center" bgcolor="#FFFFFF" class="tbl_txt">4%<br /><br /><b>Nil Foreclosure Charges Special Offer. Valid from ( 14th June 12 - 30th Sep 12 )</b> </td>
        <td align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt">1.5% (For ING Salary Account Holder), <br />other wise 2%</td>
        <td height="137" align="center" valign="middle" bgcolor="#FFFFFF" >
			<a href="http://www.deal4loans.com/get-quote-ingvysya.php" target="_blank" ><? echo $atagleft;?></a>		</td>
      </tr>
      <tr bgcolor="#EFEEEE">
        <td height="40" align="left" bgcolor="#FFFFFF" class="tbl_txt"><b><a href="http://www.deal4loans.com/personal-loan-sbi.php
">State Bank of India/SBI </a></b></td>
        <td align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt"><b>16.75%<br />
        </b>(Guarantor required)</td>
        <td align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt"><b>16.75%-20%<br />
        </b>(Guarantor required)        </td>
        <td align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt"><b>16.75%-20%<br />
        </b>(Guarantor required)        </td>
        <td align="center" bgcolor="#FFFFFF" class="tbl_txt" >4%</td>
        <td align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt">2%-3%</td>
        <td height="40" align="center" valign="middle" bgcolor="#FFFFFF" >
			<a href="http://www.deal4loans.com/personal-loan-sbi.php
" target="_blank" ><? echo $atagleft;?></a>		</td>
      </tr> 
	   <tr bgcolor="#EFEEEE">
        <td height="25" align="left" bgcolor="#FFFFFF" class="tbl_txt"><b><a href="http://www.deal4loans.com/fullerton-personal-loan-eligibility.php">Fullerton India</a></b></td>
        <td height="17" align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt"><b>21% - 32%</b></td>
        <td align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt"><b>21% - 32%</b></td>
        <td align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt"><b>21% - 32%</b></td>
        <td align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt">4%</td>
        <td align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt">2%</td>
        <td height="35" align="center" valign="middle" bgcolor="#FFFFFF" >
			<a href="http://www.deal4loans.com/fullerton-personal-loan-eligibility.php" target="_blank" ><? echo $atag;?></a>
			
		</td>
      </tr>
	   <tr bgcolor="#EFEEEE">
        <td height="25" align="left" bgcolor="#FFFFFF" class="tbl_txt"><a href="personal-loan-stanc-bank.php"><b>Standard Chartered Bank</b></a></td>
        <td align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt"><b> 16% - 17%</b></td>
        <td align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt"><b> 17% - 18%</b></td>
        <td align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt"><b> 19% - 22%</b></td>
        <td align="center" bgcolor="#FFFFFF" class="tbl_txt">2%-5%</td>
        <td align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt">2%</td>
        <td height="35" align="center" valign="middle" bgcolor="#FFFFFF" >
            <a href="http://www.deal4loans.com/personal-loan-stanc-bank.php" target="_blank" ><? echo $atag;?></a>
           
        </td>
      </tr>
	   <tr bgcolor="#F6F4ED">
        <td height="100" align="left" bgcolor="#FFFFFF" class="tbl_txt"><b><a href="/personal-loan-hdb-financial-services.php">HDBFS</a></b></td>
        <td align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt">
          <b>16%</b><br />(for 75,000 & above salary),<br /><b>17%</b><br />
          (for 35,000 - 75,000 salary),<br /><b>18%</b><br />
          ( below 35,000 salary)</td>
        <td align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt">
          <b>16%</b><br />(for 75,000 & above salary),<br /><b>17%</b><br />
          (for 35,000 - 75,000 salary),<br /><b>18%</b><br />
          ( below 35,000 salary)</td>
        <td align="center" valign="top" bgcolor="#FFFFFF" class="tbl_txt">
         <b>17%</b><br />(for 75,000 & above salary),<br /><b>18%</b><br />
          (for 35,000 - 75,000 salary),<br /><b>21%</b><br />
          ( below 35,000 salary)</td>
        <td align="center" bgcolor="#FFFFFF" class="tbl_txt">NIL for Select Corporates Employees (CAT A & B)
 4% For Rest</td>
        <td align="center" bgcolor="#FFFFFF" class="tbl_txt">1% - 2%</td>
        <td height="100" align="center" valign="middle" bgcolor="#FFFFFF" ><a href="http://www.deal4loans.com/personal-loan-hdb-financial-services.php" target="_blank" ><? echo $atagleft;?></a>		</td>
      </tr>
	  
       </tr>
	      <tr bgcolor="#F6F4ED">
        <td height="68" align="left" bgcolor="#FFFFFF" class="tbl_txt"><b><a href="http://www.deal4loans.com/citibank-personal-loan-eligibility.php">Citibank</a></b></td>
        <td align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt"><b>16%</b><br />
          ( upto 30,000 salary),<br>
          <b>15%</b><br />
          (above 30,000 salary)</td>
        <td align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt">
          <b>17%</b><br />
          ( upto 30,000 salary),<br>
          <b>16%</b><br />
          (above 30,000 salary)</td>
        <td align="center" valign="top" bgcolor="#FFFFFF" class="tbl_txt">
          <b>17%</b><br />
          ( upto 30,000 salary),<br>
          <b>16%</b><br />
          (above 30,000 salary)</td>
        <td align="center" bgcolor="#FFFFFF" class="tbl_txt">3%</td>
        <td align="center" bgcolor="#FFFFFF" class="tbl_txt">1% - 2%</td>
        <td height="68" align="center" valign="middle" bgcolor="#FFFFFF" >		</td>
      </tr>
    <tr bgcolor="#F6F4ED">
        <td height="25" align="left" bgcolor="#FFFFFF" class="tbl_txt" ><b>Axis Bank</b> </td>
        <td align="center" bgcolor="#FFFFFF" class="tbl_txt"><b>15% (For Super CAT A),<br /> 16% (For CAT A)<br>
          <img src="images/spacer.gif" width="120" height="1"></b></td>
        <td align="center" bgcolor="#FFFFFF" class="tbl_txt"><b>17%</b></td>
        <td align="center" bgcolor="#FFFFFF" class="tbl_txt"><b>19% - 20%</b></td>
        <td align="center" bgcolor="#FFFFFF" class="tbl_txt">Nill</td>
        <td align="center" bgcolor="#FFFFFF" class="tbl_txt">2%  & Prepayment Charges Nil
 </td>
        <td height="35" align="center" valign="middle" bgcolor="#FFFFFF" >
	
			
		
		</td>
      </tr>
	
	  <tr bgcolor="#F6F4ED">
        <td height="25" align="left" bgcolor="#FFFFFF" class="tbl_txt"><b><a href="http://www.deal4loans.com/kotak-personal-loan-eligibility.php">Kotak Bank</a></b></td>
        <td align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt"><b>15.5%</b>
          </td>
        <td align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt">
          <b>16.5%
</b></td>
        <td align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt">
          <b>18%-19%</b></td>
        <td align="center" bgcolor="#FFFFFF" class="tbl_txt">4%
</td>
        <td align="center" bgcolor="#FFFFFF" class="tbl_txt">2%</td>
        <td height="35" align="center" valign="middle" bgcolor="#FFFFFF" >
			<a href="http://www.deal4loans.com/kotak-personal-loan-eligibility.php" target="_blank" ><? echo $atag;?></a>
			
		</td>
      </tr>
      <tr bgcolor="#F6F4ED">
        <td height="26" align="left" bgcolor="#FFFFFF" class="tbl_txt" ><b><a href="http://www.deal4loans.com/loans/personal-loan/andhra-bank-personal-loans-eligibility-rates-emi/">Andhra Bank
</a></b></td>
        <td align="center" bgcolor="#FFFFFF" class="tbl_txt"><b>15.75%-16.75%<br>
          <img src="images/spacer.gif" width="120" height="1"></b></td>
        <td align="center" bgcolor="#FFFFFF" class="tbl_txt"><b>16.75%-18.75%</b></td>
        <td align="center" bgcolor="#FFFFFF" class="tbl_txt">N.A.</td>
        <td align="center" bgcolor="#FFFFFF" class="tbl_txt">N.A.</td>
        <td align="center" bgcolor="#FFFFFF" class="tbl_txt">Rs250-Rs1000/- </td>
        <td height="35" align="center" valign="middle" bgcolor="#FFFFFF" >
				
          <a href="http://www.deal4loans.com/loans/personal-loan/andhra-bank-personal-loans-eligibility-rates-emi/" target="_blank" ><? echo $atagleft;?></a>
			
		
		</td>
      </tr>
      
 
      <tr bgcolor="#F6F4ED">
        <td height="30" align="left" bgcolor="#FFFFFF" class="tbl_txt"><b><a href="http://www.deal4loans.com/loans/personal-loan/bank-of-baroda-personal-loans-eligibility-rates-emi/">Bank of Baroda</a></b></td>
        <td height="30" align="center" bgcolor="#FFFFFF" class="tbl_txt"><b>15%</b></td>
        <td height="30" align="center" bgcolor="#FFFFFF" class="tbl_txt"><b>15.5%</b></td>
        <td height="30" align="center" bgcolor="#FFFFFF" class="tbl_txt">N.A.</td>
        <td align="center" bgcolor="#FFFFFF" class="tbl_txt">N.A.</td>
        <td align="center" bgcolor="#FFFFFF" class="tbl_txt">2%</td>
        <td height="35" align="center" valign="middle" bgcolor="#FFFFFF" >
			<a href="http://www.deal4loans.com/loans/personal-loan/bank-of-baroda-personal-loans-eligibility-rates-emi/" target="_blank" ><? echo $atagleft;?></a>
			
		</td>
      </tr>
	 
    
      <tr bgcolor="#F6F4ED">
        <td height="25" align="left" bgcolor="#FFFFFF" class="tbl_txt"><b><a  href="http://www.deal4loans.com/loans/personal-loan/corporation-bank-personal-loan-eligibility-rates-emi/">Corporation Bank
</a></b></td>
        <td align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt"><b>14.5%<br />
        </b>(undertaking letter required)        </td>
        <td align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt">N.A.</td>
        <td align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt">N.A.</td>
        <td align="center" bgcolor="#FFFFFF" class="tbl_txt">N.A.</td>
        <td align="center" bgcolor="#FFFFFF" class="tbl_txt">1.50% of the loan amount or Rs.500/-</td>
        <td height="35" align="center" valign="middle" bgcolor="#FFFFFF" >
			<a href="http://www.deal4loans.com/loans/personal-loan/corporation-bank-personal-loan-eligibility-rates-emi/" target="_blank" ><? echo $atag;?></a>
	
		</td>
      </tr>
    
	 
      <tr bgcolor="#EFEEEE">
        <td height="25" align="left" bgcolor="#FFFFFF" class="tbl_txt"><b><a href="http://www.deal4loans.com/loans/personal-loan/united-bank-of-india-personal-loan-eligibilty-rates-emi/">United Bank Of India
</a></b></td>
        <td align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt"><b>16%</b><br /> 
          <b>12%</b>(For pensioners)</td>
        <td align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt"><b>16%-18%</b><br />
          <b>12%</b>(For pensioners)</td>
        <td align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt"><b>16%-18%</b><br />
          <b>12%</b>(For pensioners)</td>
        <td align="center" bgcolor="#FFFFFF" class="tbl_txt">N.A.</td>
        <td align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt">N.A.</td>
        <td height="35" align="center" valign="middle" bgcolor="#FFFFFF" >
            <a href="http://www.deal4loans.com/loans/personal-loan/united-bank-of-india-personal-loan-eligibilty-rates-emi/" target="_blank" ><? echo $atag;?></a>
            
        </td>
      </tr>
      <tr bgcolor="#EFEEEE">
        <td height="25" align="left" bgcolor="#FFFFFF" class="tbl_txt"><b><a href="http://www.deal4loans.com/loans/personal-loan/vijaya-bank-personal-loans-eligibility-rates-emi/">Vijaya Bank</a>
</b></td>
        <td align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt"><b>16%</b><br />        </td>
        <td align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt">N.A.</td>
        <td align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt">N.A.</td>
        <td align="center" bgcolor="#FFFFFF" class="tbl_txt">N.A.</td>
        <td align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt">N.A.</td>
        <td height="35" align="center" valign="middle" bgcolor="#FFFFFF" >
		        <a href="http://www.deal4loans.com/loans/personal-loan/vijaya-bank-personal-loans-eligibility-rates-emi/" target="_blank" ><? echo $atagleft;?></a>
           
        </td>
      </tr>
    </table>
<table border="0" align="center" cellpadding="2" cellspacing="1" width="950" >
 <tr><td valign="top" width="780">
    <p><b>Read below how these factors effect your Interest rates</b> **<br>
  To help its customers get the best interest rates on personal loans <a href="http://www.deal4loans.com/">deal4loans</a> has consolidated all the information regarding latest rate of interests at one place. Please keep visiting this section to get updated rates of interests on personal loans.  <br /> <span style="color:#FF0000;">* Never pay any fee/cash upfront to any person to get loan sanctioned. Processing fee are deducted from Loan amount.</span></p>
	   <b>Where</b><br>
<table border="0" cellspacing="0" cellpadding="0" style="color:#333333;">
  <tr>
    <td width="191" height="20">CAT A refers to</td>
    <td width="239">- Top 1000 companies</td>
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
<b>Income :</b> If your Income is above a certain limit, Banks believe that your chances of not paying are lesser as you have Income to pay. Income above 75 per month usually gets some discounts from all <a href="http://www.deal4loans.com/personal-loan-banks.php">personal loan Banks</a>.<br>
    <b>Your Company Status :</b> If the company you are working with is a well known corporate, the Banks feel that you are less likely to shift from your job and will result in lesser defaults.<br>
    <b>Credit and Payment History :</b> Banks follows Cibil scores/rating before deciding giving loans. If your payments for <a href="http://www.deal4loans.com/credit-cards.php">Credit Cards</a> and Loans is not upto mark , you have the most likely chance of being rejected for the loan or the Bank will give you at a much higher rate.<br>
    <b>Relationship with Bank :</b> The Bank where you have your Salary account/Savings account is likely to pass on you to some special rate for your <a href="http://www.deal4loans.com/personal-loans.php">personal Loans</a> or Processing fee.<br>
    <b>Individuals Negotiating Skills :</b> Based on your above points you can always ask Bank to give you waivers on Rates, Fees Etc.<br />
    
	<div style="height:25px; padding-top:10px;">Before apply for personal loan, Calculate your personal loan emi with <a href="/Contents_Calculators.php">EMI Calculator</a></div>
	
    
        </td></tr></table>
    <b>Disclaimer:</b> Please note that the interest rates given here are based on the market research. To enable the comparisons certain set of data has been reorganized / restructured / tabulated .Users are advised to recheck the same with the individual companies / organizations. This site does not take any responsibility for any sudden / uninformed changes in interest rates.<br>
Banks/ Financial Institutions can contact us at  <a href="mailto:customercare@deal4loans.com" style="color:#0F74D4;">customercare@deal4loans.com</a> for inclusions or updates.  
<div align="right"><a href="#pg_up">Top<img width="12" height="18" border="0" alt="Top" src="images/top.gif"/></a></div>
</div></div>
<?php include "footer_pl.php"; ?>

</body>
</html>
