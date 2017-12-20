<?php
require 'scripts/db_init.php';
require_once('webservice/nusoaptu.php'); 

//print_r($_POST);
//$client= new nusoap_client("https://www.test.transuniondecisioncentre.co.in/dc/TU.SSPL.Wrapper/wrapper.asmx?wsdl", true);
$client= new nusoap_client("https://www.dc.transuniondecisioncentre.co.in/dc/TU.SSPL.Wrapper/wrapper.asmx?wsdl", true);//Live Link

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$RequestID = $_POST["RequestID"];
	$telecallerid = $_POST["telecallerid"];
	$icicicheck2 = $_POST["icicicheck2"];
	$icicicheck1 = $_POST["icicicheck1"];
	$cc_bankid = $_POST["cc_bankid"];
	$Pancard = $_POST["Pancard"];
	$existing_relationship = $_POST["existing_relationship"]; 
	$Residence_Address_line1 = $_POST["Residence_Address_line1"];
	$Residence_Address_line2 = $_POST["Residence_Address_line2"];
	$Residence_Address_line3 = $_POST["Residence_Address_line3"];
	$Pincode = $_POST["Pincode"];
	$Address_City = $_POST["Address_City"];
	$Address_State = $_POST["Address_State"];
	$Gender = $_POST["Gender"];
	$Company_Type = $_POST["Company_Type"];
	$stdcode = $_POST["stdcode"];
	$landline = $_POST["landline"];
	$existing_rel = $_POST["existing_rel"];
	$completeaddresstr = $Residence_Address_line1." ".$Residence_Address_line2." ".$Residence_Address_line3;
	$completeaddres = substr(trim($completeaddresstr),0,40);
	//select details
	$creditcarddt ="select Name,DOB,Mobile_Number,Employment_Status,City,City_Other,Net_Salary,Company_Name from icici_cards_calling Where (RequestID=".$RequestID.")";
	list($rowcount,$row)=MainselectfuncNew($creditcarddt,$array = array());
	$rowcontr=count($row)-1;
	$DOB = $row["DOB"];
	$Company_Name = $row[$rowcontr]["Company_Name"];
	$Mobile_Number = $row[$rowcontr]["Mobile_Number"];
	$Net_Salary = $row[$rowcontr]["Net_Salary"];
	$Employment_Status = $row[$rowcontr]["Employment_Status"];
	$monthlyincome = $Net_Salary/12;
	list($monthly,$fraction) = split('[.]',$monthlyincome);
	list($first,$last) = split('[ ]',$row[$rowcontr]["Name"]);
	if($last=="")
	{
		$last= "K";
	}
	list($year,$month,$day) = split('[/.-]', $DOB);
	$dobstr=$day."/".$month."/".$year;
	$City = $row[$rowcontr]["City"];
	$City_Other = $row[$rowcontr]["City_Other"];
	if($City =="Others" && strlen($City_Other)>0)
	{
		$Citystr = $City_Other;
	}
	else
	{
		$Citystr = $City;
	}
	if($Employment_Status==0) { $emp_status="Selfemployed"; } else { $emp_status="Salaried"; }

if($Employment_Status==1)
	{
$creditcarddtcomp ='select company_category from  HDFC_CC_Company_List Where (hdfc_company_name="'.$Company_Name.'")';
list($rowcount,$rowcn)=MainselectfuncNew($creditcarddtcomp,$array = array());
$rowcncontr=count($rowcn)-1;
	if(strlen($rowcn[$rowcncontr]["company_category"])>0)
	{
		$Typeofcompany=ucfirst(strtolower($rowcn[$rowcncontr]["company_category"]));
		if($Typeofcompany=="Prefered" || $Typeofcompany=="PREFERRED")
		{
			$Typeofcompany="Preffered";
		}	

	}
	else
	{
		$Typeofcompany="Others";
	}
	}
	else
	{
		$Typeofcompany="Others";
	}
