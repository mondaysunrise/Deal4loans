<?php
require 'scripts/db_init.php';


HDFCBLFB();

function HDFCBLFB()
	{
			$source = 'CallingHDFCBL';
			$lead_allocation_logic = 117;
			$Global_Access_ID = 7008;
			$currentdate=Date('Y-m-d');
			//$currentdate="2017-04-20";
			$min_date = $currentdate." 00:00:00";
			$max_date = $currentdate." 23:59:59";
			
			$startprocess="Select total_lead_count From lead_allocation_table Where (Citywise='".$source."' and lead_allocation_logic='".$lead_allocation_logic."')";
			echo $startprocess."<br><br>";
			$startprocessresult = ExecQuery($startprocess);
			$recordcount = mysql_num_rows($startprocessresult);
			$row=mysql_fetch_array($startprocessresult);
			echo $total_lead_count = $row["total_lead_count"];
			
			$arrbidderqry=ExecQuery("Select BidderID from Bidders Where (Global_Access_ID='".$Global_Access_ID."')");
			while($rowbid=mysql_fetch_array($arrbidderqry))
			{
				$arrBidderID[] = $rowbid["BidderID"];
			}
			echo $trbidder=implode("','",$arrBidderID);
			
			if($total_lead_count>0)
			{
				$citibankplqry="Select RequestID,Updated_Date From Req_Loan_Personal Where (source like '%AFL_SMS_FBSELF_PL%' and (Updated_Date between '".$min_date."' and '".$max_date."') and RequestID >".$total_lead_count." and Allocated=0 and Employment_Status=0) order by RequestID ASC";
			}
			else
			{
				$citibankplqry="Select RequestID,Updated_Date From Req_Loan_Personal Where (source like '%AFL_SMS_FBSELF_PL%' and Updated_Date between '".$min_date."' and '".$max_date."' and Allocated=0 and Employment_Status=0) order by RequestID ASC";
			}
			echo "<br>".$citibankplqry."<br>";
			$citiplqryresult = ExecQuery($citibankplqry);
			$recordcount1 = mysql_num_rows($citiplqryresult);
			$bidderID="";
			
			$counterVal = 1;
			$arrcallerqry=ExecQuery("Select BidderID from Bidders Where (leadidentifier='".$source."' and Status=1) order by BidderID ASC");
			while($rowcal=mysql_fetch_array($arrcallerqry))
			{
				$arrCallerrID[$counterVal] = $rowcal["BidderID"];
				$counterVal = $counterVal + 1;
			}
		print_r($arrCallerrID);

		//die();
		while($row2 = mysql_fetch_array($citiplqryresult))
		{
		$Feedback_ID = 0;
		echo $AllRequestID = $row2["RequestID"];
		$BidderID = $row2["BidderID"];
		$Allocation_Date = $row2["Updated_Date"];

		if($AllRequestID>0)
		{
		$sequenceid=ExecQuery("Select last_allocated_to,total_no_agents From lead_allocation_table Where (Citywise='".$source."' and lead_allocation_logic='".$lead_allocation_logic."')");

		echo "Select last_allocated_to,total_no_agents From lead_allocation_table Where (Citywise='".$source."' and lead_allocation_logic='".$lead_allocation_logic."')";

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

		$getCheckSQl = "select AllRequestID from lead_allocate where (AllRequestID = '".$AllRequestID."' and BidderID in (".$trbidder."))";

		$getCheckQuery = ExecQuery($getCheckSQl);
		$getCheckNum = mysql_num_rows($getCheckQuery);
		if($getCheckNum>0)
			{			//Already Existing Lead

			echo "Already existing";
		}
		else
		{
			$callerID = $arrCallerrID[$sequence];
			if($AllRequestID>0 && $callerID>1)
			{
							//insert allocation
			echo $final_allocationciti="INSERT lead_allocate (AllRequestID, BidderID, Reply_Type, Allocation_Date) VALUE ('".$AllRequestID."','".$callerID."','1', Now())";

			echo "<br><br>";
			//$final_allocationcitiresult = ExecQuery($final_allocationciti);
			$updateqry= "Update lead_allocation_table set last_allocated_to='".$sequence."' , total_lead_count='".$AllRequestID."' Where (Citywise='".$source."' and lead_allocation_logic='".$lead_allocation_logic."')";
			echo "<br>".$updateqry."<br>";
			//$updateqryresult = ExecQuery($updateqry);
							echo "<br><br>";
			}
		}
		$getCheckNum = '';
		}
		}
	} //End HDFC BL Process
?>