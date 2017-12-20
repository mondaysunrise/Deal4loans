<?php
require 'scripts/db_init.php';
require 'errorLogReporting.php';
require_once ("lib/nusoap.php");

/*if (!empty($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR']!='192.124.249.12' && $_SERVER['REMOTE_ADDR']!='185.93.228.12')
{
        exit; 
}
else
{
	PNBHFL_HL();
}
*/

echo "hello";

PNBHFL_HL();

function PNBHFL_HL()
{
$today=Date('Y-m-d');
$tomorrow  = mktime(0, 0, 0, date("m")  , date("d"), date("Y"));
$currentdate=date('Y-m-d',$tomorrow);

	$mindate=$currentdate." 00:00:00";
	$maxdate=$today." 23:59:59";

$query1="Select RequestID from Req_Compaign Where (Reply_Type=1 and Bank_Name='PNB HFL' and BidderID=3603)";
$result1 = ExecQuery($query1);

while($row1 = mysql_fetch_array($result1))
	{
	 $requestid= $row1["RequestID"];
	 }
If((strlen(trim($requestid))<=0))
	{	
		$query="SELECT
Net_Salary,BidderID,Name,Email,Mobile_Number,City,City_Other,RequestID,Feedback_ID,Loan_Amount,DOB FROM Req_Feedback_Bidder_HL,Req_Loan_Home WHERE Req_Feedback_Bidder_HL.AllRequestID= Req_Loan_Home.RequestID and Req_Feedback_Bidder_HL.BidderID=3603 and Req_Feedback_Bidder_HL.Reply_Type=2 and (Req_Feedback_Bidder_HL.Allocation_Date between '".$mindate."' and '".$maxdate."') order by Feedback_ID ASC";
	}
	else
	{
	$query="SELECT Net_Salary,BidderID,Name,Email,Mobile_Number,City,City_Other,RequestID,Feedback_ID,Loan_Amount,DOB FROM Req_Feedback_Bidder_HL,Req_Loan_Home WHERE Req_Feedback_Bidder_HL.AllRequestID= Req_Loan_Home.RequestID and Req_Feedback_Bidder_HL.BidderID=3603  and Req_Feedback_Bidder_HL.Reply_Type=2 and Req_Feedback_Bidder_HL.Feedback_ID>'".$requestid."' and (Req_Feedback_Bidder_HL.Allocation_Date between '".$mindate."' and '".$maxdate."') order by Feedback_ID ASC";
	}
//echo $query."<br>";

$tataplqryresult = ExecQuery($query);
while($row=mysql_fetch_array($tataplqryresult))
{
	$AllRequestID= $row["AllRequestID"];
	$BidderID = $row["BidderID"];
$RequestID = $row["RequestID"];
$Feedback_ID = $row["Feedback_ID"];
$Name = $row["Name"];
list($first,$last) = split('[ ]',$Name);
$Email = $row["Email"];
$Allocation_Date = $row["Allocation_Date"];
$Mobile_Number = $row["Mobile_Number"];
$City = $row["City"];
$City_Other = $row["City_Other"];
$Loan_Amount = $row["Loan_Amount"];
$Net_Salary = $row["Net_Salary"];
list($salary,$slast) = split('[.]',$Net_Salary);
$monthlyincome= $salary/12;
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
$citycode = getCityCode($strcity);

if($citycode>0)
	{
		$fcitycode = $citycode;
	}
	else
	{
		$fcitycode = "9999";
	}
if($last=="")
	{
		$last= $first;
		$first="Unknown";
	}

/*$xmlstr="<CLRequest>            
	<Authentication>               
	   <UserId>Deal4Loans</UserId>
	   <Password>4prdwQ!xM</Password>
	</Authentication>
	<CreateLead>               
	   <Version>1</Version>
	   <PartnerUnqId>".$Feedback_ID."</PartnerUnqId>
	   <ProductType>9</ProductType>
	   <FirstName>".$first."</FirstName>
	   <MiddleName></MiddleName>
	   <LastName>".$last."</LastName>
	    <ResCity>".$fcitycode."</ResCity>
	   <Email>".$Email."</Email>
	   <Mobile>".$Mobile_Number."</Mobile>
	   <GMI>".$monthlyincome."</GMI>
	   <LoanAmt>".$Loan_Amount."</LoanAmt>
	</CreateLead>
 </CLRequest>"; 

//echo $xmlstr;
// Keeping reporting on for error tracking
// HDFC's domain
$url ='http://instantloan.pnbhousing.com/connector/RPHomeLoanConnector.wsdl?wsdl';
  $soapClient = new nusoap_client("http://instantloan.pnbhousing.com/connector/RPHomeLoanConnector.wsdl?wsdl", true);

  $info = $soapClient->call("createLead", $xmlstr, "http://instantloan.pnbhousing.com/connector/RPHomeLoanConnector.wsdl?wsdl" );
  */
$propertyCity= getpropertyCityCode(strtoupper($strcity));
  $xmlstr='<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ser="http://services.lending.kastle.infotech.com/">
   <soapenv:Header/>
   <soapenv:Body>
      <ser:createShortForm>
         <arg0>         
            <authentication>            
               <interfaceId>INTF61</interfaceId>            
               <partnerUnqId>5</partnerUnqId>            
               <password>pnbhfllems</password>            
               <userId>pnbhfllems</userId>
               <version>1</version>
            </authentication>         
            <homeLoan>            
               <email>'.$Email.'</email>            
               <fullName>'.$Name.'</fullName>            
               <loanAmount>'.$Loan_Amount.'</loanAmount>            
               <mobile>'.$Mobile_Number.'</mobile>            
               <propertyCity>'.$propertyCity.'</propertyCity>
            </homeLoan>
         </arg0>
      </ser:createShortForm>
   </soapenv:Body>
</soapenv:Envelope>';
//echo $xmlstr."<br><br>";


//$url = 'http://180.179.47.222:7002/services/KastleLEMSServices?wsdl';
//$url="http://customerservice.pnbhousing.com:9061/services/KastleLEMSServices?wsdl";
$url="https://customerservice.pnbhousing.com:9061/services/KastleLEMSServices?wsdl"; // 2nd may2017
		$ch = curl_init($url);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/xml'));
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $xmlstr);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$xml_string = curl_exec($ch);
curl_close($ch); 

$expires = preg_split('/errorInfo/', $xml_string);
array_shift($expires);
$strcheck=implode(" ",$expires);
$check=explode(" ",$strcheck);

$xml_string =  str_replace(">", "", str_replace("</", "", $check[0]));

$qrydt= ExecQuery("INSERT INTO webservice_bidder_details (leadid,product,feedback,bidderid,doe, cust_requestid) VALUES('".$Feedback_ID."','2','".$xml_string."','".$BidderID."',NOW(),'".$RequestID."')");

if ($xml_string == "Success")
{
	$iWebServiceStatus = WEBSERVICE_STATUS_SUCCESS;
}
else if ($xml_string == "FAIL")
{
	$iWebServiceStatus = WEBSERVICE_STATUS_FAILED_DATA_ISSUE;
}
else
{
	$iWebServiceStatus = WEBSERVICE_STATUS_FAILED;
}

$errorLogReporting = new errorLogReporting();
$errorLogReporting->errorReportInsertion($iWebServiceStatus, $xml_string, $ClientName, $product=2, $BidderID=3603, $AllRequestID, $webServiceID=9, $Allocation_Date);
echo "<br>";	

if($Feedback_ID>0)
	{
$update =ExecQuery("Update Req_Compaign set RequestID='".$Feedback_ID."' where (Reply_Type=1 and Bank_Name='PNB HFL' and BidderID=3603)");
//echo "Update Req_Compaign set RequestID='".$Feedback_ID."' where (Reply_Type=1 and Bank_Name='PNB HFL' and BidderID=3603)";
	}

 
}
}

