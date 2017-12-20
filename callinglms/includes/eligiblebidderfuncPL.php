<?php
class eligiblebidderfuncPL{
	var $dbObj;
	
	function eligiblebidderfuncPL(){ // class constructor
		$this->dbObj = new DB();
		$this->dbObj->fun_db_connect();
	}
	
function getBiddersList($strProduct,$strRequestID,$strCity,$strreferral,$strsource)
{   
    $RequestID = $strRequestID;
	$mvarCity = $strCity;
	$mvarType = 1;
		/*if($strsource=="ntwkply" || $strsource=="interactive" || $strsource=="clawdigital" || $strsource=="Adwinks" || ((strncmp("Adwinks", $strsource,7))==0) || $strsource=="Cloverads" || $strsource=="Clovenetwork" || ((strncmp("Cloverads", $strsource,9))==0) || ((strncmp("Clovenetwork", $strsource,12))==0) || ((strncmp("clawdigital", $strsource,11))==0))*/
	if(strlen($mvarCity)>0)
	{
	if($strreferral==1)
	{
	 $qry = "SELECT * FROM Bidders_List WHERE (Reply_Type='".$mvarType."' and City LIKE '%".$mvarCity."%' and  Restrict_Bidder=1 and Referral_Flag=1 and BankID!=66)";
	}
	else if($strreferral==2)
	{
	
	 $qry = "SELECT * FROM Bidders_List WHERE (Reply_Type='".$mvarType."' and City LIKE '%".$mvarCity."%' and  Restrict_Bidder=1 and  bidder_postpaid=1)";
	}
	else
	{
		$qry = "SELECT * FROM Bidders_List WHERE (Reply_Type='".$mvarType."' and City LIKE '%".$mvarCity."%' and  Restrict_Bidder=1 and BankID!=66) order by Bidder_Name ASC";
	}
	//}
	
   $result = $this->dbObj->fun_db_query($qry);
    $firstcount = $this->dbObj->fun_db_get_num_rows($result);
    //echo "<br>Query I::".$qry."<br>";
    $i=0;
    $j=0;
    $k=0;
    $z=0;   
    $q=0;
   
    while ($row = $this->dbObj->fun_db_fetch_rs_object($result))
    {
		//print_r($row);
        $query = $row->Query;
		 $FBidder_Name = $row->Bidder_Name;
        $table = $row->Table_Name;
		$City = trim($row->City);
      
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////		
		//Start For Cap Function
		$TodayYear = date('Y');
		$TodayMonth = date('m');
		$TodayWeek = date('W');
		$TodayDay = date('d');
	$Cap_MinDate = $row->Cap_MinDate;
	
	$CapLead_Count = $row->CapLead_Count;
	$FBidderID = $row->BidderID;	
	
	$ExplodeCapLead = explode(",", $CapLead_Count);
	$CapDay = $ExplodeCapLead[0];
	$CapWeek = $ExplodeCapLead[1];
	$CapMonth = $ExplodeCapLead[2];
	$CapLifeTime = $ExplodeCapLead[3];
	$TodayDate = date("Y-m-d");

	 $CheckDateSql = "select sum(BookLeadCount) as SumDay from Bidders_Book_Keeping where BidderID = ".$FBidderID." and BookDate = ".$TodayDay." and BookProduct='".$mvarType."'  and  BookMonth = ".$TodayMonth." and  BookYear= ".$TodayYear." ";
	$CheckDateQuery = $this->dbObj->fun_db_query($CheckDateSql);
	$row_result_D=$this->dbObj->fun_db_fetch_rs_object($CheckDateQuery);
	$DayCount = $row_result_D->SumDay;
	
	$CheckWeekSql = "select sum(BookLeadCount) as SumWeek from Bidders_Book_Keeping where BidderID = ".$FBidderID." and BookWeek = ".$TodayWeek." and BookProduct='".$mvarType."' and  BookYear= ".$TodayYear." ";
	$CheckWeekQuery = $this->dbObj->fun_db_query($CheckWeekSql);
	$row_result_W=$this->dbObj->fun_db_fetch_rs_object($CheckWeekQuery);
	$Total4Week = $row_result_W->SumWeek;
	
	
	$CheckMonthSql = "select sum(BookLeadCount) as SumMonth from Bidders_Book_Keeping where BidderID = ".$FBidderID." and BookMonth = ".$TodayMonth." and BookProduct='".$mvarType."' and  BookYear= ".$TodayYear." ";
	$CheckMonthQuery = $this->dbObj->fun_db_query($CheckMonthSql);
	$row_result_M=$this->dbObj->fun_db_fetch_rs_object($CheckMonthQuery);
	$Total4Month = $row_result_M->SumMonth;
	
	//$CheckLifeTimeSql = "select sum(BookLeadCount) as SumLifeTime from Bidders_Book_Keeping where BidderID = ".$FBidderID." and BookProduct='".$mvarType."' and BookEntryTime > '".$Cap_MinDate."'";
	//Changed on 27-02-08 as per discussion with wribhu sir
	$CheckLifeTimeSql = "select sum(BookLeadCount) as SumLifeTime from Bidders_Book_Keeping where BidderID = ".$FBidderID." and BookProduct='".$mvarType."'";
	
	$CheckLifeTimeQuery = $this->dbObj->fun_db_query($CheckLifeTimeSql);
	$row_result_LT=$this->dbObj->fun_db_fetch_rs_object($CheckLifeTimeQuery);
	$Total4LifeTime = $row_result_LT->SumLifeTime;
	
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
       
      $City = $row->City;
		//echo $City."<br>";
		$oldcity = explode(",", $City);
		$newcity = implode ("','",$oldcity) ;
			//echo $newcity."<br>";
			$propercity="('".$newcity."')";
			
		$qry2 = $query." and (City in ".$propercity." or City_Other in ".$propercity." ) and Req_Loan_Personal.RequestID ='".$RequestID."'";
        //$qry2 = $query." and ".$table.".RequestID ='".$RequestID."'";
     // echo "ff".$qry2;
        $result1=$this->dbObj->fun_db_query($qry2);
        $recordcount = $this->dbObj->fun_db_get_num_rows($result1);
        	if($recordcount>0 && $Bidderid!="Not Valid") //(result1)
		{
			
			$BidderID[] = $Bidderid;
			 $BidderName[] = $Bidder_Name;
			
		}
		}
	$bidder[] = $BidderID;
	$bidder[] = $BidderName;
return($bidder);

	}
}
           
	}	   ?>