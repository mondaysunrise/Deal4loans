<?php
ini_set('max_execution_time', 300);
require 'scripts/session_check_onlinelms.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';
require 'eligiblebidderfuncPL.php';
require 'scripts/pl_interest_rate_view.php';
require 'scripts/personal_loan_eligibility_function_form.php';
require 'scripts/personal_loan_bt_eligibility.php';
session_start();

$IP_Remote = $_SERVER["REMOTE_ADDR"];
if($IP_Remote=='192.124.249.12' || $IP_Remote=='185.93.228.12') { $IP= $_SERVER['HTTP_X_SUCURI_CLIENTIP']; }
else { $IP= $IP_Remote;	}

$post=$_REQUEST['id'];
$min_date =$_REQUEST['to'];
$max_date=$_REQUEST['from'];
$bidid =$_REQUEST['Bid'];

function ccMasking($number, $maskingCharacter = 'X') 
{
	return substr($number, 0, 2) . str_repeat($maskingCharacter, strlen($number) - 4) . substr($number, -2);
}

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
//if ($_SERVER['REQUEST_METHOD'] == 'POST' && ($IP=="122.176.100.27" || $IP=="122.176.100.28" || $IP=="122.176.122.134" || $IP=="122.161.196.68" || $IP=="61.246.3.127" || $IP=="122.160.30.168"))
if ($_SERVER['REQUEST_METHOD'] == 'POST' ) {
		foreach($_POST as $a=>$b)
			$$a=$b;
			
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
		$Bidder_Id = $_REQUEST['BidderId'];
		$pladd_comment= $_REQUEST['pladd_comment'];
		$Primary_Acc= $_REQUEST['Primary_Acc'];
		$acc_no = $_REQUEST["acc_no"];
		$want_home_loan = $_REQUEST["want_home_loan"];
		$Annual_Turnover = $_REQUEST["Annual_Turnover"];
		$pl_Existing_Bank = $_REQUEST["pl_Existing_Bank"];
		$pl_Existing_Loan = $_REQUEST["pl_Existing_Loan"];
		$pl_Existing_ROI = $_REQUEST["pl_Existing_ROI"];
		
		$CibilScore = $_POST['CibilScore'];
		$Pancard = $_POST['Pancard'];
		$appointment_date = $_POST['appointment_date'];
		$appointment_time = $_POST['appointment_time'];
		$IDProof = $_POST['IDProof'];
		$Address = $_POST['Address'];
		$AddressProof = $_POST['AddressProof'];
		$Pancard_Check = $_POST['Pancard_Check'];
		$SalSlip = $_POST['SalSlip'];
		$BankStmnt = $_POST['BankStmnt'];
		$PassSizePhoto = $_POST['PassSizePhoto'];
		$appointment = $appointment_date."|".$appointment_time;
		$docs = $IDProof."|".$AddressProof."|".$Pancard_Check."|".$SalSlip."|".$BankStmnt."|".$PassSizePhoto;
		
			
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

	//unique clause
	$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-30, date("Y"));
	$days30date=date('Y-m-d',$tomorrow);
	$days30datetime = $days30date." 00:00:00";
	$currentdate= date('Y-m-d');
	$currentdatetime = date('Y-m-d')." 23:59:59";

	
		if(strlen($Final_Bid)>0)
		{
			$updatelead="Update Req_Loan_Personal set PL_EMI_Paid='$PL_EMI_Paid', CC_Age='$professional_details', Annual_Turnover='$Annual_Turnover', Company_Type='$plCompany_Type', PL_Tenure= '$acc_no',Name='$plname', Accidental_Insurance='$Accidental_Insurance', Tataaig_Home='$tataaig_home', Tataaig_Health='$tataaig_health', Tataaig_Auto='$tataaig_auto', PL_EMI_Amt='$emi_amt', Company_Name='$plcompany_name', DOB='$pldob', Residential_Status='$plresidential_status', Email='$plemail', City='$plcity', Card_Limit='$plcard_limit', City_Other='$plcity_other', Mobile_Number='$plmobile', Std_Code='$plstd_code', Landline='$pllandline', Std_Code_O='$plstd_code_o', Landline_O='$pllandline_o', Net_Salary='$plnet_salary', Loan_Amount='$plloan_amount', Pincode='$plpincode', Employment_Status='$plemployment_status', CC_Holder='$plcc_holder', Card_Vintage='$plcard_vintage', Total_Experience='$pltotal_experience', Years_In_company='$plyears_in_company', Loan_Any='$Loan_A', Emi_Paid='$plemi_paid', Landline_Connection='$pllandline_connection', Salary_Drawn='$plsalary_drawn', Mobile_Connection='$plmobile_connection', Bidderid_Details='$Final_Bid', Add_Comment='$pladd_comment', Dated=Now(), Allocated='$Allocated', Primary_Acc='$Primary_Acc', Direct_Allocation=0, Existing_Bank='$pl_Existing_Bank', Existing_Loan='$pl_Existing_Loan', Existing_ROI='$pl_Existing_ROI', Contact_Time='".$appointment."', identification_proof= '".$IDProof."', residence_proof= '".$AddressProof."', income_proof= '".$docs."', Residence_Address = '".$Address."' where RequestID=".$post;
		echo "<br>";
			$explodeBidder = explode(",",$Final_Bid);
			if($City=="Others") {$showCity = $plcity_other;} else {$showCity = $plcity;}
			for($kk=0;$kk<count($explodeBidder);$kk++)
			{
				$Item_Value = $plname."###".$plmobile."###".$showCity."###".$plcompany_name."###".$appointment."###".$Address."###".$docs;
				$sentMailSql = "INSERT INTO process_send_emails (RequestID, TemplateID, Reply_Type, BankID, Dated, DatetoSend, Process, Item_Value, Status, EmailID) VALUES ('".$post."', '1', '1', '".$explodeBidder[$kk]."', Now(), Now(), 'CallerAccountCity', '".$Item_Value."', '0', '".$plemail."')";
				ExecQuery($sentMailSql);
				//echo $sentMailSql;
			}
		}
		else
		{
		$updatelead="Update Req_Loan_Personal set PL_EMI_Paid='$PL_EMI_Paid',CC_Age='$professional_details', Annual_Turnover='$Annual_Turnover',Company_Type='$plCompany_Type',PL_Tenure= '$acc_no',Name='$plname',Primary_Acc='$Primary_Acc', Tataaig_Home='$tataaig_home',Accidental_Insurance='$Accidental_Insurance', Tataaig_Health='$tataaig_health',Tataaig_Auto='$tataaig_auto', PL_EMI_Amt='$emi_amt',Company_Name='$plcompany_name', DOB='$pldob', Residential_Status='$plresidential_status',Email='$plemail', City='$plcity', Card_Limit='$plcard_limit', City_Other='$plcity_other', Mobile_Number='$plmobile', Std_Code='$plstd_code', Landline='$pllandline', Std_Code_O='$plstd_code_o', Landline_O='$pllandline_o', Net_Salary='$plnet_salary', Loan_Amount='$plloan_amount', Pincode='$plpincode', Employment_Status='$plemployment_status', CC_Holder='$plcc_holder', Card_Vintage='$plcard_vintage', Total_Experience='$pltotal_experience', Years_In_company='$plyears_in_company', Loan_Any='$Loan_A', Emi_Paid='$plemi_paid', Landline_Connection='$pllandline_connection', Salary_Drawn='$plsalary_drawn', Mobile_Connection='$plmobile_connection', Add_Comment='$pladd_comment',Direct_Allocation=0,Existing_Bank='$pl_Existing_Bank',Existing_Loan='$pl_Existing_Loan',Existing_ROI='$pl_Existing_ROI', Contact_Time='".$appointment."', identification_proof= '".$IDProof."', residence_proof= '".$AddressProof."', income_proof= '".$docs."', Residence_Address = '".$Address."' where RequestID=".$post;
		}
	
	//	echo "query".$updatelead;
	 $updateleadresult=ExecQuery($updatelead);

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
						echo "hello2"."<br>";
						mail($plemail,'Thanks for Registering for '.$product.' on deal4loans.com', $message2, $headers);
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
<link rel="stylesheet" type="text/css" href="css/style.css">
<link href="includes/style.css" rel="stylesheet" type="text/css">
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script language="javascript" type="text/javascript" src="scripts/datetime.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<script type="text/javascript" src="ajax.js"></script>
<script type="text/javascript" src="ajax-dynamic-pllist.js"></script>
<script type="text/JavaScript">
/*
function killCopy(e){ return false; }
function reEnable(){return true; }
document.onselectstart=new Function ("return false");
if (window.sidebar){ document.onmousedown=killCopydocument.onclick=reEnable }
function clickIE4(){if (event.button==2){ return false; } }
function clickNS4(e){ if (document.layers||document.getElementById&&!document.all){ if (e.which==2||e.which==3){ return false;} } }
if (document.layers){ document.captureEvents(Event.MOUSEDOWN); document.onmousedown=clickNS4; } else if (document.all&&!document.getElementById){ document.onmousedown=clickIE4; }
document.oncontextmenu=new Function("return false")
*/
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
</head>
<body>
<p align="center"><b>Personal loan Lead Details </b></p>
<?php 
$viewqry="select CC_Age,Annual_Turnover,Company_Type,PL_Bank,PL_Tenure,Name,Tataaig_Home,Tataaig_Health,Tataaig_Auto,Accidental_Insurance,Add_Comment,Mobile_Number,Landline,Landline_O,Std_Code,Std_Code_O,Net_Salary,Residential_Status,City,City_Other,Is_Valid,Dated,Employment_Status,Loan_Amount,Email,Contactable,source,Loan_Any,Pincode,SentEmail,Emi_Paid,CC_Holder,Card_Vintage,Followup_Date,Feedback,CC_Mailer,Company_Name,PL_EMI_Amt,Card_Limit,Salary_Drawn,Landline_Connection,Mobile_Connection,Total_Experience,Years_In_Company,DOB,Bidderid_Details,checked_bidders,Primary_Acc,Referral_Flag,Creative,Existing_Bank,Existing_Loan,Existing_ROI, Residence_Address, identification_proof, residence_proof, income_proof, Contact_Time from Req_Loan_Personal LEFT OUTER JOIN Req_Feedback_PL ON Req_Feedback_PL.AllRequestID=Req_Loan_Personal.RequestID and Req_Feedback_PL.BidderID= '".$bidid."' where Req_Loan_Personal.RequestID=".$post." "; 
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
$Address = @mysql_result($viewlead,0,'Residence_Address');
$identification_proof = @mysql_result($viewlead,0,'identification_proof');
$income_proof = @mysql_result($viewlead,0,'income_proof');
$residence_proof = @mysql_result($viewlead,0,'residence_proof');
$Contact_Time = @mysql_result($viewlead,0,'Contact_Time');
$explodeCT = explode("|", $Contact_Time);
$appointment_date = $explodeCT[0];
$appointment_time = $explodeCT[1];


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
?>
<style>
.fontstyle
	{
		font-family:Verdana Arial, Helvetica, sans-serif;
		font-size:12px;
	}
