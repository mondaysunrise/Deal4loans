<div class="pl_form_box"> 
  <!--<form name="carloan_form" method="post" action="/insert-car-loan-values.php" onSubmit="return chkcarloan(document.carloan_form);"> -->
  <?php 
  if($_REQUEST['source']=='HDFC_DEMO')
  {?>
   <form name="carloan_form" method="post" action="insert-car-loan-values080416.php" onSubmit="return chkcarloan(document.carloan_form);">
	 <?php 
  }else
  { 
  ?>
  <form name="carloan_form" method="post" action="insert-car-loan-values_090616.php" onSubmit="return chkcarloan(document.carloan_form);">
  <?php }?>
    <input type="hidden" name="PostURL" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
    <input type="hidden" name="Activate" id="Activate" >
    <input type="hidden" name="source" value="<? echo $retrivesource; ?>">
    <div style="clear:both;"></div>
    <div class="p-details">
      <h2 class="cl-h2-from"><?php echo GETQUOTEFOR;?> Car Loan</h2>
      <div style="clear:both; height:10px;"></div>
      <div><img src="images/carloan-animatedtext.gif" style="width:100%; max-width:575px;" /></div>
      </div>
    
    <div style="clear:both;"></div>
    <div class="p-details"><strong>Professional Details</strong></div>
    <div style="clear:both;"></div>
    <div class="new-input-box">
      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td height="25" class="cl-form-text">Loan Amount:</td>
        </tr>
        <tr>
          <td height="25"><input name="Loan_Amount" id="Loan_Amount" tabindex="1" type="text" class="d4l-input" maxlength="10" onFocus="this.select();" onChange="ShowHide('loanShow','Loan_Amount');"  onkeyup="intOnly(this);getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');"  onkeydown="getDigitToWords('Loan_Amount','formatedlA','wordloanAmount'); validateDiv('loanAmtVal');" onKeyPress="intOnly(this); getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" onBlur="getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" />
            <div id="loanAmtVal"></div></td>
        </tr>
        <tr>
          <td ><span id='formatedlA'></span><span id='wordloanAmount'></span></td>
        </tr>
      </table>
    </div>
    <div class="new-input-box">
      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td height="25" class="cl-form-text">Occupation:</td>
        </tr>
        <tr>
          <td height="25"><select   name="Employment_Status"  id="Employment_Status" class="d4l-select" tabindex="2"  onchange="validateDiv('empStatusVal');" >
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
          <td height="25" class="cl-form-text">Annual Income:</td>
        </tr>
        <tr>
          <td height="25"><input type="text" name="Net_Salary" id="Net_Salary" class="d4l-input" onKeyUp="intOnly(this); getDiToWordsIncome('Net_Salary','formatedIncome','wordIncome');" onKeyPress="intOnly(this);"  onblur="getDiToWordsIncome('Net_Salary','formatedIncome','wordIncome');"  onchange="ShowHide('incomeShow','Net_Salary');" tabindex="3" onkeydown="validateDiv('netSalaryVal');" />
            <div id="netSalaryVal"></div></td>
        </tr>
        <tr>
          <td><span id='formatedIncome'></span> <span id='wordIncome'></span></td>
        </tr>
      </table>
    </div>
    <div class="new-input-box">
      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td height="25" class="cl-form-text">City:</td>
        </tr>
        <tr>
          <td height="25" ><select name="City" id="City" class="d4l-select" onChange="addPersonalDetails(); addhdfclife(); validateDiv('cityVal');" tabindex="4">
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
<div class="cl_terms_box cl-form-text">
<input type="checkbox"  name="accept" style="border:none;"  >
        I Agree to&nbsp;<a href="/Privacy.php" target="_blank" rel="nofollow" style=" color:#fff; text-decoration:underline;">privacy policy</a> and&nbsp;<a href="/Privacy.php" target="_blank" rel="nofollow" style=" color:#fff; text-decoration:underline;">Terms and Conditions</a>.</div>
      <div class="cl_new_bnt_b">
        <input type="button" class="cl-get-quotebtn" value="Get Quote" onclick="return fornValidate(); ">
      </div>
    </div>
    
    <div id="personalDetails"></div>
  </form>
</div>
<div style="clear:both;"></div>