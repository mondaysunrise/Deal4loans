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
//print_r($_SESSION);
$StaticBidderID = $_SESSION['BidderID'];

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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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
                $plnet_salary = $plnet_salary*12;
                
		//$plcc_holder =$_POST["plcc_holder"];
		$plcc_holder = $_POST["plcc_holder"];
		$Loan_Any = $_POST["Loan_Any"];
                $Loan_Type = $_POST["Loan_Type"];
		$emi_amt = $_POST["emi_amt"];
	$plcompany_name = $_POST["plcompany_name"];

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
		$Tenure = $_REQUEST["Tenure"];
		$want_home_loan = $_REQUEST["want_home_loan"];
		$Annual_Turnover = $_REQUEST["Annual_Turnover"];
		$pl_Existing_Bank = $_REQUEST["pl_Existing_Bank"];
		$pl_Existing_Loan = $_REQUEST["pl_Existing_Loan"];
		$pl_Existing_ROI = $_REQUEST["pl_Existing_ROI"];
                $PanNumber = $_REQUEST["PanNumber"];
                
                $LanNum = $_REQUEST["LanNumber"];
                $BankFdbck = $_REQUEST["BankFeedback"];
                $BankRmrks = $_REQUEST["BankRemarks"];
                $CibilScore = $_REQUEST['CibilScore'];
                $PF = $_REQUEST['PF'];
                $CibilLink = $_REQUEST['CibilLink'];
                
			
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
		$updatelead="Update Req_Loan_Personal set PL_EMI_Paid='$PL_EMI_Paid',CC_Age='$professional_details',Annual_Turnover='$Annual_Turnover',Company_Type='$plCompany_Type',PL_Tenure= '$Tenure',Name='$plname',Accidental_Insurance='$Accidental_Insurance', Tataaig_Home='$tataaig_home',Tataaig_Health='$tataaig_health',Tataaig_Auto='$tataaig_auto',PL_EMI_Amt='$emi_amt',Company_Name='$plcompany_name', DOB='$pldob', Residential_Status='$plresidential_status',Email='$plemail', City='$plcity', Card_Limit='$plcard_limit', City_Other='$plcity_other', Mobile_Number='$plmobile', Std_Code='$plstd_code', Landline='$pllandline', Std_Code_O='$plstd_code_o', Landline_O='$pllandline_o', Net_Salary='$plnet_salary', Loan_Amount='$plloan_amount', Pincode='$plpincode', Employment_Status='$plemployment_status', CC_Holder='$plcc_holder', Card_Vintage='$plcard_vintage', Total_Experience='$pltotal_experience', Years_In_company='$plyears_in_company', Loan_Any='$Loan_Type', Emi_Paid='$plemi_paid', Landline_Connection='$pllandline_connection', Salary_Drawn='$plsalary_drawn', Mobile_Connection='$plmobile_connection',Bidderid_Details='$Final_Bid',Add_Comment='$pladd_comment',Dated=Now(), Allocated='$Allocated',Primary_Acc='$Primary_Acc',Direct_Allocation=0,Existing_Bank='$pl_Existing_Bank',Existing_Loan='$pl_Existing_Loan',Existing_ROI='$pl_Existing_ROI',Pancard='".$PanNumber."',Cibilscore='".$CibilScore."' where RequestID=".$post;
		}
		else
		{
		$updatelead="Update Req_Loan_Personal set PL_EMI_Paid='$PL_EMI_Paid',CC_Age='$professional_details',Annual_Turnover='$Annual_Turnover',Company_Type='$plCompany_Type',PL_Tenure= '$Tenure',Name='$plname',Primary_Acc='$Primary_Acc', Tataaig_Home='$tataaig_home',Accidental_Insurance='$Accidental_Insurance', Tataaig_Health='$tataaig_health',Tataaig_Auto='$tataaig_auto', PL_EMI_Amt='$emi_amt',Company_Name='$plcompany_name', DOB='$pldob', Residential_Status='$plresidential_status',Email='$plemail', City='$plcity', Card_Limit='$plcard_limit', City_Other='$plcity_other', Mobile_Number='$plmobile', Std_Code='$plstd_code', Landline='$pllandline', Std_Code_O='$plstd_code_o', Landline_O='$pllandline_o', Net_Salary='$plnet_salary', Loan_Amount='$plloan_amount', Pincode='$plpincode', Employment_Status='$plemployment_status', CC_Holder='$plcc_holder', Card_Vintage='$plcard_vintage', Total_Experience='$pltotal_experience', Years_In_company='$plyears_in_company', Loan_Any='$Loan_Type', Emi_Paid='$plemi_paid', Landline_Connection='$pllandline_connection', Salary_Drawn='$plsalary_drawn', Mobile_Connection='$plmobile_connection', Add_Comment='$pladd_comment',Direct_Allocation=0,Existing_Bank='$pl_Existing_Bank',Existing_Loan='$pl_Existing_Loan',Existing_ROI='$pl_Existing_ROI',Pancard='".$PanNumber."',Cibilscore='".$CibilScore."' where RequestID=".$post;
		}
	$updateleadresult=ExecQuery($updatelead);
        
       
