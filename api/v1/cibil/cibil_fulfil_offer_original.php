<?php
//ini_set("display_errors", "1");
error_reporting(E_ALL);
//define('API_URL', 'http://apibeta.wishfin.com/api/v1/');
define('API_VERSION', 'UAT');
define('API_PRODUCT', 'PL');
require 'cibil_oauth.php';

if(isset($_POST["identify"]))
{
	$str=$_POST["data"];
	 parse_str($str,$my_arr);
	  foreach($my_arr as $key=>$value){
		//echo "$key => $value";
	  }
	  $reqddata=$my_arr;
}
else
{
	 $reqddata=$_POST;
}


if($reqddata["apicall"]=="CibilFulfilOffer")
{
	$Fulfilofferapiresponse=CibilFulfilOffer($reqddata);
	//print_R($Fulfilofferapiresponse);
	/*********************************************************************/
		if($Fulfilofferapiresponse["status"]=="success")
		{
			$cibilid = $Fulfilofferapiresponse["result"]["cibil_id"];
			$next_api_call = $Fulfilofferapiresponse["result"]["next_api_call"];		

		if($Fulfilofferapiresponse["status"]=="success" && $Fulfilofferapiresponse["result"]["cibil_status"]=="Success")// for success get score
		{
			//echo "success";
			if($Fulfilofferapiresponse["result"]["cibil_id"]>0)
			{
				//echo "enter";
				$Assetapiresponse=CibilCustomerAssets($cibilid,$next_api_call);
				//print_r($Assetapiresponse);
				if(isset($Assetapiresponse["result"]["cibil_score"]))
				{
					$errorMessage="Your Cibil Score: ".$Assetapiresponse["result"]["cibil_score"];
				}
				else
				{
					$errorMessage="Your Cibil Score: ".$Fulfilofferapiresponse["result"]["cibil_score"];
				}
			}
			else
			{
				$errorMessage="sorry cant find";
			}
			
		}
		elseif($Fulfilofferapiresponse["status"]=="success" && $Fulfilofferapiresponse["result"]["cibil_status"]=="Pending")// for success
		{
			//echo "Pending";
			if($next_api_call=="cibil-authentication-questions")
			{
				$apiresponse=CibilAuthenticationQuest($cibilid, $next_api_call);
				$next_api_call = $apiresponse["result"]["next_api_call"];
				echo $responseview = ResponseView($cibilid, $apiresponse, "CibilAuthenticationQuest",$next_api_call);
			}
			else
			{
				$errorMessage="where to go";
			}
		}
		elseif($Fulfilofferapiresponse["status"]=="success" && $Fulfilofferapiresponse["result"]["cibil_status"]=="InProgress")// for success
		{
			if($next_api_call=="cibil-authentication-questions")
			{
				$apiresponse=CibilAuthenticationQuest($cibilid, $next_api_call);
				$next_api_call = $apiresponse["result"]["next_api_call"];
				echo $responseview = ResponseView($cibilid, $apiresponse, "CibilAuthenticationQuest",$next_api_call);
			}
			else
			{
				$errorMessage="where to go";
			}
		}
		}
		else
		{
			$errorMessage="issue at wishfin API<<71";
		}

		if(isset($errorMessage))
			{
				echo $errorMessage;
			}
	/********************************************************************/
}

/***************************************************************************************************************************/
//////////////////////CALL FOR CUSTOMER AUTHENTICATION QUESTION/////////////////////////////////////////////////////////////////////
/*************************************************************************************************************************/
if(($reqddata["apicall"]=="CibilAuthenticationQuest" || $reqddata["apicall"]=="cibil-authentication-questions"))
{
	$apiresponse=CibilAuthenticationQuest($cibilid, $next_api_call);
	echo $responseview = ResponseView($cibilid, $apiresponse, "CibilAuthenticationQuest",$next_api_call);
}
/***************************************************************************************************************************/
//////////////////////CALL FOR CUSTOMER AUTHENTICATION QUESTION END/////////////////////////////////////////////////////////////////////
/*************************************************************************************************************************/


