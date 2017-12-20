<?php
session_start();

require_once("includes/common.php");
require_once("includes/database-table.php");
require_once("includes/classes/class.DB.php");
require_once("includes/functions/general.php");
require_once("includes/classes/class.Admins.php");
require_once("includes/eligiblebidderfuncPL.php");

$obj = new DB();
$objAdmin = new Admins(); // for login
$objeligiblebidderfuncPL = new eligiblebidderfuncPL(); // EligibilityFunPL

if(($_SESSION['Email']=="") && ($_SESSION['BidderID']==""))
{
	$objAdmin->fun_authenticate_admin_plagents($_SESSION['BidderID']); die;
}
?>