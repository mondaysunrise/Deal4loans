<?php
require 'scripts/db_init.php';
require 'scripts/functions_nw.php';
define("TABLE_REQ_LOAN_PERSONAL", "Req_Loan_Personal");



function bajajfinallocate()
{
	$feedback_tble="lead_allocate";
	$BidderIDstatic = "(6029)";
	
	$query1="select RequestID, Dated from Req_Compaign Where ( Compaign_ID=6536 and Reply_Type=1)";
	
	$result = ExecQuery($query1);
	$qrow = mysql_fetch_array($result);
	$RequestID = $qrow['RequestID'];
	$Dated = $qrow['Dated'];
	$Reply_Type=1;
	$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-1, date("Y"));
	$currentdate = date('Y-m-d');
	$todaydate = date('Y-m-d');
	if($RequestID>0)
	{
		$qrysql = "SELECT Name,RequestID,Mobile_Number FROM ".$feedback_tble.",".TABLE_REQ_LOAN_PERSONAL." WHERE ".$feedback_tble.".AllRequestID=".TABLE_REQ_LOAN_PERSONAL.".RequestID and ".$feedback_tble.".BidderID in ".$BidderIDstatic." and ".$feedback_tble.".Reply_Type=1 and ( ".$feedback_tble.".Allocation_Date Between '".$Dated."' and '".$todaydate." 23:59:59') and ".TABLE_REQ_LOAN_PERSONAL.".RequestID >'".$RequestID."' ";
		
	}
	else
	{
		$qrysql = "SELECT Name,RequestID,Mobile_Number FROM ".$feedback_tble.",".TABLE_REQ_LOAN_PERSONAL." WHERE ".$feedback_tble.".AllRequestID=".TABLE_REQ_LOAN_PERSONAL.".RequestID and ".$feedback_tble.".BidderID in ".$BidderIDstatic." and ".$feedback_tble.".Reply_Type=1 and ( ".$feedback_tble.".Allocation_Date Between '".$Dated."' and '".$todaydate." 23:59:59')";
	}
	
	//$qrysql = "SELECT Name,RequestID,Mobile_Number FROM ".$feedback_tble.",".TABLE_REQ_LOAN_PERSONAL." WHERE ".$feedback_tble.".AllRequestID=".TABLE_REQ_LOAN_PERSONAL.".RequestID and ".$feedback_tble.".BidderID in ".$BidderIDstatic." and ".$feedback_tble.".Reply_Type=1 and ( ".$feedback_tble.".Allocation_Date Between '".$Dated."' and '".$todaydate." 23:59:59')";
	echo $qrysql."<br>";
	$qrysqlresult = ExecQuery($qrysql);
	
	$recordcount1 = mysql_num_rows($qrysqlresult);

echo "Num Rows - ".$recordcount1;
//die();
	$param = '';
	while($plrow = mysql_fetch_array($qrysqlresult))
	{
			//?Name=Upendra+Kumar&Mobile_Number=9971396363&UniqueID=1997361&list_id=1000
		$param["Name"] = trim($plrow["Name"]);
		$param["Mobile_Number"] = "0".$plrow["Mobile_Number"];
		$param["UniqueID"] = $plrow["RequestID"];
		$param["LeadIdentifier"] = "calllmsbajajfinservpl";
		$param["campaignId"] = 1006;
		$param["feedback"] = "No feedback";
		$dated = ExactServerdate();
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
	
		$InsertSQl = "INSERT INTO Req_Dialer_Records_PL (Reply_Type, RequestID, Name, Mobile_Number, Feedback, Dated) VALUES ('".$Reply_Type."', '".$param["UniqueID"]."', '".$param["Name"]."', '".$param["Mobile_Number"]."', '', '".$dated."')";
		$InsertQuery = ExecQuery($InsertSQl);
		$lastID =mysql_insert_id();
	
		//echo $request."<br><br>";
		//https://192.168.1.250/webclient/reports/deal4loan.php?Name=Upendra+Kumar&Mobile_Number=9971396363&UniqueID=1997361&list_id=1000
		echo  $url = "https://122.176.122.134/webclient/reports/deal4loan.php?".$request;
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
		$ReqID = $explodeVal[0];
		$ReqservID = $explodeVal[1];
		$status = $explodeVal[2];
		
		echo "<br>";
		echo $UpdateSQl = "update Req_Dialer_Records_PL set Feedback = '".$status."', dialer_camp_id='1006', DialerID = '".$ReqservID."' where ID = '".$lastID."' and RequestID='".$ReqID."'";
		ExecQuery($UpdateSQl);
		
		//echo $InsertSQl;
		$updateSql = "update Req_Compaign set RequestID='".$ReqID."', Dated=Now() where ( Compaign_ID=6536 and Reply_Type=1)";
		ExecQuery($updateSql);
		echo "<br>";
		//  print_r($content); 
		curl_close ($ch);
	}	
}

