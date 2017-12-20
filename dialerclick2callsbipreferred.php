<?php
require 'scripts/db_init.php';
require 'scripts/functions.php';
require 'dialer_click2call_function.php';

$RequestID = $_REQUEST['RequestID'];
$agent_user = $_REQUEST['agent_user'];

$getUserDetailsSql = "select Name, Mobile_Number from Req_Credit_Card where RequestID = '".$RequestID."'";
$getUserDetailsQuery = ExecQuery($getUserDetailsSql);
$name = mysql_result($getUserDetailsQuery,0,'Name');
$mobile = mysql_result($getUserDetailsQuery,0,'Mobile_Number');

$qryCheck = "SELECT leadidentifier, Profile,dialler_process FROM Bidders where BidderID='".$agent_user."'";//6703
$qryCheckQuery = ExecQuery($qryCheck);
$lead_identifier = mysql_result($qryCheckQuery,0,'leadidentifier');
$dialler_process = mysql_result($qryCheckQuery,0,'dialler_process');
$Profile= mysql_result($qryCheckQuery,0,'Profile');
if($Profile>0)
{
	$agent_user = $Profile;//6593
}

$campaign_id = 1518;//Change this
$reply_type = 4;
if($dialler_process==2)
{
	$campaign_id = 9898;//CC [List ID]
	echo click2call_addlead_dialler2($RequestID, $mobile, $lead_identifier,$agent_user,$dialler_process,$campaign_id,$reply_type);
}
else if($dialler_process==5)
{ //echo $agent_user.", ".$mobile.", ".$RequestID;
	echo click2call_addlead_dialler3($agent_user, $mobile, $RequestID,1010);
}
else
{
	echo click2call($RequestID, $name, $mobile, $reply_type, $lead_identifier,$agent_user,$campaign_id);
}
?>