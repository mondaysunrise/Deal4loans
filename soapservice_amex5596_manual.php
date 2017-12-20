<? $param["chosenCard"]="gold";
	$param["fname"] = "shweta";
	$param["mname"] = "";
	$param["lname"] = "Lead";
	$param["email"] = "stest@gmail.com";
	$param["mobile"] = "9717594462";
	$param["dd"] = "01";
	$param["mm"] = "01";
	$param["yy"] = "1980";
	$param["gender"] = "Male";
	$param["pancard"]  = "AAAPA1111A";
	$param["annual_income"] = "800000";
	$param["address"] = "new home address";
	$param["address2"] = "";
	$param["address3"] = "";
	$param["city"] = "Bangalore";
	$param["state"] = "Karnataka";
	$param["pincode"] = "110001";
	$param["disclaimer"] = "i agree";
	$param["siteid"] = "deal4loan";
	$param["ip"] = "122.161.196.68";

$request = '';
		foreach($param as $key=>$val) //traverse through each member of the param array
		{ 
		  $request.= $key."=".urlencode($val); //we have to urlencode the values
		  $request.= "&"; //append the ampersand (&) sign after each paramter/value pair
		}
		//$request = rawurldecode(substr($request, 0, strlen($request)-1)); //remove the final ampersand sign from the request
	
		$request = substr($request, 0, strlen($request)-1);
		$url = "https://www.americanexpressindia.co.in/submitLeadprequal.ashx?".$request;
		echo $url;
		echo "<br>";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
		//curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);		
		$content = curl_exec ($ch);
		print_r($content); 
		curl_close ($ch);  
		echo "<br>";
		echo $outputstr=$content;
		echo "<br>";
echo "<br><br>";

?>