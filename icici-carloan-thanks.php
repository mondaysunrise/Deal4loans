<?php
require 'scripts/db_init.php';
require 'scripts/functions.php';
require 'scripts/session_check.php';
$maxage=date('Y')-62;
$minage=date('Y')-18;

 $get_reqid = $_REQUEST['get_reqid'];

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		foreach($_POST as $a=>$b)
			$$a=$b;

			$userid = $_POST['get_reqid'];
			$email = $_POST['email'];
			$full_name = $_POST['full_name'];
			$pancard_no = $_POST['pancard_no'];
			$mobile = $_POST['mobile'];
			$office_address = $_POST['mobile'];
			$residence_address = $_POST['residence_address'];
			list($firstn,$lastn) = split(" ",$full_name);
			

	$Reference_Code = generateNumber(4);
	$app_code = date('dmy')."".$Reference_Code;
		$SMSMessage = "Dear Customer, the activation code - $Reference_Code for ICICI Car Loan Process. Use in activation code box to verify your mobile number.";
	if(strlen(trim($mobile)) > 0)
	{
		SendSMS($SMSMessage, $mobile);
	}
			
if($userid>0)
	{
//$icici_clquery="Update icici_car_loan_calc set icici_name='$full_name', icici_mobile='$mobile', icici_email='$email', Reference_Code='$Reference_Code', AppID ='$app_code'  Where icici_clid=".$userid;
//$result = ExecQuery($icici_clquery);

$DataArray = array("icici_name"=>$full_name, "icici_mobile"=>$mobile, "icici_email"=>$email, "Reference_Code"=>$Reference_Code, "AppID"=>$app_code);
$wherecondition ="icici_clid=".$userid;
Mainupdatefunc ('icici_car_loan_calc', $DataArray, $wherecondition);

//echo $icici_clquery;
			
			}
}

$dataSql = "select * from icici_car_loan_calc where icici_clid = ".$userid."";
list($recordcount,$getrow)=MainselectfuncNew($dataSql,$array = array());
$cntr=0;
//$dataQuery = ExecQuery($dataSql);
$company_name = $getrow[$cntr]['icici_company_name'];
$icici_city = $getrow[$cntr]['icici_city'];
$icici_eligible_loanamt = $getrow[$cntr]['icici_eligible_loanamt'];
$icici_eligible_interestrate = $getrow[$cntr]['icici_eligible_interestrate'];
$icici_eligible_emi = $getrow[$cntr]['icici_eligible_emi'];
$icici_eligible_tenure = $getrow[$cntr]['icici_eligible_tenure'];

?>
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>ICICI Bank Car Loan</title>
<link href="icici_car/style.css" rel="stylesheet" type="text/css">
<script language="javascript" type="text/javascript" src="icici_car/Functions.js"></script>
<script src="icici_car/AC_ActiveX.js" type="text/javascript"></script>
<script src="icici_car/AC_RunActiveContent.js" type="text/javascript"></script>
<script language="javascript" src="icici_car/Functions_002.js"></script>
<script type="text/javascript" src="scripts/common.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<script language="javascript" src="icici_car/FormCheck.js"></script>
<script src="icici_car/Default.htm" type="text/javascript"></script>
<link type='text/css' href='css/contact.css' rel='stylesheet' media='screen' />

