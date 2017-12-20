<div class="pl_form_box">
  <form name="loan_form" method="post" action="apply-loan-against-property-continue.php" onSubmit="return chkform();">
   <input type="hidden" name="Activate" id="Activate" >
<input type="hidden" name="source" value="<? echo $retrivesource; ?>">
<div style="clear:both;"></div>
<div style="font-size:19px;margin-top:10px;" class="lap-margin-left">
<h1 class="text_head"><strong>
Apply Loan Against Property
</strong></h1>
<div class="text3" style="float:left; width:100%; max-width:575px; font-size:24px; color:#FFF; text-transform:none; margin-top:11px" id="imgDisplay"><img src="images/animated_lap1.gif" style="width:100%; max-width:575px;"  /></div>
</div>

<div style="clear:both;"></div>

<div class="text_head lap-margin-left">
Professional Details
</div>
<div style="clear:both;"></div>
<div class="pl_input_box">
  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">

    <tr>
    
      <td height="25" class="formhlwpbody-text">Loan Amount:</td>
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
      <td height="25" class="formhlwpbody-text">Occupation:</td>
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
<td height="25"><span class="formhlwpbody-text" id="netSalText">Net Salary/Income (Yearly/ITR):</span></td>
    </tr><tr>
      <td height="25">
      <input type="text" name="Net_Salary" id="Net_Salary" class="pl_input_b" onKeyUp="intOnly(this); getDiToWordsIncome('Net_Salary','formatedIncome','wordIncome');" onKeyPress="intOnly(this);"  onblur="getDiToWordsIncome('Net_Salary','formatedIncome','wordIncome');"  onchange="ShowHide('incomeShow','Net_Salary');" tabindex="3" onkeydown="validateDiv('netSalaryVal');" />
     <div id="netSalaryVal"></div>
      
     </td>
    </tr>
    
       <tr>  <td  class="formhlwpbody-text" style=" padding-top:3px;  font-size:12px; text-transform:none;"><span id='formatedIncome' style='font-size:11px;
font-weight:normal;'></span> <span id='wordIncome' style='font-size:11px;
font-weight:normal; text-transform:capitalize;'></span></td> </tr>
        </table>
    </div>

<div class="pl_input_box">
  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td height="25"><span class="formhlwpbody-text">City:</span></td>
     </tr><tr>
      <td height="25" ><select name="City" id="City" class="pl_select_b" onChange="addPersonalDetails(); addhdfclife(); validateDiv('cityVal');" tabindex="4">
  <?=plgetCityList($City)?>
                   <option value="Vapi">Vapi</option>
				   <option value="Ankleshwar">Ankleshwar</option>
				    <option value="Anand">Anand</option>
					 <option value="Anand">Dahod</option>
					  <option value="Anand">Navsari</option>	 </select>
                         <div id="cityVal"></div>   </td>
    </tr>
        </table>
    </div>
<div style="clear:both;"></div>
<div id="other_Details">
<div style="height:15px;"></div>
<div class="pl_terms_box" style=" line-height:30px;"><input type="checkbox"  name="accept" style="border:none;"  > I Agree to&nbsp;<a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow"  class="text" style=" color:#88a943; font-size:14px; text-decoration:underline;">privacy policy</a> and&nbsp;<a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow" class="text" style=" color:#88a943; font-size:14px; text-decoration:underline;">Terms and Conditions</a>.</div>                  <div class="cl_new_bnt_b" style="margin-top:6px; margin-right:20px;"><img src="http://www.deal4loans.com/images/wp-loan-get-quote.png" width="117" height="44" border="0" /></div>
<div style="height:15px;"></div>
</div>
<div style="clear:both;"></div>
<div id="personalDetails"></div>
</form></div>
<div style="clear:both;"></div>