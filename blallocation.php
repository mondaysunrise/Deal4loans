<?php
require 'scripts/db_init.php';

BidderAllocateBL();
//HDFCBLBIDDER();

function HDFCBLBIDDER()
	{
			$source = 'CallingHDFCBL';
			$lead_allocation_logic = 118;
			$Global_Access_ID = 7008;
			$currentdate=Date('Y-m-d');
			//$currentdate="2017-04-20";
			$min_date = $currentdate." 00:00:00";
			$max_date = $currentdate." 23:59:59";
			
			$startprocess="Select total_lead_count From lead_allocation_table Where (Citywise='HDFCBLINTERNAL' and lead_allocation_logic='".$lead_allocation_logic."')";
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
				$citibankplqry="Select * From Req_Feedback_Bidder_PL Where (BidderID in ('".$trbidder."') and Feedback_ID>'".$total_lead_count."' and Reply_Type=1 and Allocation_Date between '".$min_date."' and '".$max_date."') order by Feedback_ID ASC";
			}
			else
			{
				$citibankplqry="Select * From Req_Feedback_Bidder_PL Where (BidderID in ('".$trbidder."')  and Reply_Type=1 and Allocation_Date between '".$min_date."' and '".$max_date."') order by Feedback_ID ASC";
			}
			echo $citibankplqry."<br>";
			$citiplqryresult = d4l_ExecQuery($citibankplqry);
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
		while($row2 = d4l_mysql_fetch_array($citiplqryresult))
		{
			echo"i m here";
		echo "<br>hghjb".$Feedback_ID = $row2["Feedback_ID"];
		echo $AllRequestID = $row2["AllRequestID"];
		$BidderID = $row2["BidderID"];
		$Allocation_Date = $row2["Updated_Date"];

		if($AllRequestID>0)
		{
			echo "yes";
		$sequenceid=ExecQuery("Select last_allocated_to,total_no_agents From lead_allocation_table Where (Citywise='HDFCBLINTERNAL' and lead_allocation_logic='".$lead_allocation_logic."')");
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

		echo $getCheckSQl = "select AllRequestID from lead_allocate where (AllRequestID = '".$AllRequestID."' and BidderID in (".$trbidder."))";

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
			echo "<br>".$final_allocationciti="INSERT lead_allocate (AllRequestID, BidderID, Reply_Type, Allocation_Date) VALUE ('".$AllRequestID."','".$callerID."','1', Now())";
			$final_allocationcitiresult = ExecQuery($final_allocationciti);
			echo "<br>".$updateqry= "Update lead_allocation_table set last_allocated_to='".$sequence."' , total_lead_count='".$AllRequestID."' Where (Citywise='HDFCBLINTERNAL' and lead_allocation_logic='".$lead_allocation_logic."')";
			echo "<br>".$final_allocationciti."<br>";
			$updateqryresult = ExecQuery($updateqry);
							echo "<br><br>";
			}
		}
		$getCheckNum = '';
		}
		}
	} // hdfc bl INternal


//Business loan Allocation for Bidders
function BidderAllocateBL()
{
	echo $getpldata="Select RequestID,City,City_Other from Req_Loan_Personal where (Allocated =0 and Employment_Status=0 and Net_Salary>=260000 and (Dated >=DATE_SUB(CURDATE(),INTERVAL 1 DAY)))";

	echo "<br>1:";
	$getpldataresult = ExecQuery($getpldata);
	$recordcount1 = mysql_num_rows($getpldataresult);
//	echo $recordcount1."<br>";
	$bidderID="";

	while($row2 = mysql_fetch_array($getpldataresult))
	{
		$AllRequestID = $row2["RequestID"];
		$Allocation_Date = $row2["Updated_Date"];
		$Feedback_ID = $row2["City"];
		$City = $row2["City"];
		$City_Other = $row2["City_Other"];
	// place clause for prepaid bidder here:
		if($City=="Others" || $City=="Please Select")
		{
			$City=$City_Other;
		}
		else
		{
			$City= $City;
		}
		$valuefetch=getBiddersListBL($AllRequestID,$City);
		print_r($valuefetch);
		if(count($valuefetch)>0 && $valuefetch[0]>0)
		{	echo $Final_Bid=implode(",",$valuefetch);
			$Allocated=2;
			echo "<br>2:";
			echo $updatelead="Update Req_Loan_Personal set Bidderid_Details='".$Final_Bid."',Dated=Now(), Allocated='".$Allocated."' where RequestID=".$AllRequestID;
			$updateleadresult = ExecQuery($updatelead);
		}
	}
}
//Business loan Allocation for Bidders end