</style>
<form name="loan_form" method="post" action="<? echo $_SERVER['PHP_SELF'] ?>?id=<? echo $post;?>&Bid=<? echo $bidid;?>&to=<? echo $min_date?>&from=<? echo $max_date;?>" >
<table style='border:1px dotted #9C9A9C;' cellspacing="2" cellpadding="5" width="700" height="80%" align="center" border="0" >
<tr>
	<td style="border:1px solid black;" colspan="4" bgcolor="#DAEAF9" align="center" class="fontstyle" ><b>Personal Details</b></td></tr>
		<tr>
			<td class="fontstyle" width="150"><b> Name</b></td>
			<td class="fontstyle" width="150"><input type="text" name="plname" id="plname" value="<?echo $Name;?>"></td>
			<td class="fontstyle" width="150"><b>Email id</b></td>
			<td class="fontstyle" width="150"><input type="text" name="plemail" id="plemail" value="<?echo $Email;?>"></td>
		</tr>
		<tr>
		<td class="fontstyle"><b>DOB</b></td>
			<td class="fontstyle"><input type="text" name="pldob" id="pldob"size="15" value="<?echo $DOB;?>"></td>
			<td class="fontstyle"><b>Mobile</b></td>
			<td class="fontstyle">+91<input type="hidden" name="plmobile" size="15" value="<?echo $Mobile;?>"><strong><?php echo ccMasking($Mobile); ?><? //echo $Mobile;?></strong></td>
			</tr>
		<tr>
			<td class="fontstyle"><b>Residence No</b></td>
			<td class="fontstyle"><input type="text" name="plstd_code" size="1" value="<? echo $Std_Code;?>" >-<input type="text" name="pllandline" size="8" value="<?echo $Landline;?>"></td>
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
		<td class="fontstyle"><b>Pincode</b></td><td><input type="text" name="plpincode" size="10" value="<?echo $Pincode;?>" ></td>
		<td class="fontstyle"><b>Residence Status</b></td>
		<td><select name="plresidential_status" id="plresidential_status" style="width: 203px;">
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
		</tr>
	
	<? if($Net_Salary<=239000)
	{ ?>
		<tr>
			<td class="fontstyle"><b>Mobile Connection?</b></td>
			<td class="fontstyle"><input type="radio"  value="1"  name="plmobile_connection" id="plmobile_connection" <?if($Mobile_Connection==1){ echo "checked";}?>>Prepaid
			<input size="10" type="radio" name="plmobile_connection" id="plmobile_connection" value="2" <?if($Mobile_Connection==2){ echo "checked";}?>> Postpaid</td>
			<td class="fontstyle" ><b>Do you have landline at your Residence?</b></td>
			<td class="fontstyle"><input type="radio"  value="1"  name="pllandline_connection" id="pllandline_connection" <?if($Landline_Connection==1){ echo "checked";}?>>Yes
			<input size="10" type="radio" name="pllandline_connection" id="pllandline_connection" value="2" <?if($Landline_Connection==2){ echo "checked";}?>>No</td>
		</tr>
		<? }?>
	<tr>
			<td class="fontstyle" ><b>Salary Account in which bank?</b>			</td>
	<td><select  name="Primary_Acc" id="Primary_Acc"><option value="">Please Select</option> <? $bnknm=ExecQuery("select Bank_Name from Bank_Master group by Bank_Name "); 
	while($plbnk=mysql_fetch_array($bnknm))
	{ ?>
			<option value="<? echo $plbnk["Bank_Name"]; ?>" <? if(strtoupper($Primary_Acc)==strtoupper($plbnk["Bank_Name"])) { echo "Selected";} ?>><? echo $plbnk["Bank_Name"]; ?></option>
	<? }
	?>
