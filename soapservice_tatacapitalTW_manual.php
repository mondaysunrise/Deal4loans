<?php
tatacapitalTWL();

function tatacapitalTWL()
{
$today=Date('Y-m-d');
$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-1, date("Y"));
$currentdate=date('Y-m-d',$tomorrow);

	$mindate=$currentdate." 00:00:00";
	$maxdate=$today." 23:59:59";

$query1="Select RequestID from Req_Compaign Where (Reply_Type='10' and Bank_Name='HDFC Bank' and BidderID=5572)";
list($alreadyExist,$row1)=MainselectfuncNew($query1,$array = array());
$row1contr=count($row1)-1;
	 $requestid= $row1[$row1contr]["RequestID"];

//$requestid="433598";
If((strlen(trim($requestid))<=0))
	{	
		$query="SELECT
BidderID,Name,Email,Mobile_Number,Pincode,Company_Name,City,City_Other,RequestID,Feedback_ID,Loan_Amount,DOB FROM Req_Feedback_Bidder1,Req_Loan_Bike WHERE Req_Feedback_Bidder1.AllRequestID= Req_Loan_Bike.RequestID and Req_Feedback_Bidder1.BidderID=5572 and Req_Feedback_Bidder1.Reply_Type=10 and (Req_Feedback_Bidder1.Allocation_Date between '".$mindate."' and '".$maxdate."') order by Feedback_ID ASC";
	}
	else
	{
	$query="SELECT BidderID,Name,Email,Mobile_Number,Pincode,Company_Name,City,City_Other,RequestID,Feedback_ID,Loan_Amount,DOB FROM Req_Feedback_Bidder1,Req_Loan_Bike WHERE Req_Feedback_Bidder1.AllRequestID= Req_Loan_Bike.RequestID and Req_Feedback_Bidder1.BidderID=5572 and Req_Feedback_Bidder1.Feedback_ID>'".$requestid."' and (Req_Feedback_Bidder1.Allocation_Date between '".$mindate."' and '".$maxdate."') order by Feedback_ID ASC";
	}
echo $query."<br>";

list($recordcount,$row)=MainselectfuncNew($query,$array = array());
for($ca=0;$ca<$recordcount;$ca++){
	$BidderID = $row[$ca]["BidderID"];
$RequestID = $row[$ca]["RequestID"];
$Feedback_ID = $row[$ca]["Feedback_ID"];
$Name = $row[$ca]["Name"];
list($first,$last) = split('[ ]',$Name);
$Email = $row[$ca]["Email"];
$Mobile_Number = $row[$ca]["Mobile_Number"];
$Pincode = $row[$ca]["Pincode"];
$Company_Name = $row[$ca]["Company_Name"];
$strCompany_Name = substr(trim($Company_Name),0,50);
$City = $row[$ca]["City"];
$City_Other = $row[$ca]["City_Other"];
$Loan_Amount = $row[$ca]["Loan_Amount"];
$DOB = $row[$ca]["DOB"];
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


$xmlstr="<?xml version='1.0' encoding='utf-8'?>
<soap:Envelope xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance' xmlns:xsd='http://www.w3.org/2001/XMLSchema' xmlns:soap='http://schemas.xmlsoap.org/soap/envelope/'>
  <soap:Body>
    <CreateLeadAndOpportunity  xmlns='http://tempuri.org/'>
      <strFirstName>".$first."</strFirstName>
	   <strMiddleName></strMiddleName>
      <strLastName>".$last."</strLastName>
	   <strTitle>NA</strTitle>
      <strEmail>".$Email."</strEmail>
      <strGender>Male</strGender>
	  <strDOB>".$strdob."</strDOB>
      <strMobileNo>".$Mobile_Number."</strMobileNo>
      <strHomePhone>NA</strHomePhone>
      <strAddLine1>NA</strAddLine1>
      <strAddLine2>NA</strAddLine2>
      <strCity>".$strcity."</strCity>
      <strPincode>".$Pincode."</strPincode>
      <strState>".$strcity."</strState>
      <strCompanyName>".$Company_Name."</strCompanyName>
      <strDesignation>NA</strDesignation>
      <strWorkEmail>NA</strWorkEmail>
      <strWorkPhone>NA</strWorkPhone>
      <strLeadDetails>string</strLeadDetails>
      <strSalesOrg>NSO</strSalesOrg>
      <strLob>NSO</strLob>
      <strProduct>Two Wheelers</strProduct>
      <strChannel>Deal4Loans</strChannel>
      <strLeadType>Individual</strLeadType>
      <strLeadTag>WarmLead</strLeadTag>
	  <strBranch>NA</strBranch>
      <strPan>NA</strPan>
      <strRequestedLaonAmount>".$Loan_Amount."</strRequestedLaonAmount>
      <strLoanAmount>".$Loan_Amount."</strLoanAmount>
      <strTenure>NA</strTenure>
      <strMotherMaidenName>NA</strMotherMaidenName>
      <strMaritalStatus>NA</strMaritalStatus>
    </CreateLeadAndOpportunity >
  </soap:Body>
</soap:Envelope>"; 

//Two Wheelers
echo $xmlstr."<br>";
echo "<br><br>";
$url = 'https://apps2.tatacapital.com/WebServiceIntegration/SageWebServices.asmx?wsdl ';
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
echo $webfeedback=$result;
$expires = preg_split('/Lead id/', $webfeedback);
array_shift($expires);
$strcheck=implode(" ",$expires);
$check=explode(" ",$strcheck);
$Leadid=$check[0];

if($Feedback_ID>0)
	{
	$dataUpdate = array('RequestID'=>$Feedback_ID);
	$wherecondition = "(Reply_Type='10' and Bank_Name='HDFC Bank' and BidderID=5572)";
	Mainupdatefunc ('Req_Compaign', $dataUpdate, $wherecondition);
	}

$Dated = ExactServerdate();
$dataInsert = array('leadid'=>$Feedback_ID,'product'=>'10','feedback'=>$webfeedback, 'bidderid'=>$BidderID, 'doe'=>$Dated, 'cust_requestid'=>$RequestID);
	$insert = Maininsertfunc ('webservice_bidder_details', $dataInsert);

}
}
