<?php
class Admins{
	var $dbObj;
	
	function Admins(){ // class constructor
		$this->dbObj = new DB();
		$this->dbObj->fun_db_connect();
	}
	
	function fun_check_page_access($BidderID, $file_name, $leadidentifier=''){ // this function checked specific page can be accessed by the bidder for current session or not
		$unameFound = false;
		$sqlCheck = "SELECT login_url FROM  lms_access_attributes WHERE status=1 AND file_name='".$file_name."' ";
		if($leadidentifier!="" && $BidderID!=""){
			$sqlCheck .= " AND (BidderID='".$BidderID."' OR leadidentifier='".$leadidentifier."')";
		}
		else if($leadidentifier==""){
			$sqlCheck .= " AND BidderID='".$BidderID."'";
		}
		else if($BidderID==""){
			$sqlCheck .= " AND leadidentifier='".$leadidentifier."'";
		}
		//echo $sqlCheck;
		if($this->fun_get_num_rows($sqlCheck) > 0) {
			$unameFound = true;
		}
		return $unameFound;
	}
	
	function fun_check_username_admin_existance($username, $sID=''){ // this function checked checks wheather username exists or not
		$unameFound = false;
		$sqlCheck = "SELECT Email FROM " . TABLE_BIDDERS . " WHERE Email='".fun_db_input($username)."' ";
		if($auID!=""){
			$sqlCheck .= " AND BidderID<>'".(int)$sID."'";
		}
		if($this->fun_get_num_rows($sqlCheck) > 0){
			$unameFound = true;
		}
		return $unameFound;
	}
	function fun_check_username_bladmin_existance($username, $sID=''){ // this function checked checks wheather username exists or not
		$unameFound = false;
		$sqlCheck = "SELECT Email FROM " . TABLE_BIDDERS . " WHERE Email='".fun_db_input($username)."' ";
		if($auID!=""){
			$sqlCheck .= " AND BidderID<>'".(int)$sID."'";
		}
		$sqlCheck .= " AND leadidentifier in ('blmainlms', 'agent_othermetros', 'CallerLAP', 'MISPL', 'MISBL', 'MIS_BL', 'MISCC','hdfcbusinessloan','HDFCMISBL','CallingHDFCBL','MFbrokerAdmin','capitalfirstSalLMS') ";
		if($this->fun_get_num_rows($sqlCheck) > 0){
			$unameFound = true;
		}
		return $unameFound;
	}
	function fun_get_num_rows($sql){
		$totalRows = 0;
		$selected = "";
		$sql = trim($sql);
		if($sql==""){
			die("<font color='#ff0000' face='verdana' face='2'>Error: Query is Empty!</font>");
			exit;
		}
		$result = $this->dbObj->fun_db_query($sql);
		$totalRows = $this->dbObj->fun_db_get_num_rows($result);
		$this->dbObj->fun_db_free_resultset($result);
		return $totalRows;
	}
	
	function fun_check_pwd_admin_existance($pwd, $sID=''){ // this function checked checks wheather username exists or not
		$pwdFound = false;
		$sqlCheck = "SELECT PWD FROM " . TABLE_BIDDERS . " WHERE PWD='".fun_db_input($pwd)."' ";
		if($sID!=""){
			$sqlCheck .= " AND BidderID<>'".(int)$sID."'";
		}
		if($this->fun_get_num_rows($sqlCheck) > 0){
			$pwdFound = true;
		}
		return $pwdFound;
	}
	function fun_check_pwd_bladmin_existance($pwd, $sID=''){ // this function checked checks wheather username exists or not
		$pwdFound = false;
		$sqlCheck = "SELECT PWD FROM " . TABLE_BIDDERS . " WHERE PWD='".fun_db_input($pwd)."' ";
		if($sID!=""){
			$sqlCheck .= " AND BidderID<>'".(int)$sID."'";
		}
		$sqlCheck .= " AND leadidentifier  in ('blmainlms', 'agent_othermetros', 'CallerLAP', 'MISPL', 'MISBL', 'MIS_BL', 'MISCC','hdfcbusinessloan','HDFCMISBL','CallingHDFCBL','MFbrokerAdmin','capitalfirstSalLMS') ";
		if($this->fun_get_num_rows($sqlCheck) > 0){
			$pwdFound = true;
		}
		return $pwdFound;
	}
	
	
function fun_verify_admins($username, $password){
		$sqlCheck = "SELECT Email, PWD FROM " . TABLE_BIDDERS . " WHERE Email='".fun_db_input($username)."' AND PWD='".fun_db_input($password)."'";
		 $result = $this->dbObj->fun_db_query($sqlCheck) or die("<font color='#ff0000' face='verdana' size='2'>Error: Unable to execute request!</font>");
		if(!$result || $this->dbObj->fun_db_get_num_rows($result) < 1){
			return false; // ADMIN does not exists
		}
		
		$rowsPass = $this->dbObj->fun_db_fetch_rs_object($result);
		$adminPass = fun_db_output($rowsPass->PWD);
		$this->dbObj->fun_db_free_resultset($result);
		if($adminPass == $password){
			return true; // ADMIN exists
		}else{
			return false; // ADMIN does not exists
		}
	}
	
