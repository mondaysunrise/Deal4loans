<?php
ob_start();
ini_set('max_execution_time', 1000);

session_start();
require 'scripts/session_check.php';
require 'scripts/db_init.php';
require 'scripts/functionshttps.php';
require 'cibil_experian_functions.php';
//print_r($_POST);
//echo "<br>";
$dated = date("Y-m-d");
$nowdated = ExactServerdate();

//echo "<br>";
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$cibilExperian= new cibilExperian();
	$insertID =$_POST['insertID'];
/*	$getVoucherCodeSql = "select vouchercode, StartDate, ExpiryDate, id from experian_vouchers_codes where VoucherUsedIndicator='N' and Assignedtoconsumer='N' and ('".$dated."' between StartDate and ExpiryDate) order by id asc limit 0,1";
	$getVoucherCodeQuery = d4l_ExecQuery($getVoucherCodeSql);
	$voucherCode = d4l_mysql_result($getVoucherCodeQuery,0,'vouchercode');
	*/
	//$voucher_type='uat';
	$servertype='production';
	$voucher_type=$servertype;
	
	$voucherCode = $cibilExperian->getVoucherCode($insertID, $voucher_type);
	$day = $_POST['day'];
	$month = $_POST['month'];
	$year = $_POST['year'];
	$dob = $year."-".$month."-".$day;
	$monthName = date('M', mktime(0, 0, 0, $month, 10));
	
	$dateOfBirth = $day."-".$monthName."-".$year;
	$gender = $_POST['gender'];
	$telephoneNo = $_POST['telephoneNo'];
	$telephoneType = $_POST['telephoneType'];
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
		
			
//		echo "<br>insertID - ".$insertID."<br>";
	$DataArray = array('dob'=>Fixstring($dob), 'gender'=> Fixstring($gender), 'telephoneNo'=>Fixstring($telephoneNo), 'telephoneType'=>Fixstring($telephoneType), 'flatno'=> Fixstring($flatno), 'buildingName'=>Fixstring($buildingName), 'road'=>Fixstring($road), 'city'=> Fixstring($city), 'state'=>Fixstring($state), 'pincode'=>Fixstring($pincode), 'pan'=> Fixstring($pan), 'passport'=>Fixstring($passport), 'aadhaar'=>Fixstring($aadhaar), 'voterid'=> Fixstring($voterid), 'driverlicense'=>Fixstring($driverlicense), 'rationcard'=>Fixstring($rationcard), 'dated'=>Fixstring($nowdated), 'vouchercode'=>Fixstring($voucherCode) );
	//print_r($DataArray);
	$wherecondition =" (id=".$insertID.")";
	Mainupdatefunc ('experian_initial_details', $DataArray, $wherecondition);
//die();
	$DataArrayVC = array("requestid"=>$insertID, "VoucherUsedIndicator"=>'Y' );
	$whereconditionVC ="(vouchercode='".$voucherCode."')";
	Mainupdatefunc ('experian_vouchers_codes', $DataArrayVC, $whereconditionVC);
	
	$getdetails = "select * FROM experian_initial_details Where ( id='".$insertID."')";
	//echo "<br>".$getdetails."<br>";
	list($alreadyExist,$myrow)=MainselectfuncNew($getdetails,$array = array());
	$myrowcontr=count($myrow)-1;
	if($alreadyExist>0)
	{
		$firstName= $myrow[$myrowcontr]["firstName"];
		$middleName= $myrow[$myrowcontr]["middleName"];
		$surName= $myrow[$myrowcontr]["surName"];
		$mobileNo= $myrow[$myrowcontr]["mobileNo"];
		$email= $myrow[$myrowcontr]["email"];
	}
