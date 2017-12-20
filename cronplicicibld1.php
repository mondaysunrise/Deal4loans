<?php
ini_set('max_execution_time', 600);
//require 'scripts/session_check.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';
require 'eligiblebidderfuncPLICICI.php';

//$ProductValue = 1233854;
//$City = 'Delhi';
	//$a = getBiddersList("Req_Loan_Personal",$ProductValue,$City);
//print_r($a);

	

//echo "ddd";
print_r($_REQUEST);
	$bldReqID = $_REQUEST['bldReqID'];
	$Loan_Amount = $_REQUEST["Loan_Amount"];
	$Employment_Status = $_REQUEST["Employment_Status"];
	$Net_Salary = $_REQUEST["Net_Salary"];
	$Name = $_REQUEST["Name"];
	$City = $_REQUEST["City"];
	$Phone = $_REQUEST["Phone"];
	$Email = $_REQUEST["Email"];
	$accept = $_REQUEST["accept"];
	$panel = $_REQUEST["panel"];
	$IP = $_REQUEST["IP"];
	$Source = $_REQUEST["Source"];
	$Annual_Turnover = $_REQUEST["Annual_Turnover"];
	$Residential_Status = $_REQUEST["Residential_Status"];
	$DOB = $_REQUEST["DOB"];
	$Pincode = $_REQUEST["Pincode"];
	$Primary_Acc = $_REQUEST["Primary_Acc"];
	$Company_Type = $_REQUEST["Company_Type"];
	$Years_In_Company = $_REQUEST["Years_In_Company"];
	$Total_Experience = $_REQUEST["Total_Experience"];
	$Salary_Drawn = $_REQUEST["Salary_Drawn"];
	$EMI_Paid = $_REQUEST["EMI_Paid"];
	$CC_Holder = $_REQUEST["CC_Holder"];
	$Card_Vintage = $_REQUEST["Card_Vintage"];
	$Loan_Any = $_REQUEST["Loan_Any"];
	$City_Other = $_REQUEST["City_Other"];
	$Reference_Code = $_REQUEST["Reference_Code"];
	$Is_Valid = $_REQUEST["Is_Valid"];
	$dated = $_REQUEST["Dated"];
	$Company_Name = $_REQUEST['Company_Name'];
if(strlen($City)>2 && strlen($Phone)>9)
		{
			$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-30, date("Y"));
			$days30date=date('Y-m-d',$tomorrow);
			$days30datetime = $days30date." 00:00:00";
			$currentdate= date('Y-m-d');
			$currentdatetime = date('Y-m-d')." 23:59:59";
			
			$getdetails="select RequestID From Req_Loan_Personal  Where ((Mobile_Number='".$Phone."' and Mobile_Number not in ('9811555306','9811215138','9971396361','9999042489')) and Updated_Date between '".$days30datetime."' and '".$currentdatetime."') order by RequestID DESC";
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
				$dataInsert = array('UserID'=>$UserID, 'Name'=>$Name, 'Email'=>$Email, 'Employment_Status'=>$Employment_Status, 'Company_Name'=>$Company_Name, 'City'=>$City, 'Mobile_Number'=>$Phone, 'Net_Salary'=>$Net_Salary, 'Loan_Amount'=>$Loan_Amount, 'Dated'=>$Dated, 'source'=>$source, 'IP_Address'=>$IP, 'Updated_Date'=>$Dated, 'Annual_Turnover'=>$Annual_Turnover, 'panel'=>$panel, 'Reference_Code'=>$Reference_Code);

			//	echo "<br>if".$InsertProductSql;
			}
			else
			{
				$wUsersdata = array("Email"=>$Email, "FName"=>$Name, "Phone"=>$Phone, "Join_Date"=>$Dated, "IsPublic"=>$IsPublic);
				$UserID = Maininsertfunc ('wUsers', $wUsersdata);
				$dataInsert = array('UserID'=>$UserID, 'Name'=>$Name, 'Email'=>$Email, 'Employment_Status'=>$Employment_Status, 'Company_Name'=>$Company_Name, 'City'=>$City, 'Mobile_Number'=>$Phone, 'Net_Salary'=>$Net_Salary, 'Loan_Amount'=>$Loan_Amount, 'Dated'=>$Dated, 'source'=>$source, 'IP_Address'=>$IP, 'Updated_Date'=>$Dated, 'Annual_Turnover'=>$Annual_Turnover, 'panel'=>$panel, 'Reference_Code'=>$Reference_Code);			
			}
			
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
		echo "104<br>";
		echo $ProductValue."--".$City."<br>";
		list($FinalBidder,$finalBidderName)= getBiddersList("Req_Loan_Personal",$ProductValue,$City);
		if(count($FinalBidder)>0 && $FinalBidder[0]>0 )	
		{	
			$Allocated = 2;
			$Final_Bid = implode("," , $FinalBidder);
			$Dated=ExactServerdate();
			$dataUpdate = array('Bidderid_Details'=>$Final_Bid, 'Dated'=>$Dated, 'Allocated'=>$Allocated, 'Direct_Allocation'=>'1');
			$wherecondition = "(RequestID=".$ProductValue.")";
			Mainupdatefunc ('Req_Loan_Personal', $dataUpdate, $wherecondition);
			echo "<br>".$updatelead;
		}
	}

	echo $ProductValue;
	echo ",".$bldReqID;
	echo ",".$Duplicate;
	echo ",".$Allocated;

	
		//	header('Location: http://www.bestloansdeal.com/cronHL.php?ProductValue='.$ProductValue.'&bldReqID='.$bldReqID);
			//exit();
		

 ?>