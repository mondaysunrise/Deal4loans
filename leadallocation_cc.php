<?php
ini_set('max_execution_time', 600);
require 'scripts/db_init.php';
require 'scripts/functions_nw.php';
define("_TOTAL", 4);

main();

function main()
{
echo $getstarttime=date("H:i:s");
    getRequestidcc();
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

/********************************************************************
Function for Credit Card to fetch the data from Req_Credit_Card table 
get all records from Credit Card Product Table with condition Allocation 
field is null or zero and Dated between from zero hours of the day till
current time 
*********************************************************************/
//function getRequestidcc Start
function getRequestidcc()
{
	//$getccdata="Select  RequestID, Bidderid_Details, City, City_Other, Net_Salary, Loan_Amount, DOB, Is_Valid, Employment_Status from Req_Credit_Card where (((Allocated=0 AND Bidderid_Details ='') and ( Dated >=DATE_SUB(CURDATE(),INTERVAL 0 DAY)) and source not in ('BnnrCmpgn_CC','komlicc')) or ((Allocated=2 AND Bidderid_Details !='') and ( Updated_Date >=DATE_SUB(CURDATE(),INTERVAL 0 DAY))))";
	//$getccdata="Select  RequestID, Bidderid_Details, City, City_Other, Net_Salary, Loan_Amount, DOB, Is_Valid, Employment_Status from Req_Credit_Card where (((Allocated=0 AND Bidderid_Details ='') and (Dated between '2014-10-11 15:00:00' and '2014-10-11 23:59:59')) and source not in ('BnnrCmpgn_CC','komlicc'))";

	$getccdata="Select  RequestID, Bidderid_Details, City, City_Other, Net_Salary, Loan_Amount, DOB, Is_Valid, Employment_Status from Req_Credit_Card where (((Allocated=0 AND Bidderid_Details ='')  and Mobile_Number!='9971396361' and ( Updated_Date >=DATE_SUB(CURDATE(),INTERVAL 0 DAY)) and source not in ('sbitest', 'sbi_cards_apply', 'simply_save_cards_apply', 'sbi_cards_application',  'BnnrCmpgn_CC', 'komlicc','SMS_Lead', 'CITIBANK_UAT', 'UAT_SCBCARDS', 'UAT_AMEXCARDS', 'SMS_LeadNew','SMS_Lead_ICCS', 'Sms', 'SMS_Lead_RBL', 'SBI_HL_LEAD', 'WF-SBI_HL_LEAD','UAT_YESBANK','SMS_Digi_Lead_AMEX', 'SMS_Digi_Lead_RBL','SMS_Digi_Lead_SBI','SMS_Lead_AMEX','SMS_Internal_Lead_AMEX', 'SMS_Internal_Lead_RBL', 'SMS_Lead_YesBank', 'SMS_Digi_Lead_YesBank', 'Wishfin_Whatsapp_Leads', 'wf_zbl_leads')) or ((Allocated=2 AND Bidderid_Details !='') and Mobile_Number!='9971396361' and ( Updated_Date >=DATE_SUB(CURDATE(),INTERVAL 0 DAY))))";

	//$getccdata="Select  RequestID, Bidderid_Details, City, City_Other, Net_Salary, Loan_Amount, DOB, Is_Valid, Employment_Status from Req_Credit_Card where (((Allocated=2 AND Bidderid_Details !='') and ( Updated_Date >=DATE_SUB(CURDATE(),INTERVAL 0 DAY))))";

//	$getccdata="Select  RequestID, Bidderid_Details, City, City_Other, Net_Salary, Loan_Amount, DOB, Is_Valid, Employment_Status from Req_Credit_Card where	RequestID=637176";

 
	 $getccresult = ExecQuery($getccdata);
    while($row = mysql_fetch_array($getccresult))
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

        if($row["City"]=="Others" && strlen($row["City_Other"])>0)
        {
            $City= $row["City_Other"];
        }
        else
        {
            $City= $row["City"];
        }

		//echo "City : ".$City;
		echo  "<br><br>*********************************************************************<br>";
		echo "City : ".$City;
		echo "//////Customerid : ".$Customerid;
		echo "//////Product : Credit Card";
		echo  "<br>";
		
		$ProductID = 4;
				
		getEligibleBiddersList("4",$Customerid,$City,$telecalled_bidderid); 
		
		echo  "<br>***************************************************************************<br><br>";

    }
	
}
//function getRequestidcc End
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
		
		$LeadAllocation = finalAllocation($AllocationSetDefination, $product_code, $requestID, $AlwayConflictNonConflict_String,$Customer_City);
		
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
function finalAllocation($BiddersList, $ProductType, $LeadID, $AlwayConflictNonConflict_String,$Customer_City)
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
	 for($l=0;$l<_TOTAL;$l++)
     {   
		$TestRestrictBidder = ExecQuery("select Restrict_Bidder from Bidders_List where  BidderID ='".$BiddersValue[$l]."' and Reply_Type ='".$ProductType."'");
		$RestrictBidderValue = mysql_fetch_array($TestRestrictBidder);   
		
		if($RestrictBidderValue[0]==1)
		{   
			if($BiddersValue[$l]=="3662" || $BiddersValue[$l]=="3663" || $BiddersValue[$l]=="3664" || $BiddersValue[$l]=="3665" || $BiddersValue[$l]=="3666" || $BiddersValue[$l]=="3778" || $BiddersValue[$l]=="3820" || $BiddersValue[$l]=="3821" || $BiddersValue[$l]=="3822" || $BiddersValue[$l]=="3823" || $BiddersValue[$l]=="4499" || $BiddersValue[$l]=="4500" || $BiddersValue[$l]=="4501" || $BiddersValue[$l]=="4502" || $BiddersValue[$l]=="4503")
			{
				$InsertFeedBackSql = "Insert into Req_Feedback_Bidder1 (AllRequestID,BidderID,Reply_Type,Allocation_Date) Values ('".$LeadID."', '".$BiddersValue[$l]."','".$ProductType."', Now())";
				$InsertFeedBackResult = ExecQuery($InsertFeedBackSql);

				$InsertFeedBackSqlCC = "Insert into Req_Feedback_Bidder_CC (AllRequestID,BidderID,Reply_Type,Allocation_Date) Values ('$LeadID', '$BiddersValue[$l]','$ProductType', Now())";
				$varibleforICICI=1;
			}
			else
			{
			$InsertFeedBackSqlCC = "Insert into Req_Feedback_Bidder_CC1 (AllRequestID,BidderID,Reply_Type,Allocation_Date) Values ('$LeadID', '$BiddersValue[$l]','$ProductType', Now())";
			$varibleforICICI=0;
			}
	$InsertFeedBackResultCC = ExecQuery($InsertFeedBackSqlCC);
		
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
	 // $BankNameID[] = $BiddersValue[$l]; 
	  //This is call of function to send bidder contact details to customer
		$BankNameID = array_filter($BankNameID, "filter_blank"); 
//$BankNameID = array_unique($BankNameID);

$GetBidderID = implode(',',$BankNameID);
echo "GetBidderID:: ".$GetBidderID."<br><br>";

	if(count($BankNameID)>0 && $BankNameID[0]>0)
	{
		if($ProductType ==2 || $ProductType ==1 || $ProductType ==5 || $ProductType ==4 || $ProductType ==3 )
		{
			$GetBidderID = implode(',',$BankNameID);
			
			if(strlen($GetBidderID)>0)
			{
				if($varibleforICICI==1)
				{
					SendMailToCustomersFORICICI($GetBidderID,$LeadID,$ProductType);
				}
				else
				{
					echo "<br>".$GetBidderID.", ".$LeadID.", ".$ProductType."<br>";
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
			//$Query = ExecQuery($Sql);
		}	
		//echo	"<BR>".	$Sql."<br>";
	}
	else
	{
		//insert $LeadID, $ProductID
		
		$Sql = "insert into Logxy (LeadID, ProductID, City, AgeLoanSalValidEmpStat, Dated) values ('".$LeadID."', '".$ProductID."', '".$City."', '".$FieldValue."', Now())";
		//$Query = ExecQuery($Sql);
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

//Function to send send now mailer
function SendMailToCustomers($GetBankID,$CustomerID,$Product)
{
	$GetBidderID = explode(',',$GetBankID);
	$ExpBidderName = "";
	$ExpBidderContact="";
	$ExpBidderID = "";
	for($bid=0;$bid<count($GetBidderID);$bid++)	
	{
		$GetBankSql = "select Bidders_List.BidderID AS biddrbid,BankID,Banker_Contact,Bidder_Contact_To_Customers.BidderID AS contbid from Bidders_List LEFT OUTER JOIN Bidder_Contact_To_Customers ON Bidder_Contact_To_Customers.BidderID=Bidders_List.BidderID AND Bidder_Contact_To_Customers.Sms_Flag=1 and Bidder_Contact_To_Customers.Reply_Type=".$Product." where (Bidders_List.BidderID =".$GetBidderID[$bid]." and Bidders_List.Reply_Type =".$Product." )";
		$ExpBidderID[] = $GetBidderID[$bid];
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
	if($Product==1)
	{
		$GetCustIDSql = "select PL_Tenure,Name,Email,City,Net_Salary,City_Other,Mobile_Number from ".$TableName." where RequestID = ".$CustomerID." ";
	}
	else if($Product==3)
	{
	$GetCustIDSql = "select Account_No,Name,Email,City,Net_Salary,City_Other,Mobile_Number from ".$TableName." where RequestID = ".$CustomerID." ";
	}
	else
	{
		$GetCustIDSql = "select Name,Email,City,Net_Salary,City_Other,Mobile_Number from ".$TableName." where RequestID = ".$CustomerID." ";
	}
	
	$GetCustIDQuery = ExecQuery($GetCustIDSql);
	$full_name = mysql_result($GetCustIDQuery,0,'Name');
	$email  = mysql_result($GetCustIDQuery,0,'Email');
	$city  = mysql_result($GetCustIDQuery,0,'City');
	$Net_Salary  = mysql_result($GetCustIDQuery,0,'Net_Salary');
		 
	if($city == "Others")
	{
		$city  = mysql_result($GetCustIDQuery,0,'City_Other');
	}
	$mobile_no  = mysql_result($GetCustIDQuery,0,'Mobile_Number');
	
	if(((strlen($email)) > 0) && (count($ExpBidderName)>0) ) 
	{
		$aheadTime  = mktime(date("H"), date("i")+15, 0, date("m")  , date("d"), date("Y"));
		$dateFormat15min = date("j M y g:i A", $aheadTime);
		$messagecc="<table width='100%' border='0' align='center' cellpadding='0' cellspacing='0' style='border:1px ridge #0099FF;'>  <tr>    <td><table width='100%' border='0' cellspacing='0' cellpadding='0'><tr><td width='40%' valign='top'></td><td width='60%' align='right' style='padding-top:5px;'><img src='http://www.deal4loans.com/images/cc/crdt-crd-logo.gif'  /><br />  <span style='font-family: Verdana, Arial, Helvetica, sans-serif;	font-size: 10px;	color:#0A71D9;'>Loans by Choice not by Chance!</span></td></tr></table></td></tr><tr><td style=' font-family:Verdana; font-size:12px; color:#333333; padding-top:20px; padding-left:10px; padding-right:10px;'><p><b>Dear  $full_name,</b></p> <p>
Thank you for choosing Deal4loans.com, we are pleased to inform you that your request for credit card has been successful.<br /><br />
You are eligible with following banks and your request is being forwarded to these banks for them to call you on <mobile no.> even if your number is registered with DNC or DND. <br /><br />
In case you do not want to receive calls from any one or more of the following banks then you can cancel the request by clicking on the cancel button within a duration of 15 minutes from the time this mail has been delievered to your inbox. You can change your request only till ".$dateFormat15min."<br /><br /></p><p><table cellpadding='0' cellspacing='0' width='100%' border='1'><tr><td height='27' width='250' bgcolor='#494949' style='color:#FFFFFF; font-family:Verdana,Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold; padding:5px; text-align:center;'>Bank Name</td><td width='280' bgcolor='#494949' style='color:#FFFFFF; font-family:Verdana, Arial,Helvetica,sans-serif; font-size:11px; font-weight:bold; padding:2px; text-align:center;'>&nbsp;</td></tr>";
		
		for($exp=0;$exp<count($ExpBidderName);$exp++)
		{	
			$messagecc.="<tr><td height='24' style='font-family:Verdana,Arial,Helvetica,sans-serif; font-size:11px; font-weight:bold; padding:2px; text-align:center;'>".$ExpBidderName[$exp]."</td><td style='font-family:Verdana,Arial,Helvetica,sans-serif; font-size:11px;padding:2px; '><a href='http://www.deal4loans.com/credit-card-customer-consent.php?request_id=".$CustomerID."&noreqd_banks=".$ExpBidderID[$exp]."' style='text-decoration:none;'>Deactivate your request for ".$ExpBidderName[$exp]."</a></td></tr>";
		}
		$messagecc.="</table> <br>";
		$messagecc.="<br /> You will receive calls within 24 hours from the Companies executives, you can compare & choose the best deal.</p></td></tr><tr><td>&nbsp;</td></tr><tr>  <td>&nbsp;</td></tr><tr><td><p>Warm Regards,<br />Team Deal4Loans<br /></p> </td></tr>  <tr><td style=' font-family:Verdana; font-size:12px; color:#ffffff;  padding-left:10px; padding-right:10px; background-color:#248ACA; border-top:1px solid  #0099CC;'><table width='100%' border='0' cellspacing='0' cellpadding='0'> <tr><td align='center' valign='middle'><a href='http://www.deal4loans.com/Contents_Blogs.php?source=d4l-aug08' style=' font-family:Verdana;  color:#ffffff; '>Blogs</a> </td><td align='center' valign='middle'> <a href='http://www.deal4loans.com/quiz.php?source=d4l-sendnow' style=' font-family:Verdana;  color:#ffffff;   '>Loan Quiz</a></td><td align='center' valign='middle'> <a href='http://www.deal4loans.com/debt-consolidation-plans.php?source=d4l-sendnow' style=' font-family:Verdana;  color:#ffffff;   '>Loan Guru </a></td><td height='25' align='center' valign='middle'> <a href='http://www.bimadeals.com?source=d4l-sendnow' style=' font-family:Verdana;  color:#ffffff;'>Bimadeals.com </a></td><td align='center' valign='middle'>&nbsp;</td> <td valign='middle'>&nbsp;</td> </tr></table></td></tr></table>";
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
		$messagecc . "\n\n";
	
		mail($email,'Thanks for Registering for '.$getproductforemailer.' on deal4loans.com', $message, $headers);
	}

	//echo $Message;	
}			  
	//send mail		  

//Function to send send now mailer for ICICI
function SendMailToCustomersFORICICI($GetBankID,$CustomerID,$Product)
{
	$GetBidderID = explode(',',$GetBankID);
	$ExpBidderName = "";
	$ExpBidderContact="";
	$ExpBidderID = "";
	for($bid=0;$bid<count($GetBidderID);$bid++)	
	{
		$GetBankSql = "select Bidders_List.BidderID AS biddrbid,BankID,Banker_Contact,Bidder_Contact_To_Customers.BidderID AS contbid from Bidders_List LEFT OUTER JOIN Bidder_Contact_To_Customers ON Bidder_Contact_To_Customers.BidderID=Bidders_List.BidderID AND Bidder_Contact_To_Customers.Sms_Flag=1 and Bidder_Contact_To_Customers.Reply_Type=".$Product." where (Bidders_List.BidderID =".$GetBidderID[$bid]." and Bidders_List.Reply_Type =".$Product." )";
		$ExpBidderID[] = $GetBidderID[$bid];
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
	
	$getproductforemailer=getforemailer($Product);
		
	$TableName = getTableName($Product);
	if($Product==1)
	{
		$GetCustIDSql = "select PL_Tenure,Name,Email,City,Net_Salary,City_Other,Mobile_Number from ".$TableName." where RequestID = ".$CustomerID." ";
	}
	else if($Product==3)
	{
	$GetCustIDSql = "select Account_No,Name,Email,City,Net_Salary,City_Other,Mobile_Number from ".$TableName." where RequestID = ".$CustomerID." ";
	}
	else
	{
		$GetCustIDSql = "select Name,Email,City,Net_Salary,City_Other,Mobile_Number from ".$TableName." where RequestID = ".$CustomerID." ";
	}
	
	$GetCustIDQuery = ExecQuery($GetCustIDSql);
	$full_name = mysql_result($GetCustIDQuery,0,'Name');
	$email  = mysql_result($GetCustIDQuery,0,'Email');
	$city  = mysql_result($GetCustIDQuery,0,'City');
	$Net_Salary  = mysql_result($GetCustIDQuery,0,'Net_Salary');
		 
	if($city == "Others")
	{
		$city  = mysql_result($GetCustIDQuery,0,'City_Other');
	}
	$mobile_no  = mysql_result($GetCustIDQuery,0,'Mobile_Number');
	
	if(((strlen($email)) > 0) && (count($ExpBidderName)>0) ) 
	{
		$aheadTime  = mktime(date("H"), date("i")+15, 0, date("m")  , date("d"), date("Y"));
		$dateFormat15min = date("j M y g:i A", $aheadTime);
		$messagecc="<table width='100%' border='0' align='center' cellpadding='0' cellspacing='0' style='border:1px ridge #0099FF;'>  <tr>    <td><table width='100%' border='0' cellspacing='0' cellpadding='0'><tr><td width='40%' valign='top'></td><td width='60%' align='right' style='padding-top:5px;'><img src='http://www.deal4loans.com/images/cc/crdt-crd-logo.gif'  /><br />  <span style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#0A71D9;'>Loans by Choice not by Chance!</span></td></tr></table></td></tr><tr><td style=' font-family:Verdana; font-size:12px; color:#333333; padding-top:20px; padding-left:10px; padding-right:10px;'><p><b>Dear  $full_name,</b></p> <p>Your request will now be forwarded only to the below mentioned Credit Card Banks with your consent to call given earlier by you on call . The authorization given by you will override the DND/DNC registration on your numbers to receive call.</p>
<p> <table cellpadding='0' cellspacing='0' border='1'><tr><td height='27' width='300' bgcolor='#494949' style='color:#FFFFFF; font-family:Verdana,Arial,Helvetica,sans-serif; font-size:11px; font-weight:bold; padding:5px; text-align:center;'>Bank Name</td></tr>";
		
		for($exp=0;$exp<count($ExpBidderName);$exp++)
		{	
			$messagecc.="<tr><td height='24' style='font-family:Verdana,Arial,Helvetica,sans-serif; font-size:11px; font-weight:bold; padding:2px; text-align:center;'>".$ExpBidderName[$exp]."</td></tr>";
		}
		$messagecc.="</table><br /> You will receive calls within 24 hours from the Companies executives, you can compare the rates &amp; choose the best deal.</p></td></tr><tr><td>&nbsp;</td></tr><tr>  <td>&nbsp;</td></tr><tr><td><p>Warm Regards,<br />Team Deal4Loans<br /></p> </td></tr>  <tr><td style=' font-family:Verdana; font-size:12px; color:#ffffff;  padding-left:10px; padding-right:10px; background-color:#248ACA; border-top:1px solid  #0099CC;'><table width='100%' border='0' cellspacing='0' cellpadding='0'> <tr><td align='center' valign='middle'><a href='http://www.deal4loans.com/Contents_Blogs.php?source=d4l-aug08' style=' font-family:Verdana;  color:#ffffff; '>Blogs</a> </td><td align='center' valign='middle'> <a href='http://www.deal4loans.com/quiz.php?source=d4l-sendnow' style=' font-family:Verdana;  color:#ffffff;   '>Loan Quiz</a></td><td align='center' valign='middle'> <a href='http://www.deal4loans.com/debt-consolidation-plans.php?source=d4l-sendnow' style=' font-family:Verdana;  color:#ffffff;   '>Loan Guru </a></td><td height='25' align='center' valign='middle'> <a href='http://www.bimadeals.com?source=d4l-sendnow' style=' font-family:Verdana;  color:#ffffff;   '>Bimadeals.com </a></td><td align='center' valign='middle'> </td> <td valign='middle'>&nbsp;</td> </tr></table></td></tr></table>";
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
		$messagecc . "\n\n";
	
		mail($email,'Thanks for Registering for '.$getproductforemailer.' on deal4loans.com', $message, $headers);
	}
	//echo $Message;	
}	//for ICICI		  
// End of function SendMailToCustomers
?>	