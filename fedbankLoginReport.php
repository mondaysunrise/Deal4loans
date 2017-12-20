<?php
ob_start();
require 'scripts/db_init.php';
require 'scripts/functions_nw.php';
$bidderArray = array(3512,3513,3514,3515,3516,3517,3518,3519,3520,3521);

$table = '';
$table .= '<table cellspacing="2" cellpadding="0" border="0"  style="border:#000033 1px solid;" bgcolor="#000033" >';
$table .= '<tr><td colspan="2" bgcolor="#fff" style="padding:3px; font-weight:bold;">Number of times login today.</td></tr>';
$table .= '<tr><td bgcolor="#fff" style="padding:3px;">City</td><td bgcolor="#fff" style="padding:3px;">Count of Login <br>'.date("d-m-Y").'
</td></tr>';
for($i=0;$i<count($bidderArray);$i++)
{
	$$count_Dt = '';
	$month = date("n");
	$date = "Date_".date("d");
//	$date = "Date_16";
	$sql = "select BidderID, ".$date." as countDt from BiddersLoginDetails where BidderID = '".$bidderArray[$i]."' and Month_Details='".$month."'";
	$query = ExecQuery($sql);
//	echo $sql."<br>";
	$countDt = mysql_result($query,0,'countDt');
	if($countDt>0)
	{
		$count_Dt = $countDt;
	}
	else
	{
		$count_Dt = 0;
	}
	
	$getBiddersSql = "select City from Bidders where BidderID='".$bidderArray[$i]."'";
	$getBiddersQuery = ExecQuery($getBiddersSql);
	$City = mysql_result($getBiddersQuery,0,'City');
	
	$table .= '<tr><td bgcolor="#fff" style="padding:3px;">'.$City.'</td><td bgcolor="#fff" style="padding:3px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$count_Dt.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr>';
		
}
$table .= '</table>';
echo $table;

$Email="info.mumbai@fedfina.com";
$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
$headers .= "cc: balbir.singh@deal4loans.com"."\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
mail($Email,'Fedbank Login -deal4loans', $table, $headers);

?>