if($existing_rel=="")
	{
		$existing_rel="Norelationship";
	}

$Userid = "icici_deals4loans";
$pwd = "Password@123";
$EnvironmentType = "P";
$Reference_Number = "U010000104854";//D4L0000000011;
$Purpose = "10";
$Amount = 50000;
$ScoreType = '01';
$ApplicantFirstName = $first;
$ApplicantLastName = $last;
$Gender = $Gender;
$DateOfBirth = $dobstr; //dd/mm/yyyy
//$DateOfBirth = "09/06/1978";
$ResidenceCode = "01";// 01 = Owned 02 = Rented 
$ResidenceAddress1 = $completeaddres;
//$ResidenceAddress1 ="B-16 SF, PArshanath, Mohan Ghaziabad";
$ResidencePincode = $Pincode;
$City = $Address_City;
$ResidenceState = $Address_State;
$CountryCode = "356";
$ResidenceMobileNo = $Mobile_Number;
$CreditCardType = "-1";
$MonthlyIncome = round($monthly);
//$MonthlyIncome=100000;
$PanNo = $Pancard;
$ICICIBankRelationship = $existing_rel; // Salary, Saving, Current, Loan, Noreleationship // case sensitice
$Typeofcompany = $Typeofcompany; //Elite, Superprime, Preffered, Others, Selfemployed // case sensitice
$CustomerProfile = $emp_status; // Salaried,Selfemployed // case sensitice
$ApplicationDate = date("m/d/Y H:m:s A");

//06/19/2014 19:32:19 PM;
$chckavl = "Select cibilchkid from credit_card_cibil_check Where (RequestID=".$RequestID." and RuleStatus!='')";
list($icicichkcount,$icicichk)=MainselectfuncNew($chckavl,$array = array());
$icicichkcontr = count($icicichk)-1;

