<?php
require 'scripts/db_init.php';
main();
function main()
{
	$time = date("G");
	if($time >=18 && $time<21 )
	{
		allocateplleadstoagentsevening();
	}
}

function allocateplleadstoagentsevening()
{
	$sourceDefined = 'plmainlms79';
	$globalBidderID = 6271;
	$Dated = ExactServerdate();
	define('TABLE_REQ_LOAN_PERSONAL','Req_Loan_Personal');
	$currentdate = date('Y-m-d');
	//$currentdate="2016-06-07";
	$min_date = $currentdate." 18:00:00";
	$max_date = $currentdate." 20:59:59";
	//$max_date = "2016-06-01 23:59:59";
	
	$startprocess="Select total_lead_count From lead_allocation_table Where (Citywise='".$sourceDefined."' and BidderID='".$globalBidderID."')";
	echo $startprocess."<br>";
	$startprocessresult = ExecQuery($startprocess);
	$recordcount = mysql_num_rows($startprocessresult);
	$row=mysql_fetch_array($startprocessresult);
	$total_lead_count = $row["total_lead_count"];
	
	if($total_lead_count>0)
	{
		$qryExcludeSourceSql = "SELECT * FROM manual_user_details where 1=1";
		$qryExcludeSourceQuery = ExecQuery($qryExcludeSourceSql);
		$numqryExcludeSourceQuery = mysql_num_rows($qryExcludeSourceQuery);
		$excludeSource = '';
		for($i=0;$i<$numqryExcludeSourceQuery;$i++)
		{
			$source_eS = mysql_result($qryExcludeSourceQuery,$i,'source');
			$excludeSource .= " and ".TABLE_REQ_LOAN_PERSONAL.".source!='".$source_eS."' ";
		}
		
		$qryExcludeSourceCallingSql = "SELECT * FROM exclude_source_calling where 1=1 and reply_type=1 and status=1";
		$qryExcludeSourceCallingQuery =ExecQuery($qryExcludeSourceCallingSql);;
		$qryExcludeSourceCallingNum = mysql_num_rows($qryExcludeSourceCallingQuery);
		$excludeSourceC = '';
		$excludeSourceC .= "( ".TABLE_REQ_LOAN_PERSONAL.".ex_source!='below60k' ";
		for($j=0;$j<$qryExcludeSourceCallingNum;$j++)
		{	
			$source_eSC =  mysql_result($qryExcludeSourceCallingQuery,$j,'source');
			$excludeSourceC .= " and ".TABLE_REQ_LOAN_PERSONAL.".source!='".$source_eSC."' ";
		}
		$excludeSourceC .= $excludeSource."  )";	
	
		$getExcludeBiddersSql = "select BidderID from Bidders where leadidentifier in ('plmainlms')";
		$getExcludeBiddersQry = ExecQuery($getExcludeBiddersSql);
		$recordCountExcludeBidders = mysql_num_rows($getExcludeBiddersQry);
		$BidderIDExcludeArr = '';
		$counterExcludeVal = 1;
		for($i=0;$i<$recordCountExcludeBidders;$i++)
		{
			$BidderIDExclude = mysql_result($getExcludeBiddersQry,$i,'BidderID');
			$BidderIDExcludeArr[$counterExcludeVal] = $BidderIDExclude;
			$counterExcludeVal = $counterExcludeVal + 1;
		}
		$BidderIDExcludeStr = implode(',', $BidderIDExcludeArr);
	
		$getActiveBiddersSql = "select BidderID from Bidders where leadidentifier='".$sourceDefined."' and Status=1";
		$getActiveBiddersQry = ExecQuery($getActiveBiddersSql);
		$recordCountActiveBidders = mysql_num_rows($getActiveBiddersQry);
		$BidderIDArr = '';
		$CheckBidderID = '';
		$counterVal = 1;
		for($i=0;$i<$recordCountActiveBidders;$i++)
		{
			$BidderID = mysql_result($getActiveBiddersQry,$i,'BidderID');
			$BidderIDArr[$counterVal] = $BidderID;
			$CheckBidderID[$counterVal] = $BidderID;
			$counterVal = $counterVal + 1;
		}
		
		/* Experts Agents */
		$getExpertsActiveBiddersSql = "select BidderID from Bidders where leadidentifier='plalloclms'";
		$getExpertsActiveBiddersQry = ExecQuery($getExpertsActiveBiddersSql);
		$recordExpertsCountActiveBidders = mysql_num_rows($getExpertsActiveBiddersQry);
		
		for($i=0;$i<$recordExpertsCountActiveBidders;$i++)
		{
			$BidderID = mysql_result($getExpertsActiveBiddersQry,$i,'BidderID');
			$CheckBidderID[$counterVal] = $BidderID;
			$counterVal= $counterVal+ 1;
		}
		/* Experts Agents */

		
		
		$BidderIDStr = implode(',', $CheckBidderID);
	
		$hour =  date("G");
		$minute = intval(date("i"));
		
		if($hour==18 && $minute<10)
		{
			$mindate =  $currentdate." 00:00:00";
			$maxdate = $currentdate." 18:59:59";
			//$plSql="select RequestID, Updated_Date, Net_Salary, Feedback, Followup_Date from Req_Loan_Personal LEFT OUTER JOIN Req_Feedback_PL ON Req_Feedback_PL.AllRequestID= Req_Loan_Personal.RequestID and Req_Feedback_PL.BidderID in (".$BidderIDExcludeStr.") Where ((".$excludeSourceC." and Req_Loan_Personal.Employment_Status=1 and Req_Loan_Personal.City!='Coimbatore' and Req_Loan_Personal.Allocated=0 and Req_Loan_Personal.Direct_Allocation=0 and RequestID>'".$total_lead_count."' and Updated_Date  between '".$mindate."' and '".$maxdate."') and (Req_Feedback_PL.Feedback in ('FollowUp','No Feedback', 'Ringing', 'Callback Later', '') or Req_Feedback_PL.Feedback IS NULL)) order by RequestID asc";
			$plSql="select RequestID, Updated_Date, Net_Salary, Feedback, Followup_Date from Req_Loan_Personal LEFT OUTER JOIN Req_Feedback_PL ON Req_Feedback_PL.AllRequestID= Req_Loan_Personal.RequestID and Req_Feedback_PL.BidderID in (".$BidderIDExcludeStr.") Where ((".$excludeSourceC." and Req_Loan_Personal.Employment_Status=1 and Req_Loan_Personal.Allocated=0 and Req_Loan_Personal.Direct_Allocation=0 and RequestID>'".$total_lead_count."' and Updated_Date  between '".$mindate."' and '".$maxdate."') and (Req_Feedback_PL.Feedback in ('FollowUp','No Feedback', 'Ringing', 'Callback Later', '') or Req_Feedback_PL.Feedback IS NULL)) order by RequestID asc";
		}
		else
		{
			//$plSql="select RequestID, Updated_Date, Net_Salary from Req_Loan_Personal where (".$excludeSourceC." and Req_Loan_Personal.Employment_Status=1 and Req_Loan_Personal.City!='Coimbatore' and Req_Loan_Personal.Allocated=0 and Req_Loan_Personal.Direct_Allocation=0 and RequestID>'".$total_lead_count."' and Updated_Date between '".$min_date."' and '".$max_date."') order by RequestID asc";

			$plSql="select RequestID, Updated_Date, Net_Salary from Req_Loan_Personal where (".$excludeSourceC." and Req_Loan_Personal.Employment_Status=1 and Req_Loan_Personal.Allocated=0 and Req_Loan_Personal.Direct_Allocation=0 and RequestID>'".$total_lead_count."' and Updated_Date between '".$min_date."' and '".$max_date."') order by RequestID asc";
		}
		
	
		echo $plSql;
		echo "<br>";
	//die();
		$plQry = ExecQuery($plSql);
		$recordCount = mysql_num_rows($plQry);
		$bidderID = "";
		echo $recordCount."<br>";
	//exit();
		for($i=0;$i<$recordCount;$i++)	
		{
			$AllRequestID = mysql_result($plQry,$i,'RequestID');
			$Allocation_Date = mysql_result($plQry,$i,'Updated_Date');
			$DOE = mysql_result($plQry,$i,'Updated_Date');
			$Net_Salary = mysql_result($plQry,$i,'Net_Salary');
			if($AllRequestID>0)
			{
				if($Net_Salary>60000)
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
					$getCheckSQl = "select * from plcallinglms_allocation where AllRequestID = '".$AllRequestID."' and BidderID in (".$BidderIDStr.") ";
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
}
?>