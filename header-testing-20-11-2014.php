<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	
	if(isset($_POST['submit']))
	{
		$loan_amount = $_POST['loan_amount'];
		$Interest_Rate = $_POST['roi'];
		$Duration_of_Loan = $_POST['tenure'];
		$emi_paid = $_POST['emi_paid'];
		$pre_payment_charges = $_POST['pre_payment_charges'];		
	}
if(isset($_REQUEST["source"]))
{
	$source=$_REQUEST["source"];
}
else
{
	$source="Balance Transfer Calc";
}

?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'>  
<title>Home Loan Balance Transfer Calculator – India |Deal4loans</title>
<meta name="keywords" content="Home Loan Refinance Calculator, Home Loan Balance Transfer Calculator, Refinance savings calculator, calculate home loan refinance savings" />
<meta name="description" content="housing loan Balance Transfer calculator: Transfer your loan save interest pay low EMI. Calculate the savings when you refinance or transfer your existing home loan from one lender to another.">
<link href="source.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="scripts/mainmenu.js"></script>
<script type="text/javascript" src="js/dropdowntabs.js"></script>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script type="text/javascript" src="scripts/calendardateinput.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<link href="css/slider.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery-1.2.6.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-personalized-1.5.2.packed.js"></script>
<script type="text/javascript" src="js/sprinkle.js"></script>
<script type="text/javascript" src="js/easySlider1.5.js"></script>
<script type="text/javascript">
		$(document).ready(function(){	
			$("#slider").easySlider({
				controlsBefore:	'<p id="controls">',
				controlsAfter:	'</p>',
				auto: false, 
				continuous: true		
			});
			$("#slider2").easySlider({
				controlsBefore:	'<p id="controls2">',
				controlsAfter:	'</p>',		
				prevId: 'prevBtn2',
				nextId: 'nextBtn2',
				auto: true, 
				continuous: true	
			});		
		});	
</script>
<script language="javascript">
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
//var i;
var cnt;
var alpha=/^[a-zA-Z\ ]*$/;
var alphanum=/^[a-zA-Z0-9]*$/;
var num=/^[0-9]*$/;
var space=/^[\ ]*$/;
var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";
	
	if((Form.Name.value=="") || (Trim(Form.Name.value))==false)
	{
		document.getElementById('nameVal').innerHTML = "<span  class='hintanchor'>Fill Your Full Name!</span>";	
		Form.Name.focus();
		return false;
	}
	if (Form.City.selectedIndex==0)
	{
		document.getElementById('cityVal').innerHTML = "<span  class='hintanchor'>Fill Your City!</span>";	
		Form.City.focus();
		return false;
	}
	
	if (Form.Phone.value=="")
	{
		document.getElementById('PhoneVal').innerHTML = "<span  class='hintanchor'>Fill Your Mobile Number!</span>";	
		Form.Phone.focus();
		return false;
	}
	 if(isNaN(Form.Phone.value)|| Form.Phone.value.indexOf(" ")!=-1)
		{
    		document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Enter numeric value!</span>";	
	         Form.Phone.focus();
			  return false;  
		}
        if (Form.Phone.value.length < 10 )
		{
			document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Enter 10 Digits!</span>";	
			Form.Phone.focus();
			return false;
        }
        if ((Form.Phone.value.charAt(0)!="9") && (Form.Phone.value.charAt(0)!="8") && (Form.Phone.value.charAt(0)!="7"))
		{
			document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Number starts with 9 or 8 or 7!</span>";	
			 Form.Phone.focus();
            return false;
        }
	
	if(Form.Email.value=="")
	{
		document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter  Email Address!</span>";	
		Form.Email.focus();
		return false;
	}
	
	var str=Form.Email.value
	var aa=str.indexOf("@")
	var bb=str.indexOf(".")
	var cc=str.charAt(aa)

	if(aa==-1)
	{
		document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter Valid Email Address!</span>";	
		Form.Email.focus();
		return false;
	}
	else if(bb==-1)
	{
		document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter Valid Email Address!</span>";	
		Form.Email.focus();
		return false;
	}
	if(Form.loan_amount.value=="")
	{
		document.getElementById('loanAmountVal').innerHTML = "<span  class='hintanchor'>Enter Loan Amount!</span>";	
		Form.loan_amount.focus();
		return false;
	}
