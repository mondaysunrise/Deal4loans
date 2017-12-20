<?php
session_start();
require 'scripts/db_init.php';
require 'scripts/functions.php';
//print_r($_SESSION);
//echo "<br>";
//print_r($_POST);

//Array ( [captcha] => 213582 ) 
//Array ( [name] => [email] => [comments] => [captcha] => 424415 )
if($_SESSION['captcha']==$_POST['captcha'])
{
	$current_id = $_POST['current_id'];
	$name = $_POST['name'];
	$email = $_POST['email'];
	$comments = $_POST['comments'];
	$IP = $_SERVER['REMOTE_ADDR'];
	$uri = $_POST['uri'];
	if(strlen($comments)>0)
	{
		$Dated = ExactServerdate();
		$dataInsert = array('Name'=>$name, 'Email'=>$email, 'Comment'=>$comments, 'Dated'=>$Dated, 'Page_Name'=>$uri, 'IP'=>$IP, 'Status'=>'0', 'parent'=>$current_id);
		$insert = Maininsertfunc ("comments_pages", $dataInsert);
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