<?php
	require 'scripts/db_init.php';
	require 'scripts/functionshttps.php';
	
/*
******************************************************************
			* COMPANY    - FSS Pvt. Ltd.
*****************************************************************

Name of the Program : Hosted UMI Sample Pages
Page Description    : Receives response from Payment Gateway and handles the same
Response parameters : Result,Ref,Transaction id, Payment id,Auth Code, Track ID,
                      Amount,avr(optional), UDF1-UDF5,Error
Values from Session : No
Values to Session   : No
Created by          : FSS Payment Gateway Team
Created On          : 30-04-2012
Version             : Version 3.0

***************************************************************** 
*/
/* Disclaimer:- Important Note in Sample Pages
- This is a sample demonstration page only ment for demonstration, this page should not be used in production
- Transaction data should only be accepted once from a browser at the point of input, and then kept in a way that does not allow others to modify it (example server session, database  etc.)
- Any transaction information displayed to a customer, such as amount, should be passed only as display information and the actual transactional data should be retrieved from the secure source last thing at the point of processing the transaction.
- Any information passed through the customer's browser can potentially be modified/edited/changed/deleted by the customer, or even by third parties to fraudulently alter the transaction data/information. Therefore, all transaction information should not be passed through the browser to Payment Gateway in a way that could potentially be modified (example hidden form fields). 
*/

