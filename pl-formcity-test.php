<?php 
$_SERVER['REQUEST_URI'];

if($_SERVER['REQUEST_URI']=='/barclays-finance-personal-loan-eligibility.php')
{
	$newsource="BA SEO 1";
	$subjectLine="Personal Loan";
}
else if($_SERVER['REQUEST_URI']=='/citibank-personal-loan-eligibility.php')
{
	$newsource="Ci SEO 1";
	$subjectLine="Personal Loan";
}
else if($_SERVER['REQUEST_URI']=='/personal-loan-ing-vysya-bank.php')
{
	$newsource="ING Vysya SEO 1";
	$subjectLine="Personal Loan";
}
else if($_SERVER['REQUEST_URI']=='/personal-loan-axis-bank.php')
{
	$newsource="Axis SEO 1";
	$subjectLine="Personal Loan";
}
else if($_SERVER['REQUEST_URI']=='/personal-loan-interest-rate.php')
{
	$newsource="pl interest rate page";
	$subjectLine="Get Exact Quote on Personal Loan Interest Rates From all Banks";
}
?>
<script>

function addPersonalDetails()
{
	var ni1 = document.getElementById('personalDetails');
	var ni5 = document.getElementById('buttn_box');
	var ni2 = document.getElementById('Employment_Status').value;
	
if(ni2==0)
	{
		ni5.innerHTML="";
		ni1.innerHTML = '<div class="body_inner_tptxt"><table width="100%" border="0" cellpadding="0" cellspacing="0"><tr><td  align="left"><strong>Personal Details</strong></td></tr>   <tr>      <td  align="left"  style="font-size:14px;"><img src="http://www.deal4loans.com/images/security.png" width="14" height="16"> Your Information is secure with us and will not be shared without your consent</td>    </tr></table></div><div style="clear:both;"></div>    <div class="pl_input-box_wrapper2"><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td height="24" class="frm_text_tp">Full Name:</td></tr><tr><td><input name="Name" class="iput_box_new2" id="Name" type="text"  onKeyDown="validateDiv(\'nameVal\');" /><div id="nameVal"></div></td></tr></table></div><div class="pl_input-box_wrapper2"><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td height="24" class="frm_text_tp">Email ID :</td></tr><tr><td><input name="Email" id="Email" type="text" class="iput_box_new2" onKeyDown="validateDiv(\'emailVal\');"  /><div id="emailVal"></div></td></tr></table></div><div class="pl_input-box_wrapper2"><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td height="24" class="frm_text_tp">Mobile:</td></tr><tr><td class="frm_text_tp">+91<input name="Phone" id="Phone" maxlength="10" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)"; onChange="intOnly(this);" type="text" class="mob_iput_box_new2" onKeyDown="validateDiv(\'phoneVal\');"  /><div id="phoneVal"></div> </td></tr></table><div id="phoneVal"></div></div><div class="pl_input-box_wrapper2"><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td height="24" class="frm_text_tp">Age:</td></tr><tr><td><select onchange="validateDiv(\'AgeVal\');" class="select_box_new" name="Age" id="Age"><option value="">Select Age</option><?php for($a=18;$a<=65;$a++) {?><option value="<?php echo $a;?>"><?php echo $a;?></option><?php }?></select><div id="AgeVal"></div></td></tr></table></div>  <div style="clear:both;"></div>   <div class="pl_input-box_wrapper2" id="chnge_empstst">  <table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td height="24" class="frm_text_tp">Annual Turnover: </td></tr><tr><td><select name="Annual_Turnover" id="Annual_Turnover" class="select_box_new">		<option value="">Please Select</option>	<option value="1" > 0 - 40 Lacs</option>	<option value="4" > 40 Lacs - 1 Cr</option>		<option value="2" > 1Cr - 3Crs </option>	<option value="3" >3Crs & above</option></select>                        <div id="annualTurnoverVal"></div></td></tr></table></div><div class="pl_input-box_wrapper2"><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td height="24" class="frm_text_tp">Credit Card</td></tr><tr><td class="frm_text_tp"><input type="radio" name="CC_Holder" id="CC_Holder" value="1" onClick="return addIdentified();"  />Yes<input type="radio"  name="CC_Holder" id="CC_Holder" onClick="removeIdentified();" value="0" style="border:none;" checked="checked" />No</td></tr></table></div>	<div class="pl_input-box_wrapper" id="myDiv1"></div><div style="clear:both;"></div>  <div class="second_trm_box" style="font-size:14px; text-decoration:none; margin-top:4px;"><input name="accept" type="checkbox"  /> I authorize Deal4loans.com & its <a href="http://www.deal4loans.com/pl-partnering-banks.php" target="_blank" rel="nofollow">partnering banks</a> to contact me to explain the product & I Agree to <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow">Privacy policy</a> and <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow">Terms and Conditions</a>.<div id="acceptVal"></div></div>  <div class="second_btn_box">		<input type="submit" name="Submit" value="Get Quote" class="pl-get-quotebtn2" /></div>   <div style="clear:both;"></div>';
	}
	else
	{
		ni5.innerHTML="";
	ni1.innerHTML = '<div class="body_inner_tptxt"><table width="100%" border="0" cellpadding="0" cellspacing="0"><tr><td  align="left" ><strong>Personal Details</strong></td></tr>   <tr>      <td  align="left"  style="font-size:14px;"><img src="/images/security.png" width="14" height="16"> Your Information is secure with us and will not be shared without your consent</td>    </tr></table></div><div style="clear:both;"></div>    <div class="pl_input-box_wrapper2"><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td height="24" class="frm_text_tp">Full Name:</td></tr><tr><td><input name="Name" class="iput_box_new2" id="Name" type="text"  onKeyDown="validateDiv(\'nameVal\');" /><div id="nameVal"></div></td></tr></table></div><div class="pl_input-box_wrapper2"><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td height="24" class="frm_text_tp">Email ID :</td></tr><tr><td><input name="Email" id="Email" type="text" class="iput_box_new2" onKeyDown="validateDiv(\'emailVal\');"  /><div id="emailVal"></div></td></tr></table></div><div class="pl_input-box_wrapper2"><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td height="24" class="frm_text_tp">Mobile:</td></tr><tr><td class="frm_text_tp">+91<input name="Phone" id="Phone" maxlength="10" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)"; onChange="intOnly(this);" type="text" class="mob_iput_box_new2" onKeyDown="validateDiv(\'phoneVal\');"  /><div id="phoneVal"></div> </td></tr></table><div id="phoneVal"></div></div><div class="pl_input-box_wrapper2"><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td height="24" class="frm_text_tp">Age:</td></tr><tr><td><select onchange="validateDiv(\'AgeVal\');" class="select_box_new" name="Age" id="Age"><option value="">Select Age</option><?php for($a=18;$a<=65;$a++) {?><option value="<?php echo $a;?>"><?php echo $a;?></option><?php }?></select><div id="AgeVal"></div></td></tr></table></div><div style="clear:both;"></div> <div class="pl_input-box_wrapper2" id="chnge_empstst">  <table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td height="24" class="frm_text_tp">Company Name: </td></tr><tr><td><input name="Company_Name" id="Company_Name" type="text"  class="iput_box_new2" onKeyDown="validateDiv(\'companyNameVal\');" onKeyUp="ajax_showOptions(this,\'getCountriesByLetters\',event)"  onblur="onBlurDefault(this,\'Type slowly to autofill\');"  value="Type slowly to autofill" onfocus="onFocusBlank(this,\'Type slowly to autofill\');"/>                        <div id="companyNameVal"></div></td></tr></table></div><div class="pl_input-box_wrapper2"><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td height="24" class="frm_text_tp">Credit Card</td></tr><tr><td class="frm_text_tp"><input type="radio" name="CC_Holder" id="CC_Holder" value="1" onClick="return addIdentified();"  />Yes<input type="radio"  name="CC_Holder" id="CC_Holder" onClick="removeIdentified();" value="0" style="border:none;" checked="checked" />No</td></tr></table></div><div class="pl_input-box_wrapper2" id="myDiv1"></div><div style="clear:both;"></div>  <div class="second_trm_box" style="font-size:14px; color:#000; text-decoration:none; margin-top:4px;"><input name="accept" type="checkbox"  /> I authorize Deal4loans.com & its <a href="http://www.deal4loans.com/pl-partnering-banks.php" target="_blank" rel="nofollow"  style="font-size:14px; text-decoration:underline;">partnering banks</a> to contact me to explain the product & I Agree to <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow"  style="font-size:14px; text-decoration:underline;">Privacy policy</a> and <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow" style="font-size:14px; text-decoration:underline;">Terms and Conditions</a>.<div id="acceptVal"></div></div>  <div class="second_btn_box">	<input type="submit" name="Submit" value="Get Quote" class="pl-get-quotebtn2"  /> </div> <div style="clear:both;"></div>';
	}
	
}
	
	function othercity1()
{
//alert(document.personalloan_form.City.value);
	//var citydiv1 = document.getElementById('otherCityName');
	var citydiv2 = document.getElementById('otherCityName');
	if(document.loan_form.City.value=='Others')	
	{
//	alert(document.personalloan_form.City.value);
		citydiv2.innerHTML = '<table width="100%" border="0" cellspacing="0" cellpadding="0"><tr> <td height="24" class="frm_text_tp">Other City:</td></tr>    <tr>  <td>  <input type="text" class="iput_box_new" name="City_Other" id="City_Other" onKeyDown="validateDiv(\'othercityVal\');" tabindex="1"  autocomplete="off" /> </td></tr></table> <div id="othercityVal"></div>';	
	}
	else
	{
		citydiv2.innerHTML = '';
	}
}

