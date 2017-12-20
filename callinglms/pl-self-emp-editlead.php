<?php
require_once("includes/application-top-inner.php");
@set_time_limit(300);
session_start();

if($_SESSION['BidderID']=="")
	{
		header("Location:lmslogin.php");
	}
function ccMasking($number, $maskingCharacter = 'X') 
{
	return substr($number, 0, 2) . str_repeat($maskingCharacter, strlen($number) - 4) . substr($number, -2);
}
require '../scripts/pl_interest_rate_view.php';
require 'personal_loan_eligibility_function_form.php';
require '../scripts/personal_loan_bt_eligibility.php';

$post=$_REQUEST['id'];
$min_date =$_REQUEST['to'];
$max_date=$_REQUEST['from'];
$bidid =$_REQUEST['Bid'];

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
			
	if(strlen($Final_Bid)>0)
	{
	$updatelead="Update Req_Loan_Personal set PL_EMI_Paid='$PL_EMI_Paid',CC_Age='$professional_details',Annual_Turnover='$Annual_Turnover',Company_Type='$plCompany_Type',PL_Tenure= '$acc_no',Name='$plname',Accidental_Insurance='$Accidental_Insurance', Tataaig_Home='$tataaig_home',Tataaig_Health='$tataaig_health',Tataaig_Auto='$tataaig_auto',PL_EMI_Amt='$emi_amt',Company_Name='$plcompany_name', DOB='$pldob', Residential_Status='$plresidential_status',Email='$plemail', City='$plcity', Card_Limit='$plcard_limit', City_Other='$plcity_other', Mobile_Number='$plmobile', Std_Code='$plstd_code', Landline='$pllandline', Std_Code_O='$plstd_code_o', Landline_O='$pllandline_o', Net_Salary='$plnet_salary', Loan_Amount='$plloan_amount', Pincode='$plpincode', Employment_Status='$plemployment_status', CC_Holder='$plcc_holder', Card_Vintage='$plcard_vintage', Total_Experience='$pltotal_experience', Years_In_company='$plyears_in_company', Loan_Any='$Loan_A', Emi_Paid='$plemi_paid', Landline_Connection='$pllandline_connection', Salary_Drawn='$plsalary_drawn', Mobile_Connection='$plmobile_connection',Bidderid_Details='$Final_Bid',Add_Comment='$pladd_comment',Dated=Now(), Allocated='$Allocated',Primary_Acc='$Primary_Acc',Direct_Allocation=0,Existing_Bank='$pl_Existing_Bank',Existing_Loan='$pl_Existing_Loan',Existing_ROI='$pl_Existing_ROI' where RequestID=".$post;
	}
	else
	{
	$updatelead="Update Req_Loan_Personal set PL_EMI_Paid='$PL_EMI_Paid',CC_Age='$professional_details',Annual_Turnover='$Annual_Turnover',Company_Type='$plCompany_Type',PL_Tenure= '$acc_no',Name='$plname',Primary_Acc='$Primary_Acc', Tataaig_Home='$tataaig_home',Accidental_Insurance='$Accidental_Insurance', Tataaig_Health='$tataaig_health',Tataaig_Auto='$tataaig_auto', PL_EMI_Amt='$emi_amt',Company_Name='$plcompany_name', DOB='$pldob', Residential_Status='$plresidential_status',Email='$plemail', City='$plcity', Card_Limit='$plcard_limit', City_Other='$plcity_other', Mobile_Number='$plmobile', Std_Code='$plstd_code', Landline='$pllandline', Std_Code_O='$plstd_code_o', Landline_O='$pllandline_o', Net_Salary='$plnet_salary', Loan_Amount='$plloan_amount', Pincode='$plpincode', Employment_Status='$plemployment_status', CC_Holder='$plcc_holder', Card_Vintage='$plcard_vintage', Total_Experience='$pltotal_experience', Years_In_company='$plyears_in_company', Loan_Any='$Loan_A', Emi_Paid='$plemi_paid', Landline_Connection='$pllandline_connection', Salary_Drawn='$plsalary_drawn', Mobile_Connection='$plmobile_connection', Add_Comment='$pladd_comment',Direct_Allocation=0,Existing_Bank='$pl_Existing_Bank',Existing_Loan='$pl_Existing_Loan',Existing_ROI='$pl_Existing_ROI' where RequestID=".$post;
	}
		//echo "query".$updatelead;
	 $updateleadresult=$obj->fun_db_query($updatelead);

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
					mail($plemail,'Thanks for Registering for '.$product.' on deal4loans.com', $message2, $headers);

					
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
						mail($plemail,'Thanks for Registering for '.$product.' on deal4loans.com', $message2, $headers);
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
if($want_home_loan==1)
	{
	$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-30, date("Y"));
			$days30date=date('Y-m-d',$tomorrow);
			$days30datetime = $days30date." 00:00:00";
			$currentdate= date('Y-m-d');
			$currentdatetime = date('Y-m-d')." 23:59:59";
			
			 $getdetails="select RequestID,Updated_Date From Req_Loan_Home  Where (Mobile_Number='".$plmobile."' and Updated_Date between '".$days30datetime."' and '".$currentdatetime."') order by RequestID DESC";
			$checkavailability = $obj->fun_db_query($getdetails);
			$alreadyExist = $obj->fun_db_get_num_rows($checkavailability);
			$myrow = $obj->fun_db_fetch_rs_array($checkavailability);
		
			if($alreadyExist>0)
			{
				echo "<b>Lead Already Exist in Home Loan, Applied Date.".$myrow['Updated_Date']."</b>";
			}
			else
			{
			$CheckSql = "select UserID from wUsers where Email = '".$plemail."'";
			$CheckQuery = $obj->fun_db_query($CheckSql);
			$CheckNumRows = $obj->fun_db_get_num_rows($CheckQuery);
			if($CheckNumRows>0)
			{
				$UserID = $obj->fun_get_mysql_result($CheckQuery, 0, 'UserID');
				$InsertProductSql = "INSERT INTO Req_Loan_Home (UserID, Name, Email, City, City_Other, Mobile_Number, Net_Salary, Loan_Amount, Dated, source, Updated_Date, Company_Name, Employment_Status, Pincode ) VALUES ( '$UserID', '$plname', '$plemail', '$plcity', '$plcity_other', '$plmobile', '$plnet_salary', '$plloan_amount', Now(), 'PL_LMS', Now(),'".$plcompany_name."','".$plemployment_status."','".$plpincode."')"; 
			}
			else
			{
				$InsertwUsersSql = "INSERT INTO wUsers (Email,FName,Phone,Join_Date,IsPublic) VALUES  ('$plemail', '$plname', '$plmobile', Now(), '$IsPublic')";			
				$InsertwUsersQuery = $obj->fun_db_query($InsertwUsersSql);
				$UserID = mysql_insert_id();
				$InsertProductSql = "INSERT INTO Req_Loan_Home (UserID, Name, Email, City, City_Other, Mobile_Number, Net_Salary, Loan_Amount, Dated, source, Updated_Date, Company_Name, Employment_Status, Pincode) VALUES ( '$UserID', '$plname', '$plemail', '$plcity', '$plcity_other', '$plmobile', '$plnet_salary', '$plloan_amount', Now(), 'PL_LMS', Now(),'".$plcompany_name."','".$plemployment_status."','".$plpincode."')";
			}
				$InsertProductQuery = $obj->fun_db_query($InsertProductSql);
		}
	}
}
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="/css/style.css">
<link href="/includes/style.css" rel="stylesheet" type="text/css">
<script Language="JavaScript" Type="text/javascript" src="/scripts/common.js"></script>
<script language="javascript" type="text/javascript" src="/scripts/datetime.js"></script>
<script src='/scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<script type="text/javascript" src="/ajax.js"></script>
<script type="text/javascript" src="/ajax-dynamic-pllist.js"></script>
<script type="text/JavaScript">
function killCopy(e){ return false; }
function reEnable(){return true; }
document.onselectstart=new Function ("return false");
if (window.sidebar){ document.onmousedown=killCopydocument.onclick=reEnable }
function clickIE4(){if (event.button==2){ return false; } }
function clickNS4(e){ if (document.layers||document.getElementById&&!document.all){ if (e.which==2||e.which==3){ return false;} } }
if (document.layers){ document.captureEvents(Event.MOUSEDOWN); document.onmousedown=clickNS4; } else if (document.all&&!document.getElementById){ document.onmousedown=clickIE4; }
document.oncontextmenu=new Function("return false")
</script>
</head>
<body>
<p align="center"><b>Personal loan Lead Details </b></p>
<?php 
$viewqry="select CC_Age,Annual_Turnover,Company_Type,PL_Bank,PL_Tenure,Name,Add_Comment,Mobile_Number,Landline,Landline_O,Std_Code,Std_Code_O,Net_Salary,Residential_Status,City,City_Other,Is_Valid,Dated,Employment_Status,Loan_Amount,Email,Contactable,source,Loan_Any,Pincode,SentEmail,Emi_Paid,CC_Holder,Card_Vintage,Followup_Date,Feedback,CC_Mailer,Company_Name,Total_Experience,Years_In_Company,DOB,Bidderid_Details,checked_bidders,Primary_Acc,Referral_Flag,Creative,Existing_Bank,Existing_Loan,Existing_ROI from Req_Loan_Personal LEFT OUTER JOIN Req_Feedback_PL ON Req_Feedback_PL.AllRequestID=Req_Loan_Personal.RequestID and Req_Feedback_PL.BidderID= '".$bidid."' where Req_Loan_Personal.RequestID=".$post." "; 
//echo "dd".$viewqry;
$viewlead = $obj->fun_db_query($viewqry);
$viewleadscount =$obj->fun_db_get_num_rows($viewlead);
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
list($mainync,$last) = split('[.]', $Years_In_Company);
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
<form name="loan_form" method="post" action="<? echo $_SERVER['PHP_SELF'] ?>?id=<?echo $post;?>&Bid=<? echo $bidid;?>&to=<? echo $min_date?>&from=<? echo $max_date;?>" >
<input type="hidden" name="BidderId" value="<? echo $bidid;?>">
<input type="hidden" name="plrequestid" id="plrequestid" value="<? echo $post;?>">
  <table style='border:1px dotted #9C9A9C;' cellspacing="2" cellpadding="5" width="600" height="80%" align="center" border="0" >
      <tr>
      <td style="border:1px solid black;" colspan="4" bgcolor="#DAEAF9" align="center" class="fontstyle" ><b>Personal Details</b></td>
    </tr>
    <tr>
      <td class="fontstyle" width="92"><b> Name</b></td>
      <td class="fontstyle" width="212"><input type="text" name="plname" id="plname" value="<?echo $Name;?>"></td>
      <td class="fontstyle" width="75"><b>Email id</b></td>
      <td class="fontstyle" width="169"><input type="text" name="plemail" id="plemail" value="<?echo $Email;?>"></td>
    </tr>
    <tr>
      <td class="fontstyle"><b>DOB</b></td>
      <td class="fontstyle"><input type="text" name="pldob" id="pldob"size="15" value="<?echo $DOB;?>"></td>
      <td class="fontstyle"><b>Mobile</b></td>
      <td class="fontstyle">+91
        <input type="hidden" name="plmobile" size="15" value="<? echo $Mobile;?>"> <?php echo ccMasking($Mobile); ?></td>
    </tr>
    <tr>
      <td class="fontstyle"><b>City</b></td>
      <td class="fontstyle"><select size="1" name="plcity" id="plcity">
          <?=plgetCityList($City)?>
        </select></td>
      <td class="fontstyle"><b>Other City</b></td>
      <td class="fontstyle"><input type="text" name="plcity_other" id="plcity_other" size="10" value="<?echo $City_Other;?>" ></td>
    </tr>
    <tr>
      <td class="fontstyle"><b>Residence Status</b></td>
      <td colspan="2" class="fontstyle"><select name="plresidential_status" id="plresidential_status" style="width: 203px;">
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
      <td>&nbsp;</td>
    </tr>
     <tr>
      <td colspan="4" bgcolor="#DAEAF9" align="center" style="border:1px solid black;"><b>Employment Details</b></td>
    </tr>
    <tr>
      <td class="fontstyle"><b>Employment Status</b></td>
      <td class="fontstyle"><select class="fontstyle" name="plemployment_status" id="plemployment_status">
          <option value="1" <? if($Employment_Status ==1){echo "selected"; }?>>Salaried</option>
          <option value="0" <? if($Employment_Status ==0) {echo "selected"; }?>>Self Employed</option>
        </select></td>
      <td class="fontstyle"><b>Annual Income</b></td>
      <td class="fontstyle"> <input type="radio" name="plnet_salary" id="IncomeAmount1" value="200000" class="css-checkbox" onClick="validateDiv('NetSalaryVal')" <? if($Net_Salary>=200000 && $Net_Salary<250000) { echo "checked"; } ?>/>
            <label for="IncomeAmount1" class="css-label radGroup2">Upto 2 Lacs</label><br>
            <input type="radio" name="plnet_salary" id="IncomeAmount2" value="250000" class="css-checkbox" onClick="validateDiv('NetSalaryVal')" <? if($Net_Salary>=250000 && $Net_Salary<450000) { echo "checked"; } ?>/>
            <label for="IncomeAmount2" class="css-label radGroup2">2 To 3 Lacs</label><br><input type="radio" name="plnet_salary" id="IncomeAmount3" value="450000" class="css-checkbox" onClick="validateDiv('NetSalaryVal')" <? if($Net_Salary>=450000 && $Net_Salary<550000) { echo "checked"; } ?>/>
            <label for="IncomeAmount3" class="css-label radGroup2">3 To 5 Lacs</label><br>
            <input type="radio" name="plnet_salary" id="IncomeAmount4" value="550000" class="css-checkbox" onClick="validateDiv('NetSalaryVal')" <? if($Net_Salary>=550000) { echo "checked"; } ?>/>
            <label for="IncomeAmount4" class="css-label radGroup2">5 Lacs & Above</label></td>
    </tr>
    
    <tr>
      <td>Professional details</td>
      <td><select name="professional_details" id="professional_details" style="width: 203px;">
          <option value="0" <? if($professional_details=="0") { echo "Selected";} ?> >Please Select</option>
          <option value="1" <? if($professional_details=="1") { echo "Selected";} ?>>Businessmen</option>
          <option value="2" <? if($professional_details=="2") { echo "Selected";} ?> >Doctor</option>
          <option value="3" <? if($professional_details=="3") { echo "Selected";} ?> >Engineer</option>
          <option value="4" <? if($professional_details=="4") { echo "Selected";} ?> >Architect</option>
          <option value="5" <? if($professional_details=="5") { echo "Selected";} ?> >Chartered Accountant</option>
        </select></td>
      <td  class="fontstyle"><strong>Annual Turnover</strong></td>
      <td  class="fontstyle">
	   <input type="radio" name="Annual_Turnover" id="Annual_Turnover1" value="1" class="css-checkbox" onClick="validateDiv('AnnualTurnoverVal')" <? if($Annual_Turnover==1) { echo "checked"; } ?> />
            <label for="Annual_Turnover1" class="css-label radGroup2">Upto 50 Lacs</label><br>
            <input type="radio" name="Annual_Turnover" id="Annual_Turnover2" value="2" class="css-checkbox" onClick="validateDiv('AnnualTurnoverVal')" <? if($Annual_Turnover==2) { echo "checked"; } ?>/>
            <label for="Annual_Turnover2" class="css-label radGroup2">50 Lacs To 1 Cr</label><br> <input type="radio" name="Annual_Turnover" id="Annual_Turnover3" value="3" class="css-checkbox" onClick="validateDiv('AnnualTurnoverVal')" <? if($Annual_Turnover==3) { echo "checked"; } ?> />
            <label for="Annual_Turnover3" class="css-label radGroup2" >1 Cr To 3 Crs</label><br>
            <input type="radio" name="Annual_Turnover" id="Annual_Turnover4" value="4" class="css-checkbox" onClick="validateDiv('AnnualTurnoverVal')" <? if($Annual_Turnover==4) { echo "checked"; } ?>/>
            <label for="Annual_Turnover4" class="css-label radGroup2">3 Crs & Above</label>
