<?php $maxage=date('Y')-62; $minage=date('Y')-18; ?><link href="/icici-hl-frm-styleswp.css" type="text/css" rel="stylesheet" /><script src='/scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script><script type="text/javascript" src="/scripts/common.js"></script><script type="text/javascript" src="/scripts/hl_wp.js"></script><form name="loan_form" method="post" action="/apply-home-loanscontinue1.php" onSubmit="return chkform();">
<input type="hidden" name="Activate" id="Activate" >
<input type="hidden" name="source" value="SEO_D4L_<? the_title(); ?>"> 
<input type="hidden" name="Type_Loan" id="Type_Loan" value="Req_Loan_Home">
<div class="form_section">
<div class="text_head"><strong>GET INSTANT HOME LOAN QUOTES ONLINE</strong></div><div class="box_c">
<div class="input_box">
  <table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td><span class="text" style=" float:left; width:170px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Required Loan Amount:</span></td>
    </tr>
    <tr>
      <td><input name="Loan_Amount"  type="text" class="input" id="Loan_Amount"  onblur="getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" onKeyPress="intOnly(this);" onKeyDown="validateDiv('loanAmtVal');" onKeyUp="intOnly(this); getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" maxlength="8" /><div id="loanAmtVal"></div><span id='formatedlA' style='font-size:11px; font-weight:normal; color:#ffffff;font-Family:Verdana;'></span><span id='wordloanAmount' style='font-size:11px;font-weight:normal; color:#ffffff;font-Family:Verdana;text-transform: capitalize;'></span></td>
    </tr>
  </table>
</div>
<div class="input_box">
  <table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td><span class="text" style=" float:left; width:170px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Occupation: </span></td>
    </tr>
    <tr>
      <td><select name="Employment_Status" class="select" id="Employment_Status"  style="font-family:Verdana, Geneva, sans-serif; font-size:11px; color:#4c4c4c;"  onchange="validateDiv('empStatusVal');" ><option value="-1">Please Select</option><option value="1">Salaried</option><option value="0">Self Employment</option></select><div id="empStatusVal"></div></td>
    </tr>
  </table>
</div>
<div class="input_box">
  <table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td><span class="text" style=" float:left; width:170px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Annual Income:</span></td>
    </tr>
    <tr>
      <td><input type="text" name="Net_Salary" id="Net_Salary"  class="input"  onkeyup="intOnly(this); getDiToWordsIncome('Net_Salary','formatedIncome','wordIncome');" onKeyPress="intOnly(this);"  onblur="getDiToWordsIncome('Net_Salary','formatedIncome','wordIncome');"  onchange="ShowHide('incomeShow','Net_Salary');" onKeyDown="validateDiv('netSalaryVal');"  /><div id="netSalaryVal"></div>    <span id='formatedIncome' style='font-size:11px;font-weight:normal; color:#ffffff;font-Family:Verdana;'></span> <span id='wordIncome' style='font-size:11px; font-weight:normal; color:#ffffff;font-Family:Verdana;text-transform: capitalize;'></span></td>
    </tr>
  </table>
</div>
<div class="input_box">
  <table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td><span class="text" style=" float:left; width:170px; height:auto; color:#FFF; font-size:12px; text-transform:none;">City:</span></td>
    </tr>
    <tr>
      <td><select name="City" class="select" id="City" style=" font-family:Verdana, Geneva, sans-serif; font-size:11px; color:#4c4c4c;" tabindex="7"  onchange="addPersonalDetails(); addhdfclife(); validateDiv('cityVal');"><option value="Please Select">Please Select</option>
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
                                <option value="Others">Others</option></select><div id="cityVal"></div></td>
    </tr>
  </table>
</div>
<div style=" clear:both;"></div>
<div  id="personalDetails">
<div class="second_wrapper">
<div class="box_b" ><span style=" color:#fff; font-size:11px; text-transform:capitalize;  margin-top:2px;"><strong style="color:#fff;">Bank A</strong> - Rates as low as 9.95%<span style="color:#FF0000; font-weight:bold;">*</span> | <strong style="color:#fff;">Bank B</strong>- Fixed rate for 10 years.<span style="color:#FF0000; font-weight:bold;">*</span><br />
    <strong style="color:#fff;">Bank C</strong>- Last 12 month Emi waived off<span style="color:#FF0000; font-weight:bold;">*</span><br />
    Check Your Free Customized Offers From 10 Other Banks.</span></div></div>
<div class="box_d"><div class="box_term"><span class="text" style="  color:#FFF; font-size:11px; text-transform:none; margin-top:5px;">
<input name="accept" type="checkbox"  />
I Agree to&nbsp;<a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow"  class="text" style=" color:#88a943; font-size:11px; text-decoration:underline;">privacy policy</a> and&nbsp;<a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow"  class="text" style=" color:#88a943; font-size:11px; text-decoration:underline;">Terms and Conditions</a> of Deal4loans.com.</span></div>
<div class="box_btn"><img src="/images/get1.gif" border="0" /></div>
</div>
    </div>
    <div style=" clear:both;"></div>
    <div id="addSubmit" ></div>
<div id="hdfclife"></div>
</div>
<div style="clear:both;"></div>
</div>
</form>
<div style="clear:both;"></div>