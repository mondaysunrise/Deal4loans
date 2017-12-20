<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	
	$page_Name = "LandingPage_HL";

function getProductName($pKey){
	$titles = array(
		'Req_Loan_Personal' => 'Personal Loan',
		'Req_Loan_Home' => 'Home Loan',
		'Req_Loan_Car' => 'Car Loan',
		'Req_Credit_Card' => 'Credit Card',
		'Req_Loan_Against_Property' => ' Loan Against property',
		'Req_Life_Insurance' => 'Insurance',
	);

	foreach ($titles as $key=>$value)
	    if($pKey==$key)
		return $value;

	return "";
   }
	

	function getReqValue($pKey){
	$titles = array(
		'Req_Loan_Personal' => 'personal',
		'Req_Loan_Home' => 'home',
		'Req_Loan_Car' => 'car',
		'Req_Credit_Card' => 'cc',
		'Req_Loan_Against_Property' => 'property',
		'Req_Life_Insurance' => 'insurance'
	);

	foreach ($titles as $key=>$value)
	    if($pKey==$key)
		return $value;

	return "";
   }

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{

	$Name = $_POST['Name'];
	$Activate = $_POST['Activate'];
	$Phone = $_POST['Phone'];
	$Email = $_POST['Email'];
	$City = $_POST['City'];
	$City_Other = $_POST['City_Other'];
	$Net_Salary = $_POST['IncomeAmount'];
	$Loan_Amount = $_POST['Loan_Amount'];
	$Type_Loan = $_POST['Type_Loan'];
	$source = $_POST['source'];
	$Creative = $_POST['creative'];
	$Section = $_POST['section'];
	$Accidental_Insurance = $_POST['Accidental_Insurance'];
	$Referrer=$_REQUEST['referrer'];
	$Reference_Code = generateNumber(4);
	$IP = getenv("REMOTE_ADDR");
	$IsPublic = 1;
	if($Activate>0)
	{
		$DeleteIncompleteSql = "Delete from Req_Incomplete_Lead where IncompeletID=".$Activate;		
		$deleterowcount=Maindeletefunc($DeleteIncompleteSql,$array = array());
	}
	
function InsertTataAig($RequestID, $ProductName)
	{
		$GetDateSql = "select Dated, City, City_Other, Mobile_Number from ".$ProductName." where RequestID = $RequestID";
		list($alreadyExist,$RowGetDate)=MainselectfuncNew($GetDateSql,$array = array());
		$RowGetDatecontr=count($RowGetDate)-1;
		$Dated = ExactServerdate();
		$TDated = $RowGetDate[$RowGetDatecontr]['Dated'];
		$TCity = $RowGetDate[$RowGetDatecontr]['City'];
		$Mobile = $RowGetDate[$RowGetDatecontr]['Mobile_Number'];
		$Product_Name = "2";
		
		$dataInsert = array("T_RequestID"=>$RequestID , "T_Product"=>$Product_Name , "T_City"=>$TCity , "Mobile_Number"=>$Mobile , "T_Dated"=>$Dated );
		$table = 'tataaig_leads';
		$insert = Maininsertfunc ($table, $dataInsert);
		//exit();

	}


		$crap = " ".$Name." ".$Email." ".$City_Other;
		//echo $crap,"<br>";
		$crapValue = validateValues($crap);
		$_SESSION['crapValue'] = $crapValue;
		//exit();
		if($crapValue=='Put')
		{
			$CheckSql = "select UserID from wUsers where Email = '".$Email."'";
			list($alreadyExist,$myrow)=MainselectfuncNew($CheckSql,$array = array());
			$myrowcontr=count($myrow)-1;
			$CheckNumRows = $alreadyExist;
			$Dated = ExactServerdate();
			if($CheckNumRows>0)
			{
				$UserID = $myrow[$myrowcontr]["UserID"];
				$data = array("UserID"=>$UserID, "Name"=>$Name, "Email"=>$Email, "City"=>$City, "City_Other"=>$City_Other, "Mobile_Number"=>$Mobile_Number, "Net_Salary"=>$Net_Salary, "Loan_Amount"=>$Loan_Amount, "Dated"=>$Dated, "source"=>$source, "Referrer"=>$Referrer, "Creative"=>$Creative, "Section"=>$Section, "IP_Address"=>$IP_Address, "Reference_Code"=>$Reference_Code,"Updated_Date"=>$Dated,"Accidental_Insurance"=>$Accidental_Insurance);
			//	echo "<br>if".$InsertProductSql;
			}
			else
			{
				$wUsersdata = array("Email"=>$Email, "FName"=>$Name, "Phone"=>$Phone, "Join_Date"=>$Dated, "IsPublic"=>$IsPublic);
				$UserID = Maininsertfunc("wUsers", $wUsersdata);		
			
				$data = array("UserID"=>$UserID, "Name"=>$Name, "Email"=>$Email, "City"=>$City, "City_Other"=>$City_Other, "Mobile_Number"=>$Mobile_Number, "Net_Salary"=>$Net_Salary, "Loan_Amount"=>$Loan_Amount, "Dated"=>$Dated, "source"=>$source, "Referrer"=>$Referrer, "Creative"=>$Creative, "Section"=>$Section, "IP_Address"=>$IP_Address, "Reference_Code"=>$Reference_Code,"Updated_Date"=>$Dated,"Accidental_Insurance"=>$Accidental_Insurance);
			}
			
			$ProductValue = Maininsertfunc ($Type_Loan, $data);
			//exit();
			if($Accidental_Insurance=="1")
				{
					InsertTataAig($ProductValue, "Req_Loan_Home");
				}
			
			$SMSMessage = "Dear $Name,your activation code is: $Reference_Code.Use it in step 2 of loan app form to get banks contacts & quotes. And help us serve you better.";
			if(strlen(trim($Phone)) > 0)
				//SendSMS($SMSMessage, $Phone);
			
			
			//Code Added to mailtocommonscript.php
			$FName = $Name;
			$Checktosend="getthank_individual";
			include "scripts/mailatcommonscript.php";

			$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
			$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			
			if($FName)
				$SubjectLine = $FName.", Learn to get Best Deal on ".getProductName($Type_Loan);
			else
				$SubjectLine = "Learn to get Best Deal on ".getProductName($Type_Loan);
			//echo $Type_Loan;
			if(isset($Type_Loan))
			{
				mail($Email, $SubjectLine, $Message2, $headers);
			}
			
			

		}//$crap Check
		else if($crapValue=='Discard')
		{
			header("Location: Redirect.php");
			exit();
		}
		else
		{
			header("Location: Redirect.php");
			exit();
		}
	
}

	//require 'scripts/db_init.php';
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

	if(isset($_POST['submit']))
	{
		$loan_amount = $_POST['loan_amount'];
		$income = $_POST['income'];
		$co_income = $_POST['co_income'];
		$obligations = $_POST['obligations'];
		$dateofbirth = $_POST['dob'];
	}
