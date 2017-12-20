<?php

ini_set('max_execution_time', 1000);
 require 'scripts/db_init.php';
 echo "<br>**********************************************************sbi_credit_card_5633*************************************<br>";
$db_table="sbi_credit_card_5633";
$primary_key_table = "sbiccid";//sbicclogid
$product_RequestID = "RequestID"; //"cc_requestid";
sbisecond_withStatusCode_webservice($db_table,$primary_key_table,$product_RequestID);
//soft approval 
//status 1 sbi_credit_card_5633
 echo "<br>**********************************************************sbi_credit_card_5633*************************************<br>";
 echo "<br>";
  echo "<br>**********************************************************sbi_credit_card_5633_log*************************************<br>";
$db_table1="sbi_credit_card_5633_log";
$primary_key_table1 = "sbicclogid";//
$product_RequestID1 = "cc_requestid"; //
sbisecond_withStatusCode_webservice($db_table1,$primary_key_table1,$product_RequestID1);
  echo "<br>**********************************************************sbi_credit_card_5633_log*************************************<br>";
	

 function sbisecond_withStatusCode_webservice($db_table,$primary_key_table,$product_RequestID)
 {
	$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")+1, date("Y"));
	$Today=date('d/m/Y',$tomorrow);
	$time = date('H:i');
	$min_date = date('Y-m-d H:i:s', strtotime('-60 minutes'));
//  echo $sbiccqry="Select `ApplicationNumber`,".$primary_key_table." From ".$db_table." where (`request2_xml`='' and `ApplicationNumber`>0 and `Messages` IS NULL and (`ProcessingStatus`=1) and first_dated>'".$min_date."')  group by ".$product_RequestID." order by ".$primary_key_table." DESC  limit 0,1";

  echo $sbiccqry="Select `ApplicationNumber`,".$primary_key_table." From ".$db_table." where (Status_3 in (120, 118,170) AND third_dated>'".$min_date."')   group by ".$product_RequestID." order by ".$primary_key_table." DESC";

$sbiccqryre=ExecQuery($sbiccqry);
echo "<br>";
//die();
	  while($ccrow=mysql_fetch_array($sbiccqryre))
	  {
		$ApplicationNumber = $ccrow["ApplicationNumber"];
		$sbicclogid = $ccrow[$primary_key_table];
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
		<PickUpTime>'.$time.'</PickUpTime>
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
		echo "<br><br>";
		echo $xmlstr."<br>";
		echo "<br><br>";
		//$url = 'http://servicetest.gecapital1.glb.gemoney.in/DevWebService/LOSWebApp/services/LeadAllocationService?wsdl';
	
//		$url ='https://napsservices.originations.gecapital.in/LOSWebApp/services/LeadAllocationService?wsdl';
		$url ='https://napsservices.napsonline.com/LOSWebApp/services/LeadAllocationService?wsdl';
		
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/xml'));
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "$xmlstr");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$output = curl_exec($ch);
		curl_close($ch);
		echo "<br><br>Output Start - <br>"; 
		print_r($output);
		echo "<br> - Output End<br><br>";
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
		echo "<br><br>";
	//echo	$updatesql = "update ".$db_table." set request2_xml='".$xmlstr."', response2_xml='".$output."', ApplicationNumber_2='".$ApplicationNumber."', StatusCode_2='".$StatusCode."', ProcessingStatus_2='".$ProcessingStatus."', Messages_2='".$Message."', code_2='".$code."', message_2='".$message."', sbiccid='".$sbiccid."', second_other='".$secondxml."', second_dated='".$Dated."' where ".$primary_key_table."='".$sbicclogid."'";
		if($db_table=="sbi_credit_card_5633_log")
		{	
			$insertDataArray = array("request2_xml" =>$xmlstr, "response2_xml" =>$output, "ApplicationNumber_2" =>$ApplicationNumber, "StatusCode_2" =>$StatusCode, "ProcessingStatus_2" =>$ProcessingStatus, "Messages_2" =>$Message, "code_2"=>$code, "message_2"=>$message, "sbiccid"=>$sbiccid, "second_other"=>$secondxml, "second_dated"=>$Dated );
		}
		else
		{
			$insertDataArray = array("request2_xml" =>$xmlstr, "response2_xml" =>$output, "ApplicationNumber_2" =>$ApplicationNumber, "StatusCode_2" =>$StatusCode, "ProcessingStatus_2" =>$ProcessingStatus, "Messages_2" =>$Message, "code_2"=>$code, "message_2"=>$message, "second_other"=>$secondxml, "second_dated"=>$Dated );
		}		
		echo $wherecondition ="(".$primary_key_table."='".$sbicclogid."')";
		echo "<br>";
		print_r($insertDataArray);	
			echo "<br><br>";
		Mainupdatefunc ($db_table, $insertDataArray, $wherecondition);
	
	  }
 }

?>