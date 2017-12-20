<?php
ini_set('session.gc_maxlifetime', 40*60); // 30 minutes
session_start();
require_once("includes/common.php");
require_once("includes/database-table.php");
require_once("includes/classes/class.DB.php");
require_once("includes/functions/general.php");
require_once("includes/classes/class.Admins.php");
$obj = new DB();
$objAdmin = new Admins(); // for login

?>