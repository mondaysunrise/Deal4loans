<script type="text/javascript" src="http://www.deal4loans.com/ajax.js"></script><script type="text/javascript" src="http://www.deal4loans.com/ajax-dynamic-pllist.js"></script>
<script Language="JavaScript" Type="text/javascript" src="http://www.deal4loans.com/scripts/common.js"></script>
<script type="text/javascript" src="http://www.deal4loans.com/validate_pl_form.js"></script>
<script src='http://www.deal4loans.com/scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<script language="JavaScript" type="text/javascript" src="http://www.deal4loans.com/suggest.js"></script>
<style type="text/css">/* START CSS NEEDED ONLY IN DEMO */
#mainContainer{
width:660px;
margin:0 auto;
text-align:left;
height:100%;		
border-left:3px double #000;
border-right:3px double #000;
}
#formContent{
padding:5px;
}
/* END CSS ONLY NEEDED IN DEMO */
/* Big box with list of options */
#ajax_listOfOptions{
position:absolute;	/* Never change this one */
width:250px;	/* Width of box */
height:160px;	/* Height of box */
overflow:auto;	/* Scrolling features */
border:1px solid #317082;	/* Dark green border */
background-color:#FFF;	/* White background color */
color: black;
font-family:Verdana, Arial, Helvetica, sans-serif;
text-align:left;
font-size:10px;
z-index:100;
}
#ajax_listOfOptions div{	/* General rule for both .optionDiv and .optionDivSelected */
margin:1px;		
padding:1px;
cursor:pointer;
font-size:10px;
}
#ajax_listOfOptions .optionDivSelected{ /* Selected item in the list */
background-color:#2375CB;
color:#FFF;
}
#ajax_listOfOptions_iframe{
background-color:#F00;
position:absolute;
z-index:5;
}
form{
display:inline;
}
</style>

<form name="personalloan_form"  action="http://www.deal4loans.com/insert_common_loan_value_step1.php" method="POST" onSubmit="return chkpersonalloan(document.personalloan_form);"> 
<table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0" class="brdr5" >
	 <tr>
        <td style=" padding:5px;"><table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="20"  bgcolor="#FFFFFF" class="frmbldtxt" ><h1 style="color:#443133; font-size:17px;  margin:0 0 10px; padding:15px 0 3px; text-align:center; font-family:Arial, Helvetica, sans-serif;">Apply For Best Home Loan from Deal4loans Associated Banks </h1></td>
  </tr>
</table></td>
 </tr>
     <tr>
     <td><table width="98%" border="0" align="right" cellpadding="0" cellspacing="0"  id="frm">
          <tr>
            <td colspan="2" align="center"><input type="hidden" name="Type_Loan" value="Req_Loan_Personal">
<input type="hidden" name="creative" value="<? echo $_REQUEST['creative'] ?>">
<input type="hidden" name="section" value="<? echo $_REQUEST['section'] ?>">
<input type="hidden" name="source" value="SEO_D4L_3"> 
<input type="hidden" name="referrer" value="<? echo $_REQUEST['referrer'] ?>"> 
<input type="hidden" name="Activate" id="Activate" >
<input type="hidden" name="PostURL" value="<?php echo $_SERVER['REQUEST_URI']; ?>"></td>
	      </tr>
		   <tr>
            <td colspan="2" align="center"><table align="Left"><tr><td class="frmbldtxt" width="45%">Product : </td><td><select name="product" id="product" style="width:137px;"><option value="">Please Select</option><option value="Req_Loan_Personal">Personal Loan</option><option value="Req_Loan_Home">Home Loan</option></select></td></tr></table></td>
	      </tr>
          <tr>
            <td colspan="2" align="center"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
               <tr>
                 <td valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                   <tr valign="middle">
                     <td height="25" class="frmbldtxt" style="padding-top:3px; ">Full Name :</td>
                     <td height="25" class="frmbldtxt"  style="padding-top:3px; "><input type="text" name="Name" id="Name" style="width:150px;" maxlength="30"  onchange="insertData();" tabindex="1" /></td>
                     <td width="18%" height="25" class="frmbldtxt" style="padding-top:3px; ">City :</td>
                     <td width="31%" height="25" class="frmbldtxt"  style="padding-top:3px; "><select name="City" style="width:137px;" onchange="othercity1();">
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
                     <td height="25" class="frmbldtxt">DOB :</td>
                     <td height="25" class="frmbldtxt"><input name="day" type="text" id="day"  value="DD" style="  width:35px; " onblur="onBlurDefault(this,'dd');" onfocus="onFocusBlank(this,'dd');" maxlength="2" onkeyup="intOnly(this);" onkeypress="intOnly(this);" tabindex="2"/>
                         <input  name="month" type="text" id="month" style="width:35px; " value="MM" onblur="onBlurDefault(this,'mm');" onfocus="onFocusBlank(this,'mm');" maxlength="2" onkeyup="intOnly(this);" onkeypress="intOnly(this);" tabindex="3"/>
                         <input name="year" type="text" id="year" style="width:63px; " value="YYYY" onblur="onBlurDefault(this,'yyyy');" onfocus="onFocusBlank(this,'yyyy');" maxlength="4" onkeyup="intOnly(this);" onkeypress="intOnly(this);" onchange="insertData();" tabindex="4"/></td>
                     <td height="28" align="left" class="frmbldtxt">Other City :</td>
                     <td height="28" class="frmbldtxt"><input type="text" name="City_Other" id="City_Other" disabled  value="Other City" onfocus="this.select();" style="width:148px;" onKeyUp="searchSuggest();" tabindex="8" /><div id="CityOLayer"></div></td>
                   </tr>
                   <tr valign="middle">
                     <td height="25" class="frmbldtxt">Mobile :</td>
                     <td height="25" class="frmbldtxt"><table cellpadding="0" cellspacing="0" width="90%">
				<tr><td>+91</td><td><input type="text" style="width:122px;" name="Phone" id="Phone" maxlength="10"   onkeyup="intOnly(this);" onkeypress="intOnly(this);" onchange="intOnly(this);insertData();"  tabindex="5"/></td>
				</tr></table></td>
                     <td height="25" class="frmbldtxt">Pincode :</td>
                     <td height="25" class="frmbldtxt"><input type="text" name="Pincode" onfocus="this.select();" style="width:148px;" maxlength="6" onkeypress="intOnly(this);" onkeyup="intOnly(this);"   tabindex="9" /></td>
                   </tr>
                   <tr valign="middle">
                     <td width="19%" height="25" class="frmbldtxt">Email ID :</td>
                     <td width="32%" height="25" class="frmbldtxt"><input type="text" name="Email_id" id="Email_id"  style="width:149px;" onchange="insertData();" tabindex="6" /></td>
                     <td width="18%" height="25" class="frmbldtxt">Company Name :</td>
                     <td width="31%" height="28" class="frmbldtxt"><input name="Company_Name" id="Company_Name" type="text" tabindex="10"   style=" width:148px;"  onblur="onBlurDefault(this,'Company Name');" onKeyUp="ajax_showOptions(this,'getCountriesByLetters',event)" onfocus="onFocusBlank(this,'Company Name');" /></td>
                   </tr>
                   <tr valign="middle">
                     <td height="25">&nbsp;</td>
					 <td height="25">&nbsp;</td>
					 <td height="25">&nbsp;</td>
                     <td height="28">&nbsp;</td>
                   </tr>
                 </table></td>
                 <td width="310" valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                <tr>
                <td height="25" class="frmbldtxt">Occupation :</td>
                <td class="frmbldtxt"><select   name="Employment_Status"  id="Employment_Status" style="width:154px;" tabindex="11" >
                         <option value="-1">Employment Status</option>
                         <option value="1">Salaried</option>
                         <option value="0">Self Employment</option>
                     </select></td>
              </tr>
              <tr>
                <td height="25" class="frmbldtxt">Annual Income :</td>
                <td class="frmbldtxt"><input type="text" name="IncomeAmount" id="IncomeAmount" style="width:148px;" onkeyup="intOnly(this); getDigitToWords('IncomeAmount','formatedIncome','wordIncome');" onkeypress="intOnly(this);"  onblur="getDigitToWords('IncomeAmount','formatedIncome','wordIncome');"  onchange="ShowHide('incomeShow','Net_Salary');" tabindex="12" />
                </td>
              </tr>
              <tr>
                <td   colspan="2" class="frmbldtxt"><span id='formatedIncome' style='font-size:11px;
