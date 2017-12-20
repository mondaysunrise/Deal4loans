<?php
	require 'scripts/db_init.php';
	require 'scripts/db_init_bima.php';
	require 'scripts/functions.php';
	require 'eligiblebidderfunc.php';
	require 'scripts/home_loan_eligibility_function.php';
	
	$maxage=date('Y')-62;
	$minage=date('Y')-18;
	
	
	function DetermineAgeFromDOB ($YYYYMMDD_In)
	{
	  $yIn=substr($YYYYMMDD_In, 0, 4);
	  $mIn=substr($YYYYMMDD_In, 4, 2);
	  $dIn=substr($YYYYMMDD_In, 6, 2);
	
	  $ddiff = date("d") - $dIn;
	  $mdiff = date("m") - $mIn;
	  $ydiff = date("Y") - $yIn;
	
	  // Check If Birthday Month Has Been Reached
	  if ($mdiff < 0)
	  {
		// Birthday Month Not Reached
		// Subtract 1 Year From Age
		$ydiff--;
	  } elseif ($mdiff==0)
	  {
		// Birthday Month Currently
		// Check If BirthdayDay Passed
		if ($ddiff < 0)
		{
		  //Birthday Not Reached
		  // Subtract 1 Year From Age
		  $ydiff--;
		}
	  }
	  return $ydiff;
	}

	session_start();
	$post=$_REQUEST['id'];
	$min_date =$_REQUEST['to'];
	$max_date=$_REQUEST['from'];
	$bidid =$_REQUEST['Bid'];

		
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/menu.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<link href="includes/style.css" rel="stylesheet" type="text/css">
<script language="javascript" type="text/javascript" src="scripts/datetime.js"></script>
<script language="javascript" type="text/javascript" src="scripts/common.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>

<script>

function cityother()
{
	if(document.loan_form.hlcity.value=="Others")
	{
		document.loan_form.hlother_city.disabled = false;
	}
	else
	{
		document.loan_form.hlother_city.disabled = true;
	}
} 

function Trim(strValue) 
{
	var j=strValue.length-1;i=0;
	while(strValue.charAt(i++)==' ');
	while(strValue.charAt(j--)==' ');
	return strValue.substr(--i,++j-i+1);
}

function containsdigit(param)
{
	mystrLen = param.length;
	for(i=0;i<mystrLen;i++)
	{
		if((param.charAt(i)=="0") || (param.charAt(i)=="1") || (param.charAt(i)=="2") || (param.charAt(i)=="3") || (param.charAt(i)=="4") || (param.charAt(i)=="5") || (param.charAt(i)=="6") || (param.charAt(i)=="7") || (param.charAt(i)=="8") || (param.charAt(i)=="9") || (param.charAt(i)=="/"))
		{
			return true;
		}
	}
	return false;
}

