<?php 

//Incomplete File

require_once('webservice/nusoaptu.php'); 

$client= new nusoap_client("http://www.dc.transuniondecisioncentre.co.in/dc/TU.SSPL.Wrapper/wrapper.asmx?wsdl", true);
//https://www.test.transuniondecisioncentre.co.in/dc/TU.SSPL.Wrapper/wrapper.asmx?wsdl

$EnvironmentType="P";//U
$CIRpath="res2";
$SourcingProfile ='Salaried';//site
$ApplicantFirstName = "Ranjana";//site
$ApplicantLastName = "Chauhan";//site
$DateofBirth = "05/02/1983";//site
$ResidenceMobileNumber = "9811215138";//site
$Pancard = "AGFPC1112N";
$Gender = "Female";
$MonthlySal = "50000";//site
$resiadd1 = "28 Dayanand";
$resiadd2 = "Vihar";
$resicity = "Delhi";
$pincode = "110092";
$resistate = "Delhi";
$companyname = "BLUE DART LIMITED";//site
$DurationofStayMonth = "May";
$DurationofStayYear = "2008";
$CompanyNameOther = "";
$IndustrySector = "IT";
$TotalworkExperience = "9";//site
$CurrentEmployerMonth = "Dec";
$CurrentEmployerYear = "2006";
$IciciRelationShip = "false";
$IciciRelationShipText = "SALARY_ACCOUNT";
$LoanAmount = "200000";//site
//Solution Set Version : 103

	$xml_str = '<CallExternalService xmlns="http://tempuri.org/"><xml>';
	$xml_str .= '<![CDATA[&lt;?xml version=&quot;1.0&quot;?&gt; &lt;DCRequest xmlns=&quot;http://transunion.com/dc/extsvc&quot;&gt; &lt;Authentication type=&quot;OnDemand&quot;&gt; &lt;UserId&gt;ICICI_PL_Deals4loan&lt;/UserId&gt; &lt;Password&gt;Password@123&lt;/Password&gt; &lt;/Authentication&gt; &lt;RequestInfo&gt; &lt;ExecutionMode&gt;NewWithContext&lt;/ExecutionMode&gt; &lt;SolutionSetId&gt;347&lt;/SolutionSetId&gt; &lt;SolutionSetVersion&gt;106&lt;/SolutionSetVersion&gt; &lt;/RequestInfo&gt; &lt;UserData/&gt; &lt;Fields&gt; &lt;Field key=&quot;CIRpath&quot;&gt;'.$CIRpath.'&lt;/Field&gt; &lt;Field key=&quot;EnvironmentType&quot;&gt;'.$EnvironmentType.'&lt;/Field&gt; &lt;Field key=&quot;SourcingProfile&quot;&gt;'.$SourcingProfile.'&lt;/Field&gt; &lt;Field key=&quot;TenureinMonths&quot;&gt;0&lt;/Field&gt; &lt;Field key=&quot;LoanAmount&quot;&gt;'.$LoanAmount.'&lt;/Field&gt; &lt;Field key=&quot;ApplicantFirstName&quot;&gt;'.$ApplicantFirstName.'&lt;/Field&gt; &lt;Field key=&quot;ApplicantLastName&quot;&gt;'.$ApplicantLastName.'&lt;/Field&gt; &lt;Field key=&quot;ResidenceMobileNumber&quot;&gt;'.$ResidenceMobileNumber.'&lt;/Field&gt; &lt;Field key=&quot;DateofBirth&quot;&gt;'.$DateofBirth.'&lt;/Field&gt; &lt;Field key=&quot;Gender&quot;&gt;'.$Gender.'&lt;/Field&gt; &lt;Field key=&quot;PanNumber&quot;&gt;'.$Pancard.'&lt;/Field&gt; &lt;Field key=&quot;MonthlyTakeHome&quot;&gt;'.$MonthlySal.'&lt;/Field&gt; &lt;Field key=&quot;ResidenceAddress1&quot;&gt;'.$resiadd1.'&lt;/Field&gt; &lt;Field key=&quot;ResidenceAddress2&quot;&gt;'.$resiadd2.'&lt;/Field&gt; &lt;Field key=&quot;ResidenceCity&quot;&gt;'.$resicity.'&lt;/Field&gt; &lt;Field key=&quot;ResidencePinCode&quot;&gt;'.$pincode.'&lt;/Field&gt; &lt;Field key=&quot;ResidenceState&quot;&gt;'.$resistate.'&lt;/Field&gt; &lt;Field key=&quot;CompanyName&quot;&gt;&lt;![CDATA['.$companyname.']]&gt;&lt;/Field&gt; &lt;!--Refers to how long you were staying inthe above address if you are staying from januray 2009 below two fields should have--&gt; 	&lt;!--Duration of Stay Month should always acronymns like Jan Feb Mar--&gt; &lt;Field key=&quot;DurationofStayMonth&quot;&gt;'.$DurationofStayMonth.'&lt;/Field&gt; 	&lt;!--should have numbers only cannot be blank--&gt; &lt;Field key=&quot;DurationofStayYear&quot;&gt;'.$DurationofStayYear.'&lt;/Field&gt; &lt;Field key=&quot;CompanyNameOther&quot;&gt;&lt;![CDATA['.$CompanyNameOther.']]&gt; &lt;/Field&gt; &lt;Field key=&quot;IndustrySector&quot;&gt;'.$IndustrySector.'&lt;/Field&gt;&lt;!--should have numbers only cannot be blank In years--&gt; &lt;Field key=&quot;TotalworkExperience&quot;&gt;'.$TotalworkExperience.'&lt;/Field&gt; 	&lt;!--Time since you work with current employer same rule as applicable above--&gt; 	&lt;!--should have numbers only cannot be blank--&gt; &lt;Field key=&quot;CurrentEmployerMonth&quot;&gt;'.$CurrentEmployerMonth.'&lt;/Field&gt; &lt;Field key=&quot;CurrentEmployerYear&quot;&gt;'.$CurrentEmployerYear.'&lt;/Field&gt; 	&lt;!--Have any existing relation with ICICI Yes then send value as true else value will be false--&gt; &lt;Field key=&quot;IciciRelationShip&quot;&gt;'.$IciciRelationShip.'&lt;/Field&gt; 	&lt;!--if above value is true then mention the type of account--&gt; &lt;Field key=&quot;IciciRelationShipText&quot;&gt;'.$IciciRelationShipText.'&lt;/Field&gt; &lt;/Fields&gt; &lt;/DCRequest&gt;]]>';
	$xml_str .= '</xml></CallExternalService>';

