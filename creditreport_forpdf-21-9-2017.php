<?php
session_start();
//require_once '../mpdf/mpdf.php';
require 'scripts/db_init.php';
require 'scripts/db_init_wishfin.php';
//ZW1haWw9c2hhcm1hczQ3NkBnbWFpbC5jb20maWQ9MTU2Mw==

	$querystring=$_SERVER["QUERY_STRING"];

	$querycoded= base64_decode($querystring);
	list($firstpart,$secondpart) =explode("&",$querycoded);
	list($email,$retrivesource) =explode("=",$firstpart);
	list($id,$fieldval) =explode("=",$secondpart);
	$cibil_email = $_SESSION['username'];
	$fieldval = 1;
	$getCibilXmlQry = "SELECT cibil_xml_data FROM xkyknzl5dwfyk4hg_cibil WHERE (cibil_xml_data is NOT NULL and status=1 and id=".$fieldval.")";
	echo $getCibilXmlQry;
	$getCibilXmlResult = wf_ExecQuery($getCibilXmlQry);

	echo $num =wf_mysql_num_rows($getCibilXmlResult);
$cibil_xml_data= wf_mysql_result($getCibilXmlResult,0,'cibil_xml_data');
echo "<br>"; echo $cibil_xml_data; echo "<br>";
//	$getCibilXmlJsonResponse = wf_mysql_fetch_assoc($getCibilXmlResult);
//echo 
print_r($getCibilXmlResult);
//echo  $cibilXml = $getCibilXmlResponse['cibil_xml_data'];

exit();
	
if($email=="src")
{//if wishfin ExecQuery_wf
	echo "i m here";
 $getCibilXmlQry = "SELECT cibil_xml_data FROM xkyknzl5dwfyk4hg_cibil WHERE (cibil_xml_data is NOT NULL and status=1 and id=".$fieldval.")";
 $getCibilXmlResult = wf_ExecQuery($getCibilXmlQry);
$getCibilXmlJsonResponse = wf_mysql_fetch_assoc($getCibilXmlResult);
//echo 
print_r($getCibilXmlResponse);
$cibilXml = $getCibilXmlResponse['cibil_xml_data'];
//$cibilXml = stripslashes($cibilXml);
	}
else 
{
$getCibilXmlQry = "SELECT api_response_data FROM api_log_cibil WHERE cibil_email = '".$retrivesource."' and id='".$fieldval."' AND api_from = 'CibilCustomerAssets' AND cibil_email !=''";
$getCibilXmlResult = d4l_ExecQuery($getCibilXmlQry);
$getCibilXmlJsonResponse = d4l_mysql_fetch_assoc($getCibilXmlResult);
$getCibilXmlResponse = json_decode($getCibilXmlJsonResponse['api_response_data'], true);
$cibilXml = $getCibilXmlResponse['result']['cibil_xml_data'];
$cibilXml = stripslashes($cibilXml);
}
//echo $cibilXml;exit;


echo $getCibilXmlQry;

exit();

$xml = $cibilXml;
//$xml = file_get_contents("testfile.xml");

$xml_string = str_ireplace('<soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/"><soap:Body>',"", $xml);
$xml_string = str_ireplace(array('ns1:', 'ns2:', 'ns3:', 'ns4:'), array('', '', '', ''), $xml_string);
$xml_string = str_ireplace('</soap:Body></soap:Envelope>',"", $xml_string );
//print_r($xml_string);

$output = simplexml_load_string($xml_string,'SimpleXMLElement', LIBXML_NOWARNING);
$outputjson = json_encode($output);
$outputArr = json_decode($outputjson,TRUE);
//echo '<pre>';print_r($outputArr);

$FinalArr = array();
//PersonalInfo
$PersonalInfoArr = array();
$CibilScore = $outputArr['GetCustomerAssetsSuccess']['Asset']['TrueLinkCreditReport']['Borrower']['CreditScore']['@attributes']['riskScore'];
$DOB = $outputArr['GetCustomerAssetsSuccess']['Asset']['TrueLinkCreditReport']['Borrower']['Birth']['@attributes']['date'];
$DOB = substr($DOB, 0,10);
$Name = $outputArr['GetCustomerAssetsSuccess']['Asset']['TrueLinkCreditReport']['Borrower']['BorrowerName']['Name']['Forename'];
$Gender = $outputArr['GetCustomerAssetsSuccess']['Asset']['TrueLinkCreditReport']['Borrower']['Gender'];


//PAN Info
$IdentifierArr = $outputArr['GetCustomerAssetsSuccess']['Asset']['TrueLinkCreditReport']['Borrower']['IdentifierPartition']['Identifier'];
$IdentifierFinalArr = array();
foreach($IdentifierArr as $key=>$value){
	$IdentifierName = $value['ID']['IdentifierName'];
	$Id = $value['ID']['Id'];
	$DateIssued = $value['@attributes']['dateIssued'];
	//Pan Details
	if($IdentifierName == 'TaxId'){
		$PAN = $Id;
		$PANIssueDate = $DateIssued;
		$PANIssueDate = substr($PANIssueDate, 0,10);
	}
}
//echo '<pre>';print_r($IdentifierFinalArr);

