<?php
@set_time_limit(300);
//require 'scripts/session_check_onlinelms.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';
require 'eligiblebidderfuncPL.php';
require 'scripts/pl_interest_rate_view.php';
require 'scripts/personal_loan_eligibility_function_form.php';
require 'scripts/personal_loan_bt_eligibility.php';
require 'd4lproduct.php';
session_start();
//2440691
//

$IP_Remote = $_SERVER["REMOTE_ADDR"];
if($IP_Remote=='192.124.249.12' || $IP_Remote=='185.93.228.12') { $IP= $_SERVER['HTTP_X_SUCURI_CLIENTIP']; }
else { $IP= $IP_Remote;	}

//echo $IP;
//http://www.deal4loans.com/edit-pl-appointments.php?id=2440691&Bid=6479&to=&from=
$post=$_REQUEST['id'];
$min_date =$_REQUEST['to'];
$max_date=$_REQUEST['from'];
$bidid =$_REQUEST['Bid'];

$reqtenure="";
if(isset($_REQUEST['reqtenure']))
{
	$reqtenure = $_REQUEST['reqtenure'];
}
else
{
	$reqtenure = '';
}


function ccMasking($number, $maskingCharacter = 'X')
{
	return substr($number, 0, 2) . str_repeat($maskingCharacter, strlen($number) - 4) . substr($number, -2);
}

function getEligibleLoanAmount($arrSalary, $unsecuredLoanEMI, $cardOutStanding, $securedLoanEMI, $standardEMI=2757)
{
	$returnValue = '';
	$averageSalary = (array_sum($arrSalary) / count($arrSalary));
	$returnValue[] = round($averageSalary);
	$ccOutStanding = $cardOutStanding *( 5 /100 );
	$totalOutStanding_unsecured = $unsecuredLoanEMI + $ccOutStanding;
	$returnValue[] = round($totalOutStanding_unsecured);
	$totalObligation = $totalOutStanding_unsecured + $securedLoanEMI;
	$returnValue[] = round($totalObligation);
	$currentFOIR_Unsecured = $totalOutStanding_unsecured / $averageSalary * 100;
	$currentFOIR_Total = ($securedLoanEMI + $totalOutStanding_unsecured) / $averageSalary * 100;
	$returnValue[] = round($currentFOIR_Unsecured,2);
	$returnValue[] = round($currentFOIR_Total,2);
	if($averageSalary>=50000)
	{
		if($currentFOIR_Unsecured<=55)
			$loanCalcUS = $averageSalary * 55 /100; // for unsecured
		else
			$loanCalcUS = 0;
		if($currentFOIR_Total<=65)
			$loanCalcTotal = $averageSalary * 65 /100; // for secured
		else
			$loanCalcTotal = 0;
	}
	else
	{
		if($currentFOIR_Unsecured<=45)
			$loanCalcUS = $averageSalary * 45 /100; // for unsecured
		else
			$loanCalcUS = 0;
		if($currentFOIR_Total<=55)
			$loanCalcTotal = $averageSalary * 55 /100; // for secured	
		else
			$loanCalcTotal = 0;
	}
	if($loanCalcUS>0)
		$unsecured_EligibleEMI = (($loanCalcUS - $totalOutStanding_unsecured) / $standardEMI) * 100000;
	else
		$unsecured_EligibleEMI = 0;
	if($loanCalcTotal>0)	
		$total_EligibleEMI = (($loanCalcTotal - $totalObligation) / $standardEMI) * 100000;
	else 
		$total_EligibleEMI = 0;
		
	$finalEligibleLoanAmount = ceil(min($unsecured_EligibleEMI,$total_EligibleEMI));
	if($finalEligibleLoanAmount>0)
	{
		$returnValue[] = $finalEligibleLoanAmount;
	}
	else
	{
		$returnValue[] = "Not Eligible";
	}
	return $returnValue;
}

function DetermineAgeGETDOB ($YYYYMMDD_In) {

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

if ($_SERVER['REQUEST_METHOD'] == 'POST' && ($IP=="122.176.100.27" || $IP=="122.176.100.28" || $IP=="122.176.122.134" || $IP=="122.161.196.68" || $IP=="61.246.3.127" || $IP=="122.160.30.168" || $IP=="122.160.74.241" || $IP=="::1")) {
		foreach($_POST as $a=>$b)
			$$a=$b;
	//		echo "<pre>";
	//	print_r($_POST);
		/* FIX STRINGS */
		$UserID = $_SESSION['UserID'];
		$plrequestid= $_POST['plrequestid'];
		$producttype=1;
		$PL_EMI_Paid = $_POST["pl_Existing_EMI"];
		$fm_subcategory=$_POST['fm_subcategory'];
		$reg_year=$_POST['reg_year'];
		$plname =$_POST['plname'];
		$reg_month=$_POST['reg_month'];
		$tataaig_home=$_POST['Tataaig_Home'];
		$purchase_date=$reg_month."-".$reg_year;
		$fm_category_id=$_POST['fm_category_id'];
		$renewal_date= $_POST['renewal_date'];
		$tataaig_health=$_POST["Tataaig_Health"];
		$tataaig_auto=$_POST["Tataaig_Auto"];
		$plemail = $_POST["plemail"];
		$Accidental_Insurance=$_POST['Accidental_Insurance'];
		$pltotal_experience = $_POST["pltotal_experience"];
		$plyears_in_company = $_POST["plyears_in_company"];
		$plmobile = $_POST["plmobile"];
		$plstd_code = $_POST["plstd_code"];
		$pllandline = $_POST["pllandline"];
		$plresidential_status = $_POST["plresidential_status"];
		$plemployment_status = $_POST["plemployment_status"];
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
		$plmobile_connection = $_POST["plmobile_connection"];
		$pllandline_connection = $_POST["pllandline_connection"];
		$plcity_other = $_POST["plcity_other"];
		$plactivation_code = $_POST["plactivation_code"];
		$plbidder_count = $_POST["plbidder_count"];
		$plfeedback = $_POST["plfeedback"];
		$FollowupDate = $_POST["FollowupDate"];
		$Final_Bidder = $_REQUEST['Final_Bidder'];
		$plCompany_Type = $_REQUEST['plCompany_Type'];
		$professional_details = $_REQUEST["professional_details"];
		$Bidder_Id = $_REQUEST['BidderId'];//AgentID
		$pladd_comment= $_REQUEST['pladd_comment'];
		$plsalary_drawn= $_REQUEST['plsalary_drawn'];
		$Primary_Acc= $_REQUEST['Primary_Acc'];
		$acc_no = $_REQUEST["acc_no"];
		$want_home_loan = $_REQUEST["want_home_loan"];
		$Annual_Turnover = $_REQUEST["Annual_Turnover"];
		$pl_Existing_Bank = $_REQUEST["pl_Existing_Bank"];
		$pl_Existing_Loan = $_REQUEST["pl_Existing_Loan"];
		$pl_Existing_ROI = $_REQUEST["pl_Existing_ROI"];
		$pancard = $_REQUEST['pancard'];		
		$incorporation_date = $_REQUEST['incorporation_date'];
		$any_loan_running = $_REQUEST['any_loan_running'];
		$pf_deduction = $_REQUEST['pf_deduction'];
		$residence_address = $_REQUEST['residence_address'];
		$office_address = $_REQUEST['office_address'];
		
		$obligation_loan_type = $_REQUEST['obligation_loan_type'];
		$obligation_bank_name = $_REQUEST['obligation_bank_name'];
		$obligation_loan_amt = $_REQUEST['obligation_loan_amt'];
		$obligation_emi_amt = $_REQUEST['obligation_emi_amt'];
		$obligation_emi = $_REQUEST['obligation_emi'];

		$obligationsArr = array($obligation_loan_type, $obligation_bank_name, $obligation_loan_amt, $obligation_emi_amt, $obligation_emi);
		$serializeObligation = serialize($obligationsArr);
		//print_r($serializeObligation);

		$cc_obligation_bank_name = $_REQUEST['cc_obligation_bank_name'];
		$cc_obligation_outstanding_amt = $_REQUEST['cc_obligation_outstanding_amt'];
			
		//$cc_obligation_amt = $_REQUEST['cc_obligation_amt'];
		$cc_obligation_amt = '';
		for($cc_i=0;$cc_i<count($cc_obligation_outstanding_amt);$cc_i++)
		{
			$cc_obligation_amt[] = $cc_obligation_outstanding_amt[$cc_i] * 5/100;
		}

		$cc_obligationArr = array($cc_obligation_bank_name, $cc_obligation_outstanding_amt, $cc_obligation_amt);
		$serializecc_obligation =serialize($cc_obligationArr);
//		print_r($serializecc_obligation);
		
			
		$SalaryArr=$_POST["SalaryArr"];
		$Salary = implode(',', $SalaryArr);
		$unsecured_emi = FixString($_POST["unsecured_emi"]);
		$secured_emi = FixString($_POST["secured_emi"]);	
		$card_outstanding = FixString($_POST["card_outstanding"]);	
		$cibil_reference_id = FixString($_POST['cibil_reference_id']);
	//	echo "<br>";	
		$sqlExtraFields = "select RequestID,id from Req_Loan_Personal_Extra_Fields where RequestID='".$post."'";
		//echo $sqlExtraFields;
		$queryExtraFields = ExecQuery($sqlExtraFields);
		$numRowsExtraFields = mysql_num_rows($queryExtraFields);
		if($numRowsExtraFields>0)
		{
			$sqlData = "update Req_Loan_Personal_Extra_Fields set Salary='".$Salary."', unsecured_emi='".$unsecured_emi."', secured_emi='".$secured_emi."', card_outstanding='".$card_outstanding."', cibil_reference_id = '".$cibil_reference_id."', obligation_details = '".$serializeObligation."', cc_obligation_details = '".$serializecc_obligation."', incorporation_date = '".$incorporation_date."', any_loan_running = '".$any_loan_running."', pf_deduction = '".$pf_deduction."', residence_address ='".$residence_address."', office_address ='".$office_address."' where RequestID='".$post."'";
		}
		else
		{
			$sqlData = "INSERT INTO Req_Loan_Personal_Extra_Fields (`RequestID`, `Salary`, `unsecured_emi`, `secured_emi`, `card_outstanding`, `cibil_reference_id`, obligation_details, cc_obligation_details, incorporation_date, any_loan_running, pf_deduction, residence_address, office_address) VALUES ('".$post."', '".$Salary."', '".$unsecured_emi."', '".$secured_emi."', '".$card_outstanding."', '".$cibil_reference_id."','".$serializeObligation."',  '".$serializecc_obligation."', '".$incorporation_date."', '".$any_loan_running."', '".$pf_deduction."', '".$residence_address."', '".$office_address."')";
		}
	//	echo $sqlData;
		ExecQuery($sqlData);


			

$nn = count($Loan_Any);
			 $ii  = 0;
			while ($ii < $nn)
			{
			  $Loan_A .= "$Loan_Any[$ii], ";
			 $ii++;
			 }

//echo "hello".$Final_Bid."<br>";
	//unique clause
	$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-30, date("Y"));
	$days30date=date('Y-m-d',$tomorrow);
	$days30datetime = $days30date." 00:00:00";
	$currentdate= date('Y-m-d');
	$currentdatetime = date('Y-m-d')." 23:59:59";

	
		if(strlen($Final_Bid)>0)
		{
		$updatelead="Update Req_Loan_Personal set PL_EMI_Paid='$PL_EMI_Paid',CC_Age='$professional_details',Annual_Turnover='$Annual_Turnover',Company_Type='$plCompany_Type',PL_Tenure= '$acc_no',Name='$plname',Accidental_Insurance='$Accidental_Insurance', Tataaig_Home='$tataaig_home',Tataaig_Health='$tataaig_health',Tataaig_Auto='$tataaig_auto',PL_EMI_Amt='$emi_amt',Company_Name='$plcompany_name', DOB='$pldob', Residential_Status='$plresidential_status',Email='$plemail', City='$plcity', Card_Limit='$plcard_limit', City_Other='$plcity_other', Mobile_Number='$plmobile', Std_Code='$plstd_code', Landline='$pllandline', Std_Code_O='$plstd_code_o', Landline_O='$pllandline_o', Net_Salary='$plnet_salary', Loan_Amount='$plloan_amount', Pincode='$plpincode', Employment_Status='$plemployment_status', CC_Holder='$plcc_holder', Card_Vintage='$plcard_vintage', Total_Experience='$pltotal_experience', Years_In_company='$plyears_in_company', Loan_Any='$Loan_A', Emi_Paid='$plemi_paid', Landline_Connection='$pllandline_connection', Salary_Drawn='$plsalary_drawn', Mobile_Connection='$plmobile_connection',Bidderid_Details='$Final_Bid',Add_Comment='$pladd_comment',Dated=Now(), Allocated='$Allocated',Primary_Acc='$Primary_Acc',Direct_Allocation=0,Existing_Bank='$pl_Existing_Bank',Existing_Loan='$pl_Existing_Loan',Existing_ROI='$pl_Existing_ROI', Pancard='".$pancard."' where RequestID=".$post;
		}
		else
		{
		$updatelead="Update Req_Loan_Personal set PL_EMI_Paid='$PL_EMI_Paid',CC_Age='$professional_details',Annual_Turnover='$Annual_Turnover',Company_Type='$plCompany_Type',PL_Tenure= '$acc_no',Name='$plname',Primary_Acc='$Primary_Acc', Tataaig_Home='$tataaig_home',Accidental_Insurance='$Accidental_Insurance', Tataaig_Health='$tataaig_health',Tataaig_Auto='$tataaig_auto', PL_EMI_Amt='$emi_amt',Company_Name='$plcompany_name', DOB='$pldob', Residential_Status='$plresidential_status',Email='$plemail', City='$plcity', Card_Limit='$plcard_limit', City_Other='$plcity_other', Mobile_Number='$plmobile', Std_Code='$plstd_code', Landline='$pllandline', Std_Code_O='$plstd_code_o', Landline_O='$pllandline_o', Net_Salary='$plnet_salary', Loan_Amount='$plloan_amount', Pincode='$plpincode', Employment_Status='$plemployment_status', CC_Holder='$plcc_holder', Card_Vintage='$plcard_vintage', Total_Experience='$pltotal_experience', Years_In_company='$plyears_in_company', Loan_Any='$Loan_A', Emi_Paid='$plemi_paid', Landline_Connection='$pllandline_connection', Salary_Drawn='$plsalary_drawn', Mobile_Connection='$plmobile_connection', Add_Comment='$pladd_comment',Direct_Allocation=0,Existing_Bank='$pl_Existing_Bank',Existing_Loan='$pl_Existing_Loan',Existing_ROI='$pl_Existing_ROI', Pancard='".$pancard."' where RequestID=".$post;
		}
	
	//	echo "<br>query".$updatelead."<br>";
	 $updateleadresult=ExecQuery($updatelead);
	 
	 if($plfeedback=="Send Now" && $Final_Bidder>100)
	 {
	 	
		$productid = 1;	 
		$Allocated = 1;
		$ProductType = 1;
		$tomorrowDate = date('Y-m-d',strtotime("+1 days"))." ".date('H:i:s');
		$echoQuery = '';
		
	 	$updateAllocation = "Update Req_Loan_Personal set Allocated='$Allocated'  where RequestID=".$post;
	 	$updateAllocationQuery = ExecQuery($updateAllocation);
	 	$echoQuery .= $updateAllocation."<br>";
	 //	$InsertFeedBackSqlPL = "Insert into Req_Feedback_Bidder_PL (AllRequestID, BidderID, Reply_Type, Allocation_Date, Consent, final_allocate) Values ('".$post."', '".$Final_Bidder."','".$productid."', Now(),'1','1')";
		//$InsertFeedBackResultPL = ExecQuery($InsertFeedBackSqlPL);
//	 	$echoQuery .= $InsertFeedBackSqlPL."<br>";
	 	$InsertFeedBackSqlPL1 = "Insert into Req_Feedback_Bidder_PL1 (AllRequestID, BidderID, Reply_Type, Allocation_Date, Consent, final_allocate) Values ('".$post."', '".$Final_Bidder."','".$productid."', Now(),'1','1')";
		$InsertFeedBackResultPL1 = ExecQuery($InsertFeedBackSqlPL1);
		$recordLastInserted = mysql_insert_id();

	 	$echoQuery .= $InsertFeedBackSqlPL1."<br>";
		
		$InsertFeedBackSql = "Insert into Req_Feedback_Bidder1 (AllRequestID,BidderID,Reply_Type,Allocation_Date) Values ('".$post."', '".$Final_Bidder."','".$productid."', Now())";
			
		$InsertFeedBackResult = ExecQuery($InsertFeedBackSql);
	 	$echoQuery .= $InsertFeedBackSql."<br>";
		
		$final_allocation="INSERT into Req_Feedback_Bidder_PL (AllRequestID, BidderID, Reply_Type, Allocation_Date) VALUES ('".$post."','".$Final_Bidder."','".$ProductType."', Now())";
		$final_allocationresult = ExecQuery($final_allocation);
		$recordLastInserted = mysql_insert_id();
	//	$echoQuery .= $final_allocation."<br>";
		
		$final_allocation_comments ="INSERT into Req_Feedback_Comments_PL (Feedback_ID,AllRequestID, BidderID, Reply_Type, Allocation_Date) VALUES ('".$recordLastInserted."', '".$post."','".$Final_Bidder."','".$ProductType."', Now())";
		$final_allocation_commentsresult = ExecQuery($final_allocation_comments);
		$echoQuery .= $final_allocation_comments."<br>";
		$UpdateBidders = "UPDATE `Bidders_List` SET `Last_allocation` = '1', `Last_set_select` = '1' WHERE `BidderID` = '".$Final_Bidder."' and Reply_Type=".$ProductType;
		ExecQuery($UpdateBidders);
		$echoQuery .= $UpdateBidders."<br>";
		
		$sql1 = "select BankID from Bidders_List where BidderID='".$Final_Bidder."'";
		$query1 = ExecQuery($sql1);
		$BankID_Agent= mysql_result($query1,0,'BankID');

		

                $QuryReqPL = "select City, City_Other from Req_Loan_Personal where RequestID='".$RequestID."'";
                $queryReqPL1 = ExecQuery($QuryReqPL);
                $plcity= mysql_result($queryReqPL1,0,'City');
                $plcity_other= mysql_result($queryReqPL1,0,'City_Other');
                if($plcity=='Others'){
                            $CityVal = $plcity_other;
                        }else{
                            $CityVal = $plcity;
                        }
                //insert 
		$insertSql = "INSERT INTO zexternal_appointment_docs (caller_id, RequestID,CityName, Reply_Type, appt_date, dated, updated_date, viewstatus, AgentFeedback,Feedback_ID,BidderID, BankID, Address) VALUES ('".$Bidder_Id."', '".$post."', ".$CityVal."', '1', '".$tomorrowDate."', Now(),Now(), '1', '1', '".$recordLastInserted."', '".$Final_Bidder."', '".$BankID_Agent."', '".$residence_address."')";
		ExecQuery($insertSql);
		$echoQuery .= $insertSql."<br>";
		//echo $echoQuery;
		//Update Req_Loan_Personal set Allocated='1'  where RequestID=2440691
		//Insert into Req_Feedback_Bidder_PL (AllRequestID, BidderID, Reply_Type, Allocation_Date, Consent, final_allocate) Values ('2440691', '6494','1', Now(),'1','1')
		//Insert into Req_Feedback_Bidder_PL1 (AllRequestID, BidderID, Reply_Type, Allocation_Date, Consent, final_allocate) Values ('2440691', '6494','1', Now(),'1','1')
		//Insert into Req_Feedback_Bidder1 (AllRequestID,BidderID,Reply_Type,Allocation_Date) Values ('2440691', '6494','1', Now())
		//INSERT into Req_Feedback_Bidder_PL (AllRequestID, BidderID, Reply_Type, Allocation_Date) VALUES ('2440691','6494','1', Now())
		//INSERT into Req_Feedback_Comments_PL (Feedback_ID,AllRequestID, BidderID, Reply_Type, Allocation_Date) VALUES ('896044', '2440691','','1', Now())
		//UPDATE `Bidders_List` SET `Last_allocation` = '1', `Last_set_select` = '1' WHERE `BidderID` = '6494' and Reply_Type=1
	 }
	 

	 if(strlen($plfeedback)>0)
	{
	//	echo "<br>Line 304<br>";
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
		$result = ExecQuery("select FeedbackID,not_contactable_counter from Req_Feedback_PL where AllRequestID=".$post." and BidderID=".$Bidder_Id." AND Reply_Type=1");		
		
		$num_rows = mysql_num_rows($result);
		if($num_rows > 0)
		{	
			$row = mysql_fetch_array($result);
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

			if($plfeedback=="Not Eligible" && $updatedcounter<=2)
						{
							SendSMSforLMS($SMSMessageplNE, $plmobile);
						}

					$product="Personal Loan";	
				$feedback=$plfeedback;
					include "scripts/feedbackmailerscript.php";

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
					mail($plemail,'Thanks for Registering for '.$product.' on deal4loans.com', $message2, $headers);
					}
			}
		else
		{
			$strSQL="Insert into Req_Feedback_PL(AllRequestID, BidderID, Reply_Type , Feedback, Followup_Date,not_contactable_counter, Caller_Name) Values (";
			$strSQL=$strSQL.$post.",".$Bidder_Id.",1,'".$plfeedback."','".$FollowupDate."','".$counter."', '".$_SESSION['Caller_Name']."')";

			if($plfeedback=="Not Eligible")
				{
					SendSMSforLMS($SMSMessageplNE, $plmobile);
				}

			$product="Personal Loan";	
		$feedback=$plfeedback;
					include "scripts/feedbackmailerscript.php";
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
					//	echo "hello2"."<br>";
						//mail($plemail,'Thanks for Registering for '.$product.' on deal4loans.com', $message2, $headers);
					}
		}
		//echo $strSQL;
		$result = ExecQuery($strSQL);
		if ($result == 1)
		{
		}
		else
		{
			$Msg = "** There was a problem in adding your feedback. Please try again.";
		}
	}
