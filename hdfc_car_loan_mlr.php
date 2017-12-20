<? 
include "scripts/db_init.php";
include "scripts/functions.php";
function DetermineAgeFromDOB ($YYYYMMDD_In)
{	  $yIn=substr($YYYYMMDD_In, 0, 4);	  $mIn=substr($YYYYMMDD_In, 4, 2);	  $dIn=substr($YYYYMMDD_In, 6, 2);	  $ddiff = date("d") - $dIn;	  $mdiff = date("m") - $mIn;	  $ydiff = date("Y") - $yIn;	  if ($mdiff < 0)	  {		$ydiff--;	  } elseif ($mdiff==0)	  {		if ($ddiff < 0)		{		  $ydiff--;		}	  }	  return $ydiff;	}

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$full_name = $_POST['full_name'];
	$City = $_POST['City'];
	$email_id = $_POST['email_id'];
	$mobile_no = $_POST['mobile_no'];
	$std_code = $_POST['std_code'];
	$resi_no = $_POST['resi_no'];
	$std_code_o = $_POST['std_code_o'];
	$office_no = $_POST['office_no'];
	$residence_number=  $std_code."-".$resi_no; 
	$office_number=  $std_code_o."-".$office_no;
	$net_salary = $_POST['net_salary'];
	$company_name = $_POST['company_name'];
	$Employment_Status = $_POST['Employment_Status'];
	$Car_Type = $_POST['Car_Type'];
	$dd = $_POST['dd'];
	$mm = $_POST['mm'];
	$yyyy = $_POST['yyyy'];
	$dob= $yyyy."-".$mm."-".$dd;
	$reqDOB = $yyyy."".$mm."".$dd;
	$age=DetermineAgeFromDOB($reqDOB);

	$maxbupa_name = $full_name." ".$last_name;
	$validMobile = is_numeric($mobile_no);
	if((strlen($full_name) >0 && $full_name!="Full Name") && ($validMobile==1) && strlen($mobile_no)>9 && strlen($City)>0)
	{

		$getsel="select hdfc_mobileno From hdfc_car_loan Where hdfc_mobileno=".$mobile_no;
	 	list($getselrecordcount,$myrow)=MainselectfuncNew($getsel,$array = array());
		if($getselrecordcount>0)
		{
		}
		else
		{
			$Dated = ExactServerdate();
			$data = array('hdfc_name'=>$full_name, 'hdfc_email'=>$email_id, 'hdfc_city'=>$City, 'hdfc_mobileno'=>$mobile_no, 'hdfc_employer'=>$company_name, 'hdfc_income'=>$net_salary, 'hdfc_office_landline'=>$office_number, 'hdfc_resi_landline'=>$residence_number, "hdfc_source"=>'hdfccl-mailer', 'hdfc_dated'=>$Dated, 'hdfc_dob'=>$dob,'hdfc_car_type'=>$Car_Type, 'hdfc_emp_status'=>$Employment_Status);
			$insert = Maininsertfunc ($hdfc_car_loan, $data);
	//		echo "<br>";
		//	echo $getdetails;
			//echo "<br>";
		
			if($net_salary>=200000 && (($Employment_Status==1 && $age>21) || ($Employment_Status==0 && $age>25)) && (($Car_Type==1) || ($Car_Type==0 && ($City!='Kolkata' && $City!='Kanpur' && $City!='agra' && $City!='jodhpur' && $City!='kota' && $City!='udaipur'))))
			{
				//get bidderid
				$selbidder= "select BidderID From Bidders_List Where (City like '%".$City."%' and BidderID in (1825))";
				list($recordcount,$selbidderrow)=MainselectfuncNew($selbidder,$array = array());
				$selbidderrowcontr=count($selbidderrow)-1;
				$BidderID = $selbidderrow[$selbidderrowcontr]["BidderID"];
				
				if($recordcount>0)
				{
					$Dated = ExactServerdate();
					$data = array('Name'=>$full_name, 'Email'=>$email_id, 'Mobile_Number'=>$mobile_no, 'City'=>$City, 'Company_Name'=>$company_name, 'Net_Salary'=>$net_salary, 'Std_Code'=>$std_code, 'Landline'=>$resi_no, 'Std_Code_O'=>$std_code_o, 'Landline_O'=>$office_no, 'Descr'=>'hdfc', 'source'=>'hdfccl-mailer', 'Dated'=>$Dated, 'Updated_Date'=>$Dated, 'Allocated'=>'1', 'Bidderid_Details'=>$BidderID, 'Employment_Status'=>$Employment_Status, 'DOB'=>$dob, '	Bidder_Count'=>'1', 'Is_Valid'=>'1', 'Car_Type'=>$Car_Type);	
					$ProductValue = Maininsertfunc ('Req_Loan_Car', $data);
				
	//		echo $getbddetails."<br>";
					if($ProductValue>0)
					{
						$Dated = ExactServerdate();
						$dataBidder  = array('AllRequestID'=>$ProductValue, 'BidderID'=>$BidderID, 'Reply_Type'=>'3', 'Allocation_Date'=>$Dated);
						Maininsertfunc ('Req_Feedback_Bidder1', $dataBidder);
					}
				}
			}
			if(strlen($email_id)>0)
			{
				$SubjectLine = "Thanks for Registering for HDFC Bank Car Loan on deal4loans.com";
				$Message2="<table width='560' align='center' cellpadding='0' cellspacing='0' style='border:1px solid #333399;'>  <tr>    <td width='560' align='center' valign='top'><img src='http://www.deal4loans.com/emailer/images/hdfc_d4l_logo.gif'  /></td>
				</tr>  <tr>    <td><table width='560' border='0' align='center' cellpadding='0' cellspacing='0'>
				<tr>
				<td width='1' ><img src='http://www.deal4loans.com/images/spacer.gif' width='1'  height='1' border='0' /></td>
				<td><table width='98%' border='0' align='center' cellpadding='0' cellspacing='0'>
				<tr><td>&nbsp;</td></tr>
				<tr>
				<td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '><p><b>Dear Deal4loans Customer</b>,<br />
				Thanks for Registering for HDFC Bank Car Loan.  
				Bank representative will contact you shortly.<BR>The details that have been provided to the HDFC Bank are listed below:<br>
				<br />              
				Your Name: $full_name<br />
				Location: $City<br />
				Income/Salary: $net_salary<br />
				Contact : $mobile_no<br />
				<br />Warm Regards<br />&nbsp;<br />
				</p></td></tr>
				</table></td></tr></table>
				</td></tr></table>";
				
				$headers  = 'From: HDFC Car Loan <no-reply@deal4loans.com>' . "\r\n";
				$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				mail($email_id, $SubjectLine, $Message2, $headers);
			}
		}
		
	}
	else
	{
//		$PostURL = "http://www.deal4loans.com/hdfc_credit_card_mlr.php";
//		header("Location: $PostURL");
	//	exit();
		/*echo "<script language=javascript>alert('Kindly fill the correct details.');"." location.href='http://www.deal4loans.com/hdfc_credit_card_mlr.php'"."</script>";*/
	}
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<? if((strlen($full_name) >0 && $full_name!="Full Name") && ($validMobile==1) && strlen($mobile_no)>9 && strlen($City)>0 && ($_SERVER['REQUEST_METHOD'] == 'POST'))

	{ ?>
<html>
<head>
<title>HDFC BANK</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" type="text/css" href="LoanThankYou_files/ri.htm">
<link rel="stylesheet" type="text/css" href="LoanThankYou_files/hdfc.htm">
<script src="LoanThankYou_files/header.js"></script>
<script language="JavaScript">
if(navigator.appName == "Netscape")
{
 document.write('<LINK REL="STYLESHEET" HREF="/webforms/css/NEcss_sheet.css" TYPE="text/css">');
}
else
{
 document.write('<LINK REL="STYLESHEET" HREF="/webforms/css/IEcss_sheet1.css" TYPE="text/css">');
}
</script>
<link rel="STYLESHEET" href="LoanThankYou_files/NEcss_sheet.htm" type="text/css">
</head>
<body leftmargin="0" topmargin="0" bgcolor="#ffffff" marginheight="0" marginwidth="0" text="#000000">
<table border="0" cellpadding="0" cellspacing="0" width="100%">
  <tbody>
    <tr>
      <td valign="top">
        <table border="0" cellpadding="0" cellspacing="0" width="100%">
          <tbody>
            <tr>
              <td height="55"><img src="https://leads.hdfcbank.com/common/images/hdfc_logo.gif" alt="HDFC Bank" border="0" height="31" hspace="12" width="192"></td>
            </tr>
            <tr>
              <td bgcolor="#17266d" valign="top"><img src="LoanThankYou_files/1ptrans.gif" alt="" height="6" width="2"></td>
            </tr>
            <tr>
              <td valign="top"><img src="LoanThankYou_files/1ptrans.gif" alt="" height="1" width="2"></td>
            </tr>
            <tr>
              <td class="toolbox_shdw" valign="top"><img src="LoanThankYou_files/1ptrans.gif" alt="" height="10" width="2"></td>
            </tr>
          </tbody>
        </table></td>
    </tr>
  </tbody>
</table>
<table border="0" cellpadding="0" cellspacing="0" width="779">
  <tbody>
    <tr align="left" valign="top">
      <td colspan="3" height="16"><table border="0" cellpadding="0" cellspacing="0" width="100%">
          <tbody>
            <tr align="left" valign="top">
              <td colspan="4" height="5"><img src="LoanThankYou_files/white-spacer.htm" height="4" width="4"></td>
            </tr>
            <tr align="left" valign="top">
              <td colspan="4" height="5"><img src="LoanThankYou_files/white-spacer.htm" height="4" width="4"></td>
            </tr>
          </tbody>
        </table></td>
    </tr>
    <tr align="left" valign="top">
      <td colspan="3" align="left"><table border="0" cellpadding="0" cellspacing="0" width="100%">
          <tbody>
            <tr align="left" valign="top">
              <td background="https://leads.hdfcbank.com/images/lefttable_back.jpg" width="5%">&nbsp;</td>
              <td colspan="2" height="360" width="95%"><table class="body" border="0" cellpadding="0" cellspacing="0" width="100%">
                  <tbody>
                    <tr>
                      <td colspan="3"><table border="0" cellpadding="0" cellspacing="0" width="100%">
                          <tbody>
                            <tr align="left" valign="top">
                              <td width="53%"><img src="https://leads.hdfcbank.com/common/images/customersupportboxwithgaylines.jpg" height="76" hspace="1" width="367"></td>
                              <td align="right" width="47%">&nbsp;</td>
                            </tr>
                            <tr>
                              <td colspan="2" align="right"></td>
                            </tr>
                            <tr align="left" valign="top">
                              <td colspan="2" align="center"><strong>Thank you</strong> for your application. <br>
                                Our representative will contact you shortly.</td>
                            </tr>
                       
                          </tbody>
                        </table></td>
                    </tr>
                  </tbody>
                </table></td>
            </tr>
          </tbody>
        </table></td>
    </tr>
  </tbody>
</table>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
  <tbody>
    <tr>
      <td height="2"></td>
    </tr>
    <tr>
      <td bgcolor="#9c9a9c" height="1"></td>
    </tr>
    <tr>
      <td><table align="center" cellpadding="0" cellspacing="0" width="98%">
          <tbody>
            <tr>
              <td class="lnk_breadcrumbs" width="30%"><font style="font-size: 11px;" face="verdana"><a href="http://www.hdfcbank.com/aboutus/terms_conditions/privacy.htm" style="text-decoration: none; color: rgb(0, 0, 0);">Privacy</a> | <a href="http://www.hdfcbank.com/aboutus/terms_conditions/security.htm" style="text-decoration: none; color: rgb(0, 0, 0);">Security</a> | <a href="http://www.hdfcbank.com/aboutus/terms_conditions/default.htm" style="text-decoration: none; color: rgb(0, 0, 0);">Terms &amp; Condition</a></font></td>
              <td align="right"><font style="font-size: 11px;" face="verdana">Â© 2005 HDFC Bank Ltd. All rights reserved.</font></td>
            </tr>
          </tbody>
        </table></td>
    </tr>
  </tbody>
</table>
</body>
</html>		
<?	}
	else
	{?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>HDFC BANK</title>
<Script Language="JavaScript">
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
	
	if (periodPos+3 > email1.length)	
	{		// must be at least 2 characters after the "."
		alert("Invalid E-mail ID.");
		return false;
		
	}
	return true;
}

