<?php
ini_set('max_execution_time', 600);
//require("scripts/db_main.php");
//require 'scripts/db_init.php';
//require 'scripts/db_init-rnew.php';
//require 'scripts/functions.php';
define("_TOTAL", 4);


/***********************************************
This function makes a Global ID which helps to 
update the Log Entries once it get inserted for 
specific lead for all products
***********************************************/
//function makeGlobalLogID Start
function makeGlobalLogID($LogID)
{
	$GLOBALS['LogID'] = $LogID;
}
//function makeGlobalLogID End

/***********************************************
This function is used to delete the blank entries
from the array !!!!
***********************************************/
//function filter_blank Start
function filter_blank($var) 
{
        return !(empty($var) || is_null($var));
}
//function filter_blank End

/***********************************************
This function is used to get the name of the 
database table when we provide Product Code
***********************************************/
//function getTableName Start
function getTableName($pKey)
{
    $titles = array(
        1=> 'Req_Loan_Personal',
        2=> 'Req_Loan_Home',
        3=> 'Req_Loan_Car',
        4=> 'Req_Credit_Card',
        5=> 'Req_Loan_Against_Property',
        6=> 'Req_Business_Loan'
    );
    foreach ($titles as $key=>$value)
        if($pKey==$key)
        return $value;

    return "";
}
//function getTableName End
//
function getforsms($pKey){
    $titles = array(
        'Req_Loan_Personal' => 'pl',
        'Req_Loan_Home' => 'hl',
        'Req_Loan_Car' => 'cl',
        'Req_Credit_Card' => 'cc',
        'Req_Loan_Against_Property' => 'lap',
        'Req_Business_Loan' => 'bl'
    );
    foreach ($titles as $key=>$value)
        if($pKey==$key)
        return $value;

    return "";
  }
//
//function for email
function getforemailer($pKey){
    $titles = array(
        '1' => 'Personal Loan',
        '2' => 'Home Loan',
        '3' => 'Car Loan',
        '4' => 'Credit Card',
        '5' => 'Loan Against Property',
        '6' => 'Business Loan'
    );
    foreach ($titles as $key=>$value)
        if($pKey==$key)
        return $value;

    return "";
  }
//

/***********************************************
Function for Personal Loan to fetch the data from 
Req_Loan_Personal table. Get all records from 
Personal Loan Product Table with condition Allocation
field is null or zero and Dated between from zero 
hours of the day till current time 
************************************************/

//function getRequestidpl Start
/*function getRequestidpl()
{
	 
 $getpldata="Select RequestID,Bidderid_Details,City,City_Other, Net_Salary, Loan_Amount, DOB, Is_Valid, Employment_Status from Req_Loan_Personal where (Allocated =2  and ( Dated >=DATE_SUB(CURDATE(),INTERVAL 1 DAY)))";
 
    $getplresult = ExecQuery($getpldata);
  	$FieldValue ="";

	 echo "<br>";
	 echo $getpldata;
	 echo "<br>";
 
    while($row = mysql_fetch_array($getplresult))
    {
        $Customerid= $row["RequestID"];
        $telecalled_bidderid= $row["Bidderid_Details"];
		$Employment_Status = $row["Employment_Status"];

		$Net_Salary= round($row["Net_Salary"]);
		$DOB= $row["DOB"];
		if(strlen($DOB)>0)
		{
			$DOB = str_replace("-","", $DOB);
			$DOB = DetermineAgeFromDOB($DOB);
		}
		else
		{
			$DOB = "Not Entered";
		}
		
		$Loan_Amount= round($row["Loan_Amount"]);
		$Is_Valid= round($row["Is_Valid"]);
		
               $FieldValue = $DOB. ", ".$Loan_Amount.", ".$Net_Salary.", ".$Is_Valid.",".$Employment_Status;
		if($row["City"]=="Others")
        {
            $City= $row["City_Other"];
        }
        else
        {
            $City= $row["City"];
        }
		
		echo  "<br><br>*********************************************************************<br>";
		echo "City : ".$City;
		echo "//////Customerid : ".$Customerid;
		echo "//////Product : Personal Loan";
		echo  "<br>";
		
		$ProductID = 1;
		
		insertLogDataBiddersList($LogID, $Customerid, $City, $ProductID, $FieldName, $FieldValue);
		
		
		getEligibleBiddersList("1",$Customerid,$City,$telecalled_bidderid); 
		
		echo  "<br>***************************************************************************<br><br>";
		      
    }
}*/
//function getRequestidpl End
/********************************************************************
This function is the main function into which we call all the function 
into which we provide a set of bidders in the called function and get 
the output set of bidders 
********************************************************************/
//function getEligibleBiddersList Start
function getEligibleBiddersList($strProduct,$strRequestID,$strCity,$strritebidder)
{   
    $telecalled_bidderid=$strritebidder;
    $requestID = $strRequestID;
    $Customer_City = $strCity;
    $product_code = $strProduct;
	///////For Calling/////////
	if(strlen($telecalled_bidderid)>0)
	{
		$eligible_bidder_set = "SELECT * FROM Bidders_List WHERE (BidderID in (".$telecalled_bidderid.") and Reply_Type='".$product_code."' and  Restrict_Bidder=1)";
	}
	else
	{
 	   $eligible_bidder_set = "SELECT * FROM Bidders_List WHERE ( Reply_Type='".$product_code."' and City LIKE '%".$Customer_City."%' and  Restrict_Bidder=1)";
	}
   
    $eligible_bidder_set_result = ExecQuery($eligible_bidder_set);
	
    $eligible_bidder_set_count = mysql_num_rows($eligible_bidder_set_result);

	if($eligible_bidder_set_count>0)
	{	
		$z = 0;  
		$allBiddersSet = array(); 
	    $Bidders_Always = array();
		$Bidders_Conflicting = array();
		$Bidders_NonConflicting = array();
		
	  	for($i=0;$i<$eligible_bidder_set_count;$i++)
		{
			$bidderid = mysql_result($eligible_bidder_set_result, $i, "BidderID");
			$bidder_query = mysql_result($eligible_bidder_set_result, $i, "Query");
			$bidder_table = mysql_result($eligible_bidder_set_result, $i, "Table_Name");
			$Cap_MinDate = mysql_result($eligible_bidder_set_result, $i, "Cap_MinDate");
			$CapLead_Count = mysql_result($eligible_bidder_set_result, $i, "CapLead_Count");
			$always = mysql_result($eligible_bidder_set_result, $i, "Always");
			$conflict = mysql_result($eligible_bidder_set_result, $i, "Conflict_bidder");
			$last_selection = mysql_result($eligible_bidder_set_result, $i, "Last_set_select");
			$last_allocation = mysql_result($eligible_bidder_set_result, $i, "Last_allocation");
		
			$FirstList[] = $bidderid;
	
			//echo "<br>///////".$bidderid."//////////Alway".$always."s/////////////////////////<br>";
			$final_query = $bidder_query." and ".$bidder_table.".RequestID ='".$requestID."'";
			
			$eligible_bidder_cap = getBidderCapEligibility($bidderid, $CapLead_Count, $product_code );

			
			//echo "<br>Eligible : ".$eligible_biddercap = $eligible_bidder_cap; echo "<br>";
			//$eligibleSet = manipulateBiddersList($eligible_bidder_cap, $final_query, $always, $conflict);
			$allBiddersSet[] = $eligible_bidder_cap;
			
			$Bidders_Always[] = BiddersAlways($eligible_bidder_cap, $final_query, $always, $conflict);
			
			$Bidders_AlwaysConflicting[] = BiddersAlwaysConflicting($eligible_bidder_cap, $final_query, $always, $conflict);
			
			$Bidders_Conflicting[] = BiddersConflicting($eligible_bidder_cap, $final_query, $always, $conflict);
			//echo "<br>Conflict bcvxv: ".$Bidders_Conflicting; print_r($Bidders_Conflicting);

			//main work in this function
		
			$Bidders_NonConflicting[] = BiddersNonConflicting($eligible_bidder_cap, $final_query, $conflict, $always);
			//$getBiddersNature($eligible_bidder_cap);
		}

		$Logid = $GLOBALS['LogID'];
		
		$FieldName = "TotalBidders";
		$FieldValue = implode(",", $FirstList);
		insertLogDataBiddersList($Logid, $Customerid, $City, $ProductID, $FieldName, $FieldValue);
			 
		$FieldName = "EligibleBidders";
		$FieldValue = implode(",", $allBiddersSet);
		insertLogDataBiddersList($Logid, $Customerid, $City, $ProductID, $FieldName, $FieldValue);
				
		$allBiddersSetFilter = array_filter($allBiddersSet, "filter_blank"); 
		$allBiddersSet_String = implode(",", $allBiddersSetFilter);
	
		$BidderAlways = array_filter($Bidders_Always, "filter_blank");
		$Str_Bidders_Always = implode(",", $BidderAlways);
		//print_r($Str_Bidders_Always);
		$FieldName = "AlwaysBidders";
		$FieldValue = $Str_Bidders_Always;
		insertLogDataBiddersList($Logid, $Customerid, $City, $ProductID, $FieldName, $FieldValue);
		
		
		$BidderAlwaysConflict = array_filter($Bidders_AlwaysConflicting, "filter_blank");
		$Str_BidderAlwaysConflict = implode(";", $BidderAlwaysConflict);
		
		$FieldName = "AlwaysConflictBidders";
		$FieldValue = $Str_BidderAlwaysConflict;
		insertLogDataBiddersList($Logid, $Customerid, $City, $ProductID, $FieldName, $FieldValue);
		
		$AlwaysConflictBiddersSet = RetrieveConflictingBidders($Str_BidderAlwaysConflict, $allBiddersSet_String, $product_code);
			
		$BiddersNonConflicting = array_filter($Bidders_NonConflicting, "filter_blank");
		//$BiddersConflicting = array_filter($ExplodeBidders_Conflicting, "filter_blank");
		$Str_BiddersNonConflicting = implode(",",$BiddersNonConflicting );	
		
		$FieldName = "NonConflictingBidders";
		$FieldValue = $Str_BiddersNonConflicting;
		insertLogDataBiddersList($Logid, $Customerid, $City, $ProductID, $FieldName, $FieldValue);
					
		$ExplodeBidders_Conflicting = implode(";", $Bidders_Conflicting);
		$Str_Bidders_Conflicting = explode(";", $ExplodeBidders_Conflicting );
			
		$StrBiddersConflicting = array_filter($Str_Bidders_Conflicting, "filter_blank");
		$FirstStrBiddersConflicting = implode(";",$StrBiddersConflicting );
		
		$FinalArrBiddersConflicting = explode(";", $FirstStrBiddersConflicting );
		
//Filter for Conflicting defined in Always Start

		$ArrBidderAlwaysConflict = explode(";",$Str_BidderAlwaysConflict);//arr2
		
		$Str_BidderAlwaysConflict = implode(",",$ArrBidderAlwaysConflict);
		$Arr_BidderAlwaysConflict = explode(",",$Str_BidderAlwaysConflict);//arr2

	
		for($i=0;$i<count($Arr_BidderAlwaysConflict);$i++)
		{	
				for($k=0;$k<count($FinalArrBiddersConflicting);$k++)
				{
					$FinalStrBiddersConflictingArr = explode(",",$FinalArrBiddersConflicting[$k]);
					if(in_array($Arr_BidderAlwaysConflict[$i],$FinalStrBiddersConflictingArr))
					{
						 $FinalArrBiddersConflicting[$k] = "*";
						 //break;
					}
				}
		}
		$l=-1;
		for($i=0;$i<count($FinalArrBiddersConflicting);$i++)
		{
			if($FinalArrBiddersConflicting[$i]!="*")
			{
				$l++;
				$arrayNew[$l] = $FinalArrBiddersConflicting[$i];
				
			}
		}
		//Filter for Conflicting defined in Always End
		//$FinalStrBiddersConflicting = $arrayNew;
		$FinalStrBiddersConflicting = @implode(";",$arrayNew );		
		$FieldName = "ConflictingBiddersFirstSet";
		$FieldValue = $FinalStrBiddersConflicting;
		insertLogDataBiddersList($Logid, $Customerid, $City, $ProductID, $FieldName, $FieldValue);
		
		//echo "<br>FinalStrBiddersConflicting : ".$FinalStrBiddersConflicting."<br>";
		if(strlen($FinalStrBiddersConflicting)>0)
		{
			$ConFilictBiddersSet = RetrieveConflictingBidders($FinalStrBiddersConflicting, $allBiddersSet_String, $product_code);
			
			$FieldName = "ConflictingBiddersFinalSet";
			$FieldValue = $ConFilictBiddersSet;
			insertLogDataBiddersList($Logid, $Customerid, $City, $ProductID, $FieldName, $FieldValue);
		}		
		/*echo "<br>";	
		echo "////////////////////////////////////";
		echo "<br>Str_Bidders_Always : ".$Str_Bidders_Always;
		echo "<br>Final Conflicting Set : ".$ConFilictBiddersSet;
	//	echo "<br>Str_Bidders_Conflicting : ".$FinalStrBiddersConflicting;
		echo "<br>Str_BiddersNonConflicting : ".$Str_BiddersNonConflicting;
		echo "<br>////////////////////////////////////<br><br>";*/
		
		//$BidderAlways + $ConFilictBiddersSet + $BiddersNonConflicting
		
		
		$AllocationSetDefination = finalBiddersSet($Str_Bidders_Always, $AlwaysConflictBiddersSet, $Str_BiddersNonConflicting, $ConFilictBiddersSet, $product_code);
		
		$FieldName = "BiddersFinalSet";
		$FieldValue = $AllocationSetDefination;
		insertLogDataBiddersList($Logid, $Customerid, $City, $ProductID, $FieldName, $FieldValue);	
		
		$AlwayConflict = array_merge($BidderAlways, $ConFilictBiddersSet);
		$AlwayConflictNonConflict = array_merge($AlwayConflict, $BiddersNonConflicting);
		$AlwayConflictNonConflict_Filtered = array_filter($AlwayConflictNonConflict, "filter_blank");
		$AlwayConflictNonConflict_String = implode(",",$AlwayConflictNonConflict_Filtered);
		
		$LeadAllocation = finalAllocation($AllocationSetDefination, $product_code, $requestID, $AlwayConflictNonConflict_String,$Customer_City);
		
		$BookKeepingEntry = entryBookKeeping($AllocationSetDefination, $product_code);
	}
	else
	{
		$Logid = $GLOBALS['LogID'];

		$FieldName = "NotEligibleCity";
		$FieldValue = "No Bidders from this City";
		insertLogDataBiddersList($Logid, $Customerid, $City, $ProductID, $FieldName, $FieldValue);	
	}
	
	/////////////Will check bidder count//
	
}
//function getEligibleBiddersList End

