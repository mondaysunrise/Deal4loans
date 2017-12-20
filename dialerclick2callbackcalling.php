<?php
require 'scripts/db_init.php';
require 'scripts/functions.php';
require 'dialer_click2call_function.php';

$RequestID = $_REQUEST['RequestID'];
$agent_user = $_REQUEST['agent_user'];

$getUserDetailsSql = "select Name, Mobile_Number from Req_PL_BackCalling where RequestID = '".$RequestID."'";
$getUserDetailsQuery = ExecQuery($getUserDetailsSql);
$name = mysql_result($getUserDetailsQuery,0,'Name');
$mobile = mysql_result($getUserDetailsQuery,0,'Mobile_Number');

$qryCheck = "SELECT leadidentifier,dialler_process FROM Bidders where BidderID='".$agent_user."'";
$qryCheckQuery = ExecQuery($qryCheck);
$lead_identifier = mysql_result($qryCheckQuery,0,'leadidentifier');
$dialler_process = mysql_result($qryCheckQuery,0,'dialler_process');
if($agent_user==6466)
{
	$campaign_id = 1520;
}
else if($agent_user==6467)
{
	$campaign_id = 1521;
}
else if($agent_user==6359)
{
	$campaign_id = 1522;
}
else if($agent_user==6358)
{
	$campaign_id = 1524;
}

$reply_type = 1;

if($dialler_process==2)
{
	$campaign_id = 9899;//PL [List ID]
	echo click2call_addlead_dialler2($RequestID, $mobile, $lead_identifier,$agent_user,$dialler_process,$campaign_id,$reply_type);
}
else if($dialler_process==3)
{
	echo click2call_addlead_dialler3($agent_user, $mobile, $RequestID);
}
else if($dialler_process==4)
{
	echo click2call_addlead_dialler3($agent_user, $mobile, $RequestID,1003);
}
else
{
	echo click2call($RequestID, $name, $mobile, $reply_type, $lead_identifier,$agent_user,$campaign_id);
}
?>