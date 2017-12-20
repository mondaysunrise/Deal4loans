<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<link href="home-loan-balance-transfer-styles1.css" type="text/css" rel="stylesheet"/>
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
 .red {
	color: #F00;
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
			
	ni1.innerHTML = '<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"><tr>      <td height="25" colspan="2" class="hlb_form_text"><table width="100%" border="0" cellpadding="0" cellspacing="0"><tr><td width="48%"  align="left" style=" padding-bottom:6px; " colspan="2" class="text_one"> Personal Details</td></tr><tr><td width="4%" style="font-size:10px; font-weight:normal; color:#999999;" valign="top"><img src="http://www.deal4loans.com/images/security.png" width="14" height="16"></td><td width="96%" align="left" class="text_two"  style="font-size:11px; font-weight:normal; ">Your Information is secure with us & will not be shared without your consent</td></tr></table></td></tr><tr>      <td height="40" class="text_two">Full Name:</td> <td width="60%" class="hlb_form_text"> <input name="Name" id="Name" type="text" class="hlbt_input"  onkeydown="validateDiv(\'nameVal\');"  value="" tabindex="8" autocomplete="off" />   <div id="nameVal" class="alert_msg"></div>   </td></tr>      <tr>      <td colspan="2">      	 </td>    </tr>   <tr>      <td height="40" class="text_two">Mobile:</td>    <td height="25" class="hlb_form_text">+91    <input name="Phone" id="Phone" maxlength="10" onkeyup="intOnly(this);" onkeypress="intOnly(this);" onchange="intOnly(this);" type="text" class="hlbt_mobile" onkeydown="validateDiv(\'phoneVal\');" tabindex="9" value="" autocomplete="off" />            <div id="phoneVal" class="alert_msg"></div></td>  </tr>        <tr>      <td height="40" class="text_two">Email ID:</td>    <td height="25" class="hlb_form_text"><input type="text" name="Email" id="Email" class="hlbt_input" onkeydown="validateDiv(\'emiPaidVal\');" tabindex="10" autocomplete="off" />                    <div id="emailVal" class="alert_msg"></div></td>  </tr>       <tr>      <td height="10" colspan="2" align="center" class="hlb_form_text" style="font-size:11px; font-weight:normal;">&nbsp;</td>    </tr>       <tr>      <td height="25" colspan="2" class="hlb_form_text" style="font-size:11px; font-weight:normal;">       <input name="accept" type="checkbox" checked="checked" tabindex="11" />         <span class="text_two"  style="font-size:11px; font-weight:normal; ">I Read and Agree to <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow">privacy policy</a> and <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow">Terms and Conditions</a>.</span>      </td>    </tr>    <tr>      <td height="10" colspan="2" align="center" class="hlb_form_text" style="font-size:11px; font-weight:normal;">&nbsp;</td>    </tr>    <tr>      <td height="45" colspan="2" align="center" class="hlb_form_text" style="font-size:11px; font-weight:normal;"><span class="hlb_form_text" style="font-size:11px; font-weight:normal;"><input type="submit" style="border: 0px none ; background-image: url(d4limages/hlb_get-calulate-btn.png); width: 243px; height: 39px; margin-bottom: 0px;" value="" tabindex="12"/></span></td>    </tr></table>';

}

</script>

<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<title>Home Loan Balance Transfer Calculator</title>
</head>

<body>
<div class="hlbt_top">
<div class="hlbt_top_b">
<div class="hlbt_logo"><img src="d4limages/hlbt-d4l-logo.png" width="191" height="72"></div>
<div class="hlbt_top_text"><span class="head_text">Home Loan Balance Transfer Calculator</span><br />
<span class="sub_text">Save over 1 Lac, Switch your Existing Home Loan</span>
</div>

