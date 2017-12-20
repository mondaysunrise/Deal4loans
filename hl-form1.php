<form name="homeloan_calculator" method="post" action="/apply-home-loans-calc-continue1.php" onSubmit="return checkhlcalc();">
<input type="hidden" name="PostURL" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
<input type="hidden" name="Activate" id="Activate" ><input type="hidden" name="source" value="<? echo $newsource; ?>">
<table width="663" border="0" align="center" cellpadding="0" cellspacing="0">
<tr><td  align="left" valign="top" ><table width="960" border="0" cellspacing="0" cellpadding="0">
<tr><td height="14" align="left" valign="top"><img src="/images/bgtop1.jpg" width="960" height="14" /></td></tr>
<tr><td height="35" align="left" valign="top" bgcolor="#21405F"><table width="955" border="0" cellspacing="0" cellpadding="0"><tr><td width="24"><img src="http://www.deal4loans.com/new-images/spacer.gif" width="2px;" /></td><td><div class="text3" style=" color:#FFF; font-size:20px; text-transform:none; "><strong> <?php //echo $subjectLine; ?>Get Instant Quotes on Interest Rates, Eligibility & EMI on Home Loans from Top 10 Banks</strong></div></td></tr></table></td></tr>
<tr>
<td  align="center" valign="top" bgcolor="#21405F"><table width="943" border="0" cellpadding="0" cellspacing="0">
<tr>
<td width="11"  align="left" valign="top" style="padding-left:55px; font-size:19px; color:#FFFFFF;" colspan="4">
Professional Details
</td>
</tr>
<tr>

<td   align="left" valign="top" style="padding-left:55px;"><div style=" float:left; width:183px;  margin-left:0px; margin-top:5px;"><div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Required Loan Amount:</div><div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;"><input name="Loan_Amount" id="Loan_Amount" maxlength="8" onKeyPress="intOnly(this);" onKeyUp="intOnly(this); getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');"  onblur="getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');"  type="text" style="width:180px; height:18px;" onKeyDown="validateDiv('loanAmtVal');" /><div id="loanAmtVal"></div></div><span id='formatedlA' style='font-size:11px; font-weight:normal; color:#ffffff;font-Family:Verdana;'></span><span id='wordloanAmount' style='font-size:11px;font-weight:normal; color:#ffffff;font-Family:Verdana;text-transform: capitalize;'></span></div></td>

<td  align="left" valign="top"><div style=" float:left; width:183px; height:47px; margin-left:0px; margin-top:5px;"><div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;"><span class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Occupation: </span></div><div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;"><select name="Employment_Status" id="Employment_Status"  onchange="validateDiv('empStatusVal'); "  style="width:180px; height:24px; font-family:Verdana, Geneva, sans-serif; font-size:11px; color:#4c4c4c;" ><option value="-1">Please Select</option><option value="1">Salaried</option><option value="0">Self Employment</option></select><div id="empStatusVal"></div></div></div></td>
<td   align="left" valign="top" ><div style=" float:left; width:183px; margin-left:0px; margin-top:5px;"><div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Annual Income:</div><div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;"><input type="text" name="Net_Salary" id="Net_Salary" style="width:180px; height:18px;"  onkeyup="intOnly(this); getDigitToWords('Net_Salary','formatedIncome','wordIncome');" onKeyPress="intOnly(this);"  onblur="getDigitToWords('Net_Salary','formatedIncome','wordIncome');"  onchange="ShowHide('incomeShow','Net_Salary');" onKeyDown="validateDiv('netSalaryVal');"  /><div id="netSalaryVal"></div>   </div>  <span id='formatedIncome' style='font-size:11px;font-weight:normal; color:#ffffff;font-Family:Verdana;'></span> <span id='wordIncome' style='font-size:11px; font-weight:normal; color:#ffffff;font-Family:Verdana;text-transform: capitalize;'></span></div></td>
<td   align="left" valign="top"><div style=" float:left; width:183px; height:47px; margin-left:0px; margin-top:5px;"><div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">City:</div><div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;">                   <select name="City" id="City" style="width:180px; height:24px; font-family:Verdana, Geneva, sans-serif; font-size:11px; color:#4c4c4c;"  onchange="addPersonalDetails(); addhdfclife(); validateDiv('cityVal');" tabindex="7"><?=getCityList($City)?></select><div id="cityVal"></div>   </div></div></td>
</tr>
<tr>
<td  colspan="4" align="left" valign="top" id="personalDetails" >

<table cellpadding="0" width="100%"><tr>
<td   align="right" valign="top"><img src="/images/get1.gif" border="0" /></td>
</tr>

</table></td></tr>
<tr>
<td colspan="4" align="left" style="padding-left:55px;" valign="top" >
 <div id="hdfclife"></div>  
</td></tr>
</table></td></tr>
<tr><td height="14" align="center" valign="top"><img src="/images/bgbottom1.jpg" width="960" height="14" /></td></tr>
</table></td></tr>
</table>
</form>
