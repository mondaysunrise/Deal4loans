<script type="text/javascript" src="http://www.deal4loans.com/validate_pl_form1807.js"></script><link href="/icici-hl-frm-styleswp.css" type="text/css" rel="stylesheet" /><script type="text/javascript" src="/ajax.js"></script><script type="text/javascript" src="/ajax-dynamic-pllist.js"></script><script type="text/javascript" src="/scripts/common.js"></script><script src='/scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script><script language="JavaScript" type="text/javascript" src="http://www.deal4loans.com/suggest.js"></script><style>#ajax_listOfOptions{position:absolute;width:250px;height:160px;overflow:auto;border:1px solid #317082;background-color:#FFF;color:#000;font-family:Verdana, Arial, Helvetica, sans-serif;text-align:left;font-size:10px;z-index:50}#ajax_listOfOptions div{cursor:pointer;font-size:10px;margin:1px;padding:1px}#ajax_listOfOptions .optionDivSelected{background-color:#2375CB;color:#FFF}#ajax_listOfOptions_iframe{background-color:red;position:relative;z-index:5}form{display:inline}.ui-dialog{position:absolute;width:700px;overflow:hidden;z-index:1001;padding:.2em}.ui-dialog .ui-dialog-titlebar{position:relative;padding:.4em 1em}.ui-dialog .ui-dialog-title{float:left;font-size:11px;line-height:18px;margin:.1em 16px .1em 0}.ui-dialog .ui-dialog-titlebar-close{position:absolute;right:.3em;top:50%;width:19px;height:18px;margin:-10px 0 0;padding:1px}.ui-dialog .ui-dialog-titlebar-close span{display:block;margin:1px}.ui-dialog .ui-dialog-titlebar-close:hover,.ui-dialog .ui-dialog-titlebar-close:focus{padding:0}.ui-dialog .ui-dialog-buttonpane{text-align:left;background-image:none;border-width:1px 0 0;margin:.5em 0 0;padding:.3em 1em .5em .4em}.ui-dialog .ui-dialog-buttonpane .ui-dialog-buttonset{float:right}.ui-dialog .ui-dialog-buttonpane button{cursor:pointer;margin:.5em .4em .5em 0}.ui-dialog .ui-resizable-se{width:14px;height:14px;right:3px;bottom:3px}.ui-draggable .ui-dialog-titlebar{cursor:move}; </style><form name="loan_form" method="post" action="/insert_personal_loan_value_step1.php" onsubmit="return chkpersonalloan();">
<input type="hidden" name="Type_Loan" value="Req_Loan_Personal">
<input type="hidden" name="creative" value="<? echo $_REQUEST['creative'] ?>">
<input type="hidden" name="section" value="<? echo $_REQUEST['section'] ?>">
<input type="hidden" name="source" value="SEO_D4L_<? the_title(); ?>"> 
<input type="hidden" name="referrer" value="<? echo $_REQUEST['referrer'] ?>"> 
<input type="hidden" name="Activate" id="Activate" >
<input type="hidden" name="PostURL" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
<input type="hidden" name="product" id="product" value="Req_Loan_Personal">
<div class="form_section">
<div class="text_head"><h2 style=" color:#FFF; font-size:20px; text-transform:none;"> 
    <?php
	if((strlen(strpos($_SERVER['REQUEST_URI'], "personal-loan/bajaj-finserv-lending-personal-loan-eligibility-documents-interest-rates-apply/")) > 0))
	{
		echo "Compare Bajaj Finserv Personal Loan | Interest Rates | Eligibility";
	}
	else
	{
	?>
	Apply Online for Lowest Interest Rates on Personal Loan
	<?php
	}
	?>
    </h2></div>


<div style="clear:both;"></div> 
  <div class="input_box" style="width:970px; padding-left:10px;">
  <table width="100%" border="0" cellpadding="0" cellspacing="0">