?>	

 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Home Loans India Apply Compare | Housing Mortage Loan</title>
<meta name="description" content="Deal4Loans is an online loan information portal, provides valuable information on all types of loans in India offered by top banks. Read and apply online for home loans & Get, Compare and Choose deals from all the leading loan providers / banks. Know the interest rates, EMIs, Loan amount etc choose the Best Deal.">
<meta name="keywords" content="Home loans India, Apply Home Loans, Compare Home Loans in Mumbai Hyderabad Pune kolkata Delhi Noida Bangalore">
<script type="text/javascript" src="scripts/mootools-beta-1.2b2.js"></script> 
<!--[if IE]>
	<script type="text/javascript" src="scripts/moocanvas.js"></script>
<![endif]-->
<script type="text/javascript" src="scripts/piechart.js"></script> 	

<script language="JavaScript" src="scripts/slider.js"></script>
<link rel="stylesheet" href="home_style.css" type="text/css" />
<script language="javascript">
function check_form(Form)
{
	if(Form.loan_amount.value=="")
	{
		alert('Please enter loan_amount');
		Form.loan_amount.focus();
		return false;
	}
	
	if(Form.income.value=="")
	{
		alert('Please enter Annual Income');
		Form.income.focus();
		return false;
	}
	/*if(Form.co_income.value=="")
	{
		alert("Please enter Co-Applicant's Annual Income");
		Form.co_income.focus();
		return false;
	}*/
		
}
//function addElement()
//{
//		var ni = document.getElementById('myDiv');
//		
//		if(ni.innerHTML=="")
//		{
//		
//			if(document.personalloan_form.CC_Holder.value="on")
//			{
//				//alert(document.loan_form.CC_Holder.value);
//				ni.innerHTML = '<table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td width="50%" class="frmbldtxt">Name</td><td width="50%"><span class="frmbldtxt"><input type="text" name="name" id="name" style="width:180px;" maxlength="30" value="<?php echo $loan_amount; ?>" ></span></td></tr><tr><td class="frmbldtxt">Date of Birth </td><td>&nbsp;</td></tr> <tr><td class="frmbldtxt">Net Monthly Income </td><td><span class="frmbldtxt"> <input type="text" name="monthly_income" id="monthly_income" style="width:180px;" value="<?php echo $income; ?>"></span></td></tr><tr><td class="frmbldtxt">Obligations</td>   <td><span class="frmbldtxt"><input type="text" name="obligations" id="obligations" style="width:180px;" value="<?php echo $obligations; ?>"></span></td></tr></table>
//';
//				
//
//			}
//		}
//		
//		return true;
//
//	}

