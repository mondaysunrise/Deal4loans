<?php
	require 'scripts/db_init.php';
	require 'scripts/functions_nw.php';
	require_once ("lib/nusoap.php");

$startprocess="Select * From lead_allocation_table Where (Citywise like '%icici allocated%' and BidderID=4387)";
echo $startprocess."<br>";
$startprocessresult = ExecQuery($startprocess);
$recordcount = mysql_num_rows($startprocessresult);
$row=mysql_fetch_array($startprocessresult);
$total_lead_count = $row["total_lead_count"];
$min_date = Date('Y-m-d')." 00:00:00";
$max_date = Date('Y-m-d')." 23:59:59";

if($total_lead_count>0)
{
	$qry="SELECT * FROM Req_Feedback_Bidder_PL,Req_Loan_Personal  WHERE (Req_Feedback_Bidder_PL.AllRequestID=Req_Loan_Personal.RequestID and Req_Feedback_Bidder_PL.BidderID in (4900,5115,5686) and Req_Feedback_Bidder_PL.Reply_Type=1 and (Req_Feedback_Bidder_PL.Allocation_Date Between '".($min_date)."' and '".($max_date)."') and  Req_Feedback_Bidder_PL.Feedback_ID > '".$total_lead_count."') group by Req_Loan_Personal.Mobile_Number order by Feedback_ID ASC LIMIT 0,1";
}
else
{
	$qry="SELECT * FROM Req_Feedback_Bidder_PL,Req_Loan_Personal  WHERE Req_Feedback_Bidder_PL.AllRequestID=Req_Loan_Personal.RequestID and Req_Feedback_Bidder_PL.BidderID in (4900,5115,5686) and Req_Feedback_Bidder_PL.Reply_Type=1 and (Req_Feedback_Bidder_PL.Allocation_Date Between '".($min_date)."' and '".($max_date)."' ) group by Req_Loan_Personal.Mobile_Number order by Feedback_ID ASC LIMIT 0,1";
}

//$qry="SELECT * FROM Req_Loan_Personal  WHERE RequestID=1714696";
 	
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
		
		if($City=="Others" && strlen($City_Other)>0)
		{
			$strcity=$City_Other;
		}
		else
		{
			$strcity=$City;
		}

echo "<br><br>";
	$checkexist="Select RequestID from ICICI_Allocated_Leads Where (RequestID='".$RequestID."' and Allocation_Date Between '".($min_date)."' and '".($max_date)."')";
	$checkexistresult = ExecQuery($checkexist);
	$row = mysql_fetch_array($checkexistresult);
	$num_rows = mysql_num_rows($checkexistresult);

