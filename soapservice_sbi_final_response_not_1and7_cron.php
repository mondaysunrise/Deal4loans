 <?php
ini_set('max_execution_time', 2000);
 require 'scripts/db_init.php';

$db_table="sbi_credit_card_5633";
$primary_key_table = "sbiccid";//sbicclogid
$product_RequestID = "RequestID"; //"cc_requestid";
sbithird_webservice($db_table,$primary_key_table,$product_RequestID);

$db_table1="sbi_credit_card_5633_log";
$primary_key_table1 = "sbicclogid";//
$product_RequestID1 = "cc_requestid"; //
//sbithird_webservice($db_table1,$primary_key_table1,$product_RequestID1);


 function sbithird_webservice($db_table,$primary_key_table,$product_RequestID)
 {
	$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-5, date("Y"));
	$Today=date('Y-m-d',$tomorrow);
	$min_date=$Today." 00:00:00";
	$max_date=date('Y-m-d')." 23:59:59";
//  echo $sbiccqry="Select`ApplicationNumber`,".$primary_key_table." From ".$db_table." where ((ApplicationNumber!='' and ApplicationNumber_2!='' and (ApplicationNumber_3='' or ApplicationState_3 NOT IN ('FD','FA'))) and second_dated between '".$min_date."' and '".$max_date."') group by ".$product_RequestID." order by ".$primary_key_table." DESC  limit 0,1";
  echo $sbiccqry="Select LeadRefNumber, `ApplicationNumber`,".$primary_key_table." From ".$db_table." where (((`ProcessingStatus` NOT IN (1,7)) and (ApplicationNumber_3='' or ApplicationState_3 NOT IN ('FD','FA'))) and first_dated between '".$min_date."' and '".$max_date."') group by ".$product_RequestID." order by ".$primary_key_table." DESC";
$sbiccqryre=d4l_ExecQuery($sbiccqry);

		echo "<br>";
echo $num = d4l_mysql_num_rows($sbiccqryre);
//exit();
	  while($ccrow=d4l_mysql_fetch_array($sbiccqryre))
	  {
		$ApplicationNumber = $ccrow["ApplicationNumber"];
		$LeadRefNumber= $ccrow["LeadRefNumber"];
		$sbicclogid = $ccrow[$primary_key_table];
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
		<LeadRefNo>'.$LeadRefNumber.'</LeadRefNo>
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
				echo $xmlstr."<br>";
				echo "<br><br>";
		$headers = array(   "Content-type: text/xml;charset=\"utf-8\"",
                        "Accept: text/xml",
                        "SOAPAction:urn:getStatus", 
                       ); //SOAPAction: your op URL

//	$url ='https://napsservices.originations.gecapital.in/LOSWebApp/services/ApplicationStatusService?wsdl';
	$url = 'https://napsservices.napsonline.com/LOSWebApp/services/ApplicationStatusService?wsdl';
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
		
			$wherecondition ="(".$primary_key_table."='".$sbicclogid."')";
			Mainupdatefunc ($db_table, $insertDataArray, $wherecondition);
	  }
 }

?>