<script>
function validmail(email1) 
{
	invalidChars = " /:,;";
	if (email1 == "")
	{// cannot be empty
		alert("Invalid E-mail ID.");
		return false;	
	}
	for (i=0; i<invalidChars.length; i++) 
	{	// does it contain any invalid characters?
		badChar = invalidChars.charAt(i);
		if (email1.indexOf(badChar,0) > -1) 
		{
			return false;
		}
	}
	atPos = email1.indexOf("@",1)// there must be one "@" symbol
	if (atPos == -1) 
	{
		alert("Invalid E-mail ID.");
		return false;
	}
	if (email1.indexOf("@",atPos+1) != -1) 
	{	// and only one "@" symbol
		alert("Invalid E-mail ID.");
		return false;
	}
	periodPos = email1.indexOf(".",atPos)
	if (periodPos == -1) 
	{// and at least one "." after the "@"
		alert("Invalid E-mail ID.");
		return false;
	}
	//alert(periodPos);
	//alert(email.length);
	if (periodPos+3 > email1.length)	
	{		// must be at least 2 characters after the "."
		alert("Invalid E-mail ID.");
		return false;
		
	}
	return true;
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

	if(Form.residence_address.value=="")
	{
		alert("Kindly fill in your Residence Address!");
		Form.residence_address.focus();
		return false;
	}
	if((Form.Pincode.value=='PinCode') || (Form.Pincode.value=='') || Trim(Form.Pincode.value)==false)
{
alert("Kindly fill in your Pincode!");
Form.Pincode.focus();
return false;
}
else if(Form.Pincode.value.length < 6)
{
alert("Kindly fill in your Pincode(6 Digits)!");
Form.Pincode.focus();
return false;
}
else if(containsalph(Form.Pincode.value)==true)
{
alert("Kindly fill in your Correct Pincode (Numeric Only)!");
Form.Pincode.focus();
return false;
}

if(Form.office_std.value=="" || Form.office_std.value=="Std")

	{

		alert("Kindly fill in your Office Std Code!");

		Form.office_std.focus();

		return false;

	}

	if(Form.office_phone.value=="" || Form.office_phone.value=="Number")

	{

		alert("Kindly fill in your Office Number!");

		Form.office_phone.focus();

		return false;

	}
	if(Form.office_ext.value=="" || Form.office_ext.value=="Extn")

	{

		alert("Kindly fill in your Office Ext. If there is no Ext , kindly put 0!");

		Form.office_ext.focus();

		return false;

	}
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
		alert("Please enter valid pan number.");
		Form.Pancard.focus();
		return false;
	}
	
	if ( ( Form.Defaulted[0].checked == false ) && ( Form.Defaulted[1].checked == false ) )
	{
	  alert ( "Please choose defaulted on any loan or credit card" ); 
	  return false; 
	}
	
	if ( ( Form.declined[0].checked == false ) && ( Form.declined[1].checked == false ) )
	{
	  alert ( "Please choose loan application declined in last month?" ); 
	  return false; 
	}
	


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
</script>
<style>
		.black_overlay{
			display: none;
			position: absolute;
			top: 0%;
			left: 0%;
			width: 100%;
			height: 100%;
			background-color: black;
			z-index:1001;
			-moz-opacity: 0.8;
			opacity:.80;
			filter: alpha(opacity=80);
		}
		.white_content {
			display: none;
			position: absolute;
			top: 25%;
			left: 25%;
			width: 50%;
			height: 50%;
			padding: 16px;
			border: 16px solid orange;
			background-color: white;
			z-index:1002;
			overflow: auto;
		}
		.frmtxt{	font-family:Verdana, Arial, Helvetica, sans-serif;	font-size:12px;	font-weight:bold;	color:#332d33;}
		.frmtxt1{	font-family:Verdana, Arial, Helvetica, sans-serif;	font-size:12px;	color:#332d33;}
	</style>

  <script>

var ajaxRequest;  // The variable that makes Ajax possible!

		function ajaxFunction(){

			try{

				// Opera 8.0+, Firefox, Safari

				ajaxRequest = new XMLHttpRequest();

			} catch (e){

				// Internet Explorer Browsers

				try{

					ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");

				} catch (e) {

					try{

						ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");

					} catch (e){

						// Something went wrong

						alert("Your browser broke!");

						return false;

					}

				}

			}

		}

	window.onload = ajaxFunction;

</script>

<script language="javascript">

function verification()
{
//alert("gfdfg");
		var get_RequestID = document.ccform.RequestID.value;
			//var get_full_name = document.getElementById('full_name').value;
					
			var get_Phone = document.ccform.Phone.value;
			//var get_mobile_no = document.getElementById('mobile_no').value;
			
			var get_id = document.ccform.verify_code.value;
			//var get_id = document.getElementById('Activate').value;

				var queryString = "?get_Mobile=" + get_Phone +"&get_RequestID=" + get_RequestID +"&get_id=" + get_id ;
	//		alert(queryString); 
				ajaxRequest.open("GET", "verifyMobile.php" + queryString, true);
				// Create a function that will receive data sent from the server
				ajaxRequest.onreadystatechange = function(){
					if(ajaxRequest.readyState == 4)
					{
					   var ajaxDisplay = document.getElementById('displayVerify');
					   ajaxDisplay.innerHTML = ajaxRequest.responseText;
					}
				}

				ajaxRequest.send(null); 
		

	}

 function rqtcllbck()
{
		var ni = document.getElementById('rqt_cllbck');
		ni.innerHTML = 'Thanks We Will Contact You Shortly';

}

</script>

</head><body>

<table align="center" border="0" cellpadding="0" cellspacing="0" width="886">
  <tbody><tr>
    <td background="icici_car/main_bg.gif"><table align="center" border="0" cellpadding="0" cellspacing="0" width="872">
      <tbody><tr>
        <td>
			<table>
				<tr>
					<td><img src="icici_car/small_top_logo.gif" height="104" width="285"></td>
					<td valign="bottom">
						<table width="575" bgcolor="#EFEFE0" height="94" cellpadding="0" cellspacing="0" style="border:#000000 solid 1px;">
						<tr><td colspan="4" bgcolor="#CC541F" align="center" class="verdred13" style="color:#FFFFFF; border-bottom:#D2CECC solid 1px; ">ICICI Bank Car Loan Quote</td></tr>
						<tr><td width="173" align="center" class="frmtxt" style="color:#CC541F; border-right:#D2CECC solid 1px; border-bottom:#D2CECC solid 1px; font-size:13px;" bgcolor="#EFEFE0">Max Loan Amount</td>
						<td width="184" align="center" class="frmtxt" style="color:#CC541F; border-right:#D2CECC solid 1px; border-bottom:#D2CECC solid 1px; font-size:13px;" bgcolor="#EFEFE0">Interest Rate</td>
						<td width="129" align="center" class="frmtxt" style="color:#CC541F; border-right:#D2CECC solid 1px; border-bottom:#D2CECC solid 1px; font-size:13px;" bgcolor="#EFEFE0">Per Month EMI</td>
						<td width="87" align="center" class="frmtxt" style="color:#CC541F; border-bottom:#D2CECC solid 1px; font-size:13px;" bgcolor="#EFEFE0">Tenure</td>
						</tr>
						<tr>
						  <td style="border-right:#D2CECC solid 1px; font-weight:normal;" align="center" class="frmtxt"><? echo $icici_eligible_loanamt; ?></td>
						  <td style=" border-right:#D2CECC solid 1px; font-weight:normal;" align="center" class="frmtxt"><? echo $icici_eligible_interestrate; ?>&nbsp;<br><span style="font-size:9px;">(Monthly Reducing)</span></td><td style="color:#000000; border-right:#D2CECC solid 1px; font-weight:normal;" align="center"class="frmtxt"><? echo $icici_eligible_emi; ?></td><td style="font-weight:normal;" align="center" class="frmtxt"><? echo $icici_eligible_tenure; ?>&nbsp;<span style="font-size:9px;">(months)</span></td></tr>
					  </table></td></tr></table>
		</td>
      </tr>
     
      
      <tr>
        <td><img src="icici_car/body_top.gif" height="10" width="872"></td>

      </tr>
      <tr>
        <td background="icici_car/body_bg.gif"><table align="center" border="0" cellpadding="0" cellspacing="0" width="96%">
          <tbody><tr>
           
            <td width="817" valign="top"><table border="0" cellpadding="0" cellspacing="0" width="837" align="center">
              <tr>
                <td height="30" ><table width="100%"><tr><td height="30" align="center" class="verdred13" width="81%">ICICI Car Loan Application</td>
                <td width="19%" height="30" align="center" class="verdred13"> <div id="rqt_cllbck" style="font-size:10px; color:#3333FF;"><a style="text-decoration:underline; cursor:pointer;" onClick="rqtcllbck();">Request a Call Back</a></div></td>
                </tr></table></td>
              </tr>
              <tr>
			 			 
			               <td width="837" height="286" valign="top" background="icici_car/bbg.jpg" align="center">
				<form action="icici-carloanthanks.php"  method="post" name="ccform"  onSubmit="return submitform(document.ccform);"  enctype="multipart/form-data" >
                <input type="hidden" name="RequestID" value="<?php echo $userid ; ?>" />
								<input style="width:180px; height:21px;" type="hidden" name="company_name2" id="company_name2" value="<?php echo $company_name; ?>" readonly />
			
				<table width="95%"  border="0" align="center" cellpadding="4" cellspacing="4">
  <tr align="center">
    <td height="11" colspan="4"></td>
  </tr>
  <tr>
	<td width="149" height="26" align="left" class="frmtxt">First Name <span style="font-weight:normal; color:#FF0000; font-size:9;">*</span></td>

	<td width="200" align="left" class="frmtxt"><input style="width:150px;  height:21px;"  name="Name" id="Name" value="<?php echo $firstn; ?>" ></td>
	<td width="108" align="left" valign="top" class="frmtxt">Last Name <span style="font-weight:normal; color:#FF0000; font-size:9;">*</span></td>

	<td width="161" align="left" class="frmtxt1" ><input style="width:150px;  height:21px;"  name="l_Name" id="l_Name" value="<?php echo $lastn; ?>" ></td>
  </tr>
  
   <tr>
	<td height="26" align="left" class="frmtxt">Email <span style="font-weight:normal; color:#FF0000; font-size:9;">*</span></td>
	<td height="26" align="left" class="frmtxt"><input  style="width:150px;  height:21px;"   name="Email" id="Email" value="<?php echo $email; ?>" readonly  /></td>
	<td width="108" align="left" valign="top" class="frmtxt"><span class="frmtxt">Mobile No. </span> </td>

	<td width="161" align="left" class="frmtxt1" ><input   name="Phone" id="Phone" value="<?php echo $mobile; ?>"  type="hidden" >+91 <?php echo $mobile; ?><span id="displayVerify"><input type="text" name="verify_code" maxlength="4" style="width:35px;" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" /> <!--<a href="#" onClick="return verification();" style="font-size:10px; font-family:Verdana, Arial, Helvetica, sans-serif; text-decoration:none;">--><input type="button" value="Verify" name="verify" onClick="return verification();"><!--</a>--><div style="font-weight:normal; color:#FF0000; font-size:10px; text-align:left">Enter Verification code to validate  mobile.</div></span></td>
	
   </tr>
     <tr><td height="26" align="left" class="frmtxt">City <span style="font-weight:normal; color:#FF0000; font-size:9;">*</span></td>
	<td height="26" align="left" class="frmtxt"><input  style="width:150px;  height:21px;"   name="City" id="City" value="<?php echo $icici_city; ?>"  readonly  /></td><td colspan="2"></td>
	</tr> 
 <tr>
	<td height="26" align="left" valign="top" class="frmtxt">Resi Address Line 1 <span style="font-weight:normal; color:#FF0000; font-size:9;">*</span></td>
	<td height="26" align="left" class="frmtxt"><input type="text" name="residence_address" id="residence_address" style="width:150px;  height:21px;" ></td>
	<td align="left" valign="top" class="frmtxt">Resi Address Line 2</td>
	<td align="left"><span class="frmtxt" style="font-weight:normal; "><input type="text" name="office_address" id="office_address" style="width:150px;  height:21px;" >
    </span></td>
  </tr> 
   <tr>
	<td height="26" align="left" class="frmtxt">Pincode <span style="font-weight:normal; color:#FF0000; font-size:9;">*</span></td>
	<td height="26" align="left" class="frmtxt"><input  style="width:150px;  height:21px;" maxlength="6"  name="Pincode" id="Pincode" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" /></td>
	<td height="26" align="left" class="frmtxt">Resi Telephone</td>
	<td height="26" align="left" class="frmtxt"><input style="width:40px;  height:21px;" name="home_std" id="home_std" value="Std" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);"/> <input style="width:100px;  height:21px;" name="home_phone" id="home_phone" value="Number" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);"/></td>
   </tr>
  
  <tr>
	<td align="center" valign="top" colspan="4" >----------------------------------------------------------------------------------------------------------------</td>
  </tr>
   <tr><td align="left" valign="top" class="frmtxt">Employer  <span style="font-weight:normal; color:#FF0000; font-size:9;">*</span></td>
	 <td align="left" class="frmtxt"><input style="width:150px; height:21px;"  name="company_name" id="company_name" value="<?php echo $company_name; ?>" readonly /></td>
	 <td align="left" valign="top" class="frmtxt">Designation</td>
	<td align="left" class="frmtxt"><input style="width:150px; height:21px;"  name="Designation" id="Designation" /></td>
</tr>
   <tr><td align="left" valign="top" class="frmtxt">Office Telephone  <span style="font-weight:normal; color:#FF0000; font-size:9;">*</span></td>
	<td align="left" class="frmtxt"><input style="width:40px; height:21px;" value="Std" name="office_std" id="office_std" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);"/> <input style="width:60px; height:21px;" value="Number" name="office_phone" id="office_phone" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);"/> <input style="width:40px; height:21px;" value="Extn" name="office_ext" id="office_ext" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);"/></td>
	<td align="left" valign="top" class="frmtxt">Pancard <span style="font-weight:normal; color:#FF0000; font-size:9;">*</span></td>
