<?php
require_once("includes/application-top-inner_test.php");
define("NoOFLMS", 2);

$showHeader = "SBI Blank LRN Leads";

$Dateval = $_REQUEST['Dateval'];
if ($Dateval != "") {
    $min_date = $Dateval . " 00:00:00";
    $max_date = $Dateval . " 23:59:59";
} else {
    $min_date = date("Y-m-d 00:00:00");
    $max_date = date("Y-m-d 23:59:59");
}

//Query To check records who have only one entry and their response_xml is blank in webservice_log_sbi table
$qrySMSPreAll = "SELECT substring_index(substring_index(request_xml, '<TextSpareField1>', -1), '</TextSpareField1>', 1) as `Marketing Partner Unique Number`, '' as `Application Number/Lead Ref Number (if available)`, substring_index(substring_index(request_xml, '<PAN>', -1), '</PAN>', 1) as `PAN`, DATE(first_dated) as `Date and time for request submission`, 'Blank' as `Status/Error Message` FROM `webservice_log_sbi` WHERE cc_requestid IN (SELECT cc_requestid FROM (select cc_requestid, COUNT(cc_requestid) AS c FROM `webservice_log_sbi` GROUP BY cc_requestid HAVING C < 2 ) as temp) AND response_xml = '' and first_dated between '".$min_date."' AND  '".$max_date."' ORDER BY cc_requestid DESC";
//echo $qrySMSPreAll;

$qryCheckResult1=  $obj->fun_db_query($qrySMSPreAll);

?>
<html>
<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=WINDOWS-1252">
<title>Credit Card LMS - Dashboard</title>
<link href="../includes/style1.css" rel="stylesheet" type="text/css">
<link href="../style.css" rel="stylesheet" type="text/css" />
<style type="text/css">
	.OddClass {background-color: #FFF;}
	.EvenClass {background-color: #EEE;}
	table {border-collapse: collapse;}
	table, td, th {border: solid thin #CCC; padding:5px;}
	.lead_wrapper{ width:1000px; margin:20px auto 0px; background:#FFF;}
	.lead_left{ float: left; width:47%; padding-left: 10px; padding-right:10px; background:#FFF; min-height:442px; padding-top: 25px;}
	.lead_right{ float:right; width:47%; padding-left: 10px; padding-right:10px; background:#FFF; min-height:442px; padding-top: 25px; margin-left:10px;}
	.mr-top25{ margin-top: 25px;}
	.search-lead{width:200px; background:#FFF; margin:25px auto 0px; padding-top: 2px; padding-bottom:2px;}
	.search-lead form{ margin-bottom: 0px;}
	.date-box{width:70%; cursor:pointer; min-height:30px; background: url('images/calendar.gif') right no-repeat; background-position:97%;}
	.button-search{height:29px; border:none; width:23%; padding-left:2px; background:#0274e6; color:#FFF;}
</style>
<link rel="stylesheet" type="text/css" href="css-datepicker/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="css-datepicker/datepicker.css">
<script src="js-datepicker/jquery-1.5.1.js"></script>
<script src="js-datepicker/jquery.ui.core.js"></script>
<script src="js-datepicker/jquery.ui.datepicker.js"></script>
<script>
	$(document).ready(function () {
		$("#datepick").datepicker();
	});
</script> 
</head>
<body style="margin:0px 0px 0px 0px; padding:0px 0px 0px 0px; background-color:#45B2D8;">
	<?php include "header_cc_admin_lms.php"; ?>
	<div class="search-lead">
	   <form action="" method="get" name="DateValfrm">
		   <input class="date-box" type="text" name="Dateval" id="datepick" value="<?php if($Dateval!="") { echo $Dateval; }else{echo date("Y-m-d");} ?>" />
		   <input type="submit" name="Search" value="Search" id="Search" class="button-search" />
		</form> 
	</div>
	<div class="lead_wrapper">
		<div style="text-align:center;">
			<table width="100%" cellspacing="0" cellpadding="0">
				<tr>
					<td colspan="2"><h3>SBI Blank LRN Leads</h3></td>
				</tr>
			  
				<tr>
					<td><strong>Marketing Partner Unique Number</strong></td>
					<td><strong>Application Number/Lead Ref Number  (if available) </strong></td>
					<td><strong>PAN</strong></td>
					<td><strong>Date and time for request submission</strong></td>
					<td><strong>Status/Error Message</strong></td>
				</tr>
				<?php
				$w = 1;
				while ($rowSMSPre = $obj->fun_db_fetch_rs_array($qryCheckResult1)) {
					if ($w % 2 == 1) {
						$Class = "class=\"OddClass\"";
					} else {
						$Class = "class=\"EvenClass\"";
					}
					?>
					<tr <?php echo $Class; ?>>
						<td><?php echo $rowSMSPre['Marketing Partner Unique Number']; ?></td>
						<td><?php //echo $countLeads; ?></td>
						<td><?php echo $rowSMSPre['PAN']; ?></td>
						<td><?php echo $rowSMSPre['Date and time for request submission']; ?></td>
						<td><?php echo "Blank"; ?></td>
					</tr>
					<?php
					$w++;
				}
				?>
			</table>
		</div>
		<div align="center">
			<form name="frmdownload" action="../excel-download-qry.php" method="post">
				<tr>
					<td align="center">
						<input type="hidden" name="qry" value="<? echo $qrySMSPreAll; ?>">
						<input type="hidden" name="filename" value="<? echo 'export.xls'; ?>">
						<input name="downloadexcel" id="downloadexcel" type="submit" class="bluebtn" value="Export List To Excel">
					</td>
				</tr>
			</form>
		</div>
	</div>
</body>
</html>
