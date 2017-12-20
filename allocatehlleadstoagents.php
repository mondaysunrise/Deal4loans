<?php
require 'scripts/db_init.php';
main();
function main()
{
	allocatehlleadstoagents();
	SblCallerAllocate();
	allocateHDFChlleadstoagents("7329");//Hyderabad + Vijayawada+ Vizag, Bangalore
	allocateHDFChlleadstoagents("7330");//Pune + Mumbai+ Ahmedabad + Kolkata 
	allocateHDFChlleadstoagents("7165");//delhi + NCR
}

function allocatehlleadstoagents()
{
	$Dated = ExactServerdate();
	define('TABLE_Req_Loan_Home','Req_Loan_Home');
	$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-1, date("Y"));
	$currentdate = date('Y-m-d', $tomorrow);
	//$currentdate="2016-06-01";
	$min_date = $currentdate." 00:00:00";
	$max_date = date('Y-m-d')." 23:59:59";
	//$max_date = "2016-06-01 23:59:59";
	
	$startprocess="Select total_lead_count From lead_allocation_table Where (Citywise='hlallocatelms' and BidderID=6517)";
	echo $startprocess."<br>";
	$startprocessresult = ExecQuery($startprocess);
	$recordcount = mysql_num_rows($startprocessresult);
	$row=mysql_fetch_array($startprocessresult);
	$total_lead_count = $row["total_lead_count"];
	
	if($total_lead_count>0)
	{	$getActiveBiddersSql = "select BidderID,Selection_Category from Bidders where (leadidentifier='hlallocatelms' and Selection_Category=0 and Status=1) ORDER BY BidderID ASC";
		$getActiveBiddersQry = ExecQuery($getActiveBiddersSql);
		$recordCountActiveBidders = mysql_num_rows($getActiveBiddersQry);
		$BidderIDArr = '';
		$counterVal = 1;
		for($i=0;$i<$recordCountActiveBidders;$i++)
		{	$Selection_Category = mysql_result($getActiveBiddersQry,$i,'Selection_Category');
			$BidderID = mysql_result($getActiveBiddersQry,$i,'BidderID');
			if($Selection_Category==0)
			{
			$BidderIDArr[$counterVal] = $BidderID;
			$counterVal = $counterVal + 1;
			}
			$BidderIDallArr[] = $BidderID;
		}
		$BidderIDStr = implode(',', $BidderIDArr);
		$BidderIDallstr = implode(',', $BidderIDallArr);
		
		$feedback_tble="Req_Feedback_Bidder_HL";
		$hlsql="SELECT RequestID,Allocation_Date,Feedback_ID FROM ".$feedback_tble.",".TABLE_Req_Loan_Home." WHERE (".$feedback_tble.".AllRequestID=".TABLE_Req_Loan_Home.".RequestID and ".$feedback_tble.".Reply_Type=2 and ".TABLE_Req_Loan_Home.".City in ('Delhi','Noida','Gurgaon','Gaziabad','Faridabad','Sahibabad') and Req_Feedback_Bidder_HL.Feedback_ID>'".$total_lead_count."' and (".$feedback_tble.".Allocation_Date Between '".($min_date)."' and '".($max_date)."') )";
		//$hlsql=$hlsql.$FeedbackClause." ".$mob_num_clause." ".$refernce_no_clause;
		$hlsql=$hlsql."group by ".$feedback_tble.".AllRequestID order by Feedback_ID ASC";
		echo $hlsql;
		echo "<br>";
	
		$hlQry = ExecQuery($hlsql);
		$recordCount = mysql_num_rows($hlQry);
		$bidderID = "";
		echo $recordCount."<br>";
	
		for($i=0;$i<$recordCount;$i++)	
		{
			$AllRequestID = mysql_result($hlQry,$i,'RequestID');
			$Allocation_Date = mysql_result($hlQry,$i,'Allocation_Date');
			$Feedback_ID = mysql_result($hlQry,$i,'Feedback_ID');
			//$DOE = mysql_result($plQry,$i,'Updated_Date');
			//$Net_Salary = mysql_result($plQry,$i,'Net_Salary');
			$checkforrajatbid=ExecQuery("Select Feedback_ID From ".$feedback_tble." Where (AllRequestID='".$AllRequestID."' and BidderID in ('6774','6812'))");
					$rajid = mysql_fetch_array($checkforrajatbid);
			if($rajid["Feedback_ID"]>0)
			{
			}
			else
			{
			if($AllRequestID>0)
			{
				echo $sequenceid=ExecQuery("Select last_allocated_to,total_no_agents From lead_allocation_table Where (Citywise='hlallocatelms' and BidderID=6517)");
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
					echo $getCheckSQl = "select * from hlcallinglms_allocation where AllRequestID = '".$AllRequestID."' and BidderID in (".$BidderIDallstr.")  ";
					$getCheckQuery = ExecQuery($getCheckSQl);
					$getCheckNum = mysql_num_rows($getCheckQuery);
					if($getCheckNum>0)
					{					}
					else
					{
						$bidderID = $BidderIDArr[$sequence];
						if($AllRequestID>0 && $bidderID>1)
						{
							//insert allocation
							echo "<br>*******************************************<br>";
							echo $inserticiciqry="INSERT INTO hlcallinglms_allocation (AllRequestID, BidderID, Allocation_Date, DOE) VALUES ('".$AllRequestID."', '".$bidderID."', '".$Allocation_Date."', Now())";
							$inserticiciqryresult = ExecQuery($inserticiciqry);
							echo "<br>";
							echo $updateqry= "Update lead_allocation_table set last_allocated_to='".$sequence."' , total_lead_count='".$Feedback_ID."' Where (Citywise='hlallocatelms' and BidderID=6517)";
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

/**********************************************************************/
//SBI Caller Allocation
/**********************************************************************/
function SblCallerAllocate()
{
	$source = 'SBIHLCaller';
	$lead_allocation_logic = 157;
	$Global_Access_ID = 6319;
	$currentdate=Date('Y-m-d');
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
	//6307,6308,6309,6310,6311,6312,6313,6314,6315,6316,6317,6318,6560,6561,6562,7247,7248,7249,7251,7252,7253,7254,7255
	if($total_lead_count>0)
	{
		$citibankplqry="SELECT leadid, AllRequestID, BidderID, Allocation_Date FROM `client_lead_allocate` WHERE (`BidderID` in ('".$trbidder."') and leadid>'".$total_lead_count."' and (caller_name='' or caller_name IS NULL) and Allocation_Date between '".$min_date."' and '".$max_date."') order by leadid ASC LIMIT 0,4";
	}
	else
	{
		$citibankplqry="SELECT leadid, AllRequestID, BidderID, Allocation_Date FROM `client_lead_allocate` WHERE (`BidderID` in ('".$trbidder."') and (caller_name='' or caller_name IS NULL) and Allocation_Date between '".$min_date."' and '".$max_date."')  order by leadid ASC LIMIT 0,4";
	}
	echo $citibankplqry."<br>";
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
	
	while($row2 = mysql_fetch_array($citiplqryresult))
	{
		$leadid = $row2["leadid"];
		echo $AllRequestID = $row2["AllRequestID"];
		$BidderID = $row2["BidderID"];
		$Allocation_Date = $row2["Allocation_Date"];
		
		if($AllRequestID>0)
		{
			$sequenceid=ExecQuery("Select last_allocated_to,total_no_agents From lead_allocation_table Where (Citywise='".$source."' and lead_allocation_logic='".$lead_allocation_logic."')");
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
				
			$getCheckSQl = "select leadid from client_lead_allocate where (AllRequestID = '".$AllRequestID."' and BidderID=".$BidderID.")";
			
				$getCheckQuery = ExecQuery($getCheckSQl);
				$getCheckNum = mysql_num_rows($getCheckQuery);
				if($getCheckNum>0)
				{
					$callerID = $arrCallerrID[$sequence];
					if($AllRequestID>0 && $callerID>1)
					{
						//insert allocation
						if($callerID=="7341") { $callername="caller1";} elseif($callerID=="7342"){$callername="caller2";}
						$updatecallerqry= "Update client_lead_allocate set caller_name='".$callername."' Where (leadid='".$leadid."')";
					echo "<br>".$updatecallerqry."<br>";
					$updatecallerqryresult = ExecQuery($updatecallerqry);
					$updateqry= "Update lead_allocation_table set last_allocated_to='".$sequence."' , total_lead_count='".$leadid."' Where (Citywise='".$source."' and lead_allocation_logic='".$lead_allocation_logic."')";
					echo "<br>".$final_allocationciti."<br>";
					$updateqryresult = ExecQuery($updateqry);
						echo "<br><br>";
					}
				}
				else
				{
					
				}
				$getCheckNum = '';
		}
	}
}


function allocateHDFChlleadstoagents($accessID)
{
	$Dated = ExactServerdate();
	define('TABLE_Req_Loan_Home','Req_Loan_Home');
	$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-1, date("Y"));
	$currentdate = date('Y-m-d', $tomorrow);
	//$currentdate="2016-06-01";
	$min_date = $currentdate." 00:00:00";
	$max_date = date('Y-m-d')." 23:59:59";
	//$max_date = "2016-06-01 23:59:59";
	$Global_Access_ID= $accessID;
	
	$startprocess="Select total_lead_count From lead_allocation_table Where (Citywise='hlallocatelmsCitywise' and BidderID='".$Global_Access_ID."')";
	echo $startprocess."<br>";
	$startprocessresult = ExecQuery($startprocess);
	$recordcount = mysql_num_rows($startprocessresult);
	$row=mysql_fetch_array($startprocessresult);
	$total_lead_count = $row["total_lead_count"];
	
	if($total_lead_count>0)
	{	$getActiveBiddersSql = "select BidderID from Bidders where (leadidentifier='hlallocatelmsCitywise' and Global_Access_ID='".$Global_Access_ID."' and Status=1) ORDER BY BidderID ASC";
		$getActiveBiddersQry = ExecQuery($getActiveBiddersSql);
		$recordCountActiveBidders = mysql_num_rows($getActiveBiddersQry);
		$BidderIDArr = '';
		$counterVal = 1;
		for($i=0;$i<$recordCountActiveBidders;$i++)
		{	$Selection_Category = mysql_result($getActiveBiddersQry,$i,'Selection_Category');
			$BidderID = mysql_result($getActiveBiddersQry,$i,'BidderID');
			$BidderIDArr[$counterVal] = $BidderID;
			$counterVal = $counterVal + 1;
			$BidderIDArr[$counterVal] = $BidderID;
			$BidderIDallArr[] = $BidderID;
		}
		$BidderIDStr = implode(',', $BidderIDArr);
		$BidderIDallstr = implode(',', $BidderIDallArr);
		
		$feedback_tble="Req_Feedback_Bidder_HL";
		$hlsql="SELECT RequestID,Allocation_Date,Feedback_ID FROM ".$feedback_tble.",".TABLE_Req_Loan_Home." WHERE (".$feedback_tble.".AllRequestID=".TABLE_Req_Loan_Home.".RequestID and ".$feedback_tble.".Reply_Type=2 and Req_Feedback_Bidder_HL.Feedback_ID>'".$total_lead_count."' and BidderID in ('".$Global_Access_ID."') and (".$feedback_tble.".Allocation_Date Between '".($min_date)."' and '".($max_date)."') )";
		$hlsql=$hlsql."group by ".$feedback_tble.".AllRequestID order by Feedback_ID ASC";
	
		$hlQry = ExecQuery($hlsql);
		$recordCount = mysql_num_rows($hlQry);
		$bidderID = "";
		echo $recordCount."<br>";
	
		for($i=0;$i<$recordCount;$i++)	
		{
			$AllRequestID = mysql_result($hlQry,$i,'RequestID');
			$Allocation_Date = mysql_result($hlQry,$i,'Allocation_Date');
			$Feedback_ID = mysql_result($hlQry,$i,'Feedback_ID');
		
			if($AllRequestID>0)
			{
				echo $sequenceid=ExecQuery("Select last_allocated_to,total_no_agents From lead_allocation_table Where (Citywise='hlallocatelmsCitywise' and BidderID='".$Global_Access_ID."')");
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
					echo $getCheckSQl = "select * from hlcallinglms_allocation where AllRequestID = '".$AllRequestID."' and BidderID in (".$BidderIDallstr.")  ";
					$getCheckQuery = ExecQuery($getCheckSQl);
					$getCheckNum = mysql_num_rows($getCheckQuery);
					if($getCheckNum>0)
					{					}
					else
					{
						$bidderID = $BidderIDArr[$sequence];
						if($AllRequestID>0 && $bidderID>1)
						{
							//insert allocation
							echo "<br>*******************************************<br>";
							echo $inserticiciqry="INSERT INTO hlcallinglms_allocation (AllRequestID, BidderID, Allocation_Date, DOE) VALUES ('".$AllRequestID."', '".$bidderID."', '".$Allocation_Date."', Now())";
							$inserticiciqryresult = ExecQuery($inserticiciqry);
							echo "<br>";
							echo $updateqry= "Update lead_allocation_table set last_allocated_to='".$sequence."' , total_lead_count='".$Feedback_ID."' Where (Citywise='hlallocatelmsCitywise' and BidderID='".$Global_Access_ID."')";
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
