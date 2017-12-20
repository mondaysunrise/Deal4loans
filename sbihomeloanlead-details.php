<?php
$requestid = $_REQUEST["postid"];
$bidderid = $_REQUEST["biddt"];
require 'scripts/session_check_online.php';
require 'scripts/db_init.php';
//require 'scripts/db_init_wishfin.php';
require 'scripts/functions.php';

if($_POST['method'] == 'FollowUpCount'){
	//echo '<pre>';print_r($_POST);exit;
	$FollowUpCount = 0;
	$selectedFollowUpDate = $_POST['selectedFollowUpDate'];
	$bidder = $_POST['bidder'];
	$caller_name = $_POST['caller_name'];
	$getFollowUpCountSql = "SELECT COUNT(*) as FollowUpCount FROM `client_lead_allocate` WHERE `Reply_Type` = 2 AND caller_name = '".$caller_name."' AND DATE(`Followup_Date`) = '".$selectedFollowUpDate."'";
	$getFollowUpCountResult = d4l_ExecQuery($getFollowUpCountSql);
	$getFollowUpCountResponse = d4l_mysql_fetch_assoc($getFollowUpCountResult);
	//echo '<pre>';print_r($getFollowUpCountResponse);
	$FollowUpCount = $getFollowUpCountResponse['FollowUpCount'];
	
	echo $FollowUpCount;
	exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	foreach($_POST as $a=>$b)
		$$a=$b;
	$comment_section = $_POST["comment_section"];
	$ccfeedback = $_POST["sbihlfeedback"];
	$FollowupDate  = $_POST["FollowupDate"];
	$feedbackid  = $_POST["feedbackid"];
	$Updated_Date  = $_POST["updateddate"];
	$asm_id  = $_POST["asm_id"];
	$Sendsms  = $_POST["Sendsms"];
	$smstext  = $_POST["smstext"];
	$callername  = $_POST["callername"];
	$sbireverseapirun  = $_POST["sbireverseapirun"];
	$sbileadid  = $_POST["sbileadid"];
	$mobileno  = $_POST["mobileno"];
	$Dated=ExactServerdate();
	//allocate to asm
	if(strlen($ccfeedback)>0 || strlen($comment_section)>0)
	{
		$strSQL="";
		$Msg="";
		$result = d4l_ExecQuery("select `leadid`,AsmID from `client_lead_allocate` where (`AllRequestID`=".$requestid." AND `BidderID`=".$bidderid." AND Reply_Type=2)");
		//echo "select `leadid` from `client_lead_allocate` where (`AllRequestID`=".$requestid." and AsmID=".$asm_id." AND Reply_Type=2)";
		$num_rows = d4l_mysql_num_rows($result);
		$row = d4l_mysql_fetch_array($result);
		$SMSMessage="";
		if($num_rows > 0 && $row["AsmID"]>0)
		{
			if($row["AsmID"]==$asm_id)
			{
				$asmclause="";
			}
			else
			{
				$asmclause=" , AsmID='".$asm_id."'";
			}
			$strSQL="Update client_lead_allocate Set caller_name='".$callername."',Feedback='".$ccfeedback."', Comments='".$comment_section."', Followup_Date='".$FollowupDate."'".$asmclause."";
			$strSQL=$strSQL." Where leadid=".$row["leadid"];

			//sms code here
			if($Sendsms==1)
			{
				$asmqry=d4l_ExecQuery("Select mobile_no from sbihl_6168_asmlist Where (bidderid='".$asm_id."' and status=1)"); 
				while($asmrow=d4l_mysql_fetch_array($asmqry))
				{
					$asmphone=$asmrow["mobile_no"];
					$currentdate=date('d-m-Y');
					$message ="Your Home loan Leads on (".$currentdate.") : ";
					$SMSMessage=$message.$smstext;

					if(strlen(trim($asmphone)) > 0)
					SendSMSforLMS($SMSMessage, $asmphone);
				}
			}
		}
		else
		{
			// lifecycle here
			if($asm_id>0)
			{
				$asmdate=",asm_allocation_date=Now()";
			}
			else
			{
				$asmdate="";
			}
			$strSQL="Update client_lead_allocate Set caller_name='".$callername."',Feedback='".$ccfeedback."', Comments='".$comment_section."', Followup_Date='".$FollowupDate."', AsmID='".$asm_id."', smsflag='".$Sendsms."'".$asmdate."";
			$strSQL=$strSQL." Where leadid=".$row["leadid"];
		}
		//echo "asm".$strSQL."<br><br>";
		$result = d4l_ExecQuery($strSQL);
		if ($result == 1)
		{
		}
		else
		{
			$Msg = "** There was a problem in adding your feedback. Please try again.";
		}
		
		$seldate=date('Y-m-d');

		$resultbookkeep = d4l_ExecQuery("select bookkeepid from telecaller_feedback_bookkeeping where (`AllRequestID`=".$requestid." AND Reply_Type=2 and BidderID='".$bidderid."' and Feedback_ID='".$feedbackid."' and Feedback='".$ccfeedback."' and Followup_Date='".$FollowupDate."' and Comments='".$comment_section."' )");
		
		$bknum_rows = d4l_mysql_num_rows($resultbookkeep);
		$bkrow = d4l_mysql_fetch_array($resultbookkeep);
		if($bknum_rows > 0)
		{
			$bkstrSQL="Update telecaller_feedback_bookkeeping Set Feedback='".$ccfeedback."', Comments='".$comment_section."', Followup_Date='".$FollowupDate."', BidderID='".$bidderid."', Feedback_ID='".$feedbackid."'";
			$bkstrSQL=$bkstrSQL." Where bookkeepid=".$bkrow["bookkeepid"];
		}
		else
		{
			$bkstrSQL="Insert into telecaller_feedback_bookkeeping(AllRequestID, Feedback_ID, BidderID, Reply_Type , Feedback, Followup_Date, Comments, Dated) Values ('";
			$bkstrSQL=$bkstrSQL.$requestid."','".$feedbackid."','".$bidderid."','2','".$ccfeedback."', '".$FollowupDate."', '".$comment_section."','".$Dated."')";			
		}
		$result = d4l_ExecQuery($bkstrSQL);
	}
	
	if($sbireverseapirun==1)
	{
		if(strlen($sbileadid)>0){
			$param["LeadID"] = trim($sbileadid);
		}else{
			$param["ContactNo"] = trim($mobileno);
		}
		$param["PanCard"] = "";
		
		//print_r($param);
		$request = '';
		foreach($param as $key=>$val) //traverse through each member of the param array
		{
			$request.= $key."=".urlencode($val); //we have to urlencode the values
			$request.= "&"; //append the ampersand (&) sign after each paramter/value pair
		}
		$request = substr($request, 0, strlen($request)-1);
		$url = "https://app.sbismart.com/bo/ContactManagerApi/RealtyDataShow";

		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS,$request);
		$result = curl_exec($ch);
		curl_close($ch);
		//print_r($result);
		$outputstr=$result;
		$queryresult=d4l_ExecQuery("Select BidderID from Bidders Where (Global_Access_ID=6319) OR (BidderID IN(6319,6168,6254))");
		$BidderIDarr="";
		while($rowbid = d4l_mysql_fetch_array($queryresult))
		{
			$BidderIDarr[]= $rowbid["BidderID"];
		}
		$strbidders=implode(",",$BidderIDarr);

		$query1="Select websrvid,cust_requestid,doe,feedback from webservice_bidder_details Where (product='2' and bidderid in (".$strbidders.") and cust_requestid=".$requestid.") ORDER BY websrvid DESC LIMIT 0,1";
		$result1 = d4l_ExecQuery($query1);
		$sbirow=d4l_mysql_fetch_array($result1);
		if($sbirow["websrvid"]>0)
		{
			if(strlen($outputstr)>0)
			{
				$StrRepFirstBracket = str_replace("[", "", $outputstr);
				$StrRepFinal = str_replace("]", "", $StrRepFirstBracket);
				$obj = json_decode($StrRepFinal);
				$CurrentStatus = $obj->{'CurrentStatus'};
			}
			$update =d4l_ExecQuery("Update webservice_bidder_details set final_feedback='".$outputstr."',sbi_current_status='".$CurrentStatus."', final_feedback_date=Now() where (websrvid='".$sbirow["websrvid"]."')");
		}
	}
}