if($want_home_loan==1)
	{
	$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-30, date("Y"));
			$days30date=date('Y-m-d',$tomorrow);
			$days30datetime = $days30date." 00:00:00";
			$currentdate= date('Y-m-d');
			$currentdatetime = date('Y-m-d')." 23:59:59";
			
			 $getdetails="select RequestID,Updated_Date From Req_Loan_Home  Where (Mobile_Number='".$plmobile."' and Updated_Date between '".$days30datetime."' and '".$currentdatetime."') order by RequestID DESC";
			$checkavailability = ExecQuery($getdetails);
			$alreadyExist = mysql_num_rows($checkavailability);
			$myrow = mysql_fetch_array($checkavailability);
		
			if($alreadyExist>0)
			{
				echo "<b>Lead Already Exist in Home Loan, Applied Date.".$myrow['Updated_Date']."</b>";
			}
			else
			{
			$CheckSql = "select UserID from wUsers where Email = '".$plemail."'";
			$CheckQuery = ExecQuery($CheckSql);
			$CheckNumRows = mysql_num_rows($CheckQuery);
			if($CheckNumRows>0)
			{
				$UserID = mysql_result($CheckQuery, 0, 'UserID');
				$InsertProductSql = "INSERT INTO Req_Loan_Home (UserID, Name, Email, City, City_Other, Mobile_Number, Net_Salary, Loan_Amount, Dated, source, Updated_Date, Company_Name, Employment_Status, Pincode ) VALUES ( '$UserID', '$plname', '$plemail', '$plcity', '$plcity_other', '$plmobile', '$plnet_salary', '$plloan_amount', Now(), 'PL_LMS', Now(),'".$plcompany_name."','".$plemployment_status."','".$plpincode."')"; 
			}
			else
			{
				$InsertwUsersSql = "INSERT INTO wUsers (Email,FName,Phone,Join_Date,IsPublic) VALUES  ('$plemail', '$plname', '$plmobile', Now(), '$IsPublic')";			
				$InsertwUsersQuery = ExecQuery($InsertwUsersSql);
				$UserID = mysql_insert_id();
				$InsertProductSql = "INSERT INTO Req_Loan_Home (UserID, Name, Email, City, City_Other, Mobile_Number, Net_Salary, Loan_Amount, Dated, source, Updated_Date, Company_Name, Employment_Status, Pincode) VALUES ( '$UserID', '$plname', '$plemail', '$plcity', '$plcity_other', '$plmobile', '$plnet_salary', '$plloan_amount', Now(), 'PL_LMS', Now(),'".$plcompany_name."','".$plemployment_status."','".$plpincode."')";
			}
				$InsertProductQuery = ExecQuery($InsertProductSql);
		}
	}
}
?>
<html>
<head>
<link href="includes/style.css" rel="stylesheet" type="text/css">
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script language="javascript" type="text/javascript" src="scripts/datetime.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<script type="text/javascript" src="ajax.js"></script>
<script type="text/javascript" src="ajax-dynamic-pllist.js"></script>
<script type="text/JavaScript">
/*function killCopy(e){ return false; }
function reEnable(){return true; }
document.onselectstart=new Function ("return false");
if (window.sidebar){ document.onmousedown=killCopydocument.onclick=reEnable }
function clickIE4(){if (event.button==2){ return false; } }
function clickNS4(e){ if (document.layers||document.getElementById&&!document.all){ if (e.which==2||e.which==3){ return false;} } }
if (document.layers){ document.captureEvents(Event.MOUSEDOWN); document.onmousedown=clickNS4; } else if (document.all&&!document.getElementById){ document.onmousedown=clickIE4; }
document.oncontextmenu=new Function("return false")*/
</script>
<style type="text/css">	
	/* START CSS NEEDED ONLY IN DEMO */
	#mainContainer{
		width:660px;
		margin:0 auto;
		text-align:left;
		height:100%;
		
		border-left:3px double #000;
		border-right:3px double #000;
	}
	#formContent{
		padding:5px;
	}
	/* END CSS ONLY NEEDED IN DEMO */
	/* Big box with list of options */
	#ajax_listOfOptions{
		position:absolute;	/* Never change this one */
		width:280px;	/* Width of box */
		height:160px;	/* Height of box */
		overflow:auto;	/* Scrolling features */
		border:1px solid #317082;	/* Dark green border */
		background-color:#FFF;	/* White background color */
    color: black;
		text-align:left;
		font-size:0.9em;
		z-index:100;
	}
	#ajax_listOfOptions div{	/* General rule for both .optionDiv and .optionDivSelected */
		margin:1px;		
		padding:1px;
		cursor:pointer;
		font-size:0.9em;
	}
	#ajax_listOfOptions .optionDiv{	/* Div for each item in list */
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
	form{
		display:inline;
	}
	</style>
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
}</style>
<script language="javascript">

function calculateObligation(val)
{
	//alert(val);
	var getObligation = val * 5/100;

	if(val>100)
	{
	//	alert(val);
		document.loan_form.cc_obligation_amt.value = val * 5/100;
	}
}


</script>
</head>
<body>

<?php 
$viewqry="select Pancard, CC_Age,Annual_Turnover, Company_Type,PL_Bank,PL_Tenure,Name,Tataaig_Home,Tataaig_Health,Tataaig_Auto,Accidental_Insurance,Add_Comment, Mobile_Number,Landline,Landline_O,Std_Code, Std_Code_O,Net_Salary,Residential_Status,City,City_Other, Is_Valid,Dated,Employment_Status,Loan_Amount,Email,Contactable, source,Loan_Any,Pincode,SentEmail,Emi_Paid, CC_Holder,Card_Vintage,Followup_Date,Feedback,CC_Mailer,Company_Name, PL_EMI_Amt,Card_Limit,Salary_Drawn,Landline_Connection,Mobile_Connection, Total_Experience,Years_In_Company,DOB,Bidderid_Details,checked_bidders,Primary_Acc,Referral_Flag,Creative,Existing_Bank,Existing_Loan,Existing_ROI from Req_Loan_Personal LEFT OUTER JOIN Req_Feedback_PL ON Req_Feedback_PL.AllRequestID=Req_Loan_Personal.RequestID and Req_Feedback_PL.BidderID= '".$bidid."' where Req_Loan_Personal.RequestID=".$post." "; 
//echo "dd".$viewqry;
$viewlead = ExecQuery($viewqry);
$viewleadscount =mysql_num_rows($viewlead);
$Name = mysql_result($viewlead,0,'Name');
$professional_details = mysql_result($viewlead,0,'CC_Age');
$Tataaig_Home=  mysql_result($viewlead,0,'Tataaig_Home');
$Tataaig_Health=  mysql_result($viewlead,0,'Tataaig_Health');
$Tataaig_Auto=  mysql_result($viewlead,0,'Tataaig_Auto');
$Accidental_Insurance = mysql_result($viewlead,0,'Accidental_Insurance');
$Add_Comment= mysql_result($viewlead,0,'Add_Comment');
$Mobile = mysql_result($viewlead,0,'Mobile_Number');
$Landline = mysql_result($viewlead,0,'Landline');
$Landline_O = mysql_result($viewlead,0,'Landline_O');
$Std_Code = mysql_result($viewlead,0,'Std_Code');
$Std_Code_O = mysql_result($viewlead,0,'Std_Code_O');
$Net_Salary = mysql_result($viewlead,0,'Net_Salary');
$Residential_Status = mysql_result($viewlead,0,'Residential_Status');
$City = mysql_result($viewlead,0,'City');
$City_Other = mysql_result($viewlead,0,'City_Other');
$Is_Valid = mysql_result($viewlead,0,'Is_Valid');
$Dated = mysql_result($viewlead,0,'Dated');
$Employment_Status = mysql_result($viewlead,0,'Employment_Status');
$Loan_Amount = mysql_result($viewlead,0,'Loan_Amount');
$Email = mysql_result($viewlead,0,'Email');
$Contactable = mysql_result($viewlead,0,'Contactable');
$source = mysql_result($viewlead,0,'source');
$Loan_Any = mysql_result($viewlead,0,'Loan_Any');
$Pincode = mysql_result($viewlead,0,'Pincode');
$SentEmail = mysql_result($viewlead,0,'SentEmail');
$Emi_Paid = mysql_result($viewlead,0,'Emi_Paid');
$CC_Holder = mysql_result($viewlead,0,'CC_Holder');
$Card_Vintage = mysql_result($viewlead,0,'Card_Vintage');
$followup_date = mysql_result($viewlead,0,'Followup_Date');
$Feedback = mysql_result($viewlead,0,'Feedback');
$CC_Mailer = mysql_result($viewlead,0,'CC_Mailer');
$Company_Name = mysql_result($viewlead,0,'Company_Name');
$PL_EMI_Amt = mysql_result($viewlead,0,'PL_EMI_Amt');
$Card_Limit = mysql_result($viewlead,0,'Card_Limit');
$Salary_Drawn = mysql_result($viewlead,0,'Salary_Drawn');
$Landline_Connection = mysql_result($viewlead,0,'Landline_Connection');
$Mobile_Connection = mysql_result($viewlead,0,'Mobile_Connection');
$Total_Experience = mysql_result($viewlead,0,'Total_Experience');
$Years_In_Company = mysql_result($viewlead,0,'Years_In_Company');
$DOB = mysql_result($viewlead,0,'DOB');
$PL_Tenure  = mysql_result($viewlead,0,'PL_Tenure');
$Bidderid_Details = mysql_result($viewlead,0,'Bidderid_Details');
$checked_bidders = mysql_result($viewlead,0,'checked_bidders');
$Primary_Acc = mysql_result($viewlead,0,'Primary_Acc');
$Referral_Flag = mysql_result($viewlead,0,'Referral_Flag');
list($mainync,$last) = split('[.]', $Years_In_Company);
if($Referral_Flag==0)
{
	$Referral_Flag = @mysql_result($viewlead,0,'Creative');
}
$Company_Type = mysql_result($viewlead,0,'Company_Type');
$checked_bidders = explode(",",$checked_bidders);
$Loan_Any = substr($Loan_Any, 0, strlen($Loan_Any)-1); 
$getDOB =DetermineAgeGETDOB($DOB);
$Annual_Turnover =  mysql_result($viewlead,0,'Annual_Turnover');
$PL_Bank = mysql_result($viewlead,0,'PL_Bank');
$Existing_Bank = @mysql_result($viewlead,0,'Existing_Bank');
$Existing_ROI = @mysql_result($viewlead,0,'Existing_ROI');
$Existing_Loan = @mysql_result($viewlead,0,'Existing_Loan');
$pancard = @mysql_result($viewlead,0,'Pancard');
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
$getcompanyresult = ExecQuery($getcompany);
$grow=mysql_fetch_array($getcompanyresult);
$recordcount = mysql_num_rows($getcompanyresult);
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
$capitalfirstcomp = $grow["capitalfirst"];
$adityabirla = $grow["adityabirla"];

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
/*if($Bidder_Count!=0)
{
	$strbidderid="";
	$z=0;
$retrieve_query="select BidderID from Req_Feedback_Bidder_PL where AllRequestID=".$post." and Reply_Type=1";
//echo $retrieve_query."<br>";
	$retrieve_result = ExecQuery($retrieve_query);
	$retrieve_recordcount =mysql_num_rows($retrieve_result);
	for($r=0;$r<$retrieve_recordcount;$r++)
	{
		$BidderID12 = mysql_result($retrieve_result,$r,'BidderID');
		$strbidderid = $strbidderid.$BidderID12.",";
	}	
}*/


