<?php
require 'scripts/db_init.php';
require 'errorLogReporting.php';
define("PRODUCT_TYPE_ID", "4");
echo $_SERVER['REMOTE_ADDR'];
/*if (!empty($_SERVER['REMOTE_ADDR']))
{
echo "if";
        exit; 

}
else
{
echo "else";*/
	HDFC5737CC();
	HDFC5737CCBlankResponseLeads();
//}

function HDFC5737CC()
{
$today=Date('Y-m-d');
$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-1, date("Y"));
$currentdate=date('Y-m-d',$tomorrow);

	$mindate=$currentdate." 00:00:00";
	$maxdate=$today." 23:59:59";

$query1="Select RequestID from Req_Compaign Where (Reply_Type='4' and Bank_Name='HDFC Bank' and BidderID=5737)";
$result1 = d4l_ExecQuery($query1);

while($row1 = d4l_mysql_fetch_array($result1))
	{
	 $requestid= $row1["RequestID"];
	 }
//$requestid= 1503866;
 
if((strlen(trim($requestid))<=0))
	{	
		$query="SELECT Employment_Status, BidderID, RequestID, Feedback_ID, DOB, Name, Email, Mobile_Number, Net_Salary, Company_Name, Pincode, City, Gender, State, Pancard, Residence_Address, applied_card_name, Allocation_Date FROM Req_Feedback_Bidder_CC,Req_Credit_Card WHERE Req_Feedback_Bidder_CC.AllRequestID= Req_Credit_Card.RequestID and Req_Feedback_Bidder_CC.BidderID=5737 and Req_Feedback_Bidder_CC.Reply_Type=4 and (Req_Feedback_Bidder_CC.Allocation_Date between '".$mindate."' and '".$maxdate."') order by Feedback_ID ASC LIMIT 0,10";
	}
	else
	{
	$query="SELECT Employment_Status,BidderID, RequestID, Feedback_ID, DOB, Name, Email, Mobile_Number, Net_Salary, Company_Name, Pincode, City, Gender, State, Pancard, Residence_Address, applied_card_name, Allocation_Date FROM Req_Feedback_Bidder_CC,Req_Credit_Card WHERE Req_Feedback_Bidder_CC.AllRequestID= Req_Credit_Card.RequestID and Req_Feedback_Bidder_CC.BidderID=5737 and Req_Feedback_Bidder_CC.Reply_Type=4 and  Req_Feedback_Bidder_CC.Feedback_ID>'".$requestid."' and (Req_Feedback_Bidder_CC.Allocation_Date between '".$mindate."' and '".$maxdate."') order by Feedback_ID ASC LIMIT 0,10";
	}

	//$query="select * From Req_Credit_Card Where RequestID=798136";