$hldetails = "select Existing_Bank,Existing_ROI,Property_Loc,Property_Identified,Property_Value,Employment_Status,Dated,DOB,Name,Email,Company_Name,City,City_Other,Mobile_Number,Net_Salary,Loan_Amount,Pincode,IP_Address,Add_Comment,Updated_Date from Req_Loan_Home Where (RequestID=".$requestid.")";
$hldetailsresult = d4l_ExecQuery($hldetails);
$hlrow=d4l_mysql_fetch_array($hldetailsresult);
if($hlrow["Property_Identified"]==0){ $property_identified="No";}
elseif($hlrow["Property_Identified"]==1) { $property_identified="Yes";}
else { $property_identified="";}
if($hlrow["Employment_Status"]==0) { $emp_status="Self Employed"; } else { $emp_status="Salaried"; }
if($hlrow["City"]=="Others" && strlen($hlrow["City_Other"])>0) { $strcity=$hlrow["City_Other"];} else {$strcity=$hlrow["City"];}
$smstext=$hlrow["Name"]."-".$hlrow["Mobile_Number"].",sal- ".$hlrow["Net_Salary"].",Co- ".$hlrow["Company_Name"].",loan amt- ".$hlrow["Loan_Amount"].", ".$hlrow["Add_Comment"];