$sqlExtraFields = "select * from Req_Loan_Personal_Extra_Fields where RequestID='".$post."'";
	$queryExtraFields = ExecQuery($sqlExtraFields);
	$numRowsExtraFields = mysql_num_rows($queryExtraFields);
	if($numRowsExtraFields>0)
	{
		$incorporation_date = mysql_result($queryExtraFields,0,'incorporation_date');
		$any_loan_running = mysql_result($queryExtraFields,0,'any_loan_running');
		$pf_deduction = mysql_result($queryExtraFields,0,'pf_deduction');
		$residence_address = mysql_result($queryExtraFields,0,'residence_address');
		$office_address = mysql_result($queryExtraFields,0,'office_address');		
		$Salary = mysql_result($queryExtraFields,0,'Salary');
		$arrSalary = explode(',', $Salary);
		$firstMonth = $arrSalary[0];
		$secondMonth = $arrSalary[1];
		$thirdMonth = $arrSalary[2];
		$cibil_reference_id = mysql_result($queryExtraFields,0,'cibil_reference_id');
		$unsecured_emi = mysql_result($queryExtraFields,0,'unsecured_emi');
		$secured_emi = mysql_result($queryExtraFields,0,'secured_emi');
		$card_outstanding = mysql_result($queryExtraFields,0,'card_outstanding');
		list($averageSalary,$total_unsecured_obligation,$total_obligation, $unsecuredFOIR, $totalFOIR, $eligible_loan_amount) = getEligibleLoanAmount($arrSalary, $unsecured_emi, $card_outstanding, $secured_emi);
		
		$obligation_details = mysql_result($queryExtraFields,0,'obligation_details');
		$cc_obligation_details = mysql_result($queryExtraFields,0,'cc_obligation_details');
		$unserializeObligation = unserialize($obligation_details);
		$unserializeccObligation = unserialize($cc_obligation_details);
//		echo "<br>";		echo "<br>";		echo "<br><pre>";
//print_r($unserializeObligation);
//		echo "</pre><br>";		echo "<br>";		
		$obligation_loan_type_1 = $unserializeObligation[0][0];
		$obligation_loan_type_2 = $unserializeObligation[0][1];
		$obligation_loan_type_3 = $unserializeObligation[0][2];
		$obligation_loan_type_4 = $unserializeObligation[0][3];
		$obligation_loan_type_5 = $unserializeObligation[0][4];
		$obligation_loan_type_6 = $unserializeObligation[0][5];
	
		$obligation_bank_name_1 = $unserializeObligation[1][0];
		$obligation_bank_name_2 = $unserializeObligation[1][1];
		$obligation_bank_name_3 = $unserializeObligation[1][2];
		$obligation_bank_name_4 = $unserializeObligation[1][3];
		$obligation_bank_name_5 = $unserializeObligation[1][4];
		$obligation_bank_name_6 = $unserializeObligation[1][5];
	
		$obligation_loan_amt_1 = $unserializeObligation[2][0];
		$obligation_loan_amt_2 = $unserializeObligation[2][1];
		$obligation_loan_amt_3 = $unserializeObligation[2][2];
		$obligation_loan_amt_4 = $unserializeObligation[2][3];
		$obligation_loan_amt_5 = $unserializeObligation[2][4];
		$obligation_loan_amt_6 = $unserializeObligation[2][5];
		if(count($unserializeObligation[2])>0)
		{
			$totalLoanAmountObligation = array_sum($unserializeObligation[2]);
		}
		$obligation_emi_amt_1 = $unserializeObligation[3][0];
		$obligation_emi_amt_2 = $unserializeObligation[3][1];
		$obligation_emi_amt_3 = $unserializeObligation[3][2];
		$obligation_emi_amt_4 = $unserializeObligation[3][3];
		$obligation_emi_amt_5 = $unserializeObligation[3][4];
		$obligation_emi_amt_6 = $unserializeObligation[3][5];
		if(count($unserializeObligation[3])>0)
		{
			$totalLoanAmountEMIObligation = array_sum($unserializeObligation[3]);
		}

		$obligation_emi_1 = $unserializeObligation[4][0];
		$obligation_emi_2 = $unserializeObligation[4][1];
		$obligation_emi_3 = $unserializeObligation[4][2];
		$obligation_emi_4 = $unserializeObligation[4][3];
		$obligation_emi_5 = $unserializeObligation[4][4];
		$obligation_emi_6 = $unserializeObligation[4][5];

		$cc_obligation_bank_name_1 = $unserializeccObligation[0][0];
		$cc_obligation_bank_name_2 = $unserializeccObligation[0][1];
		$cc_obligation_bank_name_3 = $unserializeccObligation[0][2];
		$cc_obligation_bank_name_4 = $unserializeccObligation[0][3];
		
		$cc_obligation_outstanding_amt_1 = $unserializeccObligation[1][0];
		$cc_obligation_outstanding_amt_2 = $unserializeccObligation[1][1];
		$cc_obligation_outstanding_amt_3 = $unserializeccObligation[1][2];
		$cc_obligation_outstanding_amt_4 = $unserializeccObligation[1][3];

		$cc_obligation_amt_1 = $unserializeccObligation[2][0];
		$cc_obligation_amt_2 = $unserializeccObligation[2][1];
		$cc_obligation_amt_3 = $unserializeccObligation[2][2];
		$cc_obligation_amt_4 = $unserializeccObligation[2][3];

	}
	if($firstMonth<=0) {$firstMonth='';}
	if($secondMonth<=0) {$secondMonth='';}
	if($thirdMonth<=0) {$thirdMonth='';}
	if($unsecured_emi<=0) {$unsecured_emi='';}
	if($secured_emi<=0) {$secured_emi='';}
	if($card_outstanding<=0) {$card_outstanding='';}		

?>
<style>
.fontstyle
	{
		font-family:Verdana Arial, Helvetica, sans-serif;
		font-size:12px;
	}
</style>

<!--DatePicker Start-->
		<link rel="stylesheet" type="text/css" href="../callinglms/css-datepicker/jquery-ui.css">
		<link rel="stylesheet" type="text/css" href="../callinglms/css-datepicker/datepicker.css">
		<script src="../callinglms/js-datepicker/jquery-1.5.1.js"></script>
		<script src="../callinglms/js-datepicker/jquery.ui.core.js"></script>
		<script src="../callinglms/js-datepicker/jquery.ui.datepicker.js"></script>
		<script>
		$(document).ready(function() {
			
			var date = new Date();
			var m = date.getMonth(), d = date.getDate(), y = date.getFullYear();
			
			$('#pldob').datepicker({
					minDate: new Date(y-65, m, d),
					maxDate: new Date(y-21, m, d),
					//yearRange: "+20:+0",
					dateFormat: 'yy-mm-dd'
			});
                        
                        $('#incorporation_date').datepicker({
					//minDate: new Date(y-65, m, d),
					maxDate: new Date(y, m, d),
					//yearRange: "+20:+0",
					dateFormat: 'yy-mm-dd'
			});
			}); 
			$(function() {
				$( "#pldob" ).datepicker();
				
			});
                        $(function() {
				$( "#incorporation_date" ).datepicker();
				
			});		
		</script> 
<p align="center"><b>Personal loan Lead Details </b></p>
<table width="1040" align="center">
 <tr><td colspan="4" align="center">

<form name="loan_form" method="post" action="<? echo $_SERVER['PHP_SELF'] ?>?id=<?echo $post;?>&Bid=<? echo $bidid;?>&to=<? echo $min_date?>&from=<? echo $max_date;?>" >
<table style='border:1px dotted #9C9A9C;' cellspacing="2" cellpadding="5" width="1000" height="80%" align="center" border="0" >
<tr>
	<td style="border:1px solid black;" colspan="4" bgcolor="#DAEAF9" align="center" class="fontstyle" ><b>Personal Details</b></td></tr>
		<tr>
			<td class="fontstyle" width="150"><b> Name (As per Pancard)</b></td>
			<td class="fontstyle" width="150"><input type="text" name="plname" id="plname" value="<? echo $Name;?>"></td>
			<td class="fontstyle" width="150"><b>Email id</b></td>
			<td class="fontstyle" width="150"><input type="text" name="plemail" id="plemail" value="<? echo $Email;?>"></td>
		</tr>
		<tr>
		<td class="fontstyle"><b>DOB (As per Pancard)</b></td>
			<td class="fontstyle"><input type="text" name="pldob" id="pldob"size="15" value="<? echo $DOB;?>"></td>
			<td class="fontstyle"><b>Mobile</b></td>
			<td class="fontstyle">+91<input type="hidden" name="plmobile" size="15" value="<? echo $Mobile;?>"><strong><?php echo ccMasking($Mobile); ?><? //echo $Mobile;?></strong></td>
			</tr>
		<tr>
			<td class="fontstyle"><b>Residence No</b></td>
			<td class="fontstyle"><input type="text" name="plstd_code" size="1" value="<? echo $Std_Code;?>" >-<input type="text" name="pllandline" size="8" value="<? echo $Landline;?>"></td>
			<td class="fontstyle" ><b>Office No.</b></td>
			<td class="fontstyle"><input type="text" name="plstd_code_o"  size="1" value="<? echo $Std_Code_O; ?>" >-<input type="text" name="pllandline_o" size="9" value="<?echo $Landline_O;?>"></td>
		</tr>
		<tr>
			<td class="fontstyle"><b>City</b></td>
			<td class="fontstyle"><select size="1" name="plcity" id="plcity"> <?=plgetCityList($City)?></select></td>
			<td class="fontstyle"><b>Other City</b></td>
			<td class="fontstyle"><input type="text" name="plcity_other" id="plcity_other" size="10" value="<?echo $City_Other;?>" ></td>
		</tr>
		<tr>
	<td class="fontstyle"><b>Salary Drawn?</b></td>
			<td  class="fontstyle"><input type="radio"  value="1"  name="plsalary_drawn" id="plsalary_drawn" <? if($Salary_Drawn==1){ echo "checked";}?> >Cash &nbsp;
			<input size="10" type="radio" name="plsalary_drawn" id="plsalary_drawn" value="2" <? if($Salary_Drawn==2){ echo "checked";}?>>Account Transfer<input size="10" type="radio" name="plsalary_drawn" id="plsalary_drawn"  value="3" <? if($Salary_Drawn==3){ echo "checked";}?>>Cheque</td>
	
			<td class="fontstyle" ><b>Salary Account in which bank?</b>			</td>
	<td><select  name="Primary_Acc" id="Primary_Acc"><option value="">Please Select</option> <? $bnknm=ExecQuery("select Bank_Name from Bank_Master group by Bank_Name "); 
	while($plbnk=mysql_fetch_array($bnknm))
	{ ?>
			<option value="<? echo $plbnk["Bank_Name"]; ?>" <? if(strtoupper($Primary_Acc)==strtoupper($plbnk["Bank_Name"])) { echo "Selected";} ?>><? echo $plbnk["Bank_Name"]; ?></option>
	<? }
	?>
<option value="Other" <? if(strtoupper($Primary_Acc)=="OTHER") { echo "Selected";} ?>>Other</option></select>
</td>
	</tr>
		<tr>
<td><strong>Pancard</strong></td>
<td><input type="text" name="pancard" value="<?php echo $pancard; ?>" > </td>
			<td colspan="2" class="fontstyle"><input type="hidden" name="BidderId" value="<? echo $bidid;?>" >
			
			</td></tr>
<tr><td><strong>Residence Address</strong></td>
			<td colspan="3" class="fontstyle">
			<textarea name="residence_address" id="residence_address" style="width: 618px"><?php echo $residence_address; ?></textarea>			
			</td></tr>
<tr><td><strong>Office Address</strong></td>
			<td colspan="3" class="fontstyle">
			<textarea name="office_address" id="office_address" style="width: 618px"><?php echo $office_address; ?></textarea>			
			</td></tr>
			
		<tr>
			<td colspan="4" class="fontstyle"><input type="hidden" name="plrequestid" id="plrequestid" value="<? echo $post;?>"></td>
		</tr>
	
<tr>
		<td colspan="4" bgcolor="#DAEAF9" align="center" style="border:1px solid black;"><b>Employment Details</b></td></tr>
	<tr>
		<td class="fontstyle"><b>Employment Status</b></td>
		<td class="fontstyle"><select class="fontstyle" name="plemployment_status" id="plemployment_status">
			<option value="1" <? if($Employment_Status ==1){echo "selected"; }?>>Salaried</option>
			<option value="0" <? if($Employment_Status ==0) {echo "selected"; }?>>Self Employed</option></select>
		</td>
		<td class="fontstyle"><b>Annual Income</b></td>
		<td class="fontstyle"><input type="text" name="plnet_salary" id="plnet_salary" value="<?echo $Net_Salary;?>"  onKeyUp="getDigitToWords('plnet_salary','formatedIncome','wordIncome');" onKeyPress="getDigitToWords('plnet_salary','formatedIncome','wordIncome');" style="float: left" onBlur="getDigitToWords('plnet_salary','formatedIncome','wordIncome');"></td>
	</tr>
	<tr><td class="fontstyle"><b>Company Name</b></td>
	<td class="fontstyle"><input type="text" name="plcompany_name" id="plcompany_name" onKeyUp="ajax_showOptions(this,'getCountriesByLetters',event)" value="<? echo $Company_Name;?>"></td><td colspan="2" ><span id='formatedIncome' style='font-size:11px; font-weight:bold;color:666699;font-Family:Verdana;'></span><span id='wordIncome' style='font-size:11px;
font-weight:bold;color:666699;font-Family:Verdana;text-transform: capitalize;'></span></td></tr>
	<tr>
<td><b>Company Date of Incorporation </b></td>
<td><input type="text" name="incorporation_date" id="incorporation_date" value="<? echo $incorporation_date; ?>"></td>
	<td><strong>Company Type</strong></td><td><select name="plCompany_Type" id="plCompany_Type" style="width: 190px;">
		  <option value="0" <? if($Company_Type==0) {echo "selected";} ?>>Please Select</option>
		  	<option value="1" <? if($Company_Type==1) {echo "selected";} ?>>Pvt Ltd</option>
			<option value="2" <? if($Company_Type==2) {echo "selected";} ?>>MNC Pvt Ltd</option>
			<option value="3" <? if($Company_Type==3) {echo "selected";} ?>>Limited</option>
			<option value="4" <? if($Company_Type==4) {echo "selected";} ?>>Central Govt.</option>
			<option value="6" <? if($Company_Type==6) {echo "selected";} ?>>State Govt</option>
		<option value="7" <? if($Company_Type==7) {echo "selected";} ?>>Partnership company</option>
	<option value="8" <? if($Company_Type==8) {echo "selected";} ?>>Proprietorship</option>		
			</select></td>
</tr>
	<tr>
		<td class="fontstyle"><b>Total Experience</b></td>
		<td class="fontstyle"><input type="text" name="pltotal_experience" id="pltotal_experience" size="5" value="<?echo $Total_Experience;?>"><b>(years)</b>
		</td>
		<td class="fontstyle"><b>Current experience in company</b></td>
		<td class="fontstyle"><input type="text" name="plyears_in_company" id="plyears_in_company" value="<? echo $Years_In_Company; ?>" size="5"><b>(years)</b></td>
	</tr>

	<tr>
		<td class="fontstyle"><b>Prov. Fund Deduction</b></td>
		<td class="fontstyle"><input type="radio" value="1" name="pf_deduction" id="pf_deduction1" <? if($pf_deduction==1){ echo "checked";}?> class="NoBrdr" checked>Yes
     <input type="radio" value="0" name="pf_deduction"  id="pf_deduction2" class="NoBrdr" <? if($pf_deduction==0){ echo "checked";}?>>No</td>
		<td class="fontstyle"><b>Amount of EMI</b></td>
		<td class="fontstyle"><input type="text" name="emi_amt" id="emi_amt" value="<? echo $PL_EMI_Amt;?>"></td>
	</tr>

