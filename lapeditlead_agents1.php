<?php
require 'scripts/session_check_online.php';
require 'scripts/db_init.php';
//require 'scripts/db_init_bima.php';
require 'scripts/functions.php';
require 'eligiblebidderfuncLAP.php';

ini_set('max_execution_time', 600);
session_start();
//businessloanlms1@deal4loans.com
//bllms@one

//$_SESSION['BidderID'] = 12345;

$post=$_REQUEST['id'];
$min_date =$_REQUEST['to'];
$max_date=$_REQUEST['from'];
$bidid = $_REQUEST['Bid'];
$Bidder_Id = $_REQUEST['Bid'];


if($_SESSION['BidderID']=="")
{
//	header("Location: callinglms/login.php");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		foreach($_POST as $a=>$b)
			$$a=$b;
//echo "<pre>";
//print_r($_SESSION);
//print_r($_POST);


//    [plrequestid] => 86760

    $plname = trim($_POST['plname']);
     $plemail= $_POST['plemail'];
     $pldob= $_POST['pldob'];
     $plmobile= $_POST['plmobile'];
     $plcity= $_POST['plcity'];
     $plcity_other= $_POST['plcity_other']; 
     $plstd_code= $_POST['lapstd_code']; 
     $pllandline= $_POST['laplandline']; 
     $plstd_code_o= $_POST['lapstd_code_o']; 
     $pllandline_o= $_POST['laplandline_o']; 
     $plpincode = $_POST['lappincode'];
     $plemployment_status= $_POST['plemployment_status'];
     if($plemployment_status=="SEP" || $plemployment_status=="SENP" || $plemployment_status=="SEM" || $plemployment_status=="SET" || $plemployment_status=="SES")
	 {
 		$Emp_Status = $plemployment_status;
		$plemployment_status = 0;
	 }
	 $plloan_amount = $_POST['plloan_amount'];
     $pladd_comment = $_POST['pladd_comment'];
    
    
    	$updatelead="Update Req_Loan_Against_Property set Name='$plname' , Company_Name='$plcompany_name' , DOB='$pldob' , Email='$plemail' , City='$plcity' , City_Other='$plcity_other' ,  Mobile_Number='$plmobile' ,  Std_Code='$plstd_code' , Landline='$pllandline' , Std_Code_O='$plstd_code_o' , Landline_O='$pllandline_o' , Net_Salary='$plnet_salary' , Pincode='$plpincode' , Employment_Status='$plemployment_status' , Bidderid_Details='$Final_Bid' , Add_Comment='$pladd_comment' , Updated_Date=Now() , Contact_Time='$plcontact_time' , Property_Value='$plproperty_value' , Loan_Amount='$plloan_amount' , Property_Loc='$property_loc' , Is_Valid='$Is_Valid' where RequestID=".$post;

	//	echo "query - ".$updatelead."<br>";
	 $updateleadresult=ExecQuery($updatelead);

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

 	$ITR_filing= $_POST['ITR_filing'];
 	$IncorporationDate= $_POST['IncorporationDate'];
    $ITR_Details= $_POST['ITR_Details'];
    $plCompany_Type= $_POST['plCompany_Type'];
    $Holding_Current_Account = $_POST['Holding_Current_Account'];
    $panno= $_POST['panno'];
    $vat= $_POST['vat'];
    $Property_Type= $_POST['Property_Type'];
    $map_available= $_POST['map_available'];
    $Property_Size= $_POST['Property_Size'];
    $allocated_to_banks = $_POST['allocated_to_banks']; 
    $residence_address= $_POST['residence_address'];
    $office_address= $_POST['office_address'];
     
    
   
   	$CheckSql = "select RequestID from Req_Loan_Against_Property_ED where RequestID = '".$post."'";
	$CheckQuery = ExecQuery($CheckSql);
	$CheckNumRows = mysql_num_rows($CheckQuery);
	if($CheckNumRows>0)
	{
		$sqlUpdate = "update Req_Loan_Against_Property_ED set Emp_Status='".$Emp_Status."', Owner_Property='".$Owner_Property."', Urgency_Loan='".$Urgency_Loan."',reflecting_income='".$reflecting_income."', PL_Details='".$PL_Details."', HL_Details='".$HL_Details."', CL_Details='".$CL_Details."', BL_Details='".$BL_Details."', LAP_Details='".$LAP_Details."', CC_Details='".$CC_Details."', ITR_Details='".$ITR_Details."', ITR_filing = '".$ITR_filing."', IncorporationDate = '".$IncorporationDate."', Company_Type='".$plCompany_Type."', Holding_Current_Account = '".$Holding_Current_Account."', Pancard = '".$panno."', vat = '".$vat."', Property_Type = '".$Property_Type."', map_available = '".$map_available."', Property_Size = '".$Property_Size."', allocated_to_banks = '".$allocated_to_banks."', residence_address = '".$residence_address."', office_address = '".$office_address."'  where RequestID='".$post."' ";
	//echo "".$sqlUpdate."";
	ExecQuery($sqlUpdate);
	}	 
	else
	{
		$sqlInsert = "INSERT INTO Req_Loan_Against_Property_ED (RequestID, Emp_Status, Owner_Property, Urgency_Loan,reflecting_income, PL_Details, HL_Details, CL_Details, BL_Details, LAP_Details, CC_Details, ITR_Details, ITR_filing, IncorporationDate, Company_Type, Holding_Current_Account, Pancard, vat, Property_Type, map_available, Property_Size, allocated_to_banks, residence_address, office_address ) VALUES ('".$post."', '".$Emp_Status."', '".$Owner_Property."', '".$Urgency_Loan."', '".$reflecting_income."', '".$PL_Details."', '".$HL_Details."', '".$CL_Details."', '".$BL_Details."', '".$LAP_Details."', '".$CC_Details."', '".$ITR_Details."', '".$ITR_filing."', '".$IncorporationDate."', '".$Company_Type."', '".$Holding_Current_Account."', '".$Pancard."', '".$vat."', '".$Property_Type."', '".$map_available."', '".$Property_Size."', '".$allocated_to_banks."', '".$residence_address."', '".$office_address."')";
		//echo "".$sqlInsert."";
		ExecQuery($sqlInsert);
	}

    $plfeedback= $_POST['plfeedback'];
    $FollowupDate= $_POST['FollowupDate'];

		$strSQL="";
		$Msg="";
		$result = ExecQuery("select FeedbackID,not_contactable_counter from Req_Feedback_LAP where AllRequestID=".$post." and BidderID=".$Bidder_Id."");		
		
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

			$strSQL="Update Req_Feedback_LAP Set Feedback='".$plfeedback."',not_contactable_counter='".$updatedcounter."',Followup_Date='".$FollowupDate."', Caller_Name='".$_SESSION['Bidder_Name']."'";
			$strSQL=$strSQL." Where FeedbackID=".$row["FeedbackID"];

		}
		else
		{
			$strSQL="Insert into Req_Feedback_LAP(AllRequestID, BidderID, Reply_Type , Feedback, Followup_Date,not_contactable_counter, Caller_Name) Values (";
			$strSQL=$strSQL.$post.",".$Bidder_Id.",5,'".$plfeedback."','".$FollowupDate."','".$counter."', '".$_SESSION['Bidder_Name']."')";
		}
	//	echo "<br>".$strSQL."<br>";
		$result =ExecQuery($strSQL);


}















