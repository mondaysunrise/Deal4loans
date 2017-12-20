<?php
//error_reporting(E_ALL);
//ini_set('display_errors',1);

require 'scripts/session_check_online.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';

if($_SESSION["BidderID"] != '6769') {  echo "You are not authorised to view this details."; die();  }

$errorMsg = '';

if($_POST['method'] == 'EnablePunch'){
	$requestID = $_POST['RequestID'];
	$pancard = $_POST['PAN'];
	$updateStatusSql = "UPDATE sbi_credit_card_5633 SET noresponse_status = 1 WHERE request_xml LIKE '%".$requestID."%' AND request_xml LIKE '%".$pancard."%' AND response_xml = ''";
	$updateStatusResult = d4l_ExecQuery($updateStatusSql);
	$updateStatusAffectedRows = d4l_mysqli_affected_rows();
	if($updateStatusAffectedRows > 0){
		echo 'Success';
		exit;
	}
	else{
		echo 'Failure';
		exit;
	}
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
	$RequestID = !empty($_REQUEST['RequestID']) ? $_REQUEST['RequestID'] : '';
	$PAN = !empty($_REQUEST['PAN']) ? $_REQUEST['PAN'] : '';

	$data = array();

	if(empty($RequestID) || empty($PAN)){
		$errorMsg = 'Please enter both values.';
	}
	else{
		//Query To check records who have only one entry and their response_xml is blank in webservice_log_sbi table
		$checkNoResponseSql = "SELECT sbiccid, substring_index(substring_index(request_xml, '<TextSpareField1>', -1), '</TextSpareField1>', 1) as RequestID, substring_index(substring_index(request_xml, '<PAN>', -1), '</PAN>', 1) as PAN, DATE(first_dated) as PunchDate FROM `webservice_log_sbi` WHERE cc_requestid IN (SELECT cc_requestid FROM (select cc_requestid, COUNT(cc_requestid) AS c FROM `webservice_log_sbi` GROUP BY cc_requestid HAVING C < 2 ) as temp) AND response_xml = '' AND request_xml LIKE '%".$RequestID."%' AND request_xml LIKE '%".$PAN."%'";
		//echo $sql.'<br>';
		$checkNoResponseResult = d4l_ExecQuery($checkNoResponseSql);
		while($row = d4l_mysql_fetch_assoc($checkNoResponseResult)){
			$getNoResponseStatusSql = "SELECT noresponse_status FROM `sbi_credit_card_5633` WHERE request_xml LIKE '%".$RequestID."%' AND request_xml LIKE '%".$PAN."%' AND response_xml = '' AND sbiccid = '".$row['sbiccid']."'";
			$getNoResponseStatusResult = d4l_ExecQuery($getNoResponseStatusSql);
			$getNoResponseStatusResponse = d4l_mysql_fetch_assoc($getNoResponseStatusResult);
			$row['noresponse_status'] = $getNoResponseStatusResponse['noresponse_status'];
			$data[] = $row;
		}
	}
}
//echo '<pre>';print_r($data);exit;
?>
<html>
<head>
<title>Enable No Response Leads</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="js/jquery-2.1.4.min.js" type="text/javascript"></script>
<style type="text/css">
.btn-enable {
	color: #FFF;
    text-align: center;
    font-family: Arial, Helvetica, sans-serif;
    font-size: 12px;
    border-radius: 5px;
    background: #F00;
    padding: 5px;
}
.btn-disable {
	color: #FFF;
    text-align: center;
    font-family: Arial, Helvetica, sans-serif;
    font-size: 12px;
    border-radius: 5px;
    background: #9e9e9e;
    padding: 5px;
}
</style>
</head>
<body>
<table width="100%" border="0"  align="center" cellpadding="0" cellspacing="0" >
<tr>
	<td align="right">
		<a href="/callinglms/cc_lms_dashboard_sbi.php">Dashboard</a>
		<!--<a href="convertcsvfiletostring.php" target="blank">Convert Csv File To String</a>-->
	</td>
