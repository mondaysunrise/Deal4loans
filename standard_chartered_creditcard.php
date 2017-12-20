<?php
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
//	print_r($_REQUEST);
	$ccuserid = $_REQUEST['RequestID'];
	$cc_bankid = $_REQUEST['cc_bankid'];
	$lastInserted = $_REQUEST['RequestID'];
			$Dated = ExactServerdate();

	if($ccuserid>0)
	{
		if($cc_bankid==13)
		{
			$Descr = "Standard Chartered
			Super Value Titanium Card"; 
		}
		if($cc_bankid==19)
		{
			$Descr = "Standard Chartered
			Manhattan Platinum Card";
		}

		$slct="select Descr from Req_Credit_Card Where (RequestID='".$ccuserid."')";
		list($num_2,$row)=Mainselectfunc($slct,$array = array());
		if(strlen($row['Descr'])>0)
		{
			$strcrd_nme=$row['Descr'].",".$Descr;
		}
		else
		{
			$strcrd_nme=$Descr;
		}
	
		$DataArray = array("Descr"=>$strcrd_nme, 'Dated'=>$Dated);
		$wherecondition ="(RequestID = '".$ccuserid."')";
		Mainupdatefunc ('Req_Credit_Card', $DataArray, $wherecondition);
	
		//echo $ccupdate."<br>";
	}
	
	//echo "select Reference_Code from Req_Credit_Card Where (RequestID='".$ccuserid."')";
	$chekValid = "select Reference_Code,Mobile_Number from Req_Credit_Card Where (RequestID='".$ccuserid."')";
		list($num_2,$rowchekValid)=Mainselectfunc($chekValid,$array = array());
	$chekValidValue = $rowchekValid[0]['Reference_Code'];
		$Mobile_Number = $rowchekValid[0]['Mobile_Number'];
	if($chekValidValue>0)
	{
		$Reference_Code = $chekValidValue;
	}
	else
	{
		$Reference_Code = generateNumber(4);
			$DataArray = array("Reference_Code"=>$Reference_Code);
		$wherecondition ="(RequestID = '".$ccuserid."')";
		Mainupdatefunc ('Req_Credit_Card', $DataArray, $wherecondition);
	}
	$SMSMessage = "Please use this code:".$Reference_Code."  to activate you loan request at deal4loans.com";
	SendSMSforLMS($SMSMessage, $Mobile_Number);
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Standard Charterd</title>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script type="text/javascript" src="ajax.js"></script>
<script type="text/javascript" src="ajax-dynamic-stanccompanies.js"></script>
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
	
	
.formfield
{
font-family:Arial, Helvetica, sans-serif;
font-size:13px;
color:#FFFFFF;
margin-top:4px;
}
.w175{width: 175px;}
.w230{width: 230px;}
</style>
<script language="javascript">
function onFocusBlank(element,defaultVal)
{
	if(element.value==defaultVal)
	{
		element.value="";
	}
}

function onBlurDefault(element,defaultVal){
	if(element.value==""){
		element.value = defaultVal;
	}
}