$plfb_alldetails = d4l_ExecQuery("SELECT Allocation_Date,Asm_Comments,AsmID,smsflag,Feedback,Followup_Date,Comments,caller_name FROM client_lead_allocate WHERE AllRequestID=".$requestid." AND Reply_Type=2 AND BidderID IN (SELECT BidderID FROM Bidders WHERE Global_Access_ID = 6319)");
$plrowfb=d4l_mysql_fetch_array($plfb_alldetails);
$Feedback= $plrowfb["Feedback"];
$followup_date= $plrowfb["Followup_Date"];
$comment_section= $plrowfb["Comments"];
$Asm_Comments= $plrowfb["Asm_Comments"];
$caller_name= $plrowfb["caller_name"];

$getAllBookKeepDataQry = "SELECT * FROM telecaller_feedback_bookkeeping WHERE (`AllRequestID`=".$requestid." AND Reply_Type=2)";
$getAllBookKeepDataRes = d4l_ExecQuery($getAllBookKeepDataQry);
$bknum_rows = d4l_mysql_num_rows($getAllBookKeepDataRes);
$getAllBookKeepData = array();
while($getAllBookKeepDataResponse=d4l_mysql_fetch_assoc($getAllBookKeepDataRes))
{
	$getAllBookKeepData[]=$getAllBookKeepDataResponse;
}
//echo '<pre>';print_r($getAllBookKeepData);exit;

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script language="javascript" type="text/javascript" src="scripts/datetime.js"></script>
<link rel="stylesheet" type="text/css" href="callinglms/css-datepicker/jquery-ui.css" />
<link rel="stylesheet" type="text/css" href="callinglms/css-datepicker/datepicker.css" />
<link rel="stylesheet" type="text/css" href="css-datetimepicker/jquery-ui.css" />
<link rel="stylesheet" type="text/css" href="css-datetimepicker/jquery-ui-timepicker-addon.css" />
<script src="callinglms/js-datepicker/jquery-1.5.1.js"></script>
<script src="callinglms/js-datepicker/jquery.ui.core.js"></script>
<script src="callinglms/js-datepicker/jquery.ui.datepicker.js"></script>
<script src="js-datetimepicker/jquery-ui-timepicker-addon.js"></script>
<script> 
	$(function() {
		$("#FollowupDate").datetimepicker({  
			defaultDate: "today",
			changeMonth: true,
			changeYear: true,
			numberOfMonths: 1,
			minDate:0,
			timeFormat: 'hh:mm:ss',
			onSelect: function() {
				var selectedFollowUpDate = $(this).val();
				selectedFollowUpDate = selectedFollowUpDate.substring(0,10);
				$.ajax({
					url: 'sbihomeloanlead-details.php',
					type: 'POST',
					data: {
						method: 'FollowUpCount',
						selectedFollowUpDate: selectedFollowUpDate,
						bidder : '<?php echo $bidderid; ?>',
						caller_name : '<?php echo $caller_name; ?>',
					},
					success: function(response){
						//console.log(response);
						alert('Total FollowUp\'s are '+response);
					}
				});
			}
		});

	});