/********************************************************************
This function filters the bidders wrt cap defined for the specific
Bidders. 
********************************************************************/
//function getBidderCapEligibility Start
function getBidderCapEligibility($Bidderid, $CapLead_Count, $ProductType)
{
	$TodayYear = date('Y');
	$TodayMonth = date('m');
	$TodayWeek = date('W');
	$TodayDay = date('d');
		
	$FBidderID = $Bidderid;	

	$ExplodeCapLead = explode(",", $CapLead_Count);
	$CapDay = $ExplodeCapLead[0];
	$CapWeek = $ExplodeCapLead[1];
	$CapMonth = $ExplodeCapLead[2];
	//echo "////////////Cap LifeTime<br>";
	$CapLifeTime = $ExplodeCapLead[3];
	//echo "////////////////<br>";
	$TodayDate = date("Y-m-d");
	
	if($CapDay==0 && $CapWeek==0 && $CapMonth==0 && $CapLifeTime==0)
	{
		return $Bidderid;
	}
	else
	{
		$CheckDateSql = "select sum(BookLeadCount) as SumDay from Bidders_Book_Keeping where BidderID = ".$FBidderID." and BookDate = ".$TodayDay." and BookProduct='".$ProductType."'  and  BookMonth = ".$TodayMonth." and  BookYear= ".$TodayYear." ";// Query returns the sum of lead count on every day 
		$CheckDateQuery = ExecQuery($CheckDateSql);
		$row_result_D=mysql_fetch_array($CheckDateQuery);
		$DayCount = $row_result_D['SumDay'];
		
			if(($CapDay!=0 && $CapDay!='' && $DayCount<$CapDay) || $CapDay==0 || $CapDay=="NULL")
				$ValidBidder_Day = 1;
			else
				$ValidBidder_Day = 0;
				
		//////////////////WEEK CAP/////////////////////////////////////
	
		$CheckWeekSql = "select sum(BookLeadCount) as SumWeek from Bidders_Book_Keeping where BidderID = ".$FBidderID." and BookWeek = ".$TodayWeek." and BookProduct='".$ProductType."' and  BookYear= ".$TodayYear." ";// Query returns the sum of lead count on every week 
		$CheckWeekQuery = ExecQuery($CheckWeekSql);
		$row_result_W=mysql_fetch_array($CheckWeekQuery);
		$Total4Week = $row_result_W['SumWeek'];
	
			if(($CapWeek!=0 && $CapWeek!='' && $Total4Week<$CapWeek) || $CapWeek==0  || $CapWeek=="NULL")
				$ValidBidder_Week = 1;
			else
				$ValidBidder_Week = 0;
	
		//////////////////MONTH CAP/////////////////////////////////////
		
		$CheckMonthSql = "select sum(BookLeadCount) as SumMonth from Bidders_Book_Keeping where BidderID = ".$FBidderID." and BookMonth = ".$TodayMonth." and BookProduct='".$ProductType."' and  BookYear= ".$TodayYear." ";// Query returns the sum of lead count on every month 
		$CheckMonthQuery = ExecQuery($CheckMonthSql);
		$row_result_M=mysql_fetch_array($CheckMonthQuery);
		$Total4Month = $row_result_M['SumMonth'];
			
			if(($CapMonth!=0 && $CapMonth!='' && $Total4Month<$CapMonth) || $CapMonth==0  || $CapMonth=="NULL")
				$ValidBidder_Month = 1;
			else
				$ValidBidder_Month = 0;
			
		/////////////////////LIFE TIME CAP/////////////
	
		$CheckLifeTimeSql = "select sum(BookLeadCount) as SumLifeTime from Bidders_Book_Keeping where BidderID = ".$FBidderID." and BookProduct='".$ProductType."'";// Query returns the sum of lead count on total
		$CheckLifeTimeQuery = ExecQuery($CheckLifeTimeSql);
		$row_result_LT=mysql_fetch_array($CheckLifeTimeQuery);
		$Total4LifeTime = $row_result_LT['SumLifeTime'];
	
			if(($CapLifeTime!=0 && $CapLifeTime!='' && $Total4LifeTime<$CapLifeTime) || $CapLifeTime==0  || $CapLifeTime=="NULL")
				$ValidBidder_LT = 1;
			else
				$ValidBidder_LT = 0;
			
			//End Check for LifeTime Cap Lead
			if($ValidBidder_Day==1 && $ValidBidder_Week==1 && $ValidBidder_Month==1 && $ValidBidder_LT==1)
				$ValidBidderid = $FBidderID;
		return $ValidBidderid;
	}

}
//function getBidderCapEligibility End

/********************************************************************
 
 
 ********************************************************************/
//function getBiddersNature Start
function getBiddersNature($bidder_cap)
{
	 $get_bidder_type = "SELECT * FROM Bidders_List WHERE BidderID=".$bidder_cap;
	 $get_bidder_type_result = ExecQuery($get_bidder_type);
}
//function getBiddersNature End



/********************************************************************
This function selects the bidders to whom we will always send leads 
********************************************************************/
//function BiddersAlways Start
function BiddersAlways($Bidderid, $Query, $always,$conflict)
{
	//echo "<br>".$Query."<br>";
//	$Query = 
	$result1=ExecQuery($Query);
	$recordcount = mysql_num_rows($result1);
	if($recordcount>0 && $conflict=="") //(result1)
	{
			$allBidders[$z] = $Bidderid;
				$z=$z+1;
		while($row1=mysql_fetch_array($result1))
		{
			$allBidders[$z] = $Bidderid;
			$z=$z+1;
		
			if($always == 1)
			{
				$confirmedBidders[$i]  = $Bidderid; //forms an array for bidders Always ==1
				$i=$i+1;
			}
		}
	}
	
	$confirmedBiddersSet = @implode(",", $confirmedBidders);
	//echo "<br><br>//////confirmedBiddersSet////////////////////".$confirmedBiddersSet."////////////////////<br><br>";
	return $confirmedBiddersSet;
}
//function BiddersAlways End

/********************************************************************
This function selects the bidders which are conflicting and have to
send leads 
********************************************************************/
//function BiddersConflicting Start
function BiddersConflicting($Bidderid, $Query, $always, $conflict)
{
//taking result from main query , which is giving error in extra bidderid
//	echo "Inside BiddersConflicting : ".$Bidderid;
	$ResultConflictingSet=ExecQuery($Query);
	$recordcount = mysql_num_rows($ResultConflictingSet);
	if($recordcount>0) //(result1)
	{
		$conflictarray = array();
		while($ResultConflictingValue=mysql_fetch_array($ResultConflictingSet))
		{
			  $allBidders[$z] = $Bidderid;
			  $z=$z+1;
			 if((strlen(trim($conflict))>0) && ($always!=1) )
			{
				$nonconflicting[$z] =$Bidderid; //forms an array for bidders Always ==1
				$z=$z+1;
				 if(count($conflictarray)>0)
				 {
					$flag=0;
					$l=0;
					while($l<count($conflictarray))
					{
						if(strlen(strpos($conflictarray[$l],$Bidderid)) > 0 )
						{
							$flag=0;
							break;    //break while loop   
						}
						else
						{
							$flag=1;
						}
						$l++;
					}//close while($l<count($conflictarray))
					if($flag==1)
					{
						if($Bidderid > 0)
						{
							$conflictarray[count($conflictarray)]=$Bidderid.",".trim($conflict);
						}
						
					}//close if($flag==1)
				}//close if(count($conflictarray)>0)
				else
				{                       
					$j=0;
					if($Bidderid > 0)
					{	
						$conflictarray[$j]=$Bidderid.",".trim($conflict);
					}
				}
			}//close if(strlen(trim($conflict))>0)
			  
		}

	}

	$conflict_array = @array_unique($conflictarray);
	$allBiddersString = @implode(";", $conflict_array);
	//echo "<br><br>//////////////////////////".$allBiddersString."////////////////////<br><br>";

	return $allBiddersString;
}
//function BiddersConflicting End




