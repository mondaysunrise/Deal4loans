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

$query1="Select RequestID from Req_Compaign Where (Reply_Type='1' and Bank_Name like'%Tata Capital%' and BidderID=5264)";
$result1 = ExecQuery($query1);

while($row1 = mysql_fetch_array($result1))
	{
	 $requestid= $row1["RequestID"];
	 }
//$requestid="433598";
If((strlen(trim($requestid))<=0))
	{	//5235,5237,5242,5243,5245,5247,5241,5250,5236,5240,5239,5319,5320,5321,5422

		$query="SELECT
Add_Comment,BidderID,Name,Email,Mobile_Number,Pincode,Company_Name,City,City_Other,RequestID,Feedback_ID,Loan_Amount,DOB FROM Req_Feedback_Bidder_PL,Req_Loan_Personal WHERE Req_Feedback_Bidder_PL.AllRequestID= Req_Loan_Personal.RequestID and Req_Feedback_Bidder_PL.BidderID in (5235,5237,5242,5243,5245,5247,5241,5250,5236,5240,5239,5319,5320,5321,5422) and (Req_Feedback_Bidder_PL.Allocation_Date between '".$mindate."' and '".$maxdate."') order by Feedback_ID ASC";
	}
	else
	{
	$query="SELECT Add_Comment,BidderID,Name,Email,Mobile_Number,Pincode,Company_Name,City,City_Other,RequestID,Feedback_ID,Loan_Amount,DOB FROM Req_Feedback_Bidder_PL,Req_Loan_Personal WHERE Req_Feedback_Bidder_PL.AllRequestID= Req_Loan_Personal.RequestID and Req_Feedback_Bidder_PL.BidderID  in (5235,5237,5242,5243,5245,5247,5241,5250,5236,5240,5239,5319,5320,5321,5422) and Req_Feedback_Bidder_PL.Feedback_ID>'".$requestid."' and (Req_Feedback_Bidder_PL.Allocation_Date between '".$mindate."' and '".$maxdate."') order by Feedback_ID ASC";
	}
echo $query."<br>";

$tataplqryresult = ExecQuery($query);
while($row=mysql_fetch_array($tataplqryresult))
{
	$BidderID = $row["BidderID"];
$RequestID = $row["RequestID"];
$Feedback_ID = $row["Feedback_ID"];
$Name = trim($row["Name"]);
list($first,$last) = split('[ ]',$Name);
$Email =  trim($row["Email"]);
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
$Company_Name =  trim($row["Company_Name"]);
$strCompany_Name = substr(trim($Company_Name),0,50);
$City =  trim($row["City"]);
$City_Other =  trim($row["City_Other"]);
$Loan_Amount = $row["Loan_Amount"];
$Add_Comment = trim($row["Add_Comment"]);
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
	if($strcity=="Ahmedabad")
	{
		$strcity="Ahmedabad";
	}
	elseif($strcity=="Banglore" || $strcity=="Bangalore")
	{
		$strcity="Bangalore";
	}
	elseif($strcity=="Chennai")
	{
		$strcity="Chennai";
	}
	elseif($strcity=="Delhi" || $strcity=="Faridabad" || $strcity=="Gaziabad" || $strcity=="Noida" || $strcity=="Gurgaon" || $strcity=="Greater Noida")
	{
		$strcity="Delhi";
	}
	elseif($strcity=="Hyderabad")
	{
		$strcity="Hyderabad";
	}
	elseif($strcity=="Kolkata" || $strcity=="Howrah")
	{
		$strcity="Kolkata";
	}
	elseif($strcity=="Mumbai" || $strcity=="Kalyan" || $strcity=="Dombivli" || $strcity=="Navi Mumbai" || $strcity=="Panvel"  || $strcity=="Thane" || $strcity=="Virar" || $strcity=="Bhiwandi")
	{
		$strcity="Mumbai";
	}
	elseif($strcity=="Pune")
	{
		$strcity="Pune";
	}
	elseif($strcity=="Bhubaneshwar" || $strcity=="Bhubneshwar")
	{
		$strcity="Bhubaneswar";
	}
	else
	{
		$strcity=$strcity;
	}

if($last=="")
	{
		$last= $first;
		$first="Unknown";
	}
$pljsonurl='{	
"source":"Deal4Loans",	
"password":"Deal4Loans@123",	
"fname":"'.$first.'", 	
"mname":"", 	
"lname":"'.$last.'", 	
"title":"", 	
"resEmailId":"'.$strEmail.'", 	
"gender":"", 	
"dob":"'.$strdob.'", 	
"resMobNo":"'.$Mobile_Number.'", 	
"resLandlineNo":"", 	
"resAddress1":"", 	
"resAddress2":"", 	
"resAddress3":"", 	
"resCity":"'.$strcity.'", 	
"resPincode":"'.$Pincode.'",	
"resState":"", 	
"companyName":"'.$strCompany_Name.'", 	
"designation":"", 	
"officeEmailId":"", 	
"officeMobNo":"", 	
"leadDetails":"", 	
"salesOrg":"NSO", 	
"sageProduct":"Personal Loans", 	
"sagechannel":"Deal4Loans", 	
"leadType":"Individual", 	
"leadTag":"WarmLead", 	
"sageBranch":"", 	
"loanAmount":"0", 	
"campaignId":"", 	
"tenure":"", 	
"motherMaidenName":"", 	
"maritalStatus":"", 	
"semCampaignName":"", 	
"semSource":"", 	
"semSiteId":"", 	
"semHeadLine":"", 	
"semCreativeId":"", 	
"semKeyword":"", 	
"pan":"", 	
"gclId":"", 	
"referralName":"", 	
"referralDob":"", 	
"referralMob":"", 	
"referralContractNo":"", 	
"referralEmpId":"", 	
"leadStage":"NewLead", 	
"companyCategory":"", 	
"monthlySalary":"", 	
"rejectionReason":"", 	
"sanctionedAmount":" "	
}';

