<?php

require 'scripts/db_init.php';
//echo $updateqry = "Update Req_Loan_Personal set DOB='1990-11-23' Where `RequestID` in(3783555,3783556)";

//$updateqryresult = ExecQuery($updateqry);

echo $DeleteQuery="Delete from Req_Loan_Personal WHERE `RequestID`in (3795649,3795650)";
$Deleteqryresult = ExecQuery($DeleteQuery);
?>