<?php
class cibilExperian 
{
	
	var $landingPageSubmitUrl_UAT = "https://cbv2cpu.uat.experian.in:16443/ECV-P2/content/singleAction.action";//UAT
	var $generateQuestionForConsumerUrl_UAT = 'https://cbv2cpu.uat.experian.in:16443/ECV-P2/content/generateQuestionForConsumer.action';//UAT
	var $landingPageSubmitUrl = "https://consumer.experian.in:8443/ECV-P2/content/singleAction.action";//Production
	var $generateQuestionForConsumerUrl = 'https://consumer.experian.in:8443/ECV-P2/content/generateQuestionForConsumer.action';//Production
	
	function cibilExperian()
	{
		return(true);
	}
	
	function landingPageSubmit($voucherCode, $firstName, $middleName, $surName, $dateOfBirth, $gender, $mobileNo, $telephoneNo, $telephoneType, $email, $flatno, $buildingName, $roadName, $city, $state, $pincode,$pan, $passport, $aadhaar, $voterid, $driverlicense, $rationcard, $reason, $insertID, $counter,$servertype='production')
	{
	 $nowdated = ExactServerdate();

		$clientName = 'DEAL_4_LOANS'; //mandatory
		$allowInput=1; //mandatory
		$allowEdit=1; //mandatory
		$allowCaptcha=1; //mandatory
		$allowConsent=1; //mandatory
		$allowConsent_additional=1; //
		$allowEmailVerify=1; //mandatory
		$allowVoucher=1; //mandatory
		$noValidationByPass=0; //conditional mandatory
		$emailConditionalByPass=1; //conditional mandatory
		$state=str_pad($state, 2, '0', STR_PAD_LEFT);
		$param = '';
		$param["clientName"] = $clientName; //mandatory
		$param["allowInput"] = $allowInput; //mandatory
		$param["allowEdit"] = $allowEdit; //mandatory
		$param["allowCaptcha"] = $allowCaptcha; //mandatory
		$param["allowConsent"] = $allowConsent; //mandatory
		$param["allowConsent_additional"] = $allowConsent_additional; //
		$param["allowEmailVerify"] = $allowEmailVerify; //mandatory
		$param["allowVoucher"] = $allowVoucher; //mandatory
		$param["voucherCode"] = $voucherCode; // conditional mandatory
		$param["noValidationByPass"] = $noValidationByPass; //conditional mandatory
		$param["emailConditionalByPass"] = $emailConditionalByPass; //conditional mandatory
		$param["firstName"] = $firstName; //mandatory
		if(strlen($middleName)>0) {	$param["middleName"] = $middleName; }
		$param["surName"] = $surName; //mandatory
		$param["dateOfBirth"] = $dateOfBirth; //mandatory
		$param["gender"] = $gender; //mandatory
		$param["mobileNo"] = $mobileNo; //conditional mandatory
		if(strlen($telephoneNo)>0) { 	$param["telephoneNo"] = $telephoneNo; }
		if(strlen($telephoneType)>0) {  $param["telephoneType"] = $telephoneType; }
		$param["email"] = $email; //mandatory
		$param["flatno"] = $flatno; //mandatory
		if(strlen($buildingName)>0) {	$param["buildingName"] = $buildingName; }
		if(strlen($roadName)>0)	{	$param["roadName"] = $roadName; }
		$param["city"] = $city; //mandatory
		$param["state"] = $state; //mandatory
		$param["pincode"] = $pincode; //
		$param["pan"] = $pan; //conditional mandatory
		if(strlen($passport)>0)  { $param["passport"] = $passport; }
		if(strlen($aadhaar)>0)  { $param["aadhaar"] = $aadhaar; }
		if(strlen($voterid)>0)  { $param["voterid"] = $voterid; }
		if(strlen($driverlicense)>0)  { $param["driverlicense"] = $driverlicense; }
		if(strlen($rationcard)>0)  { $param["rationcard"] = $rationcard; }
		$param["reason"] = $reason; // mandatory
		
		$request = '';
		foreach($param as $key=>$val) { $request.= $key."=".urlencode($val); $request.= "&"; }
		$request = substr($request, 0, strlen($request)-1);
		if($servertype=='production')
		{
		 	$url = $this->landingPageSubmitUrl;
		} 
		else
		{
		 	$url = $this->landingPageSubmitUrl_UAT;		
		}
		//echo "<br>";
		//echo $url;
		//echo "<br>";
		//echo $request;
		
		//echo "<br>";		echo "<br>";		echo "<br>";
		$strCookie = "sessionId=".session_id()."; path=".session_save_path();
		session_write_close();
		// cURL's initialization
		$agent = $_SERVER['HTTP_USER_AGENT'];
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_USERAGENT, $agent);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HEADER, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('application/x-www-form-urlencoded','Content-Length:'. strlen($request)));
		curl_setopt($ch, CURLOPT_TIMEOUT, 180);//Time in seconds
		curl_setopt ($ch, CURLOPT_AUTOREFERER, true);
		curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 2);
		curl_setopt($ch, CURLOPT_COOKIESESSION, true);
		curl_setopt($ch, CURLOPT_COOKIE, $strCookie);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
		$result = curl_exec($ch);

		$header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
		$curl_header = substr($result, 0, $header_size);
		$curl_body = substr($result, $header_size);
		
		if(curl_error($ch))
		{
			$status = 3;
			$returnValue[] = 'Failure';
			$returnValue[] = 'curl error: ('.curl_errno($ch).')'. curl_error($ch);
			
		} else 
		{
			preg_match_all('/^Set-Cookie:\s*([^;]*)/mi', $curl_header, $matches);
			$cookies = array();
			foreach($matches[1] as $item) 
			{
				parse_str($item, $cookie);
				$cookies = array_merge($cookies, $cookie);
			}
			
		//	echo "<br>";
			$obj = json_decode($curl_body);
		//	print_r($obj); echo "<br>";
			$errorString =  $obj->errorString;
			$stageOneId = $obj->stageOneId_;
			$stageTwoId= $obj->stageTwoId_;
			$showHtmlReportForCreditReport = $obj->showHtmlReportForCreditReport;
			$updateSql = "UPDATE experian_initial_details SET Stage1ID='".$stageOneId."', Stage2ID='".$stageTwoId."' WHERE id='".$insertID."'";
			$updateQuery = d4l_ExecQuery($updateSql);

			if($errorString!='')
			{
				$checkPhrase = "Please try to invoke CRQ externally";
				if( strpos( $errorString, $checkPhrase) !== false )
				{
					$Stage2JSESSIONID_d4l=$cookies['JSESSIONID'];
					$_SESSION['Stage2JSESSIONID_d4l']=$Stage2JSESSIONID_d4l;
				//	echo $servertype.", ".$insertID.", ".$stageOneId.", ".$stageTwoId.", ".$Stage2JSESSIONID_d4l;
				//	die();
					list($Questionset_Status, $questionset) = $this->generateQuestionForConsumer($servertype,$insertID,$stageOneId , $stageTwoId, $Stage2JSESSIONID_d4l);
					$returnValue[] = $Questionset_Status;
					$returnValue[] = $questionset;
				}
				else
				{
					$returnValue[] = 'Failure';
					$returnValue[] = $errorString;
				}
			}
			else
			{
				$returnValue[] = 'Success';
				$showHtmlReportForCreditReportArr = explode('<---------- END OF REPORT ---------->', $showHtmlReportForCreditReport);
				//	echo '<div class="pl-bank-leftinn inner-body-plbanks" style="padding:10px;">';
				$showHtmlReportForCreditReportStr2 = trim($showHtmlReportForCreditReportArr[0]);
				
				//	echo "  </div>";
				$explodeValforXML = explode('name="xmlResponse"',$showHtmlReportForCreditReport );
				
				$xml1stVal = trim($explodeValforXML[1]);
				$finalXmlResponse = str_replace('"/>','', $xml1stVal);
				
				$finalXmlResponse = ltrim($finalXmlResponse,'value="');
				$finalXmlResponse = str_replace('</html>','', $finalXmlResponse );
				$finalXmlResponse = str_replace('</body>','', $finalXmlResponse );
				$finalXmlResponse = html_entity_decode($finalXmlResponse);
				
				$xml = new SimpleXMLElement(trim($finalXmlResponse));
			
				$BureauScore = $xml->SCORE->BureauScore;
				$returnValue[] = $BureauScore;
				$BureauScoreConfidLevel= $xml->SCORE->BureauScoreConfidLevel;
				//echo "BureauScore - ".$BureauScore;
				//echo "<br>";
				//echo "BureauScoreConfidLevel - ".$BureauScoreConfidLevel;
				$updateSql = "UPDATE experian_initial_details SET cibil_score='".$BureauScore."' WHERE id='".$insertID."'";
				$updateQuery = d4l_ExecQuery($updateSql);

				$pagename = $insertID."_".$counter."_".date("dmYhis");
				$htmlFileName = './experianxml/'.$pagename.".html";
				d4l_ExecQuery("INSERT INTO experian_xml_files (`requestid`, `filename`, `dated`, `counter`, file_type) VALUES ('".$insertID."', '".$pagename."', '".$nowdated."', '".$counter."', 'html')");
				$html_file = file_put_contents($htmlFileName ,$showHtmlReportForCreditReportStr2, FILE_APPEND);
			
				$newFileName = './experianxml/'.$pagename.".xml";
				d4l_ExecQuery("INSERT INTO experian_xml_files (`requestid`, `filename`, `dated`, `counter`, file_type) VALUES ('".$insertID."', '".$pagename."', '".$nowdated."', '".$counter."', 'xml')");
				$xml_file = file_put_contents($newFileName,$finalXmlResponse, FILE_APPEND);
			}
		}
		$info = curl_getinfo($ch);
		curl_close($ch);
		
