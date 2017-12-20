<?php 
require 'scripts/db_init.php';
//require_once('webservice/nusoaptu.php'); 

//$client= new nusoap_client("https://www.test.transuniondecisioncentre.co.in/dc/TU.SSPL.Wrapper/wrapper.asmx?wsdl", true);



$EnvironmentType="U";
$CIRpath="res2";
$SourcingProfile = $emp_status;//site
$ApplicantFirstName = $first;//site
$ApplicantLastName = $last;//site
$DateofBirth = $dobstr;//site
$ResidenceMobileNumber = $Mobile_Number;//site
$Pancard = $Pancard;
$Gender = $Gender;
$MonthlySal = $monthly;//site
$resiadd1 = $Residence_Address1;
$resiadd2 = $Residence_Address_line2;
$resicity = $Address_City;
$pincode = $Pincode;
$resistate = $Address_State;
$companyname = $Company_Name;//site
$DurationofStayMonth = $staymonth;
$DurationofStayYear = $stayyear;
$CompanyNameOther = "";
$IndustrySector = $industry_sector;
$TotalworkExperience = $TotalExperience;//site
$CurrentEmployerMonth = $employmonth;
$CurrentEmployerYear = $employyear;
$IciciRelationShip = "false";
$IciciRelationShipText = $existing_rel;
$LoanAmount = $LoanAmount;//site

/*Channel Name: Deal4loans 
User ID: ICICI_LMS_Deal4loans 
Password: Password@123 
Sample Input: [JSON Format] */

$jsonurl='{"UserID":"CzqACXzroMJsd80Coai21nEnbhIyixSHaGKP1uPCBbuFlMqoBqBpFwxuaDHGvdso5IZDwCzyvrEODKkxLq4VzrRsE5tSKoiq1gfJ8suoBqNbvPtOYbj6HfQUaO+rw5AUl2mHRuCEm4fLsAp+AUUK0r3Sxa9atI2oP7T+LIjoees=","Password":"dewOHb3MXfzdK/L8raCt7D1qJ9k2OtTsMM/uWdCmdV8M252sJb4dYOsyv2cIJX6FtyJgr8HjM4DT+3ixKf1+1wYU+/l8iip1PuzBq0uFXwcY86jzCF3c+qHH/jBaI+GD+OBmUiO+Thhm/QUDAGANY7v499NTfsVoyOOYt1kNVto=","ChannelType":"Deal4loans","FirstName ":"Karuppaiah","MiddleName":"","LastName":"Selvaraj","Gender":"Male","DateOfBirth":"14/11/1987","UId":" ","ResMobileNo":"9176724455","Designation":"Manager","CustomerCategory":"Salaried","CompanyName":"C APGEMINI","Profession":"ENGINEER","FixedIncome":"49999","CurrentObligation":"0","TotalWorkExperience":"5","CurrentWorkExperience":"5","RelationWithICICI":"No","ICICIRelationShipNumber":" ","CityName":"Chennai","CityCategory":"OtherMetros","StateName":"Tamil Nadu","SalaryAccountICICI":"No","ResAddressLine1":"Chennai","ResAddressLine2":"Chennai","ResAddressLine3":"Filename302","ResCity":"Chennai","ResPinCode":"600057","ResState":"Chennai","OffAddressLine1":"Chennai","OffAddressLine2":"Chennai","OffAddressLine3":" ","OffCity":"Chennai","OffPinCode":"600057","OffState":"Tamil Nadu","OfficePhone":" ","OfficeEmail":" ","VoterID":" ","DrivingLicense":" ","RationCardNumber":" ","PassportNo":" ","PanNo":"AAAPA1111A","LoanAmount":"50005"}';

$url ="https://www.test.transuniondecisioncentre.co.in/DC/TUDCGenericAPI/API/ICICIPLLMS/NewApplication/";
// cURL's initialization
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_FAILONERROR, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonurl);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json','Content-Type: application/json'));
$result = curl_exec($ch);

echo $result."<br>";

