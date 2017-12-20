<?php
require 'scripts/session_check_onlinelms.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';

$Phone = $_REQUEST['Mobile'];
$post = $_REQUEST['RequestID'];
$bidid =$_REQUEST['Bidid'];

//Check If Bidder is of 'hlallocatelms' GROUP
function getGroupBidders($bidid){
	$checkGroupQry = "SELECT * FROM Bidders WHERE BidderID = '".$bidid."' AND leadidentifier IN ('hlallocatelms')";
	$checkGroupResult = ExecQuery($checkGroupQry);
	$checkGroupCount = mysql_num_rows($checkGroupResult);
	return $checkGroupCount;
}

$checkGroupBidders = getGroupBidders($bidid);

if($post>0 && $Phone>0)
{
	$hlleadresult = ExecQuery("select Name,Loan_Amount,Net_Salary,checked_bidders from  Req_Loan_Home where RequestID='".$post."' and Mobile_Number=".$Phone." ");	
	$leadrow = mysql_fetch_array($hlleadresult);
	$Name = $leadrow["Name"];
	$LoanAmount = $leadrow["Loan_Amount"];
	$AnnualIncome = $leadrow["Net_Salary"];
	$SelectedBank = $leadrow["checked_bidders"];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	foreach($_POST as $a=>$b)
		$$a=$b;
	$smsnumber = FixString($smsnumber);
	$SMSMessage = FixString($SMSMessage);
	$smsnumberarr=explode(",",$smsnumber);

	if(strlen(trim($SMSMessage))>0)
	{
		$strSQL="";
		$Msg="";
		if($checkGroupBidders){
			$result = ExecQuery("select FeedbackID from Req_Feedback_HL where AllRequestID=".$post." and BidderID=".$bidid." AND Reply_Type=2");	
			$num_rows = mysql_num_rows($result);
			if($num_rows > 0)
			{
				$row = mysql_fetch_array($result);
				$strSQL="Update Req_Feedback_HL Set SmsSent=1 ,smstext='".$SMSMessage."'";
				$strSQL=$strSQL." Where FeedbackID=".$row["FeedbackID"];
			}
			else
			{
				$strSQL="Insert into Req_Feedback_HL(AllRequestID, BidderID, Reply_Type , SmsSent, smstext) Values (";
				$strSQL=$strSQL.$post.",".$bidid.",2,'1','".$SMSMessage."')";
			}
		}
		else{
			$result = ExecQuery("select FeedbackID from Req_Feedback where AllRequestID=".$post." and BidderID=".$bidid." AND Reply_Type=2");	
			$num_rows = mysql_num_rows($result);
			if($num_rows > 0)
			{
				$row = mysql_fetch_array($result);
				$strSQL="Update Req_Feedback Set SmsSent=1 ,smstext='".$SMSMessage."'";
				$strSQL=$strSQL." Where FeedbackID=".$row["FeedbackID"];
			}
			else
			{
				$strSQL="Insert into Req_Feedback(AllRequestID, BidderID, Reply_Type , SmsSent, smstext) Values (";
				$strSQL=$strSQL.$post.",".$bidid.",2,'1','".$SMSMessage."')";
			}
		}
		//echo $strSQL;
		$result = ExecQuery($strSQL);
		if ($result == 1)
		{
		}
		else
		{
			$Msg = "** There was a problem in sending SMS. Please try again.";
		}

		// feedback book keeping
		if($checkGroupBidders){
			$leadidentifier = 'hlallocatelms';
		}
		else{
			$leadidentifier = '';
		}
		$strfbSQL="";
		$Msg="";
		$strfbSQL="Insert into feedback_bookkeeping(AllRequestID, BidderID, Reply_Type, Feedback, smstext, leadidentifier, Comments, Dated) Values (";
		$strfbSQL=$strfbSQL.$post.",".$bidid.",2,'Sms Sent','".$SMSMessage."','".$leadidentifier."', '".$smsnumber."',Now())";
		$fbresult = ExecQuery($strfbSQL);
	}

	if(count($smsnumberarr)>0)
	{
		for($bfs=0; $bfs<count($smsnumberarr);$bfs++)
		{
			$strmobile_no = $smsnumberarr[$bfs];
			if(strlen(trim($strmobile_no)) > 0)
			{
				SendSMSforLMS($SMSMessage, $strmobile_no);
			}
		}
	}
	//echo "<script>window.close()"."</script>";
}
$currentdate=date('d-m-Y');
?>
<style>
.bluebutton {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
	color: blue;
	font-weight: bold;
}
.bodyarial11 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	color: #333333;
	text-decoration: none;
}
.blueborder {
	border: 1px solid #529BE4;
}
.head2 {
	font-family: Century Gothic;
	font-size: 18px;
	color:0F74D4;
	text-decoration: none;
	font-weight: bold;
}
</style>
<script>
function countit(what){

//Character count script
formcontent=what.form.SMSMessage.value
what.form.displaycount.value=formcontent.length
}
</script>
<form name="sms_text" method="post" action="<? echo $_SERVER['PHP_SELF'] ?>?Mobile=<?echo $Phone;?>&RequestID=<? echo urlencode($post);?>&Bidid=<? echo urlencode($bidid);?>">
	<table width="80%" cellpadding="1" height="50%" cellspacing="0" class="blueborder">
		<tr>
			<td colspan="2" align="center"><b>SMS Message</b></td>
		</tr>
		<tr>
			<td class="bodyarial11"><b>number to send sms (add comma separated number)</b></td>
			<td class="bodyarial11"><input type="text" name="smsnumber" id="smsnumber" value="<?php echo $Phone; ?>"></td>
		</tr>
		<tr>
			<td class="bodyarial11"><b>Message for Sms(Should not exceed 160 characters)<br>character count(<input style="border:0px;" type="text" name="displaycount" size="1">)</b></td>
			<td class="bodyarial11">
				<textarea name="SMSMessage" rows="2" cols="50" id="SMSMessage" onKeyup="countit(displaycount)">Your Home loan Leads on (<?php echo $currentdate; ?>) : (1) <?php echo $Name; ?> - <?php echo $Phone; ?>, sal- <?php echo $AnnualIncome; ?>, loan amt- <?php echo $LoanAmount; ?>, property type flat, Selected Bank- <?php echo $SelectedBank; ?></textarea>
			</td>
		</tr>
		<tr>
			<td colspan="2" align="center"><input name="Submit" type="submit" class="bluebutton" value="Submit" border="0"></td>
		</tr>
	</table>
</form>


			
		
		


