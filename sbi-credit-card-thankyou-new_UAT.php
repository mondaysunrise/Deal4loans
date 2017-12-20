<?php
ob_start();
ini_set('max_execution_time', 1000);
require 'scripts/db_init.php';
require 'scripts/functions.php';
require 'webservices_functions.php';

//error_reporting(E_ALL);
//ini_set('display_errors', 1);

$errorMsg = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$requestID = $_POST["requestID"];
	

	$getUserDetailsQry = "SELECT Mobile_Number, Pancard FROM Req_Credit_Card Where (RequestID='".$requestID."')";
	list($Getnum,$getUserDetails) = Mainselectfunc($getUserDetailsQry,$array = array());
	$pan_num = $getUserDetails["Pancard"];
	$mobile_num = $getUserDetails["Mobile_Number"];

	/* Check if user already submitted request within 15 minutes Start*/
	/*
	$checkRequestXmlQry = "SELECT request_xml, first_dated FROM sbi_credit_card_5633 WHERE RequestID = '".$requestID."' AND first_dated > DATE_SUB(NOW(), INTERVAL 30 MINUTE) ORDER BY sbiccid DESC limit 0,1";
	$getRequestXmlResult = d4l_ExecQuery($checkRequestXmlQry);
	$request_xml = d4l_mysql_result($getRequestXmlResult,0,'request_xml');
	$first_dated = d4l_mysql_result($getRequestXmlResult,0,'first_dated');
	if(!empty($request_xml)){
		$errorMsg = 'Submitted at '.$first_dated.'<br/>Your Application is in process...<br/>';
	}
	*/
	/* Check if user already submitted request within 15 minutes End*/

	/* Check if user already submitted If Blank*/
	/*
	$getSBIButtonSql = "SELECT response_xml FROM `webservice_log_sbi` WHERE cc_requestid IN (SELECT cc_requestid FROM (select cc_requestid, COUNT(cc_requestid) AS c FROM `webservice_log_sbi` GROUP BY cc_requestid HAVING C < 2 ) as temp) AND response_xml = '' AND cc_requestid = '".$requestID."' AND response_blank = 0";
	$getSBIButtonQuery = d4l_ExecQuery($getSBIButtonSql);
	$getSBIButtonNumRows = d4l_mysql_num_rows($getSBIButtonQuery);
	$response_xml = d4l_mysql_result($getSBIButtonQuery,0,'response_xml');
	if($getSBIButtonNumRows>0) 
	{ 
		$errorMsg = 'Your Application is in process...<br/>';
	}
	*/
	/*Check if user already submitted If Blank*/
	
	/* Check if user already submitted application on wishfin */
	/*
	$getSBIButtonRefHashSql = "SELECT bank_api_response_data FROM `xkyknzl5dwfyk4hg_tms_bank_api` WHERE `product_type` = 'CC' AND `bank_code` = '002' AND d4l_id='".$requestID."' AND d4l_id!=0 AND bank_api_response_data!=''";//updated on 05102017
	$getSBIButtonRefHashQuery = d4l_ExecQuery($getSBIButtonRefHashSql);
	$getSBIButtonRefHashNumRows = d4l_mysql_num_rows($getSBIButtonRefHashQuery);
	$bank_api_response_data = d4l_mysql_result($getSBIButtonRefHashQuery,0,'bank_api_response_data');
	if(strlen($bank_api_response_data)>10) {
		$errorMsg = 'You have already applied.<br/>';
	}
	*/
	/* Check if user already submitted application on wishfin */
	
	/*To check if given pancard is found in any request_xml for Processing Status 1,2,4,5,6,7 */
	/*
	$checkPANInRequestSql = "SELECT * FROM `sbi_credit_card_5633` as scc WHERE request_xml LIKE '%<PAN>".$pan_num."</PAN>%' AND (scc.first_dated > DATE_SUB(NOW(), INTERVAL 180 DAY)) AND (scc.ProcessingStatus IN (1,2,4,5,6,7)  OR (scc.StatusCode = 156 AND RequestID != '".$requestID."'))";//updated on 05102017
	$checkPANInRequestResult = d4l_ExecQuery($checkPANInRequestSql);
	$checkPANInRequestNumRows = d4l_mysql_num_rows($checkPANInRequestResult);
	if($checkPANInRequestNumRows>0) 
	{
		$errorMsg = 'You have already applied.<br/>';
	}
	*/
	/*To check if given pancard is found in any request_xml for Processing Status 1,2,4,5,6,7 */
	
	/*To check if given pancard or mobile is found in any request_xml for webservice_log_sbi*/
	/*
	$checkPANMobileLogSql = "SELECT sbicclogid FROM `webservice_log_sbi` WHERE request_xml != '' AND ((request_xml LIKE '%<PAN>".$pan_num."</PAN>%') OR (request_xml LIKE '%<Mobile>".$mobile_num."</Mobile>%')) AND (first_dated > DATE_SUB(NOW(), INTERVAL 180 DAY)) AND (StatusCode != 156 OR StatusCode IS NULL)";//updated on 05102017
	$checkPANMobileLogResult = d4l_ExecQuery($checkPANMobileLogSql);
	$checkPANMobileLogNumRows = d4l_mysql_num_rows($checkPANMobileLogResult);
	if($checkPANMobileLogNumRows>0 && strlen($mobile_num) > 0 && strlen($pan_num) > 0) 
	{
		$errorMsg = 'You have already applied.<br/>';
	}
	*/
	/*To check if given pancard or mobile is found in any request_xml for webservice_log_sbi*/

	/*To check if given pancard or mobile is found in any request_xml for sbi_credit_card_5633*/
	/*
	$checkSccPANMobileLogSql = "SELECT sbiccid FROM `sbi_credit_card_5633` WHERE request_xml != '' AND ((request_xml LIKE '%<PAN>".$pan_num."</PAN>%') OR (request_xml LIKE '%<Mobile>".$mobile_num."</Mobile>%')) AND (first_dated > DATE_SUB(NOW(), INTERVAL 180 DAY)) AND (StatusCode != 156 OR StatusCode IS NULL)";//updated on 06102017
	$checkSccPANMobileLogResult = d4l_ExecQuery($checkSccPANMobileLogSql);
	$checkSccPANMobileLogNumRows = d4l_mysql_num_rows($checkSccPANMobileLogResult);
	if($checkSccPANMobileLogNumRows>0 && strlen($mobile_num) > 0 && strlen($pan_num) > 0) 
	{
		$errorMsg = 'You have already applied.<br/>';
	}
	*/

	if(empty($errorMsg)){
		$Gender = $_POST["Gender"];
		$panno = $_POST["panno"];
		$City = $_POST["City"];
		$City_Other = $_POST["City_Other"];
		$State = $_POST["State"];
		$ResidenceAddress1 = $_POST["resiaddress1"];
		$ResidenceAddress2 = $_POST["resiaddress2"];
		$ResidenceAddress3 = $_POST["resiaddress3"];
		$ResidenceAddress = $ResidenceAddress1." ".$ResidenceAddress2." ".$ResidenceAddress3;
		$pincode = $_POST["pincode"];
		$OfficeAddress1 = $_POST["OfficeAddress1"];
		$OfficeAddress2 = $_POST["OfficeAddress2"];
		$OfficeAddress3 = $_POST["OfficeAddress3"];
		$OfficeAddress = $OfficeAddress1." ".$OfficeAddress2." ".$OfficeAddress3;
		$OfficePin = $_POST["OfficePin"];
		$Land_linenumber = $_POST["Land_linenumber"];
		$OfficeCity = $_POST["OfficeCity"];
		$Phone_Number = $_POST["Phone_Number"];	
		$postpaidMobileNumber = $_POST["MobileNumber"];
		$Qualification = $_POST["Qualification"];
		$Designation = $_POST["Designation"];	
		$card_name = $_POST["card_name"];
		$STD = "0".$_POST["STD"];
		$first_name = $_POST["first_name"];
		$middle_name = $_POST["middle_name"];
		$last_name = $_POST["last_name"];
		$Company_Name = $_POST["Company_Name"];
		$AddressDoc = $_POST["AddressDoc"];
		
		if(strlen($middle_name)>0 && $middle_name!="Middle Name" && $last_name=="")
		{
			$last_name= $middle_name;
			$middle_name="";
		}
		else
		{
			if($last_name=="")
			{
				$last_name= "Kumar";
			}
		}
		$Name=$first_name." ".$middle_name." ".$last_name;
		
		$sbiloanrunning = '';
		$sbirelation = '';
		$bankaccountnumber = '';
		$account_number='';
		$sbicardholder = $_POST["sbicardholder"];
		if($sbicardholder == 'Yes'){
			$sbiloanrunning = '';
			$sbirelation = '';
			$bankaccountnumber = '';
		}else{
			$sbiloanrunning = $_POST["sbiloanrunning"];
			if($sbiloanrunning == 'Yes'){}
			else{
				$sbirelation = $_POST["sbirelation"];
				if($sbirelation == 'Yes'){
					$bankaccountnumber = $_POST["bankaccountnumber"];
				}
			}
		}
		$account_number = !empty($bankaccountnumber) ? $bankaccountnumber : '';
		
		if(strlen($Company_Name)>0)
		{
			$slct='select sbi_category from sbi_cc_company_list Where (sbi_companyname="'.$Company_Name.'")';
			list($Getnum,$catrow)=Mainselectfunc($slct,$array = array());
			$sbicompcat= $catrow["sbi_category"];
		}
		if($Land_linenumber=="Residence")
		{
			$Std_Code = $STD;
			$Landline = $Phone_Number;	
			$Std_Code_O=0;
			$Landline_O = 0;	
		}
		else
		{
			$Std_Code_O = $STD;
			$Landline_O = $Phone_Number;	
			$Std_Code = 0;
			$Landline = 0;	
		}
		$Landline_number=$Landline;
		
		$card_id = $_POST["card_id"];
		$Dated=ExactServerdate();

		if($Landline_O>0)
		{
			$Landline_numberO=$Landline_O;
		}
		else
		{
			$Landline_numberO=substr(trim($postpaidMobileNumber),0,8);
		}

		$InsertProductSql= array("Name"=>$Name, "Gender" => $Gender, "Pancard" => $panno, "Company_Name" => $Company_Name, "City" => $City, "Residence_Address" => $ResidenceAddress, "Office_Address" => $OfficeAddress, "Std_Code"=>$Std_Code, "Landline"=>$Landline_number, "Std_Code_O"=>$Std_Code_O, "Landline_O"=>$Landline_numberO, "Pincode"=>$pincode);
		$wherecondition ="(RequestID='".$requestID."')";
		Mainupdatefunc("Req_Credit_Card", $InsertProductSql, $wherecondition);

		$getdetails="select sbiccid From sbi_credit_card_5633 Where ( RequestID='".$requestID."') and process_type='direct' order by sbiccid DESC";
		list($alreadyExist,$myrow)=Mainselectfunc($getdetails,$array = array());
		$sbiccid=$myrow['sbiccid'];
		$productflag=4;
		if($alreadyExist>0)
		{
			$duplicatepush=1;
			$DataArray = array("CompanyName"=>$Company_Name, "ResidenceAddress1" => $ResidenceAddress1, "ResidenceAddress2" => $ResidenceAddress2, "ResidenceAddress3" => $ResidenceAddress3, "OfficeAddress1" => $OfficeAddress1, "OfficeAddress2" => $OfficeAddress2, "OfficeAddress3" => $OfficeAddress3,  "OfficePin" => $OfficePin, "TypeOfLandline" => $Land_linenumber, "OfficeCity" => $OfficeCity, "LandlineNo" => $Phone_Number, "OfficeState"=> $OfficeState, "Qualification"=> $Qualification, "CardName" => $card_name, "Designation" => $Designation, "Dated" =>$Dated, "account_number" =>$account_number, "relationship_type"=>$sbirelation, "sbi_cc_holder"=>$sbicardholder, "resiaddress_document_status"=>$AddressDoc, "productflag"=>$productflag);
			$wherecondition ="(sbiccid='".$sbiccid."')";
			//print_r($DataArray);
			Mainupdatefunc ("sbi_credit_card_5633", $DataArray, $wherecondition);
		}
		else
		{
			$duplicatepush=0;
			$process_type = 'direct';
			$InsertProductSql= array("RequestID" => $requestID, "CompanyName"=>$Company_Name, "ResidenceAddress1" => $ResidenceAddress1, "ResidenceAddress2" => $ResidenceAddress2, "ResidenceAddress3" => $ResidenceAddress3, "OfficeAddress1" => $OfficeAddress1, "OfficeAddress2" => $OfficeAddress2, "OfficeAddress3" => $OfficeAddress3, "OfficePin" => $OfficePin, "TypeOfLandline" => $Land_linenumber, "OfficeCity" => $OfficeCity, "LandlineNo" => $Phone_Number, "OfficeState"=> $OfficeState, "Qualification"=> $Qualification, "CardName" => $card_name, "Designation" => $Designation, "Dated" =>$Dated, "process_type"=>$process_type, "account_number" =>$account_number, "relationship_type"=>$sbirelation, "sbi_cc_holder"=>$sbicardholder, "resiaddress_document_status"=>$AddressDoc, "productflag"=>$productflag);
			//print_r($InsertProductSql);
			$sbiccid = Maininsertfunc("sbi_credit_card_5633", $InsertProductSql);
		}
	}
}