//function BiddersConflicting + Always End
function BiddersAlwaysConflicting($Bidderid, $Query, $always, $conflict)
{
//taking result from main query , which is giving error in extra bidderid
//	echo "Inside BiddersConflicting : ".$Bidderid;
	$ResultConflictingSet=ExecQuery($Query);
	$recordcount = mysql_num_rows($ResultConflictingSet);
	if($recordcount>0) //(result1)
	{
		$conflictarray = array();
		while($ResultConflictingValue=mysql_fetch_array($ResultConflictingSet))
		{
			  $allBidders[$z] = $Bidderid;
			  $z=$z+1;
			 if((strlen(trim($conflict))>0) && ($always==1) )
			{
				$nonconflicting[$z] =$Bidderid; //forms an array for bidders Always ==1
				$z=$z+1;
				 if(count($conflictarray)>0)
				 {
					$flag=0;
					$l=0;
					while($l<count($conflictarray))
					{
						if(strlen(strpos($conflictarray[$l],$Bidderid)) > 0 )
						{
							$flag=0;
							break;    //break while loop   
						}
						else
						{
							$flag=1;
						}
						$l++;
					}//close while($l<count($conflictarray))
					if($flag==1)
					{
						if($Bidderid > 0)
						{
							$conflictarray[count($conflictarray)]=$Bidderid.",".trim($conflict);
						}
						
					}//close if($flag==1)
				}//close if(count($conflictarray)>0)
				else
				{                       
					$j=0;
					if($Bidderid > 0)
					{	
						$conflictarray[$j]=$Bidderid.",".trim($conflict);
					}
				}
			}//close if(strlen(trim($conflict))>0)
			  
		}

	}

	$conflict_array = @array_unique($conflictarray);
	$allBiddersString = @implode(";", $conflict_array);
	//echo "<br><br>/////////dfgdfdsdf/////////////////".$allBiddersString."/////////upendra///////////<br><br>";
	return $allBiddersString;
}
//function BiddersConflicting + Always End


/********************************************************************
This function selects the non conflicting and not always bidders to 
whom we will always send leads 
********************************************************************/ 
//function BiddersNonConflicting Start
function BiddersNonConflicting($Bidderid, $Query, $conflict, $always)
{
		//echo "<br>/////////////nonconflictnotalways///////////";
		
		$BiddersNonConflictingResult=ExecQuery($Query);
        
		$recordcount = mysql_num_rows($BiddersNonConflictingResult);
        
		if($recordcount>0) //(result1)
        {
			 $allBidders[$z] = $Bidderid;
             $z=$z+1;
             // echo "eligible bidders::".$allBidders;
            while($row1=mysql_fetch_array($BiddersNonConflictingResult))
            {
				 if((strlen(trim($conflict))<=0) && ($always != 1 )  )
                 {
                  	$nonconflictnotalways[$k]=$Bidderid;
                  	$k=$k+1;
                 }//close else if(strlen(trim($conflict))<=0)
			}
		}
	//print_r(nonconflictnotalways);
	$nonconflictnot_always = @array_unique($nonconflictnotalways);
	$nonconflictnotalwaysSet = @implode(",", $nonconflictnot_always);
	//echo "<br><br>//////////ggfddf////////////////".$nonconflictnotalwaysSet."//////////fggdfdf kumar//////////<br><br>";

	return $nonconflictnotalwaysSet;
}
//function BiddersNonConflicting End



/********************************************************************
This function selects the non conflicting wrt priority for allocation 
This will return only 1 bidder from 1 set.
********************************************************************/ 
//function bidderPriority Start
function bidderPriority($SetBidderID,$Reply_Type)
{
	//echo "<br>//////In function bidderPriority<br>".$SetBidderID."<br>";
	
	$getBidderIDSet = explode(",", $SetBidderID);
	//asort($getBidderIDSet);
	$Priority_Array = array();
	$BidderID_Array = array();
	if(count($getBidderIDSet)>0 && $getBidderIDSet[0])
	{
		for($i=0;$i<count($getBidderIDSet);$i++)
		{
			$SqlSelect = "select Bidder_Priority, BidderID from Bidders_List where BidderID='".$getBidderIDSet[$i]."' and Reply_Type=".$Reply_Type;
			$QuerySelect = ExecQuery($SqlSelect);
			
			$Bidder_Priority = @mysql_result($QuerySelect,0,'Bidder_Priority');
			$BidderID = @mysql_result($QuerySelect,0,'BidderID');
			
			$Priority = str_replace(",", "", $Bidder_Priority );
			$BidderID_Array[] = $BidderID;
			$Priority_Array[] = $Priority;
			
		}
	}

	$countTrue = 0;
	$suffleBidders = "";
	for($j=0;$j<count($Priority_Array);$j++)
	{
		if($Priority_Array[$j]=='111')
		{
			$countTrue = $countTrue + 1;
		}
	}
	
	$countZeroTrue = 0;
	$suffleBidders = "";
	for($j=0;$j<count($Priority_Array);$j++)
	{
		if($Priority_Array[$j]=='000')
		{
			$countZeroTrue = $countZeroTrue + 1;
		}
	}
	
	if($countTrue==count($Priority_Array) || $countTrue > count($Priority_Array))
	{
		$suffleBidders = @array_rand($BidderID_Array,1);
		//echo "<br>Suffle Bidders---------"; print_r($suffleBidders); echo "------------------<br>";
		$finalBidder = $BidderID_Array[$suffleBidders]; 
		//echo "<br>//If ".$finalBidder."<br>";
	}
	else if($countZeroTrue==count($Priority_Array) || $countZeroTrue > count($Priority_Array))
	{
		$suffleBidders = array_rand($BidderID_Array,1);
		//echo "<br>Suffle Bidders---------"; print_r($suffleBidders); echo "------------------<br>";
		$finalBidder = $BidderID_Array[$suffleBidders]; 
		//echo "<br>//If ".$finalBidder."<br>";
	}
	else
	{	
		asort($Priority_Array);
		
		$keys_priority = array_keys($Priority_Array);
		 
		//print_r($keys_priority);
		
		$finalBidder = $BidderID_Array[$keys_priority[0]];
		
	}
	

$finalbidderArr = explode(",",$finalBidder);

$PriorityConflicts = array_diff($BidderID_Array,$finalbidderArr);
$PriorityConflictsStr = implode(",",$PriorityConflicts);
$PriorityConflictsArray = explode(",",$PriorityConflictsStr);

 for($kk=0;$kk<count($PriorityConflictsArray);$kk++)
	{
		
		$sql = "select Bidder_Priority from Bidders_List where BidderID='".$PriorityConflictsArray[$kk]."' and Reply_Type='".$Reply_Type."'";
		$Query = ExecQuery($sql);
		$Bidder_Priority = @mysql_result($Query,0,'Bidder_Priority');
		$Bidder_PriorityArray = @explode(",",$Bidder_Priority); 
				
		$Value3Priority = 0;
		
		$FinalSet = array();
		for($j=1;$j<count($Bidder_PriorityArray);$j++)
		{		
			$position = $j;
			$FinalSet[] = $Bidder_PriorityArray[$position];	
			
		}
		$FinalSet[] = $Value3Priority;
		$FinalSetString = implode(",",$FinalSet);
		if($PriorityConflictsArray[$kk]>0)
		{
			$UpdatePriority = "update Bidders_List set Bidder_Priority='".$FinalSetString."' where  BidderID='".$PriorityConflictsArray[$kk]."' and Reply_Type='".$Reply_Type."'";
			ExecQuery($UpdatePriority);
		}
		
	}

	return $finalBidder;
}
//function bidderPriority End

/********************************************************************
Conflicting Bidders Manipulation set 
In this we get the sets of conflicting bidders and returns a set of
Final Bidders  from the conflicting set
 ********************************************************************/
//function RetrieveConflictingBidders Start
function RetrieveConflictingBidders($BiddersConflicting, $all_Bidders, $ProductType)
{
$Bidders_Conflicting = explode(";", $BiddersConflicting);
$allBidders = explode(",", $all_Bidders);

	$ArrayConflictingBidders = array();
	
	for($z=0;$z<count($Bidders_Conflicting);$z++)
	{                   
		$splitBiddersConflicting = explode(",",$Bidders_Conflicting[$z]);
		$splitBiddersConflicting_array = array_intersect($splitBiddersConflicting, $allBidders);
	
		$splitBiddersConflicting_array_Keys = array_keys($splitBiddersConflicting_array);

		for($i=0;$i<count($splitBiddersConflicting_array_Keys);$i++)
		{
			$countKeys = $splitBiddersConflicting_array_Keys[$i];
			$ArrayConflictingBidders[] = $splitBiddersConflicting_array[$countKeys];
		}
		
		for($i=0;$i<count($ArrayConflictingBidders);$i++)
		{
			$sql = "select Last_allocation from Bidders_List where  BidderID='".$ArrayConflictingBidders[$i]."' and Reply_Type='".$ProductType."'";
			$query = ExecQuery($sql);
			$fetchValue = mysql_fetch_array($query);
			
			$Last_allocation[] = $fetchValue[0];
		}
		
		if (!@in_array(1, $Last_allocation))
		{
			$sqlupdate = "update Bidders_List set Last_allocation=1 where BidderID='".$ArrayConflictingBidders[0]."' and Reply_Type='".$ProductType."'";
			$queryupdate = ExecQuery($sqlupdate);
		}
		
	}
	

$splitBiddersConflicting = array();
$splitBiddersConflicting_array = array();
$splitBiddersConflicting_array_Keys = array();

//$finalBidder = array();
$FinalArrayConflict = array();
	for($y=0;$y<count($Bidders_Conflicting);$y++)
	{
		$splitBiddersConflicting = explode(",",$Bidders_Conflicting[$y]);
	//	echo "<br>/////*****splitBiddersConflicting*****//////";
	//	print_r($splitBiddersConflicting);
	//	echo "/////**********//////<br>";
		$splitBiddersConflicting_array = array_intersect($splitBiddersConflicting, $allBidders);

	//	echo "<br>/////*****splitBiddersConflicting_array*****//////";
	//	print_r($splitBiddersConflicting_array);
	//	echo "/////**********//////<br>";

		
		$splitBiddersConflicting_array_Keys = array_keys($splitBiddersConflicting_array);

	//	echo "<br>/////*****splitBiddersConflicting_array_Keys*****//////";
	//	print_r($splitBiddersConflicting_array_Keys);
	//	echo "/////**********//////<br>";

		$ArrayConflictingBidders = array();

		for($i=0;$i<count($splitBiddersConflicting_array_Keys);$i++)
		{
			$countKeys = $splitBiddersConflicting_array_Keys[$i];
	
			$ArrayConflictingBidders[] = $splitBiddersConflicting_array[$countKeys];
	
		}
	//echo "<br>/////*****ArrayConflictingBidders*****//////";
	//	print_r($ArrayConflictingBidders);
	//echo "/////*****ArrayConflictingBidders*****//////<br>";
	
		$StringConflictingBidders = implode(",",$ArrayConflictingBidders);
		$FinalArrayConflict[] = $StringConflictingBidders;
		
		
	}
	//print_r($FinalArrayConflict);
	for($k=0;$k<count($FinalArrayConflict);$k++)
	{
		$FinalArrayConflictProcess = $FinalArrayConflict[$k];
		$ConflictProcessValue = explode(",", $FinalArrayConflictProcess);
		asort($ConflictProcessValue);
		$ConflictProcessString[] = implode(",",$ConflictProcessValue);	
	}

	$ConflictingProcess = array_unique($ConflictProcessString);
	$ConflictProcess_String = implode(";",$ConflictingProcess);	
	$ConflictProcess_Array = explode(";",$ConflictProcess_String);	
	
	//print_r($ConflictProcess_Array);
	
	for($r=0;$r<count($ConflictProcess_Array);$r++)
	{
		//echo $ConflictProcess_Array[$r];
		$finalBidder[] = bidderPriority($ConflictProcess_Array[$r], $ProductType);		
	}

	$final_Bidder = @array_unique($finalBidder);
	$FinalBidders = @implode(",",$final_Bidder);
	//print_r($finalBidder);
return  $FinalBidders;  	

}
//Function RetrieveConflictingBidders End

