<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';

	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
	$requestid = $_POST["requestid"];
	$loan_amount = $_POST["loan_amount"];
	$name = $_POST["name"];
	list($fname,$mname,$lname) = split('[ ]',$name);
	if(strlen($mname)>0 && $lname=="")
	{
		$lname= $mname;
		$mname="";
	}
	else
	{
		$lname= "Kumar";
	}
	$source = $_POST["source"];
	$dob = $_POST["dob"];
	$City = $_POST["City"];
	$Email = $_POST["Email"];
	$Mobile_Number = $_POST["Mobile_Number"];
	$$gender = $_POST["gender"];
	if($gender==1) { $strgender="Male";} else {$strgender="Female";}
	$panno = $_POST["panno"];
	$caddress = $_POST["caddress"];
	$strresiadd = round((strlen($caddress)/3));
	$resiadd = str_split($caddress, $strresiadd);
	$paddress = $_POST["paddress"];
	$stroffadd = round((strlen($paddress)/3));
	$offadd = str_split($paddress, $stroffadd);
	$company_name = $_POST["company_name"];
	$salary = $_POST["salary"];
	$net_salary = $_POST["salary"]*12;
	$salary = $net_salary;
	$city = $City;
	$Net_Salary = $net_salary;
	$Resi_Pincode = $_POST["Resi_Pincode"];
	$Qualification = $_POST['Qualification'];
	$MaritalStatus = $_POST['MaritalStatus'];
	$ResiStdCode = $_POST['ResiStdCode'];
	$ResiLandlineNum = $_POST['ResiLandlineNum'];
	$ResiLandline = $ResiStdCode."-".$ResiLandlineNum;
	$Offi_Pincode = $_POST["Offi_Pincode"];
	$OffiCity = $_POST['OffiCity'];
	$OffiStdCode = $_POST['OffiStdCode'];
	$OffiLandlineNum = $_POST['OffiLandlineNum'];
	$officeLandline = $OffiStdCode."-".$OffiLandlineNum;
	//total exp, current exp

$bajajclause=ExecQuery("Select company_name from pl_company_list Where company_name like '%".$company_name."%'");
$bjcl=mysql_fetch_array($bajajclause);

