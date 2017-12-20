-<?php
//header("Location: http://www.deal4loans.com/home-loans.php");
//exit;
require 'scripts/session_check.php';
require 'scripts/db_init.php';
require 'scripts/functionshttps.php';

//29may15
$cfcampaign="Select count(leadid) AS Cfcount from commonfloor_hlcampaign group by cf_mobile_number";
list($GetnumVal,$cfrow)=Mainselectfunc($cfcampaign,$array = array());
$Commonfloorcount = $cfrow["Cfcount"];
if($Cfcount>0)
{
	$Cfcount=$Commonfloorcount;
}
else
{
	$Cfcount=0;
}
//end Commonfloor campaign

$maxage=date('Y')-65;
$minage=date('Y')-18;

if(strlen($_REQUEST['source'])>0)
{
	$retrivesource="HL Site Page";
}
else
{
	$retrivesource="HL Site Page";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Quick Apply Home loan at 8.25% <?php echo DATE('F'); ?> 2017</title>
<meta name="keywords" content="apply home loan, housing loan, Apply Home Loans, online home loans, online home loan, Housing Loans, apply Home loans India,">
<meta name="description" content="Instant apply for Home Loans online:  ✍ Lowest EMI of Rs.824 per lakh for home loans via various banks apply in ✓ Mumbai ✓ Delhi ✓ Noida ✓ Gurgaon ✓ Kolkata ✓ Bangalore ✓ Chennai ✓ Hyderabad ✓ Pune ✓ Ahmedabad etc.">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<link href="css/home-loan-styles.css" type="text/css" rel="stylesheet"  />
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script type="text/javascript" src="scripts/calendardateinput.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<script type="text/javascript" src="js/jquery-ui-personalized-1.5.2.packed.js"></script>
<script type="text/javascript" src="js/script2.js"></script>
<script language="javascript">
function cityother()
{
	if(document.loan_form.City.value=="Others")
	{
		document.loan_form.City_Other.disabled = false;
		document.getElementById("City_Other").style.display="Block";
	}
	else
	{
		document.loan_form.City_Other.disabled = true;
		document.getElementById("City_Other").style.display="none";
	}
} 


function containsdigit(param)
{mystrLen = param.length;
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
	var j;
	var cnt=-1;
	var alpha=/^[a-zA-Z\ ]*$/;
	var alphanum=/^[a-zA-Z0-9]*$/;
	var num=/^[0-9]*$/;
	var space=/^[\ ]*$/;
	var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";

	if(!checkNum(document.loan_form.Net_Salary, 'Annual Income',0))
		return false;

	if (document.loan_form.Loan_Amount.value=="")
	{
		document.getElementById('loanAmtVal').innerHTML = "<span  class='hintanchor'>Enter Loan Amount!</span>";	
		document.loan_form.Loan_Amount.focus();
		return false;
	}	
	if(!checkNum(document.loan_form.Loan_Amount, 'Loan Amount',0))
		return false;
		
	if (document.loan_form.Employment_Status.selectedIndex==0)
	{
		document.getElementById('empStatusVal').innerHTML = "<span  class='hintanchor'>Select Employment Status to Continue!</span>";	
		document.loan_form.Employment_Status.focus();
		return false;
	}
	if (document.loan_form.Net_Salary.value=="")
	{
		document.getElementById('netSalaryVal').innerHTML = "<span  class='hintanchor'>Enter Annual Income!</span>";	
		document.loan_form.Net_Salary.focus();
		return false;
	}	
	if (document.loan_form.City.selectedIndex==0)
	{
		document.getElementById('cityVal').innerHTML = "<span  class='hintanchor'>Enter City to Continue!</span>";	
		document.loan_form.City.focus();
		return false;
	}
	if((document.loan_form.City.value=="Others") && ((document.loan_form.City_Other.value=="" || document.loan_form.City_Other.value=="Other City"  ) || !isNaN(document.loan_form.City_Other.value)))
	{
		document.getElementById('othercityVal').innerHTML = "<span  class='hintanchor'>Enter Other City to Continue!</span>";		
		document.loan_form.City_Other.focus();
		return false;
	}
	for (var i = 0; i <document.loan_form.City_Other.value.length; i++) {
  	if (iChars.indexOf(document.loan_form.City_Other.value.charAt(i)) != -1) {
		document.getElementById('othercityVal').innerHTML = "<span  class='hintanchor'>Remove Special Characters!</span>";	
		document.loan_form.City_Other.focus();
  		return false;
  	}
  }	
	
	if(document.loan_form.Name.value=="")
	{
       	document.getElementById('nameVal').innerHTML = "<span class='hintanchor'>Please Enter Your name</span>";		
		document.loan_form.Name.focus();
		return false;
	}
	if(document.loan_form.Name.value!="")
	{
		if(containsdigit(document.loan_form.Name.value)==true)
		{
			document.getElementById('nameVal').innerHTML = "<span  class='hintanchor'>First Name contains numbers!</span>";
			document.loan_form.Name.focus();
			return false;
		}
	}
   for (var i = 0; i <document.loan_form.Name.value.length; i++) 
   {
		if (iChars.indexOf(document.loan_form.Name.value.charAt(i)) != -1) 
		{
			document.getElementById('nameVal').innerHTML = "<span  class='hintanchor'>Contains special characters!</span>";
			document.loan_form.Name.focus();
			return false;
		}
   }
   
   if(document.loan_form.Email.value=="")
	{
		document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter  Email Address!</span>";	
		document.loan_form.Email.focus();
		return false;
	}
	var str=document.loan_form.Email.value
	var aa=str.indexOf("@")
	var bb=str.indexOf(".")
	var cc=str.charAt(aa)
	if(aa==-1)
	{
		document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter Valid Email Address!</span>";	
		document.loan_form.Email.focus();
		return false;
	}
	else if(bb==-1)
	{
		document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter Valid Email Address!</span>";	
		document.loan_form.Email.focus();
		return false;
	}
	
	if(document.loan_form.Phone.value=="")
	{
		document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Fill Mobile Number!</span>";
		document.loan_form.Phone.focus();
		return false;
	}
	if(isNaN(document.loan_form.Phone.value)|| document.loan_form.Phone.value.indexOf(" ")!=-1)
	{
		document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Enter numeric value!</span>";
		document.loan_form.Phone.focus();
		return false;  
	}
	if (document.loan_form.Phone.value.length < 10 )
	{
	  	document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Enter 10 Digits!</span>";	
		document.loan_form.Phone.focus();
		return false;
	}
	if ((document.loan_form.Phone.value.charAt(0)!="9") && (document.loan_form.Phone.value.charAt(0)!="8") && (document.loan_form.Phone.value.charAt(0)!="7"))
	{
	  	document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>should start with 9 or 8 or 7!</span>";	
		document.loan_form.Phone.focus();
		return false;
	}
if(!document.getElementById("accept").checked)
	{
		document.getElementById('acceptVal').innerHTML = "<span class='hintanchor'>Please Check Term and condition to proceed.</span>";
		document.loan_form.accept.focus();
		return false;
	}
}  


function validateDiv(div)
{
	var ni1 = document.getElementById(div);
	ni1.innerHTML = '';
}
/*function commomfloor()
{
	var cfcount = document.getElementById('Cfcount').value;
	var cfdiv = document.getElementById('commonfloorlogo');

	if(cfcount<=500)
	{
		var cit = document.loan_form.City.value;
		var prpval = document.loan_form.property_value.value;
		
		if((cit=="Delhi" || cit=="Mumbai" || cit=="Gurgaon" || cit=="Noida" || cit=="Gaziabad" || cit=="Thane" || cit=="Navi Munmbai" || cit=="Faridabad") && prpval>=2000000)
		{
			cfdiv.innerHTML='<table width="100%">  <tr><td><label>                <input type="checkbox" name="cf_campaign" id="cf_campaign" value="1"/>                </label>              I would like to get property options from commonfloor.com </td><td><img src="images/commonfloor-logo.jpg" width="72" height="32" border="0" /></td></tr></table>';
		}
		else
			cfdiv.innerHTML='';
	}
}
*/
</script>
</head>
<body>
<?php include"middle-menu.php"; ?>
<div class="hl_inner_wrapper">
<div class="text12" style="margin:auto; height:11px; margin-top:70px; color:#0a8bd9;"><u><a href="index.php" class="text12" style="color:#0080d6;" >Home</a></u> > <a href="home-loans.php"  class="text12" style="color:#0080d6;"><u>Home Loan</u></a> <span class="text12" style="color:#4c4c4c;">> <?php echo GETQUOTEFOR;?> Home Loan</span></div>
<div style="clear:both; height:15px;"></div>
<div class="hl-form-wrapper">
<table width="97%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
<td colspan="2">
     <div class="headtextedubox"> <h1 style="color:#000; font-size:16px"><?php echo GETQUOTEFOR;?> Home Loan</h1></div></td>
    </tr>  
  <tr>
    <td colspan="2"><img src="images/home-loan-quotes-animated.gif" style="width:100%; max-width:574px;  margin-bottom:7px;" height="23"></td>
    </tr>
  </table>
<form name="loan_form" method="post" action="insert-home-loans.php" onSubmit="return chkform();">
<input type="hidden" name="Cfcount" id="Cfcount" value="<? echo $Cfcount; ?>">
<input type="hidden" name="creative" value="<? echo $_SERVER["HTTP_USER_AGENT"]; ?>">
<input type="hidden" name="Activate" id="Activate" >
<input type="hidden" name="source" value="<? echo $retrivesource; ?>">
    <div class="new-input-box">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="25" class="formhlwpbody-text">Loan Amount</td>
        </tr>
        <tr>
          <td>
          
        <input name="Loan_Amount" id="Loan_Amount" maxlength="10" onkeypress="intOnly(this);" onkeyup="intOnly(this); getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');"  onblur="getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');"  type="text" class="d4l-input" onkeydown="validateDiv('loanAmtVal');" tabindex="1"  autocomplete="off" />
          <div id="loanAmtVal"></div>
          <span id='formatedlA'></span>
		  <span id='wordloanAmount'></span> 
          </td>
        </tr>
      </table>
    </div>
    <div class="new-input-box">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="25" class="formhlwpbody-text">Occupation</td>
        </tr>
        <tr>
          <td><select name="Employment_Status" id="Employment_Status"  onchange="validateDiv('empStatusVal');" class="d4l-select" tabindex="2">
              <option value="-1">Please Select</option>
              <option value="1">Salaried</option>
              <option value="0">Self Employment</option>
            </select>
            <div id="empStatusVal"></div></td>
        </tr>
      </table>
    </div>
    <div class="new-input-box">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="25" class="formhlwpbody-text">Annual Income</td>
        </tr>
        <tr>
          <td><input type="text" name="Net_Salary" id="Net_Salary" class="d4l-input" onkeyup="intOnly(this); getDigitToWords('Net_Salary','formatedIncome','wordIncome');" onkeypress="intOnly(this);"  onblur="getDigitToWords('Net_Salary','formatedIncome','wordIncome');" onchange="ShowHide('incomeShow','Net_Salary');" onkeydown="validateDiv('netSalaryVal');"   tabindex="3"  autocomplete="off"/>
          <div id="netSalaryVal"></div>
          <span id='formatedIncome'></span>
		  <span id='wordIncome'></span></td>
        </tr>
      </table>
    </div>
    <div class="new-input-box">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="25" class="formhlwpbody-text">City</td>
        </tr>
        <tr>
          <td>
         <select name="City" id="City" class="d4l-select"  onchange="validateDiv('cityVal'); cityother();" tabindex="4">
              <?=plgetCityList($City)?>
              <option value="Vapi">Vapi</option>
              <option value="Ankleshwar">Ankleshwar</option>
              <option value="Anand">Anand</option>
              <option value="Anand">Dahod</option>
              <option value="Anand">Navsari</option>
            </select>
            <div id="cityVal"></div>
            <input name="City_Other" id="City_Other" style="display:none;" placeholder="Other City" type="text" class="d4l-input" disabled onKeyUp="searchSuggest();" onkeydown="validateDiv('othercityVal');" tabindex="8"  autocomplete="off" />
            <div id="othercityVal"></div>
            
          </td>
        </tr>
      </table>
    </div>
    <div style="clear:both; height:15px;"></div>
    <div class="personal-details">Personal Details</strong><br />
    <span class="tc-text"><img src="images/security.png" width="14" height="16"> Your Information is secure with us and will not be shared without your consent</span>
    </div>
    <div style="clear:both; height:15px;"></div>
    <div class="new-input-box">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="25" class="formhlwpbody-text">Full Name</td>
        </tr>
        <tr>
          <td><input name="Name" id="Name" type="text" class="d4l-input" onkeydown="validateDiv('nameVal');"  tabindex="5" autocomplete="off"/>
          <div id="nameVal"></div></td>
        </tr>
      </table>
    </div>
    <div class="new-input-box">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="25" class="formhlwpbody-text">E-Mail ID</td>
        </tr>
        <tr>
          <td><input name="Email" id="Email" type="text" class="d4l-input" onkeydown="validateDiv('emailVal');"  tabindex="6"  autocomplete="off"/>
            <div id="emailVal"></div></td>
        </tr>
      </table>
    </div>
    <div class="new-input-box">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="25" class="formhlwpbody-text">Mobile Number</td>
        </tr>
        <tr>
          <td><input name="Phone" id="Phone" maxlength="10" onkeyup="intOnly(this);" onkeypress="intOnly(this)"; onchange="intOnly(this);" type="text" class="d4l-input" onkeydown="validateDiv('phoneVal');"  tabindex="7"  autocomplete="off" />
            <div id="phoneVal"></div></td>
        </tr>
      </table>
    </div>
    
    <div style="clear:both; height:15px;"></div>
    <table width="98%" border="0" cellspacing="0" cellpadding="0" align="center">
      <tr>
         <td colspan="5" align="left" valign="top">
	  	

<!-- End-->       </td>
       </tr>
      <tr>
        <td class="formhlwpbody-text">            <div class="tcleft-box"> <input name="accept" type="checkbox" id="accept" checked="checked" />
            I authorize Deal4loans.com &amp; its <a href="http://www.deal4loans.com/hl-partnering-banks.php" target="_blank" rel="nofollow" style="color:#06C; text-decoration:underline;">partnering banks</a> to contact me to explain the product &amp; I Agree to&nbsp;<a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow" style=" color:#06C; text-decoration:underline;">privacy policy</a> and&nbsp;<a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow" style=" color:#06C; text-decoration:underline;"> Terms and Conditions</a>.
          <div id="acceptVal"></div>
                  </div>           <div class="Hl-Quote-Btn">  <input type="submit" class="hl-get-quotebtn" value="Get Quote" /></div> 
            <div class="commonfloorlogo" id="commonfloorlogo">          
            </div>
        </td>
        </tr>
      <tr>
        <td><div id="hdfclife"></div></td>
      </tr>
    </table>
    <div style="clear:both; height:15px;"></div></form>
  </div>
  
    <br />
    <div style="margin:auto; width:100%; margin-top:25px;"><strong>Loan Partners</strong></div>
    <div style="margin:auto; width:100%;  margin-top:20px;" class="loanparnter-desktop">
  
  <table width="100%">
      <tr>
        <td>
        <div class="apply-hl-bank-logo" style="margin-left:8px;"><img src="/homeimages/sbi-home-loan-new.jpg" alt="SBI Home Loan" style="border:none;"/> </div>
        <div class="apply-hl-bank-logo" style="margin-left:5px;"> <img src="/new-images/slider/thumb/hdfc-h.jpg" alt="HDFC" style="border:none;"/></div>
        <div class="apply-hl-bank-logo"> <img src="/new-images/slider/thumb/hfc_logo.jpg" alt="ICICI HFC" width="137" height="27"  style="border:none;"/></div>
<div class="apply-hl-bank-logo"></div>
<div class="apply-hl-bank-logo"> <img src="/new-images/pnbhfl-logo1.jpg" alt="Fedbank"  style="border:none;"/></div>
<div class="apply-hl-bank-logo" style="margin-left:5px;"><img src="/new-images/lic-hfl-logo1.jpg" alt="LIC Hfl" style="border:none;"/> </div>
		<!--<div class="apply-hl-bank-logo" style="margin-left:8px;"><img src="/new-images/au-financiesrs.jpg" alt="Au Finance" width="84" height="35"  style="border:none;"/> </div>-->
		<!--<div class="apply-hl-bank-logo" style="margin-left:8px;"><img src="/new-images/L&T-internal-logo.jpg" alt="L&T Housing" width="67" height="35"  style="border:none;"/> </div>-->
        <div class="apply-hl-bank-logo" style="margin-left:8px;"><img src="/homeimages/indiabulls-logo.jpg" alt="Indiabulls" style="border:none;"/> </div>
        <div class="apply-hl-bank-logo" style="margin-left:5px;"> <img src="/new-images/slider/thumb/axis.jpg" alt="Axis Bank" style="border:none;"/></div>
        <div class="apply-hl-bank-logo" style="margin-left:8px;"><img src="/new-images/bank-of-baroda-inner.jpg" alt="Bank of Baroda" style="border:none;"/> </div>

        </td>
      </tr>
    </table>
   
    <div style="clear:both; height:50px;"></div>
  </div>
   <div class="loanparnter"><img src="images/home-loanbank-parnters.jpg" /></div>
    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" >
      <tr>
        <td valign="top"><h2 style="margin:auto; font-size:16px; font-weight:bold;">Maximum Home loan Bank Tie ups in online space</h2>
          <br /></td>
      </tr>
    </table>
    <div class="overflow-width">
      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_bgcolor_Border">
        <tr>
          <td valign="top"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="1">
              <tr class="table_bgcolor">
                <td width="82" height="43" align="center" valign="middle" ><strong>Banks</strong></td>
                <td width="184" height="43" align="center" valign="middle"><strong>State Bank of India</strong></td>
                <td width="184" height="43" align="center" valign="middle"><strong>ICICI Bank</strong></td>
                <td width="153" height="43" align="center" valign="middle"><strong>HDFC Ltd</strong></td>
                <td width="166" height="43" align="center" valign="middle"><strong>LIC Housing</strong></td>
                <td width="124" align="center" valign="middle"><strong>PNB Housing Finance</strong></td>
                <td width="133" height="43" align="center" valign="middle"><strong>Axis Bank</strong></td>
                <td width="120" height="43" align="center" valign="middle"><strong>Citibank</strong></td>
              </tr>
              <tr bgcolor="#FFFFFF">
                <td height="57" align="center" valign="middle"><b>Rate of Interest</b></td>
                <td height="57" align="center" valign="middle" ><p>8.30% - 8.60%</p></td>
                <td height="57" align="center" valign="middle" >8.35% - 8.80%</td>
                <td height="57" align="center" valign="middle" >8.35% - 8.55% </td>
                <td height="57" align="center" valign="middle" ><p>8.35% - 8.80% </p></td>
                <td align="center" valign="middle"><p>8.35% - 9.25%</p></td>
                <td height="57" align="center" valign="middle">8.35% - 8.75%<br /></td>
                <td height="57" align="center" valign="middle">8.60% - 8.85%</td>
              </tr>
              <tr bgcolor="#FFFFFF">
                <td height="83" align="center" valign="middle"><b>Processing Fee</b></td>
                <td height="83" align="center" valign="middle">(0.35% of Loan amount or 10000) + Taxes Subject to minimum 2000+Service tax<br />Festival Bonanza : 0% Processing Fee, on Top up and Home Loan (New & Take Over).<span style="color: rgba(252, 139, 42, 0.96); font-size:12px;">Offer Valid till 31.12.17</span></td>
                <td height="83" align="center" valign="middle">(0.50% - 1.00% of the loan amount or Rs. 1500/- (Rs. 2000/- for Mumbai, Delhi & Bangalore), whichever is higher + S. Tax & Surcharge)</td>
                <td height="83" align="center" valign="middle">Upto 0.50% of the loan amount or Rs.2,000 whichever is higher, plus applicable taxes.</td>
                <td height="83" align="center" valign="middle">Govt Employees : Rs 1000 + S Tax <br />
Others : Rs 2500 + S Tax
</b></td>
                <td align="center" valign="middle">0.50% Or 10,000 + GST  , whichever is higher.</td>
                <td height="83" align="center" valign="middle">0.5% + ST or Rs 25,000 + ST (whichever is higher)</td>
                <td height="83" align="center" valign="middle">Rs. 5000 (Application fee)</td>
              </tr>
              <tr bgcolor="#FFFFFF">
                <td height="70" align="center" valign="middle"><b>Loan Amount</b></td>
                <td height="57" align="center" valign="middle">Loan amount upto 30lac: 90%<br />
Loan amount above 30lac- upto 75Lac: 80%<br />
Loan amount above 75Lac: 75%</td>
                <td height="57" align="center" valign="middle">Rs.8,00,000 - Maximum <br />
                  80% of the Cost of the Property <br />
                  (Subject to Income Eligibility)</td>
                <td height="57" align="center" valign="middle">Loan amount upto 75 lacs : 80% of the property cost<br>
Loan amount above 75 lacs : 75% of the property cost</td>
                <td height="57" align="center" valign="middle">Loans upto 80% of the property value</td>
                <td align="center" valign="middle">Loans upto 80% of the property value.</td>
                <td height="57" align="center" valign="middle">Loan Amount upto 30Lac: 90% of Property<br />
Loan Amount above 30Lac – 75Lac : 80% of property<br />
Loan Amount Above 75Lac: 75% of property</td>
                <td height="57" align="center" valign="middle">Loan Amount upto 30Lac: 90% of Property<br />
Loan Amount above 30Lac – 75Lac : 80% of property<br />
Loan Amount Above 75Lac: 75% of property</td>
              </tr>
              <tr bgcolor="#FFFFFF">
                <td height="57" align="center" valign="middle"><b>Prepayment Charges</b></td>
                <td height="57" align="center" valign="middle">No Prepayment or foreclosure Charges</td>
                <td height="57" align="center" valign="middle">No prepayment charge on floating rate home loan 
                  For one year, two year and three year fixed rate loan the prepayment charge is 2% of the outstanding loan amount plus applicable service tax and surcharge till the time loan is under fixed rate</td>
                <td height="57" align="center" valign="middle">No prepayment charges shall be payable for partial or full prepayments irrespective of the source</td>
                <td height="57" align="center" valign="middle">NIL </td>
                <td align="center" valign="middle">NIL</td>
                <td height="57" align="center" valign="middle">NIL</td>
                <td height="57" align="center" valign="middle">NIL</td>
              </tr>
            </table></td>
        </tr>
      </table>
    </div>
  
  <div style="clear:both; height:20px; width:100%; margin:auto; margin-top:10px;"><a href="/Contents_Calculators.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image3','','images/emi2.gif',1)"><img src="images/emi1.gif" alt="EMI Calculator" name="Image3" width="95" height="20" border="0" id="Image3" hspace="5px" /></a></div>
  <!--partners-->
  
  
</div>
<div style="clear:both;"></div>
<!--partners-->
<?php include("footer_sub_menu.php"); ?>
</body>
</html>