<script type="text/javascript" src="http://www.deal4loans.com/ajax.js"></script><script type="text/javascript" src="http://www.deal4loans.com/ajax-dynamic-pllist.js"></script><script Language="JavaScript" Type="text/javascript" src="http://www.deal4loans.com/scripts/common.js"></script><script type="text/javascript" src="http://www.deal4loans.com/validate_pl_form.js"></script><script src='http://www.deal4loans.com/scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script><style type="text/css">/* START CSS NEEDED ONLY IN DEMO */#mainContainer{width:660px;margin:0 auto;text-align:left;height:100%;		border-left:3px double #000;border-right:3px double #000;}#formContent{padding:5px;}#ajax_listOfOptions{position:absolute;	/* Never change this one */width:250px;	/* Width of box */height:160px;	/* Height of box */overflow:auto;	/* Scrolling features */border:1px solid #317082;	/* Dark green border */background-color:#FFF;	/* White background color */color: black;font-family:Verdana, Arial, Helvetica, sans-serif;text-align:left;font-size:10px;z-index:100;}#ajax_listOfOptions div{	/* General rule for both .optionDiv and .optionDivSelected */margin:1px;		padding:1px;cursor:pointer;font-size:10px;}#ajax_listOfOptions .optionDivSelected{ /* Selected item in the list */background-color:#2375CB;color:#FFF;}#ajax_listOfOptions_iframe{background-color:#F00;position:absolute;z-index:5;}form{display:inline;}</style>
<font face="Verdana, Arial, Helvetica, sans-serif" color="#FF0000"><strong><?php if(isset($_GET['msg']) && ($_GET['msg']=="NotAuthorised")) echo "Kindly give Valid Details"; ?></strong></font>
<form name="loan_form" method="post" action="/balance-transfer-home-loans-continue.php" onSubmit="return chkhlbtform();">
<input type="hidden" name="Balance_Transfer" id="Balance_Transfer" value="Balance Transfer" >
<input type="hidden" name="source" value="SEO_D4L_<? the_title(); ?>">
<table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0" class="brdr5" >
     <tr>
     <td><table width="98%" border="0" align="right" cellpadding="0" cellspacing="0" >
          <tr>
            <td colspan="5" align="center" ></td>
	    </tr>          
          <tr>
            <td colspan="5" style="padding:12px;" ><table width="506" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="361" height="30"  bgcolor="#FFFFFF" class="frmbldtxt" ><h2 style="margin:0px; padding:0px;">Home Loan Balance Transfer Calculator </h2></td>
  </tr>
</table></td>
            </tr>
          <tr>
            <td colspan="5" valign="top" class="frmbldtxt"></td>
            </tr>
           <tr>
             <td  colspan="5" align="left" class="frmbldtxt"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
               <tr>
                 <td width="618" valign="top"><table width="98%"  border="0" cellspacing="0" cellpadding="0">
                   <tr valign="middle">
                     <td height="28" class="frmbldtxt" style="padding-top:3px; ">Full Name </td>
                     <td height="28" class="frmbldtxt"  style="padding-top:3px; "><input type="text" name="Name" id="Name" style="width:150px;" maxlength="30"  onchange="insertData();" tabindex="1" /></td>
                     <td width="17%" height="28" class="frmbldtxt" style="padding-top:3px; ">City </td>
                     <td width="31%" height="28" class="frmbldtxt"  style="padding-top:3px; "><select name="City" id="City" style="width:154px;" onChange="hlbtcityother();" tabindex="7">
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
                                <option value="Others">Others</option>
                     </select></td>
                   </tr>
                   <tr valign="middle">
                     <td height="28" class="frmbldtxt">DOB </td>
                     <td height="28" class="frmbldtxt"><input name="day" type="text" id="day"  value="DD" style="  width:35px; " onBlur="onBlurDefault(this,'dd');" onFocus="onFocusBlank(this,'dd');" maxlength="2" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" tabindex="2"/>
                         <input  name="month" type="text" id="month" style="width:35px; " value="MM" onBlur="onBlurDefault(this,'mm');" onFocus="onFocusBlank(this,'mm');" maxlength="2" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" tabindex="3"/>
                         <input name="year" type="text" id="year" style="width:63px; " value="YYYY" onBlur="onBlurDefault(this,'yyyy');" onFocus="onFocusBlank(this,'yyyy');" maxlength="4" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" onChange="insertData();" tabindex="4"/></td>
                     <td height="28" align="left" class="frmbldtxt">Other City </td>
                     <td height="28" class="frmbldtxt"><input type="text" name="City_Other" disabled  value="Other City" onFocus="this.select();" style="width:148px;" tabindex="8" /></td>
                   </tr>
                   <tr valign="middle">
                     <td height="28" class="frmbldtxt">Mobile </td>
                     <td height="28" class="frmbldtxt">+91
                         <input type="text" style="width:122px;" name="Phone" id="Phone" maxlength="10"   onkeyup="intOnly(this);" onKeyPress="intOnly(this)"; onChange="intOnly(this);insertData();" onBlur="return Decorate1(' ')" onFocus="addtooltip();" tabindex="5"/></td>
                     <td height="28" class="frmbldtxt">Pincode </td>
                     <td height="28" class="frmbldtxt"><input type="text" name="Pincode" onFocus="this.select();" style="width:148px;" maxlength="6" onKeyPress="intOnly(this);" onKeyUp="intOnly(this);"   tabindex="9" /></td>
                   </tr>
                   <tr valign="middle">
                     <td width="19%" height="28" class="frmbldtxt">Email ID </td>
                     <td width="33%" height="28" class="frmbldtxt"><input type="text" name="Email" id="Email"  style="width:149px;" onChange="insertData();" tabindex="6" /></td>
                     <td width="17%" height="28" class="frmbldtxt">Occupation </td>
                     <td width="31%" height="28" class="frmbldtxt"><select   name="Employment_Status"  id="Employment_Status" style="width:154px;" tabindex="10" >
                         <option value="-1">Employment Status</option>
                         <option value="1">Salaried</option>
                         <option value="0">Self Employment</option>
                     </select></td>
                   </tr>
                   <tr valign="top">
                     <td height="28" colspan="3" style="color:#373737; padding-top:5px;">&nbsp;</td>
                     <td height="28" style="padding-top:4px; ">&nbsp;</td>
                   </tr>
                 </table></td>
                 <td width="321" valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="28" class="frmbldtxt">Gross Annual Salary </td>
                <td class="frmbldtxt"><input type="text" name="Net_Salary" id="Net_Salary" style="width:148px;" onKeyUp="intOnly(this); getDigitToWords('Net_Salary','formatedIncome','wordIncome');" onKeyPress="intOnly(this);"  onblur="getDigitToWords('Net_Salary','formatedIncome','wordIncome');"  onchange="ShowHide('incomeShow','Net_Salary');" tabindex="11" />
                </td>
              </tr>
              <tr>
                <td   colspan="2" class="frmbldtxt"><span id='formatedIncome' style='font-size:11px;
