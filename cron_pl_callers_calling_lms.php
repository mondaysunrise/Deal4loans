<?php
require 'scripts/db_init.php';

ICICICPA();
INDUSINDCPA();
TATACAPITALCPA();

function ICICICPA()
{
	$bidderidlist = '6358,6359,6361,6482,6483,7049,7617,6459,6461,6462,6470,6539,6636,7126,7309,7311,7310';
	$allocation_table = 'client_lead_allocate';
	$product_table = 'Req_Loan_Personal';
	$feedback = " 'Not Contactable', 'Not Interested - Direct', 'Not Interested - Offer', 'Not Interested - Loan Amount', 'Ringing' ";
	$leadidentifier = 'ICICIBANKREC';	
	$lead_allocation_logic = '193';
	leadReChurning($bidderidlist,$allocation_table, $product_table, $feedback, $leadidentifier,$lead_allocation_logic );
}

function INDUSINDCPA()
{
	$bidderidlist = '6802,6803,7312,7127';
	$allocation_table = 'client_lead_allocate';
	$product_table = 'Req_Loan_Personal';
	$feedback = " 'Not Contactable', 'Not Interested - Direct', 'Not Interested - Offer', 'Not Interested - Loan Amount', 'Ringing' ";
	$leadidentifier = 'INDUSINDSALAccount';	
	$lead_allocation_logic = '194';
	leadReChurning($bidderidlist,$allocation_table, $product_table, $feedback, $leadidentifier,$lead_allocation_logic );
}


function TATACAPITALCPA()
{
	$bidderidlist = '6463,6977,6410';
	$allocation_table = 'client_lead_allocate';
	$product_table = 'Req_Loan_Personal';
	$feedback = " 'Not Contactable', 'Not Interested - Direct', 'Not Interested - Offer', 'Not Interested - Loan Amount', 'Ringing' ";
	$leadidentifier = 'TATACAPITALSALAccount';	
	$lead_allocation_logic = '195';
	leadReChurning($bidderidlist,$allocation_table, $product_table, $feedback, $leadidentifier,$lead_allocation_logic );
}


function leadReChurning($bidderidlist,$allocation_table, $product_table, $feedback, $leadidentifier, $lead_allocation_logic)
{
	$getActiveBiddersSql = "select BidderID from Bidders where (leadidentifier='".$leadidentifier."' and Status=1)";
	echo "<br>".$getActiveBiddersSql ."<br>";
	$getActiveBiddersQry = d4l_ExecQuery($getActiveBiddersSql);
	$recordCountActiveBidders = d4l_mysql_num_rows($getActiveBiddersQry);
	$BidderIDallArr= '';
	$counterVal = 1;
	for($i=0;$i<$recordCountActiveBidders;$i++)
	{	
		$BidderID =d4l_mysql_result($getActiveBiddersQry,$i,'BidderID');
		$BidderIDallArr[$counterVal] = $BidderID;
		$counterVal = $counterVal + 1;
	}
	$BidderIDallstr = implode(',', $BidderIDallArr);
	echo "<br>"; print_r($BidderIDallArr);
	echo "<br>".$BidderIDallstr ."<br>";
	
	$startprocess="Select total_lead_count From lead_allocation_table Where ( lead_allocation_logic='".$lead_allocation_logic."')";
	echo "<br>".$startprocess."<br>";
	$startprocessresult = d4l_ExecQuery($startprocess);
	$recordcount = d4l_mysql_num_rows($startprocessresult);
	$row=d4l_mysql_fetch_array($startprocessresult);
	$total_lead_count = $row["total_lead_count"];

	$days_ago = date('Y-m-d', mktime(0, 0, 0, date("m") , date("d") - 3, date("Y")));
	$min_date=$days_ago." 00:00:00";
	$min_date = "2017-12-01 00:00:00";
	$max_date=$days_ago." 23:23:59";

	$leadCountSql = "SELECT `RequestID`, `BidderID`, `leadid`, `Allocation_Date`, `old_bidderid`, Updated_Date, Feedback FROM ".$allocation_table.", ".$product_table." WHERE (".$allocation_table.".BidderID in (".$bidderidlist.") and ".$allocation_table.".Reply_Type=1 and ".$allocation_table.".AllRequestID=".$product_table.".RequestID and (".$allocation_table.".Allocation_Date Between '".$min_date."' and '".$max_date."' )) AND (".$allocation_table.".Feedback IN (".$feedback.")) AND leadid>'".$total_lead_count."'  group by ".$product_table.".Mobile_Number ORDER BY leadid asc" ;//LIMIT 0,1
	$leadPushQuery= d4l_ExecQuery($leadCountSql);
	$leadCount = d4l_mysql_num_rows($leadPushQuery);
	echo $leadCountSql;
	echo "<br>".$leadCount;
	echo "<br>";
//	die();
	for($i=0;$i<$leadCount;$i++)
	{
	
		$RequestID = d4l_mysql_result($leadPushQuery,$i,'RequestID');
		$Feedback= d4l_mysql_result($leadPushQuery,$i,'Feedback');
		$leadid = d4l_mysql_result($leadPushQuery,$i,'leadid');
		$BidderID = d4l_mysql_result($leadPushQuery,$i,'BidderID');
		$Allocation_Date = d4l_mysql_result($leadPushQuery,$i,'Allocation_Date');
		$old_bidderid= d4l_mysql_result($leadPushQuery,$i,'old_bidderid');
		//echo $leadid." - ".$RequestID." - ".$BidderID."<br />";
							
		$sequenceidSql="Select last_allocated_to,total_no_agents From lead_allocation_table Where (lead_allocation_logic='".$lead_allocation_logic."')";
		$sequenceidQuery= d4l_ExecQuery($sequenceidSql);
		$last_allocated_to = d4l_mysql_result($sequenceidQuery,0,'last_allocated_to');
		$total_no_agents = d4l_mysql_result($sequenceidQuery,0,'total_no_agents');
		if($total_no_agents>$last_allocated_to)
		{
			$sequence=$last_allocated_to+1;
		}
		else
		{
			$sequence=1;
		}
		
		$getDetailsSql = "select BidderID,Allocation_Date,Feedback,Comments from ".$allocation_table." where  leadid='".$leadid."'";
		$getDetailsQuery= d4l_ExecQuery($getDetailsSql);
		$iBidderID = d4l_mysql_result($getDetailsQuery,0,'BidderID');
		$iAllocation_Date = d4l_mysql_result($getDetailsQuery,0,'Allocation_Date');
		$Old_Feedback = d4l_mysql_result($getDetailsQuery,0,'Feedback');
		$Old_Comments = d4l_mysql_result($getDetailsQuery,0,'Comments');
						
		$updateSql = "update ".$allocation_table." set BidderID='".$BidderIDallArr[$sequence]."', Allocation_Date=Now(), old_bidderid='".$iBidderID."', old_allocated_date='".$iAllocation_Date."', Feedback='', Old_Feedback='".$Old_Feedback."', Comments='', Old_Comments='".$Old_Comments."' where leadid='".$leadid."' ";
		$updateTableQuery= d4l_ExecQuery($updateSql);
		echo $updateSql ."<br>";
		
		
		$updateLeadAllocationTableSql = "update lead_allocation_table set last_allocated_to='".$sequence."', total_lead_count='".$leadid."' where lead_allocation_logic='".$lead_allocation_logic."'";
		$updateLeadAllocationTableQuery= d4l_ExecQuery($updateLeadAllocationTableSql);
		echo $updateLeadAllocationTableSql."<br>";
		
	}
}
?>