<?php
//Shifted to sbi_callingprocess_allocate.php
require 'scripts/db_init.php';
main();

function main()
{
	citypl();
}
function citypl()
{
	$currentdate=Date('Y-m-d');
	$min_date = $currentdate." 00:00:00";
	$max_date = $currentdate." 23:59:59";
	
	$startprocess="Select total_lead_count From lead_allocation_table Where (Citywise='CallerAccountCity' and lead_allocation_logic=50)";
	echo $startprocess."<br><br>";
	$startprocessresult = ExecQuery($startprocess);
	$recordcount = mysql_num_rows($startprocessresult);
	$row=mysql_fetch_array($startprocessresult);
	echo $total_lead_count = $row["total_lead_count"];
	echo "<br>";
	$arrbidderqry=ExecQuery("Select BidderID, City from Bidders Where (Global_Access_ID=6376)");
	$rowbid=mysql_fetch_array($arrbidderqry);
	$mainBidderID = $rowbid["BidderID"];
	$mainCity = $rowbid["City"];
	$CityArr = explode(",",$mainCity);
	$CityStr = implode("','",$CityArr);
	
	$qryExcludeSourceCallingSql = "SELECT * FROM exclude_source_calling where 1=1 and reply_type=1 and status=1";
	$qryExcludeSourceCallingQuery =ExecQuery($qryExcludeSourceCallingSql);;
	$qryExcludeSourceCallingNum = mysql_num_rows($qryExcludeSourceCallingQuery);
	$excludeSourceC = '';
	$excludeSourceC .= "( Req_Loan_Personal.ex_source!='below60k' ";
	for($j=0;$j<$qryExcludeSourceCallingNum;$j++)
	{	
		$source_eSC =  mysql_result($qryExcludeSourceCallingQuery,$j,'source');
		$excludeSourceC .= " and Req_Loan_Personal.source!='".$source_eSC."' ";
	}
	$excludeSourceC .= $excludeSource."  )";
	
	if($total_lead_count>0)
	{
		$cityQry="select RequestID, Updated_Date as Allocation_Date from Req_Loan_Personal where (".$excludeSourceC."  and Req_Loan_Personal.Allocated=0 and RequestID>'".$total_lead_count."'  and Req_Loan_Personal.City in ('".$CityStr."'))  order by RequestID asc";
	}
	
//	$cityQry="select RequestID, Updated_Date as Allocation_Date from Req_Loan_Personal where (".$excludeSourceC."  and Req_Loan_Personal.Allocated=0 and RequestID>'".$total_lead_count."'  and Req_Loan_Personal.City in ('".$CityStr."')) order by RequestID asc";
//$cityQry="select RequestID, Updated_Date as Allocation_Date from Req_Loan_Personal where REquestID in (2243588)";
	echo $cityQry."<br>";
//	exit();
	$cityResult = ExecQuery($cityQry);
	echo $recordcount1 = mysql_num_rows($cityResult);
	$bidderID="";
	
	$counterVal = 1;
	$arrcallerqry=ExecQuery("Select BidderID from Bidders Where (Global_Access_ID=6376) order by BidderID ASC");
	while($rowcal=mysql_fetch_array($arrcallerqry))
	{
		$arrCallerrID[$counterVal] = $rowcal["BidderID"];
		$counterVal = $counterVal + 1;
	}
	
	while($row2 = mysql_fetch_array($cityResult))
	{
		$AllRequestID = $row2["RequestID"];
		$Allocation_Date = $row2["Allocation_Date"];
		$Feedback_ID = $row2["RequestID"];
		
		if($AllRequestID>0)
		{
			$sequenceid=ExecQuery("Select last_allocated_to,total_no_agents From lead_allocation_table Where (Citywise='CallerAccountCity' and lead_allocation_logic=50)");
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
				
			$getCheckSQl = "select Feedback_ID from lead_allocate where (Feedback_ID = '".$Feedback_ID."' and BidderID=".$BidderID.")";
			
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
						 $final_allocation="INSERT INTO `lead_allocate` (`AllRequestID`, `BidderID`, `Reply_Type`, `Allocated`, `Allocation_Date`) VALUES ('".$AllRequestID."', '".$callerID."', '1', '0', '".$Allocation_Date."');";;
						$final_allocationresult = ExecQuery($final_allocation);
						$updateProductSql = "update Req_Loan_Personal set Referrer='CallerAccountCity' where RequestID='".$AllRequestID."'";
						$updateProductQry = ExecQuery($updateProductSql);
					echo $final_allocation."<br><br>";
					echo $updateProductSql."<br><br>";
					$updateqry= "Update lead_allocation_table set last_allocated_to='".$sequence."' , total_lead_count='".$Feedback_ID."' Where (Citywise='CallerAccountCity' and lead_allocation_logic=50)";
						$updateqryresult = ExecQuery($updateqry);
						echo $updateqry."<br><br>";
					}
				}
				$getCheckNum = '';
		}
	}
}



?>