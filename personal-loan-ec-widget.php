<link href="css/mobile-business-loan-styles.css" type="text/css" rel="stylesheet" />
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<!--<script src="http://code.jquery.com/jquery-1.10.2.js"></script>-->
<script type="text/javascript" src="ajax-dynamic-pllist.js"></script>
<script type="text/javascript" src="ajax.js"></script>
<script type="text/javascript" src="scripts/common.js"></script>
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
form {
	display: inline;
}
</style>
<script type="text/javascript">
function addIdentified()
{
		var ni1 = document.getElementById('myDiv1');
	    ni1.innerHTML = '<div class="blnew-input-box" style="margin-top:10px"><div><strong>Card held since?</strong></div>    <div><select size="1" name="Card_Vintage" class="form-select" onchange="validateDiv(\'vintageVal\');" ><option value="0">Please select</option> <option value="1">Less than 6 months</option> <option value="2">6 to 9 months</option> <option value="3">9 to 12 months</option><option value="4">more than 12 months</option> </select></div><div><div id="vintageVal"></div></div></div>';
					
		return true;
}	
function removeIdentified()
{
	var ni1 = document.getElementById('myDiv1');
	var ni2 = document.getElementById('myDiv2');		
	ni1.innerHTML = '';
	ni2.innerHTML = '';
	return true;
}	

