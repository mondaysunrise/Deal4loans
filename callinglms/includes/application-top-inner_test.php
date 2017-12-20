<?php
ini_set('session.gc_maxlifetime', 40*60); // 40 minutes
session_start();

require_once("includes/common.php");
require_once("includes/database-table.php");
require_once("includes/classes/class.DB.php");
//require_once("includes/classes/class.DB.WF.php");
require_once("includes/functions/general.php");
require_once("includes/classes/class.Admins.php");
require_once("includes/eligiblebidderfuncPL.php");

$obj = new DB();
//$objwf = new DBWF();
$objAdmin = new Admins(); // for login
$objeligiblebidderfuncPL = new eligiblebidderfuncPL(); // EligibilityFunPL

if(($_SESSION['Email']=="") && ($_SESSION['BidderID']==""))
{
	$objAdmin->fun_authenticate_admin($_SESSION['BidderID']); die;
}

if (!$objAdmin->fun_check_page_access($_SESSION['BidderID'], $_SERVER['SCRIPT_NAME'], $_SESSION['leadidentifier'])) 
{
	echo "Not Authorised.";
	//User not allowed to access
    //Expire the session
    session_unset(); session_destroy(); echo '<meta http-equiv="refresh" content="5; URL=http://www.deal4loans.com/login_access_denied.php">';
	die(); 
	
}
?>