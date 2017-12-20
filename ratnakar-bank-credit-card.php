<?
require 'scripts/db_init.php';
require 'scripts/functions.php';

$ccrqd=$_REQUEST["ccrqd"];
$cc_bankid=$_REQUEST["cc_bankid"];

$rblccqrydt="Select * from credit_card_banks_eligibility Where (cc_bankid=".$cc_bankid.")";
list($num,$rowcc)=MainselectfuncNew($rblccqrydt,$array = array());
$rowcccontr = count($rowcc)-1;
$ccimage=$rowcc[$rowcccontr]["card_image_view"];
$cc_bank_features = $rowcc[$rowcccontr]["cc_bank_features"];
$cc_bank_name = $rowcc[$rowcccontr]["cc_bank_name"];

$rblccqry="Select Company_Name,Employment_Status,Name,Mobile_Number,Email,DOB,CC_Holder,Net_Salary,Salary_Account,No_of_Banks,Card_Vintage,City,City_Other,Pincode from Req_Credit_Card Where (RequestID=".$ccrqd.")";
list($num,$row)=MainselectfuncNew($rblccqry,$array = array());
$rowcontr = count($row)-1;
$Employment_Status = $row[$rowcontr]["Employment_Status"];
$Name = $row[$rowcontr]["Name"];
$Mobile = $row[$rowcontr]["Mobile_Number"];
$Email = $row[$rowcontr]["Email"];
$DOB = $row[$rowcontr]["DOB"];
$CC_Holder = $row[$rowcontr]["CC_Holder"];
$Net_Salary = $row[$rowcontr]["Net_Salary"];
$Salary_Account = $row[$rowcontr]["Salary_Account"];
$No_of_Banks = $row[$rowcontr]["No_of_Banks"];
$City = $row[$rowcontr]["City"];
$City_Other = $row[$rowcontr]["City_Other"];
$Company_Name = $row[$rowcontr]["Company_Name"];
$Pincode = $row[$rowcontr]["Pincode"];

 if($City=="Others" || $City=="Please Select")
{
	$City=$City_Other;
}
else
{
	$City= $City;
}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Ratnakar Bank Credit Card</title>
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<link href="ratnakar-bank-cc-styles.css" type="text/css" rel="stylesheet"  />
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<!--[if IE 8]>
<link rel="stylesheet" href="ratnakar-bank-cc-styles_ie.css" type="text/css" media="screen" />
<![endif]-->
<script type="text/javascript">
function incomeproof()
{
	var ni1 = document.getElementById("InPrfDIV");
	var cit = document.rbl_form.EmploymentType.value;
	if(cit==1 || cit==4 || cit==5)
	{
		 ni1.innerHTML = '<select name="IncomeProof" id="IncomeProof" class="input" onChange="personaldetails();">  <option value="0">Please Select</option><option value="1">Payslip (Recommended Document)</option><option value="3">Salary certificate with bank statement</option><option value="16">Non RBL Credit card statement with front face copy of the same credit card</option>  </select>';
	}
	else if(cit==2)
	{
		ni1.innerHTML = '<select name="IncomeProof" id="IncomeProof" class="input" onChange="personaldetails();">	<option value="0">Please Select</option>	<option value="16">Non RBL Credit card statement with front face copy of the same credit card</option></select>';
	}
	else if(cit==3)
	{
		ni1.innerHTML = '<select name="IncomeProof" id="IncomeProof" class="input" onChange="personaldetails();">	<option value="0">Please Select</option><option value="16">Non RBL Credit card statement with front face copy of the same credit card</option></select>';
	}
	else
		{
		var ni1 = '';
		}
}
function personaldetails()
{
	var ni = document.getElementById("personaldetails");	
		 ni.innerHTML = '<div class="clearfix"></div><div class="form_left_text">Gender</div><div class="form_left_input padding-top"><input type="radio" name="Gender" id="Gender" value="1"> Male<input type="radio" name="Gender" id="Gender" value="2"> Female  </div><div class="clearfix"></div><div class="form_left_text"> Qualification</div><div class="form_left_input"><select name="Qualification" id="Qualification" class="input"><option value="">Please Select</option><option value="9">Diploma</option><option value="10">Graduate</option><option value="13">Post-Graduate</option><option value="15">Professional</option><option value="19">Others</option><option value="20">Architect</option><option value="23">Lawyer</option><option value="24">CA</option><option value="25">Doctor</option><option value="26">Engineer</option><option value="27">MBA/MMS</option></select></div><div class="clearfix"></div><div class="form_left_text">Res City</div><div class="form_left_input"> <select name="ResCity" id="ResCity" class="input"> <option value="">Please select</option> <option value="22" <? if($City=="Ahmedabad") { echo "selected";} ?>>Ahmedabad </option><option value="979" <? if($City=="Ahmednagar") {echo "Selected";} ?>>Ahmednagar</option><option value="707" <? if($City=="Baroda") {echo "Selected";} ?>>Baroda</option><option value="980" <? if($City=="Belgaum") {echo "Selected";} ?>>Belgaum</option><option value="19" <? if($City=="Bangalore") { echo "Selected";} ?>>Bengaluru</option><option value="623" <? if($City=="Bhopal") {echo "Selected";} ?>>Bhopal</option><option value="21" <? if($City=="Chennai") {echo "Selected";} ?>>Chennai</option><option value="981" <? if($City=="Faridabad") {echo "Selected";} ?>>Faridabad</option><option value="87" <? if($City=="Gaziabad") {echo "Selected";} ?>>Ghaziabad</option><option value="704" <? if($City=="Greater Noida") {echo "Selected";} ?>>Greater Noida</option><option value="7" <? if($City=="Gurgaon") {echo "Selected";} ?>>Gurgaon</option><option value="1034" <? if($City=="Howrah") {echo "Selected";} ?>>Howrah</option><option value="1011" <? if($City=="Hubli") {echo "Selected";} ?>>Hubli</option><option value="15" <? if($City=="Hyderabad") {echo "Selected";} ?>>Hyderabad</option><option value="106" <? if($City=="Indore") {echo "Selected";} ?>>Indore</option><option value="983" <? if($City=="Kolhapur") {echo "Selected";} ?>>Kolhapur</option><option value="64" <? if($City=="Kolkata") {echo "Selected";} ?>>Kolkata</option><option value="807" <? if($City=="Lucknow") {echo "Selected";} ?>>Lucknow</option><option value="984" <? if($City=="Mangalore") {echo "Selected";} ?>>Mangalore</option><option value="25" <? if($City=="Mumbai") {echo "Selected";} ?>>Mumbai</option><option value="163" <? if($City=="Navi Mumbai") {echo "Selected";} ?>>Navi Mumbai</option><option value="318"  <? if($City=="Delhi") {echo "Selected";} ?>>New Delhi</option><option value="78" <? if($City=="Noida") {echo "Selected";} ?>>Noida</option><option value="26" <? if($City=="Pune") {echo "Selected";} ?>>Pune</option><option value="989" <? if($City=="Salem") {echo "Selected";} ?>>Salem</option><option value="990" <? if($City=="Sangli") {echo "Selected";} ?>>Sangli</option><option value="190" <? if($City=="Surat") {echo "Selected";} ?>>Surat</option><option value="640" <? if($City=="Thane") {echo "Selected";} ?>>Thane</option><option value="992" <? if($City=="Udaipur") {echo "Selected";} ?>>Udaipur</option><option value="993" <? if($City=="Vadodara") {echo "Selected";} ?>>Vadodara</option></select></div><div class="clearfix"></div><div class="form_left_text">Res PIN</div><div class="form_left_input">  <input type="text" name="ResiPin" id="ResiPin" class="input" maxlength="6" onkeyup="intOnly(this);" onkeypress="intOnly(this);" value="<? echo $Pincode; ?>"></div><div class="clearfix"></div><div class="form_left_text">Res Address 1</div><div class="form_left_input">  <input type="text" name="Resiaddress1" id="Resiaddress1" class="input"  maxlength="40"></div><div class="clearfix"></div><div class="form_left_text">Res Address 2</div><div class="form_left_input">  <input type="text" name="Resiaddress2" id="Resiaddress2" class="input"  maxlength="40"></div><div class="clearfix"></div><div class="form_left_text">Residence phone number</div><div class="form_left_input"><input type="text" name="std" value="STD" maxlength="3" size="3" />  <input type="text" name="Phoneno" id="Phoneno" class="input" maxlength="8" style="width="70%!important;"></div><div class="clearfix"></div><div class="form_left_text">Credit limit on existing credit card</div><div class="form_left_input">  <input type="text" name="CCCreditLimit" id="CCCreditLimit" class="input" onkeyup="intOnly(this);" onkeypress="intOnly(this);"></div>';		
}
function designation()
{
	var nid = document.getElementById("DesiDIV");
	var nict = document.getElementById("CmpTypeDIV");
	
	var citd = document.rbl_form.EmploymentType.value;
	if(citd==1 || citd==4 || citd==5)
	{
	nid.innerHTML = '<select name="Designation" id="Designation" class="input"><option value="">Please Select</option><option value="9">Others</option><option value="10">Non Management</option><option value="11">Junior Management</option><option value="12">Middle Management</option><option value="13">Senior Management</option></select>';
	nict.innerHTML='<select name="CompanyType" id="CompanyType" class="input"><option value="">Please Select</option><option value="10">Government Sector</option><option value="11">PSU</option><option value="12">Public Ltd</option><option value="13">MNC</option><option value="15">Pvt Ltd</option><option value="16">Proprietorship</option><option value="17">Partnership</option><option value="18">Others</option></select>';
	}
	else
	{
		nid.innerHTML = '<select name="Designation" id="Designation" class="input"><option value="9">Others</option></select>';
		nict.innerHTML='<select name="CompanyType" id="CompanyType" class="input"><option value="14">Self Employed</option></select>';
	}
}
function checkvalidate(Form)
{
	var myOption;
	var i;
	if(Form.EmploymentType.selectedIndex==0)
	{
		alert("Select Employment Status!");
		Form.EmploymentType.focus();
		return false;
	}
	if(Form.EmployerName.value=="")
	{
		alert("Please Fill Employer Name / Establishment Name");
		Form.EmployerName.focus();
		return false;
	}
	if(Form.EmploymentType.value==1 || Form.EmploymentType.value==4 || Form.EmploymentType.value==5)
	{
	if(Form.Designation.selectedIndex==0)
	{
		alert("Select Designation!");
		Form.Designation.focus();
		return false;
	}
	if(Form.CompanyType.selectedIndex==0)
	{
		alert("Select Type of Company!");
		Form.CompanyType.focus();
		return false;
	}
	}
	if(Form.SalaryAcc.selectedIndex==0)
	{
		alert("Select Salaried bank account with!");
		Form.SalaryAcc.focus();
		return false;
	}
	var a=Form.Panno.value;
	var regex1=/^[a-zA-Z]{5}\d{4}[a-zA-Z]{1}$/;  //this is the pattern of regular expersion
	if(regex1.test(a)== false)
	{
	  alert('Please enter valid pan number');
	  Form.Panno.focus();
	  return false;
	}
	if (Form.Panno.value.charAt(3)!="P" && Form.Panno.value.charAt(3)!="p")
	{
			alert("Please enter valid pan number");
			Form.Panno.focus();
			return false;
	}
	if(Form.IncomeProof.selectedIndex==0)
	{
		alert("Select Proof of Income!");
		Form.IncomeProof.focus();
		return false;
	}	
	myOption = -1;
		for (i=Form.Gender.length-1; i > -1; i--) {
			if(Form.Gender[i].checked) {
				myOption = i;
			}
		}
		if (myOption == -1) 
		{
			alert("Select Gender !");	
			return false;
		}
	if(Form.Qualification.selectedIndex==0)
		{
			alert("Select Qualification!");
			Form.Qualification.focus();
			return false;
		}
	if(Form.ResCity.selectedIndex==0)
		{
			alert("Select Residence City!");
			Form.ResCity.focus();
			return false;
		}	
	if(Form.ResiPin.value=="")
		{
			alert("Please Residence Pincode");
			Form.ResiPin.focus();
			return false;
		}
	if (Form.ResiPin.value!="")
	{
		if(Form.ResiPin.value.length < 6)
		{
			alert("Enter Residence Pincode(6 Digits)!");	
			Form.ResiPin.focus();
			return false;
		}
	}
	if(Form.Resiaddress1.value=="")
		{
			alert("Please Fill Residence Address");
			Form.Resiaddress1.focus();
			return false;
		}
	<? if($CC_Holder==1)
	{ ?>
		if(Form.CCCreditLimit.value=="")
		{
			alert("Please Fill Credit Card Limit");
			Form.CCCreditLimit.focus();
			return false;
		}
	<? }
		?>

		if(!Form.rbl_cibil.checked)
	{
		alert("Read and Accept Terms & Conditions!");	
		Form.rbl_cibil.focus();
		return false;
	}

}
</script>
</head>
<body>
<div class="header">
<div class="logo_rbl">

