<?php
	require 'scripts/db_init.php';
	require 'scripts/functions_nw.php';

$startprocess="Select * From lead_allocation_table Where (Citywise like '%ICICI Calling%' and BidderID=77)";
$startprocessresult = ExecQuery($startprocess);
$recordcount = mysql_num_rows($startprocessresult);
$row=mysql_fetch_array($startprocessresult);
$total_lead_count = $row["total_lead_count"];

if($total_lead_count>0)
{
	$select4mcards="Select * from icici_cards_calling Where (TelecallerID=0 and RequestID>'".$total_lead_count."')";
}
else
{
	$select4mcards="Select * from icici_cards_calling Where (TelecallerID=0)";
}

$select4mcardsresult = ExecQuery($select4mcards);
$recordcount1 = mysql_num_rows($select4mcardsresult);
$bidderID="";

while($row2 = mysql_fetch_array($select4mcardsresult))
{
	$icicirequestID = $row2["RequestID"];
	$TelecallerID = $row2["TelecallerID"];

	$sequenceid=ExecQuery("Select last_allocated_to,total_no_agents from lead_allocation_table Where (Citywise like '%ICICI Calling%' and BidderID=77)");
			$seqid = mysql_fetch_array($sequenceid);
			$last_allocated_to = $seqid["last_allocated_to"];
			$total_no_agents = $seqid["total_no_agents"];
			
			if($total_no_agents>$last_allocated_to)
			{
				$sequence=$last_allocated_to+1;
			}
			else
			{
				$sequence=1;
			}

			if($sequence==1){$bidderID="77";}
			elseif($sequence==2){$bidderID="78";}
			elseif($sequence==3){$bidderID="79";}
			else {$bidderID = "0"; $sequence=0;}

			if($icicirequestID>0 && $TelecallerID==0 && $sequence>0)
			{
				//insert allocation
				
				$inserticiciqry="Update icici_cards_calling set TelecallerID='".$bidderID."', Privacy=1, Updated_Date=Now() Where (RequestID=".$row2["RequestID"].")";
				$inserticiciqryresult = ExecQuery($inserticiciqry);

				$updateqry= "Update lead_allocation_table set last_allocated_to='".$sequence."' , total_lead_count='".$icicirequestID."' Where (Citywise like '%ICICI Calling%' and BidderID=77)";
				$updateqryresult = ExecQuery($updateqry);
			
			}
}