</script>


<script language="JavaScript">
function showLoanAmt1()
{
	alert("Naushad");
	//var value = val;
	//alert(value);
	var loanAmt = document.demoForm.sliderValue1.value;
	//var ni = document.getElementById('getLoanAmt');
	alert(loanAmt);
	//if(ni.innerHTML=="")
	//{
//		ni.innerHTML = "<table ><tr><td>"+value+"</td></tr></table>";
		//ni.innerHTML = "80";
		//return true;
	//}
	//else
	//{
		//ni.innerHTML = "";
	//}
	//alert(ni);
}

</script>
<style>
.bldtxt{
	float:left;
	font-size:13px;
	font-weight:bold;
	color:#3A0303;
	font-family:Verdana, Arial, Helvetica, sans-serif;
}
</style>

</head>

<body>
<table width="600" border="0" align="center" cellpadding="0" cellspacing="0" style="border:5px solid #E9DCB4; background-color:#F4EFE0;">
  <tr>
    <td style="padding:5px;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="150" height="55" align="center" valign="middle" ><img src="images/hl_logo.gif" width="140" height="45" /></td>
            <td width="420" align="left" valign="middle" style="font-family:Verdana, Arial, Helvetica, sans-serif; color:#3A0303; font-size:13px; text-decoration:none; font-weight:bold;	">Home Loans by choice not by chance!!</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="197" height="160" align="left" valign="top"><img src="images/hl_headr_lft.jpg" width="197" height="160" /></td>
            <td width="175" align="left"><img src="images/hl_header-mdl.jpg" width="175" height="160" /></td>
            <td width="208"><img src="images/hl_header_rgt.jpg" width="208" height="160" /></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td style="padding:5px 0px;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="center" valign="top" ><table width="100%" border="0" cellpadding="0" cellspacing="0">
                
                <tr>
                  <td style="padding:5px 0px; background-color:#EFE6CB; border:3px solid #FFFFFF;"><table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" >
                      <tr>
                        <td height="30" align="center" valign="top" class="heading">www.deal4loans.com</td>
                      </tr>
                      <tr>
                        <td class="text">The one-stop shop for Best on Home loan<br />
                          requirements Now get offers from</td>
                      </tr>
                      <tr>
                        <td height="20" align="left" class="text" style="font-weight:bold; color:#7d0606;"><img src="images/rd_arrow.gif" width="8" height="8" border="0" /> LIC Home Finance </td>
                      </tr>
                      <tr>
                        <td height="20" align="left" class="text" style="font-weight:bold; color:#7d0606;"><img src="images/rd_arrow.gif" width="8" height="8" border="0" /> HDFC Ltd</td>
                      </tr>
                      <tr>
                        <td height="20" align="left"   class="text" style="font-weight:bold; color:#7d0606;"><img src="images/rd_arrow.gif" width="8" height="8" border="0" /> ICICI</td>
                      </tr>
                      <tr>
                        <td height="20" align="left" class="text" style="font-weight:bold; color:#7d0606;"><img src="images/rd_arrow.gif" width="8" height="8" border="0" /> IDBI &amp; DHFL &amp; SBI</td>
                      </tr>
                      <tr>
                        <td height="20" align="left" class="text">and Choose the Best Deal!</td>
                      </tr>
                      <tr>
                        <td align="left"  class="text"></td>
                      </tr>
                      <tr>
                        <td align="right" ><a href="http://www.deal4loans.com" target="_blank" class="subheading" style="font-size:12px; text-decoration:underline; font-weight:bold;">www.deal4loans.com</a></td>
                      </tr>
                  </table></td>
                </tr>
            </table></td>
            <td  >&nbsp;</td>
            <td width="303" align="left" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td style="padding:5px 0px; background-color:#EFE6CB; border:3px solid #FFFFFF;">
				<form action="#" method="get" name="demoForm">

				<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" >
                    <tr>
                      <td height="40" align="center" valign="top" class="heading">Apply Home Loan </td>
                    </tr>
                    <tr>
                      <td class="text"><div style=" float:left; font-size:13px; font-weight:bold; color:#3A0303; font-family:Verdana, Arial, Helvetica, sans-serif;">Loan Amount</div><div style=" float:right; font-size:17px; font-weight:bold;   font-family:Arial, Helvetica, sans-serif;">
