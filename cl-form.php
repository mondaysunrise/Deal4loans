<form name="loan_form" method="post" action="/insert-car-loan-values.php" onSubmit="return chkform();">
 <input type="hidden" name="PostURL" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
	 <input type="hidden" name="Activate" id="Activate" ><input type="hidden" name="source" value="<? echo $retrivesource; ?>">
<table width="663" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td  align="left" valign="top" ><table width="960" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="14" align="left" valign="top"><img src="/images/bgtop1.jpg" width="960" height="14" /></td>
      </tr>
      <tr>
        <td height="55" align="left" valign="top" bgcolor="#21405F"><table width="955" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="24">&nbsp;</td>
            <td width="735"><div class="text3" style=" color:#FFF; font-size:24px; text-transform:none; "><strong>Apply <?php echo $subjectLine; ?></strong></div></td>
            <td width="196" rowspan="2" valign="top"><!--<div class="text3" style="width:95px; height:33; margin-top:15px; float:right; clear:right;"><a href="#" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image3','','images/emi2.gif',1)"><img src="images/emi1.gif" name="Image3" width="95" height="20" border="0" id="Image3" /></a></div> -->&nbsp;</td>
          </tr>
          
          <tr>
            <td>&nbsp;</td>
            <td><span class="text3" style="float:left; width:575px; font-size:24px; color:#FFF; text-transform:none; margin-top:11px"><img src="http://www.deal4loans.com/images/animated.gif"  /></span></td>
          </tr>
          </table></td>
      </tr>
      <tr>
        <td  align="center" valign="top" bgcolor="#21405F"><table width="943" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="25" rowspan="2" align="left" valign="top">&nbsp;</td>
            <td width="201" align="left" valign="top"><table width="201" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="201" height="58" align="left" valign="top"><div style=" float:left; width:183px; height:47px; margin-left:0px; margin-top:5px;">
                      <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Full Name:</div>
                    <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;">
                        <input name="Name" id="Name" type="text" style="width:180px; height:18px;" onKeyDown="validateDiv('nameVal');" />
   <div id="nameVal"></div>   
                      </div>
                  </div></td>
                </tr>
                <tr>
                  <td height="55" align="left" valign="top"><div style=" float:left; width:183px; height:47px; margin-left:0px; margin-top:5px;">
                      <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">DOB:</div>
                    <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;">
                        <div class="text" style=" float:left; clear:right;">
                        <input name="day" id="day" type="text" style="width:43px; height:18px;" value="dd" onBlur="onBlurDefault(this,'dd');" onFocus="onFocusBlank(this,'dd');" maxlength="2" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" onKeyDown="validateDiv('dobVal');" />&nbsp;&nbsp;
                        </div>
                      <div class="text" style=" float:left; clear:right;">
                        <input name="month" id="month" type="text" style="width:43px; height:18px;" value="mm" onBlur="onBlurDefault(this,'mm');" onFocus="onFocusBlank(this,'mm');" maxlength="2" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" onKeyDown="validateDiv('dobVal');" />&nbsp;&nbsp;
                        </div>
                      <div class="text" style=" float:left; clear:right;">
                        	<input name="year" id="year" type="text" style="width:60px; height:18px;" value="yyyy" onBlur="onBlurDefault(this,'yyyy');" onFocus="onFocusBlank(this,'yyyy');" maxlength="4" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" onKeyDown="validateDiv('dobVal');" />
                        </div>
                           <div id="dobVal"></div>   
                    </div>
                  </div></td>
                </tr>
                <tr>
                  <td height="58"><div style=" float:left; width:183px; height:47px; margin-left:0px; margin-top:5px;">
                      <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;"><span class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Mobile:</span></div>
                    <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;">
                        <div class="text" style=" float:left; width:26px; height:auto; color:#FFF; font-size:12px; text-transform:none; clear:right; margin-top:3px; "> +91</div>
                      <div class="text" style=" float:left; width:26px; height:auto; color:#FFF; font-size:12px; text-transform:none; clear:right; ">
                        <input name="Phone" id="Phone" maxlength="10" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)"; onChange="intOnly(this);" type="text" style="width:153px; height:18px;" onKeyDown="validateDiv('phoneVal');"  />
            <div id="phoneVal"></div>  
                        </div>
                    </div>
                  </div></td>
                </tr>
               
            </table></td>
            <td width="26" align="left" valign="top">&nbsp;</td>
            <td width="185" align="left" valign="top"><table width="185" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="192" height="58" align="left" valign="top"><div style=" float:left; width:183px; height:47px; margin-left:0px; margin-top:5px;">
                    <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">City:</div>
                  <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;">                   <select name="City" id="City" style="width:180px; height:24px; font-family:Verdana, Geneva, sans-serif; font-size:11px; color:#4c4c4c;"  onchange="cityother(); addhdfclife(); insertData(); validateDiv('cityVal');" tabindex="7">
                            <?=plgetCityList($City)?>
                   <option value="Vapi">Vapi</option>
				   <option value="Ankleshwar">Ankleshwar</option>
				    <option value="Anand">Anand</option>
					 <option value="Anand">Dahod</option>
					  <option value="Anand">Navsari</option>
                        </select>
                         <div id="cityVal"></div>   
                    </div>
                </div></td>
              </tr>
              <tr>
                <td height="58" align="left" valign="top"><div style=" float:left; width:183px; height:47px; margin-left:0px; margin-top:5px;">
                    <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Other City:</div>
                  <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;">
                       <input name="City_Other" id="City_Other" type="text" style="width:180px; height:18px;" disabled onKeyUp="searchSuggest();" onKeyDown="validateDiv('othercityVal');"  />
                        <div id="othercityVal"></div>   
                    </div>
                </div></td>
              </tr>
              <tr>
                <td height="58"><div style=" float:left; width:183px; height:47px; margin-left:0px; margin-top:5px;">
                    <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Email ID :</div>
                  <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;">
                  <input name="Email" id="Email" type="text" style="width:180px; height:18px;" onKeyDown="validateDiv('emailVal');"  />
          <div id="emailVal"></div> 
                    </div>
                </div></td>
              </tr>
              
            </table></td>
            <td width="50" align="left" valign="top">&nbsp;</td>
            <td width="186" align="left" valign="top"><table width="183" border="0" cellspacing="0" cellpadding="0">
             
              <tr>
                <td height="58" align="left" valign="top"><div style=" float:left; width:183px; height:47px; margin-left:0px; margin-top:5px;">
                    <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;"><span class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Occupation: </span></div>
                  <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;">
                 <select name="Employment_Status" id="Employment_Status"  onchange="validateDiv('empStatusVal');"  style="width:180px; height:24px; font-family:Verdana, Geneva, sans-serif; font-size:11px; color:#4c4c4c;" >
                           <option value="-1">Please Select</option>
                           <option value="1">Salaried</option>
                           <option value="0">Self Employment</option>
                     </select>
                       <div id="empStatusVal"></div>
                    </div>
                </div></td>
              </tr>
              <tr>
                <td height="58"><div style=" float:left; width:183px; height:47px; margin-left:0px; margin-top:5px;">
                    <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;"><span class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Company Name: </span></div>
                  <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;">
                   <input name="Company_Name" id="Company_Name" type="text"  style="width:180px; height:18px;" onKeyDown="validateDiv('companyNameVal');" />
                        <div id="companyNameVal"></div>
                    </div>
                </div></td>
              </tr>
                   <tr>
                  <td width="183" height="58" align="left" valign="top"><div style=" float:left; width:183px; height:47px; margin-left:0px; margin-top:5px;">
                      <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Annual Income:</div>
                    <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;">
                       <input type="text" name="Net_Salary" id="Net_Salary" style="width:180px; height:18px;"  onkeyup="intOnly(this); getDigitToWords('Net_Salary','formatedIncome','wordIncome');" onKeyPress="intOnly(this);"  onblur="getDigitToWords('Net_Salary','formatedIncome','wordIncome');"  onchange="ShowHide('incomeShow','Net_Salary');" onKeyDown="validateDiv('netSalaryVal');"  />
              
        <div id="netSalaryVal"></div>   
                      </div>
                  </div>  <span id='formatedIncome' style='font-size:11px;