/********************************************************************
Book Keeping Entry  
********************************************************************/
//function entryBookKeeping Start
function entryBookKeeping($BiddersList, $ProductType)
{
	 
	 $final = explode(",", $BiddersList);
	 
	 for($l=0;$l<_TOTAL;$l++)
        {   
            $toInsert = ExecQuery("select Restrict_Bidder from Bidders_List where  BidderID ='".$final[$l]."' and Reply_Type ='".$ProductType."'");
            $toInsertBidderID = mysql_fetch_array($toInsert);   
            if($toInsertBidderID[0]==1)
            {   
                $BK_Year = date('Y');
                $BK_Month = date('m');
                $BK_Week = date('W');
                $BK_Day = date('d');
               
                $BookKeepingSql = "select * from Bidders_Book_Keeping where BidderID=".$final[$l]." and BookProduct=".$ProductType." and BookDate=".$BK_Day." and BookMonth=".$BK_Month." and BookYear=".$BK_Year."";
                $BookKeepingQuery = ExecQuery($BookKeepingSql);
               
                $BookLeadCountExisting = @mysql_result($BookKeepingQuery,0,'BookLeadCount');
                $BookDate = @mysql_result($BookKeepingQuery,0,'BookDate');//added
                $BookMonth = @mysql_result($BookKeepingQuery,0,'BookMonth');//added
                $BookYear = @mysql_result($BookKeepingQuery,0,'BookYear');//added

                 if($BookLeadCountExisting>=1)
                 {
                     //Update
                    $IncrementLeadCount = $BookLeadCountExisting + 1;
                    $UpdateBKSql = "update Bidders_Book_Keeping set BookLeadCount=".$IncrementLeadCount.", BookEntryTime = Now()  where BidderID = ".$final[$l]." and BookDate = ".$BK_Day." and BookMonth=".$BK_Month." and BookYear =".$BK_Year." and BookProduct =".$ProductType."";
                    ExecQuery($UpdateBKSql);
					//echo "<br>".$UpdateBKSql."<br>";
                 }
                 else
                 {
                    //Insert
                    $InitialCount = 1;
                    $InsertBKSql = "INSERT INTO Bidders_Book_Keeping ( BidderID , BookProduct , BookDate , BookWeek , BookMonth , BookYear , BookLeadCount, BookEntryTime ) VALUES (".$final[$l].", ".$ProductType.", ".$BK_Day.",".$BK_Week.", ".$BK_Month.", ".$BK_Year.", ".$InitialCount.",Now())";
                    ExecQuery($InsertBKSql);
					//echo "<br>".$InsertBKSql."<br>";
                 }
            }
        }

}
//function entryBookKeeping End

/********************************************************************
 This function inserts the allocation of the leads  
 ********************************************************************/
//function finalAllocation Start
function finalAllocation($BiddersList, $ProductType, $LeadID, $AlwayConflictNonConflict_String,$Customer_City)
{

	 $BiddersValue = explode(",", $BiddersList);
	 $AlwayConflictNonConflict_array = explode(",",$AlwayConflictNonConflict_String);
	
	 $ConFilictBiddersValue = explode(",", $ConFilictBiddersSet);
	
$recordcountA="";
$BankNameID="";
	 for($l=0;$l<_TOTAL;$l++)
     {   
		$TestRestrictBidder = ExecQuery("select Restrict_Bidder from Bidders_List where  BidderID ='".$BiddersValue[$l]."' and Reply_Type ='".$ProductType."'");
		$RestrictBidderValue = mysql_fetch_array($TestRestrictBidder);   
		
		if($RestrictBidderValue[0]==1)
		{   
		
			$InsertFeedBackSql = "Insert into Req_Feedback_Bidder1 (AllRequestID,BidderID,Reply_Type,Allocation_Date) Values ('$LeadID', '$BiddersValue[$l]','$ProductType', Now())";
			
			$InsertFeedBackResult = ExecQuery($InsertFeedBackSql);
			$recordcount = @mysql_num_rows($InsertFeedBackResult);
			$recordLastInserted = mysql_insert_id();
			$recordcountA[] = $recordLastInserted;

			$UpdateBidders = "UPDATE `Bidders_List` SET `Last_allocation` = '1', `Last_set_select` = '1' WHERE `BidderID` = '".$BiddersValue[$l]."' and Reply_Type=".$ProductType;
			
			ExecQuery($UpdateBidders);
			$getConflictBidderSql = ExecQuery("select Conflict_Bidder from Bidders_List where  BidderID ='".$BiddersValue[$l]."'and Reply_Type='".$ProductType."'");
			$getConflictBidderFetch = mysql_fetch_array($getConflictBidderSql);   
		   
			$getConflictBidder = $getConflictBidderFetch[0];
		   
			$arrayConflictBidder = explode(",",$getConflictBidder);
		   
			for($i=0;$i<count($arrayConflictBidder);$i++)
			{
				$SqlConflictUpdate = "UPDATE `Bidders_List` SET `Last_allocation` = '0', `Last_set_select` = '1' WHERE `BidderID` = '".$arrayConflictBidder[$i]."' and Reply_Type='".$ProductType."'";
				  ExecQuery($SqlConflictUpdate);
			}


$getValidBiddersForSmsCityWise=ExecQuery("Select City_Wise from Req_Compaign Where Sms_Flag=1 and Reply_Type=".$ProductType." and BidderID='".$BiddersValue[$l]."'");
$citwisesms=mysql_fetch_array($getValidBiddersForSmsCityWise);
$strcitywise= $citwisesms['City_Wise'];
if(strlen($strcitywise)>0)
			{
	//echo "I M INSIDE CITY WISE IF BLOCK";
	$getValidBiddersForSms="Select * from Req_Compaign Where Sms_Flag=1 and Reply_Type=".$ProductType." and BidderID='".$BiddersValue[$l]."'and City_Wise like '%".$Customer_City."%'";

			}
else
			{
	//echo "I M INSIDE CITY WISE IN ELSE BLOCK";
$getValidBiddersForSms="Select * from Req_Compaign Where Sms_Flag=1 and Reply_Type=".$ProductType." and BidderID='".$BiddersValue[$l]."' and City_Wise='' ";
			}
	//echo "query1".$bidderquery."<br>";
	$getbidderresult=ExecQuery($getValidBiddersForSms);
	$Bidderrecorcount = mysql_num_rows($getbidderresult);
	if($Bidderrecorcount>0)
	{
		$ShowDate = date("H:i:s");
		$StartTime = "08:00:00";
		$EndTime = "18:00:00";	

		for($i=0;$i<$Bidderrecorcount;$i++)
		{
			 $Reply_Type = mysql_result($getbidderresult,$i,'Reply_Type');
			 $Bank_Name = mysql_result($getbidderresult,$i,'Bank_Name');
			 $BidderID = mysql_result($getbidderresult,$i,'BidderID');
			 $RequestID = mysql_result($getbidderresult,$i,'RequestID');
			 $Start_Date = mysql_result($getbidderresult,$i,'Start_Date');
			 $Mobile_no = mysql_result($getbidderresult,$i,'Mobile_no');
			 $City_Wise = mysql_result($getbidderresult,$i,'City_Wise');
			 	
			if($ShowDate > $StartTime && $ShowDate < $EndTime)			
			{
//closed for today //getleadbysms($Reply_Type,$Bank_Name,$BidderID,$RequestID,$Start_Date,$Mobile_no,$City_Wise,$BiddersList);
			}
		}
	}
			//}//else end here
// sms sending code ends here
$BankNameID[] = $BiddersValue[$l]; 
		}
	 }
	 // $BankNameID[] = $BiddersValue[$l]; 
	  //This is call of function to send bidder contact details to customer
		$BankNameID = array_filter($BankNameID, "filter_blank"); 
//$BankNameID = array_unique($BankNameID);

$GetBidderID = implode(',',$BankNameID);
//echo "GetBidderID:: ".$GetBidderID."<br><br>";
if(($ProductType==1 || $ProductType==2) && strlen($GetBidderID)>0)
	{
		$iciciarr=array("993");
		$checkiciciarr=array_intersect($BankNameID,$iciciarr);
	if($ProductType==2 && (count($checkiciciarr)>0) && ($Customer_City=="Delhi" || $Customer_City=="Ahmedabad" || $Customer_City=="Chandigarh" || $Customer_City=="Bangalore" || $Customer_City=="Chennai" || $Customer_City=="Kolkata" || $Customer_City=="Hyderabad" || $Customer_City=="Jaipur" || $Customer_City=="Gurgaon" || $Customer_City=="Pune" || $Customer_City=="Gaziabad" || $Customer_City=="Noida" || $Customer_City=="Faridabad" || $Customer_City=="Mumbai" || $Customer_City=="Thane" || $Customer_City=="Navi Mumbai"))
		{
			//echo "This is ICICI COndition";
		}
		else
		{
//closed for today
//getBidderContactDetailsToCustomers($ProductType,$GetBidderID,$LeadID);
		}
////////end of this call function
	}


	  if(count($BankNameID)>0 && $BankNameID[0]>0)
	{
if($ProductType ==2 || $ProductType ==1 || $ProductType ==5 || $ProductType ==4)
	{
		$GetBidderID = implode(',',$BankNameID);
		
		if(strlen($GetBidderID)>0)
		{
			//closed for today
			//SendMailToCustomers($GetBidderID,$LeadID,$ProductType);
		}
	}	
}

	 for($ACNCA=0;$ACNCA<count($AlwayConflictNonConflict_array);$ACNCA++)
	{
		
		$sql = "select Bidder_Priority from Bidders_List where BidderID='".$AlwayConflictNonConflict_array[$ACNCA]."' and Reply_Type='".$ProductType."'";
		$Query = ExecQuery($sql);
		$Bidder_Priority = @mysql_result($Query,0,'Bidder_Priority');
		
		$Bidder_PriorityArray = @explode(",",$Bidder_Priority); 
		//print_r($Bidder_PriorityArray);
		if(in_array($AlwayConflictNonConflict_array[$ACNCA],$BiddersValue))
		{
			$Value3Priority = 1;
		}
		else
		{
			$Value3Priority = 0;
		}
		$FinalSet = array();
		
		for($j=1;$j<count($Bidder_PriorityArray);$j++)
		{		
			$position = $j;
			$FinalSet[] = $Bidder_PriorityArray[$position];	
			
		}
		$FinalSet[] = $Value3Priority;
		
		$FinalSetString = implode(",",$FinalSet);
		
		if($AlwayConflictNonConflict_array[$ACNCA]>0)
		{
			$UpdatePriority = "update Bidders_List set Bidder_Priority='".$FinalSetString."' where  BidderID='".$AlwayConflictNonConflict_array[$ACNCA]."' and Reply_Type='".$ProductType."'";
			ExecQuery($UpdatePriority);
		}
		
	}

	  $RecordCount = count($recordcountA);
	  if($RecordCount>0 && $recordcountA[0]>0 )
	{
	  updateBidderCountinProduct($ProductType, $RecordCount, $LeadID);
	}
}
//function finalAllocation End
     
