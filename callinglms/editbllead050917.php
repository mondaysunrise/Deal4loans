<?php
require_once("includes/application-topbl.php");
session_start();
//businessloanlms1@deal4loans.com
//bllms@one

//$_SESSION['BidderID'] = 12345;
if($_SESSION['BidderID']=="")
{
	header("Location:login.php");
}

//print_r($_POST);
function ccMasking($number, $maskingCharacter = 'X') 
{
	return substr($number, 0, 2) . str_repeat($maskingCharacter, strlen($number) - 4) . substr($number, -2);
}
function BusinessDetailsValue($i)
{
	$BusinessDetails = array("1"=>"Business continuity proof â€“ 3 years  and  more income tax return & income statements", "2"=>"Last 2/3year audit re port and audited Financials", "3"=>"Last 6-12 months bank statements", "4"=>"In the case of transfer of a loan: Last 12 months ofÂ  loans statementÂ  along with the Sanction Letter of your previous bank", "5"=>"Any other loan statements on books of companies along with Sanction Letters", "6"=>"Last 12 months loan statement with Sanction Letter of any other existing loans", "7"=>"Business incorporation date proof â€“ PAN Card",    "8"=>"MOA(Memorandum of Association) and AOA (Articles of Association)", "9"=>"Latest shareholding pattern on company letterhead", "10"=>"List of current Directors on company letterhead", "11"=>"Certificate of Incorporation", "12"=>"Partnership Deed", "13"=>"Certificate of Registration", "14"=>"Proof of continuation:Â  Trade license /Establishment /Sales Tax certificate", "15"=>"Proof of continuation: Trade license /Establishment /Sales Tax certificate/ SSI Registration", "16"=>"Brief Business Profile on the Letter Head of the firm by the applicant", "17"=>"Copy of Tax Deduction Certificate 26 AS  / Form â€“ 16A (if applicable)", "18"=>"Copy of Advance Tax paid / Self Assessment Tax paid challan", "19"=>"Copy of Educational Qualification Certificate ( professional  loans ) ", "20"=>"Copy of Professional Practice Certificate", "21"=>"Salary Certificate (in case of doctors having salaried income)");
	return $BusinessDetails[$i];
}


function GrossTurnoverValue($i)
{
	$GrossTurnover = array("1"=>"Latest 2  Years ITRs' , Computation of Income, P&L, Balance sheet with all schedules with CA seal and sign", "2"=>"Tax Audit Report (Where Gross Turnover Exceeds Rs 1 Crs for Non Professional Self Employed and Gross Receipts Exceeds 25 Lacs incase of Professionals and )", "3"=>"Last 1 Year bank statements (with logo and Bank name) both Current and SB Account", "4"=>"Business Continuity Proof for 3 Yrs", "5"=>"Existing loan details and 6 months emi reflecting bank statement", "6"=>"Latest LOD,OS Letter and Last 12 Months SOA in case of BT Proposal", "7"=>"Partnership Deed & Latest list of partners & NOC as per Bank  bank format", "8"=>"In case applicant is a Partner- Partnership firm's audited ITR along with complete financials to be collected", "9"=>"Partnership Authority Letter on Letterhead of the Firm signed by all partners in case Firm to stand as guarantor", "10"=>"Incase applicant is a Director, then the company's  audited ITR along with complete financials to be collected", "11"=>"Board Resolution as per Bank  bank format- Incase company is applicant/guarantor", "12"=>"Certificate of Incorporation", "13"=>"MOA and AOA", "14"=>"DIN of all Directors to be collected where company is applicant,Co_Applicant or Guarantor to the Loan", "15"=>"Latest Share Holding Pattern");	
	return $GrossTurnover[$i];
}

//require '../scripts/pl_interest_rate_view.php';
//require 'personal_loan_eligibility_function_form.php';
//require '../scripts/personal_loan_bt_eligibility.php';

$post=$_REQUEST['id'];
$min_date =$_REQUEST['to'];
$max_date=$_REQUEST['from'];
$bidid =$_REQUEST['Bid'];
$leadident = $_REQUEST['leadident'];


function DetermineAgeGETDOB ($YYYYMMDD_In){

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
  } 
  elseif ($mdiff==0)
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

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		foreach($_POST as $a=>$b)
			$$a=$b;
			
		/* FIX STRINGS */
		$UserID = $_SESSION['UserID'];
		$plrequestid= $_POST['plrequestid'];
		$producttype=1;
		$fm_subcategory=$_POST['fm_subcategory'];
		$reg_year=$_POST['reg_year'];
		$plname =$_POST['plname'];
		$reg_month=$_POST['reg_month'];
		$purchase_date=$reg_month."-".$reg_year;
		$fm_category_id=$_POST['fm_category_id'];
		$renewal_date= $_POST['renewal_date'];
		$pltotal_experience = $_POST["pltotal_experience"];
		$plyears_in_company = $_POST["pltotal_experience"];
		$plmobile = $_POST["plmobile"];
		$plstd_code = $_POST["plstd_code"];
		$pllandline = $_POST["pllandline"];
		$plresidential_status = $_POST["plresidential_status"];
		$plemployment_status = $_POST["plemployment_status"];
		if($plemployment_status=="SEP" || $plemployment_status=="SENP")
		{
			$plemployment_status = 0;
		}
		$pllandline_o = $_POST["pllandline_o"];
		$plstd_code_o = $_POST["plstd_code_o"];
		$plnet_salary = $_POST["plnet_salary"];
		//$plcc_holder =$_POST["plcc_holder"];
		$plcc_holder = $_POST["plcc_holder"];
		$Loan_Any = $_POST["Loan_Any"];
		$emi_amt = $_POST["emi_amt"];
		$plcompany_name = $_POST["plcompany_name"];
//print_r ($Loan_Any)."<br>";
		$plemi_paid = $_POST["plemi_paid"];
		$plpincode = $_POST["plpincode"];
		$pldob=$_POST['pldob'];
		$plloan_amount = $_POST["plloan_amount"];
		$plcity = $_POST["plcity"];
		$plcity_other = $_POST["plcity_other"];
		$plactivation_code = $_POST["plactivation_code"];
		$plbidder_count = $_POST["plbidder_count"];
		$plfeedback = $_POST["plfeedback"];
		$FollowupDate = $_POST["FollowupDate"];
		$Final_Bidder = $_REQUEST['Final_Bidder'];
		$plCompany_Type = $_REQUEST['plCompany_Type'];
		$professional_details = $_REQUEST["professional_details"];
		$Bidder_Id = $_REQUEST['BidderId'];
		$pladd_comment= $_REQUEST['pladd_comment'];
		$Annual_Turnover= $_REQUEST['Annual_Turnover'];
		$Holding_Current_Account = $_REQUEST['Holding_Current_Account'];
		$panno = $_REQUEST['panno'];
				
$Final_Bid = "";
		while (list ($key,$val) = @each($Final_Bidder)) { 
			$Final_Bid = $Final_Bid."$val,"; 
		} 

$nn = count($Loan_Any);
			 $ii  = 0;
			while ($ii < $nn)
			{
			  $Loan_A .= "$Loan_Any[$ii], ";
			 $ii++;
			 }

$Final_Bid = substr($Final_Bid, 0, strlen($Final_Bid)-1); //remove the final comma sign from the final array
//echo "hello".$Final_Bid."<br>";
if(strlen($Final_Bid)>0)
	{
	$Allocated=2;
	}
	else 
	{
		$Allocated=0;
	}
	if($plemployment_status=='SEP' || $plemployment_status=='SENP')
	{
		$Emp_Status = $plemployment_status;
		$plemployment_status=0;	

	}
		
			
	if(strlen($Final_Bid)>0)
	{
	$updatelead="Update Req_Loan_Personal set PL_EMI_Paid='$PL_EMI_Paid',CC_Age='$professional_details',Annual_Turnover='$Annual_Turnover',Company_Type='$plCompany_Type',PL_Tenure= '$acc_no',Name='$plname',Accidental_Insurance='$Accidental_Insurance', Tataaig_Home='$tataaig_home',Tataaig_Health='$tataaig_health',Tataaig_Auto='$tataaig_auto',PL_EMI_Amt='$emi_amt',Company_Name='$plcompany_name', DOB='$pldob', Residential_Status='$plresidential_status',Email='$plemail', City='$plcity', Card_Limit='$plcard_limit', City_Other='$plcity_other', Mobile_Number='$plmobile', Std_Code='$plstd_code', Landline='$pllandline', Std_Code_O='$plstd_code_o', Landline_O='$pllandline_o', Net_Salary='$plnet_salary', Loan_Amount='$plloan_amount', Pincode='$plpincode', Employment_Status='$plemployment_status', CC_Holder='$plcc_holder', Card_Vintage='$plcard_vintage', Total_Experience='$pltotal_experience', Years_In_company='$plyears_in_company', Loan_Any='$Loan_A', Emi_Paid='$plemi_paid', Landline_Connection='$pllandline_connection', Salary_Drawn='$plsalary_drawn', Mobile_Connection='$plmobile_connection',Bidderid_Details='$Final_Bid',Add_Comment='$pladd_comment',Dated=Now(), Allocated='$Allocated',Primary_Acc='$Primary_Acc',Direct_Allocation=0,Existing_Bank='$pl_Existing_Bank',Existing_Loan='$pl_Existing_Loan',Existing_ROI='$pl_Existing_ROI', Holding_Current_Account='".$Holding_Current_Account."', Pancard='".$panno."' where RequestID=".$post;
	}
	else
	{
	$updatelead="Update Req_Loan_Personal set PL_EMI_Paid='$PL_EMI_Paid',CC_Age='$professional_details',Annual_Turnover='$Annual_Turnover',Company_Type='$plCompany_Type',PL_Tenure= '$acc_no',Name='$plname',Primary_Acc='$Primary_Acc', Tataaig_Home='$tataaig_home',Accidental_Insurance='$Accidental_Insurance', Tataaig_Health='$tataaig_health',Tataaig_Auto='$tataaig_auto', PL_EMI_Amt='$emi_amt',Company_Name='$plcompany_name', DOB='$pldob', Residential_Status='$plresidential_status',Email='$plemail', City='$plcity', Card_Limit='$plcard_limit', City_Other='$plcity_other', Mobile_Number='$plmobile', Std_Code='$plstd_code', Landline='$pllandline', Std_Code_O='$plstd_code_o', Landline_O='$pllandline_o', Net_Salary='$plnet_salary', Loan_Amount='$plloan_amount', Pincode='$plpincode', Employment_Status='$plemployment_status', CC_Holder='$plcc_holder', Card_Vintage='$plcard_vintage', Total_Experience='$pltotal_experience', Years_In_company='$plyears_in_company', Loan_Any='$Loan_A', Emi_Paid='$plemi_paid', Landline_Connection='$pllandline_connection', Salary_Drawn='$plsalary_drawn', Mobile_Connection='$plmobile_connection', Add_Comment='$pladd_comment',Direct_Allocation=0,Existing_Bank='$pl_Existing_Bank',Existing_Loan='$pl_Existing_Loan',Existing_ROI='$pl_Existing_ROI', Holding_Current_Account='".$Holding_Current_Account."', Pancard='".$panno."' where RequestID=".$post;
	}
		//echo "query".$updatelead;
	if($leadident=="hdfcbusinessloan")
	{
	}
	else
	{
	 $updateleadresult=$obj->fun_db_query($updatelead);
	}
	
	$CheckSql = "select RequestID from Req_Loan_Business_ED where RequestID = '".$post."'";
	$CheckQuery = $obj->fun_db_query($CheckSql);
	$CheckNumRows = $obj->fun_db_get_num_rows($CheckQuery);

	$Owner_Property = $_POST['Owner_Property'];
	$Urgency_Loan = $_POST['Urgency_Loan'];
	$reflecting_income = $_POST['reflecting_income'];
	$pl_amt = $_POST['pl_amt'];
	$pl_bank = $_POST['pl_bank'];
	$pl_emi_amt = $_POST['pl_emi_amt'];
	$pl_emi = $_POST['pl_emi'];
	$PL_Details = $pl_amt.",".$pl_bank.",".$pl_emi_amt.",".$pl_emi;
	
	$hl_amt = $_POST['hl_amt'];
	$hl_bank = $_POST['hl_bank'];
	$hl_emi_amt = $_POST['hl_emi_amt'];
	$hl_emi = $_POST['hl_emi'];
	$HL_Details = $hl_amt.",".$hl_bank.",".$hl_emi_amt.",".$hl_emi;
	
	$cl_amt = $_POST['cl_amt'];
	$cl_bank = $_POST['cl_bank'];
	$cl_emi_amt = $_POST['cl_emi_amt'];
	$cl_emi = $_POST['cl_emi'];
	$CL_Details = $cl_amt.",".$cl_bank.",".$cl_emi_amt.",".$cl_emi;
	
	$bl_amt = $_POST['bl_amt'];
	$bl_bank = $_POST['bl_bank'];
	$bl_emi_amt = $_POST['bl_emi_amt'];
	$bl_emi = $_POST['bl_emi'];
	$BL_Details = $bl_amt.",".$bl_bank.",".$bl_emi_amt.",".$bl_emi;
	
	$lap_amt = $_POST['lap_amt'];
	$lap_bank = $_POST['lap_bank'];
	$lap_emi_amt = $_POST['lap_emi_amt'];
	$lap_emi = $_POST['lap_emi'];
	$LAP_Details = $lap_amt.",".$lap_bank.",".$lap_emi_amt.",".$lap_emi;
	
	$cc_amt = $_POST['cc_amt'];
	$cc_bank = $_POST['cc_bank'];
	$cc_emi_amt = $_POST['cc_emi_amt'];
	$cc_emi = $_POST['cc_emi'];
	$CC_Details = $cc_amt.",".$cc_bank.",".$cc_emi_amt.",".$cc_emi;
	$ITR_Details = $_POST['ITR_Details'];

