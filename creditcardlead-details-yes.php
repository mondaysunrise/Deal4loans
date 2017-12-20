<?php
require 'scripts/session_check_online.php';
require 'scripts/db_init.php';

$requestid = $_REQUEST["postid"];
$bidderid = $_REQUEST["biddt"];

$pro_code = 4;

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	foreach($_POST as $a=>$b)
		$$a=$b;
	$comment_section = $_POST["comment_section"];
	$feedback = $_POST["feedback"];

	$strSQL = "";
	$checkFeedbackSql = "SELECT FeedbackID FROM Req_Feedback WHERE AllRequestID='".$requestid."' AND BidderID='".$bidderid."'";
	$checkFeedbackResult = d4l_ExecQuery($checkFeedbackSql);
	$feedback_num_rows = d4l_mysql_num_rows($checkFeedbackResult);
	$currentdate = date('Y-m-d H:i:s');
	if($feedback_num_rows > 0){
		$checkFeedbackResponse = d4l_mysql_fetch_assoc($checkFeedbackResult);
		$strSQL = "UPDATE Req_Feedback SET Feedback='".$feedback."', comment_section='".$comment_section."', last_update_dated='".$currentdate."'";
		$strSQL .= " Where FeedbackID='".$checkFeedbackResponse["FeedbackID"]."'";
	}
	else{
		$strSQL = "INSERT INTO Req_Feedback(AllRequestID, BidderID, Reply_Type , Feedback, comment_section, last_update_dated) VALUES (";
		$strSQL .= $RequestID.", ".$BidderIDstatic.", ".$pro_code.", '".$feedback."', '".$comment_section."', '".$currentdate."')";
	}
	$updateFeedbackResult = d4l_ExecQuery($strSQL);
}

$getDetailSql = "SELECT Name, Mobile_Number, DOB, Email, City, State, Pincode, Residence_Address, Pancard, IF(Gender=1,'Male', 'Female') as Gender, Allocation_Date, Net_Salary, Company_Name, IF(Employment_Status=1,'Salaried', 'Self Employed') as Employment_Status, CC_Holder, Card_Vintage, IP_Address, Feedback, comment_section FROM Req_Credit_Card as rcc JOIN Req_Feedback_Bidder_CC as rfcc ON (rfcc.AllRequestID = rcc.RequestID AND rfcc.BidderID = '".$bidderid."') LEFT JOIN Req_Feedback as rf ON (rf.AllRequestID = rcc.RequestID AND rf.BidderID = '".$bidderid."') WHERE rfcc.Reply_Type = 4 AND rcc.RequestID='".$requestid."'";
//echo $getDetailSql;exit;
$getDetailResult = d4l_ExecQuery($getDetailSql);
$getDetailResponse = d4l_mysql_fetch_array($getDetailResult);

$Feedback = $getDetailResponse["Feedback"];

if($getDetailResponse["CC_Holder"]==1){
	$cc_holder="Yes";
}
if($getDetailResponse["CC_Holder"]==0){
	$cc_holder="No";
}

if($getDetailResponse["Card_Vintage"]==1){
	$card_vintage="Less than 6 months";
}
elseif($getDetailResponse["Card_Vintage"]==2){
	$card_vintage="6 to 9 months";
}
elseif($getDetailResponse["Card_Vintage"]==3){
	$card_vintage="9 to 12 months";
}
elseif($getDetailResponse["Card_Vintage"]==4){
	$card_vintage="more than 12 months";
}
else{
	$card_vintage="";
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Credit Card</title>
<style type="text/css">
<!--
.style2 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold;}
.style21 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size:12px;}
-->
</style>

