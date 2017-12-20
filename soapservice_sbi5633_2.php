 <?php
 @set_time_limit(1000);
 require 'scripts/db_init.php';

sbisecond();

 function sbisecond()
 {
	$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")+1, date("Y"));
	$Today=date('d/m/Y',$tomorrow);
  echo $sbiccqry="Select`ApplicationNumber`,`sbicclogid` From sbi_credit_card_5633_log where (`request2_xml`='' and `ApplicationNumber`>0 and `Messages` IS NULL and (`ProcessingStatus`=1 or `ProcessingStatus`=2)) group by `cc_requestid` order by `sbicclogid` DESC limit 0,4";
$sbiccqryre=ExecQuery($sbiccqry);
	  while($ccrow=mysql_fetch_array($sbiccqryre))
	  {
		$ApplicationNumber = $ccrow["ApplicationNumber"];
		$sbicclogid = $ccrow["sbicclogid"];
		$Dated=ExactServerdate();

		 $xmlstr='<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:qde="http://qde.service.los" xmlns:xsd="http://to.service.los/xsd">
		   <soapenv:Header/>
		   <soapenv:Body>
			  <qde:invoke>         
				 <qde:losRequest>           
					<xsd:data>
		<![CDATA[
		<LeadAllocationRequest>
		<ApplicationNumber>'.$ApplicationNumber.'</ApplicationNumber>
		<PickUpDate>'.$Today.'</PickUpDate>
		<PickUpTime>11:00</PickUpTime>
		<DocBoy></DocBoy>
		<FollowUpText></FollowUpText>
		<PickUpLocation>O</PickUpLocation>
		<NewAddress></NewAddress>
		<Disposition>AA</Disposition>
		</LeadAllocationRequest>
		]]>
		</xsd:data>
				   <xsd:requestid></xsd:requestid>            
					<xsd:userCtx>               
					   <xsd:password>de@l4loan5</xsd:password>              
					   <xsd:userId>79584822</xsd:userId>
					</xsd:userCtx>
				 </qde:losRequest>
			  </qde:invoke>
		   </soapenv:Body>
		</soapenv:Envelope>'; 
				echo $xmlstr."<br>";
				echo "<br><br>";
		//$url = 'http://servicetest.gecapital1.glb.gemoney.in/DevWebService/LOSWebApp/services/LeadAllocationService?wsdl';
		$url ='https://napsservices.originations.gecapital.in/LOSWebApp/services/LeadAllocationService?wsdl';
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/xml'));
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "$xmlstr");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$output = curl_exec($ch);
		curl_close($ch); 
//print_r($output);
		$xml_string =  str_replace("<?xml version='1.0' encoding='UTF-8'?>", '<?xml version="1.0" encoding="UTF-8"?>', $output);
		$xml_string =  str_replace("&lt;", "<", $xml_string);
		$xml_string = str_ireplace('<?xml version="1.0" encoding="UTF-8"?><soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/"><soapenv:Body><qde:invokeResponse xmlns:qde="http://qde.service.los"><qde:return><ns1:data xmlns:ns1="http://to.service.los/xsd">',"", $xml_string );
		//$xml_string = str_ireplace('</ns1:data>',"", $xml_string );
		$xml_string = str_ireplace('</qde:return></qde:invokeResponse></soapenv:Body></soapenv:Envelope>',"", $xml_string );
		list($firstxml, $secondxml)= split ("</ns1:data>", $xml_string);
		$xml = simplexml_load_string($firstxml);

		$ApplicationNumber = $xml->LeadRefNo;
		$ApplicationNumber = $xml->ApplicationNumber;
		$StatusCode = $xml->Status;
		$ProcessingStatus = $xml->StatusDesc;
		$ProcessingStatus = $xml->ApplicationState;
		$ProcessingStatus = $xml->CreditLimit;

		$insertDataArray = array("request2_xml" =>$xmlstr, "response2_xml" =>$output, "ApplicationNumber_2" =>$ApplicationNumber, "StatusCode_2" =>$StatusCode, "ProcessingStatus_2" =>$ProcessingStatus, "Messages_2" =>$Message, "code_2"=>$code, "message_2"=>$message, "sbiccid"=>$sbiccid, "second_other"=>$secondxml, "second_dated"=>$Dated );
			$wherecondition ="(sbicclogid='".$sbicclogid."')";
			Mainupdatefunc ('sbi_credit_card_5633_log', $insertDataArray, $wherecondition);
	  }
 }
 
?>