Rs.<input name="sliderValue1" id="sliderValue1h" type="text"  onChange="return showLoanAmt1(); A_SLIDERS[1].f_setValue(this.value); " style="border:none; font-size:17px; font-weight:bold; color:#3A0303; font-family:Arial, Helvetica, sans-serif; background-color:#efe6cb; width:82px; text-align:left;" onSelect="showLoanAmt();">
</div></td>
                    </tr>
                    <tr>
                      <td class="text"></td>
                    </tr>
                    <tr>
                      <td class="text"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td width="25">&nbsp;</td>
                          <td><div style="float:left;">
<script language="JavaScript">
	var A_TPL1h = {
		'b_vertical' : false,
		'b_watch': true,
		'n_controlWidth': 234,
		'n_controlHeight': 19,
		'n_sliderWidth': 19,
		'n_sliderHeight': 19,
		'n_pathLeft' : -10,
		'n_pathTop' : 1,
		'n_pathLength' : 234,
		's_imgControl': 'images/sldr2h_bg.gif',
		's_imgSlider': 'images/sldr2h_sl.gif',
		'n_zIndex': 1
	}
	var A_INIT1h = {
	
		's_form' : 0,
		's_name': 'sliderValue1h',
		'n_minValue' : 200000,
		'n_maxValue' : 20000000,
		'n_value' : 50,
		'n_step' : 100000
	}

	new slider(A_INIT1h, A_TPL1h);
</script>
</div></td>
                        </tr>
                      </table></td>
                    </tr>
                    <tr>
                      <td class="text">&nbsp;</td>
                    </tr>
                    <tr>
                      <td class="text"><div style=" float:left; font-size:13px; font-weight:bold; color:#3A0303; font-family:Verdana, Arial, Helvetica, sans-serif;">Tenure</div><div style=" float:right; font-size:17px; font-weight:bold;   font-family:Arial, Helvetica, sans-serif;">
 <input name="sliderValue" id="sliderValue3h" type="Text"  onChange="A_SLIDERS[3].f_setValue(this.value)"  style="border:none; font-size:17px; font-weight:bold; color:#3A0303; font-family:Arial, Helvetica, sans-serif; background-color:#efe6cb; width:28px; text-align:left;" onSelect="showLoanAmt();">Years
</div></td>
                    </tr>
                    <tr>
                      <td class="text"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td width="25">&nbsp;</td>
                          <td><div style="float:left;">