/********************************************************************
 
 ********************************************************************/	   
//function updateBidderCountinProduct Start
function updateBidderCountinProduct($ProductType, $RecordCount, $LeadID)
{	   

	$Table = getTableName($ProductType);	
	
	$updateBidderCount= "update ".$Table." set Allocated='1', Bidder_Count='$RecordCount' where RequestID='".$LeadID."'";
	ExecQuery($updateBidderCount);
}
//function updateBidderCountinProduct End

/********************************************************************
 This function forms the final sets of bidders to whom the leads has to be send 
********************************************************************/
//function finalBiddersSet Start
function finalBiddersSet($AlwaysSendBidders, $AlwaysConflictBidders, $NonConflictingBidders, $ConflictingBidders, $ProductType)
{
	$AlwaysSendBiddersFirst_Array = explode(",", $AlwaysSendBidders);
	
	$AlwaysConflictBidders_Array = explode(",", $AlwaysConflictBidders);
	
	$ConflictingBidders_Array = explode(",", $ConflictingBidders);
	
	$NonConflictingBidders_Array = explode(",", $NonConflictingBidders);

	for($i=0;$i<count($AlwaysConflictBidders_Array);$i++)
	{
		$CheckAlwaysSql = "select BidderID from Bidders_List where BidderID='".$AlwaysConflictBidders_Array[$i]."' and Always=1";
		$CheckAlwaysQuery = ExecQuery($CheckAlwaysSql);
		$CheckAlwaysNumRows = mysql_num_rows($CheckAlwaysQuery);
		if($CheckAlwaysNumRows>0)
		{
			$AddToAlways[] = $AlwaysConflictBidders_Array[$i];
		}
		else
		{
			$AddToConflict[] = $AlwaysConflictBidders_Array[$i];
		}
	}
	
	$AlwaysSendBidders_Array = array_filter(array_unique(array_merge($AlwaysSendBiddersFirst_Array, $AddToAlways)));
	
	$CombineConflicting_NonConflicting = array_unique(array_merge($NonConflictingBidders_Array, $ConflictingBidders_Array));
	
	$CombineConflicting_NonConflicting_Always = array_unique(array_merge($CombineConflicting_NonConflicting,$AddToConflict));
	
	$CombineConflictingNonConflictingArray = array_filter($CombineConflicting_NonConflicting_Always, "filter_blank");//Removes blank from the array
	$CombineConflictingNonConflictingString = implode(',',$CombineConflictingNonConflictingArray);
	$CombineConflictingNonConflicting = explode(",", $CombineConflictingNonConflictingString);
	
	//array used for the final set allocation

	$finalbiddercount = count($CombineConflictingNonConflicting);
	
	$AlwaysSendBidders_ArrayCount = count($AlwaysSendBidders_Array);

	if(($AlwaysSendBidders_ArrayCount ==1) && ( $AlwaysSendBidders_Array[0] < 1 ) )
	{
		$AlwaysSendBidders_ArrayCount = 0;
	}

	if($AlwaysSendBidders_ArrayCount > _TOTAL)
	{
		//Constant _TOTAL is defined at the top of this file
		//condition for bidders if always 1 greater than number of maximum bidders         
	
		$rand_keys = array_rand($AlwaysSendBidders_Array, _TOTAL);
		
		for($z=0;$z<_TOTAL;$z++)
		{
			$AlwaysSendBiddersValues =$AlwaysSendBidders_Array[$rand_keys[$z]];
			$FinalAlwaysSendBidders[] = $AlwaysSendBiddersValues;
		}
		
		$final = $FinalAlwaysSendBidders;
	
	}
	
	else if($AlwaysSendBidders_ArrayCount == _TOTAL)
	{
		//Constant _TOTAL is defined at the top of this file
		//condition for bidders if always 1 equal to the number of maximum bidders    
		$final=$AlwaysSendBidders_Array;
	
	}
	else
	{
		//condition for bidders if always 1 less than the number of maximum bidders    

		$AlwaysSendBidders_ArrayCount = count($AlwaysSendBidders_Array);
		
		if(($AlwaysSendBidders_ArrayCount ==1) && ( $AlwaysSendBidders_Array[0] < 1 ) )
		{
			$AlwaysSendBidders_ArrayCount = 0;
		}
			
		$leftbidder = _TOTAL - $AlwaysSendBidders_ArrayCount;

		if(($finalbiddercount < $leftbidder) || ($finalbiddercount == $leftbidder))
		{
			$final = array_merge($AlwaysSendBidders_Array, $CombineConflictingNonConflicting);
		}
		else
		{
			$l=$i=$j=0;
			
			for($l=0;$l<count($CombineConflictingNonConflicting);$l++)
			{
				$SelectLastSet ="select Last_set_select,BidderID from Bidders_List where  BidderID ='".$CombineConflictingNonConflicting[$l]."'  and Reply_Type='".$ProductType."'";
				$result = ExecQuery($SelectLastSet);
				
				while($row = mysql_fetch_array($result))
				{
					$last_set_select = $row["Last_set_select"];
			
					$bidder = $row["BidderID"];
				}
				if($last_set_select==0)
				{
					$arr_bid[$i]=$bidder;
					$i=$i+1;
				}
				if($last_set_select==1)
				{
					$arr_bidder[$j]=$bidder;
					$j=$j+1;
				}
			}
			
			$arrbid = @array_filter($arr_bid, "filter_blank");//Removes blank from the array;
			$arrbidder = @array_filter($arr_bidder, "filter_blank");//Removes blank from the array;
			
			$finalbid = count($arrbid);
			
			if($finalbid == $leftbidder)
			{
				
				$final = array_merge($AlwaysSendBidders_Array, $arrbid);
			
			}//close if($finalbid == $leftbidder)
			elseif($finalbid < $leftbidder)
			{
				$both = array_merge($arrbid, $arrbidder);
				$merge_array = count($both);
				if(($merge_array == $leftbidder) && ($merge_array < $leftbidder))
				{
					$final = array_merge($AlwaysSendBidders_Array, $both);
		
				}
				elseif($merge_array > $leftbidder)
				{
					$val = $leftbidder;
					
					if($val==1)
						$val=2;
			
					$rand_keys = array_rand($both, $val);
				
					for($j=0;$j<=($leftbidder-1);$j++)
					{
						$randomno[] = $both[$rand_keys[$j]];
					}
					
					$DefineRandomNo = $randomno;
					$random_no = @array_filter($DefineRandomNo, "filter_blank");//Removes blank from the array;
					$final = array_merge($AlwaysSendBidders_Array, $random_no);
			
				}// close elseif($merge_array > $leftbidder)
			}// close elseif($finalbid < $leftbidder)
			elseif ($finalbid > $leftbidder)
			{
				$val = $leftbidder;
				$both = $arrbid;//will have to look while checking this condition while update for last_set_select
				
				if($val==1)
					$val=2;
				
				$rand_keys = array_rand($arrbid, $val);
			
				for($j=0;$j<=($leftbidder-1);$j++)
				{
					$randomno[] = $arrbid[$rand_keys[$j]];
				}
				$DefineRandomNo = $randomno;
				$random_no = @array_filter($DefineRandomNo, "filter_blank");//Removes blank from the array;
				$final = array_merge($AlwaysSendBidders_Array, $random_no);
		
			}//close elseif ($finalbid > $leftbidder)
		}
	}
	
	for($i=0;$i<=count($arrbidder);$i++)
	{
		$LastSetUpdate = "UPDATE `Bidders_List` SET `Last_set_select` = '0' WHERE `BidderID` = '".$arrbidder[$i]."'  and Reply_Type='".$ProductType."'";
		ExecQuery($LastSetUpdate);
		
		$queryGetBidderID = ExecQuery("select Conflict_bidder from Bidders_List where  BidderID ='".$arrbidder[$i]."'  and Reply_Type='".$ProductType."'");
		$fetchBidderID = mysql_fetch_array($queryGetBidderID);
		
		$explodeBidderID = explode(",",$fetchBidderID[0]);
		for($j=0;$j<=count($explodeBidderID);$j++)
		{
			$UpdateLastSetAllocation = "UPDATE `Bidders_List` SET `Last_set_select` = '0' WHERE `BidderID` = '".$explodeBidderID[$j]."'  and Reply_Type='".$ProductType."'";
			ExecQuery($UpdateLastSetAllocation);
		}
	}

$final_d = @array_filter($final, "filter_blank");//Removes blank from the array;	
$final = @array_unique($final_d);

	$FinalSet = @implode(",", $final);
	
	return $FinalSet;
	//
}
//function finalBiddersSet End

/********************************************************************
This function maintains the lof table entries for each specific lead 
 ********************************************************************/
//function insertLogDataBiddersList Start
function insertLogDataBiddersList($LogID, $LeadID, $City, $ProductID, $FieldName, $FieldValue)
{
	if($LogID>0)
	{
		//update wrt leadid and productID // yaa phir last insterted id
		if(strlen($FieldValue)>0 || $FieldName=='NotEligibleCity')
		{
			$Sql = "update Logxy set ".$FieldName." ='".$FieldValue."' where LogID = ".$LogID; 
			$Query = ExecQuery($Sql);
		}	
		
	}
	else
	{
		//insert $LeadID, $ProductID
		
		$Sql = "insert into Logxy (LeadID, ProductID, City, AgeLoanSalValidEmpStat, Dated) values ('".$LeadID."', '".$ProductID."', '".$City."', '".$FieldValue."', Now())";
		$Query = ExecQuery($Sql);
		//echo	"<BR>".	$Sql;
		$Log_ID = mysql_insert_id();
	}
	makeGlobalLogID($Log_ID);
}
//function insertLogDataBiddersList End

