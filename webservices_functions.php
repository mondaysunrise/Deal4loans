<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);

class Webservices{
	
	public function __construct() {
		
    }
	
	function RBLWebservice($dataArr, $extraDataArr, $ccba_id){
		$Dated=ExactServerdate();
		
		$RequestID = $dataArr['RequestID'];
		$CreditCardApplied = $dataArr['CreditCardApplied'];
		$Title = $dataArr['Title'];
		$FirstName = $dataArr['FirstName'];
		$LastName = $dataArr['LastName'];
		$Gender = $dataArr['Gender'];
		$DOB = $dataArr['DOB'];
		$ResAddress1 = $dataArr['ResAddress1'];
		$ResAddress2 =  $dataArr['ResAddress2'];
		$ResCity = $dataArr['ResCity'];
		$ResPIN = $dataArr['ResPIN'];
		$Email = $dataArr['Email'];
		$Mobile = $dataArr['Mobile'];
		$EmpType = $dataArr['EmpType'];
		$NMI = $dataArr['NMI'];
		$PAN = $dataArr['PAN'];
		
		$lead_source = $extraDataArr['lead_source'];
		
		$UserId="cc_connector_2";
		$Password="pd9DFL2ua23X";
		
		$ConUniqRefCode="rbl".$RequestID;
		$auth = array("Authentication"=>array("UserId"=>$UserId, "Password"=>$Password));
		$cust_details = array("CreditCard"=>array("Version"=>6, "ConUniqRefCode"=>$ConUniqRefCode, "CreditCardApplied"=>$CreditCardApplied, "HadLoanOrCreditCardFromAnyBank"=>"Y", "Title"=>$Title,"FirstName"=>$FirstName, "MiddleName"=>"","LastName"=>$LastName,"FatherName"=>"","Gender"=>$Gender,"DOB"=>$DOB,"ResAddress1"=>$ResAddress1, "ResAddress2"=>$ResAddress2, "Landmark"=>"","ResCity"=>$ResCity, "ResPIN"=>$ResPIN, "Email"=>$Email, "Mobile"=>$Mobile, "EmpType"=>$EmpType, "NMI"=>$NMI, "PAN"=>$PAN));
		$request_arr = array("RPRequest"=>array_merge($auth, $cust_details));	

		$request_data = implode(",",$cust_details["CreditCard"]);
		
		//Update Request in table credit_card_banks_apply
		$RequestDataArray = array("request_data" =>$request_data, "last_updated"=>$Dated);
		$RequestWhereCond ="(id='".$ccba_id."')";
		Mainupdatefunc ('credit_card_banks_apply', $RequestDataArray, $RequestWhereCond);
		
		//Insert Request in table credit_card_banks_apply_log
		$RequestDataArrayLog = array("id"=>$ccba_id, "cc_requestid" =>$RequestID, "applied_bankname"=>"RBL Bank","applied_cardname" =>$CreditCardApplied, "request_data" => $request_data, "lead_source" => $lead_source, "date_created" => $Dated);
		$ccba_logid = Maininsertfunc('credit_card_banks_apply_log', $RequestDataArrayLog);

		//Hit RBL Webservice
		$soapClient = new nusoap_client("https://rblbank.rupeepower.com/connector/RPCreditCardConnector.wsdl?wsdl",true);   
		$soapClient->setCredentials($UserId, $Password, "basic");  
		$result= $soapClient->call("creditCard", $request_arr);

		$Status = $result["Status"];
		$ReferenceCode = $result["ReferenceCode"];
		$EligibleCard = $result["EligibleCard"];
		$Errorcode = $result["Errorcode"];
		$Errorinfo = $result["Errorinfo"];
		$RequestIP = $result["RequestIP"];

		$response_data = "Status -".$Status.", ReferenceCode -".$ReferenceCode.", EligibleCard -".$EligibleCard.", Errorcode -".$Errorcode.",Errorinfo -".$Errorinfo.",RequestIP -".$RequestIP;
		
		//Update Response in table credit_card_banks_apply
		$ResponseDataArray = array("response_data" =>$response_data);
		$ResponseWhereCond ="(id='".$ccba_id."')";
		Mainupdatefunc ('credit_card_banks_apply', $ResponseDataArray, $ResponseWhereCond);
		
		//Update Response in table credit_card_banks_apply_log
		$ResponseDataArrayLog = array("response_data" => $response_data, "date_modified" => $Dated);
		$ResponseWhereCondLog ="(logid='".$ccba_logid."')";
		Mainupdatefunc ('credit_card_banks_apply_log', $ResponseDataArrayLog, $ResponseWhereCondLog);
		
		$responseArray = array();
		$responseArray['Status'] = $Status;
		$responseArray['ReferenceCode'] = $ReferenceCode;
		$responseArray['EligibleCard'] = $EligibleCard;
		$responseArray['Errorcode'] = $Errorcode;
		$responseArray['Errorinfo'] = $Errorinfo;
		$responseArray['RequestIP'] = $RequestIP;
		//echo '<pre>';print_r($responseArray);
		return $responseArray;
	}
	
	function RBLWebserviceUAT($dataArr, $extraDataArr, $ccba_id){
		$Dated=ExactServerdate();
		
		$RequestID = $dataArr['RequestID'];
		$CreditCardApplied = $dataArr['CreditCardApplied'];
		$Title = $dataArr['Title'];
		$FirstName = $dataArr['FirstName'];
		$LastName = $dataArr['LastName'];
		$Gender = $dataArr['Gender'];
		$DOB = $dataArr['DOB'];
		$ResAddress1 = $dataArr['ResAddress1'];
		$ResAddress2 =  $dataArr['ResAddress2'];
		$ResCity = $dataArr['ResCity'];
		$ResPIN = $dataArr['ResPIN'];
		$Email = $dataArr['Email'];
		$Mobile = $dataArr['Mobile'];
		$EmpType = $dataArr['EmpType'];
		$NMI = $dataArr['NMI'];
		$PAN = $dataArr['PAN'];
		
		$lead_source = $extraDataArr['lead_source'];
		
		$UserId="cc_connector_2";
		$Password="pd9DFL2ua23X";
		
		$ConUniqRefCode="rbl".$RequestID;
		$auth = array("Authentication"=>array("UserId"=>$UserId, "Password"=>$Password));
		$cust_details = array("CreditCard"=>array("Version"=>6, "ConUniqRefCode"=>$ConUniqRefCode, "CreditCardApplied"=>$CreditCardApplied, "HadLoanOrCreditCardFromAnyBank"=>"Y", "Title"=>$Title,"FirstName"=>$FirstName, "MiddleName"=>"","LastName"=>$LastName,"FatherName"=>"","Gender"=>$Gender,"DOB"=>$DOB,"ResAddress1"=>$ResAddress1, "ResAddress2"=>$ResAddress2, "Landmark"=>"","ResCity"=>$ResCity, "ResPIN"=>$ResPIN, "Email"=>$Email, "Mobile"=>$Mobile, "EmpType"=>$EmpType, "NMI"=>$NMI, "PAN"=>$PAN));
		$request_arr = array("RPRequest"=>array_merge($auth, $cust_details));	

		$request_data = implode(",",$cust_details["CreditCard"]);
		
		//Update Request in table credit_card_banks_apply
		$RequestDataArray = array("request_data" =>$request_data, "last_updated"=>$Dated);
		$RequestWhereCond ="(id='".$ccba_id."')";
		Mainupdatefunc ('credit_card_banks_apply', $RequestDataArray, $RequestWhereCond);
		
		//Insert Request in table credit_card_banks_apply_log
		$RequestDataArrayLog = array("id"=>$ccba_id, "cc_requestid" =>$RequestID, "applied_bankname"=>"RBL Bank","applied_cardname" =>$CreditCardApplied, "request_data" => $request_data, "lead_source" => $lead_source, "date_created" => $Dated);
		$ccba_logid = Maininsertfunc('credit_card_banks_apply_log', $RequestDataArrayLog);

		//Hit RBL Webservice
		$soapClient = new nusoap_client("https://rblbank.rupeepower.com/connector/RPCreditCardConnector.wsdl?wsdl",true);   
		$soapClient->setCredentials($UserId, $Password, "basic");  
		$result= $soapClient->call("creditCard", $request_arr);

		$Status = $result["Status"];
		$ReferenceCode = $result["ReferenceCode"];
		$EligibleCard = $result["EligibleCard"];
		$Errorcode = $result["Errorcode"];
		$Errorinfo = $result["Errorinfo"];
		$RequestIP = $result["RequestIP"];

		$response_data = "Status -".$Status.", ReferenceCode -".$ReferenceCode.", EligibleCard -".$EligibleCard.", Errorcode -".$Errorcode.",Errorinfo -".$Errorinfo.",RequestIP -".$RequestIP;
		
		//Update Response in table credit_card_banks_apply
		$ResponseDataArray = array("response_data" =>$response_data);
		$ResponseWhereCond ="(id='".$ccba_id."')";
		Mainupdatefunc ('credit_card_banks_apply', $ResponseDataArray, $ResponseWhereCond);
		
		//Update Response in table credit_card_banks_apply_log
		$ResponseDataArrayLog = array("response_data" => $response_data, "date_modified" => $Dated);
		$ResponseWhereCondLog ="(logid='".$ccba_logid."')";
		Mainupdatefunc ('credit_card_banks_apply_log', $ResponseDataArrayLog, $ResponseWhereCondLog);
		
		$responseArray = array();
		$responseArray['Status'] = $Status;
		$responseArray['ReferenceCode'] = $ReferenceCode;
		$responseArray['EligibleCard'] = $EligibleCard;
		$responseArray['Errorcode'] = $Errorcode;
		$responseArray['Errorinfo'] = $Errorinfo;
		$responseArray['RequestIP'] = $RequestIP;
		//echo '<pre>';print_r($responseArray);
		return $responseArray;
	}


