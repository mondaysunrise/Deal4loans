<?php
require_once("includes/application-top-inner.php");
//print_r($_POST);

$toActivate = $_POST['toActivate'];
print_r($toActivate);
$toActivateStr = implode(',', $toActivate);

$updateSql = "update Bidders set Status=0 where leadidentifier='hlallocatelmsCitywise'";
$resultUpdate = $obj->fun_db_query($updateSql);

$updateSqlStatus = "update Bidders set Status=1 where leadidentifier='hlallocatelmsCitywise' and BidderID in (".$toActivateStr.")";
$resultStatus = $obj->fun_db_query($updateSqlStatus);

$maxSequence = count($toActivate);

$getSequenceSql = "select * from lead_allocation_table where Citywise = 'hlallocatelmsCitywise'";
$result = $obj->fun_db_query($getSequenceSql);
while($rowsCon = $obj->fun_db_fetch_rs_object($result))
{
	$last_allocated_to = $rowsCon->last_allocated_to;
}

if($maxSequence<=$last_allocated_to)
{
	$last_allocated_to = 1;
}
//echo "<br>";

 $updateSqlAllocation = "update lead_allocation_table set last_allocated_to='".$last_allocated_to."', total_no_agents='".$maxSequence."' where Citywise = 'hlallocatelmsCitywise'";
$resultupdateSqlAllocation = $obj->fun_db_query($updateSqlAllocation);

header("Location:hlcallinglms_agentsstatus.php?msg=done");
exit;
?>