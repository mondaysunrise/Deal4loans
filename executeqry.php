<?php

require 'scripts/db_init.php';

$updateqry= "DELETE FROM `deal4loans_primary`.`Req_Loan_Home` WHERE `Req_Loan_Home`.`RequestID` =1741001";
$updateqryresult = ExecQuery($updateqry);

?>
