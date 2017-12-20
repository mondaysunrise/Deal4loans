<?php
require 'scripts/db_init.php';
require 'errorLogReporting.php';
require_once ("lib/nusoap.php");

/*if (!empty($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR']!='192.124.249.12' && $_SERVER['REMOTE_ADDR']!='185.93.228.12')
{
        exit; 
}
else
{
	PNBHFL_HL();
}
*/
PNBHFL_HL();

function PNBHFL_HL()
{
	$today=Date('Y-m-d');
	$tomorrow  = mktime(0, 0, 0, date("m")  , date("d"), date("Y"));
	$currentdate=date('Y-m-d',$tomorrow);

	$mindate=$currentdate." 00:00:00";
	$maxdate=$today." 23:59:59";

	$query1="Select RequestID from Req_Compaign Where (Reply_Type=1 and Bank_Name='PNB HFL' and BidderID=3603)";
	$result1 = ExecQuery($query1);

	while($row1 = mysql_fetch_array($result1))
	{
		$requestid= $row1["RequestID"];
	}
	If((strlen(trim($requestid))<=0))
	{	
		$query="SELECT Name,Email,Mobile_Number,City,City_Other,Loan_Amount,Net_Salary,DOB,Pancard,Gender,Property_Value,Existing_Loan,Existing_Bank,Pincode,Residence_Address,Property_Loc,Total_Experience,RequestID,Feedback_ID,BidderID,Allocation_Date FROM Req_Feedback_Bidder_HL,Req_Loan_Home WHERE Req_Feedback_Bidder_HL.AllRequestID= Req_Loan_Home.RequestID and Req_Feedback_Bidder_HL.BidderID in (3603,7216) and Req_Feedback_Bidder_HL.Reply_Type=2 and (Req_Feedback_Bidder_HL.Allocation_Date between '".$mindate."' and '".$maxdate."') order by Feedback_ID ASC";
	}
	else
	{
		$query="SELECT Name,Email,Mobile_Number,City,City_Other,Loan_Amount,Net_Salary,DOB,Pancard,Gender,Property_Value,Existing_Loan,Existing_Bank,Pincode,Residence_Address,Property_Loc,Total_Experience,RequestID,Feedback_ID,BidderID,Allocation_Date FROM Req_Feedback_Bidder_HL,Req_Loan_Home WHERE Req_Feedback_Bidder_HL.AllRequestID= Req_Loan_Home.RequestID and Req_Feedback_Bidder_HL.BidderID in (3603,7216)  and Req_Feedback_Bidder_HL.Reply_Type=2 and Req_Feedback_Bidder_HL.Feedback_ID>'".$requestid."' and (Req_Feedback_Bidder_HL.Allocation_Date between '".$mindate."' and '".$maxdate."') order by Feedback_ID ASC";
	}
	//echo $query."<br>";

	$tataplqryresult = d4l_ExecQuery($query);
	while($row=d4l_mysql_fetch_array($tataplqryresult))
	{
		$BidderID = $row["BidderID"];
		$RequestID = $row["RequestID"];
		$Feedback_ID = $row["Feedback_ID"];
		$Name = $row["Name"];
		$Email = $row["Email"];
		$Mobile_Number = $row["Mobile_Number"];
		$City = $row["City"];
		$City_Other = $row["City_Other"];
		$Loan_Amount = $row["Loan_Amount"];
		$Net_Salary = $row["Net_Salary"];
		list($salary,$slast) = explode('.',$Net_Salary);
		$monthlyincome= round($salary/12 ,2);
		$DOB = $row["DOB"];
		list($year,$month,$day) = explode('-',$DOB);
		$strdob = $day."/".$month."/".$year;
		$Pancard = $row['Pancard'];
		$Gender = $row['Gender'];
		$Property_Value = $row['Property_Value'];
		$Existing_Bank = $row['Existing_Bank'];
		$Pincode = $row['Pincode'];
		$Residence_Address = $row['Residence_Address'];
		$Employment_Status = $row['Employment_Status'];
		$Existing_Loan = $row['Existing_Loan'];
		$Property_Loc = $row['Property_Loc'];
		$Total_Experience = $row['Total_Experience'];

		if($City=="Others" && Strlen($City_Other)>0)
		{
			$strcity=$City_Other;
		}
		else
		{
			$strcity=$City;
		}

		$propertyCity= getpropertyCityCode(strtoupper($Property_Loc));
		$resCity= getpropertyCityCode(strtoupper($strcity));

		//Normal Or BT (if Existing Loan > 0 then nature of Loan is BT and btOutstandingBalance is LoanAmount)
		if($Existing_Loan > 0){
			$natureOfLoan = '2'; //2 For BT
		}
		else{
			$natureOfLoan = '1'; //1 For Normal
		}
		
		if($natureOfLoan == '2'){
			$btOutstandingBalance = $Loan_Amount;
		}
		else{
			$btOutstandingBalance = '';
		}
		
		if($Employment_Status == 1){
			$empType = 1;
			$annualBusinessIncome = '';
			$irr = 8.50;
		}
		else{
			$empType = 2;
			$annualBusinessIncome = round($Net_Salary,2);
			$irr = 8.70;
		}
		
		if($Gender == 2){
			$gender = 2;
		}
		else{
			$gender = 1;
		}

		
		$propertyCity = $propertyCity;
		$loanPurpose= '1'; // 1 ForResidential Home Purchase Loan (HOMPURLN)
		$costConstruction= '';
		$costHomeFlat= $Property_Value;
		$costLand= '';
		$builderProjectDetails= '';
		$natureOfLoan= $natureOfLoan;
		$btCurrentLender= '';
		$currentLoanStartDate= '';
		$btOutstandingBalance= $btOutstandingBalance;
		$marketValueOfProperty= $Property_Value;
		$loanTopupAmount= '';
        $outstandingLoanBalance= '';
        $costProperty= '';
        $firstName= $Name;
        $middleName= '';
        $lastName= '';
        $dob= $strdob;
        $pan= $Pancard;
        //$pan= 'ABCDV2345D';
        $gender= $gender;
        $residenceType= '1'; // 1 For Resident
        $resCity= $propertyCity;
        $resPIN= $Pincode;
        $resAddress1= $Residence_Address;
        $resAddress2= '';
        $workExp= '';
        $empType= $empType;
        $mobile = $Mobile_Number;
        //$mobile = '8899870594';
        $email = $Email;
        $loanAmount = $Loan_Amount;
        $gmi = $monthlyincome;
        $annualBusinessIncome = $annualBusinessIncome;
        $monthsCurrentOrg = round($Total_Experience);
        $irr = $irr;
        $irrType = '1'; //For Floating
		
		$xmlstr='<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ser="http://services.lending.kastle.infotech.com/">
		   <soapenv:Header/>
			<soapenv:Body>
				<ser:createLongForm>
				<arg0>
					<authentication>
					   <interfaceId>INTF61</interfaceId>
					   <partnerUnqId>5</partnerUnqId>
					   <password>pnbhfllems</password>
					   <userId>pnbhfllems</userId>
					   <version>1</version>
					</authentication>
					<homeLoan>
						<propertyCity>'.$propertyCity.'</propertyCity>
						<loanPurpose>'.$loanPurpose.'</loanPurpose>
						<costConstruction>'.$costConstruction.'</costConstruction>
						<costHomeFlat>'.$costHomeFlat.'</costHomeFlat>
						<costLand>'.$costLand.'</costLand>
						<builderProjectDetails>'.$builderProjectDetails.'</builderProjectDetails>
						<natureOfLoan>'.$natureOfLoan.'</natureOfLoan>
						<btCurrentLender>'.$btCurrentLender.'</btCurrentLender>
						<currentLoanStartDate>'.$currentLoanStartDate.'</currentLoanStartDate>
						<btOutstandingBalance>'.$btOutstandingBalance.'</btOutstandingBalance>
						<marketValueOfProperty>'.$marketValueOfProperty.'</marketValueOfProperty>
						<loanTopupAmount>'.$loanTopupAmount.'</loanTopupAmount>
						<outstandingLoanBalance>'.$outstandingLoanBalance.'</outstandingLoanBalance>
						<costProperty>'.$costProperty.'</costProperty>
						<firstName>'.$firstName.'</firstName>
						<middleName >'.$middleName.'</middleName >
						<lastName>'.$lastName.'</lastName>
						<dob>'.$dob.'</dob>
						<pan>'.$pan.'</pan>
						<gender>'.$gender.'</gender>
						<residenceType>'.$residenceType.'</residenceType>
						<resCity>'.$resCity.'</resCity>
						<resPIN>'.$resPIN.'</resPIN>
						<resAddress1>'.$resAddress1.'</resAddress1>
						<resAddress2>'.$resAddress2.'</resAddress2>
						<workExp>'.$workExp.'</workExp>
						<empType>'.$empType.'</empType>
						<gmi>'.$gmi.'</gmi>
						<monthlyIncentive></monthlyIncentive>
						<currentEMI></currentEMI>
						<currentBizStartDate></currentBizStartDate>
						<profession></profession>
						<annualProfessionalIncome></annualProfessionalIncome>
						<otherIncome></otherIncome>
						<grossProfReceipts></grossProfReceipts>
						<annualBusinessIncome>'.$annualBusinessIncome.'</annualBusinessIncome>
						<organization></organization>
						<monthsCurrentOrg>'.$monthsCurrentOrg.'</monthsCurrentOrg>
						<coApplicantRelationship></coApplicantRelationship>
						<coAppEmpType></coAppEmpType>
						<coAppGMI></coAppGMI>
						<coAppCurrentEMI></coAppCurrentEMI>
						<mobile>'.$mobile.'</mobile>
						<email>'.$email.'</email>
						<tenureMonths></tenureMonths>
						<loanAmount>'.$loanAmount.'</loanAmount>
						<irr>'.$irr.'</irr>
						<irrType>'.$irrType.'</irrType>
						<offAddress1></offAddress1>
						<offAddress2></offAddress2>
						<offCity></offCity>
						<offPIN></offPIN>
						<offPhone></offPhone>
					</homeLoan>
				</arg0>
				</ser:createLongForm>
		   </soapenv:Body>
		</soapenv:Envelope>';
		//echo $xmlstr."<br><br>";

		$url = 'https://customerservice.pnbhousing.com:9061/services/KastleLEMSServices?wsdl';
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, 4);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $xmlstr);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: text/xml','Content-Type: text/xml'));
		$xml_string = curl_exec($ch);
		curl_close($ch); 
		//echo '<pre>';print_r($xml_string);
		$full_response = $xml_string;

		$expires = preg_split('/errorInfo/', $xml_string);
		array_shift($expires);
		$strcheck=implode(" ",$expires);
		$check=explode(" ",$strcheck);

		$xml_string =  str_replace(">", "", str_replace("</", "", $check[0]));

		$qrydt= ExecQuery("INSERT INTO webservice_bidder_details (leadid,product,request_xml,feedback,bidderid,doe, cust_requestid,final_feedback) VALUES('".$Feedback_ID."','2','".$xmlstr."','".$xml_string."','".$BidderID."',NOW(),'".$RequestID."','".$full_response."')");

		if ($xml_string == "Success")
		{
			$iWebServiceStatus = WEBSERVICE_STATUS_SUCCESS;
		}
		else if ($xml_string == "FAIL")
		{
			$iWebServiceStatus = WEBSERVICE_STATUS_FAILED_DATA_ISSUE;
		}
		else
		{
			$iWebServiceStatus = WEBSERVICE_STATUS_FAILED;
		}

		$errorLogReporting = new errorLogReporting();
		$errorLogReporting->errorReportInsertion($iWebServiceStatus, $xml_string, $ClientName, $product=2, $BidderID=3603, $AllRequestID, $webServiceID=9, $Allocation_Date);
		//echo "<br>";	

		if($Feedback_ID>0)
		{
			$update =ExecQuery("Update Req_Compaign set RequestID='".$Feedback_ID."' where (Reply_Type=1 and Bank_Name='PNB HFL' and BidderID=3603)");
			//echo "Update Req_Compaign set RequestID='".$Feedback_ID."' where (Reply_Type=1 and Bank_Name='PNB HFL' and BidderID=3603)";
		}
	}
}

