<?php

print_r($_SERVER);

echo "<br><br>";

if (!empty($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR']!='192.124.249.12' && $_SERVER['REMOTE_ADDR']!='185.93.228.12')
{
       echo "hello";
}
else
{
	echo "bye";
}
?>