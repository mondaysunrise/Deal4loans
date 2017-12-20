<?php
    require 'scripts/db_init.php';
	require 'scripts/functions.php';

$get_residence_stat = $_REQUEST["get_residence_stat"];
$get_current_exp = $_REQUEST["get_current_exp"];
$get_total_exp = $_REQUEST["get_total_exp"]; 
$get_loanany = $_REQUEST["get_loanany"];
$get_id = $_REQUEST["get_id"]; 
$get_bankid = $_REQUEST["get_bankid"];
$leadid = $_REQUEST["leadid"];
$emi_paid = $_REQUEST["emi_paid"];
$city = $_REQUEST["city"];
//$city="Delhi";
if($get_bankid!='All')
{
$get_bankid = substr(trim($get_bankid), 0, strlen(trim($get_bankid))-1);
}

if($leadid>0)
{
	 	$DataArray = array("Residential_Status"=>$get_residence_stat, "Years_In_Company"=>$get_current_exp, "Total_Experience"=>$get_total_exp, "EMI_Paid"=>$emi_paid);
		$wherecondition ="RequestID=".$leadid;
		Mainupdatefunc('Req_Loan_Personal', $DataArray, $wherecondition);
	   $RequestID = $strRequestID;
		$mvarCity = $city;
		$mvarType = 1;
   
   if($get_bankid=="All")
	{
	   $qry = "SELECT * FROM Bidders_List WHERE Reply_Type=1 and City LIKE '%".$mvarCity."%' and  Restrict_Bidder=1";
	}
	else
	{
		$qry = "SELECT * FROM Bidders_List WHERE (Reply_Type=1 and City LIKE '%".$mvarCity."%' and  Restrict_Bidder=1 and BankID in (".$get_bankid."))";
	}
	//}
     list($firstcount,$row)=MainselectfuncNew($qry,$array = array());
		$m=0;
	
    $i=0;
    $j=0;
    $k=0;
    $z=0;   
    $q=0;

//$typeproduct = getproducttypefrmcode($mvarType);
   while($m<count($row))
        {
        $query = $row[$m]["Query"];
		 $FBidder_Name = $row[$m]["Bidder_Name"];
        $table = $row[$m]["Table_Name"];
		$City = $row[$m]["City"];
		$BankID = $row[$m]["BankID"];
      		
		        //$Bidderid = $row["BidderID"];
		//echo "<br>"; 	
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////		
		//Start For Cap Function
		$TodayYear = date('Y');
		$TodayMonth = date('m');
		$TodayWeek = date('W');
		$TodayDay = date('d');
		$Cap_MinDate = $row[$m]["Cap_MinDate"];
	
		$CapLead_Count = $row[$m]["CapLead_Count"];
		$FBidderID = $row[$m]["BidderID"];	
	
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
       
      $City = trim($row[$m]["City"]);
		$oldcity = explode(",", $City);
		$newcity = implode ("','",$oldcity) ;
		$propercity="('".$newcity."')";
			
		$qry2 = $query." and (City in ".$propercity." or City_Other in ".$propercity." ) and Req_Loan_Personal.RequestID ='".$leadid."'";
          	 list($recordcount,$result1)=MainselectfuncNew($qry2,$array = array());
        	if($recordcount>0 && $Bidderid!="Not Valid") //(result1)
		{
			
			$bankid[] = $BankID;
			$BidderID[] = $Bidderid;
			 $BidderName[] = $Bidder_Name;
			
		}
		$m = $m +1;}
	
	
	$bidder= @array_unique($bankid);
	//print_r($bidder);
$Final_Bid = "";
		while (list ($key,$val) = @each($bidder)) { 
			$Final_Bid[]= $val; 
		}

		if(count($Final_Bid)>0 && ($Final_Bid[1]!=0 || $Final_Bid[1]!=''))
	{?>
<div style="font-family:verdana; font-size:12px;">You are eligible in following Banks .To get Online Quote and receive more information on call click on get quote.<br>
If you are not interested in any of the Banks , please unselect the Bank.
</div>
	<table>

	<tr >
		<?

		for($i=0;$i<count($Final_Bid);$i++)
		{ //echo $bidder[$i]."<br>"; 

				$getbankid="select Bank_Name from Bank_Master where BankID=".$Final_Bid[$i];
				
		//echo $getbankid;
		list($recordcount,$row)=MainselectfuncNew($getbankid,$array = array());
		$cnr=0;
		

		if(strlen($row[$cnr]["Bank_Name"])>0)
			{?>
<td class="bldtxt"><input type="checkbox" name="chkbnkID[]" value="<?php echo $Final_Bid[$i]; ?>" onClick="return validate();" checked/></td><td class="frmbldtxt" class="bldtxt"><? echo $row[$cnr]["Bank_Name"];
		?>&nbsp;</td>
		<?
		if($i==2 || $i==6 || $i==10 || $i==14 || $i==18)
		{
			
		?>
		</tr><tr>
		<?php
		}
			}
		 }
		 ?>
		
			</table>
			<?
	}

}
	?>