if(Form.tenure.selectedIndex==0)
	{
		document.getElementById('tenureVal').innerHTML = "<span  class='hintanchor'>Select Tenure!</span>";	
		Form.tenure.focus();
		return false;
	}	
	if(Form.roi.value=="")
	{
		document.getElementById('roiVal').innerHTML = "<span  class='hintanchor'>Rate of Interest!</span>";	
		Form.roi.focus();
		return false;
	}

	if(Form.pre_payment_charges.value=="")
	{
		document.getElementById('prepaymentVal').innerHTML = "<span  class='hintanchor'>Enter Pre-Payment Charges!</span>";	
		Form.pre_payment_charges.focus();
		return false;
	}
	if(Form.emi_paid.value=="")
	{
		document.getElementById('emiPaidVal').innerHTML = "<span  class='hintanchor'>Enter Pre-Payment Charges!</span>";	
		Form.emi_paid.focus();
		return false;
	}
	if (Form.Existing_Bank.value=="")
	{
		document.getElementById('existBankVal').innerHTML = "<span  class='hintanchor'>Enter Existing Bank!</span>";	
		Form.Existing_Bank.focus();
		return false;
	}	
	if(!Form.accept.checked)
	{
		document.getElementById('acceptVal').innerHTML = "<span  class='hintanchor'>Accept the Terms and Condition !</span>";	
		//alert("Accept the Terms and Condition");
		Form.accept.focus();
		return false;
	}
		
	
}

function validateDiv(div)
{
	var ni1 = document.getElementById(div);
	ni1.innerHTML = '';
}

function shw_tooltip()
{
	var nishw = document.getElementById('shw_tultip');
	nishw.innerHTML = "<span  class='hinttooltip'>Most Banks/NBFC charge 0% prepayment offers. Please check with your lender.</span>";
}

function shw_tooltipOFF()
{
	var nishw = document.getElementById('shw_tultip');
	nishw.innerHTML = "";
}
</script>
<script type="text/javascript" src="ajax.js"></script>
<script type="text/javascript" src="ajax-dynamic-list.js"></script>
<style type="text/css"> 
	/* Big box with list of options */
