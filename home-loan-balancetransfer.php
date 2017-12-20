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
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="balance-transfer-lp-styles.css" type="text/css" rel="stylesheet" />
<title>Home Loan Balance Transfer</title>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
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
	
	if (Form.Existing_Bank.value=="")
	{
		document.getElementById('existBankVal').innerHTML = "<span  class='hintanchor'>Enter Existing Bank!</span>";	
		Form.Existing_Bank.focus();
		return false;
	}	
	if(Form.emi_paid.value=="")
	{
		document.getElementById('emiPaidVal').innerHTML = "<span  class='hintanchor'>Enter Pre-Payment Charges!</span>";	
		Form.emi_paid.focus();
		return false;
	}
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
	
	if(!Form.accept.checked)
	{
		document.getElementById('acceptVal').innerHTML = "<span  class='hintanchor'>Accept the Terms and Condition !</span>";	
		//alert("Accept the Terms and Condition");
		Form.accept.focus();
		return false;
	}
}


function otherDetails()
{
	var ni1 = document.getElementById('othDetailsDiv');
	//ni1.innerHTML = 'dsfsddfd';
		ni1.innerHTML = '<table width="97%" border="0" align="center" cellpadding="0" cellspacing="0">  <tr>    <td height="30" class="form_text" style="font-size:15px; font-size:15px; border-bottom:thin solid #FFF; color:#FFF;" >Other Details</td>  </tr>  <tr>    <td width="100%" height="30"><span class="form_text">Loan Amount Borrowed:</span></td>  </tr>  <tr>    <td><input name="loan_amount"  id="loan_amount" onFocus="this.select();" onChange="intOnly(this);"  onKeyUp="intOnly(this); getDigitToWords(\'loan_amount\', \'formatedlA\', \'wordloanAmount\');" onKeyPress="intOnly(this); getDigitToWords(\'loan_amount\', \'formatedlA\',\'wordloanAmount\');" onKeyDown="getDigitToWords(\'loan_amount\', \'formatedlA\',\'wordloanAmount\');" onBlur="getDigitToWords(\'loan_amount\', \'formatedlA\',\'wordloanAmount\');" class="input" tabindex="7" autocomplete="off" /><div id="loanAmountVal" class="alert_msg"></div></td>  </tr>  <tr><td>  <span id="formatedlA" style="font-family: Verdana, Arial, Helvetica, sans-serif;	font-size:11px;	color:#3A0D04; text-decoration:none; font-weight:bold; text-align:left;"></span><span id="wordloanAmount" style="font-family: Verdana, Arial, Helvetica, sans-serif;	font-size:11px;	color:#3A0D04; text-decoration:none; font-weight:bold; text-align:left;"></span>    </td></tr>  <tr>    <td height="30"><span class="form_text">Tenure (in Years):</span></td>  </tr>  <tr>    <td> <select name="tenure" id="tenure" class="select" onkeydown="validateDiv(\'tenureVal\');" tabindex="8" ><option value="">Please Select</option><option value="5"  >5</option><option value="6"  >6</option><option value="7"  >7</option><option value="8"  >8</option><option value="9"  >9</option><option value="10"  >10</option><option value="11"  >11</option><option value="12"  >12</option><option value="13"  >13</option><option value="14"  >14</option><option value="15"  >15</option><option value="16"  >16</option><option value="17"  >17</option><option value="18"  >18</option><option value="19"  >19</option><option value="20"  >20</option><option value="21"  >21</option><option value="22"  >22</option><option value="23"  >23</option><option value="24"  >24</option><option value="25"  >25</option></select><div id="tenureVal" class="alert_msg"></div></td></tr><tr><td height="30" class="form_text">Present Rate Of Interest:</td></tr><tr><td><input type="text" name="roi" id="roi" onKeyDown="validateDiv(\'roiVal\');" class="input"  value="<?php echo $Interest_Rate; ?>" tabindex="9" autocomplete="off" /><div id="roiVal" class="alert_msg"></div></td></tr><tr><td height="30"><span class="form_text">Pre Payment Charges:</span></td></tr><tr><td><input type="text" name="pre_payment_charges" id="pre_payment_charges" class="input" value="<?php echo $pre_payment_charges; ?>"  onkeydown="validateDiv(\'prepaymentVal\'); intOnly(this);" onKeyUp="intOnly(this);" tabindex="10"  onfocus="shw_tooltip();" onBlur="shw_tooltipOFF();" /><div id="prepaymentVal"></div><div id="shw_tultip"></div></td></tr></table>';


}
</script>
  <script type="text/javascript" src="ajax.js"></script>
