<?php
//error_reporting(E_ALL);
//ini_set('display_error', 1);
require_once("includes/application-top-inner_test.php");

//$showHeader = "RBL Status";

$start_datetime = $_REQUEST['start_datetime'];
$end_datetime = $_REQUEST['end_datetime'];

$min_date = !empty($start_datetime) ? $start_datetime : date('Y-m-d 00:00:00');
$max_date = !empty($end_datetime) ? $end_datetime : date('Y-m-d 23:59:59');

function QueryProcess($Products) {
    $start_datetime = $_REQUEST['start_datetime'];
	$end_datetime = $_REQUEST['end_datetime'];
	
	$min_date = !empty($start_datetime) ? $start_datetime : date('Y-m-d 00:00:00');
	$max_date = !empty($end_datetime) ? $end_datetime : date('Y-m-d 23:59:59');
   
    if ($Products == 'ICCS') {
        return $qry = "SELECT substring_index(substring_index(response_data,'Status -',-1), ', ReferenceCode', 1) as Process, COUNT(*) as countLeads, applied_bankname, request_data, response_data, lead_source, date_created FROM `credit_card_banks_apply` As ccba JOIN `Req_Credit_Card` as rcc ON (rcc.RequestID = ccba.cc_requestid) WHERE ccba.applied_bankname = 'RBL Bank' AND ccba.request_data != '' AND rcc.source IN ('SMS_Lead_ICCS') AND (ccba.date_created BETWEEN '".$min_date."' AND '".$max_date."') GROUP BY Process ORDER BY Process DESC";
    }
    if ($Products == 'INHOUSE') {
        return $qry = "SELECT substring_index(substring_index(response_data,'Status -',-1), ', ReferenceCode', 1) as Process, COUNT(*) as countLeads, applied_bankname, request_data, response_data, lead_source, date_created FROM `credit_card_banks_apply` As ccba JOIN `Req_Credit_Card` as rcc ON (rcc.RequestID = ccba.cc_requestid) WHERE ccba.applied_bankname = 'RBL Bank' AND ccba.request_data != '' AND rcc.source IN ('SMS_LeadNew','SMS_Lead_RBL','SMS_Internal_Lead_RBL') AND (ccba.date_created BETWEEN '".$min_date."' AND '".$max_date."') GROUP BY Process ORDER BY Process DESC";
    }
    if ($Products == 'PREFERRED') {
       return $qry = "SELECT substring_index(substring_index(response_data,'Status -',-1), ', ReferenceCode', 1) as Process, COUNT(*) as countLeads, applied_bankname, request_data, response_data, lead_source, date_created FROM `credit_card_banks_apply` As ccba JOIN `Req_Credit_Card` as rcc ON (rcc.RequestID = ccba.cc_requestid) WHERE ccba.applied_bankname = 'RBL Bank' AND ccba.request_data != '' AND rcc.source NOT IN ('SMS_LeadNew','SMS_Lead_RBL','SMS_Internal_Lead_RBL','SMS_Lead_ICCS','SMS_Digi_Lead_SBI','SMS_Digi_Lead_RBL','SMS_Digi_Lead_AMEX') AND (ccba.date_created BETWEEN '".$min_date."' AND '".$max_date."') GROUP BY Process ORDER BY Process DESC";
    }
    if ($Products == 'DIGITECH') {
        return $qry = "SELECT substring_index(substring_index(response_data,'Status -',-1), ', ReferenceCode', 1) as Process, COUNT(*) as countLeads, applied_bankname, request_data, response_data, lead_source, date_created FROM `credit_card_banks_apply` As ccba JOIN `Req_Credit_Card` as rcc ON (rcc.RequestID = ccba.cc_requestid) WHERE ccba.applied_bankname = 'RBL Bank' AND ccba.request_data != '' AND rcc.source IN ('SMS_Digi_Lead_SBI','SMS_Digi_Lead_RBL','SMS_Digi_Lead_AMEX') AND (ccba.date_created BETWEEN '".$min_date."' AND '".$max_date."') GROUP BY Process ORDER BY Process DESC";
    }
    /*
	if ($Products == 'HL') {
		 return $qry = "SELECT substring_index(substring_index(response_data,'Status -',-1), ', ReferenceCode', 1) as Process, COUNT(*) as countLeads, applied_bankname, request_data, response_data, lead_source, date_created FROM `Bidders` As bid JOIN `lead_allocate` As la ON(la.BidderID = bid.BidderID) JOIN `credit_card_banks_apply` As ccba ON (ccba.cc_requestid = la.AllRequestID) WHERE ccba.applied_bankname = 'RBL Bank' AND ccba.request_data != '' AND bid.leadidentifier IN ('CCTRANSFER2CALLER') AND (ccba.date_created BETWEEN '".$min_date."' AND '".$max_date."') GROUP BY Process ORDER BY Process DESC";
    }
    */
}
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
	table.noBorder tr td {border-style:hidden;}
	.lead_wrapper{ width:1000px; margin:20px auto 0px; background:#FFF;}
	.lead_left{ float: left; width:47%; padding-left: 10px; padding-right:10px; background:#FFF; min-height:442px; padding-top: 25px;}
	.lead_right{ float:right; width:47%; padding-left: 10px; padding-right:10px; background:#FFF; min-height:442px; padding-top: 25px; margin-left:10px;}
	.mr-top25{ margin-top: 25px;}
	.search-lead{width:50%; background:#FFF; margin:25px auto 0px; padding-top: 2px; padding-bottom:2px;}
	.search-lead form{ margin-bottom: 0px;}
	.date-box{width:70%; cursor:pointer; min-height:30px; background: url('images/calendar.gif') right no-repeat; background-position:97%;}
	.button-search{height:29px; border:none; width:80%; padding-left:2px; background:#0274e6; color:#FFF;}
</style>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script type="text/javascript">
	google.charts.load("current", {packages: ["corechart"]});
	google.charts.setOnLoadCallback(drawChartPre);
	function drawChartPre() {
		var data = google.visualization.arrayToDataTable([
			['Task', 'Hours per Day'],
			<?php
			$qryCheckResult1=  $obj->fun_db_query(QueryProcess('ICCS'));
			//	 print_r($qrySMSPrePie);
			while ($rowSMSPre = $obj->fun_db_fetch_rs_object($qryCheckResult1)) {
				$Process= $rowSMSPre->Process;
				$countLeads= $rowSMSPre->countLeads;
			?>
			['<?php echo $Process; ?>', <?php echo $countLeads; ?>],
			<?php } ?>
		]);
		var options = {
			title: 'SMS - ICCS',
			is3D: true,
		};
		var chart = new google.visualization.PieChart(document.getElementById('piechart_Pre'));
		chart.draw(data, options);
	}
</script>
<script type="text/javascript">
	google.charts.load("current", {packages: ["corechart"]});
	google.charts.setOnLoadCallback(drawChartPre);
	function drawChartPre() {
		var data = google.visualization.arrayToDataTable([
			['Task', 'Hours per Day'],
			<?php
			$qryCheckResult1=  $obj->fun_db_query(QueryProcess('INHOUSE'));
			//	 print_r($qrySMSPrePie);
			while ($rowSMSPre = $obj->fun_db_fetch_rs_object($qryCheckResult1)) {
				$Process= $rowSMSPre->Process;
				$countLeads= $rowSMSPre->countLeads;
			?>
			['<?php echo $Process; ?>', <?php echo $countLeads; ?>],
			<?php } ?>
		]);
		var options = {
			title: 'SMS - INHOUSE',
			is3D: true,
		};
		var chart = new google.visualization.PieChart(document.getElementById('piechart_Inhouse'));
		chart.draw(data, options);
	}
</script>
<script type="text/javascript">
	google.charts.load("current", {packages: ["corechart"]});
	google.charts.setOnLoadCallback(drawChartPre);
	function drawChartPre() {
		var data = google.visualization.arrayToDataTable([
			['Task', 'Hours per Day'],
			<?php
			$qryCheckResult1=  $obj->fun_db_query(QueryProcess('PREFERRED'));
			//	 print_r($qrySMSPrePie);
			while ($rowSMSPre = $obj->fun_db_fetch_rs_object($qryCheckResult1)) {
				$Process= $rowSMSPre->Process;
				$countLeads= $rowSMSPre->countLeads;
			?>
			['<?php echo $Process; ?>', <?php echo $countLeads; ?>],
			<?php } ?>
		]);
		var options = {
			title: 'PREFERRED',
			is3D: true,
		};
		var chart = new google.visualization.PieChart(document.getElementById('piechart_PREFERRED'));
		chart.draw(data, options);
	}
</script>
<script type="text/javascript">
	google.charts.load("current", {packages: ["corechart"]});
	google.charts.setOnLoadCallback(drawChartPre);
	function drawChartPre() {
		var data = google.visualization.arrayToDataTable([
			['Task', 'Hours per Day'],
			<?php
			$qryCheckResult1=  $obj->fun_db_query(QueryProcess('DIGITECH'));
			//	 print_r($qrySMSPrePie);
			while ($rowSMSPre = $obj->fun_db_fetch_rs_object($qryCheckResult1)) {
				$Process= $rowSMSPre->Process;
				$countLeads= $rowSMSPre->countLeads;
			?>
			['<?php echo $Process; ?>', <?php echo $countLeads; ?>],
			<?php } ?>
		]);
		var options = {
			title: 'DIGITECH',
			is3D: true,
		};
		var chart = new google.visualization.PieChart(document.getElementById('piechart_DIGITECH'));
		chart.draw(data, options);
	}
</script>
<!--
<script type="text/javascript">
	google.charts.load("current", {packages: ["corechart"]});
	google.charts.setOnLoadCallback(drawChartPre);
	function drawChartPre() {
		var data = google.visualization.arrayToDataTable([
			['Task', 'Hours per Day'],
			<?php
			$qryCheckResult1=  $obj->fun_db_query(QueryProcess('HL'));
			//	 print_r($qrySMSPrePie);
			while ($rowSMSPre = $obj->fun_db_fetch_rs_object($qryCheckResult1)) {
				$Process= $rowSMSPre->Process;
				$countLeads= $rowSMSPre->countLeads;
			?>
			['<?php echo $Process; ?>', <?php echo $countLeads; ?>],
			<?php } ?>
		]);
		var options = {
			title: 'HL',
			is3D: true,
		};
		var chart = new google.visualization.PieChart(document.getElementById('piechart_HL'));
		chart.draw(data, options);
	}
</script>
-->
<link rel="stylesheet" type="text/css" href="../css-datetimepicker/jquery-ui.css" />
<link rel="stylesheet" type="text/css" href="../css-datetimepicker/jquery-ui-timepicker-addon.css" />
<script src="js-datepicker/jquery-1.5.1.js"></script>
<script src="js-datepicker/jquery.ui.core.js"></script>
<script src="js-datepicker/jquery.ui.datepicker.js"></script>
<script src="../js-datetimepicker/jquery-ui-timepicker-addon.js"></script>
<script>
	$(function() {
		$('#start_datetime').datetimepicker({
			changeMonth: true,
			changeYear: true,
			timeFormat: 'HH:mm:ss',
			onSelect: function (selected) {
				$('#end_datetime').datetimepicker("option", "minDate", selected);
				$('#end_datetime').datetimepicker("option", "maxDate", selected);
			}
		});
		
		$('#end_datetime').datetimepicker({
			changeMonth: true,
			changeYear: true,
			timeFormat: 'HH:mm:ss',
			onSelect: function (selected) {
				$('#start_datetime').datetimepicker("option", "minDate", selected);
				$('#start_datetime').datetimepicker("option", "maxDate", selected);
			}
		});
		
	});
</script>
</head>
<body style="margin:0px 0px 0px 0px; padding:0px 0px 0px 0px; background-color:#45B2D8;">
<?php include "header_cc_admin_lms.php"; ?>
<div class="search-lead">
	<form action="" method="get" name="DateValfrm">
		<table style="width:100%;" class="noBorder">
			<tr>
				<td colspan="3" align="center" style="font-size:16px; font-weight:bold;">RBL Status</td>
			</tr>
			<tr>
				<td align="center"></td>
			</tr>
			<tr>
				<td>
					<strong>Start Date</strong>&nbsp;<input class="date-box" type="text" name="start_datetime" id="start_datetime" value="<?php echo $min_date; ?>" />
				</td>
				<td>
					<strong>End Date</strong>&nbsp;<input class="date-box" type="text" name="end_datetime" id="end_datetime" value="<?php echo $max_date; ?>" />
				</td>
				<td>
					<input type="submit" name="Search" value="Search" id="Search" class="button-search" />
				</td>
		</table>
	</form> 
</div>
<div class="lead_wrapper">
	<div style="text-align:center;">
	</div>
	<div class="lead_left">
		<?php
			$qryCheckResult1=  $obj->fun_db_query(QueryProcess('ICCS'));
		?>
		<table width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td colspan="2"><h3>Product Name(SMS - ICCS)</h3></td>
			</tr>
			<tr>
				<td colspan="2">
					<div id="piechart_Pre"></div>
				</td>
			</tr>
			<tr>
				<td><strong>Processing Status</strong></td>
				<td><strong>Lead Count</strong></td>
			</tr>
			<?php
			$w = 1;
			while ($rowSMSPre = $obj->fun_db_fetch_rs_object($qryCheckResult1)) {
				$Process= $rowSMSPre->Process;
				$countLeads= $rowSMSPre->countLeads;
				if ($w % 2 == 1) {
					$Class = "class=\"OddClass\"";
				} else {
					$Class = "class=\"EvenClass\"";
				}
			 
				?>
				<tr <?php echo $Class; ?>>
					<td><?php echo $Process; ?></td>
					<td><?php echo $countLeads; ?></td>
				</tr>
				<?php
				$w++;
			}
			?>
		</table>
	</div>
	<div class="lead_right">
		<?php
			$qryCheckResult1=  $obj->fun_db_query(QueryProcess('INHOUSE'));
		?>
		<table width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td colspan="2"><h3>Product Name(SMS - INHOUSE)</h3></td>
			</tr>
			<tr>
				<td colspan="2">
					<div id="piechart_Inhouse"></div>
				</td>
			</tr>
			<tr>
				<td><strong>Processing Status</strong></td>
				<td><strong>Lead Count</strong></td>
			</tr>
			<?php
			$w = 1;
			while ($rowSMSPre = $obj->fun_db_fetch_rs_object($qryCheckResult1)) {
				$Process= $rowSMSPre->Process;
				$countLeads= $rowSMSPre->countLeads;
				if ($w % 2 == 1) {
					$Class = "class=\"OddClass\"";
				} else {
					$Class = "class=\"EvenClass\"";
				}
			 
				?>
				<tr <?php echo $Class; ?>>
					<td><?php echo $Process; ?></td>
					<td><?php echo $countLeads; ?></td>
				</tr>
				<?php
				$w++;
			}
			?>
		</table> 
	</div>
	<div class="lead_left">
		<?php
			$qryCheckResult1=  $obj->fun_db_query(QueryProcess('PREFERRED'));
		?>
		<table width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td colspan="2"><h3>Product Name(PREFERRED)</h3></td>
			</tr>
			<tr>
				<td colspan="2">
					<div id="piechart_PREFERRED"></div>
				</td>
			</tr>
			<tr>
				<td><strong>Processing Status</strong></td>
				<td><strong>Lead Count</strong></td>
			</tr>
			<?php
			$w = 1;
			while ($rowSMSPre = $obj->fun_db_fetch_rs_object($qryCheckResult1)) {
				$Process= $rowSMSPre->Process;
				$countLeads= $rowSMSPre->countLeads;
				if ($w % 2 == 1) {
					$Class = "class=\"OddClass\"";
				} else {
					$Class = "class=\"EvenClass\"";
				}
			 
				?>
				<tr <?php echo $Class; ?>>
					<td><?php echo $Process; ?></td>
					<td><?php echo $countLeads; ?></td>
				</tr>
				<?php
				$w++;
			}
			?>
		</table> 
	</div>
	<div class="lead_right">
		<?php
			$qryCheckResult1=  $obj->fun_db_query(QueryProcess('DIGITECH'));
		?>
		<table width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td colspan="2"><h3>Product Name(DIGITECH)</h3></td>
			</tr>
			<tr>
				<td colspan="2">
					<div id="piechart_DIGITECH"></div>
				</td>
			</tr>
			<tr>
				<td><strong>Processing Status</strong></td>
				<td><strong>Lead Count</strong></td>
			</tr>
			<?php
			$w = 1;
			while ($rowSMSPre = $obj->fun_db_fetch_rs_object($qryCheckResult1)) {
				$Process= $rowSMSPre->Process;
				$countLeads= $rowSMSPre->countLeads;
				if ($w % 2 == 1) {
					$Class = "class=\"OddClass\"";
				} else {
					$Class = "class=\"EvenClass\"";
				}
			 
				?>
				<tr <?php echo $Class; ?>>
					<td><?php echo $Process; ?></td>
					<td><?php echo $countLeads; ?></td>
				</tr>
				<?php
				$w++;
			}
			?>
		</table> 
	</div>
	<!--
	<div class="lead_left">
		<?php
			$qryCheckResult1=  $obj->fun_db_query(QueryProcess('HL'));
		?>
		<table width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td colspan="2"><h3>Product Name(HL)</h3></td>
			</tr>
			<tr>
				<td colspan="2">
					<div id="piechart_HL"></div>
				</td>
			</tr>
			<tr>
				<td><strong>Processing Status</strong></td>
				<td><strong>Lead Count</strong></td>
			</tr>
			<?php
			$w = 1;
			while ($rowSMSPre = $obj->fun_db_fetch_rs_object($qryCheckResult1)) {
				$Process= $rowSMSPre->Process;
				$countLeads= $rowSMSPre->countLeads;
				if ($w % 2 == 1) {
					$Class = "class=\"OddClass\"";
				} else {
					$Class = "class=\"EvenClass\"";
				}
			 
				?>
				<tr <?php echo $Class; ?>>
					<td><?php echo $Process; ?></td>
					<td><?php echo $countLeads; ?></td>
				</tr>
				<?php
				$w++;
			}
			?>
		</table> 
    </div>
    -->
</div>
</body>
</html>
