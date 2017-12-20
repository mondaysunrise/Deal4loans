<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	
	$maxage=date('Y')-62;
	$minage=date('Y')-18;	
	
	$sql = "select Net_Salary,City, City_Other,Employment_Status from Req_Loan_Car where RequestID = '".$_SESSION['Temp_LID']."'";
	list($GetnumVal,$row)=Mainselectfunc($sql,$array = array());
	
	//$query = ExecQuery($sql); 
	$Net_Salary = $row['Net_Salary'];
	$City = $row['City'];
	$City_Other = $row['City_Other'];
	$Employment_Status = $row['Employment_Status'];
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Car Loan</title>
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

function addElement()
{
		var ni = document.getElementById('myDiv');
		
		if(ni.innerHTML=="")
		{
		
			if(document.clloan_form.Car_Type.value="on")
			{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '<table  width="100%" border="0" cellspacing="0" cellpadding="0"><tr align="left"><td   class="bldtxt"><b>Delivery Date</b></td><td style="padding-left:20px;"><input type="text" name="cldelivery_date" id="cldelivery_date" value="DD-MM-YYYY" onblur="onBlurDefault(this,\'DD-MM-YYYY\');" onfocus="onFocusBlank(this,\'DD-MM-YYYY\');" tabindex="9" /></td></tr></table>';
				

			}
		}
		
		return true;

	}


function removeElement()
{
		var ni = document.getElementById('myDiv');
		
		if(ni.innerHTML!="")
		{
		
			if(document.clloan_form.Car_Type.value="on")
			{
				ni.innerHTML = '';
				
			}
		}
		
		return true;

	}


function chkform()
{
	var cnt=-1;
	var j;

if(document.clloan_form.day.value=="" || document.clloan_form.day.value=="DD")
	{
		alert("Please fill your day of birth.");
		document.clloan_form.day.focus();
		return false;
	}
	if(document.clloan_form.day.value!="")
	{
	 if((document.clloan_form.day.value<1) || (document.clloan_form.day.value>31))
	{
	alert("Kindly Enter your valid Date of Birth(Range 1-31)");
	document.clloan_form.day.focus();
	return false;
	}
	}
	if(!checkData(document.clloan_form.day, 'Day', 2))
		return false;
	
	if(document.clloan_form.month.value=="" || document.clloan_form.month.value=="MM")
	{
		alert("Please fill your month of birth.");
		document.clloan_form.month.focus();
		return false;
	}
	if(document.clloan_form.month.value!="")
	{
	if((document.clloan_form.month.value<1) || (document.clloan_form.month.value>12))
	{
	alert("Kindly Enter your valid Month of Birth(Range 1-12)");
	document.clloan_form.month.focus();
	return false;
	}
	}
	if(!checkData(document.clloan_form.month, 'month', 2))
		return false;

	if(document.clloan_form.year.value=="" || document.clloan_form.year.value=="YYYY")
	{
		alert("Please fill your year of birth.");
		document.clloan_form.year.focus();
		return false;
	}
		if(document.clloan_form.year.value!="")
	{
	  if((document.clloan_form.year.value < "<?php echo $maxage;?>") || (document.clloan_form.year.value >"<?php echo $minage;?>"))
	{
		alert("Age Criteria! \n Applicants between age group 18 - 62 only are elgibile.");
		document.clloan_form.year.focus();
		return false;
		}
	}
	if(!checkData(document.clloan_form.year, 'Year', 4))
		return false;
	
if(!checkData(document.clloan_form.Company_Name, 'Company Name', 3))
		return false;
		
if (document.clloan_form.Loan_Amount.value=="")
	{
		alert("Please enter Loan Amount.");
		document.clloan_form.Loan_Amount.focus();
		return false;
	}	
	if(!checkNum(document.clloan_form.Loan_Amount, 'Loan Amount',0))
		return false;
	
	
if (document.clloan_form.Car_Type.selectedIndex==0)
	{
		alert("Please enter Car Type to Continue");
		document.clloan_form.Car_Type.focus();
		return false;
	}
	
	for(j=0; j<document.clloan_form.Car_Booked.length; j++) 
	{
		 if(document.clloan_form.Car_Booked[j].checked)
		{
			 if(j==0)
				{
				
				}

			 cnt= j;
		}
	}
	
		if(cnt == -1) 
		{
			alert("please select you have Booked any Car or not");
			return false;
		}
<?php
if($City=="Others")
{
?>
if(document.clloan_form.City_Other.value=='')
{
	alert("Kindly fill in your other City!");
	document.clloan_form.City_Other.focus();
	return false;
}
<?php
}
?>

		
}
</script>