font-weight:normal; color:#333333;font-Family:Verdana;'></span>
<span id='wordIncome' style='font-size:11px;
font-weight:normal; color:#333333;font-Family:Verdana;text-transform: capitalize;'></span></td>
              </tr>
              <tr>
                <td height="25" class="frmbldtxt">Loan Amount :</td>
                <td class="frmbldtxt"><input name="Loan_Amount" id="Loan_Amount" tabindex="13" type="text" style="width:148px;" maxlength="10" onfocus="this.select();" onchange="ShowHide('loanShow','Loan_Amount');"  onkeyup="intOnly(this);getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');"  onkeydown="getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" onkeypress="intOnly(this); getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" onblur="getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" />
                </td>
              </tr>
              <tr>
                <td colspan="2" class="frmbldtxt"><span id='formatedlA' style='font-size:11px;
font-weight:normal; color:#333333;font-Family:Verdana;'></span><span id='wordloanAmount' style='font-size:11px;
font-weight:normal; color:#333333;font-Family:Verdana;text-transform: capitalize;'></span></td>
              </tr>
           <div id="cc_pl_div" style="visibility:hidden;">
              <tr>
                <td height="25" class="frmbldtxt">Credit Card Holder?</td>
                <td class="frmbldtxt"><table cellpadding="0" cellspacing="0" width="90%">
				<tr><td>
             <input type="radio" name="CC_Holder" id="CC_Holder" style="border:none;" tabindex="14"  value="1" onClick="addElement();">Yes</td><td><input type="radio" name="CC_Holder" id="CC_Holder" style="border:none;" tabindex="15" value="0" onClick="removeElement();">No</td>
			 </tr></table></td>
              </tr>
			  </div>
              <tr>
                <td colspan="2" class="frmbldtxt"><div id="myDiv"></div> </td>
              </tr>
            </table></td>
               </tr>
             </table></td>
          </tr>
            
          <tr>
            <td width="76%" align="left" class="frmbldtxt"  style="font-weight:normal;">
              <input type="checkbox"  name="accept" style="border:none;" checked > I authorize Deal4loans.com & its partnering Banks to call me with reference to my loan application  & Agree to <a href="http://www.deal4loans.com/Privacy.php" rel="nofollow" target="_blank">Privacy Policy</a> and <a href="http://www.deal4loans.com/Privacy.php" rel="nofollow" target="_blank">Terms and Conditions</a></td>
            <td width="24%"><input type="submit" style="border: 0px none ; background-image: url(http://www.deal4loans.com/new-images/quote-btn.jpg); width: 128px; height: 31px; margin-bottom: 0px;" value=""/></td>
          </tr>
         

          </table></td>
      </tr>
	    <tr>
	      <td >&nbsp;</td>
        </tr>
    </table>
	</form>