<?php
require 'scripts/db_init.php';


$allocationqry="SELECT BidderID,Reply_Type, DATE(Allocation_Date) AS allocatedate FROM `Req_Feedback_Bidder1` where (DATE(Allocation_Date) between '2017-11-11' and '2017-11-17') group by BidderID, DATE(Allocation_Date)";
$getPSFDetailsQuery = d4l_ExecQuery($allocationqry);
while($row = d4l_mysql_fetch_array($getPSFDetailsQuery))
{
	$BidderID = $row["BidderID"];
	$Reply_Type = $row["Reply_Type"];
	$allocatedate = $row["allocatedate"];

	$allocationqrychk="SELECT count(Feedback_ID) AS countlead,BidderID,Reply_Type FROM `Req_Feedback_Bidder1` where (DATE(Allocation_Date)='".$allocatedate."' and BidderID='".$BidderID."' and Reply_Type='".$Reply_Type."') group by BidderID";
	$getPSFDetailschkQuery = d4l_ExecQuery($allocationqrychk);
	$rowbid = d4l_mysql_fetch_array($getPSFDetailschkQuery);
	$BidderID = $rowbid["BidderID"];
	$Reply_Type = $rowbid["Reply_Type"];
	$countlead = $rowbid["countlead"];
	$bookarr=explode("-",$allocatedate);
	$TodayYear = $bookarr[0];
	$TodayMonth = $bookarr[1];
	$TodayDay = $bookarr[2];

	if($rowbid["BidderID"]>0)
	{
	echo "6:".$BookKeepingSql = "select * from Bidders_Book_Keeping where BidderID=".$BidderID." and BookProduct=".$Reply_Type." and BookDate=".$TodayDay." and BookMonth=".$TodayMonth." and BookYear=".$TodayYear."";
                $BookKeepingQuery = d4l_ExecQuery($BookKeepingSql);
               echo "<br>";
                $BookLeadCountExisting = @d4l_mysql_result($BookKeepingQuery,0,'BookLeadCount');
                $BookDate = @d4l_mysql_result($BookKeepingQuery,0,'BookDate');//added
                $BookMonth = @d4l_mysql_result($BookKeepingQuery,0,'BookMonth');//added
                $BookYear = @d4l_mysql_result($BookKeepingQuery,0,'BookYear');//added

                 if($BookLeadCountExisting>=1)
                 {
                     //Update
                    //$IncrementLeadCount = $BookLeadCountExisting + 1;

					
                    echo "7:".$UpdateBKSql = "update Bidders_Book_Keeping set BookLeadCount=".$countlead." where BidderID = ".$BidderID." and BookDate = ".$TodayDay." and BookMonth=".$TodayMonth." and BookYear =".$TodayYear." and BookProduct =".$Reply_Type."";
                    d4l_ExecQuery($UpdateBKSql);
					echo "<br><br>";
                 }
                 else
                 {
                    //Insert
					$crtdate = $allocatedate." ".date("H:i:s");
                    $TodayWeek = date('w', strtotime($allocatedate));
                    echo "8:".$InsertBKSql = "INSERT INTO Bidders_Book_Keeping ( BidderID , BookProduct , BookDate , BookWeek , BookMonth , BookYear , BookLeadCount, BookEntryTime ) VALUES (".$BidderID.", ".$Reply_Type.", ".$TodayDay.",'45', ".$TodayMonth.", ".$TodayYear.", ".$countlead.", '".$crtdate."')";
                   d4l_ExecQuery($InsertBKSql);
					echo "<br><br>";
                 }
	}
}


?>