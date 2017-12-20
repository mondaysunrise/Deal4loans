 <?php
 @set_time_limit(1000);
 require 'scripts/db_init.php';

sbithird();

 function sbithird()
 {
	$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-1, date("Y"));
	$Today=date('Y-m-d',$tomorrow);
	$min_date=$Today." 00:00:00";
	$max_date=$Today." 23:59:59";
  echo $sbiccqry="Select`ApplicationNumber`,`sbicclogid` From sbi_credit_card_5633_log where ((ApplicationNumber!='' and ApplicationNumber_2!='' and (ApplicationState_3='' or ApplicationNumber_3='WIP')) and second_dated between '".$min_date."' and '".$max_date."') group by `cc_requestid` order by `sbicclogid` DESC ";
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
		<ApplicationStatusRequest>
		<ApplicationNumber>'.$ApplicationNumber.'</ApplicationNumber>
		<LeadRefNo></LeadRefNo>
		</ApplicationStatusRequest>
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
			//	echo $xmlstr."<br>";
				echo "<br><br>";
		$headers = array(   "Content-type: text/xml;charset=\"utf-8\"",
                        "Accept: text/xml",
                        "SOAPAction:urn:getStatus", 
                       ); //SOAPAction: your op URL

	$url ='https://napsservices.originations.gecapital.in/LOSWebApp/services/ApplicationStatusService?wsdl';
	$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "$xmlstr");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$output = curl_exec($ch);
		curl_close($ch); 
	$xml_string =  str_replace("<?xml version='1.0' encoding='utf-8'?>", '<?xml version="1.0" encoding="UTF-8"?>', $output);
	$xml_string =  str_replace("&lt;", "<", $xml_string);
	$xml_string = str_ireplace('<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/"><soapenv:Body><qde:getStatusResponse xmlns:qde="http://qde.service.los"><qde:return><ns1:data xmlns:ns1="http://to.service.los/xsd">',"", $xml_string );
	//$xml_string = str_ireplace('</ns1:data>',"", $xml_string );
	$xml_string = str_ireplace('</qde:return></qde:invokeResponse></soapenv:Body></soapenv:Envelope>',"", $xml_string );
	list($firstxml, $secondxml)= split ("</ns1:data>", $xml_string);
	$firstxml = str_ireplace('<?xml version="1.0" encoding="UTF-8"?><?xml version="1.0" encoding="UTF-8"?>','<?xml version="1.0" encoding="UTF-8"?>', $firstxml );
	$xml = simplexml_load_string($firstxml);
	
	echo "ApplicationNumber: ".$ApplicationNumber = $xml->ApplicationNumber; echo "<br>";
	echo "LeadRefNo: ".$LeadRefNo = $xml->LeadRefNo;echo "<br>";
	echo "Status: ".$Status = $xml->Status;echo "<br>";
	echo "StatusDesc: ".$StatusDesc = $xml->StatusDesc;echo "<br>";
	echo "ApplicationState: ".$ApplicationState = $xml->ApplicationState;echo "<br>";
	echo "DecisionCode1: ".$DecisionCode1 = $xml->DecisionCode1;echo "<br>";
	echo "CreditLimit: ".$CreditLimit = $xml->CreditLimit;echo "<br>";
	echo "message: ".$message = $xml->message;echo "<br>";

		$insertDataArray = array("request3_xml" =>$xmlstr, "response3_xml" =>$output, "ApplicationNumber_3" =>$ApplicationNumber, "LeadRefNo_3"=>$LeadRefNo, "Status_3" =>$Status, "StatusDesc_3" =>$StatusDesc, "ApplicationState_3" =>$ApplicationState, "CreditLimit_3"=>$CreditLimit, "DecisionCode"=> $DecisionCode1, "message_3"=> $message,"third_other"=>$secondxml, "third_dated"=>$Dated );
			$wherecondition ="(sbicclogid='".$sbicclogid."')";
			Mainupdatefunc ('sbi_credit_card_5633_log', $insertDataArray, $wherecondition);
	  }
 }

?>