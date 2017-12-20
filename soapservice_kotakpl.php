<?php
require 'scripts/db_init.php';
//require 'errorLogReporting.php';

KotakBank_PL();

function KotakBank_PL()
{
$today=Date('Y-m-d');
$tomorrow  = mktime(0, 0, 0, date("m")  , date("d"), date("Y"));
$currentdate=date('Y-m-d',$tomorrow);

	$mindate=$currentdate." 00:00:00";
	$maxdate=$today." 23:59:59";

$query1="Select RequestID from Req_Compaign Where (Reply_Type=1 and Bank_Name='Kotak Bank' and BidderID=2997)";
$result1 = ExecQuery($query1);

while($row1 = mysql_fetch_array($result1))
	{
	 $requestid= $row1["RequestID"];
	 }
If((strlen(trim($requestid))<=0))
	{	
		$query="SELECT
Total_Experience,Years_In_Company, Pancard, Residence_Address, Pincode, Gender,Company_Name,Net_Salary,BidderID,Name,Email,Mobile_Number,City,City_Other,RequestID,Feedback_ID,Loan_Amount,DOB,AllRequestID FROM Req_Feedback_Bidder_PL,Req_Loan_Personal WHERE Req_Feedback_Bidder_PL.AllRequestID= Req_Loan_Personal.RequestID and Req_Feedback_Bidder_PL.BidderID in (5386) and Req_Feedback_Bidder_PL.Reply_Type=1 and (Req_Feedback_Bidder_PL.Allocation_Date between '".$mindate."' and '".$maxdate."') order by Feedback_ID ASC LIMIT 0,1";
	}
	else
	{
	$query="SELECT Total_Experience,Years_In_Company,Pancard, Residence_Address, Pincode, Gender,Company_Name,Net_Salary,BidderID,Name,Email,Mobile_Number,City,City_Other,RequestID,Feedback_ID,Loan_Amount,DOB,AllRequestID FROM Req_Feedback_Bidder_PL,Req_Loan_Personal WHERE Req_Feedback_Bidder_PL.AllRequestID= Req_Loan_Personal.RequestID and Req_Feedback_Bidder_PL.BidderID in (5386) and Req_Feedback_Bidder_PL.Reply_Type=1 and Req_Feedback_Bidder_PL.Feedback_ID>'".$requestid."' and (Req_Feedback_Bidder_PL.Allocation_Date between '".$mindate."' and '".$maxdate."') order by Feedback_ID ASC LIMIT 0,1";
	}
echo $query."<br>";

$tataplqryresult = ExecQuery($query);
while($row=mysql_fetch_array($tataplqryresult))
{
	$AllRequestID= $row["AllRequestID"];
	$BidderID = $row["BidderID"];
	$RequestID = $row["RequestID"];
	$Feedback_ID = $row["Feedback_ID"];
	$Name = $row["Name"];
	list($first,$Last) = explode(' ', $Name,3);
	$Email = trim($row["Email"]);
	$Company_Name = trim($row["Company_Name"]);
	$CompanyName = substr(trim($Company_Name),0,90);
	
	$Pancard = trim($row["Pancard"]);
	$Pincode = trim($row["Pincode"]);
	$Gender = trim($row["Gender"]);
	$Years_In_Company = trim($row["Years_In_Company"]);
	$currentexpyear = date('Y') - $Years_In_Company;
	$currentexpdate=Date('d-m')."-".round($currentexpyear);
	$Allocation_Date = $row["Allocation_Date"];
	$Mobile_Number = trim($row["Mobile_Number"]);
	$Total_Experience = round($row["Total_Experience"]);
	$City = $row["City"];
	$City_Other = $row["City_Other"];
	$Loan_Amount = $row["Loan_Amount"];
	$loanamtarr = explode('.', $Loan_Amount);
	$loanamt=current ($loanamtarr);
	next($loanamtarr);
	$Net_Salary = $row["Net_Salary"];
	$salaryarr = explode('.', $Net_Salary);
	$netincome=current ($salaryarr);
	next($salaryarr);
	$monthlyincome= round($netincome/12);
	$DOB = $row["DOB"];
	$dobarr = explode('-', $DOB);
	$year=current ($dobarr);
	next($dobarr);
	$month=current ($dobarr);
	$day=end ($dobarr);
	$strdob = $day."-".$month."-".$year;

	if($City=="Others" && Strlen($City_Other)>0)
	{
		$strcity=$City_Other;
	}
	else
	{
		$strcity=$City;
	}
	$Residence_Address = trim($row["Residence_Address"])." ".$strcity;
	$strlength=strlen($Residence_Address)/2;
	$resiaddress=(str_split($Residence_Address,$strlength));
	$resiaddress1 = substr(trim($resiaddress[0]),0,30);
	$resiaddress3 = substr(trim($resiaddress[1]),0,30);
	$resiaddress2 = "";
	$citycode = getCityCode($strcity);

if($citycode>0)
	{
		$fcitycode = $citycode;
	}
	else
	{
		$fcitycode = "9999";
	}
if($Last=="")
	{
		$Last= "Kumar";
	}
if($Pincode>0)
	{
		$fpincode=$Pincode;
	}
	else
	{
		$fpincode=110001;
	}
$UniqueRefCode="230".$AllRequestID;
if($Gender>0 && $Pincode>0 && strlen($Pancard)==10 && strlen($Residence_Address)>3)// Pancard, Residence_Address, Pincode, Gender
	{
	$auth = array("Authentication"=>array("UserId"=>"pl_connector_7", "Password"=>"d4l#prd#!Qx7(19Loo"));
	$cust_details = array("PersonalLoan"=>array("Version"=>1, "IsExstCust"=>"N", "ExstCustType"=>0, "CRN"=>"", "PartyID"=>"", "FirstName"=>$first, "MiddleName"=>"", "LastName"=>$Last, "DOB"=>$strdob, "Gender"=>$Gender, "Qualification"=>11, "ResAddress1"=>$resiaddress1, "ResAddress2"=>$resiaddress2, "ResAddress3"=>$resiaddress3, "ResCity"=>$citycode, "ResPin"=>$Pincode, "ResType"=>2, "CurResSince"=>"01-01-1999", "ResPhNo"=>"", "Mobile"=>$Mobile_Number, "Email"=>$Email, "Aadhar"=>"","EmpType"=>1, "Organization"=>$CompanyName, "TotWrkExp"=>$Total_Experience, "CurCmpnyJoinDt"=>$currentexpdate, "NMI"=>$monthlyincome, "EmiCurPay"=>0, "OffAddress1"=>$CompanyName, "OffAddress2"=>"", "OffAddress3"=>$strcity,"OffCity"=>$citycode, "OffPin"=>$Pincode, "OffPhone"=>$Mobile_Number, "PrefMailAdd"=>1, "PerAddress1"=>$resiaddress1, "PerAddress2"=>$resiaddress2, "PerAddress3"=>$resiaddress3, "PerCity"=>$citycode, "PerPin"=>$Pincode, "PerResPhNo"=>"", "PAN"=>$Pancard, "LnAmt"=>$loanamt, "TnrMths"=>48, "IRR"=>14, "ProcFee"=>2, "IsCoApp"=>"N", "CoAppReltn"=>"","CoAppDOB"=>"", "CoAppEmpType"=>"", "CoAppOrg"=>"", "CoAppNMI"=>"", "CoAppEmiCurPay"=>""));
	$requeststring=implode(",",$cust_details["PersonalLoan"]);
	$request_arr = array("RPRequest"=>array_merge($auth, $cust_details));

print_r($request_arr);
	$ws_ur = 'https://rcasprod.kotak.com/connector/RPPersonalLoanConnector.wsdl?wsdl';
	$client = new SoapClient($ws_ur);
	$result = $client->__soapCall('personalLoan', $request_arr);
	print_r($result);
	$Status = $result->Status;
	$IsEligible = $result->IsEligible;
	$UniqueRefCode = $result->UniqueRefCode;

	$MaxLoanAmount = $result->EligibileDetails->MaxLoanAmount;
	$MaxLoanTenure = $result->EligibileDetails->MaxLoanTenure;
	$IR = $result->EligibileDetails->IR;
	$EMI = $result->EligibileDetails->EMI;
	$ProcFee = $result->EligibileDetails->ProcFee;
	$Errorcode = $result->Errorcode;
	$Errorinfo = $result->Errorinfo;
}
else
	{
$auth = array("Authentication"=>array("UserId"=>"Deal4loAns", "Password"=>"d4l!2@4Uiq!hJ"));
$cust_details = array("CustData"=>array("Version"=>1, "UniqueRefCode"=>$UniqueRefCode, "IsExstCust"=>"N", "ExstCustType"=>0, "CRN"=>"", "PartyID"=>"", "FirstName"=>$first, "MiddleName"=>"", "LastName"=>$Last, "DOB"=>$strdob, "ResCity"=>$citycode, "ResType"=>2, "Mobile"=>$Mobile_Number, "Email"=>$Email, "Aadhar"=>"","EmpType"=>1, "Organization"=>$CompanyName ,"NMI"=>$monthlyincome, "EmiCurPay"=>0, "OtpVerified"=>"Y"));
echo "<pre>";
$requeststring=implode(",",$cust_details["CustData"]);
$request_arr = array("InsertDOLeadRequest"=>array_merge($auth, $cust_details));

print_r($request_arr);

$ws_ur = 'https://rcasprod.kotak.com/connector/RPPersonalLoanConnector.wsdl?wsdl';// live
//$ws_ur = 'http://122.180.94.59:8135/connector/RPPersonalLoanConnector.wsdl?wsdl';//UAT
$client = new SoapClient($ws_ur);
$result = $client->__soapCall('insertDOLead', $request_arr);
print_r($result);

$Status = $result->Status;
$IsEligible = $result->IsEligible;
$UniqueRefCode = $result->UniqueRefCode;

$MaxLoanAmount = $result->EligibileDetails->MaxLoanAmount;
$MaxLoanTenure = $result->EligibileDetails->MaxLoanTenure;
$IR = $result->EligibileDetails->IR;
$EMI = $result->EligibileDetails->EMI;
$ProcFee = $result->EligibileDetails->ProcFee;
$Errorcode = $result->Errorcode;
$Errorinfo = $result->Errorinfo;
	}

//0: FAILURE/ERROR, 1: AIP APPROVED, 2: Eligible for lower EMI , 3: AIP REJECT, 4: AIP REFER
echo $responsestring ="Status-".$Status.", IsEligible-".$IsEligible.", UniqueRefCode-".$UniqueRefCode.", EligLnAmt-".$MaxLoanAmount.", Tenure-".$MaxLoanTenure.", ROI-".$IR.", EMI-".$EMI.", Errorcode-".$Errorcode.", Errorinfo-".$Errorinfo;


$qrydt= ExecQuery("INSERT INTO webservice_bidder_details (leadid,product,request_xml, feedback,bidderid,doe, cust_requestid) VALUES('".$Feedback_ID."','1','".$requeststring."','".$responsestring."','".$BidderID."',NOW(),'".$RequestID."')");

/*if ($xml_string == "Success")
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
*/
if($Feedback_ID>0)
	{
$update =ExecQuery("Update Req_Compaign set RequestID='".$Feedback_ID."' where (Reply_Type=1 and Bank_Name='Kotak Bank' and BidderID=2997)");
//echo "Update Req_Compaign set RequestID='".$Feedback_ID."' where (Reply_Type=1 and Bank_Name='PNB HFL' and BidderID=3603)";
	}

 
}// while
}