<tr>
	<td colspan="4" bgcolor="#DAEAF9" align="center" class="fontstyle" style="border:1px solid black;"><b>Surrogate Details</b></td></tr>
<tr>
	<td class="fontstyle"><b>Credit Card Holder </b></td>
	<td class="fontstyle"><input type="radio" value="1" name="plcc_holder" id="plcc_holder" <? if($CC_Holder==1){ echo "checked";}?> class="NoBrdr" checked>Yes
     <input type="radio" value="0" name="plcc_holder"  id="plcc_holder" class="NoBrdr" <? if($CC_Holder==0){ echo "checked";}?>>No</td>
		<td class="fontstyle"><b>Loan Amount Required</b></td>
	<td class="fontstyle"><input type="text" name="plloan_amount" id="plloan_amount" value="<?echo $Loan_Amount;?>"  onKeyUp="getDigitToWords('plloan_amount','formatedloan','wordloan');" onKeyPress="getDigitToWords('plloan_amount','formatedloan','wordloan');" style="float: left" onBlur="getDigitToWords('plloan_amount','formatedloan','wordloan');"></td>			   </tr>
<tr>
	<td class="fontstyle"><b>Any Loan Running ?</b></td>
	<td>
	<input type="radio" name="any_loan_running" value="1" <?php if($any_loan_running==1) { echo "checked"; } ?> > Yes 	<input type="radio" name="any_loan_running" value="0" <?php if($any_loan_running==0) { echo "checked"; } ?> > No
	</td>
	<td colspan="2" valign="top"><span id='formatedloan' style='font-size:11px; font-weight:bold;color:666699;font-Family:Verdana;'></span><span id='wordloan' style='font-size:11px;
font-weight:bold;color:666699;font-Family:Verdana;text-transform: capitalize;'></span></td>
</tr>

<tr>
<td class="fontstyle"><b>Card held since?</b></td><td class="fontstyle"><select  class="fontstyle" size="1" name="plcard_vintage" id="plcard_vintage">
	<option value="0" <? if($Card_Vintage==0) { echo "selected"; } ?>>Please select</option>
	<option value="1" <? if($Card_Vintage==1) { echo "selected"; } ?>>Less than 6 months</option>
	<option value="2" <? if($Card_Vintage==2) { echo "selected"; } ?>>6 to 9 months</option> 
	<option value="3" <? if($Card_Vintage==3) { echo "selected"; } ?>>9 to 12 months</option>
	<option value="4" <? if($Card_Vintage==4) { echo "selected"; } ?>>more than 12 months</option>
	</select></td>	


	<td class="fontstyle"><b>No of Emis Paid for oldest loan</b></td>
		<td class="fontstyle">
			<select name="plemi_paid" class="fontstyle">
				<option value="0" <? if($Emi_Paid==0) { echo "selected"; } ?>>Please select</option>
				<option value="1" <? if($Emi_Paid==1) { echo "selected"; } ?>>Less than 6 months</option>
				<option value="2" <? if($Emi_Paid==2) { echo "selected"; } ?>>6 to 9 months</option> 
				<option value="3" <? if($Emi_Paid==3) { echo "selected"; } ?>>9 to 12 months</option>
				<option value="4" <? if($Emi_Paid==4) { echo "selected"; } ?>>more than 12 months</option> 
			</select>
		</td>

</tr>


<tr><td class="fontstyle" colspan="4"><table width="100%" border="0" cellpadding="3" cellspacing="3">
<tr><td class="fontstyle"><strong>Obligation Details</strong></td><td class="fontstyle"></td><td colspan="3"></td></tr>

<tr>
 <td  width="20%"><strong>Type of Loan</strong><br><?php //echo $obligation_loan_type_1; ?>
 <select name="obligation_loan_type[]" ><option value="0">Please Select</option>
 <option value="Personal Loan" <?php if(trim($obligation_loan_type_1)=="Personal Loan") { echo "selected"; } ?>  >Personal Loan</option>
 <option value="Home Loan" <?php if(trim($obligation_loan_type_1)=="Home Loan") { echo "selected"; } ?> >Home Loan</option>
 <option value="Auto Loan" <?php if(trim($obligation_loan_type_1)=="Auto Loan") { echo "selected"; } ?> >Auto Loan</option>
  <option value="Consumer Durable Loan"  <?php if(trim($obligation_loan_type_1)=="Consumer Durable Loan") { echo "selected"; } ?> >Consumer Durable Loan</option>
 <option value="Education Loan" <?php if(trim($obligation_loan_type_1)=="Education Loan") { echo "selected"; } ?> >Education Loan</option>
  <option value="Gold Loan" <?php if(trim($obligation_loan_type_1)=="Gold Loan") { echo "selected"; } ?> >Gold Loan</option>
   <option value="Other Loan" <?php if(trim($obligation_loan_type_1)=="Other Loan") { echo "selected"; } ?> >Other Loan</option> 
</select>
 </td><td width="20%"><strong>Name of Bank</strong> <br>
  <select name="obligation_bank_name[]" ><option value="0">Please Select</option><?php $bnknm=ExecQuery("select Bank_Name from Bank_Master group by Bank_Name "); 
			while($plbnk=mysql_fetch_array($bnknm))
	{ ?>
			<option value="<? echo $plbnk["Bank_Name"]; ?>" <? if(strtoupper($obligation_bank_name_1)==strtoupper($plbnk["Bank_Name"])) { echo "Selected";} ?>><? echo $plbnk["Bank_Name"]; ?></option>
	<?  }
	?>
<option value="Other" <? if(strtoupper($obligation_bank_name_1)=="OTHER") { echo "Selected";} ?>>Other</option>
</select>

 </td>
 <td width="20%"><strong>Loan Amt</strong> <br>
 <input type="text" name="obligation_loan_amt[]" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" value="<?php echo $obligation_loan_amt_1; ?>" ></td>
 <td width="20%"><strong>EMI</strong> <br>
 
   <input type="text" name="obligation_emi_amt[]" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" value="<?php echo $obligation_emi_amt_1; ?>"  ></td><td >
	<strong>No of EMI</strong> <br><?php //echo $obligation_emi_1; ?>
 <select name="obligation_emi[]" ><option value="0">Please Select</option>
  <option value="0 To 6" <?php if($obligation_emi_1=="0 To 6") { echo "selected"; } ?> >0 To 6</option>
  <option value="6 To 9" <?php if($obligation_emi_1=="6 To 9") { echo "selected"; } ?>>6 To 9</option>
  <option value="9 To 12" <?php if($obligation_emi_1=="9 To 12") { echo "selected"; } ?>>9 To 12</option>
  <option value="More than 12" <?php if($obligation_emi_1=="More than 12") { echo "selected"; } ?>>More than 12</option>      
 </select>
           
   </td>
            </tr>
<tr>
 <td  width="20%"><strong>Type of Loan</strong><br>
 <select name="obligation_loan_type[]" ><option value="0">Please Select</option>
<option value="Personal Loan" <?php if($obligation_loan_type_2=="Personal Loan") { echo "selected"; } ?> >Personal Loan</option>
 <option value="Home Loan" <?php if($obligation_loan_type_2=="Home Loan") { echo  "selected"; } ?> >Home Loan</option>
 <option value="Auto Loan" <?php if($obligation_loan_type_2=="Auto Loan") { echo "selected"; } ?> >Auto Loan</option>
  <option value="Consumer Durable Loan"  <?php if($obligation_loan_type_2=="Consumer Durable Loan") { echo "selected"; } ?> >Consumer Durable Loan</option>
 <option value="Education Loan" <?php if($obligation_loan_type_2=="Education Loan") { echo "selected"; } ?> >Education Loan</option>
  <option value="Gold Loan" <?php if($obligation_loan_type_2=="Gold Loan") { echo "selected"; } ?> >Gold Loan</option>
  <option value="Other Loan" <?php if($obligation_loan_type_2=="Other Loan") { echo "selected"; } ?> >Other Loan</option> 
</select>
 </td><td width="20%"><strong>Name of Bank</strong> <br>
  <select name="obligation_bank_name[]" ><option value="0">Please Select</option><?php $bnknm=ExecQuery("select Bank_Name from Bank_Master group by Bank_Name "); 
			while($plbnk=mysql_fetch_array($bnknm))
	{ ?>
			<option value="<? echo $plbnk["Bank_Name"]; ?>" <? if(strtoupper($obligation_bank_name_2)==strtoupper($plbnk["Bank_Name"])) { echo "Selected";} ?>><? echo $plbnk["Bank_Name"]; ?></option>
	<?  }
	?>
<option value="Other" <? if(strtoupper($obligation_bank_name_2)=="OTHER") { echo "Selected";} ?>>Other</option>

</select>

 </td>
 <td width="20%"><strong>Loan Amt</strong> <br>
 <input type="text" name="obligation_loan_amt[]" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" value="<?php echo $obligation_loan_amt_2; ?>" ></td>
 <td width="20%"><strong>EMI</strong> <br>
 
   <input type="text" name="obligation_emi_amt[]" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" value="<?php echo $obligation_emi_amt_2; ?>"  ></td><td >
	<strong>No of EMI</strong> <br>
 <select name="obligation_emi[]" ><option value="0">Please Select</option>
  <option value="0 To 6" <?php if($obligation_emi_2=="0 To 6") { echo "selected"; } ?> >0 To 6</option>
  <option value="6 To 9" <?php if($obligation_emi_2=="6 To 9") { echo "selected"; } ?>>6 To 9</option>
  <option value="9 To 12" <?php if($obligation_emi_2=="9 To 12") { echo "selected"; } ?>>9 To 12</option>
  <option value="More than 12" <?php if($obligation_emi_2=="More than 12") { echo "selected"; } ?>>More than 12</option>      

 </select>
           
   </td>
            </tr>
<tr>
 <td  width="20%"><strong>Type of Loan</strong><br>
 <select name="obligation_loan_type[]" ><option value="0">Please Select</option>
<option value="Personal Loan" <?php if($obligation_loan_type_3=="Personal Loan") { echo "selected"; } ?> >Personal Loan</option>
 <option value="Home Loan" <?php if($obligation_loan_type_3=="Home Loan") { echo "selected"; } ?> >Home Loan</option>
 <option value="Auto Loan" <?php if($obligation_loan_type_3=="Auto Loan") { echo "selected"; } ?> >Auto Loan</option>
  <option value="Consumer Durable Loan"  <?php if($obligation_loan_type_3=="Consumer Durable Loan") { echo "selected"; } ?> >Consumer Durable Loan</option>
 <option value="Education Loan" <?php if($obligation_loan_type_3=="Education Loan") { echo "selected"; } ?> >Education Loan</option>
  <option value="Gold Loan" <?php if($obligation_loan_type_3=="Gold Loan") { echo "selected"; } ?> >Gold Loan</option>
   <option value="Other Loan" <?php if($obligation_loan_type_3=="Other Loan") { echo "selected"; } ?> >Other Loan</option> 
</select>
 </td><td width="20%"><strong>Name of Bank</strong> <br>
  <select name="obligation_bank_name[]" ><option value="0">Please Select</option><?php $bnknm=ExecQuery("select Bank_Name from Bank_Master group by Bank_Name "); 
			while($plbnk=mysql_fetch_array($bnknm))
	{ ?>
			<option value="<? echo $plbnk["Bank_Name"]; ?>" <? if(strtoupper($obligation_bank_name_3)==strtoupper($plbnk["Bank_Name"])) { echo "Selected";} ?>><? echo $plbnk["Bank_Name"]; ?></option>
	<?  }
	?>
<option value="Other" <? if(strtoupper($obligation_bank_name_3)=="OTHER") { echo "Selected";} ?>>Other</option>

</select>

 </td>
 <td width="20%"><strong>Loan Amt</strong> <br>
 <input type="text" name="obligation_loan_amt[]" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" value="<?php echo $obligation_loan_amt_3; ?>" ></td>
 <td width="20%"><strong>EMI</strong> <br>
 
   <input type="text" name="obligation_emi_amt[]" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" value="<?php echo $obligation_emi_amt_3; ?>"  ></td><td >
	<strong>No of EMI</strong> <br>
 <select name="obligation_emi[]" ><option value="0">Please Select</option>
   <option value="0 To 6" <?php if($obligation_emi_3=="0 To 6") { echo "selected"; } ?> >0 To 6</option>
  <option value="6 To 9" <?php if($obligation_emi_3=="6 To 9") { echo "selected"; } ?>>6 To 9</option>
  <option value="9 To 12" <?php if($obligation_emi_3=="9 To 12") { echo "selected"; } ?>>9 To 12</option>
  <option value="More than 12" <?php if($obligation_emi_3=="More than 12") { echo "selected"; } ?>>More than 12</option>      

 </select>
           
   </td>
            </tr>
<tr>
 <td  width="20%"><strong>Type of Loan</strong><br>
 <select name="obligation_loan_type[]" ><option value="0">Please Select</option>
<option value="Personal Loan" <?php if($obligation_loan_type_4=="Personal Loan") { echo "selected"; } ?> >Personal Loan</option>
 <option value="Home Loan" <?php if($obligation_loan_type_4=="Home Loan") { echo "selected"; } ?> >Home Loan</option>
 <option value="Auto Loan" <?php if($obligation_loan_type_4=="Auto Loan") { echo "selected"; } ?> >Auto Loan</option>
  <option value="Consumer Durable Loan"  <?php if($obligation_loan_type_4=="Consumer Durable Loan") { echo "selected"; } ?> >Consumer Durable Loan</option>
 <option value="Education Loan" <?php if($obligation_loan_type_4=="Education Loan") { echo "selected"; } ?> >Education Loan</option>
  <option value="Gold Loan" <?php if($obligation_loan_type_4=="Gold Loan") { echo "selected"; } ?> >Gold Loan</option>
   <option value="Other Loan" <?php if($obligation_loan_type_4=="Other Loan") { echo "selected"; } ?> >Other Loan</option> 
</select>
 </td><td width="20%"><strong>Name of Bank</strong> <br>
  <select name="obligation_bank_name[]" ><option value="0">Please Select</option><?php $bnknm=ExecQuery("select Bank_Name from Bank_Master group by Bank_Name "); 
 
	while($plbnk=mysql_fetch_array($bnknm))
	{ ?>
			<option value="<? echo $plbnk["Bank_Name"]; ?>" <? if(strtoupper($obligation_bank_name_4)==strtoupper($plbnk["Bank_Name"])) { echo "Selected";} ?>><? echo $plbnk["Bank_Name"]; ?></option>
	<?  }
	?>
<option value="Other" <? if(strtoupper($obligation_bank_name_4)=="OTHER") { echo "Selected";} ?>>Other</option>
</select>

 </td>
 <td width="20%"><strong>Loan Amt</strong> <br>
 <input type="text" name="obligation_loan_amt[]" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" value="<?php echo $obligation_loan_amt_4; ?>" ></td>
 <td width="20%"><strong>EMI</strong> <br>
 
   <input type="text" name="obligation_emi_amt[]" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" value="<?php echo $obligation_emi_amt_4; ?>"  ></td><td >
	<strong>No of EMI</strong> <br>
 <select name="obligation_emi[]" ><option value="0">Please Select</option>
  <option value="0 To 6" <?php if($obligation_emi_4=="0 To 6") { echo "selected"; } ?> >0 To 6</option>
  <option value="6 To 9" <?php if($obligation_emi_4=="6 To 9") { echo "selected"; } ?>>6 To 9</option>
  <option value="9 To 12" <?php if($obligation_emi_4=="9 To 12") { echo "selected"; } ?>>9 To 12</option>
  <option value="More than 12" <?php if($obligation_emi_4=="More than 12") { echo "selected"; } ?>>More than 12</option>      

 </select>
           
   </td>
            </tr>
<tr>
 <td  width="20%"><strong>Type of Loan</strong><br>
 <select name="obligation_loan_type[]" ><option value="0">Please Select</option>
