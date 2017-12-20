<?php
require 'scripts/db_init.php';
main();
function main()
{
	$day = date("D");
	$time = date("G");
	allocateblleadstoagents();
}

function allocateblleadstoagents()
{
	$sourceDefined = 'blmainlms';
	$globalBidderID = 6284;
	$Dated = ExactServerdate();
	define('TABLE_REQ_LOAN_PERSONAL','Req_Loan_Personal');
	$currentdate = date('Y-m-d');
	//$currentdate="2016-06-01";
	$min_date = $currentdate." 00:00:00";
	$max_date = $currentdate." 23:59:59";
	//$max_date = "2016-06-01 23:59:59";
	
	$startprocess="Select total_lead_count From lead_allocation_table Where (Citywise='".$sourceDefined."' and BidderID='".$globalBidderID."')";
	echo $startprocess."<br>";
	$startprocessresult = ExecQuery($startprocess);
	$recordcount = mysql_num_rows($startprocessresult);
	$row=mysql_fetch_array($startprocessresult);
	$total_lead_count = $row["total_lead_count"];
	
	if($total_lead_count>0)
	{
			
		$getActiveBiddersSql = "select BidderID from Bidders where leadidentifier='".$sourceDefined."' and Status=1";
		$getActiveBiddersQry = ExecQuery($getActiveBiddersSql);
		$recordCountActiveBidders = mysql_num_rows($getActiveBiddersQry);
		$BidderIDArr = '';
		$counterVal = 1;
		for($i=0;$i<$recordCountActiveBidders;$i++)
		{
			$BidderID = mysql_result($getActiveBiddersQry,$i,'BidderID');
			$BidderIDArr[$counterVal] = $BidderID;
			$counterVal = $counterVal + 1;
		}
		$BidderIDStr = implode(',', $BidderIDArr);
		
		$plSql="SELECT  RequestID,Updated_Date from Req_Loan_Personal WHERE ((Req_Loan_Personal.Updated_Date Between '".$min_date."' and '".$max_date."' ) and Req_Loan_Personal.Allocated=0  AND Req_Loan_Personal.Employment_Status =0 and (Req_Loan_Personal.City in ('Ahmedabad', 'Ajmer', 'Alwar', 'Aurangabad', 'Bangalore', 'Baroda', 'Bhopal', 'Chandigarh', 'Chennai', 'Cochin', 'Coimbatore', 'Dehradun', 'Delhi', 'Goa', 'Guntur', 'Hosur', 'Hyderabad', 'Indore', 'Jaipur', 'Jalandhar', 'Kanpur', 'Kolkata', 'Kota', 'Kottayam', 'Ludhiana', 'Mumbai', 'Nagpur', 'Nasik', 'Patiala', 'Pune', 'Rajkot', 'Salem', 'Surat', 'Tirupur', 'Trichur', 'Trichy', 'Trivandrum ', 'Udaipur', 'Vijayawada', 'Visakapatnam', 'Vizag', 'Vishakhapatnam','Gurgaon','Faridabad','Noida') or Req_Loan_Personal.City_Other in ('Ahmedabad', 'Ajmer', 'Alwar', 'Aurangabad', 'Bangalore', 'Baroda', 'Bhopal', 'Chandigarh', 'Chennai', 'Cochin', 'Coimbatore', 'Dehradun', 'Delhi', 'Goa', 'Guntur', 'Hosur', 'Hyderabad', 'Indore', 'Jaipur', 'Jalandhar', 'Kanpur', 'Kolkata', 'Kota', 'Kottayam', 'Ludhiana', 'Mumbai', 'Nagpur', 'Nasik', 'Patiala', 'Pune', 'Rajkot', 'Salem', 'Surat', 'Tirupur', 'Trichur', 'Trichy', 'Trivandrum', 'Udaipur', 'Vijayawada', 'Visakapatnam', 'Vizag', 'Vishakhapatnam','Gurgaon','Faridabad','Noida'))) and Req_Loan_Personal.RequestID>'".$total_lead_count."'";
		
		echo $plSql;
		echo "<br>";
	
		$plQry = ExecQuery($plSql);
		$recordCount = mysql_num_rows($plQry);
		$bidderID = "";
		echo $recordCount."<br>";
	//	exit();
		for($i=0;$i<$recordCount;$i++)	
		{
			$AllRequestID = mysql_result($plQry,$i,'RequestID');
			$Allocation_Date = mysql_result($plQry,$i,'Updated_Date');
			$DOE = mysql_result($plQry,$i,'Updated_Date');
			$Net_Salary = mysql_result($plQry,$i,'Net_Salary');
			if($AllRequestID>0)
			{
				$sequenceid=ExecQuery("Select last_allocated_to,total_no_agents From lead_allocation_table Where (Citywise='".$sourceDefined."' and BidderID='".$globalBidderID."')");
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
				$getCheckSQl = "select * from plcallinglms_allocation where AllRequestID = '".$AllRequestID."' and BidderID in (".$BidderIDStr.")  ";
				$getCheckQuery = ExecQuery($getCheckSQl);
				$getCheckNum = mysql_num_rows($getCheckQuery);
				if($getCheckNum>0)
				{
					//Already Existing Lead
				}
				else
				{				
					$bidderID = $BidderIDArr[$sequence];
					if($AllRequestID>0 && $bidderID>1)
					{
						//insert allocation
						echo "<br>*******************************************<br>";
						echo $inserticiciqry="INSERT INTO plcallinglms_allocation (AllRequestID, BidderID, Allocation_Date, DOE) VALUES ('".$AllRequestID."', '".$bidderID."', '".$Dated."', '".$DOE."')";
						$inserticiciqryresult = ExecQuery($inserticiciqry);
						echo "<br>";
						echo $updateqry= "Update lead_allocation_table set last_allocated_to='".$sequence."' , total_lead_count='".$AllRequestID."' Where (Citywise='".$sourceDefined."' and BidderID='".$globalBidderID."')";
						$updateqryresult = ExecQuery($updateqry);
						echo "<br>";
					}				
				}
				$getCheckNum = '';
			}
		}
	}


}



?>