if($num_rows>0)
	{
	echo "i m here";
	}
	else
	{
	$iciciallocate= "INSERT INTO ICICI_Allocated_Leads (RequestID, FeedbackID, BidderID, Name, Email, Employment_Status, Company_Name, City, City_Other, Std_Code, Landline, Mobile_Number, Years_In_Company, Total_Experience, Net_Salary, Residential_Status, Loan_Any, EMI_Paid, CC_Holder, Card_Vintage, Card_Limit, Loan_Amount, Pincode, Dated, CC_Age, CC_Bank, Primary_Acc, PL_EMI_Amt, PL_Bank, PL_Tenure, PL_EMI_Paid, IP_Address, DOB, Salary_Drawn, Updated_Date, Add_Comment, identification_proof, Company_Type, Annual_Turnover, Existing_Bank, Existing_Loan, Existing_ROI,  Allocation_Date, eligible) VALUES ('".$RequestID."', '".$FeedbackID."', '".$BidderID."', '".$Name."',  '".$Email."', '".$Employment_Status."', '".$Company_Name."', '".$City."', '".$City_Other."', '".$Std_Code."', '".$Landline."', '".$Mobile_Number."', '".$Years_In_Company."', '".$Total_Experience."', '".$Net_Salary."', '".$Residential_Status."', '".$Loan_Any."', '".$EMI_Paid."', '".$CC_Holder."', '".$Card_Vintage."', '".$Card_Limit."', '".$Loan_Amount."', '".$Pincode."', '".$Dated."', '".$CC_Age."', '".$CC_Bank."', '".$Primary_Acc."', '".$PL_EMI_Amt."', '".$PL_Bank."', '".$PL_Tenure."', '".$PL_EMI_Paid."', '".$IP_Address."', '".$DOB."', '".$Salary_Drawn."', '".$Updated_Date."', '".$Add_Comment."', '".$identification_proof."', '".$Company_Type."', '".$Annual_Turnover."', '".$Existing_Bank."', '".$Existing_Loan."', '".$Existing_ROI."','".$Allocation_Date."','1')";
	$iciciallocateresult = ExecQuery($iciciallocate);
	//echo "<br><br>";
			
		if($RequestID>0)
			{		
		list($first,$last) = split('[ ]',$Name);
		if($last=="")
		{		$last= "K";		}
		list($GMI,$prt) = split('[.]',$Net_Salary);
		list($lamt,$scprt) = split('[.]',$Loan_Amount);

		list($yyyy,$mm,$dd) = split('[-]',$DOB);
		$dobstr = $dd."-".$mm."-".$yyyy;
		
		function getReqcityValue($pKey){
		$titles = array(
			'Agra' => '1102',
			'Ahmedabad' => '22',
			'Ajmer' => '1103',
			'Allahabad' => '1104',
			'Alwar' => '1105',
			'Amritsar' => '1106',
			'Anand' => '1107',
			'Bahadurgarh' => '1108',
			'Bareilly' => '1109',
			'Baroda' => '707',
			'Belgaum' => '980',
			'Bengaluru' => '19',
			'Bangalore' => '19',
			'Bhilai' => '1110',
			'Bhiwadi' => '1111',
			'Bhopal' => '623',
			'Bhubaneswar' => '1112',
			'Bhubneshwar' => '1112',
			'Bikaner' => '1063',
			'Bokaro' => '1113',
			'Calicut' => '1114',
			'Chandigarh' => '9',
			'Chennai' => '21',
			'Cochin' => '241',
			'Coimbatore' => '69',
			'Cuttack' => '1115',
			'Dehradun' => '1062',
			'Dharuhera' => '1071',
			'Faridabad' => '981',
			'Gandhidham' => '1072',
			'Gaziabad' => '87',
			'Ghaziabad' => '87',
			'Greater Noida' => '704',
			'Gurgaon' => '7',
			'Guwahati' => '1073',
			'Hubli' => '1011',
			'Hyderabad' => '15',
			'Indore' => '106',
			'Jabalpur' => '1074',
			'Jaipur' => '100',
			'Jalandhar' => '1075',
			'Jammu' => '1076',
			'Jamshedpur' => '1077',
			'Jodhpur' => '1078',
			'Kalyan' => '1079',
			'Kanpur' => '1080',
			'Kolkata' => '64',
			'Kota' => '1081',
			'Kozhikode' => '1082',
			'Lucknow' => '807',
			'Ludhiana' => '1055',
			'Madurai' => '1083',
			'Manesar' => '1084',
			'Mangalore' => '984',
			'Mathura' => '1085',
			'Meerut' => '1086',
			'Mohali' => '1087',
			'Mumbai' => '25',
			'Mysore' => '1088',
			'Nagpur' => '135',
			'Nasik' => '1089',
			'Nashik' => '1089',
			'Navi Mumbai' => '163',
			'Delhi' => '318',
			'Noida' => '78',
			'Others' => '999999',
			'Patiala' => '1090',
			'Patna' => '1091',
			'Pondicherry' => '1092',
			'Pune' => '26',
			'Raipur' => '1056',
			'Rajkot' => '1035',
			'Ranchi' => '1093',
			'Secunderabad' => '94',
			'Sonepat' => '1094',
			'Sonipat' => '1094',
			'Surat' => '190',
			'Thane' => '640',
			'Trichy' => '1095',
			'Trivandrum' => '1096',
			'Udaipur' => '992',
			'Udupi' => '1097',
			'Vadodara' => '993',
			'Vapi' => '1098',
			'Vellore' => '1099',
			'Vijayawada' => '1100',
			'Visakhapatnam' => '1101',
			'Vishakapatanam' => '1101'
			 );
		foreach ($titles as $key=>$value)
			if($pKey==$key)
			return $value;
		return "";
	  }
		$cityname=getReqcityValue(ucfirst($strcity));

		if($cityname>1)
		{
			$cityid = $cityname;
		}
		else
		{
			$cityid = 999999;
		}

		if(strlen($Email)>0)
			{
				$strEmail=$Email;
			}
			else
			{
				$strEmail=$first."@gmail.com";
			}

		$xmlstr="<CLRequest>            
				<Authentication>               
				   <UserId>Deal4loans</UserId>
				   <Password>TTy@prd#4%^uT0</Password>
				</Authentication>
				<CreateLead>               
				   <Version>1</Version>
				   <PartnerUnqId>12340</PartnerUnqId>
				   <FirstName>".$first."</FirstName>
				   <MiddleName></MiddleName>
				   <LastName>".$last."</LastName>
				   <DOB>".$dobstr."</DOB>
				   <Mobile>".$Mobile_Number."</Mobile>
				   <Email>".$strEmail."</Email>
				   <EmpType>1</EmpType>
				   <GMI>".$GMI."</GMI>
				   <CurResCity>".$cityid."</CurResCity>
				   <LnAmt>".$lamt."</LnAmt>
				</CreateLead>
			 </CLRequest>"; 
			//PartnerReturnId
			//12340
			//echo $xmlstr."<br>";
			//echo "<br><br>";

		//$url ='http://uat-icicibank.rupeepower.com/connector/RPPersonalLoanConnector.wsdl?wsdl'; Test URL
		$url ='https://www.icicibanksmartloans.com/connector/RPPersonalLoanConnector.wsdl?wsdl';

		  $soapClient = new nusoap_client("https://www.icicibanksmartloans.com/connector/RPPersonalLoanConnector.wsdl?wsdl", true);

		  $info = $soapClient->call("createLead", $xmlstr, "https://www.icicibanksmartloans.com/connector/RPPersonalLoanConnector.wsdl?wsdl" );

		 // print_r($info);
		//Array ( [PartnerReturnId] => 12340 [Status] => 1 [Errorcode] => 0 [Errorinfo] => ) 

		  $status = $info["Status"];
		  $Errorcode = $info["Errorcode"];
		  $Errorinfo = $info["Errorinfo"];
		$webfeedback = "Status :".$status." , Errorcode: ".$Errorcode." , Errorcode: ".$Errorinfo;
		
		   $qrydt= ExecQuery("INSERT INTO webservice_bidder_details (leadid,product,feedback,bidderid,doe, cust_requestid) VALUES('".$FeedbackID."','1','".$webfeedback."','".$BidderID."',NOW(),'".$RequestID."')");
		
			}
		   if($FeedbackID>0)
			{
				echo $updateqry= "Update lead_allocation_table set  total_lead_count=".$FeedbackID." Where (Citywise like '%icici allocated%' and BidderID=4387)";
				$updateqryresult = ExecQuery($updateqry);
			}
}
}

