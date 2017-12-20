<?php
ini_set('max_execution_time', 600);
//require 'scripts/session_check.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';

	$bldReqID = FixString($_REQUEST['bldReqID']);
	$Name = FixString($_REQUEST["Name"]);
	$Email = FixString($_REQUEST["Email"]);
	$Employment_Status = FixString($_REQUEST["Employment_Status"]);
	$Company_Name = FixString($_REQUEST['Company_Name']);
	$City = FixString($_REQUEST["City"]);
	$City_Other = FixString($_REQUEST["City_Other"]);
	$Phone = FixString($_REQUEST["Phone"]);
	$Net_Salary = FixString($_REQUEST["Net_Salary"]);
	$DOB = FixString($_REQUEST["DOB"]);
	$Pancard= FixString($_REQUEST["Pancard"]);
	$Total_Experience= FixString($_REQUEST["total_experience"]);
	$Car_Type= FixString($_REQUEST["car_type"]);
	$Car_Booked= FixString($_REQUEST["car_booked"]);
	$Car_Make= FixString($_REQUEST["car_make"]);
	$Car_Model= FixString($_REQUEST["car_name"]);
	$Loan_Amount= FixString($_REQUEST["Loan_Amount"]);
	$Reference_Code= FixString($_REQUEST["Reference_Code"]);
	$Is_Valid= FixString($_REQUEST["Is_Valid"]);
	
	$IP = FixString($_REQUEST["IP"]);
	$Source = FixString($_REQUEST["source"]);
	//$dated = FixString($_REQUEST["Dated"]);
	//$callerID = FixString($_REQUEST['callerID']);
	$Dated = ExactServerdate();
	if(strlen($City)>2 && strlen($Phone)>9)
	{
		$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-30, date("Y"));
		$days30date=date('Y-m-d',$tomorrow);
		$days30datetime = $days30date." 00:00:00";
		$currentdate= date('Y-m-d');
		$currentdatetime = date('Y-m-d')." 23:59:59";
		$getdetails="select RequestID From Req_Loan_Car  Where ((Mobile_Number='".$Phone."' and Mobile_Number not in ('9811555306','9811215138','9717594465','9717594462','9971396361')) and Updated_Date between '".$days30datetime."' and '".$currentdatetime."') order by RequestID DESC";
		list($alreadyExist,$myrow)=MainselectfuncNew($getdetails,$array = array());
		$myrowcontr=count($myrow)-1;
		if($alreadyExist>0)
		{			$ProductValue = $myrow[$myrowcontr]["RequestID"];			$Duplicate = "Duplicate";		}
		else
		{			
			$dataInsert = array('Name'=>$Name, 'Email'=>$Email, 'Employment_Status'=>$Employment_Status, 'Company_Name'=>$Company_Name, 'City'=>$City, 'City_Other'=>$City_Other, 'Mobile_Number'=>$Phone, 'Net_Salary'=>$Net_Salary, 'DOB'=>$DOB, 'Pancard'=>$Pancard, 'Total_Experience'=>$Total_Experience, 'Car_Type'=>$Car_Type, 'Car_Booked'=>$Car_Booked, 'Car_Make'=>$Car_Make, 'Car_Model'=>$Car_Model, 'Loan_Amount'=>$Loan_Amount, 'Reference_Code'=>$Reference_Code, 'Is_Valid'=>$Is_Valid, 'IP_Address'=>$IP, 'source'=>$Source, 'Dated'=>$Dated, 'Updated_Date'=>$Dated);
			
			$ProductValue = Maininsertfunc ('Req_Loan_Car', $dataInsert);
			
			$Duplicate = "";
			
		}
	}//$crap Check
	
	echo $ProductValue;
	echo ",".$bldReqID;
	echo ",".$Duplicate;
?>