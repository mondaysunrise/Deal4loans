<?php
require 'scripts/db_init.php';
require 'errorLogReporting.php';
define("PRODUCT_TYPE_ID", "10");
hdfcbankTWL();
//hdfcbankTWLBlankResponseLeads();

function hdfcbankTWL()
{
$today=Date('Y-m-d');
$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-1, date("Y"));
$currentdate=date('Y-m-d',$tomorrow);

	$mindate=$currentdate." 00:00:00";
	$maxdate=$today." 23:59:59";

$query1="Select RequestID from Req_Compaign Where (Reply_Type='10' and Bank_Name='HDFC Bank' and BidderID=5572)";
$result1 = d4l_ExecQuery($query1);

while($row1 = d4l_mysql_fetch_array($result1))
	{
	 $requestid= $row1["RequestID"];
	 }
//$requestid="2677625";
if((strlen(trim($requestid))<=0))
	{	
		$query="SELECT
Net_Salary,BidderID,Name,Email,Mobile_Number,Pincode,Company_Name,City,City_Other,RequestID,Feedback_ID,Loan_Amount,DOB, Allocation_Date FROM Req_Feedback_Bidder1,Req_Loan_Bike WHERE Req_Feedback_Bidder1.AllRequestID= Req_Loan_Bike.RequestID and Req_Feedback_Bidder1.BidderID=5572 and Req_Feedback_Bidder1.Reply_Type=10 and (Req_Feedback_Bidder1.Allocation_Date between '".$mindate."' and '".$maxdate."') order by Feedback_ID ASC LIMIT 0,1";
	}
	else
	{
	$query="SELECT Net_Salary,BidderID,Name,Email,Mobile_Number,Pincode,Company_Name,City,City_Other,RequestID,Feedback_ID,Loan_Amount, DOB, Allocation_Date FROM Req_Feedback_Bidder1,Req_Loan_Bike WHERE Req_Feedback_Bidder1.AllRequestID= Req_Loan_Bike.RequestID and Req_Feedback_Bidder1.BidderID=5572 and Req_Feedback_Bidder1.Feedback_ID>'".$requestid."' and (Req_Feedback_Bidder1.Allocation_Date between '".$mindate."' and '".$maxdate."') order by Feedback_ID ASC ";
	}
echo $query."<br>";