if($bjcl["company_name"]!="INDIAN AIRFORCE" && $bjcl["company_name"]!="INDIAN ARMY" && $bjcl["company_name"]!="INDIAN NAVY")
		{
if((($city=="Chennai" || $city=="Bangalore" || $city=="Hyderabad" || $city=="Mumbai" || $city=="Thane" || $city=="Navi Mumbai" || $city=="Delhi" || $city=="Noida" || $city=="Gurgaon" || $city=="Faridabad" || $city=="Gaziabad") && $Net_Salary>=480000) || (($city=="Ahmedabad" || $city=="Kolkata" || $city=="Pune") && $Net_Salary>=420000) || 	
(($city=="Vizag" || $city=="Vishakapatnam"  || $city=="Surat" || $city=="Coimbatore" || $city=="Indore"  ||  $city=="Cochin" || $city=="Kochi" ||  $city=="Ernakulam" || $city=="Chandigarh" || $city=="Mohali" ||  $city=="Panchkula" || $city=="Kharar" || $city=="Ziragpur" || $city=="Jaipur" || $city=="Baroda" || $city=="Vadodara" ) && $Net_Salary>=360000) || (($city=='Aurangabad' || $city=='Nagpur' || $city=='Nasik' || $city=='Mysore' || $city=='Madurai' || $city=='Bhubneshwar' || $city=='Goa' || $city=='Vasco' || $city=='Ponda' || $city=='Panjim' || $city=='Cuttack') && $Net_Salary>=300000))
		{
	if(strlen($name)>0 && strlen($Mobile_Number>10))
				{
					$selbjaj_fin="select bajajf_mobile From bajaj_cibildetails Where (bajajf_mobile='".$Mobile_Number."' and bajajf_mobile not in ('9811215138','9999570210','9717594462'))";
					$bjresult = ExecQuery($selbjaj_fin);
					$bjrecordcount = mysql_num_rows($bjresult);
		if($bjrecordcount>0)
					{
						$mailerval="Alreadyexist";
					}
					else
					{
	 $bajajcibil = "INSERT INTO bajaj_cibildetails( bajajf_plrequestid, bajajf_name, bajajf_dob, bajajf_gender, bajajf_loan_amt, bajajf_panno, bajajf_caddress, bajajf_cstate, bajajf_cpincode, bajajf_company_name, bajajf_paddress, bajajf_pstate, bajajf_ppincode, bajajf_salary, bajaj_dated, bajajf_city,bajajf_mobile,bajajf_source, qualification, bajajf_maritalstatus, office_city, office_landline, residence_landline) VALUES ('".$requestid."','".$name."','".$dob."','".$gender."','".$loan_amount."','".$panno."', '".$caddress."', '".$state."', '".$Resi_Pincode."', '".$company_name."', '".$paddress."', '".$pstate."' ,'".$Offi_Pincode."','".$salary."', Now(),'".$City."','".$Mobile_Number."','".$source."','".$Qualification."','".$MaritalStatus."','".$OffiCity."','".$officeLandline."','".$ResiLandline."')"; //die;
	$bajajcibilresult = ExecQuery($bajajcibil);	
	$bflid = mysql_insert_id();
	if($gender==2)
		{
			$gendr="Female";
		}
		else
		{
			$gendr="Male";
		}

$Message="Customer Details<br>
Mobile contact: $Mobile_Number<br>
City : $City<br>
Loan Amount red : $loan_amount<br>
Customer Name:	$name<br>
customer Emailid: $Email <br>
Customer dob : $dob<br>
Customer Gender : $gendr<br>
Customer PanNo: $panno<br>
Current Address : $caddress<br>
Current State: $state<br>
Current Pincode: $pincode<br>
office Address : $paddress<br>
office Address : $pstate<br>
office Address : $ppincode<br>
Company Name: $company_name<br>
Salary: $net_salary<br><br>
Regards<br>
Team Deal4loans";
$getCityDetailsSql = "select * from bajajfinserv_bidders where (bfs_status=1 and bfs_city like '%".$City."%')";
$getCityDetailsQuery = ExecQuery($getCityDetailsSql);
$numgetCity = mysql_fetch_array($getCityDetailsQuery);
$bfs_emailid = $numgetCity["bfs_emailid"];
$bfs_ccemailid = $numgetCity["bfs_ccemailid"];
$bfs_mobileno = $numgetCity["bfs_mobileno"];

if(strlen($bfs_emailid)>2)
						{
$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= "Cc:".$bfs_ccemailid.""."\n";
//$headers .= "Bcc: balbirsingh499@gmail.com,Balbir.singh@deal4loans.com"."\n";
$plemail = $bfs_emailid.",balbirsingh499@gmail.com,balbir.singh@deal4loans.com,pavans.mishra@deal4loans.com";
//$plemail = "ranjana5chauhan@gmail.com";
//mail($plemail,'24 Hour Gurantee Approval Customer', $Message, $headers);
						}
						else
						{
$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= "Cc:".$bfs_ccemailid.""."\n";
$plemail = "balbirsingh499@gmail.com,balbir.singh@deal4loans.com,pavans.mishra@deal4loans.com";
//$plemail = "ranjana5chauhan@gmail.com";
//mail($plemail,'24 Hour Gurantee Approval Customer', $Message, $headers);
						}

if(strlen($bfs_mobileno)>2)
						{
$currentdate=date('d-m-Y');
$message ="Your Personal loan Leads on (".$currentdate.") : ";
$SMSMessage=$SMSMessage."".$name."-".$Mobile_Number.",cty- ".$City.",pan- ".$panno.",dob -".$dob." CA-".$caddress;
$arrbfs_mobileno = explode(",",$bfs_mobileno);

if(count($arrbfs_mobileno)>1)
		{
	for($bfs=0; $bfs<count($arrbfs_mobileno);$bfs++)
			{
$strmobile_no = $arrbfs_mobileno[$bfs];
//SendSMSforLMS($message.$SMSMessage, $strmobile_no);

$strmobile_norc=9717594462;
//SendSMSforLMS($message.$SMSMessage." GC", $strmobile_norc);
}
		}
					}	}
				}
			}
	}
	}
//get PSF name:
$getPSFDetailsSql = "select bajajf_psf from bajajfinserv_citypsf_mapping where (bajajf_city like '%".$City."%' and status=1)";
$getPSFDetailsQuery = ExecQuery($getPSFDetailsSql);
$numgetpsf = mysql_fetch_array($getPSFDetailsQuery);
$bajajf_psf = $numgetpsf["bajajf_psf"];
//get PSF name end
 //e-referral
