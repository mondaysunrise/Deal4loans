<?php
function getBiddersList($strProduct,$strRequestID,$strCity)
{   
    $RequestID = $strRequestID;
	$mvarCity = $strCity;
	$mvarType = 1;
    $qry = "SELECT *,Bidders_List.City AS citywise FROM Bidders_List LEFT OUTER JOIN Bidders ON Bidders.BidderID=Bidders_List.BidderID  WHERE (Bidders_List.Reply_Type='".$mvarType."' and Bidders_List.City LIKE  '%".$mvarCity."%' and  Bidders_List.Restrict_Bidder=1 AND Bidders.Define_PrePost='PostPaid' ) order by `bankwise_priority` ASC";
	list($firstcount,$row)=MainselectfuncNew($qry,$array = array());
	$i=0;    $j=0;    $k=0;    $z=0;   $q=0;
   
	for($fc=0;$fc<$firstcount;$fc++)
    {
        $query = $row[$fc]["Query"];
		 $FBidder_Name = $row[$fc]["Bidder_Name"];
        $table = $row[$fc]["Table_Name"];
		$City = $row[$fc]["City"];
      		
		        //$Bidderid = $row[$fc]["BidderID"];
		//echo "<br>"; 	
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////		
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
			$ValidBidder_Day = 1;
		}
		else
		{
			$ValidBidder_Day = 0;
		}
		//End Check for Day Cap Lead
		//Start Check for Week Cap Lead
		if(($CapWeek!=0 && $CapWeek!='' && $Total4Week<$CapWeek) || $CapWeek==0  || $CapWeek=="NULL")
		{
			$ValidBidder_Week = 1;
		}
		else
		{
			$ValidBidder_Week = 0;
		}
		//End Check for Week Cap Lead
		//Start Check for Month Cap Lead
		if(($CapMonth!=0 && $CapMonth!='' && $Total4Month<$CapMonth) || $CapMonth==0  || $CapMonth=="NULL")
		{
			$ValidBidder_Month = 1;
		}
		else
		{
			$ValidBidder_Month = 0;
		}
		//End Check for Month Cap Lead
		//Start Check for LifeTime Cap Lead
		if(($CapLifeTime!=0 && $CapLifeTime!='' && $Total4LifeTime<$CapLifeTime) || $CapLifeTime==0  || $CapLifeTime=="NULL")
		{
			$ValidBidder_LT = 1;
		}
		else
		{
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
      $City = trim($row[$fc]["citywise"]);
		$oldcity = explode(",", $City);
		$newcity = implode ("','",$oldcity) ;
		$propercity="('".$newcity."')";
			
		$querynw = str_replace("Req_Loan_Personal", "saveemicalc_tbl", $query);
		$querynw = str_replace("RequestID", "saveemiid", $querynw);
		
		$qry2 = $querynw." and (City in ".$propercity." or City_Other in ".$propercity." ) and saveemicalc_tbl.saveemiid ='".$RequestID."'";
     list($recordcount,$result1)=MainselectfuncNew($qry2,$array = array());
	 
        if($recordcount>0 && $Bidderid!="Not Valid") //(result1)
		{
			$bankid[] = $BankID;
			$BidderID[] = $Bidderid;
			$BidderName[] = $Bidder_Name;			
		}
		}
		
	for($j=0;$j<count($bankid);$j++)
	{
		$getbankid="select * from Bank_Master where BankID=".$bankid[$j];
		//echo $getbankid;
	 list($rowcount,$row)=MainselectfuncNew($getbankid,$array = array());
		
		for($jj=0;$jj<$rowcount;$jj++)
		{
			$getbankid =$row[$jj]['Bank_Name'];
			$getbankarr[]=$getbankid;
		}
	}	
	
	$getbidderID=@array_unique($getbankarr);
	$bidder[]= @array_unique($bankid);
	$bidder[] = @array_unique($getbidderID);
	$bidder[] = @array_unique($BidderID);
	$bidder[] = @array_unique($BidderName);	
return($bidder);
	}

	function getBiddersList_pl($strProduct,$strRequestID,$strCity)
{   
    $RequestID = $strRequestID;
	$mvarCity = $strCity;
	$mvarType = 1;
  	 $qry = "SELECT *,Bidders_List.City AS citywise FROM Bidders_List LEFT OUTER JOIN Bidders ON Bidders.BidderID=Bidders_List.BidderID  WHERE (Bidders_List.Reply_Type='".$mvarType."' and Bidders_List.City LIKE  '%".$mvarCity."%' and  Bidders_List.Restrict_Bidder=1 AND Bidders.Define_PrePost='PostPaid' ) order by `bankwise_priority` ASC";
list($firstcount,$row)=MainselectfuncNew($qry,$array = array());
	$i=0;    $j=0;    $k=0;    $z=0;   $q=0;
   
	for($fc=0;$fc<$firstcount;$fc++)
    {
        $query = $row[$fc]["Query"];
		 $FBidder_Name = $row[$fc]["Bidder_Name"];
        $table = $row[$fc]["Table_Name"];
		$City = $row[$fc]["City"];
      		
		        //$Bidderid = $row[$fc]["BidderID"];
		//echo "<br>"; 	
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////		
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
			$ValidBidder_Day = 1;
		}
		else
		{
			$ValidBidder_Day = 0;
		}
		//End Check for Day Cap Lead
		//Start Check for Week Cap Lead
		if(($CapWeek!=0 && $CapWeek!='' && $Total4Week<$CapWeek) || $CapWeek==0  || $CapWeek=="NULL")
		{
			$ValidBidder_Week = 1;
		}
		else
		{
			$ValidBidder_Week = 0;
		}
		//End Check for Week Cap Lead
		//Start Check for Month Cap Lead
		if(($CapMonth!=0 && $CapMonth!='' && $Total4Month<$CapMonth) || $CapMonth==0  || $CapMonth=="NULL")
		{
			$ValidBidder_Month = 1;
		}
		else
		{
			$ValidBidder_Month = 0;
		}
		//End Check for Month Cap Lead
		//Start Check for LifeTime Cap Lead
		if(($CapLifeTime!=0 && $CapLifeTime!='' && $Total4LifeTime<$CapLifeTime) || $CapLifeTime==0  || $CapLifeTime=="NULL")
		{
			$ValidBidder_LT = 1;
		}
		else
		{
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
      $City = trim($row[$fc]["citywise"]);
		$oldcity = explode(",", $City);
		$newcity = implode ("','",$oldcity) ;
		$propercity="('".$newcity."')";
			
		$querynw = str_replace("Req_Loan_Personal", "saveemicalc_tbl_pl", $query);
		$querynw = str_replace("RequestID", "saveemiidpl", $querynw);
		
		$qry2 = $querynw." and (City in ".$propercity." or City_Other in ".$propercity." ) and saveemicalc_tbl_pl.saveemiidpl ='".$RequestID."'";
   
         list($recordcount,$result1)=MainselectfuncNew($qry2,$array = array());
	 
        if($recordcount>0 && $Bidderid!="Not Valid") //(result1)
		{
			$bankid[] = $BankID;
			$BidderID[] = $Bidderid;
			$BidderName[] = $Bidder_Name;			
		}
		}
		
	for($j=0;$j<count($bankid);$j++)
	{
		$getbankid="select * from Bank_Master where BankID=".$bankid[$j];
		 list($rowcount,$row)=MainselectfuncNew($getbankid,$array = array());
		
		for($jj=0;$jj<$rowcount;$jj++)
		{
			$getbankid =$row[$jj]['Bank_Name'];
			$getbankarr[]=$getbankid;
		}
	}	
	
	$getbidderID=@array_unique($getbankarr);
	$bidder[]= @array_unique($bankid);
	$bidder[] = @array_unique($getbidderID);
	$bidder[] = @array_unique($BidderID);
	$bidder[] = @array_unique($BidderName);	
return($bidder);
	}
      