//Array ( [PartnerReturnId] => 12340 [Status] => 0 [Errorcode] => 6 [Errorinfo] => Duplicate lead ) 
function getCityCode($pKey){
    $titles = array(
	'Ahmedabad' => '22',
	'Baroda' => '707',
	'Bangalore' => '19',
	'Chandigarh' => '9',
	'Chennai' => '21',
	'Cochin' => '241',
	'Coimbatore' => '69',
	'Gaziabad' => '87',
	'Greater Noida' => '704',
	'Gurgaon' => '7',
	'Hyderabad' => '15',
	'Indore' => '106',
	'Jaipur' => '100',
	'Kolkata' => '64',
	'Mumbai' => '25',
	'Nagpur' => '135',
	'Navi Mumbai' => '163',
	'Delhi' => '318',
	'Noida' => '78',
	'Pune' => '26',
	'Secunderabad' => '94',
	'Surat' => '190',
	'Thane' => '640',
	'Dehradun' => '1062',
	'Lucknow' => '807',
	'Bikaner' => '1063',
	'Karnal' => '1064',
	'Raipur' => '1056',
	'Other' => '9999',
	'Faridabad' => '981',
	'Agra' => '1102',
	'Bhiwadi' => '1111',
	'Nagpur' => '135',
	'Trivandrum' => '1096',
	'Jodhpur' => '1078',
	'Meerut' => '1086',
	'Jalandhar' => '1075',
	'Varanasi' => '1120',
	'Ludhiana' => '1055',
	'Bhopal' => '623' );
    foreach ($titles as $key=>$value)
        if($pKey==$key)
        return $value;
    return "";
  }

 function getpropertyCityCode($pKey){
    $titles = array(
	'AGRA' => 'AGR',
	'AHMEDABAD' => 'AHM',
	'HYDERABAD' => 'HYD ',
	'SECUNDERABAD' => 'HYD ',
	'BHIWADI' => 'BHI',
	'BHOPAL' => 'BHO',
	'BIKANER' => 'BIK',
	'CHANDIGARH' => 'CHD',
	'CHENNAI' => 'CHE',
	'COCHIN' => 'COC',
	'COIMBATORE' => 'COI',
	'DEHRADUN' => 'DEH',
	'DELHI' => 'DEL',
	'FARIDABAD' => 'FBD',
	'GAZIABAD' => 'GHA',
	'GREENPARK' => 'GRP',
	'GURGAON' => 'GUR',
	'INDORE' => 'IND',
	'JAIPUR' => 'JPR',
	'JALANDHAR' => 'JAL',
	'BANGALORE' => 'BAN ',
	'JODHPUR' => 'JDH',
	'KARNAL' => 'KAR',
	'KOLKATA' => 'KOL',
	'LUCKNOW' => 'LUC',
	'LUDHIANA' => 'LUD',
	'MEERUT' => 'MEE',
	'MUMBAI' => 'MUM',
	'NAGPUR' => 'NAG',
	'NASIK' => 'NSK',
	'NAVI MUMBAI' => 'NAV',
	'NOIDA' => 'NOI',
	'GREATER NOIDA' => 'NOI',
	'PIMPRI CHINCHWAD' => 'PM',
	'PUNE' => 'PUN',
	'RAIPUR' => 'RAI',
	'SURAT' => 'SRT',
	'THANE' => 'THA',
	'TRIVANDRUM' => 'TRI',
	'Thrissur' => 'TCR',
	'VADODARA' => 'VA',
	'BARODA' => 'VA',
	'VARANASI' => 'VAR',
	'VIJAYAWADA' => 'VJWD',
	'VIRAR' => 'VRR',
	'VISAKHAPATNAM' => 'VSKP',
	'KALYAN' => 'THA',
	'KANPUR' => 'LUC',
	'KOTTAYAM' => 'COC',
	'PATIALA' => 'CHD',
	'MYSORE' => 'BAN',
	'ERODE' => 'COI',
	'BHUVNESHWAR' => 'KOL',
	'TUMKUR' => 'BAN',
	'MANGALORE' => 'BAN',
	'SALEM' => 'COI',
	'PONDICHERRY' => 'CHE',
	'ROHTAK' => 'KAR');
    foreach ($titles as $key=>$value)
        if($pKey==$key)
        return $value;
    return "";
  }
?>