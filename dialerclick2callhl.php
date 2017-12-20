<?php
require 'scripts/db_init.php';
require 'scripts/functions.php';
require 'dialer_click2call_function.php';

$RequestID = $_REQUEST['RequestID'];
$agent_user = $_REQUEST['agent_user'];

$getUserDetailsSql = "select Name, Mobile_Number from Req_Loan_Home where RequestID = '".$RequestID."'";
$getUserDetailsQuery = ExecQuery($getUserDetailsSql);
$name = mysql_result($getUserDetailsQuery,0,'Name');
$mobile = mysql_result($getUserDetailsQuery,0,'Mobile_Number');

$qryCheck = "SELECT leadidentifier,dialler_process,Profile FROM Bidders where BidderID='".$agent_user."'";
$qryCheckQuery = ExecQuery($qryCheck);
$lead_identifier = mysql_result($qryCheckQuery,0,'leadidentifier');
$dialler_process = mysql_result($qryCheckQuery,0,'dialler_process');
$Profile = mysql_result($qryCheckQuery,0,'Profile');
if($Profile>0) { $agent_user=$Profile; }

$reply_type = 1;

if($dialler_process==2)
{
	$campaign_id = 9899;//PL [List ID]
	echo click2call_addlead_dialler2($RequestID, $mobile, $lead_identifier,$agent_user,$dialler_process,$campaign_id,$reply_type);
}
else if($dialler_process==3)
{ //echo $agent_user;
	echo click2call_addlead_dialler3($agent_user, $mobile, $RequestID);
}
else if($dialler_process==4)
{ //echo $agent_user;
	echo click2call_addlead_dialler3($agent_user, $mobile, $RequestID, 1008); //Check for List ID HL
}
else
{
	echo click2call($RequestID, $name, $mobile, $reply_type, $lead_identifier,$agent_user,$campaign_id);
}
?>