</head>
<body>
	<form name="loan_form" method="post" action="<? echo $_SERVER['PHP_SELF'] ?>?postid=<?echo $requestid;?>&biddt=<? echo $bidderid;?>" >
	<table style='border:1px dotted #9C9A9C;' cellspacing="2" cellpadding="5" width="600" height="80%" align="center" border="0" >
		<tr>
			<td colspan="2" align="center" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold;">Credit Card customer details</td>
		</tr>
		<tr>
			<td><span class="style2">Customer Name: </span></td>
			<td><span class="style21"><? echo $getDetailResponse["Name"]; ?></span></td>
		</tr>
		<tr>
			<td><span class="style2"> DOB: </span></td>
			<td><span class="style21"><? echo $getDetailResponse["DOB"]; ?></span></td>
		</tr>
		<tr>
			<td><span class="style2"> Email: </span></td>
			<td><span class="style21"><? echo $getDetailResponse["Email"]; ?></span></td>
		</tr>
		<tr>
			<td><span class="style2"> Mobile No: </span></td>
			<td><span class="style21"><? echo $getDetailResponse["Mobile_Number"]; ?></span></td>
		</tr>
		<tr>
			<td><span class="style2"> Gender: </span></td>
			<td><span class="style21"><? echo $getDetailResponse["Gender"]; ?></span></td>
		</tr>
		<tr>
			<td><span class="style2"> Occupation: </span></td>
			<td><span class="style21"><? echo $getDetailResponse["Employment_Status"]; ?></span></td>
		</tr>
		<tr>
			<td><span class="style2"> Company Name: </span></td>
			<td><span class="style21"><? echo $getDetailResponse["Company_Name"]; ?></span></td>
		</tr>
		<tr>
			<td><span class="style2">Residence Address </span></td>
			<td><span class="style21"><? echo $getDetailResponse["Residence_Address"]; ?></span></td>
		</tr>
		<tr>
			<td><span class="style2"> City: </span></td>
			<td><span class="style21"><? echo $getDetailResponse["City"]; ?></span></td>
		</tr>
		<tr>
			<td><span class="style2"> State: </span></td>
			<td><span class="style21"><? echo $getDetailResponse["State"]; ?></span></td>
		</tr>
		<tr>
			<td><span class="style2"> Pincode: </span></td>
			<td><span class="style21"><? echo $getDetailResponse["Pincode"]; ?></span></td>
		</tr>
		<tr>
			<td><span class="style2"> Card Holder: </span></td>
			<td><span class="style21"><? echo $cc_holder; ?></span></td>
		</tr>
		<tr>
			<td><span class="style2"> Card Vintage: </span></td>
			<td><span class="style21"><? echo $card_vintage; ?></span></td>
		</tr>
		<tr>
			<td><span class="style2"> Annual Income: </span></td>
			<td><span class="style21"><? echo $getDetailResponse["Net_Salary"]; ?></span></td>
		</tr>
		<tr>
			<td><span class="style2">Pancard </span></td>
			<td><span class="style21"><? echo $getDetailResponse["Pancard"]; ?></span></td>
		</tr>
		<tr>
			<td><span class="style2">Date of entry: </span></td>
			<td><span class="style21"><? echo $getDetailResponse["Allocation_Date"]; ?></span></td>
		</tr>
		<tr>
			<td><span class="style2">Customer IP: </span></td>
			<td><span class="style21"><? echo $getDetailResponse["IP_Address"]; ?></span></td>
		</tr>
		<tr>
			<td><span class="style2">Add Comment: </span></td>
			<td><span class="style21">
				<textarea rows="2" cols="15" name="comment_section" id="comment_section"><? echo $getDetailResponse["comment_section"]; ?></textarea></span>
			</td>
		</tr>
		<tr>
			<td><span class="style2">Feedback: </span></td>
			<td><span class="style21">
				<select name="feedback" id="feedback">
					<option value="All" <? if ($Feedback == "All") {echo "selected";} ?>>All</option>
					<option value="" <? if ($Feedback == "") {echo "selected";} ?>>New lead</option>
					<option value="Not Interested" <? if ($Feedback == "Not Interested") {echo "selected";} ?>>Not Interested</option>
					<option value="Not Contactable" <? if ($Feedback == "Not Contactable") {echo "selected";} ?>>Not Contactable</option>
					<option value="FollowUp" <? if ($Feedback == "FollowUp") {echo "selected";} ?>>FollowUp</option>
					<option value="Not Eligible" <? if ($Feedback == "Not Eligible") {echo "selected";} ?>>Not Eligible</option>
					<option value="Appointment" <? if ($Feedback == "Appointment") {echo "selected";} ?>>Lead generated & appointment fixed</option>
					<option value="Documents Pick" <? if ($Feedback == "Documents Pick") {echo "selected";} ?>>Documents Pick</option>
					<option value="Docs collected" <? if ($Feedback == "Docs collected") {echo "selected";} ?>>Docs collected</option>
					<option value="DIP OK" <? if ($Feedback == "DIP OK") {echo "selected";} ?>>DIP OK</option>
					<option value="DIP curable" <? if ($Feedback == "DIP curable") {echo "selected";} ?>>DIP curable</option>
					<option value="DIP Reject" <? if ($Feedback == "DIP Reject") {echo "selected";} ?>>DIP Reject</option>
					<option value="Sales decline" <? if ($Feedback == "Sales decline") {echo "selected";} ?>>Sales decline</option>
					<option value="Prime approved" <? if ($Feedback == "Prime approved") {echo "selected";} ?>>Prime approved</option>
					<option value="Prime decline" <? if ($Feedback == "Prime decline") {echo "selected";} ?>>Prime decline</option>
					<option value="Prime Curable" <? if ($Feedback == "Prime Curable") {echo "selected";} ?>>Prime Curable</option>
					<option value="Ringing" <? if ($Feedback == "Ringing") {echo "selected";} ?>>Ringing</option>
					<option value="Callback Later" <? if ($Feedback == "Callback Later") {echo "selected";} ?>>Callback Later</option>
					<option value="Wrong Number" <? if ($Feedback == "Wrong Number") {echo "selected";} ?>>Wrong Number</option>
					<option value="Process" <? if ($Feedback == "Process" || $Feedback == "Login") {echo "selected";} ?>>Process</option>
					<option value="Closed" <? if ($Feedback == "Closed" || $Feedback == "Disbursed") {echo "selected";} ?>>Closed</option>
					<option value="Not Available" <? if ($Feedback == "Not Available") {echo "selected";} ?>>Not Available</option>
				</select></span>
			</td>
		</tr>
		<tr>
			<td colspan="2" align="center">
				<input type="Submit" name="Submit" value="Submit" />
			</td>
		</tr>
	</table>
	</form>
</body>
</html>
