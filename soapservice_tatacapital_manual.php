<?php
error_reporting(E_ALL);
require 'scripts/db_init.php';


function tatacapitalpl()
{
$today=Date('Y-m-d');
$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-1, date("Y"));
$currentdate=date('Y-m-d',$tomorrow);
$mindate=$currentdate." 00:00:00";
$maxdate=$today." 23:59:59";

//echo $query1="Select * from webservice_bidder_details Where (bidderid in (5498,5499) and feedback ='1' and doe between '2015-10-14 00:00:00' and '2015-10-14 23:59:59')";
//$result1 = ExecQuery($query1);

//while($row1 = mysql_fetch_array($result1))
	//{
	// $requestid= $row1["leadid"];

//If((strlen(trim($requestid))>0))
//	{	
//	$query="SELECT BidderID,Name,Email,Mobile_Number,Pincode,Company_Name,City,City_Other,RequestID,Feedback_ID FROM Req_Feedback_Bidder_PL,Req_Loan_Personal WHERE Req_Feedback_Bidder_PL.AllRequestID= Req_Loan_Personal.RequestID and Req_Feedback_Bidder_PL.BidderID in (5235,5237,5242,5243,5245,5247,5241,5250,5236,5240,5239,5319,5320,5321,5422) and (Req_Feedback_Bidder_PL.Feedback_ID in ('686728')) order by Feedback_ID ASC";

$query="SELECT Name,Email,Mobile_Number,Pincode,Company_Name,City,City_Other,RequestID FROM Req_Loan_Personal WHERE Req_Loan_Personal.RequestID=2099255";

echo $query."<br>";

$tataplqryresult = ExecQuery($query);
while($row=mysql_fetch_array($tataplqryresult))
	{
$BidderID = $row["BidderID"];
$RequestID = $row["RequestID"];
$Feedback_ID = $row["Feedback_ID"];
echo $Name = trim($row["Name"]);
$namearr = explode(" ",$Name);
echo $namearr[0]."-".$namearr[1];
echo "<br><br>";
$Email = $row["Email"];
if(strlen($Email)>2)
		{
			$strEmail=$Email;
		}
		else
		{
			$strEmail="na@na.com";
		}
$Mobile_Number = $row["Mobile_Number"];
$Pincode = $row["Pincode"];
$Company_Name = $row["Company_Name"];
$strCompany_Name = substr(trim($Company_Name),0,50);
$City = $row["City"];
$City_Other = $row["City_Other"];
if($City=="Others" && Strlen($City_Other)>0)
{
	$strcity=$City_Other;
}
else
{
	$strcity=$City;
}

if($last=="")
	{
		$last= $first;
		$first="Unknown";
	}

/*$xmlstr="<?xml version='1.0' encoding='utf-8'?>
<soap:Envelope xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance' xmlns:xsd='http://www.w3.org/2001/XMLSchema' xmlns:soap='http://schemas.xmlsoap.org/soap/envelope/'>
  <soap:Body>
    <createWebLeadInSage xmlns='http://tempuri.org/'>
      <strFirstName>".$namearr[0]."</strFirstName>
      <strLastName>".$namearr[1]."</strLastName>
      <strEmail>".$strEmail."</strEmail>
      <strGender>Male</strGender>
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
      <strProduct>Personal Loans</strProduct>
      <strChannel>Deal4Loans</strChannel>
      <strLeadType>Individual</strLeadType>
      <strLeadTag>WarmLead</strLeadTag>
    </createWebLeadInSage>
  </soap:Body>
</soap:Envelope>"; */
$xmlstr="<?xml version='1.0' encoding='utf-8'?>
<soap:Envelope xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance' xmlns:xsd='http://www.w3.org/2001/XMLSchema' xmlns:soap='http://schemas.xmlsoap.org/soap/envelope/'>
  <soap:Body>
    <createWebLeadInSage xmlns='http://tempuri.org/'>
      <strFirstName>DINESH</strFirstName>
      <strLastName>KUMAR</strLastName>
      <strEmail>".$strEmail."</strEmail>
      <strGender>Male</strGender>
      <strMobileNo>9176075276</strMobileNo>
      <strHomePhone>NA</strHomePhone>
      <strAddLine1>NA</strAddLine1>
      <strAddLine2>NA</strAddLine2>
      <strCity>Chennai</strCity>
      <strPincode>".$Pincode."</strPincode>
      <strState>Chennai</strState>
      <strCompanyName>FIS GLOBAL PVT LTD</strCompanyName>
      <strDesignation>NA</strDesignation>
      <strWorkEmail>NA</strWorkEmail>
      <strWorkPhone>NA</strWorkPhone>
      <strLeadDetails>".$Add_Comment."</strLeadDetails>
      <strSalesOrg>NSO</strSalesOrg>
      <strLob>NSO</strLob>
      <strProduct>Personal Loans</strProduct>
      <strChannel>Deal4Loans</strChannel>
      <strLeadType>Individual</strLeadType>
      <strLeadTag>WarmLead</strLeadTag>
    </createWebLeadInSage>
  </soap:Body>
</soap:Envelope>";
echo $xmlstr."<br>";
echo "<br><br>";
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
 $webfeedback=$result;
$expires = preg_split('/Lead id/', $webfeedback);
array_shift($expires);
$strcheck=implode(" ",$expires);
$check=explode(" ",$strcheck);
echo $Leadid=$check[0];

//}
echo "<br><br>";

echo $qrydt= ExecQuery("INSERT INTO webservice_bidder_details (leadid,product,feedback,bidderid,doe, cust_requestid, cust_city) VALUES('".$Feedback_ID."','1','".$webfeedback."','".$BidderID."',NOW(),'".$RequestID."','".$strcity."')");
//}
	}
}


