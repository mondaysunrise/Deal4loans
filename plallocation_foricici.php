<?php
	require 'scripts/db_init.php';
	require 'scripts/functions_nw.php';

$startprocess="Select * From lead_allocation_table Where (Citywise like '%ICICI PL LMS%' and BidderID=4387)";
echo $startprocess."<br><br>";
$startprocessresult = ExecQuery($startprocess);
$recordcount = mysql_num_rows($startprocessresult);
$row=mysql_fetch_array($startprocessresult);

$total_lead_count = $row["total_lead_count"];

if($total_lead_count>0)
{
	$select4mcards="Select * from ICICI_Allocated_Leads Where (TelecallerID=0 and eligible=1 and icicirequestID>'".$total_lead_count."')";
}
else
{
	$select4mcards="Select * from ICICI_Allocated_Leads Where (TelecallerID=0 and eligible=1)";
}

echo $select4mcards."<br>";
$select4mcardsresult = ExecQuery($select4mcards);
$recordcount1 = mysql_num_rows($select4mcardsresult);
$bidderID="";

while($row2 = mysql_fetch_array($select4mcardsresult))
{
	$icicirequestID = $row2["icicirequestID"];
	$TelecallerID = $row2["TelecallerID"];

	$sequenceid=ExecQuery("Select last_allocated_to,total_no_agents from lead_allocation_table Where (Citywise like '%ICICI PL LMS%' and BidderID=4387)");
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

			if($sequence==1){$bidderID="84";}
			elseif($sequence==2){$bidderID="85";}
			//elseif($sequence==3){$bidderID="86";}
			elseif($sequence==3){$bidderID="87";}
			//elseif($sequence==4){$bidderID="88";}
			elseif($sequence==4){$bidderID="89";}
			elseif($sequence==5){$bidderID="90";}
			elseif($sequence==6){$bidderID="91";}
			/*elseif($sequence==9){$bidderID="92";}
			elseif($sequence==10){$bidderID="93";}*/
			else {$bidderID = "0"; $sequence=0;}


			if($icicirequestID>0 && $TelecallerID==0 && $sequence>0)
			{
				//insert allocation
				echo "<br><br>";
				echo $inserticiciqry="Update ICICI_Allocated_Leads set TelecallerID='".$bidderID."', Updated_Date=Now() Where (RequestID=".$row2["RequestID"].")";
				$inserticiciqryresult = ExecQuery($inserticiciqry);
echo "<br><br>";
				echo $updateqry= "Update lead_allocation_table set last_allocated_to='".$sequence."' , total_lead_count='".$icicirequestID."' Where (Citywise like '%ICICI PL LMS%' and BidderID=4387)";
				$updateqryresult = ExecQuery($updateqry);
				echo "<br><br>";
			}
}
