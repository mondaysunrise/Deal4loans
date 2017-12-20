<style type="text/css">
.lap-get-quotebtn {
    background: #06b2a0 !important;
    width: 110px;
    border: solid 2px #FFF !important;
    height: 39px;
    border-radius: 5px;
    color: #FFF;
    font-size:16px;
    margin-right:20px;
    margin-bottom:5px;}
	 .td-no-border{ border:none;}
</style>

<?php include "scripts/functions.php";?><link href="http://www.deal4loans.com/css/loan-against-property-styles.css" type="text/css" rel="stylesheet"  /><script src='http://www.deal4loans.com/js/loan-against-property-validates.js' type='text/javascript' language='javascript'></script><script type="text/javascript" src="http://www.deal4loans.com/scripts/common.js"></script><script src='http://www.deal4loans.com/scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script><div class="lap-form-wrapper" style="width:100%;"> <form name="loan_form" method="post" action="/apply-loan-against-property-continue.php" onSubmit="return chkform();">   <input type="hidden" name="Activate" id="Activate" ><?php  if($d4l_section=="Wordpress CMS"){ ?> <input type="hidden" name="source" value="SEO_D4L_<?php the_title(); ?>"><?php } else { ?>  <input type="hidden" name="source" value="<?php echo $retrivesource; ?>"><?php } ?> <div style="clear:both;"></div><h2 class="lap-h2" style="color:#FFF;"><?php echo $TagLine;?></h2><div id="imgDisplay"><img src="http://www.deal4loans.com/images/Loan-against-property-animatedtext.gif" style="width:100%; max-width:574px; width:23; margin-top:10px;"  /></div><div style="clear:both;"></div>
    <div class="p-details"><strong>Professional Details</strong></div>
    <div style="clear:both;"></div>
    <div class="new-input-box">
      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td height="25" class="lap-form-text td-no-border">Loan Amount:</td>
        </tr>
        <tr>
          <td height="25" class="td-no-border"><input name="Loan_Amount" id="Loan_Amount" tabindex="1" type="text" class="d4l-input" maxlength="10" onFocus="this.select();" onChange="ShowHide('loanShow','Loan_Amount');"  onkeyup="intOnly(this);getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');"  onkeydown="getDigitToWords('Loan_Amount','formatedlA','wordloanAmount'); validateDiv('loanAmtVal');" onKeyPress="intOnly(this); getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" onBlur="getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" autocomplete="off" />
            <div id="loanAmtVal"></div></td>
        </tr>
        <tr>
          <td  class="text td-no-border"><span id='formatedlA'></span><span id='wordloanAmount'></span></td>
        </tr>
      </table>
    </div>
    <div class="new-input-box">
      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td height="25" class="lap-form-text td-no-border">Occupation:</td>
        </tr>
        <tr>
          <td height="25" class="td-no-border"><select   name="Employment_Status"  id="Employment_Status" class="d4l-select" tabindex="2"  onchange="addSalaryText(this.value); validateDiv('empStatusVal');" >
              <option value="-1">Employment Status</option>
              <option value="1">Salaried</option>
              <option value="0">Self Employment</option>
            </select>
            <div id="empStatusVal"></div></td>
        </tr>
      </table>
    </div>
    <div class="new-input-box">
      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td height="25" class="td-no-border"><span class="lap-form-text " id="netSalText">Net Salary/Income <span style="font-size:14px; color:#FFF;">(Yearly/ITR)</span>:</span></td>
        </tr>
        <tr>
          <td height="25" class="td-no-border"><input type="text" name="Net_Salary" id="Net_Salary" class="d4l-input" onKeyUp="intOnly(this); getDiToWordsIncome('Net_Salary','formatedIncome','wordIncome');" onKeyPress="intOnly(this);"  onblur="getDiToWordsIncome('Net_Salary','formatedIncome','wordIncome');"  onchange="ShowHide('incomeShow','Net_Salary');" tabindex="3" onkeydown="validateDiv('netSalaryVal');" autocomplete="off" />
            <div id="netSalaryVal"></div></td>
        </tr>
        <tr>
          <td  class="formhlwpbody-text td-no-border"><span id='formatedIncome'></span> <span id='wordIncome'></span></td>
        </tr>
      </table>
    </div>
    <div class="new-input-box">
      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td height="25" class="td-no-border"><span class="lap-form-text">City:</span></td>
        </tr>
        <tr>
          <td height="25" class="td-no-border"><select name="City" id="City" class="d4l-select" onChange="addPersonalDetails(); addhdfclife(); validateDiv('cityVal');" tabindex="4">
              <?=plgetCityList($City)?>
              <option value="Vapi">Vapi</option>
              <option value="Ankleshwar">Ankleshwar</option>
              <option value="Anand">Anand</option>
              <option value="Anand">Dahod</option>
              <option value="Anand">Navsari</option>
            </select>
            <div id="cityVal"></div></td>
        </tr>
      </table>
    </div>
    <div style="clear:both;"></div>
    <div id="other_Details">
      <div style="height:15px;"></div>
      <div class="lap_terms_box">
        <input type="checkbox"  name="accept" style="border:none;" checked="checked" > I Agree to&nbsp;<a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow" style="text-decoration:underline;">privacy policy</a> and&nbsp;<a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow" style="text-decoration:underline;">Terms and Conditions</a>.</div>
      <div class="lap_bnt_b" style="margin-top:6px;">
        <input type="button" class="lap-get-quotebtn" value="Get Quote" onclick="return fornValidate(); "/>
      </div>
      <div style="height:15px;"></div>
    </div>
    <div style="clear:both;"></div>
    <div id="personalDetails"></div>
  </form>
</div>
<div style="clear:both;"></div>