	function fun_getAdminUserInfo($ID=0, $Username='',$Password=''){
		$sql = $sqlCheck = "SELECT * FROM " . TABLE_BIDDERS;
		if($Username==""){
			$sql .= " WHERE BidderID='".(int)$ID."'";
		}else{
			$sql .= " WHERE Email='".fun_db_input($Username)."' AND PWD='".$Password."'";
		}
		$result = $this->dbObj->fun_db_query($sql) or die("<font color='#ff0000' face='verdana' size='2'>Error: Unable to execute request!</font>");
		$rowsAdmin = $this->dbObj->fun_db_fetch_rs_object($result);
		$adminArray = array(
							"BidderID" => fun_db_output($rowsAdmin->BidderID),
							"Email" => fun_db_output($rowsAdmin->Email),
							"PWD" => fun_db_output($rowsAdmin->PWD),
							"Bidder_Name" => fun_db_output($rowsAdmin->Bidder_Name),
							"Associated_Bank" => fun_db_output($rowsAdmin->Associated_Bank),
                                                        "Process_Name" => fun_db_output($rowsAdmin->Process_Name),
							"Selection_Category" => fun_db_output($rowsAdmin->Selection_Category),
							"City" => fun_db_output($rowsAdmin->City),
							"Address" => fun_db_output($rowsAdmin->Address),
							"Website" => fun_db_output($rowsAdmin->Website),
							"Email_old" => fun_db_output($rowsAdmin->Email_old),
							"Contact_Num" => fun_db_output($rowsAdmin->Contact_Num),
							"Profile" => fun_db_output($rowsAdmin->Profile),
							"Join_Date" => fun_db_output($rowsAdmin->Join_Date),
							"Last_Login" => fun_db_output($rowsAdmin->Last_Login),
							"Count_Replies" => fun_db_output($rowsAdmin->Count_Replies),
							"Has_New_Reply" => fun_db_output($rowsAdmin->Has_New_Reply),
							"Is_Verified" => fun_db_output($rowsAdmin->Is_Verified),
							"Reply_Type" => fun_db_output($rowsAdmin->Reply_Type),
							"BidderEmailID" => fun_db_output($rowsAdmin->BidderEmailID),
							"FeedbackMailID" => fun_db_output($rowsAdmin->FeedbackMailID),
							"BD_Name" => fun_db_output($rowsAdmin->BD_Name),
							"Manager_Name" => fun_db_output($rowsAdmin->Manager_Name),
							"BD_Number" => fun_db_output($rowsAdmin->BD_Number),
							"Define_PrePost" => fun_db_output($rowsAdmin->Define_PrePost),
							"Prepaid_Amount" => fun_db_output($rowsAdmin->Prepaid_Amount),
							"leadidentifier" => fun_db_output($rowsAdmin->leadidentifier),							
							"CallStatus" => fun_db_output($rowsAdmin->CallStatus),							
							"Global_Access_ID" => fun_db_output($rowsAdmin->Global_Access_ID),
						);
		$this->dbObj->fun_db_free_resultset($result);
		return $adminArray;
	}

	function fun_authenticate_admin(){
			$msg ="Your session has been expired!";
			echo "<script language=\"javascript\">parent.location.href=\"lmslogin.php?msg=".urlencode($msg)."\";</script>";die;
	}