function containsalph(param)
{
	mystrLen = param.length;
	for(i=0;i<mystrLen;i++)
	{
		if((param.charAt(i)<"0")||(param.charAt(i)>"9"))
		{
			return true;
		}
	}
	return false;
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


function submitform(Form)
{
	var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
	var dt,mdate;dt=new Date();
	var alpha=/^[a-zA-Z\ ]*$/;
	var alphanum=/^[a-zA-Z0-9]*$/;
	var num=/^[0-9]*$/;
	var space=/^[\ ]*$/;
	var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";
		
	if(Form.validateMobile.value=='') 
	{
		alert("Kindly validate your Mobile Number!");
		document.loan_form.validateMobile.select();
		return false;
	}
		
	if(Form.validateMobile.value!= '<?php echo $Reference_Code; ?>') 
	{
		alert("Kindly enter correct verification code!");
		document.loan_form.validateMobile.select();
		return false;
	}
	
	if((Form.fname.value=="") || (Form.fname.value=="First Name")|| (Trim(Form.fname.value))==false)
	{
		alert("Kindly fill in your First Name!");
		document.loan_form.fname.select();
		return false;
	}
	else if(containsdigit(Form.fname.value)==true)
	{
		alert("First Name contains numbers!");
		Form.fname.select();
		return false;
	}
	 for (var i = 0; i < Form.fname.value.length; i++) {
	 	if (iChars.indexOf(Form.fname.value.charAt(i)) != -1) {
		  	alert ("First Name has special characters.\n Please remove them and try again.");
			Form.fname.select();
			return false;
  		}
	}

	if((Form.lname.value=="") || (Form.lname.value=="Last Name")|| (Trim(Form.lname.value))==false)
	{
		alert("Kindly fill in your Last Name!");
		document.loan_form.lname.select();
		return false;
	}
	else if(containsdigit(Form.lname.value)==true)
	{
		alert("Last Name contains numbers!");
		Form.lname.select();
		return false;
	}
	 for (var i = 0; i < Form.lname.value.length; i++) {
	 	if (iChars.indexOf(Form.lname.value.charAt(i)) != -1) {
		  	alert ("Last Name has special characters.\n Please remove them and try again.");
			Form.lname.select();
			return false;
  		}
	}


	if((space.test(Form.day.value)) || (Form.day.value=="dd"))
	{
	alert("Kindly enter your Date of Birth");
	Form.day.select();
	return false;
	}
	
	else if(!num.test(Form.day.value))
	{
	alert("Kindly enter your Date of Birth(numbers Only)");
	Form.day.select();
	return false;
	}
	
	else if((Form.day.value<1) || (Form.day.value>31))
	{
	alert("Kindly Enter your valid Date of Birth(Range 1-31)");
	Form.day.select();
	return false;
	}
	
	else if((space.test(Form.month.value)) || (Form.month.value=="mm"))
	{
	alert("Kindly enter your Month of Birth");
	Form.month.select();
	return false;
	}
	
	else if(!num.test(Form.month.value))
	{
	alert("Kindly enter your Month of Birth(numbers Only)");
	Form.month.select();
	return false;
	}
	
	else if((Form.month.value<1) || (Form.month.value>12))
	{
	alert("Kindly Enter your valid Month of Birth(Range 1-12)");
	Form.month.select();
	return false;
	}
	
	else if((Form.month.value==2) && (Form.day.value>29))
	{
	alert("Month February cannot have more than 29 days");
	Form.day.select();
	return false;
	}
	
	else if((space.test(Form.year.value)) || (Form.year.value=="yyyy"))
	{
	alert("Kindly enter your Year of Birth");
	Form.year.select();
	return false;
	}
	
	else if(!num.test(Form.year.value))
	{
	alert("Kindly enter your Year of Birth(numbers Only) !");
	Form.year.select();
	return false;
	}
	
	else if((Form.day.value > 28) && (parseInt(Form.month.value)==2) && ((Form.year.value%4) != 0))
	{
	alert("February cannot have more than 28 days.");
	Form.day.select();
	return false;
	}
	
	else if(Form.year.value.length != 4)
	{
	alert("Kindly enter your correct 4 digit Year of Birth.(Numeric ONLY)!");
	Form.year.select();
	return false;
	}
	else if((Form.year.value < "1950") || (Form.year.value >"1994"))
	{
	alert("Age Criteria! \n Applicants between age group 18 - 62 only are elgibile.");
	Form.year.select();
	return false;
	}
	else if(Form.year.value > parseInt(mdate-21) || Form.year.value < parseInt(mdate-62))
	{
	alert("Age Criteria! \n Applicants between age group 21 - 62 only are elgibile.");
	Form.year.select();
	return false;
	}
	
	else if((parseInt(Form.day.value)==31) && ((parseInt(Form.month.value)==4)||(parseInt(Form.month.value)==6)||(parseInt(Form.month.value)==9)||(parseInt(Form.month.value)==11)||(parseInt(Form.month.value)==2)))
	{
	alert("Cannot have 31st Day");Form.day.select();
	return false;
	}

	if(Form.gender.selectedIndex==0)
	{
		alert("Please select Gender ");
		Form.gender.focus();
		return false;
	}
	
	if(Form.qualification.selectedIndex==0)
	{
		alert("Please enter qualification to Continue");
		Form.qualification.focus();
		return false;
	}

	if(Form.add1.value=="")
	{
		alert("Kindly fill in your Address!");
		document.loan_form.add1.focus();
		return false;
	}

	if(Form.City.selectedIndex==0)
	{
		alert("Please enter City Name to Continue");
		Form.City.focus();
		return false;
	}

	if(Form.pincode.value=="")
	{
		alert("Kindly fill in your Pincode!");
		document.loan_form.pincode.focus();
		return false;
	}
	if((Form.Company_Name.value=="") || (Form.Company_Name.value=="Company Name")|| (Trim(Form.Company_Name.value))==false)
	{
		alert("Kindly fill in your Company Name!");
		Form.Company_Name.focus();
		return false;
	}
	else if(Form.Company_Name.value.length < 3)
	{
		alert("Kindly fill in your Company Name!");
		Form.Company_Name.focus();
		return false;
	}

	if(Form.designation.selectedIndex==0)
	{
		alert("Please enter designation to Continue");
		Form.designation.focus();
		return false;
	}

	if(!Form.panCardLater.checked)
	{
	
		var a=Form.Pancard.value;
		var regex1=/^[a-zA-Z]{5}\d{4}[a-zA-Z]{1}$/;  //this is the pattern of regular expersion
		if(regex1.test(a)== false)
		{
		  alert('Please enter valid pan number');
		   Form.Pancard.focus();
		  return false;
		}
	
		if (Form.Pancard.value.charAt(3)!="P" && Form.Pancard.value.charAt(3)!="p")
		{
			alert("Please enter valid pan number");
			 Form.Pancard.focus();
			return false;
		}
	}

	if(Form.income_proof.selectedIndex==0)
	{
		alert("Please enter Income Proof to Continue");
		Form.income_proof.focus();
		return false;
	}
	
	if(Form.IncomeAmount.value=='')
	{
		alert("Please enter Income to Continue");
		Form.IncomeAmount.focus();
		return false;
	}
	if((Form.Loan_Amount.value=='')||(Form.Loan_Amount.value=="Loan Amount"))
	{
		alert("Kindly fill in your Loan Amount (Numeric Only)!");
		Form.Loan_Amount.focus();
		return false;
	}
	
	
	
	if(!Form.accept.checked)
	{
		alert("Accept the Terms and Condition");
		Form.accept.focus();
		return false;
	}
}

function validateMobileNumber()
{
alert("We haven't yet received your call,Please validate your Mobile Number to proceed.");
}
</script>
<script type="text/javascript" src="scripts/jquery.js"></script>
<Script Language="JavaScript">
function onclick_proceedVal()
 {
	//	alert("dfddfsd");
          jQuery.post(
                    "VerifyZipDial.php",

                    {get_RequestID: document.getElementById('RequestID').value , get_proid: 4},

                    function(data){
						
						//alert(data);
						if(data=="yes")
						{
							//var checkVal = "yes";
							//alert("TrueValue");
							alert("Your Mobile Number is validated Now!!!");
							//	window.open("personalloans-applicationcontinue.php","_self");
							var ni = document.getElementById('myDivValidate');
							ni.innerHTML = '<input type="image" name="Submit" src="new-images/submit-scb.jpg"  style="border:none; " />';
							return true;
							
						}
						else
						{
							alert("We haven't yet received your call yet, Please validate your Mobile Number to proceed.");
						}

   
					 }
        );
    

}
</script>
</head>
<body>
<?php

	$sql = "SELECT * FROM `Req_Credit_Card` where RequestID='".$lastInserted."'";
	list($num_2,$query)=Mainselectfunc($sql,$array = array());
	$Name = $query[0]['Name'];
	list($fname, $lname) = split(' ', $Name);
	$DOB = $query[0]['DOB'];
	list($year, $month, $day) = split('[/.-]', $DOB);
	$City = $query[0]['City'];
	$Mobile_Number = $query[0]['Mobile_Number'];
	$Net_Salary = $query[0]['Net_Salary'];
	$Company_Name = $query[0]['Company_Name'];
	$Phone = $Mobile_Number;
?>
<form name="loan_form" method="post" action="scb-continue.php" onSubmit="return submitform(document.loan_form);" enctype="multipart/form-data">

<table cellpadding="0" cellspacing="0" border="0" align="center">
<tr><td align="center">
<table cellpadding="2" cellspacing="0" border="0">
<tr><td colspan="2"><img src="new-images/top_band.jpg" /></td></tr>
<tr><td><img src="new-images/stan_chart_logo.jpg" /></td><td align="right" valign="bottom"><!--<img src="new-images/credit-card-text.png" /> --><img src="new-images/poweredby.png" /></td></tr>
<tr><td colspan="2" style="font-family:Arial, Helvetica, sans-serif; color:#FFFFFF; background-color:#37aa4d; font-size:12px; font-weight:bold;">Basic Information</td></tr>
<tr><td colspan="2" bgcolor="#0b5d94" >
<table width="940" border="0" cellpadding="3" cellspacing="0">
<tr><td width="937" colspan="2" align="center">
<div  style="font-family:Arial, Helvetica, sans-serif; color:#FFFFFF; text-align:center; line-height:20px;">You are applying for a</div>
<div  style="font-family:Arial, Helvetica, sans-serif; color:#FFFFFF; font-weight:bold; text-align:center; font-size:16px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Platinum Rewards card</div>
</td></tr>
<tr><td colspan="2" align="left" style="color:#FFFFFF; font-family:Arial, Helvetica, sans-serif;">
Validate your Mobile Number<hr style="color:#FFFFFF;" />
</td></tr>
<tr><td colspan="2" align="left">
<table width="895" border="0" cellpadding="3" cellspacing="6">
<tr><td width="100">&nbsp;</td><td width="100" class="formfield" colspan="5">
<b>To Verify, Please input the verification code sent on your Mobile Number "<span style="color:#FFFFFF;" ><? echo $Phone; ?></span>".</b></td></tr>
<tr><td width="100">&nbsp;</td><td width="100" class="formfield" colspan="5" align="center">
<?php
				//   $client_transaction_id = $lastInserted."_CC";
				  // $zipdimage = mobile_verify($Phone,$client_transaction_id);
				   
                   ?>
	 <!-- <img src="<? //echo $zipdimage; ?>" />  -->
     <input name="validateMobile" class="w175" id="validateMobile" maxlength="4" onChange="intOnly(this);"  onKeyUp="intOnly(this);" onKeyPress="intOnly(this); "  />
</td></tr>
<!--<tr><td width="100">&nbsp;</td><td width="100" class="formfield" colspan="5" align="right">
<input name="submit" type="button" style="width:180px; background-color: #38ab4c; color:#FFFFFF; font-weight:700" value="Validate Your Number" onclick="onclick_proceedVal();" /></td></tr> -->
</table></td></tr>
<tr><td colspan="2" align="left" style="color:#FFFFFF; font-family:Arial, Helvetica, sans-serif;">
Personal Information<hr style="color:#FFFFFF;" />
</td></tr>
<tr><td colspan="2" align="left">
<table width="895" border="0" cellpadding="3" cellspacing="6">
<tr><td width="100">&nbsp;</td><td width="100" class="formfield">Full Name <font size="1" color="#FF0000">*</font></td>
<td width="189"><input name="fname" class="w175" id="fname" maxlength="32" value="<?php echo $fname; ?>" /></td><td width="84">&nbsp;</td><td width="108" class="formfield">Middle Name</td>
<td width="236"><input name="mname" class="w175" id="mname" maxlength="32" />
<input type="hidden" name="RequestID" class="w175" id="RequestID" maxlength="32" value="<?php echo $lastInserted; ?>" />
<input type="hidden" name="Descr" class="w175" id="Descr" maxlength="32" value="<?php echo $Descr; ?>" />

</td></tr>

<tr><td width="100">&nbsp;</td><td class="formfield">Last Name <font size="1" color="#FF0000">*</font></td><td><input name="lname" class="w175" id="lname" maxlength="32"  value="<?php echo $lname; ?>" /></td><td width="84">&nbsp;</td>
<td class="formfield">Date of Birth <font size="1" color="#FF0000">*</font></td><td><input name="day" type="text" id="day"  value="<?php echo $day; ?>" style="width:40px; " onBlur="onBlurDefault(this,'dd');"  onFocus="onFocusBlank(this,'dd');" maxlength="2" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);"/> <input name="month" id="month" type="text"  value="<?php echo $month; ?>"  style="width:40px; " onBlur="onBlurDefault(this,'mm');"  onFocus="onFocusBlank(this,'mm');" maxlength="2" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);"/> <input name="year" id="year" type="text"  value="<?php echo $year; ?>"  style="width:47px; " onBlur="onBlurDefault(this,'yyyy');"  onFocus="onFocusBlank(this,'yyyy');" maxlength="4" onChange="intOnly(this); insertData();" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);"/></td></tr>

