<?php
require 'scripts/db_init.php';
$sql = "select * from Billing";
 list($recordcount,$getrow)=MainselectfuncNew($sql,$array = array());
		//$cntr=0;

//$Query = ExecQuery($sql);

?>