font-weight:normal; color:#ffffff;font-Family:Verdana;'></span> <span id='wordIncome' style='font-size:11px;
font-weight:normal; color:#ffffff;font-Family:Verdana;text-transform: capitalize;'></span></td>
                </tr>
           
            </table></td>
            <td width="56" align="left" valign="top">&nbsp;</td>
            <td width="214" align="left" valign="top"><table width="183" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td height="58" align="left" valign="top"><div style=" float:left; width:183px; height:47px; margin-left:0px; margin-top:5px;">
                      <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Loan Amount:</div>
                    <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;">
                    <input name="Loan_Amount" id="Loan_Amount" maxlength="8" onKeyPress="intOnly(this);" onKeyUp="intOnly(this); getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');"  onblur="getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');"  type="text" style="width:180px; height:18px;" onKeyDown="validateDiv('loanAmtVal');" />
     <div id="loanAmtVal"></div>
                      </div>
                  </div><span id='formatedlA' style='font-size:11px;
font-weight:normal; color:#ffffff;font-Family:Verdana;'></span><span id='wordloanAmount' style='font-size:11px;
font-weight:normal; color:#ffffff;font-Family:Verdana;text-transform: capitalize;'></span></td>
                </tr>
                 <tr>
                <td width="183" height="58" align="left" valign="top"><div style=" float:left; width:183px; height:47px; margin-left:0px; margin-top:5px;">
                  <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Car Type: </div>
                  <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;">
                    <select name="Car_Type" id="Car_Type"  onchange="validateDiv('empStatusVal');"  style="width:180px; height:24px; font-family:Verdana, Geneva, sans-serif; font-size:11px; color:#4c4c4c;" >
                         <option selected value="-1">Interested In</option>
				<option  value="1">New Car</option>
				<option value="0">UsedCar</option>
                     </select>
                                      <div id="carTypeVal"></div>
                  </div>
                </div></td>
              </tr>
              <tr>
                <td height="58"><div style=" float:left; width:183px; height:47px; margin-left:0px; margin-top:5px;">
                  <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;"></div>
                  <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:17px;">
                    <div style=" float:left; width:70px; height:auto; clear:right; ">Car Booked:</div>
                    <div style=" float:left; width:15px; height:auto; clear:right; margin-left:0px; margin-top:5px; ">
                  <input type="radio" value="1" name="Car_Booked" id="Car_Booked" style="border:none;">
                    </div>
                    <div style=" float:left; width:15px; height:auto; clear:right; margin-left:8px; margin-top:8px; "> Yes</div>
                    <div style=" float:left; width:15px; height:auto; clear:right; margin-left:13px; margin-top:5px; ">
                     <input type="radio" value="2" name="Car_Booked" id="Car_Booked" style="border:none;">
                    </div>
                    <div style=" float:left; width:10px; height:auto; clear:right; margin-left:5px; margin-top:8px; "> No</div>
                     <div id="ccholderVal"></div>   
                  </div>
                </div></td>
              </tr>
                             <tr>
                <td width="183" height="58" align="left" valign="top"><div style=" float:left; width:183px; height:47px; margin-left:0px; margin-top:5px;">
                  <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Car Model: </div>
                  <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;">
                  <input name="Car_Model" id="Car_Model" type="text"  style="width:180px; height:18px;" onKeyDown="validateDiv('carModelVal');" />
                                      <div id="carModelVal"></div>
                  </div>
                </div></td>
              </tr>
              
            </table></td>
          </tr>
          <tr>
            <td height="40" colspan="7" align="left" valign="top"><table width="923" border="0" cellspacing="0" cellpadding="0">
              <tr>
               
                <td width="792" align="left" valign="top"><div class="text" style=" float:left; width:790px; height:auto; color:#FFF; font-size:11px; text-transform:none; margin-top:5px;">
                                 <input name="accept" type="checkbox" checked="checked" />I authorize Deal4loans.com &amp; its partnering banks to contact me to explain the product &amp; I Agree to&nbsp;<a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow"  class="text" style=" color:#88a943; font-size:11px; text-decoration:underline;">privacy policy</a> and&nbsp;<a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow"  class="text" style=" color:#88a943; font-size:11px; text-decoration:underline;">Terms and Conditions</a>.
                </div></td>
                <td width="131" align="right" valign="top"><div style=" float:right; width:114px; height:47px; margin-top:0px; margin-left:0px; margin-right:23px;">  <input type="submit" style="border: 0px none ; background-image: url(/images/get1.gif); width: 114px; height: 52px; margin-bottom: 0px;" value=""/></div></td>
              </tr>
              <tr>
              
                <td align="left" valign="top" colspan="2">
                <div id="hdfclife"></div>
                </td></tr>
            </table>              </td>
            </tr>
            
        </table></td>
      </tr>
      <tr>
        <td height="14" align="center" valign="top"><img src="/images/bgbottom1.jpg" width="960" height="14" /></td>
      </tr>
    </table></td>
  </tr>
</table>
</form>