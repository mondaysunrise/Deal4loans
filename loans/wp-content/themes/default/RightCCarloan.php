<script type="text/javascript" src="js/dropdowntabs.js"></script>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<script type="text/javascript" src="http://www.deal4loans.com/ajax.js"></script>
<script type="text/javascript" src="http://www.deal4loans.com/ajax-dynamic-list-clhdfc.js"></script>
<script type="text/javascript" src="http://www.deal4loans.com/scripts/mainmenu.js"></script>
<script type="text/javascript" src="http://www.deal4loans.com/cc_wp_js.js"></script>
<style type="text/css">
	
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
		z-index:50;
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
		position:relative;
		z-index:5;
	}
	
	form{
		display:inline;
	}
</style>
<div style="float:right; clear:right;  width:290px; height:auto; margin-top:18px;">
<div class="text3" style="width:290px; margin:auto; height:auto; font-size:11px; color:#88a943; margin-top:0px;">
<form name="loan_form" method="post" action="http://www.deal4loans.com/insert-car-loan-values.php" onSubmit="return chkform();">
<input type="hidden" name="PostURL" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
<input type="hidden" name="Activate" id="Activate" ><input type="hidden" name="source" value="SEO_D4L_<? //the_title(); ?>">
<table width="290" border="0" cellspacing="0" cellpadding="0">
<tr>
	<td height="10" align="left" valign="top"><img src="images/bgtop.jpg" width="290" height="10" /></td>
</tr>
<tr>
	<td align="left" valign="top" bgcolor="#21405F"><table border="0" cellpadding="0" cellspacing="0">
<tr>
	<td width="28" align="left" valign="top">&nbsp;</td>
	<td  align="left" valign="top" width="279">
		<table width="285" border="0" cellpadding="3" cellspacing="3">
		<tr>
			<td align="left" valign="top" colspan="2" style=" color:#FFF; font-size:15px;  text-align:center; height:30; ">
				<strong>Car loan</strong>			</td>
		</tr>
        <tr>
			<td align="left" valign="top" colspan="2" style=" color:#FFF; font-size:11px; height:30; text-transform:capitalize; ">
 Offers for 100% Finance<span style="color:#FF0000; font-weight:bold;">*</span> <br /> Rate as low as 10.5% for New Car Loan<span style="color:#FF0000; font-weight:bold;">*</span><br /> 100% waiver in foreclosure charges after 12 months<span style="color:#FF0000; font-weight:bold;">*</span>
 <hr style="color:#CCCCCC;" />
 </td>
		</tr>
<tr>
<td width="99" height="23" align="left" valign="top" class="text" style="  color:#FFF; font-size:11px; ">
Full Name</td><td width="161" class="text" style="  color:#FFF; font-size:11px;  " height="23">
<input name="Name" id="Name" type="text" style="width:150px; height:22px;" onKeyDown="validateDiv('nameVal');" tabindex="1" />
<div id="nameVal"></div>    
</td>
</tr>
<tr>
<td width="99" height="23" align="left" valign="top" class="text" style="  color:#FFF; font-size:11px; ">
DOB</td>
<td width="161" class="text" style="  color:#FFF; font-size:11px;  ">
   <div class="text" style=" float:left; clear:right; padding-right:6px;">
        <input name="day" id="day" type="text" style="width:42px; height:22px;" value="dd" onblur="onBlurDefault(this,'dd');" onfocus="onFocusBlank(this,'dd');" maxlength="2" onkeyup="intOnly(this);" onkeypress="intOnly(this);" onkeydown="validateDiv('dobVal');" tabindex="7" />
        </div>
      <div class="text" style=" float:left; clear:right; padding-right:6px;">
		<input name="month" id="month" type="text" style="width:42px; height:22px;" value="mm" onblur="onBlurDefault(this,'mm');" onfocus="onFocusBlank(this,'mm');" maxlength="2" onkeyup="intOnly(this);" onkeypress="intOnly(this);" onkeydown="validateDiv('dobVal');" tabindex="8" />
      </div>
      <div class="text" style=" float:left; clear:right;">
	<input name="year" id="year" type="text" style="width:52px; height:22px;" value="yyyy" onblur="onBlurDefault(this,'yyyy');" onfocus="onFocusBlank(this,'yyyy');" maxlength="4" onkeyup="intOnly(this);" onkeypress="intOnly(this);" onkeydown="validateDiv('dobVal');" tabindex="9" />
      </div>
         <div id="dobVal"></div>
