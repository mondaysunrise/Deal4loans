<?php
ini_set('max_execution_time', 1000);
require 'scripts/db_init.php';
//print_r($_POST);
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$requestID = $_POST["requestID"];
	$card_name = $_POST["card_name"];
	$card_id = $_POST["card_id"];
	$first_name = $_POST["first_name"];
	$middle_name = $_POST["middle_name"];
	$last_name = $_POST["last_name"];
	$Gender = $_POST["Gender"];
	$panno = $_POST["panno"];
	$resiaddress1 = $_POST["resiaddress1"];
	$strresiadd = round((strlen($resiaddress1)/2));
	$resiadd = str_split($resiaddress1, $strresiadd);
	$ResidenceAddress1 = substr(trim($resiadd[0]),0,23);
	$ResidenceAddress2 = substr(trim($resiadd[1]),0,23);
	$Qualification = $_POST["Qualification"];
	$OfficeAddress1 = $_POST["OfficeAddress1"];
	$strofficeadd = round((strlen($OfficeAddress1)/2));
	$officeadd = str_split($OfficeAddress1, $strofficeadd);
	$OfficeAddress1 = substr(trim($officeadd[0]),0,23);
	$OfficeAddress2 = substr(trim($officeadd[1]),0,23);
	$OfficeCity = $_POST["OfficeCity"];
	$OfficeState = GetStateCode(ucwords(strtolower($OfficeCity)));
	$OfficePin = $_POST["OfficePin"];
	$BillingPrefernce = $_POST["BillingPrefernce"];
	$City = $_POST["City"];
	
	//$STD = $_POST["STD"];
	$Phone_Numberwithstd = $_POST["Phone_Number"];
	$pincode= $_POST["pincode"];
	$relation_with_bank = $_POST["relation_with_bank"];
	$full_name=$first_name."".$middle_name."".$last_name;

	if(strlen($middle_name)>0 && $middle_name!="Middle Name" && $last_name=="")
	{
		$last= $middle_name;
		$middle_name="";
	}
	else
	{
		$last= $last_name;
	}
	if($last=="")
	{
		$last="Kumar";
	}

	$stdwithphone=split_on($Phone_Numberwithstd, 4);
	$STD = $stdwithphone[0];
	$Phone_Number = $stdwithphone[1];

		$InsertProductSql= array("Name"=>$full_name, "Gender" => $Gender, "Pancard" => $panno, "Residence_Address" => $Residence_Address, "Std_Code"=>$STD, "Landline"=>$Phone_Number, "Pincode"=>$pincode, "Office_Address"=>$OfficeAddress1);
		$wherecondition ="(RequestID='".$requestID."')";
		Mainupdatefunc("Req_Credit_Card", $InsertProductSql, $wherecondition);

		$getdetails="select id From credit_card_banks_apply Where ( cc_requestid='".$requestID."' and applied_bankname like '%American Express%') order by id DESC";
		list($alreadyExist,$myrow)=Mainselectfunc($getdetails,$array = array());
		$id=$myrow['id'];
		if($alreadyExist>0)
		{
		$duplicatepush=1;
		$DataArray = array("qualification" => $Qualification , "billing_preference" =>$BillingPrefernce, "office_city"=> $OfficeCity, "office_pincode"=> $OfficePin, "lead_source"=>"Direct" , "applied_bankname"=>"American Express");
		$wherecondition ="(id='".$id."')";
		//print_r($DataArray);
		Mainupdatefunc ('credit_card_banks_apply', $DataArray, $wherecondition);
		}
		else
		{
			$duplicatepush=0;
			$InsertProductSql= array("qualification" => $Qualification , "cc_requestid"=>$requestID,"billing_preference" =>$BillingPrefernce, "office_city"=> $OfficeCity, "office_pincode"=> $OfficePin, "applied_bankname"=>"American Express", "lead_source"=>"Direct");
			$ProductValue = Maininsertfunc("credit_card_banks_apply", $InsertProductSql);
		}

		if($card_id==46) { $chosenCard="gold";} elseif($card_id==47){ $chosenCard="platinumTravel";} elseif($card_id==50){ $chosenCard="makeMyTrip";}  elseif($card_id==71){ $chosenCard="membershipreward";}

		$slct="select Email,DOB,Company_Name,Net_Salary,Mobile_Number,Employment_Status,City from Req_Credit_Card Where (RequestID='".$requestID."')";
		list($Getnum,$row)=Mainselectfunc($slct,$array = array());
		$pagesource = $row["source"];
		$DOB = $row["DOB"];
		list($year,$month,$day) = explode("-",$DOB);
		$dobstr= $month."-".$day."-".$year;
		$CompanyName = trim($row["Company_Name"]);
		$Email = $row["Email"];
		$CompanyName = substr(trim($CompanyName),0,24);
		$Net_Salary = $row["Net_Salary"];
		list($AnnIncome,$extrapt) = explode(".",$Net_Salary);
		$monthlyincome = round($AnnIncome/12);

		$Mobile_Number = $row["Mobile_Number"];
		$Employment_Status = $row["Employment_Status"];
		//$City = $row["City"];
		$ResiState = GetStateCode(ucwords(strtolower($OfficeCity)));
		if($Employment_Status==0)
		{
			$EmpType="SE";
		}else {$EmpType="E";}
		
		$IP = getenv("REMOTE_ADDR");
	
	if($relation_with_bank>0) { $IsExtngScbCust="Y"; } else { $IsExtngScbCust="N"; }


