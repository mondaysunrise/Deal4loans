<?php
$requestid = $_REQUEST["postid"];
$bidderid = $_REQUEST["biddt"];
require 'scripts/session_check_online.php';
require 'scripts/db_init.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	foreach($_POST as $a=>$b)
		$$a=$b;
	$comment_section = $_POST["comment_section"];
	$ccfeedback = $_POST["sbihlfeedback"];
	$FollowupDate  = $_POST["FollowupDate"];
	$feedbackid  = $_POST["feedbackid"];
	$Updated_Date  = $_POST["updateddate"];
	
	//allocate to asm
	if(strlen($ccfeedback)>1)
	{
		$strSQL="";
		$Msg="";
		$result = ExecQuery("select `leadid` from `client_lead_allocate` where (`AllRequestID`=".$requestid." and AsmID=".$bidderid." AND Reply_Type=2)");
		//echo "select `leadid` from `client_lead_allocate` where (`AllRequestID`=".$requestid." and AsmID=".$asm_id." AND Reply_Type=2)";
		$num_rows = mysql_num_rows($result);
		if($num_rows > 0)
		{	$row = mysql_fetch_array($result);
			$strSQL="Update client_lead_allocate Set Asm_Feedback='".$ccfeedback."', Asm_Comments='".$comment_section."', Asm_Followup_Date='".$FollowupDate."'";
			$strSQL=$strSQL." Where leadid=".$row["leadid"];
		}
		else
		{
			$strSQL="Update client_lead_allocate Set Asm_Feedback='".$ccfeedback."', Asm_Comments='".$comment_section."', Asm_Followup_Date='".$FollowupDate."'";
			$strSQL=$strSQL." Where leadid=".$row["leadid"];
		}
		//echo "asm".$strSQL."<br><br>";
		$result = ExecQuery($strSQL);
		if ($result == 1)
		{
		}
		else
		{
			$Msg = "** There was a problem in adding your feedback. Please try again.";
		}
		
		$seldate=date('Y-m-d');

		$resultbookkeep = ExecQuery("select bookkeepid from telecaller_feedback_bookkeeping where (`AllRequestID`=".$requestid." AND Reply_Type=2 and Dated between '".$seldate." 00:00:00' and '".$seldate." 23:59:59')");
		$bknum_rows = mysql_num_rows($resultbookkeep);
		$bkrow = mysql_fetch_array($resultbookkeep);
		if($bknum_rows > 0)
		{
			$bkstrSQL="Update telecaller_feedback_bookkeeping Set 	Dated='".$Dated."',Feedback='".$ccfeedback."', Comments='".$comment_section."', Followup_Date='".$FollowupDate."', BidderID='".$bidderid."', Feedback_ID='".$feedbackid."'";
			$bkstrSQL=$bkstrSQL." Where bookkeepid=".$bkrow["bookkeepid"];
		}
		else
		{			
			$bkstrSQL="Insert into telecaller_feedback_bookkeeping(AllRequestID, Feedback_ID, BidderID, Reply_Type , Feedback, Followup_Date, Comments, Dated) Values ('";
			$bkstrSQL=$bkstrSQL.$requestid."','".$feedbackid."','".$bidderid."','2','".$ccfeedback."', '".$FollowupDate."', '".$comment_section."','".$Dated."')";			
		}
		$result = ExecQuery($bkstrSQL);
	}
}

$hldetails = "select Existing_Bank,Existing_ROI,Property_Loc,Property_Identified,Property_Value,Employment_Status,Dated,DOB,Name,Email,Company_Name,City,City_Other,Mobile_Number,Net_Salary,Loan_Amount,Pincode,IP_Address,Add_Comment,Updated_Date from Req_Loan_Home Where (RequestID=".$requestid.")";
$hldetailsresult = ExecQuery($hldetails);
$hlrow=mysql_fetch_array($hldetailsresult);
if($hlrow["Property_Identified"]==0){ $property_identified="No";}
elseif($hlrow["Property_Identified"]==1) { $property_identified="Yes";}
else { $property_identified="";}
if($hlrow["Employment_Status"]==0) { $emp_status="Self Employed"; } else { $emp_status="Salaried"; }
if($hlrow["City"]=="Others" && strlen($hlrow["City_Other"])>0) { $strcity=$hlrow["City_Other"];} else {$strcity=$hlrow["City"];}

