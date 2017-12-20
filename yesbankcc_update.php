<?php
ob_start();
session_start();
require 'scripts/session_check.php';
require 'scripts/db_init.php';
require 'scripts/functionshttps.php';
require 'cibil_experian_functions.php';

$dated = date("Y-m-d");
$nowdated = ExactServerdate();
//print_r($_POST);
//echo "Get";
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$insertID = $_POST['insertID'];
	$email_code= $_POST['email_code'];
	$mobile_code= $_POST['mobile_code'];
	$servertype= $_POST['servertype'];
	$voucher_type=	$servertype;
	$getdetails="select * From experian_initial_details Where ( id='".$insertID."')";
//	echo "<br>".$getdetails."<br>";
	list($alreadyExist,$myrow)=MainselectfuncNew($getdetails,$array = array());
	$myrowcontr=count($myrow)-1;
	$mobile_code_db = $myrow[$myrowcontr]["mobile_code"];
	$email_code_db = $myrow[$myrowcontr]["email_code"];
	
//	echo $email_code_db.", ".$mobile_code_db;
//	echo "<br>";
	$email_verify = 0;
	$mobile_verify = 0;
	if($email_code_db==$email_code)
	{
		$email_verify = 1;
	}
	if($mobile_code_db==$mobile_code)
	{
		$mobile_verify =1;
	}
//	$email_verify = 1;

	$DataArray = array('mobile_verified'=>$verify, 'email_verified'=>$verify);
