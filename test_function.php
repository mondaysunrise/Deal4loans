<?php
$strdob=$dd."/".$mm."/".$year;
	$Dated=date('Y/m/d h:i:s A');
	$IP= $_SERVER['HTTP_X_SUCURI_CLIENTIP'];
$xmlstr='<?xml version="1.0" encoding="utf-8"?>
<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
  <soap:Body>
    <AddDetails xmlns="http://tempuri.org/">
      <First_Name>Upendra</First_Name>
      <Last_Name>Kumar</Last_Name>
      <Email>askupendra@gmail.com</Email>
	  <Pan_No>AAAPA1112A</Pan_No>
      <Res_address>Test Addr 1</Res_address>
      <Res_address2>Test Addr 2</Res_address2>
      <Res_address3>Test Addr 3</Res_address3>
      <Resi_type>Permanent</Resi_type>
      <Mobile>9971396361</Mobile>
      <Res_City>Delhi</Res_City>
      <Resi_City_other></Resi_City_other>
      <Resi_City_other1></Resi_City_other1>
      <res_pin>110092</res_pin>
      <Company_name>Deal4loans</Company_name>
      <DateOfBirth>09/06/1978</DateOfBirth>
      <Designation>NA</Designation>
      <Emp_type>Salaried</Emp_type>
      <Monthly_income>78000</Monthly_income>
      <card_held>No</card_held>
      <Source_code>D4L</Source_code>
      <Promo_code>D4L</Promo_code>
      <LEAD_DATE_TIME>'.$Dated.'</LEAD_DATE_TIME>
      <PRODUCT_APPLIED_FOR>CC</PRODUCT_APPLIED_FOR>
      <existingcust>No</existingcust>
      <LoanAmt>NA</LoanAmt>
      <YrsinEmp>NA</YrsinEmp>
      <emi_paid>NA</emi_paid>
      <car_make>NA</car_make>
      <car_model>NA</car_model>
      <TypeOfLoan>NA</TypeOfLoan>
      <IP_Address>'.$IP.'</IP_Address>
      <Indigo_UniqueKey>HDFCC2TQ9W1E8W2Q</Indigo_UniqueKey>
      <Indigo_RequestFromYesNo>yes</Indigo_RequestFromYesNo>
    </AddDetails>
  </soap:Body>
</soap:Envelope>';
echo $xmlstr;
echo "<br><br>";
/*
Existing Link - https://leads.hdfcbank.com/HDFC_Bank_C2T/HDFC_Bank_C2T.asmx
 
New Link - https://leads.hdfcbank.com/HDFC_Bank_C2T/HDFC_Bank_C2T.asmx?AspxAutoDetectCookieSupport=1
 
 

if you are using wsdl
Existing Link - https://leads.hdfcbank.com/HDFC_Bank_C2T/HDFC_Bank_C2T.asmx?wsdl
 
New Link - https://leads.hdfcbank.com/HDFC_Bank_C2T/HDFC_Bank_C2T.asmx?wsdl&AspxAutoDetectCookieSupport=1
*/
$url = 'https://leads.hdfcbank.com/HDFC_Bank_C2T/HDFC_Bank_C2T.asmx?wsdl&AspxAutoDetectCookieSupport=1';

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
//curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_TIMEOUT, 4);
curl_setopt($ch, CURLOPT_POSTFIELDS, $xmlstr);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: text/xml','Content-Type: text/xml'));

$result = curl_exec($ch);
$webfeedback=$result;
 $info = curl_getinfo($ch);
echo "<br><br>";

curl_close($ch);


print_r($webfeedback);
echo "<br><br>";


?>