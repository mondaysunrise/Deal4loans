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
	$CC_Holder = FixString($_REQUEST["CC_Holder"]);
	$No_of_Banks= FixString($_REQUEST["No_of_Banks"]);//Existing Cards
	$applied_card_name = FixString($_REQUEST["applied_card_name"]); // Applied Cards
	$IP = FixString($_REQUEST["IP"]);
	$Source = FixString($_REQUEST["Source"]);
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
		$getdetails="select RequestID From Req_Credit_Card  Where ((Mobile_Number='".$Phone."' and Mobile_Number not in ('9811555306','9811215138','9717594465','9717594462','9971396361')) and Updated_Date between '".$days30datetime."' and '".$currentdatetime."') order by RequestID DESC";
		list($alreadyExist,$myrow)=MainselectfuncNew($getdetails,$array = array());
		$myrowcontr=count($myrow)-1;
		if($alreadyExist>0)
		{			$ProductValue = $myrow[$myrowcontr]["RequestID"];			$Duplicate = "Duplicate";		}
		else
		{			
			$dataInsert = array( 'Name'=>$Name, 'Email'=>$Email, 'Employment_Status'=>$Employment_Status, 'Company_Name'=>$Company_Name, 'City'=>$City, 'Mobile_Number'=>$Phone, 'Net_Salary'=>$Net_Salary, 'DOB'=>$DOB,'CC_Holder'=>$CC_Holder,'No_of_Banks'=>$No_of_Banks,'applied_card_name'=>$applied_card_name, 'Dated'=>$Dated, 'source'=>$Source, 'IP_Address'=>$IP, 'Updated_Date'=>$Dated, 'City_Other'=>$City_Other);
			
		//	print_r($dataInsert);
			$ProductValue = Maininsertfunc ('Req_Credit_Card', $dataInsert);
			
			$Duplicate = "";
			
		}
	}//$crap Check
	
	echo $ProductValue;
	echo ",".$bldReqID;
	echo ",".$Duplicate;

?>