	function fun_authenticate_admin_pl(){
			$msg ="Your session has been expired!";
			echo "<script language=\"javascript\">parent.location.href=\"pllmslogin.php?msg=".urlencode($msg)."\";</script>";die;
	}
	function fun_authenticate_admin_hl(){
			$msg ="Your session has been expired!";
			echo "<script language=\"javascript\">parent.location.href=\"hllmslogin.php?msg=".urlencode($msg)."\";</script>";die;
	}
	function fun_authenticate_admin_busloan(){
		$msg ="Your session has been expired!";
			echo "<script language=\"javascript\">parent.location.href=\"login.php?msg=".urlencode($msg)."\";</script>";die;
	}

//Redirect Url
function redirectURL($rurl){
	header("Location: " . $rurl);
	exit;
}


function SendSMSforLMS($SMSMessage, $PhoneNumber)
{
	$request = ""; //initialize the request variable
	
	// 6161
	$param["pcode"] = "MICROFINANCIAL"; 
	$param["acode"] = "MICROFINANCIAL"; 
	$param["message"] = $SMSMessage; //this is the message that we want to send
	$param["mnumber"] = "91".$PhoneNumber; //these are the recipients of the message
	$param["pin"] = "mi@1";
	

	foreach($param as $key=>$val) //traverse through each member of the param array
	{ 
	  $request.= $key."=".urlencode($val); //we have to urlencode the values
	  $request.= "&"; //append the ampersand (&) sign after each paramter/value pair
	}
	$request = substr($request, 0, strlen($request)-1); //remove the final ampersand sign from the request

	//First prepare the info that relates to the connection
	$host = "luna.a2wi.co.in:7501";
	$script = "/failsafe/HttpPublishLink";
	$request_length = strlen($request);
	$method = "POST"; // must be POST if sending multiple messages
	if ($method == "GET") 
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
	  	$Promocode = $param["pcode"];
		$selectSql = "select * from track_sms where pcode = '".$Promocode."'";
		$selectQuery = $this->dbObj->fun_db_query($selectSql);
		$smsCount = $this->dbObj->fun_db_fetch_rs_object($selectQuery,0,'smscount');
		if($smsCount==0)
		{
			$incrementSms = 1;
		}
		else
		{
			$incrementSms = $smsCount - 1;
		}
		$updateSql = "update track_sms set smscount = '".$incrementSms."', date = now() where pcode = '".$Promocode."'";
		$updateQuery = $this->dbObj->fun_db_query($updateSql);

	} 
}

function funGetCityOptions($City)
		{
			$selected = "";
			$sql = trim($sql);
			$sql .= "SELECT * FROM ".TABLE_REQ_LOAN_PERSONAL." WHERE City!='-' AND City!=''  GROUP BY City ";
			$result = $this->dbObj->fun_db_query($sql);
			while($rowsCon = $this->dbObj->fun_db_fetch_rs_object($result))
				{
					if($rowsCon->City==$City && $City!="")
						{
							$selected = "selected";	
						}
					else
						{
							$selected = "";	
						}	
					echo "<option value=\"".fun_db_output($rowsCon->City)."\" ".$selected.">";
					echo fun_db_output($rowsCon->City);
					echo "</option>";
				}
			$this->dbObj->fun_db_free_resultset($result); 
		}
	
	function funGetBajajCityOptions($City)
		{
			$selected = "";
			$sql = trim($sql);
		$sql .= "SELECT City FROM ".TABLE_BIDDERS." WHERE BidderID in (2430, 2431, 4631, 2435, 2437, 2441, 5637, 5636, 5638, 5682, 2444, 2445, 2448, 5681, 2449, 2450, 2451, 2476, 3629, 4912, 5736, 5074, 5078, 5457, 4928, 5419, 5741, 5740, 5984, 5981, 5982, 6152, 5983, 6154, 5985, 6155, 6153, 5986, 6151, 5987, 5988) AND  City!='-' AND City!='' ORDER BY City ASC";
			$result = $this->dbObj->fun_db_query($sql);
			while($rowsCon = $this->dbObj->fun_db_fetch_rs_object($result))
				{
					if($rowsCon->City==$City && $City!="")
						{
							$selected = "selected";	
						}
					else
						{
							$selected = "";	
						}	
					echo "<option value=\"".fun_db_output($rowsCon->City)."\" ".$selected.">";
					echo fun_db_output($rowsCon->City);
					echo "</option>";
				}
			$this->dbObj->fun_db_free_resultset($result); 
		}	

}
?>