<script type="text/javascript" src="ajax-dynamic-list.js"></script>
<style>
	#ajax_listOfOptions{
		position:absolute;
		width:250px;
		height:68px;
		overflow:auto;
		border:1px solid #317082;
		background-color:#FFF;
	    color: black;
		text-align:left;
		font-size:0.9em;
		font-family:Arial, Helvetica, sans-serif;
		z-index:100;
	}
	#ajax_listOfOptions div{	
		margin:1px;		
		padding:1px;
		cursor:pointer;
		font-size:0.9em;
		font-family:Arial, Helvetica, sans-serif;
	}
	#ajax_listOfOptions .optionDiv{
		
	}
	#ajax_listOfOptions .optionDivSelected{ 		background-color:#2375CB;		color:#FFF;	}
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

.red {
	color: #F00;
}
-->
  .alert_msg{color:#990000; font-weight:bold; font-size:12px; font-family: Verdana, Geneva, sans-serif;}
input,select{border:1px solid #878787;margin:0;padding:0}
select:focus, input:focus
{
border:#FF0000 1px solid; 
}
</style>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>

</head>
<body>
<div class="main_wraper">
<div class="top_box">
<div class="logo"><img src="images/bt_d4llogo.jpg" width="212" height="79" /></div>
<div class="top_head_bx"><h2>Save <span class="bold">Rs. 2-5 Lacs</span> via Home loan <span class="bold">Balance Transfer!</span></h2></div>
</div>
<div style="clear:both;"></div> 
<div class="left_box"><h1>Home Loan Balance Transfer Calculator</h1>

<div style="clear:both;"></div>
<div class="graph"><img src="images/bt_graph.jpg" width="280" height="241"></div>
<div class="box">
  <table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td><img src="images/sample-blance.jpg" width="368" height="38"></td>
    </tr>
    <tr>
      <td><table width="100%" border="0" cellpadding="0" cellspacing="2">
        <tr>
          <td width="15%" height="36" align="center" bgcolor="#3c63ac" class="text_a">Bank</td>
          <td width="17%" height="36" align="center" bgcolor="#3c63ac" class="text_a">Interest<br> Rate</td>
          <td width="19%" height="36" align="center" bgcolor="#3c63ac" class="text_a">New EMI</td>
          <td width="25%" height="36" align="center" bgcolor="#3c63ac" class="text_a">Monthly <br>
            Saving</td>
          <td width="24%" height="36" align="center" bgcolor="#3c63ac" class="text_a">Total <br>
            Savings</td>
          </tr>
        <tr>
          <td height="35" align="center" class="text">Bank A</td>
          <td height="35" align="center" class="text">10%</td>
          <td height="35" align="center" class="text">28,995</td>
          <td height="35" align="center" class="text">2,997</td>
          <td height="35" align="center" class="text">6,47,352</td>
          </tr>
        <tr>
          <td height="35" align="center" class="text">Bank B</td>
          <td height="35" align="center" class="text">10.25%</td>
          <td height="35" align="center" class="text">29,450</td>
          <td height="35" align="center" class="text">2,447</td>
          <td height="35" align="center" class="text">5,28,552</td>
          </tr>
        <tr>
          <td height="35" align="center" class="text">Bank C</td>
          <td height="35" align="center" class="text">10.50%</td>
          <td height="35" align="center" class="text">29,951</td>
          <td height="35" align="center" class="text">2,041</td>
          <td height="35" align="center" class="text">4,40,856</td>
          </tr>
        <tr>
          <td height="35" align="center" class="text">Bank D</td>
          <td height="35" align="center" class="text">10.70%</td>
          <td height="35" align="center" class="text">30,335</td>
          <td height="35" align="center" class="text">1,657</td>
          <td height="35" align="center" class="text">3,57,912</td>
          </tr>
        </table></td>
    </tr>
    </table>
</div>
<div style="clear:both;"></div>
<div class="box_b">Get additional topup for other expenses<br>
  at low interest rates</div>
  <div class="box_c">
  <p class="text_d">Why Deal4loans.com</p>
  <div style="margin-top:5px;" class="text_e">
  <ul>
  <li>Instant <span class="bold_b">Balance Transfer Quotes</span> from major Banks in India.</li>
  <li>Choose best deal or <span class="bold_b">lowest EMI</span>.</li>
  <li>Home Loan Balance Transfer Quotes are free for customers.</li>
  <li>Your information will not be shared with anyone without your consent.</li>
  <li>Over <span class="bold_b">26 lakh </span>customers have taken quote at Deal4loans.com</li>
  </ul>
  </div>
  <div style="clear:both;"></div>
  <div class="body"><strong>Home Loan Balance transfer</strong> need not only mean saving money, you can also utilize the same for investing in different options. After all securing a home loan is not the end of journey. Balance transfer - by switching to another lender may give you a better deal. While a balance transfer will certainly reduce your EMI outgo, there is no one-size-fits-all solution for everybody. To know if it will help you, you need to decipher its workings and calculate the actual benefit before taking a call.</div>
  <div class="body"><strong>Home Loan Balance Transfer Calculator</strong> involves doing a simple math which in turn would save you from coughing up your hard earned money. All you need to do is insert your existing home loan rate and prepayment charges and based on that it gives you instant quote of four other bank rates as well and tells you how much you can save.</div>
  </div>
</div>

<div class="right_box">
<div class="shadow"></div>
<div style="width:291px; height:18px; background:url(images/formtp-bg.jpg) repeat-x;"></div>
<div style="clear:both;"></div>
<div class="form_box">
<form name="loancalc" id="loancalc" method="post" action="home-loan-balance-transfer-calculator-continue.php" onSubmit="return check_form(document.loancalc);" >
<input type="hidden" name="source" value="home loan BalanceTransfer">
<div class="per_details">

<table width="97%" border="0" align="center" cellpadding="0" cellspacing="0">
 <tr>
    <td height="30" colspan="2" class="form_text">Name of Existing Bank :</td>
  </tr>
  <tr>
    <td colspan="2">  <input type="text" name="Existing_Bank"  id="Existing_Bank" class="input" onKeyUp="ajax_showOptions(this,'getCountriesByLetters',event); getstatementlink();" onChange="getstatementlink();" onKeyDown="validateDiv('existBankVal');" onClick="getstatementlink();" tabindex="1" autocomplete="off" />

                    <div id="existBankVal" class="alert_msg"></div>
    </td>
  </tr>
  <tr>
    <td height="30" colspan="2" class="form_text">No. of EMI Paid (in Months):</td>
  </tr>
  <tr>
    <td colspan="2"><input type="text" name="emi_paid" class="input" maxlength="5" value="<?php echo $emi_paid ; ?>" onKeyDown="validateDiv('emiPaidVal');" tabindex="2" autocomplete="off" />
                    <div id="emiPaidVal" class="alert_msg"></div></td>
  </tr>
</table></div>
<div class="per_details"><table width="97%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="30" colspan="2" class="form_text"><table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="51%" style="font-size:15px; color:#FFF;">Personal Details</td>
        <td width="49%" style="font-size:10px; color:#FFF; font-weight:normal;"><img src="images/bt_locked.png" width="12" height="12">we keep this secure</td>
      </tr>
      <tr>
        <td colspan="2" style="font-size:15px; height:5px; border-bottom:thin solid #FFF;" ></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td height="30" colspan="2" class="form_text">Full Name:</td>
  </tr>
  <tr>
    <td colspan="2"><input type="text" class="input" name="Name" id="Name" onKeyDown="validateDiv('nameVal');"  value="<?php echo $Name; ?>" tabindex="3" autocomplete="off" />
   <div id="nameVal" class="alert_msg"></div></td>
  </tr>
  <tr>
    <td height="30" colspan="2" class="form_text">City:</td>
  </tr>
  <tr>
    <td colspan="2">
           <select name="City" id="City" class="select" onChange="validateDiv('cityVal'); otherDetails();" tabindex="4">
                            <?=plgetCityList($City)?>
              </select>
                         <div id="cityVal" class="alert_msg"></div>
        </td>
  </tr>
  <tr>
    <td height="30" colspan="2" class="form_text">Mobile:</td>
  </tr>
  <tr>
    <td width="13%" align="left"><span class="form_text">+91</span></td>
    <td width="87%" align="left">
     <input name="Phone" id="Phone" maxlength="10" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" onChange="intOnly(this);" type="text" class="mobile" onKeyDown="validateDiv('phoneVal');" tabindex="5" value="<?php echo $Phone; ?>" autocomplete="off" />
            <div id="phoneVal" class="alert_msg"></div>
    
    </td>
  </tr>
  <tr>
    <td height="30" colspan="2" class="form_text">Email ID:</td>
  </tr>
  <tr>
    <td colspan="2"><input type="text" name="Email" id="Email" class="input" onKeyDown="validateDiv('emiPaidVal');" tabindex="6" autocomplete="off" />
                    <div id="emailVal" class="alert_msg"></div>
    </td>
  </tr>
</table></div>
<div class="per_details" id="othDetailsDiv"></div>
<div class="per_details">
<table width="97%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="50" valign="middle" class="body" style="font-size:11px; text-align:left;"><input type="checkbox" name="accept" id="accept"  checked="checked" tabindex="11" />
      I Read and Agree to <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow" class="body"  style="font-size:11px;">privacy policy</a> and <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow" class="body"  style="font-size:11px;">Terms and Conditions</a>.</td>
  </tr>
  <tr>
    <td height="50" align="center"> <input type="submit" style="border: 0px none ; background-image: url(images/bt_calculator-btn.jpg); width: 263px; height: 38px; margin-bottom: 0px;" value="" tabindex="12"/>
    </td>
  </tr>
  </table>
  </div> 

</form>


</div>
<div style="clear:both;"></div>
<div class="banks_box"><img src="images/balance-tansfer-bank-logos.jpg" width="287" height="171"></div>
</div>
</div>
</body>
</html>