function ccMasking($number, $maskingCharacter = 'X') 
{
	return substr($number, 0, 2) . str_repeat($maskingCharacter, strlen($number) - 4) . substr($number, -2);
}
function BusinessDetailsValue($i)
{
	$BusinessDetails = array("1"=>"Business continuity proof Ã¢â‚¬â€œ 3 years  and  more income tax return & income statements", "2"=>"Last 2/3year audit re port and audited Financials", "3"=>"Last 6-12 months bank statements", "4"=>"In the case of transfer of a loan: Last 12 months ofÃ‚Â  loans statementÃ‚Â  along with the Sanction Letter of your previous bank", "5"=>"Any other loan statements on books of companies along with Sanction Letters", "6"=>"Last 12 months loan statement with Sanction Letter of any other existing loans", "7"=>"Business incorporation date proof Ã¢â‚¬â€œ PAN Card",    "8"=>"MOA(Memorandum of Association) and AOA (Articles of Association)", "9"=>"Latest shareholding pattern on company letterhead", "10"=>"List of current Directors on company letterhead", "11"=>"Certificate of Incorporation", "12"=>"Partnership Deed", "13"=>"Certificate of Registration", "14"=>"Proof of continuation:Ã‚Â  Trade license /Establishment /Sales Tax certificate", "15"=>"Proof of continuation: Trade license /Establishment /Sales Tax certificate/ SSI Registration", "16"=>"Brief Business Profile on the Letter Head of the firm by the applicant", "17"=>"Copy of Tax Deduction Certificate 26 AS  / Form Ã¢â‚¬â€œ 16A (if applicable)", "18"=>"Copy of Advance Tax paid / Self Assessment Tax paid challan", "19"=>"Copy of Educational Qualification Certificate ( professional  loans ) ", "20"=>"Copy of Professional Practice Certificate", "21"=>"Salary Certificate (in case of doctors having salaried income)");
	return $BusinessDetails[$i];
}