function chkhomeloan(Form)
{
	var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
	var dt,mdate;dt=new Date();
	var j;
	var cnt=-1;
	var alpha=/^[a-zA-Z\ ]*$/;
	var alphanum=/^[a-zA-Z0-9]*$/;
	var num=/^[0-9]*$/;
	var space=/^[\ ]*$/;
	var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";

	if(document.loan_form.hlname.value=="")
	{
		alert("Please Enter Your name");
		document.loan_form.hlname.focus();
		return false;
	}
	if(document.loan_form.hlname.value!="")
	{
		if(containsdigit(document.loan_form.hlname.value)==true)
		{
			alert("First Name contains numbers!");
			document.loan_form.hlname.focus();
			return false;
		}
	}
   for (var i = 0; i <document.loan_form.hlname.value.length; i++) 
   {
		if (iChars.indexOf(document.loan_form.hlname.value.charAt(i)) != -1) 
		{
			alert("Contains special characters!");
			document.loan_form.hlname.focus();
			return false;
		}
  }
    if(document.loan_form.hlemail.value=="")
	{
		alert("Enter  Email Address!");
		document.loan_form.hlemail.focus();
		return false;
	}
	
	var str=document.loan_form.hlemail.value
	var aa=str.indexOf("@")
	var bb=str.indexOf(".")
	var cc=str.charAt(aa)

	if(aa==-1)
	{
		alert("Enter Valid Email Address!");
		document.loan_form.hlemail.focus();
		return false;
	}
	else if(bb==-1)
	{
		alert("Enter Valid Email Address!");
		document.loan_form.hlemail.focus();
		return false;
	}
  
  if(document.loan_form.hlmobile.value=="")
	{
		alert("Fill Mobile Number!");
		document.loan_form.hlmobile.focus();
		return false;
	}
	if(isNaN(document.loan_form.hlmobile.value)|| document.loan_form.hlmobile.value.indexOf(" ")!=-1)
	{
		alert("Enter numeric value!");
		document.loan_form.hlmobile.focus();
		return false;  
	}
	if (document.loan_form.hlmobile.value.length < 10 )
	{
		alert("Enter 10 Digits!");
		document.loan_form.hlmobile.focus();
		return false;
	}
	if ((document.loan_form.hlmobile.value.charAt(0)!="9") && (document.loan_form.hlmobile.value.charAt(0)!="8") && (document.loan_form.hlmobile.value.charAt(0)!="7"))
	{
		alert("should start with 9 or 8 or 7!");
		document.loan_form.hlmobile.focus();
		return false;
	}
	

		if((space.test(document.loan_form.day.value)) || (document.loan_form.day.value=="dd"))
		{
			alert("Kindly enter your Date of Birth");
			document.loan_form.day.select();
			return false;
		}
		
		else if(!num.test(document.loan_form.day.value))
		{
			alert("Kindly enter your Date of Birth(numbers Only)");
			document.loan_form.day.select();
			return false;
		}
		
		else if((document.loan_form.day.value<1) || (document.loan_form.day.value>31))
		{
			alert("Kindly Enter your valid Date of Birth(Range 1-31)");
			document.loan_form.day.select();
			return false;
		}
		
		else if((space.test(document.loan_form.month.value)) || (document.loan_form.month.value=="mm"))
		{
			alert("Kindly enter your Month of Birth");
			document.loan_form.month.select();
			return false;
		}
		
		else if(!num.test(document.loan_form.month.value))
		{
			alert("Kindly enter your Month of Birth(numbers Only)");
			document.loan_form.month.select();
			return false;
		}
		
		else if((document.loan_form.month.value<1) || (document.loan_form.month.value>12))
		{
			alert("Kindly Enter your valid Month of Birth(Range 1-12)");
			document.loan_form.month.select();
			return false;
		}
		
		else if((document.loan_form.month.value==2) && (document.loan_form.day.value>29))
		{
			alert("Month February cannot have more than 29 days");
			document.loan_form.day.select();
			return false;
		}
		
		else if((space.test(document.loan_form.year.value)) || (document.loan_form.year.value=="yyyy"))
		{
			alert("Kindly enter your Year of Birth");
			document.loan_form.year.select();
			return false;
		}
		
		else if(!num.test(document.loan_form.year.value))
		{
			alert("Kindly enter your Year of Birth(numbers Only) !");
			document.loan_form.year.select();
			return false;
		}
		
		else if((document.loan_form.day.value > 28) && (parseInt(document.loan_form.month.value)==2) && ((document.loan_form.year.value%4) != 0))
		{
			alert("February cannot have more than 28 days.");
			document.loan_form.day.select();
			return false;
		}
		else if((parseInt(document.loan_form.day.value)==31) && ((parseInt(document.loan_form.month.value)==4)||(parseInt(document.loan_form.month.value)==6)||(parseInt(document.loan_form.month.value)==9)||(parseInt(document.loan_form.month.value)==11)||(parseInt(document.loan_form.month.value)==2)))
		{
			alert("this month Cannot have 31st Day");document.loan_form.day.select();
			return false;
		}
		else if(document.loan_form.year.value.length != 4)
		{
			alert("Kindly enter your correct 4 digit Year of Birth.(Numeric ONLY)!");
			document.loan_form.year.select();
			return false;
		}

	if (document.loan_form.hlcity.selectedIndex==0)
	{
		alert("Enter City to Continue!");
		document.loan_form.hlcity.focus();
		return false;
	}
	if((document.loan_form.hlcity.value=="Others") && ((document.loan_form.hlother_city.value=="" || document.loan_form.hlother_city.value=="Other City"  ) || !isNaN(document.loan_form.hlother_city.value)))
	{
		alert("Enter Other City to Continue!");
		document.loan_form.hlother_city.focus();
		return false;
	}
	for (var i = 0; i <document.loan_form.hlother_city.value.length; i++) 
	{
		if (iChars.indexOf(document.loan_form.hlother_city.value.charAt(i)) != -1) 
		{
			alert("Remove Special Characters!");			
			document.loan_form.hlother_city.focus();
			return false;
		}
	}
	if (document.loan_form.hlpincode.value=="")
	{
		alert("Enter Pincode!");
		document.loan_form.hlpincode.focus();
		return false;
	}
	if (document.loan_form.hlpincode.value!="")
	{
		if(document.loan_form.hlpincode.value.length < 6)
		{
			alert("Enter Pincode(6 Digits)!");
			document.loan_form.hlpincode.focus();
			return false;
		}
	}
	if (document.loan_form.hlemployment_status.selectedIndex==0)
	{
		alert("Select Employment Status to Continue!");
		document.loan_form.hlemployment_status.focus();
		return false;
	}

	if (document.loan_form.hlnet_salary.value=="")
	{
		alert("Enter Annual Income!");
		document.loan_form.hlnet_salary.focus();
		return false;
	}	
	if (document.loan_form.hlcompany_name.value=="")
	{
		alert("Enter Company Name!");
		document.loan_form.hlcompany_name.focus();
		return false;
	}
	if (document.loan_form.hlloanamt.value=="")
	{
		alert("Enter Loan Amount!");
		document.loan_form.hlloanamt.focus();
		return false;
	}

	return true;
}
</script>
<STYLE>
a
{
	cursor:pointer;

}
.bluebutton {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
	color: blue;
	font-weight: bold;
}
</style>

