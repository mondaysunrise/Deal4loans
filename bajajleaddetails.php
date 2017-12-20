<?php
require 'scripts/session_check_online.php';
require 'scripts/db_init.php';

$requestid = $_REQUEST["bjcblid"];
$bidid = $_REQUEST["bidid"];

$IP_Remote = getenv("REMOTE_ADDR");
	if($IP_Remote=='192.99.32.74') { $IP= $_SERVER['HTTP_X_REAL_IP']; }
	else { $IP=$IP_Remote;	}

if($IP=="122.176.100.27" || $IP=="122.176.100.28" || $IP=="122.176.122.134")
{
$pldetails = "SELECT * FROM bajaj_cibildetails LEFT OUTER JOIN Req_Feedback ON Req_Feedback.AllRequestID=bajaj_cibildetails.bajajcibilid AND Req_Feedback.BidderID=".$bidid." WHERE bajajcibilid=".$requestid;
//echo $pldetails."<br>";
$pldetailsresult = ExecQuery($pldetails);
$plrow=mysql_fetch_array($pldetailsresult);
$varCmbFeedback = $plrow["Feedback"];

if($plrow["Employment_Status"]==0) { $emp_status="Self Employed"; } else { $emp_status="Salaried"; }

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$RequestID = $requestid;
	$Feedback = $_POST["cmbfeedback"];
	$comment_section = $_POST["comment_section"];
	$FollowupDate = $_POST["FollowupDate"];
	if(strlen(trim($RequestID))>0)
	{
		$strSQL="";
		$Msg="";
		$result = ExecQuery("select FeedbackID from Req_Feedback where AllRequestID=$RequestID and BidderID=".$bidid);		
		$num_rows = mysql_num_rows($result);
		if($num_rows > 0)
		{
			$row = mysql_fetch_array($result);
			$strSQL="Update Req_Feedback Set Feedback='".$Feedback."',Followup_Date='".$FollowupDate."', comment_section='".$comment_section."'";
			$strSQL=$strSQL."Where FeedbackID=".$row["FeedbackID"];
		}
		else
		{
			$strSQL="Insert into Req_Feedback(AllRequestID, BidderID, Reply_Type , Feedback, Followup_Date, comment_section) Values (";
			$strSQL=$strSQL.$RequestID.",".$bidid.",'1','".$Feedback."','".$FollowupDate."', '".$comment_section."' )";
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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script language="javascript" type="text/javascript" src="scripts/datetime.js"></script>
<style type="text/css">
<!--
.style2 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold;}
.style21 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size:12px;}
-->
</style>
</head>
<body>
<form name="loan_form" method="post" action="<? echo $_SERVER['PHP_SELF'] ?>?bjcblid=<?echo $requestid;?>&bidid=<? echo $bidid;?>" >
<table style='border:1px dotted #9C9A9C;' cellspacing="2" cellpadding="5" width="600" height="80%" align="center" border="0" >
<tr><td colspan="2" align="center" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold;">Personal loan customer details</td></tr>
<tr>
        <td width="180"><span class="style2">Customer Name: </span></td>
    <td width="392"><span class="style21"><? echo $plrow["bajajf_name"]; ?></span></td>
  </tr>
     <tr>
        <td><span class="style2"> DOB: </span></td>
       <td><span class="style21"><? echo $plrow["bajajf_dob"]; ?></span></td>
  </tr>
      <tr>
        <td><span class="style2"> Mobile No: </span></td>
       <td><span class="style21"><? echo $plrow["bajajf_mobile"]; ?></span></td>
  </tr>
    <tr>
        <td><span class="style2"> Official Email: </span></td>
       <td><span class="style21"><? echo $plrow["office_email"]; ?></span></td>
  </tr>
       <tr>
        <td><span class="style2"> Company Name: </span></td>
       <td><span class="style21"><? echo $plrow["bajajf_company_name"]; ?></span></td>
  </tr>
  <tr>
        <td><span class="style2">Current Experience </span></td>
        <td><span class="style21"><? echo $plrow["current_experience"]; ?></span></td>
     </tr>
	 <tr>
        <td><span class="style2">Total Experience </span></td>
        <td><span class="style21"><? echo $plrow["total_experience"]; ?></span></td>
     </tr>
	 <tr>
        <td><span class="style2"> Office Address: </span></td>
       <td><span class="style21"><? echo $plrow["office_address"]; ?></span></td>
  </tr>
  <tr>
        <td><span class="style2"> Designation: </span></td>
       <td><span class="style21"><? echo $plrow["designation"]; ?></span></td>
  </tr>
    <tr>
        <td><span class="style2"> City: </span></td>
    <td><span class="style21"><? echo $plrow["bajajf_city"]; ?></span></td>
  </tr>
   <tr>
        <td><span class="style2"> Annual Income: </span></td>
        <td><span class="style21"><? echo $plrow["bajajf_salary"]; ?></span></td>
  </tr>  
        <tr>
        <td><span class="style2">Required Loan Amount: </span></td>
        <td><span class="style21"><? echo $plrow["bajajf_loan_amt"]; ?></span></td>
     </tr>
	 <tr>
        <td><span class="style2">PAN No: </span></td>
        <td><span class="style21"><? echo $plrow["bajajf_panno"]; ?></span></td>
     </tr>
	  <tr>
        <td><span class="style2">Residence Type </span></td>
        <td><span class="style21"><? echo $plrow["residence_type"]; ?></span></td>
     </tr>
	 <tr>
        <td><span class="style2">Residence address: </span></td>
        <td><span class="style21"><? echo $plrow["bajajf_caddress"]; ?></span></td>
     </tr>
	 <tr>
        <td><span class="style2">Residing Since </span></td>
        <td><span class="style21"><? echo $plrow["residing_since"]; ?></span></td>
     </tr>
     
	 
	 <tr>
        <td><span class="style2">Feedback </span></td>
        <td><span class="style21"><select name="cmbfeedback" id="cmbfeedback" style="width:120px;">
		<option value="" <? if($varCmbFeedback == "") { echo "selected"; } ?>>No Feedback</option>
		<option value="Not Eligible" <? if($varCmbFeedback == "Not Eligible") { echo "selected"; } ?>>Not Eligible</option>
		<option value="Not Interested" <? if($varCmbFeedback == "Not Interested") { echo "selected"; } ?>>Not Interested</option>
		<option value="Wrong Number" <? if($varCmbFeedback == "Wrong Number") { echo "selected"; } ?>>Wrong Number</option>
		<option value="Ringing" <? if($varCmbFeedback == "Ringing") { echo "selected"; } ?>>Ringing</option>
		<option value="OTP Done" <? if($varCmbFeedback == "OTP Done") { echo "selected"; } ?>>OTP Done</option>
		<option value="Approved" <? if($varCmbFeedback == "Approved") { echo "selected"; } ?>>Approved</option>
		<option value="FollowUp" <? if($varCmbFeedback == "FollowUp") { echo "selected"; } ?>>FollowUp</option>
		<option value="Disbursed" <? if($varCmbFeedback == "Disbursed") { echo "selected"; } ?>>Disbursed</option>		
		</select></span></td>
     </tr>
      <tr>
        <td><span class="style2">FollowUp Date </span></td>
        <td><span class="style21"><input type="Text"  name="FollowupDate" id="FollowupDate" maxlength="25" size="15" <?php if($plrow["Followup_Date"] !='0000-00-00 00:00:00') { ?>value="<?php  echo $plrow["Followup_Date"]; ?>" <?php } ?>><a href="javascript:NewCal('FollowupDate','yyyymmdd',true,24)"><img src="images/cal.gif" width="16" height="16" border="0" alt="Pick a date"></a></span></td>
     </tr>
     <tr>
        <td><span class="style2">Remarks </span></td>
        <td><span class="style21"><textarea  name="comment_section" id="comment_section" cols="15" rows="2"><? echo $plrow["comment_section"]; ?></textarea></span></td>
     </tr>
     <tr>
        <td width="180"><span class="style2">Date of entry: </span></td>
        <td width="392"><span class="style21"><? echo $plrow["bajaj_dated"]; ?></span></td>
  </tr>
  <tr>
     <td colspan="2" align="center"><input type="submit" class="bluebutton" value="Submit"> 
      </td>
   </tr>
  </table>
  </form>
</body>
</html>
<? } ?>