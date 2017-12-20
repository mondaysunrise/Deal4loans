<?php
require 'scripts/functions.php';
$TagLine="Apply Online for IndusInd Bank Personal loan with Lowest Interest Rates";
?><script type="text/javascript" src="http://www.deal4loans.com/loans-validate-personal-loan.js"></script><script type="text/javascript" src="/ajax.js"></script><script type="text/javascript" src="/ajax-dynamic-pllist.js"></script><script type="text/javascript" src="/scripts/common.js"></script><script src="/scripts/digitToWordConvert.js" type="text/javascript" language="javascript"></script><br><style>#ajax_listOfOptions{position:absolute;width:250px;height:160px;overflow:auto;border:1px solid #317082;background-color:#FFF;color:#000;font-family:Verdana, Arial, Helvetica, sans-serif;text-align:left;font-size:10px;z-index:50}#ajax_listOfOptions div{cursor:pointer;font-size:10px;margin:1px;padding:1px}#ajax_listOfOptions .optionDivSelected{background-color:#2375CB;color:#FFF}#ajax_listOfOptions_iframe{background-color:red;position:relative;z-index:5}
.pl-form-wrapper{ text-align:left !important; color:#000 !important;}
.pl-h2 {
    font-family: "Droid Sans",sans-serif;
    font-size: 22px;
    font-weight: normal;
    margin: 0;
    padding: 5px 0 0;
	color:#000 !important;}
	#personalDetails{ text-align:left !important; }
	.pl-get-quotebtn{ float:right !important;}
</style>
<link href="/css/personal-loan-styles.css" type="text/css" rel="stylesheet" /><div class="pl-form-wrapper" style="float:none !important; margin:auto;">  <form name="personalloan_form"  action="/insert_personal_loan_value_step1.php" method="POST" onSubmit="return chkpersonalloan(document.personalloan_form);">   <input type="hidden" name="Type_Loan" value="<?php echo $TypeLoan;?>" />    <input type="hidden" name="source" value="<?php echo $source;?>" />    <input type="hidden" name="PostURL" value="<?php echo $PostURL;?>" />    <div class="p-details">      <div class="form-headline-wrapper"><strong  style=" text-transform:none;">        <h2 class="pl-h2"><?php echo $TagLine;?></h2>        </strong></div>
      <div class="from-ad"><a href="http://www.deal4loans.com/lowestratequote.php" style="text-decoration:none;" target="_blank"><img src="/new-images/personal-loans.jpg" width="203" height="58" border="0" /></a></div>
    </div>
    <div style="clear:both; height:10px"></div>
    <div class="p-details" style="text-align:left !important;"><strong>Professional Details</strong></div>
    <div style="clear:both;"></div>
    <div class="new-input-box">
      <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td height="25">Loan Amount:</td>
        </tr>
        <tr>
          <td height="25"><input name="Loan_Amount" id="Loan_Amount" maxlength="8" onKeyPress="intOnly(this);" onKeyUp="intOnly(this); getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');"  onblur="getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');"  type="text" class="d4l-input"  onkeydown="validateDiv('loanAmtVal');"  autocomplete="off" />
            <div id="loanAmtVal"></div>
            <span id='formatedlA'></span><span id='wordloanAmount'></span></td>
        </tr>
      </table>
      
      
    </div>
    <div class="new-input-box">
      <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td height="25">Occupation :</td>
        </tr>
        <tr>
          <td height="25"><select  name="Employment_Status" class="d4l-select" id="Employment_Status" onChange="change_empstst(); validateDiv('empStatusVal');" tabindex="2">
              <option selected="selected" value="-1">Employment Status</option>
              <option  value="1">Salaried</option>
              <option value="0">Self Employed</option>
            </select>
            <div id="empStatusVal" class="alert_msg"></div></td>
        </tr>
         <tr>
          <td id="chnge_empststName"></td>
        </tr>
        <tr>
          <td id="chnge_empststVal"></td>
        </tr>
      </table>
    </div>
    <div class="new-input-box">
      <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td height="25">Annual Income: </td>
        </tr>
        <tr>
          <td height="25"><input type="text" name="IncomeAmount" id="IncomeAmount" class="d4l-input"  onkeyup="intOnly(this); getDiToWordsIncome('IncomeAmount','formatedIncome','wordIncome');" onKeyPress="intOnly(this);"  onblur="getDiToWordsIncome('IncomeAmount','formatedIncome','wordIncome');"  onchange="ShowHide('incomeShow','IncomeAmount');" onKeyDown="validateDiv('netSalaryVal');" autocomplete="off" />
            <div id="dialog-modal" > </div>
            <div id="netSalaryVal"></div>
            <span id='formatedIncome'></span> <span id='wordIncome'></span></td>
        </tr>
      </table>
    </div>
    <div class="new-input-box">
      <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td height="25">City:</td>
        </tr>
        <tr>
          <td height="25"><select name="City" id="City" class="d4l-select" onChange="addPersonalDetails(); othercity1(); addhdfclife(); validateDiv('cityVal');" tabindex="7">
              <?=plgetCityList($City)?>
            </select>
            <div id="cityVal"></div>
            <div style="padding-top:10px">
      <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td height="25" align="right" id="otherCityName"></td>
        </tr>
      </table>
    </div>
            </td>
              
        </tr>
      </table>
    </div>
    <div style="clear:both;"></div>
    <div id="personalDetails">
      <table width="98%" cellpadding="0" cellspacing="0">
        <tr>
          <td align="right"> <input type="button" class="pl-get-quotebtn" value="Get Quote" onclick="return fornValidate(); "/></td>
        </tr>
      </table>
    </div>
    <div style="clear:both;"></div>
    <div id="addSubmit"></div>
  </form>
  <div style="clear:both;"></div>
</div>
<div style="clear:both;"></div>