<option value="Other" <? if(strtoupper($Primary_Acc)=="OTHER") { echo "Selected";} ?>>Other</option></select>
</td>
	<td><strong>Pancard</strong></td><td><input type="text" name="Pancard" id="Pancard" size="10" value="<? echo $Pancard;?>" ></td></tr>
		<tr>
			<td colspan="4" class="fontstyle"><input type="hidden" name="BidderId" value="<?echo $bidid;?>"></td></tr>
		<tr>
			<td colspan="4" class="fontstyle"><input type="hidden" name="plrequestid" id="plrequestid" value="<?echo $post;?>"></td>
		</tr>
	
<tr>
		<td colspan="4" bgcolor="#DAEAF9" align="center" style="border:1px solid black;"><b>Employment Details</b></td></tr>
	<tr>
		<td class="fontstyle"><b>Employment Status</b></td>
		<td class="fontstyle"><select class="fontstyle" name="plemployment_status" id="plemployment_status">
			<option value="1" <?if($Employment_Status ==1){echo "selected"; }?>>Salaried</option>
			<option value="0" <?if($Employment_Status ==0) {echo "selected"; }?>>Self Employed</option></select>
		</td>
		<td class="fontstyle"><b>Annual Income</b></td>
		<td class="fontstyle"><input type="text" name="plnet_salary" id="plnet_salary" value="<?echo $Net_Salary;?>"  onKeyUp="getDigitToWords('plnet_salary','formatedIncome','wordIncome');" onKeyPress="getDigitToWords('plnet_salary','formatedIncome','wordIncome');" style="float: left" onBlur="getDigitToWords('plnet_salary','formatedIncome','wordIncome');"></td>
	</tr>
	<tr><td class="fontstyle"><b>Company Name</b></td>
	<td class="fontstyle"><input type="text" name="plcompany_name" id="plcompany_name" value="<? echo $Company_Name;?>"></td><td colspan="2" ><span id='formatedIncome' style='font-size:11px; font-weight:bold;color:666699;font-Family:Verdana;'></span><span id='wordIncome' style='font-size:11px;
