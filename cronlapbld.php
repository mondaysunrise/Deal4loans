<?php
ini_set('max_execution_time', 600);
//require 'scripts/session_check.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';

		$bldReqID = $_REQUEST['bldReqID'];
		$City = $_REQUEST["City"];
		$Name = $_REQUEST["Name"];
		$Email = $_REQUEST["Email"];
		$Phone = $_REQUEST["Phone"];
		$Net_Salary = $_REQUEST["Net_Salary"];
		$loan_amount = $_REQUEST["Loan_Amount"];
		$Employment_Status = $_REQUEST["Employment_Status"];
		$source = $_REQUEST["source"];
		$IP = $_REQUEST["IP"];
		$dob_arr[] = $_REQUEST['year'];
		$dob_arr[] = $_REQUEST['month'];
		$dob_arr[] = $_REQUEST['day'];
		$DOB = implode("-", $dob_arr);
		$Property_Value = $_REQUEST['property_value'];
		

if(strlen($City)>2 && strlen($Phone)>9)
		{
			$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-30, date("Y"));
			$days30date=date('Y-m-d',$tomorrow);
			$days30datetime = $days30date." 00:00:00";
			$currentdate= date('Y-m-d');
			$currentdatetime = date('Y-m-d')." 23:59:59";
			
			$getdetails="select RequestID From Req_Loan_Against_Property  Where ((Mobile_Number='".$Phone."' and Mobile_Number not in ('9811555306','9811215138','9971396361')) and Updated_Date between '".$days30datetime."' and '".$currentdatetime."') order by RequestID DESC";
			list($alreadyExist,$myrow)=MainselectfuncNew($CheckSql,$array = array());
			$myrowcontr = count($myrow)-1;
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
				$dataInsert = array('UserID'=>$UserID, 'Name'=>$Name, 'Email'=>$Email, 'City'=>$City, 'Mobile_Number'=>$Phone, 'Net_Salary'=>$Net_Salary, 'Loan_Amount'=>$loan_amount, 'Property_Value'=>$Property_Value, 'Dated'=>$Dated, 'source'=>$source, 'IP_Address'=>$IP, 'Updated_Date'=>$Dated, 'Employment_Status'=>$Employment_Status, 'DOB'=>$DOB);
			}
			else
			{
				$wUsersdata = array("Email"=>$Email, "FName"=>$Name, "Phone"=>$Phone, "Join_Date"=>$Dated, "IsPublic"=>$IsPublic);
				$UserID = Maininsertfunc ('wUsers', $wUsersdata);
				$dataInsert = array('UserID'=>$UserID, 'Name'=>$Name, 'Email'=>$Email, 'City'=>$City, 'Mobile_Number'=>$Phone, 'Net_Salary'=>$Net_Salary, 'Loan_Amount'=>$loan_amount, 'Property_Value'=>$Property_Value, 'Dated'=>$Dated, 'source'=>$source, 'IP_Address'=>$IP, 'Updated_Date'=>$Dated, 'Employment_Status'=>$Employment_Status, 'DOB'=>$DOB);
			}
			
	$ProductValue = Maininsertfunc ('Req_Loan_Against_Property', $dataInsert);	
			
			}
		}//$crap Check
	echo $ProductValue;
	echo ",".$bldReqID;
	echo ",".$Duplicate;
	
		//	header('Location: http://www.bestloansdeal.com/cronHL.php?ProductValue='.$ProductValue.'&bldReqID='.$bldReqID);
			//exit();
		

 ?>