function hdfcvalide(Form)
{
	var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";
	if((Form.full_name.value=="") || (Form.full_name.value=="Full Name")|| (Trim(Form.full_name.value))==false)
	{
		alert("Kindly fill in your First Name!");
		Form.full_name.focus();
		return false;
	}
	else if(containsdigit(Form.full_name.value)==true)
	{
		alert("First Name contains numbers!");
		Form.full_name.focus();
		return false;
	}
	for (var i = 0; i < Form.full_name.value.length; i++) {
	if (iChars.indexOf(Form.full_name.value.charAt(i)) != -1) {
		alert ("First Name has special characters.\n Please remove them and try again.");
		Form.full_name.focus();
		return false;
	}
	}
	if((Form.mobile_no.value=='Mobile No') || (Form.mobile_no.value=='') || Trim(Form.mobile_no.value)==false)
	{
		alert("Kindly fill in your Mobile Number!");
		Form.mobile_no.focus();
		return false;
	}
	else if(isNaN(Form.mobile_no.value)|| Form.mobile_no.value.indexOf(" ")!=-1)
	{
		alert("Enter numeric value in ");
		Form.mobile_no.focus();
		return false;  
	}
	else if (Form.mobile_no.value.length < 10 )
	{
		alert("Please Enter 10 Digits"); 
		Form.mobile_no.focus();
		return false;
	}
	else if ((Form.mobile_no.value.charAt(0)!="9") && (Form.mobile_no.value.charAt(0)!="8") && (Form.mobile_no.value.charAt(0)!="7"))
	{
		alert("The number should start only with 9 or 8 or 7");
		Form.mobile_no.focus();
		return false;
	}
	 if((Form.dd.value=='')||(Form.dd.value=="DD"))
	{
		alert("Kindly fill in your dd (Numeric Only)!");
		Form.dd.focus();
		return false;
	}
	else if(containsalph(Form.dd.value)==true)
	{
		alert("DD contains characters!");
		Form.dd.focus();
		return false;
	}
	 if((Form.mm.value=='')||(Form.mm.value=="MM"))
	{
		alert("Kindly fill in your MM (Numeric Only)!");
		Form.mm.focus();
		return false;
	}
	else if(containsalph(Form.mm.value)==true)
	{
		alert("MM contains characters!");
		Form.mm.focus();
		return false;
	}
	 if((Form.yyyy.value=='')||(Form.yyyy.value=="YYYY"))
	{
		alert("Kindly fill in your dd (Numeric Only)!");
		Form.yyyy.focus();
		return false;
	}
	else if(containsalph(Form.yyyy.value)==true)
	{
		alert("YYYY contains characters!");
		Form.yyyy.focus();
		return false;
	}
	
	 if (Form.Employment_Status.selectedIndex==0)
	{
		alert("Please enter Employment Status to Continue");
		Form.Employment_Status.focus();
		return false;
	}
	 if((Form.net_salary.value=='')||(Form.net_salary.value=="Annual Income"))
	{
		alert("Kindly fill in your Annual Income (Numeric Only)!");
		Form.net_salary.focus();
		return false;
	}
	else if(containsalph(Form.net_salary.value)==true)
	{
		alert("Annual Income contains characters!");
		Form.net_salary.focus();
		return false;
	}

	if(Form.email_id.value!="Email ID")
		{
		if (!validmail(Form.email_id.value))
		{
			//alert("Please enter your valid email address!");
			Form.email_id.focus();
			return false;
		}

	}
	if(Form.City.selectedIndex==0)
	{
		alert("Please select City ");
		Form.City.focus();
		return false;
	}
	if(Form.Car_Type.selectedIndex==0)
	{
		alert("Please select Car Type ");
		Form.Car_Type.focus();
		return false;
	}
	if(!Form.accept.checked)
	{
		alert("Please Authorize ");
		Form.accept.focus();
		return false;
	}
	
	if(Form.email_id.value!="Email ID")
		{
		if (!validmail(Form.email_id.value))
		{
			//alert("Please enter your valid email address!");
			Form.email_id.focus();
			return false;
		}

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

function Trim(strValue) {
	var j=strValue.length-1;i=0;
	while(strValue.charAt(i++)==' ');
	while(strValue.charAt(j--)==' ');
	return strValue.substr(--i,++j-i+1);
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
</script>
</head>
<body>
<table align="center" width="600" border="0" cellspacing="0" cellpadding="0" style="line-height:0px">
  <tr>
    <td><img src="http://www.hdfcbank.com/mailer/Jan12/Auto_Loan_12/images/hdfc_bank_logo.gif" alt=""></td>
  </tr>
  <tr>
    <td><img src="http://www.hdfcbank.com/mailer/Jan12/Auto_Loan_12/images/animated_header.gif" alt=""></td>
  </tr>
  <tr>
    <td bgcolor="#e9e9e9"><table width="600" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="55" valign="top">&nbsp;</td>
          <td width="495" valign="top"><table width="558" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="558" height="15"></td>
              </tr>
              <tr>
                <td style="font-family:Arial; font-size:12px; line-height:14px" width="558" >
                  <form name="hdfc_cc" method="post" onSubmit="return hdfcvalide(document.hdfc_cc);" action="hdfc_car_loan_mlr.php">
    <table  border="0" cellspacing="0" cellpadding="0" width="558">
        <tr>

          <td valign="top" width="558" ><table align="center" border="0" cellspacing="2" cellpadding="2" width="558">
              <tr>
                <td width="189" height="30" colspan="3" valign="top" style="color:#064a8b; font-family:Arial; font-size:16px; font-weight:bolder;" >Apply for Auto Loan</td>
              </tr>
             
              <tr>
                <td><input style="font-family:Arial; font-size:12px; color:#4b4b4b; border:solid #b1b4b7 1px; background:#f9fbff; width:162px; line-height:14px" type="text" name="full_name" value="Full Name" onBlur="onBlurDefault(this,'Full Name');"  onFocus="onFocusBlank(this,'Full Name');" maxlength="50" onKeyPress="return charonly(event)">
                </td>
                    <td width="179"><input style="font-family:Arial; font-size:12px; color:#4b4b4b; border:solid #b1b4b7 1px; background:#f9fbff; width:150px; line-height:14px" type="text" name="mobile_no" value="Mobile No" onBlur="onBlurDefault(this,'Mobile No');"  onFocus="onFocusBlank(this,'Mobile No');" maxlength="10" onKeyPress="return numbersonly(event)">
                </td>
                   <td width="182" style="font-family:Arial; font-size:12px; color:#4b4b4b; vertical-align:middle;">DOB 
                     <input style="font-family:Arial; font-size:12px; color:#4b4b4b; border:solid #b1b4b7 1px; background:#f9fbff; width:40px; line-height:14px" type="text" name="dd" value="DD" onFocus="if(this.value=='DD')this.value=''" onBlur="if(this.value=='')this.value='DD'" maxlength="2" onKeyPress="return numbersonly(event)">&nbsp;<input style="font-family:Arial; font-size:12px; color:#4b4b4b; border:solid #b1b4b7 1px; background:#f9fbff; width:38px; line-height:14px" type="text" name="mm" value="MM" onFocus="if(this.value=='MM')this.value=''" onBlur="if(this.value=='')this.value='MM'" maxlength="2" onKeyPress="return numbersonly(event)">
&nbsp;<input style="font-family:Arial; font-size:12px; color:#4b4b4b; border:solid #b1b4b7 1px; background:#f9fbff; width:50px; line-height:14px" type="text" name="yyyy" value="YYYY" onFocus="if(this.value=='YYYY')this.value=''" onBlur="if(this.value=='')this.value='YYYY'" maxlength="4" onKeyPress="return numbersonly(event)">
                </td>
              </tr>
              <tr>
                <td height="5" colspan="3"></td>
              </tr>
              <tr>
                <td><input style="font-family:Arial; font-size:12px; color:#4b4b4b; border:solid #b1b4b7 1px; background:#f9fbff; width:162px; line-height:14px" type="text" name="net_salary" value="Annual Income" onFocus="if(this.value=='Annual Income')this.value=''" onBlur="if(this.value=='')this.value='Annual Income'" maxlength="15" onKeyPress="return numbersonly(event)">
                </td>
                <td>
                <select name="Employment_Status" id="Employment_Status"  style="font-family:Arial; font-size:12px; color:#4b4b4b; border:solid #b1b4b7 1px; background:#f9fbff; width:150px; line-height:14px;" >
                           <option value="-1">Occupation</option>
                           <option value="1">Salaried</option>
                           <option value="0">Self Employment</option>
                     </select>
                </td>
                <td><input style="font-family:Arial; font-size:12px; color:#4b4b4b; border:solid #b1b4b7 1px; background:#f9fbff; width:170px; line-height:14px" type="text" name="email_id" value="Email Id" onBlur="onBlurDefault(this,'Email Id');"  onFocus="onFocusBlank(this,'Email Id');" maxlength="50">
                </td>
             
              </tr>
              <tr>
                <td height="5" colspan="3"></td>
              </tr>
              <tr>
                <td><select style="font-family:Arial; font-size:12px; color:#4b4b4b; border:solid #b1b4b7 1px; background:#f9fbff; width:164px; line-height:14px "  name="City" id="City" >
<?=plgetCityList($City)?>
</select>
                </td>
                <td><select name="Car_Type" id="Car_Type" style="font-family:Arial; font-size:12px; color:#4b4b4b; border:solid #b1b4b7 1px; background:#f9fbff; width:150px; line-height:14px;"  >
                         <option selected value="-1">Interested In</option>
				<option  value="1">New Car</option>
				<option value="0">UsedCar</option>
                     </select></td>
                <td align="center">&nbsp;
                </td>
              </tr>
               <tr>
                <td height="5" colspan="3"></td>
              </tr>
              <tr>
                <td colspan="2" style="font-family:Arial; font-size:11px; line-height:14px;"><input name="accept" type="checkbox" id="accept" value="Authorize to call or SMS">&nbsp;I authorize HDFC Bank &amp; its representatives to call me or SMS me.
                </td>
              
                <td align="center"><input type="image" src="http://www.deal4loans.com/emailer/images/hdfccc_images/apply_now.gif" alt="Apply Now">
                </td>
              </tr>
              
              
            </table></td>

        </tr>
      </table>
      </form>

                
                
                </td>
              </tr>
              <tr>
                <td style="font-family:Arial; font-size:12px; line-height:14px">&nbsp;</td>
              </tr>
              <tr>
                <td height="10"></td>
              </tr>
              <tr>
                <td align="center"><img src="http://www.deal4loans.com/emailer/hdfc-cl/hdfc_car_loan2.gif" alt=""></td>
              </tr>
              <tr>
                <td height="10"></td>
              </tr>
             
            </table></td>
          <td width="50" valign="top">&nbsp;</td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td><img src="http://www.hdfcbank.com/mailer/Jan12/Auto_Loan_12/images/footer.gif" alt=""></td>
  </tr>
  <tr>
    <td style="font-family:Arial; font-size:11px; line-height:14px; padding:10px 0 0 30px">*Terms and conditions apply. Credit at sole discretion at HDFC Bank Ltd.</td>
  </tr>
</table>
</body>
</html>
<?php
}
?>