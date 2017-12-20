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
?>
<script>
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
<style>
.ui-dialog { position: absolute; padding: .2em; width: 700px; overflow: hidden; z-index:1001;}
.ui-dialog .ui-dialog-titlebar { padding: .4em 1em; position: relative;  }
.ui-dialog .ui-dialog-title { float: left; margin: .1em 16px .1em 0; font-size:11px; line-height:18px;}
.ui-dialog .ui-dialog-titlebar-close { position: absolute; right: .3em; top: 50%; width: 19px; margin: -10px 0 0 0; padding: 1px; height: 18px; }
.ui-dialog .ui-dialog-titlebar-close span { display: block; margin: 1px; }
.ui-dialog .ui-dialog-titlebar-close:hover, .ui-dialog .ui-dialog-titlebar-close:focus { padding: 0; }
.ui-dialog .ui-dialog-buttonpane { text-align: left; border-width: 1px 0 0 0; background-image: none; margin: .5em 0 0 0; padding: .3em 1em .5em .4em; }
.ui-dialog .ui-dialog-buttonpane .ui-dialog-buttonset { float: right; }
.ui-dialog .ui-dialog-buttonpane button { margin: .5em .4em .5em 0; cursor: pointer; }
.ui-dialog .ui-resizable-se { width: 14px; height: 14px; right: 3px; bottom: 3px; }
.ui-draggable .ui-dialog-titlebar { cursor: move; }
</style>
<form name="loan_form" method="post" action="/insert_personal_loan_value_step1.php" onSubmit="return chkpersonalloan();">
<input type="hidden" name="Type_Loan" value="Req_Loan_Personal">
<input type="hidden" name="creative" value="<? echo $_REQUEST['creative'] ?>">
<input type="hidden" name="section" value="<? echo $_REQUEST['section'] ?>">
<input type="hidden" name="referrer" value="<? echo $_REQUEST['referrer'] ?>"> 
<input type="hidden" name="Activate" id="Activate" >
<input type="hidden" name="PostURL" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
<input type="hidden" name="source" value="<? echo $newsource; ?>">


<div class="hl_emi_cal_form">
<div class="pl_emi_cal_text">
<? if($_SERVER['REQUEST_URI']=='/personal-loan-emi-calculator.php' || $_SERVER['REQUEST_URI']=='/personal-loan-emi-calculator1.php'  || $_SERVER['REQUEST_URI']=='/deals/personal-loan-emi-calculator1.php') { ?>
<h2 class="text3" style=" color:#FFF; font-size:20px; text-transform:none; "><strong><?php echo $subjectLine; ?></strong></h2>
<? }
else if($_SERVER['REQUEST_URI']=='/personal-loan-sbi.php') { ?>
<h2 class="text3" style=" color:#FFF; font-size:20px; text-transform:none; "><strong><?php echo $subjectLine; ?></strong></h2>
<? }
else 
{ ?>
<h2 class="text3" style=" color:#FFF; font-size:20px; text-transform:none;"><strong>Compare <?php echo $subjectLine; ?>| Interest Rates | Eligibility</strong></h2>
<? } ?></div>

<div class="pl_emi_cal_blink_b"><img src="http://www.deal4loans.com/images/animated_pl.gif"></div>
<div style="clear:both;"></div> 
  <div class="hl_emi_input_form">
    <table width="98%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td height="30"><span class="text" style=" float:left; width:183px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Full Name:</span></td>
      </tr>
      <tr>
        <td height="30"><input name="Name" class="hl_emi_input" id="Name" type="text"  onKeyDown="validateDiv('nameVal');" />
