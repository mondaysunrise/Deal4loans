<?php
ini_set('max_execution_time', 600);
//require("scripts/db_main.php");
require 'scripts/db_init.php';
//require 'scripts/db_init-rnew.php';
require 'scripts/functions_nw.php';
define("_TOTAL", 5);
//$logID="";
//ALTER TABLE `Bidders_List` ADD `Bidder_Priority` VARCHAR( 10 ) DEFAULT '1,1,1' NOT NULL ;

main();

function main()
{
echo $getstarttime=date("H:i:s");
    getRequestidpl();
	 echo "<br>".$getendtime=date("H:i:s");
}

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
        6=> 'Req_Business_Loan',
		7=> 'Req_Loan_Gold',
		9=> 'Req_Loan_Education'
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
        'Req_Business_Loan' => 'bl',
		'Req_Loan_Gold' => 'gl',
		'Req_Loan_Education' => 'el'
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
        '6' => 'Business Loan',
		'7' => 'Gold Loan',
		'9' => 'Education Loan'
    );
    foreach ($titles as $key=>$value)
        if($pKey==$key)
        return $value;

    return "";
  }
//

/************************************************
Function for Personal Loan to fetch the data from 
Req_Loan_Personal table. Get all records from Persoanl Loan 
Product Table with condition Allocation field is 
null or zero and Dated between from zero hours 
of the day till current time
************************************************/
//function getRequestidcl Start
function getRequestidpl()
{
	$getpldata="Select RequestID,Bidderid_Details,City,City_Other, Net_Salary, Loan_Amount, DOB, Is_Valid, Employment_Status,source from Req_Loan_Personal where (Allocated =2 and source!='incoming_call' and source!='Businessloan RBl test' and source!='SMS_Lead_Appointment_Model' and source!='mywishbankchat' and source!='mywishbankPL' and source!='Cibil_UAT' and source!='RBLpl_UAT' and (Dated >=DATE_SUB(CURDATE(),INTERVAL 0 DAY)))";
  
 //	$getpldata="Select RequestID,Bidderid_Details,City,City_Other, Net_Salary, Loan_Amount, DOB, Is_Valid, Employment_Status from Req_Loan_Personal where RequestID = 1131560";
    $getplresult = ExecQuery($getpldata);
  	$FieldValue ="";
    while($row = mysql_fetch_array($getplresult))
    {
        $Customerid= $row["RequestID"];
        $telecalled_bidderid= $row["Bidderid_Details"];
		$Employment_Status = $row["Employment_Status"];
		$Customer_Source = $row["source"];
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
		
		//insertLogDataBiddersList($LogID, $Customerid, $City, $ProductID, $FieldName, $FieldValue);
		
		
		getEligibleBiddersList("1",$Customerid,$City,$telecalled_bidderid,$Customer_Source); 
		
		echo  "<br>***************************************************************************<br><br>";
		      
    }
}
//function getRequestidpl End
/********************************************************************
This function is the main function into which we call all the function 
into which we provide a set of bidders in the called function and get 
the output set of bidders 
********************************************************************/
//function getEligibleBiddersList Start
function getEligibleBiddersList($strProduct,$strRequestID,$strCity,$strritebidder,$Customer_Source)
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
    echo "<br>";
 	echo $eligible_bidder_set;
 	echo "<br>";
   
    //echo "<br>".$eligible_bidder_set;
    $eligible_bidder_set_result = ExecQuery($eligible_bidder_set);
	
    $eligible_bidder_set_count = mysql_num_rows($eligible_bidder_set_result);
/*	echo  "<br>";
    echo "Count : ".$eligible_bidder_set_count;
	echo  "<br>";
	echo  "<br>";
	*/
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
			$invresult=ExecQuery($final_query);
			$invrecordcount = mysql_num_rows($invresult);
			if($invrecordcount>0)
			{
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
		}

		$Logid = $GLOBALS['LogID'];
		
		$FieldName = "TotalBidders";
		$FieldValue = implode(",", $FirstList);
	//	insertLogDataBiddersList($Logid, $Customerid, $City, $ProductID, $FieldName, $FieldValue);
			 
		$FieldName = "EligibleBidders";
		$FieldValue = implode(",", $allBiddersSet);
		//insertLogDataBiddersList($Logid, $Customerid, $City, $ProductID, $FieldName, $FieldValue);
				
		$allBiddersSetFilter = array_filter($allBiddersSet, "filter_blank"); 
		$allBiddersSet_String = implode(",", $allBiddersSetFilter);
	
		$BidderAlways = array_filter($Bidders_Always, "filter_blank");
		$Str_Bidders_Always = implode(",", $BidderAlways);
		print_r($Str_Bidders_Always);
		$FieldName = "AlwaysBidders";
		$FieldValue = $Str_Bidders_Always;
	//	insertLogDataBiddersList($Logid, $Customerid, $City, $ProductID, $FieldName, $FieldValue);
		
		
		$BidderAlwaysConflict = array_filter($Bidders_AlwaysConflicting, "filter_blank");
		$Str_BidderAlwaysConflict = implode(";", $BidderAlwaysConflict);
		
		$FieldName = "AlwaysConflictBidders";
		$FieldValue = $Str_BidderAlwaysConflict;
	//	insertLogDataBiddersList($Logid, $Customerid, $City, $ProductID, $FieldName, $FieldValue);
		
		$AlwaysConflictBiddersSet = RetrieveConflictingBidders($Str_BidderAlwaysConflict, $allBiddersSet_String, $product_code);
		echo "<br>Bidders_AlwaysConflicting: ";
		print_r($BidderAlwaysConflict);
		echo $AlwaysConflictBiddersSet;
		echo "<br>";
		
		$BiddersNonConflicting = array_filter($Bidders_NonConflicting, "filter_blank");
		//$BiddersConflicting = array_filter($ExplodeBidders_Conflicting, "filter_blank");
		$Str_BiddersNonConflicting = implode(",",$BiddersNonConflicting );	
		
		$FieldName = "NonConflictingBidders";
		$FieldValue = $Str_BiddersNonConflicting;
		//insertLogDataBiddersList($Logid, $Customerid, $City, $ProductID, $FieldName, $FieldValue);
		
			
		$ExplodeBidders_Conflicting = implode(";", $Bidders_Conflicting);
		$Str_Bidders_Conflicting = explode(";", $ExplodeBidders_Conflicting );
	
		
		$StrBiddersConflicting = array_filter($Str_Bidders_Conflicting, "filter_blank");
		$FirstStrBiddersConflicting = implode(";",$StrBiddersConflicting );
		echo "gfdgdfgd";
		print_r($StrBiddersConflicting);
		print_r($Arr_BidderAlwaysConflict);
		echo "vxccvvcv<br>";
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
		//insertLogDataBiddersList($Logid, $Customerid, $City, $ProductID, $FieldName, $FieldValue);
		
		echo "<br>FinalStrBiddersConflicting : ".$FinalStrBiddersConflicting."<br>";
		if(strlen($FinalStrBiddersConflicting)>0)
		{
			$ConFilictBiddersSet = RetrieveConflictingBidders($FinalStrBiddersConflicting, $allBiddersSet_String, $product_code);
			
			$FieldName = "ConflictingBiddersFinalSet";
			$FieldValue = $ConFilictBiddersSet;
			//insertLogDataBiddersList($Logid, $Customerid, $City, $ProductID, $FieldName, $FieldValue);
		}		
		echo "<br>";	
		echo "////////////////////////////////////";
		echo "<br>Str_Bidders_Always : ".$Str_Bidders_Always;
		echo "<br>Final Conflicting Set : ".$ConFilictBiddersSet;
	//	echo "<br>Str_Bidders_Conflicting : ".$FinalStrBiddersConflicting;
		echo "<br>Str_BiddersNonConflicting : ".$Str_BiddersNonConflicting;
		echo "<br>////////////////////////////////////<br><br>";
		
		//$BidderAlways + $ConFilictBiddersSet + $BiddersNonConflicting
		
		
		$AllocationSetDefination = finalBiddersSet($Str_Bidders_Always, $AlwaysConflictBiddersSet, $Str_BiddersNonConflicting, $ConFilictBiddersSet, $product_code);
		
		$FieldName = "BiddersFinalSet";
		$FieldValue = $AllocationSetDefination;
	//	insertLogDataBiddersList($Logid, $Customerid, $City, $ProductID, $FieldName, $FieldValue);	
		if($BidderAlways[0] >1)
		{
			$AlwayConflict = array_merge($BidderAlways, $ConFilictBiddersSet);
		}
		else 
		{
			$AlwayConflict =$ConFilictBiddersSet;
		}
		if($AlwayConflict[0] >1)
		{
			$AlwayConflictNonConflict = array_merge($AlwayConflict, $BiddersNonConflicting);
		}
		else
		{
			$AlwayConflictNonConflict = $BiddersNonConflicting;
		}
		
		$AlwayConflictNonConflict_Filtered = array_filter($AlwayConflictNonConflict, "filter_blank");
		$AlwayConflictNonConflict_String = implode(",",$AlwayConflictNonConflict_Filtered);
		
		$LeadAllocation = finalAllocation($AllocationSetDefination, $product_code, $requestID, $AlwayConflictNonConflict_String,$Customer_City,$Customer_Source);
		
		$BookKeepingEntry = entryBookKeeping($AllocationSetDefination, $product_code);
	}
	else
	{
		$Logid = $GLOBALS['LogID'];

		$FieldName = "NotEligibleCity";
		$FieldValue = "No Bidders from this City";
	//	insertLogDataBiddersList($Logid, $Customerid, $City, $ProductID, $FieldName, $FieldValue);	
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
	//echo "BidderID : ".$FBidderID."<br>";
	
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
		///////////////////////DAY CAP///////////////////////////
	
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

	//echo "<br>//////Cap Function/////////////".$Bidderid."////////////////////<br>";

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
	echo "<br>//////In function bidderPriority<br>".$SetBidderID."<br>";
	
	$getBidderIDSet = explode(",", $SetBidderID);
	//asort($getBidderIDSet);
	$Priority_Array = array();
	$BidderID_Array = array();
	if(count($getBidderIDSet)>0 && $getBidderIDSet[0])
	{
		for($i=0;$i<count($getBidderIDSet);$i++)
		{
			echo $SqlSelect = "select Bidder_Priority, BidderID from Bidders_List where BidderID='".$getBidderIDSet[$i]."' and Reply_Type=".$Reply_Type;
			$QuerySelect = ExecQuery($SqlSelect);
			
			$Bidder_Priority = @mysql_result($QuerySelect,0,'Bidder_Priority');
			$BidderID = @mysql_result($QuerySelect,0,'BidderID');
			
			$Priority = str_replace(",", "", $Bidder_Priority );
			$BidderID_Array[] = $BidderID;
			$Priority_Array[] = $Priority;
			
		}
	}
	print_r($Priority_Array);
echo "<br>";
	print_r($BidderID_Array);
echo "<br>";

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
		echo "<br>Suffle Bidders---------"; print_r($suffleBidders); echo "------------------<br>";
		$finalBidder = $BidderID_Array[$suffleBidders]; 
		echo "<br>//If ".$finalBidder."<br>";
	}
	else if($countZeroTrue==count($Priority_Array) || $countZeroTrue > count($Priority_Array))
	{
		$suffleBidders = array_rand($BidderID_Array,1);
		echo "<br>Suffle Bidders---------"; print_r($suffleBidders); echo "------------------<br>";
		$finalBidder = $BidderID_Array[$suffleBidders]; 
		echo "<br>//If ".$finalBidder."<br>";
	}
	else
	{	
		asort($Priority_Array);
		
		$keys_priority = array_keys($Priority_Array);
		 
		print_r($keys_priority);
		
		$finalBidder = $BidderID_Array[$keys_priority[0]];
		echo "<br>//Else ".$finalBidder;
		echo "<br>";
	}
	