echo "<br><br>";
	echo $xml_str;
echo "<br><br>";

	$return =  $client->call('CallExternalService', $xml_str);
echo "<br><br>";	
	print_r($return);
	echo "<br><br>";
	$xml = new SimpleXMLElement($return['CallExternalServiceResult']);


	$Status = $xml->Status;
	$Authentication_Status =  $xml->Authentication->Status;
	$Authentication_Token =  $xml->Authentication->Token;
	$ResponseInfo_ApplicationId =  $xml->ResponseInfo->ApplicationId;
	$ResponseInfo_SolutionSetInstanceId =  $xml->ResponseInfo->SolutionSetInstanceId;
	$ResponseInfo_CurrentQueue =  $xml->ResponseInfo->CurrentQueue;
	$ApplicationId =  $xml->ContextData->Field[0];
	$PLReason =  $xml->ContextData->Field[1];
	$PLResult =  $xml->ContextData->Field[2];
	$EMIPeriod =  $xml->ContextData->Field[3];
	$EMICalculatedString =  $xml->ContextData->Field[4];
	$FixedTenure =  $xml->ContextData->Field[5];
	$FixedLoanAmount =  $xml->ContextData->Field[6];
	$FixedROI =  $xml->ContextData->Field[7];
	$FixedEMI =  $xml->ContextData->Field[8];
	$FixedProcessingFee =  $xml->ContextData->Field[9];
	$OBPLAvailable =  $xml->ContextData->Field[10];
	$BTDataSet =  $xml->ContextData->Field[11];
	$BTEligibleFlag =  $xml->ContextData->Field[12];
	$LoanAmountString =  $xml->ContextData->Field[13];
	

	

?>