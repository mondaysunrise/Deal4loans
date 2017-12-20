<?php
//require_once("includes/application-topbl.php");
require_once("includes/application-top-inner-testing.php");
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


//require '../scripts/pl_interest_rate_view.php';
//require 'personal_loan_eligibility_function_form.php';
//require '../scripts/personal_loan_bt_eligibility.php';

$post=$_REQUEST['id'];
$min_date =$_REQUEST['to'];
$max_date=$_REQUEST['from'];
$bidid =$_REQUEST['bid'];
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
		$producttype=1;
		$plname =$_POST['plname'];
		$pltotal_experience = $_POST["pltotal_experience"];
		$plyears_in_company = $_POST["plYearsInCompany"];
		$plmobile = $_POST["plmobile"];
		$plstd_code = $_POST["plstd_code"];
		
		$plresidential_status = $_POST["plresidential_status"];
		$plemployment_status = $_POST["plemployment_status"];
		$pllandline_o = $_POST["plOfficePhone"];
		$plstd_code_o = $_POST["plstd_code_o"];
		$plnet_salary = $_POST["plnet_salary"]*12;
		//$plcc_holder =$_POST["plcc_holder"];
		$plcc_holder = $_POST["plcc_holder"];
		$Loan_Any = $_POST["Loan_Any"];
                //print_r ($Loan_Any)."<br>"; die;
		$emi_amt = $_POST["emi_amt"];
		$plcompany_name = $_POST["plcompany_name"];

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
                
                $pl_Existing_ROI = $_REQUEST['roi'];
                ///
                $Gender = $_REQUEST['Gender'];
                $MaritalStatus = $_REQUEST['Marital_Status'];
                $AlterNateNum = $_REQUEST['plAlternateNum'];
                $HighQualification = $_REQUEST['higherQualification'];
                $plOfficeEmail = $_REQUEST['plOfficeEmail'];
                $plCompanyCategory = $_REQUEST['plCompanyCategory'];
                $pl_Existing_Bank = $_REQUEST['BankName'];
                $CibilScore = $_REQUEST['CibilScore'];
                $CurResAdd = $_REQUEST['CurResAdd'];
                $OfficeAdd = $_REQUEST['OfficeAdd'];
                $ApprovedLoan = $_REQUEST['ApprovedLoan']; 
                $tenure = $_REQUEST['tenure'];
                $SFDCID = $_REQUEST['SFDC'];
                $EMIAmount = $_REQUEST['EMIAmount'];
                
                ///
             		
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
                         $Loan_A = substr(trim($Loan_A), 0, -1);

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
	$updatelead="Update Req_Loan_Personal set PL_EMI_Paid='$PL_EMI_Paid',CC_Age='$professional_details',Annual_Turnover='$Annual_Turnover',Company_Type='$plCompany_Type',PL_Tenure= '$tenure',Name='$plname',Accidental_Insurance='$Accidental_Insurance', Tataaig_Home='$tataaig_home',Tataaig_Health='$tataaig_health',Tataaig_Auto='$tataaig_auto',PL_EMI_Amt='$emi_amt',Company_Name='$plcompany_name', DOB='$pldob', Residential_Status='$plresidential_status',Email='$plemail', City='$plcity', Card_Limit='$plcard_limit', City_Other='$plcity_other', Mobile_Number='$plmobile', Std_Code='$plstd_code', Landline='$AlterNateNum', Std_Code_O='$plstd_code_o', Landline_O='$pllandline_o', Net_Salary='$plnet_salary', Loan_Amount='$plloan_amount', Pincode='$plpincode', Employment_Status='$plemployment_status', CC_Holder='$plcc_holder', Card_Vintage='$plcard_vintage', Total_Experience='$pltotal_experience', Years_In_company='$plyears_in_company', Loan_Any='$Loan_A', Emi_Paid='$plemi_paid', Landline_Connection='$pllandline_connection', Salary_Drawn='$plsalary_drawn', Mobile_Connection='$plmobile_connection',Bidderid_Details='$Final_Bid',Add_Comment='$pladd_comment',Dated=Now(), Allocated='$Allocated',Primary_Acc='$Primary_Acc',Direct_Allocation=0,Existing_Bank='$pl_Existing_Bank',Existing_Loan='$pl_Existing_Loan',Existing_ROI='$pl_Existing_ROI', Holding_Current_Account='".$Holding_Current_Account."', Pancard='".$panno."', Gender='$Gender', Marital_Status='$MaritalStatus', company_category='$plCompanyCategory',Cibilscore='$CibilScore',Residence_Address='$CurResAdd' where RequestID=".$post;
	}
	else
	{
	$updatelead="Update Req_Loan_Personal set PL_EMI_Paid='$PL_EMI_Paid',CC_Age='$professional_details',Annual_Turnover='$Annual_Turnover',Company_Type='$plCompany_Type',PL_Tenure= '$tenure',Name='$plname',Primary_Acc='$Primary_Acc', Tataaig_Home='$tataaig_home',Accidental_Insurance='$Accidental_Insurance', Tataaig_Health='$tataaig_health',Tataaig_Auto='$tataaig_auto', PL_EMI_Amt='$emi_amt',Company_Name='$plcompany_name', DOB='$pldob', Residential_Status='$plresidential_status',Email='$plemail', City='$plcity', Card_Limit='$plcard_limit', City_Other='$plcity_other', Mobile_Number='$plmobile', Std_Code='$plstd_code', Landline='$AlterNateNum', Std_Code_O='$plstd_code_o', Landline_O='$pllandline_o', Net_Salary='$plnet_salary', Loan_Amount='$plloan_amount', Pincode='$plpincode', Employment_Status='$plemployment_status', CC_Holder='$plcc_holder', Card_Vintage='$plcard_vintage', Total_Experience='$pltotal_experience', Years_In_company='$plyears_in_company', Loan_Any='$Loan_A', Emi_Paid='$plemi_paid', Landline_Connection='$pllandline_connection', Salary_Drawn='$plsalary_drawn', Mobile_Connection='$plmobile_connection', Add_Comment='$pladd_comment',Direct_Allocation=0,Existing_Bank='$pl_Existing_Bank',Existing_Loan='$pl_Existing_Loan',Existing_ROI='$pl_Existing_ROI', Holding_Current_Account='".$Holding_Current_Account."', Pancard='".$panno."', Gender='$Gender', Marital_Status='$MaritalStatus', company_category='$plCompanyCategory',Cibilscore='$CibilScore',Residence_Address='$CurResAdd' where RequestID=".$post;
	}
	
        $QueryExtraSelect = "SELECT RequestID FROM Req_Loan_Personal_Extra_Fields WHERE RequestID=".$post." AND cibil_reference_id='".$bidid."'";
        $QueryRes=$obj->fun_db_query($QueryExtraSelect);
        $num_rowsExtra = $obj->fun_db_get_num_rows($QueryRes);
        
        
      if($num_rowsExtra>0){
        $QueryExtraField = "Update Req_Loan_Personal_Extra_Fields set office_address='".$OfficeAdd."',higher_qualification='".$HighQualification."',official_email_id='".$plOfficeEmail."',approved_loan='".$ApprovedLoan."',SFDC_ID= '".$SFDCID."',secured_emi='".$EMIAmount."' where RequestID='".$post."' AND cibil_reference_id='".$bidid."'";  
      }else{
      $QueryExtraField = "INSERT INTO Req_Loan_Personal_Extra_Fields (RequestID,cibil_reference_id,incorporation_date,office_address,higher_qualification,official_email_id,approved_loan,SFDC_ID,secured_emi) VALUE('".$post."','".$bidid."','".date("Y-m-d")."','".$OfficeAdd."','".$HighQualification."','".$plOfficeEmail."','".$ApprovedLoan."','".$SFDCID."','".$EMIAmount."')";    
      }
        $QueryUpdateExtra=$obj->fun_db_query($QueryExtraField); 
        
        
