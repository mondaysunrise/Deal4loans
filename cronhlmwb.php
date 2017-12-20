<?php
ini_set('max_execution_time', 800);
//require 'scripts/session_check.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';

	$bldReqID = FixString($_REQUEST['bldReqID']);
	$Loan_Amount = FixString($_REQUEST["Loan_Amount"]);
	$Employment_Status = FixString($_REQUEST["Employment_Status"]);
	$Net_Salary = FixString($_REQUEST["Net_Salary"]);
	$Name = FixString($_REQUEST["Name"]);
	$City = FixString($_REQUEST["City"]);
	$City_Other = FixString($_REQUEST["City_Other"]);
	$Phone = FixString($_REQUEST["Phone"]);
	$accept = FixString($_REQUEST["accept"]);
	$IP = FixString($_REQUEST["IP"]);
	$Source = FixString($_REQUEST["Source"]);
	$has_applied_sbi = FixString($_REQUEST["has_applied_sbi"]);
	$Email = FixString($_REQUEST["Email"]);
	$Property_Identified = FixString($_REQUEST["Property_Identified"]);
	$Property_Value = FixString($_REQUEST["Property_Value"]);
	$Property_Loc = FixString($_REQUEST["Property_Loc"]);
	$Total_Obligation = FixString($_REQUEST["Total_Obligation"]);
	$Co_Applicant_Name = FixString($_REQUEST["Co_Applicant_Name"]);
	$Co_Applicant_DOB = FixString($_REQUEST["Co_Applicant_DOB"]);
	$Co_Applicant_Income = FixString($_REQUEST["Co_Applicant_Income"]);
	$Co_Applicant_Obligation = FixString($_REQUEST["Co_Applicant_Obligation"]);
	
	$year = date("Y") - 30;
	$DOB = $year."-".date("m-d");
	if(strlen($City)>2 && strlen($Phone)>9)
	{
		$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-30, date("Y"));
		$days30date=date('Y-m-d',$tomorrow);
		$days30datetime = $days30date." 00:00:00";
		$currentdate= date('Y-m-d');
		$currentdatetime = date('Y-m-d')." 23:59:59";
			
		$getdetails="select RequestID From Req_Loan_Home  Where ((Mobile_Number='".$Phone."' and Mobile_Number not in ('9811555306','9811215138','9717594465','9717594462','9971396361')) and Updated_Date between '".$days30datetime."' and '".$currentdatetime."') order by RequestID DESC";
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
				$dataInsert = array('Name'=>$Name, 'Employment_Status'=>$Employment_Status, 'City'=>$City, 'City_Other'=>$City_Other, 'Mobile_Number'=>$Phone, 'Net_Salary'=>$Net_Salary, 'Loan_Amount'=>$Loan_Amount, 'Dated'=>$Dated, 'source'=>$Source, 'IP_Address'=>$IP, 'Updated_Date'=>$Dated, 'DOB'=>$DOB, 'Email'=>$Email, 'Property_Identified'=>$Property_Identified, 'Property_Value'=>$Property_Value, 'Property_Loc'=>$Property_Loc, 'Total_Obligation'=>$Total_Obligation, 'Co_Applicant_Name'=>$Co_Applicant_Name, 'Co_Applicant_DOB'=>$Co_Applicant_DOB, 'Co_Applicant_Income'=>$Co_Applicant_Income, 'Co_Applicant_Obligation'=>$Co_Applicant_Obligation);
			}
			else
			{
				//$wUsersdata = array("Email"=>$Email, "FName"=>$Name, "Phone"=>$Phone, "Join_Date"=>$Dated, "IsPublic"=>$IsPublic);
				//$UserID = Maininsertfunc("wUsers", $wUsersdata);
				$dataInsert = array('Name'=>$Name, 'Employment_Status'=>$Employment_Status, 'City'=>$City,  'City_Other'=>$City_Other, 'Mobile_Number'=>$Phone, 'Net_Salary'=>$Net_Salary, 'Loan_Amount'=>$Loan_Amount, 'Dated'=>$Dated, 'source'=>$Source, 'IP_Address'=>$IP, 'Updated_Date'=>$Dated, 'DOB'=>$DOB, 'Email'=>$Email, 'Property_Identified'=>$Property_Identified, 'Property_Value'=>$Property_Value, 'Property_Loc'=>$Property_Loc, 'Total_Obligation'=>$Total_Obligation, 'Co_Applicant_Name'=>$Co_Applicant_Name, 'Co_Applicant_DOB'=>$Co_Applicant_DOB, 'Co_Applicant_Income'=>$Co_Applicant_Income, 'Co_Applicant_Obligation'=>$Co_Applicant_Obligation);
			}
			 $ProductValue = Maininsertfunc ('Req_Loan_Home', $dataInsert);
			 
			if($has_applied_sbi==1)
			{
				// insert to leads_with_other_processes
				$cfSqldata = array("productid"=>$ProductValue, "product"=>"HL", "process_name"=>"sbicards_checkbox");
				$cfS1 = Maininsertfunc("leads_with_other_processes", $cfSqldata);
			
				 $getdetailsCC="select RequestID From Req_Credit_Card Where ((Mobile_Number='".$Phone."' and Mobile_Number not in ('9811555306','9811215138','9971396361','9999047207','9311773341','9555060388')) and Updated_Date between '".$days30datetime."' and '".$currentdatetime."') order by RequestID DESC";
				list($alreadyExistCC,$myrowCC)=Mainselectfunc($getdetailsCC,$array = array());
				//echo  "<br>".$getdetails."<br>";
				if($alreadyExistCC>0) 
				{
					//Duplicate
				} 
				else
				{
					$source_cc = 'wf-SBI_HL_LEAD';
					$dataInsertCC = array('Name'=>$Name, 'Employment_Status'=>$Employment_Status, 'City'=>$City, 'City_Other'=>$City_Other, 'Mobile_Number'=>$Phone, 'Net_Salary'=>$Net_Salary, 'Dated'=>$Dated, 'source'=>$source_cc, 'IP_Address'=>$IP, 'DOB'=>$DOB, 'Updated_Date'=>$Dated, 'Email'=>$Email);	
					$ProductValueCC = Maininsertfunc ('Req_Credit_Card', $dataInsertCC);
					$insert_status = 1;
					$RequestIDCC = $ProductValueCC;
					//echo "<br>Inserted ID".$RequestID."<br>";
					$insertFeedbackArr = array("AllRequestID"=>$RequestIDCC, "BidderID"=>5633, "Reply_Type"=>4, "Allocation_Date"=>$Dated);
					Maininsertfunc("Req_Feedback_Bidder1", $insertFeedbackArr);
					Maininsertfunc("Req_Feedback_Bidder_CC", $insertFeedbackArr);
					$updateProductAllocationArr = array("Allocated"=>1);
					$UpdateProductWhereCond ="(RequestID='".$RequestIDCC."')";
					Mainupdatefunc("Req_Credit_Card", $updateProductAllocationArr, $UpdateProductWhereCond);
					
					//update Sql 
					$updateProductSql= array('status'=>$insert_status,'transfer_product'=>'CC', 'transfer_productid'=>$ProductValueCC);
					$wherecondition ="( id=".$cfS1.")";
					Mainupdatefunc("leads_with_other_processes", $updateProductSql, $wherecondition);
				}

			}	
			$has_applied_sbi=0;	 
			 
		}
	}//$crap Check
	
	echo $ProductValue;
	echo ",".$bldReqID;
	echo ",".$Duplicate;
	
?>