font-weight:bold;color:666699;font-Family:Verdana;text-transform: capitalize;'></span></td></tr>
<tr><td>Professional details</td><td><select name="professional_details" id="professional_details" style="width: 203px;">
         		  <option value="0" <? if($professional_details=="0") { echo "Selected";} ?> >Please Select</option>
		  	<option value="1" <? if($professional_details=="1") { echo "Selected";} ?>>Businessmen</option>
			<option value="2" <? if($professional_details=="2") { echo "Selected";} ?> >Doctor</option>
			<option value="3" <? if($professional_details=="3") { echo "Selected";} ?> >Engineer</option>
			 <option value="4" <? if($professional_details=="4") { echo "Selected";} ?> >Architect</option>
		<option value="5" <? if($professional_details=="5") { echo "Selected";} ?> >Chartered Accountant</option>
			</select></td><td>Annual Turnover</td><td><select name='Annual_Turnover' id='Annual_Turnover'  style='width:140px;'>	
<option value="" <? if($Annual_Turnover==0) {echo "selected";} ?>>Please Select</option>
<option value="1"  <? if($Annual_Turnover==1) {echo "selected";} ?>> 0 - 40  lacs</option>	
<option value="4"  <? if($Annual_Turnover==4) {echo "selected";} ?>> 40Lacs -  1 Cr</option>	
<option value="2" <? if($Annual_Turnover==2) {echo "selected";} ?>> 1Cr - 3Crs </option>	
<option value="3" <? if($Annual_Turnover==3) {echo "selected";} ?> >3Crs & above</option>
</select></td></tr>
	<tr>
