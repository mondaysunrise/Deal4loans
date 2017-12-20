<?php
require_once('webservice/nusoaptu.php'); 
	$client= new nusoap_client("https://www.test.transuniondecisioncentre.co.in/dc/TU.SSPL.Wrapper/wrapper.asmx?wsdl", true);
	//$client= new nusoap_client("https://www.dc.transuniondecisioncentre.co.in/dc/TU.SSPL.Wrapper/wrapper.asmx?wsdl", true);//Live Link
	
//echo "<br><br>";
//echo $EmpStatus." //- ".$fName." //- ".$lName." //- ".$DOB." //- ".$Mobile." //- ".$Pancard." //- ".$Gender." //- ".$MonthlySal." //- ".$resiadd1." //- ".$resiadd2." //- ".$resicity." //- ".$pincode." //- ".$resistate." //- ".$companyname." //- ".$DurationofStayMonth." //- ".$DurationofStayYear." //- ".$CompanyNameOther." //- ".$IndustrySector." //- ".$TotalworkExperience." //- ".$CurrentEmployerMonth." //- ".$CurrentEmployerYear." //- ".$IciciRelationShip." //- ".$IciciRelationShipText." //- ".$LoanAmount." //- ".$RequestID;

$Userid = "icici_deals4loans";
$pwd = "Password@123";
$EnvironmentType = "QA";
$Reference_Number = "D4L0000000011";
$Purpose = "10";
$Amount = 30000;
$ScoreType = '01';
$ApplicantFirstName = "Upendra";
$ApplicantLastName = " k";
$Gender = "Male";
$DateOfBirth = "09/06/1978"; //dd/mm/yyyy
$ResidenceCode = "02";// 01 = Owned 02 = Rented 
$ResidenceAddress1 = "C-49 FF, Parshanath, Mohan Ghaziabad";
$ResidencePincode = "201007";
$City = "Ghaziabad";
$Address_State = "Uttar Pradesh";
$CountryCode = "356";
$ResidenceMobileNo = 9811215138;
$CreditCardType = "-1";
$MonthlyIncome = "41667";
$PanNo = "ATDPK2777F";
$ICICIBankRelationship = 'Noreleationship'; // Salary, Saving, Current, Loan, Noreleationship // case sensitice
$Typeofcompany = 'Preffered'; //Elite, Superprime, Preffered, Others, Selfemployed // case sensitice
$CustomerProfile = 'Salaried'; // Salaried,Selfemployed // case sensitice
$ApplicationDate = date("d/m/Y H:m:s A");


