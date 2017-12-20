<?php
require 'scripts/db_init.php';
require 'scripts/functions.php';
//print_r($_REQUEST);
$reqID = $_REQUEST['id'];
$Rid = $_REQUEST['Rid'];

$deleteSql = "delete from `comments_pages` where Rid='".$Rid."'"; 
Maindeletefunc($deleteSql,$array = array());
header("Location: comments_edit.php?Rid=".$reqID);
?>