<td><b>Account No</b></td>
<td><input type="text" name="acc_no" id="acc_no" value="<? echo $PL_Tenure; ?>"></td>
	<td>Company Type</td><td><select name="plCompany_Type" id="plCompany_Type" style="width: 190px;">
		  <option value="0" <? if($Company_Type==0) {echo "selected";} ?>>Please Select</option>
		  	<option value="1" <? if($Company_Type==1) {echo "selected";} ?>>Pvt Ltd</option>
			<option value="2" <? if($Company_Type==2) {echo "selected";} ?>>MNC Pvt Ltd</option>
			<option value="3" <? if($Company_Type==3) {echo "selected";} ?>>Limited</option>
			<option value="4" <? if($Company_Type==4) {echo "selected";} ?>>Central Govt.</option>
			<option value="6" <? if($Company_Type==6) {echo "selected";} ?>>State Govt</option>
		<option value="5" <? if($Company_Type==5) {echo "selected";} ?>>PSU (Public sector Undertaking)</option>
			</select></td>
</tr>
	<tr>
		<td class="fontstyle"><b>Total Experience</b></td>
		<td class="fontstyle"><input type="text" name="pltotal_experience" id="pltotal_experience" size="5" value="<?echo $Total_Experience;?>"><b>(years)</b>
		</td>
		<td class="fontstyle"><b>Current experience in company</b></td>
		<td class="fontstyle"><input type="text" name="plyears_in_company" id="plyears_in_company" value="<? echo $Years_In_Company; ?>" size="5"><b>(years)</b></td>
	</tr>
	<? if($Net_Salary<=230000)
	{ ?>
	<tr>
	<td class="fontstyle"><b>Salary Drawn?</b></td>
			<td colspan="3" class="fontstyle"><input type="radio"  value="1"  name="Salary_Drawn" id="Salary_Drawn" <?if($Salary_Drawn==1){ echo "checked";}?> >Cash &nbsp;
			<input size="10" type="radio" name="plsalary_drawn" id="plsalary_drawn" value="2" <?if($Salary_Drawn==2){ echo "checked";}?>>Account Transfer<input size="10" type="radio" name="plsalary_drawn" id="plsalary_drawn"  value="3" <?if($Salary_Drawn==3){ echo "checked";}?>>Cheque</td>
		</tr>
		<? } ?>
