<?php
ini_set("display_errors", "1");
error_reporting(E_ALL);
require 'scripts/db_init.php';


$startprocess="Select * From Bidders_Book_Keeping_nov21 Where (BookID between '1501' and '1994')";
	$startprocessresult = d4l_ExecQuery($startprocess);
	$recordcount = d4l_mysql_num_rows($startprocessresult);
	
	while($row=d4l_mysql_fetch_array($startprocessresult))
	{
		//(2, 5737, 4, 17, 46, 11, 2017, 49, '2017-11-17 23:57:05'),
		$BidderID= $row["BidderID"];
		$BookProduct= $row["BookProduct"];
		$BookDate= $row["BookDate"];
		$BookWeek= $row["BookWeek"];
		$BookMonth= $row["BookMonth"];
		$BookYear= $row["BookYear"];
		$BookLeadCount	= $row["BookLeadCount"];
		$BookEntryTime= $row["BookEntryTime"];

		echo $InsertBKSql = "INSERT INTO Bidders_Book_Keeping ( BidderID , BookProduct , BookDate , BookWeek , BookMonth , BookYear , BookLeadCount, BookEntryTime ) VALUES (".$BidderID.", ".$BookProduct.", ".$BookDate.",".$BookWeek.", ".$BookMonth.", ".$BookYear.", ".$BookLeadCount.",'".$BookEntryTime."')";
                    d4l_ExecQuery($InsertBKSql);
	}

?>