<?php
	require 'scripts/functions.php';
	session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Quiz | Personal Loan | Home Loan | Credit Card | Business Loan | Loan Against Property | Car Loan </title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<meta http-equiv="Content-Language" content="en-us">
<meta name="keywords" content="personal loan, home loan, credit card, loan against property, business loan, car loan, loan information, loan portal, loan india, online loan application, loan eligibility, easy loan, quick loans, loan providers india, compare loans, comparision loans">
<meta name="description" content="Deal4loans is the leading platform for online loan comparison in India. Apply with us to get quotes from various Banks. Compare and Choose the Best loan deal in India from hundreds of loans product to bring you not just the best price, but the best deal.">
<link href="style/new-bima.css" rel="stylesheet"  type="text/css" />
<link href="style/glowing.css" rel="stylesheet"  type="text/css" />
<script type="text/javascript" src="js/dropdowntabs.js"></script>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>

</head>
<body>
<?php include '~Top-new.php';?>
<?php include '~menu.php';?>
<div id="container">
<div id="lftbar">
<div class="lfttxtbar">
  <span><a href="index.php">Home</a> > Quiz </span>

  <div id="txt">
    <h1  >Loans Quiz on Deal4loans</h1>
	  <table border="0" cellpadding="0" cellspacing="2" bordercolor="#111111" width="100%" align="center">
 
           <tr> 
            <td >
<?
// iQuiz v1.0 - a simple quiz script
// You may change any of this script but please do not remove the link at the bottom of the page
//$xmlFile = "iQuiz/questions.xml";
$xmlFile = "iquiz/questionsdeal.xml";

// header and footer
$headerFile = "iquiz/header.htm";
$footerFile = "iquiz/footer.htm";

// XML Section
$data = implode("", file($xmlFile));
$parser = xml_parser_create();
xml_parser_set_option($parser, XML_OPTION_CASE_FOLDING, 0);
xml_parser_set_option($parser, XML_OPTION_SKIP_WHITE, 1);
xml_parse_into_struct($parser, $data, $values, $tags);
xml_parser_free($parser);

$questionNo = 0;
foreach ($values as $key=>$val) {
	// save value to "questions" array if this is a TEXT tag
	if ($val[tag] == "TEXT") {
	   	$questions[$questionNo]['text'] = $val[value];
	}

	// save value to "questions" array if this is a CHOICES tag
	if ($val[tag] == "CHOICES") {
		$questions[$questionNo]['choices'] = $val[value];
	}

	// save value to "questions" array if this is an ANSWER tag
	if ($val[tag] == "ANSWER") {
		$questions[$questionNo]['answer'] = $val[value];
		// increment question counter variable
	//	$questionNo++;
	}
	
	// save value to "DESCRIPTION" array if this is an DESCRIPTION tag
	if ($val[tag] == "DESCRIPTION") {
		$questions[$questionNo]['description'] = $val[value];
		// increment question counter variable
		$questionNo++;
	}
	
	
}

//print_r($values);
import_request_variables("p", "post_");

include($headerFile);




if (!isset($post_answers)) {
	echo '<table width="650" border="0" align="center" cellpadding="0" cellspacing="0" style="border:1px solid #E2E1E1;"><tr><td bgcolor="#E2E1E1">&nbsp;</td></tr><tr><td height="25" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold; color:#000000; padding-left:14px;">';
	echo "<b>Question No. 1 - </b> ";		
	echo "<b>". $questions[0]['text'] . "</b>";
	echo '</td></tr><tr><td style="padding-left:10px;"><table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">';
	//echo "</td></tr>";
	echo "<form action=\"$PHP_SELF\" method=\"post\">\n";
	// split choices into "choices" array
	$choices = explode(", ", $questions[0]['choices']);

	// print text field if there are no choices
	if (count($choices) == 1) {
		echo "<tr><td> <input type=\"text\" name=\"answers[0]\" size=10>\n </td></tr>";
	}

	// print radio fields if there are multiple choices
	else {
		// print a radio button for each choice
		for ($i = 0; $i < count($choices); $i++) {
			echo "<tr><td height='25'> <input type=\"radio\" name=\"answers[0]\" value=\"" . $choices[$i] . "\"> " . $choices[$i] . "<br>\n </td></tr>";
			echo "\n";	
		}
	}

	echo "<tr><td height='30'> <input type=\"submit\" value=\"Next Question\">\n </td></tr></table></td></tr>";
	echo "</form>\n";
	echo "<tr><td bgcolor='#E2E1E1'>&nbsp;</td></tr>";
	//echo "Total Number of Questions : " .$questionNo. "\n";
	 //echo "<tr><td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:normal; color:#000000; padding:8px;'>";	
	//echo "<tr><td>";
	//echo "<br><br>";
	//echo "\n";
	//if(strlen($questions[0]['description'])>0)
	//{
	//Put relevent description for the question asked
		//echo "\n Description : ".$questions[0]['description'];
	//}
	//echo "</td></tr></table>";
	echo "</table>";
	
}