/***************************************************************************************************************************/
////////////////////// CALL FOR CUSTOMER VERIFY QUESTION/////////////////////////////////////////////////////////////////////
/*************************************************************************************************************************/
if($reqddata["apicall"]=="CibilVerifyQuest" || $reqddata["apicall"]=="cibil-verify-answers")
	{
	if($reqddata["datatype"]=="single")//single
	{
		$answers = array("question_key"=> $reqddata["questionkey"], "answer_key"=> $reqddata["answerkey"] , "user_input_answer"=> $reqddata["user_input_answer"]);
		if(isset($reqddata["skipEligible"]))
		{
			$addskip=array("skip"=>"true");
			$finalanswers=array_merge($answers,$addskip);
		}
		elseif(isset($reqddata["resendEligible"]))
		{
			$addresend=array("resend"=>"true");
			$finalanswers=array_merge($answers,$addresend);
		}
		else
		{
			$finalanswers=$answers;
		}
		$cibilverifyRequest=array("cibil_id"=>$reqddata["cibilid"], "answers"=>array($finalanswers));

		//print_r($cibilverifyRequest);
	}
	elseif($reqddata["datatype"]=="multi")
	{
		$question_value="";
		$answer_value="";
		$user_value="";
		$answerarr="";
		for($j=0;$j<($reqddata["qnacount"]);$j++)
		{
			$question_value=$reqddata["questionkey_".$j];
			$answer_value=$reqddata["answerkey_".$j];
			$user_value=$reqddata["user_input_answer_".$j];
			$answerarr=array("question_key"=>$question_value,"answer_key"=>$answer_value,"user_input_answer"=>$user_value);
			if(isset($reqddata["skipEligible_".$j]))
			{	$addskip=array("skip"=>"true");
				$finalanswers[]=array_merge($answerarr,$addskip);
			}
			else
			{
				$finalanswers[]=$answerarr;
			}
		}
		//print_R($finalanswers);
		$cibilverifyRequest=array("cibil_id"=>$reqddata["cibilid"], "answers"=>$finalanswers);
	}
	elseif($reqddata["datatype"]=="multichoice")
	{
		$question_value="";
		$answer_value="";
		$user_value="";
		$answerarr="";
		for($j=0;$j<($my_arr["qnacount"]);$j++)
		{
			$question_value=$my_arr["questionkey_".$j];
			list($answer_value,$reqduser_value)=explode("_",$my_arr["answerkey_".$j]);
			if($reqduser_value=="skip")
			{
				$user_value="";
				$skipEligibleflag=1;
			}
			else
			{
				$user_value=$reqduser_value;
				$skipEligibleflag=0;
			}
			$answerarr=array("question_key"=>$question_value,"answer_key"=>$answer_value,"user_input_answer"=>$user_value);
			if($skipEligibleflag==1)
			{	
				$addskip=array("skip"=>"true");
				$finalanswers[]=array_merge($answerarr,$addskip);
				//print_R($finalanswers);
			}
			else
			{
				$finalanswers[]=$answerarr;
			}
		}
		//print_R($finalanswers);
		$cibilverifyRequest=array("cibil_id"=>$reqddata["cibilid"], "answers"=>$finalanswers);
	}
	$apiresponse=CibilVerifyQuest($cibilverifyRequest, $cibilid, "cibil-verify-answers");
	//print_R($apiresponse);
	$cibil_id=$apiresponse["result"]["cibil_id"];
	//options - Failure, InProgress, Success

		if($apiresponse["status"]=="success")
		{
			if($apiresponse["result"]["cibil_status"]=="InProgress")
			{
				if($apiresponse["result"]["next_api_call"]=="cibil-authentication-questions" && $cibil_id>0)
				{ 
					$authapiresponse=CibilAuthenticationQuest($cibil_id,$apiresponse["result"]["next_api_call"]);
					if($authapiresponse["status"]=="success")
					{
					echo $responseview = ResponseView($cibil_id, $authapiresponse, "CibilAuthenticationQuest",$authapiresponse["result"]["next_api_call"]);
					}
					else
					{
						$errorMessage="issue at wishfin API<<142";
					}
				}
			}
			elseif($apiresponse["result"]["cibil_status"]=="Success")
			{
				$Assetapiresponse=CibilCustomerAssets($cibil_id, "cibil-customer-assets");
				if($Assetapiresponse["status"]=="success")
				{
					if($Assetapiresponse["result"]["cibil_status"]=="Success")
					{
						$errorMessage="Your cibil Score:".$Assetapiresponse["result"]["cibil_score"];
					}
					else
					{
						$errorMessage="issue at Cibil";
					}
				
				}
				else
				{
					$errorMessage="issue at wishfin API";
				}
			}
			else
			{
				$errorMessage="failure from cibil";
			}

		}
	else
		{
			$errorMessage="issue at wishfin API";
		}

		if(isset($errorMessage))
			{
				echo $errorMessage;
			}
		
}
/***************************************************************************************************************************/
//////////////////////CALL FOR CUSTOMER VERIFY QUESTION END ////////////////////////////////////////////////////////////////////
/*************************************************************************************************************************/


