<?php 
require 'scripts/db_init.php';
require_once('webservice/nusoaptu.php'); 

$client= new nusoap_client("http://www.test.transuniondecisioncentre.co.in/dc/TU.SSPL.Wrapper/wrapper.asmx?wsdl", true);

//$client= new nusoap_client("https://www.test.transuniondecisioncentre.co.in/TU.IDS.ExternalServices_uat/Static_DCExternalService/ExternalSolutionExecutionService.wsdl", true);


if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$icicirequestID= $_POST["RequestID"];
	$Pancard = $_POST["Pancard"];
	$existing_rel = $_POST["existing_rel"];
	$Pincode = $_POST["Pincode"];
	$Address_City = $_POST["Address_City"];
	$Address_State = $_POST["Address_State"];
	$Gender = $_POST["Gender"];
	$staymonth = $_POST["staymonth"];
	$stayyear = $_POST["stayyear"];
	$employmonth = $_POST["employmonth"];
	$employyear = $_POST["employyear"];
	$industry_sector = $_POST["industry_sector"];
	$Residence_Address_line1 = $_POST["Residence_Address_line1"];
	$Residence_Address_line2 = $_POST["Residence_Address_line2"];
	//select details
	$creditcarddt ="select RequestID, 	Total_Experience,DOB,Company_Name,Mobile_Number,Net_Salary,Employment_Status,Loan_Amount,Name,City,City_Other from  ICICI_Allocated_Leads Where (icicirequestID=".$icicirequestID.")";
	list($newrecordcount,$row)=Mainselectfunc($creditcarddt,$array = array());
	$RequestID= $row["RequestID"];
 	$Total_Experience = $row["Total_Experience"];	
	list($TotalExperience,$fract) = split('[.]',$Total_Experience);
	$DOB = $row["DOB"];
	$Company_Name = $row["Company_Name"];
	$Mobile_Number = $row["Mobile_Number"];
	$Net_Salary = $row["Net_Salary"];
	$Employment_Status = $row["Employment_Status"];
	$monthlyincome = $Net_Salary/12;
	list($monthly,$fraction) = split('[.]',$monthlyincome);
	list($LoanAmount,$fraction) = split('[.]',$row["Loan_Amount"]);
	list($first,$last) = split('[ ]',$row["Name"]);
	if($last=="")
	{
		$last= "K";
	}
	list($year,$month,$day) = split('[/.-]', $DOB);
	$dobstr=$day."/".$month."/".$year;
	$City = $row["City"];
	$City_Other = $row["City_Other"];
	if($City =="Others" && strlen($City_Other)>0)
	{
		$Citystr = $City_Other;
	}
	else
	{
		$Citystr = $City;
	}
	if($Employment_Status==0) { $emp_status="Self employed non professional"; } else { $emp_status="Salaried"; }

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


$xml_str = '<CallExternalService xmlns="http://tempuri.org/"><xml>';
	$xml_str .= '<![CDATA[&lt;?xml version=&quot;1.0&quot;?&gt; &lt;DCRequest xmlns=&quot;http://transunion.com/dc/extsvc&quot;&gt; &lt;Authentication type=&quot;OnDemand&quot;&gt; &lt;UserId&gt;ICICI_PL_Deals4loan&lt;/UserId&gt; &lt;Password&gt;Password@123&lt;/Password&gt; &lt;/Authentication&gt; &lt;RequestInfo&gt; &lt;ExecutionMode&gt;NewWithContext&lt;/ExecutionMode&gt; &lt;SolutionSetId&gt;347&lt;/SolutionSetId&gt; &lt;SolutionSetVersion&gt;103&lt;/SolutionSetVersion&gt; &lt;/RequestInfo&gt; &lt;UserData/&gt; &lt;Fields&gt; &lt;Field key=&quot;CIRpath&quot;&gt;'.$CIRpath.'&lt;/Field&gt; &lt;Field key=&quot;EnvironmentType&quot;&gt;'.$EnvironmentType.'&lt;/Field&gt; &lt;Field key=&quot;SourcingProfile&quot;&gt;'.$SourcingProfile.'&lt;/Field&gt; &lt;Field key=&quot;TenureinMonths&quot;&gt;0&lt;/Field&gt; &lt;Field key=&quot;LoanAmount&quot;&gt;'.$LoanAmount.'&lt;/Field&gt; &lt;Field key=&quot;ApplicantFirstName&quot;&gt;'.$ApplicantFirstName.'&lt;/Field&gt; &lt;Field key=&quot;ApplicantLastName&quot;&gt;'.$ApplicantLastName.'&lt;/Field&gt; &lt;Field key=&quot;ResidenceMobileNumber&quot;&gt;'.$ResidenceMobileNumber.'&lt;/Field&gt; &lt;Field key=&quot;DateofBirth&quot;&gt;'.$DateofBirth.'&lt;/Field&gt; &lt;Field key=&quot;Gender&quot;&gt;'.$Gender.'&lt;/Field&gt; &lt;Field key=&quot;PanNumber&quot;&gt;'.$Pancard.'&lt;/Field&gt; &lt;Field key=&quot;MonthlyTakeHome&quot;&gt;'.$MonthlySal.'&lt;/Field&gt; &lt;Field key=&quot;ResidenceAddress1&quot;&gt;'.$Residence_Address_line1.'&lt;/Field&gt; &lt;Field key=&quot;ResidenceAddress2&quot;&gt;'.$Residence_Address_line2.'&lt;/Field&gt; &lt;Field key=&quot;ResidenceCity&quot;&gt;'.$resicity.'&lt;/Field&gt; &lt;Field key=&quot;ResidencePinCode&quot;&gt;'.$pincode.'&lt;/Field&gt; &lt;Field key=&quot;ResidenceState&quot;&gt;'.$resistate.'&lt;/Field&gt; &lt;Field key=&quot;CompanyName&quot;&gt;&lt;![CDATA['.$companyname.']]&gt;&lt;/Field&gt; &lt;!--Refers to how long you were staying inthe above address if you are staying from januray 2009 below two fields should have--&gt; 	&lt;!--Duration of Stay Month should always acronymns like Jan Feb Mar--&gt; &lt;Field key=&quot;DurationofStayMonth&quot;&gt;'.$DurationofStayMonth.'&lt;/Field&gt; 	&lt;!--should have numbers only cannot be blank--&gt; &lt;Field key=&quot;DurationofStayYear&quot;&gt;'.$DurationofStayYear.'&lt;/Field&gt; &lt;Field key=&quot;CompanyNameOther&quot;&gt;&lt;![CDATA['.$CompanyNameOther.']]&gt; &lt;/Field&gt; &lt;Field key=&quot;IndustrySector&quot;&gt;'.$IndustrySector.'&lt;/Field&gt;&lt;!--should have numbers only cannot be blank In years--&gt; &lt;Field key=&quot;TotalworkExperience&quot;&gt;'.$TotalworkExperience.'&lt;/Field&gt; 	&lt;!--Time since you work with current employer same rule as applicable above--&gt; 	&lt;!--should have numbers only cannot be blank--&gt; &lt;Field key=&quot;CurrentEmployerMonth&quot;&gt;'.$CurrentEmployerMonth.'&lt;/Field&gt; &lt;Field key=&quot;CurrentEmployerYear&quot;&gt;'.$CurrentEmployerYear.'&lt;/Field&gt; 	&lt;!--Have any existing relation with ICICI Yes then send value as true else value will be false--&gt; &lt;Field key=&quot;IciciRelationShip&quot;&gt;'.$IciciRelationShip.'&lt;/Field&gt; 	&lt;!--if above value is true then mention the type of account--&gt; &lt;Field key=&quot;IciciRelationShipText&quot;&gt;'.$IciciRelationShipText.'&lt;/Field&gt; &lt;/Fields&gt; &lt;/DCRequest&gt;]]>';
	$xml_str .= '</xml></CallExternalService>';