$xml_str = '<CallExternalService xmlns="http://tempuri.org/"><xml>';
$xml_str .= '<![CDATA[ &lt;DCRequest xmlns=&quot;http://transunion.com/dc/extsvc&quot;&gt;&lt;Authentication type=&quot;OnDemand&quot;&gt;&lt;UserId&gt;icici_deals4loans&lt;/UserId&gt;&lt;Password&gt;Password@123&lt;/Password&gt;&lt;/Authentication&gt;&lt;RequestInfo&gt;&lt;SolutionSetId&gt;133&lt;/SolutionSetId&gt;&lt;SolutionSetVersion&gt;83&lt;/SolutionSetVersion&gt;&lt;ExecutionMode&gt;NewWithContext&lt;/ExecutionMode&gt;&lt;/RequestInfo&gt;&lt;UserData /&gt;&lt;Fields&gt;&lt;Field key=&quot;EnvironmentType&quot;&gt;P&lt;/Field&gt;&lt;Field key=&quot;Reference_Number&quot;&gt;U010000104854&lt;/Field&gt;&lt;Field key=&quot;Purpose&quot;&gt;10&lt;/Field&gt;&lt;Field key=&quot;Amount&quot;&gt;'.$Amount.'&lt;/Field&gt;&lt;Field key=&quot;ScoreType&quot;&gt;01&lt;/Field&gt;&lt;Field key=&quot;ApplicantFirstName&quot;&gt;'.$ApplicantFirstName.'&lt;/Field&gt;&lt;Field key=&quot;ApplicantMiddleName&quot; /&gt;&lt;Field key=&quot;ApplicantLastName&quot;&gt;'.$ApplicantLastName.'&lt;/Field&gt;&lt;Field key=&quot;Gender&quot;&gt;'.$Gender.'&lt;/Field&gt;&lt;Field key=&quot;DateOfBirth&quot;&gt;'.$DateOfBirth.'&lt;/Field&gt;&lt;Field key=&quot;ResidenceCode&quot;&gt;'.$ResidenceCode.'&lt;/Field&gt;&lt;Field key=&quot;ResidenceAddress1&quot;&gt;'.$ResidenceAddress1.'&lt;/Field&gt;&lt;Field key=&quot;ResidenceAddress2&quot; /&gt;&lt;Field key=&quot;ResidenceAddress3&quot; /&gt;&lt;Field key=&quot;ResidenceAddress4&quot; /&gt;&lt;Field key=&quot;ResidenceAddress5&quot; /&gt;&lt;Field key=&quot;Location&quot; /&gt;&lt;Field key=&quot;Town&quot; /&gt;&lt;Field key=&quot;ResidencePincode&quot;&gt;'.$ResidencePincode.'&lt;/Field&gt;&lt;Field key=&quot;City&quot;&gt;'.$City.'&lt;/Field&gt;&lt;Field key=&quot;ResidenceState&quot;&gt;'.$Address_State.'&lt;/Field&gt;&lt;Field key=&quot;STDCode&quot; /&gt;&lt;Field key=&quot;CityShortName&quot; /&gt;&lt;Field key=&quot;ResidenceStateShortName&quot; /&gt;&lt;Field key=&quot;CountryCode&quot;&gt;356&lt;/Field&gt;&lt;Field key=&quot;ResidencePhoneNumber&quot; /&gt;&lt;Field key=&quot;ResidenceMobileNo&quot;&gt;'.$ResidenceMobileNo.'&lt;/Field&gt;&lt;Field key=&quot;CreditCardType&quot;&gt;-1&lt;/Field&gt;&lt;Field key=&quot;CreditCardTemplate&quot; /&gt;&lt;Field key=&quot;NACSDMAID&quot; /&gt;&lt;Field key=&quot;NACSDMACITY&quot; /&gt;&lt;Field key=&quot;MonthlyIncome&quot;&gt;'.$MonthlyIncome.'&lt;/Field&gt;&lt;Field key=&quot;PanNo&quot;&gt;'.$PanNo.'&lt;/Field&gt;&lt;Field key=&quot;PassportNo&quot; /&gt;&lt;Field key=&quot;VoterId&quot; /&gt;&lt;Field key=&quot;FutureUse1&quot; /&gt;&lt;Field key=&quot;FutureUse2&quot; /&gt;&lt;Field key=&quot;ConsumerName4&quot; /&gt;&lt;Field key=&quot;ConsumerName5&quot; /&gt;&lt;Field key=&quot;DLNo&quot; /&gt;&lt;Field key=&quot;UId&quot; /&gt;&lt;Field key=&quot;RationCardNo&quot; /&gt;&lt;Field key=&quot;AdditionalID1&quot; /&gt;&lt;Field key=&quot;AdditionalID2&quot; /&gt;&lt;Field key=&quot;ResidenceTelephoneExtension1&quot; /&gt;&lt;Field key=&quot;ResidenceTelephoneExtension2&quot; /&gt;&lt;Field key=&quot;ICICIBankRelationship&quot;&gt;'.$ICICIBankRelationship.'&lt;/Field&gt;&lt;Field key=&quot;Typeofcompany&quot;&gt;'.$Typeofcompany.'&lt;/Field&gt;&lt;Field key=&quot;ApplicationDate&quot;&gt;'.$ApplicationDate.'&lt;/Field&gt;&lt;Field key=&quot;QACIRFilePath&quot;&gt;D:\DecisionCentre\QA\ICICI\&lt;/Field&gt;&lt;Field key=&quot;FileName&quot;&gt;Scenario1.xml&lt;/Field&gt;&lt;/Fields&gt;&lt;/DCRequest&gt;]]>';
	$xml_str .= '</xml></CallExternalService>';	