	function AmexWebservice($dataArr, $extraDataArr, $ccba_id){
		$Dated=ExactServerdate();
		
		//echo '<pre>';print_r($dataArr);exit;
		
		$RequestID = $dataArr['RequestID'];
		$chosenCard = $dataArr['chosenCard'];
		$FNAME = $dataArr['FNAME'];
		$MNAME = $dataArr['MNAME'];
		$LNAME = $dataArr['LNAME'];
		$EMAIL = $dataArr['EMAIL'];
		$MOBILE = $dataArr['MOBILE'];
		$DOB = $dataArr['DOB'];
		$GENDER = $dataArr['GENDER'];
		$educationalQualification = $dataArr['educationalQualification'];
		$PANCARD = $dataArr['PANCARD'];
		$monthlyInCome = $dataArr['monthlyInCome'];
		$address = $dataArr['address'];
		$address2 = $dataArr['address2'];
		$city = $dataArr['city'];
		$state = $dataArr['state'];
		$pincode = $dataArr['pincode'];
		$permaddress = $dataArr['permaddress'];
		$permaddress2 = $dataArr['permaddress2'];
		$permcity = $dataArr['permcity'];
		$permstate = $dataArr['permstate'];
		$permpincode = $dataArr['permpincode'];
		$employmentType = $dataArr['employmentType'];
		$companyName = $dataArr['companyName'];
		$O_ADDRESS = $dataArr['O_ADDRESS'];
		$O_ADDRESS2 = $dataArr['O_ADDRESS2'];
		$O_City = $dataArr['O_City'];
		$O_State = $dataArr['O_State'];
		$O_Pincode = $dataArr['O_Pincode'];
		$PHONE = $dataArr['PHONE'];
		$STD = $dataArr['STD'];
		$IP = $dataArr['IP'];
		$platinumCardBillingPreference = $dataArr['platinumCardBillingPreference'];
		
		$lead_source = $extraDataArr['lead_source'];
		
		$Username = "dealsforloan";
		$Password = "P@dea@!@()apm!lo#an!";

		$xmstr='<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:tem="http://tempuri.org/">
		   <soapenv:Header>
			  <tem:AuthHeader>      
				 <tem:Username>'.$Username.'</tem:Username>      
				 <tem:Password>'.$Password.'</tem:Password>
			  </tem:AuthHeader>
		   </soapenv:Header>
		   <soapenv:Body>
			  <tem:submitApplication>      
				<tem:chosenCard>'.$chosenCard.'</tem:chosenCard>      
				<tem:FNAME>'.$FNAME.'</tem:FNAME>      
				<tem:MNAME>'.$MNAME.'</tem:MNAME>      
				<tem:LNAME>'.$LNAME.'</tem:LNAME>      
				<tem:EMAIL>'.$EMAIL.'</tem:EMAIL>      
				<tem:MOBILE>'.$MOBILE.'</tem:MOBILE>      
				<tem:DOB>'.$DOB.'</tem:DOB>      
				<tem:GENDER>'.$GENDER.'</tem:GENDER>      
				<tem:educationalQualification>'.$educationalQualification.'</tem:educationalQualification>      
				<tem:aadharnumber></tem:aadharnumber>      
				<tem:PANCARD>'.$PANCARD.'</tem:PANCARD>      
				<tem:monthlyInCome>'.$monthlyInCome.'</tem:monthlyInCome>      
				<tem:address>'.$address.'</tem:address>      
				<tem:address2>'.$address2.'</tem:address2>      
				<tem:address3></tem:address3>      
				<tem:city>'.$city.'</tem:city>      
				<tem:state>'.$state.'</tem:state>      
				<tem:pincode>'.$pincode.'</tem:pincode>      
				<tem:peraddresssameascurr>yes</tem:peraddresssameascurr>      
				<tem:permaddress>'.$permaddress.'</tem:permaddress>      
				<tem:permaddress2>'.$permaddress2.'</tem:permaddress2>      
				<tem:permaddress3></tem:permaddress3>      
				<tem:permcity>'.$permcity.'</tem:permcity>      
				<tem:permstate>'.$permstate.'</tem:permstate>      
				<tem:permpincode>'.$permpincode.'</tem:permpincode>      
				<tem:jetPriviligeMember>N</tem:jetPriviligeMember>      
				<tem:jetPriviligeMembershipNumber></tem:jetPriviligeMembershipNumber>      
				<tem:JetPriviligeMembershipTier></tem:JetPriviligeMembershipTier>      
				<tem:jetStatementTobeSentTO></tem:jetStatementTobeSentTO>      
				<tem:employmentType>'.$employmentType.'</tem:employmentType>      
				<tem:companyName>'.$companyName.'</tem:companyName>      
				<tem:O_ADDRESS>'.$O_ADDRESS.'</tem:O_ADDRESS>      
				<tem:O_ADDRESS2>'.$O_ADDRESS2.'</tem:O_ADDRESS2>      
				<tem:O_ADDRESS3></tem:O_ADDRESS3>      
				<tem:O_City>'.$O_City.'</tem:O_City>      
				<tem:O_State>'.$O_State.'</tem:O_State>      
				<tem:O_Pincode>'.$O_Pincode.'</tem:O_Pincode>      
				<tem:PHONE>'.$PHONE.'</tem:PHONE>      
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
				<tem:platinumCardBillingPreference>'.$platinumCardBillingPreference.'</tem:platinumCardBillingPreference>
			  </tem:submitApplication>
		   </soapenv:Body>
		</soapenv:Envelope>';
		//echo $xmstr;exit;
		
		//Update Request in table credit_card_banks_apply
		$RequestDataArray = array("request_data" =>$xmstr, "last_updated"=>$Dated);
		$RequestWhereCond ="(id='".$ccba_id."')";
		Mainupdatefunc ('credit_card_banks_apply', $RequestDataArray, $RequestWhereCond);
		
		//Insert Request in table credit_card_banks_apply_log
		$RequestDataArrayLog = array("id"=>$ccba_id, "cc_requestid" =>$RequestID, "applied_bankname"=>"American Express","applied_cardname" =>$chosenCard, "request_data" => $xmstr, "lead_source" => $lead_source, "date_created" => $Dated);
		$ccba_logid = Maininsertfunc('credit_card_banks_apply_log', $RequestDataArrayLog);

		//Hit Amex Webservice
		$url="https://www.americanexpressindia.co.in/webservices/singleform/dealsforloan.asmx?wsdl";
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/xml'));
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "$xmstr");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$output = curl_exec($ch);
		
		//Update Response in table credit_card_banks_apply
		$ResponseDataArray = array("response_data" =>$output);
		$ResponseWhereCond ="(id='".$ccba_id."')";
		Mainupdatefunc ('credit_card_banks_apply', $ResponseDataArray, $ResponseWhereCond);
		
		//Update Response in table credit_card_banks_apply_log
		$ResponseDataArrayLog = array("response_data" => $output, "date_modified" => $Dated);
		$ResponseWhereCondLog ="(logid='".$ccba_logid."')";
		Mainupdatefunc ('credit_card_banks_apply_log', $ResponseDataArrayLog, $ResponseWhereCondLog);
		
