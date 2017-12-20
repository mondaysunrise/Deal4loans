<?php 
$zip2auth_url = 'http://www.zipdial.com/zip2auth';
$transactionToken = $_REQUEST['transaction_token'];
$securityToken = '04f0294522530730a4671c96a8a35cac6c47714d';
$uri = "transaction_token=".$transactionToken.'&token='.$securityToken;
$response = file_get_contents($zip2auth_url.'/transactions/poll_transaction_status?'.$uri);
$result= array();
$result = json_decode($response);
?>
<style>
.response{
border:1px solid #666666;
font:12px Arial,Helvetica,sans-serif;
position:relative;
top:100px;
}
.response tr{
line-height: 20px;
}
.response td{
padding-left:15px;
}
.evenRow{background-color: #E6E6E6;}
.label{
font-family: Arial;
    font-size: 12px;
    font-weight: bold;
    text-align: left;
    color:#333333;
}
.powerTxtHeader {
    background-color: #666666;
    color: #FFFFFF;
    font-family: Arial;
    font-size: 12px;
    font-weight: bold;
    text-align: center;
}
</style>
<table cellspacing="2" cellpadding="0" width="40%" align="center" class="response">
	<tr>
		<td class="powerTxtHeader" colspan="2" align="center"> Z2V Transaction Report</td>
	</tr>
	<tr>
		<td width="50%" class="label">Message</td>
		<td width="50%" ><?php echo $result->message;?></td>
	</tr>
	<tr class="evenRow">
		<td class="label">Status</td>
		<td ><?php echo $result->status;?></td>
	</tr>
	<tr>
		<td class="label">ZipDial Number</td>
		<td ><?php echo $result->zipdial_no;?></td>
	</tr>
	<tr class="evenRow">
		<td class="label">Transaction Start Time</td>
		<td><?php echo $result->transaction_time;?></td>
	</tr>
	<tr>
		<td class="label">Customer Call Time</td>
		<td><?php echo $result->customer_call_time;?></td>
	</tr>
	<tr class="evenRow">
		<td class="label">Customer Mobile Number</td>
		<td><?php echo $result->mobile_no;?></td>
	</tr>
	<tr>
		<td class="label">Transaction Id</td>
		<td><?php echo $result->transaction_id;?></td>
	</tr>
	
</table>