try
{
	/* Capture the IP Address from where the response has been received */
	//$strResponseIPAdd = getenv('REMOTE_ADDR');
	$strResponseIPAdd = getenv("HTTP_X_FORWARDED_FOR");

	/* Check whether the IP Address from where response is received is PG IP */
	
	//if($strResponseIPAdd == "221.134.101.174" || $strResponseIPAdd == "221.134.101.169")//Demo
	if($strResponseIPAdd == "221.134.101.175" || $strResponseIPAdd == "221.134.101.166" || $strResponseIPAdd == "221.134.101.187")
	{
	//====================================================================================================================================	
		$ResErrorText= isset($_POST['ErrorText']) ? $_POST['ErrorText'] : ''; 	//Error Text/message
		$ResPaymentId = isset($_POST['paymentid']) ? $_POST['paymentid'] : '';	//Payment Id
		$ResTrackID = isset($_POST['trackid']) ? $_POST['trackid'] : '';        //Merchant Track ID
		$ResErrorNo = isset($_POST['Error']) ? $_POST['Error'] : '';            //Error Number

		//To collect transaction result
		$ResResult = isset($_POST['result']) ? $_POST['result'] : '';           //Transaction Result
		$ResPosdate = isset($_POST['postdate']) ? $_POST['postdate'] : '';      //Postdate
		//To collect Payment Gateway Transaction ID, this value will be used in dual verification request
		$ResTranId = isset($_POST['tranid']) ? $_POST['tranid'] : '';           //Transaction ID
		$ResAuth = isset($_POST['auth']) ? $_POST['auth'] : '';                 //Auth Code		
		$ResAVR = isset($_POST['avr']) ? $_POST['avr'] : '';                    //TRANSACTION avr					
		$ResRef = isset($_POST['ref']) ? $_POST['ref'] : '';                    //Reference Number also called Seq Number
		//To collect amount from response
		$ResAmount = isset($_POST['amt']) ? $_POST['amt'] : '';                 //Transaction Amount

		$Pid = isset($_POST['udf1']) ? $_POST['udf1'] : '';                  //UDF1  - pack_id
		$Resudf2 = isset($_POST['udf2']) ? $_POST['udf2'] : '';                  //UDF2  - email
		$Resudf3 = isset($_POST['udf3']) ? $_POST['udf3'] : '';                  //UDF3  - Contact Number
		$Resudf4 = isset($_POST['udf4']) ? $_POST['udf4'] : '';              	 //UDF4  - Billing Address
		$Rid = isset($_POST['udf5']) ? $_POST['udf5'] : '';              	 //UDF5  - Rid
		//	print_r($_REQUEST);
		//	exit();		
		
		
		if($ResResult == 'CAPTURED' || $ResResult == 'APPROVED')
		{
			$purchase_status = 'success';
		}
		else
		{
			$purchase_status ='failure';
		}

		$Dated = ExactServerdate();
		$DataArray = array("purchase_status"=>$purchase_status , "response_dt"=>$Dated , "ResResult"=>$ResResult, "ResTrackId"=>$_POST['trackid'], "ResPaymentId"=>$ResPaymentId , "ResRef"=>$ResRef , "ResTranId"=>$ResTranId, "ResError"=>$ResErrorText , "ResAmount"=>$ResAmount , "message"=>$message);
		$wherecondition ="(Rid=".$Rid.")";
		Mainupdatefunc ('package_purchase_details', $DataArray, $wherecondition);
		
	
		//LIST OF PARAMETERS RECEIVED BY MERCHANT FROM PAYMENT GATEWAY ENDS HERE 
	//====================================================================================================================================	
              
	/* Merchant (ME) checks, if error number is NOT present, then create Dual Verification 
	request, send to Paymnent Gateway. ME SHOULD ONLY USE PAYMENT GATEWAY TRAN ID FOR DUAL
	VERIFICATION */
    /* NOTE - MERCHANT MUST LOG THE RESPONSE RECEIVED IN LOGS AS PER BEST PRACTICE */

		if ($ResErrorNo == '')
		{
			           
			//check result is captured or approved i.e. successful
			if ($ResResult == 'CAPTURED' || $ResResult == 'APPROVED')
			{
				
				//==========================================================================================
				//==================PARAMETER VALIDATION CODE ===================================================
				/*
				//The Below condition will check the Required Parameter From PG side Blank or not,if any field is blank
				//in the below condition then it will redirected to Failed pages with proper message.
				*/
				if ($ResPaymentId == '' || $ResTrackID == '' || $ResTranId == '' || $ResAuth == '' || $ResRef == '' || $ResAmount == '')
				{
					$DataArray = array( "message"=>'PARMETER VALIDATION FAILED');
					$wherecondition ="(Rid=".$Rid.")";
					Mainupdatefunc ('package_purchase_details', $DataArray, $wherecondition);

					$REDIRECT = 'REDIRECT=https://www.deal4loans.com/FailedTRAN.php?Message=PARMETER VALIDATION FAILED&Rid='.$Rid.'&Pid='.$Pid;
					echo $REDIRECT;
				}
				else
				{	
				//===================PARAMETER VALIDATION CONDITION END=========================================
									
					//If result is CAPTURED or APPROVED then below Code is execute for dual inquiry 
			   	 
					//ID given by bank to Merchant (Tranportal ID), same iD that was passed in initial request
					$ReqTranportalId = "<id>70004798</id>";

					//Password given by bank to merchant (Tranportal Password), same password that was passed in initial request
					$ReqTranportalPassword = "<password>70004798</password>";

					// Pass DUAL VERIFICATION action code, always pass "8" for DUAL VERIFICATION
					$INQAction = "<action>8</action>";

					//Pass PG Transaction ID for Dual Verification
					$INQTransId  = "<transid>".$ResTranId."</transid>"; 
								
					//create string for request of input parameters
					$INQRequest=$ReqTranportalId.$ReqTranportalPassword.$INQAction.$INQTransId;

					//DUAL VERIFIACTION URL, this is test environment URL, contact bank for production DUAL Verification URL
					$INQUrl = "https://securepg.fssnet.co.in/pgway/servlet/TranPortalXMLServlet";
			     	//$INQUrl = "https://securepg.fssnet.co.in/pgway/servlet/PaymentInitHTTPServlet";
					
					//PHP FUNCTION for connection and posting the request ..starts here
					$dvreq = curl_init() or die(curl_error()); 
					curl_setopt($dvreq, CURLOPT_POST,1); 
					curl_setopt($dvreq, CURLOPT_POSTFIELDS,$INQRequest); 
					curl_setopt($dvreq, CURLOPT_URL,$INQUrl); 
					curl_setopt($dvreq, CURLOPT_PORT, 443);
					curl_setopt($dvreq, CURLOPT_RETURNTRANSFER, 1); 
					curl_setopt($dvreq, CURLOPT_SSL_VERIFYHOST,0); 
					curl_setopt($dvreq, CURLOPT_SSL_VERIFYPEER,0); 
					$dataret=curl_exec($dvreq) or die(curl_error());
					curl_close($dvreq); 
					//PHP FUNCTION for connection and posting the request ..ends here

					//XML response received for DUAL VERIFICATION.
					/* 
					NOTE - MERCHANT MUST LOG THE RESPONSE RECEIVED IN LOGS AS PER BEST PRACTICE
					*/
					$TranInqResponse = $dataret;
					//print_r $DVresponse;
					$GEnXMLForm="<xmltg>".$TranInqResponse."</xmltg>";
					$xmlSTR = simplexml_load_string( $GEnXMLForm,null,true);
               
					//Collect DUAL VERIFICATION RESULT
					$INQCheck = $xmlSTR-> result;
               
					//If DUAL VERIFICATION RESULT is CAPTURED or APPROVED or SUCCESS
					if ($INQCheck == 'CAPTURED' || $INQCheck == 'APPROVED' || $INQCheck == 'SUCCESS')
					{
									  
						//Collect DUAL VERIFICATION RESULT
																		
						$INQResResult = $xmlSTR->result;//It will give DualInquiry Result 
						$INQResAmount = $xmlSTR->amt;//It will give Amount
						$INQResTrackId = $xmlSTR->trackid;//It will give TrackID ENROLLED
						$INQResPayid = $xmlSTR->payid;//It will give payid
						$INQResRef = $xmlSTR->ref;//It will give Ref.NO.
						$INQResTranid = $xmlSTR->tranid;//It will give tranid
						//MERCHANT CAN GET ALL VERIFICATION RESULT PARAMETERS USING BELOW CODE 
						/*
						$INQResAutht = $xmlSTR->auth;//It will give Auth 
						$INQResAvr = $xmlSTR->avr;//It will give AVR 
						$INQResPostdate = $xmlSTR->postdate;//It will give  postdate
						$INQResUdf1 = $xmlSTR->udf1;//It will give udf1
						$INQResUdf2 = $xmlSTR->udf2;//It will give udf2
						$INQResUdf3 = $xmlSTR->udf3;//It will give udf3
						$INQResUdf4 = $xmlSTR->udf4;//It will give udf4
						$INQResUdf5 = $xmlSTR->udf5;//It will give udf5
						*/
			  
						/*
						IMPORTANT NOTE - MERCHANT DOES RESPONSE HANDLING AND VALIDATIONS OF 
						TRACK ID, AMOUNT AT THIS PLACE. THEN ONLY MERCHANT SHOULD UPDATE 
						TRANACTION PAYMENT STATUS IN MERCHANT DATABASE AT THIS POSITION 
						AND THEN REDIRECT CUSTOMER ON RESULT PAGE
						*/
			  
						/* !!IMPORTANT INFORMATION!!
						During redirection, ME can pass the values as per ME requirement.
						NOTE: NO PROCESSING should be done on the RESULT PAGE basis of values passed in the RESULT PAGE from this page. 
						ME does all validations on the responseURL page and then redirects the customer to RESULT 
						PAGE ONLY FOR RECEIPT PRESENTATION/TRANSACTION STATUS CONFIRMATION
						For demonstration purpose the result and track id are passed to Result page
						*/
					
						$REDIRECT = 'REDIRECT=https://www.deal4loans.com/StatusTRAN.php?ResResult='.$INQResResult.'&ResTrackId='.$INQResTrackId.'&ResAmount='.$INQResAmount.'&ResPaymentId='.$INQResPayid.'&ResRef='.$INQResRef.'&ResTranId='.$INQResTranid.'&ResError='.$ResErrorText.'&Rid='.$Rid.'&Pid='.$Pid;
						
						//$Resudf1
						echo $REDIRECT;
								  
					}
					else
					{
						/*
						ERROR IN TRANSACTION PROCESSING
						IMPORTANT NOTE - MERCHANT SHOULD UPDATE 
						TRANACTION PAYMENT STATUS IN MERCHANT DATABASE AT THIS POSITION 
						AND THEN REDIRECT CUSTOMER ON RESULT PAGE
						*/
						$DataArray = array( "message"=>'Transaction Failed line209');
						$wherecondition ="(Rid=".$Rid.")";
						Mainupdatefunc ('package_purchase_details', $DataArray, $wherecondition);

						$REDIRECT = 'REDIRECT=https://www.deal4loans.com/FailedTRAN.php?Message=Transaction Failed&ResTrackId='.$ResTrackID.'&ResAmount='.$ResAmount.'&ResError='.$INQCheck.'&Rid='.$Rid.'&Pid='.$Pid;														
						                                           
						echo $REDIRECT;
													
					}

				}
			}
			else
			{

				/*
				IMPORTANT NOTE - MERCHANT SHOULD UPDATE 
				TRANACTION PAYMENT STATUS IN MERCHANT DATABASE AT THIS POSITION 
				AND THEN REDIRECT CUSTOMER ON RESULT PAGE
				*/
				$REDIRECT = 'REDIRECT=https://www.deal4loans.com/StatusTRAN.php?ResResult='.$ResResult.'&ResTrackId='.$ResTrackID.'&ResAmount='.$ResAmount.'&ResPaymentId='.$ResPaymentId.'&ResRef='.$ResRef.'&ResTranId='.$ResTranId.'&ResError='.$ResErrorText.'&Rid='.$Rid.'&Pid='.$Pid;
//				$Resudf1
				echo $REDIRECT;
						
			}
		}
		else 
		{
		/*
		ERROR IN TRANSACTION PROCESSING
		IMPORTANT NOTE - MERCHANT SHOULD UPDATE 
		TRANACTION PAYMENT STATUS IN MERCHANT DATABASE AT THIS POSITION 
		AND THEN REDIRECT CUSTOMER ON RESULT PAGE
		*/
		$DataArray = array( "message"=>'Transaction Failed line241');
		$wherecondition ="(Rid=".$Rid.")";
		Mainupdatefunc ('package_purchase_details', $DataArray, $wherecondition);

		$REDIRECT = 'REDIRECT=https://www.deal4loans.com/FailedTRAN.php?Message=Transaction Failed&ResTrackId='.$ResTrackID.'&ResAmount='.$ResAmount.'&ResError='.$ResErrorText.'&Rid='.$Rid.'&Pid='.$Pid;
		echo $REDIRECT;
		}
	}
	else
	{
		/*
		IMPORTAN NOTE - IF IP ADDRESS MISMATCHES, ME LOGS DETAILS IN LOGS,
		UPDATES MERCHANT DATABASE WITH PAYMENT FAILURE, REDIRECTS CUSTOMER 
		ON FAILURE PAGE WITH RESPECTIVE MESSAGE
		*/
		/*
		<!-- 
		to get the IP Address in case of proxy server used
		function getIPfromXForwarded() { 
		$ipString=@getenv("HTTP_X_FORWARDED_FOR"); 
		$addr = explode(",",$ipString); 
		return $addr[sizeof($addr)-1]; 
		} 
		*/
		if(!isset($Rid))
		{
			header("Location: agentregistration.php");
			exit();
		}
		$DataArray = array( "message"=>'IP MISSMATCH');
		$wherecondition ="(Rid=".$Rid.")";
		Mainupdatefunc ('package_purchase_details', $DataArray, $wherecondition);

		$REDIRECT = 'REDIRECT=https://www.deal4loans.com/FailedTRAN.php?Message=--IP MISSMATCH-- Response IP Address is: '.$strResponseIPAdd.'&Rid='.$Rid.'&Pid='.$Pid;
		echo $REDIRECT;
	}
}
catch(Exception $e)
{
	var_dump($e->getMessage());
}
?>