//***************************************************************************************/
/////////////////////////FULFIL OFFER//////////////////////////////////////////////////
/***************************************************************************************/
function CibilFulfilOffer($reqddata)
{
	/********Check for Oauth******/
	$oauthReturn = OauthConnection();
	//print_r($oauthReturn);
	$oauthAccessToken = $oauthReturn['access_token'];
	$oauthExpiresIn = $oauthReturn['expires_in'];
	$oauthTokenType = $oauthReturn['token_type'];
	/********Check for Oauth END******/
	if(isset($oauthAccessToken) && isset($oauthTokenType) && isset($oauthExpiresIn))
	{	
		$name = explode(" ",trim($reqddata["Full_Name"]));
		$firstname = $name[0];
		$lastname = $name[1];
		$panno = trim($reqddata["Pancard"]);
		$dob = trim($reqddata["DOB"]);
		$mobileno = trim($reqddata["Mobile_Number"]);
		$email = trim($reqddata["Email"]);
		$gender = $reqddata["Gender"];
		$city = $reqddata["City"];
		//$statecode = $reqddata["StateCode"];
		$statecode = "07";//07 delhi 24- gujarat
		$residence_address = substr(trim($reqddata["Residence_Address"]),0,40);
		$resi_pincode = $reqddata["Pincode"];

		$ch = curl_init();
		$url = API_URL . 'cibil-fulfill-order';
		$data = array(
			"first_name" => $firstname,
			"last_name" => $lastname,
			"pancard" => $panno,
			"date_of_birth" => $dob,
			"mobile_number" => $mobileno,
			"email_id" => $email,
			"gender" => $gender,
			"city_name" => $city,
			"state_code" => $statecode,
			"residence_address" => $residence_address,
			"residence_pincode" => $resi_pincode,
			"legal_response" => "Accept",
			"show_report_xml" => true
		);
		$data_string = json_encode($data);
		//echo $data_string;
		$header = array();
		$header[] = 'Content-type: application/json';
		$header[] = 'Authorization: ' . $oauthTokenType . " " . $oauthAccessToken;
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$output = curl_exec($ch);
		$outputJsonDecode = json_decode($output,true);
		if ($outputJsonDecode->validation_messages != "") {
			$responsefinal=$outputJsonDecode;
		} else {
			curl_close($ch);
			$responsefinal=$outputJsonDecode;
		}			
		$jsonStr = $data_string;
		apidetails(API_PRODUCT, "1", "CibilFulfilOffer", $responsefinal["result"]["cibil_id"], $url, API_VERSION, $data_string, $output, $responsefinal["result"]["cibil_status"], "");
	}
	else
	{
		$responsefinal="wishfin Oauth not set";
	}

	//echo $responsefinal;
	//print_r($responsefinal);
	return($responsefinal);
}

//***************************************************************************************/
/////////////////////////FULFIL OFFER END////////////////////////////////////
/***************************************************************************************/


//***************************************************************************************/
/////////////////////////AUTHENTICATE QUESTIONS////////////////////////////////////
/***************************************************************************************/

function CibilAuthenticationQuest($cibilid,$apiname)
{
	/********Check for Oauth******/
	$oauthReturn = OauthConnection();
	//print_r($oauthReturn);
	$oauthAccessToken = $oauthReturn['access_token'];
	$oauthExpiresIn = $oauthReturn['expires_in'];
	$oauthTokenType = $oauthReturn['token_type'];
	/********Check for Oauth END******/
	if(isset($oauthAccessToken) && isset($oauthTokenType) && isset($oauthExpiresIn))
	{
		$ch = curl_init();
		$url = API_URL . $apiname."/".$cibilid;
		$data = array(
			"cibilid" => $cibilid,
			);
		$data_string = json_encode($data);
		$header = array();
		$header[] = 'Content-type: application/json';
		$header[] = 'Authorization: ' . $oauthTokenType . " " . $oauthAccessToken;
		
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$output = curl_exec($ch);
		$outputJsonDecode = json_decode($output, true);
		
		if ($outputJsonDecode->validation_messages != "") {
			$responsefinal=$outputJsonDecode;
		} else {
			curl_close($ch);
			
			$responsefinal=$outputJsonDecode;
		}
			
		$jsonStr = $data_string;
		apidetails(API_PRODUCT, "1", "CibilAuthenticationQuest", $cibilid, $url, API_VERSION, $data_string, $output, $responsefinal["result"]["cibil_status"], "");
	}
	else
	{
		$responsefinal="wishfin Oauth not set";
	}
return($responsefinal);
}
//***************************************************************************************/
/////////////////////////AUTHENTICATE QUESTIONS END//////////////////////
/***************************************************************************************/

