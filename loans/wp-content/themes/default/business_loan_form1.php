<script type="text/javascript" src="http://www.deal4loans.com/js/dropdowntabs.js"></script><script Language="JavaScript" Type="text/javascript" src="http://www.deal4loans.com/scripts/common.js"></script><script src='http://www.deal4loans.com/scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script><script type="text/javascript" src="http://www.deal4loans.com/validate_bl_form.js"></script>
<div class="gl_main_wrapper">
<div class="bl_form_box">
<div class="bl_form_title"><span style="color:#FFF; font-size:24px; text-transform:none;" >Apply Business Loan</span></div>
<div style="clear:both;"></div>
<form name="businessloan_form" method="post" action="http://www.deal4loans.com/insert_personal_loan_value_step1.php" onSubmit="return chkbusinessloan(document.businessloan_form);"> <input type="hidden" name="Type_Loan" value="Req_Loan_business">
<input type="hidden" name="creative" value="<? echo $_REQUEST['creative'] ?>"><input type="hidden" name="section" value="<? echo $_REQUEST['section'] ?>"><input type="hidden" name="source" value="Businessloan WP"><input type="hidden" name="referrer" value="<? echo $_REQUEST['referrer'] ?>"><input type="hidden" name="Activate" id="Activate" ><input type="hidden" name="Employment_Status" id="Employment_Status" value="0"><input type="hidden" name="PostURL" value="<?php echo $_SERVER['REQUEST_URI']; ?>"><div class="bl_input_box">  <table width="97%" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td height="30"><span class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Full Name:</span></td>
      </tr>
    <tr>
      <td height="30"><input name="Name" id="Name" type="text" class="bl_input" onKeyDown="validateDiv('nameVal');" tabindex=1/>
   <div id="nameVal"></div>  </td>
    </tr>
    <tr>
      <td height="30"><span class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">DOB:</span></td>
    </tr>
    <tr>
      <td height="30"><table><tr><td><input name="day" id="day" type="text" class="bl_dd" value="dd" onBlur="onBlurDefault(this,'dd');" onFocus="onFocusBlank(this,'dd');" maxlength="2" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" onKeyDown="validateDiv('dobVal');" tabindex=2/></td><td><input name="month" id="month" class="bl_dd" value="mm" onBlur="onBlurDefault(this,'mm');" onFocus="onFocusBlank(this,'mm');" maxlength="2" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" onKeyDown="validateDiv('dobVal');" tabindex=3/></td><td><input name="year" id="year" type="text" class="bl_yy" value="yyyy" onBlur="onBlurDefault(this,'yyyy');" onFocus="onFocusBlank(this,'yyyy');" maxlength="4" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" onKeyDown="validateDiv('dobVal');" tabindex=4/>
      <div id="dobVal"></div></td></tr></table>
      </td>
    </tr>
    <tr>
      <td height="30"><span class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Mobile:	</span></td>
      <tr>
      <td height="30">
      
      <table><tr><td class="text" style=" padding-top:3px; color:#FFF; font-size:12px; text-transform:none;">+91</td><td class="text" style=" padding-top:3px; color:#FFF; font-size:12px; text-transform:none;">
                 <input name="Phone" id="Phone" maxlength="10" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)"; onChange="intOnly(this);" type="text" class="bl_mobo" onKeyDown="validateDiv('phoneVal');"  tabindex=5/><div id="phoneVal"></div></td></tr></table>
      </td>
      </tr>
    </tr>
  </table>
</div>
<div class="bl_input_box">
  <table width="97%" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td height="30"><span class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">City:</span></td>
    </tr>
    <tr>
      <td height="30"><select name="City" id="City" style=" font-family:Verdana, Geneva, sans-serif; font-size:11px; color:#4c4c4c;" class="bl_input"  onChange="othercity1();" tabindex="6">
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
                                <option value="Navi Mumbai">Navi 
                                  Mumbai</option>
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
                                                  <option value="Vapi">Vapi</option>
				   <option value="Ankleshwar">Ankleshwar</option>
				    <option value="Anand">Anand</option>
					 <option value="Anand">Dahod</option>
					  <option value="Anand">Navsari</option>
                       <option value="Others">Others</option>
                        </select>
                         <div id="cityVal"></div>   </td>
    </tr>
    <tr>
      <td height="30"><span class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Other City:</span></td>
    </tr>
    <tr>
      <td height="30"><input name="City_Other" id="City_Other"  class="bl_input" value="Other City" type="text" disabled  tabindex=7/>
          </td>
    </tr>
    <tr>
      <td height="30"><span class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Email ID :</span></td>
    </tr>
    <tr>
      <td width="30" height="30">
        <input name="Email" id="Email" type="text" class="bl_input" onKeyDown="validateDiv('emailVal');"  tabindex=8/>
          <div id="emailVal"></div>  </td>
    </tr>
    <tr>
      <td></tr></td>
    </tr>
  </table>
