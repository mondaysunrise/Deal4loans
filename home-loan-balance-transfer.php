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

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0"> 
<link href="css/home-loan-balance-transfer-styles1.css" type="text/css" rel="stylesheet" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Home Loan Balance Transfer Calculator</title>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script language="javascript">
function containsdigit(param)
{	mystrLen = param.length;
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

    if (Form.City.selectedIndex==0)
	{
		document.getElementById('cityVal').innerHTML = "<span  class='hintanchor'>Fill Your City!</span>";	
		Form.City.focus();
		return false;
	}


	if((Form.Name.value=="") || (Trim(Form.Name.value))==false)
	{
		document.getElementById('nameVal').innerHTML = "<span  class='hintanchor'>Fill Your Full Name!</span>";	
		Form.Name.focus();
		return false;
	}
	  
	
	if (Form.Phone.value=="")
	{
		document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Fill Your Mobile Number!</span>";	
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
		{			document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Number starts with 9 or 8 or 7!</span>";	
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
<style>
	/* Big box with list of options */
	#ajax_listOfOptions{
		position:absolute;	/* Never change this one */
		width:250px;	/* Width of box */
		height:68px;	/* Height of box */
		overflow:auto;	/* Scrolling features */
		border:1px solid #317082;	/* Dark green border */
		background-color:#FFF;	/* White background color */
    color: black;
		text-align:left;
		font-size:0.9em;
		font-family:Arial, Helvetica, sans-serif;
		z-index:100;
	}
	#ajax_listOfOptions div{	/* General rule for both .optionDiv and .optionDivSelected */
		margin:1px;		
		padding:1px;
		cursor:pointer;
		font-size:0.9em;
		font-family:Arial, Helvetica, sans-serif;
	}
	#ajax_listOfOptions .optionDiv{	/* Div for each item in list */
		
	}
	#ajax_listOfOptions .optionDivSelected{ /* Selected item in the list */
		background-color:#2375CB;
		color:#FFF;
	}
	#ajax_listOfOptions_iframe{
		background-color:#F00;
		position:absolute;
		z-index:5;
	}

.hinttooltip{
position:absolute;
background-color:#F5FCE1;
width: 243px;
padding: 2px;
border:1px solid #7F9D27;
font:normal 10px Verdana;
color:#404042;
line-height:14px;
z-index:100;
border-right: 3px solid #7F9D27;
border-bottom: 3px solid #7F9D27;

}

</style>

