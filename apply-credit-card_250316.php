<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>deal4loans.com</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<link href="ccmobile/css/creditcard-lp-mobile-ui.css" type="text/css" rel="stylesheet">
<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'/>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<link href="ccmobile/css/font-awesome.css" type="text/css" rel="stylesheet" >
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script type="application/javascript" src="ccmobile/js/validate.js"></script>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<script>
  $(function() {
    var availableTags = [
       'Ahmedabad','Aurangabad','Bangalore','Baroda','Bhiwadi','Bhopal','Bhubneshwar','Chandigarh','Chennai','Cochin','Coimbatore','Cuttack','Dehradun','Delhi','Faridabad','Gaziabad','Gurgaon','Guwahati','Hosur','Hyderabad','Indore','Jabalpur','Jaipur','Jamshedpur','Kanpur','Kochi','Kolkata','Lucknow','Ludhiana','Madurai','Mangalore','Mysore','Mumbai','Nagpur','Nasik','Navi Mumbai','Pune','Ranchi','Raipur','Rewari','Sahibabad','Surat','Thane','Thiruvananthapuram','Trivandrum','Trichy','Vadodara','Vishakapatanam','Vizag', 'Others',
    ];
    $( "#City" ).autocomplete({
      source: availableTags
    });
  });
  </script>
<script type="text/javascript" src="/ajax.js"></script>
<script type="text/javascript" src="/ajax-dynamic-httpscclist.js"></script>
<style type="text/css">
.hintanchor {
	color: #CC0000
}
</style>
<style type="text/css">
/* Big box with list of options */


#ajax_listOfOptions {
	position: absolute;	/* Never change this one */
	width: 250px;	/* Width of box */
	height: 160px;	/* Height of box */
	overflow: auto;	/* Scrolling features */
	border: 1px solid #317082;	/* Dark green border */
	background-color: #FFF;	/* White background color */
	color: black;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	text-align: left;
	font-size: 10px;
	z-index: 50;
}
#ajax_listOfOptions div {	/* General rule for both .optionDiv and .optionDivSelected */
	margin: 1px;
	padding: 1px;
	cursor: pointer;
	font-size: 10px;
}
#ajax_listOfOptions .optionDivSelected { /* Selected item in the list */
	background-color: #2375CB;
	color: #FFF;
}
#ajax_listOfOptions_iframe {
	background-color: #F00;
	position: relative;
	z-index: 5;
}
</style>
<script type="application/javascript">
function CharsetKeyOnly(evt)
{

		
	var charCode=(evt.which)?evt.which:event.keyCode
if((charCode>33)&&(charCode<58))
return false;
document.getElementById("personalDetail").style.display="block";
return true;
	
}

</script>

</head>
<body>
<div class="mobile-header">
  <div class="logo"><img src="ccmobile/images/logo-d4l.jpg" width="133" height="48" alt="logo"></div>
</div>
<div class="mobile-main-wrapper">
  <div class="mobile-form-left">
    <div class="head_2 heading-margin-bottom">Professional Details</div>
    <div class="product-listing-new"> </div>
    <div style="clear:both;"></div>
    <form  name="creditcard_form" id="creditcard_form" action="" method="post" onSubmit="return ckhcreditcard(document.creditcard_form); " >
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
      <hr>
      <div style="clear:both;"></div>
      <span id="personalDetail" style="display:none;">
      <div class="head_2">Personal Details</div>
      <p class="smalltext"><img src="ccmobile/images/privacy-lock.png" width="9" height="10" alt="lock"> Your Information is secure with us and will not be shared without your consent</p>
      <div style="clear:both;"></div>
      <div style="clear:both;"></div>
      <input name="Full_Name" id="Full_Name" type="text" class="mobile-ui-input man-icon input-bottom-margin"  placeholder="Your Name" onKeyPress="return isCharsetKey(event);" onkeydown="validateDiv('nameVal');">
      <div id="nameVal"></div>
      <div style="clear:both;"></div>
      <input name="Phone" id="Phone" type="text" class="mobile-ui-input input-bottom-margin mobile-icon" maxlength="10" onkeyup="intOnly(this);" onkeypress="intOnly(this)" ;="" onchange="intOnly(this);" placeholder="Mobile Number" onkeydown="validateDiv('phoneVal');">
      <div id="phoneVal"></div>
      <div style="clear:both;"></div>
      <input name="Email" id="Email" type="text" class="mobile-ui-input input-bottom-margin email-icon" placeholder="Email Id" onkeydown="validateDiv('emailVal');" />
      <div id="emailVal"></div>
      <div style="clear:both;"></div>
      <div class="mobile-ui-input input-bottom-margin dob-icon">
        <div class="dobtext">Date of Birth</div>
        <div class="dobwrapper">
          <select name="day" id="day" class="dobselect" onchange="validateDiv('dayVal');">
            <option value="">DD</option>
            <?php for($d=1; $d<=31; $d++) {?>
            <option value="<?php echo $d;?>"><?php echo $d;?></option>
            <?php }?>
          </select>
          <select name="month" id="month" class="dobselect" onchange="validateDiv('monthVal');">
            <option value="">MM</option>
            <?php for($m=1; $m<=12; $m++) {?>
            <option value="<?php echo $m;?>"><?php echo $m;?></option>
            <?php }?>
          </select>
          <select name="year" id="year" class="dobselect" onchange="validateDiv('yearVal');">
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
      <div style="clear:both;"></div>
      <input name="Company_Name" id="Company_Name" type="text" class="mobile-ui-input input-bottom-margin company-icon" placeholder="Type your company name" onkeydown="validateDiv('companyNameVal');" onkeyup="ajax_showOptions(this,'getCountriesByLetters',event)"  onblur="onBlurDefault(this,'Type Slowly for Autofill');" onfocus="onFocusBlank(this,'Type Slowly for Autofill');">
      <div id="companyNameVal"></div>
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
  <div style="clear:both; margin-top:15px;"></div>
</div>
</body>
</html>