$PersonalInfoArr['CibilScore'] = $CibilScore;
$PersonalInfoArr['DOB'] = $DOB;
$PersonalInfoArr['Name'] = $Name;
$PersonalInfoArr['Gender'] = $Gender;
$PersonalInfoArr['PAN'] = $PAN;
$PersonalInfoArr['PANIssueDate'] = $PANIssueDate;


//ContactInfo
$ContactInfoArr = array();
$Phone = $outputArr['GetCustomerAssetsSuccess']['Asset']['TrueLinkCreditReport']['Borrower']['BorrowerTelephone']['PhoneNumber']['Number'];
$Email = $outputArr['GetCustomerAssetsSuccess']['Asset']['TrueLinkCreditReport']['Borrower']['EmailAddress']['Email'];

$borrowerAddressArr = $outputArr['GetCustomerAssetsSuccess']['Asset']['TrueLinkCreditReport']['Borrower']['BorrowerAddress'];
$borrowerAddressFinalArr = array();
foreach($borrowerAddressArr as $key=>$value){
	$dateReported = $value['@attributes']['dateReported'];
	$StreetAddress = $value['CreditAddress']['StreetAddress'];
	$PostalCode = $value['CreditAddress']['PostalCode'];
	$Region = $value['CreditAddress']['Region'];
	$RegionName = GetCityFromCode($Region);
	
	$borrowerAddressFinalArr[$key]['dateReported'] = $dateReported;
	$borrowerAddressFinalArr[$key]['StreetAddress'] = $StreetAddress;
	$borrowerAddressFinalArr[$key]['PostalCode'] = $PostalCode;
	$borrowerAddressFinalArr[$key]['Region'] = $Region;
	$borrowerAddressFinalArr[$key]['RegionName'] = $RegionName;
	
}
//echo '<pre>';print_r($borrowerAddressFinalArr);
//Sort address array based on date reported and get only last 4 addresses
$sortedAddressArr = array();
foreach ($borrowerAddressFinalArr as $key => $row)
{
    $sortedAddressArr[$key] = $row['dateReported'];
}
array_multisort($sortedAddressArr, SORT_DESC, $borrowerAddressFinalArr);
$borrowerAddressFinalArr = array_slice($borrowerAddressFinalArr, 0, 4);
//echo '<pre>';print_r($borrowerAddressFinalArr);exit;

$ContactInfoArr['Phone'] = $Phone;
$ContactInfoArr['Email'] = $Email;
$ContactInfoArr['Address'] = $borrowerAddressFinalArr;


//AccountInfo
$TradeLinePartitionArr = $outputArr['GetCustomerAssetsSuccess']['Asset']['TrueLinkCreditReport']['TradeLinePartition'];
//echo '<pre>';print_r($TradeLinePartitionArr);exit;
if(array_key_exists("@attributes",$TradeLinePartitionArr))
{
	$TradeLinePartitionFinalArr[0] = $TradeLinePartitionArr;
}
else
{
	$TradeLinePartitionFinalArr = $TradeLinePartitionArr;
}
$AccountInfoFinalArr = array();
foreach($TradeLinePartitionFinalArr as $key=>$value){
	//Account Details
	$AccountArr = array();
	$BankName = $value['Tradeline']['@attributes']['creditorName'];
	$AccountNumber = $value['Tradeline']['@attributes']['accountNumber'];
	$CurrentBalance = $value['Tradeline']['@attributes']['currentBalance'];
	$SanctionedAmount = $value['Tradeline']['@attributes']['highBalance'];
	$ActualPaymentAmount = $value['Tradeline']['GrantedTrade']['@attributes']['actualPaymentAmount'];
	$CreditLimit = $value['Tradeline']['GrantedTrade']['CreditLimit'];
	$CashLimit = $value['Tradeline']['GrantedTrade']['CashLimit'];
	$EMIAmount = $value['Tradeline']['GrantedTrade']['EMIAmount'];
	$InterestRate = $value['Tradeline']['GrantedTrade']['@attributes']['interestRate'];
	$RepaymentTenure = $value['Tradeline']['GrantedTrade']['@attributes']['termMonths'];
	$AccountTypeCode = $value['Tradeline']['GrantedTrade']['AccountType']['@attributes']['symbol'];
	$AccountType = GetAccountTypeFromCode($AccountTypeCode);
	$AccountDesignatorCode = $value['Tradeline']['AccountDesignator']['@attributes']['symbol'];
	$OwnerShip = GetOwnerShipFromCode($AccountDesignatorCode);

	$AccountArr['BankName'] = $BankName;
	$AccountArr['AccountNumber'] = $AccountNumber;
	$AccountArr['CurrentBalance'] = $CurrentBalance;
	$AccountArr['SanctionedAmount'] = $SanctionedAmount;
	$AccountArr['ActualPaymentAmount'] = $ActualPaymentAmount;
	$AccountArr['CreditLimit'] = $CreditLimit;
	$AccountArr['CashLimit'] = $CashLimit;
	$AccountArr['EMIAmount'] = $EMIAmount;
	$AccountArr['InterestRate'] = $InterestRate;
	$AccountArr['RepaymentTenure'] = $RepaymentTenure;
	$AccountArr['AccountType'] = $AccountType;
	$AccountArr['OwnerShip'] = $OwnerShip;
	
	
	//Dates Details
	$DatesArr = array();
	$DateOpened = $value['Tradeline']['@attributes']['dateOpened'];
	$DateOpened = substr($DateOpened, 0,10);
	$DateClosed = $value['Tradeline']['@attributes']['dateClosed'];
	$DateClosed = substr($DateClosed, 0,10);
	$DateReported = $value['Tradeline']['@attributes']['dateReported'];
	$DateReported = substr($DateReported, 0,10);
	$DateLastPayment = $value['Tradeline']['GrantedTrade']['@attributes']['dateLastPayment'];
	$DateLastPayment = substr($DateLastPayment, 0,10);
	$PaymentStartDate = $value['Tradeline']['GrantedTrade']['PayStatusHistory']['@attributes']['startDate'];
	$PaymentStartDate = substr($PaymentStartDate, 0,10);
	$PaymentEndDate = $value['Tradeline']['GrantedTrade']['PayStatusHistory']['@attributes']['endDate'];
	$PaymentEndDate = substr($PaymentEndDate, 0,10);
	
	$DatesArr['DateOpened'] = $DateOpened;
	$DatesArr['DateClosed'] = $DateClosed;
	$DatesArr['DateReported'] = $DateReported;
	$DatesArr['DateLastPayment'] = $DateLastPayment;
	$DatesArr['PaymentStartDate'] = $PaymentStartDate;
	$DatesArr['PaymentEndDate'] = $PaymentEndDate;
	
	//Payment History
	$PayStatusArr = $value['Tradeline']['GrantedTrade']['PayStatusHistory']['MonthlyPayStatus'];
	$PaymentHistoryArr = array();
	$totalYearArr = array();
	if(count($PayStatusArr) > 1){
		foreach($PayStatusArr as $key1=>$value1){
			$monthdate = $value1['@attributes']['date'];
			$monthdate = substr($monthdate, 0,10);
			$monthstatus = $value1['@attributes']['status'];

			$year = date('Y', strtotime($monthdate));
			$month = date('m', strtotime($monthdate));
			$date = date('d', strtotime($monthdate));
			
			$modifiedDate = $year.'-'.$month;
			$PaymentHistoryArr[$year][$modifiedDate] = $monthstatus;
		}
	}
	else{
		$monthdate = $PayStatusArr['@attributes']['date'];
		$monthdate = substr($monthdate, 0,10);
		$monthstatus = $PayStatusArr['@attributes']['status'];

		$year = date('Y', strtotime($monthdate));
		$month = date('m', strtotime($monthdate));
		$date = date('d', strtotime($monthdate));
		
		$modifiedDate = $year.'-'.$month;
		$PaymentHistoryArr[$year][$modifiedDate] = $monthstatus;
	}
	
	$AccountInfoFinalArr[$key]['AccountDetails'] = $AccountArr;
	$AccountInfoFinalArr[$key]['DateDetails'] = $DatesArr;
	$AccountInfoFinalArr[$key]['PaymentHistory'] = $PaymentHistoryArr;
}