<option value="Personal Loan" <?php if($obligation_loan_type_5=="Personal Loan") { echo "selected"; } ?> >Personal Loan</option>
 <option value="Home Loan" <?php if($obligation_loan_type_5=="Home Loan") { echo "selected"; } ?> >Home Loan</option>
 <option value="Auto Loan" <?php if($obligation_loan_type_5=="Auto Loan") { echo "selected"; } ?> >Auto Loan</option>
  <option value="Consumer Durable Loan"  <?php if($obligation_loan_type_5=="Consumer Durable Loan") { echo "selected"; } ?> >Consumer Durable Loan</option>
 <option value="Education Loan" <?php if($obligation_loan_type_5=="Education Loan") { echo "selected"; } ?> >Education Loan</option>
  <option value="Gold Loan" <?php if($obligation_loan_type_5=="Gold Loan") { echo "selected"; } ?> >Gold Loan</option>
   <option value="Other Loan" <?php if($obligation_loan_type_5=="Other Loan") { echo "selected"; } ?> >Other Loan</option> 
   </select>
 </td><td width="20%"><strong>Name of Bank</strong> <br>
  <select name="obligation_bank_name[]" ><option value="0">Please Select</option><?php $bnknm=ExecQuery("select Bank_Name from Bank_Master group by Bank_Name "); 
	 
	while($plbnk=mysql_fetch_array($bnknm))
	{ ?>
			<option value="<? echo $plbnk["Bank_Name"]; ?>" <? if(strtoupper($obligation_bank_name_5)==strtoupper($plbnk["Bank_Name"])) { echo "Selected";} ?>><? echo $plbnk["Bank_Name"]; ?></option>
	<?  }
	?>
<option value="Other" <? if(strtoupper($obligation_bank_name_5)=="OTHER") { echo "Selected";} ?>>Other</option>
</select>

 </td>
 <td width="20%"><strong>Loan Amt</strong> <br>
 <input type="text" name="obligation_loan_amt[]" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" value="<?php echo $obligation_loan_amt_5; ?>" ></td>
 <td width="20%"><strong>EMI</strong> <br>
 
   <input type="text" name="obligation_emi_amt[]" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" value="<?php echo $obligation_emi_amt_5; ?>"  ></td><td >
	<strong>No of EMI</strong> <br>
 <select name="obligation_emi[]" ><option value="0">Please Select</option>
  <option value="0 To 6" <?php if($obligation_emi_5=="0 To 6") { echo "selected"; } ?> >0 To 6</option>
  <option value="6 To 9" <?php if($obligation_emi_5=="6 To 9") { echo "selected"; } ?>>6 To 9</option>
  <option value="9 To 12" <?php if($obligation_emi_5=="9 To 12") { echo "selected"; } ?>>9 To 12</option>
  <option value="More than 12" <?php if($obligation_emi_5=="More than 12") { echo "selected"; } ?>>More than 12</option>      
 </select>
           
   </td>
            </tr>
<tr>
 <td  width="20%"><strong>Type of Loan</strong><br>
 <select name="obligation_loan_type[]" ><option value="0">Please Select</option>
<option value="Personal Loan" <?php if($obligation_loan_type_6=="Personal Loan") { echo "selected"; } ?> >Personal Loan</option>
 <option value="Home Loan" <?php if($obligation_loan_type_6=="Home Loan") { echo "selected"; } ?> >Home Loan</option>
 <option value="Auto Loan" <?php if($obligation_loan_type_6=="Auto Loan") { echo "selected"; } ?> >Auto Loan</option>
  <option value="Consumer Durable Loan"  <?php if($obligation_loan_type_6=="Consumer Durable Loan") { echo "selected"; } ?> >Consumer Durable Loan</option>
 <option value="Education Loan" <?php if($obligation_loan_type_6=="Education Loan") { echo "selected"; } ?> >Education Loan</option>
  <option value="Gold Loan" <?php if($obligation_loan_type_6=="Gold Loan") { echo "selected"; } ?> >Gold Loan</option>
   <option value="Other Loan" <?php if($obligation_loan_type_6=="Other Loan") { echo "selected"; } ?> >Other Loan</option> </select>
 </td><td width="20%"><strong>Name of Bank</strong> <br>
  <select name="obligation_bank_name[]" ><option value="0">Please Select</option><?php $bnknm=ExecQuery("select Bank_Name from Bank_Master group by Bank_Name "); 
		while($plbnk=mysql_fetch_array($bnknm))
	{ ?>
			<option value="<? echo $plbnk["Bank_Name"]; ?>" <? if(strtoupper($obligation_bank_name_6)==strtoupper($plbnk["Bank_Name"])) { echo "Selected";} ?>><? echo $plbnk["Bank_Name"]; ?></option>
	<?  }
	?>
<option value="Other" <? if(strtoupper($obligation_bank_name_6)=="OTHER") { echo "Selected";} ?>>Other</option>
</select>

 </td>
 <td width="20%"><strong>Loan Amt</strong> <br>
 <input type="text" name="obligation_loan_amt[]" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" value="<?php echo $obligation_loan_amt_6; ?>" ></td>
 <td width="20%"><strong>EMI</strong> <br>
 
   <input type="text" name="obligation_emi_amt[]" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" value="<?php echo $obligation_emi_amt_6; ?>"  ></td><td >
	<strong>No of EMI</strong> <br>
 <select name="obligation_emi[]" ><option value="0">Please Select</option>
  <option value="0 To 6" <?php if($obligation_emi_2=="0 To 6") { echo "selected"; } ?> >0 To 6</option>
  <option value="6 To 9" <?php if($obligation_emi_2=="6 To 9") { echo "selected"; } ?>>6 To 9</option>
  <option value="9 To 12" <?php if($obligation_emi_2=="9 To 12") { echo "selected"; } ?>>9 To 12</option>
  <option value="More than 12" <?php if($obligation_emi_2=="More than 12") { echo "selected"; } ?>>More than 12</option>      
 </select>
   </td>
</tr>
<tr><td></td><td></td><td>Total - <?php echo $totalLoanAmountObligation; ?></td><td>Total - <?php echo $totalLoanAmountEMIObligation; ?></td><td></td></tr>

</table></td></tr>

<tr><td class="fontstyle" colspan="4"><table width="100%" border="0" cellpadding="3" cellspacing="3">
<tr><td class="fontstyle"><strong>Credit Card Obligation</strong></td><td class="fontstyle"></td><td colspan="2"></td></tr>

<tr><td><strong>Name of Bank</strong> <br>
  <select name="cc_obligation_bank_name[]" ><option value="0">Please Select</option><?php $bnknm=ExecQuery("select Bank_Name from Bank_Master group by Bank_Name "); 
		while($plbnk=mysql_fetch_array($bnknm))
	{ ?>
			<option value="<? echo $plbnk["Bank_Name"]; ?>" <? if(strtoupper($cc_obligation_bank_name_1)==strtoupper($plbnk["Bank_Name"])) { echo "Selected";} ?>><? echo $plbnk["Bank_Name"]; ?></option>
	<?  }
	?>
<option value="Other" <? if(strtoupper($cc_obligation_bank_name_1)=="OTHER") { echo "Selected";} ?>>Other</option>
</select>
</td>
<td><strong>Outstanding Amount</strong> <br>
 <input type="text" name="cc_obligation_outstanding_amt[]" id="cc_obligation_outstanding_amt_1" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" value="<?php echo $cc_obligation_outstanding_amt_1; ?>" ></td>
<td>
<strong>Obligation(5% of OA)</strong> <br>
 <input type="text" name="cc_obligation_amt[]" id="cc_obligation_amt_1" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" value="<?php echo $cc_obligation_amt_1; ?>" >
</td>
 </tr>
<tr><td><strong>Name of Bank</strong> <br>
  <select name="cc_obligation_bank_name[]" ><option value="0">Please Select</option><?php $bnknm=ExecQuery("select Bank_Name from Bank_Master group by Bank_Name "); 
	while($plbnk=mysql_fetch_array($bnknm))
	{ ?>
			<option value="<? echo $plbnk["Bank_Name"]; ?>" <? if(strtoupper($obligation_bank_name_2)==strtoupper($plbnk["Bank_Name"])) { echo "Selected";} ?>><? echo $plbnk["Bank_Name"]; ?></option>
	<?  }
	?>
<option value="Other" <? if(strtoupper($obligation_bank_name_2)=="OTHER") { echo "Selected";} ?>>Other</option>
</select>
</td>
<td><strong>Outstanding Amount</strong> <br>
 <input type="text" name="cc_obligation_outstanding_amt[]" id="cc_obligation_outstanding_amt_1" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" value="<?php echo $cc_obligation_outstanding_amt_2; ?>" ></td>
<td>
<strong>Obligation(5% of OA)</strong> <br>
 <input type="text" name="cc_obligation_amt[]"  id="cc_obligation_amt_2" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" value="<?php echo $cc_obligation_amt_2; ?>" >
</td>
 </tr>
<tr><td><strong>Name of Bank</strong> <br>
  <select name="cc_obligation_bank_name[]" ><option value="0">Please Select</option><?php $bnknm=ExecQuery("select Bank_Name from Bank_Master group by Bank_Name "); 
		while($plbnk=mysql_fetch_array($bnknm))
	{ ?>
			<option value="<? echo $plbnk["Bank_Name"]; ?>" <? if(strtoupper($cc_obligation_bank_name_3)==strtoupper($plbnk["Bank_Name"])) { echo "Selected";} ?>><? echo $plbnk["Bank_Name"]; ?></option>
	<?  }
	?>
<option value="Other" <? if(strtoupper($cc_obligation_bank_name_3)=="OTHER") { echo "Selected";} ?>>Other</option>
</select>
</td>
<td><strong>Outstanding Amount</strong> <br>
 <input type="text" name="cc_obligation_outstanding_amt[]" id="cc_obligation_outstanding_amt_3" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" value="<?php echo $cc_obligation_outstanding_amt_3; ?>" ></td>
<td>
<strong>Obligation(5% of OA)</strong> <br>
 <input type="text" name="cc_obligation_amt[]" id="cc_obligation_amt_3" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" value="<?php echo $cc_obligation_amt_3; ?>" >
</td>
 </tr>
<tr><td><strong>Name of Bank</strong> <br>
  <select name="cc_obligation_bank_name[]" ><option value="0">Please Select</option><?php $bnknm=ExecQuery("select Bank_Name from Bank_Master group by Bank_Name "); 
		while($plbnk=mysql_fetch_array($bnknm))
	{ ?>
			<option value="<? echo $plbnk["Bank_Name"]; ?>" <? if(strtoupper($cc_obligation_bank_name_4)==strtoupper($plbnk["Bank_Name"])) { echo "Selected";} ?>><? echo $plbnk["Bank_Name"]; ?></option>
	<?  }
	?>
<option value="Other" <? if(strtoupper($cc_obligation_bank_name_4)=="OTHER") { echo "Selected";} ?>>Other</option>
</select>
</td>
<td><strong>Outstanding Amount</strong> <br>
 <input type="text" name="cc_obligation_outstanding_amt[]" id="cc_obligation_outstanding_amt_4" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" value="<?php echo $viewpl_amt; ?>" ></td>
<td>
<strong>Obligation(5% of OA)</strong> <br>
 <input type="text" name="cc_obligation_amt[]" onKeyUp="intOnly(this);"  id="cc_obligation_amt_4" onKeyPress="intOnly(this);" value="<?php echo $viewpl_amt; ?>" >
</td>
 </tr>
</table></td></tr>

<tr><td colspan="4">

<table width="100%" cellspacing="2" cellpadding="5" align="center" border="0">
      <tr>
        <td valign="top"  colspan="4"><span class="style2">Last 3 Months Salary: </span></td>
  </tr>
    <tr>
        <td valign="top" bgcolor="#F0F0F0"><span class="style2"><?php echo date('F', strtotime('-1 month'))." Month Salary";?>: </span></td>
        <td valign="top" bgcolor="#F0F0F0"><input type="text" name="SalaryArr[]" value="<?php echo $firstMonth; ?>" onkeyup="intOnly(this);" onkeypress="intOnly(this);" onkeydown="intOnly(this);" /></td>
    
        <td valign="top" bgcolor="#F0F0F0"><span class="style2"><?php echo date('F', strtotime('-2 month'))." Month Salary";?>: </span></td>
        <td valign="top" bgcolor="#F0F0F0"><input type="text" name="SalaryArr[]" value="<?php echo $secondMonth; ?>"  onkeyup="intOnly(this);" onkeypress="intOnly(this);" onkeydown="intOnly(this);" /></td>
  </tr>
      <tr>
        <td valign="top" ><span class="style2"><?php echo date('F', strtotime('-3 month'))." Month Salary";?>: </span></td>
        <td valign="top"  colspan="3"><input type="text" name="SalaryArr[]" value="<?php echo $thirdMonth; ?>"  onkeyup="intOnly(this);" onkeypress="intOnly(this);" onkeydown="intOnly(this);" /></td>
     </tr>
  <tr>
        <td valign="top" bgcolor="#F0F0F0" colspan="4"><span class="style2">Obligations: </span></td>
  </tr>
    <tr>
        <td valign="top" ><span class="style2">Total Unsecured EMI: </span></td>
        <td valign="top"><input type="text" name="unsecured_emi" value="<?php echo $unsecured_emi; ?>" onkeyup="intOnly(this);" onkeypress="intOnly(this);" onkeydown="intOnly(this);" /></td>
    
        <td valign="top" ><span class="style2">Total Card Outstanding: </span></td>
        <td valign="top" ><input type="text" name="card_outstanding" value="<?php echo $card_outstanding; ?>"  onkeyup="intOnly(this);" onkeypress="intOnly(this);" onkeydown="intOnly(this);" /></td>
  </tr>  
   <tr>
        <td valign="top" bgcolor="#F0F0F0" ><span class="style2">Total Secured EMI: </span></td>
        <td valign="top" bgcolor="#F0F0F0"><input type="text" name="secured_emi" value="<?php echo $secured_emi; ?>" onkeyup="intOnly(this);" onkeypress="intOnly(this);" onkeydown="intOnly(this);" /></td>
    
      <td valign="top" bgcolor="#F0F0F0" ><span class="style2">CIBIL Reference ID: </span></td>
        <td valign="top" bgcolor="#F0F0F0"><input type="text" name="cibil_reference_id" value="<?php echo $cibil_reference_id; ?>" /></td>
       
 <?php
 if($averageSalary>0)
 {
 ?>
    <tr>
        <td valign="top" colspan="2" ><span class="style2">Average Salary: </span>&nbsp;Rs. <?php echo $averageSalary; ?></td>
        <td valign="top" colspan="2"><span class="style2">Total Unsecured Obligation: </span>&nbsp;Rs. <?php echo $total_unsecured_obligation; ?> (<?php echo $unsecuredFOIR; ?>%)</td>
     
  </tr>  
<tr>
   <td valign="top" colspan="2" ><span class="style2">Total Obligation: </span>&nbsp;Rs. <?php echo $total_obligation; ?>(<?php echo $totalFOIR; ?>%)</td>
    <td align="right" colspan="2"><span class="style2">Standard EMI Rs. 2757 (14.5%,1 Lac, 4 Years)</span></td></tr>
<tr>    
    <td valign="top" colspan="4" ><span class="style2">Eligible Loan Amount: </span>&nbsp;Rs. <?php echo $eligible_loan_amount; ?></td>

  </tr>  
  <?php } ?>
</table>
</td></tr>