if(empty($errorMsg)){
	$slct="select * from Req_Credit_Card Where (RequestID='".$requestID."')";
	list($Getnum,$row)=Mainselectfunc($slct,$array = array());
	$pagesource = $row["source"];
	$CompanyName = $row["Company_Name"];
	$Gender = $row["Gender"];
	if($Gender=="Male")
	{
		$strgender="M";
	}
	elseif($Gender=="Female")
	{
		$strgender="F";
	}
	else
	{
		$strgender="M";
	}

	$Net_Salary = $row["Net_Salary"];
	$CC_Holder = $row["CC_Holder"];
	$Mobile = $row["Mobile_Number"];
	$Email = $row["Email"];
	$Email = preg_replace('/\s+/', '', $Email);
	$City = $row["City"];
	$City_Other = $row["City_Other"];
	if($City=="Others" && Strlen($City_Other)>0)
	{
		$strcity=$City_Other;
	}
	else
	{
		$strcity=$City;
	}
	$DOB = $row["DOB"];
	$Pancard = $row["Pancard"];
	$CompanyName = substr(trim($CompanyName),0,30);
	$CompanyName = preg_replace('/\d+/', '', $CompanyName );
	$CompanyName = str_replace(".", "", $CompanyName);

	$Pincode = $row["Pincode"];
	$Employment_Status = $row["Employment_Status"];
	if($Employment_Status==1)
	{
		$OccupationType = "S";
	}
	else
	{
		$OccupationType = "E";
	}
	//$ResiPhone = $Phone_Number;//mandatory
	if($Land_linenumber=="Residence")
	{
		$ResiPhone = $Landline_number;//mandatory
	}
	else
	{
		$OfficePhone = $Landline_numberO;//mandatory
	}
	if($postpaidMobileNumber>0)
	{
		$OfficePhone = substr(trim($postpaidMobileNumber),0,8);//mandatory
		$TextSpareField3=$postpaidMobileNumber;
	}
	else
	{
		$TextSpareField3=1;
	}
	
	//office std
	if($OfficeCity=="Kolkata")
	{
		$offislct="select std,state,source_code from sbi_cc_city_state_list Where (city like'%CALCUTTA%') group by city Limit 0,1";
	}
	else if($OfficeCity=="Gaziabad")
	{
		$offislct="select std,state,source_code from sbi_cc_city_state_list Where (city like'%GHAZIABAD%') group by city Limit 0,1";
	}
	else
	{
		$offislct="select std,state,source_code from sbi_cc_city_state_list Where (city like'%".strtoupper($OfficeCity)."%') group by city Limit 0,1";
	}
	$offislct = d4l_ExecQuery($offislct);
	$ofirow = d4l_mysql_fetch_array($offislct);
	$offstd = "0".$ofirow["std"];
	$OfficeState = $ofirow["state"];

	//resi std
	if($strcity=="Kolkata")
	{
		$resislct="select std,state,source_code from sbi_cc_city_state_list Where (city like'%CALCUTTA%') group by city Limit 0,1";
	}
	else if($strcity=="Gaziabad")
	{
		$resislct="select std,state,source_code from sbi_cc_city_state_list Where (city like'%GHAZIABAD%') group by city Limit 0,1";
	}
	else
	{
		$resislct="select std,state,source_code from sbi_cc_city_state_list Where (city like'%".strtoupper($strcity)."%') group by city Limit 0,1";
	}
	$resislct = d4l_ExecQuery($resislct);
	$rsrow = d4l_mysql_fetch_array($resislct);
	$resistd = "0".$rsrow["std"];
	$ResiState = $rsrow["state"];
	$SourceCode = $rsrow["source_code"];

	if($pagesource=="sbitest")
	{
		if($card_id==53){
			$card_type="VPTL"; $PromoCode="SCEA";
		}
		elseif($card_id==66){
			$card_type="SYT1"; $PromoCode="YAEA";
		}
		elseif($card_id==64){
			$card_type="IRCP"; $PromoCode="IREA";
		}
		elseif($card_id==61){
			$card_type="AISU"; $PromoCode="SCEA";
		}
		elseif($card_id==60){
			$card_type="AIPU"; $PromoCode="SCEA";
		}
		elseif($card_id==52){
			$card_type="SSU2"; $PromoCode="SCEA";
		}
		elseif($card_id==59){
			$card_type="CSC2"; $PromoCode="SCEA";
		}
		elseif($card_id==65){
			$card_type="MMSU"; $PromoCode="SCEA";
		}
		elseif($card_id==54){
			$card_type="VISC"; $PromoCode="SCEA";
		}
		elseif($card_id==62){
			$card_type="FBBS"; $PromoCode="SCEA";
		}
		else{
			$card_type="SSU2"; $PromoCode="SCEA";
		}
	}
	else
	{
		if($card_id==53){
			$card_type="VPTL"; $PromoCode="SCEA";
		}
		elseif($card_id==66){
			$card_type="SYT1"; $PromoCode="YAEA";
		}
		elseif($card_id==64){
			$card_type="IRCP"; $PromoCode="IREA";
		}
		elseif($card_id==61){
			$card_type="AISU"; $PromoCode="SCEA";
		}
		elseif($card_id==60){
			$card_type="AIPU"; $PromoCode="SCEA";
		}
		elseif($card_id==52){
			$card_type="SSU2"; $PromoCode="SCEA";
		}
		elseif($card_id==59){
			$card_type="CSC2"; $PromoCode="SCEA";
		}
		elseif($card_id==65){
			$card_type="MMSU"; $PromoCode="SCEA";
		}
		elseif($card_id==54){
			$card_type="VISC"; $PromoCode="SCEA";
		}
		elseif($card_id==62){
			$card_type="FBBS"; $PromoCode="SCEA";
		}
		else{
			$card_type="SSU2"; $PromoCode="SCEA";
		}
	}
	
	//Get details from sbi_credit_card_5633
	$cc_alldetailsSql = "SELECT * FROM sbi_credit_card_5633 WHERE RequestID=".$requestID." AND process_type='direct' ORDER BY sbiccid DESC LIMIT 0,1";
	$cc_alldetails = d4l_ExecQuery($cc_alldetailsSql);
	$ccrowal = d4l_mysql_fetch_array($cc_alldetails);
	$ResiAddress1 = $ccrowal["ResidenceAddress1"];
	$ResiAddress1 = trim(substr($ResiAddress1,0,40));
	$ResiAddress2 = $ccrowal["ResidenceAddress2"];
	$ResiAddress2 = trim(substr($ResiAddress2,0,40));
	$ResiAddress3 = $ccrowal["ResidenceAddress3"];
	$ResiAddress3 = trim(substr($ResiAddress3,0,40));
	$OfficeAddress1 = $ccrowal["OfficeAddress1"];
	$OfficeAddress1 = trim(substr($OfficeAddress1,0,40));
	$OfficeAddress2 = $ccrowal["OfficeAddress2"];
	$OfficeAddress2 = trim(substr($OfficeAddress2,0,40));
	$OfficeAddress3 = $ccrowal["OfficeAddress3"];
	$OfficeAddress3 = trim(substr($OfficeAddress3,0,40));
	$Qualification = $ccrowal["Qualification"];
	$relationship_type = $ccrowal["relationship_type"];
	
	//echo '<pre>';print_r($ccrowal);exit;
	
	if($relationship_type == 'Yes'){
		$BankName = 'SBI';
	}
	else{
		$BankName = '';
	}
	
	$validlead='';

	if((($sbicompcat=='A' || $sbicompcat=='B') || (($sbicompcat=='C' || $sbicompcat=='D') && $CC_Holder==1 && $Net_Salary>=360000)) && ($CC_Holder==1 && $sbicardholder == 'No' && $sbiloanrunning=='No' /*&& $sbirelation=='Yes'*/))
	{
		$validlead=1;
	}

	$CardType = $card_type;
	$yesterday  = mktime(0, 0, 0, date("m")  , date("d")-1, date("Y"));
	$DateSpareField=date('m/d/Y',$yesterday);
	list($year,$month,$day) = split('[-]',$DOB);
	$strdob = $day."/".$month."/".$year;
	$FirstName = substr($first_name,0,12);//mandatory 
	$MiddleName = substr($middle_name,0,10);//mandatory
	$LastName = substr($last_name,0,16);//mandatory
	$strDesignation = substr($Designation,0,30);
	$Mobile = $Mobile;//mandatory
	$PAN = $Pancard;//mandatory
	$EmailAddress = $Email;//mandatory
	$ResiCity = $strcity;//mandatory
	$ResiState = $ResiState;//mandatory
	$ResiPin = $Pincode;//mandatory
	$OccupationType = $OccupationType;//mandatory
	$CompanyName = $CompanyName;


	$dataArr = array();
	$dataArr['RequestID'] = $requestID;
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
	$dataArr['ResiPhone']= $ResiPhone;
	$dataArr['ResiStdCode']= $resistd;
	$dataArr['OccupationType']= $OccupationType;
	$dataArr['Designation']= $strDesignation;
	$dataArr['CompanyName']= $CompanyName;
	$dataArr['OfficeAddress1']= $OfficeAddress1;
	$dataArr['OfficeAddress2']= $OfficeAddress2;
	$dataArr['OfficeAddress3']= $OfficeAddress3;
	$dataArr['OfficePhone']= $OfficePhone;
	$dataArr['OfficeStdCode']= $offstd;
	$dataArr['OfficeState']= $OfficeState;
	$dataArr['OfficeCity']= $OfficeCity;
	$dataArr['OfficePin']= $OfficePin;
	$dataArr['TextSpareField2']= 'assisted';
	$dataArr['TextSpareField3']= $TextSpareField3;
	$dataArr['DateSpareField1']= $DateSpareField;
	$dataArr['DateSpareField2']= $DateSpareField;
	$dataArr['DateSpareField3']= $DateSpareField;
	$dataArr['DateSpareField4']= $DateSpareField;
	$dataArr['DateSpareField5']= $DateSpareField;
	$dataArr['BankName']= $BankName;
	$dataArr['AccountNumber']= $account_number;

	$extraDataArr = array();
	$extraDataArr['lms_process']= '';
	$extraDataArr['agent_id']= '';

	$process_type= 'direct';
	
	//echo '<pre>';print_r($dataArrr);exit;

	if($validlead==1)
	{
		$webserviceObj = new Webservices();
		if($pagesource=="sbitest")
		{
			$serviceResponse = $webserviceObj->SBIWebserviceUAT($dataArr, $extraDataArr, $process_type, $sbiccid);
		}
		else{
			$serviceResponse = $webserviceObj->SBIWebservice($dataArr, $extraDataArr, $process_type, $sbiccid);
		}
		$ProcessingStatus = $serviceResponse['ProcessingStatus'];
		$StatusCode = $serviceResponse['StatusCode'];
		
		$checkValidtion = "...";
	}
	else
	{
		$checkValidtion = "No Web Service.";
	}
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Instant E Apply Credit Cards Online in India</title>
<meta name="keywords" content="online credit cards, online credit cards applications, Credit card comparison, online application of credit card, apply online credit cards, online credit card application" />
<meta name="description" content="Fill Application form for credit cards. Instant Apply & get Approval for Credit cards such as HDFC, ICICI, Citibank, Standard Chartered, SBI and American express Online in India." />
<meta name="verify-v1" content="iC5qAw9C0E3rRZYbtAKvnPHmBSQU3zWJu5Ooj8hO3Og=" />
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0" />
<link href="css/credit-card-styles.css" type="text/css" rel="stylesheet"  />
</head>
<body>
<?php include "middle-menu.php"; ?>
<div style="clear:both;"></div>
<div class="cc_inner_wrapper">
<div style="clear:both;"></div>
<div class="common-bread-crumb" style="margin:auto; width:100%; margin-top:70px; color:#0a8bd9;"><u><a href="index.php" class="text12" style="color:#0080d6;" >Home</a></u> > <a href="credit-cards.php"  class="text12" style="color:#0080d6;"><u>Credit Card</u></a> <span style="color:#4c4c4c;">> SBI Credit Card</span></div>
<div style="clear:both; height:10px;"></div>
<div style="clear:both; height:20px; width:100%; margin:auto; margin-top:10px; padding-top:10px; font-size:18px; color:#000; height:400px;">
<? 
//$ProcessingStatus = 1;
//$StatusCode = 120;

if(!empty($errorMsg))
{
	echo $errorMsg;
}
elseif($sbicardholder=="Yes")
{
	echo "Thank You showing interest in SBI credit card, as you are already a SBI Credit Card Holder, we may not be able to service your request for another SBI Credit Card through our platform.";
}
else 
{
	if($ProcessingStatus==1)
	{
		$reqid = base64_encode($requestID);
		$status = base64_encode($StatusCode);
		
		//Send Mail
		$detailsArr = array();
		$detailsArr['customer_name'] = $FirstName.' '.$MiddleName.' '.$LastName;
		$detailsArr['customer_email'] = $EmailAddress;
		$detailsArr['reqid'] = $reqid;
		$detailsArr['status'] = $status;
		$mailResponse = SendDocumentsMailToCustomers($detailsArr);
		
		//Redirect to Document Page
		header('Location: sbi-document-page.php?reqid='.$reqid.'&status='.$status);
	}
	else if($ProcessingStatus==2)
	{
	?>
		Thank you for applying  for <? echo $card_name; ?> through deal4loans. Your application reference no.<? echo $ApplicationNumber; ?> for <? echo $card_name; ?> Credit Card has been approved in principle with a credit limit of <? echo $CreditLimit; ?> basis the information provided by you. The final credit limit assigned would be subject to submission of requisite documents & their verification. SBI Card representative will contact you shortly.<br /><br />
		SBI Cards reserves the right to change the approved card type or credit limit at its sole discretion.
	<? 
	}
	else if($ProcessingStatus==4 || $ProcessingStatus==5 || $ProcessingStatus==6)
	{
	?>
		Thank you for applying  for <? echo $card_name; ?>  through deal4loans. Your application for SBI Card is under process. We will contact you shortly
	<?
	}
	else if($ProcessingStatus==3)
	{
	?>
		Thank you for applying  for <? echo $card_name; ?>  through deal4loans. Your application for <? echo $card_name; ?> Card has been approved in principle subject to submission of requisite documents & their verification. SBI Card representative will contact you shortly.<br><br>   
		SBI Cards reserves the right to change the approved card type or credit limit at its sole discretion.
	<?
	}
	else if($ProcessingStatus==7)
	{
	?>
		Thank you for applying  for <? echo $card_name; ?>  through deal4loans. We are unable to process your request further as the details furnished do not meet the policies set forth for issuance of the <? echo $card_name; ?> Card .
	<?
	}
	else
	{
	?>
		Thank you for applying  for <? echo $card_name; ?>  through deal4loans, we will get back to you soon.
	<? 
	}
}
?>
</div>
</div>
</div>
<div style="clear:both; height:100px;"></div>
<!--partners-->
<?php include("footer_sub_menu.php"); ?>
</body>
</html>
</body>
</html>
<?php

function SendDocumentsMailToCustomers($detailsArr){
	$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
	$url = $protocol . $_SERVER['HTTP_HOST'];
	
	$message = '<table cellpadding="0" cellspacing="0" border="0" width="600" align="center">
	<tr>
	<td bgcolor="#0c60b6">&nbsp;</td>
	</tr>
	<tr>
	  <td bgcolor="#0c60b6" align="right"><img src="'.$url.'/images/deal4loans_logo.png" style="margin-right:25px;" /></td>
	</tr>
	<tr>
	  <td bgcolor="#0c60b6">&nbsp;</td>
	</tr>
	<tr>
	  <td bgcolor="#bdd8ef">&nbsp;</td>
	</tr>
	<tr>
	  <td bgcolor="#bdd8ef">&nbsp;</td>
	</tr>
	<tr>
	  <td bgcolor="#bdd8ef"><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
		<tr>
		  <td bgcolor="#FFFFFF">&nbsp;</td>
		</tr>
		<tr>
		  <td height="35" bgcolor="#FFFFFF" style="font-family:Arial, Helvetica, sans-serif; font-size:18px; color:#171717; padding-left:15px;">Dear '.$detailsArr['customer_name'].',</td>
		</tr>
		<tr>
		  <td bgcolor="#FFFFFF" style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#4c4c4c; line-height:21px; padding-left:15px;">Thank you for considering Deal4loans for Comparing Loan and credit card deals. We are India\'s Largest Financial Comparative platform with an association with India’s Top Banks/NBFC\'s for Loan &amp; Credit card. We are continuously working towards getting you the best deal on your  requirement basis your profile/eligibility.</td>
		</tr>
		<tr>
		  <td bgcolor="#FFFFFF">&nbsp;</td>
		</tr>
		<tr>
		  <td bgcolor="#FFFFFF" style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#4c4c4c; line-height:21px; padding-left:15px;">Your SBI credit card application is almost complete. Pls upload the <a href="#" style="color:#0c60b6; text-decoration:none;">required  documents</a> to the below mentioned link for instant approval.</td>
		</tr>
		<tr>
		  <td bgcolor="#FFFFFF">&nbsp;</td>
		</tr>
		<tr>
		  <td bgcolor="#FFFFFF" style="font-family:Arial, Helvetica, sans-serif; font-size:14px; line-height:21px; padding-left:15px;"><a href="'.$url.'/document-upload-verification.php?reqid='.$detailsArr['reqid'].'&status='.$detailsArr['status'].'" style="color:#0c60b6; text-decoration:none;">Click Here</a></td>
		</tr>
		<tr>
		  <td bgcolor="#FFFFFF">&nbsp;</td>
		</tr>
		<tr>
		  <td bgcolor="#FFFFFF">&nbsp;</td>
		</tr>
		<tr>
		  <td bgcolor="#FFFFFF" style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#4c4c4c; line-height:21px; padding-left:15px;">Regards</td>
		</tr>
		<tr>
		  <td bgcolor="#FFFFFF" style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#4c4c4c; line-height:21px; padding-left:15px;">Deal4loans Family</td>
		</tr>
		<tr>
		  <td bgcolor="#FFFFFF">&nbsp;</td>
		</tr>
		<tr>
		  <td bgcolor="#FFFFFF">&nbsp;</td>
		</tr>
	  </table></td>
	</tr>
	<tr>
	  <td bgcolor="#bdd8ef">&nbsp;</td>
	</tr>
	<tr>
	  <td bgcolor="#bdd8ef"><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
		<tr>
		  <td style="font-family:Arial, Helvetica, sans-serif; font-size:10px; color:#676767;">Disclaimer: Deal4loans doesn not provide Loans on its own but ensures your information is sent to bank/agent which you have opted for. We do not do short term loans. Deal4loans has no sales team on its own and we just help you to compare loans. All loans are on discretion of the associated</td>
		</tr>
	  </table></td>
	</tr>
	<tr>
	  <td bgcolor="#bdd8ef">&nbsp;</td>
	</tr>
	</table>';

	//print_r($message);
	
	////////////////--------------Send Mail via PHP---------------///////////////

	$to = $detailsArr['customer_email'];
	//$to = 'rachit2264@gmail.com';
	$subject = "Complete your SBI Credit Card Application";

	// Set content-type header for sending HTML email
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	// Additional headers
	$headers .= 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
	//$headers .= 'Cc: abc@abc.com' . "\r\n";
	//$headers .= 'Bcc: abc@abc.com' . "\r\n";

	// Send email
	if(mail($to,$subject,$message,$headers)){
		$Msg = 'Mail Sent';
	}
	else{
		$Msg = 'Mail Failed';
	}
	
	////////////////--------------Send Mail via PHP---------------///////////////

	return $Msg;
}
?>
