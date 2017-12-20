<?php 
require '../../../scripts/db_init.php';
//print_r($_POST);

	if($_SERVER['PHP_AUTH_USER']=="deal4loans_service_check" && $_SERVER['PHP_AUTH_PW']=="d4l^^Yq" )
    {
		$bank = $_POST['bank'];
		$validateMobile = $_POST['mob'];
		$validatePancard = $_POST['pan'];
		$validationBanks = new validationBanks();
		$return = $validationBanks->panmobvalidation($bank,$validateMobile,$validatePancard);
	}
	else
	{
		$return = json_encode(array("error"=>"notauthorised"));		
	}
	echo $return;
	
class validationBanks{
	
	public function __construct() {
		
    }
	
	function panmobvalidation($bank,$validateMobile,$validatePancard)
	{
		if(strlen($validatePancard)!=10)
		{
			$return = array("error"=>"invalidpan");
		}
		else if(strlen($validateMobile)!=10)
		{
			$return = array("error"=>"invalidmobile");
		}
		else
		{
			/*To check if given pancard is found in any request_xml */
//			$checkPANInRequestSql = "SELECT RequestID FROM `sbi_credit_card_5633` as scc WHERE request_xml LIKE '%<PAN>".$validatePancard."</PAN>%' AND (scc.first_dated > DATE_SUB(NOW(), INTERVAL 180 DAY))";
			$checkPANInRequestSql = "SELECT cc_requestid as RequestID FROM `webservice_log_sbi` as scc WHERE request_xml LIKE '%<PAN>".$validatePancard."</PAN>%' AND (scc.first_dated > DATE_SUB(NOW(), INTERVAL 180 DAY))";			
			
			//echo $checkPANInRequestSql."<br>";
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
			
			/*To check if given mobile is found in any request_xml */
			//$checkMobileInRequestSql = "SELECT RequestID FROM `sbi_credit_card_5633` as scc WHERE request_xml LIKE '%<Mobile>".$validateMobile."</Mobile>%' AND (scc.first_dated > DATE_SUB(NOW(), INTERVAL 180 DAY))";
			$checkMobileInRequestSql= "SELECT cc_requestid as RequestID FROM `webservice_log_sbi` as scc WHERE request_xml LIKE '%<Mobile>".$validateMobile."</Mobile>%' AND (scc.first_dated > DATE_SUB(NOW(), INTERVAL 180 DAY))";	
			//echo $checkMobileInRequestSql."<br>";
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
			
			
		}
		return json_encode($return);
	
	}
}	
?>