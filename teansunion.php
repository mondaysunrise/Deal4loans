<?php 

function transunionCheck($EmpStatus,$fName,$lName,$DOB,$Mobile,$Pancard,$Gender,$MonthlySal,$resiadd1,$resiadd2,$resicity,$pincode,$resistate,$companyname,$DurationofStayMonth,$DurationofStayYear,$CompanyNameOther,$IndustrySector,$TotalworkExperience,$CurrentEmployerMonth,$CurrentEmployerYear,$IciciRelationShip,$IciciRelationShipText,$LoanAmount,$RequestID)
{
	$client= new nusoap_client("https://www.test.transuniondecisioncentre.co.in/dc/TU.SSPL.Wrapper/wrapper.asmx?wsdl", true);
//echo "<br><br>";
//echo $EmpStatus." //- ".$fName." //- ".$lName." //- ".$DOB." //- ".$Mobile." //- ".$Pancard." //- ".$Gender." //- ".$MonthlySal." //- ".$resiadd1." //- ".$resiadd2." //- ".$resicity." //- ".$pincode." //- ".$resistate." //- ".$companyname." //- ".$DurationofStayMonth." //- ".$DurationofStayYear." //- ".$CompanyNameOther." //- ".$IndustrySector." //- ".$TotalworkExperience." //- ".$CurrentEmployerMonth." //- ".$CurrentEmployerYear." //- ".$IciciRelationShip." //- ".$IciciRelationShipText." //- ".$LoanAmount." //- ".$RequestID;

	$xml_str = '<CallExternalService xmlns="http://tempuri.org/"><xml>';
	$xml_str .= '<![CDATA[&lt;?xml version=&quot;1.0&quot;?&gt; &lt;DCRequest xmlns=&quot;http://transunion.com/dc/extsvc&quot;&gt; &lt;Authentication type=&quot;OnDemand&quot;&gt; &lt;UserId&gt;ICICI_PL_Deals4loan&lt;/UserId&gt; &lt;Password&gt;Password@123&lt;/Password&gt; &lt;/Authentication&gt; &lt;RequestInfo&gt; &lt;ExecutionMode&gt;NewWithContext&lt;/ExecutionMode&gt; &lt;SolutionSetId&gt;347&lt;/SolutionSetId&gt; &lt;SolutionSetVersion&gt;103&lt;/SolutionSetVersion&gt; &lt;/RequestInfo&gt; &lt;UserData/&gt; &lt;Fields&gt; &lt;Field key=&quot;CIRpath&quot;&gt;res2&lt;/Field&gt; &lt;Field key=&quot;EnvironmentType&quot;&gt;U&lt;/Field&gt; &lt;Field key=&quot;SourcingProfile&quot;&gt;'.$EmpStatus.'&lt;/Field&gt; &lt;Field key=&quot;TenureinMonths&quot;&gt;0&lt;/Field&gt; &lt;Field key=&quot;LoanAmount&quot;&gt; '.$LoanAmount.'&lt;/Field&gt; &lt;Field key=&quot;ApplicantFirstName&quot;&gt;'.$fName.'&lt;/Field&gt; &lt;Field key=&quot;ApplicantLastName&quot;&gt;'.$lName.'&lt;/Field&gt; &lt;Field key=&quot;ResidenceMobileNumber&quot;&gt;'.$Mobile.'&lt;/Field&gt; &lt;Field key=&quot;DateofBirth&quot;&gt;'.$DOB.'&lt;/Field&gt; &lt;Field key=&quot;Gender&quot;&gt;'.$Gender.'&lt;/Field&gt; &lt;Field key=&quot;PanNumber&quot;&gt;'.$Pancard.'&lt;/Field&gt; &lt;Field key=&quot;MonthlyTakeHome&quot;&gt;'.$MonthlySal.'&lt;/Field&gt; &lt;Field key=&quot;ResidenceAddress1&quot;&gt;'.$resiadd1.'&lt;/Field&gt; &lt;Field key=&quot;ResidenceAddress2&quot;&gt;'.$resiadd2.'&lt;/Field&gt; &lt;Field key=&quot;ResidenceCity&quot;&gt;'.$resicity.'&lt;/Field&gt; &lt;Field key=&quot;ResidencePinCode&quot;&gt;'.$pincode.'&lt;/Field&gt; &lt;Field key=&quot;ResidenceState&quot;&gt;'.$resistate.'&lt;/Field&gt; &lt;Field key=&quot;CompanyName&quot;&gt;&lt;![CDATA['.$companyname.']]&gt;&lt;/Field&gt; &lt;!--Refers to how long you were staying inthe above address if you are staying from januray 2009 below two fields should have--&gt; 	&lt;!--Duration of Stay Month should always acronymns like Jan Feb Mar--&gt; &lt;Field key=&quot;DurationofStayMonth&quot;&gt;'.$DurationofStayMonth.'&lt;/Field&gt; 	&lt;!--should have numbers only cannot be blank--&gt; &lt;Field key=&quot;DurationofStayYear&quot;&gt;'.$DurationofStayYear.'&lt;/Field&gt; &lt;Field key=&quot;CompanyNameOther&quot;&gt;&lt;![CDATA['.$CompanyNameOther.']]&gt; &lt;/Field&gt; &lt;Field key=&quot;IndustrySector&quot;&gt;'.$IndustrySector.'&lt;/Field&gt; 	&lt;!--should have numbers only cannot be blank In years--&gt; &lt;Field key=&quot;TotalworkExperience&quot;&gt;'.$TotalworkExperience.'&lt;/Field&gt; 	&lt;!--Time since you work with current employer same rule as applicable above--&gt; 	&lt;!--should have numbers only cannot be blank--&gt; &lt;Field key=&quot;CurrentEmployerMonth&quot;&gt;'.$CurrentEmployerMonth.'&lt;/Field&gt; &lt;Field key=&quot;CurrentEmployerYear&quot;&gt;'.$CurrentEmployerYear.'&lt;/Field&gt; 	&lt;!--Have any existing relation with ICICI Yes then send value as true else value will be false--&gt; &lt;Field key=&quot;IciciRelationShip&quot;&gt;'.$IciciRelationShip.'&lt;/Field&gt; 	&lt;!--if above value is true then mention the type of account--&gt; &lt;Field key=&quot;IciciRelationShipText&quot;&gt;'.$IciciRelationShipText.'&lt;/Field&gt; &lt;/Fields&gt; &lt;/DCRequest&gt;]]>';
	$xml_str .= '</xml></CallExternalService>';
	
	$return =  $client->call('CallExternalService', $xml_str);
//echo "<br><br>";	
	//print_r($return);
	$xml = new SimpleXMLElement($return['CallExternalServiceResult']);
	
	$Status = $xml->Status;
	$Authentication_Status =  $xml->Authentication->Status;
	$Authentication_Token =  $xml->Authentication->Token;
	$ResponseInfo_ApplicationId =  $xml->ResponseInfo->ApplicationId;
	$ResponseInfo_SolutionSetInstanceId =  $xml->ResponseInfo->SolutionSetInstanceId;
	$ResponseInfo_CurrentQueue =  $xml->ResponseInfo->CurrentQueue;
	$ContextDataField0 =  $xml->ContextData->Field[0];
	$PLReason =  $xml->ContextData->Field[1];
	$PLResult =  $xml->ContextData->Field[2];
	$ContextDataField3 =  $xml->ContextData->Field[3];
	$EMICalculatedString =  $xml->ContextData->Field[4];
	$ContextDataField5 =  $xml->ContextData->Field[5];
	$ContextDataField6 =  $xml->ContextData->Field[6];
	$ContextDataField7 =  $xml->ContextData->Field[7];
	$ContextDataField8 =  $xml->ContextData->Field[8];
	$ContextDataField9 =  $xml->ContextData->Field[9];
	$ContextDataField10 =  $xml->ContextData->Field[10];
	$BTDataSet =  $xml->ContextData->Field[11];
	$BTEligibleFlag =  $xml->ContextData->Field[12];
	$LoanAmountString =  $xml->ContextData->Field[13];
	
	
$Dated = ExactServerdate();
	$data = array('RequestID'=>$RequestID, 'Status'=>$Status, 'Authentication_Status'=>$Authentication_Status, 'Authentication_Token'=>$Authentication_Token, 'ResponseInfo_ApplicationId'=>$ResponseInfo_ApplicationId, 'PLReason'=>$PLReason, 'PLResult'=>$PLResult, 'EMICalculatedString'=>$EMICalculatedString, 'LoanAmountString'=>$LoanAmountString, 'BTDataSet'=>$BTDataSet, 'BTEligibleFlag'=>$BTEligibleFlag, 'ResponseInfo_SolutionSetInstanceId'=>$ResponseInfo_SolutionSetInstanceId);
	$table = 'icici_exclusive_transunion';
	$lastID = Maininsertfunc ($table, $data);
	$getDetailSql = "select PLReason,PLResult from icici_exclusive_transunion where id = '".$lastID."'";
	list($alreadyExist,$getDetailsQuery)=MainselectfuncNew($getDetailSql,$array = array());
	$getDetailsQuerycontr=count($getDetailsQuery)-1;

	$details[] = $getDetailsQuery[0]['PLReason'];
	$details[]= $getDetailsQuery[0]['PLResult'];
	return $details;
	
}
?>