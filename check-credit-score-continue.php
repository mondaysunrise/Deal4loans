<?php
ini_set('max_execution_time', 1000);

session_start();

require 'scripts/session_check.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';
require 'experianconnection.php';
//print_r($_POST);
$dated = date("Y-m-d");
$nowdated = ExactServerdate();
echo "<br>";
echo $getVoucherCodeSql = "select vouchercode, StartDate, ExpiryDate, id from experian_vouchers_codes where VoucherUsedIndicator='N' and Assignedtoconsumer='N' and ('".$dated."' between StartDate and ExpiryDate) order by id asc limit 0,1";
$getVoucherCodeQuery = ExecQuery($getVoucherCodeSql);
echo "<br>";
echo $voucherCode = mysql_result($getVoucherCodeQuery,0,'vouchercode');
$clientName = "DEAL_4_LOANS";
$allowInput = 1;
$allowEdit = 1;
$allowCaptcha = 1;
$allowConsent = 1;
$allowConsent_additional = 1;
$allowEmailVerify = 1;
$allowVoucher = 1;
$voucherCode = $voucherCode;
$firstName = $_POST['firstName'];
$middleName = $_POST['middleName'];
$surName = $_POST['surName'];
$day = $_POST['day'];
$month = $_POST['month'];
$year = $_POST['year'];
$dob = $year."-".$month."-".$day;
$monthName = date('M', mktime(0, 0, 0, $month, 10));

$dateOfBirth = $day."-".$monthName."-".$year;
$gender = $_POST['gender'];
$mobileNo = $_POST['mobileNo'];
$telephoneNo = $_POST['telephoneNo'];
$telephoneType = $_POST['telephoneType'];
$email = $_POST['email'];
$flatno = $_POST['flatno'];
$buildingName = $_POST['buildingName'];
$road = $_POST['road'];
$city = $_POST['city'];
$state = $_POST['state'];
$pincode = $_POST['pincode'];
$pan = $_POST['pan'];
$passport = $_POST['passport'];
$aadhaar = $_POST['aadhaar'];
$voterid = $_POST['voterid'];
$driverlicense = $_POST['driverlicense'];
$rationcard = $_POST['rationcard'];
$reason = $_POST['reason'];

$getdetails="select id, counter From experian_initial_details Where ( pan ='".$pan."')";
//echo "<br>".$getdetails."<br>";
list($alreadyExist,$myrow)=MainselectfuncNew($getdetails,$array = array());
$myrowcontr=count($myrow)-1;
	if($alreadyExist>0)
	{
		
		$insertID = $myrow[$myrowcontr]["id"];
//		echo "<br>insertID - ".$insertID."<br>";
		$counter = $myrow[$myrowcontr]["counter"];
		$counter = $counter +1;
		$DataArray = array("counter"=>$counter, 'vouchercode'=>Fixstring($voucherCode));
		$wherecondition =" (id=".$insertID.")";
		Mainupdatefunc ('experian_initial_details', $DataArray, $wherecondition);
	}
	else
	{
		//$sql = "INSERT INTO experian_initial_details (firstName, middleName, surName, dob, gender, mobileNo, telephoneNo, telephoneType, email, flatno, buildingName, road, city, state, pincode, pan, passport, aadhaar, voterid, driverlicense, rationcard, dated, vouchercode) VALUES ('".$firstName."', '".$middleName."', '".$surName."', '".$dob."', '".$gender."', '".$mobileNo."', '".$telephoneNo."', '".$telephoneType."', '".$email."', '".$flatno."', '".$buildingName."', '".$road."', '".$city."', '".$state."', '".$pincode."', '".$pan."', '".$passport."', '".$aadhaar."', '".$voterid."', '".$driverlicense."', '".$rationcard."', '".$dated."', '".$vouchercode."')";
		//$query = ExecQuery($sql);
		//$insertID = mysql_insert_id();

		$dataInsert = array('firstName'=> Fixstring($firstName), 'middleName'=> Fixstring($middleName), 'surName'=>Fixstring($surName), 'dob'=>Fixstring($dob), 'gender'=> Fixstring($gender), 'mobileNo'=> Fixstring($mobileNo), 'telephoneNo'=>Fixstring($telephoneNo), 'telephoneType'=>Fixstring($telephoneType), 'email'=> Fixstring($email), 'flatno'=> Fixstring($flatno), 'buildingName'=>Fixstring($buildingName), 'road'=>Fixstring($road), 'city'=> Fixstring($city), 'state'=>Fixstring($state), 'pincode'=>Fixstring($pincode), 'pan'=> Fixstring($pan), 'passport'=>Fixstring($passport), 'aadhaar'=>Fixstring($aadhaar), 'voterid'=> Fixstring($voterid), 'driverlicense'=>Fixstring($driverlicense), 'rationcard'=>Fixstring($rationcard), 'dated'=>Fixstring($nowdated), 'vouchercode'=>Fixstring($voucherCode), 'counter'=>'1' );
		//print("<pre>");
	//	print_r($dataInsert);
		//print("</pre>");
		$insertID = Maininsertfunc ('experian_initial_details', $dataInsert);
	}