</div>
</div>
<div class="hlbt_second" style=" margin-top:5px;">
<div class="hlbt_form">
 <form name="loancalc" id="loancalc" method="post" action="home-loan-balance-transfer-calculator-continue.php" onSubmit="return check_form(document.loancalc);" >
 <input type="hidden" name="source" value="homeloansbalancetransfer"> <table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td  colspan="2" height="50" class="text_one">Loan Details</td>
    </tr>
    <tr>
      <td height="55" valign="middle" class="text_two">Loan Amount Borrowed:</td>
      <td><input   name="loan_amount"  id="loan_amount" onFocus="this.select();" onChange="intOnly(this);"  onKeyUp="intOnly(this); getDigitToWords('loan_amount','formatedlA','wordloanAmount'); validateDiv('loanAmountVal');" onKeyPress="intOnly(this); getDigitToWords('loan_amount', 'formatedlA','wordloanAmount');" onKeyDown="getDigitToWords('loan_amount','formatedlA','wordloanAmount');" onBlur="getDigitToWords('loan_amount', 'formatedlA', 'wordloanAmount');"  class="hlbt_input" tabindex="1" autocomplete="off" />
          <div id="loanAmountVal" class="alert_msg"></div></td>
    </tr>
    <tr><td width="40%"></td><td>
    <span id='formatedlA' style='font-family: Verdana, Arial, Helvetica, sans-serif;	font-size:11px;	color:#3A0D04; text-decoration:none; font-weight:bold; text-align:left;'></span><span id='wordloanAmount' style='font-family: Verdana, Arial, Helvetica, sans-serif;	font-size:11px;	color:#3A0D04; text-decoration:none; font-weight:bold; text-align:left;'></span>
    </td></tr>
    <tr>
      <td height="55" valign="middle" class="text_two">Tenure (in Years):</td>
      <td><select name="tenure" id="tenure" class="hlbt_select" onkeydown="validateDiv('tenureVal');" tabindex="2" >
                         <option value="">Please Select</option>
                         <option value='5'  >5</option><option value='6'  >6</option><option value='7'  >7</option><option value='8'  >8</option><option value='9'  >9</option><option value='10'  >10</option><option value='11'  >11</option><option value='12'  >12</option><option value='13'  >13</option><option value='14'  >14</option><option value='15'  >15</option><option value='16'  >16</option><option value='17'  >17</option><option value='18'  >18</option><option value='19'  >19</option><option value='20'  >20</option><option value='21'  >21</option><option value='22'  >22</option><option value='23'  >23</option><option value='24'  >24</option><option value='25'  >25</option>                       </select>
                  
          <div id="tenureVal" class="alert_msg"></div> </td>
    </tr>
    <tr>
      <td height="55" valign="middle" class="text_two">Present Rate Of Interest:</td>
      <td><input type="text" name="roi" id="roi" onKeyDown="validateDiv('roiVal');" class="hlbt_input"  value="" tabindex="3"  autocomplete="off" />
          <div id="roiVal" class="alert_msg"></div></td>
    </tr>
    <tr>
      <td height="55" class="text_two">Pre Payment Charges:</td>
      <td><input type="text" name="pre_payment_charges" id="pre_payment_charges" class="hlbt_input" value=""  onkeydown="validateDiv('prepaymentVal'); intOnly(this);" onKeyUp="intOnly(this);" tabindex="4"  autocomplete="off" onFocus="shw_tooltip();" onBlur="shw_tooltipOFF();" />
                                      <div id="prepaymentVal"  class="alert_msg"></div>
		  <div id="shw_tultip"></div></td>
    </tr>
    <tr>
      <td height="55" class="text_two">No. of EMI Paid (in Months) :</td>
      <td><input type="text" name="emi_paid" class="hlbt_input" maxlength="5" value="" onKeyDown="validateDiv('emiPaidVal');" tabindex="5" autocomplete="off" />
          <div id="emiPaidVal" class="alert_msg"></div></td>
    </tr>
    <tr>
      <td height="55" class="text_two">Name of Existing Bank :</td>
      <td><input type="text" name="Existing_Bank"  id="Existing_Bank" class="hlbt_input" onKeyUp="ajax_showOptions(this,'getCountriesByLetters',event); getstatementlink();" onChange="getstatementlink();" onKeyDown="validateDiv('existBankVal');" onClick="getstatementlink();" tabindex="6" autocomplete="off" />

          <div id="existBankVal" class="alert_msg"></div></td>
    </tr>
    <tr>
      <td height="55" class="text_two">City:</td>
      <td><select name="City" id="City" class="hlbt_select" onChange="addPersonalDetails(); validateDiv('cityVal');" tabindex="7">
                            <option value="Please Select">Please Select</option><option value="Ahmedabad">Ahmedabad</option><option value="Bangalore">Bangalore</option><option value="Chandigarh">Chandigarh</option><option value="Chennai">Chennai</option><option value="Cochin">Cochin</option><option value="Delhi">Delhi</option><option value="Hyderabad">Hyderabad</option><option value="Jaipur">Jaipur</option><option value="Jalandhar">Jalandhar</option><option value="Kolkata">Kolkata</option><option value="Lucknow">Lucknow</option><option value="Mumbai">Mumbai</option><option value="Nagpur">Nagpur</option><option value="Pune">Pune</option><option value="Surat">Surat</option><option value="Ananthpur">Ananthpur</option><option value="Aurangabad">Aurangabad</option><option value="Baroda">Baroda</option><option value="Bhimavaram">Bhimavaram</option><option value="Bhiwadi">Bhiwadi</option><option value="Bhopal">Bhopal</option><option value="Bhubneshwar">Bhubneshwar</option><option value="Calicut">Calicut</option><option value="Coimbatore">Coimbatore</option><option value="Cuttack">Cuttack</option><option value="Dehradun">Dehradun</option><option value="Dindigul">Dindigul</option><option value="Eluru">Eluru</option><option value="Ernakulam">Ernakulam</option><option value="Erode">Erode</option><option value="Faridabad">Faridabad</option><option value="Gaziabad">Gaziabad</option><option value="Guntur">Guntur</option><option value="Gurgaon">Gurgaon</option><option value="Guwahati">Guwahati</option><option value="Hosur">Hosur</option><option value="Indore">Indore</option><option value="Jabalpur">Jabalpur</option><option value="Jamshedpur">Jamshedpur</option><option value="Kakinada">Kakinada</option><option value="Karaikkal">Karaikkal</option><option value="Karimnagar">Karimnagar</option><option value="Karur">Karur</option><option value="Kanpur">Kanpur</option><option value="Khammam">Khammam</option><option value="Kishangarh">Kishangarh</option><option value="Kochi">Kochi</option><option value="Kozhikode">Kozhikode</option><option value="Kumbakonam">Kumbakonam</option><option value="Kurnool">Kurnool</option><option value="Ludhiana">Ludhiana</option><option value="Madurai">Madurai</option><option value="Mangalore">Mangalore</option><option value="Mysore">Mysore</option><option value="Nagerkoil">Nagerkoil</option><option value="Nasik">Nasik</option><option value="Navi Mumbai">Navi Mumbai</option><option value="Nellore">Nellore</option><option value="Nizamabad">Nizamabad</option><option value="Noida">Noida</option><option value="Ongole">Ongole</option><option value="Ooty">Ooty</option><option value="Patna">Patna</option><option value="Pondicherry">Pondicherry</option><option value="Pudukottai">Pudukottai</option><option value="Rajahmundry">Rajahmundry</option><option value="Ramagundam">Ramagundam</option><option value="Raipur">Raipur</option><option value="Rewari">Rewari</option><option value="Sahibabad">Sahibabad</option><option value="Salem">Salem</option><option value="Srikakulam">Srikakulam</option><option value="Thane">Thane</option><option value="Thanjavur">Thanjavur</option><option value="Thrissur">Thrissur</option><option value="Thiruvananthapuram">Thiruvananthapuram</option><option value="Tirunelveli">Tirunelveli</option><option value="Tirupathi">Tirupathi</option><option value="Trivandrum">Trivandrum</option><option value="Trichy">Trichy</option><option value="Tuticorin">Tuticorin</option><option value="Vadodara">Vadodara</option><option value="Vellore">Vellore</option><option value="Vishakapatanam">Vishakapatanam</option><option value="Vizag">Vizag</option><option value="Vizianagaram">Vizianagaram</option><option value="Warangal">Warangal</option><option value="Others">Others</option>              </select>
          <div id="cityVal" class="alert_msg"></div></td>
    </tr>
   
    <tr>
      <td colspan="2" align="center" id="personalDetails"><img src="d4limages/hlb_get-calulate-btn.png" width="241" height="40" /></td>
    </tr>
    <tr>
      <td colspan="2" align="center">&nbsp;</td>
    </tr>
  </table>
 </form>