$tataplqryresult = d4l_ExecQuery($query);
while($row=d4l_mysql_fetch_array($tataplqryresult))
{
	$Allocation_Date = $row["Allocation_Date"];
	$BidderID = $row["BidderID"];
$RequestID = $row["RequestID"];
$Feedback_ID = $row["Feedback_ID"];
$Name = trim($row["Name"]);
list($first,$last) = split('[ ]',$Name);
$Email = trim($row["Email"]);
$Mobile_Number = trim($row["Mobile_Number"]);
$Pincode = trim($row["Pincode"]);
$Company_Name = trim($row["Company_Name"]);
$strCompany_Name = substr(trim($Company_Name),0,50);
$City = trim($row["City"]);
$City_Other = trim($row["City_Other"]);
$Loan_Amount = round($row["Loan_Amount"]);
$Net_Salary = round($row["Net_Salary"]);
$monthlyincome= $Net_Salary/12;
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

if($last=="")
	{
		$last= $first;
		$first="Unknown";
	}


$Res_address = "Resi address";
$residence_status="Owned";
$curr_date = date("Y/m/d h:i:s A");			

$xmlstr='<?xml version="1.0" encoding="utf-8"?>
<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
  <soap:Body>
    <AddDetails xmlns="http://tempuri.org/">
      <First_Name>'.$first.'</First_Name>
      <Last_Name>'.$last.'</Last_Name>
      <Email>'.$Email.'</Email>
      <Pan_No>AAAPA1111A</Pan_No>
      <Res_address>'.$Res_address.'</Res_address>
      <Res_address2>'.$strcity.'</Res_address2>
      <Res_address3>string</Res_address3>
      <Resi_type>string</Resi_type>
      <Mobile>'.$Mobile_Number.'</Mobile>
      <Res_City>'.$strcity.'</Res_City>
      <Resi_City_other>string</Resi_City_other>
      <Resi_City_other1>string</Resi_City_other1>
      <res_pin>string</res_pin>
      <Company_name>'.$Company_Name.'</Company_name>
      <DateOfBirth>'.$strdob.'</DateOfBirth>
      <Designation>NA</Designation>
      <Emp_type>Salaried</Emp_type>
      <Monthly_income>'.$monthlyincome.'</Monthly_income>
      <card_held>string</card_held>
      <Source_code>D4L</Source_code>
      <Promo_code>string</Promo_code>
      <LEAD_DATE_TIME>'.$curr_date.'</LEAD_DATE_TIME>
      <PRODUCT_APPLIED_FOR>TWL</PRODUCT_APPLIED_FOR>
      <existingcust>string</existingcust>
      <LoanAmt>'.$Loan_Amount.'</LoanAmt>
      <YrsinEmp>string</YrsinEmp>
      <emi_paid>string</emi_paid>
      <car_make>string</car_make>
      <car_model>string</car_model>
      <TypeOfLoan>TWL</TypeOfLoan>
      <IP_Address>string</IP_Address>
      <Indigo_UniqueKey>HDFCC2TQ9W1E8W2Q</Indigo_UniqueKey>
      <Indigo_RequestFromYesNo>yes</Indigo_RequestFromYesNo>
    </AddDetails>
  </soap:Body>
</soap:Envelope>'; 
echo $xmlstr."<br><br>";

////////////////////////////////////////////////
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => "https://leads.hdfcbank.com/HDFC_Bank_C2T/HDFC_Bank_C2T.asmx?AspxAutoDetectCookieSupport=1",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS =>$xmlstr,
  CURLOPT_HTTPHEADER => array(
    "cache-control: no-cache",
    "content-type: text/xml",
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  $finalresponse= "cURL Error #:" . $err;
} else {
  $finalresponse= $response;
}
///////////////////////////////////////////////
print_r($webfeedback);
echo "<br><br>";

$myXMLData1 = str_ireplace('<soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema"><soap:Body>',"", $finalresponse );
$myXMLData1 = str_ireplace('</soap:Body></soap:Envelope>',"", $myXMLData1 );

$xmlToStr = @simplexml_load_string($myXMLData1);
$xmlToStrValue = $xmlToStr->AddDetailsResponse->AddDetailsResult;
$myXMLData = $xmlToStrValue[0];

if ($myXMLData == "success")
{
	$iWebServiceStatus = WEBSERVICE_STATUS_SUCCESS;
}
else if ($myXMLData == "failure")
{
	$iWebServiceStatus = WEBSERVICE_STATUS_FAILED_DATA_ISSUE;
}
else
{
	$iWebServiceStatus = WEBSERVICE_STATUS_BLANK;
}

$errorLogReporting = new errorLogReporting();
$errorLogReporting->errorReportInsertion($iWebServiceStatus, $myXMLData, $ClientName, PRODUCT_TYPE_ID, $BidderID=5572, $RequestID, $webServiceID=2, $Allocation_Date);
echo "<br>";	

if($Feedback_ID>0)
	{
$update =d4l_ExecQuery("Update Req_Compaign set RequestID='".$Feedback_ID."' where (Reply_Type='10' and Bank_Name='HDFC Bank' and BidderID=5572)");
	}

echo $qrydt= d4l_ExecQuery("INSERT INTO webservice_bidder_details (leadid,product,feedback,bidderid,doe, cust_requestid, request_xml, final_feedback) VALUES('".$Feedback_ID."','10','".$myXMLData."','".$BidderID."',NOW(),'".$RequestID."', '".$xmlstr."' , '".$finalresponse."')");
}
}

