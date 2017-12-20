<?php
ini_set('max_execution_time', 600);
//require 'scripts/session_check.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';

	$bldReqID = FixString($_REQUEST['bldReqID']);
	$Loan_Amount = FixString($_REQUEST["Loan_Amount"]);
	$Employment_Status = FixString($_REQUEST["Employment_Status"]);
	$Net_Salary = FixString($_REQUEST["Net_Salary"]);
	$Name = FixString($_REQUEST["Name"]);
	$City = FixString($_REQUEST["City"]);
	$Phone = FixString($_REQUEST["Phone"]);
	$Email = FixString($_REQUEST["Email"]);
	$accept = FixString($_REQUEST["accept"]);
	$panel = FixString($_REQUEST["panel"]);
	$IP = FixString($_REQUEST["IP"]);
	$Source = FixString($_REQUEST["Source"]);
	$Annual_Turnover = FixString($_REQUEST["Annual_Turnover"]);
	$Residential_Status = FixString($_REQUEST["Residential_Status"]);
	$DOB = FixString($_REQUEST["DOB"]);
	$Pincode = FixString($_REQUEST["Pincode"]);
	$Primary_Acc = FixString($_REQUEST["Primary_Acc"]);
	$Company_Type = FixString($_REQUEST["Company_Type"]);
	$Years_In_Company = FixString($_REQUEST["Years_In_Company"]);
	$Total_Experience = FixString($_REQUEST["Total_Experience"]);
	$Salary_Drawn = FixString($_REQUEST["Salary_Drawn"]);
	$EMI_Paid = FixString($_REQUEST["EMI_Paid"]);
	$CC_Holder = FixString($_REQUEST["CC_Holder"]);
	$Card_Vintage = FixString($_REQUEST["Card_Vintage"]);
	$Loan_Any = FixString($_REQUEST["Loan_Any"]);
	$City_Other = FixString($_REQUEST["City_Other"]);
	$Reference_Code = FixString($_REQUEST["Reference_Code"]);
	$Is_Valid = FixString($_REQUEST["Is_Valid"]);
	$dated = FixString($_REQUEST["Dated"]);
	$Company_Name = FixString($_REQUEST['Company_Name']);
	$Dated = ExactServerdate();
//	if(strlen($City)>2 && strlen($Phone)>9)
	if(strlen($Phone)>9)	
	{
		$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-30, date("Y"));
		$days30date=date('Y-m-d',$tomorrow);
		$days30datetime = $days30date." 00:00:00";
		$currentdate= date('Y-m-d');
		$currentdatetime = date('Y-m-d')." 23:59:59";
			
		$getdetails="select RequestID From Req_Loan_Personal  Where ((Mobile_Number='".$Phone."' and Mobile_Number not in ('9811555306','9811215138','9717594465','9717594462','9971396361')) and Updated_Date between '".$days30datetime."' and '".$currentdatetime."') order by RequestID DESC";
		list($alreadyExist,$myrow)=MainselectfuncNew($getdetails,$array = array());
		$myrowcontr=count($myrow)-1;
		
		if($alreadyExist>0)
		{
			$ProductValue = $myrow[$myrowcontr]["RequestID"];
			$Duplicate = "Duplicate";
		}
		else
		{			
			
			//	$dataInsert = array('UserID'=>$UserID, 'Name'=>$Name, 'Email'=>$Email, 'Employment_Status'=>$Employment_Status, 'Company_Name'=>$Company_Name, 'City'=>$City, 'Mobile_Number'=>$Phone, 'Net_Salary'=>$Net_Salary, 'Loan_Amount'=>$Loan_Amount, 'Dated'=>$Dated, 'source'=>$Source, 'IP_Address'=>$IP, 'Updated_Date'=>$Dated, 'Annual_Turnover'=>$Annual_Turnover);//, 'panel'=>$panel, 'Reference_Code'=>$Reference_Code
			$dataInsert = array('Name'=>$Name, 'Employment_Status'=>$Employment_Status, 'Mobile_Number'=>$Phone, 'Dated'=>$Dated, 'source'=>$Source, 'IP_Address'=>$IP, 'Updated_Date'=>$Dated, 'Net_Salary'=>$Net_Salary);
			
		//	print_r($dataInsert);
			 $ProductValue = Maininsertfunc ('Req_Loan_Personal', $dataInsert);
			
			$dataUpdate = array('Residential_Status'=>$Residential_Status, 'Pincode'=>$Pincode, 'Primary_Acc'=>$Primary_Acc, 'Company_Type'=>$Company_Type, 'Years_In_Company'=>$Years_In_Company, 'Total_Experience'=>$Total_Experience, 'Salary_Drawn'=>$Salary_Drawn, 'EMI_Paid'=>$EMI_Paid, 'DOB'=>$DOB, 'CC_Holder'=>$CC_Holder, 'Card_Vintage'=>$Card_Vintage, 'Loan_Any'=>$Loan_A, 'Is_Valid'=>$Is_Valid, 'City'=>$City, 'City_Other'=>$City_Other, 'Company_Name'=>$Company_Name);
			$wherecondition = "(RequestID=".$ProductValue.")";
			Mainupdatefunc ('Req_Loan_Personal', $dataUpdate, $wherecondition);
			$Duplicate = "";
		}
		}//$crap Check
	
	echo $ProductValue;
	echo ",".$bldReqID;
	echo ",".$Duplicate;
	

	
		//	header('Location: http://www.bestloansdeal.com/cronHL.php?ProductValue='.$ProductValue.'&bldReqID='.$bldReqID);
			//exit();

?>