//Function 2
function kotakbankplallocate()
{
	$feedback_tble="lead_allocate";
	$BidderIDstatic = "(6031)";
	
	$query1="select RequestID, Dated from Req_Compaign Where ( Compaign_ID=6532 and Reply_Type=1)";
	
	$result = ExecQuery($query1);
	$qrow = mysql_fetch_array($result);
	$RequestID = $qrow['RequestID'];
	$Dated = $qrow['Dated'];
	$Reply_Type=1;
	$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-1, date("Y"));
	$currentdate = date('Y-m-d');
	$todaydate = date('Y-m-d');
	if($RequestID>0)
	{
		$qrysql = "SELECT Name,RequestID,Mobile_Number FROM ".$feedback_tble.",".TABLE_REQ_LOAN_PERSONAL." WHERE ".$feedback_tble.".AllRequestID=".TABLE_REQ_LOAN_PERSONAL.".RequestID and ".$feedback_tble.".BidderID in ".$BidderIDstatic." and ".$feedback_tble.".Reply_Type=1 and ( ".$feedback_tble.".Allocation_Date Between '".$Dated."' and '".$todaydate." 23:59:59') and ".TABLE_REQ_LOAN_PERSONAL.".RequestID >'".$RequestID."' ";
		
	}
	else
	{
		$qrysql = "SELECT Name,RequestID,Mobile_Number FROM ".$feedback_tble.",".TABLE_REQ_LOAN_PERSONAL." WHERE ".$feedback_tble.".AllRequestID=".TABLE_REQ_LOAN_PERSONAL.".RequestID and ".$feedback_tble.".BidderID in ".$BidderIDstatic." and ".$feedback_tble.".Reply_Type=1 and ( ".$feedback_tble.".Allocation_Date Between '".$Dated."' and '".$todaydate." 23:59:59')";
	}
	
	$qrysqlresult = ExecQuery($qrysql);
		$recordcount1 = mysql_num_rows($qrysqlresult);

echo "Num Rows - ".$recordcount1;
//die();
	$param = '';
	while($plrow = mysql_fetch_array($qrysqlresult))
	{
			//?Name=Upendra+Kumar&Mobile_Number=9971396363&UniqueID=1997361&list_id=1000
		$param["Name"] = trim($plrow["Name"]);
		$param["Mobile_Number"] = "0".$plrow["Mobile_Number"];
		$param["UniqueID"] = $plrow["RequestID"];
		$param["LeadIdentifier"] = "calllmskotakbankpl";
		$param["campaignId"] = 1002;
		$param["feedback"] = "No feedback";
		$dated = ExactServerdate();
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
	
		$InsertSQl = "INSERT INTO Req_Dialer_Records_PL (Reply_Type, RequestID, Name, Mobile_Number, Feedback, Dated) VALUES ('".$Reply_Type."', '".$param["UniqueID"]."', '".$param["Name"]."', '".$param["Mobile_Number"]."', '', '".$dated."')";
		$InsertQuery = ExecQuery($InsertSQl);
		$lastID =mysql_insert_id();
	
		//echo $request."<br><br>";
		//https://192.168.1.250/webclient/reports/deal4loan.php?Name=Upendra+Kumar&Mobile_Number=9971396363&UniqueID=1997361&list_id=1000
		echo  $url = "https://122.176.122.134/webclient/reports/deal4loan.php?".$request;
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
		$ReqID = $explodeVal[0];
		$ReqservID = $explodeVal[1];
		$status = $explodeVal[2];
		
		echo "<br>";
		echo $UpdateSQl = "update Req_Dialer_Records_PL set Feedback = '".$status."', dialer_camp_id='1002', DialerID = '".$ReqservID."' where ID = '".$lastID."' and RequestID='".$ReqID."'";
		ExecQuery($UpdateSQl);
		
		//echo $InsertSQl;
		$updateSql = "update Req_Compaign set RequestID='".$ReqID."', Dated=Now() where ( Compaign_ID=6532 and Reply_Type=1)";
		ExecQuery($updateSql);
		echo "<br>";
		//  print_r($content); 
		curl_close ($ch);
	}	
}


