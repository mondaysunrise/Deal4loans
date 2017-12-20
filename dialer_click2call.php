<?php
require 'scripts/db_init.php';
require 'scripts/functions.php';
require 'dialer_click2call_function.php';

$RequestID = $_REQUEST['RequestID'];
$agent_user = $_REQUEST['agent_user'];

$getUserDetailsSql = "select Name, Mobile_Number from Req_Loan_Personal where RequestID = '".$RequestID."'";
$getUserDetailsQuery = ExecQuery($getUserDetailsSql);
$name = mysql_result($getUserDetailsQuery,0,'Name');
$mobile = mysql_result($getUserDetailsQuery,0,'Mobile_Number');

$qryCheck = "SELECT * FROM manual_user_details where BidderID='".$agent_user."'";
$qryCheckQuery = ExecQuery($qryCheck);
$lead_identifier = mysql_result($qryCheckQuery,0,'source');
$campaign_id = mysql_result($qryCheckQuery,0,'campaign_id');
$reply_type = 1;

$qryCheck = "SELECT leadidentifier, Profile,dialler_process FROM Bidders where BidderID='".$agent_user."'";
$qryCheckQuery = ExecQuery($qryCheck);

$dialler_process = mysql_result($qryCheckQuery,0,'dialler_process');
if($dialler_process==2)
{
	$campaign_id = 9899;//PL [List ID]
	echo click2call_addlead_dialler2($RequestID, $mobile, $lead_identifier,$agent_user,$dialler_process,$campaign_id,$reply_type);
}
else if($dialler_process==3)
{
	echo click2call_addlead_dialler3($agent_user, $mobile, $RequestID);
}
else
{
	echo click2call($RequestID, $name, $mobile, $reply_type, $lead_identifier,$agent_user,$campaign_id);
}
?>