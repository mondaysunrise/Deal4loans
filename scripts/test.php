<?php
include "scripts/functions.php";
$SMSMessage = " ";
//$PhoneNumber = "9970178877";
$PhoneNumber = "9971396361";
SendSMS($SMSMessage, $PhoneNumber);

//$word = new COM("checksum.so.1") or die("Unable to instantiate Word");
//echo "Loaded, Citibank Payment Checksum ".$word->Version."\n";
//$result = "/usr/bin/php /var/www/vhosts/deal4loans.com/httpdocs/checksum.so.1";

// http://www.jaguarpc.com/forums/showthread.php?t=21253&page=2
/*ini_set("safe_mode_include_dir", "/var/www/vhosts/deal4loans.com/httpdocs/");
exec("date",$date, $int);
print 'date :'.$date[0]."return value " .$int."<br>";


exec('./citi "22261169" -1234567890abcdef 2>&1', $thestring, $retval);

if ($retval)
{
   echo "Failure\n";
}
else
{
   foreach ($thestring as $piece)
   {
      echo $piece;
   }
}

if( ini_get('safe_mode') ){
    // Do it the safe mode way
echo "On";
}else{
echo "Off";
    // Do it the regular way
}
*/

echo "<br>";
print_r($_SERVER);
echo "<br>";
phpinfo();
?>