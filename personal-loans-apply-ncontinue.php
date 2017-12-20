<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	
	
	$sql = "select source from Req_Loan_Personal where RequestID = '".$_SESSION['Temp_LID']."'";
	list($alreadyExist,$query)=MainselectfuncNew($sql,$array = array());
	$source = $query[0]['source'];	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Personal Loan</title>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script type="text/javascript" src="scripts/mootools.js"></script>
 <script type="text/javascript" src="ajax.js"></script>
<script type="text/javascript" src="ajax-dynamic-list.js"></script>
<style type="text/css">
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


.orgtext {
color:#D75B10;
font-family:Verdana,Arial,Helvetica,sans-serif;
font-size:11px;
font-weight:bold;
line-height:16px;
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
form{
		display:inline;
		margin:0px;
		padding:0px;
}
	/* Big box with list of options */
	#ajax_listOfOptions{
		position:absolute;	/* Never change this one */
		width:280px;	/* Width of box */
		height:50px;	/* Height of box */
		overflow:auto;	/* Scrolling features */
		border:1px solid #317082;	/* Dark green border */
		background-color:#FFF;	/* White background color */
    color: black;
		text-align:left;
		font-size:0.9em;
		z-index:100;
	}
	#ajax_listOfOptions div{	/* General rule for both .optionDiv and .optionDivSelected */
		margin:1px;		
		padding:1px;
		cursor:pointer;
		font-size:0.9em;
	}
	#ajax_listOfOptions .optionDiv{	/* Div for each item in list */
		
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
</style>

<Script Language="JavaScript" Type="text/javascript">

function addDiv()
{
		var ni = document.getElementById('mynewDiv');
		
		if(ni.innerHTML=="")
		{
		
			if(document.personalloan_form.LoanAny.value="on")
			{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '<div id="expanddiv" class="expandeddiv" ></div>';
				

			}
		}
		
		return true;

	}
function onFocusBlank(element,defaultVal){
	if(element.value==defaultVal){
		element.value="";
	}
}

function onBlurDefault(element,defaultVal){
	if(element.value==""){
		element.value = defaultVal;
	}
}