/********************************************************************
This function returns Age by providing Date of Birth, but will return 
absolute age  
********************************************************************/
//function DetermineAgeFromDOB Start
function DetermineAgeFromDOB ($YYYYMMDD_In)
{
  $yIn=substr($YYYYMMDD_In, 0, 4);
  $mIn=substr($YYYYMMDD_In, 4, 2);
  $dIn=substr($YYYYMMDD_In, 6, 2);

  $ddiff = date("d") - $dIn;
  $mdiff = date("m") - $mIn;
  $ydiff = date("Y") - $yIn;

  // Check If Birthday Month Has Been Reached
  if ($mdiff < 0)
  {
    // Birthday Month Not Reached
    // Subtract 1 Year From Age
    $ydiff--;
  } elseif ($mdiff==0)
  {
    // Birthday Month Currently
    // Check If BirthdayDay Passed
    if ($ddiff < 0)
    {
      //Birthday Not Reached
      // Subtract 1 Year From Age
      $ydiff--;
    }
  }
  return $ydiff;
}
//function DetermineAgeFromDOB End
/*************************************************************
This function is used to send sms to bidders about their allocated customers
***************************************************************/
function getleadbysms ($strreply_type, $strbank_name, $strbidderid, $requestid, $strstart_date, $strmobile_no,$City_Wise,$BiddersList)
{
		$append = "";
	
		$all_BiddersSet = explode(",", $BiddersList);
		$allBidders_Set = array_filter($all_BiddersSet, "filter_blank"); 	
		if((count($allBidders_Set)==1) && $allBidders_Set[0]>0)
		{
			$append = " [Exclusive Lead] ";
		}
		else
		{
			$append = "";
		}
		
	$City = trim($City_Wise);
		
		$oldcity = explode(",", $City);
		$newcity = implode ("','",$oldcity) ;
			//echo $newcity."<br>";
			$propercity="('".$newcity."')";
	//getleadbysms($Reply_Type,$Bank_Name,$BidderID,$RequestID,$Start_Date,$Mobile_no);
	$reply_type=getTableName($strreply_type);
	$getforsms=getforsms($reply_type);
	
	 $SMSMessage="";
	
	 $ctr=1;
	if((strlen(trim($requestid))<=0))
	{
		if(strlen($City)>0)
		{
			$search_query="SELECT * FROM Req_Feedback_Bidder1,".$reply_type." LEFT OUTER JOIN Req_Feedback ON Req_Feedback.AllRequestID=".$reply_type.".RequestID AND Req_Feedback.BidderID= ".$strbidderid." WHERE Req_Feedback_Bidder1.AllRequestID= ".$reply_type.".RequestID and Req_Feedback_Bidder1.BidderID = ".$strbidderid." and ".$reply_type.".City in ".$propercity." and (Req_Feedback_Bidder1.Allocation_Date >='".$strstart_date." 00:00:00' and ".$reply_type.".Dated >='".$strstart_date." 00:00:00') ";

		}
		else{	
		$search_query="SELECT * FROM Req_Feedback_Bidder1,".$reply_type." LEFT OUTER JOIN Req_Feedback ON Req_Feedback.AllRequestID=".$reply_type.".RequestID AND Req_Feedback.BidderID= ".$strbidderid." WHERE Req_Feedback_Bidder1.AllRequestID= ".$reply_type.".RequestID and Req_Feedback_Bidder1.BidderID = ".$strbidderid." and (Req_Feedback_Bidder1.Allocation_Date >='".$strstart_date." 00:00:00' and ".$reply_type.".Dated >='".$strstart_date." 00:00:00') ";
		}
	}
	else
	{
		if(strlen($City)>0)
		{
			$search_query="SELECT * FROM Req_Feedback_Bidder1,".$reply_type." LEFT OUTER JOIN Req_Feedback ON Req_Feedback.AllRequestID=".$reply_type.".RequestID AND Req_Feedback.BidderID= ".$strbidderid." WHERE Req_Feedback_Bidder1.Feedback_ID>'$requestid' and Req_Feedback_Bidder1.AllRequestID= ".$reply_type.".RequestID and Req_Feedback_Bidder1.BidderID = ".$strbidderid." and ".$reply_type.".City in ".$propercity." and (Req_Feedback_Bidder1.Allocation_Date >='".$strstart_date." 00:00:00' and ".$reply_type.".Dated >='".$strstart_date." 00:00:00') ";
		}
		else
		{
		$search_query="SELECT * FROM Req_Feedback_Bidder1,".$reply_type." LEFT OUTER JOIN Req_Feedback ON Req_Feedback.AllRequestID=".$reply_type.".RequestID AND Req_Feedback.BidderID= ".$strbidderid." WHERE Req_Feedback_Bidder1.Feedback_ID>'$requestid' and Req_Feedback_Bidder1.AllRequestID= ".$reply_type.".RequestID and Req_Feedback_Bidder1.BidderID = ".$strbidderid." and (Req_Feedback_Bidder1.Allocation_Date >='".$strstart_date." 00:00:00' and ".$reply_type.".Dated >='".$strstart_date." 00:00:00') ";
		}
	}
	
	$result = ExecQuery($search_query);
	$recorcount = mysql_num_rows($result);
	
	 $currentdate=date('d-m-Y');
	
if ($myrow = mysql_fetch_array($result))
	{
	$SMSMessage="";
	$SMSMessageCiti="";
	$smsforbidderid1160="";
	 $SMSMessagecitifin="";
	 $SMSMessagefullteron="";
	 $SMSMessagefor1512="";
	 $SMSMessage1596="";
	 $SMSMessage1705="";
			
		do
		{
			//$SMSMessage="";
			$request=trim($myrow["Feedback_ID"]);
			$Name=trim($myrow["Name"]);
			$Email=trim($myrow["Email"]);
			$City=trim($myrow["City"]);
			$Phone=trim($myrow["Mobile_Number"]);
			$Net_Salary=trim($myrow["Net_Salary"]);
			$Company_Name =trim($myrow["Company_Name"]);
			$Loan_Amount=trim($myrow["Loan_Amount"]);
			
			$Add_Comment=trim($myrow["Add_Comment"]);
			if($reply_type=="Req_Loan_Personal")
			{
				$Primary_Acc=trim($myrow["Primary_Acc"]);
				$Employment_Status =trim($myrow["Employment_Status"]);
				if($Employment_Status==1)
				{
					$emp_stat="Salaried";
				}
				else
				{
					$emp_stat="Self Emp";
				}
				$Loan_Any=trim($myrow["Loan_Any"]);
				if(strlen($Loan_Any)>0)
				{
					$loan_any="Loan";
				}


				$CC_Holder=trim($myrow["CC_Holder"]);
				if($CC_Holder==1)
				{
					$cc="CC";
				}
			}
			if($reply_type=="Req_Loan_Car")
			{
				$Car_Model=trim($myrow["Car_Model"]);
				$Car_Type=trim($myrow["Car_Type"]);
				if($Car_Type==1)
				{
					$CarType="New Car";
				}
				else
				{
					$CarType="Used Car";
				}

			}


if($reply_type=="Req_Loan_Personal")
			{
				$message ="Personal loan Leads on (".$currentdate.") : ";
				$SMSMessage=$SMSMessage."(".$ctr.") ".$Name."-".$Phone.",Sal- ".$Net_Salary.",Co- ".$Company_Name.",Acc-".$Primary_Acc;

				$SMSMessageful=$SMSMessageful."(".$ctr.") ".$Name."-".$Phone.",Sal- ".$Net_Salary.",Co- ".$Company_Name.",Acc-".$Primary_Acc.",city-".$City.",".$emp_stat;

				$SMSMessagecitifin=$SMSMessagecitifin."(".$ctr.") ".$Name."-".$Phone.",Sal- ".$Net_Salary.",Co- ".$Company_Name.",city-".$City.",".$loan_any.",".$cc;

				$SMSMessagefullteron=$SMSMessagefullteron."(".$ctr.") ".$Name."-".$Phone.",Sal- ".$Net_Salary.",Co- ".$Company_Name.",Acc-".$Primary_Acc.",".$emp_stat;

				$SMSMessage1596=$SMSMessage1596."(".$ctr.") ".$Name."-".$Phone.",Sal- ".$Net_Salary.",Co- ".$Company_Name.",Acc-".$Primary_Acc.",city-".$City;

				$SMSMessage1705=$SMSMessage1705."(".$ctr.") ".$Name."-".$Phone.",Sal- ".$Net_Salary.",Co- ".$Company_Name.",Acc-".$Primary_Acc.",".$strbank_name;

			}
			elseif($reply_type=="Req_Loan_Home")
			{
				$message ="Home loan Leads on (".$currentdate.") : ";
				$SMSMessage=$SMSMessage."(".$ctr.") ".$Name."-".$Phone.",sal- ".$Net_Salary.",loan amt- ".$Loan_Amount.", ".$Add_Comment;

				$SMSMessagecitifin=$SMSMessagecitifin."(".$ctr.") ".$Name."-".$Phone.",sal- ".$Net_Salary.",loan amt- ".$Loan_Amount.", ".$Add_Comment."city-".$City;

				$SMSMessage1697=$SMSMessage1697."(".$ctr.") ".$Name."-".$Phone.",sal- ".$Net_Salary.",Co- ".$Company_Name.",loan amt- ".$Loan_Amount.", ".$Add_Comment;
			}
			else
			{
				$message ="Leads for ".$getforsms." on (".$currentdate.") : ";
				$SMSMessage=$SMSMessage."(".$ctr.") ".$Name."-".$Phone;
				$SMSMessage1688=$SMSMessage."(".$ctr.") ".$Name."-".$Phone.", ".$CarType.", ".$Car_Model;
				
				$SMSMessagefor1512=$SMSMessagefor1512."(".$ctr.") ".$Name."-".$Phone."-".$Email;
				
			}
			
			$SMSMessage = $SMSMessage.$append;
			$SMSMessagecitifin = $append.$SMSMessagecitifin;
			//$SMSMessage=$SMSMessage."(".$ctr.") ".$Name."-".$Phone;
			//echo $SMSMessage;

$SMSMessageCiti=$SMSMessageCiti."(".$ctr.") ".$Name."-".$Phone." | ".$Company_Name." | ".$Primary_Acc;
$smsforbidderid1160=$smsforbidderid1160."(".$ctr.") ".$Name."-".$Phone.",sal- ".$Net_Salary.",loan amt- ".$Loan_Amount.",barclays";
$SMSMessageCiti = $SMSMessageCiti.$append;

			$ctr=$ctr+1;
	  }while ($myrow = mysql_fetch_array($result));
		  mysql_free_result($result);
	}
	//$mobile_no="9811215138";
	if($strbidderid=="1053" || $strbidderid=="1054" || $strbidderid=="1055" || $strbidderid=="1056" || $strbidderid=="1057" || $strbidderid=="1058")
	{
			if(strlen(trim($SMSMessage1596))>0)
		{
			if(strlen(trim($strmobile_no)) > 0)
			 SendSMS($message.$SMSMessage1596, $strmobile_no);

		}

	}
	elseif($strbidderid=="1160")
	{
		if(strlen(trim($smsforbidderid1160))>0)
		{
			if(strlen(trim($strmobile_no)) > 0)
			 SendSMS($message.$smsforbidderid1160, $strmobile_no);

			//if(strlen(trim($mobile_no)) > 0)
			// SendSMS($message.$SMSMessageCiti, $mobile_no);
		}
	}
	elseif($strbidderid=="1110" || $strbidderid=="1111" || $strbidderid=="1112" || $strbidderid=="1113" || $strbidderid=="1114" || $strbidderid=="1115" || $strbidderid=="1116" || $strbidderid=="1482" || $strbidderid=="1483" || $strbidderid=="1477" || $strbidderid=="1476" || $strbidderid=="1447" || $strbidderid=="1466" || $strbidderid=="1631" )
	{
		if(strlen(trim($SMSMessagecitifin))>0)
		{
			if(strlen(trim($strmobile_no)) > 0)
			 SendSMS($message.$SMSMessagecitifin, $strmobile_no);
		}
	}
	elseif($strbidderid=="1037")
	{
		if(strlen(trim($SMSMessageful))>0)
		{
			if(strlen(trim($strmobile_no)) > 0)
			 SendSMS($message.$SMSMessageful, $strmobile_no);
		}
	}
	elseif($strbidderid=="996" || $strbidderid=="997" || $strbidderid=="998" || $strbidderid=="1000" || $strbidderid=="1012" || $strbidderid=="1015" || $strbidderid=="1050")
	{
		if(strlen(trim($SMSMessagefullteron))>0)
		{
			if(strlen(trim($strmobile_no)) > 0)
			 SendSMS($message.$SMSMessagefullteron, $strmobile_no);
		}
	}
	elseif($strbidderid=="1512")
	{
		if(strlen(trim($SMSMessagefor1512))>0)
			{
				if(strlen(trim($strmobile_no)) > 0)
				 SendSMS($message.$SMSMessagefor1512, $strmobile_no);
			}
	}
	elseif($strbidderid=="1596"  || $strbidderid=="1589")
	{
		if(strlen(trim($SMSMessage1596))>0)
			{
				if(strlen(trim($strmobile_no)) > 0)
				 SendSMS($message.$SMSMessage1596, $strmobile_no);
			}
	}
	elseif($strbidderid=="1688")
	{
		if(strlen(trim($SMSMessage1688))>0)
			{
				if(strlen(trim($strmobile_no)) > 0)
				 SendSMS($message.$SMSMessage1688, $strmobile_no);
			}
	}
	elseif($strbidderid=="1697")
	{
		if(strlen(trim($SMSMessage1697))>0)
			{
				if(strlen(trim($strmobile_no)) > 0)
				 SendSMS($message.$SMSMessage1697, $strmobile_no);
			}
	}
	elseif($strbidderid=="1705")
	{
		if(strlen(trim($SMSMessage1705))>0)
			{
				if(strlen(trim($strmobile_no)) > 0)
				 SendSMS($message.$SMSMessage1705, $strmobile_no);
			}
	}
	else
	{
		if(strlen(trim($SMSMessage))>0)
		{
			echo "<br>////FinalMessage////// ".$message."-".$SMSMessage."      ///////////<br>";
			if(strlen(trim($strmobile_no)) > 0)
			 	SendSMS($message.$SMSMessage, $strmobile_no);
		}
	}
	
	if(($recorcount)>0)
	{

 ExecQuery("update Req_Compaign set RequestID='$request' where (Reply_Type=".$strreply_type." and Bank_Name='".$strbank_name."' and BidderID=".$strbidderid." and City_Wise='".$City_Wise."' and Sms_Flag=1)" );
 
	}

}
// Function getleadbysms END