<tr><td width="100">&nbsp;</td><td class="formfield">Gender <font size="1" color="#FF0000">*</font></td><td><select name="gender" id="gender" ><option selected="selected" value="">Select</option><option value="Male">Male</option><option value="Female">Female</option></select></td><td width="84">&nbsp;</td>
<td class="formfield">Qualification <font size="1" color="#FF0000">*</font></td><td> <select name="qualification" class="w175" id="qualification">
                                            <option selected="selected" value="0">Select</option>
											<option value="Diploma">Diploma</option>
                                            <option value="Graduate">Graduate</option>
                                            <option value="Post-Graduate">Post-Graduate</option>
                                            <option value="Professional">Professional</option>
                                            <option value="Others">Others</option>
                                            <option value="Architect">Architect</option>
                                            <option value="Lawyer">Lawyer</option>
                                            <option value="CA">CA</option>
                                            <option value="Doctor">Doctor</option>
                                            <option value="Engineer">Engineer</option>
                                            <option value="MBA">MBA/MMS</option>
                                        </select></td></tr>

<tr><td width="100">&nbsp;</td><td class="formfield">Address line 1 <font size="1" color="#FF0000">*</font></td><td><input name="add1" class="w175" id="add1" /></td><td width="84">&nbsp;</td>
<td class="formfield">Address Line 2<font size="1" color="#FF0000">&nbsp;</font></td><td><input name="add2" class="w175" id="add2"  /></td></tr>