//echo "this is 30th march 2016";
	$redirectionURL = "http://www.deal4loans.com/bfl_specialpage1.php";
	$requestREF = "BFL_".$bflid;
	$username ="ereferral";
    $pwd="mZPGekPk+0pxA/plQvOh3vd/6SGMjkzRtJo0wHOuuMM=";
    $json='[
    {
        &quot;ERefferelRequestType&quot;: &quot;Full&quot;,
        &quot;ERefferelObjects&quot;: {
            &quot;OBJ_1003&quot;: {
                &quot;Mobile__eref&quot;: &quot;'.$Mobile_Number.'&quot;,
                &quot;Date_of_Birth__eref&quot;: &quot;'.$dob.'&quot;,
                &quot;PANNumber__eref&quot;: &quot;'.strtoupper($panno).'&quot;,
                &quot;Adhaar_Number__eref&quot;: &quot;&quot;,
                &quot;Total_Work_Experience_Yrs__eref&quot;: &quot;10&quot;,
                &quot;Total_Work_Experience_Months__eref&quot;: &quot;5&quot;,
                &quot;Current_experiance_in_Years__eref&quot;: &quot;2&quot;,
                &quot;Current_experiance_in_Month__eref&quot;: &quot;6&quot;,
                &quot;Gross_Salary_Turn_Over__eref&quot;: &quot;'.$salary.'&quot;,
                &quot;Qualification__eref&quot;: &quot;'.$Qualification.'&quot;,
                &quot;Name_Of_The_Degree__eref&quot;: &quot;BE&quot;,
                &quot;Gender__eref&quot;: &quot;'.$gendr.'&quot;,
                &quot;Marital_Status__eref&quot;: &quot;'.$MaritalStatus.'&quot;,
                &quot;Employer__eref&quot;: &quot;'.$company_name.'&quot;,
                &quot;DesignationOTP__eref&quot;: &quot;Executive&quot;,
                &quot;Department__eref&quot;: &quot;&quot;,
                &quot;Employee_Number__eref&quot;: &quot;0&quot;,
                &quot;Accountant_email_id__eref&quot;: &quot;'.$Email.'&quot;,
                &quot;Office_Address_1st_Line__eref&quot;: &quot;'.$offadd[0].'&quot;,
                &quot;Office_Address_2nd_Line__eref&quot;: &quot;'.$offadd[1].'&quot;,
                &quot;Office_Address_3rd_Line__eref&quot;: &quot;'.$offadd[2].'&quot;,
                &quot;Office_Pin_Code__eref&quot;: &quot;'.$Offi_Pincode.'&quot;,
                &quot;Office_City__eref&quot;: &quot;'.$City.'&quot;,
                &quot;Office_STD_Code__eref&quot;: &quot;022&quot;,
                &quot;Office_Landline_Number1__eref&quot;: &quot;'.$OffiLandlineNum.'&quot;,
                &quot;Office_Landline_Number2__eref&quot;: &quot;123&quot;,
                &quot;Current_Residence_Address1__eref&quot;: &quot;'.$resiadd[0].'&quot;,
                &quot;Current_Residence_Address2__eref&quot;: &quot;'.$resiadd[1].'&quot;,
                &quot;Current_Residence_Address3__eref&quot;: &quot;'.$resiadd[2].'&quot;,
                &quot;Current_PinCode__eref&quot;: &quot;'.$Resi_Pincode.'&quot;,
                &quot;Current_City__eref&quot;: &quot;'.$City.'&quot;,
                &quot;Residence_TypeAcc__eref&quot;: &quot;Owned by Self/Spouse&quot;,
                &quot;Current_STDCode__eref&quot;: &quot;022&quot;,
                &quot;Residence_Landline_phone__eref&quot;: &quot;'.$ResiLandlineNum.'&quot;,
                &quot;Current_Email_Id__eref&quot;: &quot;'.$Email.'&quot;
            },
            &quot;OBJ_1002&quot;: {
                &quot;FirstName&quot;: &quot;'.$fname.'&quot;,
                &quot;Middle_Name__eref&quot;: &quot;'.$mname.'&quot;,
                &quot;LastName&quot;: &quot;'.$lname.'&quot;,
                &quot;Others_Employer__eref&quot;: &quot;&quot;,
                &quot;Email_Confirmation_received__eref&quot;: &quot;Yes&quot;,
                &quot;Customer_address_matches_with_eKYC__eref&quot;: &quot;Yes&quot;,
                &quot;Customer_address_matches_with_perfios__eref&quot;: &quot;Yes&quot;,
                &quot;Customer_Add_Matches_With_Previous_Add__eref&quot;: &quot;Yes&quot;
            },
            &quot;OBJ_1001&quot;: {
                &quot;Product__eref&quot;: &quot;SAL&quot;,
                &quot;Sourcing_Channel__eref&quot;: &quot;'.$bajajf_psf.'&quot;,
				&quot;Branch_Name__eref&quot;: &quot;'.$City.'&quot;,
                &quot;Referral__eref&quot;: &quot;Mywish Marketplaces Pvt Ltd&quot;,
                &quot;Application_Source__eref&quot;: &quot;E-Referral&quot;,
                &quot;Application_Channel__eref&quot;: &quot;Indirect&quot;,
                &quot;Processing_Fees__eref&quot;: &quot;5&quot;
            },
                &quot;OBJ_1005&quot;: {
                &quot;Is_PL_BT__eref&quot;: &quot;true&quot;
            },
            &quot;OBJ_1007&quot;: {
                &quot;Bank_Name__eref&quot;: &quot;Lakshmi Vilas Bank&quot;,
                &quot;Bank_Acct_Number__eref&quot;: &quot;202071219255&quot;
            },
            &quot;OBJ_1006&quot;: {
               &quot;Proposed_Loan_Amt__eref&quot;: &quot;175000&quot;,
                &quot;Tenor__eref&quot;: &quot;36&quot;,
                &quot;ROI__eref&quot;: &quot;15.25&quot;,
                &quot;Average_incentive_for_Q1__eref&quot;: &quot;50000&quot;,
                &quot;Average_incentive_for_Q2__eref&quot;: &quot;50000&quot;,
                &quot;Average_incentive_for_Q3__eref&quot;: &quot;55000&quot;,
                &quot;Monthly_Reimbursement__eref&quot;: &quot;2000&quot;,
                &quot;Rental_Income__eref&quot;: &quot;50000&quot;,
                &quot;Existing_HL_EMI__eref&quot;: &quot;20000&quot;,
                &quot;Month1_Doc__eref&quot;: &quot;JAN&quot;,
                &quot;Month2_Doc__eref&quot;: &quot;FEB&quot;,
                &quot;Month3_Doc__eref&quot;: &quot;MAR&quot;,
                &quot;Incentive_Monthly_or_Quarterly__eref&quot;: &quot;Monthly&quot;,
                &quot;LAP_pmt__eref&quot;: &quot;50000&quot;,
                &quot;Avg_monthly_incentive2__eref&quot;: &quot;50000&quot;,
                &quot;Avg_monthly_incentive3__eref&quot;: &quot;50000&quot;,
                &quot;Avg_monthly_incentive1__eref&quot;: &quot;50000&quot;,
                &quot;Receips4_Doc__eref&quot;: &quot;50000&quot;,
                &quot;Receips5_Doc__eref&quot;: &quot;50000&quot;,
                &quot;Receips6_Doc__eref&quot;: &quot;50000&quot;
            }
        }
    }
]';


