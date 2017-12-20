<?php
require 'scripts/session_check_online.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';

//$sql = "select count(Feedback_ID), BidderID, Reply_Type from Req_Feedback_Bidder1 where Allocation_Date<'2007-12-31 23:59:59' group by BidderID, Reply_Type";

$sql = "select count(Feedback_ID), BidderID, Reply_Type from Req_Feedback_Bidder1 where Allocation_Date<'2007-12-31 23:59:59' group by BidderID, Reply_Type";
$result = ExecQuery($sql);
echo "<table border=1><tr><td>BidderID</td><td>Product Type</td><td>Count</td></tr>";
while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
   //echo "<tr><td>".$row[1]."</td><td>".$row[2]."</td><td>".$row[0]."</td><tr>";
   
   $sql = "INSERT INTO bidders_book_keeping (BidderID , BookProduct , BookDate , BookWeek , BookMonth , BookYear , BookLeadCount , BookEntryTime ) VALUES ( '".$row[1]."', '".$row[2]."', 31, 52, 12, 2007, '".$row[0]."', '2007-12-31 23:45:00')";
   echo "<tr><td>";
   echo $sql;
   echo "</td><tr>";
//    printf("Count: %s  BidderID: %s ProductType: %s", $row[0], $row[1], $row[2]);  
	//echo "<br>";
}
echo "</table>";

?>