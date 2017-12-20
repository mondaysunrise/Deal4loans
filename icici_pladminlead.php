<?php
require 'scripts/session_check_onlinelms.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';

	session_start();
	$post=$_REQUEST['id'];
$min_date =$_REQUEST['to'];
$max_date=$_REQUEST['from'];
	$bidid =$_REQUEST['Bid'];

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		foreach($_POST as $a=>$b)
			$$a=$b;			
		/* FIX STRINGS */		
		$appointment_date  = $_REQUEST["appointment_date"];
		$appointment_time  = $_REQUEST["appointment_time"];
		$appointment_place  = $_REQUEST["appointment_place"];
		$appointment_address = $_REQUEST["appointment_address"];
		$documents = $_REQUEST["documents"];
		$kyc_document = $_REQUEST["kyc_document"];
		$pladd_comment = $_REQUEST["pladd_comment"];

	 if(strlen($plfeedback)>0)
	{		
		$strSQLst="";
		$Msg="";

		$resultst = ExecQuery("select iciciallocateid from icicipllms_allocation where icicirequestID=$plrequestid AND product=1");		
		$num_rows = mysql_num_rows($resultst);
		if($num_rows > 0)
		{
			$row = mysql_fetch_array($resultst);
			$strSQLst="Update icicipllms_allocation Set verifier_feedback ='".$plfeedback."', icici_comments='".$pladd_comment."' ";
			$strSQLst=$strSQLst."Where iciciallocateid=".$row["iciciallocateid"];
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
$viewqry="select * from ICICI_Allocated_Leads LEFT OUTER JOIN icicipllms_allocation ON icicipllms_allocation.icicirequestID = ICICI_Allocated_Leads.icicirequestID  where ICICI_Allocated_Leads.icicirequestID=".$post." "; 
$viewlead = ExecQuery($viewqry);
$viewleadscount =mysql_num_rows($viewlead);
$Name = mysql_result($viewlead,0,'Name');
$professional_details = mysql_result($viewlead,0,'CC_Age');
$Add_Comment= mysql_result($viewlead,0,'Add_Comment');
//$Mobile = mysql_result($viewlead,0,'Mobile_Number');
$Landline = mysql_result($viewlead,0,'Landline');
$Landline_O = mysql_result($viewlead,0,'Landline_O');
$Std_Code = mysql_result($viewlead,0,'Std_Code');
$Std_Code_O = mysql_result($viewlead,0,'Std_Code_O');
$Net_Salary = mysql_result($viewlead,0,'Net_Salary');
$Residential_Status = mysql_result($viewlead,0,'Residential_Status');
$City = mysql_result($viewlead,0,'City');
$City_Other = mysql_result($viewlead,0,'City_Other');
$Dated = mysql_result($viewlead,0,'Dated');
$Employment_Status = mysql_result($viewlead,0,'Employment_Status');
$Loan_Amount = mysql_result($viewlead,0,'Loan_Amount');
//$Email = mysql_result($viewlead,0,'Email');
$Loan_Any = mysql_result($viewlead,0,'Loan_Any');
$Pincode = mysql_result($viewlead,0,'Pincode');
$Emi_Paid = mysql_result($viewlead,0,'Emi_Paid');
$CC_Holder = mysql_result($viewlead,0,'CC_Holder');
$Card_Vintage = mysql_result($viewlead,0,'Card_Vintage');
$followup_date = mysql_result($viewlead,0,'Followup_Date');
$icici_feedback = mysql_result($viewlead,0,'icici_feedback');
$Feedback = mysql_result($viewlead,0,'verifier_feedback');
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
$Primary_Acc = mysql_result($viewlead,0,'Primary_Acc');
list($mainync,$last) = split('[.]', $Years_In_Company);
$Company_Type = mysql_result($viewlead,0,'Company_Type');
$Loan_Any = substr($Loan_Any, 0, strlen($Loan_Any)-1); 
$Annual_Turnover =  mysql_result($viewlead,0,'Annual_Turnover');
$PL_Bank = mysql_result($viewlead,0,'PL_Bank');
$Existing_Bank = @mysql_result($viewlead,0,'Existing_Bank');
$Existing_ROI = @mysql_result($viewlead,0,'Existing_ROI');
$Existing_Loan = @mysql_result($viewlead,0,'Existing_Loan');
$getapptqry = "select Status,PLResult,appointment_date, appointment_time,appointment_place,appointment_address,	documents from icici_pl_cibili_check where (icicirequestID ='".$post."') order by plcibilid DESC";
$getapptresult = ExecQuery($getapptqry);
$appt_dt = mysql_fetch_array($getapptresult);
$appointment_place = $appt_dt["appointment_place"];
$appointment_time = $appt_dt["appointment_time"];
$appointment_address = $appt_dt["appointment_address"];
?>
<style>
.fontstyle
	{
		font-family:Verdana Arial, Helvetica, sans-serif;
		font-size:12px;
	}
</style>
<form name="loan_form" method="post" action="<? echo $_SERVER['PHP_SELF'] ?>?id=<?echo $post;?>&Bid=<? echo $bidid;?>&to=<? echo $min_date?>&from=<? echo $max_date;?>" >
<table style='border:1px dotted #9C9A9C;' cellspacing="2" cellpadding="5" width="600" height="80%" align="center" border="0" >
<tr>
	<td style="border:1px solid black;" colspan="4" bgcolor="#DAEAF9" align="center" class="fontstyle" ><b>Balance Transfer</b></td></tr>
<tr>
	<td width="25%"><b>Existing Bank</b></td>
	<td width="25%"><?php echo $Existing_Bank; ?></td>
	<td ><b>Existing Loan </b></td>
	<td ><?php echo $Existing_Loan; ?></td>
</tr>
<tr>
	<td width="25%"><b>Existing ROI</b></td>
	<td width="25%"><?php echo $Existing_ROI; ?></td>
	<td >&nbsp;</td>
	<td >&nbsp;</td>
</tr>
<tr>
	<td style="border:1px solid black;" colspan="4" bgcolor="#DAEAF9" align="center" class="fontstyle" ><b>Personal Details</b></td></tr>
		<tr>
			<td class="fontstyle" width="150"><b> Name</b></td>
			<td class="fontstyle" width="150"><? echo $Name;?></td>
			<td class="fontstyle" width="150"><b>Email id</b></td>
			<td class="fontstyle" width="150"><? echo $Email;?></td>
		</tr>
		<tr>
		<td class="fontstyle"><b>DOB</b></td>
			<td class="fontstyle"><? echo $DOB;?></td>
			<td class="fontstyle"><b>Mobile</b></td>
			<td class="fontstyle">+91<? echo $Mobile;?></td>
			</tr>
		<tr>
			<td class="fontstyle"><b>Residence No</b></td>
			<td class="fontstyle"><? echo $Std_Code;?>-<? echo $Landline;?></td>
			<td class="fontstyle" ><b>Office No.</b></td>
			<td class="fontstyle"><? echo $Std_Code_O; ?>-<? echo $Landline_O;?></td>
		</tr>
		<tr>
			<td class="fontstyle"><b>City</b></td>
			<td class="fontstyle"><? echo  $City; ?></td>
			<td class="fontstyle"><b>Other City</b></td>
			<td class="fontstyle"><? echo $City_Other;?></td>
		</tr>
		<tr>
		<td class="fontstyle"><b>Pincode</b></td><td><? echo $Pincode;?></td>
		<td class="fontstyle"><b>Source</b></td>
		<td><? echo $source; ?></td>
		</tr>
		<tr>
			<td class="fontstyle"><b>Residence Status</b></td>
						<td colspan="2" class="fontstyle">
						<? if($Residential_Status==4){ echo "Owned By Self/Spouse";}
						elseif($Residential_Status==1){ echo "Owned By Parent/Sibling";}
						elseif($Residential_Status==3){ echo "Company Provided";} 
						elseif($Residential_Status==5){ echo "Rented - With Family";} 
						elseif($Residential_Status==6){ echo "Rented - With Friends";}
						elseif($Residential_Status==2){ echo "Rented - Staying Alone";}
						elseif($Residential_Status==7){ echo "Paying Guest";} 
						elseif($Residential_Status==8){ echo "Hostel";} ?>
			</td>
			<td>&nbsp;</td>
		</tr>	
	<tr>
			<td class="fontstyle" ><b>Salary Account in which bank?</b>			</td>
	<td><? echo $Primary_Acc; ?>Other</option></select>
</td>
	<td>&nbsp;</td></tr>
		<tr>
			<td colspan="4" class="fontstyle"><input type="hidden" name="BidderId" value="<? echo $bidid;?>"></td></tr>
		<tr>
			<td colspan="4" class="fontstyle"><input type="hidden" name="plrequestid" id="plrequestid" value="<?echo $post;?>"></td>
		</tr>
	
<tr>
		<td colspan="4" bgcolor="#DAEAF9" align="center" style="border:1px solid black;"><b>Employment Details</b></td></tr>
	<tr>
		<td class="fontstyle"><b>Employment Status</b></td>
		<td class="fontstyle"><? if($Employment_Status ==1){echo "Salaried"; }
					else if($Employment_Status ==0) {echo "Self Employed"; } ?>	
		</td>
		<td class="fontstyle"><b>Annual Income</b></td>
		<td class="fontstyle"><? echo $Net_Salary;?></td>
	</tr>
	<tr><td class="fontstyle"><b>Company Name</b></td>
	<td class="fontstyle"><? echo $Company_Name;?></td></tr>
<tr><td>Professional details</td><td><? if($professional_details=="0") { echo "Please Select";} 
elseif($professional_details=="1") { echo "Businessmen";} 
elseif($professional_details=="2") { echo "Doctor";}
elseif($professional_details=="3") { echo "Engineer";}
elseif($professional_details=="4") { echo "Architect";}
elseif($professional_details=="5") { echo "Chartered Accountant";} ?></td><td>Annual Turnover</td>
            <td><? if($Annual_Turnover==0) {echo "Please Select";}
			elseif($Annual_Turnover==1) {echo "0 - 40  lacs";} 
			elseif($Annual_Turnover==4) {echo "40Lacs -  1 Cr";} 
			elseif($Annual_Turnover==2) {echo "1Cr - 3Crs";} 
			elseif($Annual_Turnover==3) {echo "3Crs & above";} ?></td></tr>
	<tr>
<td><b>Account No</b></td>
<td><? echo $PL_Tenure; ?></td>
	<td>Company Type</td><td><? if($Company_Type==0) {echo "Please Select";} 
		  	elseif($Company_Type==1) {echo "Pvt Ltd";}            
			elseif($Company_Type==2) {echo "MNC Pvt Ltd";} 
			elseif($Company_Type==3) {echo "Limited";} 
			elseif($Company_Type==4) {echo "Govt.( Central/State )";} 
			elseif($Company_Type==5) {echo "PSU (Public sector Undertaking)";} ?>
            </td>
</tr>
	<tr>
		<td class="fontstyle"><b>Total Experience</b></td>
		<td class="fontstyle"><? echo $Total_Experience;?><b>(years)</b>
		</td>
		<td class="fontstyle"><b>Current experience in company</b></td>
		<td class="fontstyle"><? echo $Years_In_Company; ?><b>(years)</b></td>
	</tr>
<tr>
<td colspan="4" bgcolor="#DAEAF9" align="center" class="fontstyle" style="border:1px solid black;"><b>Surrogate Details</b></td></tr>
<tr>
	<td class="fontstyle"><b>Credit Card Holder </b></td>
	<td class="fontstyle"><? if($CC_Holder==1){ echo "Yes";} 
	elseif($CC_Holder==0){ echo "No";}?>
			<td class="fontstyle"><b>Credit Card Limit?</b></td>
		 <td class="fontstyle"><? echo $Card_Limit; ?>
					</td>
			   </tr>
<tr>
	<td class="fontstyle"><b>Card held since?</b></td><td class="fontstyle"><? if($Card_Vintage==0) { echo "Please select"; } 
	elseif($Card_Vintage==1) { echo "Less than 6 months"; } 
	elseif($Card_Vintage==2) { echo "6 to 9 months"; }
	elseif($Card_Vintage==3) { echo "9 to 12 months"; }
	elseif($Card_Vintage==4) { echo "more than 12 months"; } ?></td>	
	<td class="fontstyle"><b>Loan Amount Required</b></td>
	<td class="fontstyle">
    <? echo $Loan_Amount;?></td>
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
			<? if($Emi_Paid==0) { echo "Please select"; } 
			elseif($Emi_Paid==1) { echo "Less than 6 months"; } 
			elseif($Emi_Paid==2) { echo "6 to 9 months"; } 
			elseif($Emi_Paid==3) { echo "9 to 12 months"; } 
			elseif($Emi_Paid==4) { echo "more than 12 months"; } ?>
		</td>
	</tr>
	<tr><td class="fontstyle">Amount of EMI Paying</td><td class="fontstyle"><? echo $PL_EMI_Amt;?></td><td colspan="2"></td></tr>
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
<tr><td colspan="4" bgcolor="#DAEAF9" align="center" style="border:1px solid black;" ><b>Documents </b></td></tr>
 <tr><td colspan="4">KYC Document&nbsp;&nbsp;<? echo $identification_proof; ?></td></tr>
 <tr><td colspan="4">Salary Slip&nbsp;&nbsp;<? echo $salary_proof; ?></td></tr>
 <tr><td colspan="4">Experience Proof&nbsp;&nbsp;<? echo $experience_proof; ?></td></tr>
 <tr><td colspan="4">Bank Statement&nbsp;&nbsp;<? echo $bankstat_proof; ?></td></tr> 
<tr>
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
</td><td>Appointment Address</td><td><textarea rows="2" cols="20" name="appointment_address" id="appointment_address"><? echo $appointment_address; ?></textarea></td></tr>
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
	<option value="Verified" <?if($Feedback == "Verified") { echo "selected"; }?>>Verified</option>
	<option value="TU Reject" <?if($Feedback == "TU Reject") { echo "selected"; }?>>TU Reject</option>
	</select>
	<br><br><? echo $icici_feedback; ?>
	</td>
	<td class="fontstyle"><b>Follow Up Date</b></td>
	<td class="fontstyle"><?php  echo $followup_date3621; ?><input type="Text"  name="FollowupDate" id="FollowupDate" maxlength="25" size="15" <?php if($Followup_Date !='0000-00-00 00:00:00') { ?>value="<?php  echo $followup_date; ?>" <?php } ?>><a href="javascript:NewCal('FollowupDate','yyyymmdd',true,24)"><img src="images/cal.gif" width="16" height="16" border="0" alt="Pick a date"></a></td>
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