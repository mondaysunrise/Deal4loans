<?php
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
//Array ( [Rid] => 2 [id] => [name] => admissioncornerteam [email] =>  [comments] => Indira Gandhi National Open University (Ignou) will announce soon Bachelor Preparatory Programme (BPP) December 2012 Results online. Keep in touch. Best of Luck. [status] => 0 )

$Rid = $_REQUEST['Rid'];
$id = $_REQUEST['id'];
$name = $_REQUEST['name'];
$comments = $_REQUEST['comments'];
$status = $_REQUEST['status'];
$uri = "comments_edit.php?Rid=".$id;
$Dated = ExactServerdate();
$DataArray = array("Name"=>$name , "Comment"=>$comments , "Status"=>$status);
$wherecondition ="( Rid='".$Rid."')";
Mainupdatefunc ('comments_pages', $DataArray, $wherecondition);

header("Location: ".$uri);
exit();
?>