if($icicichk[$icicichkcontr]["cibilchkid"]>0)
	{
		echo "NO SECOND ATTEMPT PLS";
	}
	else
	{
//&lt;?xml version=&quot;1.0&quot;?&gt;
$xml_str = '<CallExternalService xmlns="http://tempuri.org/"><xml>';
$xml_str .= '<![CDATA[ &lt;DCRequest xmlns=&quot;http://transunion.com/dc/extsvc&quot;&gt;&lt;Authentication type=&quot;OnDemand&quot;&gt;&lt;UserId&gt;icici_deals4loans&lt;/UserId&gt;&lt;Password&gt;Password@123&lt;/Password&gt;&lt;/Authentication&gt;&lt;RequestInfo&gt;&lt;SolutionSetId&gt;133&lt;/SolutionSetId&gt;&lt;SolutionSetVersion&gt;84&lt;/SolutionSetVersion&gt;&lt;ExecutionMode&gt;NewWithContext&lt;/ExecutionMode&gt;&lt;/RequestInfo&gt;&lt;UserData /&gt;&lt;Fields&gt;&lt;Field key=&quot;EnvironmentType&quot;&gt;P&lt;/Field&gt;&lt;Field key=&quot;Reference_Number&quot;&gt;U010000104854&lt;/Field&gt;&lt;Field key=&quot;Purpose&quot;&gt;10&lt;/Field&gt;&lt;Field key=&quot;Amount&quot;&gt;'.$Amount.'&lt;/Field&gt;&lt;Field key=&quot;ScoreType&quot;&gt;01&lt;/Field&gt;&lt;Field key=&quot;ApplicantFirstName&quot;&gt;'.$ApplicantFirstName.'&lt;/Field&gt;&lt;Field key=&quot;ApplicantMiddleName&quot; /&gt;&lt;Field key=&quot;ApplicantLastName&quot;&gt;'.$ApplicantLastName.'&lt;/Field&gt;&lt;Field key=&quot;Gender&quot;&gt;'.$Gender.'&lt;/Field&gt;&lt;Field key=&quot;DateOfBirth&quot;&gt;'.$DateOfBirth.'&lt;/Field&gt;&lt;Field key=&quot;ResidenceCode&quot;&gt;'.$ResidenceCode.'&lt;/Field&gt;&lt;Field key=&quot;ResidenceAddress1&quot;&gt;'.$ResidenceAddress1.'&lt;/Field&gt;&lt;Field key=&quot;ResidenceAddress2&quot; /&gt;&lt;Field key=&quot;ResidenceAddress3&quot; /&gt;&lt;Field key=&quot;ResidenceAddress4&quot; /&gt;&lt;Field key=&quot;ResidenceAddress5&quot; /&gt;&lt;Field key=&quot;Location&quot; /&gt;&lt;Field key=&quot;Town&quot; /&gt;&lt;Field key=&quot;ResidencePincode&quot;&gt;'.$ResidencePincode.'&lt;/Field&gt;&lt;Field key=&quot;City&quot;&gt;'.$City.'&lt;/Field&gt;&lt;Field key=&quot;ResidenceState&quot;&gt;'.$Address_State.'&lt;/Field&gt;&lt;Field key=&quot;STDCode&quot; /&gt;&lt;Field key=&quot;CityShortName&quot; /&gt;&lt;Field key=&quot;ResidenceStateShortName&quot; /&gt;&lt;Field key=&quot;CountryCode&quot;&gt;356&lt;/Field&gt;&lt;Field key=&quot;ResidencePhoneNumber&quot; /&gt;&lt;Field key=&quot;ResidenceMobileNo&quot;&gt;'.$ResidenceMobileNo.'&lt;/Field&gt;&lt;Field key=&quot;CreditCardType&quot;&gt;-1&lt;/Field&gt;&lt;Field key=&quot;CreditCardTemplate&quot; /&gt;&lt;Field key=&quot;NACSDMAID&quot; /&gt;&lt;Field key=&quot;NACSDMACITY&quot; /&gt;&lt;Field key=&quot;MonthlyIncome&quot;&gt;'.$MonthlyIncome.'&lt;/Field&gt;&lt;Field key=&quot;PanNo&quot;&gt;'.$PanNo.'&lt;/Field&gt;&lt;Field key=&quot;PassportNo&quot; /&gt;&lt;Field key=&quot;VoterId&quot; /&gt;&lt;Field key=&quot;FutureUse1&quot; /&gt;&lt;Field key=&quot;FutureUse2&quot; /&gt;&lt;Field key=&quot;ConsumerName4&quot; /&gt;&lt;Field key=&quot;ConsumerName5&quot; /&gt;&lt;Field key=&quot;DLNo&quot; /&gt;&lt;Field key=&quot;UId&quot; /&gt;&lt;Field key=&quot;RationCardNo&quot; /&gt;&lt;Field key=&quot;AdditionalID1&quot; /&gt;&lt;Field key=&quot;AdditionalID2&quot; /&gt;&lt;Field key=&quot;ResidenceTelephoneExtension1&quot; /&gt;&lt;Field key=&quot;ResidenceTelephoneExtension2&quot; /&gt;&lt;Field key=&quot;ICICIBankRelationship&quot;&gt;'.$ICICIBankRelationship.'&lt;/Field&gt;&lt;Field key=&quot;Typeofcompany&quot;&gt;'.$Typeofcompany.'&lt;/Field&gt;&lt;Field key=&quot;ApplicationDate&quot;&gt;'.$ApplicationDate.'&lt;/Field&gt;&lt;Field key=&quot;QACIRFilePath&quot;&gt;D:\DecisionCentre\QA\ICICI\&lt;/Field&gt;&lt;Field key=&quot;FileName&quot;&gt;Scenario1.xml&lt;/Field&gt;&lt;/Fields&gt;&lt;/DCRequest&gt;]]>';
	$xml_str .= '</xml></CallExternalService>';	
echo $xml_str;
	$return =  $client->call('CallExternalService', $xml_str);
	
	$return['CallExternalServiceResult'];
	$xml = new SimpleXMLElement($return['CallExternalServiceResult']);
	
	$Status = $xml->Status;// result
	$Authentication_Status =  $xml->Authentication->Status;// result
	
	$Authentication_Token =  $xml->Authentication->Token;
	
	$ResponseInfo_ApplicationId =  $xml->ResponseInfo->ApplicationId; // ApplicationID
	
	$ResponseInfo_SolutionSetInstanceId =  $xml->ResponseInfo->SolutionSetInstanceId;
	
	$ResponseInfo_CurrentQueue =  $xml->ResponseInfo->CurrentQueue;
	
	$ContextDataField0 =  $xml->ContextData->Field[0];
	
	$PLReason =  $xml->ContextData->Field[1];
	
	$FirstName =  $xml->ContextData->Field[2]; //First name
	
	$LastName =  $xml->ContextData->Field[3];//Last name
	
	$EMICalculatedString =  $xml->ContextData->Field[4];
	
	$ApplicationID =  $xml->ContextData->Field[5]; // ApplicationID

	$ContextDataField6 =  $xml->ContextData->Field[6];
	
	$ContextDataField7 =  $xml->ContextData->Field[7];

	$ContextDataField8 =  $xml->ContextData->Field[8];

	$ContextDataField9 =  $xml->ContextData->Field[9];

	$Gender =  $xml->ContextData->Field[10];//Gender
	$BTDataSet =  $xml->ContextData->Field[11];
	
	$MonthlyIncome =  $xml->ContextData->Field[12]; //Monthly INcome
	$LoanAmountString =  $xml->ContextData->Field[13];
	$TUEF_ErrorDescription =  $xml->ContextData->Field[32];
	$TUEF_ErrorResponse =  $xml->ContextData->Field[33];
	$RuleStatus =  $xml->ContextData->Field[34];
	$StatusDescription =  $xml->ContextData->Field[35]; // Status Description
	
		$CreditScore =  $xml->ContextData->Field[57];
	
if($RequestID>0)
	{
		$Dated = ExactServerdate();
		$dataInsert = array('RequestID'=>$RequestID, 'PanNo'=>$Pancard, 'Result'=>$Status, 'Pincode'=>$Pincode, 'Address'=>$completeaddres, 'City'=>$Address_City, 'State'=>$Address_State, 'Gender'=>$Gender, 'existing_relation'=>$existing_rel, 'Status'=>$Authentication_Status, 'Status_Description'=>$TUEF_ErrorDescription, 'Credit_Score'=>$CreditScore, 'ApplicationID'=>$ApplicationID, 'Dated'=>$Dated, 'RuleStatus'=>$RuleStatus, 'icici_check1'=>$icicicheck1, 'icici_check2'=>$icicicheck2, 'Response'=>$TUEF_ErrorResponse, 'Type_Of_Company'=>$Typeofcompany, 'flag'=>'2', 'TelecallerID'=>$telecallerid);
		$getcibilreportQuery = Maininsertfunc ('credit_card_cibil_check', $dataInsert);
	}
	//PUT CLAUSE END HERE

	}
}
echo "TU STatus : ".$RuleStatus."<br><br>";
$toreplace = array("<Response><Status>", "</Status><ErrorCode>", "</ErrorCode><ErrorDescription>","</ErrorDescription><Segment>","</ErrorDescription><Segment>","</Segment></Response>");
$replacewid   = array(",", ",", ",", ",", ",", ",");
$newphrase = str_replace($toreplace, $replacewid, $TUEF_ErrorResponse);
$newphrase1 = explode(",",$newphrase);
echo "Response : <br> ErrorCode : ".$newphrase1[2]."<br> ErrorDescription : ".$newphrase1[3]."<br> Segment : ".$newphrase1[4]."";
	?>
