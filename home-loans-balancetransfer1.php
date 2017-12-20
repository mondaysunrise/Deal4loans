<?php 
	require 'scripts/db_init.php';
	require 'scripts/functions.php';

if(strlen($_REQUEST['source'])>0)
{
	$sourceS = $_REQUEST['source'];
}
else
{
	$sourceS = "Homeloan_BTLP";
}


$maxage=date('Y')-62;
$minage=date('Y')-18;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Home Loan</title>
<link href="home-loan-window-theme-lp-styles2.css" rel="stylesheet" type="text/css" />
<link href="css/tabs_styles2.css" rel="stylesheet" type="text/css" />
<script Language="JavaScript" type="text/javascript" src="scripts/common.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js'></script>
	<!--<script src="organictabs.jquery.js"></script>-->
    <script>
		$(function(){
		// Calling the plugin
			$("#example-one").organicTabs();
			$("#example-two").organicTabs({
				"speed": 100,
				"param": "tab"
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
	
	if(Form.loan_amount.value=="")
	{
		document.getElementById('blloanAmountVal').innerHTML = "<span  class='hintanchor'>Enter Loan Amount!</span>";	
		Form.loan_amount.focus();
		return false;
	}
	if(Form.roi.value=="")
	{
		document.getElementById('blroiVal').innerHTML = "<span  class='hintanchor'>Rate of Interest!</span>";	
		Form.roi.focus();
		return false;
	}
	if (Form.Existing_Bank.value=="")
	{
		document.getElementById('blexistBankVal').innerHTML = "<span  class='hintanchor'>Enter Existing Bank!</span>";	
		Form.Existing_Bank.focus();
		return false;
	}	
	if(Form.emi_paid.value=="")
	{
		document.getElementById('blemiPaidVal').innerHTML = "<span  class='hintanchor'>Enter Emi in Months!</span>";	
		Form.emi_paid.focus();
		return false;
	}

	if(Form.tenure.selectedIndex==0)
	{
		document.getElementById('bltenureVal').innerHTML = "<span  class='hintanchor'>Select Tenure!</span>";	
		Form.tenure.focus();
		return false;
	}
	
	if((Form.Name.value==""))
	{
		document.getElementById('blnameVal').innerHTML = "<span  class='hintanchor'>Fill Your Full Name!</span>";	
		Form.Name.focus();
		return false;
	}
	
	
	if (Form.Phone.value=="")
	{
		document.getElementById('blphoneVal').innerHTML = "<span  class='hintanchor'>Fill Your Mobile Number!</span>";	
		Form.Phone.focus();
		return false;
	}
	

	if(Form.Email.value=="")
	{
		document.getElementById('blemailVal').innerHTML = "<span  class='hintanchor'>Enter  Email Address!</span>";	
		Form.Email.focus();
		return false;
	}
	
	var str=Form.Email.value
	var aa=str.indexOf("@")
	var bb=str.indexOf(".")
	var cc=str.charAt(aa)

	if(aa==-1)
	{
		document.getElementById('blemailVal').innerHTML = "<span  class='hintanchor'>Enter Valid Email Address!</span>";	
		Form.Email.focus();
		return false;
	}
	else if(bb==-1)
	{
		document.getElementById('blemailVal').innerHTML = "<span  class='hintanchor'>Enter Valid Email Address!</span>";	
		Form.Email.focus();
		return false;
	}
	if (Form.City.selectedIndex==0)
	{
		document.getElementById('blcityVal').innerHTML = "<span  class='hintanchor'>Fill Your City!</span>";	
		Form.City.focus();
		return false;
	}
	if(Form.pre_payment_charges.value=="")
	{
		document.getElementById('blprepaymentVal').innerHTML = "<span  class='hintanchor'>Enter Pre-Payment Charges!</span>";	
		Form.pre_payment_charges.focus();
		return false;
	}

	if(!Form.accept.checked)
	{
		document.getElementById('blacceptVal').innerHTML = "<span  class='hintanchor'>Accept the Terms and Condition !</span>";	
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

function onFocusBlank(element,defaultVal){	if(element.value==defaultVal){		element.value="";	} }
function onBlurDefault(element,defaultVal){	if(element.value==""){		element.value = defaultVal;	} }

function addIdentified()
{
	var ni1 = document.getElementById('myDiv1');
	 ni1.innerHTML = ' <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">    <tr><td height="35" align="left" valign="middle" class="form_body" width="40%">Property Identified</td>      <td height="35" width="60%" class="form_body"><select name="Property_loc" id="Property_loc" class="select" onchange="validateDiv(\'propEditifiedVal\')"><?=getCityList1($City)?></select><div id="propEditifiedVal"></div></td></tr></table>';								
	 return true;
}	
	
function removeIdentified()
{
	var ni1 = document.getElementById('myDiv1');
	ni1.innerHTML = '';
				
		return true;

}	

function addPersonalDetailsBT()
{
	var ni1 = document.getElementById('personalDetailsBT');
	ni1.innerHTML = '<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td colspan="2" class="text-a">Personal Details</td></tr><tr><td colspan="2"  class="form_body" style="font-size:11px; font-weight:normal;" ><img src="images/security.png" width="14" height="16"> Your Information is secure with us and will not be shared without your consent</td></tr><tr><td width="40%" height="35" align="left" valign="middle" class="form_body">Full Name</td><td width="60%" height="35"><input name="Name" id="Name" type="text" class="input" onkeydown="validateDiv(\'blnameVal\');"  tabindex="6" />   <div id="blnameVal"></div>      </td></tr><tr><td height="35" align="left" valign="middle" class="form_body">Mobile Number</td><td height="35" class="form_body">+91 <input name="Phone" id="Phone" maxlength="10" onkeyup="intOnly(this);" onkeypress="intOnly(this);" onchange="intOnly(this);" type="text" class="mobile" onkeydown="validateDiv(\'blphoneVal\');" tabindex="7"   /><div id="blphoneVal"></div>  </td></tr> <tr><td height="35" align="left" valign="middle" class="form_body">Email ID</td><td height="35"><input name="Email" id="Email" type="text"  class="input" onkeydown="validateDiv(\'blemailVal\');"  tabindex="8" />          <div id="blemailVal"></div>   </td></tr><tr><td height="35" align="left" valign="middle" class="form_body">City</td><td height="35"><select name="City" id="City" class="select" onchange="validateDiv(\'blcityVal\');" tabindex="9"><?=plgetCityList($City)?></select><div id="blcityVal"></div>     </td></tr><tr><td height="35" align="left" valign="middle" class="form_body">Pre Payment Charges</td><td height="35"><input type="text" name="pre_payment_charges" id="pre_payment_charges" class="input"  onkeydown="validateDiv(\'blprepaymentVal\'); intOnly(this);" onkeyup="intOnly(this);" tabindex="10" /><div id="blprepaymentVal"></div></td></tr><tr><td height="35" colspan="2" valign="middle" class="form_body" style="font-size:11px;"><table width="98%" border="0" cellspacing="0" cellpadding="0"><tr><td width="4%"><span class="form_body" style="font-size:11px;"><input name="accept" type="checkbox" checked="checked" tabindex="11" onclick="validateDiv(\'blacceptVal\')" /></span><div id="blacceptVal"></div> </td><td width="96%"><span class="form_body" style="font-size:10px; font-weight:normal;">I authorize Deal4loans.com &amp; its partnering banks to contact me to explain the product &amp; I Agree to <a href="http://www.deal4loans.com/Privacy.php" style="color:#FFF;">privacy policy</a> and <a href="http://www.deal4loans.com/Privacy.php" style="color:#FFF;">Terms &amp; Conditions</a>.</span></td></tr></table></td></tr><tr><td height="55" colspan="2" align="center" class="form_body"><input type="submit" style="border: 0px none ; background-image: url(images/calulate-btn-window.jpg); width:259px; height:40px; margin-bottom: 0px;" value="" tabindex="12"/></td></tr></table>';
}


</script>
  <script type="text/javascript" src="ajax.js"></script>
<script type="text/javascript" src="ajax-dynamic-list.js"></script>
<style>
	/* Big box with list of options */
	#ajax_listOfOptions{
		position:absolute;	/* Never change this one */
		width:249px;	/* Width of box */
		height:65px;	/* Height of box */
		overflow:auto;	/* Scrolling features */
		border:1px solid #317082;	/* Dark green border */
		background-color:#FFF;	/* White background color */
    color: black;
		text-align:left;
		font-size:0.9em;
		z-index:100;
	}
	#ajax_listOfOptions div{	/* General rule for both .optionDiv and .optionDivSelected */
		margin:1px;		
		padding:1px;
		cursor:pointer;
		font-size:0.9em;
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
width: 175px;
padding: 2px;
border:1px solid #7F9D27;
font:normal 10px Verdana;
color:#404042;
line-height:14px;
z-index:100;
border-right: 3px solid #7F9D27;
border-bottom: 3px solid #7F9D27;}
</style>
</head>
<body>
<div class="header">
<div class="header_a">
<div class="logo"><img src="images/logo-deal4loans-window_a.jpg" width="157" height="63" /></div>
<div class="header_b">Instant balance transfer Free Quotes from <strong>9 Govt.</strong> and Private Banks<br />
  Choose best Home Loan with <?php echo date("F"); ?> <strong><?php echo date("Y"); ?></strong> rates</div>
</div>
</div>
<div class="second_container">
<div class="second_container-inn">
<div class="left_container">
<div class="form-box">
  <div id="example-two">
		<ul class="nav">
			<li class="nav-one"><a href="#balanceTransfer" <?php echo $openTabBalT; ?> >Balance Transfer</a></li>
	 </ul>
		<div class="list-wrap" style="height:auto !important;" >
		<div id="balanceTransfer" style="height:auto;" <?php echo $hideBalT; ?>>
<div class="tab_container-main">
<? if($sourceS=="netcorehl")
{ ?>
<form name="loancalc" id="loancalc" method="post" action="apply-home-loans-btcampvalidate.php" onSubmit="return check_form(document.loancalc);" >
<? } else 
{ ?>
<form name="loancalc" id="loancalc" method="post" action="home-loan-balance-transfer-calculator-continue.php" onSubmit="return check_form(document.loancalc);" >
<? } ?>
 <input type="hidden" name="source" value="<? echo $sourceS; ?>">
  <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td height="45" colspan="2" class="text-a">Loan Details</td>
      </tr>
   <tr>
      <td height="35" width="40%" align="left" valign="middle" class="form_body">Loan Amount Borrowed</td>
      <td height="35" width="60%"><input name="loan_amount" id="loan_amount" type="text" class="input" onkeydown="validateDiv('blloanAmountVal');" onkeyup="intOnly(this);" onkeypress="intOnly(this);" onchange="intOnly(this);" maxlength="30" value="<?php echo $loan_amount; ?>" tabindex="1" />

                    <div id="blloanAmountVal"></div>   </td>
    </tr>
      <tr>
      <td height="35" align="left" valign="middle" class="form_body">ROI on Current Home Loan</td>
      <td height="35"><input type="text" name="roi" id="roi" onkeydown="validateDiv('blroiVal');" class="input" value="<?php echo $Interest_Rate; ?>" tabindex="2" />
                   <div id="blroiVal"></div></td>
    </tr>
      <tr>
      <td height="35" align="left" valign="middle" class="form_body">Name of Existing Bank</td>
      <td height="35"><input type="text" name="Existing_Bank"  id="Existing_Bank" class="input" onkeyup="ajax_showOptions(this,'getCountriesByLetters',event);" onkeydown="validateDiv('blexistBankVal');" tabindex="3" /><div id="blexistBankVal"></div>   </td>
    </tr>
    <tr>
      <td height="35" align="left" valign="middle" class="form_body">No. of EMI Paid (in Months)</td>
      <td height="35"><input type="text" name="emi_paid" class="input" maxlength="5" value="<?php echo $emi_paid ; ?>" onkeydown="validateDiv('blemiPaidVal');" tabindex="4" /><div id="blemiPaidVal"></div></td>
    </tr>
	  <tr>
      <td height="35" align="left" valign="middle" class="form_body">Tenure (in Years)</td>
      <td height="35"><select name="tenure" id="tenure" class="select" tabindex="5" onchange="addPersonalDetailsBT(); validateDiv('bltenureVal'); ">
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
		   ?>        </select>
                     <div id="bltenureVal"></div>   </td>
    </tr>
    <tr><td colspan="2" id="personalDetailsBT"><table width="98%" border="0" cellspacing="0" cellpadding="0"><tr><td height="55" colspan="2" align="center" class="form_body"><input type="submit" style="border: 0px none ; background-image: url(images/calulate-btn-window.jpg); width:259px; height:40px; margin-bottom: 0px;" value="" tabindex="12"/></td></tr></table></td></tr>
  </table>
  </form>
  
  <div class="form_bottom_box" style="width:99%;"><strong>Home Loan Balance transfer</strong> need not only mean saving money, you can also utilize the same for investing in different options. After all securing a home loan is not the end of journey. Balance transfer - by switching to another lender may give you a better deal. While a balance transfer will certainly reduce your EMI outgo, there is no one-size-fits-all solution for everybody. To know if it will help you, you need to decipher its workings and calculate the actual benefit before taking a call.<br />
  <br />
  <strong>Home Loan Balance Transfer Calculator</strong> involves doing a simple math which in turn would save you from coughing up your hard earned money. All you need to do is insert your existing home loan rate and prepayment charges and based on that it gives you instant quote of four other bank rates as well and tells you how much you can save.<br />
</div>
    </div>
  <div class="right_box">
  <div class="right_box_a">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="center" class="right_text_a">Top Home Loan Balance Transfer Banks</td>
      </tr>
      <tr>
        <td height="5"></td>
      </tr>
      <tr>
        <td height="165" valign="top" bgcolor="#FFFFFF"><div class="banks_logo">
          <table width="98%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td height="41" align="center" class="sbi_text">SBI</td>
            </tr>
          </table>
        </div>
          <div class="banks_logo_b">
            <table width="98%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="41" align="center" class="lic_text">LIC</td>
              </tr>
            </table>
          </div>
          <div class="banks_logo_b">
            <table width="98%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="41" align="center" class="hdfc_bank">HDFC</td>
              </tr>
            </table>
          </div>
          <div style=" clear:both;"></div>
          <div class="banks_logo">
            <table width="98%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="41" align="center" class="axis_bank">AXIS Bank</td>
              </tr>
            </table>
          </div>
          <div class="banks_logo_b">
            <table width="98%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="41" align="center" class="pnb_housing">PNB Housing</td>
              </tr>
            </table>
          </div>
          <div class="banks_logo_b">
            <table width="98%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="41" align="center" class="icici_bank">ICICI Bank</td>
              </tr>
            </table>
          </div>
          <div style=" clear:both;"></div>
          <div class="banks_logo">
            <table width="98%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="41" align="center" class="federal_bank">Federal Bank</td>
              </tr>
            </table>
          </div>
          <div class="banks_logo_b">
            <table width="98%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="41" align="center" class="city_bank">Citi bank </td>
              </tr>
            </table>
          </div>
          <div class="banks_logo_b">
            <table width="98%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="41" align="center" class="standard_ch">Standard Chartered </td>
              </tr>
            </table>
          </div></td>
      </tr>
    </table>
  </div>
  <div class="right_box_b">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="35" align="center" class="right_text_b">Transfer your Existing Home Loan</td>
      </tr>
      <tr>
        <td align="center" bgcolor="#FAFBFD"><table width="100%" border="0" cellspacing="1" cellpadding="0">
          <tr>
            <td height="30" align="center" bgcolor="#7EC7E8" class="table_tp_text">Bank</td>
            <td height="30" align="center" bgcolor="#7EC7E8" class="table_tp_text">Interest Rate</td>
            <td height="30" align="center" bgcolor="#7EC7E8" class="table_tp_text">New EMI</td>
            <td height="30" align="center" bgcolor="#7EC7E8" class="table_tp_text">Total Savings</td>
          </tr>
          <tr class="table_tp_text">
            <td height="30" align="center" bgcolor="#efefef" class="table_hil_text">Bank A</td>
            <td height="30" align="center" bgcolor="#efefef">10.15%</td>
            <td height="30" align="center" bgcolor="#efefef">28,851</td>
            <td height="30" align="center" bgcolor="#efefef">4,82,949</td>
          </tr>
          <tr>
            <td height="30" align="center"><span class="table_hil_text"><strong>Bank B</strong></span></td>
            <td height="30" align="center" class="table_tp_text">10.25%</td>
            <td height="30" align="center" class="table_tp_text">28,951</td>
            <td height="30" align="center" class="table_tp_text">4,59,115</td>
          </tr>
          <tr>
            <td height="30" align="center" bgcolor="#efefef"><span class="table_hil_text"><strong>Bank C</strong></span></td>
            <td height="30" align="center" bgcolor="#efefef" class="table_tp_text">10.40%</td>
            <td height="30" align="center" bgcolor="#efefef" class="table_tp_text">29,249</td>
            <td height="30" align="center" bgcolor="#efefef" class="table_tp_text">3,87,410</td>
          </tr>
          <tr>
            <td height="30" align="center"><span class="table_hil_text"><strong>Bank D</strong></span></td>
            <td height="30" align="center" class="table_tp_text">10.50%</td>
            <td height="30" align="center" class="table_tp_text">29,951</td>
            <td height="30" align="center" class="table_tp_text">2,18,935</td>
          </tr>
          </table>
        </td>
      </tr>
    </table>
  </div>
  <div style="clear:both;"></div>
  <div class="right_box_c-new">
    <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td height="35" colspan="2" align="center" class="right_text_c"><strong style="color:#0083c9;">Why Deal4loans.com -</strong> <span style="color:#0083c9;">Widest Choice of Banks</span></td>
      </tr>
      <tr>
        <td height="0" colspan="2" align="center" valign="middle" >
   </td>
      </tr>
      <tr>
        <td width="5%" height="22" align="center" class="form_body" style="color:#FFF;"><img src="images/grenn-bullet-c.png" width="18" height="17" /></td>
        <td width="95%" align="left" class="bullet_c">Get<strong> free</strong> instant quote on Rates, Emi, Eligibility, <strong>Fees</strong> &amp; Documents from all Banks.</td>
      </tr>
      <tr>
        <td height="5" colspan="2" align="center" class="form_body" style="color:#FFF;"></td>
      </tr>
      <tr>
        <td height="22" align="center" class="form_body" style="color:#FFF;"><span class="form_body" style="color:#FFF;"><img src="images/grenn-bullet-c.png" width="18" height="17" /></span></td>
        <td align="left" class="bullet_c">Pick best Bank as per your requirement.</td>
      </tr>
      <tr>
        <td colspan="2" align="center" class="form_body" style="color:#FFF;" height="5"></td>
      </tr>
      <tr>
        <td height="22" align="center" class="form_body" style="color:#FFF;"><span class="form_body" style="color:#FFF;"><img src="images/grenn-bullet-c.png" width="18" height="17" /></span></td>
        <td align="left" class="bullet_c"><strong>Free</strong> Quote  taken <span style="color:#0083c9; font-size:16px; font-weight:bold;">49,</span><span style="color:#db552d; font-size:16px; font-weight:bold;">53,</span><span style="color:#0097aa; font-size:16px; font-weight:bold;">284</span> @ deal4loans.com </td>
      </tr>
      <tr>
        <td colspan="2" align="center" class="form_body" height="5"></td>
      </tr>
      <tr>
        <td height="22" align="center" class="form_body" style="color:#FFF;"><span class="form_body" style="color:#FFF;"><img src="images/grenn-bullet-c.png" width="18" height="17" /></span></td>
        <td height="22" align="left" class="bullet_c">Rates as low as <strong>10.25%</strong></td>
      </tr>
      <tr>
        <td height="5" colspan="2" align="center" ></td>
      </tr>
      <tr>
        <td height="22" align="center" class="form_body" style="color:#FFF;"><span class="form_body" style="color:#FFF;"><img src="images/grenn-bullet-c.png" width="18" height="17" /></span></td>
        <td height="22" align="left" class="bullet_c ">Get Instant quote from<strong> 9</strong> Nationalized and Private Banks</td>
      </tr>
      </table>
  </div>
  <div style=" clear:both;"></div>
  </div>
<div style="clear:both;"></div>
  </div>
		</div>
        </div>
</div>
</div>
<div style=" clear:both;"></div>
</div>
</div>
</body>
</html>