//Function 3 

function indusindplallocate()
{
	$feedback_tble="lead_allocate";
	$BidderIDstatic = "(6030)";
	
	$query1="select RequestID, Dated from Req_Compaign Where ( Compaign_ID=6537 and Reply_Type=1)";
	
	$result = ExecQuery($query1);
	$qrow = mysql_fetch_array($result);
	$RequestID = $qrow['RequestID'];
	$Dated = $qrow['Dated'];
	$Reply_Type=1;
	$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-1, date("Y"));
	$currentdate = date('Y-m-d');
	$todaydate = date('Y-m-d');
	if($RequestID>0)
	{
		$qrysql = "SELECT Name,RequestID,Mobile_Number FROM ".$feedback_tble.",".TABLE_REQ_LOAN_PERSONAL." WHERE ".$feedback_tble.".AllRequestID=".TABLE_REQ_LOAN_PERSONAL.".RequestID and ".$feedback_tble.".BidderID in ".$BidderIDstatic." and ".$feedback_tble.".Reply_Type=1 and ( ".$feedback_tble.".Allocation_Date Between '".$Dated."' and '".$todaydate." 23:59:59') and ".TABLE_REQ_LOAN_PERSONAL.".RequestID >'".$RequestID."' ";
		
	}
	else
	{
		$qrysql = "SELECT Name,RequestID,Mobile_Number FROM ".$feedback_tble.",".TABLE_REQ_LOAN_PERSONAL." WHERE ".$feedback_tble.".AllRequestID=".TABLE_REQ_LOAN_PERSONAL.".RequestID and ".$feedback_tble.".BidderID in ".$BidderIDstatic." and ".$feedback_tble.".Reply_Type=1 and ( ".$feedback_tble.".Allocation_Date Between '".$Dated."' and '".$todaydate." 23:59:59')";
	}
		
	echo $qrysql."<br>";
	$qrysqlresult = ExecQuery($qrysql);
	
	$param = '';
	while($plrow = mysql_fetch_array($qrysqlresult))
	{
			//?Name=Upendra+Kumar&Mobile_Number=9971396363&UniqueID=1997361&list_id=1000
		$param["Name"] = trim($plrow["Name"]);
		$param["Mobile_Number"] = "0".$plrow["Mobile_Number"];
		$param["UniqueID"] = $plrow["RequestID"];
		$param["LeadIdentifier"] = "calllmsindusindbankpl";
		$param["campaignId"] = 1005;
		$param["feedback"] = "No feedback";
		$dated = ExactServerdate();
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
	
		$InsertSQl = "INSERT INTO Req_Dialer_Records_PL (Reply_Type, RequestID, Name, Mobile_Number, Feedback, Dated) VALUES ('".$Reply_Type."', '".$param["UniqueID"]."', '".$param["Name"]."', '".$param["Mobile_Number"]."', '', '".$dated."')";
		$InsertQuery = ExecQuery($InsertSQl);
		$lastID =mysql_insert_id();
	
		//echo $request."<br><br>";
		//https://192.168.1.250/webclient/reports/deal4loan.php?Name=Upendra+Kumar&Mobile_Number=9971396363&UniqueID=1997361&list_id=1000
		echo  $url = "https://122.176.122.134/webclient/reports/deal4loan.php?".$request;
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
		$ReqID = $explodeVal[0];
		$ReqservID = $explodeVal[1];
		$status = $explodeVal[2];
		
		echo "<br>";
		echo $UpdateSQl = "update Req_Dialer_Records_PL set Feedback = '".$status."', DialerID = '".$ReqservID."', dialer_camp_id='1005' where ID = '".$lastID."' and RequestID='".$ReqID."'";
		ExecQuery($UpdateSQl);
		
		//echo $InsertSQl;
		$updateSql = "update Req_Compaign set RequestID='".$ReqID."', Dated=Now() where ( Compaign_ID=6537 and Reply_Type=1)";
		ExecQuery($updateSql);
		echo "<br>";
		//  print_r($content); 
		curl_close ($ch);
	}	
}