$(document).ready(function(){
	$("#Employment_Status1").click(function(){
	var ni1 = document.getElementById('myDiv3');
	ni1.innerHTML = '<div class="salaried-form-wrapper" id="salariedOptions">  <div class="blmainforminn2" id="CompName"><div class="form-css-head">Company Name:</div>  <div class="inputwrapprer"><input name="Company_Name" id="Company_Name" type="text" class="form-input" onkeyup="ajax_showOptions(this,\'getCountriesByLetters\',event, \'http://www.deal4loans.com/ajax-list-plcompanies.php\')" onkeydown="validateDiv(\'companyNameVal\');"  /> </div><div id="companyNameVal"></div></div><div class="blmainforminn2" id="AnnualIncome"><div class="form-css-head">Annual Income:</div><div class="inputwrapprer"><input type="text" name="IncomeAmount" id="IncomeAmount" class="form-input"  onkeyup="intOnly(this); getDiToWordsIncome(\'IncomeAmount\',\'formatedIncome\',\'wordIncome\');" onKeyPress="intOnly(this);"  onblur="getDiToWordsIncome(\'IncomeAmount\',\'formatedIncome\',\'wordIncome\');" onKeyDown="validateDiv(\'IncomeAmountVal\');" autocomplete="off" /><div id="IncomeAmountVal"></div></div><span id=\'formatedIncome\'></span> <span id=\'wordIncome\'></span> </div><div class="blmainforminn2" id="CityOptions"><div class="form-css-head">City </div><div class="inputwrapprer"><select name="City" id="City" class="form-select" onChange="validateDiv(\'cityVal\'); addPersonalDetails(); othercity1(); addhdfclife();"  tabindex="7"><?=plgetCityList($City)?></select></div><div id="cityVal"></div></div></div>';
	 return true;
	});

$(".d4l-inputox,.form-select").change(function (){
	var cityval=$("#City").val();
if(cityval!='' && cityval!='Please Select')
	{
	var ni1 = document.getElementById('personalDetails');
	var ni2 = document.getElementById('addPadding');
	var ni3 = document.getElementById('addSubmit');
	var ni5 = document.getElementById('getImageScroll');
	
	ni1.innerHTML = '<div style="clear:both;"></div><div style="text-align:left; text-indent:10px; "><strong>Personal Details</strong></div><div class="termtext"><img src="images/security.png" width="14" height="16"> Your Information is secure with us and will not be shared without your consent</div></div><div class="blnew-input-box">  <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td height="25"><strong>Full Name:</strong></td>    </tr>    <tr>      <td height="25">   <input name="Name" id="Name" type="text"  class="form-input" onkeydown="validateDiv(\'nameVal\');" autocomplete="off" />   <div id="nameVal"></div>  </td>    </tr>    </table></div><div class="blnew-input-box">  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">    <tr>      <td height="25"><strong>Email ID :</strong></td>    </tr>    <tr>      <td height="25">  <input name="Email" id="Email" type="text" class="form-input" onkeypress="validateDiv(\'emailVal\');" autocomplete="off" />          <div id="emailVal"></div>   </td>    </tr>      </table></div><div class="blnew-input-box">  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">    <tr>      <td height="25" colspan="2"><strong>Mobile:</strong></td>    </tr>        <tr>      <td width="4%" height="25"><div style="float:left; margin-top:5px;"><em>+91</em></div>          </td><td width="96%"><input name="Phone" id="Phone" maxlength="10" onkeyup="intOnly(this);" onkeypress="intOnly(this)"; onchange="intOnly(this);" type="text" class="form-input" onkeydown="validateDiv(\'phoneVal\');" autocomplete="off" /> <div id="phoneVal"></div> </td></tr>    </table></div><div class="blnew-input-box">  <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td height="25"><strong>Age:</strong></td></tr><tr><td height="25"><select onchange="validateDiv(\'AgeVal\');" class="form-select" name="Age" id="Age"><option value="">Select Age</option><?php for($a=18;$a<=65;$a++) {?><option value="<?php echo $a;?>"><?php echo $a;?></option><?php }?></select><div id="AgeVal"></div></td>    </tr>    </table></div><div style="clear:both;"></div><div class="blnew-input-box" style="margin-top:10px">  <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td height="25"><strong>Credit Card:</strong></td></tr><tr><td height="25" style="width:40%;"> 	<input type="radio" name="CC_Holder" id="CC_Holder" value="1" class="css-checkbox" onclick="return addIdentified();" /><label for="CC_Holder" class="css-label radGroup2">Yes</label></td><td height="25"> <input type="radio" name="CC_Holder" id="CC_Holder2" value="0" class="css-checkbox" onclick="removeIdentified();" checked="checked" />            <label for="CC_Holder2" class="css-label radGroup2">No</label></td>    </tr>    </table></div><div class="form-inputox" id="myDiv1"></div>';
	ni3.innerHTML = '<div style="clear:both; height:5px;"></div><div class="new_terms_box"><span class="termtext">  <input name="accept" type="checkbox" checked="checked" onclick="validateDiv(\'acceptVal\');" /> I authorize Deal4loans.com & its <a href="http://www.deal4loans.com/pl-partnering-banks.php" target="_blank" rel="nofollow" text-decoration:underline!important; > partnering banks</a> to contact me to explain the product & I Agree to <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow" text-decoration:underline;>Privacy policy</a> and <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow"  class="text" style="text-decoration:underline;">Terms and Conditions</a>.                 <div id="acceptVal"></div></span></div><div style="clear:both;"></div><div id="hdfclife"></div><div style="clear:both;"></div>';
	}
	
});
/// SElf Employee
$("#CC_Holder2").click(function(){
	var ni1 = document.getElementById('PersonalDetailsSelf');
	ni1.innerHTML = '<div id="personal-details" class="personal-details-main-wrapper"><div class="form-css-head margin-top-business-loan"> Personal Details</div><div><img src="images/security.png" width="14" height="16" alt="lock"> Your Information is secure with us and will not be shared without your consent</div><div class="blmainforminn2"><div class="form-css-head">Name </div><div class="inputwrapprer"><input name="Name" id="FullName" type="text" class="form-input" onKeyDown="validateDiv(\'FullNameVal\')"/> </div> <div id="FullNameVal"> </div> </div><div class="blmainforminn2 margin-left15"><div class="form-css-head">Mobile Number </div>  <div class="inputwrapprer"> <input name="Phone" id="MobileNum" type="text"  maxlength="10" onkeyup="intOnly(this);" onkeypress="intOnly(this)"; onchange="intOnly(this);" class="form-input" onKeyDown="validateDiv(\'MobileNumVal\')"></div><div id="MobileNumVal"> </div></div><div class="blmainforminn2 margin-left15"><div class="form-css-head">City </div> <div class="inputwrapprer"><select name="City" id="City" class="form-select" onChange="validateDiv(\'City2Val\'); othercity1();"><?=plgetCityList($City); ?></select></div><div id="City2Val"> </div> </div>  <div style="clear:both; height:0px;"></div><div class="blmainforminn2">  <div class="form-css-head">E-Mail ID</div><div class="inputwrapprer">  <input name="Email" type="text" class="form-input" onKeyDown="validateDiv(\'EmailIDVal\')">            </div> <div id="EmailIDVal"> </div> </div> <div class="blmainforminn2 margin-left15">    <div class="form-css-head">Age </div> <div class="inputwrapprer">      <select onchange="validateDiv(\'AgeVal\');" class="form-select" name="Age" id="Age"><option value="">Select Age</option><?php for($a=18;$a<=65;$a++) {?><option value="<?php echo $a;?>"><?php echo $a;?></option><?php }?></select><div id="AgeVal"></div> </div> </div> <div class="blmainforminn2 margin-left15"><div class="form-css-head">Residence Status </div> <div class="inputwrapprer"><input type="radio" name="Residential_Status" id="Residence_Status1" value="1" class="css-checkbox" /> <label for="Residence_Status1" class="css-label radGroup2">Owned</label> <input type="radio"name="Residential_Status" id="Residence_Status2" value="0" class="css-checkbox" /> <label for="Residence_Status2" class="css-label radGroup2">Rented</label></div> </div><div style="clear:both;"></div><div class="blmainforminn2 margin-left15"><div class="form-css-head">Office Status</div>  <div class="inputwrapprer"><input type="radio" name="Office_Status" id="Office_Status1" value="1" class="css-checkbox" /><label for="Office_Status1" class="css-label radGroup2">Owned</label><input type="radio"name="Office_Status" id="Office_Status2" value="0" class="css-checkbox" /> <label for="Office_Status2" class="css-label radGroup2">Rented</label> </div><div class="inputwrapprer"></div>  </div><div style="clear:both; height:15px;"></div><input type="checkbox" name="checkbox" id="checkbox" checked />  I authorize Deal4loans.com & its <a href="http://www.deal4loans.com/pl-partnering-banks.php" target="_blank">partnering banks</a> to contact me to explain the product & I Agree to <a href="http://www.deal4loans.com/Privacy.php" target="_blank">Privacy policy</a> and <a href="http://www.deal4loans.com/Privacy.php" target="_blank">Terms and Conditions</a>.</div>';
	});

$("#holding-card-ar").click(function(){
	var ni1 = document.getElementById('PersonalDetailsSelf');
	ni1.innerHTML = '<div id="personal-details" class="personal-details-main-wrapper"><div class="form-css-head margin-top-business-loan"> Personal Details</div><div><img src="images/security.png" width="14" height="16" alt="lock"> Your Information is secure with us and will not be shared without your consent</div><div class="blmainforminn2"><div class="form-css-head">Name </div><div class="inputwrapprer"><input name="Name" id="FullName" type="text" class="form-input" onKeyDown="validateDiv(\'FullNameVal\')"/> </div> <div id="FullNameVal"> </div> </div><div class="blmainforminn2 margin-left15"><div class="form-css-head">Mobile Number </div>  <div class="inputwrapprer"> <input name="Phone" id="MobileNum" type="text"  maxlength="10" onkeyup="intOnly(this);" onkeypress="intOnly(this)"; onchange="intOnly(this);" class="form-input" onKeyDown="validateDiv(\'MobileNumVal\')"></div><div id="MobileNumVal"> </div></div><div class="blmainforminn2 margin-left15"><div class="form-css-head">City </div> <div class="inputwrapprer"><select name="City" id="City" class="form-select" onChange="validateDiv(\'City2Val\'); othercity1();"><?=plgetCityList($City); ?></select></div><div id="City2Val"> </div> </div>  <div style="clear:both; height:0px;"></div><div class="blmainforminn2">  <div class="form-css-head">E-Mail ID</div><div class="inputwrapprer">  <input name="Email" type="text" class="form-input" onKeyDown="validateDiv(\'EmailIDVal\')">            </div> <div id="EmailIDVal"> </div> </div> <div class="blmainforminn2 margin-left15">    <div class="form-css-head">Age </div> <div class="inputwrapprer">      <select onchange="validateDiv(\'AgeVal\');" class="form-select" name="Age" id="Age"><option value="">Select Age</option><?php for($a=18;$a<=65;$a++) {?><option value="<?php echo $a;?>"><?php echo $a;?></option><?php }?></select><div id="AgeVal"></div> </div> </div> <div class="blmainforminn2 margin-left15"><div class="form-css-head">Residence Status </div> <div class="inputwrapprer"><input type="radio" name="Residential_Status" id="Residence_Status1" value="1" class="css-checkbox" /> <label for="Residence_Status1" class="css-label radGroup2">Owned</label> <input type="radio"name="Residential_Status" id="Residence_Status2" value="0" class="css-checkbox" /> <label for="Residence_Status2" class="css-label radGroup2">Rented</label></div> </div><div style="clear:both;"></div><div class="blmainforminn2 margin-left15"><div class="form-css-head">Office Status</div>  <div class="inputwrapprer"><input type="radio" name="Office_Status" id="Office_Status1" value="1" class="css-checkbox" /><label for="Office_Status1" class="css-label radGroup2">Owned</label><input type="radio"name="Office_Status" id="Office_Status2" value="0" class="css-checkbox" /> <label for="Office_Status2" class="css-label radGroup2">Rented</label> </div><div class="inputwrapprer"></div>  </div><div style="clear:both; height:15px;"></div><input type="checkbox" name="checkbox" id="checkbox" checked />  I authorize Deal4loans.com & its <a href="http://www.deal4loans.com/pl-partnering-banks.php" target="_blank">partnering banks</a> to contact me to explain the product & I Agree to <a href="http://www.deal4loans.com/Privacy.php" target="_blank">Privacy policy</a> and <a href="http://www.deal4loans.com/Privacy.php" target="_blank">Terms and Conditions</a>.</div>';
	});

});
</script>
<link href="css/personal-loan-styles.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="js/validation.js"></script>
<div class="d4l_inner_wrapper">
  <!--<form name="personalloan_form" action="firststep_insert_personalloans.php" method="POST" >-->
