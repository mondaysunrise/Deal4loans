<?php
session_start();
require 'scripts/db_init.php';
$dated = date("Y-m-d");
$getVoucherCodeSql = "select vouchercode, StartDate, ExpiryDate, id from experian_vouchers_codes where VoucherUsedIndicator='N' and Assignedtoconsumer='N' and ('".$dated."' between StartDate and ExpiryDate) order by id asc limit 0,1";
$getVoucherCodeQuery = d4l_ExecQuery($getVoucherCodeSql);
$voucherCode = d4l_mysql_result($getVoucherCodeQuery,0,'vouchercode');
$DataArrayVC = array("requestid"=>$insertID, "VoucherUsedIndicator"=>'Y' );
	$whereconditionVC ="(vouchercode='".$voucherCode."')";
	Mainupdatefunc ('experian_vouchers_codes', $DataArrayVC, $whereconditionVC);
//exit();
//$voucherCode='D4LNMoGmN'; // conditional mandatory
$landingPageSubmitUrl = "https://cbv2cpu.uat.experian.in:16443/ECV-P2/content/singleAction.action";
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
	
		$url = $landingPageSubmitUrl;
	//	echo "<br>";echo "<br>";echo "<br>";echo $request; echo "<br>";echo "<br>";
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
		curl_close($ch);		
		
		preg_match_all('/^Set-Cookie:\s*([^;]*)/mi', $result, $matches);
			$cookies = array();
			foreach($matches[1] as $item) 
			{
				parse_str($item, $cookie);
				$cookies = array_merge($cookies, $cookie);
			}
			$returnValue[] = 'Success';
			$returnValue[] = $cookies['JSESSIONID'];
			//print_r($returnValue);
				$explode_result = explode('httponly', $result);
			//echo "<pre>";
			//	print_r($explode);
			
			$obj = json_decode($explode_result[1]);
			//echo "<br>";
		//	echo "<pre>";
		//		print_r($obj);
				
				$errorString =  $obj->errorString;
				$stageOneId = $obj->stageOneId_;
				$stageTwoId= $obj->stageTwoId_;
				$showHtmlReportForCreditReport = $obj->showHtmlReportForCreditReport;
				
				if($errorString!='')
				{
					$checkPhrase = "Please try to invoke CRQ externally";
					if( strpos( $errorString, $checkPhrase) !== false )
					{
						//[stageOneId_] => 1047740
					    //[stageTwoId_] => 1036778
//						stg1HitId_ ,  stgTwoHitId, answer, questionId 	
						$Stage2JSESSIONID_d4l=$cookies['JSESSIONID'];
						$_SESSION['Stage2JSESSIONID_d4l']=$Stage2JSESSIONID_d4l;
					//	generateQuestionForConsumer($stageOneId , $stageTwoId, $Stage2JSESSIONID_d4l, $qid = '', $answer = '');
						list($Step7_Status, $questionset) = generateQuestionForConsumer($stageOneId , $stageTwoId, $NewJSESSIONID_d4l);
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
	
					//	echo "<pre>";
					//	print_r($xml);
					
					$BureauScore = $xml->SCORE->BureauScore;
					$BureauScoreConfidLevel= $xml->SCORE->BureauScoreConfidLevel;
					echo "BureauScore - ".$BureauScore;
					echo "<br>";
					echo "BureauScoreConfidLevel - ".$BureauScoreConfidLevel;
					$insertID = 11;
					$counter = 1;
					echo "<br>";
					echo $pagename = $insertID."_".$counter."_".date("dmYhis");
					$newFileName = './experianxml/'.$pagename.".xml";
					//ExecQuery("INSERT INTO experian_xml_files (`requestid`, `filename`, `dated`, `counter`) VALUES ('".$insertID."', '".$pagename."', '".$nowdated."', '".$counter."')");
					file_put_contents($newFileName,$finalXmlResponse, FILE_APPEND);
				}


function generateQuestionForConsumer($Stage1Id, $Stage2Id, $Stage2JSESSIONID_d4l, $qid = '', $answer = '')
	{
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
				
		$url = 'https://cbv2cpu.uat.experian.in:16443/ECV-P2/content/generateQuestionForConsumer.action';
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
		//echo "<br>############generateQuestionForConsumer[487]####################<br>";
		//print("<pre>");
		//print_r($result);
		//
	//	echo "<br>############generateQuestionForConsumer[487]####################<br>";
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
			$returnValue[] = 'Success';
			$returnValue[] = $result;
		}
		else if($responseJson=="passedReport")
		{
			$returnValue[] = 'passedReport';
			$returnValue[] = $result;			
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
	


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<link href="css/apply-personal-loans-lp-styles-new2-11-2015.css" type="text/css" rel="stylesheet" />
<link rel="stylesheet" href="css/pl_apply-tab_styles-new11-2-2015.css" />
<link href="css/personal-loans-new-lp-11-2-2015.css" type="text/css" rel="stylesheet" />
<title>Check Credit Score</title>
<meta name="keywords" content="Check Credit Score" />
<meta name="description" content="Check Credit Score" />
<link href="css/personal-loan-styles.css" type="text/css" rel="stylesheet"  />
</head>
<body>
<?php //include "middle-menu.php"; ?>
<div class="d4l_inner_wrapper">
<div style="margin-top:70px;"></div>
<div  class="common-bread-crumb"><a href="index.php">Home</a> > Credit Score </div>
<div style="margin:auto;">
  <div class="left-wrapper">
    <div>
      <h1 class="pl-h1">Credit Score</h1>
    
      <div style="clear:both;"></div>
      <div><img src="/new-images/experian_logo.png"  /> </div>
      <div style="clear:both; height:15px;"></div>
      <!--class="lfttxtbar" -->
      <div id="txt">
        <div class="pl-bank-leftinn inner-body-plbanks" style="padding:10px;">
        <?php 
		if($Step7_Status=='Success')
		{
		
			$obj = json_decode($questionset);
		//	print("<pre>");
			//print_r($obj);
		//	{"questionToCustomer":{"bureauEmails":null,"secondXMLResponse":null,"crqPassed":null,"f1Dt":null,"f2Dt":null,"question":"Who is your Housing Loan with? What is the loan amount sanctioned to you for this Housing Loan?","qid":1,"toolTip":null,"optionsSet1":["PUNJAB AND MAHARASHTRA COOPERATIVE BANK LIMITED","MONEYLINECREDIT","THE RATNAKAR BANK LIMITED","SHREE COOPERATIVE BANK LIMITED","KASHIPUR URBAN COOPERATIVE BANK LTD"],"optionsSet2":["1000000","980000","1040000","1010000","1050000"],"type":"combo-radioButton"},"answer":null,"questionId":null,"responseJson":"next","questionType":null,"ipAddress":null,"stgOneHitId":1047746,"stgTwoHitId":1036784,"merchantRefNo":null,"showHtmlReportForCreditReport":null}

			
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

		?>
<form action="cibil-check-thanks-questions.php" name="questionaire" method="post">
<input type="text" name="NewJSESSIONID_d4l" value="<?php echo $NewJSESSIONID_d4l; ?>"  />
<input type="hidden" name="qid" value="<?php echo $qid; ?>"  />
<input type="hidden" name="stgOneHitId" value="<?php echo $stgOneHitId; ?>" />
<input type="hidden" name="stgTwoHitId" value="<?php echo $stgTwoHitId; ?>"  />
<input type="hidden" name="showHtmlReportForCreditReport" value="<?php echo $showHtmlReportForCreditReport; ?>"  />
<input type="hidden" name="responseJson" value="<?php echo $responseJson; ?>"  />
<input type="hidden" name="insertID" value="<?php echo $insertID; ?>"  />

<table border="0" cellpadding="4" cellspacing="4" width="100%">
<tr><td valign="top"><strong>Question</strong></td><td><?php echo $question; ?></td></tr>
 <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
<?php if(count($optionsSet1)>0) { ?>
 <tr><td colspan="2"><strong>Answer Set 1</strong></td></tr>
<?php
for($i=0;$i<count($optionsSet1);$i++)
{
	?>
    <tr><td align="right"><input type="radio" name="optionsSet1" value="<?php echo $optionsSet1[$i]; ?>"  /></td><td><?php echo $optionsSet1[$i]; ?></td></tr>
<?php } ?>
<?php } ?>
<tr>
      <td colspan="2" height="25"><hr /></td>
    </tr>
<?php if(count($optionsSet2)>0) { ?>
<tr><td colspan="2"><strong>Answer Set 2 </strong></td></tr>
<?php
for($i=0;$i<count($optionsSet2);$i++)
{
	?>
    <tr><td align="right"><input type="radio" name="optionsSet2" value="<?php echo $optionsSet2[$i]; ?>"  /></td><td><?php echo $optionsSet2[$i]; ?></td></tr>
<?php } ?>
<?php } ?>
 <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
<tr><td>&nbsp;</td><td ><input type="submit" name="submit" value="Submit" style="background:#09C; color:#FFF; border:none; width:100px; height:35px; margin-left:55px; border-radius:5px;"  /></td></tr>

</table>
</form>
<?php 
		}
		else
		{
			echo "error in an Stage";	
		}
		?>

        </div>
      </div>
     
    </div>
  </div>
  <div class="right-panel">
    <?php //include "right-widget.php"; ?>
  </div>
</div>

</div>
<div style="clear:both; padding:6px;"></div>
<?php //include("footer_sub_menu.php"); ?>
</body>
</html>