//Function 4
function hdfcbankplallocate()
{
	$feedback_tble="lead_allocate";
	$BidderIDstatic = "(6032)";
	
	$query1="select RequestID, Dated from Req_Compaign Where ( Compaign_ID=6533 and Reply_Type=1)";
	
	$result = ExecQuery($query1);
	$qrow = mysql_fetch_array($result);
	$RequestID = $qrow['RequestID'];
	$Dated = $qrow['Dated'];
	$Reply_Type=1;
	$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-1, date("Y"));
	$currentdate = date('Y-m-d');
	$todaydate = date('Y-m-d');
	if($RequestID>0)
	{
		$qrysql = "SELECT Name,RequestID,Mobile_Number FROM ".$feedback_tble.",".TABLE_REQ_LOAN_PERSONAL." WHERE ".$feedback_tble.".AllRequestID=".TABLE_REQ_LOAN_PERSONAL.".RequestID and ".$feedback_tble.".BidderID in ".$BidderIDstatic." and ".$feedback_tble.".Reply_Type=1 and ( ".$feedback_tble.".Allocation_Date Between '".$Dated."' and '".$todaydate." 23:59:59') and ".TABLE_REQ_LOAN_PERSONAL.".RequestID >'".$RequestID."' ";
		
	}
	else
	{
		$qrysql = "SELECT Name,RequestID,Mobile_Number FROM ".$feedback_tble.",".TABLE_REQ_LOAN_PERSONAL." WHERE ".$feedback_tble.".AllRequestID=".TABLE_REQ_LOAN_PERSONAL.".RequestID and ".$feedback_tble.".BidderID in ".$BidderIDstatic." and ".$feedback_tble.".Reply_Type=1 and ( ".$feedback_tble.".Allocation_Date Between '".$Dated."' and '".$todaydate." 23:59:59')";
	}
//	$Dated = date('Y-m-d')." 00:00:00";
	//$qrysql = "SELECT Name,RequestID,Mobile_Number FROM ".$feedback_tble.",".TABLE_REQ_LOAN_PERSONAL." WHERE ".$feedback_tble.".AllRequestID=".TABLE_REQ_LOAN_PERSONAL.".RequestID and ".$feedback_tble.".BidderID in ".$BidderIDstatic." and ".$feedback_tble.".Reply_Type=1 and ( ".$feedback_tble.".Allocation_Date Between '".$Dated."' and '".$todaydate." 23:59:59')";
	echo $qrysql."<br>";
	$qrysqlresult = ExecQuery($qrysql);
	//die();
	$param = '';
	while($plrow = mysql_fetch_array($qrysqlresult))
	{
			//?Name=Upendra+Kumar&Mobile_Number=9971396363&UniqueID=1997361&list_id=1000
		$param["Name"] = trim($plrow["Name"]);
		$param["Mobile_Number"] = "0".$plrow["Mobile_Number"];
		$param["UniqueID"] = $plrow["RequestID"];
		$param["LeadIdentifier"] = "calllmshdfcbanksmlctypl";
		$param["campaignId"] = 1003;
		$param["feedback"] = "No feedback";
		$dated = ExactServerdate();
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
	
		$InsertSQl = "INSERT INTO Req_Dialer_Records_PL (Reply_Type, RequestID, Name, Mobile_Number, Feedback, Dated) VALUES ('".$Reply_Type."', '".$param["UniqueID"]."', '".$param["Name"]."', '".$param["Mobile_Number"]."', '', '".$dated."')";
		$InsertQuery = ExecQuery($InsertSQl);
		$lastID =mysql_insert_id();
	
		//echo $request."<br><br>";
		//https://192.168.1.250/webclient/reports/deal4loan.php?Name=Upendra+Kumar&Mobile_Number=9971396363&UniqueID=1997361&list_id=1000
		echo  $url = "https://122.176.122.134/webclient/reports/deal4loan.php?".$request;
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
		$ReqID = $explodeVal[0];
		$ReqservID = $explodeVal[1];
		$status = $explodeVal[2];
		
		echo "<br>";
		echo $UpdateSQl = "update Req_Dialer_Records_PL set Feedback = '".$status."', DialerID = '".$ReqservID."', dialer_camp_id='1003' where ID = '".$lastID."' and RequestID='".$ReqID."'";
		ExecQuery($UpdateSQl);
		
		//echo $InsertSQl;
		$updateSql = "update Req_Compaign set RequestID='".$ReqID."', Dated=Now() where ( Compaign_ID=6533 and Reply_Type=1)";
		ExecQuery($updateSql);
		echo "<br>";
		//  print_r($content); 
		curl_close ($ch);
	}	
}
//Function 5
function hdfcbankplallocat2()
{
	$feedback_tble="lead_allocate";
	$BidderIDstatic = "(6033)";
	
	$query1="select RequestID, Dated from Req_Compaign Where ( Compaign_ID=6534 and Reply_Type=1)";
	
	$result = ExecQuery($query1);
	$qrow = mysql_fetch_array($result);
	$RequestID = $qrow['RequestID'];
	$Dated = $qrow['Dated'];
	$Reply_Type=1;
	$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-1, date("Y"));
	$currentdate = date('Y-m-d');
	$todaydate = date('Y-m-d');
	if($RequestID>0)
	{
		$qrysql = "SELECT Name,RequestID,Mobile_Number FROM ".$feedback_tble.",".TABLE_REQ_LOAN_PERSONAL." WHERE ".$feedback_tble.".AllRequestID=".TABLE_REQ_LOAN_PERSONAL.".RequestID and ".$feedback_tble.".BidderID in ".$BidderIDstatic." and ".$feedback_tble.".Reply_Type=1 and ( ".$feedback_tble.".Allocation_Date Between '".$Dated."' and '".$todaydate." 23:59:59') and ".TABLE_REQ_LOAN_PERSONAL.".RequestID >'".$RequestID."' ";
		
	}
	else
	{
		$qrysql = "SELECT Name,RequestID,Mobile_Number FROM ".$feedback_tble.",".TABLE_REQ_LOAN_PERSONAL." WHERE ".$feedback_tble.".AllRequestID=".TABLE_REQ_LOAN_PERSONAL.".RequestID and ".$feedback_tble.".BidderID in ".$BidderIDstatic." and ".$feedback_tble.".Reply_Type=1 and ( ".$feedback_tble.".Allocation_Date Between '".$Dated."' and '".$todaydate." 23:59:59')";
	}
	//$Dated = date('Y-m-d')." 00:00:00";
		//$qrysql = "SELECT Name,RequestID,Mobile_Number FROM ".$feedback_tble.",".TABLE_REQ_LOAN_PERSONAL." WHERE ".$feedback_tble.".AllRequestID=".TABLE_REQ_LOAN_PERSONAL.".RequestID and ".$feedback_tble.".BidderID in ".$BidderIDstatic." and ".$feedback_tble.".Reply_Type=1 and ( ".$feedback_tble.".Allocation_Date Between '".$Dated."' and '".$todaydate." 23:59:59')";
	echo $qrysql."<br>";
	$qrysqlresult = ExecQuery($qrysql);
