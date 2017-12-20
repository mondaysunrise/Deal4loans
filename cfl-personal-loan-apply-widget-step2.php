<div class="mobile-main-wrapper">
  <div class="mobile-form-left">
    <div class="head_2 heading-margin-bottom">Confirm Details as per PAN Card</div>
    <div class="product-listing-new"> </div>
    <div style="clear:both;"></div>
    <form method="post" name="ccstep2frm" id="ccstep2frm" action="apply-pl-cfl-continue.php"  onSubmit="return validateCflccstep2frm(document.ccstep2frm); ">
      <input type="hidden" name="requestid" id="requestid" value="<? echo $pl_requestid; ?>">
	  <input type="hidden" name="company_name" id="company_name" value="<? echo $company_name; ?>">
      <input type="hidden" name="annual_income" id="annual_income" value="<? echo $salary; ?>">
	  <input type="hidden" name="urltype" value="<?php echo $urltypeval; ?>" />
      <div class="pancardbox">
        <div class="pan-form">
          <div class="pan-name">
            <div class="nametextpan">First Name</div>
            <input name="first_name" id="first_name" type="text" class="pan-inputname" value="<?php if($firstname) {echo $firstname; } else {echo 'First Name';}?>" onFocus="if(this.value=='First Name')this.value=''" onBlur="if(this.value=='')this.value='First Name'" onKeyPress="return isCharsetKey(event);" onkeydown="validateDiv('FirstnameVal');" maxlength="12">
            <div style="clear:both; height:15px;"></div>
            <div id="FirstnameVal"></div>
          </div>
          <div class="pan-name margin-a-left">
            <div class="nametextpan">Middle Name</div>
            <input name="middle_name" id="middle_name" type="text" class="pan-inputname"  onFocus="if(this.value=='Middle Name')this.value=''" onBlur="if(this.value=='')this.value=''" onKeyPress="return isCharsetKey(event);">
          </div>
          <div class="pan-name margin-a-left">
            <div class="nametextpan">Last Name</div>
            <input name="last_name" id="last_name" type="text" class="pan-inputname" value="<?php if(strlen($lastname)>0) { echo $lastname;} else {echo 'Last Name';}?>" onFocus="if(this.value=='Last Name')this.value=''" onBlur="if(this.value=='')this.value='Last Name'" onKeyPress="return isCharsetKey(event);" onkeydown="validateDiv('LastnameVal');">
            <div style="clear:both; height:15px;"></div>
            <div id="LastnameVal"></div>
          </div>
          <div class="clearfix"></div>
          <div class="main-wrapper-ddmmyy">
          
          <div class="smalldd-wrapper">
            <input name="day" id="day" type="text" class="pan-small-dd" value="DD"  onFocus="if(this.value=='DD')this.value=''" onBlur="if(this.value=='')this.value='DD'" onkeydown="validateDiv('dayVal');">
            <div style="clear:both;"></div>
          
          </div>
          <div class="smalldd-wrapper">
            <input name="month" id="month" type="text" class="pan-small-dd" value="MM"  onFocus="if(this.value=='MM')this.value=''" onBlur="if(this.value=='')this.value='MM'" onkeydown="validateDiv('monthVal');">
            <div style="clear:both;"></div>
            
          </div>
          <div class="smallyear-wrapper">
            <input name="year" id="year" type="text" class="pan-small-dd" value="YYYY"  onFocus="if(this.value=='YYYY')this.value=''" onBlur="if(this.value=='')this.value='YYYY'" onkeydown="validateDiv('yearVal');">
            <div style="clear:both;"></div>
             </div>            <div style="clear:both;"></div>
           <div id="dayVal"></div> 

           <div id="monthVal"></div> 
            <div id="yearVal"></div>
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
              <input type="radio" name="Gender" id="radio-one" value="Male"/>
              <i></i> <span>Male</span> </label>
            <label for="radio-two">
              <input type="radio" name="Gender" id="radio-two" value="Female"/>
              <i></i> <span>Female</span> </label>
          </div>
        </div>
        
      </div>
      <div class="annual-income-ui-input-wrapper margin-a-left">
        <select name="MaritalStatus" id="MaritalStatus" class="mobile-ui-input icon input-bottom-margin" onchange="ShowCityField(event); validateDiv('MaritalStatusVal');">
          <option value="">Select Marital Status</option>
            <option value="Single">Single</option>
             <option value="Married">Married</option>
        </select>
        <div style="clear:both;"></div>
        <div id="MaritalStatusVal"></div>
      </div>
      
      <div style="clear:both;"></div>
      <span id="ShowCityAddr" style="display:none;">
      <input name="resiaddress1" id="resiaddress1" type="text" class="annual-income-ui-input location-icon float-left" placeholder="Complete Residential address with Landmark" onkeydown="validateDiv('resiaddressVal');"  maxlength="120" >
      <div style="clear:both;"></div>
      <div id="resiaddressVal"></div>
      <div style="clear:both;"></div>
       
        
              <input name="pincode" id="pincode" type="text" class="mobile-ui-input location-icon input-bottom-margin" placeholder="Residence Pincode" onkeydown="validateDiv('pincodeVal');  showProfDetails(event)"  maxlength="6"  >
 <div style="clear:both;"></div>
        <div id="pincodeVal"></div>
  <div style="clear:both;"></div>
      </span>
      <div style="clear:both;"></div>
      <hr>
      <span id="ShowProfDetails" style="display:none;">
      <div style="clear:both;"></div>
      <div class="head_2">Professional Details</div>
      <p class="smalltext"><img src="ccmobile/images/privacy-lock.png" width="9" height="10" alt="lock"> Your Information is secure with us and will not be shared without your consent</p>
      <input name="OfficeAddress1" id="OfficeAddress1" type="text" class="mobile-ui-input input-bottom-margin location-icon" placeholder="Complete Office Address" onkeydown="validateDiv('OfficeAddressVal');"  maxlength="120">
      <div style="clear:both;"></div>
      <div id="OfficeAddressVal"></div>
      <div style="clear:both;"></div>
      
        <input name="OfficePin" id="OfficePin" type="text" class="mobile-ui-input location-icon input-bottom-margin" placeholder="Complete Office Pincode" onkeydown="validateDiv('OfficePinVal');"  maxlength="6">

        <div style="clear:both;"></div>
        <div id="OfficePinVal"></div>
     

      <div style="clear:both;"></div>
      </span>
      <div class="app-counting bg-success"><span class="app-wow">Wow!</span> You are almost done</div>
      <div style="clear:both; margin-top:15px;"></div>
      <button class="submit-btn" type="submit">Instant Online Approval</button>
    </form>
  </div>
  <div style="clear:both; margin-top:15px;"></div>
</div>
