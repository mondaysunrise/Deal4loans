<?php
require 'scripts/db_init.php';
require 'scripts/functions.php';
require 'getlistofeligiblebidders.php';

	$Loan_Amount = FixString($_REQUEST['Loan_Amount']);//
	$Employment_Status = FixString($_REQUEST['Employment_Status']);//
	$Company_Name = FixString($_REQUEST['Company_Name']);//
	$Net_Salary = FixString($_REQUEST['Net_Salary']);//
	$Name = FixString($_REQUEST['Name']);//
	$City = FixString($_REQUEST['City']);//
	$Phone = FixString($_REQUEST['Phone']);//
	$Email = FixString($_REQUEST['Email']);//
	$accept = FixString($_REQUEST['accept']);
	$IP = FixString($_REQUEST['IP']);
	$Source = FixString($_REQUEST['Source']);//
	$lastId = FixString($_REQUEST['lastId']);//
	$Annual_Turnover = FixString($_REQUEST['Annual_Turnover']);
	$PL_EMI_Amt = FixString($_REQUEST['PL_EMI_Amt']);
	$Company_Type = FixString($_REQUEST['Company_Type']);
	$Residential_Status = FixString($_REQUEST['Residential_Status']);
	$Primary_Acc= FixString($_REQUEST['Primary_Acc']);
	$Loan_A = FixString($_REQUEST['Loan_Any']);
	$EMI_Paid = FixString($_REQUEST['EMI_Paid']);
	$Credit_Limit = FixString($_REQUEST['Credit_Limit']);
	$Total_Experience = FixString($_REQUEST['Total_Experience']);
	$Years_In_Company = FixString($_REQUEST['Years_In_Company']);
	$Pincode = FixString($_REQUEST['Pincode']);
	$DOB = FixString($_REQUEST['DOB']);
	$CC_Holder = FixString($_REQUEST['CC_Holder']);
	$Card_Vintage = FixString($_REQUEST['Card_Vintage']);
	$Dated=ExactServerdate();
	
	$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-30, date("Y"));
	$days30date=date('Y-m-d',$tomorrow);
	$days30datetime = $days30date." 00:00:00";
	$currentdate= date('Y-m-d');
	$currentdatetime = date('Y-m-d')." 23:59:59";
	$getdetails="select RequestID From Req_Loan_Personal Where ( Mobile_Number not in (9811215138,9811555306,9999570210) and Mobile_Number='".$Phone."' and Updated_Date between '".$days30datetime."' and '".$currentdatetime."') order by RequestID DESC";

	list($alreadyExist,$myrow)=MainselectfuncNew($getdetails,$array = array());
	$myrowcontr=count($myrow)-1;
	if($alreadyExist>0)
	{
		
		$lastInsertedId = $myrow[$myrowcontr]["RequestID"];
		$Duplicate = "Duplicate";
	}
	else
	{		
		
		$dataInsert = array('Name'=>$Name, 'Email'=>$Email, 'Employment_Status'=>$Employment_Status, 'Company_Name'=>$Company_Name, 'City'=>$City,  'Mobile_Number'=>$Phone, 'Net_Salary'=>$Net_Salary, 'Loan_Amount'=>$Loan_Amount, 'DOB'=>$DOB, 'Dated'=>$Dated, 'Pincode'=>$Pincode, 'source'=>$Source, 'Updated_Date'=>$Dated, 'IP_Address'=>$IP, 'Annual_Turnover'=>$Annual_Turnover, 'Privacy'=>$accept, 'Company_Type'=>$Company_Type, 'PL_EMI_Amt'=>$PL_EMI_Amt, 'Primary_Acc'=>$Primary_Acc, 'Residential_Status'=>$Residential_Status, 'Card_Limit'=>$Credit_Limit, 'Years_In_Company'=>$Years_In_Company, 'Total_Experience'=>$Total_Experience, 'EMI_Paid'=>$EMI_Paid, 'Loan_Any'=>$Loan_A, 'CC_Holder'=>$CC_Holder, 'Card_Vintage'=>$Card_Vintage);		
		 $lastInsertedId = Maininsertfunc ('Req_Loan_Personal', $dataInsert);
		$Duplicate = "";
	}

if($Net_Salary<=298000)
	{
	list($realbankiD,$bankID,$FinalBidder,$finalBidderName)= getBiddersList("Req_Loan_Personal",$lastInsertedId,$City);
$arrFinal_Bid = "";
		while (list ($key,$val) = @each($FinalBidder)) { 
			$arrFinal_Bid[]= $val; 
		}
		$Final_Bid = "";
			while (list ($key,$val) = @each($bankID)) { 
				$Final_Bid[]= $val; 
			} 
  if(((strncmp ("Fullerton", $Final_Bid[$i],9))==0 || ($Final_Bid[$i]=="Fullerton")) && ($Residential_Status==1 || $Residential_Status==3 || $Residential_Status==4 || $Residential_Status==5))
	{
		$arrfinal_bidders[]=$arrFinal_Bid[$i];
	}
	else
	{
		if($Final_Bid[$i]!="Fullerton" || (strncmp ("Fullerton", $Final_Bid[$i],9))!=0)
		{
			$arrfinal_bidders[]=$arrFinal_Bid[$i];
		}
	}
	$getarrfinal_bidders=implode(',',$arrfinal_bidders);
	if(strlen($getarrfinal_bidders)>0)
	{
	$Allocated=2;
	}
	else 
	{		$Allocated=0;	}
	if(strlen($getarrfinal_bidders)>1)
	{
		$dataUpdate = array('Bidderid_Details'=>$getarrfinal_bidders, 'Allocated'=>$Allocated, 'Direct_Allocation'=>'1', 'IsProcessed'=>'1');
		$wherecondition = "(RequestID=".$lastInsertedId.")";
		Mainupdatefunc ('Req_Loan_Personal', $dataUpdate, $wherecondition);
	}
			}
	echo $lastInsertedId;
	echo ",".$lastId;
	echo ",".$Duplicate;
?>