//		print_r ($returnValue);
		
		return 	$returnValue;	//JSESSIONID_d4l [Use this as variable name]	
	}	


	function generateQuestionForConsumer($servertype,$insertID, $Stage1Id, $Stage2Id, $Stage2JSESSIONID_d4l, $qid = '', $answer = '')
	{
	 $nowdated = ExactServerdate();

		//echo "<br>############generateQuestionForConsumer####################<br>";
		$param = '';
		if(strlen($qid)>0)
		{
			$param["answer"] = $answer;
			$param["questionId"] = $qid;
		}
		$param["stgOneHitId"] = $Stage1Id;
		$param["stgTwoHitId"] = $Stage2Id;
		//print_r($param);
		//echo "<br>".$Stage2JSESSIONID_d4l."<br>";
		$request = '';
		foreach($param as $key=>$val) { $request.= $key."=".urlencode($val); $request.= "&"; }
		$request = substr($request, 0, strlen($request)-1);
		
		if($servertype=='production')
		{
		 	$url = $this->generateQuestionForConsumerUrl;
		} 
		else
		{
			$url = $this->generateQuestionForConsumerUrl_UAT;
		}
		
	//	echo $request;
	//	echo "<br>";
		
	//	die();
		$strCookie = "JSESSIONID=".$Stage2JSESSIONID_d4l;
		session_write_close();
		$agent = $_SERVER['HTTP_USER_AGENT'];
		// cURL's initialization
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_USERAGENT, $agent);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		//curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Content-Length:'. strlen($request)));		
		curl_setopt($ch, CURLOPT_TIMEOUT, 180);
		curl_setopt($ch, CURLOPT_COOKIESESSION, true);
		curl_setopt($ch, CURLOPT_COOKIE, $strCookie);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
		
		$result = curl_exec($ch);
		$info = curl_getinfo($ch);
		curl_close($ch);
	/*	echo "<br>############generateQuestionForConsumer[487]####################<br>";
		print("<pre>");
		print_r($result);
	
		echo "<br>############generateQuestionForConsumer[487]####################<br>";
		die();
	*/		
		$obj = json_decode($result);
		$questionToCustomer = $obj->questionToCustomer;
		$optionsSet1 = $questionToCustomer->optionsSet1;
		$optionsSet2 = $questionToCustomer->optionsSet2;
		$qid = $questionToCustomer->qid;
		$question = $questionToCustomer->question;
		$secondXMLResponse = $questionToCustomer->secondXMLResponse;
		$toolTip = $questionToCustomer->toolTip;
		$type = $questionToCustomer->type;
		$responseJson = $obj->responseJson;
		$showHtmlReportForCreditReport = $obj->showHtmlReportForCreditReport;
		$stgOneHitId = $obj->stgOneHitId;
		$stgTwoHitId = $obj->stgTwoHitId;
		
		if($responseJson=='next')
		{
			$returnValue[] = 'QuestionSuccess';
			$returnValue[] = $result;
		}
		else if($responseJson=="passedReport")
		{
			$returnValue[] = 'passedReport';
			
			$showHtmlReportForCreditReportArr = explode('<---------- END OF REPORT ---------->', $showHtmlReportForCreditReport);
			//	echo '<div class="pl-bank-leftinn inner-body-plbanks" style="padding:10px;">';
			$showHtmlReportForCreditReportStr2 = trim($showHtmlReportForCreditReportArr[0]);
			//	echo "  </div>";
			$explodeValforXML = explode('name="xmlResponse"',$showHtmlReportForCreditReport );
			
			$xml1stVal = trim($explodeValforXML[1]);
			$finalXmlResponse = str_replace('"/>','', $xml1stVal);
			
			$finalXmlResponse = ltrim($finalXmlResponse,'value="');
			$finalXmlResponse = str_replace('</html>','', $finalXmlResponse );
			$finalXmlResponse = str_replace('</body>','', $finalXmlResponse );
			$finalXmlResponse = html_entity_decode($finalXmlResponse);
			
			$xml = new SimpleXMLElement(trim($finalXmlResponse));
		
			$BureauScore = $xml->SCORE->BureauScore;
			$returnValue[] = $BureauScore;
			$BureauScoreConfidLevel= $xml->SCORE->BureauScoreConfidLevel;
			$updateSql = "UPDATE experian_initial_details SET cibil_score='".$BureauScore."' WHERE id='".$insertID."'";
			$updateQuery = d4l_ExecQuery($updateSql);
			
			//echo "BureauScore - ".$BureauScore;
			//echo "<br>";
			//echo "BureauScoreConfidLevel - ".$BureauScoreConfidLevel;
			
			$pagename = $insertID."_".$counter."_".date("dmYhis");
			$htmlFileName = './experianxml/'.$pagename.".html";
			d4l_ExecQuery("INSERT INTO experian_xml_files (`requestid`, `filename`, `dated`, `counter`, file_type) VALUES ('".$insertID."', '".$pagename."', '".$nowdated."', '".$counter."', 'html')");
			$html_file = file_put_contents($htmlFileName ,$showHtmlReportForCreditReportStr2, FILE_APPEND);
			
			$xmlFileName = './experianxml/'.$pagename.".xml";
			d4l_ExecQuery("INSERT INTO experian_xml_files (`requestid`, `filename`, `dated`, `counter`, file_type) VALUES ('".$insertID."', '".$pagename."', '".$nowdated."', '".$counter."', 'xml')");
			$xml_file = file_put_contents($xmlFileName ,$finalXmlResponse, FILE_APPEND);
	//	echo "<br>".$result;
			//$returnValue[] = $result;			
		}
		else if($responseJson=="systemError" || $responseJson=="inCorrectAnswersGiven" || $responseJson=="insufficientQuestion" || $responseJson=="error" || $responseJson=="creditReportEmpty")
		{
			$returnValue[] = 'Failure';
			$returnValue[] = $responseJson;
		}
		else
		{
			$returnValue[] = 'Failure';
			$returnValue[] = $responseJson;
		//echo "<br>############generateQuestionForConsumer[525]####################<br>";
		//		print("<pre>");
	//	print_r($result);
		//echo "<br>############generateQuestionForConsumer[525]####################<br>";
		}
		return $returnValue;
	}
	
	
	function getVoucherCode($insertID, $voucher_type)
	{
		$dated = date("Y-m-d");
		$getVoucherCodeSql = "select vouchercode, StartDate, ExpiryDate, id from experian_vouchers_codes where VoucherUsedIndicator='N' and Assignedtoconsumer='N' and ('".$dated."'  between STR_TO_DATE(StartDate,'%d-%m-%Y') and STR_TO_DATE(ExpiryDate,'%d-%m-%Y')) AND voucher_type='".$voucher_type."' order by id asc limit 0,1";
		$getVoucherCodeQuery = d4l_ExecQuery($getVoucherCodeSql);
		$voucherCode = d4l_mysql_result($getVoucherCodeQuery,0,'vouchercode');
	
		$DataArray = array('vouchercode'=>Fixstring($voucherCode) );
		//print_r($DataArray);
		$wherecondition =" (id=".$insertID.")";
		Mainupdatefunc ('experian_initial_details', $DataArray, $wherecondition);
	
		$DataArrayVC = array("requestid"=>$insertID, "VoucherUsedIndicator"=>'Y');
		$whereconditionVC ="(vouchercode='".$voucherCode."')";
		Mainupdatefunc ('experian_vouchers_codes', $DataArrayVC, $whereconditionVC);
		
		return $voucherCode;
	
	}

	function leadAllocation($insertID)
	{
	
	
	
	}



}
?>