<tr>
<td width="11"  align="left" valign="top" style=" font-family:Verdana, Arial, Helvetica, sans-serif; padding-top:2px; font-size:18px; color:#FFFFFF;" colspan="4">
Professional Details
</td>
</tr></table>
  </div>
  <div style="clear:both;"></div> 
  <div class="input_box" style="padding-left:10px;">
    <table width="98%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td height="30"><span class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Loan Amount:</span></td>
      </tr>
      <tr>
        <td height="25"><input name="Loan_Amount" id="Loan_Amount" maxlength="8" onKeyPress="intOnly(this);" onKeyUp="intOnly(this); getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" onblur="getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');"  type="text" class="hl_emi_input" onKeyDown="validateDiv('loanAmtVal');" />
<div id="loanAmtVal"></div><span id='formatedlA' style='font-size:11px;
font-weight:normal; color:#ffffff;font-Family:Verdana;'></span><span id='wordloanAmount' style='font-size:11px;
font-weight:normal; color:#ffffff;font-Family:Verdana;text-transform: capitalize;'></span></td>
      </tr>
      </table>
  </div>
    <div class="input_box">
    <table width="98%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td height="30"><span class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Occupation:</span></td>
      </tr>
      <tr>
        <td height="25"><select name="Employment_Status" id="Employment_Status"  onchange="change_empstst(); validateDiv('empStatusVal');" class="hl_emi_select"  style="font-family:Verdana, Geneva, sans-serif; font-size:11px; color:#4c4c4c;" >
<option value="-1">Please Select</option>
<option value="1">Salaried</option>
<option value="0">Self Employed</option>
</select>
<div id="empStatusVal"></div></td>
      </tr>
      </table>
  </div>
      <div class="input_box">
    <table width="98%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td height="30"><span class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Annual Income:</span></td>
      </tr>
      <tr>
        <td height="25"><input type="text" name="IncomeAmount" id="IncomeAmount" class="hl_emi_input"  onkeyup="intOnly(this); getDiToWordsIncome('IncomeAmount','formatedIncome','wordIncome');" onKeyPress="intOnly(this);"  onblur="getDiToWordsIncome('IncomeAmount','formatedIncome','wordIncome');"  onchange="ShowHide('incomeShow','IncomeAmount');" onKeyDown="validateDiv('netSalaryVal');"  />
<div id="dialog-modal" > </div>
<div id="netSalaryVal"></div> <span id='formatedIncome' style='font-size:11px;
font-weight:normal; color:#ffffff;font-Family:Verdana;'></span> <span id='wordIncome' style='font-size:11px;
font-weight:normal; color:#ffffff;font-Family:Verdana;text-transform: capitalize;'></span></td>
      </tr>
      </table>
  </div>
       <div class="input_box">
    <table width="98%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td height="30"><span class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">City:</span></td>
      </tr>
      <tr>
        <td height="25"><select name="City" id="City" class="hl_emi_select" style=" font-family:Verdana, Geneva, sans-serif; font-size:11px; color:#4c4c4c;"  onchange="addPersonalDetails(); othercity1(); addhdfclife(); validateDiv('cityVal');" tabindex="7">
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
      <option value="Navi Mumbai">Navi Mumbai</option>
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
<option value="Vapi">Vapi</option>
<option value="Ankleshwar">Ankleshwar</option>
<option value="Anand">Anand</option>
<option value="Anand">Dahod</option>
<option value="Anand">Navsari</option>
</select>
<div id="cityVal"></div></td>
      </tr>
      <tr><td id="otherCityName"></td></tr>
      </table>
  </div>
  <div style="clear:both;"></div> 
 
  <div style="width:100%; padding-left:15px;" id="personalDetails"> <table cellpadding="0" width="90%"><tr><td   align="right" valign="top" style="padding-top:5px; padding-bottom:5px;"><img src="/images/pl-get.jpg" border="0" /></td></tr></table>    </div>
  </div>
</form>