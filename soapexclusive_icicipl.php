<?php
error_reporting(E_ALL);
require 'scripts/db_init.php';

function ICICIpl()
{
$curr_date2 = date("Y-m-d");
$curr_date1 = date("H:i:s");
$curr_date = $curr_date2."T".$curr_date1;
	//code starts
	$today=Date('Y-m-d');
	$tomorrow  = mktime(0, 0, 0, date("m")  , date("d"), date("Y"));
$currentdate=date('Y-m-d',$tomorrow);

	$mindate=$currentdate." 00:00:00";
	$maxdate=$today." 23:59:59";
	
	$cityArr = array('CityCheck','Agra', 'Ajmer', 'Alot', 'Alwar', 'Amritsar', 'Anand', 'Angul', 'Ankleshwar', 'Baddi', 'Banswara', 'Bathinda', 'Bhadrak', 'Bharuch', 'Bhatinda', 'Bhavnagar', 'Bhilwara', 'Bikaner', 'Bilaspur', 'Chandigarh', 'Chennai', 'Coimbatore', 'Dehradun', 'Ernakulam', 'Erode', 'Gandhidham', 'Gandhinagar', 'Goa', 'Guntur', 'Gwalior', 'Hosur', 'Howrah', 'Hubli', 'Hyderabad', 'Jaipur', 'Jalgaon', 'Jalna', 'Jamnagar', 'Jamshedpur', 'Jodhpur', 'Kalka', 'Karaikudi', 'Karnal', 'Karur', 'Kochi', 'Kolhapur', 'Kolkata', 'Kota', 'Kottayam', 'Kozhikode', 'Lucknow', 'Ludhiana', 'Madurai', 'Mangalore', 'Mapusa', 'Margao', 'Mehsana', 'Mohali', 'Mysore', 'Nagarcoil', 'Narendrapur', 'Nellore', 'Pali ', 'Panaji', 'Panchkula', 'Panipat', 'Patiala', 'Ponda', 'Pondicherry', 'Rajahmundry', 'Rajkot', 'Rourkela', 'Salem', 'Sangli', 'Satna', 'Secunderabad', 'Solapur', 'Sonepat', 'Sriganganagar', 'Surat', 'Tanjore', 'Tirpur', 'Trichy', 'Tuticorin', 'Udaipur', 'Valsad', 'Vapi', 'VascoDaGama', 'Vellore', 'Vijayawada', 'Vijaywada', 'Vishakapatnam', 'Vizag', 'Vishakhapatnam', 'Warangal', 'Zirakpur', 'Adambakkam', 'Aluva', 'Baramati', 'Barasat', 'Barrackpore', 'Baruipur', 'Bavla', 'Bhopal', 'Bhubaneswar', 'Bundi', 'Calicut', 'Caranzalem', 'Changodar', 'Chhatral', 'Chidambaram', 'Chomu', 'Cochin', 'Dahej', 'Dankuni', 'Dausa', 'Dharwad', 'Dombivali', 'Egmore', 'Guntur', 'Ichalkaranji', 'Indore', 'Jajapur', 'Jajapur', 'Jamnagar', 'Jamshedpur', 'Kadi', 'Kalyan', 'Karjan', 'Kharagpur', 'Kolhapur', 'Miraj', 'Nagpur', 'Pali', 'Panchkula', 'Pimpalgaon', 'Raipur', 'Rajarhat Gopalpur', 'Rajkot', 'Ramapuram', 'Santa Cruz', 'Shiradwad', 'Solapur', 'South Dum Dum', 'Surat', 'Talcher', 'Taleigao', 'Thiruvananthapuram', 'Thrissur', 'Trivandrum', 'Ulhas Nagar', 'Uttarapara', 'VallabhVidyanagar', 'Verna', 'Vijayawada', 'Vijaywada', 'Visakhapatnam', 'Vishakapatnam', 'Vishakhapatnam', 'Delhi', 'Noida', 'Gurgaon', 'Gaziabad', 'Faridabad', 'Greater Noida', 'Sahibabad', 'Mumbai', 'Navi Mumbai', 'Thane', 'Bangalore', 'Pune', 'Ahmednagar', 'Akola', 'Alibag', 'Aligarh', 'Allahabad', 'Ambala', 'Amravati', 'Armoor', 'Asansol', 'Bahadurgarh', 'Bareilly', 'Beawar', 'Beed', 'Belgaum', 'Bellary', 'Berhampur', 'Bharatpur', 'Bhillai', 'Bhimavaram', 'Bhiwadi', 'Bhuj', 'Bidar', 'Bijapur', 'Chandrapur', 'Chikmagalur', 'Chittoor', 'Cuddalore', 'Cuttack', 'Darjeeling', 'Davangere', 'Derabassi', 'Dewas', 'Dharamshala', 'Dindigul', 'Durg', 'Eluru', 'Faridkot', 'Ferozepur', 'Firozabad', 'Gulbarga', 'Gurdaspur', 'Guwahati', 'Hanumangarh', 'Haridwar', 'Hisar', 'Hissar', 'Hooghly', 'Hoshangabad', 'Hoshiarpur', 'Hospet', 'Itarsi', 'Jabalpur', 'Jalandhar', 'Jalpaiguri', 'Jammu', 'Jhansi', 'Jharsuguda', 'Kakinada', 'Kancheepuram', 'Kannur', 'Kanpur', 'Kapurthala', 'Karimnagar', 'Khammam', 'Khandwa', 'Khanna', 'Kharar', 'Kishangarh', 'Kollam', 'Korba', 'Kurukshetra', 'Mandi', 'MandiGobindgarh', 'Mansa', 'Mathura', 'Meerut', 'Mehboobnagar', 'Modinagar', 'Moga', 'Morba', 'Muktsar', 'Mussorie', 'Nabha', 'Nadiad', 'Nainital', 'Namakkal', 'Navsari', 'Nawanshahar', 'Ongole', 'Palacole', 'Palakkad', 'Palani', 'Panruti', 'Patna', 'Pattukottai', 'Phagwara', 'Pipli', 'Pollachi', 'Pudukkottai', 'Puri', 'Raichur', 'Raigarh', 'Rajapalayam', 'Rajnandgaon', 'Ranchi', 'Ratlam', 'Ratnagiri', 'Raurkela', 'Rewa', 'Rewari', 'Rishikesh', 'Rohtak', 'Roorkee', 'Ropar', 'Rudrapur', 'Sagar', 'Sambalpur', 'Sangrur', 'Satara', 'Shillong', 'Shimla', 'Shimoga', 'Sholapur ', 'Siliguri', 'Sivakasi', 'Solan', 'Tirunelveli', 'Tirupati', 'Tiruvannamalai', 'Udumalpet', 'Udupi', 'Ujjain', 'Una', 'Vizianagaram', 'Wardha', 'Yamunanagar');
	

$query1="Select RequestID from Req_Compaign Where (Reply_Type='1' and Bank_Name like'%ICICI exc%' and Compaign_ID=4748)";
$result1 = ExecQuery($query1);

while($row1 = mysql_fetch_array($result1))
	{
	 $requestid= $row1["RequestID"];
	 }

if((strlen(trim($requestid))<=0))
	{	
		$query="SELECT * FROM icici_exclusive_app where (age>=25 and Is_Valid=1 and status=1 and (iciciapp_salary>=300000 or (iciciapp_salary>=240000 and iciciapp_relation in ('SAVINGS_ACCOUNT','SALARY_ACCOUNT','HOME_LOAN','PERSONAL_LOAN','CAR_LOAN','CREDIT_CARD'))) and iciciapp_occupation=1 and  (iciciapp_dated between '".$mindate."' and '".$maxdate."'))";
	}
	else
	{
		

	$query="SELECT * FROM icici_exclusive_app where (age>=25 and Is_Valid=1 and status=1 and (iciciapp_salary>=300000 or (iciciapp_salary>=240000 and iciciapp_relation in ('SAVINGS_ACCOUNT','SALARY_ACCOUNT','HOME_LOAN','PERSONAL_LOAN','CAR_LOAN','CREDIT_CARD'))) and iciciapp_occupation=1 and iciciappid>'".$requestid."' and (iciciapp_dated between '".$mindate."' and '".$maxdate."'))";
}

// fetch leads from database
echo $query."<br>";
$result = ExecQuery($query);
$recordcount = mysql_num_rows($result);
//$recordcount = 0;
if($recordcount>0)
{
while($row=mysql_fetch_array($result))
{
	$City = $row["iciciapp_city"];
	$keyCity = array_search($City, $cityArr);
	if($keyCity>0)
	{
		$Feedback_ID = $row["iciciappid"];
		$RequestID = $row["iciciappid"];
		$Name = $row["iciciapp_name"];
		$dateDOB = $row["iciciapp_dob"];
		$Net_Salary = $row["iciciapp_salary"];

		$datearry=explode("-",$dateDOB);
		if(strlen($datearry[1])==1)
		{	$mm = "0".$datearry[1]; } else {$mm = $datearry[1]; }
	
		if(strlen($datearry[2])==1)
		{	$dd = "0".$datearry[2]; } else {$dd = $datearry[2]; }
	
		$DOB=$datearry[0]."-".$mm."-".$dd;
	
		$Email = $row["iciciapp_email"];
		$Mobile_Number = $row["iciciapp_mobile_number"];
		$Employment_Status = $row["iciciapp_occupation"];
		if($Employment_Status==1){ $emp_stat="Salaried";} else {$emp_stat="Self Employed";}
		$Company_Name = $row["iciciapp_company_name"];
		$strcompany_Name = substr($Company_Name, 0, 40);
		$City = $row["iciciapp_city"];
		$City_Other = $row["iciciapp_city"];
		$Pincode = $row["Pincode"];
		$CC_Holder = $row["CC_Holder"];
		if($CC_Holder==1){ $cc_holder="Yes";} else { $cc_holder="No";}
		$Primary_Acc = $row["Primary_Acc"];
	//	echo $Net_Salary = $row["Net_Salary"];
		list($annualincome,$rest) = split('[.]', $Net_Salary); 
		echo $annualincome." - ".$rest."<br><br>";
	
		
		$PL_EMI_Amt = $row["customer_loan_amt"];
		$Loan_Amount = $row["customer_loan_amt"];
		list($loanamt,$larest) = split('[.]',$Loan_Amount);
		
		
		$IP_Address = $row["iciciapp_ipaddress"];
		
		$DOE = $row["iciciapp_dated"];
		$Company_type = '';
		$feedback = "Need Loan";
		
//code ends
//$dob = '1980-03-20';

$xmlstr='<?xml version="1.0" encoding="utf-8"?>
<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
  <soap:Body>
    <InsertData xmlns="AndromedaIbankWebService">
      <Name>'.$Name.'</Name>
      <DOB>'.$DOB.'</DOB>
      <Email>'.$Email.'</Email>
      <MobileNo>'.$Mobile_Number.'</MobileNo>
      <Occupation>'.$emp_stat.'</Occupation>
      <CompanyName>'.$strcompany_Name.'</CompanyName>
      <City>'.$City.'</City>
      <OtherCity>'.$City_Other.'</OtherCity>
      <Pincode>'.$Pincode.'</Pincode>
      <CardHolder>'.$cc_holder.'</CardHolder>
      <PrimaryAcc>'.$Primary_Acc.'</PrimaryAcc>
      <AnnualIncome>'.$annualincome.'</AnnualIncome>
      <AnnualTurnover>'.$annual_turnover.'</AnnualTurnover>
      <LoanRunning>'.$loanrunning.'</LoanRunning>
      <EMIPaid>'.$EMI_Paid.'</EMIPaid>
      <EMIAmt>'.$PL_EMI_Amt.'</EMIAmt>
      <LoanAmount>'.$loanamt.'</LoanAmount>
      <Feedback>'.$feedback.'</Feedback>
      <CardVintage>'.$Card_Vintage.'</CardVintage>
      <CardLimit>'.$cardlimit.'</CardLimit>
      <ip_address>'.$IP_Address.'</ip_address>
      <AvailableDocuments>'.$identification_proof.'</AvailableDocuments>
      <add_comment>'.$comments.'</add_comment>
	  <doe>'.$curr_date.'</doe>
      <CompanyType>Pvt Ltd</CompanyType>
    <BankName>ICICI</BankName>
      <Customer_Type>Exclusive</Customer_Type>
      <Rate_of_Interest>rateofinterest</Rate_of_Interest>
      <Processing_Fees>processingfee</Processing_Fees>
      <EMI>emi</EMI>
      <Part_Payment>partpayment</Part_Payment>
      <Pre_Payment>prepayment</Pre_Payment>
    </InsertData>
  </soap:Body>
</soap:Envelope>';
echo $xmlstr."<br><br>";

//$url = 'http://123.252.223.4/IbnkWS/IbnkWS.asmx?WSDL';

//$url = 'http://123.252.223.4/IbnkWS/IbnkWS.asmx';
$url = 'http://123.252.223.4/IbnkWSN/IbnkWS.asmx';
// cURL's initialization
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_TIMEOUT, 4);
curl_setopt($ch, CURLOPT_POSTFIELDS, $xmlstr);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: text/xml','Content-Type: text/xml'));

$result = curl_exec($ch);
$info = curl_getinfo($ch);

//echo "<br><br>divide<br><br>";

curl_close($ch);

echo "<br><br>";
echo "<br><br>";


$webfeedback=$result;
echo "<br><br>";
echo "<br><br>";
//echo print_r($info);
//insert in log table
echo $iciciwebservlog = "INSERT INTO icicipl_webservice (requestid, feedback, dated) VALUES('".$RequestID."','".$webfeedback."',NOW())";
ExecQuery($iciciwebservlog);

if($Feedback_ID>0)
	{
echo	"Update Req_Compaign set RequestID='".$Feedback_ID."' where (Reply_Type='1' and Bank_Name like'%ICICI exc%' and Compaign_ID=4748)";
$update =ExecQuery("Update Req_Compaign set RequestID='".$Feedback_ID."' where (Reply_Type='1' and Bank_Name like'%ICICI exc%' and Compaign_ID=4748)");
	}
	
	
	
	} //End City Check
	else{ echo "<br><br>Not Listed City <br>"; }
	}//while ends here
// They need to use XML parsing for further operation
}

}


main();

function main()
{
	ICICIpl();
}
   
?>