if($CheckNumRows>0)
{
	$sqlUpdate = "update Req_Loan_Business_ED set Emp_Status='".$Emp_Status."', Owner_Property='".$Owner_Property."', Urgency_Loan='".$Urgency_Loan."',reflecting_income='".$reflecting_income."', PL_Details='".$PL_Details."', HL_Details='".$HL_Details."', CL_Details='".$CL_Details."', BL_Details='".$BL_Details."', LAP_Details='".$LAP_Details."', CC_Details='".$CC_Details."', ITR_Details='".$ITR_Details."', Holding_Bank_Account='".$Holding_Bank_Account."', BankAccount='".$BankAccount."', Office_Property='".$Office_Property."', RegistrationProof='".$RegistrationProof."', VintageRegistration='".$VintageRegistration."' where RequestID='".$post."' ";
	$result = $obj->fun_db_query($sqlUpdate);	
}	 
else
{
	$sqlInsert = "INSERT INTO Req_Loan_Business_ED (RequestID, Emp_Status, Owner_Property, Urgency_Loan,reflecting_income, PL_Details, HL_Details, CL_Details, BL_Details, LAP_Details, CC_Details, ITR_Details, Holding_Bank_Account, BankAccount, Office_Property, RegistrationProof, VintageRegistration) VALUES ('".$post."', '".$Emp_Status."', '".$Owner_Property."', '".$Urgency_Loan."', '".$reflecting_income."', '".$PL_Details."', '".$HL_Details."', '".$CL_Details."', '".$BL_Details."', '".$LAP_Details."', '".$CC_Details."', '".$ITR_Details."', '".$Holding_Bank_Account."', '".$BankAccount."', '".$Office_Property."', '".$RegistrationProof."', '".$VintageRegistration."')";
	$result = $obj->fun_db_query($sqlInsert);
}	 

	 if(strlen($plfeedback)>0)
	{
		if($plfeedback=="Not Contactable" || $plfeedback=="Ringing" || $plfeedback=="Wrong Number" || $plfeedback=="Not Eligible")
		{
			$counter="1";
		}
		else
		{
			$counter="";
		}
		
		$SMSMessageplNE="Thanks for your application at Deal4loans.com. We are sorry and cannot process your application further due to certain profile and demographics reasons.";

		$strSQL="";
		$Msg="";
		$result = $obj->fun_db_query("select FeedbackID,not_contactable_counter from Req_Feedback_PL where AllRequestID=".$post." and BidderID=".$Bidder_Id." AND Reply_Type=1");		
		
		$num_rows = $obj->fun_db_get_num_rows($result);
		if($num_rows > 0)
		{	
			$row = $obj->fun_db_fetch_rs_array($result);
			$notcontactableCounter=$row["not_contactable_counter"];
		if($plfeedback=="Not Contactable" || $plfeedback=="Ringing" || $plfeedback=="Wrong Number" || $plfeedback=="Not Eligible")
			{
				$updatedcounter=$notcontactableCounter+1;
			}
			else
			{
				$updatedcounter=$notcontactableCounter;
			}

			$strSQL="Update Req_Feedback_PL Set Feedback='".$plfeedback."',not_contactable_counter='".$updatedcounter."',Followup_Date='".$FollowupDate."', Caller_Name='".$_SESSION['Caller_Name']."'";
			$strSQL=$strSQL."Where FeedbackID=".$row["FeedbackID"];

			if($plfeedback=="Not Eligible" && $updatedcounter==1)
						{
							$objAdmin->SendSMSforLMS($SMSMessageplNE, $plmobile);
						}

					$product="Personal Loan";	
				$feedback=$plfeedback;
					include "../scripts/feedbackmailerscript.php";

$headers = "From: deal4loans <no-reply@deal4loans.com>";
		 $semi_rand = md5( time() ); 
        $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 
         $headers .= "\nMIME-Version: 1.0\n" . 
                    "Content-Type: multipart/mixed;\n" . 
                    " boundary=\"{$mime_boundary}\""."\n";
		$headers .= "Bcc: testing4use@gmail.com"."\n";
	    $message2 = "This is a multi-part message in MIME format.\n\n" . 
                "--{$mime_boundary}\n" . 
                "Content-Type: text/html; charset=\"iso-8859-1\"\n" . 
                "Content-Transfer-Encoding: 7bit\n\n" . 
                $Message . "\n\n";
			
					if(((($feedback=="Not Contactable" || $feedback=="Ringing" || $feedback=="Wrong Number" ) && ($notcontactableCounter<1)) || ($feedback=="Not Interested") || ($feedback=="Not Eligible")) && (strlen($plemail)>0))
					{
				//	mail($plemail,'Thanks for Registering for '.$product.' on deal4loans.com', $message2, $headers);

					
					}
			}
		else
		{
			$strSQL="Insert into Req_Feedback_PL(AllRequestID, BidderID, Reply_Type , Feedback, Followup_Date,not_contactable_counter, Caller_Name) Values (";
			$strSQL=$strSQL.$post.",".$Bidder_Id.",1,'".$plfeedback."','".$FollowupDate."','".$counter."', '".$_SESSION['Caller_Name']."')";

			if($plfeedback=="Not Eligible")
				{
					$objAdmin->SendSMSforLMS($SMSMessageplNE, $plmobile);
				}

			$product="Personal Loan";	
		$feedback=$plfeedback;
					include "../scripts/feedbackmailerscript.php";
$headers = "From: deal4loans <no-reply@deal4loans.com>";
		 $semi_rand = md5( time() ); 
        $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 
         $headers .= "\nMIME-Version: 1.0\n" . 
                    "Content-Type: multipart/mixed;\n" . 
                    " boundary=\"{$mime_boundary}\""."\n";
		$headers .= "Bcc: testing4use@gmail.com"."\n";
	    $message2 = "This is a multi-part message in MIME format.\n\n" . 
                "--{$mime_boundary}\n" . 
                "Content-Type: text/html; charset=\"iso-8859-1\"\n" . 
                "Content-Transfer-Encoding: 7bit\n\n" . 
                $Message . "\n\n";
					if((($feedback=="Not Contactable" || $feedback=="Ringing" || $feedback=="Wrong Number" ) || ($feedback=="Not Interested") || ($feedback=="Not Eligible")) && (strlen($plemail)>0))
					{
						echo "hello2"."<br>";
				//		mail($plemail,'Thanks for Registering for '.$product.' on deal4loans.com', $message2, $headers);
					}
		}
		//echo $strSQL;
		$result = $obj->fun_db_query($strSQL);
		if ($result == 1)
		{
		}
		else
		{
			$Msg = "** There was a problem in adding your feedback. Please try again.";
		}
	}
}
?>
<!DOCTYPE html>
<head>
<link rel="stylesheet" type="text/css" href="/css/style.css">
<style type="text/css">
.smslead-wrapper{ margin:auto; width:950px; border:thin solid #CCC; border-collapse:collapse; padding:0px;}
@import url(https://fonts.googleapis.com/css?family=Open+Sans);
body{font-family: 'Open Sans', sans-serif; font-size:13px;}
.heading{ font-size:16px;}
tr, td{ padding:2px;}
.inputsms{ -webkit-transition: all 0.30s ease-in-out; border-radius:5px; height:22px;
  -moz-transition: all 0.30s ease-in-out; width:95%;
  -ms-transition: all 0.30s ease-in-out;
  -o-transition: all 0.30s ease-in-out;
  outline: none;
  padding: 3px 0px 3px 3px;
  margin: 5px 1px 3px 0px;
  border: 1px solid #DDDDDD;}
  .submit-sms{ width:150px; border-radius:5px; height:35px; background:#06C; color:#FFF; text-align:center; border:none;}
  
.inputsms:focus{  box-shadow: 0 0 5px rgba(81, 203, 238, 1);
  padding: 3px 0px 3px 3px;
  margin: 5px 1px 3px 0px;
  border: 1px solid rgba(81, 203, 238, 1);}
</style>
<link href="/includes/style.css" rel="stylesheet" type="text/css">
<script Language="JavaScript" Type="text/javascript" src="/scripts/common.js"></script>
<script language="javascript" type="text/javascript" src="/scripts/datetime.js"></script>
<script src='/scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<script type="text/javascript" src="/ajax.js"></script>
<script type="text/javascript" src="/ajax-dynamic-pllist.js"></script>
<script type="text/JavaScript">
/*
function killCopy(e){ return false; }
function reEnable(){return true; }
document.onselectstart=new Function ("return false");
if (window.sidebar){ document.onmousedown=killCopydocument.onclick=reEnable }
function clickIE4(){if (event.button==2){ return false; } }
function clickNS4(e){ if (document.layers||document.getElementById&&!document.all){ if (e.which==2||e.which==3){ return false;} } }
if (document.layers){ document.captureEvents(Event.MOUSEDOWN); document.onmousedown=clickNS4; } else if (document.all&&!document.getElementById){ document.onmousedown=clickIE4; }
document.oncontextmenu=new Function("return false")*/

</script>
</head>
<body>
<p align="center">Personal loan Lead Details</p>
<?php 
$viewqry="select CC_Age,Annual_Turnover,Holding_Current_Account, Pancard, Company_Type,PL_Bank,PL_Tenure, Name,Add_Comment,Mobile_Number,Landline,Landline_O,Std_Code,Std_Code_O,Net_Salary,Residential_Status,City,City_Other,Is_Valid,Dated,Employment_Status,Loan_Amount,Email,Contactable,source,Loan_Any,Pincode,SentEmail,Emi_Paid,CC_Holder,Card_Vintage,Followup_Date,Feedback,CC_Mailer,Company_Name,Total_Experience,Years_In_Company,DOB,Bidderid_Details,checked_bidders,Primary_Acc,Referral_Flag,Creative,Existing_Bank,Existing_Loan,Existing_ROI from Req_Loan_Personal LEFT OUTER JOIN Req_Feedback_PL ON Req_Feedback_PL.AllRequestID=Req_Loan_Personal.RequestID and Req_Feedback_PL.BidderID= '".$bidid."' where Req_Loan_Personal.RequestID=".$post." "; 
//echo "Query - ".$viewqry;
//echo "<br>";
$viewlead = $obj->fun_db_query($viewqry);
//print_R($viewlead);
$viewleadscount =$obj->fun_db_get_num_rows($viewlead);
//print_R($viewleadscount);
$Name = $obj->fun_get_mysql_result($viewlead,0,'Name');
$professional_details = $obj->fun_get_mysql_result($viewlead,0,'CC_Age');
$Add_Comment= $obj->fun_get_mysql_result($viewlead,0,'Add_Comment');
$Mobile = $obj->fun_get_mysql_result($viewlead,0,'Mobile_Number');
$Landline = $obj->fun_get_mysql_result($viewlead,0,'Landline');
$Landline_O = $obj->fun_get_mysql_result($viewlead,0,'Landline_O');
$Std_Code = $obj->fun_get_mysql_result($viewlead,0,'Std_Code');
$Std_Code_O = $obj->fun_get_mysql_result($viewlead,0,'Std_Code_O');
$Net_Salary = $obj->fun_get_mysql_result($viewlead,0,'Net_Salary');
$Residential_Status = $obj->fun_get_mysql_result($viewlead,0,'Residential_Status');
$City = $obj->fun_get_mysql_result($viewlead,0,'City');
$City_Other = $obj->fun_get_mysql_result($viewlead,0,'City_Other');
$Holding_Current_Account = $obj->fun_get_mysql_result($viewlead,0,'Holding_Current_Account');
$Pancard = $obj->fun_get_mysql_result($viewlead,0,'Pancard');
$Is_Valid = $obj->fun_get_mysql_result($viewlead,0,'Is_Valid');
$Dated = $obj->fun_get_mysql_result($viewlead,0,'Dated');
$Employment_Status = $obj->fun_get_mysql_result($viewlead,0,'Employment_Status');
$Loan_Amount = $obj->fun_get_mysql_result($viewlead,0,'Loan_Amount');
$Email = $obj->fun_get_mysql_result($viewlead,0,'Email');
$Contactable = $obj->fun_get_mysql_result($viewlead,0,'Contactable');
$source = $obj->fun_get_mysql_result($viewlead,0,'source');
$Loan_Any = $obj->fun_get_mysql_result($viewlead,0,'Loan_Any');
$Pincode = $obj->fun_get_mysql_result($viewlead,0,'Pincode');
$Emi_Paid = $obj->fun_get_mysql_result($viewlead,0,'Emi_Paid');
$CC_Holder = $obj->fun_get_mysql_result($viewlead,0,'CC_Holder');
$Card_Vintage = $obj->fun_get_mysql_result($viewlead,0,'Card_Vintage');
$followup_date = $obj->fun_get_mysql_result($viewlead,0,'Followup_Date');
$Feedback = $obj->fun_get_mysql_result($viewlead,0,'Feedback');
$Company_Name = $obj->fun_get_mysql_result($viewlead,0,'Company_Name');
$Total_Experience = $obj->fun_get_mysql_result($viewlead,0,'Total_Experience');
$Years_In_Company = $obj->fun_get_mysql_result($viewlead,0,'Years_In_Company');
$DOB = $obj->fun_get_mysql_result($viewlead,0,'DOB');
$Bidderid_Details = $obj->fun_get_mysql_result($viewlead,0,'Bidderid_Details');
$checked_bidders = $obj->fun_get_mysql_result($viewlead,0,'checked_bidders');
list($mainync,$last) = explode('.', $Years_In_Company);

//echo "i m here";
if($Referral_Flag==0)
{
	$Referral_Flag = $obj->fun_get_mysql_result($viewlead,0,'Creative');
}
$Company_Type = $obj->fun_get_mysql_result($viewlead,0,'Company_Type');
$checked_bidders = explode(",",$checked_bidders);
$Loan_Any = substr($Loan_Any, 0, strlen($Loan_Any)-1); 
$getDOB =DetermineAgeGETDOB($DOB);
$Annual_Turnover =  $obj->fun_get_mysql_result($viewlead,0,'Annual_Turnover');
$PL_Bank = $obj->fun_get_mysql_result($viewlead,0,'PL_Bank');
$Existing_Bank = $obj->fun_get_mysql_result($viewlead,0,'Existing_Bank');
$Existing_ROI = $obj->fun_get_mysql_result($viewlead,0,'Existing_ROI');
$Existing_Loan = $obj->fun_get_mysql_result($viewlead,0,'Existing_Loan');

$edSql = "select RequestID, Emp_Status, Owner_Property, Urgency_Loan,reflecting_income, PL_Details, HL_Details, CL_Details, BL_Details, LAP_Details, CC_Details, ITR_Details, Holding_Bank_Account, BankAccount, Office_Property, RegistrationProof, VintageRegistration  from Req_Loan_Business_ED where RequestID = '".$post."'";
$viewleadsbled = $obj->fun_db_query($edSql);
//$viewleadsbled =$obj->fun_db_get_num_rows($viewbled);
$viewEmp_Status = $obj->fun_get_mysql_result($viewleadsbled,0,'Emp_Status');
$viewOwner_Property = $obj->fun_get_mysql_result($viewleadsbled,0,'Owner_Property');
$viewUrgency_Loan = $obj->fun_get_mysql_result($viewleadsbled,0,'Urgency_Loan');
$viewreflecting_income = $obj->fun_get_mysql_result($viewleadsbled,0,'reflecting_income');
$PL_Details = $obj->fun_get_mysql_result($viewleadsbled,0,'PL_Details');
$PL_DetailsArr = explode(",",$PL_Details);
$viewpl_amt = $PL_DetailsArr[0];
$viewpl_bank = $PL_DetailsArr[1];
$viewpl_emi_amt = $PL_DetailsArr[2];
$viewpl_emi = $PL_DetailsArr[3];
$HL_Details = $obj->fun_get_mysql_result($viewleadsbled,0,'HL_Details');
$HL_DetailsArr = explode(",",$HL_Details);
$viewhl_amt = $HL_DetailsArr[0];
$viewhl_bank = $HL_DetailsArr[1];
$viewhl_emi_amt = $HL_DetailsArr[2];
$viewhl_emi = $HL_DetailsArr[3];
$CL_Details = $obj->fun_get_mysql_result($viewleadsbled,0,'CL_Details');
$CL_DetailsArr = explode(",",$CL_Details);
$viewcl_amt = $CL_DetailsArr[0];
$viewcl_bank = $CL_DetailsArr[1];
$viewcl_emi_amt = $CL_DetailsArr[2];
$viewcl_emi = $CL_DetailsArr[3];
$BL_Details = $obj->fun_get_mysql_result($viewleadsbled,0,'BL_Details');
$BL_DetailsArr = explode(",",$BL_Details);
$viewbl_amt = $BL_DetailsArr[0];
$viewbl_bank = $BL_DetailsArr[1];
$viewbl_emi_amt = $BL_DetailsArr[2];
$viewbl_emi = $BL_DetailsArr[3];
$LAP_Details = $obj->fun_get_mysql_result($viewleadsbled,0,'LAP_Details');
$LAP_DetailsArr = explode(",",$LAP_Details);
$viewlap_amt = $LAP_DetailsArr[0];
$viewlap_bank = $LAP_DetailsArr[1];
$viewlap_emi_amt = $LAP_DetailsArr[2];
$viewlap_emi = $LAP_DetailsArr[3];
$CC_Details = $obj->fun_get_mysql_result($viewleadsbled,0,'CC_Details');
$CC_DetailsArr = explode(",",$CC_Details);
$viewcc_amt = $CC_DetailsArr[0];
$viewcc_bank = $CC_DetailsArr[1];
$viewcc_emi_amt = $CC_DetailsArr[2];
$viewcc_emi = $LAP_DetailsArr[3];
$viewITR_Details = $obj->fun_get_mysql_result($viewleadsbled,0,'ITR_Details');

$Holding_Bank_Account = $obj->fun_get_mysql_result($viewleadsbled,0,'Holding_Bank_Account');
$BankAccount = $obj->fun_get_mysql_result($viewleadsbled,0,'BankAccount');
$Office_Property = $obj->fun_get_mysql_result($viewleadsbled,0,'Office_Property');
$RegistrationProof = $obj->fun_get_mysql_result($viewleadsbled,0,'RegistrationProof');
$VintageRegistration = $obj->fun_get_mysql_result($viewleadsbled,0,'VintageRegistration');

//echo "cName: ".$Company_Name;
$icici_bankcmp="";
$stanc_account="";
$ingvyasyacategory="";
$bajajfinservcategory="";
$hdbfscategorycmp="";
$hdfccategory="";
$standard_charteredcategory="";
$bajajfinserv="";
$Indusind="";
$citicategorycmp="";
$stanc_category="";
$getcompany='select * from pl_company_list where ((company_name="'.$Company_Name.'"))';
//$getcompany."<br>";
$getcompanyresult = $obj->fun_db_query($getcompany);
$grow=$obj->fun_db_fetch_rs_array($getcompanyresult);
$recordcount = $obj->fun_db_get_num_rows($getcompanyresult);
$hdfccategory= $grow["hdfc_bank"];
$fullertoncategory= $grow["fullerton"];
$bajajfinservcategory= $grow["bajajfinserv"];
$citicategorycmp= $grow["citibank"];
$hdbfscategorycmp = $grow["hdbfs"];
$icici_bankcmp = $grow["icici_bank"];
$ingvyasyacategory = $grow["ingvyasya"];
$kotakcategory = $grow["kotak"];
$stanc_category= $grow["standard_chartered"];
$tatacapitalcomp = $grow["tatacapital"];
$Indusind = $grow["Indusind"];
if(($Primary_Acc=="Citibank" || $Primary_Acc=="citibank" || $Primary_Acc=="Citi Bank") || (strlen($citicategorycmp)>2))
{
	$citicategory= "Done";
	$citicategory_n= "Done";
}
else
{
	$citicategory= "";
	$citicategory_n="";
}
//echo $citicategory."<br>";
$barclayscategory= $grow["barclays"];

if($Primary_Acc=="Standard Chartered")
{
	$standard_charteredcategory= "Done";
	$stanc_account="Done";
}
else
{
$standard_charteredcategory = $stanc_category;
	$stanc_account="";
}

$monthsalary = $Net_Salary/12;
if($Bidder_Count!=0)
{
	$strbidderid="";
	$z=0;
$retrieve_query="select BidderID from Req_Feedback_Bidder_PL where AllRequestID=".$post." and Reply_Type=1";
//echo $retrieve_query."<br>";
	$retrieve_result = $obj->fun_db_query($retrieve_query);
	$retrieve_recordcount =$obj->fun_db_get_num_rows($retrieve_result);
	for($r=0;$r<$retrieve_recordcount;$r++)
	{
		$BidderID12 = $obj->fun_get_mysql_result($retrieve_result,$r,'BidderID');
		$strbidderid = $strbidderid.$BidderID12.",";
	}	
}
?>
<style>
.fontstyle
	{
		font-family:Verdana Arial, Helvetica, sans-serif;
		font-size:12px;
	}
</style>
<script language="javascript">
function getProfDetails()
{
	if(document.loan_form.plemployment_status.value=='SEP')
	{
	//	document.getElementById('pDetails').innerHTML =	'';
		document.getElementById('pDetailsField').innerHTML = '<select name="professional_details" class="inputsms" id="professional_details" style="height:28px;">          <option value="0" <? if($professional_details=="0") { echo "Selected";} ?> >Please Select</option>          <option value="1" <? if($professional_details=="1") { echo "Selected";} ?>>Businessmen</option>          <option value="2" <? if($professional_details=="2") { echo "Selected";} ?> >Doctor</option>          <option value="3" <? if($professional_details=="3") { echo "Selected";} ?> >Engineer</option>          <option value="4" <? if($professional_details=="4") { echo "Selected";} ?> >Architect</option>          <option value="5" <? if($professional_details=="5") { echo "Selected";} ?> >Chartered Accountant</option>        </select>';
		}
	else
	{
		//document.getElementById('pDetails').innerHTML =	'';
		document.getElementById('pDetailsField').innerHTML =	'<select name="professional_details" class="inputsms" id="professional_details" style="height:28px;">   </select>';
	}
}

function getTypeFields()
{
	if(document.loan_form.ITR_filing.value=='1')
	{
		document.getElementById('typeITR').innerHTML =	'<b>Type  of ITRs</b>';
		document.getElementById('typeITRField').innerHTML =	'<select name="ITR_Details" style="height:28px; width:250px;"><option value="">Select</option><option value="1" <?php if($viewITR_Details==1) { echo "selected"; } ?>>Normal (Under section 44 AD)</option><option value="2" <?php if($viewITR_Details==2) { echo "selected"; } ?>>Calculator - Normal Eligibility crietria</option></select>';
	}
	else if(document.loan_form.ITR_filing.value=='0')
	{
		document.getElementById('typeITR').innerHTML =	'<b>ITRS  are not being filed</b>';
		document.getElementById('typeITRField').innerHTML =	'<select name="ITR_Details" style="height:28px; width:250px;"><option value="">Select</option><option value="3" <?php if($viewITR_Details==3) { echo "selected"; } ?>>You can be funded if you  are  running business  purely on cash basis</option><option value="4" <?php if($viewITR_Details==4) { echo "selected"; } ?>>You can be funded if you  are running business  vide your SA/CA</option><option value="5" <?php if($viewITR_Details==5) { echo "selected"; } ?>>You can be funded if you  are  having an existing  AL/PL/LAP/HL where  you have paid more than 6-12 months</option><option value="6" <?php if($viewITR_Details==6) { echo "selected"; } ?>>You can be funded if you are a SEP & have a tentative record of Gross reciepts/fees</option></select>';
	}
}


</script>
<div class="smslead-wrapper">
<form name="loan_form" method="post" action="<? echo $_SERVER['PHP_SELF'] ?>?id=<?php echo $post;?>&Bid=<? echo $bidid;?>&to=<? echo $min_date?>&from=<? echo $max_date;?>" >
<input type="hidden" name="BidderId" value="<? echo $bidid;?>">
<input type="hidden" name="plrequestid" id="plrequestid" value="<? echo $post;?>">
<input type="hidden" name="leadident" id="leadident" value="<? echo $leadident;?>">
  <table cellspacing="2" cellpadding="0" width="100%" align="center" border="0" >
      <tr>
      <td colspan="4" align="center" bgcolor="#F0F0F0" class="heading" style="border-top:1px solid #CCC; border-bottom:1px solid #CCC;"><strong>Personal Details</strong></td>
    </tr>
    <tr>
      <td width="170" valign="top"> <strong>Name</strong></td>
      <td  width="286" align="left" valign="top"><input name="plname" type="text" class="inputsms" id="plname" value="<?php echo $Name;?>"></td>
      <td  width="205" valign="top"><strong>Email id</strong></td>
      <td  width="279"><input name="plemail" type="text" class="inputsms" id="plemail" value="<?php echo $Email;?>"></td>
    </tr>
     <tr>
      <td valign="top" bgcolor="#F0F0F0" ><strong>DOB</strong></td>
      <td align="left" valign="top" bgcolor="#F0F0F0" ><input name="pldob" type="text" class="inputsms" id="pldob" value="<? echo $DOB;?>"size="10" style=" width:90%; " > <a href="javascript:NewCal('pldob','yyyymmdd',false,24)"><img src="../images/cal.gif" width="16" height="16" border="0" alt="Pick a date"></a></td>
      <td valign="top" bgcolor="#F0F0F0" ><strong>Mobile</strong></td>
      <td bgcolor="#F0F0F0" >+91
        <input type="hidden" name="plmobile" size="15" value="<? echo $Mobile;?>"> <?php if($leadident=="hdfcbusinessloan") {echo $Mobile;} else { echo ccMasking($Mobile);} ?></td>
    </tr>
    <tr>
      <td valign="top" ><strong>City</strong></td>
      <td align="left" valign="top" ><select name="plcity" size="1" class="inputsms" id="plcity" style="height:28px;">
          <?=plgetCityList($City)?>
        </select></td>
      <td valign="top" ><strong>Other City</strong></td>
      <td ><input name="plcity_other" type="text" class="inputsms" id="plcity_other" value="<?php echo $City_Other;?>" size="10" ></td>
    </tr>
    <tr>
      <td valign="top" bgcolor="#F0F0F0" ><strong>Residence Status</strong></td>
      <td align="left" valign="top" bgcolor="#F0F0F0" ><select name="plresidential_status" class="inputsms" id="plresidential_status" style="height: 28px;">
          <option value="0">Please Select</option>
          <option value="4" <? if($Residential_Status==4){ echo "Selected";} ?> >Owned By Self/Spouse</option>
          <option value="1" <? if($Residential_Status==1){ echo "Selected";} ?> >Owned By Parent/Sibling</option>
          <option value="3" <? if($Residential_Status==3){ echo "Selected";} ?> >Company Provided</option>
          <option value="5" <? if($Residential_Status==5){ echo "Selected";} ?> >Rented - With Family</option>
          <option value="6" <? if($Residential_Status==6){ echo "Selected";} ?> >Rented - With Friends</option>
          <option value="2" <? if($Residential_Status==2){ echo "Selected";} ?>>Rented - Staying Alone</option>
          <option value="7" <? if($Residential_Status==7){ echo "Selected";} ?>>Paying Guest</option>
          <option value="8" <? if($Residential_Status==8){ echo "Selected";} ?>>Hostel</option>
        </select></td>
      <td bgcolor="#F0F0F0" ><strong>Ownership  of property in the City</strong></td>
      <td bgcolor="#F0F0F0"><select name="Owner_Property" class="inputsms" id="Owner_Property" style="height: 28px;">
          <option value="0">Please Select</option>
          <option value="1" <? if($viewOwner_Property==1){ echo "Selected";} ?>>Commercial</option>
          <option value="2" <? if($viewOwner_Property==2){ echo "Selected";} ?>>Residential</option>
          </select></td>
    </tr>
	<tr>
<td bgcolor="#F0F0F0" ><strong>Ownership of Office Property</strong></td>
      <td bgcolor="#F0F0F0"><select name="Office_Property" class="inputsms" id="Office_Property" style="height: 28px;">
          <option value="0">Please Select</option>
          <option value="Owned" <? if($Office_Property=="Owned"){ echo "Selected";} ?>>Owned</option>
          <option value="Rented" <? if($Office_Property=="Rented"){ echo "Selected";} ?>>Rented</option>
          </select></td>
    </tr>
    
 <tr>
      <td colspan="4" align="center" bgcolor="#F0F0F0" class="heading" style="border-top:1px solid #CCC; border-bottom:1px solid #CCC;"><strong>Employment Details</strong></td>
    </tr>
    <tr>
      <td valign="top"><strong>Employment Status</strong></td>
      <td align="left" valign="top" ><select class="inputsms" name="plemployment_status" id="plemployment_status" style="height:28px;" on onChange="getProfDetails();">
          <option value="1" <? if($Employment_Status ==1){echo "selected"; }?>>Salaried</option>
          <option value="0" <? if($Employment_Status ==0) {echo "selected"; }?>>Self Employed</option>
          <option value="SEP" <?php if($viewEmp_Status=='SEP') echo $selected; ?>>Self Employed Professional</option>
      	  <option value="SENP" <?php if($viewEmp_Status=='SENP') echo $selected; ?>>Self Employed Non Professional</option>
        </select></td>
      <td valign="top" ><strong>Annual Income</strong></td>
      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td colspan="2"></td>
        </tr>
        <tr>
          <td><input type="radio" name="plnet_salary" id="IncomeAmount1" value="200000" class="css-checkbox" onClick="validateDiv('NetSalaryVal')" <? if($Net_Salary>=200000 && $Net_Salary<250000) { echo "checked"; } ?>/>
            <label for="IncomeAmount1" class="css-label radGroup2">Upto 2 Lacs</label><br>
            <input type="radio" name="plnet_salary" id="IncomeAmount2" value="250000" class="css-checkbox" onClick="validateDiv('NetSalaryVal')" <? if($Net_Salary>=250000 && $Net_Salary<450000) { echo "checked"; } ?>/>
            <label for="IncomeAmount2" class="css-label radGroup2">2 To 3 Lacs</label></td>
          <td><input type="radio" name="plnet_salary" id="IncomeAmount3" value="450000" class="css-checkbox" onClick="validateDiv('NetSalaryVal')" <? if($Net_Salary>=450000 && $Net_Salary<550000) { echo "checked"; } ?>/>
            <label for="IncomeAmount3" class="css-label radGroup2">3 To 5 Lacs</label><br>
            <input type="radio" name="plnet_salary" id="IncomeAmount4" value="550000" class="css-checkbox" onClick="validateDiv('NetSalaryVal')" <? if($Net_Salary>=550000) { echo "checked"; } ?>/>
            <label for="IncomeAmount4" class="css-label radGroup2">5 Lacs & Above</label></td>
        </tr>
      </table></td>
    </tr>
    
    <tr>
      <td valign="top" bgcolor="#F0F0F0" id="pDetails"><strong>Professional details</strong></td>
      <td align="left" valign="top" bgcolor="#F0F0F0" id="pDetailsField">
     <select name="professional_details" class="inputsms" id="professional_details" style="height:28px;">
      
        </select>
     </td>
      <td valign="top" bgcolor="#F0F0F0"><strong>Annual Turnover</strong></td>
      <td bgcolor="#F0F0F0">
	   <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="45%"><input type="radio" name="Annual_Turnover" id="Annual_Turnover1" value="1" class="css-checkbox" onClick="validateDiv('AnnualTurnoverVal')" <? if($Annual_Turnover==1) { echo "checked"; } ?> />
            <label for="Annual_Turnover1" class="css-label radGroup2">0-20 lacs </label><br>
            <input type="radio" name="Annual_Turnover" id="Annual_Turnover2" value="2" class="css-checkbox" onClick="validateDiv('AnnualTurnoverVal')" <? if($Annual_Turnover==2) { echo "checked"; } ?>/>
            <label for="Annual_Turnover2" class="css-label radGroup2">20-50 Lacs</label><br> 
</td>
    <td width="55%"><input type="radio" name="Annual_Turnover" id="Annual_Turnover3" value="3" class="css-checkbox" onClick="validateDiv('AnnualTurnoverVal')" <? if($Annual_Turnover==3) { echo "checked"; } ?> />
            <label for="Annual_Turnover3" class="css-label radGroup2" >50-80 Lacs</label><br>
            <input type="radio" name="Annual_Turnover" id="Annual_Turnover4" value="4" class="css-checkbox" onClick="validateDiv('AnnualTurnoverVal')" <? if($Annual_Turnover==4) { echo "checked"; } ?>/>
            <label for="Annual_Turnover4" class="css-label radGroup2">80-150 Lacs</label></td>
  </tr>
  
</table>
       </td>
    </tr>
    
  <tr>
    <tr>
      <td valign="top" ><strong>Vintage</strong></td>
      <td ><input type="radio" name="pltotal_experience" id="running_business2" value="2.5" class="css-checkbox" onClick="validateDiv('TotalExperienceVal')" <? if($Total_Experience>=2 && $Total_Experience<4) { echo "checked"; } ?> />
            0
              <label for="running_business2" class="css-label radGroup2"> To 3 Yrs</label>
          <input type="radio" name="pltotal_experience" id="running_business3" value="4" class="css-checkbox" onClick="validateDiv('TotalExperienceVal')" <? if($Total_Experience>=4  && $Total_Experience<5) { echo "checked"; } ?> />
            <label for="running_business3" class="css-label radGroup">3 To 5 Yrs</label>&nbsp;&nbsp;
        <input type="radio" name="pltotal_experience" id="running_business4" value="5" class="css-checkbox" onClick="validateDiv('TotalExperienceVal')" <? if($Total_Experience>=5) { echo "checked"; } ?> />
        <label for="running_business4" class="css-label radGroup2">5 Yrs & Above</label></td>
         <td valign="top" ><strong>Reflecting Complete Income</strong></td>
          <td valign="top" ><input type="radio" name="reflecting_income" id="reflecting_income1" value="1" class="css-checkbox"  <? if($reflecting_income==1) { echo "checked"; } ?> />
            <label for="reflecting_income1" class="css-label radGroup2">Yes</label>
            &nbsp;&nbsp;<input type="radio" name="reflecting_income" id="reflecting_income2" value="0" class="css-checkbox" <? if($reflecting_income==0) { echo "checked"; } ?> />
            <label for="reflecting_income2" class="css-label radGroup2">No</label></td>
      </tr>  
    <tr>
      <td valign="top" bgcolor="#F0F0F0" ><strong>Are you Filling ITR</strong></td>
      <td valign="top" bgcolor="#F0F0F0" ><input type="radio" name="ITR_filing" id="ITR_filing1" value="1" class="css-checkbox" <? if($ITR_filing==1) { echo "checked"; } ?>  onClick="getTypeFields();" />
            <label for="ITR_filing1" class="css-label radGroup2">Yes</label>
            &nbsp;&nbsp;<input type="radio" name="ITR_filing" id="ITR_filing2" value="0" class="css-checkbox"  <? if($ITR_filing==0) { echo "checked"; } ?> onClick="getTypeFields();" />
            <label for="ITR_filing2" class="css-label radGroup2">No</label></td>
      <td valign="top" bgcolor="#F0F0F0" id="typeITR" ><b><?php if($ITR_filing==1) { ?>Type  of ITRs<?php } else { ?>ITRS are not being filed<?php } ?></b></td>
      <td bgcolor="#F0F0F0" id="typeITRField" ><?php if($ITR_filing==1) { ?><select name="ITR_Details" style="height:28px; width:250px;"><option value="">Select</option><option value="1" <?php if($viewITR_Details==1) { echo "selected"; } ?>>Normal (Under section 44 AD)</option><option value="2" <?php if($viewITR_Details==2) { echo "selected"; } ?>>Calculator - Normal Eligibility crietria</option></select><?php } else { ?><select name="ITR_Details"  style="height:28px; width:250px;"><option value="">Select</option><option value="3" <?php if($viewITR_Details==3) { echo "selected"; } ?>>You can be funded if you  are  running business  purely on cash basis</option><option value="4" <?php if($viewITR_Details==4) { echo "selected"; } ?>>You can be funded if you  are running business  vide your SA/CA</option><option value="5" <?php if($viewITR_Details==5) { echo "selected"; } ?>>You can be funded if you  are  having an existing  AL/PL/LAP/HL where  you have paid more than 6-12 months</option><option value="6" <?php if($viewITR_Details==6) { echo "selected"; } ?>>You can be funded if you are a SEP & have a tentative record of Gross reciepts/fees</option></select><?php } ?></td>
      </tr>
    <tr>
          <td width="25%"  ><strong>Company Type</strong></td>
          <td width="30%"  ><select name="plCompany_Type" id="plCompany_Type" style="width: 190px;">
		  <option value="0" <? if($Company_Type==0) {echo "selected";} ?>>Please Select</option>
		  	<option value="1" <? if($Company_Type==1) {echo "selected";} ?>>Pvt Ltd</option>
			<option value="8" <? if($Company_Type==8) {echo "selected";} ?>>Partnership</option>
			<option value="9" <? if($Company_Type==9) {echo "selected";} ?>>LLP</option>
		<option value="7" <? if($Company_Type==7) {echo "selected";} ?>>SP </option>
			</select></td>
          <td width="21%"  ><strong>Urgency  of loan</strong></td>
          <td width="24%"  ><select name="Urgency_Loan" style="height:28px; width:250px;"><option value="">Select</option><option value="1" <?php if($viewUrgency_Loan==1) { echo "selected"; } ?>>3-5 working days</option><option value="2" <?php if($viewUrgency_Loan==2) { echo "selected"; } ?>>5-7 working days</option><option value="3" <?php if($viewUrgency_Loan==3) { echo "selected"; } ?>>>7 working days</option></select></td>
      </tr>
        <tr>
          <td width="25%"  ><strong>Holding Current Account</strong></td>
          <td width="30%"  >  <input type="radio" name="Holding_Current_Account" id="Holding_Current_Account1" value="1" class="css-checkbox"  <? if($Holding_Current_Account==1) { echo "checked"; } ?>  />            <label for="Holding_Current_Account1" class="css-label radGroup2">Yes</label>            <input type="radio"name="Holding_Current_Account" id="Holding_Current_Account2" value="0" class="css-checkbox"  <? if($Holding_Current_Account==0) { echo "checked"; } ?> />            <label for="Holding_Current_Account2" class="css-label radGroup2">No </label>    </td>
          <td width="21%"  ><strong>Pancard</strong></td>
          <td width="24%"  ><input type="text" class="d4l-input" name="panno" id="panno" value="<? echo $Pancard ;?>"  maxlength="10"/></td>
      </tr>
        <tr>
          <td width="25%"  ><strong>Holding Bank Account</strong></td>
          <td width="30%"  >  <input type="radio" name="Holding_Bank_Account" id="Holding_Bank_Account1" value="1" class="css-checkbox"  <? if($Holding_Bank_Account==1) { echo "checked"; } ?>  />            <label for="Holding_Bank_Account1" class="css-label radGroup2">Saving</label>            <input type="radio"name="Holding_Bank_Account" id="Holding_Bank_Account2" value="0" class="css-checkbox"  <? if($Holding_Bank_Account==0) { echo "checked"; } ?> />            <label for="Holding_Bank_Account2" class="css-label radGroup2">Current </label>    </td>
          <td width="21%"  ><strong>Name of Bank </strong></td>
          <td width="24%"  >
          <select name="BankAccount" id="BankAccount" style="width: 190px;">
		  <option value="0" <? if($BankAccount=='') {echo "selected";} ?>>Please Select</option>
		  <option value="RBL" <? if($BankAccount=='RBL') {echo "selected";} ?>>RBL</option>
		  <option value="HDFC Bank" <? if($BankAccount=='HDFC Bank') {echo "selected";} ?>>HDFC Bank</option>
		  <option value="CFL" <? if($BankAccount=='CFL') {echo "selected";} ?>>CFL</option>
		  <option value="Fullerton" <? if($BankAccount=='Fullerton') {echo "selected";} ?>>Fullerton</option>
		  <option value="ICICI Bank" <? if($BankAccount=='ICICI Bank') {echo "selected";} ?>>ICICI Bank</option>
		  <option value="Edelweiss" <? if($BankAccount=='Edelweiss') {echo "selected";} ?>>Edelweiss</option>
		  <option value="Aditya Birla" <? if($BankAccount=='Aditya Birla') {echo "selected";} ?>>Aditya Birla</option>
		  <option value="CFL(BIL)" <? if($BankAccount=='CFL(BIL)') {echo "selected";} ?>>CFL(BIL)</option>
		  <option value="Others" <? if($BankAccount=='Others') {echo "selected";} ?>>Others</option>
		  </select>  
          </td>
      </tr>
          <tr>
          <td width="25%"  ><strong>Registration Proof</strong></td>
          <td width="30%"  >  <input type="radio" name="RegistrationProof" id="RegistrationProof" value="1" class="css-checkbox"  <? if($RegistrationProof==1) { echo "checked"; } ?>  />            <label for="RegistrationProof" class="css-label radGroup2">Yes</label> <input type="radio"name="RegistrationProof" id="RegistrationProof" value="0" class="css-checkbox"  <? if($RegistrationProof==0) { echo "checked"; } ?> />            <label for="RegistrationProof2" class="css-label radGroup2">No</label>    </td>
          <td width="21%"  ><strong>Vintage of Registration Proof</strong></td>
          <td width="24%"  >
          <select name="VintageRegistration" id="VintageRegistration" style="width: 190px;">
		  <option value="0" <? if($VintageRegistration=='') {echo "selected";} ?>>Please Select</option>
		  <option value="0 - 2 Years" <? if($VintageRegistration=='0 - 2 Years') {echo "selected";} ?>>0 - 2 Years</option>
		  <option value="2 - 4 Years" <? if($VintageRegistration=='2 - 4 Years') {echo "selected";} ?>>2 - 4 Years</option>
		  <option value="4 Years and Above" <? if($VintageRegistration=='4 Years and Above') {echo "selected";} ?>>4 Years and Above</option>
		</select>  
          </td>
      </tr>
    
       <tr>
      <td colspan="4" align="center" bgcolor="#F0F0F0" class="heading"  style="border-top:1px solid #CCC; border-bottom:1px solid #CCC;"><strong>Surrogate Details</strong></td>
    </tr>
  <tr>
      <td valign="top"><strong>Existing Loan</strong></td>
      <td valign="top" colspan="3"><table width="100%" border="0" cellspacing="0">
        <tr>
          <td width="22%" bgcolor="#F3F3F3" ><input type="checkbox" id="Loan_Any" name="Loan_Any[]" class="noBrdr" value="hl" <?php if((strlen(strpos($Loan_Any, "hl")) > 0)) echo "checked"; ?>>
            Home Loan</td>
          <td width="28%" bgcolor="#F3F3F3" ><input type="checkbox" class="noBrdr" id="Loan_Any" name="Loan_Any[]" value="pl" <?php if((strlen(strpos($Loan_Any, "pl")) > 0)) echo "checked"; ?>>
            Personal Loan</td>
          <td width="19%" bgcolor="#F3F3F3" ><input type="checkbox" id="Loan_Any" name="Loan_Any[]" class="noBrdr"  value="cl" <?php if((strlen(strpos($Loan_Any, "cl")) > 0)) echo "checked"; ?>>
            Car Loan</td>
          <td width="10%" bgcolor="#F3F3F3" ><input type="checkbox" name="Loan_Any[]" id="Loan_Any" class="noBrdr" value="lap" <?php if((strlen(strpos($Loan_Any, "lap")) > 0)) echo "checked"; ?>>
            LAP</td>
            <td width="21%" bgcolor="#F3F3F3" ><input type="checkbox" name="Loan_Any[]" id="Loan_Any" class="noBrdr" value="bl" <?php if((strlen(strpos($Loan_Any, "bl")) > 0)) echo "checked"; ?>>
            Business Loan</td>
          </tr>   
      </table></td>
      </tr>
 <tr>
      <td valign="top" colspan="4"><table width="100%" border="0" cellspacing="0" style="border:#999 1px solid;">
<tr>
 <td align="right"><strong>Personal Loan</strong></td><td>Loan Amt - <input type="text" name="pl_amt" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" value="<?php echo $viewpl_amt; ?>" ></td><td>Bank Name - <input type="text" name="pl_bank" value="<?php echo $viewpl_bank; ?>" ></td>
 <td >EMI - 
   <input type="text" name="pl_emi_amt" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" value="<?php echo $viewpl_emi_amt; ?>"  ></td><td >No of EMI - <select name="pl_emi" ><option value="0">Please Select</option>
   <?php for($i=1;$i<8;$i++) { ?>
   <option value="<?php echo $i; ?>" <?php if($i==$viewpl_emi) echo "selected";?>><?php echo $i; ?><?php if($i==1){ echo "Year"; } else { "Years"; } ?></option>
   <?php } ?>
   </select></td>
            </tr>
<tr>
 <td align="right" bgcolor="#999999"><strong>Home Loan</strong></td><td bgcolor="#999999">Loan Amt - <input type="text" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" name="hl_amt" value="<?php echo $viewhl_amt; ?>" ></td><td bgcolor="#999999">Bank Name - <input type="text" name="hl_bank" value="<?php echo $viewhl_bank; ?>" ></td>
 <td bgcolor="#999999" >EMI - 
    <input type="text" name="hl_emi_amt" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" value="<?php echo $viewhl_emi_amt; ?>"></td><td bgcolor="#999999" >No of EMI - <select name="hl_emi" ><option value="0">Please Select</option> <?php for($j=1;$j<30;$j++) { ?>
   <option value="<?php echo $j; ?>" <?php if($j==$viewhl_emi) echo "selected";?>><?php echo $j; ?> <?php if($j==1){ echo "Year"; } else { "Years"; } ?></option>
   <?php } ?></select></td>
            </tr>
<tr>
 <td align="right"><strong>Car Loan</strong></td><td>Loan Amt - <input type="text" name="cl_amt" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" value="<?php echo $viewcl_amt; ?>"></td><td>Bank Name - <input type="text" name="cl_bank" value="<?php echo $viewcl_bank; ?>" ></td>
 <td >EMI - 
    <input type="text" name="cl_emi_amt" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" value="<?php echo $viewcl_emi_amt; ?>"></td><td >No of EMI - <select name="cl_emi" ><option value="0">Please Select</option><?php for($cl=1;$cl<8;$cl++) { ?>
   <option value="<?php echo $cl; ?>" <?php if($cl==$viewcl_emi) echo "selected";?>><?php echo $cl; ?> <?php if($cl==1){ echo "Year"; } else { "Years"; } ?></option>
   <?php } ?></select></td>
            </tr>
<tr>
 <td align="right" bgcolor="#999999"><strong>Business Loan</strong></td><td bgcolor="#999999">Loan Amt - <input type="text" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" name="bl_amt"  value="<?php echo $viewbl_amt; ?>"></td><td bgcolor="#999999">Bank Name - <input type="text" name="bl_bank"  value="<?php echo $viewbl_bank; ?>" ></td>
 <td bgcolor="#999999" >EMI -  <input type="text" name="bl_emi_amt" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" value="<?php echo $viewbl_emi_amt; ?>" ></td><td bgcolor="#999999" >No of EMI - <select name="bl_emi" ><option value="0">Please Select</option><?php for($bl=1;$bl<8;$bl++) { ?>
   <option value="<?php echo $bl; ?>" <?php if($bl==$viewbl_emi) echo "selected";?>><?php echo $bl; ?> <?php if($bl==1){ echo "Year"; } else { "Years"; } ?></option>
   <?php } ?></select></td>
        </tr>
<tr>
 <td align="right"><strong>Loan Against Property</strong></td><td>Loan Amt - <input type="text" name="lap_amt" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" value="<?php echo $viewlap_amt; ?>" ></td><td>Bank Name - <input type="text" name="lap_bank"  value="<?php echo $viewlap_bank; ?>" ></td>
 <td >EMI -  <input type="text" name="lap_emi_amt" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" value="<?php echo $viewlap_emi_amt; ?>" ></td><td >No of EMI - <select name="lap_emi" ><option value="0">Please Select</option><?php for($lap=1;$lap<8;$lap++) { ?>
   <option value="<?php echo $lap; ?>" <?php if($lap==$viewlap_emi) echo "selected";?>><?php echo $lap; ?> <?php if($lap==1) { echo "Year"; } else { "Years"; } ?></option>
   <?php } ?></select></td>
        </tr>
        <tr>
 <td align="right" bgcolor="#999999"><strong>Credit Card/OD</strong></td><td bgcolor="#999999">Loan Amt - <input type="text" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" name="cc_amt" value="<?php echo $viewcc_amt; ?>"></td><td bgcolor="#999999">Bank Name - <input type="text" name="cc_bank"  value="<?php echo $viewcc_bank; ?>"></td>
 <td bgcolor="#999999" >EMI -  <input type="text" name="cc_emi_amt" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" value="<?php echo $viewcc_emi_amt; ?>"></td><td bgcolor="#999999" >No of EMI - <select name="cc_emi" ><option value="0">Please Select</option> <?php for($cc=1;$cc<8;$cc++) { ?>
   <option value="<?php echo $cc; ?>" <?php if($cc==$viewcc_emi) echo "selected";?>><?php echo $cc; ?> <?php if($cc==1) { echo "Year"; } else { "Years"; } ?></option>
   <?php } ?></select></td>
        </tr>                    
