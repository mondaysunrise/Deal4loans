<?php $npostida=get_the_ID();
?>
<link href="http://www.deal4loans.com/css/wp.css" type="text/css" rel="stylesheet" />
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<script type="text/javascript" src="http://www.deal4loans.com/validate_pl_form.js"></script>
<script type="text/javascript" src="http://www.deal4loans.com/scripts/common.js"></script>
<form name="eduloan_form"  action="http://www.deal4loans.com/insert_education_loan_value.php" method="POST" onSubmit="return chkeducaionloan(document.eduloan_form);"> 
<div class="el_form_box">
<div style="width:100%; margin:auto;"><h1 style="color:#443133; font-size:17px;  margin:0 0 10px; padding:15px 0 3px; text-align:center; font-family:Arial, Helvetica, sans-serif;"><? if($npostida==1916) { echo "Compare Education Loan"; } else { echo "Compare Education Loan";}?></h1></div>
  <div style="clear:both;"></div>
  <input type="hidden" name="Type_Loan" value="Req_Loan_Education">
<input type="hidden" name="source" value="SEO 1"> 
<input type="hidden" name="PostURL" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
  <div class="el_input_box">
    <table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="46%"><span class="frmbldtxt" style="padding-top:3px; ">Full Name :</span></td>
        <td width="54%"><input type="text" name="Name" id="Name" style="width:149px;" maxlength="30"  tabindex="1" /></td>
      </tr>
    </table>
  </div>
  <div class="el_input_box">
    <table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td><span class="frmbldtxt" style="padding-top:3px; ">Country of Study  :</span></td>
        <td align="right"><select name="Country" id="Country" style="width:154px;" tabindex="7">
                        <option value="1">India</option>
						<option value="2">UK</option>
						<option value="3">USA</option>
						<option value="4">Other Country</option>
                     </select></td>
      </tr>
    </table>
  </div>
  <div class="el_input_box">
    <table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td><span class="frmbldtxt">Mobile No : </span></td>
        <td align="right">
        <table width="80%" cellpadding="0" cellapscing="0"><tr><td class="frmbldtxt"> +91</td><td class="frmbldtxt"><input type="text" style="width:130px;" name="Phone" id="Phone" maxlength="10"   onkeyup="intOnly(this);" onkeypress="intOnly(this)"; onchange="intOnly(this);" onblur="return Decorate1('')"  tabindex="10"/></td></tr></table></td>
      </tr>
    </table>
  </div>
  <div style="clear:both;"></div>
  <div class="el_input_box">
    <table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="46%"><span class="frmbldtxt">DOB :</span></td>
        <td width="54%"><input name="day" type="text" id="day"  value="DD" style="  width:35px; " onblur="onBlurDefault(this,'dd');" onfocus="onFocusBlank(this,'dd');" maxlength="2" onkeyup="intOnly(this);" onkeypress="intOnly(this);" tabindex="2"/>
                         <input  name="month" type="text" id="month" style="width:35px; " value="MM" onblur="onBlurDefault(this,'mm');" onfocus="onFocusBlank(this,'mm');" maxlength="2" onkeyup="intOnly(this);" onkeypress="intOnly(this);" tabindex="3"/>
          <input name="year" type="text" id="year" style="width:50px; " value="YYYY" onblur="onBlurDefault(this,'yyyy');" onfocus="onFocusBlank(this,'yyyy');" maxlength="4" onkeyup="intOnly(this);" onkeypress="intOnly(this);" onchange="insertData();" tabindex="4"/></td>
      </tr>
    </table>
  </div>
  
  <div class="el_input_box">
    <table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="43%"><span class="frmbldtxt">Course of Study :</span></td>
        <td width="57%"><select name="Course" id="Course" style="width:154px;" onchange="othercity1();" tabindex="8">
                        <option value="0">Please Select</option>
                        <option value="1">MBA</option>
						<option value="2">Post Graduation Courses</option>
						<option value="3">Graduation Courses</option>
						<option value="4">Other Courses</option>
                     </select></td>
      </tr>
    </table>
  </div>
  
  <div class="el_input_box">
    <table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="43%"><span class="frmbldtxt">Email ID : </span></td>
        <td width="57%"><input type="text" name="Email" id="Email"  style="width:149px;" onchange="insertData();" tabindex="9" /></td>
      </tr>
    </table>
  </div>
  <div style="clear:both;"></div>
   <div class="el_input_box">
    <table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="45%"><span class="frmbldtxt"> Co-borrower's* Income:</span></td>
                     <td height="28" class="frmbldtxt"><table width="80%" cellpadding="0" cellapscing="0"><tr><td class="frmbldtxt"><input name="Coborrower_Income" id="Coborrower_Income" style="width:150px;" maxlength="30"  tabindex="1" /></td></tr></table></td>
      </tr>
    </table>
  </div>
   <div class="el_input_box">
    <table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="43%"><span class="frmbldtxt">Residence City :</span></td>
        <td width="57%"><select name="City" style="width:154px;">