</script>
<?php 
if(isset($_SESSION['UserType']))
{
echo "<table width='100%' border='0' cellspacing='0' cellpadding='0'><tr><td width='323' height='93' align='left' valign='top'><img src='http://www.deal4loans.com/images/login-logo.gif' width='323' height='93' /></td><td align='left' valign='top' style='color:#0B6FCC;' ><table width='100%' border='0' cellspacing='0' cellpadding='0' bgcolor='#0A92C0'><tr><td height='67' align='right' valign='middle' bgcolor='#C8E3F3' style='padding-right:10px;'><table border='0' align='right' cellpadding='0' cellspacing='0' bgcolor='#0A92C0'><tr><td width='6' height='32' align='left' valign='top'><img  src='http://www.deal4loans.com/images/login-form-logut-lft.gif' width='6' height='32' /></td><td background='http://www.deal4loans.com/images/login-form-logut-bg.gif' style=' background-repeat:repeat-x; height:32px;'><table width='100%' border='0' align='center' cellpadding='0' cellspacing='0'><tr><td align='left' valign='middle' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#FFFFFF; font-weight:bold; padding-right:15px;' > Welcome ".ucwords($_SESSION['UserType'])." ".$_SESSION['UName']."</td><td align='left' style='padding-right:2px;' width='22'><img src='http://www.deal4loans.com/images/login-logut-btn.gif' /></td><td align='right' class='style1' style='color:#FFFFFF; font-weight:bold;'><div align='right' class='style1' style='color:#FFFFFF; font-weight:bold;'> <a href='Logout.php' style='color:#FFFFFF; font-size:13px; text-decoration:none; font-family:Verdana, Arial, Helvetica, sans-serif;'>Logout</a></div></td></tr></table></td><td width='6' height='32'><img src='http://www.deal4loans.com/images/login-form-logut-rgt.gif' width='6' height='32' /></td></tr></table></td></tr><tr><td>&nbsp;</td></tr></table></td></tr></table>";
}
?>
<style>
table {	font-family: Verdana, Arial, Helvetica, sans-serif; font-size:12px; }

</style>
</head>
<body>
<form name="loan_form" method="post" action="<? echo $_SERVER['PHP_SELF'] ?>?postid=<?echo $requestid;?>&biddt=<? echo $bidderid;?>" >
<input type="hidden" name="biddtnw" value="<? echo $bidderid; ?>" />
<input type="hidden" name="postidnw" value="<? echo $requestid; ?>" />
<input type="hidden" name="feedbackid" value="<? echo $hlrowal["Feedback_ID"]; ?>" />
<input type="hidden" name="updateddate" value="<? echo $hlrow["Updated_Date"]; ?>" />
<input type="hidden" name="smstext" value="<? echo $smstext; ?>" />
<table style='border:1px dotted #9C9A9C;' cellspacing="2" cellpadding="5" width="800" height="80%" align="center" border="0" >
<tr><td colspan="2" align="center" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold;">Home Loan Customer Details</td>
</tr>
<tr>
    <td width="180"><span class="style2">Customer Name: </span></td>
    <td width="392"><span class="style21"><? echo $hlrow["Name"]; ?></span></td>
</tr>
<tr>
	<td><span class="style2"> DOB: </span></td>
	<td><span class="style21"><? echo $hlrow["DOB"]; ?></span></td>