//	die();
	$param = '';
	while($plrow = mysql_fetch_array($qrysqlresult))
	{
			//?Name=Upendra+Kumar&Mobile_Number=9971396363&UniqueID=1997361&list_id=1000
		$param["Name"] = trim($plrow["Name"]);
		$param["Mobile_Number"] = "0".$plrow["Mobile_Number"];
		$param["UniqueID"] = $plrow["RequestID"];
		$param["LeadIdentifier"] = "calllmshdfcbanksmlctypl";
		$param["campaignId"] = 1004;
		$param["feedback"] = "No feedback";
		$dated = ExactServerdate();
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
	
		$InsertSQl = "INSERT INTO Req_Dialer_Records_PL (Reply_Type, RequestID, Name, Mobile_Number, Feedback, Dated) VALUES ('".$Reply_Type."', '".$param["UniqueID"]."', '".$param["Name"]."', '".$param["Mobile_Number"]."', '', '".$dated."')";
		$InsertQuery = ExecQuery($InsertSQl);
		$lastID =mysql_insert_id();
	
		//echo $request."<br><br>";
		//https://192.168.1.250/webclient/reports/deal4loan.php?Name=Upendra+Kumar&Mobile_Number=9971396363&UniqueID=1997361&list_id=1000
		echo  $url = "https://122.176.122.134/webclient/reports/deal4loan.php?".$request;
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
		$ReqID = $explodeVal[0];
		$ReqservID = $explodeVal[1];
		$status = $explodeVal[2];
		
		echo "<br>";
		echo $UpdateSQl = "update Req_Dialer_Records_PL set Feedback = '".$status."', DialerID = '".$ReqservID."', dialer_camp_id='1004' where ID = '".$lastID."' and RequestID='".$ReqID."'";
		ExecQuery($UpdateSQl);
		
		//echo $InsertSQl;
		$updateSql = "update Req_Compaign set RequestID='".$ReqID."', Dated=Now() where ( Compaign_ID=6534 and Reply_Type=1)";
		ExecQuery($updateSql);
		echo "<br>";
		//  print_r($content); 
		curl_close ($ch);
	}	
}

