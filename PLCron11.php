<?php
require 'scripts/db_init.php';
require 'scripts/functions.php';

//	$returnArr = '';
	//print_r($_GET);
	$Loan_Amount = $_REQUEST['Loan_Amount'];//
	$Employment_Status = $_REQUEST['Employment_Status'];//
	$Company_Name = $_REQUEST['Company_Name'];//
	$Net_Salary = $_REQUEST['Net_Salary'];//
	$Name = $_REQUEST['Name'];//
	$City = $_REQUEST['City'];//
	$Phone = $_REQUEST['Phone'];//
	$Email = $_REQUEST['Email'];//
	$accept = $_REQUEST['accept'];
	$IP = $_REQUEST['IP'];
	$Source = $_REQUEST['Source'];//
	$lastId = $_REQUEST['lastId'];//
	$Annual_Turnover = $_REQUEST['Annual_Turnover'];


	$PL_EMI_Amt = $_REQUEST['PL_EMI_Amt'];
	$Company_Type = $_REQUEST['Company_Type'];
	$Residential_Status = $_REQUEST['Residential_Status'];
	$Primary_Acc= $_REQUEST['Primary_Acc'];
	$Loan_A = $_REQUEST['Loan_Any'];
	$EMI_Paid = $_REQUEST['EMI_Paid'];
	$Credit_Limit = $_REQUEST['Credit_Limit'];
	$Total_Experience = $_REQUEST['Total_Experience'];
	$Years_In_Company = $_REQUEST['Years_In_Company'];
	
	$Pincode = $_REQUEST['Pincode'];
	$DOB = $_REQUEST['DOB'];
	$CC_Holder = $_REQUEST['CC_Holder'];
	$Card_Vintage = $_REQUEST['Card_Vintage'];
	$Dated = ExactServerdate();
	
	

	$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-30, date("Y"));
	$days30date=date('Y-m-d',$tomorrow);
	$days30datetime = $days30date." 00:00:00";
	$currentdate= date('Y-m-d');
	$currentdatetime = date('Y-m-d')." 23:59:59";
	$getdetails="select RequestID From Req_Loan_Personal Where ( Mobile_Number not in (9971396361,9811215138,9911940202,9891118553,9999570210) and Mobile_Number='".$Phone."' and Updated_Date between '".$days30datetime."' and '".$currentdatetime."') order by RequestID DESC";
	//echo $getdetails."<br>";
	//exit();

	list($alreadyExist,$myrow)=MainselectfuncNew($getdetails,$array = array());
	$cntr=0;
	if($alreadyExist>0)
	{
		$lastInsertedId=$myrow[$cntr]['RequestID'];
		$Duplicate = "Duplicate";
	}
	else
	{
		$dataInsert = array("Name"=>$Name, "Email"=>$Email, "Employment_Status"=>$Employment_Status, "Company_Name"=>$Company_Name, "City"=>$City, "Mobile_Number"=>$Phone, "Net_Salary"=>$Net_Salary, "Loan_Amount"=>$Loan_Amount, "Dated"=>$Dated, "source"=>$Source, "IP_Address"=>$IP, "Updated_Date"=>$Dated, "Privacy"=>'on', "Annual_Turnover"=>$Annual_Turnover);
$table = 'Req_Loan_Personal';
$insert = Maininsertfunc ($table, $dataInsert);
		$lastInsertedId = $insert;
		
		$DataArray = array("Company_Type"=>$Company_Type, "PL_EMI_Amt"=>$PL_EMI_Amt, "Primary_Acc"=>$Primary_Acc, " Residential_Status"=>$Residential_Status, "Card_Limit"=>$Credit_Limit, "Years_In_Company"=>$Years_In_Company, " Total_Experience"=>$Total_Experience, "EMI_Paid"=>$EMI_Paid, "Loan_Any"=>$Loan_A, "DOB"=>$DOB, "CC_Holder"=>$CC_Holder, " Card_Vintage"=>$Card_Vintage, "Pincode"=>$Pincode);
		$wherecondition ="RequestID=".$lastInsertedId;
		Mainupdatefunc ('Req_Loan_Personal', $DataArray, $wherecondition);
		$Duplicate = "";		
	}

$dataInsert = array("RequestID"=>$lastInsertedId, "LnsID"=>$lastId, "Duplicate"=>$Duplicate, "Product_Name"=>'PL');
$table = 'Req_lead_trans';
$insert = Maininsertfunc ($table, $dataInsert);
	echo $lastInsertedId;
	echo ",".$lastId;
?>