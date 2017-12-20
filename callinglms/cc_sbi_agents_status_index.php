<?php
//error_reporting(E_ALL);
//ini_set('display_error',1);

require_once("includes/application-top-inner_test.php");


//Get Agents List By Ajax Request
if($_POST['method'] == 'GetAgentsList'){
	$selectedProcess = $_POST['process'];

	$leadidentifierCsvStr = getProcessLeadIdentifier($selectedProcess);
	
	$getAgentsSql = "SELECT BidderID,Associated_Bank,Status FROM Bidders WHERE leadidentifier IN ('".$leadidentifierCsvStr."') ORDER BY BidderID ASC";
	$getAgentsResult = $obj->fun_db_query($getAgentsSql);
	while($getAgentsRow = $obj->fun_db_fetch_rs_assoc($getAgentsResult))
	{
		$AgentsArr[] = $getAgentsRow;
	}
	$responseArr = array('AgentsArr'=>$AgentsArr);
	
	echo json_encode($responseArr);
	exit;
}

$search="";
if(isset($_REQUEST['search']))
{
	$search=$_REQUEST['search'];
}

$min_date="";
if(isset($_REQUEST['min_date']))
{
	$min_date=$_REQUEST['min_date'];
}

$max_date="";
if(isset($_REQUEST['max_date']))
{
	$max_date=$_REQUEST['max_date'];
}

$agents="";	
if(isset($_REQUEST['agents']))
{
	$agents=$_REQUEST['agents'];
}

$process="Inhouse";
if(isset($_REQUEST['process']))
{
	$process=$_REQUEST['process'];
}

$statuscode="";
if(isset($_REQUEST['statuscode']))
{
	$statuscode=$_REQUEST['statuscode'];
}

$leadidentifierCsvStr = getProcessLeadIdentifier($process);

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
<style>
/* Pagination*/

