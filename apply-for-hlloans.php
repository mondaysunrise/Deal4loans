<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	
$maxage=date('Y')-62;
$minage=date('Y')-18;	
	
	$sql = "select Net_Salary,City, City_Other,Employment_Status from Req_Loan_Home where RequestID = '".$_SESSION['Temp_LID']."'";
	list($GetnumVal,$row)=Mainselectfunc($sql,$array = array());
	
	$Net_Salary = $row['Net_Salary'];
	$City = $row['City'];
	$City_Other = $row['City_Other'];
	$Employment_Status = $row['Employment_Status'];
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Home Loan</title>
<link href="source.css" rel="stylesheet" type="text/css" />
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script type="text/javascript" src="scripts/mootools.js"></script>
<script type="text/javascript" src="scripts/common.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
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

form{
		display:inline;
		margin:0px;
		padding:0px;
}
	
</style>
<script>
function addIdentified()
{
		var ni = document.getElementById('myDiv1');
		ni.innerHTML = '<table width="100%" align="left" border="0"><tr><td align="left" valign="middle" class="frmbldtxt" height="20"><b style="color:#373737;">Property Location</b></td>	<td height="20">&nbsp;&nbsp;&nbsp;<select style="width:142px;" name="Property_Loc" id="Property_Loc" tabindex="10"><?=getCityList1($City)?></select></td></tr></table>';
			
		return true;
}	
	
function removeIdentified()
{
	var ni = document.getElementById('myDiv1');
	ni.innerHTML="";
	return true;
	
}	


function showdetailsFaq(d,e)
			{			
				for(j=1;j<=e;j++)
					{
						if(d==j)
							{
								if(eval(document.getElementById("divfaq"+j)).style.display=='none')
									{
										eval(document.getElementById("divfaq"+j)).style.display=''
									}
								else
									{
										eval(document.getElementById("divfaq"+j)).style.display='none'
									}
							}
					}
			}
			
function chkform()
{
	var cnt=-1;
	var j;

if(document.hlloan_form.day.value=="" || document.hlloan_form.day.value=="DD")
	{
		alert("Please fill your day of birth.");
		document.hlloan_form.day.focus();
		return false;
	}
	if(document.hlloan_form.day.value!="")
	{
	 if((document.hlloan_form.day.value<1) || (document.hlloan_form.day.value>31))
	{
	alert("Kindly Enter your valid Date of Birth(Range 1-31)");
	document.hlloan_form.day.focus();
	return false;
	}
	}
	if(!checkData(document.hlloan_form.day, 'Day', 2))
		return false;
	
	if(document.hlloan_form.month.value=="" || document.hlloan_form.month.value=="MM")
	{
		alert("Please fill your month of birth.");
		document.hlloan_form.month.focus();
		return false;
	}
	if(document.hlloan_form.month.value!="")
	{
	if((document.hlloan_form.month.value<1) || (document.hlloan_form.month.value>12))
	{
	alert("Kindly Enter your valid Month of Birth(Range 1-12)");
	document.hlloan_form.month.focus();
	return false;
	}
	}
	if(!checkData(document.hlloan_form.month, 'month', 2))
		return false;

	if(document.hlloan_form.year.value=="" || document.hlloan_form.year.value=="YYYY")
	{
		alert("Please fill your year of birth.");
		document.hlloan_form.year.focus();
		return false;
	}
	if(document.hlloan_form.year.value!="")
	{
		if((document.hlloan_form.year.value < "<?php echo $maxage;?>") || (document.hlloan_form.year.value >"<?php echo $minage;?>"))
		{
			alert("Age Criteria! \n Applicants between age group 18 - 62 only are elgibile.");
			document.hlloan_form.year.focus();
			return false;
		}
	}
	if(!checkData(document.hlloan_form.year, 'Year', 4))
		return false;
	
	if (document.hlloan_form.Pincode.value=="")
	{
		alert("Please enter Pincode.");
		document.hlloan_form.Pincode.focus();
		return false;
	}
	if (document.hlloan_form.Pincode.value!="")
	{
		if(document.hlloan_form.Pincode.value.length < 6)
		{
			alert("Kindly fill in your Pincode(6 Digits)!");
			document.hlloan_form.Pincode.focus();
			return false;
		}
	}


	if (document.hlloan_form.Loan_Amount.value=="")
	{
		alert("Please enter Loan Amount.");
		document.hlloan_form.Loan_Amount.focus();
		return false;
	}	
	if(!checkNum(document.hlloan_form.Loan_Amount, 'Loan Amount',0))
		return false;
	
			
	for(var i=0; i<document.hlloan_form.Property_Identified.length; i++) 
	{
        if(document.hlloan_form.Property_Identified[i].checked)
		{
			cnt= i;
		}
	}
		if(cnt <0 ) 
		{
			alert("please select you have identified any property or not");
			return false;
		}
		if(cnt ==0)
		{ 
			if(document.hlloan_form.Property_Loc.selectedIndex==0)
			{
				alert("Plese select city where property is located");
				document.hlloan_form.Property_Loc.focus();
				return false;
			}
		}
	<?php
	if($City=="Others")
	{
		?>
		if(Form.City_Other.value=='')
		{
			alert("Kindly fill in your other City!");
			Form.City_Other.focus();
			return false;
		}
		<?php
	}
	?>			
}
</script>
</head>
<body><table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td style="padding-left:40px;" >
<div id="logo_sml">
	<img src="new-images/d4l-sml-logo.gif" alt="Deal4loans"  onclick="javascript:location.href='http://www.deal4loans.com/'"/>