<div id="nameVal"></div>  </td>
      </tr>
      <tr>
        <td height="30"><span class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">DOB:</span></td>
      </tr>
      <tr>
        <td height="30"><input name="day" id="day" type="text" class="hl_emi_dd" value="dd" onBlur="onBlurDefault(this,'dd');" onFocus="onFocusBlank(this,'dd');" maxlength="2" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" onKeyDown="validateDiv('dobVal');" />
        <input name="month" id="month" type="text" class="hl_emi_dd" value="mm" onBlur="onBlurDefault(this,'mm');" onFocus="onFocusBlank(this,'mm');" maxlength="2" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" onKeyDown="validateDiv('dobVal');" />
        
        <input name="year" id="year" type="text" class="hl_emi_yy" value="yyyy" onBlur="onBlurDefault(this,'yyyy');" onFocus="onFocusBlank(this,'yyyy');" maxlength="4" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" onKeyDown="validateDiv('dobVal');" />
       <div id="dobVal"></div>  
        </td>
      </tr>
      <tr>
        <td height="30" style="color:#FFF;"><span class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Mobile:</span></td>
      </tr>
      <tr>
        <td height="30" style="color:#FFF;"><em>+91</em>
          <input name="Phone" id="Phone" maxlength="10" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)"; onChange="intOnly(this);" type="text" class="hl_emi_mob_input" onKeyDown="validateDiv('phoneVal');"  />
<div id="phoneVal"></div> </td>
      </tr>
    </table>
  </div>
    <div class="hl_emi_input_form">
      <table width="98%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td height="30"><span class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">City:</span></td>
        </tr>
        <tr>
          <td height="30"><select name="City" id="City" class="hl_emi_select" style=" font-family:Verdana, Geneva, sans-serif; font-size:11px; color:#4c4c4c;"  onchange="othercity1(); addhdfclife(); validateDiv('cityVal');" tabindex="7">
<?=plgetCityList($City)?>
<option value="Vapi">Vapi</option>
<option value="Ankleshwar">Ankleshwar</option>
<option value="Anand">Anand</option>
<option value="Anand">Dahod</option>
<option value="Anand">Navsari</option>
</select>
<div id="cityVal"></div>   </td>
        </tr>
        <tr>
          <td height="30"><span class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Other City:</span></td>
        </tr>
        <tr>
          <td height="30"><input name="City_Other" id="City_Other" type="text" class="hl_emi_input" disabled onKeyUp="searchSuggest();" onKeyDown="validateDiv('othercityVal');"  />
<div id="othercityVal"></div>   </td>
        </tr>
        <tr>
          <td height="30"><span class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Email ID :</span></td>
        </tr>
        <tr>
          <td height="30"><input name="Email" id="Email" type="text" class="hl_emi_input" onKeyDown="validateDiv('emailVal');"  />
<div id="emailVal"></div> </td>
        </tr>
      </table>
    </div>
      <div class="hl_emi_input_form">
        <table width="98%" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td height="30"><span class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Pincode:</span></td>
          </tr>
          <tr>
            <td height="30"><input name="Pincode" id="Pincode" maxlength="6" onKeyPress="intOnly(this);" onKeyUp="intOnly(this);"  onkeydown="validateDiv('pincodeVal');" type="text" class="hl_emi_input" />
<div id="pincodeVal"></div></td>
          </tr>
          <tr>
            <td height="30"><span class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Occupation: </span></td>
          </tr>
          <tr>
            <td height="30"><select name="Employment_Status" id="Employment_Status"  onchange="change_empstst(); validateDiv('empStatusVal');" class="hl_emi_select"  style="font-family:Verdana, Geneva, sans-serif; font-size:11px; color:#4c4c4c;" >
<option value="-1">Please Select</option>
<option value="1">Salaried</option>
<option value="0">Self Employed</option>
</select>
<div id="empStatusVal"></div></td>
          </tr>
          <tr>
		  <td colspan="2"><div id="chnge_empstst"><table cellpadding="0" cellspacing="0"><tr>
            <td height="30"><span class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Company Name: </span></td>
          </tr>
          <tr>
            <td height="30"><input name="Company_Name" id="Company_Name" type="text"  class="hl_emi_input" onKeyDown="validateDiv('companyNameVal');" onKeyUp="ajax_showOptions(this,'getCountriesByLetters',event)"  onblur="onBlurDefault(this,'Type slowly to autofill');"  value="Type slowly to autofill" onfocus="onFocusBlank(this,'Type slowly to autofill');"/>
