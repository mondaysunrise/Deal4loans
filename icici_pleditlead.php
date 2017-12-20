<?php
require 'scripts/session_check_onlinelms.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';
require 'scripts/icicifunction.php';
require 'scripts/personal_loan_bt_eligibility.php';

	session_start();
	$post=$_REQUEST['id'];
$min_date =$_REQUEST['to'];
$max_date=$_REQUEST['from'];
	$bidid =$_REQUEST['Bid'];

function DetermineAgeGETDOB ($YYYYMMDD_In)
{
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
  } elseif ($mdiff==0)
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
		$iciciapproved = $_SESSION['iciciapproved'];
		$plrequestid= $_POST['plrequestid'];
		$reg_year=$_POST['reg_year'];
		$plname =$_POST['plname'];
		$plemail = $_POST["plemail"];
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
		$plcc_holder = $_POST["plcc_holder"];
		$Loan_Any = $_POST["Loan_Any"];
		$emi_amt = $_POST["emi_amt"];
		$plcompany_name = $_POST["plcompany_name"];
		$plemi_paid = $_POST["plemi_paid"];
		$plpincode = $_POST["plpincode"];
		$pldob=$_POST['pldob'];
		$plloan_amount = $_POST["plloan_amount"];
		$plcity = $_POST["plcity"];
		$plcity_other = $_POST["plcity_other"];
		$plfeedback = $_POST["plfeedback"];
		$FollowupDate = $_POST["FollowupDate"];
		$plCompany_Type = $_REQUEST['plCompany_Type'];
		$Bidder_Id = $_REQUEST['BidderId'];
		$pladd_comment= $_REQUEST['pladd_comment'];
		$Primary_Acc= $_REQUEST['Primary_Acc'];
		$acc_no = $_REQUEST["acc_no"];
		$Annual_Turnover = $_REQUEST["Annual_Turnover"];
		$pl_Existing_Bank = $_REQUEST["pl_Existing_Bank"];
		$pl_Existing_Loan = $_REQUEST["pl_Existing_Loan"];
		$pl_Existing_ROI = $_REQUEST["pl_Existing_ROI"];
		$NoofEMIpaid = $_REQUEST["NoofEMIpaid"];
		$Residence_Address  = $_REQUEST["Residence_Address"];
		$appointment_date  = $_REQUEST["appointment_date"];
		$appointment_time  = $_REQUEST["appointment_time"];
		$appointment_place  = $_REQUEST["appointment_place"];
		$appointment_address = $_REQUEST["appointment_address"];
		$identification_prooforg = $_REQUEST["identification_proof"];
		$alternateidentification_proof = $_REQUEST["alternateidentification_proof"];
		if(strlen($alternateidentification_proof)>1 && $identification_prooforg=="")
		{
			$identification_proof=$alternateidentification_proof;
		}
		else
		{
			$identification_proof=$identification_prooforg;
		}
		$salary_prooforg = $_REQUEST["salary_proof"];
		$alternatesalary_proof = $_REQUEST["alternatesalary_proof"];
		if(strlen($alternatesalary_proof)>1 && $salary_prooforg=="")
		{
			$salary_proof=$alternatesalary_proof;
		}
		else
		{
			$salary_proof=$salary_prooforg;
		}
		$experience_proof = $_REQUEST["experience_proof"];
		$bankstat_proof = $_REQUEST["bankstat_proof"];
		$cuurentadd_prooforg = $_REQUEST["cuurentadd_proof"];
		$alternatecuurentadd_proof = $_REQUEST["alternatecuurentadd_proof"];
		if(strlen($alternatecuurentadd_proof)>1 && $cuurentadd_prooforg==0)
		{
			$cuurentadd_proof=$alternatecuurentadd_proof;
		}
		else
		{
			$cuurentadd_proof=$cuurentadd_prooforg;
		}
		
$nn = count($Loan_Any);
			 $ii  = 0;
			while ($ii < $nn)
			{
			  $Loan_A .= "$Loan_Any[$ii], ";
			 $ii++;
			 }