$ExtraFieldSelect = ExecQuery("select RequestID from Req_Loan_Personal_Extra_Fields WHERE  RequestID=".$post);	
$ExtraFieldsRows = mysql_num_rows($ExtraFieldSelect);
        
        if($ExtraFieldsRows>0)        
        {
        $ExtraFields = "Update Req_Loan_Personal_Extra_Fields set pf_deduction='".$PF."', cibil_reference_id='".$CibilLink."' WHERE RequestID=".$post;
        }else{
            $ExtraFields = "INSERT INTO Req_Loan_Personal_Extra_Fields (RequestID,pf_deduction,cibil_reference_id) VALUES('".$post."','".$PF."','".$CibilLink."')";
        }
        //echo $ExtraFields; die;
        $ExtraFieldsResult=ExecQuery($ExtraFields);
        
		//echo "query".$updatelead;
	 

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
						//echo "hello2"."<br>";
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

}
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/style.css">
<link href="includes/style.css" rel="stylesheet" type="text/css">
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script language="javascript" type="text/javascript" src="scripts/datetime.js"></script>
<script src='scripts/digitToWordConvertAnnualIncome.js' type='text/javascript' language='javascript'></script>
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
<p align="center"><b>AGENT PANEL</b></p>
<?php 
$viewqry="select * from Req_Loan_Personal LEFT OUTER JOIN client_lead_allocate ON client_lead_allocate.AllRequestID=Req_Loan_Personal.RequestID and client_lead_allocate.BidderID= '".$bidid."' where Req_Loan_Personal.RequestID=".$post." "; 
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
$Net_Salary = round($Net_Salary/12);
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
$Loan_Type = mysql_result($viewlead,0,'Loan_Any');
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
$Cibilscore = mysql_result($viewlead,0,'Cibilscore');




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
<table style="border:1px dotted #9C9A9C;" cellspacing="2" cellpadding="5" width="800" align="center" border="0" >
<tr>
	<td style="border:1px solid black;" colspan="4" bgcolor="#DAEAF9" align="center" class="fontstyle" ><b>Personal Details</b></td></tr>
		<tr>
			<td class="fontstyle"><b>AgentID</b></td>
			<td class="fontstyle"><?echo $bidid;?></td>
                        <td class="fontstyle"><b>Reference No</b></td>
                        <td class="fontstyle"><? if($FeedbackID>0){echo "PL".$FeedbackID."S".$bidid; }?></td>
		</tr>
                    <tr>
			<td class="fontstyle"><b> Name</b></td>
			<td class="fontstyle"><input type="text" name="plname" id="plname" value="<?echo $Name;?>"></td>
			<td class="fontstyle"><b>Email id</b></td>
			<td class="fontstyle"><input type="text" name="plemail" id="plemail" value="<?echo $Email;?>"></td>
		</tr>
		<tr>
                    <td class="fontstyle"><b>DOB</b></td>
			<td class="fontstyle"><input type="text" name="pldob" id="pldob" value="<?echo $DOB;?>"><span style="font-size:10px">(yyyy-mm-dd)</span></td>
                        <td class="fontstyle"><b>City</b></td>
			<td class="fontstyle"><select size="1" name="plcity" id="plcity"> <?=plgetCityList($City)?></select></td>
			</tr>
		<tr>
                  <td class="fontstyle"><b>Mobile</b></td>
			<td class="fontstyle">+91<input type="hidden" name="plmobile" value="<? echo $Mobile;?>" />
            <?php echo "<b>".ccMasking($Mobile)."</b>"; ?></td>
			<td class="fontstyle" ><b>Alternate No.</b></td>
			<td class="fontstyle"><input type="text" name="pllandline_o" size="9" value="<?echo $Landline_O;?>"></td>
		</tr>
		
		<tr>
		<td class="fontstyle"><b>Pincode</b></td><td><input type="text" name="plpincode" size="10" value="<?echo $Pincode;?>" ></td>
		<td class="fontstyle"><b>Source</b></td>
		<td><? echo $source; ?></td>
		</tr>
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
		<td class="fontstyle"><b>Net Salary(PM)</b></td>
		<td class="fontstyle"><input type="text" name="plnet_salary" id="plnet_salary" value="<?echo $Net_Salary;?>"  onKeyUp="getDigitToWords('plnet_salary','formatedIncome','wordIncome');" onKeyPress="getDigitToWords('plnet_salary','formatedIncome','wordIncome');" style="float: left" onBlur="getDigitToWords('plnet_salary','formatedIncome','wordIncome');"></td>
	</tr>
	<tr><td class="fontstyle"><b>Company Name</b></td>
	<td class="fontstyle"><input type="text" name="plcompany_name" id="plcompany_name" value="<? echo $Company_Name;?>"></td><td colspan="2" ><span id='formatedIncome' style='font-size:11px; font-weight:bold;color:666699;font-Family:Verdana;'></span><span id='wordIncome' style='font-size:11px;
