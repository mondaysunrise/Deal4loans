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
<link href="css/home-loan-balance-transfer-styles13.css" type="text/css" rel="stylesheet" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Home Loan Balance Transfer Calculator</title>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<link href="http://www.deal4loans.com/style/sliderbaltrans.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="http://www.deal4loans.com/style/jquery_ui_css.css" />
<script src="http://code.jquery.com/jquery-1.8.3.js"></script>
<script src="http://code.jquery.com/ui/1.10.0/jquery-ui.js"></script>
<script src="scripts/highcharts.js"></script>
<script src="jscript-marquee.js" type="text/javascript" ></script>
<link href="marquee.css" type="text/css" rel="stylesheet"  />

<style type="text/css">
.sagscroller {
width: 100%!important;
height: 100px;
overflow: hidden;
position: relative;
border: 2px solid black;
border-radius: 8px;
-moz-border-radius: 8px;
-webkit-border-radius: 8px;
}

#mysagscroller2 ul li{
border-width:0;
display:block; /*this causes each image to be flush against each other*/
}

</style>

<script>
var sagscroller1=new sagscroller({
	id:'mysagscroller',
	mode: 'manual' })

var sagscroller2=new sagscroller({
	id:'mysagscroller2',
	mode: 'auto',
	pause: 2500,
	animatespeed: 400 //<--no comma following last option
})

</script>
<script src="amort1.js"></script>
<script>
//loan amount
$(function() {
			$( "#slider_la" ).slider({
			range: "min",
			value: 2000000,
			min: 100000,
			step: 100000,
			max:  20000000,
			slide: function( event, ui ) {
				$( "#amount_1a" ).val( "" + ui.value );
			}
			,change:function(){EMI_calc()}
		});
		$( "#amount_1a" ).val( "" + $( "#slider_la" ).slider( "value" ) );
	});

//interest rate
$(function() {
			$( "#slider_intr" ).slider({
			range: "min",
			value: 10.25,
			min: 8.5,
			step: .25,
			max:  15,
			slide: function( event, ui ) {
				$( "#amount_intr" ).val( "" + ui.value );
			}
			,change:function(){EMI_calc()}
		});
		$( "#amount_intr" ).val( "" + $( "#slider_intr" ).slider( "value" ) );
	});

//loan tenure
/*
$(function() {
			$( "#slider_intrnew" ).slider({
			range: "min",
			value: 10,
			min: 8.5,
			step: .25,
			max:  15,
			slide: function( event, ui ) {
				$( "#amount_intrnew" ).val( "" + ui.value );
			}
			,change:function(){EMI_calc()}
		});
		$( "#amount_intrnew" ).val( "" + $( "#slider_intrnew" ).slider( "value" ) );
	});
*/	
	function EMI_calc()
	{
		//alert("sdfsfd");
		var emiPrincipal=jQuery("#amount_1a").val();
		var initRate = jQuery("#amount_intr").val();
		if(initRate>0)
		{ 
			var emiRate=jQuery("#amount_intr").val()/12/100;
		}
		else
		{
			var emiRate=10.5/12/100;
			$( "#amount_intr" ).val( "10.5" );
		}
		var emiTenure=20 * 12;
		var emi=emiPrincipal*emiRate*(Math.pow(1+emiRate,emiTenure)/(Math.pow(1+emiRate,emiTenure)-1));
		var intrRateFixed = 10.5;
		var emiRateFixed=10.5/12/100;
		var emiFixed=emiPrincipal*emiRateFixed*(Math.pow(1+emiRateFixed,emiTenure)/(Math.pow(1+emiRateFixed,emiTenure)-1));
		var totalAmtPaidFixed = (emiFixed * emiTenure);
		var excessAmountFixed = totalAmtPaidFixed - emiPrincipal;
		
		var totalAmtPaid = (emi * emiTenure);
		var excessAmount = totalAmtPaid - emiPrincipal;
		
		if(initRate>10.5)
		{
			var finalAmt = excessAmount - excessAmountFixed;
			jQuery("#excess_amt_Label span").text("You will be in loss");
			//jQuery("#reducedLabel span").text("Increased Interest");
		}
		else
		{
			var finalAmt = excessAmountFixed - excessAmount;		
			jQuery("#excess_amt_Label span").text("You will Save ");
		//	jQuery("#reducedLabel span").text("Reduced Interest");
			
		}	
		jQuery("#excess_Amount span").text(number_format(Math.round(finalAmt)));
		jQuery("#otherCalcVal span").text(" % Per Annum");	
	}