//
// PRINT NEXT QUESTION
//

elseif (count($questions) > count($post_answers) && $_REQUEST['Quit']!='Quit') {
	// get number of next question
	$nextQuestion = count($post_answers);
	
	$questionNumber = $nextQuestion + 1;
	// print question
		echo '<table width="500" border="0" align="left" cellpadding="0" cellspacing="0" style="border:1px solid #E2E1E1;"><tr><td bgcolor="#E2E1E1">&nbsp;</td></tr><tr><td height="25" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold; color:#000000; padding-left:14px;">';
	echo "<b>Question No. " .$questionNumber. " - </b> ";
	echo "<b>" . $questions[$nextQuestion]['text'] . "</b>\n";
	echo "\n";
	echo '</td></tr><tr><td style="padding-left:10px;"><table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">';
//	echo "</td></tr>";
	echo "<form action=\"$PHP_SELF\" method=\"post\">\n";

	// print answers to previous questions as hidden form fields
	for ($i = 0; $i < count($post_answers); $i++) {
		echo "<input type=\"hidden\" name=\"answers[$i]\" value=\"$post_answers[$i]\">\n </td></tr>";
	}

	// split choices into "choices" array
	$choices = explode(", ", $questions[$nextQuestion]['choices']);

	// print text field if there are no choices
	if (count($choices) == 1) {
		echo "<tr><td> <input type=\"text\" name=\"answers[$nextQuestion]\" size=10>\n </td></tr>";
		echo "\n";
	}

	// print radio fields if there are multiple choices
	else {
		// print a radio button for each choice
		for ($i = 0; $i < count($choices); $i++) {
			echo "<tr><td height='30'> <input type=\"radio\" name=\"answers[$nextQuestion]\" value=\"" . $choices[$i] . "\"> " . $choices[$i] . "<br>\n";
			echo "\n";
		}
	}

	// print appropriate button label
	
echo "<tr><td height='30'>";
	if (count($questions) == count($post_answers) + 1) {
		echo "<input type=\"submit\" value=\"Calculate Score\">\n";
	}
	else {
		echo "<input type=\"submit\" value=\"Next Question\">\n";
		echo "<input type=\"submit\" value=\"Quit\" name=\"Quit\">\n";
	echo "\n";
	}
		echo "</td></tr></table></td></tr>";
	echo "</form>\n";
	echo "<tr><td bgcolor='#E2E1E1'>&nbsp;</td></tr>";
	
//echo "</td></tr>";	
	//echo "<br>\n Total Number of Questions : " .$questionNo. "\n";
	//echo "</form>\n";
	//echo "<tr><td>";
	//echo "<br><br>";
	// echo "<tr><td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:normal; color:#000000; padding:8px;'>";	

//	echo "\n";
	//Put relevent description for the question asked
	//if(strlen($questions[$nextQuestion]['description'])>0)
	//{
		//echo "\n <b>Description :</b> ".$questions[$nextQuestion]['description'];
	//}
//	echo "</td></tr></table>";
	echo "</table>";

}

//
// CALCULATE AND PRINT SCORE
//

