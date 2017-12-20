<?php
ini_set("display_errors", "1");
error_reporting(E_ALL);
require 'scripts/db_init.php';
require 'scripts/db_init_wishfin.php';

CibilAllocateSuccess();
CibilAllocateFail();


function CibilAllocateSuccess()
{
	$capping="25";
	$ProductType=15;
	$source = 'CibilCallingLms';
	$lead_allocation_logic = 186;
	$Global_Access_ID = 7107;
	$currentdate=Date('Y-m-d');
	//$currentdate='2017-09-07';
	$TodayYear = date('Y');
	$TodayMonth = date('m');
	$TodayWeek = date('W');
	$TodayDay = date('d');

	///////////// get agent list
	$counterVal = 1;
	$arrcallerqry=d4l_ExecQuery("Select BidderID from Bidders Where (leadidentifier='".$source."' and Status=1) order by BidderID ASC");
	while($rowcal=d4l_mysql_fetch_array($arrcallerqry))
	{
		$arrCallerrID[$counterVal] = $rowcal["BidderID"];
		$counterVal = $counterVal + 1;
	}
	echo "<br>";
	///////////////
	echo "2:".$startprocess="Select total_lead_count From lead_allocation_table Where (Citywise='".$source."' and lead_allocation_logic='".$lead_allocation_logic."')";
	$startprocessresult = d4l_ExecQuery($startprocess);
	$recordcount = d4l_mysql_num_rows($startprocessresult);
	$row=d4l_mysql_fetch_array($startprocessresult);
	$total_lead_count = $row["total_lead_count"];
	echo "<br>";
	if($total_lead_count>0)
	{
		$citibankplqry="Select id,source From xkyknzl5dwfyk4hg_cibil Where (cibil_status='Success' and id>'".$total_lead_count."' and DATE(date_created) ='".$currentdate."') order by id ASC ";
	}
	else
	{
		$citibankplqry="Select id,source From xkyknzl5dwfyk4hg_cibil Where (cibil_status='Success' and DATE(date_created) ='".$currentdate."') order by id ASC ";
	}
	echo "3:".$citibankplqry."<br>";
	$citiplqryresult = wf_ExecQuery($citibankplqry);
	$recordcount1 = wf_mysql_num_rows($citiplqryresult);
	$bidderID="";
	
	while($row2 = wf_mysql_fetch_array($citiplqryresult))
	{
		echo $cibilid= $row2["id"];
		echo "<br><br>";
		///check for d4l part
	echo "4:".$d4lstartprocess="Select id From api_customer_cibil Where (cibil_id='".$cibilid."' and process_source!='directweb')";
	echo "<br>";
	$d4lstartprocessresult = d4l_ExecQuery($startprocess);
	$d4lrow=d4l_mysql_fetch_array($startprocessresult);
	if(isset($d4lrow["id"]))
		{
		}
		else
		{
			$d4lstartplprocess="Select id From api_log_cibil Where (cibil_id='".$cibilid."' and product='PL')";
		$d4lstartplprocessresult = d4l_ExecQuery($d4lstartplprocess);
	$d4lplrow=d4l_mysql_fetch_array($d4lstartplprocessresult);
			if(isset($d4lplrow["id"]))
			{
			}
			else
			{
		///
		if($cibilid>0)
		{
			$CapDay=$capping;
			$sequenceid=d4l_ExecQuery("Select last_allocated_to,total_no_agents From lead_allocation_table Where (Citywise='".$source."' and lead_allocation_logic='".$lead_allocation_logic."')");
				$seqid = d4l_mysql_fetch_array($sequenceid);
				$last_allocated_to = $seqid["last_allocated_to"];
				$total_no_agents = $seqid["total_no_agents"];
				//check for capping here
				if($last_allocated_to>0)
				{	$callerID = $arrCallerrID[$last_allocated_to];
						///////////////////////DAY CAP//////////////////////////
					echo "5:".$CheckDateSql = "select sum(BookLeadCount) as SumDay from Bidders_Book_Keeping where BidderID = ".$callerID." and BookDate = ".$TodayDay." and BookProduct='".$ProductType."'  and  BookMonth = ".$TodayMonth." and  BookYear= ".$TodayYear." ";// Query returns the sum of lead count on every day 
					echo "<br>";
					$CheckDateQuery = d4l_ExecQuery($CheckDateSql);
					$row_result_D=d4l_mysql_fetch_array($CheckDateQuery);
					$DayCount = $row_result_D['SumDay'];

					if(($CapDay!=0 && $CapDay!='' && $DayCount<$CapDay) || $CapDay==0 || $CapDay=="NULL")
					{
						$sequence = $last_allocated_to;
					}
					else
					{
						if($total_no_agents>$last_allocated_to)
						{
							$sequence=$last_allocated_to+1;
						}
						else
						{
							$sequence=1;
						}
					}					
				}
				else
				{
					$sequence=1;
				}

				$callerID = $arrCallerrID[$sequence];
				//book keepig entry
				echo "6:".$BookKeepingSql = "select * from Bidders_Book_Keeping where BidderID=".$callerID." and BookProduct=".$ProductType." and BookDate=".$TodayDay." and BookMonth=".$TodayMonth." and BookYear=".$TodayYear."";
                $BookKeepingQuery = d4l_ExecQuery($BookKeepingSql);
               echo "<br>";
                $BookLeadCountExisting = @d4l_mysql_result($BookKeepingQuery,0,'BookLeadCount');
                $BookDate = @d4l_mysql_result($BookKeepingQuery,0,'BookDate');//added
                $BookMonth = @d4l_mysql_result($BookKeepingQuery,0,'BookMonth');//added
                $BookYear = @d4l_mysql_result($BookKeepingQuery,0,'BookYear');//added

                 if($BookLeadCountExisting>=1)
                 {
                     //Update
                    $IncrementLeadCount = $BookLeadCountExisting + 1;
                    echo "7:".$UpdateBKSql = "update Bidders_Book_Keeping set BookLeadCount=".$IncrementLeadCount.", BookEntryTime = Now()  where BidderID = ".$callerID." and BookDate = ".$TodayDay." and BookMonth=".$TodayMonth." and BookYear =".$TodayYear." and BookProduct =".$ProductType."";
                    d4l_ExecQuery($UpdateBKSql);
					echo "<br><br>";
                 }
                 else
                 {
                    //Insert
                    $InitialCount = 1;
                    echo "8:".$InsertBKSql = "INSERT INTO Bidders_Book_Keeping ( BidderID , BookProduct , BookDate , BookWeek , BookMonth , BookYear , BookLeadCount, BookEntryTime ) VALUES (".$callerID.", ".$ProductType.", ".$TodayDay.",".$TodayWeek.", ".$TodayMonth.", ".$TodayYear.", ".$InitialCount.",Now())";
                    d4l_ExecQuery($InsertBKSql);
					echo "<br><br>";
                 }
				//book keeping entry
				$strCallerrID = implode(",".$arrCallerrID);
				//capping chec end				
				echo "9:".$getCheckSQl = "select Feedback_ID from wf_lead_allocate where (leadid = '".$cibilid."' and callerid in (".$strCallerrID."))";
				echo "<br>";
				$getCheckQuery = d4l_ExecQuery($getCheckSQl);
				$getCheckNum = d4l_mysql_num_rows($getCheckQuery);
				if($getCheckNum>0)
				{//Already Existing Lead
				}
				else
				{					
					if($cibilid>0 && $callerID>1)
					{
						//insert allocation
					echo "10:".$final_allocationciti="INSERT wf_lead_allocate (leadid, callerid, product) VALUE ('".$cibilid."','".$callerID."','".$ProductType."')";
					echo "<br>";echo "<br>";
					$final_allocationcitiresult = d4l_ExecQuery($final_allocationciti);
					$updateqry= "Update lead_allocation_table set last_allocated_to='".$sequence."' , total_lead_count='".$cibilid."' Where (Citywise='".$source."' and lead_allocation_logic='".$lead_allocation_logic."')";
					echo "<br>".$final_allocationciti."<br>";
					$updateqryresult = d4l_ExecQuery($updateqry);
						echo "<br><br>";
					}
				}
				$getCheckNum = '';
			}
			}
		}
	}
} 

