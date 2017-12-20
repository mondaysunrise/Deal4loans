<?php
if((strlen(strpos($_SERVER['REQUEST_URI'], "/loans/car-loan/sbi-advantage-car-loans-car-loan-scheme-sbi/")) > 0))
{	//$responsiveTheme = "inactive"; 
$responsiveTheme = "inactive";
}	else{	$responsiveTheme = "inactive";}
//$responsiveTheme = "inactive";
if($responsiveTheme == "active")
{
    include "car_loan_form1.php";
 }
 else
  {
   ?> <link href="http://www.deal4loans.com/css/wp_cl.css" rel="stylesheet" type="text/css" /><script type="text/javascript" src="http://www.deal4loans.com/validate_cl_wp.js"></script><script src='http://www.deal4loans.com/scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script><script type="text/javascript" src="http://www.deal4loans.com/scripts/common.js"></script><script type="text/javascript" src="http://www.deal4loans.com/ajax.js"></script><script type="text/javascript" src="http://www.deal4loans.com/ajax-dynamic-list-clhdfc.js"></script><style type="text/css">	#ajax_listOfOptions{		position:absolute; width:250px;	height:160px; overflow:auto; border:1px solid #317082;			background-color:#FFF;    	color: black;		font-family:Verdana, Arial, Helvetica, sans-serif;		text-align:left;		font-size:10px;		z-index:50;	}	#ajax_listOfOptions div{			margin:1px;				padding:1px;		cursor:pointer;		font-size:10px;	}	#ajax_listOfOptions .optionDivSelected{ 		background-color:#2375CB;		color:#FFF;	}	#ajax_listOfOptions_iframe{		background-color:#F00;		position:relative;		z-index:5;	}	</style><div class="pl_form_box"> <form name="carloan_form" method="post" action="http://www.deal4loans.com/insert-car-loan-values1.php" onSubmit="return chkcarloan(document.carloan_form);"> <input type="hidden" name="PostURL" value="<?php echo $_SERVER['REQUEST_URI']; ?>"> <input type="hidden" name="source" value="<? the_title(); ?>"><div class="pl_form_title" style="width:700px;">   <h2 class="text3" style=" color:#FFF; font-size:20px; text-transform:none; padding-top:3px; padding-bottom:2px; "> <span style="color:#8dae48;"> </span> <?php if((strlen(strpos($_SERVER['REQUEST_URI'], "hdfc-car-loan-eligibility-interest-rates-and-documents-requirement-for-apply-hdfc-bank-car-loans")) > 0))
{	echo "Apply for Car loan from HDFC Bank at best rates"; }
else{ 	echo "Apply for Best NRI Car Loan from Deal4loans Associated Banks";}	?>
    </h2>
<div class="text3" style=" color:#FFF; font-size:15px; text-transform:none; width:100%;"><span style=" color:#FFF; font-size:11px; height:30; text-transform:capitalize; ">Offers for 100% Finance <span style="color:#FF0000; font-weight:bold;">*</span> | Rate as low as 10.5% for New Car Loan <span style="color:#FF0000; font-weight:bold;">*</span> | 100% waiver in foreclosure charges after 12 months <span style="color:#FF0000; font-weight:bold;">*</span></span></div>
</div>
<div style="clear:both;"></div>
<div style="padding-left:20px; font-size:19px; color:#FFFFFF;">
Professional Details
</div>
<div style="clear:both;"></div>
<div class="pl_input_box">
  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">

    <tr>
    
      <td height="25" ><span class="text" style=" float:left; height:auto; color:#FFF; font-size:12px; text-transform:none;">Loan Amount:</span></td>
    </tr><tr>
      <td height="25"><input name="Loan_Amount" id="Loan_Amount" tabindex="14" type="text" class="pl_input_b" maxlength="10" onfocus="this.select();" onchange="ShowHide('loanShow','Loan_Amount');"  onkeyup="intOnly(this);getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');"  onkeydown="getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" onkeypress="intOnly(this); getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" onblur="getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" />
      </td>
    </tr>
     <tr>                       <td  class="text" style=" padding-top:3px; color:#FFF; font-size:12px; text-transform:none;"><span id='formatedlA' style='font-size:11px; font-weight:normal; color:#ffffff;font-Family:Verdana;'></span><span id='wordloanAmount' style='font-size:11px; font-weight:normal; color:#ffffff;font-Family:Verdana;text-transform: capitalize;'></span></td>                    </tr>
         </table>
    </div>
<div class="pl_input_box">
  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td height="25" ><span class="text" style=" float:left; height:auto; color:#FFF; font-size:12px; text-transform:none;">Occupation:</span></td>
    </tr><tr>   <td height="25">
      <select   name="Employment_Status"  id="Employment_Status" class="pl_select_b" tabindex="10" >
                           <option value="-1">Employment Status</option>
                           <option value="1">Salaried</option>
                           <option value="0">Self Employment</option>
                       </select>
     </td>
    </tr>
     </table>
    </div>
    <div class="pl_input_box">
  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">

    <tr>
      <td height="25"><span class="text" style=" float:left; height:auto; color:#FFF; font-size:12px; text-transform:none;">Annual Income:</span></td>
    </tr><tr>
      <td height="25">
      <input type="text" name="Net_Salary" id="Net_Salary" class="pl_input_b" onkeyup="intOnly(this); getDiToWordsIncome('Net_Salary','formatedIncome','wordIncome');" onkeypress="intOnly(this);"  onblur="getDiToWordsIncome('Net_Salary','formatedIncome','wordIncome');"  onchange="ShowHide('incomeShow','Net_Salary');" tabindex="11" />
      
     </td>
    </tr>
    
       <tr>  <td  class="text" style=" padding-top:3px; color:#FFF; font-size:12px; text-transform:none;"><span id='formatedIncome' style='font-size:11px;
font-weight:normal; color:#ffffff;font-Family:Verdana;'></span> <span id='wordIncome' style='font-size:11px;
font-weight:normal; color:#ffffff;font-Family:Verdana;text-transform: capitalize;'></span></td> </tr>
        </table>
    </div>


<div class="pl_input_box">
  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td height="25"><span class="text" style=" float:left; height:auto; color:#FFF; font-size:12px; text-transform:none;">City:</span></td>
     </tr><tr>
      <td height="25" ><select name="City" id="City" class="pl_select_b" onChange="addPersonalDetails(); addhdfclife_cl(document.carloan_form);">
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
                         <div id="cityVal"></div>   </td>
    </tr>
        </table>
    </div>
<div style="clear:both;"></div>
<div id="other_Details">

<div class="pl_terms_box"><input type="checkbox"  name="accept" style="border:none;"  > I Agree to&nbsp;<a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow"  class="text" style=" color:#88a943; font-size:11px; text-decoration:underline;">privacy policy</a> and&nbsp;<a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow" class="text" style=" color:#88a943; font-size:11px; text-decoration:underline;">Terms and Conditions</a>.</div>                  <div class="cl_new_bnt_b" style="margin-top:6px; margin-right:20px;"><img src="http://www.deal4loans.com/images/get1.gif" width="114" height="52" border="0" /></div>

</div>
<div style="clear:both;"></div>
<div id="personalDetails"></div>
</form></div>
<div style="clear:both;"></div>
    <?php
	}
	?>