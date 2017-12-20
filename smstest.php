<?php
if($_POST){
//header("Location: http://luna.a2wi.co.in:7501/failsafe/HttpLink?aid=1022&pin=csk89&mnumber&pin=csk89&mnumber=919872975715&message=Testmsg&signature=test&lang=EN");
$mnumber = '91'.$_POST['mnumber'];
$message=$_POST['message'];
$vars = array("aid" => '9581', "pin" => 'rsi42', "mnumber" => $mnumber, "message" => $message);
//$vars = array("aid" => '1022', "pin" => 'spf64', "mnumber" => $mnumber, "message" => $message);
$url = "http://luna.a2wi.co.in:7501/failsafe/HttpLink?";
//$url = "http://luna.a2wi.co.in:7501/failsafe/HttpLink?aid=1022&pin=csk89&mnumber=".$mnumber."&message=".$message;
echo $url;
echo "<br>";
//print_r($vars);
echo "<br>";
		//$url = "http://in.yahoo.com";
		$urlencoded = "";
		while (list($key, $value) = each($vars))
		{
			$urlencoded.= urlencode($key)."=".$value."&";
		}
		$urlencoded = substr($urlencoded, 0, -1);
		//$urlencoded = substr($urlencoded,0,100);

		echo $urlencoded;	
		echo "<br>";

		$ch = curl_init();    // initialize curl handle
		curl_setopt($ch, CURLOPT_URL,$url); // set url to post to
		curl_setopt($ch, CURLOPT_FAILONERROR, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); // return into a variable
		curl_setopt($ch, CURLOPT_TIMEOUT, 5); // times out after 5s
		curl_setopt($ch, CURLOPT_POST, 1); // set POST method
		curl_setopt($ch, CURLOPT_POSTFIELDS, $urlencoded); // add POST fields
		$result = curl_exec($ch); // run the whole process
		echo "Testing SMS";
		print_r($result);
		echo "sent";
		curl_close($ch); 
}
?>
<form action="smstest.php" method="post" name="sms">
<table border="0" cellspacing="5" cellpadding="5">
	<tr>
    	<td>Mobile Number </td><td><input type="text" name="mnumber" /></td>
    </tr>
    <tr>
    	<td>Message</td><td><textarea name="message"></textarea></td>
     </tr>
     <tr>
     	<td colspan="2" align="center"><input type="submit" name="submit" value="Send" /></td>
     </tr>
</table>
</form>

<?php
//URL: http://luna.a2wi.co.in:7501/failsafe/HttpLink?aid=9581&pin=rsi42&mnumber=919971396361&message=Testmsg

//PID             :  9580
//AID             :  9581
//PCODE       :  WRSINFO
//ACODE       :  WRSINFO
//BILL_TYPE  :  PostPaid
//EXPIRY_DT  :  25-MAY-10
//PIN              :  rsi42
//$SMSMessage = "Test Msg";
//$PhoneNumber = 9971396361;
//SendSMS($SMSMessage, $PhoneNumber);



?>