<tr>
<td colspan="4" bgcolor="#DAEAF9" align="center" class="fontstyle" style="border:1px solid black;"><b>Surrogate Details</b></td></tr>
<tr>
	<td class="fontstyle"><b>Credit Card Holder </b></td>
	<td class="fontstyle"><input type="radio" value="1" name="plcc_holder" id="plcc_holder" <? if($CC_Holder==1){ echo "checked";}?> class="NoBrdr" checked>Yes
     <input type="radio" value="0" name="plcc_holder"  id="plcc_holder" class="NoBrdr" <?if($CC_Holder==0){ echo "checked";}?>>No</td>
			<td class="fontstyle"><b>Credit Card Limit?</b></td>
		 <td class="fontstyle"><input size="18" class="style4" name="plcard_limit" id="plcard_limit" value="<?echo $Card_Limit;?>">
					</td>
			   </tr>
<tr>
	<td class="fontstyle"><b>Card held since?</b></td><td class="fontstyle"><select  class="fontstyle" size="1" name="plcard_vintage" id="plcard_vintage">
	<option value="0" <? if($Card_Vintage==0) { echo "selected"; } ?>>Please select</option>
	<option value="1" <? if($Card_Vintage==1) { echo "selected"; } ?>>Less than 6 months</option>
	<option value="2" <? if($Card_Vintage==2) { echo "selected"; } ?>>6 to 9 months</option> 
	<option value="3" <? if($Card_Vintage==3) { echo "selected"; } ?>>9 to 12 months</option>
	<option value="4" <? if($Card_Vintage==4) { echo "selected"; } ?>>more than 12 months</option>
	</select></td>	
	<td class="fontstyle"><b>Loan Amount Required</b></td>
	<td class="fontstyle"><input type="text" name="plloan_amount" id="plloan_amount" value="<?echo $Loan_Amount;?>"  onKeyUp="getDigitToWords('plloan_amount','formatedloan','wordloan');" onKeyPress="getDigitToWords('plloan_amount','formatedloan','wordloan');" style="float: left" onBlur="getDigitToWords('plloan_amount','formatedloan','wordloan');"></td>
</tr>
<tr>
<td></td>
<td ></td>
	<td colspan="2" ><span id='formatedloan' style='font-size:11px; font-weight:bold;color:666699;font-Family:Verdana;'></span><span id='wordloan' style='font-size:11px;
font-weight:bold;color:666699;font-Family:Verdana;text-transform: capitalize;'></span></td>
</tr>
<tr>
	<td class="fontstyle"><b>Any Loan Running ?</b></td>
	<td>
		<table border="0">	
			<tr>
				<td class="fontstyle"><input type="checkbox" id="Loan_Any" name="Loan_Any[]" class="noBrdr" value="hl" <?php if((strlen(strpos($Loan_Any, "hl")) > 0)) echo "checked"; ?>>Home</td>
				<td class="fontstyle"><input type="checkbox" class="noBrdr" id="Loan_Any" name="Loan_Any[]" value="pl" <?php if((strlen(strpos($Loan_Any, "pl")) > 0)) echo "checked"; ?>>Personal</td>
			</tr>
			<tr>
				<td class="fontstyle"><input type="checkbox" id="Loan_Any" name="Loan_Any[]" class="noBrdr"  value="cl" <?php if((strlen(strpos($Loan_Any, "cl")) > 0)) echo "checked"; ?>>Car</td>
				<td class="fontstyle"><input type="checkbox" name="Loan_Any[]" id="Loan_Any" class="noBrdr" value="lap" <?php if((strlen(strpos($Loan_Any, "lap")) > 0)) echo "checked"; ?>>Property</td>
			</tr>
			<tr>
				<td class="fontstyle"><input type="checkbox" name="Loan_Any[]" id="Loan_Any" class="noBrdr" value="other" <?php if((strlen(strpos($Loan_Any, "other")) > 0)) echo "checked"; ?>>Other</td><td><input type="checkbox" name="Loan_Any[]" id="Loan_Any" class="noBrdr" value="cdl" <?php if((strlen(strpos($Loan_Any, "cdl")) > 0)) echo "checked"; ?>>Consumer Durable</td>
			</tr> 
		</table>
	</td>
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
	<tr><td class="fontstyle">Amount of EMI Paying</td><td class="fontstyle"><input type="text" name="emi_amt" id="emi_amt" value="<? echo $PL_EMI_Amt;?>"></td><td ><strong><b>Cibil Score</strong></td><td><input type="text" name="CibilScore" id="CibilScore" value="<? echo $CibilScore;?>"></td></tr>
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
	</select>
	</td>
	<td class="fontstyle"><b>Follow Up Date</b></td>
	<td class="fontstyle"><?php  echo $followup_date3621; ?><input type="Text"  name="FollowupDate" id="FollowupDate" maxlength="25" size="15" <?php if($Followup_Date !='0000-00-00 00:00:00') { ?>value="<?php  echo $followup_date; ?>" <?php } ?>><a href="javascript:NewCal('FollowupDate','yyyymmdd',true,24)"><img src="images/cal.gif" width="16" height="16" border="0" alt="Pick a date"></a></td>