echo $query."<br>";
//$query="Select * from Req_Credit_Card Where (RequestID=788287)";
$tataplqryresult = d4l_ExecQuery($query);
while($rowcc=d4l_mysql_fetch_array($tataplqryresult))
{
	$Allocation_Date = $rowcc["Allocation_Date"];
	$BidderID = $rowcc["BidderID"];
	$RequestID = $rowcc["RequestID"];
	$Feedback_ID = $rowcc["Feedback_ID"];
	$DOB = $rowcc["DOB"];
	list($year,$mm,$dd) = split('[-]',$DOB);
	$Name = $rowcc["Name"];
	list($firstname,$lastname) = split('[ ]',$Name);
	$Email = $rowcc["Email"];
	$Mobile_Number = $rowcc["Mobile_Number"];
	$Net_Salary = $rowcc["Net_Salary"];
	list($income,$lastp) = split('[ ]',$Net_Salary);
	$monthlyincome=round($income/12);
	$Company_Name = $rowcc["Company_Name"];
	$Pincode = $rowcc["Pincode"];
	$City = $rowcc["City"];
	$Gender = $rowcc["Gender"];
	$State = $rowcc["State"];
	$Pancard = $rowcc["Pancard"];
	$Residence_Address = $rowcc["Residence_Address"];
	list($line1,$line2,$line3) = split('[|]',$Residence_Address);
	$applied_card_name = $rowcc["applied_card_name"];
	$Employment_Status = $rowcc["Employment_Status"];
	if($Employment_Status==0) { $emp_status="Self Employed"; } else { $emp_status="Salaried"; }
	$IP= $_SERVER['HTTP_X_SUCURI_CLIENTIP'];
	if($lastname=="")
	{ $lastname="Kumar";	}
	$strdob=$dd."/".$mm."/".$year;
	$Dated=date('Y/m/d h:i:s A');
$xmlstr='<?xml version="1.0" encoding="utf-8"?>
<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
  <soap:Body>
    <AddDetails xmlns="http://tempuri.org/">
      <First_Name>'.$firstname.'</First_Name>
      <Last_Name>'.$lastname.'</Last_Name>
      <Email>'.$Email.'</Email>
	  <Pan_No>'.$Pancard.'</Pan_No>
      <Res_address>Test Addr 1</Res_address>
      <Res_address2>Test Addr 2</Res_address2>
      <Res_address3>Test Addr 3</Res_address3>
      <Resi_type>Permanent</Resi_type>
      <Mobile>'.$Mobile_Number.'</Mobile>
      <Res_City>'.$City.'</Res_City>
      <Resi_City_other></Resi_City_other>
      <Resi_City_other1></Resi_City_other1>
      <res_pin>'.$Pincode.'</res_pin>
      <Company_name>'.$Company_Name.'</Company_name>
      <DateOfBirth>'.$strdob.'</DateOfBirth>
      <Designation>NA</Designation>
      <Emp_type>'.$emp_status.'</Emp_type>
      <Monthly_income>'.$monthlyincome.'</Monthly_income>
      <card_held>No</card_held>
      <Source_code>D4L</Source_code>
      <Promo_code>D4L</Promo_code>
      <LEAD_DATE_TIME>'.$Dated.'</LEAD_DATE_TIME>
      <PRODUCT_APPLIED_FOR>CC</PRODUCT_APPLIED_FOR>
      <existingcust>No</existingcust>
      <LoanAmt>NA</LoanAmt>
      <YrsinEmp>NA</YrsinEmp>
      <emi_paid>NA</emi_paid>
      <car_make>NA</car_make>
      <car_model>NA</car_model>
      <TypeOfLoan>NA</TypeOfLoan>
      <IP_Address>'.$IP.'</IP_Address>
      <Indigo_UniqueKey>HDFCC2TQ9W1E8W2Q</Indigo_UniqueKey>
      <Indigo_RequestFromYesNo>yes</Indigo_RequestFromYesNo>
    </AddDetails>
  </soap:Body>
</soap:Envelope>';
echo $xmlstr;
//$url = 'https://leads.hdfcbank.com/HDFC_Bank_C2T/HDFC_Bank_C2T.asmx';
$url = 'https://leads.hdfcbank.com/HDFC_Bank_C2T/HDFC_Bank_C2T.asmx?wsdl&AspxAutoDetectCookieSupport=1';

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
//curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_TIMEOUT, 4);
curl_setopt($ch, CURLOPT_POSTFIELDS, $xmlstr);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: text/xml','Content-Type: text/xml'));

$result = curl_exec($ch);
$webfeedback=$result;
 $info = curl_getinfo($ch);
echo "<br><br>";

curl_close($ch);


print_r($webfeedback);
echo "<br><br>";

$myXMLData1 = str_ireplace('<soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema">',"", $webfeedback );
$myXMLData1 = str_ireplace('</soap:Envelope>',"", $myXMLData1 );

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
$errorLogReporting->errorReportInsertion($iWebServiceStatus, $myXMLData, $ClientName, PRODUCT_TYPE_ID, $BidderID=5737, $RequestID, $webServiceID=3, $Allocation_Date);
echo "<br>";	

if($Feedback_ID>0)
	{
$update=d4l_ExecQuery("Update Req_Compaign set RequestID=".$Feedback_ID." Where (Reply_Type='4' and Bank_Name='HDFC Bank' and BidderID=5737)");

$qrydt= d4l_ExecQuery("INSERT INTO webservice_bidder_details (leadid,product,feedback,bidderid,doe, cust_requestid) VALUES('".$Feedback_ID."','4','".$result."','5737',NOW(),'".$RequestID."')");
	}
}
}

