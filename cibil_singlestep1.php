<?php
session_start();
require 'scripts/db_init.php';

function curlResponseHeaderCallback($ch, $headerLine) {
    global $cookies;
    if (preg_match('/^Set-Cookie:\s*([^;]*)/mi', $headerLine, $cookie) == 1)
        $cookies[] = $cookie;
	
	var_dump(headerLine);
    return strlen($headerLine); // Needed by curl
}


$dated = date("Y-m-d");
echo $getVoucherCodeSql = "select vouchercode, StartDate, ExpiryDate, id from experian_vouchers_codes where VoucherUsedIndicator='N' and Assignedtoconsumer='N' and ('".$dated."' between StartDate and ExpiryDate) AND voucher_type='uat' order by id asc limit 0,1";
$getVoucherCodeQuery = d4l_ExecQuery($getVoucherCodeSql);
$voucherCode = d4l_mysql_result($getVoucherCodeQuery,0,'vouchercode');
$DataArrayVC = array("requestid"=>$insertID, "VoucherUsedIndicator"=>'Y' );
	$whereconditionVC ="(vouchercode='".$voucherCode."')";
	Mainupdatefunc ('experian_vouchers_codes', $DataArrayVC, $whereconditionVC);
echo "<br>";
//exit();
//$voucherCode='D4LNMoGmN'; // conditional mandatory
$landingPageSubmitUrl = "https://cbv2cpu.uat.experian.in:16443/ECV-P2/content/singleAction.action";//UAT
//$landingPageSubmitUrl = "https://consumer.experian.in:8443/ECV-P2/content/singleAction.action";
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
$firstName='DATTATRAYA'; //mandatory
$middleName=''; //
$surName='RAUT'; //mandatory
$dateOfBirth='25-Jun-1978'; //mandatory09-JUN-1978
$gender=1; //mandatory
//$mobileNo=9003170682; //conditional mandatory
$mobileNo=9953696361; //conditional mandatory
$telephoneNo=''; //
$telephoneType=''; //
$email='upendra@wishfin.com'; //mandatory
//$email='hanu.yedluri@instaemi.com'; //mandatory
$flatno='SWMARG02 MALAD'; //mandatory
$buildingName=''; //
$roadName=''; //
$city='Mumbai'; //mandatory
$state=27; //mandatory
$pincode=400106; //
$pan='BUQPT2352R'; //conditional mandatory
$passport=''; //conditional mandatory
$aadhaar=''; //
$voterid=''; //
$driverlicense=''; //
$rationcard=''; //
//$reason='Find out my credit score'; // mandatory
$reason='Test';
	
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
		//$param["middleName"] = $middleName; //
		$param["surName"] = $surName; //mandatory
		$param["dateOfBirth"] = $dateOfBirth; //mandatory
		$param["gender"] = $gender; //mandatory
		$param["mobileNo"] = $mobileNo; //conditional mandatory
		//$param["telephoneNo"] = $telephoneNo; //
		//$param["telephoneType"] = $telephoneType; //
		$param["email"] = $email; //mandatory
		$param["flatno"] = $flatno; //mandatory
		//$param["buildingName"] = $buildingName; //
		//$param["roadName"] = $roadName; //
		$param["city"] = $city; //mandatory
		$param["state"] = $state; //mandatory
		$param["pincode"] = $pincode; //
		$param["pan"] = $pan; //conditional mandatory
		//$param["passport"] = $passport; //conditional mandatory
		//$param["aadhaar"] = $aadhaar; //
		//$param["voterid"] = $voterid; //
		//$param["driverlicense"] = $driverlicense; //
		//$param["rationcard"] = $rationcard; //
		$param["reason"] = $reason; // mandatory

		
		$request = '';
		foreach($param as $key=>$val) { $request.= $key."=".urlencode($val); $request.= "&"; }
		$request = substr($request, 0, strlen($request)-1);
		echo $request;
	echo "<br>";
		$url = $landingPageSubmitUrl;
		$strCookie = "sessionId=".session_id()."; path=".session_save_path();
		session_write_close();
		// cURL's initialization
		$agent = $_SERVER['HTTP_USER_AGENT'];
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_USERAGENT, $agent);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HEADER, 1);
		curl_setopt($ch, CURLOPT_VERBOSE, 1);
		//curl_setopt($ch, CURLOPT_HEADERFUNCTION, "curlResponseHeaderCallback");
	/*	curl_setopt($ch, CURLOPT_HEADERFUNCTION,
  function($curl, $header) use (&$headers)
  {
    $len = strlen($header);
    $header = explode(':', $header, 2);
    if (count($header) < 2) // ignore invalid headers
      return $len;

    $name = strtolower(trim($header[0]));
    if (!array_key_exists($name, $headers))
      $headers[$name] = [trim($header[1])];
    else
      $headers[$name][] = trim($header[1]);

    return $len;
  }
);*/
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('application/x-www-form-urlencoded','Content-Length:'. strlen($request)));
		curl_setopt($ch, CURLOPT_TIMEOUT, 180);//Time in seconds
		curl_setopt ($ch, CURLOPT_AUTOREFERER, true);
		curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 2);
		curl_setopt($ch, CURLOPT_COOKIESESSION, true);
		curl_setopt($ch, CURLOPT_COOKIE, $strCookie);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
		//echo "<br>";echo "<br>";echo "<br>";
			//var_dump($cookies);
	//echo "<br>";echo "<br>";echo "<br>";
		$result = curl_exec($ch);
		
		echo "<br>";echo "<br>";echo "<br>";
		echo "<pre>";
		print_r($result);
		echo "<br>";echo "<br>";echo "<br>";
		echo "<br> Header Size - ";
		echo $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
		echo "<br> Header  - ";
		echo $header = substr($result, 0, $header_size);
		echo "<br> Body - ";
		echo $body = substr($result, $header_size);
		
		curl_close($ch);		
		die();
		
		preg_match_all('/^Set-Cookie:\s*([^;]*)/mi', $result, $matches);
		echo "<pre>";
		print_r($matches);
		$cookies = array();
		foreach($matches[1] as $item) 
		{
			parse_str($item, $cookie);
			$cookies = array_merge($cookies, $cookie);
		}
		echo "<br>";echo "<br>";echo "<br>";
		$returnValue[] = 'Success';
		$returnValue[] = $cookies['JSESSIONID'];
		$explode_result = explode('httponly', $result);
		$obj = json_decode($explode_result[1]);
		$errorString =  $obj->errorString;
		$stageOneId = $obj->stageOneId_;
		$stageTwoId= $obj->stageTwoId_;
		$showHtmlReportForCreditReport = $obj->showHtmlReportForCreditReport;
	print_r($result);
		
	/*
		if($errorString!='')
		{
			$checkPhrase = "Please try to invoke CRQ externally";
			if( strpos( $errorString, $checkPhrase) !== false )
			{
				$Stage2JSESSIONID_d4l=$cookies['JSESSIONID'];
				$_SESSION['Stage2JSESSIONID_d4l']=$Stage2JSESSIONID_d4l;
			//	list($Step7_Status, $questionset) = generateQuestionForConsumer($stageOneId , $stageTwoId, $NewJSESSIONID_d4l);
			}
			else
			{
				echo $errorString;
			}
		}
		else
		{
			$showHtmlReportForCreditReportArr = explode('<---------- END OF REPORT ---------->', $showHtmlReportForCreditReport);
			//	echo '<div class="pl-bank-leftinn inner-body-plbanks" style="padding:10px;">';
			//echo $showHtmlReportForCreditReportStr2 = trim($showHtmlReportForCreditReportArr[0]);
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
			$BureauScoreConfidLevel= $xml->SCORE->BureauScoreConfidLevel;
			echo "BureauScore - ".$BureauScore;
			echo "<br>";
			echo "BureauScoreConfidLevel - ".$BureauScoreConfidLevel;
			
			echo $pagename = $insertID."_".$counter."_".date("dmYhis");
			$newFileName = './experianxml/'.$pagename.".xml";
			//ExecQuery("INSERT INTO experian_xml_files (`requestid`, `filename`, `dated`, `counter`) VALUES ('".$insertID."', '".$pagename."', '".$nowdated."', '".$counter."')");
			file_put_contents($newFileName,$finalXmlResponse, FILE_APPEND);
		}
	*/
?>