$xmstr='<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:tem="http://tempuri.org/">
   <soapenv:Header>
      <tem:AuthHeader>      
         <tem:Username>dealsforloan</tem:Username>      
         <tem:Password>P@dea@!@()apm!lo#an!</tem:Password>
      </tem:AuthHeader>
   </soapenv:Header>
   <soapenv:Body>
      <tem:submitApplication>      
         <tem:chosenCard>'.$chosenCard.'</tem:chosenCard>      
         <tem:FNAME>'.$first_name.'</tem:FNAME>      
         <tem:MNAME>'.$middle_name.'</tem:MNAME>      
         <tem:LNAME>'.$last.'</tem:LNAME>      
         <tem:EMAIL>'.$Email.'</tem:EMAIL>      
         <tem:MOBILE>'.$Mobile_Number.'</tem:MOBILE>      
         <tem:DOB>'.$dobstr.'</tem:DOB>      
         <tem:GENDER>'.$Gender.'</tem:GENDER>      
         <tem:educationalQualification>'.$Qualification.'</tem:educationalQualification>      
         <tem:aadharnumber></tem:aadharnumber>      
         <tem:PANCARD>'.$panno.'</tem:PANCARD>      
         <tem:monthlyInCome>'.$monthlyincome.'</tem:monthlyInCome>      
         <tem:address>'.$ResidenceAddress1.'</tem:address>      
         <tem:address2>'.$ResidenceAddress2.'</tem:address2>      
         <tem:address3></tem:address3>      
         <tem:city>'.$City.'</tem:city>      
         <tem:state>'.$ResiState.'</tem:state>      
         <tem:pincode>'.$pincode.'</tem:pincode>      
         <tem:peraddresssameascurr>yes</tem:peraddresssameascurr>      
         <tem:permaddress>'.$ResidenceAddress1.'</tem:permaddress>      
         <tem:permaddress2>'.$ResidenceAddress2.'</tem:permaddress2>      
         <tem:permaddress3></tem:permaddress3>      
         <tem:permcity>'.$City.'</tem:permcity>      
         <tem:permstate>'.$ResiState.'</tem:permstate>      
         <tem:permpincode>'.$pincode.'</tem:permpincode>      
         <tem:jetPriviligeMember>N</tem:jetPriviligeMember>      
         <tem:jetPriviligeMembershipNumber></tem:jetPriviligeMembershipNumber>      
         <tem:JetPriviligeMembershipTier></tem:JetPriviligeMembershipTier>      
         <tem:jetStatementTobeSentTO></tem:jetStatementTobeSentTO>      
         <tem:employmentType>'.$EmpType.'</tem:employmentType>      
         <tem:companyName>'.$CompanyName.'</tem:companyName>      
         <tem:O_ADDRESS>'.$OfficeAddress1.'</tem:O_ADDRESS>      
         <tem:O_ADDRESS2>'.$OfficeAddress2.'</tem:O_ADDRESS2>      
         <tem:O_ADDRESS3></tem:O_ADDRESS3>      
         <tem:O_City>'.$OfficeCity.'</tem:O_City>      
         <tem:O_State>'.$OfficeState.'</tem:O_State>      
         <tem:O_Pincode>'.$OfficePin.'</tem:O_Pincode>      
         <tem:PHONE>'.$Phone_Number.'</tem:PHONE>      
         <tem:STD>'.$STD.'</tem:STD>      
         <tem:O_STD></tem:O_STD>      
         <tem:O_PHONE></tem:O_PHONE>      
         <tem:creditCardNumber></tem:creditCardNumber>      
         <tem:creditCardType></tem:creditCardType>      
		 <tem:consentForPaybackPointsEnrolment>YES</tem:consentForPaybackPointsEnrolment>
		<tem:consentForOnlineStatements>YES</tem:consentForOnlineStatements>
		<tem:consentForEmailCommunication>YES</tem:consentForEmailCommunication>
		<tem:consentForInsurancePlanCommunication>Y</tem:consentForInsurancePlanCommunication>
		<tem:consentForAdditionalPreviliges>Y</tem:consentForAdditionalPreviliges>
		<tem:consentForMarketingCommunicationOverPhone>Y</tem:consentForMarketingCommunicationOverPhone>              
         <tem:disclaimer>i agree</tem:disclaimer>      
         <tem:IP>'.$IP.'</tem:IP>      
         <tem:platinumCardBillingPreference>'.$BillingPrefernce.'</tem:platinumCardBillingPreference>
      </tem:submitApplication>
   </soapenv:Body>
	</soapenv:Envelope>';