$finalbidderArr = explode(",",$finalBidder);

$PriorityConflicts = array_diff($BidderID_Array,$finalbidderArr);
$PriorityConflictsStr = implode(",",$PriorityConflicts);
$PriorityConflictsArray = explode(",",$PriorityConflictsStr);

echo "<br>///////// Prior";
print_r($finalbidderArr);
print_r($BidderID_Array);
print_r($PriorityConflictsArray);
echo "///////// Prior/////<br>";
 for($kk=0;$kk<count($PriorityConflictsArray);$kk++)
	{
		//echo "<br>////////////////////<br>";
		$sql = "select Bidder_Priority from Bidders_List where BidderID='".$PriorityConflictsArray[$kk]."' and Reply_Type='".$Reply_Type."'";
		$Query = ExecQuery($sql);
		$Bidder_Priority = @mysql_result($Query,0,'Bidder_Priority');
		echo "<br>BidderPriority".$Bidder_Priority."<br>";
		$Bidder_PriorityArray = @explode(",",$Bidder_Priority); 
		print_r($Bidder_PriorityArray);
		
		$Value3Priority = 0;
		
		$FinalSet = array();
		for($j=1;$j<count($Bidder_PriorityArray);$j++)
		{		
			$position = $j;
			$FinalSet[] = $Bidder_PriorityArray[$position];	
			
		}
		$FinalSet[] = $Value3Priority;
		print_r($FinalSet);
		$FinalSetString = implode(",",$FinalSet);
		//echo "<br>FinalSetString".$FinalSetString."<br>";
		if($PriorityConflictsArray[$kk]>0)
		{
			$UpdatePriority = "update Bidders_List set Bidder_Priority='".$FinalSetString."' where  BidderID='".$PriorityConflictsArray[$kk]."' and Reply_Type='".$Reply_Type."'";
			ExecQuery($UpdatePriority);
		}
		//echo "<br>Conflicting Set : ".$UpdatePriority; 
		//echo "<br>////////////////////<br>";
	}

//	print_r($Priority_Array);
//echo "<br>";
	//echo "//End//In function bidderPriority<br>";
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
echo "<br> All Bidders";
print_r($all_Bidders);

echo "<br> Bidders_Conflicting";
print_r($Bidders_Conflicting);

	echo "<br>";
	//echo "<br>/////CountConflicting///".count($Bidders_Conflicting)."///////////<br>";
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
	echo "<br>/////*****FinalArrayCon*****//////";
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
	
	print_r($ConflictProcess_Array);
	
	for($r=0;$r<count($ConflictProcess_Array);$r++)
	{
		echo $ConflictProcess_Array[$r];
		$finalBidder[] = bidderPriority($ConflictProcess_Array[$r], $ProductType);		
	}

	$final_Bidder = @array_unique($finalBidder);
	$FinalBidders = @implode(",",$final_Bidder);
	print_r($finalBidder);
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
					echo "<br>".$UpdateBKSql."<br>";
                 }
                 else
                 {
                    //Insert
                    $InitialCount = 1;
                    $InsertBKSql = "INSERT INTO Bidders_Book_Keeping ( BidderID , BookProduct , BookDate , BookWeek , BookMonth , BookYear , BookLeadCount, BookEntryTime ) VALUES (".$final[$l].", ".$ProductType.", ".$BK_Day.",".$BK_Week.", ".$BK_Month.", ".$BK_Year.", ".$InitialCount.",Now())";
                   	ExecQuery($InsertBKSql);
					echo "<br>".$InsertBKSql."<br>";
                 }
            }
        }

}
//function entryBookKeeping End

/********************************************************************
 This function inserts the allocation of the leads  
 ********************************************************************/
