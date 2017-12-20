<?php
require 'scripts/db_init.php';

PNBHFL_HL();

function PNBHFL_HL()
{
	$RequestID = '1191752';	
	$query="SELECT  Name,Email,Mobile_Number,City,City_Other,Loan_Amount,Net_Salary,DOB,Pancard,Gender,Property_Value,Existing_Loan,Existing_Bank,Pincode,Residence_Address,Property_Loc,Total_Experience FROM Req_Loan_Home WHERE Req_Loan_Home.RequestID = '".$RequestID."'";
	
	$tataplqryresult = d4l_ExecQuery($query);
	while($row=d4l_mysql_fetch_array($tataplqryresult))
	{
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
		echo $xmlstr."<br><br>";

		$url = 'https://customerservice.pnbhousing.com:9061/services/KastleLEMSServices?wsdl';
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, 4);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $xmlstr);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: text/xml','Content-Type: text/xml'));
		//echo '<pre>';print_r($output);exit;
		$output = curl_exec($ch);
		if(!curl_errno($ch))
		{
			$info = curl_getinfo($ch);
			$errmsg = $info;
		}
		else
		{
			$errmsg = curl_error($ch);
		}
		//echo '<pre>';print_r($errmsg);
		echo "<br>".$output;exit;

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