function getpropertyCityCode($pKey){
    $titles = array(
	'AGRA' => 'AGR',
	'AHMEDABAD' => 'AHM',
	'BANJARA HILLS' => 'HYD',
	'BHIWADI' => 'BHI',
	'BHOPAL' => 'BHO',
	'BIKANER' => 'BIK',
	'CHANDIGARH' => 'CHD',
	'CHENNAI' => 'CHE',
	'COCHIN' => 'COC',
	'COIMBATORE' => 'COI',
	'DEHRADUN' => 'DEH',
	'DELHI' => 'DEL',
	'FARIDABAD' => 'FBD',
	'GAZIABAD' => 'GHA',
	'GREENPARK' => 'GRP',
	'GURGAON' => 'GUR',
	'INDORE' => 'IND',
	'JAIPUR' => 'JPR',
	'JALANDHAR' => 'JAL',
	'JANAKPURI' => 'JAN',
	'JAYANAGAR' => 'BAN',
	'JODHPUR' => 'JDH',
	'KARNAL' => 'KAR',
	'KOLKATA' => 'KOL',
	'LAKDI KA PUL' => 'HYDL',
	'LUCKNOW' => 'LUC',
	'LUDHIANA' => 'LUD',
	'MALLESHWARAM' => 'MLS',
	'MARATHAHALLI' => 'MRH',
	'MEERUT' => 'MEE',
	'MUMBAI' => 'MUM',
	'NAGPUR' => 'NAG',
	'NASIK' => 'NSK',
	'NAVI MUMBAI' => 'NAV',
	'NOIDA' => 'NOI',
	'OMR' => 'OMR',
	'PIMPRI CHINCHWAD' => 'PM',
	'PUNE' => 'PUN',
	'RAIPUR' => 'RAI',
	'SURAT' => 'SRT',
	'THANE' => 'THA',
	'TRIVANDRUM' => 'TRI',
	'Thrissur' => 'TCR',
	'VADODARA' => 'VA',
	'VARANASI' => 'VAR',
	'VIJAYAWADA' => 'VJWD',
	'VIRAR' => 'VRR',
	'VISAKHAPATNAM' => 'VSKP',
	'KALYAN' => 'THA',
	'KANPUR' => 'LUC',
	'KOTTAYAM' => 'COC',
	'PATIALA' => 'CHD',
	'MYSORE' => 'BAN',
	'ERODE' => 'COI',
	'BHUVNESHWAR' => 'KOL',
	'TUMKUR' => 'BAN',
	'MANGALORE' => 'BAN',
	'SALEM' => 'COI',
	'PONDICHERRY' => 'CHE',
	'ROHTAK' => 'KAR');
    foreach ($titles as $key=>$value)
        if($pKey==$key)
        return $value;
    return "";
}
?>
