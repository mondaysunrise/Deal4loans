<?php
require_once("includes/application-top-inner_test.php");
define("NoOFLMS", 2);

$feedback_tble = "lead_allocate";
$Dateval = $_REQUEST['Dateval'];
if ($Dateval != "") {
    $min_date = $Dateval . " 00:00:00";
    $max_date = $Dateval . " 23:59:59";
} else {
    $min_date = date("Y-m-d 00:00:00");
    $max_date = date("Y-m-d 23:59:59");
}
// Get BidderID


// digitech
$qrySMSPre = "SELECT BidderID, Bidder_Name, Status FROM Bidders where leadidentifier in ('sbicallerdigilms_cc') and leadidentifier!=''";
$qryCheckSMSPre = $obj->fun_db_query($qrySMSPre);
$qryCheckSMSPreAll = $obj->fun_db_query($qrySMSPre);


function QueryProcess($Products, $AgentID) {
    $feedback_tble = "lead_allocate";
    $Dateval = $_REQUEST['Dateval'];
    if ($Dateval != "") {
        $min_date = $Dateval . " 00:00:00";
        $max_date = $Dateval . " 23:59:59";
    } else {
        $min_date = date("Y-m-d 00:00:00");
        $max_date = date("Y-m-d 23:59:59");
    }
    
    if ($Products == 'Digitech') {

        return $qrySMSPreAll = "SELECT * FROM Req_Credit_Card_Sms LEFT OUTER JOIN lead_allocate ON lead_allocate.AllRequestID=Req_Credit_Card_Sms.RequestID WHERE (( Req_Credit_Card_Sms.Updated_Date Between '" . ($min_date) . "' and '" . ($max_date) . "' or Req_Credit_Card_Sms.Followup_Date Between '" . ($min_date) . "' and '" . ($max_date) . "') and lead_allocate.BidderID  in (" . $AgentID . ") ) ";
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
	.lead_left{ float: left; width:47%; padding-left: 10px; padding-right:10px; background:#FFF; min-height:542px; padding-top: 25px;}
	.lead_right{ float:right; width:47%; padding-left: 10px; padding-right:10px; background:#FFF; min-height:542px; padding-top: 25px; margin-left:10px;}
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
			$resCountSMSPreAllPie = $obj->fun_db_query($qrySMSPre);
			while ($rowSMSPrePie = $obj->fun_db_fetch_rs_object($resCountSMSPreAllPie)) {
				$AgentIDSMSPre = $rowSMSPrePie->BidderID;
				$AgentNamePre = $rowSMSPrePie->Bidder_Name;
				$qrySMSPrePie = QueryProcess('Digitech', $AgentIDSMSPre);
				$resCountSMSPrePie = $objAdmin->fun_get_num_rows($qrySMSPrePie);
			?>
			['<?php echo $AgentIDSMSPre . "[" . $AgentNamePre . "]"; ?>', <?php echo $resCountSMSPrePie; ?>],
			<?php } ?>
			]);
		var options = {
			title: 'Digitech',
			is3D: true,
		};
		var chart = new google.visualization.PieChart(document.getElementById('piechart_Pre'));
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
			$BidderIDstaticArr = '';
			while ($rowAgentsIDAll = $obj->fun_db_fetch_rs_object($qryCheckSMSPreAll)) {
				$BidderIDstaticArr[] = $rowAgentsIDAll->BidderID;
			}
			$BidderIDsPreAll = implode(',', $BidderIDstaticArr);
			$qrySMSPreAll = QueryProcess('Digitech', $BidderIDsPreAll);
			$resCountSMSPreAll = $objAdmin->fun_get_num_rows($qrySMSPreAll);
			?>
			<table width="100%" cellspacing="0" cellpadding="0">
				<tr>
					<td colspan="2"><h3>Product Name(Digitech)</h3><strong>Total Lead Count - <?php echo $resCountSMSPreAll; ?></strong></td>
				</tr>
				<tr><td colspan="2">


						<div id="piechart_Pre"></div>
					</td></tr>
				<tr>
					<td><strong>Agent ID</strong></td>
					<td><strong>Lead Count</strong></td>
				</tr>
				<?php
				$w = 1;
				while ($rowSMSPre = $obj->fun_db_fetch_rs_object($qryCheckSMSPre)) {
					$AgentIDSMSPre = $rowSMSPre->BidderID;
					$AgentName = $rowSMSPre->Bidder_Name;
					if ($w % 2 == 1) {
						$Class = "class=\"OddClass\"";
					} else {
						$Class = "class=\"EvenClass\"";
					}
					$QuerySMSPre = QueryProcess('Digitech', $AgentIDSMSPre);
					$resCountSMSPre = $objAdmin->fun_get_num_rows($QuerySMSPre);
					$StatusSMSPre = $rowSMSPre->Status;
					if($StatusSMSPre ==1) {$status_text = "Enabled"; } else { $status_text = "Disabled"; }
					?>
					<tr <?php echo $Class; ?>>
						<td><?php echo $AgentIDSMSPre; ?>[<?php echo $AgentName; ?>] [<?php echo $status_text;?>]</td>
						<td><?php echo $resCountSMSPre; ?></td>
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