<tr>
<td colspan="4" bgcolor="#DAEAF9" align="center" style="border:1px solid black;"><b>Bidders Details </b></td></tr>
<? if($City=="Others" || $City=="Please Select")
{
	$City=$City_Other;
}
else
{
	$City= $City;
}
//echo $City;?>
<tr><td class="fontstyle" valign="top"><b>Eligible for Bidders</b></td><? if(strlen($Bidderid_Details)>0){ ?><td class="fontstyle" colspan="2"> already send</td><? } else {?><td colspan="2"><div id="checkdiv" name="checkdiv"><? 
$bajajchek=ExecQuery("Select bajajf_plrequestid From bajaj_cibildetails Where (bajajf_plrequestid=".$post.")");
$bjjchek=mysql_fetch_array($bajajchek);
$bajajf_plrequestid=$bjjchek["bajajf_plrequestid"];
if($bajajf_plrequestid>1)
{	$compforbajaj="bajaj";}else	{$compforbajaj="";	}
//echo "<br>".$post.", ".$City.", ".$Referral_Flag.", ".$source;
list($FinalBidder,$finalBidderName, $FinalBankID)= getBiddersList("Req_Loan_Personal",$post,$City,$Referral_Flag,"wfappointment");
//print_r($FinalBidder);
//echo "<br>";
//print_r($finalBidderName);
//echo "<br>";


$allocatedSQl = "select Req_Feedback_Bidder1.BidderID as AllocatedBidderID, BankID, Bidder_Name as AllocatedBidders from Req_Feedback_Bidder1 left join Bidders_List on Bidders_List.BidderID=Req_Feedback_Bidder1.BidderID  where Req_Feedback_Bidder1.AllRequestID='".$post."' and Req_Feedback_Bidder1.Reply_Type=1";
$allocatedQuery = ExecQuery($allocatedSQl);
$allocatedCount = mysql_num_rows($allocatedQuery);
if($allocatedCount>0)
{
	$allocatedBidder='';
	$allocatedBankID = '';
	$displayAllocated = '';
	for($i=0;$i<$allocatedCount;$i++)
	{
		$AllocatedBidderID = mysql_result($allocatedQuery,$i,'AllocatedBidderID');
		$allocatedBidder[]= mysql_result($allocatedQuery,$i,'AllocatedBidderID');
		$allocatedBankID[]= mysql_result($allocatedQuery,$i,'BankID');	
		$AllocatedBidders= mysql_result($allocatedQuery,$i,'AllocatedBidders');
		$displayAllocated[] = $AllocatedBidders."(".$AllocatedBidderID.")";
	}
	$displayAllocatedStr = implode(', ', $displayAllocated);
	echo "<br><b>Allocated Bidders</b> - ".$displayAllocatedStr."<br><br>";
	
	$allocatedBankIDStr = implode(',', $allocatedBankID);
	//get new Set of BidderID from Bidders_List
	$strFinalBidder = implode(',', $FinalBidder);
	$getFinalBiddersSql = "select BidderID, BankID as FinalBankID, Bidder_Name from Bidders_List where BidderID in (".$strFinalBidder.") and BankID not in (".$allocatedBankIDStr.")";
	$getFinalBiddersQuery = ExecQuery($getFinalBiddersSql);
	$getFinalBiddersCount = mysql_num_rows($getFinalBiddersQuery);
	$FinalBidder = '';
	$finalBidderName = '';
	for($i=0;$i<$getFinalBiddersCount;$i++)
	{
		$FinalBidder[]= mysql_result($getFinalBiddersQuery,$i,'BidderID');
		$finalBidderName[]= mysql_result($getFinalBiddersQuery,$i,'Bidder_Name');	
	}



}

   for($i=0;$i<count($FinalBidder);$i++)
			{	   
	if(($FinalBidder[$i]==3994 || $FinalBidder[$i]==3995 || $FinalBidder[$i]==3996 || $FinalBidder[$i]==3997 || $FinalBidder[$i]==3998 || $FinalBidder[$i]==3999 || $FinalBidder[$i]==4030 || $FinalBidder[$i]==4031 || $FinalBidder[$i]==2927 || $FinalBidder[$i]==4035 || $FinalBidder[$i]==4036 || $FinalBidder[$i]==2930 || $FinalBidder[$i]==4336 || $FinalBidder[$i]==4337 || $FinalBidder[$i]==4338 || $FinalBidder[$i]==4339 || $FinalBidder[$i]==4382 || $FinalBidder[$i]==4381) && (($icici_bankcmp=='') && $Net_Salary<480000))
				{
				}
		elseif(($FinalBidder[$i]==4083 || $FinalBidder[$i]==4084 || $FinalBidder[$i]==4085 || $FinalBidder[$i]==4086 || $FinalBidder[$i]==4087 || $FinalBidder[$i]==4088 || $FinalBidder[$i]==4089 || $FinalBidder[$i]==4090 || $FinalBidder[$i]==4091 || $FinalBidder[$i]==4092  || $FinalBidder[$i]==5168 || $FinalBidder[$i]==5409 || $FinalBidder[$i]==5410 || $FinalBidder[$i]==5411 || $FinalBidder[$i]==5412 || $FinalBidder[$i]==5413 || $FinalBidder[$i]==5414 || $FinalBidder[$i]==5415) && (($PL_EMI_Paid<=9 && $Existing_Loan>1)))
				{
				}
			if($hdfccategory="" && ($FinalBidder[$i]==4804 || $FinalBidder[$i]==4403 || $FinalBidder[$i]==2629) && $Net_Salary<420000)
				{			}
				if($hdfccategory="" && ($FinalBidder[$i]==5023) && $Net_Salary<300000)
				{			}
	  else if((($FinalBidder[$i]==2896 || $FinalBidder[$i]==2923 || $FinalBidder[$i]==2925 || $FinalBidder[$i]==2926 || $FinalBidder[$i]==2929 || $FinalBidder[$i]==2931 || $FinalBidder[$i]==2932 || $FinalBidder[$i]==2933 ||  $FinalBidder[$i]==3075 || $FinalBidder[$i]==3076 ||   $FinalBidder[$i]==3199  ||    $FinalBidder[$i]==3576 || $FinalBidder[$i]==3658  ) && (($icici_bankcmp=='' && $Net_Salary<360000 && ((strncmp("ICICI", $Primary_Acc,5))==0)) || ($icici_bankcmp=='' && ((strncmp("ICICI", $Primary_Acc,5))!=0) && $Net_Salary<480000))) 
|| 
((($icici_bankcmp=="Preferred" && ((strncmp("ICICI", $Primary_Acc,5))!=0) && $Net_Salary<360000) || ($icici_bankcmp=="Preferred" && ((strncmp("ICICI", $Primary_Acc,5))==0) && $Net_Salary<300000)) && ($FinalBidder[$i]==2896 || $FinalBidder[$i]==2923 || $FinalBidder[$i]==2925 || $FinalBidder[$i]==2926 || $FinalBidder[$i]==3254 || $FinalBidder[$i]==2929 || $FinalBidder[$i]==2931 || $FinalBidder[$i]==2932 || $FinalBidder[$i]==2933 || $FinalBidder[$i]==3075 || $FinalBidder[$i]==3076  || $FinalBidder[$i]==3199 ||  $FinalBidder[$i]==2919 ||   $FinalBidder[$i]==3576  || $FinalBidder[$i]==3658 )))
		{
		}
	elseif(($FinalBidder[$i]==3449 || $FinalBidder[$i]==2919 || $FinalBidder[$i]==3254 || $FinalBidder[$i]==3753 || $FinalBidder[$i]==3255 || $FinalBidder[$i]==3256 || $FinalBidder[$i]==3450 || $FinalBidder[$i]==2918 || $FinalBidder[$i]==2982 || $FinalBidder[$i]==3134 || $FinalBidder[$i]==3216 || $FinalBidder[$i]==3241 || $FinalBidder[$i]==3754 || $FinalBidder[$i]==3258 || $FinalBidder[$i]==3259 || $FinalBidder[$i]==3554 || $FinalBidder[$i]==3581) && ((((strncmp("ICICI", $Primary_Acc,5))!=0) && $Net_Salary<384000) || (((strncmp("ICICI", $Primary_Acc,5))==0) && $Net_Salary<288000)))
				{
				}
elseif(($FinalBidder[$i]==3451 ||  $FinalBidder[$i]==3195 ||  $FinalBidder[$i]==4353 ||  $FinalBidder[$i]==3196 ||  $FinalBidder[$i]==3452)  && ((((strncmp("ICICI", $Primary_Acc,5))!=0) && $Net_Salary<300000) || (((strncmp("ICICI", $Primary_Acc,5))==0) && $Net_Salary<240000)))
				{
				}
elseif(($FinalBidder[$i]==4872 || $FinalBidder[$i]==3061 || $FinalBidder[$i]==4353 ||  $FinalBidder[$i]==4701 || $FinalBidder[$i]==4815 ||  $FinalBidder[$i]==3595 || $FinalBidder[$i]==4671  || $FinalBidder[$i]==2917 || $FinalBidder[$i]==4798 || $FinalBidder[$i]==4388 || $FinalBidder[$i]==5322 || $FinalBidder[$i]==6332 || $FinalBidder[$i]==6333 || $FinalBidder[$i]==6334 || $FinalBidder[$i]==6335 || $FinalBidder[$i]==6336) && (((strncmp("ICICI", $Primary_Acc,5))!=0 && $icici_bankcmp=="" && $Net_Salary<360000) || ((strncmp("ICICI", $Primary_Acc,5))!=0 && strlen($icici_bankcmp)>2 && $Net_Salary<300000) || ((strncmp("ICICI", $Primary_Acc,5))==0 && $Net_Salary<360000 && strlen($icici_bankcmp)>2) || ((strncmp("ICICI", $Primary_Acc,5))==0 && $Net_Salary<360000 && $icici_bankcmp=="")))
				{
				}
elseif(($FinalBidder[$i]==2963 || $FinalBidder[$i]==3868 || $FinalBidder[$i]==2984 || $FinalBidder[$i]==3198 || $FinalBidder[$i]==3532 || $FinalBidder[$i]==3533 || $FinalBidder[$i]==3945 || $FinalBidder[$i]==3381 || $FinalBidder[$i]==4668 || $FinalBidder[$i]==4459 || $FinalBidder[$i]==4461 || $FinalBidder[$i]==4807 || $FinalBidder[$i]==4398 || $FinalBidder[$i]==2962 || $FinalBidder[$i]==3133 || $FinalBidder[$i]==3380 || $FinalBidder[$i]==5333) && (((strncmp("ICICI", $Primary_Acc,5))!=0 && $icici_bankcmp=="" && $Net_Salary<420000) || ((strncmp("ICICI", $Primary_Acc,5))==0 && $Net_Salary<420000 && $icici_bankcmp=="")))
				{
				}
elseif(($FinalBidder[$i]==3132 || $FinalBidder[$i]==4318 || $FinalBidder[$i]==4460) && (((strncmp("ICICI", $Primary_Acc,5))!=0 && $icici_bankcmp=="" && $Net_Salary<384000) || ((strncmp("ICICI", $Primary_Acc,5))==0 && $Net_Salary<384000 && $icici_bankcmp=="")))
				{
				}
elseif((($icici_bankcmp=="" && ((strncmp("ICICI", $Primary_Acc,5))!=0) && $Net_Salary<360000) || ($icici_bankcmp=="" && ((strncmp("ICICI", $Primary_Acc,5))==0) && $Net_Salary<240000)) && ($FinalBidder[$i]==4387) )
				{
				}
elseif((($icici_bankcmp=="" && ((strncmp("ICICI", $Primary_Acc,5))!=0) && $Net_Salary<396000) || ($icici_bankcmp=="" && ((strncmp("ICICI", $Primary_Acc,5))==0) && $Net_Salary<264000)) && ($FinalBidder[$i]==4900) )
				{
				}
elseif ($icici_bankcmp!="" && $FinalBidder[$i]==5993)
				{
				}
elseif((($icici_bankcmp=="Preferred" && ($Net_Salary<360000)) || ($icici_bankcmp=="" && $Net_Salary<360000)) && $FinalBidder[$i]==4393)
				{
				}
elseif(($FinalBidder[$i]==4669  || $FinalBidder[$i]==4399) && (((strncmp("ICICI", $Primary_Acc,5))!=0 && $icici_bankcmp=="" && $Net_Salary<480000) || ((strncmp("ICICI", $Primary_Acc,5))!=0 && strlen($icici_bankcmp)>2 && $Net_Salary<360000) || ((strncmp("ICICI", $Primary_Acc,5))==0 && $Net_Salary<360000 && $icici_bankcmp=="") || ((strncmp("ICICI", $Primary_Acc,5))==0 && $Net_Salary<240000 && strlen($icici_bankcmp)>2)))
			{
			}
else if((($FinalBidder[$i]==2934) && (($icici_bankcmp=='' && $Net_Salary<300000 && ((strncmp("ICICI", $Primary_Acc,5))==0)) || ($icici_bankcmp=='' && ((strncmp("ICICI", $Primary_Acc,5))!=0) && $Net_Salary<360000))) 
|| 
((($icici_bankcmp=="Preferred" && ((strncmp("ICICI", $Primary_Acc,5))!=0) && $Net_Salary<360000) || ($icici_bankcmp=="Preferred" && ((strncmp("ICICI", $Primary_Acc,5))==0) && $Net_Salary<300000)) && ($FinalBidder[$i]==2934)))
				{
				}
elseif(($FinalBidder[$i]==3050 || $FinalBidder[$i]==2479 || $FinalBidder[$i]==2908 || $FinalBidder[$i]==3098 || $FinalBidder[$i]==3107 || $FinalBidder[$i]==3116 || $FinalBidder[$i]==3161 || $FinalBidder[$i]==3214 || $FinalBidder[$i]==3208 || $FinalBidder[$i]==3219 || $FinalBidder[$i]==2952 || $FinalBidder[$i]==2765 || $FinalBidder[$i]==3226 || $FinalBidder[$i]==3263 || $FinalBidder[$i]==3264 || $FinalBidder[$i]==3276 || $FinalBidder[$i]==3306 || $FinalBidder[$i]==3416 || $FinalBidder[$i]==3428 || $FinalBidder[$i]==3446 || $FinalBidder[$i]==3539 || $FinalBidder[$i]==3559 || $FinalBidder[$i]==2574 || $FinalBidder[$i]==3661 || $FinalBidder[$i]==3695 || $FinalBidder[$i]==3700 || $FinalBidder[$i]==3721 || $FinalBidder[$i]==3670 || $FinalBidder[$i]==3732 || $FinalBidder[$i]==2878 || $FinalBidder[$i]==2774 || $FinalBidder[$i]==3755 || $FinalBidder[$i]==3763 || $FinalBidder[$i]==3773 || $FinalBidder[$i]==3790 || $FinalBidder[$i]==3828 || $FinalBidder[$i]==3892 || $FinalBidder[$i]==3922 || $FinalBidder[$i]==3937 || $FinalBidder[$i]==3939 || $FinalBidder[$i]==3949 || $FinalBidder[$i]==4008 || $FinalBidder[$i]==4121 || $FinalBidder[$i]==2765 || $FinalBidder[$i]==4194 || $FinalBidder[$i]==4243 || $FinalBidder[$i]==4286 || $FinalBidder[$i]==4325 || $FinalBidder[$i]==4334 || $FinalBidder[$i]==4348 || $FinalBidder[$i]==4405 || $FinalBidder[$i]==4464 || $FinalBidder[$i]==4590 || $FinalBidder[$i]==4708 || $FinalBidder[$i]==4719 || $FinalBidder[$i]==6321 || $FinalBidder[$i]==6322 || $FinalBidder[$i]==6323 || $FinalBidder[$i]==6324 || $FinalBidder[$i]==6325) && ($citicategorycmp==''))
				{ 
				}
elseif(($FinalBidder[$i]==4505 || $FinalBidder[$i]==5202) && ($citicategorycmp=='' && $Primary_Acc!="Citibank"))
				{
				}
elseif(($FinalBidder[$i]==2721 || $FinalBidder[$i]==3359 || $FinalBidder[$i]==4494 || $FinalBidder[$i]==3722 || $FinalBidder[$i]==2722 || $FinalBidder[$i]==3390 || $FinalBidder[$i]==3579 || $FinalBidder[$i]==2809 || $FinalBidder[$i]==2723 || $FinalBidder[$i]==2830 || $FinalBidder[$i]==3376 || $FinalBidder[$i]==2937 || $FinalBidder[$i]==5164) && (($citicategory=="") && ($Company_Type<4)))
				{
				}
	elseif($hdbfscategorycmp=='' && ($FinalBidder[$i]==2691 || $FinalBidder[$i]==2471 || $FinalBidder[$i]==2472 || $FinalBidder[$i]==2473 ))
				{
				}
	elseif(((($kotakcategory=='' || $kotakcategory=='"CAT D') && $Net_Salary<480000))  && ($FinalBidder[$i]==2999 ||  $FinalBidder[$i]==3001 || $FinalBidder[$i]==5566 || $FinalBidder[$i]==3004 || $FinalBidder[$i]==3008 || $FinalBidder[$i]==3009 || $FinalBidder[$i]==5226 || $FinalBidder[$i]==3002 || $FinalBidder[$i]==3005 || $FinalBidder[$i]==3006 || $FinalBidder[$i]==3003 || $FinalBidder[$i]==3654 || $FinalBidder[$i]==3007 || $FinalBidder[$i]==3010 || $FinalBidder[$i]==3011 || $FinalBidder[$i]==3012 || $FinalBidder[$i]==3014 || $FinalBidder[$i]==3015 || $FinalBidder[$i]==3890 || $FinalBidder[$i]==3889 || $FinalBidder[$i]==4837 || $FinalBidder[$i]==4846 || $FinalBidder[$i]==5203 || $FinalBidder[$i]==4592 || $FinalBidder[$i]==4595 || $FinalBidder[$i]==5344 || $FinalBidder[$i]==5345 || $FinalBidder[$i]==5346 || $FinalBidder[$i]==5347 || $FinalBidder[$i]==5348 || $FinalBidder[$i]==5349 || $FinalBidder[$i]==5350 || $FinalBidder[$i]==5351 || $FinalBidder[$i]==5352 || $FinalBidder[$i]==5353 || $FinalBidder[$i]==5354 || $FinalBidder[$i]==5355 || $FinalBidder[$i]==5325 || $FinalBidder[$i]==5378 || $FinalBidder[$i]==5386 || $FinalBidder[$i]==5677 || $FinalBidder[$i]==5676 || $FinalBidder[$i]==5916 || $FinalBidder[$i]==5920 || $FinalBidder[$i]==6162 || $FinalBidder[$i]==3000 || $FinalBidder[$i]==2998 || $FinalBidder[$i]==6280 || $FinalBidder[$i]==6292 || $FinalBidder[$i]==6293 || $FinalBidder[$i]==6298))
				{
				}
  elseif(((($kotakcategory=='' || $kotakcategory=='"CAT D') && $Net_Salary<960000))  && ($FinalBidder[$i]==3801))
   		        {
				}
  elseif(((($kotakcategory=='' || $kotakcategory=='"CAT D') && $Net_Salary<420000))  && ($FinalBidder[$i]==6375))
   		        {
				}
  elseif(((($kotakcategory=='' || $kotakcategory=='"CAT D') && $Net_Salary<840000))  && ($FinalBidder[$i]==4407))
   		        {
				}
  elseif(((($kotakcategory=='' || $kotakcategory=='"CAT D') && $Net_Salary<720000))  && ($FinalBidder[$i]==5889))
   		        {
				}
						
	/*elseif(($FinalBidder[$i]==2423 || $FinalBidder[$i]==3966 || $FinalBidder[$i]==3967 || $FinalBidder[$i]==2422 || $FinalBidder[$i]==2426 || $FinalBidder[$i]==4656 || $FinalBidder[$i]==5108 || $FinalBidder[$i]==2424 || $FinalBidder[$i]==2425 || $FinalBidder[$i]==3645 || $FinalBidder[$i]==3842 || $FinalBidder[$i]==2429 || $FinalBidder[$i]==3953 || $FinalBidder[$i]==3335 || $FinalBidder[$i]==2427 || $FinalBidder[$i]==5296 || $FinalBidder[$i]==5297 || $FinalBidder[$i]==5300 || $FinalBidder[$i]==5301 || $FinalBidder[$i]==5656) && (($Net_Salary<900000 && ($bajajfinservcategory=="")) && $Company_Type!=4))
				{
				}	*/
	elseif(($FinalBidder[$i]==2428 || $FinalBidder[$i]==2423 || $FinalBidder[$i]==3966 || $FinalBidder[$i]==3967 || $FinalBidder[$i]==2422 || $FinalBidder[$i]==2426 || $FinalBidder[$i]==4656 || $FinalBidder[$i]==5108 || $FinalBidder[$i]==2424 || $FinalBidder[$i]==2425 || $FinalBidder[$i]==3645 || $FinalBidder[$i]==3842 || $FinalBidder[$i]==2429 || $FinalBidder[$i]==3953 || $FinalBidder[$i]==3335 || $FinalBidder[$i]==2427  || $FinalBidder[$i]==2444 || $FinalBidder[$i]==5296 || $FinalBidder[$i]==5297 || $FinalBidder[$i]==5300 || $FinalBidder[$i]==5301) && ($Company_Name=="INDIAN NAVY" || $Company_Name=="INDIAN AIR FORCE" || $Company_Name=="INDIAN ARMY"))
				{
				}
	elseif(($FinalBidder[$i]==5945 || $FinalBidder[$i]==5946 || $FinalBidder[$i]==5947 || $FinalBidder[$i]==5948|| $FinalBidder[$i]==5949 || $FinalBidder[$i]==5950 || $FinalBidder[$i]==5951 || $FinalBidder[$i]==5952 || $FinalBidder[$i]==5953 || $FinalBidder[$i]==5954 || $FinalBidder[$i]==5955 || $FinalBidder[$i]==5956) && ($capitalfirstcomp=="" && $Net_Salary<600000))
				{
				}
	elseif(($FinalBidder[$i]==5247 || $FinalBidder[$i]==5250 || $FinalBidder[$i]==5235 || $FinalBidder[$i]==5236 ||  $FinalBidder[$i]==5237 || $FinalBidder[$i]==5243 || $FinalBidder[$i]==5241 || $FinalBidder[$i]==5242 ||  $FinalBidder[$i]==5240 || $FinalBidder[$i]==5245 || $FinalBidder[$i]==5239 || $FinalBidder[$i]==5319 || $FinalBidder[$i]==5320 || $FinalBidder[$i]==5321) && ($Net_Salary<600000 && $tatacapitalcomp==""))
				{
				}
	elseif(strlen($bajajfinservcategory)>2 && $FinalBidder[$i]==4830 && ($Company_Name=="INDIAN NAVY" || $Company_Name=="INDIAN AIR FORCE" || $Company_Name=="INDIAN ARMY"))
				{
				}
	elseif(($FinalBidder[$i]==4851) && (strlen($bajajfinservcategory)>1) && ($Company_Name=="INDIAN NAVY" || $Company_Name=="INDIAN AIR FORCE" || $Company_Name=="INDIAN ARMY"))
				{
				}
	else if ($City=="Chandigarh" && ($Company_Name=="dell international" || $Company_Name=="DELL INTERNATIONAL SERVICE LIMITED/DELL INTERNATIONAL SERVICES INDIA PVT. LIMITED" || (strncmp ("Dell", $Company_Name,4))==0 || (strncmp ("DELL", $Company_Name,4))==0 || (strncmp ("dell", $Company_Name,4))==0) && $FinalBidder[$i]==1887)
		{
		}
	elseif(($FinalBidder[$i]==3724 || $FinalBidder[$i]==3725 || $FinalBidder[$i]==3787 || $FinalBidder[$i]==3788 || $FinalBidder[$i]==3968 || $FinalBidder[$i]==3900) && ($stanc_category=="" && $stanc_account==""))
				{
				}
	elseif($compforbajaj=="bajaj" && ($finalBidderName[$i]=="Bajaj Finserv" || $finalBidderName[$i]=="Bajaj finserv"))
				{
				}
		elseif(($FinalBidder[$i]==5648 || $FinalBidder[$i]==5649 || $FinalBidder[$i]==5650) && $Primary_Acc!="HDFC" && $Net_Salary<216000)
				{
				}
		elseif($adityabirla=="" && $FinalBidder[$i]==6096)
				{}
				else
				{
				
					//echo "<input type='checkbox' value='$FinalBidder[$i]' name='Final_Bidder[$i]' id='Final_Bidder[$i]'>".$finalBidderName[$i]."(".$FinalBidder[$i].")";
					echo "<input type='radio' value='$FinalBidder[$i]' name='Final_Bidder' id='Final_Bidder_$i'>".$finalBidderName[$i]."(".$FinalBidder[$i].")";
				}

if($Existing_Loan>0)
				{
	
	if(($finalBidderName[$i]=="HDFC" || $finalBidderName[$i]=="HDFC Bank"))
		{
		 list($BTRate,$BTProcessingFee)=hdfcbt_pl($Existing_Loan);
		if($BTRate>0)
			{
				$hdfcputinarry= array($finalBidderName[$i],$BTRate,$BTProcessingFee);
				$btbiddersarry[]=$hdfcputinarry;
		//echo "<input type='checkbox' value='$FinalBidder[$r]' name='Final_Bidder[$r]' id='Final_Bidder[$r]'>".$finalBidderName[$i]."(".$FinalBidder[$i].")";
		}
		}
		elseif($finalBidderName[$i]=="ICICI Bank" )
		{
		 list($iciciBTRate,$iciciBTProcessingFee)=icicibt_pl($Existing_Loan,$Employment_Status,$Existing_Rate);
		if($iciciBTRate>0)
			{
			$iciciputinarry= array($finalBidderName[$i],$iciciBTRate,$iciciBTProcessingFee);
			$btbiddersarry[]=$iciciputinarry;
		//echo "<input type='checkbox' value='$FinalBidder[$r]' name='Final_Bidder[$r]' id='Final_Bidder[$r]'>".$finalBidderName[$i]."(".$FinalBidder[$i].")";
		}
		}
		elseif($finalBidderName[$i]=="Kotak Bank" )
		{
		 list($kotakBTRate,$kotakBTProcessingFee)=kotakbt_pl($Existing_Loan,$kotakcategory,$Existing_Rate,$monthsalary);
			if($kotakBTRate>0)
			{
				$kotakputinarry= array($finalBidderName[$i],$kotakBTRate,$kotakBTProcessingFee);
				$btbiddersarry[]=$kotakputinarry;
				//echo "<input type='checkbox' value='$FinalBidder[$r]' name='Final_Bidder[$r]' id='Final_Bidder[$r]'>".$finalBidderName[$i]."(".$FinalBidder[$i].")";
			}
		}
		elseif(($finalBidderName[$i]=="Citibank" || $finalBidderName[$i]=="CitiBank"))
		{
		 list($citibankBTRate,$citibankBTProcessingFee)=citibankbt_pl($Existing_Loan,$citicategorycmp);
		if($citibankBTRate>0)
			{
			$citiputinarry= array($finalBidderName[$i],$citibankBTRate,$citibankBTProcessingFee);
			$btbiddersarry[]=$citiputinarry;
			
		//echo "<input type='checkbox' value='$FinalBidder[$r]' name='Final_Bidder[$r]' id='Final_Bidder[$r]'>".$finalBidderName[$i]."(".$FinalBidder[$i].")";
		}
		}
		
				}//existing loan		
			}
}	
		?></div></td>
