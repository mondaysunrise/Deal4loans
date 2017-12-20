<?php
	require 'scripts/db_init.php';
	require 'scripts/functions_nw.php';

$startprocess="Select * From lead_allocation_table Where (Citywise like '%icici allocated%' and BidderID=4387)";
list($recordcount,$row)=Mainselectfunc($startprocess,$array = array());
$row=mysql_fetch_array($startprocessresult);
$total_lead_count = $row["total_lead_count"];
$min_date = Date('Y-m-d')." 00:00:00";
$max_date = Date('Y-m-d')." 23:59:59";

if($total_lead_count>0)
{
	$qry="SELECT * FROM Req_Feedback_Bidder_PL,Req_Loan_Personal  WHERE (Req_Feedback_Bidder_PL.AllRequestID=Req_Loan_Personal.RequestID and Req_Feedback_Bidder_PL.BidderID in (4900,5115) and Req_Feedback_Bidder_PL.Reply_Type=1 and (Req_Feedback_Bidder_PL.Allocation_Date Between '".($min_date)."' and '".($max_date)."') and  Req_Feedback_Bidder_PL.Feedback_ID > '".$total_lead_count."') group by Req_Loan_Personal.Mobile_Number";
}
else
{
	$qry="SELECT * FROM Req_Feedback_Bidder_PL,Req_Loan_Personal  WHERE Req_Feedback_Bidder_PL.AllRequestID=Req_Loan_Personal.RequestID and Req_Feedback_Bidder_PL.BidderID in (4900,5115) and Req_Feedback_Bidder_PL.Reply_Type=1 and (Req_Feedback_Bidder_PL.Allocation_Date Between '".($min_date)."' and '".($max_date)."' ) group by Req_Loan_Personal.Mobile_Number";
}

 list($recordcount1,$row2)=MainselectfuncNew($qry,$array = array());
		$cntr=0;

$bidderID="";
while($cntr<count($row2))
        {	
		$RequestID = $row2[$cntr]["RequestID"];
		$FeedbackID = $row2[$cntr]["Feedback_ID"];
		$BidderID = $row2[$cntr]["BidderID"];
		$Name = $row2[$cntr]["Name"];
		$Email = $row2[$cntr]["Email"];
		$Employment_Status = $row2[$cntr]["Employment_Status"];
		$Company_Name = $row2[$cntr]["Company_Name"];
		$City = $row2[$cntr]["City"];
		$City_Other = $row2[$cntr]["City_Other"];
		$Std_Code = $row2[$cntr]["Std_Code"];
		$Landline = $row2[$cntr]["Landline"];
		$Mobile_Number = $row2[$cntr]["Mobile_Number"];
		$Years_In_Company = $row2[$cntr]["Years_In_Company"];
		$Total_Experience = $row2[$cntr]["Total_Experience"];
		$Net_Salary = $row2[$cntr]["Net_Salary"];
		$Residential_Status = $row2[$cntr]["Residential_Status"];
		$Loan_Any = $row2[$cntr]["Loan_Any"];
		$EMI_Paid = $row2[$cntr]["EMI_Paid"];
		$CC_Holder = $row2[$cntr]["CC_Holder"];
		$Card_Vintage = $row2[$cntr]["Card_Vintage"];
		$Card_Limit = $row2[$cntr]["Card_Limit"];
		$Loan_Amount = $row2[$cntr]["Loan_Amount"];
		$Pincode = $row2[$cntr]["Pincode"];
		$Dated = $row2[$cntr]["Dated"];
		$CC_Age = $row2[$cntr]["CC_Age"];
		$CC_Bank = $row2[$cntr]["CC_Bank"];
		$Primary_Acc = $row2[$cntr]["Primary_Acc"];
		$PL_EMI_Amt = $row2[$cntr]["PL_EMI_Amt"];
		$PL_Bank = $row2[$cntr]["PL_Bank"];
		$PL_Tenure = $row2[$cntr]["PL_Tenure"];
		$PL_EMI_Paid = $row2[$cntr]["PL_EMI_Paid"];
		$IP_Address = $row2[$cntr]["IP_Address"];
		$DOB = $row2[$cntr]["DOB"];
		$Salary_Drawn = $row2[$cntr]["Salary_Drawn"];
		$Updated_Date = $row2[$cntr]["Updated_Date"];
		$Add_Comment = $row2[$cntr]["Add_Comment"];
		$identification_proof = $row2[$cntr]["identification_proof"];
		$Company_Type = $row2[$cntr]["Company_Type"];
		$Annual_Turnover = $row2[$cntr]["Annual_Turnover"];
		$Existing_Bank = $row2[$cntr]["Existing_Bank"];
		$Existing_Loan = $row2[$cntr]["Existing_Loan"];
		$Existing_ROI = $row2[$cntr]["Existing_ROI"];
		$Allocation_Date = $row2[$cntr]["Allocation_Date"];
echo "<br><br>";
	$checkexist="Select RequestID from ICICI_Allocated_Leads Where (RequestID='".$RequestID."' and Allocation_Date Between '".($min_date)."' and '".($max_date)."')";
	
	list($num_rows,$row)=Mainselectfunc($checkexist,$array = array());
	
if($num_rows>0)
	{
	echo "i m here";
	}
	else
	{
	
	$dataInsert = array("RequestID"=>$RequestID, "FeedbackID"=>$FeedbackID, "BidderID"=>$BidderID, "Name"=>$Name, "Email"=>$Email, "Employment_Status"=>$Employment_Status, "Company_Name"=>$Company_Name, "City"=>$City, "City_Other"=>$City_Other, "Std_Code"=>$Std_Code, "Landline"=>$Landline, "Mobile_Number"=>$Mobile_Number, "Years_In_Company"=>$Years_In_Company, "Total_Experience"=>$Total_Experience, "Net_Salary"=>$Net_Salary, "Residential_Status"=>$Residential_Status, "Loan_Any"=>$Loan_Any, "EMI_Paid"=>$EMI_Paid, "CC_Holder"=>$CC_Holder, "Card_Vintage"=>$Card_Vintage, "Card_Limit"=>$Card_Limit, "Loan_Amount"=>$Loan_Amount, "Pincode"=>$Pincode, "Dated"=>$Dated, "CC_Age"=>$CC_Age, "CC_Bank"=>$CC_Bank, "Primary_Acc"=>$Primary_Acc, "PL_EMI_Amt"=>$PL_EMI_Amt, "PL_Bank"=>$PL_Bank, "PL_Tenure"=>$PL_Tenure, "PL_EMI_Paid"=>$PL_EMI_Paid, "IP_Address"=>$IP_Address, "DOB"=>$DOB, "Salary_Drawn"=>$Salary_Drawn, "Updated_Date"=>$Updated_Date, "Add_Comment"=>$Add_Comment, "identification_proof"=>$identification_proof, "Company_Type"=>$Company_Type, "Annual_Turnover"=>$Annual_Turnover, "Existing_Bank"=>$Existing_Bank, "Existing_Loan"=>$Existing_Loan, "Existing_ROI"=>$Existing_ROI, " Allocation_Date"=>$Allocation_Date, "eligible"=>1);
$table = 'ICICI_Allocated_Leads';
$insert = Maininsertfunc ($table, $dataInsert);
	
	echo "<br><br>";
			if($FeedbackID>0)
			{
				$DataArray = array("total_lead_count"=>$FeedbackID);
				$wherecondition ="(Citywise like '%icici allocated%' and BidderID=4387)";
				Mainupdatefunc ('lead_allocation_table', $DataArray, $wherecondition);
			}
$cntr=$cntr+1;}
}

