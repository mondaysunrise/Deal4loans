<?php
ini_set('max_execution_time', 600);
require 'scripts/db_init.php';

sbiVerifierLeadAllocation();

	function sbiVerifierLeadAllocation()
	{
			$lead_allocation_logic = 151;
			$leadidentifier='sbiverifierlms';
			$currentdate=Date('Y-m-d');
			$min_date = $currentdate." 00:00:00";
			$max_date = $currentdate." 23:59:59";
			
			$startprocess="Select total_lead_count From lead_allocation_table Where (Citywise='".$leadidentifier."' and lead_allocation_logic='".$lead_allocation_logic."')";
			echo $startprocess."<br><br>";
			$startprocessresult = ExecQuery($startprocess);
			$recordcount = mysql_num_rows($startprocessresult);
			$row=mysql_fetch_array($startprocessresult);
			echo $total_lead_count = $row["total_lead_count"];
			
			$counterVal = 1;
			$arrcallerqry=ExecQuery("Select BidderID from Bidders Where (leadidentifier='".$leadidentifier."' and Status=1) order by BidderID ASC");
			while($rowcal=mysql_fetch_array($arrcallerqry))
			{
				$arrCallerrID[$counterVal] = $rowcal["BidderID"];
				$counterVal = $counterVal + 1;
			}
			$strbidder = implode(',',$arrCallerrID);
			print_r($arrCallerrID);
		
			$citibankplqry= "Select sbiccid, `RequestID`, `productflag` From sbi_credit_card_5633 where (`ApplicationNumber`>0 and (`ProcessingStatus`=1) and first_dated BETWEEN '".$min_date."' AND '".$max_date."') and sbiccid>'".$total_lead_count."'  group by RequestID order by sbiccid DESC";
//			$citibankplqry= "Select sbiccid, `RequestID`, `productflag` From sbi_credit_card_5633 where (`request2_xml`='' and `ApplicationNumber`>0 and (`ProcessingStatus`=1) and first_dated BETWEEN '".$min_date."' AND '".$max_date."') and sbiccid>'".$total_lead_count."'  group by RequestID order by sbiccid DESC";//Because no need to push to web service 2.

			echo $citibankplqry."<br>";
			$citiplqryresult = ExecQuery($citibankplqry);
			$recordcount1 = mysql_num_rows($citiplqryresult);
			$bidderID="";
			echo "<br>".$recordcount1;
		//	die();
			$reply_type = '';
			while($row2 = mysql_fetch_array($citiplqryresult))
			{
				$reply_type = '';		
				$sbiccid = $row2["sbiccid"];	
				echo $AllRequestID = $row2["RequestID"];
				$productflag = $row2["productflag"];
				if($productflag==10) {$reply_type = 10; } else { $reply_type = 4; }	
				if($AllRequestID>0)
				{
					$sequenceid=ExecQuery("Select last_allocated_to,total_no_agents From lead_allocation_table Where (Citywise='".$leadidentifier."' and lead_allocation_logic='".$lead_allocation_logic."')");
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
			
					$getCheckSQl = "select AllRequestID from lead_allocate where (AllRequestID = '".$AllRequestID."' and BidderID in (".$strbidder."))";
			
					$getCheckQuery = ExecQuery($getCheckSQl);
					$getCheckNum = mysql_num_rows($getCheckQuery);
					if($getCheckNum>0)
					{			//Already Existing Lead
					}
					else
					{
						$callerID = $arrCallerrID[$sequence];
						if($AllRequestID>0 && $callerID>1)
						{
							//insert allocation
							$final_allocationciti="INSERT lead_allocate (AllRequestID, BidderID, Reply_Type, Allocation_Date) VALUE ('".$AllRequestID."','".$callerID."','".$reply_type."', Now())";
							$final_allocationcitiresult = ExecQuery($final_allocationciti);
							$updateqry= "Update lead_allocation_table set last_allocated_to='".$sequence."' , total_lead_count='".$sbiccid."' Where (Citywise='".$leadidentifier."' and lead_allocation_logic='".$lead_allocation_logic."')";
							echo "<br>".$final_allocationciti."<br>";
							$updateqryresult = ExecQuery($updateqry);
							echo "<br><br>";
						}
					}
				}
			}
	} 


?>