</tr>
<tr>
	<tr>
		
        <td colspan="4"><?php
echo '<b style="padding:4px;">Get Bidders - </b><br><br>';
$getAllocatedBiddersSql = "select BidderID from Req_Feedback_Bidder_PL1 where AllRequestID='".$post."'";
//echo "<br>";
$getAllocatedBiddersQuery = ExecQuery($getAllocatedBiddersSql);
$getAllocatedBiddersCount = mysql_num_rows($getAllocatedBiddersQuery);
$getBidderIDArr = '';
if($getAllocatedBiddersCount>0)
{
	for($j=0;$j<$getAllocatedBiddersCount;$j++)
	{
		$getBidderIDArr[] = mysql_result($getAllocatedBiddersQuery,$j,'BidderID');
	}
}
list($FinalBidder,$finalBidderName)= getBiddersList("Req_Loan_Personal",$post,$City,3,$source);
for($i=0;$i<count($FinalBidder);$i++)
{
	if($i%3==0 && $i!=0) { echo "<br><br>"; }
	echo '<span style="border:1px solid #000; padding:4px;">';
	if(!in_array($FinalBidder[$i],$getBidderIDArr))
	{
		echo "<input type='checkbox' value='$FinalBidder[$i]' name='Final_Bidder[$i]' id='Final_Bidder[$i]'> ";
	}
	else { echo "<b>Allocated to </b>"; }
	echo " <b>".$finalBidderName[$i]."</b>&nbsp;&nbsp;&nbsp;";
	echo '</span>';
}
?></td>
	</tr>
    <tr><td colspan="4">  <table width="717" cellspacing="3" cellpadding="4" style="border:#00F dashed 2px;">
        <tr>  <td bgcolor="#DAEAF9" colspan="4"><strong> Appointment</strong></td></tr>
        <tr>  <td bgcolor="#DAEAF9" colspan="2"><strong>Remarks</strong></td><td width="25%" bgcolor="#DAEAF9"><strong>Select Date</strong></td><td width="21%" bgcolor="#DAEAF9"><strong>Select Time Slab</strong></td></tr>
        <tr>  <td bgcolor="#FFFFFF" colspan="2"><textarea rows="2" cols="55" name="pladd_comment" id="pladd_comment" onChange="NosplcharComment(this);"><? echo $Add_Comment; ?></textarea></td>
          <td bgcolor="#FFFFFF" valign="top"><input type="Text" name="appointment_date" id="appointment_date" maxlength="25" size="15" value="<?php echo $appointment_date; ?>" ><a href="javascript:NewCal('appointment_date','yyyymmdd',true,24)"><img src="/images/cal.gif" width="16" height="16" border="0" alt="Pick a date"></a></td>
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
         <tr><td colspan="4" bgcolor="#DAEAF9"  ><b>Documents List -  </b></td></tr>