		return $output;
	}


	function AmexWebserviceUAT($dataArr, $extraDataArr, $ccba_id){
		$Dated=ExactServerdate();
		
		//echo '<pre>';print_r($dataArr);exit;
		
		$RequestID = $dataArr['RequestID'];
		$chosenCard = $dataArr['chosenCard'];
		$FNAME = $dataArr['FNAME'];
		$MNAME = $dataArr['MNAME'];
		$LNAME = $dataArr['LNAME'];
		$EMAIL = $dataArr['EMAIL'];
		$MOBILE = $dataArr['MOBILE'];
		$DOB = $dataArr['DOB'];
		$GENDER = $dataArr['GENDER'];
		$educationalQualification = $dataArr['educationalQualification'];
		$PANCARD = $dataArr['PANCARD'];
		$monthlyInCome = $dataArr['monthlyInCome'];
		$address = $dataArr['address'];
		$address2 = $dataArr['address2'];
		$city = $dataArr['city'];
		$state = $dataArr['state'];
		$pincode = $dataArr['pincode'];
		$permaddress = $dataArr['permaddress'];
		$permaddress2 = $dataArr['permaddress2'];
		$permcity = $dataArr['permcity'];
		$permstate = $dataArr['permstate'];
		$permpincode = $dataArr['permpincode'];
		$employmentType = $dataArr['employmentType'];
		$companyName = $dataArr['companyName'];
		$O_ADDRESS = $dataArr['O_ADDRESS'];
		$O_ADDRESS2 = $dataArr['O_ADDRESS2'];
		$O_City = $dataArr['O_City'];
		$O_State = $dataArr['O_State'];
		$O_Pincode = $dataArr['O_Pincode'];
		$PHONE = $dataArr['PHONE'];
		$STD = $dataArr['STD'];
		$IP = $dataArr['IP'];
		$platinumCardBillingPreference = $dataArr['platinumCardBillingPreference'];
		
		$lead_source = $extraDataArr['lead_source'];
		
		$Username = "dealsforloanStaging";
		$Password = "U@Tdeaqo!lo#qn!";

		$xmstr='<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:tem="http://tempuri.org/">
		   <soapenv:Header>
			  <tem:AuthHeader>      
				 <tem:Username>'.$Username.'</tem:Username>      
				 <tem:Password>'.$Password.'</tem:Password>
			  </tem:AuthHeader>
		   </soapenv:Header>
		   <soapenv:Body>
			  <tem:submitApplication>      
				<tem:chosenCard>'.$chosenCard.'</tem:chosenCard>      
				<tem:FNAME>'.$FNAME.'</tem:FNAME>      
				<tem:MNAME>'.$MNAME.'</tem:MNAME>      
				<tem:LNAME>'.$LNAME.'</tem:LNAME>      
				<tem:EMAIL>'.$EMAIL.'</tem:EMAIL>      
				<tem:MOBILE>'.$MOBILE.'</tem:MOBILE>      
				<tem:DOB>'.$DOB.'</tem:DOB>      
				<tem:GENDER>'.$GENDER.'</tem:GENDER>      
				<tem:educationalQualification>'.$educationalQualification.'</tem:educationalQualification>      
				<tem:aadharnumber></tem:aadharnumber>      
				<tem:PANCARD>'.$PANCARD.'</tem:PANCARD>      
				<tem:monthlyInCome>'.$monthlyInCome.'</tem:monthlyInCome>      
				<tem:address>'.$address.'</tem:address>      
				<tem:address2>'.$address2.'</tem:address2>      
				<tem:address3></tem:address3>      
				<tem:city>'.$city.'</tem:city>      
				<tem:state>'.$state.'</tem:state>      
				<tem:pincode>'.$pincode.'</tem:pincode>      
				<tem:peraddresssameascurr>yes</tem:peraddresssameascurr>      
				<tem:permaddress>'.$permaddress.'</tem:permaddress>      
				<tem:permaddress2>'.$permaddress2.'</tem:permaddress2>      
				<tem:permaddress3></tem:permaddress3>      
				<tem:permcity>'.$permcity.'</tem:permcity>      
				<tem:permstate>'.$permstate.'</tem:permstate>      
				<tem:permpincode>'.$permpincode.'</tem:permpincode>      
				<tem:jetPriviligeMember>N</tem:jetPriviligeMember>      
				<tem:jetPriviligeMembershipNumber></tem:jetPriviligeMembershipNumber>      
				<tem:JetPriviligeMembershipTier></tem:JetPriviligeMembershipTier>      
				<tem:jetStatementTobeSentTO></tem:jetStatementTobeSentTO>      
				<tem:employmentType>'.$employmentType.'</tem:employmentType>      
				<tem:companyName>'.$companyName.'</tem:companyName>      
				<tem:O_ADDRESS>'.$O_ADDRESS.'</tem:O_ADDRESS>      
				<tem:O_ADDRESS2>'.$O_ADDRESS2.'</tem:O_ADDRESS2>      
				<tem:O_ADDRESS3></tem:O_ADDRESS3>      
				<tem:O_City>'.$O_City.'</tem:O_City>      
				<tem:O_State>'.$O_State.'</tem:O_State>      
				<tem:O_Pincode>'.$O_Pincode.'</tem:O_Pincode>      
				<tem:PHONE>'.$PHONE.'</tem:PHONE>      
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
				<tem:platinumCardBillingPreference>'.$platinumCardBillingPreference.'</tem:platinumCardBillingPreference>
			  </tem:submitApplication>
		   </soapenv:Body>
		</soapenv:Envelope>';
		//echo $xmstr;exit;
		
		//Update Request in table credit_card_banks_apply
		$RequestDataArray = array("request_data" =>$xmstr, "last_updated"=>$Dated);
		$RequestWhereCond ="(id='".$ccba_id."')";
		Mainupdatefunc ('credit_card_banks_apply', $RequestDataArray, $RequestWhereCond);
		
		//Insert Request in table credit_card_banks_apply_log
		$RequestDataArrayLog = array("id"=>$ccba_id, "cc_requestid" =>$RequestID, "applied_bankname"=>"American Express","applied_cardname" =>$chosenCard, "request_data" => $xmstr, "lead_source" => $lead_source, "date_created" => $Dated);
		$ccba_logid = Maininsertfunc('credit_card_banks_apply_log', $RequestDataArrayLog);

		//Hit Amex Webservice
		$url="https://www.americanexpressindia.co.in/webservices/singleform/dealsforloanUAT.asmx?wsdl";
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/xml'));
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "$xmstr");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$output = curl_exec($ch);
		
		//Update Response in table credit_card_banks_apply
		$ResponseDataArray = array("response_data" =>$output);
		$ResponseWhereCond ="(id='".$ccba_id."')";
		Mainupdatefunc ('credit_card_banks_apply', $ResponseDataArray, $ResponseWhereCond);
		
		//Update Response in table credit_card_banks_apply_log
		$ResponseDataArrayLog = array("response_data" => $output, "date_modified" => $Dated);
		$ResponseWhereCondLog ="(logid='".$ccba_logid."')";
		Mainupdatefunc ('credit_card_banks_apply_log', $ResponseDataArrayLog, $ResponseWhereCondLog);
		
		return $output;
	}


	function SBIWebserviceUAT($dataArr, $extraDataArr, $process_type, $sbiccid){
		$Dated=ExactServerdate();

		$RequestID = $dataArr['RequestID'];
		$LeadRefNo = $dataArr['LeadRefNo'];
		$SourceCode = $dataArr['SourceCode'];
		$PromoCode = $dataArr['PromoCode'];
		$CardType = $dataArr['CardType'];
		$FirstName = $dataArr['FirstName'];
		$MiddleName = $dataArr['MiddleName'];
		$LastName = $dataArr['LastName'];
		$DOB = $dataArr['DOB'];
		$Mobile = $dataArr['Mobile'];
		$Gender = $dataArr['Gender'];
		$Qualification = $dataArr['Qualification'];
		$PAN = $dataArr['PAN'];
		$EmailAddress = $dataArr['EmailAddress'];
		$ResiAddress1 = $dataArr['ResiAddress1'];
		$ResiAddress2 = $dataArr['ResiAddress2'];
		$ResiAddress3 = $dataArr['ResiAddress3'];
		$ResiCity = $dataArr['ResiCity'];
		$ResiState = $dataArr['ResiState'];
		$ResiPin = $dataArr['ResiPin'];
		$ResiPhone = $dataArr['ResiPhone'];
		$ResiStdCode = $dataArr['ResiStdCode'];
		$OccupationType = $dataArr['OccupationType'];
		$Designation = $dataArr['Designation'];
		$CompanyName = $dataArr['CompanyName'];
		$OfficeAddress1 = $dataArr['OfficeAddress1'];
		$OfficeAddress2 = $dataArr['OfficeAddress2'];
		$OfficeAddress3 = $dataArr['OfficeAddress3'];
		$OfficePhone = $dataArr['OfficePhone'];
		$OfficeStdCode = $dataArr['OfficeStdCode'];
		$OfficeState = $dataArr['OfficeState'];
		$OfficeCity = $dataArr['OfficeCity'];
		$OfficePin = $dataArr['OfficePin'];
		$TextSpareField2 = $dataArr['TextSpareField2'];
		$TextSpareField3 = $dataArr['TextSpareField3'];
		$DateSpareField1 = $dataArr['DateSpareField1'];
		$DateSpareField2 = $dataArr['DateSpareField2'];
		$DateSpareField3 = $dataArr['DateSpareField3'];
		$DateSpareField4 = $dataArr['DateSpareField4'];
		$DateSpareField5 = $dataArr['DateSpareField5'];
		$BankName = $dataArr['BankName'];
		$AccountNumber = $dataArr['AccountNumber'];
		
		$TextSpareField1Prefix = (isset($dataArr['TextSpareField1Prefix']) && !empty($dataArr['TextSpareField1Prefix'])) ? $dataArr['TextSpareField1Prefix'] : 'D4L';
		$TextSpareField1 = $TextSpareField1Prefix.$RequestID;
		
		$lms_process = $extraDataArr['lms_process'];
		$agent_id = $extraDataArr['agent_id'];
		
		//UAT credentials
		$username=555555555;
		$password="Los@123";
		$url = 'http://servicetest.gecapital1.glb.gemoney.in/DevWebService/LOSWebApp/services/ApplicationIngestionService?wsdl';
		
		$xmlstr='<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:qde="http://qde.service.los" xmlns:xsd="http://to.service.los/xsd">
			<soapenv:Header/>
			<soapenv:Body>
				<qde:invoke>         
					<qde:losRequest>           
					<xsd:data>
						<![CDATA[
						<ApplicationIngestionRequest>
						<LeadRefNo>'.$LeadRefNo.'</LeadRefNo>
						<BranchCode></BranchCode>
						<SourceCode>'.$SourceCode.'</SourceCode>
						<SECode>DEAl4LOANS</SECode>
						<PromoCode>'.$PromoCode.'</PromoCode>
						<CardType>'.$CardType.'</CardType>
						<PromoGroup>EA</PromoGroup>
						<ChannelCode>EAPL</ChannelCode>
						<Salutation>1</Salutation>
						<FirstName>'.trim(strtoupper($FirstName)).'</FirstName>
						<MiddleName>'.strtoupper($MiddleName).'</MiddleName>
						<LastName>'.trim(strtoupper($LastName)).'</LastName>
						<DOB>'.$DOB.'</DOB>
						<Mobile>'.$Mobile.'</Mobile>
						<Gender>'.$Gender.'</Gender>
						<Qualification>'.strtoupper($Qualification).'</Qualification>
						<PAN>'.strtoupper($PAN).'</PAN>
						<EmailAddress>'.trim($EmailAddress).'</EmailAddress>
						<ResiAddress1>'.strtoupper($ResiAddress1).'</ResiAddress1>
						<ResiAddress2>'.strtoupper($ResiAddress2).'</ResiAddress2>
						<ResiAddress3>'.strtoupper($ResiAddress3).'</ResiAddress3>
						<ResiCity>'.$ResiCity.'</ResiCity>
						<ResiState>'.$ResiState.'</ResiState>
						<ResiPin>'.$ResiPin.'</ResiPin>
						<ResiPhone>'.trim($ResiPhone).'</ResiPhone>
						<ResiStdCode>'.$ResiStdCode.'</ResiStdCode>
						<OccupationType>'.$OccupationType.'</OccupationType>
						<AlternateCardNo></AlternateCardNo>
						<Designation>'.$Designation.'</Designation>
						<CompanyName>'.trim($CompanyName).'</CompanyName>
						<NatureOfBusiness>A</NatureOfBusiness>
						<OfficeAddress1>'.strtoupper($OfficeAddress1).'</OfficeAddress1>
						<OfficeAddress2>'.strtoupper($OfficeAddress2).'</OfficeAddress2>
						<OfficeAddress3>'.strtoupper($OfficeAddress3).'</OfficeAddress3>
						<OfficePhone>'.trim($OfficePhone).'</OfficePhone>
						<OfficeStdCode>'.trim($OfficeStdCode).'</OfficeStdCode>
						<OfficeState>'.$OfficeState.'</OfficeState>
						<OfficeCity>'.$OfficeCity.'</OfficeCity>
						<YearsOfCurrentEmployment>2</YearsOfCurrentEmployment>
						<OfficePin>'.$OfficePin.'</OfficePin>
						<TextSpareField1>'.$TextSpareField1.'</TextSpareField1>
						<TextSpareField2>'.$TextSpareField2.'</TextSpareField2>
						<TextSpareField3>'.$TextSpareField3.'</TextSpareField3>
						<TextSpareField4>1</TextSpareField4>
						<TextSpareField5>1</TextSpareField5>
						<NumericSpareField1>1</NumericSpareField1>
						<NumericSpareField2>1</NumericSpareField2>
						<NumericSpareField3>1</NumericSpareField3>
						<NumericSpareField4>1</NumericSpareField4>
						<NumericSpareField5>1</NumericSpareField5>
						<DateSpareField1>'.$DateSpareField1.'</DateSpareField1>
						<DateSpareField2>'.$DateSpareField2.'</DateSpareField2>
						<DateSpareField3>'.$DateSpareField3.'</DateSpareField3>
						<DateSpareField4>'.$DateSpareField4.'</DateSpareField4>
						<DateSpareField5>'.$DateSpareField5.'</DateSpareField5>
						<EmployeePFNumber></EmployeePFNumber>
						<BranchManagerPFNumber></BranchManagerPFNumber>
						<PriorityFlag>1</PriorityFlag>
						<DateOfPickup></DateOfPickup>
						<TimeOfPickup></TimeOfPickup>
						<StatementPreference>E</StatementPreference>
						<LoyaltyChannel></LoyaltyChannel>
						<LoyaltyNumber></LoyaltyNumber>
						<ActualFulfillmentDeviation>N</ActualFulfillmentDeviation>
						<PhysicalAlreadyReceived>N</PhysicalAlreadyReceived>
						<FathersName></FathersName>
						<MothersMaidenName></MothersMaidenName>
						<ResiLandmark></ResiLandmark>
						<OfficeLandmark></OfficeLandmark>
						<BankName>'.$BankName.'</BankName>
						<AccountNumber>'.$AccountNumber.'</AccountNumber>
						<SourceOfApplication></SourceOfApplication>
						</ApplicationIngestionRequest>
						]]>
					</xsd:data>
					<xsd:requestid></xsd:requestid>            
					<xsd:userCtx>               
					<xsd:password>'.$password.'</xsd:password>              
					<xsd:userId>'.$username.'</xsd:userId>
					</xsd:userCtx>
					</qde:losRequest>
				</qde:invoke>
			</soapenv:Body>
		</soapenv:Envelope>';
		//echo $xmlstr;
		
		//Update Request in table sbi_credit_card_5633
		$RequestDataArray = array("request_xml" =>$xmlstr, "webservice_flag"=>1, "first_dated"=>$Dated, "process_type"=>$process_type);
		$RequestWhereCond ="(sbiccid='".$sbiccid."')";
		Mainupdatefunc ('sbi_credit_card_5633', $RequestDataArray, $RequestWhereCond);
		
		//Insert/Update Request in table sbi_credit_card_5633_log
		$checkscclqry="SELECT sbicclogid FROM sbi_credit_card_5633_log WHERE (cc_requestid=".$RequestID.")";
		$checkscclresult=d4l_ExecQuery($checkscclqry);
		$checkscclrow=d4l_mysql_fetch_array($checkscclresult);
		if($checkscclrow["sbicclogid"]>0)
		{
			$RequestDataArraySccl = array("request_xml" =>$xmlstr, "webservice_flag"=>1, "first_dated"=>$Dated);
			$RequestWhereCondSccl ="(sbicclogid='".$checkscclrow["sbicclogid"]."')";
			Mainupdatefunc ('sbi_credit_card_5633_log', $RequestDataArraySccl, $RequestWhereCondSccl);
			$sbicclogid = $checkscclrow["sbicclogid"];
		}
		else
		{
			$RequestDataArraySccl = array("cc_requestid"=>$RequestID, "sbiccid"=>$sbiccid, "request_xml" =>$xmlstr, "webservice_flag"=>1, "first_dated"=>$Dated);
			$sbicclogid = Maininsertfunc("sbi_credit_card_5633_log", $RequestDataArraySccl);
		}
		
		//Insert Request in table webservice_log_sbi
		$RequestDataArrayWls = array("cc_requestid"=>$RequestID, "sbiccid"=>$sbiccid, "request_xml" =>$xmlstr, "webservice_flag"=>1, "first_dated"=>$Dated);
		$wls_sbicclogid = Maininsertfunc("webservice_log_sbi", $RequestDataArrayWls);

		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/xml'));
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "$xmlstr");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$output = curl_exec($ch);
		curl_close($ch);
		//echo '<pre>';print_r($output);

		$xml_string = str_replace("<?xml version='1.0' encoding='UTF-8'?>", '<?xml version="1.0" encoding="UTF-8"?>', $output);
		$xml_string = str_replace("&lt;", "<", $xml_string);
		$xml_string = str_replace("&gt;", ">", $xml_string);
		$xml_string = str_ireplace('<?xml version="1.0" encoding="UTF-8"?><soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/"><soapenv:Body><qde:invokeResponse xmlns:qde="http://qde.service.los"><qde:return><ns1:data xmlns:ns1="http://to.service.los/xsd">',"", $xml_string );
		//$xml_string = str_ireplace('</ns1:data>',"", $xml_string );
		$xml_string = str_ireplace('</qde:return></qde:invokeResponse></soapenv:Body></soapenv:Envelope>',"", $xml_string );
		list($firstxml, $secondxml)= split ("</ns1:data>", $xml_string);
		$xml = simplexml_load_string($firstxml);
		//echo '<pre>';print_r($xml);

		$LeadRefNumber = $xml->LeadRefNumber;
		$ApplicationNumber = $xml->ApplicationNumber;
		$StatusCode = $xml->StatusCode;
		$ProcessingStatus = $xml->ProcessingStatus;
		$CreditLimit = $xml->CreditLimit;
		$Message = $xml->Messages->Message;
		$code = $xml->code;
		$message = $xml->message;

		$pushflag=0;
		if($ProcessingStatus==1 || $ProcessingStatus==2){
			$secondpushflag=1;
		}
		else{
			$secondpushflag=0;
		}
		if(strlen($LeadRefNumber)>0)
		{
			//Update Response in table sbi_credit_card_5633
			$ResponseDataArray = array("response_xml" =>$output, "LeadRefNumber" =>$LeadRefNumber, "ApplicationNumber" =>$ApplicationNumber, "StatusCode" =>$StatusCode, "ProcessingStatus" =>$ProcessingStatus, "CreditLimit" =>$CreditLimit, "Messages" =>$Message, "secondpushflag"=>$secondpushflag, "pushflag"=>$pushflag, "webservice_flag"=>2);
			$ResponseWhereCond ="(sbiccid='".$sbiccid."')";
			Mainupdatefunc ('sbi_credit_card_5633', $ResponseDataArray, $ResponseWhereCond);

			//Update Response in table sbi_credit_card_5633_log
			$RequestDataArraySccl = array("response_xml" =>$output, "LeadRefNumber" =>$LeadRefNumber, "ApplicationNumber" =>$ApplicationNumber, "StatusCode" =>$StatusCode, "ProcessingStatus" =>$ProcessingStatus, "CreditLimit" =>$CreditLimit, "Messages" =>$Message, "code"=>$code, "message"=>$message, "sbiccid"=>$sbiccid, "first_other"=>$secondxml, "first_dated"=>$Dated, "webservice_flag"=>2);
			$RequestWhereCondSccl ="(sbicclogid='".$sbicclogid."')";
			Mainupdatefunc ('sbi_credit_card_5633_log', $RequestDataArraySccl, $RequestWhereCondSccl);
		}

		if($process_type=='direct')
		{
			//Insert Log in table sbi_credit_card_5633_log_direct
			$RequestDataArraySccld = array("cc_requestid"=>$RequestID, "request_xml" =>$xmlstr, "response_xml" =>$output, "LeadRefNumber" =>$LeadRefNumber, "ApplicationNumber" =>$ApplicationNumber, "StatusCode" =>$StatusCode, "ProcessingStatus" =>$ProcessingStatus, "CreditLimit" =>$CreditLimit, "Messages" =>$Message, "code"=>$code, "message"=>$message, "sbiccid"=>$sbiccid, "first_other"=>$secondxml, "first_dated"=>$Dated);
			$InsertSccldLogValue = Maininsertfunc("sbi_credit_card_5633_log_direct", $RequestDataArraySccld);
		}

		//Update Response in table webservice_log_sbi
		$RequestDataArrayWls = array("response_xml" =>$output, "LeadRefNumber" =>$LeadRefNumber, "ApplicationNumber" =>$ApplicationNumber, "StatusCode" =>$StatusCode, "ProcessingStatus" =>$ProcessingStatus, "CreditLimit" =>$CreditLimit, "Messages" =>$Message, "code"=>$code, "message"=>$message, "sbiccid"=>$sbiccid, "first_other"=>$secondxml, "first_dated"=>$Dated, "webservice_flag"=>2, "lms_process"=>$lms_process, "agent_id"=>$agent_id);
		$RequestWhereCondWls ="(sbicclogid='".$wls_sbicclogid."')";
		Mainupdatefunc ('webservice_log_sbi', $RequestDataArrayWls, $RequestWhereCondWls);
		
		$responseArray = array();
		$responseArray['LeadRefNumber'] = $LeadRefNumber;
		$responseArray['ApplicationNumber'] = $ApplicationNumber;
		$responseArray['StatusCode'] = $StatusCode;
		$responseArray['ProcessingStatus'] = $ProcessingStatus;
		$responseArray['CreditLimit'] = $CreditLimit;
		$responseArray['Message'] = $Message;
		$responseArray['code'] = $code;
		$responseArray['message'] = $message;
		//echo '<pre>';print_r($responseArray);
		return $responseArray;
	}


	function SBIWebservice($dataArr, $extraDataArr, $process_type, $sbiccid){
		$Dated=ExactServerdate();

		$RequestID = $dataArr['RequestID'];
		$LeadRefNo = $dataArr['LeadRefNo'];
		$SourceCode = $dataArr['SourceCode'];
		$PromoCode = $dataArr['PromoCode'];
		$CardType = $dataArr['CardType'];
		$FirstName = $dataArr['FirstName'];
		$MiddleName = $dataArr['MiddleName'];
		$LastName = $dataArr['LastName'];
		$DOB = $dataArr['DOB'];
		$Mobile = $dataArr['Mobile'];
		$Gender = $dataArr['Gender'];
		$Qualification = $dataArr['Qualification'];
		$PAN = $dataArr['PAN'];
		$EmailAddress = $dataArr['EmailAddress'];
		$ResiAddress1 = $dataArr['ResiAddress1'];
		$ResiAddress2 = $dataArr['ResiAddress2'];
		$ResiAddress3 = $dataArr['ResiAddress3'];
		$ResiCity = $dataArr['ResiCity'];
		$ResiState = $dataArr['ResiState'];
		$ResiPin = $dataArr['ResiPin'];
		$ResiPhone = $dataArr['ResiPhone'];
		$ResiStdCode = $dataArr['ResiStdCode'];
		$OccupationType = $dataArr['OccupationType'];
		$Designation = $dataArr['Designation'];
		$CompanyName = $dataArr['CompanyName'];
		$OfficeAddress1 = $dataArr['OfficeAddress1'];
		$OfficeAddress2 = $dataArr['OfficeAddress2'];
		$OfficeAddress3 = $dataArr['OfficeAddress3'];
		$OfficePhone = $dataArr['OfficePhone'];
		$OfficeStdCode = $dataArr['OfficeStdCode'];
		$OfficeState = $dataArr['OfficeState'];
		$OfficeCity = $dataArr['OfficeCity'];
		$OfficePin = $dataArr['OfficePin'];
		$TextSpareField2 = $dataArr['TextSpareField2'];
		$TextSpareField3 = $dataArr['TextSpareField3'];
		$DateSpareField1 = $dataArr['DateSpareField1'];
		$DateSpareField2 = $dataArr['DateSpareField2'];
		$DateSpareField3 = $dataArr['DateSpareField3'];
		$DateSpareField4 = $dataArr['DateSpareField4'];
		$DateSpareField5 = $dataArr['DateSpareField5'];
		$BankName = $dataArr['BankName'];
		$AccountNumber = $dataArr['AccountNumber'];
		
		$TextSpareField1Prefix = (isset($dataArr['TextSpareField1Prefix']) && !empty($dataArr['TextSpareField1Prefix'])) ? $dataArr['TextSpareField1Prefix'] : 'D4L';
		$TextSpareField1 = $TextSpareField1Prefix.$RequestID;
		
		$lms_process = $extraDataArr['lms_process'];
		$agent_id = $extraDataArr['agent_id'];
		
		//UAT credentials
		$username=79584822;
		$password="de@l4loan5";
		//$url = 'https://napsservices.originations.gecapital.in/LOSWebApp/services/ApplicationIngestionService?wsdl';
		$url = 'https://napsservices.napsonline.com/LOSWebApp/services/ApplicationIngestionService?wsdl';
		
		$xmlstr='<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:qde="http://qde.service.los" xmlns:xsd="http://to.service.los/xsd">
			<soapenv:Header/>
			<soapenv:Body>
				<qde:invoke>         
					<qde:losRequest>           
					<xsd:data>
						<![CDATA[
						<ApplicationIngestionRequest>
						<LeadRefNo>'.$LeadRefNo.'</LeadRefNo>
						<BranchCode></BranchCode>
						<SourceCode>'.$SourceCode.'</SourceCode>
						<SECode>DEAl4LOANS</SECode>
						<PromoCode>'.$PromoCode.'</PromoCode>
						<CardType>'.$CardType.'</CardType>
						<PromoGroup>EA</PromoGroup>
						<ChannelCode>EAPL</ChannelCode>
						<Salutation>1</Salutation>
						<FirstName>'.trim(strtoupper($FirstName)).'</FirstName>
						<MiddleName>'.strtoupper($MiddleName).'</MiddleName>
						<LastName>'.trim(strtoupper($LastName)).'</LastName>
						<DOB>'.$DOB.'</DOB>
						<Mobile>'.$Mobile.'</Mobile>
						<Gender>'.$Gender.'</Gender>
						<Qualification>'.strtoupper($Qualification).'</Qualification>
						<PAN>'.strtoupper($PAN).'</PAN>
						<EmailAddress>'.trim($EmailAddress).'</EmailAddress>
						<ResiAddress1>'.strtoupper($ResiAddress1).'</ResiAddress1>
						<ResiAddress2>'.strtoupper($ResiAddress2).'</ResiAddress2>
						<ResiAddress3>'.strtoupper($ResiAddress3).'</ResiAddress3>
						<ResiCity>'.$ResiCity.'</ResiCity>
						<ResiState>'.$ResiState.'</ResiState>
						<ResiPin>'.$ResiPin.'</ResiPin>
						<ResiPhone>'.trim($ResiPhone).'</ResiPhone>
						<ResiStdCode>'.$ResiStdCode.'</ResiStdCode>
						<OccupationType>'.$OccupationType.'</OccupationType>
						<AlternateCardNo></AlternateCardNo>
						<Designation>'.$Designation.'</Designation>
						<CompanyName>'.trim($CompanyName).'</CompanyName>
						<NatureOfBusiness>A</NatureOfBusiness>
						<OfficeAddress1>'.strtoupper($OfficeAddress1).'</OfficeAddress1>
						<OfficeAddress2>'.strtoupper($OfficeAddress2).'</OfficeAddress2>
						<OfficeAddress3>'.strtoupper($OfficeAddress3).'</OfficeAddress3>
						<OfficePhone>'.trim($OfficePhone).'</OfficePhone>
						<OfficeStdCode>'.trim($OfficeStdCode).'</OfficeStdCode>
						<OfficeState>'.$OfficeState.'</OfficeState>
						<OfficeCity>'.$OfficeCity.'</OfficeCity>
						<YearsOfCurrentEmployment>2</YearsOfCurrentEmployment>
						<OfficePin>'.$OfficePin.'</OfficePin>
						<TextSpareField1>'.$TextSpareField1.'</TextSpareField1>
						<TextSpareField2>'.$TextSpareField2.'</TextSpareField2>
						<TextSpareField3>'.$TextSpareField3.'</TextSpareField3>
						<TextSpareField4>1</TextSpareField4>
						<TextSpareField5>1</TextSpareField5>
						<NumericSpareField1>1</NumericSpareField1>
						<NumericSpareField2>1</NumericSpareField2>
						<NumericSpareField3>1</NumericSpareField3>
						<NumericSpareField4>1</NumericSpareField4>
						<NumericSpareField5>1</NumericSpareField5>
						<DateSpareField1>'.$DateSpareField1.'</DateSpareField1>
						<DateSpareField2>'.$DateSpareField2.'</DateSpareField2>
						<DateSpareField3>'.$DateSpareField3.'</DateSpareField3>
						<DateSpareField4>'.$DateSpareField4.'</DateSpareField4>
						<DateSpareField5>'.$DateSpareField5.'</DateSpareField5>
						<EmployeePFNumber></EmployeePFNumber>
						<BranchManagerPFNumber></BranchManagerPFNumber>
						<PriorityFlag>1</PriorityFlag>
						<DateOfPickup></DateOfPickup>
						<TimeOfPickup></TimeOfPickup>
						<StatementPreference>E</StatementPreference>
						<LoyaltyChannel></LoyaltyChannel>
						<LoyaltyNumber></LoyaltyNumber>
						<ActualFulfillmentDeviation>N</ActualFulfillmentDeviation>
						<PhysicalAlreadyReceived>N</PhysicalAlreadyReceived>
						<FathersName></FathersName>
						<MothersMaidenName></MothersMaidenName>
						<ResiLandmark></ResiLandmark>
						<OfficeLandmark></OfficeLandmark>
						<BankName>'.$BankName.'</BankName>
						<AccountNumber>'.$AccountNumber.'</AccountNumber>
						<SourceOfApplication></SourceOfApplication>
						</ApplicationIngestionRequest>
						]]>
					</xsd:data>
					<xsd:requestid></xsd:requestid>            
					<xsd:userCtx>               
					<xsd:password>'.$password.'</xsd:password>              
					<xsd:userId>'.$username.'</xsd:userId>
					</xsd:userCtx>
					</qde:losRequest>
				</qde:invoke>
			</soapenv:Body>
		</soapenv:Envelope>';
		//echo $xmlstr;
		
		//Update Request in table sbi_credit_card_5633
		$RequestDataArray = array("request_xml" =>$xmlstr, "webservice_flag"=>1, "first_dated"=>$Dated, "process_type"=>$process_type);
		$RequestWhereCond ="(sbiccid='".$sbiccid."')";
		Mainupdatefunc ('sbi_credit_card_5633', $RequestDataArray, $RequestWhereCond);
		
		//Insert/Update Request in table sbi_credit_card_5633_log
		$checkscclqry="SELECT sbicclogid FROM sbi_credit_card_5633_log WHERE (cc_requestid=".$RequestID.")";
		$checkscclresult=d4l_ExecQuery($checkscclqry);
		$checkscclrow=d4l_mysql_fetch_array($checkscclresult);
		if($checkscclrow["sbicclogid"]>0)
		{
			$RequestDataArraySccl = array("request_xml" =>$xmlstr, "webservice_flag"=>1, "first_dated"=>$Dated);
			$RequestWhereCondSccl ="(sbicclogid='".$checkscclrow["sbicclogid"]."')";
			Mainupdatefunc ('sbi_credit_card_5633_log', $RequestDataArraySccl, $RequestWhereCondSccl);
			$sbicclogid = $checkscclrow["sbicclogid"];
		}
		else
		{
			$RequestDataArraySccl = array("cc_requestid"=>$RequestID, "sbiccid"=>$sbiccid, "request_xml" =>$xmlstr, "webservice_flag"=>1, "first_dated"=>$Dated);
			$sbicclogid = Maininsertfunc("sbi_credit_card_5633_log", $RequestDataArraySccl);
		}
		
		//Insert Request in table webservice_log_sbi
		$RequestDataArrayWls = array("cc_requestid"=>$RequestID, "sbiccid"=>$sbiccid, "request_xml" =>$xmlstr, "webservice_flag"=>1, "first_dated"=>$Dated);
		$wls_sbicclogid = Maininsertfunc("webservice_log_sbi", $RequestDataArrayWls);

		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/xml'));
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "$xmlstr");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$output = curl_exec($ch);
		curl_close($ch);
		//echo '<pre>';print_r($output);

		$xml_string = str_replace("<?xml version='1.0' encoding='UTF-8'?>", '<?xml version="1.0" encoding="UTF-8"?>', $output);
		$xml_string = str_replace("&lt;", "<", $xml_string);
		$xml_string = str_replace("&gt;", ">", $xml_string);
		$xml_string = str_ireplace('<?xml version="1.0" encoding="UTF-8"?><soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/"><soapenv:Body><qde:invokeResponse xmlns:qde="http://qde.service.los"><qde:return><ns1:data xmlns:ns1="http://to.service.los/xsd">',"", $xml_string );
		//$xml_string = str_ireplace('</ns1:data>',"", $xml_string );
		$xml_string = str_ireplace('</qde:return></qde:invokeResponse></soapenv:Body></soapenv:Envelope>',"", $xml_string );
		list($firstxml, $secondxml)= split ("</ns1:data>", $xml_string);
		$xml = simplexml_load_string($firstxml);
		//echo '<pre>';print_r($xml);

		$LeadRefNumber = $xml->LeadRefNumber;
		$ApplicationNumber = $xml->ApplicationNumber;
		$StatusCode = $xml->StatusCode;
		$ProcessingStatus = $xml->ProcessingStatus;
		$CreditLimit = $xml->CreditLimit;
		$Message = $xml->Messages->Message;
		$code = $xml->code;
		$message = $xml->message;

		$pushflag=0;
		if($ProcessingStatus==1 || $ProcessingStatus==2){
			$secondpushflag=1;
		}
		else{
			$secondpushflag=0;
		}
		if(strlen($LeadRefNumber)>0)
		{
			//Update Response in table sbi_credit_card_5633
			$ResponseDataArray = array("response_xml" =>$output, "LeadRefNumber" =>$LeadRefNumber, "ApplicationNumber" =>$ApplicationNumber, "StatusCode" =>$StatusCode, "ProcessingStatus" =>$ProcessingStatus, "CreditLimit" =>$CreditLimit, "Messages" =>$Message, "secondpushflag"=>$secondpushflag, "pushflag"=>$pushflag, "webservice_flag"=>2);
			$ResponseWhereCond ="(sbiccid='".$sbiccid."')";
			Mainupdatefunc ('sbi_credit_card_5633', $ResponseDataArray, $ResponseWhereCond);

			//Update Response in table sbi_credit_card_5633_log
			$RequestDataArraySccl = array("response_xml" =>$output, "LeadRefNumber" =>$LeadRefNumber, "ApplicationNumber" =>$ApplicationNumber, "StatusCode" =>$StatusCode, "ProcessingStatus" =>$ProcessingStatus, "CreditLimit" =>$CreditLimit, "Messages" =>$Message, "code"=>$code, "message"=>$message, "sbiccid"=>$sbiccid, "first_other"=>$secondxml, "first_dated"=>$Dated, "webservice_flag"=>2);
			$RequestWhereCondSccl ="(sbicclogid='".$sbicclogid."')";
			Mainupdatefunc ('sbi_credit_card_5633_log', $RequestDataArraySccl, $RequestWhereCondSccl);
		}

		if($process_type=='direct')
		{
			//Insert Log in table sbi_credit_card_5633_log_direct
			$RequestDataArraySccld = array("cc_requestid"=>$RequestID, "request_xml" =>$xmlstr, "response_xml" =>$output, "LeadRefNumber" =>$LeadRefNumber, "ApplicationNumber" =>$ApplicationNumber, "StatusCode" =>$StatusCode, "ProcessingStatus" =>$ProcessingStatus, "CreditLimit" =>$CreditLimit, "Messages" =>$Message, "code"=>$code, "message"=>$message, "sbiccid"=>$sbiccid, "first_other"=>$secondxml, "first_dated"=>$Dated);
			$InsertSccldLogValue = Maininsertfunc("sbi_credit_card_5633_log_direct", $RequestDataArraySccld);
		}

		//Update Response in table webservice_log_sbi
		$RequestDataArrayWls = array("response_xml" =>$output, "LeadRefNumber" =>$LeadRefNumber, "ApplicationNumber" =>$ApplicationNumber, "StatusCode" =>$StatusCode, "ProcessingStatus" =>$ProcessingStatus, "CreditLimit" =>$CreditLimit, "Messages" =>$Message, "code"=>$code, "message"=>$message, "sbiccid"=>$sbiccid, "first_other"=>$secondxml, "first_dated"=>$Dated, "webservice_flag"=>2, "lms_process"=>$lms_process, "agent_id"=>$agent_id);
		$RequestWhereCondWls ="(sbicclogid='".$wls_sbicclogid."')";
		Mainupdatefunc ('webservice_log_sbi', $RequestDataArrayWls, $RequestWhereCondWls);
		
		$responseArray = array();
		$responseArray['LeadRefNumber'] = $LeadRefNumber;
		$responseArray['ApplicationNumber'] = $ApplicationNumber;
		$responseArray['StatusCode'] = $StatusCode;
		$responseArray['ProcessingStatus'] = $ProcessingStatus;
		$responseArray['CreditLimit'] = $CreditLimit;
		$responseArray['Message'] = $Message;
		$responseArray['code'] = $code;
		$responseArray['message'] = $message;
		//echo '<pre>';print_r($responseArray);
		return $responseArray;
	}


	function SBIWebservice2($dataArr, $extraDataArr, $sbiccid){
		$Dated=ExactServerdate();

		$ApplicationNumber = $dataArr['ApplicationNumber'];
		$PickUpDate = $dataArr['PickUpDate'];
		$PickUpTime = $dataArr['PickUpTime'];

		//UAT credentials
		$username=79584822;
		$password="de@l4loan5";
		$url = 'https://napsservices.napsonline.com/LOSWebApp/services/LeadAllocationService?wsdl';
		
		$xmlstr='<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:qde="http://qde.service.los" xmlns:xsd="http://to.service.los/xsd">
		   <soapenv:Header/>
		   <soapenv:Body>
			  <qde:invoke>         
				 <qde:losRequest>           
					<xsd:data>
					<![CDATA[
					<LeadAllocationRequest>
					<ApplicationNumber>'.$ApplicationNumber.'</ApplicationNumber>
					<PickUpDate>'.$PickUpDate.'</PickUpDate>
					<PickUpTime>'.$PickUpTime.'</PickUpTime>
					<DocBoy></DocBoy>
					<FollowUpText></FollowUpText>
					<PickUpLocation>O</PickUpLocation>
					<NewAddress></NewAddress>
					<Disposition>AA</Disposition>
					</LeadAllocationRequest>
					]]>
					</xsd:data>
				   <xsd:requestid></xsd:requestid>            
					<xsd:userCtx>               
					   <xsd:password>de@l4loan5</xsd:password>              
					   <xsd:userId>79584822</xsd:userId>
					</xsd:userCtx>
				 </qde:losRequest>
			  </qde:invoke>
		   </soapenv:Body>
		</soapenv:Envelope>';
		//echo $xmlstr."<br>";

		$url = 'https://napsservices.napsonline.com/LOSWebApp/services/LeadAllocationService?wsdl';
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/xml'));
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "$xmlstr");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$output = curl_exec($ch);
		curl_close($ch);
		//print_r($output);

		$xml_string =  str_replace("<?xml version='1.0' encoding='UTF-8'?>", '<?xml version="1.0" encoding="UTF-8"?>', $output);
		$xml_string =  str_replace("&lt;", "<", $xml_string);
		$xml_string = str_ireplace('<?xml version="1.0" encoding="UTF-8"?><soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/"><soapenv:Body><qde:invokeResponse xmlns:qde="http://qde.service.los"><qde:return><ns1:data xmlns:ns1="http://to.service.los/xsd">',"", $xml_string );
		$xml_string = str_ireplace('</qde:return></qde:invokeResponse></soapenv:Body></soapenv:Envelope>',"", $xml_string );
		list($firstxml, $secondxml)= split ("</ns1:data>", $xml_string);
		$xml = simplexml_load_string($firstxml);

		$ApplicationNumber2 = $xml->ApplicationNumber;
		$StatusCode2 = $xml->StatusCode;
		$ProcessingStatus2 = $xml->ProcessingStatus;

		$insertDataArray = array("request2_xml" =>$xmlstr, "response2_xml" =>$output, "ApplicationNumber_2" =>$ApplicationNumber2, "StatusCode_2" =>$StatusCode2, "ProcessingStatus_2" =>$ProcessingStatus2, "second_other"=>$secondxml, "second_dated"=>$Dated );
		$wherecondition ="(sbiccid ='".$sbiccid."')";
		Mainupdatefunc ('sbi_credit_card_5633', $insertDataArray, $wherecondition);

		$responseArray = array();
		$responseArray['ApplicationNumber'] = $ApplicationNumber;
		$responseArray['StatusCode'] = $StatusCode;
		$responseArray['ProcessingStatus'] = $ProcessingStatus;
		//echo '<pre>';print_r($responseArray);
		return $responseArray;
	}


	function SBIWebserviceNoResponse($sbiccid){
		$Dated=ExactServerdate();
		
		$getDetailsSql = "SELECT RequestID, request_xml FROM sbi_credit_card_5633 WHERE sbiccid = '".$sbiccid."'";
		$getDetailsResult = d4l_ExecQuery($getDetailsSql);
		$getDetails = d4l_mysql_fetch_assoc($getDetailsResult);
		$xmlstr = $getDetails['request_xml'];
		//$xmlstr = str_replace('de@l4loan5', 'Los@123', $xmlstr);
		//$xmlstr = str_replace('79584822', '555555555', $xmlstr);
		//echo $xmlstr;exit;
		$RequestID = $getDetails['RequestID'];
		$lms_process = 'admin';
		$agent_id = '6769'; //BidderID of Admin
		
		//Production credentials
		$username=79584822;
		$password="de@l4loan5";
		$url = 'https://napsservices.napsonline.com/LOSWebApp/services/ApplicationIngestionService?wsdl';
		
		//UAT credentials
		//$username=555555555;
		///$password="Los@123";
		//$url = 'http://servicetest.gecapital1.glb.gemoney.in/DevWebService/LOSWebApp/services/ApplicationIngestionService?wsdl';
		
		//Update Request in table sbi_credit_card_5633
		$RequestDataArray = array("request_xml" =>$xmlstr, "webservice_flag"=>1, "first_dated"=>$Dated);
		$RequestWhereCond ="(sbiccid='".$sbiccid."')";
		Mainupdatefunc ('sbi_credit_card_5633', $RequestDataArray, $RequestWhereCond);
		
		//Insert/Update Request in table sbi_credit_card_5633_log
		$checkscclqry="SELECT sbicclogid FROM sbi_credit_card_5633_log WHERE (cc_requestid=".$RequestID.")";
		$checkscclresult=d4l_ExecQuery($checkscclqry);
		$checkscclrow=d4l_mysql_fetch_array($checkscclresult);
		if($checkscclrow["sbicclogid"]>0)
		{
			$RequestDataArraySccl = array("request_xml" =>$xmlstr, "webservice_flag"=>1, "first_dated"=>$Dated);
			$RequestWhereCondSccl ="(sbicclogid='".$checkscclrow["sbicclogid"]."')";
			Mainupdatefunc ('sbi_credit_card_5633_log', $RequestDataArraySccl, $RequestWhereCondSccl);
			$sbicclogid = $checkscclrow["sbicclogid"];
		}
		else
		{
			$RequestDataArraySccl = array("cc_requestid"=>$RequestID, "request_xml" =>$xmlstr, "webservice_flag"=>1, "first_dated"=>$Dated);
			$sbicclogid = Maininsertfunc("sbi_credit_card_5633_log", $RequestDataArraySccl);
		}
		
		//Insert Request in table webservice_log_sbi
		$RequestDataArrayWls = array("cc_requestid"=>$RequestID, "request_xml" =>$xmlstr, "webservice_flag"=>1, "first_dated"=>$Dated);
		$wls_sbicclogid = Maininsertfunc("webservice_log_sbi", $RequestDataArrayWls);

		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/xml'));
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "$xmlstr");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$output = curl_exec($ch);
		curl_close($ch);
		//echo '<pre>';print_r($output);exit;

		$xml_string = str_replace("<?xml version='1.0' encoding='UTF-8'?>", '<?xml version="1.0" encoding="UTF-8"?>', $output);
		$xml_string = str_replace("&lt;", "<", $xml_string);
		$xml_string = str_replace("&gt;", ">", $xml_string);
		$xml_string = str_ireplace('<?xml version="1.0" encoding="UTF-8"?><soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/"><soapenv:Body><qde:invokeResponse xmlns:qde="http://qde.service.los"><qde:return><ns1:data xmlns:ns1="http://to.service.los/xsd">',"", $xml_string );
		//$xml_string = str_ireplace('</ns1:data>',"", $xml_string );
		$xml_string = str_ireplace('</qde:return></qde:invokeResponse></soapenv:Body></soapenv:Envelope>',"", $xml_string );
		list($firstxml, $secondxml)= split ("</ns1:data>", $xml_string);
		$xml = simplexml_load_string($firstxml);
		//echo '<pre>';print_r($xml);

		$LeadRefNumber = $xml->LeadRefNumber;
		$ApplicationNumber = $xml->ApplicationNumber;
		$StatusCode = $xml->StatusCode;
		$ProcessingStatus = $xml->ProcessingStatus;
		$CreditLimit = $xml->CreditLimit;
		$Message = $xml->Messages->Message;
		$code = $xml->code;
		$message = $xml->message;

		$pushflag=0;
		if($ProcessingStatus==1 || $ProcessingStatus==2){
			$secondpushflag=1;
		}
		else{
			$secondpushflag=0;
		}
		if(strlen($LeadRefNumber)>0)
		{
			//Update Response in table sbi_credit_card_5633
			$ResponseDataArray = array("response_xml" =>$output, "LeadRefNumber" =>$LeadRefNumber, "ApplicationNumber" =>$ApplicationNumber, "StatusCode" =>$StatusCode, "ProcessingStatus" =>$ProcessingStatus, "CreditLimit" =>$CreditLimit, "Messages" =>$Message, "secondpushflag"=>$secondpushflag, "pushflag"=>$pushflag, "webservice_flag"=>2);
			$ResponseWhereCond ="(sbiccid='".$sbiccid."')";
			Mainupdatefunc ('sbi_credit_card_5633', $ResponseDataArray, $ResponseWhereCond);

			//Update Response in table sbi_credit_card_5633_log
			$RequestDataArraySccl = array("response_xml" =>$output, "LeadRefNumber" =>$LeadRefNumber, "ApplicationNumber" =>$ApplicationNumber, "StatusCode" =>$StatusCode, "ProcessingStatus" =>$ProcessingStatus, "CreditLimit" =>$CreditLimit, "Messages" =>$Message, "code"=>$code, "message"=>$message, "sbiccid"=>$sbiccid, "first_other"=>$secondxml, "first_dated"=>$Dated, "webservice_flag"=>2);
			$RequestWhereCondSccl ="(sbicclogid='".$sbicclogid."')";
			Mainupdatefunc ('sbi_credit_card_5633_log', $RequestDataArraySccl, $RequestWhereCondSccl);
		}

		if($process_type=='direct')
		{
			//Insert Log in table sbi_credit_card_5633_log_direct
			$RequestDataArraySccld = array("cc_requestid"=>$RequestID, "request_xml" =>$xmlstr, "response_xml" =>$output, "LeadRefNumber" =>$LeadRefNumber, "ApplicationNumber" =>$ApplicationNumber, "StatusCode" =>$StatusCode, "ProcessingStatus" =>$ProcessingStatus, "CreditLimit" =>$CreditLimit, "Messages" =>$Message, "code"=>$code, "message"=>$message, "sbiccid"=>$sbiccid, "first_other"=>$secondxml, "first_dated"=>$Dated);
			$InsertSccldLogValue = Maininsertfunc("sbi_credit_card_5633_log_direct", $RequestDataArraySccld);
		}

		//Update Response in table webservice_log_sbi
		$RequestDataArrayWls = array("response_xml" =>$output, "LeadRefNumber" =>$LeadRefNumber, "ApplicationNumber" =>$ApplicationNumber, "StatusCode" =>$StatusCode, "ProcessingStatus" =>$ProcessingStatus, "CreditLimit" =>$CreditLimit, "Messages" =>$Message, "code"=>$code, "message"=>$message, "sbiccid"=>$sbiccid, "first_other"=>$secondxml, "first_dated"=>$Dated, "webservice_flag"=>2, "lms_process"=>$lms_process, "agent_id"=>$agent_id);
		$RequestWhereCondWls ="(sbicclogid='".$wls_sbicclogid."')";
		Mainupdatefunc ('webservice_log_sbi', $RequestDataArrayWls, $RequestWhereCondWls);
		
		$responseArray = array();
		$responseArray['LeadRefNumber'] = $LeadRefNumber;
		$responseArray['ApplicationNumber'] = $ApplicationNumber;
		$responseArray['StatusCode'] = $StatusCode;
		$responseArray['ProcessingStatus'] = $ProcessingStatus;
		$responseArray['CreditLimit'] = $CreditLimit;
		$responseArray['Message'] = $Message;
		$responseArray['code'] = $code;
		$responseArray['message'] = $message;
		//echo '<pre>';print_r($responseArray);
		return $responseArray;
	}


	function db_connect_PDO1(){
		$dbuser	= "root"; 
		//$dbserver= "localhost"; 
		$dbserver= "localhost";
		$dbpass	= "";
		$dbname	= "deal4loans_primary"; 
		try {
		$pdo = new PDO('mysql:host='.$dbserver.';dbname=deal4loans_primary', $dbuser, $dbpass);
		$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		return ($pdo);
		} catch (PDOException $pe) {
			die("Could not connect to the database $dbname :" . $pe->getMessage());
		}
	 }
	  
	function Mainupdatefuncrachit ($table, $data, $wherecondition){
		$pdo = db_connect_PDO1();
		$setPart = array();
		$bindings = array();

		foreach ($data as $key => $value)
		{
			$setPart[] = "{$key} = :{$key}";
			$bindings[":{$key}"] = $value;
		}
		echo $sql = "UPDATE {$table} SET ".implode(', ', $setPart)." WHERE ".$wherecondition;
		echo '<br/>';
		$stmt = $pdo->prepare($sql);
		$stmt->execute($bindings);
		echo $rowcount=$stmt->rowCount();
		//print_r($stmt->debugDumpParams();

		return($rowcount);
	}
	  
	function FixString($strtofix){
		/** ESCAPES SPECIAL CHARACTERS FOR INSERTING INTO SQL **/
		if (get_magic_quotes_gpc()) { $addslash="no"; } else { $addslash="yes"; }
		if ($addslash == "yes") {  $strtofix = addslashes($strtofix); }
		$strtofix = ereg_replace(  "<", "&#60;", $strtofix );
		$strtofix = ereg_replace(  "'", "&#39;", $strtofix );
		$strtofix = ereg_replace(  "(\n)", "<BR>", $strtofix );
		return $strtofix;
	}


	function ICICIWebservice($dataArr, $ccba_table_id){
		$ApplicantFirstName = $dataArr['ApplicantFirstName'];
		$ApplicantMiddleName = $dataArr['ApplicantMiddleName'];
		$ApplicantLastName = $dataArr['ApplicantLastName'];
		$Gender = $dataArr['Gender'];
		$DateOfBirth = $dataArr['DateOfBirth'];
		$ResidenceAddress1 = $dataArr['ResidenceAddress1'];
		$ResidenceAddress2 = $dataArr['ResidenceAddress2'];
		$City = $dataArr['City'];
		$ResidencePincode = $dataArr['ResidencePincode'];
		$ResidenceState = $dataArr['ResidenceState'];
		$STDCode = $dataArr['STDCode'];
		$ResidenceMobileNo = $dataArr['ResidenceMobileNo'];
		$PanNo = $dataArr['PanNo'];
		$ICICIBankRelationship = $dataArr['ICICIBankRelationship'];
		$ICICIRelationshipNumber = $dataArr['ICICIRelationshipNumber'];
		$CustomerProfile = $dataArr['CustomerProfile'];
		$CompanyName = $dataArr['CompanyName'];
		$SalaryAccountWithOtherBank = $dataArr['SalaryAccountWithOtherBank'];
		$Total_Exp = $dataArr['Total_Exp'];
		$Income = $dataArr['Income'];
		$SalaryAccountOpened = $dataArr['SalaryAccountOpened'];
		
		$jsonurl='{"UserID": "ehj8bmnI+ML6/loUxYHxOQy/bYqCe5depANl4020mVq03TlUM3jt+hsCiQsEF+lPz33zds1tfUXAsqcgHPHT2SAHzZDVdVu/5A9IIYyV30JwRNZRfZM/i7rver3vbMpfM30O7gc577eQZqJvYjg0AfXm959kfUii760L2LAzF6g=",   "Password": "D/3TLsXOYPQyYc6ynjW8hPYycLy/3ucicv4y55s8xRnVOvG3079trwMHKEa5CS1sb6qikGzpV/1Tj/Knr4V5cwrLMkc7iaJ7utKNKg9fgG4d8On8mtlrK34YLbncwNc3ix6AsjOB6bb5oGUn1iYGeBVWXwQd+SLLWJmL0eMz18s=",
			"ChannelType":"Deal4loans", 
			"ApplicantFirstName":"'.$ApplicantFirstName.'", 
			"ApplicantMiddleName":"'.$ApplicantMiddleName.'", 
			"ApplicantLastName":"'.$ApplicantLastName.'", 
			"Gender":"'.$Gender.'", 
			"DateOfBirth":"'.$DateOfBirth.'",
			"ResidenceAddress1":"'.$ResidenceAddress1.'", 
			"ResidenceAddress2":"'.$ResidenceAddress2.'", 
			"ResidenceAddress3":"", 
			"City":"'.$City.'", 
			"ResidencePincode":"'.$ResidencePincode.'", 
			"ResidenceState":"'.$ResidenceState.'", 
			"STDCode":"'.$STDCode.'" ,
			"ResidencePhoneNumber":"", 
			"ResidenceMobileNo":"'.$ResidenceMobileNo.'", 
			"PanNo":"'.$PanNo.'", 
			"ICICIBankRelationship":"'.$ICICIBankRelationship.'", 
			"ICICIRelationshipNumber":"'.$ICICIRelationshipNumber.'", 
			"CustomerProfile":"'.$CustomerProfile.'", 
			"CompanyName":"'.$CompanyName.'", 
			"SalaryAccountWithOtherBank":"'.$SalaryAccountWithOtherBank.'", 
			"Total_Exp":"'.$Total_Exp.'", 
			"Income":"'.$Income.'", 
			"SalaryAccountOpened":"'.$SalaryAccountOpened.'"}';

		//echo $jsonurl."<br><br>";exit;
		$url ="https://www.dc.transuniondecisioncentre.co.in/DC/TU.DC.GenericAPI/API/ICICICCEAS/NewApplication/";// Prod
		// cURL's initialization
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_FAILONERROR, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonurl);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json','Content-Type: application/json'));
		$response_data = curl_exec($ch);
		//print_r($response_data);
		$result = json_decode($response_data);
		$ApplicationId = $result->ApplicationId;
		$Decision = $result->Decision;
		$ErrorMessage = $result->ErrorMessage;
		$Reason = $result->Reason;
		$DataArray = array("request_data" =>$jsonurl, "response_data" =>$response_data);
		$wherecondition ="(id='".$ccba_table_id."')";
		Mainupdatefunc('credit_card_banks_apply', $DataArray, $wherecondition);
	}


	function SCBWebservice($dataArr, $ccbaID){
		$RequestID = $dataArr['RequestID'];
		$CreditCardApplied = $dataArr['CreditCardApplied'];
		$HasExistingScbCC = $dataArr['HasExistingScbCC'];
		$IsExtngScbCust = $dataArr['IsExtngScbCust'];
		$CustReltnType = $dataArr['CustReltnType'];
		$FirstName = $dataArr['FirstName'];
		$MiddleName = $dataArr['MiddleName'];
		$LastName = $dataArr['LastName'];
		$Gender = $dataArr['Gender'];
		$DOB = $dataArr['DOB'];
		$Qualification = $dataArr['Qualification'];
		$ResAddress1 = $dataArr['ResAddress1'];
		$ResAddress2 = $dataArr['ResAddress2'];
		$ResCity = $dataArr['ResCity'];
		$ResPIN = $dataArr['ResPIN'];
		$Email = $dataArr['Email'];
		$Mobile = $dataArr['Mobile'];
		$EmpType = $dataArr['EmpType'];
		$AnnIncome = $dataArr['AnnIncome'];
		$GMI = $dataArr['GMI'];
		$CompanyName = $dataArr['CompanyName'];
		$Designation = $dataArr['Designation'];
		$IncomeProof = $dataArr['IncomeProof'];
		$IncomeProofValue = $dataArr['IncomeProofValue'];
		$PAN = $dataArr['PAN'];

		
		$ConUniqRefCode="scbcards".$RequestID;

		$auth = array("Authentication"=>array("UserId"=>"cc_connector_4", "Password"=>"d4l@pd!!osJ20C5*)1"));
		$cust_details = array("CreditCard"=>array("Version"=>3, "ConUniqRefCode"=>$ConUniqRefCode, "CreditCardApplied"=>$CreditCardApplied, "HasExistingScbCC"=>$HasExistingScbCC, "IsExtngScbCust"=>$IsExtngScbCust, "CustReltnType"=>$CustReltnType, "FirstName"=>$FirstName, "MiddleName"=>$MiddleName, "LastName"=>$LastName, "Gender"=>$Gender, "DOB"=>$DOB, "Qualification"=>$Qualification, "ResAddress1"=>$ResAddress1, "ResAddress2"=>$ResAddress2, "ResCity"=>$ResCity, "ResPIN"=>$ResPIN, "Email"=>$Email, "Mobile"=>$Mobile, "EmpType"=>$EmpType, "SalaryBankAcc"=>340, "AnnIncome"=>$AnnIncome, "GMI"=>$GMI, "CompanyName"=>$CompanyName, "Designation"=>$Designation, "IncomeProof"=>$IncomeProof,"IncomeProofValue"=>$IncomeProofValue, "PAN"=>$PAN));
		echo '<pre>';print_r($cust_details);exit;
		$request_data = implode(",",$cust_details["CreditCard"]);
		$request_arr = array("RPRequest"=>array_merge($auth, $cust_details));
		$ws_ur = 'https://apply.standardchartered.co.in/connector/RPCreditCardConnector.wsdl?wsdl';

		$client = new SoapClient($ws_ur);
		$result = $client->__soapCall('creditCard', $request_arr);
		$Status = $result->Status;
		$ReferenceCode = $result->ReferenceCode;
		$Errorcode = $result->Errorcode;
		$Errorinfo = $result->Errorinfo;
		$RequestIP = $result->RequestIP;
		$response_data = "Status -".$Status.", ReferenceCode -".$ReferenceCode.", Errorcode -".$Errorcode.",Errorinfo -".$Errorinfo.",RequestIP -".$RequestIP;
		$DataArray = array("request_data" =>$request_data, "response_data" =>$response_data);
		$wherecondition ="(id='".$ccbaID."')";
		Mainupdatefunc('credit_card_banks_apply', $DataArray, $wherecondition);
	}

}