//Function to send send now mailer
function SendMailToCustomers($GetBankID,$CustomerID,$Product)
{
	$GetBidderID = explode(',',$GetBankID);
	$ExpBidderName = "";
	for($bid=0;$bid<count($GetBidderID);$bid++)	
	{
		$GetBankSql = "select * from Bidders_List where BidderID = ".$GetBidderID[$bid]." and Reply_Type = ".$Product."";
		$GetBankQuery = ExecQuery($GetBankSql);
		$GetBankCount = mysql_num_rows($GetBankQuery);
		$NameID = mysql_result($GetBankQuery,0,'BankID');
		if($GetBankCount>0)
		{
			$GetBank_Sql = "select * from Bank_Master where BankID  = ".$NameID ."";
			$GetBank_Query = ExecQuery($GetBank_Sql);
			$BidderName = mysql_result($GetBank_Query,0,'Bank_Name');
			$ExpBidderName[] = $BidderName;

		}
	}

	$Bank_Name = "";
	for($exp=0;$exp<count($ExpBidderName);$exp++)
	{	
		$Count = $exp +1;
		$Bank_Name[] = "<b>".$ExpBidderName[$exp]."</b><br>";

	}
	$FinalBidderName = implode('',$Bank_Name);
	
	$getproductforemailer=getforemailer($Product);
			
	$TableName = getTableName($Product);
	$GetCustIDSql = "select * from ".$TableName." where RequestID = ".$CustomerID." ";
	
	$GetCustIDQuery = ExecQuery($GetCustIDSql);
	$full_name = mysql_result($GetCustIDQuery,0,'Name');
	$email  = mysql_result($GetCustIDQuery,0,'Email');
	$city  = mysql_result($GetCustIDQuery,0,'City');
	$identification_proof  = mysql_result($GetCustIDQuery,0,'identification_proof');
	 
	$Document_proof=explode(",",$identification_proof);

	if($city == "Others")
	{
		$city  = mysql_result($GetCustIDQuery,0,'City_Other');
	}
	$mobile_no  = mysql_result($GetCustIDQuery,0,'Phone');
	
	
	//$email="ranjana5chauhan@gmail.com";
	if(((strlen($email)) > 0) && (count($ExpBidderName)>0) ) 
	{
		if(($Product==1) && strlen($identification_proof)>0)
		{
$Message = "<table width='100%' border='0' align='center' cellpadding='0' cellspacing='0' style='border:1px ridge #0099FF;'>  <tr>    <td><table width='100%' border='0' cellspacing='0' cellpadding='0'><tr><td width='40%' valign='top'></td><td width='60%' align='right' style='padding-top:5px;'><img src='http://www.deal4loans.com/images/cc/crdt-crd-logo.gif'  /><br />  <span style='font-family: Verdana, Arial, Helvetica, sans-serif;	font-size: 10px;	color:#0A71D9;'>Loans by Choice not by Chance!</span></td></tr></table></td></tr><tr><td style=' font-family:Verdana; font-size:12px; color:#333333; padding-top:20px; padding-left:10px; padding-right:10px;'><p><b>Dear  $full_name,</b></p> <p>Thank you for choosing Deal4loans.com, we are pleased to inform you that your registration for $getproductforemailer has been successful and we have forwarded your request to the following $getproductforemailer providers:</p><p>";
	 $Bank_Name = "";
	for($exp=0;$exp<count($ExpBidderName);$exp++)
	{	
$Count = $exp +1;
		$Message.="<b>".$Count.") ".$ExpBidderName[$exp]."</b><br>";
		//$Bank_Name[] = "<b>".$ExpBidderName[$exp]."</b><br>";

		/**********************************************************************************/
		$getdoc=ExecQuery("select document_proof,identification_proof,residence_proof,income_proof from bank_documents_required where bank_name like '%".$ExpBidderName[$exp]."%'");
		
		//echo "select document_proof,identification_proof,residence_proof,income_proof from bank_documents_required where bank_name like '%".$ExpBidderName[$exp]."%'";
		$myrow = mysql_fetch_array($getdoc);
		$recordcount = mysql_num_rows($getdoc);
if($recordcount>0)
				{
	$identification_prf=$myrow["identification_proof"];
	$residence_prf=$myrow["residence_proof"];
	$income_prf=$myrow["income_proof"];
	$document_prf=$myrow["document_proof"];

	$arrid_pf=explode(",",$identification_prf);
	$arrres_pf=explode(",",$residence_prf);
	$arrinc_pf=explode(",",$income_prf);
	$arrdoc_pf=explode(",",$document_prf);

	$getidpf=array_intersect($Document_proof,$arrid_pf);
	$getrespf=array_intersect($Document_proof,$arrres_pf);
	$getinpf=array_intersect($Document_proof,$arrinc_pf);
	$getdocpf=array_intersect($Document_proof,$arrdoc_pf);

if((count($getidpf)==0) || (count($getrespf)==0) || (count($getinpf)==0))
					{
								$Message.="<b>Pending Documents as per your information.</b><br>";
								
					}
if(count($getidpf)==0)
					 {
								$Message.="<b>Identification Proof:</b> ".@str_replace(",", " / ", $identification_prf)." (any one of these)";

								if(count($getrespf)>0 && count($getinpf)>0)
						{
									$Message.="<br><br>";
						}
					 }
					
					 if(count($getrespf)==0)
					 {
						 		$Message.="<br><b>Residence Proof:</b> ".@str_replace(",", " / ", $residence_prf)." (Any one of these)";
						 if(count($getinpf)>0)
						 {
									$Message.="<br><br>";
						 }
					 }
					
					 if(count($getinpf)==0)
					 {	
						 if(count($getrespf)==0 || count($getidpf)==0)
						 {
							 		$Message.="<br>";
						 }
								$Message.=" <b>Income Proof:</b> ".@str_replace(",", " / ", $income_prf)." (Any one of these)";
								$Message.="<br><br>";
					 }
										
	if(count($getdocpf)>0 && count(array_diff($arrdoc_pf,$getdocpf))>0)
		{
			if((count($getinpf)==0 && strlen($income_prf)>0)|| (count($getidpf)==0 &&  strlen($identification_prf)>0) || (count($getrespf)==0 && strlen($residence_prf)>0) )
						 {
							echo " <font color='#000000'>and</font><br>";
						 }
						 
						 $getexactpf=array_diff($arrdoc_pf,$getdocpf);
						 $strexactpf=implode(",",$getexactpf);

			echo  " ".@str_replace(",", " | ", $strexactpf)." <br>";
		}
		elseif(count($getdocpf)==0 && count(array_diff($arrdoc_pf,$getdocpf))>0)
					 {	
						if((count($getinpf)==0 && strlen($income_prf)>0)|| (count($getidpf)==0 &&  strlen($identification_prf)>0) || (count($getrespf)==0 && strlen($residence_prf)>0) )
						 {
							echo " <font color='#000000'>and</font><br>";
						 }
				
			//echo  " ".@str_replace(",", " | ", $document_prf)." <br>";
					 }

if((count($getidpf)>0) && (count($getrespf)>0) && (count($getinpf)>0) && (count(array_diff($arrdoc_pf,$getdocpf))==0) && count($getdocpf)>0)
					 {	//echo "";
								$Message.="For this bank you have all the required document.<br><br>";
					 }
	
				 }
		 else
		 {
			 		$Message.="<br><br>";
		 }
				//}
	}
	$Message.="<br /> You will receive calls within 24 hours from the Companies executives, you can compare the rates &amp; choose the best deal.</p><p>Warm Regards,<br />Team Deal4Loans<br /></p> </td></tr>  <tr><td style=' font-family:Verdana; font-size:12px; color:#ffffff;  padding-left:10px; padding-right:10px; background-color:#248ACA; border-top:1px solid  #0099CC;'><table width='100%' border='0' cellspacing='0' cellpadding='0'> <tr><td align='center' valign='middle' style='color:#ffffff; font-family:Verdana; font-size:12px;'><a href='http://www.deal4loans.com/Contents_Blogs.php?source=d4l-aug08' style='color:#ffffff; font-family:Verdana; font-size:12px;'>Blogs</a> </td><td align='center' valign='middle'> <a href='http://www.deal4loans.com/quiz.php?source=d4l-sendnow' style='color:#ffffff; font-family:Verdana; font-size:12px;'>Loan Quiz</a></td><td align='center' valign='middle' style='color:#ffffff; font-family:Verdana; font-size:12px;'> <a href='http://www.deal4loans.com/debt-consolidation-plans.php?source=d4l-sendnow' style='color:#ffffff; font-family:Verdana; font-size:12px;'>Loan Guru </a></td><td align='center' valign='middle' style= 'color:#ffffff; font-family:Verdana; font-size:12px;'> <a href='http://www.deal4loans.in?source=d4l-sendnow'style=' font-family:Verdana; font-size:12px; color:#ffffff;'>Deal4loans.in </a></td><td height='25' align='center' valign='middle'> <a href='http://www.bimadeals.com?source=d4l-sendnow' style='color:#ffffff; font-family:Verdana; font-size:12px;'>Bimadeals.com </a></td><td align='center' valign='middle'> <a href='http://www.askamitoj.com?source=d4l-sendnow' style='color:#ffffff; font-family:Verdana; font-size:12px;'>Askamitoj.com</a> </td> <td valign='middle'>&nbsp;</td> </tr></table></td></tr></table>";

		}
		else
		{
			$Message = "<table width='100%' border='0' align='center' cellpadding='0' cellspacing='0' style='border:1px ridge #0099FF;'>  <tr>    <td><table width='100%' border='0' cellspacing='0' cellpadding='0'><tr><td width='40%' valign='top'></td><td width='60%' align='right' style='padding-top:5px;'><img src='http://www.deal4loans.com/images/cc/crdt-crd-logo.gif'  /><br />  <span style='font-family: Verdana, Arial, Helvetica, sans-serif;	font-size: 10px;	color:#0A71D9;'>Loans by Choice not by Chance!</span></td></tr></table></td></tr><tr><td style=' font-family:Verdana; font-size:12px; color:#333333; padding-top:20px; padding-left:10px; padding-right:10px;'><p><b>Dear  $full_name,</b></p> <p>Thank you for choosing Deal4loans.com, we are pleased to inform you that your registration for $getproductforemailer has been successful and we have forwarded your request to the following $getproductforemailer providers:</p><p><b>".$FinalBidderName."</b><br /> You will receive calls within 24 hours from the Companies executives, you can compare the rates &amp; choose the best deal.</p><p>Warm Regards,<br />Team Deal4Loans<br /></p> </td></tr>  <tr><td style=' font-family:Verdana; font-size:12px; color:#ffffff;  padding-left:10px; padding-right:10px; background-color:#248ACA; border-top:1px solid  #0099CC;'><table width='100%' border='0' cellspacing='0' cellpadding='0'> <tr><td align='center' valign='middle'><a href='http://www.deal4loans.com/Contents_Blogs.php?source=d4l-aug08' style=' font-family:Verdana;  color:#ffffff; '>Blogs</a> </td><td align='center' valign='middle'> <a href='http://www.deal4loans.com/quiz.php?source=d4l-sendnow' style=' font-family:Verdana;  color:#ffffff;   '>Loan Quiz</a></td><td align='center' valign='middle'> <a href='http://www.deal4loans.com/debt-consolidation-plans.php?source=d4l-sendnow' style=' font-family:Verdana;  color:#ffffff;   '>Loan Guru </a></td><td align='center' valign='middle'> <a href='http://www.deal4loans.in?source=d4l-sendnow' style=' font-family:Verdana;  color:#ffffff;   '>Deal4loans.in </a></td><td height='25' align='center' valign='middle'> <a href='http://www.bimadeals.com?source=d4l-sendnow' style=' font-family:Verdana;  color:#ffffff;   '>Bimadeals.com </a></td><td align='center' valign='middle'> <a href='http://www.askamitoj.com?source=d4l-sendnow' style=' font-family:Verdana;  color:#ffffff;   '>Askamitoj.com</a> </td> <td valign='middle'>&nbsp;</td> </tr></table></td></tr></table>";
		}
$messagecc="<table width='100%' border='0' align='center' cellpadding='0' cellspacing='0' style='border:1px ridge #0099FF;'>  <tr>    <td><table width='100%' border='0' cellspacing='0' cellpadding='0'><tr><td width='40%' valign='top'></td><td width='60%' align='right' style='padding-top:5px;'><img src='http://www.deal4loans.com/images/cc/crdt-crd-logo.gif'  /><br />  <span style='font-family: Verdana, Arial, Helvetica, sans-serif;	font-size: 10px;	color:#0A71D9;'>Loans by Choice not by Chance!</span></td></tr></table></td></tr><tr><td style=' font-family:Verdana; font-size:12px; color:#333333; padding-top:20px; padding-left:10px; padding-right:10px;'><p><b>Dear  $full_name,</b></p> <p>Thank you for choosing Deal4loans.com, we are pleased to inform you that your registration for $getproductforemailer has been successful and we have forwarded your request to the following $getproductforemailer providers:</p><p><b>".$FinalBidderName."</b><br /> You will receive calls within 24 hours from the Companies executives, you can compare the rates &amp; choose the best deal.</p></td></tr><tr><td>&nbsp;</td></tr><tr>
  <td>&nbsp;</td>
</tr><tr><td><p>Warm Regards,<br />Team Deal4Loans<br /></p> </td></tr>  <tr><td style=' font-family:Verdana; font-size:12px; color:#ffffff;  padding-left:10px; padding-right:10px; background-color:#248ACA; border-top:1px solid  #0099CC;'><table width='100%' border='0' cellspacing='0' cellpadding='0'> <tr><td align='center' valign='middle'><a href='http://www.deal4loans.com/Contents_Blogs.php?source=d4l-aug08' style=' font-family:Verdana;  color:#ffffff; '>Blogs</a> </td><td align='center' valign='middle'> <a href='http://www.deal4loans.com/quiz.php?source=d4l-sendnow' style=' font-family:Verdana;  color:#ffffff;   '>Loan Quiz</a></td><td align='center' valign='middle'> <a href='http://www.deal4loans.com/debt-consolidation-plans.php?source=d4l-sendnow' style=' font-family:Verdana;  color:#ffffff;   '>Loan Guru </a></td><td align='center' valign='middle'> <a href='http://www.deal4loans.in?source=d4l-sendnow' style=' font-family:Verdana;  color:#ffffff;   '>Deal4loans.in </a></td><td height='25' align='center' valign='middle'> <a href='http://www.bimadeals.com?source=d4l-sendnow' style=' font-family:Verdana;  color:#ffffff;   '>Bimadeals.com </a></td><td align='center' valign='middle'> <a href='http://www.askamitoj.com?source=d4l-sendnow' style=' font-family:Verdana;  color:#ffffff;   '>Askamitoj.com</a> </td> <td valign='middle'>&nbsp;</td> </tr></table></td></tr></table>";

	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	//$headers .= 'To: '.$full_name.' ' . "\r\n";
	$headers .= 'From: deal4loans <no-reply@deal4loans.com>' . "\r\n";
	$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
	$headers .= 'Bcc: extra4testing@gmail.com' . "\r\n";
	//$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
//	$email="ranjana5chauhan@gmail.com";
	if($Product==4)
	{

		//if($email == "ranjana5chauhan@gmail.com")
		//{
			mail($email,'Thanks for Registering for '.$getproductforemailer.' on deal4loans.com', $messagecc, $headers);
		//}
	}
	else
	{
		mail($email,'Thanks for Registering for '.$getproductforemailer.' on deal4loans.com', $Message, $headers);
	}
	
	}

	//echo $Message;	
}			  



