<?php

function getproducttypefrmcode($pKey){
	$titles = array(
		'Req_Loan_Personal' => '1',
		'Req_Loan_Home' => '2',
		'Req_Loan_Car' => '3',
		'Req_Credit_Card' => '4',
		'Req_Loan_Against_Property' => '5',
		'Req_Business_Loan' => '6',
	);

	foreach ($titles as $key=>$value)
	    if($pKey==$key)
		return $value;

	return "";
   }


function getBiddersList($strProduct,$strRequestID,$strCity)
{   
//$strProduct="Req_Loan_Personal";
//$strRequestID= 416844;
//$strCity='Mumbai';
    $RequestID = $strRequestID;
	$mvarCity = $strCity;
	$mvarType = getproducttypefrmcode($strProduct);
   // $mvarType = getCodeValue("ReplyType_$strProduct");
   $qry = "SELECT *,Bidders_List.City as cty FROM Bidders_List LEFT OUTER JOIN Bidders ON Bidders.BidderID=Bidders_List.BidderID WHERE (Bidders_List.Reply_Type=1 and Bidders_List.City LIKE '%".$mvarCity."%' and  Bidders_List.Restrict_Bidder=1 and (Bidders.Define_PrePost= 'PostPaid' or Bidders.Define_PrePost='') and Bidders_List.BidderID not in (1197,1198))";
	
 list($firstcount,$row)=MainselectfuncNew($qry,$array = array());
		$cntr=0;

    $i=0;
    $j=0;
    $k=0;
    $z=0;   
    $q=0;

//$typeproduct = getproducttypefrmcode($mvarType);
    while($cntr<count($row))
        {
        $query = $row[$cntr]["Query"];
		 $FBidder_Name = $row[$cntr]["Bidder_Name"];
        $table = $row[$cntr]["Table_Name"];
		$City = $row[$cntr]["cty"];
		$BankID = $row[$cntr]["BankID"];
      		
		        //$Bidderid = $row[$cntr]["BidderID"];
		//echo "<br>"; 	
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////		
		//Start For Cap Function
		$TodayYear = date('Y');
		$TodayMonth = date('m');
		$TodayWeek = date('W');
		$TodayDay = date('d');
	$Cap_MinDate = $row[$cntr]["Cap_MinDate"];
	
	$CapLead_Count = $row[$cntr]["CapLead_Count"];
	$FBidderID = $row[$cntr]["BidderID"];	
	
	
	$ExplodeCapLead = explode(",", $CapLead_Count);
	$CapDay = $ExplodeCapLead[0];
	$CapWeek = $ExplodeCapLead[1];
	$CapMonth = $ExplodeCapLead[2];
	$CapLifeTime = $ExplodeCapLead[3];
	$TodayDate = date("Y-m-d");

	 $CheckDateSql = "select sum(BookLeadCount) as SumDay from Bidders_Book_Keeping where BidderID = ".$FBidderID." and BookDate = ".$TodayDay." and BookProduct='".$mvarType."'  and  BookMonth = ".$TodayMonth." and  BookYear= ".$TodayYear." ";

	list($recordcount,$row_result_D)=MainselectfuncNew($CheckDateSql,$array = array());
	$d=0;
	
	$DayCount = $row_result_D[$d]['SumDay'];
	
	$CheckWeekSql = "select sum(BookLeadCount) as SumWeek from Bidders_Book_Keeping where BidderID = ".$FBidderID." and BookWeek = ".$TodayWeek." and BookProduct='".$mvarType."' and  BookYear= ".$TodayYear." ";
	list($recordcount,$row_result_W)=MainselectfuncNew($CheckWeekSql,$array = array());
	$w=0;
	
	
	$Total4Week = $row_result_W[$w]['SumWeek'];
	
	
	$CheckMonthSql = "select sum(BookLeadCount) as SumMonth from Bidders_Book_Keeping where BidderID = ".$FBidderID." and BookMonth = ".$TodayMonth." and BookProduct='".$mvarType."' and  BookYear= ".$TodayYear." ";
	list($recordcount,$row_result_M)=MainselectfuncNew($CheckMonthSql,$array = array());
	$m=0;
	$Total4Month = $row_result_M[$m]['SumMonth'];
	
	$CheckLifeTimeSql = "select sum(BookLeadCount) as SumLifeTime from Bidders_Book_Keeping where BidderID = ".$FBidderID." and BookProduct='".$mvarType."'";
	
	list($recordcount,$row_result_LT)=MainselectfuncNew($CheckLifeTimeSql,$array = array());
	$lt=0;
	$Total4LifeTime = $row_result_LT[$lt]['SumLifeTime'];

	
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
		
		
		
			//echo "<br>";
		if($ValidBidder_Day==1 && $ValidBidder_Week==1 && $ValidBidder_Month==1 && $ValidBidder_LT==1)
		{
			$Bidderid = $FBidderID;
			$Bidder_Name = $FBidder_Name;
		}
		else 
			 $Bidderid = "Not Valid";
			
			
			//print_r($Bidderid);
			
		//End For Cap Function
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
       
      $City = trim($row[$cntr]["cty"]);
		$oldcity = explode(",", $City);
		$newcity = implode ("','",$oldcity) ;
		$propercity="('".$newcity."')";
			
		$qry2 = $query." and (City in ".$propercity." or City_Other in ".$propercity." )and ".$strProduct.".RequestID ='".$RequestID."'";
      
       	 list($recordcount,$result1)=MainselectfuncNew($qry2,$array = array());
        	if($recordcount>0 && $Bidderid!="Not Valid") //(result1)
		{
			$bankid[] = $BankID;
			$BidderID[] = $Bidderid;
			 $BidderName[] = $Bidder_Name;
			
		}
	  $cntr=$cntr+1;
	  	}
		
		for($j=0;$j<count($bankid);$j++)
	{
		$getbankid="select * from Bank_Master where BankID=".$bankid[$j];
		 list($recordcount1,$row)=MainselectfuncNew($getbankid,$array = array());
for($ii=0;$ii<$recordcount1;$ii++)
	{
			$getbankid =$row[$ii]['Bank_Name'];
			$getbankarr[]=$getbankid;
		
		}
	}
	
	
	$bnkid= @array_unique($bankid);
	$Final_Bid = "";
		while (list ($key,$val) = @each($bnkid)) { 
			$Final_Bid[]= $val; 
		}
	
	$bidder[]= $Final_Bid;
	$bidder[]= $BidderID;

		
return($bidder);

	}
	?>