div.pagination {
	padding: 3px;
	margin: 3px;
}
div.pagination a {
	padding: 2px 5px 2px 5px;
	margin: 2px;
	border: 1px solid #AAAADD;
	text-decoration: none; /* no underline */
	color: #000099;
}
div.pagination a:hover, div.pagination a:active {
	border: 1px solid #000099;
	color: #000;
}
div.pagination span.current {
	padding: 2px 5px 2px 5px;
	margin: 2px;
	border: 1px solid #000099;
	font-weight: bold;
	background-color: #2b62b5;
	color: #FFF;
}
div.pagination span.disabled {
	padding: 2px 5px 2px 5px;
	margin: 2px;
	border: 1px solid #CCC;
	color: #CCC;
}
</style>
<style type="text/css">
	.OddClass {background-color: #FFF;}
	.EvenClass {background-color: #EEE;}
</style>
<!--DatePicker Start-->
<link rel="stylesheet" type="text/css" href="css-datepicker/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="css-datepicker/datepicker.css">
<script src="js-datepicker/jquery-1.5.1.js"></script>
<script src="js-datepicker/jquery.ui.core.js"></script>
<script src="js-datepicker/jquery.ui.datepicker.js"></script>
<!--DatePicker End-->
<script> 
	$(function() {
		var dates = $( "#min_date, #max_date" ).datepicker({
			defaultDate: "-1d",
			changeMonth: true,
			changeYear: true,
			numberOfMonths: 1,
			onSelect: function( selectedDate ) {
				var option = this.id == "min_date" ? "minDate" : "maxDate",
					instance = $( this ).data( "datepicker" ),
					date = $.datepicker.parseDate(
						instance.settings.dateFormat ||
						$.datepicker._defaults.dateFormat,
						selectedDate, instance.settings );
				dates.not( this ).datepicker( "option", option, date );
			}
		});
	});

	function chkform()
	{
		var mindate = $('#min_date').val();
		//var maxdate = $('#max_date').val();
		var process = $('#process').val();
		var agents = $('#agents').val();
		var statuscode = $('#statuscode').val();
		
		if(mindate=="")
		{
			alert("Sorry!!!! Please Enter date.");
			$('#min_date').focus();
			return false;
		}

		if(mindate.length<10 || mindate.length>10)
		{
			alert("Please fill correct date in YYYY-MM-DD format");
			$('#min_date').val('');
			$('#min_date').focus();
			return false;
		}
		/*
		if(maxdate=="")
		{
			alert("Sorry!!!! Please Enter Maximum date.");
			$('#max_date').focus();
			return false;
		}
		
		if(maxdate.length<10 || maxdate.length>10)
		{
			alert("Please fill correct date in YYYY-MM-DD format");
			$('#max_date').val('');
			$('#max_date').focus();
			return false;
		}
		*/
		
		if(process == ''){
			alert("Please select process");
			$('#process').focus();
			return false;
		}
		
		if(statuscode == ''){
			alert("Please select statuscode");
			$('#statuscode').focus();
			return false;
		}
	}
</script>
</head>
<body style="margin:0px 0px 0px 0px; padding:0px 0px 0px 0px; background-color:#45B2D8;">
<?php include "header_cc_admin_lms.php"; ?>
<div style="clear:both; height:15px;"></div>
<div> 
<table width="98%" border="0">
	<tr>
		<td align="center" style="font-size:16px; font-weight:bold;">SBI Agents Status</td>
	</tr>
	<tr>
		<td align="center"></td>
	</tr>
	<tr>
		<td align="center" width="100%">
		<div align="center">
            <table width="900" border="0" cellpadding="4" cellspacing="6" class="blueborder" bgcolor="#FFFFFF">
				<form name="frmsearch" action="cc_sbi_agents_status_index.php" method="post" onSubmit="return chkform();">
				<input type="hidden" name="search" id="search" value="y">
                <tr>
					<td colspan="4" class="head1">Search</td>
                </tr>
                <tr>
					<td width="12%"><strong>Punch Date:</strong></td>
					<td width="29%">
						<input name="min_date" type="text" id="min_date" size="15" value="<? echo $min_date; ?>" >
					</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<!--
					<td width="12%"><strong>To:</strong></td>
					<td width="29%">
						<input name="max_date" type="text" id="max_date" size="15" value="<? echo $max_date; ?>" >
					</td>
					-->
				</tr>
				<tr>
					<td><strong>Process</strong></td>
					<td>
						<select name="process" id="process">
							<option value="">Please Select</option>
							<option value="INHOUSE" <? if($process=="INHOUSE") echo "selected"; ?>>INHOUSE</option>
							<option value="PREFERRED" <? if($process=="PREFERRED") echo "selected"; ?>>PREFERRED</option>
							<option value="TWL" <? if($process=="TWL") echo "selected"; ?>>TWL</option>
							<option value="HL" <? if($process=="HL") echo "selected"; ?>>HL</option>
							<option value="DIGITECH" <? if($process=="DIGITECH") echo "selected"; ?>>DIGITECH</option>
							<option value="ICCS" <? if($process=="ICCS") echo "selected"; ?>>ICCS</option>
						</select>
					</td>
					<td><strong>Agents:</strong></td>
					<td>
						<select name="agents" id="agents">
							<option value="All">All</option>
							<?php
							$getAgentsSql = "SELECT BidderID,Associated_Bank,Status FROM Bidders WHERE leadidentifier IN ('".$leadidentifierCsvStr."')";
							$getAgentsResult = $obj->fun_db_query($getAgentsSql);
							while($getAgentsRow = $obj->fun_db_fetch_rs_assoc($getAgentsResult))
							{
								$BidderID = $getAgentsRow['BidderID'];
								$Associated_Bank = $getAgentsRow['Associated_Bank'];
								$Status = $getAgentsRow['Status'];
								if($Status==1)
								{
									$statusValue = "Enabled";
								}else{
									$statusValue = "Disabled";
								}
								?>
								<option value="<?php echo $BidderID; ?>" <? if($BidderID==$agents) echo "selected"; ?> <?php if($Status==1) { ?> style="font-weight:bold;" <?php } ?>><?php echo $BidderID; ?>(<?php echo $statusValue; ?>)</option>
							<?php
							}
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td><strong>Status</strong></td>
					<td>
						<select name="statuscode" id="statuscode">
							<option value="">Please Select</option>
							<option value="1" <? if($statuscode==1) echo "selected"; ?>>1</option>
							<!--<option value="2" <? if($statuscode==2) echo "selected"; ?>>2</option>-->
							<option value="3" <? if($statuscode==3) echo "selected"; ?>>3</option>
							<!--<option value="4" <? if($statuscode==4) echo "selected"; ?>>4</option>
							<option value="5" <? if($statuscode==5) echo "selected"; ?>>5</option>
							<option value="6" <? if($statuscode==6) echo "selected"; ?>>6</option>-->
							<option value="7" <? if($statuscode==7) echo "selected"; ?>>7</option>
						</select>
					</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
				 <tr>
					<td align="center" colspan="4"><input name="Submit" type="submit" class="bluebutton" value="Submit" border="0"></td>
                </tr>
				</form>
			</table>
            <p>&nbsp;</p>
            <?php
            if($search=="y")
			{
			?>
			<table width="458" border="1" cellpadding="4" cellspacing="1" class="blueborder" bgcolor="#FFFFFF">
				<tr>
					<td align="center"><strong>Agent ID</strong></td>
					<td align="center"><strong>Count</strong></td>
				</tr>
				<?php
				//$min_date=$min_date." 00:00:00";
				//$max_date=$max_date." 23:59:59";
				if($agents=='All')
				{
					$allBidders = '';	
					$getAgentsSql = "SELECT BidderID,Associated_Bank,Status FROM Bidders WHERE leadidentifier IN ('".$leadidentifierCsvStr."')";
					$getAgentsResult = $obj->fun_db_query($getAgentsSql);
					while($getAgentsRow = $obj->fun_db_fetch_rs_assoc($getAgentsResult))
					{
						$allBidders[] = $getAgentsRow['BidderID'];
					}
					$bidderidStr = implode(',',$allBidders );
				}
				else
				{
					$bidderidStr = $agents;
				}
				
				if($process == 'INHOUSE' || $process == 'DIGITECH' || $process == 'ICCS'){
					$leadCountSql = "SELECT COUNT(*) as countLeads, BidderID FROM lead_allocate as la JOIN Req_Credit_Card_Sms as rccs ON ((la.AllRequestID = rccs.RequestID) AND (rccs.UserID != 0)) JOIN sbi_credit_card_5633 as scc ON (scc.RequestID = rccs.UserID) WHERE scc.ProcessingStatus = '".$statuscode."' AND DATE(scc.first_dated) = '".$min_date."' AND la.BidderID IN (".$bidderidStr.") GROUP BY la.BidderID ORDER BY la.BidderID ASC";
				}
				elseif($process == 'TWL'){
					$leadCountSql = "SELECT COUNT(*) as countLeads, '5923' as BidderID FROM sbi_ccoffers_directonsite as scd JOIN sbi_credit_card_5633 as scc ON (scc.RequestID = scd.sbiccoffersid) WHERE scc.ProcessingStatus = '".$statuscode."' AND DATE(scc.first_dated) = '".$min_date."' AND (process_type='TWL_LMS' OR productflag=10)";
				}
				else{
					$leadCountSql = "SELECT COUNT(*) as countLeads, BidderID FROM lead_allocate as la JOIN Req_Credit_Card as rcc ON ((la.AllRequestID = rcc.RequestID)) JOIN sbi_credit_card_5633 as scc ON (scc.RequestID = rcc.RequestID) WHERE scc.ProcessingStatus = '".$statuscode."' AND DATE(scc.first_dated) = '".$min_date."' AND la.BidderID IN (".$bidderidStr.") GROUP BY la.BidderID ORDER BY la.BidderID ASC";
				}
				//echo $leadCountSql;
				$leadCountQuery= $obj->fun_db_query($leadCountSql);
				$w = 1;
				while($row = $obj->fun_db_fetch_rs_assoc($leadCountQuery))
				{
					if ($w % 2 == 1) {
						$Class = "class=\"OddClass\"";
					} else {
						$Class = "class=\"EvenClass\"";
					}
					$countLeads = $row['countLeads'];
					$BidderID = $row['BidderID'];
				?>
				<tr <?php echo $Class; ?>>
					<td align="center" ><a href="cc_sbi_agents_status_details.php?agentid=<?php echo $BidderID;?>&statuscode=<?php echo $statuscode;?>&process=<?php echo $process;?>&min_date=<?php echo $min_date;?>" target="_blank" ><?php echo $BidderID; ?></a></td>
					<td align="center" ><?php echo $countLeads; ?></td>
                </tr>
				<?php
					$w++;
				}
				?>
			</table>		
			<?php		
			}
			?>
		</div>
		</td>
	</tr>
</table>
</div>
<script>
	$(document).ready(function(){
		$('#process').change(function(){
			var process = $(this).val();
			
			$.ajax({
				type: 'POST',
				data:{
					method:'GetAgentsList',
					process: process,
				},
				success: function(response){
					//console.log(response);
					var agentsJson = $.parseJSON(response);
					var agentsArr = agentsJson.AgentsArr;
					
					var htmlcode = '<option value="All">All</option>';

					$.each(agentsArr, function(key, value) {
						var BidderID = value['BidderID'];
						var Associated_Bank = value['Associated_Bank'];
						var Status = value['Status'];
						
						var statusvalue = '';
						var style = '';
						if(Status==1){
							statusValue = "Enabled";
							style = "style=font-weight:bold;";
						}
						else{
							statusValue = "Disabled";
						}

						htmlcode += '<option value="'+BidderID+'"'+style+'>'+BidderID+'('+statusValue+')</option>';
						//$('#agents').html(htmlcode);
					});
					$('#agents').html(htmlcode);
				}
			});
		});
	});
</script>
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
<?php
function getProcessLeadIdentifier($process){
	$leadidentifierCsvStr = '';
	
	if($process == 'INHOUSE'){
		$leadidentifierCsvStr = 'diallerleadccsmsnew';
	}
	elseif($process == 'PREFERRED'){
		$leadidentifierCsvStr = 'diallerleadcc';
	}
	elseif($process == 'TWL'){
		$leadidentifierCsvStr = 'diallerleadcc1';
	}
	elseif($process == 'HL'){
		$leadidentifierCsvStr = 'CCTRANSFER2CALLER';
	}
	elseif($process == 'DIGITECH'){
		$leadidentifierCsvStr = 'sbicallerdigilms_cc';
	}
	elseif($process == 'ICCS'){
		$leadidentifierCsvStr = 'diallercallerccpredictive';
	}
	else{
		$leadidentifierCsvStr = 'diallerleadcc';
	}
	
	return $leadidentifierCsvStr;
}
?>
