<?php
//require 'scripts/db_init.php';
function getBidders($RequestID,$table,$City)
{
	$ProductType = 14;
	$Customerid = $RequestID;
$Content = "";	
	
		//IVR DATA
		//Page_Reference
		$BidderSql = "select BidderID, BidderContact, Bidder_Name, Query, Always from PLivrBiddersList where City like '%".$City."%' and  BlockBidder =1";
		$BidderQuery = ExecQuery($BidderSql);
		
$Content .="<br>First Query: ".$BidderSql."<br>";
		
		$NumRowsBidder = mysql_num_rows($BidderQuery);
		$ListBidders ="";
		for($i=0;$i<$NumRowsBidder;$i++)
		{
			$query = mysql_result($BidderQuery,$i,'Query');
			$BidderID = mysql_result($BidderQuery,$i,'BidderID');
			$Always = mysql_result($BidderQuery,$i,'Always');

			$qry2 = $query." and ".$table.".RequestID ='".$RequestID."'";
			$Queryqry2 = ExecQuery($qry2);	
			$NumRows =  mysql_num_rows($Queryqry2);
			if($NumRows>0)
			{
				if($Always == 1)
                {
                    $FirstSetBidders[]  = $BidderID; //forms an array for bidders Always ==1
                }//close if($always == 1)
				if($Always != 1 || $Always=="")
                {
                    $SecondSetBidders[]  = $BidderID; //forms an array for bidders Always !=1
                }
			}
		}
		
	/*	echo "<br>";
		print_r($FirstSetBidders);
		echo "<br>";
		print_r($SecondSetBidders);
		echo "<br>";
	*/	
		
		if(count($SecondSetBidders)>3)
		{
			//allocation process priority basis
			
			$rand_keys = array_rand($SecondSetBidders, 3);
//			print_r($rand_keys);
			
			for($zz=0;$zz<count($rand_keys);$zz++)
			{
				$FinalBidderSecondSet[] = $SecondSetBidders[$rand_keys[$zz]];
			}
			
					
			$ListBidders = array_merge($FirstSetBidders,$FinalBidderSecondSet);
			//at the end concate with first set bidders
		}
		else
		{
			$ListBidders = array_merge($FirstSetBidders,$SecondSetBidders);
		}
		
//		print_r($ListBidders);
		
		
		if(count($ListBidders)>0 && $ListBidders[0]>0)
		{		
			for($j=0;$j<count($ListBidders);$j++)
			{
				$RetrieveBidder = "select BidderID, BidderContact, Bidder_Name, Query from PLivrBiddersList where BidderID='".$ListBidders[$j]."'";
$Content .="<br>Second Query: ".$RetrieveBidder."<br>";				
				$RetrieveBidderQuery = ExecQuery($RetrieveBidder);
				$RetrieveNumRows = mysql_num_rows($RetrieveBidderQuery);
				$BidderID = mysql_result($RetrieveBidderQuery,0,'BidderID');
				$BidderContact = mysql_result($RetrieveBidderQuery,0,'BidderContact');
				$Prompt = mysql_result($RetrieveBidderQuery,0,'Bidder_Name');
				
				$InsertFeedBackSql = "Insert into Req_PL_ivr_Feedback (AllRequestID,BidderID,Reply_Type,Allocation_Date) Values ('$RequestID', '$BidderID','$ProductType', Now())";
				
$Content .="<br>Third Query: ".$InsertFeedBackSql."<br>";	
		
			//echo "<br>".$InsertFeedBackSql."<br>";
			
				$InsertFeedBackResult = ExecQuery($InsertFeedBackSql);
			
				$sql_call = "INSERT INTO `call` (`Customer_Id` ,`Prompt` ,`Number`, `Customer_product`, `Prompt_id`, `Prompt_city`, `BicID`) VALUES ('".$Customerid."', '".$Prompt."', '".$BidderContact."', '".$ProductType."', '".$BidderID."', '".$City."','".$BidderID."')";
//				$query_call = ExecQuery_in($sql_call);
				$query_call = ExecQuery($sql_call);
$Content .="<br>Forth Query: ".$sql_call."<br>";								
				
				//echo $sql_call ;
				//echo "<br>";
			}
	
			$RetrieveCustomer = "select * from ".$table." where RequestID='".$RequestID."'";
			$RetrieveCustomerQuery = ExecQuery($RetrieveCustomer);
			$Customerid = mysql_result($RetrieveCustomerQuery,0,'RequestID');
			$MobileNumber = mysql_result($RetrieveCustomerQuery,0,'Phone');
	
			$sql_call_log = "INSERT INTO `call_log` (`Customer_Id`, `CustomerNumber`, `Customer_product`) VALUES ('".$Customerid."', '".$MobileNumber."', '".$ProductType."' )";
//            $query_call_log = ExecQuery_in($sql_call_log); 
			$query_call_log = ExecQuery($sql_call_log); 

$Content .="<br>Fifth Query: ".$sql_call_log."<br>";							
	
			$UpdateCustomerSql = "update Req_PL_ivr set Allocated = 1 where RequestID=".$Customerid;
			$UpdateCustomerQuery = ExecQuery($UpdateCustomerSql);
$Content .="<br>Sixth Query: ".$UpdateCustomerSql."<br>";						
		}			 
	
			
echo $Content;
			//$Log_Entry = ExecQuery("INSERT INTO `Log_ivr` ( `LeadID` , `EligibleBidders` , `Product_Type` , `Dated` ) VALUES ( '".$RequestID."', '".$LogFinalBidders."', '".$ProductType."', NOW())");

}

?>