</tr>
<tr>
	<td><span class="style2"> Email: </span></td>
	<td><span class="style21"><? echo $hlrow["Email"]; ?></span></td>
</tr>
 <tr>
	<td><span class="style2"> Mobile No: </span></td>
	<td><span class="style21"><input type="hidden" name="mobileno" value="<?php echo $hlrow["Mobile_Number"]; ?>" /><? echo $hlrow["Mobile_Number"]; ?></span></td>
</tr>
<tr>
	<td><span class="style2"> Occupation: </span></td>
	<td><span class="style21"><? echo $emp_status; ?></span></td>
</tr>
<tr>
	<td><span class="style2"> Company Name: </span></td>
	<td><span class="style21"><? echo $hlrow["Company_Name"]; ?></span></td>
</tr>
<tr>
	<td><span class="style2"> City: </span></td>
	<td><span class="style21"><? echo $hlrow["City"]; ?></span></td>
</tr>
<tr>
	<td><span class="style2"> Other City: </span></td>
	<td><span class="style21"><? echo $hlrow["City_Other"]; ?></span></td>
</tr>
<tr>
	<td><span class="style2"> Pincode: </span></td>
	<td><span class="style21"><? echo $hlrow["Pincode"]; ?></span></td>
</tr>
<tr>
	<td><span class="style2"> Annual Income: </span></td>
	<td><span class="style21"><? echo $hlrow["Net_Salary"]; ?></span></td>
</tr>
<tr>
	<td><span class="style2">Required Loan Amount </span></td>
	<td><span class="style21"><? echo $hlrow["Loan_Amount"]; ?></span></td>
</tr>
<tr>
	<td><span class="style2">Property Identified: </span></td>
	<td><span class="style21"><? echo $property_identified; ?></span></td>
</tr>
<tr>
	<td><span class="style2">Property Location: </span></td>
	<td><span class="style21"><? echo $hlrow["Property_Loc"]; ?></span></td>
</tr>
<tr>
	<td><span class="style2">Property Value: </span></td>
	<td><span class="style21"><? echo $hlrow["Property_Value"]; ?></span></td>
</tr>
<tr>
	<td><span class="style2">Comments: </span></td>
	<td><span class="style21"><? echo $hlrow["Add_Comment"]; ?></span></td>
</tr>
<tr>
	<td width="180"><span class="style2">Date of entry: </span></td>
	<td width="392"><span class="style21"><? echo date('d-m-Y H:i:s', strtotime($plrowfb["Allocation_Date"])); ?></span></td>
</tr>
<tr>
	<td width="180"><span class="style2">Customer IP: </span></td>
	<td width="392"><span class="style21"><? echo $hlrow["IP_Address"]; ?></span></td>
</tr>
<tr>
	<td colspan="2" align="center" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold;">HL BT Details</td>
</tr>
<tr>
	<td><span class="style2">Bank Name: </span></td>
	<td><span class="style21"><? echo $hlrow["Existing_Bank"]; ?></span></td>
</tr>
<tr>
	<td><span class="style2">Bank ROI: </span></td>
	<td><span class="style21"><? echo $hlrow["Existing_ROI"]; ?></span></td>
</tr>
<tr>
	<td><span class="style2">ASM Comments: </span></td>
	<td><span class="style21"><textarea rows="2" cols="15" readonly><? echo $Asm_Comments; ?></textarea></span></td>
</tr>
<tr>
	<td><span class="style2" align="Center">Add Feedback</span></td>
</tr>
<tr>
	<td><span class="style2">LMS Comments: </span></td>
	<td><span class="style21"><textarea rows="2" cols="15" name="comment_section"><? echo $comment_section; ?></textarea></span></td>