//function finalAllocation Start
function finalAllocation($BiddersList, $ProductType, $LeadID, $AlwayConflictNonConflict_String,$Customer_City,$Customer_Source)
{

	 $BiddersValue = explode(",", $BiddersList);
	 $AlwayConflictNonConflict_array = explode(",",$AlwayConflictNonConflict_String);
	echo "<br>/////////$$$$$$$$$ BidderList***********//////////<br>";
	print_r($BiddersValue);
	
	 $ConFilictBiddersValue = explode(",", $ConFilictBiddersSet);
	 print_r($ConFilictBiddersValue);
echo "<br>/////////BidderList $$$$$$$$$ ***********//////////<br>";
$recordcountA="";
$BankNameID="";
	 //for($l=0;$l<_TOTAL;$l++)
	 for($l=0;$l<_TOTAL;$l++)
     {   
		$TestRestrictBidder = ExecQuery("select Restrict_Bidder from Bidders_List where  BidderID ='".$BiddersValue[$l]."' and Reply_Type ='".$ProductType."'");
		$RestrictBidderValue = mysql_fetch_array($TestRestrictBidder);   
		
		$alreadyexistingid = ExecQuery("select Feedback_ID from Req_Feedback_Bidder_PL1 where (AllRequestID ='".$LeadID."' and Reply_Type ='".$ProductType."' and BidderID='".$BiddersValue[$l]."') order by Feedback_ID DESC");
		$getalreadyexistingid = mysql_fetch_array($alreadyexistingid); 

	if($getalreadyexistingid[0]>0)
		 {
		 }
		 else
		 {
		if($RestrictBidderValue[0]==1)
		{   
		if($ProductType==1)
			{
				$InsertFeedBackSqlPL = "Insert into Req_Feedback_Bidder_PL1 (AllRequestID,BidderID,Reply_Type,Allocation_Date) Values ('$LeadID', '$BiddersValue[$l]','$ProductType', Now())";
	$InsertFeedBackResultPL = ExecQuery($InsertFeedBackSqlPL);
		}
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

// sms sending code ends here
$BankNameID[] = $BiddersValue[$l]; 
		}
	 }
      }
	 // $BankNameID[] = $BiddersValue[$l]; 
	  //This is call of function to send bidder contact details to customer
		$BankNameID = array_filter($BankNameID, "filter_blank"); 
//$BankNameID = array_unique($BankNameID);

$GetBidderID = implode(',',$BankNameID);
//echo "GetBidderID:: ".$GetBidderID."<br><br>";


	  if(count($BankNameID)>0 && $BankNameID[0]>0)
	{
if($ProductType ==2 || $ProductType ==1 || $ProductType ==5 || $ProductType ==4 || $ProductType ==3 )
	{
		$GetBidderID = implode(',',$BankNameID);
		
		if(strlen($GetBidderID)>0)
		{
			if(strlen(strpos($Customer_Source, "wf -")) > 0)
				{
				}else {
			SendMailToCustomers($GetBidderID,$LeadID,$ProductType);
				}
		}
	}	
}

	 for($ACNCA=0;$ACNCA<count($AlwayConflictNonConflict_array);$ACNCA++)
	{
		echo "<br>////////////////////<br>";
		$sql = "select Bidder_Priority from Bidders_List where BidderID='".$AlwayConflictNonConflict_array[$ACNCA]."' and Reply_Type='".$ProductType."'";
		$Query = ExecQuery($sql);
		$Bidder_Priority = @mysql_result($Query,0,'Bidder_Priority');
		echo "<br>BidderPriority".$Bidder_Priority."<br>";
		$Bidder_PriorityArray = @explode(",",$Bidder_Priority); 
		print_r($Bidder_PriorityArray);
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
		print_r($FinalSet);
		$FinalSetString = implode(",",$FinalSet);
		echo "<br>FinalSetString".$FinalSetString."<br>";
		if($AlwayConflictNonConflict_array[$ACNCA]>0)
		{
			$UpdatePriority = "update Bidders_List set Bidder_Priority='".$FinalSetString."' where  BidderID='".$AlwayConflictNonConflict_array[$ACNCA]."' and Reply_Type='".$ProductType."'";
			ExecQuery($UpdatePriority);
		}
		echo "<br>".$UpdatePriority; 
		echo "<br>////////////////////<br>";
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
	echo "bidder count: ".$updateBidderCount."<br><br>";
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
	
	if($AlwaysSendBiddersFirst_Array[0]>1)
	{
	$AlwaysSendBidders_Array = array_filter(array_unique(array_merge($AlwaysSendBiddersFirst_Array, $AddToAlways)));
	}
	else
	{
		$AlwaysSendBidders_Array = array_filter(array_unique($AddToAlways));
	}

	if($NonConflictingBidders_Array[0]>1)
	{
	$CombineConflicting_NonConflicting = array_unique(array_merge($NonConflictingBidders_Array, $ConflictingBidders_Array));
	}
	else
	{
		$CombineConflicting_NonConflicting = array_unique($ConflictingBidders_Array);
	}
	
	if($CombineConflicting_NonConflicting[0]>1)
	{
	$CombineConflicting_NonConflicting_Always = array_unique(array_merge($CombineConflicting_NonConflicting,$AddToConflict));
	}
	else
	{
		$CombineConflicting_NonConflicting_Always = array_unique($AddToConflict);
	}
		
	$CombineConflictingNonConflictingArray = array_filter($CombineConflicting_NonConflicting_Always, "filter_blank");//Removes blank from the array
	$CombineConflictingNonConflictingString = implode(',',$CombineConflictingNonConflictingArray);
	$CombineConflictingNonConflicting = explode(",", $CombineConflictingNonConflictingString);
	
	
	
	//array used for the final set allocation

	//echo "<br>1. AlwaysSendBidders_Array////".count($AlwaysSendBidders_Array)."//// 2 ConflictingBidders_Array////".count($ConflictingBidders_Array)."//// 3 NonConflictingBidders_Array////".count($NonConflictingBidders_Array)."////"; 

	echo "<br>//////AlwaysSendBidders_Array/////////////";
	print_r($AlwaysSendBidders_Array);
	echo "///////////////////<br>";

	echo "<br>//////AlwaysSendAlwaysBidders_Array/////////////";
	print_r($AddToAlways);
	echo "///////////////////<br>";
	
	echo "<br>//////AlwaysSendConflictBidders_Array/////////////";
	print_r($AddToConflict);
	echo "///////////////////<br>";

	echo "<br>//////ConflictingBidders_Array/////////////";
	print_r($ConflictingBidders_Array);
	echo "///////////////////<br>";

	echo "<br>////NonConflictingBidders_Array/////////////";
	print_r($NonConflictingBidders_Array);
	echo "///////////////////<br>";

	echo "<br>/////////////CombineConflictingNonConflicting//////";
	print_r($CombineConflictingNonConflicting);
	echo "///////////////////<br>";

	$finalbiddercount = count($CombineConflictingNonConflicting);
	
	$AlwaysSendBidders_ArrayCount = count($AlwaysSendBidders_Array);

//echo 	"<br>/////////finalbiddercount ---".$finalbiddercount."/////////AlwaysSendBidders_ArrayCount----".$AlwaysSendBidders_ArrayCount."////////<br>";

	if(($AlwaysSendBidders_ArrayCount ==1) && ( $AlwaysSendBidders_Array[0] < 1 ) )
	{
		$AlwaysSendBidders_ArrayCount = 0;
	}
	
	//echo "<br>///////AlwaysSendBidders_ArrayCount///////".$AlwaysSendBidders_ArrayCount."///////////////<br>";

	if($AlwaysSendBidders_ArrayCount > _TOTAL)
	{
		//Constant _TOTAL is defined at the top of this file
		//condition for bidders if always 1 greater than number of maximum bidders         

//		$rand_keys = shuffle($AlwaysSendBidders_Array);
		
		$rand_keys = array_rand($AlwaysSendBidders_Array, _TOTAL);
		
		for($z=0;$z<_TOTAL;$z++)
		{
			$AlwaysSendBiddersValues =$AlwaysSendBidders_Array[$rand_keys[$z]];
			$FinalAlwaysSendBidders[] = $AlwaysSendBiddersValues;
		}
		
		$final = $FinalAlwaysSendBidders;
	/*	echo "<br>//Line No. 1524//";
		print_r($final);
		echo "//Line No. 1524//////<br>";		
	*/
	}
	
	else if($AlwaysSendBidders_ArrayCount == _TOTAL)
	{
		//Constant _TOTAL is defined at the top of this file
		//condition for bidders if always 1 equal to the number of maximum bidders    
		$final=$AlwaysSendBidders_Array;
	/*	echo "<br>//Line No. 1532//";
		print_r($final);
		echo "//Line No. 1532//////<br>";
	*/
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
//		echo "<br>Else  ".$leftbidder."///////////////////<br>";
		if(($finalbiddercount < $leftbidder) || ($finalbiddercount == $leftbidder))
		{
			
			if($AlwaysSendBidders_Array[0] >= 1)
			{
				$final = array_merge($AlwaysSendBidders_Array, $CombineConflictingNonConflicting);
			}
			else
			{
				$final = $CombineConflictingNonConflicting;
			}
			
			/*
			echo "<br>//Line No. 1551//";
						print_r($final);
					echo "//Line No. 1551//////<br>";
					*/
		}
		else
		{
			$l=$i=$j=0;
			
			for($l=0;$l<count($CombineConflictingNonConflicting);$l++)
			{
				$SelectLastSet ="select Last_set_select,BidderID from Bidders_List where  BidderID ='".$CombineConflictingNonConflicting[$l]."'  and Reply_Type='".$ProductType."'";
				$result = ExecQuery($SelectLastSet);
				/*echo "<br>//Line No.//";
						echo $SelectLastSet;
					echo "//Line No.//////<br>";
					*/
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
				/*	echo "<br>//Line finalbid//";
						echo $finalbid;
					echo "//Line finalbid//////<br>";
			*/
			if($finalbid == $leftbidder)
			{
				if($AlwaysSendBidders_Array[0] >1)
				{
					$final = array_merge($AlwaysSendBidders_Array, $arrbid);
				}
				else
				{
					$final = $arrbid;
				}
				
				/*	echo "<br>//Line No. 1586//";
						print_r($final);
					echo "//Line No. 1586//////<br>";
			*/
			}//close if($finalbid == $leftbidder)
			elseif($finalbid < $leftbidder)
			{
				if($arrbid[0] >l)
				{
					$both = array_merge($arrbid, $arrbidder);
				}
				else
				{
					$both = $arrbidder;
				}

				$merge_array = count($both);
				if(($merge_array == $leftbidder) && ($merge_array < $leftbidder))
				{
					
					if($AlwaysSendBidders_Array[0] >1)
					{
						$final = array_merge($AlwaysSendBidders_Array, $both);
					}
					else
					{
						$final = $both;
					}
		/*			echo "<br>//Line No. 1598//";
						print_r($final);
					echo "//Line No. 1598//////<br>";
			*/	
				}
				elseif($merge_array > $leftbidder)
				{
					$val = $leftbidder;
					//echo "<br>/////leftbidder//////".$val."///////////</br>";
					if($val==1)
						$val=2;
			
					$rand_keys = array_rand($both, $val);
				
					for($j=0;$j<=($leftbidder-1);$j++)
					{
						$randomno[] = $both[$rand_keys[$j]];
					}
					
					$DefineRandomNo = $randomno;
					$random_no = @array_filter($DefineRandomNo, "filter_blank");//Removes blank from the array;
					if($AlwaysSendBidders_Array[0] >1)
					{
						$final = array_merge($AlwaysSendBidders_Array, $random_no);
					}
					else
					{
						$final = $random_no;
					}
			
/*					echo "<br>//Line No. 1620//";
						print_r($final);
					echo "//Line No. 1620//////<br>";
	*/			
			
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
			
				if($AlwaysSendBidders_Array[0] >1)
				{
					$final = array_merge($AlwaysSendBidders_Array, $random_no);
				}
				else
				{
					$final = $random_no;
				}
			
		/*		echo "<br>//Line No. 1640//";
				print_r($final);
				echo "//Line No. 1642//////<br>";
			*/	
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
//echo "<br>////////updateBidderCountinProduct///////////";
	//print_r($final);
	//echo "///////////////////<br>";
$final_d = @array_filter($final, "filter_blank");//Removes blank from the array;	
$final = @array_unique($final_d);
echo "<br>////////Final Set///////////";
	print_r($final);
	echo "///////////////////<br>";
	$FinalSet = @implode(",", $final);
	
	return $FinalSet;
	//
}
//function finalBiddersSet End


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
	$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-1, date("Y"));
	$sms_senddate=date('Y-m-d',$tomorrow);

		$append = "";
		$all_BiddersSet = explode(",", $BiddersList);
		$allBidders_Set = array_filter($all_BiddersSet, "filter_blank"); 	
		if((count($allBidders_Set)==1) && $allBidders_Set[0]>0)
		{
			//$append = " [Exclusive Lead] ";
			$append = "";
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
if($strreply_type==1)
	{
	$fldssms="Feedback_ID,Name,Email,City,Mobile_Number,Net_Salary,Company_Name,Loan_Amount,Add_Comment,Employment_Status,Primary_Acc,Loan_Any,CC_Holder";
	}
	elseif($strreply_type==3)
	{
		$fldssms="Feedback_ID,Name,Email,City,Mobile_Number,Net_Salary,Company_Name,Loan_Amount,Add_Comment,Employment_Status,Car_Model,Car_Type";
	}
	else
	{
$fldssms="Feedback_ID,Name,Email,City,Mobile_Number,Net_Salary,Company_Name,Loan_Amount,Add_Comment,Employment_Status";
	}


if($strreply_type==4)
			{
				$feedback_tble="Req_Feedback_Bidder_CC";
			}
			else
			{
				$feedback_tble="Req_Feedback_Bidder1";
			}


	if((strlen(trim($requestid))<=0))
	{
		if(strlen($City)>0)
		{
			$search_query="SELECT ".$fldssms." FROM ".$feedback_tble.",".$reply_type." LEFT OUTER JOIN Req_Feedback ON Req_Feedback.AllRequestID=".$reply_type.".RequestID AND Req_Feedback.BidderID= ".$strbidderid." WHERE ".$feedback_tble.".AllRequestID= ".$reply_type.".RequestID and ".$feedback_tble.".BidderID = ".$strbidderid." and ".$reply_type.".City in ".$propercity." and (".$feedback_tble.".Allocation_Date >='".$sms_senddate." 00:00:00' and ".$reply_type.".Dated >='".$sms_senddate." 00:00:00') ";

		}
		else{	
		$search_query="SELECT ".$fldssms." FROM ".$feedback_tble.",".$reply_type."  WHERE ".$feedback_tble.".AllRequestID= ".$reply_type.".RequestID and ".$feedback_tble.".BidderID = ".$strbidderid." and (".$feedback_tble.".Allocation_Date >='".$sms_senddate." 00:00:00') ";
		}
	}
	else
	{
		if(strlen($City)>0)
		{
			$search_query="SELECT ".$fldssms." FROM ".$feedback_tble.",".$reply_type." LEFT OUTER JOIN Req_Feedback ON Req_Feedback.AllRequestID=".$reply_type.".RequestID AND Req_Feedback.BidderID= ".$strbidderid." WHERE ".$feedback_tble.".Feedback_ID>'$requestid' and ".$feedback_tble.".AllRequestID= ".$reply_type.".RequestID and ".$feedback_tble.".BidderID = ".$strbidderid." and ".$reply_type.".City in ".$propercity." and (".$feedback_tble.".Allocation_Date >='".$sms_senddate." 00:00:00' and ".$reply_type.".Dated >='".$sms_senddate." 00:00:00') ";
		}
		else
		{
		$search_query="SELECT ".$fldssms." FROM ".$feedback_tble.",".$reply_type." WHERE ".$feedback_tble.".Feedback_ID>'$requestid' and ".$feedback_tble.".AllRequestID= ".$reply_type.".RequestID and ".$feedback_tble.".BidderID = ".$strbidderid." and (".$feedback_tble.".Allocation_Date >='".$sms_senddate." 00:00:00') ";
		}
	}
	echo "query2::".$search_query."<br>";
	$result = ExecQuery($search_query);
	$recorcount = mysql_num_rows($result);
	//echo "get bidder no::".$strmobile_no."<br>";

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
	 $SMSMessage1537="";
	 $SMSMessagecitibank="";
	 $SMSMessage2843="";
	 $SMSMessage2917="";
	 $SMSMegWidBankName="";
	 $appendMsg = ""; 
			
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
			

if($reply_type=="Req_Loan_Personal")
			{
			$message ="Your Personal loan Leads on (".$currentdate.") : ";
		$SMSMessage=$SMSMessage."(".$ctr.") ".$Name."-".$Phone.",Sal- ".$Net_Salary.",Co- ".$Company_Name.",Acc-".$Primary_Acc;

		$SMSMessagefullsp=$SMSMessage."(".$ctr.") ".$Name."-".$Phone.",Sal- ".$Net_Salary.",Co- ".$Company_Name.",Acc-Login Code MA002";

			$SMSMessageful=$SMSMessageful."(".$ctr.") ".$Name."-".$Phone.",Sal- ".$Net_Salary.",Co- ".$Company_Name.",Acc-".$Primary_Acc.",city-".$City.",".$emp_stat;

				$SMSMessagefullteron=$SMSMessagefullteron."(".$ctr.") ".$Name."-".$Phone.",Sal- ".$Net_Salary.",Co- ".$Company_Name.",Acc-".$Primary_Acc.",".$emp_stat;

				$SMSMessage1596=$SMSMessage1596."(".$ctr.") ".$Name."-".$Phone.",Sal- ".$Net_Salary.",Co- ".$Company_Name.",Acc-".$Primary_Acc.",city-".$City;

				$SMSMessage1705=$SMSMessage1705."(".$ctr.") ".$Name."-".$Phone.",Sal- ".$Net_Salary.",Co- ".$Company_Name.",Acc-".$Primary_Acc.",".$strbank_name;

				$SMSMessage1537=$SMSMessage1537."(".$ctr.") ".$Name."-".$Phone.",Sal- ".$Net_Salary.",Co- ".$Company_Name.",Acc-".$Primary_Acc."LA-".$Loan_Amount;

				$SMSMessagecitibank=$SMSMessagecitibank."(".$ctr.") ".$Name."-".$Phone.",Sal- ".$Net_Salary.",Co- ".$Company_Name.",Acc-".$Primary_Acc.",LA- ".$Loan_Amount.",".$City;

				$SMSMessage2917=$SMSMessage2917."(".$ctr.") ".$Name."-".$Phone.",Sal- ".$Net_Salary.",Co- ".$Company_Name.",Acc-".$Primary_Acc.",LA-".$Loan_Amount;

				$SMSMegWidBankName=$SMSMegWidBankName."(".$ctr.") ".$Name."-".$Phone.",Sal- ".$Net_Salary.",Co- ".$Company_Name.",Acc-".$Primary_Acc.", ".$strbank_name;

if($strbidderid=="3003" || $strbidderid=="3002")				{	$cde="TC1";			}
	if($strbidderid=="3801" || $strbidderid=="3654")			{					$cde="TC2";				}
				$SMSMsgforkotak=$SMSMsgforkotak."(".$ctr.") ".$Name."-".$Phone.",Sal- ".$Net_Salary.",Co- ".$Company_Name.",Acc-".$Primary_Acc.",".$cde;
	

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
	if($strbidderid=="1053" || $strbidderid=="1054" || $strbidderid=="1055" || $strbidderid=="1056" || $strbidderid=="1057" || $strbidderid=="1058" || $strbidderid=="2072" || $strbidderid=="2073")
	{
		$selcqry=ExecQuery("Select last_allocated_to,total_no_agents from lead_allocation_table Where BidderID=1053");
		$slcrow = mysql_fetch_array($selcqry);
		$last_allocated_to = $slcrow['last_allocated_to'];
		$total_no_agents = $slcrow['total_no_agents'];
$squnce1 = $total_no_agents - $last_allocated_to;

		if($squnce1 >0)
		{
			$nsequence = $last_allocated_to+1;
			
			$squnce = "TC - ".$nsequence;

			$citimap=ExecQuery("update lead_allocation_table set last_allocated_to='".$nsequence."', total_lead_count='".$request."' where ( BidderId=1053)");
		}
		else
		{     $nsequence=1;
				$squnce =  "TC - 1";
				$n2citimap=ExecQuery("update lead_allocation_table set last_allocated_to='".$nsequence."', total_lead_count='".$request."' where ( BidderId=1053)");
		}

			if(strlen(trim($SMSMessagecitibank))>0)
		{
				//$SMSMessagecitibank=$SMSMessagecitibank.", ".$squnce;


		///	if(strlen(trim($strmobile_no)) > 0)
			// SendSMSforLMS($message.$SMSMessagecitibank, $strmobile_no);
			

		}

	}
	elseif($strbidderid=="1160")
	{
		if(strlen(trim($smsforbidderid1160))>0)
		{
			if(strlen(trim($strmobile_no)) > 0)
			 SendSMSforLMS($message.$smsforbidderid1160, $strmobile_no);

			//if(strlen(trim($mobile_no)) > 0)
			// SendSMS($message.$SMSMessageCiti, $mobile_no);
		}
	}
	elseif ($strbidderid=="2422" || $strbidderid=="2423" || $strbidderid=="2424" || $strbidderid=="2425" || $strbidderid=="3645" || $strbidderid=="2426" || $strbidderid=="2427" || $strbidderid=="2428" || $strbidderid=="2429" || $strbidderid=="3335" || $strbidderid=="2430" || $strbidderid=="2431" || $strbidderid=="2432" || $strbidderid=="2433" || $strbidderid=="2434" || $strbidderid=="2435" || $strbidderid=="2436" || $strbidderid=="2437" || $strbidderid=="2438" || $strbidderid=="2439" || $strbidderid=="2440" || $strbidderid=="2441" || $strbidderid=="2442" || $strbidderid=="2443" || $strbidderid=="2444" || $strbidderid=="2445" || $strbidderid=="2446" || $strbidderid=="2447" || $strbidderid=="2449" || $strbidderid=="2450" || $strbidderid=="2451" || $strbidderid=="2476" || $strbidderid=="3629" || $strbidderid=="3842")
	{
		if(strlen(trim($strmobile_no)) > 0)
			 SendSMSforLMS($message.$SMSMessagecitibank, $strmobile_no);
	}
	elseif($strbidderid=="1110" || $strbidderid=="1111" || $strbidderid=="1112" || $strbidderid=="1113" || $strbidderid=="1114" || $strbidderid=="1115" || $strbidderid=="1116" || $strbidderid=="1482" || $strbidderid=="1483" || $strbidderid=="1477" || $strbidderid=="1476" || $strbidderid=="1447" || $strbidderid=="1466" || $strbidderid=="1631" || $strbidderid=="2943")
	{
		if(strlen(trim($SMSMessagecitifin))>0)
		{
			if(strlen(trim($strmobile_no)) > 0)
			 SendSMSforLMS($message.$SMSMessagecitifin, $strmobile_no);
		}
	}
	else if ($strbidderid=="2917" || $strbidderid=="3254" || $strbidderid=="3255" || $strbidderid=="2962" || $strbidderid=="3256" || $strbidderid =="3257" || $strbidderid =="2983" || $strbidderid =="2984" || $strbidderid =="3258" || $strbidderid =="3259" || $strbidderid=="3061" || $strbidderid =="3132" || $strbidderid =="3133" || $strbidderid =="3134" || $strbidderid=="3195" ||  $strbidderid=="3196" ||  $strbidderid=="3197" ||  $strbidderid=="3198" || $strbidderid=="3199" || $strbidderid=="3216" || $strbidderid=="3241" ||  $strbidderid=="2919" || $strbidderid=="2963" || $strbidderid=="3364" ||  $strbidderid=="3371" || $strbidderid=="3372" || $strbidderid=="3381" || $strbidderid=="3380" || $strbidderid=="3382" || $strbidderid=="3383" || $strbidderid=="2995" || $strbidderid=="3407" || $strbidderid=="3449" || $strbidderid=="3450" || $strbidderid=="3451" || $strbidderid=="3452" || $strbidderid=="3532" || $strbidderid=="3533" || $strbidderid=="3537" || $strbidderid=="3553" || $strbidderid=="3554" || $strbidderid=="3576" || $strbidderid=="3581" || $strbidderid=="3595" || $defrow['BidderID']=="3658" || $strbidderid=="3754" || $strbidderid=="3753" || $strbidderid=="3868" || $strbidderid=="4032" || $strbidderid=="4156")
	{
		if(strlen(trim($SMSMessage2917))>0)
		{
			if(strlen(trim($strmobile_no)) > 0)
			{
			 	$appendMsg = " For ICICI Bank Only";
				SendSMSforLMS($message.$SMSMessage2917.$appendMsg, $strmobile_no);
			} 
			 
		}
		
	}
	else if($strbidderid=="3724" || $strbidderid=="3726" || $strbidderid=="3725" || $strbidderid=="3787" || $strbidderid=="3788")
	{
		if(strlen(trim($SMSMessage))>0)
		{
			if(strlen(trim($strmobile_no)) > 0)
			{
			 	$appendMsg =" For SCB Only";
				SendSMSforLMS($message.$SMSMessage.$appendMsg, $strmobile_no);
			} 
			 
		}
	}
	else if($strbidderid=="3003" || $strbidderid=="3654" || $strbidderid=="3002" || $strbidderid=="3801")
	{	
			if(strlen(trim($strmobile_no)) > 0)
			{
			  	SendSMSforLMS($message.$SMSMsgforkotak, $strmobile_no);
			}
	}
	else if ($strbidderid=="2843" || $strbidderid=="2844" || $strbidderid=="2845" || $strbidderid=="2846" || $strbidderid=="3758" || $strbidderid=="3759")
	{
		if(strlen(trim($SMSMessage2843))>0)
		{
			if(strlen(trim($strmobile_no)) > 0)
			{
			  	$appendMsg = " For PNB Bank Only";
				SendSMSforLMS($message.$SMSMessage2843.$appendMsg, $strmobile_no);
			}
		}

	}
	elseif(($strbidderid=="1510" || $strbidderid=="2941" || $strbidderid=="1930" || $strbidderid=="3650" || $strbidderid=="2790" || $strbidderid=="3698" || $strbidderid=="3692" || $strbidderid=="3691" || $strbidderid=="3433" || $strbidderid=="3652" || $strbidderid=="3716" || $strbidderid=="2986" || $strbidderid=="3828" || $strbidderid=="3169") && ($reply_type=="Req_Loan_Personal") )
	{
		if(strlen(trim($SMSMegWidBankName))>0)
		{
			if(strlen(trim($strmobile_no)) > 0)
			 SendSMSforLMS($message.$SMSMegWidBankName, $strmobile_no);
		}
	}
	elseif($strbidderid=="1537")
	{
		if(strlen(trim($SMSMessage1537))>0)
		{
			if(strlen(trim($strmobile_no)) > 0)
			 SendSMSforLMS($message.$SMSMessage1537, $strmobile_no);
		}
	}
	elseif($strbidderid=="1037" || $strbidderid=="3118")
	{
		if(strlen(trim($SMSMessageful))>0)
		{
			if(strlen(trim($strmobile_no)) > 0)
			 SendSMSforLMS($message.$SMSMessageful, $strmobile_no);
		}
	}
	elseif($strbidderid=="996" || $strbidderid=="997" || $strbidderid=="998" || $strbidderid=="1000" || $strbidderid=="1012" || $strbidderid=="1015" || $strbidderid=="1050")
	{
		if(strlen(trim($SMSMessagefullteron))>0)
		{
			if(strlen(trim($strmobile_no)) > 0)
			 SendSMSforLMS($message.$SMSMessagefullteron, $strmobile_no);
		}
	}
	elseif($strbidderid=="1512")
	{
		if(strlen(trim($SMSMessagefor1512))>0)
			{
				if(strlen(trim($strmobile_no)) > 0)
				 SendSMSforLMS($message.$SMSMessagefor1512, $strmobile_no);
			}
	} 
	elseif($strbidderid=="2973" || $strbidderid=="2974" || $strbidderid=="2975" || $strbidderid=="2932" || $strbidderid=="2930" || $strbidderid=="2896" || $strbidderid=="2933" || $strbidderid=="2929")
	{
		if(strlen(trim($SMSMessage1596))>0)
			{
				if(strlen(trim($strmobile_no)) > 0)
				 SendSMSforLMS($message.$SMSMessage1596, $strmobile_no);
			}
	}
	elseif($strbidderid=="1688")
	{
		if(strlen(trim($SMSMessage1688))>0)
			{
				if(strlen(trim($strmobile_no)) > 0)
				 SendSMSforLMS($message.$SMSMessage1688, $strmobile_no);
			}
	}
	elseif($strbidderid=="2650" || $strbidderid=="2651" || $strbidderid=="2652" || $strbidderid=="2653" || $strbidderid=="2654" || $strbidderid=="2655" || $strbidderid=="2656" || $strbidderid=="2657" || $strbidderid=="2658")
	{
		if(strlen(trim($SMSMessage1596)) > 0)
				 SendSMSforLMS($message.$SMSMessage1596, $strmobile_no);
		
	}
	elseif($strbidderid=="1697")
	{
		if(strlen(trim($SMSMessage1697))>0)
			{
				if(strlen(trim($strmobile_no)) > 0)
				 SendSMSforLMS($message.$SMSMessage1697, $strmobile_no);
			}
	}
	elseif($strbidderid=="1705")
	{
		if(strlen(trim($SMSMessage1705))>0)
			{
				if(strlen(trim($strmobile_no)) > 0)
				 SendSMSforLMS($message.$SMSMessage1705, $strmobile_no);
			}
	}
	elseif($strbidderid=="2721" || $strbidderid=="2722" || $strbidderid=="2809" || $strbidderid=="2723" || $strbidderid=="2830" || $strbidderid=="2937" || $strbidderid=="3208" || $strbidderid=="3359" || $strbidderid=="3376" || $strbidderid=="3390" || $strbidderid=="3579" || $strbidderid=="3601" || $strbidderid=="3600" || $strbidderid=="3602" || $strbidderid=="3722")// added by Upendra 010912
	{
		if(strlen(trim($SMSMessage))>0)
		{
			if(strlen(trim($strmobile_no)) > 0)
			{
				$appendMsg = " For Citibank Only";
				SendSMSforLMS($message.$SMSMessage.$appendMsg, $strmobile_no);
			}
		}
	}	
	elseif($strbidderid=="2718" || $strbidderid=="2730" || $strbidderid=="2719" || $strbidderid=="2852" || $strbidderid=="2958" || $strbidderid=="2720" || $strbidderid=="3082" || $strbidderid=="3129" || $strbidderid=="2835" || $strbidderid=="3291" || $strbidderid=="3299")// added by Upendra 010912
	{
		if(strlen(trim($strmobile_no)) > 0)
		{
			$appendMsg = " For Axis Bank Only";
			SendSMSforLMS($message.$SMSMessage.$appendMsg, $strmobile_no);
		}
	}
	elseif(($strbidderid==1360 || $strbidderid==1361 || $strbidderid==1362 || $strbidderid==1363 || $strbidderid==1372 || $strbidderid==1375 || $strbidderid==1523 || $strbidderid==1524 || $strbidderid==1359 || $strbidderid==1364 || $strbidderid==1365 || $strbidderid==1519 || $strbidderid==1520 || $strbidderid==1521 || $strbidderid==1522 || $strbidderid==1366 || $strbidderid==1367 || $strbidderid==1368 || $strbidderid==1369 || $strbidderid==1515 || $strbidderid==1516 || $strbidderid==1517 || $strbidderid==1371 || $strbidderid==1373 || $strbidderid==1374 || $strbidderid==1376 || $strbidderid==1525 || $strbidderid==1527 || $strbidderid==1029 || $strbidderid==1215 || $strbidderid==1221 || $strbidderid==1222 || $strbidderid==1642 || $strbidderid==1871 || $strbidderid==1872 || $strbidderid==1873 || $strbidderid==1875 || $strbidderid==1876 || $strbidderid==1877 || $strbidderid==1292 || $strbidderid==1432 || $strbidderid==1436 || $strbidderid==1439 || $strbidderid==1204 || $strbidderid==1223 || $strbidderid==1424 || $strbidderid==1425 || $strbidderid==1429 || $strbidderid==1433 || $strbidderid==1435 || $strbidderid==1293 || $strbidderid==1427 || $strbidderid==1428 || $strbidderid==1431 || $strbidderid==1294 || $strbidderid==1423 || $strbidderid==1426 || $strbidderid==1430 || $strbidderid==1434 || $strbidderid==1438 || $strbidderid==1470 || $strbidderid==1471 || $strbidderid==1473 || $strbidderid==1480 || $strbidderid==2295 || $strbidderid==1095 || $strbidderid==1096 || $strbidderid==1098 || $strbidderid==1106 || $strbidderid==1102 || $strbidderid==1105 || $strbidderid==1163 || $strbidderid==1100 || $strbidderid==1103 || $strbidderid==1104 || $strbidderid==1107 || $strbidderid==1379 || $strbidderid==1381 || $strbidderid==1387 || $strbidderid==1384 || $strbidderid==1386 || $strbidderid==1125 || $strbidderid==1378 || $strbidderid==1383 || $strbidderid==1377 || $strbidderid==1686 || $strbidderid==1284 || $strbidderid==1295 || $strbidderid==1287 || $strbidderid==1546 || $strbidderid==1547 || $strbidderid==1548 || $strbidderid==1549 || $strbidderid==1550 || $strbidderid==1551 || $strbidderid==1552 || $strbidderid==1553 || $strbidderid==1554 || $strbidderid==1555 || $strbidderid==1556 || $strbidderid==1557 || $strbidderid==1558 || $strbidderid==1560 || $strbidderid==1561 || $strbidderid==1562 || $strbidderid==1338 || $strbidderid==1339 || $strbidderid==1340 || $strbidderid==1343 || $strbidderid==1347 || $strbidderid==1350 || $strbidderid==1342 || $strbidderid==1344 || $strbidderid==1345 || $strbidderid==1346 || $strbidderid==1453 || $strbidderid==1454 || $strbidderid==1351 || $strbidderid==1353 || $strbidderid==1354 || $strbidderid==1355 || $strbidderid==1356 || $strbidderid==1357 || $strbidderid==1463 || $strbidderid==1464 || $strbidderid==1349 || $strbidderid==1352 || $strbidderid==1358 || $strbidderid==1457 || $strbidderid==1460 || $strbidderid==1461 || $strbidderid==1164 || $strbidderid==1165 || $strbidderid==1162 || $strbidderid==1166 || $strbidderid==1167 || $strbidderid==1168 || $strbidderid==1226 || $strbidderid==1597 || $strbidderid==1598 || $strbidderid==1599 || $strbidderid==1600 || $strbidderid==1603 || $strbidderid==1857 || $strbidderid==1858 || $strbidderid==1859 || $strbidderid==1860 || $strbidderid==1025 || $strbidderid==1675 || $strbidderid==2168 || $strbidderid==2296 || $strbidderid==2297 || $strbidderid==2299 || $strbidderid==2300 || $strbidderid==2301 || $strbidderid==2302 || $strbidderid==2303 || $strbidderid==2304 || $strbidderid==2305 || $strbidderid==2335 || $strbidderid==2336 || $strbidderid==2337 || $strbidderid==2338 || $strbidderid==2339 || $strbidderid==2340 || $strbidderid==2341 || $strbidderid==2342 || $strbidderid==2343 || $strbidderid==2280 || $strbidderid==2281 || $strbidderid==2283 || $strbidderid==2284 || $strbidderid==2286 || $strbidderid==2289 || $strbidderid==2290 || $strbidderid==2291 || $strbidderid==3317 || $strbidderid==3318 || $strbidderid==3319 || $strbidderid==3320 || $strbidderid==3316 || $strbidderid==3315 || $strbidderid==3321 || $strbidderid==3322 || $strbidderid==3323 || $strbidderid==3324 || $strbidderid==3325))
	{
		if(strlen(trim($SMSMessagefullsp))>0)
			{
				if(strlen(trim($strmobile_no)) > 0)
				 SendSMSforLMS($message.$SMSMessagefullsp, $strmobile_no);
			}

	}
	else
	{
	 if($reply_type=="Req_Loan_Home")
		{
			//$rcstrmobile_no=9811215138;
			if(strlen(trim($strmobile_no)) > 0)
			 	SendSMSforLMS($message.$SMSMessage, $strmobile_no);
			//SendSMSforLMS($message.$SMSMessage, $rcstrmobile_no);
		}
		else
		{
		if(strlen(trim($SMSMessage))>0)
		{
			echo "<br>////FinalMessage////// ".$message."-".$SMSMessage."      ///////////<br>";
			//$rcstrmobile_no=9811215138;
			/*
			if(strlen(trim($strmobile_no)) > 0)
			 	SendSMSforLMS($message.$SMSMessage, $strmobile_no);
				//SendSMSforLMS($message.$SMSMessage, $rcstrmobile_no);
			*/
		}
		}
	}
	
	if(($recorcount)>0)
	{
if(strlen($City)>0)
		{
 ExecQuery("update Req_Compaign set RequestID=".$request." where (Reply_Type=".$strreply_type." and Bank_Name='".$strbank_name."' and BidderID=".$strbidderid." and City_Wise='".$City_Wise."' and Sms_Flag=1)" );
 echo "SMS UPDATe<br><br>";
 
		}
		else
		{
ExecQuery("update Req_Compaign set RequestID=".$request." where (Reply_Type=".$strreply_type." and Bank_Name='".$strbank_name."' and BidderID=".$strbidderid." and Sms_Flag=1)" );
		}
	}

}
// Function getleadbysms END


//Function to send send now mailer
function SendMailToCustomers($GetBankID,$CustomerID,$Product)
{
	$GetBidderID = explode(',',$GetBankID);
	$ExpBidderName = "";
	$ExpBidderContact="";
	for($bid=0;$bid<count($GetBidderID);$bid++)	
	{
		$GetBankSql = "select Bidders_List.BidderID AS biddrbid,BankID,Banker_Contact,Bidder_Contact_To_Customers.BidderID AS contbid from Bidders_List LEFT OUTER JOIN Bidder_Contact_To_Customers ON Bidder_Contact_To_Customers.BidderID=Bidders_List.BidderID AND Bidder_Contact_To_Customers.Sms_Flag=1 and Bidder_Contact_To_Customers.Reply_Type=".$Product." where (Bidders_List.BidderID =".$GetBidderID[$bid]." and Bidders_List.Reply_Type =".$Product." )";
		
		$GetBankQuery = ExecQuery($GetBankSql);
		$GetBankCount = mysql_num_rows($GetBankQuery);
		$NameID = mysql_result($GetBankQuery,0,'BankID');
		$BankerContact = mysql_result($GetBankQuery,0,'Banker_Contact');

		if($GetBankCount>0)
		{
			$GetBank_Sql = "select * from Bank_Master where BankID  = ".$NameID ."";
			$GetBank_Query = ExecQuery($GetBank_Sql);
			$BidderName = mysql_result($GetBank_Query,0,'Bank_Name');
			$ExpBidderName[] = $BidderName;
			$ExpBidderContact[] = $BankerContact;
			$bdrBidderID = mysql_result($GetBankQuery,0,'biddrbid');
			$arrbiddrbid[] = $bdrBidderID;

		}
	}

	$Bank_Name = "";
	for($exp=0;$exp<count($ExpBidderName);$exp++)
	{	
		$Count = $exp +1;
		$GetExpBidderContact=" - ".$ExpBidderContact[$exp];
		$Bank_Name[] = "<b>".$ExpBidderName[$exp]."".$GetExpBidderContact."</b><br>";

	}
	$FinalBidderName = implode('',$Bank_Name);
	
	//echo "ranjana2 : " ;
	//print_r($ExpBidderName);
	
	$getproductforemailer=getforemailer($Product);
		
	$TableName = getTableName($Product);
	$GetCustIDSql = "select PL_Tenure,Name,Email,City,Net_Salary,City_Other,Mobile_Number,Direct_Allocation from ".$TableName." where RequestID = ".$CustomerID." ";
	
	
	$GetCustIDQuery = ExecQuery($GetCustIDSql);
	$full_name = mysql_result($GetCustIDQuery,0,'Name');
	$email  = mysql_result($GetCustIDQuery,0,'Email');
	$city  = mysql_result($GetCustIDQuery,0,'City');
	$Net_Salary  = mysql_result($GetCustIDQuery,0,'Net_Salary');
	$Direct_Allocation  = mysql_result($GetCustIDQuery,0,'Direct_Allocation');
		 
	if($city == "Others")
	{
		$city  = mysql_result($GetCustIDQuery,0,'City_Other');
	}
	$mobile_no  = mysql_result($GetCustIDQuery,0,'Mobile_Number');

	if($Product==1)
	{
		$Account_No  = mysql_result($GetCustIDQuery,0,'PL_Tenure');
	}
	else if($Product==3)
	{
		$Account_No  = mysql_result($GetCustIDQuery,0,'Account_No');
	}
	
	$aheadTime  = mktime(date("H"), date("i")+15, 0, date("m")  , date("d"), date("Y"));
$dateFormat15min = date("j M y g:i A", $aheadTime);

	if(((strlen($email)) > 0) && (count($ExpBidderName)>0) ) 
	{
$aheadTime  = mktime(date("H"), date("i")+15, 0, date("m")  , date("d"), date("Y"));
$dateFormat15min = date("j M y g:i A", $aheadTime);

		if($Net_Salary<240000 && ($Direct_Allocation==1))
			{			
			$BidPL = $arrbiddrbid[0];
	$Message = "<table width='100%' border='0' align='center' cellpadding='0' cellspacing='0' style='border:1px ridge #0099FF;'>  <tr>    <td><table width='100%' border='0' cellspacing='0' cellpadding='0'><tr><td width='40%' valign='top'></td><td width='60%' align='right' style='padding-top:5px;'><img src='http://www.deal4loans.com/images/cc/crdt-crd-logo.gif'  /><br />  <span style='font-family: Verdana, Arial, Helvetica, sans-serif;	font-size: 10px; color:#0A71D9;'>Loans by Choice not by Chance!</span></td></tr></table></td></tr><tr><td style='font-family:Verdana; font-size:12px; color:#333333; padding-top:20px; padding-left:10px; padding-right:10px;'><p><b>Dear ".$full_name.",</b></p>
Thank you for choosing Deal4loans.com, we are pleased to inform you that your registration for Personal Loan has been successful. By giving a consent on application form, you have authorized below mentioned banks/agents to call you on $mobile_no even if your number is registered with DNC or DND.<br /><br /> 
<table cellpadding='3' cellspacing='0' border=1><tr><td style='font-family:Verdana,Arial,Helvetica,sans-serif; font-size:11px; font-weight:bold; padding:2px; text-align:center;'>Bank Name</td><td style='font-family:Verdana,Arial,Helvetica,sans-serif; font-size:11px; font-weight:bold; padding:2px; text-align:center;'>Contact</td></tr>";
for($m=0; $m <count($ExpBidderName);$m++)
			{
	$definetypwcl=ExecQuery("select Associated_Bank,BidderID,Define_PrePost,Bidder_Name from Bidders Where (BidderID=".$arrbiddrbid[$m].")");
	$defrowcl=mysql_fetch_array($definetypwcl);
	if($defrowcl['Define_PrePost'] == "PostPaid")
				{
		if($defrowcl['BidderID']=="2917" || $defrowcl['BidderID']=="2962" || $defrowcl['BidderID']=="2984" || $defrowcl['BidderID']=="2995" || $defrowcl['BidderID']=="3061" || $defrowcl['BidderID']=="3132" || $defrowcl['BidderID']=="3133" || $defrowcl['BidderID']=="3196" || $defrowcl['BidderID']=="3197" || $defrowcl['BidderID']=="3198" || $defrowcl['BidderID']=="3199" || $defrowcl['BidderID']=="3380" || $defrowcl['BidderID']=="3381" || $defrowcl['BidderID']=="3407" || $defrowcl['BidderID']=="3451" || $defrowcl['BidderID']=="3532" || $defrowcl['BidderID']=="3533" || $defrowcl['BidderID']=="3553" || $defrowcl['BidderID']=="3554" || $defrowcl['BidderID']=="3595" || $defrowcl['BidderID']=="3658" || $defrowcl['BidderID']=="3868" || $defrowcl['BidderID']=="3944" || $defrowcl['BidderID']=="3945" || $defrowcl['BidderID']=="4032" || $defrowcl['BidderID']=="4126" || $defrowcl['BidderID']=="4127" || $defrowcl['BidderID']=="4156" || $defrowcl['BidderID']=="4242" || $defrowcl['BidderID']=="4292" || $defrowcl['BidderID']=="4293" || $defrowcl['BidderID']=="4299" || $defrowcl['BidderID']=="4300" || $defrowcl['BidderID']=="4301" || $defrowcl['BidderID']=="4316" || $defrowcl['BidderID']=="4317" || $defrowcl['BidderID']=="4318" || $defrowcl['BidderID']=="4319" || $defrowcl['BidderID']=="4352" || $defrowcl['BidderID']=="4353" || $defrowcl['BidderID']=="4354" || $defrowcl['BidderID']=="4388" || $defrowcl['BidderID']=="4398" || $defrowcl['BidderID']=="4399" || $defrowcl['BidderID']=="4411" || $defrowcl['BidderID']=="4412" || $defrowcl['BidderID']=="4413" || $defrowcl['BidderID']=="4416" || $defrowcl['BidderID']=="4417" || $defrowcl['BidderID']=="4459" || $defrowcl['BidderID']=="4460" || $defrowcl['BidderID']=="4461" || $defrowcl['BidderID']=="4549" || $defrowcl['BidderID']=="4550" || $defrowcl['BidderID']=="4555" || $defrowcl['BidderID']=="4568" || $defrowcl['BidderID']=="4569" || $defrowcl['BidderID']=="4588" || $defrowcl['BidderID']=="4668" || $defrowcl['BidderID']=="4669" || $defrowcl['BidderID']=="4670" || $defrowcl['BidderID']=="4671" || $defrowcl['BidderID']=="4672" || $defrowcl['BidderID']=="4701" || $defrowcl['BidderID']=="4712" || $defrowcl['BidderID']=="4713" || $defrowcl['BidderID']=="4798" || $defrowcl['BidderID']=="4807" || $defrowcl['BidderID']=="4815" || $defrowcl['BidderID']=="4829" || $defrowcl['BidderID']=="4872" || $defrowcl['BidderID']=="4873" || $defrowcl['BidderID']=="5114" || $defrowcl['BidderID']=="5117" || $defrowcl['BidderID']=="5118" || $defrowcl['BidderID']=="2721" || $defrowcl['BidderID']=="2722" || $defrowcl['BidderID']=="2723" || $defrowcl['BidderID']=="3722" || $defrowcl['BidderID']=="2809" || $defrowcl['BidderID']=="2830" || $defrowcl['BidderID']=="2937" || $defrowcl['BidderID']=="3208" || $defrowcl['BidderID']=="3359" || $defrowcl['BidderID']=="3376" || $defrowcl['BidderID']=="3390" || $defrowcl['BidderID']=="3579" || $defrowcl['BidderID']=="4238" || $defrowcl['BidderID']=="4494" || $defrowcl['BidderID']=="5164" || $defrowcl['BidderID']=="3900" || $defrowcl['BidderID']=="3724" || $defrowcl['BidderID']=="3725" || $defrowcl['BidderID']=="3726" || $defrowcl['BidderID']=="3787" || $defrowcl['BidderID']=="3788" || $defrowcl['BidderID']=="3870" || $defrowcl['BidderID']=="3968" || $defrowcl['BidderID']=="4054" || $defrowcl['BidderID']=="4055" || $defrowcl['BidderID']=="4056" || $defrowcl['BidderID']=="4889" || $defrowcl['BidderID']=="5322")
				{
$txtvw="Andromeda<br>(As Agent of ".$ExpBidderName[$m].")";
				}
				else
					{
					$txtvw="(Direct Bank Sales Team)";
					}
				}
				else
				{
					if($defrowcl['BidderID']=="2917" || $defrowcl['BidderID']=="2962" || $defrowcl['BidderID']=="2984" || $defrowcl['BidderID']=="2995" || $defrowcl['BidderID']=="3061" || $defrowcl['BidderID']=="3132" || $defrowcl['BidderID']=="3133" || $defrowcl['BidderID']=="3196" || $defrowcl['BidderID']=="3197" || $defrowcl['BidderID']=="3198" || $defrowcl['BidderID']=="3199" || $defrowcl['BidderID']=="3380" || $defrowcl['BidderID']=="3381" || $defrowcl['BidderID']=="3407" || $defrowcl['BidderID']=="3451" || $defrowcl['BidderID']=="3532" || $defrowcl['BidderID']=="3533" || $defrowcl['BidderID']=="3553" || $defrowcl['BidderID']=="3554" || $defrowcl['BidderID']=="3595" || $defrowcl['BidderID']=="3658" || $defrowcl['BidderID']=="3868" || $defrowcl['BidderID']=="3944" || $defrowcl['BidderID']=="3945" || $defrowcl['BidderID']=="4032" || $defrowcl['BidderID']=="4126" || $defrowcl['BidderID']=="4127" || $defrowcl['BidderID']=="4156" || $defrowcl['BidderID']=="4242" || $defrowcl['BidderID']=="4292" || $defrowcl['BidderID']=="4293" || $defrowcl['BidderID']=="4299" || $defrowcl['BidderID']=="4300" || $defrowcl['BidderID']=="4301" || $defrowcl['BidderID']=="4316" || $defrowcl['BidderID']=="4317" || $defrowcl['BidderID']=="4318" || $defrowcl['BidderID']=="4319" || $defrowcl['BidderID']=="4352" || $defrowcl['BidderID']=="4353" || $defrowcl['BidderID']=="4354" || $defrowcl['BidderID']=="4388" || $defrowcl['BidderID']=="4398" || $defrowcl['BidderID']=="4399" || $defrowcl['BidderID']=="4411" || $defrowcl['BidderID']=="4412" || $defrowcl['BidderID']=="4413" || $defrowcl['BidderID']=="4416" || $defrowcl['BidderID']=="4417" || $defrowcl['BidderID']=="4459" || $defrowcl['BidderID']=="4460" || $defrowcl['BidderID']=="4461" || $defrowcl['BidderID']=="4549" || $defrowcl['BidderID']=="4550" || $defrowcl['BidderID']=="4555" || $defrowcl['BidderID']=="4568" || $defrowcl['BidderID']=="4569" || $defrowcl['BidderID']=="4588" || $defrowcl['BidderID']=="4668" || $defrowcl['BidderID']=="4669" || $defrowcl['BidderID']=="4670" || $defrowcl['BidderID']=="4671" || $defrowcl['BidderID']=="4672" || $defrowcl['BidderID']=="4701" || $defrowcl['BidderID']=="4712" || $defrowcl['BidderID']=="4713" || $defrowcl['BidderID']=="4798" || $defrowcl['BidderID']=="4807" || $defrowcl['BidderID']=="4815" || $defrowcl['BidderID']=="4829" || $defrowcl['BidderID']=="4872" || $defrowcl['BidderID']=="4873" || $defrowcl['BidderID']=="5114" || $defrowcl['BidderID']=="5117" || $defrowcl['BidderID']=="5118" || $defrowcl['BidderID']=="2721" || $defrowcl['BidderID']=="2722" || $defrowcl['BidderID']=="2723" || $defrowcl['BidderID']=="3722" || $defrowcl['BidderID']=="2809" || $defrowcl['BidderID']=="2830" || $defrowcl['BidderID']=="2937" || $defrowcl['BidderID']=="3208" || $defrowcl['BidderID']=="3359" || $defrowcl['BidderID']=="3376" || $defrowcl['BidderID']=="3390" || $defrowcl['BidderID']=="3579" || $defrowcl['BidderID']=="4238" || $defrowcl['BidderID']=="4494" || $defrowcl['BidderID']=="5164" || $defrowcl['BidderID']=="3900" || $defrowcl['BidderID']=="3724" || $defrowcl['BidderID']=="3725" || $defrowcl['BidderID']=="3726" || $defrowcl['BidderID']=="3787" || $defrowcl['BidderID']=="3788" || $defrowcl['BidderID']=="3870" || $defrowcl['BidderID']=="3968" || $defrowcl['BidderID']=="4054" || $defrowcl['BidderID']=="4055" || $defrowcl['BidderID']=="4056" || $defrowcl['BidderID']=="4889" || $defrowcl['BidderID']=="5322")
				{
$txtvw="Andromeda<br>(As Agent of ".$ExpBidderName[$m].")";
				}
				else
					{
					$txtvw="As Agent of ".$ExpBidderName[$m];
					}
				}
				$BidCL = $defrowcl['BidderID'];
$Message.="<tr><td width='106' height='24' style='font-family:Verdana,Arial,Helvetica,sans-serif; font-size:11px; font-weight:bold; padding:2px; text-align:center;'>".$defrowcl["Associated_Bank"]."<br>".$txtvw."</td><td width='210' style='font-family:Verdana,Arial,Helvetica,sans-serif; font-size:11px; font-weight:bold; padding:2px; text-align:center;'>".$ExpBidderContact[$m]."</td></tr>";
 }
$Message.="</table>
<br />
<b>You will receive calls within 4 Working Hours from the Bank/NBFC's representatives, you can compare the rates & choose the best deal.</b><br />
1) Hear quote from each bank.<br />
2) Compare EMI & other charges.<br />
3) Apply to the bank which provides you the best offer.<br /><br />
<b>Tips for Best Personal loan deal</b><br />
1) Compare exact Emi | Processing Fee | Tenure| Documents before choosing bank.<br />
2) Never pay any fee to any person to get loan sanctioned. Processing fee is deducted from Loan Amount at the time of loan disbursal.<br />
3) Only give documents to one bank and check whether he is authorized Bank Employee or Vendor.<br /><br />
Please ensure that you process your application with the concerned bank respective only. Do not entertain multiple offers from one single person, compare yourself and choose the best. <br /><br />
Deal4loans do not sell any loans on its own. We act as a online comparison platform to choose the best deal. For any product, process related issue please contact your Bank where you have submitted your application.<br /><br /> 
<span style='font-size:10px;'>In case you do not want to receive calls from any one or more of the following banks then you can cancel the request by clicking on the Deactivate link below within a duration of 15 minutes from the time this mail has been delievered to your inbox. You can change your request only till ".$dateFormat15min."</span><br /></td></tr>";
for($m2=0; $m2 <count($ExpBidderName);$m2++)
			{
	$definetypwcl2=ExecQuery("select BidderID,Define_PrePost,Bidder_Name from Bidders Where (BidderID=".$arrbiddrbid[$m2].")");
	$defrowcl2=mysql_fetch_array($definetypwcl2);
		$BidCL2 = $defrowcl2['BidderID'];
$Message.="<tr><td style='font-family:Verdana; font-size:10px; color:#333333; padding-top:3px ;padding-bottom:3px; padding-left:10px; padding-right:10px;'><a href='http://www.deal4loans.com/personal-loan-customer-consent.php?request_id=".$CustomerID."&noreqd_banks=".$BidCL2."' style='text-decoration:none;'>Deactivate your request for ".$ExpBidderName[$m2]."</a></td></tr>";
			}
$Message.="<tr><td> <table style=' font-family:Verdana; font-size:10px; color:#333333;' cellpadding='0' cellspacing='7'><tr><td>If we do not receive any change in request within a duration of 10 minutes, then as per mentioned above and your consent on website at the time of application will be considered as final and your request will be shared with the above mentioned banks.</td></tr></table></td></tr>
<tr><td style='font-family:Verdana; font-size:12px; color:#333333; padding-top:20px; padding-left:10px; padding-right:10px;'>Disclaimer: The rate quotes offered by the bank representatives are solely on the bank's discretion. We do not hold any responsibility for any miscommunication / misrepresentation given by the Bank/NBFC's sales representative..<br /><br />
Warm Regards,<br />
Team Deal4Loans<br />
</td></tr></table>";
			}
else
			{
	$Message="<table width='100%' border='0' align='center' cellpadding='0' cellspacing='0' style='border:1px ridge #0099FF;'>  <tr>    <td><table width='100%' border='0' cellspacing='0' cellpadding='0'><tr><td width='40%' valign='top'></td><td width='60%' align='right' style='padding-top:5px;'><img src='http://www.deal4loans.com/images/cc/crdt-crd-logo.gif'  /><br />  <span style='font-family: Verdana, Arial, Helvetica, sans-serif;	font-size: 10px; color:#0A71D9;'>Loans by Choice not by Chance!</span></td></tr></table></td></tr><tr><td style='font-family:Verdana; font-size:12px; color:#333333; padding-top:20px; padding-left:10px; padding-right:10px;'><p><b>Dear ".$full_name.",</b></p>
Thank you for choosing Deal4loans.com, we are pleased to inform you that your registration for Personal Loan has been successful. By giving a consent on Call and you have authorized below mentioned banks/agents to call you on $mobile_no even if your number is registered with DNC or DND.<br /><br /> 
<table cellpadding='3' cellspacing='0' border=1><tr><td style='font-family:Verdana,Arial,Helvetica,sans-serif; font-size:11px; font-weight:bold; padding:2px; text-align:center;'>Bank Name</td><td style='font-family:Verdana,Arial,Helvetica,sans-serif; font-size:11px; font-weight:bold; padding:2px; text-align:center;'>Contact</td></tr>";
for($m=0; $m <count($ExpBidderName);$m++)
			{
	$definetypwcl=ExecQuery("select Associated_Bank,BidderID,Define_PrePost,Bidder_Name from Bidders Where (BidderID=".$arrbiddrbid[$m].")");
	$defrowcl=mysql_fetch_array($definetypwcl);
	if($defrowcl['Define_PrePost'] == "PostPaid")
				{
		if($defrowcl['BidderID']=="2917" || $defrowcl['BidderID']=="2962" || $defrowcl['BidderID']=="2984" || $defrowcl['BidderID']=="2995" || $defrowcl['BidderID']=="3061" || $defrowcl['BidderID']=="3132" || $defrowcl['BidderID']=="3133" || $defrowcl['BidderID']=="3196" || $defrowcl['BidderID']=="3197" || $defrowcl['BidderID']=="3198" || $defrowcl['BidderID']=="3199" || $defrowcl['BidderID']=="3380" || $defrowcl['BidderID']=="3381" || $defrowcl['BidderID']=="3407" || $defrowcl['BidderID']=="3451" || $defrowcl['BidderID']=="3532" || $defrowcl['BidderID']=="3533" || $defrowcl['BidderID']=="3553" || $defrowcl['BidderID']=="3554" || $defrowcl['BidderID']=="3595" || $defrowcl['BidderID']=="3658" || $defrowcl['BidderID']=="3868" || $defrowcl['BidderID']=="3944" || $defrowcl['BidderID']=="3945" || $defrowcl['BidderID']=="4032" || $defrowcl['BidderID']=="4126" || $defrowcl['BidderID']=="4127" || $defrowcl['BidderID']=="4156" || $defrowcl['BidderID']=="4242" || $defrowcl['BidderID']=="4292" || $defrowcl['BidderID']=="4293" || $defrowcl['BidderID']=="4299" || $defrowcl['BidderID']=="4300" || $defrowcl['BidderID']=="4301" || $defrowcl['BidderID']=="4316" || $defrowcl['BidderID']=="4317" || $defrowcl['BidderID']=="4318" || $defrowcl['BidderID']=="4319" || $defrowcl['BidderID']=="4352" || $defrowcl['BidderID']=="4353" || $defrowcl['BidderID']=="4354" || $defrowcl['BidderID']=="4388" || $defrowcl['BidderID']=="4398" || $defrowcl['BidderID']=="4399" || $defrowcl['BidderID']=="4411" || $defrowcl['BidderID']=="4412" || $defrowcl['BidderID']=="4413" || $defrowcl['BidderID']=="4416" || $defrowcl['BidderID']=="4417" || $defrowcl['BidderID']=="4459" || $defrowcl['BidderID']=="4460" || $defrowcl['BidderID']=="4461" || $defrowcl['BidderID']=="4549" || $defrowcl['BidderID']=="4550" || $defrowcl['BidderID']=="4555" || $defrowcl['BidderID']=="4568" || $defrowcl['BidderID']=="4569" || $defrowcl['BidderID']=="4588" || $defrowcl['BidderID']=="4668" || $defrowcl['BidderID']=="4669" || $defrowcl['BidderID']=="4670" || $defrowcl['BidderID']=="4671" || $defrowcl['BidderID']=="4672" || $defrowcl['BidderID']=="4701" || $defrowcl['BidderID']=="4712" || $defrowcl['BidderID']=="4713" || $defrowcl['BidderID']=="4798" || $defrowcl['BidderID']=="4807" || $defrowcl['BidderID']=="4815" || $defrowcl['BidderID']=="4829" || $defrowcl['BidderID']=="4872" || $defrowcl['BidderID']=="4873" || $defrowcl['BidderID']=="5114" || $defrowcl['BidderID']=="5117" || $defrowcl['BidderID']=="5118" || $defrowcl['BidderID']=="2721" || $defrowcl['BidderID']=="2722" || $defrowcl['BidderID']=="2723" || $defrowcl['BidderID']=="3722" || $defrowcl['BidderID']=="2809" || $defrowcl['BidderID']=="2830" || $defrowcl['BidderID']=="2937" || $defrowcl['BidderID']=="3208" || $defrowcl['BidderID']=="3359" || $defrowcl['BidderID']=="3376" || $defrowcl['BidderID']=="3390" || $defrowcl['BidderID']=="3579" || $defrowcl['BidderID']=="4238" || $defrowcl['BidderID']=="4494" || $defrowcl['BidderID']=="5164" || $defrowcl['BidderID']=="3900" || $defrowcl['BidderID']=="3724" || $defrowcl['BidderID']=="3725" || $defrowcl['BidderID']=="3726" || $defrowcl['BidderID']=="3787" || $defrowcl['BidderID']=="3788" || $defrowcl['BidderID']=="3870" || $defrowcl['BidderID']=="3968" || $defrowcl['BidderID']=="4054" || $defrowcl['BidderID']=="4055" || $defrowcl['BidderID']=="4056" || $defrowcl['BidderID']=="4889" || $defrowcl['BidderID']=="5322")
				{
$txtvw="Andromeda<br>(As Agent of ".$ExpBidderName[$m].")";
				}
				else
					{
					$txtvw="(Direct Bank Sales Team)";
					}
				}
				else
				{
					if($defrowcl['BidderID']=="2917" || $defrowcl['BidderID']=="2962" || $defrowcl['BidderID']=="2984" || $defrowcl['BidderID']=="2995" || $defrowcl['BidderID']=="3061" || $defrowcl['BidderID']=="3132" || $defrowcl['BidderID']=="3133" || $defrowcl['BidderID']=="3196" || $defrowcl['BidderID']=="3197" || $defrowcl['BidderID']=="3198" || $defrowcl['BidderID']=="3199" || $defrowcl['BidderID']=="3380" || $defrowcl['BidderID']=="3381" || $defrowcl['BidderID']=="3407" || $defrowcl['BidderID']=="3451" || $defrowcl['BidderID']=="3532" || $defrowcl['BidderID']=="3533" || $defrowcl['BidderID']=="3553" || $defrowcl['BidderID']=="3554" || $defrowcl['BidderID']=="3595" || $defrowcl['BidderID']=="3658" || $defrowcl['BidderID']=="3868" || $defrowcl['BidderID']=="3944" || $defrowcl['BidderID']=="3945" || $defrowcl['BidderID']=="4032" || $defrowcl['BidderID']=="4126" || $defrowcl['BidderID']=="4127" || $defrowcl['BidderID']=="4156" || $defrowcl['BidderID']=="4242" || $defrowcl['BidderID']=="4292" || $defrowcl['BidderID']=="4293" || $defrowcl['BidderID']=="4299" || $defrowcl['BidderID']=="4300" || $defrowcl['BidderID']=="4301" || $defrowcl['BidderID']=="4316" || $defrowcl['BidderID']=="4317" || $defrowcl['BidderID']=="4318" || $defrowcl['BidderID']=="4319" || $defrowcl['BidderID']=="4352" || $defrowcl['BidderID']=="4353" || $defrowcl['BidderID']=="4354" || $defrowcl['BidderID']=="4388" || $defrowcl['BidderID']=="4398" || $defrowcl['BidderID']=="4399" || $defrowcl['BidderID']=="4411" || $defrowcl['BidderID']=="4412" || $defrowcl['BidderID']=="4413" || $defrowcl['BidderID']=="4416" || $defrowcl['BidderID']=="4417" || $defrowcl['BidderID']=="4459" || $defrowcl['BidderID']=="4460" || $defrowcl['BidderID']=="4461" || $defrowcl['BidderID']=="4549" || $defrowcl['BidderID']=="4550" || $defrowcl['BidderID']=="4555" || $defrowcl['BidderID']=="4568" || $defrowcl['BidderID']=="4569" || $defrowcl['BidderID']=="4588" || $defrowcl['BidderID']=="4668" || $defrowcl['BidderID']=="4669" || $defrowcl['BidderID']=="4670" || $defrowcl['BidderID']=="4671" || $defrowcl['BidderID']=="4672" || $defrowcl['BidderID']=="4701" || $defrowcl['BidderID']=="4712" || $defrowcl['BidderID']=="4713" || $defrowcl['BidderID']=="4798" || $defrowcl['BidderID']=="4807" || $defrowcl['BidderID']=="4815" || $defrowcl['BidderID']=="4829" || $defrowcl['BidderID']=="4872" || $defrowcl['BidderID']=="4873" || $defrowcl['BidderID']=="5114" || $defrowcl['BidderID']=="5117" || $defrowcl['BidderID']=="5118" || $defrowcl['BidderID']=="2721" || $defrowcl['BidderID']=="2722" || $defrowcl['BidderID']=="2723" || $defrowcl['BidderID']=="3722" || $defrowcl['BidderID']=="2809" || $defrowcl['BidderID']=="2830" || $defrowcl['BidderID']=="2937" || $defrowcl['BidderID']=="3208" || $defrowcl['BidderID']=="3359" || $defrowcl['BidderID']=="3376" || $defrowcl['BidderID']=="3390" || $defrowcl['BidderID']=="3579" || $defrowcl['BidderID']=="4238" || $defrowcl['BidderID']=="4494" || $defrowcl['BidderID']=="5164" || $defrowcl['BidderID']=="3900" || $defrowcl['BidderID']=="3724" || $defrowcl['BidderID']=="3725" || $defrowcl['BidderID']=="3726" || $defrowcl['BidderID']=="3787" || $defrowcl['BidderID']=="3788" || $defrowcl['BidderID']=="3870" || $defrowcl['BidderID']=="3968" || $defrowcl['BidderID']=="4054" || $defrowcl['BidderID']=="4055" || $defrowcl['BidderID']=="4056" || $defrowcl['BidderID']=="4889" || $defrowcl['BidderID']=="5322")
					{
						$txtvw="Andromeda<br>(As Agent of ".$ExpBidderName[$m].")";
					}
					else
					{
					$txtvw="As Agent of ".$ExpBidderName[$m];
					}
				}
				$BidCL = $defrowcl['BidderID'];
$Message.="<tr><td width='106' height='24' style='font-family:Verdana,Arial,Helvetica,sans-serif; font-size:11px; font-weight:bold; padding:2px; text-align:center;'>".$defrowcl["Associated_Bank"]."<br>".$txtvw."</td><td width='210' style='font-family:Verdana,Arial,Helvetica,sans-serif; font-size:11px; font-weight:bold; padding:2px; text-align:center;'>".$ExpBidderContact[$m]."</td></tr>";
 }
$Message.="</table>
<br />
<b>You will receive calls within 4 Working Hours from the Bank/NBFC’s representatives, you can compare the rates & choose the best deal. </b><br />
1) Hear quote from each bank.<br />
2) Compare EMI & other charges.<br />
3) Apply to the bank which provides you the best offer.<br /><br />
<b>Tips for Best Personal loan deal</b><br />
1) Compare exact Emi | Processing Fee | Tenure| Documents before choosing bank.<br />
2) Never pay any fee to any person to get loan sanctioned. Processing fee is deducted from Loan Amount at the time of loan disbursal.<br />
3) Only give documents to one bank and check whether he is authorized Bank employee or vendor.<br /><br />
Please ensure that you process your application with the concerned bank respective only. Do not entertain multiple offers from one single person, compare yourself and choose the best. <br /><br />
Deal4loans do not sell any loans on its own. We act as a online comparison platform to choose the best deal. For any product, process related issue please contact your Bank where you have submitted your application.<br /><br /> 
<span style='font-size:10px;'>In case you do not want to receive calls from any one or more of the following banks then you can cancel the request by clicking on the Deactivate button below within a duration of 15 minutes from the time this mail has been delievered to your inbox. You can change your request only till ".$dateFormat15min."</span><br /></td></tr>";
for($m2=0; $m2 <count($ExpBidderName);$m2++)
			{
	$definetypwcl2=ExecQuery("select BidderID,Define_PrePost,Bidder_Name from Bidders Where (BidderID=".$arrbiddrbid[$m2].")");
	$defrowcl2=mysql_fetch_array($definetypwcl2);
		$BidCL2 = $defrowcl2['BidderID'];
$Message.="<tr><td style='font-family:Verdana; font-size:10px; color:#333333; padding-top:3px ;padding-bottom:3px; padding-left:10px; padding-right:10px;'><a href='http://www.deal4loans.com/personal-loan-customer-consent.php?request_id=".$CustomerID."&noreqd_banks=".$BidCL2."' style='text-decoration:none;'>Deactivate your request for ".$ExpBidderName[$m2]."</a></td></tr>";
			}