<style type="text/css">
<!--
 
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	overflow-x:hidden;
	background-color:#FFF;
}
-->
.alert_msg{color:#FF0000; font-weight:bold; font-size:12px; font-family: Verdana, Geneva, sans-serif;}
input,select{border:1px solid #878787;margin:0;padding:0}
select:focus, input:focus
{
border:#FF0000 1px solid; 
}
</style>
<script language="javascript">
function addPersonalDetails()
{

	var ni1 = document.getElementById('personalDetails');
			
	ni1.innerHTML = '<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"><tr>      <td height="25" class="hlb_form_text"><table width="100%" border="0" cellpadding="0" cellspacing="0"><tr><td width="48%"  align="left" style="font-size:15px; color:#156dd1; padding-bottom:6px; " colspan="2"> Personal Details</td></tr><tr><td width="4%" style="font-size:10px; font-weight:normal; color:#999999;" valign="top"><img src="http://www.deal4loans.com/images/security.png" width="14" height="16"></td><td width="96%" align="left"class="sbi_text_a"  style="font-size:10px; font-weight:normal; color:#156dd1;">Your Information is secure with us & will not be shared without your consent</td></tr></table></td></tr><tr>      <td height="25" class="hlb_form_text">Full Name:</td>    </tr>    <tr>      <td>      	 <input name="Name" id="Name" type="text" class="hlb_input_box"  onkeydown="validateDiv(\'nameVal\');"  value="<?php echo $Name; ?>" tabindex="8" autocomplete="off" />   <div id="nameVal" class="alert_msg"></div>    </td>    </tr>   <tr>      <td height="25" class="hlb_form_text">Mobile:</td>    </tr>      <tr>      <td height="25" class="hlb_form_text">+91    <input name="Phone" id="Phone" maxlength="10" onkeyup="intOnly(this);" onkeypress="intOnly(this);" onchange="intOnly(this);" type="text" class="hlb_input_mobo" onkeydown="validateDiv(\'phoneVal\');" tabindex="9" value="<?php echo $Phone; ?>" autocomplete="off" />            <div id="phoneVal" class="alert_msg"></div></td>    </tr>     <tr>      <td height="25" class="hlb_form_text">Email ID:</td>    </tr>    <tr>      <td height="25">        <input type="text" name="Email" id="Email" class="hlb_input_box" onkeydown="validateDiv(\'emiPaidVal\');" tabindex="10" autocomplete="off" />                    <div id="emailVal" class="alert_msg"></div>	</td>    </tr>   <tr>      <td height="10" align="center" class="hlb_form_text" style="font-size:11px; font-weight:normal;">&nbsp;</td>    </tr>       <tr>      <td height="25" class="hlb_form_text" style="font-size:11px; font-weight:normal;">       <input name="accept" type="checkbox" checked="checked" tabindex="11" />         <span class="hlb_form_text" style="font-size:11px; font-weight:normal;">I Read and Agree to <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow">privacy policy</a> and <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow">Terms and Conditions</a>.</span>      </td>    </tr>    <tr>      <td height="10" align="center" class="hlb_form_text" style="font-size:11px; font-weight:normal;">&nbsp;</td>    </tr>    <tr>      <td height="45" align="center" class="hlb_form_text" style="font-size:11px; font-weight:normal;"><span class="hlb_form_text" style="font-size:11px; font-weight:normal;"><input type="submit" style="border: 0px none ; background-image: url(images/hlb_get-quote-btn.png); width: 241px; height: 40px; margin-bottom: 0px;" value="" tabindex="12"/></span></td>    </tr></table>';

}

</script>

<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
</head>

<body>
<div class="main_container">
<div class="hlb_left_box">
<div class="hlb_logo_box"><img src="images/logo.gif" width="243" height="90" /></div>
<div style="clear:both;"></div>
<div class="hlb_top_head_box"><div class="title_box"><span class="hlb_text_head"
>Home Loan Balance Transfer Calculator</span><br />
<span class="hlb_sub_text">  Save over 1 Lac, Switch your Existing Home Loan</span></div>
<div class="shadow"></div>
<div style="clear:both;"></div>
<div style="margin-top:25px;" id="image_hide"><img src="images/hl_bt_cal_graph.jpg" width="100%" /></div>
<div >
<div style="clear:both;"></div>
<div class="hlb_left_box_b">
<div class="hlb_why_tex_box"><div class="hlb_why_text">Why Deal4loans.com</div>
<div style="clear:both;"></div>
<div class="hlb_why_text_b" style="margin-top:10px;"><ul>
<li>Instant Balance Transfer Quotes from all Banks.</li>
<li>Choose best deal or lowest EMI.</li>
<li>Home Loan Balance Transfer Quotes are free for customers.</li>
<li>Your information will not be shared with anyone without your consent.</li>
<li>Over 26 lakh customers have taken quote at Deal4loans.com</li>
</ul>
</div>

</div>
<div style="clear:both;"></div>
<div class="hlb_text_section"><span ><span class="hlb_body_text"><strong>Home Loan Balance transfer</strong> need not only mean saving money, you can also utilize the same for investing in different options. After all securing a home loan is not the end of journey.  Balance transfer - by switching to another lender may give you a better deal. While a balance transfer will certainly reduce your EMI outgo, there is no one-size-fits-all solution for everybody. To know if it will help you, you need to decipher its workings and calculate the actual benefit before taking a call.</span><br />
    <strong><br />
    <span class="hlb_body_text">Home Loan Balance Transfer Calculator </span></strong><span class="hlb_body_text">involves doing a simple math  which in turn would save you from coughing up your hard earned money. All you  need to do is mention your existing home loan rate and prepayment charges.  Based on these informations, it gives you instant quote of four other bank  rates as well and tells you how much you can save.
</span></span></div></div>
    
</div>


</div>


</div>

<div class="hlb_right_box_main">
<div class="hlb_img_box"><img src="images/hl-bt-cal-img.jpg" width="300" height="54" /></div>
<div style="clear:both;"> </div>
<div class="hlb_right_box">
<form name="loancalc" id="loancalc" method="post" action="home-loan-balance-transfer-calculator-continue.php" onSubmit="return check_form(document.loancalc);" >
 <input type="hidden" name="source" value="Balance Transfer Calc New">
  <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
      <td height="25" class="hlb_form_text"    style="font-size:15px; font-weight:bold; color:#156dd1; padding-top:6px; padding-bottom:6px; ">Loan Details</td>
    </tr>
   

        <tr>
      <td height="25" class="hlb_form_text">Loan Amount Borrowed:</td>
    </tr>
    <tr>
      <td>
    <input   name="loan_amount"  id="loan_amount" onFocus="this.select();" onChange="intOnly(this);"  onKeyUp="intOnly(this); getDigitToWords('loan_amount','formatedlA','wordloanAmount');" onKeyPress="intOnly(this); getDigitToWords('loan_amount', 'formatedlA','wordloanAmount');" onKeyDown="getDigitToWords('loan_amount','formatedlA','wordloanAmount');" onBlur="getDigitToWords('loan_amount', 'formatedlA', 'wordloanAmount');"  class="hlb_input_box" tabindex="1" autocomplete="off"/>
                       <div id="loanAmountVal" class="alert_msg"></div>	  </td>
    </tr>
    <tr><td>
    <span id='formatedlA' style='font-family: Verdana, Arial, Helvetica, sans-serif;	font-size:11px;	color:#3A0D04; text-decoration:none; font-weight:bold; text-align:left;'></span><span id='wordloanAmount' style='font-family: Verdana, Arial, Helvetica, sans-serif;	font-size:11px;	color:#3A0D04; text-decoration:none; font-weight:bold; text-align:left;'></span>
    </td></tr>
    <tr>
      <td height="25" class="hlb_form_text">Tenure (in Years):</td>
    </tr>
    <tr>
      <td height="25">  <select name="tenure" id="tenure" class="hlb_select_box" onkeydown="validateDiv('tenureVal');" tabindex="2" >
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
                  
                        <div id="tenureVal" class="alert_msg"></div>   </td>
    </tr>
    <tr>
      <td height="25" class="hlb_form_text">Present Rate Of Interest:</td>
    </tr>
    <tr>
      <td height="25"><input type="text" name="roi" id="roi" onkeydown="validateDiv('roiVal');" class="hlb_input_box"  value="<?php echo $Interest_Rate; ?>" tabindex="3"  autocomplete="off" />
                   <div id="roiVal" class="alert_msg"></div></td>
    </tr>
   
   
   
     <tr>
      <td height="25" class="hlb_form_text">Pre Payment Charges:</td>
    </tr>
    <tr>
      <td height="25"> <input type="text" name="pre_payment_charges" id="pre_payment_charges" class="hlb_input_box" value="<?php echo $pre_payment_charges; ?>"  onkeydown="validateDiv('prepaymentVal'); intOnly(this);" onkeyup="intOnly(this);" tabindex="4"  autocomplete="off" onfocus="shw_tooltip();" onblur="shw_tooltipOFF();" />
                                      <div id="prepaymentVal"  class="alert_msg"></div>
									  <div id="shw_tultip"></div></td>
    </tr>
     <tr>
      <td height="25" class="hlb_form_text">No. of EMI Paid (in Months):</td>
    </tr>
    <tr>
      <td height="25"><input type="text" name="emi_paid" class="hlb_input_box" maxlength="5" value="<?php echo $emi_paid ; ?>" onkeydown="validateDiv('emiPaidVal');" tabindex="5" autocomplete="off" />
                    <div id="emiPaidVal" class="alert_msg"></div>  </td>
    </tr>
    <tr>
      <td height="25" class="hlb_form_text">Name of Existing Bank :</td>
    </tr>
    <tr>
      <td height="25">  <input type="text" name="Existing_Bank"  id="Existing_Bank" class="hlb_input_box" onkeyup="ajax_showOptions(this,'getCountriesByLetters',event); getstatementlink();" onchange="getstatementlink();" onkeydown="validateDiv('existBankVal');" onclick="getstatementlink();" tabindex="6" autocomplete="off" />

                    <div id="existBankVal" class="alert_msg"></div></td>
    </tr>  
    
        <tr>
      <td height="25" class="hlb_form_text">City:</td>
    </tr>
     <tr>
      <td height="25">
       <select name="City" id="City" class="hlb_select_box" onchange="addPersonalDetails(); validateDiv('cityVal');" tabindex="7">
                            <?=plgetCityList($City)?>
              </select>
                         <div id="cityVal" class="alert_msg"></div>     </td>
    </tr>
 <tr>
      <td height="0" align="center" class="hlb_form_text" style="font-size:11px; font-weight:normal;">&nbsp;</td>
    </tr>
<tr><td align="center" id="personalDetails"><img src="images/hlb_get-quote-btn.png" width="241" height="40" /></td></tr>

     <tr>
      <td height="0" align="center" class="hlb_form_text" style="font-size:11px; font-weight:normal;">&nbsp;</td>
    </tr>
  </table>
 </form>
  

 </div>
 <div style="clear:both;"></div>
 <div style="margin-top:25px;"></div>
 <div class="hlb_graph_box"><img src="images/hl_bt_cal_graph_b.jpg" width="300" height="128" /></div>
<div style="margin-top:25px;"></div>
 <div class="hlb_bank_box"><img src="images/hl_bt_cal_bank-name.jpg" width="263" height="189" /></div>

  
</div>

</div>
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