</td>
</tr>

<tr>
<td width="99" height="23" class="text" style="  color:#FFF; font-size:11px; ">
Mobile</td>
<td width="161" class="text" style="  color:#FFF; font-size:11px;  ">
+91 
<input name="Phone" id="Phone" maxlength="10" onkeyup="intOnly(this);" onkeypress="intOnly(this)"; onchange="intOnly(this);" type="text" style="width:128px; height:22px;" onkeydown="validateDiv('phoneVal');" tabindex="2"  />
            <div id="phoneVal"></div>    
</td>
</tr>

<tr>
<td width="99" height="23" class="text" style="  color:#FFF; font-size:11px; ">
Email ID </td>
<td width="161" class="text" style="  color:#FFF; font-size:11px;  ">
<input name="Email" id="Email" type="text" style="width:150px; height:22px;" onkeydown="validateDiv('emailVal');" tabindex="3"  />
          <div id="emailVal"></div>   
</td>
</tr>
<tr>
<td width="99" height="23" align="left" valign="top" class="text" style="  color:#FFF; font-size:11px; ">
City</td>
<td width="161" class="text" style="  color:#FFF; font-size:11px;  ">
    <select name="City" id="City" style="width:150px; height:24px; font-family:Verdana, Geneva, sans-serif; font-size:11px; color:#4c4c4c;" onchange="cityother(); addhdfclife(); validateDiv('cityVal');" tabindex="4">
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
                        </select>
                         <div id="cityVal"></div>   
</td>
</tr>
<tr>
<td width="99" height="23" align="left" valign="top" class="text" style="  color:#FFF; font-size:11px; ">
Other City</td>
<td width="161" class="text" style="  color:#FFF; font-size:11px;  ">
    <input name="City_Other" id="City_Other" type="text" style="width:150px; height:22px;" disabled onKeyUp="searchSuggest();" onkeydown="validateDiv('othercityVal');"  tabindex="5" />
                        <div id="othercityVal"></div>   
</td>
</tr>
<tr>
<td width="99" height="23" align="left" valign="top" class="text" style="  color:#FFF; font-size:11px; ">
Occupation</td>
<td width="161" class="text" style="  color:#FFF; font-size:11px;  ">
    <select name="Employment_Status" id="Employment_Status"  onchange="validateDiv('empStatusVal');"  style="width:150px; height:24px; font-family:Verdana, Geneva, sans-serif; font-size:11px; color:#4c4c4c;" tabindex="10" >
                           <option value="-1">Please Select</option>
                           <option value="1">Salaried</option>
                           <option value="0">Self Employment</option>
                     </select>
                       <div id="empStatusVal"></div>
</td>
</tr>
<tr>
<td width="99" height="23" align="left" valign="top" class="text" style="  color:#FFF; font-size:11px; ">
Company Name</td>
<td width="161" class="text" style="  color:#FFF; font-size:11px;  ">
      <input name="Company_Name" id="Company_Name" type="text"  style="width:150px; height:22px;" onkeydown="validateDiv('companyNameVal');" onKeyUp="ajax_showOptions(this,'getCountriesByLetters',event)" tabindex="11" />
                        <div id="companyNameVal"></div>
</td>
</tr>
<tr>
<td width="99" height="23" align="left" valign="top" class="text" style="color:#FFF; font-size:11px;  padding-right:2px;">
Annual Income</td>
<td width="161" class="text" style="color:#FFF; font-size:11px;  ">
  <input type="text" name="Net_Salary" id="Net_Salary" style="width:150px; height:22px;"  onkeyup="intOnly(this); getDigitToWords('Net_Salary','formatedIncome','wordIncome');" onkeypress="intOnly(this);"  onblur="getDigitToWords('Net_Salary','formatedIncome','wordIncome');"  onchange="ShowHide('incomeShow','Net_Salary');" onkeydown="validateDiv('netSalaryVal');"  tabindex="12" />
 <div id="netSalaryVal"></div>  