$Message.="<tr><td> <table style=' font-family:Verdana; font-size:10px; color:#333333;' cellpadding='0' cellspacing='7'><tr><td>If we do not receive any change in request within a duration of 10 minutes, then as per mentioned above and your consent on website at the time of application will be considered as final and your request will be shared with the above mentioned banks.</td></tr></table></td></tr>
<tr><td style='font-family:Verdana; font-size:12px; color:#333333; padding-top:20px; padding-left:10px; padding-right:10px;'>Disclaimer: The rate quotes offered by the bank representatives are solely on the bank's discretion. We do not hold any responsibility for any miscommunication / misrepresentation given by the Bank/NBFC's sales representative.<br /><br />
Warm Regards,<br />
Team Deal4Loans
</td></tr></table>";
			}


/////////////////////////////////////////////////////////////
			
			
	//echo $messagecc;
	/*$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	//$headers .= 'To: '.$full_name.' ' . "\r\n";
	$headers .= 'From: deal4loans <no-reply@deal4loans.com>' . "\r\n";
	$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
	$headers .= 'Bcc: extra4testingnew@gmail.com' . "\r\n";*/
		$headers = "From: deal4loans <no-reply@deal4loans.com>";
		$semi_rand = md5( time() ); 
		$mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 
		$headers .= "\nMIME-Version: 1.0\n" . 
		"Content-Type: multipart/mixed;\n" . 
		" boundary=\"{$mime_boundary}\""."\n";
		$headers .= "Bcc: extra4testingnew@gmail.com "."\n";
		

		$message = "This is a multi-part message in MIME format.\n\n" . 
		"--{$mime_boundary}\n" . 
		"Content-Type: text/html; charset=\"iso-8859-1\"\n" . 
		"Content-Transfer-Encoding: 7bit\n\n" . 
		$Message . "\n\n";
	
		mail($email,'Thanks for Registering for '.$getproductforemailer.' on deal4loans.com', $message, $headers);
	
	
	}

	//echo $Message;	
}			  


?>	