//echo '<pre>';print_r($AccountInfoFinalArr);

//EnquiryInfo
$InquiryPartitionArr = $outputArr['GetCustomerAssetsSuccess']['Asset']['TrueLinkCreditReport']['InquiryPartition'];
//echo '<pre>';print_r($InquiryPartitionArr);exit;
if(array_key_exists("Inquiry",$InquiryPartitionArr))
{
	$InquiryPartitionFinalArr[0] = $InquiryPartitionArr;
}
else
{
	$InquiryPartitionFinalArr = $InquiryPartitionArr;
}
$InquiryInfoFinalArr = array();
foreach($InquiryPartitionFinalArr as $key=>$value){
	//Inquiry Details
	$InquiryArr = array();
	$SubscriberName = $value['Inquiry']['@attributes']['subscriberName'];
	$InquiryDate = $value['Inquiry']['@attributes']['inquiryDate'];
	$Amount = $value['Inquiry']['@attributes']['amount'];
	$InquiryTypeCode = $value['Inquiry']['@attributes']['inquiryType'];
	$InquiryType = GetAccountTypeFromCode($InquiryTypeCode);

	$InquiryArr['SubscriberName'] = $SubscriberName;
	$InquiryArr['InquiryDate'] = $InquiryDate;
	$InquiryArr['Amount'] = $Amount;
	$InquiryArr['InquiryType'] = $InquiryType;

	$InquiryInfoFinalArr[] = $InquiryArr;
}
//echo '<pre>';print_r($InquiryInfoFinalArr);exit;

