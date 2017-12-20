<div class="mobile-main-wrapper">
  <div class="mobile-form-left">
    <div class="head_2 heading-margin-bottom">Confirm Details as per PAN Card</div>
    <div class="product-listing-new"> </div>
    <div style="clear:both;"></div>
    <form method="post" name="ccstep2frm" id="ccstep2frm" action="scb-credit-card-thankyou.php"  onSubmit="return Checkvalidateccstep2frm(document.ccstep2frm); ">
      <input type="hidden" name="requestID" id="requestID" value="<? echo $RequestID; ?>">
      <input type="hidden" name="card_name" id="card_name" value="<? echo $cc_name; ?>">
      <input type="hidden" name="card_id" id="card_id" value="<? echo $cc_bankid; ?>">
      <div class="pancardbox">
        <div class="pan-form">
          <div class="pan-name">
            <div class="nametextpan">First Name</div>
            <input name="first_name" id="first_name" type="text" class="pan-inputname" value="<?php if($first) {echo $first; } else {echo 'First Name';}?>" onFocus="if(this.value=='First Name')this.value=''" onBlur="if(this.value=='')this.value='First Name'" onKeyPress="return isCharsetKey(event);" onkeydown="validateDiv('FirstnameVal');" maxlength="12">
            <div style="clear:both; height:15px;"></div>
            <div id="FirstnameVal"></div>
          </div>
          <div class="pan-name margin-a-left">
            <div class="nametextpan">Middle Name</div>
            <input name="middle_name" id="middle_name" type="text" class="pan-inputname"  value="<?php if(strlen($middle)>0 && strlen($last)>0) { echo $middle;} else {echo ''; }?>" onFocus="if(this.value=='Middle Name')this.value=''" onBlur="if(this.value=='')this.value=''" onKeyPress="return isCharsetKey(event);">
          </div>
          <div class="pan-name margin-a-left">
            <div class="nametextpan">Last Name</div>
            <input name="last_name" id="last_name" type="text" class="pan-inputname" value="<?php if(strlen($last)>0) { echo $last;} elseif(strlen($middle)>0 && $last==""){ echo $middle;} else {echo 'Last Name';}?>" onFocus="if(this.value=='Last Name')this.value=''" onBlur="if(this.value=='')this.value='Last Name'" onKeyPress="return isCharsetKey(event);" onkeydown="validateDiv('LastnameVal');">
            <div style="clear:both; height:15px;"></div>
            <div id="LastnameVal"></div>
          </div>
          <div class="clearfix"></div>
          <div class="pan-name">
            <input name="DOB" id="DOB" type="text" class="pan-inputname" value="<?php if($DOB) {echo $DOB; } else {echo 'DD/MM/YYYY';}?>"  onFocus="if(this.value=='DD/MM/YYYY')this.value=''" onBlur="if(this.value=='')this.value='DD/MM/YYYY'" onkeydown="validateDiv('DOBVal');">
            <div style="clear:both;"></div>
            <div id="DOBVal"></div>
          </div>
          <div style="clear:both;"></div>
          <br />
          <div class="account-no">Permanent Account Number</div>
          <div style="clear:both; height:5px;"></div>
          <div class="pannumberdigit" style="background:#FFF; opacity:0.5;">
            <input  name="panno" id="panno" type="text" class="pan-inputname" placeholder="BOUPR9012L" onkeydown="validateDiv('pannoVal');" style="border:none; width:100%;">
            <div style="clear:both;"></div>
            <div id="pannoVal"></div>
          </div>
        </div>
      </div>
      <div class="annual-income-ui-input-wrapper margin-a-left">
        <div class="gender-box"> <strong>Gender</strong>
          <div class="form-required">
            <label for="radio-one">
              <input type="radio" name="Gender" id="radio-one" value="1" onclick="return ShowCityField(event)"/>
              <i></i> <span>Male</span> </label>
            <label for="radio-two">
              <input type="radio" name="Gender" id="radio-two" value="2" onclick="return ShowCityField(event)"/>
              <i></i> <span>Female</span> </label>
          </div>
        </div>
      </div>
      <div style="clear:both;"></div>
      <span id="ShowCityAddr" style="display:none;">
      <input name="resiaddress1" id="resiaddress1" type="text" class="annual-income-ui-input pancard-icon float-left" placeholder="Complete Residential address" onkeydown="validateDiv('resiaddressVal');"  maxlength="120" >
      <div style="clear:both;"></div>
      <div id="resiaddressVal"></div>
      <div style="clear:both;"></div>
      <div class="annual-income-ui-input-wrapper">
        <select name="City" id="City" class="mobile-ui-input location-icon input-bottom-margin" onchange="showPinCode(this.value);  validateDiv('cityVal');" >
          <option value="">Select Your Residence City</option>
        <?php 
		$getcitySql = "SELECT * FROM creditcard_citylist WHERE status=1 GROUP BY cityname";
		list($numRowscity,$getcityQuery)=MainselectfuncNew($getcitySql,$array = array());
		for($cN=0;$cN<$numRowscity;$cN++)
		{
		$cityname = ucwords(strtolower($getcityQuery[$cN]['cityname']));
		$cityalias =ucwords(strtolower($getcityQuery[$cN]['cityalias']));
		?>
			  <option value="<?php if(strlen($cityalias)>2) { echo $cityalias; } else { echo $cityname; } ?>" <? if($cityname==$City || $cityalias==$City) echo "selected";?>><?php if(strlen($cityalias)>2) { echo $cityalias; } else { echo $cityname; } ?></option>
			  <?php
		}
		?>
        </select>
        <div style="clear:both;"></div>
        <div id="cityVal"></div>
      </div>
      <div class="annual-income-ui-input-wrapper margin-a-left">
        <input name="pincode" id="pincode" type="text"  class="annual-income-ui-input pancard-icon float-left" placeholder="Pincode" tabindex=3 autocomplete="off" onkeydown="return showProfDetails(event); validateDiv('pincodeVal');" />
		 <div style="clear:both;"></div>
        <div id="pincodeVal"></div>
      </div>
      </span>
      <div style="clear:both;"></div>
      <hr>
      <span id="ShowProfDetails" style="display:none;">
      <div style="clear:both;"></div>
      <div class="head_2">Professional Details</div>
      <p class="smalltext"><img src="ccmobile/images/privacy-lock.png" width="9" height="10" alt="lock"> Your Information is secure with us and will not be shared without your consent</p>
      <select name="Qualification" id="Qualification" class="mobile-ui-input qualification-icon input-bottom-margin" onchange="validateDiv('QualificationVal');">
        <option value="">Select Qualification</option>
		<option value="20">Architect</option>
		<option value="24">CA</option>
		<option value="9">Diploma</option>
		<option value="25">Doctor</option>
		<option value="26">Engineer</option>
        <option value="10">Graduate</option>
		<option value="13">Graduate</option>
        <option value="15">Professional</option>
        <option value="27">MBA/MMS</option>
        <option value="19">Others</option>
      </select>
      <div style="clear:both;"></div>
      <div id="QualificationVal"></div>
      <div style="clear:both;"></div>
		<select name="Designation" id="Designation" class="mobile-ui-input qualification-icon input-bottom-margin" onchange="validateDiv('DesignationVal');">
        <option value="">Select Designation</option>
		<option value="10">Non Management</option>
		<option value="20">Junior Management</option>
		<option value="30">Middle Management</option>
		<option value="40">Senior Management</option>
		<option value="50">Other</option>
      </select>
      <div style="clear:both;"></div>
      <div id="DesignationVal"></div>
        <div style="clear:both;"></div>
      Office Landline
      <div style="clear:both; height:10px;"></div>
      <div class="annual-income-ui-input-wrapper">
        <select name="Land_linenumber" id="Land_linenumber" class="mobile-ui-input landline-icon input-bottom-margin" onchange="validateDiv('Land_linenumberVal');">
          <option value="">Select Landline</option>
          <option value="Office" selected>Office</option>
          </select>
        <div style="clear:both;"></div>
        <div id="Land_linenumberVal"></div>
      </div>
      <div class="annual-income-ui-input-wrapper  margin-a-left">
        <div class="mobile-ui-input landline-icon input-bottom-margin">
          <div class="stdlandlinewrapper">
            <input name="STD" type="text" class="stdtext" placeholder="STD" onkeydown="validateDiv('STDVal');" maxlength="6" onKeyPress="return numOnly(event);">
            <input name="Phone_Number" type="text" class="stdnumbertext " placeholder="Number"  onkeydown="validateDiv('Land_linenumberVal2');" onKeyPress="return numOnly(event);" maxlength="8">
            <div id="STDVal"></div>
            <div style="clear:both;"></div>
            <div id="Land_linenumberVal2"></div>
          </div>
          <div style="clear:both;"></div>
        </div>
      </div>
       </span>
      <div style="clear:both;"></div>
      Any relation with Standard Chartered Bank?      <div style="clear:both; height:10px;"></div>
	  <select name="relation_with_bank" id="relation_with_bank" class="mobile-ui-input qualification-icon input-bottom-margin" onchange="validateDiv('relationwithbankVal');">
        <option value="">Please select</option>
		 <option value="0">No Relation</option>
		<option value="2">Savings Account</option>
		<option value="5">Current Account (Personal)</option>
		<option value="11">Current Account (Business)</option>
		<option value="13">Term Deposit</option>
		<option value="14">Credit Card</option>
		<option value="18">Personal Loan</option>
		<option value="20">Home Loan</option>
		<option value="26">Business Loan</option>
      </select>
      <div style="clear:both;"></div>
      <div id="relationwithbankVal"></div>
        <div style="clear:both;"></div>
      </span>
      <div class="app-counting bg-success"><span class="app-wow">Wow!</span> You are almost done</div>
      <div style="clear:both; margin-top:15px;"></div>
      <button class="submit-btn" type="submit">Instant Online Approval</button>
    </form>
  </div>
  <div style="clear:both; margin-top:15px;"></div>
</div>
