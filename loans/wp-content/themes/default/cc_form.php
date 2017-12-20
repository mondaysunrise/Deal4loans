<?php
$maxage=date('Y')-62;
$minage=date('Y')-18;

if((strlen(strpos($_SERVER['REQUEST_URI'], "/loans/credit-card/hdfc-credit-card-eligibility-apply/")) > 0) || (strlen(strpos($_SERVER['REQUEST_URI'], "/loans/banks/sbi-credit-cards/")) > 0) || (strlen(strpos($_SERVER['REQUEST_URI'], "/loans/credit-card/icici-bank-credit-cards-eligibility-documents-apply/")) > 0))
{
	$responsiveTheme = "active";
}	
else
{
	$responsiveTheme = "inactive";
}

if($responsiveTheme == "active")
{
    include "credit_card_form1.php";
 }
 else
  {
   ?> 
<script type="text/javascript" src="http://www.deal4loans.com/scripts/wp_cc.js"></script><script src='http://www.deal4loans.com/scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script><script type="text/javascript" src="http://www.deal4loans.com/ajax.js"></script><script type="text/javascript" src="http://www.deal4loans.com/ajax-dynamic-cclist.js"></script><link href="http://www.deal4loans.com/css/acreditcwp.css" type="text/css" rel="stylesheet" /><style type="text/css">	#ajax_listOfOptions{position:absolute;	width:250px; height:160px;		overflow:auto;		border:1px solid #317082;		background-color:#FFF;    	color: black;		font-family:Verdana, Arial, Helvetica, sans-serif;		text-align:left;font-size:10px;		z-index:50;	}	#ajax_listOfOptions div{			margin:1px;				padding:1px;		cursor:pointer;		font-size:10px;	}	#ajax_listOfOptions .optionDivSelected{background-color:#2375CB;		color:#FFF;}	#ajax_listOfOptions_iframe{		background-color:#F00;		position:relative;		z-index:5;}		form{		display:inline;	}	</style><form  name="creditcard_form" id="creditcard_form" action="http://www.deal4loans.com/get_cc_eligiblebank.php" method="post" onSubmit="return ckhcreditcard(document.creditcard_form); " ><input type="hidden" name="Activate" id="Activate" ><input type="hidden" name="source" value="SEO_D4L_<? the_title(); ?>">
<div class="ac_card_form">
<div class="pl_form_title"><h2 class="text3" style=" color:#FFF; font-size:24px; text-transform:none; "><strong> <?
	//echo $_SERVER['REQUEST_URI'];
	if($_SERVER['REQUEST_URI']=='/loans/banks/sbi-credit-cards/')
	{
		echo "Apply for Best Credit Card";
	}
	else
	{
		$mystring2=$_SERVER['REQUEST_URI'];

		if(stripos($mystring2, "hdfc")>0 && stripos($mystring2, "credit")>0 && stripos($mystring2, "card")>0)
		{
			echo "Apply online for HDFC Credit Cards";
		}
		else if(stripos($mystring2, "icici")>0 && stripos($mystring2, "credit")>0 && stripos($mystring2, "card")>0)
		{
			echo "Apply online for ICICI Credit Cards";
		}
		else if(stripos($mystring2, "standard")>0 && stripos($mystring2, "chartered")>0 && stripos($mystring2, "credit")>0 && stripos($mystring2, "card")>0)
		{
			echo "Apply online for Standard Chartered Credit Cards";
		}
		else
		{
		echo "Apply for Best Credit Cards with Deal4loans Network";
		}
 	}
	?></strong></h2>
</div>
<div style="clear:both;"></div>
<div style="padding-left:20px; font-size:19px; color:#fff;">Professional Details</div>
<div style="clear:both;"></div>
<div class="pl_input_box" style="padding-right:15px;">
  <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td height="25"><span class="text" style=" float:left; height:auto; color:#FFF; font-size:12px; text-transform:none;">Annual Income: </span></td>
    </tr>
    <tr>
      <td height="25"><input type="text" name="Net_Salary" id="Net_Salary" class="pl_input_b" onKeyUp="intOnly(this); getDiToWordsIncome('Net_Salary','formatedIncome','wordIncome');" onKeyPress="intOnly(this);"  onblur="getDiToWordsIncome('Net_Salary','formatedIncome','wordIncome');"  onchange="ShowHide('incomeShow','Net_Salary');" onKeyDown="validateDiv('netSalaryVal');" autocomplete="off"  />
              <div id="dialog-modal" > </div>
        <div id="netSalaryVal"></div>  <span id='formatedIncome' style='font-size:11px;
font-weight:normal; color:#ffffff;font-Family:Verdana;'></span> <span id='wordIncome' style='font-size:11px;
font-weight:normal; color:#ffffff;font-Family:Verdana;text-transform: capitalize;'></span> </td>
    </tr>
   
  </table>
</div>

<div class="pl_input_box" style="padding-right:15px;">
  <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td height="25"><span class="text" style=" float:left; height:auto; color:#FFF; font-size:12px; text-transform:none;">Occupation :</span></td>
    </tr>
    <tr>
      <td height="25"><select name="Employment_Status" id="Employment_Status" class="pl_select_b" onChange="validateDiv('empStatusVal');"  style="height:24px; font-family:Verdana, Geneva, sans-serif; font-size:11px; color:#4c4c4c;" >
                           <option value="-1">Please Select</option>
                           <option value="1">Salaried</option>
                           <option value="0">Self Employment</option>
                     </select><div id="empStatusVal" class="alert_msg"></div>  </td>
    </tr>
    
  </table>
</div>
<div class="pl_input_box" style="padding-right:15px;">
  <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
   <tr>
      <td height="25"><span class="text" style=" float:left; height:auto; color:#FFF; font-size:12px; text-transform:none;">Salary/Current Account:</span></td>
    </tr>
    <tr>
      <td height="25"> <select name="salary_account" id="salary_account" style="height:24px; font-family:Verdana, Geneva, sans-serif; font-size:11px; color:#4c4c4c;"  class="pl_select_b" onChange="validateDiv('salAccountVal');"  >
				  <option name="">Please Select</option>
				  <option value="HDFC Bank">HDFC Bank</option>
				  <option value="ICICI Bank">ICICI Bank</option>
				  <option value="Kotak Bank">Kotak Bank</option>
				  <option value="Standard Chartered">Standard Chartered</option>
				  <option value="Others">Others</option>
				  </select>
          <div id="salAccountVal"></div> </td>
    </tr>
  </table>
</div>
<div class="pl_input_box" >
  <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
      <td height="25"><span class="text" style=" float:left; height:auto; color:#FFF; font-size:12px; text-transform:none;">City:</span></td>
    </tr>
    <tr>
      <td height="25"> <select name="City" id="City" class="pl_select_b" style="height:24px; font-family:Verdana, Geneva, sans-serif; font-size:11px; color:#4c4c4c;" onChange="addPersonalDetails(); addhdfclife(); validateDiv('cityVal');" tabindex="7">
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
</select>
                         <div id="cityVal"></div></td>
    </tr>
</table>
</div>
<div style="clear:both; height:5px;"></div>
<div id="personalDetails"> <table border="0" cellpadding="0" width="94%"> <tr><td style="padding-left:25px;">&nbsp;</td><td width="25%"   align="right" valign="top"><img src="http://www.deal4loans.com/images/get1.gif" border="0" /></td></tr></table></div>
<div id="addSubmit"></div>
</div>
</form>
<?php
}
?>