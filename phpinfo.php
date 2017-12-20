<? 
$today = date("F j, Y, g:i a");  
echo $today."<br>";

$today = date("F j, Y, H:i:s");  
echo $today."<br>";
echo "Remote_Addr - ".getenv("REMOTE_ADDR")."<br>";

echo "HTTP_X_REAL_IP - ".$_SERVER['HTTP_X_REAL_IP']."<br>";
phpinfo();

?>