</head>

<body><div id="logo_sml">
	<img src="new-images/d4l-sml-logo.gif" alt="Deal4loans"  onclick="javascript:location.href='http://www.deal4loans.com/'"/>
</div>
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
    <form name="clloan_form" method="post" action="apply-for-clloans-continue.php" onSubmit="return chkform();">
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
			<td class="bldtxt" height="25"><b>DOB : </b></td>
			<td> <input name="day" type="text" id="day"  value="DD" style="  width:34px; " onblur="onBlurDefault(this,'dd');" onfocus="onFocusBlank(this,'dd');" maxlength="2" onkeyup="intOnly(this);" onkeypress="intOnly(this);" tabindex="1"/>
                         <input  name="month" type="text" id="month" style="width:34px; " value="MM" onblur="onBlurDefault(this,'mm');" onfocus="onFocusBlank(this,'mm');" maxlength="2" onkeyup="intOnly(this);" onkeypress="intOnly(this);" tabindex="2"/>
                         <input name="year" type="text" id="year" style="width:60px; " value="YYYY" onblur="onBlurDefault(this,'yyyy');" onfocus="onFocusBlank(this,'yyyy');" maxlength="4" onkeyup="intOnly(this);" onkeypress="intOnly(this);" onchange="insertData();" tabindex="3"/></td>
			
			<td class="bldtxt" height="25">Company Name : </td>
			<td><input type="text" name="Company_Name" style="width:140px;" tabindex="4" /></td>
			<td class="bldtxt" height="25">Loan Amount : </td>
			<td><input name="Loan_Amount" id="Loan_Amount" tabindex="5" type="text" style="width:140px;" maxlength="10" onfocus="this.select();" onchange="ShowHide('loanShow','Loan_Amount');"  onkeyup="intOnly(this);getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');"  onkeydown="getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" onkeypress="intOnly(this); getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" onblur="getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" /></td>
					</tr>
		<tr>
			<td class="bldtxt" height="25">Car Type : </td>
			<td><select style="width:145px;" name="Car_Type" tabindex="6">
                          <option selected value="-1">Interested In</option>
				<option  value="1">New Car</option>
				<option value="0">UsedCar</option>
                       </select></td>
					   <td class="bldtxt">Car Booked</td>
					     <td><input type="radio" value="1" name="Car_Booked" id="Car_Booked" style="border:none;"  tabindex="7"> Yes &nbsp;<input type="radio" value="2" name="Car_Booked" id="Car_Booked" style="border:none;"  tabindex="8"> No</td>
			 <td colspan="2" rowspan="2" valign="top" class="frmbldtxt" width="200"><span id='formatedlA' style='font-size:11px;
font-weight:normal; color:#333333;font-Family:Verdana;'></span><span id='wordloanAmount' style='font-size:11px;
font-weight:normal; color:#333333;font-Family:Verdana;text-transform: capitalize;'></span></td>
		</tr>
		<tr>
		<td class="bldtxt" height="30">Car Model</td>
		<td><input style="width:140px;"  name="Car_Model"  id="Car_Model" onFocus="this.select();" tabindex="10"></td>
  <?php
		 if($_SESSION['City']=="Others")
		 {
		 ?>
	<td class="bldtxt" height="30">Other City</td>
		<td><input name="City_Other" id="City_Other" type="text" style="width:140px; "></td>
		<?php
		}
		else
		{
		?>
	<td class="bldtxt" height="30">&nbsp;</td>
		<td>&nbsp;</td>
        
		<?php
		}
		?>
		</tr>
		
		
	<tr><td colspan="5">&nbsp;</td> 
	<td><input type="submit" style="border: 0px none ; background-image: url(new-images/quote-btn.jpg); width: 128px; height: 31px; margin-bottom: 0px;" value=""/></td></tr>
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

</body>
</html>
