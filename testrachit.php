<?php
require 'scripts/db_init.php';
require 'scripts/functions.php';


$xmstr='<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:api="http://www.crmnext.com/api/">
   <soapenv:Header/>
   <soapenv:Body>
      <api:Save>
         <!--Optional:-->
         <api:userContext>
            <!--Optional:-->
            <!--Optional:-->
            <api:IsSuccess>true</api:IsSuccess>
            <api:Message xsi:nil="true" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"/>
            <api:ClientTimeOffSet>0</api:ClientTimeOffSet>
            <api:ExpiresOn>2616-10-07T18:16:58.0111248+05:30</api:ExpiresOn>
            <api:IsUTC>false</api:IsUTC>
            <api:LongDateFormat>dd/MM/yyyy</api:LongDateFormat>
            <!--Optional:-->
            <api:LongDateTimeFormat>dd/MM/yyyy h:mm tt</api:LongDateTimeFormat>
            <!--Optional:-->
            <api:Token>qjg8clqv8mjs5njd6l2s676fkp7xmqnglzquqbepmn7jrc7vfu9j6s5qwewxr9fnq6r5nggdlf37dslrlmehvv9mtccn255ptl5edsm4qnvjf2gkheyl8h3zcpfaav2h7jsxlrrmblakksss2uhrv5hv3hh2nvdbkasc4qdxx6ckc9kqsscvk3glxlxxvje57lwfh8nf48usumljq5kvzvx9v7yl5mj9ud7dzldnt36u8xxjjpxuw8npel524cz69k5ug2f4z9exfmuyde43tfmalqturhwvkrn6e42e9f7wvmy9vk7anb2s9rushr5dvdgcbp5yanug9c7gceydlhsd2sd235ky5sv8mpzasxu3esn55f5hmrheqxwucw3335rzbzhv4kkyydgt2zkzutuc95trdyu8ea3rt4mmhst2lpfugktvr43uwc4un3t6tn4k72dyummcjy8jukhw6awmt5ugwqc8d56eszzc42wardyf68clwbjmpetcr6yrbn8v99ern4krypha4w2ktftwd379t9ntl2y4mdczx6uy9afj4tq5g8q7wyndn2c6dqkedyt32p54uha2x7l7wph9gs</api:Token>
            <!--Optional:-->
         </api:userContext>
         <!--Optional:-->
         <api:objects>
            <!--Zero or more repetitions:-->
            <api:CRMnextObject xsi:type="api:Lead" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
               <api:DateofBirth>1987-07-23T00:00:00</api:DateofBirth>
               <api:Address>E-30 Sec-8 Noida</api:Address>
               <api:City>Noida</api:City>
               <api:Custom>
                  <api:FieldID_15>1</api:FieldID_15>
                  <api:FieldID_191>1000000</api:FieldID_191>
                  <api:FieldID_208>Web</api:FieldID_208>
                  <api:FieldID_259>345Ab</api:FieldID_259>
               </api:Custom>
               <api:Email>test@gmail.com</api:Email>
               <api:FirstName>TestFirst</api:FirstName>
               <api:LastName>TestLast</api:LastName>
               <api:LayoutKey>100051</api:LayoutKey>
               <api:LeadOwnerKey>1</api:LeadOwnerKey>
               <api:LeadSourceKey>30</api:LeadSourceKey>
               <api:MobilePhone>8447380829</api:MobilePhone>
               <api:PanNumber>bazth4444a</api:PanNumber>
               <api:ProductKey>22</api:ProductKey>
               <api:RatingKey>1</api:RatingKey>
            </api:CRMnextObject>
         </api:objects>
         <!--Optional:-->
         <api:returnObjectOnSave>false</api:returnObjectOnSave>
      </api:Save>
   </soapenv:Body>
</soapenv:Envelope>';

$headers = array(
			"Content-type: text/xml;charset=\"utf-8\"",
			"Accept: text/xml",
			"Cache-Control: no-cache",
			"Pragma: no-cache",
			"SOAPAction: http://www.crmnext.com/api/ICRMnextApi/Save", 
			"Content-length: ".strlen($xmstr),
		); //SOAPAction: your op URL

$url = "http://ssl.crmnext.com/WebApi/CRMnextService.svc";

// PHP cURL  for https connection with auth
$ch = curl_init();
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//curl_setopt($ch, CURLOPT_USERPWD, $soapUser.":".$soapPassword); // username and password - declared at the top of the doc
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
curl_setopt($ch, CURLOPT_TIMEOUT, 10);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $xmstr); // the SOAP request
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$response = curl_exec($ch); 
curl_close($ch);

echo '<pre>';print_r($xmstr);
echo '<br><br>';
echo '<pre>';print_r($response);

?>
