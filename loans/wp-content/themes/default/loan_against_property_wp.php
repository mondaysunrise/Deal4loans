<link href="http://www.deal4loans.com/css/wp_cl.css" rel="stylesheet" type="text/css" /><script Language="JavaScript" Type="text/javascript" src="http://www.deal4loans.com/scripts/common.js"></script><script type="text/javascript" src="http://www.deal4loans.com/loan_against_property_wp.js"></script><script src='http://www.deal4loans.com/scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script><div class="pl_form_box">  <form name="lap_loan_form" method="post" action="http://www.deal4loans.com/apply-loan-against-property-continue.php" onSubmit="return chkform();">
<input type="hidden" name="Activate" id="Activate" ><input type="hidden" name="source" value="<? the_title(); ?>">
<div style="clear:both;"></div>
<div style="padding-left:10px; font-size:19px; color:#FFFFFF; margin-top:10px;">
<strong class="text3" style=" color:#FFF; font-size:18px; text-transform:none; ">Get Free Instant Quotes on Rates, EMI & Eligibility on Loan Against Property</strong>
</div>
<div style="clear:both;"></div>
<div style="padding-left:20px; font-size:19px; color:#FFFFFF; margin-top:10px;">Professional Details</div>
<div style="clear:both;"></div>
<div class="pl_input_box">
  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">

    <tr>
    
      <td height="25" ><span class="text" style=" float:left; height:auto; color:#FFF; font-size:12px; text-transform:none;">Loan Amount:</span></td>
    </tr><tr>
      <td height="25"><input name="Loan_Amount" id="Loan_Amount" tabindex="1" type="text" class="pl_input_b" maxlength="10" onFocus="this.select();" onChange="ShowHide('loanShow','Loan_Amount');"  onkeyup="intOnly(this);getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');"  onkeydown="getDigitToWords('Loan_Amount','formatedlA','wordloanAmount'); validateDiv('loanAmtVal');" onKeyPress="intOnly(this); getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" onBlur="getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" />
     <div id="loanAmtVal"></div>
      </td>
    </tr>
     <tr>                       <td  class="text" style=" padding-top:3px; color:#FFF; font-size:12px; text-transform:none;"><span id='formatedlA' style='font-size:11px; font-weight:normal; color:#ffffff;font-Family:Verdana;'></span><span id='wordloanAmount' style='font-size:11px; font-weight:normal; color:#ffffff;font-Family:Verdana;text-transform: capitalize;'></span></td>                    </tr>
         </table>
    </div>
<div class="pl_input_box">
  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td height="25" ><span class="text" style=" float:left; height:auto; color:#FFF; font-size:12px; text-transform:none;">Occupation:</span></td>
    </tr><tr>   <td height="25">
      <select   name="Employment_Status"  id="Employment_Status" class="pl_select_b" tabindex="2"  onchange="addSalaryText(this.value); validateDiv('empStatusVal');" >
                           <option value="-1">Employment Status</option>
                           <option value="1">Salaried</option>
                           <option value="0">Self Employment</option>
                       </select>  <div id="empStatusVal"></div>
     </td>
    </tr>
     </table>
    </div>
    <div class="pl_input_box">
  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">

    <tr>
      <td height="25"><span class="text" style=" float:left; height:auto; color:#FFF; font-size:12px; text-transform:none;" id="netSalText">Net Salary/Income (Yearly/ITR):</span></td>
    </tr><tr>
      <td height="25">
      <input type="text" name="Net_Salary" id="Net_Salary" class="pl_input_b" onKeyUp="intOnly(this); getDiToWordsIncome('Net_Salary','formatedIncome','wordIncome');" onKeyPress="intOnly(this);"  onblur="getDiToWordsIncome('Net_Salary','formatedIncome','wordIncome');"  onchange="ShowHide('incomeShow','Net_Salary');" tabindex="3" onkeydown="validateDiv('netSalaryVal');" />
     <div id="netSalaryVal"></div>
      
     </td>
    </tr>
    
       <tr>  <td  class="text" style=" padding-top:3px; color:#FFF; font-size:12px; text-transform:none;"><span id='formatedIncome' style='font-size:11px;
font-weight:normal; color:#ffffff;font-Family:Verdana;'></span> <span id='wordIncome' style='font-size:11px;
font-weight:normal; color:#ffffff;font-Family:Verdana;text-transform: capitalize;'></span></td> </tr>
        </table>
    </div>

<div class="pl_input_box">
  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td height="25"><span class="text" style=" float:left; height:auto; color:#FFF; font-size:12px; text-transform:none;">City:</span></td>
     </tr><tr>
      <td height="25" ><select name="City" id="City" class="pl_select_b" onChange="addPersonalDetails(); addhdfclife(); validateDiv('cityVal');" tabindex="4">
 
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
                                <option value="Others">Others</option></select>
                         <div id="cityVal"></div>   </td>
    </tr>
        </table>
    </div>
<div style="clear:both;"></div>
<div id="other_Details">

<div class="pl_terms_box"><input type="checkbox"  name="accept" style="border:none;"  > I Agree to&nbsp;<a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow"  class="text" style=" color:#88a943; font-size:11px; text-decoration:underline;">privacy policy</a> and&nbsp;<a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow" class="text" style=" color:#88a943; font-size:11px; text-decoration:underline;">Terms and Conditions</a>.</div>                  <div class="cl_new_bnt_b" style="margin-top:6px; margin-right:20px;"><img src="http://www.deal4loans.com/images/get1.gif" width="114" height="52" border="0" /></div>

</div>
<div style="clear:both;"></div>
<div id="personalDetails"></div>
</form></div>
<div style="clear:both;"></div>