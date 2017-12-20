<?php
require 'scripts/db_init.php';

//Req_Feedback_Comments_PL
//Req_Feedback_Bidder_PL1
$getLeadsSql = "select * from Req_Feedback_Bidder_PL where Allocation_Date>'2016-04-25 00:00:00'";
$getLeadsQuery = ExecQuery($getLeadsSql);
$getLeadsNum = mysql_num_rows($getLeadsQuery);
for($i=0;$i<$getLeadsNum;$i++)
{
	$Feedback_ID = mysql_result($getLeadsQuery,$i,'Feedback_ID');
	$getSubSql = "select * from Req_Feedback_Comments_PL where Feedback_ID='".$Feedback_ID."'";
	$getSubQuery = ExecQuery($getSubSql);
	$getSubNum = mysql_num_rows($getSubQuery);
	if($getSubNum>0) {} else
	{
		$AllRequestID = mysql_result($getLeadsQuery,$i,'AllRequestID');
		$BidderID = mysql_result($getLeadsQuery,$i,'BidderID');
		$ProductType = mysql_result($getLeadsQuery,$i,'Reply_Type');
		$Allocation_Date = mysql_result($getLeadsQuery,$i,'Allocation_Date');
		
		$final_allocation_comments ="INSERT into Req_Feedback_Comments_PL (Feedback_ID,AllRequestID, BidderID, Reply_Type, Allocation_Date) VALUES ('".$Feedback_ID."', '".$AllRequestID."','".$BidderID."','".$ProductType."', '".$Allocation_Date."')";
	//	$final_allocation_commentsresult = ExecQuery($final_allocation_comments);
		echo $final_allocation_comments.";<br>";
	
	}
	
	
		


}

?>