<?php
require 'scripts/db_init.php';
require 'scripts/functions.php';
require 'icalldigitechapi-functions.php';
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
else if($function=='disconnectPred')
{
	echo disconnectPredective($RequestID, $agent_user,$disPos);
}
else if($function=='disposePred')
{
	echo disposePredective($RequestID, $agent_user,$disPos);
}

function call($RequestID, $agent_user)
{
	$getUserDetailsSql = "select Name, Mobile_Number from Req_Credit_Card where RequestID = '".$RequestID."'";
	$getUserDetailsQuery = ExecQuery($getUserDetailsSql);
	$name = mysql_result($getUserDetailsQuery,0,'Name');
	$mobile = mysql_result($getUserDetailsQuery,0,'Mobile_Number');
	
	$qryCheck = "SELECT leadidentifier, Profile FROM Bidders where BidderID='".$agent_user."'";
	$qryCheckQuery = ExecQuery($qryCheck);
	$lead_identifier = mysql_result($qryCheckQuery,0,'leadidentifier');
	$agent_user= mysql_result($qryCheckQuery,0,'Profile');
	
	$campaign_id=91;//Provided by iCallMate Team
	$leadId=552;
	
	if($lead_identifier=='amexdigicallerlms_cc')
	{
//		105,661
		$campaign_id=105;
		$leadId=661;
	}
	else if($lead_identifier=='amexdigicallerlms_cc')
	{
		$campaign_id=103;
		$leadId=662;
	
	}

	//echo $RequestID.", ".$mobile.", ".$agent_user.", ".$campaign_id.", ".$leadId.", ".$lead_identifier; 
	$c2cConnection = new getExternalCallAPI();
	echo $c2cConnection->funMakeCall($RequestID, $mobile, $agent_user, $campaign_id, $leadId, $lead_identifier);
}

function disconnect($RequestID, $agent_user, $disPos)
{
	$CallInvokeID=0;
	$State=1;

	$c2cConnection = new getExternalCallAPI();
	$dispRemarks = 'Customer Not Taken Call';
	$CallId = 0;
	//echo $RequestID.", ".$CallId.", ".$dispId.", ".$dispRemarks.", ".$agent_user;
	echo $c2cConnection->funDisposeCall($RequestID, $CallId, $disPos, $dispRemarks, $agent_user);			
	echo $c2cConnection->funDropCall($RequestID, $agent_user, $CallInvokeID, $State);
	
	
}

function disconnectPredective($RequestID, $agent_user, $disPos)
{
	$CallInvokeID=0;
	$State=1;

	$c2cConnection = new getExternalCallAPI();
	$dispRemarks = 'Customer Not Taken Call';
	$CallId = 0;
	//echo $RequestID.", ".$CallId.", ".$dispId.", ".$dispRemarks.", ".$agent_user;
	echo $c2cConnection->funDropCall($RequestID, $agent_user, $CallInvokeID, $State);
}

function disposePredective($RequestID, $agent_user, $disPos)
{
	$CallInvokeID=0;
	$State=1;

	$c2cConnection = new getExternalCallAPI();
	$dispRemarks = 'Customer Not Taken Call';
	$CallId = 0;
	//echo $RequestID.", ".$CallId.", ".$dispId.", ".$dispRemarks.", ".$agent_user;
	echo $c2cConnection->funDisposeCall($RequestID, $CallId, $disPos, $dispRemarks, $agent_user);			
}

//external_dialer_c2c_bl.php?RequestID=2173503&agent_user=6285&functionC=disconnect
?>
