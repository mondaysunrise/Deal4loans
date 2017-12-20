<?php
require 'scripts/db_init.php';

bobtransfer();

function bobtransfer()
{
	$Today=Date('Y-m-d');
	
	$min_date=$Today." 00:00:00";
	$max_date=$Today." 23:59:59";

	$bobqry="SELECT RequestID, Name,DOB,Email, Mobile_Number,Std_Code, Landline,Company_Name,City, City_Other,Pincode, Net_Salary, Loan_Any, Loan_Amount, IP_Address,Add_Comment,Allocation_Date, Employment_Status,AllRequestID,BidderID FROM Req_Feedback_Bidder_HL,Req_Loan_Home WHERE (Req_Feedback_Bidder_HL.AllRequestID=Req_Loan_Home.RequestID and Req_Feedback_Bidder_HL.BidderID in (6492) and Req_Feedback_Bidder_HL.Reply_Type=2 and Req_Feedback_Bidder_HL.Allocation_Date Between '".$min_date."' and '".$max_date."')";
	$search_result=ExecQuery($bobqry);
	$recordcount = mysql_num_rows($search_result);

	while($row=mysql_fetch_array($search_result))
	{	
		$requestid= $row["RequestID"];
		$hlname= $row["Name"];
		$hlemail= $row["Email"];
		$hldob= $row["DOB"];
		$hlgender= $row["Gender"];
		$pancard= $row["Pancard"];
		$hlcity= $row["City"];
		$hlcityother= $row["City_Other"];
		$hlresiaddress= $row["Residence_Address"];
		$hlpincode= $row["Pincode"];
		$hlmobile= $row["Mobile_Number"];
		$hlsalary= $row["Net_Salary"];
		$hlloanamt= $row["Loan_Amount"];
		$hlipaddress= $row["IP_Address"];
		$dated= $row["Allocation_Date"];
		$hlemployment_status= $row["Employment_Status"];
	
	$hldetails = "select RequestID from Req_Loan_Home_Extrafields Where (HL_RequestID=".$requestid.")";
	$hldetailsresult = ExecQuery($hldetails);
	$recordcount2 = mysql_num_rows($hldetailsresult);
	if($recordcount2>0)
		{	}
		else
		{
	 $InsertProductSql = "INSERT INTO Req_Loan_Home_Extrafields (HL_RequestID, Name, Email, DOB, Gender, Pancard, City, City_Other, Residence_Address, Employment_Status, Pincode, Mobile_Number, Net_Salary, Loan_Amount, Dated, source, IP_Address) VALUES ('$requestid','$hlname', '$hlemail', '$hldob', '$hlgender', '$pancard','$hlcity', '$hlcityother', '$hlresiaddress', '$hlemployment_status', '$hlpincode', '$hlmobile', '$hlsalary', '$hlloanamt', '$dated', 'BOB', '$hlipaddress')"; 
	$bobresult=ExecQuery($InsertProductSql);
		}
	}
}
?>