#ajax_listOfOptions{position:absolute;	/* Never change this one */
width:149px;/* Width of box */
height:50px;/* Height of box */
overflow:auto;/* Scrolling features */
border:1px solid #317082;/* Dark green border */
background-color:#FFF;/* White background color */
color: black;text-align:left;font-size:0.9em;z-index:100;}
#ajax_listOfOptions div{	/* General rule for both .optionDiv and .optionDivSelected */
margin:1px;padding:1px;cursor:pointer;font-size:0.9em;}
#ajax_listOfOptions .optionDiv{	/* Div for each item in list */}
#ajax_listOfOptions .optionDivSelected{ /* Selected item in the list */
background-color:#2375CB;color:#FFF;}
#ajax_listOfOptions_iframe{background-color:#F00;position:absolute;z-index:5;}
.hinttooltip{position:absolute;background-color:#F5FCE1;width: 175px;padding: 2px;border:1px solid #7F9D27;font:normal 10px Verdana;color:#404042;line-height:14px;z-index:100;border-right: 3px solid #7F9D27;border-bottom: 3px solid #7F9D27;}
body{margin-left:0px;margin-top:0px;margin-right:0px;margin-bottom:0px;background-color:#203f5f;overflow-x:hidden;
background-color:#FFF;}
.red{color: #F00;}
.tblwt_txt{color: #1c50b0;font-family: Verdana,Arial,Helvetica,sans-serif;font-size: 13px;font-weight:bold;padding: 2px;}
.tbl_txt {color: #373737;font-family: Verdana,Arial,Helvetica,sans-serif;font-size:11px;padding:2px;}
#txt a {color: #1C50B0;font-family: Verdana,Arial,Helvetica,sans-serif;font-size:11px;line-height:15px;  text-decoration:none;}
#txt a {text-decoration:none;}
#txt a:link {color: #666666;}
#txt a:visited {color: #666666;}
#txt a:active {color:#666666;}
#txt a:hover {color: #FF9900;}</style>
<link rel="stylesheet" type="text/css" href="menu-style17-10-2014.css">
<link href="personal-loan-banks-styles.css" rel="stylesheet" type="text/css">
<link href="apply-personal-loan-continue-styles.css" type="text/css" rel="stylesheet"  />
<link href="source1.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="modernizr.custom-90229.js"></script>


<?php include "cl-form-js.php"; ?>
</head>
<body>
<!--top-->
<header><div class="hide_top_menu"><?php include "top-menu.php"; ?></div></header>
<!--top-->
<!--logo navigation-->
<nav><?php include "main-menu112-10-2014.php"; ?></nav>
<!--logo navigation--><!--partners-->
<section>
<div class="secondwrapper-pl">
<div class="text12" style="margin:auto; width:100%; height:11px; margin-top:11px; color:#0a8bd9;"><u><a href="index.php" class="text12" style="color:#0080d6;" >Home</a></u> > <span  class="text12" style="color:#4c4c4c;">Home Loan Balance T ransfer Calculator</span></u></div>
<div class="intrl_txt" style="margin:auto;">
<div style="width:100%; height:33; margin-top:15px; clear:right;">
<h1 class="honenew"  style="width:70%; height:33; margin-top:0px; float:left; clear:right;">Home Loan Balance Transfer Calculator</h1>
<div class="text3 h1new" style="width:95px; height:33; margin-top:15px; float:right; clear:right;"><a href="/Contents_Calculators.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image3','','images/emi2.gif',1)"><img src="images/emi1.gif" name="Image3" width="95" height="20" border="0" id="Image3" /></a></div>
</div>
<div style=" margin-left:15px;  height:1px;; margin-top:1px; "><img src="images/point5.gif" width="67%" height="1" /></div>
<div style="clear:both; height:5px;"></div>
<div class="text11" style="color:#4c4c4c; width:100%; text-align:center;">
 <table cellpadding="0" cellspacing="0" border="0" width="100%"><tr><td style="font-size:14px;" align="right"> 
<strong>Save over 1 Lac, Switch your Existing Home Loan</strong>&nbsp;&nbsp;
  </td><td align="right" style="font-size:14px; width:260px;"> <div class="fb-like" data-href="http://www.facebook.com/deal4loans" data-send="true" data-width="250" data-show-faces="false"></div>
<div id="fb-root"></div>
<script>(function(d, s, id) {

  var js, fjs = d.getElementsByTagName(s)[0];

  if (d.getElementById(id)) return;

  js = d.createElement(s); js.id = id;

  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";

  fjs.parentNode.insertBefore(js, fjs);

}(document, 'script', 'facebook-jssdk'));</script>
 </td></tr></table></div>
<div style="clear:both; height:5px;"></div>
<form name="loancalc" id="loancalc" method="post" action="home-loan-balance-transfer-calculator-continue.php" onSubmit="return check_form(document.loancalc);" >
<input type="hidden" name="source" value="<? echo $source; ?>">
<div class="form-aplc-form">
<div class="form-aplc-top-textbx"><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><h1 class="text3" style="height:33px; margin-top:0px; clear:right; font-size:24px; text-transform:none; color:#fff;">Home Loan Balance Transfer Calculator</h1></td>
  </tr>
  <tr>
    <td height="5"></td>
  </tr>
  </table>
</div>
<div class="form-aplc-inputwrapper">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="100%" height="58" align="left" valign="top"><div style="width:100%; height:47px; margin-left:0px; margin-top:5px;">
        <div class="text" style="width:100%; height:auto; color:#FFF; font-size:12px; text-transform:none;">Full Name:</div>
        <div class="text" style="width:100%; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;">
          <input name="Name" id="Name" type="text" style="width:100%; height:18px;" onkeydown="validateDiv('nameVal');"  value="<?php echo $Name; ?>" tabindex="1" />
          <div id="nameVal"></div>
        </div>
      </div></td>
    </tr>
    <tr>
      <td width="100%" height="58" align="left" valign="top"><div style="width:100%; height:47px; margin-left:0px; margin-top:5px;">
<div class="text" style="width:100%; height:auto; color:#FFF; font-size:12px; text-transform:none;">Loan Amount Borrowed:</div>
<div class="text" style="width:100%; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;"><input name="loan_amount" id="loan_amount" type="text" style="width:100%; height:18px;" onkeydown="validateDiv('loanAmountVal');" onkeyup="intOnly(this);" onkeypress="intOnly(this);" onchange="intOnly(this);" maxlength="30" value="<?php echo $loan_amount; ?>" tabindex="2" /><div id="loanAmountVal"></div>
        </div>
      </div></td>
    </tr>
    <tr>
      <td width="100%" height="58" align="left" valign="top"><div style="width:100%; height:47px; margin-left:0px; margin-top:5px;">
<div class="text" style="width:100%; height:auto; color:#FFF; font-size:12px; text-transform:none;">No. of EMI Paid (in Months):</div>
        <div class="text" style="width:100%; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;">
<input type="text" name="emi_paid" style="width:100%; height:18px;" maxlength="5" value="<?php echo $emi_paid ; ?>" onkeydown="validateDiv('emiPaidVal');" tabindex="3" />
<div id="emiPaidVal"></div>
</div>
      </div></td>
    </tr>
  </table>
</div>
<div class="form-aplc-inputwrapper inputmarginstyle">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="100%" height="58" align="left" valign="top"><div style="width:100%; height:47px; margin-left:0px; margin-top:5px;">
        <div class="text" style="width:100%; height:auto; color:#FFF; font-size:12px; text-transform:none;">City:</div>
<div class="text" style="width:100%; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;"><select name="City" id="City" style="width:100%; height:24px; font-family:Verdana, Geneva, sans-serif; font-size:11px; color:#4c4c4c;"  onchange="validateDiv('cityVal');" tabindex="4">
            <?=plgetCityList($City)?>
          </select>
          <div id="cityVal"></div>
        </div>
      </div></td>
    </tr>
    <tr>
      <td height="58" align="left" valign="top"><div style="width:100%; height:47px; margin-left:0px; margin-top:5px;">
<div class="text" style="width:100%; height:auto; color:#FFF; font-size:12px; text-transform:none;">Tenure (in Years):</div>
<div class="text" style="width:100%; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;"><select name="tenure" id="tenure" style="width:100%; height:24px; font-family:Verdana, Geneva, sans-serif; font-size:11px; color:#4c4c4c;" onkeydown="validateDiv('tenureVal');" tabindex="5" >
            <option value="">Please Select</option>
            <?php 
		   for($i=5;$i<=25;$i++)
		   {
		   		$selected = "";
				if($i==$Duration_of_Loan)
				{
					$selected = "selected";
				}	
		   		echo "<option value='".$i."' ".$selected." >".$i."</option>";
		   }
		   ?>
          </select>
          <div id="tenureVal"></div>
        </div>
      </div></td>
    </tr>
    <tr>
      <td width="100%" height="58" align="left" valign="top"><div style="width:100%; height:47px; margin-left:0px; margin-top:5px;">
<div class="text" style="width:100%; height:auto; color:#FFF; font-size:12px; text-transform:none;">Name of Existing Bank :</div>
<div class="text" style="width:100%; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;"><input type="text" name="Existing_Bank"  id="Existing_Bank" style="width:100%; height:18px;"  onkeyup="ajax_showOptions(this,'getCountriesByLetters',event); getstatementlink();" onchange="getstatementlink();" onkeydown="validateDiv('existBankVal');" onclick="getstatementlink();" tabindex="6" />
<div id="existBankVal"></div>
</div>
</div></td>
    </tr>
  </table>
</div>
<div class="form-aplc-inputwrapper inputmarginstyle">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="58"><div style="width:100%; height:47px; margin-left:0px; margin-top:5px;">
        <div class="text" style="width:100%; height:auto; color:#FFF; font-size:12px; text-transform:none;"><span class="text" style="width:100%; height:auto; color:#FFF; font-size:12px; text-transform:none;">Mobile:</span></div>
<div class="text" style="width:100%; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>+91</td>
    <td><input name="Phone" id="Phone" maxlength="10" onkeyup="intOnly(this);" onkeypress="intOnly(this);" onchange="intOnly(this);" type="text" style="width:100%; height:18px;" onkeydown="validateDiv('phoneVal');" tabindex="7" value="<?php echo $Phone; ?>"  /><div id="phoneVal"></div></td>
  </tr>
</table>
</div></div>
     </td>
    </tr>
    <tr>
      <td height="58"><div style="width:100%; height:47px; margin-left:0px; margin-top:5px;">
<div class="text" style="width:100%; height:auto; color:#FFF; font-size:12px; text-transform:none;">Present Rate Of Interest:</div>
<div class="text" style="width:100%; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;">
<input type="text" name="roi" id="roi" onkeydown="validateDiv('roiVal');"  style="width:100%; height:18px;" value="<?php echo $Interest_Rate; ?>" tabindex="8" />
<div id="roiVal"></div></div>
</div></td>
    </tr>
  </table>
</div>
<div class="form-aplc-inputwrapper inputmarginstyle">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="58"><div style="width:100%; height:47px; margin-left:0px; margin-top:5px;">
<div class="text" style="width:100%; height:auto; color:#FFF; font-size:12px; text-transform:none;">Email ID :</div>
<div class="text" style="width:100%; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;">
          <input name="Email" id="Email" type="text" style="width:100%; height:18px;" onkeydown="validateDiv('emailVal');"  value="<?php echo $Email; ?>" tabindex="9" />
          <div id="emailVal"></div>
        </div>
      </div></td>
    </tr>
    <tr>
      <td width="100%" height="58" align="left" valign="top"><div style="width:100%; height:47px; margin-left:0px; margin-top:5px;">
        <div class="text" style="width:100%; height:auto; color:#FFF; font-size:12px; text-transform:none;">Pre Payment Charges: </div>
        <div class="text" style="width:100%; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;">
          <input type="text" name="pre_payment_charges" id="pre_payment_charges" style="width:100%; height:18px;" value="<?php echo $pre_payment_charges; ?>"  onkeydown="validateDiv('prepaymentVal'); intOnly(this);" onkeyup="intOnly(this);" tabindex="10"  onfocus="shw_tooltip();" onblur="shw_tooltipOFF();"/>
          <div id="prepaymentVal"></div>
          <div id="shw_tultip"></div>
        </div>
      </div></td>
    </tr>
  </table>
</div>
<div style="clear:both;"></div>
<div class="terms-con-aplc-new text" style="font-size:11px; color:#FFF;"> <input name="accept" type="checkbox"  tabindex="9" /> I Read and Agree to&nbsp;<a href="/Privacy.php" style="color:#FFFFFF; text-decoration:underline;">privacy policy</a> and&nbsp; <a href="/Privacy.php" style="color:#FFFFFF; text-decoration:underline;">Terms and Conditions</a>.</div>
<div id="acceptVal"></div>
<div class="submitbtn-aplc"><input type="submit" style="border: 0px none ; background-image: url(images/get1.gif); width: 114px; height: 52px; margin-bottom:0px;" value=""/></div>
<div style="clear:both;"></div>
</div>
</form>
<div style="clear:both; height:15px;"></div>
<div style="width:100%; height:auto; margin-top:15px; margin-left:15px; text-align:justify;">
  <span class="text11" style="color:#4c4c4c; "><strong>Home   Loan Balance transfer</strong> need not only mean saving money, you can   also utilize the same for investing in different options. After all securing a   <a href="home-loans.php" title="Home Loan">home loan</a> is not the end of journey.  Balance transfer - by switching to another lender may   give you a better deal. While a balance   transfer will certainly reduce your EMI outgo, there is no one-size-fits-all   solution for everybody. To know if it will help you, you need to decipher its   workings and calculate the actual benefit before taking a   call.</span></div>
<div style="width:100%; height:auto; margin-top:15px; margin-left:15px; text-align:justify;">
<span class="text11" style="color:#4c4c4c; "><strong>Home   Loan Balance Transfer Calculator </strong>involves doing a simple math which in turn would save   you from coughing up your hard earned money. All you need to do is insert   your existing home loan rate and prepayment charges and based on that it gives   you instant quote of  four other bank rates as well and tells you how much you   can save.</span>
<br /> <br />
<strong>Other Available Calculators & Tools to Calculate EMI & Eligibility  of Loans</strong>
                <table cellpadding="3" cellspacing="2" border="0" width="100%" style="border:#999999 1px solid;">
                <tr><td  bgcolor="#CCCCCC"><a href="http://www.deal4loans.com/Contents_Calculators.php" target="_blank">EMI Calculator</a></td><td  bgcolor="#CCCCCC"><a href="http://www.deal4loans.com/home-loan-eligibility-calculator.php" target="_blank">Home Loan Eligibility Calculator</a></td><td  bgcolor="#CCCCCC"><a href="home-loan-emi-calculator1.php" target="_blank">Home Loan EMI Calculator</a></td></tr>
<tr><td> <a href="home-loan-balance-transfer-calculator.php" target="_blank">Home Loan Balance Transfer</a></td>
<td><a href="http://www.deal4loans.com/car-loan-emi-calculator.php" target="_blank">Car Loan Emi Calculator</a></td>
<td><a href="http://www.deal4loans.com/personal-loan-emi-calculator.php" target="_blank">Personal Loan Emi Calculator</a> </td>
                  </tr>
                <tr><td  bgcolor="#CCCCCC"><a href="http://www.deal4loans.com/loans/calculators/two-wheeler-loan-emi-calculator-calculate-loan-emi-online/" target="_blank">Two Wheeler Loan Emi Calculator</a></td>
                <td  bgcolor="#CCCCCC"><a href="loan-amortization-calculator.php" target="_blank">Loan Amortization Calculator</a></td><td bgcolor="#CCCCCC"><a href="http://www.deal4loans.com/balance-transfer-home-loans.php" target="_blank">Balance Transfer home loans</a></td>
                </tr>
                <tr>
                  <td><a href="pre-payment-calculator.php" target="_blank">Prepayment Calculator</a></td>
<td><a href="http://www.deal4loans.com/part-payment-calculator.php" target="_blank">Part Payment Calculator</a></td>
<td>&nbsp;</td></tr>
</table></div>
<!--partners-->
<div class="text" style="margin:auto; width:962px; height:auto; margin-top:25px; color:#8dae48;">Loan Partners</div>
<div class="logo-partners_b"><img src="images/home-loan-balance-transfer-calculator-loanpartner.jpg" width="320" height="110" /></div>
<div style="margin:auto; height:85px; margin-top:20px;" class="logo-partners">
<table width="100%"><tr><td align="center">
<div><img src="/new-images/slider/thumb/hdfc-h.jpg" alt="HDFC" width="126" height="52"  style="border:none;"/></div></td><td align="center">
<div><img src="/new-images/slider/thumb/axis.jpg" alt="Axis Bank" width="140" height="42"  style="border:none;"/></div></td>
<td align="center"><div><img src="/new-images/slider/thumb/hfc_logo.jpg" alt="ICICI HFC" width="147" height="37"  style="border:none;"/></div></td>
<td align="center"><div><img src="/new-images/fedbank-nw.jpg" alt="Fedbank" width="130" height="38" style="border:none;"/></div></td>
<td align="center"><div><img src="/new-images/citibank-logo-d4l-home.jpg" alt="Citibank" width="145" height="38" style="border:none;"/></div></td>
</tr></table>
</div>
</div></div>

</section>
</body>
</html>