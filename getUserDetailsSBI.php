<?php
require 'scripts/session_check_online.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';

//error_reporting(E_ALL);
//ini_set('display_errors',1);
$leadscount = 0;
$referencescount = 0;
$applicationscount = 0;
$totalelements = 0;
$RequestID="";
$ReferenceNo="";
$ApplicationNo="";
$showErrorMsg = 0;

//Get details of counter from database
/*
Sms_Flag -> Max records in one time(40)
BidderID -> Max records in one day(400)
RequestID -> Max records in one month(2000)
Mobile_no -> Month number
Start_Date -> Date
Sequence_no -> Day Counter
Priority -> Month counter 
*/
$counterDetailsQry = "SELECT * FROM `Req_Compaign` WHERE `Compaign_ID` = 7128";
$counterDetailsResult = d4l_ExecQuery($counterDetailsQry);
$counterDetailsResponse = d4l_mysql_fetch_assoc($counterDetailsResult);
$MaxCounter = $counterDetailsResponse['Sms_Flag'];
$DayMaxCounter = $counterDetailsResponse['BidderID'];
$MonthMaxCounter = $counterDetailsResponse['RequestID'];
$Start_Date = $counterDetailsResponse['Start_Date'];
$CounterMonth = $counterDetailsResponse['Mobile_no'];
$DayTotal = $counterDetailsResponse['Sequence_no'];
$MonthTotal = $counterDetailsResponse['priority'];

//echo $MonthMaxCounter.'-'.$MonthTotal.'<br>';


if(isset($_REQUEST['RequestID']) && !empty($_REQUEST['RequestID']))
{
	$RequestID = $_REQUEST['RequestID'];

	//Get total elements from csv
	$leadscount = substr_count($RequestID, ",");
	$totalelements = $leadscount + 1;
	
	if($totalelements <= $MaxCounter){
		if(strpos($RequestID, 'D4L') !== false){
			$NewRequestID = str_replace('D4L', '', $RequestID);
		}else{
			$NewRequestID = $RequestID;
		}

		$RequestIDTempArr = explode(",", $NewRequestID);
		
		foreach ($RequestIDTempArr as $value) {
			$RequestIDArr[] = trim($value);
		}
		
		$RequestIDStr = implode("','",$RequestIDArr);
	}
	else{
		$errorMsg = "Please enter maximum $MaxCounter numbers at a time";
		$showErrorMsg = 1;
	}
}
elseif(isset($_REQUEST['ReferenceNo']) && !empty($_REQUEST['ReferenceNo']))
{
	$ReferenceNo=$_REQUEST['ReferenceNo'];
	
	//Get total elements from csv
	$referencescount = substr_count($ReferenceNo, ",");
	$totalelements = $referencescount + 1;
	
	if($totalelements <= $MaxCounter){
		$ReferenceNoTempArr = explode(",", $ReferenceNo);
		
		foreach ($ReferenceNoTempArr as $value) {
			$ReferenceNoArr[] = trim($value);
		}
		
		$ReferenceNoStr = implode("','",$ReferenceNoArr);
	}
	else{
		$errorMsg = "Please enter maximum $MaxCounter numbers at a time";
		$showErrorMsg = 1;
	}
}
elseif(isset($_REQUEST['ApplicationNo']) && !empty($_REQUEST['ApplicationNo']))
{
	$ApplicationNo=$_REQUEST['ApplicationNo'];
	
	//Get total elements from csv
	$applicationscount = substr_count($ApplicationNo, ",");
	$totalelements = $applicationscount + 1;
	
	if($totalelements <= $MaxCounter){
		$ApplicationNoTempArr = explode(",", $ApplicationNo);
		
		foreach ($ApplicationNoTempArr as $value) {
			$ApplicationNoArr[] = trim($value);
		}
		
		$ApplicationNoStr = implode("','",$ApplicationNoArr);
	}
	else{
		$errorMsg = "Please enter maximum $MaxCounter numbers at a time";
		$showErrorMsg = 1;
	}
}


//Update Counters
$currentDate = date('Y-m-d');
$currentMonth = date('m');

