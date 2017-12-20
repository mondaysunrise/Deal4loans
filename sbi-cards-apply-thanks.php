<?php
require 'scripts/db_init.php';
require 'webservices_functions.php';
require 'validation_functions.php';

//error_reporting(E_ALL);
//ini_set('display_errors', 1);

$RequestID = isset($_REQUEST["RequestID"]) ? $_REQUEST["RequestID"] : '';
$cc_bankid = isset($_REQUEST["cc_bankid"]) ? $_REQUEST["cc_bankid"] : '';
$cc_bankname = isset($_REQUEST["cc_bankname"]) ? $_REQUEST["cc_bankname"] : '';
$card_id = base64_decode($cc_bankid);
$card_name = base64_decode($cc_bankname);

$serviceflag = 1;
//Check if user already submits his application
$checkRecordQry="SELECT * FROM webservice_log_sbi WHERE (cc_requestid='".$RequestID."')";
list($getRecordsCount,$recordRow)=Mainselectfunc($checkRecordQry,$array = array());
if($getRecordsCount){
	//Webservice Not hit in this case
	$serviceflag = 0;
}
else{
	
	$selectqry="SELECT * FROM Req_Credit_Card WHERE (RequestID='".$RequestID."')";
	list($Getnum,$row)=Mainselectfunc($selectqry,$array = array());
	$DOB = $row["DOB"];
	$age = date('Y') - date('Y',strtotime($DOB));
    //echo $age;exit;
    if($age <= 21){
		//Do not perform any action for this case
		//Simply show thanks message to user
	}
	else{
		$pagesource = $row["source"];
		$Gender = $row["Gender"];
		if($Gender=="Male"){
			$strgender="M";
		}elseif($Gender=="Female"){
			$strgender="F";
		}else{
			$strgender="M";
		}

		$Net_Salary = $row["Net_Salary"];
		$CC_Holder = $row["CC_Holder"];
		$Mobile = $row["Mobile_Number"];
		$Email = $row["Email"];
		$Email = preg_replace('/\s+/', '', $Email);
		$City = $row["City"];
		$City_Other = $row["City_Other"];
		if($City=="Others" && Strlen($City_Other)>0){
			$strcity=$City_Other;
		}
		else{
			$strcity=$City;
		}
		$OfficeCity = $row["Office_City"];
		$Pancard = $row["Pancard"];
		$CompanyName = $row["Company_Name"];
		$CompanyName = substr(trim($CompanyName),0,30);
		$CompanyName = preg_replace('/\d+/', '', $CompanyName );
		$CompanyName = str_replace(".", "", $CompanyName);
		$Residence_Address = $row["Residence_Address"];
		$strresiadd = round((strlen($Residence_Address)/3));
		$resiadd = str_split($Residence_Address, $strresiadd);
		$Name = $row["Name"];
		list($first_name,$middle_name,$last_name) = split('[ ]',$Name);
		if(strlen($middle_name)>0 && $middle_name!="Middle Name" && $last_name=="")
		{
			$last_name= $middle_name;
			$middle_name="";
		}

		$Pincode = $row["Pincode"];
		$Employment_Status = $row["Employment_Status"];
		if($Employment_Status==1){
			$OccupationType = "S";
		}elseif($Employment_Status==0){
			$OccupationType = "E";
		}

		$TextSpareField3=1;

		//office std
		$offstd = "";
		if($offstd==""){
			if($OfficeCity=="Kolkata"){
				$offislct="select std,state,source_code from sbi_cc_city_state_list Where (city like'%CALCUTTA%') group by city Limit 0,1";
			}
			else if($OfficeCity=="Gaziabad"){
				$offislct="select std,state,source_code from sbi_cc_city_state_list Where (city like'%GHAZIABAD%') group by city Limit 0,1";
			}
			else{
				$offislct="select std,state,source_code from sbi_cc_city_state_list Where (city like'%".strtoupper($OfficeCity)."%') group by city Limit 0,1";
			}
			$offislct=ExecQuery($offislct);
			$ofirow=mysql_fetch_array($offislct);
			$offstd = "0".$ofirow["std"];
			$OfficeState = $ofirow["state"];
			$SourceCode = $ofirow["source_code"];
		}
		//resi std
		$resistd = "";
		if($resistd==""){
			if($strcity=="Kolkata"){
				$resislct="select std,state,source_code from sbi_cc_city_state_list Where (city like'%CALCUTTA%') group by city Limit 0,1";
			}
			else if($strcity=="Gaziabad"){
				$resislct="select std,state,source_code from sbi_cc_city_state_list Where (city like'%GHAZIABAD%') group by city Limit 0,1";
			}
			else{
				$resislct="select std,state,source_code from sbi_cc_city_state_list Where (city like'%".strtoupper($strcity)."%') group by city Limit 0,1";
			}
			$resislct=ExecQuery($resislct);
			$rsrow=mysql_fetch_array($resislct);
			$resistd = "0".$rsrow["std"];
			$ResiState = $rsrow["state"];
			//$SourceCode = $rsrow["source_code"];
		}

		if($pagesource=="sbi_cards_apply"){
			if($card_id==52) { $CardType="SSU2"; $PromoCode="SCEA";} elseif($card_id==53){ $CardType="VPTL"; $PromoCode="SCEA";} elseif($card_id==54){ $CardType="SMCW"; $PromoCode="SCEA";} elseif($card_id==59){ $CardType="SCU2"; $PromoCode="SCEA";} elseif($card_id==60){ $CardType="AIPU"; $PromoCode="SCEA"; } elseif($card_id==61){ $CardType="AISU"; $PromoCode="SCEA";} elseif($card_id==62){ $CardType="SCU2";  $PromoCode="SCEA";} elseif($card_id==64){ $CardType="IRCP";  $PromoCode="IREA";} elseif($card_id==65){ $CardType="MMSU";  $PromoCode="SCEA";} elseif($card_id==66){ $CardType="SYT1"; $PromoCode="YAEA"; }
		}
		else{
			if($card_id==52) { $CardType="SSU2"; $PromoCode="SCEA";} elseif($card_id==53){ $CardType="VPTL"; $PromoCode="SCEA";} elseif($card_id==54){ $CardType="SMCW"; $PromoCode="SCEA";} elseif($card_id==59){ $CardType="SCU2"; $PromoCode="SCEA";} elseif($card_id==60){ $CardType="AIPU"; $PromoCode="SCEA"; } elseif($card_id==61){ $CardType="AISU"; $PromoCode="SCEA";} elseif($card_id==62){ $CardType="SCU2";  $PromoCode="SCEA";} elseif($card_id==64){ $CardType="IRCP";  $PromoCode="IREA";} elseif($card_id==65){ $CardType="MMSU";  $PromoCode="SCEA";} elseif($card_id==66){ $CardType="SYT1"; $PromoCode="YAEA"; }
		}

		$process_type= 'direct';

		$sccqry="SELECT * FROM sbi_credit_card_5633 WHERE (RequestID='".$RequestID."') AND process_type = '".$process_type."'";
		list($Getsccnumrows,$sccrow)=Mainselectfunc($sccqry,$array = array());
		$sbiccid = $sccrow["sbiccid"];
		$Designation = $sccrow["Designation"];
		$Qualification = $sccrow["Qualification"];
		$OfficeAddress1 = $sccrow["OfficeAddress1"];
		$OfficeAddress2 = $sccrow["OfficeAddress2"];
		$OfficeAddress3 = $sccrow["OfficeAddress3"];
		$OfficeCity = $sccrow["OfficeCity"];
		$OfficePin = $sccrow["OfficePin"];

		$yesterday  = mktime(0, 0, 0, date("m")  , date("d")-1, date("Y"));
		$DateSpareField=date('m/d/Y',$yesterday);
		list($year,$month,$day) = split('[-]',$DOB);
		$strdob = $day."/".$month."/".$year;
		$FirstName = substr($first_name,0,12);//mandatory 
		$MiddleName = substr($middle_name,0,10);//mandatory
		$LastName = substr($last_name,0,16);//mandatory
		$strDesignation = substr($Designation,0,30);
		$PAN = $Pancard;//mandatory
		$ResiAddress1 = trim($resiadd[0]);//mandatory
		$ResiAddress2 = trim($resiadd[1]);//mandatory
		$ResiAddress3 = trim($resiadd[2]);//mandatory
		$EmailAddress = $Email;//mandatory
		$ResiCity = $strcity;//mandatory
		$ResiState = $ResiState;//mandatory
		$ResiPin = $Pincode;//mandatory

		$ProcessingStatus = '';

		if($Employment_Status==1 || $Employment_Status==0){
			//Check Field Validations
			$errMsg = "";
			$errArray = array();
			$flag = 0;

			$Name = $FirstName.$MiddleName.$LastName;

			if(empty($Name)){
				$errArray['Name'] = 1;
				$errArray['NameMsg'] = 'Name is empty';

				$flag = 1;
			}else if(strlen($Name) > 38){
				$errArray['Name'] = 1;
				$errArray['NameMsg'] = 'Name: Max length is 38 chars';
				
				$flag = 1;
			}
			/*else{
				$errArray['Name'] = 0;
				$flag = 1;
			}*/

			if(empty($CompanyName)){
				$errArray['CompanyName'] = 1;
				$errArray['CompanyNameMsg'] = 'CompanyName is empty';

				$flag = 1;
			}elseif(strlen($CompanyName) > 30){
				$errArray['CompanyName'] = 1;
				$errArray['CompanyNameMsg'] = 'CompanyName: Max length is 30 chars';

				$flag = 1;
			}
			/*else{
				$errArray['CompanyName'] = 0;
				$flag = 1;
			}*/

			$panValidationResponse = checkPancardValidation($RequestID,$PAN,'CC','Production');
			if(empty($PAN)){
				$errArray['PAN'] = 1;
				$errArray['PANMsg'] = 'PAN is empty';

				$flag = 1;
			}elseif(strlen($PAN) != 10){
				$errArray['PAN'] = 1;
				$errArray['PANMsg'] = 'PAN should be of 10 numbers';

				$flag = 1;
			}elseif(!preg_match("/^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}?$/", $PAN)) {
				$errArray['PAN'] = 1;
				$errArray['PANMsg'] = 'PAN is invalid';

				$flag = 1;
			}elseif($panValidationResponse != 'MATCHED'){
				$errArray['PAN'] = 1;
				$errArray['PANMsg'] = $panValidationResponse;

				$flag = 1;
			}/*else{
				$errArray['PAN'] = 0;
				$flag = 1;
			}*/

			if(empty($ResiAddress1)){
				$errArray['ResiAddress1'] = 1;
				$errArray['ResiAddress1Msg'] = 'ResiAddress1 is empty';

				$flag = 1;
			}elseif(strlen($ResiAddress1) > 40){
				$errArray['ResiAddress1'] = 1;
				$errArray['ResiAddress1Msg'] = 'ResiAddress1: Max length is 40 chars';

				$flag = 1;
			}/*else{
				$errArray['ResiAddress1'] = 0;
				$flag = 1;
			}*/

			if(empty($ResiAddress2)){
				$errArray['ResiAddress2'] = 1;
				$errArray['ResiAddress2Msg'] = 'ResiAddress2 is empty';

				$flag = 1;
			}elseif(strlen($ResiAddress2) > 40){
				$errArray['ResiAddress2'] = 1;
				$errArray['ResiAddress2Msg'] = 'ResiAddress2: Max length is 40 chars';

				$flag = 1;
			}/*else{
				$errArray['ResiAddress2'] = 0;
				$flag = 1;
			}*/

			if(empty($OfficeAddress1)){
				$errArray['OfficeAddress1'] = 1;
				$errArray['OfficeAddress1Msg'] = 'OfficeAddress1 is empty';

				$flag = 1;
			}elseif(strlen($OfficeAddress1) > 40){
				$errArray['OfficeAddress1'] = 1;
				$errArray['OfficeAddress1Msg'] = 'OfficeAddress1: Max length is 40 chars';

				$flag = 1;
			}/*else{
				$errArray['OfficeAddress1'] = 0;
				$flag = 1;
			}*/
			
			if(!empty($OfficeAddress2) && (strlen($OfficeAddress2) > 40)){
				$errArray['OfficeAddress2'] = 1;
				$errArray['OfficeAddress2Msg'] = 'OfficeAddress2: Max length is 40 chars';
				$flag = 1;
			}/*else{
				$errArray['OfficeAddress2'] = 0;
				$flag = 1;
			}*/

			if($flag){
				$sbiccid_encoded = base64_encode($sbiccid);
				header('Location: http://www.deal4loans.com/sbi-cards-apply-continue.php?RequestID='.$RequestID.'&cc_bankid='.$cc_bankid.'&cc_bankname='.$cc_bankname.'&sbiccid='.$sbiccid_encoded.'&errArray='.urlencode(serialize($errArray)));
			}
			else{
				$dataArr = array();
				$dataArr['RequestID'] = $RequestID;
				$dataArr['LeadRefNo']= '';
				$dataArr['SourceCode']= $SourceCode;
				$dataArr['PromoCode']= $PromoCode;
				$dataArr['CardType']= $CardType;
				$dataArr['FirstName']= $FirstName;
				$dataArr['MiddleName']= $MiddleName;
				$dataArr['LastName']= $LastName;
				$dataArr['DOB']= $strdob;
				$dataArr['Mobile']= $Mobile;
				$dataArr['Gender']= $strgender;
				$dataArr['Qualification']= $Qualification;
				$dataArr['PAN']= $PAN;
				$dataArr['EmailAddress']= $EmailAddress;
				$dataArr['ResiAddress1']= $ResiAddress1;
				$dataArr['ResiAddress2']= $ResiAddress2;
				$dataArr['ResiAddress3']= $ResiAddress3;
				$dataArr['ResiCity']= $ResiCity;
				$dataArr['ResiState']= $ResiState;
				$dataArr['ResiPin']= $ResiPin;
				$dataArr['ResiPhone']= "";
				$dataArr['ResiStdCode']= $resistd;
				$dataArr['OccupationType']= $OccupationType;
				$dataArr['Designation']= $strDesignation;
				$dataArr['CompanyName']= $CompanyName;
				$dataArr['OfficeAddress1']= $OfficeAddress1;
				$dataArr['OfficeAddress2']= $OfficeAddress2;
				$dataArr['OfficePhone']= "";
				$dataArr['OfficeStdCode']= $offstd;
				$dataArr['OfficeState']= $OfficeState;
				$dataArr['OfficeCity']= $OfficeCity;
				$dataArr['OfficePin']= $OfficePin;
				$dataArr['TextSpareField2']= 'email';
				$dataArr['TextSpareField3']= 1;
				$dataArr['DateSpareField1']= $DateSpareField;
				$dataArr['DateSpareField2']= $DateSpareField;
				$dataArr['DateSpareField3']= $DateSpareField;
				$dataArr['DateSpareField4']= $DateSpareField;
				$dataArr['DateSpareField5']= $DateSpareField;
				$dataArr['BankName']= 'SBI';
				$dataArr['AccountNumber']= "";

				$extraDataArr = array();
				$extraDataArr['lms_process']= '';
				$extraDataArr['agent_id']= '';
				//echo '<pre>';print_r($dataArr);exit;

				$webserviceObj = new Webservices();
				$serviceResponse = $webserviceObj->SBIWebservice($dataArr, $extraDataArr, $process_type, $sbiccid);
				$ProcessingStatus = $serviceResponse['ProcessingStatus'];
			}
		}
	}
}