<td align="left" class="frmtxt"><input style="width:150px; height:21px;"  name="Pancard" id="Pancard" maxlength="10" /></td>
	</tr>
	
   <tr>
	<td align="center" valign="top" colspan="4" >-------------------------------------------------------------------------------------------------------------</td>
  </tr>
  <tr>
	<td height="26" align="left" class="frmtxt" colspan="2">Ever defaulted on any loan or credit card? <span style="font-weight:normal; color:#FF0000; font-size:9;">*</span></td>
	<td height="26" align="left" class="frmtxt" colspan="2"><input type="radio" name="Defaulted" id="Defaulted" value="true" >Yes
<input type="radio" name="Defaulted" id="Defaulted" value="false" />No</td>

   </tr>
   
         <tr>
	<td height="26" align="left" class="frmtxt" colspan="2">Had loan application declined in last month? <span style="font-weight:normal; color:#FF0000; font-size:9;">*</span></td>
	<td height="26" align="left" class="frmtxt" colspan="2"><input type="radio" name="declined" id="declined" value="true" >Yes
<input type="radio" name="declined" id="declined" value="false" />No</td>

	 </tr>
	 <tr>
	<td align="center" valign="top" colspan="4" >&nbsp;</td>
  </tr>
<tr>
	<td height="26" align="left" valign="top" class="frmtxt" colspan="4">Select one document in each section below that you will provide as proof</td>
  </tr>
  
  <tr>
	<td height="26" align="left" valign="top" class="frmtxt">Proof of Income</td>
	<td ><select name="Income_Proof" id="Income_Proof"style="width:200px;" >
    <option value=""
    >Select</option>
    <option value="Latest ITR">Latest ITR</option>
    <option value="Form 16">Form 16</option>
    <option value="Salary ceritificate for last 3 months">Salary ceritificate for last 3 months</option>
    <option value="Pay slip - last 3 months">Pay slip - last 3 months</option>


