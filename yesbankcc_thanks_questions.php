<?php
ob_start();
session_start();
require 'scripts/session_check.php';
require 'scripts/db_init.php';
require 'scripts/functionshttps.php';
require 'cibil_experian_functions.php';

$insertID = $_REQUEST['insertID'];
$NewJSESSIONID_d4l = $_SESSION['Stage2JSESSIONID_d4l'];
$stgOneHitId = $_POST['stgOneHitId'];
$stgTwoHitId = $_POST['stgTwoHitId'];
$firstName = $_POST['firstName'];
$servertype=$_POST['servertype'];
$qid = $_POST['qid'];
$XMLResponse = $_POST['XMLResponse'];
$responseJson = trim($_POST['responseJson']);
$optionsSet1 = $_POST['optionsSet1'];
$optionsSet2 = $_POST['optionsSet2'];
$answer = $optionsSet1.":".$optionsSet2;
$cibilExperian= new cibilExperian();
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
      <div style="clear:both; height:15px;"></div>
      <!--class="lfttxtbar" -->
      <div id="txt">
         <div class="pl-bank-leftinn" style="padding:10px;     float: left;    border: 1px solid #cccccc;    padding: 4px;    width: 100%;">
    
        <?php
		//echo "<br>Response - ".$responseJson."<br>";
		if($responseJson=='next')
		{
			list($Step_Status, $questionset) = $cibilExperian->generateQuestionForConsumer($servertype,$insertID, $stgOneHitId, $stgTwoHitId, $NewJSESSIONID_d4l, $qid, $answer);
			if($Step_Status=='QuestionSuccess')
			{
				//Get Questions
				$obj = json_decode($questionset);
				//print("<pre>");
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
				if($responseJson=="passedReport")
				{
					$BureauScore=$questionset;
					$updateSql = "UPDATE experian_initial_details SET cibil_score='".$BureauScore."' WHERE id='".$insertID."'";
					$updateQuery = d4l_ExecQuery($updateSql);
				
					header("Location: https://www.deal4loans.com/yesbankcc_result.php?insertID=".$insertID);
					exit();

				}
				else if($responseJson=="systemError" || $responseJson=="inCorrectAnswersGiven" || $responseJson=="insufficientQuestion" || $responseJson=="error" || $ResponseJson=="creditReportEmpty")
				{
					$insertSql = array('step'=> 'Step 2', 'status'=> Fixstring($responseJson), 'message'=> Fixstring($responseJson), 'requestid'=>Fixstring($insertID), 'Dated'=>$nowdated);
					Maininsertfunc ('experian_log', $insertSql);
					header("Location: https://www.deal4loans.com/yesbankcc_result.php?insertID=".$insertID);
					exit();
				
				}
				else
				{
					//echo $responseJson."<br>";
				?>
	   <div style="clear:both;"></div>
      <div><img src="/new-images/experian_logo.png"  /> </div>
   <div style="clear:both;"></div>
    <div class="pl-bank-leftinn inner-body-plbanks" style="padding:10px;">
    		<form action="yesbankcc_thanks_questions.php" name="questionaire" method="post">
			<input type="hidden" name="NewJSESSIONID_d4l" value="<?php echo $NewJSESSIONID_d4l; ?>"  />
			<input type="hidden" name="qid" value="<?php echo $qid; ?>"  />
			<input type="hidden" name="stgOneHitId" value="<?php echo $stgOneHitId; ?>"  />
			<input type="hidden" name="stgTwoHitId" value="<?php echo $stgTwoHitId; ?>"  />
			<input type="hidden" name="XMLResponse" value="<?php echo $XMLResponse; ?>"  />
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

</table>	</form></div>
			<?php
			//print("<pre>");
				//print_r($result4);
				}
			}
			elseif($Step_Status=="passedReport")
			{
				header("Location: https://www.deal4loans.com/yesbankcc_result.php?insertID=".$insertID);
				exit();	
			}
			else
			{
				$obj = json_decode($questionset);
				$responseJson = $obj->responseJson;
				$insertSql = array('step'=> 'Step 7', 'status'=> Fixstring($Step_Status), 'message'=> Fixstring($responseJson), 'requestid'=>Fixstring($insertID), 'Dated'=>$nowdated);
		Maininsertfunc ('experian_log', $insertSql);
				//echo "Exception Step 7";
			//	echo $Step_Status;
				
			//	print("<pre>");
				//print_r($obj);
				header("Location: https://www.deal4loans.com/yesbankcc_result.php?insertID=".$insertID);
				exit();

//				echo "creditReportEmpty";
			}
		}
			elseif($responseJson=="passedReport")
			{
				$BureauScore=$questionset;
				header("Location: https://www.deal4loans.com/yesbankcc_result.php?insertID=".$insertID);
				exit();
			}
			else
			{
				$insertSql = array('step'=> 'Step 2', 'status'=> Fixstring($Step_Status), 'message'=> Fixstring($responseJson), 'requestid'=>Fixstring($insertID), 'Dated'=>$nowdated);
				Maininsertfunc ('experian_log', $insertSql);
				header("Location: https://www.deal4loans.com/yesbankcc_result.php?insertID=".$insertID);
				exit();
				//echo "Final Exception";	
			
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