<?php
//$IP_Remote = $_SERVER["REMOTE_ADDR"];
$IP_Remote = $_SERVER["REMOTE_ADDR"];
if($IP_Remote=='192.124.249.12' || $IP_Remote=='185.93.228.12' || $IP_Remote=="185.93.231.12" || $IP_Remot=="192.88.134.12") { $IP= $_SERVER['HTTP_X_SUCURI_CLIENTIP']; }
else { $IP= $IP_Remote;	}

//define("DIALLERIP","122.176.122.134");
//define("DIALLERIP","122.160.74.241");
//define("DIALLERIP","122.176.100.27");
//define("DIALLERIP","122.161.196.68");
define("DIALLERIP",$IP);
?>