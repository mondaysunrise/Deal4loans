<?php
//Shifted to sbi_callingprocess_allocate.php
require 'scripts/db_init.php';
main();
function main()
{
	pl_appointments();
}
function pl_appointments()
{
	$source = 'wf_appt_leads';
	$leadidentifier = 'plalloclms';
	$lead_allocation_logic = 69;

	$currentdate=Date('Y-m-d');
	$min_date = $currentdate." 00:00:00";
	$max_date = $currentdate." 23:59:59";
	
	$counterVal = 1;
	$arrcallerqry=ExecQuery("Select BidderID from Bidders Where (leadidentifier='".$leadidentifier."' and Status=1) order by BidderID ASC");
	while($rowcal=mysql_fetch_array($arrcallerqry))
	{
		$arrCallerrID[$counterVal] = $rowcal["BidderID"];
		$counterVal = $counterVal + 1;
	}
	echo $arrCallerrIDStr=implode("','",$arrCallerrID);
	echo "<br>";
		
	$startprocess="Select total_lead_count From lead_allocation_table Where (Citywise='".$leadidentifier."'  and lead_allocation_logic='".$lead_allocation_logic."')";
	echo $startprocess."<br>";
	$startprocessresult = ExecQuery($startprocess);
	$recordcount = mysql_num_rows($startprocessresult);
	$row=mysql_fetch_array($startprocessresult);
	$total_lead_count = $row["total_lead_count"];
	
	if($total_lead_count>0)
	{
		$sbiccqry="select RequestID,Updated_Date,source from  Req_Loan_Personal Where (source='".$source."' and RequestID>'".$total_lead_count."')";
	}
//	echo $sbiccqry="select RequestID,Updated_Date,source from  Req_Credit_Card_Sms Where (source='SMS_LeadNew')";
		echo $sbiccqry."<br>";
	$select4mcardsresult = ExecQuery($sbiccqry);
	$recordcount1 = mysql_num_rows($select4mcardsresult);
	$bidderID="";
	
	while($row2 = mysql_fetch_array($select4mcardsresult))
	{
		$AllRequestID = $row2["RequestID"];
		$Allocation_Date = $row2["Updated_Date"];
		$Feedback_ID = $row2["RequestID"];
		if($AllRequestID>0)
		{
			$sequenceid=ExecQuery("Select last_allocated_to,total_no_agents From lead_allocation_table Where (Citywise='".$leadidentifier."'  and lead_allocation_logic='".$lead_allocation_logic."')");
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
			$getCheckSQl = "select * from plcallinglms_allocation where AllRequestID = '".$AllRequestID."' and BidderID in ('".$arrCallerrIDStr."')";
		//	 echo "<br>"; echo $getCheckSQl;  echo "<br>";
			$getCheckQuery = ExecQuery($getCheckSQl);
			$getCheckNum = mysql_num_rows($getCheckQuery);
			if($getCheckNum>0)
			{
				//Already Existing Lead
			}
			else
			{
				$callerID = $arrCallerrID[$sequence];
				if($AllRequestID>0 && $callerID>1)
				{
					//insert allocation
					echo "<br><br>";

					echo $inserticiciqry="INSERT INTO plcallinglms_allocation (AllRequestID, BidderID, Allocation_Date, DOE) VALUES ('".$AllRequestID."', '".$callerID."', '".$Allocation_Date."', '".$Allocation_Date."')";
					$inserticiciqryresult = ExecQuery($inserticiciqry);
					echo "<br><br>";
					echo $updateqry= "Update lead_allocation_table set last_allocated_to='".$sequence."' , total_lead_count='".$AllRequestID."' Where (Citywise='".$leadidentifier."' and lead_allocation_logic='".$lead_allocation_logic."')";
					$updateqryresult = ExecQuery($updateqry);
					echo "<br><br>";
				}
			
			}
		}
	}
}

?>