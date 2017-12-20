<?php
error_reporting(E_ALL);
require 'scripts/db_init.php';


function tatacapitalpl()
{
$today=Date('Y-m-d');
$mindate=$today." 00:00:00";
	$maxdate=$today." 23:59:59";

echo $query1="Select leadid from webservice_bidder_details Where (bidderid in (5247,5250,5235,5236,5237,5243,5241,5242,5240,5245,5239,5319,5320,5321,5422) and feedback='' and cust_requestid in ('1693799'))";
$result1 = ExecQuery($query1);

while($row1 = mysql_fetch_array($result1))
	{
	 $requestid= $row1["leadid"];

If((strlen(trim($requestid))>0))
	{	
	$query="SELECT
BidderID,Name,Email,Mobile_Number,Pincode,Company_Name,City,City_Other,RequestID,Feedback_ID FROM Req_Feedback_Bidder_PL,Req_Loan_Personal WHERE Req_Feedback_Bidder_PL.AllRequestID= Req_Loan_Personal.RequestID and Req_Feedback_Bidder_PL.BidderID in (5247,5250,5235,5236,5237,5243,5241,5242,5240,5245,5239,5319,5320,5321,5422) and (Req_Feedback_Bidder_PL.Feedback_ID='".$requestid."') order by Feedback_ID ASC";
	
echo $query."<br>";

$tataplqryresult = ExecQuery($query);
$row=mysql_fetch_array($tataplqryresult);
$BidderID = $row["BidderID"];
$RequestID = $row["RequestID"];
$Feedback_ID = $row["Feedback_ID"];
$Name = $row["Name"];
list($first,$last) = split('[ ]',$Name);
$Email = $row["Email"];
$Mobile_Number = $row["Mobile_Number"];
$Pincode = $row["Pincode"];
$Company_Name = $row["Company_Name"];
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
	
$xmlstr="<?xml version='1.0' encoding='utf-8'?>
<soap:Envelope xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance' xmlns:xsd='http://www.w3.org/2001/XMLSchema' xmlns:soap='http://schemas.xmlsoap.org/soap/envelope/'>
  <soap:Body>
    <createWebLeadInSage xmlns='http://tempuri.org/'>
      <strFirstName>".$first."</strFirstName>
      <strLastName>".$last."</strLastName>
      <strEmail>".$Email."</strEmail>
      <strGender>Male</strGender>
      <strMobileNo>".$Mobile_Number."</strMobileNo>
      <strHomePhone>NA</strHomePhone>
      <strAddLine1>NA</strAddLine1>
      <strAddLine2>NA</strAddLine2>
      <strCity>".$strcity."</strCity>
      <strPincode>".$Pincode."</strPincode>
      <strState>".$strcity."</strState>
      <strCompanyName>RENAULT NISSAN TECHNOLOGY</strCompanyName>
      <strDesignation>NA</strDesignation>
      <strWorkEmail>NA</strWorkEmail>
      <strWorkPhone>NA</strWorkPhone>
      <strLeadDetails>string</strLeadDetails>
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
curl_setopt($ch, CURLINFO_HEADER_OUT, true);
 $result = curl_exec($ch);
print_r($result);
echo "<br><br>";

echo $info = curl_getinfo($ch);
print_r($info);
echo "<br><br>";
if(curl_exec($ch) === false)
{
    echo 'Curl error: ' . curl_error($ch);
}
else
{
    echo 'Operation completed without any errors';
}

echo "<br><br>";
curl_close($ch);
echo $webfeedback=$result;
$expires = preg_split('/Lead id/', $webfeedback);
array_shift($expires);
$strcheck=implode(" ",$expires);
$check=explode(" ",$strcheck);
$Leadid=$check[0];

echo "<br><br>";
if($Feedback_ID>0)
	{
echo $qrydt= ExecQuery("Update webservice_bidder_details set feedback='".$webfeedback."' Where leadid=".$Feedback_ID);
	}
}
}
}

tatacapitalpl();
?>