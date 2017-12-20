<?php
@set_time_limit(1000);
require 'scripts/db_init.php';
sebisent();

function GetStatecCode($pKey){
    $titles = array(
	'Andhra Pradesh' => 'APR',
	'Arunachal Pradesh' => 'AR',
	'Assam' => 'AS',
	'Bihar' => 'BIH',
	'Chhattisgarh' => 'CT',
	'Chandigarh' => 'CHD',
	'Delhi' => 'DEL',
	'Goa' => 'GA',
	'Gujarat' => 'GUJ',
	'Haryana' => 'HAR',
	'Himachal Pradesh' => 'HP',
	'Jammu and Kashmir' => 'JK',
	'Jharkhand' => 'JH',
	'Karnataka' => 'KTK',
	'Kerala' => 'KER',
	'Madhya Pradesh' => 'MAD',
	'Maharashtra' => 'MAH',
	'Manipur' => 'MN',
	'Meghalaya' => 'ML',
	'Mizoram' => 'MZ',
	'Nagaland' => 'NL',
	'Odisha' => 'ORI',
	'Punjab' => 'PUN',
	'Rajasthan' => 'RAJ',
	'Sikkim' => 'SK',
	'Tamil Nadu' => 'TMN',
	'Telangana' => 'TG',
	'Tripura' => 'TR',
	'Uttar Pradesh' => 'UP',
	'Uttarakhand' => 'UT',
	'West Bengal' => 'WBG'
	  );
    foreach ($titles as $key=>$value)
        if($pKey==$key)
        return $value;
    return "";
  }

