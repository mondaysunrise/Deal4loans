<?php
ini_set('max_execution_time', 800);
//require 'scripts/session_check.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';
require 'getlistofeligiblebidders.php';

		//print_r($_REQUEST);
		$bldReqID = $_REQUEST['bldReqID'];
		$City = $_REQUEST["City"];
		$Name = $_REQUEST["Name"];
		$Email = $_REQUEST["Email"];
		$Phone = $_REQUEST["Phone"];
		$Net_Salary = $_REQUEST["Net_Salary"];
		$Employment_Status = $_REQUEST["Employment_Status"];
		$source = $_REQUEST["source"];
		$IP = $_REQUEST["IP"];
		$dob_arr[] = $_REQUEST['year'];
		$dob_arr[] = $_REQUEST['month'];
		$dob_arr[] = $_REQUEST['day'];
		$DOB = implode("-", $dob_arr);
		

if(strlen($City)>2 && strlen($Phone)>9)
		{
			$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-30, date("Y"));
			$days30date=date('Y-m-d',$tomorrow);
			$days30datetime = $days30date." 00:00:00";
			$currentdate= date('Y-m-d');
			$currentdatetime = date('Y-m-d')." 23:59:59";
			
			$getdetails="select RequestID From Req_Credit_Card  Where ((Mobile_Number='".$Phone."' and Mobile_Number not in ('9811555306','9811215138','9971396361')) and Updated_Date between '".$days30datetime."' and '".$currentdatetime."') order by RequestID DESC";
			list($alreadyExist,$myrow)=MainselectfuncNew($getdetails,$array = array());
			$myrowcontr = count($myrow)-1;
			//echo $myrow;
			if($alreadyExist>0)
			{
				$ProductValue = $myrow[$myrowcontr]['RequestID'];
				$Duplicate = "Duplicate";
			}
			else
			{			
			$CheckSql = "select UserID from wUsers where Email = '".$Email."'";
			list($alreadyExist,$myrow)=MainselectfuncNew($CheckSql,$array = array());
			$myrowcontr = count($myrow)-1;
			$CheckNumRows = $alreadyExist;
			$Dated=ExactServerdate();
			if($CheckNumRows>0)
			{
				$UserID = $myrow[$myrowcontr]["UserID"];
				$dataInsert = array('UserID'=>$UserID, 'Name'=>$Name, 'Email'=>$Email, 'City'=>$City, 'Mobile_Number'=>$Phone, 'Net_Salary'=>$Net_Salary, 'Dated'=>$Dated, 'source'=>$source, 'IP_Address'=>$IP, 'Updated_Date'=>$Dated, 'Employment_Status'=>$Employment_Status, 'DOB'=>$DOB);
				//print_r($dataInsert); die;
			}
			else
			{
				$wUsersdata = array("Email"=>$Email, "FName"=>$Name, "Phone"=>$Phone, "Join_Date"=>$Dated, "IsPublic"=>$IsPublic);
				$UserID = Maininsertfunc ('wUsers', $wUsersdata);
				$dataInsert = array('UserID'=>$UserID, 'Name'=>$Name, 'Email'=>$Email, 'City'=>$City, 'Mobile_Number'=>$Phone, 'Net_Salary'=>$Net_Salary, 'Dated'=>$Dated, 'source'=>$source, 'IP_Address'=>$IP, 'Updated_Date'=>$Dated, 'Employment_Status'=>$Employment_Status, 'DOB'=>$DOB);
				//print_r($dataInsert); die;
			}
			
	$ProductValue = Maininsertfunc ('Req_Credit_Card', $dataInsert);	
	
			
			}
		}//$crap Check
	echo $ProductValue;
	echo ",".$bldReqID;
	echo ",".$Duplicate;
	
		//	header('Location: http://www.bestloansdeal.com/cronHL.php?ProductValue='.$ProductValue.'&bldReqID='.$bldReqID);
			//exit();
		

 ?>