</tr>
<tr>
	<td><span class="style2">LMS feedback </span></td>
	<td><span class="style21">
		<select name="sbihlfeedback" id="sbihlfeedback">
			<option value="No Feedback" <? if($Feedback == "") { echo "selected"; }?>>No Feedback</option>
			<option value="Not Eligible" <? if($Feedback == "Not Eligible") { echo "selected"; }?>>Not Eligible</option>
			<option value="Not Eligible Income" <? if($Feedback == "Not Eligible Income") { echo "selected"; }?>>Not Eligible Income</option>
			<option value="Not Eligible Property" <? if($Feedback == "Not Eligible Property") { echo "selected"; }?>>Not Eligible Property</option>
			<option value="Property Not Identified" <? if($Feedback == "Property Not Identified") { echo "selected"; }?>>Property Not Identified</option>
			<option value="Not Interested" <? if($Feedback == "Not Interested") { echo "selected"; }?>>Not Interested</option>
			<option value="Not Contactable" <? if($Feedback == "Not Contactable") { echo "selected"; } ?>>Not Contactable</option>
			<option value="Callback Later" <? if($Feedback == "Callback Later") { echo "selected"; }?>>Callback Later</option>
			<option value="Ringing" <? if($Feedback == "Ringing") { echo "selected"; }?>>Ringing</option>
			<option value="FollowUp" <? if($Feedback == "FollowUp") { echo "selected"; }?>>FollowUp</option>
			<option value="Wrong Number" <? if($Feedback == "Wrong Number") { echo "selected"; }?>>Wrong Number</option>
			<option value="Appointment" <? if($Feedback == "Appointment") { echo "selected"; }?>>Appointment</option>
			<option value="Arranging Documents" <? if($Feedback == "Arranging Documents") { echo "selected"; }?>>Arranging Documents</option>
			<option value="Document Picked" <? if($Feedback == "Document Picked") { echo "selected"; }?>>Document Picked</option>
			<option value="Login" <? if($Feedback == "Login") { echo "selected"; }?>>Login</option>
			<option value="Sanctioned" <? if($Feedback == "Sanctioned") { echo "selected"; }?>>Sanctioned</option>
			<option value="Disbursed" <? if($Feedback == "Disbursed") { echo "selected"; }?>>Disbursed</option>
			<option value="Duplicate" <? if($Feedback == "Duplicate") { echo "selected"; }?>>Duplicate</option>
		</select></span>
	</td>
</tr>	
<tr>
	<td><span class="style2">Caller Name: </span></td>
	<td><span class="style21">
		<Select name="callername" id="callername">
			<option value="">Please Select</option>
			<option value="caller1" <? if($caller_name == "caller1") { echo "selected"; }?>>Caller 1</option>
			<option value="caller2" <? if($caller_name == "caller2") { echo "selected"; }?>>Caller 2</option>
		</select></span>
	</td>
</tr>
<tr>
	<td class="fontstyle"><b>Follow Up Date</b></td>
	<td class="fontstyle">
		<input type="Text"  name="FollowupDate" id="FollowupDate" maxlength="25" size="15" <?php if($Followup_Date !='0000-00-00 00:00:00') { ?>value="<?php  echo $followup_date; ?>" <?php } ?> />
	</td>
</tr>
<tr>
	<td><span class="style2">Choose ASM: </span></td>
	<td><span class="style21">
		<?php if(strlen($strcity)>0) { ?>
		<select name="asm_id" id="asm_id">
			<option value="">Please Select</option>
			<?  $asmqry=d4l_ExecQuery("Select * from sbihl_6168_asmlist Where (location like '%".strtoupper($strcity)."%' and status=1)"); 
			while($asmrow=d4l_mysql_fetch_array($asmqry))
			{
			?>
			<option value="<? echo $asmrow["bidderid"]; ?>" <?php if($asmrow["bidderid"]==$plrowfb["AsmID"]) echo "Selected"; ?>><? echo $asmrow["asm_name"]; ?></option>
			<?
			}
			?>
		</select><? } ?></span>
	</td>
</tr>
<tr>
	<td><span class="style2">Send SMS: </span></td>
	<td><span class="style21"><input type="checkbox" name="Sendsms" id="Sendsms" value="1" <? //if($plrowfb["smsflag"]==1) { echo "checked";} ?> />Send SMS</span></td>
</tr>
<tr>
	<td colspan="2"><span class="style2" align="center">Feedback from Bank: </span></td>
