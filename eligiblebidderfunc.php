<?
function geteligibleBiddersList($strProduct,$strRequestID,$strCity,$strreferral_Flag,$source)
{
	$RequestID = $strRequestID;
	$mvarCity = $strCity;
	$mvarType = 2;
	if(strlen($mvarCity)>0)
	{
   if($strreferral_Flag==1)
	{
	 $qry = "SELECT * FROM Bidders_List WHERE (Reply_Type='".$mvarType."' and City LIKE '%".$mvarCity."%' and  Restrict_Bidder=1 and Referral_Flag=1 and 	lms_block_flag=0)";
	}
	 else if($strreferral_Flag==2)
	{
	 $qry = "SELECT * FROM Bidders_List WHERE (Reply_Type='".$mvarType."' and City LIKE '%".$mvarCity."%' and  Restrict_Bidder=1 and BidderID in (2718,2730,2719,2852,2958,2720,2843,2844,2845,2846,2995,2996) and lms_block_flag=0)";
	}
	else
	{
		if($source=="common floor")
		{
		$qry = "SELECT * FROM Bidders_List WHERE (Reply_Type='".$mvarType."' and City LIKE '%".$mvarCity."%' and  Restrict_Bidder=1 and BidderID not in (1476,1477,1580,1581,1582,1583,1584,1585,1586,1587,1696) and lms_block_flag=0)";
		}
else
		{
			$qry = "SELECT * FROM Bidders_List WHERE (Reply_Type='".$mvarType."' and City LIKE '%".$mvarCity."%' and  Restrict_Bidder=1 and lms_block_flag=0)";
		}

	}
	
    $result = d4l_ExecQuery($qry);
    $firstcount = d4l_mysql_num_rows($result);
   
    $i=0;
    $j=0;
    $k=0;
    $z=0;   
    $q=0;

   
    while ($row = d4l_mysql_fetch_array($result))
    {
        $query = trim($row["Query"]);
		 $FBidder_Name = $row["Bidder_Name"];
        $table = $row["Table_Name"];
		$City = trim($row["City"]);
		$BankID = $row["BankID"];
      		
		 	
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////		
		//Start For Cap Function
		$TodayYear = date('Y');
		$TodayMonth = date('m');
		$TodayWeek = date('W');
		$TodayDay = date('d');
	$Cap_MinDate = $row["Cap_MinDate"];
	
	$CapLead_Count = $row["CapLead_Count"];
	$FBidderID = $row["BidderID"];	
	
	
	$ExplodeCapLead = explode(",", $CapLead_Count);
	$CapDay = $ExplodeCapLead[0];
	$CapWeek = $ExplodeCapLead[1];
	$CapMonth = $ExplodeCapLead[2];
	$CapLifeTime = $ExplodeCapLead[3];
	$TodayDate = date("Y-m-d");

	 $CheckDateSql = "select sum(BookLeadCount) as SumDay from Bidders_Book_Keeping where BidderID = ".$FBidderID." and BookDate = ".$TodayDay." and BookProduct='".$mvarType."'  and  BookMonth = ".$TodayMonth." and  BookYear= ".$TodayYear." ";
	$CheckDateQuery = d4l_ExecQuery($CheckDateSql);
	$row_result_D=@d4l_mysql_fetch_array($CheckDateQuery);
	$DayCount = $row_result_D['SumDay'];
	
	$CheckWeekSql = "select sum(BookLeadCount) as SumWeek from Bidders_Book_Keeping where BidderID = ".$FBidderID." and BookWeek = ".$TodayWeek." and BookProduct='".$mvarType."' and  BookYear= ".$TodayYear." ";
	$CheckWeekQuery = d4l_ExecQuery($CheckWeekSql);
	$row_result_W=@d4l_mysql_fetch_array($CheckWeekQuery);
	$Total4Week = $row_result_W['SumWeek'];
	
	
	$CheckMonthSql = "select sum(BookLeadCount) as SumMonth from Bidders_Book_Keeping where BidderID = ".$FBidderID." and BookMonth = ".$TodayMonth." and BookProduct='".$mvarType."' and  BookYear= ".$TodayYear." ";
	$CheckMonthQuery = d4l_ExecQuery($CheckMonthSql);
	$row_result_M=@d4l_mysql_fetch_array($CheckMonthQuery);
	$Total4Month = $row_result_M['SumMonth'];
	
	
	//Changed on 27-02-08 as per discussion with wribhu sir
	$CheckLifeTimeSql = "select sum(BookLeadCount) as SumLifeTime from Bidders_Book_Keeping where BidderID = ".$FBidderID." and BookProduct='".$mvarType."'";
	
	$CheckLifeTimeQuery = d4l_ExecQuery($CheckLifeTimeSql);
	$row_result_LT=@d4l_mysql_fetch_array($CheckLifeTimeQuery);
	$Total4LifeTime = $row_result_LT['SumLifeTime'];

	
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
		else 
			 $Bidderid = "Not Valid";
			
			
		//End For Cap Function
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
       
      $City = trim($row["City"]);
		//echo $City."<br>";
		$oldcity = @explode(",", $City);
		$newcity = @implode ("','",$oldcity) ;
			//echo $newcity."<br>";
			$propercity="('".$newcity."')";
			
		$qry2 = $query." and (City in ".$propercity." or City_Other in ".$propercity." ) and Req_Loan_Home.RequestID ='".$RequestID."'";
        //$qry2 = $query." and ".$table.".RequestID ='".$RequestID."'";
     
        $result1=d4l_ExecQuery($qry2);
        $recordcount = @d4l_mysql_num_rows($result1);
        	if($recordcount>0 && $Bidderid!="Not Valid") //(result1)
		{
			$bankid[] = $BankID;
			
			$BidderID[] = $Bidderid;
			 $BidderName[] = $Bidder_Name;
			
		}
		}
		
		for($j=0;$j<count($bankid);$j++)
	{
		$getbankid="select * from Bank_Master where BankID in (".$bankid[$j].")";
		//echo $getbankid;
		$bankidresult=d4l_ExecQuery($getbankid);
		while($row=d4l_mysql_fetch_array($bankidresult))
		{
			$getbankid =$row['Bank_Name'];
			$getbankarr[]=$getbankid;
		
		}
	}
	
	
	
	$getbidderID=@array_unique($getbankarr);
	//$bidder[]=$bankid;
	//$bidder[] = $getbidderID;

	$bidder[] = $BidderID;
	$bidder[] = $BidderName;
	
return($bidder);

	}
}
	?>
