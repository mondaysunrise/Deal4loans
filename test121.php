<?php
require 'scripts/db_init.php';
$RequestID = 1037425;
$Dated = "2017-06-13 16:56:00";
$getSBISql = "select City, Query from Bidders_List where BidderID = 5633 and Restrict_Bidder=1";
				list($alreadyExistSBI,$getSBIRows)=Mainselectfunc($getSBISql,$array = array());
				if($alreadyExistSBI>0)
				{
					$CitySBI = $getSBIRows['City'];
					$CityListSBI =  str_replace(",", "', '", $CitySBI);
					echo "<br>";
				echo	$sqlSBI =  $getSBIRows['Query']." and Req_Credit_Card.RequestID='".$RequestID."' and  Req_Credit_Card.City in ('".$CityListSBI."')";
					list($numRowsSBI,$getSBIRow)=Mainselectfunc($sqlSBI,$array = array());
					if($numRowsSBI>0)
					{
						$insertFeedbackArr = array("AllRequestID"=>$RequestID, "BidderID"=>5633, "Reply_Type"=>1, "Allocation_Date"=>$Dated);
						print_r($insertFeedbackArr);
						Maininsertfunc("Req_Feedback_Bidder1", $insertFeedbackArr);
				//		Maininsertfunc("Req_Feedback_Bidder_CC", $insertFeedbackArr);
					}
				}	

?>