echo "<br><br>";
	echo $xml_str;
echo "<br><br>";

	$return =  $client->call('CallExternalService', $xml_str);
echo "<br><br>";	
//	print_r($return);
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
	

	$Residence_Address_line= $Residence_Address_line1."".$Residence_Address_line2;

	$Dated = ExactServerdate();
	$dataInsert = array('icicirequestID'=>$icicirequestID, 'RequestID'=>$RequestID, 'Panno'=>$Pancard, 'Address'=>$Residence_Address_line, 'City'=>$Address_City, 'Resistate'=>$Address_State, 'DurationofStayMonth'=>$staymonth, 'DurationofStayYear'=>$stayyear, 'CurrentEmployerMonth'=>$employmonth, 'CurrentEmployerYear'=>$employyear, 'Industry_sector'=>$industry_sector, 'Status'=>$Status, 'Authentication_Status'=>$Authentication_Status, 'ApplicationID'=>$ResponseInfo_ApplicationId, 'PLReason'=>$PLReason, 'PLResult'=>$PLResult, 'EMIPeriod'=>$ContextDataField3, 'EMICalculatedString'=>$EMICalculatedString, 'FixedTenure'=>$FixedTenure, 'FixedLoanAmount'=>$FixedLoanAmount, 'FixedROI'=>$FixedROI, 'FixedEMI'=>$FixedEMI, 'FixedProcessingFee'=>$FixedProcessingFee, 'OBPLAvailable'=>$OBPLAvailable, 'BTDataSet'=>$BTDataSet, 'BTEligibleFlag'=>$BTEligibleFlag, 'LoanAmountString'=>$LoanAmountString, 'Dated'=>$Dated, 'flag'=>'2', 'Existing_Relation'=>$existing_rel, 'Pincode'=>$Pincode, 'Gender'=>$Gender);
		$table = 'icici_pl_cibili_check';
		$lastID = Maininsertfunc ($table, $data);

$EMICalculatedarry = explode("|",$EMICalculatedString);

	
}


echo "TU STatus : ".$Status."<br>";
echo "TU Result : ".$PLResult."<br><br>";
?>
<table>
<tr>
<td>
<table border=1 width="500">
<tr>
			<td>Tenure</td><td>Loan Amount</td><td>Rate</td><td>EMI</td><td>P.F</td><td>PF value</td></tr>

<?


if(count($EMICalculatedarry)>0)
{ 
	$valuearr="";
	for($i=0;$i<count($EMICalculatedarry);$i++)
	{	
		if(strlen(($EMICalculatedarry[$i])>1))
		{
			
		$valuearr=explode(",",$EMICalculatedarry[$i]);
				?>
			<tr>
			<td><? echo $valuearr[0]; ?></td><td><? echo $valuearr[1]; ?></td><td><? echo $valuearr[2]; ?></td><td><? echo $valuearr[3]; ?></td><td><? echo $valuearr[4]; ?></td><td><? echo $valuearr[5]; ?></td>
			</tr>
			
		<? 
		}
	}

 } ?>
</table>
</td>
</tr>
<table>