</div>

<div class="bl_input_box">
  <table width="97%" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td height="30"><span class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Pincode:</span></td>
    </tr>
    <tr>
      <td height="30"><input name="Pincode" id="Pincode" maxlength="6" onKeyPress="intOnly(this);" onKeyUp="intOnly(this);"  onkeydown="validateDiv('pincodeVal');" type="text" class="bl_input" tabindex=9/>
         <div id="pincodeVal"></div></td>
    </tr>
    <tr>
      <td height="30"><span class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Annual Income/ITR:</span></td>
    </tr>
    <tr>
      <td height="30"> <input type="text" name="IncomeAmount" id="IncomeAmount" class="bl_input" onkeyup="intOnly(this); getDigitToWords('IncomeAmount','formatedIncome','wordIncome');" onKeyPress="intOnly(this);"  onblur="getDigitToWords('IncomeAmount','formatedIncome','wordIncome');"  onchange="ShowHide('incomeShow','IncomeAmount');" onKeyDown="validateDiv('netSalaryVal');"  tabindex=12/>
              <div id="dialog-modal" > </div>
        <div id="netSalaryVal"></div><span id='formatedIncome' style='font-size:11px; font-weight:normal; color:#ffffff;font-Family:Verdana;'></span><span id='wordIncome' style='font-size:11px; font-weight:normal; color:#ffffff;font-Family:Verdana;text-transform: capitalize;'></span> </td>
    </tr>
    <tr>
      <td height="30"><span class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;"><span class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Annual Turnover </span></span></td>
    </tr>
    <tr>
      <td><select name="Annual_Turnover" id="Annual_Turnover"  onchange="validateDiv('annualIncomeVal');" class="bl_input"  style="font-family:Verdana, Geneva, sans-serif; font-size:11px; color:#4c4c4c;" tabindex=10 >
                          <option value="">Please Select</option>
				  <option value="1">Less than 50Lacs</option>
				  <option value="2">50Lacs - 1Cr</option>
				  <option value="3">1Cr & above</option>
                     </select>
                        <div id="annualIncomeVal"></div></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td></td>
    </tr>
    </td>
    </tr>
  </table>
</div>
<div class="bl_input_box">
  <table width="97%" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td height="30" colspan="2"><span class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Loan Amount:</span></td>
    </tr>
    <tr>
      <td height="30" colspan="2"><input name="Loan_Amount" id="Loan_Amount" maxlength="8" onKeyPress="intOnly(this);" onKeyUp="intOnly(this); getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');"  onblur="getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');"  type="text" class="bl_input" onKeyDown="validateDiv('loanAmtVal');" tabindex=13/>
     <div id="loanAmtVal"></td>
    </tr>
    <tr>
      <td height="30" colspan="2"><span id='formatedlA' style='font-size:11px;
font-weight:normal; color:#ffffff;font-Family:Verdana;'></span><span id='wordloanAmount' style='font-size:11px;
font-weight:normal; color:#ffffff;font-Family:Verdana;text-transform: capitalize;'></span></td>
    </tr>
    <tr>
      <td width="39%" height="30"><div id="dialog-modal2" ><span class="text" style=" float:left;  height:auto; color:#FFF; font-size:12px; text-transform:none;"><span style=" float:left; width:70px; height:auto; clear:right; ">Credit Card</span></span></div>
        <div id="netSalaryVal2"></div></td>
      <td width="61%" class="text" style=" float:left;  height:auto; color:#FFF; font-size:12px; text-transform:none;">
      <table width="147">
        <tr><td width="67" class="text" style=" padding-top:3px; color:#FFF; font-size:12px; text-transform:none;"><input type="radio"  name="CC_Holder" id="CC_Holder" value="1"  style="border:none;" onClick="addIdentified();" >Yes </td><td width="68" class="text" style=" padding-top:3px; color:#FFF; font-size:12px; text-transform:none;"><input type="radio"  name="CC_Holder" id="CC_Holder" style="border:none;" value="0" onClick="removeIdentified();">No</td></tr></table>
           
     </td>
      </tr>
    <tr>
      <td height="0" colspan="2" id="myDiv1" >&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2"><div id="annualIncomeVal2"></div></td>
    </tr>
  </table>
</div>

<div style="clear:both;"> </div>
<div class="bl_terms_box"> <input name="accept" type="checkbox" /> I Agree to&nbsp;<a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow"  class="text" style=" color:#88a943; font-size:11px; text-decoration:underline;">privacy policy</a> and&nbsp;<a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow"  class="text" style=" color:#88a943; font-size:11px; text-decoration:underline;">Terms and Conditions</a>.
              <div id="acceptVal"></div></div>
              
        <div class="bl_btn"><input type="submit" style="border: 0px none ; background-image: url(http://www.deal4loans.com/images/get1.gif); width: 114px; height: 52px; margin-bottom: 0px;" value=""/></div>   </form> 
</div>
</div>