</td>
</tr>
<tr><td colspan="2"> <span id='formatedIncome' style='font-size:11px;
font-weight:normal; color:#ffffff;font-Family:Verdana;'></span> <span id='wordIncome' style='font-size:11px;
font-weight:normal; color:#ffffff;font-Family:Verdana;text-transform: capitalize;'></span></td></tr>
<tr>
<tr>
<td width="99" height="23" align="left" valign="top" class="text" style="color:#FFF; font-size:11px;  padding-right:2px;">
Loan Amount</td>
<td width="161" class="text" style="color:#FFF; font-size:11px;  ">
  <input name="Loan_Amount" id="Loan_Amount" maxlength="8" onkeypress="intOnly(this);" onkeyup="intOnly(this); getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');"  onblur="getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');"  type="text" style="width:150px; height:18px;" onkeydown="validateDiv('loanAmtVal');" />
     <div id="loanAmtVal"></div>  
</td>
</tr>
<tr><td colspan="2"> <span id='formatedlA' style='font-size:11px;
font-weight:normal; color:#ffffff;font-Family:Verdana;'></span><span id='wordloanAmount' style='font-size:11px;
font-weight:normal; color:#ffffff;font-Family:Verdana;text-transform: capitalize;'></span></td></tr>

<tr>
<td width="99" height="23" align="left" valign="top" class="text" style="color:#FFF; font-size:11px;  padding-right:2px;">
Car Type</td>
<td width="161" class="text" style="color:#FFF; font-size:11px;  ">
  <select name="Car_Type" id="Car_Type"  onchange="validateDiv('empStatusVal');"  style="width:150px; height:24px; font-family:Verdana, Geneva, sans-serif; font-size:11px; color:#4c4c4c;" >
                <option selected value="-1">Interested In</option>
				<option  value="1">New Car</option>
				<option value="0">UsedCar</option>
         </select>
<div id="carTypeVal"></div>
</td>
</tr>
<tr>
<td width="99" height="23" align="left" valign="top" class="text" style="color:#FFF; font-size:11px;  padding-right:2px;">
Car Booked</td>
<td width="161" class="text" style="color:#FFF; font-size:11px;  ">
  <div style=" float:left; width:15px; height:auto; clear:right; margin-left:8px; margin-top:8px; "> Yes</div>
                    <div style=" float:left; width:15px; height:auto; clear:right; margin-left:13px; margin-top:5px; ">
                     <input type="radio" value="2" name="CC_Holder" id="CC_Holder" style="border:none;" checked onClick="removeElement();" tabindex="14">
                    </div>
                    <div style=" float:left; width:10px; height:auto; clear:right; margin-left:5px; margin-top:8px; "> No</div>
</td>
</tr>
<tr>
<td align="left" valign="top" colspan="2" class="text9" style=" color:#FFF; font-size:8px; margin-top:0px; ">
  <input name="accept" type="checkbox" onclick="validateDiv('acceptVal');" tabindex="15"/>  
     I Agree to <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow"  class="text" style="font-size:8px;  color:#88a943; text-decoration:underline;">privacy policy</a> and&nbsp;<a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow" class="text" style=" color:#88a943; font-size:8px; text-decoration:underline;">Terms and Conditions</a> of deal4loans.com.
     <div id="acceptVal"></div>
</td>
</tr>
<tr>
<td>&nbsp;</td><td  align="center" valign="top"  style= "margin-left:0px;">
<input type="submit" style="border: 0px none ; background-image: url(images/get_quot.jpg); width: 94px; height: 27px; margin-bottom: 0px;" value="" tabindex="16"/>
</td>
</tr> 
<tr>
<td align="left" valign="top" colspan="2" class="text9" style=" color:#FFF; font-size:9px; margin-top:0px; text-transform:capitalize;">
<span style="color:#FF0000; font-weight:bold;">*</span> All Credit Cards and offers on sole discretion of banks.
</td>
</tr> 
</table>
        </td>
</tr>
</table></td>
</tr>
<tr>
<td height="15" align="left" valign="top"><img src="images/bgbottom.jpg" width="290" height="10" /></td>
</tr>
</table>
</form>
</div>
</div>