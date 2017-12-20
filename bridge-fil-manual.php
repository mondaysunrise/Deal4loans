<?php
	ob_start();
	require 'scripts/db_init.php';
	require 'scripts/db_init_fil.php';	
	require 'scripts/functions_nw.php';
//$BidderID = 1739;
// 2025 - 2152   3793	nilanj_full_pl@d4l.com	nilanj0308131
$arrBidderID = array(1739,1745,1746,1747,1748,1749,1752,1753,1754,1755,1782,1783,1784,1808,1806,1807,1809,1810,1811,1812,1813,1863,1864,1865,1866,1869,1870,1892,1893,1894,1895,1902,1910,1922,1923,1924,1990,2004,2023,2024,2026,2152,2033,2034,2050,2051,2052,2053,2056,2057,2058,2059,2060,2061,2062,2063,2064,2065,2066,2067,2068,2069,2070,2071,2116,2132,2155,2158,2161,2181,2190,2195,2213,2214,2329,2330,2366,2372,2477,2478,2487,2488,2489,2504,2606,2624,2705,2710,2714,2716,2717,2731,2763,2786,2972,3034,3062,3113,3138,3244,3412,3558,3564,3574,3594,3793,5310);
$arrFilBidderID = array(29,66,67,68,69,70,71,72,73,74,38,37,41,22,18,19,33,32,30,79,80,12,82,83,84,85,35,58,61,34,60,86,50,76,77,78,49,42,93,43,45,65,94,90,91,20,31,81,56,39,11,9,25,88,87,14,13,36,76,78,24,75,77,40,108,109,110,89,111,112,113,114,115,116,117,118,119,120,121,122,123,124,125,126,127,128,129,130,131,132,133,134,135,136,137,138,139,140,141,142,143,144,145,146,147,148,149);
$today= date('Y-m-d');
$min_date="2015-05-05 10:45:14";
$max_date="2015-05-10 23:45:01";
for($arr=0;$arr<count($arrBidderID);$arr++)
{
	echo "select  RequestID from Req_Compaign where (Reply_Type=1 and BidderID='".$arrBidderID[$arr]."' and  Sms_Flag=0 and Bank_Name='FIL' and  City_Wise='' and  Mobile_no='')";
	echo "<br>";
	$getrequestID=ExecQuery("select  RequestID from Req_Compaign where (Reply_Type=1 and BidderID='".$arrBidderID[$arr]."' and  Sms_Flag=0 and Bank_Name='FIL' and  City_Wise='' and  Mobile_no='')");
	$req= mysql_fetch_array($getrequestID);
	echo $getrequestID."<br>";
	$requestrecordcount = mysql_num_rows($getrequestID);
	
	$qry="SELECT * FROM Req_Feedback_Bidder1,Req_Loan_Personal  WHERE Req_Feedback_Bidder1.AllRequestID=Req_Loan_Personal.RequestID and Req_Feedback_Bidder1.BidderID = '".$arrBidderID[$arr]."' and Req_Feedback_Bidder1.Reply_Type=1 and (Req_Feedback_Bidder1.Allocation_Date Between '".($min_date)."' and '".($max_date)."' ) ";
	$qry=$qry."group by Req_Loan_Personal.Mobile_Number";
	
		echo $qry."<br>";
	
		$getLeadDetailsQuery = ExecQuery($qry);
		$getAllocatedLeadNum = mysql_num_rows($getLeadDetailsQuery);
		if($getAllocatedLeadNum>0)
		{
			$smsText = "Started to FIL: ".$RequestID."--".$lastInserted;	
			$PhoneNumber = 9971396361;
			//SendSMS($smsText, $PhoneNumber);
		}
		
		for($i=0;$i<$getAllocatedLeadNum;$i++)
		{
			$Feedback_ID = mysql_result($getLeadDetailsQuery,$i,'Feedback_ID');
			$Allocation_Date = mysql_result($getLeadDetailsQuery,$i,'Allocation_Date');
			$RequestID = mysql_result($getLeadDetailsQuery,$i,'RequestID');
			$Name = mysql_result($getLeadDetailsQuery,$i,'Name');
			$Email = mysql_result($getLeadDetailsQuery,$i,'Email');
			$Employment_Status = mysql_result($getLeadDetailsQuery,$i,'Employment_Status');
			$Company_Name = mysql_result($getLeadDetailsQuery,$i,'Company_Name');
			$City = mysql_result($getLeadDetailsQuery,$i,'City');
			if($City == 'Navi Mumbai')
			{
				$City= 'Navi mumbai';
			}
			$City_Other = mysql_result($getLeadDetailsQuery,$i,'City_Other');
			$Mobile_Number = mysql_result($getLeadDetailsQuery,$i,'Mobile_Number');
			$Years_In_Company = mysql_result($getLeadDetailsQuery,$i,'Years_In_Company');
			$Total_Experience = mysql_result($getLeadDetailsQuery,$i,'Total_Experience');
			$Net_Salary = mysql_result($getLeadDetailsQuery,$i,'Net_Salary');
			$Residential_Status = mysql_result($getLeadDetailsQuery,$i,'Residential_Status');//Manipulate
			if($Residential_Status==1)
			{
				$Residential_Status = "Owned";
			}
			else if($Residential_Status==2)
			{
				$Residential_Status = "Rented";
			}
			else if($Residential_Status==3)
			{
				$Residential_Status = "Company Provided";
			}
			else
			{
				$Residential_Status = "Owned";
			}
			$CC_Holder = mysql_result($getLeadDetailsQuery,$i,'CC_Holder');
			$Card_Vintage = mysql_result($getLeadDetailsQuery,$i,'Card_Vintage');
			
			$Card_Limit= mysql_result($getLeadDetailsQuery,$i,'Card_Limit');

			$Loan_Amount= mysql_result($getLeadDetailsQuery,$i,'Loan_Amount');
			$Pincode= mysql_result($getLeadDetailsQuery,$i,'Pincode');
			$Dated= mysql_result($getLeadDetailsQuery,$i,'Dated');
			$source = "D4L";
			$DOB = mysql_result($getLeadDetailsQuery,$i,'DOB');
			$IP_Address = mysql_result($getLeadDetailsQuery,$i,'IP_Address');
			$Updated_Date�= mysql_result($getLeadDetailsQuery,$i,'Updated_Date');
			$Pancard = mysql_result($getLeadDetailsQuery,$i,'Pancard');
			$Loan_Any= mysql_result($getLeadDetailsQuery,$i,'Loan_Any');
			$PL_EMI_Amt = mysql_result($getLeadDetailsQuery,$i,'PL_EMI_Amt');
			$EMI_Paid= mysql_result($getLeadDetailsQuery,$i,'EMI_Paid');
			
				
			$insertSql = "INSERT INTO Req_Loan_Personal ( UserID, Name, Email, Employment_Status, Company_Name, City, City_Other, Mobile_Number, Years_In_Company, Total_Experience, Net_Salary, Residential_Status, CC_Holder, Card_Vintage, Card_Limit, Loan_Amount, Pincode, Dated, source, IP_Address, DOB, Updated_Date, Pancard, allocated_sms,Loan_Any,EMI_Paid,PL_EMI_Amt) values ('".$RequestID."', '".$Name."', '".$Email."', '".$Employment_Status."', '".$Company_Name."', '".$City."', '".$City_Other."', '".$Mobile_Number."', '".$Years_In_Company."', '".$Total_Experience."', '".$Net_Salary."', '".$Residential_Status."', '".$CC_Holder."', '".$Card_Vintage."', '".$Card_Limit."', '".$Loan_Amount."', '".$Pincode."', '".$Dated."', '".$source."', '".$IP_Address."', '".$DOB."', '".$Updated_Date."', '".$Pancard."', '1', '".$Loan_Any."', '".$EMI_Paid."', '".$PL_EMI_Amt."' )  ";
			$insertQuery = ExecQuery_fil($insertSql);
			
			$lastInserted = mysql_insert_id();
			echo "<br>".$insertSql;
				
			$smsText = "Copied to FIL: ".$RequestID."--".$lastInserted;	
			$PhoneNumber = 9971396361;
			//SendSMS($smsText, $PhoneNumber);
				
			$insertAllocationsSql = "insert into allocation_leads (RequestID, BidderID, Dated, ProductID) values ('".$lastInserted."', '".$arrFilBidderID[$arr]."', '".$Allocation_Date."', '10') ";
			$insertAllocationsQuery = ExecQuery_fil($insertAllocationsSql);
			echo "<br>".$insertAllocationsSql;
			$updateleadSql = "update Req_Compaign set RequestID='".$Feedback_ID."' where (Reply_Type=1 and BidderID='".$arrBidderID[$arr]."' and  Sms_Flag=0 and Bank_Name='FIL' and  City_Wise='' and  Mobile_no='')";
			//$updateleadQuery = ExecQuery($updateleadSql);
			echo "<br>".$updateleadSql;
		}
}	

?>