</div>
</td></tr>
<tr><td>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
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
    <form name="hlloan_form" method="post" action="apply-for-hlloans-continue.php" onSubmit="return chkform();">
	<input type="hidden" name="ProductValue" id="ProductValue" value="<? echo $_SESSION['Temp_LID']; ?>">
	<input type="hidden" name="Net_Salary" id="Net_Salary" value="<? echo $_SESSION['Net_Salary']; ?>">
	<input type="hidden" name="City" id="City" value="<? echo $_SESSION['City']; ?>">
    <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="21" height="21" align="left" valign="top"><img src="new-images/pl/lft-tp-curv.gif" width="21" height="21" /></td>
        <td style="border-top:1px solid #d4d4d4 ">&nbsp;</td>
        <td width="21" height="21" align="right" valign="top"><img src="new-images/pl/rgt-tp-curv.gif" width="21" height="21" /></td>
      </tr>
  <tr>
    <td  style="border-left:1px solid #d4d4d4 ">&nbsp;</td>
    <td>
	<table width="100%" cellpadding="2" cellspacing="4">
		<tr>
			<td width="133" height="25" class="bldtxt"><b>DOB</b></td>
			<td width="142"> <input name="day" type="text" id="day"  value="DD" style="  width:34px; " onblur="onBlurDefault(this,'dd');" onfocus="onFocusBlank(this,'dd');" maxlength="2" onkeyup="intOnly(this);" onkeypress="intOnly(this);" tabindex="1"/>
                         <input  name="month" type="text" id="month" style="width:34px; " value="MM" onblur="onBlurDefault(this,'mm');" onfocus="onFocusBlank(this,'mm');" maxlength="2" onkeyup="intOnly(this);" onkeypress="intOnly(this);" tabindex="2"/>
                         <input name="year" type="text" id="year" style="width:60px; " value="YYYY" onblur="onBlurDefault(this,'yyyy');" onfocus="onFocusBlank(this,'yyyy');" maxlength="4" onkeyup="intOnly(this);" onkeypress="intOnly(this);" onchange="insertData();" tabindex="3"/></td>
				<td width="120" height="25" class="bldtxt">Pincode</td>
			<td width="142"><input type="text" name="Pincode" onfocus="this.select();" style="width:140px;" maxlength="6" onkeypress="intOnly(this);" onkeyup="intOnly(this);"   tabindex="4" /></td>
			<td width="82" height="25" class="bldtxt">Loan Amount </td>
			<td width="146"><input name="Loan_Amount" id="Loan_Amount" tabindex="5" type="text" style="width:140px;" maxlength="10" onfocus="this.select();" onchange="ShowHide('loanShow','Loan_Amount');"  onkeyup="intOnly(this);getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');"  onkeydown="getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" onkeypress="intOnly(this); getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" onblur="getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" /></td>
		
					</tr>
		<tr>
			<td class="bldtxt" height="25">Property Value</td>
			<td><input type="text" name="property_value"  id="property_value" style="width:140px;" maxlength="30"   onkeyup="intOnly(this);" onkeypress="intOnly(this);" tabindex="6" /></td>
			<td class="bldtxt" height="25">Property Identified</td>
			<td><input type="radio" name="Property_Identified" id="Property_Identified" value="1" onclick="addIdentified();" style="border:none;" tabindex="7" />
      Yes&nbsp;&nbsp;
      <input type="radio"  name="Property_Identified" id="Property_Identified" onclick="removeIdentified();" value="0" style="border:none;" tabindex="8" />
      No</td>
       <td colspan="2" class="frmbldtxt"><span id='formatedlA' style='font-size:11px;
