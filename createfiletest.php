<?php 
error_reporting(E_ALL);

/*header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1
header("Cache-Control: post-check=0, pre-check=0", false);
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
header("Pragma: no-cache"); // HTTP/1.0
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");


error_reporting(E_ALL);*/
$IP_Remote = $_SERVER["REMOTE_ADDR"];
if($IP_Remote=='192.124.249.12' || $IP_Remote=='185.93.228.12') { $IP= $_SERVER['HTTP_X_SUCURI_CLIENTIP']; }
else { $IP= $IP_Remote;	}

$finalsql="select * from Bidders";
$pagename = 'my_page1';

$newFileName = './logfile/'.$pagename.".txt";
$logcontent =date("Y-m-d H:i:s");
$newFileContent = "******************************************************\n".$logcontent."\nsession\nfinal sql : ".$finalsql."\n IP Address: ".$IP."\n******************************************************";

if(file_put_contents($newFileName,$newFileContent, FILE_APPEND)!=false){
    echo "File created 2 (".basename($newFileName).")";
}else{
    echo "Cannot create file (".basename($newFileName).")";
}

?>