</div>

<div class="hlbt_right_panel">
<div class="interest_box_a">
  <table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td align="center" valign="bottom"><img src="d4limages/insetest-arrow.jpg" width="8" height="30"></td>
    </tr>
    <tr>
      <td align="center" valign="top" style="margin-top:-7px;" class="text_three">Interest</td>
    </tr>
    <tr>
      <td align="center" class="text_three">@10.2%</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="30" align="center" valign="middle" class="text_three">@10.5%</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="28" align="center" valign="middle" class="text_three">@11%</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
  </table>
</div><div class="interest_box">
<div class="interest_box_b"><table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="25"><table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="33%" height="25" align="center" bgcolor="#4f80bb" class="text_four">4000000/-</td>
          <td width="27%" align="center" bgcolor="#bd4f4e" class="text_four">5391773/-</td>
          <td width="40%" align="center" bgcolor="#02ae4b" class="text_four">517236/-</td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="33%" height="25" align="center" bgcolor="#4f80bb" class="text_four">4000000/-</td>
          <td width="35%" align="center" bgcolor="#bd4f4e" class="text_four">5584448/-</td>
          <td width="32%" align="center" bgcolor="#02ae4b" class="text_four">324561/-</td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="33%" height="25" align="center" bgcolor="#4f80bb" class="text_four">4000000/-</td>
          <td align="center" bgcolor="#bd4f4e" class="text_four">5909009/-</td>
          </tr>
      </table></td>
    </tr>
  </table>
  </div>
  <div style="clear:both;"></div>
  <div class="interest_box" style="margin-top:5px;">
    <table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td align="center"><table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
              <td colspan="4" align="right"></td>
              </tr>
            <tr>
              <td width="28%"><table width="45%" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td><table width="19%" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td width="21%"><table width="30" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                          <td bgcolor="#4F80BB">&nbsp;</td>
                        </tr>
                      </table></td>
                      <td width="79%" class="text_three" style=" color:#4f80bb;"> &nbsp;Principal</td>
                    </tr>
                  </table></td>
                </tr>
              </table></td>
              <td width="27%"><table width="45%" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td><table width="19%" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td width="21%"><table width="30" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                          <td bgcolor="#BD4F4E">&nbsp;</td>
                        </tr>
                      </table></td>
                      <td width="79%" class="text_three"  style="color:#bd4f4e;"> &nbsp;Interest</td>
                    </tr>
                  </table></td>
                </tr>
              </table></td>
              <td width="22%"><table width="45%" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td><table width="19%" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td width="21%"><table width="30" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                          <td bgcolor="#02AE4B">&nbsp;</td>
                        </tr>
                      </table></td>
                      <td width="79%" class="text_three" style="color:#02ae4b;"> &nbsp;Saving</td>
                    </tr>
                  </table></td>
                </tr>
              </table></td>
              <td width="23%" align="center" class="text_three"><span style="height:10px;"><img src="d4limages/insetest-arrow2.jpg" width="53" height="7"></span>Amount</td>
              </tr>
          </table></td>
        </tr>
    </table>
  </div>
 
  