function GrossTurnoverValue($i)
{
	$GrossTurnover = array("1"=>"Latest 2  Years ITRs' , Computation of Income, P&L, Balance sheet with all schedules with CA seal and sign", "2"=>"Tax Audit Report (Where Gross Turnover Exceeds Rs 1 Crs for Non Professional Self Employed and Gross Receipts Exceeds 25 Lacs incase of Professionals and )", "3"=>"Last 1 Year bank statements (with logo and Bank name) both Current and SB Account", "4"=>"Business Continuity Proof for 3 Yrs", "5"=>"Existing loan details and 6 months emi reflecting bank statement", "6"=>"Latest LOD,OS Letter and Last 12 Months SOA in case of BT Proposal", "7"=>"Partnership Deed & Latest list of partners & NOC as per Bank  bank format", "8"=>"In case applicant is a Partner- Partnership firm's audited ITR along with complete financials to be collected", "9"=>"Partnership Authority Letter on Letterhead of the Firm signed by all partners in case Firm to stand as guarantor", "10"=>"Incase applicant is a Director, then the company's  audited ITR along with complete financials to be collected", "11"=>"Board Resolution as per Bank  bank format- Incase company is applicant/guarantor", "12"=>"Certificate of Incorporation", "13"=>"MOA and AOA", "14"=>"DIN of all Directors to be collected where company is applicant,Co_Applicant or Guarantor to the Loan", "15"=>"Latest Share Holding Pattern");	
	return $GrossTurnover[$i];
}



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
<link href="includes/style.css" rel="stylesheet" type="text/css">
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
<p align="center">Loan Against Property Lead Details</p>
<?php 
$viewqry="select * from Req_Loan_Against_Property LEFT OUTER JOIN Req_Feedback_LAP ON Req_Feedback_LAP.AllRequestID=Req_Loan_Against_Property.RequestID and Req_Feedback_LAP.BidderID= '".$bidid."' where Req_Loan_Against_Property.RequestID=".$post." "; 

//echo "dd".$viewqry;
$viewlead = ExecQuery($viewqry);
$viewleadscount =mysql_num_rows($viewlead);
$Name = mysql_result($viewlead,0,'Name');
$property_loc = mysql_result($viewlead,0,'Property_Loc');
$Add_Comment= mysql_result($viewlead,0,'Add_Comment');
$Mobile = mysql_result($viewlead,0,'Mobile_Number');
$Landline = mysql_result($viewlead,0,'Landline');
$Landline_O = mysql_result($viewlead,0,'Landline_O');
$Std_Code = mysql_result($viewlead,0,'Std_Code');
$Std_Code_O = mysql_result($viewlead,0,'Std_Code_O');
$Net_Salary = mysql_result($viewlead,0,'Net_Salary');
$City = mysql_result($viewlead,0,'City');
$City_Other = mysql_result($viewlead,0,'City_Other');
$Is_Valid = mysql_result($viewlead,0,'Is_Valid');
$Dated = mysql_result($viewlead,0,'Dated');
$Employment_Status = mysql_result($viewlead,0,'Employment_Status');
$Loan_Amount = mysql_result($viewlead,0,'Loan_Amount');
$Email = mysql_result($viewlead,0,'Email');
$source = mysql_result($viewlead,0,'source');
$Pincode = mysql_result($viewlead,0,'Pincode');
$SentEmail = mysql_result($viewlead,0,'SentEmail');
$followup_date = mysql_result($viewlead,0,'Followup_Date');
$Feedback = mysql_result($viewlead,0,'Feedback');
$Property_Value = mysql_result($viewlead,0,'Property_Value');
$Company_Name = mysql_result($viewlead,0,'Company_Name');
$DOB = mysql_result($viewlead,0,'DOB');
$Contact_Time  = mysql_result($viewlead,0,'Contact_Time');
$Bidderid_Details = mysql_result($viewlead,0,'Bidderid_Details');

$edSql = "select * from Req_Loan_Against_Property_ED where RequestID = '".$post."'";
$viewleadsbled = ExecQuery($edSql );

$viewEmp_Status = mysql_result($viewleadsbled,0,'Emp_Status');
if(strlen($viewEmp_Status)>0)
{
	$Employment_Status='';
}
$viewOwner_Property = mysql_result($viewleadsbled,0,'Owner_Property');
$viewUrgency_Loan = mysql_result($viewleadsbled,0,'Urgency_Loan');
$viewreflecting_income = mysql_result($viewleadsbled,0,'reflecting_income');
$PL_Details = mysql_result($viewleadsbled,0,'PL_Details');
$PL_DetailsArr = explode(",",$PL_Details);
$viewpl_amt = $PL_DetailsArr[0];
$viewpl_bank = $PL_DetailsArr[1];
$viewpl_emi_amt = $PL_DetailsArr[2];
$viewpl_emi = $PL_DetailsArr[3];
$HL_Details = mysql_result($viewleadsbled,0,'HL_Details');
$HL_DetailsArr = explode(",",$HL_Details);
$viewhl_amt = $HL_DetailsArr[0];
$viewhl_bank = $HL_DetailsArr[1];
$viewhl_emi_amt = $HL_DetailsArr[2];
$viewhl_emi = $HL_DetailsArr[3];
$CL_Details = mysql_result($viewleadsbled,0,'CL_Details');
$CL_DetailsArr = explode(",",$CL_Details);
$viewcl_amt = $CL_DetailsArr[0];
$viewcl_bank = $CL_DetailsArr[1];
$viewcl_emi_amt = $CL_DetailsArr[2];
$viewcl_emi = $CL_DetailsArr[3];
$BL_Details = mysql_result($viewleadsbled,0,'BL_Details');
$BL_DetailsArr = explode(",",$BL_Details);
$viewbl_amt = $BL_DetailsArr[0];
$viewbl_bank = $BL_DetailsArr[1];
$viewbl_emi_amt = $BL_DetailsArr[2];
$viewbl_emi = $BL_DetailsArr[3];
$LAP_Details = mysql_result($viewleadsbled,0,'LAP_Details');
$LAP_DetailsArr = explode(",",$LAP_Details);
$viewlap_amt = $LAP_DetailsArr[0];
$viewlap_bank = $LAP_DetailsArr[1];
$viewlap_emi_amt = $LAP_DetailsArr[2];
$viewlap_emi = $LAP_DetailsArr[3];
$CC_Details = mysql_result($viewleadsbled,0,'CC_Details');
$CC_DetailsArr = explode(",",$CC_Details);
$viewcc_amt = $CC_DetailsArr[0];
$viewcc_bank = $CC_DetailsArr[1];
$viewcc_emi_amt = $CC_DetailsArr[2];
$viewcc_emi = $LAP_DetailsArr[3];
$viewITR_Details = mysql_result($viewleadsbled,0,'ITR_Details');


