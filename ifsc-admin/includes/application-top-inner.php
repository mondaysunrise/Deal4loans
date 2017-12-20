<?php
session_start();

require_once("includes/common.php");
require_once("includes/database-table.php");
require_once("includes/classes/class.DB.php");
require_once("includes/functions/general.php");
require_once("includes/classes/class.Admins.php");

$obj = new DB();
$objAdmin = new Admins(); // for login

if(($_SESSION['Email']=="") )
{
	$objAdmin->fun_authenticate_admin($_SESSION['BidderID']); die;
}
?>