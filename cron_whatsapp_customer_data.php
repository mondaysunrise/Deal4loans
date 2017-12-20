<?php
require 'scripts/db_init.php';
/*
* @author Upendra Kumar <upendra@wishfin.com>
* @date 18/08/2017
* Whatsapp Message to Customer
* Message will be send to the Customer after 4 days of allocation
* Excluse Feedback - Not Eligible
* Collect the Eligible Leads
*/

$define_initial_mktime = mktime(0, 0, 0, date("m")  , date("d")-4, date("Y"));
$define_initial_date=date('Y-m-d',$define_initial_mktime);
$min_date=$define_initial_date." 00:00:00";
$max_date=$define_initial_date." 23:59:59";

$querySql = "SELECT BidderID, product_tbl,allocation_tbl,feedback_tbl,exclude_feedback_list,productid FROM `lms_attributes` WHERE lms_type='WHATSAPP' AND status=1";
//echo $querySql."<br>";
list($recordcount,$records)=MainselectfuncNew($querySql,$array = array());
//echo "<pre>";
//print_r($records);
//	echo $recordcount."<br />";	
for($i=0;$i<$recordcount;$i++)
{
	$BidderID = $records[$i]["BidderID"];
	$productid= $records[$i]["productid"];
	$product_tbl= $records[$i]["product_tbl"];
	$allocation_tbl= $records[$i]["allocation_tbl"];
	$feedback_tbl= $records[$i]["feedback_tbl"];
	$exclude_feedback_list= $records[$i]["exclude_feedback_list"];
	//echo $BidderID.", ".$product_tbl.", ".$allocation_tbl.", ".$feedback_tbl.", ".$exclude_feedback_list;
	//echo "<br />";	
	
//	echo $getLeadsSql = "select ".$product_tbl.".Name,".$product_tbl.".Mobile_Number, Bidders_List.Bidder_Name, " . $allocation_tbl . ".AllRequestID, " . $allocation_tbl . ".BidderID, " . $allocation_tbl . ".Allocation_Date, Feedback  FROM " . $allocation_tbl . " JOIN ".$feedback_tbl." ON (".$feedback_tbl.".AllRequestID = " . $allocation_tbl . ".AllRequestID AND ".$feedback_tbl.".BidderID='".$BidderID."' ) JOIN ".$product_tbl." ON ".$product_tbl.".RequestID = " . $allocation_tbl . ".AllRequestID JOIN Bidders_List ON Bidders_List.BidderID= " . $allocation_tbl . ".BidderID WHERE (" . $allocation_tbl . ".Reply_Type=" . $productid . " AND ( " . $allocation_tbl . ".Allocation_Date Between '" . ($min_date) . "' and '" . ($max_date) . "') AND " . $allocation_tbl . ".BidderID='".$BidderID."'  AND ".$feedback_tbl.".Feedback !='".$exclude_feedback_list."')";//AND " . $feedback_tbl . ".BidderID='".$BidderID."'
	$getLeadsSql = "SELECT ".$product_tbl.".Name,".$product_tbl.".Mobile_Number, " . $allocation_tbl . ".AllRequestID, " . $allocation_tbl . ".BidderID, " . $allocation_tbl . ".Allocation_Date, Feedback FROM " . $allocation_tbl . ",".$product_tbl." LEFT OUTER JOIN ".$feedback_tbl." ON ".$feedback_tbl.".AllRequestID=".$product_tbl.".RequestID AND ".$feedback_tbl.".BidderID='".$BidderID."'  and ".$feedback_tbl.".Feedback !='".$exclude_feedback_list."'  WHERE (" . $allocation_tbl . ".AllRequestID=".$product_tbl.".RequestID and " . $allocation_tbl . ".BidderID ='".$BidderID."' and " . $allocation_tbl . ".Reply_Type=" . $productid . " and  " . $allocation_tbl . ".Allocation_Date Between  '" . ($min_date) . "' and '" . ($max_date) . "')"; //, Bidders_List.Bidder_Name

	list($recordcountLeads,$recordLeads)=MainselectfuncNew($getLeadsSql,$array = array());	
	if($recordcountLeads>0)
	{
		for($j=0;$j<$recordcountLeads;$j++)
		{
			$Name=ucwords(strtolower($recordLeads[$j]["Name"]));
			$AllRequestID=$recordLeads[$j]["AllRequestID"];
			$BidderID=$recordLeads[$j]["BidderID"];
			$Allocation_Date=$recordLeads[$j]["Allocation_Date"];
			$Feedback =$recordLeads[$j]["Feedback"];
			$Mobile_Number=$recordLeads[$j]["Mobile_Number"];
			
			$BidderNameSql = "SELECT Bidder_Name FROM Bidders_List WHERE BidderID='".$BidderID."'";
			list($recordcountBidderName,$recordBidderName)=MainselectfuncNew($BidderNameSql,$array = array());	
			$Bidder_Name=ucwords(strtolower($recordBidderName[0]["Bidder_Name"]));
			$data = array("bidder_id"=> $BidderID,  "bidder_name"=> $Bidder_Name,  "customer_name"=> $Name,  "customer_mobile"=> $Mobile_Number,  "lead_id"=> $AllRequestID, "table_name"=> $product_tbl, "feedback"=> $Feedback, "allocation_date"=>$Allocation_Date);
			print_r($data);
	 		$ProductValue = Maininsertfunc("webservice_whatsapp", $data);
	 		echo "<br />";
		}
	
	}
//	echo "<br />";echo "<br />";
}
?>