$plfb_alldetails = ExecQuery("select Allocation_Date,Comments,AsmID,smsflag,Asm_Feedback,Asm_Followup_Date,Asm_Comments from client_lead_allocate Where (AllRequestID=".$requestid."  and `Reply_Type`=2 and AsmID=".$bidderid.")");
$plrowfb=mysql_fetch_array($plfb_alldetails);
$Feedback= $plrowfb["Asm_Feedback"];
$followup_date= $plrowfb["Asm_Followup_Date"];
$comment_section= $plrowfb["Asm_Comments"];
$Comments= $plrowfb["Comments"];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script language="javascript" type="text/javascript" src="scripts/datetime.js"></script>
<?php 
/* if(isset($_SESSION['UserType']))
{
echo "<table width='100%' border='0' cellspacing='0' cellpadding='0'><tr><td width='323' height='93' align='left' valign='top'><img src='http://www.deal4loans.com/images/login-logo.gif' width='323' height='93' /></td><td align='left' valign='top' style='color:#0B6FCC;' ><table width='100%' border='0' cellspacing='0' cellpadding='0' bgcolor='#0A92C0'><tr><td height='67' align='right' valign='middle' bgcolor='#C8E3F3' style='padding-right:10px;'><table border='0' align='right' cellpadding='0' cellspacing='0' bgcolor='#0A92C0'><tr><td width='6' height='32' align='left' valign='top'><img  src='http://www.deal4loans.com/images/login-form-logut-lft.gif' width='6' height='32' /></td><td background='http://www.deal4loans.com/images/login-form-logut-bg.gif' style=' background-repeat:repeat-x; height:32px;'><table width='100%' border='0' align='center' cellpadding='0' cellspacing='0'><tr><td align='left' valign='middle' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#FFFFFF; font-weight:bold; padding-right:15px;' > Welcome ".ucwords($_SESSION['UserType'])." ".$_SESSION['UName']."</td><td align='left' style='padding-right:2px;' width='22'><img src='http://www.deal4loans.com/images/login-logut-btn.gif' /></td><td align='right' class='style1' style='color:#FFFFFF; font-weight:bold;'><div align='right' class='style1' style='color:#FFFFFF; font-weight:bold;'> <a href='Logout.php' style='color:#FFFFFF; font-size:13px; text-decoration:none; font-family:Verdana, Arial, Helvetica, sans-serif;'>Logout</a></div></td></tr></table></td><td width='6' height='32'><img src='http://www.deal4loans.com/images/login-form-logut-rgt.gif' width='6' height='32' /></td></tr></table></td></tr><tr><td>&nbsp;</td></tr></table></td></tr></table>";
}*/
?>
</head>
<body>
<form name="loan_form" method="post" action="<? echo $_SERVER['PHP_SELF'] ?>?postid=<?echo $requestid;?>&biddt=<? echo $bidderid;?>" >
<input type="hidden" name="biddtnw" value="<?echo $bidderid;?>">
<input type="hidden" name="postidnw" value="<?echo $requestid;?>">
<input type="hidden" name="feedbackid" value="<?echo $hlrowal["Feedback_ID"];?>">
<input type="hidden" name="updateddate" value="<?echo $hlrow["Updated_Date"];?>">
<table style='border:1px dotted #9C9A9C;' cellspacing="2" cellpadding="5" width="600" height="80%" align="center" border="0" >
	<tr><td colspan="2" align="center" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold;">Home Loan Customer Details</td></tr>
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
		<td><span class="style21"><? echo $hlrow["Mobile_Number"]; ?></span></td>
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
		<td width="392"><span class="style21"><? echo $plrowfb["Allocation_Date"]; ?></span></td>
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
		<td><span class="style2">Telecaller Comments: </span></td>
        <td><span class="style21"><textarea rows="2" cols="15" readonly><? echo $Comments; ?></textarea></span></td>
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
				<option value="No Feedback" <?if($Feedback == "") { echo "selected"; }?>>No Feedback</option>
				<option value="Not Eligible" <?if($Feedback == "Not Eligible") { echo "selected"; }?>>Not Eligible</option>
				<option value="Not Interested" <?if($Feedback == "Not Interested") { echo "selected"; }?>>Not Interested</option>
				<option value="Not Contactable" <? if($Feedback == "Not Contactable") { echo "selected"; } ?>>Not Contactable</option>
				<option value="Callback Later" <?if($Feedback == "Callback Later") { echo "selected"; }?>>Callback Later</option>
				<option value="Ringing" <?if($Feedback == "Ringing") { echo "selected"; }?>>Ringing</option>
				<option value="FollowUp" <?if($Feedback == "FollowUp") { echo "selected"; }?>>FollowUp</option>
				<option value="Wrong Number" <?if($Feedback == "Wrong Number") { echo "selected"; }?>>Wrong Number</option>
				<option value="Appointment" <?if($Feedback == "Appointment") { echo "selected"; }?>>Appointment</option>
				<option value="Document Picked" <?if($Feedback == "Document Picked") { echo "selected"; }?>>Document Picked</option>
				<option value="Login" <?if($Feedback == "Login") { echo "selected"; }?>>Login</option>
				<option value="Sanctioned" <?if($Feedback == "Sanctioned") { echo "selected"; }?>>Sanctioned</option>
				<option value="Disbursed" <?if($Feedback == "Disbursed") { echo "selected"; }?>>Disbursed</option>
				<option value="Duplicate" <?if($Feedback == "Duplicate") { echo "selected"; }?>>Duplicate</option>
			</select></span>
		</td>
	</tr>	
	<tr>
		<td class="fontstyle"><b>Follow Up Date</b></td>
		<td class="fontstyle">
			<input type="Text"  name="FollowupDate" id="FollowupDate" maxlength="25" size="15" <?php if($Followup_Date !='0000-00-00 00:00:00') { ?>value="<?php  echo $followup_date; ?>" <?php } ?>><a href="javascript:NewCal('FollowupDate','yyyymmdd',true,24)"><img src="images/cal.gif" width="16" height="16" border="0" alt="Pick a date"></a>
		</td>
	</tr> 
	<tr><td colspan="2" align="center"><input type="Submit" name="Submit" value="Submit"></td></tr>
</table>
</form>
</body>
</html>
