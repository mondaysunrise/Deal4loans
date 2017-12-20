<?php
error_reporting(1);
session_start();
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	require 'bajajfs_leadallocation.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

$dd  = FixString($_POST["dd"]);
$mm = FixString($_POST["mm"]);
$yyyy = FixString($_POST["yyyy"]);
$DOB = $yyyy."-".$mm."-".$dd;
$panno = FixString($_POST["panno"]);
$purpose_of_loan = FixString($_POST["purpse_loan"]);
$qualification = FixString($_POST["qualification"]);
$gender = FixString($_POST["gender"]);
$marital_status = FixString($_POST["marital_stat"]);
if($marital_status==2)
		{
			$MaritalStatus="Single";
		}
		else
		{
			$MaritalStatus="Married";
		}

$no_of_dependent = FixString($_POST["no_of_dependent"]);
$residence_type = FixString($_POST["residence_type"]);
$rs_year = FixString($_POST["rs_year"]);
$rs_month = FixString($_POST["rs_month"]);
$residing_since =  $rs_month." ".$rs_year;
$Resi_Pincode = FixString($_POST["Resi_Pincode"]);
$residence_address = FixString($_POST["residence_address"]);
$strresiadd = round((strlen($residence_address)/3));
	$resiadd = str_split($residence_address, $strresiadd);
$residence_landline = FixString($_POST["residence_landline"]);
$designation = FixString($_POST["designation"]);
$department = FixString($_POST["department"]);
$ce_year = FixString($_POST["ce_year"]);
$ce_month = FixString($_POST["ce_month"]);
$te_year = FixString($_POST["te_year"]);
$te_month  = FixString($_POST["te_month"]);
$current_experience = $ce_month." ".$ce_year;
$Total_experience = $te_month." ".$te_year;
$Offi_Pincode = FixString($_POST["Offi_Pincode"]);
$office_address = FixString($_POST["office_address"]);
$stroffadd = round((strlen($office_address)/3));
$offadd = str_split($office_address, $stroffadd);
$office_landline = FixString($_POST["office_landline"]);
$office_email = FixString($_POST["office_email"]);
$bajajf_cibilreqid = FixString($_POST["bajajf_cibilreqid"]);
$bajajf_reqid = FixString($_POST["bajajf_reqid"]);

if($bajajf_reqid>0)
	{
		$dataUpdate = array('bajajf_dob'=>$DOB, 'bajajf_panno'=>$panno, 'residence_address'=>$residence_address, 'residence_landline'=>$residence_landline, 'purpose_of_loan'=>$purpose_of_loan, 'qualification'=>$qualification, 'marital_status'=>$marital_status, 'no_of_dependent'=>$no_of_dependent, 'residence_type'=>$residence_type, 'residing_since'=>$residing_since, 'designation'=>$designation, 'department'=>$department, 'current_experience'=>$current_experience, 'total_experience'=>$Total_experience, 'office_address'=>$office_address, 'office_landline'=>$office_landline, 'office_email'=>$office_email,"bajajf_pincode"=>$Resi_Pincode,"bajajf_requestid"=>$bajajf_cibilreqid );
		$wherecondition = "(bajaj_finservid=".$bajajf_reqid.")";
//echo "<br>1<br>";
		//print_r($dataUpdate);
		Mainupdatefunc ('bajaj_finserv_mailer_leads', $dataUpdate, $wherecondition);
	}

