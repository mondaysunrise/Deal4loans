<?php 
session_start();

$CheckName = "Upendra";
$_SESSION['CheckName'] = $CheckName;

header("location:frame.php");
?>