<option value="Please Select">Please Select</option>
  <option value="Ahmedabad">Ahmedabad</option>
                                <option value="Aurangabad">Aurangabad</option>
                                <option value="Bangalore">Bangalore</option>
                                <option value="Baroda">Baroda</option>
                                <option value="Bhopal">Bhopal</option>
                                <option value="Bhubneshwar">Bhubneshwar</option>
                                <option value="Chandigarh">Chandigarh</option>
                                <option value="Chennai">Chennai</option>
                                <option value="Cochin">Cochin</option>
                                <option value="Coimbatore">Coimbatore</option>
                                <option value="Cuttack">Cuttack</option>
                                <option value="Dehradun">Dehradun</option>
                                <option value="Delhi">Delhi</option>
                                <option value="Faridabad">Faridabad</option>
                                <option value="Gaziabad">Gaziabad</option>
                                <option value="Gurgaon">Gurgaon</option>
                                <option value="Guwahati">Guwahati</option>
                                <option value="Hosur">Hosur</option>
                                <option value="Hyderabad">Hyderabad</option>
                                <option value="Indore">Indore</option>
                                <option value="Jabalpur">Jabalpur</option>
                                <option value="Jaipur">Jaipur</option>
                                <option value="Jamshedpur">Jamshedpur</option>
                                <option value="Kanpur">Kanpur</option>
                                <option value="Kochi">Kochi</option>
                                <option value="Kolkata">Kolkata</option>
                                <option value="Lucknow">Lucknow</option>
                                <option value="Ludhiana">Ludhiana</option>
                                <option value="Madurai">Madurai</option>
                                <option value="Mangalore">Mangalore</option>
                                <option value="Mysore">Mysore</option>
                                <option value="Mumbai">Mumbai</option>
                                <option value="Nagpur">Nagpur</option>
                                <option value="Nasik">Nasik</option>
                                <option value="Navi Mumbai">Navi Mumbai</option>
                                <option value="Noida">Noida</option>
                                <option value="Patna">Patna</option>
                                <option value="Pune">Pune</option>
                                <option value="Ranchi">Ranchi</option>
                                <option value="Sahibabad">Sahibabad</option>
                                <option value="Surat">Surat</option>
                                <option value="Thane">Thane</option>
                                <option value="Thiruvananthapuram">Thiruvananthapuram</option>
                                <option value="Trivandrum">Trivandrum</option>
                                <option value="Trichy">Trichy</option>
                                <option value="Vadodara">Vadodara</option>
                                <option value="Vishakapatanam">Vishakapatanam</option>
                                <option value="Others">Others</option>
	 </select></td>
      </tr>
    </table>
  </div>
   <div class="el_input_box">
    <table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="43%"><span class="frmbldtxt">Loan Amount :</span></td>
        <td width="57%"><input name="Loan_Amount" id="Loan_Amount" tabindex="12" type="text" style="width:149px;" maxlength="10" onfocus="this.select();" onchange="ShowHide('loanShow','Loan_Amount');"  onkeyup="intOnly(this);getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');"  onkeydown="getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" onkeypress="intOnly(this); getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" onblur="getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" /> </td>
      </tr>
      <tr>
                <td colspan="2" class="frmbldtxt"><span id='formatedlA' style='font-size:11px;
font-weight:normal; color:#333333;font-Family:Verdana;'></span><span id='wordloanAmount' style='font-size:11px;
font-weight:normal; color:#333333;font-Family:Verdana;text-transform: capitalize;'></span></td>
              </tr>
    </table>
  </div>
    <div style="clear:both;"></div>
    <div class="el_input_box">
    <table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="45%"><span class="frmbldtxt">Collateral Security :</span></td>
        <td width="55%" class="frmbldtxt"><table width="80%" cellpadding="0" cellapscing="0"><tr><td width="49%" class="frmbldtxt"><input type="radio" value="Yes" name="Collateral_Security" tabindex="5" /> Yes &nbsp;</td><td width="51%" class="frmbldtxt"> <input type="radio" value="No" name="Collateral_Security"  tabindex="6"/> No</td></tr></table></td>
      </tr>
    </table>
  </div>
  
  <div class="el_input_box">
    <table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="43%"><span class="frmbldtxt">Other City :</span></td>
        <td width="57%"><input type="text" name="City_Other" id="City_Other" Value="Other City" style="width:154px;" tabindex="11" disabled> </td>
      </tr>
    </table>
  </div>
  <div style="clear:both;"></div>
  <div class="el_terms_box">    <input type="checkbox" name="accept" style="border:none;" >
I authorize Deal4loans.com & its partnering Banks to call me with reference to my loan application  & Agree to <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow">Privacy Policy</a> and <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow">Terms and Conditions</a></div>
<div class="el_btn_box"><input type="submit" style="border: 0px none ; background-image: url(http://www.deal4loans.com/new-images/quote-btn.jpg); width: 128px; height: 31px; margin-bottom: 0px;" value=""/></div>

    </div>
</form>