if($bajajf_cibilreqid>0)
	{
		$dataUpdate = array('bajajf_dob'=>$DOB, 'bajajf_panno'=>$panno, 'bajajf_caddress'=>$residence_address, 'residence_landline'=>$residence_landline, 'purpose_of_loan'=>$purpose_of_loan, 'qualification'=>$qualification, 'marital_status'=>$marital_status, 'no_of_dependent'=>$no_of_dependent, 'residence_type'=>$residence_type, 'residing_since'=>$residing_since, 'designation'=>$designation, 'department'=>$department, 'current_experience'=>$current_experience, 'total_experience'=>$Total_experience, 'office_address'=>$office_address, 'office_landline'=>$office_landline, 'office_email'=>$office_email, "bajajf_gender"=>$gender, "bajajf_cpincode"=>$Resi_Pincode, "bajajf_ppincode"=>$Offi_Pincode);
		$wherecondition = "(bajajcibilid=".$bajajf_cibilreqid.")";
//echo "<br>2<br>";
			//print_r($dataUpdate);
		Mainupdatefunc ('bajaj_cibildetails', $dataUpdate, $wherecondition);

$bajajfinquery="select bajajf_name, bajajf_gender, bajajf_company_name, bajajf_mobile, bajajf_loan_amt, bajajf_city, bajajf_salary, office_email from bajaj_cibildetails where bajajcibilid=".$bajajf_cibilreqid; 
list($num_rows,$bjrow)=MainselectfuncNew($bajajfinquery,$array = array());
$contr=count($bjrow)-1;
$Mobile_Number = $bjrow[$contr]["bajajf_mobile"];
$City = $bjrow[$contr]["bajajf_city"];
$loan_amount = $bjrow[$contr]["bajajf_loan_amt"];
$name = $bjrow[$contr]["bajajf_name"];
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
$Email = $bjrow[$contr]["office_email"];
$gender = $bjrow[$contr]["bajajf_gender"];
$company_name = $bjrow[$contr]["bajajf_company_name"];
$net_salary = $bjrow[$contr]["bajajf_salary"];
$salary = $net_salary;
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
Customer dob : $DOB<br>
Customer Gender : $gendr<br>
Customer PanNo: $panno<br>
Current Address : $residence_address<br>
office Address :	$office_address<br>
Company Name: $company_name<br>
Salary: $net_salary<br><br>
Regards<br>
Team Deal4loans";
 $getCityDetailsSql = "select * from bajajfinserv_bidders where (bfs_status=1 and bfs_city like '%".$City."%')";
list($num_rows,$numgetCity)=MainselectfuncNew($getCityDetailsSql,$array = array());
$citycountr = count($numgetCity)-1;
 $bfs_emailid = $numgetCity[$citycountr]["bfs_emailid"];
$bfs_ccemailid = $numgetCity[$citycountr]["bfs_ccemailid"];
$bfs_mobileno = $numgetCity[$citycountr]["bfs_mobileno"];

if(strlen($bfs_emailid)>2)
						{
$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= "Cc:".$bfs_ccemailid.""."\n";
//$headers .= "Bcc: ranjana5chauhan@gmail.com"."\n";
$plemail = $bfs_emailid.",balbirsingh499@gmail.com,balbir.singh@deal4loans.com,pavans.mishra@deal4loans.com";
//$plemail = "ranjana5chauhan@gmail.com";
//mail($plemail,'Exclusive Mailer Customer', $Message, $headers);
						}
						else
						{
$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= "Cc:".$bfs_ccemailid.""."\n";
//$headers .= "Bcc: ranjana5chauhan@gmail.com"."\n";
$plemail = "balbirsingh499@gmail.com,balbir.singh@deal4loans.com,pavans.mishra@deal4loans.com";
//$plemail = "ranjana5chauhan@gmail.com";
//mail($plemail,'Exclusive Mailer Customer', $Message, $headers);
						}

if(strlen($bfs_mobileno)>2)
						{
$currentdate=date('d-m-Y');

 $message="Your Leads for pl on (".$currentdate.") : ".$name."-".$Mobile_Number.",cty- ".$City.",sal- ".$net_salary.",LA -".$loan_amount." CN-ExclusiveMailer";

$arrbfs_mobileno = explode(",",$bfs_mobileno);

if(count($arrbfs_mobileno)>1)
		{
	for($bfs=0; $bfs<count($arrbfs_mobileno);$bfs++)
			{
		//echo "<br>";
 $strmobile_no = $arrbfs_mobileno[$bfs];
//SendSMSforLMS($message, $strmobile_no);
}
		}
					}
	}
	}
