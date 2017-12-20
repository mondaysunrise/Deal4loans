<?php
error_reporting(E_All);
@set_time_limit(1000);
require 'scripts/db_init.php';
require 'errorLogReporting.php';
define("PRODUCT_TYPE_ID", "2");

ICICIbank_HL();
//ICICIlogin_HL();

function ICICIlogin_HL()
{
	$xmlstr='<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:api="http://www.crmnext.com/api/">
<soapenv:Header/>
   <soapenv:Body>
		<api:Login>
         <api:login>ICICI_HOMELOAN</api:login>
         <api:password>abc123</api:password>
      </api:Login>
   </soapenv:Body>
</soapenv:Envelope>';

$headers = array(   "Content-type: text/xml;charset=\"utf-8\"",
                        "Accept: text/xml",
                        "SOAPAction:http://www.crmnext.com/api/ICRMnextApi/Login", 
                       ); 
//$url="https://salescrm.icicibank.com/CRMnextWebApi/CRMnextService.svc?wsdl";
$url="https://salescrm.icicibank.com/CRMnextWebApi/CRMnextService.svc?wsdl";// for 24th feb only
$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	//curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/xml'));
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "$xmlstr");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$output = curl_exec($ch);
		curl_close($ch); 
		//echo "<br><br><pre>";
		print_r($output);

		//echo $output;
$xmlArray = str_ireplace('<s:Envelope xmlns:s="http://schemas.xmlsoap.org/soap/envelope/"><s:Body>','',$output);
	$xmlArray = str_ireplace('</s:Body></s:Envelope>','',$xmlArray);
//print_r($xmlArray);
//echo "<br><br>";
$xmlArray = simplexml_load_string($xmlArray);
//print_r($xmlArray);
$json = json_encode($xmlArray);
$responseArray = json_decode($json,true);
echo $responseArray['LoginResult']['UserContext']['Token'];

}

//<s:Envelope xmlns:s="http://schemas.xmlsoap.org/soap/envelope/"><s:Body><SaveResponse xmlns="http://www.crmnext.com/api/"><SaveResult xmlns:i="http://www.w3.org/2001/XMLSchema-instance"><SaveResult><IsSuccess>false</IsSuccess><Message>Client Session has expired!! Please login again.</Message><ApiObject i:nil="true"/><objectKey><ItemKey/></objectKey></SaveResult></SaveResult></SaveResponse></s:Body></s:Envelope>

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
//$query="SELECT Pancard,Company_Name,Net_Salary,bidderid,Name,Email,Mobile_Number,City,City_Other,RequestID,leadid,Loan_Amount,DOB, doe FROM webservice_bidder_details,Req_Loan_Home WHERE webservice_bidder_details.cust_requestid= Req_Loan_Home.RequestID and webservice_bidder_details.bidderid=993  and webservice_bidder_details.product=2 and feedback ='' and (webservice_bidder_details.doe between '2017-05-06 00:00:00' and '2017-05-07 23:59:59') order by websrvid ASC LIMIT 0,10";


$query="SELECT Company_Name,Net_Salary, BidderID,Name,Email,Mobile_Number,City,City_Other,RequestID,Feedback_ID,Loan_Amount,DOB, Allocation_Date FROM Req_Feedback_Bidder_HL,Req_Loan_Home WHERE Req_Feedback_Bidder_HL.AllRequestID= Req_Loan_Home.RequestID and ((`Allocation_Date` between '2017-05-06 00:00:00' and '2017-05-09 23:59:59') and `BidderID`=993 and Feedback_ID not in (SELECT `leadid` FROM `webservice_bidder_details` WHERE (`bidderid`=993 and `doe` between '2017-05-06 00:00:00' and '2017-05-17 23:59:59'))) LIMIT 0,10";


//$query="SELECT * FROM `Req_Feedback_Bidder_HL` WHERE ((`Allocation_Date` between '2017-05-06 00:00:00' and '2017-05-09 23:59:59') and `BidderID`=993 and Feedback_ID not in (SELECT `leadid` FROM `webservice_bidder_details` WHERE (`bidderid`=993 and `doe` between '2017-05-06 00:00:00' and '2017-05-09 23:59:59'))) limit 0,10";