//echo $xmstr;
/*
RE: xml request + response  Amex // 030517 By Bhupendra
consentForPaybackPointsEnrolment   - Y/N, Yes
consentForInsurancePlanCommunication - Yes
consentForAdditionalPreviliges - Yes
consentForMarketingCommunicationOverPhone- Yes
consentForOnlineStatements - already sending Yes
consentForEmailCommunication - already sending Yes */

	$url="https://www.americanexpressindia.co.in/webservices/singleform/dealsforloan.asmx?wsdl";
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/xml'));
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, "$xmstr");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$output = curl_exec($ch);

	$DataArray = array("request_data" =>$xmstr, "response_data" =>$output, "cc_requestid"=>$requestID);
	$wherecondition ="(id='".$ProductValue."')";

	Mainupdatefunc ('credit_card_banks_apply', $DataArray, $wherecondition);
	}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Instant E Apply Credit Cards Online in India</title>
<meta name="keywords" content="online credit cards, online credit cards applications, Credit card comparison, online application of credit card, apply online credit cards, online credit card application" />
<meta name="description" content="Fill Application form for credit cards. Instant Apply & get Approval for Credit cards such as HDFC, ICICI, Citibank, Standard Chartered, SBI and American express Online in India." />
<meta name="verify-v1" content="iC5qAw9C0E3rRZYbtAKvnPHmBSQU3zWJu5Ooj8hO3Og=">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<link href="css/credit-card-styles.css" type="text/css" rel="stylesheet"  />
</head>
<body>
<?php include "middle-menu.php"; ?>
<div style="clear:both;"></div>
<div class="cc_inner_wrapper">
<div style="clear:both;"></div>
<div class="common-bread-crumb" style="margin:auto; width:100%; margin-top:70px; color:#0a8bd9;"><u><a href="index.php" class="text12" style="color:#0080d6;" >Home</a></u> > <a href="credit-cards.php"  class="text12" style="color:#0080d6;"><u>Credit Card</u></a> <span style="color:#4c4c4c;">> American Express Credit Card</span></div>
<div style="clear:both; height:10px;"></div>
<div style="clear:both; height:20px; width:100%; margin:auto; margin-top:10px; padding-top:10px; font-size:18px; color:#000; height:400px;">
Thank you for applying  for <? echo $card_name; ?>  through deal4loans, we will get back to you soon.

</div>
</div>
</div>
<div style="clear:both; height:100px;"></div>
<!--partners-->
<?php include("footer_sub_menu.php"); ?>
</body>
</html>
</body>
</html>
<?php

function GetStateCode($pKey){
    $titles = array(
	'Ahmedabad'=>'Gujarat',
	'Bangalore'=>'Karnataka',
	'Chandigarh'=>'Chandigarh',
	'Chennai'=>'Tamil Nadu',
	'Coimbatore'=>'Tamil Nadu',
	'Indore'=>'Madhya Pradesh',
	'Jaipur'=>'Rajasthan',
	'Kolkata'=>'West Bengal',
	'Navi Mumbai'=>'Maharashtra',
	'Thane'=>'Maharashtra',
	'Mumbai'=>'Maharashtra',
	'Pune'=>'Maharashtra',
	'Surat'=>'Gujarat',
	'Vadodara'=>'Gujarat',
	'Vadodra'=>'Gujarat',
	'Baroda'=>'Gujarat',
	'New Delhi'=>'Delhi',
	'Delhi'=>'Delhi',
	'Greater Noida'=>'Uttar Pradesh',
	'Noida'=>'Uttar Pradesh',
	'Gurgaon'=>'Haryana',
	'Gaziabad'=>'Uttar Pradesh',
	'Ghaziabad'=>'Uttar Pradesh',
	'Faridabad'=>'Delhi',
	'Hyderabad'=>'Andhra Pradesh'
	   	);
    foreach ($titles as $key=>$value)
        if($pKey==$key)
        return $value;
    return "";
}

function GetAmexCity($pKey){
	$titles = array(
	'New Delhi'=>'Delhi',
	'Gaziabad'=>'Ghaziabad',
	'Gurugram'=>'Gurgaon',
	'Vadodara'=>'Vadodra',
	);
    foreach($titles as $key=>$value){
		if($pKey==$key){
			return $value;
		}
	}
	return $pKey;
}

  function split_on($string, $num) {
	$length = strlen($string);
	$output[0] = substr($string, 0, $num);
	$output[1] = substr($string, $num, $length );
	return $output;
	}
?>
	
