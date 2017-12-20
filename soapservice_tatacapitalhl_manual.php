<?php
//error_reporting(E_ALL);
require 'scripts/db_init.php';

tatacapitalHL();
//HOME LOan Product
function tatacapitalHL()
{
	$query1="Select RequestID from Req_Compaign Where (Reply_Type='2' and Bank_Name='Tata Capital' and BidderID=5500)";
	$result1 = ExecQuery($query1);

	while($row1 = mysql_fetch_array($result1))
		{
		 $requestid= $row1["RequestID"];
		 }
	//$requestid="433598";
	
		$query="SELECT Add_Comment,BidderID,Name,Email,Mobile_Number,Pincode,Company_Name,City,City_Other,RequestID,Feedback_ID,Loan_Amount,DOB FROM Req_Feedback_Bidder_HL,Req_Loan_Home WHERE Req_Feedback_Bidder_HL.AllRequestID= Req_Loan_Home.RequestID and Req_Feedback_Bidder_HL.BidderID  in (5498,5499,6090,6091,6092,6097,6098,6099) and Req_Feedback_Bidder_HL.Feedback_ID in (609794,610427,610528,610593,610893,612050,613624,614265,617443,618707,619793) order by Feedback_ID ";
	
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


}
}
?>