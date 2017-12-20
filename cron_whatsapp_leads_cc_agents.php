<?php
require 'scripts/db_init.php';

$hour =  date("G");
$day =  date("D");
$minute = intval(date("i"));

if($hour==0 && $minute<6)
{
	echo  enableAgents();
}

echo allocateLeadToAgents();

function enableAgents()
{

	$source = 'diallerleadccwhatsappnew';
	$arrcallerqry=d4l_ExecQuery("Select BidderID, agent_lead_count from Bidders Where (leadidentifier='".$source."' and agent_lead_count>0) order by BidderID ASC");
	$disabledBidderID = '';
	while($rowcal=d4l_mysql_fetch_array($arrcallerqry))
	{
		$disabledBidderID[]=$rowcal['BidderID'];	
	}
	$disabledBidderIDStr= implode(',', $disabledBidderID);
	$updateBidderStatus = "update Bidders set Status=1 where BidderID in (".$disabledBidderIDStr.")";			
	$printValue .= "<br>".$updateBidderStatus ."<br>";
	$updateBidderStatusResult = d4l_ExecQuery($updateBidderStatus);
	
	/*$arrcallerEnable=d4l_ExecQuery("Select BidderID from Bidders Where (leadidentifier='".$source."' and Status=1) GROUP BY Calling_Access_ID order by BidderID ASC");
	$countEnable = d4l_mysql_num_rows($arrcallerEnable);
	$updateLeadAllocationTable = "update lead_allocation_table SET total_no_agents='".$countEnable."' Where (leadidentifier='".$source."' and lead_allocation_logic='".$lead_allocation_logic."')";//left here 171017
	$printValue .= "<br>".$updateLeadAllocationTable ."<br>";
	$updateLeadAllocationTableResult = d4l_ExecQuery($updateLeadAllocationTable);
	*/
	echo $printValue;
}

function allocateLeadToAgents()
{
	$currentdate=Date('Y-m-d');
	$min_date = $currentdate." 00:00:00";
	$max_date = $currentdate." 23:59:59";
	$source = 'diallerleadccwhatsappnew';
	$lead_allocation_logic = 182;
	
	$arrcallerqry=d4l_ExecQuery("Select BidderID, agent_lead_count from Bidders Where (leadidentifier='".$source."' and agent_lead_count>0) order by BidderID ASC");
	$rowcal=d4l_mysql_fetch_array($arrcallerqry);
	$BidderIDExcludeArr='';	
	while($rowcal=d4l_mysql_fetch_array($arrcallerqry))
	{
		$BidderIDExcludeArr[]=$rowcal['BidderID'];	
	}
	$BidderIDExcludeStr = implode(',', $BidderIDExcludeArr);

	
	$arrcallerqry=d4l_ExecQuery("Select BidderID, agent_lead_count from Bidders Where (leadidentifier='".$source."' and agent_lead_count>0 AND Status=1) order by BidderID ASC LIMIT 0,1");
	$rowcal=d4l_mysql_fetch_array($arrcallerqry);
	$eligibleBidderID=$rowcal['BidderID'];
	$agent_lead_count=$rowcal['agent_lead_count'];	
	

	$startprocess="Select total_lead_count From lead_allocation_table Where (Citywise='".$source."' and lead_allocation_logic='".$lead_allocation_logic."')";
    echo $startprocess."<br><br>";
    $startprocessresult = ExecQuery($startprocess);
    $recordcount = mysql_num_rows($startprocessresult);
    $row=mysql_fetch_array($startprocessresult);
    echo $total_lead_count = $row["total_lead_count"];

	
	if($total_lead_count>=0)
	{
		$sbiccqry="select RequestID,Updated_Date,source from  Req_Credit_Card Where (source='Wishfin_Whatsapp_Leads' and RequestID>'".$total_lead_count."' AND ( Dated between'".$min_date."' and '".$max_date."'))";
	}
	echo $sbiccqry."<br>";
	$select4mcardsresult = ExecQuery($sbiccqry);
	$recordcount1 = mysql_num_rows($select4mcardsresult);
	$bidderID="";
	//die();
	if($recordcount1>0)
	{
		while($row2 = mysql_fetch_array($select4mcardsresult))
		{
			$AllRequestID = $row2["RequestID"];
			$Allocation_Date = $row2["Updated_Date"];
			$Feedback_ID = $row2["RequestID"];
			if($AllRequestID>0)
			{
				$getCheckSQl = "select * from lead_allocate where AllRequestID = '".$AllRequestID."' and BidderID in (".$BidderIDExcludeStr.")  ";
				//echo $getCheckSQl."<br>";
				$getCheckQuery = ExecQuery($getCheckSQl);
				$getCheckNum = mysql_num_rows($getCheckQuery);
				if($getCheckNum>0)
				{
					//Already Existing Lead
				}
				else
				{		
					$getCheckSQl = "select BidderID from lead_allocate where BidderID ='".$eligibleBidderID."' AND Allocation_Date between'".$min_date."' and '".$max_date."'";
					//echo $getCheckSQl."<br>";				
					$getCheckQuery = d4l_ExecQuery($getCheckSQl);
					$getCheckNum = d4l_mysql_num_rows($getCheckQuery);
					if($getCheckNum>=$agent_lead_count)
					{
						$updateBidderStatus = "update Bidders set Status=0 where BidderID in (".$eligibleBidderID.")";			
						$printValue .= "<br>".$updateBidderStatus ."<br>";
						$updateBidderStatusResult = d4l_ExecQuery($updateBidderStatus);
						die();
					}
					else
					{
						$bidderID = $eligibleBidderID;
						echo $bidderID.", ".$AllRequestID;
						if($AllRequestID>0 && $bidderID>1)
						{
							//insert allocation
							//echo "<br><br>";
							 $inserticiciqry="INSERT INTO `lead_allocate` (`AllRequestID`, `BidderID`, `Reply_Type`, `Allocated`, `Allocation_Date`) VALUES ('".$AllRequestID."', '".$bidderID."', '4', '0', '".$Allocation_Date."');";
							$inserticiciqryresult = d4l_ExecQuery($inserticiciqry);
			//echo  $inserticiciqry."<br><br>";
							$updateqry= "Update lead_allocation_table set last_allocated_to='1' , total_lead_count='".$AllRequestID."' Where (Citywise='".$source."' and lead_allocation_logic='".$lead_allocation_logic."')";
							$updateqryresult = d4l_ExecQuery($updateqry);
					//		echo $updateqry."<br><br>";
						}
					}
				}
			}
		}
	}
}
?>