if($appointment_date!='0000-00-00' && $appointment_date!='' && strlen($appointment_time)>0 && strlen($appointment_place)>1 && $iciciapproved==0)
	{
		 $appointquery ="Update icici_pl_cibili_check set appointment_date='".$appointment_date."',appointment_time='".$appointment_time."', appointment_place='".$appointment_place."', appointment_address= '".$appointment_address."',documents='".$completedocumentsstr."' Where  icicirequestID=".$post;
			$appointqueryresult = ExecQuery($appointquery);
		if($plfeedback=="Send Now")
		{
			$approved=1;
		}
	}			
	if(strlen($plrequestid)>0)
	{
		if($iciciapproved==1)
		{
			$updatelead="Update  ICICI_Allocated_Leads set  cuurentadd_proof='$cuurentadd_proof',Existing_Noofemi='$NoofEMIpaid',identification_proof = '$identification_proof', salary_proof='$salary_proof',experience_proof='$experience_proof', bankstat_proof='$bankstat_proof',Annual_Turnover='$Annual_Turnover',Company_Type='$plCompany_Type',PL_Tenure= '$acc_no',Name='$plname',PL_EMI_Amt='$emi_amt',Company_Name='$plcompany_name', DOB='$pldob', Residential_Status='$plresidential_status',Email='$plemail', City='$plcity', Card_Limit='$plcard_limit', City_Other='$plcity_other', Mobile_Number='$plmobile', Std_Code='$plstd_code', Landline='$pllandline',  Net_Salary='$plnet_salary', Loan_Amount='$plloan_amount', Pincode='$plpincode', Employment_Status='$plemployment_status', CC_Holder='$plcc_holder', Card_Vintage='$plcard_vintage', Total_Experience='$pltotal_experience', Years_In_company='$plyears_in_company', Loan_Any='$Loan_A', Emi_Paid='$plemi_paid', Add_Comment='$pladd_comment', Primary_Acc='$Primary_Acc', Existing_Bank='$pl_Existing_Bank',Existing_Loan='$pl_Existing_Loan',Existing_ROI='$pl_Existing_ROI' where icicirequestID=".$post;
	$msg="Changes Saved";
		}
		else
		{
	$updatelead="Update  ICICI_Allocated_Leads set approved='".$approved."', cuurentadd_proof='$cuurentadd_proof',Existing_Noofemi='$NoofEMIpaid',identification_proof = '$identification_proof', salary_proof='$salary_proof',experience_proof='$experience_proof', bankstat_proof='$bankstat_proof',Annual_Turnover='$Annual_Turnover',Company_Type='$plCompany_Type',PL_Tenure= '$acc_no',Name='$plname',PL_EMI_Amt='$emi_amt',Company_Name='$plcompany_name', DOB='$pldob', Residential_Status='$plresidential_status',Email='$plemail', City='$plcity', Card_Limit='$plcard_limit', City_Other='$plcity_other', Mobile_Number='$plmobile', Std_Code='$plstd_code', Landline='$pllandline',  Net_Salary='$plnet_salary', Loan_Amount='$plloan_amount', Pincode='$plpincode', Employment_Status='$plemployment_status', CC_Holder='$plcc_holder', Card_Vintage='$plcard_vintage', Total_Experience='$pltotal_experience', Years_In_company='$plyears_in_company', Loan_Any='$Loan_A', Emi_Paid='$plemi_paid', Add_Comment='$pladd_comment',Dated=Now(), Primary_Acc='$Primary_Acc', Existing_Bank='$pl_Existing_Bank',Existing_Loan='$pl_Existing_Loan',Existing_ROI='$pl_Existing_ROI' where icicirequestID=".$post;
	$msg="Changes Saved";
		}
	}
	//echo $updatelead."<br>";
	 $updateleadresult=ExecQuery($updatelead);

	 $calllog=ExecQuery("INSERT INTO icicipl_callLOG (icicirequestID, TelecallerID, icici_feedback, calldated) VALUES ('".$plrequestid."', '".$bidid."', '".$plfeedback."', Now())");

	 if(strlen($plfeedback)>0)
	{
		$strSQLst="";
		$Msg="";
		$resultst = ExecQuery("select iciciallocateid from icicipllms_allocation where icicirequestID=$plrequestid and BidderID=".$bidid." AND product=1");		
		$num_rows = mysql_num_rows($resultst);
		if($num_rows > 0)
		{
			$row = mysql_fetch_array($resultst);
			$strSQLst="Update icicipllms_allocation Set icici_feedback='".$plfeedback."',icici_followupdate='".$FollowupDate."' ";
			$strSQLst=$strSQLst."Where iciciallocateid=".$row["iciciallocateid"];
		}
		else
		{
			$strSQLst="Insert into icicipllms_allocation(icicirequestID, BidderID, 	product , icici_feedback,icici_followupdate) Values (";
			$strSQLst=$strSQLst.$plrequestid.",'".$bidid."','1','".$plfeedback."','".$FollowupDate."')";
		}
		//echo $strSQLst;
		$resultst = ExecQuery($strSQLst);
		if ($resultst == 1)
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
<script language="javascript" type="text/javascript" src="scripts/datetime.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<script type="text/javascript" src="ajax.js"></script>
<script type="text/javascript" src="ajax-dynamic-pllist.js"></script>
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
$viewqry="select approved,cuurentadd_proof,Existing_Noofemi, bankstat_proof,salary_proof,experience_proof,identification_proof,Name,CC_Age,Add_Comment,Mobile_Number,Landline,Std_Code,Net_Salary,Residential_Status,City,City_Other,Dated,Employment_Status,Loan_Amount,Email,Loan_Any,Pincode,Emi_Paid,CC_Holder,Card_Vintage,icici_feedback,Company_Name,PL_EMI_Amt,Card_Limit,Salary_Drawn,Total_Experience,Years_In_Company,DOB,PL_Tenure,Primary_Acc,Company_Type,Annual_Turnover,PL_Bank,Existing_Bank,Existing_ROI,Existing_Loan,icici_followupdate from ICICI_Allocated_Leads LEFT OUTER JOIN icicipllms_allocation ON icicipllms_allocation.icicirequestID = ICICI_Allocated_Leads.icicirequestID and icicipllms_allocation.bidderid= '".$bidid."' where ICICI_Allocated_Leads.icicirequestID=".$post." "; 
$viewlead = ExecQuery($viewqry);
$viewleadscount =mysql_num_rows($viewlead);
$iciciapproved = mysql_result($viewlead,0,'approved');
$Name = mysql_result($viewlead,0,'Name');
$NoofEMIpaid = mysql_result($viewlead,0,'Existing_Noofemi');
$cuurentadd_proof = mysql_result($viewlead,0,'cuurentadd_proof');
$experience_proof = mysql_result($viewlead,0,'experience_proof');
$bankstat_proof = mysql_result($viewlead,0,'bankstat_proof');
$salary_proof = mysql_result($viewlead,0,'salary_proof');
$professional_details = mysql_result($viewlead,0,'CC_Age');
$Add_Comment= mysql_result($viewlead,0,'Add_Comment');
$Mobile = mysql_result($viewlead,0,'Mobile_Number');
$Landline = mysql_result($viewlead,0,'Landline');
$Std_Code = mysql_result($viewlead,0,'Std_Code');
$Net_Salary = mysql_result($viewlead,0,'Net_Salary');
$Residential_Status = mysql_result($viewlead,0,'Residential_Status');
$City = mysql_result($viewlead,0,'City');
$City_Other = mysql_result($viewlead,0,'City_Other');
$Dated = mysql_result($viewlead,0,'Dated');
$Employment_Status = mysql_result($viewlead,0,'Employment_Status');
$Loan_Amount = mysql_result($viewlead,0,'Loan_Amount');
$Email = mysql_result($viewlead,0,'Email');
$Loan_Any = mysql_result($viewlead,0,'Loan_Any');
$Pincode = mysql_result($viewlead,0,'Pincode');
$Emi_Paid = mysql_result($viewlead,0,'Emi_Paid');
$CC_Holder = mysql_result($viewlead,0,'CC_Holder');
$Card_Vintage = mysql_result($viewlead,0,'Card_Vintage');
$Feedback = mysql_result($viewlead,0,'icici_feedback');
$Company_Name = mysql_result($viewlead,0,'Company_Name');
$PL_EMI_Amt = mysql_result($viewlead,0,'PL_EMI_Amt');
$Card_Limit = mysql_result($viewlead,0,'Card_Limit');
$Salary_Drawn = mysql_result($viewlead,0,'Salary_Drawn');
$Total_Experience = mysql_result($viewlead,0,'Total_Experience');
$Years_In_Company = mysql_result($viewlead,0,'Years_In_Company');
$DOB = mysql_result($viewlead,0,'DOB');
$PL_Tenure  = mysql_result($viewlead,0,'PL_Tenure');
$Primary_Acc = mysql_result($viewlead,0,'Primary_Acc');
list($mainync,$last) = split('[.]', $Years_In_Company);
$Company_Type = mysql_result($viewlead,0,'Company_Type');
$Loan_Any = substr($Loan_Any, 0, strlen($Loan_Any)-1); 
$Annual_Turnover =  mysql_result($viewlead,0,'Annual_Turnover');
$PL_Bank = mysql_result($viewlead,0,'PL_Bank');
$Existing_Bank = @mysql_result($viewlead,0,'Existing_Bank');
$Existing_ROI = @mysql_result($viewlead,0,'Existing_ROI');
$Existing_Loan = @mysql_result($viewlead,0,'Existing_Loan');
$Followup_Date = @mysql_result($viewlead,0,'icici_followupdate');
$identification_proof = @mysql_result($viewlead,0,'identification_proof');
$monthsalary = $Net_Salary/12;
$getDOB =DetermineAgeGETDOB($DOB);
$getcompany='select icici_bank from pl_company_list where ((company_name="'.$Company_Name.'"))';
$getcompanyresult = ExecQuery($getcompany);
$grow=mysql_fetch_array($getcompanyresult);
$icici_bankcmp = $grow["icici_bank"];
$getapptqry = "select Status,PLResult,appointment_date, appointment_time,appointment_place,appointment_address,	documents from icici_pl_cibili_check where (icicirequestID ='".$post."') order by plcibilid DESC";
$getapptresult = ExecQuery($getapptqry);
$appt_dt = mysql_fetch_array($getapptresult);
$appointment_place = $appt_dt["appointment_place"];
?>
<style>
.fontstyle
	{
		font-family:Verdana Arial, Helvetica, sans-serif;
		font-size:12px;
	}
</style>
<form name="loan_form" method="post" action="<? echo $_SERVER['PHP_SELF'] ?>?id=<?echo $post;?>&Bid=<? echo $bidid;?>&to=<? echo $min_date?>&from=<? echo $max_date;?>" >
<input type="hidden" name="iciciapproved" id="iciciapproved" value="<? echo $iciciapproved; ?>">

<table style='border:1px dotted #9C9A9C;' cellspacing="2" cellpadding="5" width="600" height="80%" align="center" border="0" >
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
	<td ><b>No of EMI's Paid</b></td>
	<td ><input type="text" name="NoofEMIpaid" id="NoofEMIpaid" value="<? echo $NoofEMIpaid; ?>" maxlength="3"></td>
</tr>
<tr>
	<td style="border:1px solid black;" colspan="4" bgcolor="#DAEAF9" align="center" class="fontstyle" ><b>Personal Details</b></td></tr>
		<tr>
			<td class="fontstyle" width="150"><b> Name As Per PAN Card</b></td>
			<td class="fontstyle" width="150"><input type="text" name="plname" id="plname" value="<?echo $Name;?>"></td>
			<td class="fontstyle" width="150"><b>Email id</b></td>
			<td class="fontstyle" width="150"><input type="text" name="plemail" id="plemail" value="<?echo $Email;?>"></td>
		</tr>
		<tr>
		<td class="fontstyle"><b>DOB</b></td>
			<td class="fontstyle"><input type="text" name="pldob" id="pldob"size="15" value="<? echo $DOB;?>"> (YYYY-MM-DD)</td>
			<td class="fontstyle"><b>Mobile</b></td>
			<td class="fontstyle">+91<input type="text" name="plmobile" size="15" value="<? echo $Mobile;?>"></td>
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
	<tr>			<td class="fontstyle" colspan="2"><b>Salary Account in which bank?</b>			</td>
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
			<td colspan="4" class="fontstyle"><input type="hidden" name="plrequestid" id="plrequestid" value="<? echo $post;?>"></td>
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
			<option value="4" <? if($Company_Type==4) {echo "selected";} ?>>Govt.( Central/State )</option>
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
<td colspan="4" bgcolor="#DAEAF9" align="center" class="fontstyle" style="border:1px solid black;"><b>Eligibility Details</b></td></tr>
<tr>
<td colspan="4">
<table width="100%" border="1">
<?
list($iciciinterestrate,$icicigetloanamout,$icicigetemicalc,$iciciterm,$iciciperlacemi,$profee)=icicibank($monthsalary,$Company_Name,$icici_bankcmp,$getDOB,$Company_Type,$Primary_Acc, $Loan_Amount );
//list($icicirate,$iciciprepay_chrge,$icicipro_fee)=iciciIR($monthsalary,$grow["icici_bank"]);
if($icicigetloanamout>0 && $icicigetemicalc>0)
{
	$icicirateexact=str_replace("%","",$iciciinterestrate);
$iciciintr = trim($icicirateexact)/1200;
	?>	
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
	<? for($r=0;$r<$iciciterm;$r++)
	{
		//echo $r."<br>";
		$calculatedterm=$r+1;			
		?>
<tr> <td width="11%" height="25" align="center" valign="middle"><b style="font-size:12px;"><? echo "ICICI Bank"; ?></b></td>
<td width="11%" align="center"><b style="font-size:12px;"><? echo $icicigetloanamout; ?></b></td>
<td width="11%" align="center"><b style="font-size:12px;"><? echo $iciciinterestrate; ?></b></td>
<td width="11%" align="center"><b style="font-size:12px;"><? echo $calculatedterm; ?></b></td>
<td width="11%" align="center"><b style="font-size:12px;"><? echo $calculatedemi=round($icicigetloanamout * $iciciintr / (1 - (pow(1/(1 + $iciciintr), ($calculatedterm*12))))); ?></b></td>
<td width="11%" align="center"><b style="font-size:12px;"><? 
	echo $emicalc=round(100000 * $iciciintr / (1 - (pow(1/(1 + $iciciintr), ($calculatedterm*12)))));
			?></b></td>
<td width="11%" align="center"><b style="font-size:12px;"><? echo $grow["icici_bank"]; ?></b></td>
	<td width="11%" align="center"><b style="font-size:12px;">5%</b></td>
	<td width="11%" align="center"><b style="font-size:12px;"><? echo $profee; ?></b></td>
</tr>
<? }
}
if(strlen($Existing_ROI)>1 && $Existing_Loan>1 && $NoofEMIpaid>=12)
{
 list($iciciBTRate,$iciciBTProcessingFee)=icicibt_plnw($Existing_Loan,$Employment_Status,$Existing_ROI,$icici_bankcmp,$monthsalary);
		if($iciciBTRate>0)
			{
			$iciciputinarry= array($finalBidderName[$i],$iciciBTRate,$iciciBTProcessingFee);
			$btbiddersarry[]=$iciciputinarry;
		//echo "<input type='checkbox' value='$FinalBidder[$r]' name='Final_Bidder[$r]' id='Final_Bidder[$r]'>".$finalBidderName[$i]."(".$FinalBidder[$i].")";
		?>		
		<tr><td colspan="3">BT Details</td></tr>
		<tr> <td width="11%" height="25" align="center" valign="middle"><b style="font-size:12px;">Bank Name</b></td>
	<td width="11%" align="center"><b style="font-size:12px;">Loan Amount</b></td>
	<td width="11%" align="center"><b style="font-size:12px;">ROI</b></td>
	<td width="11%" align="center"><b style="font-size:12px;">prco. feee</b></td>
	</tr>
	<tr> <td width="11%" height="25" align="center" valign="middle"><b style="font-size:12px;">ICICI Bank</b></td>
	<td width="11%" align="center"><b style="font-size:12px;"><? echo $Existing_Loan; ?></b></td>
	<td width="11%" align="center"><b style="font-size:12px;"><? echo $iciciBTRate; ?></b></td>
	<td width="11%" align="center"><b style="font-size:12px;"><? echo $iciciBTProcessingFee; ?></b></td>
	</tr>	
		<? }
}
?>
</table>
</td><tr>
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
	<tr><td class="fontstyle">Amount of EMI Paying</td><td class="fontstyle"><input type="text" name="emi_amt" id="emi_amt" value="<? echo $PL_EMI_Amt;?>"></td><td colspan="2"></td></tr>
<tr>
<td colspan="4" bgcolor="#DAEAF9" align="center" style="border:1px solid black;"><b>TU Details </b></td></tr>
<tr>
<td>Status</td>
<td><? echo $appt_dt["Status"];?></td>
</tr>
<tr>
<td>Status Description</td>
<td colspan="3"><?
 $TUEF_ErrorResponse = $appt_dt["PLResult"];
echo $TUEF_ErrorResponse;?></td>
</tr>
<?
if($appt_dt["RuleStatus"]=='Error' || $appt_dt["RuleStatus"]=="" || $appt_dt["RuleStatus"]=='Pending' || ($appt_dt["RuleStatus"]=="Rejected" && $Employment_Status ==0))
{
?>
<tr>
<td colspan="4" align="center" style="font-size:16px; font-weight:bold; " height="40" ><a href="/icici_pllms_tu.php?reqdid=<? echo $post; ?>" target="_blank" style="background-color:#FFCC00;">Transunion Check</a></td>
</tr>
<? } ?>
<tr><td colspan="4" bgcolor="#DAEAF9" align="center" style="border:1px solid black;" ><b>Documents </b></td></tr>
<tr><td colspan="4"><input type="checkbox" name="experience_proof" id="experience_proof" value="One Colored Passport Size Photograph" <? if($experience_proof=="One Colored Passport Size Photograph") {echo "checked";}?> > 2 Photographs instead of One</td></tr>
<tr><td colspan="4">
<table>
<tr>
<td>
KYC Document&nbsp;&nbsp;
<select name="identification_proof" id="identification_proof">
 <option value="" <? if($identification_proof=="") {echo "Selected";} ?>>Please Select</option>
<option value="Passport" <? if($identification_proof=="Passport") { echo "Selected"; }?>>Passport</option>
<option value="VoterID" <? if($identification_proof=="VoterID") { echo "Selected"; }?>>Voter ID</option>
<option value="DrivingLicense" <? if($identification_proof=="DrivingLicense") { echo "Selected"; }?>>Driving License</option>
<option value="AadharCard" <? if($identification_proof=="AadharCard") { echo "Selected"; }?>>Aadhar Card</option>
<option value="PANCard" <? if($identification_proof=="PANCard") { echo "Selected"; }?>>PAN Card</option>
</select></td>
<td>Alternate Proof for Identity <input type="text" name="alternateidentification_proof" id="alternateidentification_proof" value="<? echo $identification_proof; ?>"></td>
</tr></table>
 </td></tr>
 <tr><td colspan="4">
 <table width="100%">
 <tr>
 <td>
 <input type="radio" name="salary_proof" id="salary_proof" value="3 Months Salary Slip" <? if($salary_proof=="3 Months Salary Slip") {echo "checked";}?>> 3 Months Salary Slip  <br> or<br>  
 <input type="radio" name="salary_proof" id="salary_proof" value="Salary Certificate" <? if($salary_proof=="Salary Certificate") {echo "checked";}?>>Salary Certificate(Original With Sign & Stamp)</td><td>Alternate Proof for Salary <input type="text" name="alternatesalary_proof" id="alternatesalary_proof" value="<? echo $salary_proof; ?>"></td></tr></table></td></tr>
 <tr><td colspan="4">
 <table>
 <tr>
 <td>
 Current Address Proof (If address not Same as in KYC Dox) <br>
 <select name="cuurentadd_proof" id="cuurentadd_proof">
 <option value="0" <? if($cuurentadd_proof=="0") {echo "Selected";} ?>>Please Select</option>
 <option value="1" <? if($cuurentadd_proof=="1") {echo "Selected";} ?>>Water Bill</option>
 <option value="2" <? if($cuurentadd_proof=="2") {echo "Selected";} ?>>Electricity Bill</option>
 <option value="3" <? if($cuurentadd_proof=="3") {echo "Selected";} ?>>LL/Postpaid Phone (Not Broadband) Bill</option>
 <option value="4" <? if($cuurentadd_proof=="4") {echo "Selected";} ?>>House Tax Receipt</option>
 <option value="5" <? if($cuurentadd_proof=="5") {echo "Selected";} ?>>Gas Bill</option>
 <option value="6" <? if($cuurentadd_proof=="6") {echo "Selected";} ?>>Property Ownership Proof</option>
 </select> 
 </td><td>Alternate Proof for Address <input type="text" name="alternatecuurentadd_proof" id="alternatecuurentadd_proof" value="<? echo $cuurentadd_proof; ?>"></td></tr></table>
 </td></tr>
 <tr><td colspan="4"><input type="radio" name="bankstat_proof" id="bankstat_proof" value="3 Months Bank Statement" <? if($bankstat_proof=="3 Months Bank Statement") {echo "checked";}?>>3 Months Bank Statement or <input type="radio" name="bankstat_proof" id="bankstat_proof" value="ICICI Account Holder" <? if($bankstat_proof=="ICICI Account Holder") {echo "checked";}?>>ICICI Account Holder (For ICICI A/C Holders)</td></tr> 
 <tr><td colspan="4" bgcolor="#DAEAF9" align="center" style="border:1px solid black;" ><b>Appointment Details </b></td></tr>
<tr><td>Appointment Date</td><td><input type="Text"  name="appointment_date" id="appointment_date" maxlength="25" size="15" <?php if($appt_dt["appointment_date"] !='0000-00-00') { ?>value="<?php  echo $appt_dt["appointment_date"]; ?>" <?php } ?>><a href="javascript:NewCal('appointment_date','yyyymmdd',false,24)"><img src="images/cal.gif" width="16" height="16" border="0" alt="Pick a date"></a></td><td>Appointment Time</td><td><select name="appointment_time" id="appointment_time" tabindex="14">
	<option value="please select">Time slab</option>
<option value="Call Before coming" <? if($appointment_time=="Call Before coming") { echo "Selected"; } ?>>Call Before coming</option>			
	<option value="8(am)-9(am)" <? if($appointment_time=="8(am)-9(am)") { echo "Selected"; } ?>>8(am)-9(am)</option>
	<option value="9(am)-10(am)" <? if($appointment_time=="9(am)-10(am)") { echo "Selected"; } ?>>9(am)-10(am)</option>
	<option value="10(am)-11(am)" <? if($appointment_time=="10(am)-11(am)") { echo "Selected"; } ?>>10(am)-11(am)</option>
	<option value="11(am)-12(am)" <? if($appointment_time=="11(am)-12(am)") { echo "Selected"; } ?>>11(am)-12(am)</option>
	<option value="12(am)-1(pm)" <? if($appointment_time=="12(am)-1(pm)") { echo "Selected"; } ?>>12(am)-1(pm)</option>
	<option value="1(pm)-2(pm)" <? if($appointment_time=="1(pm)-2(pm)") { echo "Selected"; } ?>>1(pm)-2(pm)</option>
	<option value="2(pm)-3(pm)" <? if($appointment_time=="2(pm)-3(pm)") { echo "Selected"; } ?>>2(pm)-3(pm)</option>
	<option value="3(pm)-4(pm)" <? if($appointment_time=="3(pm)-4(pm)") { echo "Selected"; } ?>>3(pm)-4(pm)</option>
	<option value="4(pm)-5(pm)" <? if($appointment_time=="4(pm)-5(pm)") { echo "Selected"; } ?>>4(pm)-5(pm)</option>
	<option value="5(pm)-6(pm)" <? if($appointment_time=="5(pm)-6(pm)") { echo "Selected"; } ?>>5(pm)-6(pm)</option>
	<option value="6(pm)-7(pm)" <? if($appointment_time=="6(pm)-7(pm)") { echo "Selected"; } ?>>6(pm)-7(pm)</option>
	<option value="7(pm)-8(pm)" <? if($appointment_time=="7(pm)-8(pm)") { echo "Selected"; } ?>>7(pm)-8(pm)</option>
							</select>	</td></tr>
 <tr><td>Appointment Place</td><td><select name="appointment_place" id="appointment_place" >
 <option>please select</option>
 <option value="Office" <? if($appointment_place=="Office") { echo "Selected";} ?>>Office</option>
 <option value="Residence" <? if($appointment_place=="Residence") { echo "Selected";} ?>>Residence</option></select>
</td><td>Appointment Address With Landmark & PIN Code</td><td><textarea rows="2" cols="20" name="appointment_address" id="appointment_address"><? echo $appointment_address; ?></textarea></td></tr>
<tr><td colspan="4" bgcolor="#DAEAF9" align="center" style="border:1px solid black;" ><b>ADD Feedback </b></td></tr>
<tr>
	<td class="fontstyle"><b>Feedback</b></td>
	<td class="fontstyle">
    <select name="plfeedback" id="feedback">
		<option value="No Feedback" <?if($Feedback == "") { echo "selected"; }?>>No Feedback</option>
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
	<option value="TU Reject" <?if($Feedback == "TU Reject") { echo "selected"; }?>>TU Reject</option>
	<option value="Documents Picked" <?if($Feedback == "Documents Picked") { echo "selected"; }?>>Documents Picked</option>
	<option value="Login" <?if($Feedback == "Login") { echo "selected"; }?>>Login</option>
	<option value="Already Applied with ICICI Bank" <?if($Feedback == "Already Applied with ICICI Bank") { echo "selected"; }?>>Already Applied with ICICI Bank</option>
	</select>
	</td>
	<td class="fontstyle"><b>Follow Up Date</b></td>
	<td class="fontstyle"><?php  echo $followup_date3621; ?><input type="Text"  name="FollowupDate" id="FollowupDate" maxlength="25" size="15" <?php if($Followup_Date !='0000-00-00 00:00:00') { ?>value="<?php  echo $Followup_Date; ?>" <?php } ?>><a href="javascript:NewCal('FollowupDate','yyyymmdd',true,24)"><img src="images/cal.gif" width="16" height="16" border="0" alt="Pick a date"></a></td>
</tr>
<tr>
		<td><b>Add Comment</b></td>
		<td><textarea rows="2" cols="20" name="pladd_comment" id="pladd_comment" ><? echo $Add_Comment; ?></textarea></td>
	</tr>
	  <tr>
     <td colspan="4" align="center"><div id="msgdisplay"><? echo $msg; ?></div>
      </td>
   </tr>
 <tr>
     <td colspan="4" align="center"><input type="submit" class="bluebutton" value="Submit"> 
      </td>
   </tr>
</table>
</form>
</body>
</html>