</table></td></tr>
<tr>
      <td colspan="4">&nbsp;</td>
    </tr>
   
    <tr>
      <td valign="top" bgcolor="#F0F0F0" ><strong>Loan Amount Required</strong></td>
      <td valign="top" bgcolor="#F0F0F0" ><input name="plloan_amount" type="text" class="inputsms" id="plloan_amount" onBlur="getDigitToWords('plloan_amount','formatedloan','wordloan');" onKeyPress="getDigitToWords('plloan_amount','formatedloan','wordloan');"  onKeyUp="getDigitToWords('plloan_amount','formatedloan','wordloan');" value="<?php echo $Loan_Amount;?>"></td>
      <td valign="top" bgcolor="#F0F0F0" ></td>
      <td bgcolor="#F0F0F0" ></td>
      </tr>
    <tr>
      <td></td>
      <td ></td>
      <td colspan="2" ><span id='formatedloan' style='font-size:11px; font-weight:bold;color:666699;font-Family:Verdana;'></span><span id='wordloan' style='font-size:11px;
font-weight:bold;color:666699;font-Family:Verdana;text-transform: capitalize;'></span></td>
    </tr>
    
   
    
           <tr>
      <td colspan="4" align="center" bgcolor="#F0F0F0" class="heading" style="border-top:1px solid #CCC; border-bottom:1px solid #CCC;"><strong>ADD Feedback </strong></td>
    </tr>
    <tr>
      <td valign="top" ><strong>Feedback</strong></td>
      <td valign="top" >
      <?php
	$getFedbackQuery = $obj->fun_db_query("select FeedbackID, Feedback from Req_Feedback_PL where AllRequestID='".$post."' and BidderID='3621' AND Reply_Type=1");
	$num_rows = $obj->fun_db_get_num_rows($getFedbackQuery);
		if($num_rows > 0)
		{
			echo $Feedback3621 = $obj->fun_get_mysql_result($getFedbackQuery,0,'Feedback');
			$originalFeedback = $Feedback_c;
	echo "<br>";
			$followup_date3621 = $obj->fun_get_mysql_result($getFedbackQuery,0,'Followup_Date');
		}
	?>
        <select name="plfeedback" class="inputsms" id="feedback" style="height:28px;">
          <option value="" <? if($Feedback == "") { echo "selected"; }?>>No Feedback</option>
          <option value="Other Product" <? if($Feedback == "Other Product") { echo "selected"; }?>>Other Product</option>
          <option value="Not Interested" <? if($Feedback == "Not Interested") { echo "selected"; }?>>Not Interested</option>
          <option value="Callback Later" <? if($Feedback == "Callback Later") { echo "selected"; }?>>Callback Later</option>
          <option value="Wrong Number" <? if($Feedback == "Wrong Number") { echo "selected"; }?>>Wrong Number</option>
          <option value="Send Now" <? if($Feedback == "Send Now") { echo "selected"; }?>>Send Now</option>
          <option value="Not Eligible" <? if($Feedback == "Not Eligible") { echo "selected"; }?>>Not Eligible</option>
          <option value="Duplicate" <? if($Feedback == "Duplicate") { echo "selected"; }?>>Duplicate</option>
          <option value="Not Contactable" <? if($Feedback == "Not Contactable") { echo "selected"; }?>>Not Contactable</option>
          <option value="Ringing" <? if($Feedback == "Ringing") { echo "selected"; }?>>Ringing</option>
          <option value="FollowUp" <? if($Feedback == "FollowUp") { echo "selected"; }?>>FollowUp</option>
          <option value="Not Applied" <? if($Feedback == "Not Applied") { echo "selected"; }?>>Not Applied</option>
        </select></td>
      <td class="fontstyle"><b>Follow Up Date</b></td>
      <td class="fontstyle"><?php  echo $followup_date3621; ?>
        <input type="Text"  name="FollowupDate" id="FollowupDate" maxlength="25" size="15" <?php if($Followup_Date !='0000-00-00 00:00:00') { ?>value="<?php  echo $followup_date; ?>" <?php } ?>>
        <a href="javascript:NewCal('FollowupDate','yyyymmdd',true,24)"><img src="../images/cal.gif" width="16" height="16" border="0" alt="Pick a date"></a></td>
    </tr>
        <tr>
        <td><b>Add Comment</b></td>
      <td><textarea rows="2" cols="20" name="pladd_comment" id="pladd_comment" ><? echo $Add_Comment; ?></textarea></td>
      <td colspan="2" align="center"><input type="submit" class="submit-sms" value="Submit"></td>
    </tr>
    <tr><td colspan="4">&nbsp;</td></tr></table></form>
    <table width="100%" border="0">
      <tr>
      <td colspan="4" align="center" bgcolor="#F0F0F0" class="heading" style="border-top:1px solid #CCC; border-bottom:1px solid #CCC;"><strong>Appointment</strong></td>
    </tr>
       <tr>
      <td colspan="4" bgcolor="#FFFFFF" >&nbsp;</td>

    </tr>
  
    <tr>
      <td colspan="4" bgcolor="#F0F0F0"> 

        <form method="POST" action="/editbllead_continue1.php" name="sendform_<? echo  $FinalBidder[$i];?>" target="_blank">
				<input type="hidden" name="callerid" id="callerid" value="<? echo $bidid;?>">
				<input type="hidden" name="reqcity" id="reqcity" value="<? echo $City;?>">
				<input type="hidden" name="plrequestid" id="plrequestid" value="<? echo $post;?>">
				<input type='hidden' value='<?php echo $plsmsld["Mobile_no"]; ?>' name='Bidder_Number' id='Bidder_Number'>
       <?php
	   	  $GetBank_Sql = "select leadlogid from zexternal_leadallocation_log where (BidderID  = ".$FinalBidder[$i]." and RequestID=".$post." and ProductID=1)";
	$GetBank_Query =$obj->fun_db_query($GetBank_Sql);
	$GetBankRows =  $obj->fun_db_fetch_rs_array($GetBank_Query);
	$leadlogid = $GetBankRows['leadlogid'];
	$checkboxR = '';
	if($leadlogid>0)
	{
		$checkboxR = " checked ";
	}
	   ?>
        <table width="100%" border="0" cellspacing="1" cellpadding="0" style="border:#333 2px solid;" >
      

            <tr>
      <td colspan="4">&nbsp;</td>
    </tr>
        <tr><td colspan="4" style="font-size:15px; font-weight:bold;">Set Appointment for <?php echo $finalBidderName[$i]; ?> </td></tr>
        <tr>
          <td colspan="4"><table width="100%" style="border:#00F dashed 2px;">
        <tr>  <td bgcolor="#DAEAF9" colspan="2"><!--<strong>Remarks</strong>--></td><td width="27%" bgcolor="#DAEAF9"><strong>Select Date</strong></td><td width="15%" bgcolor="#DAEAF9"><strong>Select Time Slab</strong></td></tr>
        <tr>  <td bgcolor="#FFFFFF" colspan="2"><!--<textarea rows="2" cols="75" name="special_remarks" id="special_remarks_3" onchange="NosplcharComment(this);"><? echo $Add_Comment; ?></textarea>--></td>
          <td bgcolor="#FFFFFF" valign="top"><input type="Text" name="appointment_date" id="appointment_date_3" maxlength="25" value="" size="15" ><a href="javascript:NewCal('appointment_date_3','yyyymmdd',true,24)"><img src="/images/cal.gif" width="16" height="16" border="0" alt="Pick a date"></a></td>
          <td bgcolor="#FFFFFF" valign="top"><select name="appointment_time" id="appointment_time"  class="inputsms" style="width:170px;">
		    <option value="please select">Time slab</option>
		      <option value="8(am)-9(am)" <?php if($appointment_time=='8(am)-9(am)') { echo "selected"; }?>>8(am)-9(am)</option>
		    <option value="9(am)-10(am)" <?php if($appointment_time=='9(am)-10(am)') { echo "selected"; }?>>9(am)-10(am)</option>
		    <option value="10(am)-11(am)" <?php if($appointment_time=='10(am)-11(am)') { echo "selected"; }?>>10(am)-11(am)</option>
		    <option value="11(am)-12(am)" <?php if($appointment_time=='11(am)-12(am)') { echo "selected"; }?>>11(am)-12(am)</option>
		    <option value="12(am)-1(pm)" <?php if($appointment_time=='12(am)-1(pm)') { echo "selected"; }?>>12(am)-1(pm)</option>
		    <option value="1(pm)-2(pm)" <?php if($appointment_time=='1(pm)-2(pm)') { echo "selected"; }?>>1(pm)-2(pm)</option> 
		    <option value="2(pm)-3(pm)" <?php if($appointment_time=='2(pm)-3(pm)') { echo "selected"; }?>>2(pm)-3(pm)</option>
		    <option value="3(pm)-4(pm)" <?php if($appointment_time=='3(pm)-4(pm)') { echo "selected"; }?>>3(pm)-4(pm)</option>
		    <option value="4(pm)-5(pm)" <?php if($appointment_time=='4(pm)-5(pm)') { echo "selected"; }?>>4(pm)-5(pm)</option>
		    <option value="5(pm)-6(pm)" <?php if($appointment_time=='5(pm)-6(pm)') { echo "selected"; }?>>5(pm)-6(pm)</option>
		    <option value="6(pm)-7(pm)" <?php if($appointment_time=='6(pm)-7(pm)') { echo "selected"; }?>>6(pm)-7(pm)</option>
		    <option value="7(pm)-8(pm)" <?php if($appointment_time=='7(pm)-8(pm)') { echo "selected"; }?>>7(pm)-8(pm)</option>
	    </select></td>
        </tr>
           <tr><td colspan="1" ><b>Address -  </b></td><td colspan="3" align="left" ><textarea rows="1" cols="95" name="Address" id="Address" onChange="NosplcharComment(this);"><?php echo $Address; ?></textarea></td></tr>
         <tr><td colspan="4" bgcolor="#DAEAF9"  ><b>Documents for <?php echo $finalBidderName[$i]; ?> </b></td></tr>