else if($_REQUEST['Quit']!='Quit') {
	// get number of questions
	$noQuestions = count($questions);

	// get number of correct answers
	for ($i = 0; $i < $noQuestions; $i++) {
		// increment "noCorrectAnswers" variable if user has correct answer
		if ($questions[$i]['answer'] == $post_answers[$i]) {
			$noCorrectAnswers++;
		}
	}

	// calculate score
	$score = ($noCorrectAnswers / $noQuestions) * 100;

	// round score to nearest whole precentage point
	$score = round($score);
echo '<table width="500" border="0" align="left" cellpadding="0" cellspacing="0" style="border:1px solid #E2E1E1;"><tr><td bgcolor="#E2E1E1">&nbsp;</td></tr><tr><td height="25" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold; color:#000000; padding-left:14px;">';

	// print score
	echo "<h2>$score%</h2>\n";

	if ($noCorrectAnswers == 0) {
		echo "<p>You answered no questions correctly.  <a href=" . $PHP_SELF . ">Try again.</a></p>";
	}

	if ($noCorrectAnswers == 1) {
		echo "<p>You answered 1 out of $noQuestions questions correctly.  <a href=" . $PHP_SELF . ">Try again.</a></p>";
	}

	if ($noCorrectAnswers > 1 && $noCorrectAnswers < $noQuestions) {
		echo "<p>You answered $noCorrectAnswers out of $noQuestions questions correctly.  <a href=" . $PHP_SELF . ">Try again.</a></p>";
	}

	if ($noCorrectAnswers == $noQuestions) {
		echo "<p>You answered all questions correctly!</p>";
	}
		echo "</td></tr></table></td></tr>";
	echo "<tr><td bgcolor='#E2E1E1'>&nbsp;</td></tr>";
	echo "</table>";
}

if($_REQUEST['Quit']=='Quit') {
	// get number of questions

	$answersGiven = $_REQUEST['answers'];//GET THE COUNT OF QUESTIONS ANSWERED  BY THE USER

    //$noQuestions = count($answersGiven);
	$noQuestions = count($questions);
	// get number of correct answers
	for ($i = 0; $i < $noQuestions; $i++) {
		// increment "noCorrectAnswers" variable if user has correct answer
		if ($questions[$i]['answer'] == $post_answers[$i]) {
			$noCorrectAnswers++;
		}
	}

	// calculate score
	$score = ($noCorrectAnswers / $noQuestions) * 100;

	// round score to nearest whole precentage point
	$score = round($score);


echo '<table width="500" border="0" align="left" cellpadding="0" cellspacing="0" style="border:1px solid #E2E1E1;"><tr><td bgcolor="#E2E1E1">&nbsp;</td></tr><tr><td height="25" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold; color:#000000; padding-left:14px;">';
	// print score
	echo "<h2>$score%</h2>\n";

	if ($noCorrectAnswers == 0) {
		echo "<p>You answered no questions correctly.  <a href=" . $PHP_SELF . ">Try again.</a></p>";
	}

	if ($noCorrectAnswers == 1) {
		echo "<p>You answered 1 out of $noQuestions questions correctly.  <a href=" . $PHP_SELF . ">Try again.</a></p>";
	}

	if ($noCorrectAnswers > 1 && $noCorrectAnswers < $noQuestions) {
		echo "<p>You answered $noCorrectAnswers out of $noQuestions questions correctly.  <a href=" . $PHP_SELF . ">Try again.</a></p>";
	}

	if ($noCorrectAnswers == $noQuestions) {
		echo "<p>You answered all questions correctly!</p>";
	}
	
	echo "</td></tr></table></td></tr>";
	echo "<tr><td bgcolor='#E2E1E1'>&nbsp;</td></tr>";
	echo "</table>";
}

//
// INCLUDE FOOTER FILE
//

include($footerFile);

?>  </td>
          </tr>
		  
		 			   <tr><td height="50">&nbsp;</td>
		 			   </tr>
      </table>
    </div>
</div></div>
<?php include '~Right-new.php'; ?>
<?php include '~Bottom-new.php';?>
</div>
</body>
</html>