<tr>
	<td width="24%" class="fontstyle"><b>ID Proof</b></td>
	<td width="30%" class="fontstyle">   
    <select name="IDProof" id="IDProof">
    <option value="">Please Select</option>
		<option value="Passport" <?php if(trim($identification_proof)=="Passport") {echo "Selected";} ?> >Passport</option>
		<option value="PanCard" <?php if(trim($identification_proof)=="PanCard") {echo "Selected";} ?>>Pan Card</option>
		<option value="VoterID Card" <?php if(trim($identification_proof)=="VoterID Card") {echo "Selected";} ?>>Voter ID Card</option>
		<option value="ElectionID Card" <?php if(trim($identification_proof)=="ElectionID Card") {echo "Selected";} ?>>Election ID Card</option>
        <option value="Aadhar card" <?php if(trim($identification_proof)=="Aadhar card") {echo "Selected";} ?>>Aadhar card</option>
        		<option value="Driving License" <?php if(trim($identification_proof)=="Driving License") {echo "Selected";} ?> >Driving License</option>
                		<option value="Govt ID Card" <?php if(trim($identification_proof)=="Govt ID Card") {echo "Selected";} ?> >Govt ID Card (Govt Emp)</option>
	</select>
	</td>
	<td class="fontstyle"><b>Address proof</b></td>
	<td class="fontstyle"><select name="AddressProof" id="AddressProof">
    <option value="">Please Select</option>
		<option value="Passport" <?php if(trim($residence_proof)=="Passport") {echo "Selected";} ?>>Passport</option>
		<option value="Bank Statement" <?php if(trim($residence_proof)=="Bank Statement") {echo "Selected";} ?>>Bank Statement</option>
		<option value="Utility Bill" <?php if(trim($residence_proof)=="Utility Bill") {echo "Selected";} ?>>Utility Bill</option>
		<option value="Gas Receipt" <?php if(trim($residence_proof)=="Gas Receipt") {echo "Selected";} ?>>Gas Receipt</option>
		<option value="Rent Agreement" <?php if(trim($residence_proof)=="Rent Agreement") {echo "Selected";} ?>>Rent Agreement</option>
        <option value="Aadhar card" <?php if(trim($identification_proof)=="Aadhar card") {echo "Selected";} ?>>Aadhar card</option>
        <option value="Govt ID Card" <?php if(trim($identification_proof)=="Govt ID Card") {echo "Selected";} ?> >Govt ID Card (Govt Emp)</option>
  		<option value="Phone Bill" <?php if(trim($residence_proof)=="Phone Bill") {echo "Selected";} ?>>Phone Bill</option>
		<option value="Driving License" <?php if(trim($identification_proof)=="Driving License") {echo "Selected";} ?> >Driving License</option>
	</select></td>
</tr>
<tr>
	<td class="fontstyle"><b>PAN Card</b></td>
	<td class="fontstyle">    <table><tr><td>
    <input type="radio" name="Pancard_Check" id="Pancard_Check" value="PANCard" <?php if((strlen(strpos($income_proof, "PANCard")) > 0)) echo "checked"; ?>> Yes </td><td><input type="radio" name="Pancard_Check" id="Pancard_Check2" value="0"> No </td></tr></table>
    
	</td>
	<td class="fontstyle"><b>3 Month Sal Slip</b></td>
	<td class="fontstyle"> <table><tr><td>
     <input type="radio" name="SalSlip" id="SalSlip" value="3 Month SalSlip" <?php if((strlen(strpos($income_proof, "3 Month SalSlip")) > 0)) echo "checked"; ?>> Yes</td><td><input type="radio" name="SalSlip" id="SalSlip2" value="0"> No</td></tr></table>
   </td>
</tr>
<tr>
	<td class="fontstyle"><b>3 Month Bank Statement</b></td>
	<td> <table><tr><td>
    <input type="radio" name="BankStmnt" id="BankStmnt" value="3 Month Bank Statement" <?php if((strlen(strpos($income_proof, "3 Month Bank Statement")) > 0)) echo "checked"; ?>> Yes</td><td><input type="radio" name="BankStmnt" id="BankStmnt2" value="0"> No </td></tr></table>   </td>
	<td class="fontstyle"><b>1 Passport Size Photo</b></td>
	<td class="fontstyle"> <table><tr><td>
      <input type="radio" name="PassSizePhoto" id="PassSizePhoto" value="1 Passport Size Photo" <?php if((strlen(strpos($income_proof, "1 Passport Size Photo")) > 0)) echo "checked"; ?>> Yes</td><td><input type="radio" name="PassSizePhoto" id="PassSizePhoto2" value="0"> No</td></tr></table>
    </td>
</tr>    </table></td></tr>
<tr><td colspan="4">

</td></tr>
 <tr>
     <td colspan="4" align="center"><input type="submit" class="bluebutton" value="Submit"> 
      </td>
   </tr>
 <tr>
     <td colspan="4" align="center">Please do not use any special characters.
      </td>
   </tr>
   
</table>
</form>
</body>
</html>
