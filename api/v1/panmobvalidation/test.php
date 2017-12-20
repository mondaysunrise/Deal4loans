<?php 
require '../../../scripts/db_init.php';
//print_r($_POST);
$validateMobile= 9828988850;
$validateMobile= 9971396361;
//$validatePancard= 'BIFPK1393C';

//$mob = 9971536361;
$validatePancard= 'ATDPK2777Q';

$checkPANInRequestSql = "SELECT cc_requestid as RequestID FROM `webservice_log_sbi` as scc WHERE request_xml LIKE '%<PAN>".$validatePancard."</PAN>%' AND (scc.first_dated > DATE_SUB(NOW(), INTERVAL 180 DAY))";			
			
			echo $checkPANInRequestSql."<br>";
			$checkPANInRequestResult = d4l_ExecQuery($checkPANInRequestSql);
			$checkPANInRequestNumRows = d4l_mysql_num_rows($checkPANInRequestResult);
			$return = '';
			$returnPan = '';
			if($checkPANInRequestNumRows>0) 
			{
				$returnPan = "duplicate";
				$return["pan"] = "duplicate_pancard";
			}
			else 
			{
				$returnPan = "ok";
				$return["pan"] = "ok";
			}
			
			
			
			$checkPANInRequestSql = "SELECT cc_requestid as RequestID FROM `webservice_log_sbi` as scc WHERE request_xml LIKE '%<Mobile>".$validateMobile."</Mobile>%' AND (scc.first_dated > DATE_SUB(NOW(), INTERVAL 180 DAY))";	
			echo $checkMobileInRequestSql."<br>";
			$checkMobileInRequestResult = d4l_ExecQuery($checkMobileInRequestSql);
			$checkMobileInRequestNumRows = d4l_mysql_num_rows($checkMobileInRequestResult);
			$returnMobile = "";
			if($checkMobileInRequestNumRows>0) 
			{
				$returnMobile = "duplicate";
				$return["mob"] = "duplicate_mobile";
			}
			else 
			{
				$returnMobile = "ok";
				$return["mob"] = "ok";
			}
			
			//print_r($return);
			if($returnMobile == "ok" && $returnPan == "ok")
			{
				$return["duplicate"] =0;
			}
			else
			{
				$return["duplicate"] =1;
			}
			
?>