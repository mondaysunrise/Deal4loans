<?php
//6088
require 'scripts/db_init.php';
require 'scripts/functions_nw.php';
hdfc6120();
function hdfc6120()
{
$currentdate=Date('Y-m-d');
$min_date = $currentdate." 00:00:00";
$max_date = date('Y-m-d H:i:s', strtotime('-2 hour'));


$startprocess="Select RequestID From Req_Compaign Where (Bank_Name='BL Leads' and BidderID=6120 and Reply_Type=1)";
echo $startprocess."<br><br>";
$startprocessresult = ExecQuery($startprocess);
$recordcount = mysql_num_rows($startprocessresult);
$row=mysql_fetch_array($startprocessresult);
$total_lead_count = $row["RequestID"];

if($total_lead_count>0)
{
	$sbiccqry="SELECT  RequestID,Updated_Date as Allocation_Date from Req_Loan_Personal WHERE (((Req_Loan_Personal.Updated_Date Between '".$min_date."' and '".$max_date."' )) and Req_Loan_Personal.Allocated=0  AND Req_Loan_Personal.Employment_Status =0)";
}
//$sbiccqry="SELECT  RequestID,Update_Date from ".TABLE_REQ_LOAN_PERSONAL." WHERE (((".TABLE_REQ_LOAN_PERSONAL.".Updated_Date Between '".$min_date."' and '".$max_date."' )) and ".TABLE_REQ_LOAN_PERSONAL.".Allocated=0  AND ".TABLE_REQ_LOAN_PERSONAL.".Employment_Status =0)";
//$sbiccqry = "SELECT RequestID,Updated_Date as Allocation_Date  from Req_Loan_Personal WHERE (((Req_Loan_Personal.Updated_Date Between '2016-04-26 00:00:00' and '2016-04-28 23:22:40' )) and Req_Loan_Personal.Allocated=0 AND Req_Loan_Personal.Employment_Status =0)";
echo "6120 ".$sbiccqry."<br>";
exit();
$select4mcardsresult = ExecQuery($sbiccqry);
$recordcount1 = mysql_num_rows($select4mcardsresult);
$bidderID="";

while($row2 = mysql_fetch_array($select4mcardsresult))
{
	$AllRequestID = $row2["RequestID"];
	$Allocation_Date = $row2["Allocation_Date"];
	$Feedback_ID = $row2["RequestID"];
	if($AllRequestID>0)
	{
			$bidderID="6120";			
		
			if($AllRequestID>0 && $bidderID>1)
			{
				//insert allocation
				//echo "<br><br>";
				 $inserticiciqry="INSERT INTO `lead_allocate` (`AllRequestID`, `BidderID`, `Reply_Type`, `Allocated`, `Allocation_Date`) VALUES ('".$AllRequestID."', '".$bidderID."', '1', '0', '".$Allocation_Date."');";
				$inserticiciqryresult = ExecQuery($inserticiciqry);
echo "<br><br>";
				 $updateqry= "Update Req_Compaign set RequestID='".$Feedback_ID."' Where (Bank_Name='BL Leads' and BidderID=6120 and Reply_Type=1)";
				$updateqryresult = ExecQuery($updateqry);
				echo "<br><br>";
			}
	}
}
}

?>	