</div>
<div style="clear:both;"></div>
<div class="right_row_one" style=" margin-top:10px;"><div class="text_5" style="margin-bottom:5px;">Top Home Loan Balance Transfer Banks</div>
<div  class=" logo_wrapper">
<div class="logo_b"> <ul>
<li style="color:#159ee1;">SBI  </li>
<li style="color:#004595;">LIC </li>
<li style="color:#d72516;">HDFC</li>
<li style="color:#a60434;">AXIS </li>
<li style="color:#f4b500;">PNB</li>
<li style="color:#d42f3c;">ICICI</li>
</ul></div>
</div>
<div class="why_tex_box" style="margin-top:10px;">
  <table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td class="text_5">Why Deal4loans.com</td>
    </tr>
    <tr>
      <td valign="top" class="why_listing">
      <ul>
     <li>Instant Balance Transfer Quotes from all Banks.</li>
     <li>Choose best deal or lowest EMI.</li>
     <li>Home Loan Balance Transfer Quotes are free for customers.</li>
     <li>Your information will not be shared with anyone without your consent.</li>
     <li>Over 26 lakh customers have taken quote at Deal4loans.com</li>
      </ul>
      </td>
    </tr>
  </table>
</div>
</div>
</div>

<div style=" clear:both;"></div>
<div class="buttom_text_box">
  <p><strong>Home Loan Balance transfer</strong> need not only mean saving money, you can also utilize the same for investing in different options. After all securing a home loan is not the end of journey. Balance transfer - by switching to another lender may give you a better deal. While a balance transfer will certainly reduce your EMI outgo, there is no one-size-fits-all solution for everybody. To know if it will help you, you need to decipher its workings and calculate the actual benefit before taking a call.<br>
    </p>
  <p><strong>Home Loan Balance Transfer Calculator</strong> involves doing a simple math which in turn would save you from coughing up your hard earned money. All you need to do is insert your existing home loan rate and prepayment charges and based on that it gives you instant quote of four other bank rates as well and tells you how much you can save.<br>
  </p>
</div>
</div>


</body>
</html>
