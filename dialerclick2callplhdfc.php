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

$qryCheck = "SELECT leadidentifier FROM Bidders where BidderID='".$agent_user."'";
$qryCheckQuery = ExecQuery($qryCheck);
$lead_identifier = mysql_result($qryCheckQuery,0,'leadidentifier');
if($agent_user==6116)
{
	$campaign_id = 1507;
}
else if($agent_user==6117)
{
	$campaign_id = 1508;
}
$reply_type = 1;

echo click2call($RequestID, $name, $mobile, $reply_type, $lead_identifier,$agent_user,$campaign_id);
?>