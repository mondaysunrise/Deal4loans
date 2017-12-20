<?php
$xmstr='<DealForLoanRequestData xmlns="http://schemas.datacontract.org/2004/07/CommonWcfWebLeadinegration">
  <AltNo>String content</AltNo>
  <Builder>String content</Builder>
  <City>String content</City>
  <ContactAddress>String content</ContactAddress>
  <Country>String content</Country>
  <CustomerName>String content</CustomerName>
  <Customeremail>String content</Customeremail>
  <Gender>String content</Gender>
  <Mobile>String content</Mobile>
  <OffNumber>String content</OffNumber>
  <Product>String content</Product>
  <Profession>String content</Profession>
  <Property>String content</Property>
  <Remarks>String content</Remarks>
  <ResidenseNo>String content</ResidenseNo>
  <Scheme>String content</Scheme>
  <State>String content</State>
  <loanamount>String content</loanamount>
</DealForLoanRequestData>';

$url="http://125.21.191.24/CommonwcfWebleadintegration/DealForLoan/DealForLoanService.svc/help";
/*$ch = curl_init($url);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/xml'));
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "$xmstr");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$output = curl_exec($ch);
curl_close($ch); 
print_r($output);*/

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
//curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_TIMEOUT, 4);
curl_setopt($ch, CURLOPT_POSTFIELDS, $xmlstr);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: text/xml','Content-Type: text/xml'));
$result = curl_exec($ch);
$webfeedback=$result;
$info = curl_getinfo($ch);
print_r($output);
?>