// End of function SendMailToCustomers

/***********************************************************************************************/
//Send sms to customers 
//bidder contact details
/*************************************************************************************************/

function getBidderContactDetailsToCustomers($strProduct,$strbidderid,$leadid)
{
	$table_NAme=getTableName($strProduct);
	$strmobileSQL = "SELECT Mobile_Number FROM ".$table_NAme." WHERE (RequestID=".$leadid.")";
	echo "bidder contact".$strmobileSQL."<br><br>";
	$mobileresult = ExecQuery($strmobileSQL);
	$Mobrow = mysql_fetch_array($mobileresult);
	$Mobile_number=$Mobrow["Mobile_Number"];
//$Phone="9811215138";
$Phone=$Mobile_number;
$GetBidderID = explode(',',$strbidderid);
	$SMSMessage="Dear Customer,Following are contact details of your chosen Banks @ deal4loans: ";
	$SMSMessageBidders="";
	$ctr=1;
	$mvarType = $strProduct;
	$mvarCity = strtoupper($strCity);

	$strSQL = "SELECT Bank_Name,Banker_Contact FROM Bidder_Contact_To_Customers WHERE (BidderID in (".$strbidderid.") AND Reply_Type=".$mvarType." AND Sms_Flag=1)";

	//echo "SQL : ".$strSQL."<BR>";
	$result = ExecQuery($strSQL);
	echo mysql_error();

	
		If ($myrow = mysql_fetch_array($result))
	{
		do
		{
			$mvar_Bidder_Bank=trim($myrow["Bank_Name"]);
			//$mvar_Bidder_Contact=trim($myrow["Banker_Contact"]);
			$mvar_Bidder_Number=trim($myrow["Banker_Contact"]);


if($mvar_Bidder_Number>0)
			{			
			$strmvar_Bidder_Number = "-".$mvar_Bidder_Number;
			}
			else
			{
				$strmvar_Bidder_Number="";
			}
			
			$SMSMessageBidders=$SMSMessageBidders."(".$ctr.") 
			".$mvar_Bidder_Bank."".$strmvar_Bidder_Number." ";
			$ctr=$ctr+1;
			
	  }while ($myrow = mysql_fetch_array($result));
		  mysql_free_result($result);
		  $strmvar_Bidder_Number="";
	}

	if(strlen(trim($SMSMessageBidders))>0)
	{
//		echo $SMSMessage.$SMSMessageBidders."<BR>";
		if(strlen(trim($Phone)) > 0)
		
		{
			SendSMS($SMSMessage.$SMSMessageBidders, $Phone);   
		}

	}

}

/***********************************************************************************************/
//End of Send sms to customers 
/*************************************************************************************************/
?>	