</tr>
<tr>
<td><label for="country">Company Name </label></td>
<td><input name="company" id="company"   type="text" onKeyUp="ajax_showOptions(this,'getCountriesByLetters',event)" value="<? echo $Company_Name;?>" size=45/>                                   
</td><td colspan="2"><a class="txt-button" onclick="javascript:void window.open('http://www.deal4loans.com/validate_company_check.php?id=<?php echo $post ; ?>','','width=810,height=300,resizable=false,left=0,top=0,location=no,scrollbars=no,status=no,toolbar=no');return false;"><b>Check HDFC Company</b></a></td></tr>
<? if($Existing_Loan>0)
				{ ?>
<tr>
<td colspan="4" bgcolor="#DAEAF9" align="center" style="border:1px solid black;"><b>BT calculation Details </b></td></tr>
<tr><td colspan="4">
	<table border="1" width="100%">
	<tr><td width="11%" height="25" align="center" valign="middle"><b style="font-size:12px;">Bank Name</b></td>
	<td width="11%" align="center"><b style="font-size:12px;">Loan Amount</b></td>
	<td width="11%" align="center"><b style="font-size:12px;">ROI</b></td>
	<td width="11%" align="center"><b style="font-size:12px;">prco. feee</b></td></tr>
<? for ($p=0; $p<count($btbiddersarry); $p++)
					{
						?>
<tr> <td height="25" align="center" valign="middle"><b style="font-size:12px;"><? echo $btbiddersarry[$p][0]; ?></b></td>
		<td align="center"><? echo $Existing_Loan; ?></td>
		<td align="center"><? echo $btbiddersarry[$p][1]." %"; ?></td>
		<td align="center"><? echo $btbiddersarry[$p][2]; ?></td>		
		</tr>
		<? } ?>
	</table>
</td></tr>
<? } ?>
     <tr><td colspan="4" align="center">
     <table border="1" width="100%">
<tr> <td height="25" align="right" valign="middle" colspan="8"><select name="reqtenure"><option value="">Select Tenure</option>
<option value="1" <?php if($reqtenure==1) { echo "selected"; } ?> >1 Year</option>
<option value="2" <?php if($reqtenure==2) { echo "selected"; } ?> >2 Years</option>
<option value="3" <?php if($reqtenure==3) { echo "selected"; } ?> >3 Years</option>
<option value="4" <?php if($reqtenure==4) { echo "selected"; } ?> >4 Years</option>
<option value="5" <?php if($reqtenure==5) { echo "selected"; } ?> >5 Years</option>
<option value="6" <?php if($reqtenure==6) { echo "selected"; } ?> >6 Years</option>

</select></td></tr>     
<tr> <td width="11%" height="25" align="center" valign="middle"><b style="font-size:12px;">Bank Name</b></td>
	<td width="11%" align="center"><b style="font-size:12px;">Loan Amount</b></td>
	<td width="11%" align="center"><b style="font-size:12px;">ROI</b></td>

	<td width="11%" align="center"><b style="font-size:12px;">EMI</b></td>
	<td width="11%" align="center"><b style="font-size:12px;">EMI(Per Lac)</b></td>
	<td width="11%" align="center"><b style="font-size:12px;">Company Cat</b></td>
	<!--<td width="11%" align="center"><b style="font-size:12px;">Pre. charges</b></td>-->
	<td width="11%" align="center"><b style="font-size:12px;">prco. feee</b></td>
	<td width="11%" align="center"><b style="font-size:12px;">Tenure</b></td>
	</tr>

<?php
/*$annualIncome = "900000";
$companyName = "ABBOTT PHARMACEUTICALS LTD";
$dob = "1983-05-02";
$companyType = "3";
$primaryAcc = "HDFC Bank";
$totalObligation = 0;
$city = "Delhi";
$otherCity = "";
$occupation = 1;

$reqloanamount=500000;
*/
  //$reqtenure =1;
$EligibileBidderArr = 0;
$inputData["annual_income"]=$Net_Salary;//
$inputData["company_name"]=$Company_Name;//
$inputData["date_of_birth"]=        $DOB;//
$inputData["company_type"]=        $Company_Type;//
$inputData["primary_bankaccount"]=        $Primary_Acc;//
$inputData["total_monthly_obligation"]=        $totalObligation;//
$inputData["city_name"]=        $City;//
$inputData["other_city_name"]=        $City_Other;//
$inputData["occupation"]=	$Employment_Status;       //
$inputData["loan_amount"]=	$Loan_Amount;       //
//$inputData["loan_amount"]=	500000;       //
$inputData["reqtenure"]=	$reqtenure;   //   		

$getEligiblieQuotes = PLQuoteCalc($inputData,$EligibileBidderArr);
//echo "<pre>";
//print_r($getEligiblieQuotes);

for($i=0;$i<count($getEligiblieQuotes);$i++)
{
?>

<tr> 
	<td width="11%" height="25" align="center" valign="middle"><b style="font-size:12px;"><? echo $getEligiblieQuotes[$i]['bank_code']; ?></b></td>
	<td width="11%" align="center"><b style="font-size:12px;"><? echo  $getEligiblieQuotes[$i]['loan_amount']; ?></b></td>
	<td width="11%" align="center"><b style="font-size:12px;"><? echo  $getEligiblieQuotes[$i]['interest_rate']; ?></b></td>
	<td width="11%" align="center"><b style="font-size:12px;"><? echo  $getEligiblieQuotes[$i]['emi']; ?></b></td>
	<td width="11%" align="center"><b style="font-size:12px;"><? echo  $getEligiblieQuotes[$i]['emiperlac']; ?></b></td>
	<td width="11%" align="center"><b style="font-size:12px;"><? echo  $getEligiblieQuotes[$i]['category']; ?></b></td>
	<td width="11%" align="center"><b style="font-size:12px;"><? echo  $getEligiblieQuotes[$i]['processing_fee']; ?></b></td>
	<!--<td width="11%" align="center"><b style="font-size:12px;"><? //echo "0 - 4%" ?></b></td>-->
	<td width="11%" align="center"><b style="font-size:12px;"><? echo $getEligiblieQuotes[$i]['tenure']." yrs"; ?></b></td>
	</tr>
<?php
}

