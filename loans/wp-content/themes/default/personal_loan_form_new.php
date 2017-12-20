<?php 
$maxage=date('Y')-62;
$minage=date('Y')-18;
?>
<style type="text/css">
	#ajax_listOfOptions{		position:absolute;			width:250px;			height:160px;			overflow:auto;			border:1px solid #317082;			background-color:#FFF;	    	color: black;		font-family:Verdana, Arial, Helvetica, sans-serif;		text-align:left;		font-size:10px;		z-index:50;	}	#ajax_listOfOptions div{			margin:1px;				padding:1px;		cursor:pointer;		font-size:10px;	}
	#ajax_listOfOptions .optionDivSelected{ 		background-color:#2375CB;		color:#FFF;	} 	#ajax_listOfOptions_iframe{		background-color:#F00;		position:relative;		z-index:5;	}	form{		display:inline;	}	</style>
    <script type="text/javascript" src="http://www.deal4loans.com/ajax.js"></script><script type="text/javascript" src="http://www.deal4loans.com/ajax-dynamic-pllist.js"></script><script src='http://www.deal4loans.com/scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script><script type="text/javascript" src="http://www.deal4loans.com/scripts/common.js"></script><script language="JavaScript" type="text/javascript" src="http://www.deal4loans.com/suggest.js"></script>
<script language="JavaScript" type="text/javascript" src="http://www.deal4loans.com/pl_wp_js.js"></script>
<div style="float:right; clear:right;  width:290px; height:auto; margin-top:18px;">
<div class="text3" style="width:290px; margin:auto; height:auto; font-size:11px; color:#88a943; margin-top:0px;">
<form name="personalloan_form"  action="http://www.deal4loans.com/insert_personal_loanstage1.php" method="POST" onSubmit="return chkpersonalloan(document.personalloan_form);">
<input type="hidden" name="Type_Loan" value="Req_Loan_Personal" />
<input type="hidden" name="creative" value="<? echo $_REQUEST['creative'] ?>">
<input type="hidden" name="section" value="<? echo $_REQUEST['section'] ?>">
<input type="hidden" name="referrer" value="<? echo $_REQUEST['referrer'] ?>"> 
<input type="hidden" name="Activate" id="Activate" >
<input type="hidden" name="PostURL" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
<input type="hidden" name="source" value="SEO_D4L_<? the_title(); ?>">
<table width="290" border="0" cellspacing="0" cellpadding="0">
<tr>
	<td height="10" align="left" valign="top"><img src="http://www.deal4loans.com/images/bgtop.jpg" width="290" height="10" /></td>
</tr>
<tr>
	<td align="left" valign="top" bgcolor="#21405F"><table border="0" cellpadding="0" cellspacing="0">
<tr>
	<td width="28" align="left" valign="top">&nbsp;</td>
	<td  align="left" valign="top" width="279">
		<table width="285" border="0" cellpadding="3" cellspacing="3">
		<tr>
			<td align="left" valign="top" colspan="2" style=" color:#FFF; font-size:15px;  text-align:center; height:30; ">
				<strong>Apply for Personal Loan</strong>			</td>
		</tr>
        <tr>
			<td align="left" valign="top" colspan="2" style=" color:#FFF; font-size:11px; height:30; text-transform:capitalize; ">
  <strong>Bank A</strong> - 13.99 % for select companies<span style="color:#FF0000; font-weight:bold;">*</span> <br /> <strong>Bank B</strong>- 0% prepayment Charges<span style="color:#FF0000; font-weight:bold;">*</span><br /> <strong>Bank C</strong>- Discount on processing fee<span style="color:#FF0000; font-weight:bold;">*</span><br />Check your free customized offer now from 5 others.
 <hr style="color:#CCCCCC;" />
 </td>
		</tr>