//	print_r($DataArray);	
	if($mobile_verify==1 && $email_verify==1)
	{
		$verify=1;
		$DataArray = array('mobile_verified'=>$verify, 'email_verified'=>$verify);
		//print_r($DataArray);	
		$wherecondition =" (id=".$insertID.")";
		Mainupdatefunc ('experian_initial_details', $DataArray, $wherecondition);
		//header("Location: cibil-check-second-step.php?id=".$insertID);
		//exit();
	}
	else
	{
		header("Location: yesbankcc_form.php?msg=Verification Failed");
		exit();		
	}

	if($alreadyExist>0)
	{
		$firstName= $myrow[$myrowcontr]["firstName"];
		$middleName= $myrow[$myrowcontr]["middleName"];
		$surName= $myrow[$myrowcontr]["surName"];
		$mobileNo= $myrow[$myrowcontr]["mobileNo"];
		$email= $myrow[$myrowcontr]["email"];
		$dob= $myrow[$myrowcontr]["dob"];
		list($year,$month,$day) = explode("-",$dob);
		$monthName = date('M', mktime(0, 0, 0, $month, 10));
		$dateOfBirth = $day."-".$monthName."-".$year;
		
		$gender= $myrow[$myrowcontr]["gender"];
		$flatno= $myrow[$myrowcontr]["flatno"];
		$buildingName= $myrow[$myrowcontr]["buildingName"];
		$road= $myrow[$myrowcontr]["road"];
		$city= $myrow[$myrowcontr]["city"];
		$state= $myrow[$myrowcontr]["state"];
		$state=str_pad($state, 2, '0', STR_PAD_LEFT); 
		$pincode= $myrow[$myrowcontr]["pincode"];
		$pan= $myrow[$myrowcontr]["pan"];
		$reason = 'Find out my credit score';
		echo $insertID.", ". $voucher_type;
//	echo $voucherCode.", ".$firstName.", ".$middleName.", ".$surName.", ".$dateOfBirth.", ".$gender.", ".$mobileNo.", ".$telephoneNo.", ".$telephoneType.", ".$email.", ".$flatno.", ".$buildingName.", ".$roadName.", ".$city.", ".$state.", ".$pincode.", ".$pan.", ".$passport.", ".$aadhaar.", ".$voterid.", ".$driverlicense.", ".$rationcard.", ".$reason.", ".$insertID.", ".$counter;
	$cibilExperian= new cibilExperian();
	$voucherCode = $cibilExperian->getVoucherCode($insertID, $voucher_type);
	list($Step_Status,$output) = $cibilExperian->landingPageSubmit($voucherCode, $firstName, $middleName, $surName, $dateOfBirth, $gender, $mobileNo, $telephoneNo, $telephoneType, $email, $flatno, $buildingName, $road, $city, $state, $pincode,$pan, $passport, $aadhaar, $voterid, $driverlicense, $rationcard, $reason, $insertID, $counter,$servertype);
	
	//echo "<br>";
	//$obj = json_decode($output);			print("<pre>");			print_r($obj);			print("</pre>");
			
//echo "<br>";
			$Log = 'Input Step 1 - voucherCode- '. $voucherCode.', firstName- '. $firstName.', middleName- '. $middleName.', surName- '. $surName.', dateOfBirth- '. $dateOfBirth.', gender- '. $gender.', mobileNo- '.$mobileNo.', telephoneNo- '. $telephoneNo.', telephoneType- '. $telephoneType.', email- '. $email.', flatno- '. $flatno.', buildingName- '. $buildingName.', road- '. $road.', city- '. $city.', state- '. $state.', pincode- '. $pincode.', pan- '. $pan.', passport- '. $passport.', aadhaar- '. $aadhaar.', voterid- '. $voterid.', driverlicense- '. $driverlicense.', rationcard- '. $rationcard.', reason- '. $reason.' <br>';
	$Log .= 'Output Step 1 - '.$output.'<br>';
	$insertSql = array('step'=> 'Step 1', 'status'=> 'First Step', 'message'=> $output, 'requestid'=>Fixstring($insertID), 'Dated'=>$nowdated, 'lead_details'=>$Log);
//	print_r($insertSql);	
	Maininsertfunc ('experian_log', $insertSql);

//	echo $Log;
	//exit();
	echo "...";
	}
	else
	{
//		echo "Some Error...";
	$insertSql = array('step'=> 'Step 2', 'status'=> 'Error First Step', 'message'=> 'Error First Step', 'requestid'=>Fixstring($insertID), 'Dated'=>$nowdated);
	Maininsertfunc ('experian_log', $insertSql);

		header("Location: https://www.deal4loans.com/yesbankcc_result.php?insertID=".$insertID);
		exit();
		die();
	}
}
else
{
//	echo "Some Error..";
	$insertSql = array('step'=> 'Step 2', 'status'=> 'Error First Step', 'message'=> 'Error First Step', 'requestid'=>Fixstring($insertID), 'Dated'=>$nowdated);
	Maininsertfunc ('experian_log', $insertSql);

	header("Location: https://www.deal4loans.com/yesbankcc_result.php?insertID=".$insertID);
			exit();
	die();
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
<?php include "middle-menu.php"; ?>
<div class="d4l_inner_wrapper">
<div style="margin-top:70px;"></div>
<div  class="common-bread-crumb"><a href="index.php">Home</a> &gt; Credit Score </div>
<div style="margin:auto;">
  <div class="left-wrapper">
    <div>
      <h1 class="pl-h1">Credit Score</h1>
    
      <div style="clear:both;"></div>
      <div><img src="/new-images/experian_logo.png"  /> </div>
      <div style="clear:both; height:15px;"></div>
      <!--class="lfttxtbar" -->
      <div id="txt">
        <div class="pl-bank-leftinn" style="padding:10px;     float: left;    border: 1px solid #cccccc;    padding: 4px;    width: 100%;">
        <?php 
		if($Step_Status=='Success')
		{
			//display output
			//print_r($output);
			$obj = json_decode($output);
			$BureauScore = $output;
			$updateSql = "UPDATE experian_initial_details SET cibil_score='".$BureauScore."' WHERE id='".$insertID."'";
			$updateQuery = d4l_ExecQuery($updateSql);
				header("Location: https://www.deal4loans.com/yesbankcc_result.php?insertID=".$insertID);
					exit();

		
		}
		else if($Step_Status=='QuestionSuccess')
		{
		
			$obj = json_decode($output);
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
<form action="yesbankcc_thanks_questions.php" name="questionaire" method="post">
<input type="hidden" name="NewJSESSIONID_d4l" value="<?php echo $NewJSESSIONID_d4l; ?>"  />
<input type="hidden" name="qid" value="<?php echo $qid; ?>"  />
<input type="hidden" name="stgOneHitId" value="<?php echo $stgOneHitId; ?>" />
<input type="hidden" name="stgTwoHitId" value="<?php echo $stgTwoHitId; ?>"  />
<input type="hidden" name="showHtmlReportForCreditReport" value="<?php echo $showHtmlReportForCreditReport; ?>"  />
<input type="hidden" name="responseJson" value="<?php echo $responseJson; ?>"  />
<input type="hidden" name="insertID" value="<?php echo $insertID; ?>"  />
<input type="hidden" name="firstName" value="<?php echo $firstName; ?>"  />
<input type="hidden" name="servertype" value="<?php echo $servertype; ?>"  />

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
			$insertSql = array('step'=> 'Step 1', 'status'=> 'Error First Step', 'message'=> $output, 'requestid'=>Fixstring($insertID), 'Dated'=>$nowdated, 'lead_details'=>Fixstring($Log));
			//	print_r($insertSql);	
			Maininsertfunc ('experian_log', $insertSql);

		header("Location: https://www.deal4loans.com/yesbankcc_result.php?insertID=".$insertID);
			exit();
//			echo "error in an Stage";	
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