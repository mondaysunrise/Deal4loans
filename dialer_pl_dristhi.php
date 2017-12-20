<?php
// File for Testing Not in USE
require 'scripts/db_init.php';

//9971396361,9811215138,9555060388,9958439152,9810316335
		//?Name=Upendra+Kumar&Mobile_Number=9971396363&UniqueID=1997361&list_id=1000
	$qrysql="SELECT * FROM  `Req_Dialer_Records_PL` where ID in (4617,4618,4619,4620,4621)";
//	$qrysql="SELECT * FROM  `Req_Dialer_Records_PL` where ID in (4617)";
	$qrysqlresult = ExecQuery($qrysql);

$param = '';
while($plrow = mysql_fetch_array($qrysqlresult))
{
	//?Name=Upendra+Kumar&Mobile_Number=9971396363&UniqueID=1997361&list_id=1000
	$lastID = $plrow["id"];
	$param = '';
	$param["c_name"] = trim($plrow["Name"]);
	$param["p_number"] = $plrow["Mobile_Number"];
	$param["unique_id"] = $plrow["RequestID"];
	$param["list_id"] = 1500;
	$param["product_id"] = 1;
	$param["leadidentifier"] = "smsplleads";
	
//	$dated = ExactServerdate();
	echo "<br>";
	print_r($param);
	echo "<br>";
 
	$request = '';
	foreach($param as $key=>$val) //traverse through each member of the param array
	{ 
	  $request.= $key."=".urlencode($val); //we have to urlencode the values
	  $request.= "&"; //append the ampersand (&) sign after each paramter/value pair
	}
	$request = substr($request, 0, strlen($request)-1); //remove the final ampersand sign from the request
//192.168.1.201/vicidial/dialer_lead.php?c_name=Jitendra&p_number=9694666974&list_id=2001&unique_id=testing&product_id=10&leadidentifier=my


	//echo $request."<br><br>";
	echo  $url = "https://122.176.122.134/vicidial/dialer_lead.php?".$request;
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	//curl_setopt ($ch, CURLOPT_POST, 1);
	$content = curl_exec ($ch);
	echo "<br>";
	echo "<br>";
	print_r($content);
	echo "<br>";
	$explodeVal = explode(',',$content);
	$ReqservID = $explodeVal[0];
	$list_id = $explodeVal[1];
	$ReqID = $explodeVal[2];
	$status = $explodeVal[3];
	
	curl_close ($ch);
	echo $UpdateSQl = "update Req_Dialer_Records_PL set Feedback = '".$status."', DialerID = '".$ReqservID."' where ID = '".$lastID."' and RequestID='".$ReqID."'";
	ExecQuery($UpdateSQl);
	
}
?>	