<?php
require_once ("lib/nusoap.php");

   $soapClient = new nusoap_client("http://servicetest.gecapital1.glb.gemoney.in/DevWebService/LOSWebApp/services/ApplicationIngestionService?wsdl", true);
/*	< LeadAllocationRequest > 
      	        <ApplicationNumber>Test</ApplicationNumber>
         	       <PickUpDate>12/12/2014</PickUpDate>
        	       <PickUpTime>20:30</PickUpTime>
         	       <DocBoy>DOC1234</DocBoy>
         	      <FollowUpText>Contact customer</FollowUpText>         
         	     <PickUpLocation>O<PickUpLocation>
          </ LeadAllocationRequest >
*/
	$ap_param=array('ApplicationNumber'=>'Test','PickUpDate'=>'12/12/2014','PickUpTime'=>'20:30', 'DocBoy'=>'DOC1234','FollowUpText'=>'Contact customer', 'PickUpLocation'=>'location' );  
	print_r($ap_param);
	echo "<br><br>";
    $info = $soapClient->call("LeadAllocationRequest", array($ap_param), "http://servicetest.gecapital1.glb.gemoney.in/DevWebService/LOSWebApp/services/ApplicationIngestionService?wsdl" );
print_r($info);
	echo "<br><br>";
?>