$bflqryf="Update bajaj_cibildetails set bajaj_request_json='".$json."' Where bajajcibilid=".$bflid;
$bjresult = ExecQuery($bflqryf);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Personal Loans Bank - List of Providers in India</title>
<meta name="keywords" content="personal loan banks, banks of personal loan, personal loan banks India, providers of personal loan">
<meta name="description" content="Personal Loan Banks: Here you can find which are the banks who provides personal loans in India.">
<link href="css/personal-loan-styles.css" type="text/css" rel="stylesheet"  />
</head>
<body ONLOAD="document.frm.submit();">
<!---<body>-->
<?php include "middle-menu.php"; ?>
<div class="d4l_inner_wrapper">
<div style="margin-top:70px;"></div>
<div  class="common-bread-crumb"><a href="index.php">Home</a> > <a href="personal-loans.php">Personal Loans</a> > <span>Personal Loan Banks</span></div>
<div style="margin:auto;">
<div style="clear:both; height:15px;"></div>
<table align="center" cellpadding="6" cellspacing="0" width="650" >
<tr><td colspan="2" align="center" >Your details has been forwarded to Bajaj finserv, they will soon contact you.</td></tr>
</td></tr>
<tr><td  colspan="2" align="center">Basis your profile below is your Eligibility for Personal Loan.</td></tr>
</table>
<form method="POST" id="myForm" name="frm"  action="http://bflloans.force.com/ereferral" encType="application/x-www-form-urlencoded"> 
	<input type="hidden" name="user" id = 'userID' value="<?php echo $username;?>"/>
	<input type="hidden" name= "pwd" id = 'pwdID' value="<?php echo $pwd;?>"/>
	<input type="hidden" name="json-post-str" value="<?php echo $json;?>"/>
	<input type="hidden" name="redirectionURL" value="<?php echo $redirectionURL;?>"/>
	<input type="hidden" name="requestReferenceNumber" value="<?php echo $requestREF;?>"/>
	<!--<input type="submit" value="calculateEligibility"/>-->
</form>
<div style="clear:both; height:15px;"></div>
</div>
</div>
<?php include("footer_sub_menu.php"); ?>
</body>
</html>