function addElementLoan()
{
		var ni = document.getElementById('myDivLoan');
		
		if(ni.innerHTML=="")
		{
		
			
				ni.innerHTML = '<table width="100%" border="0" align="left" cellpadding="0" cellspacing="0"><tr><td width="240"  height="20" align="left" class="bldtxt">Any type of loan(s) running? </td><td colspan="3" align="left" ><table width="100%" border="0" align="left" cellpadding="0" cellspacing="0"><tr> <td    height="20" align="left" ><input type="checkbox" style="border:none;" id="Loan_Any" name="Loan_Any[]"  value="hl" /> Home</td><td align="left"><input type="checkbox" style="border:none;"  id="Loan_Any" name="Loan_Any[]" value="pl" /> Personal</td><td align="left">&nbsp;</td></tr><tr> <td  width="71" height="20" align="left" ><input type="checkbox" style="border:none;"  name="Loan_Any[]"  id="Loan_Any" value="cl" /> Car</td><td width="93" align="left"  ><input type="checkbox" style="border:none;" name="Loan_Any[]" id="Loan_Any"  value="lap" /> Property</td><td width="160" align="left"  ><input type="checkbox" style="border:none;" name="Loan_Any[]" id="Loan_Any"  value="other" /> Other</td></tr></table></td></tr><tr><td align="left" height="30" class="bldtxt">How many EMI paid?  </td> <td colspan="3"  align="left" width="324"><select name="EMI_Paid" style="width:203px;"  > <option value="0">Please select</option><option value="1">Less than 6 months</option> <option value="2">6 to 9 months</option> <option value="3">9 to 12 months</option> <option value="4">more than 12 months</option ></select></td></tr><tr><td align="left" height="30" class="bldtxt">Total Amount of EMI Paying?  </td> <td colspan="3"  align="left" width="324"><input type="text" name="PL_EMI_Amt" id="PL_EMI_Amt" onKeyUp="intOnly(this);" onChange="intOnly(this);"></td></tr></table>';
			
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

	function submitform(Form)
	{

var btn2;
	var btn3;
	var myOption;
	var i;
	
	if(Form.Primary_Acc.value=="")
		{
			alert("Please fill your Salary Account.");
			Form.Primary_Acc.focus();
			return false;
		}
	
	if (Form.Years_In_Company.value=="")
	{
		alert("Please enter Years in Company.");
		Form.Years_In_Company.focus();
		return false;

	}	
	if(!checkNum(Form.Years_In_Company, 'No of years in current company',0))
		return false;

	if (Form.Total_Experience.value=="")
	{
		alert("Please enter Total Experience.");
		Form.Total_Experience.focus();
		return false;
	}	
	if(!checkNum(Form.Total_Experience, 'Total Experience',0))
		return false;

	myOption = -1;
		for (i=Form.LoanAny.length-1; i > -1; i--) {
			if (Form.LoanAny[i].checked) {
				if(i==0)
				{
					btn2=valButtonLoan();
					if(!btn2)
					{
						alert('Type of loan running.');
						return false;
					}
					if(Form.EMI_Paid.selectedIndex==0)
					{
						alert('No of EMI paid.');
						Form.EMI_Paid.focus();
						return false;
					}

				}
				myOption = i;
			}
		}
		if(myOption == -1) 
		{
			alert("You must select a Loan Any button");
			return false;
		}
		
return true;
}
function valButtonLoan() {
    var cnt = -1;
	var i;
    for(i=0; i<document.personalloan_form.Loan_Any.length; i++) 
	{
        if(document.personalloan_form.Loan_Any[i].checked)
		{
			cnt=i;
			
		}
    }
    if(cnt > -1)
	{ 
		return true;
	}
    else
	{
		return false;
	}
}

</script>

</head>

<body><div id="logo_sml">
	<img src="/new-images/d4l-sml-logo.gif" alt="Deal4loans"  onclick="javascript:location.href='http://www.deal4loans.com/'"/>
</div>
<table width="1004"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
	<tr>               
       <td align="center" valign="middle" style="color: #643E02; font-weight:bold; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; ">60% of your application for quote from all Banks is complete.</td>            
      </tr>
	  <tr>
	   <td align="center" >&nbsp;</td>            
      </tr>
	  
      <tr>               
       <td align="center" valign="middle" ><img src="new-images/hl/ajax-loader.gif" width="220" height="19" /></td>            
      </tr>
	   <tr>
	   <td align="center" >&nbsp;</td>            
      </tr>
	  <tr>               
       <td align="center" valign="middle" style="color: #136071; font-weight:bold; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; ">Share few more details to get exact quote on Emi,Rates & Loan Amount.
</td>            
      </tr>
    </table></td>
  </tr>
  <tr>
    <td valign="top" style="padding-top:8px; "><table width="97%"  border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td valign="top">
   
<table width="650" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="21" height="21" align="left" valign="top"><img src="new-images/pl/lft-tp-curv.gif" width="21" height="21" /></td>
    <td style="border-top:1px solid #d4d4d4 ">&nbsp;</td>
    <td width="21" height="21" align="right" valign="top"><img src="new-images/pl/rgt-tp-curv.gif" width="21" height="21" /></td>
  </tr>
  <tr>
    <td  style="border-left:1px solid #d4d4d4 ">&nbsp;</td>
    <td>
 
    <form name="personalloan_form"  action="personal-loans-apply-nthanks.php" method="POST" onsubmit="return submitform(document.personalloan_form); ">
 	<input type="hidden" value="<? echo $_SESSION['Temp_LID'];?>" name="leadid" />
		  <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
            
            <tr align="center" bgcolor="#f4f4f4">
              <td height="35" colspan="2" class="bldtxt" style="font-size:13px; font-family:Verdana, Arial, Helvetica, sans-serif; "> Personal Loan Quote Request</td>
              </tr>
            <tr>
              <td height="10" colspan="2" ></td>
              </tr>
            <tr>
              <td width="234" height="35" align="left" class="bldtxt">Primary Account 
                in which bank?</td>
              <td width="313" height="20"  align="left"><input type="text" style="width:200px;" name="Primary_Acc" id="Primary_Acc" onkeyup="ajax_showOptions(this,'getCountriesByLetters',event); getstatementlink();" onchange="getstatementlink();" onkeydown="getstatementlink();" onclick="getstatementlink();"></td>
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
            </tr>
			<tr>
                <td height="35" class="bldtxt">Company Type</td>
          <td class="frmtxt"><select name="Company_Type" id="Company_Type" style="width: 203px;">
		  <option value="0">Please Select</option>
		  	<option value="1">Pvt Ltd</option>
			<option value="2">MNC Pvt Ltd</option>
			<option value="3">Limited</option>
			<option value="4">Govt.( Central/State )</option>
		<option value="5">PSU (Public sector Undertaking)</option>
			</select></td>
        </tr>  
            <tr>
              <td height="35" align="left" class="bldtxt" >No. of years in  
                this Company</td>
              <td align="left" ><input type="text" name="Years_In_Company" style="width:200px;" maxlength="15"></td>
            </tr>
            <tr>
              <td height="42" align="left" class="bldtxt" >Total Experience (Years)/
                Total Years  
                in Business</td>
              <td align="left" ><input style="width:200px;"  name="Total_Experience" onfocus="this.select();">              </td>
            </tr>
                        <? if ($_SESSION['Temp_CC_Holder']==1 || $_SERVER['Temp_CC_Holder']==1)
			{?>
            <tr>
              <td height="30" align="left" class="bldtxt" >Credit Card Limit?</td>
              <td align="left" ><input style="width:200px;" name="Credit_Limit" onchange="intOnly(this);" onkeyup="intOnly(this);" onkeypress="intOnly(this);" onfocus="this.select();">              </td>
            </tr>
            <? } ?>
            <tr>
              <td height="30" align="left" class="bldtxt" >Any Loan running?</td>
              <td align="left" ><input type="radio" style="border:none;"  value="1"  name="LoanAny"  onclick="addElementLoan(); addDiv();" /> Yes &nbsp;  <input size="10" type="radio" style="border:none;" name="LoanAny"  onclick="removeElementLoan();" value="0"> No</td>
            </tr>
            <tr>
              <td colspan="2" id="myDivLoan"></td>
            </tr>
           
            <tr>
              <td  colspan="2" align="left"  >&nbsp;</td>
            </tr>
            <tr>
              <td height="35" colspan="2" align="center"><input type="image" name="Submit"  src="new-images/pl/quote.gif"  style="width:115px; height:29px; border:none; " /></td>
            </tr>
          </table>
		  </form></td>
    <td  style="border-right:1px solid #d4d4d4 ">&nbsp;</td>
  </tr>
  <tr>
    <td width="21" height="21"><img src="new-images/pl/lft-btm-crv.gif" width="21" height="21" /></td>
    <td  style="border-bottom:1px solid #d4d4d4 ">&nbsp;</td>
    <td width="21" height="21"><img src="new-images/pl/rgt-btm-curv.gif" width="21" height="21" /></td>
  </tr>
</table>

</td>
             
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>