function HDFC5737CCBlankResponseLeads()
{
$today=Date('Y-m-d');
$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-1, date("Y"));
$currentdate=date('Y-m-d',$tomorrow);

	$mindate=$currentdate." 00:00:00";
	$maxdate=$today." 23:59:59";


$getmaxCountSql = "select repush_lifespan from web_services where ID=3"; 
	$getmaxCountQuery = d4l_ExecQuery($getmaxCountSql);
	$repush_lifespan = d4l_mysql_result($getmaxCountQuery, 0, 'repush_lifespan');
	$lastHourTS = time() - (60 * $repush_lifespan);
	$lastHour = date('Y-m-d H:i:s', $lastHourTS);
	$sqlRequestID = "select RequestID from web_services_error_log where WSID=3 and feedback in ('WEBSERVICE_STATUS_BLANK', 'WEBSERVICE_STATUS_WEBSERVICE_ISSUE', 'WEBSERVICE_STATUS_FAILED_DATA_ISSUE') and Dated>'".$lastHour."' group by RequestID order by RequestID DESC ";
$queryRequestID = d4l_ExecQuery($sqlRequestID);
$numqueryRequestID = d4l_mysql_num_rows($queryRequestID);
$arrRequestID = '';
while($row1 = d4l_mysql_fetch_array($queryRequestID))
{
	$arrRequestID[] = 	$row1["RequestID"];
}
$strRequestID = implode(',', $arrRequestID);
if(count($arrRequestID)>0)
{ 
	$query="SELECT Employment_Status,BidderID, RequestID, Feedback_ID, DOB, Name, Email, Mobile_Number, Net_Salary, Company_Name, Pincode, City, Gender, State, Pancard, Residence_Address, applied_card_name, Allocation_Date FROM Req_Feedback_Bidder_CC,Req_Credit_Card WHERE Req_Feedback_Bidder_CC.AllRequestID= Req_Credit_Card.RequestID and Req_Feedback_Bidder_CC.BidderID=5737 and Req_Feedback_Bidder_CC.Reply_Type=4 and (Req_Feedback_Bidder_CC.AllRequestID in (".$strRequestID.")) order by Feedback_ID ASC LIMIT 0,10";
	//$query="select * From Req_Credit_Card Where RequestID=798136";
	echo $query."<br>";
	//$query="Select * from Req_Credit_Card Where (RequestID=788287)";
	$tataplqryresult = d4l_ExecQuery($query);
	while($rowcc=d4l_mysql_fetch_array($tataplqryresult))
	{
		$Allocation_Date = $rowcc["Allocation_Date"];
		$BidderID = $rowcc["BidderID"];
		$RequestID = $rowcc["RequestID"];
		$Feedback_ID = $rowcc["Feedback_ID"];
		$DOB = $rowcc["DOB"];
		list($year,$mm,$dd) = split('[-]',$DOB);
		$Name = $rowcc["Name"];
		list($firstname,$lastname) = split('[ ]',$Name);
		$Email = $rowcc["Email"];
		$Mobile_Number = $rowcc["Mobile_Number"];
		$Net_Salary = $rowcc["Net_Salary"];
		list($income,$lastp) = split('[ ]',$Net_Salary);
		$monthlyincome=round($income/12);
		$Company_Name = $rowcc["Company_Name"];
		$Pincode = $rowcc["Pincode"];
		$City = $rowcc["City"];
		$Gender = $rowcc["Gender"];
		$State = $rowcc["State"];
		$Pancard = $rowcc["Pancard"];
		$Residence_Address = $rowcc["Residence_Address"];
		list($line1,$line2,$line3) = split('[|]',$Residence_Address);
		$applied_card_name = $rowcc["applied_card_name"];
		$Employment_Status = $rowcc["Employment_Status"];
		if($Employment_Status==0) { $emp_status="Self Employed"; } else { $emp_status="Salaried"; }
		$IP= $_SERVER['HTTP_X_SUCURI_CLIENTIP'];
		if($lastname=="")
		{ $lastname="Kumar";	}
		$strdob=$dd."/".$mm."/".$year;
		$Dated=date('Y/m/d h:i:s A');
	$xmlstr='<?xml version="1.0" encoding="utf-8"?>
	<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
	  <soap:Body>
		<AddDetails xmlns="http://tempuri.org/">
		  <First_Name>'.$firstname.'</First_Name>
		  <Last_Name>'.$lastname.'</Last_Name>
		  <Email>'.$Email.'</Email>
		  <Pan_No>'.$Pancard.'</Pan_No>
		  <Res_address>Test Addr 1</Res_address>
		  <Res_address2>Test Addr 2</Res_address2>
		  <Res_address3>Test Addr 3</Res_address3>
		  <Resi_type>Permanent</Resi_type>
		  <Mobile>'.$Mobile_Number.'</Mobile>
		  <Res_City>'.$City.'</Res_City>
		  <Resi_City_other></Resi_City_other>
		  <Resi_City_other1></Resi_City_other1>
		  <res_pin>'.$Pincode.'</res_pin>
		  <Company_name>'.$Company_Name.'</Company_name>
		  <DateOfBirth>'.$strdob.'</DateOfBirth>
		  <Designation>NA</Designation>
		  <Emp_type>'.$emp_status.'</Emp_type>
		  <Monthly_income>'.$monthlyincome.'</Monthly_income>
		  <card_held>No</card_held>
		  <Source_code>D4L</Source_code>
		  <Promo_code>D4L</Promo_code>
		  <LEAD_DATE_TIME>'.$Dated.'</LEAD_DATE_TIME>
		  <PRODUCT_APPLIED_FOR>CC</PRODUCT_APPLIED_FOR>
		  <existingcust>No</existingcust>
		  <LoanAmt>NA</LoanAmt>
		  <YrsinEmp>NA</YrsinEmp>
		  <emi_paid>NA</emi_paid>
		  <car_make>NA</car_make>
		  <car_model>NA</car_model>
		  <TypeOfLoan>NA</TypeOfLoan>
		  <IP_Address>'.$IP.'</IP_Address>
		  <Indigo_UniqueKey>HDFCC2TQ9W1E8W2Q</Indigo_UniqueKey>
		  <Indigo_RequestFromYesNo>yes</Indigo_RequestFromYesNo>
		</AddDetails>
	  </soap:Body>
	</soap:Envelope>';
	echo $xmlstr;
//	$url = 'https://leads.hdfcbank.com/HDFC_Bank_C2T/HDFC_Bank_C2T.asmx';
	$url = 'https://leads.hdfcbank.com/HDFC_Bank_C2T/HDFC_Bank_C2T.asmx?wsdl&AspxAutoDetectCookieSupport=1';

	$checkduplicate="Select websrvid from webservice_bidder_details Where (cust_requestid='".$RequestID."' and BidderID =5737) order by websrvid DESC";
$hdfcqryresult = d4l_ExecQuery($checkduplicate);
$rowhdfc=d4l_mysql_fetch_array($hdfcqryresult);
$websrvid = $rowhdfc["websrvid"];
if($websrvid>0)
	{
	}
	else
	{
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	//curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_TIMEOUT, 4);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $xmlstr);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: text/xml','Content-Type: text/xml'));
	
	$result = curl_exec($ch);
	$webfeedback=$result;
	 $info = curl_getinfo($ch);
	echo "<br><br>";
	
	curl_close($ch);
	
	}
	print_r($webfeedback);
	echo "<br><br>";
	
	$myXMLData1 = str_ireplace('<soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema">',"", $webfeedback );
	$myXMLData1 = str_ireplace('</soap:Envelope>',"", $myXMLData1 );
	
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
	$getSql = "select ID,counter_lead from web_services_error_log where WSID=3 and RequestID='".$RequestID."' and feedback='".$iWebServiceStatus."' and Dated>'".$lastHour."' ";
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
	$errorLogReporting->errorReportInsertion($iWebServiceStatus, $myXMLData, $ClientName, PRODUCT_TYPE_ID, $BidderID=5737, $RequestID, $webServiceID=3, $Allocation_Date);
	echo "<br>";	
	
	if($Feedback_ID>0)
		{
	
	$qrydt= d4l_ExecQuery("INSERT INTO webservice_bidder_details (leadid,product,feedback,bidderid,doe, cust_requestid) VALUES('".$Feedback_ID."','4','".$result."','5737',NOW(),'".$RequestID."')");
		}
	}
	}
}

}
?>