if($showErrorMsg != 1){
	if($currentMonth != $CounterMonth){
		//Update counter values and date values
		$updateMonthSql = "UPDATE Req_Compaign SET Start_Date = '".$currentDate."', Mobile_no = '".$currentMonth."', Sequence_no = 0, priority = 0 WHERE Compaign_ID = '7128'";
		$updateMonthResult = d4l_ExecQuery($updateMonthSql);
	}
	else{
		$allowedTotal = $MonthMaxCounter - $MonthTotal;
		//echo $allowedTotal.'<br>';
		if($MonthTotal >= $MonthMaxCounter){
			$showErrorMsg = 2;
			$errorMsg = "Maximum Limit exceeded for this month";
		}
		elseif($totalelements > $allowedTotal){
			$showErrorMsg = 2;
			$errorMsg = "You can search only $allowedTotal records for this month. Limit Exceeded";
		}
		else{
			if($currentDate != $Start_Date){
				//Update counter values and date values
				$updateDateSql = "UPDATE Req_Compaign SET Start_Date = '".$currentDate."', Sequence_no = 0 WHERE Compaign_ID = '7128'";
				$updateDateResult = d4l_ExecQuery($updateDateSql);
			}
			else{
				$allowedDateTotal = $DayMaxCounter - $DayTotal;
				//echo $allowedDateTotal.'<br>';
				if($DayTotal >= $DayMaxCounter){
					$showErrorMsg = 2;
					$errorMsg = "Maximum Limit exceeded for the day";
				}
				elseif($totalelements > $allowedDateTotal){
					$showErrorMsg = 2;
					$errorMsg = "You can search only $allowedDateTotal records for now. Limit Exceeded";
				}
				else{
					$updateCounterSql = "UPDATE Req_Compaign SET Sequence_no = Sequence_no + '".$totalelements."', priority = priority + '".$totalelements."' WHERE Compaign_ID = '7128'";
					$updateCounterResult = d4l_ExecQuery($updateCounterSql);
				}
			}
		}
	}
}


$tableIdentifier = isset($_REQUEST['tableIdentifier']) ? $_REQUEST['tableIdentifier'] : 'product';

$sql= "";
$data = array();
if(!empty($RequestIDStr)){
	if($tableIdentifier == 'product'){
		$sql = "SELECT scc.LeadRefNumber, scc.ApplicationNumber, scc.StatusCode, scc.ProcessingStatus, scc.RequestID, rcc.Name, rcc.Mobile_Number, rcc.IP_Address, scc.first_dated As punch_date FROM `Req_Credit_Card` AS rcc JOIN `sbi_credit_card_5633` AS scc ON (rcc.RequestID = scc.RequestID AND scc.LeadRefNumber != '') WHERE rcc.`RequestID` IN ('".$RequestIDStr."') AND productflag != 10 GROUP BY scc.RequestID";
	}
	else{
		$sql = "SELECT scc.LeadRefNumber, scc.ApplicationNumber, scc.StatusCode, scc.ProcessingStatus, scc.RequestID, scd.sbicc_name as Name, scd.sbicc_mobile As Mobile_Number, scd.IP_Address as IP_Address, scc.first_dated As punch_date FROM `sbi_ccoffers_directonsite` AS scd JOIN `sbi_credit_card_5633` AS scc ON (scd.sbiccoffersid = scc.RequestID AND scc.LeadRefNumber != '') WHERE scd.`sbiccoffersid` IN ('".$RequestIDStr."') AND productflag = 10 GROUP BY scc.RequestID";
	}
}
elseif(!empty($ReferenceNoStr)){
	if($tableIdentifier == 'product'){
		$sql = "SELECT scc.LeadRefNumber, scc.ApplicationNumber, scc.StatusCode, scc.ProcessingStatus, scc.RequestID, rcc.Name, rcc.Mobile_Number, rcc.IP_Address, scc.first_dated As punch_date FROM `sbi_credit_card_5633` AS scc LEFT JOIN Req_Credit_Card AS rcc ON (rcc.RequestID = scc.RequestID) WHERE scc.LeadRefNumber IN ('".$ReferenceNoStr."') GROUP BY scc.RequestID";
	}
	else{
		$sql = "SELECT scc.LeadRefNumber, scc.ApplicationNumber, scc.StatusCode, scc.ProcessingStatus, scc.RequestID, scd.sbicc_name as Name, scd.sbicc_mobile As Mobile_Number, scd.IP_Address as IP_Address, scc.first_dated As punch_date FROM `sbi_credit_card_5633` AS scc LEFT JOIN `sbi_ccoffers_directonsite` AS scd ON (scd.sbiccoffersid = scc.RequestID) WHERE scc.LeadRefNumber IN ('".$ReferenceNoStr."') GROUP BY scc.RequestID";
	}
}
elseif(!empty($ApplicationNoStr)){
	if($tableIdentifier == 'product'){
		$sql = "SELECT scc.LeadRefNumber, scc.ApplicationNumber, scc.StatusCode, scc.ProcessingStatus, scc.RequestID, rcc.Name, rcc.Mobile_Number, rcc.IP_Address, scc.first_dated As punch_date FROM `sbi_credit_card_5633` AS scc LEFT JOIN Req_Credit_Card AS rcc ON (rcc.RequestID = scc.RequestID) WHERE scc.ApplicationNumber IN ('".$ApplicationNoStr."') GROUP BY scc.RequestID";
	}
	else{
		$sql = "SELECT scc.LeadRefNumber, scc.ApplicationNumber, scc.StatusCode, scc.ProcessingStatus, scc.RequestID, scd.sbicc_name as Name, scd.sbicc_mobile As Mobile_Number, scd.IP_Address as IP_Address, scc.first_dated As punch_date FROM `sbi_credit_card_5633` AS scc LEFT JOIN `sbi_ccoffers_directonsite` AS scd ON (scd.sbiccoffersid = scc.RequestID) WHERE scc.ApplicationNumber IN ('".$ApplicationNoStr."') GROUP BY scc.RequestID";
	}
}
//echo $sql.'<br>';