//tatacapitalpl();


$xmlstr="<?xml version='1.0' encoding='utf-8'?>
<soap:Envelope xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance' xmlns:xsd='http://www.w3.org/2001/XMLSchema' xmlns:soap='http://schemas.xmlsoap.org/soap/envelope/'>
  <soap:Body>
    <createWebLeadInSage xmlns='http://tempuri.org/'>
      <strFirstName>DINESH</strFirstName>
      <strLastName>KUMAR</strLastName>
      <strEmail>na</strEmail>
      <strGender>Male</strGender>
      <strMobileNo>9176075276</strMobileNo>
      <strHomePhone>NA</strHomePhone>
      <strAddLine1>NA</strAddLine1>
      <strAddLine2>NA</strAddLine2>
      <strCity>Chennai</strCity>
      <strPincode>600040</strPincode>
      <strState>Chennai</strState>
      <strCompanyName>FIS GLOBAL PVT LTD</strCompanyName>
      <strDesignation>NA</strDesignation>
      <strWorkEmail>NA</strWorkEmail>
      <strWorkPhone>NA</strWorkPhone>
      <strLeadDetails>".$Add_Comment."</strLeadDetails>
      <strSalesOrg>NSO</strSalesOrg>
      <strLob>NSO</strLob>
      <strProduct>Personal Loans</strProduct>
      <strChannel>Deal4Loans</strChannel>
      <strLeadType>Individual</strLeadType>
      <strLeadTag>WarmLead</strLeadTag>
    </createWebLeadInSage>
  </soap:Body>
</soap:Envelope>";
echo $xmlstr."<br>";
echo "<br><br>";
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
 $webfeedback=$result;
$expires = preg_split('/Lead id/', $webfeedback);
array_shift($expires);
$strcheck=implode(" ",$expires);
$check=explode(" ",$strcheck);
echo $Leadid=$check[0];

//}
echo "<br><br>";

echo $qrydt= ExecQuery("INSERT INTO webservice_bidder_details (leadid,product,feedback,bidderid,doe, cust_requestid, cust_city) VALUES('".$Feedback_ID."','1','".$webfeedback."','".$BidderID."',NOW(),'".$RequestID."','".$strcity."')");



?>