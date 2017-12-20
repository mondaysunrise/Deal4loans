<?php
error_reporting(E_All);
@set_time_limit(1000);

echo "hello";
icicihllogin();

function icicihllogin()
{
	$xmlstr='<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:api="http://www.crmnext.com/api/">
	<soapenv:Header/>
	   <soapenv:Body>
			<api:Login>
			<!--Optional:-->
			 <api:login>ICICI_HOMELOAN</api:login>
			 <!--Optional:-->
			 <api:password>abc123</api:password>
		  </api:Login>
	   </soapenv:Body>
	</soapenv:Envelope>';

	$headers = array(   "Content-type: text/xml;charset=\"utf-8\"",
                        "Accept: text/xml",
                        "SOAPAction:http://www.crmnext.com/api/ICRMnextApi/Login", 
                       ); 
$url="https://salescrm.icicibank.com/CRMnextWebApi/CRMnextService.svc?wsdl";
$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "$xmlstr");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$output = curl_exec($ch);
		curl_close($ch); 
		echo "<br><br><pre>";

		print_r($output);

}

function icicihlsave()
{
$xmlstr='<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:api="http://www.crmnext.com/api/">
   <soapenv:Header/>
        <soapenv:Body>
            <api:Save>
                <api:userContext>
                  <api:IsSuccess>true</api:IsSuccess>
                  <api:Message></api:Message>
                  <api:ClientTimeOffSet>0</api:ClientTimeOffSet>
                  <api:ExpiresOn>2016-10-02T17:42:25.9235751+05:30</api:ExpiresOn>
                  <api:IsUTC>false</api:IsUTC>
                  <api:LongDateFormat></api:LongDateFormat>
                  <api:LongDateTimeFormat></api:LongDateTimeFormat>
                  <api:Token>qjg8clqv8mjs5njd6l2s676fk353tnxbf52bdnleacda766ust396ejm7ah5abamvscj8lgbzykygk86vdsv9nw7eq9kcvslx4g4aj7zvn386re5vzgvfjdbupljz2uvjdku8xxvemrrry3cp428evenznv5e33jvvahcvdamzl24grufqkfwj54baw7zskd744l5nrpmwy72eyfku4lz3q9nglxwsjtmnrzvx5z8gx8sm2vw9strs7jac27gpu6gvkz4m8evqqy3w346mj4hbzbamwre664nzw5ndjd6gfhckzkpnks877e2s22xtjvabfajlw8syszw</api:Token>
                </api:userContext>
                <api:objects>
                     <api:CRMnextObject xsi:type="api:Lead" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
				<api:CampaignKey>195816</api:CampaignKey>
                    <!--Custom Fields-->
                    <api:Custom>
                      <api:Business_Line_l>7</api:Business_Line_l>
                      <api:Address_1_l>Add1</api:Address_1_l>
                      <api:Address_2_l>Add2</api:Address_2_l>
                      <api:C_Pincode_l>110092</api:C_Pincode_l>
                      <api:Channel_l>48</api:Channel_l>
                      <api:Loan_Amount_l>500000</api:Loan_Amount_l>
					<api:Tenure_in_Months_l>10</api:Tenure_in_Months_l>                      
                      <api:Source_of_Lead_l>7</api:Source_of_Lead_l>
                      <api:Remarks_Aggregate_l>CS Test</api:Remarks_Aggregate_l>
                    </api:Custom>
                  <api:FirstName>Shweta</api:FirstName>
                    <api:LastName>Sharma</api:LastName>
                    <api:LayoutKey>102166</api:LayoutKey>
                    <api:MobilePhone>9999047207</api:MobilePhone>
                    <api:OwnerCode>1</api:OwnerCode>
                    <api:PreferredChannelKey>1</api:PreferredChannelKey>
                    <api:ProductCategoryID>1036</api:ProductCategoryID>
                    <api:ProductKey>1060</api:ProductKey>
                    <api:RatingKey>1</api:RatingKey>
                    <api:StatusCodeKey>141</api:StatusCodeKey>
                    <api:LeadWarmth>Warm</api:LeadWarmth>                   
                  </api:CRMnextObject>
                </api:objects>
               <api:returnObjectOnSave>true</api:returnObjectOnSave>
            </api:Save>
        </soapenv:Body>
      </soapenv:Envelope>';
echo $xmlstr;

$headers = array(   "Content-type: text/xml;charset=\"utf-8\"",
                        "Accept: text/xml",
                        "SOAPAction:http://www.crmnext.com/api/ICRMnextApi/Save", 
                       ); 
//$url="https://salescrm.icicibank.com/CRMnextWebApi/CRMnextService.svc?wsdl";
$url="http://10.78.10.59/crmnextwebapi/crmnextservice.svc?wsdl";
$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "$xmlstr");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$output = curl_exec($ch);
		curl_close($ch); 
		echo "<br><br><pre>";

	print_r($output);
	}
	?>