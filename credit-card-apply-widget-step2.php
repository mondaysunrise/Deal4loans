<style type="text/css">
.full-width-box{ width:100%;}
.highlight-box{padding:0px; font-size: 11.5px; margin-bottom: 10px;}
.check-labled-text{font-weight: normal; line-height: 18PX;}
</style>
<div class="mobile-main-wrapper">
  <div class="mobile-form-left">
    <div class="head_2 heading-margin-bottom">Confirm Details as per PAN Card</div>
    <div class="product-listing-new"> </div>
    <div style="clear:both;"></div>
    <form method="post" name="ccstep2frm" id="ccstep2frm" action="sbi-credit-card-thankyou-new.php"  onSubmit="return Checkvalidateccstep2frm(document.ccstep2frm); ">
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
	  
	    <div style="clear:both;"></div>
      <div class="annual-income-ui-input-wrapper margin-a-left">
        <div class="LandlinePostpaid-box"><strong>Do you already have an SBI Credit Card?</strong>
          <div class="form-required">
            <label for="radio-five">
              <input type="radio" name="sbicardholder" id="radio-five" value="Yes" onclick="validateDiv('cardHolderVal')';"  />
              <i></i> <span>Yes</span> </label>
            <label for="radio-six">
              <input type="radio" name="sbicardholder" id="radio-six" value="No"  onclick="validateDiv('cardHolderVal')';" />
              <i></i> <span>No</span> </label>
          </div>
		  <div style="clear:both;"></div>
		   <div id="cardHolderVal"></div>
        </div>
      </div>
      
      <div style="clear:both;"></div>
      <span id="runningloan" style="display:none;">
      <div class="full-width-box margin-a-left">
        <div class="LandlinePostpaid-box"><strong>Have you applied for SBI Card in last 6 months?</strong>
          <div class="form-required">
            <label for="radio-seven">
              <input type="radio" name="sbiloanrunning" id="radio-seven" value="Yes" onclick="return HideGenderField(event)" />
              <i></i> <span>Yes</span> </label>
            <label for="radio-eight">
              <input type="radio" name="sbiloanrunning" id="radio-eight" value="No" onclick="return ShowGenderField(event)"/>
              <i></i> <span>No</span> </label>
          </div>
		  <div style="clear:both;"></div>
		   <div id="months6Val"></div>
        </div>
      </div>
      </span>
      <div style="clear:both;"></div>
      <span id="sbirelationship" style="display:none;">
      <div class="full-width-box margin-a-left">
        <div class="LandlinePostpaid-box"><strong>Do you have any existing relationship with SBI or its associate banks?</strong>
          <div class="form-required">
            <label for="radio-nine">
              <input type="radio" name="sbirelation" id="radio-nine" value="Yes"  />
              <i></i> <span>Yes</span> </label>
            <label for="radio-ten">
              <input type="radio" name="sbirelation" id="radio-ten" value="No"   />
              <i></i> <span>No</span> </label>
          </div>
		  <div style="clear:both;"></div>
		   <div id="relVal"></div>
        </div>
      </div>
      </span>
      
      <div style="clear:both;"></div>
      
      <span id="bankaccount" style="display:none;">
		<input name="bankaccountnumber" id="bankaccountnumber" type="text" class="annual-income-ui-input pancard-icon float-left" placeholder="Account Number" onKeyPress="return numOnly(event);" maxlength="20" >
		<div style="margin:0px auto 20px; border-radius:5px; font-family:Arial, Helvetica, sans-serif; padding:20px 20px 20px 20px; background:#ebf2e8; box-shadow:#CCC 0px 2px 5px 0px; color:#2d9602; font-size:12px;" >Providing your existing SBI account number shall help faster processing of application. This could be any of your accounts Savings / PPF / Debit Card no. / Fixed Deposit  / loan etc</div>
      </span>
      
		<div style="clear:both;"></div>
      
    
      <!--<div class="annual-income-ui-input-wrapper margin-a-left">-->
        <div class="gender-box" id="ShowGender" style="display:none;"> <strong>Gender</strong>
          <div class="form-required">
            <label for="radio-one">
              <input type="radio" name="Gender" id="radio-one" value="Male" onclick="return ShowCityField(event)"/>
              <i></i> <span>Male</span> </label>
            <label for="radio-two">
              <input type="radio" name="Gender" id="radio-two" value="Female" onclick="return ShowCityField(event)"/>
              <i></i> <span>Female</span> </label>
          </div>
		  <div style="clear:both;"></div>
		   <div id="genderVal"></div>
        </div>
     <!-- </div>-->
      <div style="clear:both;"></div>

	<span id="ShowCityAddr" style="display:none;">
		<div class="full-width-box margin-a-left">
			<div class="LandlinePostpaid-box"> <strong>Do you have any <a href="#" data-toggle="modal" data-target="#contentModal">permissible</a> current address proof ?</strong>
				<div class="form-required">
					<label for="radio-eleven">
						<input type="radio" name="AddressDoc" id="radio-eleven" value="Yes"/>
						<i></i> <span>Yes</span>
					</label>
					<label for="radio-twelve">
						<input type="radio" name="AddressDoc" id="radio-twelve" value="No"/>
						<i></i> <span>No</span>
					</label>
				</div>
				<div style="clear:both;"></div>
				<div id="addressdocVal"></div>
			</div>
		</div>
		<div style="clear:both;"></div>

		<input name="resiaddress1" id="resiaddress1" type="text" class="annual-income-ui-input pancard-icon float-left" placeholder="Permanent Residential Address 1" onkeydown="validateDiv('resiaddressVal');"  maxlength="40" >
		<div style="clear:both;"></div>
		<input name="resiaddress2" id="resiaddress2" type="text" class="annual-income-ui-input pancard-icon float-left" placeholder="Permanent Residential Address 2" onkeydown="validateDiv('resiaddressVal');"  maxlength="40" >
		<div style="clear:both;"></div>
		<input name="resiaddress3" id="resiaddress3" type="text" class="annual-income-ui-input pancard-icon float-left" placeholder="Permanent Residential Address 3 (Landmark)" onkeydown="validateDiv('resiaddressVal');"  maxlength="40" >
		<div style="clear:both;"></div>
		<div id="resiaddressVal"></div>
		<div style="clear:both;"></div>
		
		<div class="annual-income-ui-input-wrapper">
			<input type="text" id="pincode" name="pincode" placeholder="Residence Pincode" class="mobile-ui-input location-icon input-bottom-margin"  onchange="showProfDetails(event);" onkeyup="getCityFromPin('City','pincode');">
			<div style="clear:both;"></div>
			<div id="pincodeVal"></div>
		</div>
		<div class="annual-income-ui-input-wrapper margin-a-left">
			<input type="text" value="" name="City" id="City" placeholder="Residence City" readonly="readonly" class="mobile-ui-input location-icon input-bottom-margin" onchange="validateDiv('cityVal');"/>
			<div style="clear:both;"></div>
			<div id="cityVal"></div>
		</div>
	</span>

	<div style="clear:both;"></div>
	<hr>
	<span id="ShowProfDetails" style="display:none;">
		<div style="clear:both;"></div>
		<div class="head_2">Professional Details</div>
		<p class="smalltext"><img src="ccmobile/images/privacy-lock.png" width="9" height="10" alt="lock"> Your Information is secure with us and will not be shared without your consent</p>
		<input name="Company_Name" id="Company_Name" type="text"  class="annual-income-ui-input pancard-icon float-left" placeholder="Company Name" onKeyUp="ajax_showOptions(this,'getCountriesByLetters',event)" tabindex=3 autocomplete="off" onkeydown="validateDiv('companyVal');" value="<?php echo $Company_Name; ?>" />
		<div style="clear:both;"></div>
		<div id="companyVal"></div>
		<div style="clear:both;"></div>
		<select name="Qualification" id="Qualification" class="mobile-ui-input qualification-icon input-bottom-margin" onchange="validateDiv('QualificationVal');">
			<option value="">Select Qualification</option>
			<option  value="10 or below">Metric or below</option>
			<option value="Plus 2 or below">Higher secondary </option>
			<option value="Graduate">Graduation</option>
			<option value="Post graduate">Postgraduate and above</option>
		</select>
		<div style="clear:both;"></div>
		<div id="QualificationVal"></div>
		<div style="clear:both;"></div>
		<input name="Designation" id="Designation" type="text" class="mobile-ui-input input-bottom-margin designation-icon" placeholder="Designation"  onkeydown="validateDiv('DesignationVal');"  maxlength="35" />
		<div style="clear:both;"></div>
		<div id="DesignationVal"></div>
		<input name="OfficeAddress1" id="OfficeAddress1" type="text" class="mobile-ui-input input-bottom-margin location-icon" placeholder="Complete Office Address 1" onkeydown="validateDiv('OfficeAddressVal');"  maxlength="120">
		<input name="OfficeAddress2" id="OfficeAddress2" type="text" class="mobile-ui-input input-bottom-margin location-icon" placeholder="Complete Office Address 2" onkeydown="validateDiv('OfficeAddressVal');"  maxlength="120">
		<input name="OfficeAddress3" id="OfficeAddress3" type="text" class="mobile-ui-input input-bottom-margin location-icon" placeholder="Complete Office Address 3 (Landmark)" onkeydown="validateDiv('OfficeAddressVal');"  maxlength="120">
		<div style="clear:both;"></div>
		<div id="OfficeAddressVal"></div>
		<div style="clear:both;"></div>
		<div class="annual-income-ui-input-wrapper">
			<input type="text" id="OfficePin" name="OfficePin" placeholder="Office Pincode" class="mobile-ui-input location-icon input-bottom-margin" onkeyup="getCityFromPin('OfficeCity','OfficePin');">
			<div style="clear:both;"></div>
			<div id="OfficePinVal"></div>
		</div>
		<div class="annual-income-ui-input-wrapper margin-a-left">
			<input type="text" value="" name="OfficeCity" id="OfficeCity" placeholder="Office City" readonly="readonly" class="mobile-ui-input location-icon input-bottom-margin" onchange="validateDiv('OfficeCityVal');"/>
			<div style="clear:both;"></div>
			<div id="OfficeCityVal"></div>
		</div>
		<div style="clear:both;"></div>
		<div class="annual-income-ui-input-wrapper margin-a-left">
			<div class="LandlinePostpaid-box"><!--<strong>One phone number is mandatory</strong>-->
				<div class="form-required">
					<label for="radio-three">
						<input type="radio" name="LanlinPostpaid" id="radio-three" value="1" onclick="return ShowLandlineField(event)"/>
						<i></i> <span>Landline</span>
					</label>
					<label for="radio-four">
						<input type="radio" name="LanlinPostpaid" id="radio-four" value="2" onclick="return ShowPostPaidField(event)"/>
						<i></i> <span>Postpaid Mobile</span>
					</label>
			  </div>
			</div>
		</div>
		
		<span id="landLineNumber" style="display:none;">
			<div style="clear:both;"></div>
			One landline number Office / Residence
			<div style="clear:both; height:10px;"></div>
			<div class="annual-income-ui-input-wrapper">
				<select name="Land_linenumber" id="Land_linenumber" class="mobile-ui-input landline-icon input-bottom-margin" onchange="validateDiv('Land_linenumberVal');">
					<option value="">Select Landline</option>
					<option value="Office">Office</option>
					<option value="Residence">Residence</option>
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
      
		<span id="PostPaidNumber" style="display:none;">
			<div class="annual-income-ui-input-wrapper  margin-a-left">
				<div class="mobile-ui-input landline-icon input-bottom-margin">
					<div class="stdlandlinewrapper">
						<input name="MobileNumber" type="text" class="stdnumbertext " placeholder="Mobile Number"  onkeydown="validateDiv('MobilNumberVal2');" onKeyPress="return numOnly(event);" maxlength="10">
						<div style="clear:both;"></div>
						<div id="MobilNumberVal2"></div>
					</div>
					<div style="clear:both;"></div>
				</div>
			</div>
		</span>
      
		<div style="clear:both;"></div>
	</span>

	<div class="app-counting bg-success" id="infomessage"><span class="app-wow">Wow!</span> You are almost done</div>
	<div style="clear:both;"></div>	  
	<div>
		<label for="check" class="check-labled-text">
			<input type="checkbox" name="accept" id="accept" value="1" checked />
			<i></i>
		</label>By clicking on Instant Online Approval, I hereby authorize Deal4loans.com and provide my express consent to share my application with the selected bank and obtain my credit Information/credit report from the selected bank as retrieved by the selected bank, to check eligibility for my application. I agree and understand that this may impact my credit score. I also authorize SBI to share the information of my account required by SBI Card solely for the purpose of issuance of SBI Card in my name.
	</div>
	<div style="clear:both;"></div>
	<div id="acceptRVal"></div>
	<div style="clear:both; margin-top:15px;"></div>
	<button class="submit-btn" type="submit" id="submitbtn">Instant Online Approval</button>
</form>
</div>
<div style="clear:both; margin-top:15px;"></div>
</div>