/*$xml_str = '<CallExternalService xmlns="http://tempuri.org/"><xml>';
	$xml_str .= '<![CDATA[&lt;?xml version=&quot;1.0&quot;?&gt; &lt;DCRequest xmlns=&quot;http://transunion.com/dc/extsvc&quot;&gt; &lt;Authentication type=&quot;OnDemand&quot;&gt; &lt;UserId&gt;ICICI_PL_Deals4loan&lt;/UserId&gt; &lt;Password&gt;Password@123&lt;/Password&gt; &lt;/Authentication&gt; &lt;RequestInfo&gt; &lt;ExecutionMode&gt;NewWithContext&lt;/ExecutionMode&gt; &lt;SolutionSetId&gt;347&lt;/SolutionSetId&gt; &lt;SolutionSetVersion&gt;103&lt;/SolutionSetVersion&gt; &lt;/RequestInfo&gt; &lt;UserData/&gt; &lt;Fields&gt; &lt;Field key=&quot;CIRpath&quot;&gt;'.$CIRpath.'&lt;/Field&gt; &lt;Field key=&quot;EnvironmentType&quot;&gt;'.$EnvironmentType.'&lt;/Field&gt; &lt;Field key=&quot;SourcingProfile&quot;&gt;'.$SourcingProfile.'&lt;/Field&gt; &lt;Field key=&quot;TenureinMonths&quot;&gt;0&lt;/Field&gt; &lt;Field key=&quot;LoanAmount&quot;&gt;'.$LoanAmount.'&lt;/Field&gt; &lt;Field key=&quot;ApplicantFirstName&quot;&gt;'.$ApplicantFirstName.'&lt;/Field&gt; &lt;Field key=&quot;ApplicantLastName&quot;&gt;'.$ApplicantLastName.'&lt;/Field&gt; &lt;Field key=&quot;ResidenceMobileNumber&quot;&gt;'.$ResidenceMobileNumber.'&lt;/Field&gt; &lt;Field key=&quot;DateofBirth&quot;&gt;'.$DateofBirth.'&lt;/Field&gt; &lt;Field key=&quot;Gender&quot;&gt;'.$Gender.'&lt;/Field&gt; &lt;Field key=&quot;PanNumber&quot;&gt;'.$Pancard.'&lt;/Field&gt; &lt;Field key=&quot;MonthlyTakeHome&quot;&gt;'.$MonthlySal.'&lt;/Field&gt; &lt;Field key=&quot;ResidenceAddress1&quot;&gt;'.$resiadd1.'&lt;/Field&gt; &lt;Field key=&quot;ResidenceAddress2&quot;&gt;'.$resiadd2.'&lt;/Field&gt; &lt;Field key=&quot;ResidenceCity&quot;&gt;'.$resicity.'&lt;/Field&gt; &lt;Field key=&quot;ResidencePinCode&quot;&gt;'.$pincode.'&lt;/Field&gt; &lt;Field key=&quot;ResidenceState&quot;&gt;'.$resistate.'&lt;/Field&gt; &lt;Field key=&quot;CompanyName&quot;&gt;&lt;![CDATA['.$companyname.']]&gt;&lt;/Field&gt; &lt;!--Refers to how long you were staying inthe above address if you are staying from januray 2009 below two fields should have--&gt; 	&lt;!--Duration of Stay Month should always acronymns like Jan Feb Mar--&gt; &lt;Field key=&quot;DurationofStayMonth&quot;&gt;'.$DurationofStayMonth.'&lt;/Field&gt; 	&lt;!--should have numbers only cannot be blank--&gt; &lt;Field key=&quot;DurationofStayYear&quot;&gt;'.$DurationofStayYear.'&lt;/Field&gt; &lt;Field key=&quot;CompanyNameOther&quot;&gt;&lt;![CDATA['.$CompanyNameOther.']]&gt; &lt;/Field&gt; &lt;Field key=&quot;IndustrySector&quot;&gt;'.$IndustrySector.'&lt;/Field&gt;&lt;!--should have numbers only cannot be blank In years--&gt; &lt;Field key=&quot;TotalworkExperience&quot;&gt;'.$TotalworkExperience.'&lt;/Field&gt; 	&lt;!--Time since you work with current employer same rule as applicable above--&gt; 	&lt;!--should have numbers only cannot be blank--&gt; &lt;Field key=&quot;CurrentEmployerMonth&quot;&gt;'.$CurrentEmployerMonth.'&lt;/Field&gt; &lt;Field key=&quot;CurrentEmployerYear&quot;&gt;'.$CurrentEmployerYear.'&lt;/Field&gt; 	&lt;!--Have any existing relation with ICICI Yes then send value as true else value will be false--&gt; &lt;Field key=&quot;IciciRelationShip&quot;&gt;'.$IciciRelationShip.'&lt;/Field&gt; 	&lt;!--if above value is true then mention the type of account--&gt; &lt;Field key=&quot;IciciRelationShipText&quot;&gt;'.$IciciRelationShipText.'&lt;/Field&gt; &lt;/Fields&gt; &lt;/DCRequest&gt;]]>';
	$xml_str .= '</xml></CallExternalService>';

//echo "<br><br>";
//	echo $xml_str;
//echo "<br><br>";

	$return =  $client->call('CallExternalService', $xml_str);
//echo "<br><br>";	
	//print_r($return);
	//echo "<br><br>";
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
	
echo "TU STatus : ".$Status."<br>";
echo "TU Result : ".$PLResult."<br><br>";*/
?>
