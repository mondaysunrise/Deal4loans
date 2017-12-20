<?php

require 'scripts/db_init.php';
require 'scripts/functions.php';

//error_reporting(E_ALL);
//ini_set('display_errors',1);

function ccMasking($number, $maskingCharacter = 'X') 
{
	return substr($number, 0, 2) . str_repeat($maskingCharacter, strlen($number) - 4) . substr($number, -2);
}


if(isset($_POST['datepick']) && !empty($_POST['datepick'])){
	$selectedMonthYear = $_POST['datepick'];
	list($year, $month) = explode('-', $selectedMonthYear);
}else{
	$month = date('m');
	$year = date('Y');
}


$sql= '';
$data = array();
$sql = "SELECT cc_requestid, substring_index(substring_index(request_data, '<tem:FNAME>', -1),'</tem:FNAME>', 1) as first_name, substring_index(substring_index(request_data, '<tem:LNAME>', -1),'</tem:LNAME>', 1) as last_name, substring_index(substring_index(request_data, '<tem:MOBILE>', -1), '</tem:MOBILE>', 1) as Mobile, request_data, response_data, lead_repush_date FROM `credit_card_banks_apply` WHERE applied_bankname = 'American Express' AND lead_repush > 0 AND response_data != '' AND Month(lead_repush_date) = '".$month."' AND Year(lead_repush_date) = '".$year."' ORDER BY date_created  ASC";

//echo $sql.'<br>';
$sqlResult = d4l_ExecQuery($sql);
while($row = d4l_mysql_fetch_assoc($sqlResult)){
	$requestdata=trim($row["request_data"]);
	$responsedata=trim($row["response_data"]);
	
	$xmlArray = str_ireplace('<soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema"><soap:Body>','',$responsedata);
	$xmlArray = str_ireplace('</soap:Body></soap:Envelope>','',$xmlArray);
	$xmlArray = simplexml_load_string($xmlArray);
	$json = json_encode($xmlArray);
	$responseArray = json_decode($json,true);
	//print_r($responseArray);
	$msg = '';
	$reasonMsg = '';
	if(isset($responseArray['submitApplicationResult'])){
		$response = $responseArray['submitApplicationResult']; 
		if(isset($response) && $response['status']['success'] == "true"){
			if($response['successResponse']['approved'] == "true"){
				$msg = "The Application is submitted successfully.";
			}
			elseif($response['successResponse']['decline'] == "true"){ 
				$msg = "The Application is Decline.";
				foreach($response['successResponse']['declineReason'] as $key=>$reason){
					if($reason == "true"){
						$reasonMsg .= "Decline reason : $key.<br>";
					}
				}
			}
			elseif($response['successResponse']['pending'] == "true"){
				$msg = "The Application is Pending.";
			}
			elseif($response['successResponse']['cancelled'] == "true"){
				$msg = "The Application is Cancelled.";
			}
		}else{
			if($response['failureResponse']['validationError']['errorDesc']){
				$msg = "The Application is rejected for now.";
				$reasonMsg = "Reason : ".$response['failureResponse']['validationError']['errorDesc'];
			}
			elseif($response['failureResponse']['unhandledException'] == "true"){
				$msg = "The Application is rejected for now.";
				$reasonMsg = "Reason : unhandled Exception";
			}
		}
	}
	if(!empty($requestdata) && isset($responsedata) && empty($responsedata)){
		$msg = "No Response From Amex.<br>";
	}
	
	$row['msg'] = $msg;
	$row['reason'] = $reasonMsg;
	
	unset($row['request_data']);
	unset($row['response_data']);
	$data[] = $row;
}

//echo '<pre>';print_r($data);

?>
<html>
<head>
<link rel="stylesheet"href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script>
$(function() 
{
	$("#datepick").datepicker({
		changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        dateFormat: 'yy-mm',
        onClose: function(dateText, inst) { 
            $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
        }
	});
});

</script>
<style>
.ui-datepicker-calendar {
    display: none;
}
</style>
</head>
<body>
<table width="100%" border="0"  align="center" cellpadding="0" cellspacing="0" >
	<tr>
		<td align="center">
			<form action="" method="POST" name="DateValfrm">
				Select month and year
				<input type="text" id="datepick" name="datepick">
				<input type="submit" id="submitbtn" name="submitbtn">
			</form>
		</td>
	</tr>
<tr>
    <td align="center">
	<?php
	if(count($data)){
	?>
	<table width="100%" border="1" align="center" cellpadding="1" cellspacing="1" bgcolor="#FFFFFF" >
		<tr>
			<td width="5%" align="center" bgcolor="#FFFFFF" class="style2">S.No</td>
			<td width="8%" align="center" bgcolor="#FFFFFF" class="style2">RequestID</td>
			<td width="15%" align="center" bgcolor="#FFFFFF" class="style2">First_Name</td>
			<td width="15%" align="center" bgcolor="#FFFFFF" class="style2">Last Name</td>
			<td width="8%" align="center" bgcolor="#FFFFFF" class="style2">Mobile</td>
			<!--<td width="15%" align="center" bgcolor="#FFFFFF" class="style2">Request</td>
			<td width="8%" align="center" bgcolor="#FFFFFF" class="style2">Response</td>-->
			<td width="8%" align="center" bgcolor="#FFFFFF" class="style2">Msg</td>
			<td width="5%" align="center" bgcolor="#FFFFFF" class="style2">Reason</td>
			<td width="10%" align="center" bgcolor="#FFFFFF" class="style2">PunchDate</td>
		</tr>
		<?php
		foreach($data as $key=>$val){
		?>
		<tr>
			<td width="5%" align="center" bgcolor="#FFFFFF" class="style2"><?php echo $key+1; ?></td>
			<td width="8%" align="center" bgcolor="#FFFFFF" class="style2"><?php echo $val['cc_requestid']; ?></td>
			<td width="15%" align="center" bgcolor="#FFFFFF" class="style2"><?php echo $val['first_name']; ?></td>
			<td width="15%" align="center" bgcolor="#FFFFFF" class="style2"><?php echo $val['last_name']; ?></td>
			<td width="8%" align="center" bgcolor="#FFFFFF" class="style2"><?php echo ccMasking($val['Mobile']); ?></td>
			<!--<td width="15%" align="center" bgcolor="#FFFFFF" class="style2"><?php ///echo $val['request_data']; ?></td>
			<td width="8%" align="center" bgcolor="#FFFFFF" class="style2"><?php //echo $val['response_data']; ?></td>-->
			<td width="8%" align="center" bgcolor="#FFFFFF" class="style2"><?php echo $val['msg']; ?></td>
			<td width="5%" align="center" bgcolor="#FFFFFF" class="style2"><?php echo $val['reason']; ?></td>
			<td width="10%" align="center" bgcolor="#FFFFFF" class="style2"><?php echo $val['lead_repush_date']; ?></td>
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