//$query="SELECT Company_Name,Net_Salary, BidderID,Name,Email,Mobile_Number,City,City_Other,RequestID,Feedback_ID,Loan_Amount,DOB, Allocation_Date FROM Req_Feedback_Bidder_HL,Req_Loan_Home WHERE Req_Feedback_Bidder_HL.AllRequestID= Req_Loan_Home.RequestID and Req_Feedback_Bidder_HL.BidderID=993 and Req_Feedback_Bidder_HL.Reply_Type=2 and Feedback_ID >726181 and (Req_Feedback_Bidder_HL.Allocation_Date between '2017-05-06 00:00:00' and '2017-05-06 23:59:59')";
//Invalid Mandatory field LeadOwnerID
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
	
	$Allocation_Date = $row["doe"];
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
	echo "<br><br>";
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
//echo $xmlstr;
echo "<br><br>";
$headers = array(   "Content-type: text/xml;charset=\"utf-8\"",
                        "Accept: text/xml",
                        "SOAPAction:http://www.crmnext.com/api/ICRMnextApi/Save", 
                       ); 
$url="https://salescrm.icicibank.com/CRMnextWebApi/CRMnextService.svc?wsdl";
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
	
/*$errorLogReporting = new errorLogReporting();
echo "<br><br>iWebServiceStatus - ".$iWebServiceStatus.",output- ".$output.",ID  - ".PRODUCT_TYPE_ID.",RequestID- ".$RequestID,",webServiceID- ". $webServiceID.",Date - ".$Allocation_Date."<br><br>";
$errorLogReporting->errorReportInsertion($iWebServiceStatus, $output, $ClientName='', PRODUCT_TYPE_ID, $BidderID=993, $RequestID, $webServiceID=10, $Allocation_Date);
*/