font-weight:bold;color:666699;font-Family:Verdana;text-transform: capitalize;'></span></td></tr>
	<tr>
	<td>Company Type</td><td><select name="plCompany_Type" id="plCompany_Type" style="width: 190px;">
		  <option value="0" <? if($Company_Type==0) {echo "selected";} ?>>Please Select</option>
		  	<option value="1" <? if($Company_Type==1) {echo "selected";} ?>>Listed With Fullerton</option>
			<option value="2" <? if($Company_Type==2) {echo "selected";} ?>>Listed With MCA</option>
			<option value="3" <? if($Company_Type==3) {echo "selected";} ?>>Government</option>
			
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
<td colspan="4" bgcolor="#DAEAF9" align="center" class="fontstyle" style="border:1px solid black;"><b>CIBIL Details</b></td></tr>

<tr>
		<td class="fontstyle"><b>PAN Number</b></td>
                <td class="fontstyle"><input type="text" name="PanNumber" id="PanNumber" value="<? echo $Pancard;?>"></td>
		<td class="fontstyle"><b>LAN Number</b></td>
		<td class="fontstyle"><input type="text" name="LanNumber" id="LanNumber" value="<? echo $LanNumber; ?>"></td>
	</tr>
        
        <tr>
		<td class="fontstyle"><b>Cibil Score</b></td>
                <td class="fontstyle"><input type="text" name="CibilScore" id="CibilScore" value="<?php echo $Cibilscore;?>"></td>
		<td class="fontstyle"><b>Cibil Link</b></td>
		<td class="fontstyle"><input type="text" name="CibilLink" id="CibilLink" value="<? echo $CibilLink; ?>"></td>
	</tr>


<tr>
		
	<td class="fontstyle"><b>Loan Amount</b></td>
	<td class="fontstyle"><input type="text" name="plloan_amount" id="plloan_amount" value="<?echo $Loan_Amount;?>"  onKeyUp="getDigitToWords('plloan_amount','formatedloan','wordloan');" onKeyPress="getDigitToWords('plloan_amount','formatedloan','wordloan');" style="float: left" onBlur="getDigitToWords('plloan_amount','formatedloan','wordloan');"></td>
        <td class="fontstyle"><b>PF</b></td>
		<td class="fontstyle"><input type="text" name="PF" id="PF" value="<? echo $PF; ?>"></td>
</tr>
<tr>

	<td colspan="2" ><span id='formatedloan' style='font-size:11px; font-weight:bold;color:666699;font-Family:Verdana;'></span><span id='wordloan' style='font-size:11px;
font-weight:bold;color:666699;font-Family:Verdana;text-transform: capitalize;'></span></td>
        <td></td>
<td ></td>
</tr>
 <tr>
		<td class="fontstyle"><b>ROI</b></td>
                <td class="fontstyle"><input type="text" name="pl_Existing_ROI" id="pl_Existing_ROI" value="<? echo $Existing_ROI;?>"></td>
		<td class="fontstyle"><b>Tenure</b></td>
		<td class="fontstyle"><input type="text" name="Tenure" id="Tenure" value="<? echo $PL_Tenure; ?>"></td>
	</tr>
        
        <tr><td class="fontstyle">Amount of EMI Paying</td><td class="fontstyle"><input type="text" name="emi_amt" id="emi_amt" value="<? echo $PL_EMI_Amt;?>" /></td>
		<td class="fontstyle"><b>Loan Type</b></td>
                <td class="fontstyle"><select name="Loan_Type" id="Loan_Type" style="width: 190px;">
                        <option value="">Please select</option>
                        <option value="PLOC" <? if($Loan_Type=='PLOC') {echo "selected";} ?>>PLOC</option>
                        <option value="Flexi" <? if($Loan_Type=='Flexi') {echo "selected";} ?>>Flexi</option>
                        <option value="Normal PL" <? if($Loan_Type=='Normal PL') {echo "selected";} ?>>Normal PL</option>
                    </select>
                </td>
		
	</tr>