function getBiddersListBL($strRequestID,$strCity)
{   
    $RequestID = $strRequestID;
	$mvarCity = $strCity;
	$mvarType = 1;

	$qry = "SELECT * FROM Bidders_List WHERE (Reply_Type='".$mvarType."' and City LIKE '%".$mvarCity."%' and  Restrict_Bidder=1 and BankID!=66 and BankID!=80 ) order by Bidder_Name ASC";

	 list($firstcount,$row)=MainselectfuncNew($qry,$array = array());
	$i=0;    $j=0;    $k=0;    $z=0;   $q=0;
   
	for($fc=0;$fc<$firstcount;$fc++)
    {
        $query = $row[$fc]["Query"];
		 $FBidder_Name = $row[$fc]["Bidder_Name"];
        $table = $row[$fc]["Table_Name"];
		$City = $row[$fc]["City"];
		$BankID = $row[$fc]["BankID"];
    	//Start For Cap Function
		$TodayYear = date('Y');
		$TodayMonth = date('m');
		$TodayWeek = date('W');
		$TodayDay = date('d');
	$Cap_MinDate = $row[$fc]["Cap_MinDate"];
	
	$CapLead_Count = $row[$fc]["CapLead_Count"];
	$FBidderID = $row[$fc]["BidderID"];		
      		
	$ExplodeCapLead = explode(",", $CapLead_Count);
	$CapDay = $ExplodeCapLead[0];
	$CapWeek = $ExplodeCapLead[1];
	$CapMonth = $ExplodeCapLead[2];
	$CapLifeTime = $ExplodeCapLead[3];
	$TodayDate = date("Y-m-d");
	$CheckDateSql = "select sum(BookLeadCount) as SumDay from Bidders_Book_Keeping where BidderID = ".$FBidderID." and BookDate = ".$TodayDay." and BookProduct='".$mvarType."'  and  BookMonth = ".$TodayMonth." and  BookYear= ".$TodayYear." ";
	list($daycount,$row_result_D)=MainselectfuncNew($CheckDateSql,$array = array());
	$DayCount = $row_result_D[0]['SumDay'];
	
	$CheckWeekSql = "select sum(BookLeadCount) as SumWeek from Bidders_Book_Keeping where BidderID = ".$FBidderID." and BookWeek = ".$TodayWeek." and BookProduct='".$mvarType."' and  BookYear= ".$TodayYear." ";
	list($weekcount,$row_result_W)=MainselectfuncNew($CheckWeekSql,$array = array());
	$Total4Week = $row_result_W[0]['SumWeek'];
	
	$CheckMonthSql = "select sum(BookLeadCount) as SumMonth from Bidders_Book_Keeping where BidderID = ".$FBidderID." and BookMonth = ".$TodayMonth." and BookProduct='".$mvarType."' and  BookYear= ".$TodayYear." ";
	list($monthcount,$row_result_M)=MainselectfuncNew($CheckMonthSql,$array = array());
	$Total4Month = $row_result_M[0]['SumMonth'];
	
	$CheckLifeTimeSql = "select sum(BookLeadCount) as SumLifeTime from Bidders_Book_Keeping where BidderID = ".$FBidderID." and BookProduct='".$mvarType."'";
	list($lifetimecount,$row_result_LT)=MainselectfuncNew($CheckLifeTimeSql,$array = array());
	$Total4LifeTime = $row_result_LT[0]['SumLifeTime'];
	
		//Start Check for Day Cap Lead
		if(($CapDay!=0 && $CapDay!='' && $DayCount<$CapDay) || $CapDay==0 || $CapDay=="NULL")
		{
			//echo "(if)DayCount : ".$DayCount." CapDay : ". $CapDay; echo "<br>";
			$ValidBidder_Day = 1;
		}
		else
		{
			$ValidBidder_Day = 0;
				//echo "(else)DayCount : ".$DayCount." CapDay : ". $CapDay;echo "<br>";
		}
		//End Check for Day Cap Lead
		//Start Check for Week Cap Lead
		if(($CapWeek!=0 && $CapWeek!='' && $Total4Week<$CapWeek) || $CapWeek==0  || $CapWeek=="NULL")
		{
			//echo "(if)Total4Week : ".$Total4Week." CapWeek : ". $CapWeek;echo "<br>";
			$ValidBidder_Week = 1;
		}
		else
		{
			//echo "(else)Total4Week : ".$Total4Week." CapWeek : ". $CapWeek;echo "<br>";
			$ValidBidder_Week = 0;
		}
		//End Check for Week Cap Lead
		//Start Check for Month Cap Lead
		if(($CapMonth!=0 && $CapMonth!='' && $Total4Month<$CapMonth) || $CapMonth==0  || $CapMonth=="NULL")
		{
			//echo "(if)Total4Month : ".$Total4Month." CapMonth : ". $CapMonth;echo "<br>";
			$ValidBidder_Month = 1;
		}
		else
		{
			//echo "(else)Total4Month : ".$Total4Month." CapMonth : ". $CapMonth;echo "<br>";
			$ValidBidder_Month = 0;
		}
		//End Check for Month Cap Lead
		//Start Check for LifeTime Cap Lead
		if(($CapLifeTime!=0 && $CapLifeTime!='' && $Total4LifeTime<$CapLifeTime) || $CapLifeTime==0  || $CapLifeTime=="NULL")
		{
			//echo "(if)Total4LifeTime : ".$Total4LifeTime." CapLifeTime : ". $CapLifeTime;echo "<br>";
			$ValidBidder_LT = 1;
		}
		else
		{
			//echo "(else)Total4LifeTime : ".$Total4LifeTime." CapLifeTime : ". $CapLifeTime;echo "<br>";
			$ValidBidder_LT = 0;
		}
		//End Check for LifeTime Cap Lead
			if($ValidBidder_Day==1 && $ValidBidder_Week==1 && $ValidBidder_Month==1 && $ValidBidder_LT==1)
			{
				$Bidderid = $FBidderID;
				$Bidder_Name = $FBidder_Name;
			}
			else {
				 $Bidderid = "Not Valid"; }
		
		//End For Cap Function
	    $City = trim($row[$fc]["City"]);
		$oldcity = explode(",", $City);
		$newcity = implode ("','",$oldcity) ;
		$propercity="('".$newcity."')";
			
		$qry2 = $query." and (City in ".$propercity." or City_Other in ".$propercity." ) and Req_Loan_Personal.RequestID ='".$RequestID."'";
         list($recordcount,$result1)=MainselectfuncNew($qry2,$array = array());
       	if($recordcount>0 && $Bidderid!="Not Valid") //(result1)
		{
			$bankid[] = $BankID;
			$BidderID[] = $Bidderid;
			 $BidderName[] = $Bidder_Name;
		}
		}
		
	$bidder = $BidderID;
	return($bidder);

	}

?>