if($Feedback_ID>0)
	{
 //$update =ExecQuery("Update webservice_bidder_details set request_xml='".$xmlstr."',feedback='".$output."' where (leadid='".$Feedback_ID."' and bidderid='".$BidderID."' and cust_requestid='".$RequestID."')");
$qrydt= ExecQuery("INSERT INTO webservice_bidder_details (leadid,product,request_xml,feedback,bidderid,doe, cust_requestid) VALUES('".$Feedback_ID."','2','".$xmlstr."','".$output."','".$BidderID."',NOW(),'".$RequestID."')");

echo "INSERT INTO webservice_bidder_details (leadid,product,request_xml,feedback,bidderid,doe, cust_requestid) VALUES('".$Feedback_ID."','2','".$xmlstr."','".$output."','".$BidderID."',NOW(),'".$RequestID."')";

echo "<br><br>";


 echo "Update webservice_bidder_details set request_xml='".$xmlstr."',feedback='".$output."' where (leadid='".$Feedback_ID."' and bidderid='".$BidderID."' and cust_requestid='".$RequestID."')";
//echo "Update Req_Compaign set RequestID='".$Feedback_ID."' where (Reply_Type=1 and Bank_Name='PNB HFL' and BidderID=3603)";
	}

}
}//721431,721435,721436,721439,721443,721448,721449,721453,721461,721464,721465,721467,721470,721471,721474,721477,721482,721489,721496,721498,721503,721506,721508,721511,721516,721522,721526,721529,721531,721537,721539,721548,721557,721561,721569,721579,721581,721585,721588,721596,721600,721607,721623,721628,721630,721632,721636,721638,721640,721642,721646,721648,721650,721653,721657,721665,721667,721671,721676,721681,721690,721696,721699,721703,721710,721712,721715,721722,721729,721734,721737,721739,721744,721747,721751,721754,721756,721758,721760,721762,721766,721767,721775,721782,721785,721797,721803,721806,721808,721810,721816,721823,721830,721837,721843,721845,721849,721850,721861,721867,721870,721873,721875,721879,721881,721886,721896,721899,721901,721907,721909,721913,721916,721919,721930,721938,721939,721943,721946,721952,721959,721965,721968,721969,721972,721975,721978,721985,721986,721989,721994,721996,722004,722007,722008,722010,722012,722014,722017,722022,722024,722026,722031,722039,722042,722045,722048,722051,722053,722058,722060,722063,722068,722074,722080,722082,722087,722090,722092,722094,722096,722099,722100,722102,722105,722107,722113,722120,722125,722129,722133,722139,722142,722150,722154,722156,722160,722162,722165,722169,722172,722174,722177,722181,722184,722187,722190,722193,722197,722199,722205,722212,722218,722219,722229,722230,722232,722235,722238,722241,722246,722248,722250,722252,722258,722263,722269,722273,722278,722280,722282,722286,722295,722299,722301,722303,722307,722309,722313,722316,722318,722320,722330,722334,722341,722344,722347,722352,722360,722362,722364,722373,722381,722383,722390,722393,722396,722400,722404,722409,722414,722416,722423,722425,722429,722433,722436,722441,722447,722450,722454,722458,722459,722463,722465,722468,722471,722474,722478,722479,722482,722486,722490,722494,722495,722498,722499,722502,722505,722508,722510,722512,722516,722519,722525,722526,722530,722534,722540,722543,722546,722548,722552,722557,722559,722562,722566,722569,722570,722573,722575,722582,722585,722589,722596,722599,722603,722610,722615,722622,722626,722630,722640,722643,722647,722652,722655,722663,722669,722672,722675,722679,722683,722687,722699,722705,722713,722716,722719,722727,722730,722733,722741,722749,722752,722755,722767,722768,722773,722776,722780,722783,722788,722792,722799,722805,722807,722815,722818,722821,722825,722829,722831,722836,722838,722844,722850,722853,722856,722864,722866,722871,722876,722878,722880,722885,722893,722896,722899,722902,722910,722911,722915,722918,722925,722926,722935,722941,722951,722955,722957,722965,722969,722970,722975,722978,722981,722984,722987,722990,722995,723000,723013,723022,723027,723029,723033,723037,723039,723041,723046,723050,723053,723054,723056,723058,723063,723064,723067,723076,723083,723086,723089,723093,723096,723097,723102,723105,723114,723118,723121,723123,723125,723129,723132,723135,723138,723140,723141,723145,723147,723151,723153,723160,723162,723164,723169,723171,723175,723181,723186,723191,723194,723197,723202,723205,723210,723212,723216,723221,723224,723227,723230,723233,723235,723236,723242,723243,723248,723251,723256,723258,723264,723267,723270,723274,723277,723280,723281,723284,723288,723289,723293,723295,723298,723302,723306,723308,723311,723312,723320,723322,723325,723327,723330,723337,723340,723342,723348,723352,723355,723361,723364,723367,723377,723380,723382,723384,723386,723392,723393,723396,723400,723401,723403,723404,723409,723415,723421,723427,723431,723433,723436,723438,723440,723443,723447,723451,723461,723464,723467,723472,723474,723478,723484,723485,723490,723497,723504,723505,723512,723516,723518,723522,723528,723530,723532,723535,723538,723542,723548,723550,723553,723555,723557,723561,723563,723567,723572,723577,723580,723584,723588,723593,723601,723607,723610,723614,723619,723624,723633,723637,723642,723647,723649,723651,723656,723659,723666,723668,723671,723674,723678,723682,723684,723689,723698,723701,723704,723708,723712,723719,723724,723734,723738,723741,723744,723747,723752,723756,723762,723765,723766,723769,723775,723782,723786,723791,723794,723799,723803,723806,723813,723821,723833,723838,723840,723843,723846,723847,723850,723853,723855,723862,723868,723870,723874,723878,723881,723883,723885,723895,723898,723900,723915,723916,723922,723924,723926,723930,723941,723949,723951,723953,723959,723964,723966,723970,723974,723980,723984,723988,723997,724003,724006,724007,724009,724013,724015,724018,724023,724027,724029,724032,724038,724042,724043,724045,724048,724055,724058,724059,724064,724065,724068,724072,724077,724082,724091,724094,724097,724107,724110,724112,724113,724117,724122,724126,724130,724133,724139,724141,724143,724147,724151,724152,724154,724157,724159,724162,724170,724173,724175,724179,724183,724184,724189,724197,724206,724211,724214,724215,724224,724226,724229,724231,724233,724236,724239,724241,724243,724250,724253,724255,724258,724261,724264,724273,724276,724279,724282,724286,724289,724291,724295,724298,724300,724306

?>
