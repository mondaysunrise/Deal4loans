<?php
ob_start();
session_start();
//require 'scripts/session_check.php';
require 'scripts/db_init.php';
require 'scripts/functionshttps.php';
$dated = date("Y-m-d");
$nowdated = ExactServerdate();
$ip_address=ExactCustomerIP();

$_SESSION['servertype']='production';
//$_SESSION['servertype']='uat';
$cc_bankid = $_REQUEST["cc_bankid"];
$RequestID = $_REQUEST["RequestID"];
$requestid = $_REQUEST["RequestID"];
$cc_name = $_REQUEST["cc_name"];
$insertID = $_REQUEST["insertID"];
$first_name = $_REQUEST["first_name"];
$middle_name = $_REQUEST["middle_name"];
$last_name = $_REQUEST["last_name"];

$DOB = $_REQUEST["DOB"];
$explodeDOB = explode('/', $DOB);
$DOB = $explodeDOB[2]."-".$explodeDOB[1]."-".$explodeDOB[0];

$panno = $_REQUEST["panno"];
$mobile_code = $_REQUEST["mobile_code"];
$Gender = $_REQUEST["Gender"];
$flatno = $_REQUEST["flatno"];
$buildingName = $_REQUEST["buildingName"];
$road = $_REQUEST["road"];
$City = $_REQUEST["City"];
$State = $_REQUEST["State"];
$pincode = $_REQUEST["pincode"];



 $checkCodeSql = "select * From experian_initial_details WHERE id='".$insertID."' AND mobile_code='".$mobile_code."'";
list($alreadyExist,$myrow)=MainselectfuncNew($checkCodeSql,$array = array());
	$myrowcontr=count($myrow)-1;

	if($alreadyExist>0)
		{
			//Mobile Verification Done
			$product='CC';
			 $mobile_verified=1;
			$dataInsert = array('firstName'=> Fixstring($first_name), 'middleName'=> Fixstring($middle_name), 'surName'=>Fixstring($last_name), 'mobile_verified'=> Fixstring($mobile_verified), 'email_verified'=>Fixstring($mobile_verified), 'counter'=>$counter, 'dated'=>Fixstring($nowdated), 'flatno'=>Fixstring($flatno), 'buildingName'=>Fixstring($buildingName), 'road'=>Fixstring($road), 'pincode'=>Fixstring($pincode), 'pan'=>Fixstring($panno), 'product'=>Fixstring($product), 'state'=>Fixstring($State), 'city'=>Fixstring($City), 'dob'=>Fixstring($DOB));
	//print_r($dataInsert);
//exit();	
			$wherecondition =" (id=".$insertID.")";
			Mainupdatefunc ('experian_initial_details', $dataInsert, $wherecondition);
			$insertSql = array('step'=> 'Step 1', 'status'=> 'Data Inserted', 'message'=> 'Mobile Verification Done', 'requestid'=>Fixstring($insertID), 'Dated'=>$nowdated);
			Maininsertfunc ('experian_log', $insertSql);
		
			header("Location: https://www.deal4loans.com/yes-bank-credit-card-query.php?insertID=".$insertID);
            exit();
		}
		else
		{
			//Mobile Verification Not Done
			//header location mobile 
			//echo "else";
			header("Location: https://www.deal4loans.com/yes-bank-credit-card-continue.php?RequestID=".$RequestID."&cc_bankid=".$cc_bankid."&cc_name=".$cc_name);
            exit();
		}
	
?>