font-weight:normal; color:#333333;font-Family:Verdana;'></span>
<span id='wordIncome' style='font-size:11px;
font-weight:normal; color:#333333;font-Family:Verdana;text-transform: capitalize;'></span></td>
              </tr>
              <tr>
                <td height="28" class="frmbldtxt">Balance Transfer Amount </td>
                <td class="frmbldtxt"><input name="Loan_Amount" id="Loan_Amount" tabindex="12" type="text" style="width:148px;" maxlength="10" onFocus="this.select();" onChange="ShowHide('loanShow','Loan_Amount');"  onkeyup="intOnly(this);getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');"  onkeydown="getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" onKeyPress="intOnly(this); getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" onBlur="getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" />
                </td>
              </tr>
              <tr>
                <td colspan="2" class="frmbldtxt"><span id='formatedlA' style='font-size:11px;
font-weight:normal; color:#333333;font-Family:Verdana;'></span><span id='wordloanAmount' style='font-size:11px;
font-weight:normal; color:#333333;font-Family:Verdana;text-transform: capitalize;'></span></td>
              </tr>
              <tr>
                <td height="28" class="frmbldtxt">Name of Existing Bank</td>
                <td class="frmbldtxt"><input type="text" name="Existing_Bank"  id="Existing_Bank" style="width:148px;" tabindex="13"  onkeyup="ajax_showOptions(this,'getCountriesByLetters',event); getstatementlink();" onChange="getstatementlink();" onKeyDown="getstatementlink();" onClick="getstatementlink();" /></td>
              </tr>
              <tr>
                <td height="28" class="frmbldtxt"> Existing Loan Amount </td>
                <td class="frmbldtxt"><input type="text" name="Existing_Loan"  id="Existing_Loan" style="width:148px;" maxlength="30" tabindex="13" /></td>
              </tr>
               <tr>
                <td height="28" class="frmbldtxt"> Existing ROI </td>
                <td class="frmbldtxt"><input type="text" name="Existing_ROI"  id="Existing_ROI" style="width:148px;" maxlength="30"    tabindex="13" /></td>
              </tr>
              <tr>
                <td colspan="2" class="frmbldtxt">
				<div id="myDiv1"></div>
                  </td>
              </tr>
            </table></td>
               </tr>
             </table></td>
           </tr>
             <tr>
		  <td colspan="2"><div id="myDiv" style="color:#7d0606; font-family:Verdana; font-size:11px;"></div></td>
		  </tr>
           <tr>
             <td height="22"  colspan="4" align="left" class="frmbldtxt" style="font-weight:normal; padding-top:5px; "><input type="checkbox" name="accept" style="border:none;" checked> I authorize Deal4loans.com & its partnering banks to contact me to explain the product & I Agree to <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow">privacy policy</a> and <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow">Terms and Conditions</a>.  </td>
			  <td width="25%" align="center" style="font-weight:normal; padding-top:5px; "><input type="submit" style="border: 0px none ; background-image: url(http://www.deal4loans.com/new-images/quote-btn.jpg); width: 128px; height: 31px; margin-bottom: 0px;" value=""/></td>
           </tr>
		    <tr>
		  <td width="49%" align="left" style="padding:5px;"> <div id="getibibo"></div></td>
          </tr>
		           </table></td>
      </tr>
	  <tr>
		  <td style="padding-left:20px; padding-top:5px; height:30px; font-size:13px; font-weight:bold;">Get Best offers from SBI, HDFC Ltd, ICICI Bank, AXIS Bank, LIC Housing, IDBI. You can save upto 1 Lac.</td>
          </tr>
	    <tr>
	      <td >&nbsp;</td>
        </tr>
    </table>
	</form>