//Function 6
function fullertonplallocate()
{
	$feedback_tble="lead_allocate";
	$BidderIDstatic = "(6043)";
	
	$query1="select RequestID, Dated from Req_Compaign Where ( Compaign_ID=6538 and Reply_Type=1)";
	
	$result = ExecQuery($query1);
	$qrow = mysql_fetch_array($result);
	$RequestID = $qrow['RequestID'];
	$Dated = $qrow['Dated'];
	$Reply_Type=1;
	$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-1, date("Y"));
	$currentdate = date('Y-m-d');
	$todaydate = date('Y-m-d');
	if($RequestID>0)
	{
		$qrysql = "SELECT Name,RequestID,Mobile_Number FROM ".$feedback_tble.",".TABLE_REQ_LOAN_PERSONAL." WHERE ".$feedback_tble.".AllRequestID=".TABLE_REQ_LOAN_PERSONAL.".RequestID and ".$feedback_tble.".BidderID in ".$BidderIDstatic." and ".$feedback_tble.".Reply_Type=1 and ( ".$feedback_tble.".Allocation_Date Between '".$Dated."' and '".$todaydate." 23:59:59') and ".TABLE_REQ_LOAN_PERSONAL.".RequestID >'".$RequestID."' ";
		
	}
	else
	{
		$qrysql = "SELECT Name,RequestID,Mobile_Number FROM ".$feedback_tble.",".TABLE_REQ_LOAN_PERSONAL." WHERE ".$feedback_tble.".AllRequestID=".TABLE_REQ_LOAN_PERSONAL.".RequestID and ".$feedback_tble.".BidderID in ".$BidderIDstatic." and ".$feedback_tble.".Reply_Type=1 and ( ".$feedback_tble.".Allocation_Date Between '".$Dated."' and '".$todaydate." 23:59:59')";
	}
	
	echo $qrysql."<br>";
	$qrysqlresult = ExecQuery($qrysql);
		$recordcount1 = mysql_num_rows($qrysqlresult);
	echo "Num Rows - ".$recordcount1;

//die();	
	$param = '';
	while($plrow = mysql_fetch_array($qrysqlresult))
	{
			//?Name=Upendra+Kumar&Mobile_Number=9971396363&UniqueID=1997361&list_id=1000
		$param["Name"] = trim($plrow["Name"]);
		$param["Mobile_Number"] = "0".$plrow["Mobile_Number"];
		$param["UniqueID"] = $plrow["RequestID"];
		$param["LeadIdentifier"] = "calllmsfullertonsmlctypl";
		$param["campaignId"] = 1008;
		$param["feedback"] = "No feedback";
		$dated = ExactServerdate();
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
	
		$InsertSQl = "INSERT INTO Req_Dialer_Records_PL (Reply_Type, RequestID, Name, Mobile_Number, Feedback, Dated) VALUES ('".$Reply_Type."', '".$param["UniqueID"]."', '".$param["Name"]."', '".$param["Mobile_Number"]."', '', '".$dated."')";
		$InsertQuery = ExecQuery($InsertSQl);
		$lastID =mysql_insert_id();
	
		//echo $request."<br><br>";
		//https://192.168.1.250/webclient/reports/deal4loan.php?Name=Upendra+Kumar&Mobile_Number=9971396363&UniqueID=1997361&list_id=1000
		echo  $url = "https://122.176.122.134/webclient/reports/deal4loan.php?".$request;
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
		$ReqID = $explodeVal[0];
		$ReqservID = $explodeVal[1];
		$status = $explodeVal[2];
		
		echo "<br>";
		echo $UpdateSQl = "update Req_Dialer_Records_PL set Feedback = '".$status."', DialerID = '".$ReqservID."', dialer_camp_id='1008' where ID = '".$lastID."' and RequestID='".$ReqID."'";
		ExecQuery($UpdateSQl);
		
		//echo $InsertSQl;
		$updateSql = "update Req_Compaign set RequestID='".$ReqID."', Dated=Now() where ( Compaign_ID=6538 and Reply_Type=1)";
		ExecQuery($updateSql);
		echo "<br>";
		//  print_r($content); 
		curl_close ($ch);
	}	
}

main();

function main()
{
	bajajfinallocate();
//	kotakbankplallocate();
	//indusindplallocate();
//	hdfcbankplallocate();
	//fullertonplallocate();
//	hdfcbankplallocat2();
}
?>	