<tr>
	<td width="21%" class="fontstyle"><b>Age & ID Proof</b></td>
	<td width="37%" class="fontstyle">   
    <select name="IDProof" id="IDProof" style="width:170px;">
    	<option value="">Please Select</option>
		<option value="Passport" <?php if(trim($identification_proof)=="Passport") {echo "Selected";} ?> >Passport</option>
		<option value="PANCard" <?php if(trim($identification_proof)=="PANCard") {echo "Selected";} ?>>PAN Card</option>
		<option value="Drivers License" <?php if(trim($identification_proof)=="Drivers License") {echo "Selected";} ?>>Drivers License</option>
		<option value="Aadhar Card" <?php if(trim($identification_proof)=="Aadhar Card") {echo "Selected";} ?>>Aadhar Card</option>
		
	</select>
	</td>
	<td class="fontstyle"><b>Address proof</b></td>
	<td class="fontstyle"><select name="AddressProof" id="AddressProof" style="width:170px;">
    <option value="">Please Select</option>
		<option value="Passport" <?php if(trim($AddressProof)=="Passport") {echo "Selected";} ?>>Passport</option>
		<option value="Bank Statement" <?php if(trim($AddressProof)=="Bank Statement") {echo "Selected";} ?>>Last 12 months Bank Statement</option>
		<option value="LIC Premium" <?php if(trim($AddressProof)=="LIC Premium") {echo "Selected";} ?>>LIC Premium (not over two months old)</option>
