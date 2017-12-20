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

echo $query1="Select leadid from webservice_bidder_details Where (bidderid in (5247,5250,5235,5236,5237,5243,5241,5242,5240,5245,5239,5319,5320,5321,5422) and feedback='' and doe between '".$mindate."' and '".$maxdate."')";
$result1 = ExecQuery($query1);

while($row1 = mysql_fetch_array($result1))
	{
	 $requestid= $row1["leadid"];

If((strlen(trim($requestid))>0))
	{	
	$query="SELECT
DOB,BidderID,Name,Email,Mobile_Number,Pincode,Company_Name,City,City_Other,RequestID,Feedback_ID FROM Req_Feedback_Bidder_PL,Req_Loan_Personal WHERE Req_Feedback_Bidder_PL.AllRequestID= Req_Loan_Personal.RequestID and Req_Feedback_Bidder_PL.BidderID in (5247,5250,5235,5236,5237,5243,5241,5242,5240,5245,5239,5319,5320,5321,5422) and (Req_Feedback_Bidder_PL.Feedback_ID='".$requestid."') order by Feedback_ID ASC";
	
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

$DOB = $row["DOB"];
list($year,$month,$day) = split('[-]',$DOB);
$strdob = $day."/".$month."/".$year;


if($strcity=="Bangalore")
	{
		$strcity="Bengaluru";
	}
	elseif($strcity=="Gaziabad")
	{
		$strcity="Ghaziabad";
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