<tr><td colspan="4" bgcolor="#DAEAF9" align="center" style="border:1px solid black;" ><b>Feedback</b></td></tr>
<tr>
	<td class="fontstyle"><b>Agent Feedback</b></td>
	<td class="fontstyle">
            <select name="plfeedback" id="feedback" onchange="return fdbkconfirm(this.value)">
		<option value="" <? if($Feedback == "") { echo "selected"; }?>>No Feedback</option>
              <option value="Process" <? if($Feedback == "Process") { echo "selected"; }?>>Process</option>  
          <option value="Not Eligible" <? if($Feedback == "Not Eligible") { echo "selected"; }?>>Not Eligible</option>
		<option value="Not Interested" <? if($Feedback == "Not Interested") { echo "selected"; }?>>Not Interested</option>
		
		<option value="Callback Later" <? if($Feedback == "Callback Later") { echo "selected"; }?>>Callback Later</option>
		<option value="Wrong Number" <? if($Feedback == "Wrong Number") { echo "selected"; }?>>Wrong Number</option>
	<option value="Closed" <? if($Feedback == "Closed") { echo "selected"; }?>>Closed</option>
    <option value="FollowUp" <? if($Feedback == "FollowUp") { echo "selected"; }?>>FollowUp</option>
    <option value="Not Available" <? if($Feedback == "Not Available") { echo "selected"; }?>>Not Available</option>
    <option value="Ringing" <? if($Feedback == "Ringing") { echo "selected"; }?>>Ringing</option>
     <option value="Documents Pick" <? if($Feedback == "Documents Pick") { echo "selected"; }?>>Documents Pick</option>
      <option value="Loan Rejected" <? if($Feedback == "Loan Rejected") { echo "selected"; }?>>Loan Rejected</option>
       <option value="Appointment" <? if($Feedback == "Appointment") { echo "selected"; }?>>Appointment</option>
        <option value="Not interested for ROI" <? if($Feedback == "Not interested for ROI") { echo "selected"; }?>>Not interested for ROI</option>
         <option value="Not interested for LoanAmt" <? if($Feedback == "Not interested for LoanAmt") { echo "selected"; }?>>Not interested for LoanAmt</option>
         <option value="CRM Done - Green" <? if($Feedback == "CRM Done - Green") { echo "selected"; }?>>CRM Done - Green</option>
         <option value="CRM Done - Amber" <? if($Feedback == "CRM Done - Amber") { echo "selected"; }?>>CRM Done - Amber</option>
         <option value="CRM Done - Red" <? if($Feedback == "CRM Done - Red") { echo "selected"; }?>>CRM Done - Red</option>
                </select>
	</td>
        <td><b>Comment</b></td>
        <td><textarea rows="2" cols="20" name="pladd_comment" id="pladd_comment" ><? echo $Add_Comment; ?></textarea></td>
	
</tr>
<tr>
	<td class="fontstyle"><b>Follow Up Date</b></td>
	<td class="fontstyle"><?php 
         if($Feedback=='OTP Done - OK')
         {
           $Disabler = " disabled=\"disabled\"";
           $saveHide=" display: none;";
         }else{
            $Disabler = "";
            $saveHide="";
         }
         ?><input type="Text"  name="FollowupDate" id="FollowupDate" maxlength="25" size="15" <?php if($Followup_Date !='0000-00-00 00:00:00') { ?>value="<?php  echo $followup_date; ?>" <?php } ?> <?php echo $Disabler;?>><a href="javascript:NewCal('FollowupDate','yyyymmdd',true,24)"><img src="images/cal.gif" width="16" height="16" border="0" alt="Pick a date" style="<?php echo $saveHide;?>"></a></td>	
	</tr>
 <tr>
     <td colspan="4" align="center"><input type="submit" class="bluebutton" value="Submit"> 
      </td>
   </tr>
</table>
</form>
</body>
</html>