$FinalArr['PersonalInfo'] = $PersonalInfoArr;
$FinalArr['ContactInfo'] = $ContactInfoArr;
$FinalArr['AccountInfo'] = $AccountInfoFinalArr;
$FinalArr['InquiryInfo'] = $InquiryInfoFinalArr;
//echo '<pre>';print_r($FinalArr);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
<table width="800" border="0" align="center" cellpadding="0" cellspacing="0">
 <tr>
    <td valign="top">
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
	<tr>
    <td align="left" bgcolor="#0d466a"><img src="http://www.deal4loans.com/images/dea4lonasnew-logo.png" class="img-responsive" alt="Logo"  width="123" height="50" style="margin-left:10px;"  /> </td>
	<td bgcolor="#0d466a">&nbsp;</td>
    <td align="right" bgcolor="#0d466a"><img src="http://www.deal4loans.com/cibil/images/cibil-logo.png" alt="Logo"></td>
  </tr>
      <tr>
        <td colspan="3" style="color:#0c4669; font-family:Arial, Helvetica, sans-serif; font-size:18px !important; font-weight:bold; padding-top:5px;">Personal Information</td>
      </tr>
      <tr>
        <td colspan="3">&nbsp;</td>
      </tr>
      <tr>
        <td width="36%" style="color:#666666; font-size:14px !important; font-family:Arial, Helvetica, sans-serif;">Name</td>
        <td width="30%" style="color:#666666; font-size:14px !important; font-family:Arial, Helvetica, sans-serif;">Date of Birth</td>
        <td width="34%" style="color:#666666; font-size:14px !important; font-family:Arial, Helvetica, sans-serif;">Gender</td>
      </tr>
      <tr>
        <td style="color:#222222; font-size:15px !important; font-family:Arial, Helvetica, sans-serif; line-height:28px;"><?php echo $FinalArr['PersonalInfo']['Name'];?> SHUBHAM</td>
        <td style="color:#222222; font-size:15px !important; font-family:Arial, Helvetica, sans-serif; line-height:28px;"><?php 
									if(!empty($FinalArr['PersonalInfo']['DOB'])){
										echo date('d-m-Y', strtotime($FinalArr['PersonalInfo']['DOB']));
									}
									else{
										echo '-';
									}
									?></td>
        <td style="color:#222222; font-size:15px !important; font-family:Arial, Helvetica, sans-serif; line-height:28px;"><?php echo $FinalArr['PersonalInfo']['Gender'];?></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td style="color:#666666; font-size:14px !important; font-family:Arial, Helvetica, sans-serif;">Indentification Type</td>
        <td style="color:#666666; font-size:14px !important; font-family:Arial, Helvetica, sans-serif;">Cibil Score</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td style="color:#222222; font-size:15px !important; font-family:Arial, Helvetica, sans-serif; line-height:28px;">Income Tax ID (PAN)</td>
        <td style="color:#222222; font-size:15px !important; font-family:Arial, Helvetica, sans-serif; line-height:28px;">-</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td style="color:#222222; font-size:15px !important; font-family:Arial, Helvetica, sans-serif; line-height:28px;">&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td style="color:#002D59; font-family:Arial, Helvetica, sans-serif; font-size:18px !important; font-weight:bold;">View Report &nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td colspan="3">
        <?php foreach($FinalArr['AccountInfo'] as $key1 => $value1){ ?>
        <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" bgcolor="#F7F7F7" style="border: #eeeeee solid thin;">
      <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td colspan="4" bgcolor="#f7f7f7" style="color:#666666; font-size:14px !important; font-family:Arial, Helvetica, sans-serif;">&nbsp;</td>
        </tr>
        <tr>
          <td width="25%" bgcolor="#f7f7f7" style="color:#666666; font-size:14px !important; font-family:Arial, Helvetica, sans-serif;">Member Name</td>
          <td width="25%" bgcolor="#f7f7f7" style="color:#666666; font-size:14px !important; font-family:Arial, Helvetica, sans-serif;">Account Type</td>
          <td width="25%" bgcolor="#f7f7f7" style="color:#666666; font-size:14px !important; font-family:Arial, Helvetica, sans-serif;">Account Number</td>
          <td width="25%" bgcolor="#f7f7f7" style="color:#666666; font-size:14px !important; font-family:Arial, Helvetica, sans-serif;">Ownership</td>
        </tr>
        <tr>
          <td bgcolor="#f7f7f7" style="color:#222222; font-size:15px !important; font-family:Arial, Helvetica, sans-serif; line-height:28px;"><?php echo $value1['AccountDetails']['BankName']; ?></td>
          <td bgcolor="#f7f7f7" style="color:#222222; font-size:15px !important; font-family:Arial, Helvetica, sans-serif; line-height:28px;"><?php echo $value1['AccountDetails']['AccountType']; ?></td>
          <td bgcolor="#f7f7f7" style="color:#222222; font-size:15px !important; font-family:Arial, Helvetica, sans-serif; line-height:28px;"><?php echo $value1['AccountDetails']['AccountNumber']; ?></td>
          <td bgcolor="#f7f7f7" style="color:#222222; font-size:15px !important; font-family:Arial, Helvetica, sans-serif; line-height:28px;">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="4" bgcolor="#f7f7f7" style="color:#222222; font-size:15px !important; font-family:Arial, Helvetica, sans-serif;">&nbsp;</td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" style="color:#0c4669; font-family:Arial, Helvetica, sans-serif; font-size:18px !important; font-weight:bold;">Account Details</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td style="color:#666666; font-size:14px !important; font-family:Arial, Helvetica, sans-serif;">Credit Limit</td>
    <td style="color:#666666; font-size:14px !important; font-family:Arial, Helvetica, sans-serif;">Rates of Interest</td>
    <td style="color:#666666; font-size:14px !important; font-family:Arial, Helvetica, sans-serif;">Sanctioned Amount</td>
  </tr>
  <tr>
    <td style="color:#222222; font-size:15px !important; font-family:Arial, Helvetica, sans-serif; line-height:28px;"><?php echo $value1['AccountDetails']['CreditLimit']; ?></td>
    <td style="color:#222222; font-size:15px !important; font-family:Arial, Helvetica, sans-serif; line-height:28px;"><?php echo $value1['AccountDetails']['InterestRate']; ?></td>
    <td style="color:#222222; font-size:15px !important; font-family:Arial, Helvetica, sans-serif; line-height:28px;"><?php echo $value1['AccountDetails']['SanctionedAmount']; ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td style="color:#666666; font-size:14px !important; font-family:Arial, Helvetica, sans-serif;">Repayment Tenure</td>
    <td style="color:#666666; font-size:14px !important; font-family:Arial, Helvetica, sans-serif;">Current Balance</td>
    <td style="color:#666666; font-size:14px !important; font-family:Arial, Helvetica, sans-serif;">EMI Amount</td>
  </tr>
  <tr>
    <td style="color:#222222; font-size:15px !important; font-family:Arial, Helvetica, sans-serif; line-height:28px;"><?php echo $value1['AccountDetails']['RepaymentTenure']; ?></td>
    <td style="color:#222222; font-size:15px !important; font-family:Arial, Helvetica, sans-serif; line-height:28px;"><?php echo $value1['AccountDetails']['CurrentBalance']; ?></td>
    <td style="color:#222222; font-size:15px !important; font-family:Arial, Helvetica, sans-serif; line-height:28px;"><?php echo $value1['AccountDetails']['EMIAmount']; ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td style="color:#666666; font-size:14px !important; font-family:Arial, Helvetica, sans-serif;">Cash Limit</td>
    <td style="color:#666666; font-size:14px !important; font-family:Arial, Helvetica, sans-serif;">Payment Frequency</td>
    <td style="color:#666666; font-size:14px; font-family:Arial, Helvetica, sans-serif;">Amount Overdue</td>
  </tr>
  <tr>
    <td style="color:#222222; font-size:15px !important; font-family:Arial, Helvetica, sans-serif; line-height:28px;"><?php echo $value1['AccountDetails']['CashLimit']; ?></td>
    <td style="color:#222222; font-size:15px !important; font-family:Arial, Helvetica, sans-serif; line-height:28px;">-</td>
    <td style="color:#222222; font-size:15px !important; font-family:Arial, Helvetica, sans-serif; line-height:28px;">-</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td style="color:#666666; font-size:14px !important; font-family:Arial, Helvetica, sans-serif;">Actual Payment Amount</td>
    <td style="color:#666666; font-size:14px !important; font-family:Arial, Helvetica, sans-serif;">&nbsp;</td>
    <td style="color:#666666; font-size:14px !important; font-family:Arial, Helvetica, sans-serif;">&nbsp;</td>
  </tr>
  <tr>
    <td style="color:#222222; font-size:15px !important; font-family:Arial, Helvetica, sans-serif; line-height:28px;">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" style="color:#002D59; font-family:Arial, Helvetica, sans-serif; font-size:18px !important; font-weight:bold;">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" style="color:#0c4669; font-family:Arial, Helvetica, sans-serif; font-size:18px !important; font-weight:bold;">Dates</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td style="color:#666666; font-size:14px !important; font-family:Arial, Helvetica, sans-serif;">Date Opened/Disbursed</td>
    <td style="color:#666666; font-size:14px !important; font-family:Arial, Helvetica, sans-serif;">Date Closed</td>
    <td style="color:#666666; font-size:14px !important; font-family:Arial, Helvetica, sans-serif;">Date of Last Payment</td>
  </tr>
  <tr>
    <td style="color:#222222; font-size:15px !important; font-family:Arial, Helvetica, sans-serif; line-height:28px;"><?php 
									if(!empty($value1['DateDetails']['DateOpened'])){
										echo date('d-m-Y', strtotime($value1['DateDetails']['DateOpened']));
									}
									else{
										echo '-';
									}
									?></td>
    <td style="color:#222222; font-size:15px !important; font-family:Arial, Helvetica, sans-serif; line-height:28px;"><?php 
									if(!empty($value1['DateDetails']['DateClosed'])){
										echo date('d-m-Y', strtotime($value1['DateDetails']['DateClosed']));
									}
									else{
										echo '-';
									}
									?></td>
    <td style="color:#222222; font-size:15px !important; font-family:Arial, Helvetica, sans-serif; line-height:28px;"><?php 
									if(!empty($value1['DateDetails']['DateLastPayment'])){
										echo date('d-m-Y', strtotime($value1['DateDetails']['DateLastPayment']));
									}
									else{
										echo '-';
									}
									?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td style="color:#666666; font-size:14px !important; font-family:Arial, Helvetica, sans-serif;">Date Reported And Certified</td>
    <td style="color:#666666; font-size:14px !important; font-family:Arial, Helvetica, sans-serif;">&nbsp;</td>
    <td style="color:#666666; font-size:14px !important; font-family:Arial, Helvetica, sans-serif;">&nbsp;</td>
  </tr>
  <tr>
    <td style="color:#222222; font-size:15px; font-family:Arial, Helvetica, sans-serif; line-height:28px;"><?php 
									if(!empty($value1['DateDetails']['DateReported'])){
										echo date('d-m-Y', strtotime($value1['DateDetails']['DateReported']));
									}
									else{
										echo '-';
									}
									?></td>
    <td style="color:#222222; font-size:15px !important; font-family:Arial, Helvetica, sans-serif; line-height:28px;">&nbsp;</td>
    <td style="color:#222222; font-size:15px !important; font-family:Arial, Helvetica, sans-serif; line-height:28px;">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" style="color:#002D59; font-family:Arial, Helvetica, sans-serif; font-size:18px; font-weight:bold;">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" style="color:#0c4669; font-family:Arial, Helvetica, sans-serif; font-size:18px; font-weight:bold;">Payment History (upto 36 Months)</td>
  </tr>
  <tr>
    <td style="color:#666666; font-size:14px !important; font-family:Arial, Helvetica, sans-serif;">&nbsp;</td>
    <td style="color:#666666; font-size:14px !important; font-family:Arial, Helvetica, sans-serif;">&nbsp;</td>
    <td style="color:#666666; font-size:14px !important; font-family:Arial, Helvetica, sans-serif;">&nbsp;</td>
  </tr>
  <tr>
    <td style="color:#666666; font-size:14px !important; font-family:Arial, Helvetica, sans-serif;">Payment Start Date</td>
    <td style="color:#666666; font-size:14px !important; font-family:Arial, Helvetica, sans-serif;">Payment End Date</td>
    <td style="color:#666666; font-size:14px !important; font-family:Arial, Helvetica, sans-serif;">&nbsp;</td>
  </tr>
  <tr>
    <td style="color:#222222; font-size:15px !important; font-family:Arial, Helvetica, sans-serif; line-height:28px;"><?php 
									if(!empty($value1['DateDetails']['PaymentEndDate'])){
										echo date('d-m-Y', strtotime($value1['DateDetails']['PaymentEndDate']));
									}
									else{
										echo '-';
									}
									?></td>
    <td style="color:#222222; font-size:15px !important; font-family:Arial, Helvetica, sans-serif; line-height:28px;"><?php 
									if(!empty($value1['DateDetails']['PaymentStartDate'])){
										echo date('d-m-Y', strtotime($value1['DateDetails']['PaymentStartDate']));
									}
									else{
										echo '-';
									}
									?></td>
    <td style="color:#222222; font-size:15px !important; font-family:Arial, Helvetica, sans-serif; line-height:28px;">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" style="color:#0c4669; font-family:Arial, Helvetica, sans-serif; font-size:18px !important; font-weight:bold;">Days Past Due (No. of Days) or Asset Classification (STD, SMA, SUB, DBT, LSS)</td>
  </tr>
  <tr>
    <td colspan="3"><table width="100%" border="1" cellpadding="0" cellspacing="0" style="border:thin solid #CCC;">
      <thead>
        <tr>
          <th class="dark-blue">&nbsp;</th>
          <th style="color:#222222; font-size:15px !important; font-family:Arial, Helvetica, sans-serif; line-height:28px;">Dec</th>
          <th style="color:#222222; font-size:15px !important; font-family:Arial, Helvetica, sans-serif; line-height:28px;">Nov</th>
          <th style="color:#222222; font-size:15px !important; font-family:Arial, Helvetica, sans-serif; line-height:28px;">Oct</th>
          <th style="color:#222222; font-size:15px !important; font-family:Arial, Helvetica, sans-serif; line-height:28px;">Sep</th>
          <th style="color:#222222; font-size:15px !important; font-family:Arial, Helvetica, sans-serif; line-height:28px;">Aug</th>
          <th style="color:#222222; font-size:15px !important; font-family:Arial, Helvetica, sans-serif; line-height:28px;">Jul</th>
          <th style="color:#222222; font-size:15px !important; font-family:Arial, Helvetica, sans-serif; line-height:28px;">Jun</th>
          <th style="color:#222222; font-size:15px !important; font-family:Arial, Helvetica, sans-serif; line-height:28px;">May</th>
          <th style="color:#222222; font-size:15px !important; font-family:Arial, Helvetica, sans-serif; line-height:28px;">APR</th>
          <th style="color:#222222; font-size:15px !important; font-family:Arial, Helvetica, sans-serif; line-height:28px;">Mar</th>
          <th style="color:#222222; font-size:15px !important; font-family:Arial, Helvetica, sans-serif; line-height:28px;">Feb</th>
          <th style="color:#222222; font-size:15px !important; font-family:Arial, Helvetica, sans-serif; line-height:28px;">Jan</th>
        </tr>
      </thead>
      <tbody>
        <?php 
											foreach($value1['PaymentHistory'] as $paykey => $payvalue){
												$first_key = key($payvalue);
												$year = date('Y', strtotime($first_key));
											?>
        <tr style="color:#222222; font-size:15px; font-family:Arial, Helvetica, sans-serif; line-height:28px;">
          <td><?php echo $year; ?></td>
          <?php
												for($i=12;$i>0;$i--){
													$month = ($i < 10) ? '0'.$i : $i;
													$modifiedKey = $year.'-'.$month;
													$checkvalue = $payvalue[$modifiedKey];
													if($checkvalue == '0'){
													?>
          <td>000</td>
          <?php
													}
													else if($checkvalue == 'XXX'){
													?>
          <td>XXX</td>
          <?php
													}
													else{
													?>
          <td><?php echo $checkvalue; ?></td>
          <?php
													}
												}
												?>
        </tr>
        <?php 
											}
											?>
      </tbody>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" style="color:#002D59; font-family:Arial, Helvetica, sans-serif; font-size:18px !important; font-weight:bold;">Collateral</td>
  </tr>
  <tr>
    <td style="color:#666666; font-size:14px !important; font-family:Arial, Helvetica, sans-serif;">Value of Collateral</td>
    <td style="color:#666666; font-size:14px !important; font-family:Arial, Helvetica, sans-serif;">Type of Collateral</td>
    <td style="color:#666666; font-size:14px !important; font-family:Arial, Helvetica, sans-serif;">&nbsp;</td>
  </tr>
  <tr>
    <td style="color:#222222; font-size:15px !important; font-family:Arial, Helvetica, sans-serif; line-height:28px;">-</td>
    <td style="color:#222222; font-size:15px !important; font-family:Arial, Helvetica, sans-serif; line-height:28px;">-</td>
    <td style="color:#222222; font-size:15px !important; font-family:Arial, Helvetica, sans-serif; line-height:28px;">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" style="color:#002D59; font-family:Arial, Helvetica, sans-serif; font-size:18px !important; font-weight:bold;">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" style="color:#002D59; font-family:Arial, Helvetica, sans-serif; font-size:18px !important; font-weight:bold;">Default Status</td>
  </tr>
  <tr>
    <td style="color:#666666; font-size:14px !important; font-family:Arial, Helvetica, sans-serif;">&nbsp;</td>
    <td style="color:#666666; font-size:14px !important; font-family:Arial, Helvetica, sans-serif;">&nbsp;</td>
    <td style="color:#666666; font-size:14px !important; font-family:Arial, Helvetica, sans-serif;">&nbsp;</td>
  </tr>
  <tr>
    <td style="color:#666666; font-size:14px !important; font-family:Arial, Helvetica, sans-serif;">Suit Filed/Willful Default</td>
    <td style="color:#666666; font-size:14px !important; font-family:Arial, Helvetica, sans-serif;">Written off Status</td>
    <td style="color:#666666; font-size:14px !important; font-family:Arial, Helvetica, sans-serif;">Written off Amount (Total).</td>
  </tr>
  <tr>
    <td style="color:#222222; font-size:15px !important; font-family:Arial, Helvetica, sans-serif; line-height:28px;">-</td>
    <td style="color:#222222; font-size:15px !important; font-family:Arial, Helvetica, sans-serif; line-height:28px;">-</td>
    <td style="color:#222222; font-size:15px !important; font-family:Arial, Helvetica, sans-serif; line-height:28px;">-</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td style="color:#666666; font-size:14px !important; font-family:Arial, Helvetica, sans-serif;">Written off Amount (Principal)</td>
    <td style="color:#666666; font-size:14px !important; font-family:Arial, Helvetica, sans-serif;">Settlement Amount</td>
    <td style="color:#666666; font-size:14px !important; font-family:Arial, Helvetica, sans-serif;">&nbsp;</td>
  </tr>
  <tr>
    <td style="color:#222222; font-size:15px !important; font-family:Arial, Helvetica, sans-serif; line-height:28px;">-</td>
    <td style="color:#222222; font-size:15px !important; font-family:Arial, Helvetica, sans-serif; line-height:28px;">-</td>
    <td style="color:#222222; font-size:15px !important; font-family:Arial, Helvetica, sans-serif; line-height:28px;">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td style="color:#666666; font-size:14px !important; font-family:Arial, Helvetica, sans-serif;">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<?php } ?>
