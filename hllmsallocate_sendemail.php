<?php
require 'scripts/session_check_onlinelms.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';

$Email = $_REQUEST['Email'];
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

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	foreach($_POST as $a=>$b)
		$$a=$b;
	$SMSMessage = FixString($SMSMessage);
	$subjectline = FixString($subjectline);
	$toemailid = FixString($toemailid);
	$ccemailid = FixString($ccemailid);
	$Emailsave="To:".$toemailid." CC: ".$ccemailid;

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
				$strSQL="Update Req_Feedback_HL Set SentEmail=1 ,emailtext='".$SMSMessage."'";
				$strSQL=$strSQL." Where FeedbackID=".$row["FeedbackID"];
			}
			else
			{
				$strSQL="Insert into Req_Feedback_HL(AllRequestID, BidderID, Reply_Type , SentEmail, emailtext) Values (";
				$strSQL=$strSQL.$post.",".$bidid.",2,'1','".$SMSMessage."')";
			}
		}
		else{
			$result = ExecQuery("select FeedbackID from Req_Feedback where AllRequestID=".$post." and BidderID=".$bidid." AND Reply_Type=2");	
			$num_rows = mysql_num_rows($result);
			if($num_rows > 0)
			{
				$row = mysql_fetch_array($result);
				$strSQL="Update Req_Feedback Set SentEmail=1 ,emailtext='".$SMSMessage."'";
				$strSQL=$strSQL." Where FeedbackID=".$row["FeedbackID"];
			}
			else
			{
				$strSQL="Insert into Req_Feedback(AllRequestID, BidderID, Reply_Type , SentEmail, emailtext) Values (";
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
			$Msg = "** There was a problem in sending email.";
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
		$strfbSQL="Insert into feedback_bookkeeping(AllRequestID, BidderID, Reply_Type , Feedback, emailtext, leadidentifier, Comments, Dated) Values (";
		$strfbSQL=$strfbSQL.$post.",".$bidid.",2,'Email Sent','".$SMSMessage."','".$leadidentifier."', '".$Emailsave."',Now())";
		$fbresult = ExecQuery($strfbSQL);

		//send email
		$headers  = 'From: Deal4loans <homeloan@deal4loans.com>' . "\r\n";
		if(strlen($ccemailid)>1)
		{
			$headers .= "Cc: ".$ccemailid.""."\n";
		}
		$headers .= 'Bcc: testthankusenew@gmail.com' . "\r\n";
		$headers .= "Return-Path: <homeloan@deal4loans.com>\r\n";  // Return path for errors
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		//echo $Type_Loan;

		if(isset($toemailid) && isset($subjectline))
		{
			mail($toemailid,$subjectline, $SMSMessage, $headers);
		}
	}

	echo "<script>window.close()"."</script>";
}
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
<form name="sms_text" method="post" action="<? echo $_SERVER['PHP_SELF'] ?>?Email=<?echo $Email;?>&RequestID=<? echo urlencode($post);?>&Bidid=<? echo urlencode($bidid);?>">
	<table width="80%" cellpadding="1" height="50%" cellspacing="0" class="blueborder">
		<tr>
			<td colspan="2" align="center"><b>Email Message</b></td>
		</tr>
		<tr>
			<td class="bodyarial11">To Emailids (comma separated)</td>
			<td><textarea name="toemailid" rows="1" cols="100" id="toemailid" ><?php echo $Email; ?></textarea></td>
		</tr>
		<tr>
			<td class="bodyarial11">CC Emailids (comma separated)</td>
			<td><textarea name="ccemailid" rows="1" cols="100" id="ccemailid" ></textarea></td>
		</tr>
		<tr>
			<td class="bodyarial11">Subject Line</td>
			<td><textarea name="subjectline" rows="2" cols="100" id="subjectline" onKeyup="countit(displaycount)"></textarea></td>
		</tr>
		<tr>
			<td class="bodyarial11"><b>Email to send<br>character count(<input style="border:0px;" type="text" name="displaycount" size="1">)</b></td>
			<td class="bodyarial11"><textarea name="SMSMessage" rows="30" cols="100" id="SMSMessage" onKeyup="countit(displaycount)"></textarea></td>
		</tr>
		<tr>
			<td colspan="2" align="center"><input name="Submit" type="submit" class="bluebutton" value="Submit" border="0"></td>
		</tr>
	</table>
</form>


			
		
		