//	echo $voucherCode.", ".$firstName.", ".$middleName.", ".$surName.", ".$dateOfBirth.", ".$gender.", ".$mobileNo.", ".$telephoneNo.", ".$telephoneType.", ".$email.", ".$flatno.", ".$buildingName.", ".$roadName.", ".$city.", ".$state.", ".$pincode.", ".$pan.", ".$passport.", ".$aadhaar.", ".$voterid.", ".$driverlicense.", ".$rationcard.", ".$reason.", ".$insertID.", ".$counter;
	
	list($Step_Status,$output) = $cibilExperian->landingPageSubmit($voucherCode, $firstName, $middleName, $surName, $dateOfBirth, $gender, $mobileNo, $telephoneNo, $telephoneType, $email, $flatno, $buildingName, $roadName, $city, $state, $pincode,$pan, $passport, $aadhaar, $voterid, $driverlicense, $rationcard, $reason, $insertID, $counter,$servertype);
	
	//$insertSql = array('step'=> 'Step 1', 'status'=> 'Error First Step', 'message'=> $output, 'requestid'=>Fixstring($insertID), 'Dated'=>$nowdated);
	//Maininsertfunc ('experian_log', $insertSql);

	$Log = 'Input Step 1 - voucherCode- '. $voucherCode.', firstName- '. $firstName.', middleName- '. $middleName.', surName- '. $surName.', dateOfBirth- '. $dateOfBirth.', gender- '. $gender.', mobileNo- '.$mobileNo.', telephoneNo- '. $telephoneNo.', telephoneType- '. $telephoneType.', email- '. $email.', flatno- '. $flatno.', buildingName- '. $buildingName.', road- '. $road.', city- '. $city.', state- '. $state.', pincode- '. $pincode.', pan- '. $pan.', passport- '. $passport.', aadhaar- '. $aadhaar.', voterid- '. $voterid.', driverlicense- '. $driverlicense.', rationcard- '. $rationcard.', reason- '. $reason.' <br>';
	$Log .= 'Output Step 1 - '.$output.'<br>';
	$insertSql = array('step'=> 'Step 1', 'status'=> 'Error First Step', 'message'=> $output, 'requestid'=>Fixstring($insertID), 'Dated'=>$nowdated, 'lead_details'=>$Log);
	Maininsertfunc ('experian_log', $insertSql);
	//echo $Log;
	//exit();
//echo "<br>###################################<br>";
//echo $Log;
//echo "<br>###################################<br>";
//die();

}
else
{
	$insertSql = array('step'=> 'Step 2', 'status'=> 'Error First Step', 'message'=> 'Error First Step', 'requestid'=>Fixstring($insertID), 'Dated'=>$nowdated);
	Maininsertfunc ('experian_log', $insertSql);

	header("Location: https://www.deal4loans.com/cibil-credit-score-result.php?insertID=".$insertID);
	exit();
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
        <div class="pl-bank-leftinn" style="padding:10px;     float: left;    border: 1px solid #cccccc;    padding: 4px;    width: 100%;">
        <?php 
		if($Step_Status=='Success')
		{
			//display output
			//print_r($output);
			$obj = json_decode($output);
		
			header("Location: https://www.deal4loans.com/cibil-credit-score-result.php?insertID=".$insertID);
			exit();
//		
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
			$responseJson = $obj->responseJson;
			$stgOneHitId = $obj->stgOneHitId;
			$stgTwoHitId = $obj->stgTwoHitId;

		//	$secondXMLResponse = $questionToCustomer->secondXMLResponse;
		//	$toolTip = $questionToCustomer->toolTip;
		//	$type = $questionToCustomer->type;
		//	$showHtmlReportForCreditReport = $obj->showHtmlReportForCreditReport;

		?>
<form action="cibil-check-thanks-questions.php" name="questionaire" method="post">
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
			$responseJson= json_decode($output);
			$insertSql = array('step'=> 'Step 2', 'status'=> Fixstring($Step_Status), 'message'=> Fixstring($responseJson), 'requestid'=>Fixstring($insertID), 'Dated'=>$nowdated);
			Maininsertfunc ('experian_log', $insertSql);

			header("Location: https://www.deal4loans.com/cibil-credit-score-result.php?insertID=".$insertID);
			exit();
			//echo "error in an Stage";	
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