//Array ( [PartnerReturnId] => 12340 [Status] => 0 [Errorcode] => 6 [Errorinfo] => Duplicate lead ) 
function getCityCode($pKey){
    $titles = array(
	'Gurgaon'=>'7',
	'Chandigarh'=>'9',
	'Hyderabad'=>'15',
	'Bangalore'=>'2004',//earlier 19 - 13dec2016
	'Chennai'=>'21',
	'Ahmedabad '=>'22',
	'Mumbai'=>'25',
	'Pune'=>'26',
	'Kolkata'=>'64',
	'Coimbatore'=>'69',
	'Noida'=>'78',
	'Gaziabad'=>'87',
	'Secunderabad'=>'94',
	'Jaipur'=>'100',
	'Indore'=>'106',
	'Nagpur'=>'135',
	'Navi Mumbai'=>'163',
	'Surat'=>'190',
	'Cochin'=>'241',
	'Delhi'=>'318',
	'Bhopal'=>'623',
	'Thane'=>'640',
	'Greater Noida'=>'704',
	'Baroda'=>'707',
	'Lucknow'=>'807',
	'Ahmednagar'=>'979',
	'Belgaum'=>'980',
	'Faridabad'=>'981',
	'Kolhapur'=>'983',
	'Mangalore'=>'984',
	'Salem'=>'989',
	'Sangli'=>'990',
	'Udaipur'=>'992',
	'Vadodara'=>'993',
	'Hubli'=>'1011',
	'Howrah'=>'1034',
	'Gandhinagar'=>'1041',
	'Dehradun'=>'1062',
	'Bikaner'=>'1063',
	'Dharuhera'=>'1071',
	'Jalandhar'=>'1075',
	'Kanpur'=>'1080',
	'Mohali'=>'1087',
	'Nashik'=>'1089',
	'Patiala'=>'1090',
	'Agra'=>'1102',
	'Ajmer'=>'1103',
	'Allahabad'=>'1104',
	'Alwar'=>'1105',
	'Amritsar'=>'1106',
	'Anand'=>'1107',
	'Bahadurgarh'=>'1108',
	'Bareilly'=>'1109',
	'Bhilai'=>'1110',
	'Bhiwadi'=>'1111',
	'Bhubaneswar'=>'1112',
	'Bokaro'=>'1113',
	'Calicut'=>'1114',
	'Cuttack'=>'1115' );
    foreach ($titles as $key=>$value)
        if($pKey==$key)
        return $value;
    return "";
  }

?>