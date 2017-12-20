<?php
//File Not in use
require 'scripts/db_init.php';
require 'scripts/functions.php';

$count = $_POST['count'];

$Name = $_POST['Name'];
$Email = $_POST['Email'];
$Residential_Status = $_POST['Residential_Status'];
$Employment_Status = $_POST['Employment_Status'];
$DOB = $_POST['DOB'];
$Company_Name = $_POST['Company_Name'];
$Mobile_Number = $_POST['Mobile_Number'];
$Net_Salary = $_POST['Net_Salary'];
$Loan_Amount = $_POST['Loan_Amount'];
$Pancard = $_POST['Pancard'];
$City = $_POST['City'];
$City_Other = $_POST['City_Other'];
$Dated = $_POST['Dated'];
$allocated_sms = $_POST['allocated_sms'];
$BidderIDSend = $_POST['BidderIDSend'];
$Years_In_Company = $_POST['Years_In_Company'];
$Total_Experience = $_POST['Total_Experience'];
$EMI_Paid = $_POST['EMI_Paid'];
$CC_Holder = $_POST['CC_Holder'];
$Card_Vintage = $_POST['Card_Vintage'];
$Card_Limit = $_POST['Card_Limit'];
$Pincode = $_POST['Pincode'];
$Primary_Acc = $_POST['Primary_Acc'];
$IP_Address = $_POST['IP_Address'];
$Residence_Address = $_POST['Residence_Address'];
$Updated_Date = $_POST['Updated_Date'];
$identification_proof = $_POST['identification_proof'];
$Company_Type = $_POST['Company_Type'];
$eligible = $_POST['eligible'];


$arrName = explode(",",$Name);
$arrEmail = explode(",",$Email);
$arrResidential_Status = explode(",",$Residential_Status);
$arrEmployment_Status = explode(",",$Employment_Status);
$arrDOB = explode(",",$DOB);
$arrCompany_Name = explode(",",$Company_Name);
$arrMobile_Number = explode(",",$Mobile_Number);
$arrNet_Salary = explode(",",$Net_Salary);
$arrLoan_Amount = explode(",",$Loan_Amount);
$arrPancard = explode(",",$Pancard);
$arrCity = explode(",",$City);
$arrCity_Other = explode(",",$City_Other);
$arrDated = explode(",",$Dated);
$arrallocated_sms = explode(",",$allocated_sms);
$arrBidderIDSend = explode(",",$BidderIDSend);
$arrYears_In_Company = explode(",",$Years_In_Company);
$arrTotal_Experience = explode(",",$Total_Experience);
$arrEMI_Paid = explode(",",$EMI_Paid);
$arrCC_Holder = explode(",",$CC_Holder);
$arrCard_Vintage = explode(",",$Card_Vintage);
$arrCard_Limit = explode(",",$Card_Limit);
$arrPincode = explode(",",$Pincode);
$arrPrimary_Acc = explode(",",$Primary_Acc);
$arrIP_Address = explode(",",$IP_Address);
$arrResidence_Address = explode(",",$Residence_Address);
$arrUpdated_Date = explode(",",$Updated_Date);
$arridentification_proof = explode(",",$identification_proof);
$arrCompany_Type = explode(",",$Company_Type);
$arreligible = explode(",",$eligible);

for($i=0;$i<$count;$i++)
{
		
	
	$Sql = "INSERT INTO fullerton_pl_leads (Name, Email, Residential_Status, Employment_Status, DOB, Company_Name, Mobile_Number, Net_Salary, Loan_Amount, Pancard, City, City_Other, Dated, allocated_sms, BidderIDSend, Years_In_Company, Total_Experience, EMI_Paid, CC_Holder, Card_Vintage, Card_Limit, Pincode, Primary_Acc, IP_Address, Residence_Address, Updated_Date, identification_proof, Company_Type, eligible  ) VALUES ('".$arrName[$i]."', '".$arrEmail[$i]."', '".$arrResidential_Status[$i]."', '".$arrEmployment_Status[$i]."', '".$arrDOB[$i]."', '".$arrCompany_Name[$i]."', '".$arrMobile_Number[$i]."', '".$arrNet_Salary[$i]."', '".$arrLoan_Amount[$i]."', '".$arrPancard[$i]."', '".$arrCity[$i]."', '".$arrCity_Other[$i]."', '".$arrDated[$i]."', '".$arrallocated_sms[$i]."', '".$arrBidderIDSend[$i]."', '".$arrYears_In_Company[$i]."', '".$arrTotal_Experience[$i]."', '".$arrEMI_Paid[$i]."', '".$arrCC_Holder[$i]."', '".$arrCard_Vintage[$i]."', '".$arrCard_Limit[$i]."', '".$arrPincode[$i]."', '".$arrPrimary_Acc[$i]."', '".$arrIP_Address[$i]."', '".$arrResidence_Address[$i]."', '".$arrUpdated_Date[$i]."', '".$arridentification_proof[$i]."', '".$arrCompany_Type[$i]."', '".$arreligible[$i]."')";
	echo $Sql."<br>";
}
?>