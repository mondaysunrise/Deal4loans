<?php
	session_start();
	require 'scripts/functions.php';
	$IP_Remote = $_SERVER["REMOTE_ADDR"];
if($IP_Remote=='192.124.249.12' || $IP_Remote=='185.93.228.12') { $IP= $_SERVER['HTTP_X_SUCURI_CLIENTIP']; }
else { $IP= $IP_Remote;	}
if($IP=="122.176.100.27" || $IP=="122.176.100.28" || $IP=="122.176.122.134" || $IP=="122.161.196.68" || $IP=="122.160.74.241" || $IP=="122.160.74.235")
{
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php 
	 if(isset($_SESSION['UserType']))
	{
echo "<table width='100%' border='0' cellspacing='0' cellpadding='0'><tr><td width='323' height='93' align='left' valign='top'  ><img src='http://www.deal4loans.com/images/logo.gif' width='323' height='93' /></td><td align='left' valign='top' style='color:#0B6FCC;' ><table width='100%' border='0' cellspacing='0' cellpadding='0' bgcolor='#0A92C0'><tr><td height='67' align='right' valign='middle' bgcolor='#C8E3F3' style='padding-right:10px;'><table border='0' align='right' cellpadding='0' cellspacing='0' bgcolor='#0A92C0'><tr><td width='6' height='32' align='left' valign='top'><img  src='http://www.deal4loans.com/rnew/images/login-form-logut-lft.gif' width='6' height='32' /></td><td background='http://www.deal4loans.com/rnew/images/login-form-logut-bg.gif' style=' background-repeat:repeat-x; height:32px;'><table width='100%' border='0' align='center' cellpadding='0' cellspacing='0'><tr><td align='left' valign='middle' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#FFFFFF; font-weight:bold; padding-right:15px;' > Welcome ".ucwords($_SESSION['UserType'])." ".$_SESSION['UName']."</td><td align='left' style='padding-right:2px;' width='22'><img src='http://www.deal4loans.com/rnew/images/login-logut-btn.gif' /></td><td align='right' class='style1' style='color:#FFFFFF; font-weight:bold;'><div align='right' class='style1' style='color:#FFFFFF; font-weight:bold;'> <a href='Logout.php' style='color:#FFFFFF; font-size:13px; text-decoration:none; font-family:Verdana, Arial, Helvetica, sans-serif;'>Logout</a></div></td></tr></table></td><td width='6' height='32'><img src='http://www.deal4loans.com/rnew/images/login-form-logut-rgt.gif' width='6' height='32' /></td></tr></table></td></tr><tr><td>&nbsp;</td></tr></table></td></tr></table>";
	}
?>

<title>Untitled Document</title>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script src='scripts/pldigittowordconverter.js' type='text/javascript' language='javascript'></script>
<script type="text/javascript" src="ajax.js"></script>
<script type="text/javascript" src="ajax-dynamic-pllist.js"></script>
<style>
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
	body{
	margin:0px;
	padding:0px;
	font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:11px;
	line-height:16px;
	color:#292323;

}

input{
	margin:0px;
	padding:0px;
	border:1px solid #878787;
}

select{
	margin:0px;
	padding:0px;
	border:1px solid #878787;

}

.bldtxt{
font-weight:bold;
line-height:16px;
color:#4f4d4d;
}


.txt ul{
	margin:0px 0px 0px 2px;
	padding:0px 0px 0px 2px;
}

.txt ul li{
	background: url(images/cl/arrow.gif) no-repeat 0px 4px;
	list-style-type:none;
	color:#292323;
	padding-left:15px; 
	padding-right:0; 
	padding-top:0; 
	padding-bottom:4px 
}
</style>
<script language="javascript">
function addElement()
{
		var ni = document.getElementById('myDiv');
		
		if(ni.innerHTML=="")
		{
		
			if(document.personalloan_form.CC_Holder.value="on")
			{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '<div  class="form-bg"><span class="form-text"><b>Card held since?</b></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<select class="style4" size="1" name="Card_Vintage" style="width:140px; "><option value="0">Please select</option> <option value="1">Less than 6 months</option>		 <option value="2">6 to 9 months</option> <option value="3">9 to 12 months</option>				<option value="4">more than 12 months</option> </select></div>';				

			}
		}
		
		return true;
	}

function removeElement()
{
		var ni = document.getElementById('myDiv');
		
		if(ni.innerHTML!="")
		{		
			if(document.personalloan_form.CC_Holder.value="on")
			{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '';
				
			}
		}
		
		return true;

	}
	
function othercity1()
{
if(document.personalloan_form.City.value=='Others')
{
document.personalloan_form.City_Other.disabled=false;
}
else
{document.personalloan_form.City_Other.disabled=true;
}
}

function addElementLoan()
{
		var ni = document.getElementById('myDivLoan');
		
		if(ni.innerHTML=="")
		{			
				ni.innerHTML = '<table width="100%" border="0" align="left" cellpadding="0" cellspacing="0"><tr><td width="240"  height="20" align="left" class="bldtxt"><b>Any type of loan(s) running?</b> </td><td colspan="3" align="left" ><table width="100%" border="0" align="left" cellpadding="0" cellspacing="0"><tr> <td    height="20" align="left" ><input type="checkbox" style="border:none;" id="Loan_Any" name="Loan_Any[]"  value="hl" /> Home</td><td align="left"><input type="checkbox" style="border:none;"  id="Loan_Any" name="Loan_Any[]" value="pl" /> Personal</td><td align="left">&nbsp;</td></tr><tr> <td  width="71" height="20" align="left" ><input type="checkbox" style="border:none;"  name="Loan_Any[]"  id="Loan_Any" value="cl" /> Car</td><td width="93" align="left"  ><input type="checkbox" style="border:none;" name="Loan_Any[]" id="Loan_Any"  value="lap" /> Property</td><td width="160" align="left"  ><input type="checkbox" style="border:none;" name="Loan_Any[]" id="Loan_Any"  value="other" /> Other</td></tr></table></td></tr><tr><td align="left" height="30" class="bldtxt">How many EMI paid?  </td> <td colspan="3"  align="left" width="324"><select name="EMI_Paid" style="width:203px;"  > <option value="0">Please select</option><option value="1">Less than 6 months</option> <option value="2">6 to 9 months</option> <option value="3">9 to 12 months</option> <option value="4">more than 12 months</option ></select></td></tr><tr><td align="left" height="30" class="bldtxt">Total Amount of EMI Paying?  </td> <td colspan="3"  align="left" width="324"><input type="text" name="PL_EMI_Amt" id="PL_EMI_Amt" onKeyUp="intOnly(this);" onChange="intOnly(this);"></td></tr></table>';
			}
		
		return true;
}

function removeElementLoan()
{
		var ni = document.getElementById('myDivLoan');
		
		if(ni.innerHTML!="")
		{		
			//alert(document.loan_form.CC_Holder.value);
			ni.innerHTML = '';				
		}
		return true;
	}
</script>
</head>
<body>
<table align="center">
<tr><td>
<form name="personalloan_form"  action="/bajajfinserv_mlrentry_continue.php" method="POST" onSubmit="return chkpersonalloan(document.personalloan_form);">
<input type="hidden" name="Type_Loan" value="Req_Loan_Personal">
<input type="hidden" name="source" value="Bajajfinserv_DIRECT">
<table width="95%"  border="0" align="right" cellpadding="2" cellspacing="0">
				<tr align="left">
				  <Td colspan="2" height="35" align="center"> <b>Personal Loan Form (Bajaj Finserv)</b></Td>				 
				  </tr>
				<tr align="left">
				<Td width="40%" class="bldtxt">Full Name </Td>
 				<Td width="60%"><input name="Name" type="text" id="Name" style=" width:140px;" /></Td>
				</tr>
				<tr align="left">
				  <Td height="26" class="bldtxt">DOB</Td>
				  <Td><input name="day" type="text" id="day" value="dd" style="width:40px; " onBlur="onBlurDefault(this,'dd');"  onFocus="onFocusBlank(this,'dd');" maxlength="2" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);"/> <input name="month" id="month" type="text" value="mm"  style="width:40px; " onBlur="onBlurDefault(this,'mm');"  onFocus="onFocusBlank(this,'mm');" maxlength="2" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);"/> <input name="year" id="year" type="text" value="yyyy"   style="width:47px; " onBlur="onBlurDefault(this,'yyyy');"  onFocus="onFocusBlank(this,'yyyy');" maxlength="4" onChange="intOnly(this); insertData();" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);"/></Td>
				  </tr>
				<tr align="left">
				  <Td height="26" class="bldtxt">Mobile No. </Td>
				  <Td>+91 
	  <input name="Phone" id="Phone" type="text"  style="width:110px; " onChange="intOnly(this); tosendsms(); insertData();" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" onFocus="addtooltip();" maxlength="10"  /></Td>
				  </tr>
				 
				<tr align="left">
				  <Td height="26" class="bldtxt">Email Id </Td>
				  <Td><input name="Email" id="Email" type="text" style="width:140px; "/></Td>
				  </tr>
				<tr align="left">
				  <Td height="26" class="bldtxt">City</Td>
				  <Td><select style="width:142px; height:18px;  "  name="City" id="City" onchange="othercity1(this);"  >
        <?=plgetCityList($City)?>
      </select>
 
	  </Td>
				  </tr>
				<tr align="left">
				  <Td height="26" class="bldtxt">Other City </Td>
				  <Td><input name="City_Other" id="City_Other" type="text" value="Other City" style="width:140px; " disabled  /></Td>
				  </tr>
				<!--<tr align="left">
				  <Td height="26" class="bldtxt">Pincode</Td>
				  <Td><input name="Pincode" id="Pincode" type="text"  MAXLENGTH="6" style="width:140px; "  onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" /></Td>
				  </tr>-->
				<tr align="left">
				  <Td height="26" class="bldtxt">Occupation</Td>
				  <Td><select   style="width:140px;"  name="Employment_Status" id="Employment_Status" >
        <option selected value="-1">Employment Status</option>
        <option  value="1">Salaried</option>
        <option value="0">Self Employed</option>
      </select></Td>
				  </tr>
				<tr align="left">
				  <Td height="26" class="bldtxt">Company Name </Td>
				  <Td><input name="Company_Name" id="Company_Name" type="text" style="width:140px; " onKeyUp="ajax_showOptions(this,'getCountriesByLetters',event)" /></Td>
				  </tr>
				<tr align="left">
				  <Td height="26" class="bldtxt">Annual Income </Td>
				  <Td><input name="IncomeAmount" id="IncomeAmount" type="text"  style="width:140px; " onFocus="this.select();"  onChange="intOnly(this); " />
				  </Td>
				  </tr>
				 
				<tr align="left">
				  <Td height="26" class="bldtxt">Loan Amount </Td>
				  <Td><input name="Loan_Amount" id="Loan_Amount" type="text"  style="width:140px; " >
				</Td>
				  </tr>
				  
				<tr align="left">
				  <Td height="26" class="bldtxt" >Are you a Credit card holder?</td>
				  <Td>
