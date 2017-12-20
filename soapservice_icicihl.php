<?php
//error_reporting(E_All);
ini_set('max_execution_time', 800);
require 'scripts/db_init.php';
require 'errorLogReporting.php';
define("PRODUCT_TYPE_ID", "2");

ICICIbank_HL();

function ICICIbank_HL()
{
$today=Date('Y-m-d');
$tomorrow  = mktime(0, 0, 0, date("m")  , date("d"), date("Y"));
$currentdate=date('Y-m-d',$tomorrow);
//$currentdate="2017-02-22";

	$mindate=$currentdate." 00:00:00";
	$maxdate=$today." 23:59:59";

$query1="Select RequestID from Req_Compaign Where (Reply_Type=2 and Bank_Name='ICICI HL' and BidderID=993)";
$result1 = ExecQuery($query1);

while($row1 = mysql_fetch_array($result1))
	{
	 $requestid= $row1["RequestID"];
	 }
	// $requestid=0;
If((strlen(trim($requestid))<=0))
	{	
		$query="SELECT Company_Name,Net_Salary, BidderID,Name,Email,Mobile_Number,City,City_Other,RequestID,Feedback_ID,Loan_Amount,DOB, Allocation_Date FROM Req_Feedback_Bidder_HL,Req_Loan_Home WHERE Req_Feedback_Bidder_HL.AllRequestID= Req_Loan_Home.RequestID and Req_Feedback_Bidder_HL.BidderID=993 and Req_Feedback_Bidder_HL.Reply_Type=2 and (Req_Feedback_Bidder_HL.Allocation_Date between '".$mindate."' and '".$maxdate."') order by Feedback_ID ASC LIMIT 0,10";
	}
	else
	{
	$query="SELECT Pancard,Company_Name,Net_Salary,BidderID,Name,Email,Mobile_Number,City,City_Other,RequestID,Feedback_ID,Loan_Amount,DOB, Allocation_Date FROM Req_Feedback_Bidder_HL,Req_Loan_Home WHERE Req_Feedback_Bidder_HL.AllRequestID= Req_Loan_Home.RequestID and Req_Feedback_Bidder_HL.BidderID=993  and Req_Feedback_Bidder_HL.Reply_Type=2 and Req_Feedback_Bidder_HL.Feedback_ID>'".$requestid."' and (Req_Feedback_Bidder_HL.Allocation_Date between '".$mindate."' and '".$maxdate."') order by Feedback_ID ASC LIMIT 0,10";
	}
echo $query."<br>";

$tataplqryresult = ExecQuery($query);
while($row=mysql_fetch_array($tataplqryresult))
{
	//$AllRequestID= $row["AllRequestID"];
	$BidderID = $row["BidderID"];
	$RequestID = $row["RequestID"];
	$Feedback_ID = $row["Feedback_ID"];
	$Name = $row["Name"];
	$fullnamearr = explode(' ', $Name,2);
	$First=current ($fullnamearr);
	next($fullnamearr);
	$Last=end ($fullnamearr);
	$Email = trim($row["Email"]);
	$Company_Name = trim($row["Company_Name"]);
	$Employment_Status = trim($row["Employment_Status"]);
	
	$Allocation_Date = $row["Allocation_Date"];
	$Mobile_Number = $row["Mobile_Number"];
	$City = $row["City"];
	$City_Other = $row["City_Other"];
	$Loan_Amount = $row["Loan_Amount"];
	$loanamtarr = explode('.', $Loan_Amount);
	$loanamt=current ($loanamtarr);
	next($loanamtarr);
	$Net_Salary = $row["Net_Salary"];
	$Pincode = $row["Pincode"];
	$salaryarr = explode('.', $Net_Salary);
	$netincome=current ($salaryarr);
	next($salaryarr);
	$monthlyincome= $netincome/12;
	$DOB = $row["DOB"];
	$dobarr = explode('-', $DOB);
	$day=current ($dobarr);
	next($dobarr);
	$month=current ($dobarr);
	$year=end ($dobarr);
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
		$last= "Kumar";
	}
if($Employment_Status==0)
	{
		$Occupation_l=2;
	}
	else
	{
		$Occupation_l=3;
	}
// soapAction="http://www.crmnext.com/api/ICRMnextApi/Save"
	$xmlstr='<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:api="http://www.crmnext.com/api/">
   <soapenv:Header/>
        <soapenv:Body>
            <api:Save>
                <api:userContext>
                  <api:IsSuccess>true</api:IsSuccess>
                  <api:Message></api:Message>
                  <api:ClientTimeOffSet>0</api:ClientTimeOffSet>
                  <api:ExpiresOn>2028-10-05T02:40:03.2418339+05:30</api:ExpiresOn>
                  <api:IsUTC>false</api:IsUTC>
                  <api:LongDateFormat></api:LongDateFormat>
                  <api:LongDateTimeFormat></api:LongDateTimeFormat>
                  <api:Token>qjg8clqv8mjs5njd6l2s676fk353tnxbf52bdnleacda766ust396ejm7ah5abamvscj8lgbzykygk86vdsv9nw7eq9kcvslx4g4aj7zvn386re5vzgvfjdbupljz2uvjdku8xxvemrrry3cp428evenznv5e33jvvahcvdamzl24grufqkfwj54baw7zskd744l5nrpmwy72eyfku4lz3q9nglxwsjtmnrzvx5z8gx8sm2vw9skwlpbtrnjjjetqq7ul9kmbvm6jra7lz72khu7j9k3yneqcyu562bc8kedzun46bnre9alzbaw3ytqnggwzp8r6mxzrd4wmezex45h6fx2w6bwsggmhpzhnqatlsha47jpsuzaffz67f8bz9smh2en5hdjgc3rrqmeu3nxwfx4f7sc8tksv9mx7n2zln24w6y8pyxx87z6lb85xhvl4lkvagjjw4sp5zs8tea59ws5sft6vtptaug6xyryl7w9ptpshw9y2mplhekkkanb738tzqzyscys4u4xxnw7qq2sv87ackcg5k4rq7llzl6m4aecr6ezl9w3q2s72rf9n95nx6ldaagfgafpastkmnlgntxyyhu5zlycfffnwgd9g94q</api:Token>
                </api:userContext>
                <api:objects>
                     <api:CRMnextObject xsi:type="api:Lead" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
				<api:CampaignKey>195816</api:CampaignKey>
                    <!--Custom Fields-->
                    <api:Custom>
                      <api:Business_Line_l>7</api:Business_Line_l>
                      <api:Address_1_l>'.$strcity.'</api:Address_1_l>
                      <api:Address_2_l>Add2</api:Address_2_l>
                      <api:C_Pincode_l>'.$Pincode.'</api:C_Pincode_l>
                      <api:Channel_l>48</api:Channel_l>
                      <api:Loan_Amount_l>'.$loanamt.'</api:Loan_Amount_l>
						<api:Tenure_in_Months_l>10</api:Tenure_in_Months_l>  
						 <api:Type_l>1</api:Type_l>
						<api:Occupation_l>'.$Occupation_l.'</api:Occupation_l>
                      <api:Source_of_Lead_l>7</api:Source_of_Lead_l>
                      <api:Remarks_Aggregate_l>CS Test</api:Remarks_Aggregate_l>
                    </api:Custom>
                  <api:FirstName>'.$First.'</api:FirstName>
                    <api:LastName>'.$last.'</api:LastName>
                    <api:LayoutKey>102166</api:LayoutKey>
                    <api:MobilePhone>'.$Mobile_Number.'</api:MobilePhone>
                    <api:OwnerCode>1</api:OwnerCode>
                    <api:PreferredChannelKey>1</api:PreferredChannelKey>
                    <api:ProductCategoryID>1036</api:ProductCategoryID>
                    <api:ProductKey>1060</api:ProductKey>
                    <api:RatingKey>1</api:RatingKey>
					<api:SalutationKey>2</api:SalutationKey>
                    <api:StatusCodeKey>141</api:StatusCodeKey>
                    <api:LeadWarmth>Warm</api:LeadWarmth>                   
                  </api:CRMnextObject>
                </api:objects>
               <api:returnObjectOnSave>true</api:returnObjectOnSave>
            </api:Save>
        </soapenv:Body>
      </soapenv:Envelope>';
echo $xmlstr;

$headers = array(   "Content-type: text/xml;charset=\"utf-8\"",
                        "Accept: text/xml",
                        "SOAPAction:http://www.crmnext.com/api/ICRMnextApi/Save", 
                       ); 
//$url="https://salescrm.icicibank.com/CRMnextWebApi/CRMnextService.svc?wsdl";
$url="https://salescrm.icicibank.com/CRMnextwebApi/CRMnextService.svc?singleWsdl";
//$url="https://scrm.icicibank.com/CRMnextWebApi/CRMnextService.svc?wsdl";// for 24th feb only
$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "$xmlstr");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$output = curl_exec($ch);
		curl_close($ch); 
		echo "<br><br><pre>";