</head>

<body >
<p align="center"><strong>Home loan Lead Entry Form</strong></p>
<form name="loan_form" method="post" action="hl_entry_form_continue.php" onSubmit="return chkhomeloan('loan_form');" >
<input type="hidden" name="source" id="source" value="missed_call"/>
<table style='border:1px dotted #9C9A9C;'width="750" height="80%" align="center"  cellpadding="3" cellspacing="3" >
<tr>
<td style="border:1px solid black;" colspan="4" bgcolor="#DAEAF9" align="center" class="fontstyle" ><b>Personal Details</b></td></tr><tr>	<td ><b>Name</b>
	</td>
	<td ><input type="text" name="hlname" id="hlname" value="<? echo $Name;?>"> </td>
	
<td ><b>Email id</b></td>
	<td ><input type="text" name="hlemail" id="hlemail" value="<? echo $Email;?>"></td>
	</tr>
<tr>
	<td width="25%"><b>Mobile</b></td>
	<td width="25%">+91<input type="text" name="hlmobile" id="hlmobile" size="15" value="<? echo $Mobile;?>" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);"></td>
	<td ><b>DOB </b></td>
	<td ><input type="text" name="day" id="day" value="<? echo $dd;?>" size="2" maxlength="2" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);">-<input type="text" name="month" id="month" value="<? echo $mm;?>" size="2" maxlength="2" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);">-<input type="text" name="year" id="year" value="<? echo $year;?>" size="4" maxlength="4" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);"><br>(dd-mm-yyyy)</td>
</tr>
<tr>
	<td><b>Residence No.</b></td>
	<td><input type="text" name="hlstd_code" size="2" value="<? echo $Std_Code;?>" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" >-<input type="text" name="hllandline" size="10" value="<? echo $Landline;?>" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);"></td>
	
	<td ><b>Office No.</b></td>
	<td ><input type="text" name="hlstd_code_o"  size="2" value="<? echo $Std_Code_O; ?>" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" >-<input type="text" name="hllandline_o" size="10" value="<? echo $Landline_O;?>" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);"></td>
  </tr>
<tr>
	<td ><b>City</b></td>
	<td><select size="1" name="hlcity" id="hlcity" onchange="cityother();" > <?=getCityList($City)?></select></td>
	<td ><b>Other City</b></td>
	<td><input type="text" name="hlother_city" id="hlother_city" disabled value="<? echo $City_Other;?>"> </td>
</tr>
<tr>
	<td ><b>Residence Address</b></td>
	<td  ><textarea  name="hlresiaddress" rows="2" cols="18"><? echo $Residence_Address;?></textarea></td>
<td ><b>Pincode</b></td>
	<td ><input type="text" name="hlpincode" size="10" value="<? echo $Pincode;?>" id="hlpincode"  onkeyup="intOnly(this);" onKeyPress="intOnly(this);" maxlength="6"></td>	
</tr>

<tr>
	<td style="border:1px solid black;" colspan="4" bgcolor="#DAEAF9" align="center" class="fontstyle" ><b>Employment Details</b></td></tr>
