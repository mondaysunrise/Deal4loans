<?php
session_start();
require 'scripts/db_init.php';
require 'scripts/functions_nw.php';


$currentmonth=date('F');
$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-1, date("Y"));
$currentdate=date('Y-m-d',$tomorrow);
list($year,$month,$date) = split('-', $currentdate);
//echo $date."<br>";
$slectqry="Select total_count,icici_city from icicihl_lapreport Where (icici_product=2 and stat_flag=1 and icici_month='".$currentmonth."')";
$result=ExecQuery($slectqry);
 //echo "1) ".$slectqry."<br><br>";

while($row=mysql_fetch_array($result))
	{
 if($row['icici_city']=="Delhi n NCR")
	  {
		$citylist="Delhi','Noida','Gurgaon','Gaziabad','Faridabad";
	  }
	  else if($row['icici_city']=="Mumbai n Suburbs")
	  {
		$citylist="Mumbai','Thane','Navi Mumbai";
	  }
	  else
	  {
		$citylist=$row['icici_city'];
	  }
	   if($row['icici_city']=="Total")
		{
	$qry="SELECT count(AllRequestID) AS countleads,City AS day FROM Req_Feedback_Bidder_HL,Req_Loan_Home WHERE (Req_Feedback_Bidder_HL.AllRequestID=Req_Loan_Home.RequestID and Req_Feedback_Bidder_HL.BidderID in (993) and Req_Feedback_Bidder_HL.Reply_Type=2 and Req_Feedback_Bidder_HL.Allocation_Date Between '".$currentdate." 00:00:00' and '".$currentdate." 23:59:59')";
		}
		else
		{
 $qry="SELECT count(AllRequestID) AS countleads,City AS day FROM Req_Feedback_Bidder_HL,Req_Loan_Home WHERE (Req_Feedback_Bidder_HL.AllRequestID=Req_Loan_Home.RequestID and Req_Feedback_Bidder_HL.BidderID in (993) and City in ('".$citylist."') and Req_Feedback_Bidder_HL.Reply_Type=2 and Req_Feedback_Bidder_HL.Allocation_Date Between '".$currentdate." 00:00:00' and '".$currentdate." 23:59:59')";
		}

 echo "2) ".$qry."<br><br>";
	$qry_result=ExecQuery($qry);
	$recordcount = mysql_num_rows($qry_result);
	$rownw=mysql_fetch_array($qry_result);

if($rownw['countleads']>0)
		{
	$field="date_".$date;
	$ttlcnt =$row['total_count'] + $rownw['countleads'];
//update 
$upqry="Update icicihl_lapreport set ".$field."='".$rownw['countleads']."',total_count='".$ttlcnt."' Where (icici_city='".$row['icici_city']."' and stat_flag=1 and icici_product=2)";
echo "3) ".$upqry."<br><br>";
$upqry_result=ExecQuery($upqry);
		}
}

?>