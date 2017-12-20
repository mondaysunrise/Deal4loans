<?php
	require 'scripts/db_init.php';


$current= date('Y-m-d');
$min_date = $current." 00:00:00";

$updatepl="Update Req_Loan_Personal set Allocated=2 where (Bidder_Count=0 and source='hdfc_plmlr' and Bidderid_Details!='' and Updated_Date >'".$min_date."' and Net_Salary>=360000 and Employment_Status=1 and (Req_Loan_Personal.DOB!='' and DATE_SUB(CURDATE(),INTERVAL 22 YEAR) >= Req_Loan_Personal.DOB) and (Req_Loan_Personal.DOB!='' and DATE_SUB(CURDATE(),INTERVAL 58 YEAR) <= Req_Loan_Personal.DOB))";
	//ExecQuery($updatepl);

?>