</tr>
<tr>
    <td align="center">
	<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#45B2D8">
		<tr>
			<td>
				<form name="frmsearch" action="getNoResponseSBI.php" method="post">
					<div class="div-lead-left">
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td>&nbsp;</td>
							</tr>
							<tr>
								<td width="23%">
									<input type="text" name="RequestID" id="RequestID" style="width:80%; height:40px;" placeholder="RequestID" value="<?php echo $RequestID; ?>">
								</td>
								<td width="23%">
									<input type="text" name="PAN" id="PAN" style="width:80%; height:40px;" placeholder="PAN" value="<?php echo $PAN; ?>">
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
			<td width="8%" align="center" bgcolor="#FFFFFF" class="style2"><strong>LeadID</strong></td>
			<td width="15%" align="center" bgcolor="#FFFFFF" class="style2"><strong>PAN</strong></td>
			<td width="15%" align="center" bgcolor="#FFFFFF" class="style2"><strong>PunchDate</strong></td>
			<td width="10%" align="center" bgcolor="#FFFFFF" class="style2"><strong>Option</strong></td>
		</tr>
		<?php
		foreach($data as $key=>$val){
		?>
		<tr>
			<td width="8%" align="center" bgcolor="#FFFFFF" class="style2"><?php echo $val['RequestID']; ?></td>
			<td width="8%" align="center" bgcolor="#FFFFFF" class="style2"><?php echo $val['PAN']; ?></td>
			<td width="15%" align="center" bgcolor="#FFFFFF" class="style2"><?php echo $val['PunchDate']; ?></td>
			<td width="10%" align="center" bgcolor="#FFFFFF" class="style2">
				<input type="button" value="Enable" onclick="enablePunch('<?php echo $val['RequestID']; ?>', '<?php echo $val['PAN']; ?>')" 
				<?php if($val['noresponse_status'] == 0){ ?> class="btn-enable" <?php }else{ ?> class="btn-disable" disabled="true" <?php } ?> />
			</td>
		</tr>
		<?php
		}
		?>
	</table>
	<br>
	<?php
		//Show Button to punch data
		$checkButtonSql = "SELECT * FROM `sbi_credit_card_5633` WHERE request_xml LIKE '%".$RequestID."%' AND request_xml LIKE '%".$PAN."%' AND response_xml = '' AND noresponse_status = 1";
		$checkButtonResult = d4l_ExecQuery($checkButtonSql);
		$checkButtonRows = d4l_mysql_num_rows($checkButtonResult);
		if($checkButtonRows > 0){
	?>
		<a id="punchlink" href="soapservice_sbi5633_noresponse.php?sbiccid=<?php echo $val['sbiccid']; ?>" target="_blank" style="color:#FFF; background-color:#C00;">SBI Send now</a>
	<?php
		}
	?>
	<br>
	<!-- SBI Response Code Start -->
	<!--
	<table style='border:1px dotted #9C9A9C;' cellspacing="0" cellpadding="5" width="100%" height="80%" align="center" border="1" >
		<tr><td colspan="4" align="left"><b>SBI Response:<b></td></tr>
		<tr>
			<td colspan="4">
			<?php
			/*
			$sbiDetailsQry ="SELECT * FROM sbi_credit_card_5633 WHERE sbiccid='".$val['sbiccid']."'";
			$sbiDetailsResult = d4l_ExecQuery($sbiDetailsQry);
			$numSbiRows = d4l_mysql_num_rows($sbiDetailsResult);
			if($numSbiRows>0)
			{
				$sbiDetailsArr = d4l_mysql_fetch_array($sbiDetailsResult); 
				if(count($sbiDetailsArr)) {
				?>
				<table align="left">
					<tr>
						<td>Application Number : <? echo $sbiDetailsArr["ApplicationNumber"]; ?> <br>Status Code : <? echo $sbiDetailsArr["StatusCode"]; ?><br>Processing Status : <? echo $sbiDetailsArr["ProcessingStatus"]; ?><br>Messages : <? echo $sbiDetailsArr["Messages"]; ?><br>message : <? echo $sbiDetailsArr["message"]; ?></td>
					</tr>
				</table>
				<?php 
				}
			}
			*/
			?>
			</td>
		</tr>
	</table>
	-->
	<!-- SBI Response Code End -->
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
<script>
	$(document).ready(function(){
		$('#punchlink').on('click', function(){
			$('#punchlink').hide();
		});
	});
	

	function enablePunch(RequestID,PAN){
		$.ajax({
			type: 'POST',
			url: 'getNoResponseSBI.php',
			data: {
				method: 'EnablePunch',
				RequestID: RequestID,
				PAN: PAN,
			},
			success: function(response){
				console.log(response);
				if(response == 'Success'){
					 window.location.reload();
				}
			}
		});
	}
</script>
</body>
</html>
