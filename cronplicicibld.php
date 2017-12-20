<?php
ini_set('max_execution_time', 600);
//require 'scripts/session_check.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';
require 'eligiblebidderfuncPLICICI.php';

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
	//$Dated = ExactServerdate();
if(strlen($City)>2 && strlen($Phone)>9)
		{
			$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-30, date("Y"));
			$days30date=date('Y-m-d',$tomorrow);
			$days30datetime = $days30date." 00:00:00";
			$currentdate= date('Y-m-d');
			$currentdatetime = date('Y-m-d')." 23:59:59";
			
			$getdetails="select RequestID From Req_Loan_Personal  Where ((Mobile_Number='".$Phone."' and Mobile_Number not in ('9811555306','9811215138','9717594465','9717594462')) and Updated_Date between '".$days30datetime."' and '".$currentdatetime."') order by RequestID DESC";
			list($alreadyExist,$myrow)=MainselectfuncNew($getdetails,$array = array());
			$myrowcontr=count($myrow)-1;
		
			if($alreadyExist>0)
			{
				$ProductValue = $myrow[$myrowcontr]["RequestID"];
				$Duplicate = "Duplicate";
			}
			else
			{			
			$CheckSql = "select UserID from wUsers where Email = '".$Email."'";
			list($CheckNumRows,$CheckQuery)=MainselectfuncNew($CheckSql,$array = array());
			$CheckQuerycontr=count($CheckQuery)-1;
			$Dated = ExactServerdate();
			if($CheckNumRows>0)
			{
				$UserID = $CheckQuery[$CheckQuerycontr]['UserID'];
				$dataInsert = array('UserID'=>$UserID, 'Name'=>$Name, 'Email'=>$Email, 'Employment_Status'=>$Employment_Status, 'Company_Name'=>$Company_Name, 'City'=>$City, 'Mobile_Number'=>$Phone, 'Net_Salary'=>$Net_Salary, 'Loan_Amount'=>$Loan_Amount, 'Dated'=>$Dated, 'source'=>$Source, 'IP_Address'=>$IP, 'Updated_Date'=>$Dated, 'Annual_Turnover'=>$Annual_Turnover, 'panel'=>$panel, 'Reference_Code'=>$Reference_Code);
			}
			else
			{
				$wUsersdata = array("Email"=>$Email, "FName"=>$Name, "Phone"=>$Phone, "Join_Date"=>$Dated, "IsPublic"=>$IsPublic);
				$UserID = Maininsertfunc("wUsers", $wUsersdata);
				$dataInsert = array('UserID'=>$UserID, 'Name'=>$Name, 'Email'=>$Email, 'Employment_Status'=>$Employment_Status, 'Company_Name'=>$Company_Name, 'City'=>$City, 'Mobile_Number'=>$Phone, 'Net_Salary'=>$Net_Salary, 'Loan_Amount'=>$Loan_Amount, 'Dated'=>$Dated, 'source'=>$Source, 'IP_Address'=>$IP, 'Updated_Date'=>$Dated, 'Annual_Turnover'=>$Annual_Turnover, 'panel'=>$panel, 'Reference_Code'=>$Reference_Code);
			}
			
			//print_r($dataInsert);
			 $ProductValue = Maininsertfunc ('Req_Loan_Personal', $dataInsert);
			
			$dataUpdate = array('Residential_Status'=>$Residential_Status, 'Pincode'=>$Pincode, 'Primary_Acc'=>$Primary_Acc, 'Company_Type'=>$Company_Type, 'Years_In_Company'=>$Years_In_Company, 'Total_Experience'=>$Total_Experience, 'Salary_Drawn'=>$Salary_Drawn, 'EMI_Paid'=>$EMI_Paid, 'DOB'=>$DOB, 'CC_Holder'=>$CC_Holder, 'Card_Vintage'=>$Card_Vintage, 'Loan_Any'=>$Loan_A, 'Is_Valid'=>$Is_Valid);
			$wherecondition = "(RequestID=".$ProductValue.")";
			Mainupdatefunc ('Req_Loan_Personal', $dataUpdate, $wherecondition);
			$Duplicate = "";
		}
		}//$crap Check
		$Is_Valid=1;
	if($Is_Valid==1 && $Duplicate=="")
	{
		$icici_bankcategory="";
		list($FinalBidder,$finalBidderName)= getBiddersList("Req_Loan_Personal",$ProductValue,$City);
		if(count($FinalBidder)>0 && $FinalBidder[0]>0 )	
		{	
			$getcompany='select icici_bank from pl_company_list where company_name="'.$Company_Name.'"';
			//echo $getcompany;
			list($CheckNumRows,$grow)=MainselectfuncNew($getcompany,$array = array());
			$growcontr=count($grow)-1;
			$icici_bankcategory = $grow[$growcontr]["icici_bank"]; 

if($City=="Bangalore")
			{
				$maxsslcut=360000;
				$opensalcut=480000;
			}
			else
			{
				$maxsslcut=300000;
				$opensalcut=360000;
			}
if((strlen($icici_bankcategory)>2 && $Net_Salary>=$maxsslcut) || ($Net_Salary>=$opensalcut))
			{
			$Allocated = 2;
			$Final_Bid = implode("," , $FinalBidder);
			$Dated = ExactServerdate();
			$dataUpdate = array('Bidderid_Details'=>$Final_Bid, 'Dated'=>$Dated, 'Allocated'=>$Allocated, 'Direct_Allocation'=>'1');
			$wherecondition = "(RequestID=".$ProductValue.")";
			Mainupdatefunc ('Req_Loan_Personal', $dataUpdate, $wherecondition);
			}
		//	echo "<br>".$updatelead;
		}
	}

	echo $ProductValue;
	echo ",".$bldReqID;
	echo ",".$Duplicate;
	echo ",".$Allocated;

	
		//	header('Location: http://www.bestloansdeal.com/cronHL.php?ProductValue='.$ProductValue.'&bldReqID='.$bldReqID);
			//exit();
		

 ?>