<div class="logo_rbl_two">Powered by: Deal4loans.com</div>
</div>
</div>
<div class="container">
<div style="font-family:Arial, Helvetica, sans-serif; font-size:15px; color:#1c3285; font-size:18px; margin:8px;" align="center">You are almost done with your RBL Bank Credit Card application.<br>
Please fill in few more details for <i>"Instant Eligibility"</i> check from RBL Bank.</div>
<form name="rbl_form" action="ratnakar-bank-credit-card-continue.php" method="post" onSubmit="return checkvalidate(document.rbl_form);"> 
<input type="hidden" name="ccrqd" id="ccrqd" value="<? echo $ccrqd; ?>">
<input type="hidden" name="Name" id="Name" value="<? echo $Name; ?>">
<input type="hidden" name="Mobile" id="Mobile" value="<? echo $Mobile; ?>">
<input type="hidden" name="Email" id="Email" value="<? echo $Email; ?>">
<input type="hidden" name="DOB" id="DOB" value="<? echo $DOB; ?>">
<input type="hidden" name="CC_Holder" id="CC_Holder" value="<? echo $CC_Holder; ?>">
<input type="hidden" name="Net_Salary" id="Net_Salary" value="<? echo $Net_Salary; ?>">
<input type="hidden" name="CC_Bank" id="CC_Bank" value="<? echo $No_of_Banks ; ?>">
<input type="hidden" name="CardSince" id="CardSince" value="<? echo $Card_Vintage ; ?>">
<div class="left_box" >
<div style="font-family:Arial, Helvetica, sans-serif; font-size:18px; color:#1c3285; padding-top:5px; height:25px; background:#cbcbea; margin-top:10px;">&nbsp;Professional Details :</div>
<div class="clearfix"></div>
<div class="form_left_text"> Applied for Credit Card</div>
<div class="form_left_input">
<select name="AppliedCC" id="AppliedCC" class="input">
<option value="">Please Select</option>
<option value="13" <? if($cc_bankid==43) {echo "Selected";} ?>>Delhi Daredevils Platinum Card</option>
<option value="16" <? if($cc_bankid==44) {echo "Selected";} ?>>Titanium Delight Card</option>
<option value="21" <? if($cc_bankid==42) {echo "Selected";} ?>>Platinum Maxima Card</option>
</select>
</div>
<div class="clearfix"></div>
<div class="form_left_text">Employment Type or Mode of Credit</div>
<div class="form_left_input">
<select name="EmploymentType" id="EmploymentType" class="input" onChange="incomeproof(); designation();">
<option value="">Please Select</option>
 <option value="1">Salaried: RBL Salary A/C</option>
 <option value="2">Self Employed Business</option>
 <option value="3">Self Employed Professional</option>
 <option value="4">Salaried: Other Bank Salary A/C</option>
 <option value="5">Salaried: By Cash or Cheque</option>
 </select>
