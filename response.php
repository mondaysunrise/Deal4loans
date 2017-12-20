<?php

require 'scripts/db_init.php';
require 'scripts/functions.php';

	/*
	$cc_alldetailsqry = ExecQuery("SELECT `cc_requestid`,`request_data`,`response_data`,`date_created` FROM `credit_card_banks_apply` WHERE `cc_requestid` IN (SELECT AllRequestID  FROM `lead_allocate` WHERE `BidderID` = 6729 GROUP BY AllRequestID) AND `applied_bankname` LIKE '%amer%' AND `request_data` != ''");
	$ccal=mysql_fetch_array($cc_alldetailsqry);
	//echo '<pre>';print_r($ccal);exit;
	*/
	
	//$getsbiResponseSql = "SELECT `cc_requestid`,`request_data`,`response_data`,`date_created` FROM `credit_card_banks_apply` WHERE `cc_requestid` IN (SELECT AllRequestID  FROM `lead_allocate` WHERE `BidderID` in (6729,6827,6828,6829,6830,6831) GROUP BY AllRequestID) AND `applied_bankname` LIKE '%amer%' AND `request_data` != ''  AND date_created>'2017-05-01 00:00:00' order by id desc "; // Amex
	
	$getsbiResponseSql ="SELECT `cc_requestid`,`request_data`,`response_data`,`date_created` FROM `credit_card_banks_apply` WHERE `cc_requestid` IN (SELECT AllRequestID  FROM `lead_allocate` WHERE `BidderID` in (6723,6724,6824,6825,6826) GROUP BY AllRequestID) AND `applied_bankname` LIKE '%RBL%' AND `request_data` != ''  AND date_created>'2017-05-15 00:00:00' order by id desc"; // RBL
	$getsbiResponseSql = "SELECT * FROM  `credit_card_banks_apply` WHERE  `applied_bankname` LIKE  '%Amer%' AND  `lead_source` =  'LMS' and `date_created`>'2017-05-01 00:00:00' and request_data like '%The Application is submitted successfully.%'  order by id desc";
	
	$getsbiResponseSql ="SELECT * FROM  `credit_card_banks_apply`  WHERE    cc_requestid in (select RequestID from Req_Credit_Card where Mobile_Number in (9898457163, 9909800091, 7666908364, 9063426047, 8951700616, 9845307777, 9953681388, 8825621246, 8860684889, 9295950116, 9329745235, 9958299241, 9049275656, 9826039648, 8802168549, 9327162234, 9786663730, 9929255569, 9670455229, 9717799713, 7401625758, 9414037099, 9599551746, 9213827576, 8951035290, 9985558312, 9820350929, 9036590085, 9442907269, 9900729111, 9940305065, 9008036026, 7798465265, 9951250006, 9413569808, 9925221334, 7710934572, 9790970068, 9884322625, 9959317567, 9769581245, 8147288141, 8904312254, 9986606682, 9710448440, 9840650801, 9820603772, 9828666667, 9787729073, 9819589545, 8884909444, 9820994090, 9008455221, 9611691444, 9894106405, 9870452462, 9003185187, 9160466466, 9980546174, 9811955676, 9967450296, 7795309215, 7741991505, 9925720875, 9962410739, 9886689844, 9391455799, 7720090391, 9841060442, 9324213982, 9880844484, 9768907970, 9886152115, 9493209695, 9558345730, 9825612437, 9753936411, 9597756130, 9881673321, 9900354482, 9425322141, 9820833074, 9444233338, 9591984914, 7827341599, 9880619939, 9650260795, 8978222138, 9460872763, 9986638663, 7722028075, 9178462917) group by Mobile_Number) group by cc_requestid";
// 
	//$getsbiResponseSql = "SELECT `cc_requestid`,`request_data`,`response_data`,`date_created` FROM `credit_card_banks_apply` WHERE  `applied_bankname` LIKE '%amer%' AND `request_data` != '' AND date_created>'2017-05-12 00:00:00' order by id desc ";

	list($numRows,$getsbiResponse)=MainselectfuncNew($getsbiResponseSql,$array = array());
	//echo '<pre>';print_r($getsbiResponse);exit;
echo "<table border=1>";
echo "<tr><td>RequestID</td><td>Name</td><td>Mobile</td><td>Employment_status</td><td>Company_Name</td><td>Net Salary</td><td>DOB</td><td>City</td><td>Pincode</td><td>Response</td><td>Dated</td><td>Type</td></tr>";//<td>Card Name</td>
	foreach($getsbiResponse as $key=>$value){
	echo "<tr><td>";
	echo	$requestID = $value["cc_requestid"];
		echo "</td><td>";
		$getCustomerNameSql = "select * from Req_Credit_Card where RequestID='".$requestID."'";
		$getCustomerNameQuery = ExecQuery($getCustomerNameSql);
		echo $Name = mysql_result($getCustomerNameQuery,0,'Name');
		echo "</td><td>";
		echo mysql_result($getCustomerNameQuery,0,'Mobile_Number');
		echo "</td><td>";
		echo mysql_result($getCustomerNameQuery,0,'Employment_status');
		echo "</td><td>";
		echo mysql_result($getCustomerNameQuery,0,'Company_Name');
		echo "</td><td>";
		echo mysql_result($getCustomerNameQuery,0,'Net_Salary');
		echo "</td><td>";
		echo mysql_result($getCustomerNameQuery,0,'DOB');
		echo "</td><td>";
		echo mysql_result($getCustomerNameQuery,0,'City');
		echo "</td><td>";
		echo mysql_result($getCustomerNameQuery,0,'Pincode');
		echo "</td><td>";
	//	echo mysql_result($getCustomerNameQuery,0,'applied_card_name');
	//	echo "</td><td>";

		$responsedata=trim($value["response_data"]);
		$xmlArray = str_ireplace('<soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema"><soap:Body>','',$responsedata);
		$xmlArray = str_ireplace('</soap:Body></soap:Envelope>','',$xmlArray);
		$xmlArray = simplexml_load_string($xmlArray);
		//echo '<pre>';print_r($xmlArray);
		$json = json_encode($xmlArray);
		$responseArray = json_decode($json,true);
		//print_r($responseArray);exit;
		if(isset($responseArray['submitApplicationResult'])){
			$response = $responseArray['submitApplicationResult']; 
			if(isset($response) && $response['status']['success'] == "true"){
				if($response['successResponse']['approved'] == "true"){
					echo "The Application is submitted successfully.";
					//echo "Bank Response :"; echo "<pre>"; print_r($response['successResponse']['successResponseMessage']); echo "</pre>";
				}elseif($response['successResponse']['decline'] == "true"){ 
					echo "The Application is Decline. ";
					foreach($response['successResponse']['declineReason'] as $key=>$reason){
						if($reason == "true"){
							echo "( Decline reason : $key. )";
						}
					}
				}
			}else{
				if($response['failureResponse']['validationError']['errorDesc']){
					echo "The Application is rejected for now.<br>";
				//	echo "Reason : ".$response['failureResponse']['validationError']['errorDesc'];
				}elseif($response['failureResponse']['unhandledException'] == "true"){
					echo "The Application is rejected for now.Reason : unhandled Exception";
					//echo "";
				}
			}
		}
		echo "</td><td>";
			echo $value["date_created"];
		echo "</td><td>";
			echo $value["lead_source"];
		echo '</td></tr>';
	}
	echo "</table>";
?>
