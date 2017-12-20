<?php
require 'scripts/db_init.php';
hdfcbankTWL();

function hdfcbankTWL()
{

		$query="SELECT
Net_Salary,BidderID,Name,Email,Mobile_Number,Pincode,Company_Name,City,City_Other,RequestID,Feedback_ID,Loan_Amount,DOB FROM Req_Feedback_Bidder1,Req_Loan_Bike WHERE Req_Feedback_Bidder1.AllRequestID= Req_Loan_Bike.RequestID and Req_Feedback_Bidder1.BidderID=5572 and Req_Feedback_Bidder1.Reply_Type=10 and (Req_Feedback_Bidder1.Allocation_Date between '2015-07-16 00:00:00' and '2015-07-19 23:59:59') order by Feedback_ID ASC";
	
echo $query."<br>";

list($recordcount,$row)=MainselectfuncNew($query,$array = array());
for($ca=0;$ca<$recordcount1;$ca++){

$BidderID = $row[$ca]["BidderID"];
$RequestID = $row[$ca]["RequestID"];
$Feedback_ID = $row[$ca]["Feedback_ID"];
$Name = $row[$ca]["Name"];
list($first,$last) = split('[ ]',$Name);
$Email = $row[$ca]["Email"];
$Mobile_Number = $row[$ca]["Mobile_Number"];
$Pincode = $row[$ca]["Pincode"];
$Company_Name = $row[$ca]["Company_Name"];
$strCompany_Name = substr(trim($Company_Name),0,50);
$City = $row[$ca]["City"];
$City_Other = $row[$ca]["City_Other"];
$Loan_Amount = $row[$ca]["Loan_Amount"];
$Net_Salary = $row[$ca]["Net_Salary"];
$monthlyincome= $Net_Salary/12;
$DOB = $row[$ca]["DOB"];
list($year,$month,$day) = split('[-]',$DOB);
$strdob = $day."/".$month."/".$year;

if($City=="Others" && Strlen($City_Other)>0)
{
	$strcity=$City_Other;
}
else
{
	$strcity=$City;
}

if($last=="")
	{
		$last= $first;
		$first="Unknown";
	}


$Res_address = "Resi address";
$residence_status="Owned";
$curr_date = date("Y/m/d h:i:s A");			

$xmlstr='<?xml version="1.0" encoding="utf-8"?>
<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
  <soap:Body>
    <AddDetails xmlns="http://tempuri.org/">
      <First_Name>'.$first.'</First_Name>
      <Last_Name>'.$last.'</Last_Name>
      <Email>'.$Email.'</Email>
      <Pan_No>AAAPA1111A</Pan_No>
      <Res_address>'.$Res_address.'</Res_address>
      <Res_address2>'.$strcity.'</Res_address2>
      <Res_address3>string</Res_address3>
      <Resi_type>string</Resi_type>
      <Mobile>'.$Mobile_Number.'</Mobile>
      <Res_City>'.$strcity.'</Res_City>
      <Resi_City_other>string</Resi_City_other>
      <Resi_City_other1>string</Resi_City_other1>
      <res_pin>string</res_pin>
      <Company_name>'.$Company_Name.'</Company_name>
      <DateOfBirth>'.$strdob.'</DateOfBirth>
      <Designation>NA</Designation>
      <Emp_type>Salaried</Emp_type>
      <Monthly_income>'.$monthlyincome.'</Monthly_income>
      <card_held>string</card_held>
      <Source_code>D4L</Source_code>
      <Promo_code>string</Promo_code>
      <LEAD_DATE_TIME>'.$curr_date.'</LEAD_DATE_TIME>
      <PRODUCT_APPLIED_FOR>TWL</PRODUCT_APPLIED_FOR>
      <existingcust>string</existingcust>
      <LoanAmt>'.$Loan_Amount.'</LoanAmt>
      <YrsinEmp>string</YrsinEmp>
      <emi_paid>string</emi_paid>
      <car_make>string</car_make>
      <car_model>string</car_model>
      <TypeOfLoan>TWL</TypeOfLoan>
      <IP_Address>string</IP_Address>
      <Indigo_UniqueKey>HDFCC2TQ9W1E8W2Q</Indigo_UniqueKey>
      <Indigo_RequestFromYesNo>yes</Indigo_RequestFromYesNo>
    </AddDetails>
  </soap:Body>
</soap:Envelope>'; 
echo $xmlstr."<br><br>";

// Keeping reporting on for error tracking
// HDFC's domain
$url = 'https://leads.hdfcbank.com/HDFC_Bank_C2T/HDFC_Bank_C2T.asmx';
// cURL's initialization
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_TIMEOUT, 4);
curl_setopt($ch, CURLOPT_POSTFIELDS, $xmlstr);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: text/xml','Content-Type: text/xml'));
$result = curl_exec($ch);
$webfeedback=$result;
$info = curl_getinfo($ch);
echo "<br><br>divide<br><br>";
curl_close($ch);

if($Feedback_ID>0)
	{
//$update =ExecQuery("Update Req_Compaign set RequestID='".$Feedback_ID."' where (Reply_Type='10' and Bank_Name='HDFC Bank' and BidderID=5572)");
	}

$Dated = ExactServerdate();
$dataInsert = array('leadid'=>$Feedback_ID,'product'=>'10','feedback'=>$webfeedback, 'bidderid'=>$BidderID, 'doe'=>$Dated, 'cust_requestid'=>$RequestID);
	$insert = Maininsertfunc ('webservice_bidder_details', $dataInsert);

}
}
?>