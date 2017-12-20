<?php
require 'scripts/db_init.php';
$sql = "select * from Req_lead_trans ";
list($num,$query)=MainselectfuncNew($sql,$array = array());
for($i=0;$i<$num;$i++	)
{
	$RequestID = $query[$i]['RequestID'];
	$LnsID = $query[$i]['LnsID'];

	$update = "update Req_Loan_Home set UserID='".$RequestID."' where RequestID='".$LnsID."'";
	echo $update. "; <br>";
}
//zpushlns.php
?>