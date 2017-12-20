<div class="credit-card-form-wrapper">
 <h3>Apply Online for Best Credit Cards through Deal4loans.com</h3>
    <div class="h2-from">Professional Details</div>
    <form  name="creditcard_form" id="creditcard_form" action="get_cc_eligiblebank_under.php" method="post" onSubmit="return ckhcreditcard(document.creditcard_form); " >
      <input type="hidden" name="Activate" id="Activate" >
      <input type="hidden" name="source" value="<? echo $retrivesource; ?>">
      <div class="new-input-box">
        <table width="98%" border="0" cellpadding="0" cellspacing="0">
          <tbody>
            <tr>
              <td height="25" class="edu-form-text">Annual Income</td>
            </tr>
            <tr>
              <td height="30"><input name="Net_Salary" type="text" class="d4l-input" placeholder="Annual Income" id="Net_Salary" onkeyup="intOnly(this); getDiToWordsIncome('Net_Salary','formatedIncome','wordIncome');" onkeypress="intOnly(this);"  onblur="getDiToWordsIncome('Net_Salary','formatedIncome','wordIncome');" onkeydown="validateDiv('netSalaryVal');" autocomplete="off">
                <div id="netSalaryVal"></div>
                <span id='formatedIncome'></span> <span id='wordIncome'></span></td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="new-input-box">
        <table width="98%" border="0" cellpadding="0" cellspacing="0">
          <tbody>
            <tr>
              <td height="25" class="edu-form-text">Occupation</td>
            </tr>
            <tr>
              <td height="30"><select class="d4l-select" name="Employment_Status" id="Employment_Status"  onchange="validateDiv('empStatusVal');">
                  <option value="-1">Please Select</option>
                  <option value="1">Salaried</option>
                  <option value="0">Self Employed</option>
                </select>
                <div id="empStatusVal" class="alert_msg"></div></td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="new-input-box">
        <table width="98%" border="0" cellpadding="0" cellspacing="0">
          <tbody>
            <tr>
              <td height="25" class="edu-form-text">City</td>
            </tr>
            <tr>
              <td height="30"><select class="d4l-select" name="City" id="City"  onchange="changeCityVal(event); validateDiv('cityVal'); addothercity();">
               <option value="">Please Select</option>
		 <?php 
		$getcitySql = "SELECT * FROM creditcard_citylist WHERE status=1 GROUP BY cityname order by id";
		list($numRowscity,$getcityQuery)=MainselectfuncNew($getcitySql,$array = array());
		for($cN=0;$cN<$numRowscity;$cN++)
		{
		$cityname = ucwords(strtolower($getcityQuery[$cN]['cityname']));
		$cityalias =ucwords(strtolower($getcityQuery[$cN]['cityalias']));
		?>
			  <option value="<?php if(strlen($cityalias)>2) { echo $cityalias; } else { echo $cityname; } ?>"><?php if(strlen($cityalias)>2) { echo $cityalias; } else { echo $cityname; } ?></option>
			  <?php
		}
		?>
		<option value="Others">Others</option>
                </select>
                <div id="cityVal"></div></td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="new-input-box">
        <table width="98%" border="0" cellpadding="0" cellspacing="0">
          <tbody>
            <tr>
              <td height="25" class="edu-form-text">Company Name</td>
            </tr>
            <tr>
              <td height="30"><input name="Company_Name" id="Company_Name" type="text" class="d4l-input" placeholder="Type your company name" onkeydown="validateDiv('companyNameVal');" onkeyup="ajax_showOptions(this,'getCountriesByLetters',event)"  onblur="onBlurDefault(this,'Type Slowly for Autofill');" onfocus="onFocusBlank(this,'Type Slowly for Autofill');">
                <div id="companyNameVal"></div></td>
            </tr>
          </tbody>
        </table>
      </div>
      <div style="clear:both;"></div>
      <div class="new-input-box">
        <div id="Othercity"></div>
      </div>
      <div id="ProfDetail" style="display:none;">
      <div style="clear:both;"></div>
      <hr />
      <div class="h2-from">Personal Details</div>
      <div class="cctc-text"><img src="ccmobile/images/privacy-lock.png" width="9" height="10" alt="lock"> Your Information is secure with us and will not be shared without your consent</div>
      <div style="clear:both;"></div>
      <div class="new-input-box">
        <table width="98%" border="0" cellpadding="0" cellspacing="0">
          <tbody>
            <tr>
              <td height="25" class="edu-form-text">Your Name</td>
            </tr>
            <tr>
              <td height="30"><input name="Full_Name" id="Full_Name" type="text" class="d4l-input"  placeholder="Your Name" onKeyPress="return isCharsetKey(event);" onkeydown="validateDiv('nameVal');">
                <div id="nameVal"></div></td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="new-input-box">
        <table width="98%" border="0" cellpadding="0" cellspacing="0">
          <tbody>
            <tr>
              <td height="25" class="edu-form-text">Mobile Number</td>
            </tr>
            <tr>
              <td height="30"><input name="Phone" id="Phone" type="text" class="d4l-input" maxlength="10" onkeyup="intOnly(this);" onkeypress="intOnly(this)" ;="" onchange="intOnly(this);" placeholder="Mobile Number" onkeydown="validateDiv('phoneVal');">
                <div id="phoneVal"></div></td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="new-input-box">
        <table width="98%" border="0" cellpadding="0" cellspacing="0">
          <tbody>
            <tr>
              <td height="25" class="edu-form-text">E-Mail ID</td>
            </tr>
            <tr>
              <td height="30"><input name="Email" id="Email" type="text" class="d4l-input" placeholder="Email Id" onkeydown="validateDiv('emailVal');" />
                <div id="emailVal"></div></td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="new-input-box">
        <table width="98%" border="0" cellpadding="0" cellspacing="0">
          <tbody>
            <tr>
              <td height="25" class="edu-form-text">Date of Birth</td>
            </tr>
            <tr>
              <td height="30"><select name="day" id="day" class="ccdob" onchange="validateDiv('dayVal');">
                  <option value="">Day</option>
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
                <select name="month" id="month" class="ccdob" onchange="validateDiv('monthVal');">
                  <option value="">Month</option>
                  <option value="01">Jan</option>
                  <option value="02">Feb</option>
                  <option value="03">Mar</option>
                  <option value="04">Apr</option>
                  <option value="05">May</option>
                  <option value="06">Jun</option>
                  <option value="07">Jul</option>
                  <option value="08">Aug</option>
                  <option value="09">Sep</option>
                  <option value="10">Oct</option>
                  <option value="11">Nov</option>
                  <option value="12">Dec</option>
                </select>
                <select name="year" id="year" class="ccdob" onchange="validateDiv('yearVal'); showhidePersonalDetails(event)">
                  <option value="">Year</option>
                  <?php for($y=$minage; $y>=$maxage; $y--) {?>
                  <option value="<?php echo $y;?>"><?php echo $y;?></option>
                  <?php }?>
                </select></td>
            </tr>
          </tbody>
        </table>
        <div id="dayVal"></div>
        <div id="monthVal"></div>
        <div id="yearVal"></div>
      </div>
      <div style="clear:both;"></div>
      <div class="new-input-box">
        <table width="98%" border="0" cellpadding="0" cellspacing="0">
          <tbody>
            <tr>
              <td height="25" class="edu-form-text">Credit Card Holder?</td>
            </tr>
            <tr>
              <td height="30">
                  <input type="radio" name="CC_Holder" id="radio-one" value="1" class="css-checkbox" onclick="addElement(this.value);" />
                 <label for="radio-one" class="css-label radGroup2" >Yes</label>
                
                  <input type="radio" name="CC_Holder" id="radio-two" value="2" class="css-checkbox" onclick="removeElement(this.value);"/>
                   <label for="radio-two" class="css-label radGroup2">No</label>
                  </td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="new-input-box" id="NmBank" style="display:none;">
        <table width="98%" border="0" cellpadding="0" cellspacing="0">
          <tbody>
            <tr>
              <td height="25" class="edu-form-text">Credit Card Holder?</td>
            </tr>
            <tr>
              <td height="30"><select class="d4l-select" name="No_of_Banks" id="No_of_Banks"  onchange="validateDiv('NumOfBankVal');">
                  <option value="">Please Select</option>
				  <option value="American Express">American Express</option>
                  <option value="HDFC Bank">HDFC Bank</option>
                  <option value="Standard Chartered">Standard Chartered</option>
                  <!--<option value="Kotak Bank">Kotak Bank</option>-->
                  <option value="RBL Bank">RBL Bank</option>
                  <option value="ICICI Bank">ICICI Bank</option>
                  <option value="SBI">State Bank of India (SBI)</option>
                  <option value="Other">Other</option>
                </select>
                <div id="NumOfBankVal"></div></td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="new-input-box" id="loanrunning" style="display:none;">
        <table width="98%" border="0" cellpadding="0" cellspacing="0">
          <tbody>
            <tr>
              <td height="25" class="edu-form-text">Do you have any loan running?</td>
            </tr>
            <tr>
              <td height="30">
                  
                  <input type="radio" name="loanrunning" id="radio-loans-one" class="css-checkbox" value="3"/>
                  <label for="radio-loans-one" class="css-label radGroup2" >Yes</label>
                  <input type="radio" name="loanrunning" id="radio-loans-two" class="css-checkbox" value="4"/>
                  <label for="radio-loans-two"  class="css-label radGroup2">No</label>
                  
                 </td>
            </tr>
          </tbody>
        </table>
      </div>
      <div style="clear:both;"></div>
      <div class="leftcc-form"> <span class="cctc-text"><span class="cctc-text">
        <label for="check-one">
          <input type="checkbox" name="accept" id="check-one" value="1" onClick="validateDiv('acceptVal');" />
          <span>I authorize Deal4loans.com & its partnering banks to contact me to explain the product & I Agree to Privacy policy and Terms and Conditions.</span> </label>
        <div id="acceptVal"></div>
        </span></span> </div>
        </div>
      <input class="ccget-quotebtn" type="submit" value="Explore Credit Card">
    </form>
    <div style="clear:both;"></div>
  </div>