$url ="https://converge.tatacapital.com/APIFramework/APIServices/createLead.htm";
// cURL's initialization
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_FAILONERROR, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $pljsonurl);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json','Content-Type: application/json'));
$result = curl_exec($ch);
$webfeedback = str_replace('}', ' ', str_replace('{', ' ', str_replace('"', ' ',$result)));

/*$xmlstr="<?xml version='1.0' encoding='utf-8'?>
<soap:Envelope xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance' xmlns:xsd='http://www.w3.org/2001/XMLSchema' xmlns:soap='http://schemas.xmlsoap.org/soap/envelope/'>
  <soap:Body>
    <createWebLeadInSage xmlns='http://tempuri.org/'>
      <strFirstName>".$first."</strFirstName>
      <strLastName>".$last."</strLastName>
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
$Leadid=$check[0];
*/
//}
echo "<br><br>";
if($Feedback_ID>0)
	{
$update =ExecQuery("Update Req_Compaign set RequestID='".$Feedback_ID."' where (Reply_Type='1' and Bank_Name like'%Tata Capital%' and BidderID=5264)");
echo "Update Req_Compaign set RequestID='".$Feedback_ID."' where (Reply_Type='1' and Bank_Name like'%Tata Capital%' and BidderID=5264)";
	}

echo $qrydt= ExecQuery('INSERT INTO webservice_bidder_details (leadid,product,feedback,bidderid,doe, cust_requestid, cust_city) VALUES("'.$Feedback_ID.'","1","'.$webfeedback.'","'.$BidderID.'",NOW(),"'.$RequestID.'","'.$strcity.'")');


}
}
//
//tatacapital mailer
function tatacapitalplmlr()
{
$today=Date('Y-m-d');
$tomorrow  = mktime(0, 0, 0, date("m")  , date("d"), date("Y"));
$currentdate=date('Y-m-d',$tomorrow);

	$mindate=$currentdate." 00:00:00";
	$maxdate=$today." 23:59:59";

	$query="Select * from tatacapital_plmailer_leads Where ((tatacapital_plmailer_leads.tatacapital_dated between '".$mindate."' and '".$maxdate."') and tatacapital_plmailer_leads.tatacapital_sent=1 and tatacapital_plmailer_leads.sentto_tatacapital=0) order by tatacapitalid ASC";
	//$query="Select * from tatacapital_plmailer_leads Where (tatacapitalid=24)";

//echo $query."<br>";

$tataplqryresult = ExecQuery($query);
while($row=mysql_fetch_array($tataplqryresult))
{
$RequestID = $row["tatacapitalid"];
$Name = trim($row["tatacapital_name"]);
list($first,$last) = split('[ ]',$Name);
$Email = trim($row["tatacapital_email"]);
$Mobile_Number = $row["tatacapital_mobile_number"];
$Pincode = 100001;
$Company_Name = trim($row["tatacapital_company_name"]);
$strCompany_Name = substr(trim($Company_Name),0,50);
$City = trim($row["tatacapital_city"]);
$City_Other = $row["tatacapital_other_city"];
$Loan_Amount = $row["tatacapital_loan_amount"];
$Age = $row["tatacapital_age"];
if(strlen($Age)>0)
		{
			$date=date('m-d');
			$year = date('Y')-$Age;
			$DOB = $year."-".$date;
		}
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
			$bidderID=5237;
			$strcity=="Bangalore";

		  }
		  elseif($strcity=="Mumbai" || $strcity=="Thane" || $strcity=="Navi Mumbai")
		  {
			  $bidderID=5247;
			  $strcity=="Mumbai";
		  }
		  else
		  {
			  $bidderID=5242;
			  if($strcity=="Gaziabad")
			  {
				  $strcity=="Ghaziabad";
			  }
		  }
$BidderID = $bidderID;

if($last=="")
	{
		$last= $first;
		$first="Unknown";
	}
$pljsonurl='{	
"source":"Deal4Loans",	
"password":"Deal4Loans@123",	
"fname":"'.$first.'", 	
"mname":"", 	
"lname":"'.$last.'", 	
"title":"", 	
"resEmailId":"'.$strEmail.'", 	
"gender":"", 	
"dob":"'.$strdob.'", 	
"resMobNo":"'.$Mobile_Number.'", 	
"resLandlineNo":"", 	
"resAddress1":"", 	
"resAddress2":"", 	
"resAddress3":"", 	
"resCity":"'.$strcity.'", 	
"resPincode":"'.$Pincode.'",	
"resState":"", 	
"companyName":"'.$strCompany_Name.'", 	
"designation":"", 	
"officeEmailId":"", 	
"officeMobNo":"", 	
"leadDetails":"", 	
"salesOrg":"NSO", 	
"sageProduct":"Personal Loans", 	
"sagechannel":"Deal4Loans", 	
"leadType":"Individual", 	
"leadTag":"WarmLead", 	
"sageBranch":"", 	
"loanAmount":"0", 	
"campaignId":"", 	
"tenure":"", 	
"motherMaidenName":"", 	
"maritalStatus":"", 	
"semCampaignName":"", 	
"semSource":"", 	
"semSiteId":"", 	
"semHeadLine":"", 	
"semCreativeId":"", 	
"semKeyword":"", 	
"pan":"", 	
"gclId":"", 	
"referralName":"", 	
"referralDob":"", 	
"referralMob":"", 	
"referralContractNo":"", 	
"referralEmpId":"", 	
"leadStage":"NewLead", 	
"companyCategory":"", 	
"monthlySalary":"", 	
"rejectionReason":"", 	
"sanctionedAmount":" "	
}';