<tr><td width="100">&nbsp;</td><td class="formfield">City <font size="1" color="#FF0000">*</font></td><td><select  name="City" class="w175" id="City" style="width:142px; height:18px;  "  >
        <?=plgetCityList($City)?>
      </select><?php //echo $City; ?></td><td width="84">&nbsp;</td>
      <td class="formfield">Pincode <font size="1" color="#FF0000">*</font></td><td><input name="pincode" class="w175" id="pincode" maxlength="6" /></td></tr>
</table>
</td></tr>
<tr><td colspan="2" align="left" style="color:#FFFFFF; font-family:Arial, Helvetica, sans-serif;">
Employment & Income Details<hr style="color:#FFFFFF;" />
</td></tr>
<tr><td colspan="2" align="left">
<table width="897" border="0" cellpadding="3" cellspacing="6">
<tr><td width="97">&nbsp;</td>
<td width="108" class="formfield">Company Name <font size="1" color="#FF0000">*</font></td>
<td width="193"><input name="Company_Name" class="w175" value="<?php echo $Company_Name; ?>"  style=" color:#000000;" id="Company_Name"  onKeyUp="ajax_showOptions(this,'getCountriesByLetters',event)"    /><?php //echo $Company_Name; ?></td><td width="75">&nbsp;</td><td width="116" class="formfield">Designation <font size="1" color="#FF0000">*</font></td>
<td width="230"><select name="designation" id="designation" class="w175">
                                            <option selected="selected" value="-1">Select</option>
                                            <option value="Senior Management">Senior Management</option>
                                            <option value="Middle Management">Middle Management</option>
                                            <option value="Junior Management">Junior Management</option>
                                            <option value="Non Management">Non Management</option>
                                            <option value="Others">Others</option>
                                        </select></td></tr>

