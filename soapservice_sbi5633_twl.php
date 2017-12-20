<?php
//@set_time_limit(1000);
ini_set('max_execution_time', 600);
require 'scripts/db_init.php';
require 'webservices_functions.php';

$requestID = $_REQUEST["custid"];
$agent_id = $_REQUEST["agent_id"];
$process = $_REQUEST["process"];

if(!isset($_SERVER['HTTP_REFERER']))
{
	echo "You Refreshed the Page";
	die();
}

$getInitialDetailsSql = "select * from sbi_ccoffers_directonsite Where (sbiccoffersid=".$requestID.")";
$getInitialDetailsQuery = d4l_ExecQuery($getInitialDetailsSql);

$Name = d4l_mysql_result($getInitialDetailsQuery,0,'sbicc_name');
$sbicc_mobile = d4l_mysql_result($getInitialDetailsQuery,0,'sbicc_mobile');
$sbicc_pancard = d4l_mysql_result($getInitialDetailsQuery,0,'sbicc_pancard');
echo "Name - <b>".$Name."</b><br><br>";


/* Check if user already submitted request within 5 minutes Start*/
$checkRequestXmlQry = "SELECT request_xml, first_dated FROM sbi_credit_card_5633 WHERE RequestID = '".$requestID."' AND first_dated > DATE_SUB(NOW(), INTERVAL 30 MINUTE) ORDER BY sbiccid DESC limit 0,1";
$getRequestXmlResult = d4l_ExecQuery($checkRequestXmlQry);
$request_xml = d4l_mysql_result($getRequestXmlResult,0,'request_xml');
$first_dated = d4l_mysql_result($getRequestXmlResult,0,'first_dated');

if(!empty($request_xml)){
	echo 'Submitted at '.$first_dated;
	echo '<br/>In Process ...<br/>';
	die();
}
/* Check if user already submitted request within 5 minutes End*/

/* Check if user already submitted If Blank*/
$getSBIButtonSql = "SELECT response_xml FROM `webservice_log_sbi` WHERE cc_requestid IN (SELECT cc_requestid FROM (select cc_requestid, COUNT(cc_requestid) AS c FROM `webservice_log_sbi` GROUP BY cc_requestid HAVING C < 2 ) as temp) AND response_xml = '' AND cc_requestid = '".$requestID."' AND response_blank = 0";
//echo $getSBIButtonSql."<br>";
$getSBIButtonQuery = d4l_ExecQuery($getSBIButtonSql);
$getSBIButtonNumRows = d4l_mysql_num_rows($getSBIButtonQuery);
$response_xml = d4l_mysql_result($getSBIButtonQuery,0,'response_xml');
if($getSBIButtonNumRows>0) 
{
	//Hide Button 
	//echo "Submitted Blank";
	echo "Already punched to SBI. No Response";
	die();
}
/* Check if user already submitted If Blank*/

/*To check if given pancard or mobile is found in any request_xml for webservice_log_sbi*/
$checkPANMobileLogSql = "SELECT sbicclogid FROM `webservice_log_sbi` WHERE request_xml != '' AND ((request_xml LIKE '%<PAN>".$sbicc_pancard."</PAN>%') OR (request_xml LIKE '%<Mobile>".$sbicc_mobile."</Mobile>%')) AND (first_dated > DATE_SUB(NOW(), INTERVAL 180 DAY)) AND (StatusCode != 156 OR StatusCode IS NULL)";//updated on 25092017
$checkPANMobileLogResult = d4l_ExecQuery($checkPANMobileLogSql);
$checkPANMobileLogNumRows = d4l_mysql_num_rows($checkPANMobileLogResult);
if($checkPANMobileLogNumRows>0 && $sbicc_mobile>0 && strlen($sbicc_pancard) > 0) 
{
	//Hide Button 
	echo "<b>Duplicate Pancard Or Mobile Number.<b>";
	exit;
}
/*To check if given pancard or mobile is found in any request_xml for webservice_log_sbi*/

