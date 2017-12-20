<?php
ob_start();
session_start();
require 'scripts/session_check.php';
require 'scripts/db_init.php';
require 'scripts/functionshttps.php';
$dated = date("Y-m-d");
//print_r($_POST);
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$insertID = $_POST['insertID'];
	$email_code= $_POST['email_code'];
	$mobile_code= $_POST['mobile_code'];
	$getdetails="select email_code, mobile_code From experian_initial_details Where ( id='".$insertID."')";
//	echo "<br>".$getdetails."<br>";
	list($alreadyExist,$myrow)=MainselectfuncNew($getdetails,$array = array());
	$myrowcontr=count($myrow)-1;
	$mobile_code_db = $myrow[$myrowcontr]["mobile_code"];
	$email_code_db = $myrow[$myrowcontr]["email_code"];
	
//	echo $email_code_db.", ".$mobile_code_db;
//	echo "<br>";
	$email_verify = 0;
	$mobile_verify = 0;
	if($email_code_db==$email_code)
	{
		$email_verify = 1;
	}
	if($mobile_code_db==$mobile_code)
	{
		$mobile_verify =1;
	}
	//$email_verify = 1;
	$DataArray = array('mobile_verified'=>$verify, 'email_verified'=>$verify);
//	print_r($DataArray);	
	if($mobile_verify==1 && $email_verify==1)
	{
		$verify=1;
		$DataArray = array('mobile_verified'=>$verify, 'email_verified'=>$verify);
		//print_r($DataArray);	
		$wherecondition =" (id=".$insertID.")";
		Mainupdatefunc ('experian_initial_details', $DataArray, $wherecondition);
		header("Location: cibil-check-second-step.php?id=".$insertID);
		exit();
	}
	else
	{
		header("Location: check-creditscore.php?msg=Verification Failed");
		exit();		
	}

}


?>