<tr><td width="97">&nbsp;</td>
<td width="108" class="formfield">PAN Number  <font size="1" color="#FF0000">*</font></td>
<td width="193"><input name="Pancard" class="w175" id="Pancard" maxlength="10"  /></td><td width="75">&nbsp;</td>
<td width="116" class="formfield">Income proof document <font size="1" color="#FF0000">*</font></td>
<td width="230"> <select name="income_proof" id="income_proof" class="w230" >
<option value="0">Select</option>
<option value="ayslip (Recommended Document)" selected="selected">Payslip (Recommended Document)</option>
<option value="Savings account bank statement with ITR">Savings account bank statement with ITR</option>
<option value="Salary credit in SCB salary account">Salary credit in SCB salary account</option>
<option value="Life Insurance Premium Reciepts">Life Insurance Premium Reciepts</option>
<option value="Other Bank Credit card statement">Other Bank Credit card statement</option>
<option value="Housing Loan with SCB">Housing Loan with SCB</option>
<option value="Savings account with SCB">Savings account with SCB</option>
<option value="Emirates Frequent Flyer">Emirates Frequent Flyer</option>
</select></td></tr>

<tr><td width="97">&nbsp;</td>
<td class="formfield" colspan="2" align="right"><input name="panCardLater" id="panCardLater" type="checkbox" value="1"> I would like to submit my PAN later</td><td width="75">&nbsp;</td>
<td width="116" class="formfield">Gross monthly income as per payslip <font size="1" color="#FF0000">*</font></td>
<td width="230"> <input name="IncomeAmount" type="text" class="w175" id="IncomeAmount" onFocus="this.select();"  onChange="intOnly(this);"  onKeyUp="intOnly(this);" onKeyPress="intOnly(this); " value="<?php echo $Net_Salary; ?>" /></td></tr>

