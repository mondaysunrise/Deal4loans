<?php
require 'scripts/db_init.php';
require 'scripts/functions.php';
require 'icallapi-functions.php';
//print_r($_REQUEST);
$RequestID = $_REQUEST['RequestID'];
$agent_user = $_REQUEST['agent_user'];
$disPos = $_REQUEST['disPos'];
$function = $_REQUEST['functionC'];

if($function=='call')
{
	echo call($RequestID, $agent_user);
}
else if($function=='disconnect')
{
	
	echo disconnect($RequestID, $agent_user,$disPos);
}

function call($RequestID, $agent_user)
{
	$getUserDetailsSql = "select Name, Mobile_Number from Req_Loan_Personal where RequestID = '".$RequestID."'";
	$getUserDetailsQuery = ExecQuery($getUserDetailsSql);
	$name = mysql_result($getUserDetailsQuery,0,'Name');
	$mobile = mysql_result($getUserDetailsQuery,0,'Mobile_Number');
	
	$qryCheck = "SELECT leadidentifier, Profile FROM Bidders where BidderID='".$agent_user."'";
	$qryCheckQuery = ExecQuery($qryCheck);
	$lead_identifier = mysql_result($qryCheckQuery,0,'leadidentifier');
	
	

	if($agent_user==6361)
	{
		$campaign_id=97;//Provided by iCallMate Team ICICI Bangalore
		$leadId=578;
	}
	else if($agent_user==6411)
	{
		$campaign_id=95;//Provided by iCallMate Team Tata Capital
		$leadId=570;
	}
	else 
	{
		$campaign_id=86;//Provided by iCallMate Team
		$leadId=540;	
	}
	//echo $RequestID.", ".$mobile.", ".$agent_user.", ".$campaign_id.", ".$leadId.", ".$lead_identifier; 
	$c2cConnection = new getExternalCallAPI();
	echo $c2cConnection->funMakeCall($RequestID, $mobile, $agent_user, $campaign_id, $leadId, $lead_identifier);
}

function disconnect($RequestID, $agent_user, $disPos)
{
	$CallInvokeID=0;
	$State=1;
	if($agent_user == 6285)
	{ $agent_user = 6825; }

	$c2cConnection = new getExternalCallAPI();
	$dispRemarks = 'Customer Not Taken Call';
	$CallId = 0;
	//echo $RequestID.", ".$CallId.", ".$dispId.", ".$dispRemarks.", ".$agent_user;
	echo $c2cConnection->funDisposeCall($RequestID, $CallId, $disPos, $dispRemarks, $agent_user);			
	echo $c2cConnection->funDropCall($RequestID, $agent_user, $CallInvokeID, $State);
	
	
}


//external_dialer_c2c_bl.php?RequestID=2173503&agent_user=6285&functionC=disconnect
?>
