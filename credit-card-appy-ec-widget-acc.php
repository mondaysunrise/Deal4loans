<div class="mobile-form-left">
  <div class="head_2 heading-margin-bottom">Professional Details</div>
  <div class="product-listing-new"> </div>
  <div style="clear:both;"></div>
  <form  name="creditcard_form" id="creditcard_form" action="get_cc_eligiblebank_under.php" method="post" onSubmit="return ckhcreditcard(document.creditcard_form); " >
  <input type="hidden" name="Activate" id="Activate" >
  <input type="hidden" name="source" value="<? echo $retrivesource; ?>">
    <div class="annual-income-ui-input-wrapper">
      <input name="Net_Salary" type="text" class="annual-income-ui-input rupee-icon" placeholder="Annual Income" id="Net_Salary" onkeyup="intOnly(this); getDiToWordsIncome('Net_Salary','formatedIncome','wordIncome');" onkeypress="intOnly(this);"  onblur="getDiToWordsIncome('Net_Salary','formatedIncome','wordIncome');"  onchange="ShowHide('incomeShow','Net_Salary');" onkeydown="validateDiv('netSalaryVal');" autocomplete="off">
      <div id="netSalaryVal"></div>
      <span id='formatedIncome'></span> <span id='wordIncome'></span> </div>
    <div class="annual-income-ui-input-wrapper margin-a-left">
      <select class="annual-income-ui-input occupation-icon" name="Employment_Status" id="Employment_Status"  onchange="validateDiv('empStatusVal');">
        <option value="-1">Please Select</option>
        <option value="1">Salaried</option>
        <option value="0">Self Employed</option>
      </select>
      <div id="empStatusVal" class="alert_msg"></div>
    </div>
    <div class="annual-income-ui-input-wrapper margin-a-left">
      <input id="City" class="mobile-ui-input input-bottom-margin location-icon" onKeyPress="return CharsetKeyOnly(event);" placeholder="Type Your City Name" name="City"  onKeyDown="validateDiv('cityVal');"  />
      <div id="cityVal" class="alert_msg"></div>
    </div>
       <div style="clear:both;"></div>
    <div id="CompDetail" style="display:none;">
    <input name="Company_Name" id="Company_Name" type="text" class="mobile-ui-input input-bottom-margin company-icon" placeholder="Type your company name" onkeydown="validateDiv('companyNameVal');" onkeyup="ajax_showOptions(this,'getCountriesByLetters',event)"  onblur="onBlurDefault(this,'Type Slowly for Autofill');" onfocus="onFocusBlank(this,'Type Slowly for Autofill');">
    <div id="companyNameVal"></div>
    
    <hr>
    <div style="clear:both;"></div>
    <div class="head_2">Personal Details</div>
    <p class="smalltext"><img src="ccmobile/images/privacy-lock.png" width="9" height="10" alt="lock"> Your Information is secure with us and will not be shared without your consent</p>
    <div style="clear:both;"></div>
    <div class="mobile-ui-input input-bottom-margin dob-icon">
      <div class="dobtext">Date of Birth</div>
      <div class="dobwrapper">
        <select name="day" id="day" class="dobselect" onchange="validateDiv('dayVal');">
          <option value="">DD</option>
          <option value="01">01</option>
          <option value="02">02</option>
          <option value="03">03</option>
          <option value="04">04</option>
          <option value="05">05</option>
          <option value="06">06</option>
          <option value="07">07</option>
          <option value="08">08</option>
          <option value="09">09</option>
          <option value="10">10</option>
          <option value="11">11</option>
          <option value="12">12</option>
          <option value="13">13</option>
          <option value="14">14</option>
          <option value="15">15</option>
          <option value="16">16</option>
          <option value="17">17</option>
          <option value="18">18</option>
          <option value="19">19</option>
          <option value="20">20</option>
          <option value="21">21</option>
          <option value="22">22</option>
          <option value="23">23</option>
          <option value="24">24</option>
          <option value="25">25</option>
          <option value="26">26</option>
          <option value="27">27</option>
          <option value="28">28</option>
          <option value="29">29</option>
          <option value="30">30</option>
          <option value="31">31</option>
        
        </select>
        <select name="month" id="month" class="dobselect" onchange="validateDiv('monthVal');">
          <option value="">MM</option>
          <option value="01">01</option>
          <option value="02">02</option>
          <option value="03">03</option>
          <option value="04">04</option>
          <option value="05">05</option>
          <option value="06">06</option>
          <option value="07">07</option>
          <option value="08">08</option>
          <option value="09">09</option>
          <option value="10">10</option>
          <option value="11">11</option>
          <option value="12">12</option>
        </select>
        <select name="year" id="year" class="dobselect" onchange="validateDiv('yearVal'); showhidePersonalDetails(event)">
          <option value="">YYYY</option>
          <?php for($y=1995; $y>=1950; $y--) {?>
          <option value="<?php echo $y;?>"><?php echo $y;?></option>
          <?php }?>
        </select>
        <div id="dayVal"></div>
        <div id="monthVal"></div>
        <div id="yearVal"></div>
      </div>
      <div style="clear:both;"></div>
    </div>
    </div>
    <div>
    <div style="clear:both;"></div>
    <span id="PersonalDetail" style="display:none;">
    <input name="Full_Name" id="Full_Name" type="text" class="mobile-ui-input man-icon input-bottom-margin"  placeholder="Your Name" onKeyPress="return isCharsetKey(event);" onkeydown="validateDiv('nameVal');">
    <div id="nameVal"></div>
    <div style="clear:both;"></div>
    <input name="Phone" id="Phone" type="text" class="mobile-ui-input input-bottom-margin mobile-icon" maxlength="10" onkeyup="intOnly(this);" onkeypress="intOnly(this)" ;="" onchange="intOnly(this);" placeholder="Mobile Number" onkeydown="validateDiv('phoneVal');">
    <div id="phoneVal"></div>
    <div style="clear:both;"></div>
    <input name="Email" id="Email" type="text" class="mobile-ui-input input-bottom-margin email-icon" placeholder="Email Id" onkeydown="validateDiv('emailVal');" />
    <div id="emailVal"></div>
    <div style="clear:both;"></div>
    <div class="credit-cardbox"> <strong>Credit Card Holder?</strong>
      <div class="form-required">
        <label for="radio-one">
          <input type="radio" name="CC_Holder" id="radio-one" value="1" onclick="addElement(this.value);" />
          <i></i> <span>Yes</span> </label>
        <label for="radio-two">
          <input type="radio" name="CC_Holder" id="radio-two" value="2" onclick="removeElement(this.value);"/>
          <i></i> <span>No</span> </label>
      </div>
    </div>
    <div id="NmBank" style="display:none; margin-top:20px;" class="annual-income-ui-input-wrapper">
      <select class="annual-income-ui-input bank-icon" name="No_of_Banks" id="No_of_Banks"  onchange="validateDiv('NumOfBankVal');">
        <option value="">Please Select</option>
        <option value="HDFC Bank">HDFC Bank</option>
        <option value="Standard Chartered">Standard Chartered</option>
        <option value="Kotak Bank">Kotak Bank</option>
        <option value="RBL Bank">RBL Bank</option>
        <option value="ICICI Bank">ICICI Bank</option>
        <option value="Other">Other</option>
      </select>
      <div id="NumOfBankVal"></div>
    </div>
    <div class="credit-cardbox" id="loanrunning" style="display:none;"> <strong>Are you running any loan?</strong>
      <div class="form-required">
        <label for="radio-loans-one">
          <input type="radio" name="loanrunning" id="radio-loans-one" value="3"/>
          <i></i> <span>Yes</span> </label>
        <label for="radio-loans-two">
          <input type="radio" name="loanrunning" id="radio-loans-two" value="4"/>
          <i></i> <span>No</span> </label>
      </div>
    </div>
    <div style="clear:both;"></div>
    <span class="t-and-c-text"><span class="t-and-c-text">
    <label for="check-one">
      <input type="checkbox" name="accept" id="check-one" value="checkone" onClick="validateDiv('acceptVal');" />
      <i></i> <span>I authorize Deal4loans.com & its partnering banks to contact me to explain the product & I Agree to Privacy policy and Terms and Conditions.</span> </label>
    <div id="acceptVal"></div>
    </span></span>
    </span>
    <div style="clear:both; margin-top:15px;"></div>
    <input class="submit-btn" type="submit" value="Get Quote Now!" onclick="return fornValidate();">
  </form>
</div>