//echo "query".$updatelead;
	if($leadident=="hdfcbusinessloan")
	{
	}
	else
	{
	 $updateleadresult=$obj->fun_db_query($updatelead);
	}
	
	//echo $plfeedback; die;	 

	 if(strlen($plfeedback)>0)
	{
		
		
		$SMSMessageplNE="Thanks for your application at Deal4loans.com. We are sorry and cannot process your application further due to certain profile and demographics reasons.";

		$strSQL="";
		$Msg="";
                
		$resultClnt = $obj->fun_db_query("select leadid,AllRequestID,Feedback_ID,BidderID,Reply_Type from client_lead_allocate where AllRequestID=".$post." and BidderID=".$bidid." AND Reply_Type=1");			$num_rows = $obj->fun_db_get_num_rows($resultClnt); 
		if($num_rows > 0){	
			$rowClnt = $obj->fun_db_fetch_rs_array($resultClnt);
			$strSQL="Update client_lead_allocate Set Feedback='".$plfeedback."',Followup_Date='".$FollowupDate."'";
			$strSQL=$strSQL." Where leadid=".$rowClnt["leadid"]."";   }
		else
		{
			//$strSQL="Insert into Req_Feedback_PL(AllRequestID, BidderID, Reply_Type , Feedback, Followup_Date,not_contactable_counter, Caller_Name) Values (";
			//$strSQL=$strSQL.$post.",".$Bidder_Id.",1,'".$plfeedback."','".$FollowupDate."','".$counter."', '".$_SESSION['Caller_Name']."')";

			//if($plfeedback=="Not Eligible")
				//{
					//$objAdmin->SendSMSforLMS($SMSMessageplNE, $plmobile);
				//}

		}
//		/echo $strSQL; die;
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
  .validate_btn {background: #0785e8; padding: 5px; width:63px; text-align:center;  border-radius:5px;  font-size:13px; color:#FFF; font-family: Arial, Helvetica, sans-serif;}
</style>
<link href="/includes/style.css" rel="stylesheet" type="text/css">
<script Language="JavaScript" Type="text/javascript" src="/scripts/common.js"></script>
<script language="javascript" type="text/javascript" src="/scripts/datetime.js"></script>
<script src='/scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<script type="text/javascript" src="/ajax.js"></script>
<script type="text/javascript" src="/ajax-dynamic-pllist.js"></script>
<script src="/js/jquery-2.1.4.min.js" type="text/javascript"></script>
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
<script>

function getPanValidate()
{
	var	pan=document.getElementById('panno').value;;
	var product = "BL";
	var RequestID = <?php echo $post; ?>;
	
	$.ajax({
		type: 'POST',
		url: 'http://www.deal4loans.com/pancard_validationBL.php',
		data: {
			product: product,
			RequestID: RequestID,
			pancard:pan,
		},
		success: function (response) {
		console.log(response);
			//var obj = JSON.parse(response);
			document.getElementById('panvalidation').innerHTML = response;
		}
	});
}
</script>

</head>
<body>
<p align="center">Personal loan Lead Details</p>
<?php 
$viewqry="select CC_Age,Annual_Turnover,Holding_Current_Account, Pancard, Company_Type,PL_Bank,PL_Tenure, Name,Add_Comment,Mobile_Number,Landline,Landline_O,Std_Code,Std_Code_O,Net_Salary,Residential_Status,City,City_Other,Is_Valid,Dated,Employment_Status,Loan_Amount,Email,Contactable,source,Loan_Any,Pincode,Emi_Paid,CC_Holder,Card_Vintage,Followup_Date,Feedback,CC_Mailer,Company_Name,Total_Experience,Years_In_Company,DOB,Bidderid_Details,checked_bidders,Primary_Acc,Referral_Flag,Creative,Existing_Bank,Existing_Loan,Existing_ROI,Gender,Marital_Status,Company_Name,company_category,PL_EMI_Amt,Cibilscore,Residence_Address from Req_Loan_Personal LEFT OUTER JOIN client_lead_allocate ON client_lead_allocate.AllRequestID=Req_Loan_Personal.RequestID and client_lead_allocate.BidderID= '".$bidid."' where Req_Loan_Personal.RequestID=".$post." AND client_lead_allocate.BidderID='".$bidid."'"; 
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
$AlternateNum = $obj->fun_get_mysql_result($viewlead,0,'Landline');
$Landline_O = $obj->fun_get_mysql_result($viewlead,0,'Landline_O');
$Std_Code = $obj->fun_get_mysql_result($viewlead,0,'Std_Code');
$Std_Code_O = $obj->fun_get_mysql_result($viewlead,0,'Std_Code_O');
$Net_Salary = $obj->fun_get_mysql_result($viewlead,0,'Net_Salary')/12;
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
$LoanAny = $obj->fun_get_mysql_result($viewlead,0,'Loan_Any');
$LoanAnyExplode = explode(", ",$LoanAny);
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

//Yaswant

$getGender = $obj->fun_get_mysql_result($viewlead,0,'Gender');
$Marital_Status = $obj->fun_get_mysql_result($viewlead,0,'Marital_Status');
$plcompName = $obj->fun_get_mysql_result($viewlead,0,'Company_Name');
$company_category = $obj->fun_get_mysql_result($viewlead,0,'company_category');
$PL_EMI_Amt = $obj->fun_get_mysql_result($viewlead,0,'PL_EMI_Amt');
$Cibilscore = $obj->fun_get_mysql_result($viewlead,0,'Cibilscore');
$Residence_Address = $obj->fun_get_mysql_result($viewlead,0,'Residence_Address');
$PL_Tenure = $obj->fun_get_mysql_result($viewlead,0,'PL_Tenure');
//


$monthsalary = $Net_Salary/12;

        
        $viewqryExtra="select RequestID,cibil_reference_id,incorporation_date, office_address, higher_qualification,official_email_id,approved_loan, SFDC_ID,secured_emi FROM Req_Loan_Personal_Extra_Fields  WHERE RequestID=".$post." AND cibil_reference_id='".$bidid."'";
        $viewleadExtra = $obj->fun_db_query($viewqryExtra);
//print_R($viewlead);
$viewleadscountExtra =$obj->fun_db_get_num_rows($viewleadExtra);
//print_R($viewleadscount);
$OfficeAddress = $obj->fun_get_mysql_result($viewleadExtra,0,'office_address');
$higherQualification = $obj->fun_get_mysql_result($viewleadExtra,0,'higher_qualification');
$OfficeEmailID = $obj->fun_get_mysql_result($viewleadExtra,0,'official_email_id');
$approvedLoan = $obj->fun_get_mysql_result($viewleadExtra,0,'approved_loan');
$SFDC_ID = $obj->fun_get_mysql_result($viewleadExtra,0,'SFDC_ID');
$secured_emi = $obj->fun_get_mysql_result($viewleadExtra,0,'secured_emi');

        
        
        
?>
<script language="javascript">
function getProfDetails()
{
	if(document.loan_form.plemployment_status.value=='SEP')
	{
	//	document.getElementById('pDetails').innerHTML =	'';
		document.getElementById('pDetailsField').innerHTML = '<select name="professional_details" id="professional_details">          <option value="0" <? if($professional_details=="0") { echo "Selected";} ?> >Please Select</option>          <option value="1" <? if($professional_details=="1") { echo "Selected";} ?>>Businessmen</option>          <option value="2" <? if($professional_details=="2") { echo "Selected";} ?> >Doctor</option>          <option value="3" <? if($professional_details=="3") { echo "Selected";} ?> >Engineer</option>          <option value="4" <? if($professional_details=="4") { echo "Selected";} ?> >Architect</option>          <option value="5" <? if($professional_details=="5") { echo "Selected";} ?> >Chartered Accountant</option>        </select>';
		}
	else
	{
		//document.getElementById('pDetails').innerHTML =	'';
		document.getElementById('pDetailsField').innerHTML =	'<select name="professional_details" id="professional_details">   </select>';
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
<form name="loan_form" method="post" action="<? echo $_SERVER['PHP_SELF'] ?>?id=<?php echo $post;?>&bid=<? echo $bidid;?>">

<input type="hidden" name="plrequestid" id="plrequestid" value="<? echo $post;?>">
<input type="hidden" name="leadident" id="leadident" value="<? echo $leadident;?>">
  <table cellspacing="2" cellpadding="0" width="100%" align="center" border="0" >
      <tr>
      <td colspan="4" align="center" bgcolor="#CCC" class="heading" style="border-top:1px solid #CCC; border-bottom:1px solid #CCC;"><strong>Personal Details</strong></td>
    </tr>
    <tr>
      <td width="21%"  ><strong>Pancard</strong></td>
          <td width="24%"><input type="text" class="d4l-input" name="panno" id="panno" value="<? echo $Pancard ;?>"  maxlength="10"/><span id="panvalidation"> <input type="button" id="validatepanbtn" onclick="getPanValidate();" class="validate_btn" value="Validate"></span></td>
        
        <td width="170"> <strong>Customer Name</strong></td>
      <td  width="286" align="left" valign="top"><input name="plname" type="text" id="plname" value="<?php echo $Name;?>"></td>
     
    </tr>
     <tr bgcolor="#F0F0F0" >
       <td  width="205"><strong>Email id</strong></td>
      <td  width="279"><input name="plemail" type="text" id="plemail" value="<?php echo $Email;?>"></td>
         <td><strong>DOB</strong></td>
      <td align="left" valign="top" bgcolor="#F0F0F0" ><input name="pldob" type="text" id="pldob" value="<? echo $DOB;?>"> <a href="javascript:NewCal('pldob','yyyymmdd',false,24)"><img src="../images/cal.gif" width="16" height="16" border="0" alt="Pick a date"></a></td>
      
    </tr>
    <tr>
        <td><strong>Mobile</strong></td>
      <td>+91
        <input type="hidden" name="plmobile" value="<? echo $Mobile;?>"> <?php if($leadident=="hdfcbusinessloan") {echo $Mobile;} else { echo ccMasking($Mobile);} ?></td>
      <td><strong>City</strong></td>
      <td align="left"><select name="plcity" size="1" id="plcity">
          <?=plgetCityList($City)?>
        </select></td>
      
      
    </tr>
    <tr bgcolor="#F0F0F0">
       <td><strong>Alternate Num</strong></td>
       <td align="left"><input type="text" name="plAlternateNum"  id="plAlternateNum" value="<?php echo $AlternateNum;?>" />
          
        </td> 
        <td><strong>Other City</strong></td>
      <td ><input name="plcity_other" type="text" id="plcity_other" value="<?php echo $City_Other;?>" size="10" ></td>
      
     
    </tr>
	<tr>
            <td><strong>Gender</strong></td>
      <td width="30%"  >  <input type="radio" name="Gender" id="Gender" value="1" class="css-checkbox"  <? if($getGender==1) { echo "checked"; } ?>  />            <label for="Gender" class="css-label radGroup2">Male</label>            <input type="radio" name="Gender" id="Gender2" value="0" class="css-checkbox"  <? if($getGender==0) { echo "checked"; } ?> />            <label for="Gender" class="css-label radGroup2">Female </label>    </td>
<td><strong>Marital Status</strong></td>
      <td><select name="Marital_Status" id="Marital_Status">
          <option value="">Please Select</option>
          <option value="1" <? if($Marital_Status=="1"){ echo "Selected";} ?>>Single</option>
          <option value="2" <? if($Marital_Status=="2"){ echo "Selected";} ?>>Married</option>
          </select></td>
        
    </tr>
    <tr bgcolor="#F0F0F0">
         <td><strong>Higher Qualification</strong></td>
      <td><select name="higherQualification" id="higherQualification">
          <option value="0">Please Select</option>
          <option value="Doctorate" <? if($higherQualification=="Doctorate"){ echo "Selected";} ?>>Doctorate</option>
          <option value="Engineer" <? if($higherQualification=="Engineer"){ echo "Selected";} ?>>Engineer</option>
          <option value="Graduate" <? if($higherQualification=="Graduate"){ echo "Selected";} ?>>Graduate</option>
          <option value="Matric" <? if($higherQualification=="Matric"){ echo "Selected";} ?>>Matric</option>
          <option value="PostGraduate" <? if($higherQualification=="PostGraduate"){ echo "Selected";} ?>>Post Graduate</option>
          <option value="Professional" <? if($higherQualification=="Professional"){ echo "Selected";} ?>>Professional</option>
          <option value="UnderGraduate" <? if($higherQualification=="UnderGraduate"){ echo "Selected";} ?>>Under Graduate</option>
          <option value="Others" <? if($higherQualification=="Others"){ echo "Selected";} ?>>Others</option>
         
          </select></td> 
          <td><strong>Required Amount</strong></td>
          <td ><input name="plloan_amount" type="text" id="plloan_amount" value="<?php echo $Loan_Amount;?>" /></td>
        
    </tr>
    
 <tr>
      <td colspan="4" align="center" bgcolor="#CCC" class="heading" style="border-top:1px solid #CCC; border-bottom:1px solid #CCC;"><strong>Employment Details</strong></td>
    </tr>
    <tr>
       <td><strong>Employment Status</strong></td>
      <td align="left" valign="top" ><select name="plemployment_status" id="plemployment_status" onChange="getProfDetails();">
       
          <option value="1" <? if($Employment_Status ==1){echo "selected"; }?>>Salaried</option>
          <option value="0" <? if($Employment_Status ==0) {echo "selected"; }?>>Self Employed</option>
        </select></td>
        
        <td><strong>Net Salary(PM)</strong></td>
        <td ><input name="plnet_salary" type="text" id="plnet_salary" value="<?php echo $Net_Salary;?>" /></td>
    </tr>
    <tr bgcolor="#F0F0F0">
         <td><strong>Company Name</strong></td>
         <td ><input name="plcompany_name" type="text" id="plcompany_name" value="<?php echo $plcompName;?>" /></td>
        <td width="25%"  ><strong>Company Type</strong></td>
          <td width="30%"  ><select name="plCompany_Type" id="plCompany_Type">
		  <option value="0" <? if($Company_Type==0) {echo "selected";} ?>>Please Select</option>
		  	<option value="1" <? if($Company_Type==1) {echo "selected";} ?>>Pvt Ltd</option>
                        <option value="2" <? if($Company_Type==2) {echo "selected";} ?>>Government Firm</option>
                        <option value="3" <? if($Company_Type==3) {echo "selected";} ?>>MNC Ltd</option>
			<option value="7" <? if($Company_Type==7) {echo "selected";} ?>>Public Ltd </option>
                        <option value="8" <? if($Company_Type==8) {echo "selected";} ?>>Partnership Firm</option>
			<option value="9" <? if($Company_Type==9) {echo "selected";} ?>>Proprietorship Firm</option>
		<option value="10" <? if($Company_Type==10) {echo "selected";} ?>>Others</option>
			</select></td>
       
    </tr>
    <tr>
         <td><strong>Total Experience</strong></td>
         <td ><input name="pltotal_experience" type="text" id="pltotal_experience" value="<?php echo $Total_Experience;?>" />(Years)</td>
        <td width="25%"  ><strong>Current experience in company</strong></td>
        <td ><input name="plYearsInCompany" type="text" id="plYearsInCompany" value="<?php echo $Years_In_Company;?>" />(Years)</td>
       
    </tr>
    <tr bgcolor="#F0F0F0">
         <td><strong>Official email id</strong></td>
         <td ><input name="plOfficeEmail" type="text" id="plOfficeEmail" value="<?php echo $OfficeEmailID?>" /></td>
        <td width="25%"  ><strong>Company Categories</strong></td>
          <td ><select name="plCompanyCategory" id="plCompanyCategory">
		  <option value="0" <? if($company_category==0) {echo "selected";} ?>>Please Select</option>
		  	<option value="Category A" <? if($company_category=='Category A') {echo "selected";} ?>>Category A</option>
			<option value="Category B" <? if($company_category=='Category B') {echo "selected";} ?>>Category B</option>
			<option value="Category C" <? if($company_category=='Category C') {echo "selected";} ?>>Category C</option>
		<option value="Category D" <? if($company_category=='Category D') {echo "selected";} ?>>Category D</option>
                <option value="Others" <? if($company_category=='Others') {echo "selected";} ?>>Others</option>
			</select></td>
       
    </tr>
    <tr>
         <td><strong>Official Phone no</strong></td>
         <td ><input name="plOfficePhone" type="text" id="plOfficePhone" value="<?php echo $Landline_O;?>" /></td></tr>
<tr>
      <td colspan="4" align="center" bgcolor="#CCC" class="heading" style="border-top:1px solid #CCC; border-bottom:1px solid #CCC;"><strong>Loan Surrogate</strong></td>
    </tr>    
 <tr>
         <td><strong>Loan Type</strong></td>
         <td ><select name="Loan_Any[]" id="Loan_Any" multiple="multiple" style="width: 190px;">
                        <option value="">Please select</option>
                        <option value="pl" <? if(in_array("pl",$LoanAnyExplode)) {echo "selected";} ?>>Personal Loan</option>
                        <option value="hl" <? if(in_array("hl",$LoanAnyExplode)) {echo "selected";} ?>>Home Loan</option>
                        <option value="cl" <? if(in_array("cl",$LoanAnyExplode)) {echo "selected";} ?>>Car Loan</option>
                        <option value="bl" <? if(in_array("bl",$LoanAnyExplode)) {echo "selected";} ?>>Business Loan</option>
                        <option value="cdl" <? if(in_array("cdl",$LoanAnyExplode)) {echo "selected";} ?>>CD Loan</option>
                        <option value="cc" <? if(in_array("cc",$LoanAnyExplode)) {echo "selected";} ?>>Credit Card</option>
                        <option value="Others" <? if(in_array("Others",$LoanAnyExplode)) {echo "selected";} ?>>Others</option>
                    </select></td>
           <td><strong>Monthly EMI</strong></td>  
           <td ><input name="emi_amt" type="text" id="emi_amt" value="<?php echo $PL_EMI_Amt;?>" /></td>
 </tr>
<tr bgcolor="#F0F0F0">
         <td><strong>No of EMI paid</strong></td>
         <td ><input name="plemi_paid" type="text" id="plemi_paid" value="<?php echo $Emi_Paid;?>" /></td>
           <td><strong>Name of the Bank</strong></td>  
           <td ><input name="BankName" type="text" id="BankName" value="<?php echo $Existing_Bank;?>" /></td>
 </tr> 
    <tr>
         <td><strong>Cibil Score</strong></td>
      <td ><input name="CibilScore" type="text" id="CibilScore" value="<?php echo $Cibilscore;?>" /></td>
 </tr> 
    <tr>
      <td colspan="4" align="center" bgcolor="#CCC" class="heading" style="border-top:1px solid #CCC; border-bottom:1px solid #CCC;"><strong>Others Details </strong></td>
    </tr>
    <tr>
        <td><strong>Current Residence Address</strong></td>
        <td><textarea name="CurResAdd"><?php echo $Residence_Address?></textarea></td>
        <td><strong>Office Address</strong></td>
        <td><textarea name="OfficeAdd"><?php echo $OfficeAddress;?></textarea></td>
    </tr>
    <tr bgcolor="#F0F0F0">
        <td><strong>Residence Status</strong></td>
        <td><select name="plresidential_status" id="plresidential_status">
                <option value="0">Please Select</option>
                <option value="1" <? if($Residential_Status=='1') {echo "selected";} ?>>Self-Owned</option>
                <option value="2" <? if($Residential_Status=='2') {echo "selected";} ?>>Rented</option>
                <option value="3" <? if($Residential_Status=='3') {echo "selected";} ?>>Parental-Owned</option>
                <option value="4" <? if($Residential_Status=='4') {echo "selected";} ?>>Company Provided</option>
                <option value="5" <? if($Residential_Status=='5') {echo "selected";} ?>>Relative House</option>
                <option value="6" <? if($Residential_Status=='6') {echo "selected";} ?>>Bachelor Accommodation</option>
                <option value="7" <? if($Residential_Status=='7') {echo "selected";} ?>>PG</option>
                <option value="8" <? if($Residential_Status=='8') {echo "selected";} ?>>Others</option>
          </select></td>
           <td><strong>Approved Loan</strong></td>
           <td><input type="text" name="ApprovedLoan" value="<?php echo $approvedLoan;?>" /></td>
    </tr>
     <tr>
        <td><strong>ROI</strong></td>
        <td><input type="text" name="roi" id="roi" value="<?php echo $Existing_ROI;?>" /></td>
        <td><strong>Tenure</strong></td>
        <td><input type="text" name="tenure" value="<?php echo $PL_Tenure?>" /></td>
    </tr>
    
   
    <tr bgcolor="#F0F0F0">
         <td><strong>SFDC ID:- (CFL Approved ID)</strong></td>
         <td><input type="text" name="SFDC" id="SFDC" value="<?php echo $SFDC_ID;?>" /></td>
        <td><strong>EMI Amount</strong></td>
        <td><input type="text" name="EMIAmount" id="EMIAmount" value="<?php echo $secured_emi;?>" /></td>
       
    </tr>
   
    
           <tr>
      <td colspan="4" align="center" bgcolor="#CCC" class="heading" style="border-top:1px solid #CCC; border-bottom:1px solid #CCC;"><strong>Feedback </strong></td>
    </tr>
    <tr>
      <td valign="top" ><strong>Agent Feedback</strong></td>
      <td valign="top" >
        <select name="plfeedback" id="feedback">
          <option value="" <? if($Feedback == "") { echo "selected"; }?>>No Feedback</option>
          <option value="Ringing" <? if($Feedback == "Ringing") { echo "selected"; }?>>Ringing</option>
          
          <option value="Not Contactable" <? if($Feedback == "Not Contactable") { echo "selected"; }?>>Not Contactable</option>
          <option value="Callback Later" <? if($Feedback == "Callback Later") { echo "selected"; }?>>Callback Later</option>
           <option value="FollowUp" <? if($Feedback == "FollowUp") { echo "selected"; }?>>FollowUp</option>
          <option value="Not Interested" <? if($Feedback == "Not Interested") { echo "selected"; }?>>Not Interested</option>
         <option value="Wrong Number" <? if($Feedback == "Wrong Number") { echo "selected"; }?>>Wrong Number</option>
         <option value="Duplicate" <? if($Feedback == "Duplicate") { echo "selected"; }?>>Duplicate</option>
         
         
         <option value="Not Eligible" <? if($Feedback == "Not Eligible") { echo "selected"; }?>>Not Eligible</option>
         <option value="Other Product" <? if($Feedback == "Other Product") { echo "selected"; }?>>Other Product</option>
         <option value="Not Applied" <? if($Feedback == "Not Applied") { echo "selected"; }?>>Not Applied</option> 
         <option value="Approved" <? if($Feedback == "Approved") { echo "selected"; }?>>Approved</option>
         <option value="Approved - Followup" <? if($Feedback == "Approved - Followup") { echo "selected"; }?>>Approved - Followup</option>
         <option value="Approved - Not Interested" <? if($Feedback == "Approved - Not Interested") { echo "selected"; }?>>Approved - Not Interested</option>
         <option value="Approved - Appointment" <? if($Feedback == "Approved - Appointment") { echo "selected"; }?>>Approved - Appointment</option>
         <option value="Approved-Docs Collected" <? if($Feedback == "Approved-Docs Collected") { echo "selected"; }?>>Approved-Docs Collected</option>
         <option value="Approved-Login" <? if($Feedback == "Approved-Login") { echo "selected"; }?>>Approved-Login</option>
         <option value="Approved-Rejected" <? if($Feedback == "Approved-Rejected") { echo "selected"; }?>>Approved-Rejected</option>
         <option value="Approved - Disbursed" <? if($Feedback == "Approved - Disbursed") { echo "selected"; }?>>Approved - Disbursed</option>
         
         </select></td>
      <td class="fontstyle"><b>Follow Up Date</b></td>
      <td class="fontstyle"><?php  echo $followup_date3621; ?>
        <input type="Text"  name="FollowupDate" id="FollowupDate" maxlength="25" size="15" <?php if($Followup_Date !='0000-00-00 00:00:00') { ?>value="<?php  echo $followup_date; ?>" <?php } ?>>
        <a href="javascript:NewCal('FollowupDate','yyyymmdd',true,24)"><img src="../images/cal.gif" width="16" height="16" border="0" alt="Pick a date"></a></td>
    </tr>
        <tr bgcolor="#F0F0F0">
        <td><b>Add Comment</b></td>
      <td><textarea rows="2" cols="20" name="pladd_comment" id="pladd_comment" ><? echo $Add_Comment; ?></textarea></td>
      <td colspan="2" align="center"><input type="submit" class="submit-sms" value="Submit"></td>
    </tr>
    <tr><td colspan="4">&nbsp;</td></tr></table></form>
    
</div>
<br>
<br>
</body>
</html>