<div id="companyNameVal"></div></td></tr></table><div></td>
          </tr>
        </table>
      </div>
        <div class="hl_emi_input_form">
          <table width="98%" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td height="30" colspan="2"><span class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Annual Income:</span></td>
            </tr>
            <tr>
              <td height="30" colspan="2"><input type="text" name="IncomeAmount" id="IncomeAmount" class="hl_emi_input"  onkeyup="intOnly(this); getDigitToWords('IncomeAmount','formatedIncome','wordIncome');" onKeyPress="intOnly(this);"  onblur="getDigitToWords('IncomeAmount','formatedIncome','wordIncome');"  onchange="ShowHide('incomeShow','IncomeAmount');" onKeyDown="validateDiv('netSalaryVal');"  />
<div id="dialog-modal" > </div>
<div id="netSalaryVal"></div> <span id='formatedIncome' style='font-size:11px;
font-weight:normal; color:#ffffff;font-Family:Verdana;'></span> <span id='wordIncome' style='font-size:11px;
font-weight:normal; color:#ffffff;font-Family:Verdana;text-transform: capitalize;'></span>   </td>
            </tr>
            <tr>
              <td height="25" colspan="2"><span class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Loan Amount:</span></td>
            </tr>
            <tr>
              <td height="50" colspan="2"><input name="Loan_Amount" id="Loan_Amount" maxlength="8" onKeyPress="intOnly(this);" onKeyUp="intOnly(this); getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');"  onblur="getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');"  type="text" class="hl_emi_input" onKeyDown="validateDiv('loanAmtVal');" />
<div id="loanAmtVal"></div><span id='formatedlA' style='font-size:11px;
font-weight:normal; color:#ffffff;font-Family:Verdana;'></span><span id='wordloanAmount' style='font-size:11px;
font-weight:normal; color:#ffffff;font-Family:Verdana;text-transform: capitalize;'></span></td>
            </tr>
            <tr>
              <td width="35%" height="58"><span class="text" style=" float:left;  height:auto; color:#FFF; font-size:12px; text-transform:none;">Credit Card</span></td>
              <td width="65%" style="color:#FFFFFF;"><input type="radio" name="CC_Holder" id="CC_Holder" value="1" onClick="return addIdentified();" style="border:none;" />
                <em>                yes</em> 
                <input type="radio"  name="CC_Holder" id="CC_Holder" onClick="removeIdentified();" value="0" style="border:none;" checked="checked" /> 
                <em>No              </em></td>
            </tr>
            <tr><td colspan="2" id="myDiv1" ></td></tr>
          </table>
        </div>
        <div style="clear:both;"></div>
      
  <div class="hl_emi_term_box"><input name="accept" type="checkbox"  /> I authorize Deal4loans.com &amp; its <a href="http://www.deal4loans.com/pl-partnering-banks.php" target="_blank" rel="nofollow"  class="text" style=" color:#88a943; font-size:11px; text-decoration:underline;">partnering banks</a> to contact me to explain the product &amp; I Agree to&nbsp;<a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow"  class="text" style=" color:#88a943; font-size:11px; text-decoration:underline;">privacy policy</a> and&nbsp;<a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow"  class="text" style=" color:#88a943; font-size:11px; text-decoration:underline;">Terms and Conditions</a>.<div id="acceptVal"></div></div>
  <div class="hl_emi_get_quote"><input type="submit" style="border: 0px none ; background-image: url(images/get1.gif); width: 114px; height: 52px; margin-bottom: 0px;" value=""/></div>
   <div style="clear:both;"></div>
    <div id="hdfclife"></div>
  </div></form>