$residence_address = mysql_result($viewleadsbled,0,'residence_address');
$office_address = mysql_result($viewleadsbled,0,'office_address');
$IncorporationDate = mysql_result($viewleadsbled,0,'IncorporationDate');
$Property_Type = mysql_result($viewleadsbled,0,'Property_Type');
$vat = mysql_result($viewleadsbled,0,'vat');
$map_available = mysql_result($viewleadsbled,0,'map_available');
$Property_Size = mysql_result($viewleadsbled,0,'Property_Size');
$Pancard = mysql_result($viewleadsbled,0,'Pancard');
$Company_Type = mysql_result($viewleadsbled,0,'Company_Type');
$allocated_to_banks = mysql_result($viewleadsbled,0,'allocated_to_banks');
$Holding_Current_Account = mysql_result($viewleadsbled,0,'Holding_Current_Account');

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
<form name="loan_form" method="post" action="<? echo $_SERVER['PHP_SELF'] ?>?id=<? echo $post; ?>&Bid=<? echo $bidid;?>" >
<input type="hidden" name="BidderId" value="<? echo $bidid;?>">
<input type="hidden" name="plrequestid" id="plrequestid" value="<? echo $post;?>">
  <table cellspacing="2" cellpadding="0" width="100%" align="center" border="0" >
      <tr>
      <td colspan="4" align="center" bgcolor="#F0F0F0" class="heading" style="border-top:1px solid #CCC; border-bottom:1px solid #CCC;"><strong>Personal Details</strong></td>
    </tr>
    <tr>
      <td width="170" valign="top"> <strong>Name</strong></td>
      <td  width="286" align="left" valign="top"><input name="plname" type="text" class="inputsms" id="plname" value="<?echo $Name;?>"></td>
      <td  width="205" valign="top"><strong>Email id</strong></td>
      <td  width="279"><input name="plemail" type="text" class="inputsms" id="plemail" value="<?echo $Email;?>"></td>
    </tr>
     <tr>
      <td valign="top" bgcolor="#F0F0F0" ><strong>DOB</strong></td>
      <td align="left" valign="top" bgcolor="#F0F0F0" ><input name="pldob" type="text" class="inputsms" id="pldob" value="<? echo $DOB;?>"size="10" style=" width:90%; " > <a href="javascript:NewCal('pldob','yyyymmdd',false,24)"><img src="../images/cal.gif" width="16" height="16" border="0" alt="Pick a date"></a></td>
      <td valign="top" bgcolor="#F0F0F0" ><strong>Mobile</strong></td>
      <td bgcolor="#F0F0F0" >+91
        <input type="hidden" name="plmobile" size="15" value="<? echo $Mobile;?>"> <?php echo ccMasking($Mobile); ?></td>
    </tr>
    <tr>
      <td valign="top" ><strong>City</strong></td>
      <td align="left" valign="top" ><select name="plcity" size="1" class="inputsms" id="plcity" style="height:28px;">
          <?=plgetCityList($City)?>
        </select></td>
      <td valign="top" ><strong>Other City</strong></td>
      <td ><input name="plcity_other" type="text" class="inputsms" id="plcity_other" value="<?echo $City_Other;?>" size="10" ></td>
    </tr>
   <tr>
      <td valign="top" bgcolor="#F0F0F0" ><strong>Residence Address</strong></td>
      <td align="left" valign="top" bgcolor="#F0F0F0" ><input type="text" class="inputsms" name="residence_address" value="<?echo $residence_address;?>"></td>
      <td bgcolor="#F0F0F0" ><strong>Office Address</strong></td>
      <td align="left" valign="top" bgcolor="#F0F0F0" ><input type="text" class="inputsms" name="office_address" value="<?echo $office_address;?>"></td>
    </tr>
 
    <tr>
      <td valign="top" bgcolor="#F0F0F0" ><strong>Residence Number</strong></td>
      <td align="left" valign="top" bgcolor="#F0F0F0" ><input type="text" name="lapstd_code" size="1" value="<? echo $Std_Code;?>" >-<input type="text" name="laplandline" size="8" value="<?echo $Landline;?>"></td>
      <td bgcolor="#F0F0F0" ><strong>Office No.</strong></td>
      <td bgcolor="#F0F0F0"><input type="text" name="lapstd_code_o"  size="1" value="<? echo $Std_Code_O; ?>" >-<input type="text" name="laplandline_o" size="9" value="<? echo $Landline_O;?>"></td>
 
   </tr>
    <tr>
      <td valign="top" bgcolor="#F0F0F0" ><strong>Pincode</strong></td>
      <td align="left" valign="top" bgcolor="#F0F0F0" colspan="3" ><input type="text" name="lappincode" size="10" value="<? echo $Pincode;?>" ></td>
    </tr>
     <tr>
      <td colspan="4" align="center" bgcolor="#F0F0F0" class="heading" style="border-top:1px solid #CCC; border-bottom:1px solid #CCC;"><strong>Employment Details</strong></td>
    </tr>
    <tr>
      <td valign="top"><strong>Employment Status</strong></td>
      <td align="left" valign="top" ><?php //echo $viewEmp_Status; ?><select class="inputsms" name="plemployment_status" id="plemployment_status" style="height:28px;" on onChange="getProfDetails();">
          <option value="1" <? if($Employment_Status ==1) {echo "selected"; }?>>Salaried</option>
          <option value="0" <? if($Employment_Status ==0 && strlen($viewEmp_Status)<=0) {echo "selected"; }?>>Self Employed</option>
          <option value="SEP" <?php if($viewEmp_Status=='SEP') echo "selected"; ?>>Self Employed Professional</option>
      	  <option value="SEM" <?php if($viewEmp_Status=='SEM') echo "selected"; ?>>Self Employed (Manufacturer)</option>
      	  <option value="SET" <?php if($viewEmp_Status=='SET') echo "selected"; ?>>Self Employed (Trader)</option>
      	  <option value="SES" <?php if($viewEmp_Status=='SES') echo "selected"; ?>>Self Employed (Services)</option>      	  					
          <option value="SENP" <?php if($viewEmp_Status=='SENP') echo "selected" ; ?>>Self Employed Non Professional</option>         
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
      <td valign="top" bgcolor="#F0F0F0" id="pDetails"><strong>Incorporation Date</strong></td>
      <td align="left" valign="top" bgcolor="#F0F0F0">
  <input type="Text"  name="IncorporationDate" id="IncorporationDate" class="inputsms" maxlength="25" size="15" <?php if($IncorporationDate !='0000-00-00 00:00:00') { ?>value="<?php  echo $IncorporationDate; ?>" <?php } ?>  style=" width:90%; " >
        <a href="javascript:NewCal('IncorporationDate','yyyymmdd',true,24)"><img src="../images/cal.gif" width="16" height="16" border="0" alt="Pick a date"></a>     </td>
      <td valign="top" bgcolor="#F0F0F0"><strong>Annual Turnover</strong></td>
      <td bgcolor="#F0F0F0">
	   <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="45%"><input type="radio" name="Annual_Turnover" id="Annual_Turnover1" value="1" class="css-checkbox" onClick="validateDiv('AnnualTurnoverVal')" <? if($Annual_Turnover==1) { echo "checked"; } ?> />
            <label for="Annual_Turnover1" class="css-label radGroup2">0-25 lacs </label><br>
            <input type="radio" name="Annual_Turnover" id="Annual_Turnover2" value="2" class="css-checkbox" onClick="validateDiv('AnnualTurnoverVal')" <? if($Annual_Turnover==2) { echo "checked"; } ?>/>
	<label for="Annual_Turnover2" class="css-label radGroup2">50 Lacs-1 Cr</label><br> 