</td>
    </tr>
    <tr>
      <td class="fontstyle"><b>Total Experience</b></td>
      <td class="fontstyle" colspan="2"><input type="radio" name="pltotal_experience" id="running_business1" value="1" class="css-checkbox" onClick="validateDiv('TotalExperienceVal')" <? if($Total_Experience>=1 && $Total_Experience<2) { echo "checked"; } ?> />
            <label for="running_business1" class="css-label radGroup2">Less Than 2 Yrs</label>
            &nbsp;&nbsp;<input type="radio" name="pltotal_experience" id="running_business2" value="2.5" class="css-checkbox" onClick="validateDiv('TotalExperienceVal')" <? if($Total_Experience>=2 && $Total_Experience<4) { echo "checked"; } ?> />
            <label for="running_business2" class="css-label radGroup2">2 To 3 Yrs</label><br>
        <input type="radio" name="pltotal_experience" id="running_business3" value="4" class="css-checkbox" onClick="validateDiv('TotalExperienceVal')" <? if($Total_Experience>=4  && $Total_Experience<5) { echo "checked"; } ?> />
            <label for="running_business3" class="css-label radGroup">3 To 5 Yrs</label>&nbsp;&nbsp;
        <input type="radio" name="pltotal_experience" id="running_business4" value="5" class="css-checkbox" onClick="validateDiv('TotalExperienceVal')" <? if($Total_Experience>=5) { echo "checked"; } ?> />
            <label for="running_business4" class="css-label radGroup2">5 Yrs & Above</label></td>
      <td class="fontstyle">&nbsp;</td>
      </tr>  
    <tr>
      <td colspan="4" bgcolor="#DAEAF9" align="center" class="fontstyle" style="border:1px solid black;"><b>Surrogate Details</b></td>
    </tr>
    <tr>
      <td class="fontstyle"><b>Credit Card Holder </b></td>
      <td class="fontstyle"><input type="radio" value="1" name="plcc_holder" id="plcc_holder" <? if($CC_Holder==1){ echo "checked";}?> class="NoBrdr" checked>
        Yes
        <input type="radio" value="0" name="plcc_holder"  id="plcc_holder" class="NoBrdr" <?if($CC_Holder==0){ echo "checked";}?>>
        No</td>
      <td class="fontstyle"><b>Card held since?</b></td>
      <td class="fontstyle"><select  class="fontstyle" size="1" name="plcard_vintage" id="plcard_vintage">
        <option value="0" <? if($Card_Vintage==0) { echo "selected"; } ?>>Please select</option>
        <option value="1" <? if($Card_Vintage==1) { echo "selected"; } ?>>Less than 6 months</option>
        <option value="2" <? if($Card_Vintage==2) { echo "selected"; } ?>>6 to 9 months</option>
        <option value="3" <? if($Card_Vintage==3) { echo "selected"; } ?>>9 to 12 months</option>
        <option value="4" <? if($Card_Vintage==4) { echo "selected"; } ?>>more than 12 months</option>
      </select></td>
    </tr>
    <tr>
      <td class="fontstyle">&nbsp;</td>
      <td class="fontstyle">&nbsp;</td>
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
      <td><table border="0">
          <tr>
            <td class="fontstyle"><input type="checkbox" id="Loan_Any" name="Loan_Any[]" class="noBrdr" value="hl" <?php if((strlen(strpos($Loan_Any, "hl")) > 0)) echo "checked"; ?>>
              Home</td>
            <td class="fontstyle"><input type="checkbox" class="noBrdr" id="Loan_Any" name="Loan_Any[]" value="pl" <?php if((strlen(strpos($Loan_Any, "pl")) > 0)) echo "checked"; ?>>
              Personal</td>
          </tr>
          <tr>
            <td class="fontstyle"><input type="checkbox" id="Loan_Any" name="Loan_Any[]" class="noBrdr"  value="cl" <?php if((strlen(strpos($Loan_Any, "cl")) > 0)) echo "checked"; ?>>
              Car</td>
            <td class="fontstyle"><input type="checkbox" name="Loan_Any[]" id="Loan_Any" class="noBrdr" value="lap" <?php if((strlen(strpos($Loan_Any, "lap")) > 0)) echo "checked"; ?>>
              Property</td>
          </tr>
          <tr>
            <td class="fontstyle"><input type="checkbox" name="Loan_Any[]" id="Loan_Any" class="noBrdr" value="other" <?php if((strlen(strpos($Loan_Any, "other")) > 0)) echo "checked"; ?>>
              Other</td>
            <td><input type="checkbox" name="Loan_Any[]" id="Loan_Any" class="noBrdr" value="cdl" <?php if((strlen(strpos($Loan_Any, "cdl")) > 0)) echo "checked"; ?>>
              Consumer Durable</td>
          </tr>
        </table></td>
      <td class="fontstyle"><b>No of Emis Paid for oldest loan</b></td>
      <td class="fontstyle"><select name="plemi_paid" class="fontstyle">
          <option value="0" <?if($Emi_Paid==0) { echo "selected"; } ?>>Please select</option>
          <option value="1" <?if($Emi_Paid==1) { echo "selected"; } ?>>Less than 6 months</option>
          <option value="2" <?if($Emi_Paid==2) { echo "selected"; } ?>>6 to 9 months</option>
          <option value="3" <?if($Emi_Paid==3) { echo "selected"; } ?>>9 to 12 months</option>
          <option value="4" <?if($Emi_Paid==4) { echo "selected"; } ?>>more than 12 months</option>
        </select></td>
    </tr>
   
    <tr>
      <td colspan="4" bgcolor="#DAEAF9" align="center" style="border:1px solid black;"><b>Bidders Details </b></td>
    </tr>
    <? if($City=="Others" || $City=="Please Select")
{
	$City=$City_Other;
}
else
{
	$City= $City;
}
//echo $City;?>
    <tr>
      <td class="fontstyle"><b>Eligible for Bidders</b></td>
      <? if(strlen($Bidderid_Details)>0){?>
      <td class="fontstyle" colspan="2"> already send</td>
      <? } else {?>
      <td colspan="2"><div id="checkdiv" name="checkdiv">
          <? 
$bajajchek=$obj->fun_db_query("Select bajajf_plrequestid From bajaj_cibildetails Where (bajajf_plrequestid=".$post.")");
$bjjchek=$obj->fun_db_fetch_rs_array($bajajchek);
$bajajf_plrequestid=$bjjchek["bajajf_plrequestid"];
if($bajajf_plrequestid>1)
{	$compforbajaj="bajaj";}else	{$compforbajaj="";	}
list($FinalBidder,$finalBidderName)= $objeligiblebidderfuncPL->getBiddersList("Req_Loan_Personal",$post,$City,$Referral_Flag,$source);
   for($i=0;$i<count($FinalBidder);$i++)
			{	   
			
	echo "<input type='checkbox' value='$FinalBidder[$i]' name='Final_Bidder[$i]' id='Final_Bidder[$i]'>".$finalBidderName[$i]."(".$FinalBidder[$i].")";
						}
}	
		?>
        </div></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="2"></td>
    </tr>
   
    
        <tr>
      <td colspan="4" bgcolor="#DAEAF9" align="center" style="border:1px solid black;" ><b>ADD Feedback </b></td>
    </tr>
    <tr>
      <td class="fontstyle"><b>Feedback</b></td>
      <td class="fontstyle"><?php
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
        </select></td>
      <td class="fontstyle"><b>Follow Up Date</b></td>
      <td class="fontstyle"><?php  echo $followup_date3621; ?>
        <input type="Text"  name="FollowupDate" id="FollowupDate" maxlength="25" size="15" <?php if($Followup_Date !='0000-00-00 00:00:00') { ?>value="<?php  echo $followup_date; ?>" <?php } ?>>
        <a href="javascript:NewCal('FollowupDate','yyyymmdd',true,24)"><img src="../images/cal.gif" width="16" height="16" border="0" alt="Pick a date"></a></td>
    </tr>
        <tr>
      <td colspan="2"></td>
      <td><b>Add Comment</b></td>
      <td><textarea rows="2" cols="20" name="pladd_comment" id="pladd_comment" ><? echo $Add_Comment; ?></textarea></td>
    </tr>
    <tr>
      <td colspan="4" align="center"><input type="submit" class="bluebutton" value="Submit"></td>
    </tr>
  </table>
</form>
</body>
</html>