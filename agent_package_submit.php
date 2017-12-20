<?php
	require 'scripts/session_check_online.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';

	$Pid = $_POST['Pid'];
	$Rid = $_POST['Rid'];
	
	$sqlGetPackages = "select * from product_for_sale where Pid = '".$Pid."' ";
	$queryGetPackages = ExecQuery($sqlGetPackages);
	
	$sqlTrack = "select * from package_purchase_details where Rid = '".$Rid."' ";
	$queryTrack = ExecQuery($sqlTrack);
	
	$sql = "select * from Req_Agent_Pay where A_ID = '".$_SESSION['Aid']."'";
	$query = ExecQuery($sql);

	$MAmount = mysql_result($queryGetPackages,0,'Total_Cost');
	$MTrackid = mysql_result($queryTrack,0,'MTrackid');
	//$Rid
	//$Pid
	$email = mysql_result($query,0,'A_Email');
	$mobile = mysql_result($query,0,'A_Mobile');
	$address = mysql_result($query,0,'Address');
	$address = preg_replace('/[^a-zA-Z0-9_ -]/s', ' ', $address);

	$param['MAmount'] = $MAmount ;  
	$param['MTrackid'] = $MTrackid ;  
	$param['Rid'] = $Rid ;  
	$param['Pid'] = $Pid ;  
	$param['email'] = $email ;  
	$param['mobile'] = $mobile ; 
	$param['address'] = $address ;  
				
	$request = '';
	foreach($param as $key=>$val) //traverse through each member of the param array
	{ 
	  $request.= $key."=".urlencode($val); //we have to urlencode the values
	  $request.= "&"; //append the ampersand (&) sign after each paramter/value pair
	}
	$request = substr($request, 0, strlen($request)-1); //remove the final ampersand sign from the request

//echo "<br>";
//echo $request;
//echo "<br>";
//exit();

//First prepare the info that relates to the connection
			$host = "deal4loans.com";
		//	$script = "/lom/insurance/hi_submit.php";
			$script = "/Send_Perform_REQuest.php";
			
			$request_length = strlen($request);
			$method = "POST"; // must be POST if sending multiple messages
			if ($method == "POST") 
			{
			  $script .= "?$request";
			}
		
			//Now comes the header which we are going to post. 
			$header = "$method $script HTTP/1.1\r\n";
			$header .= "Host: $host\r\n";
			$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
			$header .= "Content-Length: $request_length\r\n";
			$header .= "Connection: close\r\n\r\n";
			$header .= "$request\r\n";
		
			echo $header;
			echo "<br>";
		
			//Now we open up the connection
			$socket = @fsockopen($host, 80, $errno, $errstr); 
			if ($socket) //if its open, then...
			{ 
			  fputs($socket, $header); // send the details over
			  while(!feof($socket))
			  {
				$output[] = fgets($socket); //get the results 
			  }
			  fclose($socket); 
			} 
?>