<tr>
<td width="99" height="23" align="left" valign="top" class="text" style="  color:#FFF; font-size:11px; ">
Full Name</td><td width="161" class="text" style="  color:#FFF; font-size:11px;  " height="23">
<input name="Name" id="Name" type="text" style="width:150px; height:18px;" onKeyDown="validateDiv('nameVal');" />
<div id="nameVal"></div>    
</td>
</tr>
<tr>
<td width="99" height="23" class="text" style="  color:#FFF; font-size:11px; ">
Mobile</td>
<td width="161" class="text" style="  color:#FFF; font-size:11px;  ">
+91 
<input name="Phone" id="Phone" maxlength="10" onkeyup="intOnly(this);" onkeypress="intOnly(this)"; onchange="intOnly(this);" type="text" style="width:128px; height:18px;" onkeydown="validateDiv('phoneVal');"  />
            <div id="phoneVal"></div>    
</td>
</tr>
<tr>
<td width="99" height="23" class="text" style="  color:#FFF; font-size:11px; ">
Email ID </td>
<td width="161" class="text" style="  color:#FFF; font-size:11px;  ">
<input name="Email" id="Email" type="text" style="width:150px; height:18px;" onkeydown="validateDiv('emailVal');"  />
          <div id="emailVal"></div>   
</td>
</tr>
<tr>
<td width="99" height="23" align="left" valign="top" class="text" style="  color:#FFF; font-size:11px; ">
City</td>
<td width="161" class="text" style="  color:#FFF; font-size:11px;  ">
    <select name="City" id="City" style="width:154px; height:24px; font-family:Verdana, Geneva, sans-serif; font-size:11px; color:#4c4c4c;" onchange="addhdfclife(); validateDiv('cityVal');" tabindex="7">
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
<td width="99" height="23" align="left" valign="top" class="text" style="color:#FFF; font-size:11px;  padding-right:2px;">
Annual Income</td>
<td width="161" class="text" style="color:#FFF; font-size:11px;  ">
  <input type="text" name="IncomeAmount" id="IncomeAmount" style="width:150px; height:18px;"  onkeyup="intOnly(this); getDigitToWords('IncomeAmount','formatedIncome','wordIncome');" onkeypress="intOnly(this);"  onblur="getDigitToWords('IncomeAmount','formatedIncome','wordIncome');"  onchange="ShowHide('incomeShow','IncomeAmount');" onkeydown="validateDiv('netSalaryVal');"  />
              
        <div id="netSalaryVal"></div>  
</td>
</tr>
<tr><td colspan="2"> <span id='formatedIncome' style='font-size:11px;
font-weight:normal; color:#ffffff;font-Family:Verdana;'></span> <span id='wordIncome' style='font-size:11px;
font-weight:normal; color:#ffffff;font-Family:Verdana;text-transform: capitalize;'></span></td></tr>
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
<tr>
<td align="left" valign="top" colspan="2" class="text9" style=" color:#FFF; font-size:8px; margin-top:0px; ">
  <input name="accept" type="checkbox"  tabindex="7" onclick="validateDiv('acceptVal');"/>  
     I Agree to <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow"  class="text" style="font-size:8px;  color:#88a943; text-decoration:underline;">privacy policy</a> and&nbsp;<a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow" class="text" style=" color:#88a943; font-size:8px; text-decoration:underline;">Terms and Conditions</a> of deal4loans.com.
     <div id="acceptVal"></div>
</td>
</tr>
<tr>
<td>&nbsp;</td><td  align="center" valign="top"  style= "margin-left:0px;">
<input type="submit" style="border: 0px none ; background-image: url(http://www.deal4loans.com/images/get_quot.jpg); width: 94px; height: 27px; margin-bottom: 0px;" value="" tabindex="8"/>
</td>
</tr> 
<tr>
<td align="left" valign="top" colspan="2" class="text9" style=" color:#FFF; font-size:9px; margin-top:0px; text-transform:capitalize;">
<span style="color:#FF0000; font-weight:bold;">*</span> All loans and offers on sole discretion of banks.
</td>
</tr> 
</table>
        </td>
</tr>
</table></td>
</tr>
<tr>
<td height="15" align="left" valign="top"><img src="http://www.deal4loans.com/images/bgbottom.jpg" width="290" height="10" /></td>
</tr>
</table>
</form>
</div>
</div>