</div>
<div class="clearfix"></div>
<div class="form_left_text">Employer Name / Establishment Name</div>
<div class="form_left_input">
  <input type="text" name="EmployerName" id="EmployerName" class="input" value="<? echo $Company_Name; ?>">
</div>
<div class="clearfix"></div>
<div class="form_left_text">Designation</div>
<div class="form_left_input">
<div id="DesiDIV">
<select name="Designation" id="Designation" class="input">
<option value="">Please Select</option>
<option value="9">Others</option>
<option value="10">Non Management</option>
<option value="11">Junior Management</option>
<option value="12">Middle Management</option>
<option value="13">Senior Management</option>
</select>
</div>
</div>
<div class="clearfix"></div>
<div class="form_left_text">Type of Company</div>
<div class="form_left_input">
<div id="CmpTypeDIV">
<select name="CompanyType" id="CompanyType" class="input">
<option value="">Please Select</option>
<option value="10">Government Sector</option>
<option value="11">PSU</option>
<option value="12">Public Ltd</option>
<option value="13">MNC</option>
<option value="15">Pvt Ltd</option>
<option value="16">Proprietorship</option>
<option value="17">Partnership</option>
<option value="18">Others</option>
</select>
</div>
</div>
<?
if($Employment_Status==0)
{
}
else
{ ?>
<div class="clearfix"></div>
<div class="form_left_text">Salaried bank account with</div>
<div class="form_left_input">
<select name="SalaryAcc" id="SalaryAcc" class="input">
<option value="">Please Select</option>
<option value="10">Abhyudaya Co-op. Bank Ltd.</option>
<option value="20">ACE Co-Operative Bank Ltd.</option>
<option value="30">Allahabad Bank</option>
<option value="40">Amanath Co-op. Bank Ltd.</option>
<option value="50">American Express Banking Corporation</option>
<option value="60">Andhra Bank</option>
<option value="70">Apna Sahakari Bank Ltd.</option>
<option value="80">AXIS Bank</option>
<option value="90">Bajaj Finserv Ltd.</option>
<option value="100">Bank of America N.A.</option>
<option value="110">Bank of Baroda</option>
<option value="120">Bank of India</option>
<option value="130">Bank of Maharashtra</option>
<option value="140">Barclays Bank</option>
<option value="150">Barclays Investments and Loans (India) Ltd.</option>
<option value="160">Canara Bank</option>
<option value="170">Capital Local Area Bank Ltd.</option>
<option value="180">Central Bank of India</option>
<option value="190">Citibank N.A.</option>
<option value="200">CitiFinancial</option>
<option value="210">City Union Bank Ltd.</option>
<option value="220">Coastal Local Area Bank Ltd.</option>
<option value="230">Corporation Bank</option>
<option value="240">Credila Education Loan Service Pvt. Ltd.</option>
<option value="250">Dena Bank</option>
<option value="260">Deutsche Bank AG</option>
<option value="270">Development Credit Bank Ltd.</option>
<option value="280">Dewan Housing Finance Limited</option>
<option value="290">Dhanlaxmi Bank Ltd.</option>
<option value="300">First Blue Home Finance Limited</option>
<option value="310">Fullerton India Credit Co Ltd.</option>
<option value="320">GE Money Financial Services Ltd.</option>
<option value="330">GIC Housing Finance Ltd.</option>
<option value="340">HDFC Bank</option>
<option value="350">HDFC Limited</option>
<option value="360">HSBC Bank</option>
<option value="370">ICICI Bank</option>
<option value="380">IDBI Bank Ltd.</option>
<option value="390">IDBI Home Finance Ltd.</option>
<option value="400">Indiabulls Financial Services Limited</option>
<option value="410">Indian Bank</option>
<option value="420">Indian Overseas Bank</option>
<option value="430">IndusInd Bank Ltd.</option>
<option value="440">ING Vysya Bank Ltd.</option>
<option value="450">Jammu  Kashmir Bank Ltd.</option>
<option value="460">Karnataka Bank Ltd.</option>
<option value="470">Karur Vysya Bank Ltd.</option>
<option value="480">Kotak Mahindra Bank Ltd.</option>
<option value="490">Krishna Bhima Samruddhi Local Area Bank Ltd.</option>
<option value="500">LIC Housing Finance Ltd.</option>
<option value="510">Magma Fincorp Ltd.</option>
<option value="520">New India Co-op. Bank Ltd.</option>
<option value="530">Oriental Bank of Commerce</option>
<option value="540">PNB Housing Finance Ltd</option>
<option value="550">PNB Housing Finance Ltd.</option>
<option value="560">Punjab  Maharashtra Co-op. Bank Ltd.</option>
<option value="570">Punjab  Sind Bank</option>
<option value="580">Punjab National Bank</option>
<option value="590">Reliance Consumer Finance Pvt. Ltd.</option>
<option value="600">Reliance Home Finance Pvt. Ltd.</option>
<option value="610">Religare Enterprises Ltd.</option>
<option value="620">Royal Bank of Scotland</option>
<option value="630">SBI Commercial and International</option>
<option value="640">South Indian Bank Ltd.</option>
<option value="650">Standard Chartered Bank</option>
<option value="660">State Bank of Bikaner  Jaipur</option>
<option value="670">State Bank of India</option>
<option value="680">State Bank of Mysore</option>
<option value="690">State Bank of Patiala</option>
<option value="700">State Bank of Travancore</option>
<option value="710">Sundaram Finance Group</option>
<option value="720">Syndicate Bank</option>
<option value="730">Tamilnad Mercantile Bank Ltd.</option>
<option value="740">Tata Capital Ltd.</option>
<option value="750">The Catholic Syrian Bank Ltd.</option>
<option value="760">The Federal Bank Ltd.</option>
<option value="770">The Lakshmi Vilas Bank Ltd.</option>
<option value="780">The Nainital Bank Ltd.</option>
<option value="790">The Ratnakar Bank Ltd.</option>
<option value="800">The Saraswat Co-op. Bank Ltd.</option>
<option value="810">UCO Bank</option>
<option value="820">Union Bank of India</option>
<option value="830">United Bank of India</option>
<option value="840">Vijaya Bank</option>
<option value="850">Yes Bank</option>
<option value="860">Future Capital Holdings</option>
<option value="999">Others</option>
</select>
</div>
<? } ?>
<div class="clearfix"></div>
<div class="form_left_text"> PAN No</div>
<div class="form_left_input">
  <input type="text" name="Panno" id="Panno" class="input" maxlength="10">
