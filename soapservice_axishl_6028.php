<?php
require 'scripts/db_init.php';
require 'errorLogReporting.php';
define("PRODUCT_TYPE_ID", "2");

/*if (!empty($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR']!='192.124.249.12' && $_SERVER['REMOTE_ADDR']!='185.93.228.12')
{
        exit; 
}
else
{
	AXISBNK_HL();
}*/
AXISBNK_HL();
function AXISBNK_HL()
{
$today=Date('Y-m-d');
//$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-1, date("Y"));
//$currentdate=date('Y-m-d',$tomorrow);
$currentdate=Date('Y-m-d');
	$mindate=$currentdate." 00:00:00";
	$maxdate=$today." 23:59:59";

$query1="Select RequestID from Req_Compaign Where (Reply_Type='2' and Bank_Name='Axis Bank' and BidderID=6028)";
$result1 = ExecQuery($query1);

while($row1 = mysql_fetch_array($result1))
	{
	 $requestid= $row1["RequestID"];
	 }
//$requestid="433598";
If((strlen(trim($requestid))<=0))
	{	
		$query="SELECT
BidderID,Name,Email,Mobile_Number,City,City_Other,RequestID,Feedback_ID,Allocation_Date FROM Req_Feedback_Bidder_HL,Req_Loan_Home WHERE Req_Feedback_Bidder_HL.AllRequestID= Req_Loan_Home.RequestID and Req_Feedback_Bidder_HL.BidderID in (6007,6008,6009,6011,6013,6016,6017,6018,6022,6024,6027) and Req_Feedback_Bidder_HL.Reply_Type=2 and (Req_Feedback_Bidder_HL.Allocation_Date between '".$mindate."' and '".$maxdate."') order by Feedback_ID ASC";
	}
	else
	{
	$query="SELECT BidderID,Name,Email,Mobile_Number,City,City_Other,RequestID,Feedback_ID,Allocation_Date FROM Req_Feedback_Bidder_HL,Req_Loan_Home WHERE Req_Feedback_Bidder_HL.AllRequestID= Req_Loan_Home.RequestID and Req_Feedback_Bidder_HL.BidderID in (6007,6008,6009,6011,6013,6016,6017,6018,6022,6024,6027) and Req_Feedback_Bidder_HL.Feedback_ID>'".$requestid."' and (Req_Feedback_Bidder_HL.Allocation_Date between '".$mindate."' and '".$maxdate."') order by Feedback_ID ASC ";
	}
echo $query."<br>";

$tataplqryresult = ExecQuery($query);
while($row=mysql_fetch_array($tataplqryresult))
{
	$BidderID = $row["BidderID"];
$RequestID = $row["RequestID"];
$Feedback_ID = $row["Feedback_ID"];
$Name = $row["Name"];
$Email = $row["Email"];
$Mobile_Number = $row["Mobile_Number"];
$City = $row["City"];
$City_Other = $row["City_Other"];
$Allocation_Date = $row["Allocation_Date"];

if($City=="Others" && Strlen($City_Other)>0)
{
	$strcity=$City_Other;
}
else
{
	$strcity=$City;
}

$strstate = GetCityStatecCode($strcity);
if(strlen($strstate)>0)
	{
		$state = $strstate;
	}
	else
	{
		$state = "";
	}

if($last=="")
	{
		$last= $first;
		$first="Unknown";
	}

$xmlstr='<?xml version="1.0" encoding="utf-8"?>
<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
  <soap:Body>
    <InsertAxisConnectWeb xmlns="http://tempuri.org/">
      <name>'.$Name.'</name>
      <emailid>'.$Email.'</emailid>
      <phoneno>'.$Mobile_Number.'</phoneno>
      <state>'.$state.'</state>
      <city>'.$strcity.'</city>
      <nearestBranch>'.$strcity.'</nearestBranch>
      <utm_source>deal4loans</utm_source>
      <utm_medium></utm_medium>
      <utm_campaign></utm_campaign>
      <utm_content></utm_content>
      <utm_term></utm_term>
      <utm_product>home loan</utm_product>
      <platform>website</platform>
      <dummy1></dummy1>
      <dummy2></dummy2>
      <dummy3></dummy3>
    </InsertAxisConnectWeb>
  </soap:Body>
</soap:Envelope>';
echo $xmlstr."<br><br>";
// CURL method
$url ="https://115.112.84.87/AxisConnectWSProd/AxisBankWebService.asmx?wsdl";
// cURL's initialization
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_FAILONERROR, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $xmlstr);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: text/xml','Content-Type: text/xml'));
$result = curl_exec($ch);
/*if ($result === FALSE) {
  echo "cURL Error: " . curl_error($ch);
} else {
	var_dump($result);
}*/
echo $webfeedback=$result;
curl_close($ch);

$xml_string = '<?xml version="1.0" encoding="utf-8"?><soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema"><soap:Body><InsertAxisConnectWebResponse xmlns="http://tempuri.org/"><InsertAxisConnectWebResult>Success</InsertAxisConnectWebResult></InsertAxisConnectWebResponse></soap:Body></soap:Envelope>';
$xml_string = str_ireplace('<?xml version="1.0" encoding="utf-8"?><soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema"><soap:Body><InsertAxisConnectWebResponse xmlns="http://tempuri.org/">',"", $xml_string );
$xml_string = str_ireplace('</InsertAxisConnectWebResponse></soap:Body></soap:Envelope>',"", $xml_string );
$webfeedbackxml = simplexml_load_string($xml_string);
echo $webfeedbackxml;
echo "<br><br>";
if ($webfeedbackxml == "success")
{
	$iWebServiceStatus = WEBSERVICE_STATUS_SUCCESS;
}
else if ($webfeedbackxml == "failure")
{
	$iWebServiceStatus = WEBSERVICE_STATUS_FAILED_DATA_ISSUE;
}
else
{
	$iWebServiceStatus = WEBSERVICE_STATUS_BLANK;
}

$errorLogReporting = new errorLogReporting();
$errorLogReporting->errorReportInsertion($iWebServiceStatus, $webfeedbackxml, $ClientName, PRODUCT_TYPE_ID, $BidderID, $RequestID, $webServiceID=8, $Allocation_Date);
echo "<br>";	

if($Feedback_ID>0)
	{
$update =ExecQuery("Update Req_Compaign set RequestID='".$Feedback_ID."' where (Reply_Type='2' and Bank_Name='Axis Bank' and BidderID=6028)");
	}

$qrydt= ExecQuery("INSERT INTO webservice_bidder_details (leadid,product,feedback,bidderid,doe, cust_requestid) VALUES('".$Feedback_ID."','2','".$webfeedback."','".$BidderID."',NOW(),'".$RequestID."')");
}
}