function GetSourceCode($pKey){
    $titles = array(
	 'Ahmedabad' => 'AI01',
	'Baroda' => 'AE01',
	'Coimbatore' => 'AQ01',
	'Indore' => 'AU01',
	'Jaipur' => 'AG01',
	'Lucknow' => 'AL01',
	'Nagpur' => 'AS11',
	'Pune' => 'AN21',
	'Surat' => 'AS12',
	'Bangalore' => 'BANEAP',
	'Chennai' => 'CHENEAP',
	'Faridabad' => 'DELHIEAP',
	'Gaziabad' => 'DELHIEAP',
	'Gurgaon' => 'DELHIEAP',
	'Hyderabad' => 'HYDEAP',
	'Kolkata' => 'KOLEAP',
	'Mumbai' => 'MUMEAP',
	'Delhi' => 'DELHIEAP',
	'Noida' => 'DELHIEAP',
	'Chandigarh' => 'AJ01',
	'Ludhiana' => 'AO01',
	'Jalandhar' => 'AM01',
	'Aurangabad' => 'BJ01',
	'Tirupur' => 'AQ01'
		);
    foreach ($titles as $key=>$value)
        if($pKey==$key)
        return $value;
    return "";
  }
  function sebisent()
  {
	  $sbiccdetails="Select * from sbi_credit_card_5633 Where (pushflag=1) group by RequestID order by sbiccid limit 0,1";
	  $sbiccqry=ExecQuery($sbiccdetails);
	  while($ccrow=mysql_fetch_array($sbiccqry))
	  {
	  $sbiccid = $ccrow["sbiccid"];
	  $RequestID = $ccrow["RequestID"];
	  $CompanyName = $ccrow["CompanyName"];
	  $OfficeAddress1 = $ccrow["OfficeAddress1"];
	  $OfficeAddress2 = $ccrow["OfficeAddress2"];
	  $OfficePin = $ccrow["OfficePin"];
	  $OfficeCity = $ccrow["OfficeCity"];
	  $OfficePhone = $ccrow["LandlineNo"];
	  $OfficeState = $ccrow["OfficeState"];
	  $Qualification = $ccrow["Qualification"];
	  $Designation = $ccrow["Designation"];
	  $CardName = trim($ccrow["CardName"]);
	 $LeadRefNumber = $ccrow["LeadRefNumber"];
	  $Dated=ExactServerdate();
	  if($OfficeCity=="Kolkata")
			{
				$offslct="select std from sbi_cc_city_state_list Where (city like'%CALCUTTA%') group by city Limit 0,1";
			}
			else
			{
			$offslct="select std from sbi_cc_city_state_list Where (city like'%".strtoupper($OfficeCity)."%') group by city Limit 0,1";
			}
			$offslct=ExecQuery($offslct);
			$crow=mysql_fetch_array($offslct);
			$offstd = "0".$crow["std"];
	  
	$slct="select * from Req_Credit_Card Where (RequestID='".$RequestID."')";
		$slctqry=ExecQuery($slct);
		$row=mysql_fetch_array($slctqry);
		$Gender = $row["Gender"];
		$ResiPhone = $row["Landline"];
		$City = $row["City"];
		$City_Other = $row["City_Other"];
		if($City=="Others" && Strlen($City_Other)>0)
		{
			$strcity=$City_Other;
		}
		else
		{
			$strcity=$City;
		}
		$resistd = "";
		if($resistd=="")
		  {
			if($strcity=="Kolkata")
			{
				$resislct="select std,state from sbi_cc_city_state_list Where (city like'%CALCUTTA%') group by city Limit 0,1";
			}
			else if($strcity=="Gaziabad")
			{
				$resislct="select std,state from sbi_cc_city_state_list Where (city like'%Ghaziabad%') group by city Limit 0,1";
			}
			else
			{
			$resislct="select std,state from sbi_cc_city_state_list Where (city like'%".strtoupper($strcity)."%') group by city Limit 0,1";
			}
			$resislct=ExecQuery($resislct);
			$rsrow=mysql_fetch_array($resislct);
			$resistd = "0".$rsrow["std"];
			$residencestate = $rsrow["state"];
		  }
		if($Gender=="Male")
		{
			$strgender="M";
		}
		elseif($Gender=="Female")
		{
			$strgender="F";
		}
		else
		{
			$strgender="M";
		}
		$Mobile = $row["Mobile_Number"];
		$Email = $row["Email"];
		
		$ResiState = $residencestate;
	  
		$Pancard = $row["Pancard"];
		$CompanyName = substr(trim($CompanyName),0,30);
		$ResiAddress3 = str_replace("@", "", $Email);
		$Pincode = $row["Pincode"];
		$Employment_Status = $row["Employment_Status"];
		if($Employment_Status==1)
		{
			$OccupationType = "S";
		}
		else
		{
			$OccupationType = "E";
		}
		list($year,$month,$day) = split("[-]",$row["DOB"]);
		list($first_name,$middle_name,$last_name) = split("[ ]",$row["Name"]);
		if(strlen($middle_name)>0 && $middle_name!="Middle Name" && $last_name=="")
			{
				$last_name= $middle_name;
				$middle_name="";
			}
			else
			{
				if($last_name=="")
					{ $last_name= "Kumar";	}
			}
			
		if($middle_name=="Middle Name")
			{
				$middle_name="";
			}
		
		$Residence_Address = $row["Residence_Address"];
		list($resiaddress1,$resiaddress2,$resiaddress3) = split('[|]',$Residence_Address);
					
		if($CardName=="SBI SimplySave") { $card_type="SSU2"; $PromoCode="SCEA";} elseif($CardName=="SBI Platinum Card"){ $card_type="VPTL"; $PromoCode="SCEA";} elseif($CardName=="SBI Signature Card"){ $card_type="VISC"; $PromoCode="SCEA";} elseif($CardName=="SimplyCLICK SBI Card"){ $card_type="SCU2"; $PromoCode="SCEA";} elseif($CardName=="Air India SBI Platinum Card"){ $card_type="AIPU"; $PromoCode="SCEA";} elseif($CardName=="Air India SBI Signature Card"){ $card_type="AISU"; $PromoCode="SCEA";} elseif($CardName=="Fbb SBI STYLEUP Card"){ $card_type="SCU2"; $PromoCode="SCEA";}elseif($CardName=="IRCTC SBI Platinum Card"){ $card_type="IRCP";  $PromoCode="IREA";}elseif($CardName=="Mumbai Metro SBI Card"){ $card_type="MMSU";  $PromoCode="SCEA";}elseif($CardName=="Yatra SBI Card"){ $card_type="SYT1"; $PromoCode="YAEA"; }elseif($CardName=="SimplyCLICK Contactless SBI Card"){ $card_type="CSC2"; $PromoCode="SCEA";}

		echo $strcity;
		echo $SourceCode = GetSourceCode(ucwords(strtolower($strcity)));
		$CardType = $card_type;
		$yesterday  = mktime(0, 0, 0, date("m")  , date("d")-1, date("Y"));
		$DateSpareField=date('m/d/Y',$yesterday);
		$strdob = $day."/".$month."/".$year;
		$FirstName = substr($first_name,0,12);//mandatory 
		$MiddleName = substr($middle_name,0,10);//mandatory
		$LastName = substr($last_name,0,16);//mandatory
		$Mobile = $Mobile;//mandatory
		$Qualification = $Qualification;
		$PAN = $Pancard;//mandatory
		$ResiAddress1 = trim(substr($resiaddress1,0,40));//mandatory
		$ResiAddress2 = trim(substr($resiaddress2,0,40));//mandatory
		$ResiAddress3 = trim(substr($resiaddress3,0,40));;//mandatory
		$EmailAddress = $Email;//mandatory
		$ResiCity = $strcity;//mandatory
		$ResiState = $ResiState;//mandatory
		$ResiPin = $Pincode;//mandatory
		$OccupationType = $OccupationType;//mandatory
		$CompanyName = $CompanyName;
		$OfficeAddress1 = trim(substr($OfficeAddress1,0,40));//mandatory
		$OfficeAddress2 =trim(substr($OfficeAddress2,0,40));//mandatory
		$EmployeePFNumber="";
		$BranchManagerPFNumber="";

		 $xmlstr='<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:qde="http://qde.service.los" xmlns:xsd="http://to.service.los/xsd">
		   <soapenv:Header/>
		   <soapenv:Body>
			  <qde:invoke>         
				 <qde:losRequest>           
					<xsd:data>
		<![CDATA[
		<ApplicationIngestionRequest>
		<LeadRefNo>'.$LeadRefNumber.'</LeadRefNo>
		<BranchCode></BranchCode>
		<SourceCode>'.$SourceCode.'</SourceCode>
		<SECode>DEAl4LOANS</SECode>
		<PromoCode>'.$PromoCode.'</PromoCode>
		<CardType>'.$CardType.'</CardType>
		<PromoGroup>EA</PromoGroup>
		<ChannelCode>EAPL</ChannelCode>
		<Salutation>1</Salutation>
		<FirstName>'.strtoupper($FirstName).'</FirstName>
		<MiddleName>'.strtoupper($MiddleName).'</MiddleName>
		<LastName>'.strtoupper($LastName).'</LastName>
		<DOB>'.$strdob.'</DOB>
		<Mobile>'.$Mobile.'</Mobile>
		<Gender>'.$strgender.'</Gender>
		<Qualification>'.strtoupper($Qualification).'</Qualification>
		<PAN>'.strtoupper($PAN).'</PAN>
		<EmailAddress>'.$EmailAddress.'</EmailAddress>
		<ResiAddress1>'.strtoupper($ResiAddress1).'</ResiAddress1>
		<ResiAddress2>'.strtoupper($ResiAddress2).'</ResiAddress2>
		<ResiAddress3>'.strtoupper($ResiAddress3).'</ResiAddress3>
		<ResiCity>'.$ResiCity.'</ResiCity>
		<ResiState>'.$ResiState.'</ResiState>
		<ResiPin>'.$ResiPin.'</ResiPin>
		<ResiPhone>'.$ResiPhone.'</ResiPhone>
		<ResiStdCode>'.$resistd.'</ResiStdCode>
		<OccupationType>'.$OccupationType.'</OccupationType>
		<AlternateCardNo></AlternateCardNo>
		<Designation>'.$Designation.'</Designation>
		<CompanyName>'.$CompanyName.'</CompanyName>
		<NatureOfBusiness>A</NatureOfBusiness>
		<OfficeAddress1>'.strtoupper($OfficeAddress1).'</OfficeAddress1>
		<OfficeAddress2>'.strtoupper($OfficeAddress2).'</OfficeAddress2>
		<OfficeAddress3></OfficeAddress3>
		<OfficePhone>'.$OfficePhone.'</OfficePhone>
		<OfficeStdCode>'.$offstd.'</OfficeStdCode>
		<OfficeState>'.$OfficeState.'</OfficeState>
		<OfficeCity>'.$OfficeCity.'</OfficeCity>
		<YearsOfCurrentEmployment>2</YearsOfCurrentEmployment>
		<OfficePin>'.$OfficePin.'</OfficePin>
		<TextSpareField1>D4L'.$RequestID.'</TextSpareField1>
		<TextSpareField2>1</TextSpareField2>
		<TextSpareField3>1</TextSpareField3>
		<TextSpareField4>1</TextSpareField4>
		<TextSpareField5>1</TextSpareField5>
		<NumericSpareField1>1</NumericSpareField1>
		<NumericSpareField2>1</NumericSpareField2>
		<NumericSpareField3>1</NumericSpareField3>
		<NumericSpareField4>1</NumericSpareField4>
		<NumericSpareField5>1</NumericSpareField5>
		<DateSpareField1>'.$DateSpareField.'</DateSpareField1>
		<DateSpareField2>'.$DateSpareField.'</DateSpareField2>
		<DateSpareField3>'.$DateSpareField.'</DateSpareField3>
		<DateSpareField4>'.$DateSpareField.'</DateSpareField4>
		<DateSpareField5>'.$DateSpareField.'</DateSpareField5>
		<EmployeePFNumber></EmployeePFNumber>
		<BranchManagerPFNumber></BranchManagerPFNumber>
		<PriorityFlag>1</PriorityFlag>
		<DateOfPickup></DateOfPickup>
		<TimeOfPickup></TimeOfPickup>
		<StatementPreference>E</StatementPreference>
		<LoyaltyChannel></LoyaltyChannel>
		<LoyaltyNumber></LoyaltyNumber>
		<ActualFulfillmentDeviation>N</ActualFulfillmentDeviation>
		<PhysicalAlreadyReceived>N</PhysicalAlreadyReceived>
		<FathersName></FathersName>
		<MothersMaidenName></MothersMaidenName>
		<ResiLandmark></ResiLandmark>
		<OfficeLandmark></OfficeLandmark>
		</ApplicationIngestionRequest>
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
		echo $xmlstr;
				$username=79584822;
				$password="de@l4loan5";
		$url ='https://napsservices.originations.gecapital.in/LOSWebApp/services/ApplicationIngestionService?wsdl';
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/xml'));
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "$xmlstr");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$output = curl_exec($ch);
		curl_close($ch); 

		//echo $output;
	print_r($output);
		$xml_string =  str_replace("<?xml version='1.0' encoding='UTF-8'?>", '<?xml version="1.0" encoding="UTF-8"?>', $output);
		$xml_string =  str_replace("&lt;", "<", $xml_string);
		$xml_string = str_ireplace('<?xml version="1.0" encoding="UTF-8"?><soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/"><soapenv:Body><qde:invokeResponse xmlns:qde="http://qde.service.los"><qde:return><ns1:data xmlns:ns1="http://to.service.los/xsd">',"", $xml_string );
		//$xml_string = str_ireplace('</ns1:data>',"", $xml_string );
		$xml_string = str_ireplace('</qde:return></qde:invokeResponse></soapenv:Body></soapenv:Envelope>',"", $xml_string );
		list($firstxml, $secondxml)= split ("</ns1:data>", $xml_string);
		$xml = simplexml_load_string($firstxml);
		$LeadRefNumber = $xml->LeadRefNumber;
		$ApplicationNumber = $xml->ApplicationNumber;
		$StatusCode = $xml->StatusCode;
		$ProcessingStatus = $xml->ProcessingStatus;
		$CreditLimit = $xml->CreditLimit;
		$Message = $xml->Messages->Message;
		$code = $xml->code;
		$message = $xml->message;
		$pushflag=0;
	/*	$output="0";
		$LeadRefNumber = "19086000000AI0103049";
		$ApplicationNumber = "1908601003191";
		$StatusCode = "FD";
		$ProcessingStatus = "7";*/
		
		
		if($ProcessingStatus==1 || $ProcessingStatus==2)
	  {
		$secondpushflag=1;
	  }
	  else
	  {
		$secondpushflag=0;
	  }
		 $DataArray = array("request_xml" =>$xmlstr, "response_xml" =>$output, "LeadRefNumber" =>$LeadRefNumber, "ApplicationNumber" =>$ApplicationNumber, "StatusCode" =>$StatusCode, "ProcessingStatus" =>$ProcessingStatus, "CreditLimit" =>$CreditLimit, "Messages" =>$Message, "secondpushflag"=>$secondpushflag, "pushflag"=>$pushflag);
			$wherecondition ="(sbiccid='".$sbiccid."')";
			//print_r($DataArray);
			Mainupdatefunc ('sbi_credit_card_5633', $DataArray, $wherecondition);
		
		$sbilogqry="select sbicclogid from sbi_credit_card_5633_log Where (cc_requestid=".$RequestID.")";
		$sbilogresult=ExecQuery($sbilogqry);
		$lgrow=mysql_fetch_array($sbilogresult);
		if($lgrow["sbicclogid"]>0)
	  {
			$insertDataArray = array("request_xml" =>$xmlstr, "response_xml" =>$output, "LeadRefNumber" =>$LeadRefNumber, "ApplicationNumber" =>$ApplicationNumber, "StatusCode" =>$StatusCode, "ProcessingStatus" =>$ProcessingStatus, "CreditLimit" =>$CreditLimit, "Messages" =>$Message, "code"=>$code, "message"=>$message, "sbiccid"=>$sbiccid, "first_other"=>$secondxml, "first_dated"=>$Dated );
			$wherecondition ="(sbicclogid='".$lgrow["sbicclogid"]."')";
			Mainupdatefunc ('sbi_credit_card_5633_log', $insertDataArray, $wherecondition);
	  }
	  else
	  {
		  $insertDataArray = array("cc_requestid"=>$RequestID, "request_xml" =>$xmlstr, "response_xml" =>$output, "LeadRefNumber" =>$LeadRefNumber, "ApplicationNumber" =>$ApplicationNumber, "StatusCode" =>$StatusCode, "ProcessingStatus" =>$ProcessingStatus, "CreditLimit" =>$CreditLimit, "Messages" =>$Message, "code"=>$code, "message"=>$message, "sbiccid"=>$sbiccid, "first_other"=>$secondxml, "first_dated"=>$Dated );
		$ProductValuelog = Maininsertfunc("sbi_credit_card_5633_log", $insertDataArray);
	  }
	  //print_r($insertDataArray);
	  }
  }

  function GetCityStatecCode($pKey){
    $titles = array(
	'AHMEDABAD' => 'GUJ',
	'AURANGABAD' => 'MAH',
	'BANGALORE' => 'KTK',
	'BARODA' => 'GUJ',
	'BHOPAL' => 'MAD',
	'BHUBANESHWAR' => 'ORI',
	'CALCUTTA' => 'WGB',
	'CHANDIGARH' => 'CHD',
	'CHENNAI' => 'TMN',
	'COIMBATORE' => 'KTK',
	'FARIDABAD' => 'HAR',
	'GHAZIABAD' => 'UP',
	'GURGAON' => 'HAR',
	'HYDERABAD' => 'APR',
	'INDORE' => 'MAD',
	'JAIPUR' => 'RAJ',
	'JALANDHAR' => 'PUN',
	'JAMNAGAR' => 'MAD',
	'LUCKNOW' => 'UP',
	'LUDHIANA' => 'PUN',
	'MUMBAI' => 'MAH',
	'NAGPUR' => 'MAH',
	'NASIK' => 'MAD',
	'NEW DELHI' => 'DEL',
	'NOIDA' => 'UP',
	'PATNA' => 'BIH',
	'PUNE' => 'MAH',
	'RAJKOT' => 'MAD',
	'SURAT' => 'GUJ',
	'TIRUPUR' => 'TMN',
	'TRIVANDRUM' => 'KER'
);
    foreach ($titles as $key=>$value)
        if($pKey==$key)
        return $value;
    return "";
  }
?>