function hdfcbankTWLBlankResponseLeads()
{
$today=Date('Y-m-d');
$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-1, date("Y"));
$currentdate=date('Y-m-d',$tomorrow);

	$mindate=$currentdate." 00:00:00";
	$maxdate=$today." 23:59:59";

$getmaxCountSql = "select repush_lifespan from web_services where ID=2"; 
	$getmaxCountQuery = d4l_ExecQuery($getmaxCountSql);
	$repush_lifespan = d4l_mysql_result($getmaxCountQuery, 0, 'repush_lifespan');
	$lastHourTS = time() - (60 * $repush_lifespan);
	$lastHour = date('Y-m-d H:i:s', $lastHourTS);
	$sqlRequestID = "select RequestID from web_services_error_log where WSID=2 and feedback in ('WEBSERVICE_STATUS_BLANK', 'WEBSERVICE_STATUS_WEBSERVICE_ISSUE', 'WEBSERVICE_STATUS_FAILED_DATA_ISSUE') and Dated>'".$lastHour."' group by RequestID order by RequestID DESC ";
$queryRequestID = d4l_ExecQuery($sqlRequestID);
$numqueryRequestID = d4l_mysql_num_rows($queryRequestID);
$arrRequestID = '';
while($row1 = d4l_mysql_fetch_array($queryRequestID))
{
	$arrRequestID[] = 	$row1["RequestID"];
}
$strRequestID = implode(',', $arrRequestID);
//$strRequestID = 73669;
if(count($arrRequestID)>0)
{	
	$query="SELECT Net_Salary, BidderID, Name, Email, Mobile_Number, Pincode, Company_Name, City, City_Other, RequestID, Feedback_ID, Loan_Amount,DOB, Allocation_Date FROM Req_Feedback_Bidder1,Req_Loan_Bike WHERE Req_Feedback_Bidder1.AllRequestID= Req_Loan_Bike.RequestID and Req_Feedback_Bidder1.BidderID=5572 and Req_Feedback_Bidder1.Reply_Type=10 and (Req_Feedback_Bidder1.AllRequestID in (".$strRequestID.")) order by Feedback_ID ASC";

	echo $query."<br>";
	
	$tataplqryresult = d4l_ExecQuery($query);
	while($row=d4l_mysql_fetch_array($tataplqryresult))
	{
		
		$Allocation_Date = $row["Allocation_Date"];
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
	$Net_Salary = $row["Net_Salary"];
	$monthlyincome= $Net_Salary/12;
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
	
	if($last=="")
		{
			$last= $first;
			$first="Unknown";
		}
	
	
	$Res_address = "Resi address";
	$residence_status="Owned";
	$curr_date = date("Y/m/d h:i:s A");			
	
	$xmlstr='<?xml version="1.0" encoding="utf-8"?>
	<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
	  <soap:Body>
		<AddDetails xmlns="http://tempuri.org/">
		  <First_Name>'.$first.'</First_Name>
		  <Last_Name>'.$last.'</Last_Name>
		  <Email>'.$Email.'</Email>
		  <Pan_No>AAAPA1111A</Pan_No>
		  <Res_address>'.$Res_address.'</Res_address>
		  <Res_address2>'.$strcity.'</Res_address2>
		  <Res_address3>string</Res_address3>
		  <Resi_type>string</Resi_type>
		  <Mobile>'.$Mobile_Number.'</Mobile>
		  <Res_City>'.$strcity.'</Res_City>
		  <Resi_City_other>string</Resi_City_other>
		  <Resi_City_other1>string</Resi_City_other1>
		  <res_pin>string</res_pin>
		  <Company_name>'.$Company_Name.'</Company_name>
		  <DateOfBirth>'.$strdob.'</DateOfBirth>
		  <Designation>NA</Designation>
		  <Emp_type>Salaried</Emp_type>
		  <Monthly_income>'.$monthlyincome.'</Monthly_income>
		  <card_held>string</card_held>
		  <Source_code>D4L</Source_code>
		  <Promo_code>string</Promo_code>
		  <LEAD_DATE_TIME>'.$curr_date.'</LEAD_DATE_TIME>
		  <PRODUCT_APPLIED_FOR>TWL</PRODUCT_APPLIED_FOR>
		  <existingcust>string</existingcust>
		  <LoanAmt>'.$Loan_Amount.'</LoanAmt>
		  <YrsinEmp>string</YrsinEmp>
		  <emi_paid>string</emi_paid>
		  <car_make>string</car_make>
		  <car_model>string</car_model>
		  <TypeOfLoan>TWL</TypeOfLoan>
		  <IP_Address>string</IP_Address>
		  <Indigo_UniqueKey>HDFCC2TQ9W1E8W2Q</Indigo_UniqueKey>
		  <Indigo_RequestFromYesNo>yes</Indigo_RequestFromYesNo>
		</AddDetails>
	  </soap:Body>
	</soap:Envelope>'; 
	echo $xmlstr."<br><br>";
	
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => "https://leads.hdfcbank.com/HDFC_Bank_C2T/HDFC_Bank_C2T.asmx?AspxAutoDetectCookieSupport=1",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS =>$xmlstr,
  CURLOPT_HTTPHEADER => array(
    "cache-control: no-cache",
    "content-type: text/xml",
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  $finalresponse= "cURL Error #:" . $err;
} else {
  $finalresponse= $response;
}
	$webfeedback=$finalresponse;
	echo "<br><br>";
	
	$myXMLData1 = str_ireplace('<soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema"><soap:Body>',"", $finalresponse );
$myXMLData1 = str_ireplace('</soap:Body></soap:Envelope>',"", $myXMLData1 );
	
	$xmlToStr = @simplexml_load_string($myXMLData1);
	$xmlToStrValue = $xmlToStr->AddDetailsResponse->AddDetailsResult;
	$myXMLData = $xmlToStrValue[0];
	
	if ($myXMLData == "success")
	{
		$iWebServiceStatus = WEBSERVICE_STATUS_SUCCESS;
	}
	else if ($myXMLData == "failure")
	{
		$iWebServiceStatus = WEBSERVICE_STATUS_FAILED_DATA_ISSUE;
	}
	else
	{
		$iWebServiceStatus = WEBSERVICE_STATUS_BLANK;
	}
	
	$errorLogReporting = new errorLogReporting();
	
	$getSql = "select ID,counter_lead from web_services_error_log where WSID=2 and RequestID='".$RequestID."' and feedback='".$iWebServiceStatus."' and Dated>'".$lastHour."' ";
	$getQuery = d4l_ExecQuery($getSql);
	$numGetCheck = d4l_mysql_num_rows($getQuery);
	if($numGetCheck>0)
	{
		//update
		$ID = d4l_mysql_result($getQuery,0,'ID');
		$counter_lead = d4l_mysql_result($getQuery,0,'counter_lead');
		$countlead = $counter_lead + 1 ;
		$updateSql = "update web_services_error_log set counter_lead='".$countlead."' where ID='".$ID."' ";
		d4l_ExecQuery($updateSql);
	}
	else
	{
		$errorLogReporting->errorReportInsertion($iWebServiceStatus, $myXMLData, $ClientName, PRODUCT_TYPE_ID, $BidderID=5572, $RequestID, $webServiceID=2, $Allocation_Date);
		echo "<br>";	
		$qrydt= d4l_ExecQuery("INSERT INTO webservice_bidder_details (leadid,product,feedback,bidderid,doe, cust_requestid, request_xml, final_feedback) VALUES('".$Feedback_ID."','10','".$myXMLData."','".$BidderID."',NOW(),'".$RequestID."', '".$xmlstr."' , '".$finalresponse."')");

	}
	
	}
}
}
?>