?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Simply Spend.Simply Save.</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW"> <!--Remove tag when live page-->
        <link href="css/materialize.min.css" type="text/css" rel="stylesheet" />
        <link href="css/sbi-cc-styles.css" type="text/css" rel="stylesheet" />
        
    </head>
    <body>
        <div class="pd-top-bottom-10 white">
            <div class="container">
                <div class="row mr-no-btn">
                    <div class="col s12 m12"> <img src="images/sbi-logo.jpg" alt="logo" class="responsive-img" /> </div>
                </div>
            </div>
        </div>
        <header class="sbi_cc_header">
            <div class="container">
                <div class="row mr-no-btn">
                    <div class="col m9 s12 pd-top-25">
                         <h1>Simply Spend. Simply <em>Save</em></h1>
                        <h2>Presenting the Simply<i>SAVE</i> SBI Card.</h2>                    </div>
                    <div class="col m3 s12 center-align"><img src="images/sbi-simply-save.png" class="responsive-img center-align" alt="SBI Simply Save" /></div>
                </div>
                <div class="row mr-no-btn">
                    <div class="col m12 s12">
                        <div class="dark-blue-box center-align"><span>&bull;</span> 10X Reward Points* on Dining, Grocery, 
							Departmental Store &amp; Movie spends <span class="pd-left-16">&bull;</span> Annual Fee Reversal on spends</div>
                    </div>
                </div>
            </div>
        </header>
        <section>
            <div class="container">
                <div class="row mr-no-btn">
                    <div class="col s12 m12">
                        <div class="card pd-20">
                            <div class="row">
                                <div class="col s12 m8">
                                    <div class="form-box">
                                        <form method="post" name="SssFrm" action="sbi-cards-apply.php" id="formValidate">	
											<div>
												<?
												if($ProcessingStatus==1 || $ProcessingStatus==2){
												?>
													Thank you for applying  for <? echo $card_name; ?> through deal4loans. Your application reference no.<? echo $ApplicationNumber; ?> for <? echo $card_name; ?> Credit Card has been approved in principle with a credit limit of <? echo $CreditLimit; ?> basis the information provided by you. The final credit limit assigned would be subject to submission of requisite documents & their verification. SBI Card representative will contact you shortly.<br><br>
													SBI Cards reserves the right to change the approved card type or credit limit at its sole discretion.
												<? 
												}
												else if($ProcessingStatus==4 || $ProcessingStatus==5 || $ProcessingStatus==6){
												?>
													Thank you for applying  for <? echo $card_name; ?>  through deal4loans. Your application for SBI Card is under process. We will contact you shortly
												<?
												}
												else if($ProcessingStatus==3){
												?>
													Thank you for applying  for <? echo $card_name; ?>  through deal4loans. Your application for <? echo $card_name; ?> Card has been approved in principle subject to submission of requisite documents & their verification. SBI Card representative will contact you shortly.<br><br>   
													SBI Cards reserves the right to change the approved card type or credit limit at its sole discretion.
												<?
												}
												else if($ProcessingStatus==7){
												?>
													Thank you for applying  for <? echo $card_name; ?>  through deal4loans. We are unable to process your request further as the details furnished do not meet the policies set forth for issuance of the <? echo $card_name; ?> Card .
												<?
												}
												else{
												?>
													Thank you for applying  for <? echo $card_name; ?>  through deal4loans, we will get back to you soon.
												<? 
												}
												?>
											</div>
                                        </form>
                                    </div>
                                </div>
                                <div class="col m4 s12 features-mr-top25">
                                    <div class="card">
                                        <div class="gift-box"><img src="images/gift_box.png" alt="Gift" /></div>
                                        <div class="benefits-box center-align">Benifits with your Simply Save Sbi Cards</div>
                                        <div class="features-main">
                                           <ul class="features-text">
                                                <li>Get 2,000 bonus Reward Points* on Spends of Rs. 2,000 or more in first 60 days.</li>
                                                <li>Get annual membership fee reversal from second year of your subscription with annual spends of Rs 90,000 or more.</li>
                                                <li>Enjoy 10X Reward Points* per Rs 100 spent on Dining, Movies, Departmental Stores and Grocery 
												spends.</li>
                                                <li>1 % Fuel Surcharge Waiver* across all petrol pumps.</li>
                                            </ul>
                                            <hr>
                                            <p><span>Annual fee:</span> Nil, if the total spends made by you in the previous year >= Rs. 90,000. Else, an annual fee of Rs. 499 is charged.</p>
                                            <p><span>Joining fee (one time): </span>
											Rs. 499 (Service Tax, as applicable).</p>
                                            <p><span>Add-on fee:</span> Nil.</p>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row"></div>
                    </div>
                </div>
            </div>
        </section>
        <script src="js/jquery-2.1.4.min.js" type="text/javascript"></script> 
        <script src="js/materialize.js" type="text/javascript"></script> 
        <script src="js/materialize.min.js" type="text/javascript"></script>
        <script src="js/sbi-cards.js"></script> 
        <script type="text/javascript">
			$(document).ready(function () {
				// the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
				$('.modal').modal();
				
				$('select').material_select();
			});

        </script>
    </body>
</html>
