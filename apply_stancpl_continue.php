<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	$urltype=$_REQUEST["urltype"];
	if($urltype=="httpsurl")
	{	require 'scripts/functionshttps.php'; 
		$urltypeval="httpsurl";
	}
	else
	{	require 'scripts/functions.php'; $urltypeval="";}


	$pl_requestid = $_REQUEST['pl_requestid'];
	$pl_bank_name = $_REQUEST['pl_bank_name'];
	$FirstName = $_REQUEST['FirstName'];
	$LastName = $_REQUEST['LastName'];
	$day = $_REQUEST['day'];
	if(strlen($day)==1)
	{
		$day="0".$day;
	}
	$month = $_REQUEST['month'];
	if(strlen($month)==1)
	{
		$month="0".$month;
	}
	$year = $_REQUEST['year'];
	$dob=$day."-".$month."-".$year;
	$gender = $_REQUEST['gender'];
	$Qualification = $_REQUEST['Qualification'];
	$PAN = $_REQUEST['PAN'];
	$ResType = $_REQUEST['ResType'];
	$Email = trim($_REQUEST['Email']);
	$ResAddress = trim($_REQUEST['ResAddress']);
	$strresiadd = round((strlen($ResAddress)/2));
	$resiadd = str_split($ResAddress, $strresiadd);
	$ResAddress1 = substr($resiadd[0],0,38);
	$ResAddress2 = substr($resiadd[1],0,38);
	$Landmark = trim($_REQUEST['Landmark']);
	$ResPin = $_REQUEST['ResPin'];
	$ResCity = $_REQUEST['ResCity'];
	$Mobile = $_REQUEST['Mobile'];
	$EmpType = $_REQUEST['EmpType'];
	$Organization = $_REQUEST['Organization'];
	$TypeOfOrg = $_REQUEST['TypeOfOrg'];
	$Industry = $_REQUEST['Industry'];
	$SalaryBank = $_REQUEST['SalaryBank'];
	$OffAddress = $_REQUEST['OffAddress'];
	$stroffadd = round((strlen($OffAddress)/2));
	$officeadd = str_split($OffAddress, $stroffadd);
	$OffAddress1 = substr($officeadd[0],0,38);
	$OffAddress2 = substr($officeadd[1],0,38);
	$GMI = round($_REQUEST['GMI']/12);
	$OffPIN = $_REQUEST['OffPIN'];
	$OffCity = $_REQUEST['OffCity'];
	$OffPhone = $_REQUEST['OffPhone'];
	$Mobile_Number = $_REQUEST['Mobile_Number'];
	$Total_Experience = round($_REQUEST['Total_Experience']);
	$MonthsCurrentOrg = round($_REQUEST['Years_In_Company']) * 12;
	$LoanAmount = $_REQUEST['LoanAmount'];
	$Citystr = $_REQUEST['City'];
	if($ResType==7 || $ResType==8 || $ResType==10)
	{
		$ResAccoType="3";
	}
	else
	{
		$ResAccoType=0;
	}
        $aiplead = $_REQUEST['aiplead'];
