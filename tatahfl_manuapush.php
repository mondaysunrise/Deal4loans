<?php
error_reporting(E_ALL);
require 'scripts/db_init.php';

tatacapitalHL();
//HOME LOan Product
function tatacapitalHL()
{
	echo "dd";
	$query="SELECT Add_Comment,BidderID,Name,Email,Mobile_Number,Pincode,Company_Name,City,City_Other,RequestID,Feedback_ID,Loan_Amount,DOB FROM Req_Feedback_Bidder_HL,Req_Loan_Home WHERE Req_Feedback_Bidder_HL.AllRequestID= Req_Loan_Home.RequestID and Req_Feedback_Bidder_HL.BidderID  in (5498,5499) and Req_Feedback_Bidder_HL.Feedback_ID in (456029) order by Feedback_ID ASC";

$tataplqryresult = ExecQuery($query);
while($row=mysql_fetch_array($tataplqryresult))
{
		$BidderID = $row["BidderID"];
		$RequestID = $row["RequestID"];
		$Feedback_ID = $row["Feedback_ID"];
		$Name = $row["Name"];
		list($first,$last) = split('[ ]',$Name);
		$Email = $row["Email"];
		$Mobile_Number = $row["Mobile_Number"];
		$Pincode = $row["Pincode"];
		$Company_Name = $row["Company_Name"];
		$strCompany_Name = substr(trim($Company_Name),0,50);
		$City = $row["City"];
		$City_Other = $row["City_Other"];
		$Loan_Amount = $row["Loan_Amount"];
		$Add_Comment = $row["Add_Comment"];
		$DOB = $row["DOB"];
		list($year,$month,$day) = split('[-]',$DOB);
		$strdob = $day."/".$month."/".$year;

		if($City=="Others" && Strlen($City_Other)>0)
		{
			$strcity=$City_Other;
		}
		else
		{
			$strcity=$City;
		}
	
	if($strcity=="Bangalore")
	{
		$strcity="Bengaluru";
	}

		if($last=="")
			{
				$last= $first;
				$first="Unknown";
			}	//Delhi,Mumbai,Bangalore
		$xmlstr="<?xml version='1.0' encoding='utf-8'?>
		<soap:Envelope xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance' xmlns:xsd='http://www.w3.org/2001/XMLSchema' xmlns:soap='http://schemas.xmlsoap.org/soap/envelope/'>
		  <soap:Body>
			<CreateLeadAndOpportunity  xmlns='http://tempuri.org/'>
			  <strFirstName>".$last."</strFirstName>
			   <strMiddleName></strMiddleName>
			  <strLastName>".$last."</strLastName>
			   <strTitle>NA</strTitle>
			  <strEmail>".$Email."</strEmail>
			  <strGender>Male</strGender>
			  <strDOB>".$strdob."</strDOB>
			  <strMobileNo>".$Mobile_Number."</strMobileNo>
			  <strHomePhone>NA</strHomePhone>
			  <strAddLine1>NA</strAddLine1>
			  <strAddLine2>NA</strAddLine2>
			  <strCity>".$strcity."</strCity>
			  <strPincode>".$Pincode."</strPincode>
			  <strState>".$strcity."</strState>
			  <strCompanyName>".$strCompany_Name."</strCompanyName>
			  <strDesignation>NA</strDesignation>
			  <strWorkEmail>NA</strWorkEmail>
			  <strWorkPhone>NA</strWorkPhone>
			  <strLeadDetails>".$Add_Comment."</strLeadDetails>
			  <strSalesOrg>NSO</strSalesOrg>
			  <strLob>NSO</strLob>
			  <strProduct>Home Loan</strProduct>
			  <strChannel>Deal4Loans</strChannel>
			  <strLeadType>Individual</strLeadType>
			  <strLeadTag>WarmLead</strLeadTag>
			  <strBranch>NA</strBranch>
			  <strPan>NA</strPan>
			  <strRequestedLaonAmount>".$Loan_Amount."</strRequestedLaonAmount>
			  <strLoanAmount>".$Loan_Amount."</strLoanAmount>
			  <strTenure>NA</strTenure>
			  <strMotherMaidenName>NA</strMotherMaidenName>
			  <strMaritalStatus>NA</strMaritalStatus>
			</CreateLeadAndOpportunity >
		  </soap:Body>
		</soap:Envelope>"; 

		echo $xmlstr."<br>";
		//echo "<br><br>";
		$url = 'https://apps2.tatacapital.com/WebServiceIntegration/SageWebServices.asmx';
		// cURL's initialization
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_VERBOSE, 1); 
		curl_setopt($ch, CURLOPT_TIMEOUT, 4);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $xmlstr);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: text/xml','Content-Type: text/xml'));
		$result = curl_exec($ch);
		curl_close($ch);
		echo $webfeedback=$result;
		$expires = preg_split('/Lead id/', $webfeedback);
		array_shift($expires);
		$strcheck=implode(" ",$expires);
		$check=explode(" ",$strcheck);
		 $Leadid=$check[0];
	
 $qrydt= ExecQuery("INSERT INTO webservice_bidder_details (leadid,product,feedback,bidderid,doe, cust_requestid, cust_city) VALUES('".$Feedback_ID."','2','".$webfeedback."','".$BidderID."',NOW(),'".$RequestID."','".$strcity."')");

if($RequestID>0 && strlen($Leadid)>0)
	{
//$update =ExecQuery("Update Req_Compaign set RequestID='".$Feedback_ID."' where (Reply_Type='2' and Bank_Name='Tata Capital' and BidderID=5500)");

	}

}
}
?>