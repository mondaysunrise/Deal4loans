<?php
session_start();
require 'scripts/db_init.php';
require 'scripts/functions.php';
if($_SESSION['captcha']==$_POST['captcha0'])
{
	$current_id = $_POST['current_id0'];
	$name = $_POST['name0'];
	$email = $_POST['email0'];
	$comments = $_POST['comments0'];
	$IP = $_SERVER['REMOTE_ADDR'];
	$uri = $_POST['uri0'];
	if(strlen($comments)>0)
	{
		$Dated = ExactServerdate();
		$dataInsert = array('Name'=>$name, 'Email'=>$email, 'Comment'=>$comments, 'Dated'=>$Dated, 'Page_Name'=>$uri, 'IP'=>$IP, 'Status'=>'0', 'parent'=>$current_id);
		print_r($dataInsert);
		echo $insert = Maininsertfunc ("comments_pages", $dataInsert);
		$_SESSION['Msg'] = "Your Comment has been Submitted";
	}
	else
	{
		$_SESSION['Msg'] = "Number Does not Match";
	}
}
else if(strlen($_POST['captcha'])>0)
{
	$_SESSION['Msg'] = "Number Does not Match";
}
header("Location: ".$uri);
exit();

?>