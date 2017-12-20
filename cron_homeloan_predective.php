<?php
require 'scripts/db_init.php';
main();
function main()
{
	hlleadstoagents_verify();

	//hlleadstoagents_verifyallocate();
}






























































function hlleadstoagents_verify()
{
	$Dated = ExactServerdate();
	define('TABLE_Req_Loan_Home','Req_Loan_Home');
	$tomorrow  = mktime(0, 0, 0, date("m")  , date("d"), date("Y"));
	$currentdate = date('Y-m-d', $tomorrow);
	//$currentdate="2016-06-01";
	$min_date = $currentdate." 00:00:00";
	$max_date = date('Y-m-d')." 23:59:59";
	//$max_date = "2016-06-01 23:59:59";
	
	$startprocess="Select total_lead_count From lead_allocation_table Where (Citywise='hlmainlmsleads' and BidderID=7429)";
	echo "<br>".$startprocess."<br>";
	$startprocessresult = d4l_ExecQuery($startprocess);
	$recordcount = d4l_mysql_num_rows($startprocessresult);
	$row=d4l_mysql_fetch_array($startprocessresult);
	$total_lead_count = $row["total_lead_count"];
	
	if($total_lead_count>0)
	{	$getActiveBiddersSql = "select BidderID,Selection_Category from Bidders where (leadidentifier='hlmainlmsleads' and Status=1)";
		$getActiveBiddersQry = d4l_ExecQuery($getActiveBiddersSql);
		$recordCountActiveBidders = d4l_mysql_num_rows($getActiveBiddersQry);
		$BidderIDArr = '';
		$counterVal = 1;
		for($i=0;$i<$recordCountActiveBidders;$i++)
		{	
			$BidderID =d4l_mysql_result($getActiveBiddersQry,$i,'BidderID');
			if($Selection_Category==0)
			{
			$BidderIDArr[$counterVal] = $BidderID;
			$counterVal = $counterVal + 1;
			}
			$BidderIDallArr[] = $BidderID;
		}
		$BidderIDStr = implode(',', $BidderIDArr);
		$BidderIDallstr = implode(',', $BidderIDallArr);
		
		$hlsql="SELECT RequestID,Updated_Date,source,Net_Salary,Loan_Amount,City FROM ".TABLE_Req_Loan_Home." WHERE ( ( Updated_Date Between '".($min_date)."' and '".($max_date)."')  and RequestID>'".$total_lead_count."' and Allocated=0) order by RequestID ASC";
		//$hlsql="SELECT RequestID,Updated_Date,source,Net_Salary,Loan_Amount,City FROM Req_Loan_Home JOIN hlcallinglms_allocation ON hlcallinglms_allocation.AllRequestID=Req_Loan_Home.RequestID WHERE (RequestID>'1889893' and hlcallinglms_allocation.BidderID NOT in (64,72,207,460,732,812,2801,7429) and Allocated=0 and (Req_Loan_Home.Section IS NULL OR Req_Loan_Home.Section='') and (Req_Loan_Home.Dated >'2017-11-16 00:00:00')) group by AllRequestID";
		echo $hlsql."<br>";
		$hlQry = d4l_ExecQuery($hlsql);
		$recordCount = d4l_mysql_num_rows($hlQry);
		$bidderID = "";
		echo $recordCount."<br>";
		echo "<br>";
		//die();
		for($i=0;$i<$recordCount;$i++)	
		{
			$AllRequestID = d4l_mysql_result($hlQry,$i,'RequestID');
			$Allocation_Date = d4l_mysql_result($hlQry,$i,'Updated_Date');
			$source = d4l_mysql_result($hlQry,$i,'source');
			$Net_Salary = d4l_mysql_result($hlQry,$i,'Net_Salary');
			$Loan_Amount = d4l_mysql_result($hlQry,$i,'Loan_Amount');
			$City = d4l_mysql_result($hlQry,$i,'City');

			// source restriction
		$qryExcludeSourceCallingSql = "SELECT id FROM exclude_source_calling where (reply_type=2 and status=1 and source like %".$source."%')";
		$qryExcludeSourceCallingQuery =d4l_ExecQuery($qryExcludeSourceCallingSql);;
		$qryExcludeSourceCallingNum = d4l_mysql_num_rows($qryExcludeSourceCallingQuery);
		if($qryExcludeSourceCallingNum>0)
			{
			}
			else
			{			
		// new bidder part â€¢	Income : 25000/month & above â€¢	Loan amount : 5 lac & above. â€¢	City : Delhi /NCR 

		if($Net_Salary>=300000 && $Loan_Amount>=500000 && ($City=="New Delhi" || $City=="Delhi" || $City=="Noida" || $City=="Gurgaon" || $City=="Gaziabad" || $City=="Faridabad" || $City=="Sahibabad" || $City=="Greater Noida"))
				{ echo "<br>have eneterd clause<br>";
					$clause=1;
					$callingbidqry=d4l_ExecQuery("Select last_allocated_to,BidderID From lead_allocation_table Where (Citywise='hlmainlmsD' and BidderID=7057)");
					$allocateid = d4l_mysql_fetch_array($callingbidqry);
					$last_allocated=$allocateid["last_allocated_to"];
					$allocateBidderID=$allocateid["BidderID"];
					if($last_allocated==1)
					{ $updateqry= d4l_ExecQuery("Update lead_allocation_table set last_allocated_to='0' , total_lead_count='".$AllRequestID."' Where (Citywise='hlmainlmsD' and BidderID=7057)");

					echo "<br>Update lead_allocation_table set last_allocated_to='0' , total_lead_count='".$AllRequestID."' Where (Citywise='hlmainlmsD' and BidderID=7057)<br>";
					}
					else
					{
						echo $inserticiciqry="INSERT INTO hlcallinglms_allocation (AllRequestID, BidderID, Allocation_Date, DOE) VALUES ('".$AllRequestID."', '".$allocateBidderID."', '".$Allocation_Date."', Now())";
							$inserticiciqryresult = d4l_ExecQuery($inserticiciqry);
						$updateqry= d4l_ExecQuery("Update lead_allocation_table set last_allocated_to='1' , total_lead_count='".$AllRequestID."' Where (Citywise='hlmainlmsD' and BidderID=7057)");
						$updateqry= "Update lead_allocation_table set total_lead_count='".$AllRequestID."' Where (Citywise='hlmainlmsleads' and BidderID=7429)";
						$updateqryresult = d4l_ExecQuery($updateqry);
					}
				}
				else
				{
					echo "<br>have eneterd Else clausekh<br>";
					$sequenceid=d4l_ExecQuery("Select last_allocated_to,total_no_agents From lead_allocation_table Where (Citywise='hlmainlmsleads' and BidderID=7429)");

					echo "Select last_allocated_to,total_no_agents From lead_allocation_table Where (Citywise='hlmainlmsleads' and BidderID=7429)";
					$seqid = d4l_mysql_fetch_array($sequenceid);
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
					echo $getCheckSQl = "select * from hlverifylms_allocation where AllRequestID = '".$AllRequestID."' and BidderID in (".$BidderIDallstr.")  ";
					$getCheckQuery = d4l_ExecQuery($getCheckSQl);
					$getCheckNum = d4l_mysql_num_rows($getCheckQuery);
					if($getCheckNum>0)
					{					}
					else
					{
						$bidderID = $BidderIDArr[$sequence];
						if($AllRequestID>0 && $bidderID>1)
						{
							//insert allocation
							echo "<br>*******************************************<br>";
							echo $inserticiciqry="INSERT INTO hlverifylms_allocation (AllRequestID, BidderID, Allocation_Date, status, DOE) VALUES ('".$AllRequestID."', '".$bidderID."', Now(), '1', '".$Allocation_Date."')";
							$inserticiciqryresult = d4l_ExecQuery($inserticiciqry);
							echo "<br>";
							echo $updateqry= "Update lead_allocation_table set last_allocated_to='".$sequence."' , total_lead_count='".$AllRequestID."' Where (Citywise='hlmainlmsleads' and BidderID=7429)";
							$updateqryresult = d4l_ExecQuery($updateqry);
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