function GetCityStatecCode($pKey){
    $titles = array(
	'Noida' => 'Uttar Pradesh',
	'Gaziabad' => 'Uttar Pradesh',
	'Faridabad' => 'Haryana',
	'Ahmedabad' => 'Gujarat',
	'Navi Mumbai' => 'Maharashtra',
	'Delhi' => 'Delhi',
	'Gurgaon' => 'Haryana',
	'Mumbai' => 'Maharashtra',
	'Chennai' => 'Tamil Nadu',
	'Indore' => 'Madhya Pradesh',
	'Nasik' => 'Maharashtra',
	'Pune' => 'Maharashtra',
	'Hyderabad' => 'Telangana',
	'Lucknow' => 'Uttar Pradesh',
	'Bangalore' => 'Karnataka',
	'Jaipur' => 'Rajasthan',
	'Kolkata' => 'West Bengal',
	'Patna' => 'Bihar',
	'Vadodara' => 'Gujarat',
	'Surat' => 'Gujarat',
	'Thane' => 'Maharashtra',
	'Chembur' => 'Maharashtra',
	'Kalyan' => 'Maharashtra',
	'Navi Panvel' => 'Maharashtra'
);
    foreach ($titles as $key=>$value)
        if($pKey==$key)
        return $value;
    return "";
  }

?>
