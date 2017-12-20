<?php
//error_reporting(E_ALL);
//ini_set('display_error',1);

require_once("includes/application-top-inner_test.php");


$agentid = $_REQUEST['agentid'];
$statuscode = $_REQUEST['statuscode'];
$process = $_REQUEST['process'];
$min_date = $_REQUEST['min_date'];


if($process == 'INHOUSE' || $process == 'DIGITECH' || $process == 'ICCS'){
	$leadCountSql = "SELECT BidderID, substring_index(substring_index(request_xml, '<TextSpareField1>', -1), '</TextSpareField1>', 1) as RequestID, CONCAT(substring_index(substring_index(request_xml, '<FirstName>', -1), '</FirstName>', 1), ' ', substring_index(substring_index(request_xml, '<MiddleName>', -1), '</MiddleName>', 1), ' ', substring_index(substring_index(request_xml, '<LastName>', -1), '</LastName>', 1)) as Name, substring_index(substring_index(request_xml, '<Mobile>', -1), '</Mobile>', 1) as Mobile, scc.LeadRefNumber, scc.ApplicationNumber, scc.ProcessingStatus, scc.first_dated FROM lead_allocate as la JOIN Req_Credit_Card_Sms as rccs ON ((la.AllRequestID = rccs.RequestID) AND (rccs.UserID != 0)) JOIN sbi_credit_card_5633 as scc ON (scc.RequestID = rccs.UserID) WHERE scc.ProcessingStatus = '".$statuscode."' AND DATE(scc.first_dated) = '".$min_date."' AND la.BidderID IN (".$agentid.")";
}
elseif($process == 'TWL'){
	$leadCountSql = "SELECT '5923' as BidderID, substring_index(substring_index(request_xml, '<TextSpareField1>', -1), '</TextSpareField1>', 1) as RequestID, CONCAT(substring_index(substring_index(request_xml, '<FirstName>', -1), '</FirstName>', 1), ' ', substring_index(substring_index(request_xml, '<MiddleName>', -1), '</MiddleName>', 1), ' ', substring_index(substring_index(request_xml, '<LastName>', -1), '</LastName>', 1)) as Name, substring_index(substring_index(request_xml, '<Mobile>', -1), '</Mobile>', 1) as Mobile, scc.LeadRefNumber, scc.ApplicationNumber, scc.ProcessingStatus, scc.first_dated FROM sbi_ccoffers_directonsite as scd JOIN sbi_credit_card_5633 as scc ON (scc.RequestID = scd.sbiccoffersid) WHERE scc.ProcessingStatus = '".$statuscode."' AND DATE(scc.first_dated) = '".$min_date."' AND (process_type='TWL_LMS' OR productflag=10)";
}
else{
	$leadCountSql = "SELECT BidderID, substring_index(substring_index(request_xml, '<TextSpareField1>', -1), '</TextSpareField1>', 1) as RequestID, CONCAT(substring_index(substring_index(request_xml, '<FirstName>', -1), '</FirstName>', 1), ' ', substring_index(substring_index(request_xml, '<MiddleName>', -1), '</MiddleName>', 1), ' ', substring_index(substring_index(request_xml, '<LastName>', -1), '</LastName>', 1)) as Name, substring_index(substring_index(request_xml, '<Mobile>', -1), '</Mobile>', 1) as Mobile, scc.LeadRefNumber, scc.ApplicationNumber, scc.ProcessingStatus, scc.first_dated FROM lead_allocate as la JOIN Req_Credit_Card as rcc ON ((la.AllRequestID = rcc.RequestID)) JOIN sbi_credit_card_5633 as scc ON (scc.RequestID = rcc.RequestID) WHERE scc.ProcessingStatus = '".$statuscode."' AND DATE(scc.first_dated) = '".$min_date."' AND la.BidderID IN (".$agentid.")";
}
//echo $leadCountSql;
$leadCountQuery= $obj->fun_db_query($leadCountSql);
while($row = $obj->fun_db_fetch_rs_assoc($leadCountQuery))
{
	$agentDetailsArr[] = $row;
}
//echo '<pre>';print_r($agentDetailsArr);exit;
?>
<html>
<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=WINDOWS-1252">
<title>Credit Card LMS - SBI Agents</title>
<script Language="JavaScript" Type="text/javascript" src="../scripts/common.js"></script>
<link href="../includes/style1.css" rel="stylesheet" type="text/css">
<link href="../style.css" rel="stylesheet" type="text/css" />
<script language="javascript" type="text/javascript" src="../scripts/datetime.js"></script>
<style type="text/css">
	.OddClass {background-color: #FFF;}
	.EvenClass {background-color: #EEE;}
</style>
</head>
<body style="margin:0px 0px 0px 0px; padding:0px 0px 0px 0px; background-color:#45B2D8;">
<?php include "header_cc_admin_lms.php"; ?>
<div style="clear:both; height:15px;"></div>
<div> 
<table width="98%" border="0">
	<tr>
		<td align="center" style="font-size:16px; font-weight:bold;">SBI Agents Status Details</td>
	</tr>
	<tr>
		<td align="center"></td>
	</tr>
	<tr>
		<td align="center" width="100%">
		<div align="center">
            <table width="900" border="1" cellpadding="4" cellspacing="0" class="blueborder" bgcolor="#FFFFFF">
                <tr>
					<td colspan="8" align="center" class="head1">Details</td>
                </tr>
				<tr>
					<td align="center"><strong>S.No</strong></td>
					<td align="center"><strong>RequestID</strong></td>
					<td align="center"><strong>Name</strong></td>
					<td align="center"><strong>LeadRefNumber</strong></td>
					<td align="center"><strong>ApplicationNumber</strong></td>
					<td align="center"><strong>ProcessingStatus</strong></td>
					<td align="center"><strong>BidderID</strong></td>
					<td align="center"><strong>PunchDate</strong></td>
					
				</tr>
				<?php
				$w = 1;
				foreach($agentDetailsArr as $key=>$val)
				{
					if ($w % 2 == 1) {
						$Class = "class=\"OddClass\"";
					} else {
						$Class = "class=\"EvenClass\"";
					}
				?>
				<tr <?php echo $Class; ?>>
					<td align="center" ><?php echo $key+1; ?></td>
					<td align="center" ><?php echo $val['RequestID']; ?></td>
					<td align="center" ><?php echo $val['Name']; ?></td>
					<td align="center" ><?php echo $val['LeadRefNumber']; ?></td>
					<td align="center" ><?php echo $val['ApplicationNumber']; ?></td>
					<td align="center" ><?php echo $val['ProcessingStatus']; ?></td>
					<td align="center" ><?php echo $val['BidderID']; ?></td>
					<td align="center" ><?php echo $val['first_dated']; ?></td>
                </tr>
				<?php
					$w++;
				}
				?>
			</table>
		</div>
		</td>
	</tr>
</table>
</div>
<script type="text/javascript">
	var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
	document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script> 
<script type="text/javascript">
	try {
	var pageTracker = _gat._getTracker("UA-1312775-1");
	pageTracker._trackPageview();
	} catch(err) {}
</script>
</body>
</html>