</tr>
<tr>   
	<td colspan="2"><span class="style21">
		<?php 
		$ASMSBISql = d4l_ExecQuery("SELECT final_feedback, feedback FROM webservice_bidder_details WHERE cust_requestid = ". $requestid." AND BidderID IN (SELECT BidderID  FROM `Bidders` WHERE `Global_Access_ID` LIKE '6319')");
		$ASMSBISqlrow = d4l_mysql_fetch_array($ASMSBISql);
		//$StrRepFirstBracket = str_replace("[", "", $ASMSBISqlrow[0]);
		//$StrRepFinal = str_replace("]", "", $StrRepFirstBracket);
		//$obj = json_decode(trim($StrRepFinal));
		
		$obj = json_decode(trim($ASMSBISqlrow[0]));
		//echo '<pre>';print_r($obj);

		echo "CurrentStatus : ".$CurrentStatus = $obj[0]->{'CurrentStatus'}; echo "<br>";
		echo "TeleCaller Status : ".$TeleCallerStatus = $obj[0]->{'TeleCaller Status'}; echo "<br>";
		echo "ASMCode : ".$ASMCode = $obj[0]->{'ASMCode'};echo "<br>";
		echo "ASMName : ".$ASMName = $obj[0]->{'ASMName'};echo "<br>";
		echo "ASM Status : ".$ASMStatus = $obj[0]->{'ASM Status'};echo "<br>";
		echo "LOSNO : ".$LOSNO = $obj[0]->{'LOSNO'};echo "<br>";
		echo "EntryDate : ".$EntryDate = $obj[0]->{'EntryDate'};echo "<br>";
		echo "LastUpdated Date : ".$LastUpdatedDate = $obj[0]->{'LastUpdated Date'};echo "<br>";
		echo "TCComments : ".$TCComments = $obj[0]->{'TCComments'};echo "<br>";
		echo "ASMComments : ".$ASMComments = $obj[0]->{'ASMComments'}; echo "<br>"; 
		$data = $ASMSBISqlrow["feedback"];
		$expires = preg_split('/LeadID/', trim($data));
		$leadValue = str_replace(":","",str_replace('"}]','',$expires[1])); ?>
		<input type="hidden" name="sbileadid" value="<?php echo $leadValue; ?>" /></span>
	</td>
</tr>
<tr>
	<td colspan="2"><input type="checkbox" value="1" name="sbireverseapirun" />get updated feedback from SBI</td>
</tr>
<tr><td colspan="2" align="center"><input type="Submit" name="Submit" value="Submit" /></td></tr>

</table>
</form>

<table style='border:1px dotted #9C9A9C;' cellspacing="0" cellpadding="5" width="800" height="80%" align="center" border="1" >
<tr>
	<td colspan="8" align="center" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold;">Life Cycle</td>
</tr>
<tr>
	<td colspan="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold;">Caller</td>
	<td colspan="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold;">Feedback</td>
	<td colspan="2" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold;">Followup Date</td>
	<td colspan="2" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold;">Comments</td>
	<td colspan="2" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold;">Dated</td>