</script>
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

function check_formMob(Form)
{


	if((Form.Name2.value=="") || (Trim(Form.Name2.value))==false)
	{
		document.getElementById('name2Val').innerHTML = "<span  class='hintanchor'>Fill Your Full Name!</span>";	
		Form.Name2.focus();
		return false;
	}
	  
	
	if (Form.Phone2.value=="")
	{
		document.getElementById('phone2Val').innerHTML = "<span  class='hintanchor'>Fill Your Mobile Number!</span>";	
		Form.Phone2.focus();
		return false;
	}
	 if(isNaN(Form.Phone2.value)|| Form.Phone2.value.indexOf(" ")!=-1)
		{
    		document.getElementById('phone2Val').innerHTML = "<span  class='hintanchor'>Enter numeric value!</span>";	
	         Form.Phone2.focus();
			  return false;  
		}
        if (Form.Phone2.value.length < 10 )
		{
			document.getElementById('phone2Val').innerHTML = "<span  class='hintanchor'>Enter 10 Digits!</span>";	
			Form.Phone2.focus();
			return false;
        }
        if ((Form.Phone2.value.charAt(0)!="9") && (Form.Phone2.value.charAt(0)!="8") && (Form.Phone2.value.charAt(0)!="7"))
		{			document.getElementById('phone2Val').innerHTML = "<span  class='hintanchor'>Number starts with 9 or 8 or 7!</span>";	
			 Form.Phone2.focus();
            return false;
        }
     if (Form.City2.selectedIndex==0)
	{
		document.getElementById('city2Val').innerHTML = "<span  class='hintanchor'>Fill Your City!</span>";	
		Form.City2.focus();
		return false;
	}
	if(!Form.accept2.checked)
	{
		document.getElementById('accep2tVal').innerHTML = "<span  class='hintanchor'>Accept the Terms and Condition !</span>";	
		//alert("Accept the Terms and Condition");
		Form.accept2.focus();
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
.font22 {
font-family: 'Droid Sans', sans-serif;
font-size: 17px;
font-weight: bold;
font-variant: normal;
color: #666666;
text-decoration: none;
}
</style>
<script language="javascript">
function addPersonalDetails()
{

	var ni1 = document.getElementById('personalDetails');
			
	ni1.innerHTML = '<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"><tr>      <td height="25" colspan="3" class="hlb_form_text"><table width="100%" border="0" cellpadding="0" cellspacing="0"><tr><td width="48%"  align="left" style="font-size:15px; color:#156dd1; padding-bottom:6px; " colspan="2"> Personal Details</td></tr><tr><td width="4%" style="font-size:10px; font-weight:normal; color:#999999;" valign="top"><img src="http://www.deal4loans.com/images/security.png" width="14" height="16"></td><td width="96%" align="left"class="sbi_text_a"  style="font-size:10px; font-weight:normal; color:#156dd1;">Your Information is secure with us & will not be shared without your consent</td></tr></table></td></tr><tr>      <td width="47%" height="25" class="hlb_form_text">Full Name:</td>  <td colspan="2" class="hlb_form_text"><input name="Name" id="Name" type="text" class="hlb_input_box"  onkeydown="validateDiv(\'nameVal\');"  value="<?php echo $Name; ?>" tabindex="8" autocomplete="off" />   <div id="nameVal" class="alert_msg"></div>  </td></tr>    <tr>      <td colspan="3">      	   </td>    </tr>   <tr>  <td height="10" class="hlb_form_text"></td>  <td height="10" colspan="2" class="hlb_form_text"></td></tr><tr>      <td height="25" class="hlb_form_text">Mobile:</td>  <td width="3%" height="25" class="hlb_form_text">+91    </td>  <td width="50%" class="hlb_form_text"><input name="Phone" id="Phone" maxlength="10" onkeyup="intOnly(this);" onkeypress="intOnly(this);" onchange="intOnly(this);" type="text" class="hlb_input_mobo" onkeydown="validateDiv(\'phoneVal\');" tabindex="9" value="<?php echo $Phone; ?>" autocomplete="off" />            <div id="phoneVal" class="alert_msg"></div></td></tr>      <tr>      <td height="10" colspan="3" class="hlb_form_text"></td>    </tr>     <tr>      <td height="25" class="hlb_form_text">Email ID:</td>  <td height="25" colspan="2" class="hlb_form_text"><input type="text" name="Email" id="Email" class="hlb_input_box" onkeydown="validateDiv(\'emiPaidVal\');" tabindex="10" autocomplete="off" />                    <div id="emailVal" class="alert_msg"></div>	</td></tr>    <tr>      <td height="10" colspan="3" align="center" class="hlb_form_text" style="font-size:11px; font-weight:normal;">&nbsp;</td>    </tr>       <tr>      <td height="25" colspan="3" class="hlb_form_text" style="font-size:11px; font-weight:normal;">       <input name="accept" type="checkbox" checked="checked" tabindex="11" />         <span class="hlb_form_text" style="font-size:11px; font-weight:normal;">I Read and Agree to <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow">privacy policy</a> and <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow">Terms and Conditions</a>.</span><div id="acceptVal"></div>      </td>    </tr>    <tr>      <td height="10" colspan="3" align="center" class="hlb_form_text" style="font-size:11px; font-weight:normal;">&nbsp;</td>    </tr>    <tr>      <td height="45" colspan="3" align="center" class="hlb_form_text" style="font-size:11px; font-weight:normal;"><span class="hlb_form_text" style="font-size:11px; font-weight:normal;"><input type="submit" style="border: 0px none ; background-image: url(images/hlb_get-quote-btn-btn.png); width:330px; height: 40px; margin-bottom: 0px;" value="" tabindex="12"/></span></td>    </tr></table>';

}

</script>

<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
</head>

<body>
<div class="main_container">
<div class="hlb_left_box-new">
<div class="hlb_logo_box"><img src="images/logo.gif" width="243" height="90" /></div>
<div class="hlb_top_head_box-new"><span class="title_box"><span class="hlb_text_head"
>Home Loan Balance Transfer Calculator</span><br />
</span></div>

</div><div style="clear:both;"></div>
</div>
<div class="wrapper-second">
  <div class="new-right-pane2">
    <div style="padding-top:8px;">
    <div class="newformwrapper"><div class="hlb_right_box-wrappernew">
    <div class="hlbt-newformbox">
    
    <div class="hlb_img_box"><img src="images/hl-bt-cal-img.jpg" width="300" height="54" /></div>
<form name="loancalc" id="loancalc" method="post" action="home-loan-balance-transfer-calculator-continue.php" onSubmit="return check_form(document.loancalc);" >
 <input type="hidden" name="source" value="Display">
  <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
      <td height="25" colspan="2" class="hlb_form_text"    style="font-size:15px; font-weight:bold; color:#156dd1; padding-top:6px; padding-bottom:6px; ">Loan Details</td>
    </tr>
   

        <tr>
      <td width="47%" height="25" class="hlb_form_text">Loan Amount Borrowed:</td>
      <td width="53%" class="hlb_form_text"><input   name="loan_amount"  id="loan_amount" onFocus="this.select();" onChange="intOnly(this);"  onKeyUp="intOnly(this); getDigitToWords('loan_amount','formatedlA','wordloanAmount');" onKeyPress="intOnly(this); getDigitToWords('loan_amount', 'formatedlA','wordloanAmount');" onKeyDown="validateDiv('loanAmountVal'); getDigitToWords('loan_amount','formatedlA','wordloanAmount');" onBlur="getDigitToWords('loan_amount', 'formatedlA', 'wordloanAmount');"  class="hlb_input_box" tabindex="1" autocomplete="off"/>
                       <div id="loanAmountVal" class="alert_msg"></div></td>
        </tr>
    <tr>
      <td colspan="2">
    	  </td>
    </tr>
    <tr>
      <td colspan="2">
    <span id='formatedlA' style='font-family: Verdana, Arial, Helvetica, sans-serif;	font-size:11px;	color:#3A0D04; text-decoration:none; font-weight:bold; text-align:left;'></span><span id='wordloanAmount' style='font-family: Verdana, Arial, Helvetica, sans-serif;	font-size:11px;	color:#3A0D04; text-decoration:none; font-weight:bold; text-align:left;'></span>
  </td></tr>
    <tr>
      <td height="10" colspan="2" class="hlb_form_text"></td>
      </tr>
    <tr>
      <td height="25" class="hlb_form_text">Tenure (in Years):</td>
      <td height="25" class="hlb_form_text"><select name="tenure" id="tenure" class="hlb_select_box" onkeydown="validateDiv('tenureVal');" tabindex="2" >
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
                  
                        <div id="tenureVal" class="alert_msg"></div></td>
    </tr>
    <tr>
      <td height="10" colspan="2">    </td>
    </tr>
    <tr>
      <td height="25" class="hlb_form_text">Present Rate Of Interest:</td>
      <td height="25" class="hlb_form_text"><input type="text" name="roi" id="roi" onkeydown="validateDiv('roiVal');" class="hlb_input_box"  value="<?php echo $Interest_Rate; ?>" tabindex="3"  autocomplete="off" />
                   <div id="roiVal" class="alert_msg"></div></td>
    </tr>
    <tr>
      <td height="10" colspan="2"></td>
    </tr>
   
   
   
     <tr>
      <td height="25" class="hlb_form_text">Pre Payment Charges:</td>
      <td height="25" class="hlb_form_text"><input type="text" name="pre_payment_charges" id="pre_payment_charges" class="hlb_input_box" value="<?php echo $pre_payment_charges; ?>"  onkeydown="validateDiv('prepaymentVal'); intOnly(this);" onkeyup="intOnly(this);" tabindex="4"  autocomplete="off" onfocus="shw_tooltip();" onblur="shw_tooltipOFF();" />
                                      <div id="prepaymentVal"  class="alert_msg"></div>
									  <div id="shw_tultip"></div></td>
     </tr>
    <tr>
      <td height="10" colspan="2">&nbsp;</td>
    </tr>
     <tr>
      <td height="25" class="hlb_form_text">No. of EMI Paid (in Months):</td>
      <td height="25" class="hlb_form_text"><input type="text" name="emi_paid" class="hlb_input_box" maxlength="5" value="<?php echo $emi_paid ; ?>" onkeydown="validateDiv('emiPaidVal');" tabindex="5" autocomplete="off" />
                    <div id="emiPaidVal" class="alert_msg"></div> </td>
     </tr>
    <tr>
      <td height="10" colspan="2"> </td>
    </tr>
    <tr>
      <td height="25" class="hlb_form_text">Name of Existing Bank :</td>
      <td height="25" class="hlb_form_text"><input type="text" name="Existing_Bank"  id="Existing_Bank" class="hlb_input_box" onkeyup="ajax_showOptions(this,'getCountriesByLetters',event); getstatementlink();" onchange="getstatementlink();" onkeydown="validateDiv('existBankVal');" onclick="getstatementlink();" tabindex="6" autocomplete="off" />

                    <div id="existBankVal" class="alert_msg"></div></td>
    </tr>
    <tr>
      <td height="10" colspan="2"></td>
    </tr>  
    
        <tr>
          <td height="25" class="hlb_form_text">City:</td>
          <td height="25" class="hlb_form_text"><select name="City" id="City" class="hlb_select_box" onchange="addPersonalDetails(); validateDiv('cityVal');" tabindex="7">
            <?=plgetCityList($City)?>
            </select>
            <div id="cityVal" class="alert_msg"></div>  </td>
        </tr>
     <tr>
       <td height="0" colspan="2" align="center" class="hlb_form_text" style="font-size:11px; font-weight:normal;">&nbsp;</td>
     </tr>
<tr><td colspan="2" align="center" id="personalDetails"><img src="images/hlb_get-quote-btn-btn.png" width="330" height="40" /></td></tr>

     <tr>
      <td height="0" colspan="2" align="center" class="hlb_form_text" style="font-size:11px; font-weight:normal;">&nbsp;</td>
    </tr>
  </table>
 </form>
</div>
<div class="hlbt-newform-mobo-box">
<form name="loancalcMob" id="loancalcMob" method="post" action="home-loan-balance-transfer-calculator-mob-continue.php" onSubmit="return check_formMob(document.loancalcMob);" >
 <input type="hidden" name="source" value="Display">
<table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="25" colspan="2" align="center" class="hlb_form_text" style="font-size:13px; font-weight:bold; color:#349c09; padding-top:6px; padding-bottom:6px;">Home Loan Balance Transfer Calculator</td>
  </tr>
  <tr>
    <td height="25" colspan="2" class="hlb_form_text"    style="font-size:15px; font-weight:bold; color:#156dd1; padding-top:6px; padding-bottom:6px; ">Loan Details</td>
  </tr>
  <tr>
    <td width="47%" height="25" class="hlb_form_text">Name </td>
    <td width="53%" class="hlb_form_text">
      <input name="Name2" id="Name2" type="text" class="hlb_input_box"  onkeydown="validateDiv('name2Val');"  value="<?php echo $Name; ?>" tabindex="1" autocomplete="off" />  
      <div id="name2Val" class="alert_msg"></div>
      </td>
  </tr>
  <tr>
    <td colspan="2"></td>
  </tr>
  <tr>
    <td colspan="2"></td>
  </tr>
  <tr>
    <td height="10" colspan="2" class="hlb_form_text"></td>
  </tr>
  <tr>
    <td height="25" class="hlb_form_text">Mobile No.</td>
    <td height="25" class="hlb_form_text">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="5%">+91</td>
          <td width="95%">
          <input name="Phone2" id="Phone2" maxlength="10" onkeyup="intOnly(this);" onkeypress="intOnly(this);" onchange="intOnly(this);" type="text" class="hlb_input_mobo" onkeydown="validateDiv('phone2Val');" tabindex="2" value="<?php echo $Phone; ?>" autocomplete="off" />  
          <div id="phone2Val" class="alert_msg"></div>
         </td>
        </tr>
      </table>
</td>
  </tr>
  <tr>
    <td height="10" colspan="2"></td>
  </tr>
  <tr>
    <td height="25" class="hlb_form_text">City</td>
    <td height="25" class="hlb_form_text">
   <select name="City2" id="City2" class="hlb_select_box" onchange="validateDiv('city2Val');" tabindex="3">
            <?=plgetCityList($City)?>
            </select>
            <div id="city2Val" class="alert_msg"></div>
   </td>
  </tr>
   <tr>      <td height="25" colspan="3" class="hlb_form_text" style="font-size:11px; font-weight:normal;">       <input name="accept2" type="checkbox" checked="checked" tabindex="11" />         <span class="hlb_form_text" style="font-size:11px; font-weight:normal;">I Read and Agree to <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow">privacy policy</a> and <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow">Terms and Conditions</a>.</span>     <div id="accept2Val"></div> </td>    </tr>
  <tr>
    <td height="10" colspan="2"></td>
  </tr>
 
  <tr>
    <td colspan="2" align="center"><input type="submit" style="border: 0px none ; background-image: url(images/get-quote-mobile-btn.png); width:284px; height: 50px; margin-bottom: 0px; no-repeat;" value="" tabindex="12"/></td>
  </tr>
  <tr>
    <td height="0" colspan="2" align="center" class="hlb_form_text" style="font-size:11px; font-weight:normal;">&nbsp;</td>
  </tr>
</table></form></div>
</div>
<div style="clear:both;"></div>
<div class="logos-wrapper-new" style="background:#FFFFFF;">
<div class="tptext">Top Home Loan Balance Transfer Banks</div>
<div style="color:#0033FF; font-size:18px; font-weight:bold;"> <span style="font-size:18px;">Sbi (State Bank), </span></span><span style="font-size:16px; color:#f8c001;">PNB Home Finance</span>, <span style="font-size:15px; color:#00529c;">LIC Housing</span>,  <span style="font-size:15px; color:#da251c;">Hdfc Ltd</span>,  <span style="font-size:15px; color:#ff6600;">ICICI</span>, <span style="font-size:15px; color:#a50032;">Axis Bank</span>, <span style="font-size:15px; color:#004e96;">Fedbank</span> & <span style="font-size:15px; color:#ec2028;">Citibank</span></div>


 </div>
 <div style="clear:both; height:4px;"></div>
 <div style="width:100%; max-width:622px;"> 
<div id="mysagscroller2" class="sagscroller" style="width:100%; max-width:622px;">
<ul>
<?php
$sql = "SELECT Company_Name, Net_Salary, City,City_Other FROM Req_Loan_Home WHERE Net_Salary >400000 AND Employment_Status =1 AND Allocated =1 and Company_Name!='' ORDER BY RequestID DESC  LIMIT 0 , 6";
	   	list($count,$query)=MainselectfuncNew($sql,$array = array());
	$final = '';
	$offers =array ("2 Offers", "3 Offers", "4 Offers", "2 Offers", "3 Offers", "4 Offers");
    for($i=0;$i<$count;$i++)
	{
		$Company_Name = $query[$i]['Company_Name'];
		$Net_Salary = $query[$i]['Net_Salary'];
		$City = $query[$i]['City'];
		if($City=="Others")
		{
			$City = $query[$i]['City_Other'];
		}
		
	
	?>
    	<li style="padding:2px;">An Employee of<strong><span style="color:#0f8eda;"> <?php echo $company; ?></span></strong> with Income <strong  style="color:#0f8eda;">Rs. <?php echo round($salary); ?></strong> of City <strong  style="color:#0f8eda;"><?php echo $city; ?> </strong>got <strong  style="color:#0f8eda;"><?php echo $offers[$i];?></strong><br /></li>

    <?php
	}

?>


	
	</ul>
</div>

</div>
 
 </div>
 <div class="left-new-wrapper"><div class="calci-wrapper" style="border:1px solid #666666;">
<table height="168" border="0" align="center" cellpadding="3" cellspacing="2">
<tr><td colspan="3" align="center"  style="color:#333333; font-weight:bold; font-size:16px; font-family:Arial, Helvetica, sans-serif;"><u>Sample Calcuator</u></td></tr>
<tr><td width="148" height="20" style="color:#333333; font-weight:bold; font-size:13px; font-family:Arial, Helvetica, sans-serif;"> Home Loan Amount </td>
<td width="95"><span style="font-weight:normal;">Rs.</span>
  <input type="text" value="0" name="amount_1a" id="amount_1a" size="11" onchange=" EMI_calc();" style="border:none; width:50px;"/></td>
<td width="77" style="color:#333333; font-weight:bold; font-size:10px; font-family:Arial, Helvetica, sans-serif;">Duration 20Yrs</td>
</tr>
<tr><td colspan="3" height="20"><div id="slider_la"></div></td></tr><tr><td height="20" colspan="3" style="color:#333333; font-weight:bold; font-size:13px; font-family:Arial, Helvetica, sans-serif;">Reduce the Interest rate to see savings<!--Interest Rate</td><td colspan="2" align="right"><input type="text" name="amount_intr1" id="amount_intr1" size="11" readonly="readonly" value="10.5" style="border:none; width:40px; text-align:right;"/> <span style="color:#333333; font-weight:bold; font-size:13px; font-family:Arial, Helvetica, sans-serif;">% Per Annum</span>--> </td></tr>
<tr><td colspan="3" height="52" valign="middle" style="background:url(new-images/bg-sliger.jpg) repeat;"><div id="slider_intr"></div></td><tr><td height="20" style="color:#333333; font-weight:bold; font-size:13px; font-family:Arial, Helvetica, sans-serif;" id="reducedLabel"><span></span></td><td colspan="2" align="right"><input type="text" value="0" name="amount_intr" id="amount_intr" size="11" readonly="readonly" onchange=" EMI_calc();"  style="border:none; width:40px; text-align:right"/> <span style="color:#333333; font-weight:bold; font-size:13px; font-family:Arial, Helvetica, sans-serif;" id="otherCalcVal"><span>% Per Annum</span></span> </td></tr>
<!--
<tr><td height="20" style="color:#333333; font-weight:bold; font-size:13px; font-family:Arial, Helvetica, sans-serif;">Duration</td><td colspan="2" align="left" style="color:#333333; font-weight:bold; font-size:13px; font-family:Arial, Helvetica, sans-serif;">20 Years</td><tr>-->
	    <td align="center" bgcolor="#88a943" class="font22"  style="color:#FFFFFF;" colspan="3" id="excess_amt_Label"><span>You will Save</span></td>
   </tr>
<tr>		<td align='center' bgcolor='#FFFFFF' class='font22' colspan="3" id="excess_Amount"><span>Rs. 80,335</span></td>
</tr>

</table>
</div>
<div style="clear:both;"></div>
<div class="right-panelnew2"><div class="hlb_why_tex_box"><div class="hlb_why_text">Why Deal4loans.com</div>
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

</div>
</div>


 </div>
<div style="clear:both;"></div>
<div class="hlb_text_section" style="margin-top:10px;">


</div>
  </div>
 </div>
 <div style="clear:both;"></div>
 <?php include 'footer_landingpage1.php'; ?>
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