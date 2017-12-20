<?php
session_start();
require 'scripts/db_init.php';
require 'scripts/functions_nw.php';

function getforcount($pKey){
    $titles = array(
	'Ahmedabad' => '3822',
	'Bangalore' => '3664',
	'Bhubaneswar' => '4500',
	'Chandigarh' => '4499',
	'Chennai' => '3665',
	'Delhi' => '3778',
	'Hyderabad' => '3666',
	'Jaipur' => '4502',
	'Jammu' => '4503',
	'Kochi' => '4501',
	'Kolkata' => '3821',
	'Mumbai' => '3662',
	'Pune' => '3663',
	'Surat' => '3820',
	'Vadodara' => '3823'
	);

	foreach ($titles as $key=>$value)
	if($pKey==$key)
	return $value;
    return "";
  }


$currentmonth=date('F');
$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-1, date("Y"));
$currentdate=date('Y-m-d',$tomorrow);
list($year,$month,$date) = split('-', $currentdate);
//echo $date."<br>";
$slectqry="Select total_count,icici_city from icicihl_lapreport Where (icici_product=4 and stat_flag=1 and icici_month='".$currentmonth."')";
$result=ExecQuery($slectqry);
 echo "1) ".$slectqry."<br><br>";

while($row=mysql_fetch_array($result))
	{
 $bidderid = getforcount($row['icici_city']);
		
	   if($row['icici_city']=="Total")
		{
	$qry="SELECT count(AllRequestID) AS countleads,City AS day FROM Req_Feedback_Bidder_CC,Req_Loan_Home WHERE (Req_Feedback_Bidder_CC.AllRequestID=Req_Loan_Home.RequestID and Req_Feedback_Bidder_CC.BidderID in (3822,3664,4500,4499,3665,3778,3666,4502,4503,4501,3821,3662,3663,3820,3823) and Req_Feedback_Bidder_CC.Reply_Type=4 and Req_Feedback_Bidder_CC.Allocation_Date Between '".$currentdate." 00:00:00' and '".$currentdate." 23:59:59')";
		}
		else
		{
 $qry="SELECT count(AllRequestID) AS countleads,City AS day FROM Req_Feedback_Bidder_CC,Req_Loan_Home WHERE (Req_Feedback_Bidder_CC.AllRequestID=Req_Loan_Home.RequestID and Req_Feedback_Bidder_CC.BidderID in (".$bidderid.") and Req_Feedback_Bidder_CC.Reply_Type=4 and Req_Feedback_Bidder_CC.Allocation_Date Between '".$currentdate." 00:00:00' and '".$currentdate." 23:59:59')";
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
$upqry="Update icicihl_lapreport set ".$field."='".$rownw['countleads']."',total_count='".$ttlcnt."' Where (icici_city='".$row['icici_city']."' and stat_flag=1 and icici_product=4)";
echo "3) ".$upqry."<br><br>";
$upqry_result=ExecQuery($upqry);
		}
}

?>