$(function() {
	$("#IncomeAmount").focusout(function(){
			if($("#IncomeAmount").val()<=50000){

		var ai=$("#IncomeAmount").val();
	var mai= Math.round(ai/12);
		    $( "#dialog-modal" ).dialog({
			title:"You Have Indicated Your Annual Income Is 'Rs. " + ai + "' which is 'Rs." + mai + "' per month. If correct Continue or Edit Annual Income to get Right Quote",
            height: 0,
            modal: true
        });
			//$("#IncomeAmount").val().focus();
		}
		});
    });

</script>
<form name="loan_form" method="post" action="/insert_personal_loan_value_step1.php" onSubmit="return chkpersonalloan();">
<input type="hidden" name="Type_Loan" value="Req_Loan_Personal">
<input type="hidden" name="creative" value="<? echo $_REQUEST['creative'] ?>">
<input type="hidden" name="section" value="<? echo $_REQUEST['section'] ?>">
<input type="hidden" name="referrer" value="<? echo $_REQUEST['referrer'] ?>"> 
<input type="hidden" name="Activate" id="Activate" >
<input type="hidden" name="PostURL" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
<input type="hidden" name="source" value="<? echo $newsource; ?>">
<div style="clear:both;"></div> 
   <div class="pl-form-wrapper">