$url ="https://converge.tatacapital.com/APIFramework/APIServices/createLead.htm";
// cURL's initialization
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_FAILONERROR, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $pljsonurl);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json','Content-Type: application/json'));
$result = curl_exec($ch);
$webfeedback = str_replace('}', ' ', str_replace('{', ' ', str_replace('"', ' ',$result)));
	
 $qrydt= ExecQuery("INSERT INTO webservice_bidder_details (leadid,product,feedback,bidderid,doe, cust_requestid, cust_city) VALUES('".$RequestID."','1','".$webfeedback."','".$BidderID."',NOW(),'".$RequestID."','".$strcity."')");

if($RequestID>0 && strlen($Leadid)>0)
	{
$update =ExecQuery("Update tatacapital_plmailer_leads set sentto_tatacapital=1 where (tatacapitalid=".$RequestID.")");

	}

}
}
//tatacapitalplmlr

tatacapitalpl();
tatacapitalplmlr();

tatacapitalHL();

//HOME LOan Product
function tatacapitalHL()
{
	$today=Date('Y-m-d');
	$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-1, date("Y"));
	$currentdate=date('Y-m-d',$tomorrow);

		$mindate=$currentdate." 00:00:00";
		$maxdate=$today." 23:59:59";

	$query1="Select RequestID from Req_Compaign Where (Reply_Type='2' and Bank_Name='Tata Capital' and BidderID=5500)";
	$result1 = ExecQuery($query1);

	while($row1 = mysql_fetch_array($result1))
		{
		 $requestid= $row1["RequestID"];
		 }
	//$requestid="433598";
	If((strlen(trim($requestid))<=0))
		{	
		$query="SELECT
	Add_Comment,BidderID,Name,Email,Mobile_Number,Pincode,Company_Name,City,City_Other,RequestID,Feedback_ID,Loan_Amount,DOB FROM Req_Feedback_Bidder_HL,Req_Loan_Home WHERE Req_Feedback_Bidder_HL.AllRequestID= Req_Loan_Home.RequestID and Req_Feedback_Bidder_HL.BidderID in (5498,5499,6090,6091,6092,6097,6098,6099) and (Req_Feedback_Bidder_HL.Allocation_Date between '".$mindate."' and '".$maxdate."') order by Feedback_ID ASC limit 0,1";
		}
		else
		{
		$query="SELECT Add_Comment,BidderID,Name,Email,Mobile_Number,Pincode,Company_Name,City,City_Other,RequestID,Feedback_ID,Loan_Amount,DOB FROM Req_Feedback_Bidder_HL,Req_Loan_Home WHERE Req_Feedback_Bidder_HL.AllRequestID= Req_Loan_Home.RequestID and Req_Feedback_Bidder_HL.BidderID  in (5498,5499,6090,6091,6092,6097,6098,6099) and Req_Feedback_Bidder_HL.Feedback_ID>'".$requestid."' and (Req_Feedback_Bidder_HL.Allocation_Date between '".$mindate."' and '".$maxdate."') order by Feedback_ID ASC limit 0,1";
		}
	echo $query."<br>";

	$tataplqryresult = ExecQuery($query);
	while($row=mysql_fetch_array($tataplqryresult))
	{
		$BidderID = $row["BidderID"];
		$RequestID = $row["RequestID"];
		$Feedback_ID = $row["Feedback_ID"];
		$Name = trim($row["Name"]);
		list($first,$last) = split('[ ]',$Name);
		$Email = trim($row["Email"]);
		if(strlen($Email)>2)
		{
			$strEmail=$Email;
		}
		else
		{
			$strEmail="na@na.com";
		}
		$Mobile_Number = $row["Mobile_Number"];
		$Pincode = trim($row["Pincode"]);
		$Company_Name = trim($row["Company_Name"]);
		$strCompany_Name = substr(trim($Company_Name),0,50);
		$City = trim($row["City"]);
		$City_Other = trim($row["City_Other"]);
		$Loan_Amount = $row["Loan_Amount"];
		$Add_Comment = trim($row["Add_Comment"]);
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
	//Ahmedabad,Bengaluru,Chennai,Hyderabad,Kolkata,Mumbai,Delhi,Pune

	if($strcity=="Bangalore")
	{
		$strcity="Bangalore";
	}
	elseif($strcity=="Gaziabad")
	{
		$strcity="Ghaziabad";
	}
	elseif($strcity=="Bhubaneshwar" || $strcity=="Bhubneshwar")
	{
		$strcity="Bhubaneswar";
	}
	else
	{
		$strcity=$strcity;
	}

	if($last=="")
		{
			$last= $first;
			$first="Unknown";
		}

	$hljsonurl='{	
	"source":"Deal4Loans",	
	"password":"Deal4Loans@123",	
	"fname":"'.$first.'", 	
	"mname":"", 	
	"lname":"'.$last.'", 	
	"title":"", 	
	"resEmailId":"'.$strEmail.'", 	
	"gender":"", 	
	"dob":"'.$strdob.'", 	
	"resMobNo":"'.$Mobile_Number.'", 	
	"resLandlineNo":"", 	
	"resAddress1":"", 	
	"resAddress2":"", 	
	"resAddress3":"", 	
	"resCity":"'.$strcity.'", 	
	"resPincode":"'.$Pincode.'",	
	"resState":"", 	
	"companyName":"'.$strCompany_Name.'", 	
	"designation":"", 	
	"officeEmailId":"", 	
	"officeMobNo":"", 	
	"leadDetails":"", 	
	"salesOrg":"NSO", 	
	"sageProduct":"Home Loan", 	
	"sagechannel":"Deal4Loans", 	
	"leadType":"Individual", 	
	"leadTag":"WarmLead", 	
	"sageBranch":"", 	
	"loanAmount":"0", 	
	"campaignId":"", 	
	"tenure":"", 	
	"motherMaidenName":"", 	
	"maritalStatus":"", 	
	"semCampaignName":"", 	
	"semSource":"", 	
	"semSiteId":"", 	
	"semHeadLine":"", 	
	"semCreativeId":"", 	
	"semKeyword":"", 	
	"pan":"", 	
	"gclId":"", 	
	"referralName":"", 	
	"referralDob":"", 	
	"referralMob":"", 	
	"referralContractNo":"", 	
	"referralEmpId":"", 	
	"leadStage":"NewLead", 	
	"companyCategory":"", 	
	"monthlySalary":"", 	
	"rejectionReason":"", 	
	"sanctionedAmount":" "	
	}';

	$url ="https://converge.tatacapital.com/APIFramework/APIServices/createLead.htm";
	// cURL's initialization
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_FAILONERROR, 1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $hljsonurl);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json','Content-Type: application/json'));
	$result = curl_exec($ch);
	$webfeedback = str_replace('}', ' ', str_replace('{', ' ', str_replace('"', ' ',$result)));
		
				
	 $qrydt= ExecQuery("INSERT INTO webservice_bidder_details (leadid,product, feedback,bidderid,doe, cust_requestid, cust_city) VALUES('".$Feedback_ID."','2','".$webfeedback."','".$BidderID."',NOW(),'".$RequestID."','".$strcity."')");

	if($Feedback_ID>0)
		{
	$update =ExecQuery("Update Req_Compaign set RequestID='".$Feedback_ID."' where (Reply_Type='2' and Bank_Name='Tata Capital' and BidderID=5500)");

	}

}
}
?>