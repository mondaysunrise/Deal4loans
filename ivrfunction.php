<?php
//require 'scripts/db_init.php';
function getBidders($RequestID,$table,$City)
{
	$ProductType = 14;
	$Customerid = $RequestID;
$Content = "";	

 $Dated = ExactServerdate();
	
		//IVR DATA
		//Page_Reference
		$BidderSql = "select BidderID, BidderContact, Bidder_Name, Query, Always from PLivrBiddersList where City like '%".$City."%' and  BlockBidder =1";
		 list($NumRowsBidder,$getrow)=MainselectfuncNew($BidderSql,$array = array());
		$cntr=0;
		
	
		
$Content .="<br>First Query: ".$BidderSql."<br>";
		
			$ListBidders ="";
		while($cntr<count($getrow))
        {
			$query = $getrow[$cntr]['Query'];
			$BidderID = $getrow[$cntr]['BidderID'];
			$Always = $getrow[$cntr]['Always'];

			$qry2 = $query." and ".$table.".RequestID ='".$RequestID."'";
			 list($NumRows,$get_row)=MainselectfuncNew($qry2,$array = array());

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
		  $cntr=$cntr+1;
		  }
		
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
				
				 list($RetrieveNumRows,$Myrow)=MainselectfuncNew($RetrieveBidder,$array = array());
		$i=0;

				$BidderID = $Myrow[$i]['BidderID'];
				$BidderContact = $Myrow[$i]['BidderContact'];
				$Prompt = $Myrow[$i]['Bidder_Name'];
				$Prompt = $Prompt."D"; 				
				
			$Content .="<br>Third Query: ".$InsertFeedBackSql."<br>";	
		
			$dataInsert = array("AllRequestID"=>$RequestID, "BidderID"=>$BidderID, "Reply_Type"=>$ProductType, "Allocation_Date"=>$Dated);
			$table = 'Req_PL_ivr_Feedback';
			$insert = Maininsertfunc ($table, $dataInsert);
				
			$dataInsert = array("Customer_Id"=>$Customerid, "Prompt"=>$Prompt, "Number"=>$BidderContact, "Customer_product"=>$ProductType, "Prompt_id"=>$BidderID, "Prompt_city"=>$City, "BicID"=>$BidderID);
			$table = 'call';
			$insert = Maininsertfunc ($table, $dataInsert);
			
			
$Content .="<br>Forth Query: ".$sql_call."<br>";								
			
			}
	
			$RetrieveCustomer = "select * from ".$table." where RequestID='".$RequestID."'";
			 list($recordcount,$Arrrow)=MainselectfuncNew($RetrieveCustomer,$array = array());
			$j=0;
			
			$Customerid = $Arrrow[$j]['RequestID'];
			$MobileNumber = $Arrrow[$j]['Phone'];
	
			$dataInsert = array("Customer_Id"=>$Customerid, "CustomerNumber"=>$MobileNumber, "Customer_product"=>$ProductType);
			$table = 'call_log';
			$insert = Maininsertfunc ($table, $dataInsert);
		

			$Content .="<br>Fifth Query: ".$sql_call_log."<br>";							
	
		

		$DataArray = array("Allocated"=>'1');
		$wherecondition ="(RequestID=".$Customerid.")";
		Mainupdatefunc ('Req_PL_ivr', $DataArray, $wherecondition);

$Content .="<br>Sixth Query: ".$UpdateCustomerSql."<br>";						
		}			 

$StrBidders = implode(',' , $ListBidders);
		
return $StrBidders;
 
}

?>
