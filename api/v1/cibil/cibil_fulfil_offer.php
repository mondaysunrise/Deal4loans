<?php
//ini_set("display_errors", "1");
error_reporting(E_ALL);
//define('API_URL', 'http://apibeta.wishfin.com/api/v1/');
//define('API_VERSION', 'UAT');
define('API_VERSION', 'PROD');
//define('API_PRODUCT', 'PL');
require 'cibil_oauth.php';

$errorCode = '';
$errorMessage = '';
$productid = '';

if(isset($_POST["identify"]))
{
	$str=$_POST["data"];
	 parse_str($str,$my_arr);
	  foreach($my_arr as $key=>$value){
		//echo "$key => $value";
	  }
	  $reqddata=$my_arr;
	  $productcode=$reqddata["product"];
	  $productid = $_POST["productid"];

}
else
{
	 $reqddata=$_POST;
	 $productid = $reqddata["productid"];
		$productcode=$reqddata["product"];
}
/********Check for Oauth******/
	$oauthReturn = OauthConnection();
	//print_r($oauthReturn);
	$oauthAccessToken = $oauthReturn['access_token'];
	$oauthExpiresIn = $oauthReturn['expires_in'];
	$oauthTokenType = $oauthReturn['token_type'];
	/********Check for Oauth END******/