</tr>
<?php 
foreach($getAllBookKeepData as $key => $val){
?>
<tr>
	<td colspan="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:12px;">
		 <? echo $caller_name; ?> 
	</td>
	<td colspan="1" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:12px;">
		 <? echo $val['Feedback']; ?> 
	</td>
	<td colspan="2" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:12px;">
		 <? echo $val['Followup_Date']; ?> 
	</td>
	<td colspan="2" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:12px;">
		 <? echo $val['Comments']; ?> 
	</td>
	<td colspan="2" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:12px;">
		 <? echo $val['Dated']; ?> 
	</td>
</tr>
<?php
}
?>


 <tr><td colspan="8">
     <form action="sbihomeloanlead-details_whatsapp.php" name="whatsapp_frm" method="post">
     			<input type="hidden" name="callerid" id="callerid" value="<? echo $bidderid;?>" />
				<input type="hidden" name="requestid" id="requestid" value="<? echo $requestid;?>" />
				<input type="hidden" name="whatsapp_process_name" id="whatsapp_process_name" value="<? echo 'deal4loan_homeloan7342_message'; ?>" />
				

   <table width="100%" cellspacing="4" cellpadding="2" style="border:#000 1px solid;" >
         <tr><td colspan="4"><strong>Whatsapp</strong><hr /></td></tr>
         <tr>
         	<td colspan="4">
			 	<textarea name="whatsapp_message" style="width: 479px; height: 70px"></textarea> <input type="submit" name="whatsapp_submit" value="Submit" />         
			 	<br /> <?php echo $_SESSION['whatsapp_returnValue'];
			//	print_r($_SESSION);			 	
 ?>
         	</td>
         </tr>
               <tr><td colspan="4"><hr /></td></tr>
                  <tr><td colspan="4"><strong>Messages Archive</strong><hr /></td></tr>
                  <tr><td colspan="4">
                   <table width="100%" cellspacing="4" cellpadding="2" style="border:#000 1px solid;" >
                  <?php
            /*      $Mobile=$hlrow["Mobile_Number"];
            	$sql = "SELECT message,xkyknzl5dwfyk4hg_wishfin_whatsapp.date_created FROM `xkyknzl5dwfyk4hg_wishfin_whatsapp` LEFT OUTER JOIN xkyknzl5dwfyk4hg_tms_whatsapp on xkyknzl5dwfyk4hg_tms_whatsapp.whatsapp_id=xkyknzl5dwfyk4hg_wishfin_whatsapp.id WHERE `mobile_number` = '".$Mobile."' AND `mobile_number`!='' AND process_name='deal4loan_homeloan7342_message' ORDER BY `xkyknzl5dwfyk4hg_wishfin_whatsapp`.`date_created` ASC ";
			//	$qry = wf_ExecQuery($sql);
				$num =wf_mysql_num_rows($qry);
				$message = '';
				$commonDate = '';
				$commonHeader='';
				if($num>0)
				{
					$messageCounter =1;
					$initialDate=wf_mysql_result($qry,0,'date_created');
					for($i=0;$i<$num;$i++)
					{
						$message[$messageCounter]=wf_mysql_result($qry,$i,'message');
						$commonDate[$messageCounter]=wf_mysql_result($qry,$i,'date_created');
						$commonHeader[$messageCounter]='Agent';	
						$messageCounter = $messageCounter+1;
					}
				}
				
				
				$sql1 = "SELECT * FROM `xkyknzl5dwfyk4hg_whatsapp_callback` WHERE `mobile_number`= '91".$Mobile."' AND `mobile_number`!='' AND  (message_status NOT LIKE 'read' AND message_status NOT LIKE 'delivered') AND date_created>'".$initialDate."' ";
				$qry1 = wf_ExecQuery($sql1);
				$num1 =wf_mysql_num_rows($qry1);
				if($num1>0)
				{
					for($i=0;$i<$num1;$i++)
					{
						$message[$messageCounter]=wf_mysql_result($qry1,$i,'message_text');
						$commonDate[$messageCounter]=wf_mysql_result($qry1,$i,'date_created');
						$commonHeader[$messageCounter]='Customer';	
						$messageCounter = $messageCounter+1;
					}
				}
				asort($commonDate);
				$sequenceMessages = array_keys($commonDate);
				$sequence='';
				for($i=0;$i<count($sequenceMessages);$i++)
				{
				   if ($i % 2 != 0) {
                    $colorvar = "#FFF";
                	} else {
                    $colorvar = "#EEE";
                	}

					$sequence=$sequenceMessages[$i]; */
					?>
					<tr><td bgcolor="<?php echo $colorvar; ?>">
					<?php
				//	echo "<b>".$commonHeader[$sequence]."</b> [".$commonDate[$sequence]."] - ".$message[$sequence]."";
					?></td>
					</tr>
				<?php
			//	}

                  
                  ?>
                  </table>
                  
                  </td></tr>
                  
                  
                  
    </table>
    </form>   
      
</td></tr>


</table>
</body>
</html>
