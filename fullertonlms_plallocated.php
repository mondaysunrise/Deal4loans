<?php
	require 'scripts/db_init.php';
	require 'scripts/functions_nw.php';

$startprocess="Select * From lead_allocation_table Where (Citywise like '%fullerton allocated%' and BidderID=5105)";
echo $startprocess."<br>";
$startprocessresult = ExecQuery($startprocess);
$recordcount = mysql_num_rows($startprocessresult);
$row=mysql_fetch_array($startprocessresult);
$total_lead_count = $row["total_lead_count"];
$min_date = Date('Y-m-d')." 00:00:00";
$max_date = Date('Y-m-d')." 23:59:59";

if($total_lead_count>0)
{
	$qry="SELECT * FROM Req_Feedback_Bidder_PL,Req_Loan_Personal  WHERE (Req_Feedback_Bidder_PL.AllRequestID=Req_Loan_Personal.RequestID and Req_Feedback_Bidder_PL.BidderID=5105 and Req_Feedback_Bidder_PL.Reply_Type=1 and (Req_Feedback_Bidder_PL.Allocation_Date Between '".($min_date)."' and '".($max_date)."') and  Req_Feedback_Bidder_PL.Feedback_ID > '".$total_lead_count."') group by Req_Loan_Personal.Mobile_Number order by Feedback_ID ASC";
}
else
{
	$qry="SELECT * FROM Req_Feedback_Bidder_PL,Req_Loan_Personal  WHERE Req_Feedback_Bidder_PL.AllRequestID=Req_Loan_Personal.RequestID and Req_Feedback_Bidder_PL.BidderID in (5105) and Req_Feedback_Bidder_PL.Reply_Type=1 and (Req_Feedback_Bidder_PL.Allocation_Date Between '".($min_date)."' and '".($max_date)."' ) group by Req_Loan_Personal.Mobile_Number order by Feedback_ID ASC";
}

echo $qry."<br>";
$select4mcardsresult = ExecQuery($qry);
$recordcount1 = mysql_num_rows($select4mcardsresult);
$bidderID="";

while($row2 = mysql_fetch_array($select4mcardsresult))
{	
		$RequestID = $row2["RequestID"];
		$FeedbackID = $row2["Feedback_ID"];
		$BidderID = $row2["BidderID"];
		$Name = $row2["Name"];
		$Email = $row2["Email"];
		$Employment_Status = $row2["Employment_Status"];
		$Company_Name = $row2["Company_Name"];
		$City = $row2["City"];
		$City_Other = $row2["City_Other"];
		$Std_Code = $row2["Std_Code"];
		$Landline = $row2["Landline"];
		$Mobile_Number = $row2["Mobile_Number"];
		$Years_In_Company = $row2["Years_In_Company"];
		$Total_Experience = $row2["Total_Experience"];
		$Net_Salary = $row2["Net_Salary"];
		$Residential_Status = $row2["Residential_Status"];
		$Loan_Any = $row2["Loan_Any"];
		$EMI_Paid = $row2["EMI_Paid"];
		$CC_Holder = $row2["CC_Holder"];
		$Card_Vintage = $row2["Card_Vintage"];
		$Card_Limit = $row2["Card_Limit"];
		$Loan_Amount = $row2["Loan_Amount"];
		$Pincode = $row2["Pincode"];
		$Dated = $row2["Dated"];
		$CC_Age = $row2["CC_Age"];
		$CC_Bank = $row2["CC_Bank"];
		$Primary_Acc = $row2["Primary_Acc"];
		$PL_EMI_Amt = $row2["PL_EMI_Amt"];
		$PL_Bank = $row2["PL_Bank"];
		$PL_Tenure = $row2["PL_Tenure"];
		$PL_EMI_Paid = $row2["PL_EMI_Paid"];
		$IP_Address = $row2["IP_Address"];
		$DOB = $row2["DOB"];
		$Salary_Drawn = $row2["Salary_Drawn"];
		$Updated_Date = $row2["Updated_Date"];
		$Add_Comment = $row2["Add_Comment"];
		$identification_proof = $row2["identification_proof"];
		$Company_Type = $row2["Company_Type"];
		$Annual_Turnover = $row2["Annual_Turnover"];
		$Existing_Bank = $row2["Existing_Bank"];
		$Existing_Loan = $row2["Existing_Loan"];
		$Existing_ROI = $row2["Existing_ROI"];
		$Allocation_Date = $row2["Allocation_Date"];
echo "<br><br>";
	$checkexist="Select RequestID from Fullerton_Allocated_Leads Where (RequestID='".$RequestID."' and Allocation_Date Between '".($min_date)."' and '".($max_date)."')";
	$checkexistresult = ExecQuery($checkexist);
	$row = mysql_fetch_array($checkexistresult);
	$num_rows = mysql_num_rows($checkexistresult);

if($num_rows>0)
	{
	echo "i m here";
	}
	else
	{
	echo $fullertonallocate= "INSERT INTO Fullerton_Allocated_Leads (RequestID, FeedbackID, BidderID, Name, Email, Employment_Status, Company_Name, City, City_Other, Std_Code, Landline, Mobile_Number, Years_In_Company, Total_Experience, Net_Salary, Residential_Status, Loan_Any, EMI_Paid, CC_Holder, Card_Vintage, Card_Limit, Loan_Amount, Pincode, Dated, CC_Age, CC_Bank, Primary_Acc, PL_EMI_Amt, PL_Bank, PL_Tenure, IP_Address, DOB, Salary_Drawn, Updated_Date, Add_Comment, identification_proof, Company_Type, Annual_Turnover, Existing_Bank, Existing_Loan, Existing_ROI,  Allocation_Date) VALUES ('".$RequestID."', '".$FeedbackID."', '".$BidderID."', '".$Name."',  '".$Email."', '".$Employment_Status."', '".$Company_Name."', '".$City."', '".$City_Other."', '".$Std_Code."', '".$Landline."', '".$Mobile_Number."', '".$Years_In_Company."', '".$Total_Experience."', '".$Net_Salary."', '".$Residential_Status."', '".$Loan_Any."', '".$EMI_Paid."', '".$CC_Holder."', '".$Card_Vintage."', '".$Card_Limit."', '".$Loan_Amount."', '".$Pincode."', '".$Dated."', '".$CC_Age."', '".$CC_Bank."', '".$Primary_Acc."', '".$PL_EMI_Amt."', '".$PL_Bank."', '".$PL_Tenure."', '".$IP_Address."', '".$DOB."', '".$Salary_Drawn."', '".$Updated_Date."', '".$Add_Comment."', '".$identification_proof."', '".$Company_Type."', '".$Annual_Turnover."', '".$Existing_Bank."', '".$Existing_Loan."', '".$Existing_ROI."','".$Allocation_Date."')";
	$fullertonallocateresult = ExecQuery($fullertonallocate);
echo "<br><br>";
			if($FeedbackID>0)
			{
				echo $updateqry= "Update lead_allocation_table set total_lead_count=".$FeedbackID." Where (Citywise like '%fullerton allocated%' and BidderID=5105)";
				$updateqryresult = ExecQuery($updateqry);
			}
}
}

