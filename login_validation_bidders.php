<?php
function fun_check_page_access($BidderID, $file_name, $leadidentifier='') { // this function checked specific page can be accessed by the bidder for current session or not
		$unameFound = false;
		$sqlCheck = "SELECT * FROM  lms_access_attributes WHERE status=1 AND file_name='".$file_name."' ";
		if($leadidentifier!="" && $BidderID!=""){
			$sqlCheck .= " AND BidderID='".$BidderID."' OR leadidentifier='".$leadidentifier."'";
		}
		else if($leadidentifier==""){
			$sqlCheck .= " AND BidderID='".$BidderID."' ";
		}
		else if($BidderID==""){
			$sqlCheck .= " AND leadidentifier='".$leadidentifier."' ";
		}
		//echo $sqlCheck;
		$result = d4l_ExecQuery($sqlCheck);
		$num_rows = d4l_mysql_num_rows($result);
		
		if($num_rows > 0) {
			$unameFound = true;
		}
		return $unameFound;
	}

 if (!fun_check_page_access($_SESSION['BidderID'], $_SERVER['SCRIPT_NAME'], $_SESSION['leadidentifier'])) {
			//User not allowed to access
            //Expire the session
            session_unset();
			session_destroy();
			echo "Not Authorised.";
			echo '<meta http-equiv="refresh" content="5; URL=http://www.deal4loans.com/login_access_denied.php">';	die(); 
        }
?>