</td>
        </tr>
    </table></td>
  </tr>
 
  <tr>
    <td colspan="3"><table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td colspan="4" style="color:#002D59; font-family:Arial, Helvetica, sans-serif; font-size:18px!important; font-weight:bold;">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="4" style="color:#002D59; font-family:Arial, Helvetica, sans-serif; font-size:18px; font-weight:bold;">Enquiry Details</td>
      </tr>
       <tr>
        <td style="color:#666666; font-size:14px !important; font-family:Arial, Helvetica, sans-serif;">Member Name</td>
        <td style="color:#666666; font-size:14px !important; font-family:Arial, Helvetica, sans-serif;">Date of Enquiry</td>
        <td style="color:#666666; font-size:14px !important; font-family:Arial, Helvetica, sans-serif;">Enquiry Purpose</td>
        <td style="color:#666666; font-size:14px !important; font-family:Arial, Helvetica, sans-serif;">Enquiry Amount</td>
      </tr>
	  <tr>
	  <?php 
						foreach($FinalArr['InquiryInfo'] as $key=>$val){
						?>
						<tr>
						        <td style="color:#222222; font-size:15px !important; font-family:Arial, Helvetica, sans-serif; line-height:28px;"><?php echo $val['SubscriberName'];?></td>
							<td style="color:#222222; font-size:15px !important; font-family:Arial, Helvetica, sans-serif; line-height:28px;">
									<?php 
									if(!empty($val['InquiryDate'])){
										echo date('d-m-Y', strtotime($val['InquiryDate']));
									}
									else{
										echo '-';
									}
									?>
								</td>
							<td style="color:#222222; font-size:15px !important; font-family:Arial, Helvetica, sans-serif; line-height:28px;"><?php echo $val['InquiryType'];?></td>
							<td style="color:#222222; font-size:15px !important; font-family:Arial, Helvetica, sans-serif; line-height:28px;"><?php echo $val['Amount'];?></td>
</tr>
							<?php 
						}
						?>
						

     
    </table>
	</td></tr></table>
