<?php
require 'scripts/session_check.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';
require 'experianconnection.php';

$dated = date("Y-m-d");
$getVoucherCodeSql = "select vouchercode,StartDate,ExpiryDate, id from experian_vouchers_codes where VoucherUsedIndicator='N' and Assignedtoconsumer='N' and ('".$dated."' between StartDate and ExpiryDate) order by id asc limit 0,1";
$getVoucherCodeQuery = ExecQuery($getVoucherCodeSql);
$voucherCode = mysql_result($getVoucherCodeQuery,0,'vouchercode');
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

$experianConnection = new HttpConnection();
list($Step1_Status,$JSESSIONID_d4l) = $experianConnection->landingPageSubmit($clientName,$allowInput,$allowEdit,$allowCaptcha,$allowConsent,$allowConsent_additional, $allowEmailVerify, $allowVoucher, $voucherCode, $firstName, $middleName, $surName, $dateOfBirth, $gender,$mobileNo, $telephoneNo, $telephoneType, $email, $flatno, $buildingName, $road, $city, $state, $pincode, $pan, $passport, $aadhaar, $voterid, $driverlicense, $rationcard, $reason);

if($Step1_Status=='Success')
{
	list($Step2_Status,$hitId) = $experianConnection->openCustomerDetailsFormAction($clientName,$allowInput,$allowEdit,$allowCaptcha,$allowConsent,$allowConsent_additional, $allowEmailVerify, $allowVoucher, $voucherCode, $firstName, $middleName, $surName, $dateOfBirth, $gender,$mobileNo, $telephoneNo, $telephoneType, $email, $flatno, $buildingName, $road, $city, $state, $pincode, $pan, $passport, $aadhaar, $voterid, $driverlicense, $rationcard, $reason, $JSESSIONID_d4l);
	
	if($Step2_Status=='Success')
	{
		list($Step3_Status,$nullValue) = $experianConnection->fetchScreenMetaDataAction($clientName,$allowInput,$allowEdit,$allowCaptcha,$allowConsent,$allowConsent_additional, $allowEmailVerify, $allowVoucher, $voucherCode, $firstName, $middleName, $surName, $dateOfBirth, $gender,$mobileNo, $telephoneNo, $telephoneType, $email, $flatno, $buildingName, $road, $city, $state, $pincode, $pan, $passport, $aadhaar, $voterid, $driverlicense, $rationcard, $reason, $JSESSIONID_d4l,$hitId);
		if($Step3_Status=='Success')
		{	
			list($Step4_Status,$url) = $experianConnection->submitRequest($clientName,$allowInput,$allowEdit,$allowCaptcha,$allowConsent,$allowConsent_additional,$allowEmailVerify,$allowVoucher,$voucherCode, $firstName, $middleName,$surName,$dateOfBirth,$gender,$mobileNo,$telephoneNo,$telephoneType,$email,$flatno,$buildingName,$road,$city,$state,$pincode, $pan, $passport,$aadhaar,$voterid, $driverlicense,$rationcard,$reason,$JSESSIONID_d4l,$hitId);
			if($Step4_Status=='Success')
			{	
				list($Step5_Status,$Stage2Id) = $experianConnection->directCRQRequest($url, $JSESSIONID_d4l);
				if($Step5_Status=='Success')
				{	
					list($Step6_Status,$NewJSESSIONID_d4l) = $experianConnection->paymentSubmitRequest($voucherCode, $hitId, $Stage2Id, $JSESSIONID_d4l);
					if($Step6_Status=='Success')
					{	
						$stgOneHitId = $hitId;
						$stgTwoHitId = $Stage2Id;
						$experianConnection = new HttpConnection();
						list($Step7_Status, $questionset) = $experianConnection->generateQuestionForConsumer($stgOneHitId, $stgTwoHitId, $NewJSESSIONID_d4l);
						if($Step7_Status=='Success')
						{
							//Get Questions
							$obj = json_decode($questionset);
							print("<pre>");
							print_r($obj);
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
							//Exception Step 7
						}
						
					}
					else
					{
						//Exception Step 6
					}	
					
				}
				else
				{
					//Exception Step 5
				}			
			}
			else
			{
				//Exception Step 4
			}

		}
		else
		{
			//Exception Step 3
		}
	}	
	else
	{
		//Exception Step 2
	}
}
else
{
	//Exception Step 1
}
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
<input type="text" name="showHtmlReportForCreditReport" value="<?php echo $showHtmlReportForCreditReport; ?>"  />
<input type="text" name="responseJson" value="<?php echo $responseJson; ?>"  />
<table border="1" cellpadding="4" cellspacing="4" width="100%">
<tr><td><strong>Question</strong></td><td><?php echo $question; ?></td></tr>
<?php if(count($optionsSet1)>0) { ?>
<tr><td colspan="2"><strong>Answer Set 1</strong></td></tr>
<?php
for($i=0;$i<count($optionsSet1);$i++)
{
	?>
    <tr><td align="right"><input type="radio" name="optionsSet1" value="<?php echo $optionsSet1[$i]; ?>"  /></td><td><?php echo $optionsSet1[$i]; ?></td></tr>
<?php } ?>
<?php } ?>
<?php if(count($optionsSet2)>0) { ?>
<tr><td colspan="2"><strong>Answer Set 2 </strong></td></tr>
<?php
for($i=0;$i<count($optionsSet2);$i++)
{
	?>
    <tr><td align="right"><input type="radio" name="optionsSet2" value="<?php echo $optionsSet2[$i]; ?>"  /></td><td><?php echo $optionsSet2[$i]; ?></td></tr>
<?php } ?>
<?php } ?>
<tr><td>&nbsp;</td><td ><input type="submit" name="submit" value="Submit"  /></td></tr>

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
<div></div>
</div>

<?php include("footer_sub_menu.php"); ?>
</body>
</html>