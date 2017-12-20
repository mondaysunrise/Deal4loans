<?php
	require 'scripts/db_init.php';
//PL
$result1 = ExecQuery("SELECT sum( `Loan_Amount` ) AS ttlcnt FROM `Req_Loan_Personal` WHERE ( 1 =1 )");
$row1 = mysql_fetch_array($result1);
echo $plVal = number_format($row1['ttlcnt']);
$plVal = round($row1['ttlcnt']);
echo "<br>";
echo $updateSql = "update totalLoans set Amount='".$plVal."', dated = Now() where  id = 1";
$updateQuery = ExecQuery($updateSql);
//End

//HL
$result1 = ExecQuery("SELECT sum( `Loan_Amount` ) AS ttlcnt FROM `Req_Loan_Home` WHERE ( 1 =1 )");
$row1 = mysql_fetch_array($result1);
echo "<br>";

echo $hlVal = number_format($row1['ttlcnt']);
echo "<br>";
$hlVal = round($row1['ttlcnt']);

echo $updateSql = "update totalLoans set Amount='".$hlVal."' , dated = Now() where  id = 2";
$updateQuery = ExecQuery($updateSql);
//End

//CL
$result1 = ExecQuery("SELECT sum( `Loan_Amount` ) AS ttlcnt FROM `Req_Loan_Car` WHERE ( 1 =1 )");
$row1 = mysql_fetch_array($result1);
echo "<br>";

echo $clVal = number_format($row1['ttlcnt']);
echo "<br>";
$clVal = round($row1['ttlcnt']);

echo $updateSql = "update totalLoans set Amount='".$clVal."' , dated = Now() where  id = 3";
$updateQuery = ExecQuery($updateSql);


?>