</body>
</html>
<?php
function GetCityFromCode($code){
    $name = array(
	"0" => 'Jammu & Kashmir',
	"2" => 'Himachal Pradesh',
	"3" => 'Punjab',
	"4" => 'Chandigarh',
	"5" => 'Uttaranchal',
	"6" => 'Haryana',
	"7" => 'Delhi',
	"8" => 'Rajasthan',
	"9" => 'Uttar Pradesh',
	"10" => 'Bihar',
	"11" => 'Sikkim',
	"12" => 'Arunachal Pradesh',
	"13" => 'Nagaland',
	"14" => 'Manipur',
	"15" => 'Mizoram',
	"16" => 'Tripura',
	"17" => 'Meghalaya',
	"18" => 'Assam',
	"19" => 'West Bengal',
	"20" => 'Jharkhand',
	"21" => 'Orissa',
	"22" => 'Chhattisgarh',
	"23" => 'Madhya Pradesh',
	"24" => 'Gujarat',
	"25" => 'Daman & Diu',
	"26" => 'Dadra & Nagar Haveli',
	"27" => 'Maharashtra',
	"28" => 'Andhra Pradesh',
	"29" => 'Karnataka',
	"30" => 'Goa',
	"31" => 'Lakshadweep',
	"32" => 'Kerala',
	"33" => 'Tamil Nadu',
	"34" => 'Pondicherry',
	"35" => 'Andaman & Nicobar Islands',
	"36" => 'Telangana',
	"99" => 'APO Address',
	);
    foreach ($name as $key=>$value){
		if($code==$key){
			return $value;
		}
	}
    return "";
}