//print_r($output);
	if(strlen(strpos($output, "<IsSuccess>true</IsSuccess>")) > 0)
		{
			$iWebServiceStatus = WEBSERVICE_STATUS_SUCCESS;
		}
	elseif(strlen(strpos($output, "<IsSuccess>false</IsSuccess>")) > 0)
		{
			$iWebServiceStatus = WEBSERVICE_STATUS_FAILED_DATA_ISSUE;
		}
	else
		{
			$iWebServiceStatus = WEBSERVICE_STATUS_BLANK;
		}
$errorLogReporting = new errorLogReporting();
echo "<br><br>iWebServiceStatus - ".$iWebServiceStatus.",output- ".$output.",ID  - ".PRODUCT_TYPE_ID.",RequestID- ".$RequestID,",webServiceID- ". $webServiceID.",Date - ".$Allocation_Date."<br><br>";
$errorLogReporting->errorReportInsertion($iWebServiceStatus, $output, $ClientName='', PRODUCT_TYPE_ID, $BidderID=993, $RequestID, $webServiceID=10, $Allocation_Date);

$qrydt= ExecQuery("INSERT INTO webservice_bidder_details (leadid,product,request_xml,feedback,bidderid,doe, cust_requestid) VALUES('".$Feedback_ID."','2','".$xmlstr."','".$output."','".$BidderID."',NOW(),'".$RequestID."')");
if($Feedback_ID>0)
	{
 $update =ExecQuery("Update Req_Compaign set RequestID='".$Feedback_ID."' where (Reply_Type=2 and Bank_Name='ICICI HL' and BidderID=993)");
//echo "Update Req_Compaign set RequestID='".$Feedback_ID."' where (Reply_Type=1 and Bank_Name='PNB HFL' and BidderID=3603)";
	}

}
}
?>