if(!empty($sql) && $showErrorMsg == 0){
	$sqlResult = d4l_ExecQuery($sql);
	while($row = d4l_mysql_fetch_assoc($sqlResult)){
		/* Get Bidder Details Start */
		if($tableIdentifier == 'product'){
			$checkRequestIDSql = "SELECT RequestID FROM Req_Credit_Card_Sms WHERE UserID = '".$row['RequestID']."'";
			//echo $checkRequestIDSql.'<br>';
			$checkRequestIDResult = d4l_ExecQuery($checkRequestIDSql);
			$checkRequestIDRow = d4l_mysql_num_rows($checkRequestIDResult);
			$SMS_RequestID = '';
			if($checkRequestIDRow){
				$getRequestIDRes = d4l_mysql_fetch_assoc($checkRequestIDResult);
				$SMS_RequestID = $getRequestIDRes['RequestID'];
				$getBidderSql = "SELECT la.BidderID FROM lead_allocate as la LEFT JOIN Bidders as bid ON(la.BidderID = bid.BidderID) WHERE la.AllRequestID = '".$SMS_RequestID."' AND la.Reply_Type = 4 AND bid.leadidentifier IN ('diallerleadccsmsnew','diallercallerccpredictive','sbicallerdigilms_cc') ORDER BY leadid DESC LIMIT 0,1";
			}
			else{
				$getBidderSql = "SELECT la.BidderID FROM lead_allocate as la LEFT JOIN Bidders as bid ON(la.BidderID = bid.BidderID) WHERE la.AllRequestID = '".$row['RequestID']."' AND la.Reply_Type = 4 AND bid.leadidentifier IN ('diallerleadcc','rblcallerlms_cc','rblcallerinternallms_cc','amercianexpresscallerlms_cc','amercianexpressinternalcallerlms_cc','sbicallerlms_cc', 'icicibankcallerlms_cc', 'scbbankcallerlms_cc', 'CCTRANSFER2CALLER') ORDER BY leadid DESC LIMIT 0,1";
			}
			//echo $getBidderSql.'<br>';
			$getBidderResult = d4l_ExecQuery($getBidderSql);
			$getBidderRes = d4l_mysql_fetch_assoc($getBidderResult);
			$BidderID = $getBidderRes['BidderID'];
		}
		else{
			$BidderID = '5923';
		}
		/* Get Bidder Details End */
		
		$row['BidderID'] = $BidderID;
		$row['RequestID_SMS'] = isset($SMS_RequestID)? $SMS_RequestID : '';
		$data[] = $row;
	}
}
//echo '<pre>';print_r($data);

?>
<html>
<head>
</head>
<body>
<table width="100%" border="0"  align="center" cellpadding="0" cellspacing="0" >
<tr>
	<td align="right">
		<a href="/callinglms/cc_lms_dashboard_sbi.php">Dashboard</a>
		<a href="getUserDetailsSBI_Mobile.php">Search Using Mobile</a>
		<a href="convertcsvfiletostring.php" target="blank">Convert Csv File To String</a>
	</td>
