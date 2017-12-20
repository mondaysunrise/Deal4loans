<?php
require 'scripts/db_init.php';

$sql="select * from Bank_Master where Bank_Name like 'A%'";
list($numPL,$row)=Mainselectfunc($sql,$array = array());

while($row)
$output[]=$row;
print(json_encode($output));
mysql_close();
?>