</select>
</td>
<td colspan="2" align="left" valign="top">&nbsp;</td>
  </tr>
  <tr>
	<td height="26" align="left" valign="top" class="frmtxt">Proof of Address</td>
    <td>
    <select name="Address_Proof" id="Address_Proof" style="width:200px;">
    <option value="">Select</option>
    <option value="Ration Card">Ration Card</option>
    <option value="Telephone, electricity, water or gas bill less than 2 months old (incl downloaded)">Telephone, electricity, water or gas bill less than 2 months old (incl downloaded)</option>
    <option value="Latest Life Insurance policy premium receipts (paid)">Latest Life Insurance policy premium receipts (paid)</option>

    <option value="Post-paid mobile phone bill in your name">Post-paid mobile phone bill in your name</option>
    <option value="Letter from Employer certifying current mailing address">Letter from Employer certifying current mailing address</option>
    <option value="Passport">Passport</option>
    <option value="Election ID card">Election ID card</option>
    <option value="Registered Rental / Lease Agreement">Registered Rental / Lease Agreement</option>
    <option value="Property Registration documents/Ownership proof copy">Property Registration documents/Ownership proof copy</option>

    <option value="Passbook">Passbook</option>
    <option value="Bank statement (last 3 months)">Bank statement (last 3 months)</option>
    <option value="Driving License">Driving License</option>
    <option value="Loan repayment track record">Loan repayment track record</option>
    <option value=" Registration certificate (RC) of 4-wheeler in applicant's name"> Registration certificate (RC) of 4-wheeler in applicant's name</option>
