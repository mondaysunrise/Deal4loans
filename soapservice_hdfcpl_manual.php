<?php
//error_reporting(E_ALL);
require 'scripts/db_init.php';
echo "hello";

function HDfcpl()
{


echo $query1="Select RequestID from Req_Compaign Where (Reply_Type='1' and Bank_Name like'%HDFC Bank%' and BidderID=1888)";
list($count,$row1)=MainselectfuncNew($query1,$array = array());

 $requestid= $row1[0]["RequestID"];


$city_List = "Mumbai','Navi mumbai','Thane','Ahmedabad','Pune','Kolkata','Baroda','Chandigarh','Coimbatore','Ludhiana";

If((strlen(trim($requestid))>0))
	{	
		$query="SELECT hdfcplid, RequestID,name,age,mobile_number,email_id,DOB, Employment_Status,company_name,city, other_city, net_salary, availed_loan_amt, residence_status,Dated FROM hdfc_pl_calc_leads WHERE ((hdfc_pl_calc_leads.Dated Between '2014-12-01 00:00:00' and '2014-12-16 23:59:59' ) and hdfcplid in (88718,88741,88599,88552,88587,88744,88679,88653,88584,88781,88570,88678))";
	}
	
echo $query."<br>";
list($count1,$row)=MainselectfuncNew($query,$array = array());
for($j=0;$j<$count1;$j++)
{
	$RequestID=$row[$j]["RequestID"];
	$Feedback_ID=$row[$j]["hdfcplid"];
	$BidderID=$row[$j]["city"];
	$Name=$row[$j]["name"];
	list($first,$last) = split('[ ]',$Name);
	$Email = $row[$j]["email_id"];
	$City = $row[$j]["city"];
	$City_Other = $row[$j]["City_Other"];
	$Pincode = "100001";
	$Company_Name = $row[$j]["company_name"];
	$Mobile_Number = $row[$j]["mobile_number"];
	$DOB = $row[$j]["DOB"];
	$DOB_arr = explode("-", $DOB);
	list($year, $month, $day) = $DOB_arr;
	$dateofbirth = $day."/".$month."/".$year;
	$Occupation = $row[$j]["Employment_Status"];
	$Loan_Amount = $row[$j]["availed_loan_amt"];
	$Net_Salary = $row[$j]["net_salary"];
	$monthly_Income= round($Net_Salary/12);
	if($Occupation==1){ $empstat="Salaried"; } else { $empstat="Self Employed";}
	$curr_date = date("Y/m/d h:i:s A");
	$Years_In_Company= "3";
	$Total_Experience= "6";
	$IP_Address= $row[$j]["IP_Address"];
	$panno=AAAPA1111A;
	$Res_address = "Resi address";

	if($row[$j]["residence_status"]==1) { $residential_status="Owned By Parent/Sibling"; }  if($row[$j]["residence_status"]==2) { $residence_status="Rented"; } if($row[$j]["residence_status"]==3) { $residence_status="Company Provided"; }
			if($row[$j]["residence_status"]==4) { $residence_status="Owned By Self/Spouse"; }  
			if($row[$j]["residence_status"]==5) { $residence_status="Rented - With Family"; }  
			if($row[$j]["residence_status"]==6) { $residence_status="Rented - With Friends"; }  
			if($row[$j]["residence_status"]==7) { $residence_status="Paying Guest"; }  
			if($row[$j]["residence_status"]==8) { $residence_status="Hostel"; }  


$xmlstr="<?xml version='1.0' encoding='utf-8'?>
<soap:Envelope xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance' xmlns:xsd='http://www.w3.org/2001/XMLSchema' xmlns:soap='http://schemas.xmlsoap.org/soap/envelope/'>
<soap:Body>
<AddDetails xmlns='http://tempuri.org/'>
<First_Name>".$first."</First_Name>
<Last_Name>".$last."</Last_Name>
<Email>".$Email."</Email>
<Pan_No>".$panno."</Pan_No>
<Res_address>".$Res_address."</Res_address>
<Res_address2>".$City."</Res_address2>
<Res_address3></Res_address3>
<Resi_type>".$residential_status."</Resi_type>
<Mobile>".$Mobile_Number."</Mobile>
<Res_City>".$City."</Res_City>
<Resi_City_other>".$City_Other."</Resi_City_other>
<Resi_City_other1></Resi_City_other1>
<res_pin>".$Pincode."</res_pin>
<Company_name>".$Company_Name."</Company_name>
<DateOfBirth>".$dateofbirth."</DateOfBirth>
<Designation>NA</Designation>
<Emp_type>".$Occupation."</Emp_type>
<Monthly_income>".$monthly_Income."</Monthly_income>
<card_held>HDFC Bank</card_held>
<Source_code>TD4L</Source_code>
<Promo_code>demo</Promo_code>
<LEAD_DATE_TIME>".$curr_date."</LEAD_DATE_TIME>
<PRODUCT_APPLIED_FOR>PL</PRODUCT_APPLIED_FOR>
<existingcust>Yes</existingcust>
<LoanAmt>".$Loan_Amount."</LoanAmt>
<YrsinEmp>".$Years_In_Company."</YrsinEmp>
<emi_paid>12</emi_paid>
<car_make>NA</car_make>
<car_model>NA</car_model>
<TypeOfLoan>Personal</TypeOfLoan>
<IP_Address>".$IP_Address."</IP_Address>
<Indigo_UniqueKey>HDFCC2TQ9W1E8W2Q</Indigo_UniqueKey>
<Indigo_RequestFromYesNo>yes</Indigo_RequestFromYesNo>
</AddDetails>
  </soap:Body>
</soap:Envelope>
"; 
echo $xmlstr."<br><br>";

// Keeping reporting on for error tracking
// HDFC's domain
$url = 'https://leads.hdfcbank.com/HDFC_Bank_C2T/HDFC_Bank_C2T.asmx';
//username and password of domain directory
$username = 'indigo';
$password = 'T@57!@#$';
// cURL's initialization
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
//curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_TIMEOUT, 4);
curl_setopt($ch, CURLOPT_POSTFIELDS, $xmlstr);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: text/xml','Content-Type: text/xml'));

$result = curl_exec($ch);
$info = curl_getinfo($ch);
//echo "<br><br>divide<br><br>";
curl_close($ch);
$webfeedback=$result;


$data = array("leadid"=>$Feedback_ID , "product"=>'1', "feedback"=>$webfeedback, "bidderid"=>$BidderID,  "doe"=>$Dated );
		$insert = Maininsertfunc ('webservice_bidder_details', $data);	
}
// They need to use XML parsing for further operation
}


main();

function main()
{
	HDfcpl();
	
}
?>

