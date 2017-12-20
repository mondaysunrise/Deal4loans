<?php
$IP = getenv("REMOTE_ADDR");
//$IP = $HTTP_SERVER_VARS["HTTP_X_FORWARDED_FOR"]; 

echo "IP:".$IP;
//phpinfo();
/*
if((0&1)!=0)
{
	echo "A";
}
else
{
	echo "B";
}
*/
?>
