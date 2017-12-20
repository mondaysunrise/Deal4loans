<? 
require 'scripts/db_init.php';

$total_amtcntr=ExecQuery("select Amount,countr_amt From totalLoans Where (Name='Totalcountr' and flag=1)");
echo $ttl_countrtaken = mysql_result($total_amtcntr,0,'Amount');
echo $countr_amtttl = mysql_result($total_amtcntr,0,'countr_amt');

$todydate=date('Y-m-d');
$countofdayhllead=ExecQuery("select RequestID From Req_Loan_Home Where (Updated_Date between '".$todydate." 00:00:00' and '".$todydate." 23:59:59')");
$leaddayhlcount = mysql_num_rows($countofdayhllead);

$countofdaypllead=ExecQuery("select RequestID From Req_Loan_Personal Where (Updated_Date between '".$todydate." 00:00:00' and '".$todydate." 23:59:59')");
$leaddayplcount = mysql_num_rows($countofdaypllead);

$countofdaylaplead=ExecQuery("select RequestID From Req_Loan_Against_Property Where (Updated_Date between '".$todydate." 00:00:00' and '".$todydate." 23:59:59')");
$leaddaylapcount = mysql_num_rows($countofdaylaplead);

//echo "<br>";

$countofdaycllead=ExecQuery("select RequestID From Req_Loan_Car Where (Updated_Date between '".$todydate." 00:00:00' and '".$todydate." 23:59:59')");
$leaddayclcount = mysql_num_rows($countofdaycllead);

//echo "<br>";

$countofdaycclead=ExecQuery("select RequestID From Req_Credit_Card Where (Updated_Date between '".$todydate." 00:00:00' and '".$todydate." 23:59:59')");
$leaddaycccount = mysql_num_rows($countofdaycclead);
//echo "<br>";

echo $totalcount= $leaddayhlcount + $leaddayplcount + $leaddayclcount + $leaddaylapcount + $leaddaycccount ; 


if($totalcount > $countr_amtttl && $totalcount>0)
{
$exactinc= $totalcount - $countr_amtttl;
$amt_toview=$ttl_countrtaken + $exactinc;
$ttlinc = $countr_amtttl + $exactinc;
}
else if ($totalcount < $countr_amtttl && $totalcount>0)
{
	$exactinc= $countr_amtttl - $totalcount ;
$amt_toview=$ttl_countrtaken + $exactinc;
$ttlinc = $countr_amtttl + $exactinc;
}
else
{
	$amt_toview=$ttl_countrtaken;
	$ttlinc = $countr_amtttl;
}

$ttlamtcntupdate=ExecQuery("Update totalLoans set Amount='".$amt_toview."', countr_amt='".$ttlinc."' Where (Name='Totalcountr' and flag=1)");


$ttlamtcntupdate_tst=ExecQuery("INSERT INTO totalLoans_test (Amount,countr_amt, dated) VALUES ('".$amt_toview."','".$ttlinc."', NOW())");



//echo "Update totalLoans set Amount='".$amt_toview."', countr_amt='".$ttlinc."' Where (Name='Totalcountr' and flag=1)";

?>