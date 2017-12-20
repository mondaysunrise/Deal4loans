<?php
require 'scripts/db_init.php';
data2leadallocate();
function data2leadallocate()
{
	$currentdate=Date('Y-m-d');
	$min_date = $currentdate." 00:00:00";
	$max_date = $currentdate." 23:59:59";
	
	$startprocess="Select id, last_inserted, BidderID, source, product From manual_user_details Where ((status=1) and (id!=7 and id!=9 and id!=10))";
	echo $startprocess."<br><br>";
	$startprocessresult = ExecQuery($startprocess);
	$recordcount = mysql_num_rows($startprocessresult);
	for($i=0;$i<$recordcount;$i++)
	{
		$total_lead_count = mysql_result($startprocessresult,$i,'last_inserted');
		if($total_lead_count>0)
		{
			$id = mysql_result($startprocessresult,$i,'id');
			$source = mysql_result($startprocessresult,$i,'source');
			$product = mysql_result($startprocessresult,$i,'product');
			if($product=="Req_Loan_Personal") { $Reply_Type = 1; } else if($product=="Req_Loan_Home") { $Reply_Type = 2; }
			$BidderID = mysql_result($startprocessresult,$i,'BidderID');
	echo		$selectSql = "select RequestID,Updated_Date,source from  ".$product." Where (source='".$source."' and RequestID>'".$total_lead_count."')";	
			$selectQry = ExecQuery($selectSql);
			while($row2 = mysql_fetch_array($selectQry))
			{
				$AllRequestID = $row2["RequestID"];
				$Allocation_Date = $row2["Updated_Date"];
				$Feedback_ID = $row2["RequestID"];
				if($AllRequestID>0)
				{
					if($AllRequestID>0 && $BidderID>1)
					{
						echo $inserticiciqry="INSERT INTO `lead_allocate` (`AllRequestID`, `BidderID`, `Reply_Type`, `Allocated`, `Allocation_Date`) VALUES ('".$AllRequestID."', '".$BidderID."', '".$Reply_Type."', '0', '".$Allocation_Date."');";
						$inserticiciqryresult = ExecQuery($inserticiciqry);
//			echo "<br><br>";
						 echo $updateqry= "Update manual_user_details set last_inserted='".$Feedback_ID."' Where (id='".$id."' and BidderID='".$BidderID."')";
						$updateqryresult = ExecQuery($updateqry);
						echo "<br><br>";
					}
				}
			}
		}
	}
}
?>