<option value="Utility Bill" <?php if(trim($residence_proof)=="Utility Bill") {echo "Selected";} ?>>Utility Bill (not over two months old)</option>
<option value="Phone Bill" <?php if(trim($residence_proof)=="Phone Bill") {echo "Selected";} ?>>Mobile Bill (not over two months old)</option>
		<option value="Any other loan statements" <?php if(trim($AddressProof)=="Any other loan statements") {echo "Selected";} ?>>Any other loan statements on books of individuals/partners/directors along with sanction letters</option>
		<option value="Rent Agreement" <?php if(trim($residence_proof)=="Rent Agreement") {echo "Selected";} ?>>Rent Agreement</option>
  	</select></td>
</tr>
<tr>
	<td class="fontstyle"><b>Residence/Office Ownership (any of the below):</b></td>
	<td class="fontstyle">    
    <select name="PassSizePhoto" id="PassSizePhoto" style="width:170px;">
    <option value="">Please Select</option>
    <option value="Electricity Bill" <?php if(trim($ResidenceProof)=="Electricity Bill") {echo "Selected";} ?>>Electricity Bill</option>
      <option value="Sales Deed copy" <?php if(trim($ResidenceProof)=="Sales Deed copy") {echo "Selected";} ?>>Sales Deed copy</option>
      </select>
	</td>
	<td class="fontstyle"><b>Business Details</b></td>
	<td class="fontstyle">
    <select name="BankStmnt[]" id="BankStmnt" style="width:170px;" multiple>
    <option value="">Please Select</option>
    <option value="1" <?php if(trim($BusinessDetails)=="1") {echo "Selected";} ?>>Business continuity proof â€“ 3 years  and  more income tax return & income statements</option>
      <option value="2" <?php if(trim($BusinessDetails)=="2") {echo "Selected";} ?>>Last 2/3year audit re port and audited Financials</option>
      <option value="3" <?php if(trim($BusinessDetails)=="3") {echo "Selected";} ?>>Last 6-12 months bank statements</option>
      <option value="4" <?php if(trim($BusinessDetails)=="4") {echo "Selected";} ?>>In the case of transfer of a loan: Last 12 months ofÂ  loans statementÂ  along with the Sanction Letter of your previous bank</option>
      <option value="5" <?php if(trim($BusinessDetails)=="5") {echo "Selected";} ?>>Any other loan statements on books of companies along with Sanction Letters</option>
      <option value="6" <?php if(trim($BusinessDetails)=="6") {echo "Selected";} ?>>Last 12 months loan statement with Sanction Letter of any other existing loans</option>
     <option value="7" <?php if(trim($BusinessDetails)=="7") {echo "Selected";} ?>>Business incorporation date proof â€“ PAN Card</option>    <option value="8" <?php if(trim($BusinessDetails)=="8") {echo "Selected";} ?>>MOA(Memorandum of Association) and AOA (Articles of Association)</option>   
      <option value="9" <?php if(trim($BusinessDetails)=="9") {echo "Selected";} ?>>Latest shareholding pattern on company letterhead</option>
      <option value="10" <?php if(trim($BusinessDetails)=="10") {echo "Selected";} ?>>List of current Directors on company letterhead.</option>      
      <option value="11" <?php if(trim($BusinessDetails)=="11") {echo "Selected";} ?>>Certificate of Incorporation</option>      
    <option value="12" <?php if(trim($BusinessDetails)=="12") {echo "Selected";} ?>>Partnership Deed</option>   
      <option value="13" <?php if(trim($BusinessDetails)=="13") {echo "Selected";} ?>>Certificate of Registration</option>
      <option value="14" <?php if(trim($BusinessDetails)=="14") {echo "Selected";} ?>>Proof of continuation:Â  Trade license /Establishment /Sales Tax certificate</option>      
      <option value="15" <?php if(trim($BusinessDetails)=="15") {echo "Selected";} ?>>Proof of continuation: Trade license /Establishment /Sales Tax certificate/ SSI Registration</option>      
    <option value="16" <?php if(trim($BusinessDetails)=="16") {echo "Selected";} ?>>Brief Business Profile on the Letter Head of the firm by the applicant</option>   
      <option value="17" <?php if(trim($BusinessDetails)=="17") {echo "Selected";} ?>>Copy of Tax Deduction Certificate 26 AS  / Form â€“ 16A (if applicable)</option>
      <option value="18" <?php if(trim($BusinessDetails)=="18") {echo "Selected";} ?>>Copy of Advance Tax paid / Self Assessment Tax paid challan</option>      
      <option value="19" <?php if(trim($BusinessDetails)=="19") {echo "Selected";} ?>>Copy of Educational Qualification Certificate ( professional  loans ) </option>      