<tr>
	<td><b>Employment Status</b></td>
	<td><select name="hlemployment_status" id="hlemployment_status">
		<option value="-1" >Please Select</option>
    	<option value="1" >Salaried</option>
		<option value="0" >Self Employed</option></select>	</td>

	<td ><b>Annual Income</b></td>
	<td><input type="text" name="hlnet_salary" id="hlnet_salary" value="<? echo $Net_Salary;?>"  onKeyUp="intOnly(this); getDigitToWords('hlnet_salary','formatedIncome','wordIncome');" onKeyPress="intOnly(this);  getDigitToWords('hlnet_salary','formatedIncome','wordIncome');" style="float: left" onBlur="getDigitToWords('hlnet_salary','formatedIncome','wordIncome');"></td>
</tr>
<tr><td><b>Company Name</b></td><td><input type="text" name="hlcompany_name" id="hlcompany_name" value="<? echo $Company_Name?>"></td><td colspan="2"></td></tr>
<tr>
	<td style="border:1px solid black;" colspan="4" bgcolor="#DAEAF9" align="center" class="fontstyle" ><b>Other Details</b></td></tr>
<tr>
	<td><b>Loan Amount</b></td>
	<td><input type="text" name="hlloanamt" id="hlloanamt" value="<? echo $Loan_Amount;?>" onKeyUp="intOnly(this); getDigitToWords('hlloanamt','formatedloan','wordloan');" onKeyPress="intOnly(this); getDigitToWords('hlloanamt','formatedloan','wordloan');" style="float: left" onBlur="getDigitToWords('hlloanamt','formatedloan','wordloan');"></td>
<td ><b>Loan Time</b></td>
	<td ><select name="hlloantime" >
	<option value="-1" <? if (($Loan_Time==-1) || ($Loan_Time=="")) { echo "selected";}?>>Please select</option>
    	<OPTION value="15 days" <? if($Loan_Time =="15 days"){echo "selected"; }?>>15 days</OPTION>
	<OPTION value="1 month" <? if($Loan_Time =="1 month"){echo "selected"; }?>>1 months</OPTION>
	<OPTION value="2 months" <? if($Loan_Time =="2 months"){echo "selected"; }?>>2 months</OPTION>
	<OPTION value="3 months" <? if($Loan_Time =="3 months"){echo "selected"; }?>>3 months</OPTION>
	<OPTION value="3 months above" <? if($Loan_Time =="3 months above"){echo "selected"; }?>>more than 3 months</OPTION>
	</SELECT>	</td>
</tr>
<tr>
	<td><b>Property Identified</b></td>

	<td ><input type="radio" name="hlproperty_identified" <? if($Property_Identified==1){ echo "checked";}?> value="1">Yes<input type="radio" name="hlproperty_identified" <? if($Property_Identified==0){echo "checked";}?> value="0">No</td>
	<td><b>Property Location</b></td>
	<td ><input type="text" name="hlproperty_loc" value="<? echo  $Property_Loc;?>"></td>
</tr>

<tr>
	<td><b>Property Value</b></td>
<td><input type="text" name="hlProperty_Value" id="hlProperty_Value"  onkeyup="intOnly(this);" onKeyPress="intOnly(this);"  value="<? echo $Property_Value; ?>"></td>
	<td><b>Total Obligation</b></td>
<td><input type="text" name="hlTotal_Obligation" id="hlTotal_Obligation"  onkeyup="intOnly(this);" onKeyPress="intOnly(this);" value="<? echo $Total_Obligation; ?>"></td>
</tr>
<tr>
	<td style="border:1px solid black;" colspan="4" bgcolor="#DAEAF9" align="center" class="fontstyle" ><b>Co applicant Details</b></td></tr>
	<tr>
	<td><b>Co Applicant Name:</b></td>
<td><input type="text" name="hlCo_Applicant_Name" id="hlCo_Applicant_Name" value="<? echo $Co_Applicant_Name; ?>"></td>
	<td ><b>Co-Applicant DOB</b></td><td><input type="text" name="hlCo_Applicant_DOB" id="hlCo_Applicant_DOB" value="<? echo $Co_Applicant_DOB; ?>" ></td>
</tr>
<tr>
	<td><b>Co Monthly Income:</b></td>
<td><input type="text" name="hlCo_Applicant_Income" id="hlCo_Applicant_Income" value="<? echo $Co_Applicant_Income; ?>"></td>
	<td ><b>Co Applicant Obligation</b></td><td><input type="text" name="hlCo_Applicant_Obligation" id="hlCo_Applicant_Obligation" value="<? echo $Co_Applicant_Obligation; ?>" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);"> </td>
</tr>

 <tr>

     <td colspan="4" align="center"><br><input type="submit" class="bluebutton" value="Submit">    </td>
  </tr>
</table>
</form>
</body>
</html>