if($reqddata["apicall"]=="CibilFulfilOffer")
{
	/*// check cibil score here
	$assetsql ="SELECT cibil_id FROM `api_log_cibil` WHERE (api_from='CibilFulfilOffer' and `api_request_data` like '%".trim($reqddata["Pancard"])."%')";
	list($CheckNumRows,$flg)=Mainselectfunc($assetsql,$array = array());
	$assetcibil_id= $flg["cibil_id"];
	$cibilscoresql ="SELECT cibil_score,cibil_id FROM `api_log_cibil` WHERE (api_from='CibilCustomerAssets' and `cibil_id`='".$assetcibil_id."' and `cibil_score`>1)";
	list($CheckNumRows,$scoreflg)=Mainselectfunc($cibilscoresql,$array = array());
	$cibil_score= $scoreflg["cibil_score"];
	$assetcibil_id= $scoreflg["cibil_id"];

	if(isset($cibil_score) && $assetcibil_id>0)
	{	
		$Assetapiresponse=CibilCustomerAssets($assetcibil_id,"cibil-customer-assets",$productid);

		if(isset($cibil_score))
		{
			$errorMessage="Your Cibil Score: ".$cibil_score;
		}
		else
		{
			$errorMessage="Your Cibil Score: ".$cibil_score;
		}
	}
	else
	{*/
	//check cibil score here end
		$Fulfilofferapiresponse=CibilFulfilOffer($reqddata, $productid, $productcode);
	//}
	print_R($Fulfilofferapiresponse);
	/*********************************************************************/
	if($Fulfilofferapiresponse["status"]=="success")
	{
		$cibilid = $Fulfilofferapiresponse["result"]["cibil_id"];
		$next_api_call = $Fulfilofferapiresponse["result"]["next_api_call"];
		//update at table
		if($productcode=="CreditScore")
		{
		$dataUpdate = array("cibil_id"=>$cibilid);
		$wherecondition = "(id='".$productid."')";
		Mainupdatefunc ('api_customer_cibil', $dataUpdate, $wherecondition);
		}
		//end of update
		if($Fulfilofferapiresponse["status"]=="success" && $Fulfilofferapiresponse["result"]["cibil_status"]=="Success")// for success get score
		{
			//echo "success";
			if($Fulfilofferapiresponse["result"]["cibil_id"]>0)
			{				
				if(empty($next_api_call) || !isset($next_api_call))
				{//{"result":{"cibil_id":"1","cibil_status":"Success","cibil_score":"792","cibil_score_fetch_date":"2017-08-30 15:51:27","cibil_xml_data":null,"file_name":null},"status":"success","message":"ok"}
					if(isset($Fulfilofferapiresponse["result"]["cibil_score"]))
					{
						$errorMessage="Your Cibil Score: ".$Fulfilofferapiresponse["result"]["cibil_score"];
					}
					else
					{
						$errorMessage="Unable to Find";
					}
					
				}
				else
				{
					$Assetapiresponse=CibilCustomerAssets($cibilid,$next_api_call,$productid, $productcode);
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
			}
			else
			{
				$errorMessage="Unable to Find";
			}
			
		}
		elseif($Fulfilofferapiresponse["status"]=="success" && $Fulfilofferapiresponse["result"]["cibil_status"]=="Pending")// for success
		{
			if($next_api_call=="cibil-authentication-questions")
			{
				$apiresponse=CibilAuthenticationQuest($cibilid, $next_api_call, $productid, $productcode);
				$next_api_call = $apiresponse["result"]["next_api_call"];
				echo $responseview = ResponseView($cibilid, $apiresponse, "CibilAuthenticationQuest",$next_api_call, $productcode);
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
				$apiresponse=CibilAuthenticationQuest($cibilid, $next_api_call, $productid, $productcode);
				$next_api_call = $apiresponse["result"]["next_api_call"];
				echo $responseview = ResponseView($cibilid, $apiresponse, "CibilAuthenticationQuest",$next_api_call, $productcode);
			}
			else
			{
				$errorMessage="where to go";
			}
		}
	}
	else
	{
		$errorMessage="Issue at Wishfin API<<71";
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
	$apiresponse=CibilAuthenticationQuest($cibilid, $next_api_call, $productid, $productcode);
	echo $responseview = ResponseView($cibilid, $apiresponse, "CibilAuthenticationQuest",$next_api_call, $productcode);
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
		//value='Skip'
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
			//if(isset($reqddata["skipEligible_".$j]))
			if(empty($user_value))
			{	
				if($reqddata["submit"]=="Skip")
				{
					$addskip=array("skip"=>"true");
					$finalanswers[]=array_merge($answerarr,$addskip);
				}
				else
				{
					$finalanswers[]=$answerarr;
				}
				
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
	
	$apiresponse=CibilVerifyQuest($cibilverifyRequest, $reqddata["cibilid"], "cibil-verify-answers", $productid, $productcode);
	//print_R($apiresponse);
	$cibil_id=$apiresponse["result"]["cibil_id"];

	if($apiresponse["status"]=="success")
	{
		if($apiresponse["result"]["cibil_status"]=="InProgress")
		{
			if($apiresponse["result"]["next_api_call"]=="cibil-authentication-questions" && $cibil_id>0)
			{
				$authapiresponse=CibilAuthenticationQuest($cibil_id,$apiresponse["result"]["next_api_call"], $productid, $productcode);
				if($authapiresponse["status"]=="success")
				{
					echo $responseview = ResponseView($cibil_id, $authapiresponse, "CibilAuthenticationQuest",$authapiresponse["result"]["next_api_call"], $productcode);
				}
				else
				{
					$errorMessage="Issue at Wishfin API<<142";
				}
			}
		}
		elseif($apiresponse["result"]["cibil_status"]=="Success")
		{
			$Assetapiresponse=CibilCustomerAssets($cibil_id, "cibil-customer-assets",$productid, $productcode);
			if($Assetapiresponse["status"]=="success")
			{
				if($Assetapiresponse["result"]["cibil_status"]=="Success")
				{
					$errorMessage="Your Cibil Score:".$Assetapiresponse["result"]["cibil_score"];
				}
				else
				{
					$errorMessage="Issue at Cibil";
				}
			}
			else
			{
				$errorMessage="Failed at Cibil API";
			}
		}
		else
		{
			$errorMessage="Failed at Cibil API";
		}
	}
	else
	{
		$errorMessage="Issue at Wishfin API";
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
function CibilFulfilOffer($reqddata,$productid, $productcode)
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
		/*if(isset($reqddata["Full_Name"]))
		{
		$name = explode(" ",trim($reqddata["Full_Name"]));
		$firstname = $name[0];
		$middlename = "";
		$lastname = $name[1];
		}
		else
		{*/
		if($IP_Remote=='192.124.249.12' || $IP_Remote=='185.93.228.12') { $IP= $_SERVER['HTTP_X_SUCURI_CLIENTIP']; }
	else { $IP= $IP_Remote;	}
			$firstname = $reqddata["first_name"];
			$middlename = $reqddata["middle_name"];
			$lastname = $reqddata["last_name"];
		//}
		$panno = trim($reqddata["Pancard"]);
		$dob = trim($reqddata["DOB"]);
		$mobileno = trim($reqddata["Mobile_Number"]);
		$email = trim($reqddata["Email"]);
		$gender = $reqddata["Gender"];
		$city = $reqddata["City"];

		$state= $reqddata["StateCode"];
		$StateCode = str_pad($state,2,"0",STR_PAD_LEFT);
		$statecode = $StateCode;
		$residence_address = substr(trim($reqddata["Residence_Address"]),0,120);
		$resi_pincode = $reqddata["Pincode"];

		$ch = curl_init();
		$url = API_URL . 'cibil-fulfill-order';
		$data = array(
			"first_name" => $firstname,
			"middle_name" => $middlename,
			"last_name" => $lastname,
			"pancard" => strtoupper($panno),
			"date_of_birth" => $dob,
			"mobile_number" => $mobileno,
			"email_id" => $email,
			"gender" => $gender,
			"city_name" => $city,
			"state_code" => $statecode,
			"residence_address" => $residence_address,
			"residence_pincode" => $resi_pincode,
			"legal_response" => "Accept",
		     "source" => "deal4loans",
         "show_report_xml" => true
		);
		$data_string = json_encode($data);
		$header = array();
		$header[] = 'Content-type: application/json';
		$header[] = 'Authorization: ' . $oauthTokenType . " " . $oauthAccessToken;
		//echo '<pre>';print_r($header);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_TIMEOUT, 100);
		$output = curl_exec($ch);
		//echo '<pre>';print_r($output);exit;
		$outputJsonDecode = json_decode($output,true);
		if ($outputJsonDecode->validation_messages != "") {
			$responsefinal=$outputJsonDecode;
		} else {
			curl_close($ch);
			$responsefinal=$outputJsonDecode;
		}			
		$jsonStr = $data_string;
		if(isset($responsefinal["result"]["cibil_score"]))
		{
			apidetails($productcode, $productid, "CibilFulfilOfferf", $responsefinal["result"]["cibil_id"], $url, API_VERSION, $data_string, $output, $responsefinal["result"]["cibil_status"], $responsefinal["result"]["cibil_score"], $responsefinal["result"]["cibil_score_fetch_date"]);
		}
		else
		{
			apidetails($productcode, $productid, "CibilFulfilOffer", $responsefinal["result"]["cibil_id"], $url, API_VERSION, $data_string, $output, $responsefinal["result"]["cibil_status"], "","");
		}
	}
	else
	{
		$responsefinal="wishfin Oauth not set";
	}

	//print_r($responsefinal);
	return($responsefinal);
}

//***************************************************************************************/
/////////////////////////FULFIL OFFER END////////////////////////////////////
/***************************************************************************************/


//***************************************************************************************/
/////////////////////////AUTHENTICATE QUESTIONS////////////////////////////////////
/***************************************************************************************/

function CibilAuthenticationQuest($cibilid,$apiname,$productid, $productcode)
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
		apidetails($productcode, $productid, "CibilAuthenticationQuest", $cibilid, $url, API_VERSION, $data_string, $output, $responsefinal["result"]["cibil_status"], "", "");
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
function CibilVerifyQuest($reqddata, $cibilid, $apiname, $productid, $productcode)
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
		));
		*/
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

		apidetails($productcode, $productid, "CibilVerifyQuest", $cibilid, $url, API_VERSION, $data_string, $output, $responsefinal["result"]["cibil_status"], "", "");
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
function CibilCustomerAssets($cibilid,$apiname,$productid, $productcode)
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
		$data = array(
			"cibil_id" => $cibilid,
			"show_report_xml" => "true"
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

		apidetails($productcode, $productid, "CibilCustomerAssets", $cibilid, $url, API_VERSION, $data_string, $output, $responsefinal["result"]["cibil_status"], $responsefinal["result"]["cibil_score"], $responsefinal["result"]["cibil_score_fetch_date"]);
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
function ResponseView($cibilid, $apiresponse, $apiname, $next_api_call, $productcode)
{
	//echo "RESPONSE VIEW";
	//print_R($apiresponse);
	//echo "<br>";
	$apiresponseArray = $apiresponse;

	if($apiresponseArray["status"]=="success" && ($apiresponseArray["result"]['cibil_status']=="InProgress" || $apiresponseArray["result"]['cibil_status']=="Pending"))
	{
		$questionsarray=$apiresponseArray["result"]['questions'];
		
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
			$respoonseview="<form name='CibilAuthenticationQuest' id='CibilAuthenticationQuest' method='POST'>";
			$respoonseview.="<input type='hidden' name='apicall' value='".$next_api_call."'>";
			$respoonseview.="<input type='hidden' name='cibilid' value='".$cibilid."'>";
			$respoonseview.="<input type='hidden' name='product' value='".$productcode."'>";
			$respoonseview.="<table align='center' border='0' cellpadding='0' cellspacing='0' width='90%'>";
			//$respoonseview.="<tr align='center' bgcolor='#f4f4f4'><td height='35' colspan='2' class='bldtxt' style='font-size:13px; font-family:Verdana, Arial, Helvetica, sans-serif;'> Personal Loan Quote Request</td></tr>";
			//$respoonseview.="<tr><td><img src='/new-images/cibil-logo.png' alt='Logo'></td></tr>";
			$respoonseview.="<tr><td height='10' colspan='2'></td></tr>";
			if($multiArray==1)
			{
				$respoonseview.="<input type='hidden' name='qnacount' value='".count($questionsarray)."'>";
				for($i=0;$i<count($questionsarray);$i++)
				{
					$questioncount=count($questionsarray);
					if($questionsarray[$i]["AnswerChoice"]['Key']=="USER_TO_INPUT_ANSWER")
					{
						$datatype="multi";
						$respoonseview.="<tr>";
						$respoonseview.="<td class='question-text' height='35'>".$questionsarray[$i]['FullQuestionText']."</td>";
						$respoonseview.="<input type='hidden' value=".$questionsarray[$i]['Key']." name='questionkey_".$i."'>";
						$respoonseview.="</tr>";
						$answersarray=$questionsarray[$i]['AnswerChoice'];
						$respoonseview.="<tr><td><input type='text' class='emi_input' name='user_input_answer_".$i."' ></td></tr>";
						$respoonseview.="<input type='hidden' value='".$answersarray['AnswerChoiceId']."' name='answerkey_".$i."'>";
						
					/*if($questionsarray[$i]['skipEligible']=="true")
						{
							$respoonseview.="<tr>";
							$respoonseview.="<td colspan='2'> <input type='checkbox' name='skipEligible_".$i."' value='skip' >Skip</td>";
							$respoonseview.="</tr>";
						}*/
						if($questionsarray[$i]['resendEligible']=="true")
						{
							$respoonseview.="<tr>";
							$respoonseview.="<td colspan='2'><input type='checkbox' name='resendEligible_".$i."' value='resend' >Resend</td>";
							$respoonseview.="</tr>";
						}
					}
					else
					{
						$datatype="multichoice";
						$respoonseview.="<tr>";
						$respoonseview.="<td class='question-text' height='35'>".$questionsarray[$i]['FullQuestionText']."</td>";
						$respoonseview.="<input type='hidden' value=".$questionsarray[$i]['Key']." name='questionkey_".$i."'>";
						$answersarray=$questionsarray[$i]['AnswerChoice'];
						$respoonseview.="</tr>";
						
						for($j=0;$j<count($answersarray);$j++)
						{
							 $answersoption=$answersarray[$j];
							// print_R($answersoption);
							$respoonseview.="<tr><td>";
							$respoonseview.="<input type='radio' name='answerkey_".$i."' value='".$answersarray[$j]['AnswerChoiceId']."_".$answersarray[$j]['Key']."'>".$answersoption['AnswerChoiceText']." ";
							$respoonseview.="</td></tr>";
						}
						
						if($questionsarray[$i]['skipEligible']=="true")
						{
							$respoonseview.="<tr>";
							$respoonseview.="<td colspan='2'><input type='radio' name='answerkey_".$i."' value='".$answersarray[$j]['AnswerChoiceId']."_skip' >Skip</td>";
							$respoonseview.="</tr>";
						}
						if($questionsarray[$i]['resendEligible']=="true")
						{
							$respoonseview.="<tr>";
							$respoonseview.="<td colspan='2'><input type='radio' name='answerkey_".$i."' value='".$answersarray[$j]['AnswerChoiceId']."_resend' >Resend</td>";
							$respoonseview.="</tr>";
						}
					}
				}
				$respoonseview.="<input type='hidden' name='datatype' id='".$datatype."' value='".$datatype."'>";
				if($questioncount>1 && $datatype=="multi")
				{
					$activateskip=1;
				}
			}
			else
			{	
				$respoonseview.="<input type='hidden' name='datatype' value='single' id='single'>";
				$respoonseview.="<tr>";
				$respoonseview.="<td class='question-text' height='35'>".$questionsarray['FullQuestionText']."</td>";
				$respoonseview.="</tr>";
				$respoonseview.="<input type='hidden' value=".$questionsarray['Key']." name='questionkey'>";
				$answersarray=$questionsarray['AnswerChoice'];
				$respoonseview.="<tr><td><input type='text' class='emi_input' name='user_input_answer' ></td></tr>";
				$respoonseview.="<input type='hidden' value='".$questionsarray['AnswerChoice']['AnswerChoiceId']."' name='answerkey'>";
				//$respoonseview.="</tr>";
				if($questionsarray['skipEligible']=="true")
				{
					$respoonseview.="<tr>";
					$respoonseview.="<td colspan='2'><input type='checkbox' name='skipEligible' value='skip' >Skip</td>";
					$respoonseview.="</tr>";
				}
				if($questionsarray['resendEligible']=="true")
				{
					$respoonseview.="<tr>";
					$respoonseview.="<td colspan='2'><input type='checkbox' name='resendEligible' class='resendEligible' id='resend' value='resend' >resend</td>";
					$respoonseview.="</tr>";
				}
			}
			if($activateskip==1)
			{
			$respoonseview.="<tr><td># Provide any 2 details</td></tr>";
			}
			$respoonseview.="<tr><td colspan='2'><input type='button' name='submit' class='checkEligible submit-btn-cibil' id='Submit' value='Submit'>";
			if($activateskip==1)
			{
			$respoonseview.="&nbsp;&nbsp;<input type='button' name='submit' class='checkEligible submit-btn-cibil' value='Skip'>";
			}
			$respoonseview.="</td></tr>";
			$respoonseview.="<tr align='right'><td><img src='/new-images/cibil-logo.png' alt='Logo'></td></tr>";
			$respoonseview.="<tr><td colspan='2'><div id='loading1'></div></td></tr>";
			$respoonseview.="</table>";
			$respoonseview.="</form>";
		}
	}
	else
	{
		$respoonseview="Error in getting viewed";
	}
	
	//echo "<br><br>".$respoonseview."<br><br>";
	return($respoonseview);
}