<script language="JavaScript">
	var A_TPL3h = {
		'b_vertical' : false,
		'b_watch': true,
		'n_controlWidth': 234,
		'n_controlHeight': 19,
		'n_sliderWidth': 19,
		'n_sliderHeight': 19,
		'n_pathLeft' : -10,
		'n_pathTop' : 1,
		'n_pathLength' : 234,
		's_imgControl': 'images/sldr2h_bg.gif',
		's_imgSlider': 'images/sldr2h_sl.gif',
		'n_zIndex': 1
	}
	var A_INIT3h = {
	
		's_form' : 0,
		's_name': 'sliderValue3h',
		'n_minValue' : 5,
		'n_maxValue' : 25,
		'n_value' : 50,
		'n_step' : 1
	}

	new slider(A_INIT3h, A_TPL3h);
</script>
</div></td>
                        </tr>
                        <tr>
                          <td colspan="2" height="5"></td>
                          </tr>
                      </table></td>
                    </tr>
                    <tr>
                      <td class="text"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="bldtxt">
                        <tr>
                          <td width="51%" height="22">EMI</td>
                          <td width="49%">&nbsp;</td>
                        </tr>
                        <tr>
                          <td height="22">Loan Amount </td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <td height="22">Tenure</td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <td height="22">Rate of Interest </td>
                          <td>&nbsp;</td>
                        </tr>
                        
                      </table></td>
                    </tr>
                    <tr>
                      <td class="text"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="bldtxt">
                        <tr>
                          <td width="7%" height="25"><input type="checkbox" name="doc" value="salaryslip"  style="border:none;"/></td>
                          <td width="93%" class="text" style="font-weight:normal;">Latest Salary slip</td>
                        </tr>
                        <tr>
                          <td height="25"><input type="checkbox" name="doc" value="frm"  style="border:none;"/></td>
                          <td class="text" style="font-weight:normal;">Form -16 of last financial year</td>
                        </tr>
                        <tr>
                          <td height="25" valign="top"><input type="checkbox" name="doc" value="statement"  style="border:none;"/></td>
                          <td class="text" style="font-weight:normal;">Bank statement reflecting salary credits of six months </td>
                        </tr>
                        <tr>
                          <td height="25"><input type="checkbox" name="doc" value="appointment"  style="border:none;"/></td>
                          <td class="text" style="font-weight:normal;">Appointment Letter</td>
                        </tr>
                        <tr>
                          <td height="25" valign="top"><input type="checkbox" name="doc" value="appointment"  style="border:none;"/></td>
                          <td class="text" style="font-weight:normal;">Repayment track record of existing obligations</td>
                        </tr>
                        <tr>
                          <td height="25"><input type="checkbox" name="doc" value="appointment"  style="border:none;"/></td>
                          <td class="text" style="font-weight:normal;">Employee ID Card</td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                        </tr>
                      </table></td>
                    </tr>
                    <tr>
                      <td class="text">&nbsp;</td>
                    </tr>
                    <tr>
                      <td class="text">&nbsp;</td>
                    </tr>
                    <tr>
                      <td class="text">&nbsp;</td>
                    </tr>
                </table>
				</form></td>
              </tr>
            </table></td>
                </tr>
            </table></td>
          </tr>
        </table></td></tr>
      <tr>
        <td valign="top" style=" background-color:#EFE6CB; border:3px solid #FFFFFF; "><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td height="25" align="center" valign="top" style="font-size:15px; font-weight:bold; color:#333333; font-family:Arial, Helvetica, sans-serif;"  >&nbsp;</td>
          </tr>
          <tr>
            <td align="center" >&nbsp;</td>
          </tr>
          <tr>
            <td height="40">&nbsp;</td>
          </tr>
        </table></td>
      </tr>
	  <tr>
	  <td height="5"></td>
	  </tr>
	  
    </table></td>
  </tr>

 
<script language="JavaScript" type="text/javascript">

<!--
var google_conversion_id = 1056387586;
var google_conversion_language = "en_US";
var google_conversion_format = "1";
var google_conversion_color = "FFFFFF";
if (1) {
  var google_conversion_value = 1;
}

var google_conversion_label = "lead";
//-->
</script>

<script language="JavaScript" src="http://www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<img height=1 width=1 border=0 src="http://www.googleadservices.com/pagead/conversion/1056387586/imp.gif?value=1&label=lead&script=0">
</noscript>

</body>
</html>