function GetAccountTypeFromCode($code){
    $name = array(
    "00" => 'Other',
	"01" => 'Auto Loan (Personal)',
	"02" => 'Housing Loan',
	"03" => 'Property Loan',
	"04" => 'Loan Against Shares/Securities',
	"05" => 'Personal Loan',
	"06" => 'Consumer Loan',
	"07" => 'Gold Loan',
	"08" => 'Education Loan',
	"09" => 'Loan to Professional',
	"10" => 'Credit Card',
	"11" => 'Leasing',
	"12" => 'Overdraft',
	"13" => 'Two-wheeler Loan',
	"14" => '(NFCF) Non-Funded Credit Facility',
	"15" => '(LABD) Current Loan Against Bank Deposits',
	"16" => 'Fleet Card',
	"17" => 'Commercial Vehicle Loan',
	"18" => 'Telco – Wireless',
	"19" => 'Telco – Broadband',
	"20" => 'Telco – Landline',
	"31" => 'Secured Credit Card',
	"32" => 'Used Car Loan',
	"33" => 'Construction Equipment Loan',
	"34" => 'Tractor Loan',
	"35" => 'Corporate Credit Card',
	"36" => 'Kisan Credit Card',
	"37" => 'Loan on Credit Card',
	"38" => 'Prime Minister Jaan Dhan Yojana - Overdraft',
	"39" => 'Mudra Loans – Shishu / Kishor / Tarun',
	"40" => 'Microfinance – Business Loan',
	"41" => 'Microfinance – Personal Loan',
	"42" => 'Microfinance – Housing Loan',
	"43" => 'Microfinance – Other',
	"44" => 'Pradhan Mantri Awas Yojana - Credit Link Subsidy Scheme MAY CLSS',
	"50" => 'Business Loan - Secured',
	"51" => 'Business Loan – General',
	"52" => '(BLPS-SB) Business Loan – Priority Sector – Small Business',
	"53" => '(BLPS-AGR) Business Loan – Priority Sector – Agriculture',
	"54" => '(BLPS-OTH) Business Loan – Priority Sector – Others',
	"55" => ' (BNFCF-GEN) Business Non-Funded Credit Facility – General',
	"56" => '(BNFCF-PS-SB) Business Non-Funded Credit Facility – Priority Sector – Small Business',
	"57" => '(BNFCF-PS-AGR)  Business Non-Funded Credit Facility – Priority Sector – Agriculture',
	"58" => '(BNFCF-PS-OTH)  Business Non-Funded Credit Facility – Priority Sector-Others',
	"59" => '(BLABD) Current Business Loan Against Bank Deposits',
	"61" => 'Business Loan - Unsecured',
	"80" => 'Microfinance Detailed Report (Applicable to Enquiry Purpose only)',
	"81" => 'Summary Report (Applicable to Enquiry Purpose only)',
	"88" => 'Locate Plus for Insurance (Applicable to Enquiry Purpose only)',
	"90" => 'Account Review (Applicable to Enquiry Purpose only)',
	"91" => 'Retro Enquiry (Applicable to Enquiry Purpose only)',
	"92" => 'Locate Plus (Applicable to Enquiry Purpose only)',
	"97" => 'Adviser Liability (Applicable to Enquiry Purpose only)',
	"98" => 'Secured (Account Group for Portfolio Review response)',
	"99" => 'Unsecured (Account Group for Portfolio Review response)',
	);
    foreach ($name as $key=>$value){
		if($code==$key){
			return $value;
		}
	}
    return "";
}


function GetOwnerShipFromCode($code){
    $name = array(
	"1" => 'INDIVIDUAL',
	"3" => 'GUARANTOR',
	"4" => 'JOINT',
	);
    foreach ($name as $key=>$value){
		if($code==$key){
			return $value;
		}
	}
    return "";
}

?>