<option value="20" <?php if(trim($BusinessDetails)=="20") {echo "Selected";} ?>>Copy of Professional Practice Certificate</option>   
<option value="21" <?php if(trim($BusinessDetails)=="21") {echo "Selected";} ?>>Salary Certificate (in case of doctors having salaried income)</option>   
      </select></td>
</tr>
<tr>
	<td class="fontstyle"><b>Gross Turnover</b></td>
	<td> <select name="SalSlip[]" id="SalSlip" style="width:170px;" multiple>
    <option value="">Please Select</option>
    <option value="1" <?php if(trim($GrossTurnover)=="1") {echo "Selected";} ?>>Latest 2 Years ITRs' , Computation of Income, P&L, Balance sheet with all schedules with CA seal and sign</option>
   <option value="2" <?php if(trim($GrossTurnover)=="2") {echo "Selected";} ?>>Tax Audit Report (Where Gross Turnover Exceeds Rs 1 Crs for Non Professional Self Employed and Gross Receipts Exceeds 25 Lacs incase of Professionals and )</option>
   <option value="3" <?php if(trim($GrossTurnover)=="3") {echo "Selected";} ?>>Last 1 Year bank statements (with logo and Bank name) both Current and SB Account</option>
   <option value="4" <?php if(trim($GrossTurnover)=="4") {echo "Selected";} ?>>Business Continuity Proof for 3 Yrs</option>
   <option value="5" <?php if(trim($GrossTurnover)=="5") {echo "Selected";} ?>>Existing loan details and 6 months emi reflecting bank statement</option>
   <option value="6" <?php if(trim($GrossTurnover)=="6") {echo "Selected";} ?>>Latest LOD,OS Letter and Last 12 Months SOA in case of BT Proposal</option>
   <option value="7" <?php if(trim($GrossTurnover)=="7") {echo "Selected";} ?>>Partnership Deed & Latest list of partners & NOC as per Bank  bank format</option>
   <option value="8" <?php if(trim($GrossTurnover)=="8") {echo "Selected";} ?>>In case applicant is a Partner- Partnership firm's audited ITR along with complete financials to be collected</option>
   <option value="9" <?php if(trim($GrossTurnover)=="9") {echo "Selected";} ?>>Partnership Authority Letter on Letterhead of the Firm signed by all partners in case Firm to stand as guarantor</option>
   <option value="10" <?php if(trim($GrossTurnover)=="10") {echo "Selected";} ?>>Incase applicant is a Director, then the company's  audited ITR along with complete financials to be collected</option>
   <option value="11" <?php if(trim($GrossTurnover)=="11") {echo "Selected";} ?>>Board Resolution as per Bank  bank format- Incase company is applicant/guarantor</option>
   <option value="12" <?php if(trim($GrossTurnover)=="12") {echo "Selected";} ?>>Certificate of Incorporation</option>
   <option value="13" <?php if(trim($GrossTurnover)=="13") {echo "Selected";} ?>>MOA and AOA</option>
   <option value="14" <?php if(trim($GrossTurnover)=="14") {echo "Selected";} ?>>DIN of all Directors to be collected where company is applicant,Co_Applicant or Guarantor to the Loan</option>
      <option value="15" <?php if(trim($GrossTurnover)=="15") {echo "Selected";} ?>>Latest Share Holding Pattern</option>
    </select>
	</td>
	<td class="fontstyle"><b></b></td>
	<td class="fontstyle">
    </td>
