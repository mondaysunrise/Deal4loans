<?php
require '../../../scripts/db_init.php';
$validateMobile= 9828988850;
$validateMobile= 9971396361;
//$validatePancard= 'BIFPK1393C';

//$mob = 9971536361;
$validatePancard= 'ATDPK2777Q';

$validationBanks = new validationBanks();
$return = $validationBanks->panmobvalidation($bank,$validateMobile,$validatePancard);
echo $return;

/*
$url = 'http://www.deal4loans.com/api/v1/panmobvalidation/api.php';
$sData = 'bank=sbi&mob='.$mob.'&pan='.$pan;

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POSTFIELDS, $sData);
curl_setopt($ch, CURLOPT_USERPWD, 'deal4loans_service_check:d4l^^Yq');
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
$vRes = curl_exec($ch);
curl_close($ch);

echo $vRes;

*/
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
			
			
		}
		return json_encode($return);
	
	}
}	

?>