<?php
require 'scripts/session_check_online.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';

//error_reporting(E_ALL);
//ini_set('display_errors',1);

$showErrorMsg = 0;
if(isset($_REQUEST['Mobile']) && !empty($_REQUEST['Mobile']))
{
	$MaxCounter = 5;
	$Mobile = $_REQUEST['Mobile'];

	//Get total elements from csv
	$leadscount = substr_count($Mobile, ",");
	$totalelements = $leadscount + 1;
	
	if($totalelements <= $MaxCounter){

		$MobileTempArr = explode(",", $Mobile);
		
		foreach ($MobileTempArr as $value) {
			$MobileArr[] = trim($value);
		}
		
		$MobileStr = implode("','",$MobileArr);
	}
	else{
		$errorMsg = "Please enter maximum $MaxCounter numbers at a time";
		$showErrorMsg = 1;
	}
}

$sql= "";
$data = array();
if(!empty($MobileArr) && $showErrorMsg == 0){
	foreach($MobileArr as $mobileno){
		if(!empty($mobileno)){
			$sql = "SELECT substring_index(substring_index(request_xml, '<Mobile>', -1),'</Mobile>', 1) as Mobile, scc.RequestID, scc.LeadRefNumber, scc.ApplicationNumber, scc.StatusCode, scc.ProcessingStatus, scc.RequestID, scc.first_dated As punch_date, productflag FROM `sbi_credit_card_5633` AS scc HAVING scc.LeadRefNumber != '' AND Mobile LIKE '%".$mobileno."%' ORDER BY punch_date DESC LIMIT 0,1";
			$sqlResult = d4l_ExecQuery($sql);
			$row = d4l_mysql_fetch_assoc($sqlResult);
			$productflag = $row['productflag'];
			$RequestID = $row['RequestID'];
			
			/* Get Bidder Details Start */
			if($productflag == '4' || $productflag == '44'){
				$checkRequestIDSql = "SELECT RequestID FROM Req_Credit_Card_Sms WHERE UserID = '".$RequestID."'";
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
				$getBidderResult = d4l_ExecQuery($getBidderSql);
				$getBidderRes = d4l_mysql_fetch_assoc($getBidderResult);
				$BidderID = $getBidderRes['BidderID'];
				
				//Get User Details
				$getUserDetailsSql = "SELECT rcc.Name, rcc.IP_Address FROM `Req_Credit_Card` AS rcc WHERE rcc.`RequestID` = '".$RequestID."'";
				$getUserDetailsResult = d4l_ExecQuery($getUserDetailsSql);
				$getUserDetails = d4l_mysql_fetch_assoc($getUserDetailsResult);
				$Name = $getUserDetails['Name'];
				$IP_Address = $getUserDetails['IP_Address'];
			}
			elseif($productflag == '10'){
				$BidderID = '5923';
				
				//Get User Details
				$getUserDetailsSql = "SELECT scd.sbicc_name as Name, scd.IP_Address as IP_Address FROM `sbi_ccoffers_directonsite` AS scd WHERE scd.`sbiccoffersid` = '".$RequestID."'";
				$getUserDetailsResult = d4l_ExecQuery($getUserDetailsSql);
				$getUserDetails = d4l_mysql_fetch_assoc($getUserDetailsResult);
				$Name = $getUserDetails['Name'];
				$IP_Address = $getUserDetails['IP_Address'];
			}
			/* Get Bidder Details End */
			
			$row['Name'] = $Name;
			$row['IP_Address'] = $IP_Address;
			$row['BidderID'] = $BidderID;
			$row['RequestID_SMS'] = isset($SMS_RequestID)? $SMS_RequestID : '';
			$data[] = $row;
		}
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
		<a href="getUserDetailsSBI.php">Search Using LRN</a>
		<a href="convertcsvfiletostring.php" target="blank">Convert Csv File To String</a>
	</td>
</tr>
<tr>
    <td align="center">
	<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#45B2D8">
		<tr>
			<td>
				<form name="frmsearch" action="getUserDetailsSBI_Mobile.php" method="post">
					<div class="div-lead-left">
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr style="color: #FF0000;">
								<td colspan="2" align="center"><?php echo $errorMsg; ?></td>
							</tr>
							<tr>
								<td>&nbsp;</td>
							</tr>
							<tr>
								<td width="60%">
									<input type="text" name="Mobile" id="Mobile" style="width:80%; height:40px;" placeholder="Mobile No" value="<?php echo $Mobile; ?>">
								</td>
								<td width="20%">
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
			<td width="8%" align="center" bgcolor="#FFFFFF" class="style2"><?php echo $val['Mobile']; ?></td>
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