//get PSF name:
$getPSFDetailsSql = "select bajajf_psf from bajajfinserv_citypsf_mapping where (bajajf_city like '%".$City."%')";
$getPSFDetailsQuery = ExecQuery($getPSFDetailsSql);
$numgetpsf = mysql_fetch_array($getPSFDetailsQuery);
$bajajf_psf = $numgetpsf["bajajf_psf"];
//get PSF name end
//e-referral
//echo "this is 30th march 2016";
	$redirectionURL = "http://www.deal4loans.com/bfl_specialpage1.php";
	$requestREF = "BFL_".$bajajf_cibilreqid;
	$username ="ereferral";
    $pwd="mZPGekPk+0pxA/plQvOh3vd/6SGMjkzRtJo0wHOuuMM=";
     $json='[
    {
        &quot;ERefferelRequestType&quot;: &quot;Full&quot;,
        &quot;ERefferelObjects&quot;: {
            &quot;OBJ_1003&quot;: {
                &quot;Mobile__eref&quot;: &quot;'.$Mobile_Number.'&quot;,
                &quot;Date_of_Birth__eref&quot;: &quot;'.$DOB.'&quot;,
                &quot;PANNumber__eref&quot;: &quot;'.strtoupper($panno).'&quot;,
                &quot;Adhaar_Number__eref&quot;: &quot;&quot;,
                &quot;Total_Work_Experience_Yrs__eref&quot;: &quot;10&quot;,
                &quot;Total_Work_Experience_Months__eref&quot;: &quot;5&quot;,
                &quot;Current_experiance_in_Years__eref&quot;: &quot;2&quot;,
                &quot;Current_experiance_in_Month__eref&quot;: &quot;6&quot;,
                &quot;Gross_Salary_Turn_Over__eref&quot;: &quot;'.$salary.'&quot;,
                &quot;Qualification__eref&quot;: &quot;'.$qualification.'&quot;,
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
                &quot;Office_City__eref&quot;: &quot;Pune&quot;,
                &quot;Office_STD_Code__eref&quot;: &quot;022&quot;,
                &quot;Office_Landline_Number1__eref&quot;: &quot;'.$office_landline.'&quot;,
                &quot;Office_Landline_Number2__eref&quot;: &quot;123&quot;,
                &quot;Current_Residence_Address1__eref&quot;: &quot;'.$resiadd[0].'&quot;,
                &quot;Current_Residence_Address2__eref&quot;: &quot;'.$resiadd[1].'&quot;,
                &quot;Current_Residence_Address3__eref&quot;: &quot;'.$resiadd[2].'&quot;,
                &quot;Current_PinCode__eref&quot;: &quot;'.$Resi_Pincode.'&quot;,
                &quot;Current_City__eref&quot;: &quot;'.$City.'&quot;,
                &quot;Residence_TypeAcc__eref&quot;: &quot;Owned by Self/Spouse&quot;,
                &quot;Current_STDCode__eref&quot;: &quot;022&quot;,
                &quot;Residence_Landline_phone__eref&quot;: &quot;'.$residence_landline.'&quot;,
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
$bflqryf="Update bajaj_cibildetails set bajaj_request_json='".$json."' Where bajajcibilid=".$bajajf_cibilreqid;
$bjresult = ExecQuery($bflqryf);
?>
<!Doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<meta name="viewport" content="width=device-width; initial-scale=1.0">
<title>Bajaj Finserv Personal Loans | Personal Loan Rates | Personal Loan EMI</title>
<link href="css/bajaj-finserv-pl-styles.css" rel="stylesheet" type="text/css">
<link href="css/bajaj-finserv-pl-media.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="scripts/common.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
</head>
<body ONLOAD="document.frm.submit();">
<!--<body>-->
<div id="pagewrap">
<header id="header">
<div class="heading_text">Best Personal Loan from Bajaj Finserv<span style="float:right;">Powered by Deal4loans </span></div>
	<div class="bajaj-finserv_box" style="margin-right:25px;"><img src="new-images/bajaj-finserv1.jpg"></div>
		<nav class="lining"></nav>
  </header>
	
  <div id="content" style="	margin:auto; margin-top:60px;	padding: 10px;	width:900px; !important">
     
<h1 style="color: #090 !important; margin:0px; padding:0px; font-size:20px !important; text-align:center; line-height:22px;" > Thank You for applying. A Bajaj Finserv Lending representative will get in touch with you.</h1>
<form method="POST" id="myForm" name="frm"  action="http://bflloans.force.com/ereferral" encType="application/x-www-form-urlencoded"> 
	<input type="hidden" name="user" id = 'userID' value="<?php echo $username;?>"/>
	<input type="hidden" name= "pwd" id = 'pwdID' value="<?php echo $pwd;?>"/>
	<input type="hidden" name="json-post-str" value="<?php echo $json;?>"/>
	<input type="hidden" name="redirectionURL" value="<?php echo $redirectionURL;?>"/>
	<input type="hidden" name="requestReferenceNumber" value="<?php echo $requestREF;?>"/>
	<!--<input type="submit" value="calculateEligibility"/>-->
</form>
	</div>
 <? if((strlen($bajajfinservcomp)>2 && $Employment_Status==1))
 { ?>
  <div class="content_b">
    <div class="list_box"><ul class="listing_text"><li>More Than <span style="font-size:18px; font-weight:bold;  color:#0199cd;">800 Customers</span> have applied in June</li>
 <li>Get  guaranteed gift items upto <span style="font-size:18px; font-weight:bold;  color:#0199cd;">17,200</span> on successful disbursal</li>
<li> 24 Hours Guaranteed Approval Else Cash Back <span style="font-size:18px; font-weight:bold;  color:#0199cd;">Rs. 1,000/-</span></li></ul>
    </div>
    
    <div style="clear:both; "></div>
    <div style=" padding-top:0px; margin:auto; margin-top:25px;"></div>
	</div>
    <? } ?>
</div>


</body>
</html>