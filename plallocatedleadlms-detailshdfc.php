<?php
 $requestid = $_REQUEST["postid"];
 $bidderid = $_REQUEST["biddt"];
require 'scripts/session_check_online.php';
require 'scripts/db_init.php';

function ccMasking($number, $maskingCharacter = 'X') 
{
	return substr($number, 0, 2) . str_repeat($maskingCharacter, strlen($number) - 4) . substr($number, -2);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		foreach($_POST as $a=>$b)
			$$a=$b;
		$comment_section = $_POST["comment_section"];
		$ccfeedback = $_POST["ccfeedback"];
		$FollowupDate  = $_POST["FollowupDate"];

	if(strlen($ccfeedback)>0 || strlen($comment_section)>0)
	{
		if($ccfeedback=="Process")
		{
			$last_updated=Date('Y-m-d');
		}
		else
		{
			$last_updated="";
		}
		$strSQL="";
		$Msg="";
		$result = ExecQuery("select FeedbackID,not_contactable_counter from Req_Feedback_PL where AllRequestID=".$requestid." and BidderID=".$bidderid." AND Reply_Type=1");
//echo "select FeedbackID,not_contactable_counter from Req_Feedback_PL where AllRequestID=".$requestid." and BidderID=".$bidderid." AND Reply_Type=4";
		
		$num_rows = mysql_num_rows($result);
		if($num_rows > 0)
		{	
			$row = mysql_fetch_array($result);
			$strSQL="Update Req_Feedback_PL Set Feedback='".$ccfeedback."',comment_section='".$comment_section."',Followup_Date='".$FollowupDate."' ";
			$strSQL=$strSQL."Where FeedbackID=".$row["FeedbackID"];

			}
		else
		{
			$strSQL="Insert into Req_Feedback_PL(AllRequestID, BidderID, Reply_Type , Feedback, Followup_Date,comment_section) Values (";
			$strSQL=$strSQL.$requestid.",".$bidderid.",1,'".$ccfeedback."','".$FollowupDate."','".$comment_section."')";
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
$followup_date="";
$ccdetails = "select Employment_Status,CC_Holder,Dated,DOB,Name,Email,Company_Name,City,City_Other,Mobile_Number,Net_Salary,Loan_Amount,Pincode,IP_Address,Add_Comment,Residence_Address,Total_Experience from Req_Loan_Personal Where (RequestID=".$requestid.")";
//echo $ccdetails."<br>";
$ccdetailsresult = ExecQuery($ccdetails);
$ccrow=mysql_fetch_array($ccdetailsresult);

$cc_alldetails = ExecQuery("select * from lead_allocate Where (AllRequestID=".$requestid." and BidderID=".$bidderid.")");
//echo $ccdetails."<br>";
$ccrowal=mysql_fetch_array($cc_alldetails);

if($ccrow["Employment_Status"]==0) { $emp_status="Self Employed"; } else { $emp_status="Salaried"; }

if($ccrow["CC_Holder"]==1) { $cc_holder="Yes"; }  if($ccrow["CC_Holder"]==0) { $cc_holder="No"; }
					
			if($ccrow["Card_Vintage"]==1)	{	$card_vintage="Less than 6 months";}
			elseif($ccrow["Card_Vintage"]==2)	{	$card_vintage="6 to 9 months";}
		elseif($ccrow["Card_Vintage"]==3)	{	$card_vintage="9 to 12 months";}
		elseif($ccrow["Card_Vintage"]==4)		{	$card_vintage="more than 12 months";}
		else
			{
				$card_vintage="";
			}

$ccfb_alldetails = ExecQuery("select * from Req_Feedback_PL Where (BidderID=".$bidderid." and AllRequestID=".$requestid.")");
//echo "select * from Req_Feedback_PL Where (BidderID=".$bidderid." and AllRequestID=".$requestid.")";
//echo $ccfb_alldetails."<br>";
$ccrowfb=mysql_fetch_array($ccfb_alldetails);
$Feedback= $ccrowfb["Feedback"];
$followup_date= $ccrowfb["Followup_Date"];
$comment_section= $ccrowfb["comment_section"];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script language="javascript" type="text/javascript" src="scripts/datetime.js"></script>
<title>Personal Loan</title>
<style type="text/css">
<!--
.style2 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold;}
.style21 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size:12px;}
-->
</style>
</head>
<body>
<form name="loan_form" method="post" action="<? echo $_SERVER['PHP_SELF'] ?>?postid=<?echo $requestid;?>&biddt=<? echo $bidderid;?>" >
<input type="hidden" name="biddtnw" value="<?echo $bidderid;?>">
<input type="hidden" name="postidnw" value="<?echo $requestid;?>">
<table style='border:1px dotted #9C9A9C;' cellspacing="2" cellpadding="5" width="600" height="80%" align="center" border="0" >
<tr><td colspan="2" align="center" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold;">Personal loan customer details</td></tr>
<tr>
        <td width="180"><span class="style2">Customer Name: </span></td>
    <td width="392"><span class="style21"><? echo $ccrow["Name"]; ?></span></td>
  </tr>
     <tr>
        <td><span class="style2"> DOB: </span></td>
       <td><span class="style21"><? echo $ccrow["DOB"]; ?></span></td>
  </tr>
     <tr>
        <td><span class="style2"> Email: </span></td>
       <td><span class="style21"><? echo $ccrow["Email"]; ?></span></td>
  </tr>
     <tr>
        <td><span class="style2"> Mobile No: </span></td>
       <td><span class="style21"><? echo ccMasking($ccrow["Mobile_Number"]);  ?></span></td>
  </tr>
     <tr>
        <td><span class="style2"> Occupation: </span></td>
       <td><span class="style21"><? echo $emp_status; ?></span></td>
  </tr>
     <tr>
        <td><span class="style2"> Company Name: </span></td>
       <td><span class="style21"><? echo $ccrow["Company_Name"]; ?></span></td>
  </tr>
     <tr>
        <td><span class="style2"> Total Experience: </span></td>
        <td><span class="style21"><? echo $ccrow["Total_Experience"]; ?></span></td>
  </tr>
<tr>
        <td><span class="style2"> City: </span></td>
    <td><span class="style21"><? echo $ccrow["City"]; ?></span></td>
  </tr>
     <tr>
        <td><span class="style2"> Other City: </span></td>
       <td><span class="style21"><? echo $ccrow["City_Other"]; ?></span></td>
  </tr>
     <tr>
        <td><span class="style2"> Pincode: </span></td>
       <td><span class="style21"><? echo $ccrow["Pincode"]; ?></span></td>
  </tr>
     <tr><td colspan="2"><table width="100%" cellpadding="0" cellspacing="0">
     <tr>
        <td width="32%" class="style2"> Card Holder: </td>
        <td width="25%" class="style21"><? echo $cc_holder; ?></td>
        <td width="23%" class="style2">Card Vintage: </td>
        <td width="20%" class="style21"><? echo $card_vintage; ?></td>
     </tr>
     </table></td>
  </tr>
        <tr>
        <td><span class="style2"> Annual Income: </span></td>
        <td><span class="style21"><? echo $ccrow["Net_Salary"]; ?></span></td>
  </tr>
  <tr>
        <td><span class="style2"> Loan Amount: </span></td>
        <td><span class="style21"><? echo $ccrow["Loan_Amount"]; ?></span></td>
  </tr>
      <tr>
        <td><span class="style2">Comments: </span></td>
        <td><span class="style21"><? echo $ccrow["Add_Comment"]; ?></span></td>
     </tr>
	  <tr>
        <td><span class="style2">LMS Comments: </span></td>
        <td><span class="style21"><textarea rows="2" cols="15" name="comment_section"><? echo $ccrowfb["comment_section"]; ?></textarea></span></td>
     </tr>
	 <tr>
       <td><span class="style2">LMS feedback </span></td>
        <td><span class="style21"><select name="ccfeedback" id="ccfeedback">
		<option value="" <? if($Feedback == "") { echo "selected"; }?>>No Feedback</option>
		<option value="Ringing" <? if($Feedback == "Ringing") { echo "selected"; }?>>Ringing</option>
		<option value="Callback Later" <? if($Feedback == "Callback Later") { echo "selected"; }?>>Callback Later</option>
		<option value="Wrong Number" <? if($Feedback == "Wrong Number") { echo "selected"; }?>>Wrong Number</option>
		<option value="Not Eligible" <? if($Feedback == "Not Eligible") { echo "selected"; }?>>Not Eligible</option>
		<option value="FollowUp" <? if($Feedback == "FollowUp") { echo "selected"; }?>>FollowUp</option>
        <option value="Not Interested" <? if($Feedback == "Not Interested") { echo "selected"; }?>>Not Interested</option>
        
	<? if($bidderid==6116 || $bidderid==6117)  { ?>
	<option value="Appointment" <? if($Feedback == "Appointment") { echo "selected"; }?> >Appointment Made</option>
	<option value="Login" <? if($Feedback == "Login") { echo "selected"; }?> >Login</option>
	<option value="Approved" <? if($Feedback == "Approved") { echo "selected"; }?> >Approved</option>
	<option value="Disbursed" <? if($Feedback == "Disbursed") { echo "selected"; }?> >Disbursed</option>
	<option value="Rejected" <? if($Feedback == "Rejected") { echo "selected"; }?> >Rejected</option>
	<? }
	else
	{ ?>
	<option value="Appointment Made" <? if($Feedback == "Appointment Made") { echo "selected"; }?> >Appointment Made</option>
	<? }?>
	</select></span></td>
     </tr>
	
	 <tr>
	 <td class="fontstyle"><b>Follow Up Date</b></td>
	<td class="fontstyle"><input type="Text"  name="FollowupDate" id="FollowupDate" maxlength="25" size="15" <?php if($Followup_Date !='0000-00-00 00:00:00') { ?>value="<?php  echo $followup_date; ?>" <?php } ?>><a href="javascript:NewCal('FollowupDate','yyyymmdd',true,24)"><img src="images/cal.gif" width="16" height="16" border="0" alt="Pick a date"></a></td>
	 </tr>
     <tr>
        <td width="180"><span class="style2">Date of entry: </span></td>
        <td width="392"><span class="style21"><? echo $ccrowal["Allocation_Date"]; ?></span></td>
  </tr>
  <tr>
        <td width="180"><span class="style2">Customer IP: </span></td>
        <td width="392"><span class="style21"><? echo $ccrow["IP_Address"]; ?></span></td>
  </tr>
  <tr><td colspan="2" align="center"><input type="Submit" name="Submit" value="Submit"></td></tr>
  
</table>
</form>

</body>
</html>
