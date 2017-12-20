<?php
require_once("includes/application-top-inner_test.php");
define("NoOFLMS", 2);

$showHeader = "SBI Status";

$feedback_tble = "lead_allocate";
$Dateval = $_REQUEST['Dateval'];
if ($Dateval != "") {
    $min_date = $Dateval . " 00:00:00";
    $max_date = $Dateval . " 23:59:59";
} else {
    $min_date = date("Y-m-d 00:00:00");
    $max_date = date("Y-m-d 23:59:59");
}

function QueryProcess($Products) {
    $feedback_tble = "lead_allocate";
    $Dateval = $_REQUEST['Dateval'];
    if ($Dateval != "") {
        $min_date = $Dateval . " 00:00:00";
        $max_date = $Dateval . " 23:59:59";
    } else {
        $min_date = date("Y-m-d 00:00:00");
        $max_date = date("Y-m-d 23:59:59");
    }

    if ($Products == 'DIGITECH') {
        return $qrySMSPreAll = "SELECT scc.`ProcessingStatus` as Process, COUNT(*) as countLeads,rcc.source, DATE(first_dated) FROM `sbi_credit_card_5633` as scc JOIN `Req_Credit_Card` as rcc ON (rcc.`RequestID`=scc.`RequestID`) WHERE  first_dated  BETWEEN  '".$min_date."' AND  '".$max_date."' and source='SMS_Digi_Lead_SBI'  and process_type!='TWL_LMS' and productflag!=10 GROUP BY scc.`ProcessingStatus` order by ProcessingStatus";
    }
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
	.lead_wrapper{ width:1000px; margin:20px auto 0px; background:#FFF;}
	.lead_left{ float: left; width:47%; padding-left: 10px; padding-right:10px; background:#FFF; min-height:442px; padding-top: 25px;}
	.lead_right{ float:right; width:47%; padding-left: 10px; padding-right:10px; background:#FFF; min-height:442px; padding-top: 25px; margin-left:10px;}
	.mr-top25{ margin-top: 25px;}
	.search-lead{width:200px; background:#FFF; margin:25px auto 0px; padding-top: 2px; padding-bottom:2px;}
	.search-lead form{ margin-bottom: 0px;}
	.date-box{width:70%; cursor:pointer; min-height:30px; background: url('images/calendar.gif') right no-repeat; background-position:97%;}
	.button-search{height:29px; border:none; width:23%; padding-left:2px; background:#0274e6; color:#FFF;}
</style>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

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

<link rel="stylesheet" type="text/css" href="css-datepicker/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="css-datepicker/datepicker.css">
<script src="js-datepicker/jquery-1.5.1.js"></script>
<script src="js-datepicker/jquery.ui.core.js"></script>
<script src="js-datepicker/jquery.ui.datepicker.js"></script>
<script>
	$(document).ready(function () {

		var date = new Date();
		var m = date.getMonth(), d = date.getDate(), y = date.getFullYear();

		$('#datepicker').datepicker({
			minDate: new Date(y - 65, m, d),
			maxDate: new Date(y - 21, m, d),
			//yearRange: "+20:+0",
			dateFormat: 'dd-mm-yy'
		});
	});

	$(function () {
		$("#datepick").datepicker();
	});

</script> 
</head>
<body style="margin:0px 0px 0px 0px; padding:0px 0px 0px 0px; background-color:#45B2D8;">
<?php include "header_cc_admin_digi_lms.php"; ?>
<div class="search-lead">
	<form action="" method="get" name="DateValfrm">
		<input class="date-box" type="text" name="Dateval" id="datepick" value="<?php if($Dateval!="") { echo $Dateval; }else{echo date("Y-m-d");} ?>" />
		<input type="submit" name="Search" value="Search" id="Search" class="button-search" />
	</form> 
</div>
<div class="lead_wrapper">
	<div style="text-align:center;">
	</div>
	<div>
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
</div>
</body>
</html>