<div class="body_inner_tptxt" style="width:99% !important;"><div style="float:left; margin-left:10px; margin-top:10px;"><? 
if((strlen(strpos($_SERVER['REQUEST_URI'], "/personal-loan/")) > 0)) { ?>
Get instant lowest quote on Personal loan in <?php echo $City; ?> from top 10 Banks
<? }
else 
{ ?>
Get instant lowest quote on Personal loan in <?php echo $City; ?> from top 10 Banks
<? } ?></div><div style="margin-left:10px; margin-top:10px; float:left;"><a href="https://www.deal4loans.com/lowestratequote.php" style="text-decoration:none;" target="_blank"><img src="/new-images/personal-loans.jpg" width="203" height="58" border="0" /></a></div> <div style="clear:both !important;"></div> </div>
<div class="body_inner2"><strong>Professional Details</strong></div>
<div class="pl_input-box_wrapper">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="24" class="frm_text_tp">Loan Amount:</td>
    </tr>
    <tr>
      <td>
        <input type="text" class="iput_box_new" name="Loan_Amount" id="Loan_Amount" onKeyPress="intOnly(this);" onKeyUp="intOnly(this); getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');"  onblur="getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" onKeyDown="validateDiv('loanAmtVal');" tabindex="1"  autocomplete="off" />
		<div id="loanAmtVal"></div><span id='formatedlA'></span><span id='wordloanAmount'></span>
     </td>
    </tr>
  </table>
</div>
<div class="pl_input-box_wrapper">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="24" class="frm_text_tp">Occupation:</td>
    </tr>
    <tr>
      <td>
        <select name="Employment_Status" id="Employment_Status" class="select_box_new" onchange="validateDiv('empStatusVal');change_empstst();">
       <option value="-1">Please Select</option>
<option value="1">Salaried</option>
<option value="0">Self Employed</option>
        </select>
        <div id="empStatusVal"></div>
     </td>
    </tr>
  </table>
</div>
<div class="pl_input-box_wrapper">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="24" class="frm_text_tp">City:</td>
    </tr>
    <tr>
      <td><select name="City" id="City" class="select_box_new" onchange=" othercity1(); addhdfclife(); validateDiv('cityVal');">
       <?=plgetCityList($City)?>
<option value="Vapi">Vapi</option>
<option value="Ankleshwar">Ankleshwar</option>
<option value="Anand">Anand</option>
<option value="Anand">Dahod</option>
<option value="Anand">Navsari</option>
      </select><div id="cityVal"></div></td>
    </tr>
  </table>
</div>
<div class="pl_input-box_wrapper">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="24" class="frm_text_tp">Annual Income:</td>
    </tr>
    <tr>
      <td><input type="text" class="iput_box_new" name="IncomeAmount" id="IncomeAmount" onkeyup="intOnly(this); getDigitToWords('IncomeAmount','formatedIncome','wordIncome');" onKeyPress=" addPersonalDetails(); intOnly(this); "  onblur="getDigitToWords('IncomeAmount','formatedIncome','wordIncome');"  onchange="ShowHide('incomeShow','IncomeAmount'); addPersonalDetails();" onKeyDown="validateDiv('netSalaryVal');" tabindex="4"  autocomplete="off"/><div id="dialog-modal" > </div>
<div id="netSalaryVal"></div> <span id='formatedIncome'></span> <span id='wordIncome'></span></td>
    </tr>
  </table>
</div>



<div class="button_box_new" id="buttn_box">
  <input type="submit" name="Submit" class="pl-get-quotebtn2" value="Get Quote"/>
</div>
<div style="clear:both;"></div><div class="pl_input-box_wrapper" id="otherCityName"></div>
<div style="clear:both;"></div>
<div style="width:100%; padding-left:12px;" id="personalDetails"></div>
<div style="clear:both; padding-top:10px;"></div>
<div id="hdfclife"></div>
<div style="clear:both;"></div>
</div>
 
 
</form>