</select></td>
<td colspan="2" align="left" valign="top">&nbsp;</td>
  </tr>
   <tr>
	<td height="26" align="left" valign="top" class="frmtxt">Proof of Identity</td><td ><select name="Identity_Proof" id="Identity_Proof"  style="width:200px;">
    <option value=""
    >Select</option>
    <option value="Passport">Passport</option>
    <option value="Election ID card">Election ID card</option>
    <option value="Driving License">Driving License</option>
    <option value="Photo Credit/Debit/ATM Card">Photo Credit/Debit/ATM Card</option>
    <option value="Government organisation ID card with signature and photo">Government organisation ID card with signature and photo</option>

    <option value="PAN Card">PAN Card</option>
    <option value="Company ID card">Company ID card</option>
    <option value="Insurance / Mediclaim Photo Card">Insurance / Mediclaim Photo Card</option>
    <option value="Ration Card">Ration Card</option>
    <option value="Home property papers (registered deed">Home property papers (registered deed</option>
    <option value="Registration certificate (RC) of vehicle in applicant's name">Registration certificate (RC) of vehicle in applicant's name</option>


</select></td>
<td colspan="2" align="left" valign="top">&nbsp;</td>
  </tr>
   <tr>
	<td height="26" align="left" valign="top" class="frmtxt">Bank Statement</td><td ><select name="Bank_Statement" id="Bank_Statement"  style="width:200px;" >
    <option value="">Select</option>
    <option value="Salary account bank statement - last 6 months">Salary account bank statement - last 6 months</option>
</select>
</td>
<td colspan="2" align="left" valign="top">&nbsp;</td>
  </tr> 

  <tr valign="bottom">

    <td height="40" colspan="4" align="center">
    

    <input name="submit" type="submit" class="btnclr" value="Submit" /></td>
    </tr>

  <tr valign="bottom">

    <td colspan="4" align="center">&nbsp;</td>
  </tr>
</table>
				</form>
				
				</td>
              </tr>
              <tr>
                <td colspan="2">&nbsp;</td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><img src="icici_car/body_btm.gif" height="10" width="872"></td>
      </tr>
      <tr>
        <td height="35"><table align="center" border="0" cellpadding="0" cellspacing="0" width="98%">
          <tbody><tr>
            <td class="disclaimer" height="10"></td>
          </tr>
           <tr>
             <td class="cnbc" height="103" valign="bottom" width="850"><table border="0" cellpadding="0" cellspacing="6" width="100%">
               <tbody>
                 <tr>
                   <td width="500">&nbsp;</td>
                   <td class="cnbc_link">www.consumerawards.moneycontrol.com/categories.php</td>
                 </tr>
               </tbody>
             </table></td>
           </tr>
          <tr>
            <td class="disclaimer"><a href="javascript:void(0);" onClick="javascript:showHideDiv(0);" class="disclaimer"><b><u>Disclaimer</u></b></a></td>
          </tr>
          <tr>
            <td class="disclaimer">&nbsp;</td>
          </tr>
        </tbody></table></td>
      </tr>
    </tbody></table></td>
  </tr>
</tbody></table>

<div id="disclaimer" class="disclaimerdiv">
<table border="0" cellpadding="0" cellspacing="0" width="100%">
  <tbody><tr>
    <td align="left" height="10" valign="top" width="1%"><img src="icici_car/tl.png" height="10" width="10"></td>
    <td align="left" background="icici_car/b.png" valign="top" width="98%"></td>
    <td align="right" height="10" valign="top" width="1%"><img src="icici_car/tr.png" height="10" width="10"></td>
  </tr>
  <tr>
    <td align="left" background="icici_car/b.png" valign="top">&nbsp;</td>
    <td align="center" bgcolor="#ffffff" valign="top"><table bgcolor="#ffffff" border="0" cellpadding="10" cellspacing="0" width="100%">
  <tbody><tr>
    <td class="disctxt" align="left" valign="top"><b><u>Disclaimer</u></b>:<br>
          The information provided herein is on the website of  
Communicate 2 at http://www.loanforcar.in/,  which is neither owned, 
controlled nor endorsed by ICICI Bank. The use of this information is 
subject to the terms and conditions governing such products, services 
and offers as specified by ICICI Bank at www.icicibank.com; and third 
party from time to time. All Loans are offered at the sole discretion of
 ICICI Bank, subject to submission of documentation and fulfillment of 
such requisites to the sole and absolute satisfaction of ICICI Bank. 
Associated benefits / features / interest rates / applicable fees and 
charges / application process mentioned herein are as on date and may be
 subject to change/ modification from time to time. Eligibility criteria
 and Documentation are indicative and not exhaustive. Nothing contained 
herein shall constitute
or be deemed to constitute an advice, invitation or solicitation to 
purchase any products or services of ICICI Bank or such other third 
party. ICICI Bank does not accept any responsibility for the details, 
accuracy, completeness or correct sequence of any content or information
 provided on the website of the third party; and/ or any errors whether 
caused by negligence or otherwise; and/ or for any loss or damage 
incurred by anyone in reliance on anything set out herein. "ICICI Bank" 
and "I-man" logos are trademark and property of ICICI Bank Ltd. Misuse 
of any intellectual property, or any other content displayed herein is 
strictly prohibited.<br>
          <br>
          <b>EMI Calculator</b><br>This application ("the 
"Application") is for your personal information, education and 
communication of an estimation of equated monthly installment ("EMI") 
and expected changes in it as well as tenure in case of floating rate of
 interest, and is not an offer; invitation or solicitation of any kind 
to avail the facility is not intended to create any rights or 
obligations. Please note that the equated monthly installment ("EMI") 
calculated through this calculator is rounded off to the nearest upper 
integer. Further, the EMI calculated is indicative based solely on the 
data fed by you on the screen and does not envisage any changes that 
might occur due to any discounts, schemes or other promotional 
activities introduced by ICICI Bank from time to time through its own 
channel or in association with a third party.
<p>No reliance may be placed for any purpose whatsoever on the 
information contained in this presentation or on its completeness. The 
information set out herein may be subject to updating, completion, 
revision, verification and amendment and such information may change 
materially. Such information is provided only for the convenience of the
 customers and ICICI Bank does not undertake any liability or 
responsibility for the details, accuracy, completeness or correct 
sequence of any content or information provided through the application.</p>
          <p>The intellectual property in respect of the Application 
belongs to ICICI Bank and any form of reproduction, dissemination, 
copying, disclosure, modification, and/or publication of this document 
is strictly prohibited. The contents of this document are solely meant 
to provide information and ICICI Bank is not representing or giving you 
any assurance that your expectations, objectives, needs and wishes will 
be met with the facility availed and ICICI Bank disclaims all 
responsibility and accepts no liability for the consequences of any 
person acting, or refraining from acting, on such information. ICICI 
Bank Group or any of its officers, employees, personnel, directors shall
 not be liable for any loss, damage, liability whatsoever for any direct
 or indirect loss arising from the use or access of any information that
 may be displayed in through this Application.</p>
          The information provided hereinabove is for information 
purposes only and is subject to Terms and Conditions which are uploaded 
on www.icicibank.com and all applicable laws. By accessing and browsing 
the Application, you accept, without limitation or qualification, the 
Terms and Conditions and acknowledge that any other agreement between 
you and ICICI Bank are superseded and of no force or effect.
          <div align="right"><img src="icici_car/closelabel.gif" onClick="javascript:showHideDiv(1);" style="cursor: pointer;"></div>          </td>
  </tr>
</tbody></table></td>
    <td align="right" background="icici_car/b.png" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" valign="bottom"><img src="icici_car/bl.png" height="10" width="10"></td>
    <td align="left" background="icici_car/b.png" valign="top"></td>
    <td align="right" valign="bottom"><img src="icici_car/br.png" height="10" width="10"></td>
  </tr>
</tbody></table>
</div>
<!--</form>-->

</body></html>