//&lt;?xml version=&quot;1.0&quot;?&gt;
/*$xml_str = '<CallExternalService xmlns="http://tempuri.org/"><xml>';
$xml_str .= '<![CDATA[ &lt;DCRequest xmlns=&quot;http://transunion.com/dc/extsvc&quot;&gt;&lt;Authentication type=&quot;OnDemand&quot;&gt;&lt;UserId&gt;icici_deals4loans&lt;/UserId&gt;&lt;Password&gt;Password@123&lt;/Password&gt;&lt;/Authentication&gt;&lt;RequestInfo&gt;&lt;SolutionSetId&gt;133&lt;/SolutionSetId&gt;&lt;SolutionSetVersion&gt;83&lt;/SolutionSetVersion&gt;&lt;ExecutionMode&gt;NewWithContext&lt;/ExecutionMode&gt;&lt;/RequestInfo&gt;&lt;UserData /&gt;&lt;Fields&gt;&lt;Field key=&quot;EnvironmentType&quot;&gt;QA&lt;/Field&gt;&lt;Field key=&quot;Reference_Number&quot;&gt;U010000104854&lt;/Field&gt;&lt;Field key=&quot;Purpose&quot;&gt;10&lt;/Field&gt;&lt;Field key=&quot;Amount&quot;&gt;50000&lt;/Field&gt;&lt;Field key=&quot;ScoreType&quot;&gt;01&lt;/Field&gt;&lt;Field key=&quot;ApplicantFirstName&quot;&gt;Upendra&lt;/Field&gt;&lt;Field key=&quot;ApplicantMiddleName&quot; /&gt;&lt;Field key=&quot;ApplicantLastName&quot;&gt;Kumar&lt;/Field&gt;&lt;Field key=&quot;Gender&quot;&gt;Male&lt;/Field&gt;&lt;Field key=&quot;DateOfBirth&quot;&gt;09/06/1977&lt;/Field&gt;&lt;Field key=&quot;ResidenceCode&quot;&gt;02&lt;/Field&gt;&lt;Field key=&quot;ResidenceAddress1&quot;&gt;B-16 SF, PArshanath, Mohan Ghaziabad&lt;/Field&gt;&lt;Field key=&quot;ResidenceAddress2&quot; /&gt;&lt;Field key=&quot;ResidenceAddress3&quot; /&gt;&lt;Field key=&quot;ResidenceAddress4&quot; /&gt;&lt;Field key=&quot;ResidenceAddress5&quot; /&gt;&lt;Field key=&quot;Location&quot; /&gt;&lt;Field key=&quot;Town&quot; /&gt;&lt;Field key=&quot;ResidencePincode&quot;&gt;201007&lt;/Field&gt;&lt;Field key=&quot;City&quot;&gt;Gurgaon&lt;/Field&gt;&lt;Field key=&quot;ResidenceState&quot;&gt;Uttar Pradesh&lt;/Field&gt;&lt;Field key=&quot;STDCode&quot; /&gt;&lt;Field key=&quot;CityShortName&quot; /&gt;&lt;Field key=&quot;ResidenceStateShortName&quot; /&gt;&lt;Field key=&quot;CountryCode&quot;&gt;356&lt;/Field&gt;&lt;Field key=&quot;ResidencePhoneNumber&quot; /&gt;&lt;Field key=&quot;ResidenceMobileNo&quot;&gt;9971396361&lt;/Field&gt;&lt;Field key=&quot;CreditCardType&quot;&gt;-1&lt;/Field&gt;&lt;Field key=&quot;CreditCardTemplate&quot; /&gt;&lt;Field key=&quot;NACSDMAID&quot; /&gt;&lt;Field key=&quot;NACSDMACITY&quot; /&gt;&lt;Field key=&quot;MonthlyIncome&quot;&gt;100000&lt;/Field&gt;&lt;Field key=&quot;PanNo&quot;&gt;ATDPK2777Q&lt;/Field&gt;&lt;Field key=&quot;PassportNo&quot; /&gt;&lt;Field key=&quot;VoterId&quot; /&gt;&lt;Field key=&quot;FutureUse1&quot; /&gt;&lt;Field key=&quot;FutureUse2&quot; /&gt;&lt;Field key=&quot;ConsumerName4&quot; /&gt;&lt;Field key=&quot;ConsumerName5&quot; /&gt;&lt;Field key=&quot;DLNo&quot; /&gt;&lt;Field key=&quot;UId&quot; /&gt;&lt;Field key=&quot;RationCardNo&quot; /&gt;&lt;Field key=&quot;AdditionalID1&quot; /&gt;&lt;Field key=&quot;AdditionalID2&quot; /&gt;&lt;Field key=&quot;ResidenceTelephoneExtension1&quot; /&gt;&lt;Field key=&quot;ResidenceTelephoneExtension2&quot; /&gt;&lt;Field key=&quot;ICICIBankRelationship&quot;&gt;Salary&lt;/Field&gt;&lt;Field key=&quot;Typeofcompany&quot;&gt;Elite&lt;/Field&gt;&lt;Field key=&quot;ApplicationDate&quot;&gt;06/19/2014 19:32:19 PM&lt;/Field&gt;&lt;Field key=&quot;QACIRFilePath&quot;&gt;D:\DecisionCentre\QA\ICICI\&lt;/Field&gt;&lt;Field key=&quot;FileName&quot;&gt;Scenario1.xml&lt;/Field&gt;&lt;/Fields&gt;&lt;/DCRequest&gt;]]>';
	$xml_str .= '</xml></CallExternalService>';*/
	
	
	echo $xml_str;
	$return =  $client->call('CallExternalService', $xml_str);