function pancardValidation ($dataArr)
{
	$Dated=ExactServerdate();
	$product = $dataArr['product'];
	$productid = $dataArr['RequestID'];
	$pancard = $dataArr['pancard'];
	$api_name = 'PancardValidation';
	$api_version = $dataArr['api_version'];
	if($api_version=="Production")
	{
		$url = "https://api.karza.in/pan";
		$key = "DLAKBVWPMZLFJENK";
	}
	else if($api_version=="UAT")
	{
		$url = "https://testapi.karza.in/pan";
		$key = "DLKPSTXBVCNLAZET";
	}
	else
	{
		$url = "";
		$key = "";
	}
	
	$api_request = "{\r\n   \"pan\":\"$pancard\",\r\n   \"key\":\"$key\"\r\n}";
	
	$requestDataArray = array("product"=>$product, "productid"=>$productid, "api_name"=>$api_name, "api_version"=>$api_version, "api_request" =>$api_request,  "date_created"=>$Dated);
	$api_inserted_id = Maininsertfunc("webservice_details_pl", $requestDataArray);
	//print_r($requestDataArray);
	
	if(strlen($url)>0 && strlen($key)>0 )
	{
		$curl = curl_init();
		curl_setopt_array($curl, array(
		  CURLOPT_URL => $url,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
		  CURLOPT_POSTFIELDS => "{\r\n   \"pan\":\"$pancard\",\r\n   \"key\":\"$key\"\r\n}",
		  CURLOPT_HTTPHEADER => array(
		    "cache-control: no-cache",
		    "content-type: application/json",
		//    "postman-token: b2d76d2a-4b9e-e8fa-32d0-fec113dd5f4a"
		  ),
		));
		
		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);
		
		if ($err)
		{
			$return_value = "cURL Error #:" . $err;
			$api_response_status= 0;
			
		}
		else
		{
			$return_value = $response;
			$api_response_status= 1;
		}
		$responseDataArray = array("api_response" =>$response, "api_response_status"=>$api_response_status);
		$responseWhereCondition ="(webserviceid='".$api_inserted_id."')";
		Mainupdatefunc ('webservice_details_pl', $responseDataArray, $responseWhereCondition);
	}
	else
	{
		$return_value = "URL OR KEY BLANK";
	}
	return $return_value;
}

?>