</table></td></tr>



<tr><td colspan="2" align="left" style="color:#FFFFFF; font-family:Arial, Helvetica, sans-serif;">
Relation With SCB<hr style="color:#FFFFFF;" />
</td></tr>
<tr><td colspan="2" align="left">
<table width="898" border="0" cellpadding="3" cellspacing="6">
<tr><td width="100">&nbsp;</td><td width="164" class="formfield">Existing SCB customer <font size="1" color="#FF0000">*</font></td>
<td width="162" class="formfield"><input name="existing_customer" id="existing_customer" checked="checked" value="0" type="radio">
&nbsp;No&nbsp;&nbsp;&nbsp;&nbsp;
<input name="existing_customer" id="existing_customer" value="1" type="radio">&nbsp;Yes</td><td width="317">&nbsp;</td><td width="14" class="formfield">&nbsp;</td>
<td width="63">&nbsp;</td>
</tr>

<tr><td width="100">&nbsp;</td><td colspan="2" class="formfield"><em>Fields marked with an asterisk</em><strong><font size="1" color="#FF0000">*</font></strong><em> are mandatory.</em></td>
<td colspan="3" align="right" class="formfield"><input type="checkbox"  name="accept" style="border:none;" checked  > 
  I have read the Terms &amp; Conditions and agree to the terms therein.</td>
</tr>

<tr><td width="100">&nbsp;</td><td colspan="2" class="formfield">&nbsp;</td>
<td colspan="3" align="right">
<!--<div  id="myDivValidate">
<input type="button" name="Submit" style="background-image:url(new-images/submit-scb.jpg); height:30px; width:85px; border:none;"   onclick="validateMobileNumber();"/>
</div> -->
<input type="image" name="Submit" src="new-images/submit-scb.jpg"  style="border:none; " />
</td>
</tr>
</table></td></tr>

</table>
</td></tr>

</table>
</td></tr></table>
</form>
</body>
</html>
