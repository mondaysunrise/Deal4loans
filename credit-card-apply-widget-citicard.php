<div class="mobile-main-wrapper">
  <div class="mobile-form-left">
    <div class="head_2 heading-margin-bottom">Confirm Details as per PAN Card</div>
    <div class="product-listing-new"> </div>
    <div style="clear:both;"></div>
    <form method="post" name="ccstep2frm" id="ccstep2frm" action="citibank-credit-card-thankyou.php"  onSubmit="return valiccstep2frm(document.ccstep2frm); ">
      <input type="hidden" name="requestID" id="requestID" value="<? echo $RequestID; ?>">
      <input type="hidden" name="card_name" id="card_name" value="<? echo $cc_name; ?>">
      <input type="hidden" name="card_id" id="card_id" value="<? echo $cc_bankid; ?>">
	  <input type="hidden" name="company_name" id="company_name" value="<? echo $Company_Name; ?>">
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
            <input  name="panno" id="panno" type="text" class="pan-inputname" onkeydown="validateDiv('pannoVal');" style="border:none; width:100%;">
            <div style="clear:both;"></div>
            <div id="pannoVal"></div>
          </div>
        </div>
      </div>
      <div class="annual-income-ui-input-wrapper margin-a-left">
        <div class="gender-box"> <strong>Gender</strong>
          <div class="form-required">
            <label for="radio-one">
              <input type="radio" name="Gender" id="radio-one" value="Male" onclick="return ShowCityField(event)"/>
              <i></i> <span>Male</span> </label>
            <label for="radio-two">
              <input type="radio" name="Gender" id="radio-two" value="Female" onclick="return ShowCityField(event)"/>
              <i></i> <span>Female</span> </label>
          </div>
        </div>
      </div>
      <div style="clear:both;"></div>
      <span id="ShowCityAddr" style="display:none;">
      <p><strong>Residence(Current Residential Address):</strong></p>
     <div class="address-ui-input-wrapper margin-a-left">
         <input name="housename" id="housename" type="text" class="annual-income-ui-input pancard-icon float-left" placeholder="*Door/house no." onkeydown="validateDiv('housenameVal');"  maxlength="25" >
          <div style="clear:both;"></div>
         <div id="housenameVal"></div>
      </div>
      <div class="address-ui-input-wrapper margin-a-left">
         <input name="streeRoad" id="streeRoad" type="text" class="annual-income-ui-input pancard-icon float-left" placeholder="*Street and road name" onkeydown="validateDiv('streeRoadVal');"  maxlength="25" >
          <div style="clear:both;"></div>
         <div id="streeRoadVal"></div>
      </div>
      <div class="address-ui-input-wrapper margin-a-left">
         <input name="areaLocality" id="areaLocality" type="text" class="annual-income-ui-input pancard-icon float-left" placeholder="*Area/Locality" onkeydown="validateDiv('areaLocalityVal');"  maxlength="25" >
          <div style="clear:both;"></div>
         <div id="areaLocalityVal"></div>
      </div>
     <div class="address-ui-input-wrapper margin-a-left">
         <input name="landmark" id="landmark" type="text" class="annual-income-ui-input pancard-icon float-left" placeholder="*Landmark" onkeydown="validateDiv('landmarkVal');"  maxlength="25" >
          <div style="clear:both;"></div>
         <div id="landmarkVal"></div>
      </div>
     
      <div style="clear:both;"></div>
      <div class="address-ui-input-wrapper margin-a-left">
        <select name="City" id="City" class="mobile-ui-input location-icon input-bottom-margin" onchange="validateDiv('cityVal');showPinCode(this.value);">
          <?=plgetCityList($City)?>
        </select>
        <div style="clear:both;"></div>
        <div id="cityVal"></div>
      </div>
      <div class="address-ui-input-wrapper margin-a-left">
        <input type="text" name="pincode" id="PincodeText" onkeypress="showProfDetail(this.value); validateDiv('pincodeVal'); return numOnly(event)" class="mobile-ui-input location-icon input-bottom-margin" placeholder="*Pincode" maxlength="6">
          <div style="clear:both;"></div>
        <div id="pincodeVal"></div>
      </div>
    <!--  <div class="address-ui-input-wrapper margin-a-left">
        <input type="text" name="stdCode" id="stdCode" onkeypress="validateDiv('stdCodeVal');" class="mobile-ui-input location-icon input-bottom-margin" placeholder="std code">
          <div style="clear:both;"></div>
        <div id="stdCodeVal"></div>
      </div>
      <div class="address-ui-input-wrapper margin-a-left">
        <input type="text" name="LandlineNum" id="LandlineNum" onkeypress="validateDiv('LandlineNumVal');" class="mobile-ui-input location-icon input-bottom-margin" placeholder="Landline Number" maxlength="8">
          <div style="clear:both;"></div>
        <div id="LandlineNumVal"></div>
      </div>-->
      </span>
      <div style="clear:both;"></div>
      <hr>
      <span id="ShowProfDetails" style="display:none;">
      <div style="clear:both;"></div>
      <div class="head_2">Professional Details</div>
      <p class="smalltext"><img src="ccmobile/images/privacy-lock.png" width="9" height="10" alt="lock"> Your Information is secure with us and will not be shared without your consent</p>
	   <select name="Qualification" id="Qualification" class="mobile-ui-input qualification-icon input-bottom-margin" onchange="validateDiv('QualificationVal');">
        <option value="">Select Qualification</option>
        <option value="Graduate">Graduate</option>
        <option value="Post graduate">Post Graduate</option>
		<option value="Others">Others</option>
      </select>
      <div style="clear:both;"></div>
      <div id="QualificationVal"></div>
      <div style="clear:both;"></div>
	  <select name="Designation" id="Designation" class="mobile-ui-input qualification-icon input-bottom-margin" onchange="validateDiv('QualificationVal');">
        <option value="">Select Designation</option>
        <option value="Accountant">Accountant</option>
		<option value="Assistant Manager">Assistant Manager</option>
		<option value="Assistant Vice president">Assistant Vice president</option>
		<option value="Consultant">Consultant</option>
		<option value="Director">Director</option>
		<option value="General Manager">General Manager</option>
		<option value="Engineer">Engineer</option>
		<option value="Executive">Executive</option>
		<option value="Officer">Officer</option>
		<option value="Lecturer">Lecturer</option>
		<option value="Professor">Professor</option> 
		<option value="Manager">Manager</option>
		<option value="Software Engineer">Software Engineer</option>
		<option value="Team Leader">Team Leader</option>
		<option value="Supervisor">Supervisor</option>
		<option value="Accountant">Vice president</option>
		<option value="Others">Others</option>
      </select>
      <div style="clear:both;"></div>
      <div id="DesignationVal"></div>
     <p><strong>Office:</strong></p>
    <div class="address-ui-input-wrapper margin-a-left">
         <input name="buildingName" id="buildingName" type="text" class="annual-income-ui-input location-icon float-left" placeholder="*Building name/no." onkeydown="validateDiv('buildingNameVal');"  maxlength="25">
          <div style="clear:both;"></div>
         <div id="buildingNameVal"></div>          
      </div>
      
       <div class="address-ui-input-wrapper margin-a-left">
         <input name="OffiStreet" id="OffiStreet" type="text" class="annual-income-ui-input location-icon float-left" placeholder="*Street/road name" onkeydown="validateDiv('OffiStreetVal');"  maxlength="25">
          <div style="clear:both;"></div>
        <div id="OffiStreetVal"></div>
       
      </div>
       <div class="address-ui-input-wrapper margin-a-left">
         <input name="OffiArea" id="OffiArea" type="text" class="annual-income-ui-input location-icon float-left" placeholder="*Area/locality" onkeydown="validateDiv('OffiAreaVal');"  maxlength="25">
          <div style="clear:both;"></div>
        <div id="OffiAreaVal"></div>
         
      </div>
       <!--<div class="address-ui-input-wrapper margin-a-left">
         <input name="OffiLandmark" id="OffiLandmark" type="text" class="annual-income-ui-input location-icon float-left" placeholder="Landmark" onkeydown="validateDiv('OffiLandmarkVal');"  maxlength="25">
          <div style="clear:both;"></div>
        <div id="OffiLandmarkVal"></div>
             </div>-->
			<div style="clear:both;"></div>
      <div class="address-ui-input-wrapper margin-a-left">
        <select name="OfficeCity" id="OfficeCity" class="mobile-ui-input location-icon input-bottom-margin" onchange=" validateDiv('OfficeCityVal');">
          <?=plgetCityList($City)?>
        </select>
        <div style="clear:both;"></div>
        <div id="OfficeCityVal"></div>
     
      </div>
      <div class="address-ui-input-wrapper margin-a-left">
        <input type="text" name="OfficePin" class="mobile-ui-input location-icon input-bottom-margin" onkeypress="return numOnly(event)" onkeydown="validateDiv('OfficePinVal');" placeholder="*Pincode" maxlength="6">
         <div style="clear:both;"></div>
        <div id="OfficePinVal"></div>
  
      </div>
   <!-- <div class="address-ui-input-wrapper margin-a-left">
        <input name="OffiSTDCode" type="text" class="mobile-ui-input location-icon input-bottom-margin" placeholder="*std code" onkeydown="validateDiv('OffiSTDCodeVal');" onKeyPress="return numOnly(event);">
        <div style="clear:both;"></div>
       <div id="OffiSTDCodeVal"></div>
    
      </div>
      <div class="address-ui-input-wrapper margin-a-left">
       <input name="OffiLandlineNum" type="text" class="mobile-ui-input location-icon input-bottom-margin " placeholder="*Landline number"  onkeydown="validateDiv('OffiLandlineNumVal');" onKeyPress="return numOnly(event);" maxlength="8">
          
            <div style="clear:both;"></div>
            <div id="OffiLandlineNumVal"></div>
                  </div>-->
	   <div style="clear:both;"></div>
      <div class="annual-income-ui-input-wrapper margin-a-left">
        <div class="mailing-address-box"> <strong>*Preferred mailing address</strong>
          <div class="form-required">
            <label for="radio-three">
              <input type="radio" name="mailAddr" id="radio-three" value="Office" />
              <i></i> <span>Office</span> </label>
            <label for="radio-four">
              <input type="radio" name="mailAddr" id="radio-four" value="Residence" />
              <i></i> <span>Residence</span> </label>
          </div>
        </div>
      </div>
      <div style="clear:both;"></div>
      One landline number Office / Residence is Mandatory<span style="color:red;">*</span>
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
            <input name="STD" type="text" class="stdtext" placeholder="STD" onkeydown="validateDiv('STDVal');" onKeyPress="return numOnly(event);">
            <input name="Phone_Number" type="text" class="stdnumbertext " placeholder="Number"  onkeydown="validateDiv('Land_linenumberVal2');" onKeyPress="return numOnly(event);" maxlength="8">
            <div id="STDVal"></div>
            <div style="clear:both;"></div>
            <div id="Land_linenumberVal2"></div>
          </div>
          <div style="clear:both;"></div>
        </div>
      </div>
      <div style="clear:both;"></div>
      </span>
      
       <div style="clear:both;"></div>
      <div class="app-counting bg-success"><span class="app-wow">Wow!</span> You are almost done</div>
      <div style="clear:both; margin-top:15px;"></div>
      <button class="submit-btn" type="submit">Submit</button>
    </form>
  </div>
  <div style="clear:both; margin-top:15px;"></div>
</div>