$experianConnection = new HttpConnection();
list($Step1_Status,$JSESSIONID_d4l) = $experianConnection->landingPageSubmit($clientName,$allowInput,$allowEdit,$allowCaptcha,$allowConsent,$allowConsent_additional, $allowEmailVerify, $allowVoucher, $voucherCode, $firstName, $middleName, $surName, $dateOfBirth, $gender,$mobileNo, $telephoneNo, $telephoneType, $email, $flatno, $buildingName, $road, $city, $state, $pincode, $pan, $passport, $aadhaar, $voterid, $driverlicense, $rationcard, $reason);

$Log = 'Input Step 1 - clientName- '.$clientName.', allowInput - '.$allowInput.', allowEdit- '.$allowEdit.', allowCaptcha- '.$allowCaptcha.', allowConsent- '.$allowConsent.', allowConsent_additional- '.$allowConsent_additional.', allowEmailVerify- '. $allowEmailVerify.', allowVoucher- '. $allowVoucher.', voucherCode- '. $voucherCode.', firstName- '. $firstName.', middleName- '. $middleName.', surName- '. $surName.', dateOfBirth- '. $dateOfBirth.', gender- '. $gender.', mobileNo- '.$mobileNo.', telephoneNo- '. $telephoneNo.', telephoneType- '. $telephoneType.', email- '. $email.', flatno- '. $flatno.', buildingName- '. $buildingName.', road- '. $road.', city- '. $city.', state- '. $state.', pincode- '. $pincode.', pan- '. $pan.', passport- '. $passport.', aadhaar- '. $aadhaar.', voterid- '. $voterid.', driverlicense- '. $driverlicense.', rationcard- '. $rationcard.', reason- '. $reason.' <br>';
$Log .= 'Output Step 1 - '.$JSESSIONID_d4l.'<br>';
echo $Log;
exit();
if($Step1_Status=='Success')
{
	$insertSql = array('step'=> 'Step 1', 'status'=> $Step1_Status, 'message'=> $JSESSIONID_d4l, 'requestid'=>$insertID, 'Dated'=>$nowdated);
	Maininsertfunc ('experian_log', $insertSql);
	
	$DataArrayVC = array("requestid"=>$insertID, "VoucherUsedIndicator"=>'Y' );
	$whereconditionVC ="(vouchercode='".$voucherCode."')";
	Mainupdatefunc ('experian_vouchers_codes', $DataArrayVC, $whereconditionVC);
	
	
	list($Step2_Status,$hitId) = $experianConnection->openCustomerDetailsFormAction($clientName,$allowInput,$allowEdit,$allowCaptcha,$allowConsent,$allowConsent_additional, $allowEmailVerify, $allowVoucher, $voucherCode, $firstName, $middleName, $surName, $dateOfBirth, $gender,$mobileNo, $telephoneNo, $telephoneType, $email, $flatno, $buildingName, $road, $city, $state, $pincode, $pan, $passport, $aadhaar, $voterid, $driverlicense, $rationcard, $reason, $JSESSIONID_d4l);
	
	$Log .= 'Input Step 2 - clientName- '.$clientName.', allowInput - '.$allowInput.', allowEdit- '.$allowEdit.', allowCaptcha- '.$allowCaptcha.', allowConsent- '.$allowConsent.', allowConsent_additional- '.$allowConsent_additional.', allowEmailVerify- '. $allowEmailVerify.', allowVoucher- '. $allowVoucher.', voucherCode- '. $voucherCode.', firstName- '. $firstName.', middleName- '. $middleName.', surName- '. $surName.', dateOfBirth- '. $dateOfBirth.', gender- '. $gender.', mobileNo- '.$mobileNo.', telephoneNo- '. $telephoneNo.', telephoneType- '. $telephoneType.', email- '. $email.', flatno- '. $flatno.', buildingName- '. $buildingName.', road- '. $road.', city- '. $city.', state- '. $state.', pincode- '. $pincode.', pan- '. $pan.', passport- '. $passport.', aadhaar- '. $aadhaar.', voterid- '. $voterid.', driverlicense- '. $driverlicense.', rationcard- '. $rationcard.', reason- '. $reason.', JSESSIONID_d4l- '. $JSESSIONID_d4l.' <br>';
$Log .= 'Output Step 2 - '.$JSESSIONID_d4l.'<br>';
	
	if($Step2_Status=='Success')
	{
		$insertSql = array('step'=> 'Step 2', 'status'=> Fixstring($Step2_Status), 'message'=> Fixstring($hitId), 'requestid'=>Fixstring($insertID), 'Dated'=>$nowdated);
		Maininsertfunc ('experian_log', $insertSql);

		$DataArrayVCState1 = array("Stage1HitId"=>$hitId, "Assignedtoconsumer"=>'Y' );
		$whereconditionVC ="(vouchercode='".$voucherCode."')";
		Mainupdatefunc ('experian_vouchers_codes', $DataArrayVCState1, $whereconditionVC);
		
		list($Step3_Status,$nullValue) = $experianConnection->fetchScreenMetaDataAction($clientName,$allowInput,$allowEdit,$allowCaptcha,$allowConsent,$allowConsent_additional, $allowEmailVerify, $allowVoucher, $voucherCode, $firstName, $middleName, $surName, $dateOfBirth, $gender,$mobileNo, $telephoneNo, $telephoneType, $email, $flatno, $buildingName, $road, $city, $state, $pincode, $pan, $passport, $aadhaar, $voterid, $driverlicense, $rationcard, $reason, $JSESSIONID_d4l,$hitId);
	//	print_r($nullValue);
		$Log .= 'Input Step 3 - clientName- '.$clientName.', allowInput - '.$allowInput.', allowEdit- '.$allowEdit.', allowCaptcha- '.$allowCaptcha.', allowConsent- '.$allowConsent.', allowConsent_additional- '.$allowConsent_additional.', allowEmailVerify- '. $allowEmailVerify.', allowVoucher- '. $allowVoucher.', voucherCode- '. $voucherCode.', firstName- '. $firstName.', middleName- '. $middleName.', surName- '. $surName.', dateOfBirth- '. $dateOfBirth.', gender- '. $gender.', mobileNo- '.$mobileNo.', telephoneNo- '. $telephoneNo.', telephoneType- '. $telephoneType.', email- '. $email.', flatno- '. $flatno.', buildingName- '. $buildingName.', road- '. $road.', city- '. $city.', state- '. $state.', pincode- '. $pincode.', pan- '. $pan.', passport- '. $passport.', aadhaar- '. $aadhaar.', voterid- '. $voterid.', driverlicense- '. $driverlicense.', rationcard- '. $rationcard.', reason- '. $reason.', JSESSIONID_d4l- '. $JSESSIONID_d4l.', hitId- '. $hitId.' <br>';
$Log .= 'Output Step 3 - Null Value<br>';
		
		
		if($Step3_Status=='Success')
		{	
			$insertSql = array('step'=> 'Step 3', 'status'=> Fixstring($Step3_Status), 'message'=> Fixstring($nullValue), 'requestid'=>Fixstring($insertID), 'Dated'=>$nowdated);
			Maininsertfunc ('experian_log', $insertSql);
			list($Step4_Status,$url) = $experianConnection->submitRequest($clientName,$allowInput,$allowEdit,$allowCaptcha,$allowConsent,$allowConsent_additional,$allowEmailVerify,$allowVoucher,$voucherCode, $firstName, $middleName,$surName,$dateOfBirth,$gender,$mobileNo,$telephoneNo,$telephoneType,$email,$flatno,$buildingName,$road,$city,$state,$pincode, $pan, $passport,$aadhaar,$voterid, $driverlicense,$rationcard,$reason,$JSESSIONID_d4l,$hitId);
	$Log .= 'Input Step 4 - clientName- '.$clientName.', allowInput - '.$allowInput.', allowEdit- '.$allowEdit.', allowCaptcha- '.$allowCaptcha.', allowConsent- '.$allowConsent.', allowConsent_additional- '.$allowConsent_additional.', allowEmailVerify- '. $allowEmailVerify.', allowVoucher- '. $allowVoucher.', voucherCode- '. $voucherCode.', firstName- '. $firstName.', middleName- '. $middleName.', surName- '. $surName.', dateOfBirth- '. $dateOfBirth.', gender- '. $gender.', mobileNo- '.$mobileNo.', telephoneNo- '. $telephoneNo.', telephoneType- '. $telephoneType.', email- '. $email.', flatno- '. $flatno.', buildingName- '. $buildingName.', road- '. $road.', city- '. $city.', state- '. $state.', pincode- '. $pincode.', pan- '. $pan.', passport- '. $passport.', aadhaar- '. $aadhaar.', voterid- '. $voterid.', driverlicense- '. $driverlicense.', rationcard- '. $rationcard.', reason- '. $reason.', JSESSIONID_d4l- '. $JSESSIONID_d4l.', hitId- '. $hitId.' <br>';
$Log .= 'Output Step 4 - '.$url.'<br>';		
			
			if($Step4_Status=='Success')
			{	
				$insertSql = array('step'=> 'Step 4', 'status'=> Fixstring($Step4_Status), 'message'=> Fixstring($url), 'requestid'=>Fixstring($insertID), 'Dated'=>$nowdated);
				Maininsertfunc ('experian_log', $insertSql);
				list($Step5_Status,$Stage2Id) = $experianConnection->directCRQRequest($url, $JSESSIONID_d4l);
				
				$Log .= 'Input Step 5 - url- '.$url.', JSESSIONID_d4l - '.$JSESSIONID_d4l.' <br>';
$Log .= 'Output Step 5 - '.$Stage2Id.'<br>';	
				
				if($Step5_Status=='Success')
				{	
					$insertSql = array('step'=> 'Step 5', 'status'=> Fixstring($Step5_Status), 'message'=> Fixstring($Stage2Id), 'requestid'=>Fixstring($insertID), 'Dated'=>$nowdated);
					Maininsertfunc ('experian_log', $insertSql);
					
					$DataArrayVCStage2 = array("Stage2HitId"=>$Stage2Id);
					$whereconditionVC ="(vouchercode='".$voucherCode."')";
					Mainupdatefunc ('experian_vouchers_codes', $DataArrayVCStage2, $whereconditionVC);
					
					
					list($Step6_Status,$NewJSESSIONID_d4l) = $experianConnection->paymentSubmitRequest($voucherCode, $hitId, $Stage2Id, $JSESSIONID_d4l);
						$Log .= 'Input Step 6 - voucherCode- '.$voucherCode.', hitId- '.$hitId.', Stage2Id- '.$Stage2Id.', JSESSIONID_d4l - '.$JSESSIONID_d4l.' <br>';
$Log .= 'Output Step 6 - '.$NewJSESSIONID_d4l.'<br>';	
					
					if($Step6_Status=='Success')
					{	
						$insertSql = array('step'=> 'Step 6', 'status'=> Fixstring($Step6_Status), 'message'=> Fixstring($NewJSESSIONID_d4l), 'requestid'=>Fixstring($insertID), 'Dated'=>$nowdated);
						Maininsertfunc ('experian_log', $insertSql);
						$stgOneHitId = $hitId;
						$stgTwoHitId = $Stage2Id;
						$experianConnection = new HttpConnection();
					//	echo $stgOneHitId." -- ".$stgTwoHitId." -- ".$NewJSESSIONID_d4l."<br>"; exit();
						list($Step7_Status, $questionset) = $experianConnection->generateQuestionForConsumer($stgOneHitId, $stgTwoHitId, $NewJSESSIONID_d4l);
							$Log .= 'Input Step 7 - stgOneHitId- '.$stgOneHitId.', stgTwoHitId- '.$stgTwoHitId.', NewJSESSIONID_d4l - '.$NewJSESSIONID_d4l.' <br>';
$Log .= 'Output Step 7 - '.$questionset.'<br>';
						
						//$a = $experianConnection->generateQuestionForConsumer($stgOneHitId, $stgTwoHitId, $NewJSESSIONID_d4l);
						//echo "<pre>";
//						print_r($a);
						if($Step7_Status=='Success')
						{
							$insertSql = array('step'=> 'Step 7', 'status'=> Fixstring($Step7_Status), 'message'=> 'Questions', 'requestid'=>Fixstring($insertID), 'Dated'=>$nowdated);
							Maininsertfunc ('experian_log', $insertSql);
							//Get Questions
							$obj = json_decode($questionset);
						//	print("<pre>");
							//print_r($obj);
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
						}
						else
						{
							$insertSql = array('step'=> 'Step 7', 'status'=> Fixstring($Step7_Status), 'message'=> Fixstring($questionset), 'requestid'=>Fixstring($insertID), 'Dated'=>$nowdated);
							Maininsertfunc ('experian_log', $insertSql);
							$msg = "Error In Submitting";
							$_SESSION['msg'] = $msg;
						//	header("Location: check-credit-score.php?msg=".$msg);
						//echo $Log;
					//		exit();
							//Exception Step 7
						}
					}
					else
					{
						$insertSql = array('step'=> 'Step 6', 'status'=> Fixstring($Step6_Status), 'message'=> Fixstring($NewJSESSIONID_d4l), 'requestid'=>Fixstring($insertID), 'Dated'=>$nowdated);
						Maininsertfunc ('experian_log', $insertSql);
						$msg = "Error In Submitting";
						$_SESSION['msg'] = $msg;
						header("Location: check-credit-score.php?msg=Error In Submitting");
						exit();
						//Exception Step 6
					}	
				}
				else
				{
					$insertSql = array('step'=> 'Step 5', 'status'=> Fixstring($Step5_Status), 'message'=> Fixstring($Stage2Id), 'requestid'=>Fixstring($insertID), 'Dated'=>$nowdated);
					Maininsertfunc ('experian_log', $insertSql);
					$msg = "Error In Submitting";
					$_SESSION['msg'] = $msg;
					header("Location: check-credit-score.php?msg=Error In Submitting");
					exit();
					//Exception Step 5
				}			
			}
			else
			{
				$insertSql = array('step'=> 'Step 4', 'status'=> Fixstring($Step4_Status), 'message'=> Fixstring($url), 'requestid'=>Fixstring($insertID), 'Dated'=>$nowdated);
				Maininsertfunc ('experian_log', $insertSql);
				$msg = "Error In Submitting";
				$_SESSION['msg'] = $msg;
				header("Location: check-credit-score.php?msg=Error In Submitting");
				exit();
				//Exception Step 4
			}
		}
		else
		{
			$insertSql = array('step'=> 'Step 3', 'status'=> Fixstring($Step3_Status), 'message'=> Fixstring($nullValue), 'requestid'=>Fixstring($insertID), 'Dated'=>$nowdated);
			Maininsertfunc ('experian_log', $insertSql);
							$msg = "Error In Submitting";
							$_SESSION['msg'] = $msg;
							header("Location: check-credit-score.php?msg=Error In Submitting");

			exit();
			//Exception Step 3
		}
	}	
	else
	{
		$insertSql = array('step'=> 'Step 2', 'status'=> Fixstring($Step2_Status), 'message'=> Fixstring($hitId), 'requestid'=>Fixstring($insertID), 'Dated'=>$nowdated);
		Maininsertfunc ('experian_log', $insertSql);
									$msg = "Error In Submitting";
							$_SESSION['msg'] = $msg;
							header("Location: check-credit-score.php?msg=Error In Submitting");

		exit();
		//Exception Step 2
	}
}
else
{
	$insertSql = array('step'=> 'Step 1', 'status'=> Fixstring($Step1_Status), 'message'=> Fixstring($JSESSIONID_d4l), 'requestid'=>Fixstring($insertID), 'Dated'=>$nowdated);
	Maininsertfunc ('experian_log', $insertSql);
	$msg = "Error In Submitting";
	$_SESSION['msg'] = $msg;
	header("Location: check-credit-score.php?msg=Error In Submitting");
	exit();
	//Exception Step 1
}
echo "<br>###################################<br>";
echo $Log;
echo "<br>###################################<br>";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="css/apply-personal-loans-lp-styles-new2-11-2015.css" type="text/css" rel="stylesheet" />
<link rel="stylesheet" href="css/pl_apply-tab_styles-new11-2-2015.css">
<link href="css/personal-loans-new-lp-11-2-2015.css" type="text/css" rel="stylesheet" />
<title>Check Credit Score</title>
<meta name="keywords" content="Check Credit Score">
<meta name="description" content="Check Credit Score">
<link href="css/personal-loan-styles.css" type="text/css" rel="stylesheet"  />
</head>
<body>
<?php include "middle-menu.php"; ?>
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
		?>
<form action="check-credit-score-questions.php" name="questionaire" method="post">
<input type="hidden" name="NewJSESSIONID_d4l" value="<?php echo $NewJSESSIONID_d4l; ?>"  />
<input type="hidden" name="qid" value="<?php echo $qid; ?>"  />
<input type="hidden" name="stgOneHitId" value="<?php echo $stgOneHitId; ?>" />
<input type="hidden" name="stgTwoHitId" value="<?php echo $stgTwoHitId; ?>"  />
<input type="hidden" name="showHtmlReportForCreditReport" value="<?php echo $showHtmlReportForCreditReport; ?>"  />
<input type="hidden" name="responseJson" value="<?php echo $responseJson; ?>"  />
<input type="hidden" name="insertID" value="<?php echo $insertID; ?>"  />

<table border="0" cellpadding="4" cellspacing="4" width="100%">
<tbody><tr><td valign="top"><strong>Question</strong></td><td><?php echo $question; ?></td></tr>
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
<?php include("footer_sub_menu.php"); ?>
</body>
</html>