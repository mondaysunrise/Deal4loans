<?php
if((strlen(strpos($_SERVER['REQUEST_URI'], "/loans/personal-loan/hdfc-personal-loan-bhopal-interest-rates-apply-online/")) > 0))
{
	$responsiveTheme = "active";
}	
else
{
	$responsiveTheme = "inactive";
}
//$responsiveTheme = "inactive";
if($responsiveTheme == "active")
{
    include "pl_common_form2.php";
 }
 else
  {
   ?> 
<script type="text/javascript" src="http://www.deal4loans.com/js/jquery-ui-personalized-1.5.2.packed.js"></script><script type="text/javascript" src="http://www.deal4loans.com/ajax.js"></script><script type="text/javascript" src="http://www.deal4loans.com/ajax-dynamic-pllist.js"></script><script Language="JavaScript" Type="text/javascript" src="http://www.deal4loans.com/scripts/common.js"></script><script type="text/javascript" src="http://www.deal4loans.com/validate_pl_form.js"></script> <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.1/themes/base/jquery-ui.css" />   <script src="http://code.jquery.com/jquery-1.8.2.js"></script><script src="http://code.jquery.com/ui/1.9.1/jquery-ui.js"></script> <script src='http://www.deal4loans.com/scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script><script language="javascript">
$(function() {
	$("#IncomeAmount").focusout(function(){
				if($("#IncomeAmount").val()<=50000){
		var ai=$("#IncomeAmount").val();
	var mai= Math.round(ai/12);
		    $( "#dialog-modal" ).dialog({
			title:"You Have Indicated Your Annual Income Is 'Rs. " + ai + "' which is 'Rs." + mai + "' per month. If correct Continue or Edit Annual Income to get Right Quote",
            height: 0,
            modal: true
        });
		}
		});
    });
</script><style type="text/css">/* START CSS NEEDED ONLY IN DEMO */#mainContainer{width:660px;margin:0 auto;text-align:left;height:100%;		border-left:3px double #000;border-right:3px double #000;}#formContent{padding:5px;}#ajax_listOfOptions{position:absolute;	/* Never change this one */width:250px;	/* Width of box */height:160px;	/* Height of box */overflow:auto;	/* Scrolling features */border:1px solid #317082;	/* Dark green border */background-color:#FFF;	/* White background color */color: black;font-family:Verdana, Arial, Helvetica, sans-serif;text-align:left;font-size:10px;z-index:100;}#ajax_listOfOptions div{	/* General rule for both .optionDiv and .optionDivSelected */margin:1px;		padding:1px;cursor:pointer;font-size:10px;}#ajax_listOfOptions .optionDivSelected{ /* Selected item in the list */background-color:#2375CB;color:#FFF;}#ajax_listOfOptions_iframe{background-color:#F00;position:absolute;z-index:5;}form{display:inline;}.ui-dialog { position: absolute; padding: .2em; width: 700px; overflow: hidden; z-index:1001;}.ui-dialog .ui-dialog-titlebar { padding: .4em 1em; position: relative;  }.ui-dialog .ui-dialog-title { float: left; margin: .1em 16px .1em 0; font-size:11px; line-height:18px;}.ui-dialog .ui-dialog-titlebar-close { position: absolute; right: .3em; top: 50%; width: 19px; margin: -10px 0 0 0; padding: 1px; height: 18px; }.ui-dialog .ui-dialog-titlebar-close span { display: block; margin: 1px; }.ui-dialog .ui-dialog-titlebar-close:hover, .ui-dialog .ui-dialog-titlebar-close:focus { padding: 0; }.ui-dialog .ui-dialog-buttonpane { text-align: left; border-width: 1px 0 0 0; background-image: none; margin: .5em 0 0 0; padding: .3em 1em .5em .4em; }.ui-dialog .ui-dialog-buttonpane .ui-dialog-buttonset { float: right; }.ui-dialog .ui-dialog-buttonpane button { margin: .5em .4em .5em 0; cursor: pointer; }.ui-dialog .ui-resizable-se { width: 14px; height: 14px; right: 3px; bottom: 3px; }.ui-draggable .ui-dialog-titlebar { cursor: move; }
</style>
<form name="personalloan_form"  action="http://www.deal4loans.com/insert_common_loan_value_step1.php" method="POST" onSubmit="return chkpl(document.personalloan_form);"> 
<table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#21405F" style="border:#21405F 2px solid;" >
	 <tr>
        <td align="left" valign="top">
    <h2 style=" color:#FFF; font-size:20px; text-transform:none; padding:4px;"> 
    <?php
	if((strlen(strpos($_SERVER['REQUEST_URI'], "personal-loan/bajaj-finserv-lending-personal-loan-eligibility-documents-interest-rates-apply/")) > 0))
	{
		echo "Compare Bajaj Finserv Personal Loan | Interest Rates | Eligibility";
	}
	else
	{
	?>
	Compare Personal Loan Rates
	<?php
	}
	?>
    </h2>
        
        </td>
 </tr>
     <tr>
			<td align="left" valign="top" colspan="2" style=" color:#FFF; font-size:11px; height:30; text-transform:capitalize; padding-left:5px;">
  <strong>Bank A</strong> - 13.99 % for select companies<span style="color:#FF0000; font-weight:bold;">*</span> <br /> <strong>Bank B</strong>- 0% prepayment Charges<span style="color:#FF0000; font-weight:bold;">*</span><br /> <strong>Bank C</strong>- Discount on processing fee<span style="color:#FF0000; font-weight:bold;">*</span><br />Check your free customized offer now from 5 others.
 
 </td>
		</tr>
	 <tr>
     <td><table width="98%" border="0" align="right" cellpadding="0" cellspacing="0"  id="frm">
          <tr>
            <td colspan="2" align="center"><input type="hidden" name="Type_Loan" value="Req_Loan_Personal">
<input type="hidden" name="creative" value="<? echo $_REQUEST['creative'] ?>">
<input type="hidden" name="section" value="<? echo $_REQUEST['section'] ?>">
<input type="hidden" name="source" value="SEO_D4L_<? the_title(); ?>"> 
<input type="hidden" name="referrer" value="<? echo $_REQUEST['referrer'] ?>"> 
<input type="hidden" name="Activate" id="Activate" >
<input type="hidden" name="PostURL" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
<input type="hidden" name="product" id="product" value="Req_Loan_Personal">
</td>
	      </tr>
		
          <tr>
            <td colspan="2" align="center"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
               <tr>
                 <td valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                   <tr valign="middle">
                     <td height="25" class="text" style=" padding-top:3px; color:#FFF; font-size:12px; text-transform:none;">Full Name</td>
                     <td height="25" class="text" style=" padding-top:3px; color:#FFF; font-size:12px; text-transform:none;"><input type="text" name="Name" id="Name" style="width:150px;" maxlength="30"  onchange="insertData();" tabindex="1" /></td>
                     <td width="18%" height="25" class="text" style=" padding-top:3px; color:#FFF; font-size:12px; text-transform:none;">City</td>
                     <td width="31%" height="25" class="text" style=" padding-top:3px; color:#FFF; font-size:12px; text-transform:none;"><select name="City" style="width:154px;" onchange="othercity1(); addhdfclife(document.personalloan_form);">
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
                     <td height="25" class="text" style=" padding-top:3px; color:#FFF; font-size:12px; text-transform:none;">DOB</td>
                     <td height="25" class="text" style=" padding-top:3px; color:#FFF; font-size:12px; text-transform:none;"><input name="day" type="text" id="day"  value="DD" style="  width:35px; " onblur="onBlurDefault(this,'dd');" onfocus="onFocusBlank(this,'dd');" maxlength="2" onkeyup="intOnly(this);" onkeypress="intOnly(this);" tabindex="2"/>
                         <input  name="month" type="text" id="month" style="width:35px; " value="MM" onblur="onBlurDefault(this,'mm');" onfocus="onFocusBlank(this,'mm');" maxlength="2" onkeyup="intOnly(this);" onkeypress="intOnly(this);" tabindex="3"/>
                         <input name="year" type="text" id="year" style="width:63px; " value="YYYY" onblur="onBlurDefault(this,'yyyy');" onfocus="onFocusBlank(this,'yyyy');" maxlength="4" onkeyup="intOnly(this);" onkeypress="intOnly(this);" onchange="insertData();" tabindex="4"/></td>
                     <td height="28" align="left" class="text" style=" padding-top:3px; color:#FFF; font-size:12px; text-transform:none;">Other City</td>
                     <td height="28" class="text" style=" padding-top:3px; color:#FFF; font-size:12px; text-transform:none;"><input type="text" name="City_Other" id="City_Other" disabled  value="Other City" onfocus="onFocusBlank(this,'Other City');" style="width:148px;" onKeyUp="searchSuggest();" tabindex="8" /><div id="CityOLayer"></div></td>
                   </tr>
                   <tr valign="middle">
                     <td height="25" class="text" style=" padding-top:3px; color:#FFF; font-size:12px; text-transform:none;">Mobile</td>
                     <td height="25" class="text" style=" padding-top:3px; color:#FFF; font-size:12px; text-transform:none;"><table cellpadding="0" cellspacing="0" width="90%">
				<tr><td>+91</td><td><input type="text" style="width:122px;" name="Phone" id="Phone" maxlength="10"   onkeyup="intOnly(this);" onkeypress="intOnly(this);" onchange="intOnly(this);insertData();"  tabindex="5"/></td>
				</tr></table></td>
                 <td height="25" class="text" style=" padding-top:3px; color:#FFF; font-size:12px; text-transform:none;">Occupation</td>
                <td class="text" style=" padding-top:3px; color:#FFF; font-size:12px; text-transform:none;"><select   name="Employment_Status"  id="Employment_Status" style="width:154px;" tabindex="11" onchange="change_empstst();">
                         <option value="-1">Employment Status</option>
                         <option value="1">Salaried</option>
                         <option value="0">Self Employment</option>
                     </select></td>
                   </tr>
                   <tr valign="middle">
                     <td width="19%" height="25" class="text" style=" padding-top:3px; color:#FFF; font-size:12px; text-transform:none;">Email ID</td>
                     <td width="32%" height="25" class="text" style=" padding-top:3px; color:#FFF; font-size:12px; text-transform:none;"><input type="text" name="Email_id" id="Email_id"  style="width:149px;" onchange="insertData();" tabindex="6" /></td>
					  <td height="28" colspan="2" class="text" style=" padding-top:3px; color:#FFF; font-size:12px; text-transform:none;"><div id="chnge_empstst"><table cellpadding="0" cellspacing="0" width="100%"><tr><td class="text" style=" padding-top:3px; color:#FFF; font-size:12px; text-transform:none;"  width="37%" >Company Name</td>
                     <td width="63%">
                       <input name="Company_Name" id="Company_Name" type="text" tabindex="10"   style=" width:148px;"  onblur="onBlurDefault(this,'Type slowly to autofill');" onKeyUp="ajax_showOptions(this,'getCountriesByLetters',event)" onfocus="onFocusBlank(this,'Type slowly to autofill');"  value="Type slowly to autofill" /></td></tr></table></div></td>
                 
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
				
				   <td height="25" class="text" style=" padding-top:3px; color:#FFF; font-size:12px; text-transform:none;">Pincode</td>
                     <td height="25" class="text" style=" padding-top:3px; color:#FFF; font-size:12px; text-transform:none;"><input type="text" name="Pincode" onfocus="this.select();" style="width:148px;" maxlength="6" onkeypress="intOnly(this);" onkeyup="intOnly(this);"   tabindex="9" /></td>
				
                
              </tr>
              <tr>
                <td height="25" class="text" style=" padding-top:3px; color:#FFF; font-size:12px; text-transform:none;">Annual Income</td>
                <td class="text" style=" padding-top:3px; color:#FFF; font-size:12px; text-transform:none;"><input type="text" name="IncomeAmount" id="IncomeAmount" style="width:148px;" onkeyup="intOnly(this); getDigitToWords('IncomeAmount','formatedIncome','wordIncome');" onkeypress="intOnly(this);"  onblur="getDigitToWords('IncomeAmount','formatedIncome','wordIncome');"  onchange="ShowHide('incomeShow','Net_Salary');" tabindex="12" /> 
                </td>
              </tr>
			  <tr><td colspan="2"><div id="dialog-modal" > </div></td></tr>
              <tr>
                <td   colspan="2" class="text" style=" padding-top:3px; color:#FFF; font-size:12px; text-transform:none;"> <span id='formatedIncome' style='font-size:11px;
font-weight:normal; color:#ffffff;font-Family:Verdana;'></span>
<span id='wordIncome' style='font-size:11px;
font-weight:normal; color:#ffffff;font-Family:Verdana;text-transform: capitalize;'></span></td>
              </tr>
              <tr>
                <td height="25" class="text" style=" padding-top:3px; color:#FFF; font-size:12px; text-transform:none;">Loan Amount</td>
                <td class="text" style=" padding-top:3px; color:#FFF; font-size:12px; text-transform:none;"><input name="Loan_Amount" id="Loan_Amount" tabindex="13" type="text" style="width:148px;" maxlength="10" onfocus="this.select();" onchange="ShowHide('loanShow','Loan_Amount');"  onkeyup="intOnly(this);getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');"  onkeydown="getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" onkeypress="intOnly(this); getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" onblur="getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" />
                </td>
              </tr>
              <tr>
                <td colspan="2" class="text" style=" padding-top:3px; color:#FFF; font-size:12px; text-transform:none;"><span id='formatedlA' style='font-size:11px;
font-weight:normal; color:#ffffff;font-Family:Verdana;'></span><span id='wordloanAmount' style='font-size:11px;
font-weight:normal; color:#ffffff;font-Family:Verdana;text-transform: capitalize;'></span></td>
              </tr>
           <div id="cc_pl_div" style="visibility:hidden;">
              <tr>
                <td height="25" class="text" style=" padding-top:3px; color:#FFF; font-size:12px; text-transform:none;">Credit Card Holder?</td>
                <td class="text" style=" padding-top:3px; color:#FFF; font-size:12px; text-transform:none;"><table cellpadding="0" cellspacing="0" width="90%">
				<tr><td style=" padding-top:3px; color:#FFF; font-size:12px; text-transform:none;">
             <input type="radio" name="CC_Holder" id="CC_Holder" style="border:none;" tabindex="14"  value="1" onClick="addElement();">Yes</td><td style=" padding-top:3px; color:#FFF; font-size:12px; text-transform:none;"><input type="radio" name="CC_Holder" id="CC_Holder" style="border:none;" tabindex="15" value="0" onClick="removeElement();">No</td>
			 </tr></table></td>
              </tr>
			  </div>
              <tr>
                <td colspan="2" class="text" style=" padding-top:3px; color:#FFF; font-size:12px; text-transform:none;"><div id="myDiv"></div> </td>
              </tr>
            </table></td>
               </tr>
             </table></td>
          </tr>
            
          <tr>
            <td width="84%" align="left" class="text" style="color:#FFF; font-size:11px; text-transform:none;">
            <input type="checkbox"  name="accept" style="border:none;"  > I authorize Deal4loans.com &amp; its partnering banks to contact me to explain the product &amp; I Agree to&nbsp;<a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow"  class="text" style=" color:#88a943; font-size:11px; text-decoration:underline;">privacy policy</a> and&nbsp;<a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow" class="text" style=" color:#88a943; font-size:11px; text-decoration:underline;">Terms and Conditions</a>.</td>
            <td width="16%"><input type="submit" style="border: 0px none ;  background-image: url(/images/get1.gif); width: 114px; height: 52px; margin-bottom: 0px;" value=""/></td>
          </tr>

          </table></td>
      </tr>
	  <tr>
            <td colspan="7" align="left" valign="top">
             <div id="hdfclife"></div>
            </td></tr>
	    <tr>
	      <td style=" color:#FFF; font-size:9px; margin-top:0px; text-transform:capitalize;"><span style="color:#FF0000; font-weight:bold;">*</span> All loans and offers on sole discretion of banks.</td>
        </tr>
    </table>
	</form>
    <?php
	}
	?>