</div>
<div class="clearfix"></div>
<div class="form_left_text">Proof of Income</div>
<div class="form_left_input">
<div id="InPrfDIV">
  <select name="IncomeProof" id="IncomeProof" class="input" onChange="personaldetails();">
   <option value="0">Please Select</option>
  <option value="1">Payslip (Recommended Document)</option>
<option value="3">Salary certificate with bank statement</option>
<option value="4">Savings account bank statement with ITR</option>
<option value="5">Salary certifiicate with company photo id</option>
<option value="6">Salary credit in RBL salary account</option>
  </select></div>
</div>
<div class="clearfix"></div>
<div class="form_left_text">Is existing RBL customer</div>
<div class="form_left_input">
<input type="radio" name="RBLcustomer" id="RBLcustomer" value="Y"> Yes
<input type="radio" name="RBLcustomer" id="RBLcustomer" value="N"> No  
</div>
<div class="clearfix"></div>
<div class="clearfix"></div>
<div style="font-family:Arial, Helvetica, sans-serif; font-size:18px; color:#1c3285; padding-top:5px; height:25px; vertical-align:middle; background:#cbcbea; margin-top:10px;">&nbsp;Personal Details :</div>
<div class="clearfix"></div>
<div id="personaldetails">
</div>
<div class="clearfix"></div>
<div style="   font-family: Arial,Helvetica,sans-serif;    font-size: 11px;    margin-top: 7px;    padding-top: 8px;" align="center"><input type="checkbox" name="rbl_cibil" id="rbl_cibil">I authorize Deal4loans.com & its partnering banks to conduct CIBIL check based on the information provided by me</div>

<div class="clearfix"></div>
<div class="form_left_text">	</div>
<div class="form_left_input">
  <input name="" type="image" src="images/get-quote-rbl.png" height="37" width="170">
</div>
</div>
</form>
<div class="right_box">
<h1><? echo $cc_bank_name;?></h1>
<div class="img_bx"><img src="<? echo $ccimage; ?>" width="230" height="200" alt="RBL Bank Credit Card"></div>
<div class="features_text">Features & Benefits</div>
<div class="re_bullet_text">
<?  echo $cc_bank_features; ?>
</div>
</div>
</div>
</body>
</html>