echo "<br>here<br>";	
	print_r($return);
echo "<br>end<br>";	
	echo "result ".$return['CallExternalServiceResult'];
	$xml = new SimpleXMLElement($return['CallExternalServiceResult']);
	
	echo "0 ".$Status = $xml->Status;
	echo "1 ".$Authentication_Status =  $xml->Authentication->Status;
	echo "<br><br>";
	echo "2 ".$Authentication_Token =  $xml->Authentication->Token;
	echo "<br><br>";
	echo "3 ".$ResponseInfo_ApplicationId =  $xml->ResponseInfo->ApplicationId;
	echo "<br><br>";
	echo "4 ".$ResponseInfo_SolutionSetInstanceId =  $xml->ResponseInfo->SolutionSetInstanceId;
	echo "<br><br>";
	echo "5 ".$ResponseInfo_CurrentQueue =  $xml->ResponseInfo->CurrentQueue;
	echo "<br><br>";
	echo "6 ".$ContextDataField0 =  $xml->ContextData->Field[0];
	echo "<br><br>";
	echo "7 ".$PLReason =  $xml->ContextData->Field[1];
	echo "<br><br>";
	echo "8 ".$PLResult =  $xml->ContextData->Field[2];
	echo "<br><br>";
	echo "9 ".$ContextDataField3 =  $xml->ContextData->Field[3];
	echo "<br><br>";
	echo "10 ".$EMICalculatedString =  $xml->ContextData->Field[4];
	echo "<br><br>";
	echo "11 ".$ContextDataField5 =  $xml->ContextData->Field[5];
	echo "<br><br>";
	echo "12 ".$ContextDataField6 =  $xml->ContextData->Field[6];
	echo "<br><br>";
	echo "13 ".$ContextDataField7 =  $xml->ContextData->Field[7];
	echo "<br><br>";
	echo "14 ".$ContextDataField8 =  $xml->ContextData->Field[8];
	echo "<br><br>";
	echo "15 ".$ContextDataField9 =  $xml->ContextData->Field[9];
	echo "<br><br>";
	echo "16 ".$ContextDataField10 =  $xml->ContextData->Field[10];
	echo "<br><br>";
	echo "17 ".$BTDataSet =  $xml->ContextData->Field[11];
	echo "<br><br>";
	echo "18 ".$BTEligibleFlag =  $xml->ContextData->Field[12];
	echo "<br><br>";
	echo "19 ".$LoanAmountString =  $xml->ContextData->Field[13];
	echo "<br><br>";
	//echo "20 ".$StatusDescription =  $xml->ContextData->Field["NetSalary"]; // Status Description
	echo "<br><br>";
	echo "21 ".$StatusDescription =  $xml->ContextData->NetSalary; // Status Description
	echo "<br><br>";
	echo"22 ". $StatusDescription =  $xml->ContextData->TUEF_ErrorDescription->ErrorDescription; // Status Description

	echo "<br><br>";



?>