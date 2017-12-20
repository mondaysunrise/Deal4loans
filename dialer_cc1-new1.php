<?php
//Testing File Not in USE
//5657

	//c_name=Jitendra&p_number=9694666974&list_id=2001&unique_id=testing&product_id=10&leadidentifier=my
	$lastID = $plrow["id"];
	$param = '';
	$param["c_name"] = "Upendra";
	$param["p_number"] = 9971396361;
	$param["unique_id"] = 842569;
	$param["list_id"] = 1501;
	$param["product_id"] = 4;
	$param["leadidentifier"] = "diallerleadcc";
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

	//$InsertSQl = "INSERT INTO Req_Dialer_Records_PL (Reply_Type, RequestID, Name, Mobile_Number, Feedback, Dated,dialer_camp_id) VALUES ('4', '".$param["unique_id"]."', '".$param["c_name"]."', '".$param["p_number"]."', '', '".$dated."', '1501')";
//	$InsertQuery = ExecQuery($InsertSQl);
	//$lastID =mysql_insert_id();

	//echo $request."<br><br>";
	//https://192.168.1.250/webclient/reports/deal4loan.php?Name=Upendra+Kumar&Mobile_Number=9971396363&UniqueID=1997361&list_id=1000
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

?>	