</td>
    <td width="55%"><input type="radio" name="Annual_Turnover" id="Annual_Turnover3" value="3" class="css-checkbox" onClick="validateDiv('AnnualTurnoverVal')" <? if($Annual_Turnover==3) { echo "checked"; } ?> />
            <label for="Annual_Turnover3" class="css-label radGroup2" >25-50 Lacs</label><br>
            <input type="radio" name="Annual_Turnover" id="Annual_Turnover4" value="4" class="css-checkbox" onClick="validateDiv('AnnualTurnoverVal')" <? if($Annual_Turnover==4) { echo "checked"; } ?>/> 
	1 Cr and above</td>
  </tr>
  
</table>
       </td>
    </tr>
    
    <tr>
      <td valign="top" ><strong>Vintage of Property</strong></td>
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
		  	<option value="12" <? if($Company_Type==12) {echo "selected";} ?>>Individual</option>
			<option value="8" <? if($Company_Type==8) {echo "selected";} ?>>Partnership</option>
			<option value="11" <? if($Company_Type==11) {echo "selected";} ?>>CIN</option>
		<option value="7" <? if($Company_Type==7) {echo "selected";} ?>>SP </option>
			</select></td>
          <td width="21%"  ><strong>Urgency  of loan</strong></td>
          <td width="24%"  ><select name="Urgency_Loan" style="height:28px; width:250px;"><option value="">Select</option><option value="1" <?php if($viewUrgency_Loan==1) { echo "selected"; } ?>>3-5 working days</option><option value="2" <?php if($viewUrgency_Loan==2) { echo "selected"; } ?>>5-7 working days</option><option value="3" <?php if($viewUrgency_Loan==3) { echo "selected"; } ?>>>7 working days</option></select></td>
      </tr>
        <tr>
          <td width="25%"  ><strong>Holding Current Account</strong></td>
          <td width="30%"  >  <input type="radio" name="Holding_Current_Account" id="Holding_Current_Account1" value="1" class="css-checkbox"  <? if($Holding_Current_Account==1) { echo "checked"; } ?>  />            <label for="Holding_Current_Account1" class="css-label radGroup2">Yes</label>            <input type="radio"name="Holding_Current_Account" id="Holding_Current_Account2" value="0" class="css-checkbox"  <? if($Holding_Current_Account==0) { echo "checked"; } ?> />            <label for="Holding_Current_Account2" class="css-label radGroup2">No </label>    </td>
          <td width="21%"  ><strong>Pancard</strong></td>
          <td width="24%"  ><input type="text" class="d4l-input" name="panno" id="panno"  class="inputsms" value="<? echo $Pancard ;?>"  maxlength="10"/></td>
      </tr>
      
       <tr>
          <td width="25%"  ><strong>VAT/TIN</strong></td>
          <td width="30%"  > <input type="text" class="d4l-input" name="vat" id="vat" value="<? echo $vat; ?>" />  </td>
          <td width="21%"  ><strong>Type of Property</strong></td>
          <td width="24%"  ><select name="Property_Type" id="Property_Type" style="width: 190px;">
		  <option value="0" <? if($Property_Type==0) {echo "selected";} ?>>Please Select</option>
		  <option value="SORP" <? if($Property_Type=="SORP") {echo "selected";} ?>>SORP</option>
		  <option value="SOCP" <? if($Property_Type=="SOCP") {echo "selected";} ?>>SOCP</option>
		  <option value="SOIP" <? if($Property_Type=="SOIP") {echo "selected";} ?>>SOIP</option>
		  <option value="Vacant" <? if($Property_Type=="Vacant") {echo "selected";} ?>>Vacant</option>
		  <option value="CPIP" <? if($Property_Type=="CPIP") {echo "selected";} ?>>CPIP</option>
		  <option value="Agricultural" <? if($Property_Type=="Agricultural") {echo "selected";} ?>>Agricultural Land</option>
			</select></td>
      </tr>
   <tr>
          <td width="25%"  ><strong>Map Available</strong></td>
          <td width="30%"  > <input type="radio" name="map_available" id="map_available1" value="1" class="css-checkbox"  <? if($map_available==1) { echo "checked"; } ?> />
            <label for="map_available1" class="css-label radGroup2">Yes</label>
            &nbsp;&nbsp;<input type="radio" name="map_available" id="map_available2" value="0" class="css-checkbox" <? if($map_available==0) { echo "checked"; } ?> />
            <label for="map_available2" class="css-label radGroup2">No</label>  </td>
          <td width="21%"  ><strong>Size of Property</strong></td>
          <td width="24%"  ><select name="Property_Size" id="Property_Size" style="width: 190px;">
		  <option value="0" <? if($Property_Size==0) {echo "selected";} ?>>Please Select</option>
		  <option value="1" <? if($Property_Size=="1") {echo "selected";} ?>>0-150 Sq. Ft.</option>
		  <option value="2" <? if($Property_Size=="2") {echo "selected";} ?>>150-500 Sq. Ft.</option>
		  <option value="3" <? if($Property_Size=="3") {echo "selected";} ?>>500-Above Sq. Ft.</option>		  		  
			</select></td>
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
<tr><td colspan="4">&nbsp;</td></tr>
    <tr>
      <td valign="top" bgcolor="#F0F0F0" ><strong>Loan Amount Required</strong></td>
      <td valign="top" bgcolor="#F0F0F0" ><input name="plloan_amount" type="text" class="inputsms" id="plloan_amount" onBlur="getDigitToWords('plloan_amount','formatedloan','wordloan');" onKeyPress="getDigitToWords('plloan_amount','formatedloan','wordloan');"  onKeyUp="getDigitToWords('plloan_amount','formatedloan','wordloan');" value="<?echo $Loan_Amount;?>"></td>
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
	$getFedbackQuery = ExecQuery("select FeedbackID, Feedback from Req_Feedback_LAP where AllRequestID='".$post."' and BidderID=''".$bidid."'");
	$num_rows = mysql_num_rows($getFedbackQuery);
		if($num_rows > 0)
		{
			echo $Feedback3621 = mysql_result($getFedbackQuery,0,'Feedback');
			$originalFeedback = $Feedback_c;
	echo "<br>";
			$followup_date3621 = mysql_result($getFedbackQuery,0,'Followup_Date');
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
      <td  align="center">Banks</td>      <td  align="center"><input type="text" class="d4l-input" name="allocated_to_banks" id="allocated_to_banks"  class="inputsms" value="<? echo $allocated_to_banks; ?>"  maxlength="10"/></td>
    </tr>
    <tr><td colspan="4" align="center"><input type="submit" class="submit-sms" value="Submit"></td></tr>
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
        <form method="POST" action="/lapeditlead_agents_continue.php" name="sendform_<? echo  $FinalBidder[$i];?>" target="_blank">
		<input type="hidden" name="callerid" id="callerid" value="<? echo $bidid;?>">
		<input type="hidden" name="reqcity" id="reqcity" value="<? echo $City;?>">
		<input type="hidden" name="plrequestid" id="plrequestid" value="<? echo $post;?>">
		<input type='hidden' value='<?php echo $plsmsld["Mobile_no"]; ?>' name='Bidder_Number' id='Bidder_Number'>
       <?php
	   	  $GetBank_Sql = "select leadlogid from zexternal_leadallocation_log where (BidderID  = ".$FinalBidder[$i]." and RequestID=".$post." and ProductID=1)";
	$GetBank_Query = ExecQuery($GetBank_Sql);
	$GetBankRows =  mysql_fetch_array($GetBank_Query);
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
        <tr>  <td bgcolor="#DAEAF9" colspan="2"></td><td width="27%" bgcolor="#DAEAF9"><strong>Select Date</strong></td><td width="15%" bgcolor="#DAEAF9"><strong>Select Time Slab</strong></td></tr>
        <tr>  <td bgcolor="#FFFFFF" colspan="2"></td>
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
           <tr><td colspan="1" style="width: 120px" ><b>Address -  </b></td><td colspan="3" align="left" ><textarea rows="3" cols="125" name="Address" id="Address" onChange="NosplcharComment(this);"><?php echo $Address; ?></textarea></td></tr>
         <tr><td colspan="4" bgcolor="#DAEAF9"  ><b>Documents for <?php echo $finalBidderName[$i]; ?> </b></td></tr>
<tr>
	<td class="fontstyle" style="width: 120px"><b>Property Documents:</b></td>
	<td class="fontstyle" colspan="3">    
    <select name="PassSizePhoto" id="PassSizePhoto" style="width:670px;">
    <option value="">Please Select</option>
   <?php
		$GetDocs_Sql = "select * from zexternal_lap_documents where (Parent_Key =3  and Status=1)";
		$GetDocs_Query = ExecQuery($GetDocs_Sql);
		$GetDocsNumRows = mysql_num_rows($GetDocs_Query);
		for($i=0;$i<$GetDocsNumRows;$i++)
		{
			$docs_id = mysql_result($GetDocs_Query,$i,'docs_id');
			$Name_Caption = mysql_result($GetDocs_Query,$i,'Name_Caption');
			?>
			<option value="<?php echo $docs_id; ?>"><?php echo $Name_Caption; ?> </option>
			<?php
		}
		?>
       </select>
	</td>
	</tr>
	<tr></tr>
	<tr>
	<td class="fontstyle" style="width: 120px"><b>KYC Documents</b></td>
	<td class="fontstyle" colspan="3">
    <select name="BankStmnt[]" id="BankStmnt" style="width:790px;" multiple>
    <option value="">Please Select</option>
    <?php
		$GetDocs_Sql = "select * from zexternal_lap_documents where (Parent_Key =1  and Status=1)";
		$GetDocs_Query = ExecQuery($GetDocs_Sql);
		$GetDocsNumRows = mysql_num_rows($GetDocs_Query);
		for($i=0;$i<$GetDocsNumRows;$i++)
		{
			$docs_id = mysql_result($GetDocs_Query,$i,'docs_id');
			$Name_Caption = mysql_result($GetDocs_Query,$i,'Name_Caption');
			?>
			<option value="<?php echo $docs_id; ?>" <?php if(trim($docs)=="1") {echo "Selected";} ?>><?php echo $Name_Caption; ?> </option>
			<?php
		}
		?>
      </select></td>
</tr>
<tr>
	<td class="fontstyle" style="width: 120px"><b>Financial Documents</b></td>
	<td colspan="3"> <select name="SalSlip[]" id="SalSlip" style="width:790px;" multiple>
    <option value="">Please Select</option>
    <?php
		$GetDocs_Sql = "select * from zexternal_lap_documents where (Parent_Key =2  and Status=1)";
		$GetDocs_Query = ExecQuery($GetDocs_Sql);
		$GetDocsNumRows = mysql_num_rows($GetDocs_Query);
		for($i=0;$i<$GetDocsNumRows;$i++)
		{
			$docs_id = mysql_result($GetDocs_Query,$i,'docs_id');
			$Name_Caption = mysql_result($GetDocs_Query,$i,'Name_Caption');
			?>
			<option value="<?php echo $docs_id; ?>" <?php if(trim($docs)=="1") {echo "Selected";} ?>><?php echo $Name_Caption; ?> </option>
			<?php
		}
		?>
    </select>
	</td>
  </tr>
  <tr><td colspan="3" align="left" class="fontstyle"><input type="checkbox" value="1" name="reschedule" id="reschedule" /> Re-Schedule</td><td align="right"><input type="submit" name="submit_appdt" value="Save" style="background-color:#036; color:#fff; font-size:17px;"></td></tr> 
       </table></td></tr>
        <tr>
          <td colspan="4">
          <table width="100%" style="border:#00F groove 1px;">
          <tr>
          <td colspan="4">
      <?php
	    $getApptDetailsSql = "select * from zexternal_appointment_docs where RequestID='".$post."' and Reply_Type=5  ";
		//echo "<br>";
		$getApptDetailsQry = ExecQuery($getApptDetailsSql);
		$getApptDetailsresCount = mysql_num_rows($getApptDetailsQry);
		//echo $getApptDetailsresCount;
		
		$DocsArr = '';
		if($getApptDetailsresCount>0)
		{
		$DocsArr = '';
		$DocsArrList = '';
		$DocsArrStatus = '';
		$j=0;
		
		while($rowApptDetails = mysql_fetch_object($getApptDetailsQry))			
	   	{
			
			$DocsArr = '';
			$DocsArrList = '';
			$DocsArrStatus = '';
			
		//	if(strlen($rowApptDetails->IDProof)>0) { $DocsArr[] =$rowApptDetails->IDProof; }
		//	if(strlen($rowApptDetails->AddressProof)>0) { $DocsArr[] =$rowApptDetails->AddressProof; }
		//	if(strlen($rowApptDetails->PanCard)>0) { $DocsArr[] =$rowApptDetails->PanCard; }
			if(strlen($rowApptDetails->SalSlip)>0) {
				
				$arrSalSlip = explode(',', $rowApptDetails->SalSlip);
				$arrSS = '';
				for($arrSCnt=0;$arrSCnt<count($arrSalSlip);$arrSCnt++)
				{
					$arrSS[]=$arrSalSlip[$arrSCnt];
				}
				 $DocsArr[] = implode(', ', $arrSS);
				
			}
			if(strlen($rowApptDetails->BankStmnt)>0) {
				$arrBankStmnt = explode(',', $rowApptDetails->BankStmnt);
				$arrBS = '';
				for($arrS=0;$arrS<count($arrBankStmnt);$arrS++)
				{
					$arrBS[]=$arrBankStmnt[$arrS];
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
			$getApptDetailsQry = ExecQuery($getFEDetailsSql);
			$getFEresCount = mysql_num_rows($getFEDetailsSql);
			if($getFEresCount>0)
			{

				$getApptDetailsRows = mysql_fetch_object($getApptDetailsQry);
				$FE_Name = $getApptDetailsRows->FE_Name;
				$FE_Mobile = $getApptDetailsRows->FE_Mobile;
			}
			
	   ?>
     <table width="100%" cellspacing="4" cellpadding="2" style="border:#000 1px solid;" >
<tr>  <td bgcolor="#003399" colspan="2" align="left"><strong style="color:#FFF;"><?php if($j==0) { echo "Appointment - "; } else { echo "Re-scheduled on ".$rowApptDetails->updated_date ; } ?>
</strong></td><td colspan="2" align="right" bgcolor="#003399"><?php if($rowApptDetails->viewstatus==1) {?><a href="/editappointmentslap.php?id=<?php echo $rowApptDetails->id; ?>" target="_blank" style="color:#FFF; font-weight:bold;">EDIT</a> <?php } ?></td></tr>
        <tr>  <td bgcolor="#DAEAF9" colspan="2"><strong>Address</strong></td><td width="27%" bgcolor="#DAEAF9"><strong>Select Date</strong></td><td width="15%" bgcolor="#DAEAF9"><strong>Select Time Slab</strong></td></tr>
        <tr>  <td bgcolor="#FFFFFF" colspan="2"><?php echo $rowApptDetails->Address; ?></td>
          <td bgcolor="#FFFFFF" valign="top"><?php echo $rowApptDetails->appt_date; ?></td>
          <td bgcolor="#FFFFFF" valign="top"><?php echo $rowApptDetails->appt_time; ?></td>
        </tr>
         <tr><td colspan="4" bgcolor="#DAEAF9"  ><b>Documents - <br><?php $getDocsValue = implode(' , ', $DocsArr);
		$getDocsSql = "select * from zexternal_lap_documents where (docs_id in (".$getDocsValue."))";
		$getDocsQuery = ExecQuery($getDocsSql);
		$getDocsNumRows = mysql_num_rows($getDocsQuery);
		$NameCaption = '';
		for($ii=0;$ii<$getDocsNumRows;$ii++)
		{
			$Name_Caption = mysql_result($getDocsQuery,$ii,'Name_Caption');	
			$NameCaption[] = $Name_Caption;
			echo $Name_Caption."<hr>";

		}
		//echo  implode(' , ', $NameCaption);

		 ?> </b></td></tr>
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