font-weight:normal; color:#333333;font-Family:Verdana;'></span><span id='wordloanAmount' style='font-size:11px;
font-weight:normal; color:#333333;font-Family:Verdana;text-transform: capitalize;'></span></td>
		</tr>
		<tr>
		<td  class="bldtxt" height="30">Total Monthly EMI for all running loans </td>
		<td><input type="text" name="obligations" id="obligations"  style="width:140px;"   onkeyup="intOnly(this);" onkeypress="intOnly(this);" tabindex="11"/></td>
        	<td width="0" colspan="2" ><div id="myDiv1"></div></td>
 <?php
			 if($_SESSION['City']=="Others")
			 {
			 ?>
				  <td height="30" class="bldtxt">Other City </td>
				  <td><input name="City_Other" id="City_Other" type="text" style="width:140px; "  /></td>
			 <?php
			 }
			  else
			  {
			  ?>
                    <td  class="bldtxt" height="30">&nbsp;</td>
                    <td>&nbsp;</td>
				<?php 
                }
                ?>
	

		</tr>
		<tr>
            	  <td class="frmbldtxt" colspan="6"><input type="checkbox" name="co_appli" id="co_appli" value="1" onClick="return showdetailsFaq(1,12);" style="border:none;" tabindex="12">&nbsp; Co- Applicant</td>
			 
           </tr>
        <tr>
            <td  colspan="6" align="left" class="frmbldtxt">
				<div style="display:none; " id="divfaq1">
                  <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
                    <tr>
                      <td width="12%" class="frmbldtxt" height="30"><b> Name :</b></td>
          <td width="23%" align="left"><span class="frmbldtxt">
            <input type="text" name="co_name" id="co_name" style="width:140px;" tabindex="13" maxlength="30" value="<?php echo $co_name; ?>" >
            </span></td>
          <td ><b>DOB : </b></td>
          <td width="21%" align="left"><input onfocus="insertData();" name="co_day" type="text" id="co_day" style="width:39px;" maxlength="2" onchange="intOnly(this);" onkeyup="intOnly(this);" onkeypress="intOnly(this)"; value="DD" tabindex="20" />
            <input name="co_month" type="text" id="co_month" style="width:39px;" maxlength="2" onchange="intOnly(this);" onkeyup="intOnly(this);" onkeypress="intOnly(this);" value="MM" tabindex="14" />
            <input name="co_year" type="text" id="co_year" style="width:50px;" maxlength="4" onchange="intOnly(this);" onkeyup="intOnly(this);" onkeypress="intOnly(this);" value="YYYY" tabindex="15" /></td>
          <td width="16%" height="30" class="frmbldtxt"><b> Monthly Income : </b></td>
          <td width="17%" align="left"><span class="frmbldtxt">
            <input type="text" name="co_monthly_income" id="co_monthly_income" style="width:148px;" value="<?php echo $income; ?>"  onkeyup="intOnly(this);" onkeypress="intOnly(this);" tabindex="16" />
          </span></td>
                    </tr>
                    <tr>
                      <td height="30" colspan="3" class="frmbldtxt"><b> Total Monthly EMI for all running loans : </b></td>
          <td align="left"><span class="frmbldtxt">
            <input type="text" name="co_obligations" id="co_obligations" tabindex="17" style="width:140px;" value="<?php echo $obligations; ?>"  onkeyup="intOnly(this);" onkeypress="intOnly(this);" />
          </span></td>
          <td align="left">&nbsp;</td>
          <td align="left">&nbsp;</td>
                    </tr>
		
		</table>
       </div>
			 </td>
           </tr>
		   			
	<tr><td colspan="5">I Agree to <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow">privacy policy</a> and <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow">Terms and Conditions</a></td> <td><input type="submit" style="border: 0px none ; background-image: url(new-images/quote-btn.jpg); width: 128px; height: 31px; margin-bottom: 0px;" value=""/></td></tr>
	</table>
  </td>
    <td  style="border-right:1px solid #d4d4d4 ">&nbsp;</td>
  </tr>
  <tr>
    <td width="21" height="21"><img src="new-images/pl/lft-btm-crv.gif" width="21" height="21" /></td>
    <td  style="border-bottom:1px solid #d4d4d4 ">&nbsp;</td>
    <td width="21" height="21"><img src="new-images/pl/rgt-btm-curv.gif" width="21" height="21" /></td>
  </tr>
</table>
</form>
</td>
      
              
             
      </tr>
    </table></td>
  </tr>
</table>
</td></tr></table>

</body>
</html>
