<?php
require 'scripts/db_init.php';
require 'scripts/functions.php';

error_reporting(E_ALL);
ini_set('display_errors',1);

$PAN = !empty($_REQUEST['PAN']) ? $_REQUEST['PAN'] : '';
$Mobile = !empty($_REQUEST['Mobile']) ? $_REQUEST['Mobile'] : '';
$tableIdentifier = isset($_REQUEST['tableIdentifier']) ? $_REQUEST['tableIdentifier'] : 'product';
$errorMsg = '';

$data = array();

if(empty($PAN) && empty($Mobile)){
	$errorMsg = 'Please enter values.';
}
else{
	$sql= '';
	$data = array();
	if(!empty($PAN)){
		if($tableIdentifier == 'product'){
			$sql = "SELECT ccba.cc_requestid, rcc.Name, rcc.Mobile_Number, rcc.IP_Address, ccba.last_updated As punch_date, substring_index(substring_index(response_data,'<approved>',-1), '</approved>', 1) as approved, 
			substring_index(substring_index(response_data,'<decline>',-1), '</decline>', 1) as decline,
			substring_index(substring_index(response_data,'<pending>',-1), '</pending>', 1) as pending,
			substring_index(substring_index(response_data,'<cancelled>',-1), '</cancelled>', 1) as cancelled FROM credit_card_banks_apply AS ccba JOIN Req_Credit_Card AS rcc ON (rcc.RequestID = ccba.cc_requestid) WHERE ccba.applied_bankname = 'American Express' AND ccba.request_data LIKE '%".$PAN."%' GROUP BY ccba.cc_requestid";
		}
		else{
			$sql = "SELECT ccba.cc_requestid, scd.sbicc_name as Name, scd.sbicc_mobile As Mobile_Number, scd.IP_Address as IP_Address, ccba.last_updated As punch_date, substring_index(substring_index(response_data,'<approved>',-1), '</approved>', 1) as approved, 
			substring_index(substring_index(response_data,'<decline>',-1), '</decline>', 1) as decline,
			substring_index(substring_index(response_data,'<pending>',-1), '</pending>', 1) as pending,
			substring_index(substring_index(response_data,'<cancelled>',-1), '</cancelled>', 1) as cancelled FROM credit_card_banks_apply AS ccba JOIN sbi_ccoffers_directonsite AS scd ON (scd.sbiccoffersid = ccba.cc_requestid) WHERE ccba.applied_bankname = 'American Express' AND ccba.request_data LIKE '%".$PAN."%' GROUP BY ccba.cc_requestid";
		}
	}
	if(!empty($Mobile)){
		if($tableIdentifier == 'product'){
			$sql = "SELECT ccba.cc_requestid, rcc.Name, rcc.Mobile_Number, rcc.IP_Address, ccba.last_updated As punch_date, substring_index(substring_index(response_data,'<approved>',-1), '</approved>', 1) as approved, 
			substring_index(substring_index(response_data,'<decline>',-1), '</decline>', 1) as decline,
			substring_index(substring_index(response_data,'<pending>',-1), '</pending>', 1) as pending,
			substring_index(substring_index(response_data,'<cancelled>',-1), '</cancelled>', 1) as cancelled FROM credit_card_banks_apply AS ccba JOIN Req_Credit_Card AS rcc ON (rcc.RequestID = ccba.cc_requestid) WHERE ccba.applied_bankname = 'American Express' AND ccba.request_data LIKE '%".$Mobile."%' GROUP BY ccba.cc_requestid";
		}
		else{
			$sql = "SELECT ccba.cc_requestid, scd.sbicc_name as Name, scd.sbicc_mobile As Mobile_Number, scd.IP_Address as IP_Address, ccba.last_updated As punch_date, substring_index(substring_index(response_data,'<approved>',-1), '</approved>', 1) as approved, 
			substring_index(substring_index(response_data,'<decline>',-1), '</decline>', 1) as decline,
			substring_index(substring_index(response_data,'<pending>',-1), '</pending>', 1) as pending,
			substring_index(substring_index(response_data,'<cancelled>',-1), '</cancelled>', 1) as cancelled FROM credit_card_banks_apply AS ccba JOIN sbi_ccoffers_directonsite AS scd ON (scd.sbiccoffersid = ccba.cc_requestid) WHERE ccba.applied_bankname = 'American Express' AND ccba.request_data LIKE '%".$Mobile."%' GROUP BY ccba.cc_requestid";
		}
	}
	//echo $sql.'<br>';
	$sqlResult = d4l_ExecQuery($sql);
	while($row = d4l_mysql_fetch_assoc($sqlResult)){
		/* Get Bidder Details Start */
		if($tableIdentifier == 'product'){
			$checkRequestIDSql = "SELECT RequestID FROM Req_Credit_Card_Sms WHERE UserID = '".$row['cc_requestid']."'";
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
				$getBidderSql = "SELECT la.BidderID FROM lead_allocate as la LEFT JOIN Bidders as bid ON(la.BidderID = bid.BidderID) WHERE la.AllRequestID = '".$row['cc_requestid']."' AND la.Reply_Type = 4 AND bid.leadidentifier IN ('diallerleadcc','rblcallerlms_cc','rblcallerinternallms_cc','amercianexpresscallerlms_cc','amercianexpressinternalcallerlms_cc','sbicallerlms_cc', 'icicibankcallerlms_cc', 'scbbankcallerlms_cc', 'CCTRANSFER2CALLER', 'amexdigicallerlms_cc', 'rblcallerdigilms_cc') ORDER BY leadid DESC LIMIT 0,1";
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
	</td>
</tr>
<tr>
    <td align="center">
	<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#45B2D8">
		<tr>
			<td>
				<form name="frmsearch" method="post">
					<div class="div-lead-left">
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td>&nbsp;</td>
							</tr>
							<tr>
								<td width="23%">
									<input type="text" name="PAN" id="PAN" style="width:80%; height:40px;" placeholder="PAN" value="<?php echo $PAN; ?>">
								</td>
								<td width="23%">
									<input type="text" name="Mobile" id="Mobile" style="width:80%; height:40px;" placeholder="Mobile" value="<?php echo $Mobile; ?>">
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
							<tr>
								<td><?php echo $errorMsg; ?></td>
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
			<td width="5%" align="center" bgcolor="#FFFFFF" class="style2">Approved</td>
			<td width="5%" align="center" bgcolor="#FFFFFF" class="style2">Declined</td>
			<td width="5%" align="center" bgcolor="#FFFFFF" class="style2">Pending</td>
			<td width="5%" align="center" bgcolor="#FFFFFF" class="style2">Cancelled</td>
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
			<td width="8%" align="center" bgcolor="#FFFFFF" class="style2"><?php echo $val['cc_requestid']; ?></td>
			<td width="8%" align="center" bgcolor="#FFFFFF" class="style2"><?php echo $val['RequestID_SMS']; ?></td>
			<td width="5%" align="center" bgcolor="#FFFFFF" class="style2"><?php echo $val['approved']; ?></td>
			<td width="5%" align="center" bgcolor="#FFFFFF" class="style2"><?php echo $val['decline']; ?></td>
			<td width="5%" align="center" bgcolor="#FFFFFF" class="style2"><?php echo $val['pending']; ?></td>
			<td width="5%" align="center" bgcolor="#FFFFFF" class="style2"><?php echo $val['cancelled']; ?></td>
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