//For cibil success cases func end


// for cibil fail cases

function CibilAllocateFail()
{	
	$capping="20";
	$ProductType=15;
	$source = 'CibilCallingLmsF';
	$lead_allocation_logic = 187;
	$Global_Access_ID = 7107;
	$currentdate=Date('Y-m-d');
	//$currentdate='2017-09-07';
	$TodayYear = date('Y');
	$TodayMonth = date('m');
	$TodayWeek = date('W');
	$TodayDay = date('d');

	///////////// get agent list
	$counterVal = 1;
	$arrcallerqry=d4l_ExecQuery("Select BidderID from Bidders Where (leadidentifier='".$source."' and Status=1) order by BidderID ASC");
	while($rowcal=d4l_mysql_fetch_array($arrcallerqry))
	{
		$arrCallerrID[$counterVal] = $rowcal["BidderID"];
		$counterVal = $counterVal + 1;
	}
	echo "<br>";
	///////////////
	$startprocess="Select total_lead_count From lead_allocation_table Where (Citywise='".$source."' and lead_allocation_logic='".$lead_allocation_logic."')";
	$startprocessresult = d4l_ExecQuery($startprocess);
	$recordcount = d4l_mysql_num_rows($startprocessresult);
	$row=d4l_mysql_fetch_array($startprocessresult);
	$total_lead_count = $row["total_lead_count"];
	echo "<br>";
	if($total_lead_count>0)
	{
		$citibankplqry="Select id,source From xkyknzl5dwfyk4hg_cibil Where (cibil_status!='Success' and id>'".$total_lead_count."' and DATE(date_created) ='".$currentdate."') order by id ASC";
	}
	else
	{
		$citibankplqry="Select id,source From xkyknzl5dwfyk4hg_cibil Where (cibil_status!='Success' and DATE(date_created) ='".$currentdate."') order by id ASC ";
	}
	//echo "3:".$citibankplqry."<br>";
	$citiplqryresult = wf_ExecQuery($citibankplqry);
	$recordcount1 = wf_mysql_num_rows($citiplqryresult);
	$bidderID="";
	
	while($row2 = wf_mysql_fetch_array($citiplqryresult))
	{
		$cibilid= $row2["id"];
		//echo "<br><br>";
		///check for d4l part
	$d4lstartprocess="Select id From api_customer_cibil Where (cibil_id='".$cibilid."' and process_source!='directweb')";
	//echo "<br>";
	$d4lstartprocessresult = d4l_ExecQuery($startprocess);
	$d4lrow=d4l_mysql_fetch_array($startprocessresult);
	if(isset($d4lrow["id"]))
		{
		}
		else
		{
		///
		if($cibilid>0)
		{
			$CapDay=$capping;
			$sequenceid=d4l_ExecQuery("Select last_allocated_to,total_no_agents From lead_allocation_table Where (Citywise='".$source."' and lead_allocation_logic='".$lead_allocation_logic."')");
				$seqid = d4l_mysql_fetch_array($sequenceid);
				$last_allocated_to = $seqid["last_allocated_to"];
				$total_no_agents = $seqid["total_no_agents"];
				//check for capping here
				if($last_allocated_to>0)
				{	$callerID = $arrCallerrID[$last_allocated_to];
						///////////////////////DAY CAP//////////////////////////
					$CheckDateSql = "select sum(BookLeadCount) as SumDay from Bidders_Book_Keeping where BidderID = ".$callerID." and BookDate = ".$TodayDay." and BookProduct='".$ProductType."'  and  BookMonth = ".$TodayMonth." and  BookYear= ".$TodayYear." ";// Query returns the sum of lead count on every day 
					//echo "<br>";
					$CheckDateQuery = d4l_ExecQuery($CheckDateSql);
					$row_result_D=d4l_mysql_fetch_array($CheckDateQuery);
					$DayCount = $row_result_D['SumDay'];

					if(($CapDay!=0 && $CapDay!='' && $DayCount<$CapDay) || $CapDay==0 || $CapDay=="NULL")
					{
						$sequence = $last_allocated_to;
					}
					else
					{
						if($total_no_agents>$last_allocated_to)
						{
							$sequence=$last_allocated_to+1;
						}
						else
						{
							$sequence=1;
						}
					}					
				}
				else
				{
					$sequence=1;
				}

				$callerID = $arrCallerrID[$sequence];
				//book keepig entry
				$BookKeepingSql = "select * from Bidders_Book_Keeping where BidderID=".$callerID." and BookProduct=".$ProductType." and BookDate=".$TodayDay." and BookMonth=".$TodayMonth." and BookYear=".$TodayYear."";
                $BookKeepingQuery = d4l_ExecQuery($BookKeepingSql);
               //echo "<br>";
                $BookLeadCountExisting = @d4l_mysql_result($BookKeepingQuery,0,'BookLeadCount');
                $BookDate = @d4l_mysql_result($BookKeepingQuery,0,'BookDate');//added
                $BookMonth = @d4l_mysql_result($BookKeepingQuery,0,'BookMonth');//added
                $BookYear = @d4l_mysql_result($BookKeepingQuery,0,'BookYear');//added

                 if($BookLeadCountExisting>=1)
                 {
                     //Update
                    $IncrementLeadCount = $BookLeadCountExisting + 1;
                    $UpdateBKSql = "update Bidders_Book_Keeping set BookLeadCount=".$IncrementLeadCount.", BookEntryTime = Now()  where BidderID = ".$callerID." and BookDate = ".$TodayDay." and BookMonth=".$TodayMonth." and BookYear =".$TodayYear." and BookProduct =".$ProductType."";
                    d4l_ExecQuery($UpdateBKSql);
					//echo "<br><br>";
                 }
                 else
                 {
                    //Insert
                    $InitialCount = 1;
                   $InsertBKSql = "INSERT INTO Bidders_Book_Keeping ( BidderID , BookProduct , BookDate , BookWeek , BookMonth , BookYear , BookLeadCount, BookEntryTime ) VALUES (".$callerID.", ".$ProductType.", ".$TodayDay.",".$TodayWeek.", ".$TodayMonth.", ".$TodayYear.", ".$InitialCount.",Now())";
                    d4l_ExecQuery($InsertBKSql);
					//echo "<br><br>";
                 }
				//book keeping entry
				$strCallerrID = implode(",".$arrCallerrID);
				//capping chec end				
				$getCheckSQl = "select Feedback_ID from wf_lead_allocate where (leadid = '".$cibilid."' and callerid in (".$strCallerrID."))";
				//echo "<br>";
				$getCheckQuery = d4l_ExecQuery($getCheckSQl);
				$getCheckNum = d4l_mysql_num_rows($getCheckQuery);
				if($getCheckNum>0)
				{//Already Existing Lead
				}
				else
				{					
					if($cibilid>0 && $callerID>1)
					{
						//insert allocation
					$final_allocationciti="INSERT wf_lead_allocate (leadid, callerid, product) VALUE ('".$cibilid."','".$callerID."','".$ProductType."')";
					
					$final_allocationcitiresult = d4l_ExecQuery($final_allocationciti);
					$updateqry= "Update lead_allocation_table set last_allocated_to='".$sequence."' , total_lead_count='".$cibilid."' Where (Citywise='".$source."' and lead_allocation_logic='".$lead_allocation_logic."')";
				
					$updateqryresult = d4l_ExecQuery($updateqry);
				
					}
				}
				$getCheckNum = '';
			}
		}
	}
} 
?>