</tr>
<tr>
    <td align="center">
	<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#45B2D8">
		<tr>
			<td>
				<form name="frmsearch" action="getUserDetailsSBI.php" method="post">
					<div class="div-lead-left">
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr style="color: #FF0000;">
								<td colspan="5" align="center"><?php echo $errorMsg; ?></td>
							</tr>
							<tr>
								<td>&nbsp;</td>
							</tr>
							<tr>
								<td width="23%">
									<input type="text" name="RequestID" id="RequestID" style="width:80%; height:40px;" placeholder="RequestID" value="<?php echo $RequestID; ?>">
								</td>
								<td width="23%">
									<input type="text" name="ReferenceNo" id="ReferenceNo" style="width:80%; height:40px;" placeholder="ReferenceNo" value="<?php echo $ReferenceNo; ?>">
								</td>
								<td width="23%">
									<input type="text" name="ApplicationNo" id="ApplicationNo" style="width:80%; height:40px;" placeholder="ApplicationNo" value="<?php echo $ApplicationNo; ?>">
								</td>
								<td width="23%">
									<select name="tableIdentifier" id="tableIdentifier" style="width:80%; height:40px;">
										<option value="product">Product</option>
										<option value="twowheeler">Two Wheeler</option>
									</select>
								</td>
								<td width="12%">
									<input type="submit" name="Submit" style="width:80%; height:40px;" border="1">
								</td>
							</tr>
						</table>
					</div>
					<div style="clear:both;"></div>
				</form>
			</td>
		</tr>
	</table>
	<?php
	if(count($data)){
	?>
	<table width="100%" border="1" align="center" cellpadding="1" cellspacing="1" bgcolor="#FFFFFF" >
		<tr>
			<td width="8%" align="center" bgcolor="#FFFFFF" class="style2">RequestID</td>
			<td width="8%" align="center" bgcolor="#FFFFFF" class="style2">RequestID_SMS</td>
			<td width="15%" align="center" bgcolor="#FFFFFF" class="style2">LeadRefNumber</td>
			<td width="15%" align="center" bgcolor="#FFFFFF" class="style2">ApplicationNumber</td>
			<td width="8%" align="center" bgcolor="#FFFFFF" class="style2">ProcessingStatus</td>
			<td width="15%" align="center" bgcolor="#FFFFFF" class="style2">Name</td>
			<td width="8%" align="center" bgcolor="#FFFFFF" class="style2">MobileNumber</td>
			<td width="8%" align="center" bgcolor="#FFFFFF" class="style2">IPAddress</td>
			<td width="5%" align="center" bgcolor="#FFFFFF" class="style2">BidderID</td>
			<td width="10%" align="center" bgcolor="#FFFFFF" class="style2">PunchDate</td>
		</tr>
		<?php
		foreach($data as $key=>$val){
		?>
		<tr>
			<td width="8%" align="center" bgcolor="#FFFFFF" class="style2"><?php echo $val['RequestID']; ?></td>
			<td width="8%" align="center" bgcolor="#FFFFFF" class="style2"><?php echo $val['RequestID_SMS']; ?></td>
			<td width="15%" align="center" bgcolor="#FFFFFF" class="style2"><?php echo $val['LeadRefNumber']; ?></td>
			<td width="15%" align="center" bgcolor="#FFFFFF" class="style2"><?php echo $val['ApplicationNumber']; ?></td>
			<td width="8%" align="center" bgcolor="#FFFFFF" class="style2"><?php echo $val['ProcessingStatus']; ?></td>
			<td width="15%" align="center" bgcolor="#FFFFFF" class="style2"><?php echo $val['Name']; ?></td>
			<td width="8%" align="center" bgcolor="#FFFFFF" class="style2"><?php echo $val['Mobile_Number']; ?></td>
			<td width="8%" align="center" bgcolor="#FFFFFF" class="style2"><?php echo $val['IP_Address']; ?></td>
			<td width="5%" align="center" bgcolor="#FFFFFF" class="style2"><?php echo $val['BidderID']; ?></td>
			<td width="10%" align="center" bgcolor="#FFFFFF" class="style2"><?php echo $val['punch_date']; ?></td>
		</tr>
		<?php
		}
		?>
	</table>
		<?php
	}
	else{
	?>
	<p class="bodyarial11">No Record Found</p>
	<?php
	}
	?>
	</td>
</tr>
</table>
</body>
</html>