//***************************************************************************************/
/////////////////////////VERIFY QUESTIONS//////////////////////
/***************************************************************************************/
function CibilVerifyQuest($reqddata, $cibilid, $apiname)
{
	/********Check for Oauth******/
	$oauthReturn = OauthConnection();
	//print_r($oauthReturn);
	$oauthAccessToken = $oauthReturn['access_token'];
	$oauthExpiresIn = $oauthReturn['expires_in'];
	$oauthTokenType = $oauthReturn['token_type'];
	/********Check for Oauth END******/
	if(isset($oauthAccessToken) && isset($oauthTokenType) && isset($oauthExpiresIn))
	{
	$ch = curl_init();
	$url = API_URL . $apiname;
	/*$data = array(
		"cibil_id" => $cibilid,
		"answers" => array(
			"question_key" => $questionkey,
			"answer_key" => $answerkey,
			"user_input_answer" => $userinput,
			"skip" => $skip,
			"resend" => $resend,
		));*/
	$data_string = json_encode($reqddata);
	$header = array();
	$header[] = 'Content-type: application/json';
	$header[] = 'Authorization: ' . $oauthTokenType . " " . $oauthAccessToken;

	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$output = curl_exec($ch);
	$outputJsonDecode = json_decode($output, true);
	
	if ($outputJsonDecode->validation_messages != "") {
	$responsefinal=$outputJsonDecode;
	} else {
		curl_close($ch);
		$responsefinal=$outputJsonDecode;
	}
	$jsonStr = $data_string;

	apidetails(API_PRODUCT, "1", "CibilVerifyQuest", $cibilid, $url, API_VERSION, $data_string, $output, $responsefinal["result"]["cibil_status"], "");
	}
	else
	{
		$responsefinal="wishfin Oauth not set";
	}
	return($responsefinal);	
} // cibil verify question end
//***************************************************************************************/
/////////////////////////VERIFY QUESTIONS END//////////////////////
/***************************************************************************************/

//***************************************************************************************/
/////////////////////////CUSTOME ASSETS//////////////////////
/***************************************************************************************/
function CibilCustomerAssets($cibilid,$apiname)
{
	//echo "in function";
	/********Check for Oauth******/
	$oauthReturn = OauthConnection();
	//print_r($oauthReturn);
	$oauthAccessToken = $oauthReturn['access_token'];
	$oauthExpiresIn = $oauthReturn['expires_in'];
	$oauthTokenType = $oauthReturn['token_type'];
	/********Check for Oauth END******/
	if(isset($oauthAccessToken) && isset($oauthTokenType) && isset($oauthExpiresIn))
	{
		$ch = curl_init();
		$url = API_URL . $apiname;
		$data = array(
			"cibil_id" => $cibilid
			//"show_report_xml" => "false"
			);
		$data_string = json_encode($data);
		$header = array();
		$header[] = 'Content-type: application/json';
		$header[] = 'Authorization: ' . $oauthTokenType . " " . $oauthAccessToken;
		
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$output = curl_exec($ch);
		$outputJsonDecode = json_decode($output, true);
		
		if ($outputJsonDecode->validation_messages != "") {
			$responsefinal=$outputJsonDecode->validation_messages;
		} else {
			curl_close($ch);
			$responsefinal=$outputJsonDecode;
		}
	
			$jsonStr = $data_string;

		//apidetails($product, $productid, "CibilCustomerAssets", $cibilid, $url, API_VERSION, $data_string, $output, $outputJsonDecode["result"]["cibil_status"], $outputJsonDecode["result"]["cibil_score"]);
		apidetails(API_PRODUCT, "1", "CibilCustomerAssets", $cibilid, $url, API_VERSION, $data_string, $output, $responsefinal["result"]["cibil_status"], $responsefinal["result"]["cibil_score"]);
	}
	else
	{
		$responsefinal="wishfin Oauth not set";
	}

	return($responsefinal);
}
//***************************************************************************************/
/////////////////////////CUSTOME ASSETS END//////////////////////
/***************************************************************************************/