<input type="radio"  name="CC_Holder" id="CC_Holder" value="1"  style="border:none;" onclick="addElement();" >
Yes
<input type="radio"  name="CC_Holder" id="CC_Holder" style="border:none;" value="0" onClick="removeElement();">
No</Td>
			 </tr>
			          
            <tr>
               <Td colspan="2" ><div  id="myDiv"></div></Td>
              </tr>
            <!--<tr>
              <td width="234" height="35" align="left" class="bldtxt">Primary Account 
                in which bank?</td>
              <td width="313" height="20"  align="left"><input type="text" style="width:200px;" name="Primary_Acc" id="Primary_Acc" ></td>
            </tr>
            <tr>
              <td height="20" align="left" class="bldtxt">Residential Status </td>
              <td  align="left" ><table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
                  <tr>
                    <td width="6%" ><input type="radio" style="border:none;" value="1" name="Residential_Status"  checked="checked" /></td>
                    <td width="19%" >                        Owned</td>
                    <td width="6%" ><input type="radio" style="border:none;" value="2" name="Residential_Status" /></td>
                    <td width="19%" >                        Rented</td>
                    <td width="6%" ><input type="radio" style="border:none;" value="3" name="Residential_Status" /></td>
                    <td width="44%" > Company Provided</td>
                  </tr>
              </table></td>
            </tr>-->
			<!--<tr>
                <td height="35" class="bldtxt">Company Type</td>
          <td class="frmtxt"><select name="Company_Type" id="Company_Type" style="width: 203px;">
		  <option value="0">Please Select</option>
		  	<option value="1">Pvt Ltd</option>
			<option value="2">MNC Pvt Ltd</option>
			<option value="3">Limited</option>
			<option value="4">Govt.( Central/State )</option>
		<option value="5">PSU (Public sector Undertaking)</option>
			</select></td>
        </tr>  -->
            <!--<tr>
              <td height="35" align="left" class="bldtxt" >No. of years in  
                this Company</td>
              <td align="left" ><input type="text" name="Years_In_Company" style="width:200px;" maxlength="15"></td>
            </tr>
            <tr>
              <td height="42" align="left" class="bldtxt" >Total Experience (Years)/
                Total Years  
                in Business</td>
              <td align="left" ><input style="width:200px;"  name="Total_Experience" onfocus="this.select();">              </td>
            </tr>-->
                        <? if ($_SESSION['Temp_CC_Holder']==1 || $_SERVER['Temp_CC_Holder']==1)
			{?>
            <tr>
              <td height="30" align="left" class="bldtxt" >Credit Card Limit?</td>
              <td align="left" ><input style="width:200px;" name="Credit_Limit" onchange="intOnly(this);" onkeyup="intOnly(this);" onkeypress="intOnly(this);" onfocus="this.select();">              </td>
            </tr>
            <? } ?>
            <!--<tr>
              <td height="30" align="left" class="bldtxt" >Any Loan running?</td>
              <td align="left" ><input type="radio" style="border:none;"  value="1"  name="LoanAny"  onclick="addElementLoan(); addDiv();" /> Yes &nbsp;  <input size="10" type="radio" style="border:none;" name="LoanAny"  onclick="removeElementLoan();" value="0"> No</td>
            </tr>
            <tr>
              <td colspan="2" id="myDivLoan"></td>
            </tr>-->
           
            <tr>
              <td  colspan="2" align="left"  >&nbsp;</td>
            </tr>            		 				
				<tr align="center">
				  <Td colspan="2"><input type="image" name="Submit"  src="new-images/pl/quote.gif"  style="width:115px; height:29px; border:none; " /></Td>
				  </tr>
                </table>
				</form>
				</td></tr>
				</table>
</body>
</html>
<? } ?>