?>

</table>
	</td></tr>


<tr><td colspan="4" bgcolor="#DAEAF9" align="center" style="border:1px solid black;" ><b>ADD Feedback </b></td></tr>
<tr>
	<td class="fontstyle"><b>Feedback</b></td>
	<td class="fontstyle">
    <?php
	$getFedbackQuery = ExecQuery("select FeedbackID, Feedback from Req_Feedback_PL where AllRequestID='".$post."' and BidderID='3621' AND Reply_Type=1");
	$num_rows = mysql_num_rows($getFedbackQuery);
		if($num_rows > 0)
		{
			echo $Feedback3621 = mysql_result($getFedbackQuery,0,'Feedback');
			$originalFeedback = $Feedback_c;
	echo "<br>";
			$followup_date3621 = mysql_result($getFedbackQuery,0,'Followup_Date');
		}
	?>
    <select name="plfeedback" id="feedback">
		<option value="" <?if($Feedback == "") { echo "selected"; }?>>No Feedback</option>
		<option value="Other Product" <?if($Feedback == "Other Product") { echo "selected"; }?>>Other Product</option>
		<option value="Not Interested" <?if($Feedback == "Not Interested") { echo "selected"; }?>>Not Interested</option>
		<option value="Callback Later" <?if($Feedback == "Callback Later") { echo "selected"; }?>>Callback Later</option>
		<option value="Wrong Number" <?if($Feedback == "Wrong Number") { echo "selected"; }?>>Wrong Number</option>
		<option value="Send Now" <?if($Feedback == "Send Now") { echo "selected"; }?>>Send Now</option>
		<option value="Not Eligible" <?if($Feedback == "Not Eligible") { echo "selected"; }?>>Not Eligible</option>
		<option value="Duplicate" <?if($Feedback == "Duplicate") { echo "selected"; }?>>Duplicate</option>
		<option value="Not Contactable" <?if($Feedback == "Not Contactable") { echo "selected"; }?>>Not Contactable</option>
		<option value="Ringing" <?if($Feedback == "Ringing") { echo "selected"; }?>>Ringing</option>
	<option value="FollowUp" <?if($Feedback == "FollowUp") { echo "selected"; }?>>FollowUp</option>
	<option value="Not Applied" <?if($Feedback == "Not Applied") { echo "selected"; }?>>Not Applied</option>
		<option value="Not Interested - Offer" <?if($Feedback == "Not Interested - Offer") { echo "selected"; }?>>Not Interested - Offer</option>
	<option value="Not Interested - Direct" <?if($Feedback == "Not Interested - Direct") { echo "selected"; }?>>Not Interested - Direct</option>
	<option value="Not Eligible - FOIR" <?if($Feedback == "Not Eligible - FOIR") { echo "selected"; }?>>Not Eligible - FOIR</option>
	<option value="Not Eligible - Cibil" <?if($Feedback == "Not Eligible - Cibil") { echo "selected"; }?>>Not Eligible - Cibil</option>
	<option value="Not Eligible - Others" <?if($Feedback == "Not Eligible - Others") { echo "selected"; }?>>Not Eligible - Others</option>
	<option value="Appointment - Cibil Ok" <?if($Feedback == "Appointment - Cibil Ok") { echo "selected"; }?>>Appointment - Cibil Ok</option>
	<option value="Appointment - Others" <?if($Feedback == "Appointment - Others") { echo "selected"; }?>>Appointment - Others</option>

	</select>
	</td>
	<td class="fontstyle"><b>Follow Up Date</b></td>
	<td class="fontstyle"><?php  echo $followup_date3621; ?><input type="Text"  name="FollowupDate" id="FollowupDate" maxlength="25" size="15" <?php if($Followup_Date !='0000-00-00 00:00:00') { ?>value="<?php  echo $followup_date; ?>" <?php } ?>><a href="javascript:NewCal('FollowupDate','yyyymmdd',true,24)"><img src="images/cal.gif" width="16" height="16" border="0" alt="Pick a date"></a></td>
</tr>
<tr>
<td class="fontstyle"><b>Send SMS</b></td>
<td class="fontstyle"><input type="button" name="sms" onClick="window.open('sendsms-email.php?Mobile=<? echo $Mobile;?>&RequestID=<? echo urlencode($post);?>&pro=1')" value="SendSMS"></td>
<td class="fontstyle"><b>Send mailer</b></td>
	<? if(($CC_Mailer != 1) && (strlen(trim($Email))>0)) {?> <td><div id="CCajaxDiv"><input type="button"  value="ccmailer" name="CCmailertype" id="CCmailertype" onClick="insertPLTemp();"></div> <?} else {?><td>&nbsp;</td> <? }?></tr>
	<tr><td colspan="2">&nbsp;</td>
		<td><b>Add Comment</b></td>
		<td><textarea rows="2" cols="20" name="pladd_comment" id="pladd_comment" ><? echo $Add_Comment; ?></textarea></td>
	</tr>
 <tr>
     <td colspan="4" align="center"><input type="submit" class="bluebutton" value="Submit"> 
      </td>
   </tr>
   </table></form>
   </td></tr>
   
   
   
   

     <tr><td colspan="4" align="center">
     <table cellpadding="1" cellspacing="1" width="1024">
      <tr><td colspan="4"></td></tr>  
  <tr><td colspan="4">
  <?php
    $yesterdayDate = date('Y-m-d',strtotime("+1 days"))." ".date('H:i:s');
	$getsmspl="select Mobile_no,Bank_Name from zexternal_campaign_smscontact Where (Sms_Flag=1 and Reply_Type=1 and BidderID='".$Final_Bidder."'and City_Wise like '%".$City."%') order by Compaign_ID ASC LIMIT 0,1";   
	$getsmsplresult = ExecQuery($getsmspl);
	$getCheckNum = mysql_num_rows($getsmsplresult);
	$plsmsld= mysql_fetch_array($getsmsplresult); 
  
  ?>
  
        <form method="POST" action="/edit-appointments-continue.php" name="sendform">
		<input type="hidden" name="callerid" id="callerid" value="<? echo $bidderid;?>" />
		<input type="hidden" name="reqcity" id="reqcity" value="<? echo $plrow["City"];?>" />
        <input type="hidden" name="FinalBidderStr" id="FinalBidderStr" value="<? echo $Final_Bidder;?>" />
		<input type="hidden" name="plrequestid" id="plrequestid" value="<? echo $requestid;?>" />
		<input type='hidden' value='<?php echo $plsmsld["Mobile_no"]; ?>' name='Bidder_Number' id='Bidder_Number' />
		<input type="hidden" name="Reply_Type" id="Reply_Type" value="<? echo $Reply_Type; ?>" />    

        <table width="100%" border="0" cellspacing="1" cellpadding="0" style="border:#333 0px solid;" >
         <tr><td colspan="4">&nbsp;</td></tr>
          <tr><td colspan="4">
          <?php
          
          $allocatedSQl = "select Req_Feedback_Bidder1.BidderID as AllocatedBidderID, BankID, Bidder_Name as AllocatedBidders from Req_Feedback_Bidder1 left join Bidders_List on Bidders_List.BidderID=Req_Feedback_Bidder1.BidderID  where Req_Feedback_Bidder1.AllRequestID='".$post."' and Req_Feedback_Bidder1.Reply_Type=1";
$allocatedQuery = ExecQuery($allocatedSQl);
$allocatedCount = mysql_num_rows($allocatedQuery);
if($allocatedCount>0)
{
	$allocatedBidder='';
	$allocatedBankID = '';
	$displayAllocated = '';
	for($i=0;$i<$allocatedCount;$i++)
	{
		$AllocatedBidderID = mysql_result($allocatedQuery,$i,'AllocatedBidderID');
		$allocatedBidder[]= mysql_result($allocatedQuery,$i,'AllocatedBidderID');
		$allocatedBankID[]= mysql_result($allocatedQuery,$i,'BankID');	
		$AllocatedBidders= mysql_result($allocatedQuery,$i,'AllocatedBidders');
		$displayAllocated[] = $AllocatedBidders."(".$AllocatedBidderID.")";
		?>
	<!--<input type="radio" name="appt_bidder" id="appt_bidder" value="<?php echo $AllocatedBidderID ?>" > <?php echo $AllocatedBidders; ?> (<?php echo $AllocatedBidderID; ?>) -->
	<?php	
	}
	//$displayAllocatedStr = implode(', ', $displayAllocated);
	//echo "<br><b>Allocated Bidders</b> - ".$displayAllocatedStr."<br><br>";
}	
       ?>
          </td></tr>
        <tr><td colspan="4">&nbsp;</td></tr>
        <tr>
          <td colspan="4">
          <table width="100%">
          <tr>
          <td colspan="4">
       <?php
	   $reply_type=1;
	    $getApptDetailsGroupSql = "select * from zexternal_appointment_docs where RequestID='".$post."' and caller_id='".$bidid."' group by BankID order by id asc";
		$getApptDetailsGroupQry = ExecQuery($getApptDetailsGroupSql);
		$getApptDetailsresGroupCount =mysql_num_rows($getApptDetailsGroupQry);
		for($ii=0;$ii<$getApptDetailsresGroupCount;$ii++)
		{
			$BankID = mysql_result($getApptDetailsGroupQry,$ii,'BankID');
			$BidderID = mysql_result($getApptDetailsGroupQry,$ii,'BidderID');
			$sql1 = "select Bidder_Name from Bidders_List where BidderID='".$BidderID."'";
			$query1 = ExecQuery($sql1);
			$Bidder_Name= mysql_result($query1,0,'Bidder_Name');

			$rm_feedback = '';
			$rm_comments = '';
			$getCheckNumRows='';
			//RM Feedback
		echo	$getCheckSql = "select Comments as rm_comments, Feedback as rm_feedback from Req_Feedback_Comments_PL where AllRequestID= '".$post."' and Reply_Type='".$reply_type."' and BidderID='".$BidderID."'";
			 $getCheckQuery = ExecQuery($getCheckSql);
			 $getCheckNumRows = mysql_num_rows($getCheckQuery);
			 $rm_feedback = mysql_result($getCheckQuery,0,'rm_feedback');
			 $rm_comments = mysql_result($getCheckQuery,0,'rm_comments');


			?>
			<table width="100%" style="border:#00F groove 1px;border-bottom:#00F groove 2px;">
          <tr>
          <td colspan="4" style="font-size:16px; font-weight:bold;"><span style="font-size:17px; font-weight:bold;">Appointment for</span> <?php echo $Bidder_Name." (".$BidderID.")"; ?></td></tr><tr>
          <?php if(strlen($rm_feedback)>3 || strlen($rm_comments)>3 ) { ?>		<tr>
          <td> <strong>Uploaded Feedback</strong>: <?php echo $rm_feedback; ?></td><td colspan="3" align="left"><strong>Uploaded Commment</strong>: <?php echo $rm_comments; ?></td></tr><?php } ?>

          <td colspan="4">
			<?php
			$getApptDetailsSql = "select * from zexternal_appointment_docs where RequestID='".$post."' and caller_id='".$bidid."' and BankID='".$BankID."' order by id asc";
			$getApptDetailsQry = ExecQuery($getApptDetailsSql);
			$getApptDetailsresCount =mysql_num_rows($getApptDetailsQry);
			$DocsArr = '';
			if($getApptDetailsresCount>0)
			{
			$DocsArr = '';
			$DocsArrStatus = '';
			$j=0;
			
			while($rowApptDetails = mysql_fetch_object($getApptDetailsQry))			
		   	{
				
				$DocsArr = '';
				$DocsArrStatus = '';
				$view_status = $rowApptDetails->viewstatus;
				if(strlen($rowApptDetails->IDProof)>0) { $DocsArr[] =$rowApptDetails->IDProof; }
				if(strlen($rowApptDetails->AddressProof)>0) { $DocsArr[] =$rowApptDetails->AddressProof; }
				if(strlen($rowApptDetails->PanCard)>0) { $DocsArr[] =$rowApptDetails->PanCard; }
				if(strlen($rowApptDetails->SalSlip)>0) { $DocsArr[] =$rowApptDetails->SalSlip; }
				if(strlen($rowApptDetails->BankStmnt)>0) { $DocsArr[] =$rowApptDetails->BankStmnt; }
				if(strlen($rowApptDetails->PassSizePhoto)>0) { $DocsArr[] =$rowApptDetails->PassSizePhoto; }
				
				if($rowApptDetails->IDProof_Status==1) { $DocsArrStatus[] =$rowApptDetails->IDProof; }
				if($rowApptDetails->AddressProof_Status==1) { $DocsArrStatus[] =$rowApptDetails->AddressProof; }
				if($rowApptDetails->PanCard_Status==1) { $DocsArrStatus[] =$rowApptDetails->PanCard; }
				if($rowApptDetails->SalSlip_Status==1) { $DocsArrStatus[] =$rowApptDetails->SalSlip; }
				if($rowApptDetails->BankStmnt_Status==1) { $DocsArrStatus[] =$rowApptDetails->BankStmnt; }
				if($rowApptDetails->PassSizePhoto_Status==1) { $DocsArrStatus[] =$rowApptDetails->PassSizePhoto; }
				
				$getFEDetailsSql = "select Name as FE_Name, Mobile_Number as FE_Mobile from zexternal_appointment_users where id='".$rowApptDetails->docpickerid."'";
				$getFEDetailsQry = ExecQuery($getFEDetailsSql);
				$FE_Name = mysql_result($getFEDetailsQry,0,'FE_Name');
				$FE_Mobile = mysql_result($getFEDetailsQry,0,'FE_Mobile');
				
		   ?>
	     <table width="100%" cellspacing="4" cellpadding="2" style="border:#000 1px solid;" >
	<tr>  <td bgcolor="#003399" colspan="2" align="left"><strong style="color:#FFF;"><?php if($j==0) { echo "Appointment - "; } else { echo "Re-scheduled on ".$rowApptDetails->updated_date ; } ?>
	</strong></td><td colspan="2" align="right" bgcolor="#003399"><?php if($rowApptDetails->viewstatus==1) {?><a href="editappointment4pl.php?id=<?php echo $rowApptDetails->id; ?>" target="_blank" style="color:#FFF; font-weight:bold;">EDIT</a> <?php } ?></td></tr>
	        <tr>  <td bgcolor="#DAEAF9" colspan="2"><strong>Remarks</strong></td><td width="27%" bgcolor="#DAEAF9"><strong>Select Date</strong></td><td width="15%" bgcolor="#DAEAF9"><strong>Select Time Slab</strong></td></tr>
	        <tr>  <td bgcolor="#FFFFFF" colspan="2"><?php echo $rowApptDetails->special_remarks; ?></td>
	          <td bgcolor="#FFFFFF" valign="top"><?php echo $rowApptDetails->appt_date; ?></td>
	          <td bgcolor="#FFFFFF" valign="top"><?php echo $rowApptDetails->appt_time; ?></td>
	        </tr>
	         <tr><td colspan="4" bgcolor="#DAEAF9"  ><b>Address - </b><?php echo $rowApptDetails->Address; ?></td></tr>
	         <tr><td colspan="4" bgcolor="#DAEAF9"  ><b>Documents - <?php echo implode(' , ', $DocsArr); ?> </b></td></tr>
	         <tr><td colspan="4" >&nbsp;</td></tr>
	         <?php if($rowApptDetails->docpickerid>0) { ?><tr><td colspan="4" bgcolor="#DAEAF9" ><b>
				 Field Executive Status</b> [Assigned to - <?php echo $FE_Name; ?> (<?php echo $FE_Mobile; ?>)]</td></tr>
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
	          <tr><td colspan="4" style="background:#9C6;" ><b>Spoc Remark -</b><?php echo $rowApptDetails->assigned_remark; ?></td></tr>
	          </table>
	     <?php 
		 $j=$j+1;
		 } } 
		 ?>
		 </td></tr></table>
		 <?php
	}	 
	?>
    </td></tr>
      </table>
       
     </td></tr>      
     
      </table></form>
      </td></tr>
   
</table>
</td></tr></table>
</body>
</html>