if (strlen($pl_bank_name)>1 && $pl_requestid>1)
{		$Dated=ExactServerdate();
	$getdetails="select websrvid From webservice_bidder_details Where ( leadid='".$pl_requestid."' and bidderid='".$pl_bank_name."')";
	list($alreadyExist,$myrow)=Mainselectfunc($getdetails,$array = array());
	$websrvid=$myrow['websrvid'];
	if($alreadyExist>0){
            $duplicatepush=1;
	}
	else{
            $duplicatepush=0;
	}
        
        if(isset($aiplead)){
          $duplicatepush=0;  
        }
        if(strlen($FirstName)>0 && strlen($LastName)>0 && strlen($gender)>0 && ($Mobile_Number>0) && ($Total_Experience>0) && ($LoanAmount>0) && (strlen($PAN)>=10) && $ResCity>1 && strlen($ResAddress1)>1 && strlen($ResAddress2)>2 && $duplicatepush==0)
	{
           
		//echo $FirstName."".$LastName."".$gender."".$MobileNumber."".$Total_Experience."".$LoanAmount."".$PAN."".$ResCity."".$ResAddress1."".$ResAddress2;
		//echo "i m here";
		//echo"<br><br>";
		$ConUniqRefCode="scbpl".$pl_requestid;
		$auth = array("Authentication"=>array("UserId"=>"pl_connector_5", "Password"=>"pd!8Gq(b49KK#@d4l"));//LIVE
		$cust_details = array("PersonalLoan"=>array("Version"=>"3","ConUniqRefCode"=>$ConUniqRefCode,"FirstName"=>$FirstName,"MiddleName"=>"","LastName"=>$LastName,"DOB"=>$dob,"Gender"=>$gender,"Qualification"=>$Qualification,"PAN"=>$PAN,"ResType"=>$ResType,"Email"=>$Email,"ResAddress1"=>$ResAddress1,"ResAddress2"=>$ResAddress2,"Landmark"=>$Landmark ,"ResPIN"=>$ResPin,"ResCity"=>$ResCity,"ResPhone"=>"","Mobile"=>$Mobile_Number,"ResAccoType"=>$ResAccoType,"EmpType"=>$EmpType,"Organization"=>$Organization,"TypeOfOrg"=>$TypeOfOrg,"Profession"=>"0","WorkExp"=>$Total_Experience,"Industry"=>$Industry,"MonthsCurrentOrg"=>$MonthsCurrentOrg,"SalaryBank"=>$SalaryBank,"OffAddress1"=>$OffAddress1,"OffAddress2"=>$OffAddress2,"OffPIN"=>$OffPIN,"OffCity"=>$OffCity,"OffPhone"=>$OffPhone,"OffPhoneExtn"=>"","GMI"=>$GMI,"CurrentEMI"=>"","TaxITRCurrYr"=>"","TaxITRPrevYr"=>"","CurrYrGrosTurnOver"=>"","CurrYrBusinessIncome"=>"","CurrYrOtherIncome"=>"","DepreciationPLAcc"=>"","LoanAmount"=>"2000000","TenureMonths"=>"36","IRR"=>"10.15","ProcFee"=>"2003","ExistingRelationship"=>"0","IncomeProof"=>"1"));
		$request_data = implode(",",$cust_details["PersonalLoan"]);
		$request_arr = array("RPRequest"=>array_merge($auth, $cust_details));
		
		//print_r($request_arr);
		$ws_ur = 'https://apply.standardchartered.co.in/connector/RPPersonalLoanConnector.wsdl?wsdl';
		$client = new SoapClient($ws_ur);
		$result = $client->__soapCall('personalLoan', $request_arr);
	//	print_r($result);
		$Status = $result->Status;
		$ReferenceCode = $result->ReferenceCode;
		$Errorcode = $result->Errorcode;
		$Errorinfo = $result->Errorinfo;
		$RequestIP = $result->RequestIP;
		$response_data = "Status -".$Status.", ReferenceCode -".$ReferenceCode.", Errorcode -".$Errorcode.",Errorinfo -".$Errorinfo.",RequestIP -".$RequestIP;
		//stdClass Object ( [Status] => 0 [ReferenceCode] => #CCFCWV68D [Errorcode] => 6 [Errorinfo] => Duplicate application [RequestIP] => 180.179.212.193 ) 
		$DataArray = array("leadid"=>$pl_requestid, "request_xml"=> $request_data,"feedback"=>$response_data ,"bidderid" =>$pl_bank_name, "doe"=>$Dated, "product"=>'1');
		//print_r($DataArray);
		Maininsertfunc('webservice_bidder_details', $DataArray);	
	
	}
}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Standard Chartered Bank</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="css/scb-styles.css" type="text/css" rel="stylesheet"  />
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet" type="text/css" />
</head>
<body>
<header class="scb-header">
<div class="scb-container">
<div class="logo-scb"><img src="images/scb-logo-lp.jpg"  alt="Standard Chartered Bank"></div>
<div class="logo-d4l"><img src="images/d4l.jpg" alt="Powered by Deal4loans"></div>
<div class="clearfix"></div>
</div>
</header>
<section>
<div class="scb-container pd-top-25">
<div class="scb-col-left">
Thank you for applying  for Standard Chartered Bank through deal4loans, we will get back to you soon.

</div>

<div class="scb-col-right">
<h2>Features</h2>
<h3>Affordable Financing</h3>
<p>SCB provide a variety of loans to both salaried and self- employed individuals.</p>
<h3>High Loan Amounts</h3>
<p>SCB offer loans up to Rs. 30 laks for salaried employees, and up to Rs. 10 lakhs for entrepreneurs.</p>
<h3>Low Interest Rates</h3>
<p>Standard Chartered offers competitive interest rates on personal loan.</p>
<h3>Unsecured loans</h3>
<p>You can take out a Personal Loan without the need for security, collateral or guarantors.</p>
<h3>Here are some of the other features of the personal loan you can avail of:</h3>
<p>
<ul>
<li>Repayment options vary from ECS, PDCs or Account Debit.</li>
<li>Easy documentation and quick processing</li>
<li>Existing Standard Chartered Personal Loans can be topped up 
with ease</li>
</ul>
</p>

</div>

</div>
</section>

</body>
</html>