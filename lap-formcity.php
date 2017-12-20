<?php 
$_SERVER['REQUEST_URI'];
?>
  <form name="loan_form" method="post" action="/apply-loan-against-property-continue.php" onSubmit="return chkform();">
   <input type="hidden" name="Activate" id="Activate" >
<input type="hidden" name="source" value="<? echo $retrivesource; ?>">
<div style="clear:both;"></div> 
   <div class="lap_form_wrapper">
<div class="body_inner_tptxt"><h2 class="lap-h2-from">Apply for Best <?php echo $subjectLine; ?></h2></div>
<div class="body_inner2">Professional Details</div>
<div class="lap_input-box_wrapper">
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
<div class="lap_input-box_wrapper">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="24" class="frm_text_tp">Occupation:</td>
    </tr>
    <tr>
      <td>
        <select name="Employment_Status" id="Employment_Status" class="select_box_new" onchange="change_empstst();" tabindex="2">
       <option value="-1">Please Select</option>
<option value="1">Salaried</option>
<option value="0">Self Employed</option>
        </select>
        <div id="empStatusVal"></div>
     </td>
    </tr>
  </table>
</div>
<div class="lap_input-box_wrapper">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="24" class="frm_text_tp">City:</td>
    </tr>
    <tr>
      <td><select name="City" id="City" class="select_box_new" onchange="addhdfclife(); othercity1(); validateDiv('cityVal');" tabindex="3">
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
<div class="lap_input-box_wrapper">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="24" class="frm_text_tp">Annual Income:</td>
    </tr>
    <tr>
      <td><input type="text" class="iput_box_new" name="Net_Salary" id="Net_Salary" onkeyup="intOnly(this); getDiToWordsIncome('Net_Salary','formatedIncome','wordIncome');" onKeyPress=" addPersonalDetails(); intOnly(this); "  onblur="getDiToWordsIncome('Net_Salary','formatedIncome','wordIncome');"  onchange="ShowHide('incomeShow','Net_Salary'); addPersonalDetails();" onKeyDown="validateDiv('netSalaryVal');" tabindex="4"  autocomplete="off"/><div id="dialog-modal" > </div>
<div id="netSalaryVal"></div> <span id='formatedIncome'></span> <span id='wordIncome'></span></td>
    </tr>
  </table>
</div>



<div class="button_box_new" id="buttn_box">
  <input type="submit" name="Submit"  value="Get Quote" class="lap-get-quotebtn2" tabindex="16" />
</div>
<div style="clear:both;"></div><div class="lap_input-box_wrapper" id="otherCityName"></div>
<div style="clear:both;"></div>
<div id="personalDetails"></div>
<div style="clear:both; padding-top:10px;"></div>
<div id="hdfclife"></div>
<div style="clear:both;"></div>
</div>
 
 
</form>