function getBiddersList_hl($strProduct,$strRequestID,$strCity,$getBankID)
{   
    $RequestID = $strRequestID;
	$mvarCity = $strCity;
	$mvarType = 2;
	if($getBankID>0)
	{
   	 $qry ="SELECT *,Bidders_List.City AS citywise FROM Bidders_List LEFT OUTER JOIN Bidders ON Bidders.BidderID=Bidders_List.BidderID  WHERE (Bidders_List.Reply_Type='".$mvarType."' and Bidders_List.City LIKE  '%".$mvarCity."%' and  Bidders_List.Restrict_Bidder=1 AND Bidders.Define_PrePost='PostPaid' and Bidders_List.BankID not in (".$getBankID.") ) order by `bankwise_priority` ASC";
	}
	else
	{
		$qry = "SELECT *,Bidders_List.City AS citywise FROM Bidders_List LEFT OUTER JOIN Bidders ON Bidders.BidderID=Bidders_List.BidderID  WHERE (Bidders_List.Reply_Type='".$mvarType."' and Bidders_List.City LIKE  '%".$mvarCity."%' and  Bidders_List.Restrict_Bidder=1 AND Bidders.Define_PrePost='PostPaid' ) order by `bankwise_priority` ASC";
	}
	list($firstcount,$row)=MainselectfuncNew($qry,$array = array());
	$i=0;    $j=0;    $k=0;    $z=0;   $q=0;
   
	for($fc=0;$fc<$firstcount;$fc++)
    {
        $query = $row[$fc]["Query"];
		 $FBidder_Name = $row[$fc]["Bidder_Name"];
        $table = $row[$fc]["Table_Name"];
		$City = $row[$fc]["City"];
      		
		        //$Bidderid = $row[$fc]["BidderID"];
		//echo "<br>"; 	
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////		
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
			$ValidBidder_Day = 1;
		}
		else
		{
			$ValidBidder_Day = 0;
		}
		//End Check for Day Cap Lead
		//Start Check for Week Cap Lead
		if(($CapWeek!=0 && $CapWeek!='' && $Total4Week<$CapWeek) || $CapWeek==0  || $CapWeek=="NULL")
		{
			$ValidBidder_Week = 1;
		}
		else
		{
			$ValidBidder_Week = 0;
		}
		//End Check for Week Cap Lead
		//Start Check for Month Cap Lead
		if(($CapMonth!=0 && $CapMonth!='' && $Total4Month<$CapMonth) || $CapMonth==0  || $CapMonth=="NULL")
		{
			$ValidBidder_Month = 1;
		}
		else
		{
			$ValidBidder_Month = 0;
		}
		//End Check for Month Cap Lead
		//Start Check for LifeTime Cap Lead
		if(($CapLifeTime!=0 && $CapLifeTime!='' && $Total4LifeTime<$CapLifeTime) || $CapLifeTime==0  || $CapLifeTime=="NULL")
		{
			$ValidBidder_LT = 1;
		}
		else
		{
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
      $City = trim($row[$fc]["citywise"]);
		$oldcity = explode(",", $City);
		$newcity = implode ("','",$oldcity) ;
		$propercity="('".$newcity."')";
			
		$querynw = str_replace("Req_Loan_Home", "saveemicalc_tbl_hl", $query);
		$querynw = str_replace("RequestID", "saveemiidhl", $querynw);
		
	 $qry2 = $querynw." and (City in ".$propercity." or City_Other in ".$propercity." ) and saveemicalc_tbl_hl.saveemiidhl ='".$RequestID."'";
   
       list($recordcount,$result1)=MainselectfuncNew($qry2,$array = array());
	 
        if($recordcount>0 && $Bidderid!="Not Valid") //(result1)
		{			
			$bankid[] = $BankID;
			$BidderID[] = $Bidderid;
			$BidderName[] = $Bidder_Name;			
		}
		}
		
	for($j=0;$j<count($bankid);$j++)
	{
		$getbankid="select * from Bank_Master where BankID=".$bankid[$j];
	 list($rowcount,$row)=MainselectfuncNew($getbankid,$array = array());
		
		for($jj=0;$jj<$rowcount;$jj++)
		{
			$getbankid =$row[$jj]['Bank_Name'];
			$getbankarr[]=$getbankid;
		}
	}	
	
	$getbidderID=@array_unique($getbankarr);
	$bidder[]= @array_unique($bankid);
	$bidder[] = @array_unique($getbidderID);
	$bidder[] = @array_unique($BidderID);
	$bidder[] = @array_unique($BidderName);	
return($bidder);
	}
		   ?>