<form name="personalloan_form" action="insert_personal_loan_value_step_under.php" method="POST" onsubmit="return formValidate();" >
    <input type="hidden" name="Type_Loan" value="<?php echo $TypeLoan;?>" />
    <input type="hidden" name="source" value="<?php echo $source;?>" />
    <input type="hidden" name="PostURL" value="<?php echo $PostURL;?>">
    <input type="hidden" name="section" value="BL16June15" />
    <div class="blmainform" id="self-employed-frm">
      <div class="newui-left">
        <h2 class="pl-h2"><?php echo $TagLine;?></h2>
      </div>
      <div class="offerimg"><a href="http://www.deal4loans.com/lowestratequote.php" style="text-decoration:none;" target="_blank"><img src="new-images/apply-personal-loan-continue-final.jpg" width="203" height="58" border="0" /></a></div>
      <div style="clear:both"></div>
      <div class="blmainforminn">
        <div class="form-css-head">Loan Amount</div>
        <div class="inputwrapprer">
          <input name="Loan_Amount" id="Loan_Amount" maxlength="8" type="text" class="form-input" onkeyup="intOnly(this);  getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" onblur="getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" onkeypress="intOnly(this);" onkeydown="validateDiv('loanAmtVal');" />
        </div>
        <div id="loanAmtVal"></div>
        <span id='formatedlA'></span> <span id='wordloanAmount'></span> </div>
      <div class="blmainforminn" id="employment-status-ar">
        <div class="form-css-head">Employment Status</div>
        <div class="inputwrapprer">
          <input type="radio" name="Employment_Status" id="Employment_Status1" value="1" class="css-checkbox" onClick="validateDiv('EmpStatus');" />
          <label for="Employment_Status1" class="css-label radGroup2">Salaried</label>
          <input type="radio" name="Employment_Status" id="Employment_Status2" value="0"  onClick="validateDiv('EmpStatus');" class="css-checkbox" />
          <label for="Employment_Status2" class="css-label radGroup2">Self-Employed</label>
        </div>
        <div id="EmpStatus"></div>
      </div>
      <div class="quotebtn" id="get-quote-ar">
        <input type="submit" name="button" id="button" value="Get Quote"  onclick="return formValidate();"  class="submit-btn">
      </div>
      <div style="clear:both;"></div>
      <div class="d4l-inputox" id="myDiv3"></div>
      <div id="personalDetails"> </div>
      <div style="clear:both;"></div>
      <div id="addSubmit"></div>
      <div style="clear:both;"></div>
      <div id="SelfEmployee">
        <div class="blmainforminn margin-top-business-loan" id="running-business-ar" style="display:none;">
          <div class="form-css-head">You Are Running Business Since ?</div>
          <div class="inputwrapprer">
            <input type="radio" name="Total_Experience" id="running_business1" value="1" class="css-checkbox" onClick="validateDiv('TotalExperienceVal')" />
            <label for="running_business1" class="css-label radGroup2">Less Than 2 Yrs</label>
            <input type="radio" name="Total_Experience" id="running_business2" value="2.5" class="css-checkbox" onClick="validateDiv('TotalExperienceVal')"/>
            <label for="running_business2" class="css-label radGroup2">2 To 3 Yrs</label>
          </div>
          <div class="inputwrapprer">
            <input type="radio" name="Total_Experience" id="running_business3" value="4" class="css-checkbox" onClick="validateDiv('TotalExperienceVal')"/>
            <label for="running_business3" class="css-label radGroup">3 To 5 Yrs</label>
            <input type="radio" name="Total_Experience" id="running_business4" value="5" class="css-checkbox" onClick="validateDiv('TotalExperienceVal')"/>
            <label for="running_business4" class="css-label radGroup2">5 Yrs & Above</label>
            <div id="TotalExperienceVal"> </div>
          </div>
        </div>
        <div class="blmainforminn margin-top-business-loan" id="annual-ancome-ar" style="display:none;">
          <div class="form-css-head">Your Annual Income/ ITR </div>
          <div class="inputwrapprer">
            <input type="radio" name="IncomeAmount" id="IncomeAmount1" value="200000" class="css-checkbox" onClick="validateDiv('NetSalaryVal')"/>
            <label for="IncomeAmount1" class="css-label radGroup2">Upto 2 Lacs</label>
            <input type="radio" name="IncomeAmount" id="IncomeAmount2" value="250000" class="css-checkbox" onClick="validateDiv('NetSalaryVal')"/>
            <label for="IncomeAmount2" class="css-label radGroup2">2 To 3 Lacs</label>
          </div>
          <div class="inputwrapprer">
            <input type="radio" name="IncomeAmount" id="IncomeAmount3" value="450000" class="css-checkbox" onClick="validateDiv('NetSalaryVal')"/>
            <label for="IncomeAmount3" class="css-label radGroup2">3 To 5 Lacs</label>
            <input type="radio" name="IncomeAmount" id="IncomeAmount4" value="550000" class="css-checkbox" onClick="validateDiv('NetSalaryVal')"/>
            <label for="IncomeAmount4" class="css-label radGroup2">5 Lacs & Above</label>
            <div id="NetSalaryVal"> </div>
          </div>
        </div>
        <div class="blmainforminn margin-top-business-loan" id="annual-turnover-ar" style="display:none;">
          <div class="form-css-head">Annual Turnover For Your Business </div>
          <div class="inputwrapprer">
            <input type="radio" name="Annual_Turnover" id="Annual_Turnover1" value="1" class="css-checkbox" onClick="validateDiv('AnnualTurnoverVal')"/>
            <label for="Annual_Turnover1" class="css-label radGroup2">Upto 50 Lacs</label>
            <input type="radio" name="Annual_Turnover" id="Annual_Turnover2" value="2" class="css-checkbox" onClick="validateDiv('AnnualTurnoverVal')"/>
            <label for="Annual_Turnover2" class="css-label radGroup2">50 Lacs To 1 Cr</label>
          </div>
          <div class="inputwrapprer">
            <input type="radio" name="Annual_Turnover" id="Annual_Turnover3" value="3" class="css-checkbox" onClick="validateDiv('AnnualTurnoverVal')" />
            <label for="Annual_Turnover3" class="css-label radGroup2" >1 Cr To 3 Crs</label>
            <input type="radio" name="Annual_Turnover" id="Annual_Turnover4" value="4" class="css-checkbox" onClick="validateDiv('AnnualTurnoverVal')"/>
            <label for="Annual_Turnover4" class="css-label radGroup2">3 Crs & Above</label>
            <div id="AnnualTurnoverVal"> </div>
          </div>
        </div>
        <div style="clear:both;"></div>
        <div class="blmainforminn" id="existing-loan-ar" style="display:none;">
          <div class="form-css-head">Any Existing Loan </div>
          <div class="inputwrapprer">
            <input type="radio" name="Existing_Loan" id="Existing_Loan1" value="1" class="css-checkbox" onClick="validateDiv('ExistingLoanVal')"/>
            <label for="Existing_Loan1" class="css-label radGroup2" >Yes</label>
            <input type="radio" name="Existing_Loan" id="Existing_Loan2" value="2" class="css-checkbox" onClick="validateDiv('ExistingLoanVal')"/>
            <label for="Existing_Loan2" class="css-label radGroup2">No</label>
            <div id="ExistingLoanVal"> </div>
          </div>
          <div id="loan-type-ar" style="display:none;">
            <div class="form-css-head margin-top-business-loan">Loan Type</div>
            <div class="inputwrapprer">
              <input type="checkbox" name="Loan_Any" id="Loan_Type1" class="css-checkbox" value="cl" onClick="validateDiv('LoanAnyVal')"/>
              <label for="Loan_Type1" class="css-label-check">Auto Loan</label>
              <input type="checkbox" name="Loan_Any" id="Loan_Type2" class="css-checkbox" value="hl" onClick="validateDiv('LoanAnyVal')"/>
              <label for="Loan_Type2" class="css-label-check">Home Loan</label>
            </div>
            <div class="inputwrapprer">
              <input type="checkbox" name="Loan_Any" id="Loan_Type3" class="css-checkbox" value="odl" onClick="validateDiv('LoanAnyVal')"/>
              <label for="Loan_Type3" class="css-label-check">Over Draft Loan</label>
              <input type="checkbox" name="Loan_Any" id="Loan_Type4" class="css-checkbox" value="other" onClick="validateDiv('LoanAnyVal')"/>
              <label for="Loan_Type4" class="css-label-check">Other</label>
              <div id="LoanAnyVal"> </div>
            </div>
          </div>
          <div id="loan-emi-paid-ar" style="display:none;">
            <div class="form-css-head margin-top-business-loan">EMIs Paid </div>
            <div class="inputwrapprer">
              <input type="radio" name="EMI_Paid" id="Emi_Paid1" value="1" class="css-checkbox" onClick="validateDiv('EMIPaidVal')"/>
              <label for="Emi_Paid1" class="css-label radGroup2" >0 To 6</label>
              <input type="radio" name="EMI_Paid" id="Emi_Paid2" value="2" class="css-checkbox" onClick="validateDiv('EMIPaidVal')"/>
              <label for="Emi_Paid2" class="css-label radGroup2">6 To 9</label>
            </div>
            <div class="inputwrapprer">
              <input type="radio" name="EMI_Paid" id="Emi_Paid3" value="3" class="css-checkbox" onClick="validateDiv('EMIPaidVal')"/>
              <label for="Emi_Paid3" class="css-label radGroup2">9 To 12</label>
              <input type="radio" name="EMI_Paid" id="Emi_Paid4" value="4" class="css-checkbox" onClick="validateDiv('EMIPaidVal')"/>
              <label for="Emi_Paid4" class="css-label radGroup2">More than 12</label>
              <div id="EMIPaidVal"> </div>
            </div>
          </div>
        </div>
        <div class="blmainforminn" id="credit-card-ar" style="display:none;">
          <div class="form-css-head">Any Credit Card </div>
          <div class="inputwrapprer">
            <input type="radio" name="CC_Holder" id="CC_Holder1" value="1" class="css-checkbox" onClick="validateDiv('CCHolderVal')"/>
            <label for="CC_Holder1" class="css-label radGroup2">Yes</label>
            <input type="radio"name="CC_Holder" id="CC_Holder2" value="0" class="css-checkbox" onClick="validateDiv('CCHolderVal')"/>
            <label for="CC_Holder2" class="css-label radGroup2">No </label>
            <div id="CCHolderVal"> </div>
          </div>
          <div id="holding-card-ar" style="display:none;">
            <div class="form-css-head margin-top-business-loan">Holding This Credit Card Since </div>
            <div class="inputwrapprer">
              <input type="radio" name="Card_Vintage" id="Card_Vintage1" value="1" class="css-checkbox" onClick="validateDiv('CardVintageVal')"/>
              <label for="Card_Vintage1" class="css-label radGroup2">0 To 6 Months</label>
              <input type="radio" name="Card_Vintage" id="Card_Vintage2" value="2" class="css-checkbox" onClick="validateDiv('CardVintageVal')"/>
              <label for="Card_Vintage2" class="css-label radGroup2">6 To 9 Months </label>
            </div>
            <div class="inputwrapprer">
              <input type="radio" name="Card_Vintage" id="Card_Vintage3" value="3"  class="css-checkbox" onClick="validateDiv('CardVintageVal')"/>
              <label for="Card_Vintage3" class="css-label radGroup2" >9 To 12 Months</label>
              <input type="radio"name="Card_Vintage" id="Card_Vintage4" value="4" class="css-checkbox" onClick="validateDiv('CardVintageVal')"/>
              <label for="Card_Vintage4" class="css-label radGroup2">More Than 12 Months</label>
              <div id="CardVintageVal"> </div>
            </div>
          </div>
        </div>
        <div style="clear:both;"></div>
        <div id="PersonalDetailsSelf"> </div>
      </div>
      <div class="quotebtnnew" id="get-quote-ar2" style="display:none;">
        <input type="submit" name="button" id="button" value="Get Quote"  onclick="ga('send', 'event', 'Get Personal Loan Quote', 'Get Quote Personal');" class="submit-btn">
      </div>
      <div style="clear:both;"></div>
    </div>
  </form>
  <div style="clear:both;"></div>
</div>
