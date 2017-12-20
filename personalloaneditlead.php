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
//function ccMasking($number, $maskingCharacter = 'X') 
//{
	//return substr($number, 0, 2) . str_repeat($maskingCharacter, strlen($number) - 4) . substr($number, -2);
//}
function ccMasking($number, $maskingCharacter = 'X') 
{
	return substr($number, 0, 6) . str_repeat($maskingCharacter, strlen($number)-6);
}
$IP_Remote = $_SERVER["REMOTE_ADDR"];
if($IP_Remote=='192.124.249.12' || $IP_Remote=='185.93.228.12') { $IP= $_SERVER['HTTP_X_SUCURI_CLIENTIP']; }
else { $IP= $IP_Remote;	}

$post=$_REQUEST['id'];
$min_date =$_REQUEST['to'];
$max_date=$_REQUEST['from'];
$bidid =$_REQUEST['bid'];

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

if ($_SERVER['REQUEST_METHOD'] == 'POST' && ($IP=="122.176.100.27" || $IP=="122.176.100.28" || $IP=="122.176.122.134" || $IP=="122.161.196.68" || $IP=="61.246.3.127" || $IP=="122.160.30.168" || $IP=="180.188.224.34" || $IP=="122.161.193.191" || $IP=="122.160.74.241" || $IP=="122.160.74.235" || $IP=="182.73.4.58" || $IP=="182.73.4.59" || $IP=="182.73.4.60" || $IP=="182.73.4.61" || $IP=="182.73.4.62" || $IP=="182.71.109.218"  || $IP=="180.151.74.83"  || $IP=="115.249.245.30" || $IP=="185.93.231.12" || $IP=="122.176.77.240" || $IP=="122.176.77.79" || $IP=="122.180.253.3" || $IP=="122.176.68.155")) {
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
                $PanNumber = $_REQUEST["PanNumber"];
                
                $LanNum = $_REQUEST["LanNumber"];
                $BankFdbck = $_REQUEST["BankFeedback"];
                $BankRmrks = $_REQUEST["BankRemarks"];
                
			
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
		$updatelead="Update Req_Loan_Personal set PL_EMI_Paid='$PL_EMI_Paid',CC_Age='$professional_details',Annual_Turnover='$Annual_Turnover',Company_Type='$plCompany_Type',PL_Tenure= '$acc_no',Name='$plname',Accidental_Insurance='$Accidental_Insurance', Tataaig_Home='$tataaig_home',Tataaig_Health='$tataaig_health',Tataaig_Auto='$tataaig_auto',PL_EMI_Amt='$emi_amt',Company_Name='$plcompany_name', DOB='$pldob', Residential_Status='$plresidential_status',Email='$plemail', City='$plcity', Card_Limit='$plcard_limit', City_Other='$plcity_other', Mobile_Number='$plmobile', Std_Code='$plstd_code', Landline='$pllandline', Std_Code_O='$plstd_code_o', Landline_O='$pllandline_o', Net_Salary='$plnet_salary', Loan_Amount='$plloan_amount', Pincode='$plpincode', Employment_Status='$plemployment_status', CC_Holder='$plcc_holder', Card_Vintage='$plcard_vintage', Total_Experience='$pltotal_experience', Years_In_company='$plyears_in_company', Loan_Any='$Loan_A', Emi_Paid='$plemi_paid', Landline_Connection='$pllandline_connection', Salary_Drawn='$plsalary_drawn', Mobile_Connection='$plmobile_connection',Bidderid_Details='$Final_Bid',Add_Comment='$pladd_comment',Dated=Now(), Allocated='$Allocated',Primary_Acc='$Primary_Acc',Direct_Allocation=0,Existing_Bank='$pl_Existing_Bank',Existing_Loan='$pl_Existing_Loan',Existing_ROI='$pl_Existing_ROI',Pancard='".$PanNumber."' where RequestID=".$post;
		}
		else
		{
		$updatelead="Update Req_Loan_Personal set PL_EMI_Paid='$PL_EMI_Paid',CC_Age='$professional_details',Annual_Turnover='$Annual_Turnover',Company_Type='$plCompany_Type',PL_Tenure= '$acc_no',Name='$plname',Primary_Acc='$Primary_Acc', Tataaig_Home='$tataaig_home',Accidental_Insurance='$Accidental_Insurance', Tataaig_Health='$tataaig_health',Tataaig_Auto='$tataaig_auto', PL_EMI_Amt='$emi_amt',Company_Name='$plcompany_name', DOB='$pldob', Residential_Status='$plresidential_status',Email='$plemail', City='$plcity', Card_Limit='$plcard_limit', City_Other='$plcity_other', Mobile_Number='$plmobile', Std_Code='$plstd_code', Landline='$pllandline', Std_Code_O='$plstd_code_o', Landline_O='$pllandline_o', Net_Salary='$plnet_salary', Loan_Amount='$plloan_amount', Pincode='$plpincode', Employment_Status='$plemployment_status', CC_Holder='$plcc_holder', Card_Vintage='$plcard_vintage', Total_Experience='$pltotal_experience', Years_In_company='$plyears_in_company', Loan_Any='$Loan_A', Emi_Paid='$plemi_paid', Landline_Connection='$pllandline_connection', Salary_Drawn='$plsalary_drawn', Mobile_Connection='$plmobile_connection', Add_Comment='$pladd_comment',Direct_Allocation=0,Existing_Bank='$pl_Existing_Bank',Existing_Loan='$pl_Existing_Loan',Existing_ROI='$pl_Existing_ROI',Pancard='".$PanNumber."' where RequestID=".$post;
		}
	
		//echo "query".$updatelead;
	 $updateleadresult=ExecQuery($updatelead);

          $resBankFeedback = ExecQuery("select FeedbackID,not_contactable_counter from Req_Feedback_PL where AllRequestID=".$post." and BidderID=".$Bidder_Id." AND Reply_Type=1");	
         $rowBankFeedback = mysql_fetch_array($resBankFeedback);
         if(isset($_REQUEST['BankFeedback']) && $plfeedback=="")
         {
             $strSQL="Update Req_Feedback_PL Set axis_executive_name='".$BankFdbck."', post_login_stat='".$LanNum."', comment_section='".$BankRmrks."' ";
			$strSQL=$strSQL." Where FeedbackID=".$rowBankFeedback["FeedbackID"];
                        ExecQuery($strSQL);
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

			$strSQL="Update Req_Feedback_PL Set Feedback='".$plfeedback."',not_contactable_counter='".$updatedcounter."',Followup_Date='".$FollowupDate."', Caller_Name='".$_SESSION['Caller_Name']."', comment_section='".$BankRmrks."', axis_executive_name='".$BankFdbck."', post_login_stat='".$LanNum."'";
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
			$strSQL="Insert into Req_Feedback_PL(AllRequestID, BidderID, Reply_Type , Feedback, Followup_Date,not_contactable_counter, Caller_Name,comment_section,axis_executive_name,post_login_stat) Values (";
			$strSQL=$strSQL.$post.",".$Bidder_Id.",1,'".$plfeedback."','".$FollowupDate."','".$counter."', '".$_SESSION['Caller_Name']."', '".$BankRmrks."', '".$BankFdbck."', '".$LanNum."')";

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
<script type="text/javascript">
function killCopy(e){ return false; }
function reEnable(){return true; }
document.onselectstart=new Function ("return false");
if (window.sidebar){ document.onmousedown=killCopydocument.onclick=reEnable }
function clickIE4(){if (event.button==2){ return false; } }
function clickNS4(e){ if (document.layers||document.getElementById&&!document.all){ if (e.which==2||e.which==3){ return false;} } }
if (document.layers){ document.captureEvents(Event.MOUSEDOWN); document.onmousedown=clickNS4; } else if (document.all&&!document.getElementById){ document.onmousedown=clickIE4; }
document.oncontextmenu=new Function("return false")
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
<style type="text/css">
.fontstyle{
        font-family:Verdana Arial, Helvetica, sans-serif;
        font-size:12px;
	}
</style>
<script type="text/javascript">

function fdbkconfirm(fdbkVal){
   
   if(fdbkVal=='OTP Done - OK' || fdbkVal=='OTP Done - Not Ok')
   {
        var  Conf= confirm(fdbkVal+", feedback will not change again");
       
   }
}
</script>


</head>
<body>
<p align="center"><b>Personal loan Lead Details </b></p>
<?php 
$viewqry="select CC_Age,Annual_Turnover,Company_Type,PL_Bank,PL_Tenure,Name,Tataaig_Home,Tataaig_Health,Tataaig_Auto,Accidental_Insurance,Add_Comment,Mobile_Number,Landline,Landline_O,Std_Code,Std_Code_O,Net_Salary,Residential_Status,City,City_Other,Is_Valid,Dated,Employment_Status,Loan_Amount,Email,Contactable,source,Loan_Any,Pincode,SentEmail,Emi_Paid,CC_Holder,Card_Vintage,Followup_Date,Feedback,CC_Mailer,Company_Name,PL_EMI_Amt,Card_Limit,Salary_Drawn,Landline_Connection,Mobile_Connection,Total_Experience,Years_In_Company,DOB,Bidderid_Details,checked_bidders,Primary_Acc,Referral_Flag,Creative,Existing_Bank,Existing_Loan,Existing_ROI,FeedbackID,Pancard, post_login_stat AS LanNumber, axis_executive_name AS BankFeedabck, comment_section AS BankRemarks,Pancard from Req_Loan_Personal LEFT OUTER JOIN Req_Feedback_PL ON Req_Feedback_PL.AllRequestID=Req_Loan_Personal.RequestID and Req_Feedback_PL.BidderID= '".$bidid."' where Req_Loan_Personal.RequestID=".$post." "; 
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

$FeedbackID = mysql_result($viewlead,0,'FeedbackID');
$Pancard = mysql_result($viewlead,0,'Pancard');
$LanNumber = mysql_result($viewlead,0,'LanNumber');
$BankFeedabck = mysql_result($viewlead,0,'BankFeedabck');
$BankRemarks = mysql_result($viewlead,0,'BankRemarks');




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
$PanCard = @mysql_result($viewlead,0,'Pancard');
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
<form name="loan_form" method="post" action="<? echo $_SERVER['PHP_SELF'] ?>?id=<? echo $post;?>&bid=<? echo $bidid;?>&to=<? echo $min_date?>&from=<? echo $max_date;?>" >
<table style="border:1px dotted #9C9A9C;" cellspacing="2" cellpadding="5" width="600" align="center" border="0" >
<tr>
	<td style="border:1px solid black;" colspan="4" bgcolor="#DAEAF9" align="center" class="fontstyle" ><b>Balance Transfer</b></td></tr>
<tr>
	<td width="25%"><b>Existing Bank</b></td>
	<td width="25%"><input type="text" name="pl_Existing_Bank" id="pl_Existing_Bank" value="<?php echo $Existing_Bank; ?>"></td>
	<td ><b>Existing Loan </b></td>
	<td ><input type="text" name="pl_Existing_Loan" id="pl_Existing_Loan" value="<?php echo $Existing_Loan; ?>"></td>
</tr>
<tr>
	<td width="25%"><b>Existing ROI</b></td>
	<td width="25%"><input type="text" name="pl_Existing_ROI" id="pl_Existing_ROI" value="<?php echo $Existing_ROI; ?>"></td>
	<td width="25%"><b>Existing No of EMI Paid</b></td>
	<td width="25%"><input type="text" name="pl_Existing_EMI" id="pl_Existing_EMI" value="<?php echo $pl_Existing_EMI; ?>"  onChange="intOnly(this);" onKeyPress="intOnly(this);" onKeyUp="intOnly(this);"></td>
</tr>
<tr>
	<td style="border:1px solid black;" colspan="4" bgcolor="#DAEAF9" align="center" class="fontstyle" ><b>Personal Details</b></td></tr>
		<tr>
			<td class="fontstyle" width="150"><b>AgentID</b></td>
			<td class="fontstyle" width="150"><?echo $bidid;?></td>
                        <td class="fontstyle" width="150"><b>Reference No</b></td>
                        <td class="fontstyle" width="150"><? if($FeedbackID>0){echo "PL".$FeedbackID."S".$bidid; }?></td>
		</tr>
                    <tr>
			<td class="fontstyle" width="150"><b> Name</b></td>
			<td class="fontstyle" width="150"><input type="text" name="plname" id="plname" value="<?echo $Name;?>"></td>
			<td class="fontstyle" width="150"><b>Email id</b></td>
			<td class="fontstyle" width="150"><input type="text" name="plemail" id="plemail" value="<?echo $Email;?>"></td>
		</tr>
		<tr>
                    <td class="fontstyle"><b>DOB</b></td>
			<td class="fontstyle"><input type="text" name="pldob" id="pldob" value="<?echo $DOB;?>"><span style="font-size:10px">(yyyy-mm-dd)</span></td>
			<td class="fontstyle"><b>Mobile</b></td>
			<td class="fontstyle">+91<input type="hidden" name="plmobile" value="<? echo $Mobile;?>" />
            <?php echo "<b>".ccMasking($Mobile)."</b>"; ?></td>
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
		<td class="fontstyle"><b>Source</b></td>
		<td><? echo $source; ?></td>
		</tr>
		<tr>
			<td class="fontstyle"><b>Residence Status</b></td>
						<td colspan="2" class="fontstyle">
						<select name="plresidential_status" id="plresidential_status" style="width: 203px;">
		  <option value="0">Please Select</option>
		  	<option value="4" <? if($Residential_Status==4){ echo "Selected";} ?> >Owned By Self/Spouse</option>
			<option value="1" <? if($Residential_Status==1){ echo "Selected";} ?> >Owned By Parent/Sibling</option>
			<option value="3" <? if($Residential_Status==3){ echo "Selected";} ?> >Company Provided</option>
			<option value="5" <? if($Residential_Status==5){ echo "Selected";} ?> >Rented - With Family</option>
			<option value="6" <? if($Residential_Status==6){ echo "Selected";} ?> >Rented - With Friends</option>
			<option value="2" <? if($Residential_Status==2){ echo "Selected";} ?>>Rented - Staying Alone</option>
			<option value="7" <? if($Residential_Status==7){ echo "Selected";} ?>>Paying Guest</option>
			<option value="8" <? if($Residential_Status==8){ echo "Selected";} ?>>Hostel</option>
			</select>
			</td>
			<td>&nbsp;</td>
		</tr>
	<? if($Net_Salary<=239000)
	{ ?>
		<tr>
			<td class="fontstyle"><b>Mobile Connection?</b></td>
			<td class="fontstyle"><input type="radio"  value="1"  name="plmobile_connection" id="plmobile_connection" <? if($Mobile_Connection==1){ echo "checked";}?>>Prepaid
			<input type="radio" name="plmobile_connection" id="plmobile_connection" value="2" <? if($Mobile_Connection==2){ echo "checked";}?>> Postpaid</td>
			<td class="fontstyle" ><b>Do you have landline at your Residence?</b></td>
			<td class="fontstyle"><input type="radio"  value="1"  name="pllandline_connection" id="pllandline_connection" <? if($Landline_Connection==1){ echo "checked";}?>>Yes
			<input type="radio" name="pllandline_connection" id="pllandline_connection" value="2" <? if($Landline_Connection==2){ echo "checked";}?>>No</td>
		</tr>
		<? }?>
	<tr>
			<td class="fontstyle" colspan="2"><b>Salary Account in which bank?</b>			</td>
	<td><select  name="Primary_Acc" id="Primary_Acc"><option value="">Please Select</option> <? $bnknm=ExecQuery("select Bank_Name from Bank_Master group by Bank_Name "); 
	while($plbnk=mysql_fetch_array($bnknm))
	{ ?>
			<option value="<? echo $plbnk["Bank_Name"]; ?>" <? if(strtoupper($Primary_Acc)==strtoupper($plbnk["Bank_Name"])) { echo "Selected";} ?>><? echo $plbnk["Bank_Name"]; ?></option>
	<? }
	?>
<option value="Other" <? if(strtoupper($Primary_Acc)=="OTHER") { echo "Selected";} ?>>Other</option></select>
</td>
	<td>&nbsp;</td></tr>
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
			<option value="1" <? if($Employment_Status ==1){echo "selected"; }?>>Salaried</option>
			<option value="0" <? if($Employment_Status ==0) {echo "selected"; }?>>Self Employed</option></select>
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
        
        <tr>
		<td class="fontstyle"><b>PAN Number</b></td>
                <td class="fontstyle"><input type="text" name="PanNumber" id="PanNumber" value="<? echo $Pancard;?>"></td>
		<td class="fontstyle"><b>LAN Number</b></td>
		<td class="fontstyle"><input type="text" name="LanNumber" id="LanNumber" value="<? echo $LanNumber; ?>"></td>
	</tr>
        
        
	<? if($Net_Salary<=230000)
	{ ?>
	<tr>
	<td class="fontstyle"><b>Salary Drawn?</b></td>
			<td colspan="3" class="fontstyle"><input type="radio"  value="1"  name="Salary_Drawn" id="Salary_Drawn" <? if($Salary_Drawn==1){ echo "checked";}?> >Cash &nbsp;
			<input type="radio" name="plsalary_drawn" id="plsalary_drawn" value="2" <? if($Salary_Drawn==2){ echo "checked";}?>>Account Transfer<input type="radio" name="plsalary_drawn" id="plsalary_drawn"  value="3" <? if($Salary_Drawn==3){ echo "checked";}?>>Cheque</td>
		</tr>
		<? } ?>
<tr>
<td colspan="4" bgcolor="#DAEAF9" align="center" class="fontstyle" style="border:1px solid black;"><b>Surrogate Details</b></td></tr>
<tr>
	<td class="fontstyle"><b>Credit Card Holder </b></td>
	<td class="fontstyle"><input type="radio" value="1" name="plcc_holder" id="plcc_holder" <? if($CC_Holder==1){ echo "checked";}?> class="NoBrdr" checked>Yes
     <input type="radio" value="0" name="plcc_holder"  id="plcc_holder" class="NoBrdr" <? if($CC_Holder==0){ echo "checked";}?>>No</td>
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
	<tr><td class="fontstyle">Amount of EMI Paying</td><td class="fontstyle"><input type="text" name="emi_amt" id="emi_amt" value="<? echo $PL_EMI_Amt;?>" /></td><td colspan="2"></td></tr>
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
<tr><td class="fontstyle"><b>Eligible for Bidders</b></td><? if(strlen($Bidderid_Details)>0){?><td class="fontstyle" colspan="2"> already send</td><? } else {?><td colspan="2"><div id="checkdiv"><? 
$bajajchek=ExecQuery("Select bajajf_plrequestid From bajaj_cibildetails Where (bajajf_plrequestid=".$post.")");
$bjjchek=mysql_fetch_array($bajajchek);
$bajajf_plrequestid=$bjjchek["bajajf_plrequestid"];
if($bajajf_plrequestid>1)
{	$compforbajaj="bajaj";}else	{$compforbajaj="";	}

list($FinalBidder,$finalBidderName)= getBiddersList("Req_Loan_Personal",$post,$City,$Referral_Flag,$source);
//print_r($FinalBidder);
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
elseif(($FinalBidder[$i]==4872 || $FinalBidder[$i]==3061 || $FinalBidder[$i]==4353 ||  $FinalBidder[$i]==4701 || $FinalBidder[$i]==4815 ||  $FinalBidder[$i]==3595 || $FinalBidder[$i]==4671  || $FinalBidder[$i]==2917 || $FinalBidder[$i]==4798 || $FinalBidder[$i]==4388 || $FinalBidder[$i]==5322) && (((strncmp("ICICI", $Primary_Acc,5))!=0 && $icici_bankcmp=="" && $Net_Salary<360000) || ((strncmp("ICICI", $Primary_Acc,5))!=0 && strlen($icici_bankcmp)>2 && $Net_Salary<300000) || ((strncmp("ICICI", $Primary_Acc,5))==0 && $Net_Salary<360000 && strlen($icici_bankcmp)>2) || ((strncmp("ICICI", $Primary_Acc,5))==0 && $Net_Salary<360000 && $icici_bankcmp=="")))
				{
				}
elseif(($FinalBidder[$i]==2963 || $FinalBidder[$i]==3868 || $FinalBidder[$i]==2984 || $FinalBidder[$i]==3198 || $FinalBidder[$i]==3532 || $FinalBidder[$i]==3533 || $FinalBidder[$i]==3945 || $FinalBidder[$i]==3381 || $FinalBidder[$i]==4668 || $FinalBidder[$i]==4459 || $FinalBidder[$i]==4461 || $FinalBidder[$i]==4807 || $FinalBidder[$i]==4398 || $FinalBidder[$i]==2962 || $FinalBidder[$i]==3133 || $FinalBidder[$i]==3380 || $FinalBidder[$i]==5333) && (((strncmp("ICICI", $Primary_Acc,5))!=0 && $icici_bankcmp=="" && $Net_Salary<420000) || ((strncmp("ICICI", $Primary_Acc,5))==0 && $Net_Salary<420000 && $icici_bankcmp=="")))
				{
				}
elseif(($FinalBidder[$i]==3132 || $FinalBidder[$i]==4318 || $FinalBidder[$i]==4460) && (((strncmp("ICICI", $Primary_Acc,5))!=0 && $icici_bankcmp=="" && $Net_Salary<384000) || ((strncmp("ICICI", $Primary_Acc,5))==0 && $Net_Salary<384000 && $icici_bankcmp=="")))
				{
				}
elseif ((($icici_bankcmp=="" && ((strncmp("ICICI", $Primary_Acc,5))!=0) && $Net_Salary<360000) || ($icici_bankcmp=="" && ((strncmp("ICICI", $Primary_Acc,5))==0) && $Net_Salary<240000)) && ($FinalBidder[$i]==4387) )
				{
				}
elseif ((($icici_bankcmp=="" && ((strncmp("ICICI", $Primary_Acc,5))!=0) && $Net_Salary<396000) || ($icici_bankcmp=="" && ((strncmp("ICICI", $Primary_Acc,5))==0) && $Net_Salary<264000)) && ($FinalBidder[$i]==4900) )
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
elseif(($FinalBidder[$i]==3050 || $FinalBidder[$i]==2479 || $FinalBidder[$i]==2908 || $FinalBidder[$i]==3098 || $FinalBidder[$i]==3107 || $FinalBidder[$i]==3116 || $FinalBidder[$i]==3161 || $FinalBidder[$i]==3214 || $FinalBidder[$i]==3208 || $FinalBidder[$i]==3219 || $FinalBidder[$i]==2952 || $FinalBidder[$i]==2765 || $FinalBidder[$i]==3226 || $FinalBidder[$i]==3263 || $FinalBidder[$i]==3264 || $FinalBidder[$i]==3276 || $FinalBidder[$i]==3306 || $FinalBidder[$i]==3416 || $FinalBidder[$i]==3428 || $FinalBidder[$i]==3446 || $FinalBidder[$i]==3539 || $FinalBidder[$i]==3559 || $FinalBidder[$i]==2574 || $FinalBidder[$i]==3661 || $FinalBidder[$i]==3695 || $FinalBidder[$i]==3700 || $FinalBidder[$i]==3721 || $FinalBidder[$i]==3670 || $FinalBidder[$i]==3732 || $FinalBidder[$i]==2878 || $FinalBidder[$i]==2774 || $FinalBidder[$i]==3755 || $FinalBidder[$i]==3763 || $FinalBidder[$i]==3773 || $FinalBidder[$i]==3790 || $FinalBidder[$i]==3828 || $FinalBidder[$i]==3892 || $FinalBidder[$i]==3922 || $FinalBidder[$i]==3937 || $FinalBidder[$i]==3939 || $FinalBidder[$i]==3949 || $FinalBidder[$i]==4008 || $FinalBidder[$i]==4121 || $FinalBidder[$i]==2765 || $FinalBidder[$i]==4194 || $FinalBidder[$i]==4243 || $FinalBidder[$i]==4286 || $FinalBidder[$i]==4325 || $FinalBidder[$i]==4334 || $FinalBidder[$i]==4348 || $FinalBidder[$i]==4405 || $FinalBidder[$i]==4464 || $FinalBidder[$i]==4590 || $FinalBidder[$i]==4708 || $FinalBidder[$i]==4719) && ($citicategorycmp==''))
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
	elseif(((($kotakcategory=='' || $kotakcategory=='"CAT D') && $Net_Salary<480000))  && ($FinalBidder[$i]==2999 ||  $FinalBidder[$i]==3001 || $FinalBidder[$i]==5566 || $FinalBidder[$i]==3004 || $FinalBidder[$i]==3008 || $FinalBidder[$i]==3009 || $FinalBidder[$i]==5226 || $FinalBidder[$i]==3002 || $FinalBidder[$i]==3005 || $FinalBidder[$i]==3006 || $FinalBidder[$i]==3007 || $FinalBidder[$i]==3010 || $FinalBidder[$i]==3011 || $FinalBidder[$i]==3012 || $FinalBidder[$i]==3014 || $FinalBidder[$i]==3015 || $FinalBidder[$i]==3890 || $FinalBidder[$i]==3889 || $FinalBidder[$i]==4407 || $FinalBidder[$i]==4837 || $FinalBidder[$i]==4846 || $FinalBidder[$i]==5203 || $FinalBidder[$i]==4592 || $FinalBidder[$i]==4595 || $FinalBidder[$i]==5344 || $FinalBidder[$i]==5345 || $FinalBidder[$i]==5346 || $FinalBidder[$i]==5347 || $FinalBidder[$i]==5348 || $FinalBidder[$i]==5349 || $FinalBidder[$i]==5350 || $FinalBidder[$i]==5351 || $FinalBidder[$i]==5352 || $FinalBidder[$i]==5353 || $FinalBidder[$i]==5354 || $FinalBidder[$i]==5355 || $FinalBidder[$i]==3801 || $FinalBidder[$i]==5325 || $FinalBidder[$i]==5378 || $FinalBidder[$i]==5386 || $FinalBidder[$i]==5677 || $FinalBidder[$i]==5676 || $FinalBidder[$i]==5916 || $FinalBidder[$i]==5920))
				{
				}
	elseif(((($kotakcategory=='' || $kotakcategory=='"CAT D') && $Net_Salary<480000)) && ($FinalBidder[$i]==3000 || $FinalBidder[$i]==2998))
				{
				}
	elseif(((($kotakcategory=='' || $kotakcategory=='"CAT D') && $Net_Salary<888000)) && ($FinalBidder[$i]==3003))
				{
				}	
	elseif(((($kotakcategory=='' || $kotakcategory=='"CAT D') && $Net_Salary<828000)) && ($FinalBidder[$i]==3654))
				{
				}
	elseif(((($kotakcategory=='' || $kotakcategory=='"CAT D') && $Net_Salary>900000)) && ($FinalBidder[$i]==5889))
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
	echo "<input type='checkbox' value='$FinalBidder[$i]' name='Final_Bidder[$i]' id='Final_Bidder[$i]'>".$finalBidderName[$i]."(".$FinalBidder[$i].")";
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
<td><input name="company" id="company"   type="text" onKeyUp="ajax_showOptions(this,'getCountriesByLetters',event)" value="<? echo $Company_Name;?>"/>                                   
</td><td colspan="2"></td></tr>
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
<tr>
<td colspan="4" bgcolor="#DAEAF9" align="center" style="border:1px solid black;"><b>Banks calculation Details </b></td></tr>
<tr><td colspan="4"><table border="1" width="100%">
<tr> <td width="11%" height="25" align="center" valign="middle"><b style="font-size:12px;">Bank Name</b></td>
	<td width="11%" align="center"><b style="font-size:12px;">Loan Amount</b></td>
	<td width="11%" align="center"><b style="font-size:12px;">ROI</b></td>
	<td width="11%" align="center"><b style="font-size:12px;">Tenure</b></td>
	<td width="11%" align="center"><b style="font-size:12px;">EMI</b></td>
	<td width="11%" align="center"><b style="font-size:12px;">EMI(Per Lac)</b></td>
	<td width="11%" align="center"><b style="font-size:12px;">Company Cat</b></td>
	<td width="11%" align="center"><b style="font-size:12px;">Pre. charges</b></td>
	<td width="11%" align="center"><b style="font-size:12px;">prco. feee</b></td>
	</tr>
<? 
$finalBidderName_unique = array_unique($finalBidderName);
//print_r($finalBidderName_unique);
$finalBidderName_unique1=implode(",",$finalBidderName_unique);
$finalBidderName = explode(",",$finalBidderName_unique1);
//print_r($finalBidderName);
for($ij=0;$ij<count($finalBidderName_unique);$ij++)
{
	if(($finalBidderName[$ij]=="Stanc" || $finalBidderName[$ij]=="Standard Chartered"))
	{ 
		list($stancinterestrate,$stancgetloanamout,$stancgetemicalc,$stancterm,$stancperfee,$stancprocfee)=Stanc($monthsalary,$PL_EMI_Amt,$Company_Name,$stanc_category,$getDOB,$Company_Type,$Primary_Acc);
		?>
		<tr> <td width="11%" height="25" align="center" valign="middle"><b style="font-size:12px;"><? echo $finalBidderName[$ij]; ?></b></td>
	<td width="11%" align="center"><b style="font-size:12px;"><? echo round($stancgetloanamout); ?></b></td>
	<td width="11%" align="center"><b style="font-size:12px;"><? if(isset($stancinterestrate)) { echo $stancinterestrate; } else { echo $stancinterestrate ;} ?></b></td>
	<td width="11%" align="center"><b style="font-size:12px;"><? echo $stancterm." yrs";?></b></td>
	<td width="11%" align="center"><b style="font-size:12px;"><? echo $stancgetemicalc; ?></b></td>
	<td width="11%" align="center"><b style="font-size:12px;"><? 
$stancrateexact=str_replace("%","",$stancinterestrate);
$stancintr = trim($stancrateexact)/1200;
			echo $emicalc=round(100000 * $stancintr / (1 - (pow(1/(1 + $stancintr), ($stancterm*12)))));
			?></b></td>
	<td width="11%" align="center"><b style="font-size:12px;"><? echo $stanc_category; ?></b></td>
	<td width="11%" align="center"><b style="font-size:12px;"><? echo "0 - 4%" ?></b></td>
	<td width="11%" align="center"><b style="font-size:12px;"><? echo $stancperfee; ?></b></td>
	</tr><?
	}
		elseif($finalBidderName[$ij]=="HDFC" || $finalBidderName[$ij]=="HDFC Bank")
		{
		list($hdfcinterestrate,$hdfcgetloanamout,$hdfcgetemicalc,$hdfcterm,$hdfcperfee,$hdfcprocfee)=hdfcbank($monthsalary,$PL_EMI_Amt,trim($Company_Name),$hdfccategory,$getDOB,$Company_Type,$Primary_Acc);
if($hdfcgetloanamout>1000000)
			{$hdfcprepay="NIL";} else { $hdfcprepay="4%";}
//list($hdfcrate,$hdfcprepay_chrge,$hdfcpro_fee)=hdfcIR($monthsalary,$hdfccategory);
			?>
	<tr><td width="11%" height="25" align="center" valign="middle"><b style="font-size:12px;"><? echo $finalBidderName[$ij]; ?></b></td>
	<td width="11%" align="center"><b style="font-size:12px;"><? echo $hdfcgetloanamout; ?></b></td>
	<td width="11%" align="center"><b style="font-size:12px;"><? if(isset($hdfcinterestrate)) { echo $hdfcinterestrate; } else { echo $hdfcrate ;} ?></b></td>
	<td width="11%" align="center"><b style="font-size:12px;"><? echo $hdfcterm." yrs";?></b></td>
	<td width="11%" align="center"><b style="font-size:12px;"><? echo $hdfcgetemicalc; ?></b></td>
	<td width="11%" align="center"><b style="font-size:12px;"><? 
$hdfcrateexact=str_replace("%","",$hdfcinterestrate);
$hdfcintr = trim($hdfcrateexact)/1200;
			echo $emicalc=round(100000 * $hdfcintr / (1 - (pow(1/(1 + $hdfcintr), ($hdfcterm*12)))));
			?></b></td>
	<td width="11%" align="center"><b style="font-size:12px;"><? echo $hdfccategory; ?></b></td>
	<td width="11%" align="center"><b style="font-size:12px;"><? echo $hdfcprepay; ?></b></td>
	<td width="11%" align="center"><b style="font-size:12px;"><? echo $hdfcprocfee; ?></b></td>
	</tr>	
	<? }
	elseif(($finalBidderName[$ij]=="Citibank" || $finalBidderName[$ij]=="Citibank" || $finalBidderName[$ij]=="CitiBank") && ($citicategory!='' || $citicategory_n!=''))
	{
	list($citiinterestrate,$citigetloanamout,$citigetemicalc,$cititerm,$citiperlac,$citiproc_Fee)=citibank($monthsalary,$PL_EMI_Amt,$Company_Name,$getDOB,$citicategorycmp);
	list($citirate,$citiprepay_chrge,$citipro_fee)=citiIR($monthsalary,$grow["citibank"]);
			?>
		<tr> <td width="11%" height="25" align="center" valign="middle"><b style="font-size:12px;"><? echo $finalBidderName[$ij]; ?></b></td>
		<td width="11%" align="center"><b style="font-size:12px;"><? echo $citigetloanamout; ?></b></td>
		<td width="11%" align="center"><b style="font-size:12px;"><? if(isset($citiinterestrate)) { echo $citiinterestrate; } else { echo $citirate ;} ?></b></td>
		<td width="11%" align="center"><b style="font-size:12px;"><? echo $cititerm; ?></b></td>
		<td width="11%" align="center"><b style="font-size:12px;"><? echo $citigetemicalc; ?></b></td>
		<td width="11%" align="center"><b style="font-size:12px;"><? 
$citirateexact=str_replace("%","",$citiinterestrate);
$citiintr = trim($citirateexact)/1200;
			echo $emicalc=round(100000 * $citiintr / (1 - (pow(1/(1 + $citiintr), ($cititerm*12)))));
			?></b></td>
		<td width="11%" align="center"><b style="font-size:12px;"><? echo $citicategorycmp; ?></b></td>
	<td width="11%" align="center"><b style="font-size:12px;"><? if($citicategorycmp=="CAT A" && $monthsalary>=100000 && $citigetloanamout>=500000) { echo "0";} else
		{echo "1%"; } ?></b></td>
	<td width="11%" align="center"><b style="font-size:12px;"><? echo $citiproc_Fee; ?></b></td>
		</tr>	
	<?
	}
elseif($finalBidderName[$ij]=="Fullerton" || $finalBidderName[$ij]=="Fullerton" || $finalBidderName[$ij]=="Fullerton (Chattisgarh)")
{
list($fullertoninterestrate,$fullertongetloanamout,$fullertongetemicalc,$fullertonterm)=fullerton($monthsalary,$PL_EMI_Amt,$Company_Name,$fullertoncategory,$getDOB,$City);
list($fulrate,$fulprepay_chrge,$fulpro_fee)=fullertonIR($monthsalary,$grow["fullerton"]);
	?>
<tr> <td width="11%" height="25" align="center" valign="middle"><b style="font-size:12px;"><? echo $finalBidderName[$ij]; ?></b></td>
<td width="11%" align="center"><b style="font-size:12px;"><? echo $fullertongetloanamout; ?></b></td>
<td width="11%" align="center"><b style="font-size:12px;"><? if(isset($fullertoninterestrate)) { echo $fullertoninterestrate; } else { echo $fulrate ;} ?></b></td>
<td width="11%" align="center"><b style="font-size:12px;"><? echo $fullertonterm; ?></b></td>
<td width="11%" align="center"><b style="font-size:12px;"><? echo $fullertongetemicalc; ?></b></td>
<td width="11%" align="center"><b style="font-size:12px;"><? 
$fulrateexact=str_replace("%","",$fullertoninterestrate);
$fulintr = trim($fulrateexact)/1200;
			echo $emicalc=round(100000 * $fulintr / (1 - (pow(1/(1 + $fulintr), ($fullertonterm*12)))));
			?></b></td>
<td width="11%" align="center"><b style="font-size:12px;"><? echo $grow["fullerton"]; ?></b></td>
	<td width="11%" align="center"><b style="font-size:12px;"><? echo $fulprepay_chrge; ?></b></td>
	<td width="11%" align="center"><b style="font-size:12px;"><? echo $fulpro_fee; ?></b></td>
</tr>	
<?
}
elseif($finalBidderName[$ij]=="Tata Capital" || $finalBidderName[$ij]=="Tata Capital")
{
	list($tcinterestrate,$tcgetloanamout,$tcgetemicalc,$tcterm,$tcProcessing_Fee)=tatacapital($monthsalary,$Company_Name,$tatacapitalcomp,$getDOB,$Company_Type,$Primary_Acc);
	if($tcgetloanamout>0)
	{
	?>
<tr> <td width="11%" height="25" align="center" valign="middle"><b style="font-size:12px;"><? echo $finalBidderName[$ij]; ?></b></td>
<td width="11%" align="center"><b style="font-size:12px;"><? echo $tcgetloanamout; ?></b></td>
<td width="11%" align="center"><b style="font-size:12px;"><? echo $tcinterestrate; ?></b></td>
<td width="11%" align="center"><b style="font-size:12px;"><? echo $tcterm; ?></b></td>
<td width="11%" align="center"><b style="font-size:12px;"><? echo $tcgetemicalc; ?></b></td>
<td width="11%" align="center"><b style="font-size:12px;"><? 
$tatarateexact=str_replace("%","",$tcinterestrate);
$tataintr = trim($tatarateexact)/1200;
			echo $emicalc=round(100000 * $tataintr / (1 - (pow(1/(1 + $tataintr), ($tcterm*12)))));
			?></b></td>
	<td width="11%" align="center"><b style="font-size:12px;"><? echo $tatacapitalcomp; ?></b></td>
	<td width="11%" align="center"><b style="font-size:12px;"><? echo "Part Prepayment with ZERO Charges"; ?></b></td>
	<td width="11%" align="center"><b style="font-size:12px;"><? echo $tcProcessing_Fee; ?></b></td>
	</tr>		
<?
}
}
elseif(($finalBidderName[$ij]=="Bajaj Finserv" || $finalBidderName[$ij]=="BajajFinserv") && $Employment_Status ==1)
{	$bflloansmt= round($monthsalary*10);
			 $bfltenuremth=60;
			 $bflintr1=14.50/1200;
			 $bflintr2=15.50/1200;
			 $getemi1=round($bflloansmt * $bflintr1 / (1 - (pow(1/(1 + $bflintr1), $bfltenuremth)))); 
			 $getemi2=round($bflloansmt * $bflintr2 / (1 - (pow(1/(1 + $bflintr2), $bfltenuremth)))); ?>
	<tr> <td width="11%" height="25" align="center" valign="middle"><b style="font-size:12px;"><? echo $finalBidderName[$ij]; ?></b></td>
	<td width="11%" align="center"><b style="font-size:12px;"><? echo $bflloansmt; ?></b></td>
	<td width="11%" align="center"><b style="font-size:12px;"><? echo "14.50% - 15.50%"; ?></b></td>
	<td width="11%" align="center"><b style="font-size:12px;"><? echo "5 yrs"; ?></b></td>
	<td width="11%" align="center"><b style="font-size:12px;"><? echo $getemi1." - ".$getemi2; ?></b></td>
	<td width="11%" align="center"><b style="font-size:12px;"></b></td>
	<td width="11%" align="center"><b style="font-size:12px;"><? echo $grow["bajajfinserv"]; ?></b></td>
	<td width="11%" align="center"><b style="font-size:12px;"><? echo "Zero (After 1st EMI, Part Payment Also Zero)"; ?></b></td>
	<td width="11%" align="center"><b style="font-size:12px;"><? echo "Upto 2%"; ?></b></td>
	</tr>	
<?
}
elseif($finalBidderName[$ij]=="ICICI" || $finalBidderName[$ij]=="ICICI Bank")
{
list($iciciinterestrate,$icicigetloanamout,$icicigetemicalc,$iciciterm,$iciciperlacemi,$profee)=icicibank($monthsalary,$Company_Name,$icici_bankcmp,$getDOB,$Company_Type,$Primary_Acc);
list($icicirate,$iciciprepay_chrge,$icicipro_fee)=iciciIR($monthsalary,$grow["icici_bank"]);
	?>
<tr> <td width="11%" height="25" align="center" valign="middle"><b style="font-size:12px;"><? echo $finalBidderName[$ij]; ?></b></td>
<td width="11%" align="center"><b style="font-size:12px;"><? echo $icicigetloanamout; ?></b></td>
<td width="11%" align="center"><b style="font-size:12px;"><? echo $iciciinterestrate; ?></b></td>
<td width="11%" align="center"><b style="font-size:12px;"><? echo $iciciterm; ?></b></td>
<td width="11%" align="center"><b style="font-size:12px;"><? echo $icicigetemicalc; ?></b></td>
<td width="11%" align="center"><b style="font-size:12px;"><? 
$icicirateexact=str_replace("%","",$iciciinterestrate);
$iciciintr = trim($icicirateexact)/1200;
	echo $emicalc=round(100000 * $iciciintr / (1 - (pow(1/(1 + $iciciintr), ($iciciterm*12)))));
			?></b></td>
<td width="11%" align="center"><b style="font-size:12px;"><? echo $grow["icici_bank"]; ?></b></td>
	<td width="11%" align="center"><b style="font-size:12px;">5%</b></td>
	<td width="11%" align="center"><b style="font-size:12px;"><? echo $profee; ?></b></td>
</tr>	
<?
}
elseif((($finalBidderName[$ij]=="INDUS IND bank") || ($finalBidderName[$ij]=="INDUS IND bank")) && $Employment_Status==1)
	{
		list($indusindrate,$indusindloanamt,$indusindemi,$indusindterm,$indusindperlacemi)=@indusindbank($monthsalary,$Company_Name,$Indusind,$getDOB,$PL_EMI_Amt);

		if($indusindloanamt>0)
		{
	?>
	<tr> <td width="11%" height="25" align="center" valign="middle"><b style="font-size:12px;"><? echo $finalBidderName[$ij]; ?></b></td>
<td width="11%" align="center"><b style="font-size:12px;"><? echo $indusindloanamt; ?></b></td>
<td width="11%" align="center"><b style="font-size:12px;"><? echo $indusindrate; ?></b></td>
<td width="11%" align="center"><b style="font-size:12px;"><? echo $indusindterm; ?></b></td>
<td width="11%" align="center"><b style="font-size:12px;"><? echo $indusindemi; ?></b></td>
<td width="11%" align="center"><b style="font-size:12px;"><? 
$indusrateexact=str_replace("%","",$indusindrate);
$indusintr = trim($indusrateexact)/1200;
	echo $emicalc=round(100000 * $indusintr / (1 - (pow(1/(1 + $indusintr), ($indusindterm*12)))));
			?></b></td>
<td width="11%" align="center"><b style="font-size:12px;"><? echo $grow["Indusind"]; ?></b></td>
	<td width="11%" align="center"><b style="font-size:12px;"><? if($indusindrate=="13.49%" || $indusindrate=="12.99%") {echo "Nil";} else { echo "4%";} ?></b></td>
	<td width="11%" align="center"><b style="font-size:12px;"><? if($indusindrate=="12.99%") {echo "0.99%";} else {echo "1% -2%";}?></b></td>
</tr>	
<?	
	}
	}

	elseif(($finalBidderName[$ij]=="Kotak Bank" || $finalBidderName[$ij]=="Kotak"))
	{
		list($kotakrate,$kotakloanamt,$kotakemi,$kotakterm,$kotakperlacemi,$kotakproc_fee)=kotakbank($monthsalary,$Company_Name,$kotakcategory,$getDOB,$Company_Type,$Primary_Acc);
		//list($kotakrate,$kotakprepay_chrge,$kotakpro_fee)=kotakIR($monthsalary,$grow["kotak"]);
		?>
		<tr> <td width="11%" height="25" align="center" valign="middle"><b style="font-size:12px;"><? echo $finalBidderName[$ij]; ?></b></td>
<td width="11%" align="center"><b style="font-size:12px;"><? echo $kotakloanamt; ?></b></td>
<td width="11%" align="center"><b style="font-size:12px;"><? echo $kotakrate; ?></b></td>
<td width="11%" align="center"><b style="font-size:12px;"><? echo $kotakterm; ?></b></td>
<td width="11%" align="center"><b style="font-size:12px;"><? echo $kotakemi; ?></b></td>
<td width="11%" align="center"><b style="font-size:12px;"><? 
$kotakrateexact=str_replace("%","",$kotakrate);
$kotakintr = trim($kotakrateexact)/1200;
	echo $emicalc=round(100000 * $kotakintr / (1 - (pow(1/(1 + $kotakintr), ($kotakterm*12)))));
			?></b></td>
<td width="11%" align="center"><b style="font-size:12px;"><? echo $grow["kotak"]; ?></b></td>
	<td width="11%" align="center"><b style="font-size:12px;"><? if($kotakloanamt>=1000000) {echo "0% (after 12 EMIs) else 4% - 5%";} else { echo "4% - 5%"; } ?></b></td>
	<td width="11%" align="center"><b style="font-size:12px;"><? echo $kotakproc_fee; ?></b></td>
</tr>	
<?	}
	
	elseif(($finalBidderName[$ij]=="HDBFS") && $grow["hdbfs"]!='')
	{
		list($interestrate,$getloanamout,$getemicalc,$term,$Processing_Fee)= hdbfcLoans($hdbfscategorycmp, $monthsalary, $Primary_Acc,$getDOB,$PL_EMI_Amt,$Loan_Amount);

		list($hdbfsrate,$hdbfsprepay_chrge,$hdbfspro_fee)=hdbfsIR($monthsalary,$grow["hdbfs"]); 
	?>
<tr> <td width="11%" height="25" align="center" valign="middle"><b style="font-size:12px;"><? echo $finalBidderName[$ij]; ?></b></td>
	<td width="11%" align="center"><b style="font-size:12px;"><? echo $getloanamout; ?></b></td>
	<td width="11%" align="center"><b style="font-size:12px;"><? if(isset($interestrate)) { echo $interestrate; } else { echo $hdbfsrate ;} ?></b></td>
	<td width="11%" align="center"><b style="font-size:12px;"><? echo $term; ?></b></td>
	<td width="11%" align="center"><b style="font-size:12px;"><? echo $getemicalc; ?></b></td>
	<td width="11%" align="center"><b style="font-size:12px;"><? 
$hdbfsrateexact=str_replace("%","",$interestrate);
$hdbfsintr = trim($hdbfsrateexact)/1200;
	echo $emicalc=round(100000 * $hdbfsintr / (1 - (pow(1/(1 + $hdbfsintr), ($term*12)))));
			?></b></td>
	<td width="11%" align="center"><b style="font-size:12px;"><? echo $grow["hdbfs"]; ?></b></td>
	<td width="11%" align="center"><b style="font-size:12px;"><? echo $hdbfsprepay_chrge; ?></b></td>
	<td width="11%" align="center"><b style="font-size:12px;"><? echo $hdbfspro_fee; ?></b></td>
	</tr>	
<?	}
}?>
</table></td></tr>
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
                
                if($Feedback=='OTP Done - OK' || $Feedback=='OTP Done - Not Ok'){
                   echo $Feedback; 
                }else{
	?>
            <select name="plfeedback" id="feedback" onchange="return fdbkconfirm(this.value)">
		<option value="" <? if($Feedback == "") { echo "selected"; }?>>No Feedback</option>
              <option value="Not Interested" <? if($Feedback == "Not Interested") { echo "selected"; }?>>Not Interested</option>  
          <option value="No Response" <? if($Feedback == "No Response") { echo "selected"; }?>>No Response</option>
		<option value="Not Connected" <? if($Feedback == "Not Connected") { echo "selected"; }?>>Not Connected</option>
		
		<option value="Wrong Number" <? if($Feedback == "Wrong Number") { echo "selected"; }?>>Wrong Number</option>
		<option value="Not Eligible" <? if($Feedback == "Not Eligible") { echo "selected"; }?>>Not Eligible</option>
	<option value="OTP Done - OK" <? if($Feedback == "OTP Done - OK") { echo "selected"; }?>>OTP Done - OK</option>
    <option value="OTP Done - Not Ok" <? if($Feedback == "OTP Done - Not Ok") { echo "selected"; }?>>OTP Done - Not Ok</option>
    <option value="Callback Later" <? if($Feedback == "Callback Later") { echo "selected"; }?>>Callback Later</option>
    <option value="FollowUp" <? if($Feedback == "FollowUp") { echo "selected"; }?>>FollowUp</option>
   
                </select><? }?>
	</td>
	<td class="fontstyle"><b>Follow Up Date</b></td>
	<td class="fontstyle"><?php  echo $followup_date3621; ?><input type="Text"  name="FollowupDate" id="FollowupDate" maxlength="25" size="15" <?php if($Followup_Date !='0000-00-00 00:00:00') { ?>value="<?php  echo $followup_date; ?>" <?php } ?>><a href="javascript:NewCal('FollowupDate','yyyymmdd',true,24)"><img src="images/cal.gif" width="16" height="16" border="0" alt="Pick a date"></a></td>
</tr>
<tr>
<td class="fontstyle"><b>Send SMS</b></td>
<td class="fontstyle"><input type="button" name="sms" onClick="window.open('sendsms-email.php?Mobile=<? echo $Mobile;?>&RequestID=<? echo urlencode($post);?>&pro=1')" value="SendSMS"></td>
<td class="fontstyle"><b>Send mailer</b></td>
	<? if(($CC_Mailer != 1) && (strlen(trim($Email))>0)) {?> <td><div id="CCajaxDiv"><input type="button"  value="ccmailer" name="CCmailertype" id="CCmailertype" onClick="insertPLTemp();"></div> <?} else {?><td>&nbsp;</td> <? }?></tr>


<tr>
	<td class="fontstyle"><b>Bank Feedback</b></td>
	<td class="fontstyle">
        <select name="BankFeedback" id="BankFeedback">
            <option value="">Select Bank feedback</option>
		<option value="Not Eligible" <? if($BankFeedabck == "Not Eligible") { echo "selected"; }?>>Not Eligible</option>
                <option value="Not Interested - Direct" <? if($BankFeedabck == "Not Interested - Direct") { echo "selected"; }?>>Not Interested - Direct</option>
		<option value="Not Interested - Offer" <? if($BankFeedabck == "Not Interested - Offer") { echo "selected"; }?>>Not Interested - Offer</option>
		<option value="Duplicate" <? if($BankFeedabck == "Duplicate") { echo "selected"; }?>>Duplicate</option>
		<option value="Not Contactable" <? if($BankFeedabck == "Not Contactable") { echo "selected"; }?>>Not Contactable</option>
		
		<option value="Appointment" <? if($BankFeedabck == "Appointment") { echo "selected"; }?>>Appointment</option>
		<option value="Documents Picked" <? if($BankFeedabck == "Documents Picked") { echo "selected"; }?>>Documents Picked</option>
		<option value="Follow Up" <? if($BankFeedabck == "Follow Up") { echo "selected"; }?>>Follow Up</option>
    <option value="Approved" <? if($BankFeedabck == "Approved") { echo "selected"; }?>>Approved</option>
    <option value="Dispatched" <? if($BankFeedabck == "Dispatched") { echo "selected"; }?>>Dispatched</option>
    <option value="Post Login Reject" <? if($BankFeedabck == "Post Login Reject") { echo "selected"; }?>>Post Login Reject</option>
    	</select>
	</td>
	<td class="fontstyle"><b>Bank Remarks</b></td>
	<td class="fontstyle"><textarea rows="2" cols="20" name="BankRemarks" id="BankRemarks" ><? echo $BankRemarks; ?></textarea></td>
</tr>
<tr><td colspan="2"><input type="checkbox" name="want_home_loan" id="want_home_loan" value="1" style="border:none;"><b> Want Home Loan</b></td>
		<td><b>Add Comment</b></td>
		<td><textarea rows="2" cols="20" name="pladd_comment" id="pladd_comment" ><? echo $Add_Comment; ?></textarea></td>
	</tr>
 <tr>
     <td colspan="4" align="center"><input type="submit" class="bluebutton" value="Submit"> 
      </td>
   </tr>
</table>
</form>
</body>
</html>