</tr>   <tr><td colspan="3" align="left" class="fontstyle"><input type="checkbox" value="1" name="reschedule" id="reschedule" /> Re-Schedule</td><td align="right"><input type="submit" name="submit_appdt" value="Save" style="background-color:#036; color:#fff; font-size:17px;"></td></tr> 
       </table></td></tr>
        <tr>
          <td colspan="4">
          <table width="100%" style="border:#00F groove 1px;">
          <tr>
          <td colspan="4">
      <?php
	    $getApptDetailsSql = "select * from zexternal_appointment_docs where RequestID='".$post."'";
		//echo "<br>";
		$getApptDetailsresCount = $objAdmin->fun_get_num_rows($getApptDetailsSql);
		//echo $getApptDetailsresCount;
		$getApptDetailsQry = $obj->fun_db_query($getApptDetailsSql);
		$DocsArr = '';
		if($getApptDetailsresCount>0)
		{
		$DocsArr = '';
		$DocsArrStatus = '';
		$j=0;
		
		while($rowApptDetails = mysqli_fetch_object($getApptDetailsQry))			
	   	{
			
			$DocsArr = '';
			$DocsArrStatus = '';
			
			if(strlen($rowApptDetails->IDProof)>0) { $DocsArr[] =$rowApptDetails->IDProof; }
			if(strlen($rowApptDetails->AddressProof)>0) { $DocsArr[] =$rowApptDetails->AddressProof; }
			if(strlen($rowApptDetails->PanCard)>0) { $DocsArr[] =$rowApptDetails->PanCard; }
			if(strlen($rowApptDetails->SalSlip)>0) {
				
				$arrSalSlip = explode(',', $rowApptDetails->SalSlip);
				$arrSS = '';
				for($arrSCnt=0;$arrSCnt<count($arrSalSlip);$arrSCnt++)
				{
					$arrSS[]=GrossTurnoverValue($arrSalSlip[$arrSCnt]);
				}
				 $DocsArr[] = implode(', ', $arrSS); 	 
			}
			if(strlen($rowApptDetails->BankStmnt)>0) {
				$arrBankStmnt = explode(',', $rowApptDetails->BankStmnt);
				$arrBS = '';
				for($arrS=0;$arrS<count($arrBankStmnt);$arrS++)
				{
					$arrBS[]=BusinessDetailsValue($arrBankStmnt[$arrS]);
				}
				 $DocsArr[] = implode(', ', $arrBS); 
				 
				}
			if(strlen($rowApptDetails->PassSizePhoto)>0) { $DocsArr[] =$rowApptDetails->PassSizePhoto; }
			
			if($rowApptDetails->IDProof_Status==1) { $DocsArrStatus[] =$rowApptDetails->IDProof; }
			if($rowApptDetails->AddressProof_Status==1) { $DocsArrStatus[] =$rowApptDetails->AddressProof; }
			if($rowApptDetails->PanCard_Status==1) { $DocsArrStatus[] =$rowApptDetails->PanCard; }
			if($rowApptDetails->SalSlip_Status==1) { $DocsArrStatus[] =GrossTurnoverValue($rowApptDetails->SalSlip); }
			if($rowApptDetails->BankStmnt_Status==1) { $DocsArrStatus[] =BusinessDetailsValue($rowApptDetails->BankStmnt); }
			if($rowApptDetails->PassSizePhoto_Status==1) { $DocsArrStatus[] =$rowApptDetails->PassSizePhoto; }
			
			$getFEDetailsSql = "select Name as FE_Name, Mobile_Number as FE_Mobile from zexternal_appointment_users where id='".$rowApptDetails->docpickerid."'";
			$getFEresCount = $objAdmin->fun_get_num_rows($getFEDetailsSql);
			if($getFEresCount>0)
			{
				$getApptDetailsQry = $obj->fun_db_query($getFEDetailsSql);
				$getApptDetailsRows = mysqli_fetch_object($getApptDetailsQry);
				$FE_Name = $getApptDetailsRows->FE_Name;
				$FE_Mobile = $getApptDetailsRows->FE_Mobile;
			}
			
	   ?>
     <table width="100%" cellspacing="4" cellpadding="2" style="border:#000 1px solid;" >
<tr>  <td bgcolor="#003399" colspan="2" align="left"><strong style="color:#FFF;"><?php if($j==0) { echo "Appointment - "; } else { echo "Re-scheduled on ".$rowApptDetails->updated_date ; } ?>
</strong></td><td colspan="2" align="right" bgcolor="#003399"><?php if($rowApptDetails->viewstatus==1) {?><a href="/editappointments.php?id=<?php echo $rowApptDetails->id; ?>" target="_blank" style="color:#FFF; font-weight:bold;">EDIT</a> <?php } ?></td></tr>
        <tr>  <td bgcolor="#DAEAF9" colspan="2"><strong>Address</strong></td><td width="27%" bgcolor="#DAEAF9"><strong>Select Date</strong></td><td width="15%" bgcolor="#DAEAF9"><strong>Select Time Slab</strong></td></tr>
        <tr>  <td bgcolor="#FFFFFF" colspan="2"><?php echo $rowApptDetails->Address; ?></td>
          <td bgcolor="#FFFFFF" valign="top"><?php echo $rowApptDetails->appt_date; ?></td>
          <td bgcolor="#FFFFFF" valign="top"><?php echo $rowApptDetails->appt_time; ?></td>
        </tr>
         <tr><td colspan="4" bgcolor="#DAEAF9"  ><b>Documents - <?php echo implode(' , ', $DocsArr); ?> </b></td></tr>
         <tr><td colspan="4" >&nbsp;</td></tr>
         <?php if($rowApptDetails->docpickerid>0) { ?><tr><td colspan="4" bgcolor="#DAEAF9" ><b>Status</b> [Assigned to - <?php echo $FE_Name; ?> (<?php echo $FE_Mobile; ?>)]</td></tr>
         <tr><td colspan="4" ><b>Documents Picked -</b> <?php echo implode(' , ', $DocsArrStatus); ?><br />
         <b>Feedback - </b> <?php if($rowApptDetails->docStatus==1){ echo "Complete";}  
		 					  else if($rowApptDetails->docStatus==2){ echo "Incomplete Pick-up";}
							  else if($rowApptDetails->docStatus==3){ echo "Sent For Login";}
							  else if($rowApptDetails->docStatus==4){ echo "Return To Sales";}
							  else if($rowApptDetails->docStatus==5){ echo "Logged In";}	
								?><br />         
         <b>Remarks - </b> <?php echo $rowApptDetails->doc_pickup_remark;?>
         </td></tr>
             <?php } ?>      
          </table>
     <?php 
	 $j=$j+1;
	 } } ?>
      </table>
          </td></tr>    
   </form></td>
    </tr>
    </table>
</div>
</body>
</html>