/**********************************/
////////////////read Response////////////////////
/**********************************/
function ResponseView($cibilid, $apiresponse, $apiname, $next_api_call)
{
	//echo "RESPONSE VIEW";
	//print_R($apiresponse);
	//echo "<br>";
	$apiresponseArray = $apiresponse;

	if($apiresponseArray["status"]=="success" && ($apiresponseArray["result"]['cibil_status']=="InProgress" || $apiresponseArray["result"]['cibil_status']=="Pending"))
	{
		$questionsarray=$apiresponseArray["result"]['questions']; 
		//print_R($questionsarray);
		//echo "<br>";
		
			if($questionsarray['AnswerChoice']['Key']=="USER_TO_INPUT_ANSWER")
			{
				$multiArray=0;
			}
			else
			{
				$multiArray=1;
			}
		$respoonseview="";
		if($apiname=="CibilAuthenticationQuest")
		{ 
			//$respoonseview="<form name='CibilAuthenticationQuest' method='POST' action='/api/v1/cibil/cibil_verifyvalues.php'>";
			$respoonseview="<form name='CibilAuthenticationQuest' id='CibilAuthenticationQuest' method='POST' >";
			$respoonseview.="<input type='hidden' name='apicall' value='".$next_api_call."'>";
			$respoonseview.="<input type='hidden' name='cibilid' value='".$cibilid."'>";
		if($multiArray==1)
		{
			$respoonseview.="<input type='hidden' name='qnacount' value='".count($questionsarray)."'>";
		for($i=0;$i<count($questionsarray);$i++)
		{	//	print_R($questionsarray[$i]);
			if($questionsarray[$i]["AnswerChoice"]['Key']=="USER_TO_INPUT_ANSWER")
			{	$datatype="multi";
				//$inputtype="textbox";
					$respoonseview.="<br><br>Question: ".$questionsarray[$i]['FullQuestionText']."<br>";
					$respoonseview.="<input type='hidden' value=".$questionsarray[$i]['Key']." name='questionkey_".$i."'><br>";
					$answersarray=$questionsarray[$i]['AnswerChoice'];
					$respoonseview.="<input type='input' name='user_input_answer_".$i."' ><br>";
					$respoonseview.="<input type='hidden' value='".$answersarray['AnswerChoiceId']."' name='answerkey_".$i."'>";
					if($questionsarray[$i]['skipEligible']=="true")
					{
						$respoonseview.="<input type='checkbox' name='skipEligible_".$i."' value='skip' >Skip<br>";
					}
					if($questionsarray[$i]['resendEligible']=="c")
					{
						$respoonseview.="<input type='checkbox' name='resendEligible_".$i."' value='resend' >Resend<br>";
					}				
			}
			else
			{
				$datatype="multichoice";
				$respoonseview.="<br><br>Question: ".$questionsarray[$i]['FullQuestionText']."<br>";
				$respoonseview.="<input type='hidden' value=".$questionsarray[$i]['Key']." name='questionkey_".$i."'><br>";
				$answersarray=$questionsarray[$i]['AnswerChoice'];
				for($j=0;$j<count($answersarray);$j++)
				{
					 $answersoption=$answersarray[$j];
					// print_R($answersoption);
					$respoonseview.=" <input type='radio' name='answerkey_".$i."' value='".$answersarray[$j]['AnswerChoiceId']."_".$answersarray[$j]['Key']."'>".$answersoption['AnswerChoiceText']."<br>";
				}
				if($questionsarray[$i]['skipEligible']=="true")
				{
					$respoonseview.="<input type='radio' name='answerkey_".$i."' value='".$answersarray[$j]['AnswerChoiceId']."_skip' >Skip<br>";
				}
				if($questionsarray[$i]['resendEligible']=="true")
				{
					$respoonseview.="<input type='radio' name='answerkey_".$i."' value='".$answersarray[$j]['AnswerChoiceId']."_resend' >Resend<br>";
				}
			}
		}
			$respoonseview.="<input type='hidden' name='datatype' value='".$datatype."'>";
		}
		else
		{	
			$respoonseview.="<input type='hidden' name='datatype' value='single'>";
			$respoonseview.="<br><br>Question: ".$questionsarray['FullQuestionText']."<br>";
					$respoonseview.="<input type='hidden' value=".$questionsarray['Key']." name='questionkey'><br>";
					$answersarray=$questionsarray['AnswerChoice'];
					$respoonseview.="<input type='input' name='user_input_answer' ><br>";
					$respoonseview.="<input type='hidden' value='".$questionsarray['AnswerChoice']['AnswerChoiceId']."' name='answerkey'>";
					if($questionsarray['skipEligible']=="true")
					{
						$respoonseview.="<input type='checkbox' name='skipEligible' value='skip' >Skip<br>";
					}
					if($questionsarray['resendEligible']=="true")
					{
						$respoonseview.="<input type='checkbox' name='resendEligible' class='resendEligible' value='resend' >resend<br>";
					}
		}
		
		$respoonseview.="<input type='button' name='submit' class='checkEligible' value='Submit'>";
		}
	}
	else
	{
		$respoonseview="Error in getting viewed";
	}
	
	//echo "<br><br>".$respoonseview."<br><br>";
	return($respoonseview);
}

