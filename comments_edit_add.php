<?php
	require 'scripts/db_init.php';
	require 'scripts/functions.php';

$Rid = $_REQUEST['Rid'];
$id = $_REQUEST['id'];
$name = $_REQUEST['name'];
$comments = $_REQUEST['comments'];
$status = $_REQUEST['status'];
$email ="hardeep@deal4loans.com";
$IP = $_SERVER['REMOTE_ADDR'];
$getPageSql = "select Page_Name from comments_pages where Rid = ".$_REQUEST['Rid'];
 list($recordcount1,$getPageQuery)=MainselectfuncNew($getPageSql,$array = array());

$Page_Name = $getPageQuery[0]['Page_Name'];

if(strlen($comments)>0)
{
$Dated = ExactServerdate();
		$dataInsert = array('Name'=>$name, 'Email'=>$email, 'Mobile'=>$mobile, 'Comment'=>$comments, 'Dated'=>$Dated, 'Page_Name'=>$uri, 'IP'=>$IP, 'Status'=>'0', 'parent'=>$Rid);
		$insert = Maininsertfunc ("comments_pages", $dataInsert);
$uri = "comments_edit.php?Rid=".$id;
}
header("Location: ".$uri);
exit();
?>