/*To check if given pancard or mobile is found in any request_xml for sbi_credit_card_5633*/
$checkSccPANMobileLogSql = "SELECT sbiccid FROM `sbi_credit_card_5633` WHERE request_xml != '' AND ((request_xml LIKE '%<PAN>".$sbicc_pancard."</PAN>%') OR (request_xml LIKE '%<Mobile>".$sbicc_mobile."</Mobile>%')) AND (first_dated > DATE_SUB(NOW(), INTERVAL 180 DAY)) AND (StatusCode != 156 OR StatusCode IS NULL)";//updated on 06102017
$checkSccPANMobileLogResult = d4l_ExecQuery($checkSccPANMobileLogSql);
$checkSccPANMobileLogNumRows = d4l_mysql_num_rows($checkSccPANMobileLogResult);
if($checkSccPANMobileLogNumRows>0 && strlen($sbicc_mobile) > 0 && strlen($sbicc_pancard) > 0) 
{
	echo "<b>Duplicate Pancard Or Mobile Number..<b>";
	exit;
}
/*To check if given pancard or mobile is found in any request_xml for sbi_credit_card_5633*/


sebisent($requestID,$process,$agent_id);

function sebisent($requestid,$process,$agent_id)
{
	$sbiccdetails="Select * from sbi_credit_card_5633 Where (RequestID='".$requestid."' and productflag=10) order by sbiccid DESC LIMIT 0,1";
	$sbiccqry=d4l_ExecQuery($sbiccdetails);
	while($ccrow=d4l_mysql_fetch_array($sbiccqry))
	{
		$sbiccid = $ccrow["sbiccid"];
		$RequestID = $ccrow["RequestID"];
		$postpaidMobileNumber = $_POST["sbicc_postpaidmobile"];
		$CompanyName = $ccrow["CompanyName"];
		$ResidenceAddress1 = $ccrow["ResidenceAddress1"];
		$ResidenceAddress2 = $ccrow["ResidenceAddress2"];
		$ResidenceAddress3 = $ccrow["ResidenceAddress3"];
		$OfficeAddress1 = $ccrow["OfficeAddress1"];
		$OfficeAddress2 = $ccrow["OfficeAddress2"];
		$OfficeAddress3 = $ccrow["OfficeAddress3"];
		$OfficePin = $ccrow["OfficePin"];
		$OfficeCity = $ccrow["OfficeCity"];
		$OfficePhone = $ccrow["LandlineNo"];
		$OfficeState = $ccrow["OfficeState"];
		$Qualification = $ccrow["Qualification"];
		$Designation = $ccrow["Designation"];
		$CardName = trim($ccrow["CardName"]);
		$LeadRefNumber = $ccrow["LeadRefNumber"];
		if(strlen($LeadRefNumber)>0)
		{}
		else 
		{
			$sbilogSql ="Select response_xml from webservice_log_sbi Where (sbiccid='".$sbiccid."' AND response_xml != '') order by first_dated desc limit 0,1";
			$sbilogQuery = d4l_ExecQuery($sbilogSql);
			$rowsbilogQuery=d4l_mysql_fetch_array($sbilogQuery);
			$logResponse_xml = $rowsbilogQuery["response_xml"];

			$startpos = strpos($logResponse_xml, 'LeadRefNumber>');
			$finalstartpos = $startpos + strlen('LeadRefNumber>');
			
			$lastpos = strpos($logResponse_xml, '&lt;/LeadRefNumber>');
			
			$LeadRefNumber= trim(substr($logResponse_xml, $finalstartpos, $lastpos - $finalstartpos));
			//should we update the sbi_credit_card_5633 with LeadRefNumber
		}

		$sbi_cc_holder = $ccrow["sbi_cc_holder"];
		$applied_in_6_months = $ccrow["applied_in_6_months"];
		$relationship_type = $ccrow["relationship_type"];
		$account_number = $ccrow["account_number"];
		$Dated=ExactServerdate();
		if($relationship_type == 'Yes'){
			$BankName = 'SBI';
		}
		else{
			$BankName = '';
		}
		if($OfficeCity=="Kolkata")
		{
			$offslct="select std,state,source_code from sbi_cc_city_state_list Where (city like'%CALCUTTA%') group by city Limit 0,1";
		}
		else if($OfficeCity=="Gaziabad")
		{
			$offslct="select std,state,source_code from sbi_cc_city_state_list Where (city like'%GHAZIABAD%') group by city Limit 0,1";
		}
		else
		{
			$offslct="select std,state,source_code from sbi_cc_city_state_list Where (city like'%".strtoupper($OfficeCity)."%') group by city Limit 0,1";
		}
		$offslct=d4l_ExecQuery($offslct);
		$crow=d4l_mysql_fetch_array($offslct);
		$offstd = "0".$crow["std"];
		$OfficeState = $crow["state"];
		$SourceCode = $crow["source_code"];
	  
		$slct="select * from sbi_ccoffers_directonsite Where (sbiccoffersid='".$RequestID."')";
		$slctqry=d4l_ExecQuery($slct);
		$row=d4l_mysql_fetch_array($slctqry);
		$Gender = $row["sbicc_gender"];
		$ResiPhone = $row["sbicc_landline"];
		$City = $row["sbicc_city"];
		$City_Other = $row["City_Other"];
		if($City=="Others" && Strlen($City_Other)>0)
		{
			$strcity=$City_Other;
		}
		else
		{
			$strcity=$City;
		}
		$resistd = "";
		if($resistd=="")
		{
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
			$resislct=d4l_ExecQuery($resislct);
			$rsrow=d4l_mysql_fetch_array($resislct);
			$resistd = "0".$rsrow["std"];
			$residencestate = $rsrow["state"];
			$SourceCode = $rsrow["source_code"];
		}
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
		$Mobile = $row["sbicc_mobile"];
		$Email = $row["sbicc_email"];
		
		$ResiState = $residencestate;
	    $IP_Address= $row["IP_Address"];

		$Pancard = $row["sbicc_pancard"];
		$CompanyName = substr(trim($CompanyName),0,30);
		$ResiAddress3 = str_replace("@", "", $Email);
		$Pincode = $row["sbicc_pincode"];
		$Employment_Status = $row["sbicc_occupation"];
		if($Employment_Status==1)
		{
			$OccupationType = "S";
		}
		else
		{
			$OccupationType = "E";
		}
		list($year,$month,$day) = split("[-]",$row["sbicc_dob"]);
		list($first_name,$middle_name,$last_name) = split("[ ]",$row["sbicc_name"]);
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

		if($middle_name=="Middle Name")
		{
			$middle_name="";
		}
		
		/*
		$Residence_Address = $row["sbicc_residence_address"];
		$Residence_Address = str_ireplace('|','',$Residence_Address);
		$strresieadd = round((strlen($Residence_Address)/3));
		$residenceadd = str_split($Residence_Address, $strresieadd);
		$resiaddress1 = $residenceadd[0];
		$resiaddress2 = $residenceadd[1];
		$resiaddress3 = $residenceadd[2];
		*/

		if($CardName=="SBI Card Prime"){
			$card_type="VPTL"; $PromoCode="SCEA";
		}
		elseif($CardName=="Yatra SBI Card"){
			$card_type="SYT1"; $PromoCode="YAEA";
		}
		elseif($CardName=="IRCTC SBI Platinum Card"){
			$card_type="IRCP";  $PromoCode="IREA";
		}
		elseif($CardName=="Air India SBI Signature Card"){
			$card_type="AISU"; $PromoCode="SCEA";
		}
		elseif($CardName=="Air India SBI Platinum Card"){
			$card_type="AIPU"; $PromoCode="SCEA";
		}
		elseif($CardName=="SBI SimplySave"){
			$card_type="SSU2"; $PromoCode="SCEA";
		}
		elseif($CardName=="SimplyCLICK Contactless SBI Card"){
			$card_type="CSC2"; $PromoCode="SCEA";
		}
		elseif($CardName=="SimplyCLICK SBI Card"){
			$card_type="CSC2"; $PromoCode="SCEA";
		}
		elseif($CardName=="Mumbai Metro SBI Card"){
			$card_type="MMSU";  $PromoCode="SCEA";
		}
		elseif($CardName=="SBI ELITE Card"){
			$card_type="VISC";  $PromoCode="SCEA";
		}
		elseif($CardName=="Fbb SBI STYLEUP Contactless Card"){
			$card_type="FBBS"; $PromoCode="SCEA";
		}
		else{
			$card_type="SSU2"; $PromoCode="SCEA";
		}
		
		$validlead='';
		if($sbi_cc_holder == 'No' && $applied_in_6_months=='No')
		{
			$validlead=1;
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
		//$TextSpareField3=$IP_Address;
		$CardType = $card_type;
		$yesterday  = mktime(0, 0, 0, date("m")  , date("d")-1, date("Y"));
		$DateSpareField=date('m/d/Y',$yesterday);
		$strdob = $day."/".$month."/".$year;
		$FirstName = substr($first_name,0,12);//mandatory 
		$MiddleName = substr($middle_name,0,10);//mandatory
		$LastName = substr($last_name,0,16);//mandatory
		$Mobile = trim($Mobile);//mandatory
		$Qualification = $Qualification;
		$PAN = trim($Pancard);//mandatory
		$ResiAddress1 = trim(substr($ResidenceAddress1,0,40));//mandatory
		$ResiAddress2 = trim(substr($ResidenceAddress2,0,40));//mandatory
		$ResiAddress3 = trim(substr($ResidenceAddress3,0,40));;//mandatory
		$EmailAddress = trim($Email);//mandatory
		$ResiCity = $strcity;//mandatory
		$ResiState = $ResiState;//mandatory
		$ResiPin = trim($Pincode);//mandatory
		$OccupationType = $OccupationType;//mandatory
		$CompanyName = trim($CompanyName);
		$OfficeAddress1 = trim(substr($OfficeAddress1,0,40));//mandatory
		$OfficeAddress2 = trim(substr($OfficeAddress2,0,40));//mandatory
		$OfficeAddress3 = trim(substr($OfficeAddress3,0,40));
		$EmployeePFNumber="";
		$BranchManagerPFNumber="";
		
		if($LeadRefNumber>0)
		{
			$LeadRefNumberfinal=$LeadRefNumber;
		}
		else
		{
			$LeadRefNumberfinal="";
		}

		 if($validlead==1){

			try{
				$errMsg = "";
				$flag = 0;
				
				if(empty($SourceCode)){
					$errMsg .= 'SourceCode is empty'.'<br/>';
					$flag = 1;
				}
				if(empty($PromoCode)){
					$errMsg .= 'PromoCode is empty'.'<br/>';
					$flag = 1;
				}
				if(empty($CardType)){
					$errMsg .= 'CardType is empty'.'<br/>';
					$flag = 1;
				}
				
				if(empty($FirstName)){
					$errMsg .= 'FirstName is empty'.'<br/>';
					$flag = 1;
				}
				if(strlen($FirstName) > 12){
					$errMsg .= 'FirstName: Max length is 12 chars'.'<br/>';
					$flag = 1;
				}

				if(empty($LastName)){
					$errMsg .= 'LastName is empty'.'<br/>';
					$flag = 1;
				}
				if(strlen($LastName) > 16){
					$errMsg .= 'LastName: Max length is 16 chars'.'<br/>';
					$flag = 1;
				}
				
				if(empty($day)){
					$errMsg .= 'Day is empty'.'<br/>';
					$flag = 1;
				}
				
				if(empty($month)){
					$errMsg .= 'Month is empty'.'<br/>';
					$flag = 1;
				}
				
				$minage= Date('Y')-18;
				$maxage=Date('Y')-62;
				if(empty($year)){
					$errMsg .= 'Year is empty'.'<br/>';
					$flag = 1;
				}elseif($year > $minage || $year < $maxage){
					$errMsg .= 'Invalid age'.'<br/>';
					$flag = 1;
				}

				if(empty($strdob)){
					$errMsg .= 'DOB is empty'.'<br/>';
					$flag = 1;
				}

				if(empty($Mobile)){
					$errMsg .= 'Mobile Number is empty'.'<br/>';
					$flag = 1;
				}
				if(strlen($Mobile) != 10){
					$errMsg .= 'Mobile Number should be of 10 numbers'.'<br/>';
					$flag = 1;
				}
				if(substr($Mobile,0,1) != 9 && substr($Mobile,0,1) != 8 && substr($Mobile,0,1) != 7){
					$errMsg .= 'Mobile Number should should start with 9,8 or 7'.'<br/>';
					$flag = 1;
				}
				
				if(empty($strgender)){
					$errMsg .= 'Gender is empty'.'<br/>';
					$flag = 1;
				}elseif($strgender!='M' && $strgender != 'F'){
					$errMsg .= 'Enter correct value of Gender'.'<br/>';
					$flag = 1;
				}

				if(empty($Qualification)){
					$errMsg .= 'Qualification is empty'.'<br/>';
					$flag = 1;
				}
				
				if(empty($PAN)){
					$errMsg .= 'PAN is empty'.'<br/>';
					$flag = 1;
				}elseif(strlen($PAN) != 10){
					$errMsg .= 'PAN should be of 10 numbers'.'<br/>';
					$flag = 1;
				}elseif(!preg_match("/^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}?$/", $PAN)) {
					$errMsg .= 'PAN is invalid'.'<br/>';
					$flag = 1;
				}
				
				if(empty($EmailAddress)){
					$errMsg .= 'Email is empty'.'<br/>';
					$flag = 1;
				}elseif(strlen($EmailAddress) > 40){
					$errMsg .= 'EmailAddress: Max length is 40 chars'.'<br/>';
					$flag = 1;
				}elseif(!filter_var($EmailAddress, FILTER_VALIDATE_EMAIL)) {
					$errMsg .= 'Email format is invalid'.'<br/>';
					$flag = 1;
				}
				
				if(empty($ResiAddress1)){
					$errMsg .= 'ResiAddress1 is empty'.'<br/>';
					$flag = 1;
				}elseif(strlen($ResiAddress1) > 40){
					$errMsg .= 'ResiAddress1: Max length is 40 chars'.'<br/>';
					$flag = 1;
				}elseif(preg_match("/[^a-zA-Z0-9\.\,\/\-\ ]/", $ResiAddress1)) {
					$errMsg .= 'ResiAddress1 is invalid'.'<br/>';
					$flag = 1;
				}
				
				if(empty($ResiAddress2)){
					$errMsg .= 'ResiAddress2 is empty'.'<br/>';
					$flag = 1;
				}elseif(strlen($ResiAddress2) > 40){
					$errMsg .= 'ResiAddress2: Max length is 40 chars'.'<br/>';
					$flag = 1;
				}elseif(preg_match("/[^a-zA-Z0-9\.\,\/\-\ ]/", $ResiAddress2)) {
					$errMsg .= 'ResiAddress2 is invalid'.'<br/>';
					$flag = 1;
				}
				
				if(!empty($ResiAddress3) && (strlen($ResiAddress3) > 40)){
					$errMsg .= 'ResiAddress3: Max length is 40 chars'.'<br/>';
					$flag = 1;
				}elseif(preg_match("/[^a-zA-Z0-9\.\,\/\-\ ]/", $ResiAddress3)) {
					$errMsg .= 'ResiAddress3 is invalid'.'<br/>';
					$flag = 1;
				}
				
				if(empty($ResiCity)){
					$errMsg .= 'ResiCity is empty'.'<br/>';
					$flag = 1;
				}
				
				if(empty($ResiState)){
					$errMsg .= 'ResiState is empty'.'<br/>';
					$flag = 1;
				}
				
				if(empty($ResiPin)){
					$errMsg .= 'ResiPin is empty'.'<br/>';
					$flag = 1;
				}elseif(strlen($ResiPin) != 6){
					$errMsg .= 'ResiPin should be of 6 numbers'.'<br/>';
					$flag = 1;
				}

				if(empty($OccupationType)){
					$errMsg .= 'OccupationType is empty'.'<br/>';
					$flag = 1;
				}

				if(empty($CompanyName)){
					$errMsg .= 'CompanyName is empty'.'<br/>';
					$flag = 1;
				}elseif(strlen($CompanyName) > 30){
					$errMsg .= 'CompanyName: Max length is 30 chars'.'<br/>';
					$flag = 1;
				}

				if(empty($Designation)){
					$errMsg .= 'Designation is empty'.'<br/>';
					$flag = 1;
				}
				
				if(empty($OfficeAddress1)){
					$errMsg .= 'OfficeAddress1 is empty'.'<br/>';
					$flag = 1;
				}elseif(strlen($OfficeAddress1) > 40){
					$errMsg .= 'OfficeAddress1: Max length is 40 chars'.'<br/>';
					$flag = 1;
				}elseif(preg_match("/[^a-zA-Z0-9\.\,\/\-\ ]/", $OfficeAddress1)) {
					$errMsg .= 'OfficeAddress1 is invalid'.'<br/>';
					$flag = 1;
				}
				
				if(!empty($OfficeAddress2) && (strlen($OfficeAddress2) > 40)){
					$errMsg .= 'OfficeAddress2: Max length is 40 chars'.'<br/>';
					$flag = 1;
				}elseif(preg_match("/[^a-zA-Z0-9\.\,\/\-\ ]/", $OfficeAddress2)) {
					$errMsg .= 'OfficeAddress2 is invalid'.'<br/>';
					$flag = 1;
				}
				
				if(!empty($OfficeAddress3) && (strlen($OfficeAddress3) > 40)){
					$errMsg .= 'OfficeAddress3: Max length is 40 chars'.'<br/>';
					$flag = 1;
				}elseif(preg_match("/[^a-zA-Z0-9\.\,\/\-\ ]/", $OfficeAddress3)) {
					$errMsg .= 'OfficeAddress3 is invalid'.'<br/>';
					$flag = 1;
				}
				
				if(empty($OfficeState)){
					$errMsg .= 'OfficeState is empty'.'<br/>';
					$flag = 1;
				}
				
				if(empty($OfficeCity)){
					$errMsg .= 'OfficeCity is empty'.'<br/>';
					$flag = 1;
				}
				
				if(empty($OfficePin)){
					$errMsg .= 'OfficePin is empty'.'<br/>';
					$flag = 1;
				}elseif(strlen($OfficePin) != 6){
					$errMsg .= 'OfficePin should be of 6 numbers'.'<br/>';
					$flag = 1;
				}
				
				if(empty($DateSpareField)){
					$errMsg .= 'DateSpareField is empty'.'<br/>';
					$flag = 1;
				}
				/*
				if($relationship_type == 'Yes' && empty($account_number)){
					$errMsg .= 'Account Number is empty'.'<br/>';
					$flag = 1;
				}
				*/
				if($flag){
					throw new Exception($errMsg);
				}
			}catch(Exception $e){
				echo $e->getMessage().'<br/>'.'<strong>Please fill all required fields</strong>';
				exit;
			}
			
			
			$dataArr = array();
			$dataArr['RequestID']= $RequestID;
			$dataArr['LeadRefNo']= $LeadRefNumberfinal;
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
			$dataArr['Designation']= $Designation;
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
			$extraDataArr['lms_process']= $process;
			$extraDataArr['agent_id']= $agent_id;

			$process_type= 'TWL_LMS';
			
			//Insert log in sbi_checks_errorlog
			$PageUrl = $_SERVER['HTTP_REFERER'];
			$logdataArr = array();
			$logdataArr['RequestID'] = $RequestID;
			$logdataArr['productflag'] = 10;
			$logdataArr['Mobile'] = $Mobile;
			$logdataArr['Pancard'] = $PAN;
			$logdataArr['PageUrl'] = $PageUrl;
			$logdataArr['StepNumber'] = 'Service';
			insertsbicheckerrorlog($logdataArr);

			$webserviceObj = new Webservices();
			$serviceResponse = $webserviceObj->SBIWebservice($dataArr, $extraDataArr, $process_type, $sbiccid);
			//echo '<pre>';print_r($serviceResponse);
			
			$LeadRefNumber = $serviceResponse['LeadRefNumber'];
			$ApplicationNumber = $serviceResponse['ApplicationNumber'];
			$StatusCode = $serviceResponse['StatusCode'];
			$ProcessingStatus = $serviceResponse['ProcessingStatus'];
			$CreditLimit = $serviceResponse['CreditLimit'];
			$Message = $serviceResponse['Message'];
			$code = $serviceResponse['code'];
			$message = $serviceResponse['message'];

			echo "LeadRef Numbner: ".$LeadRefNumber; echo "<br>";
			echo "Application Number: ".$ApplicationNumber;echo "<br>";
			echo "STatus Code: ".$StatusCode;echo "<br>";
			echo "Processing Statusr: ".$ProcessingStatus;echo "<br>";
			echo "CreditLimit: ".$CreditLimit;echo "<br>";
			echo "Message: ".$Message;echo "<br>";
			echo "code: ".$code;echo "<br>";
			echo "message: ".$message;echo "<br>";
		}
		else
		{
			if($sbi_cc_holder == 'Yes'){
				echo "Already Having Sbi Card ";
			}
			else
			{
				echo "Already Having Sbi Card Not Selected";
			}
			if($applied_in_6_months == 'Yes'){
				echo "Already Applied in last 6 months";
			}
			else
			{
				echo "<br> Already Applied in last 6 months Not Selected";
			}
			die;
		}
	}
}


function insertsbicheckerrorlog($dataArr=array()){
	$Dated = ExactServerdate();
	$RequestID = $dataArr['RequestID'];
	$productflag = $dataArr['productflag'];
	$Mobile = $dataArr['Mobile'];
	$Pancard = $dataArr['Pancard'];
	$StepNumber = $dataArr['StepNumber'];
	$PageUrl = $dataArr['PageUrl'];
	
	if($RequestID > 0){
		$insertchecksqry="INSERT INTO sbi_checks_errorlog SET RequestID='".$RequestID."',productflag='".$productflag."',Mobile='".$Mobile."',Pancard='".$Pancard."',StepNumber='".$StepNumber."',PageUrl='".$PageUrl."',Dated='".$Dated."'";
		d4l_ExecQuery($insertchecksqry);
	}
}
?>
